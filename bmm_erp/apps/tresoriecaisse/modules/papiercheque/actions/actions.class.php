<?php

require_once dirname(__FILE__) . '/../lib/papierchequeGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/papierchequeGeneratorHelper.class.php';

/**
 * papiercheque actions.
 *
 * @package    Bmm
 * @subpackage papiercheque
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class papierchequeActions extends autoPapierchequeActions {

    public function executeIndex(sfWebRequest $request) {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }
        $this->idcarnet = "";
        if ($request->getParameter('idcarnet'))
            $this->idcarnet = $request->getParameter('idcarnet');
        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }

        $this->pager = $this->getPager($this->idcarnet);
        $this->sort = $this->getSort();
    }

    protected function buildQuery($idcarnet) {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());

        $this->addSortQuery($query);
        if ($idcarnet != "")
            $query = $query->AndWhere('id_carnet=' . $idcarnet);
        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        return $query;
    }

    protected function getPager($idcarnet) {
        $pager = $this->configuration->getPager('papiercheque');
        $pager->setQuery($this->buildQuery($idcarnet));
        $pager->setPage($this->getPage());
        $pager->init();

        return $pager;
    }

    public function executeFilter(sfWebRequest $request) {
        $this->setPage(1);

        if ($request->hasParameter('_reset')) {
            $this->setFilters($this->configuration->getFilterDefaults());

            $this->redirect('@papiercheque');
        }
        $this->idcarnet = "";
        if ($request->getParameter('idcarnet'))
            $this->idcarnet = $request->getParameter('idcarnet');
        $this->filters = $this->configuration->getFilterForm($this->getFilters());

        $this->filters->bind($request->getParameter($this->filters->getName()));
        if ($this->filters->isValid()) {
            $this->setFilters($this->filters->getValues());

            $this->redirect('@papiercheque');
        }

        $this->pager = $this->getPager($this->idcarnet);
        $this->sort = $this->getSort();

        $this->setTemplate('index');
    }

    public function executeDetail(sfWebRequest $request) {
        $this->cheque = PapierchequeTable::getInstance()->find($request->getParameter('id'));
        $this->mouvement = MouvementbanciareTable::getInstance()->findOneByIdCheque($request->getParameter('id'));
        $this->societe = SocieteTable::getInstance()->findAll()->getFirst();
    }

    public function executeImprimerCheque(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $id = $request->getParameter('id');

        $pdf = new sfTCPDF('L');
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Chèque');
        $pdf->SetSubject("Chèque");
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getRs();
//        $pdf->SetAuthor($entete);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');
        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(0, 0, 0);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set image scale factor
//        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlSearchMouvementBanque($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Chèque.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlSearchMouvementBanque($id) {
        $html = StyleCssHeader::header1();
        $papier = new Papiercheque();
        $html .= $papier->ReadHtmlCheque($id);
        return $html;
    }

    public function executeGetAnnulationCheque(sfWebRequest $request) {
        $this->cheque = PapierchequeTable::getInstance()->find($request->getParameter('id'));
        $mvt = $this->cheque->getMouvementbanciare()->getFirst();

        $id = $mvt->getIdBanque();
        $this->liste_cheque = PapierchequeTable::getInstance()->getListeChequeByCarnets($id);
    }

    public function executeAnnuler(sfWebRequest $request) {
        $cheque = PapierchequeTable::getInstance()->find($request->getParameter('id'));
        $cheque->setAnnule(true);
        $cheque->save();

        $mvt = $cheque->getMouvementbanciare()->getFirst();
        $mvt->setIdCheque($request->getParameter('next_cheque'));
        $mvt->save();
        
        $next_cheque = PapierchequeTable::getInstance()->find($request->getParameter('next_cheque'));
        $next_cheque->setDatesignature($mvt->getDateoperation());
        if ($mvt->getCredit() != null)
            $next_cheque->setMntcheque($mvt->getCredit());
        else
            $next_cheque->setMntcheque($mvt->getDebit());
        $next_cheque->setCible($mvt->getRefbenifi());
        $next_cheque->setEtat(1);
        $next_cheque->save();

        die('Ok');
    }

}
