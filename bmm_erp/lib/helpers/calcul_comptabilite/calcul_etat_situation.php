<?php

class calculSituationCumulee {

    public static function getSituation($titre, $min_mois, $max_mois, $min_annee, $max_annee) {
        $ligprotitres = LigprotitrubTable::getInstance()->getParentByTitreBudgetSituation($titre);

        $min_annee_0 = '';
        $min_annee_1 = '';
        $max_annee_0 = '';
        $max_annee_1 = '';
        if ($min_annee < date('Y'))
            $min_annee_0 = $min_annee;
        else
            $min_annee_1 = $min_annee;
        if ($max_annee < date('Y'))
            $max_annee_0 = $max_annee;
        else {
            $max_annee_0 = date('Y') - 1;
            if ($min_annee_1 == '')
                $min_annee_1 = date('Y');
            $max_annee_1 = $max_annee;
        }
        $finalListe = array();
        foreach ($ligprotitres as $ligprotitre) {
            $sous_listes = LigprotitrubTable::getInstance()->getSousrubriqueByTitreBudget($titre, $ligprotitre->getIdRubrique());
            $mnt_engagement = 0;
            $mnt_engagement_total = 0;
            $mnt_paiement = 0;
            $mnt_paiement_total = 0;

            if ($min_annee_0 != '') {
                $liste_antecedent = SituationcumuleeTable::getInstance()->getAntecedent($ligprotitre->getId(), $min_annee_0, $max_annee_0);
                $mnt_engagement = $liste_antecedent->getTotalengagement();
                $mnt_paiement = $liste_antecedent->getTotalpaiement();
            }
            if ($min_annee_1 != '') {
                $liste_courant = SituationcumuleeTable::getInstance()->getCourant($ligprotitre->getId(), $max_mois, $max_annee_1);
                if ($liste_courant) {
                    $mnt_engagement = $mnt_engagement + $liste_courant->getMntengagement();
                    $mnt_paiement = $mnt_paiement + $liste_courant->getMntpaiement();
                }
            }
            $final_liste = array();
            $final_liste['rubrique'] = trim($ligprotitre->getRubrique()->getCode()) . ' : ' . trim($ligprotitre->getRubrique()->getLibelle());
            $final_liste['engagement'] = $mnt_engagement;
            $final_liste['paiement'] = $mnt_paiement;
            $final_liste['total'] = $mnt_engagement - $mnt_paiement;
            if (count($sous_listes) == 0) {
                $mnt_engagement_total = $mnt_engagement_total + $mnt_engagement;
                $mnt_paiement_total = $mnt_paiement_total + $mnt_paiement;
            }
            $final_liste['totalpaiement'] = $mnt_paiement_total;
            $final_liste['totalEngagement'] = $mnt_engagement_total;
            array_push($finalListe, $final_liste);
        }
//        foreach ($sous_listes as $sous_liste) {
//            $mnt_engagement = 0;
//            $mnt_paiement = 0;
//            if ($min_annee_0 != '') {
//                $liste_antecedent = SituationcumuleeTable::getInstance()->getAntecedent($sous_liste->getId(), $min_annee_0, $max_annee_0);
//                $mnt_engagement = $liste_antecedent->getTotalengagement();
//                $mnt_paiement = $liste_antecedent->getTotalpaiement();
//            }
//            if ($min_annee_1 != '') {
//                $liste_courant = SituationcumuleeTable::getInstance()->getCourant($sous_liste->getId(), $max_mois, $max_annee_1);
//                if ($liste_courant) {
//                    $mnt_engagement = $mnt_engagement + $liste_courant->getMntengagement();
//                    $mnt_paiement = $mnt_paiement + $liste_courant->getMntpaiement();
//                }
//            }
//
//            $final_liste_sous_rubrique = array();
//            $final_liste_sous_rubrique['rubrique'] = trim($sous_liste->getRubrique()->getCode()) . ' : ' . trim($sous_liste->getRubrique()->getLibelle());
//            $final_liste_sous_rubrique['engagement'] = $mnt_engagement;
//            $final_liste_sous_rubrique['paiement'] = $mnt_paiement;
//            $final_liste_sous_rubrique['total'] = $mnt_engagement - $mnt_paiement;
//
//            array_push($finalListe, $final_liste_sous_rubrique);
//        }
//        array_push($finalListe, $final_liste, $final_liste_sous_rubrique);


        return $finalListe;
    }

//   public static function getSituation($titre, $min_mois, $max_mois, $min_annee, $max_annee) {
//        $ligprotitres = LigprotitrubTable::getInstance()->getParentByTitreBudget($titre);
//        $min_annee_0 = '';
//        $min_annee_1 = '';
//        $max_annee_0 = '';
//        $max_annee_1 = '';
//        if ($min_annee < date('Y'))
//            $min_annee_0 = $min_annee;
//        else
//            $min_annee_1 = $min_annee;
//        if ($max_annee < date('Y'))
//            $max_annee_0 = $max_annee;
//        else {
//            $max_annee_0 = date('Y') - 1;
//            if ($min_annee_1 == '')
//                $min_annee_1 = date('Y');
//            $max_annee_1 = $max_annee;
//        }
//        $finalListe = array();
//        $finalListeRubrique = array();
//        $finalListeSousrubrique = array();
//        foreach ($ligprotitres as $ligprotitre) {
//            $sous_listes = LigprotitrubTable::getInstance()->getSousrubriqueByTitreBudget($titre, $ligprotitre->getIdRubrique());
//            $mnt_engagement = 0;
//            $mnt_paiement = 0;
//
//            if ($min_annee_0 != '') {
//                $liste_antecedent = SituationcumuleeTable::getInstance()->getAntecedent($ligprotitre->getId(), $min_annee_0, $max_annee_0);
//                $mnt_engagement = $liste_antecedent->getTotalengagement();
//                $mnt_paiement = $liste_antecedent->getTotalpaiement();
//            }
//            if ($min_annee_1 != '') {
//                $liste_courant = SituationcumuleeTable::getInstance()->getCourant($ligprotitre->getId(), $max_mois, $max_annee_1);
//                if ($liste_courant) {
//                    $mnt_engagement = $mnt_engagement + $liste_courant->getMntengagement();
//                    $mnt_paiement = $mnt_paiement + $liste_courant->getMntpaiement();
//                }
//            }
//            $final_liste = array();
//            $final_liste['rubrique'] = trim($ligprotitre->getRubrique()->getCode()) . ' : ' . trim($ligprotitre->getRubrique()->getLibelle());
//            $final_liste['engagement'] = $mnt_engagement;
//            $final_liste['paiement'] = $mnt_paiement;
//            $final_liste['total'] = $mnt_engagement - $mnt_paiement;
//            array_push($finalListeRubrique, $final_liste);
//        }
//        foreach ($sous_listes as $sous_liste) {
//            $mnt_engagement = 0;
//            $mnt_paiement = 0;
//            if ($min_annee_0 != '') {
//                $liste_antecedent = SituationcumuleeTable::getInstance()->getAntecedent($sous_liste->getId(), $min_annee_0, $max_annee_0);
//                $mnt_engagement = $liste_antecedent->getTotalengagement();
//                $mnt_paiement = $liste_antecedent->getTotalpaiement();
//            }
//            if ($min_annee_1 != '') {
//                $liste_courant = SituationcumuleeTable::getInstance()->getCourant($sous_liste->getId(), $max_mois, $max_annee_1);
//                if ($liste_courant) {
//                    $mnt_engagement = $mnt_engagement + $liste_courant->getMntengagement();
//                    $mnt_paiement = $mnt_paiement + $liste_courant->getMntpaiement();
//                }
//            }
//
//            $final_liste_sous_rubrique = array();
//            $final_liste_sous_rubrique['rubrique'] = trim($sous_liste->getRubrique()->getCode()) . ' : ' . trim($sous_liste->getRubrique()->getLibelle());
//            $final_liste_sous_rubrique['engagement'] = $mnt_engagement;
//            $final_liste_sous_rubrique['paiement'] = $mnt_paiement;
//            $final_liste_sous_rubrique['total'] = $mnt_engagement - $mnt_paiement;
//
//            array_push($finalListeSousrubrique, $final_liste_sous_rubrique);
//        }
//        array_push($finalListe, $finalListeRubrique, $finalListeSousrubrique);
//
//
//        return $finalListe;
//    }
}
