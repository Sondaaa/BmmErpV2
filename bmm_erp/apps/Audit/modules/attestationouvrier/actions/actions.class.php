<?php

require_once dirname(__FILE__) . '/../lib/attestationouvrierGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/attestationouvrierGeneratorHelper.class.php';

/**
 * attestationouvrier actions.
 *
 * @package    Bmm
 * @subpackage attestationouvrier
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class attestationouvrierActions extends autoAttestationouvrierActions {

    //delete 
       public function executeDelete(sfWebRequest $request) {
        $iddoc = $request->getParameter('id');
        //_________suppr. ligne doc ouvrier
      
        
        
        Doctrine_Query::create()->delete('ligneattestationouvrier')
                ->where('id_attestation=' . $iddoc)->execute();

        $this->forward404Unless($attestationouvrier = Doctrine_Core::getTable('attestationouvrier')->find(array($request->getParameter('id'))), sprintf('Object fiche does not exist (%s).', $request->getParameter('id')));
       
        $attestationouvrier->delete();




        $this->redirect('@attestationouvrier');
    }

//impresssion 

     public function executeImprimerattestationdetravail(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $doc = new Attestationouvrier();
        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('attestationouvrier')->findOneById($iddoc);
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
        $pdf->Output('attestation de travail'  . $doc->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlAttestationdetravail($document) {
        $html = StyleCssHeader::header1();
        $html .= $document->ReadHtmlAttestationdetaravil();

        return $html;
    }

    
//affiche ouvirer

    public function executeAfficheligneOuvrier(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idatte = $params['id'];

            $query = "select ouvrier.id as idouv,ligneattestationouvrier.nordre as norgdre , "
                    . " ouvrier.nom  as magouvrier ,ouvrier.cin as cin, ouvrier.matricule as ninscrit"
                    . " ,ouvrier.id_situation as ids"
                    . ", contratouvrier.id_ouvrier as idc ,contratouvrier.id_situationadmini as idsit"
                    . " , situationadminouvrier.libelle as situation"
                    . " from ligneattestationouvrier ,contratouvrier "
                    . ",ouvrier,situationadminouvrier,attestationouvrier"
                    . " where contratouvrier.id_situationadmini=situationadminouvrier.id"
                    . " and ligneattestationouvrier.id_ouvrier=ouvrier.id" 
                    . " and ligneattestationouvrier.id_attestation= ".$idatte.
                    " Limit 1"
            ;


            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocsOuvrier = $conn->fetchAssoc($query);
            die(json_encode($listedocsOuvrier));
        }
        die("bien");
    }

//save document attestation
    public function executeSavedocumentattestation(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {

            $params = json_decode($content, true);
            $id_ch = $params['id_ch'];
            $id_serv = $params['id_serv'];
               $id_direction = $params['id_direction'];
            $budget = $params['budget'];
            $porte = $params['porte'];
            $dated = $params['dated'];
            $datef = $params['datef'];



            $attestation = new Attestationouvrier();
//            if ($id != "") {
//                $att = Doctrine_Core::getTable('attestationouvrier')->findOneById($id);
//                if ($att)
//                    $attestation = $att;
//            }


            if ($datef != "")
                $attestation->setDatefin($datef);
            if ($dated != "")
                $attestation->setDatedebut($dated);
            if ($porte != "")
                $attestation->setPorte($porte);
            if ($budget != "")
                $attestation->setBudget($budget);
            if ($id_serv != "")
                $attestation->setIdService($id_serv);
            
              if ($id_direction != "")
                $attestation->setIdDirection($id_direction);
            
            if ($id_ch != "")
                $attestation->setIdChantier($id_ch);


            $attestation->save();




            die($attestation->getId() . "");
        }
        die('erreurr !!!');
    }

    //edit 
    public function executeEdit(sfWebRequest $request) {

        $this->attestationouvrier = Doctrine_Core::getTable('attestationouvrier')->findOneById($request->getParameter('id'));
        $this->form = $this->configuration->getForm($this->attestationouvrier);
    }

    public function executeAffichedetailOuvrier(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {

            $params = json_decode($content, true);
            $idou = $params['idou'];

            if ($idou) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = " SELECT ouvrier.id as idouvrier,  ouvrier.nom as nom, ouvrier.prenom as prenom ,ouvrier.cin as cin,ouvrier.matricule as ninscrit, ouvrier.id_situation as ids,situationadminouvrier.libelle as situation "
                        . " FROM ouvrier,situationadminouvrier"
                        . " WHERE ouvrier.id_situation= situationadminouvrier.id"
                        . " and ouvrier.id =" . $idou;

                $result1 = $conn->fetchAssoc($query);
                die(json_encode($result1));
            }

            die("Erreur");
        }
    }

    public function executeSavedocumentLigneOuvrier(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $listeslignesdocOuvrier = $params['listeslignesdocOuvrier'];
            $idouvrier = $params['idouvrier'];

            $idattestation = $params['idattestation'];
            if ($idattestation) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

//                Doctrine_Query::create()->delete('ligneattestationouvrier')
//                        ->where('id_attestation=' . $idattestation)->execute();
            }

            foreach ($listeslignesdocOuvrier as $lignedocOuvrier) {

                $idouvrier = $lignedocOuvrier['idouvrier'];
                $nordre = $lignedocOuvrier['norgdre'];


                $lignedocOuvrier = new Ligneattestationouvrier();

                if ($idouvrier != "")
                    $lignedocOuvrier->setIdOuvrier($idouvrier);
                if ($idattestation != "")
                    $lignedocOuvrier->setIdAttestation($idattestation);

                if ($nordre != "")
                    $lignedocOuvrier->setNordre($nordre);



                $lignedocOuvrier->save();
            }
        }
        die('ajout avec succe');
    }

}
