<?php

require_once dirname(__FILE__) . '/../lib/presenceGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/presenceGeneratorHelper.class.php';

/**
 * presence actions.
 *
 * @package    Bmm
 * @subpackage presence
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class presenceActions extends autoPresenceActions {

    public function executeAfficheDetailRegime(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $mois = $request->getParameter('mois');
        $annee = $request->getParameter('annee');

        $query = " select  grilleregimehoraire.jour as jour , "
                . " grilleregimehoraire.nbrheuret as  nbrheuret ,"
                . "grilleregimehoraire.jourrepos as jourrepos "
                . " from grilleregimehoraire , regimehoraire"
                . " where   grilleregimehoraire.id_regime= regimehoraire.id"
                . " and grilleregimehoraire.id_regime=" . $id
                . " and grilleregimehoraire.annee= " . $annee
        ;
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $listedocs = $conn->fetchAssoc($query);
        $this->listedocs = $listedocs;


        $query_jourferier = " select COALESCE(count(jourferier.date),0) as nbrjourferier , jourferier.date as jourf"
                . " from jourferier "
                . " where jourferier.date::TEXT Like '%" . $annee . '-' . $mois . "%'"
                . " Group By jourf"
        ;

        $Jourfe = $conn->fetchAssoc($query_jourferier);
        $this->listejourferie = $Jourfe;
        $this->mois = $mois;
        $this->annee = $annee;
    }

    public function executeAfficheNbrjourFerier(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $mois = $params['mois'];
            $annee = $params['annee'];
            $query = " select jourferier.date as date,COALESCE(count(jourferier.date),0) as nbrjourferier, "
                    . " jourferier.libelle as jourf, "
                    . "jourferier.paye as paye, "
                    . " jourferier.periodique as periodique"
                    . " from jourferier "
                    . " where jourferier.date::TEXT Like '%" . $annee . '-' . $mois . "%'"
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }

    public function executeChoisirmotif(sfWebRequest $request) {
        $this->id = $request->getParameter('id');
        $this->mois = $request->getParameter('mois');
        $this->annee = $request->getParameter('annee');
    }

    public function executeSaveEmploye(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $ids = $params['ids'];
            $mois = $params['mois'];
            $annee = $params['annee'];
            $id_regime = $params['id_regime'];
            $jour_motif = $params['jour_motif'];
            $heure_semaines = $params['heure_semaines'];
            $heure_jours = $params['heure_jours'];
            $heure_supp = $params['heure_supp'];
            $total_heure = $params['total_heure'];
            $total_sup = $params['total_sup'];
            $totno = $params['totno'];
            $totsupp = $params['totsupp'];
            $ids = explode(',,', $ids);
            $heure_semaines = explode(',,', $heure_semaines);
            $heure_jours = explode(',,', $heure_jours);
            $heure_supp = explode(',,', $heure_supp);
            $total_sup = explode(',,', $total_sup);
            $total_heure = explode(',,', $total_heure);
            $jour_motif = explode(',,', $jour_motif);

            for ($i = 0; $i < sizeof($ids); $i++) {

                if ($ids[$i] != '') {

                    $presence = PresenceTable::getInstance()->findByIdAgentsAndMois($ids[$i], $mois);
                    if ($presence->count() != 0) {
//rien à faire
                    } else {
                        $presnce = new Presence();
                        $presnce->setIdAgents($ids[$i]);
                        if ($mois)
                            $presnce->setMois($mois);
                        if ($totno)
                            $presnce->setNbrtotalnormal($totno);
//                        if ($annee)
//                            $presnce->setAnnee($annee);
                        if ($totsupp)
                            $presnce->setNbhsupp($totsupp);
                        $presnce->setTotalsemain1($total_heure[0]);
                        $presnce->setTotalsemain2($total_heure[1]);
                        $presnce->setTotalsemaine3($total_heure[2]);
                        $presnce->setTotalsemaine4($total_heure[3]);
                        $presnce->setTotalsemaine5($total_heure[4]);
                        $presnce->setTotalheuresupp1($total_sup[0]);
                        $presnce->setTotalheuresupp2($total_sup[1]);
                        $presnce->setTotalheuresupp3($total_sup[2]);
                        $presnce->setTotalheursupp4($total_sup[3]);
                        $presnce->setTotalheuresupp5($total_sup[4]);
                        if ($id_regime)
                            $presnce->setIdRegimehoraire($id_regime);
                        $presnce->save();
                        for ($j = 0; $j < sizeof($heure_jours); $j++) {
                            if ($heure_jours[$j] != '') {
                                $Grill = new Grillepresence();
                                $Grill->setIdPresnece($presnce->getId());
                                if ($jour_motif[$j] != '') {
                                    $Grill->setIdMotif($jour_motif[$j]);
                                }
                                if ($heure_semaines[$j] != '') {
                                    $Grill->setSemaine($heure_semaines[$j]);
                                } else
                                    $Grill->setSemaine('0');

                                $Grill->setJour($heure_jours[$j]);
                                if ($heure_semaines[$j] != '') {
                                    $Grill->setHeuresupp($heure_supp[$j]);
                                } else
                                    $Grill->setHeuresupp('0');
                                $Grill->save();
                            }
                        }
                        //pour le trigger s' a marche 
                        if ($annee)
                            $presnce->setAnnee($annee);
                        $presnce->save();
                    }
                }
            }
            die("ajout avec succes");
        }
        die('Erreur');
    }

//modidfication employee 

    public function executeEditEmploye(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $idagents = $params['id_agents'];
            ///    $id_regime = $params['id_regime'];
            $jour_motif = $params['jour_motif'];
            $heure_semaines = $params['heure_semaines'];
            $heure_jours = $params['heure_jours'];
            $heure_supp = $params['heure_supp'];
            $total_heure = $params['total_heure'];
            $total_sup = $params['total_sup'];
            $totno = $params['totno'];
            $totsupp = $params['totsupp'];
            $heure_semaines = explode(',,', $heure_semaines);
            $heure_jours = explode(',,', $heure_jours);
            $heure_supp = explode(',,', $heure_supp);
            $total_sup = explode(',,', $total_sup);
            $total_heure = explode(',,', $total_heure);
            $jour_motif = explode(',,', $jour_motif);

            $presnce = new Presence();
//            $presnce->setIdAgents($idagents);
            if ($id != "") {
                $pre = Doctrine_Core::getTable('presence')->findOneById($id);
                if ($pre)
                    $presnce = $pre;
            }
            if ($totno)
                $presnce->setNbrtotalnormal($totno);

            if ($totsupp)
                $presnce->setNbhsupp($totsupp);
//            if ($id_regime)
//                $presnce->setIdRegimehoraire($id_regime);

            $presnce->setTotalsemain1($total_heure[0]);
            $presnce->setTotalsemain2($total_heure[1]);
            $presnce->setTotalsemaine3($total_heure[2]);
            $presnce->setTotalsemaine4($total_heure[3]);
            $presnce->setTotalsemaine5($total_heure[4]);
            $presnce->setTotalheuresupp1($total_sup[0]);
            $presnce->setTotalheuresupp2($total_sup[1]);
            $presnce->setTotalheuresupp3($total_sup[2]);
            $presnce->setTotalheursupp4($total_sup[3]);
            $presnce->setTotalheuresupp5($total_sup[4]);
            $presnce->save();

            Doctrine_Query::create()->delete('grillepresence')
                    ->where('id_presnece =' . $id)->execute();

            for ($i = 0; $i < sizeof($heure_jours); $i++) {
                if ($heure_jours[$i] != '') {
                    $Grill = new Grillepresence();
                    $Grill->setIdPresnece($presnce->getId());

                    if ($jour_motif[$i] != '') {
                        $Grill->setIdMotif($jour_motif[$i]);
                    }
                    if ($heure_semaines[$i] != '') {
                        $Grill->setSemaine($heure_semaines[$i]);
                    } else
                        $Grill->setSemaine('0');
//                         print($heure_jours[$i] . '**');
                    $Grill->setJour($heure_jours[$i]);
                    if ($heure_semaines[$i] != '') {
                        $Grill->setHeuresupp($heure_supp[$i]);
                    } else
                        $Grill->setHeuresupp('0');
                    $Grill->save();
                }
            }

            die("ajout avec succes");
        }
        die('Erreur');
    }

    public function executeDelete(sfWebRequest $request) {
        $iddoc = $request->getParameter('id');
//_________suppr. ligne doc
        Doctrine_Query::create()->delete('grillepresence')
                ->where('id_presnece=' . $iddoc)->execute();

        $this->forward404Unless($presence = Doctrine_Core::getTable('presence')->find(array($request->getParameter('id'))), sprintf('Object fiche does not exist (%s).', $request->getParameter('id')));
        $presence->delete();
        $this->redirect('@presence');
    }

    public function executeShowedit(sfWebRequest $request) {

        $this->presence = Doctrine_Core::getTable('presence')->findOneById($request->getParameter('id'));
        $this->form = $this->configuration->getForm($this->presence);
    }

    public function executeShowpresence(sfWebRequest $request) {

        $this->presence = Doctrine_Core::getTable('presence')->findOneById($request->getParameter('id'));

        $this->form = $this->configuration->getForm($this->presence);
    }

    public function executeAfficheJourFerier(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $mois = $params['mois'];
            $annee = $params['annee'];
            $query = " select jourferier.date as date, "
                    . " jourferier.libelle as jourf, "
                    . "jourferier.paye as paye, "
                    . " jourferier.periodique as periodique"
                    . " from jourferier "
                    . " where jourferier.date::TEXT Like '%" . $annee . '-' . $mois . "%'"
//                    ." where jourferier.date::TEXT Like '%". $mois . "%' and jourferier.periodique = true"
//                    . " or jourferier.date::TEXT Like '" . $annee . '-' . $mois . "%' and jourferier.periodique = false"


            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }

//
    public function executeAfficheJourConge(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agent = $params['id_agent'];
            $mois = $params['mois'];
            $annee = $params['annee'];
            $query = " select conge.daterealise as datedebut, "
                    . " conge.datefinrealise as datefin, conge.id_type as idtype, typeconge.libelle as typeconge"
                    . " from conge, typeconge"
                    . " where conge.id_agents = " . $id_agent
                    . " and ((conge.daterealise::TEXT Like '%" . $annee . '-' . $mois . "%' ) or ( conge.datefinrealise::TEXT Like '" . $annee . '-' . $mois . "%') )"
                    . " and conge.id_type = typeconge.id "
                    . " and conge.id_type <> '6'"


            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }

    public function executeAfficheShowJourConge(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agent = $params['id_agent'];
            $mois = $params['mois'];
            $annee = $params['annee'];
            $query = " select conge.daterealise as datedebut, "
                    . " conge.datefinrealise as datefin, conge.id_type as idtype, typeconge.libelle as typeconge"
                    . " from conge, typeconge"
                    . " where conge.id_agents = " . $id_agent
                    . " and ((conge.daterealise::TEXT Like '%" . $annee . '-' . $mois . "%' ) or ( conge.datefinrealise::TEXT Like '" . $annee . '-' . $mois . "%') )"
                    . " and conge.id_type = typeconge.id "
                    . " and conge.id_type <> '6'"


            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }

    public function executeAfficheRegimehoraire(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agent = $params['id_agent'];

            $query = " select regimehoraire.libelle as regime, contrat.id_regime as id_regime"
                    . " from regimehoraire, contrat "
                    . " where contrat.id_regime = regimehoraire.id"
                    . " and contrat.id_agents = " . $id_agent
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }

//affiche liste agents par apport le regime horaire

    public function executeAfficheListeAgentsParRegime(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_regime = $params['id'];

            $query = " select agents.id as id, concat( agents.idrh, ' ', agents.nomcomplet, ' ', agents.prenom) as libelle"
                    . " from agents, regimehoraire, contrat "
                    . " where contrat.id_regime = regimehoraire.id"
                    . " and regimehoraire.id = " . $id_regime
                    . " and contrat.id_agents = agents.id"
                    . " group by agents.id"
                    . " order by agents.idrh"

            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }

    public function executeGetHeuresRegime(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $annee = $params['annee'];
            $query = " select grilleregimehoraire.jour as jour, "
                    . " grilleregimehoraire.nbrheuret as  nbrheuret, "
                    . " grilleregimehoraire.jourrepos as jourrepos "
                    . " from grilleregimehoraire , regimehoraire "
                    . " where grilleregimehoraire.id_regime= regimehoraire.id "
                    . " and grilleregimehoraire.id_regime=" . $id
                    . " and grilleregimehoraire.annee= " . $annee;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }

//affichage grille 

    public function executeAffichedetailGrille(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];

            $query = " select presence.totalsemain1 as totalsemain1, "
                    . " presence.totalsemain2 as totalsemain2, "
                    . " presence.totalsemaine3 as totalsemaine3, "
                    . " presence.totalsemaine4 as totalsemaine4, "
                    . " presence.totalsemaine5 as totalsemaine5, "
                    . " presence.totalheuresupp1 as totalheuresupp1, "
                    . " presence.totalheuresupp2 as totalheuresupp2, "
                    . " presence.totalheuresupp3 as totalheuresupp3, "
                    . " presence.totalheursupp4 as totalheursupp4, "
                    . " presence.totalheuresupp5 as totalheuresupp5, "
                    . " presence.nbhsupp as nbhsupp, "
                    . " presence.nbrtotalnormal as nbrtotalnormal, "
                    . "grillepresence.jour as jour, grillepresence.semaine as semaine"
                    . " from presence, grillepresence"
                    . " where grillepresence.id_presnece = presence.id"
                    . " and presence.id = " . $id
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }

//affichage total 

    public function executeAffichedetailSemaineGrille(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];

            $query = " select grillepresence.jour as jour, grillepresence.semaine as semaine"
                    . " from presence, grillepresence"
                    . " where grillepresence.id_presnece = presence.id"
                    . " and presence.id = " . $id
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }

    public function executeAffichegrille(sfWebRequest $request) {
        $mois = $request->getParameter('idpresence_mois');
        $annee = $request->getParameter('idpresence_annee');
        return $this->renderPartial("presence_grille", array("mois" => $mois, "annee" => $annee));
    }

    public function executeAffichegrilleedit(sfWebRequest $request) {
        $mois = $request->getParameter('idpresence_mois');
        $annee = $request->getParameter('idpresence_annee');
        $id = $request->getParameter('id');
        return $this->renderPartial("grille_edit", array("mois" => $mois, "annee" => $annee, "id" => $id));
    }

//impression 

    public function executeImprimerPresence(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Presence();
        $idd = $request->getParameter('iddoc');

        $documents = Doctrine_Core::getTable('presence')->findOneById($idd);
        $doc = $documents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche de Presence:');
        $pdf->SetSubject("document du liste de presence");
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
        $html = $this->ReadHtmlPresence($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Consultations' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPresence($idd, $documents) {
        $html = StyleCssHeader::header1();
        $html .= $documents->ReadHtmlPresence($idd);
        return $html;
    }

    public function executeImprimerListePresence(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $ids = $request->getParameter('ids');
        $mois = $request->getParameter('mois');
        $annee = $request->getParameter('annee');
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche de Presence:');
        $pdf->SetSubject("document du liste de presence");
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
        $html = $this->ReadHtmlListePresence($ids, $mois, $annee);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Consultations' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListePresence($ids, $mois, $annee) {
        $html = StyleCssHeader::header1();
        $documents = new Presence();
        $html .= $documents->ReadHtmlListePresence($ids, $mois, $annee);
        return $html;
    }

//impression liste presence des agents 
    public function executeImprimerListeAgents(sfWebRequest $request) { 
        $pdf = new sfTCPDF('L');
// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Liste De Presence Agents');
        $pdf->SetSubject("Liste De Presence Agents");
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
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 13);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlListeAgents($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste De Presence Agents.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeAgents(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $presence = new Presence();
        $html .= $presence->ReadHtmAlllListePresenceAgents($request);
        
        return $html;
    }

}
