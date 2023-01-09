<?php

/**
 * SousdirectionTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SousdirectionTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object SousdirectionTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Sousdirection');
    }

    public function getAllOrderByLibelle() {
        $query = $this->createQuery('sdi');
        $query->select('sdi.id as id, sdi.libelle as libelle, d.id as id_demandeur')
                ->from('Direction sdi')
                ->leftJoin('sdi.Demandeur d')
                ->orderBy('sdi.libelle');
        return $query->execute();
    }

}