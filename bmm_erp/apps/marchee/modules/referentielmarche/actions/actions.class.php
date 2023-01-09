<?php

/**
 * referentielmarche actions.
 *
 * @package    Bmm
 * @subpackage referentielmarche
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */

class referentielmarcheActions extends sfActions {

    public function getAllReferentiels(sfWebRequest $request)
    {
    $libelle = strtoupper($request->getParameter('libelle', ''));
    $pager = new sfDoctrinePager('Referentielcomptable', 5);
    $pager->setQuery(ReferentielMARCHETable::getInstance()->getAllReferentiel($libelle));
    $pager->setPage($request->getParameter('page', 1));
    $pager->init();
    return $pager;
}
    public function executeIndex(sfWebRequest $request)
    {
        $this->pager = $this->getAllReferentiels($request);
        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_referentiel", array("pager" => $this->pager));
        }
    }
    public function executeListeReferentiel(sfWebRequest $request)
    {

        $this->pager = $this->getAllReferentiels($request);
        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_referentiel", array("pager" => $this->pager));
        }
    }
    public function executeAjouterReferentiel(sfWebRequest $request) {
        $name = explode(".", $_FILES['lib_fichier']['name']);
        $nom_image = $this->random_string(20);
        $uploads_dir = sfConfig::get('upload') . '/merge/' . $nom_image . '.' . $name[1];
        move_uploaded_file($_FILES['lib_fichier']['tmp_name'], $uploads_dir);
        $referentiel = new Referentielmarche();
        $referentiel->setLibelle($request->getParameter('libelle'));
        $referentiel->setUrl($nom_image . '.' . $name[1]);
        $referentiel->setStandard('1');
        $referentiel->save();
        $this->pager = $this->getAllReferentiels($request);
        // die($uploads_dir);    
        $this->redirect('@referentielmarche');
    }
    public function executeDeleteReferentiel(sfWebRequest $request) {
        $referentiel = ReferentielmarcheTable::getInstance()->find($request->getParameter('id'));
        $referentiel->delete();

        $this->pager = $this->getAllReferentiels($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_referentiel", array("pager" => $this->pager));
        }
    }
    public function executeEditReferentiel(sfWebRequest $request) {
        $this->referentiel = ReferentielmarcheTable::getInstance()->find($request->getParameter('id'));
    }
    function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }
    public function executeUpdateReferentiel(sfWebRequest $request) {

        $titre = trim(str_replace(":", "", $_REQUEST['libelle_edit']));
        $name = explode(".", $_FILES['lib_fichier_edit']['name']);
        $nom_image = $this->random_string(20);
        $uploads_dir = sfConfig::get('upload') . '/merge/' . $nom_image . '.' . $name[1];
        move_uploaded_file($_FILES['lib_fichier_edit']['tmp_name'], $uploads_dir);
        $referentiel = ReferentielmarcheTable::getInstance()->find($request->getParameter('id'));
        $referentiel->setLibelle($request->getParameter('libelle_edit'));
        $referentiel->setUrl($nom_image . '.' . $name[1]);
        $referentiel->setStandard('1');
        $referentiel->save();
        $this->pager = $this->getAllReferentiels($request);
        $this->redirect('@referentielmarche');
    }
}
