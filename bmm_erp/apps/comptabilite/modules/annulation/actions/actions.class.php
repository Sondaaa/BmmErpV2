<?php

/**
 * annulation actions.
 *
 * @package    Bmm
 * @subpackage annulation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class annulationActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $this->comptes = PlandossiercomptableTable::getInstance()->getPlanComptableOrderByNumero($dossier_id, $exercice_id);
        //$this->comptes = PlandossiercomptableTable::getInstance()->getPlanComptableMinchiffreOrderByNumero($_SESSION['dossier_id'], $exercice_id);
        $this->classes = ClassecompteTable::getInstance()->findAll();
    }

    public function executeAnnulationBalance(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];

        $this->comptes = PlandossiercomptableTable::getInstance()->getBalance($_SESSION['dossier_id'], $exercice_id);
        $this->classes = ClassecompteTable::getInstance()->findAll();
    }

    public function executeSupprimerComptecomptables(sfWebRequest $request) {
        $compte_min = $request->getParameter('compte_min', '');
        $compte_max = $request->getParameter('compte_max', '');
        $dossier_id = $_SESSION['dossier_id'];
        $exercice = $_SESSION['exercice'];
        $exercice_id = $_SESSION['exercice_id'];
        $comptes = array();
        $id_compte = array();
        $comptes_interval = PlanDossierComptableTable::getInstance()->loadByInterval($compte_min, $compte_max, $dossier_id, $exercice_id);
        $i = 0;

        foreach ($comptes_interval as $c_i) {
            $id_plan = $c_i->getIdPlan();
            $fornisseur = FournisseurTable::getInstance()->finByIdPlancomptable($id_plan);
            $fornisseur->delete();
            $plandossier = PlandossiercomptableTable::getInstance()->findOneById($c_i->getId());
            $plandossier->delete();
            $plan = PlancomptableTable::getInstance()->findOneById($id_plan);
            $plan->delete();

            $i++;
        }
        $compte_comptable = PlandossiercomptableTable::getInstance()->getPlanComptableOrderByNumero($dossier_id, $exercice_id);
        return $this->renderPartial("list_comptes_plan_dossier", array("comptes" => $compte_comptable));
    }

    public function executeSupprimerSoldeComptecomptables(sfWebRequest $request) {
        $compte_min = $request->getParameter('compte_min', '');
        $compte_max = $request->getParameter('compte_max', '');
        $dossier_id = $_SESSION['dossier_id'];
        $exercice = $_SESSION['exercice'];
        $exercice_id = $_SESSION['exercice_id'];
        $comptes = array();
        $id_compte = array();
        $comptes_interval = PlanDossierComptableTable::getInstance()->loadByInterval($compte_min, $compte_max, $dossier_id, $exercice_id);
        $i = 0;
        foreach ($comptes_interval as $c_i) {
            $id_plan = $c_i->getIdPlan();
            $plandossier = PlandossiercomptableTable::getInstance()->findOneById($c_i->getId());
            $plandossier->setTypesolde('3');
            $plandossier->setSolde('0.000');
            $plandossier->save();
            $i++;
        }
        $compte_comptable = PlandossiercomptableTable::getInstance()->getBalance($_SESSION['dossier_id'], $exercice_id);
        return $this->renderPartial("list_comptes_balance", array("comptes" => $compte_comptable));
    }

    public function executeSupprimerFacturescomptablesAchats(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();
        $facture_min = $request->getParameter('facture_min', '');
        $facture_max = $request->getParameter('facture_max', '');
        $factures = array();
        $facture_interval = FacturecomptableachatTable::getInstance()->loadByInterval($facture_min, $facture_max, $date_debut, $date_fin);
        $i = 0;
        foreach ($facture_interval as $c_i) {

            $facture = FacturecomptableachatTable::getInstance()->findOneById($c_i->getId());
            $facture->delete();
            $i++;
        }
//        die('ok');
        $factures = FacturecomptableachatTable::getInstance()->findByPeriode($date_debut, $date_fin);
        return $this->renderPartial("annulation/liste_achat", array("factures" => $factures,));
    }

    public function executeSupprimerFacturescomptablesOd(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();
        $facture_min = $request->getParameter('facture_min', '');
        $facture_max = $request->getParameter('facture_max', '');
        $factures = array();
        $facture_interval = FacturecomptableodTable::getInstance()->loadByInterval($facture_min, $facture_max, $date_debut, $date_fin);
        $i = 0;
        foreach ($facture_interval as $c_i) {

            $facture = FacturecomptableodTable::getInstance()->findOneById($c_i->getId());
            $facture->delete();
            $i++;
        }
        $factures = FacturecomptableodTable::getInstance()->findByPeriode($date_debut, $date_fin);
        return $this->renderPartial("annulation/liste_od", array("factures" => $factures,));
    }

    public function executeSupprimerFacturescomptablesOdClient(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();
        $facture_min = $request->getParameter('facture_min', '');
        $facture_max = $request->getParameter('facture_max', '');
        $factures = array();
        $facture_interval = FacturecomptableodclientTable::getInstance()->loadByInterval($facture_min, $facture_max, $date_debut, $date_fin);
        $i = 0;
        foreach ($facture_interval as $c_i) {

            $facture = FacturecomptableodclientTable::getInstance()->findOneById($c_i->getId());
            $facture->delete();
            $i++;
        }
        $factures = FacturecomptableodclientTable::getInstance()->findByPeriode($date_debut, $date_fin);
        return $this->renderPartial("annulation/liste_od_client", array("factures" => $factures,));
    }

    public function executeSupprimerFacturescomptablesVentes(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();
        $facture_min = $request->getParameter('facture_min', '');
        $facture_max = $request->getParameter('facture_max', '');
        $factures = array();
        $facture_interval = FacturecomptableventeTable::getInstance()->loadByInterval($facture_min, $facture_max, $date_debut, $date_fin);
        $i = 0;

        foreach ($facture_interval as $c_i) {
            $facture = FacturecomptableventeTable::getInstance()->findOneById($c_i->getId());
            $facture->delete();
            $i++;
        }
        $factures = FacturecomptableventeTable::getInstance()->findByPeriode($date_debut, $date_fin);

        return $this->renderPartial("annulation/liste_vente", array("factures" => $factures,));
    }

    public function executeSupprimerReglement(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();
        $reglement_min = $request->getParameter('reglement_min', '');
        $reglement_max = $request->getParameter('reglement_max', '');
        $reglements = array();
        $reglement_interval = ReglementcomptableTable::getInstance()->loadByInterval($reglement_min, $reglement_max, $date_debut, $date_fin);
        $i = 0;
        foreach ($reglement_interval as $c_i) {
            $reglement = ReglementcomptableTable::getInstance()->findOneById($c_i->getId());
            $reglement->delete();
            $i++;
        }
        $reglements = ReglementcomptableTable::getInstance()->findByPeriode($date_debut, $date_fin);
        return $this->renderPartial("annulation/liste_tresorerie", array("reglements" => $reglements));
    }

    public function executeSupprimerMouvement(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();
        $mouvement_min = $request->getParameter('mouvement_min', '');
        $mouvement_max = $request->getParameter('mouvement_max', '');
        $reglements = array();
        $mouvement_interval = MovementpieceTable::getInstance()->loadByInterval($mouvement_min, $mouvement_max, $date_debut, $date_fin);
        $i = 0;
        foreach ($mouvement_interval as $c_i) {
            $mouvement = MovementpieceTable::getInstance()->findOneById($c_i->getId());
            $mouvement->delete();
            $i++;
        }
        $mouvements = MovementpieceTable::getInstance()->findByPeriode($date_debut, $date_fin);
        return $this->renderPartial("annulation/liste_mouvement", array("mouvements" => $mouvements));
    }

    function getAllBalance(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $pager = new sfDoctrinePager('Plandossiercomptable', 5);
        $pager->setQuery(PlandossiercomptableTable::getInstance()->getBalance($dossier_id, $exercice_id));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        return $pager;
    }

    public function executeAfficherComptescomptables(sfWebRequest $request) {
        $compte_min = $request->getParameter('compte_min', '');
        $compte_max = $request->getParameter('compte_max', '');

        $dossier_id = $_SESSION['dossier_id'];
        $exercice = $_SESSION['exercice'];
        $exercice_id = $_SESSION['exercice_id'];
        $comptes = PlandossiercomptableTable::getInstance()->loadByInterval($compte_min, $compte_max, $dossier_id, $exercice_id);
        return $this->renderPartial("list_comptes_plan_dossier", array("comptes" => $comptes, "compte_min" => $compte_min, "compte_max" => $compte_max));
    }

    public function executeAfficherComptescomptablesdansbalance(sfWebRequest $request) {
        $compte_min = $request->getParameter('compte_min', '');
        $compte_max = $request->getParameter('compte_max', '');

        $dossier_id = $_SESSION['dossier_id'];
        $exercice = $_SESSION['exercice'];
        $exercice_id = $_SESSION['exercice_id'];
        $comptes = PlandossiercomptableTable::getInstance()->loadByIntervalEtBalance($compte_min, $compte_max, $dossier_id, $exercice_id);
        return $this->renderPartial("list_comptes_balance", array("comptes" => $comptes, "compte_min" => $compte_min, "compte_max" => $compte_max));
    }

    public function executeAfficherFacturescomptablesAchats(sfWebRequest $request) {
        $facture_min = $request->getParameter('facture_min', '');
        $facture_max = $request->getParameter('facture_max', '');
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();
        $factures = FacturecomptableachatTable::getInstance()->loadByInterval($facture_min, $facture_max, $date_debut, $date_fin);
        return $this->renderPartial("annulation/liste_achat", array("factures" => $factures));
    }

    public function executeAfficherFacturescomptablesOd(sfWebRequest $request) {
        $facture_min = $request->getParameter('facture_min', '');
        $facture_max = $request->getParameter('facture_max', '');
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();
        $factures = FacturecomptableodTable::getInstance()->loadByInterval($facture_min, $facture_max, $date_debut, $date_fin);
        return $this->renderPartial("annulation/liste_od", array("factures" => $factures));
    }

    public function executeAfficherFacturescomptablesOdClient(sfWebRequest $request) {
        $facture_min = $request->getParameter('facture_min', '');
        $facture_max = $request->getParameter('facture_max', '');
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();
        $factures = FacturecomptableodclientTable::getInstance()->loadByInterval($facture_min, $facture_max, $date_debut, $date_fin);
        return $this->renderPartial("annulation/liste_od_client", array("factures" => $factures));
    }

    public function executeAfficherFacturescomptablesVentes(sfWebRequest $request) {
        $facture_min = $request->getParameter('facture_min', '');
        $facture_max = $request->getParameter('facture_max', '');
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();
        $factures = FacturecomptableventeTable::getInstance()->loadByInterval($facture_min, $facture_max, $date_debut, $date_fin);
        return $this->renderPartial("annulation/liste_vente", array("factures" => $factures));
    }

    public function executeAfficherReglementtresorerie(sfWebRequest $request) {
        $reglement_min = $request->getParameter('reglement_min', '');
        $reglement_max = $request->getParameter('reglement_max', '');
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();
        $reglements = ReglementcomptableTable::getInstance()->loadByInterval($reglement_min, $reglement_max, $date_debut, $date_fin);
        return $this->renderPartial("annulation/liste_tresorerie", array("reglements" => $reglements));
    }

    public function executeAfficherMouvement(sfWebRequest $request) {
        $mouvement_min = $request->getParameter('mouvement_min', '');
        $mouvement_max = $request->getParameter('mouvement_max', '');
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();
        $mouvements = MovementpieceTable::getInstance()->loadByInterval($mouvement_min, $mouvement_max, $date_debut, $date_fin);
        return $this->renderPartial("annulation/liste_mouvement", array("mouvements" => $mouvements));
    }

    public function executeAnnulationachat(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();

        $this->factures = FacturecomptableachatTable::getInstance()->findByPeriode($date_debut, $date_fin);
    }

    public function executeAnnulationfacturevente(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();

        $this->factures = FacturecomptableventeTable::getInstance()->findByPeriode($date_debut, $date_fin);
    }

    public function executeAnnulationTresorerie(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();

        $this->reglements = ReglementcomptableTable::getInstance()->findByPeriode($date_debut, $date_fin);
    }

    public function executeAnnulationMouvemnet(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();

        $this->mouvements = MouvementcomptableTable::getInstance()->RechercheByPeriode($date_debut, $date_fin);
    }

    public function executeAnnulationod(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();

        $this->factures = FacturecomptableodTable::getInstance()->findByPeriode($date_debut, $date_fin);
    }

    public function executeAnnulationMouvemnetpiece(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();
        $id_dossier = $_SESSION['dossier_id'];
        $this->factures = MovementpieceTable::getInstance()->findByPeriode($date_debut, $date_fin, $id_dossier);
    }

    public function executeAnnulationodClient(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();

        $this->factures = FacturecomptableodclientTable::getInstance()->findByPeriode($date_debut, $date_fin);
    }

}
