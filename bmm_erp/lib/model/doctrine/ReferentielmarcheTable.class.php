<?php

/**
 * ReferentielmarcheTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ReferentielmarcheTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ReferentielmarcheTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Referentielmarche');
    }
    public function getAllReferentiel($libelle = '') {
        $q = $this->createQuery('sa');
        if ($libelle != '') {
            $q = $q->andWhere('UPPER(sa.libelle) like ?', '%' . $libelle . '%');
        }
        // $q = $q->andWhere('sa.id_dossier is NULL')
        //         ->andWhere('sa.standard = ' . "'1'");
        return $q;
    }
}