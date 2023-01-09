<?php

require_once dirname(__FILE__).'/../lib/visitemedicaleGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/visitemedicaleGeneratorHelper.class.php';

/**
 * visitemedicale actions.
 *
 * @package    Bmm
 * @subpackage visitemedicale
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class visitemedicaleActions extends autoVisitemedicaleActions
{
    
      public function executeImprimerListeConsultation(sfWebRequest $request) {

        $pdf = new sfTCPDF('L');

// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Des Consultation médicale ');
        $pdf->SetSubject("Liste Des Consultation médicale ");
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
        $pdf->SetMargins(10, 30, 10);
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
        $html = $this->ReadHtmlListeConsultation($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste des Consultation médicale .pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeConsultation(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $visite = new Visitemedicale();
        $html .= $visite->ReadHtmlListeConsultation($request);
        return $html;
    }

    
    
      public function executeAfficehdetailDestination(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_destination = $params['id_destination'];
           

            $query = " select destinatonvisitemedicale.nbrjour as nbrjour"
                    
                    . " from destinatonvisitemedicale"
                    . " where  destinatonvisitemedicale.id=".$id_destination
            ;

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }

        die("Erreur");
    }

}
