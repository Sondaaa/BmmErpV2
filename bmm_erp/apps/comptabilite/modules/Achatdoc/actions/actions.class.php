<?php

require_once dirname(__FILE__) . '/../lib/AchatdocGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/AchatdocGeneratorHelper.class.php';

/**
 * Achatdoc actions.
 *
 * @package    symfony
 * @subpackage Achatdoc
 * @author     Your name here
 * @version    SVN: $Id$
 */
class AchatdocActions extends autoAchatdocActions
{
    public function executeShowSuivicommandeBCI(sfWebRequest $request)
    {
        $this->offset = 0;
        $this->start_date = date('Y-m-d', strtotime(date('Y/m/01')));
        $this->id_bci = null;
        if ($request->getParameter('start'))
            $this->start_date = date('Y-m-d', strtotime($request->getParameter('start')));
        $d = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
        $this->end_date = date('Y-m-d', strtotime(date("Y") . '-' . date("m") . '-' . $d));
        if ($request->getParameter('end'))
            $this->end_date = date('Y-m-d', strtotime($request->getParameter('end')));
        if ($request->getParameter('id_bci'))
            $this->id_bci = $request->getParameter('id_bci');
        $this->documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDate(4, 5, $this->offset, $this->start_date, $this->end_date, $this->id_bci);

        $this->AllBCI = DocumentachatTable::getInstance()->getAllBciByDate(4, $this->start_date, $this->end_date, $this->id_bci);
    }
    public function executeGetcommandebypager(sfWebRequest $request)
    {
        $params = array();
        $content = $request->getContent();
        $this->offset = 0;
        $this->start_date = date('Y-m-d', strtotime(date('Y/m/01')));
        $d = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
        $this->end_date = date('Y-m-d', strtotime(date("Y") . '-' . date("m") . '-' . $d));
        $id_bci = null;
        if (!empty($content)) {
            $params = json_decode($content, true);

            if ($params['start_date'])
                $this->start_date = date('Y-m-d', strtotime($params['start_date']));

            if ($params['end_date'])
                $this->end_date = date('Y-m-d', strtotime($params['end_date']));

            if ($params['offset']) {
                $this->offset = ($params['offset'] - 1) * 5;
            }
            if ($params['id_bci'] && is_numeric($params['id_bci'])) {
                $id_bci = intval($params['id_bci']);
            }
        }
        $documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDate(4, 5, $this->offset, $this->start_date, $this->end_date, $id_bci);

        return $this->renderPartial("listCommandes", array("documentachats" => $documentachats));
    }

    public function executeUploaderfile(sfWebRequest $request)
    {
        //header('Access-Control-Allow-Origin: *');
        $id = $_REQUEST['id'];
        $name =  $_FILES['fileSelected']['name'];
        $uploads_dir = sfConfig::get('sf_upload') . $name;
        move_uploaded_file($_FILES['fileSelected']['tmp_name'], $uploads_dir);

        $piece_joint = new Piecejoint();
        $piece_joint->setChemin($name);
        $piece_joint->setIdDocachat($id);
        $piece_joint->save();
        $this->redirect('Achatdoc/showdocument?iddoc=' . $id . '&idtab=1');
        // return  $this->redirect('url',200);
        return $this->renderText(json_encode(array(
            "valid" => 'upload success'
        )));
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->idtype = 4;
        if ($request->getParameter('idtype'))
            $this->idtype = $request->getParameter('idtype');

        $this->form = $this->configuration->getForm();
        $this->documentachat = $this->form->getObject();
        $this->documentachat->setIdTypedoc($this->idtype);
        $this->documentachat->setNumero($this->documentachat->NumeroSeqDocumentAchat(6));
        $this->documentachat->setDatecreation(date('Y-m-d'));
    }
    public function executeArticlebycodeanddesignation(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_naturedoc = $params['id_naturedoc'];
            $codearticle = $params['codearticle'];
            $id_emplacement = $params['id_emplacement'];
            $designation = strtoupper($params['designation']);
            if ($id_naturedoc != 1) {
                $q = Doctrine_Query::create()
                    ->select(" article.id,article.codeart as ref,trim( both '  ' from article.designation) as name")
                    ->from('article');
                $designation = str_replace("'", "''", $designation);
                if ($codearticle != "" && $designation == "")
                    $q = $q->where("codeart like '%" . $codearticle . "%'");
                if ($codearticle == "" && $designation != "")
                    $q = $q->Where("upper(designation) like '%" . $designation . "%'");
                if ($codearticle != "" && $designation != "")
                    $q = $q->Where("upper(designation) like '%" . $designation . "%'")
                        ->AndWhere("codeart like '%" . $codearticle . "%'");
                if ($id_emplacement != "" && $id_emplacement != "")
                    $q = $q->AndWhere('id_emplacement=' . $id_emplacement);
            } else {
                $user = $this->getUser()->getAttribute('userB2m');
                // $magasins = EtageTable::getInstance()->findAll();
                // $array_code = array();
                // $i = 0;
                // foreach ($magasins as $j_i) {
                //     $array_code[$i] = $j_i->getId();
                //     $i++;
                // }
                // $arrayMagasin = [];
                // $idmagasins = [];
                // if ($user->getIdMagasin()) {
                //     $arrayMagasin = json_decode($user->getIdMagasin());

                //     for ($i = 0; $i <= sizeof($arrayMagasin) - 1; $i++) :
                //         if (in_array($arrayMagasin[$i], $array_code)) :
                //             if (sizeof($idmagasins) == 0)
                //                 $idmagasins = $arrayMagasin[$i];
                //             else
                //                 $idmagasins = $idmagasins . ',' . $arrayMagasin[$i];
                //         endif;
                //     endfor;
                // }
                $idemplacement = $user->getAdministartionSite()->getId();
                //  die($idmagasins->getId() . "e");
                $q = Doctrine_Query::create()
                    ->select(" article.id,article.codeart as ref,trim( both '  ' from article.designation) as name")
                    ->from('article');
                $designation = str_replace("'", "''", $designation);
                if ($codearticle != "" && $designation == "")
                    $q = $q->where("codeart like '%" . $codearticle . "%'");
                if ($codearticle == "" && $designation != "")
                    $q = $q->Where("upper(designation) like '%" . $designation . "%'");
                if ($codearticle != "" && $designation != "")
                    $q = $q->Where("upper(designation) like '%" . $designation . "%'")
                        ->AndWhere("codeart like '%" . $codearticle . "%'");
                // if ($idmagasins)
                //     $q = $q->AndWhere('id_emplacement in (' . $idmagasins . ')');
                if ($idemplacement)
                    $q = $q->AndWhere('id_emplacement =' . $idemplacement);
            }
            $listesarticles = $q->fetchArray();
            die(json_encode($listesarticles));
        }
        die('bien');
    }
    protected function buildQuery()
    {
        $user = UtilisateurTable::getInstance()->find($this->getUser()->getAttribute('userB2m')->getId());
        $magasins = EtageTable::getInstance()->findAll();
        //   $id_emplacemnt = $user->getIdMagasin();
        $idmagasins = [];
        if ($user->getIdMagasin())
            $idmagasins = json_decode($user->getIdMagasin());

        $tableMethod = $this->configuration->getTableMethod();

        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);
        $filter = $this->getFilters();

        $query = $this->filters->buildQuery($this->getFilters());
        $documentsachat = Doctrine_Core::getTable('documentachat')
            ->createQuery('a')
            ->where('id_typedoc=4');
        if (isset($filter['reference']))
            $documentsachat = $documentsachat->Andwhere("reference like '%" . $filter['reference'] . "%'");
        if (isset($filter['numero']) && is_numeric($filter['numero']))
            $documentsachat = $documentsachat->Andwhere("numero = " . $filter['numero'] . "");
        if (isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        } elseif (isset($filter['datecreation']['from']) && !isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . date('Y') . "-12-31" . "'");
        } elseif (!isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . date('Y') . "-01-01" . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        } else {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . date('Y') . "-01-01" . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . date('Y') . "-12-31" . "'");
        }
        if ($idmagasins && count($idmagasins) > 0)
            $documentsachat = $documentsachat->AndwhereIn('id_emplacement ', $idmagasins);

        $query = $documentsachat->OrderBy('id desc');
        $this->addSortQuery($query);

        return $query;
    }

    public function executeSavedocument(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddemandeur = $params['id_utilisateur'];
            $idtypedoc = $params['typedoc'];
            $id_emplacement = $params['id_emplacement'];
            $ref = $params['ref'];
            $datecreation = $params['datecreation'];
            $listeslignesdoc = $params['listeslignesdoc'];
            $id_nature = $params['id_nature'];
            $montant_estimatif = $params['montant_estimatif'];
            $iddoc = $params['iddoc'];
            $is_valide = $params['is_valide'];

            $user = new Utilisateur();
            $user = $this->getUser()->getAttribute('userB2m');
            //die($valide);
            if ($iddoc == '') {
                //______________________ajouter document achat
                $documentachat = new Documentachat();
                $numero = $documentachat->NumeroSeqDocumentAchat(4);
                $documentachat->setNumero($numero);
                $documentachat->setIdEtatdoc(1);
            } else {
                //modifier document achat
                $documentachat = DocumentachatTable::getInstance()->find($iddoc);

                //Suppression All Lignedocachat && Qtelignedoc
                foreach ($documentachat->getLignedocachat() as $lignedocachat) {
                    foreach ($lignedocachat->getQtelignedoc() as $qtelignedoc) {
                        $qtelignedoc->delete();
                    }
                    $lignedocachat->delete();
                }
            }
            if ($iddemandeur)
                $documentachat->setIdDemandeur($iddemandeur);
            if ($id_nature && $id_nature != "")
                $documentachat->setIdNaturedoc($id_nature);
            if ($id_emplacement && $id_emplacement != "")
                $documentachat->setIdEmplacement($id_emplacement);
            if ($montant_estimatif && $montant_estimatif != "")
                $documentachat->setMontantestimatif($montant_estimatif);
            $documentachat->setIdTypedoc($idtypedoc);
            if ($ref)
                $documentachat->setReference($ref);
            if ($is_valide) {
                $documentachat->setValide(true);
                $documentachat->setIdEtatdoc(1);
            }
            if ($datecreation != "")
                $documentachat->setDatecreation($datecreation);
            else
                $documentachat->setDatecreation(date('Y-m-d'));

            $documentachat->save();

            foreach ($listeslignesdoc as $lignedoc) {

                $norgdre = $lignedoc['norgdre'];
                $qte = $lignedoc['quantite'];
                $codearticle = $lignedoc['codearticle'];
                $designation = $lignedoc['designation'];
                $stockable = $lignedoc['stockable'];
                $idprojet = $lignedoc['idprojet'];
                // $mid = $lignedoc['mid'];
                $observation = $lignedoc['observation'];
                $unitedemander = $lignedoc['unitedemander'];
                $idunitemarche = $lignedoc['idunitemarche'];
                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                $lignedoc->setQte($qte);
                if ($observation && $observation != "")
                    $lignedoc->setObservation($observation);
                if ($unitedemander && $unitedemander != "")
                    $lignedoc->setUnitedemander($unitedemander);
                if ($idunitemarche && $idunitemarche != "")
                    $lignedoc->setIdUnitemarche($idunitemarche);
                if ($codearticle)
                    $lignedoc->setCodearticle($codearticle);
                if ($designation)
                    $lignedoc->setDesignationarticle($designation);

                //____________________________________rech article en stock
                if ($designation != "") {
                    $lignedoc->setDesignationarticle($designation);
                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
                    if ($article) {
                        $lignedoc->setIdArticlestock($article->getId());
                        $lignedoc->setCodearticle($article->getCodeart());
                    }
                }
                if ($designation != "") {
                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
                    if ($article)
                        $lignedoc->setIdArticlestock($article->getId());
                    else {

                        $article = new Article();

                        $article->setDatecreation(date('Y-m-d'));
                        $article->setIdUser($user->getId());
                        if ($designation && $designation != "")
                            $article->setDesignation($designation);

                        if ($stockable == 'true')
                            $article->setStocable(true);
                        else
                            $article->setStocable(false);
                        if ($id_nature == 1)
                            $article->setStocable(true);

                        if ($idunitemarche && $idunitemarche != "")
                            $article->setIdUnite($idunitemarche);
                        if ($id_emplacement && $id_emplacement != "")
                            $article->setIdEmplacement($id_emplacement);
                        if ($id_nature == 1) {
                            $idemplacement = $user->getAdministartionSite()->getId();
                            $article->setIdEmplacement($idemplacement);
                        }
                        $article->save();
                        $lignedoc->setIdArticlestock($article->getId());
                    }
                }

                // else
                //     $ligneplaning->setStocable(false);
                //_____________________________________Fin recherche
                if ($idprojet != '')
                    $lignedoc->setIdProjet($idprojet);
                $lignedoc->save();
                $lignedocqte = new Qtelignedoc();
                $lignedocqte->setQtedemander($qte);
                $lignedocqte->setIdLignedocachat($lignedoc->getId());
                $lignedocqte->save();
                $ErpHistorique = new Erphistorique();
                $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
            }

            $ErpHistorique = new Erphistorique();
            $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);
            die(trim($documentachat->getId()) . "");
        }
    }
    public function executeEdit(sfWebRequest $request)
    {
        $this->documentachat = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->documentachat);
    }
    public function executeShowdocument(sfWebRequest $request)
    {

        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');
        $iddoc = $request->getParameter('iddoc');
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')
            ->createQuery('a')
            ->where('id_doc=' . $iddoc)
            ->orderBy('id asc')->execute();
    }
    public function executeImprimerdocachat(sfWebRequest $request)
    {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $aviss = Doctrine_Core::getTable('avis')
            ->createQuery('a')->where('id_poste=5')
            ->orderBy('id asc')->execute();
        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

        $listesdocuments = Doctrine_Core::getTable('lignedocachat')
            ->createQuery('a')
            ->where('id_doc=' . $iddoc)->orderBy('id asc')->execute();
        //Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        // pdf object
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche D.I. N°:');
        $pdf->SetSubject("document d'achat");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);

        $pdf->SetAuthor($rs);

        $logo=PDF_HEADER_LOGO.'/'.$societe->getLogo();
        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, $entete,$rs, '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
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

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // dejavusans or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);
        //$pdf->SetFont('dejavusans', '', 12);
        // Add a page
        // This method has several options, check the source code documentation for more information.

        $pdf->AddPage();
        //      


        $html = $this->ReadHtml($societe, $aviss, $documentachat, $listesdocuments);

        // Print text using writeHTMLCell()
        // output the HTML content

        $pdf->writeHTML($html, true, false, true, false, '');
        $visaas = Doctrine_Core::getTable('ligavissig')->findByIdDoc($documentachat->getId());
        $conteurtext = 10;
        $conteurcercle = 250;
        foreach ($visaas as $visa) {
            $visaachat = new Visaachat();
            $vi = Doctrine_Core::getTable('visaachat')->findOneById($visa->getIdVisa());
            if ($vi) {
                $visaachat = $vi;
                $cheminimage = sfconfig::get('sf_appdir') . 'uploads/images/' . $visaachat->getChemin();
                //                $pdf->Image($cheminimage, $conteurtext - 5, $conteurcercle - 15, 30, 30, 'JPG', '', '', true, 50, '', false, false, 0, false, false, false);
                $pdf->Text($conteurtext, $conteurcercle + 10, $visa->getDatevisa());
                $pdf->Text($conteurtext, $conteurcercle + 15, $visaachat);
                // $pdf->Text($conteurtext, $conteurcercle+25, $visaachat->getAgents());
                // $pdf->Circle($conteurtext + 10, $conteurcercle, 15);

                $conteurtext += 25;
            }
        }
        //        ob_end_clean();
        //          $pdf->Footer();
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('documentachat' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtml($societe, $aviss, $documentachat, $listesdocuments)
    {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBonCommandeInterneLAbo($aviss, $listesdocuments);
        return $html;
    }

    public function executeAfficherPartial(sfWebRequest $request)
    {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("Achatdoc/listearticles");
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $iddoc = $request->getParameter('id');
        $documentachat = DocumentachatTable::getInstance()->find($iddoc);

        //Suppression All Lignedocachat && Qtelignedoc
        foreach ($documentachat->getLignedocachat() as $lignedocachat) {
            foreach ($lignedocachat->getQtelignedoc() as $qtelignedoc) {
                $qtelignedoc->delete();
            }
            $lignedocachat->delete();
        }


        $this->forward404Unless($documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id'))), sprintf('Object fiche does not exist (%s).', $request->getParameter('id')));
        $documentachat->delete();

        $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        $this->redirect('Achatdoc/index');
    }
}
