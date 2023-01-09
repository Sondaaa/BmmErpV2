<?php

require_once dirname(__FILE__).'/../lib/servicerhGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/servicerhGeneratorHelper.class.php';

/**
 * servicerh actions.
 *
 * @package    Bmm
 * @subpackage servicerh
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class servicerhActions extends autoServicerhActions
{
      public function executeImprimerAllliste(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Servicerh();
       
       $documentd=Doctrine_Core::getTable('servicerh')->findOneById(27);
                                        
        $doc = $documentd;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des services :');
        $pdf->SetSubject("document du liste services");
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
        $html = $this->ReadHtmlAllServices($doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste service ' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

     public function ReadHtmlAllServices($documents) {
        $html = StyleCssHeader::header1();
       
        $html .= $documents->ReadHtmlAlllisteServices();

        return $html;
    }
    //service par direction 
    
     public function executeImprimerlisteservicepardirection(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Servicerh();
        $idd = $request->getParameter('idservice');
       $documentd=Doctrine_Core::getTable('servicerh')->findOneById(27);
                                        
        $doc = $documentd;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des services :');
        $pdf->SetSubject("document du liste services");
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
        $html = $this->ReadHtmlAllServicespardirection($idd,$doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste service ' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

     public function ReadHtmlAllServicespardirection($idd,$documents) {
        $html = StyleCssHeader::header1();
       
        $html .= $documents->ReadHtmlAlllisteServicespardirection($idd);

        return $html;
    }
  //service par sous directions 
    
     public function executeImprimerlisteserviceparsousdirection(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Servicerh();
        $idd = $request->getParameter('idservice');
       $documentd=Doctrine_Core::getTable('servicerh')->findOneById(27);
                                        
        $doc = $documentd;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des services :');
        $pdf->SetSubject("document du liste services");
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
        $html = $this->ReadHtmlAllServicesparsousdirection($idd,$doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste service ' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

     public function ReadHtmlAllServicesparsousdirection($idd,$documents) {
        $html = StyleCssHeader::header1();
       
        $html .= $documents->ReadHtmlAlllisteServicesparsousdirection($idd);

        return $html;
    }
    
    public function executeGetService(sfWebRequest $request) {
        $query = " select COALESCE(count(agents.id),0) as nbragents"
                    . ", concat (trim(direction.libelle),' -> ',trim(sousdirection.libelle),' -> ', trim(servicerh.libelle))  as service "
                    . " from agents,contrat,unite,direction ,servicerh,sousdirection,posterh"
                    . " where contrat.id_agents=agents.id"
                    . " and  contrat.id_posterh=posterh.id"
                    . "  and posterh.id_unite=unite.id"
                    . " and unite.id_service=servicerh.id"
                    . " and servicerh.id_sousdirection=sousdirection.id"
                    . " and sousdirection.id_direction=direction.id"
                    ." group by service";
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $this->agents = $conn->fetchAssoc($query);
    }

    public function executeStatistiqueAgentParService(sfWebRequest $request) {
        
    }
}
