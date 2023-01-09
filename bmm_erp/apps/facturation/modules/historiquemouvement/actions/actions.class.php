<?php

require_once dirname(__FILE__) . '/../lib/historiquemouvementGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/historiquemouvementGeneratorHelper.class.php';

/**
 * historiquemouvement actions.
 *
 * @package    Bmm
 * @subpackage historiquemouvement
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class historiquemouvementActions extends autoHistoriquemouvementActions {

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);
        $filter = $this->getFilters();
        $query = $this->filters->buildQuery($this->getFilters());


//        historiquemouvement_filters[etatfrs]
        $historiquemvt = Doctrine_Core::getTable('historiquemouvement')
                ->createQuery('a')
                ->where('id_lignemvt is not null')
        ;
        if (isset($filter['id_lignemvt']))
            $historiquemvt = $historiquemvt->Andwhere("id_lignemvt=" . $filter['id_lignemvt'] . "");
        if (isset($filter['id_frs']))
            $historiquemvt = $historiquemvt->Andwhere("id_frs = " . $filter['id_frs'] . "");


        if (isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
            $historiquemvt = $historiquemvt->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
            $historiquemvt = $historiquemvt->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        } elseif (isset($filter['datecreation']['from']) && !isset($filter['datecreation']['to'])) {
            $historiquemvt = $historiquemvt->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
            $historiquemvt = $historiquemvt->Andwhere("datecreation<='" . date('Y') . "-12-31" . "'");
        } elseif (!isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
            $historiquemvt = $historiquemvt->Andwhere("datecreation>='" . date('Y') . "-01-01" . "'");
            $historiquemvt = $historiquemvt->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        } else {
            $historiquemvt = $historiquemvt->Andwhere("datecreation>='" . date('Y') . "-01-01" . "'");
            $historiquemvt = $historiquemvt->Andwhere("datecreation<='" . date('Y') . "-12-31" . "'");
        }

        if (isset($filter['etatfrs'])) {
            $historiquemvt = $historiquemvt->Andwhere("etatfrs='" . $filter['etatfrs']."'");
        }
        $query = $historiquemvt->OrderBy('id asc');
//        die($query);
        $this->addSortQuery($query);


        return $query;
    }

}
