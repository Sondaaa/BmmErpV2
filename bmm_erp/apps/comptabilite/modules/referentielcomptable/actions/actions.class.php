<?php

/**
 * referentielcomptable actions.
 *
 * @package    Bmm
 * @subpackage referentielcomptable
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class referentielcomptableActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->pager = $this->getAllReferentiels($request);
        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_referentiel", array("pager" => $this->pager));
        }
    }

    public function executeReferentiel(sfWebRequest $request) {
        $referentielcomptable = ReferentielcomptableTable::getInstance()->findAll();
        $referentielcomptable = new Referentielcomptable();
        $referentielcomptable->setLibelle($request->getParameter('new_libelle'));
        $referentielcomptable->save();
        $this->referentielcomptable = ReferentielcomptableTable::getInstance()->getAllByOrder();
    }

    function getAllReferentiels(sfWebRequest $request) {
        $libelle = strtoupper($request->getParameter('libelle', ''));
        $pager = new sfDoctrinePager('Referentielcomptable', 5);
        $pager->setQuery(ReferentielcomptableTable::getInstance()->getAllReferentiel($libelle));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        return $pager;
    }

    public function executeListeReferentiel(sfWebRequest $request) {

        $this->pager = $this->getAllReferentiels($request);
        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_referentiel", array("pager" => $this->pager));
        }
    }

    public function executeListePieceJuridique(sfWebRequest $request) {

        $this->pager = $this->getAllPiecesJuridiques($request);
        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_piecesjuridique", array("pager" => $this->pager));
        }
    }

    function getAllPiecesJuridiques(sfWebRequest $request) {
        $libelle = strtoupper($request->getParameter('libelle', ''));
        $id_dossier = $_SESSION['dossier_id'];
        $pager = new sfDoctrinePager('Referentielcomptable', 5);
        $pager->setQuery(ReferentielcomptableTable::getInstance()->getAllPiecesJuridique($libelle, $id_dossier));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        return $pager;
    }

//dossier juridique
    public function executeListeDossierutile(sfWebRequest $request) {
        $this->pager = $this->getAllDossierutlie($request);
        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_dossierutile", array("pager" => $this->pager));
        }
    }

    function getAllDossierutlie(sfWebRequest $request) {
        $libelle = strtoupper($request->getParameter('libelle', ''));
        $pager = new sfDoctrinePager('Referentielcomptable', 5);
        $user = new Utilisateur();
        $user =  $this->getUser()->getAttribute('userB2m');
  
        $pager->setQuery(ReferentielcomptableTable::getInstance()->getAllDossierutile($libelle, $user->getId()));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        return $pager;
    }

//referntiel
//
    function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }

    public function executeAjouterReferentiel(sfWebRequest $request) {
        $name = explode(".", $_FILES['lib_fichier']['name']);
        $nom_image = $this->random_string(20);
        $uploads_dir = sfConfig::get('upload') . '/merge/' . $nom_image . '.' . $name[1];
        move_uploaded_file($_FILES['lib_fichier']['tmp_name'], $uploads_dir);
        $referentiel = new Referentielcomptable();
        $referentiel->setLibelle($request->getParameter('libelle'));
        $referentiel->setUrl($nom_image . '.' . $name[1]);
        $referentiel->setStandard('1');
        $referentiel->save();
        $this->pager = $this->getAllReferentiels($request);
        // die($uploads_dir);    
        $this->redirect('@referentielcomptable');
    }

//ajouter dossier 

    public function executeAjouterdossier(sfWebRequest $request) {
         $titre = trim(str_replace(":", "", $_REQUEST['libelle']));
        $name = explode(".", $_FILES['lib_fichier_dossier']['name']);
        $nom_image = $this->random_string(20);
        $uploads_dir = sfConfig::get('upload') . '/merge/' . $nom_image . '.' . $name[1];
        move_uploaded_file($_FILES['lib_fichier_dossier']['tmp_name'], $uploads_dir);
        $referentiel = new Referentielcomptable();

        $referentiel->setLibelle($request->getParameter('libelle'));
        $referentiel->setUrl($nom_image . '.' . $name[1]);
        $referentiel->setStandard('0');
        $referentiel->setIdUtilisateur( $this->getUser()->getAttribute('userB2m'));
        $referentiel->save();

        $this->pager = $this->getAllDossierutlie($request);
        // die($uploads_dir);    
        $this->redirect('@dossierutile');
    }

    public function executeDeleteReferentiel(sfWebRequest $request) {
        $referentiel = ReferentielcomptableTable::getInstance()->find($request->getParameter('id'));
        $referentiel->delete();

        $this->pager = $this->getAllReferentiels($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_referentiel", array("pager" => $this->pager));
        }
    }

    public function executeDeletePiece(sfWebRequest $request) {
        $referentiel = ReferentielcomptableTable::getInstance()->find($request->getParameter('id'));
        $referentiel->delete();
        $this->pager = $this->getAllPiecesJuridiques($request);
        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_piecesjuridique", array("pager" => $this->pager));
        }
    }

    public function executeDeleteDossier(sfWebRequest $request) {
        $referentiel = ReferentielcomptableTable::getInstance()->find($request->getParameter('id'));
        $referentiel->delete();

        $this->pager = $this->getAllDossierutlie($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_dossierutile", array("pager" => $this->pager));
        }
    }

    public function executeEditReferentiel(sfWebRequest $request) {
        $this->referentiel = ReferentielcomptableTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeEditDossier(sfWebRequest $request) {
        $this->referentiel = ReferentielcomptableTable::getInstance()->find($request->getParameter('id'));
    }

//
    public function executeUpdateReferentiel(sfWebRequest $request) {

        $titre = trim(str_replace(":", "", $_REQUEST['libelle_edit']));
        $name = explode(".", $_FILES['lib_fichier_edit']['name']);
        $nom_image = $this->random_string(20);
        $uploads_dir = sfConfig::get('upload') . '/merge/' . $nom_image . '.' . $name[1];
        move_uploaded_file($_FILES['lib_fichier_edit']['tmp_name'], $uploads_dir);
        $referentiel = ReferentielcomptableTable::getInstance()->find($request->getParameter('id'));
        $referentiel->setLibelle($request->getParameter('libelle_edit'));
        $referentiel->setUrl($nom_image . '.' . $name[1]);
        $referentiel->setStandard('1');
        $referentiel->save();
        $this->pager = $this->getAllReferentiels($request);
        $this->redirect('@referentielcomptable');
    }

    public function executeUpdateDossier(sfWebRequest $request) {
        $titre = trim(str_replace(":", "", $_REQUEST['libelle_dossier_edit']));
        $name = explode(".", $_FILES['lib_dossier_fichier_edit']['name']);
        $nom_image = $this->random_string(20);
        $uploads_dir = sfConfig::get('upload') . '/merge/' . $nom_image . '.' . $name[1];
        move_uploaded_file($_FILES['lib_dossier_fichier_edit']['tmp_name'], $uploads_dir);
        $referentiel = ReferentielcomptableTable::getInstance()->find($request->getParameter('id'));

        $referentiel->setLibelle($request->getParameter('libelle_dossier_edit'));

        $referentiel->setUrl($nom_image . '.' . $name[1]);

        $referentiel->setStandard('0');
        $referentiel->save();

        $this->redirect('@dossierutile');

    }

    public function executeEditPiecejuridique(sfWebRequest $request) {
        $this->referentiel = ReferentielcomptableTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeUpdatePiece(sfWebRequest $request) {

        $titre = trim(str_replace(":", "", $_REQUEST['libelle_edit']));
        $name = explode(".", $_FILES['lib_fichier_edit']['name']);
        $nom_image = $this->random_string(20);
        $uploads_dir = sfConfig::get('upload') . '/merge/' . $nom_image . '.' . $name[1];
        move_uploaded_file($_FILES['lib_fichier_edit']['tmp_name'], $uploads_dir);
        $referentiel = ReferentielcomptableTable::getInstance()->find($request->getParameter('id'));
        $referentiel->setLibelle($request->getParameter('libelle_edit'));
        $referentiel->setUrl($nom_image . '.' . $name[1]);
        $referentiel->setIdDossier($_SESSION['dossier_id']);
        $referentiel->save();
        $this->redirect('@piecejuridique');
//        $this->redirect('comptabilite/listePieceJuridique');
        
    }

}
