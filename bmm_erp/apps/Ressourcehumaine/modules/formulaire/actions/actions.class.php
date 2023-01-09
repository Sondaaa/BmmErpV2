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
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query_agents = "SELECT agents.id as ida, agents.idrh as idrh , agents.nomcomplet as nom"
                    . " ,agents.prenom as prenom "
                    . " ,agents.datenaissance as daten"
                    . " ,agents.lieun as idlieun "
                    . " ,gouvernera.gouvernera as lieunais "
                    . " FROM agents,gouvernera "
                    . " where agents.lieun=gouvernera.id "
                    . " and agents.id=" . $idagent;
            $resultat_agents = $conn->fetchAssoc($query_agents);

            $query_contrat = "SELECT"
                    . " contrat.id_salairedebase as idsa "
                    . " , salairedebase.id_corps as idco , "
                    . " corps.libelle as corps ,"
                    . " salairedebase.id_grade as idgrade  "
                    . ", grade.libelle as gradea,"
                    . " salairedebase.id_echelon as idech "
                    . " , echelon.libelle as echelon,"
                    . " contrat.id_lieu as idl "
                    . "  ,lieutravail.libelle as lieutravail"
                    . " ,contrat.dateechelon as dateen"
                    . " , contrat.dategrade as dategrade"
                    . " FROM contrat ,lieutravail"
                    . ",salairedebase , corps  "
                    . ",grade,echelon     "
                    . " where"
                    . " contrat.id_salairedebase=salairedebase.id "
                    . " and salairedebase.id_grade=grade.id"
                    . " and salairedebase.id_corps=corps.id "
                    . " and salairedebase.id_echelon=echelon.id "
                    . " and contrat.id_lieu=lieutravail.id"
                    . " and contrat.id_agents=" . $idagent
                    . " Order by contrat.id DESC"
                    . " Limit 1 ";
            $resultat_contrat = $conn->fetchAssoc($query_contrat);

            $resultat = array();
            $resultat['agents'] = $resultat_agents;
            $resultat['contrat'] = $resultat_contrat;
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
        $pdf->SetAutoPageBreak(TRUE, 10);

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



        $conteurtext = 32;
        $conteurcercle = 272;
        $formpulaire = new Formulaire();
        $form = Doctrine_Core::getTable('formulaire')->findOneById($iddoc);
        if ($form) {
            $formpulaire = $form;
            $cheminimage = sfconfig::get('sf_appdir') . 'uploads/images/' . $formpulaire->getCheminsignature();
            $pdf->Image($cheminimage, $conteurtext - 5, $conteurcercle - 15, 30, 30, 'JPG', '', '', true, 50, '', false, false, 0, false, false, false);
            $conteurtext+=35;
        }
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
