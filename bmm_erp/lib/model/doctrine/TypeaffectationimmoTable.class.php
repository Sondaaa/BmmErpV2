<?php

/**
 * Typeaffectationimmo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class TypeaffectationimmoTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object Typeaffectationimmo
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Typeaffectationimmo');
    }

    public function getAll() {
        $query = $this->createQuery('t')
                ->from('Typeaffectationimmo t')
                ->orderBy('t.libelle');
        return $query->execute();
    }
    
    public function getAllOrderId() {
        $query = $this->createQuery('t')
                ->from('Typeaffectationimmo t')
                ->orderBy('t.id');
        return $query->execute();
    }

}
