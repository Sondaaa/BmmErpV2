<?php

require_once dirname(__FILE__) . '/../lib/contratGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/contratGeneratorHelper.class.php';

/**
 * contrat actions.
 *
 * @package    Bmm
 * @subpackage contrat
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contratActions extends autoContratActions {

//affiche ligne code sociale 
    public function executeIndexRegroupement(sfWebRequest $request) {
       
        $this->regroupement = RegroupementagentsTable::getInstance()->find($request->getParameter('reg'));
        $this->pager = $this->paginate($request);
        $this->agents = AgentsTable::getInstance()->getAllByRegroupemet($request->getParameter('reg'));
        $this->postes = PosterhTable::getInstance()->findAll();
        $this->unites = UniteTable::getInstance()->findAll();
        $this->id_regroupement = $request->getParameter('reg');
        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("listeRegroupement", array("pager" => $this->pager, "regroupement" => $this->regroupement));
        }
    }

    public function paginate(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $id_agents = strtoupper($request->getParameter('id_agents', ''));
        //   die($id_agents.'kk')
        $id_posterh = strtoupper($request->getParameter('id_posterh', ''));
        $id_unite = $request->getParameter('id_unite', '');
        $id_regroupement = $request->getParameter('reg', '');

        $pager = new sfDoctrinePager('Contrat', 10);
        $pager->setQuery(ContratTable::getInstance()->load($id_regroupement, $id_agents, $id_posterh, $id_unite));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeAfficheListelignecodesociale(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_code = $params['id_code'];
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT Lignecodesociale.id as id , concat(Lignecodesociale.libelle, Lignecodesociale.taux , ' %') as libelle,"
                    . "Lignecodesociale.taux as taux"
                    . " FROM Lignecodesociale"
                    . " WHERE Lignecodesociale.id_codesoc=" . $id_code;

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

//affiche ligne contribition

    public function executeAfficheListelignecontribition(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_code = $params['id_code'];
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT lignecontribitionsociale.id as id , concat(lignecontribitionsociale.libelle, lignecontribitionsociale.taux , ' %') as libelle ,"
                    . "lignecontribitionsociale.taux as taux"
                    . " FROM lignecontribitionsociale"
                    . " WHERE lignecontribitionsociale.id_contribition=" . $id_code;
            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }
        die("Erreur");
    }

    public function executeAffichedetail(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idagent = $params['idag'];
            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT agents.idrh as idrh ,agents.prenom as prenom ,agents.datenaissance as datenaissance"
                    . " FROM agents"
                    . " WHERE agents.id=" . $idagent;

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

//
    public function executeAffichedetailMilitaire(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idagent = $params['idag'];
            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT agents.idrh as idrh ,agents.prenom as prenom ,agents.datenaissance as datenaissance"
                    . " FROM agents"
                    . " WHERE agents.id=" . $idagent;

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

//calcul date retraite
    public function executeCalculdateretraite(sfWebRequest $request) {

        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $dateemposte = $params['datemeposte'];

            $nbrans = $params['nbrans'];

//            $dateretraite = floor(($nbrans + strtotime($dateemposte)) / 31556926);
            die($dateretraite);
        }

        die("Erreur");
    }

//age et date retraite
    public function executeAfficheageetdateretraite(sfWebRequest $request) {

        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $datenaissance = $params['datenaissance'];
            $dateemposte = $params['dateemposte'];
            $id_retraite = $params['id_retraite'];

            $age = floor((strtotime($dateemposte) - strtotime($datenaissance)) / 31556926);

            $retraite = Doctrine_Core::getTable('retraite')->findOneById($id_retraite);
            $anneeretraite = $retraite->getNbreanne();
            $diffans = $anneeretraite - $age;
            $end = date('Y-m-d', strtotime(date('Y-m-d', strtotime($dateemposte)) . '+' . $diffans . ' years'));
            die($end);
        }

        die("Erreur");
    }

//affcihe anciente generale
    public function executeAfficheanciennete(sfWebRequest $request) {

        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $dateemposte = $params['dateemposte'];
//  die($dateemposte);
            $_ancienete = floor((time() - strtotime($dateemposte)) / 31556926);
            die($_ancienete);
        }

        die("Erreur");
    }

//affcihe anciente dans le grade
    public function executeAfficheancienneteGrade(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $dategrade = $params['dategrade'];

            $_ancienete = floor((time() - strtotime($dategrade)) / 31556926);
            die($_ancienete);
        }

        die("Erreur");
    }

    public function executeAfficheancienneteEchelle(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $dateechelle = $params['dateechelle'];

            $_ancienete = floor((time() - strtotime($dateechelle)) / 31556926);
            die($_ancienete);
        }

        die("Erreur");
    }

    public function executeAfficheancienneteEchellon(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $dateechelon = $params['dateechelon'];

            $date1 = strtotime(date('Y-m-d H:i:s'));
            $date2 = strtotime($dateechelon);

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

            $tmp = floor(($tmp - $retour['day']) / 28);
            $retour['mois'] = $tmp;

//     $_ancienete = floor((time() - strtotime($dateechelon)) / 31556926);
//die($_ancienete);
            die($tmp);
        }



        die("Erreur");
    }

    public function executeAffichedetailTitresPrimes(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idfo = $params['idf'];
            $idcorps = $params['idsousc'];
//die('ss'.$id);
            if ($idfo && $idcorps) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT primes.id_titreprime as id ,titreprimes.libelle as libelle"
                        . " FROM primes,titreprimes"
                        . " WHERE titreprimes.id=primes.id_titreprime "
                        . " and primes.id_fonction = " . $idfo . ""
                        . "and  primes.id_corpsdet=" . $idcorps;
                $magprime = $conn->fetchAssoc($query);

                die(json_encode($magprime));
            }
        }

        die("Erreur");
    }

    public function executeSavedocumentPrime(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $listeslignesdocPrime = $params['listeslignesdocPrime'];
            $id_agents = $params['id_agents'];
            $idcontrat = $params['idcontrat'];
            if ($idcontrat) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                Doctrine_Query::create()->delete('ligneprimecontrat')
                        ->where('id_contrat=' . $idcontrat)->execute();
            }
            foreach ($listeslignesdocPrime as $lignedocPrime) {
                $idprime = $lignedocPrime['idp'];
                $nordre = $lignedocPrime['norgdre'];
                $datedebutvalide = $lignedocPrime['datedebutvalide'];
                $datefinvalide = $lignedocPrime['datefinvalide'];
//                $id = $params['idt'];
                $lignedocPrimes = new Ligneprimecontrat();
                if ($id_agents != "")
                    $lignedocPrimes->setIdAgents($id_agents);
                if ($idprime != "")
                    $lignedocPrimes->setIdPrime($idprime);
                if ($idcontrat != "")
                    $lignedocPrimes->setIdContrat($idcontrat);
                if ($nordre != "")
                    $lignedocPrimes->setNordre($nordre);
                if ($datedebutvalide != "")
                    $lignedocPrimes->setDatedebutvalidemodifprime($datedebutvalide);
                if ($datefinvalide != "")
                    $lignedocPrimes->setDatefinvalidemodifiprime($datefinvalide);
                $lignedocPrimes->save();
            }
        }
        die('ajout avec succe');
    }

    public function executeAffichedetailSalaire(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idechelle = $params['eche'];
            $idechelon = $params['echel'];

            $idgrade = $params['gra'];
            $idcategorie = $params['cat'];
            if ($idechelle || $idechelon || $idcorps || $idgrade || $idcategorie) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = " SELECT   salairedebase.id as id, salairedebase.motant as montant "
                        . " FROM salairedebase,echelle,echelon,categorierh"
                        . " WHERE salairedebase.id_categorie =" . $idcategorie
                        . " and salairedebase.id_echelle=" . $idechelle
                        . " and salairedebase.id_echelon=" . $idechelon . "Limit 1";

                if ($idgrade) {
                    $query2 = $query . " and salairedebase.id_grade=" . $idgrade . "Limit 1";
                }

                $sala = $conn->fetchAssoc($query);
                $sala2 = $conn->fetchAssoc($query);
                $resultat = array_merge($sala, $sala2);
                die(json_encode($resultat));
            }

            die("Erreur");
        }
    }

    public function executeAffichedetailPrimes(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idprime = $params['idpr'];
            $idfo = $params['idfon'];
            $idsous = $params['idsousc'];
            $idcat = $params['idca'];
            $idgr = $params['idg'];
            $idpost = $params['idpo'];
            if ($idprime || $idgr || $idcat || $idsous || $idfo) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = " SELECT   primes.id as idp, primes.montant as montant "
                        . " FROM primes,titreprimes"
                        . " WHERE primes.id_titreprime =" . $idprime;
                if ($idfo) {
                    $query = $query . " and primes.id_fonction = " . $idfo
                            . " Limit 1";
                }

                if ($idsous) {
                    $query = $query . " and primes.id_corpsdet=" . $idsous . " Limit 1";
                }

                $query2 = " SELECT   primes.id as idp, primes.montant as montant "
                        . " FROM primes,titreprimes"
                        . " WHERE primes.id_titreprime =" . $idprime
                ;
                if ($idcat) {
                    $query2 = $query2 . " and primes.id_categorie = " . $idcat;
                }


                if ($idgr) {
                    $query2 = $query2 . " and primes.id_grade = " . $idgr;
                }



                $query3 = "SELECT   primes.id as idp, primes.montant as montant "
                        . " FROM primes,titreprimes"
                        . " WHERE primes.id_titreprime =" . $idprime;
                if ($idpost) {
                    $query3 = $query3 . " and primes.id_poste = " . $idpost . " Limit 1";
                }

                $prim = $conn->fetchAssoc($query);
                $prim2 = $conn->fetchAssoc($query2);

                $prim3 = $conn->fetchAssoc($query3);

                $result = array_merge($prim, $prim2);
                $result1 = array_merge($result, $prim3);
                die(json_encode($result1));
            }

            die("Erreur");
        }
    }

    public function executeAffichedetailTitresPrimesbyposte(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idpos = $params['idposte'];

            if ($idpos) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT primes.id_titreprime as id ,titreprimes.libelle as libelle"
                        . " FROM primes,titreprimes"
                        . " WHERE titreprimes.id=primes.id_titreprime "
                        . " and primes.id_poste = " . $idpos;
                $magprime = $conn->fetchAssoc($query);

                die(json_encode($magprime));
            }
        }

        die("Erreur");
    }

    public function executeAffichedetailTitresPrimesDetaille(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idc = $params['idca'];

            $idg = $params['idgr'];

            if ($idc && $idg) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT primes.id_titreprime as id ,titreprimes.libelle as libelle"
                        . " FROM primes,titreprimes"
                        . " WHERE titreprimes.id=primes.id_titreprime "
                        . " and primes.id_categorie = " . $idc . ""
                        . " and primes.id_grade = " . $idg . ""
                //    ." group By id"
                ;
                $magprime = $conn->fetchAssoc($query);

                die(json_encode($magprime));
            }
        }

        die("Erreur");
    }

    public function executeAffichedetailtache(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idposte = $params['idp']; //die('ss'.$id);
            if ($idposte) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT taches.id as id , taches.libelle as libelle "
                        . " FROM taches"
                        . " WHERE taches.id_posterh = " . $idposte;
                $magtache = $conn->fetchAssoc($query);

                die(json_encode($magtache));
            }
        }

        die("Erreur");
    }

    public function executeSavedocumentTaches(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $listeslignesdocTaches = $params['listeslignesdocTaches'];
            $id_agents = $params['id_agents'];

            foreach ($listeslignesdocTaches as $lignedocTache) {

                $magtache = $lignedocTache['magtache'];



                $lignedocTache = new Lignetachesagents();

                if ($id_agents != "")
                    $lignedocTache->setIdAgents($id_agents);
                if ($magtache != "")
                    $lignedocTache->setIdTache($magtache);



                $lignedocTache->save();
            }
        }
        die('ajout avec succe');
    }

    public function executeAffichedetailCatByCorps(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idcorps = $params['idc']; //die('ss'.$id);
            if ($idcorps) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT categorierh.id as id , categorierh.libelle as libelle "
                        . " FROM categorierh,corps"
                        . " WHERE categorierh.id_corps =corps.id "
                        . " and corps.id= " . $idcorps
                        . " group by categorierh.id ";


                $resultat = $conn->fetchAssoc($query);

                die(json_encode($resultat));
            }
        }

        die("Erreur");
    }

///affiche grade by corps 

    public function executeAffichedetailGByCorps(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idcorps = $params['idc']; //die('ss'.$id);
            if ($idcorps) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT grade.id as id , grade.libelle as libelle "
                        . " FROM grade,corps,corpsdet"
                        . " WHERE grade.id_corpsdet =corpsdet.id "
                        . " and corpsdet.id_corps= corps.id"
                        . " and corpsdet.id= " . $idcorps;


                $resultat = $conn->fetchAssoc($query);

                die(json_encode($resultat));
            }
        }

        die("Erreur");
    }

//affiche detail Grade by corps 

    public function executeAffichedetailGradeRByCorps(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idcorps = $params['idc']; //die('ss'.$id);
            if ($idcorps) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT grade.id as id , grade.libelle as libelle "
                        . " FROM grade,corps,corpsdet"
                        . " WHERE grade.id_corpsdet =corpsdet.id "
                        . " and corpsdet.id_corps= corps.id"
                        . " and corpsdet.id= " . $idcorps;


                $resultat = $conn->fetchAssoc($query);

                die(json_encode($resultat));
            }
        }

        die("Erreur");
    }

//affichage detail grade T by corps 

    public function executeAffichedetailGradeTByCorps(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idcorps = $params['idc']; //die('ss'.$id);
            if ($idcorps) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT grade.id as id , grade.libelle as libelle "
                        . " FROM grade,corps,corpsdet"
                        . " WHERE grade.id_corpsdet =corpsdet.id "
                        . " and corpsdet.id_corps= corps.id"
                        . " and corpsdet.id= " . $idcorps;
                $resultat = $conn->fetchAssoc($query);

                die(json_encode($resultat));
            }
        }

        die("Erreur");
    }

    public function executeDeletetache(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        $params = json_decode($content, true);
        $id = $params['idt'];
        if ($id) {
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

            Doctrine_Query::create()->delete('taches')
                    ->where('id=' . $id)->execute();
            die("supression avec succee !!");
//  $contrat = new Contrat(); $this->redirect('contrat/edit?id='.$contrat->getId()."");   die($contrat->getId() . "");
        }
        die("erreuur!!!!");
    }

    public function executeDelete(sfWebRequest $request) {
        $iddoc = $request->getParameter('id');
//_________suppr. ligne doc historique

        Doctrine_Query::create()->delete('historiquepromotion')
                ->where('id_contrat=' . $iddoc)->execute();

        Doctrine_Query::create()->delete('historiquelieudetravail')
                ->where('id_contrat=' . $iddoc)->execute();
        Doctrine_Query::create()->delete('historiquefonctions')
                ->where('id_contrat=' . $iddoc)->execute();
        Doctrine_Query::create()->delete('historiquesitautionadministrative')
                ->where('id_contrat=' . $iddoc)->execute();
        Doctrine_Query::create()->delete('historiquepositionsadministrative')
                ->where('id_contrat=' . $iddoc)->execute();



        Doctrine_Query::create()->delete('ligneprimecontrat')
                ->where('id_contrat=' . $iddoc)->execute();

        $this->forward404Unless($contrat = Doctrine_Core::getTable('contrat')->find(array($request->getParameter('id'))), sprintf('Object fiche does not exist (%s).', $request->getParameter('id')));

        $contrat->delete();
        $this->redirect('@contrat');
    }

    public function executeEdit(sfWebRequest $request) {

        $this->contrat = Doctrine_Core::getTable('contrat')->findOneById($request->getParameter('id'));
        $this->form = $this->configuration->getForm($this->contrat);
//        if ($this->form->getObject()->getIdSalairedebase() != null) {
        $resultat = Doctrine_Query::create()
                ->select("salairedebase.id_echelle as echelle , salairedebase.id_echelon as echelon,salairedebase.id_grade as grade ,salairedebase.id_categorie as categorie")
                ->from('salairedebase');
        if ($this->form->getObject()->getIdSalairedebase() != '')
            $resultat->where('id=' . $this->form->getObject()->getIdSalairedebase());
        $resultat->execute();
//        }
        $this->resultat = $resultat;
//        die( count($resultat)."ee");
        $this->id_regerouppement = $request->getParameter('reg', '');
        if ($this->id_regerouppement != '')
            $this->regroupement = RegroupementagentsTable::getInstance()->find($this->id_regerouppement);
        else
            $this->regroupement = null;

//        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//        $query = "SELECT salairedebase.id_echelle as echelle , salairedebase.id_echelon as echelon,salairedebase.id_grade as grade ,salairedebase.id_categorie as categorie "
//                . "FROM   salairedebase "
//                . " WHERE   salairedebase.id=" . $this->form->getObject()->getIdsalaire();
//        $this->resultat = $conn->fetchAssoc($query);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->contrat = $this->form->getObject();
//        $this->reg=$request->getParameter('reg', '');
//        $this->regroupement = RegroupementagentsTable::getInstance()->findOneById($request->getParameter('reg'));
        $id_regerouppement = $request->getParameter('reg', '');
        $this->id_regerouppement = $request->getParameter('reg', '');
//        die($this->id_regerouppement .'mmmmm');
        $this->regroupement = RegroupementagentsTable::getInstance()->find($request->getParameter('reg'));
    }

    public function executeAffichelignePrimes(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Contrat = $params['id'];

            $query = "select primes.id as idprime "
                    . " ,ligneprimecontrat.nordre as norgdre "
                    . " , ligneprimecontrat.id_prime as idp,"
                    . " primes.id_titreprime as nordre, titreprimes.libelle as magprime "
                    . " ,primes.montant as montantp ,"
                    . " ligneprimecontrat.datedebutvalidemodifprime as datedebutvalide "
                    . " , ligneprimecontrat.datefinvalidemodifiprime as datefinvalide"
                    . " from ligneprimecontrat,primes,titreprimes"
                    . " where ligneprimecontrat.id_contrat=" . $id_Contrat . ""
                    . " and ligneprimecontrat.id_prime=primes.id "
                    . " and titreprimes.id=primes.id_titreprime";
// . " order by ligneprimecontrat.id asc";


            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocsPrime = $conn->fetchAssoc($query);
            die(json_encode($listedocsPrime));
        }
        die("bien");
    }

//historique des promotions
    public function executeAfficheligneHistorique(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Contrat = $params['id'];

            $query = "select historiquepromotion.id as id, historiquepromotion.id_nature as idnature, naturepromotion.libelle as naturepromotion , historiquepromotion.dateeffet as dateeffet, historiquepromotion.datesysteme as datesys ,historiquepromotion.grade as  idgrade, grade.libelle as grade   "
                    . " from historiquepromotion , grade,naturepromotion"
                    . " where historiquepromotion.id_contrat=" . $id_Contrat . ""
                    . " and historiquepromotion.grade=grade.id "
                    . " and historiquepromotion.id_nature=naturepromotion.id ";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listesPromotions = $conn->fetchAssoc($query);
            die(json_encode($listesPromotions));
        }
        die("bien");
    }

//historique des Fonctions
    public function executeAfficheligneHistoriqueFonctions(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Contrat = $params['id'];

            $query1 = "select historiquefonctions.id as id,"
                    . " historiquefonctions.id_fonction as idfonction, "
                    . " fonction.description as fonction ,  "
                    . " historiquefonctions.datesysteme as datesys   "
                    . " from historiquefonctions ,fonction"
                    . " where  historiquefonctions.id_fonction=fonction.id "
                    . " and historiquefonctions.id_contrat=" . $id_Contrat . ""
            ;

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listesFonctions = $conn->fetchAssoc($query1);
            die(json_encode($listesFonctions));
        }
        die("bien");
    }

//historique des Lieu de travail
    public function executeAfficheligneHistoriqueLieu(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Contrat = $params['id'];

            $query = "select historiquelieudetravail.id as id, historiquelieudetravail.id_lieu as dilieu, lieutravail.libelle as lieu ,  historiquelieudetravail.datesyteme as datesys   "
                    . " from historiquelieudetravail ,lieutravail"
                    . " where historiquelieudetravail.id_contrat=" . $id_Contrat . ""
                    . " and historiquelieudetravail.id_lieu=lieutravail.id ";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listeslieu = $conn->fetchAssoc($query);
            die(json_encode($listeslieu));
        }
        die("bien");
    }

//historique des situations administratives
    public function executeAfficheligneHistoriqueSituation(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Contrat = $params['id'];

            $query = "select historiquesitautionadministrative.id as id, historiquesitautionadministrative.id_typecontrat as idtype, typecontrat.libelle as situations ,  historiquesitautionadministrative.datesysteme as datesys   "
                    . " from historiquesitautionadministrative ,typecontrat"
                    . " where historiquesitautionadministrative.id_contrat=" . $id_Contrat . ""
                    . " and historiquesitautionadministrative.id_typecontrat=typecontrat.id ";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listesS = $conn->fetchAssoc($query);
            die(json_encode($listesS));
        }
        die("bien");
    }

    //historique des salaire de base 
    public function executeAfficheligneHistoriqueSalaire(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Contrat = $params['id'];
            $query = "select historiquesalaire.id as id,"
                    . " historiquesalaire.salairebase as salaire, "
                    . " historiquesalaire.datemodification as date ,historiquesalaire.id_salaire as idsalaire "
                    . " from historiquesalaire "
                    . " where historiquesalaire.id_contrat=" . $id_Contrat . ""
            ;

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listesS = $conn->fetchAssoc($query);
            die(json_encode($listesS));
        }
        die("bien");
    }

//historique des positions administratives
    public function executeAfficheligneHistoriquePosition(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Contrat = $params['id'];

            $query = "select historiquepositionsadministrative.id as id, historiquepositionsadministrative.id_positionadmini as idtype, positionadministratif.libelle as positions ,  historiquepositionsadministrative.datesysteme as datesys   "
                    . " from historiquepositionsadministrative ,positionadministratif"
                    . " where historiquepositionsadministrative.id_contrat=" . $id_Contrat . ""
                    . " and historiquepositionsadministrative.id_positionadmini=positionadministratif.id ";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listesP = $conn->fetchAssoc($query);
            die(json_encode($listesP));
        }
        die("bien");
    }

    public function executeSavedocumentContrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $datepro = $params['datepromotion'];
            $dategra = $params['dategrade'];
            $naturepro = $params['naturepromotion'];
            $grade = $params['grade'];
            $id_agents = $params['id_agents'];
            $typecontrat = $params['type_contrat'];
            $idfonction = $params['id_fonction'];
            $idlieu = $params['id_lieu'];
            $idsituation = $params['id_situation'];
            $dateemposte = $params['dateemposte'];
            $datetitu = $params['datetitularisation'];
            $graderec = $params['graderecretement'];
            $gradetitu = $params['gradetitu'];
            $montant = $params['montant'];
            $idsalaire = $params['idsalaire'];
            $dateechelle = $params['dateechelle'];
            $dateechelon = $params['dateechelon'];
            $idposte = $params['idposte'];
            $id_retratite = $params['id_retratite'];
            $dateretaite = $params['dateretaite'];
            $id_unite = $params['id_unite'];
            $id = $params['id'];
            $contrat = new Contrat();
            if ($id != "") {
                $contra = Doctrine_Core::getTable('contrat')->findOneById($id);
                if ($contra)
                    $contrat = $contra;
            }
            if ($idposte != "")
                $contrat->setIdPosterh($idposte);
//            else
//                $contrat->setIdPosterh(NULL);
            if ($dateechelon != "")
                $contrat->setDateechelon($dateechelon);
            if ($id_agents != "")
                $contrat->setIdAgents($id_agents);
            if ($datetitu != "")
                $contrat->setDatetitulaire($datetitu);
            if ($montant != "")
                $contrat->setMontant($montant);
            if ($typecontrat != "")
                $contrat->setIdTypecontrat($typecontrat);
            if ($idfonction != "")
                $contrat->setIdFonction($idfonction);
            if ($idlieu != "")
                $contrat->setIdLieu($idlieu);
            if ($idsituation != "")
                $contrat->setIdPositionadmini($idsituation);
            if ($dategra != "")
                $contrat->setDategrade($dategra);
            if ($dateemposte != "")
                $contrat->setDateemposte($dateemposte);
            if ($gradetitu != "")
                $contrat->setIdGradetitu($gradetitu);
            if ($grade != "")
                $contrat->setIdGrade($grade);
            if ($graderec != "")
                $contrat->setIdGraderec($graderec);
            if ($dateechelle != "")
                $contrat->setDateechelle($dateechelle);
            if ($idsalaire != "")
                $contrat->setIdSalairedebase($idsalaire);
            if ($datepro != "")
                $contrat->setDatepromotions($datepro);
            if ($naturepro != "")
                $contrat->setIdNaturepromo($naturepro);
            if ($id_retratite != "")
                $contrat->setIdRetratite($id_retratite);
            if ($dateretaite != "")
                $contrat->setDateretraite($dateretaite);
            if ($id_unite != "")
                $contrat->setIdUnite($id_unite);

            $contrat->save();
            die($contrat->getId() . "");
        }
        die("erreurr !!!");
    }

//saave contrat 

    public function executeSaveContrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $datepro = $params['datepromotion'];
            $dategra = $params['dategrade'];
            $naturepro = $params['naturepromotion'];
            $grade = $params['grade'];
            $id_agents = $params['id_agents'];
            $typecontrat = $params['type_contrat'];
            $idfonction = $params['id_fonction'];
            $idlieu = $params['id_lieu'];
            $idsituation = $params['id_situation'];
            $dateemposte = $params['dateemposte'];
            $datetitu = $params['datetitularisation'];
            $graderec = $params['graderecretement'];
            $gradetitu = $params['gradetitu'];
            $montant = $params['montant'];
            $idsalaire = $params['idsalaire'];
            $dateechelle = $params['dateechelle'];
            $dateechelon = $params['dateechelon'];
            $idposte = $params['idposte'];
            $id_retratite = $params['id_retratite'];
            $dateretaite = $params['dateretaite'];
            $id_regime = $params['id_regime'];

            $id_codesociale = $params['id_codesociale'];
            $idunique = $params['idunique'];
            $dateaffiliation = $params['dateaffiliation'];
            $salairetheorique = $params['salairetheorique'];

            $datevalidationdemodification = $params['datevalidationdemodification'];
            $id_lignecodesociale = $params['id_lignecodesociale'];
            $id_contribition = $params['id_contribition'];
            $id_lignecontribition = $params['id_lignecontribition'];
            $total_taux = $params['total_taux'];
            $id_unite = $params['id_unite'];
            $specialite = $params['specialite'];
            $id = $params['id'];
            $contrat = new Contrat();
            if ($id != "") {
                $contrat = ContratTable::getInstance()->findOneById($id);
            }
            if ($idposte != "")
                $contrat->setIdPosterh($idposte);
//            else
//                $contrat->setIdPosterh(NULL);

            if ($id_codesociale != "")
                $contrat->setIdCodesociale($id_codesociale);
            if ($id_unite != "")
                $contrat->setIdUnite($id_unite);

            if ($specialite != "")
                $contrat->setSpecialite($specialite);
            if ($idunique != "")
                $contrat->setIdunique($idunique);
            if ($dateaffiliation != "")
                $contrat->setDateaffiliation($dateaffiliation);
            if ($salairetheorique != "")
                $contrat->setSalairetheorique($salairetheorique);

            if ($dateechelon != "")
                $contrat->setDateechelon($dateechelon);
            if ($id_agents != "")
                $contrat->setIdAgents($id_agents);
            if ($datetitu != "")
                $contrat->setDatetitulaire($datetitu);
            if ($montant != "")
                $contrat->setMontant($montant);
            if ($typecontrat != "")
                $contrat->setIdTypecontrat($typecontrat);
            if ($idfonction != "")
                $contrat->setIdFonction($idfonction);
            if ($idlieu != "")
                $contrat->setIdLieu($idlieu);
            if ($idsituation != "")
                $contrat->setIdPositionadmini($idsituation);
            if ($dategra != "")
                $contrat->setDategrade($dategra);
            if ($dateemposte != "")
                $contrat->setDateemposte($dateemposte);
            if ($gradetitu != "")
                $contrat->setIdGradetitu($gradetitu);
//            if ($grade != "")
//                $contrat->setIdGrade($grade);
            if ($graderec != "")
                $contrat->setIdGraderec($graderec);
            if ($dateechelle != "")
                $contrat->setDateechelle($dateechelle);
            if ($id_regime != "")
                $contrat->setIdRegime($id_regime);
            if ($datevalidationdemodification != "")
                $contrat->setDatevalidesalaire($datevalidationdemodification);
            if ($idsalaire != "")
                $contrat->setIdSalairedebase($idsalaire);
            if ($datepro != "")
                $contrat->setDatepromotions($datepro);
            if ($naturepro != "")
                $contrat->setIdNaturepromo($naturepro);
            if ($id_retratite != "")
                $contrat->setIdRetratite($id_retratite);
            if ($dateretaite != "")
                $contrat->setDateretraite($dateretaite);




            if ($id_lignecodesociale != "")
                $contrat->setIdLignecodesociale($id_lignecodesociale);
            if ($id_contribition != "")
                $contrat->setIdContribiton($id_contribition);
            if ($id_lignecontribition != "")
                $contrat->setIdLignecontribition($id_lignecontribition);
            if ($total_taux != "")
                $contrat->setTotaltauxsociale($total_taux);


            $contrat->save();

            if ($naturepro != "") {
                $historiquepromotions_ancien = HistoriquepromotionTable::getInstance()->findByIdContratAndIdNature($contrat->getId(), $naturepro);
                if ($historiquepromotions_ancien->count() == 0) {
                    $historique = new Historiquepromotion();
                    $historique->setIdNature($naturepro);
                    if ($grade != "")
                        $historique->setGrade($grade);
                    $historique->setDatesysteme(date('Y-m-d'));
                    if ($datepro != "")
                        $historique->setDateeffet($datepro);
                    $historique->setIdContrat($contrat->getId());
                    $historique->save();
                }
                else {
                    //rien a faire    
                }
            }
            if ($idsalaire != "") {
                $historiquesalaire_ancien = HistoriquesalaireTable::getInstance()->findByIdContratAndIdSalaire($contrat->getId(), $idsalaire);
                if ($historiquesalaire_ancien->count() == 0) {
                    $historique = new Historiquesalaire();
                    if ($montant != "")
                        $historique->setSalairebase($montant);
                    if ($datevalidationdemodification != "")
                        $historique->setDatemodification($datevalidationdemodification);

                    if ($idsalaire != "")
                        $historique->setIdSalaire($idsalaire);
                    $historique->setIdContrat($contrat->getId());
                    $historique->save();
                }
                else {
                    //rien a faire    
                }
            }
            if ($idfonction != "") {
                $historiquefonctions_ancien = HistoriquefonctionsTable::getInstance()->findByIdContratAndIdFonction($contrat->getId(), $idfonction);
                if ($historiquefonctions_ancien->count() == 0) {
                    $historiquefonctions = new Historiquefonctions();
                    $historiquefonctions->setIdFonction($idfonction);
                    $historiquefonctions->setIdContrat($contrat->getId());
                    $historiquefonctions->setDatesysteme(date('Y-m-d'));
                    $historiquefonctions->save();
                } else {
                    //rien a faire
                }
            }

            if ($idlieu != "") {
                $historiquelieutravail_ancien = HistoriquelieudetravailTable::getInstance()->findByIdContratAndIdLieu($contrat->getId(), $idlieu);
                if ($historiquelieutravail_ancien->count() == 0) {
                    $historiquelieudetravail = new Historiquelieudetravail();
                    $historiquelieudetravail->setIdLieu($idlieu);
                    $historiquelieudetravail->setIdContrat($contrat->getId());
                    $historiquelieudetravail->setDatesyteme(date('Y-m-d'));
                    $historiquelieudetravail->save();
                } else {
                    //rien a faire    
                }
            }
            if ($typecontrat != "") {
                $historiquesituation_ancien = HistoriquesitautionadministrativeTable::getInstance()->findByIdContratAndIdTypecontrat($contrat->getId(), $typecontrat);
                if ($historiquesituation_ancien->count() == 0) {
                    $historiquesitautionadministrative = new Historiquesitautionadministrative();
                    $historiquesitautionadministrative->setIdTypecontrat($typecontrat);
                    $historiquesitautionadministrative->setIdContrat($contrat->getId());
                    $historiquesitautionadministrative->setDatesysteme(date('Y-m-d'));
                    $historiquesitautionadministrative->save();
                } else {
                    //rien a faire
                }
            }

            if ($idsituation != "") {
                $historiqueposition_ancien = HistoriquepositionsadministrativeTable::getInstance()->findByIdContratAndIdPositionadmini($contrat->getId(), $idsituation);
                if ($historiqueposition_ancien->count() == 0) {
                    $historiquepositionsadministrative = new Historiquepositionsadministrative();
                    $historiquepositionsadministrative->setIdPositionadmini($idsituation);
                    $historiquepositionsadministrative->setIdContrat($contrat->getId());
                    $historiquepositionsadministrative->setDatesysteme(date('Y-m-d'));
                    $historiquepositionsadministrative->save();
                } else {
                    //rien a faire
                }
            }

            $query = "select contrat.id as id, agents.id_regrouppement as id_regroupement"
                    . " from contrat ,agents"
                    . " where contrat.id_agents=agents.id"
                    . " and contrat.id = " . $contrat->getId();

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listesP = $conn->fetchAssoc($query);
            die(json_encode($listesP));
//            $resultat = array();
//             $id = $resultat[$contrat->getId(),$contrat->getId()];
//            die($contrat->getId() . "");
        }
        die("erreurr !!!");
    }

//save contrat du personne militaire

    public function executeSaveContratmilitaire(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agents = $params['id_agents'];

            $idposte = $params['idposte'];
            $id_unite = $params['id_unite'];
            $id_grade = $params['id_grade'];
            $dateemposte = $params['dateemposte'];

            $specialite = $params['specialite'];
            $id = $params['id'];
            $contrat = new Contrat();
            if ($id != "") {
                $contrat = ContratTable::getInstance()->findOneById($id);
            }
            if ($idposte != "")
                $contrat->setIdPosterh($idposte);
            if ($id_agents != "")
                $contrat->setIdAgents($id_agents);
            if ($id_unite != "")
                $contrat->setIdUnite($id_unite);
            if ($id_grade != "")
                $contrat->setIdGraderec($id_grade);
            if ($dateemposte != "")
                $contrat->setDateemposte($dateemposte);
            if ($specialite != "")
                $contrat->setSpecialte($specialite);

            $contrat->save();

            die($contrat->getId());
        }
        die("erreurr !!!");
    }

//___________________________afficahe agents
    public function executeListeAgents(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $q = Doctrine_Query::create()
                ->select("agents.id as qtemax, agents.nomcomplet as name,agents.idrh as ref ")
                ->from('agents');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $agent = strtoupper($params['ag']);
            $ref = strtoupper($params['ref']);
            if ($agent != "")
                $q = $q->where("upper(nomcomplet) like '%" . $agent . "%' or upper(idrh) like '%" . $agent . "%' or upper(prenom) like '%" . $agent . "%'");

            if ($ref != "")
                $q = $q->Where("upper(idrh) like '%" . $ref . "%'");
        }
        $q = $q->orderBy('id desc')->limit('100');

        $listeagents = $q->fetchArray();
        die(json_encode($listeagents));
    }

    public function executeAfficheIDagents(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $matricule = $params['matr'];
            $nom = $params['nom'];

            $ag = new Agents();
            $agent = Doctrine_Core::getTable('agents')->findOneByIdrhAndNomcomplet($matricule, $nom);
            if ($agent)
                $ag = $agent;

            die($ag->getId() . "");
        }

        die("Erreur");
    }

    public function executeAfficheDetailagents(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idagents = $params['id'];
            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT agents.id, agents.nomcomplet as nom ,agents.idrh as idrh "
                    . " FROM agents,contrat"
                    . " WHERE agents.id=" . $idagents . " Limit 1";

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    public function executeListeAgents1(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $params = json_decode($content, true);

        $numero = $params['ag'];
        if ($numero) {
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT agents.id as id , concat( agents.nomcomplet ,' - ',agents.idrh ) as name"
                    . " FROM agents"
                    . " WHERE agents.nomcomplet LIKE '" . $numero . "%'"
                    . " ORDER BY agents.nomcomplet";
            $listeagents = $conn->fetchAssoc($query);

            die(json_encode($listeagents));
        }die('Erreur');
//      
    }

    public function executeImprimerFiche(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('iddoc');
        $pdf = new sfTCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche Contrat ');
        $pdf->SetSubject("Fiche Contrat ");
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
        $pdf->Output('Fiche Contrat ' . '.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFiche($id) {
        $html = StyleCssHeader::header1();
        $contrat = new Contrat();

        $html .= $contrat->ReadHtmlFicheContrat($id);

        return $html;
    }

    public function executeImprimerFicheDonneeBase(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Contrat ');
        $pdf->SetSubject("Fiche Contrat ");
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
        $html = $this->ReadHtmlFicheDonnedebase($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Fiche Contrat ' . '.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFicheDonnedebase($id) {
        $html = StyleCssHeader::header1();
        $contrat = new Contrat();
        $html .= $contrat->ReadHtmlFicheDonnedebase($id);

        return $html;
    }

    public function executeImprimerFicheHistorique(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Contrat ');
        $pdf->SetSubject("Fiche Contrat ");
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
        $pdf->Output('Fiche Contrat ' . '.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFicheHistorique($id) {
        $html = StyleCssHeader::header1();
        $contrat = new Contrat();
        $html .= $contrat->ReadHtmlFicheHistorique($id);

        return $html;
    }

    public function executeImprimerFicheSalariale(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Contrat ');
        $pdf->SetSubject("Fiche Contrat ");
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
        $html = $this->ReadHtmlFicheSalariale($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Fiche Contrat ' . '.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFicheSalariale($id) {
        $html = StyleCssHeader::header1();
        $contrat = new Contrat();
        $html .= $contrat->ReadHtmlFicheSalariale($id);

        return $html;
    }

    public function executeImprimerFicheTache(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Contrat ');
        $pdf->SetSubject("Fiche Contrat ");
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
        $html = $this->ReadHtmlFicheTache($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Fiche Contrat ' . '.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFicheTache($id) {
        $html = StyleCssHeader::header1();
        $contrat = new Contrat();
        $html .= $contrat->ReadHtmlFicheTache($id);

        return $html;
    }

    public function executeImprimerFichePrime(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Contrat ');
        $pdf->SetSubject("Fiche Contrat ");
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
        $html = $this->ReadHtmlFichePrimes($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Fiche Contrat ' . '.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFichePrimes($id) {
        $html = StyleCssHeader::header1();
        $contrat = new Contrat();
        $html .= $contrat->ReadHtmlFichePrimes($id);

        return $html;
    }

    public function executeImprimerFicheHistoriquePromotion(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Contrat ');
        $pdf->SetSubject("Fiche Contrat ");
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
        $html = $this->ReadHtmlFichePromotions($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Fiche Contrat ' . '.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFichePromotions($id) {
        $html = StyleCssHeader::header1();
        $contrat = new Contrat();
        $html .= $contrat->ReadHtmlFicheHistoriquepromotion($id);

        return $html;
    }

//impresion historique salaire 

    public function executeImprimerFicheHistoriqueSalaire(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');
        $pdf = new sfTCPDF();
// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Contrat ');
        $pdf->SetSubject("Fiche Contrat ");
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
        $html = $this->ReadHtmlFicheSalaire($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Fiche Contrat ' . '.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFicheSalaire($id) {
        $html = StyleCssHeader::header1();
        $contrat = new Contrat();
        $html .= $contrat->ReadHtmlFicheHistoriquesalaire($id);

        return $html;
    }

//affichage des corps det apartir du corps 
    public function executeAffichecorpsdet(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idcorps = $params['idcorps']; //die('ss'.$id);
            if ($idcorps) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT corpsdet.id as id , corpsdet.libelle as libelle "
                        . " FROM corps,corpsdet"
                        . " WHERE corpsdet.id_corps =corps.id "
                        . " and corps.id= " . $idcorps;
                $resultat = $conn->fetchAssoc($query);
                die(json_encode($resultat));
            }
        }

        die("Erreur");
    }

    //affiche regime par defaut 
    public function executeAfficheregimepardefaut(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        $params = json_decode($content, true);
        $id_dossier = 1;
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $query = "SELECT  ligneregimehoraire.id_regime as id_regime "
                . " FROM ligneregimehoraire,dossiercomptable"
                . " WHERE ligneregimehoraire.id_dossier=dossiercomptable.id "
                . " and dossiercomptable.id =" . $id_dossier
                . " and ligneregimehoraire.pardefaut= true ";
        $resultat = $conn->fetchAssoc($query);
        die(json_encode($resultat));
    }

//impression suivi de carriere 

    public function executeImprimerListeCarriere(sfWebRequest $request) {
        $pdf = new sfTCPDF('L');
// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Liste Des Suivis des Carrières   ');
        $pdf->SetSubject("Liste Des Suivis des Carrières    ");
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
     $pdf->SetAutoPageBreak(TRUE, 10);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlListeCariere($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste des Suivis des Carrières  .pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeCariere(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $aide = new Contrat();
        $html .= $aide->ReadHtmlListeCarreire($request);
        return $html;
    }

}
