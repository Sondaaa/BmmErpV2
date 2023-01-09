<?php

/**
 * Accueil actions.
 *
 * @package    Bmm
 * @subpackage Accueil
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AccueilActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
   public function executeShowSuivicommande(sfWebRequest $request)
    {
        $this->offset = 0;
        $this->start_date = date('Y-m-d', strtotime(date('Y/m/01')));
        $this->id_bci = null;
        $this->id_bce = null;
        $this->id_bcedef = null;
        $this->id_bcilabo = null;
        $this->id_fac = null;            
        if ($request->getParameter('start')) {
            $this->start_date = date('Y-m-d', strtotime($request->getParameter('start')));
        }
        $d = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
        $this->end_date = date('Y-m-d', strtotime(date("Y") . '-' . date("m") . '-' . $d));
        if ($request->getParameter('end')) {
            $this->end_date = date('Y-m-d', strtotime($request->getParameter('end')));
        }
        if ($request->getParameter('id_bci')) {
            $this->id_bci = $request->getParameter('id_bci');
        }
        if ($request->getParameter('id_bce')) {
            $this->id_bce = $request->getParameter('id_bce');
        }
        if ($request->getParameter('id_bce')) {
            $this->id_bce = $request->getParameter('id_bce');
        }
        if ($request->getParameter('id_bcilabo')) {
            $this->id_bcilabo = $request->getParameter('id_bcilabo');
        }
        if ($request->getParameter('id_fac')) {
            $this->id_fac = $request->getParameter('id_fac');
        }
        
        if ($request->getParameter('id_bcedef')) {
            $this->id_bcedef = $request->getParameter('id_bcedef');
        }
        $this->documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDate(6, 5, $this->offset, $this->start_date, $this->end_date, $this->id_bci, $this->id_bce,$this->id_bcedef,$this->id_fac, $this->id_bcilabo);

        $this->AllBCI = DocumentachatTable::getInstance()->getAllBciByDate(6, $this->start_date, $this->end_date, $this->id_bci, $this->id_bce);
        $this->AllBCE = DocumentachatTable::getInstance()->getAllBciByDateBCE($this->start_date, $this->end_date, $this->id_bci, $this->id_bce);
        $this->AllBCEDef = DocumentachatTable::getInstance()->getAllBciByDateBCEdef($this->start_date, $this->end_date, $this->id_bci, $this->id_bce, $this->id_bcedef);
        $this->AllBCIlabo = DocumentachatTable::getInstance()->getAllBciByDateBCILabo($this->start_date, $this->end_date, $this->id_bci, $this->id_bce);
        $this->AllFacture = DocumentachatTable::getInstance()->getAllBciByDateFacture($this->start_date, $this->end_date, $this->id_bci, $this->id_bce, $this->id_bcedef);
       
        
        
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
        $id_bce = null;
        $id_fac = null;
        $id_bcedef = null;
        $id_bcilabo = null;
        if (!empty($content)) {
            $params = json_decode($content, true);

            if ($params['start_date']) {
                $this->start_date = date('Y-m-d', strtotime($params['start_date']));
            }

            if ($params['end_date']) {
                $this->end_date = date('Y-m-d', strtotime($params['end_date']));
            }

            if ($params['offset']) {
                $this->offset = ($params['offset'] - 1) * 5;
            }
            if ($params['id_bci'] && is_numeric($params['id_bci'])) {
                $id_bci = intval($params['id_bci']);
            }
            if ($params['id_bce'] && is_numeric($params['id_bce'])) {
                $id_bce = intval($params['id_bce']);
            }
            if ($params['id_fac'] && is_numeric($params['id_fac'])) {
                $id_fac = intval($params['id_fac']);
            }
            if ($params['id_bcedef'] && is_numeric($params['id_bcedef'])) {
                $id_bcedef = intval($params['id_bcedef']);
            }
            if ($params['id_bcilabo'] && is_numeric($params['id_bcilabo'])) {
                $id_bcilabo = intval($params['id_bcilabo']);
            }
        }
        $documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDate(6, 5, $this->offset, $this->start_date, $this->end_date, $id_bci);

        return $this->renderPartial("listCommandes", array("documentachats" => $documentachats));
    }
    public function executeShowSuivicontratlivraisontotal(sfWebRequest $request) {
        
    }

    public function executeShowSuivicontrattotal(sfWebRequest $request)
    {
        $this->offset = 0;
        $this->start_date = date('Y-m-d', strtotime(date('Y/m/01')));
        $this->id_bci = null;
        $this->id_contart = null;
        $this->id_contratdef = null;
        $this->id_bcilabo = null;
        $this->id_fac = null;
        if ($request->getParameter('start')) {
            $this->start_date = date('Y-m-d', strtotime($request->getParameter('start')));
        }
        $d = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
        $this->end_date = date('Y-m-d', strtotime(date("Y") . '-' . date("m") . '-' . $d));
        if ($request->getParameter('end')) {
            $this->end_date = date('Y-m-d', strtotime($request->getParameter('end')));
        }
        if ($request->getParameter('id_bci')) {
            $this->id_bci = $request->getParameter('id_bci');
        }
        if ($request->getParameter('id_contart')) {
            $this->id_contart = $request->getParameter('id_contart');
        }
        
        // if ($request->getParameter('id_bcilabo')) {
        //     $this->id_bcilabo = $request->getParameter('id_bcilabo');
        // }
        if ($request->getParameter('id_fac')) {
            $this->id_fac = $request->getParameter('id_fac');
        }

        if ($request->getParameter('id_contratdef')) {
            $this->id_contratdef = $request->getParameter('id_contratdef');
        }
        $this->documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDateContrat(6, 5, $this->offset, $this->start_date, $this->end_date, $this->id_bci, $this->id_contart, $this->id_contratdef, $this->id_fac);

        $this->AllBCI = DocumentachatTable::getInstance()->getAllBciByDate(6, $this->start_date, $this->end_date, $this->id_bci, $this->id_bce);
        $this->Allcontratprovisoire = DocumentachatTable::getInstance()->getAllDatecontrat(19,$this->start_date, $this->end_date, $this->id_bci, $this->id_bce);
        $this->AllcontratDef = DocumentachatTable::getInstance()->getAllDatecontrat(20,$this->start_date, $this->end_date, $this->id_bci, $this->id_bce, $this->id_bcedef);
        $this->AllBCIlabo = DocumentachatTable::getInstance()->getAllBciByDateBCILabo($this->start_date, $this->end_date, $this->id_bci, $this->id_bce);
        $this->AllFacture = DocumentachatTable::getInstance()->getAllBciByDateFacture($this->start_date, $this->end_date, $this->id_bci, $this->id_bce, $this->id_bcedef);
}

    public function executeGetcommandebypagerBCIContrat(sfWebRequest $request)
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

            if ($params['start_date']) {
                $this->start_date = date('Y-m-d', strtotime($params['start_date']));
            }

            if ($params['end_date']) {
                $this->end_date = date('Y-m-d', strtotime($params['end_date']));
            }

            if ($params['offset']) {
                $this->offset = ($params['offset'] - 1) * 5;
            }
            if ($params['id_bci'] && is_numeric($params['id_bci'])) {
                $id_bci = intval($params['id_bci']);
            }
        }
        $documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDateBCICONTRAT(6, 5, $this->offset, $this->start_date, $this->end_date, $id_bci);
        return $this->renderPartial("listCommandesBcicontrat", array("documentachats" => $documentachats));
    }

    public function executeGetcommandebypagerContrat(sfWebRequest $request)
    {
        $params = array();
        $content = $request->getContent();
        $this->offset = 0;
        $this->start_date = date('Y-m-d', strtotime(date('Y/m/01')));
        $d = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
        $this->end_date = date('Y-m-d', strtotime(date("Y") . '-' . date("m") . '-' . $d));
        $id_bci = null;
        $id_bce = null;
        $id_fac = null;
        $id_bcedef = null;
        $id_bcilabo = null;
        if (!empty($content)) {
            $params = json_decode($content, true);

            if ($params['start_date']) {
                $this->start_date = date('Y-m-d', strtotime($params['start_date']));
            }

            if ($params['end_date']) {
                $this->end_date = date('Y-m-d', strtotime($params['end_date']));
            }

            if ($params['offset']) {
                $this->offset = ($params['offset'] - 1) * 5;
            }
            if ($params['id_bci'] && is_numeric($params['id_bci'])) {
                $id_bci = intval($params['id_bci']);
            }
            if ($params['id_contart'] && is_numeric($params['id_contart'])) {
                $id_contart = intval($params['id_contart']);
            }
            if ($params['id_fac'] && is_numeric($params['id_fac'])) {
                $id_fac = intval($params['id_fac']);
            }
            if ($params['id_contratdef'] && is_numeric($params['id_contratdef'])) {
                $id_contratdef = intval($params['id_contratdef']);
            }
            if ($params['id_bcilabo'] && is_numeric($params['id_bcilabo'])) {
                $id_bcilabo = intval($params['id_bcilabo']);
            }
        }
    //    $documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDate(6, 5, $this->offset, $this->start_date, $this->end_date, $id_bci);

      
    
        $documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDateContrat(6, 5, $this->offset, $this->start_date, $this->end_date, $id_bci);

        return $this->renderPartial("listCommandescontrat", array("documentachats" => $documentachats));
    }

    public function executeShowSuiviBcicontrat(sfWebRequest $request)
    {
        $this->offset = 1;
        $this->start_date = date('Y-m-d', strtotime(date('Y/m/01')));
        if ($request->getParameter('start')) {
            $this->start_date = date('Y-m-d', strtotime($request->getParameter('start')));
        }

        $d = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
        $this->end_date = date('Y-m-d', strtotime(date("Y") . '-' . date("m") . '-' . $d));
        if ($request->getParameter('end')) {
            $this->end_date = date('Y-m-d', strtotime($request->getParameter('end')));
        }

        if ($request->getParameter('id_bci')) {
            $this->id_bci = $request->getParameter('id_bci');
        }

        $this->documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDateBCICONTRAT(6, 5, $this->offset, $this->start_date, $this->end_date, $this->id_bci);
        $this->AllBCI = DocumentachatTable::getInstance()->getAllBciByDateBCIContrat(6, $this->start_date, $this->end_date, $this->id_bci);
    }

    public function executeShowSuivicontrat(sfWebRequest $request)
    {
        //          $this->boncommandeexterne = $this->getDocumentAchatByPage($request);
    }


    public function executeTableauBord(sfWebRequest $request) {
        $this->contratprofisoire = $this->getAllContratprovisoireAnnule($request);
        $this->contrat_courants = $this->getContratDefinitifAchatByPage($request);
        $this->contrat_provisoire = $this->getContratAchatByPage($request);
        $this->contratdefannule = $this->getAllContratdefinitifAnnule($request);
        $this->contrat_resilier = $this->getAllContratresilier($request);
//      
    }

    function getAllContratprovisoireAnnule(sfWebRequest $request) {
        $pager = new sfDoctrinePager('Contratachat', 5);
        $pager->setQuery(ContratachatTable::getInstance()->getAllContratProviAnnule());
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    function getAllContratdefinitifAnnule(sfWebRequest $request) {
        $pager = new sfDoctrinePager('Contratachat', 5);
        $pager->setQuery(ContratachatTable::getInstance()->getAllContratDefAnnule());
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    function getContratDefinitifAchatByPage(sfWebRequest $request) {
        $date_debut = $request->getParameter('debut', date('Y') . "-01-01");
        $date_fin = $request->getParameter('fin', date('Y') . "-12-31");
        $pager = new sfDoctrinePager('Documentachat', 5);
        $pager->setQuery(ContratachatTable::getInstance()->getAllDocByFilterDefinitifAvecdact($date_debut, $date_fin));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        return $pager;
    }

    function getContratAchatByPage(sfWebRequest $request) {
        $date_debut = $request->getParameter('debut', date('Y') . "-01-01");
        $date_fin = $request->getParameter('fin', date('Y') . "-12-31");
        $pager = new sfDoctrinePager('Documentachat', 5);
        $pager->setQuery(ContratachatTable::getInstance()->getAllDocByFilterProvisoire($date_debut, $date_fin));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        return $pager;
    }

    function getAllContratresilier(sfWebRequest $request) {
        $pager = new sfDoctrinePager('Contratachat', 5);
        $pager->setQuery(ContratachatTable::getInstance()->getAllContratDefResilier());
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeImprimerFicheBoncommandeAvecChoix(sfWebRequest $request) {
        $pdf = new sfTCPDF('L');
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Suivi des bons commandes ');
        $pdf->SetSubject("Suivi des bons commandes ");
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
        $html = $this->ReadHtmlSuivibce($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Suivi des bons commandes .pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlSuivibce(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlSuivibce($request);
        return $html;
    }

    public function executeImprimerFicheBDCeAvecChoix(sfWebRequest $request) {
        $pdf = new sfTCPDF('L');
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Suivi des bon dépense au comptant');
        $pdf->SetSubject("Suivi des  bon depense au comptant");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findAll()->getFirst();
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
        $html = $this->ReadHtmlSuivibdc($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Suivi des  bon depense au comptant.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlSuivibdc(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlSuivibdc($request);
        return $html;
    }

   public function executeExportersuivibce(sfWebRequest $request) {
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
        $this->documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDate(6, null, null, $this->start_date, $this->end_date, $this->id_bci);
    }

    public function executeExportersuivicontrattotal(sfWebRequest $request) {
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
        $this->documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDateContrat(19, null, null, $this->start_date, $this->end_date, $this->id_bci);
    }

    public function executeExportersuivicontrat(sfWebRequest $request) {
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
        $this->documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDateBCICONTRAT(6, null, null, $this->start_date, $this->end_date, $this->id_bci);
    }

    public function executeExportersuivibdc(sfWebRequest $request) {
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
        $this->documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDateBDC(6, null, null, $this->start_date, $this->end_date, $this->id_bci);
    }

    public function executeExportersuivibdcRegroupe(sfWebRequest $request) {
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
        $this->documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDateBDCR(6, null, null, $this->start_date, $this->end_date, $this->id_bci);
    }



    /*     * **********fin suivi******** */

    public function executeGlobal(sfWebRequest $request) {
        //$this->forward('default', 'module');
    }

    public function executeProfil(sfWebRequest $request) {
        
    }

    public function executeSaveProfil(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $nom = $request->getParameter('nom');
        $prenom = $request->getParameter('prenom');
        $mail = $request->getParameter('mail');
        $gsm = $request->getParameter('gsm');
        $login = $request->getParameter('login');
        $password = $request->getParameter('password');

        $user = $this->getUser()->getAttribute('userB2m');
        $agent = $user->getAgents();
        $agent->setNomcomplet($nom);
        $agent->setPrenom($prenom);
        $agent->setGsm($gsm);
        $agent->setMail($mail);
        $agent->save();

        $user->setLogin($login);
        if ($password != '')
            $user->setPwd($password);
        $user->save();

        die("OK");
    }
  public function executeShowSuivibdc(sfWebRequest $request)
    {
        $this->offset = 0;
        $this->start_date = date('Y-m-d', strtotime(date('Y/m/01')));
        $this->id_bci = null;
        $this->id_bdc = null;
        $this->id_bdcdef = null;
        $this->id_bcilabo = null;
        $this->id_fac = null;
        if ($request->getParameter('start')) {
            $this->start_date = date('Y-m-d', strtotime($request->getParameter('start')));
        }
        $d = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
        $this->end_date = date('Y-m-d', strtotime(date("Y") . '-' . date("m") . '-' . $d));
        if ($request->getParameter('end')) {
            $this->end_date = date('Y-m-d', strtotime($request->getParameter('end')));
        }
        if ($request->getParameter('id_bci')) {
            $this->id_bci = $request->getParameter('id_bci');
        }
        if ($request->getParameter('id_bdc')) {
            $this->id_bdc = $request->getParameter('id_bdc');
        }
        if ($request->getParameter('id_bdcdef')) {
            $this->id_bdcdef = $request->getParameter('id_bdcdef');
        }
        if ($request->getParameter('id_bcilabo')) {
            $this->id_bcilabo = $request->getParameter('id_bcilabo');
        }
        if ($request->getParameter('id_fac')) {
            $this->id_fac = $request->getParameter('id_fac');
        }
        $this->documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDate(6, 5, $this->offset, $this->start_date, $this->end_date, $this->id_bci, $this->id_bdc, $this->id_bdcdef, $this->id_fac, $this->id_bcilabo);
        // $this->documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDateBDC(6, 5, $this->offset, $this->start_date, $this->end_date, $this->id_bci);

     //   $this->AllBCI = DocumentachatTable::getInstance()->getAllBciByDateBDC(6, $this->start_date, $this->end_date, $this->id_bci);

        $this->AllBCI = DocumentachatTable::getInstance()->getAllBciByDate(6, $this->start_date, $this->end_date, $this->id_bci, $this->id_bdc);
        $this->AllBdc = DocumentachatTable::getInstance()->getAllBciByDateBDC(17,$this->start_date, $this->end_date, $this->id_bci, $this->id_bdc);
        $this->AllBDCDef = DocumentachatTable::getInstance()->getAllBciByDateBDC(2,$this->start_date, $this->end_date, $this->id_bci, $this->id_bdc, $this->id_bdcdef);
        $this->AllBCIlabo = DocumentachatTable::getInstance()->getAllBciByDateBCILabo($this->start_date, $this->end_date, $this->id_bci, $this->id_bdc);
        $this->AllFacture = DocumentachatTable::getInstance()->getAllBciByDateFacture($this->start_date, $this->end_date, $this->id_bci, $this->id_bdc, $this->id_bdcdef);

    }

    public function executeGetcommandebypagerBDC(sfWebRequest $request)
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

            if ($params['start_date']) {
                $this->start_date = date('Y-m-d', strtotime($params['start_date']));
            }

            if ($params['end_date']) {
                $this->end_date = date('Y-m-d', strtotime($params['end_date']));
            }

            if ($params['offset']) {
                $this->offset = ($params['offset'] - 1) * 5;
            }
            if ($params['id_bci'] && is_numeric($params['id_bci'])) {
                $id_bci = intval($params['id_bci']);
            }
        }
        $documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDate(6, 5, $this->offset, $this->start_date, $this->end_date, $id_bci);

        return $this->renderPartial("listCommandesbdc", array("documentachats" => $documentachats));
    }
	public function executeShowSuivibdcRegroupe(sfWebRequest $request) {
        $this->offset = 1;
        $this->start_date = date('Y-m-d', strtotime(date('Y/m/01')));
        if ($request->getParameter('start'))
            $this->start_date = date('Y-m-d', strtotime($request->getParameter('start')));
        $d = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
        $this->end_date = date('Y-m-d', strtotime(date("Y") . '-' . date("m") . '-' . $d));
        if ($request->getParameter('end'))
            $this->end_date = date('Y-m-d', strtotime($request->getParameter('end')));
        if ($request->getParameter('id_bci'))
            $this->id_bci = $request->getParameter('id_bci');
        $this->documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDateBDCR(6, 5, $this->offset, $this->start_date, $this->end_date, $this->id_bci);
        $this->AllBCI = DocumentachatTable::getInstance()->getAllBciByDateBDCR(6, $this->start_date, $this->end_date, $this->id_bci);
    }

    public function executeImprimerFicheBDCRegAvecChoix(sfWebRequest $request) {
        $pdf = new sfTCPDF('L');
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Suivi des bon dépense au comptant Regroupe');
        $pdf->SetSubject("Suivi des  bon depense au comptant Regroupe");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findAll()->getFirst();
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
        $html = $this->ReadHtmlSuivibdcRegroupe($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Suivi des  bon depense au comptant Regroupe.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlSuivibdcRegroupe(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlSuivibdcRegroupe($request);
        return $html;
    }

    public function executeImprimerFicheContratAvecChoix(sfWebRequest $request) {
        $pdf = new sfTCPDF('L');
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Suivi des Contrats de Livraison Total');
        $pdf->SetSubject("Suivi des Contrats de Livraison Total ");
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
        $html = $this->ReadHtmlSuiviContratTotal($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Suivi des Contrats de Livraison Total .pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlSuiviContratTotal(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlSuiviContratTotal($request);
        return $html;
    }

    public function executeImprimerlistcontrat(sfWebRequest $request) {
        $pdf = new sfTCPDF('');
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Suivi des BCIS du Contrat ');
        $pdf->SetSubject("Suivi des BCIS du Contrat ");
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
        $html = $this->ReadHtmlSuiviContrat($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Suivi des BCI du Contrats .pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlSuiviContrat(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlSuiviBCIDucontrat($request);
        return $html;
    }


}
