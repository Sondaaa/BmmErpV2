<?php

require_once dirname(__FILE__) . '/../lib/attestationdesalaireGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/attestationdesalaireGeneratorHelper.class.php';

/**
 * attestationdesalaire actions.
 *
 * @package    Bmm
 * @subpackage attestationdesalaire
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class attestationdesalaireActions extends autoAttestationdesalaireActions {

    public function executeAffichedetail(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idagent = $params['idag'];
            $ag = new Ouvrier();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT agents.id as ida, agents.idrh as idrh,contrat.id as idcontrat "
                    . " ,contrat.id_typecontrat as idc ,contrat.montant as montant"
                    . " , posterh.libelle as grade , typecontrat.libelle as situation "
                    . " FROM agents  , contrat  , posterh  ,  typecontrat  "
                    . " where contrat.id_agents=agents.id "
                    . " and contrat.id_posterh=posterh.id "
                    . " and contrat.id_typecontrat=typecontrat.id"
                    . " and agents.id=" . $idagent;

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    //charger primes 

    public function executeAffichedetailPrime(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idcontrat = $params['idp'];
         
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT titreprimes.libelle as libelle , primes.montant*12 as montant "
                    . " FROM primes ,titreprimes  , contrat  , ligneprimecontrat "
                    . " where ligneprimecontrat.id_contrat=contrat.id "
                    . " and ligneprimecontrat.id_prime=primes.id"
                    . " and primes.id_titreprime=titreprimes.id "
                    . " and contrat.id=" . $idcontrat;

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    
    // afficher le montant enchiffre
    
     public function executeAffichemontant(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $montant = $params['montant'];
          die(json_encode(chiffreToLettre::cvnbst($montant)));
            
             
        }

        die("Erreur");
    }

   
    //impression attestation 


    public function executeImprimerattestationdesalaire(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $doc = new Attestationdesalaire();
        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('attestationdesalaire')->findOneById($iddoc);
        $doc = $documentachat;
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Attestation de salaire:');
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
        $html = $this->ReadHtmlAttestationdesalaire($doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('attestation de salaire' . $doc->getIdAgents() . $doc->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlAttestationdesalaire($document) {
        $html = StyleCssHeader::header1();
        $html .= $document->ReadHtmlAttestationSalaire();

        return $html;
    }

}
