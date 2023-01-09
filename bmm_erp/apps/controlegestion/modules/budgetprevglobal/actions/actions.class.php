<?php

require_once dirname(__FILE__) . '/../lib/budgetprevglobalGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/budgetprevglobalGeneratorHelper.class.php';

/**
 * budgetprevglobal actions.
 *
 * @package    Bmm
 * @subpackage budgetprevglobal
 * @author     Your name here
 * @version    SVN: $Id$
 */
class budgetprevglobalActions extends autoBudgetprevglobalActions {

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
        // die($query);
        $query = $query->andWhere("EXTRACT(YEAR FROM datecreation) = '" . $_SESSION['exercice_budget'] . "'");
        $query = $query->AndWhere("typebudget like '%Budget Prévisionnel Global%'")->OrderBy('id desc');


        return $query;
    }

    public function executeDelete(sfWebRequest $request) {
        $id = $request->getParameter('id', "");
        $query_parents = Doctrine_Query::create()
                ->delete('Ligprotitrub')
                ->where('id_titre=' . $id);
        $query_parents->execute();
        $query = Doctrine_Query::create()
                ->delete('titrebudjet')
                ->where('id=' . $id);
        $query = $query->execute();
        $this->redirect('budgetprevglobal');
    }

    //check budget exist by categorie
    public function executeCheckbudget(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_categorie = $params['id_categorie'];

            $budget_selected = Doctrine_Core::getTable('titrebudjet')->createQuery('a')
                            ->where('id_cat=' . $id_categorie)
                            ->andWhere("typebudget ='Budget Prévisionnel Global'")
                            ->andWhere(" EXTRACT(YEAR FROM datecreation) = " . $_SESSION['exercice_budget'])->execute()->getFirst();
            if ($budget_selected) {

                return $this->renderText(json_encode(array(
                            "id_budget" => $budget_selected->getId()
                )));
            }
        }
        return $this->renderText(json_encode(array(
                    "id_budget" => null
        )));
    }

    public function executeDetailbudget(sfWebRequest $request) {
        $this->titrebudjet = new Titrebudjet();
        $this->titrebudjet = Doctrine_Core::getTable('titrebudjet')->findOneById($request->getParameter('id'));
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {


                $titrebudjet = $form->save();


                //SAVE Budget Prevesionnelle global
                $titre = new Titrebudjet();
                $titre->CopierRubriqueEtSousRubriqueForGlobalByCategorie($titrebudjet->getId());
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $titrebudjet)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@budgetprevglobal_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'budgetprevglobal_edit', 'sf_subject' => $titrebudjet));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    public function executeImprimerlisteBudgetPardirection(sfWebRequest $request) {
//        die('hh');
//        if($request->getParameter('arraycourrier'))
//            die($request->getParameter('arraycourrier'));
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $pdf = new sfTCPDF();

        $pdf->SetTitle('Listes des Budget Prévisionnel Global Par Direction');
        $pdf->SetSubject("Listes des Budget Prévisionnel Global Par Direction");

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
       
        $html = $this->ReadHtmlListesBudgetPardirection($request);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Listes des Budget Prévisionnel Global Par Direction' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListesBudgetPardirection(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $doc = new titrebudjet();
       
        $html.=$doc->ReadHtmlListeBudgetParDirection($request);
        //die($html);
        return $html;
    }

    public function executeImprimerlisteBudgetParOrigine(sfWebRequest $request) {
//        die('hh');
//        if($request->getParameter('arraycourrier'))
//            die($request->getParameter('arraycourrier'));
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $pdf = new sfTCPDF();

        $pdf->SetTitle('Listes des Budget Prévisionnel Global Par Origine');
        $pdf->SetSubject("Listes des Budget Prévisionnel Global Par Origine");

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

        $html = $this->ReadHtmlListesBudgetParorigine($request);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Listes des Budget Prévisionnel Global Par Origine' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListesBudgetParorigine(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $doc = new titrebudjet();
        $html.=$doc->ReadHtmlListeBudgetParorigine($request);
        //die($html);
        return $html;
    }

    public function executeExporterDocumentsbudgetExcel(sfWebRequest $request) {
        $id_cat = $request->getParameter('id_cat', "");
        $this->id_cat = $id_cat;
    }

    public function executeExporterDocumentsbudgetPardirectionExcel(sfWebRequest $request) {
        $id_cat = $request->getParameter('id_cat', "");
        $this->id_cat = $id_cat;
    }

}
