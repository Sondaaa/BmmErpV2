<?php

require_once dirname(__FILE__) . '/../lib/congeGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/congeGeneratorHelper.class.php';

/**
 * conge actions.
 *
 * @package    Bmm
 * @subpackage conge
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class congeActions extends autoCongeActions {//affichage detail agents 

    public function executeStatistiqueParAgent(sfWebRequest $request) {
        
    }

    public function executeStatistiquePresenceParAgent(sfWebRequest $request) {
        
    }

    public function executeStatistiqueAbsenceAgent(sfWebRequest $request) {
        
    }

    public function executeStatistiquePrsenceAgent(sfWebRequest $request) {
        
    }

    public function executeStatistiqueAgentPartype(sfWebRequest $request) {
        
    }

    public function executeStatistiquePreParAgent(sfWebRequest $request) {
        
    }

    public function executeGetChart(sfWebRequest $request) {
        $this->conges = CongeTable::getInstance()->findByIdAgentsAndAnnee($id = $request->getParameter('id'), $annee = $request->getParameter('annee'));
    }

    public function executeGetChartType(sfWebRequest $request) {
        $this->congesPartype = CongeTable::getInstance()->findByIdType($id = $request->getParameter('id'));
    }

    public function executeGetPresence(sfWebRequest $request) {
        if ($request->getParameter('mois') != 0) {
            $presence = PresenceTable::getInstance()->getByIdAgentsAndMoisAndAnnee($request->getParameter('id'), $request->getParameter('mois'), $request->getParameter('annee'));
            $id_presence = $presence->getId();
            $this->presences = GrillepresenceTable::getInstance()->findByIdPresnece($id_presence);
        } else {

            $query_presence = " select  COALESCE(count(grillepresence.semaine),0) as nbpresence "
                    . ",trim(presence.mois) as mois"
                    . " ,presence.id as id "
                    . " from grillepresence,presence "
                    . " where presence.annee= '" . trim($request->getParameter('annee')) . "'"
                    . " and ((grillepresence.id_motif IS NULL) or ( grillepresence.semaine <> '0'))"
                    . " and grillepresence.id_presnece=presence.id"
                    . " and presence.id_agents=" . $request->getParameter('id')
                    . " Group By presence.id"
                    . " ORDER BY mois";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $presences = $conn->fetchAssoc($query_presence);

            $this->presences = array();
            for ($i = 0; $i < 12; $i++) {
                $this->presences[$i]['mois'] = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
                $value = '';
                for ($j = 0; $j < sizeof($presences); $j++) {
                    if (str_pad($i + 1, 2, '0', STR_PAD_LEFT) == $presences[$j]['mois'])
                        $value = $presences[$j]['nbpresence'];
                }
                if ($value != '') {
                    $this->presences[$i]['nbpresence'] = $value;
                } else {
                    $this->presences[$i]['nbpresence'] = 0;
                }
            }

            $query_absence = " select COALESCE(count(grillepresence.id_motif),0) as nbrjabsence "
                    . ",presence.id as id,trim(presence.mois) as mois "
                    . " from grillepresence,presence "
                    . " where presence.annee= '" . trim($request->getParameter('annee')) . "'"
                    . " and grillepresence.id_presnece=presence.id"
                    . " and  ((grillepresence.id_motif IS NOT NULL) or( grillepresence.semaine = '0')) "
                    . " and presence.id_agents=" . $request->getParameter('id')
                    . " Group By presence.id"
                    . " ORDER BY mois";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $absence = $conn->fetchAssoc($query_absence);

            $this->absence = array();
            for ($i = 0; $i < 12; $i++) {
                $this->absence[$i]['mois'] = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
                $value = '';
                for ($j = 0; $j < sizeof($absence); $j++) {
                    if (str_pad($i + 1, 2, '0', STR_PAD_LEFT) == $absence[$j]['mois'])
                        $value = $absence[$j]['nbrjabsence'];
                }
                if ($value != '') {
                    $this->absence[$i]['nbrjabsence'] = $value;
                } else {
                    $this->absence[$i]['nbrjabsence'] = 0;
                }
            }
        }
        $this->id = $request->getParameter('id');
        $this->mois = $request->getParameter('mois');
        $this->annee = $request->getParameter('annee');
    }

    public function executeGetAbsence(sfWebRequest $request) {
        $query_presence = " select COALESCE(count(grillepresence.semaine),0) as nbpresence "
                . " from grillepresence,presence "
                . " where presence.annee= '" . $request->getParameter('annee') . "'"
                . " and ((grillepresence.id_motif IS NULL) or( grillepresence.semaine <> '0')) "
                . " and grillepresence.id_presnece=presence.id"
                . " and presence.id_agents=" . $request->getParameter('id');
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $this->presences = $conn->fetchAssoc($query_presence);

        $query_absence = "select COALESCE( count(grillepresence.id_motif),0) as nbrjabsence "
                . " from grillepresence,presence"
                . " where presence.annee= '" . $request->getParameter('annee') . "'"
                . " and grillepresence.id_presnece=presence.id"
                . " and ((grillepresence.id_motif IS NOT NULL)and(grillepresence.id_motif <> '3' )) "
                . " and presence.id_agents=" . $request->getParameter('id');
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $this->absences = $conn->fetchAssoc($query_absence);

        $query_conge = "select COALESCE( SUM (CAST(coalesce(conge.nbrcongeralise) AS integer)),0) as conge"
                . " from conge"
                . " where conge.annee='" . $request->getParameter('annee') . "'"
                . " and conge.id_agents=" . $request->getParameter('id');
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $this->conges = $conn->fetchAssoc($query_conge);
        $this->id = $request->getParameter('id');
        $this->annee = $request->getParameter('annee');
    }

    public function executeAffichedetail(sfWebRequest $request) {
        $this->id = $request->getParameter('id');
        $this->mois = $request->getParameter('mois');
        $this->annee = $request->getParameter('annee');
    }

    public function executeGetChartPresence(sfWebRequest $request) {
        if ($request->getParameter('id') != "" && $request->getParameter('annee') != "" && $request->getParameter('mois')) {
            $this->presences = PresenceTable::getInstance()->findByIdAgentsAndAnneeAndMois($id = $request->getParameter('id'), $annee = $request->getParameter('annee'), $mois = $request->getParameter('mois'));
        } else {
            $this->presences = PresenceTable::getInstance()->findByIdAgentsAndAnnee($id = $request->getParameter('id'), $annee = $request->getParameter('annee'));
        }
        $this->id = $request->getParameter('id');
        $this->annee = $request->getParameter('annee');
        $this->mois = $request->getParameter('mois');
    }

    public function executeGetPres(sfWebRequest $request) {
        $this->presences = PresenceTable::getInstance()->findByIdAgents($id = $request->getParameter('idpresence'));
//        $this->id = $request->getParameter('id');
    }

    public function executeFiltrerAgents(sfWebRequest $request) {
        $idAg = $request->getParameter('idAg');
        $idtype = $request->getParameter('idtype');
        $annee = $request->getParameter('annee');

        return $this->renderPartial("liste_filtre", array("idAg" => $idAg, "idtype" => $idtype, "annee" => $annee));
    }

    public function executeAfficheSuiviListeParAnnee(sfWebRequest $request) {

        $annee = $request->getParameter('anneconge');
        $typeconge = $request->getParameter('typeconge');
        $query = " select  conge.annee as annee ,typeconge.libelle as type ,"
                . " SUM( CAST(coalesce(conge.nbrcongeralise) AS integer)) as nbrcongeralise"
                . ", conge.id_agents as idag ,Concat( agents.nomcomplet,'  ',agents.prenom) as nom"
                . " ,agents.idrh as idrh , conge.nbrjourrealise as nbrjourrealise ,"
                . " conge.nbrrestantannepr as nbrrestantannepr, conge.nbjcongeannuelle as nbjcongeannuelle"
                . ", conge.nbrcongerestant as nbrcongerestant"
                . " from conge,agents ,typeconge"
                . " where conge.id_agents=agents.id "
                . " and conge.valide=true "
                . " and conge.id_type=typeconge.id";
        if ($typeconge != '') {
            $query.= " and conge.id_type=" . $typeconge;
        }
        if ($annee != '')
            $query.= " and  CAST(coalesce(conge.annee) AS integer)=" . $annee;
        $query.= " GROUP BY conge.id,conge.annee,typeconge.libelle,conge.id_agents, agents.nomcomplet,agents.prenom"
                . " ,agents.idrh,conge.nbrjourrealise,conge.nbrrestantannepr,conge.nbjcongeannuelle,conge.nbrcongerestant  ";
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $liste = $conn->fetchAssoc($query);
        return $this->renderPartial("liste_suivi", array("liste" => $liste, "iddoc" => $iddoc));
    }

    //par type 



    public function executeAffichedetailAgents(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idagent = $params['idag'];
            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//            $query = "SELECT agents.idrh as idrh ,agents.nomcomplet as nom ,agents.prenom as prenom,"
//                    . " contrat.id_agents as idag,contrat.id as idcontrat"
//                    . " , contrat.id_posterh as idposte , posterh.id as idp"
//                    . " ,posterh.libelle as poste ,contrat.id_grade as idgrade , grade.libelle as grade"
//                    . " FROM agents , contrat , posterh ,grade"
//                    . " WHERE  contrat.id_agents = agents.id"
//                    . " and contrat.id_posterh=posterh.id"
//                    . " and contrat.id_grade=grade.id"
//                    . " and agents.id=" . $idagent
//                    . "Limit 1";
            $query_agents = "SELECT agents.idrh as idrh ,concat(agents.nomcomplet, ' '  ,agents.prenom )as nom "
                    . " FROM agents "
                    . " where agents.id=" . $idagent;
            $resultat_agents = $conn->fetchAssoc($query_agents);

            $query_contrat = "SELECT contrat.id as idcontrat"
                    . " , contrat.id_posterh as idposte , posterh.id as idp"
                    . " ,posterh.libelle as poste , salairedebase.id_grade as idgrade ,grade.libelle as grade"
                    . " FROM agents,contrat ,posterh , grade,salairedebase"
                    . " where  contrat.id_posterh=posterh.id"
                    . " and contrat.id_agents = agents.id "
                    . " and contrat.id_salairedebase=salairedebase.id "
                    . " and salairedebase.id_grade=grade.id"
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

//afficahage detail type conge 
    public function executeAffichedetailTypeConge(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_type = $params['id_type'];
            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT typeconge.nbrjour as nbrjour ,typeconge.modalitecalcul as modalitecalcul"
                    . " ,typeconge.paye as paye"
                    . " FROM typeconge "
                    . " where typeconge.id=" . $id_type
                    . "Limit 1";


            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

//affichage nbr jour du conge
    public function executeAffichenbrejour(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $datefin = $params['datefin'];
            $datedebut = $params['datedebut'];
            $typeconge = $params['typeconge'];

            $date_fin = date('Y-m-d', strtotime($datefin));
            $date_debut = date('Y-m-d', strtotime($datedebut));

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
            $tmp = floor(($tmp - $retour['hour']) / 24) + 1;
            $retour['day'] = $tmp;
            //si conge accouchement 
            if ($typeconge == 5 || $typeconge == 6 || $typeconge == 4 || $typeconge == 2 || $typeconge == 7) {
                $tmp = $tmp;
            } else {
                // tester si jour ferier inclu  --------parcourir les date between date debut et date fin 
                $query = " select  jourferier.date as date"
                        . " from jourferier "
                        . " where  jourferier.date >= '" . $date_debut . "'"
                        . " and jourferier.date < '" . $date_fin . "'";
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $listedocs = $conn->fetchAssoc($query);

                $nbjourf = sizeof($listedocs);

                for ($i = strtotime($date_debut); $i <= strtotime($date_fin); $i = strtotime('+1 day', $i)) {
                    if (date('N', $i) == 7) {
//                    echo date('l Y-m-d', $i);
                        $test = false;

                        for ($j = 0; $j < sizeof($listedocs); $j++) {
                            if ($listedocs[$j]['date'] == date('Y-m-d', $i)) {
                                $test = true;
                            }
                        }
                        if ($test == false) {
                            $listedocs[sizeof($listedocs)]['date'] = date('Y-m-d', $i);
                        }
                    }
                }
                $tmp = $tmp - sizeof($listedocs);
//          
            }
            die($tmp);
        }

        die("Erreur");
    }

//nbr jour conge accouchement 

    public function executeAffichenbrejourRealisetype5(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $datefin = $params['datefin'];
            $datedebut = $params['datedebut'];
            $typeconge = $params['typeconge'];

            $date_fin = date('Y-m-d', strtotime($datefin));
            $date_debut = date('Y-m-d', strtotime($datedebut));

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
            $tmp = floor(($tmp - $retour['hour']) / 24) + 1;
            $retour['day'] = $tmp;
            //si conge accouchement 
//            if ($typeconge == 5 || $typeconge == 6) {
            $tmp = $tmp;

            die($tmp);
        }

        die("Erreur");
    }

//affichage nbr jour du conge valide 

    public function executeAffichenbrejourValide(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $datefin = $params['datefin'];
            $datedebut = $params['datedebut'];
            $typeconge = $params['typeconge'];
            $date_fin = date('Y-m-d', strtotime($datefin));
            $date_debut = date('Y-m-d', strtotime($datedebut));
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

            $tmp = floor(($tmp - $retour['hour']) / 24) + 1;
            $retour['day'] = $tmp % 24;
            if ($typeconge == 5 || $typeconge == 6 || $typeconge == 4 || $typeconge == 2 || $typeconge == 7) {
                $tmp = $tmp;
            } else {
                // tester si jour ferier inclu  --------parcourir les date between date debut et date fin 
                $query = " select  jourferier.date as date"
                        . " from jourferier "
                        . " where  jourferier.date >= '" . $date_debut . "'"
                        . " and jourferier.date < '" . $date_fin . "'";
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $listedocs = $conn->fetchAssoc($query);

                $nbjourf = sizeof($listedocs);
                for ($i = strtotime($date_debut); $i <= strtotime($date_fin); $i = strtotime('+1 day', $i)) {
                    if (date('N', $i) == 7) {
//                    echo date('l Y-m-d', $i);
                        $test = false;

                        for ($j = 0; $j < sizeof($listedocs); $j++) {
                            if ($listedocs[$j]['date'] == date('Y-m-d', $i)) {
                                $test = true;
                            }
                        }
                        if ($test == false) {
                            $listedocs[sizeof($listedocs)]['date'] = date('Y-m-d', $i);
                        }
                    }
                }
                $tmp = $tmp - sizeof($listedocs);
            }
            die($tmp);
        }
        die("Erreur");
    }

//affichage nbr jour realise 

    public function executeAffichenbrejourRealise(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $datefin = $params['datefin'];
            $datedebut = $params['datedebut'];
            $typeconge = $params['typeconge'];
            $date_fin = date('Y-m-d', strtotime($datefin));
            $date_debut = date('Y-m-d', strtotime($datedebut));
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
            $tmp = floor(($tmp - $retour['hour']) / 24) + 1;
            $retour['day'] = ($tmp % 24);
            if ($typeconge == 5 || $typeconge == 6 || $typeconge == 4 || $typeconge == 2 || $typeconge == 7) {
                $tmp = $tmp;
            } else {
                // tester si jour ferier inclu  --------parcourir les date between date debut et date fin 
                $query = " select  jourferier.date as date"
                        . " from jourferier "
                        . " where  jourferier.date >= '" . $date_debut . "'"
                        . " and jourferier.date < '" . $date_fin . "'";
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $listedocs = $conn->fetchAssoc($query);

                $nbjourf = sizeof($listedocs);
                for ($i = strtotime($date_debut); $i <= strtotime($date_fin); $i = strtotime('+1 day', $i)) {
                    if (date('N', $i) == 7) {
//                    echo date('l Y-m-d', $i);
                        $test = false;

                        for ($j = 0; $j < sizeof($listedocs); $j++) {
                            if ($listedocs[$j]['date'] == date('Y-m-d', $i)) {
                                $test = true;
                            }
                        }
                        if ($test == false) {
                            $listedocs[sizeof($listedocs)]['date'] = date('Y-m-d', $i);
                        }
                    }
                }
                $tmp = $tmp - sizeof($listedocs);
            }
            die($tmp);
        }

        die("Erreur");
    }

//affichage nbr jour realise type 2 

    public function executeAffichenbrejourRealisetype2(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $datefin = $params['datefin'];
            $datedebut = $params['datedebut'];
            $typeconge = $params['typeconge'];
            $date_fin = date('Y-m-d', strtotime($datefin));
            $date_debut = date('Y-m-d', strtotime($datedebut));
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
            $tmp = floor(($tmp - $retour['hour']) / 24) + 1;
            $retour['day'] = ($tmp % 24);

            // tester si jour ferier inclu  --------parcourir les date between date debut et date fin 
//            if ($typeconge == 5 || $typeconge == 6 || $typeconge == 4 || $typeconge == 2 || $typeconge == 7) {
            $tmp = $tmp;
//            } else {
//                $query = " select  jourferier.date as date"
//                        . " from jourferier "
//                        . " where  jourferier.date >= '" . $date_debut . "'"
//                        . " and jourferier.date < '" . $date_fin . "'";
//                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//                $listedocs = $conn->fetchAssoc($query);
//
//                $nbjourf = sizeof($listedocs);
//                for ($i = strtotime($date_debut); $i <= strtotime($date_fin); $i = strtotime('+1 day', $i)) {
//                    if (date('N', $i) == 7) {
////                    echo date('l Y-m-d', $i);
//                        $test = false;
//
//                        for ($j = 0; $j < sizeof($listedocs); $j++) {
//                            if ($listedocs[$j]['date'] == date('Y-m-d', $i)) {
//                                $test = true;
//                            }
//                        }
//                        if ($test == false) {
//                            $listedocs[sizeof($listedocs)]['date'] = date('Y-m-d', $i);
//                        }
//                    }
//                }
//                $tmp = $tmp - sizeof($listedocs);
//            }
            die($tmp);
        }
        die("Erreur");
    }

//affichage nbr jour realise type 3

    public function executeAffichenbrejourRealisetype3(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $datefin = $params['datefin'];
            $datedebut = $params['datedebut'];
            $typeconge = $params['typeconge'];
            $date_fin = date('Y-m-d', strtotime($datefin));
            $date_debut = date('Y-m-d', strtotime($datedebut));
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
            $tmp = floor(($tmp - $retour['hour']) / 24) + 1;
            $retour['day'] = ($tmp % 24);
            // tester si jour ferier inclu  --------parcourir les date between date debut et date fin 
//            if ($typeconge == 5 || $typeconge == 6 || $typeconge == 4 || $typeconge == 2 || $typeconge == 7) {
//                $tmp = $tmp ;
//            } else {
            $query = " select  jourferier.date as date"
                    . " from jourferier "
                    . " where  jourferier.date >= '" . $date_debut . "'"
                    . " and jourferier.date < '" . $date_fin . "'";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);

            $nbjourf = sizeof($listedocs);
            for ($i = strtotime($date_debut); $i <= strtotime($date_fin); $i = strtotime('+1 day', $i)) {
                if (date('N', $i) == 7) {
//                    echo date('l Y-m-d', $i);
                    $test = false;

                    for ($j = 0; $j < sizeof($listedocs); $j++) {
                        if ($listedocs[$j]['date'] == date('Y-m-d', $i)) {
                            $test = true;
                        }
                    }
                    if ($test == false) {
                        $listedocs[sizeof($listedocs)]['date'] = date('Y-m-d', $i);
                    }
                }
            }
            $tmp = $tmp - sizeof($listedocs);
//            }
            die($tmp);
        }
        die("Erreur");
    }

//affichage par jour realise type6 

    public function executeAffichenbrejourRealisetype6(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $datefin = $params['datefin'];
            $datedebut = $params['datedebut'];
            $typeconge = $params['typeconge'];
            $date_fin = date('Y-m-d', strtotime($datefin));
            $date_debut = date('Y-m-d', strtotime($datedebut));
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
            $tmp = floor(($tmp - $retour['hour']) / 24) + 1;
            $retour['day'] = ($tmp % 24);
//            if ($typeconge == 5 || $typeconge == 6) {
            $tmp = $tmp - 1;

            die($tmp);
        }
        die("Erreur");
    }

//jou d'extension

    public function executeAffichenbrejourExtension(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $datefin = $params['datefin'];
            $datedebut = $params['datedebut'];
//            $typeconge = $params['typeconge'];
            $date_fin = date('Y-m-d', strtotime($datefin));
            $date_debut = date('Y-m-d', strtotime($datedebut));
            $date1 = strtotime($datefin);
            $date2 = strtotime($datedebut);
            $diff = abs($date1 - $date2);

// abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative

            $array = array("lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche");
            $retour = array();
            $tmp = $diff;
            $retour['second'] = $tmp % 60;

            $tmp = floor(($tmp - $retour['second']) / 60);
            $retour['minute'] = $tmp % 60;

            $tmp = floor(($tmp - $retour['minute']) / 60);
            $retour['hour'] = $tmp % 24;
            $tmp = floor(($tmp - $retour['hour']) / 24) + 1;
            $retour['day'] = $tmp % 24;
//            if ($typeconge == 5) {
//                $tmp = $tmp - 1;
//            } else {
            // tester si jour ferier inclu  --------parcourir les date between date debut et date fin 
            $query = " select  jourferier.date as date"
                    . " from jourferier "
                    . " where  jourferier.date >= '" . $date_debut . "'"
                    . " and jourferier.date < '" . $date_fin . "'";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            $nbjourf = sizeof($listedocs);
            for ($i = strtotime($date_debut); $i <= strtotime($date_fin); $i = strtotime('+1 day', $i)) {
                if (date('N', $i) == 7) {
//                    echo date('l Y-m-d', $i);
                    $test = false;
                    for ($j = 0; $j < sizeof($listedocs); $j++) {
                        if ($listedocs[$j]['date'] == date('Y-m-d', $i)) {
                            $test = true;
                        }
                    }
                    if ($test == false) {
                        $listedocs[sizeof($listedocs)]['date'] = date('Y-m-d', $i);
                    }
                }
            }
            $tmp = $tmp - sizeof($listedocs);
//            }
//             $tmp = $tmp ;
            die($tmp);
        }

        die("Erreur");
    }

//jour d'extention 2 

    public function executeAffichenbrejourExtension2(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $datefin = $params['datefin'];
            $datedebut = $params['datedebut'];
//            $typeconge = $params['typeconge'];
            $date_fin = date('Y-m-d', strtotime($datefin));
            $date_debut = date('Y-m-d', strtotime($datedebut));
            $date1 = strtotime($datefin);
            $date2 = strtotime($datedebut);
            $diff = abs($date1 - $date2);

// abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative

            $array = array("lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche");
            $retour = array();
            $tmp = $diff;
            $retour['second'] = $tmp % 60;

            $tmp = floor(($tmp - $retour['second']) / 60);
            $retour['minute'] = $tmp % 60;

            $tmp = floor(($tmp - $retour['minute']) / 60);
            $retour['hour'] = $tmp % 24;
            $tmp = floor(($tmp - $retour['hour']) / 24) + 1;
            $retour['day'] = $tmp % 24;

            // tester si jour ferier inclu  --------parcourir les date between date debut et date fin 
//            $query = " select  jourferier.date as date"
//                    . " from jourferier "
//                    . " where  jourferier.date >= '" . $date_debut . "'"
//                    . " and jourferier.date < '" . $date_fin . "'";
//            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//            $listedocs = $conn->fetchAssoc($query);
//
//            $nbjourf = sizeof($listedocs);
//            for ($i = strtotime($date_debut); $i <= strtotime($date_fin); $i = strtotime('+1 day', $i)) {
//                if (date('N', $i) == 7) {
////                    echo date('l Y-m-d', $i);
//                    $test = false;
//
//                    for ($j = 0; $j < sizeof($listedocs); $j++) {
//                        if ($listedocs[$j]['date'] == date('Y-m-d', $i)) {
//                            $test = true;
//                        }
//                    }
//                    if ($test == false) {
//                        $listedocs[sizeof($listedocs)]['date'] = date('Y-m-d', $i);
//                    }
//                }
//            }
//            $tmp = $tmp - sizeof($listedocs);
//            }
            $tmp = $tmp;
            die($tmp);
        }

        die("Erreur");
    }

//jour d'extension 3

    public function executeAffichenbrejourExtension3(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $datefin = $params['datefin'];
            $datedebut = $params['datedebut'];
//            $typeconge = $params['typeconge'];
            $date_fin = date('Y-m-d', strtotime($datefin));
            $date_debut = date('Y-m-d', strtotime($datedebut));
            $date1 = strtotime($datefin);
            $date2 = strtotime($datedebut);
            $diff = abs($date1 - $date2);

// abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative

            $array = array("lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche");
            $retour = array();
            $tmp = $diff;
            $retour['second'] = $tmp % 60;

            $tmp = floor(($tmp - $retour['second']) / 60);
            $retour['minute'] = $tmp % 60;

            $tmp = floor(($tmp - $retour['minute']) / 60);
            $retour['hour'] = $tmp % 24;
            $tmp = floor(($tmp - $retour['hour']) / 24) + 1;
            $retour['day'] = $tmp % 24;

            // tester si jour ferier inclu  --------parcourir les date between date debut et date fin 
            $query = " select  jourferier.date as date"
                    . " from jourferier "
                    . " where  jourferier.date >= '" . $date_debut . "'"
                    . " and jourferier.date < '" . $date_fin . "'";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);

            $nbjourf = sizeof($listedocs);
            for ($i = strtotime($date_debut); $i <= strtotime($date_fin); $i = strtotime('+1 day', $i)) {
                if (date('N', $i) == 7) {
//                    echo date('l Y-m-d', $i);
                    $test = false;

                    for ($j = 0; $j < sizeof($listedocs); $j++) {
                        if ($listedocs[$j]['date'] == date('Y-m-d', $i)) {
                            $test = true;
                        }
                    }
                    if ($test == false) {
                        $listedocs[sizeof($listedocs)]['date'] = date('Y-m-d', $i);
                    }
                }
            }
            $tmp = $tmp - sizeof($listedocs);
//            }
            die($tmp);
        }

        die("Erreur");
    }

//edit 

    public function executeEdit(sfWebRequest $request) {

        $this->conge = Doctrine_Core::getTable('conge')->findOneById($request->getParameter('id'));
        $this->form = $this->configuration->getForm($this->conge);
    }

//save document 

    public function executeSavedocumentDemande(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agents = $params['id_agents'];
            $id_type = $params['id_type'];
            $dated = $params['dated'];
            $datef = $params['datef'];
            $nbrj = $params['nbrj'];
            $lieu = $params['lieu'];
            $sign = $params['sign'];
            $datedvalide = $params['datedvalide'];
            $objection = $params['objection'];
            $datefvalide = $params['datefvalide'];
            $nbjvalide = $params['nbjvalide'];
            $responsable = $params['responsable'];
            $signatureres = $params['signatureres'];
            $annee = $params['annee'];
            $id = $params['id'];
            $conge = new Conge();
            if ($id != "") {
                $con = Doctrine_Core::getTable('conge')->findOneById($id);
                if ($con)
                    $conge = $con;
            }

            if ($id_agents != "")
                $conge->setIdAgents($id_agents);
            if ($id_type != "")
                $conge->setIdType($id_type);
            if ($dated != "")
                $conge->setDatedebut($dated);
            if ($datef != "")
                $conge->setDatefin($datef);

            if ($nbrj != "")
                $conge->setNbrjour($nbrj);
            if ($lieu != "")
                $conge->setLieu($lieu);
            if ($sign != "")
                $conge->setSignature($sign);

            if ($objection == 'true') {
                $conge->setObjection(true);
                if ($dated != "")
                    $conge->setDatedebutvalide($dated);
                if ($datef != "")
                    $conge->setDatefinvalide($datef);
                if ($nbrj != "")
                    $conge->setNbrjvalide($nbrj);
            }

            else {
                $conge->setObjection(false);
                if ($datedvalide != "")
                    $conge->setDatedebutvalide($datedvalide);
                if ($datefvalide != "")
                    $conge->setDatefinvalide($datefvalide);
                if ($nbjvalide != "")
                    $conge->setNbrjvalide($nbjvalide);
            }
            if ($responsable != "")
                $conge->setResponsable($responsable);

            if ($signatureres != "")
                $conge->setSignatureresponsable($signatureres);

            $conge->setAnnee($annee);
            $conge->save();
            die($conge->getId() . "");
        }
        die('erreur!!  ');
    }

//valider demande

    public function executeSavedocumentDemandeValide(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $datefinextension = $params['datefinextension'];
            $datedebutextension = $params['datedebutextension'];
            $extension = $params['extension'];
            $valide = $params['valide'];
            $datefinvalide = $params['datefinvalide'];
            $datedebutvalide = $params['datedebutvalide'];
            $nbrjv = $params['nbrjv'];
            $nbrjrestant = $params['nbrjrestant'];
            $jourparanneprecedant = $params['jourparanneprecedant'];
            $droit = $params['droit'];
            $nbrjrestantValide = $params['nbrjrestantValide'];
            $nbrjrestantApresExtension = $params['nbrjrestantApresExtension'];

            $nbrcongetot = $params['nbrcongetot'];
            $nbrjex = $params['nbrjex'];
            $id = $params['id'];


            $conge = new Conge();
            if ($id != "") {
                $con = Doctrine_Core::getTable('conge')->findOneById($id);
                if ($con)
                    $conge = $con;
            }
            if ($datedebutvalide != "")
                $conge->setDaterealise($datedebutvalide);

            if ($droit != "")
                $conge->setNbjcongeannuelle($droit);
            if ($datefinvalide != "")
                $conge->setDatefinrealise($datefinvalide);
            if ($datedebutextension != "")
                $conge->setDatedenutprologement($datedebutextension);
            if ($datefinextension != "") {
                $conge->setDatefinprolongement($datefinextension);
                $conge->setDatefinrealise($datefinextension);
            }

            if ($nbrjrestant != "")
                $conge->setNbrcongerestant($nbrjrestant);
            if ($nbrjrestantValide != "")
                $conge->setNbrcongerestant($nbrjrestantValide);

            if ($nbrjrestantApresExtension != "")
                $conge->setNbrcongerestant($nbrjrestantApresExtension);


            if ($jourparanneprecedant != "")
                $conge->setNbrrestantannepr($jourparanneprecedant);

            if ($nbrjv != "")
                $conge->setNbrjourrealise($nbrjv);

            if ($valide == 'true') {
                $conge->setValide(true);
            } else {
                $conge->setValide(false);
            }
            if ($extension == 'true') {
                $conge->setExtension(true);
                if ($nbrjex != "") {
                    $conge->setNbrjourprolonge($nbrjex);
                }
            } else {
                $conge->setExtension(false);
            }

            if ($nbrcongetot != "")
                $conge->setNbrcongeralise($nbrcongetot);

            $conge->save();
            die($conge->getId() . "");
        }
        die('erreur!!  ');
    }

//valider suivi demande type 2 maladie  ordinaire 

    public function executeSavedocumentDemandeValidetype2(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $datefinextension = $params['datefinextension'];
            $datedebutextension = $params['datedebutextension'];
            $extension = $params['extension'];
            $valide = $params['valide'];
            $datefinvalide = $params['datefinvalide'];
            $datedebutvalide = $params['datedebutvalide'];
            $nbrjv = $params['nbrjv'];
            $nbrjrestant = $params['nbrjrestant'];

            $droit = $params['droit'];
            $nbrjrestantValide = $params['nbrjrestantValide'];
            $nbrjrestantApresExtension = $params['nbrjrestantApresExtension'];
            $nbrcongetot = $params['nbrcongetot'];
            $nbrjex = $params['nbrjex2'];
            $id = $params['id'];


            $conge = new Conge();
            if ($id != "") {
                $con = Doctrine_Core::getTable('conge')->findOneById($id);
                if ($con)
                    $conge = $con;
            }
            if ($datedebutvalide != "")
                $conge->setDaterealise($datedebutvalide);

            if ($droit != "")
                $conge->setNbjcongeannuelle($droit);
            if ($datefinvalide != "")
                $conge->setDatefinrealise($datefinvalide);
            if ($datedebutextension != "")
                $conge->setDatedenutprologement($datedebutextension);
            if ($datefinextension != "") {
                $conge->setDatefinprolongement($datefinextension);
                $conge->setDatefinrealise($datefinextension);
            }
            if ($nbrjrestant != "")
                $conge->setNbrcongerestant($nbrjrestant);
            if ($nbrjrestantValide != "")
                $conge->setNbrcongerestant($nbrjrestantValide);

            if ($nbrjrestantApresExtension != "")
                $conge->setNbrcongerestant($nbrjrestantApresExtension);


            if ($nbrjv != "")
                $conge->setNbrjourrealise($nbrjv);

            if ($valide == 'true') {
                $conge->setValide(true);
            } else {
                $conge->setValide(false);
            }
            if ($extension == 'true') {
                $conge->setExtension(true);
            } else {
                $conge->setExtension(false);
            }
            if ($nbrjex != "") {
                $conge->setNbrjourprolonge($nbrjex);
            } else
                $conge->setNbrjourprolonge(0);
            if ($nbrcongetot != "")
                $conge->setNbrcongeralise($nbrcongetot);


            $conge->save();
            die($conge->getId() . "");
        }
        die('erreur!!  ');
    }

//valider type 3
    public function executeSavedocumentDemandeValidetype3(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $datefinextension = $params['datefinextension'];
            $datedebutextension = $params['datedebutextension'];
            $extension = $params['extension'];
            $valide = $params['valide'];
            $datefinvalide = $params['datefinvalide'];
            $datedebutvalide = $params['datedebutvalide'];
            $nbrjv = $params['nbrjv'];
            $nbrjrestant = $params['nbrjrestant'];

            $droit = $params['droit'];
            $nbrjrestantValide = $params['nbrjrestantValide'];
            $nbrjrestantApresExtension = $params['nbrjrestantApresExtension'];
            $nbrcongetot = $params['nbrcongetot'];
            $nbrjex = $params['nbrjex2'];
            $id = $params['id'];


            $conge = new Conge();
            if ($id != "") {
                $con = Doctrine_Core::getTable('conge')->findOneById($id);
                if ($con)
                    $conge = $con;
            }
            if ($datedebutvalide != "")
                $conge->setDaterealise($datedebutvalide);

            if ($droit != "")
                $conge->setNbjcongeannuelle($droit);
            if ($datefinvalide != "")
                $conge->setDatefinrealise($datefinvalide);
            if ($datedebutextension != "")
                $conge->setDatedenutprologement($datedebutextension);
            if ($datefinextension != "") {
                $conge->setDatefinprolongement($datefinextension);
                $conge->setDatefinrealise($datefinextension);
            }
            if ($nbrjrestant != "")
                $conge->setNbrcongerestant($nbrjrestant);
            if ($nbrjrestantValide != "")
                $conge->setNbrcongerestant($nbrjrestantValide);

            if ($nbrjrestantApresExtension != "")
                $conge->setNbrcongerestant($nbrjrestantApresExtension);


            if ($nbrjv != "")
                $conge->setNbrjourrealise($nbrjv);

            if ($valide == 'true') {
                $conge->setValide(true);
            } else {
                $conge->setValide(false);
            }
            if ($extension == 'true') {
                $conge->setExtension(true);
            } else {
                $conge->setExtension(false);
            }
            if ($nbrjex != "") {
                $conge->setNbrjourprolonge($nbrjex);
            } else
                $conge->setNbrjourprolonge(0);
            if ($nbrcongetot != "")
                $conge->setNbrcongeralise($nbrcongetot);


            $conge->save();
            die($conge->getId() . "");
        }
        die('erreur!!  ');
    }

//valider rtpe 5

    public function executeSavedocumentDemandeValidetype5(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);

            $valide = $params['valide'];
            $datefinvalide = $params['datefinvalide'];
            $datedebutvalide = $params['datedebutvalide'];
            $nbrjv = $params['nbrjv'];
            $droit = $params['droit'];
            $nbrcongetot = $params['nbrcongetot'];
            $id = $params['id'];


            $conge = new Conge();
            if ($id != "") {
                $con = Doctrine_Core::getTable('conge')->findOneById($id);
                if ($con)
                    $conge = $con;
            }
            if ($datedebutvalide != "")
                $conge->setDaterealise($datedebutvalide);

            if ($droit != "")
                $conge->setNbjcongeannuelle($droit);
            if ($datefinvalide != "")
                $conge->setDatefinrealise($datefinvalide);

            if ($nbrjv != "")
                $conge->setNbrjourrealise($nbrjv);

            if ($valide == 'true') {
                $conge->setValide(true);
            } else {
                $conge->setValide(false);
            }

            if ($nbrcongetot != "")
                $conge->setNbrcongeralise($nbrcongetot);


            $conge->save();
            die($conge->getId() . "");
        }
        die('erreur!!  ');
    }

//valider type 6

    public function executeSavedocumentDemandeValidetype6(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);

            $valide = $params['valide'];
            $datefinvalide = $params['datefinvalide'];
            $datedebutvalide = $params['datedebutvalide'];
            $nbrjv = $params['nbrjv'];
            $droit = $params['droit'];
            $nbrjrestant = $params['nbrjrestant'];

            $id = $params['id'];
            $conge = new Conge();
            if ($id != "") {
                $con = Doctrine_Core::getTable('conge')->findOneById($id);
                if ($con)
                    $conge = $con;
            }
            if ($datedebutvalide != "")
                $conge->setDaterealise($datedebutvalide);

            if ($droit != "")
                $conge->setNbjcongeannuelle($droit);
            if ($datefinvalide != "")
                $conge->setDatefinrealise($datefinvalide);
            if ($nbrjv != "")
                $conge->setNbrjourrealise($nbrjv);
            if ($nbrjv != "")
                $conge->setNbrcongeralise($nbrjv);
            if ($nbrjrestant != "")
                $conge->setNbrcongerestant($nbrjrestant);


            if ($valide == 'true') {
                $conge->setValide(true);
            } else {
                $conge->setValide(false);
            }

            $conge->save();
            die($conge->getId() . "");
        }
        die('erreur!!  ');
    }

//impression demande conge 


    public function executeImprimerDemande(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Conge();
        $idd = $request->getParameter('iddoc');

        $documents = Doctrine_Core::getTable('conge')->findOneById($idd);
        $doc = $documents;
        $pdf = new sfTCPDF();
// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des Demandes du congé:');
        $pdf->SetSubject("document du liste consultation");
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
        $html = $this->ReadHtmlDemandeConge($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Consultations' . '.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlDemandeConge($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmlDemandeConge($idd);

        return $html;
    }

//suivi consommation conge
    public function executeSuiviconge(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@conge');
        $iddoc = $request->getParameter('iddoc');
        $this->conge = Doctrine_Core::getTable('conge')->findOneById($iddoc);
        $this->iddoc = $iddoc;
    }

    public function executeAfficheSuiviListeParType(sfWebRequest $request) {

//        $id_agents = $request->getParameter('idagents');
//        $typeconge = $request->getParameter('typeconge');
//        $query = " select  conge.annee as annee ,typeconge.id as idtype ,"
////            . " SUM( CAST(coalesce(conge.nbrcongeralise) AS integer)) as nbrcongeralise"
//                . " conge.daterealise as datedebut , conge.datefinrealise as datefin,"
//                . " conge.nbrjourrealise as nbrjourrealise"
//                . " , conge.nbrjourprolonge as nbrjourprolonge "
//                . ", conge.id_agents as idag , conge.nbrcongeralise as congerealise,"
//                . " conge.nbjcongeannuelle as nbjcongeannuelle"
//                . ", conge.nbrcongerestant as nbrcongerestant,"
//                . " typeconge.libelle as typeconge"
////            . ", lignetypeconge.typetraitement as typetraitement "
//                . " from conge,agents ,typeconge"
////            . ",lignetypeconge"
//                . " where conge.id_agents=agents.id "
//                . " and conge.valide=true "
//                . " and conge.id_type=typeconge.id"
//                . " and agents.id=" . $id_agents
//        ;
//        if ($typeconge != '') {
//            $query.= " and conge.id_type=" . $typeconge;
//        }
//        $query.= " GROUP BY conge.nbrcongeralise, conge.id,conge.annee,typeconge.id,conge.id_agents, agents.nomcomplet,agents.prenom"
//                . " ,agents.idrh,conge.nbrjourrealise,conge.nbrrestantannepr,conge.nbjcongeannuelle,conge.nbrcongerestant  "
//        ;
//        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//        $liste = $conn->fetchAssoc($query);

        $iddoc = $request->getParameter('idagents');
        $typeconge = $request->getParameter('typeconge', '');
        $annee_conge = $request->getParameter('annee_conge', '');

        return $this->renderPartial("liste_suiviindivudielle", array("typeconge" => $typeconge, "iddoc" => $iddoc, "annee_conge" => $annee_conge));
    }

    public function executeSuivicongeindividuelle(sfWebRequest $request) {

        $iddoc = $request->getParameter('iddoc');
//        $this->conge = Doctrine_Core::getTable('conge')->findOneByIdAgents($iddoc);
        $this->iddoc = $iddoc;
        $this->typeconge = $request->getParameter('typeconge', '');
        $this->annee_conge = $request->getParameter('annee_conge', '');

//        $query = " select  conge.annee as annee ,typeconge.id as idtype ,"
////            . " SUM( CAST(coalesce(conge.nbrcongeralise) AS integer)) as nbrcongeralise"
//                . " conge.daterealise as datedebut , conge.datefinrealise as datefin,"
//                . " conge.nbrjourrealise as nbrjourrealise"
//                . " , conge.nbrjourprolonge as nbrjourprolonge "
//                . ", conge.id_agents as idag , conge.nbrcongeralise as congerealise,"
//                . " conge.nbjcongeannuelle as nbjcongeannuelle"
//                . ", conge.nbrcongerestant as nbrcongerestant,"
//                . " typeconge.libelle as typeconge"
////            . ", lignetypeconge.typetraitement as typetraitement "
//                . " from conge,agents ,typeconge"
////            . ",lignetypeconge"
//                . " where conge.id_agents=agents.id "
//                . " and conge.valide=true "
//                . " and conge.id_type=typeconge.id"
//                . " and agents.id=" . $iddoc
////            ." and lignetypeconge.id_typeconge=typeconge.id"
////                . " and CAST(coalesce(conge.annee) AS integer)= " . $annee
//                . " GROUP BY conge.nbrcongeralise, conge.id,conge.annee,typeconge.id,conge.id_agents, agents.nomcomplet,agents.prenom"
//                . " ,agents.idrh,conge.nbrjourrealise,conge.nbrrestantannepr,conge.nbjcongeannuelle,conge.nbrcongerestant  "
////            ." ,lignetypeconge.typetraitement"
//        ;
//        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//        $this->liste = $conn->fetchAssoc($query);
    }

//suivi conge anuelle 


    public function executeSuivicongeanuelle(sfWebRequest $request) {

        if (!$request->getParameter('iddoc'))
            $this->redirect('@conge');
        $iddoc = $request->getParameter('iddoc');
        $this->conge = Doctrine_Core::getTable('conge')->findByAnne($iddoc);
        $this->iddoc = $iddoc;
    }

    public function executeRecapsuivi(sfWebRequest $request) {
//    $conge = Doctrine_Core::getTable('conge')->findAll();
        $query = " select  conge.annee as annee,conge.id_type as idtype ,typeconge.libelle as type ,"
                . " SUM( CAST(coalesce(conge.nbrcongeralise) AS integer)) as nbrcongeralise"
                . ", conge.id_agents as idag ,Concat( agents.nomcomplet,'  ',agents.prenom) as nom"
                . " ,agents.idrh as idrh , conge.nbrjourrealise as nbrjourrealise ,"
                . " conge.nbrrestantannepr as nbrrestantannepr, conge.nbjcongeannuelle as nbjcongeannuelle"
                . ", conge.nbrcongerestant as nbrcongerestant"
                . " from conge,agents ,typeconge"
                . " where conge.id_agents=agents.id "
                . " and conge.valide=true"
                . " and conge.id_type=typeconge.id"
                . " GROUP BY conge.annee,conge.id_type,typeconge.libelle,conge.id_agents, agents.nomcomplet,agents.prenom"
                . " ,agents.idrh,conge.nbrjourrealise,conge.nbrrestantannepr,conge.nbjcongeannuelle,conge.nbrcongerestant  "
                . " ORDER BY annee Desc";
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $this->liste = $conn->fetchAssoc($query);
    }

    //imprimer All listes
    public function executeImprimerAlllisteAllFilter(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $idag = $request->getParameter('idag');
        $idtype = $request->getParameter('idtype');
        $annee = $request->getParameter('annee');


        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des Congés Consommés:');
        $pdf->SetSubject("document du liste agents");
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
        $html = $this->ReadHtmlPersonelleAll($idag, $idtype, $annee);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleAll($idag, $idtype, $annee) {
        $html = StyleCssHeader::header1();
        $conge = new Conge();
        $html .= $conge->ReadHtmllisteAgentsAllFilter($idag, $idtype, $annee);

        return $html;
    }

}
