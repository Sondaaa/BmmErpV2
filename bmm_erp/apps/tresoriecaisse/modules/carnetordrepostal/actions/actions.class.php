<?php

require_once dirname(__FILE__) . '/../lib/carnetordrepostalGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/carnetordrepostalGeneratorHelper.class.php';

/**
 * carnetordrepostal actions.
 *
 * @package    Bmm
 * @subpackage carnetordrepostal
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class carnetordrepostalActions extends autoCarnetordrepostalActions {

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $valide = 1;
            
            $seq_depart = $form['refdepart']->getValue();
            $seq_fin = $form['reffin']->getValue();
            $size = strlen($seq_depart);
            $references = '';
            for ($k = $seq_depart; $k <= $seq_fin; $k++) {
                $ref = str_pad($k, $size, '0', STR_PAD_LEFT);
                $references = $references . $ref . ',';
            }
            $references = substr($references, 0, -1);
            $references = explode(',', $references);

            $papier_ordre = PapierordrepostalTable::getInstance()->getByListeRefpapier($references);
            if ($papier_ordre->count() != 0) {
                $valide = 0;
            }

            if ($valide == 1) {
                $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

                try {
                    $carnetordrepostal = $form->save();

                    for ($i = $seq_depart; $i <= $seq_fin; $i++) {
                        $ref = str_pad($i, $size, '0', STR_PAD_LEFT);
                        $papier_ordre = new Papierordrepostal();
                        $papier_ordre->setRepapier($ref);
                        $papier_ordre->setIdCarnet($carnetordrepostal->getId());
                        $papier_ordre->setEtat(0);
                        $papier_ordre->setAnnule(0);
                        $papier_ordre->save();
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

                $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $carnetordrepostal)));

                if ($request->hasParameter('_save_and_add')) {
                    $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                    $this->redirect('@carnetordrepostal_new');
                } else {
                    $this->getUser()->setFlash('notice', $notice);

                    $this->redirect(array('sf_route' => 'carnetordrepostal_edit', 'sf_subject' => $carnetordrepostal));
                }
            } else {
                $this->getUser()->setFlash('notice', 'Carnet n\'est pas enregistré, il ya un et/ou référence ordre existe déjà !');
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

}
