<?php

require_once dirname(__FILE__) . '/../lib/besoinsdeformationGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/besoinsdeformationGeneratorHelper.class.php';

/**
 * besoinsdeformation actions.
 *
 * @package    Bmm
 * @subpackage besoinsdeformation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class besoinsdeformationActions extends autoBesoinsdeformationActions {

    public function executeAfficheAnnee(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $ag = new Besoinsdeformation();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT besoinsdeformation.annee as annee "
                    . " FROM besoinsdeformation "
                    . " WHERE besoinsdeformation.id= " . $id
            ;


            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    public function executeAffichedetailAgents(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idagent = $params['idag'];
            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT agents.idrh as idrh ,agents.nomcomplet as nom ,"
                    . " contrat.id_agents as idag,contrat.id as idcontrat"
                    . " , contrat.id_posterh as idposte , posterh.id as idp"
                    . " ,posterh.libelle as poste"
                    . " ,posterh.id_unite as idunite,unite.id as id_unite , unite.libelle as unite "
                    . " ,unite.id_service as idservice, servicerh.libelle as service "
                    . " , servicerh.id_sousdirection as idsousdirection , sousdirection.libelle as sousdirection"
                    . " , sousdirection.id_direction as iddirection , direction.libelle as direction"
                    . " FROM agents , contrat , posterh ,unite,servicerh,sousdirection,direction"
                    . " WHERE contrat.id_agents=agents.id "
                    . " and contrat.id_posterh=posterh.id"
                    . " and posterh.id_unite=unite.id"
                    . " and unite.id_service=servicerh.id"
                    . " and servicerh.id_sousdirection=sousdirection.id"
                    . " and sousdirection.id_direction=direction.id"
                    . " and agents.id=" . $idagent
                    . "Limit 1";


            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    //save besoins de formation  

    public function executeSavedocumentBesoins(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {

            $params = json_decode($content, true);
            $id_agents = $params['id_agents'];
            $id_contrat = $params['id_contrat'];
            $id_unite = $params['id_unite'];
            $id_poste = $params['id_poste'];

            $cometance = $params['competance'];
            $bes = $params['besoins'];
            $annee = $params['annee'];



            $id = $params['id'];
            $besoins = new Besoinsdeformation();
            if ($id != "") {
                $beso = Doctrine_Core::getTable('besoinsdeformation')->findOneById($id);
                if ($beso)
                    $besoins = $beso;
            }

            if ($id_agents != "")
                $besoins->setIdAgents($id_agents);
            if ($id_contrat != "")
                $besoins->setIdContrat($id_contrat);
            if ($id_poste != "")
                $besoins->setIdPoste($id_poste);
            if ($id_unite != "")
                $besoins->setIdUnite($id_unite);
          
            
            if ($cometance != "")
                $besoins->setCompetance($cometance);
            if ($bes != "")
                $besoins->setBesoins($bes);
            if ($annee != "")
                $besoins->setAnnee($annee);
            $besoins->save();
            die($besoins->getId() . "");
        }
        die('erreur!!  ');
    }

//    public function executeListeAgents(sfWebRequest $request) {
//        header('Access-Control-Allow-Origin: *');
//        $params = array();
//        $content = $request->getContent();
//        $q = Doctrine_Query::create()
//                ->select("agents.id as qtemax, agents.nomcomplet as name,agents.idrh as ref ")
//                ->from('agents');
//        if (!empty($content)) {
//            $params = json_decode($content, true);
//            $agent = strtoupper($params['ag']);
//            $ref = strtoupper($params['ref']);
//            if ($agent != "")
//                $q = $q->where("upper(nomcomplet) like '%" . $agent . "%' or upper(idrh) like '%" . $agent . "%' or upper(prenom) like '%" . $agent . "%'");
//
//            if ($ref != "")
//                $q = $q->Where("upper(idrh) like '%" . $ref . "%'");
//        }
//        $q = $q->orderBy('id desc')->limit('100');
//
//        $listeagents = $q->fetchArray();
//        die(json_encode($listeagents));
//    }
}
