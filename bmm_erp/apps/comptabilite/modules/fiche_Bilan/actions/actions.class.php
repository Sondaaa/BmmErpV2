<?php

/**
 * fiche_Bilan actions.
 *
 * @package    sw-commerciale
 * @subpackage fiche_Bilan
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fiche_BilanActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
    }

    public function executeChargerPrecedent(sfWebRequest $request) {
        $index = $request->getParameter('index');
        $annee_precedent = $_SESSION['exercice'] - 1;
        $exercice_precedent = ExerciceTable::getInstance()->findOneByLibelle($annee_precedent);
        if ($exercice_precedent) {
            $parametre_ancien = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier($index, $exercice_precedent->getId(), $_SESSION['dossier_id']);
            if ($parametre_ancien->count() != 0) {
                switch ($index) {
                    case 0:
                        foreach ($parametre_ancien as $param_ancien):
                            if($param_ancien->getIdComptedebut() && $param_ancien->getIdComptefin()){
                            $numerocompte_fin = $param_ancien->getPlandossiercomptable()->getNumerocompte();
                            $compte_comtable_nv_fin = PlandossiercomptableTable::getInstance()->findOneByNumerocompteAndIdDossierAndIdExercice($numerocompte_fin, $_SESSION['dossier_id'], $_SESSION['exercice_id']);

                            $numerocompte_debut = $param_ancien->getPlandossiercomptable2()->getNumerocompte();
                            $compte_comtable_nv_debut = PlandossiercomptableTable::getInstance()->findOneByNumerocompteAndIdDossierAndIdExercice($numerocompte_debut, $_SESSION['dossier_id'], $_SESSION['exercice_id']);

                            $parametre_ancien_nouveu_fin = $compte_comtable_nv_fin->getId();
                            $parametre_ancien_nouveu_debut = $compte_comtable_nv_debut->getId();

                            $nouveau_para_bilan = new Parametrebilan();
                            $nouveau_para_bilan->setIdComptedebut($parametre_ancien_nouveu_debut);
                            $nouveau_para_bilan->setIdComptefin($parametre_ancien_nouveu_fin);
                            $nouveau_para_bilan->setType($index);
                            $nouveau_para_bilan->setIdDossier($_SESSION['dossier_id']);
                            $nouveau_para_bilan->setIdExercice($_SESSION['exercice_id']);
                            $nouveau_para_bilan->save();
                           
                            // find list of table paramaeter bilan compte
                            $parameterBilanCompte = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($param_ancien->getId());
                            foreach ($parameterBilanCompte as $parabilan) {
                              
                                $numerocompte_fin = $parabilan->getPlandossiercomptable()->getNumerocompte();
                                $compte_comtable_nv_fin = PlandossiercomptableTable::getInstance()->findOneByNumerocompteAndIdDossierAndIdExercice($numerocompte_fin, $_SESSION['dossier_id'], $_SESSION['exercice_id']);
                                $parametre_ancien_nouveu_fin = $compte_comtable_nv_fin->getId();
//                                

                                $nouveau_para_bilan_compte = new Parametrebilancompte();
                                $nouveau_para_bilan_compte->setIdCompte($parametre_ancien_nouveu_fin);
                                $nouveau_para_bilan_compte->setIdParametrebilan($nouveau_para_bilan->getId());
                                $nouveau_para_bilan_compte->setNote($parabilan->getNote());   
                                $nouveau_para_bilan_compte->setType($parabilan->getType());
                                $nouveau_para_bilan_compte->save();
                                }
                            }else{
                                   $nouveau_para_bilan = new Parametrebilan();
                       
                                    $nouveau_para_bilan->setType($index);
                                    $nouveau_para_bilan->setIdDossier($_SESSION['dossier_id']);
                                    $nouveau_para_bilan->setIdExercice($_SESSION['exercice_id']);
                                    $nouveau_para_bilan->save();
                            }
                        endforeach;
                        $parametre_nouveau = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier($index, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
                        return $this->renderPartial('fiche_Bilan/parametre_actif', array('parametre_actif' => $parametre_nouveau));
                        break;
                    case 1:
                        foreach ($parametre_ancien as $param_ancien):
                            if($param_ancien->getIdComptedebut() && $param_ancien->getIdComptefin()){
                                    $numerocompte_fin = $param_ancien->getPlandossiercomptable()->getNumerocompte();
                            $compte_comtable_nv_fin = PlandossiercomptableTable::getInstance()->findOneByNumerocompteAndIdDossierAndIdExercice($numerocompte_fin, $_SESSION['dossier_id'], $_SESSION['exercice_id']);

                            $numerocompte_debut = $param_ancien->getPlandossiercomptable2()->getNumerocompte();
                            $compte_comtable_nv_debut = PlandossiercomptableTable::getInstance()->findOneByNumerocompteAndIdDossierAndIdExercice($numerocompte_debut, $_SESSION['dossier_id'], $_SESSION['exercice_id']);

                            $parametre_ancien_nouveu_fin = $compte_comtable_nv_fin->getId();
                            $parametre_ancien_nouveu_debut = $compte_comtable_nv_debut->getId();

                            $nouveau_para_bilan = new Parametrebilan();
                            $nouveau_para_bilan->setIdComptedebut($parametre_ancien_nouveu_debut);
                            $nouveau_para_bilan->setIdComptefin($parametre_ancien_nouveu_fin);
                            $nouveau_para_bilan->setType($index);
                            $nouveau_para_bilan->setIdDossier($_SESSION['dossier_id']);
                            $nouveau_para_bilan->setIdExercice($_SESSION['exercice_id']);
                            $nouveau_para_bilan->save();
                           
                            // find list of table paramaeter bilan compte
                            $parameterBilanCompte = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($param_ancien->getId());
                            foreach ($parameterBilanCompte as $parabilan) {
                              
                                $numerocompte_fin = $parabilan->getPlandossiercomptable()->getNumerocompte();
                                $compte_comtable_nv_fin = PlandossiercomptableTable::getInstance()->findOneByNumerocompteAndIdDossierAndIdExercice($numerocompte_fin, $_SESSION['dossier_id'], $_SESSION['exercice_id']);
                                $parametre_ancien_nouveu_fin = $compte_comtable_nv_fin->getId();
//                                

                                $nouveau_para_bilan_compte = new Parametrebilancompte();
                                $nouveau_para_bilan_compte->setIdCompte($parametre_ancien_nouveu_fin);
                                $nouveau_para_bilan_compte->setIdParametrebilan($nouveau_para_bilan->getId());
                                $nouveau_para_bilan_compte->setNote($parabilan->getNote());   
                                $nouveau_para_bilan_compte->setType($parabilan->getType());
                                 $nouveau_para_bilan_compte->setRegrouppement($parabilan->getRegrouppement());
                                $nouveau_para_bilan_compte->save();
                                }
                            }else{
                                   $nouveau_para_bilan = new Parametrebilan();
                       
                                    $nouveau_para_bilan->setType($index);
                                    $nouveau_para_bilan->setIdDossier($_SESSION['dossier_id']);
                                    $nouveau_para_bilan->setIdExercice($_SESSION['exercice_id']);
                                    $nouveau_para_bilan->save();
                            }
                         endforeach;
                        $parametre_nouveau_passif = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier($index, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
                       
                        return $this->renderPartial('fiche_Bilan/parametre_passif', array('parametre_passif' => $parametre_nouveau_passif));
                        break;
                    case 2:
                         foreach ($parametre_ancien as $param_ancien):
                            if($param_ancien->getIdComptedebut() && $param_ancien->getIdComptefin()){
                                    $numerocompte_fin = $param_ancien->getPlandossiercomptable()->getNumerocompte();
                            $compte_comtable_nv_fin = PlandossiercomptableTable::getInstance()->findOneByNumerocompteAndIdDossierAndIdExercice($numerocompte_fin, $_SESSION['dossier_id'], $_SESSION['exercice_id']);

                            $numerocompte_debut = $param_ancien->getPlandossiercomptable2()->getNumerocompte();
                            $compte_comtable_nv_debut = PlandossiercomptableTable::getInstance()->findOneByNumerocompteAndIdDossierAndIdExercice($numerocompte_debut, $_SESSION['dossier_id'], $_SESSION['exercice_id']);

                            $parametre_ancien_nouveu_fin = $compte_comtable_nv_fin->getId();
                            $parametre_ancien_nouveu_debut = $compte_comtable_nv_debut->getId();

                            $nouveau_para_bilan = new Parametrebilan();
                            $nouveau_para_bilan->setIdComptedebut($parametre_ancien_nouveu_debut);
                            $nouveau_para_bilan->setIdComptefin($parametre_ancien_nouveu_fin);
                            $nouveau_para_bilan->setType($index);
                            $nouveau_para_bilan->setIdDossier($_SESSION['dossier_id']);
                            $nouveau_para_bilan->setIdExercice($_SESSION['exercice_id']);
                            $nouveau_para_bilan->save();
                           
                            // find list of table paramaeter bilan compte
                            $parameterBilanCompte = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($param_ancien->getId());
                            foreach ($parameterBilanCompte as $parabilan) {
                              
                                $numerocompte_fin = $parabilan->getPlandossiercomptable()->getNumerocompte();
                                $compte_comtable_nv_fin = PlandossiercomptableTable::getInstance()->findOneByNumerocompteAndIdDossierAndIdExercice($numerocompte_fin, $_SESSION['dossier_id'], $_SESSION['exercice_id']);
                                $parametre_ancien_nouveu_fin = $compte_comtable_nv_fin->getId();
//                                

                                $nouveau_para_bilan_compte = new Parametrebilancompte();
                                $nouveau_para_bilan_compte->setIdCompte($parametre_ancien_nouveu_fin);
                                $nouveau_para_bilan_compte->setIdParametrebilan($nouveau_para_bilan->getId());
                                $nouveau_para_bilan_compte->setNote($parabilan->getNote());   
                                $nouveau_para_bilan_compte->setType($parabilan->getType());
                                $nouveau_para_bilan_compte->save();
                                }
                            }else{
                                   $nouveau_para_bilan = new Parametrebilan();
                       
                                    $nouveau_para_bilan->setType($index);
                                    $nouveau_para_bilan->setIdDossier($_SESSION['dossier_id']);
                                    $nouveau_para_bilan->setIdExercice($_SESSION['exercice_id']);
                                    $nouveau_para_bilan->save();
                            }
                         endforeach;
                        $parametre_nouveau_resultat = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier($index, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
                      
                        return $this->renderPartial('fiche_Bilan/parametre_resultat', array('parametre_resultat' => $parametre_nouveau_resultat));
                        break;
                    case 3:
                        foreach ($parametre_ancien as $param_ancien):
                            if($param_ancien->getIdComptedebut() && $param_ancien->getIdComptefin()){
                                    $numerocompte_fin = $param_ancien->getPlandossiercomptable()->getNumerocompte();
                            $compte_comtable_nv_fin = PlandossiercomptableTable::getInstance()->findOneByNumerocompteAndIdDossierAndIdExercice($numerocompte_fin, $_SESSION['dossier_id'], $_SESSION['exercice_id']);

                            $numerocompte_debut = $param_ancien->getPlandossiercomptable2()->getNumerocompte();
                            $compte_comtable_nv_debut = PlandossiercomptableTable::getInstance()->findOneByNumerocompteAndIdDossierAndIdExercice($numerocompte_debut, $_SESSION['dossier_id'], $_SESSION['exercice_id']);

                            $parametre_ancien_nouveu_fin = $compte_comtable_nv_fin->getId();
                            $parametre_ancien_nouveu_debut = $compte_comtable_nv_debut->getId();

                            $nouveau_para_bilan = new Parametrebilan();
                            $nouveau_para_bilan->setIdComptedebut($parametre_ancien_nouveu_debut);
                            $nouveau_para_bilan->setIdComptefin($parametre_ancien_nouveu_fin);
                            $nouveau_para_bilan->setType($index);
                            $nouveau_para_bilan->setIdDossier($_SESSION['dossier_id']);
                            $nouveau_para_bilan->setIdExercice($_SESSION['exercice_id']);
                            $nouveau_para_bilan->save();
                           
                            // find list of table paramaeter bilan compte
                            $parameterBilanCompte = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($param_ancien->getId());
                            foreach ($parameterBilanCompte as $parabilan) {
                              
                                $numerocompte_fin = $parabilan->getPlandossiercomptable()->getNumerocompte();
                                $compte_comtable_nv_fin = PlandossiercomptableTable::getInstance()->findOneByNumerocompteAndIdDossierAndIdExercice($numerocompte_fin, $_SESSION['dossier_id'], $_SESSION['exercice_id']);
                                $parametre_ancien_nouveu_fin = $compte_comtable_nv_fin->getId();
//                                

                                $nouveau_para_bilan_compte = new Parametrebilancompte();
                                $nouveau_para_bilan_compte->setIdCompte($parametre_ancien_nouveu_fin);
                                $nouveau_para_bilan_compte->setIdParametrebilan($nouveau_para_bilan->getId());
                                $nouveau_para_bilan_compte->setNote($parabilan->getNote());   
                                $nouveau_para_bilan_compte->setType($parabilan->getType());
                                $nouveau_para_bilan_compte->save();
                                }
                            }else{
                                   $nouveau_para_bilan = new Parametrebilan();
                       
                                    $nouveau_para_bilan->setType($index);
                                    $nouveau_para_bilan->setIdDossier($_SESSION['dossier_id']);
                                    $nouveau_para_bilan->setIdExercice($_SESSION['exercice_id']);
                                    $nouveau_para_bilan->save();
                            }
                         endforeach;
                        $parametre_nouveau_flux = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier($index, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
                        return $this->renderPartial('fiche_Bilan/parametre_flux', array('parametre_flux' => $parametre_nouveau_flux));
                        break;
                    case 4:
                          foreach ($parametre_ancien as $param_ancien):
                            if($param_ancien->getIdComptedebut() && $param_ancien->getIdComptefin()){
                                    $numerocompte_fin = $param_ancien->getPlandossiercomptable()->getNumerocompte();
                            $compte_comtable_nv_fin = PlandossiercomptableTable::getInstance()->findOneByNumerocompteAndIdDossierAndIdExercice($numerocompte_fin, $_SESSION['dossier_id'], $_SESSION['exercice_id']);

                            $numerocompte_debut = $param_ancien->getPlandossiercomptable2()->getNumerocompte();
                            $compte_comtable_nv_debut = PlandossiercomptableTable::getInstance()->findOneByNumerocompteAndIdDossierAndIdExercice($numerocompte_debut, $_SESSION['dossier_id'], $_SESSION['exercice_id']);

                            $parametre_ancien_nouveu_fin = $compte_comtable_nv_fin->getId();
                            $parametre_ancien_nouveu_debut = $compte_comtable_nv_debut->getId();

                            $nouveau_para_bilan = new Parametrebilan();
                            $nouveau_para_bilan->setIdComptedebut($parametre_ancien_nouveu_debut);
                            $nouveau_para_bilan->setIdComptefin($parametre_ancien_nouveu_fin);
                            $nouveau_para_bilan->setType($index);
                            $nouveau_para_bilan->setIdDossier($_SESSION['dossier_id']);
                            $nouveau_para_bilan->setIdExercice($_SESSION['exercice_id']);
                            $nouveau_para_bilan->save();
                           
                            // find list of table paramaeter bilan compte
                            $parameterBilanCompte = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($param_ancien->getId());
                            foreach ($parameterBilanCompte as $parabilan) {
                              
                                $numerocompte_fin = $parabilan->getPlandossiercomptable()->getNumerocompte();
                                $compte_comtable_nv_fin = PlandossiercomptableTable::getInstance()->findOneByNumerocompteAndIdDossierAndIdExercice($numerocompte_fin, $_SESSION['dossier_id'], $_SESSION['exercice_id']);
                                $parametre_ancien_nouveu_fin = $compte_comtable_nv_fin->getId();
//                                

                                $nouveau_para_bilan_compte = new Parametrebilancompte();
                                $nouveau_para_bilan_compte->setIdCompte($parametre_ancien_nouveu_fin);
                                $nouveau_para_bilan_compte->setIdParametrebilan($nouveau_para_bilan->getId());
                                $nouveau_para_bilan_compte->setNote($parabilan->getNote());   
                                $nouveau_para_bilan_compte->setType($parabilan->getType());
                                $nouveau_para_bilan_compte->save();
                                }
                            }else{
                                   $nouveau_para_bilan = new Parametrebilan();
                       
                                    $nouveau_para_bilan->setType($index);
                                    $nouveau_para_bilan->setIdDossier($_SESSION['dossier_id']);
                                    $nouveau_para_bilan->setIdExercice($_SESSION['exercice_id']);
                                    $nouveau_para_bilan->save();
                            }
                         endforeach;
                        $parametre_nouveau_sig = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier($index, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
                      
                        return $this->renderPartial('fiche_Bilan/parametre_sig', array('parametre_sig' => $parametre_nouveau_sig));
                        break;
                }
            } else {
                die("0");
            }
        } else {
            die("0");
        }
    }

    public function executeChargerPrecedentGeneral(sfWebRequest $request) {
        $index = $request->getParameter('index');
        $annee_precedent = $_SESSION['exercice'] - 1;
        $exercice_precedent = ExerciceTable::getInstance()->findByLibelle($annee_precedent);
        $dossierexercice = DossierexerciceTable::getInstance()->getIdExercice($_SESSION['dossier_id'], $annee_precedent);
//        die($dossierexercice->getFirst()->getIdExercice().'id');
        if ($exercice_precedent) {
            $parametre_ancien = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier($index, $dossierexercice->getFirst()->getIdExercice(), $_SESSION['dossier_id']);
            if ($parametre_ancien->count() != 0) {
                switch ($index) {
                    case 0:
                        return $this->renderPartial('fiche_Bilan/parametre_actif_general', array('parametre_actif' => $parametre_ancien));
                        break;
                    case 1:
                        return $this->renderPartial('fiche_Bilan/passif_general', array('parametre_passif' => $parametre_ancien));
                        break;
                    case 2:
                        return $this->renderPartial('fiche_Bilan/resultat_general', array('parametre_resultat' => $parametre_ancien));
                        break;
                    case 3:
                        return $this->renderPartial('fiche_Bilan/parametre_flux', array('parametre_flux' => $parametre_ancien));
                        break;
                    case 4:
                        return $this->renderPartial('fiche_Bilan/parametre_sigComercial', array('parametre_sig' => $parametre_ancien));
                        break;
                }
            } else {
                die("0");
            }
        } else {
            die("0");
        }
    }

    public function executeParametre(sfWebRequest $request) {
        $this->parametre_actif = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(0, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
        $this->parametre_passif = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(1, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
        $this->parametre_resultat = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(2, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
        $this->parametre_flux = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(3, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
        $this->parametre_sig = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(4, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
//        $this->parametre_note = ParametreNoteFinancierTable::getInstance()->findAll()->getFirst();
        $this->parametre_note = null;

//         $this->actif = calculParametrebilan::getBilan(0);
//        $this->passif = calculParametrebilan::getBilan(1);
    }

    public function executeSaveParametreTypeCompte(sfWebRequest $request) {
        $compte_id = $request->getParameter('compte_id');
        $type_compte_id = $request->getParameter('type_compte_id');

        $type_bilan = new Typecomptebilan();
        $type_bilan->setIdCompte($compte_id);
        $type_bilan->setIdTypecompte($type_compte_id);
        $type_bilan->setIdExercice($_SESSION['exercice_id']);
        $type_bilan->setIdDossier($_SESSION['dossier_id']);

        $type_bilan->save();

        $pager = $this->paginate($request);
        $page = $request->getParameter('page', 1);
        return $this->renderPartial('fiche_Bilan/liste_bilan', array('pager' => $pager, 'page' => $page));
    }

    public function executeGoPageParametreTypeCompte(sfWebRequest $request) {
        $pager = $this->paginate($request);
        $page = $request->getParameter('page', 1);
        return $this->renderPartial('fiche_Bilan/liste_bilan', array('pager' => $pager, 'page' => $page));
    }

    public function executeDeleteParametreTypeCompte(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $bilan = TypecomptebilanTable::getInstance()->find($id);
        $bilan->delete();
        $pager = $this->paginate($request);
        $page = $request->getParameter('page', 1);
        return $this->renderPartial('fiche_Bilan/liste_bilan', array('pager' => $pager, 'page' => $page));
    }

    public function executeVerifierExistanceBilan(sfWebRequest $request) {
        $bilan = TypecomptebilanTable::getInstance()->findByIdCompteAndIdExerciceAndIdDossier($request->getParameter('compte_id'), $_SESSION['exercice_id'], $_SESSION['dossier_id']);
        return $this->renderText($bilan->count());
    }

    public function paginate(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $compte = $request->getParameter('compte', '');
        $type = $request->getParameter('type', '');

        $pager = new sfDoctrinePager('Typecomptebilan', 10);
        $pager->setQuery(TypecomptebilanTable::getInstance()->loadAll($_SESSION['exercice_id'], $compte, $type));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeSaveParametreBilan(sfWebRequest $request) {
        $type = $request->getParameter('type');
        $compte_debut = $request->getParameter('compte_debut');
        $compte_fin = $request->getParameter('compte_fin');
        $note = $request->getParameter('note');
        $comptes_decoche = $request->getParameter('comptes_decoche');
        $comptes_coche = $request->getParameter('comptes_coche');
        $comptes_regroupe = $request->getParameter('compte_regroupe');
        $array_regr = $request->getParameter('array_regr');
        $groupe_array = explode('*****', $array_regr);

        $parametres = ParametrebilanTable::getInstance()->findByTypeAndIdExercice($type, $_SESSION['exercice_id']);
        foreach ($parametres as $parametre) {
            $parametresCompte = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre->getId());
            foreach ($parametresCompte as $pc) {
                $pc->delete();
            }

            $parametre->delete();
        }
        $compte_debut = substr($compte_debut, 1);
        $compte_fin = substr($compte_fin, 1);
        $note = substr($note, 1);
        $comptes_decoche = substr($comptes_decoche, 1);
        $comptes_coche = substr($comptes_coche, 1);
        $compte_debut = explode(';', $compte_debut);
        $compte_fin = explode(';', $compte_fin);
        $note = explode(';', $note);
        $comptes_decoche = explode(';', $comptes_decoche);
        $comptes_coche = explode(';', $comptes_coche);
        $comptes_regroupe = explode(';', $comptes_regroupe);
        for ($i = 0; $i < sizeof($compte_debut); $i++) {
            $param = new Parametrebilan();
            $param->setNote($note[$i]);
            $param->setType($type);
            if ($compte_debut[$i] != '')
                $param->setIdComptedebut($compte_debut[$i]);
            if ($compte_fin[$i] != '')
                $param->setIdComptefin($compte_fin[$i]);

            $param->setIdExercice($_SESSION['exercice_id']);
            $param->setIdDossier($_SESSION['dossier_id']);

            $param->save();
            $s = 1;
//            $comptes_regroupe_first = explode(',', $comptes_regroupe[$s]);

            $s++;

            if ($compte_debut[$i] != '') {
                $k = $i - 1;
                $comptes_first = explode(',', $comptes_coche[$i]);


                for ($j = 0; $j < sizeof($comptes_first); $j++) {

                    if ($comptes_first[$j] != '') {

                        $paramCompte = new Parametrebilancompte();
                        $paramCompte->setNote('ligne_' . $k);
                        $paramCompte->setType(1);
                        $paramCompte->setIdCompte($comptes_first[$j]);
                        $paramCompte->setIdParametrebilan($param->getId());
                        $paramCompte->save();
                    }
                }
                $comptes_seconde = explode(',', $comptes_decoche[$i]);
                for ($j = 0; $j < sizeof($comptes_seconde); $j++) {
                    if ($comptes_seconde[$j] != '') {
                        $paramCompte = new Parametrebilancompte();
                        $paramCompte->setNote('ligne_' . $k);
                        $paramCompte->setType(0);
                        $paramCompte->setIdCompte($comptes_seconde[$j]);
                        $paramCompte->setIdParametrebilan($param->getId());

                        $paramCompte->save();
                    }
                }
            }
        }
        $this->setRegroupementInCompte($groupe_array);
        return true;
    }

    public function setRegroupementInCompte($groupe_array) {
        //die('h'.$compte_id);
        $parametrecomptes = ParametrebilancompteTable::getInstance()->findAll();
        foreach ($parametrecomptes as $param_compte) {
            //die($param_compte->getIdCompte().'hh');
            if ($groupe_array != '')
                for ($i = 0; $i <= sizeof($groupe_array); $i++) {
                    $reg = split('-----', $groupe_array[$i]);
                    $chaine = $reg[1];
                    $array_compte = split(',', $reg[0]);
                    for ($j = 0; $j < sizeof($array_compte); $j++) {
                        if ($param_compte->getIdCompte() == $array_compte[$j]) {
                            $param_compte->setRegrouppement($chaine);
//                             die($chaine);
                            $param_compte->save();
//                            die($chaine);
//                            die($param_compte->getId());
                        }
                    }
                }
        }
    }

    public function executeSaveNote(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $content = $params['content'];

            $param = ParametrenoteTable::getInstance()->findOneByIdDossier($_SESSION['dossier_id']);
            $content = str_replace(" ", "&nbsp;", $content);
            if ($param != null) {
                //Rien à faire
            } else {
                $param = new Parametrenote();
            }
            $param->setContenue($content);
            $param->setIdDossier($_SESSION['dossier_id']);
            $param->save();
        }
        die('ajout avec succe');
    }

    public function executeParametreEtat(sfWebRequest $request) {
        $this->parametre_actif = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(0, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
        $this->parametre_passif = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(1, $_SESSION['exercice_id'], $_SESSION['dossier_id']);

        $this->actif = calculParametrebilan::getBilan(0);
        $this->passif = calculParametrebilan::getBilan(1);
    }

    public function executeEtatNote(sfWebRequest $request) {
        $this->parametre_actif = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(0, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
        $this->parametre_passif = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(1, $_SESSION['exercice_id'], $_SESSION['dossier_id']);

        $this->actif = calculParametrebilan::getBilan(0);
        $this->passif = calculParametrebilan::getBilan(1);
        $this->resultat = calculParametrebilan::getBilan(2);
//        $exercice_prec = $_SESSION['exercice'] - 1;
////        die(sizeof($exercice_prececedent) . 'exe');
//        $this->exercice_prec = $exercice_prec;
//        $exercice_prececedent = ExerciceTable::getInstance()->findOneByLibelle($exercice_prec);
//        if (count($exercice_prececedent) > 1) 
//            $id_exercice_prec = $exercice_prececedent->getId();
////        if (sizeof($exercice_prececedent) > 1)
//        $actif = calculParametrebilan::getBilan(0);
//         $this->actif = calculParametrebilan::getBilan(0);
////         die($actif[0][1]['param_id'].'hh');
////            $this->actif = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(0, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
//        if (sizeof($exercice_prececedent) > 1)
//            $this->actif_ancien = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(0, $id_exercice_prec, $_SESSION['dossier_id']);
//
//        $this->passif = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(1, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
//        $this->resultat = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(2, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
        $this->flux = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(3, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
        $this->param = ParametrenoteTable::getInstance()->findByIdDossier($_SESSION['dossier_id'])->getFirst();

        $this->solde_actif = calculParametrebilan::getBilan(0);
        $this->solde_passif = calculParametrebilan::getBilan(1);
        $this->solde_resultat = calculParametrebilan::getBilan(2);
        $this->solde_flux = calculParametrebilan::getBilan(3);
    }

    public function executeSaveParametreEtatBilan(sfWebRequest $request) {
        $type = $request->getParameter('type');
        $compte_debut = $request->getParameter('compte_debut');
        $compte_fin = $request->getParameter('compte_fin');
        $note = $request->getParameter('note');

        $parametres = ParametrebilanTable::getInstance()->findByType($type);
        foreach ($parametres as $parametre) {
            $parametre->delete();
        }

        $compte_debut = explode(';', $compte_debut);
        $compte_fin = explode(';', $compte_fin);
        $note = explode(';', $note);

        for ($i = 0; $i < sizeof($compte_debut); $i++) {

            if ($compte_debut[$i] != '') {
                $param = new Parametrebilan();
                $param->setNote($note[$i]);
                $param->setType($type);
                $param->setIdComptedebut($compte_debut[$i]);
                $param->setIdComptefin($compte_fin[$i]);
                $param->setIdExercice($_SESSION['exercice_id']);
                $param->setIdDossier($_SESSION['dossier_id']);

                $param->save();
            }
        }
        return true;
    }

    public function executeRegroupercompte(sfWebRequest $request) {
        $ids = split(',', $request->getParameter('arrayid'));
        $next_lettre = $request->getParameter('libelle');

        for ($i = 0; $i < count($ids); $i++) {
           
            $fiche = Doctrine_Core::getTable('parametrebilancompte')->findOneByIdCompte($ids[$i]);
            $fiche->setIdCompte($ids[$i]);
            $fiche->setRegrouppement($next_lettre);
           $fiche->save();
        }

        die(json_encode($ids));
    }

    public function executeGererComptesParametreBilan(sfWebRequest $request) {
        $compte_min = $request->getParameter('compte_debut');
        $compte_max = $request->getParameter('compte_fin');
        $parametre_id = $request->getParameter('parametre_id', '');
        $index = $request->getParameter('index');
        if ($parametre_id != '')
            $comptes = PlandossiercomptableTable::getInstance()->loadByParametreId($parametre_id);
        else {
            $dossier_id = $_SESSION['dossier_id'];
            $comptes = PlandossiercomptableTable::getInstance()->loadByInterval($compte_min, $compte_max, $dossier_id, $_SESSION['exercice_id']);
        }
        return $this->renderPartial("list_comptes", array("comptes" => $comptes, "index" => $index, "parametre_id" => $parametre_id, "compte_min" => $compte_min, "compte_max" => $compte_max));
    }

    public function executeGererOneComptesParametreBilan(sfWebRequest $request) {
        $params = array();
        $content = $request->getContent();
        $params = json_decode($content, true);
        $compte_min = $params['compte_debut'];
        $compte_max = $params['compte_fin'];
        $parametre_id = $params['parametre_id'];
        $index = $params['index'];
      //  die($compte_min.'**'.$compte_max);
//        $compte_min = $request->getParameter('compte_debut');
//        $compte_max = $request->getParameter('compte_fin');
//        $parametre_id = $request->getParameter('parametre_id', '');
//        $index = $request->getParameter('index');
        if ($parametre_id != '')
            $comptes = PlandossiercomptableTable::getInstance()->loadByParametreId($parametre_id);
        else {
            $dossier_id = $_SESSION['dossier_id'];
            $comptes = PlandossiercomptableTable::getInstance()->loadByInterval($compte_min, $compte_max, $dossier_id, $_SESSION['exercice_id']);
        }
        return $this->renderPartial("list_one_comptes", array("comptes" => $comptes, "index" => $index, "parametre_id" => $parametre_id, "compte_min" => $compte_min, "compte_max" => $compte_max));
//        
//        $this->getResponse()->setContentType('text/json');
//       
//        return $this->renderText(json_encode(array(
//                    "html" => "ok"
//        )));
    }

    public function executeRechargerComptesParametreBilan(sfWebRequest $request) {
        $compte_min = $request->getParameter('compte_debut');
        $compte_max = $request->getParameter('compte_fin');
        $parametre_id = $request->getParameter('parametre_id', '');
        $index = $request->getParameter('index');
        $dossier_id = $_SESSION['dossier_id'];
        $action = null;
        $comptes = PlandossiercomptableTable::getInstance()->loadByInterval($compte_min, $compte_max, $dossier_id, $_SESSION['exercice_id']);
        if ($request->getParameter('actiondetail') && $request->getParameter('actiondetail') == "R") {
            $action = $request->getParameter('actiondetail');
            return $this->renderPartial("liste_compte_recharge_regroupe", array("action" => $action, "comptes" => $comptes, "index" => $index, "parametre_id" => $parametre_id, "compte_min" => $compte_min, "compte_max" => $compte_max));
        } else {
            return $this->renderPartial("list_comptes_recharge", array("action" => $action, "comptes" => $comptes, "index" => $index, "parametre_id" => $parametre_id, "compte_min" => $compte_min, "compte_max" => $compte_max));
        }
    }

    public function executeGererComptesRegroupementParametreBilan(sfWebRequest $request) {
        $compte_min = $request->getParameter('compte_debut');
        $compte_max = $request->getParameter('compte_fin');
        $parametre_id = $request->getParameter('parametre_id', '');
        $index = $request->getParameter('index');
        if ($parametre_id != '')
            $comptes = PlandossiercomptableTable::getInstance()->loadByParametreId($parametre_id);
        else {
            $dossier_id = $_SESSION['dossier_id'];
            $comptes = PlandossiercomptableTable::getInstance()->loadByInterval($compte_min, $compte_max, $dossier_id, $_SESSION['exercice_id']);
        }
        return $this->renderPartial("list_comptes_regroupe", array("comptes" => $comptes, "index" => $index, "parametre_id" => $parametre_id, "compte_min" => $compte_min, "compte_max" => $compte_max));
    }

    public function executeEtatResultat(sfWebRequest $request) {
        $this->parametre_resultat = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(2, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
        $type = 2;
        $this->resultat = calculParametrebilan::getBilan($type);
        $this->passif = calculParametrebilan::getBilan(1);
    }

    public function executeEtatResultatgeneral(sfWebRequest $request) {
        $this->parametre_resultat = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(2, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
        $type = 2;
        $this->resultat = calculParametrebilan::getBilan($type);
        $this->passif = calculParametrebilan::getBilan(1);
    }

    public function executeEtatFlux(sfWebRequest $request) {
        $this->parametre_flux = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(3, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
        $type = 3;
        $this->flux = calculParametrebilan::getBilan($type);
    }

    public function executeEtatSig(sfWebRequest $request) {
        $this->parametre_sig = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(4, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
        $type = 4;
        $this->sig = calculParametrebilan::getBilan($type);
        $this->resultat = calculParametrebilan::getBilan(2);
    }

    public function executeImprimerBilan(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Etat Bilan');
        $pdf->SetSubject("Etat Bilan");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
         $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
       $soc = $societe;
        $entete =  $soc->getMinistere();
        $rs=$soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
//        $pdf->SetMargins(10, 30, 10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 10);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
       $pdf->SetPrintHeader(true);
        $pdf->SetPrintFooter(true);
         $pdf->SetMargins(5, 30, 5);
        $pdf->AddPage();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
          $pdf->SetMargins(5, 10, 5);
        $html = $this->ReadHtmlBilan($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Etat Bilan.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBilan(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $etat = new Parametrebilan();
        switch ($request->getParameter('type')) {
            case 0:
                $html .= $etat->ReadHtmlBilanActif();
                break;
            case 1:
                if ($_SESSION['dossier_id'] == 1):
                    $html .= $etat->ReadHtmlBilanPassif();
                else:
                    $html .= $etat->ReadHtmlBilanPassifgeneral();
                endif;
                break;
            case 2:

                if ($_SESSION['dossier_id'] == 1):
                    $html .= $etat->ReadHtmlBilanResultat();
                else:
                    $html .= $etat->ReadHtmlBilanResultatGeneral();
                endif;
                break;
            case 3:
                $html .= $etat->ReadHtmlBilanFlux();
                break;
            case 4:
                if ($_SESSION['dossier_id'] == 1):
                    $html .= $etat->ReadHtmlBilanSig();
                else:
                    $html .= $etat->ReadHtmlBilanSigGeneral();
                endif;

                break;
        }

        return $html;
    }

    public function executeImprimerParametreBilan(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Etat Bilan');
        $pdf->SetSubject("Etat Bilan");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
       $soc = $societe;
        $entete =  $soc->getMinistere();
        $rs=$soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
//        $pdf->SetMargins(10, 30, 10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);

        // set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 2);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
         $pdf->SetPrintHeader(true);
        $pdf->SetPrintFooter(true);
         $pdf->SetMargins(5, 30, 5);
        $pdf->AddPage();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
          $pdf->SetMargins(5, 10, 5);
        $html = $this->ReadHtmlParametreBilan($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Etat Bilan.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlParametreBilan(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $etat = new Parametrebilan();
        switch ($request->getParameter('type')) {
            case 0:
                $html .= $etat->ReadHtmlParametreBilanActif();
                break;
            case 1:
                if ($_SESSION['dossier_id'] == 1):
                    $html .= $etat->ReadHtmlParametreBilanPassif();
                else:
                    $html .= $etat->ReadHtmlParametreBilanPassifGeneral();
                endif;
                break;
            case 2:
                $html .= $etat->ReadHtmlParametreBilanResultat();
                break;
            case 3:
                $html .= $etat->ReadHtmlParametreBilanFlux();
                break;
            case 4:
                if ($_SESSION['dossier_id'] == 1):
                    $html .= $etat->ReadHtmlParametreBilanSig();
                else:
                    $html .= $etat->ReadHtmlParametreBilanSiggenerale();
                endif;
                break;
        }

        return $html;
    }

    /*     * passif general */

    public function executeImprimerParametreBilanGeneral(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Etat Bilan');
        $pdf->SetSubject("Etat Bilan");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
       $soc = $societe;
        $entete =  $soc->getMinistere();
        $rs=$soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(10, 30, 10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);

        // set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 2);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlParametreBilanGeneral($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Etat Bilan.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlParametreBilanGeneral(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $etat = new Parametrebilan();
        switch ($request->getParameter('type')) {
            case 0:
                $html .= $etat->ReadHtmlParametreBilanActif();
                break;
            case 1:
                $html .= $etat->ReadHtmlParametreBilanPassifGeneral();

                break;
            case 2:
                $html .= $etat->ReadHtmlParametreBilanResultatGeneral();
                break;
            case 3:
                $html .= $etat->ReadHtmlParametreBilanFlux();
                break;
            case 4:
                $html .= $etat->ReadHtmlParametreBilanSiggenerale();
                break;
        }

        return $html;
    }

    public function executeImprimerParametreNote(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('NOTES AUX ETATS FINANCIERS');
        $pdf->SetSubject("NOTES AUX ETATS FINANCIERS");

        // set header and footer fonts
        $pdf->setPrintHeader(false);
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
//        $pdf->SetMargins(10, 10, 10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);

        // set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 2);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->SetPrintHeader(true);
        $pdf->SetPrintFooter(true);
         $pdf->SetMargins(5, 30, 5);
        $pdf->AddPage();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
          $pdf->SetMargins(5, 10, 5);
        $html = $this->ReadHtmlParametreNote($request);
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('NOTES AUX ETATS FINANCIERS.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlParametreNote(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $etat = new Parametrebilan();
        $html .= $etat->ReadHtmlParametreNote();

        return $html;
    }

    /*
     * Save regroupement
     */

    public function executeSaveRegroupement(sfWebRequest $request) {
        $ids = split(',', $request->getParameter('arrayid'));
        $next_lettre = $request->getParameter('libelle');

        for ($i = 0; $i < count($ids); $i++) {
            $fiche = new Parametrebilancompte();
            $fiche->setIdCompte($ids[$i]);
            $fiche->setRegrouppement($next_lettre);
            $fiche->save();
        }

        die(json_encode($ids));
    }

//    public function executeImprimerNote(sfWebRequest $request) {
//        $this->param = ParametrenoteTable::getInstance()->findByIdDossier($_SESSION['dossier_id'])->getFirst();
//    }
    public function executeImprimerNote(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Etat Note');
        $pdf->SetSubject("Etat Note");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
         $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
       $soc = $societe;
        $entete =  $soc->getMinistere();
        $rs=$soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
//        $pdf->SetMargins(10, 30, 10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 10);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
       $pdf->SetPrintHeader(true);
        $pdf->SetPrintFooter(true);
         $pdf->SetMargins(5, 30, 5);
        $pdf->AddPage();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
          $pdf->SetMargins(5, 10, 5);
        $html = $this->ReadHtmlEtatNotes($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Etat Note.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlEtatNotes(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $etat = new Parametrebilan();
        $html .= $etat->ReadHtmlParametreNote();
        return $html;
    }

}
