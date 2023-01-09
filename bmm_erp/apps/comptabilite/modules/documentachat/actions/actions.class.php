<?php

/**
 * documentachat actions.
 *
 * @package    Bmm
 * @subpackage documentachat
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class documentachatActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->forward('default', 'module');
    }

    public function executeGetListePourMouvementFactureComptable(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin =  $exercice->getDateFin();
//        die($date_debut.'-'.$date_fin);
        $query = "select a.numero as numero , a.id as id "
                . "from facturecomptableachat a "
                . " where a.saisie=0 "
                . " and a.id_dossier = " . $_SESSION['dossier_id']
                . " and a.date >='" . $date_debut . "'"
                . " and a.date <='" . $date_fin . "'"
        ;

//        $query = "select documentachat.id as id, LPAD(documentachat.numero::text, 5, '0') as numero"
//                . ", typedoc.prefixetype as type"
//                . " from documentachat, typedoc "
//                . " where documentachat.etatdocachat IS NULL "
//                . " AND documentachat.id_typedoc=typedoc.id "
//                . " AND (documentachat.id_typedoc = 15) "
//                . " AND documentachat.datesignature IS NOT NULL "
//                . " AND documentachat.id IN (SELECT piecejointbudget.id_docachat FROM piecejointbudget, documentbudget WHERE piecejointbudget.id_documentbudget = documentbudget.id AND documentbudget.mnt IS NOT NULL) "
////                . " AND documentachat.id IN (SELECT lignemouvementfacturation.id_documentachat FROM lignemouvementfacturation) "
////                . " AND documentachat.id NOT IN (SELECT id_docparent FROM documentachat WHERE id_docparent IS NOT NULL AND etatdocachat IS NULL) "
//                . " order by documentachat.id desc ";
////die($query);
//$facturecomptable_dossier= FacturecomptableachatTable::getInstance()->findByIdDossierAndSaisie($_SESSION['dossier_id'],0);

        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourMouvementReglementComptable(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();
        $query = "select * from Reglementcomptable r "
                . " where r.saisie=0 "
                . " and r.id_dossier = " . $_SESSION['dossier_id']
                . " and r.date >='" . $date_debut . "'"
                . " and r.date <='" . $date_fin . "'";
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListePourFactureodcomptable(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();
        
        $query = "select * from facturecomptableod fac "
                . " where fac.saisie=0 "
//                . " and fac.id_dossier = " . $_SESSION['dossier_id']
                . " and fac.date >='" . $date_debut . "'"
                . " and fac.date <='" . $date_fin . "'";
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }
}
