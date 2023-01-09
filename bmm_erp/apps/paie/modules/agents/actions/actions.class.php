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
//

class agentsActions extends autoAgentsActions {

    public function executeEdit(sfWebRequest $request) {

        $this->agents = Doctrine_Core::getTable('agents')->findOneById($request->getParameter('id'));
        $this->form = $this->configuration->getForm($this->agents);
    }

    //save ligne enfant 
    public function executeSavedocumentEnfants(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $listeslignesdocE = $params['listeslignesdocE'];
            $id_agents = $params['id_agents'];

            if ($id_agents) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

                Doctrine_Query::create()->delete('enfants')
                        ->where('id_agents=' . $id_agents)->execute();
            }
            foreach ($listeslignesdocE as $lignedocE) {
                $nomE = $lignedocE['nome'];
                $prenomE = $lignedocE['prenome'];
                $dateNai = $lignedocE['datenai'];
                $age = $lignedocE['age'];
                $nordre1 = $lignedocE['norgdre'];
                $etudiant = $lignedocE['etudiant'];
                $boursier = $lignedocE['boursier'];
                $deduction = $lignedocE['iddeduction'];
                $dece = $lignedocE['dece'];

                $agents = new Agents();

                $lignedocEE = new Enfants();
                if ($nomE != "")
                    $lignedocEE->setNom($nomE);
                if ($prenomE != "")
                    $lignedocEE->setPrenom($prenomE);
                if ($dateNai != "")
                    $lignedocEE->setDatenaissance($dateNai);
                if ($age != "")
                    $lignedocEE->setDatemajeur($age);
                if ($nordre1 != "")
                    $lignedocEE->setNordre($nordre1);
                if ($etudiant == 'true')
                    $lignedocEE->setEtudiant(true);
                else
                    $lignedocEE->setEtudiant(false);
                if ($boursier == 'true')
                    $lignedocEE->setBoursie(true);
                else
                    $lignedocEE->setBoursie(false);
                if ($deduction != "")
                    $lignedocEE->setIdDeduction($deduction);
                if ($dece == 'true')
                    $lignedocEE->setEtat(true);
                else
                    $lignedocEE->setEtat(false);
                if ($id_agents != "")
                    $lignedocEE->setIdAgents($id_agents);

                $lignedocEE->save();
            }
        }
        die('ajout avec succe');
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

//parents 
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
                $deceparent = $lignedocP['deceparent'];


                $lignedocPP = new Parents();
                if ($nom != "")
                    $lignedocPP->setNom($nom);
                if ($prenom != "")
                    $lignedocPP->setPrenom($prenom);
                if ($dateN != "")
                    $lignedocPP->setDatenaissance($dateN);
                if ($nordre1 != "")
                    $lignedocPP->setNordre($nordre1);
                if ($deceparent == 'true')
                    $lignedocPP->setEtat(true);
                else
                    $lignedocPP->setEtat(false);
                if ($id_agents != "")
                    $lignedocPP->setIdAgents($id_agents);
                $lignedocPP->save();
            }
        }
        die('ajout avec succe');
    }

    public function executeAfficheligneParents(sfWebRequest $request) {
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

}
