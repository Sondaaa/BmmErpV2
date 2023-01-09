<?php

require_once dirname(__FILE__).'/../lib/PrototypeGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/PrototypeGeneratorHelper.class.php';

/**
 * Prototype actions.
 *
 * @package    Bmm
 * @subpackage Prototype
 * @author     Your name here
 * @version    SVN: $Id$
 */
class PrototypeActions extends autoPrototypeActions
{
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
        $query = $query->AndWhere("typebudget like '%Prototype%'")->OrderBy('id desc');
        return $query;
    }
    public function executeDelete(sfWebRequest $request) {
        $id = $request->getParameter('id', "");
        $query_parents = Doctrine_Query::create()
                ->delete('Ligprotitrub')
                ->where('id_titre=' . $id);
        $query_parents->execute();
        $query = Doctrine_Query::create()
                ->delete('titrebudjet')
                ->where('id=' . $id);
        $query = $query->execute();
        $this->redirect('prototype');
    }
}
