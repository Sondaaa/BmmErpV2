<?php

require_once dirname(__FILE__) . '/../lib/contratouvrierGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/contratouvrierGeneratorHelper.class.php';

/**
 * contratouvrier actions.
 *
 * @package    Bmm
 * @subpackage contratouvrier
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contratouvrierActions extends autoContratouvrierActions {

//affichage date naissance ouvrier 

    public function executeAffichedetailDatenaissanceOuvrier(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_ouvrier = $params['id_ouvrier'];
            $ag = new Ouvrier();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT ouvrier.datenaissance as datenaissance"
                    . " FROM ouvrier"
                    . " WHERE ouvrier.id=" . $id_ouvrier
            ;

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

//affichage date retraite 
    public function executeAfficheageetdateretraiteOuvrier(sfWebRequest $request) {

        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $datenaissance = $params['datenaissance'];
            $dateemposte = $params['dateentretient'];
            $id_retraite = $params['id_retraite'];

            $age = floor((strtotime($dateemposte) - strtotime($datenaissance)) / 31556926);

            $retraite = Doctrine_Core::getTable('retraite')->findOneById($id_retraite);
            $anneeretraite = $retraite->getNbreanne();
            $diffans = $anneeretraite - $age;
//            print($dateemposte . " ** " . $diffans . " ** ");
            $end = date('Y-m-d', strtotime(date('Y-m-d', strtotime($dateemposte)) . ' + ' . $diffans . ' years'));

//             $end = date('Y-m-d', strtotime(date('Y-m-d', strtotime($dateemposte)) .' - ' .$age.' years'  .' - ' .$age.' years' ));
            die($end);
        }

        die("Erreur");
    }

//    public function executeAfficheageetdateretraiteOuvrier(sfWebRequest $request) {
//
//        header('Access-Control-Allow-Origin: *');
//        $params = array();
//        $content = $request->getContent();
//
//        if (!empty($content)) {
//            $params = json_decode($content, true);
//            $datenai = $params['datenaissance'];
//            $dateem = $params['dateemposte'];
//            $id_retraite = $params['id_retraite'];
//
//            $age = floor((strtotime($dateem) - strtotime($datenai)) / 31556926);
//
//            $retraite = Doctrine_Core::getTable('retraite')->findOneById($id_retraite);
//            $anneeretraite = $retraite->getNbreanne();
//            $diffans = $anneeretraite - $age;
//            $diffans = $anneeretraite - $age;
//            $end = date('Y-m-d', strtotime(date('Y-m-d', strtotime($dateem)) . '+' . $diffans . ' years'));
//            die($end);
//            
//            
////            $end = date('Y-m-d', strtotime(date('Y-m-d', strtotime($dateemposte)) . strtotime('+' . $diffans . ' years')));
////            print($dateemposte . " ** " . $diffans . " ** ");
////            $end = date('Y-m-d', strtotime('+5 years'));
//
//           
////            $date = strtotime($dateemposte);
//////             $new_date = strtotime('+ 25 year',$date);
////            $new_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($dateemposte)) . '+ '.  intval($diffans).' years'));
////            print ( strtotime($dateemposte).'+ '.'years');
//////            $new_date = strtotime('+'.$diffans.' years',$date);
////            $end= date('d/m/Y', strtotime($new_date));
////            die($end);
//            
////            $date = "2013-09-11"; //existing date
////echo date('Y-m-d', strtotime($date .'+3 years'));
//        }
//
//        die("Erreur");
//    }
//affichage nbre jour
    public function executeAffichenbrejour(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $datefin = $params['datefincontrat'];
            $datedebut = $params['datedebutcontrat'];
//            $_nbr = floor((strtotime($datefin) - strtotime($datedebut)) / 31556926);
//            die($_nbr);
            $datefin = $params['datefincontrat'];
            $datedebut = $params['datedebutcontrat'];

            $date1 = strtotime($datefin);
            $date2 = strtotime($datedebut);

            $diff = abs($date1 - $date2); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative
            $retour = array();

            $tmp = $diff;
            $retour['second'] = $tmp % 60;

            $tmp = floor(($tmp - $retour['second']) / 60);
            $retour['minute'] = $tmp % 60;

            $tmp = floor(($tmp - $retour['minute']) / 60);
            $retour['hour'] = $tmp % 24;

            $tmp = floor(($tmp - $retour['hour']) / 24);
            $retour['day'] = $tmp % 24;

//            $tmp = floor(($tmp - $retour['day']) / 28);
//            $retour['mois'] = $tmp;
            die($tmp);
        }

        die("Erreur");
    }

    //affiche detail ouvrier
    public function executeAfficheDetailOuvrier(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idagents = $params['id'];
            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT ouvrier.id,CONCAT( ouvrier.nom,' ' ,ouvrier.prenom)as nomcomplet , ouvrier.matricule as idrh "
                    . " FROM ouvrier,contratouvrier"
                    . " WHERE ouvrier.id=" . $idagents . " Limit 1";

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    //Liste ouvrier 

    public function executeListeOuvrier(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $q = Doctrine_Query::create()
                ->select("ouvrier.id as qtemax, ouvrier.nom as name,ouvrier.prenom as prenom,ouvrier.matricule as ref ")
                ->from('ouvrier');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $ouv = strtoupper($params['ouv']);
            $ref = strtoupper($params['ref']);
            if ($ouv != "")
                $q = $q->where("upper(nom) like '%" . $ouv . "%' or upper(matricule) like '%" . $ouv . "%' or upper(prenom) like '%" . $agent . "%'");

            if ($ref != "")
                $q = $q->Where("upper(matricule) like '%" . $ref . "%'");
        }
        $q = $q->orderBy('id desc')->limit('100');

        $listeouvrier = $q->fetchArray();
        die(json_encode($listeouvrier));
    }

    //affiche detail nom prenom matricule rib
    public function executeAffichedetail(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idagent = $params['idag'];
            $ag = new Ouvrier();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT ouvrier.matricule as matricule ,ouvrier.prenom as prenom ,ouvrier.rib as rib,ouvrier.nom as nom"
                    . " FROM ouvrier"
                    . " WHERE ouvrier.id=" . $idagent;

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

//affiche detail montant 
    public function executeAffichedetailmontant(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idsituation = $params['idsit'];
            $ag = new Situationadminouvrier();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT situationadminouvrier.montant as montant "
                    . " FROM situationadminouvrier"
                    . " WHERE situationadminouvrier.id=" . $idsituation;

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

//affiche montat * nbr jour 

    public function executeAffichemontant(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $mo = $params['mon'];
            $ag = new Contratouvrier();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT (contratouvrier.montant * contratouvrier.nbjour) as montantfoisnbrjour "
                    . " FROM contratouvrier"
                    . " WHERE contratouvrier.montant=" . $mo;

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    //save contrat ouvrier 
    public function executeSavedocumentContratOuvrier(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agents = $params['id_agents'];
            $daterecrutement = $params['daterecrutement'];
            $datedebut = $params['datedebut'];
            $datefin = $params['datefin'];
            $id_specialite = $params['id_specialite'];
            $idchantier = $params['id_chantier'];
            $idlieu = $params['id_lieu'];
            $idsituation = $params['id_situation'];
            $montant = $params['montant'];
            $idprojet = $params['id_projet'];
            $nbrj = $params['nbrj'];
            $id_retraite = $params['id_retraite'];
            $dateretraite = $params['dateretraite'];
            $montanttotal = $params['mon5'];
            $id = $params['id'];
            $contrat = new Contratouvrier();
            if ($id != "") {
                $contra = Doctrine_Core::getTable('contratouvrier')->findOneById($id);
                if ($contra)
                    $contrat = $contra;
            }
            if ($id_specialite != "")
                $contrat->setIdSpecialteouvrier($id_specialite);
            if ($datefin != "")
                $contrat->setDatefincontrat($datefin);
            if ($datedebut != "")
                $contrat->setDatedebutcontrat($datedebut);
            if ($daterecrutement != "")
                $contrat->setDaterecrutement($daterecrutement);
            if ($idprojet != "")
                $contrat->setIdProjet($idprojet);
            if ($montant != "")
                $contrat->setMontant($montant);
            if ($id_agents != "")
                $contrat->setIdOuvrier($id_agents);
            if ($idsituation != "")
                $contrat->setIdSituationadmini($idsituation);
            if ($idlieu != "")
                $contrat->setIdLieuaffetation($idlieu);
            if ($idchantier != "")
                $contrat->setIdChantier($idchantier);
            if ($id_retraite != "")
                $contrat->setIdRetraite($id_retraite);
            if ($dateretraite != "")
                $contrat->setDateretraite($dateretraite);

            $contrat->save();

            $id = $contrat->getId();

            $historique_ancien = HistoriquecontratouvrierTable::getInstance()->findByIdContratouvrierAndDatedebutcontrat($id, $datedebut);
            if ($historique_ancien->count() == 0) {
                $historique = new Historiquecontratouvrier();
                if ($daterecrutement != "")
                    $historique->setDaterecrutement($daterecrutement);
                if ($datedebut != "")
                    $historique->setDatedebutcontrat($datedebut);
                if ($datefin != "")
                    $historique->setDatefoncontrat($datefin);
                if ($id_specialite != "")
                    $historique->setIdSpecialite($id_specialite);
                if ($idchantier != "")
                    $historique->setIdChantier($idchantier);
                if ($idlieu != "")
                    $historique->setIdLieu($idlieu);
                if ($montant != "")
                    $historique->setMontant($montant);
                if ($idsituation != "")
                    $historique->setIdSitutaion($idsituation);

                if ($nbrj != "")
                    $historique->setNbjour($nbrj);
                if ($montanttotal != "")
                    $historique->setMontanttotal($montanttotal);

                $historique->setIdContratouvrier($contrat->getId());
                $historique->save();
            }
            else {
                //rien a faire    
            }
            die($contrat->getId() . "");
        }
    }

//afichage historique 

    public function executeAfficheligneHistoriqueouvrier(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Contrat = $params['id'];

            $query = "select historiquecontratouvrier.id as id, historiquecontratouvrier.daterecrutement as datere , historiquecontratouvrier.datedebutcontrat as dated , historiquecontratouvrier.datefoncontrat as datef, historiquecontratouvrier.id_lieu as idlieu , lieuaffectationouvrier.libelle as lieu ,historiquecontratouvrier.montant as montant,historiquecontratouvrier.id_specialite as idsp, specialiteouvrier.libelle as specialite,historiquecontratouvrier.id_situtaion as  idsit ,situationadminouvrier.libelle as situation, historiquecontratouvrier.id_chantier as idchantier ,chantier.libelle as chantier "
                    . " from historiquecontratouvrier , lieuaffectationouvrier,specialiteouvrier,chantier,situationadminouvrier"
                    . " where historiquecontratouvrier.id_contratouvrier=" . $id_Contrat . ""
                    . " and historiquecontratouvrier.id_lieu=lieuaffectationouvrier.id "
                    . " and historiquecontratouvrier.id_situtaion= situationadminouvrier.id"
                    . " and historiquecontratouvrier.id_specialite=specialiteouvrier.id"
                    . " and historiquecontratouvrier.id_chantier=chantier.id";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listesH = $conn->fetchAssoc($query);
            die(json_encode($listesH));
        }
        die("bien");
    }

//delete contrat
    public function executeDelete(sfWebRequest $request) {
        $iddoc = $request->getParameter('id');
        //_________suppr. ligne doc historique

        Doctrine_Query::create()->delete('historiquecontratouvrier')
                ->where('id_contratouvrier=' . $iddoc)->execute();

        $this->forward404Unless($contratouvrier = Doctrine_Core::getTable('contratouvrier')->find(array($request->getParameter('id'))), sprintf('Object fiche does not exist (%s).', $request->getParameter('id')));

        $contratouvrier->delete();
        $this->redirect('@contratouvrier');
    }
    
    public function executeImprimerFiche(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Contrat Ouvrier');
        $pdf->SetSubject("Fiche Contrat Ouvrier");
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
        $pdf->Output('Fiche Contrat Ouvrier' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFiche($id) {
        $html = StyleCssHeader::header1();
        $contrat = new Contratouvrier();
        $html .= $contrat->ReadHtmlFiche($id);

        return $html;
    }
    
    public function executeImprimerFicheContrat(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Contrat Ouvrier');
        $pdf->SetSubject("Contrat Ouvrier");
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
        $html = $this->ReadHtmlFicheContrat($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Contrat Ouvrier' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFicheContrat($id) {
        $html = StyleCssHeader::header1();
        $contrat = new Contratouvrier();
        $html .= $contrat->ReadHtmlFicheContrat($id);

        return $html;
    }
    
    public function executeImprimerFicheHistorique(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Historique Contrat Ouvrier');
        $pdf->SetSubject("Historique Contrat Ouvrier");
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
        $html = $this->ReadHtmlFicheHistorique($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Historique Contrat Ouvrier' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFicheHistorique($id) {
        $html = StyleCssHeader::header1();
        $contrat = new Contratouvrier();
        $html .= $contrat->ReadHtmlFicheHistorique($id);

        return $html;
    }

}
