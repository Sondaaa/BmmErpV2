<?php

/**
 * Inventaire actions.
 *
 * @package    Commercial
 * @subpackage Inventaire
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InventaireActions extends sfActions {
    public function executeIndex(sfWebRequest $request) {

        $this->date_debut=date('Y-m-d');
        $this->date_fin=date('Y-m-d');
        if($request->getParameter('filter')) {

            if($request->getParameter('date_debut'))
                $this->date_debut=$request->getParameter('date_debut');
            if($request->getParameter('date_fin'))
                $this->date_fin=$request->getParameter('date_fin');
        }

        $this->bureaux = Doctrine_Core::getTable('bureaux')
                ->createQuery('a')
                ->execute();

    }
    public function Filter($request) {
        if($request->getParameter('filter')) {
            $dated=date("Y-m-d",strtotime( $request->getParameter('date_debut')));//die($dated);
            $datef=date("Y-m-d",strtotime($request->getParameter('date_fin')));

            $mag=$request->getParameter('slt_site');
            if($mag!="-1") {

                $biens = Doctrine_Core::getTable('immobilisation')
                        ->createQuery('a')

                        ->andwhere( 'datecreation>="'.$dated.'"')
                        ->andwhere('datecreation<="'.$datef.'"')
                        ->andwhere('id_site='.$mag)
                        ->orderBy('id desc');
            }
            else {
                $biens = Doctrine_Core::getTable('immobilisation')
                        ->createQuery('a')

                        ->andwhere( 'datecreation>="'.$dated.'"')
                        ->andwhere('datecreation<="'.$datef.'"')

                        ->orderBy('id desc');
            }
        }
        else {
            $biens = Doctrine_Core::getTable('immobilisation')
                    ->createQuery('a')

                    ->orderBy('id desc');
        }
        return $biens;
    }

    public function executeShow(sfWebRequest $request) {

        $this->iddoc=$request->getParameter('id');
        $this->idbur=$request->getParameter('idbureau');
        $idbureau=$request->getParameter('idbureau');
//  $doc=new Document();
        $doc=Doctrine_Core::getTable('document')->findOneById($this->iddoc);
        $this->doc=$doc;
        $this->immobilisations=Doctrine_Core::getTable('immobilisation')->findByIdBureaux($idbureau);
        $this->setTemplate('show');
    }

    public function executeNew(sfWebRequest $request) {

        $this->datedebut=$request->getParameter('date_debut');
        $this->slt_bureau=$request->getParameter('slt_bureau');

        $idbureau=$this->slt_bureau;
        $this->immobilisations=Doctrine_Core::getTable('immobilisation')->findByIdBureaux($idbureau);
        $document=new Document();
        $documents=Doctrine_Core::getTable('document')->findOneByIdBureauAndDatedoc($idbureau,$this->datedebut);
        if($documents) {
            $connection = Doctrine_Manager::connection();
            $query = "DELETE FROM inventairedoc WHERE id_doc=".$documents->getId();
            $connection->execute($query);
            $document=$documents;
        }
        $document->setDatedoc(date('Y-m-d',strtotime($this->datedebut)));
//_________
        $documents=Doctrine_Core::getTable('document')->findAll();
        $nbcount=date("y",strtotime(date("Y-m-d")))."000".count($documents);
        $document->setNumero($nbcount);
        $document->setIdBureau($idbureau);
        $document->save();
        $this->doc=$document;

        $this->VerifInventaire($document,$this->slt_bureau);
        $this->setTemplate('new');
    }
    public function VerifInventaire($document,$id_bureaux) {
        // die("gg".$_FILES['filecodebarre']['tmp_name']);
        $tmp_name = $_FILES['filecodebarre']['tmp_name'];
        $name =  $_FILES['filecodebarre']['name'];

        move_uploaded_file($tmp_name, "uploads/import/".$name);
        $arrLines = file('uploads/import/'.$name);
        $bureau_inventaire=Doctrine_Core::getTable('bureaux')->findOneById($id_bureaux);
        //  die($bureau_inventaire);
        foreach($arrLines as $line) {
            //die($line);
            $arrResult = explode( ',', $line);

            $codeburaeux=str_replace('"', '', $arrResult[0]);
            $codeburaeux=str_replace("2017", "", $codeburaeux);
            // die( $codeburaeux);
            $codebaree=trim(str_replace('"','',$arrResult[1]));
            // die($codebaree);
            $bureau_fichiers=Doctrine_Core::getTable('bureaux')->findAll();
            $trouve=0;

            foreach($bureau_fichiers as $bureau_fichier) {
                if($bureau_fichier->getCode()-$codeburaeux==0)
                    $trouve=$bureau_fichier->getId();
            }
            if($trouve!=0) {
                $bureau_fichier=Doctrine_Core::getTable('bureaux')->findOneById($trouve);
                // die($bureau_fichier);

                if($bureau_fichier) {

                    if($bureau_fichier->getId()==$bureau_inventaire->getId()) {
                        //die($bureau_fichier->getId().'=='.$bureau_inventaire->getId());
                        // die($codebaree.'---'.$bureau_fichier->getId());

                        $emplacement=Doctrine_Core::getTable('emplacement')->findOneByReferenceAndIdBureau($codebaree,$bureau_fichier->getId());
                        //die($document->getId().','.$emplacement->getId());
                        if($emplacement) {
                            $verifinventaire=new Inventairedoc();
                            $inventaire=Doctrine_Core::getTable('inventairedoc')->findOneByIdDocAndIdEmpl($document->getId(),$emplacement->getId());
                            // die($inventaire.'hh');
                            if($inventaire)
                                $verifinventaire=$inventaire;
                            $verifinventaire->setIdDoc($document->getId());
                            // die($emplacement->getId().'hh');
                            $verifinventaire->setIdEmpl($emplacement->getId());

                            $verifinventaire->setQteexstant(1);
                            $verifinventaire->setQtereel(1);
                            $verifinventaire->setEcart(0);
                            $verifinventaire->save();
                        }
                    }
                    else {
                        // die($codebaree);
                        $emplacements=Doctrine_Core::getTable('emplacement')->findByReference($codebaree);

                        $chaine="Votre Bien se trouve:<br>";
                        $trouve_rech=0;

                        $bureau_recherche=Doctrine_Core::getTable('bureaux')->findOneById($codeburaeux);
                        //die($bureau_recherche);
                        if($bureau_recherche) {
                            $chaine.=$bureau_recherche."<br>";
                            foreach($emplacements as $empl) {
                                $trouve_rech=$empl->getId();
                            }

                            $verifinventaire=new Inventairedoc();
                            $verifinventaire->setIdDoc($document->getId());
                            $verifinventaire->setIdEmpl($trouve_rech);
                            $verifinventaire->setQteexstant(0);
                            $verifinventaire->setQtereel(1);
                            $verifinventaire->setEcart(-1);
                            $verifinventaire->setRq($chaine);
                            $verifinventaire->save();
                        }
                    }
                }

            }else {
                //die($codebaree);
                $emplacement=Doctrine_Core::getTable('emplacement')->findOneByReference($codebaree);

                if($emplacement) {
                    $verifinventaire=new Inventairedoc();
                    $verifinventaire->setIdDoc($document->getId());
                    $verifinventaire->setIdEmpl($emplacement->getId());
//                $verifinventaire->setQteexstant(0);
//                $verifinventaire->setQtereel(1);
//                $verifinventaire->setEcart();
                    $verifinventaire->setRq("Votre Bien est Perdue?");
                    $verifinventaire->save();
                }
                // die($emplacement->getId());
            }
        }

    }
    public function GetArticleSite($iddoc,$idsite,$idfrs) {
//die($iddoc.','.$idsite.','.$idfrs);
//_____________id_doc idsite idfrs_______________
        if($iddoc!="-1"&&$idsite!="-1"&&$idfrs!="-1") {
            $docs=Doctrine_Core::getTable('document')->findByIdFrsAndId($idfrs,$iddoc);
//  die('co'.count($docs));
            $array_docs=array();
            $array_docs[0]=$iddoc;
            $i=1;
            foreach($docs as $d) {
                $array_docs[$i]=$d->getId();
                $i++;
            }
            $articlesites=Doctrine_Core::getTable('articlesite')
                    ->createQuery('a')
                    ->whereIn('id_doc',$array_docs)
                    ->andwhere('id_site='.$idsite);

        }
//_____________idsite idfrs_______________
        if($iddoc=="-1"&&$idsite!="-1"&&$idfrs!="-1") {
            $docs=Doctrine_Core::getTable('document')->findByIdFrs($idfrs);
            $array_docs=array();
            $i=0;
            foreach($docs as $d) {
                $array_docs[$i]=$d->getId();
                $i++;
            }
            $articlesites_parents=Doctrine_Core::getTable('articlesite')
                    ->createQuery('a')
                    ->whereIn('id_doc',$array_docs)->execute();
            $array_articlesite=array();
            $j=0;
            foreach($articlesites_parents as $art) {
                $array_articlesite[$j]=$art->getId();
                $j++;
            }
            $articlesites=Doctrine_Core::getTable('articlesite')
                    ->createQuery('a')
                    ->whereIn('id_articlesiteparent',$array_articlesite);


        }
//_____________idfrs_______________
        if($iddoc=="-1"&&$idsite=="-1"&&$idfrs!="-1") {
            $docs=Doctrine_Core::getTable('document')->findByIdFrs($idfrs);
// die("hh".count($docs));
            $array_docs=array();

            $i=0;
            foreach($docs as $d) {
                $array_docs[$i]=$d->getId();
                $i++;
            }
            $articlesites=Doctrine_Core::getTable('articlesite')
                    ->createQuery('a')
                    ->whereIn('id_doc',$array_docs);

        }
//____________________________
        if($iddoc=="-1"&&$idsite=="-1"&&$idfrs=="-1") {
            $articlesites=Doctrine_Core::getTable('articlesite')
                    ->createQuery('a');

        }
//_____________id_doc  idfrs_______________
        if($iddoc!="-1"&&$idsite=="-1"&&$idfrs!="-1") {
            $docs=Doctrine_Core::getTable('document')->findByIdFrsAndId($idfrs,$iddoc);
            $array_docs=array();
            $array_docs[0]=$iddoc;
            $i=1;
            foreach($docs as $d) {
                $array_docs[$i]=$d->getId();
                $i++;
            }
            $articlesites=Doctrine_Core::getTable('articlesite')
                    ->createQuery('a')
                    ->whereIn('id_doc',$array_docs);

        }
//_____________id_doc idsite _____________________
        if($iddoc!="-1"&&$idsite!="-1"&&$idfrs=="-1") {
            $articlesites=Doctrine_Core::getTable('articlesite')
                    ->createQuery('a')
                    ->where('id_doc='.$iddoc)
                    ->andwhere('id_site='.$idsite);

        }
//_____________id_doc _______________
        if($iddoc!="-1"&&$idsite=="-1"&&$idfrs=="-1") {
            $articlesites=Doctrine_Core::getTable('articlesite')
                    ->createQuery('a')
                    ->where('id_doc='.$iddoc);

        }
//_____________idsite_______________
        if($iddoc=="-1"&&$idsite!="-1"&&$idfrs=="-1") {
            $articlesites=Doctrine_Core::getTable('articlesite')
                    ->createQuery('a')
                    ->where('id_site='.$idsite);

        }
        $articlesites->orderBy('id desc');

        return $articlesites->orderBy('id desc');
    }
    public function RechercheById($id) {

        $documents= Doctrine_Core::getTable('document')
                ->createQuery('a')
                ->where('id='.$id)
                ->execute();
        return $documents[0];

    }
    public function NumeroDoc() {
        $documents= Doctrine_Core::getTable('document')
                ->createQuery('a')
                ->select('ifnull(max(numero),0) as maxnum ')
                ->execute();
        $maxdoc="16001";
        if($documents[0]['maxnum']!='0')
            $maxdoc=intval( $documents[0]['maxnum'])+1;

        return $maxdoc;
    }
    public function RechercheId($date,$idsite,$iddoc,$idfrs) {
        $inventaire=new Document();

//die($date.','.$iddoc.','.$idsite.','.$idfrs);
        if($iddoc!="-1"&&$idsite!="-1"&&$idfrs!="-1") {
            $documents= Doctrine_Core::getTable('document')
                    ->createQuery('a')
                    ->where('datedoc like "'.$date.'%"')
                    ->andwhere('id_typedoc=70')
                    ->andwhere('id_magarrive='.$idsite)
                    ->andwhere('id_trace='.$iddoc)
                    ->andwhere('id_frs='.$idfrs)
                    ->andwhere('etat_doc =0')->execute();
        }
        if($iddoc=="-1"&&$idsite!="-1"&&$idfrs!="-1") {
            $documents= Doctrine_Core::getTable('document')
                    ->createQuery('a')
                    ->where('datedoc like "'.$date.'%"')
                    ->andwhere('id_typedoc=70')
                    ->andwhere('id_magarrive='.$idsite)
                    ->andwhere('id_frs='.$idfrs)
                    ->andwhere('etat_doc =0')->execute();
        }
        if($iddoc=="-1"&&$idsite=="-1"&&$idfrs!="-1") {
            $documents= Doctrine_Core::getTable('document')
                    ->createQuery('a')
                    ->where('datedoc like "'.$date.'%"')
                    ->andwhere('id_typedoc=70')

                    ->andwhere('id_frs='.$idfrs)
                    ->andwhere('etat_doc =0')->execute();
        }
        if($iddoc=="-1"&&$idsite=="-1"&&$idfrs=="-1") {
            $documents= Doctrine_Core::getTable('document')
                    ->createQuery('a')
                    ->where('datedoc like "'.$date.'%"')
                    ->andwhere('id_typedoc=70')
                    ->andwhere('etat_doc =0')->execute();
        }
        if($iddoc!="-1"&&$idsite=="-1"&&$idfrs!="-1") {
            $documents= Doctrine_Core::getTable('document')
                    ->createQuery('a')
                    ->where('datedoc like "'.$date.'%"')
                    ->andwhere('id_typedoc=70')

                    ->andwhere('id_trace='.$iddoc)
                    ->andwhere('id_frs='.$idfrs)
                    ->andwhere('etat_doc =0')->execute();
        }
        if($iddoc!="-1"&&$idsite!="-1"&&$idfrs=="-1") {
            $documents= Doctrine_Core::getTable('document')
                    ->createQuery('a')
                    ->where('datedoc like "'.$date.'%"')
                    ->andwhere('id_typedoc=70')
                    ->andwhere('id_magarrive='.$idsite)
                    ->andwhere('id_trace='.$iddoc)

                    ->andwhere('etat_doc =0')->execute();
        }
        if($iddoc!="-1"&&$idsite=="-1"&&$idfrs=="-1") {
            $documents= Doctrine_Core::getTable('document')
                    ->createQuery('a')
                    ->where('datedoc like "'.$date.'%"')
                    ->andwhere('id_typedoc=70')

                    ->andwhere('id_trace='.$iddoc)

                    ->andwhere('etat_doc =0')->execute();
        }
        if($iddoc=="-1"&&$idsite!="-1"&&$idfrs!="-1") {
            $documents= Doctrine_Core::getTable('document')
                    ->createQuery('a')
                    ->where('datedoc like "'.$date.'%"')
                    ->andwhere('id_typedoc=70')

                    ->andwhere('id_magarrive='.$idsite)
                    ->andwhere('id_frs='.$idfrs)
                    ->andwhere('etat_doc =0')->execute();
        }

        if($iddoc=="-1"&&$idsite!="-1"&&$idfrs=="-1") {
            $documents= Doctrine_Core::getTable('document')
                    ->createQuery('a')
                    ->where('datedoc like "'.$date.'%"')
                    ->andwhere('id_typedoc=70')
                    ->andwhere('id_magarrive='.$idsite)
                    ->andwhere('etat_doc =0')->execute();
        }

        if(count($documents)==0) {
            $inventaire->setIdTypedoc(70);

            $dd=date("Y-m-d",strtotime($date));
            if($iddoc!="-1")
                $inventaire->setIdTrace($iddoc);
            if($idsite!="-1")
                $inventaire->setIdMagarrive($idsite);
            if($idfrs)
                $inventaire->setIdFrs($idfrs);
            $inventaire->setDatedoc($dd);

            $inventaire->setNumero($this->NumeroDoc());

            $inventaire->setEtatDoc(0);
        }
        else {
            $inventaire=$documents[count($documents)-1];

        }
        $inventaire->save();
        return $inventaire->getId();

    }
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new articlesiteForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
//        $this->forward404Unless($articlesite = Doctrine_Core::getTable('articlesite')->find(array($request->getParameter('id'))), sprintf('Object articlesite does not exist (%s).', $request->getParameter('id')));
//        $this->form = new articlesiteForm($articlesite);
        $this->sites = Doctrine_Core::getTable('site')->findAll();
        $this->frs = Doctrine_Core::getTable('fournisseur')->findAll();
        $this->docs = Doctrine_Core::getTable('document')
                ->createQuery('a')
                ->where('id_typedoc=68 or id_typedoc=69')
                ->execute();
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($articlesite = Doctrine_Core::getTable('articlesite')->find(array($request->getParameter('id'))), sprintf('Object articlesite does not exist (%s).', $request->getParameter('id')));
        $this->form = new articlesiteForm($articlesite);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($articlesite = Doctrine_Core::getTable('articlesite')->find(array($request->getParameter('id'))), sprintf('Object articlesite does not exist (%s).', $request->getParameter('id')));
        $articlesite->delete();

        $this->redirect('Inventaire/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $articlesite = $form->save();

            $this->redirect('Inventaire/edit?id='.$articlesite->getId());
        }
    }
    public function executeChargerinventaire(sfWebRequest $request) {
        if(!isset($_REQUEST['func'])) {
            $id_artsite=$_REQUEST['id_artsite'];
            $id_doc=$_REQUEST['iddoc'];
            $qte=$_REQUEST['qte'];
            $articlesites=Doctrine_Core::getTable('articlesite')->findById($id_artsite);
            $art=new Articlesite();
            $art=$articlesites[0];
            $art_inv=new Articlesiteinventaire();
            $art_site_invs=Doctrine_Core::getTable('articlesiteinventaire')
                    ->createQuery('a')
                    ->where('id_articlesite='.$id_artsite)
                    ->andwhere('id_doc='.$id_doc)
                    ->andwhere('id_site='.$art->getIdSite())
                    ->execute();
            if(count($art_site_invs)>0)
                $art_inv=$art_site_invs[0];
            $art_inv->setIdArticlesite($id_artsite);
            $art_inv->setIdSite($art->getIdSite());
            $art_inv->setIdDoc($id_doc);
            $art_inv->setQtereel($qte);
            $art_inv->setQtetheorique($art->getMaxsto());

            $ecart=$qte-$art->getMaxsto();
            $art_inv->setEcart($ecart);
            $art_inv->save();

//            $art->setMaxsto($qte);
            $art->save();

            $htmlrendue=$art_inv->getEcart()."-----".$art->getMaxsto()."-----";
            return $this->renderText($htmlrendue);
        }
        else {
            $id_site=$_REQUEST['idsite'];
            $txt_rech=$_REQUEST['txt_rech'];
// die($txt_rech);
            if($txt_rech!="") {

                $articlesites=Doctrine_Core::getTable('articlesite')
                        ->createQuery('a')
                        ->where('a.codebarre="'.$txt_rech.'"')
                        ->andwhere('id_site='.$id_site)
                        ->execute();
            }
            else {
                $articlesites=Doctrine_Core::getTable('articlesite')
                        ->createQuery('a')
                        ->where('id_site='.$id_site)
                        ->execute();
            }
            $htmlcontenu="";
            $art=new Articlesite();
            foreach ($articlesites as $articlesite) {
                $art=$articlesite;
                $htmlcontenu.='
                    <tr>
                        <td> '. $art->getCodebarre().'</td>
                        <td> '. $art->getArticle()->getItmdes1().'  </td>
                        <td> '. $art->getTaille().' </td>
                        <td> '. $art->getCouleur().' </td>
                        <td><p id="max_'.$art->getId().'"> '.$art->getMaxsto().' </p></td>';




                $htmlcontenu.='
                        <td><input type="text" id="txt_'. $art->getId().'"  style="width: 40px" onchange="modifierinventaire('.$art->getId().',this.value)"> </td>
                        <td><p id="ecart_'.$art->getId().'">'.$art->getEcart().'</p></td>';

                $htmlcontenu.=' </tr>';
            }
            $htmlcontenu.='-----';
            return $this->renderText($htmlcontenu);
        }
    }
    public function executeImprimerdoc(sfWebRequest $request) {
        $document = Doctrine_Core::getTable('document')->findOneById($request->getParameter('id'));
        $immobilisations=Doctrine_Core::getTable('immobilisation')->findByIdBureaux($request->getParameter('idbur'));

        return $this->renderPartial('Inventaire/impression', array('immobilisations' =>$immobilisations,'doc'=>$document ));
    }
    
    public function executeImprimerFiche(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');
        $idbur = $request->getParameter('idbur');

        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Inventaire');
        $pdf->SetSubject("Fiche Inventaire");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
       $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
       $soc = $societe;
        $entete =  $soc->getMinistere();
        $rs=$soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(10, 30, 10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlFiche($id, $idbur);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Fiche Inventaire' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFiche($id, $idbur) {
        $html = StyleCssHeader::header1();
        $document = new Document();
        $html .= $document->ReadHtmlFiche($id, $idbur);

        return $html;
    }

}
