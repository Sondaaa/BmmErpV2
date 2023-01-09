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

    public function executeShowdocument(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')
            ->createQuery('a')
            ->where('id_doc=' . $iddoc)->orderBy('id asc')->execute();
        //Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
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

        $logo = PDF_HEADER_LOGO . '/' . $societe->getLogo();
        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, $entete, $rs, '', '');

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
        $html .= $documentachat->ReadHtmlBonCommandeInterne($aviss, $listesdocuments);
        return $html;
    }
    public function executeImprimerboncomande(sfWebRequest $request)
    {
        $iddoc = $request->getParameter('iddoc');
        $pdf = new sfTCPDF('L');
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche D.I.');
        $pdf->SetSubject("Fiche D.I.");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $logo = '';
        //$soc->getLogo();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail()
            . '<br>Adresse:' . $soc->getAdresse() . '';
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);

        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, $entete, $rs, '', '');

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

        $html = $this->ReadHtmlBoncommande($iddoc);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Fiche D.I..pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBoncommande($iddoc)
    {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBoncommmande($iddoc);
        return $html;
    }

    public function executeValiderbci(sfWebRequest $request)
    {

        $iddoc = $request->getParameter('id');
        $date = $request->getParameter('date');
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');
        $documentachat = DocumentachatTable::getInstance()->find($iddoc);
        $documentachat->setDatesigntaurechepro($date);
        $documentachat->setValidebciresponsableprojet(true);
        $documentachat->setIdEtatdoc(95);
        if ($user->getIsCheflabo()) {
            $documentachat->setDatesigntaurechelabo($date);
            $documentachat->setValidebciresponsablelabo(true);
            if ($documentachat->getIdTypedoc() == 6) {
                $documentachat->setIdEtatdoc(24);
            } else {
                $documentachat->setIdEtatdoc(104);
            }
        }


        // $documentachat->setValide(true);
        $documentachat->save();

        $this->redirect('@documentachat');
    }

    public function executeValiderbcicheflabo(sfWebRequest $request)
    {

        $iddoc = $request->getParameter('id');
        $date = $request->getParameter('date');

        $documentachat = DocumentachatTable::getInstance()->find($iddoc);
        $documentachat->setDatesigntaurechelabo($date);
        $documentachat->setValidebciresponsablelabo(true);
        if ($documentachat->getIdTypedoc() == 6) {
            $documentachat->setIdEtatdoc(24);
        } else {
            $documentachat->setIdEtatdoc(104);
        }

        $documentachat->setValide(true);
        $documentachat->save();

        $this->redirect('@documentachat');
    }
    public function executeAnnuler(sfWebRequest $request)
    {
        $iddoc = $request->getParameter('iddoc');
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

    public function executeValiderAnnulation(sfWebRequest $request)
    {
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');
        $iddoc = $request->getParameter('id');
        $motif = $request->getParameter('motif');
        $url = $request->getParameter('url');
        $id_labo = json_decode($user->getIdLabo());
        $id_projet = json_decode($user->getIdProjet());

        //die($id_labo[0]);
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $documentachat->setEtatdocachat('Annulé(e)');
        if ($id_projet[0]) {
            $documentachat->setIdEtatdoc(97);
        }
        if ($id_labo[0]) {
            $documentachat->setIdEtatdoc(98);
        }
        $documentachat->save();

        $doc_annulation = DocumentachatannulationTable::getInstance()->findOneByIdDocumentachat($iddoc);
        if ($doc_annulation) {
            $annulation = $doc_annulation;
        } else {
            $annulation = new Documentachatannulation();
        }

        $annulation->setDateannulation(date('Y-m-d'));
        $annulation->setIdDocumentachat($iddoc);
        $annulation->setIdUser($user->getId());
        $annulation->setMotifannulation($motif);
        $annulation->setUrldocumentscan($url);
        if ($id_labo[0]) {
            $annulation->setIdLabo($id_labo[0]);
        }
        if ($id_projet[0]) {
            $annulation->setIdProjet($id_projet[0]);
        }
        $annulation->setValideBudget(false);
        $annulation->save();

        die('bien');
    }
    public function executeListeAnnule(sfWebRequest $request)
    {
        $this->texte = "";
        $this->id = "";
        $this->date_debut = $request->getParameter('debut');
        $this->id_type = $request->getParameter('id_type');
        $this->date_fin = $request->getParameter('fin');
        $this->idfrs = $request->getParameter('idfrs');
        // $this->id_user = $request->getParameter('id_user');
        $this->pager = $this->getDocumentachatAnnuler($request);
    }
    public function getDocumentachatAnnuler(sfWebRequest $request)
    {
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');
        $date_debut = $request->getParameter('debut');
        $id_type = $request->getParameter('id_type');

        //    $id_user_anuelr = $request->getParameter('id_user');
        $this->id_type = $id_type;
        $date_fin = $request->getParameter('fin');
        $idfrs = $request->getParameter('idfrs');
        $page = $request->getParameter('page', 1);
        $pager = new sfDoctrinePager('Documentachatannulation', 5);
        $pager->setQuery(DocumentachatannulationTable::getInstance()->getAllDocAnnulerchefprojet($date_debut, $date_fin, $id_type, $user->getId()));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        return $pager;
    }

    public function executeListeAnnuleautreadmin(sfWebRequest $request)
    {
        $this->texte = "";
        $this->id = "";
        $this->date_debut = $request->getParameter('debut');
        $this->id_type = $request->getParameter('id_type');
        $this->date_fin = $request->getParameter('fin');
        $this->idfrs = $request->getParameter('idfrs');
        // $this->id_user = $request->getParameter('id_user');
        $this->pager = $this->getDocumentachatAnnulerAutreadmin($request);
    }
    public function getDocumentachatAnnulerAutreadmin(sfWebRequest $request)
    {
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');
        $date_debut = $request->getParameter('debut');
        $id_type = $request->getParameter('id_type');

        //    $id_user_anuelr = $request->getParameter('id_user');
        $this->id_type = $id_type;
        $date_fin = $request->getParameter('fin');
        $idfrs = $request->getParameter('idfrs');
        $page = $request->getParameter('page', 1);
        $pager = new sfDoctrinePager('Documentachatannulation', 5);
        $pager->setQuery(DocumentachatannulationTable::getInstance()->getAllDocAnnulerchefprojetAutreadmin($date_debut, $date_fin, $id_type, $user->getId()));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        return $pager;
    }
    public function executeShowAnnule(sfWebRequest $request)
    {
        $iddoc = $request->getParameter('iddoc');
        $this->document_annule = DocumentachatannulationTable::getInstance()->findOneByIdDocumentachat($iddoc);
        $this->id = $iddoc;
    }
    public function executeImprimerlisteDocachatAnnuler(sfWebRequest $request)
    {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $pdf = new sfTCPDF();
        $pdf->SetTitle('Listes des bons Commnades Annulés ');
        $pdf->SetSubject("Listes des bons Commnade Annulés");

        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $logo = PDF_HEADER_LOGO . '/' . $societe->getLogo();
        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, $entete, $rs, '', '');

        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($societe), PDF_HEADER_STRING);
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

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
        //
        //die('test=' . $request->getParameter('idtype'));

        $html = $this->ReadHtmlListesDocumentAnnule($request);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('ListesBCI Annulés' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }
    public function executeIndex(sfWebRequest $request)
    {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }

        $id_valide = $request->getParameter('id_valide');
        $this->id_valide = $id_valide;
        $this->pager = $this->getPager();
        $this->sort = $this->getSort();
    }
    protected function getPager()
    { // $this->id_valide = $id_valide;
        $id_valide = $this->id_valide;
        $pager = $this->configuration->getPager('documentachat');
        $pager->setQuery($this->buildQuery());
        $pager->setPage($this->getPage());
        $pager->init();

        return $pager;
    }
    protected function buildQuery()
    {
        // $this->id_valide = $id_valide;
        $id_valide = $this->id_valide;

        $user = $this->getUser()->getAttribute('userB2m');
        $tableMethod = $this->configuration->getTableMethod();

        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }
        $this->filters->setTableMethod($tableMethod);
        $filter = $this->getFilters();
        $query = $this->filters->buildQuery($this->getFilters());

        $id_labo = json_decode($user->getIdLabo(), true);
        if ($user->getIdProjet() && $user->getIdProjet() != '' && $user->getIdProjet() != 'null') {
            $id_projet = json_decode($user->getIdProjet());
        } else {
            $id_projet = [];
        }
        if ($user->getIsChefprojet() == 'true' && $id_valide != '1') {
            $documentsachat = Doctrine_Core::getTable('documentachat')
                ->createQuery('a')
                ->where('a.id_typedoc = 4')
                ->andWhere('a.id_etatdoc = 94')
                ->andWhere('a.datesigntaurechepro is  null')
                ->andwhereIn('documentachat.id_projet', $id_projet);
        }

        if ($id_valide == '1' && $user->getIsChefprojet() == true) {
            if ($user->getIsChefprojet() == true) {
                $documentsachat = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')
                    //    ->where('a.id_typedoc = 4')
                    // ->andWhere('a.datesigntaurechepro is not null')
                    ->andwhere('a.validebciresponsableprojet =' . 'true');
            }
        }

        if ($user->getIsCheflabo() == true && $id_valide != '1') {
            $documentsachat = Doctrine_Core::getTable('documentachat')
                ->createQuery('a')
                ->where('a.id_typedoc = 4')
                //->andWhere('a.id_etatdoc = 95')
                ->andwhereIn('documentachat.id_emplacement', $id_labo);
        }
        if ($id_valide == '1' && $user->getIsCheflabo() == true) {
            if ($user->getIsCheflabo() == true) {
                $documentsachat = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')
                    //   ->where('a.id_typedoc = 4')
                    //    ->andWhere('a.datesigntaurechelabo is not null')
                    ->andwhere('a.validebciresponsablelabo =' . 'true')
                    ->andwhereIn('documentachat.id_emplacement', $id_labo);
            }
        }
        // die($documentsachat);
        // if ($user->getId()) {
        //     $documentsachat = $documentsachat->andWhere('a.id_user = ' . $user->getId());
        // }

        //  die($documentsachat);
        if (isset($filter['reference'])) {
            $documentsachat = $documentsachat->Andwhere("reference like '%" . $filter['reference'] . "%'");
        }

        if (isset($filter['numero']) && is_numeric($filter['numero'])) {
            $documentsachat = $documentsachat->Andwhere("numero = " . $filter['numero'] . "");
        }

        if (isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        } elseif (isset($filter['datecreation']['from']) && !isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . date('Y') . "-12-31" . "'");
        } elseif (!isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . date('Y') . "-01-01" . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        }
        //die($documentsachat);

        // if (isset($filter['id_etatdoc'])) {
        //     $documentsachat = $documentsachat->Andwhere('id_etatdoc=' . $filter['id_etatdoc']);
        // }
        // die($documentsachat);
        $query = $documentsachat->OrderBy('id desc');
        $this->addSortQuery($query);

        return $query;
    }
    public function ReadHtmlListesDocumentAnnule(sfWebRequest $request)
    {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBCIAnnule($request);
        return $html;
    }

    public function executeGetListeBCIAnnuler(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_typedoc = $params['id_typedoc'];
            $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero,"
                . " naturedocachat.code as type , documentachatannulation.id_user as id_user"
                . " from documentachat, naturedocachat,documentachatannulation "
                . " where documentachat.id_naturedoc=naturedocachat.id "
                . "  and documentachatannulation.id_documentachat=documentachat.id"
                . " AND documentachat.id_typedoc =  " . 4
                // . " AND documentachat.id_naturedoc =  2"

                . " AND (documentachat.id_etatdoc=  98 or documentachat.id_etatdoc=  94  )"
                . " order by documentachat.id desc ";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        die('rien');
    }

    public function executeGetListeBCIlabo(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        $id_projet = '';
        if ($user->getIdProjet() && $user->getIdProjet() != '' && $user->getIdProjet() != 'null') {
            $id_projet = json_decode($user->getIdProjet());
        } else {
            $id_projet = [];
        }
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_typedoc = $params['id_typedoc'];
            $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 7, '0') as numero,"
                . " naturedocachat.code as type , documentachat.id_user as id_user"
                . " from documentachat, naturedocachat "
                . " where documentachat.id_naturedoc=naturedocachat.id "
                . " AND documentachat.id_typedoc =  " . 4
                // . " AND documentachat.id_naturedoc =  2"
                . " and   id_projet IN (" . implode(',', array_map('intval', $id_projet)) . ") "
                // ->andwhereIn('documentachat.id_projet', $id_projet)
                . " AND documentachat.id_etatdoc=  94 ";
            // if(count($id_projet)>0)
            // $query.= " and documentachat.id_projet in ".$id_projet;
            $query .= " order by documentachat.id desc ";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        die('rien');
    }

    public function executeGetListeBCIAdminlabo(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if ($user->getIdLabo() && $user->getIdLabo() != '' && $user->getIdLabo() != 'null') {
            $id_labo = json_decode($user->getIdLabo());
        } else {
            $id_labo = [];
        }
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_typedoc = $params['id_typedoc'];
            $query = "select documentachat.id as id,
             LPAD(documentachat.numero::text, 7, '0') as numero,"
                . " naturedocachat.code as type ,
             documentachat.id_user as id_user"
                . " from documentachat, naturedocachat "
                . " where documentachat.id_naturedoc=naturedocachat.id "
                . " AND documentachat.id_typedoc =  " . 4
                . " AND documentachat.id_etatdoc=  95 "
                . " and   documentachat.id_emplacement IN (" . implode(',', array_map('intval', $id_labo)) . ") ";
            // if(count($id_labo)>0)
            // $query.= " and documentachat.id_emplacement in ".$id_labo;
            $query .= " order by documentachat.id desc ";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        die('rien');
    }
}
