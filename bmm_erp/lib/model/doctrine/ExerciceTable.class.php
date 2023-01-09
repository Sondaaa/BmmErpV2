<?php

/**
 * ExerciceTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ExerciceTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object ExerciceTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Exercice');
    }

//SELECT   COUNT(*) AS nbr_doublon, champ1, champ2, champ3
//FROM     table
//GROUP BY champ1, champ2, champ3
//HAVING   COUNT(*) > 
    public function getAllByApp($app) {
        $q = $this->createQuery('a')
                ->select('count(*) as nbr_doublon,a.id, a.libelle')
                ->from('Exercice a ,Dossierexercice')
                ->where('a.id=dossierexercice.id_exercice')
                ->andWhere("a.type like '%" . $app . "%'")
//                ->leftJoin('a.Dossierexercice dx')
                ->groupBy('a.id , a.libelle')
                ->having('COUNT(*) > 1')
                ->orderBy('a.libelle')
        ;
        //die($q);
        return $q->execute();
    }

    public function getOneByLibelleAndType($libelle, $type) {
        
    }

    public function getAllexercie() {
        $q = $this->createQuery('a')
                ->select('*')
                ->from('Exercice a ,Dossierexercice')
                ->where('a.id=dossierexercice.id_exercice')
                ->orderBy('a.libelle');
        return $q->execute();
    }
    public function getExerciceBudget(){
        $exercice = Doctrine_Core::getTable('exercice')
        ->createQuery('a')
        ->where("type like 'budget'")
        ->execute();
    return $exercice;
    }
    public function getAllExer($type) {
        $q = $this->createQuery('a')
                ->select('*')
                ->from('Exercice a ,Dossierexercice')
                ->where('a.id=dossierexercice.id_exercice')
                ->andWhere("a.type like '%" . $type . "%'")
//                ->groupBy('a.id , a.libelle')
//                ->having('COUNT(*) > 1')
                ->orderBy('a.libelle');
//die($q);
        return $q->execute();
    }

    public function getAll() {
        $q = $this->createQuery('a')
                ->select('*')
                ->from('Exercice a ,Dossierexercice')
                ->where('a.id=dossierexercice.id_exercice')
//                ->andWhere("a.type like '%" . $type . "%'")
//                ->groupBy('a.id , a.libelle')
//                ->having('COUNT(*) > 1')
                ->orderBy('a.libelle');
//die($q);
        return $q->execute();
    }

    public function findAllByOrder($type) {
        $q = $this->createQuery('a')
                ->select('a.*')
                ->where("a.type like '%" . $type . "%'")
                ->orderBy('a.libelle');

        return $q->execute();
    }

//    public function getAllDistanct() {
//        $q = $this->createQuery('a')
//                ->select('DISTINCT(a.libelle) ')
//                ->from('Exercice a ')
//                ->orderBy('a.libelle')
//        ;
////die($q);
//        return $q->execute();
//    }
    public function getAllExerciceByApp($libelle = '', $app) {
        $q = $this->createQuery('a');
        if ($libelle != '') {
            $q = $q->andWhere('UPPER(a.libelle) like ?', '%' . $libelle . '%');
        }
        $q = $q->andWhere('type like ?', '%' . $app . '%');
        $q->orderBy('a.libelle');
        return $q;
    }

    public function getAllExercice($libelle = '') {
        $q = $this->createQuery('a');
        if ($libelle != '') {
            $q = $q->andWhere('UPPER(a.libelle) like ?', '%' . $libelle . '%');
        }
        $q = $q->andWhere('type like ?', '%comptabilite%');
        $q->orderBy('a.libelle');
        return $q;
    }

    public function getAllExerciceByAnnee($libelle = '') {
        $q = $this->createQuery('a');
        if ($libelle != '') {
            $q = $q->andWhere('UPPER(a.libelle) like ?', '%' . $libelle . '%');
        }
        $q = $q->andWhere('type like ?', '%comp%');
        $q->orderBy('a.libelle');
        return $q->execute();
    }

    public function getByLibelleAndType($libelle = '', $type) {
        $q = $this->createQuery('a');
        $q = $q->leftJoin('a.Dossierexercice dx')
                ->where('dx.id_dossier = ' . $_SESSION['dossier_id']);
        if ($libelle != '') {
            $q = $q->andWhere('UPPER(a.libelle) like ?', '%' . $libelle . '%');
        }
        $q = $q->andWhere('type like ?', '"%' . $type . '%"');
        $q->orderBy('a.libelle');
        return $q->execute();
    }

    public function getByLibelle($libelle = '') {
        $q = $this->createQuery('a');
        $q = $q->leftJoin('a.Dossierexercice dx')
                ->where('dx.id_dossier = ' . $_SESSION['dossier_id']);
        if ($libelle != '') {
            $q = $q->andWhere('UPPER(a.libelle) like ?', '%' . $libelle . '%');
        }
//        $q=$q->andWhere('type like ?','%comptabilite%');
        $q->orderBy('a.libelle');
        return $q->execute();
    }

    public function getForExiste($libelle, $id) {
        $q = $this->createQuery('a')
                ->where('a.id <> ' . $id)
                ->andWhere('a.libelle = ?', $libelle);

        return $q->execute();
    }

    public function getByDossier($dossier, $user_id) {
        $user_connected = UtilisateurTable::getInstance()->findOneById($user_id);
        $q = $this->createQuery('ex')
                ->leftJoin('ex.Dossierexercice dx')
                ->leftJoin('dx.Dossierexerciceutilisateur du')
                ->where('dx.id_dossier = ' . $dossier);
//                ->where("ex.type='%" . $type . "%'");
        if ($user_connected->getProfil()->getId() != 1)
            $q = $q->andWhere('du.id_utilisateur = ?', $user_id);
        $q = $q->orderBy('ex.libelle desc');

        return $q->execute();
    }

    public function getAllByDossier($dossier) {
        $libelle = 'comp';
        $q = $this->createQuery('ex')
                ->leftJoin('ex.Dossierexercice dx')
                ->where('dx.id_dossier = ' . $dossier);
        $q = $q->andWhere('type like ?', '%' . $libelle . '%');
        $q = $q->orderBy('ex.libelle desc');

        return $q->execute();
    }

    public function findIdDossiersuivant($exerci_suiv) {
        $q = $this->createQuery('ex')
                ->select('exercice.id as id')
                ->from('exercice,dossierexercice')
                ->where("exercice.libelle='" . trim($exerci_suiv) . "'")
                ->andWhere('exercice.id in (select id_exercice from dossierexercice where id_dossier= ' . $_SESSION['dossier_id'] . ")");
        ;
        return $q->execute();
    }

}
