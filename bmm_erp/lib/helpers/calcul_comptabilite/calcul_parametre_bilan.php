<?php

class calculParametreBilan {

    public static function getBilan($type) {

        $parametres = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier($type, $_SESSION['exercice_id'], $_SESSION['dossier_id']);

        $finalBilan = array();
        $finalBilanCour = array();
        $finalBilanPrec = array();
        $annee_prec = $_SESSION['exercice'] - 1;
        $exercice_precedent = ExerciceTable::getInstance()->findOneByLibelle($annee_prec);
        if ($exercice_precedent) {
            $parametres_prec = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier($type, $exercice_precedent->getId(), $_SESSION['dossier_id']);
        }
        if ($parametres->count() > 0) {
            $index = 0;
            foreach ($parametres as $param) {
                $solde_annee_courant = 0;
                $solde_annee_prec = 0;
                $exercice_precedent = ExerciceTable::getInstance()->findOneByLibelle($annee_prec);
                if ($exercice_precedent)
                    $solde_annee_prec = ParametrebilancompteTable::getInstance()->calculSoldeParametreBilanPrec($param->getId(), $exercice_precedent->getId())->getSolde();
//               die($solde_annee_prec . 'soldecourant');
                $annee_courant = $_SESSION['exercice'];
                $exercice_courant = ExerciceTable::getInstance()->findOneByLibelle($annee_courant);
                if ($exercice_courant)
                    $solde_annee_courant = ParametrebilancompteTable::getInstance()->calculSoldeParametreBilan($param->getId(), $_SESSION['exercice_id'])->getSolde();

                $final_bilan = array();
                $final_bilan['param_id'] = $param->getId();
                $final_bilan['solde_courant'] = $solde_annee_courant;

                $final_bilan['solde_prec'] = $solde_annee_prec;
                array_push($finalBilanCour, $final_bilan);
                $index++;
            }
        }
//        else {
//            $final_bilan = array();
//            $final_bilan['param_id'] = '';
//            $final_bilan['solde_courant'] = 0;
//            $final_bilan['solde_prec'] = 0;
//            array_push($finalBilan, $final_bilan);
//        }
        if ($exercice_precedent) {
            if ($parametres_prec->count() > 0) {
                $index = 0;
//            $final_bilan = array();
//            $final_bilan['param_id'] = '';
//            $final_bilan['solde_courant'] = 0;
                foreach ($parametres_prec as $param) {
                    $solde_annee_prec = 0;
                    $solde_annee_courant = 0;
                    $exercice_precedent = ExerciceTable::getInstance()->findOneByLibelle($annee_prec);
                    if ($exercice_precedent)
                        $solde_annee_prec = ParametrebilancompteTable::getInstance()->calculSoldeParametreBilan($param->getId(), $exercice_precedent->getId())->getSolde();
                    $annee_courant = $_SESSION['exercice'];
                    $exercice_courant = ExerciceTable::getInstance()->findOneByLibelle($annee_courant);
                    if ($exercice_courant)
                        $solde_annee_courant = ParametrebilancompteTable::getInstance()->calculSoldeParametreBilan($param->getId(), $_SESSION['exercice_id'])->getSolde();
//                    die($solde_annee_prec . 'soldecourant');
                    $final_bilan_prec = array();
                    $final_bilan_prec['param_id'] = $param->getId();
                    $final_bilan_prec['solde_courant'] = $solde_annee_courant;
                    $final_bilan_prec['solde_prec'] = $solde_annee_prec;
                    array_push($finalBilanPrec, $final_bilan_prec);
                    $index++;

//                $final_bilan['param_id'] = $param->getId();
//                $final_bilan['solde_prec'] = $solde_annee_prec;
//                $index++;
                }
//            $final_bilan['solde_prec'] = $solde_annee_prec;

                array_push($finalBilanPrec, $finalBilanPrec);
            }
        }
        array_push($finalBilan, $finalBilanPrec, $finalBilanCour);

        return $finalBilan;
    }
   public static function getBilan2($type) {

//        $parametres = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier($type, $_SESSION['exercice_id'], $_SESSION['dossier_id']);

        $finalBilan = array();
//        $finalBilanCour = array();
        $finalBilanPrec = array();
        $annee_prec = $_SESSION['exercice'] - 1;
        $exercice_precedent = ExerciceTable::getInstance()->findOneByLibelle($annee_prec);
        if ($exercice_precedent) {
            $parametres_prec = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier($type, $exercice_precedent->getId(), $_SESSION['dossier_id']);
        }
//        if ($parametres->count() > 0) {
//            $index = 0;
//            foreach ($parametres as $param) {
//                $solde_annee_courant = 0;
//                $solde_annee_prec = 0;
//                $exercice_precedent = ExerciceTable::getInstance()->findOneByLibelle($annee_prec);
//                if ($exercice_precedent)
//                    $solde_annee_prec = ParametrebilancompteTable::getInstance()->calculSoldeParametreBilanPrec($param->getId(), $exercice_precedent->getId())->getSolde();
////               die($solde_annee_prec . 'soldecourant');
//                $annee_courant = $_SESSION['exercice'];
//                $exercice_courant = ExerciceTable::getInstance()->findOneByLibelle($annee_courant);
//                if ($exercice_courant)
//                    $solde_annee_courant = ParametrebilancompteTable::getInstance()->calculSoldeParametreBilan($param->getId(), $_SESSION['exercice_id'])->getSolde();
//
//                $final_bilan = array();
//                $final_bilan['param_id'] = $param->getId();
//                $final_bilan['solde_courant'] = $solde_annee_courant;
//
//                $final_bilan['solde_prec'] = $solde_annee_prec;
//                array_push($finalBilanCour, $final_bilan);
//                $index++;
//            }
//        }
//        else {
//            $final_bilan = array();
//            $final_bilan['param_id'] = '';
//            $final_bilan['solde_courant'] = 0;
//            $final_bilan['solde_prec'] = 0;
//            array_push($finalBilan, $final_bilan);
//        }
        if ($exercice_precedent) {
            if ($parametres_prec->count() > 0) {
                $index = 0;
//            $final_bilan = array();
//            $final_bilan['param_id'] = '';
//            $final_bilan['solde_courant'] = 0;
                foreach ($parametres_prec as $param) {
                    $solde_annee_prec = 0;
                    $solde_annee_courant = 0;
                    $exercice_precedent = ExerciceTable::getInstance()->findOneByLibelle($annee_prec);
                    if ($exercice_precedent)
                        $solde_annee_prec = ParametrebilancompteTable::getInstance()->calculSoldeParametreBilan($param->getId(), $exercice_precedent->getId())->getSolde();
                    $annee_courant = $_SESSION['exercice'];
                    $exercice_courant = ExerciceTable::getInstance()->findOneByLibelle($annee_courant);
                    if ($exercice_courant)
                        $solde_annee_courant = ParametrebilancompteTable::getInstance()->calculSoldeParametreBilan($param->getId(), $_SESSION['exercice_id'])->getSolde();
//                    die($solde_annee_prec . 'soldecourant');
                    $final_bilan_prec = array();
                    $final_bilan_prec['param_id'] = '';
                    $final_bilan_prec['solde_courant'] = $solde_annee_courant;
                    $final_bilan_prec['solde_prec'] = $solde_annee_prec;
                    array_push($finalBilanPrec, $final_bilan_prec);
                    $index++;

//                $final_bilan['param_id'] = $param->getId();
//                $final_bilan['solde_prec'] = $solde_annee_prec;
//                $index++;
                }
//            $final_bilan['solde_prec'] = $solde_annee_prec;

//                array_push($finalBilanPrec, $finalBilanPrec);
            }
        }
//        array_push($finalBilan, $finalBilanPrec, $finalBilanCour);
        array_push($finalBilan, $finalBilanPrec);

        return $finalBilan;
    }

    
}

?>
