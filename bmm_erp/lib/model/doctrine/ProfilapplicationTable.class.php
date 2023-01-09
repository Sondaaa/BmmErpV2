<?php

/**
 * ProfilapplicationTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ProfilapplicationTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object ProfilapplicationTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Profilapplication');
    }

    public function getByIdProfilAndApplication($id_profil, $libelle) {
    
        $q = $this->createQuery('pa')
                        ->leftJoin('pa.Application a')
                        ->where('a.libelle = ?', $libelle)
                        ->andWhere('pa.id_profil = ' . $id_profil);
                        
        return $q->execute()->getFirst();
    }

}