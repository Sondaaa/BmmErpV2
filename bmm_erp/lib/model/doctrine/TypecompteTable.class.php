<?php

/**
 * TypecompteTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class TypecompteTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object TypecompteTable
     */
    public static function getInstance(){
        return Doctrine_Core::getTable('Typecompte');
    }
    
    public function getAllTypeCompte($libelle = '') {
        $q = $this->createQuery('a');
        if ($libelle != '') {
            $q = $q->andWhere('UPPER(a.libelle) like ?', '%' . $libelle . '%');
        }

        return $q;
    }

    public function getForExiste($libelle, $id) {
        $q = $this->createQuery('a')
                ->where('a.id <> ' . $id)
                ->andWhere('a.libelle = ?', $libelle);

        return $q->execute();
    }
}