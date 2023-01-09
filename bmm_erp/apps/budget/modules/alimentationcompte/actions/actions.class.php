<?php

require_once dirname(__FILE__) . '/../lib/alimentationcompteGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/alimentationcompteGeneratorHelper.class.php';

/**
 * alimentationcompte actions.
 *
 * @package    Bmm
 * @subpackage alimentationcompte
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class alimentationcompteActions extends autoAlimentationcompteActions {
  protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());

        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();
        $query = $query->Andwhere("date >='" . date('Y') . "-01-01" . "'")
                ->Andwhere("date <='" . date('Y') . "-12-31" . "'")
                ->OrderBy('id desc');
        $query = $query->OrderBy('date desc');
        return $query;
    }
    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $alimentationcompte = $form->save();

                //Mise à jour solde compte bancaire/CCP
                $caissesbanques = CaissesbanquesTable::getInstance()->find($alimentationcompte->getIdCompte());

                if ($caissesbanques->getMntdefini() != null) {
                    $new_solde = $caissesbanques->getMntdefini() + $alimentationcompte->getMontant();
                } else if ($caissesbanques->getMntouverture() != null) {
                    $new_solde = $caissesbanques->getMntouverture() + $alimentationcompte->getMontant();
                } else {
                    $new_solde = $alimentationcompte->getMontant();
                    $caissesbanques->setMntouverture($new_solde);
                }

                $caissesbanques->setMntdefini($new_solde);
                $caissesbanques->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $alimentationcompte)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@alimentationcompte_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'alimentationcompte_edit', 'sf_subject' => $alimentationcompte));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

        $alimentationcompte = $this->getRoute()->getObject();
        //Mise à jour solde compte bancaire/CCP
        $caissesbanques = CaissesbanquesTable::getInstance()->find($alimentationcompte->getIdCompte());
        $new_solde_defini = 0;
        $new_solde_ouverture = 0;
        if ($caissesbanques->getMntdefini() != $caissesbanques->getMntouverture()) {
            $new_solde_defini = $caissesbanques->getMntdefini() - $alimentationcompte->getMontant();
            $new_solde_ouverture = $caissesbanques->getMntouverture();
        } else {
            $new_solde_defini = $caissesbanques->getMntdefini() - $alimentationcompte->getMontant();
            $new_solde_ouverture = $new_solde_defini;
        }

        $caissesbanques->setMntdefini($new_solde_defini);
        $caissesbanques->setMntouverture($new_solde_ouverture);
        $caissesbanques->save();

        if ($this->getRoute()->getObject()->delete()) {
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }

        $this->redirect('@alimentationcompte');
    }

    public function executeGetListe(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $affecte = $params['affecte'];

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            if ($affecte == '0')
                $query = "SELECT alimentationcompte.id as id,alimentationcompte.id_compte as id_compte, "
                        . "caissesbanques.libelle as compte,alimentationcompte.montant as montant "
                        . "FROM alimentationcompte,caissesbanques "
                        . "WHERE alimentationcompte.id_tranchebudget IS NULL "
                        . "AND alimentationcompte.id_compte=caissesbanques.id";
            else
                $query = "SELECT alimentationcompte.id as id,alimentationcompte.id_compte as id_compte, "
                        . "caissesbanques.libelle as compte,alimentationcompte.montant as montant "
                        . "FROM alimentationcompte,caissesbanques "
                        . "WHERE alimentationcompte.id_tranchebudget IS NOT NULL "
                        . "AND alimentationcompte.id_compte=caissesbanques.id";

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    public function executeShow(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->alimentation = AlimentationcompteTable::getInstance()->find($id);
    }

}
