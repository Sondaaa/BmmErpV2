<?php

class calculReport {

    public static function getReport($exercice_id,$dossier_id) {

//        $comptes = PlandossiercomptableTable::getInstance()->loadReportNouveau($dossier_id);
        $comptes = PlandossiercomptableTable::getInstance()->getCompteForReportNouveau($dossier_id, $_SESSION['exercice_id']);

        $finalReport = array();
        $total_debiteur = 0;
        $total_crediteur = 0;
        $diff_debiteur = 0;
        $diff_crediteur = 0;
        foreach ($comptes as $compte) {

            $debit = 0;
            $credit = 0;
            $solde = 0;
            $debiteur = 0;
            $crediteur = 0;
            $calcul = LignepiececomptableTable::getInstance()->calculSoldeReportNouveau($compte->getId());
            if ($calcul->count() != 0) {
                $debit = $calcul->getFirst()->getTotalDebit();
                $credit = $calcul->getFirst()->getTotalCredit();
                $solde = $debit - $credit ;
                if ($solde >= 0) {
                    $debiteur = $solde;
                } else {
                    $crediteur = abs($solde);
                }

                if ($solde != 0) {

                    $final_report = array();
                    $final_report['id'] = $compte->getId();
                    $final_report['compte'] = $compte->getNumeroCompte();
                    $final_report['libelle'] = $compte->getLibelle();
                    $final_report['debiteur'] = $debiteur;
                    $final_report['crediteur'] = $crediteur;
                    array_push($finalReport, $final_report);

                    $total_debiteur += $debiteur;
                    $total_crediteur += $crediteur;
                }
            }
        }

        $total_solde = $total_debiteur - $total_crediteur;
        if ($total_solde >= 0) {
            $diff_debiteur = $total_solde;
        } else {
            $diff_crediteur = abs($total_solde);
        }

        $final_report = array();

        $final_report['total_debiteur'] = $total_debiteur;
        $final_report['total_crediteur'] = $total_crediteur;
        $final_report['difference'] = $total_solde;
        $final_report['diff_debiteur'] = $diff_debiteur;
        $final_report['diff_crediteur'] = $diff_crediteur;
        array_push($finalReport, $final_report);

        return $finalReport;
    }

}

?>
