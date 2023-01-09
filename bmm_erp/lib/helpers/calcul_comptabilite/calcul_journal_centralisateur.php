<?php

class calculJournalCentralisateur {

    public static function getJournal($dossier_id, $exercice_id) {
        $journals_interval = JournalComptableTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id);
        $all_journals = array();

        for ($i = 1; $i < 13; $i++) {
            if ($i < 10)
                $mois = '0' . $i;
            else
                $mois = $i;

            $date_debut = date('Y') . '-' . $mois . '-01';
            $date_fin = date('Y-m-d', strtotime(date('Y-m-d', strtotime($date_debut . ' +1 month')) . ' -1 day'));
            $journals = array();

            foreach ($journals_interval as $j_i) {

                $montantCreditMois = 0;
                $montantDebitMois = 0;

                $calcul_mois = LignepiececomptableTable::getInstance()->calculDebitMoisJournal($j_i->getId(), $date_debut, $date_fin)->getFirst();
                if ($calcul_mois->getTotaldebit() != 0) {
                    $montantDebitMois = $calcul_mois->getTotaldebit();
                } else {
                    $montantDebitMois = 0;
                }

                if ($calcul_mois->getTotalcredit() != 0) {
                    $montantCreditMois = $calcul_mois->getTotalcredit();
                } else {
                    $montantCreditMois = 0;
                }

                $journal = array();
                $journal['id'] = $j_i->getId();
                $journal['debitMois'] = $montantDebitMois;
                $journal['creditMois'] = $montantCreditMois;

                array_push($journals, $journal);
            }
            array_push($all_journals, $journals);
        }
        return $all_journals;
    }

    public static function getTotalJournal($annee) {
        $total_all_etatJournal = array();

        for ($i = 1; $i < 13; $i++) {
            if ($i < 10)
                $mois = '0' . $i;
            else
                $mois = $i;

            $date_debut = $annee . '-' . $mois . '-01';
            $date_fin = date('Y-m-d', strtotime(date('Y-m-d', strtotime($date_debut . ' +1 month')) . ' -1 day'));

            $montantCreditMois = 0;
            $montantDebitMois = 0;

            $calcul_mois = LignepiececomptableTable::getInstance()->calculAllDebitMoisJournal($date_debut, $date_fin);
            if ($calcul_mois->getFirst()->getTotaldebit() != 0) {
                $montantDebitMois = $calcul_mois->getFirst()->getTotaldebit();
            } else {
                $montantDebitMois = 0;
            }

            if ($calcul_mois->getFirst()->getTotalcredit() != 0) {
                $montantCreditMois = $calcul_mois->getFirst()->getTotalcredit();
            } else {
                $montantCreditMois = 0;
            }

            $total = array();
            $total['mois'] = $i;
            $total['debitMois'] = $montantDebitMois;
            $total['creditMois'] = $montantCreditMois;

            array_push($total_all_etatJournal, $total);
        }
        return $total_all_etatJournal;
    }

}

?>
