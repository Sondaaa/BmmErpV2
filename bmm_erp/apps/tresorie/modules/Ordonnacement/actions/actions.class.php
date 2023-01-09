<?php

require_once dirname(__FILE__) . '/../lib/OrdonnancementGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/OrdonnancementGeneratorHelper.class.php';

/**
 * Ordonnancement actions.
 *
 * @package    Bmm
 * @subpackage Ordonnancement
 * @author     Your name here
 * @version    SVN: $Id$
 */
class OrdonnancementActions extends autoOrdonnancementActions {

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

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        $array_titre = TitrebudjetTable::getInstance()->getBudgetByExercice($_SESSION['exercice_budget']);

        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());

        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();
        $query = $query->innerjoin('r.Ligprotitrub l on l.id=r.id_budget');
        $query = $query->innerjoin('r.Piecejointbudget p on p.id_documentbudget=r.id');
        $query = $query->Andwhere('r.id_type=?', 2);
        $query = $query->Andwhere('r.mnt is not null');
        $query = $query->Andwherein('l.id_titre', $array_titre)
                ->andwhere("r.annule != '" . true . "'")
                ->orderBy('r.datecreation desc');

        return $query;
    }

    public function executeImprimerordonnance(sfWebRequest $request) {
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Ordonnance de Paiement');
        $pdf->SetSubject("Ordonnance de Paiement");
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

        //        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');
        //        // set header and footer fonts
        //        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        //        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(0, 0, 0);

        // set margins
        //        $pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(5, 10, 5);
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
        $html = $this->ReadHtmlOrdonnance($id);

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Ordonnance de Paiement.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlOrdonnance($id) {
        $html = StyleCssHeader::header1();
        $document_budget = new Documentbudget();
        $html .= $document_budget->ReadHtmlOrdonnance($id);
        return $html;
    }

    public function executeImprimerordonnanceHorsBCI(sfWebRequest $request) {
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Ordonnance de Paiement');
        $pdf->SetSubject("Ordonnance de Paiement");
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

        //        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');
        //        // set header and footer fonts
        //        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        //        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(0, 0, 0);

        // set margins
        //        $pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(5, 10, 5);
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
        $html = $this->ReadHtmlOrdonnanceHorsBCI($id);

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Ordonnance de Paiement.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlOrdonnanceHorsBCI($id) {
        $html = StyleCssHeader::header1();
        $document_budget = new Documentbudget();
        $html .= $document_budget->ReadHtmlOrdonnanceHorBCI($id);
        return $html;
    }

}
