<?php

/**
 * MouvementbanciareTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class MouvementbanciareTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object MouvementbanciareTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Mouvementbanciare');
    }

    public function getByListeId($ids) {
        $q = $this->createQuery('mv')
                ->whereIn('mv.id', (array) $ids)
                ->orderBy('mv.id')
                ->execute();
        return $q;
    }

    public function getLastOpeartionInCompte($id_banque) {
        $q = $this->createQuery('mv')
                        ->where('mv.id_banque = ' . $id_banque)
                        ->orderBy('numero desc')
                        ->execute()->getFirst();
        return $q;
    }

    public function getMouvement($id_docbudget) {
        $q = $this->createQuery('mv')
                ->where('mv.id_documentachat = ' . $id_docbudget)
                ->orderBy('numero desc')
//                        ->limit(1)
                ->execute()
        ;
        return $q;
    }

    public function setNumerotation($id) {
        $q = $this->createQuery('mv')
                ->where('mv.id > ' . $id)
                ->orderBy('mv.numero')
                ->execute();
        return $q;
    }

    public function getAllMouvementRapprochement($date_debut, $date_fin, $id_banque, $rapproche) {
        $q = $this->createQuery('mv');
        if ($id_banque != '') {
            $q = $q->andWhere('mv.id_banque = ?', $id_banque);
        }
        if ($date_debut != '') {
            $q = $q->andWhere('mv.dateoperation >= ?', $date_debut);
        }
        if ($date_fin != '') {
            $q = $q->andWhere('mv.dateoperation <= ?', $date_fin);
        }

        $q->orderBy('mv.dateoperation, mv.id');
        return $q;
    }

    public function findAllMouvementRapprochement($date_debut, $date_fin, $id_banque) {
        $q = $this->createQuery('mv');
        if ($id_banque != '') {
            $q = $q->andWhere('mv.id_banque = ?', $id_banque);
        }
        if ($date_debut != '') {
            $q = $q->andWhere('mv.dateoperation >= ?', $date_debut);
        }
        if ($date_fin != '') {
            $q = $q->andWhere('mv.dateoperation <= ?', $date_fin);
        }

        $q->orderBy('mv.dateoperation, mv.id');
        return $q->execute();
    }

    public function getAllMouvement($date_debut, $date_fin, $id_banque, $type) {
        $q = $this->createQuery('mv');
        if ($id_banque != '') {
            $q = $q->andWhere('mv.id_banque = ?', $id_banque);
        }
        if ($date_debut != '') {
            $q = $q->andWhere('mv.dateoperation >= ?', $date_debut);
        }
        if ($date_fin != '') {
            $q = $q->andWhere('mv.dateoperation <= ?', $date_fin);
        }

        if ($type != 'tout') {
            if ($type == 'credit')
                $q = $q->andWhere('mv.credit IS NOT NULL');
            else
                $q = $q->andWhere('mv.debit IS NOT NULL');
        }
        $q->orderBy('mv.dateoperation, mv.id');
        return $q;
    }

    public function findAllMouvement($date_debut, $date_fin, $id_banque, $quitance) {
        $q = $this->createQuery('mv');
        if ($id_banque != '') {
            $q = $q->andWhere('mv.id_banque = ?', $id_banque);
        }
        if ($date_debut != '') {
            $q = $q->andWhere('mv.dateoperation >= ?', $date_debut);
        }
        if ($date_fin != '') {
            $q = $q->andWhere('mv.dateoperation <= ?', $date_fin);
        }
       
            $q->orderBy('mv.dateoperation, mv.id');
        return $q->execute();
    }

    public function findAllMouvementForBordereau($date_debut, $date_fin, $id_banque, $id_type, $id_nature = '') {
        $q = $this->createQuery('mv');

        if ($id_nature != '') {
            $q = $q->leftJoin('mv.Documentbudget db')
                    ->leftJoin('db.Piecejointbudget pjb')
                    ->leftJoin('pjb.Documentachat da')
                    ->leftJoin('da.Fournisseur f')
                    ->andWhere('(f.id_naturecompte = ' . $id_nature . ' OR f.id_naturecompte IS NULL)');
        }

        if ($id_type != '') {
            $q = $q->andWhere('mv.id_type = ?', $id_type);
        }

        if ($id_banque != '') {
            $q = $q->andWhere('mv.id_banque = ?', $id_banque);
        }
        if ($date_debut != '') {
            $q = $q->andWhere('mv.dateoperation >= ?', $date_debut);
        }
        if ($date_fin != '') {
            $q = $q->andWhere('mv.dateoperation <= ?', $date_fin);
        }

        $q = $q->andWhere('mv.id_bordereauvirement IS NULL');

        $q->orderBy('mv.dateoperation, mv.id');
        return $q->execute();
    }

    public function getSourceByAlimentation($id_alimentation) {
        $q = $this->createQuery('mv')
                        ->where('mv.id_alimentationcompte = ' . $id_alimentation)
                        ->andWhere('mv.id_mouvement IS NULL')
                        ->execute()->getFirst();
        return $q;
    }

    public function getMntPaye($id_budget) {
        $query = $this->createQuery('mv');
        $query->select('COALESCE(SUM(COALESCE(mv.debit, 0) + COALESCE(mv.mntenoper, 0) - COALESCE(mv.credit, 0)), 0) as mnt')
                ->from('Mouvementbanciare mv')
                ->leftJoin('mv.Documentbudget db')
                ->where('db.id_budget = ' . $id_budget);
        return $query->execute()->getFirst();
    }

    public function getMouvementBCE($id_docbudget) {
        $q = $this->createQuery('mv')
                ->where('mv.id_documentbudget = ' . $id_docbudget)
                ->orderBy('numero desc')
                ->execute()
        ;
        return $q;
    }

}
