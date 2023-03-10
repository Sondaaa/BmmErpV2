<?php

/**
 * HistoriqueretenueTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class HistoriqueretenueTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object HistoriqueretenueTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Historiqueretenue');
    }

    public function getByListeId($ids) {
        $q = $this->createQuery('hi')
                ->whereIn('hi.id', (array) $ids)
                ->orderBy('hi.id')
                ->execute();
        return $q;
    }

}
