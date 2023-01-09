<?php

/**
 * SousfamillearticleTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SousfamillearticleTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object SousfamillearticleTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Sousfamillearticle');
    }
    
    public function getAll() {
        $query = $this->createQuery('s')
                ->select('s.*')
                ->from('Sousfamillearticle s')
                ->orderBy('s.libelle, s.code');
        return $query->execute();
    }
}