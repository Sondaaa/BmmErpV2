<?php

/**
 * NumeroseriejournalTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class NumeroseriejournalTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object NumeroseriejournalTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Numeroseriejournal');
    }

    public function loadByJournal($journal_id, $prefix = '') {
        $query = $this->createQuery('p')
                ->where('p.id_journal = ?', $journal_id);
        if ($prefix != '') {
            $query = $query->andWhere("p.prefixe LIKE '%" . $prefix . "%'");
        }
        $query = $query->orderBy('p.prefixe');
        return $query->execute();
    }

    public function findByIdJournal($journal_id) {
        $query = $this->createQuery('p')
                ->where('p.id_journal = ?', $journal_id)
                ->orderBy('p.prefixe');
        return $query->execute();
    }

    public function deleteByJournal($id) {
        $query = $this->createQuery('p')
                ->delete()
                ->from('Numeroseriejournal p')
                ->where('p.id_journal = ' . $id);
        return $query->execute();
    }

    public function getSerie($journal_id = '', $datejournal = '') {
//        die($date);
//        $changeJournal= JournalcomptableTable::getInstance()->findOneById($journal_id);
//        $journal_check=  JournalcomptableTable::getInstance()->findOneByCodeAndIdExercice($changeJournal->getCode(),$_SESSION['exercice_id']);
        // die($journal_check->getId().'hh');
        $query = $this->createQuery('s')
                ->select('*')
                ->from('Numeroseriejournal s ,Journalcomptable j ')
//                ->leftJoin('s.Journalcomptable j')
                ->where('s.id_journal = ' . $journal_id)
//                ->andWhere('j.id_exercice =' . $_SESSION['exercice_id'])
        ;
        $date = date('Y-m-t', strtotime($datejournal));
     //   die($date);
//        if ($date != '') {
        $query = $query->andWhere("s.datefin >= '" . $date . "'")
                ->andWhere("s.datedebut <= '" . $date . "'");
//        }
//die($query);
        return $query->execute();
    }

    public function InsertNumeroSerie($journal_old, $journal_new) {
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        foreach ($journal_old as $old)
            foreach ($journal_new as $new) {
                //die($new);
                $numeroserie_old = NumeroseriejournalTable::getInstance()->findByIdJournal($old->getId());
                $numeroserie_new = NumeroseriejournalTable::getInstance()->findByIdJournal($new->getId());
                if ($old->getNumerotation() == 2 && count($numeroserie_new) == 0) {
                    $journal = $new;
                    $annee = intval(date('Y', strtotime($new->getDatedebutcloture())));
                    $prefix = date('y', strtotime($annee . '-01-01'));

                    $query_serie = "INSERT INTO public.numeroseriejournal(prefixe, datedebut, datefin, id_journal) "
                            . " VALUES ('" . $prefix . "01', '" . $annee . "-01-01', '" . $annee . "-01-31', " . $journal->getId() . "), "
                            . " ('" . $prefix . "02', '" . $annee . "-02-01', '" . date('Y-m-t', strtotime($annee . '-02-01')) . "', " . $journal->getId() . "), "
                            . " ('" . $prefix . "03', '" . $annee . "-03-01', '" . $annee . "-03-31', " . $journal->getId() . "), "
                            . " ('" . $prefix . "04', '" . $annee . "-04-01', '" . $annee . "-04-30', " . $journal->getId() . "), "
                            . " ('" . $prefix . "05', '" . $annee . "-05-01', '" . $annee . "-05-31', " . $journal->getId() . "), "
                            . " ('" . $prefix . "06', '" . $annee . "-06-01', '" . $annee . "-06-30', " . $journal->getId() . "), "
                            . " ('" . $prefix . "07', '" . $annee . "-07-01', '" . $annee . "-07-31', " . $journal->getId() . "), "
                            . " ('" . $prefix . "08', '" . $annee . "-08-01', '" . $annee . "-08-31', " . $journal->getId() . "), "
                            . " ('" . $prefix . "09', '" . $annee . "-09-01', '" . $annee . "-09-30', " . $journal->getId() . "), "
                            . " ('" . $prefix . "10', '" . $annee . "-10-01', '" . $annee . "-10-31', " . $journal->getId() . "), "
                            . " ('" . $prefix . "11', '" . $annee . "-11-01', '" . $annee . "-11-30', " . $journal->getId() . "), "
                            . " ('" . $prefix . "12', '" . $annee . "-12-01', '" . $annee . "-12-31', " . $journal->getId() . ")";
                    $resultat = $conn->fetchAssoc($query_serie);
                }
            }
    }

}