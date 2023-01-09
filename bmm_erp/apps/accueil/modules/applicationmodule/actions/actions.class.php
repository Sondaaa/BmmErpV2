<?php

require_once dirname(__FILE__) . '/../lib/applicationmoduleGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/applicationmoduleGeneratorHelper.class.php';

/**
 * applicationmodule actions.
 *
 * @package    Bmm
 * @subpackage applicationmodule
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class applicationmoduleActions extends autoApplicationmoduleActions {

    public function executeEnregistrer(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $id_application = $request->getParameter('id_application');
        $libelle = $request->getParameter('libelle');
        $actions = $request->getParameter('actions');

        $actions = substr($actions, 0, -1);
        $actions = explode(',', $actions);

        if ($id != '')
            $applicationmodule = ApplicationmoduleTable::getInstance()->find($id);
        else
            $applicationmodule = new Applicationmodule ();

        $applicationmodule->setIdApplication($id_application);
        $applicationmodule->setLibelle($libelle);
        $applicationmodule->save();

        foreach ($applicationmodule->getApplicationmoduleaction() as $ligne) {
            $ligne->delete();
        }

        //Ajout des Actions du Sous Module
        for ($i = 0; $i < sizeof($actions); $i++) {
            if ($actions[$i] != '') {
                $ligne_action = new Applicationmoduleaction();

                $ligne_action->setIdApplicationmodule($applicationmodule->getId());
                $ligne_action->setLibelle($actions[$i]);

                $ligne_action->save();
            }
        }

        die("OK");
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

        $profil_modules = ProfilmoduleTable::getInstance()->findByIdApplicationmodule($this->getRoute()->getObject()->getId());
        foreach ($profil_modules as $profil_module) {
            foreach ($profil_module->getProfilmoduleaction() as $profilmoduleaction) {
                $profilmoduleaction->delete();
            }
            $profil_module->delete();
        }

        foreach ($this->getRoute()->getObject()->getApplicationmoduleaction() as $action) {
            $action->delete();
        }

        if ($this->getRoute()->getObject()->delete()) {
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }

        $this->redirect('@applicationmodule');
    }

}
