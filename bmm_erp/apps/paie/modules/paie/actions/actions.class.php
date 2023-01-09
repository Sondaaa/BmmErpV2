<?php

require_once dirname(__FILE__) . '/../lib/paieGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/paieGeneratorHelper.class.php';

/**
 * paie actions.
 *
 * @package    Bmm
 * @subpackage paie
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class paieActions extends autoPaieActions {

    public function executeAffichedetailPaieAgents(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $ids = $params['ids'];
            $ids = explode(',,', $ids);
//            $num = $params['numeotrimestre'];
            $annee = $params['annee'];
            $mois = $params['mois'];
            $mois_Prime = $params['mois_Prime'];
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            if ($mois = 3):
                $mois_debut = 3;
                $mois_debut_presence = 3;
//                $ligne = LignesocieteTable::getInstance()->findOneByMoiscalendiarle($mois_debut);
//                $mois_fin = $ligne->getCodemois();
                $total_jour = date('t', strtotime($annee . '-01-01')) + date('t', strtotime($annee . '-02-01')) + date('t', strtotime($annee . '-03-01'));
            elseif ($mois = 6):
                $mois_debut = 6;
                $mois_debut_presence = 6;
//                $ligne = LignesocieteTable::getInstance()->findOneByMoiscalendiarle($mois_debut);
//                $mois_fin = $ligne->getCodemois();
                $total_jour = date('t', strtotime($annee . '-04-01')) + date('t', strtotime($annee . '-05-01')) + date('t', strtotime($annee . '-06-01'));

            elseif ($mois = 9):
                $mois_debut = 9;
                $mois_debut_presence = 9;
//                $ligne = LignesocieteTable::getInstance()->findOneByMoiscalendiarle($mois_debut);
//                $mois_fin = $ligne->getCodemois();
                $total_jour = date('t', strtotime($annee . '-07-01')) + date('t', strtotime($annee . '-08-01')) + date('t', strtotime($annee . '-09-01'));

            elseif ($mois = 12):
                $mois_debut = 12;
                $mois_debut_presence = 12;
//                $ligne = LignesocieteTable::getInstance()->findOneByMoiscalendiarle($mois_debut);
//                $mois_fin = $ligne->getCodemois();
                $total_jour = date('t', strtotime($annee . '-10-01')) + date('t', strtotime($annee . '-11-01')) + date('t', strtotime($annee . '-12-01'));

            endif;
            if ($mois_debut_presence < 10):
                $mois_debut_presence = "0" . $mois_debut_presence;
                elsem: $mois_debut_presence = $mois_debut_presence;
            endif;

            $query_total = " select 0 as id ,agents.id as id_agents ,agents.idrh as idrh, concat(agents.nomcomplet, ' ' , agents.prenom) as agents"
                    . " ,paie.salairebrut as sbrut ,codesociale.libelle as codesociale , codesociale.taux as taux"
                    . " , codesociale.id  as id_codesociale "
                    . ", paie.abattementenfant as abattenfant , paie.abatementcheffamille   as abattcheffamille"
                    . " , paie.salaireteorique as salairetheorique, paie.salairebrut as base_calculprime"
//                    . " , ROUND(CAST( paie.noterendement AS NUMERIC ) ,2)as noterednement , "
                    . ", paie.noterendement as noterednement,"
                    . " paie.brutprime as brut_prime "
                    . " , null as irpp , null as css"
                    . " ,  ROUND(CAST(COALESCE(count(grillepresence.semaine),0)::float /" . $total_jour . " AS NUMERIC), 2)  as notepresence ,  "

//                    ." , COALESCE(count(grillepresence.semaine),0) as notepresence , "
                    . $total_jour . " as total_jour "
                    . " from paie,agents,codesociale , grillepresence,presence "
                    . "  where  paie.id_agents IN (" . implode(',', array_map('intval', $ids)) . ")"
                    . "  and  paie.id_agents NOT IN (select paie.id_agents as id_agents from paie "
                    . " where paie.id_agents IN (" . implode(',', array_map('intval', $ids)) . ") "
                    . " and paie.mois = " . $mois_Prime . " and paie.annee = " . $annee . ")"
                    . "  and paie.mois = " . $mois_debut
                    . " and paie.id_agents=agents.id"
                    . " and paie.id_codesociale = codesociale.id"
                    . " and grillepresence.id_presnece=presence.id"
                    . " and presence.mois <= '" . $mois_debut_presence . "'"
                    . " and presence.annee ='" . $annee . "'"
                    . " and presence.id_agents = agents.id"
//                     . " and ((grillepresence.id_motif IS NOT NULL)and(grillepresence.id_motif <> '3' )) "
                    . " and (( grillepresence.semaine <> '0'))"
                    . " group by agents.id ,paie.salairebrut,codesociale.libelle,codesociale.taux,codesociale.id,paie.abattementenfant ,paie.abatementcheffamille,paie.salaireteorique,paie.noterendement,paie.notepresence ,paie.brutprime,paie.id"
                    . " UNION "
                    . " select paie.id as id ,agents.id as id_agents ,agents.idrh as idrh, concat(agents.nomcomplet , agents.prenom) as agents"
                    . " ,paie.salairebrut as sbrut ,codesociale.libelle as codesociale , codesociale.taux as taux"
                    . " , codesociale.id  as id_codesociale "
                    . ", paie.abattementenfant as abattenfant , paie.abatementcheffamille   as abattcheffamille"
                    . " , paie.salaireteorique as salairetheorique, cast( paie.basecalculprime as numeric) as base_calculprime"
//                    . " , ROUND(CAST( paie.noterendement AS NUMERIC ) ,2)as noterednement , "
                    . ", paie.noterendement as noterednement,"
                    . "paie.brutprime as brut_prime"
                    . " ,paie.montantirpp as irpp , paie.contribitionsociale as css"
                    . " , ROUND(CAST(paie.notepresence AS NUMERIC), 2) as notepresence  ,  "
                    . $total_jour . " as total_jour "
                    . " from paie,agents,codesociale , grillepresence,presence "
                    . "  where  paie.id_agents IN (select paie.id_agents as id_agents from paie where paie.id_agents IN (" . implode(',', array_map('intval', $ids)) . ") and paie.mois = 13 and paie.annee = " . $annee . ")"
                    . "  and paie.mois = " . $mois_Prime
                    . " and paie.id_agents=agents.id"
                    . " and paie.id_codesociale = codesociale.id"
                    . " and grillepresence.id_presnece=presence.id"
                    . " and presence.mois <= '" . $mois_debut_presence . "'"
                    . " and presence.annee ='" . $annee . "'"
                    . " and presence.id_agents = agents.id"
//                    . " and ((grillepresence.id_motif IS NOT NULL)and(grillepresence.id_motif <> '3' )) "
                    . " and (( grillepresence.semaine <> '0'))"
                    . " group by agents.id ,paie.salairebrut,codesociale.libelle,codesociale.taux ,codesociale.id,paie.abattementenfant,paie.abatementcheffamille,paie.salaireteorique,paie.noterendement,paie.notepresence,paie.brutprime ,paie.id";


            $listedocs = $conn->fetchAssoc($query_total);
            die(json_encode($listedocs));
        }

        die("Erreur");
    }

//calcul irpp dun troisieme mois 
    public function executeCalculIrpp(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
//            $num = $params['num'];
            $annee = $params['annee'];
            $mois = $params['mois'];
            $brut_prime = $params['brut_prime'];
            $taux = $params['taux'];
            $id_agents = $params['id_agents'];
            if ($mois == 3):
                $query = " select CAST(COALESCE(SUM(CAST(coalesce(paie.salairebrut) AS numeric)),0) +  paie.salaireteorique * 9 AS numeric)  as brutannuel,"
                        . " CAST(COALESCE( SUM (CAST(coalesce(paie.salairebrut) AS numeric)),0) + paie.salaireteorique * 9 + " . $brut_prime . "AS numeric)  as brutannuel_2 ,"
                        . " paie.abattementenfant + paie.abatementcheffamille   as abttmnetfamille"
                        . " from paie"
                        . " where paie.mois <= 3"
                        . " and paie.annee=" . $annee
                        . " and paie.id_agents=" . $id_agents
                        . " group by paie.salaireteorique ,paie.abattementenfant,paie.abatementcheffamille";

            elseif ($mois == 6):
                $query = " select  COALESCE( SUM (CAST(coalesce(paie.salairebrut) AS integer)),0) + paie.salaireteorique * 6 as brutannuel ,"
                        . " COALESCE( SUM (CAST(coalesce(paie.salairebrut) AS integer)),0) + paie.salaireteorique * 6 + " . $brut_prime . "  as brutannuel_2 "
                        . ", paie.abattementenfant + paie.abatementcheffamille   as abttmnetfamille"
                        . " from paie"
                        . "  where paie.mois <= 6"
                        . " and paie.annee=" . $annee
                        . " and paie.id_agents=" . $id_agents
                        . " group by paie.salaireteorique ,paie.abattementenfant,paie.abatementcheffamille";

            elseif ($mois == 9):
                $query = " select  COALESCE( SUM (CAST(coalesce(paie.salairebrut) AS integer)),0) + paie.salaireteorique * 3 as brutannuel,"
                        . " COALESCE( SUM (CAST(coalesce(paie.salairebrut) AS integer)),0) + paie.salaireteorique * 3 + " . $brut_prime . "  as brutannuel_2 "
                        . ", paie.abattementenfant + paie.abatementcheffamille   as abttmnetfamille"
                        . " from paie"
                        . "  where paie.mois <= 9"
                        . " and paie.annee=" . $annee
                        . " and paie.id_agents=" . $id_agents
                        . " group by paie.salaireteorique ,paie.abattementenfant,paie.abatementcheffamille";
            elseif ($mois == 12):
                $query = " select  COALESCE(SUM (CAST(coalesce(paie.salairebrut) AS integer)),0)  as brutannuel,"
                        . " COALESCE( SUM (CAST(coalesce(paie.salairebrut) AS integer)),0)  + " . $brut_prime . "  as brutannuel_2 "
                        . " ,paie.abattementenfant + paie.abatementcheffamille   as abttmnetfamille"
                        . " from paie"
                        . "  where paie.mois <= 12"
                        . " and paie.annee=" . $annee
                        . " and paie.id_agents=" . $id_agents
                        . " group by paie.salaireteorique ,paie.abattementenfant,paie.abatementcheffamille";
            endif;

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);

            $brutannuel = $listedocs[0]['brutannuel'];
            $brutannuel_2 = $listedocs[0]['brutannuel_2'];
            $mntsocialemensuelle = $brut_prime * $taux / 100;
            $salaireimpo = $brut_prime - $mntsocialemensuelle;
            $abatmentfamille = $listedocs[0]['abttmnetfamille'];

            $sociale = $brutannuel * $taux / 100;
            $sociale_2 = $brutannuel_2 * $taux / 100;

            $netsociale = $brutannuel - $sociale;
            $netsociale_2 = $brutannuel_2 - $sociale_2;

            if ($netsociale * 0.1 < 2000) {
                $abbattment = $netsociale * 0.1;
            } else
                $abbattment = 2000;
            if ($netsociale_2 * 0.1 < 2000) {
                $abbattment_2 = $netsociale_2 * 0.1;
            } else
                $abbattment_2 = 2000;
            $abttmntfr = $netsociale - $abbattment;
            $abttmntfr_2 = $netsociale_2 - $abbattment_2;

            $imposable = $abttmntfr - $abatmentfamille;
            $imposable_2 = $abttmntfr_2 - $abatmentfamille;

            $query_bareme = " select  baremeimpot.montantdebut  as montantdebut , "
                    . " baremeimpot.montantfin  as montantfin "
                    . " ,  baremeimpot.pourcentage as pourcentage"
                    . " from baremeimpot ";
            $bareme = $conn->fetchAssoc($query_bareme);

            $total = 0;
            $total_1 = 0;
            $total_2 = 0;
            $total_2_1 = 0;
            for ($i = 0; $i < sizeof($bareme); $i++):
                $mntdebut = floatval($bareme[$i]['montantdebut']);
                $mntfin = floatval($bareme[$i]['montantfin']);
                $pourcentage = floatval($bareme[$i]['pourcentage']);

                if ($imposable > $mntfin && $mntfin != '') {
                    $resultat = ($mntfin - $mntdebut) * $pourcentage / 100;
                    $total = $total + $resultat;
                    $resultat_1 = ($mntfin - $mntdebut) * ( $pourcentage + 1) / 100;
                    $total_1 = $total_1 + $resultat_1;
                } else {
                    if ($imposable > $mntdebut) {
                        $resultat = (($imposable - $mntdebut) * $pourcentage) / 100;

                        $total = number_format($total + $resultat, 3, '.', '');
                        $resultat_1 = ( ($imposable - $mntdebut) * ($pourcentage + 1)) / 100;
                        $total_1 = $total_1 + $resultat_1;
                    }
                }


                if ($imposable_2 > $mntfin && $mntfin != '') {
                    $resultat_2 = ($mntfin - $mntdebut) * $pourcentage / 100;
                    $total_2 = $total_2 + $resultat_2;
                    $resultat_2_1 = ($mntfin - $mntdebut) * ( $pourcentage + 1) / 100;
                    $total_2_1 = $total_2_1 + $resultat_2_1;
                } else {
                    if ($imposable_2 > $mntdebut) {
                        $resultat_2 = (($imposable_2 - $mntdebut) * $pourcentage) / 100;
                        $total_2 = number_format($total_2 + $resultat_2, 3, '.', '');
                        $resultat_2_1 = ( ($imposable_2 - $mntdebut) * ($pourcentage + 1)) / 100;
                        $total_2_1 = $total_2_1 + $resultat_2_1;
                    }
                }
            endfor;
            $montantirpp = ($total / 12);
            $contribitionsociale = ($total_1 / 12) - ($total / 12);
            $montantirpp_2 = ($total_2 / 12);
            $contribitionsociale_2 = ($total_2_1 / 12) - ($total_2 / 12);
            $retenue_prime = ($montantirpp_2 - $montantirpp) * 12;
            $contribution_prime = ($contribitionsociale_2 - $contribitionsociale) * 12;
            $salairenet = $salaireimpo - $retenue_prime - $contribution_prime;
            $netapyyer = $salairenet;
            $arr = Array(number_format($retenue_prime, 3, '.', ''), number_format($contribution_prime, 3, '.', ''), number_format($mntsocialemensuelle, 3, '.', '')
                , number_format($sociale, 3, '.', ''), number_format($netsociale, 3, '.', ''),
                number_format($abbattment, 3, '.', ''), number_format($abttmntfr, 3, '.', ''), number_format($imposable, 3, '.', ''),
                number_format($salaireimpo, 3, '.', ''), number_format($salairenet, 3, '.', ''), number_format($netapyyer, 3, '.', ''), number_format($brutannuel, 3, '.', ''));
            die(json_encode($arr));
        }
        die("Erreur");
    }

//save ligne dans le paie 
    public function executeSavelignesupperier12paie(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agents = $params['id_agents'];
//            $num = $params['num'];
            $mois = $params['mois'];

            $mois_prime = $params['mois_prime'];
            $id_codesociale = $params['id_codesociale'];
            $sbrut = $params['sbrut'];
            $annee = $params['annee'];
            $netsociale = $params['netsociale'];
            $abattement = $params['abattement'];
            $abattementfrpro = $params['abattementfrpro'];
            $abattenfant = $params['abattenfant'];
            $abattcheffamille = $params['abattcheffamille'];
            $salaireimpo = $params['salaireimpo'];
            $retenueimosable = $params['retenueimosable'];
            $salairenet = $params['salairenet'];
            $netapayyer = $params['netapayyer'];
            $css = $params['css'];
            $montantsociale = $params['montantsociale'];
            $brutanuue = $params['brutanuue'];
            $irpp = $params['irpp'];
            $mntsocialmensuelle = $params['mntsocialmensuelle'];
            $salairetheorique = $params['salairetheorique'];
            $noterednement = number_format($params['noterednement'], 2, '.', '');
            $notepresence = number_format($params['notepresence'], 2, '.', '');
            $base_calculprime = $params['base_calculprime'];
            $brut_prime = $params['brut_prime'];
            $id = $params['id'];
            $paie = new Paie();
            if ($id != 0) {
                $paie = PaieTable::getInstance()->findOneById($id);
            }
            if ($id_agents != "")
                $paie->setIdAgents($id_agents);
            if ($id_codesociale != "")
                $paie->setIdCodesociale($id_codesociale);
//            if ($num == 1)
//                $paie->setMois(13);
//            if ($num == 2)
//                $paie->setMois(14);
//            if ($num == 3)
//                $paie->setMois(15);
//            if ($num == 4)
//                $paie->setMois(16);
//            if ($mois == 3) {
//                $ligne = LignesocieteTable::getInstance()->findOneByMoiscalendiarle(3);
//                $mois_fin = $ligne->getCodemois();
//                $paie->setMois($mois_fin);
//            }
//            if ($mois == 6) {
//                $ligne = LignesocieteTable::getInstance()->findOneByMoiscalendiarle(6);
//                $mois_fin = $ligne->getCodemois();
//                $paie->setMois($mois_fin);
//            }
//            if ($mois == 9) {
//                $ligne = LignesocieteTable::getInstance()->findOneByMoiscalendiarle(9);
//                $mois_fin = $ligne->getCodemois();
//                $paie->setMois($mois_fin);
//            }
//            if ($mois == 12) {
//                $ligne = LignesocieteTable::getInstance()->findOneByMoiscalendiarle(12);
//                $mois_fin = $ligne->getCodemois();
//                $paie->setMois($mois_fin);
//            }

            if ($mois_prime != "")
                $paie->setMois($mois_prime);
            if ($annee != "")
                $paie->setAnnee($annee);
            if ($sbrut != "")
                $paie->setSalairebrut($sbrut);
            if ($netsociale != "")
                $paie->setNetsociale($netsociale);
            if ($abattement != "")
                $paie->setAbattement($abattement);
            if ($abattementfrpro != "")
                $paie->setAbattementfraaisprof($abattementfrpro);
            if ($abattenfant != "")
                $paie->setAbattementenfant($abattenfant);
            if ($abattcheffamille != "")
                $paie->setAbatementcheffamille($abattcheffamille);
            if ($salaireimpo != "")
                $paie->setSalaireimposable($salaireimpo);
            if ($retenueimosable != "")
                $paie->setRetenueimposable($retenueimosable);
            if ($salairenet != "")
                $paie->setSalairenet($salairenet);
            if ($netapayyer != "")
                $paie->setNetapayyer($netapayyer);
            if ($css != "")
                $paie->setContribitionsociale($css);
            if ($montantsociale != "")
                $paie->setMontantsociale($montantsociale);
            if ($brutanuue != "")
                $paie->setSalairebrutannuel($brutanuue);
            if ($irpp != "")
                $paie->setMontantirpp($irpp);
            if ($mntsocialmensuelle != "")
                $paie->setMontantsocialemensuel($mntsocialmensuelle);
            if ($salairetheorique != "")
                $paie->setSalaireteorique($salairetheorique);
            if ($noterednement != "")
                $paie->setNoterendement($noterednement);
            if ($notepresence != "")
                $paie->setNotepresence($notepresence);
            if ($base_calculprime != "")
                $paie->setBasecalculprime($base_calculprime);
            if ($brut_prime != "")
                $paie->setBrutprime($brut_prime);


            $paie->save();
            die('ajout avec succe');
        }
        die('errreur  !!!!');
    }

    public function executeDeleteLignepaie(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];

            if ($id != 0) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                Doctrine_Query::create()->delete('paie')
                        ->where('id =' . $id)->execute();
            }
        }
        die('suppression  avec succe !! ');
    }

//affiche liste agents
    public function executeAfficheListeAgents(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $annee = $params['annee'];
            $mois = $params['mois'];
//            $num = $para$numms['num'];
            if ($mois == 3 || $mois == 6 || $mois == 9 || $mois == 12):
                $query = " select agents.id as id, concat( agents.idrh, ' ', agents.nomcomplet, ' ', agents.prenom) as libelle"
                        . " from agents,  paie "
                        . " where paie.id_agents = agents.id"
                        . " and paie.annee =" . $annee
                        . " and paie.mois = " . $mois
                        . " group by agents.id"
                        . " order by agents.idrh";

            endif;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }

    public function executeAffectation(sfWebRequest $request) {
        $this->paie = PaieTable::getInstance()->findAll();
    }

    public function executeIndex(sfWebRequest $request) {
// sorting
        $dossier_id = DossiercomptableTable::getInstance()->FindAll()->getFirst()->getId();
        $annee = $_SESSION['exercice_paie_id'];
        $this->annee = $annee;
        $this->pager = $this->paginate($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function executeFiltrerPaie(sfWebRequest $request) {
        $idAg = $request->getParameter('idAg');
        $idAgF = $request->getParameter('idAgF');
        $mois = $request->getParameter('mois');
        $annee = $request->getParameter('annee');

        $annee_session = $request->getParameter('annee_session');

        return $this->renderPartial("liste_filtre", array("idAg" => $idAg, "idAgF" => $idAgF, "mois" => $mois, "annee" => $annee, "annee_session" => $annee_session));
    }

//joural de pai
    public function executeFiltrerJournalPaie(sfWebRequest $request) {

        $mois_journalepaie = $request->getParameter('mois_journalepaie');
        $annee_journalpaie = $request->getParameter('annee_journalpaie');
        $id_codesociale = $request->getParameter('id_codesociale');
        $id_codesocialeF = $request->getParameter('id_codesocialeF');
        return $this->renderPartial("liste_filtre_Journal", array("mois_journalepaie" => $mois_journalepaie, "annee_journalpaie" => $annee_journalpaie, "id_codesociale" => $id_codesociale, "id_codesocialeF" => $id_codesocialeF));
    }

    public function executeAfficheligneEnfants(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agents = $params['id'];

            $query = " select enfants.nordre as norgdre ,"
                    . " enfants.nom as nome ,enfants.prenom as prenome ,"
                    . "enfants.datenaissance as datenai ,enfants.datemajeur as age ,"
                    . " enfants.etat as dece , enfants.etudiant as etudiant , enfants.boursie as boursier ,"
                    . " enfants.id_deduction as iddeduction , deductioncommune.designation as deduction "
                    . " from enfants , deductioncommune"
                    . " where enfants.id_agents=" . $id_agents . ""
                    . " and enfants.id_deduction=deductioncommune.id";




            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocsE = $conn->fetchAssoc($query);
            die(json_encode($listedocsE));
        }
        die("bien");
    }

//declaartion cnss
    public function executeFiltrerDeclaration(sfWebRequest $request) {

        $trimestre = $request->getParameter('trimestre');
        $annee_declaration = $request->getParameter('annee_declaration');
        $codesociale = $request->getParameter('codesociale');
        $annee_session = $request->getParameter('annee_session');
        return $this->renderPartial("liste_filtre_declaration", array("trimestre" => $trimestre, "annee_declaration" => $annee_declaration, "codesociale" => $codesociale, "annee_session" => $annee_session));
    }

    public function executeFiltrerEtatRecap(sfWebRequest $request) {

        $mois = $request->getParameter('mois');
        $annee = $request->getParameter('annee');
        $codesociale = $request->getParameter('codesoc');
        return $this->renderPartial("liste_filtre_recap", array("mois" => $mois, "annee" => $annee, "codesociale" => $codesociale));
    }

    public function executeGoPage(sfWebRequest $request) {
        $pager = $this->paginate($request);
        $page = $request->getParameter('page', 1);
        return $this->renderPartial('listeFichePaie', array('pager' => $pager, 'page' => $page));
    }

    public function paginate(sfWebRequest $request) {
        $id_exercice = $_SESSION['exercice_paie_id'];
        $exercice = ExerciceTable::getInstance()->findOneById($id_exercice);
        $annee = $exercice->getLibelle();
        $id_agent = $request->getParameter('id_agents', '');
        $page = $request->getParameter('page', 1);
        $pager = new sfDoctrinePager('paie', 10);
        $pager->setQuery(PaieTable::getInstance()->loadAllFiltre($id_agent, $annee));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeDelete(sfWebRequest $request) {
        $iddoc = $request->getParameter('id');
        $this->forward404Unless($demandeavance = Doctrine_Core::getTable('paie')->find(array($request->getParameter('id'))), sprintf('Object fiche does not exist (%s).', $request->getParameter('id')));
        $paie->delete();
        $this->redirect('@paie');
    }

    public function executeEdit(sfWebRequest $request) {

        $this->paie = Doctrine_Core::getTable('paie')->findOneById($request->getParameter('id'));
        $this->form = $this->configuration->getForm($this->paie);
    }

//affiche detail agents 
    public function executeAffichedetailAgents(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idagent = $params['id_agents'];
            $mois = $params['mois'];
            $annee = $params['annee'];

            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT  contrat.id_agents as idag,contrat.id as idcontrat "
                    . ",contrat.id_salairedebase as idsal "
                    . ",salairedebase.id_grade as idgrade ,salairedebase.motant as salaire"
                    . ",grade.libelle as grade ,"
                    . " echelle.libelle as echelle , echelon.libelle as echelon , "
                    . " categorierh.libelle as categorie,"
                    . "  typecontrat.libelle as situation"
                    . " , contrat.id_posterh as idposte , posterh.id as idp"
                    . " ,posterh.libelle as poste"
                    . " ,posterh.id_unite as idunite,unite.id as id_unite , unite.libelle as unite "
                    . " ,unite.id_service as idservice, servicerh.libelle as service "
                    . " , servicerh.id_sousdirection as idsousdirection , sousdirection.libelle as sousdirection"
                    . " , sousdirection.id_direction as iddirection , direction.libelle as direction"
                    . " , agents.cheffamille as chef, agents.id_codesociale as id_codesociale, "
                    . " codesociale.taux as taux"
                    . " ,COALESCE(count(grillepresence.semaine),0) as nbrjourt"
                    . " FROM agents , contrat"
                    . " , posterh ,unite,servicerh,sousdirection,direction ,codesociale,"
                    . " grade,salairedebase,categorierh,typecontrat , echelle , echelon "
                    . " ,grillepresence,presence"
                    . " WHERE contrat.id_agents=agents.id "
                    . " and contrat.id_posterh=posterh.id"
                    . " and posterh.id_unite=unite.id"
                    . " and unite.id_service=servicerh.id"
                    . " and contrat.id_salairedebase=salairedebase.id "
                    . " and contrat.id_typecontrat=typecontrat.id "
                    . " and salairedebase.id_grade=grade.id"
                    . " and salairedebase.id_categorie=categorierh.id"
                    . " and salairedebase.id_echelle=echelle.id"
                    . " and salairedebase.id_echelon=echelon.id"
                    . " and servicerh.id_sousdirection=sousdirection.id"
                    . " and sousdirection.id_direction=direction.id"
                    . " and agents.id=" . $idagent
                    . " and presence.annee= '" . $annee . "' "
                    . " and presence.mois= '" . $mois . "' "
                    . " and ((grillepresence.id_motif IS NULL) or ( grillepresence.semaine <> '0'))"
                    . " and grillepresence.id_presnece=presence.id"
                    . " and presence.id_agents=" . $idagent
                    . " Group By contrat.id_agents ,contrat.id ,agents.id"
                    . ",contrat.id_salairedebase,salairedebase.id_grade ,grade.libelle,salairedebase.motant"
                    . ",echelle.libelle, echelon.libelle,categorierh.libelle"
                    . ",typecontrat.libelle,contrat.id_posterh,posterh.id,posterh.libelle,posterh.id_unite,unite.id,unite.libelle,unite.id_service"
                    . ",servicerh.libelle,servicerh.id_sousdirection,sousdirection.libelle,sousdirection.id_direction,direction.libelle"
                    . ",agents.cheffamille,agents.id_codesociale, codesociale.taux"
                    . " Limit 1"
            ;



            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    public function executeAffichePointage(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $mois = $params['mois'];
            $annee = $params['annee'];
            $id_agents = $params['id_agents'];
            $query = " select  COALESCE(count(grillepresence.semaine),0) as nbrjourt , presence.id as idpresence  "
                    . " from grillepresence,presence"
                    . "   where  presence.annee= '" . $annee . "' "
                    . " and presence.mois= '" . $mois . "' "
//                    . " and (grillepresence.id_motif IS NULL or  grillepresence.semaine <> '0')"
                    . " and grillepresence.semaine <> '0'"
                    . " and grillepresence.id_presnece=presence.id"
                    . " and presence.id_agents=" . $id_agents
                    . " Group By idpresence"
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }

    public function executeAfficheConge(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $mois = $params['mois'];
            $annee = $params['annee'];
            $id_agents = $params['id_agents'];
            $query = " select  conge.nbrcongeralise  as nbrjourc  "
                    . " from conge "
                    . "   where conge.datedebutvalide::TEXT Like '%" . $annee . '-' . $mois . "%'"
                    . "   and conge.datefinvalide::TEXT Like '%" . $annee . '-' . $mois . "%'"
                    . "   and conge.datedenutprologement::TEXT Like '%" . $annee . '-' . $mois . "%'"
                    . "   and conge.datefinprolongement::TEXT Like '%" . $annee . '-' . $mois . "%'"
                    . "   and conge.id_agents=" . $id_agents
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }

    public function executeAfficheAbsence(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $mois = $params['mois'];
            $annee = $params['annee'];
            $id_agents = $params['id_agents'];
            $query = " select  COALESCE(count(grillepresence.semaine),0) as nbrjoura , presence.id as idpresence  "
                    . " from grillepresence,presence"
                    . "   where  presence.annee= '" . $annee . "' "
                    . " and presence.mois= '" . $mois . "' "
//                    . " and (grillepresence.id_motif IS NULL or  grillepresence.semaine <> '0')"
                    . " and grillepresence.id_motif IS NOT NULL "
                    . " and grillepresence.id_presnece=presence.id"
                    . " and presence.id_agents=" . $id_agents
                    . " Group By idpresence"
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }

    public function executeAffichenbrjourferier(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $mois = $params['mois'];
            $annee = $params['annee'];
            $query = " select  COALESCE(count(jourferier.date),0)  as nbrjourf  "
                    . " from jourferier "
                    . "   where jourferier.date::TEXT Like '%" . $annee . '-' . $mois . "%'"
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }

//taux du code sociale 
    public function executeAfficehTTauxCodeSociale(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $query = " select  codesociale.taux  as taux  "
                    . " from codesociale "
                    . " where codesociale.id=" . $id
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }

//affiche liste primes
    public function executeAffichelignePrimes(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Contrat = $params['id'];

            $query = "select primes.id as idprime,ligneprimecontrat.nordre as norgdre ,"
                    . " primes.id_titreprime as nordre"
                    . ", titreprimes.libelle as libelle ,primes.montant as montant"
                    . " , primes.imposable as imposable , primes.cotisable as cotisable "
                    . " from ligneprimecontrat,primes,titreprimes"
                    . " where ligneprimecontrat.id_contrat=" . $id_Contrat
                    . " and ligneprimecontrat.id_prime=primes.id "
                    . " and titreprimes.id=primes.id_titreprime";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocsPrime = $conn->fetchAssoc($query);
            die(json_encode($listedocsPrime));
        }
        die("bien");
    }

//liste des enfants 
    public function executeAffichelisteEnfants(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agents = $params['id'];
            $query = " select enfants.nordre as norgdre ,"
                    . " enfants.nom as nome ,enfants.prenom as prenome ,"
                    . "enfants.datenaissance as datenai ,enfants.datemajeur as age ,"
                    . " enfants.etat as dece , enfants.etudiant as etudiant , enfants.boursie as boursier ,"
                    . " enfants.id_deduction as iddeduction , deductioncommune.designation as deduction ,"
                    . " deductioncommune.montant as montant "
                    . " from enfants , deductioncommune"
                    . " where enfants.id_agents=" . $id_agents . ""
                    . " and enfants.id_deduction=deductioncommune.id";




            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocsE = $conn->fetchAssoc($query);
            die(json_encode($listedocsE));
        }
        die("bien");
    }

//liste parents
    public function executeAffichelisteParents(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agents = $params['id'];
            $query = " select parents.nordre as norgdre , parents.nom as nom ,"
                    . " parents.prenom as prenom ,parents.datenaissance as daten,"
                    . " parents.etat as deceparent "
                    . " from parents"
                    . " where parents.id_agents=" . $id_agents . "";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocsE = $conn->fetchAssoc($query);
            die(json_encode($listedocsE));
        }
        die("bien");
    }

//affiche liste des retenus 
    public function executeAffichelisteRetenue(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agents = $params['id'];
            $mois = $params['mois'];
            $annee = $params['annee'];
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query_avance = " select Historiqueretenue.montantsoustre as montantmensielle  , demandeavance.id as idd,"
                    . " Historiqueretenue.montant as montanttotal "
                    . " , avance.libelle as type , "
                    . " demandeavance.datedebutretenue as datedebut "
                    . ", demandeavance.datefinretenue as datefin ,avance.remboursement as nbrmois"
                    . " from Historiqueretenue , demandeavance,avance "
                    . " where Historiqueretenue.id_demandeavance= demandeavance.id"
                    . " and demandeavance.id_agents=" . $id_agents . ""
                    . " and demandeavance.id_typeavance=avance.id"
                    . " and Historiqueretenue.mois=" . $mois
                    . " and Historiqueretenue.annee=" . $annee;

            $resultata_avance = $conn->fetchAssoc($query_avance);
            $query_retenue = " select Historiqueretenue.montantsoustre as montantmensielle  , retenuesursalaire.id as idd,"
                    . " Historiqueretenue.montant as montanttotal"
                    . " , Concat( 'Retenue Sur Salaire : ' , fournisseur.rs ) as type"
                    . " , retenuesursalaire.datedebut as datedebut "
                    . ", retenuesursalaire.datefin as datefin ,retenuesursalaire.nbrmois as nbrmois"
                    . " from Historiqueretenue , retenuesursalaire,fournisseur"
                    . " where Historiqueretenue.id_retenue= retenuesursalaire.id"
                    . " and retenuesursalaire.id_agents=" . $id_agents . ""
                    . " and retenuesursalaire.id_fournisseur=fournisseur.id"
                    . " and Historiqueretenue.mois=" . $mois
                    . " and Historiqueretenue.annee=" . $annee
            ;
            $resultata_retenue = $conn->fetchAssoc($query_retenue);
            $query_pret = " select Historiqueretenue.montantsoustre as montantmensielle  ,demandepret.id as idd,"
                    . " Historiqueretenue.montant as montanttotal"
                    . " , Concat(pret.libelle , ' : ' , sourcepret.libelle  ) as type"
                    . " , demandepret.datedebutretenue as datedebut "
                    . ", demandepret.datefinretenue as datefin ,"
                    . " demandepret.nbrmois as nbrmois"
                    . " from Historiqueretenue , demandepret,pret , sourcepret"
                    . " where Historiqueretenue.id_demandepret= demandepret.id"
                    . " and demandepret.id_agents=" . $id_agents . ""
                    . " and demandepret.id_typepret=pret.id"
                    . " and pret.id_source =sourcepret.id "
                    . " and Historiqueretenue.mois=" . $mois
                    . " and Historiqueretenue.annee=" . $annee;
            $resultata_pret = $conn->fetchAssoc($query_pret);

            $resultat = array();
            $resultat['avance'] = $resultata_avance;
            $resultat['pret'] = $resultata_pret;
            $resultat['retenue'] = $resultata_retenue;
            die(json_encode($resultat));
        }
        die("bien");
    }

//tester avec bareme impot 
    public function executeTesterBareme(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $imposable = $params['imposable'];
            $query = " select  baremeimpot.montantdebut  as montantdebut , "
                    . " baremeimpot.montantfin  as montantfin"
                    . " ,  baremeimpot.pourcentage as pourcentage"
                    . " from baremeimpot "
                    . " where baremeimpot.montantdebut <= " . $imposable
                    . " and baremeimpot.montantfin >= " . $imposable

            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }

    //liste des prime de societe Mois > 12

    public function executeAfficheListePrimeSoci(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $mois = $params['mois'];
            $annee = $params['annee'];
            if ($mois) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT lignesociete.codemois as id , concat(lignesociete.libelle, ' --- Code de mois: ', lignesociete.codemois) as libelle "
                        . " FROM lignesociete,societe"
                        . " WHERE lignesociete.moiscalendiarle = " . $mois
                        . " and  lignesociete.annee = " . $annee
                        . " and lignesociete.id_societe = societe.id"
                        . " and societe.id= 1"
                        . " group by lignesociete.id, lignesociete.codemois , lignesociete.libelle"
                ;
                $magPrimes = $conn->fetchAssoc($query);

                die(json_encode($magPrimes));
            }
        }

        die("Erreur");
    }

//IMPRESSION liste 

    public function executeImprimerAlllisteAllFilter(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $idag = $request->getParameter('idag');
        $idAgF = $request->getParameter('idAgF');
        $mois = $request->getParameter('mois');
        $annee = $request->getParameter('annee');
        $annee_session = $request->getParameter('annee_session');


        $pdf = new sfTCPDF();
// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des Fiches de Paie:');
        $pdf->SetSubject("document du liste Paie");
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
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(8, 30, 8);
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
        $html = $this->ReadHtmlPersonelleAll($idag, $idAgF, $mois, $annee, $annee_session);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleAll($idag, $idAgF, $mois, $annee, $annee_session) {
        $html = StyleCssHeader::header1();
        $paie = new Paie();
        $html .= $paie->ReadHtmllistePaieAllFilter($idag, $idAgF, $mois, $annee, $annee_session);

        return $html;
    }

//impression all fiches 
    public function executeImprimerAlllisteAllFilterFichesX2(sfWebRequest $request) {

        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $idag = $request->getParameter('idag');
        $idAgF = $request->getParameter('idAgF');
        $mois = $request->getParameter('mois');
        $annee = $request->getParameter('annee');
//$pdf = new sfTCPDF();
        $pdf = new sfTCPDF('L');
// remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Liste des Fiches de Paie:');
        $pdf->SetSubject("liste des Fiches Paie");
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getRs();
//  $pdf->SetAuthor($entete);
//  $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');
// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(5, 10, 5);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(5);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 0);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlPersonelleAllFichesX2($idag, $idAgF, $mois, $annee);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste des fiches de Paie' . '.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleAllFichesX2($idag, $idAgF, $mois, $annee) {
        $html = StyleCssHeader::header1();
        $paie = new Paie();
        $html .= $paie->ReadHtmllisteFichesPaieAllFilter($idag, $idAgF, $mois, $annee);

        return $html;
    }

//
    public function executeImprimerAlllisteAllFilterFiches(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $idag = $request->getParameter('idag');
        $idAgF = $request->getParameter('idAgF');
        $mois = $request->getParameter('mois');
        $annee = $request->getParameter('annee');

        $pdf = new sfTCPDF();
// remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Liste des Fiches de Paie:');
        $pdf->SetSubject("liste des Fiches de Paie");
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getRs();
//  $pdf->SetAuthor($entete);
//  $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');
// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(5, 15, 5);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(5);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 0);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlPersonelleAllFiches($idag, $idAgF, $mois, $annee);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste des Fiches de Paie' . '.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleAllFiches($idag, $idAgF, $mois, $annee) {
        $html = StyleCssHeader::header1();
        $paie = new Paie();
        $html .= $paie->ReadHtmllisteFichesPaieA4AllFilter($idag, $idAgF, $mois, $annee);

        return $html;
    }

//jounral de paie 

    public function executeImprimerAlllisteAllFilterJournalPaie(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $mois = $request->getParameter('mois');
        $annee = $request->getParameter('annee');
        $id_codesociale = $request->getParameter('id_codesociale');
        $id_codesocialeF = $request->getParameter('id_codesocialeF');
        $pdf = new sfTCPDF('L');
// remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(true);

// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche Journal de Paie:');
        $pdf->SetSubject("Fiche Journal de Paie");
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getRs();
//  $pdf->SetAuthor($entete);
//  $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');
// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(5, 10, 5);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);

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
        $html = $this->ReadHtmlPersonelleAllJournalPaie($mois, $annee, $id_codesociale, $id_codesocialeF);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Fiche Journal de Paie' . '.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleAllJournalPaie($mois, $annee, $id_codesociale, $id_codesocialeF) {
        $html = StyleCssHeader::header1();
        $paie = new Paie();
        $html .= $paie->ReadHtmllisteFichesPaieAllFilterJournalPaie($mois, $annee, $id_codesociale, $id_codesocialeF);
        return $html;
    }

//declaration
    public function executeImprimerAlllisteAllFilterDeclaration(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $trimestre = $request->getParameter('trimestre');
        $annee_declaration = $request->getParameter('annee_declaration');
        $codesociale = $request->getParameter('codesociale');
        $pdf = new sfTCPDF('L');
// remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(true);

// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche de Déclaration Trimestrielle :');
        $pdf->SetSubject("Fiche de Déclaration Trimestrielle");
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getRs();
//  $pdf->SetAuthor($entete);
//  $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');
// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(5, 10, 5);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 12);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
//        $pdf->AliasNbPages(); 
        $pdf->AddPage();
        $html = $this->ReadHtmlPersonelleAllDeclaration($trimestre, $annee_declaration, $codesociale);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Fiche de Déclaration Trimestrielle ' . '.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleAllDeclaration($trimestre, $annee_declaration, $codesociale) {
        $html = StyleCssHeader::header1();
        $paie = new Paie();
        $html .= $paie->ReadHtmllisteFichesPaieAllFilterDeclaration($trimestre, $annee_declaration, $codesociale);

        return $html;
    }

    //liste parents a charger 
    public function executeInitialiserlisteParents(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agents = $params['id'];

            $query = " select parents.nordre as norgdre , parents.nom as nom ,parents.prenom as prenom ,parents.datenaissance as daten,"
                    . " parents.etat as deceparent "
                    . " from parents"
                    . " where parents.id_agents=" . $id_agents . "";




            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocsP = $conn->fetchAssoc($query);
            die(json_encode($listedocsP));
        }
        die("bien");
    }

//etat recap 

    public function executeImprimerAlllisteAllFilterEtatrecap(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $trimestre = $request->getParameter('trimestre');
        $annee_declaration = $request->getParameter('annee_declaration');
        $codesociale = $request->getParameter('codesociale');
        $annee_session = $request->getParameter('annee_session');
        $pdf = new sfTCPDF('L');
// remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Etat Recapitulatif des Salaires');
        $pdf->SetSubject("Etat Recapitulatif des Salaires");
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getRs();
//  $pdf->SetAuthor($entete);
//  $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');
// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(5);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 12);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
//        $pdf->AliasNbPages(); 
        $pdf->AddPage();
        $html = $this->ReadHtmlPersonelleAllRecap($trimestre, $annee_declaration, $codesociale, $annee_session);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Etat Recapitulatif des Salaires' . '.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleAllRecap($trimestre, $annee_declaration, $codesociale, $annee_session) {
        $html = StyleCssHeader::header1();
        $paie = new Paie();
        $html .= $paie->ReadHtmllisteFichesPaieAllFilterRecap($trimestre, $annee_declaration, $codesociale, $annee_session);
        return $html;
    }

//recap cnrps 

    public function executeImprimerAlllisteAllFilterEtatrecapcnrps(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $mois = $request->getParameter('mois');
        $annee = $request->getParameter('annee');
        $codesociale = $request->getParameter('codesociale');
        $pdf = new sfTCPDF();
// remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Etat Recapitulatif des Salaires CNRPS');
        $pdf->SetSubject("Etat Recapitulatif des Salaires CNRPS");
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getRs();
//  $pdf->SetAuthor($entete);
//  $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');
// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(5, 5, 5);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(5);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 10);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
//        $pdf->AliasNbPages(); 
        $pdf->AddPage();
        $html = $this->ReadHtmlPersonelleAllRecapcnrps($mois, $annee, $codesociale);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Etat Recapitulatif des Salaires' . '.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleAllRecapcnrps($mois, $annee, $codesociale) {
        $html = StyleCssHeader::header1();
        $paie = new Paie();
        $html .= $paie->ReadHtmllisteFichesPaieAllFilterRecapcnrps($mois, $annee, $codesociale);
        return $html;
    }
    public function executeSavetxt(sfWebRequest $request) {
        $totaux = $request->getParameter('totaux');
        $ids = $request->getParameter('ids');
        $trimestre = $request->getParameter('trimestre');
        $annee = $request->getParameter('annee');
        $ids = explode(',,', $ids);
        $totaux = explode(';', $totaux);
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $filename = 'DS00' . $societe->getIdunique() . '.0' . $trimestre . $annee;
        $url = 'uploads/' . $filename . '.txt';
        $myfile = fopen($url, "w") or die('cannot open file : ' . $url);

        $txt = '';
        $j = 0;
        $k = 101;
        for ($i = 0; $i < sizeof($ids); $i++) {

            if ($ids[$i] != '') {
                $agent = Doctrine_Core::getTable('agents')->findOneById($ids[$i]);

                $txt.= "00" . $societe->getIdunique() . "000" . "0" . $trimestre . $annee . str_pad($k, 5, "0", STR_PAD_LEFT) .
                        trim($agent->getContrat()->getLast()->getIdunique()) . str_pad(trim(trim($agent->getPrenom()) . " " . trim($agent->getNomcomplet())), 60, " ") . trim($agent->getCin()) . "000" . str_pad(preg_replace('/[^0-9]/', '', $totaux[$j]), 17, "0") . "\n";
                $j++;
                $k++;
            }
        }
        echo ($txt);
        fwrite($myfile, $txt);
        fclose($myfile);
        throw new sfStopException();
    }

}
