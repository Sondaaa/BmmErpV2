<?php

require_once dirname(__FILE__) . '/../lib/corpsGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/corpsGeneratorHelper.class.php';

/**
 * corps actions.
 *
 * @package    Bmm
 * @subpackage corps
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class corpsActions extends autoCorpsActions {

    public function executeImprimerAlllistecorps(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Corps();

        $documentd = Doctrine_Core::getTable('corps')->findOneById(2);

        $doc = $documentd;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des corps :');
        $pdf->SetSubject("document du liste corps");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
       $soc = $societe;
        $entete =  $soc->getMinistere();
        $rs=$soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');

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
        $html = $this->ReadHtmlAllCorps($doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste situations ' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlAllCorps($documents) {
        $html = StyleCssHeader::header1();
        $html .= $documents->ReadHtmlAlllisteCorps();
        return $html;
    }

    public function executeGetCorps(sfWebRequest $request) {
        $query = " select COALESCE(count(agents.id),0) as nbragents,"
                . " trim(corps.libelle)  as corps "
                . " from agents,contrat,salairedebase,categorierh ,corps"
                . " where contrat.id_agents=agents.id"
                . " and  contrat.id_salairedebase=salairedebase.id"
                . " and salairedebase.id_categorie= categorierh.id"
                . " and categorierh.id_corps=corps.id "
                . " group by corps";
        
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $this->agents = $conn->fetchAssoc($query);
    }

    public function executeStatistiqueAgentParCorps(sfWebRequest $request) {
        
    }

}
