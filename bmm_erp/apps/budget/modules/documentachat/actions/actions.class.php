
<?php

require_once dirname(__FILE__) . '/../lib/documentachatGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/documentachatGeneratorHelper.class.php';

/**
 * documentachat actions.
 *
 * @package    Bmm
 * @subpackage documentachat
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class documentachatActions extends autoDocumentachatActions
{

    public function executeNew(sfWebRequest $request)
    {
        $this->idtype = 6;
        if ($request->getParameter('idtype')) {
            $this->idtype = $request->getParameter('idtype');
        }

        $this->form = $this->configuration->getForm();
        $this->documentachat = $this->form->getObject();

        $this->documentachat->setIdTypedoc($this->idtype);
        // die($this->documentachat->NumeroSeqDocumentAchat().'hh');
        $this->documentachat->setNumero($this->documentachat->NumeroSeqDocumentAchat(6, $_SESSION['exercice_budget']));
        $date = $_SESSION['exercice_budget'] . date('-m-d');
        $this->documentachat->setDatecreation($date);
    }

    public function executeEdit(sfWebRequest $request)
    {
        $id = $request->getParameter('id');
        $this->documentachat = DocumentachatTable::getInstance()->find($id);
//        $this->documentachat = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->documentachat);
    }

    //______________________________________________________________________Réquette affichier listes documents desc
    protected function buildQuery111()
    {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());

        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();
        $query = $query->AndWhere('id_etatdoc=3')->OrderBy('id desc');
        return $query;
    }

    //_________________________________________________Ajouter nouveau fiche par type: BCI
    public function executeSavedocument(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddemandeur = $params['id_utilisateur'];
            $idtypedoc = $params['typedoc'];
            $ref = $params['ref'];
            $datecreation = $params['datecreation'];
            $listeslignesdoc = $params['listeslignesdoc'];

            $user = new Utilisateur();
            $user = $this->getUser()->getAttribute('userB2m');
            //______________________ajouter document achat
            $documentachat = new Documentachat();
            $numero = $documentachat->NumeroSeqDocumentAchat($idtypedoc, $_SESSION['exercice_budget']);
            $documentachat->setNumero($numero);
            $documentachat->setIdDemandeur($iddemandeur);
            $documentachat->setIdTypedoc($idtypedoc);
            if ($ref) {
                $documentachat->setReference($ref);
            }

            $documentachat->setIdEtatdoc(1);
            if ($datecreation != "") {
                $documentachat->setDatecreation($datecreation);
            } else {
                $documentachat->setDatecreation(date('Y-m-d'));
            }

            $documentachat->save();

            foreach ($listeslignesdoc as $lignedoc) {

                $norgdre = $lignedoc['norgdre'];
                $qte = $lignedoc['quantite'];
                $codearticle = $lignedoc['codearticle'];
                $designation = $lignedoc['designation'];
                $motif = $lignedoc['motif'];
                $projet = $lignedoc['projet'];
                $idprojet = $lignedoc['idprojet'];
                $mid = $lignedoc['mid'];

                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                $lignedoc->setEtatligne("EnCours");
                $lignedoc->setQtedemander($qte);

                if ($codearticle) {
                    $lignedoc->setCodearticle($codearticle);
                }

                if ($designation) {
                    $lignedoc->setDesignationarticle($designation);
                }

                //____________________________________rech article en stock
                $article = Doctrine_Core::getTable('article')->findOneByCodearticleAndDeseignation($codearticle, $designation);
                if ($article) {
                    $lignedoc->setIdArticlestock($article->getId());
                }

                //_____________________________________Fin recherche
                $lignedoc->setIdProjet($idprojet);
                $lignedoc->setImpbudget($motif);
                //___________________________________rech motif par budget et par projet
                $motifparprojet = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubriqueAndIdProjet($mid, $idprojet);
                if ($motifparprojet) {
                    $lignedoc->setCodebudget($motifparprojet->getId());
                }

                $lignedoc->save();

                $ErpHistorique = new Erphistorique();
                $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
            }

            $ErpHistorique = new Erphistorique();
            $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);
            die("/iddoc/" . $documentachat->getId());
        }
    }

    //__________________________________________________Afficher document
    public function executeShowdocument(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

    public function executeShowdocumentBDCR(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

        $iddoc = $request->getParameter('iddoc');
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

    public function executeShowdocumentAvecQuitance(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

        $iddoc = $request->getParameter('iddoc');
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        $this->quitance = LigneoperationcaisseTable::getInstance()->findOneByIdDocachat($iddoc);
    }

    //__________________________________________________Envoie fiche vers stock et patrimoine
    public function executeValideretenvoyer(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

        if ($request->getParameter('iddoc') && $request->getParameter('btn') && $request->getParameter('btn') == "envoyer") {
            //______________________________Mis a jour document
            $documentachat = new Documentachat();
            $da = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('iddoc'));
            if ($da) {
                $documentachat = $da;

                if ($documentachat->getIdTypedoc() != 9 && $documentachat->getIdTypedoc() != 6) {
                    $documentachat->setIdEtatdoc(9);
                } else if ($documentachat->getIdTypedoc() == 6) {
                    $documentachat->setIdEtatdoc(22);
                } else {
                    $documentachat->setIdEtatdoc(6);
                }

                $documentachat->save();
            }
            $this->redirect('@documentachat');
        }
        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

    //____________________________________________________Valider ligne
    public function executeValiderligne(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $actionpour = $params['valip'];
            $idligne = $params['id'];
            $iddoc = $params['iddoc'];
            $reliquat = $params['reliquat'];
            $id = $params['id'];
            $id_ligprotitub = $params['id_ligprotitub'];
            $doc_achat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
            $doc_achat->setEtatdocachat(null);
            $doc_achat->setIdEtatdoc(35);
            $doc_achat->save();
            $ligneavisdoc = new Ligavisdoc();
            if ($id) {
                $lgdoc = Doctrine_Core::getTable('ligavisdoc')->findOneByIdDocAndIdAvis($iddoc, $id);
            } else {
                $lgdoc = Doctrine_Core::getTable('ligavisdoc')->findOneByIdDoc($iddoc);
            }

            if ($lgdoc) {
                $ligneavisdoc = $lgdoc;
            }
            if ($actionpour > 0) {
                if ($id) {
                    $ligneavisdoc->setIdAvis($id);
                }

                if ($iddoc) {
                    $ligneavisdoc->setIdDoc($iddoc);
                }

                if ($id_ligprotitub != '' && $id_ligprotitub != 0) {
                    $ligneavisdoc->setIdLigprotitrub($id_ligprotitub);
                }

                if ($reliquat) {
                    $ligneavisdoc->setMntdisponible($reliquat);
                }

                $ligneavisdoc->setDatecreation(date('Y-m-d'));
                $ligneavisdoc->save();
            } else {
                Doctrine_Query::create()->delete('ligavisdoc')
                    ->where('id_doc=' . $iddoc)
                    ->AndWhere('id_avis=' . $id)->execute();
                die('Suppression avec succès...');
            }
        }
        die('Mise à jour effectuée avec succès...');
    }

//validation rubrique budgetaire engage provisoirement
    public function executeValiderligneProvisoire(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $actionpour = $params['valip'];
            $idligne = $params['id'];
            $iddoc = $params['iddoc'];
            $reliquat = $params['reliquat'];
            $id_ligprotitub = $params['id_ligprotitub'];
            $doc_achat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
            $doc_achat->setEtatdocachat(null);

            if ($doc_achat->getIdTypedoc() != 22) {
                $doc_achat->setIdEtatdoc(54);
            } else {
                $doc_achat->setIdEtatdoc(67);
            }

            $doc_achat->save();
            $picejointbudget = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($iddoc);
            $documentbudget = DocumentbudgetTable::getInstance()->find($picejointbudget->getIdDocumentbudget());
            /*             * ***********annulation doc bugdet ********** */
            $documentbudget->setAnnule(true);
            $documentbudget->save();
            /*             * ****************update ligprotorub ***************** */
            $ligprotitrub_ancien = LigprotitrubTable::getInstance()->find($documentbudget->getIdBudget());
            $mnt_provisoire = $ligprotitrub_ancien->getMntprovisoire();
            $mnt_engage_provi = $documentbudget->getMnt();
            $mnt_nv_ligp_provisoire = $mnt_provisoire - $mnt_engage_provi;
            $ligprotitrub_ancien->setMntprovisoire($mnt_nv_ligp_provisoire);
            $ligprotitrub_ancien->save();
            /*             * *****************nouveu document budget ****
             *  nv piecejoint ****** edit ligprototrub ****************** */
            $lig_nouveau = LigprotitrubTable::getInstance()->find($id_ligprotitub);
            $mnt_provisoire = 0;
            if ($lig_nouveau->getMntprovisoire()) {
                $mnt_provisoire = $lig_nouveau->getMntprovisoire();
            }

            $mnt_provisoire += $documentbudget->getMnt();
            $lig_nouveau->setMntprovisoire($mnt_provisoire);
            $lig_nouveau->save();
            $doc = new Documentbudget();
            $doc->setIdType($documentbudget->getIdType());
            $doc->setNumero($documentbudget->getNumero());
            $doc->setDatecreation($documentbudget->getDatecreation());
            $doc->setIdBudget($id_ligprotitub);
            $doc->setMnt($documentbudget->getMnt());
            $doc->setMntnet($documentbudget->getMntnet());
            $doc->setMntengage($documentbudget->getMntengage());
            $relicat = $lig_nouveau->getMnt() - ($lig_nouveau->getMntprovisoire() + $lig_nouveau->getMntengage());
            $doc->setMntrelicat($relicat);
            $doc->save();
            $piecej = new Piecejointbudget();
            //  $picejointbudget
            $piecej->setIdDocachat($picejointbudget->getIdDocachat());
            $piecej->setIdType($picejointbudget->getIdType());
            $piecej->setDescription($picejointbudget->getDescription());
            $piecej->setIdDocumentbudget($doc->getId()); //die('gg');
            $piecej->save();
            //  $piecej->NouvelleInsertionDocAchatParDocumentBudget($iddoc_achat, $idtypep, $desc, $doc->getId());

            /*             * **************************** */
//            if (sizeof($picejointbudget) > 0 && sizeof($documentbudget)) {
            //                if ($id_ligprotitub != '' && $id_ligprotitub != 0)
            //                    $documentbudget->setIdBudget($id_ligprotitub);
            //                $documentbudget->save();
            //            }
            die('Mise à jour effectuée avec succès...');
        }
    }

    public function executeValiderligneDef(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $actionpour = $params['valip'];
            $idligne = $params['id'];
            $iddoc = $params['iddoc'];
            $reliquat = $params['reliquat'];
            $id_ligprotitub = $params['id_ligprotitub'];
            $doc_achat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
            $doc_achat->setEtatdocachat(null);
            $doc_achat->setIdEtatdoc(73);
            $doc_achat->save();

            $picejointbudget = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($iddoc);
            $documentbudget = DocumentbudgetTable::getInstance()->find($picejointbudget->getIdDocumentbudget());
            /*             * ***********annulation doc bugdet ********** */
            $documentbudget->setAnnule(true);
            $documentbudget->save();
            /*             * ****************update ligprotorub ***************** */
            $ligprotitrub_ancien = LigprotitrubTable::getInstance()->find($documentbudget->getIdBudget());
            $mnt_engage = $ligprotitrub_ancien->getMntengage();
            $mnt_engage_def = $documentbudget->getMnt();
            $mnt_nv_ligp_def = $mnt_engage - $mnt_engage_def;
            $ligprotitrub_ancien->setMntengage($mnt_nv_ligp_def);
            $ligprotitrub_ancien->save();
            /*             * *****************nouveu document budget ****
             *  nv piecejoint ****** edit ligprototrub ****************** */
            $lig_nouveau = LigprotitrubTable::getInstance()->find($id_ligprotitub);
            $mnt_engage = 0;
            if ($lig_nouveau->getMntengage()) {
                $mnt_engage = $lig_nouveau->getMntengage();
            }

            $mnt_engage += $documentbudget->getMnt();
            $lig_nouveau->setMntengage($mnt_engage);
            $lig_nouveau->save();
            $doc = new Documentbudget();
            $doc->setIdType($documentbudget->getIdType());
            $doc->setNumero($documentbudget->getNumero());
            $doc->setDatecreation($documentbudget->getDatecreation());
            $doc->setIdBudget($id_ligprotitub);
            $doc->setMnt($documentbudget->getMnt());
            $doc->setMntnet($documentbudget->getMntnet());
            $doc->setMntengage($documentbudget->getMntengage());
            $relicat = $lig_nouveau->getMnt() - ($lig_nouveau->getMntprovisoire() + $lig_nouveau->getMntengage());
            $doc->setMntrelicat($relicat);
            $doc->save();
            $piecej = new Piecejointbudget();
            //  $picejointbudget
            $piecej->setIdDocachat($picejointbudget->getIdDocachat());
            $piecej->setIdType($picejointbudget->getIdType());
            $piecej->setDescription($picejointbudget->getDescription());
            $piecej->setIdDocumentbudget($doc->getId()); //die('gg');
            $piecej->save();

//            $picejointbudget = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($iddoc);
            //            $documentbudget = DocumentbudgetTable::getInstance()->find($picejointbudget->getIdDocumentbudget());
            //            if (sizeof($picejointbudget) > 0 && sizeof($documentbudget)) {
            //                if ($id_ligprotitub != '' && $id_ligprotitub != 0)
            //                    $documentbudget->setIdBudget($id_ligprotitub);
            //                $documentbudget->save();
            //            }
            die('Mise à jour effectuée avec succès...');
        }
    }

    public function executeAfficheSumBCI(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_contrat = $params['id'];
            $query = " select SUM( CAST(coalesce(documentachat.mntttc) AS float)) as totalttc"
                . " from documentachat "
                . " where documentachat.id_contrat=" . $id_contrat
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $liste = $conn->fetchAssoc($query);
        }

        die("OK");
    }

    public function executeImprimerBDCProvisoire(sfWebRequest $request)
    {
        $iddoc = $request->getParameter('iddoc');
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche B.D.C Provisoire');
        $pdf->SetSubject("Fiche B.D.C Provisoire");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $logo = $soc->getLogo();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail()
        . '<br>Adresse:' . $soc->getAdresse() . '';
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);

        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //$pdf->setFooterData(array(0,64,0), array(0,64,128));
        $pdf->CustomFooter($adresse, '');
        // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 12, '', true);
        $pdf->AddPage();

        $html = $this->ReadHtmlBDCProvisoire($iddoc);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Fiche B.D.C Provisoire.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBDCProvisoire($iddoc)
    {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBDCProvisoire($iddoc);
        return $html;
    }
    
    public function executeImprimerdocachatJeton(sfWebRequest $request)
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

        $pdf->SetTitle('Fiche BCI N°:');
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
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

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
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
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

        $html = $this->ReadHtmlBcjeton($societe, $aviss, $documentachat, $listesdocuments);

        // Print text using writeHTMLCell()
        // output the HTML content
        //ob_end_clean();
        $pdf->writeHTML($html, true, false, true, false, '');
        $visaas = Doctrine_Core::getTable('ligavissig')->findByIdDoc($documentachat->getId());
        $conteurtext = 15;
        $conteurcercle = 250;
        foreach ($visaas as $visa) {
            $visaachat = new Visaachat();
            $vi = Doctrine_Core::getTable('visaachat')->findOneById($visa->getIdVisa());
            if ($vi) {
                $visaachat = $vi;
                $cheminimage = sfconfig::get('sf_appdir') . 'uploads/images/' . $visaachat->getChemin();
                $pdf->Image($cheminimage, $conteurtext - 5, $conteurcercle - 15, 30, 30, 'JPG', '', '', true, 50, '', false, false, 0, false, false, false);
                $pdf->Text($conteurtext, $conteurcercle + 10, $visa->getDatevisa());
                $pdf->Text($conteurtext, $conteurcercle + 15, $visaachat);
                // $pdf->Text($conteurtext, $conteurcercle+25, $visaachat->getAgents());
                // $pdf->Circle($conteurtext + 10, $conteurcercle, 15);

                $conteurtext += 35;
            }
        }

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('documentachat' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBcjeton($societe, $aviss, $documentachat, $listesdocuments)
    {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBCEDefinitif($documentachat->getId());

        return $html;
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

        $pdf->SetTitle('Fiche BCI N°:');
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
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

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
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
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
        //ob_end_clean();
        $pdf->writeHTML($html, true, false, true, false, '');
        $visaas = Doctrine_Core::getTable('ligavissig')->findByIdDoc($documentachat->getId());
        $conteurtext = 15;
        $conteurcercle = 250;
        foreach ($visaas as $visa) {
            $visaachat = new Visaachat();
            $vi = Doctrine_Core::getTable('visaachat')->findOneById($visa->getIdVisa());
            if ($vi) {
                $visaachat = $vi;
                $cheminimage = sfconfig::get('sf_appdir') . 'uploads/images/' . $visaachat->getChemin();
                $pdf->Image($cheminimage, $conteurtext - 5, $conteurcercle - 15, 30, 30, 'JPG', '', '', true, 50, '', false, false, 0, false, false, false);
                $pdf->Text($conteurtext, $conteurcercle + 10, $visa->getDatevisa());
                $pdf->Text($conteurtext, $conteurcercle + 15, $visaachat);
                // $pdf->Text($conteurtext, $conteurcercle+25, $visaachat->getAgents());
                // $pdf->Circle($conteurtext + 10, $conteurcercle, 15);

                $conteurtext += 35;
            }
        }

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
        $html .= $documentachat->ReadHtmlBonCommandeInterne($aviss, $listesdocuments);

        return $html;
    }

    public function executeGetListeAnnuleNonValide(sfWebRequest $request)
    {
        $query = "select documentachatannulation.id as id, documentachatannulation.dateannulation as date,"
        . " LPAD(documentachat.numero::text, 7, '0') as numero, typedoc.prefixetype as type, "
        . " concat(agents.nomcomplet,' ',agents.prenom ,' ',agents.idrh) as user"
        . " from documentachatannulation, documentachat, utilisateur, agents, typedoc "
        . " where documentachatannulation.id_documentachat=documentachat.id and "
        . " documentachat.id_typedoc=typedoc.id "
        . " AND documentachatannulation.id_user = utilisateur.id"
        . " and utilisateur.id_parent=agents.id"
        . " AND utilisateur.id_parent = agents.id "
        . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
            . " AND documentachatannulation.valide_budget = false "
            . "  order by documentachatannulation.id desc ";
//die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListeJeton(sfWebRequest $request)
    {
        $year = date('Y');
        // $q = Doctrine_Query::create()
        //     ->select("da.id as id, da.numero as numero, da.id_docparent as iddocparent"
        //         . " ,concat( fournisseur.codefrs ,fournisseur.rs) as raisonsocial, t.prefixetype as type")
        //     ->from('Documentachat da,fournisseur ,Typedoc t')
        // // ->leftJoin('da.Fournisseur f')
        //     //->leftJoin('da.')
        //     ->Where('da.id_typedoc = 16')
        //     ->andWhere('da.id_frs = fournisseur.id')
        //     ->andWhere('da.id_typedoc = t.id')
        //     ->andWhere('da.etatdocachat IS NULL')
        //     ->andWhere("datecreation >= '" . $year . "-01-01'")
        //     ->andWhere("datecreation <= '" . $year . "-12-31'")
        //     ->orderBy('da.numero desc');
        //die($q);
        //$q->fetchArray();
        $query = "select
        documentachat.id as id, documentachat.numero as numero,
        documentachat.id_docparent as iddocparent"
            . " ,concat( fournisseur.codefrs,' ' ,fournisseur.rs) as raisonsocial,
        typedoc.prefixetype as type, documentachat.mntttc as mntttc"
            . " from documentachat  ,fournisseur ,typedoc  "
            . " where documentachat.id_typedoc = 16 "
            . " and documentachat.id_typedoc=typedoc.id "
            . " and documentachat.id_frs = fournisseur.id "
            . " and documentachat.etatdocachat IS NULL"
            . " and documentachat.id_etatdoc is null"
            . " and documentachat.datecreation >= '" . $year . "-01-01'"
            . " and documentachat.datecreation <= '" . $year . "-12-31'"
            . " order By documentachat.numero desc ";
//die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourAvis(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_typedoc = $params['id_typedoc'];
            $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero, typedoc.prefixetype as type"
            . " from documentachat, typedoc "
            . " where documentachat.etatdocachat IS NULL "
            . " AND documentachat.id_typedoc=typedoc.id "
            . " AND documentachat.id_etatdoc = 24"
            . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
                . " and documentachat.id_contrat is null"
                . " AND documentachat.valide= true"
                . " AND documentachat.id_typedoc = " . $id_typedoc
                . " order by documentachat.id desc ";
//die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        die('rien');
    }

    public function executeGetListePourAvisMarche(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_typedoc = $params['id_typedoc'];
            $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero, typedoc.prefixetype as type"
            . " from documentachat, typedoc "
            . " where documentachat.etatdocachat IS NULL "
            . " AND documentachat.id_typedoc=typedoc.id "
            . " AND documentachat.id_etatdoc = 1"
            . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
//                    . " AND documentachat.valide= true"
             . " AND documentachat.id_typedoc = " . $id_typedoc
                . " order by documentachat.id desc ";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        die('rien');
    }

    public function executeGetListePourAvisRefuseBudget(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_typedoc = $params['id_typedoc'];

            $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero,"
            . " typedoc.prefixetype as type"
            . " from documentachat, typedoc "
            . " where documentachat.id_typedoc=typedoc.id "
            . " AND documentachat.id_etatdoc = 34"
            . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
                . " AND documentachat.id_typedoc = " . $id_typedoc
                . " order by documentachat.id desc ";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        die('rien');
    }

    public function executeGetListePourAvisRefuseBudgetBCEBDC(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_typedoc = $params['id_typedoc'];

            $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero,"
            . " typedoc.prefixetype as type"
            . " from documentachat, typedoc "
            . " where documentachat.id_typedoc=typedoc.id "
            . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
                . " AND (documentachat.id_etatdoc = 52 or documentachat.id_etatdoc = 53 or documentachat.id_etatdoc = 71 or documentachat.id_etatdoc = 51 or documentachat.id_etatdoc = 66 or documentachat.id_etatdoc = 75 )"
                . " AND (documentachat.id_typedoc = 17  or documentachat.id_typedoc = 2 or documentachat.id_typedoc = 18 or documentachat.id_typedoc = 19 or documentachat.id_typedoc = 22  or documentachat.id_typedoc = 7 or documentachat.id_typedoc = 20 ) "
                . " order by documentachat.id desc ";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        die('rien');
    }

    public function executeGetListePourEngagementProvisoire(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero,"
        . " typedoc.prefixetype as type"
        . " from documentachat, typedoc "
        . " where documentachat.etatdocachat IS NULL "
        . " AND documentachat.id_typedoc=typedoc.id "
        . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
        . " AND (documentachat.id_etatdoc = 24 or documentachat.id_etatdoc =25)  "
        . " AND (documentachat.id_typedoc = 18 OR documentachat.id_typedoc = 17) "
        . " and documentachat.mntttc is not null   "
        . " and documentachat.mht is not null   "
//                . " AND documentachat.id NOT IN (SELECT piecejointbudget.id_docachat"
        //                . " FROM piecejointbudget WHERE piecejointbudget.id_type = 4 OR piecejointbudget.id_type = 5) "
         . " order by documentachat.id desc ";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourEngagementProvisoireBDCNULL(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero,"
        . " typedoc.prefixetype as type"
        . " from documentachat, typedoc "
        . " where documentachat.etatdocachat IS NULL "
        . " AND documentachat.id_typedoc=typedoc.id "
        . " AND documentachat.id_etatdoc = 56  "
        . " AND  documentachat.id_typedoc = 17 "
        . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
//                . " and documentachat.mntttc is  null   "
        //                . " and documentachat.mht is  null   "
         . " AND documentachat.id NOT IN (SELECT piecejointbudget.id_docachat"
            . " FROM piecejointbudget WHERE  piecejointbudget.id_type = 5) "
            . " order by documentachat.id desc ";
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourEngagementProvisoireRegroupe(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');

        $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero,"
        . " typedoc.prefixetype as type"
        . " from documentachat, typedoc "
        . " where documentachat.etatdocachat IS NULL "
        . " AND documentachat.id_typedoc=typedoc.id "
        . " AND documentachat.id_etatdoc = 63  "
        . " AND (documentachat.id_typedoc = 22) "
        . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
//                . " AND documentachat.id NOT IN "
        //                . "(SELECT piecejointbudget.id_docachat FROM piecejointbudget WHERE piecejointbudget.id_type = 4
        //                    OR piecejointbudget.id_type = 5) "
         . " order by documentachat.id desc "
        ;
        //die($query);

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourEngagementProvisoireContrat(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
//        $pieces = Doctrine_Query::create()
        //                ->select('p.id_docachat as id')
        //                ->from('piecejointbudget p')
        //                ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR);

        $query = "select documentachat.id as id,"
        . " LPAD(documentachat.numero::text, 7, '0') as numero"
        . " , contratachat.numero as numerocontrat"
        . " , typedoc.prefixetype as type"
        . " from contratachat,documentachat,typedoc "
        . " where documentachat.id_contrat=contratachat.id "
        . " AND documentachat.id_typedoc=typedoc.id "
        . " AND documentachat.id_etatdoc = 20 "
//                . " AND documentachat.id NOT IN "
        //                . " (SELECT piecejointbudget.id_docachat FROM piecejointbudget "
        //                . " WHERE piecejointbudget.id_type = 4 OR piecejointbudget.id_type = 5) "
         . " and documentachat.id NOT IN "
        . "(SELECT piecejointbudget.id_docachat"
        . " FROM piecejointbudget "
        . " WHERE (piecejointbudget.id_type = 4 or  piecejointbudget.id_type = 5)"
        . " and piecejointbudget.id_docachat=documentachat.id  ) "
        . " and contratachat.id_doc =documentachat.id_docparent"
        . " and documentachat.id_contrat is not null"
        . " AND documentachat.id_typedoc=19 "
        . " AND contratachat.id_typedoc=19 "
        . " AND contratachat.etatdocachat is null "
        . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
            . " order by documentachat.id desc ";

        //  die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourEngagementProvisoireToDefinitif(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');

        $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero, typedoc.prefixetype as type"
        . " from documentachat, typedoc "
        . " where documentachat.etatdocachat IS NULL "
        . " AND documentachat.id_typedoc=typedoc.id "
        . " AND documentachat.id_etatdoc = 27 "
        . " AND (documentachat.id_typedoc = 7 or documentachat.id_typedoc = 2 )"
        . " AND documentachat.datesignature IS NOT NULL "
        . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
//                . " AND documentachat.id NOT IN (SELECT piecejointbudget.id_docachat FROM piecejointbudget WHERE piecejointbudget.id_type = 4 OR piecejointbudget.id_type = 5 AND piecejointbudget.id_docachat IS NOT NULL) "
         . " order by documentachat.id desc ";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourEngagementProvisoireToDefinitifBDC(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');

        $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero, typedoc.prefixetype as type"
        . " from documentachat, typedoc "
        . " where documentachat.etatdocachat IS NULL "
        . " AND documentachat.id_typedoc=typedoc.id "
        . " AND documentachat.id_etatdoc = 60 "
        . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
        . " AND  documentachat.id_typedoc = 2"
        . " AND documentachat.datesignature IS NOT NULL "
//                . " AND documentachat.id NOT IN (SELECT piecejointbudget.id_docachat FROM piecejointbudget WHERE piecejointbudget.id_type = 4 OR piecejointbudget.id_type = 5 AND piecejointbudget.id_docachat IS NOT NULL) "
         . " order by documentachat.id desc ";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourEngagementProvisoireToDefinitifContrat(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');

        $query = "select documentachat.id as id,"
        . " LPAD(documentachat.numero::text, 7, '0') as numero"
        . " , contratachat.numero as numerocontrat"
        . " , typedoc.prefixetype as type"
        . " from contratachat,documentachat,typedoc "
        . " where documentachat.id_contrat=contratachat.id "
        . " AND documentachat.id_typedoc=typedoc.id "
        . " and documentachat.id_contrat is not null"
        . " and documentachat.etatdocachat is null "
        . " AND documentachat.id_typedoc=20 "
        . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
            . " AND documentachat.id NOT IN (SELECT piecejointbudget.id_docachat FROM piecejointbudget"
            . " WHERE piecejointbudget.id_type = 1 "
            . " AND piecejointbudget.id_docachat IS NOT NULL) "
            . " order by documentachat.id desc ";
// die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourEngagementDefinitifAvenantContrat(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');

        $query = "select documentachat.id as id, contratachat.id as id_contrat ,"
        . " LPAD(documentachat.numero::text, 7, '0') as numero"
        . " , contratachat.numero as numerocontrat"
        . " , typedoc.prefixetype as type"
        . " from contratachat,documentachat,typedoc "
        . " where documentachat.id_contrat=contratachat.id "
        . " AND documentachat.id_typedoc=typedoc.id "
        . " and documentachat.id_contrat is not null"
        . " and documentachat.etatdocachat is null "
        . " AND documentachat.id_typedoc=20 "
        . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
        . " and contratachat.montantavenant is not null "
        . " and documentachat.id_etatdoc=75"
//                . " AND documentachat.id NOT IN (SELECT piecejointbudget.id_docachat FROM piecejointbudget"
        //                . " WHERE piecejointbudget.id_type = 1 "
        //                . " AND piecejointbudget.id_docachat IS NOT NULL) "
         . " order by documentachat.id desc ";
        //die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourEngagement(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');

        $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero, typedoc.prefixetype as type"
        . " from documentachat, typedoc "
        . " where documentachat.etatdocachat IS NULL "
        . " AND documentachat.id_typedoc=typedoc.id "
        . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
            . " AND (documentachat.id_etatdoc =25 or documentachat.id_etatdoc =54)"
            . " AND documentachat.datesignature IS NULL "
            . " AND (documentachat.id_typedoc = 18 OR documentachat.id_typedoc = 17) "
            . " AND documentachat.id IN (SELECT piecejointbudget.id_docachat FROM piecejointbudget WHERE piecejointbudget.id_type = 4 OR piecejointbudget.id_type = 5) "
            . " order by documentachat.id desc ";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeImprimerBDCDefinitf(sfWebRequest $request)
    {
        $iddoc = $request->getParameter('iddoc');
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche B.D.C Définitf');
        $pdf->SetSubject("Fiche B.D.C Définitf");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $logo = $soc->getLogo();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail()
        . '<br>Adresse:' . $soc->getAdresse() . '';
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);

        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //$pdf->setFooterData(array(0,64,0), array(0,64,128));
        $pdf->CustomFooter($adresse, '');
        // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 12, '', true);
        $pdf->AddPage();

        $html = $this->ReadHtmlBDCDefinitif($iddoc);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Fiche B.D.C Définitf.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBDCDefinitif($iddoc)
    {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBDCProvisoire($iddoc);
        return $html;
    }

    public function executeGetListePourEngagementBDC(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');

        $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero, typedoc.prefixetype as type"
        . " from documentachat, typedoc "
        . " where documentachat.etatdocachat IS NULL "
        . " AND documentachat.id_typedoc=typedoc.id "
        . " AND  documentachat.id_etatdoc =57 "
        . " AND documentachat.datesignature IS NULL "
        . " AND documentachat.id_typedoc = 17 "
        . " AND documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
            . " AND documentachat.id IN (SELECT piecejointbudget.id_docachat FROM piecejointbudget WHERE piecejointbudget.id_type = 4 OR piecejointbudget.id_type = 5) "
            . " order by documentachat.id desc ";
        // die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourEngagementBCE(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');

        $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero, typedoc.prefixetype as type"
        . " from documentachat, typedoc "
        . " where documentachat.etatdocachat IS NULL "
        . " AND documentachat.id_typedoc=typedoc.id "
        . " AND  (documentachat.id_etatdoc =74 or documentachat.id_etatdoc =73) "
        . " AND documentachat.datesignature IS NOT NULL "
        . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
            . " AND documentachat.id_typedoc = 7 "
            . " AND documentachat.id IN (SELECT piecejointbudget.id_docachat FROM piecejointbudget "
            . " WHERE piecejointbudget.id_type = 4 OR piecejointbudget.id_type = 5) "
            . " order by documentachat.id desc ";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourEngagementBDCNull(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');

        $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero, typedoc.prefixetype as type"
        . " from documentachat, typedoc "
        . " where documentachat.etatdocachat IS NULL "
        . " AND documentachat.id_typedoc=typedoc.id "
        . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
        . " AND (documentachat.id_etatdoc =70 or documentachat.id_etatdoc =73) "
        . " AND documentachat.datesignature IS Not NULL "
        . " AND (documentachat.id_typedoc = 2) "
//                . " AND documentachat.id IN (SELECT piecejointbudget.id_docachat FROM"
        //                . " piecejointbudget WHERE piecejointbudget.id_type = 4 OR piecejointbudget.id_type = 5) "
         . " order by documentachat.id desc ";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourEngagementContratNotification(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');

        $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero, typedoc.prefixetype as type"
        . " from documentachat, typedoc "
        . " where documentachat.etatdocachat IS NULL "
        . " AND documentachat.id_typedoc=typedoc.id "
        . " AND (documentachat.id_etatdoc =76 or documentachat.id_etatdoc =73) "
//                . " AND documentachat.datesignature IS Not NULL "
         . " AND (documentachat.id_typedoc = 20) "
        . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
//                . " AND documentachat.id IN (SELECT piecejointbudget.id_docachat FROM"
        //                . " piecejointbudget WHERE piecejointbudget.id_type = 4 OR piecejointbudget.id_type = 5) "
         . " order by documentachat.id desc ";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourEngagementFActurationBDC(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');

        $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero,"
        . " typedoc.prefixetype as type"
        . " from documentachat, typedoc "
        . " where documentachat.etatdocachat IS NULL "
        . " AND documentachat.id_typedoc=typedoc.id "
        . " AND documentachat.id_etatdoc =65 "
        . " AND documentachat.datesignature IS not NULL "
        . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
        . " AND (documentachat.id_typedoc = 22) "
//                . " AND documentachat.id IN (SELECT piecejointbudget.id_docachat FROM piecejointbudget WHERE piecejointbudget.id_type = 6 ) "
         . " order by documentachat.id desc ";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourEngagementBDCR(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');

        $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero, typedoc.prefixetype as type"
        . " from documentachat, typedoc "
        . " where documentachat.etatdocachat IS NULL "
        . " AND documentachat.id_typedoc=typedoc.id "
        . " AND documentachat.id_etatdoc =25 "
        . " AND documentachat.datesignature IS NULL "
        . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
            . " AND (documentachat.id_typedoc = 21) "
            . " AND documentachat.id IN (SELECT piecejointbudget.id_docachat FROM piecejointbudget WHERE piecejointbudget.id_type = 4 OR piecejointbudget.id_type = 5) "
            . " order by documentachat.id desc ";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourEngagementBDCReg(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');

        $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero, typedoc.prefixetype as type"
        . " from documentachat, typedoc "
        . " where documentachat.etatdocachat IS NULL "
        . " AND documentachat.id_typedoc=typedoc.id "
        . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
        . " AND ( documentachat.id_etatdoc =64 or documentachat.id_etatdoc =67) "
        . " AND (documentachat.id_typedoc = 22) "
//                . " AND documentachat.id IN (SELECT piecejointbudget.id_docachat FROM "
        //                . "piecejointbudget WHERE piecejointbudget.id_type = 4 OR piecejointbudget.id_type = 5) "
         . " order by documentachat.id desc ";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourEngagementContrat(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');

        $query = "select documentachat.id as id, "
        . "  LPAD(documentachat.numero::text, 7, '0') as numero "
        . " , contratachat.numero as numerocontrat , "
        . " typedoc.prefixetype as type"
        . " from documentachat, typedoc , contratachat "
//                . " where documentachat.etatdocachat IS NULL "
         . " where documentachat.id_typedoc=typedoc.id "
//                . " AND documentachat.id_etatdoc =37 "
         . " and contratachat.id_doc =documentachat.id_docparent"
        . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
            . " AND documentachat.datesignature IS NULL "
            . " AND (documentachat.id_typedoc = 19 ) "
            . " AND documentachat.id IN (SELECT piecejointbudget.id_docachat "
            . "FROM piecejointbudget "
            . "WHERE piecejointbudget.id_type = 4 "
            . " OR piecejointbudget.id_type = 5) "
            . " order by documentachat.id desc ";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourEngagementForDefinitif(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_type = $params['id_type'];
            $query = "select documentachat.id as id, "
            . "LPAD(documentachat.numero::text, 7, '0') as numero,"
            . " typedoc.prefixetype as type, documentachat.id_docparent as id_docparent "
            . " from documentachat, typedoc  "
            . " where documentachat.etatdocachat IS NULL "
            . " AND documentachat.id_typedoc = typedoc.id "
            . " AND documentachat.id_etatdoc = 26 "
            . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
                . " AND documentachat.datesignature IS NOT NULL "
                . " AND documentachat.id_typedoc = " . $id_type
                . " AND documentachat.id NOT IN (SELECT d.id_fils FROM documentachat d WHERE d.etatdocachat IS NULL AND d.id_fils IS NOT NULL) "
                . " order by documentachat.id desc ";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }

        die('rien');
    }

    public function executeGetListePourEngagementForDefinitifBDCNULL(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_type = $params['id_type'];
            $query = "select documentachat.id as id, "
            . " LPAD(documentachat.numero::text, 7, '0') as numero,"
            . " typedoc.prefixetype as type, documentachat.id_docparent as id_docparent "
            . " from documentachat, typedoc  "
            . " where documentachat.etatdocachat IS NULL "
            . " AND documentachat.id_typedoc = typedoc.id "
            . " AND documentachat.id_etatdoc = 59 "
            . " AND documentachat.datesignature IS NOT NULL "
            . " AND documentachat.id_typedoc = " . $id_type
            . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
                . " AND documentachat.id NOT IN (SELECT d.id_fils"
                . " FROM documentachat d WHERE d.etatdocachat IS NULL AND d.id_fils IS NOT NULL) "
                . " order by documentachat.id desc ";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }

        die('rien');
    }

    public function executeGetListePourEngagementBDCRPForDefinitif(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_type = $params['id_type'];
            $query = "select documentachat.id as id, "
            . "LPAD(documentachat.numero::text, 7, '0') as numero,"
            . " typedoc.prefixetype as type, documentachat.id_docparent as id_docparent "
            . " from documentachat, typedoc  "
            . " where documentachat.etatdocachat IS NULL "
            . " AND documentachat.id_typedoc = typedoc.id "
            . " AND documentachat.id_etatdoc = 62 "
            . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
//                    . " AND documentachat.datesignature IS NOT NULL "
             . " AND documentachat.id_typedoc = " . $id_type
                . " AND documentachat.id NOT IN (SELECT d.id_fils FROM documentachat d "
                . "WHERE d.etatdocachat IS NULL AND d.id_fils IS NOT NULL) "
                . " order by documentachat.id desc ";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }

        die('rien');
    }

    public function executeGetListePourEngagementContratForDefinitif(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_type = $params['id_type'];
            $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero, "
            . " contratachat.numero as numerocontrat , "
            . " typedoc.prefixetype as type, documentachat.id_contrat as id_docparent "
            . " from documentachat, typedoc,contratachat "
//                    . " where documentachat.etatdocachat IS NULL "
             . " where documentachat.id_typedoc = typedoc.id "
            . " and contratachat.id_doc =documentachat.id_docparent"
            . " AND documentachat.id_etatdoc = 38 "
            . " AND contratachat.id=documentachat.id_contrat"
            . " AND documentachat.datesignature IS NOT NULL "
            . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
                . " AND documentachat.id_typedoc = " . $id_type
                . " AND documentachat.id NOT IN"
                . " (SELECT d.id_fils FROM documentachat d "
                . "WHERE d.etatdocachat IS NULL AND d.id_fils IS NOT NULL) "
                . " order by documentachat.id desc ";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }

        die('rien');
    }

    public function executeGetListePourVisa(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_typedoc = $params['id_typedoc'];
            $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero, typedoc.prefixetype as type "
            . " from documentachat, typedoc "
            . " where documentachat.etatdocachat IS NULL  "
            . " AND documentachat.id_typedoc=typedoc.id "
            . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
            . " AND (documentachat.id_etatdoc = 6 OR  documentachat.id_etatdoc = 9 OR   documentachat.id_etatdoc = 22 OR   documentachat.id_etatdoc = 35  OR   documentachat.id_etatdoc = 49)"
            . " AND documentachat.id_typedoc = " . $id_typedoc
//                    . " AND documentachat.id NOT IN (select id_doc from ligavissig)"
             . " order by documentachat.id desc ";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        die('rien');
    }

    public function executeGetListePourVisaMarche(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_typedoc = $params['id_typedoc'];
            $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero, typedoc.prefixetype as type "
            . " from documentachat, typedoc "
            . " where documentachat.etatdocachat IS NULL  "
            . " AND documentachat.id_typedoc=typedoc.id "
            . " AND (documentachat.id_etatdoc = 6 OR  documentachat.id_etatdoc = 9 OR   documentachat.id_etatdoc = 22 OR   documentachat.id_etatdoc = 35)"
            . " AND documentachat.id_typedoc = " . $id_typedoc
            . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
                . " AND documentachat.id NOT IN (select id_doc from ligavissig)"
                . " order by documentachat.id desc ";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        die('rien');
    }

    public function executeValiderQuantite(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

        if ($request->getParameter('iddoc') && $request->getParameter('btn')) {
            //______________________________Mis a jour document
            $documentachat = new Documentachat();
            $da = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('iddoc'));
            if ($da) {
                $documentachat = $da;
                $documentachat->setIdEtatdoc(1);
                $documentachat->save();
            }
            $this->redirect('@documentachat');
        }
        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')
            ->createQuery('a')
            ->where('id_doc=' . $iddoc)->orderBy('id asc')->execute();
    }

    public function executeListeAnnule(sfWebRequest $request)
    {
        $query = "select documentachatannulation.id as id, documentachatannulation.dateannulation as dateannulation, documentachatannulation.motifannulation as motif, LPAD(documentachat.numero::text, 7, '0') as numero, documentachat.datecreation as datecreation, typedoc.libelle as type, agents.nomcomplet as user"
            . " from documentachatannulation, documentachat, utilisateur, agents, typedoc "
            . " where documentachatannulation.id_documentachat=documentachat.id and "
            . " documentachat.id_typedoc=typedoc.id "
            . " AND documentachatannulation.id_user = utilisateur.id"
            . " AND utilisateur.id_parent = agents.id "
            . " AND documentachatannulation.valide_budget = FALSE "
            . "  order by documentachatannulation.id desc";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $this->docs = $conn->fetchAssoc($query);
    }

    public function executeShowAnnule(sfWebRequest $request)
    {
        $iddoc = $request->getParameter('iddoc');
        $this->document_annule = DocumentachatannulationTable::getInstance()->find($iddoc);
    }

    public function executeValiderAnnulationEngagement(sfWebRequest $request)
    {
        $id = $request->getParameter('id');
        $id_documentbudget = $request->getParameter('id_documentbudget');

        $document_annule = DocumentachatannulationTable::getInstance()->find($id);
        $document_annule->setValideBudget(true);
        $document_annule->save();

        $document_budget = DocumentbudgetTable::getInstance()->find($id_documentbudget);
        $document_budget->setAnnule(true);
        $document_budget->save();

        //engagement définitif
        if ($document_budget->getIdType() == 1) {
            $ligprotitrub = $document_budget->getLigprotitrub();

            $ancien_mntengage = $ligprotitrub->getMntengage();
            $ancien_relicaengager = $ligprotitrub->getRelicaengager();
            $new_mntengage = $ancien_mntengage - $document_budget->getMnt();
            $new_relicaengager = $ancien_relicaengager - $document_budget->getMnt();

            $ligprotitrub->setMntengage($new_mntengage);
            $ligprotitrub->setRelicaengager($new_relicaengager);

            $ligprotitrub->save();
        }

        //engagement provisoire
        if ($document_budget->getIdType() == 3) {
            $ligprotitrub = $document_budget->getLigprotitrub();

            $ancien_mntprovisoire = $ligprotitrub->getMntprovisoire();
            $new_mntprovisoire = $ancien_mntprovisoire - $document_budget->getMnt();

            $ligprotitrub->setMntprovisoire($new_mntprovisoire);

            $ligprotitrub->save();
        }

        die('ok');
    }

    //__________________________________________________Envoie fiche vers budget
    public function executeEnvoibudget(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

        if ($request->getParameter('iddoc') && $request->getParameter('btn')) {
            //______________________________Mis a jour document
            $documentachat = new Documentachat();
            $da = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('iddoc'));
            if ($da) {
                $documentachat = $da;
                $documentachat->setIdEtatdoc(3);
                $documentachat->save();
            }
            $this->redirect('@documentachat');
        }
        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
//        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        $this->listesdocuments = LignedocachatTable::getInstance()->getByIdDoc($iddoc);
    }

    public function executeEnvoibudgetBCEBDCC(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

        if ($request->getParameter('iddoc') && $request->getParameter('btn')) {
            //______________________________Mis a jour document
            $documentachat = new Documentachat();
            $da = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('iddoc'));
            if ($da) {
                $documentachat = $da;
//                $documentachat->setIdEtatdoc(3);
                $documentachat->save();
            }
            $this->redirect('@documentachat');
        }
        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->documentachat = $documentachat;
        if ($documentachat->getIdTypedoc() != 20 && $documentachat->getIdTypedoc() != 19) {
            $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        } else {
            $this->listesdocuments = Doctrine_Core::getTable('lignecontrat')->findByIdContrat($documentachat->getIdContrat());
        }

    }

    public function executeIndex(sfWebRequest $request)
    {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }
        $idtype = 6;
        if ($request->getParameter('idtype')) {
            $idtype = $request->getParameter('idtype');
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }

        $this->pager = $this->getPager($idtype);
        $this->sort = $this->getSort();
        $this->idtype = $idtype;

        if ($this->getUser()->getAttribute('userB2m')->getAcceesDroit("achat_et_validation_frs")) {
            $this->redirect(@fournisseur);
        }
    }

    protected function getPager($idtype)
    {
        $pager = $this->configuration->getPager('documentachat');
        $pager->setQuery($this->buildQuery($idtype));
        $pager->setPage($this->getPage());
        $pager->init();

        return $pager;
    }

    protected function buildQuery($idtype)
    {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);
        $filter = $this->getFilters();

        $query = $this->filters->buildQuery($this->getFilters());
        $documentsachat = Doctrine_Core::getTable('documentachat')
            ->createQuery('a')->where('id_typedoc=' . $idtype);
        if (isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        } elseif (isset($filter['datecreation']['from']) && !isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $_SESSION['exercice_budget'] . "-12-31" . "'");
        } elseif (!isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $_SESSION['exercice_budget'] . "-01-01" . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        } else {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $_SESSION['exercice_budget'] . "-01-01" . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $_SESSION['exercice_budget'] . "-12-31" . "'");
        }

        if (isset($filter['id_etatdoc'])) {
            $documentsachat = $documentsachat->Andwhere('id_etatdoc=' . $filter['id_etatdoc']);
        }
        $documentsachat = $documentsachat->Andwhere('id_etatdoc=24');

        $query = $documentsachat->OrderBy('id desc');
        $this->addSortQuery($query);
        //die($query);
        return $query;
    }

    public function executeRempliretexporter(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

        if ($request->getParameter('iddoc') && $request->getParameter('btn')) {
            //______________________________Mis a jour document
            $documentachat = new Documentachat();
            $da = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('iddoc'));
            if ($da) {
                $documentachat = $da;
                $documentachat->setIdEtatdoc(3);
                $documentachat->save();
            }
            $this->redirect('@documentachat');
        }
        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')
            ->createQuery('a')
            ->where('id_doc=' . $iddoc)->orderBy('id asc')->execute();
    }

    //________________________________________________________Valider Visa et passer a la processus suivant
    public function executeValidervisa(sfWebRequest $request)
    {
        if ($request->getParameter('iddoc')) {
            $iddoc = $request->getParameter('iddoc');
            Doctrine_Query::create()
                ->update('documentachat')
                ->set('id_etatdoc', '?', 10)
                ->where('id=' . $iddoc)
                ->execute();
            $this->redirect('documentachat/showdocument?iddoc=' . $iddoc);
        }
        $this->redirect('@documentachat');
    }

    //__________________________________________________________________________Expoter BDC
    public function executeExportbcc(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

        $iddoc = $request->getParameter('iddoc');
        $this->ids = $iddoc;
        $iddoc = explode(',', $iddoc);
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc[0]);
        $this->liste_bcc = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc[0]);
        $demande_de_prix = new Documentachat();
        $this->numerodemande = $demande_de_prix->getNumeroBDCPParBCI($this->documentachat->getId());
        $demande_de_prix_defini = $demande_de_prix->getNumeroBDCDParBCI($this->documentachat->getId());
        $this->numerodemande_defi = $demande_de_prix_defini;
        $this->lieuxlivraisons = Doctrine_Core::getTable('lieulivraisson')->findAll();
        $this->idbdcp = 0;
        $this->tab = "";
        if ($request->getParameter('idbdc')) {
            $this->idbdcp = $request->getParameter('idbdc');
        }

        if ($request->getParameter('tab')) {
            $this->tab = $request->getParameter('tab');
        }

        $this->liste_document_achats = DocumentachatTable::getInstance()->getByIds($iddoc);
    }

    public function executeExportbccnull(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

        $iddoc = $request->getParameter('iddoc');
        $this->ids = $iddoc;
        $iddoc = explode(',', $iddoc);
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc[0]);
        $this->liste_bcc = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc[0]);
        $demande_de_prix = new Documentachat();
        $this->numerodemande = $demande_de_prix->getNumeroBDCPParBCI($this->documentachat->getId());
        $demande_de_prix_defini = $demande_de_prix->getNumeroBDCDParBCI($this->documentachat->getId());
        $this->numerodemande_defi = $demande_de_prix_defini;
        $this->lieuxlivraisons = Doctrine_Core::getTable('lieulivraisson')->findAll();
        $this->idbdcp = 0;
        $this->tab = "";
        if ($request->getParameter('idbdc')) {
            $this->idbdcp = $request->getParameter('idbdc');
        }

        if ($request->getParameter('tab')) {
            $this->tab = $request->getParameter('tab');
        }

        $this->liste_document_achats = DocumentachatTable::getInstance()->getByIds($iddoc);
    }

    //__________________________________________________________________________Expoter BCE
    public function executeExportbce(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

        $iddoc = $request->getParameter('iddoc');
        $this->ids = $iddoc;
        $iddoc = explode(',', $iddoc);
        $this->lieuxlivraisons = Doctrine_Core::getTable('lieulivraisson')->findAll();
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc[0]);
        $this->liste_bcc = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc[0]);
        $demande_de_prix = new Documentachat(); // Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($iddoc, 7);
        $this->numerodemande = $demande_de_prix->NumeroSeqDocumentAchat(7, $_SESSION['exercice_budget']);
        $this->numerobcep = $demande_de_prix->NumeroSeqDocumentAchat(18, $_SESSION['exercice_budget']);
        //sprintf('%03d', count($demande_de_prix) + 1);
        $this->idbdcp = 0;
        $this->tab = "";
        if ($request->getParameter('idbdc')) {
            $this->idbdcp = $request->getParameter('idbdc');
        }

        if ($request->getParameter('tab')) {
            $this->tab = $request->getParameter('tab');
        }

        $this->liste_document_achats = DocumentachatTable::getInstance()->getByIds($iddoc);
    }

    public function executeValiderEngagement(sfWebRequest $request)
    {
        $id = $request->getParameter('id');

        $documentachat = DocumentachatTable::getInstance()->find($id);
        $documentachat->setDatesignature(date('Y-m-d'));
        $documentachat->save();

        die("OK");
    }

    public function executeValiderToutEngagement(sfWebRequest $request)
    {
        $id = $request->getParameter('id');

        $documentbudget = DocumentbudgetTable::getInstance()->find($id);
        foreach ($documentbudget->getPiecejointbudget() as $piece_jointe) {
            $documentachat = $piece_jointe->getDocumentachat();
            if ($documentachat->getDatesignature() == null) {
                $documentachat->setDatesignature(date('Y-m-d'));
                $documentachat->save();
            }
        }

        die("OK");
    }

    public function executeImprimerBCEDefinitf(sfWebRequest $request)
    {
        $iddoc = $request->getParameter('iddoc');
        $pdf = new sfTCPDF('');
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche B.C.E Définitf');
        $pdf->SetSubject("Fiche B.C.E Définitf");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $logo = $soc->getLogo();
        $adresse = 'Téléphone:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail()
        . '<br>Adresse:' . $soc->getAdresse() . '';
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);

        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //$pdf->setFooterData(array(0,64,0), array(0,64,128));
        $pdf->CustomFooter($adresse, '');
        // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 12, '', true);
        $pdf->AddPage();

        $html = $this->ReadHtmlBCEDefinitif($iddoc);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Fiche B.C.E Définitf.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBCEDefinitif($iddoc)
    {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBCEDefinitif($iddoc);
        return $html;
    }

    public function executeImprimerBCEProvisoire(sfWebRequest $request)
    {
        $iddoc = $request->getParameter('iddoc');
        $pdf = new sfTCPDF('');
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche B.C.E Provisoire');
        $pdf->SetSubject("Fiche B.C.E Provisoire");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $logo = $soc->getLogo();
        $adresse = 'Téléphone:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail()
        . '<br>Adresse:' . $soc->getAdresse() . '';
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);

        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //$pdf->setFooterData(array(0,64,0), array(0,64,128));
        $pdf->CustomFooter($adresse, '');
        // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 12, '', true);
        $pdf->AddPage();

        $html = $this->ReadHtmlBCEProvisoire($iddoc);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Fiche B.C.E Provisoire.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBCEProvisoire($iddoc)
    {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBCEProvisoire($iddoc);
        return $html;
    }
    public function executeGetListeBenficiaireDelaiexpire(sfWebRequest $request)
    {
        //  $dateretraite = floor(($nbrans + strtotime($dateemposte)) / 31556926);
        // SELECT CAST(FLOOR(CAST(CURRENT_TIMESTAMP AS float)) AS DATETIME)

        // $query = "select fournisseur.rs as frs "
        // . " from lots,fournisseur  "
        // . " where lots.id_frs = fournisseur.id"
        // . " and '" . date('Y-m-d') . "'" . ":: date =    "

        //  . " date  lots.dateoservice  + integer  lots.delaicontractuelle "
        // //  ." DATEADD  (dd, lots.delaicontractuelle,lots.dateoservice )"
        // //. " floor(  ( lots.delaicontractuelle + strtotime(lots.dateoservice)) / 31556926)"
        // //     lots.dateoservice + INTERVAL '" . " lots.delaicontractuelle" . ' day' . "' "

        // . " order by fournisseur.id desc ";

        $query = "select fournisseur.rs as frs,lots.id,
        LPAD(marches.numero::text, 6, '0') as numero "
        . " from lots,fournisseur,marches  "
        . " where lots.id_frs = fournisseur.id"
        . " and datemaxreponse =   '"
        . date('Y-m-d') . "'" . ":: date - INTERVAL '" . '2 day' . "' "
        . " and  marches.id=lots.id_marche"
        // . " and '". date('Y-m-d') ."'".":: date
        //  =    lots.dateoservice + INTERVAL '"
        // . " lots.delaicontractuelle"

        . " order by fournisseur.id desc ";
        //  die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }
}
