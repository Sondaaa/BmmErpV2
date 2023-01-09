<?php

require_once dirname(__FILE__).'/../lib/gradeGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/gradeGeneratorHelper.class.php';

/**
 * grade actions.
 *
 * @package    Bmm
 * @subpackage grade
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gradeActions extends autoGradeActions
{
    public function executeImprimerAlllistegrade(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Grade();
       
       $documentd=Doctrine_Core::getTable('grade')->findOneById(2);
                                        
        $doc = $documentd;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des grades :');
        $pdf->SetSubject("document du liste grade");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getRs();
        $pdf->SetAuthor($entete);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');
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
        $html = $this->ReadHtmlAllGrade($doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste situations ' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlAllGrade($documents) {
        $html = StyleCssHeader::header1();
       
        $html .= $documents->ReadHtmlAlllisteGrade();

        return $html;
    }
   

     public function executeStatistiqueAgentParGrade(sfWebRequest $request) {
        
    }
    public function executeGetGrade(sfWebRequest $request) {
        $query = " select COALESCE(count(agents.id),0) as nbragents, trim(grade.libelle)  as grade "
                . " from agents,contrat,salairedebase,grade "
                . " where contrat.id_agents=agents.id"
                . " and  contrat.id_salairedebase=salairedebase.id"
                . " and salairedebase.id_grade= grade.id"
                . " group by grade"

        ;
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $this->agents = $conn->fetchAssoc($query);
    }
//imprimer grade par cat 
    
     public function executeImprimerAlllistegradeparcategorie(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
       $doc = new Grade();
       $id1 = $request->getParameter('idcategorie');
       $documentd=Doctrine_Core::getTable('grade')->findOneById(20);
                                        
        $doc = $documentd;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des grades :');
        $pdf->SetSubject("document du liste grade");
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
        $html = $this->ReadHtmlAllGradeparcat($id1,$doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste grade ' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlAllGradeparcat($id1,$documents) {
        $html = StyleCssHeader::header1();
       
        $html .= $documents->ReadHtmlAlllisteGradeparcat($id1);

        return $html;
    }
 //grade par corps 
    
      public function executeImprimerAlllistegradeparcorps(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
       $doc = new Grade();
       $id1 = $request->getParameter('idcorps');
       $documentd=Doctrine_Core::getTable('grade')->findOneById(20);
                                        
        $doc = $documentd;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des grades :');
        $pdf->SetSubject("document du liste grade");
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
        $html = $this->ReadHtmlAllGradeparcorps($id1,$doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste grade ' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlAllGradeparcorps($id1,$documents) {
        $html = StyleCssHeader::header1();
       
        $html .= $documents->ReadHtmlAlllisteGradeparcorps($id1);

        return $html;
    }
}
