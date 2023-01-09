<?php

/**
 * accueil actions.
 *
 * @package    Bmm
 * @subpackage accueil
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class accueilActions extends sfActions {

    public function executeConnect($request) {
        return $this->redirect(sfConfig::get('sf_appdir') . 'Admin/connect', 200);
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeShowSuivicommande(sfWebRequest $request) {
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
        $this->documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDate(6, 5, $this->offset, $this->start_date, $this->end_date, $this->id_bci, $this->id_bce, $this->id_bcedef, $this->id_fac, $this->id_bcilabo);

        $this->AllBCI = DocumentachatTable::getInstance()->getAllBciByDate(6, $this->start_date, $this->end_date, $this->id_bci, $this->id_bce);
        $this->AllBCE = DocumentachatTable::getInstance()->getAllBciByDateBCE($this->start_date, $this->end_date, $this->id_bci, $this->id_bce);
        $this->AllBCEDef = DocumentachatTable::getInstance()->getAllBciByDateBCEdef($this->start_date, $this->end_date, $this->id_bci, $this->id_bce, $this->id_bcedef);
        $this->AllBCIlabo = DocumentachatTable::getInstance()->getAllBciByDateBCILabo($this->start_date, $this->end_date, $this->id_bci, $this->id_bce);
        $this->AllFacture = DocumentachatTable::getInstance()->getAllBciByDateFacture($this->start_date, $this->end_date, $this->id_bci, $this->id_bce, $this->id_bcedef);
    }

    public function executeGetcommandebypager(sfWebRequest $request) {
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

    public function executeShowSuivicontrattotal(sfWebRequest $request) {
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
        $this->Allcontratprovisoire = DocumentachatTable::getInstance()->getAllDatecontrat(19, $this->start_date, $this->end_date, $this->id_bci, $this->id_bce);
        $this->AllcontratDef = DocumentachatTable::getInstance()->getAllDatecontrat(20, $this->start_date, $this->end_date, $this->id_bci, $this->id_bce, $this->id_bcedef);
        $this->AllBCIlabo = DocumentachatTable::getInstance()->getAllBciByDateBCILabo($this->start_date, $this->end_date, $this->id_bci, $this->id_bce);
        $this->AllFacture = DocumentachatTable::getInstance()->getAllBciByDateFacture($this->start_date, $this->end_date, $this->id_bci, $this->id_bce, $this->id_bcedef);
    }

    public function executeGetcommandebypagerBCIContrat(sfWebRequest $request) {
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

    public function executeGetcommandebypagerContrat(sfWebRequest $request) {
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

    public function executeShowSuiviBcicontrat(sfWebRequest $request) {
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

    public function executeShowSuivicontrat(sfWebRequest $request) {
        //          $this->boncommandeexterne = $this->getDocumentAchatByPage($request);
    } public function executeShowSuivibdc(sfWebRequest $request) {
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
        $this->AllBdc = DocumentachatTable::getInstance()->getAllBciByDateBDC(17, $this->start_date, $this->end_date, $this->id_bci, $this->id_bdc);
        $this->AllBDCDef = DocumentachatTable::getInstance()->getAllBciByDateBDC(2, $this->start_date, $this->end_date, $this->id_bci, $this->id_bdc, $this->id_bdcdef);
        $this->AllBCIlabo = DocumentachatTable::getInstance()->getAllBciByDateBCILabo($this->start_date, $this->end_date, $this->id_bci, $this->id_bdc);
        $this->AllFacture = DocumentachatTable::getInstance()->getAllBciByDateFacture($this->start_date, $this->end_date, $this->id_bci, $this->id_bdc, $this->id_bdcdef);
    }

    public function executeGetcommandebypagerBDC(sfWebRequest $request) {
        $params = array();
        $content = $request->getContent();
        $this->offset = 0;
        $this->offset = 0;

        $this->id_bci = null;
        $this->id_bdc = null;
        $this->id_bdcdef = null;
        $this->id_bcilabo = null;
        $this->id_fac = null;
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
        }
        $documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDate(6, 5, $this->offset, $this->start_date, $this->end_date, $this->id_bci, $this->id_bdc, $this->id_bdcdef, $this->id_fac, $this->id_bcilabo);

        return $this->renderPartial("listCommandesbdc", array("documentachats" => $documentachats));
    }

    public function executeShowSuivibdcRegroupe(sfWebRequest $request) {
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
        if ($request->getParameter('id_bdcreg')) {
            $this->id_bdc = $request->getParameter('id_bdcreg');
        }
        if ($request->getParameter('id_bdcdef')) {
            $this->id_bdcdef = $request->getParameter('id_bdcdef');
        }
//die($this->id_bdcdef.' '.$this->id_bdc.' '.$this->id_bci);
        if ($request->getParameter('id_fac')) {
            $this->id_fac = $request->getParameter('id_fac');
        }
        $this->documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDateBDCR(6, 5, $this->offset, $this->start_date, $this->end_date, $this->id_bci, $this->id_bdc, $this->id_bdcdef, $this->id_fac);

        $this->AllBCI = DocumentachatTable::getInstance()->getAllBciByDate(6, $this->start_date, $this->end_date, $this->id_bci, $this->id_bdc);
        $this->AllBdc = DocumentachatTable::getInstance()->getAllBciByDateBDC(21, $this->start_date, $this->end_date, $this->id_bci, $this->id_bdc);
        $this->AllBDCDef = DocumentachatTable::getInstance()->getAllBciByDateBDC(22, $this->start_date, $this->end_date, $this->id_bci, $this->id_bdc, $this->id_bdcdef);
        $this->AllBCIlabo = DocumentachatTable::getInstance()->getAllBciByDateBCILabo($this->start_date, $this->end_date, $this->id_bci, $this->id_bdc);
        $this->AllFacture = DocumentachatTable::getInstance()->getAllBciByDateFacture($this->start_date, $this->end_date, $this->id_bci, $this->id_bdc, $this->id_bdcdef);
    }

    public function executeGetcommandebypagerBDCReg(sfWebRequest $request) {
        $params = array();
        $content = $request->getContent();
        $this->offset = 0;
        $this->id_bci = null;
        $this->id_bdc = null;
        $this->id_bdcdef = null;
        $this->id_bcilabo = null;
        $this->id_fac = null;
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
            if ($request->getParameter('id_bci')) {
                $this->id_bci = $request->getParameter('id_bci');
            }
            if ($request->getParameter('id_bdc')) {
                $this->id_bdc = $request->getParameter('id_bdc');
            }
            if ($request->getParameter('id_bdcdef')) {
                $this->id_bdcdef = $request->getParameter('id_bdcdef');
            }

            if ($request->getParameter('id_fac')) {
                $this->id_fac = $request->getParameter('id_fac');
            }

            $documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDateBDCR(6, 5, $this->offset, $this->start_date, $this->end_date, $this->id_bci, $this->id_bdc, $this->id_bdcdef, $this->id_fac, $this->id_bcilabo);

            return $this->renderPartial("listCommandesbdcreg", array("documentachats" => $documentachats));
        }
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

    public function executeIndex(sfWebRequest $request) {
        $_SESSION['statistique'] = $request->getParameter('stat', 0);
        if (!isset($_SESSION['exercice_budget']))
            $_SESSION['exercice_budget'] = null;

        $this->societe = SocieteTable::getInstance()->findAll()->getFirst();
    }

    public function executeValiderExerciceCourant(sfWebRequest $request) {
        $_SESSION['exercice_budget'] = $request->getParameter('exercice_id');

        die('ok');
    }

    public function executeShowHierarchie(sfWebRequest $request) {
        
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

    public function executeImport(sfWebRequest $request) {
        
    }

    public function executeImportAchat(sfWebRequest $request) {
        $tmp_name = $_FILES['lib_fichier']['tmp_name'];
        $name = $_FILES['lib_fichier']['name'];

        $url_fichier = "uploads/import/" . $name;
        move_uploaded_file($tmp_name, $url_fichier);

        $this->url_fichier = $url_fichier;
        $this->name = $name;
    }

    public function executeVerifDemandeur(sfWebRequest $request) {
        $libelles = $request->getParameter('libelles');
        $libelles = explode(';;', $libelles);
        $this->demandeurs = DemandeurTable::getInstance()->getByListeLibelle($libelles);
    }

    public function executeVerifService(sfWebRequest $request) {
        $libelles = $request->getParameter('libelles');
        $libelles = explode(';;', $libelles);
        $this->services = ServicerhTable::getInstance()->getByListeLibelle($libelles);
    }

    public function executeVerifArticle(sfWebRequest $request) {
        $libelles = $request->getParameter('libelles');
        $libelles = explode(';;', $libelles);
        $this->articles = ArticleTable::getInstance()->getByListeLibelle($libelles);
    }

    public function executeVerifUnite(sfWebRequest $request) {
        $libelles = $request->getParameter('libelles');
        $libelles = explode(';;', $libelles);
        $this->services = UnitemarcheTable::getInstance()->getByListeLibelle($libelles);
    }

    public function executeVerifFournisseur(sfWebRequest $request) {
        $libelles = $request->getParameter('libelles');
        $libelles = explode(';;', $libelles);
        $this->fournisseurs = FournisseurTable::getInstance()->getByListeLibelle($libelles);
    }

    public function executeSaveDemandeur(sfWebRequest $request) {
        $libelles = $request->getParameter('libelles');
        $libelles = explode(';;', $libelles);
        for ($i = 0; $i < sizeof($libelles); $i++) {
            $demandeur = new Demandeur();
            $demandeur->setLibelle($libelles[$i]);
            $demandeur->save();
        }
        die('OK');
    }

    public function executeSaveService(sfWebRequest $request) {
        $libelles = $request->getParameter('libelles');
        $libelles = explode(';;', $libelles);
        for ($i = 0; $i < sizeof($libelles); $i++) {
            if ($libelles[$i] != '') {
                $servicerh = new servicerh();
                $servicerh->setLibelle($libelles[$i]);
                $servicerh->save();
            }
        }
        die('OK');
    }

    public function executeSaveUnite(sfWebRequest $request) {
        $libelles = $request->getParameter('libelles');
        $libelles = explode(';;', $libelles);
        for ($i = 0; $i < sizeof($libelles); $i++) {
            if ($libelles[$i] != '') {
                $unite = new Unitemarche();
                $unite->setLibelle($libelles[$i]);
                $unite->save();
            }
        }
        die('OK');
    }

    public function executeSaveArticle(sfWebRequest $request) {
        $libelles = $request->getParameter('libelles');
        $libelles = explode(';;', $libelles);
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');
        for ($i = 0; $i < sizeof($libelles); $i++) {
            if ($libelles[$i] != '') {
                $article = new Article();
                $article->setDesignation($libelles[$i]);
                $article->setDatecreation(date('Y-m-d'));
                $article->setIdUser($user->getId());
                $article->save();
            }
        }
        die('OK');
    }

    public function executeSaveFournisseur(sfWebRequest $request) {
        $libelles = $request->getParameter('libelles');
        $libelles = explode(';;', $libelles);
        for ($i = 0; $i < sizeof($libelles); $i++) {
            if ($libelles[$i] != '') {
                $fournisseur = new Fournisseur();
                $fournisseur->setRs($libelles[$i]);
                $fournisseur->setDatecreation(date('Y-m-d'));
                $fournisseur->setDatemisajour(date('Y-m-d'));
                $fournisseur->setEtatfrs('Actif');
                $fournisseur->setCertificatrs(false);
                $fournisseur->save();
            }
        }
        die('OK');
    }

    public function executeSaveBci(sfWebRequest $request) {
        $reference = $request->getParameter('numero');
        $date = $request->getParameter('date');
        $demandeur = $request->getParameter('demandeur');
        $montant = $request->getParameter('montant');

        $reference = explode(';', $reference);
        $date = explode(';', $date);
        $demandeur = explode(';;', $demandeur);
        $montant = explode(';', $montant);

        $values = '';
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');
        for ($i = 0; $i < sizeof($reference); $i++) {
            if ($reference[$i] != '') {
                if ($values == '')
                    $values = $values . '(';
                else
                    $values = $values . ', (';

                if ($date[$i] != '') {
                    $date_document = explode('/', $date[$i]);
                    $date_doc = $date_document[2] . '-' . $date_document[1] . '-' . $date_document[0];
                } else {
                    $date_doc = date('Y-m-d', strtotime($date[$i]));
                }

                $values = $values . $reference[$i] . "," . $reference[$i] . ",'" . $date_doc . "'," . " (select id from demandeur where upper(trim(libelle)) = '" . strtoupper($demandeur[$i]) . "' limit 1) ,6,10,3," . $user->getId() . "," . $montant[$i];
                $values = $values . ')';
            }
        }

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

        //Vérification et insertion des taux d'amortissement des immobilisation
        $query = "INSERT INTO documentachat(numero, reference, datecreation, id_demandeur, id_typedoc, id_etatdoc, id_objet, id_user, montantestimatif)
	VALUES " . $values . ";";

        $resultat = $conn->fetchAssoc($query);

        die('OK');
    }

    public function executeSaveLigneBci(sfWebRequest $request) {
        $reference = $request->getParameter('numero');
        $designation = $request->getParameter('designation');
        $quantite = $request->getParameter('quantite');
        $unite = $request->getParameter('unite');
        $montant = $request->getParameter('montant');

        $reference = explode(';', $reference);
        $designation = str_replace("'", "''", $designation);
        $designation = explode(';;', $designation);
        $quantite = explode(';', $quantite);
        $unite = explode(';', $unite);
        $montant = explode(';', $montant);

        $values = '';

        for ($i = 0; $i < sizeof($reference); $i++) {
            if ($reference[$i] != '') {
                if ($values == '') {
                    $values = $values . '(';
                } else {
                    $values = $values . ', (';
                }

                $values = $values . $montant[$i] . "," . "(select id from documentachat where trim(reference) = '" . $reference[$i] . "' limit 1)," . " (select id from article where trim(designation) = '" . $designation[$i] . "' OR LOWER(trim(designation)) = '" . strtolower($designation[$i]) . "' limit 1)," . " (select COALESCE(codeart, NULL) from article where LOWER(trim(designation)) = '" . strtolower($designation[$i]) . "' limit 1),'" . $designation[$i] . "'," . $quantite[$i] . ",'" . $unite[$i] . "'," . " (select COALESCE(id, NULL) from unitemarche where LOWER(trim(libelle)) = '" . strtolower($unite[$i]) . "' limit 1)";
                $values = $values . ')';
            }
        }

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

        //Vérification et insertion des taux d'amortissement des immobilisation
        $query = "INSERT INTO lignedocachat(mntttc, id_doc, id_articlestock, codearticle, designationarticle, qte, unitedemander, id_unitemarche)
	VALUES " . $values . ";";

        $resultat = $conn->fetchAssoc($query);

        die('OK');
    }

    public function executeSaveBdc(sfWebRequest $request) {
        $reference = $request->getParameter('numero');
        $bci = $request->getParameter('bci');
        $date = $request->getParameter('date');
        $demandeur = $request->getParameter('demandeur');
        $fournisseur = $request->getParameter('fournisseur');
        $montant = $request->getParameter('montant');

        $reference = explode(';', $reference);
        $bci = explode(';', $bci);
        $date = explode(';', $date);
        $demandeur = explode(';;', $demandeur);
        $fournisseur = str_replace("'", "''", $fournisseur);
        $fournisseur = explode(';;', $fournisseur);
        $montant = explode(';', $montant);

        $values = '';
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');
        for ($i = 0; $i < sizeof($reference); $i++) {
            if ($reference[$i] != '') {
                if ($values == '')
                    $values = $values . '(';
                else
                    $values = $values . ', (';

                if ($date[$i] != '') {
                    $date_document = explode('/', $date[$i]);
                    $date_doc = $date_document[2] . '-' . $date_document[1] . '-' . $date_document[0];
                } else {
                    $date_doc = date('Y-m-d', strtotime($date[$i]));
                }

                $values = $values . $reference[$i] . "," . " (select id from documentachat where numero = '" . $bci[$i] . "' limit 1)" . "," . $reference[$i] . ",'" . $date_doc . "'," . " (select id from demandeur where upper(trim(libelle)) = '" . strtoupper($demandeur[$i]) . "' limit 1) ,2,1,3," . $user->getId() . "," . " (select id from fournisseur where lower(trim(rs)) = '" . strtolower($fournisseur[$i]) . "' limit 1)" . "," . $montant[$i];
                $values = $values . ')';
            }
        }

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

        //Insertion des B.D.C
        $query = "INSERT INTO documentachat(numero, id_docparent, reference, datecreation, id_demandeur, id_typedoc, id_etatdoc, id_objet, id_user, id_frs, mntttc)
	VALUES " . $values . ";";

        $resultat = $conn->fetchAssoc($query);


        //BCI => id_etatdoc = 12
        $query_etat = "UPDATE documentachat SET id_etatdoc = 13 WHERE id IN (" . implode(',', array_map('intval', $bci)) . ");";
        $resultat_etat = $conn->fetchAssoc($query_etat);

        $values = '';
        for ($i = 0; $i < sizeof($reference); $i++) {
            if ($reference[$i] != '') {
                if ($values == '')
                    $values = $values . '(';
                else
                    $values = $values . ', (';

                $values = $values . "(select id from documentachat where numero = '" . $reference[$i] . "' limit 1)" . "," . " (select id from documentachat where numero = '" . $bci[$i] . "' limit 1)";
                $values = $values . ')';
            }
        }

        //Ajout des ligne dans documentparent
        $query_parent = "INSERT INTO documentparent(id_documentachat, id_documentparent)
	VALUES " . $values . ";";
        $resultat_parent = $conn->fetchAssoc($query_parent);

        //Ajout des lignedocachat
        for ($i = 0; $i < sizeof($reference); $i++) {
            if ($reference[$i] != '') {
                $doc = DocumentachatTable::getInstance()->findOneByNumero($reference[$i]);
                $doc_parent = DocumentachatTable::getInstance()->findOneByNumero($bci[$i]);

                foreach ($doc_parent->getLignedocachat() as $ligne_parent) {
                    $ligne = new Lignedocachat();
                    $ligne->setIdArticlestock($ligne_parent->getIdArticlestock());
                    $ligne->setIdDoc($doc->getId());
                    $ligne->setIdUnitemarche($ligne_parent->getIdUnitemarche());
                    $ligne->setMntttc($ligne_parent->getMntttc());
                    $ligne->setCodearticle($ligne_parent->getCodearticle());
                    $ligne->setDesignationarticle($ligne_parent->getDesignationarticle());
                    $ligne->setQte($ligne_parent->getQte());
                    $ligne->setUnitedemander($ligne_parent->getUnitedemander());

                    $ligne->save();
                }
            }
        }

        die('OK');
    }

    public function executeSaveBce(sfWebRequest $request) {
        $reference = $request->getParameter('numero');
        $bci = $request->getParameter('bci');
        $date = $request->getParameter('date');
        $demandeur = $request->getParameter('demandeur');
        $fournisseur = $request->getParameter('fournisseur');
        $montant = $request->getParameter('montant');

        $reference = explode(';', $reference);
        $bci = explode(';', $bci);
        $date = explode(';', $date);
        $demandeur = explode(';;', $demandeur);
        $fournisseur = str_replace("'", "''", $fournisseur);
        $fournisseur = explode(';;', $fournisseur);
        $montant = explode(';', $montant);

        $values = '';
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');
        for ($i = 0; $i < sizeof($reference); $i++) {
            if ($reference[$i] != '') {
                if ($values == '')
                    $values = $values . '(';
                else
                    $values = $values . ', (';

                if ($date[$i] != '') {
                    $date_document = explode('/', $date[$i]);
                    $date_doc = $date_document[2] . '-' . $date_document[1] . '-' . $date_document[0];
                } else {
                    $date_doc = date('Y-m-d', strtotime($date[$i]));
                }

                $values = $values . $reference[$i] . "," . " (select id from documentachat where numero = '" . $bci[$i] . "' limit 1)" . "," . $reference[$i] . ",'" . $date_doc . "'," . " (select id from demandeur where upper(trim(libelle)) = '" . strtoupper($demandeur[$i]) . "' limit 1) ,7,1,3," . $user->getId() . "," . " (select id from fournisseur where lower(trim(rs)) = '" . strtolower($fournisseur[$i]) . "' limit 1)" . "," . $montant[$i];
                $values = $values . ')';
            }
        }

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

        //Insertion des B.C.E
        $query = "INSERT INTO documentachat(numero, id_docparent, reference, datecreation, id_demandeur, id_typedoc, id_etatdoc, id_objet, id_user, id_frs, mntttc)
	VALUES " . $values . ";";

        $resultat = $conn->fetchAssoc($query);

        //BCI => id_etatdoc = 13
        $query_etat = "UPDATE documentachat SET id_etatdoc = 13 WHERE id IN (" . implode(',', array_map('intval', $bci)) . ");";
        $resultat_etat = $conn->fetchAssoc($query_etat);

        $values = '';
        for ($i = 0; $i < sizeof($reference); $i++) {
            if ($reference[$i] != '') {
                if ($values == '')
                    $values = $values . '(';
                else
                    $values = $values . ', (';

                $values = $values . "(select id from documentachat where numero = '" . $reference[$i] . "' limit 1)" . "," . " (select id from documentachat where numero = '" . $bci[$i] . "' limit 1)";
                $values = $values . ')';
            }
        }

        //Ajout des ligne dans documentparent
        $query_parent = "INSERT INTO documentparent(id_documentachat, id_documentparent)
	VALUES " . $values . ";";
        $resultat_parent = $conn->fetchAssoc($query_parent);

        //Ajout des lignedocachat
        for ($i = 0; $i < sizeof($reference); $i++) {
            if ($reference[$i] != '') {
                $doc = DocumentachatTable::getInstance()->findOneByNumero($reference[$i]);
                $doc_parent = DocumentachatTable::getInstance()->findOneByNumero($bci[$i]);

                foreach ($doc_parent->getLignedocachat() as $ligne_parent) {
                    $ligne = new Lignedocachat();
                    $ligne->setIdArticlestock($ligne_parent->getIdArticlestock());
                    $ligne->setIdDoc($doc->getId());
                    $ligne->setIdUnitemarche($ligne_parent->getIdUnitemarche());
                    $ligne->setMntttc($ligne_parent->getMntttc());
                    $ligne->setCodearticle($ligne_parent->getCodearticle());
                    $ligne->setDesignationarticle($ligne_parent->getDesignationarticle());
                    $ligne->setQte($ligne_parent->getQte());
                    $ligne->setUnitedemander($ligne_parent->getUnitedemander());

                    $ligne->save();
                }
            }
        }

        die('OK');
    }

    public function executeSaveFacture(sfWebRequest $request) {
        $reference = $request->getParameter('numero');
        $doc = $request->getParameter('doc');
        $date = $request->getParameter('date');
        $fournisseur = $request->getParameter('fournisseur');
        $montant = $request->getParameter('montant');

        $reference = explode(';', $reference);
        $doc = explode(';', $doc);
        $date = explode(';', $date);
        $fournisseur = str_replace("'", "''", $fournisseur);
        $fournisseur = explode(';;', $fournisseur);
        $montant = explode(';', $montant);

        $values = '';
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');
        for ($i = 0; $i < sizeof($reference); $i++) {
            if ($reference[$i] != '') {
                if ($values == '')
                    $values = $values . '(';
                else
                    $values = $values . ', (';

                if ($date[$i] != '') {
                    $date_document = explode('/', $date[$i]);
                    $date_doc = $date_document[2] . '-' . $date_document[1] . '-' . $date_document[0];
                } else {
                    $date_doc = date('Y-m-d', strtotime($date[$i]));
                }

                $values = $values . substr(preg_replace("/[^0-9]/", "", $reference[$i]), 0, 9) . "," . " (select id from documentachat where numero = '" . $doc[$i] . "' limit 1)" . "," . $reference[$i] . ",'" . $date_doc . "'," . "15,1," . $user->getId() . "," . " (select id from fournisseur where lower(trim(rs)) = '" . strtolower($fournisseur[$i]) . "' limit 1)" . "," . $montant[$i];
                $values = $values . ')';
            }
        }

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

        //Insertion des Factures
        $query = "INSERT INTO documentachat(numero, id_docparent, reference, datecreation, id_typedoc, id_etatdoc, id_user, id_frs, mntttc)
	VALUES " . $values . ";";

        $resultat = $conn->fetchAssoc($query);

        $values = '';
        for ($i = 0; $i < sizeof($reference); $i++) {
            if ($reference[$i] != '') {
                if ($values == '')
                    $values = $values . '(';
                else
                    $values = $values . ', (';

                $values = $values . "(select id from documentachat where numero = '" . substr(preg_replace("/[^0-9]/", "", $reference[$i]), 0, 9) . "' limit 1)" . "," . " (select id from documentachat where numero = '" . $doc[$i] . "' limit 1)";
                $values = $values . ')';
            }
        }

        //Ajout des ligne dans documentparent
        $query_parent = "INSERT INTO documentparent(id_documentachat, id_documentparent)
	VALUES " . $values . ";";
        $resultat_parent = $conn->fetchAssoc($query_parent);

        //Ajout des lignedocachat
        for ($i = 0; $i < sizeof($reference); $i++) {
            if ($reference[$i] != '') {
                $facture = DocumentachatTable::getInstance()->findOneByNumero(substr(preg_replace("/[^0-9]/", "", $reference[$i]), 0, 9));
                $doc_parent = DocumentachatTable::getInstance()->findOneByNumero($doc[$i]);
                if ($doc_parent) {
                    foreach ($doc_parent->getLignedocachat() as $ligne_parent) {
                        $ligne = new Lignedocachat();
                        $ligne->setIdArticlestock($ligne_parent->getIdArticlestock());
                        $ligne->setIdDoc($facture->getId());
                        $ligne->setIdUnitemarche($ligne_parent->getIdUnitemarche());
                        $ligne->setMntttc($ligne_parent->getMntttc());
                        $ligne->setCodearticle($ligne_parent->getCodearticle());
                        $ligne->setDesignationarticle($ligne_parent->getDesignationarticle());
                        $ligne->setQte($ligne_parent->getQte());
                        $ligne->setUnitedemander($ligne_parent->getUnitedemander());

                        $ligne->save();
                    }
                } else
                    echo '**' . $doc[$i] . '** ';
            }
        }

        die('OK');
    }

    public function executeSaveOperation(sfWebRequest $request) {
        $reference = $request->getParameter('numero');
        $doc = $request->getParameter('doc');
        $date = $request->getParameter('date');
        $fournisseur = $request->getParameter('fournisseur');
        $montant = $request->getParameter('montant');

        $reference = explode(';', $reference);
        $doc = explode(';', $doc);
        $date = explode(';', $date);
        $fournisseur = str_replace("'", "''", $fournisseur);
        $fournisseur = explode(';;', $fournisseur);
        $montant = explode(';', $montant);

        $values = '';
        for ($i = 0; $i < sizeof($reference); $i++) {
            if ($reference[$i] != '') {
                if ($values == '')
                    $values = $values . '(';
                else
                    $values = $values . ', (';

                if ($date[$i] != '') {
                    $date_document = explode('/', $date[$i]);
                    $date_doc = $date_document[2] . '-' . $date_document[1] . '-' . $date_document[0];
                } else {
                    $date_doc = date('Y-m-d', strtotime($date[$i]));
                }

                $values = $values . substr(preg_replace("/[^0-9]/", "", $reference[$i]), 0, 9) . "," . " (select id from documentachat where numero = '" . $doc[$i] . "' limit 1)" . ",'" . $date_doc . "'," . " (select id from fournisseur where lower(trim(rs)) = '" . strtolower($fournisseur[$i]) . "' limit 1)" . "," . $montant[$i];
                $values = $values . ')';
            }
        }

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

        //Insertion des Factures
        $query = "INSERT INTO lignemouvementfacturation(numerofacture, id_documentachat, date, id_fournisseur, montant)
	VALUES " . $values . ";";

        $resultat = $conn->fetchAssoc($query);

        die('OK');
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
