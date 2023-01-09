<?php

require_once dirname(__FILE__) . '/../lib/annexebudgetGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/annexebudgetGeneratorHelper.class.php';

/**
 * annexebudget actions.
 *
 * @package    Bmm
 * @subpackage annexebudget
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class annexebudgetActions extends autoAnnexebudgetActions {

    public function executeGenererTableAnnexe(sfWebRequest $request) {
        $this->titre = $request->getParameter('titre');
        $this->nbr = $request->getParameter('nbr');
        $this->direction = $request->getParameter('direction');
        $this->sommation = $request->getParameter('sommation');
    }

    public function executeAddRowTableAnnexe(sfWebRequest $request) {
        $this->id = $request->getParameter('id');
        $this->direction = $request->getParameter('direction');
        $this->sommation = $request->getParameter('sommation');
    }

    public function executeShowTableEdit(sfWebRequest $request) {
        $this->titre = $request->getParameter('titre');
        $this->direction = $request->getParameter('direction');
        $this->sommation_table = $request->getParameter('sommation_table');
        $this->rang = $request->getParameter('rang');
        $this->colonne = $request->getParameter('colonne');
        $this->type_colonne = $request->getParameter('type_colonne');
        $this->nature = $request->getParameter('nature');
        $this->formule = $request->getParameter('formule');
        $this->sommation = $request->getParameter('sommation');
        $this->total = $request->getParameter('total');
    }

    public function executeShow(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->annexe = AnnexebudgetTable::getInstance()->find($id);
    }
    
    public function executeShowExemple(sfWebRequest $request) {
        $this->titre = $request->getParameter('titre');
        $this->direction = $request->getParameter('direction');
        $this->sommation_table = $request->getParameter('sommation_table');
        $this->rang = $request->getParameter('rang');
        $this->colonne = $request->getParameter('colonne');
        $this->type_colonne = $request->getParameter('type_colonne');
        $this->nature = $request->getParameter('nature');
        $this->formule = $request->getParameter('formule');
        $this->sommation = $request->getParameter('sommation');
        $this->total = $request->getParameter('total');
    }

    public function executeSaveTable(sfWebRequest $request) {
        $id = $request->getParameter('id');

        $titre = $request->getParameter('titre');
        $direction = $request->getParameter('direction');
        $sommation_table = $request->getParameter('sommation_table');
        $nbr = $request->getParameter('nbr');

        $rang = $request->getParameter('rang');
        $colonne = $request->getParameter('colonne');
        $type_colonne = $request->getParameter('type_colonne');
        $nature = $request->getParameter('nature');
        $formule = $request->getParameter('formule');
        $sommation = $request->getParameter('sommation');
        $total = $request->getParameter('total');

        //Save Annexe Budget
        if ($id != "")
            $annexe = AnnexebudgetTable::getInstance()->find($id);
        else
            $annexe = new Annexebudget();

        $annexe->setDatecreation(date('Y-m-d'));
        $annexe->setTitre($titre);
        $annexe->setDirection($direction);
        $annexe->setNbrcolonne($nbr);
        if ($sommation_table != "false")
            $annexe->setSommation(true);
        else
            $annexe->setSommation(false);
        $annexe->save();

        //delete old Annexe Budget Ligne
        if ($id != "") {
            foreach ($annexe->getAnnexebudgetligne() as $ligne) {
                $ligne->delete();
            }
        }

        //Save Annexe Budget Ligne
        $rang = explode(",", $rang);
        $colonne = explode(";;", $colonne);
        $type_colonne = explode(",", $type_colonne);
        $nature = explode(",", $nature);
        $formule = explode(",", $formule);
        $sommation = explode(",", $sommation);
        $total = explode(",", $total);

        for ($i = 0; $i <= sizeof($rang); $i++) {
            if ($rang[$i] != '') {
                $ligne_annexe = new Annexebudgetligne();
                $ligne_annexe->setRang($rang[$i]);
                $ligne_annexe->setLibelle($colonne[$i]);
                $ligne_annexe->setType($type_colonne[$i]);
                $ligne_annexe->setNature($nature[$i]);
                $ligne_annexe->setFormule($formule[$i]);
                $ligne_annexe->setSommation($sommation[$i]);
                $ligne_annexe->setTotal($total[$i]);
                $ligne_annexe->setIdAnnexebudget($annexe->getId());
                $ligne_annexe->save();
            }
        }

        die("OK");
    }

    public function executeDeleteAnnexeRubrique(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $rubrique_annexes = AnnexebudgetrubriqueTable::getInstance()->findByIdLigprotitrub($id);
        foreach ($rubrique_annexes as $rubrique_annexe):
            $rubrique_annexe->delete();
        endforeach;

        die("OK");
    }

    public function executeSaveAnnexeRubrique(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $id_annexe = $request->getParameter('id_annexe');
        $description = $request->getParameter('description');
        $contenu = $request->getParameter('contenu');
        $total = $request->getParameter('total');

        $annexe_rubrique = new Annexebudgetrubrique();
        $annexe_rubrique->setDatecreation(date('Y-m-d'));
        $annexe_rubrique->setIdAnnexebudget($id_annexe);
        $annexe_rubrique->setIdLigprotitrub($id);
        $annexe_rubrique->setDescription($description);
        $annexe_rubrique->setContenu($contenu);
        $annexe_rubrique->setTotal($total);
        $annexe_rubrique->save();

        $this->id_annexe_rubrique = $annexe_rubrique->getId();
    }

    public function executeSaveResultAnnexeRubrique(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $results = $request->getParameter('results');

        $annexe_rubrique = AnnexebudgetrubriqueTable::getInstance()->find($id);
        $contenu = $annexe_rubrique->getContenu();
        $contenu = $contenu . '<div style="display:none;" id="saved_result_data_salaire_1">' . $results . '</div>';
        $annexe_rubrique->setContenu($contenu);
        $annexe_rubrique->save();

        die("OK");
    }

    public function executeSaveDataAnnexeRubrique(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $m = $request->getParameter('m');
        $value_td = $request->getParameter('value_td');

        $annexe_rubrique = AnnexebudgetrubriqueTable::getInstance()->find($id);
        $contenu = $annexe_rubrique->getContenu();
        $contenu = $contenu . '<input type="hidden" id="saved_data_salaire_1_' . $m . '" value="' . $value_td . '">';
        $annexe_rubrique->setContenu($contenu);
        $annexe_rubrique->save();

        die("OK");
    }

    public function executeSaveMontantRubrique(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $montant = $request->getParameter('montant');

        $ligprotitrub = LigprotitrubTable::getInstance()->find($id);
        $diff_montant = $montant - $ligprotitrub->getMnt();
        $ligprotitrub->setMnt($montant);
        $ligprotitrub->save();
        if ($ligprotitrub->getRubrique()->getIdRubrique() != null && $diff_montant != 0) {
            $this->setMontantParentRubrique($ligprotitrub, $diff_montant);
        } else {
            if ($diff_montant != 0) {
                $titre = TitrebudjetTable::getInstance()->find($ligprotitrub->getIdTitre());
                $new_montant_global = $titre->getMntglobal() + $diff_montant;
                $titre->setMntglobal($new_montant_global);
                $titre->save();
            }
        }

        die("OK");
    }

    function setMontantParentRubrique($ligprotitrub, $diff_montant) {
        $ligprotitrub_parent = LigprotitrubTable::getInstance()->findOneByIdRubriqueAndIdTitre($ligprotitrub->getRubrique()->getIdRubrique(), $ligprotitrub->getIdTitre());
        if ($ligprotitrub_parent) {
            $new_montant = $ligprotitrub_parent->getMnt() + $diff_montant;
            $ligprotitrub_parent->setMnt($new_montant);
            $ligprotitrub_parent->save();

            if ($ligprotitrub_parent->getRubrique()->getIdRubrique() != null && $diff_montant != 0) {
                $this->setMontantParentRubrique($ligprotitrub_parent, $diff_montant);
            } else {
                if ($diff_montant != 0) {
                    $titre = TitrebudjetTable::getInstance()->find($ligprotitrub_parent->getIdTitre());
                    $new_montant_global = $titre->getMntglobal() + $diff_montant;
                    $titre->setMntglobal($new_montant_global);
                    $titre->save();
                }
            }
        }
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

        $annexe = $this->getRoute()->getObject();
        //delete Annexe Budget Ligne
        foreach ($annexe->getAnnexebudgetligne() as $ligne) {
            $ligne->delete();
        }

        if ($this->getRoute()->getObject()->delete()) {
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }

        $this->redirect('@annexebudget');
    }

}
