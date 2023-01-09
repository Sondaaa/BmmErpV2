<?php

require_once dirname(__FILE__).'/../lib/echelleGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/echelleGeneratorHelper.class.php';

/**
 * echelle actions.
 *
 * @package    Bmm
 * @subpackage echelle
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class echelleActions extends autoEchelleActions
{
    public function executeImprimerAlllisteEchelle(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Echelle();
       
       $documentd=Doctrine_Core::getTable('echelle')->findOneById(1);
                                        
        $doc = $documentd;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des echelles :');
        $pdf->SetSubject("document du liste echelles");
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
        $html = $this->ReadHtmlAllEchelle($doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste echelles ' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlAllEchelle($documents) {
        $html = StyleCssHeader::header1();
        $html .= $documents->ReadHtmlAlllisteEchelle();
        return $html;
    }
    
    public function executeGetEchelle(sfWebRequest $request) {
        $query = " select COALESCE(count(agents.id),0) as nbragents,"
                . " trim(echelle.libelle)  as echelle "
                . " from agents,contrat,salairedebase,echelle "
                . " where contrat.id_agents=agents.id"
                . " and  contrat.id_salairedebase=salairedebase.id"
                . " and salairedebase.id_echelle= echelle.id"
                . " group by echelle";
        
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $this->agents = $conn->fetchAssoc($query);
    }

    public function executeStatistiqueAgentParEchelle(sfWebRequest $request) {
        
    }
}
