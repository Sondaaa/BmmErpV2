<?php

require_once dirname(__FILE__) . '/../lib/demandedevoirfichieradminGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/demandedevoirfichieradminGeneratorHelper.class.php';

/**
 * demandedevoirfichieradmin actions.
 *
 * @package    Bmm
 * @subpackage demandedevoirfichieradmin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class demandedevoirfichieradminActions extends autoDemandedevoirfichieradminActions {

    //save document 
    public function executeSavedocument(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {

            $params = json_decode($content, true);
            $id_service = $params['id_service'];
            $id_agents = $params['id_agents'];
            $personne = $params['personne'];
            $document = $params['document'];
            $datesue = $params['datesue'];


            $demande = new Demandedevoirfichieradmin();

            if ($id_service != "")
                $demande->setIdService($id_service);
            if ($document != "")
                $demande->setDocument($document);
            if ($personne != "")
                $demande->setPersonne($personne);
            if ($id_agents != "")
                $demande->setIdAgents($id_agents);
            if ($datesue != "")
                $demande->setDatedevue($datesue);

            $demande->save();
            die($demande->getId() . "");
        }
        die('erreurr !!!');
    }

    //edit 

    public function executeNew(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->demandedevoirfichieradmin = $this->form->getObject();
    }

    public function executeEdit(sfWebRequest $request) {
//        $this->demandedevoirfichieradmin = Doctrine_Core::getTable('demandedevoirfichieradmin')->findOneById($request->getParameter('id'));
//
//        //$this->demandedevoirfichieradmin = $this->getRoute()->getObject();
//        $this->form = $this->configuration->getForm($this->demandedevoirfichieradmin);
      
        $this->demandedevoirfichieradmin = Doctrine_Core::getTable('demandedevoirfichieradmin')->findOneById($request->getParameter('id'));
        $this->form = $this->configuration->getForm($this->demandedevoirfichieradmin);
    }

    public function executeDelete(sfWebRequest $request) {
        $iddoc = $request->getParameter('id');
        //_________suppr. ligne doc ouvrier



        Doctrine_Query::create()->delete('lignedemandecopie')
                ->where('id_demande=' . $iddoc)->execute();

        $this->forward404Unless($demandedevoirfichieradmin = Doctrine_Core::getTable('demandedevoirfichieradmin')->find(array($request->getParameter('id'))), sprintf('Object fiche does not exist (%s).', $request->getParameter('id')));

        $demandedevoirfichieradmin->delete();




        $this->redirect('@demandedevoirfichieradmin');
    }

//affichage detail 

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

//save ligne 

    public function executeSavedocumentLigneCopie(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $listeslignesdocCopie = $params['listeslignesdocCopie'];
            $num = $params['num'];
            $type = $params['type'];
            $contenu = $params['contenu'];

            $iddemande = $params['idd'];
            if ($iddemande) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

                Doctrine_Query::create()->delete('lignedemandecopie')
                        ->where('id_demande=' . $iddemande)->execute();
            }

            foreach ($listeslignesdocCopie as $lignedocCopie) {


                $nordre = $lignedocCopie['norgdre'];
                $type = $lignedocCopie['type'];
                $num = $lignedocCopie['num'];
                $contenu = $lignedocCopie['contenu'];
                $lignedocCopie = new Lignedemandecopie();

                if ($iddemande != "")
                    $lignedocCopie->setIdDemande($iddemande);

                if ($nordre != "")
                    $lignedocCopie->setNorde($nordre);
                if ($type != "")
                    $lignedocCopie->setType($type);
                if ($num != "")
                    $lignedocCopie->setNumero($num);
                if ($contenu != "")
                    $lignedocCopie->setContenu($contenu);


                $lignedocCopie->save();
            }
        }
        die('ajout avec succe');
    }

//affichage ligne copie
    public function executeAfficheligneCopie(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddemande = $params['id'];

            $query = "select lignedemandecopie.norde as norgdre , lignedemandecopie.numero as num, lignedemandecopie.type as type,lignedemandecopie.contenu as contenu "
                    . " from lignedemandecopie  "
                    . " where lignedemandecopie.id_demande= " . $iddemande 
                    
            ;


            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocsOuvrier = $conn->fetchAssoc($query);
            die(json_encode($listedocsOuvrier));
        }
        die("bien");
    }

//impression


    public function executeImprimerdemande(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $doc = new Demandedevoirfichieradmin();
        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('demandedevoirfichieradmin')->findOneById($iddoc);
        $doc = $documentachat;
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Demande de voir fichier :');
        $pdf->SetSubject("document du demande");
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
        $html = $this->ReadHtmlDdemande($doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('demande ' . $doc->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlDdemande($document) {
        $html = StyleCssHeader::header1();
        $html .= $document->ReadHtmlDemande();

        return $html;
    }

}
