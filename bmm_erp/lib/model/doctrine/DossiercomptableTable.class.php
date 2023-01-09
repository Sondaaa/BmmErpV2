<?php

/**
 * DossiercomptableTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class DossiercomptableTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object DossiercomptableTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Dossiercomptable');
    }

    public function getAll() {
        $q = $this->createQuery('d')
                ->orderBy('d.raisonsociale')
        ;

        return $q->execute();
    }

    public function getAllActive() {
        $q = $this->createQuery('d')
                ->where('d.etat=true')
                ->orderBy('d.raisonsociale')
        ;

        return $q->execute();
    }

    public function getAllDossier($code = '', $libelle = '') {
        $q = $this->createQuery('sa');

        if ($code != '') {
            $q = $q->andWhere('UPPER(sa.code) code ?', '%' . $code . '%')

            ;
        }
        if ($libelle != '') {
            $q = $q->andWhere('UPPER(sa.raisonsociale) like ?', '%' . $libelle . '%')

            ;
        }


        return $q;
    }

    public function load($code = '', $raisonsociale = '', $etat = '') {

        $query = $this->createQuery('d');
        $query->select('d.*')
                ->from('Dossiercomptable d')
//                ->where('j.id_dossier = ?', $_SESSION['dossier_id'])
        ;
        if ($code != '') {
            $query = $query->Where("UPPER(d.code) LIKE '%" . strtoupper($code) . "%'");
        }
        if ($raisonsociale != '') {
            $query = $query->Where("UPPER(d.raisonsociale) LIKE '%" . strtoupper($raisonsociale) . "%'");
        }
        if ($raisonsociale != '' && $code != '') {
            $query = $query->Where("UPPER(d.raisonsociale) LIKE '%" . strtoupper($raisonsociale) . "%'");
            $query = $query->andWhere("UPPER(d.code) LIKE '%" . strtoupper($code) . "%'");
        }
        if ($etat != '') {
            $query = $query->Where("d.etat =" . $etat . "");
        }
        $query = $query->orderBy('d.raisonsociale asc');

        return $query;
    }

    public function getDossierByUser($id_user) {
        $q = $this->createQuery('d')
                ->leftJoin('d.Dossierexercice de')
                ->leftJoin('de.Dossierexerciceutilisateur ud')
                ->where('ud.id_utilisateur = ?', $id_user)
                ->orderBy('d.raisonsociale');
        
        return $q->execute();
    }

}