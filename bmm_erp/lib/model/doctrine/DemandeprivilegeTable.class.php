<?php

/**
 * DemandeprivilegeTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class DemandeprivilegeTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object DemandeprivilegeTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Demandeprivilege');
    }
    
    public function getByIdDocbudget($ids) {
        $q = $this->createQuery('d')
                ->whereIn('d.id_objet', (array) $ids)
                ->orderBy('d.id');

                $q =$q->execute();
        return $q;
    }
}