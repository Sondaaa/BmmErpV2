<?php

/**
 * RetenuesourceTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class RetenuesourceTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object RetenuesourceTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Retenuesource');
    }

    public function getAll() {
        $q = $this->createQuery('r')
                ->orderBy('r.valeurretenue');

        return $q->execute();
    }

}