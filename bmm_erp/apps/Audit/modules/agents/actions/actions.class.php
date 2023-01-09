<?php

require_once dirname(__FILE__) . '/../lib/agentsGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/agentsGeneratorHelper.class.php';

/**
 * agents actions.
 *
 * @package    Bmm
 * @subpackage agents
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class agentsActions extends autoAgentsActions {

    public function executeIndexRegroupement(sfWebRequest $request) {
        $this->regroupement = RegroupementagentsTable::getInstance()->find($request->getParameter('reg'));
        $this->pager = $this->paginate($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("listeRegroupement", array("pager" => $this->pager, "regroupement" => $this->regroupement));
        }
    }

    public function paginate(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $matricule = strtoupper($request->getParameter('matricule', ''));
        $nom = strtoupper($request->getParameter('nom', ''));
        $prenom = $request->getParameter('prenom', '');
        $id_regroupement = $request->getParameter('reg', '');

        $pager = new sfDoctrinePager('Agents', 10);
        $pager->setQuery(AgentsTable::getInstance()->load($matricule, $nom, $prenom, $id_regroupement));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    //test cin existe ou nn
    public function executeTestcin(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $cin = $params['cin'];

            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT  agents.id as id,agents.idrh as idrh "
                    . " FROM agents"
                    . " WHERE agents.cin='" . $cin . "'";
//. " WHERE CAST(agents.cin AS Character)='". $cin."'";

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    //test matricule existe ou nn 
    public function executeTestidrh(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idrh'];

            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT agents.id as id, agents.cin as cin "
                    . " FROM agents"
                    . " WHERE agents.idrh ='" . $id . "'";

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    public function executeIndex(sfWebRequest $request) {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();
    }

    //i nom in popup
    public function executeAffichedetailNom(sfWebRequest $request) {
        $idag = $request->getParameter('id');
        $ag = Doctrine_Core::getTable('agents')->findOneByIdrh($idag);
        return $this->renderText($ag->getNomcomplet());
    }

    //charger nomfin in popup 
    public function executeAffichedetailNomFin(sfWebRequest $request) {
        $idag = $request->getParameter('id');
        //  if($idag==$this->)
        $ag = Doctrine_Core::getTable('agents')->findOneByIdrh($idag);
        return $this->renderText($ag->getNomcomplet());
    }

//charger direction

    public function executeAffichedetaildirection(sfWebRequest $request) {
        $idag = $request->getParameter('id');
        $ag = Doctrine_Core::getTable('direction')->findOneById($idag);
        return $this->renderText($ag->getLibelle());
    }

    public function executeListeagents(sfWebRequest $request) {
        $this->pager = $this->getAllAgents($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("listagents", array("pager" => $this->pager));
        }
    }

    function getAllAgents(sfWebRequest $request) {
        $nomcomplet = $request->getParameter('nomcomplet', '');
        $idrh = $request->getParameter('idrh', '');
        $cin = $request->getParameter('cin', '');
        $pager = new sfDoctrinePager('agents', 10);
        $pager->setQuery(AgentsTable::getInstance()->getAllPagerAgents($nomcomplet, $idrh, $cin));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeShowAgents(sfWebRequest $request) {
        $this->agents = AgentsTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeRemplirattestationdetravail(sfWebRequest $request) {
        
    }

    public function executeAttestationdesalaire(sfWebRequest $request) {
        
    }

    public function executeAfficheage(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $datenaissance = $params['datenaissance'];

            $_age = floor((time() - strtotime($datenaissance)) / 31556926);
            die($_age);
        }

        die("Erreur");
    }

//parametre iddebut idfin pour rechreche
    public function executeCharegrId(sfWebRequest $request) {

        $idde = $request->getParameter('id1');
        $idfin = $request->getParameter('id2');
        return $this->renderPartial("listagents", array("idde" => $idde, "idfin" => $idfin));
    }

    public function executeChargerdirection(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("listeagentsdirection", array("idd" => $idd));
    }

    public function executeChargerdirectiondebutfin(sfWebRequest $request) {

        $idd = $request->getParameter('idd');
        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');

        return $this->renderPartial("listeagentsdirectionetagents", array("idd" => $idd, "id1" => $id1, "id2" => $id2));
    }

    public function executeChargersousdirectionetagents(sfWebRequest $request) {

        $idd = $request->getParameter('idd');
        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');

        return $this->renderPartial("listeagentssousdirectionetagents", array("idd" => $idd, "id1" => $id1, "id2" => $id2));
    }

    public function executeChargerserviceetagents(sfWebRequest $request) {

        $idd = $request->getParameter('idd');
        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');

        return $this->renderPartial("listeagentsserviceetagents", array("idd" => $idd, "id1" => $id1, "id2" => $id2));
    }

    //parametre de sousdirection pour le recherche 
    public function executeChargersousdirection(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("listeagentssousdirection", array("idd" => $idd));
    }

    public function executeChargerservicepardirection(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("servicerh/servicepardirection", array("idd" => $idd));
    }

    public function executeChargercatparcorps(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("categorierh/catparcorps", array("idd" => $idd));
    }

    public function executeChargersousdirectionparDirection(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("sousdirection/sousdirectionpardirection", array("idd" => $idd));
    }

    public function executeChargerserviceDirectionorsousdirection(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("servicerh/servicedirectionorsous", array("idd" => $idd));
    }

    public function executeChargerserviceDirectionordirection(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("servicerh/servicedirectionorsousd", array("idd" => $idd));
    }

    public function executeChargeruniteparservice(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("unite/uniteparservice", array("idd" => $idd));
    }

    public function executeChargerunitepardireaction(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("unite/unitepardirection", array("idd" => $idd));
    }

    public function executeChargeruniteparsousdireaction(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("unite/uniteparsousdirection", array("idd" => $idd));
    }

    public function executeChargerposteparservice(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("posterh/posteparservice", array("idd" => $idd));
    }

    public function executeChargerposteparunite(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("posterh/postepaunite", array("idd" => $idd));
    }

    public function executeChargerposteparsousdirection(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("posterh/posteparsousdirection", array("idd" => $idd));
    }

    public function executeChargerpostepardirection(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("posterh/postepardirection", array("idd" => $idd));
    }

    public function executeChargerunitepardireactionetservice(sfWebRequest $request) {

        $idd = $request->getParameter('idd');
        $id1 = $request->getParameter('id1');

        return $this->renderPartial("unite/unitepardirectionetservice", array("idd" => $idd, "id1" => $id1));
    }

    //parametre de service pour le recherche 
    public function executeChargerservice(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("listeagentsservice", array("idd" => $idd));
    }

    //parametre de unite pour le recherche 
    public function executeChargerunite(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("listeagentsunite", array("idd" => $idd));
    }

    //parametre de poste pour le recherche 

    public function executeChargerposte(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("listeagentsposte", array("idd" => $idd));
    }

    //charger fonction pour recherche 
    public function executeChargerfonction(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("listeagentsfonction", array("idd" => $idd));
    }

    //cahrger situation pour rechreche

    public function executeCharegrsituation(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');

        return $this->renderPartial("listeagentssituation", array("id1" => $id1));
    }

    //charger par corps
    public function executeCharegrparcorps(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');

        return $this->renderPartial("agents/listeagentsparcorps", array("id1" => $id1));
    }

    //par corps et echelle

    public function executeCharegrparcorpsetechelle(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');

        return $this->renderPartial("agents/listeagentsparcorpsetechelle", array("id1" => $id1, "id2" => $id2));
    }

    //corps et lieu 

    public function executeCharegrparcorpsetlieu(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');

        return $this->renderPartial("agents/listeagentslieuetcorps", array("id1" => $id1, "id2" => $id2));
    }

//echelle echelon

    public function executeCharegrparechelleechelon(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');

        return $this->renderPartial("agents/listeagentsparechelleechelon", array("id1" => $id1, "id2" => $id2));
    }

    //cat grade 

    public function executeCharegrparcategoriegrade(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');

        return $this->renderPartial("agents/listeagentsparcatgrade", array("id1" => $id1, "id2" => $id2));
    }

    //echelle et categorie 


    public function executeCharegrparechellecat(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');

        return $this->renderPartial("agents/listeagentsparechelleetcat", array("id1" => $id1, "id2" => $id2));
    }

    //echelle grade
    public function executeCharegrparechellegrade(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');

        return $this->renderPartial("agents/listeagentsparechellegrade", array("id1" => $id1, "id2" => $id2));
    }

    //echelon cat 

    public function executeCharegrparecheloncat(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');

        return $this->renderPartial("agents/listeagentsparechelonetcat", array("id1" => $id1, "id2" => $id2));
    }

    //echelon grade 

    public function executeCharegrparechelongrade(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');

        return $this->renderPartial("agents/listeagentsparechelonetgrade", array("id1" => $id1, "id2" => $id2));
    }

//corps echelle echelon 

    public function executeCharegrparcorpsetechelleechelon(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');
        $id3 = $request->getParameter('id3');

        return $this->renderPartial("agents/listeagentsparcorpsetechelleetechelon", array("id1" => $id1, "id2" => $id2, "id3" => $id3));
    }

    //cat echelle echelon 

    public function executeCharegrparcatetechelleechelon(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');
        $id3 = $request->getParameter('id3');

        return $this->renderPartial("agents/listeagentsparcatetechelleetechelon", array("id1" => $id1, "id2" => $id2, "id3" => $id3));
    }

//grade echelle echelon


    public function executeCharegrpargradeetechelleechelon(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');
        $id3 = $request->getParameter('id3');

        return $this->renderPartial("agents/listeagentspargradeetechelleetechelon", array("id1" => $id1, "id2" => $id2, "id3" => $id3));
    }

//corps echelle cat
    public function executeCharegrparcorpsetechellecat(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');
        $id3 = $request->getParameter('id3');

        return $this->renderPartial("agents/listeagentsparcorpsetechelleetcat", array("id1" => $id1, "id2" => $id2, "id3" => $id3));
    }

    //corps grade cat 

    public function executeCharegrparcorpsetgradecat(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');
        $id3 = $request->getParameter('id3');

        return $this->renderPartial("agents/listeagentsparcorpsetgradeetcat", array("id1" => $id1, "id2" => $id2, "id3" => $id3));
    }

    //corps echelon cat

    public function executeCharegrparcorpsetecheloncat(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');
        $id3 = $request->getParameter('id3');

        return $this->renderPartial("agents/listeagentsparcorpsetechelonetcat", array("id1" => $id1, "id2" => $id2, "id3" => $id3));
    }

//grade echelle cat 
    public function executeCharegrpargradeetecheloncat(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');
        $id3 = $request->getParameter('id3');

        return $this->renderPartial("agents/listeagentspargradeetechelonetcat", array("id1" => $id1, "id2" => $id2, "id3" => $id3));
    }

//corps echelle grade

    public function executeCharegrparcorpsetechellegrade(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');
        $id3 = $request->getParameter('id3');

        return $this->renderPartial("agents/listeagentsparcorpsetechelleetgrade", array("id1" => $id1, "id2" => $id2, "id3" => $id3));
    }

    //corps echelon grade

    public function executeCharegrparcorpsetechelongrade(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');
        $id3 = $request->getParameter('id3');

        return $this->renderPartial("agents/listeagentsparcorpsetechelonetgrade", array("id1" => $id1, "id2" => $id2, "id3" => $id3));
    }

//corps echelle echelon categorie 

    public function executeCharegrparcorpsetechelleechelonetcat(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');
        $id3 = $request->getParameter('id3');
        $id4 = $request->getParameter('id4');

        return $this->renderPartial("agents/listeagentsparcorpsetechelleetecheloncat", array("id1" => $id1, "id2" => $id2, "id3" => $id3, "id4" => $id4));
    }

//corps echelle echeon cat grade


    public function executeCharegrparcorpsetechelleechelonetcatgrade(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');
        $id3 = $request->getParameter('id3');
        $id4 = $request->getParameter('id4');
        $id5 = $request->getParameter('id5');

        return $this->renderPartial("agents/listeagentsparcorpsetechelleetecheloncatgrade", array("id1" => $id1, "id2" => $id2, "id3" => $id3, "id4" => $id4, "id5" => $id5));
    }

    //par corps et grade 

    public function executeCharegrparcorpsetgrade(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');

        return $this->renderPartial("agents/listeagentsparcorpsetgrade", array("id1" => $id1, "id2" => $id2));
    }

    //par cat et grade 

    public function executeCharegrpartcategorieetgrade(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');

        return $this->renderPartial("agents/listeagentsparcatetgrade", array("id1" => $id1, "id2" => $id2));
    }

    //corps et cat 
    public function executeCharegrparcorpsetcategorie(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');

        return $this->renderPartial("agents/listeagentscatetcorps", array("id1" => $id1, "id2" => $id2));
    }

//corps et situation

    public function executeCharegrparcorpsetsituation(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');

        return $this->renderPartial("agents/listeagentssituationetcorps", array("id1" => $id1, "id2" => $id2));
    }

    //corps et position administratif

    public function executeCharegrparcorpsetposition(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');

        return $this->renderPartial("agents/listeagentspositionsetcorps", array("id1" => $id1, "id2" => $id2));
    }

    //corps et primes 

    public function executeCharegrparcorpsetprime(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');

        return $this->renderPartial("agents/listeagentsprimeetcorps", array("id1" => $id1, "id2" => $id2));
    }

    //grade par cat 

    public function executeChargergradeparcat(sfWebRequest $request) {

        $idd = $request->getParameter('idd');


        return $this->renderPartial("grade/gradeparcat", array("idd" => $idd));
    }

    //grade pa corps 

    public function executeChargergradeparcorps(sfWebRequest $request) {

        $idd = $request->getParameter('idd');


        return $this->renderPartial("grade/gradeparcorps", array("idd" => $idd));
    }

    //corps et echelon 
    public function executeCharegrparcorpsetechelon(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');

        return $this->renderPartial("agents/listeagentsparcorpsetechelon", array("id1" => $id1, "id2" => $id2));
    }

    //grdae par cat et grade 

    public function executeCharegregradecat(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');
        $id2 = $request->getParameter('id2');

        return $this->renderPartial("agents/listeagentsparcatetgrade", array("id1" => $id1, "id2" => $id2));
    }

    //charger position ^pour recherceh

    public function executeCharegrposition(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');

        return $this->renderPartial("listeagentsposition", array("id1" => $id1));
    }

    public function executeCharegrechelle(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');

        return $this->renderPartial("listeagentsechelle", array("id1" => $id1));
    }

    //
    public function executeCharegrechelon(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');

        return $this->renderPartial("listeagentsechelon", array("id1" => $id1));
    }

    public function executeCharegrecat(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');

        return $this->renderPartial("listeagentscat", array("id1" => $id1));
    }

    public function executeCharegregrade(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');

        return $this->renderPartial("listeagentsgrade", array("id1" => $id1));
    }

    public function executeChargerllieu(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');

        return $this->renderPartial("listeagentslieu", array("id1" => $id1));
    }

    public function executeCharegreprimes(sfWebRequest $request) {

        $id1 = $request->getParameter('id1');

        return $this->renderPartial("listeagentsprimes", array("id1" => $id1));
    }

    public function executeAfficheageEnfants(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $datenaissance = $params['datenaissance'];

            $_age = floor((time() - strtotime($datenaissance)) / 31556926);
            die($_age);
        }

        die("Erreur");
    }

    public function executeSavedocument(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $listeslignesdocD = $params['listeslignesdocD'];
            $id_agents = $params['id_agents'];
            //    $magd = $params['idmagd'];

            if ($id_agents) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

                Doctrine_Query::create()->delete('lignedipagents')
                        ->where('id_agents=' . $id_agents)->execute();
            }
            foreach ($listeslignesdocD as $lignedocD) {
                $annee = $lignedocD['annee'];
                $libelle = $lignedocD['libelle'];
                $magd = $lignedocD['idmagd'];
                $nordre1 = $lignedocD['norgdre'];


                $lignedocD = new Lignedipagents();
                if ($annee != "")
                    $lignedocD->setAnnee($annee);
                if ($libelle != "")
                    $lignedocD->setLibelle($libelle);
                if ($magd != "")
                    $lignedocD->setIdDiplome($magd);
                if ($nordre1 != "")
                    $lignedocD->setNordre($nordre1);
                if ($id_agents != "")
                    $lignedocD->setIdAgents($id_agents);

                $lignedocD->save();
            }
        }
        die('ajout avec succe');
    }

    public function executeSavedocumentLangue(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $listeslignesdocL = $params['listeslignesdocL'];
            $id_agents = $params['id_agents'];
            if ($id_agents) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

                Doctrine_Query::create()->delete('lignelangueagents')
                        ->where('id_angents=' . $id_agents)->execute();
            }
            foreach ($listeslignesdocL as $lignedocL) {
                $descriptionl = $lignedocL['descriptionl'];

                $mag2 = $lignedocL['idmag2'];
                $nordre1 = $lignedocL['norgdre'];


                $lignedocLL = new lignelangueagents();
                if ($descriptionl && $descriptionl != "")
                    $lignedocLL->setDescription($descriptionl);

                if ($mag2 != "")
                    $lignedocLL->setIdLangue($mag2);
                if ($nordre1 != "")
                    $lignedocLL->setNordre($nordre1);

                if ($id_agents != "")
                    $lignedocLL->setIdAngents($id_agents);

                $lignedocLL->save();
            }
        }
        die('ajout avec succe');
    }

    public function executeSavedocumentSpecialite(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $listeslignesdocS = $params['listeslignesdocS'];
            $id_agents = $params['id_agents'];
            if ($id_agents) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

                Doctrine_Query::create()->delete('lignespecialteagents')
                        ->where('id_agents=' . $id_agents)->execute();
            }
            foreach ($listeslignesdocS as $lignedocS) {
                $descriptionS = $lignedocS['descriptions'];

                $mag1 = $lignedocS['idmag1'];
                $nordre1 = $lignedocS['norgdre'];

                $lignedocSS = new lignespecialteagents();
                if ($descriptionS && $descriptionS != "")
                    $lignedocSS->setDescription($descriptionS);

                if ($mag1 != "")
                    $lignedocSS->setIdSpecialite($mag1);

                if ($nordre1 != "")
                    $lignedocSS->setNordre($nordre1);

                if ($id_agents != "")
                    $lignedocSS->setIdAgents($id_agents);

                $lignedocSS->save();
            }
        }
        die('ajout avec succe');
    }

    public function executeSavedocumentFormations(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $listeslignesdocF = $params['listeslignesdocF'];
            $id_agents = $params['id_agents'];

            if ($id_agents) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

                Doctrine_Query::create()->delete('experiences')
                        ->where('id_agents=' . $id_agents)->execute();
            }
            foreach ($listeslignesdocF as $lignedocF) {
                $description = $lignedocF['description'];
                $organistaion = $lignedocF['organistaion'];
                $duree = $lignedocF['duree'];
                $date = $lignedocF['date'];
                $mag = $lignedocF['idmagF'];
                $nordre1 = $lignedocF['norgdre'];

                $lignedocFF = new experiences();
                if ($description != "")
                    $lignedocFF->setDescription($description);
                if ($organistaion != "")
                    $lignedocFF->setOrganistaion($organistaion);
                if ($duree != "")
                    $lignedocFF->setDuree($duree);
                if ($date != "")
                    $lignedocFF->setDate($date);
                if ($mag != "")
                    $lignedocFF->setIdTypeexperience($mag);
                if ($nordre1 != "")
                    $lignedocFF->setNordre($nordre1);

                if ($id_agents != "")
                    $lignedocFF->setIdAgents($id_agents);

                $lignedocFF->save();
            }
        }
        die('ajout avec succe');
    }

    public function executeSavedocumentConjoints(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $listeslignesdocC = $params['listeslignesdocC'];
            $id_agents = $params['id_agents'];
            if ($id_agents) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

                Doctrine_Query::create()->delete('conjoints')
                        ->where('id_agents=' . $id_agents)->execute();
            }
            foreach ($listeslignesdocC as $lignedocC) {
                $nomC = $lignedocC['nomc'];
                $prenomC = $lignedocC['prenomc'];
                $etattravail = $lignedocC['etattravail'];
                $nordre1 = $lignedocC['norgdre'];
                $lignedocCC = new conjoints();
                if ($nomC != "")
                    $lignedocCC->setNom($nomC);
                if ($prenomC != "")
                    $lignedocCC->setPrenom($prenomC);

                if ($etattravail == 'true')
                    $lignedocCC->setEtattravail(true);
                else
                    $lignedocCC->setEtattravail(false);
                if ($nordre1 != "")
                    $lignedocCC->setNordre($nordre1);
                if ($id_agents != "")
                    $lignedocCC->setIdAgents($id_agents);

                $lignedocCC->save();
            }
        }
        die('ajout avec succe');
    }

    public function executeSavedocumentEnfants(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $listeslignesdocE = $params['listeslignesdocE'];
            $id_agents = $params['id_agents'];
            $photo = $params['photo'];
            if ($id_agents) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

                Doctrine_Query::create()->delete('enfants')
                        ->where('id_agents=' . $id_agents)->execute();
            }
            foreach ($listeslignesdocE as $lignedocE) {
                $nomE = $lignedocE['nome'];
                $prenomE = $lignedocE['prenome'];
                $dateNai = $lignedocE['datenai'];
                $dateMa = $lignedocE['datema'];
                $nordre1 = $lignedocE['norgdre'];

                $agents = new Agents();
                if ($photo != "")
                    $agents->setPhoto($photo);
                $lignedocEE = new Enfants();
                if ($nomE != "")
                    $lignedocEE->setNom($nomE);
                if ($prenomE != "")
                    $lignedocEE->setPrenom($prenomE);
                if ($dateNai != "")
                    $lignedocEE->setDatenaissance($dateNai);
                if ($dateMa != "")
                    $lignedocEE->setDatemajeur($dateMa);
                if ($nordre1 != "")
                    $lignedocEE->setNordre($nordre1);

                if ($id_agents != "")
                    $lignedocEE->setIdAgents($id_agents);

                $lignedocEE->save();
            }
        }
        die('ajout avec succe');
    }

    public function executeSavedocumentParents(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $listeslignesdocP = $params['listeslignesdocP'];
            $id_agents = $params['id_agents'];
            if ($id_agents) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

                Doctrine_Query::create()->delete('parents')
                        ->where('id_agents=' . $id_agents)->execute();
            }
            foreach ($listeslignesdocP as $lignedocP) {
                $nom = $lignedocP['nom'];
                $prenom = $lignedocP['prenom'];
                $dateN = $lignedocP['daten'];
                $nordre1 = $lignedocP['norgdre'];


                $lignedocPP = new Parents();
                if ($nom != "")
                    $lignedocPP->setNom($nom);
                if ($prenom != "")
                    $lignedocPP->setPrenom($prenom);
                if ($dateN != "")
                    $lignedocPP->setDatenaissance($dateN);
                if ($nordre1 != "")
                    $lignedocPP->setNordre($nordre1);

                if ($id_agents != "")
                    $lignedocPP->setIdAgents($id_agents);

                $lignedocPP->save();
            }
        }
        die('ajout avec succe');
    }

    public function executeSavedocumentPersonnel(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $mat = $params['mat'];
            $ci = $params['ci'];
            $no = $params['no'];
            $pren = $params['pren'];
            $datn = $params['datn'];
            $pa = $params['pa'];
            $ids = $params['ids'];

            $id_regroupement = $params['id_regroupement'];
            $adr = $params['adr'];
            $code = $params['code'];
            $etatc = $params['etatc'];
            $idp = $params['idp'];
            $etatm = $params['etatm'];
            $gou = $params['gou'];
            $gs = $params['gs'];
            $cns = $params['cns'];
            $dateaf = $params['dateaf'];
            $nbr = $params['nbr'];
            $chef = $params['chef'];
            $niveau = $params['niveau'];
            $ri = $params['ri'];
            $age = $params['age'];
            $agentsid = $params['idag'];
            $agents = new Agents();
            if ($mat != "")
                $mat = $agents->setIdrh($mat);
            if ($ci != "")
                $agents->setCin($ci);
            if ($no != "")
                $no = $agents->setNomcomplet($no);
            if ($pren != "")
                $agents->setPrenom($pren);
            if ($datn != "")
                $datn = $agents->setDatenaissance($datn);
            if ($pa != "")
                $pa = $agents->setIdPays($pa);
            if ($ids != "")
                $ids = $agents->setIdSexe($ids);
            if ($adr != "")
                $adr = $agents->setAdresse($adr);

            if ($id_regroupement != "")
                $id_regroupement = $agents->setIdRegrouppement($id_regroupement);
            if ($code != "")
                $code = $agents->setCodepostal($code);
            if ($etatc != "")
                $etatc = $agents->setIdEtatcivil($etatc);
            if ($idp != "")
                $idp = $agents->setIdpersonnel($idp);
            if ($etatm != "")
                $etatm = $agents->setEtatmulitaire($etatm);
            if ($gs != "")
                $gs = $agents->setGsm($gs);
            if ($cns != "")
                $cns = $agents->setIdcnss($cns);
            if ($dateaf != "")
                $dateaf = $agents->setDateaffiliation($dateaf);
            if ($nbr != "")
                $nbr = $agents->setNbrenfants($nbr);
            if ($chef == 'true')
                $chef = $agents->setCheffamille(true);
            else
                $chef = $agents->setCheffamille(false);
            if ($niveau != "")
                $niveau = $agents->setIdNiveaueducatif($niveau);
            if ($gou != "")
                $gou = $agents->setIdGouvn($gou);
            if ($ri != "")
                $ri = $agents->setRib($ri);
            if ($age != "")
                $age = $agents->setAge($age);

            $agents->save();

            die(json_encode($agents->getId()));
            die('ajout avec succès');
        }
    }

    public function executeDelete(sfWebRequest $request) {
        //$request->checkCSRFProtection();
//        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
        $iddoc = $request->getParameter('id');
        //_________suppr. ligne doc
        Doctrine_Query::create()->delete('lignedipagents')
                ->where('id_agents=' . $iddoc)->execute();
        Doctrine_Query::create()->delete('lignespecialteagents')
                ->where('id_agents=' . $iddoc)->execute();
        Doctrine_Query::create()->delete('lignelangueagents')
                ->where('id_angents=' . $iddoc)->execute();
        Doctrine_Query::create()->delete('experiences')
                ->where('id_agents=' . $iddoc)->execute();

        Doctrine_Query::create()->delete('conjoints')
                ->where('id_agents=' . $iddoc)->execute();
        Doctrine_Query::create()->delete('enfants')
                ->where('id_agents=' . $iddoc)->execute();
        Doctrine_Query::create()->delete('parents')
                ->where('id_agents=' . $iddoc)->execute();
        Doctrine_Query::create()->delete('demandeur')
                ->where('id_agent=' . $iddoc)->execute();

        Doctrine_Query::create()->delete('parcourcourier')
                ->where('id_exp IN (select id from expdest where id_agent = ' . $iddoc . ')')
                ->orWhere('id_rec IN (select id from expdest where id_agent = ' . $iddoc . ')')
                ->execute();

        Doctrine_Query::create()->delete('expdest')
                ->where('id_agent=' . $iddoc)->execute();
        //supprimer presence
        $presences = Doctrine_Core::getTable('presence')->findByIdAgents($iddoc);
        foreach ($presences as $presence) {
            Doctrine_Query::create()->delete('grillepresence')
                    ->where('id_presnece=' . $presence->getId())->execute();
            $presence->delete();
        }
//suprimer conge 
        $conges = Doctrine_Core::getTable('conge')->findByIdAgents($iddoc);

        foreach ($conges as $conge) {
            $conge->delete();
        }
        $responsableconges = Doctrine_Core::getTable('conge')->findByResponsable($iddoc);
        foreach ($responsableconges as $conge) {
            $conge->delete();
        }
        //responsable conge
//        Doctrine_Query::create()->delete('conge')
//                ->where('id_agents IN (select id from conge where id_agents = ' . $iddoc . ')')
//                ->execute();

        Doctrine_Query::create()->delete('ligneplaning')
                ->where('id_besoins IN (select id from besoinsdeformation where id_agents = ' . $iddoc . ')')
                ->execute();

        Doctrine_Query::create()->delete('besoinsdeformation')
                ->where('id_agents=' . $iddoc)->execute();

        Doctrine_Query::create()->delete('recompense')
                ->where('id_agents=' . $iddoc)->execute();
        //avance
        Doctrine_Query::create()->delete('demandeavance')
                ->where('id_agents=' . $iddoc)->execute();
        //prêt
        Doctrine_Query::create()->delete('demandepret')
                ->where('id_agents=' . $iddoc)->execute();
        //retenue sur salire
        Doctrine_Query::create()->delete('retenuesursalaire')
                ->where('id_agents=' . $iddoc)->execute();
        //visite médicale
        Doctrine_Query::create()->delete('visitemedicale')
                ->where('id_agents=' . $iddoc)->execute();
        //tenues
        Doctrine_Query::create()->delete('tenues')
                ->where('id_agents=' . $iddoc)->execute();
        //accidents
        Doctrine_Query::create()->delete('accidents')
                ->where('id_agents=' . $iddoc)->execute();
        //aidesociale
        Doctrine_Query::create()->delete('aidesociale')
                ->where('id_agents=' . $iddoc)->execute();
        //   SUPPRIMER UTILISATEUR 
        Doctrine_Query::create()->delete('utilisateur')
                ->where('id_parent=' . $iddoc)->execute();

        $this->forward404Unless($agents = Doctrine_Core::getTable('agents')->find(array($request->getParameter('id'))), sprintf('Object fiche does not exist (%s).', $request->getParameter('id')));
        $agents->delete();
        $this->redirect('@agents');
    }

    public function executeEdit(sfWebRequest $request) {

        $this->agents = Doctrine_Core::getTable('agents')->findOneById($request->getParameter('id'));
        $this->form = $this->configuration->getForm($this->agents);
//
    }

    public function executeAffichelignediplomes(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agents = $params['id'];

            $query = " select lignedipagents.nordre as norgdre , diplome.libelle as magd , lignedipagents.annee  as annee, lignedipagents.libelle as libelle "
                    . " from lignedipagents,diplome"
                    . " where lignedipagents.id_agents=" . $id_agents . ""
                    . " and lignedipagents.id_diplome=diplome.id ";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocsD = $conn->fetchAssoc($query);
            die(json_encode($listedocsD));
        }
        die("bien");
    }

    public function executeAfficheligneSpecialite(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agents = $params['id'];

            $query = " select lignespecialteagents.nordre as norgdre , specialite.libelle as mag1 , lignespecialteagents.description  as descriptions "
                    . " from lignespecialteagents,specialite"
                    . " where lignespecialteagents.id_agents=" . $id_agents . ""
                    . " and lignespecialteagents.id_specialite=specialite.id ";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocsS = $conn->fetchAssoc($query);
            die(json_encode($listedocsS));
        }
        die("bien");
    }

    public function executeAfficheligneLangues(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agents = $params['id'];

            $query = " select lignelangueagents.nordre as norgdre , langues.libelle as mag2 , lignelangueagents.description  as descriptionl "
                    . " from lignelangueagents,langues"
                    . " where lignelangueagents.id_angents=" . $id_agents . ""
                    . " and lignelangueagents.id_langue=langues.id ";



            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocsL = $conn->fetchAssoc($query);
            die(json_encode($listedocsL));
        }
        die("bien");
    }

    public function executeAfficheligneFormations(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agents = $params['id'];

            $query = " select experiences.nordre as norgdre , experiences.description as description ,experiences.organistaion as organistaion ,experiences.duree as duree , experiences.date as date , experiences.id_typeexperience as idtype, typeexperience.libelle as mag "
                    . " from experiences,typeexperience"
                    . " where experiences.id_agents=" . $id_agents . ""
                    . " and  experiences.id_typeexperience=typeexperience.id ";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocsF = $conn->fetchAssoc($query);
            die(json_encode($listedocsF));
        }
        die("bien");
    }

    public function executeAfficheligneConjoints(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agents = $params['id'];

            $query = " select conjoints.nordre as norgdre , conjoints.nom as nomc ,conjoints.prenom as prenomc ,conjoints.etattravail as etattravail  "
                    . " from conjoints"
                    . " where conjoints.id_agents=" . $id_agents . "";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocsC = $conn->fetchAssoc($query);
            die(json_encode($listedocsC));
        }
        die("bien");
    }

    public function executeAfficheligneEnfants(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agents = $params['id'];

            $query = " select enfants.nordre as norgdre , enfants.nom as nome ,enfants.prenom as prenome ,enfants.datenaissance as datenai ,enfants.datemajeur as datema   "
                    . " from enfants"
                    . " where enfants.id_agents=" . $id_agents . "";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocsE = $conn->fetchAssoc($query);
            die(json_encode($listedocsE));
        }
        die("bien");
    }

    public function executeAfficheligneParents(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agents = $params['id'];

            $query = " select parents.nordre as norgdre , parents.nom as nom ,parents.prenom as prenom ,parents.datenaissance as daten "
                    . " from parents"
                    . " where parents.id_agents=" . $id_agents . "";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocsP = $conn->fetchAssoc($query);
            die(json_encode($listedocsP));
        }
        die("bien");
    }

//filtrage avec upper
    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());



        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        return $query;
    }

    //impression liste agents
    public function executeImprimerliste(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('id_debut');
        $idf = $request->getParameter('id_fin');
        $documentagents = Doctrine_Core::getTable('agents')->findOneById($idd);
        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPers($idd, $doc, $idf);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPers($idd, $documents, $idf) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmlliste($idd, $idf);

        return $html;
    }

    //impression liste agents par directions 

    public function executeImprimerAlllisteagentspardirection(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('iddirection');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelle($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelle($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentspardirections($idd);

        return $html;
    }

    //imprimer liste agents par corps 

    public function executeImprimerAlllisteagentsparcorps(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Corps();
        $idd = $request->getParameter('idcorps');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparcorps($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparcorps($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparcorps($idd);

        return $html;
    }

    //corps et echelon 

    public function executeImprimerAlllisteagentsparcorpsetechelon(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Corps();
        $id1 = $request->getParameter('idcorps');
        $id2 = $request->getParameter('idechelon');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparcorpsetecehlon($id1, $doc, $id2);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparcorpsetecehlon($id1, $documents, $id2) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparcorpsetechelon($id1, $id2);

        return $html;
    }

//corps et lieu 

    public function executeImprimerAlllisteagentsparcorpsetlieu(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Corps();
        $id1 = $request->getParameter('idcor');
        $id2 = $request->getParameter('idlieu');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparcorpsetlieu($id1, $doc, $id2);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparcorpsetlieu($id1, $documents, $id2) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparcorpsetlieu($id1, $id2);

        return $html;
    }

//echelle et echelon

    public function executeImprimerAlllisteagentsparechelleechelon(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Corps();
        $id1 = $request->getParameter('idechelle');
        $id2 = $request->getParameter('idechelon');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparechelleecehlon($id1, $doc, $id2);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparechelleecehlon($id1, $documents, $id2) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparechelleechelon($id1, $id2);

        return $html;
    }

//echelle grade

    public function executeImprimerAlllisteagentsparechellegrade(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Corps();
        $id1 = $request->getParameter('idechelle');
        $id2 = $request->getParameter('idgrade');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparechellegrade($id1, $doc, $id2);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparechellegrade($id1, $documents, $id2) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparechellegrade($id1, $id2);

        return $html;
    }

//cat grade

    public function executeImprimerAlllisteagentsparcatgrade(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Corps();
        $id1 = $request->getParameter('idcat');
        $id2 = $request->getParameter('idgrade');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparcatgrade($id1, $doc, $id2);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparcatgrade($id1, $documents, $id2) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparcatgrade($id1, $id2);

        return $html;
    }

//echelle categorie 

    public function executeImprimerAlllisteagentsparechelleetcategorie(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $id4 = $request->getParameter('idechelle');
        $id5 = $request->getParameter('idcat');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparechellecat($id4, $doc, $id5);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparechellecat($id4, $documents, $id5) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparechellecat($id4, $id5);

        return $html;
    }

//echelon et categorie


    public function executeImprimerAlllisteagentsparechelonetcategorie(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $id1 = $request->getParameter('idechelon');
        $id2 = $request->getParameter('idcat');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparecheloncat($id1, $doc, $id2);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparecheloncat($id1, $documents, $id2) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparecheloncat($id1, $id2);

        return $html;
    }

    //echelon grade

    public function executeImprimerAlllisteagentsparechelonetgrade(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $id1 = $request->getParameter('idechelon');
        $id2 = $request->getParameter('idgrade');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparechelongrade($id1, $doc, $id2);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparechelongrade($id1, $documents, $id2) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparechelongrade($id1, $id2);

        return $html;
    }

//corps et grade 

    public function executeImprimerAlllisteagentsparcorpsetgrade(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Corps();
        $id1 = $request->getParameter('idcorps');
        $id2 = $request->getParameter('idgrade');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparcorpsetgrade($id1, $doc, $id2);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparcorpsetgrade($id1, $documents, $id2) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparcorpsetgrade($id1, $id2);

        return $html;
    }

    //corps et echelle 

    public function executeImprimerAlllisteagentsparcorpsetechelle(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $id3 = $request->getParameter('idcorps');
        $id4 = $request->getParameter('idechelle');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparcorpsetecehelle($id3, $doc, $id4);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparcorpsetecehelle($id3, $documents, $id4) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparcorpsetechelle($id3, $id4);

        return $html;
    }

    //corps echelle echelon 


    public function executeImprimerAlllisteagentsparcorpsetechelleetecehlon(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $id1 = $request->getParameter('idcorps');
        $id2 = $request->getParameter('idechelle');
        $id3 = $request->getParameter('idechelon');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparcorpsetecehelleetechelon($id1, $id2, $doc, $id3);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparcorpsetecehelleetechelon($id1, $id2, $documents, $id3) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparcorpsetechelleetechelon($id1, $id2, $id3);

        return $html;
    }

//cat echelon echelle

    public function executeImprimerAlllisteagentsparcatetechelleetecehlon(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $id1 = $request->getParameter('idcat');
        $id2 = $request->getParameter('idechelle');
        $id3 = $request->getParameter('idechelon');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparcatetecehelleetechelon($id1, $id2, $doc, $id3);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparcatetecehelleetechelon($id1, $id2, $documents, $id3) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparcatetechelleetechelon($id1, $id2, $id3);

        return $html;
    }

//echelle echelon grade 

    public function executeImprimerAlllisteagentspargradeetechelleetecehlon(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $id1 = $request->getParameter('idgrade');
        $id2 = $request->getParameter('idechelle');
        $id3 = $request->getParameter('idechelon');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonellepargradeetecehelleetechelon($id1, $id2, $doc, $id3);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonellepargradeetecehelleetechelon($id1, $id2, $documents, $id3) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentspargradeetechelleetechelon($id1, $id2, $id3);

        return $html;
    }

//grade echelle echelon 
//corps echelle cat

    public function executeImprimerAlllisteagentsparcorpsetechelleetcat(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $id1 = $request->getParameter('idcorps');
        $id2 = $request->getParameter('idechelle');
        $id3 = $request->getParameter('idcat');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparcorpsetecehelleetcat($id1, $id2, $doc, $id3);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparcorpsetecehelleetcat($id1, $id2, $documents, $id3) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparcorpsetechelleetcat($id1, $id2, $id3);

        return $html;
    }

//corps grade cate

    public function executeImprimerAlllisteagentsparcorpsetgradeetcat(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $id1 = $request->getParameter('idcorps');
        $id2 = $request->getParameter('idgrade');
        $id3 = $request->getParameter('idcat');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparcorpsetgradeetcat($id1, $id2, $doc, $id3);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparcorpsetgradeetcat($id1, $id2, $documents, $id3) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparcorpsetegradeetcat($id1, $id2, $id3);

        return $html;
    }

//corps echelon cat

    public function executeImprimerAlllisteagentsparcorpsetechelonetcat(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $id1 = $request->getParameter('idcorps');
        $id2 = $request->getParameter('idechelon');
        $id3 = $request->getParameter('idcat');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparcorpsetecehelonetcat($id1, $id2, $doc, $id3);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparcorpsetecehelonetcat($id1, $id2, $documents, $id3) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparcorpsetechelonetcat($id1, $id2, $id3);

        return $html;
    }

//grade  echelon cat

    public function executeImprimerAlllisteagentspargradeetechelonetcat(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $id1 = $request->getParameter('idgrade');
        $id2 = $request->getParameter('idechelon');
        $id3 = $request->getParameter('idcat');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonellepargradeetecehelonetcat($id1, $id2, $doc, $id3);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonellepargradeetecehelonetcat($id1, $id2, $documents, $id3) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentspargradeetechelonetcat($id1, $id2, $id3);

        return $html;
    }

//corps echelle grade

    public function executeImprimerAlllisteagentsparcorpsetechelleetgrade(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $id1 = $request->getParameter('idcorps');
        $id2 = $request->getParameter('idechelle');
        $id3 = $request->getParameter('idgrade');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparcorpsetecehelleetgrade($id1, $id2, $doc, $id3);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparcorpsetecehelleetgrade($id1, $id2, $documents, $id3) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparcorpsetechelleetgrade($id1, $id2, $id3);

        return $html;
    }

//corps echelon grade 

    public function executeImprimerAlllisteagentsparcorpsetechelonetgrade(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $id1 = $request->getParameter('idcorps');
        $id2 = $request->getParameter('idechelon');
        $id3 = $request->getParameter('idgrade');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparcorpsetecehelonetgrade($id1, $id2, $doc, $id3);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparcorpsetecehelonetgrade($id1, $id2, $documents, $id3) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparcorpsetechelonetgrade($id1, $id2, $id3);

        return $html;
    }

//corps echelle echelon categorie

    public function executeImprimerAlllisteagentsparcorpsetechelleetecehlonetcat(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $id1 = $request->getParameter('idcorps');
        $id2 = $request->getParameter('idechelle');
        $id3 = $request->getParameter('idechelon');
        $id4 = $request->getParameter('idcat');
        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparcorpsetecehelleetechelonetcat($id1, $id2, $doc, $id3, $id4);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparcorpsetecehelleetechelonetcat($id1, $id2, $documents, $id3, $id4) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparcorpsetechelleetechelonetcat($id1, $id2, $id3, $id4);

        return $html;
    }

    //corps echelle echelon categorie grade 

    public function executeImprimerAlllisteagentsparcorpsetechelleetecehlonetcatgrade(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $id1 = $request->getParameter('idcorps');
        $id2 = $request->getParameter('idechelle');
        $id3 = $request->getParameter('idechelon');
        $id4 = $request->getParameter('idcat');
        $id5 = $request->getParameter('idgrade');
        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparcorpsetecehelleetechelonetcatgrade($id1, $id2, $doc, $id3, $id4, $id5);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparcorpsetecehelleetechelonetcatgrade($id1, $id2, $documents, $id3, $id4, $id5) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparcorpsetechelleetechelonetcatgrade($id1, $id2, $id3, $id4, $id5);

        return $html;
    }

    //par corp et cat

    public function executeImprimerAlllisteagentsparcoretcat(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Corps();
        $id1 = $request->getParameter('idcor');
        $id2 = $request->getParameter('idcat');
        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparcorpsetcat($id1, $doc, $id2);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparcorpsetcat($id1, $documents, $id2) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparcorpsetcat($id1, $id2);

        return $html;
    }

    //cors et situtaion

    public function executeImprimerAlllisteagentsparcorpsetsituation(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Corps();
        $id1 = $request->getParameter('idcor');
        $id2 = $request->getParameter('idtype');
        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparcorpsetsituation($id1, $doc, $id2);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparcorpsetsituation($id1, $documents, $id2) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparcorpsetsituation($id1, $id2);

        return $html;
    }

//corps et primes

    public function executeImprimerAlllisteagentsparcorpsetprime(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $id1 = $request->getParameter('idcor');
        $id2 = $request->getParameter('idprime');
        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparcorpsetprimes($id1, $doc, $id2);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparcorpsetprimes($id1, $documents, $id2) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparcorpsetprime($id1, $id2);

        return $html;
    }

    //corps et position

    public function executeImprimerAlllisteagentsparcorpsetposition(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Corps();
        $id1 = $request->getParameter('idcor');
        $id2 = $request->getParameter('idposition');
        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparcorpsetposition($id1, $doc, $id2);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparcorpsetposition($id1, $documents, $id2) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparcorpsetposition($id1, $id2);

        return $html;
    }

    //par unite
    public function executeImprimerAlllisteagentsparunite(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('idunite');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparunite($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparunite($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparunite($idd);

        return $html;
    }

    //impression agnets par poste 
    public function executeImprimerAlllisteagentsparposte(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('idposte');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparposte($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparposte($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparposte($idd);

        return $html;
    }

    //impression agents par fonctin 

    public function executeImprimerAlllisteagentsparfonction(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('idfonction');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparfonction($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparfonction($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparfonction($idd);

        return $html;
    }

    //impression agents par situations 
    public function executeImprimerAlllisteagentsparsituation(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('idsituation');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparsituation($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparsituation($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparsituation($idd);

        return $html;
    }

//impression agents par position 

    public function executeImprimerAlllisteagentsparposition(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('idposition');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparposition($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparposition($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparposition($idd);

        return $html;
    }

//impression agents par echelle 
    public function executeImprimerAlllisteagentsparechelle(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('idechelle');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparechelle($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparechelle($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparechelle($idd);

        return $html;
    }

//impression agents par lieu de travail 
    public function executeImprimerAlllisteagentsparlieu(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('idlieu');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparlieu($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparlieu($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparlieu($idd);

        return $html;
    }

//impression agents par echelon 
    public function executeImprimerAlllisteagentsparechelon(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('idechelon');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparechelon($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparechelon($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparechelon($idd);

        return $html;
    }

    //impression par categorie
    public function executeImprimerAlllisteagentsparcat(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('idcat');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparcat($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparcat($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparcat($idd);

        return $html;
    }

    //impression par grade

    public function executeImprimerAlllisteagentspargrade(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('idgrade');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonellepargrade($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonellepargrade($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentspargrade($idd);

        return $html;
    }

//impression grade et cta 



    public function executeImprimerAlllisteagentspargradeetcat(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $id2 = $request->getParameter('idcat');
        $id1 = $request->getParameter('idgrade');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonellepargradeetcat($id1, $doc, $id2);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonellepargradeetcat($id1, $documents, $id2) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentspargradeetcat($id1, $id2);

        return $html;
    }

//impresssion agents par primes 


    public function executeImprimerAlllisteagentsparprime(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('idprime');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparprime($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparprime($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparprimes($idd);

        return $html;
    }

//impression agents par direction debut fin 
    public function executeImprimerAlllisteagentspardirectionetpardebutfinagents(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $iddirection = $request->getParameter('iddirection');
        $iddebut = $request->getParameter('idd');
        $idfin = $request->getParameter('idf');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleDebutfindirection($iddirection, $doc, $iddebut, $idfin);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleDebutfindirection($iddirection, $documents, $iddebut, $idfin) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentspardirectionsetpardebutetfin($iddirection, $iddebut, $idfin);

        return $html;
    }

//agents service agents debut fin 


    public function executeImprimerAlllisteagentsparserviceetpardebutfinagents(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idservice = $request->getParameter('idservice');
        $iddebut = $request->getParameter('idd');
        $idfin = $request->getParameter('idf');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleDebutfinservice($idservice, $doc, $iddebut, $idfin);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleDebutfinservice($idservice, $documents, $iddebut, $idfin) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparservicesetpardebutetfin($idservice, $iddebut, $idfin);

        return $html;
    }

    public function executeImprimerAlllisteagentsparsousdirection(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idsousdirection = $request->getParameter('idsousdirection');


        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonellesousdirection($idsousdirection, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonellesousdirection($idsousdirection, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparsousdirections($idsousdirection);

        return $html;
    }

    public function executeImprimerAlllisteagentsparsousdirectionetpardebutfinagents(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idsousdirection = $request->getParameter('idsousdirection');
        $iddebut = $request->getParameter('idd');
        $idfin = $request->getParameter('idf');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleDebutfinsousdirection($idsousdirection, $doc, $iddebut, $idfin);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleDebutfinsousdirection($idsousdirection, $documents, $iddebut, $idfin) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparsousdirectionsetpardebutetfin($idsousdirection, $iddebut, $idfin);

        return $html;
    }

    //agnets par service 

    public function executeImprimerAlllisteagentsparservice(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $ids = $request->getParameter('idservice');


        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
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
        $html = $this->ReadHtmlPersonelleparservice($ids, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparservice($ids, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparservice($ids);

        return $html;
    }

    public function executeImprimerFiche(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche agent');
        $pdf->SetSubject("Fiche agent");
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
        $pdf->Output('Fiche agent' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFiche($id) {
        $html = StyleCssHeader::header1();
        $agent = new Agents();
        $html .= $agent->ReadHtmlFicheAgent($id);

        return $html;
    }

    public function executeImprimerFicheDonneeBase(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche agent (Donnée de Base)');
        $pdf->SetSubject("Fiche agent (Donnée de Base)");
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
        $html = $this->ReadHtmlFicheDonneeBase($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Fiche agent (Donnée de Base)' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFicheDonneeBase($id) {
        $html = StyleCssHeader::header1();
        $agent = new Agents();
        $html .= $agent->ReadHtmlFicheAgentDonneeBase($id);

        return $html;
    }

    public function executeImprimerFicheEducative(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche agent');
        $pdf->SetSubject("Fiche agent");
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
        $html = $this->ReadHtmlFicheEducative($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Fiche agent' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFicheEducative($id) {
        $html = StyleCssHeader::header1();
        $agent = new Agents();
        $html .= $agent->ReadHtmlFicheAgentEducative($id);

        return $html;
    }

    public function executeImprimerFicheSociale(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche agent');
        $pdf->SetSubject("Fiche agent");
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
        $html = $this->ReadHtmlFicheSociale($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Fiche agent' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFicheSociale($id) {
        $html = StyleCssHeader::header1();
        $agent = new Agents();
        $html .= $agent->ReadHtmlFicheAgentSociale($id);

        return $html;
    }

    public function executeImprimerFichePersonnelleAvecChoix(sfWebRequest $request) {

        $pdf = new sfTCPDF('L');

// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Personnelle');
        $pdf->SetSubject("Fiche Personnelle");
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
        $html = $this->ReadHtmlFichePersonnelleAvecChoix($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Fiche Personnelle.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFichePersonnelleAvecChoix(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $agents = new Agents();

        $html .= $agents->ReadHtmlFichePersonnelleAvecChoix($request);
        return $html;
    }

    public function executeGetSexe(sfWebRequest $request) {
        $query = " select COALESCE(count(agents.id),0) as nbragents"
                . ", trim(sexe.libelle)  as sexe "
                . " from agents,contrat,sexe "
                . " where contrat.id_agents=agents.id"
                . " and  agents.id_sexe=sexe.id"
                . " group by sexe";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $this->agents = $conn->fetchAssoc($query);
    }

    public function executeStatistiqueAgentParSexe(sfWebRequest $request) {
        
    }

    public function executeImprimerListeAgents(sfWebRequest $request) {

        $pdf = new sfTCPDF('L');

// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Des Agents');
        $pdf->SetSubject("Liste Des Agents");
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
        $html = $this->ReadHtmlListeAgents($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Des Agents.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeAgents(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $agents = new Agents();

        $html .= $agents->ReadHtmAlllListeAgents($request);
        return $html;
    }
    
    public function executeImprimerListePersonnelleAvecChoix(sfWebRequest $request) {

        $pdf = new sfTCPDF('L');

// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Personnelle (Personnalisée)');
        $pdf->SetSubject("Liste Personnelle (Personnalisée)");
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
        $html = $this->ReadHtmlListePersonnelleAvecChoix($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Personnelle (Personnalisée).pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListePersonnelleAvecChoix(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $agents = new Agents();
        $html .= $agents->ReadHtmlListePersonnelleAvecChoix($request);
        return $html;
    }

}
