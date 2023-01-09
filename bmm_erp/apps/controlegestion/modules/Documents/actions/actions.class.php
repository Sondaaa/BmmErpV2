<?php

/**
 * Boncommandeexterne actions.
 *
 * @package    Bmm
 * @subpackage Boncommandeexterne
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentsActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;
        if ($request->getParameter('id') && $request->getParameter('id') != "") {
            $this->documentachats = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')
                    ->where('id_typedoc=6')
                    ->andwhere('id_docparent=' . $request->getParameter('id'))
                    ->execute();
            $this->documentdeponses = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')
                    ->where('id_typedoc=2')
                    ->andwhere('id_docparent=' . $request->getParameter('id'))
                    ->execute();
            $this->demandesprix = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')
                    ->where('id_typedoc=8')
                    ->andwhere('id_docparent=' . $request->getParameter('id'))
                    ->execute();
            $doc = new Documentachat();
            $document = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('id'));
            $this->documentachat = $document;
            $doc = $document;
            $this->id = $request->getParameter('id');
            $this->texte = $doc->getDatecreation() . '-' . $doc->getNumerodocachat() . '-' . trim($doc->getReference()) . '-' . $doc->getAgents();
        }
    }

    public function executeIndexfrs(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;
        $this->formfiletr = new DocumentachatFormFilter();
        $idtype = 7;
        $documentachat = new Documentachat();
        $this->form = new DocumentbudgetForm();
        if ($request->getParameter('idtype'))
            $idtype = $request->getParameter('idtype');
        $this->idtype = $idtype;
        $this->boncommandeexterne = $documentachat->getListesBdcpNonImputer();
        $this->datedebut = "";
        $this->datefin = "";
        $this->idfrs = "";
        $this->id_bci = "";
        $this->id_dem = "";
        if ($request->getParameter('debut') && $request->getParameter('debut') != "") {
            $this->datedebut = $request->getParameter('debut');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation>='" . $request->getParameter('debut') . "'");
        }
        if ($request->getParameter('id_bci') && $request->getParameter('id_bci') != "") {
            $this->id_bci = $request->getParameter('id_bci');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_docparent='" . $request->getParameter('id_bci') . "'");
        }
        if ($request->getParameter('id_dem') && $request->getParameter('id_dem') != "") {
            $this->id_dem = $request->getParameter('id_dem');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_demandeur='" . $request->getParameter('id_dem') . "'");
        }
        if ($request->getParameter('fin') && $request->getParameter('fin') != "") {
            $this->datefin = $request->getParameter('fin');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation<='" . $request->getParameter('debut') . "'");
        }
        if ($request->getParameter('idfrs') && $request->getParameter('idfrs') != "") {
            $this->idfrs = $request->getParameter('idfrs');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_frs=" . $request->getParameter('idfrs'));
        }
        $this->boncommandeexterne = $this->boncommandeexterne->orderBy('id desc')->execute();
        $this->type = Doctrine_Core::getTable('typedoc')->findOneById($idtype);
    }

    public function executeDetailpreengagement(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
        $this->boncommandeinterne = Doctrine_Core::getTable('documentachat')->findOneById($this->documentachat->getIdDocparent());
        $this->liste_demande_de_prix = Doctrine_Core::getTable('lignedocachat')
                        ->createQuery('a')
                        ->where('id_doc=' . $this->documentachat->getId())->orderBy('id asc')->execute();
        $p = new Piecejointbudget();
        $this->rubrique = "";
        $this->idLigneRubrique = "";
        $this->piece_budget = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($this->documentachat->getId());
        if ($this->piece_budget) {
            //die($this->piece_budget);
            $p = $this->piece_budget;
            $chapitre = $p->getDocumentbudget()->getLigprotitrub()->getTitrebudjet()->getTypebudget();
            $this->rubrique = $p->getDocumentbudget()->getLigprotitrub();
            $this->idLigneRubrique = $p->getDocumentbudget()->getLigprotitrub()->getId();
        }
        $this->active = "home";
        $this->form = new LigneoperationcaisseForm();
//        $piece_ = new Ligneoperationcaisse();
        $this->pieces_operations = Doctrine_Core::getTable('ligneoperationcaisse')->findByIdDocachat($this->documentachat->getId());

        if ($request->getParameter('idoperation')) {

            $operations = Doctrine_Core::getTable('ligneoperationcaisse')->findOneByIdDocachatAndId($request->getParameter('id'), $request->getParameter('idoperation'));
            $this->active = "detail";
            if ($operations)
                $this->form = new LigneoperationcaisseForm($operations);
        }
    }

    public function executeBondefinitif(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;
        $this->formfiletr = new DocumentachatFormFilter();
//        $idtype = 7;
        $documentachat = new Documentachat();
        $this->form = new DocumentbudgetForm();
//        if ($request->getParameter('idtype'))
//            $idtype = $request->getParameter('idtype');
//        $this->idtype = $idtype;
        $this->boncommandeexterne = null;
        if ($documentachat->getListesBdcDefinitifNonEncoreValider()) {
            $this->boncommandeexterne = $documentachat->getListesBdcDefinitifNonEncoreValider();
            $this->datedebut = "";
            $this->datefin = "";
            $this->idfrs = "";
            $this->id_bci = "";
            $this->id_dem = "";
            if ($request->getParameter('debut') && $request->getParameter('debut') != "") {
                $this->datedebut = $request->getParameter('debut');
                $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation>='" . $request->getParameter('debut') . "'");
            }
            if ($request->getParameter('id_bci') && $request->getParameter('id_bci') != "") {
                $this->id_bci = $request->getParameter('id_bci');
                $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_docparent='" . $request->getParameter('id_bci') . "'");
            }
            if ($request->getParameter('id_dem') && $request->getParameter('id_dem') != "") {
                $this->id_dem = $request->getParameter('id_dem');
                $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_demandeur='" . $request->getParameter('id_dem') . "'");
            }
            if ($request->getParameter('fin') && $request->getParameter('fin') != "") {
                $this->datefin = $request->getParameter('fin');
                $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation<='" . $request->getParameter('debut') . "'");
            }
            if ($request->getParameter('idfrs') && $request->getParameter('idfrs') != "") {
                $this->idfrs = $request->getParameter('idfrs');
                $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_frs=" . $request->getParameter('idfrs'));
            }
            $this->boncommandeexterne = $this->boncommandeexterne->orderBy('id desc')->execute();
        }
//        $this->type = Doctrine_Core::getTable('typedoc')->findOneById($idtype);
    }

    public function executePreengagement(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
        $piece = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($this->documentachat->getId());
        $idpiece = 0;
        $this->tab = "";
        if ($request->getParameter('tab'))
            $this->tab = $request->getParameter('tab');
        $this->form = new DocumentbudgetForm();
        if ($piece) {
            $idpiece = $piece->getId();

            $doc = Doctrine_Core::getTable('documentbudget')->findOneById($piece->getIdDocumentbudget());
            if ($doc)
                $this->form = new DocumentbudgetForm($doc);
        }else {
            $piece_provisoire = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($this->documentachat->getIdFils());
            $doc_piece_provisoire = Doctrine_Core::getTable('documentbudget')->findOneById($piece_provisoire->getIdDocumentbudget());
            $this->form = new DocumentbudgetForm($doc_piece_provisoire);
        }
        $this->trouve_facture = 0;
        $id = $this->documentachat->getId();

        $bcej = Doctrine_Core::getTable('Documentachat')->findOneByIdDocparentAndIdTypedoc($id, 16);
        if ($bcej) {
            $id = $bcej->getId();
        }
        $this->facture = Doctrine_Core::getTable('Documentachat')->findOneByIdDocparentAndIdTypedoc($id, 15);
        if ($this->facture)
            $this->trouve_facture = 1;
    }

    public function executeShow(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
    }

    public function executeDetail(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new documentachatForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new documentachatForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id'))), sprintf('Object documentachat does not exist (%s).', $request->getParameter('id')));
        $this->form = new documentachatForm($documentachat);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id'))), sprintf('Object documentachat does not exist (%s).', $request->getParameter('id')));
        $this->form = new documentachatForm($documentachat);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id'))), sprintf('Object documentachat does not exist (%s).', $request->getParameter('id')));
        $documentachat->delete();

        $this->redirect('Boncommandeexterne/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $documentachat = $form->save();

            $this->redirect('Boncommandeexterne/edit?id=' . $documentachat->getId());
        }
    }

    //___________________________________________________________________________Detail ligne doc Detail demande de prix
    public function executeDetaildemandedeprix(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $demandedeprix = new Documentachat();
            $dem = Doctrine_Core::getTable('documentachat')->findOneById($id);
            $demandedeprix = $dem;

            die($demandedeprix->getHtmlDemandedeprix());
        }
        //die($q);
    }

    public function executeDocumentFournisseur(sfWebRequest $request) {
        $this->fournisseurs = FournisseurTable::getInstance()->getAllFournisseurOrderByRaisonSociale();
        $this->datedebut = date('Y-m-d', strtotime(date('Y-m-1')));
        $this->datefin = date("Y-m-d", mktime(0, 0, 0, date('m') + 1, 0, date('Y')));
    }

    public function executeDocumentFournisseurBDCNULL(sfWebRequest $request) {
        $this->fournisseurs = FournisseurTable::getInstance()->getAllFournisseurOrderByRaisonSociale();
        $this->datedebut = date('Y-m-d', strtotime(date('Y-m-1')));
        $this->datefin = date("Y-m-d", mktime(0, 0, 0, date('m') + 1, 0, date('Y')));
    }

    public function executeDocumentFournisseurBDCRegrouppe(sfWebRequest $request) {
        $this->fournisseurs = FournisseurTable::getInstance()->getAllFournisseurOrderByRaisonSociale();
        $this->datedebut = date('Y-m-d', strtotime(date('Y-m-1')));
        $this->datefin = date("Y-m-d", mktime(0, 0, 0, date('m') + 1, 0, date('Y')));
    }

    public function executeGoPageDoc(sfWebRequest $request) {
        $pager = $this->paginate($request);
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_fournisseur = $request->getParameter('id_fournisseur', '');
        return $this->renderPartial("liste_doc", array("pager" => $pager, "date_debut" => $date_debut, "date_fin" => $date_fin, "id_fournisseur" => $id_fournisseur));
    }

    public function executeGoPageDocBDCNULL(sfWebRequest $request) {
        $pager = $this->paginateBDCNULL($request);
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_fournisseur = $request->getParameter('id_fournisseur', '');
        return $this->renderPartial("liste_doc_Bdc_null", array("pager" => $pager, "date_debut" => $date_debut, "date_fin" => $date_fin, "id_fournisseur" => $id_fournisseur));
    }

    public function executeGoPageDocBDCREgrouppe(sfWebRequest $request) {
        $pager = $this->paginateBDCRegrouppe($request);
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_fournisseur = $request->getParameter('id_fournisseur', '');
        return $this->renderPartial("liste_doc_BdcRegrouppe", array("pager" => $pager, "date_debut" => $date_debut, "date_fin" => $date_fin, "id_fournisseur" => $id_fournisseur));
    }

    public function paginate(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_fournisseur = $request->getParameter('id_fournisseur', '');
        $page = $request->getParameter('page', '');

        $pager = new sfDoctrinePager('Documentachat', 10);
        $pager->setQuery(DocumentachatTable::getInstance()->findAllByFournisseur($date_debut, $date_fin, $id_fournisseur));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function paginateBDCNULL(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_fournisseur = $request->getParameter('id_fournisseur', '');
        $page = $request->getParameter('page', '');

        $pager = new sfDoctrinePager('Documentachat', 10);
        $pager->setQuery(DocumentachatTable::getInstance()->findAllByFournisseurBDCNULL($date_debut, $date_fin, $id_fournisseur));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function paginateBDCRegrouppe(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_fournisseur = $request->getParameter('id_fournisseur', '');
        $page = $request->getParameter('page', '');

        $pager = new sfDoctrinePager('Documentachat', 10);
        $pager->setQuery(DocumentachatTable::getInstance()->findAllBDCRegrouppeByFournisseur($date_debut, $date_fin, $id_fournisseur));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeImprimerListeDocFournisseurProvisoire(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        // pdf object
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Doc. Achat');
        $pdf->SetSubject("Liste Doc. Achat");
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
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
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

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // dejavusans or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        $html = $this->ReadHtmlListeDocFournisseurProv($request);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Liste Doc. Achat.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeDocFournisseurProv(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $documentachat = new Documentachat();
        $html .= $documentachat->ReadHtmlListeDocFournisseurProvisoire($request);

        return $html;
    }

    public function executeImprimerListeDocContratFournisseurProvisoire(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        // pdf object
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Doc. Achat');
        $pdf->SetSubject("Liste Doc. Achat");
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
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
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

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // dejavusans or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        $html = $this->ReadHtmlListeDocContratFournisseurProv($request);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Liste Doc. Achat.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeDocContratFournisseurProv(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $documentachat = new Documentachat();
        $html .= $documentachat->ReadHtmlListeDocContratFournisseurProvisoire($request);

        return $html;
    }

    public function executeImprimerListeDocFournisseur(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        // pdf object
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Doc. Achat');
        $pdf->SetSubject("Liste Doc. Achat");
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
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
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

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // dejavusans or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        $html = $this->ReadHtmlListeDocFournisseur($request);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Liste Doc. Achat.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeDocFournisseur(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $documentachat = new Documentachat();
        $html .= $documentachat->ReadHtmlListeDocFournisseur($request);

        return $html;
    }

    public function executeDocumentProvisoireFournisseur(sfWebRequest $request) {
        $this->fournisseurs = FournisseurTable::getInstance()->getAllFournisseurOrderByRaisonSociale();
        $this->datedebut = date('Y-m-d', strtotime(date('Y-m-1')));
        $this->datefin = date("Y-m-d", mktime(0, 0, 0, date('m') + 1, 0, date('Y')));
    }

    public function executeDocumentContratDefFournisseur(sfWebRequest $request) {
        $this->fournisseurs = FournisseurTable::getInstance()->getAllFournisseurOrderByRaisonSociale();
        $this->datedebut = date('Y-m-d', strtotime(date('Y-m-1')));
        $this->datefin = date("Y-m-d", mktime(0, 0, 0, date('m') + 1, 0, date('Y')));
    }

    public function executeDocumentProvisoireContratFournisseur(sfWebRequest $request) {
        $this->fournisseurs = FournisseurTable::getInstance()->getAllFournisseurOrderByRaisonSociale();
        $this->datedebut = date('Y-m-d', strtotime(date('Y-m-1')));
        $this->datefin = date("Y-m-d", mktime(0, 0, 0, date('m') + 1, 0, date('Y')));
    }

    public function executeDocumentBDCProvisoireFournisseur(sfWebRequest $request) {
        $this->fournisseurs = FournisseurTable::getInstance()->getAllFournisseurOrderByRaisonSociale();
        $this->datedebut = date('Y-m-d', strtotime(date('Y-m-1')));
        $this->datefin = date("Y-m-d", mktime(0, 0, 0, date('m') + 1, 0, date('Y')));
    }

    public function executeGoPageDocProvisoire(sfWebRequest $request) {
        $pager = $this->paginateProvisoire($request);
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_fournisseur = $request->getParameter('id_fournisseur', '');
        return $this->renderPartial("liste_doc_provisoire", array("pager" => $pager, "date_debut" => $date_debut, "date_fin" => $date_fin, "id_fournisseur" => $id_fournisseur));
    }

    public function executeGoPageDocContratPrvisoire(sfWebRequest $request) {
        $pager = $this->paginateContratProvisoire($request);
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_fournisseur = $request->getParameter('id_fournisseur', '');
        return $this->renderPartial("liste_contrat_doc_provisoire", array("pager" => $pager, "date_debut" => $date_debut, "date_fin" => $date_fin, "id_fournisseur" => $id_fournisseur));
    }

    public function executeGoPageDocContratDef(sfWebRequest $request) {
        $pager = $this->paginateContratDefinitif($request);
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_fournisseur = $request->getParameter('id_fournisseur', '');
        return $this->renderPartial("liste_contrat_doc_definitif", array("pager" => $pager, "date_debut" => $date_debut, "date_fin" => $date_fin, "id_fournisseur" => $id_fournisseur));
    }

    public function executeGoPageBDCDocProvisoire(sfWebRequest $request) {
        $pager = $this->paginateBDCProvisoire($request);
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_fournisseur = $request->getParameter('id_fournisseur', '');
        return $this->renderPartial("liste_bdc_doc_provisoire", array("pager" => $pager, "date_debut" => $date_debut, "date_fin" => $date_fin, "id_fournisseur" => $id_fournisseur));
    }

    public function paginateBDCProvisoire(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_fournisseur = $request->getParameter('id_fournisseur', '');
        $page = $request->getParameter('page', '');

        $pager = new sfDoctrinePager('Documentachat', 10);
        $pager->setQuery(DocumentachatTable::getInstance()->findAllBDCProvisoireByFournisseur($date_debut, $date_fin, $id_fournisseur));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function paginateProvisoire(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_fournisseur = $request->getParameter('id_fournisseur', '');
        $page = $request->getParameter('page', '');

        $pager = new sfDoctrinePager('Documentachat', 10);
        $pager->setQuery(DocumentachatTable::getInstance()->findAllProvisoireByFournisseur($date_debut, $date_fin, $id_fournisseur));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function paginateContratProvisoire(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_fournisseur = $request->getParameter('id_fournisseur', '');
        $page = $request->getParameter('page', '');

        $pager = new sfDoctrinePager('Documentachat', 10);
        $pager->setQuery(DocumentachatTable::getInstance()->findAllContratProvisoireByFournisseur($date_debut, $date_fin, $id_fournisseur));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function paginateContratDefinitif(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_fournisseur = $request->getParameter('id_fournisseur', '');
        $page = $request->getParameter('page', '');

        $pager = new sfDoctrinePager('Documentachat', 10);
        $pager->setQuery(DocumentachatTable::getInstance()->findAllContratDefByFournisseur($date_debut, $date_fin, $id_fournisseur));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }
    public function executeImprimerprovisoirecaiise(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        // $iddoc = $request->getParameter('iddoc');
        $id = $request->getParameter('idfiche');
        //  $doc_budget = $doc = Doctrine_Core::getTable('documentbudget')->findOneById($id);

        $ligneoperationcaisse = Doctrine_Core::getTable('ligneoperationcaisse')->findOneById($id);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Bufget N°:');
        $pdf->SetSubject("fiche bidget");
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
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
        ob_end_clean();
//$pdf->SetFont('dejavusans', '', 12);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
//      


        $html = $this->ReadHtmlDocProvisoirecaisse($ligneoperationcaisse);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');


        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('titre_' . $id . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlDocProvisoirecaisse($ligneoperation) {
        $html = StyleCssHeader::header1();
        $html.=$ligneoperation->getHtmlDocProvisoirecaisse();

        return $html;
    }

    public function executeImprimerprovisoire(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $iddoc = $request->getParameter('iddoc');
        $id = $request->getParameter('idfiche');
        $doc_budget = $doc = Doctrine_Core::getTable('documentbudget')->findOneById($id);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Bufget N°:');
        $pdf->SetSubject("fiche bidget");
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
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
        $idtype = 1;
        if ($request->getParameter('idtytpe'))
            $idtype = $request->getParameter('idtytpe');

        $html = $this->ReadHtmlDocProvisoire($iddoc, $doc_budget, $idtype);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');


        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('titre_' . $id . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlDocProvisoire($iddoc, $doc_budget, $idtype) {
        $html = StyleCssHeader::header1();
        $html.=$doc_budget->getHtmlDocProvisoire($iddoc, $idtype);

        return $html;
    }

    public function executeImprimerdocentre(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $aviss = Doctrine_Core::getTable('avis')
                        ->createQuery('a')->where('id_poste=5')
                        ->orderBy('id asc')->execute();
        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

        $listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);

        // pdf object
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche BCI N°:');
        $pdf->SetSubject("document d'achat");
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

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // dejavusans or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
//      
//die($documentachat->getIdTypedoc().'gg');
//die($html);
        if ($documentachat->getIdTypedoc() == 10)
            $html = $this->ReadHtmlBonEntrer($societe, $documentachat, $listesdocuments);
        if ($documentachat->getIdTypedoc() == 11)
            $html = $this->ReadHtmlBonSortie($societe, $documentachat, $listesdocuments);
        if ($documentachat->getIdTypedoc() == 13)
            $html = $this->ReadHtmlBonTransfert($societe, $documentachat, $listesdocuments);
        if ($documentachat->getIdTypedoc() == 12)
            $html = $this->ReadHtmlBonRetour($societe, $documentachat, $listesdocuments);
        if ($documentachat->getIdTypedoc() == 14)
            $html = $this->ReadHtmlAvoir($societe, $documentachat, $listesdocuments);
        if ($documentachat->getIdTypedoc() == 15)
            $html = $this->ReadHtmlFacture($societe, $documentachat, $listesdocuments);


        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');


        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('documentachat' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBonEntrer($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlBonEntree();
        //die($html);
        return $html;
    }

    public function ReadHtmlFacture($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlFactureImression($documentachat->getId());
        //die($html);
        return $html;
    }

    public function ReadHtmlAvoir($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlAvoir();
        //die($html);
        return $html;
    }

    public function ReadHtmlBonSortie($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlBonSortie();
        //die($html);
        return $html;
    }

    public function ReadHtmlBonTransfert($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlBonTransfert();
        //die($html);
        return $html;
    }

    public function ReadHtmlBonRetour($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlBonRetour();
        //die($html);
        return $html;
    }

    public function executeImprimerdemandedachat(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

        $listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche N°:' . $documentachat->getNumero());
        $pdf->SetSubject("demande de prix");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, '', strtoupper($entete), $soc->getAdresse());
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(5, 30, 5);
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

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
//      


        $html = $this->ReadHtmlDemandePrix($societe, $documentachat, $listesdocuments);
//die($html);
        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('demandedeprix' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlDemandePrix($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->getHtmlDemandedeprix();
        //die($html);
        return $html;
    }

    public function executeImprimerbondeponse(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

        $listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche N°:' . $documentachat->getNumero());
        $pdf->SetSubject("Bon de déponse aux comptant");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, '', strtoupper($entete), $soc->getAdresse());
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
//      


        $html = $this->ReadHtmlBondeponse($societe, $documentachat, $listesdocuments);
//die($html);
        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.

        $pdf->Output('demandedeprix' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBondeponse($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlBondeponse();
        //die($html);
        return $html;
    }

    public function executeImprimertousbondeponse(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche N°:' . $documentachat->getNumero());
        $pdf->SetSubject("Bon de déponse aux comptant");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, '', strtoupper($entete), $soc->getAdresse());
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
//      
        $idtype = $request->getParameter('idtype');

        $html = $this->ReadHtmlTousBondeponse($societe, $documentachat, $listesdocuments, $idtype);
//die($html);
        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('demandedeprix' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlTousBondeponse($societe, $documentachat, $listesdocuments, $idtype) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlTousBondeponse($idtype);
        //die($html);
        return $html;
    }

    public function executeImprimerbonexterne(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche N°:' . $documentachat->getNumero());
        $pdf->SetSubject("Bon de commande externe");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, '', strtoupper($entete), $soc->getAdresse());
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setPrintFooter(true);
        $foter = $soc->getTel();
        $adr = $soc->getAdresse();
        $pdf->setFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($foter), strtoupper($adr), '', '');
        //$pdf->setFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');
//        $pdf->setFooterData(strtoupper($foter),strtoupper($adr));
//        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
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

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        $html = $this->ReadHtmlBonexterne($documentachat);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Bon commande ' . $documentachat->getNumero() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBonexterne($documentachat) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlBonexterne();
        //die($html);
        return $html;
    }

    public function executeImprimerlistedocument(sfWebRequest $request) {
//        die('hh');
//        if($request->getParameter('arraycourrier'))
//            die($request->getParameter('arraycourrier'));
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $pdf = new sfTCPDF();

        $pdf->SetTitle('Listes des bons Commnade interne ');
        $pdf->SetSubject("Listes des bons Commnade interne");

        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($societe), PDF_HEADER_STRING);
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
//      
        //die('test=' . $request->getParameter('idtype'));

        $html = $this->ReadHtmlListesDocument($request);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('ListesBCI' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListesDocument(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $datedebut = "";
        $datefin = "";
        $etatdoc = "";

        $typedoc = Doctrine_Core::getTable('typedoc')->findOneById($_REQUEST['idtype']);

        $documentsachat = Doctrine_Core::getTable('documentachat')
                        ->createQuery('a')->where('id_typedoc=' . $_REQUEST['idtype']);
        if (isset($_REQUEST['De']) && isset($_REQUEST['à']) && $_REQUEST['De'] != "1970-01-01" && $_REQUEST['à'] != "1970-01-01") {
//            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $_REQUEST['De'] . "'");
//            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $_REQUEST['à'] . "'");
            $datedebut = $_REQUEST['De'];
            $datefin = $_REQUEST['à'];
        }
        if (isset($_REQUEST['De']) && !isset($_REQUEST['à']) && $_REQUEST['De'] != "1970-01-01") {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $_REQUEST['De'] . "'");
            $datedebut = $_REQUEST['De'];
        }
        if (!isset($_REQUEST['De']) && isset($_REQUEST['à']) && $_REQUEST['à'] != "1970-01-01") {

            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $_REQUEST['à'] . "'");

            $datefin = $_REQUEST['à'];
        }

        if (isset($_REQUEST['id_etatdoc']) && $_REQUEST['id_etatdoc'] != "") {
            $documentsachat = $documentsachat->Andwhere('id_etatdoc=' . $_REQUEST['id_etatdoc']);
            $etatdoc = Doctrine_Core::getTable('etatdocument')->findOneById($_REQUEST['id_etatdoc']);
        }

        $html.='<div class="titre"><h3 style="font-size:22px;">' . $typedoc . '</h3></div>&nbsp;<br>
                <div> 
                    <table style="width:100%;" class="tablecontenue">
                        <tr>
                            <td style="width:10%">Date</td>
                            <td style="width:90%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $datedebut . ' ==>' . $datefin . '</p></td>
                        </tr>
                        <tr>
                            <td style="width:10%">Etat</td>
                            <td style="width:90%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $etatdoc . '</p></td>
                        </tr>
                    </table>
                </div>';

        $html.='<div class="tableligne">
                    <table style="font-size:11px;" cellpadding="3">
                        <tr style="background-color:#EDEDED">
                            <th style="width: 15%; height:25px;">Numéro</th>
                            <th style="width: 15%; height:25px;">Date</th>
                            <th style="width: 20%">Référence</th>
                            <th style="width: 30%">Etat</th>   
                            <th style="width: 20%">Mnt TTC</th>
                        </tr>';

        $documentsachat = $documentsachat->OrderBy('id Asc')->execute();
        $doc = new Documentachat();
        foreach ($documentsachat as $docach) {
            $doc = $docach;
            $avisss = "";
            $aviss = Doctrine_Core::getTable('ligavisdoc')->findOneByIdDoc($doc->getId());
            if ($aviss)
                $avisss = $aviss->getAvis();
            $etat = "";
            if ($doc->getIdEtatdoc()) {
                $etatdoc = Doctrine_Core::getTable('etatdocument')->findOneById($doc->getIdEtatdoc());
                if ($etatdoc)
                    $etat = $etatdoc;
            }
            $html.='<tr>
                        <td><p>' . $doc->getNumerodocachat() . '</p></td>'
                    . '<td><p>' . date('d/m/Y', strtotime($doc->getDatecreation())) . '</p></td>';
            if ($doc->getDocumentparent())
                $html.='<td><p>' . $doc->getDocumentparent() . '<br>' . $doc->getDocumentparent()->getTiersPrint() . '</p></td>';
            else {
                $html.='<td></td>';
            }

            $html.='<td><p>' . $etat . '</p></td>
                    <td style="text-align:right;">' . number_format($doc->getMntttc(), 3, ',', '.') . '</td>
                </tr>';
        }
        $html.='</table></div>';

        return $html;
    }

    public function executeImprimerattestation(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $doc = new Contrat();
        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('contrat')->findOneById($iddoc);
        $doc = $documentachat;
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Attestation N°:');
        $pdf->SetSubject("document du contrat");
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
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlPersonnelle($doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('contrat' . $doc->getIdAgents() . $doc->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonnelle($document) {
        $html = StyleCssHeader::header1();
        // die('dd'.$document->getId().''.$document->getDateouvert());
        $html .= $document->ReadHtmlAttestation();

        return $html;
    }

    public function executeImprimerattestationdesalaire(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $doc = new Contrat();
        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('contrat')->findOneById($iddoc);
        $doc = $documentachat;
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Attestation de salaire:');
        $pdf->SetSubject("document du contrat");
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
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlAttestationdesalaire($doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('contrat' . $doc->getIdAgents() . $doc->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlAttestationdesalaire($document) {
        $html = StyleCssHeader::header1();
        $html .= $document->ReadHtmlAttestationSalaire();

        return $html;
    }

    public function executeImprimerfichebudget(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $id = $request->getParameter('idfiche');
        $titrebudget = Doctrine_Core::getTable('titrebudjet')->findOneById($id);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Budget N°:');
        $pdf->SetSubject("fiche budget");
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
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 13);

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

        $html = $this->ReadHtmlBudget($societe, $titrebudget);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Fiche Budget : ' . $titrebudget->getLibelle() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBudget($societe, $titrebudget) {
        $html = StyleCssHeader::header1();
        $user = $this->getUser()->getAttribute('userB2m');
        $html.=$titrebudget->getHtmlBudget($user);

        return $html;
    }

}
