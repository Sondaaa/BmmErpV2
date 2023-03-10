<?php

/**
 * LignebanquecaisseTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class LignebanquecaisseTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object LignebanquecaisseTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Lignebanquecaisse');
    }

    public function getByIdBudget($id_budget = '') {
        $q = $this->createQuery('l')
                ->leftJoin('l.Caissesbanques lbc')
                ->where('l.id_budget=' . $id_budget)
                ->andWhere('lbc.id_typecb = ?', 2)
                ->orderBy('l.id asc');

        return $q->execute();
    }

    public function getByIdBudgetHorsBCi($id_budget = '') {
        $q = $this->createQuery('l')
                ->leftJoin('l.Caissesbanques lbc')
                ->where('l.id_budget=' . $id_budget)
                ->andWhere('lbc.id_typecb = ?', 1)
                ->orderBy('l.id asc');

        return $q->execute();
    }

}
