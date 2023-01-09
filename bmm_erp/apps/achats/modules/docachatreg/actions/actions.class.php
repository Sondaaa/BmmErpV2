<?php

require_once dirname(__FILE__) . '/../lib/docachatregGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/docachatregGeneratorHelper.class.php';

/**
 * docachatreg actions.
 *
 * @package    Bmm
 * @subpackage docachatreg
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class docachatregActions extends autoDocachatregActions
{
    protected function buildQuery()
    {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);
        $user = $this->getUser()->getAttribute('userB2m');
        $query = $this->filters->buildQuery($this->getFilters());
        $documentsachatreg = Doctrine_Core::getTable('Docachatreg')
            ->createQuery('a')
            //->leftJoin('a.Documentachat doc on doc.id =a.id_docreg')
            ;
        if ($user)
            $documentsachatreg = $documentsachatreg->Where('docachatreg.id_useracheteur = ' . $user->getId());
//die($documentsachatreg);
        $query = $documentsachatreg->OrderBy('id desc');
        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        return $query;
    }
}
