<?php

require_once dirname(__FILE__) . '/../lib/ordredeservicecontratachatGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/ordredeservicecontratachatGeneratorHelper.class.php';

/**
 * ordredeservicecontratachat actions.
 *
 * @package    Bmm
 * @subpackage ordredeservicecontratachat
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ordredeservicecontratachatActions extends autoOrdredeservicecontratachatActions {

    public function executeMisajourfiche(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            //die("cds");
            $params = json_decode($content, true);
            $date = $params['dat'];
            $obj = $params['obj'];
            $ref = $params['ref'];
            $desc = $params['desc'];
            $id = $params['id'];
//            die($id.'vds');
            $typeav = "";
            if ($params['typeav'])
                $typeav = $params['typeav'];
            $ordre = new Ordredeservice();
            $ord = Doctrine_Core::getTable('ordredeservicecontratachat')->findOneById($id);

            if ($ord) {
                $ordre = $ord;
                $ordre->setDateios($date);
                $ordre->setObject($obj);
                $ordre->setReference($ref);
                $ordre->setDescription(html_entity_decode($desc));
                $ordre->save();
//                die($ordre->getId() . '');
                $contrat = new Contratachat();
                $contratachat = ContratachatTable::getInstance()->find($ordre->getIdContrat());
                
                if ($typeav == 1) {
                    if ($ordre->getDateios())
                        $contratachat->setDateoservice($ordre->getDateios());
              
               } 
                $contratachat->save();
                //die($typeav . "cde" . $ordre->getDateios() . "e");
                if ($typeav == 5) {
                    if ($contratachat) {
                        $contrat->MisajourDelaiArretJustfier($ordre);
                    }
                }
            }
        }
        die('bien');
    }

    public function executeImprimerOs(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $id = $request->getParameter('id');

        // pdf object
        $pdf = new sfTCPDF('L');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('OS');
        $pdf->SetSubject("OS");
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
//$pdf->SetFont('dejavusans', '', 12);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        $html = $this->ReadHtmlOs($id);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('OS.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlOs($id) {
        $html = StyleCssHeader::header1();
        $os = new Ordredeservicecontratachat();
        $html .= $os->ReadHtmlOs($id);

        return $html;
    }

}
