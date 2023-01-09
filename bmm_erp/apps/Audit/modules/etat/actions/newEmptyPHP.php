<?php

/**
 * etat actions.
 *
 * @package    sw-commerciale
 * @subpackage etat
 * @author     Your name here
 * @version  imprimeEtatJournal  SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class etatActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeGetSerieJournal(sfWebRequest $request) {
        $journal = $request->getParameter('journal');
        $id = $request->getParameter('id_compte');
        $date = $request->getParameter('date');
        $serie = NumeroseriejournalTable::getInstance()->getSerie($journal, $date)->getFirst();

        $tab = array();
        $tab['serie'] = $serie->getPrefixe();
        $tab['valide'] = $serie->getIsvalide();
        $tab['bloque'] = $serie->getIsbloque();
        $tab['serie_id'] = $serie->getId();
        $tab['numero'] = str_replace(' ', '', $serie->getPrefixe()) . sprintf("%03s", $serie->getAttendu());
        $tab['attendu'] = sprintf("%03s", $serie->getAttendu());

        return $this->renderText(json_encode($tab));
    }

    public function executeShowEdit(sfWebRequest $request) {
        $this->piece = PiececomptableTable::getInstance()->find($request->getParameter('id'));
    }

     public function executeValiderPieceExtraitcompte(sfWebRequest $request) {
        $journal = $request->getParameter('journal');
        $date = $request->getParameter('date');
        $serie = $request->getParameter('serie');
        $numero = $request->getParameter('numero');
        $libelle_piece = $request->getParameter('libelle_piece');
        $total_debit = $request->getParameter('total_debit');
        $total_credit = $request->getParameter('total_credit');
        $piece_id = $request->getParameter('piece_id');
        $re_journal = $request->getParameter('re_journal');
        $numero_compte = $request->getParameter('numero_compte');
        $ligne_contre = $request->getParameter('ligne_contre');
        $ligne_debit = $request->getParameter('ligne_debit');
        $ligne_credit = $request->getParameter('ligne_credit');
        $ligne_nature_id = $request->getParameter('ligne_nature_id');
        $ligne_numero_externe = $request->getParameter('ligne_numero_externe');
        $ligne_reference = $request->getParameter('ligne_reference');
        $ligne_facture_id = $request->getParameter('ligne_facture_id');
        $ligne_libelle = $request->getParameter('ligne_libelle');
        $journal_comptable = JournalcomptableTable::getInstance()->find($journal);
        $dossier_id = $journal_comptable->getIdDossier();
        $exercice_id = $_SESSION['exercice_id'];
        $piece_search = '';
        $piece = new Piececomptable();
        $user = $this->getUser()->getAttribute('userB2m');
        $piece->setIdJournalcomptable($journal);

        $piece->setDatecreation(date('Y-m-d'));
        $piece->setIdUser($user->getId());
        $piece->setNumero($numero);
        $piece->setIdSerie($serie);
        $piece->setTotaldebit($total_debit);
        $piece->setTotalcredit($total_credit);
        $piece->setLibelle($libelle_piece);
        $piece->setIdExercice($exercice_id);
        $piece->setDate($date);
        $piece->save();


        $piece_id = $piece->getId();

        $piece = PiececomptableTable::getInstance()->find($piece_id);
        $this->updateAttenduLastNumber($serie, $numero);
//

        $numero_compte = explode(',,', $numero_compte);
        $ligne_contre = explode(',,', $ligne_contre);
        $ligne_debit = explode(',,', $ligne_debit);
        $ligne_credit = explode(',,', $ligne_credit);
        $ligne_nature_id = explode(',,', $ligne_nature_id);
        $ligne_numero_externe = explode(',,', $ligne_numero_externe);
        $ligne_reference = explode(',,', $ligne_reference);
        $ligne_facture_id = explode(',,', $ligne_facture_id);
        $ligne_libelle = explode(',**,', $ligne_libelle);
//
        for ($i = 0; $i < sizeof($numero_compte); $i++) {
            if ($numero_compte[$i] != '') {
                $ligne_piece = new Lignepiececomptable();
                if ($numero_compte[$i] != '' && $numero_compte[$i] != '-1' && $numero_compte[$i] != 'undefined') {
                    $plandossier = PlandossiercomptableTable::getInstance()->findOneById($numero_compte[$i]);
                    $ligne_piece->setIdComptecomptable($numero_compte[$i]);
                }

//                if ($ligne_contre[$i] != '' && $ligne_contre[$i] != '-1')
//                    $ligne_piece->setIdContrepartie($ligne_contre[$i]);
                $ligne_piece->setDate(date('Y-m-d'));
                if ($journal_comptable->getIdTypeJournal() == 1) {
                    if ($ligne_nature_id[$i] != '' && $ligne_nature_id[$i] != 'undefined')
                        if ($ligne_nature_id[$i] == '7')
                            if ($ligne_facture_id[$i] != '' && $ligne_facture_id[$i] != '-1' && $ligne_facture_id != 'undefined')
                                $ligne_piece->setIdFacturevente($ligne_facture_id[$i]);
                } else if ($journal_comptable->getIdTypeJournal() == 2) {
                    if ($ligne_nature_id[$i] != '')
                        if ($ligne_nature_id[$i] == '7')
                            if ($ligne_facture_id[$i] != '' && $ligne_facture_id[$i] != '-1' && $ligne_facture_id != 'undefined')
                                $ligne_piece->setIdFactureachat($ligne_facture_id[$i]);
                }

                $ligne_piece->setLettrelettrage(null);
                $ligne_piece->setIdNaturepiece(11);
                if ($ligne_credit[$i] != '' && $ligne_credit[$i] != 'undefined'):
                    $ligne_piece->setMontantcredit($ligne_credit[$i]);
                    $ligne_piece->setMontantdebit(0);
                endif;

                if ($ligne_debit[$i] != '' && $ligne_debit[$i] != 'undefined'):
                    $ligne_piece->setMontantdebit($ligne_debit[$i]);
                    $ligne_piece->setMontantcredit(0);
                endif;

//                if ($ligne_nature_id[$i] != '')
//                    $ligne_piece->setIdNaturepiece($ligne_nature_id[$i]);
                if ($ligne_numero_externe[$i] && $ligne_numero_externe[$i] != '' && $ligne_numero_externe[$i] != 'undefined')
                    $ligne_piece->setNumeroexterne($ligne_numero_externe[$i]);

                $ligne_piece->setIdPiececomptable($piece_id);
                if ($ligne_reference[$i] && $ligne_reference[$i] != '' && $ligne_reference[$i] != 'undefined')
                    $ligne_piece->setReference($ligne_reference[$i]);
                if ($ligne_libelle[$i] && $ligne_libelle[$i] != '' && $ligne_libelle[$i] != 'undefined')
                    $ligne_piece->setLibelle($ligne_libelle[$i]);

                $ligne_piece->save();
                if (trim($plandossier->getId()) == $numero_compte[0])
                    $piece_search = $ligne_piece->getId();
            }
        }
        /*
         * Add lettrage
         */

        $arra_test = '';
        if ($piece_search != '')
            $array_piece_ligne = $request->getParameter('arrayid') . ',' . $piece_search;
//       die($array_piece_ligne);
        $arra_test = $array_piece_ligne . '\n';
        $ids = split(',', $array_piece_ligne);
        $next_lettre = $request->getParameter('lettre');
        $somme_debit = 0;
        $somme_credit = 0;
        for ($i = 0; $i < count($ids); $i++) {
            if ($ids[$i] != 'undefined' && $ids[$i] != null) {
                $fiche = new Lignepiececomptable();

                $fiche = LignepiececomptableTable::getInstance()->findOneById($ids[$i]);
                $somme_credit = $somme_credit + $fiche->getMontantcredit();
                $somme_debit = $somme_debit + $fiche->getMontantdebit();
                $arra_test.=$fiche->getId() . '=' . $fiche->getMontantcredit() . '-' . $fiche->getMontantdebit();
            }
        }
//        die($arra_test);
        if (intval($somme_credit - $somme_debit) == 0) {
          
                for ($i = 0; $i < count($ids); $i++) {
                      if ($ids[$i] != 'undefined' && $ids[$i] != null) {
                    $fiche = new Lignepiececomptable();

                    $fiche = LignepiececomptableTable::getInstance()->findOneById($ids[$i]);
                    $fiche->setLettrelettrage($next_lettre);
                    $fiche->save();
                }
            }
        }
        $resultat = $somme_credit - $somme_debit;
        die('ok');
    }

//update serie & numero atendu du piece comptable 
    public function updateAttenduLastNumber($serie_id, $numero) {
        $numero_serie = NumeroseriejournalTable::getInstance()->find($serie_id);
        $numero_courant = trim($numero_serie->getPrefixe()) . sprintf("%03s", $numero_serie->getAttendu());

        if ($numero_courant == $numero) {
            $attendu = $numero_serie->getNumerofin() + 1;
            if ($numero_serie->getPiececomptable()->count() != 1) {

                if ($numero_serie->getNumerofin() <= $numero_serie->getAttendu() && $numero_serie->getAttendu() != 1) {
                    $numero_serie->setNumerofin($numero_serie->getAttendu());
                    $numero_serie->save();
                }
            }

            $attendu = $numero_serie->getAttendu();
            //test si attendu existe ou non
            $test_numero = trim($numero_serie->getPrefixe()) . sprintf("%03s", $attendu);
            $pieces = PiececomptableTable::getInstance()->findByNumero($test_numero);
            if ($pieces->count() == 0) {
                $numero_serie->setAttendu($attendu);
                $numero_serie->save();
            } else {
                $attendu = $attendu + 1;
                $this->updateAttendu($serie_id, $attendu);
            }
        } else {
            $taille_numero = strlen($numero) - 4;
            $numero_fin = substr($numero, 4, $taille_numero);
            if ($numero_serie->getNumerofin() < intval($numero_fin)) {
                $numero_serie->setNumerofin($numero_fin);
                $numero_serie->save();
            }
        }
    }

    public function updateAttendu($serie_id, $attendu) {
        $numero_serie = NumeroseriejournalTable::getInstance()->find($serie_id);
        $test_numero = trim($numero_serie->getPrefixe()) . sprintf("%03s", $attendu);

        $pieces = PiececomptableTable::getInstance()->getByNumero($test_numero);

//        if ($pieces->count() == 0) {
        $numero_serie->setAttendu($attendu);
        $numero_serie->save();
//        } else {
//            $attendu = $attendu + 1;
//            //appel recursif
//            $this->updateAttendu($serie_id, $attendu);
//        }
//         die($numero_serie->getId().'id'.$numero_serie->getAttendu().'atte'.$pieces->count());
    }

//ligne fixe 
    public function executeAddLigne(sfWebRequest $request) {
        $this->numero_ligne = 0;
        $contre_partie = '';
        $journal_id = $request->getParameter('journal_id');
        $journal = JournalcomptableTable::getInstance()->find($journal_id);

        $solde_lignes = $request->getParameter('solde_lignes');
        $id_compte = $request->getParameter('id_compte');
        $this->id_compte = $id_compte;
        $this->solde_lignes = $solde_lignes;
    }

//ligne variable
    public function executeAddLigneVide(sfWebRequest $request) {
        $solde_lignes = $request->getParameter('solde_lignes');
        $id_compte = $request->getParameter('id_compte');
        $this->id_compte = $id_compte;
        $this->solde_lignes = $solde_lignes;
        $this->numero_ligne = 0;
        $this->selectedcontre = '';
        $this->nature_piece = '';
        $contre_partie = '';
        $maquette_id = $request->getParameter('maquette_id');
        $this->maquette = null;
        $this->numero_externe = $request->getParameter('numero_externe');
        $type_journal_id = $request->getParameter('type_journal_id');
        $nature_id = $request->getParameter('nature_id');
        $reference = $request->getParameter('reference');
        $journal_id = $request->getParameter('journal_id');

        $journal = JournalcomptableTable::getInstance()->find($journal_id);

        if ($request->getParameter('numerofinligne'))
            $this->numero_ligne = $request->getParameter('numerofinligne');
        if ($request->getParameter('selectedcontre'))
            $this->selectedcontre = $request->getParameter('selectedcontre');
        $this->reference = $reference;
//           $this->nature_piece = NaturepieceTable::getInstance()->find($nature_id);
//        $comptes = PlandossiercomptableTable::getInstance()->findByJournalOrderByNumero($journal_id);
//        if ($comptes->count() != 0)
//            $this->comptes = $comptes;
//        else
//            $this->comptes = PlandossiercomptableTable::getInstance()->findOrderByNumero();
        $this->facture = null;
        if ($type_journal_id == 1 && $nature_id == 7) {
            $this->facture = FacturecomptableventeTable::getInstance()->findOneByReference($reference);
            $this->type = 'vente';
        }
        if ($type_journal_id == 2 && $nature_id == 7) {
            $this->facture = FacturecomptableachatTable::getInstance()->findOneByReference($reference);
            $this->type = 'achat';
        }

        $this->selected_compte = $request->getParameter('selected_compte');
        $this->credit = $request->getParameter('credit', '');
        $this->debit = $request->getParameter('debit', '');
        if ($journal->getIdComptecontrepartie()) {
            $contre_partie = $journal->getIdComptecontrepartie();
            $this->selected_contre = $contre_partie;
            $this->selectedcontre = $contre_partie;
            //die($this->numero_ligne.'hhhhhhhhhhhhh');
        }
    }

    public function executeAddLigneVideNonEwuilibrer(sfWebRequest $request) {
        $solde_lignes = $request->getParameter('solde_lignes');
        $id_compte = $request->getParameter('id_compte');
        $this->id_compte = $id_compte;
        $this->solde_lignes = $solde_lignes;
        $this->numero_ligne = 0;
        $this->selectedcontre = '';
        $this->nature_piece = '';
        $contre_partie = '';
        $maquette_id = $request->getParameter('maquette_id');
        $this->maquette = null;
        $this->numero_externe = $request->getParameter('numero_externe');
        $type_journal_id = $request->getParameter('type_journal_id');
        $nature_id = $request->getParameter('nature_id');
        $reference = $request->getParameter('reference');
        $journal_id = $request->getParameter('journal_id');

        $journal = JournalcomptableTable::getInstance()->find($journal_id);

        if ($request->getParameter('numerofinligne'))
            $this->numero_ligne = $request->getParameter('numerofinligne');
        if ($request->getParameter('selectedcontre'))
            $this->selectedcontre = $request->getParameter('selectedcontre');
        $this->reference = $reference;
//           $this->nature_piece = NaturepieceTable::getInstance()->find($nature_id);
//        $comptes = PlandossiercomptableTable::getInstance()->findByJournalOrderByNumero($journal_id);
//        if ($comptes->count() != 0)
//            $this->comptes = $comptes;
//        else
//            $this->comptes = PlandossiercomptableTable::getInstance()->findOrderByNumero();
        $this->facture = null;
        if ($type_journal_id == 1 && $nature_id == 7) {
            $this->facture = FacturecomptableventeTable::getInstance()->findOneByReference($reference);
            $this->type = 'vente';
        }
        if ($type_journal_id == 2 && $nature_id == 7) {
            $this->facture = FacturecomptableachatTable::getInstance()->findOneByReference($reference);
            $this->type = 'achat';
        }

        $this->selected_compte = $request->getParameter('selected_compte');
        $this->credit = $request->getParameter('credit', '');
        $this->debit = $request->getParameter('debit', '');
        if ($journal->getIdComptecontrepartie()) {
            $contre_partie = $journal->getIdComptecontrepartie();
            $this->selected_contre = $contre_partie;
            $this->selectedcontre = $contre_partie;
            //die($this->numero_ligne.'hhhhhhhhhhhhh');
        }
    }

    public function executeIndex(sfWebRequest $request) {
        
    }

    public function executeEtatJournal(sfWebRequest $request) {
        
    }

    public function executeEtatJournalCentralisateurM2(sfWebRequest $request) {
        $this->exercice = $_SESSION['exercice'];
    }

    public function executeExporterJournalSeulExcel(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $journal_id = $request->getParameter('id', '');


        if ($date_debut != '')
            $date_debut = date('d/m/Y', strtotime($date_debut));
        else
            $date_debut = '--/--/----';

        if ($date_fin != '')
            $date_fin = date('d/m/Y', strtotime($date_fin));
        else
            $date_fin = '--/--/----';

//        $date_debut = $request->getParameter('date_debut', '');
//        $date_fin = $request->getParameter('date_fin', '');
//        $journal_id = $request->getParameter('id', '');
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->journal_id = $journal_id;
    }

    public function executeExporterEtatJournalExcel_1(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut');
        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = $_SESSION['exercice'] . '-01-01';

        $date_fin = $request->getParameter('date_fin');
        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = $_SESSION['exercice'] . '-12-31';

        $date_debut_journal = $request->getParameter('date_debut_journal');
        if ($date_debut_journal == '' || $date_debut_journal == NULL)
            $date_debut_journal = $_SESSION['exercice'] . '-01-01';

        $date_fin_journal = $request->getParameter('date_fin_journal');
        if ($date_fin_journal == '' || $date_fin_journal == NULL)
            $date_fin_journal = $_SESSION['exercice'] . '-12-31';

        $journals = array();
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $journals_interval = JournalComptableTable::getInstance()->loadByInterval($date_debut_journal, $date_fin_journal, $dossier_id, $exercice_id);
        $i = 0;
        foreach ($journals_interval as $j_i) {
            $journals[$i]['code'] = $j_i->getCode();
            $journals[$i]['libelle'] = $j_i->getLibelle();
            $i++;
        }
        $etatJournal = LignePieceComptableTable::getInstance()->loadEtatJournal($date_debut, $date_fin, $date_debut_journal, $date_fin_journal);

        $this->date_debut_journal = $date_debut_journal;
        $this->date_fin_journal = $date_fin_journal;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->journals_interval = $journals_interval;
        $this->etatJournal = $etatJournal;
    }

    public function executeExporterEtatCentralisateurExcel(sfWebRequest $request) {
        $id_exercice = $request->getParameter('id_exercie', '');
        $exercie = Doctrine_Core::getTable('Exercice')->findOneById($id_exercice);
        $annee = $exercie->getLibelle();
        $date_periode = array();
        for ($i = 1; $i < 7; $i++) {
            if ($i < 10)
                $mois = '0' . $i;
            else
                $mois = $i;

            $date_debut_mois = $annee . '-' . $mois . '-01';
            $date_fin_mois = date('Y-m-d', strtotime(date('Y-m-d', strtotime($date_debut_mois . ' +1 month')) . ' -1 day'));
            $date_periode[$i - 1]['date_debut'] = $date_debut_mois;
            $date_periode[$i - 1]['date_fin'] = $date_fin_mois;
        }

        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $id_exercice;

        $journals_interval = JournalComptableTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id);

//        $all_etatJournal = calculJournalCentralisateur::getJournal($dossier_id, $exercice_id);
        $total_all_etatJournal = calculJournalCentralisateur::getTotalJournal($annee);

        $this->date_debut = $date_debut_mois;
        $this->date_fin = $date_fin_mois;

        $this->journals_interval = $journals_interval;
        $this->all_journal = $total_all_etatJournal;
    }

    public function executeEtatJournalSeul(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];

        $this->journals = JournalcomptableTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id);
    }

    public function executeAfficherEtatJournalSeul(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut');
        $date_fin = $request->getParameter('date_fin');
        $journal_id = $request->getParameter('journal_id', '');

        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = $_SESSION['exercice'] . '-01-01';

        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = $_SESSION['exercice'] . '-12-31';

        $journal = JournalcomptableTable::getInstance()->find($journal_id);
        $etatJournal = LignepiececomptableTable::getInstance()->loadEtatJournalSeul($journal_id, $date_debut, $date_fin);

        return $this->renderPartial("etat_journal_seul", array("etatJournal" => $etatJournal, "journal" => $journal, "date_debut" => $date_debut, "date_fin" => $date_fin));
    }

//journal centralisateur 

    public function executeAfficherEtatJournalCentralisateurM2(sfWebRequest $request) {
//        $exercice = $request->getParameter('exercice');
//
//
////        $journal = JournalcentralisateurTable::getInstance()->findByIdExercice($exercice);
////        $etatJournal = LignepiececomptableTable::getInstance()->loadEtatJournalSeul($journal_id, $date_debut, $date_fin);
////            $date_periode = array();
////        for ($i = 1; $i < 13; $i++) {
////            if ($i < 10)
////                $mois = '0' . $i;
////            else
////                $mois = $i;
////            $exerc = ExerciceTable::getInstance()->findOneById($exercice);
////        die($exercice);
////            $annee = $exerc->getLibelle();
////            $date_debut_mois = $annee . '-' . $mois . '-01';
////            $date_fin_mois = date('Y-m-d', strtotime(date('Y-m-d', strtotime($date_debut_mois . ' +1 month')) . ' -1 day'));
////            $date_periode[$i - 1]['date_debut'] = $date_debut_mois;
////            $date_periode[$i - 1]['date_fin'] = $date_fin_mois;
////        }
//
//        $dossier_id = $_SESSION['dossier_id'];
//        $exercice_id = $exercice;
//        $exerc = ExerciceTable::getInstance()->findOneById($exercice);
//        $annee = $exerc->getLibelle();
//        $journals_interval = JournalComptableTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id);
//
//        $all_etatJournal = calculJournalCentralisateur::getJournal($dossier_id, $exercice_id);
//        $total_all_etatJournal = calculJournalCentralisateur::getTotalJournal($annee);
//
//        return $this->renderPartial("etat_journal_centralisateur", array("all_etatJournal" => $all_etatJournal, "journals_interval" => $journals_interval, "exercice" => $exercice, "total_all_etatJournal" => $total_all_etatJournal));
    }

//exporter grand livre 

    public function executeExportergrandlivreExcel(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $compte_min = $request->getParameter('compte_min', '');
        $compte_max = $request->getParameter('compte_max', '');
//        $date_debut = $request->getParameter('date_debut');
//        $date_fin = $request->getParameter('date_fin');
        $toutlivre = $request->getParameter('toutlivre');

        $order = $request->getParameter('order', '');
        $date_debut = $request->getParameter('date_debut');
        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = $exercice . '-01-01';

        $date_fin = $request->getParameter('date_fin');
        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = $exercice . '-12-31';
        $etatLivre = LignePieceComptableTable::getInstance()->loadEtatLivre($compte_min, $compte_max, $date_debut, $date_fin, $order);

        $compte_min_comptable = PlanComptableTable::getInstance()->findOneByNumeroCompte($compte_min);
        $compte_max_comptable = PlanComptableTable::getInstance()->findOneByNumeroCompte($compte_max);

        $this->dossier_id = $dossier_id;
        $this->exercice_id = $exercice_id;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->compte_min = $compte_min;
        $this->compte_max = $compte_max;
    }

    public function executeExportergrandlivreExcel_1(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $compte_min = $request->getParameter('compte_min', '');
        $compte_max = $request->getParameter('compte_max', '');
//        $date_debut = $request->getParameter('date_debut');
//        $date_fin = $request->getParameter('date_fin');
        $toutlivre = $request->getParameter('toutlivre');

        $order = $request->getParameter('order', '');
        $date_debut = $request->getParameter('date_debut');
        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = $exercice . '-01-01';

        $date_fin = $request->getParameter('date_fin');
        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = $exercice . '-12-31';
        $etatLivre = LignePieceComptableTable::getInstance()->loadEtatLivre2($compte_min, $compte_max, $date_debut, $date_fin, $order, $_SESSION['dossier_id'], $_SESSION['exercice_id']);

        $compte_min_comptable = PlanComptableTable::getInstance()->findOneByNumeroCompte($compte_min);
        $compte_max_comptable = PlanComptableTable::getInstance()->findOneByNumeroCompte($compte_max);

        $this->dossier_id = $dossier_id;
        $this->exercice_id = $exercice_id;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->compte_min = $compte_min;
        $this->compte_max = $compte_max;
        $this->etatLivre = $etatLivre;
//        die($etatLivre);
    }

//exportet extrait compte 

    public function executeExporterExtraitExcel(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $compte = $request->getParameter('compte', '');

        $date_debut = $request->getParameter('date_debut');

        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = date('Y') . '-01-01';

        $date_fin = $request->getParameter('date_fin');
        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = date('Y') . '-12-31';

        $journal = $request->getParameter('journal', '');
        $order = $request->getParameter('order', '');
        $lettre = $request->getParameter('lettre', '');
        $non_lettre = $request->getParameter('non_lettre', '');
        $debit = $request->getParameter('debit', '');
        $credit = $request->getParameter('credit', '');

        $Plan_dossier_comptable = PlandossiercomptableTable::getInstance()->find($compte);

        $etatExtraitCompte = LignePieceComptableTable::getInstance()->loadEtatExtraitCompte($compte, $date_debut, $date_fin, $journal, $order, $lettre, $non_lettre, $debit, $credit, $dossier_id, $exercice_id);

        $date_debut = strtotime($date_debut);

        $this->dossier_id = $dossier_id;
        $this->exercice_id = $exercice_id;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->lettre = $lettre;
        $this->non_lettre = $non_lettre;
        $this->journal = $journal;
        $this->compte = $compte;
        $this->credit = $credit;
        $this->debit = $debit;
        $this->Plan_dossier_comptable = $Plan_dossier_comptable;
        $this->etatExtraitCompte = $etatExtraitCompte;
    }

//    public function executeImprimeJournalSeul(sfWebRequest $request) {
//        $pdf = new sfTCPDF();
//
//        // set document information
//        $pdf->SetCreator(PDF_CREATOR);
//
//        $pdf->SetTitle('Etat Journal Comptable');
//        $pdf->SetSubject("Etat Journal Comptable");
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getMinistere();
//        $rs = $soc->getRs();
//        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
//        $pdf->SetAuthor($entete);
//        $pdf->SetAuthor($rs);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//        // set default monospaced font
//        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//        // set margins
////        $pdf->SetMargins(5, 30, 5);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
//        // set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//        // set image scale factor
//        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//        // set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }
//        ob_end_clean();
//        $pdf->SetFont('dejavusans', '', 10, '', true);
//      $pdf->SetPrintHeader(true);
//        $pdf->SetPrintFooter(true);
//         $pdf->SetMargins(5, 30, 5);
//        $pdf->AddPage();
//        $pdf->SetPrintHeader(false);
//        $pdf->SetPrintFooter(false);
//         $pdf->SetMargins(5, 10, 5);
//        $html = $this->ReadHtmlSeulJournal($request);
//        $pdf->writeHTML($html, true, false, true, false, '');
//        $pdf->Output('Etat Journal Comptable.pdf', 'I');
//
//        // Stop symfony process
//        throw new sfStopException();
//    }
    public function executeImprimeJournalSeul(sfWebRequest $request) {
        $pdf = new sfTCPDF("L");

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Etat Journal Comptable');
        $pdf->SetSubject("Etat Journal Comptable");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins

        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        ob_end_clean();
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->SetPrintHeader(true);
        $pdf->SetPrintFooter(true);
        $pdf->SetMargins(5, 30, 5);
        $pdf->AddPage();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetMargins(5, 10, 5);
        $html = $this->ReadHtmlSeulJournal($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Etat Journal Comptable.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlSeulJournal(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Journalcomptable();
        $html .= $piece->ReadHtmlSeulJournal($request);
        return $html;
    }

    public function executeAfficherEtatJournal(sfWebRequest $request) {

        $date_debut = $request->getParameter('date_debut');
        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = $_SESSION['exercice'] . '-01-01';

        $date_fin = $request->getParameter('date_fin');
        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = $_SESSION['exercice'] . '-12-31';

        $date_debut_journal = $request->getParameter('date_debut_journal');
        if ($date_debut_journal == '' || $date_debut_journal == NULL)
            $date_debut_journal = $_SESSION['exercice'] . '-01-01';

        $date_fin_journal = $request->getParameter('date_fin_journal');
        if ($date_fin_journal == '' || $date_fin_journal == NULL)
            $date_fin_journal = $_SESSION['exercice'] . '-12-31';

        $journals = array();
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $journals_interval = JournalComptableTable::getInstance()->loadByInterval($date_debut_journal, $date_fin_journal, $dossier_id, $exercice_id);
        $i = 0;
        foreach ($journals_interval as $j_i) {
            $journals[$i]['code'] = $j_i->getCode();
            $journals[$i]['libelle'] = $j_i->getLibelle();
            $i++;
        }

        $etatJournal = LignePieceComptableTable::getInstance()->loadEtatJournal($date_debut, $date_fin, $date_debut_journal, $date_fin_journal);

        return $this->renderPartial("etat_journal", array("etatJournal" => $etatJournal, "journals" => $journals, "date_debut" => $date_debut, "date_fin" => $date_fin, "date_debut_journal" => $date_debut_journal, "date_fin_journal" => $date_fin_journal));
    }

    public function executeImprimeEtatJournal(sfWebRequest $request) {

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Etat Journaux Comptables');
        $pdf->SetSubject("Etat Journaux Comptables");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

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
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        ob_end_clean();
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->SetMargins(5, 30, 5);
        $pdf->AddPage();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetMargins(5, 10, 5);
        $html = $this->ReadHtmlJournaux($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Etat Journaux Comptables.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlJournaux(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Journalcomptable();
        $html .= $piece->ReadHtmlJournaux($request);
        return $html;
    }

    public function executeImprimeEtatJournalNonVide(sfWebRequest $request) {

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Etat Journaux Comptables');
        $pdf->SetSubject("Etat Journaux Comptables");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

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
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        ob_end_clean();
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->SetMargins(5, 30, 5);
        $pdf->AddPage();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetMargins(5, 10, 5);
        $html = $this->ReadHtmlJournauxNonVide($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Etat Journaux Comptables.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlJournauxNonVide(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Journalcomptable();
        $html .= $piece->ReadHtmlJournauxNonVide($request);
        return $html;
    }

    public function executeEtatJournalCentralisateur(sfWebRequest $request) {
        $date_periode = array();
        $exercice = $request->getParameter('exercice');
        $exercice_id = $exercice;
        $exerc = ExerciceTable::getInstance()->findOneById($exercice_id);
        $annee = $exerc->getLibelle();

        for ($i = 1; $i < 13; $i++) {
            if ($i < 10)
                $mois = '0' . $i;
            else
                $mois = $i;

            $date_debut_mois = $annee . '-' . $mois . '-01';
            $date_fin_mois = date('Y-m-d', strtotime(date('Y-m-d', strtotime($date_debut_mois . ' +1 month')) . ' -1 day'));
            $date_periode[$i - 1]['date_debut'] = $date_debut_mois;
            $date_periode[$i - 1]['date_fin'] = $date_fin_mois;
        }

        $dossier_id = $_SESSION['dossier_id'];
        $this->exercice = $exercice;
        $this->date_periode = $date_periode;
        $this->journals_interval = JournalComptableTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id);
        $this->all_etatJournal = calculJournalCentralisateur::getJournal($dossier_id, $exercice_id);
        $this->annee = $annee;

        $this->total_all_etatJournal = calculJournalCentralisateur::getTotalJournal($annee);
//        $journals_interval = JournalComptableTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id);
////
//        $all_etatJournal = calculJournalCentralisateur::getJournal($dossier_id, $exercice_id);
//        $total_all_etatJournal = calculJournalCentralisateur::getTotalJournal($annee);
//        $count_journal = count($total_all_etatJournal);
//        return $this->renderPartial("etat_centralisateur", array("all_etatJournal" => $all_etatJournal,"count_journal"=> $count_journal, "journals_interval" => $journals_interval, "exercice" => $exercice, "total_all_etatJournal" => $total_all_etatJournal,"date_periode"=>$date_periode));
    }

    public function executeImprimeEtatCentralisateur(sfWebRequest $request) {
        $id_exercice = $request->getParameter('id_exercie');

        $pdf = new sfTCPDF('L');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Etat Journaux Comptables');
        $pdf->SetSubject("Etat Journaux Comptables");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
//        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        ob_end_clean();
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->SetPrintHeader(true);
        $pdf->SetPrintFooter(true);
        $pdf->SetMargins(5, 30, 5);
        $pdf->AddPage();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetMargins(5, 10, 5);
        $html = $this->ReadHtmlCentralisateur($id_exercice);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Etat Journaux Comptables.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlCentralisateur($id_exercice) {
        $html = StyleCssHeader::header1();
        $piece = new Journalcomptable();
        $html .= $piece->ReadHtmlCentralisateur($id_exercice);
        return $html;
    }

    public function executeEtatBalance(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];

        $this->comptes = PlandossiercomptableTable::getInstance()->getPlanComptableOrderByNumero($dossier_id, $exercice_id);
    }

    public function executeEtatBalanceTiers(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $this->comptes = PlandossiercomptableTable::getInstance()->findOrderByNumeroTiers($dossier_id, $exercice_id);
    }

    public function executeEtatBalanceTotaux(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $this->comptes = PlandossiercomptableTable::getInstance()->getPlanComptableOrderByNumero($dossier_id, $exercice_id);
    }

    public function executeEtatLivre(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $this->comptes = PlandossiercomptableTable::getInstance()->getPlanComptableOrderByNumero($dossier_id, $exercice_id);
    }

    public function executeEtatExtraitCompte(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $this->comptes = PlandossiercomptableTable::getInstance()->getPlanComptableOrderByNumero($dossier_id, $exercice_id);
        $this->journals = JournalComptableTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id);
    }

    public function executeEtatFicheCompte(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $this->comptes = PlandossiercomptableTable::getInstance()->getPlanComptableOrderByNumero($dossier_id, $exercice_id);
    }

    public function executeAfficherEtatFicheCompte(sfWebRequest $request) {
        $compte_min = $request->getParameter('compte_min', '');
        $compte_max = $request->getParameter('compte_max', '');

        $dossier_id = $_SESSION['dossier_id'];
        $exercice = $_SESSION['exercice'];
        $exercice_id = $_SESSION['exercice_id'];

        $date_debut = $request->getParameter('date_debut');
        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = $exercice . '-01-01';

        $date_fin = $request->getParameter('date_fin');
        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = $exercice . '-12-31';

        $crediteur = $request->getParameter('crediteur', '');
        $debiteur = $request->getParameter('debiteur', '');
        $solde = $request->getParameter('solde', '');

        $comptes = array();
        $comptes_interval = PlanDossierComptableTable::getInstance()->loadByInterval($compte_min, $compte_max, $dossier_id, $exercice_id);
        $i = 0;
        foreach ($comptes_interval as $c_i) {
            $comptes[$i]['numero'] = $c_i->getNumeroCompte();
            $comptes[$i]['libelle'] = $c_i->getLibelle();
            $i++;
        }

        $etatFicheCompte = LignePieceComptableTable::getInstance()->loadEtatFicheCompte($compte_min, $compte_max, $date_debut, $date_fin, $crediteur, $debiteur, $solde, $dossier_id, $exercice_id);
        return $this->renderPartial("etat_fiche_compte", array("etatFicheCompte" => $etatFicheCompte, "comptes" => $comptes, "date_debut" => $date_debut, "date_fin" => $date_fin, "compte_min" => $compte_min, "compte_max" => $compte_max, "crediteur" => $crediteur, "debiteur" => $debiteur, "solde" => $solde));
    }

    public function executeAfficherEtatFicheCompteNonVide(sfWebRequest $request) {
        $compte_min = $request->getParameter('compte_min', '');
        $compte_max = $request->getParameter('compte_max', '');

        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $exercice = $_SESSION['exercice'];

        $date_debut = $request->getParameter('date_debut');
        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = $exercice . '-01-01';

        $date_fin = $request->getParameter('date_fin');
        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = $exercice . '-12-31';

        $crediteur = $request->getParameter('crediteur', '');
        $debiteur = $request->getParameter('debiteur', '');
        $solde = $request->getParameter('solde', '');

        $comptes = array();
        $comptes_interval = PlanDossierComptableTable::getInstance()->loadByInterval($compte_min, $compte_max, $dossier_id, $exercice_id);
        $i = 0;
        foreach ($comptes_interval as $c_i) {
            $comptes[$i]['numero'] = $c_i->getNumeroCompte();
            $comptes[$i]['libelle'] = $c_i->getLibelle();
            $i++;
        }

        $etatFicheCompte = LignePieceComptableTable::getInstance()->loadEtatFicheCompte($compte_min, $compte_max, $date_debut, $date_fin, $crediteur, $debiteur, $solde, $dossier_id, $exercice_id);
        return $this->renderPartial("etat_fiche_compte_non_vide", array("etatFicheCompte" => $etatFicheCompte, "comptes" => $comptes, "date_debut" => $date_debut, "date_fin" => $date_fin, "compte_min" => $compte_min, "compte_max" => $compte_max, "crediteur" => $crediteur, "debiteur" => $debiteur, "solde" => $solde));
    }

    public function executeImprimeEtatFicheOne(sfWebRequest $request) {
        $pdf = new sfTCPDF("L");

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Etat Fiche Compte Comptable');
        $pdf->SetSubject("Etat Fiche Compte Comptable");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

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
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        ob_end_clean();
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->SetMargins(5, 30, 5);
        $pdf->AddPage();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetMargins(5, 10, 5);
        $html = $this->ReadHtmlSeulFicheCompte($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Etat Fiche Compte Comptable.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlSeulFicheCompte(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $compte = new Plandossiercomptable();
        $html .= $compte->ReadHtmlSeulFicheCompte($request);
        return $html;
    }

    public function executeImprimeEtatFiche(sfWebRequest $request) {
        $pdf = new sfTCPDF("L");

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Etat Fiche');
        $pdf->SetSubject("Etat Fiche");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

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
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        ob_end_clean();
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->SetMargins(5, 30, 5);
        $pdf->AddPage();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetMargins(5, 10, 5);
        $html = $this->ReadHtmlFicheCompte($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Etat Fiche.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFicheCompte(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $compte = new Plandossiercomptable();
        $html .= $compte->ReadHtmlFicheCompte($request);
        return $html;
    }

    public function executeImprimeEtatFicheNonVide(sfWebRequest $request) {
        $pdf = new sfTCPDF("L");

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Etat Fiche');
        $pdf->SetSubject("Etat Fiche");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

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
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        ob_end_clean();
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->SetMargins(5, 30, 5);
        $pdf->AddPage();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetMargins(5, 10, 5);
        $html = $this->ReadHtmlFicheCompteNonVide($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Etat Fiche.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFicheCompteNonVide(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $compte = new Plandossiercomptable();
        $html .= $compte->ReadHtmlFicheCompteNonVide($request);
        return $html;
    }

    /*
     * 
     * Affichage lettre en cours
     */

    public function executeLettreEnCour($request) {
        $lettre = 'A';
        $lignePieceComptable = LignepiececomptableTable::getInstance()->findLettre();
//        die( sizeof($lignePieceComptable) .'pm'.$lignePieceComptable->getLast()->getLettrelettrage());
        if (count($lignePieceComptable) == 0)
            die($lettre);
        else {
            $lettre = trim($lignePieceComptable->getFirst()->getLettrelettrage());
            // die($lettre);
            if ($lettre == 'Z')
                $lettre = 'AA';
            elseif ($lettre == 'AZ')
                $lettre = 'BA';
            elseif ($lettre == 'ZZ')
                $lettre = 'AAA';
            elseif ($lettre == 'AAZ')
                $lettre = 'ABA';
            elseif ($lettre == 'AZZ')
                $lettre = 'BAA';
            elseif ($lettre == 'BAZ')
                $lettre = 'BBA';
            elseif ($lettre == 'BZZ')
                $lettre = 'CBA';
//            elseif ($lettre == 'CBZ')
//                $lettre = 'CCA';
//            elseif ($lettre == 'CCZ')
//                $lettre = 'CCA';
            elseif ($lettre == 'ZZZ')
                $lettre = 'AAAA';
            elseif ($lettre == 'AAAZ')
                $lettre = 'AABA';
            elseif ($lettre == 'AAZZ')
                $lettre = 'ABAA';
            elseif ($lettre == 'BAZZ')
                $lettre = 'BBAA';
            elseif ($lettre == 'BAZZ')
                $lettre = 'BBAA';

            elseif ($lettre == 'ZZZZ')
                $lettre = 'AAAAA';


            elseif ($lettre == 'ZZZZZ')
                $lettre = 'AAAAAA';
            elseif ($lettre == 'ZZZZZZ')
                $lettre = 'AAAAAAA';
            elseif ($lettre == 'ZZZZZZ')
                $lettre = 'AAAAAAA';
//            elseif ($lettre == 'z')
//                $lettre = 'a0';
            else
                ++$lettre;
        }

        die($lettre);
    }

    public function executeComparaisonlettreEnCour($request) {
        $lettre = 'A';
        $lignePieceComptable = LignepiececomptableTable::getInstance()->findLettre();
        if (count($lignePieceComptable) == 0)
            die($lettre);
        else {
            $lettre = trim($lignePieceComptable->getFirst()->getLettrelettrage());
            if ($lettre == 'Z')
                $lettre = 'a';
            elseif ($lettre == 'z')
                $lettre = 'a0';
            else
                ++$lettre;
        }
        $lettre_saisie = $request->getParameter('lettre', '');
        $code_lettre = ord($lettre_saisie);
        $code_dernier_lettre = ord($lettre);
//      die($code_lettre .' code'.$code_dernier_lettre.'cout'.count($lignePieceComptable).'letre'.$lettre);
        if ($code_lettre < $code_dernier_lettre) {
            $lett = chr($code_dernier_lettre);
            $msg = 'Inferieur';
            $resultat = array();
            $finalResultat = array();
            $resultat['msg'] = $msg;
            $resultat['lettre'] = $lett;
            array_push($finalResultat, $resultat);
            die(json_encode($finalResultat));
        } else {
            $lett = chr($code_lettre);
            $msg = 'Superieur';
            $resultat = array();
            $finalResultat = array();
            $resultat['msg'] = $msg;
            $resultat['lettre'] = $lett;
            array_push($finalResultat, $resultat);
            die(json_encode($finalResultat));
        }
    }

     public function executeLettrageLigne(sfWebRequest $request) {
        $ids = split(',', $request->getParameter('arrayid'));
        $next_lettre = $request->getParameter('lettre');
        $somme_debit = 0;
        $str="";
        $somme_credit = 0;
        for ($i = 0; $i < count($ids); $i++) {
            $fiche = new Lignepiececomptable();
            if (is_numeric($ids[$i])) {
                $str.=$ids[$i];
//                $fiche = LignepiececomptableTable::getInstance()->findOneById($ids[$i]);
//                $somme_credit = $somme_credit + $fiche->getMontantcredit();
//                $somme_debit = $somme_debit + $fiche->getMontantdebit();
            }
        }
        $diff = $somme_credit - $somme_debit;
        $resultat = number_format($diff, 3);
        if ($resultat == 0) {
            for ($i = 0; $i < count($ids); $i++) {
                $fiche = new Lignepiececomptable();
                if (is_numeric($ids[$i])) {
                      $str.=$ids[$i];
//                    $fiche = LignepiececomptableTable::getInstance()->findOneById($ids[$i]);
//                    $fiche->setLettrelettrage($next_lettre);
//                    $fiche->save();
//                    die($fiche->getId() . 'id');
                }
            }
        }
        $diff = $somme_credit - $somme_debit;

        $resultat = number_format($diff, 3);
        die($str);
    }

    public function executeAnnulerlettrage($request) {
        LignepiececomptableTable::getInstance()->DeleteLettrage($request->getParameter('lettre'));
        die('bien');
    }

    public function executeAfficherEtatExtraitCompte(sfWebRequest $request) {

        $compte = $request->getParameter('compte', '');
        $exercice = $_SESSION['exercice'];
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $date_debut = $request->getParameter('date_debut');
        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = $exercice . '-01-01';
        $date_fin = $request->getParameter('date_fin');
        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = $exercice . '-12-31';
        $journal = $request->getParameter('journal', '');
        $order = $request->getParameter('order', '');
        $lettre = $request->getParameter('lettre', '');
        $non_lettre = $request->getParameter('non_lettre', '');
        $debit = $request->getParameter('debit', '');
        $credit = $request->getParameter('credit', '');
        $tout = $request->getParameter('tout', '');

        $compte_comptable = PlandossiercomptableTable::getInstance()->findOneById($compte);
        $etatExtraitCompte = LignePieceComptableTable::getInstance()->loadEtatExtraitCompte($compte, $date_debut, $date_fin, $journal, $order, $lettre, $non_lettre, $debit, $credit, $dossier_id, $exercice_id);
        return $this->renderPartial("etat_extrait_compte", array("compte_comptable" => $compte_comptable, "etatExtraitCompte" => $etatExtraitCompte, "date_debut" => $date_debut, "date_fin" => $date_fin, "compte" => $compte, "journal" => $journal, "order" => $order, "lettre" => $lettre, "non_lettre" => $non_lettre, "debit" => $debit, "credit" => $credit));
    }

    public function executeImprimeEtatExtrait(sfWebRequest $request) {
        $pdf = new sfTCPDF("L");

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Extrait Compte');
        $pdf->SetSubject("Extrait Compte");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

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
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        ob_end_clean();
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->SetMargins(5, 30, 5);
        $pdf->AddPage();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetMargins(5, 10, 5);
        $html = $this->ReadHtmlExtraitCompte($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Extrait Compte.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlExtraitCompte(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $compte = new Plandossiercomptable();
        $html .= $compte->ReadHtmlExtraitCompte($request);
        return $html;
    }

    public function executeAfficherEtatLivre(sfWebRequest $request) {
        $compte_min = $request->getParameter('compte_min', '');
        $compte_max = $request->getParameter('compte_max', '');
        $toutlivre = $request->getParameter('toutlivre');
        $dossier_id = $_SESSION['dossier_id'];
        $exercice = $_SESSION['exercice'];
        $exercice_id = $_SESSION['exercice_id'];

        $date_debut = $request->getParameter('date_debut');
        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = $exercice . '-01-01';

        $date_fin = $request->getParameter('date_fin');
        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = $exercice . '-12-31';

        $order = $request->getParameter('order', '');

        $etatLivre = LignePieceComptableTable::getInstance()->loadEtatLivre($compte_min, $compte_max, $date_debut, $date_fin, $order, $dossier_id, $exercice_id);
        $pager = $this->paginate($request);
        $this->pager = $pager;
        $this->paginate($request);
        $page = $request->getParameter('page', 1);
        $this->page = $page;

        $this->etatLivre = $etatLivre;
        return $this->renderPartial("etat_livre", array("pager" => $pager, "page" => $page, "etatLivre" => $etatLivre, "date_debut" => $date_debut, "date_fin" => $date_fin, "compte_min" => $compte_min, "compte_max" => $compte_max, "order" => $order, "toutlivre" => $toutlivre));
    }

    public function paginate(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $compte_min = $request->getParameter('compte_min', '');
        $compte_max = $request->getParameter('compte_max', '');
        $toutlivre = $request->getParameter('toutlivre');
        $dossier_id = $_SESSION['dossier_id'];
        $exercice = $_SESSION['exercice'];
        $exercice_id = $_SESSION['exercice_id'];

        $date_debut = $request->getParameter('date_debut');
        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = $exercice . '-01-01';

        $date_fin = $request->getParameter('date_fin');
        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = $exercice . '-12-31';

        $order = $request->getParameter('order', '');

//        $exercice_id = $_SESSION['exercice_id'];

        $pager = new sfDoctrinePager('LignePieceComptable', 10);
        $pager->setQuery(LignePieceComptableTable::getInstance()->loadEtatLivre($compte_min, $compte_max, $date_debut, $date_fin, $order, $dossier_id, $exercice_id));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeGoPage(sfWebRequest $request) {
        $compte_min = $request->getParameter('compte_min', '');
        $compte_max = $request->getParameter('compte_max', '');
        $toutlivre = $request->getParameter('toutlivre');
        $dossier_id = $_SESSION['dossier_id'];
        $exercice = $_SESSION['exercice'];
        $exercice_id = $_SESSION['exercice_id'];
        $date_debut = $request->getParameter('date_debut');
        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = $exercice . '-01-01';
        $date_fin = $request->getParameter('date_fin');
        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = $exercice . '-12-31';
        $order = $request->getParameter('order', '');
        $pager = $this->paginate($request);
        $page = $request->getParameter('page', 1);
        $etatLivre = LignePieceComptableTable::getInstance()->loadEtatLivre($compte_min, $compte_max, $date_debut, $date_fin, $order, $dossier_id, $exercice_id);
        $this->pager = $pager;
        $this->page = $page;
        return $this->renderPartial("etat_livre_paginate", array("pager" => $pager, "page" => $page, "etatLivre" => $etatLivre, "date_debut" => $date_debut, "date_fin" => $date_fin, "compte_min" => $compte_min, "compte_max" => $compte_max, "order" => $order, "toutlivre" => $toutlivre));
    }

    public function executeImprimeEtatLivre(sfWebRequest $request) {
        $pdf = new sfTCPDF("L");

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Etat Livre');
        $pdf->SetSubject("Etat Livre");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

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
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        ob_end_clean();
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->SetMargins(5, 30, 5);
        $pdf->AddPage();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetMargins(5, 10, 5);
        $html = $this->ReadHtmlEtatLivre($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Etat Livre.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlEtatLivre(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $etat = new LignePieceComptable();
        $html .= $etat->ReadHtmlEtatLivre($request);
        return $html;
    }

    public function executeAfficherEtatBalance(sfWebRequest $request) {
        $compte_min = $request->getParameter('compte_min', '');
        $compte_max = $request->getParameter('compte_max', '');

        $dossier_id = $_SESSION['dossier_id'];
        $exercice = $_SESSION['exercice'];
        $exercice_id = $_SESSION['exercice_id'];

        $date_debut = $request->getParameter('date_debut');
        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = $exercice . '-01-01';

        $date_fin = $request->getParameter('date_fin');
        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = $exercice . '-12-31';

        $comptes_non_solde = $request->getParameter('comptes_non_solde', '');

        $chiffre_1 = $request->getParameter('chiffre_1', 'true');
        $chiffre_2 = $request->getParameter('chiffre_2', 'false');
        $chiffre_3 = $request->getParameter('chiffre_3', 'false');
        $chiffre_4 = $request->getParameter('chiffre_4', 'false');
        $chiffre_5 = $request->getParameter('chiffre_5', 'false');
        $chiffre_6 = $request->getParameter('chiffre_6', 'false');
        $chiffre_7 = $request->getParameter('chiffre_7', 'false');


        $balance = calculBalance::getBalance($compte_min, $compte_max, $date_debut, $date_fin, $comptes_non_solde, $chiffre_1, $chiffre_2, $chiffre_3, $chiffre_4, $chiffre_5, $chiffre_6, $chiffre_7, $dossier_id, $exercice_id);
        return $this->renderPartial("etat_balance", array("balance" => $balance, "date_debut" => $date_debut, "date_fin" => $date_fin, "compte_min" => $compte_min, "compte_max" => $compte_max, "comptes_non_solde" => $comptes_non_solde, "chiffre_1" => $chiffre_1, "chiffre_2" => $chiffre_2, "chiffre_3" => $chiffre_3, "chiffre_4" => $chiffre_4, "chiffre_5" => $chiffre_5, "chiffre_6" => $chiffre_6, "chiffre_7" => $chiffre_7));
    }

    public function executeImprimeEtatBalance(sfWebRequest $request) {
        $pdf = new sfTCPDF("L");

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Etat Balance');
        $pdf->SetSubject("Etat Balance");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

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
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        ob_end_clean();
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->SetMargins(5, 30, 5);
        $pdf->AddPage();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetMargins(5, 10, 5);
        $html = $this->ReadHtmlEtatBalance($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Etat Balance.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlEtatBalance(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $etat = new Plandossiercomptable();
        $html .= $etat->ReadHtmlEtatBalance($request);
        return $html;
    }

//exporter balnce 

    public function executeExporterBalanceExcel_1(sfWebRequest $request) {
//        $dossier_id = $_SESSION['dossier_id'];
//        $exercice_id = $_SESSION['exercice_id'];
//        $compte_min = $request->getParameter('compte_min', '');
//        $compte_max = $request->getParameter('compte_max', '');
//        $date_debut = $request->getParameter('date_debut');
//        $date_fin = $request->getParameter('date_fin');
//        $comptes_non_solde = $request->getParameter('comptes_non_solde', '');
//        $compte_min_comptable = PlanComptableTable::getInstance()->findOneByNumeroCompte($compte_min);
//        $compte_max_comptable = PlanComptableTable::getInstance()->findOneByNumeroCompte($compte_max);
//        $balance = calculBalanceTotaux::getBalance($compte_min, $compte_max, $date_debut, $date_fin, $comptes_non_solde, $dossier_id, $_SESSION['exercice_id']);
//      
        $compte_min = $request->getParameter('compte_min', '');
        $compte_max = $request->getParameter('compte_max', '');

        $dossier_id = $_SESSION['dossier_id'];
        $exercice = $_SESSION['exercice'];
        $exercice_id = $_SESSION['exercice_id'];

        $date_debut = $request->getParameter('date_debut');
        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = $exercice . '-01-01';

        $date_fin = $request->getParameter('date_fin');
        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = $exercice . '-12-31';

        $comptes_non_solde = $request->getParameter('comptes_non_solde', '');

        $chiffre_1 = $request->getParameter('chiffre_1', 'true');
        $chiffre_2 = $request->getParameter('chiffre_2', 'false');
        $chiffre_3 = $request->getParameter('chiffre_3', 'false');
        $chiffre_4 = $request->getParameter('chiffre_4', 'false');
        $chiffre_5 = $request->getParameter('chiffre_5', 'false');
        $chiffre_6 = $request->getParameter('chiffre_6', 'false');
        $chiffre_7 = $request->getParameter('chiffre_7', 'false');

        $balance = calculBalanceTotaux::getBalance($compte_min, $compte_max, $date_debut, $date_fin, $comptes_non_solde, $dossier_id, $exercice_id);

        if ($date_debut != '' && $date_debut != NULL)
            $date_debut = date('d/m/Y', strtotime($date_debut));
        else
            $date_debut = '';
        if ($date_fin != '' && $date_fin != NULL)
            $date_fin = date('d/m/Y', strtotime($date_fin));
        else
            $date_fin = '';

//        $this->date_debut = $date_debut;
//        $this->date_fin = $date_fin;
        $this->balance = $balance;
//        $this->compte_min = $compte_min;
//        $this->compte_min_comptable = $compte_min_comptable;
//        $this->compte_max_comptable = $compte_max_comptable;
//        $this->dossier_id = $dossier_id;
//        $this->exercice_id = $exercice_id;
//        $this->compte_max = $compte_max;
    }

    public function executeAfficherEtatBalanceTotaux(sfWebRequest $request) {
        $compte_min = $request->getParameter('compte_min', '');
        $compte_max = $request->getParameter('compte_max', '');

        $dossier_id = $_SESSION['dossier_id'];
        $exercice = $_SESSION['exercice'];
        $exercice_id = $_SESSION['exercice_id'];

        $date_debut = $request->getParameter('date_debut');
        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = $exercice . '-01-01';

        $date_fin = $request->getParameter('date_fin');
        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = $exercice . '-12-31';

        $comptes_non_solde = $request->getParameter('comptes_non_solde', '');



        $balance = calculBalanceTotaux::getBalance($compte_min, $compte_max, $date_debut, $date_fin, $comptes_non_solde, $dossier_id, $exercice_id);

        return $this->renderPartial("etat_balance_totaux", array("balance" => $balance, "date_debut" => $date_debut, "date_fin" => $date_fin, "compte_min" => $compte_min, "compte_max" => $compte_max, "comptes_non_solde" => $comptes_non_solde));
    }

    public function executeImprimeEtatBalanceTotaux(sfWebRequest $request) {
        $pdf = new sfTCPDF("L");

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Etat Balance Totaux');
        $pdf->SetSubject("Etat Balance Totaux");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins

        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        ob_end_clean();
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->SetPrintHeader(true);
        $pdf->SetPrintFooter(true);
        $pdf->SetMargins(5, 30, 5);
        $pdf->AddPage();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetMargins(5, 10, 5);
        $html = $this->ReadHtmlEtatBalanceTotaux($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Etat Balance Totaux.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlEtatBalanceTotaux(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $etat = new Plandossiercomptable();
        $html .= $etat->ReadHtmlEtatBalanceTotaux($request);
        return $html;
    }

    public function executeAfficherEtatBalanceTiers(sfWebRequest $request) {
        $compte = $request->getParameter('compte_min', '');

        $dossier_id = $_SESSION['dossier_id'];
        $exercice = $_SESSION['exercice'];
        $exercice_id = $_SESSION['exercice_id'];

        $date_debut = $request->getParameter('date_debut');
        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = $exercice . '-01-01';

        $date_fin = $request->getParameter('date_fin');
        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = $exercice . '-12-31';

        $comptes_non_solde = $request->getParameter('comptes_non_solde', '');

        $sous_comptes = PlandossiercomptableTable::getInstance()->findByCompteIdOrderNumero($compte);

        $balance = calculBalanceTiers::getBalance($compte, $sous_comptes->getFirst()->getNumerocompte(), $sous_comptes->getLast()->getNumerocompte(), $date_debut, $date_fin, $comptes_non_solde, $dossier_id, $exercice_id);
        return $this->renderPartial("etat_balance_tiers", array("balance" => $balance, "date_debut" => $date_debut, "date_fin" => $date_fin, "compte_min" => $compte, "comptes_non_solde" => $comptes_non_solde));
    }

    public function executeImprimeEtatBalanceTiers(sfWebRequest $request) {
        $pdf = new sfTCPDF("L");

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Etat Balance Tiers');
        $pdf->SetSubject("Etat Balance Tiers");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

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
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

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
        $html = $this->ReadHtmlEtatBalanceTiers($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Etat Balance Tiers.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlEtatBalanceTiers(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $etat = new Plandossiercomptable();
        $html .= $etat->ReadHtmlEtatBalanceTiers($request);
        return $html;
    }

    public function executeAddLigneClasseCompte(sfWebRequest $request) {
        $plan_dossier_compte_id = $request->getParameter('compte_id');

        $dossier_id = $_SESSION['dossier_id'];

        $date_debut = $request->getParameter('date_debut');
        if ($date_debut != '' && $date_debut != NULL)
            $date_debut = dates::dateFormToBase($date_debut);
        else
            $date_debut = date('Y') . '-01-01';

        $date_fin = $request->getParameter('date_fin');
        if ($date_fin != '' && $date_fin != NULL)
            $date_fin = dates::dateFormToBase($date_fin);
        else
            $date_fin = date('Y') . '-12-31';

        $order = $request->getParameter('order', '');
        $comptes_non_solde = $request->getParameter('comptes_non_solde', '');

        $chiffre_1 = $request->getParameter('chiffre_1', '');
        $chiffre_2 = $request->getParameter('chiffre_2', '');
        $chiffre_3 = $request->getParameter('chiffre_3', '');
        $chiffre_4 = $request->getParameter('chiffre_4', '');
        $chiffre_5 = $request->getParameter('chiffre_5', '');
        $chiffre_6 = $request->getParameter('chiffre_6', '');
        $chiffre_7 = $request->getParameter('chiffre_7', '');
        $chiffre_8 = $request->getParameter('chiffre_8', '');

        $compte_id = PlanDossierComptableTable::getInstance()->find($plan_dossier_compte_id)->getIdPlan();

        $sous_comptes = PlanDossierComptableTable::getInstance()->findByCompteIdOrderNumero($compte_id);
        if ($sous_comptes->count() != 0)
            $balance = calculBalanceSousCompte::getBalanceSousCompte($sous_comptes->getFirst()->getNumeroCompte(), $sous_comptes->getLast()->getNumeroCompte(), $date_debut, $date_fin, $comptes_non_solde, $order, $chiffre_1, $chiffre_2, $chiffre_3, $chiffre_4, $chiffre_5, $chiffre_6, $chiffre_7, $chiffre_8, $dossier_id);
        else
            $balance = null;

        return $this->renderPartial("etat_balance_compte", array("balance" => $balance));
    }

    public function paginateCompte(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $compte_min = $request->getParameter('compte_min', '');
        $compte_max = $request->getParameter('compte_max', '');
        $journal = $request->getParameter('journal', '');

        $date_debut = $request->getParameter('date_debut');
        if ($date_debut != '' && $date_debut != NULL)
            $date_debut = dates::dateFormToBase($date_debut);
        else
            $date_debut = date('Y') . '-01-01';

        $date_fin = $request->getParameter('date_fin');
        if ($date_fin != '' && $date_fin != NULL)
            $date_fin = dates::dateFormToBase($date_fin);
        else
            $date_fin = date('Y') . '-12-31';

        $crediteur = $request->getParameter('crediteur', 'false');

        $debiteur = $request->getParameter('debiteur', 'false');

        $solde = $request->getParameter('solde', 'false');


        $pager = new sfDoctrinePager('PieceComptable', 5);
        $pager->setQuery(LignePieceComptableTable::getInstance()->loadEtat($compte_min, $compte_max, $date_debut, $date_fin, $crediteur, $debiteur, $solde));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

}
