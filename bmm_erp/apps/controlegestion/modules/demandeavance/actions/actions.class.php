<?php

require_once dirname(__FILE__) . '/../lib/demandeavanceGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/demandeavanceGeneratorHelper.class.php';

/**
 * demandeavance actions.
 *
 * @package    Bmm
 * @subpackage demandeavance
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class demandeavanceActions extends autoDemandeavanceActions {

    public function executeAffichedetaildemande(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $ids = $params['ids'];
            $ids = explode(',,', $ids);

            $query = " select demandeavance.id as id , demandeavance.montanttotal as montanttotal"
                    . " , demandeavance.montantmensielle as montantmensielle "
                    . " ,demandeavance.mois as mois,"
                    . "demandeavance.datedebutretenue as demandeavance,demandeavance.datefinretenue as datefinretenue, "
                    . " demandeavance.annee as annee,concat(agents.nomcomplet , agents.prenom) as agents, "
                    . " avance.libelle as typeavance , avance.id as id_avance, avance.remboursement as nbrmois"
                    . " from demandeavance,avance ,agents"
                    . " where  demandeavance.id_agents IN (" . implode(',', array_map('intval', $ids)) . ")"
                    . "  and demandeavance.id_agents = agents.id"
                    . " and demandeavance.id_typeavance = avance.id"
                    . " and TO_CHAR(demandeavance.datefinretenue, 'yyyy-mm') >= '" . date("Y-m") . "'"
                    . " and TO_CHAR(demandeavance.datedebutretenue, 'yyyy-mm') <= '" . date("Y-m") . "'"
                    . " and  (demandeavance.paye = false or demandeavance.paye is NULL)"


            ;

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }

        die("Erreur");
    }

//save demande avance
    public function executeSaveDemande(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $ids = $params['ids'];
            $typeavance = $params['typeavance'];
            $montanttotal = $params['montanttotal'];
            $montantensielle = $params['montantensielle'];
            $annee = $params['annee'];
            $mois = $params['mois'];

            $datedebut = $params['datedebut'];
            $datefin = $params['datefin'];

            $ids = explode(',,', $ids);
            $message = '<ul style="height:300px;overflow-y:auto;margin-top:20px;">';
            for ($i = 0; $i < sizeof($ids); $i++) {
                if ($ids[$i] != '') {
                    $demande = DemandeavanceTable::getInstance()->findByIdAgentsAndIdTypeavanceAndAnnee($ids[$i], $typeavance, $annee);
                    if ($demande->count() != 0) {
                        //rien à faire
                        $message = $message . '<li>' . $demande->getFirst()->getAgents() . '</li>';
                    } else {
                        $demandeavance = new Demandeavance();
                        $demandeavance->setIdAgents($ids[$i]);
                        if ($typeavance)
                            $demandeavance->setIdTypeavance($typeavance);
                        if ($montanttotal)
                            $demandeavance->setMontanttotal($montanttotal);
                        if ($montantensielle)
                            $demandeavance->setMontantmensielle($montantensielle);
                        if ($annee)
                            $demandeavance->setAnnee($annee);
                        if ($mois)
                            $demandeavance->setMois($mois);

                        $demandeavance->setPaye("FALSE");
                        if ($datedebut)
                            $demandeavance->setDatedebutretenue($datedebut);
                        if ($datefin)
                            $demandeavance->setDatefinretenue($datefin);

                        $demandeavance->save();
                    }
                }
            }
            $message = $message . '</ul>';
            die($message);
        }
        die('Erreur');
    }

//impression liste des demande 
    public function executeImprimerListeDemandeavance(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $ids = $request->getParameter('ids');
        $typeavance = $request->getParameter('typeavance');
        $annee = $request->getParameter('annee');
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche de Demande d\'avance:');
        $pdf->SetSubject("document du liste de demandes des avances ");
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
        $pdf->SetMargins(5, 30, 5);
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
        $html = $this->ReadHtmlListeDemandeavance($ids, $typeavance, $annee);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Consultations' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeDemandeavance($ids, $typeavance, $annee) {
        $html = StyleCssHeader::header1();
        $demande = new Demandeavance();
        $html .= $demande->ReadHtmlListeDemandeAvance($ids, $typeavance, $annee);
        return $html;
    }

//affiche date fin 
    public function executeAffichedatefin(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $nbrmois = $params['nbrmois'];
            $date_debut = $params['datdebut'];
            $datedd = date('Y-m-d', strtotime($date_debut));
            $final = date("Y-m-d", strtotime($date_debut . "+" . $nbrmois . " month"));
            die($final);
        }
    }

//show demande (pour le modfication du document )
    public function executeShowdemande(sfWebRequest $request) {

        $this->demandeavance = Doctrine_Core::getTable('demandeavance')->findOneById($request->getParameter('id'));
        $this->form = $this->configuration->getForm($this->demandeavance);
    }

//edit demande d'avance
    public function executeEditDemande(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $id = $params['id'];
            $idagents = $params['id_agents'];
            $datefin = $params['datefin'];
            $datedebut = $params['datedebut'];
            $mois = $params['mois'];
            $annee = $params['annee'];
            $montantensielle = $params['montantensielle'];
            $montanttotal = $params['montanttotal'];
            $typeavance = $params['typeavance'];

            $demande = new Demandeavance();
//            $presnce->setIdAgents($idagents);
            if ($id != "") {
                $dem = Doctrine_Core::getTable('Demandeavance')->findOneById($id);
                if ($dem)
                    $demande = $dem;
            }
            if ($typeavance)
                $demande->setIdTypeavance($typeavance);
            if ($montanttotal)
                $demande->setMontanttotal($montanttotal);
            if ($montantensielle)
                $demande->setMontantmensielle($montantensielle);
            if ($annee)
                $demande->setAnnee($annee);
            if ($mois)
                $demande->setMois($mois);
            if ($datedebut)
                $demande->setDatedebutretenue($datedebut);
            if ($datefin)
                $demande->setDatefinretenue($datefin);
            $demande->save();
            die("ajout avec succes");
        }
        die('Erreur');
    }

//delete 
    public function executeDelete(sfWebRequest $request) {
        $iddoc = $request->getParameter('id');
        $this->forward404Unless($demandeavance = Doctrine_Core::getTable('demandeavance')->find(array($request->getParameter('id'))), sprintf('Object fiche does not exist (%s).', $request->getParameter('id')));
        $demandeavance->delete();
        $this->redirect('@demandeavance');
    }

//impression liste de retenue 
//    ChoisirMoisAnnee


    public function executeImprimerListeDemande(sfWebRequest $request) {

        $pdf = new sfTCPDF('L');

// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Des Demandes Avance');
        $pdf->SetSubject("Liste Des Demandes Avance");
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
        $html = $this->ReadHtmlListeDem($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste des demandes davances.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeDem(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $demande = new Demandeavance();
        $html .= $demande->ReadHtmlListeDemande($request);
        return $html;
    }

    public function executeImprimerListeRetenue(sfWebRequest $request) {

        $pdf = new sfTCPDF('L');

// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Des Retenues Avance');
        $pdf->SetSubject("Liste Des Retenues Avance");
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
        $html = $this->ReadHtmlListeRetenue($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Retenues davance.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeRetenue(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $demande = new Demandeavance();
        $html .= $demande->ReadHtmlListeRetenue($request);
        return $html;
    }

}
