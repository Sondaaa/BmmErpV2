<?php

class calculBalanceTotaux {

    public static function getBalance($compte_min, $compte_max, $date_debut, $date_fin, $comptes_non_solde, $dossier_id, $exercice_id) {
        $exercice_precedet = $_SESSION['exercice'] - 1;
        $exercei_pre = ExerciceTable::getInstance()->findOneByLibelle($exercice_precedet);
//        $id_exe_pre = $exercei_pre->getId();
        $planDossierComptable = PlandossiercomptableTable::getInstance()->loadEtatBalanceTotaux($compte_min, $compte_max, $date_debut, $date_fin, $comptes_non_solde, $dossier_id, $exercice_id);
//        $planDossierComptable_totaux = PlandossiercomptableTable::getInstance()->loadEtatBalanceCompteTotaux($compte_min, $compte_max, $dossier_id, $exercice_id);

        $finalBalance = array();
//        $final_balance['crediteur'] = 0;
//        $final_balance['debiteur'] = 0;
        $solde_totaux_credit = 0;
        $solde_totaux_debit = 0;
        $solde_credit_classe_1_5 = 0;
        $solde_debit_colone_1 = 0;
        $solde_debit_colone_2 = 0;
        $solde_colone_3 = 0;
        $solde_colone_4 = 0;
        $solde_colone_5 = 0;
        $solde_colone_6 = 0;
        $solde_debit_classe_1_5 = 0;
        $solde_credit_classe_4 = 0;
        $solde_debit_classe_4 = 0;
        $solde_credit_classe_6 = 0;
        $solde_debit_classe_6 = 0;
        $solde_credit_classe_7 = 0;
        $solde_debit_classe_7 = 0;
        $montantCreditOuv = 0;
        $montantDebitOuv = 0;
        $montantCreditOuver = 0;
        $montantDebitOuver = 0;
        $soldeouverture = 0;
        foreach ($planDossierComptable as $p_d_c) {
            $soldeouverture = $soldeouverture + floatval($p_d_c->getSoldeouv());
        }
        foreach ($planDossierComptable as $p_d_c) {

            if ($p_d_c->getPlancomptable()->getIdCompte() == null) {
                $lignegras_total = ' font-weight: bold;';
            } else {
                $lignegras_total = '';
            }
            $calcul_mois = LignepiececomptableTable::getInstance()->calculDebitMoisClasse(trim($p_d_c->getNumerocompte()), $date_debut, $date_fin, $exercice_id, $dossier_id);
            $montantDebitMois = $calcul_mois->getTotalDebit();

            $montantCreditMois = $calcul_mois->getTotalCredit();

            $calcul_mois_ouv = LignepiececomptableTable::getInstance()->calculDebitOuvClasse(trim($p_d_c->getNumerocompte()));
            $soldeouv = $p_d_c->getSoldeouv();
            $solde = $p_d_c->getSolde();
            $exercice_prochain = $_SESSION['exercice'] + 1;
//            die($_SESSION['dossier_id'].'ex'.$_SESSION['exercice_id']);
            $exercei_proch = ExerciceTable::getInstance()->findByLibelle($exercice_prochain)->getLast();
//            die(sizeof($exercei_proch) . 'ex');
            if (sizeof($exercei_proch) > 1) {
                $dossierExericce = DossierexerciceTable::getInstance()->getByExerciceAndDosier($exercei_proch->getId(), $_SESSION['dossier_id']);
//                if (sizeof($dossierExericce) > 1) {
//                    $montantDebitOuv = 0;
//                    $montantCreditOuv = 0;
//                } else {
//           
                if ($p_d_c->getSoldeouv() >= 0) {
                    $montantDebitOuv = abs($p_d_c->getSoldeouv());
                    $montantCreditOuv = 0;
                } else if ($p_d_c->getSoldeouv() < 0) {
                    $montantDebitOuv = 0;
                    $montantCreditOuv = abs($p_d_c->getSoldeouv());
                }
//                }
            }
            if ($p_d_c->getSoldeouv() >= 0) {
                $montantDebitOuv = abs($p_d_c->getSoldeouv());
                $montantCreditOuv = 0;
            } else {
                $montantDebitOuv = 0;
                $montantCreditOuv = abs($p_d_c->getSoldeouv());
            }
            if ($soldeouverture == 0) {
                if ($p_d_c->getSolde() >= 0 && $p_d_c->getPlancomptable()->getClassecompte() <> 6 && $p_d_c->getPlancomptable()->getClassecompte() <> 7) {
                    $montantDebitOuver = abs($p_d_c->getSolde());
                    $montantCreditOuver = 0;
                }
                if ($p_d_c->getSolde() < 0 && $p_d_c->getPlancomptable()->getClassecompte() <> 6 && $p_d_c->getPlancomptable()->getClassecompte() <> 7) {
                    $montantDebitOuver = 0;
                    $montantCreditOuver = abs($p_d_c->getSolde());
                }
            }
//            if ($p_d_c->getTypesolde() == 0 && $soldeouv >= 0) {
//
//                $montantDebitOuv = $calcul_mois_ouv->getTotalDebit() + $soldeouv;
//            }

            
            
//            if ($p_d_c->getTypesolde() == 0 && $soldeouv < 0) {
//                $montantCreditOuv = $calcul_mois_ouv->getTotalCredit() - $soldeouv;
//            }
//             $montantDebitOuv= $calcul_mois_ouv->getTotalDebit();
//            $montantCreditOuv = $calcul_mois_ouv->getTotalCredit();
            $soldeDebit = $montantDebitOuv + $montantDebitMois + $montantDebitOuver;
            $soldeCredit = $montantCreditOuv + $montantCreditMois + $montantCreditOuver;

            if ($soldeDebit < $soldeCredit) {
                $soldeCredit = $soldeCredit - $soldeDebit;
            } else {
                $soldeDebit = $soldeDebit - $soldeCredit;
            }

//            $lignegras_total=$soldeCredit-$soldeDebit;    
            $final_balance = array();
            $final_balance['id'] = $p_d_c->getId();
            $final_balance['classe'] = $p_d_c->getPlancomptable()->getClassecompte()->getLibelle();
            $final_balance['compte'] = $p_d_c->getNumerocompte();
            $final_balance['libelle'] = $p_d_c->getLibelle();

            $final_balance['debitMois'] = $montantDebitMois;
            $final_balance['solde'] = $solde;

            $final_balance['creditMois'] = $montantCreditMois;
            $final_balance['debitOuv'] = $montantDebitOuv;

            $final_balance['creditOuv'] = $montantCreditOuv;
            $final_balance['ligne'] = $lignegras_total;
            $final_balance['debitCumulMois'] = $final_balance['debitOuv'] + $final_balance['debitMois'];
            $final_balance['crediCumultMois'] = $final_balance['creditOuv'] + $final_balance['creditMois'];

            //code balance 2020 bien
            if ($final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] < 0) {
                $final_balance['crediteur'] = ($final_balance['crediCumultMois'] - $final_balance['debitCumulMois']);
                $final_balance['debiteur'] = 0;
            } else {
                $final_balance['debiteur'] = ($final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] );
                $final_balance['crediteur'] = 0;
            }
           // echo ($final_balance['crediteur']. $p_d_c->getNumerocompte() .$final_balance['debiteur']);
//            if ($soldeouverture == 0) {
//                $final_balance['debiteur'] = $soldeDebit;
//                $final_balance['crediteur'] = $soldeCredit;
//            }
//            } elseif ($final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] > 0) {
//                $final_balance['debiteur'] = ($final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] );
//
//                $final_balance['crediteur'] = 0;
//            }
//            elseif ($final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] == 0 && $soldeouv == 0.000) {
//
//                if ($solde <= 0  ) {
//                    $final_balance['crediteur'] = ($final_balance['crediCumultMois'] - $final_balance['debitCumulMois'] + $solde );
//                    $final_balance['debiteur'] = 0;
//                } else {
//                    $final_balance['debiteur'] = ($final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] - $solde );
//                    $final_balance['crediteur'] = 0;
//                }

            $soldeDebit = $final_balance['debiteur'];
            $soldeCredit = $final_balance['crediteur'];
//                $soldeDebit = $final_balance['debiteur'];
//                $soldeCredit = $final_balance['crediteur'];
//            }
            $soldeDebit = $final_balance['debiteur'];
            $soldeCredit = $final_balance['crediteur'];
            //***************in2020
//            if (sizeof($exercei_proch) > 1) {
//                if ($p_d_c->getPlancomptable()->getIdClasse() == 6) {
//                    if ($p_d_c->getSolde() >= 0)
//                        $solde_debit_classe_6 += $p_d_c->getSolde();
//                    else
//                        $solde_credit_classe_6 += $p_d_c->getSolde();
//                }
//                if ($p_d_c->getPlancomptable()->getIdClasse() == 7) {
//                    if ($p_d_c->getSolde() > 0)
//                        $solde_debit_classe_7 += $p_d_c->getSolde();
//                    else
//                        $solde_credit_classe_7 += $p_d_c->getSolde();
//                }
//                if ($solde < 0) {
//                    $final_balance['crediteur'] = ($final_balance['crediCumultMois'] - $final_balance['debitCumulMois'] - $solde );
//                } elseif ($solde > 0) {
//                    $final_balance['debiteur'] = ($final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] + $solde );
//                } else {
//                    if ($p_d_c->getTypesolde() == 2) {
//                        $montantCreditOuv = $calcul_mois_ouv->getTotalCredit();
//                        $montantDebitOuv = 0;
//                    }
//                    if ($p_d_c->getTypesolde() == 1) {
//                        $montantDebitOuv = $calcul_mois_ouv->getTotalDebit();
//                        $montantCreditOuv = 0;
//                    }
//                    if ($p_d_c->getTypesolde() == 0) {
//                        $montantDebitOuv = 0;
//                        $montantCreditOuv = 0;
//                    }
//                    $final_balance['debiteur'] = $montantDebitOuv;
//                    $final_balance['crediteur'] = $montantCreditOuv;
//                    $solde_debit_classe_1_5 +=$montantDebitOuv;
//                    $solde_credit_classe_1_5 +=$montantCreditOuv;
//                    if ($solde_debit_classe_1_5 < $solde_credit_classe_1_5) {
//                        $final_balance['1_5_credit'] = $solde_credit_classe_1_5 - $solde_debit_classe_1_5;
//                        $final_balance['1_5_debit'] = 0;
//                    } else {
//                        $final_balance['1_5_debit'] = $solde_debit_classe_1_5 - $solde_credit_classe_1_5;
//                        $final_balance['1_5_credit'] = 0;
//                    }
//                }
//                if ($solde_debit_classe_6 < $solde_credit_classe_6) {
//                    $final_balance['6_credit'] = $solde_credit_classe_6 - $solde_debit_classe_6;
//                    $final_balance['6_debit'] = 0;
//                } else {
//                    $final_balance['6_debit'] = $solde_debit_classe_6 - $solde_credit_classe_6;
//                    $final_balance['6_credit'] = 0;
//                }
//                if ($solde_debit_classe_7 < $solde_credit_classe_7) {
//                    $final_balance['7_credit'] = $solde_credit_classe_7 - $solde_debit_classe_7;
//                    $final_balance['7_debit'] = 0;
//                } else {
//                    $final_balance['7_debit'] = $solde_debit_classe_7 - $solde_credit_classe_7;
//                    $final_balance['7_credit'] = 0;
//                }
////            $solde_totaux_debit += $final_balance['debiteur'];
////            $solde_totaux_credit +=$final_balance['crediteur'];
//           
//            }
            $solde_totaux_debit += $soldeDebit;
            $solde_totaux_credit +=$soldeCredit;         
            array_push($finalBalance, $final_balance);
            if (strlen(trim($p_d_c->getPlancomptable()->getNumerocompte())) >= 7) {
                if (($p_d_c->getPlancomptable()->getIdClasse() >= 1 && $p_d_c->getPlancomptable()->getIdClasse() <= 5)) {
                    $solde_debit_classe_1_5 += $soldeDebit;
                    $solde_credit_classe_1_5 += $soldeCredit;
                }

                if ($p_d_c->getPlancomptable()->getIdClasse() == 6) {
                    $solde_debit_classe_6 += $soldeDebit;
                    $solde_credit_classe_6 += $soldeCredit;
                }

                if ($p_d_c->getPlancomptable()->getIdClasse() == 7) {
                    $solde_debit_classe_7 += $soldeDebit;
                    $solde_credit_classe_7 += $soldeCredit;
                }
                
               
            }
             
            $solde_debit_colone_1 +=$montantDebitOuv;
            $solde_debit_colone_2 +=$montantCreditOuv;
            $solde_colone_3 +=$montantDebitMois;
            $solde_colone_4 +=$montantCreditMois;
            $solde_colone_5 = $solde_debit_colone_1 + $solde_colone_3;
            $solde_colone_6 = $solde_debit_colone_2 + $solde_colone_4;
//            $solde_colone_5 +=($montantDebitOuv + $montantDebitMois);
//            $solde_colone_6 +=($montantCreditOuv + $montantCreditMois);
//            $solde_totaux_debit += $soldeDebit;
//            $solde_totaux_credit +=$soldeCredit;
//            $final_balance = array();
//            $final_balance['id'] = $p_d_c->getId();
//            $final_balance['compte'] = trim($p_d_c->getNumerocompte());
//            $final_balance['libelle'] = $p_d_c->getLibelle();
//            $final_balance['debitMois'] = $montantDebitMois;
//            $final_balance['creditMois'] = $montantCreditMois;
//            $final_balance['debitOuv'] = $montantDebitOuv;
//            $final_balance['creditOuv'] = $montantCreditOuv;
//            $final_balance['debiteur'] = $soldeDebit;
//            $final_balance['crediteur'] = $soldeCredit;
//            $final_balance['ligne'] = $lignegras_total;
//
//            array_push($finalBalance, $final_balance);
        }

        $final_balance = array();
        $final_balance['solde_debit'] = $solde_totaux_debit;
        $final_balance['solde_credit'] = $solde_totaux_credit;
        $final_balance['solde_colone_1'] = $solde_debit_colone_1;
        $final_balance['solde_colone_2'] = $solde_debit_colone_2;
        $final_balance['solde_colone_3'] = $solde_colone_3;
        $final_balance['solde_colone_4'] = $solde_colone_4;
        $final_balance['solde_colone_5'] = $solde_colone_5;
        $final_balance['solde_colone_6'] = $solde_colone_6;
        if ($solde_debit_classe_1_5 > $solde_credit_classe_1_5) {
            $final_balance['1_5_credit'] = -$solde_credit_classe_1_5 + $solde_debit_classe_1_5;
            $final_balance['1_5_debit'] = 0;
        } else {
            $final_balance['1_5_debit'] = -$solde_debit_classe_1_5 + $solde_credit_classe_1_5;
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
        if ($solde_debit_classe_4 < $solde_credit_classe_4) {
            $final_balance['4_credit'] = $solde_credit_classe_4 - $solde_debit_classe_4;
            $final_balance['4_debit'] = 0;
        } else {
            $final_balance['4_debit'] = $solde_debit_classe_4 - $solde_credit_classe_4;
            $final_balance['4_credit'] = 0;
        }

        array_push($finalBalance, $final_balance);

        return $finalBalance;
    }

    public static function getBalanceTotal($compte_min, $compte_max, $date_debut, $date_fin, $comptes_non_solde, $dossier_id, $exercice_id) {
        $exercice_precedet = $_SESSION['exercice'] - 1;
        $exercei_pre = ExerciceTable::getInstance()->findOneByLibelle($exercice_precedet);
//        $id_exe_pre = $exercei_pre->getId();
        $planDossierComptable = PlandossiercomptableTable::getInstance()->loadEtatBalanceTotauxTT($compte_min, $compte_max, $date_debut, $date_fin, $comptes_non_solde, $dossier_id, $exercice_id);
//        $planDossierComptable_totaux = PlandossiercomptableTable::getInstance()->loadEtatBalanceCompteTotaux($compte_min, $compte_max, $dossier_id, $exercice_id);
//die(sizeof($planDossierComptable).'size');
        $finalBalance = array();
        $solde_totaux_credit = 0;
        $solde_totaux_debit = 0;
        $solde_credit_classe_1_5 = 0;
        $solde_debit_colone_1 = 0;
        $solde_debit_colone_2 = 0;
        $solde_colone_3 = 0;
        $solde_colone_4 = 0;
        $solde_colone_5 = 0;
        $solde_colone_6 = 0;
        $solde_debit_classe_1_5 = 0;
        $solde_credit_classe_4 = 0;
        $solde_debit_classe_4 = 0;
        $solde_credit_classe_6 = 0;
        $solde_debit_classe_6 = 0;
        $solde_credit_classe_7 = 0;
        $solde_debit_classe_7 = 0;
        $montantCreditOuv = 0;
        $montantDebitOuv = 0;

        foreach ($planDossierComptable as $p_d_c) {
            if ($p_d_c->getPlancomptable()->getIdCompte() == null) {
                $lignegras_total = ' font-weight: bold;';
            } else {
                $lignegras_total = '';
            }
            $calcul_mois = LignepiececomptableTable::getInstance()->calculDebitMoisClasse(trim($p_d_c->getNumerocompte()), $date_debut, $date_fin, $exercice_id, $dossier_id);
            $montantDebitMois = $calcul_mois->getTotalDebit();
            $montantCreditMois = $calcul_mois->getTotalCredit();

            $calcul_mois_ouv = LignepiececomptableTable::getInstance()->calculDebitOuvClasse(trim($p_d_c->getNumerocompte()));
            $soldeouv = $p_d_c->getSoldeouv();
            $solde = $p_d_c->getSolde();
            $exercice_prochain = $_SESSION['exercice'] + 1;
//            die($_SESSION['dossier_id'].'ex'.$_SESSION['exercice_id']);
            $exercei_proch = ExerciceTable::getInstance()->findByLibelle($exercice_prochain)->getLast();
//            die(sizeof($exercei_proch) . 'ex');
            if ($p_d_c->getSoldeouv() >= 0) {
                $montantDebitOuv = abs($p_d_c->getSoldeouv());
                $montantCreditOuv = 0;
            } else {
                $montantDebitOuv = 0;
                $montantCreditOuv = abs($p_d_c->getSoldeouv());
            }
            if (sizeof($exercei_proch) > 1) {
                $dossierExericce = DossierexerciceTable::getInstance()->getByExerciceAndDosier($exercei_proch->getId(), $_SESSION['dossier_id']);
//die(sizeof($dossierExericce).'ex');
                if (sizeof($dossierExericce) > 1) {
//                if ($exercei_proch->getId() != '') {
                    $montantDebitOuv = 0;
                    $montantCreditOuv = 0;
//                }
                } else {
//                if ($p_d_c->getTypesolde() == 2) {
//                    $montantCreditOuv = $calcul_mois_ouv->getTotalCredit();
//                    $montantDebitOuv = 0;
//                }
//                if ($p_d_c->getTypesolde() == 1) {
//                    $montantDebitOuv = $calcul_mois_ouv->getTotalDebit();
//                    $montantCreditOuv = 0;
//                }
//                if ($p_d_c->getTypesolde() == 0) {
//                    $montantDebitOuv = 0;
//                    $montantCreditOuv = 0;
//                }
//                if ($p_d_c->getTypesolde() == 3) {
//
                    if ($p_d_c->getSoldeouv() >= 0) {
                        $montantDebitOuv = abs($p_d_c->getSoldeouv());
                        $montantCreditOuv = 0;
                    } else {
                        $montantDebitOuv = 0;
                        $montantCreditOuv = abs($p_d_c->getSoldeouv());
                    }
//                }
                }
            }
//            if ($p_d_c->getTypesolde() ==0 && $soldeouv >=0) {
//               
//                $montantDebitOuv = $calcul_mois_ouv->getTotalDebit()+$soldeouv;
//            }
//             if ($p_d_c->getTypesolde() ==0 && $soldeouv <0) {
//                $montantCreditOuv = $calcul_mois_ouv->getTotalCredit()-$soldeouv;
//            }
//            $montantDebitOuv = $calcul_mois_ouv->getTotalDebit();
//            $montantCreditOuv = $calcul_mois_ouv->getTotalCredit();
            $soldeDebit = $montantDebitOuv + $montantDebitMois;
            $soldeCredit = $montantCreditOuv + $montantCreditMois;

            if ($soldeDebit < $soldeCredit) {
                $soldeCredit = $soldeCredit - $soldeDebit;
            } else {
                $soldeDebit = $soldeDebit - $soldeCredit;
            }

//            $lignegras_total=$soldeCredit-$soldeDebit;    
            $final_balance = array();
            $final_balance['id'] = $p_d_c->getId();
            $final_balance['classe'] = $p_d_c->getPlancomptable()->getClassecompte()->getLibelle();
            $final_balance['compte'] = $p_d_c->getNumerocompte();
            $final_balance['libelle'] = $p_d_c->getLibelle();
            $final_balance['debitMois'] = $montantDebitMois;
            $final_balance['solde'] = $solde;

            $final_balance['creditMois'] = $montantCreditMois;
            $final_balance['debitOuv'] = $montantDebitOuv;
            $final_balance['creditOuv'] = $montantCreditOuv;
            $final_balance['ligne'] = $lignegras_total;
            $final_balance['debitCumulMois'] = $final_balance['debitOuv'] + $final_balance['debitMois'];
            $final_balance['crediCumultMois'] = $final_balance['creditOuv'] + $final_balance['creditMois'];
//           if(sizeof($exercei_proch)>0){
//                 if ($final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] < 0) {
//             
////                     die('1');
//                     $final_balance['crediteur'] = ($final_balance['crediCumultMois'] - $final_balance['debitCumulMois'] );
//                 $final_balance['debiteur'] = 0;
//                  $soldeDebit = $final_balance['debiteur'];
//                $soldeCredit = $final_balance['crediteur'];
//                 }
//                  else {
//              
//                  $final_balance['debiteur'] = $final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] ;
//
//                    $final_balance['crediteur'] = 0;
//                 $soldeDebit = $final_balance['debiteur'];
//                $soldeCredit = $final_balance['crediteur'];
//            }
//
//           } 
//            if ($soldeouv == 0.000) {
//                if ($final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] <= 0) {
//                    if ($solde <= 0) {
//                        $final_balance['crediteur'] = ($final_balance['crediCumultMois'] - $final_balance['debitCumulMois'] - $solde );
//                    } else {
//                        $final_balance['debiteur'] = ($final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] + $solde );
//                    }
////                $final_balance['debiteur'] = 0;
//                    $soldeDebit = $final_balance['debiteur'];
//                    $soldeCredit = $final_balance['crediteur'];
//                }
//            } else {
            //code balance 2020 bien
            if ($final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] < 0) {

                $final_balance['crediteur'] = ($final_balance['crediCumultMois'] - $final_balance['debitCumulMois']);
                $final_balance['debiteur'] = 0;
            } elseif ($final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] > 0) {
                $final_balance['debiteur'] = ($final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] );

                $final_balance['crediteur'] = 0;
            } elseif ($final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] == 0 && $soldeouv == 0.000) {

                if ($solde <= 0) {
                    $final_balance['crediteur'] = ($final_balance['crediCumultMois'] - $final_balance['debitCumulMois'] - $solde );
                    $final_balance['debiteur'] = 0;
                } else {
                    $final_balance['debiteur'] = ($final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] + $solde );
                    $final_balance['crediteur'] = 0;
                }

                $soldeDebit = $final_balance['debiteur'];
                $soldeCredit = $final_balance['crediteur'];
//                $soldeDebit = $final_balance['debiteur'];
//                $soldeCredit = $final_balance['crediteur'];
            }

            //***************in2020
//            if (sizeof($exercei_proch) > 1) {
//                if ($p_d_c->getPlancomptable()->getIdClasse() == 6) {
//                    if ($p_d_c->getSolde() >= 0)
//                        $solde_debit_classe_6 += $p_d_c->getSolde();
//                    else
//                        $solde_credit_classe_6 += $p_d_c->getSolde();
//                }
//                if ($p_d_c->getPlancomptable()->getIdClasse() == 7) {
//                    if ($p_d_c->getSolde() > 0)
//                        $solde_debit_classe_7 += $p_d_c->getSolde();
//                    else
//                        $solde_credit_classe_7 += $p_d_c->getSolde();
//                }
//                if ($solde < 0) {
//                    $final_balance['crediteur'] = ($final_balance['crediCumultMois'] - $final_balance['debitCumulMois'] - $solde );
//                } elseif ($solde > 0) {
//                    $final_balance['debiteur'] = ($final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] + $solde );
//                } else {
//                    if ($p_d_c->getTypesolde() == 2) {
//                        $montantCreditOuv = $calcul_mois_ouv->getTotalCredit();
//                        $montantDebitOuv = 0;
//                    }
//                    if ($p_d_c->getTypesolde() == 1) {
//                        $montantDebitOuv = $calcul_mois_ouv->getTotalDebit();
//                        $montantCreditOuv = 0;
//                    }
//                    if ($p_d_c->getTypesolde() == 0) {
//                        $montantDebitOuv = 0;
//                        $montantCreditOuv = 0;
//                    }
//                    $final_balance['debiteur'] = $montantDebitOuv;
//                    $final_balance['crediteur'] = $montantCreditOuv;
//                    $solde_debit_classe_1_5 +=$montantDebitOuv;
//                    $solde_credit_classe_1_5 +=$montantCreditOuv;
//                    if ($solde_debit_classe_1_5 < $solde_credit_classe_1_5) {
//                        $final_balance['1_5_credit'] = $solde_credit_classe_1_5 - $solde_debit_classe_1_5;
//                        $final_balance['1_5_debit'] = 0;
//                    } else {
//                        $final_balance['1_5_debit'] = $solde_debit_classe_1_5 - $solde_credit_classe_1_5;
//                        $final_balance['1_5_credit'] = 0;
//                    }
//                }
//                if ($solde_debit_classe_6 < $solde_credit_classe_6) {
//                    $final_balance['6_credit'] = $solde_credit_classe_6 - $solde_debit_classe_6;
//                    $final_balance['6_debit'] = 0;
//                } else {
//                    $final_balance['6_debit'] = $solde_debit_classe_6 - $solde_credit_classe_6;
//                    $final_balance['6_credit'] = 0;
//                }
//                if ($solde_debit_classe_7 < $solde_credit_classe_7) {
//                    $final_balance['7_credit'] = $solde_credit_classe_7 - $solde_debit_classe_7;
//                    $final_balance['7_debit'] = 0;
//                } else {
//                    $final_balance['7_debit'] = $solde_debit_classe_7 - $solde_credit_classe_7;
//                    $final_balance['7_credit'] = 0;
//                }
//                $solde_totaux_debit += $final_balance['debiteur'];
//                $solde_totaux_credit +=$final_balance['crediteur'];
//            }
//          

            array_push($finalBalance, $final_balance);

            if (strlen(trim($p_d_c->getPlancomptable()->getNumerocompte())) > 7) {
                if (($p_d_c->getPlancomptable()->getIdClasse() >= 1 && $p_d_c->getPlancomptable()->getIdClasse() <= 5)) {
                    $solde_debit_classe_1_5 += $soldeDebit;
                    $solde_credit_classe_1_5 += $soldeCredit;
                }

                if ($p_d_c->getPlancomptable()->getIdClasse() == 6) {
                    $solde_debit_classe_6 += $soldeDebit;
                    $solde_credit_classe_6 += $soldeCredit;
                }

                if ($p_d_c->getPlancomptable()->getIdClasse() == 7) {
                    $solde_debit_classe_7 += $soldeDebit;
                    $solde_credit_classe_7 += $soldeCredit;
                }
            }
            $solde_debit_colone_1 +=$montantDebitOuv;
            $solde_debit_colone_2 +=$montantCreditOuv;
            $solde_colone_3 +=$montantDebitMois;
            $solde_colone_4 +=$montantCreditMois;
            $solde_colone_5 = $solde_debit_colone_1 + $solde_colone_3;
            $solde_colone_6 = $solde_debit_colone_2 + $solde_colone_4;
//            $solde_colone_5 +=($montantDebitOuv + $montantDebitMois);
//            $solde_colone_6 +=($montantCreditOuv + $montantCreditMois);
            $solde_totaux_debit += $soldeDebit;
            $solde_totaux_credit +=$soldeCredit;
//            $final_balance = array();
//            $final_balance['id'] = $p_d_c->getId();
//            $final_balance['compte'] = trim($p_d_c->getNumerocompte());
//            $final_balance['libelle'] = $p_d_c->getLibelle();
//            $final_balance['debitMois'] = $montantDebitMois;
//            $final_balance['creditMois'] = $montantCreditMois;
//            $final_balance['debitOuv'] = $montantDebitOuv;
//            $final_balance['creditOuv'] = $montantCreditOuv;
//            $final_balance['debiteur'] = $soldeDebit;
//            $final_balance['crediteur'] = $soldeCredit;
//            $final_balance['ligne'] = $lignegras_total;
//
//            array_push($finalBalance, $final_balance);
        }

        $final_balance = array();
        $final_balance['solde_debit'] = $solde_totaux_debit;
        $final_balance['solde_credit'] = $solde_totaux_credit;
        $final_balance['solde_colone_1'] = $solde_debit_colone_1;
        $final_balance['solde_colone_2'] = $solde_debit_colone_2;
        $final_balance['solde_colone_3'] = $solde_colone_3;
        $final_balance['solde_colone_4'] = $solde_colone_4;
        $final_balance['solde_colone_5'] = $solde_colone_5;
        $final_balance['solde_colone_6'] = $solde_colone_6;
        if ($solde_debit_classe_1_5 > $solde_credit_classe_1_5) {
            $final_balance['1_5_credit'] = -$solde_credit_classe_1_5 + $solde_debit_classe_1_5;
            $final_balance['1_5_debit'] = 0;
        } else {
            $final_balance['1_5_debit'] = -$solde_debit_classe_1_5 + $solde_credit_classe_1_5;
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
        if ($solde_debit_classe_4 < $solde_credit_classe_4) {
            $final_balance['4_credit'] = $solde_credit_classe_4 - $solde_debit_classe_4;
            $final_balance['4_debit'] = 0;
        } else {
            $final_balance['4_debit'] = $solde_debit_classe_4 - $solde_credit_classe_4;
            $final_balance['4_credit'] = 0;
        }

        array_push($finalBalance, $final_balance);

        return $finalBalance;
    }

    public static function getBalance2($compte_min, $compte_max, $date_debut, $date_fin, $comptes_non_solde, $dossier_id, $exercice_id) {

        $planDossierComptable = PlandossiercomptableTable::getInstance()->loadEtatBalanceTotaux2($compte_min, $compte_max, $date_debut, $date_fin, $comptes_non_solde, $dossier_id, $exercice_id);
//        $planDossierComptable_totaux = PlandossiercomptableTable::getInstance()->loadEtatBalanceCompteTotaux($compte_min, $compte_max, $dossier_id, $exercice_id);

        $finalBalance = array();

        $solde_credit_classe_1_5 = 0;
        $solde_debit_classe_1_5 = 0;
        $solde_credit_classe_6 = 0;
        $solde_debit_classe_6 = 0;
        $solde_credit_classe_7 = 0;
        $solde_debit_classe_7 = 0;

        foreach ($planDossierComptable as $p_d_c) {

            if ($p_d_c->getPlancomptable()->getIdCompte() == null) {
                $lignegras_total = ' font-weight: bold;';
            } else {
                $lignegras_total = '';
            }

            $calcul_mois = LignepiececomptableTable::getInstance()->calculDebitMoisClasseE(trim($p_d_c->getNumerocompte()), $date_debut, $date_fin, $exercice_id);
            $montantDebitMois = $calcul_mois->getTotalDebit();
            $montantCreditMois = $calcul_mois->getTotalCredit();

//            $calcul_mois_ouv = LignepiececomptableTable::getInstance()->calculDebitOuvClasse(trim($p_d_c->getNumerocompte()));
//            $soldeouv = $p_d_c->getSolde();
//            if ($p_d_c->getTypesolde() == 2) {
//                $montantCreditOuv = $calcul_mois_ouv->getTotalCredit() + $soldeouv;
//            }
//            if ($p_d_c->getTypesolde() == 1) {
//                $montantDebitOuv = $calcul_mois_ouv->getTotalDebit() + $soldeouv;
//            }
//            if ($p_d_c->getTypesolde() != 2 && $p_d_c->getTypesolde() != 1) {
//                $montantDebitOuv = $calcul_mois_ouv->getTotalDebit();
//
//                $montantCreditOuv = $calcul_mois_ouv->getTotalCredit();
//            }

            $calcul_mois_ouv = LignepiececomptableTable::getInstance()->calculDebitOuvClasse(trim($p_d_c->getNumerocompte()));
            $soldeouv = $p_d_c->getSoldeouv();
            $solde = $p_d_c->getSolde();
            if ($p_d_c->getTypesolde() == 2) {
                $montantCreditOuv = $calcul_mois_ouv->getTotalCredit() - $soldeouv;
            }
            if ($p_d_c->getTypesolde() == 1) {
                $montantDebitOuv = $calcul_mois_ouv->getTotalDebit() + $soldeouv;
            }
            if ($p_d_c->getTypesolde() == 0) {
                $montantDebitOuv = 0;
                $montantCreditOuv = 0;
            }

            $soldeDebit = $montantDebitOuv + $montantDebitMois;
            $soldeCredit = $montantCreditOuv + $montantCreditMois;

            if ($soldeDebit < $soldeCredit) {
                $soldeCredit = $soldeCredit - $soldeDebit;
            } else {
                $soldeDebit = $soldeDebit - $soldeCredit;
            }

//            $lignegras_total=$soldeCredit-$soldeDebit;    
            $final_balance = array();
            $final_balance['id'] = $p_d_c->getId();
            $final_balance['compte'] = $p_d_c->getNumerocompte();
            $final_balance['numcompte'] = trim($p_d_c->getPlancomptable()->getNumerocompte());
            $final_balance['classe'] = trim($p_d_c->getPlancomptable()->getClassecompte()->getCode());

            $final_balance['libelle'] = $p_d_c->getLibelle();
            $final_balance['debitMois'] = $montantDebitMois;
            $final_balance['creditMois'] = $montantCreditMois;
            if ($p_d_c->getTypesolde() == 2) {
                $final_balance['debitOuv'] = 0;
                $final_balance['creditOuv'] = $soldeouv;
            } if ($p_d_c->getTypesolde() == 1) {
                $final_balance['debitOuv'] = $soldeouv;
                $final_balance['creditOuv'] = 0;
            }
            if ($p_d_c->getTypesolde() != 2 && $p_d_c->getTypesolde() != 1) {
                $final_balance['debitOuv'] = 0;
                $final_balance['creditOuv'] = 0;
            }
            $final_balance['debiteur'] = $soldeDebit;
            $final_balance['crediteur'] = $soldeCredit;
            $final_balance['ligne'] = $lignegras_total;
            $final_balance['debitCumulMois'] = $final_balance['debitOuv'] + $final_balance['debitMois'];
            $final_balance['crediCumultMois'] = $final_balance['creditOuv'] + $final_balance['creditMois'];
            if ($final_balance['debitCumulMois'] - $final_balance['crediCumultMois'] < 0)
                $final_balance['crediteur'] = $soldeCredit;
            else
                $final_balance['debiteur'] = $soldeDebit;

            array_push($finalBalance, $final_balance);

            if (strlen(trim($p_d_c->getPlancomptable()->getNumerocompte())) > 1) {
                if (($p_d_c->getPlancomptable()->getIdClasse() >= 1 && $p_d_c->getPlancomptable()->getIdClasse() <= 5)) {
                    $solde_debit_classe_1_5 += $soldeDebit;
                    $solde_credit_classe_1_5 += $soldeCredit;
                }
                if ($p_d_c->getPlancomptable()->getIdClasse() == 6) {
                    $solde_debit_classe_6 += $soldeDebit;
                    $solde_credit_classe_6 += $soldeCredit;
                }
                if ($p_d_c->getPlancomptable()->getIdClasse() == 7) {
                    $solde_debit_classe_7 += $soldeDebit;
                    $solde_credit_classe_7 += $soldeCredit;
                }
            }

//            $final_balance = array();
//            $final_balance['id'] = $p_d_c->getId();
//            $final_balance['compte'] = trim($p_d_c->getNumerocompte());
//            $final_balance['libelle'] = $p_d_c->getLibelle();
//            $final_balance['debitMois'] = $montantDebitMois;
//            $final_balance['creditMois'] = $montantCreditMois;
//            $final_balance['debitOuv'] = $montantDebitOuv;
//            $final_balance['creditOuv'] = $montantCreditOuv;
//            $final_balance['debiteur'] = $soldeDebit;
//            $final_balance['crediteur'] = $soldeCredit;
//            $final_balance['ligne'] = $lignegras_total;
//
//            array_push($finalBalance, $final_balance);
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
