<?php

class calculBalance {

    public static function getBalance($compte_min, $compte_max, $date_debut, $date_fin, $comptes_non_solde, $chiffre_1, $chiffre_2, $chiffre_3, $chiffre_4, $chiffre_5, $chiffre_6, $chiffre_7, $dossier_id, $exercice_id) {

        $planDossierComptable = PlandossiercomptableTable::getInstance()->loadEtatBalance($compte_min, $compte_max, $date_debut, $date_fin, $comptes_non_solde, $chiffre_1, $chiffre_2, $chiffre_3, $chiffre_4, $chiffre_5, $chiffre_6, $chiffre_7, $dossier_id, $exercice_id);

        $finalBalance = array();

        $soldeCredit = 0;
        $soldeDebit = 0;
        $solde_credit_classe_1_5 = 0;
        $solde_debit_classe_1_5 = 0;
        $solde_credit_classe_6 = 0;
        $solde_debit_classe_6 = 0;
        $solde_credit_classe_7 = 0;
        $solde_debit_classe_7 = 0;

        foreach ($planDossierComptable as $p_d_c) {

            $soldeDebit = 0;
            $soldeCredit = 0;

            if ($p_d_c->getPlancomptable()->getIdCompte() == null) {
                $lignegras = ' font-weight: bold;';
            } else {
                $lignegras = '';
            }
            $trouve = 0;
//            if ((stripos(trim($p_d_c->getNumerocompte()), '40') !== FALSE && stripos(trim($p_d_c->getNumerocompte()), '40') == 0) || (stripos(trim($p_d_c->getNumerocompte()), '41') !== FALSE && stripos(trim($p_d_c->getNumerocompte()), '41') == 0))
//                if (trim($p_d_c->getNumerocompte()) != '40' && trim($p_d_c->getNumerocompte()) != '41') {
//                    $trouve = 1;
//                }
//            if ($trouve == 0) {
            $ligne = LignepiececomptableTable::getInstance()->findByIdComptecomptable($p_d_c->getId());
            if ($ligne->count() != 0) {
                if ($p_d_c->getLignepiececomptable()->count() != 0) {

//                if (trim($p_d_c->getNumerocompte()) != '40' && trim($p_d_c->getNumerocompte()) != '41') {
                    //Total Compte seulement
//                        $calcul_mois = LignepiececomptableTable::getInstance()->calculDebitMois($p_d_c->getId(), $date_debut, $date_fin);
//                        $calcul_mois_ouv = LignepiececomptableTable::getInstance()->calculDebitOuv($p_d_c->getId());
                    //Total Compte + sous compte

                    $calcul_mois = LignepiececomptableTable::getInstance()->calculDebitMoisClasse(trim($p_d_c->getNumerocompte()), $date_debut, $date_fin);
                    $calcul_mois_ouv = LignepiececomptableTable::getInstance()->calculDebitOuvClasse(trim($p_d_c->getNumerocompte()));
//                } else if (trim($p_d_c->getNumerocompte()) == '40' || trim($p_d_c->getNumerocompte()) == '41') {
//                    $calcul_mois = LignepiececomptableTable::getInstance()->calculDebitMoisClasse(trim($p_d_c->getNumerocompte()), $date_debut, $date_fin);
//                    $calcul_mois_ouv = LignepiececomptableTable::getInstance()->calculDebitOuvClasse(trim($p_d_c->getNumerocompte()));
//                }

                    if (strlen(trim($p_d_c->getPlancomptable()->getNumerocompte())) > 7) {
                        $soldeDebit = $calcul_mois_ouv->getTotalDebit() + $calcul_mois->getTotalDebit();
                        $soldeCredit = $calcul_mois_ouv->getTotalCredit() + $calcul_mois->getTotalCredit();

                        if ($soldeDebit < $soldeCredit) {
                            $soldeCredit = $soldeCredit - $soldeDebit;
                        } else {
                            $soldeDebit = $soldeDebit - $soldeCredit;
                        }

                        if (($p_d_c->getPlancomptable()->getIdClasse() >= 1 && $p_d_c->getPlancomptable()->getIdClasse() <= 5 ) || (trim($p_d_c->getPlancomptable()->getNumerocompte()) >= 1 && trim($p_d_c->getPlancomptable()->getNumerocompte()) <= 5 )) {
                            $solde_debit_classe_1_5 += $soldeDebit;
                            $solde_credit_classe_1_5 += $soldeCredit;
                        }
                        if ($p_d_c->getPlancomptable()->getIdClasse() == 6 || trim($p_d_c->getPlancomptable()->getNumerocompte()) == 6) {
                            $solde_debit_classe_6 += $soldeDebit;
                            $solde_credit_classe_6 += $soldeCredit;
                        }
                        if ($p_d_c->getPlancomptable()->getIdClasse() == 7 || trim($p_d_c->getPlancomptable()->getNumerocompte()) == 7) {
                            $solde_debit_classe_7 += $soldeDebit;
                            $solde_credit_classe_7 += $soldeCredit;
                        }
                    }
                }
            }
            $final_balance = array();
            $final_balance['id'] = $p_d_c->getId();
            $final_balance['compte'] = trim($p_d_c->getNumerocompte());
            $final_balance['libelle'] = trim($p_d_c->getLibelle());

            $final_balance['debitMois'] = $calcul_mois->getTotalDebit();
            $final_balance['creditMois'] = $calcul_mois->getTotalCredit();
            $final_balance['debitOuv'] = $calcul_mois_ouv->getTotalDebit();
            $final_balance['creditOuv'] = $calcul_mois_ouv->getTotalCredit();

            $final_balance['debitCumulMois'] = $final_balance['debitOuv'] + $final_balance['debitMois'];
            $final_balance['crediCumultMois'] = $final_balance['creditOuv'] + $final_balance['creditMois'];
            if ($final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] < 0)
                $final_balance['crediteur'] = $soldeCredit;
            else
                $final_balance['debiteur'] = $soldeDebit;


            $final_balance['ligne'] = $lignegras;

            array_push($finalBalance, $final_balance);

//            }
//            $trouve = 1;
        }

        $final_balance = array();
        if ($solde_debit_classe_1_5 < $solde_credit_classe_1_5) {
            $final_balance['1_5_credit'] = $solde_credit_classe_1_5 - $solde_debit_classe_1_5;
            $final_balance['1_5_debit'] = 0;
        } else {
            $final_balance['1_5_debit'] = $solde_debit_classe_1_5 - $solde_credit_classe_1_5;
            $final_balance['1_5_credit'] = 0;
        }
        if ($solde_debit_classe_6 < $solde_credit_classe_6) {
            $final_balance['6_credit'] = $solde_credit_classe_6 - $solde_debit_classe_6;
            $final_balance['6_debit'] = 0;
        } else {
            $final_balance['6_debit'] = $solde_debit_classe_6 - $solde_credit_classe_6;
            $final_balance['6_credit'] = 0;
        }
        if ($solde_debit_classe_7 < $solde_credit_classe_7) {
            $final_balance['7_credit'] = $solde_credit_classe_7 - $solde_debit_classe_7;
            $final_balance['7_debit'] = 0;
        } else {
            $final_balance['7_debit'] = $solde_debit_classe_7 - $solde_credit_classe_7;
            $final_balance['7_credit'] = 0;
        }

        array_push($finalBalance, $final_balance);

        return $finalBalance;
    }

    public static function getBalance2($compte_min, $compte_max, $date_debut, $date_fin, $comptes_non_solde, $dossier_id, $exercice_id) {

        $planDossierComptable = PlandossiercomptableTable::getInstance()->loadEtatBalance2($compte_min, $compte_max, $date_debut, $date_fin, $comptes_non_solde, $dossier_id, $exercice_id);

        $finalBalance = array();

        $soldeCredit = 0;
        $soldeDebit = 0;
        $solde_credit_classe_1_5 = 0;
        $solde_debit_classe_1_5 = 0;
         $solde_credit_classe_1_4 = 0;
        $solde_debit_classe_1_4 = 0;
        $solde_credit_classe_6 = 0;
        $solde_debit_classe_6 = 0;
        $solde_credit_classe_7 = 0;
        $solde_debit_classe_7 = 0;

        foreach ($planDossierComptable as $p_d_c) {

            $soldeDebit = 0;
            $soldeCredit = 0;

            if ($p_d_c->getPlancomptable()->getIdCompte() == null) {
                $lignegras = ' font-weight: bold;';
            } else {
                $lignegras = '';
            }
            $trouve = 0;

            $ligne = LignepiececomptableTable::getInstance()->findByIdComptecomptable($p_d_c->getId());
            if ($ligne->count() != 0) {
                if ($p_d_c->getLignepiececomptable()->count() != 0) {

                    $calcul_mois = LignepiececomptableTable::getInstance()->calculDebitMoisClasse(trim($p_d_c->getNumerocompte()), $date_debut, $date_fin);
                    $calcul_mois_ouv = LignepiececomptableTable::getInstance()->calculDebitOuvClasse(trim($p_d_c->getNumerocompte()));
                    if (strlen(trim($p_d_c->getPlancomptable()->getNumerocompte())) > 7) {
                        $soldeDebit = $calcul_mois_ouv->getTotalDebit() + $calcul_mois->getTotalDebit();
                        $soldeCredit = $calcul_mois_ouv->getTotalCredit() + $calcul_mois->getTotalCredit();

                        if ($soldeDebit < $soldeCredit) {
                            $soldeCredit = $soldeCredit - $soldeDebit;
                        } else {
                            $soldeDebit = $soldeDebit - $soldeCredit;
                        }

                        if (($p_d_c->getPlancomptable()->getIdClasse() >= 1 && $p_d_c->getPlancomptable()->getIdClasse() <= 5 ) || (trim($p_d_c->getPlancomptable()->getNumerocompte()) >= 1 && trim($p_d_c->getPlancomptable()->getNumerocompte()) <= 5 )) {
                            $solde_debit_classe_1_5 += $soldeDebit;
                            $solde_credit_classe_1_5 += $soldeCredit;
                        }
                        if ($p_d_c->getPlancomptable()->getIdClasse() == 6 || trim($p_d_c->getPlancomptable()->getNumerocompte()) == 6) {
                            $solde_debit_classe_6 += $soldeDebit;
                            $solde_credit_classe_6 += $soldeCredit;
                        }
                        if ($p_d_c->getPlancomptable()->getIdClasse() == 7 || trim($p_d_c->getPlancomptable()->getNumerocompte()) == 7) {
                            $solde_debit_classe_7 += $soldeDebit;
                            $solde_credit_classe_7 += $soldeCredit;
                        }
                    }
                }
            }
            $final_balance = array();
            $final_balance['id'] = $p_d_c->getId();
            $final_balance['compte'] = trim($p_d_c->getPlancomptable());
             $final_balance['numcompte'] = trim($p_d_c->getPlancomptable()->getNumerocompte());
             $final_balance['classe'] = trim($p_d_c->getPlancomptable()->getClassecompte()->getCode());
            $final_balance['libelle'] = trim($p_d_c->getLibelle());

            $final_balance['debitMois'] = $calcul_mois->getTotalDebit();
            $final_balance['creditMois'] = $calcul_mois->getTotalCredit();
            $final_balance['debitOuv'] = $calcul_mois_ouv->getTotalDebit();
            $final_balance['creditOuv'] = $calcul_mois_ouv->getTotalCredit();

            $final_balance['debitCumulMois'] = $final_balance['debitOuv'] + $final_balance['debitMois'];
            $final_balance['crediCumultMois'] = $final_balance['creditOuv'] + $final_balance['creditMois'];
            if ($final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] < 0)
                $final_balance['crediteur'] = $soldeCredit;
            else
                $final_balance['debiteur'] = $soldeDebit;


            $final_balance['ligne'] = $lignegras;

            array_push($finalBalance, $final_balance);
        }

        $final_balance = array();
        if ($solde_debit_classe_1_5 < $solde_credit_classe_1_5) {
            $final_balance['1_5_credit'] = $solde_credit_classe_1_5 - $solde_debit_classe_1_5;
            $final_balance['1_5_debit'] = 0;
        } else {
            $final_balance['1_5_debit'] = $solde_debit_classe_1_5 - $solde_credit_classe_1_5;
            $final_balance['1_5_credit'] = 0;
        }
        if ($solde_debit_classe_6 < $solde_credit_classe_6) {
            $final_balance['6_credit'] = $solde_credit_classe_6 - $solde_debit_classe_6;
            $final_balance['6_debit'] = 0;
        } else {
            $final_balance['6_debit'] = $solde_debit_classe_6 - $solde_credit_classe_6;
            $final_balance['6_credit'] = 0;
        }
        if ($solde_debit_classe_7 < $solde_credit_classe_7) {
            $final_balance['7_credit'] = $solde_credit_classe_7 - $solde_debit_classe_7;
            $final_balance['7_debit'] = 0;
        } else {
            $final_balance['7_debit'] = $solde_debit_classe_7 - $solde_credit_classe_7;
            $final_balance['7_credit'] = 0;
        }

        array_push($finalBalance, $final_balance);

        return $finalBalance;
    }

}

?>
