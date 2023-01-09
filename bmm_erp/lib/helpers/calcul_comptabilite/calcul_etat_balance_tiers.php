<?php

class calculBalanceTiers {

    public static function getBalance($compte_id, $compte_min, $compte_max, $date_debut, $date_fin, $comptes_non_solde, $dossier_id, $exercice_id) {

        $planDossierComptable = PlandossiercomptableTable::getInstance()->loadEtatBalanceTiers($compte_min, $compte_max, $date_debut, $date_fin, $comptes_non_solde, $dossier_id, $exercice_id);
        $compte = PlandossiercomptableTable::getInstance()->find($compte_id);
        $finalBalance = array();

        $solde_credit_classe_1_5 = 0;
        $solde_debit_classe_1_5 = 0;

        foreach ($planDossierComptable as $p_d_c) {
            $calcul_mois_ouv = LignepiececomptableTable::getInstance()->calculDebitOuv($p_d_c->getId(), $date_debut, $date_fin);

            $soldeDebit = $calcul_mois_ouv->getTotalDebit() + $p_d_c->getTotalDebit();
            $soldeCredit = $calcul_mois_ouv->getTotalCredit() + $p_d_c->getTotalCredit();

            if ($soldeDebit < $soldeCredit) {
                $soldeCredit = $soldeCredit - $soldeDebit;
            } else {
                $soldeDebit = $soldeDebit - $soldeCredit;
            }

            if (($p_d_c->getPlancomptable()->getIdClasse() >= 1 && $p_d_c->getPlancomptable()->getIdClasse() <= 5 ) || ($p_d_c->getPlancomptable()->getNumerocompte() >= 1 && $p_d_c->getPlancomptable()->getNumerocompte() <= 5 )) {
                $solde_debit_classe_1_5 += $soldeDebit;
                $solde_credit_classe_1_5 += $soldeCredit;
            }

            $final_balance = array();
            $final_balance['id'] = $p_d_c->getId();
            $final_balance['compte'] = $p_d_c->getNumerocompte();
            $final_balance['libelle'] = $p_d_c->getLibelle();
            $final_balance['debitMois'] = $p_d_c->getTotalDebit();
            $final_balance['creditMois'] = $p_d_c->getTotalCredit();
            $final_balance['debitOuv'] = $calcul_mois_ouv->getTotalDebit();
            $final_balance['creditOuv'] = $calcul_mois_ouv->getTotalCredit();
            $final_balance['debiteur'] = $soldeDebit;
            $final_balance['crediteur'] = $soldeCredit;

            array_push($finalBalance, $final_balance);
        }

        $final_balance = array();
        $final_balance['id_tiers'] = $compte->getId();
        $final_balance['compte_tiers'] = $compte->getNumerocompte();
        $final_balance['libelle_tiers'] = $compte->getLibelle();
        if ($solde_debit_classe_1_5 < $solde_credit_classe_1_5) {
            $final_balance['1_5_credit'] = $solde_credit_classe_1_5 - $solde_debit_classe_1_5;
            $final_balance['1_5_debit'] = 0;
        } else {
            $final_balance['1_5_debit'] = $solde_debit_classe_1_5 - $solde_credit_classe_1_5;
            $final_balance['1_5_credit'] = 0;
        }

        array_push($finalBalance, $final_balance);

        return $finalBalance;
    }

}

?>
