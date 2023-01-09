<?php

require_once dirname(__FILE__) . '/../lib/documentbudgetGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/documentbudgetGeneratorHelper.class.php';

/**
 * documentbudget actions.
 *
 * @package    Bmm
 * @subpackage documentbudget
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class documentbudgetActions extends autoDocumentbudgetActions {

    public function executeIndex(sfWebRequest $request) {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }
        $idtype = 1;
        if (isset($_REQUEST['idtype']))
            $idtype = $_REQUEST['idtype'];
        $this->pager = $this->getPager($idtype);
        $this->sort = $this->getSort();
        $this->idtype = $idtype;
    }

    protected function getPager($idtype) {
        $pager = $this->configuration->getPager('documentbudget');
        $pager->setQuery($this->buildQuery($idtype));
        $pager->setPage($this->getPage());
        $pager->init();

        return $pager;
    }

    protected function buildQuery($idtype) {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);
        $documentsachat = Doctrine_Core::getTable('documentbudget')
                ->createQuery('a');
        $query = $this->filters->buildQuery($this->getFilters());
        if (isset($filter['id_type']) && !$idtype) {
            $documentsachat = $documentsachat->where('id_type=' . $filter['id_type']);
        } else if ($idtype) {
            $filter['id_type'] = $idtype;
            $documentsachat = $documentsachat->where('id_type=' . $idtype);
        }
        if (isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        }
        if (isset($filter['datecreation']['from']) && !isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
        }
        if (!isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {

            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        }
        if (!isset($filter['datecreation']['from']) && !isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation >='" . date('Y') . "-01-01" . "'")
                    ->Andwhere("datecreation <='" . date('Y') . "-12-31" . "'")
                    ->OrderBy('id desc');
        }
        $query = $documentsachat->OrderBy('id desc');
        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

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
        $soc = $societe;
        $entete = $soc->getRs();
        $pdf->SetAuthor($entete);
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

    public function executeGetNewOrdonnace(sfWebRequest $request) {
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $query = "SELECT db.id as id, db.numero as numero ,
                concat(typedoc.prefixetype,LPAD(documentachat.numero::text, 7, '0'),
                 '-',  trim( documentachat.reference)) as name ,documentachat.mntttc as mntttc,
                 fournisseur.rs as rs
                FROM Documentbudget db , Ligprotitrub l ,
                Lignebanquecaisse lbc,caissesbanques ca,
                documentachat,typedoc,fournisseur,piecejointbudget"
                . " where db.id_budget=l.id and l.id= lbc.id_budget"
                . " and  db.id_type=2 AND lbc.id_caissebanque <> 14 "
                . " and lbc.id_caissebanque=ca.id "
                . "  AND db.id NOT IN (SELECT DISTINCT(mb.id_documentbudget) "
                . "   FROM mouvementbanciare mb where mb.id_documentbudget IS NOT NULL)"
                . " and documentachat.id_typedoc=typedoc.id "
                . " and documentachat.id_frs=fournisseur.id "
                . " and piecejointbudget.id_documentbudget = db.id "
                . " and piecejointbudget.id_docachat=documentachat.id "
//                and ca.dateouvert>= " . "'01-01-" . date('Y') . "'"
//                . " and ca.dateouvert <= " . "'31-12-" . date('Y') . "'"
                . "  ORDER BY db.id desc";
   //   die($query);
        $resultat = $conn->fetchAssoc($query);
        die(json_encode($resultat));
    }

    public function executeGetNewOrdonnaceHorsBCI(sfWebRequest $request) {
//        $q = Doctrine_Query::create()
//                ->select("db.id as id, db.numero as numero")
//                ->from('Documentbudget db')
//                ->leftJoin('db.Ligprotitrub l')
//                ->leftJoin('l.Lignebanquecaisse lbc')
//                ->andWhere('db.id_type=2')
//                ->andwhere('lbc.id_caissebanque  <> 14')
//                ->andWhere('db.id NOT IN '
//                        . '(SELECT DISTINCT(mb.id_documentbudget) FROM mouvementbanciare mb '
//                        . 'where mb.id_documentbudget IS NOT NULL)')                
//                ->orderBy('db.id desc')
//                ->fetchArray();
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $query = "SELECT db.id as id, db.numero as numero 
                FROM Documentbudget db , Ligprotitrub l ,Lignebanquecaisse lbc,caissesbanques ca , Piecejointbudget piece
                where db.id_budget=l.id 
                and piece.id_documentbudget=db.id
                and l.id= lbc.id_budget 
                and  db.id_type=2 AND lbc.id_caissebanque = 14 
                and lbc.id_caissebanque=ca.id 
                AND db.id NOT IN (SELECT DISTINCT(mb.id_documentbudget) 
                FROM mouvementbanciare mb where mb.id_documentbudget IS NOT NULL)"
                . " and db.id_type=2 "
                . " and piece.id_docachat is null"
//                and ca.dateouvert>= " . "'01-01-" . date('Y') . "'"
//                . " and ca.dateouvert <= " . "'31-12-" . date('Y') . "'"
                . "  ORDER BY db.id desc";
        $resultat = $conn->fetchAssoc($query);
        die(json_encode($resultat));
    }

    public function executeImprimerordonnanceHorsBci(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $id = $request->getParameter('id');
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Ordonnance de Paiement');
        $pdf->SetSubject("Ordonnance de Paiement");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

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
        $html = $this->ReadHtmlOrdonnanceHorsBci($id);
        ob_end_clean();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Ordonnance de Paiement.pdf', 'I');
        throw new sfStopException();
    }

    public function ReadHtmlOrdonnanceHorsBci($id) {
        $html = StyleCssHeader::header1();
        $document_budget = new Documentbudget();
        $html .= $document_budget->ReadHtmlOrdonnanceHorBCI($id);
        return $html;
    }

}
