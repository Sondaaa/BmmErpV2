<?php

/**
 * ReclamationfrsTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ReclamationfrsTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ReclamationfrsTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Reclamationfrs');
    }
    
    public function getAllReclamation() {
        $reclamations = Doctrine_Core::getTable('Reclamationfrs')
                ->createQuery('a')
                ->orderBy('daterec,id desc');

        return $reclamations;
    }
}