<?php

require_once dirname(__FILE__) . '/../lib/carnetchequeGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/carnetchequeGeneratorHelper.class.php';

/**
 * carnetcheque actions.
 *
 * @package    Bmm
 * @subpackage carnetcheque
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class carnetchequeActions extends autoCarnetchequeActions {

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

            $papier_cheque = PapierchequeTable::getInstance()->getByListeRefpapier($references);
            if ($papier_cheque->count() != 0) {
                $valide = 0;
            }

            if ($valide == 1) {
                $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

                try {
                    $carnetcheque = $form->save();
                    //listes des papier des cheques
//                $papiers = Doctrine_Core::getTable('papiercheque')->findOneByIdCarnet($carnetcheque->getId());
                    //die(count($papiers).'hh');
//                if (count($papiers) <= 1) {
//                $seq_depart = $carnetcheque->getRefdepart();
//                $seq_fin = $carnetcheque->getReffin();
//                $size = strlen($seq_depart);
                    //die($seq_depart.'hh'.$seq_fin);
                    for ($i = $seq_depart; $i <= $seq_fin; $i++) {
                        $ref = str_pad($i, $size, '0', STR_PAD_LEFT);
                        $papiercheques = new Papiercheque();
                        $papiercheques->setRefpapier($ref);
                        $papiercheques->setIdCarnet($carnetcheque->getId());
                        $papiercheques->setEtat(0);
                        $papiercheques->setAnnule(0);
                        $papiercheques->save();
                    }
//                }
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

                $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $carnetcheque)));

                if ($request->hasParameter('_save_and_add')) {
                    $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                    $this->redirect('@carnetcheque_new');
                } else {
                    $this->getUser()->setFlash('notice', $notice);

                    $this->redirect(array('sf_route' => 'carnetcheque_edit', 'sf_subject' => $carnetcheque));
                }
            } else {
                $this->getUser()->setFlash('notice', 'Carnet n\'est pas enregistré, il ya un et/ou référence chèque existe déjà !');
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

}
