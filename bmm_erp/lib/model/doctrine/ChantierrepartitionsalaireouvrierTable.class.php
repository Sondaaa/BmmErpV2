<?php

/**
 * ChantierrepartitionsalaireouvrierTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ChantierrepartitionsalaireouvrierTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object ChantierrepartitionsalaireouvrierTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Chantierrepartitionsalaireouvrier');
    }

    public function getByRepartition($id) {
        $q = $this->createQuery('cr')
                ->where('cr.id_repartition = ?', $id)
                ->orderBy('cr.id')
                ->execute();
        return $q;
    }

}
