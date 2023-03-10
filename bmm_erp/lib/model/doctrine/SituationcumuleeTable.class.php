<?php

/**
 * SituationcumuleeTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SituationcumuleeTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object SituationcumuleeTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Situationcumulee');
    }

    public function getLimiteDate() {
        $q = $this->createQuery('s')
                ->select('MIN(s.annees) as minannee, MAX(s.annees) as maxannee')
                ->from('Situationcumulee s')
                ->execute();
        return $q->getFirst();
    }

    public function getAntecedent($id, $min_annee, $max_annee) {
        $q = $this->createQuery('s')
                ->select('COALESCE(SUM(COALESCE(s.mnt_engagement, 0)), 0) as totalengagement, COALESCE(SUM(COALESCE(s.mnt_paiement, 0)), 0) as totalpaiement')
                ->from('Situationcumulee s')
                ->where('s.mois = 12')
                ->andWhere('s.annees >= ' . $min_annee)
                ->andWhere('s.annees <= ' . $max_annee)
                ->andWhere('s.id_ligprotitre = ' . $id)
                ->execute();
        return $q->getFirst();
    }

    public function getCourant($id, $max_mois, $max_annee) {
        $q = $this->createQuery('s')
                ->select('COALESCE(s.mnt_engagement, 0) as mntengagement, COALESCE(s.mnt_paiement, 0) as mntpaiement')
                ->from('Situationcumulee s')
                ->where('s.mois = ' . $max_mois)
                ->andWhere('s.annees = ' . $max_annee)
                ->andWhere('s.id_ligprotitre = ' . $id)
                ->execute();
        return $q->getFirst();
    }

    public function getByIdLigrubMois($id_lig, $mois) {
        $annee = date('Y');
        $q = $this->createQuery('s')
                ->leftJoin('s.Ligprotitrub l')
                ->leftJoin('s.Rubrique ru')
                ->where('s.mois >=' . $mois)
                ->andWhere("s.id_ligprotitre=" . $id_lig)
                ->orderBy('l.nordre');
        // die($q);
        $q = $q->execute();
        return $q;
    }

    public function getByAnneeAndMois($min_mois, $max_mois, $titre, $min_annee, $max_annee) {
        // die($min_mois . 'r' . $max_mois . 'f' . $titre . 'fe' . $min_annee . "f" . $max_annee);
        $q = $this->createQuery('s')
                ->leftJoin('s.Ligprotitrub l')
                ->leftJoin('s.Rubrique r')
                ->where('r.id_rubrique is  null')
                ->andWhere(' s.annees >= ' . $min_annee
                        . '  and s.mois >= ' . $min_mois
                        . ' and s.annees <= ' . $max_annee
                        . ' and s.mois <=' . $max_mois)
                //->andWhere('s.annees <= ' . $max_annee)
                // ->andWhere('s.mois >=' . $min_mois . ' and s.mois <=' . $max_mois)
//                ->where('s.mois <=' . $max_mois)
                ->andWhere('s.id_titre = ?', $titre)
                ->andWhere("l.nordre NOT LIKE '%-%'")
                ->orderBy('LENGTH(l.nordre), l.nordre');
        //     die($q);
        $q = $q->execute();
        return $q;
    }

}
