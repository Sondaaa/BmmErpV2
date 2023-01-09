<?php

/**
 * ImmobilisationTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ImmobilisationTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object ImmobilisationTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Immobilisation');
    }

    public function getFirstImmobilisation() {
        $q = $this->createQuery('i')
                ->from('Immobilisation i')
                ->where('i.id_bureaux IS NOT NULL')
                ->limit(1);

        return $q->execute()->getFirst();
    }
    
    public function getLastImmobilisation() {
        $q = $this->createQuery('i')
                ->from('Immobilisation i')
                ->orderBy('id desc')
                ->limit(1);

        return $q->execute()->getFirst();
    }

}
