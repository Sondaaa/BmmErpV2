<?php

/**
 * Donneadministratif actions.
 *
 * @package    Bmm
 * @subpackage Donneadministratif
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentsActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {

        $this->idagent = "";
        if ($request->getParameter('idagent') && $request->getParameter('idagent') != "") {
            $this->idagent = $request->getParameter('idagent');
            $this->donneadministratif = $this->donneadministratif->Andwhere("id_agents=" . $request->getParameter('idagent'));

            /*   $this->agent = Doctrine_Core::getTable('agents')
              ->createQuery('a')->where('id=' . $id)
              ->execute(); */
        }
    }

    public function executeIndexservice(sfWebRequest $request) {

        $this->idagent = "";
        if ($request->getParameter('idagent') && $request->getParameter('idagent') != "") {
            $this->idagent = $request->getParameter('idagent');
            $this->donneadministratif = $this->donneadministratif->Andwhere("id_agents=" . $request->getParameter('idagent'));

            /*   $this->agent = Doctrine_Core::getTable('agents')
              ->createQuery('a')->where('id=' . $id)
              ->execute(); */
        }
    }

    public function executeRechercheByCodeArticle(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
//             'codeagent': $scope.codeagent.text,
//            'nameagnet': $scope.nameagnet.text
            $params = json_decode($content, true);
            $codeagent = $params['codeagent'];
            $nameagnet = strtoupper($params['nameagnet']);
            $q = Doctrine_Query::create()
                    ->select(" id,idrh as ref,trim( both '  ' from nomcomplet) as name")
                    ->from('agents');
            //$nameagnet = str_replace("'", "''", $nameagnet);

            if ($codeagent != "" && $nameagnet == "")
                $q = $q->where("idrh like '%" . $codeagent . "%'");
            if ($codeagent == "" && $nameagnet != "")
                $q = $q->Where("upper(nomcomplet) like '%" . $nameagnet . "%'");
            if ($codeagent != "" && $nameagnet != "")
                $q = $q->Where("upper(nomcomplet) like '%" . $nameagnet . "%'")
                        ->AndWhere("idrh like '%" . $codeagent . "%'");
            $q = $q->limit(10);
            $listesagents = $q->fetchArray();
            die(json_encode($listesagents));
        }
        die('bien');
    }

    public function executeAfficheFicheAgent(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $codeagent = $params['codeagent'];
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT    agents.idrh,   agents.nomcomplet "
                    . "FROM    public.agents "
                    . "WHERE      agents.id ='" . $codeagent."'";
            //die($query);
            $ficheagents = $conn->fetchAssoc($query);

            die(json_encode($ficheagents));
        }
        die('ff');
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

}
