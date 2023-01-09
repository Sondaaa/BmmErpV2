<?php

require_once dirname(__FILE__) . '/../lib/historiqueretenueGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/historiqueretenueGeneratorHelper.class.php';

/**
 * historiqueretenue actions.
 *
 * @package    Bmm
 * @subpackage historiqueretenue
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class historiqueretenueActions extends autoHistoriqueretenueActions {

    //affiche detail 
    //charger demande avance 
    public function executeAffichedetaildemandeAvance(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agents = $params['id_agents'];
            $query = " select demandeavance.id as id , "
                    . " demandeavance.montanttotal as montanttotal"
                    . " , demandeavance.montantmensielle as montantmensielle "
                    . " ,demandeavance.mois as mois,"
                    . "demandeavance.datedebutretenue as datedebutretenue,"
                    . "demandeavance.datefinretenue as datefinretenue, "
                    . " demandeavance.annee as annee,concat(trim(agents.nomcomplet) , trim(agents.prenom)) as agents, "
                    . "concat(trim(agents.nomcomplet), ' (', trim(avance.libelle), ')') as libelle , avance.id as id_avance, avance.remboursement as nbrmois"
                    . " from demandeavance,avance ,agents"
                    . " where demandeavance.id_agents =" . $id_agents
                    . " and demandeavance.id_agents = agents.id"
                    . " and demandeavance.id_typeavance = avance.id"
                    . " and demandeavance.datefinretenue > '" . date("Y-m-d") . "'"
                    . " and demandeavance.datedebutretenue <= '" . date("Y-m-d") . "'"
            ;

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }

        die("Erreur");
    }

//charger selct 

    public function executeAfficheDemandeAvance(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $params = json_decode($content, true);
        //DISTINCT
        $query = " select agents.id as id, "
                . " concat( agents.nomcomplet,' ' ,agents.prenom , ' ', agents.idrh) as libelle "
                . " from agents,demandeavance"
                . " where demandeavance.id_agents =agents.id"
                . " and agents.id NOT IN (select demandeavance.id_agents from historiqueretenue"
                . ", demandeavance where historiqueretenue.id_demandeavance=demandeavance.id and "
                . "historiqueretenue.mois = " . intval(date("m")) .
                " and historiqueretenue.annee = " . intval(date("Y")) . ") "
                . " and (demandeavance.paye = false or demandeavance.paye is NULL)"
                . " and TO_CHAR(demandeavance.datefinretenue, 'yyyy-mm') >= '" . date("Y-m") . "'"
                . " and TO_CHAR(demandeavance.datedebutretenue, 'yyyy-mm') <= '" . date("Y-m") . "'"
                . " GROUP BY agents.id"
        ;
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $listedocs = $conn->fetchAssoc($query);
        die(json_encode($listedocs));
    }

    public function executeAfficheDemandeAvanceSelectmulitiple(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $params = json_decode($content, true);
        //DISTINCT
        $query = " select agents.id as id, "
                . " concat(agents.nomcomplet,' ' ,agents.prenom, ' ', agents.idrh) as libelle "
                . " from agents,demandeavance"
                . " where demandeavance.id_agents =agents.id"
                . " and agents.id NOT IN (select demandeavance.id_agents from historiqueretenue"
                . ", demandeavance where historiqueretenue.id_demandeavance=demandeavance.id and "
                . "historiqueretenue.mois = " . intval(date("m")) .
                " and historiqueretenue.annee = " . intval(date("Y")) . ") "
                . " and (demandeavance.paye = false or demandeavance.paye is NULL)"
                . " and TO_CHAR(demandeavance.datefinretenue, 'yyyy-mm') >= '" . date("Y-m") . "'"
                . " and TO_CHAR(demandeavance.datedebutretenue, 'yyyy-mm') <= '" . date("Y-m") . "'"
                . " GROUP BY agents.id"
        ;
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $this->listedocs = $conn->fetchAssoc($query);
//        die(json_encode($listedocs));
    }

    public function executeAfficheDemandePret(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $params = json_decode($content, true);
        $query = " select agents.id as id ,concat(agents.nomcomplet,' ' ,agents.prenom , ' ', agents.idrh) as libelle "
                . " from demandepret,agents"
                . " where demandepret.id_agents =agents.id"
                . " and agents.id NOT IN (select demandepret.id_agents from historiqueretenue"
                . ", demandepret where historiqueretenue.id_demandepret=demandepret.id and "
                . "historiqueretenue.mois = " . intval(date("m")) .
                " and historiqueretenue.annee = " . intval(date("Y")) . ") "
                . " and (demandepret.paye = false or demandepret.paye is NULL)"
                . " and TO_CHAR(demandepret.datefinretenue, 'yyyy-mm') >= '" . date("Y-m") . "'"
                . " and TO_CHAR(demandepret.datedebutretenue, 'yyyy-mm') <= '" . date("Y-m") . "'"
                . " GROUP BY agents.id"
        ;
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $listedocs = $conn->fetchAssoc($query);
        die(json_encode($listedocs));
    }

//pret 

    public function executeAfficheDemandePretSelectMultiple(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $params = json_decode($content, true);
        $query = " select agents.id as id ,concat(agents.nomcomplet,' ' ,agents.prenom , ' ', agents.idrh) as libelle "
                . " from demandepret,agents"
                . " where demandepret.id_agents =agents.id"
                . " and agents.id NOT IN (select demandepret.id_agents from historiqueretenue"
                . ", demandepret where historiqueretenue.id_demandepret=demandepret.id and "
                . "historiqueretenue.mois = " . intval(date("m")) .
                " and historiqueretenue.annee = " . intval(date("Y")) . ") "
                . " and (demandepret.paye = false or demandepret.paye is NULL)"
                . " and TO_CHAR(demandepret.datefinretenue, 'yyyy-mm') >= '" . date("Y-m") . "'"
                . " and TO_CHAR(demandepret.datedebutretenue, 'yyyy-mm') <= '" . date("Y-m") . "'"
                . " GROUP BY agents.id"
        ;
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $this->listedocs = $conn->fetchAssoc($query);
    }

//demanede retenue


    public function executeAfficheDemandeRetenue(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $params = json_decode($content, true);
        $query = " select agents.id as id ,concat(agents.nomcomplet,' ' ,agents.prenom , ' ', agents.idrh) as libelle "
                . " from retenuesursalaire,agents"
                . " where retenuesursalaire.id_agents =agents.id"
                . " and agents.id NOT IN (select retenuesursalaire.id_agents from historiqueretenue"
                . ", retenuesursalaire where historiqueretenue.id_retenue=retenuesursalaire.id and "
                . " historiqueretenue.mois = " . intval(date("m")) .
                " and historiqueretenue.annee = " . intval(date("Y")) . ") "
                . " and (retenuesursalaire.paye = false or retenuesursalaire.paye is NULL)"
                . " and TO_CHAR(retenuesursalaire.datefin, 'yyyy-mm') >= '" . date("Y-m") . "'"
                . " and TO_CHAR(retenuesursalaire.datedebut, 'yyyy-mm') <= '" . date("Y-m") . "'"
                . " and retenuesursalaire.valide =true"
                . " GROUP BY agents.id"
        ;

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $listedocs = $conn->fetchAssoc($query);
        die(json_encode($listedocs));
    }

//retenue select multiple
    public function executeAfficheDemandeRetenueSelectMultiple(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $params = json_decode($content, true);
        $query = " select agents.id as id ,concat(agents.nomcomplet,' ' ,agents.prenom , ' ', agents.idrh) as libelle "
                . " from retenuesursalaire,agents"
                . " where retenuesursalaire.id_agents =agents.id"
                . " and agents.id NOT IN (select retenuesursalaire.id_agents from historiqueretenue"
                . ", retenuesursalaire where historiqueretenue.id_retenue=retenuesursalaire.id and "
                . " historiqueretenue.mois = " . intval(date("m")) .
                " and historiqueretenue.annee = " . intval(date("Y")) . ") "
                . " and (retenuesursalaire.paye = false or retenuesursalaire.paye is NULL)"
                . " and TO_CHAR(retenuesursalaire.datefin, 'yyyy-mm') >= '" . date("Y-m") . "'"
                . " and TO_CHAR(retenuesursalaire.datedebut, 'yyyy-mm') <= '" . date("Y-m") . "'"
                . " and retenuesursalaire.valide =true"
                . " GROUP BY agents.id"
        ;

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $this->listedocs = $conn->fetchAssoc($query);
    }

//charger demade pret

    public function executeAffichedetaildemandePret(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agents = $params['id_agents'];
            $query = " select demandepret.id as id , demandepret.montantpret as montanttotal"
                    . " , demandepret.montantmentielle as montantmensielle "
                    . " ,demandepret.mois as mois,"
                    . "demandepret.datedebutretenue as demandeavance"
                    . ",demandepret.datefinretenue as datefinretenue, "
                    . " demandepret.annee as annee,concat(agents.nomcomplet , agents.prenom ) as agents, "
                    . " concat(agents.nomcomplet, agents.prenom, pret.libelle,sourcepret.libelle )as libelle,demandepret.nbrmois as nbrmois"
                    . " from demandepret,pret ,agents,sourcepret"
                    . " where  demandepret.id_agents =" . $id_agents
                    . "  and demandepret.id_agents = agents.id"
                    . " and demandepret.id_typepret = pret.id"
                    . " and pret.id_source=sourcepret.id"
                    . " and demandepret.datefinretenue > '" . date("Y-m-d") . "'"
                    . " and demandepret.datedebutretenue <= '" . date("Y-m-d") . "'"
            ;

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }

        die("Erreur");
    }

    //charger demande retenue 
    public function executeAffichedetaildemandeRetenue(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_agents = $params['id_agents'];
            $query = " select retenuesursalaire.id as id,"
                    . " concat(agents.nomcomplet, fournisseur.rs )as libelle"
                    . " from retenuesursalaire,fournisseur ,agents"
                    . " where  retenuesursalaire.id_agents =" . $id_agents
                    . "  and retenuesursalaire.id_agents = agents.id"
                    . " and retenuesursalaire.id_fournisseur = fournisseur.id"
                    . " and retenuesursalaire.datefin > '" . date("Y-m-d") . "'"
                    . " and retenuesursalaire.datedebut <= '" . date("Y-m-d") . "'"
            ;

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }

        die("Erreur");
    }

//cahrger demande retenue select multiple 
    //deetaill 
    public function executeAffichedetaildemandeAvancePaiement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $id_type = $params['id_type'];
            if ($id_type == "1") {
                $query = " select demandeavance.id as id, demandeavance.montanttotal as montanttotal"
                        . " , demandeavance.montantmensielle as montantmensielle "
                        . ",demandeavance.datedebutretenue as datedebutretenue,"
                        . " demandeavance.datefinretenue as datefinretenue, "
                        . " avance.libelle as typeavance , avance.id as id_avance,"
                        . " avance.remboursement as nbrmois,agents.idrh idrh,"
                        . " (select COALESCE(SUM (historiqueretenue.montantsoustre),0) from historiqueretenue where historiqueretenue.id_demandeavance = " . $id . ") as montantdejapaye "
                        . " from demandeavance,avance ,agents"
                        . " where  demandeavance.id =" . $id
                        . " and demandeavance.id_typeavance = avance.id"
                        . "  and demandeavance.id_agents = agents.id"
                        . " group by demandeavance.id , avance.libelle,avance.id,agents.idrh"
                ;
            } else if ($id_type == "2") {
                $query = " select demandepret.id as id, demandepret.montantpret as montanttotal"
                        . " , demandepret.montantmentielle as montantmensielle ,"
                        . "demandepret.datedebutretenue as datedebutretenue,"
                        . " (select COALESCE(SUM (historiqueretenue.montantsoustre),0) from historiqueretenue where historiqueretenue.id_demandepret = " . $id . ") as montantdejapaye "
                        . " , demandepret.datefinretenue as datefinretenue, "
                        . " concat(pret.libelle,sourcepret.libelle) as typeavance , pret.id as id_pret,"
                        . " demandepret.nbrmois as nbrmois,agents.idrh idrh"
                        . " from demandepret,pret ,agents,sourcepret"
                        . " where  demandepret.id =" . $id
                        . " and demandepret.id_typepret = pret.id"
                        . "  and demandepret.id_agents = agents.id"
                        . " and pret.id_source=sourcepret.id"
                        . " group by demandepret.id ,pret.libelle ,pret.id,agents.idrh,sourcepret.libelle"
                ;
            } else if ($id_type == "3") {
                $query = " select retenuesursalaire.id as id, retenuesursalaire.montantpret as montanttotal"
                        . " , retenuesursalaire.retenuesursalaire as montantmensielle ,"
                        . "retenuesursalaire.datedebut as datedebutretenue,"
                        . "retenuesursalaire.datefin as datefinretenue, "
                        . " (select COALESCE(SUM (historiqueretenue.montantsoustre),0) from historiqueretenue where historiqueretenue.id_retenue = " . $id . ") as montantdejapaye "
                        . " ,fournisseur.rs as typeavance ,"
                        . " retenuesursalaire.nbrmois as nbrmois,agents.idrh idrh"
                        . " from retenuesursalaire,fournisseur ,agents"
                        . " where  retenuesursalaire.id =" . $id
                        . " and retenuesursalaire.id_fournisseur = fournisseur.id"
                        . "  and retenuesursalaire.id_agents = agents.id"
                        . " group by retenuesursalaire.id ,fournisseur.rs,agents.idrh "

                ;
            }
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }

        die("Erreur");
    }

//detail demande pret
    //affichage historique

    public function executeAffichedetailpaiement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $id_demandepret = $params['id_demandepret'];
            $id_retenue = $params['id_retenue'];
            $id_demandeavannce = $params['id_demandeavannce'];

            if ($id_demandeavannce != "")
                $query = " select historiqueretenue.id as id  "
                        . " ,historiqueretenue.montantsoustre as montantmensielle,"
                        . " demandeavance.id as iddemande,"
                        . " demandeavance.montanttotal as montanttotal,"
                        . " demandeavance.datedebutretenue as datedebut, "
                        . " demandeavance.datefinretenue as datefin, "
                        . " avance.libelle as typeavance ,"
                        . " avance.id as id_avance, "
                        . " avance.remboursement as nbrmois"
                        . " from historiqueretenue,avance, demandeavance"
                        . " where historiqueretenue.id=" . $id
                        . " and historiqueretenue.id_demandeavance=demandeavance.id"
                        . " and historiqueretenue.id_demandeavance=" . $id_demandeavannce
                        . " and demandeavance.id_typeavance= avance.id"

                ;

            if ($id_demandepret != "")
                $query = " select historiqueretenue.id as id  "
                        . " ,historiqueretenue.montantsoustre as montantmensielle,"
                        . " demandepret.id as iddemande,"
                        . "demandepret.montantpret as montanttotal, "
                        . " demandepret.datedebutretenue as datedebut, "
                        . " demandepret.datefinretenue as datefin, "
                        . " pret.libelle as typeavance ,sourcepret.libelle as sourcepret,"
                        . " pret.id as id_avance, "
                        . " demandepret.nbrmois as nbrmois"
                        . " from historiqueretenue,pret, demandepret,sourcepret"
                        . " where historiqueretenue.id=" . $id
                        . " and historiqueretenue.id_demandepret=demandepret.id"
                        . " and historiqueretenue.id_demandepret=" . $id_demandepret
                        . " and demandepret.id_typepret= pret.id"
                        . " and demandepret.id_sourcepret=sourcepret.id"

                ;
            if ($id_retenue != "")
                $query = " select historiqueretenue.id as id  "
                        . " ,historiqueretenue.montantsoustre as montantmensielle,"
                        . " retenuesursalaire.id as iddemande,"
                        . "retenuesursalaire.montantpret as montanttotal, "
                        . " retenuesursalaire.datedebut as datedebut, "
                        . " retenuesursalaire.datefin as datefin, "
                        . " fournisseur.rs as typeavance ,"
                        . " retenuesursalaire.nbrmois as nbrmois"
                        . " from historiqueretenue,fournisseur, retenuesursalaire"
                        . " where historiqueretenue.id=" . $id
                        . " and historiqueretenue.id_retenue=retenuesursalaire.id"
                        . " and historiqueretenue.id_retenue=" . $id_retenue
                        . " and retenuesursalaire.id_fournisseur= fournisseur.id"

                ;

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }

        die("Erreur");
    }

    public function executeDemandepaiementspecifique(sfWebRequest $request) {
        
    }

    public function executeEdit(sfWebRequest $request) {

        $this->historiqueretenue = Doctrine_Core::getTable('historiqueretenue')->findOneById($request->getParameter('id'));
        $this->form = $this->configuration->getForm($this->historiqueretenue);
    }

    public function executeDelete(sfWebRequest $request) {
        $this->forward404Unless($historiqueretenue = Doctrine_Core::getTable('historiqueretenue')->find(array($request->getParameter('id'))), sprintf('Object fiche does not exist (%s).', $request->getParameter('id')));
        $historiqueretenue->delete();
        $this->redirect('@historiqueretenue');
    }

//edit document historique 

    public function executeEditDemandepaiement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $id = $params['id'];
            $mois = $params['mois'];
            $annee = $params['annee'];
            $liste = $params['liste'];


            $histrique = new Historiqueretenue();
//            $presnce->setIdAgents($idagents);
            if ($id != "") {
                $his = Doctrine_Core::getTable('Historiqueretenue')->findOneById($id);
                if ($his)
                    $histrique = $his;
            }
            foreach ($liste as $lignedoc) {
                $id = $lignedoc['id'];
                $montantmensielle = $lignedoc['montantmensielle'];
                $typeavance = $lignedoc['typeavance'];
                $nbrmois = $lignedoc['nbrmois'];
                $montantmensielle = $lignedoc['montantmensielle'];
                $montanttotal = $lignedoc['montanttotal'];

                if ($montantmensielle != "")
                    $histrique->setMontantsoustre($montantmensielle);

                if ($annee)
                    $histrique->setAnnee($annee);
                if ($mois)
                    $histrique->setMois($mois);

                $histrique->save();
                die("ajout avec succes");
            }
            if (sizeof($liste) == 0) {
                $histrique->setMontantsoustre("");
                $histrique->setMontant("");

                $histrique->setDatedemandeextraction("");
                $histrique->setIdDemandeavance("");
                $histrique->setIdDemandepret("");
                $histrique->setIdRetenue("");
            }
        }
        die('Erreur');
    }

    //modifer demande paiement

    public function executeModifierdocument(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $id = $params['id'];
            $liste = $params['liste'];
            $histrique = new Historiqueretenue();

            if ($id != "") {
                $his = Doctrine_Core::getTable('Historiqueretenue')->findOneById($id);
                if ($his)
                    $histrique = $his;
            }
        }
        die('Erreur');
    }

//delete ligne 

    public function executeDeleteligne(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

//        if (!empty($content)) {
        $params = json_decode($content, true);
        $id = $params['id'];
        print_r($id);
        $histrique = new Historiqueretenue();
        if ($id != "") {
            $his = Doctrine_Core::getTable('Historiqueretenue')->findOneById($id);
//            $his->setMontantsoustre(0);
//            $his->setMontant(0);
//            $his->setDatedemandeextraction("");
//            $his->setIdDemandeavance("");
//            $his->setIdDemandepret("");
//            $his->setIdRetenue("");
//            $his->save();
            Doctrine_Query::create()->delete('Historiqueretenue')
                    ->where('id=' . $id)->execute();
        }
//        }
        die('ok');
    }

    //save docuement historique 

    public function executeSavedocument(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $listesligne = $params['Listeavance'];
            $ids = $params['ids'];
            $type = $params['type'];
            $mois = $params['mois'];
            $annee = $params['annee'];
            $ids = explode(',,', $ids);
            foreach ($listesligne as $lignedoc) {
                $id = $lignedoc['id'];
                $montantmensielle = $lignedoc['montantmensielle'];
                $typeavance = $lignedoc['typeavance'];
                $nbrmois = $lignedoc['nbrmois'];
                // $id_avance = $lignedoc['id_avance'];
                $montanttotal = $lignedoc['montanttotal'];

                for ($i = 0; $i < sizeof($ids); $i++) {
                    $lignedoc = new Historiqueretenue();
                    if ($montantmensielle != "")
                        $lignedoc->setMontantsoustre($montantmensielle);
                    if ($montanttotal != "")
                        $lignedoc->setMontant($montanttotal);

                    $lignedoc->setDatedemandeextraction(date('Y-m-d'));
                    if ($id != "") {
                        if ($type == "0") {
                            $lignedoc->setIdDemandeavance($id);
                        }
                        if ($type == "1") {
                            $lignedoc->setIdDemandepret($id);
                        }
                        if ($type == "2") {
                            $lignedoc->setIdRetenue($id);
                        }
                    }
                }
                if ($mois != "")
                    $lignedoc->setMois($mois);
                if ($annee != "")
                    $lignedoc->setAnnee($annee);

                $lignedoc->save();
            }
        }
        die('ajout avec succe');
    }

    //save demande specifique 

    public function executeValiderdemandespecifique(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $Listepaiement = $params['Listepaiement'];
            $type_paiement = $params['type_paiement'];
            $ids = '';
            foreach ($Listepaiement as $lignedoc) {
                $id_demande = $lignedoc['id'];
                $montant = $lignedoc['montant'];
                $nbrmois = $lignedoc['nbrmois'];
                $montantmensuel = $lignedoc['montantmensuel'];

                $montantpaye = $lignedoc['montantpaye'];
                $nbrmoispaye = $lignedoc['nbrmoispaye'];
                $montantrestant = $lignedoc['montantrestant'];

                $datedebut = $lignedoc['datedebut'];
                $datefin = $lignedoc['datefin'];

                $mois = $lignedoc['mois'];
                $annee = $lignedoc['annee'];
                $reference = $lignedoc['reference'];
                $daterecue = $lignedoc['daterecue'];

                $lignedoc = new Historiqueretenue();
                if ($montantmensuel != "")
                    $lignedoc->setMontantmensuel($montantmensuel);
                if ($montant != "")
                    $lignedoc->setMontant($montant);
                if ($montantpaye != "")
                    $lignedoc->setMontantsoustre($montantpaye);
                if ($nbrmoispaye != "")
                    $lignedoc->setNbrmoispaye($nbrmoispaye);

                if ($reference != "")
                    $lignedoc->setReference($reference);
                if ($daterecue != "")
                    $lignedoc->setDaterecue($daterecue);

                $lignedoc->setDatedemandeextraction(date('Y-m-d'));
                if ($type_paiement != "") {
                    if ($type_paiement == "1") {
                        $lignedoc->setIdDemandeavance($id_demande);
                        if ($montantrestant == "0") {
                            $demandeavance = Doctrine_Core::getTable('demandeavance')->findOneById($id_demande);
                            $demandeavance->setPaye(true);
                            $demandeavance->save();
                        }
                    }
                    if ($type_paiement == "2") {
                        $lignedoc->setIdDemandepret($id_demande);
                        if ($montantrestant == "0") {
                            $demande = Doctrine_Core::getTable('demandepret')->findOneById($id_demande);
                            $demande->setPaye(true);
                            $demande->save();
                        }
                    }
                    if ($type_paiement == "3") {
                        $lignedoc->setIdRetenue($id_demande);
                        if ($montantrestant == "0") {
                            $demanderetenue = Doctrine_Core::getTable('retenuesursalire')->findOneById($id_demande);
                            $demanderetenue->setPaye(true);
                            $demanderetenue->save();
                        }
                    }
                }

                if ($montantrestant != "")
                    $lignedoc->setMontantrestant($montantrestant);

                if ($mois != "")
                    $lignedoc->setMois($mois);
                if ($annee != "")
                    $lignedoc->setAnnee($annee);

                $lignedoc->save();
                if ($ids != '')
                    $ids = $ids . ',' . $lignedoc->getId();
                else
                    $ids = $ids . $lignedoc->getId();
            }
            die($ids);
        }
        die('ajout avec succès');
    }

    public function executeTestexistence(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $mois = $params['mois'];
            $annee = $params['annee'];
            $type_paiement = $params['type_paiement'];
            $query = "";
            if ($type_paiement == "1")
                $query = " select historiqueretenue.id as id"
                        . " from historiqueretenue "
                        . " where  historiqueretenue.id_demandeavance= " . $id
                        . " and historiqueretenue.mois= " . intval($mois)
                        . " and historiqueretenue.annee=" . intval($annee);

            if ($type_paiement == "2")
                $query = " select historiqueretenue.id as id"
                        . " from historiqueretenue "
                        . " where  historiqueretenue.id_demandepret= " . $id
                        . " and historiqueretenue.mois= " . intval($mois)
                        . " and historiqueretenue.annee=" . intval($annee);

            if ($type_paiement == "3")
                $query = " select historiqueretenue.id as id"
                        . " from historiqueretenue "
                        . " where  historiqueretenue.id_retenue= " . $id
                        . " and historiqueretenue.mois= " . intval($mois)
                        . " and historiqueretenue.annee=" . intval($annee);

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }

        die("Erreur");
    }

    public function executeAfficehdetailDemandeAvance(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $demandeavance = $params['demandeavance'];
            $query = " select demandeavance.id as id, demandeavance.montanttotal as montanttotal"
                    . " , demandeavance.montantmensielle as montantmensielle "
                    . " ,demandeavance.datedebutretenue as datedebutretenue,"
                    . " demandeavance.datefinretenue as datefinretenue, "
                    . " avance.libelle as typeavance, avance.remboursement as remboursement"
                    . " from demandeavance,avance "
                    . " where  demandeavance.id= " . $demandeavance
                    . "  and demandeavance.id_typeavance = avance.id"
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }

        die("Erreur");
    }

    public function executeAfficehdetailDemandePret(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $demandepret = $params['demandepret'];
            $query = " select  demandepret.montantpret as montanttotal"
                    . " , demandepret.montantmentielle as montantmensielle "
                    . " ,demandepret.datedebutretenue as datedebutretenue,"
                    . " demandepret.datefinretenue as datefinretenue, "
                    . " pret.libelle as typeavance,sourcepret.libelle as source,"
                    . " demandepret.nbrmois as nbrmois"
                    . " from demandepret,pret,sourcepret "
                    . " where demandepret.id_typepret = pret.id"
                    . " and demandepret.id_sourcepret=sourcepret.id"
                    . " and demandepret.id= " . $demandepret
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }

        die("Erreur");
    }

    public function executeAfficehdetailDemandeRetenuesursalaire(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $demanderetenue = $params['demanderetenue'];
            $query = " select  retenuesursalaire.montantpret as montanttotal"
                    . " , retenuesursalaire.retenuesursalaire as montantmensielle "
                    . " ,retenuesursalaire.datedebut as datedebutretenue,"
                    . " retenuesursalaire.datefin as datefinretenue, "
                    . " retenuesursalaire.naturepret as naturepret, "
                    . " fournisseur.rs as source,"
                    . " retenuesursalaire.nbrmois as nbrmois"
                    . " from retenuesursalaire,fournisseur "
                    . " where retenuesursalaire.id_fournisseur =fournisseur.id"
                    . " and retenuesursalaire.id= " . $demanderetenue
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }

        die("Erreur");
    }

    public function executeImprimerListeRetenuemensielle(sfWebRequest $request) {

        $pdf = new sfTCPDF('L');

// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Des Retenues Mensielle');
        $pdf->SetSubject("Liste Des Retenues Mensielle");
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
        $html = $this->ReadHtmlListeRetenueMensielle($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Retenues mensielle.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeRetenueMensielle(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $demande = new Historiqueretenue();
        $html .= $demande->ReadHtmlListeRetenueMensielle($request);
        return $html;
    }

    //impression 

    public function executeImprimerListe(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $ids = $request->getParameter('ids');
//        $mois = $request->getParameter('mois');
//        $annee = $request->getParameter('annee');
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche de Demande Piament Spécifique:');
        $pdf->SetSubject("document du Demande Piament Spécifique");
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
        $html = $this->ReadHtmlListeDemande($ids);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste des Demandes Piaments Spécifiques' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeDemande($ids) {
        $html = StyleCssHeader::header1();
        $historique = new Historiqueretenue();
        $html .= $historique->ReadHtmlListeDemande($ids);
        return $html;
    }

}
