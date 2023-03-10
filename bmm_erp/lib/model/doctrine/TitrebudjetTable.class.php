<?php

/**
 * TitrebudjetTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class TitrebudjetTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object TitrebudjetTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Titrebudjet');
    }
    public function getBudgetByExercice($exercice){
        $array=[];
        $titrebudgets = $this->createQuery('t')
        ->select('t.*')
        ->from('Titrebudjet t')
        ->where("EXTRACT(YEAR FROM t.datecreation) = '" . $exercice . "'")->execute();
        foreach($titrebudgets as $titre)
            array_push($array,$titre->getId());
        return $array;
    }
     public function getBudgetOuvert()
    {$annee=date('Y');
        $budget = Doctrine_Core::getTable('Titrebudjet')
            ->createQuery('a')
            ->where("typebudget = 'Exercice:" . $annee . "'")
            
            ->andWhere('date_closed is null')->execute();
        return $budget;
    }
    public function getByType($type = '', $annee = '') {
        $q = $this->createQuery('t')
                ->select('t.*')
                ->from('Titrebudjet t');
        if ($type == 'Budget Prévisionnel / Direction & Projet') {
            $q = $q->andWhere('TRIM(t.typebudget) = ?', 'Budget Prévisionnel / Direction & Projet');
            if ($annee != '')
                $q = $q->andWhere("EXTRACT(YEAR FROM t.datecreation) = '" . $annee . "'");
        }elseif ($type == 'Budget Prévisionnel Global') {
            $q = $q->andWhere('TRIM(t.typebudget) = ?', 'Budget Prévisionnel Global');
            if ($annee != '')
                $q = $q->andWhere("EXTRACT(YEAR FROM t.datecreation) = '" . $annee . "'");
        }elseif ($type != 'Final') {
            $q = $q->andWhere('TRIM(t.typebudget) = ?', 'Prototype');
        } else {
            $q = $q->andWhere('TRIM(t.typebudget) != ?', 'Prototype');
            $q = $q->andWhere('TRIM(t.typebudget) != ?', 'Budget Prévisionnel / Direction & Projet');
            $q = $q->andWhere('TRIM(t.typebudget) != ?', 'Budget Prévisionnel Global');
            $q = $q->andWhere('TRIM(t.typebudget) LIKE ?', '%Exercice:' . $annee . '%');
        }
        $q = $q->orderBy('t.libelle');
        return $q->execute();
    }

    public function getByTypeAndCategorie($id_cat, $type = '', $annee = '') {
        $q = $this->createQuery('t')
                ->select('t.*')
                ->from('Titrebudjet t');
        if ($type == 'Budget Prévisionnel Global') {
            $q = $q->andWhere('TRIM(t.typebudget) = ?', 'Budget Prévisionnel Global');
            if ($annee != '')
                $q = $q->andWhere("EXTRACT(YEAR FROM t.datecreation) = '" . $annee . "'");
        }
        if ($id_cat) {
            $q = $q->andWhere('t.id_cat=' . $id_cat);
        }
        $q = $q->orderBy('t.libelle');
        return $q->execute();
    }

    public function getByExercice($exercice) {
        $q = $this->createQuery('t')
                ->select('t.*')
                ->from('Titrebudjet t')
                ->where("t.typebudget LIKE '%" . $exercice . "%'")
                ->orderBy('t.libelle');

        return $q->execute();
    }

    public function getByTypeForGlobal($annee = '') {
        $q = $this->createQuery('t')
                ->select('t.*')
                ->from('Titrebudjet t')
                ->where('t.etatbudget = ?', 2)
                ->andWhere('TRIM(t.typebudget) = ?', 'Budget Prévisionnel / Direction & Projet');
        if ($annee != '')
            $q = $q->andWhere("EXTRACT(YEAR FROM t.datecreation) = '" . $annee . "'");

        $q = $q->orderBy('t.libelle');
        return $q->execute();
    }

    public function getGlobalByAnnee($annee = '') {
        $q = $this->createQuery('t')
                ->select('t.*')
                ->from('Titrebudjet t')
                ->where('t.etatbudget = ?', 2)
                ->andWhere('TRIM(t.typebudget) = ?', 'Budget Prévisionnel Global');
        if ($annee != '')
            $q = $q->andWhere("EXTRACT(YEAR FROM t.datecreation) = '" . $annee . "'");

        $q = $q->orderBy('t.libelle');
        return $q->execute();
    }

}
