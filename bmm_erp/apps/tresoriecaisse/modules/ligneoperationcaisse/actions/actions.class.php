<?php

require_once dirname(__FILE__) . '/../lib/ligneoperationcaisseGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/ligneoperationcaisseGeneratorHelper.class.php';

/**
 * ligneoperationcaisse actions.
 *
 * @package    Bmm
 * @subpackage ligneoperationcaisse
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ligneoperationcaisseActions extends autoLigneoperationcaisseActions {

    public $type = "1";

    public function executeIndex(sfWebRequest $request) {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }
        if ($request->getParameter('categorie'))
            $this->type = $request->getParameter('categorie');
        $this->pager = $this->getPager();
        $this->sort = $this->getSort();
    }

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
        $query = $query->OrderBy('id desc');
        return $query;
    }

    public function executeFilter(sfWebRequest $request) {
        $this->setPage(1);

        if ($request->hasParameter('_reset')) {
            $this->setFilters($this->configuration->getFilterDefaults());

            $this->redirect('@ligneoperationcaisse');
        }

        $this->filters = $this->configuration->getFilterForm($this->getFilters());
       
        $this->filters->bind($request->getParameter($this->filters->getName()));
        if ($this->filters->isValid()) {
            $this->setFilters($this->filters->getValues());

            $this->redirect('@ligneoperationcaisse');
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();

        $this->setTemplate('index');
    }

}
