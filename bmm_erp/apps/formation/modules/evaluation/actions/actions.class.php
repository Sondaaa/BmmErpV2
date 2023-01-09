<?php

require_once dirname(__FILE__) . '/../lib/evaluationGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/evaluationGeneratorHelper.class.php';

/**
 * evaluation actions.
 *
 * @package    Bmm
 * @subpackage evaluation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class evaluationActions extends autoEvaluationActions {

    public function executeAffichedetailAgents(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idagent = $params['idag'];
            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//            $query = "SELECT agents.idrh as idrh , agents.nomcomplet as nom ,"
//                    . "contrat.id_salairedebase as idsal ,salairedebase.id_grade as idgrade ,grade.libelle as grade, contrat.id_agents as idcontrat ,"
//                    . " contrat.id_posterh as idposte , posterh.id as idp "
//                    . " ,posterh.libelle as poste "
//                    . ",contrat.id_lieu as idlieu , lieutravail.libelle as lieu "
//                    . " ,posterh.id_unite as idunite , unite.libelle as unite "
//                    . " ,unite.id_service as idservice, servicerh.libelle as service "
//                    . " , servicerh.id_sousdirection as idsousdirection , "
//                    . "sousdirection.libelle as sousdirection"
//                    . " , sousdirection.id_direction as iddirection , "
//                    . " direction.libelle as direction, "
//                    . " besoinsdeformation.id_agents as idagbe, besoinsdeformation.besoins as besoins, "
//                    . " ligneplaning.id_besoins as idligneb "
//                    . " FROM agents,grade,salairedebase,lieutravail , "
//                    . " contrat ,besoinsdeformation,ligneplaning, posterh ,unite,servicerh,sousdirection,direction"
//                    . " WHERE contrat.id_agents=agents.id"
//                    . " and besoinsdeformation.id_agents=agents.id  and ligneplaning.id_besoins =besoinsdeformation.id"
//                    . " and ligneplaning.realise=true"
//                    . " and contrat.id_posterh=posterh.id"
//                    . " and contrat.id_lieu=lieutravail.id "
//                    . " and contrat.id_salairedebase=salairedebase.id "
//                    . " and salairedebase.id_grade=grade.id"
//                    . " and posterh.id_unite=unite.id"
//                    . " and unite.id_service=servicerh.id"
//                    . " and servicerh.id_sousdirection=sousdirection.id"
//                    . " and sousdirection.id_direction=direction.id"
//                    . " and agents.id=" . $idagent
//                    . "Limit 1";
//            $query_agents = "SELECT agents.idrh as idrh ,concat(agents.nomcomplet , ' '  ,agents.prenom )as nom "
//                    . " FROM agents "
//                    . " where agents.id=" . $idagent;
//            $resultat_agents = $conn->fetchAssoc($query_agents);

            $query_lieu = "SELECT contrat.id_lieu as idlieu , lieutravail.libelle as lieutravail"
                    . " FROM agents,contrat ,lieutravail "
                    . " where agents.id=" . $idagent
                    . " and contrat.id_lieu=lieutravail.id "
                    ." Order by contrat.id DESC" 
                    ." Limit 1";
            $resultat_lieu = $conn->fetchAssoc($query_lieu);


            $query_contrat = "SELECT contrat.id_salairedebase as idsal ,"
                    . "salairedebase.id_grade as idgrade ,grade.libelle as grade, contrat.id_agents as idcontrat ,"
                    . " contrat.id_posterh as idposte , posterh.id as idp "
                    . " ,posterh.libelle as poste "
                   
                    . " ,posterh.id_unite as idunite , unite.libelle as unite "
                    . " ,unite.id_service as idservice, servicerh.libelle as service "
                    . " , servicerh.id_sousdirection as idsousdirection , "
                    . "sousdirection.libelle as sousdirection"
                    . " , sousdirection.id_direction as iddirection , "
                    . " direction.libelle as direction, "
                    . " besoinsdeformation.id_agents as idagbe, besoinsdeformation.besoins as besoins, "
                    . " ligneplaning.id_besoins as idligneb "
                    . " FROM agents,contrat  ,grade,salairedebase,lieutravail , "
                    . " besoinsdeformation,ligneplaning, posterh ,unite,servicerh,sousdirection,direction"
                    . " where contrat.id_agents=" . $idagent
                    . " and besoinsdeformation.id_agents=agents.id  and ligneplaning.id_besoins =besoinsdeformation.id"
                    . " and ligneplaning.realise=true"
//                    . " and contrat.id_posterh=posterh.id"
//                    . " and contrat.id_lieu=lieutravail.id "
                    . " and contrat.id_salairedebase=salairedebase.id "
                    . " and salairedebase.id_grade=grade.id"
                    . " and posterh.id_unite=unite.id"
                    . " and unite.id_service=servicerh.id"
                    . " and servicerh.id_sousdirection=sousdirection.id"
                    . " and sousdirection.id_direction=direction.id"
                    . " Order by contrat.id DESC"
                    . " Limit 1 ";
            $resultat_contrat = $conn->fetchAssoc($query_contrat);
            $resultat = array();
            $resultat['lieutravail'] = $resultat_lieu;
            $resultat['contrat'] = $resultat_contrat;
//            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    //afichage detail formation
    public function executeAffichedetailFormation(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idbesoisn1 = $params['idFormation'];

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//            $query = "SELECT ligneplaning.id_sousrubrique as idsousr ,"
//                    . " ligneplaning.theme as theme ,"
//                    . " ligneplaning.dateformation as dated,ligneplaning.datefin  as datef,"
//                    . " ligneplaning.nbrjour as durre"
//                    . ",ligneplaning.id_formateur as idf"
//                    . " ,formateur.nom as formateur "
//                    . ", ligneplaning.id_fournisseur  as idorg,"
//                    . " organisme.libelle as organisme"
//                    . " ,sousrubrique.libelle as sousrubirque , "
//                    . " ligneplaning.id_besoins as idbe"
//                    . " FROM ligneplaning,sousrubrique,besoinsdeformation, formateur,organisme  "
//                    . " WHERE ligneplaning.id_sousrubrique=sousrubrique.id"
//                    . " and ligneplaning.id_besoins=" . $idbesoisn
//                    . " GROUP BY ligneplaning.id,ligneplaning.id_sousrubrique,ligneplaning.theme , ligneplaning.dateformation,ligneplaning.datefin"
//                    . " ,ligneplaning.nbrjour,ligneplaning.id_formateur,formateur.nom,ligneplaning.id_fournisseur,organisme.libelle,"
//                    . " sousrubrique.libelle,ligneplaning.id_besoins"
            ;
            $query1 = "SELECT ligneplaning.id_sousrubrique as idsousr ,"
                    . " ligneplaning.theme as theme ,"
                    . " ligneplaning.dateformation as dated,"
                    . " ligneplaning.datefin  as datef,"
                    . " ligneplaning.nbrjour as durre"
                    . ",ligneplaning.id_formateur as idf"
                    . " , Concat (formateur.nom,formateur.prenom) as formateur "
                    . ", ligneplaning.id_fournisseur  as idorg,"
                    . " fournisseur.rs as organisme"
                    . " ,sousrubrique.libelle as sousrubirque,"
                    . " ligneplaning.id_besoins as idbe"
                    . " FROM ligneplaning,formateur,fournisseur,sousrubrique"
                    . " where ligneplaning.id_besoins=" . $idbesoisn1
                    . " and ligneplaning.id_formateur=formateur.id"
                    . " and ligneplaning.id_fournisseur = fournisseur.id"
                    . " and ligneplaning.id_sousrubrique=sousrubrique.id"
            ;

            $resultat1 = $conn->fetchAssoc($query1);
            die(json_encode($resultat1));
        }

        die("Erreur");
    }

//affichage pour edit 

    public function executeAfficheevaliation(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $ag = new Evaluation();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT evaluation.conditionslogement as condition ,"
                    . " evaluation.notecomposant as notecomposant ,"
                    . "evaluation.noteformateur as noteformateur"
                    . " FROM evaluation"
                    . " WHERE evaluation.id=" . $id

            ;

//  . ", evaluation.id_formation as idf ,besoinsdeformation, besoinsdeformation.id as idb,"  . "  evaluation.id_formation=besoinsdeformation.id "

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

//afiche liste besoins  par / apprt agents

    public function executeAffichedetailBesoinsFormation(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idagnets = $params['idag'];
            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "  SELECT  besoinsdeformation.id as id, besoinsdeformation.besoins as besoins, "
                    . " ligneplaning.id_besoins as idligneb "
                    . " FROM agents, ligneplaning,besoinsdeformation  "
                    . " WHERE  besoinsdeformation.id_agents=agents.id "
                    . " and ligneplaning.id_besoins =besoinsdeformation.id"
                    . " and ligneplaning.realise=true"
                    . " and besoinsdeformation.id  NOT IN( select evaluation.id_formation from evaluation where evaluation.id_formation is not null )"
                    . " and agents.id=" . $idagnets
                    . " GROUP BY besoinsdeformation.id,besoinsdeformation.besoins,ligneplaning.id_besoins"

            ;


            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    public function executeSavedocumentEvaluation(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {

            $params = json_decode($content, true);
            $id_agents = $params['id_agents'];
            $idbes = $params['idbes'];
            $condition = $params['condition'];
            $noteorga = $params['noteorga'];
            $noteformater = $params['noteformater'];
            $connai = $params['connai'];
            $competance = $params['competance'];
            $observa = $params['observa'];

            $degre = $params['degre'];
            $structure = $params['structure'];

            $id = $params['id'];
            $evaluation = new Evaluation();
            if ($id != "") {
                $eval = Doctrine_Core::getTable('evaluation')->findOneById($id);
                if ($eval)
                    $evaluation = $eval;
            }
            if ($structure != "")
                $evaluation->setStructureprog($structure);
            if ($degre != "")
                $evaluation->setDegreobjectif($degre);
            if ($id_agents != "")
                $evaluation->setIdAgents($id_agents);


            if ($noteformater != "")
                $evaluation->setNoteformateur($noteformater);
            if ($noteorga != "")
                $evaluation->setNotecomposant($noteorga);
            if ($idbes != "")
                $evaluation->setIdFormation($idbes);
            if ($condition != "")
                $evaluation->setConditionslogement($condition);
            if ($connai != "")
                $evaluation->setConnaissanceaquise($connai);

            if ($competance != "")
                $evaluation->setCompetance($competance);

            if ($observa != "")
                $evaluation->setObservation($observa);
            $evaluation->save();
            die($evaluation->getId() . "");
        }
        die('erreur!!  ');
    }

    public function executeStatistiqueEvaluationAgent(sfWebRequest $request) {
        
    }

    public function executeGetChart(sfWebRequest $request) {
        $this->evaluations = EvaluationTable::getInstance()->findByIdFormation($id = $request->getParameter('id'));
    }

}
