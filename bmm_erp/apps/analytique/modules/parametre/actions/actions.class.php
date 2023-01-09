<?php

/**
 * parametre actions.
 *
 * @package    sw-commerciale
 * @subpackage parametre
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class parametreActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */

    //Exercice Comptable //////////////////////////////////////////////////////////////////////////////////////////
    function getAllExercice(sfWebRequest $request) {
        $libelle = strtoupper($request->getParameter('libelle', ''));

        $pager = new sfDoctrinePager('Exercice', 5);
        $pager->setQuery(ExerciceTable::getInstance()->getAllExercice($libelle));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeListeExercice(sfWebRequest $request) {
        $this->pager = $this->getAllExercice($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_exercice", array("pager" => $this->pager));
        }
    }

    public function executeAjouterExercice(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->findByLibelle($request->getParameter('new_libelle'));
        if ($exercice->count() != 0) {
            return $this->renderText('existe');
        } else {
            $exercice = new Exercice();
            $exercice->setLibelle($request->getParameter('new_libelle'));
            $exercice->setDateDebut($request->getParameter('date_debut'));
            $exercice->setDateFin($request->getParameter('date_fin'));
            $exercice->save();

            $pager = $this->getAllExercice($request);
            return $this->renderPartial("liste_exercice", array("pager" => $pager));
        }
    }

    public function executeDeleteExercice(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($request->getParameter('id'));
        $dossier_exercice = DossierexerciceTable::getInstance()->findByIdExercice($request->getParameter('id'));
        foreach ($dossier_exercice as $de) {
            $de->delete();
        }
        $exercice->delete();

        $pager = $this->getAllExercice($request);
        return $this->renderPartial("liste_exercice", array("pager" => $pager));
    }

    public function executeEditExercice(sfWebRequest $request) {
        $this->exercice = ExerciceTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeUpdateExercice(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->getForExiste($request->getParameter('new_libelle'), $request->getParameter('id'));
        if ($exercice->count() != 0) {
            return $this->renderText('existe');
        } else {
            $exercice = ExerciceTable::getInstance()->find($request->getParameter('id'));
            $exercice->setLibelle($request->getParameter('new_libelle'));
            $exercice->setDateDebut($request->getParameter('date_debut'));
            $exercice->setDateFin($request->getParameter('date_fin'));
            $exercice->save();

            $pager = $this->getAllExercice($request);
            return $this->renderPartial("liste_exercice", array("pager" => $pager));
        }
    }

}
