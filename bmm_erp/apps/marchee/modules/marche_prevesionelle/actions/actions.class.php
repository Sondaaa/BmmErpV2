<?php

require_once dirname(__FILE__) . '/../lib/marche_prevesionelleGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/marche_prevesionelleGeneratorHelper.class.php';

/**
 * marche_prevesionelle actions.
 *
 * @package    Bmm
 * @subpackage marche_prevesionelle
 * @author     Your name here
 * @version    SVN: $Id$
 */
class marche_prevesionelleActions extends autoMarche_prevesionelleActions {

    public function preExecute() {
        $this->configuration = new marche_prevesionelleGeneratorConfiguration();

        if (!$this->getUser()->hasCredential($this->configuration->getCredentials($this->getActionName()))) {
            $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
        }

        $this->dispatcher->notify(new sfEvent($this, 'admin.pre_execute', array('configuration' => $this->configuration)));

        $this->helper = new marche_prevesionelleGeneratorHelper();

        parent::preExecute();
    }

    public function executeIndex(sfWebRequest $request) {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();
    }

    public function executeFilter(sfWebRequest $request) {
        $this->setPage(1);

        if ($request->hasParameter('_reset')) {
            $this->setFilters($this->configuration->getFilterDefaults());

            $this->redirect('@marche_prevesionelle');
        }

        $this->filters = $this->configuration->getFilterForm($this->getFilters());

        $this->filters->bind($request->getParameter($this->filters->getName()));
        if ($this->filters->isValid()) {
            $this->setFilters($this->filters->getValues());

            $this->redirect('@marche_prevesionelle');
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();

        $this->setTemplate('index');
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->marche_prevesionelle = $this->form->getObject();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->marche_prevesionelle = $this->form->getObject();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function ReadHtml($societe, $aviss, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBonCommandeInterne($aviss, $listesdocuments);

        return $html;
    }

    public function executeShow(sfWebRequest $request) {
        $id = $request->getParameter('id');

        $marche_prevesionelle = MarchePrevesionelleTable::getInstance()->findOneById($id);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche BCIMP N°:');
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
        $pdf->SetFont('dejavusans', '', 14, '', true);
        //$pdf->SetFont('dejavusans', '', 12);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
        //      


        $html = $marche_prevesionelle->ReadHtmlMarchePrvesionelle();

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('marche_prevesionelle_' . $marche_prevesionelle->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function executePrint(sfWebRequest $request) {
        $marche_prevesionelle = MarchePrevesionelleTable::getInstance()->findAll();
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche BCIMP N°:');
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
        $pdf->SetFont('dejavusans', '', 14, '', true);

        $pdf->AddPage('L');
        //      
        $html = '';

        // Print text using writeHTMLCell()
        $html = $this->ReadHtmlMarchePrvesionelleAnnuelle($request);

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('marche_prevesionelle_all_by_exercice.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlMarchePrvesionelleAnnuelle(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $marche = new MarchePrevesionelle();
        $html .= $marche->ReadHtmlMarchePrvesionelleAnnuelle($request);
        return $html;
    }

    public function executeEdit(sfWebRequest $request) {
        $this->marche_prevesionelle = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->marche_prevesionelle);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->marche_prevesionelle = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->marche_prevesionelle);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

        if ($this->getRoute()->getObject()->delete()) {
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }

        $this->redirect('@marche_prevesionelle');
    }

    public function executeBatch(sfWebRequest $request) {
        $request->checkCSRFProtection();

        if (!$ids = $request->getParameter('ids')) {
            $this->getUser()->setFlash('error', 'You must at least select one item.');

            $this->redirect('@marche_prevesionelle');
        }

        if (!$action = $request->getParameter('batch_action')) {
            $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');

            $this->redirect('@marche_prevesionelle');
        }

        if (!method_exists($this, $method = 'execute' . ucfirst($action))) {
            throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
        }

        if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action))) {
            $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
        }

        $validator = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'MarchePrevesionelle'));
        try {
            // validate ids
            $ids = $validator->clean($ids);

            // execute batch
            $this->$method($request);
        } catch (sfValidatorError $e) {
            $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items as some items do not exist anymore.');
        }

        $this->redirect('@marche_prevesionelle');
    }

    protected function executeBatchDelete(sfWebRequest $request) {
        $ids = $request->getParameter('ids');

        $records = Doctrine_Query::create()
                ->from('MarchePrevesionelle')
                ->whereIn('id', $ids)
                ->execute();

        foreach ($records as $record) {
            $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $record)));

            $record->delete();
        }

        $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
        $this->redirect('@marche_prevesionelle');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $marche_prevesionelle = $form->save();
            } catch (Doctrine_Validator_Exception $e) {

                $errorStack = $form->getObject()->getErrorStack();

                $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ? 's' : null) . " with validation errors: ";
                foreach ($errorStack as $field => $errors) {
                    $message .= "$field (" . implode(", ", $errors) . "), ";
                }
                $message = trim($message, ', ');

                $this->getUser()->setFlash('error', $message);
                return sfView::SUCCESS;
            }

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $marche_prevesionelle)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@marche_prevesionelle_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'marche_prevesionelle', 'sf_subject' => $marche_prevesionelle));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    protected function getFilters() {
        return $this->getUser()->getAttribute('marche_prevesionelle.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    }

    protected function setFilters(array $filters) {
        return $this->getUser()->setAttribute('marche_prevesionelle.filters', $filters, 'admin_module');
    }

    protected function getPager() {
        $pager = $this->configuration->getPager('MarchePrevesionelle');
        $pager->setQuery($this->buildQuery());
        $pager->setPage($this->getPage());
        $pager->init();

        return $pager;
    }

    protected function setPage($page) {
        $this->getUser()->setAttribute('marche_prevesionelle.page', $page, 'admin_module');
    }

    protected function getPage() {
        return $this->getUser()->getAttribute('marche_prevesionelle.page', 1, 'admin_module');
    }

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());

        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        return $query;
    }

    protected function addSortQuery($query) {
        if (array(null, null) == ($sort = $this->getSort())) {
            return;
        }

        if (!in_array(strtolower($sort[1]), array('asc', 'desc'))) {
            $sort[1] = 'asc';
        }

        $query->addOrderBy($sort[0] . ' ' . $sort[1]);
    }

    protected function getSort() {
        if (null !== $sort = $this->getUser()->getAttribute('marche_prevesionelle.sort', null, 'admin_module')) {
            return $sort;
        }

        $this->setSort($this->configuration->getDefaultSort());

        return $this->getUser()->getAttribute('marche_prevesionelle.sort', null, 'admin_module');
    }

    protected function setSort(array $sort) {
        if (null !== $sort[0] && null === $sort[1]) {
            $sort[1] = 'asc';
        }

        $this->getUser()->setAttribute('marche_prevesionelle.sort', $sort, 'admin_module');
    }

    protected function isValidSortColumn($column) {
        return Doctrine_Core::getTable('MarchePrevesionelle')->hasColumn($column);
    }

}
