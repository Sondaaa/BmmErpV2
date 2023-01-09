<?php

require_once dirname(__FILE__) . '/../lib/tenuesGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/tenuesGeneratorHelper.class.php';

/* * imprimerListeTenue
 * tenues actions.
 *
 * @package    Bmm
 * @subpackage tenues
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */

class tenuesActions extends autoTenuesActions {//affiche detail agents 
//detail agents 

    public function executeAfficehdetailAgents(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idagent = $params['id_agents'];
            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//division en deux reqeutte pour eviter lerreur si na pas des info pour le contrat 
            $query_agents = "SELECT agents.idrh as idrh ,concat(agents.nomcomplet, ' '  ,agents.prenom )as nom "
                    . " FROM agents "
                    . " where agents.id=" . $idagent;
            $resultat_agents = $conn->fetchAssoc($query_agents);

            $query_contrat = "SELECT contrat.dateemposte as dateemposte "
                    . " ,posterh.libelle as poste"
                    . " FROM contrat ,posterh"
                    . " where  contrat.id_posterh=posterh.id "
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

//detail ouvrier 

    public function executeAfficehdetailOuvrier(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_ouvrier = $params['id_ouvrier'];
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT ouvrier.matricule as idrh ,"
                    . " concat(trim(ouvrier.nom), ' ' ,trim(ouvrier.prenom) )as nomcomplet,"
                    . " contratouvrier.daterecrutement as dateemposte ,"
                    . " situationadminouvrier.libelle as situation"
                    . " , specialiteouvrier.libelle  as poste"
                    . " FROM ouvrier , situationadminouvrier,contratouvrier ,specialiteouvrier "
                    . " WHERE ouvrier.id_situation= situationadminouvrier.id "
                    . " and contratouvrier.id_specialteouvrier= specialiteouvrier.id"
                    . " and ouvrier.id=" . $id_ouvrier
                    . "Limit 1";


            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

//imprssion


    public function executeImprimerListeTenue(sfWebRequest $request) {

        $pdf = new sfTCPDF('L');

// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Des Tenues de Travail  ');
        $pdf->SetSubject("Liste Des Tenues de Travail   ");
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
        $html = $this->ReadHtmlListeTenue($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste des Tenues de travail .pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeTenue(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $tenue = new Tenues();
        $html .= $tenue->ReadHtmlListeTenue($request);
        return $html;
    }

//detail type tenue 

    public function executeAfficehdetailTenues(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_mission = $params['id_mission']; //die('ss'.$id);
            if ($id_mission) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT typetenue.id as id , typetenue.libelle as libelle "
                        . " FROM typetenue,Typemission"
                        . " WHERE Typemission.id =" . $id_mission
                        . " and typetenue.id_typemisson=Typemission.id"
                ;

                $resultat = $conn->fetchAssoc($query);

                die(json_encode($resultat));
            }
        }

        die("Erreur");
    }

}
