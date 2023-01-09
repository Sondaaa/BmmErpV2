<?php

require_once dirname(__FILE__) . '/../lib/lignebanquecaisseGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/lignebanquecaisseGeneratorHelper.class.php';

/**
 * lignebanquecaisse actions.
 *
 * @package    Bmm
 * @subpackage lignebanquecaisse
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class lignebanquecaisseActions extends autoLignebanquecaisseActions {

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                // die($request->getParameter('id_caissebanque').'hh'.$request->getParameter('id_budget'));
                if ($request->getParameter('id_caissebanque') && $request->getParameter('id_budget')) {
                    $lignebanquecaisse = new Lignebanquecaisse();
                    $lignebanquecaisse->setIdBudget($request->getParameter('id_budget'));
                    $lignebanquecaisse->setIdCaissebanque($request->getParameter('id_caissebanque'));
                    $lignebanquecaisse->save();

                    /* Mise a jour caisee */
                   /* $budget = new Ligprotitrub();
                    $budget = Doctrine_Core::getTable('ligprotitrub')->findOneById($request->getParameter('id_budget'));
                    $banque = new Caissesbanques();
                    $banque = Doctrine_Core::getTable('caissesbanques')->findOneById($request->getParameter('id_caissebanque'));
                   
                    $banque->setMntouverture($budget->getMntencaisse());
                    $banque->save();*/
                    
                } else {
                    $lignebanquecaisse = $form->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $lignebanquecaisse)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@lignebanquecaisse_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'lignebanquecaisse_edit', 'sf_subject' => $lignebanquecaisse));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

}
