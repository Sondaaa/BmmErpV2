<?php

require_once dirname(__FILE__) . '/../lib/attestationdetravailGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/attestationdetravailGeneratorHelper.class.php';

/**
 * attestationdetravail actions.
 *
 * @package    Bmm
 * @subpackage attestationdetravail
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class attestationdetravailActions extends autoAttestationdetravailActions {

    //affiche detail date naissance et lieu de naissance
    public function executeAffichedetail(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idagent = $params['idag'];
            $ag = new Ouvrier();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//        
            $query = "SELECT agents.datenaissance as date ,gouvernera.gouvernera as lieu, agents.lieun as  idlieu ,contrat.id_salairedebase as idsa , salairedebase.id_corps as idco , corps.libelle as corps ,salairedebase.id_grade as idgrade , grade.libelle as grade  "
                    . "FROM agents , contrat  , salairedebase , corps , gouvernera ,grade   "
                    . " where contrat.id_agents=agents.id "
                    . " and contrat.id_salairedebase=salairedebase.id  and salairedebase.id_grade=grade.id"
                    
                    . " and salairedebase.id_corps=corps.id "
                    
                    . " and  gouvernera.id=agents.lieun "
                    . " and agents.id=" . $idagent
                    . " Limit 1";

//            $query = "SELECT agents.datenaissance as date , agents.lieun as idlieu ,gouvernera.gouvernera as lieu , corps.libelle as corps "
//                    . " FROM agents , gouvernera , salairedebase , corps ,contrat"
//                    . " where contrat.id_agents=agents.id "
//                    . " and contrat.id_salairedebase=salairedebase.id "
//                    . " and salairedebase.id_corps=corps.id "
//                    . " and  gouvernera.id=agents.lieun "
//                    . " and agents.id=" . $idagent;
        //    . " and salairedebase.id_grade=grade.id "

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
      }
    //impression en francais   
    public function executeImprimerattestationdetravail(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $doc = new Attestationdetravail();
        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('attestationdetravail')->findOneById($iddoc);
        $doc = $documentachat;
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Attestation de travail:');
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
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlAttestationdetravail($doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('attestation de travail' . $doc->getIdAgents() . $doc->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlAttestationdetravail($document) {
        $html = StyleCssHeader::header1();
        $html .= $document->ReadHtmlAttestationdetaravil();

        return $html;
    }
//impression en arabe 
    
    

       public function executeImprimerattestationdetravailArabe(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $doc = new Attestationdetravail();
        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('attestationdetravail')->findOneById($iddoc);
        $doc = $documentachat;
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Attestation de travail:');
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
      //  $pdf->SetFont('dejavusans', '', 10, '', true);
         $pdf->SetFont('aealarabiya', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlAttestationdetravailArabe($doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('attestation de travail' . $doc->getIdAgents() . $doc->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlAttestationdetravailArabe($document) {
        $html = StyleCssHeader::header1();
        $html .= $document->ReadHtmlAttestationdetaravilArabe();

        return $html;
    }

}
