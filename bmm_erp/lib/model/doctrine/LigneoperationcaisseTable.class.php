<?php

/**
 * LigneoperationcaisseTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class LigneoperationcaisseTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object LigneoperationcaisseTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Ligneoperationcaisse');
    }

    public function getMntPaye($id_budget) {
        $query = $this->createQuery('a');
        $query->select('COALESCE(SUM(a.mntoperation), 0) as mnt')
                ->from('Ligneoperationcaisse a')
                ->where('a.id_budget = ' . $id_budget);
        return $query->execute()->getFirst();
    }

    public function getByCategorieAndDocAchat($id_cat, $id_docachat) {

        $query = $this->createQuery('a');
        $query->select('*')
                ->from('Ligneoperationcaisse a')
                ->where('a.id_docachat= ' . $id_docachat)
                ->andwhere('a.id_categorie= ' . $id_cat);

        return $query->execute();
    }

    public function getByCatAndDocAchat($id_cat, $id_docachat) {

        $query = $this->createQuery('a');
        $query->select('*')
                ->from('Ligneoperationcaisse a')
                ->where('a.id_docachat= ' . $id_docachat)
                ->andwhere('a.id_categorie= ' . 2);

        return $query->execute()->getFirst();
    }

    public function getByDocAchatAndCategorie($id_docachat, $id_cat) {

        $query = $this->createQuery('a');
        $query->select('*')
                ->from('Ligneoperationcaisse a')
                ->where('a.id_docachat= ' . $id_docachat)
                ->andwhere('a.id_categorie= ' . $id_cat);
//die($query);
        return $query->execute();
    }

}