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

    public function executeIndex(sfWebRequest $request) {
      $id_caissebanque = $request->getParameter('id_caissebanque');
        $id_budget = $request->getParameter('id_budget');
        $this->id_caissebanque = $id_caissebanque;
        $this->id_budget = $id_budget;
//        die($id_caissebanque . 'dfvsx' . $id_budget);  // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }

        $this->pager = $this->getPager($request);
        $this->sort = $this->getSort();
        
    }

    protected function getPager(sfWebRequest $request) {
        $pager = $this->configuration->getPager('lignebanquecaisse');
        $pager->setQuery($this->buildQuery($request));
        $pager->setPage($this->getPage());
        $pager->init();

        return $pager;
    }

    protected function buildQuery(sfWebRequest $request) {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }
        $this->filters->setTableMethod($tableMethod);
        $query = $this->filters->buildQuery($this->getFilters());

        $this->addSortQuery($query);
        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();
        $id_budget = $request->getParameter('id_budget');
        $this->id_budget = $id_budget;

        $id_caissebanque = $request->getParameter('id_caissebanque');
        $this->id_caissebanque = $id_caissebanque;
//        die($id_budget . 'dv' . $id_caissebanque);
        $lignebanquecaisse = Doctrine_Query::create()
                ->select("*")
                ->from('lignebanquecaisse a')
                ->leftJoin('a.Caissesbanques cb')
                ->leftJoin('a.Ligprotitrub lg')
                ->leftJoin('lg.Titrebudjet titreb');
        if ($_SESSION['exercice_budget'])
            $query = $lignebanquecaisse->Where("titreb.typebudget like '%" . $_SESSION['exercice_budget'] . "%'")
                    ->OrderBy('id desc');
        $query = $lignebanquecaisse->AndWhere('cb.id_typecb = 2');
        if ($id_caissebanque)
            $query = $lignebanquecaisse->AndWhere('a.id_caissebanque=' . $id_caissebanque);
        if ($id_budget)
            $query = $lignebanquecaisse->AndWhere('a.id_budget=' . $id_budget);
//        die($query);
        return $query;
    }

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
                      $banque->save(); */
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

    public function executeSaveParam(sfWebRequest $request) {
        $id_compte = $request->getParameter('id_compte');
        $ids = $request->getParameter('ids');
        $ids = explode(',', $ids);
        for ($i = 0; $i < sizeof($ids); $i++) {
            if ($ids[$i] != '') {
                $param = LignebanquecaisseTable::getInstance()->findOneByIdBudgetAndIdCaissebanque($ids[$i], $id_compte);
                if ($param != null) {
                    //rien à faire
                } else {
                    $lignebanquecaisse = new Lignebanquecaisse();
                    $lignebanquecaisse->setIdBudget($ids[$i]);
                    $lignebanquecaisse->setIdCaissebanque($id_compte);
                    $lignebanquecaisse->save();
                }
            }
        }

        die("OK");
    }

}
