<?php

/**
 * ReferentielcomptableTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ReferentielcomptableTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object ReferentielcomptableTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Referentielcomptable');
    }

    public function getOneByIdDossier($id) {
//        print('1');
        $query = $this->createQuery('r');

        $query->select('r.*')
                ->from('Referentielcomptable r')
                ->where('r.id_dossier = ?', $id)
                ->orderBy('r.id');


        return $query->execute();
    }

    public function getAllByOrder() {
        $q = $this->createQuery('A')
                ->orderBy('A.libelle');

        return $q->execute();
    }

    public function getAllReferentiel($libelle = '') {
        $q = $this->createQuery('sa');
        if ($libelle != '') {
            $q = $q->andWhere('UPPER(sa.libelle) like ?', '%' . $libelle . '%');
        }
        $q = $q->andWhere('sa.id_dossier is NULL')
                ->andWhere('sa.standard = ' . "'1'");
        return $q;
    }

    public function getAllPiecesJuridique($libelle = '', $id_dossier = '') {
        $q = $this->createQuery('sa');
        if ($libelle != '') {
            $q = $q->andWhere('UPPER(sa.libelle) like ?', '%' . $libelle . '%')
                    ;
        }
        if ($id_dossier != '')
            $q = $q->andWhere('sa.id_dossier =' . $id_dossier)
            ;
       $q=$q->andWhere('sa.id_dossier is Not null')
//               ->andWhere('(sa.standard is not null) or (sa.standard='."'0')")
                ; 
        return $q;
    }

    public function getAllDossierutile($libelle = '', $id_user = '') {
        $q = $this->createQuery('sa');
        if ($libelle != '') {
            $q = $q->andWhere('UPPER(sa.libelle) like ?', '%' . $libelle . '%');
        }

        if ($id_user != '') {
            $q = $q->andWhere('sa.id_dossier is  NULL')
                    ->andWhere('sa.id_utilisateur =' . $id_user)
                    ->andWhere('sa.standard =' . "'0'");
        }
        return $q;
    }

}