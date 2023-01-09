<?php

require_once dirname(__FILE__) . '/../lib/ouvrierGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/ouvrierGeneratorHelper.class.php';

/**
 * ouvrier actions.
 *
 * @package    Bmm
 * @subpackage ouvrier
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ouvrierActions extends autoOuvrierActions {//test cin

    public function executeTestcin(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $cin = $params['cin'];

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT ouvrier.id as id , ouvrier.matricule as matricule "
                    . " FROM ouvrier"
                    . " WHERE ouvrier.cin='" . $cin . "'";
//. " WHERE CAST(agents.cin AS Character)='". $cin."'";

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    //test idrh
    public function executeTestidrh(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idrh'];

            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT ouvrier.id as id, ouvrier.cin as cin "
                    . " FROM ouvrier"
                    . " WHERE ouvrier.matricule ='" . $id . "'";

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    public function executeImprimerFiche(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Ouvrier');
        $pdf->SetSubject("Fiche Ouvrier");
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
        $html = $this->ReadHtmlFiche($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Fiche Ouvrier' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFiche($id) {
        $html = StyleCssHeader::header1();
        $ouvrier = new Ouvrier();
        $html .= $ouvrier->ReadHtmlFiche($id);

        return $html;
    }
}
