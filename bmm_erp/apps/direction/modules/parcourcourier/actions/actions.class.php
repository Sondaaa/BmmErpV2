<?php

require_once dirname(__FILE__) . '/../lib/parcourcourierGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/parcourcourierGeneratorHelper.class.php';

/**
 * parcourcourier actions.
 *
 * @package    Bmm
 * @subpackage parcourcourier
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class parcourcourierActions extends autoParcourcourierActions {

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

        return $query;
    }

}
