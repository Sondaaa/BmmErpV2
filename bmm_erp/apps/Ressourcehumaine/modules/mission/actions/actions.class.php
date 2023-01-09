<?php

require_once dirname(__FILE__) . '/../lib/missionGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/missionGeneratorHelper.class.php';

/**
 * mission actions.
 *
 * @package    Bmm
 * @subpackage mission
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class missionActions extends autoMissionActions {

    //agents
    public function executeAffichedetail(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idagent = $params['idag'];
            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT agents.idrh as matricule "
                    . " FROM agents"
                    . " WHERE agents.id=" . $idagent;

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    
    
     public function executeAffichedetailMission(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idmission = $params['id'];
            $miss = new Mission();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT mission.moyentransport as moyentransport "
                    . " FROM mission"
                    . " WHERE mission.id=" . $idmission;

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }
    //ouvrier

    public function executeAffichedetailOuvirer(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idouvrier = $params['idouvrier'];
            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT ouvrier.matricule as matricule "
                    . " FROM ouvrier"
                    . " WHERE ouvrier.id=" . $idouvrier;

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

//impression

    public function executeImprimermission(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $doc = new Mission();
        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('mission')->findOneById($iddoc);
        $doc = $documentachat;
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Mission  :');
        $pdf->SetSubject("document mission");
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
//        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->SetFont('aealarabiya', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlMission($doc);

        $pdf->writeHTML($html, true, false, true, false, '');

        $conteurtext = 120;
        $conteurcercle = 170;
        $conteurtext2 = 45;
        $conteurcercle2 = 170;
        
        $conteurtext3 = 45;
        $conteurcercle3 = 250;
        $conteurtext4 = 150;
        $conteurcercle4 = 250;
        
       
//        foreach ($visaas as $visa) {
        $mission = new Mission();
        $mi = Doctrine_Core::getTable('mission')->findOneById($iddoc);
        if ($mi) {
            $mission = $mi;
            $cheminimage = sfconfig::get('sf_appdir') . 'uploads/images/' . $mission->getCheminsigndirecteur();
            $pdf->Image($cheminimage, $conteurtext - 5, $conteurcercle - 15, 30, 30, 'JPG', '', '', true, 50, '', false, false, 0, false, false, false);
            $conteurtext+=35;

            $cheminimagedaf = sfconfig::get('sf_appdir') . 'uploads/images/' . $mission->getCheminsignadaf();
            $pdf->Image($cheminimagedaf, $conteurtext2 - 5, $conteurcercle2 - 15, 30, 30, 'JPG', '', '', true, 50, '', false, false, 0, false, false, false);
            $conteurtext2+=35;
            
            
           
            $cheminimage = sfconfig::get('sf_appdir') . 'uploads/images/' . $mission->getCheminsigndirecteur();
            $pdf->Image($cheminimage, $conteurtext3 - 5, $conteurcercle3 - 15, 30, 30, 'JPG', '', '', true, 50, '', false, false, 0, false, false, false);
            $conteurtext3+=35;
            
             $cheminimage = sfconfig::get('sf_appdir') . 'uploads/images/' . $mission->getCheminsignagents();
            $pdf->Image($cheminimage, $conteurtext4 - 5, $conteurcercle4 - 15, 30, 30, 'JPG', '', '', true, 50, '', false, false, 0, false, false, false);
            $conteurtext3+=35;
            
        }
//        }



        $pdf->Output('mission  ' . $doc->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlMission($document) {
        $html = StyleCssHeader::header1();
        $html .= $document->ReadHtmlMission();

        return $html;
    }

}
