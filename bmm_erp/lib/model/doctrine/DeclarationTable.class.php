<?php

/**
 * DeclarationTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class DeclarationTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object DeclarationTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Declaration');
    }

    public function getByAnnee($annee = '') {
        $q = $this->createQuery('d')
                ->select('d.*')
                ->from('Declaration d');
        if ($annee != '')
            $q = $q->andWhere("EXTRACT(YEAR FROM d.datedebut) = '" . $annee . "'");

        $q = $q->orderBy('d.datedebut');
        return $q->execute();
    }

}
