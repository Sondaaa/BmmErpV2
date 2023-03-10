<?php

/**
 * ApplicationTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ApplicationTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object ApplicationTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Application');
    }
    
    public function getAll() {
        $q = $this->createQuery('a')
                ->orderBy('a.libelle')
                ->execute();
        return $q;
    }

    public function getByIds($ids) {
        $q = $this->createQuery('a')
                ->whereIn('a.id', (array) $ids)
                ->orderBy('a.libelle')
                ->execute();
        return $q;
    }

}
