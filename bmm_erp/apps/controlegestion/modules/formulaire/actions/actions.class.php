<?php

require_once dirname(__FILE__) . '/../lib/formulaireGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/formulaireGeneratorHelper.class.php';

/**
 * formulaire actions.
 *
 * @package    Bmm
 * @subpackage formulaire
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class formulaireActions extends autoFormulaireActions {

    public function executeAffichedetail(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idagent = $params['idag'];
          //   $_ancienete = floor((time() - strtotime($dateemposte)) / 31556926);
            $ag = new Ouvrier();
             
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT agents.id as ida, agents.idrh as idrh , agents.nomcomplet as nom"
                    . " ,agents.prenom as prenom "
                    . " ,agents.datenaissance as daten,agents.lieun as idlieun "
                    . " ,gouvernera.gouvernera as lieunais ,contrat.id_salairedebase as idsa "
                    . " , salairedebase.id_corps as idco , corps.libelle as corps "
                    . " ,salairedebase.id_grade as idgrade , grade.libelle as gradea"
                    . " , salairedebase.id_echelon as idech , echelon.libelle as echelon"
                    . " ,contrat.id_lieu as idl , lieutravail.libelle as lieutravail"
                    . " ,contrat.dateechelon as dateen"
                    . " , contrat.dategrade as dategrade"
                  
                    . " FROM agents,gouvernera,contrat ,salairedebase , corps  ,grade,echelon ,lieutravail    "
                    . " where contrat.id_agents=agents.id "
                    . " and contrat.id_salairedebase=salairedebase.id  and salairedebase.id_grade=grade.id"
                    . " and salairedebase.id_corps=corps.id "
                    . " and agents.lieun=gouvernera.id"
                    . " and salairedebase.id_echelon=echelon.id "
                    . " and contrat.id_lieu=lieutravail.id"
                    . " and agents.id=" . $idagent
                    . " Limit 1";

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }
//impression 
    
     public function executeImprimerformulaire(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $doc = new Formulaire();
        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('formulaire')->findOneById($iddoc);
        $doc = $documentachat;
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Formulaire  :');
        $pdf->SetSubject("document du contrat");
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
        $html = $this->ReadHtmlFormulaire($doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('demande Formulaire ' . $doc->getIdAgents() . $doc->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFormulaire($document) {
        $html = StyleCssHeader::header1();
        $html .= $document->ReadHtmlFormulaire();

        return $html;
    }
}
