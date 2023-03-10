<?php

/**
 * FamillearticleTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class FamillearticleTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object FamillearticleTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Famillearticle');
    }

    public function getAll() {
        $query = $this->createQuery('f')
                ->select('f.*')
                ->from('Famillearticle f')
                ->orderBy('f.libelle, f.code');
        return $query->execute();
    }

}
