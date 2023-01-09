<?php

require_once dirname(__FILE__) . '/../lib/bureauxGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/bureauxGeneratorHelper.class.php';

/**
 * bureaux actions.
 *
 * @package    Commercial
 * @subpackage bureaux
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class bureauxActions extends autoBureauxActions
{
    /*********cahrger sous site***** */
    public function executeAffichesoussite(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idsite = $params['idsite']; //die('ss'.$id);
            if ($idsite) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT etage.id as id , etage.etage as libelle "
                    . " FROM etage"
                    . " WHERE etage.id_site= " . $idsite;


                $resultat = $conn->fetchAssoc($query);

                die(json_encode($resultat));
            }
        }

        die("Erreur");
    }
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {

            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
            $code = $form['code']->getValue();
            $trouve = 0;
            if ($form->getObject()->isNew()) {
                $bureau = Doctrine_Core::getTable('bureaux')->findOneByCode($code);
                if ($bureau) {
                    $notice = "Code de Bureau Existe Déja";
                    $trouve = 1;
                }
            }
            try {
                if ($trouve == 0) {
                    $bureaux = $form->save();
                } else {
                    $this->getUser()->setFlash('notice', $notice);
                    return sfView::SUCCESS;
                }
            } catch (Doctrine_Validator_Exception $e) {

                $errorStack = $form->getObject()->getErrorStack();

                $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ? 's' : null) . " with validation errors: ";
                foreach ($errorStack as $field => $errors) {
                    $message .= "$field (" . implode(", ", $errors) . "), ";
                }
                $message = trim($message, ', ');

                $this->getUser()->setFlash('error', $message);
                return sfView::SUCCESS;
            }

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $bureaux)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@bureaux_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'bureaux_edit', 'sf_subject' => $bureaux));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    public function executeImprimercb(sfWebRequest $request)
    {
        $this->bur = -1;
        $this->eta = -1;
        $this->loc = -1;
        $this->bureaux = Doctrine_Core::getTable('bureaux')->findAll();
        $this->locals = Doctrine_Core::getTable('site')->findAll();
        $this->etages = Doctrine_Core::getTable('etage')->findAll();
        if ($request->getParameter('btn')) {
            if ($request->getParameter('bur') != "" && $request->getParameter('eta') != "" && $request->getParameter('loc') != "") {
                $this->bur = $request->getParameter('bur');
                $this->loc = $request->getParameter('loc');
                $this->eta = $request->getParameter('eta');
                // die($this->bur." ".$this->loc." ".$this->eta);
                $this->bureauximprimer = Doctrine_Core::getTable('bureaux')->findByIdAndIdEtageAndIdSite($this->bur, $this->eta, $this->loc);
            }
            if ($request->getParameter('bur') != "" && $request->getParameter('eta') != "" && $request->getParameter('loc') == "") {
                $this->bur = $request->getParameter('bur');
                $this->eta = $request->getParameter('eta');
                // die($this->bur." ".$this->loc." ".$this->eta);
                $this->bureauximprimer = Doctrine_Core::getTable('bureaux')->findByIdAndIdEtage($this->bur, $this->eta);
            }
            if ($request->getParameter('bur') != "" && $request->getParameter('eta') == "" && $request->getParameter('loc') == "") {
                $this->bur = $request->getParameter('bur');
                $this->bureauximprimer = Doctrine_Core::getTable('bureaux')->findById($this->bur);
            }
            if ($request->getParameter('bur') == "" && $request->getParameter('eta') != "" && $request->getParameter('loc') == "") {

                $this->eta = $request->getParameter('eta');

                $this->bureauximprimer = Doctrine_Core::getTable('bureaux')->findByIdEtage($this->eta);
            }
            if ($request->getParameter('bur') == "" && $request->getParameter('eta') != "" && $request->getParameter('loc') != "") {

                $this->loc = $request->getParameter('loc');
                $this->eta = $request->getParameter('eta');
                // die($this->bur." ".$this->loc." ".$this->eta);
                $this->bureauximprimer = Doctrine_Core::getTable('bureaux')->findByIdEtageAndIdSite($this->eta, $this->loc);
            }
            if ($request->getParameter('bur') == "" && $request->getParameter('eta') == "" && $request->getParameter('loc') != "") {

                $this->loc = $request->getParameter('loc');

                $this->bureauximprimer = Doctrine_Core::getTable('bureaux')->findByIdSite($this->loc);
            }
        }
    }

    public function executeImprimercode(sfWebRequest $request)
    {
        $bur = -1;


        if ($request->getParameter('bur') != "-1" && $request->getParameter('eta') != "-1" && $request->getParameter('loc') != "-1") {
            $this->bur = $request->getParameter('bur');
            $this->loc = $request->getParameter('loc');
            $this->eta = $request->getParameter('eta');
            // die($this->bur." ".$this->loc." ".$this->eta);
            $this->bureauximprimer = Doctrine_Core::getTable('bureaux')->findByIdAndIdEtageAndIdType($this->bur, $this->eta, $this->loc);
        }
        if ($request->getParameter('bur') != "-1" && $request->getParameter('eta') != "-1" && $request->getParameter('loc') == "-1") {
            $this->bur = $request->getParameter('bur');
            $this->eta = $request->getParameter('eta');
            // die($this->bur." ".$this->loc." ".$this->eta);
            $this->bureauximprimer = Doctrine_Core::getTable('bureaux')->findByIdAndIdEtage($this->bur, $this->eta);
        }
        if ($request->getParameter('bur') != "-1" && $request->getParameter('eta') == "-1" && $request->getParameter('loc') == "-1") {
            $this->bur = $request->getParameter('bur');
            $this->bureauximprimer = Doctrine_Core::getTable('bureaux')->findById($this->bur);
        }
        if ($request->getParameter('bur') == "-1" && $request->getParameter('eta') != "-1" && $request->getParameter('loc') == "-1") {

            $this->eta = $request->getParameter('eta');

            $this->bureauximprimer = Doctrine_Core::getTable('bureaux')->findByIdEtage($this->eta);
        }
        if ($request->getParameter('bur') == "-1" && $request->getParameter('eta') != "-1" && $request->getParameter('loc') != "-1") {

            $this->loc = $request->getParameter('loc');
            $this->eta = $request->getParameter('eta');
            // die($this->bur." ".$this->loc." ".$this->eta);
            $this->bureauximprimer = Doctrine_Core::getTable('bureaux')->findByIdEtageAndIdType($this->eta, $this->loc);
        }
        if ($request->getParameter('bur') == "-1" && $request->getParameter('eta') == "-1" && $request->getParameter('loc') != "-1") {

            $this->loc = $request->getParameter('loc');

            $this->bureauximprimer = Doctrine_Core::getTable('bureaux')->findByIdType($this->loc);
        }
        $bureauximprimer = $this->bureauximprimer;

        return $this->renderPartial('bureaux/impression', array('bureauximprimer' => $bureauximprimer, 'bur' => $bur));
    }
}
