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
                    ->where('id_typedoc=7')
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

    //Doc Achat Pager //////////////////////////////////////////////////////////////////////////////////////////
    function getDocumentAchatByPage(sfWebRequest $request) {
        $date_debut = $request->getParameter('debut');
        $date_fin = $request->getParameter('fin');
        $idfrs = $request->getParameter('idfrs');
        $idtype = $request->getParameter('idtype');
        $pager = new sfDoctrinePager('Documentachat', 10);

        $pager->setQuery(DocumentachatTable::getInstance()->getAllDocByFilter($date_debut, $date_fin, $idtype, $idfrs));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        return $pager;
    }

    public function executeIndexfrs(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;
        $this->idtype = 7;
        if ($request->getParameter('idtype'))
            $this->idtype = $request->getParameter('idtype');
        $this->form = new DocumentachatFormFilter();
        $this->typedocument = "";
        $type_document = Doctrine_Core::getTable('typedoc')->findOneById($this->idtype);
        if ($type_document)
            $this->typedocument = $type_document->getLibelle();
        //  die($request->getParameter('idtype').'hhhhhh');
        $this->date_debut = $request->getParameter('debut');
//        die($this->date_debut.'fse');
        $this->date_fin = $request->getParameter('fin');
        $this->idfrs = $request->getParameter('idfrs');
        $this->boncommandeexterne = $this->getDocumentAchatByPage($request);
        if ($this->idtype == 19)
            $this->typedocument = 'Contrat';
    }

    function getDocumentAchatByPageBDCNULL(sfWebRequest $request) {
        $date_debut = $request->getParameter('debut', date('Y') . "-01-01");
        $date_fin = $request->getParameter('fin', date('Y') . "-12-31");
        $idfrs = $request->getParameter('idfrs');
        $idtype = $request->getParameter('idtype');
        $pager = new sfDoctrinePager('Documentachat', 10);

        $pager->setQuery(DocumentachatTable::getInstance()->getAllDocByFilterBDCNULL($date_debut, $date_fin, $idtype, $idfrs));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        return $pager;
    }

    public function executeIndexfrsBDCNull(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;
        $this->idtype = 7;
        if ($request->getParameter('idtype'))
            $this->idtype = $request->getParameter('idtype');
        $this->form = new DocumentachatFormFilter();
        $this->typedocument = "";
        $type_document = Doctrine_Core::getTable('typedoc')->findOneById($this->idtype);
        if ($type_document)
            $this->typedocument = $type_document->getLibelle();
        //  die($request->getParameter('idtype').'hhhhhh');
        $this->date_debut = $request->getParameter('debut');
        $this->date_fin = $request->getParameter('fin');
        $this->idfrs = $request->getParameter('idfrs');
        $this->boncommandeexterne = $this->getDocumentAchatByPageBDCNULL($request);




//        $this->boncommandeexterne = $documentachat->getListesBdcpNonImputerBDC();
    }

    public function executeImprimerlisteBCEP(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Bon Comande Externe provisoire');
        $pdf->SetSubject("Bon Comande Externe provisoire");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->FindAll()->getFirst();
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
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(10);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 10);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlBCEXPROVI($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
        $pdf->Output('Bon commande externe provisoire.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBCEXPROVI(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBcExProisore($request);
        return $html;
    }

    public function executeImprimerlisteDeandeprix(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Demande de prix');
        $pdf->SetSubject("Demande de prix");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->FindAll()->getFirst();
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
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(10);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 10);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlDemandedeprix($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Demande de prix.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlDemandedeprix(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlDemadnedeprix($request);
        return $html;
    }

    public function executeImprimerlisteBDCP(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Bon Dépense au comptant provisoire');
        $pdf->SetSubject("Bon Dépense au comptant provisoire");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->FindAll()->getFirst();
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
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(10);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 10);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlBDCPROVI($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Bon Dépense au comptant provisoire.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBDCPROVI(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBDCProisore($request);
        return $html;
    }

    public function executeImprimerlisteBDCRegroupeP(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Bon Dépense au comptant Regroupe provisoire');
        $pdf->SetSubject("Bon Dépense au comptant Regroupe provisoire");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->FindAll()->getFirst();
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
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(10);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 10);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlBDCRegroupePROVI($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Bon Dépense au comptant provisoire.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBDCRegroupePROVI(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBDCRegroupePROVI($request);
        return $html;
    }

    public function executeImprimerlisteBCE(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Bon Comande Externe Système');
        $pdf->SetSubject("Bon Comande Externe Système");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->FindAll()->getFirst();
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
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(10);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 10);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlBCEXSysteme($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Bon commande externe Système.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBCEXSysteme(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBcExsysteme($request);
        return $html;
    }

    public function executeImprimerlisteBDCRegroupeS(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Bon Dépense au comptant Regroupe Système');
        $pdf->SetSubject("Bon Dépense au comptant Regroupe Système");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->FindAll()->getFirst();
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
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(10);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 10);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlBDCRegroupeSys($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Bon Dépense au comptant Système.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBDCRegroupeSys(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBDCRegroupeSysteme($request);
        return $html;
    }

    public function executeImprimerlisteBDCS(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Bon Dépense au comptant Système');
        $pdf->SetSubject("Bon Dépense au comptant Système");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->FindAll()->getFirst();
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
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(10);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 10);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlBDCSys($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Bon Dépense au comptant Système.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBDCSys(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBDCSysteme($request);
        return $html;
    }

    public function executeImprimerlisteContrat(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Contrat');
        $pdf->SetSubject("Contrat");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->FindAll()->getFirst();
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
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(10);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 10);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlContrat($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Contrat', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlContrat(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlListeContrat($request);
        return $html;
    }

    public function executeImprimerlisteContratDef(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Contrat');
        $pdf->SetSubject("Contrat");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->FindAll()->getFirst();
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
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(10);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 10);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlContratDef($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Contrat', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlContratDef(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlListeContratDef($request);
        return $html;
    }

    public function executeExporterlisteBCEPExcel(sfWebRequest $request) {
        $datedebut = "";
        $datefin = "";
        $reference = "";
        $datedebut = $request->getParameter('datedebut', '');
        $datefin = $request->getParameter('datefin', '');
        $idfrs = $request->getParameter('idfrs', '');
        $this->datedebut = $datedebut;
        $this->datefin = $datefin;
        $this->idfrs = $idfrs;
    }

    public function executeExporterlisteContratExcel(sfWebRequest $request) {
        $datedebut = "";
        $datefin = "";
        $reference = "";
        $datedebut = $request->getParameter('datedebut', '');
        $datefin = $request->getParameter('datefin', '');
        $idfrs = $request->getParameter('idfrs', '');
        $this->datedebut = $datedebut;
        $this->datefin = $datefin;
        $this->idfrs = $idfrs;
    }

    public function executeExporterlisteContratDefExcel(sfWebRequest $request) {
        $datedebut = "";
        $datefin = "";
        $reference = "";
        $datedebut = $request->getParameter('datedebut', '');
        $datefin = $request->getParameter('datefin', '');
        $idfrs = $request->getParameter('idfrs', '');
        $this->datedebut = $datedebut;
        $this->datefin = $datefin;
        $this->idfrs = $idfrs;
    }

    public function executeExporterlisteBCEExcel(sfWebRequest $request) {
        $datedebut = "";
        $datefin = "";
        $reference = "";
        $datedebut = $request->getParameter('datedebut', '');
        $datefin = $request->getParameter('datefin', '');
        $idfrs = $request->getParameter('idfrs', '');
        $this->datedebut = $datedebut;
        $this->datefin = $datefin;
        $this->idfrs = $idfrs;
    }

    public function executeExporterlisteBDCRegroupePExcel(sfWebRequest $request) {
        $datedebut = "";
        $datefin = "";
        $reference = "";
        $datedebut = $request->getParameter('datedebut', '');
        $datefin = $request->getParameter('datefin', '');
        $idfrs = $request->getParameter('idfrs', '');
        $this->datedebut = $datedebut;
        $this->datefin = $datefin;
        $this->idfrs = $idfrs;
    }

    public function executeExporterlisteBDCRegroupeDefExcel(sfWebRequest $request) {
        $datedebut = "";
        $datefin = "";
        $reference = "";
        $datedebut = $request->getParameter('datedebut', '');
        $datefin = $request->getParameter('datefin', '');
        $idfrs = $request->getParameter('idfrs', '');
        $this->datedebut = $datedebut;
        $this->datefin = $datefin;
        $this->idfrs = $idfrs;
    }

    public function executeExporterlisteBDCPExcel(sfWebRequest $request) {
        $datedebut = "";
        $datefin = "";
        $reference = "";
        $datedebut = $request->getParameter('datedebut', '');
        $datefin = $request->getParameter('datefin', '');
        $idfrs = $request->getParameter('idfrs', '');
        $this->datedebut = $datedebut;
        $this->datefin = $datefin;
        $this->idfrs = $idfrs;
    }

    public function executeExporterlisteBDCSExcel(sfWebRequest $request) {
        $datedebut = "";
        $datefin = "";
        $reference = "";
        $datedebut = $request->getParameter('datedebut', '');
        $datefin = $request->getParameter('datefin', '');
        $idfrs = $request->getParameter('idfrs', '');
        $this->datedebut = $datedebut;
        $this->datefin = $datefin;
        $this->idfrs = $idfrs;
    }

    public function executeExporterlisteDemandeprixExcel(sfWebRequest $request) {
        $datedebut = "";
        $datefin = "";
        $reference = "";
        $datedebut = $request->getParameter('datedebut', '');
        $datefin = $request->getParameter('datefin', '');
        $idfrs = $request->getParameter('idfrs', '');
        $this->datedebut = $datedebut;
        $this->datefin = $datefin;
        $this->idfrs = $idfrs;
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

    public function executeDeleteDemandedeprix(sfWebRequest $request) {

        $iddoc = $request->getParameter('iddemandedeprix');
        $doc_parent = Doctrine_Core::getTable('documentparent')->findOneByIdDocumentachat($iddoc);
        $doc_parent->delete();

        $ligne_doc_achats = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        foreach ($ligne_doc_achats as $ligne_doc_achat):
            $ligne_doc_achat->getQtelignedoc()->delete();
            $ligne_doc_achat->delete();
        endforeach;
        $documentachat = DocumentachatTable::getInstance()->find($iddoc);
        $documentachat->delete();

        $this->redirect('Documents/indexfrs?idtype=8');
    }

    public function executeSavedocumentprixModifier(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $delai = $params['delai'];
            $datemax = date('Y-m-d', strtotime($params['datemax']));
            $ref = $params['ref'];
            $numero_dp = $params['numerodoc'];
            $operation_dps = $params['operation_dps'];
            $listeslignesdoc = $params['listearticle'];
            $numerodossier = $params['numerodossier'];
            $lieu = $params['idlieu'];
            $frs = $params['frs'];
            $objet = $params['objet'];

            $frs = explode(',', $frs);

            for ($k = 0; $k < sizeof($frs); $k++) {
                if ($frs[$k] != '') {
                    $fournisseur = FournisseurTable::getInstance()->find($frs[$k]);

                    $documentachat = new Documentachat();
                    $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
                    $documentachat = $achat_document;
                    //______________________ajouter document demande de prix

                    $documentachat->setNumero($numero_dp);
                    $documentachat->setNumerooperation($operation_dps);
                    if ($numerodossier && $numerodossier != "")
                        $documentachat->setNumerodossier($numerodossier);
                    if ($lieu && $lieu != 0) {
                        $documentachat->setIdLieu($lieu);
                    }
                    $documentachat->setIdFrs($fournisseur->getId());
                    $documentachat->setIdTypedoc(8);
                    $documentachat->setIdDocparent($documentachat->getId());
                    //$documentachat->setReference($achat->getNumero());
                    if ($objet)
                        $documentachat->setObservation($objet);
                    $documentachat->setIdUser($user->getId());
                    $documentachat->setIdEtatdoc(10);
                    $documentachat->setDatecreation(date('Y-m-d'));
                    $documentachat->setDelaifrs($delai);

                    if ($ref && $ref != "")
                        $documentachat->setReference($ref);

                    $documentachat->setMaxreponsefrs($datemax);
                    $documentachat->save();

                    //Documents Parents
//                    for ($i = 0; $i < sizeof($iddoc); $i++) {
                    $document_parent = new Documentparent();
                    $document_parent->setIdDocumentachat($documentachat->getId());
                    $document_parent->setIdDocumentparent($iddoc);

                    $document_parent->save();
//                    }

                    foreach ($listeslignesdoc as $ldoc) {
                        $norgdre = $ldoc['norgdre'];
                        $designation = $ldoc['designation'];
                        $qte = $ldoc['qte'];
                        $unite = $ldoc['unitedemander'];
                        $id_unitemarche = $ldoc['id_unitemarche'];
                        $id_projet = $ldoc['id_projet'];

                        $lignedoc = new Lignedocachat();
                        $lignedoc->setIdDoc($documentachat->getId());
                        $lignedoc->setNordre($norgdre);
                        $lignedoc->setQte($qte);
                        if ($unite && $unite != "")
                            $lignedoc->setUnitedemander($unite);
                        if ($id_unitemarche && $id_unitemarche != "")
                            $lignedoc->setIdUnitemarche($id_unitemarche);
                        if ($id_projet && $id_projet != "")
                            $lignedoc->setIdProjet($id_projet);
                        $lignedoc->setDesignationarticle($designation);
                        $lignedoc->save();

                        $qteachat = new Qtelignedoc();
                        $qteachat->setIdLignedocachat($lignedoc->getId());
                        $qteachat->setQteaachat($qte);
                        $qteachat->save();
                        $ErpHistorique = new Erphistorique();
                        $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
                    }

                    $ErpHistorique = new Erphistorique();
                    $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);


                    $numero_dp = $numero_dp + 1;
                    $numero_dp = str_pad($numero_dp, 8, '0', STR_PAD_LEFT);
                }
            }
            die("Demande de prix modifiée avec succès");
        }

        die('Erreur .....!!!!');
    }

    public function executeAfficheFournisseur(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_docachat = $params['id'];
            $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($id_docachat);
            $id_Frs = $documentachat->getIdFrs();
            $query = "select fournisseur.id as id, concat('--- ',fournisseur.rs,' ----') as rs "
                    . " from fournisseur,documentachat"
                    . " where fournisseur.id =documentachat.id_frs "
                    . " and documentachat.id=" . $id_docachat
                    . " and documentachat.id_frs=" . $id_Frs
            ;
//            die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die("bien");
    }

    public function executeRemplirdemandedeprix(sfWebRequest $request) {

        $iddocach = $request->getParameter('iddoc');
//        die($iddocach.'id=');
        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddocach);
//          $documentachat_edit = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->documentachat = $documentachat;
        $this->ids = $iddoc;
//        $iddoc = explode(',', $iddoc);

        $id_lieu = $documentachat->getIdLieu();

        $this->lieuxlivraisons = Doctrine_Core::getTable('lieulivraisson')->findAll();

        $demande_prix = new Documentachat();
        $this->dps_numero = $demande_prix->getNumeroSeqDemandeDePrixParBCIDDSansopertaion($iddoc);

        $demande_de_prix = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedocAndIdDocparent($iddoc, 8, $iddoc);
        $this->numerodemande = $documentachat->getNumero();
        $this->refernece = $documentachat->getReference();
        $this->id_lieu = $id_lieu;
//        $this->liste_document_achats = DocumentachatTable::getInstance()->getByIds($iddoc);

        $this->fournisseurs = FournisseurTable::getInstance()->getAllFournisseurOrderByRaisonSociale();
        $id_frs = $documentachat->getIdFrs();
        $delai = $documentachat->getDelaifrs();
        $maxrepense = $documentachat->getMaxreponsefrs();
        $observation = $documentachat->getObservation();
        $this->delai = $delai;
        $this->id_frs = $id_frs;
        $this->maxrepense = $maxrepense;
        $this->observation = $observation;
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
    }

    public function executeImprimerdemandedachat(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        //$listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        $listesdocuments = Doctrine_Core::getTable('lignedocachat')
                        ->createQuery('a')
                        ->where('id_doc=' . $iddoc)->orderBy('id asc')->execute();
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche demande de prix N°:' . $documentachat->getNumero());
        $pdf->SetSubject("Demande de prix");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs()
                . '                                                                               '
                . '                  '
                . '                                           Demande de Prix';
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), 'Demande de Prix', '');
        $adresse = 'Tél: ' . $soc->getTel() . '/' . $soc->getTelephone() . '    Fax:' . $soc->getFax() . '     Mail:' . $soc->getMail() . '  '
                . '/' . $soc->getAdresse();
        $pdf->CustomFooter($adresse, '');
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, '', strtoupper($entete), $soc->getAdresse());
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $foter = $soc->getTel();
        $adr = $soc->getAdresse();
        $pdf->setPrintFooter(true);
        $tbl = 'Demande De Pdix';
//         $pdf->SetMargins(5, 30, 5);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(17);

//        $pdf->setFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($adresse), strtoupper($adr), '', '');
//       $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
        //$pdf->setFooterData(strtoupper($adresse), strtoupper($adr), '', '');
//        $pdf->setFooterData(strtoupper($foter),strtoupper($adr));
//        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
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
        $pdf->writeHTML($html, true, false, true, false, '', 'Demande de prix');
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

    public function executeImprimerlesdemandedeprix(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $iddoc = $request->getParameter('iddoc');
        $demande_prix = DocumentachatTable::getInstance()->findByIdTypedocAndIdDocparent(8, $iddoc);
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Liste des Fiches de  demande de prix');
        $pdf->SetSubject("Liste des Demande de prix");
        $soc = new Societe();

        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $logo = $soc->getLogo();
        $adresse = 'Tél: ' . trim($soc->getTel()) . '/' . trim($soc->getTelephone()) . '  Fax:' . trim($soc->getFax()) . '    '
                . '                                                                                 Mail:' . trim($soc->getMail()) . '  '
                . '/' . trim($soc->getAdresse());
        $rs = $soc->getRs()
                . '                                                                               '
                . '                  '
                . '                             ' . $adresse;
        $pdf->SetAuthor($entete);

        $pdf->SetAuthor($rs);
        //     $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), 'Demande de Prix', '');
        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), $rs, $adresse, '', '');


        $pdf->CustomFooter($adresse, '');
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, '', strtoupper($entete), $soc->getAdresse());
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $foter = $soc->getTel();
        $adr = $soc->getAdresse();
        $pdf->setPrintFooter(FALSE);
        $tbl = 'Liste des Demandes De Pdix';
//         $pdf->SetMargins(5, 30, 5);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(17);

// set default monospaced font
        //$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
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
        $html = $this->ReadHtmlListeDemandePrix($societe, $iddoc, $demande_prix);
//die($html);
        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '', 'Demande de prix');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Liste des demandedeprix' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeDemandePrix($societe, $ids, $demande_prix) {
        $html = StyleCssHeader::header1();

        $documentachat = new Documentachat();
        $html.=$documentachat->getHtmlListeDemandedeprix($ids, $demande_prix);
        //die($html);
        return $html;
    }

    public function executeImprimerlesdemandedeprixAvecCondition(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $iddoc = $request->getParameter('iddoc');
        $demande_prix = DocumentachatTable::getInstance()->findByIdTypedocAndIdDocparent(8, $iddoc);

        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Liste des Fiches de  demande de prix');
        $pdf->SetSubject("Liste des Demande de prix");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $logo = $soc->getLogo();
        $adresse = 'Tél: ' . trim($soc->getTel()) . '/' . trim($soc->getTelephone()) . '  Fax:' . trim($soc->getFax()) . '    '
                . '                                                                                 Mail:' . trim($soc->getMail()) . '  '
                . '/' . trim($soc->getAdresse());
        $rs = $soc->getRs()
                . '                                                                               '
                . '                  '
                . '                             ' . $adresse;
        $pdf->SetAuthor($entete);

        $pdf->SetAuthor($rs);
        //     $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), 'Demande de Prix', '');
        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), $rs, $adresse, '', '');

        $pdf->CustomFooter($adresse, '');
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, '', strtoupper($entete), $soc->getAdresse());
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $foter = $soc->getTel();
        $adr = $soc->getAdresse();
        $pdf->setPrintFooter(FALSE);
        $tbl = 'Liste des Demandes De Pdix';
//         $pdf->SetMargins(5, 30, 5);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(17);

//        $pdf->setFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($adresse), strtoupper($adr), '', '');
//       $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
        //$pdf->setFooterData(strtoupper($adresse), strtoupper($adr), '', '');
//        $pdf->setFooterData(strtoupper($foter),strtoupper($adr));
//        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
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


        $html = $this->ReadHtmlListeDemandePrixAvecCondisions($societe, $iddoc, $demande_prix);
//die($html);
        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '', 'Demande de prix');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Liste des demandedeprix' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeDemandePrixAvecCondisions($societe, $ids, $demande_prix) {
        $html = StyleCssHeader::header1();

        $documentachat = new Documentachat();
        $html.=$documentachat->getHtmlListeDemandedeprixAvecConditions($ids, $demande_prix);
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

    public function executeImprimerbondeponseRegrouppe(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

        $listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche N°:' . $documentachat->getNumero());
        $pdf->SetSubject("Bon de déponse aux comptant Regroupe");
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


        $html = $this->ReadHtmlBondeponseRegroupe($societe, $documentachat, $listesdocuments);
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

    public function ReadHtmlBondeponseRegroupe($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $doc = new Documentachat();
        $html.=$documentachat->ReadHtmlBondeponseRegroupe($documentachat->getId());
        //die($html);
        return $html;
    }

    public function executeImprimertousbondeponse(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $documentachat = new Documentachat();
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
        $adresse = 'Téléphone:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, '', strtoupper($entete), $soc->getAdresse());
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        // $pdf->setPrintFooter(true);
//        $pdf->setFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($foter), strtoupper($adr), '', '');
        //$pdf->setFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');
//        $pdf->setFooterData(strtoupper($foter),strtoupper($adr));
//        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->CustomFooter($adresse, '');
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
        $doc = new Documentachat();
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
        $reference = "";
        $datedebut = $request->getParameter('datedebut', '');
        $datefin = $request->getParameter('datefin', '');
        $reference = $request->getParameter('reference', '');
        $numero = $request->getParameter('numero', '');
        // $typedoc = Doctrine_Core::getTable('typedoc')->findOneById($_REQUEST['idtype']);
        $id_typedoc = 6;
        $typedoc = Doctrine_Core::getTable('typedoc')->findOneById($id_typedoc);
        $documentsachat = Doctrine_Core::getTable('documentachat')
                ->createQuery('a')
                ->where('id_typedoc=' . 6)
        ;
        if ($datedebut != '')
            $documentsachat->andWhere("datecreation>=' " . $datedebut . "'");
        if ($datefin != '')
            $documentsachat->andWhere("datecreation<='" . $datefin . "'");
        if ($datefin == '' && $datedebut == '')
            $documentsachat->Andwhere("datecreation>='" . date('Y') . "-01-01" . "'")
                    ->Andwhere("datecreation<='" . date('Y') . "-12-31" . "'");
        if ($reference != '')
            $documentsachat->andWhere("a.reference like '%" . $reference . "%'");
        if ($numero != '')
            $documentsachat->andWhere("a.numero =" . $numero . "");

//        if (isset($_REQUEST['De']) && isset($_REQUEST['à']) && $_REQUEST['De'] != "1970-01-01" && $_REQUEST['à'] != "1970-01-01") {
//            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $_REQUEST['De'] . "'");
//            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $_REQUEST['à'] . "'");
//            $datedebut = $_REQUEST['De'];
//            $datefin = $_REQUEST['à'];
//        }
//        if (isset($_REQUEST['De']) && !isset($_REQUEST['à']) && $_REQUEST['De'] != "1970-01-01") {
//            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $_REQUEST['De'] . "'");
//            $datedebut = $_REQUEST['De'];
//        }
//        if (!isset($_REQUEST['De']) && isset($_REQUEST['à']) && $_REQUEST['à'] != "1970-01-01") {
//
//            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $_REQUEST['à'] . "'");
//
//            $datefin = $_REQUEST['à'];
//        }
//
//        if (isset($_REQUEST['id_etatdoc']) && $_REQUEST['id_etatdoc'] != "") {
//            $documentsachat = $documentsachat->Andwhere('id_etatdoc=' . $_REQUEST['id_etatdoc']);
//            $etatdoc = Doctrine_Core::getTable('etatdocument')->findOneById($_REQUEST['id_etatdoc']);
//        }

        $html.='<div class="titre"><h3 style="font-size:22px;"> Liste des Bons Commande Interne (Système)</h3></div>&nbsp;<br>
                <div> ';

        $html .= '<table cellspacing="0" cellpadding="2" border="1">
                    <tr>
                        <td style="font-size:12px;width:100%;"><span style="margin-top:10px; color:#000;font-weight:bold;font-size:14px;">Recherche suivant :</span>
                                <ul style="width:100%;">';
        if ($datedebut && $datefin) {
            $html.= ' <li>  <b>Période Du :</b> &nbsp;&nbsp;' . date('d/m/Y', strtotime($datedebut)) . '&nbsp;&nbsp;';
            $html .= ' <b>Au : </b> &nbsp;&nbsp;' . date('d/m/Y', strtotime($datefin)) . '</li>';
        }
        if ($datedebut && !$datefin) {
            $html.= ' <li>  <b>Date Du :</b> &nbsp;&nbsp;' . date('d/m/Y', strtotime($datedebut)) . '&nbsp;&nbsp;';
            $html .=  '</li>';
        }
        if ($datefin != '' && !$datedebut) {
            $html .= '</li> <b>Date Au : </b> &nbsp;&nbsp;' . date('d/m/Y', strtotime($datefin)) . '</li>';
        }

        if ($reference)
            $html.='<li> &nbsp;&nbsp;<b>Référence : </b>' . $reference . '</li> ';
        if ($numero)
            $html.='<li>&nbsp;&nbsp;<b>Numéro Système: </b>' . $numero . '</li> ';
        $html .= '   </ul></td>
                    </tr>';
        $html.=' </table>&nbsp;<br>';
        $html.='<div class="tableligne">
                    <table style="font-size:11px;" cellpadding="3">
                        <tr style="background-color:#EDEDED">
                            <th style="width: 15%; height:25px;">Numéro</th>
                            <th style="width: 15%; height:25px;">Date</th>
                            <th style="width: 20%">Référence</th>
                            <th style="width: 50%">Etat</th>   
                           
                        </tr>';

        $documentsachat = $documentsachat->OrderBy('id Asc')->execute();
        $doc = new Documentachat();
        if (sizeof($documentsachat) == 0) :
            $html .= '<tr><td style="text-align:center;font-weight:bold;font-size:16px;" colspan="4">Liste Des BCIS Vide</td> </tr>';
        else :
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
//            if ($doc->getDocumentparent())
//                $html.='<td><p>' . $doc->getDocumentparent() . '<br>' . $doc->getDocumentparent()->getTiersPrint() . '</p></td>';
//            else {
//                $html.='<td></td>';
//            }
                $html.='<td><p>' . $doc->getReference() . '</p></td>';
                $html.='<td><p>' . $etat . '</p></td>
                    
                </tr>';
            } endif;
        $html.='</table></div>';

        return $html;
    }

    public function executeImprimerreclamation(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $id = $request->getParameter('iddoc');
        $reclamation = Doctrine_Core::getTable('reclamationfrs')->findOneById($id);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Réclamation');
        $pdf->SetSubject("Fiche Réclamation");

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

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        $html = $this->ReadHtmlReclamation($reclamation);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Réclamation' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlReclamation($reclamation) {
        $html = StyleCssHeader::header1();
        $rec = new Reclamationfrs();
        $rec = $reclamation;
        $html.='<div class="contenue">
                    <div class="titre"><h3 style="font-size: 18px;">Réclamation Fournisseur</h3></div>
                    &nbsp;<br>
                    <div> 
                        <table style="width:100%;" class="tablecontenue">
                            <tr>
                                <td style="width:15%">Date</td> 
                                <td style="width:2%">:</td>
                                <td style="width:83%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . date('d/m/Y', strtotime($rec->getDaterec())) . '</p></td>
                            </tr>
                            <tr>
                                <td style="width:15%;">Object</td>
                                <td style="width:2%">:</td>
                                <td style="width:83%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $rec->getObject() . '</p></td>
                            </tr>
                             <tr>
                                <td style="width:15%">Fournisseur</td>
                                <td style="width:2%">:</td>
                                <td style="width:83%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $rec->getFournisseur() . '</p></td>
                            </tr>
                        </table>
                    </div>
                    <div style="text-align:justify;">Sujet :<br>&nbsp;<br>
                        <table cellpadding="3">
                            <tr>
                                <td style="width:2%"></td>
                                <td style="width:98%;">' . html_entity_decode($rec->getSujet()) . '</td>
                            </tr>
                            <tr>
                                <td style="width:2%"></td>
                                <td style="width:98%; text-align: center; font-size: 18px;">&nbsp;<br>* * * * *</td>
                            </tr>
                        </table>
                    </div>
                </div>';

        return $html;
    }

    public function executeImprimerAnnexBCEP(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche ANNEXE :' . $documentachat->getNumerodocachat());
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
        //      $pdf->setFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($foter), strtoupper($adr), '', '');
        //  $pdf->setFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');
        //  $pdf->setFooterData(strtoupper($foter),strtoupper($adr));
        // $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
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

        $html = $this->ReadHtmlAnnexe($documentachat);

        // Print text using writeHTMLCell()
        // output the HTML content
        //   ob_end_clean();
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Bon commande ' . $documentachat->getNumero() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlAnnexe($documentachat) {
        $html = StyleCssHeader::header1();
        $doc = new Documentachat();
        $html.=$documentachat->ReadHtmlAnnexe();

        return $html;
    }

}
