<?php

/**
 * UniteTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class UniteTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object UniteTable
     */
    public static function getInstance(){
        return Doctrine_Core::getTable('Unite');
    }
    
    public function getAllOrderByLibelle() {
        $query = $this->createQuery('u');
        $query->select('u.id as id, u.libelle as libelle, d.id as id_demandeur')
                ->from('Unite u')
                ->leftJoin('u.Demandeur d')
                ->orderBy('u.libelle');
        return $query->execute();
    }
}