<?php

/**
 * LignemouvementfacturationTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class LignemouvementfacturationTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object LignemouvementfacturationTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Lignemouvementfacturation');
    }

    public function findAllMouvement($date_debut, $date_fin, $fournisseur_id, $facture, $idtype, $valide = '', $etatfrs = '') {
    //  die($date_debut.'r'.$date_fin.'rrr'.$idtype);
      $q = $this->createQuery('mv')
                ->from('Lignemouvementfacturation mv')
                ->leftJoin('mv.Documentachat da');

        if ($idtype != '' && $idtype != 0) {
            $q = $q->andWhere('da.id_typedoc = ?', $idtype);
        }

        if ($facture != '' && $facture != '*') {
            $q = $q->andWhere('upper(mv.numerofacture) LIKE = ?', strtoupper($facture));
        }

        if ($fournisseur_id != '' && $fournisseur_id != 0) {
            $q = $q->andWhere('mv.id_fournisseur = ?', $fournisseur_id);
        }
        if ($date_debut != '') {
            $q = $q->andWhere('mv.date >= ?', $date_debut);
        }
        if ($date_fin != '') {
            $q = $q->andWhere('mv.date <= ?', $date_fin);
        }

        if ($valide != '') {
            $q = $q->andWhere('mv.valide = ?', $valide);
        }
        if ($etatfrs != '') {
            $q = $q->andWhere('mv.etatfrs = ?', $etatfrs);
        }
        $q->orderBy('mv.ordre, mv.id');
    //    die($q);
        return $q->execute();
    }

    public function findAllMouvementbyidDesc() {
        $q = $this->createQuery('mv')
                ->from('Lignemouvementfacturation mv')
                ->leftJoin('mv.Documentachat da');

        $q->orderBy('mv.id desc');
        return $q->execute();
    }

//    public function getByBdcg() {
//        $q = $this->createQuery('mv')
//                ->from('lignemouvementfacturation ')
//                ->where('lignemouvementfacturation.id_documentachat in (select id from documentachat where id_frs is NULL )');
////                ->leftJoin('mv.Documentachat da')
////                ->andWhere('documentachat.mntttc = ' . 0.000);
//
////        $q->orderBy('lignemouvementfacturation.id');
//        $resultat =$q->execute();
//        die(sizeof($resultat).  json_encode($resultat));
//    }

    public function getByDate() {
        $doc_bce_bdc = 'select id from documentachat where '
                . '(documentachat.id_typedoc =' . 7 . ' or documentachat.id_typedoc= ' . 2 . ') '
                . 'and mv.id_documentachat=documentachat.id';

        $q = $this->createQuery('mv')
                ->select('*')
                ->from('Lignemouvementfacturation mv ')
                ->where('mv.id_documentachat IN '
                        . ' (select documentachat.id from documentachat where '
                        . '(documentachat.id_typedoc =' . 7 . ' or documentachat.id_typedoc= ' . 2 . ') '
                        . 'and mv.id_documentachat=documentachat.id ) ')
//                ->where("lignemouvementfacturation.date='" . $date . "'");
                ->limit(10);
        $q->orderBy('mv.id desc');
//        die($q);
        $resultat = $q->execute();
        return $resultat;
    }

    public function getByBDCRegrouppe() {
        $doc_bce_bdc = 'select id from documentachat where '
                . '(documentachat.id_typedoc =' . 22 . ' or documentachat.id_typedoc= ' . 21 . ') '
                . 'and mv.id_documentachat=documentachat.id';

        $q = $this->createQuery('mv')
                ->select('*')
                ->from('Lignemouvementfacturation mv ')
                ->where('mv.id_documentachat IN '
                        . ' (select documentachat.id from documentachat where '
                        . '(documentachat.id_typedoc =' . 22 . ' or documentachat.id_typedoc= ' . 21 . ') '
                        . 'and mv.id_documentachat=documentachat.id ) ')
//                ->where("lignemouvementfacturation.date='" . $date . "'");
                ->limit(10);
        $q->orderBy('mv.id desc');
//        die($q);
        $resultat = $q->execute();
        return $resultat;
    }

    public function getByBCIContrat() {
        $doc_bce_bdc = 'select id '
                . 'from documentachat  ,contratachat '
                . ' where documentachat.id_typedoc =' . 6 . '  '
                . ' and mv.id_documentachat=documentachat.id'
                . ' and id_contrat is not null'
                . ' and documentachat.id_contrat=contratachat.id'
                . ' and contratachat.type=' . "'1'"
                . ' and documentachat.etatdocachat IS NULL';

        $q = $this->createQuery('mv')
                ->select('*')
                ->from('Lignemouvementfacturation mv ')
                ->where('mv.id_documentachat IN (   select documentachat.id '
                        . 'from documentachat  ,contratachat '
                        . ' where documentachat.id_typedoc =' . 6 . '  '
                        . ' and mv.id_documentachat=documentachat.id'
                        . ' and id_contrat is not null'
                        . ' and documentachat.id_contrat=contratachat.id'
                        . ' and contratachat.type=' . "'1'"
                        . ' and documentachat.etatdocachat IS NULL)')
//                ->where("lignemouvementfacturation.date='" . $date . "'");
                ->limit(10);
        $q->orderBy('mv.id desc');
//        die($q);
        $resultat = $q->execute();
        return $resultat;
    }

    public function loadAllBydate($date) {
        $q = $this->createQuery('mv')
                ->from('Lignemouvementfacturation mv')
        ;
        if ($date != '') {
            $q = $q->andWhere("mv.date = " . "'" . $date . "'");
        }
        $q->orderBy('mv.ordre, mv.id');
        return $q->execute();
    }

    public function getByIdDocachatANdIdFrs($id_doc, $id_frs) {
        $q = $this->createQuery('mv')
                ->select('*')
                ->from('Lignemouvementfacturation mv ')
                ->leftJoin('mv.Documentachat doc')
                ->leftJoin('mv.Fournisseur frs')
                ->where('mv.id_documentachat=' . $id_doc)
                ->andwhere('mv.id_fournisseur=' . $id_frs)

        ;
        $q->orderBy('mv.id desc');
        $resultat = $q->execute()->getFirst();
        return $resultat;
    }

}
