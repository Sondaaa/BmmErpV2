<?php

/**
 * transfert actions.
 *
 * @package    sw-commerciale
 * @subpackage transfert
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class transfertActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->classe_compte = ClassecompteTable::getInstance()->findAll();
    }

    public function executeCompteparnumero(sfWebRequest $request) {

        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $numero = $params['numero'];
            if ($numero) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT plandossiercomptable.id as id ,concat( TRIM(plandossiercomptable.numerocompte),' - ' ,plandossiercomptable.libelle) as name"
                        . " FROM plancomptable,plandossiercomptable"
                        . " WHERE plandossiercomptable.numerocompte LIKE '" . $numero . "%'"
                        . " AND plandossiercomptable.id_plan=plancomptable.id"
                        . " AND plancomptable.standard=0"
                        . " and plandossiercomptable.id_dossier=" . $_SESSION['dossier_id']
                        . " and plandossiercomptable.id_exercice=" . $_SESSION['exercice_id']
                        . " ORDER BY plandossiercomptable.numerocompte"
                        
                ;
                $comptes = $conn->fetchAssoc($query);

                die(json_encode($comptes));
            }
        }die('Erreur');
    }

    public function executeGetHierarchie(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $listes = array();
        while ($id != null) {
            $compte = PlancomptableTable::getInstance()->find($id);

            $compte_liste = array();
            $compte_liste['id'] = $compte->getId();
            $compte_liste['libelle'] = '<b style="color: #0066cc;">' . trim($compte->getNumerocompte()) . '</b> : ' . trim($compte->getLibelle());

            array_push($listes, $compte_liste);

            $id = $compte->getIdCompte();
        }
        return $this->renderPartial('transfert/hierarchie', array('listes' => $listes));
    }

    public function executeAllBaseStandard(sfWebRequest $request) {

        $listes = PlancomptableTable::getInstance()->findOrderByNumero();

        foreach ($listes as $plan) {
            $plan_dossier = new Plandossiercomptable();

            $plan_dossier->setIdDossier($_SESSION['dossier_id']);
            $plan_dossier->setIdExercice($_SESSION['exercice_id']);
            $plan_dossier->setIdPlan($plan->getId());
            $plan_dossier->setDate($plan->getDate());
            $plan_dossier->setLettrage($plan->getLettrage());
            $plan_dossier->setLibelle($plan->getLibelle());
            $plan_dossier->setNumerocompte($plan->getNumerocompte());
            $plan_dossier->setSolde(0);
            $plan_dossier->setTypesolde($plan->getTypesolde());

            $plan_dossier->save();
        }

        return true;
    }

    public function executeAllClassComptable(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $listes = PlancomptableTable::getInstance()->findByClasseOrderByNumero($id);
        foreach ($listes as $plan) {
            $plan_dossier = new Plandossiercomptable();

            $plan_dossier->setIdDossier($_SESSION['dossier_id']);
            $plan_dossier->setIdExercice($_SESSION['exercice_id']);
            $plan_dossier->setIdPlan($plan->getId());
            $plan_dossier->setDate($plan->getDate());
            $plan_dossier->setLettrage($plan->getLettrage());
            $plan_dossier->setLibelle($plan->getLibelle());
            $plan_dossier->setNumerocompte($plan->getNumerocompte());
            $plan_dossier->setSolde(0);
            $plan_dossier->setTypesolde($plan->getTypesolde());

            $plan_dossier->save();
        }

        return true;
    }

    public function executeOneCompteComptable(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $compte = PlancomptableTable::getInstance()->find($id);

        $listes = array();
        $compte_liste = array();
        $compte_liste['id'] = $id;
        array_push($listes, $compte_liste);

        while ($compte->getIdCompte() != null) {
            $compte_liste = array();
            $compte_liste['id'] = $compte->getIdCompte();

            array_push($listes, $compte_liste);
            $compte = PlancomptableTable::getInstance()->find($compte->getIdCompte());
        }

        for ($i = sizeof($listes) - 1; $i >= 0; $i--) {
            $plan = PlancomptableTable::getInstance()->find($listes[$i]['id']);

            $plan_dossier = new Plandossiercomptable();

            $plan_dossier->setIdDossier($_SESSION['dossier_id']);
            $plan_dossier->setIdExercice($_SESSION['exercice_id']);
            $plan_dossier->setIdPlan($plan->getId());
            $plan_dossier->setDate($plan->getDate());
            $plan_dossier->setLettrage($plan->getLettrage());
            $plan_dossier->setLibelle($plan->getLibelle());
            $plan_dossier->setNumerocompte($plan->getNumerocompte());
            $plan_dossier->setSolde(0);
            $plan_dossier->setTypesolde($plan->getTypesolde());

            $plan_dossier->save();
        }

        return true;
    }

    public function executeListCompteComptable(sfWebRequest $request) {
        $ids = $request->getParameter('ids');
        $ids = explode(',,', $ids);

        for ($j = 0; $j < sizeof($ids); $j++) {
            if ($ids[$j] != '') {
                $compte = PlancomptableTable::getInstance()->find($ids[$j]);

                $listes = array();
                $compte_liste = array();
                $compte_liste['id'] = $compte->getId();
                array_push($listes, $compte_liste);

                while ($compte->getIdCompte() != null) {
                    $compte_liste = array();
                    $compte_liste['id'] = $compte->getIdCompte();

                    array_push($listes, $compte_liste);
                    $compte = PlancomptableTable::getInstance()->find($compte->getIdCompte());
                }

                for ($i = sizeof($listes) - 1; $i >= 0; $i--) {
                    $plan = PlancomptableTable::getInstance()->find($listes[$i]['id']);

                    $plan_dossier = new Plandossiercomptable();

                    $plan_dossier->setIdDossier($_SESSION['dossier_id']);
                    $plan_dossier->setIdExercice($_SESSION['exercice_id']);
                    $plan_dossier->setIdPlan($plan->getId());
                    $plan_dossier->setDate($plan->getDate());
                    $plan_dossier->setLettrage($plan->getLettrage());
                    $plan_dossier->setLibelle($plan->getLibelle());
                    $plan_dossier->setNumerocompte($plan->getNumerocompte());
                    $plan_dossier->setSolde(0);
                    $plan_dossier->setTypesolde($plan->getTypesolde());

                    $plan_dossier->save();
                }
            }
        }
        return true;
    }

    public function executeDossierForCompte(sfWebRequest $request) {
        $this->comptes = PlanComptableTable::getInstance()->findOrderByNumero();
    }

    public function executeSaveDossierForCompte(sfWebRequest $request) {
        $dossier_id = $request->getParameter('dossier');
        $compte_id = $request->getParameter('compte');

        $compte = PlanComptableTable::getInstance()->find($compte_id);
        $dossiercompte = new PlanDossierComptable();
        $dossiercompte->setDossierId($dossier_id);
        $dossiercompte->setPlanId($compte_id);
        $dossiercompte->setLibelle($compte->getLibelle());
        $dossiercompte->setNumeroCompte($compte->getNumeroCompte());
        $dossiercompte->setTypeSolde($compte->getTypeSolde());
        $dossiercompte->setLettrage($compte->getLettrage());
        $dossiercompte->setDate(date('Y-m-d'));
        $dossiercompte->save();

        return true;
    }

    public function executeListeCompteForDossier(sfWebRequest $request) {
        $comptes = PlanComptableTable::getInstance()->findOrderByNumero();
        $dossier = $request->getParameter('dossier');

        return $this->renderPartial('transfert/list_comptes', array('comptes' => $comptes, 'dossier' => $dossier));
    }

    public function executeDossierForManyCompte(sfWebRequest $request) {
        $this->comptes = PlanComptableTable::getInstance()->findOrderByNumero();
        if ($this->getUser()->getTypeUser() == 'SuperAdmin')
            $this->dossiers = DossierComptableTable::getInstance()->findAll();
        else
            $this->dossiers = DossierComptableTable::getInstance()->findByEmploye($this->getUser()->getId());
    }

    public function executeSaveDossierForManyCompte(sfWebRequest $request) {
        $dossier = $request->getParameter('dossier');
        $comptes = $request->getParameter('comptes');

        $comptes = explode(',', $comptes);

        for ($i = 0; $i < sizeof($comptes); $i++) {

            if ($comptes[$i] != '') {
                $compte = PlanComptableTable::getInstance()->find($comptes[$i]);

                $dossiercompte = new PlanDossierComptable();
                $dossiercompte->setDossierId($dossier);
                $dossiercompte->setPlanId($comptes[$i]);
                $dossiercompte->setLibelle($compte->getLibelle());
                $dossiercompte->setNumeroCompte($compte->getNumeroCompte());
                $dossiercompte->setTypeSolde($compte->getTypeSolde());
                $dossiercompte->setLettrage($compte->getLettrage());
                $dossiercompte->setDate(date('Y-m-d'));
                $dossiercompte->save();
            }
        }
        return true;
    }

    public function executeDossierForDossier(sfWebRequest $request) {
        $this->comptes = PlanComptableTable::getInstance()->findOrderByNumero();
        if ($this->getUser()->getTypeUser() == 'SuperAdmin')
            $this->dossiers = DossierComptableTable::getInstance()->findAll();
        else
            $this->dossiers = DossierComptableTable::getInstance()->findByEmploye($this->getUser()->getId());
    }

    public function executeListeDossierForDossierSelect(sfWebRequest $request) {
        $dossier = $request->getParameter('dossier');
        $comptes = PlanComptableTable::getInstance()->findOrderByNumero();
        if ($this->getUser()->getTypeUser() == 'SuperAdmin')
            $dossiers = DossierComptableTable::getInstance()->findAll();
        else
            $dossiers = DossierComptableTable::getInstance()->findByEmploye($this->getUser()->getId());
        $chiffre = DossierComptableTable::getInstance()->find($dossier)->getNombreChiffreNumeroCompte();

        return $this->renderPartial('transfert/list_dossiers_select', array('comptes' => $comptes, 'dossiers' => $dossiers, 'dossier' => $dossier, 'chiffre' => $chiffre));
    }

    public function executeSaveDossierForDossier(sfWebRequest $request) {
        $dossier = $request->getParameter('dossier');
        $dossier_destin = $request->getParameter('dossier_destin');
        $comptes = $request->getParameter('comptes');

        $comptes = explode(',', $comptes);

        for ($i = 0; $i < sizeof($comptes); $i++) {
            if ($comptes[$i] != '') {

                $compte = PlanComptableTable::getInstance()->find($comptes[$i]);

                $dossiercompte = new PlanDossierComptable();
                $dossiercompte->setDossierId($dossier_destin);
                $dossiercompte->setPlanId($comptes[$i]);
                $dossiercompte->setLibelle($compte->getLibelle());
                $dossiercompte->setNumeroCompte($compte->getNumeroCompte());
                $dossiercompte->setTypeSolde($compte->getTypeSolde());
                $dossiercompte->setLettrage($compte->getLettrage());
                $dossiercompte->setDate(date('Y-m-d'));
                $dossiercompte->save();
            }
        }

        return true;
    }

}
