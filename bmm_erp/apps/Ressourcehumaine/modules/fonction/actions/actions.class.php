<?php

require_once dirname(__FILE__) . '/../lib/fonctionGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/fonctionGeneratorHelper.class.php';

/**
 * fonction actions.
 *
 * @package    Bmm
 * @subpackage fonction
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fonctionActions extends autoFonctionActions {

    public function executeImprimerAllliste(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Fonction();

        $documentd = Doctrine_Core::getTable('fonction')->findOneById(3);

        $doc = $documentd;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des fonctions :');
        $pdf->SetSubject("document du liste fonctions");
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
        $html = $this->ReadHtmlAllFonctions($doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste fonctions ' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlAllFonctions($documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmlAlllisteFonction();

        return $html;
    }

    public function executeGetFonction(sfWebRequest $request) {
        $query = " select COALESCE(count(agents.id),0) as nbragents"
                . ", trim(fonction.description)  as fonction "
                . " from agents,contrat,fonction "
                . " where contrat.id_agents=agents.id"
                . " and  contrat.id_fonction=fonction.id"
                . " group by fonction";
        
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $this->agents = $conn->fetchAssoc($query);
    }

    public function executeStatistiqueAgentParFonction(sfWebRequest $request) {
        
    }

}
