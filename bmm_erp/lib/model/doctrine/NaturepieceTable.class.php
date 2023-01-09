<?php

/**
 * NaturepieceTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class NaturepieceTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object NaturepieceTable
     */
    public static function getInstance(){
        return Doctrine_Core::getTable('Naturepiece');
    }
    
    public function getAllTypePiece($libelle = '') {
        $q = $this->createQuery('n');
        if ($libelle != '') {
            $q = $q->andWhere('UPPER(n.libelle) like ?', '%' . $libelle . '%');
        }

        return $q;
    }

    public function getForExiste($libelle, $id) {
        $q = $this->createQuery('n')
                ->where('n.id <> ' . $id)
                ->andWhere('n.libelle = ?', $libelle);

        return $q->execute();
    }
}