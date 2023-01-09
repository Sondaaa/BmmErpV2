<?php

class calculBalanceSousCompte {

    public static function getBalanceSousCompte($compte_min, $compte_max, $date_debut, $date_fin, $comptes_non_solde, $order, $chiffre_1, $chiffre_2, $chiffre_3, $chiffre_4, $chiffre_5, $chiffre_6, $chiffre_7, $dossier_id) {

        $planDossierComptable = PlanDossierComptableTable::getInstance()->loadEtatBalanceSousCompte($compte_min, $compte_max, $date_debut, $date_fin, $comptes_non_solde, $order, $chiffre_1, $chiffre_2, $chiffre_3, $chiffre_4, $chiffre_5, $chiffre_6, $chiffre_7, $dossier_id);

        $finalBalance = array();

        $montantCreditMois = 0;
        $montantDebitMois = 0;
        $montantCreditOuv = 0;
        $montantDebitOuv = 0;
        $soldeCredit_affich = 0;
        $soldeDebit_affich = 0;
        $soldeCredit = 0;
        $soldeDebit = 0;

        foreach ($planDossierComptable as $p_d_c) {

            $soldeDebit = 0;
            $soldeCredit = 0;
            $soldeCredit_affich = 0;
            $soldeDebit_affich = 0;

            if ($p_d_c->getPlancomptable()->getIdCompte() == null) {
                $lignegras = ' font-weight: bold;';
            } else {
                $lignegras = '';
            }

            if ($p_d_c->getLignepiececomptable()->count() != 0) {

                $montantCreditMois = 0;
                $montantDebitMois = 0;
                $montantCreditOuv = 0;
                $montantDebitOuv = 0;

                $montantDebitMois_affich = '';
                $montantCreditMois_affich = '';
                $montantDebitOuv_affich = '';
                $montantCreditOuv_affich = '';

                $valideCredit = 0;
                $valideDebit = 0;

                $calcul_mois = LignePieceComptableTable::getInstance()->calculDebitMois($p_d_c->getId(), $date_debut, $date_fin);

                if ($calcul_mois->getTotalDebit() != 0) {
                    $montantDebitMois_affich = $calcul_mois->getTotalDebit();
                    $montantDebitMois = $calcul_mois->getTotalDebit();
                    $valideDebit = 1;
                }

                if ($calcul_mois->getTotalCredit() != 0) {
                    $montantCreditMois_affich = $calcul_mois->getTotalCredit();
                    $montantCreditMois = $calcul_mois->getTotalCredit();
                    $valideCredit = 1;
                }

                $calcul_mois_ouv = LignePieceComptableTable::getInstance()->calculDebitOuv($p_d_c->getId(), $date_debut, $date_fin);

                if ($calcul_mois_ouv->getTotalDebit() != 0) {
                    $montantDebitOuv_affich = $calcul_mois_ouv->getTotalDebit();
                    $montantDebitOuv = $calcul_mois_ouv->getTotalDebit();
                    $valideDebit = 1;
                }

                if ($calcul_mois_ouv->getTotalCredit() != 0) {
                    $montantCreditOuv_affich = $calcul_mois_ouv->getTotalCredit();
                    $montantCreditOuv = $calcul_mois_ouv->getTotalCredit();
                    $valideCredit = 1;
                }

                if ($valideDebit != 0)
                    $soldeDebit = $montantDebitOuv + $montantDebitMois;
                if ($soldeDebit <= 0 || $valideDebit == 0)
                    $soldeDebit_affich = '';
                else
                    $soldeDebit_affich = $soldeDebit;

                if ($valideCredit != 0)
                    $soldeCredit = $montantCreditOuv + $montantCreditMois;
                if ($soldeCredit <= 0 || $valideCredit == 0)
                    $soldeCredit_affich = '';
                else
                    $soldeCredit_affich = $soldeCredit;

                if ($soldeDebit_affich < $soldeCredit_affich) {
                    $soldeCredit_affich = $soldeCredit_affich - $soldeDebit_affich;
                    $soldeDebit_affich = '';
                } else {
                    $soldeDebit_affich = $soldeDebit_affich - $soldeCredit_affich;
                    $soldeCredit_affich = '';
                }
            } else {
                $montantDebitMois_affich = '';
                $montantCreditMois_affich = '';
                $montantDebitOuv_affich = '';
                $montantCreditOuv_affich = '';
            }

            $final_balance = array();
            $final_balance['id'] = $p_d_c->getId();
            $final_balance['compte'] = $p_d_c->getNumerocompte();
            $final_balance['libelle'] = $p_d_c->getLibelle();
            $final_balance['debitMois'] = $montantDebitMois_affich;
            $final_balance['creditMois'] = $montantCreditMois_affich;
            $final_balance['debitOuv'] = $montantDebitOuv_affich;
            $final_balance['creditOuv'] = $montantCreditOuv_affich;
            $final_balance['debiteur'] = $soldeDebit_affich;
            $final_balance['crediteur'] = $soldeCredit_affich;
            $final_balance['ligne'] = $lignegras;

            array_push($finalBalance, $final_balance);
        }

        return $finalBalance;
    }

}

?>
