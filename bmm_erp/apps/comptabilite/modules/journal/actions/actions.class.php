<?php

/**
 * journal actions.
 *
 * @package    sw-commerciale
 * @subpackage journal
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class journalActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeTestexistancejournal(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $code = $params['code'];
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT journalcomptable.id as id, journalcomptable.code as code "
                    . " FROM journalcomptable"
                    . " WHERE trim(journalcomptable.code) ='" . $code . "'";

            $resultat = $conn->fetchAssoc($query);
            $resultat = json_encode($resultat);
            die($resultat);
        }

        die("Erreur");
    }

    public function paginate(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $code = strtoupper($request->getParameter('code', ''));
        $libelle = strtoupper($request->getParameter('libelle', ''));
        $type_journal = $request->getParameter('type_journal', '0');
        $exercice = $request->getParameter('exercice', '0');

        $pager = new sfDoctrinePager('Journalcomptable', 10);
        $pager->setQuery(JournalcomptableTable::getInstance()->load($code, $libelle, $type_journal, $exercice));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeIndex(sfWebRequest $request) {
        $this->type_journals = TypejournalTable::getInstance()->findAll();
        $this->exercices = ExerciceTable::getInstance()->findAll();
        $this->pager = $this->paginate($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste", array("pager" => $this->pager));
        }
    }

    public function executeNew(sfWebRequest $request) {
        $this->comptes = PlancomptableTable::getInstance()->getPlanComptableOrderByNumeroForSelect();
        $this->type_journals = TypejournalTable::getInstance()->findAll();
        $this->dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);
    }

    public function executeGenererNumerotation(sfWebRequest $request) {
        $this->numerotation = $request->getParameter('numerotation');
        $this->date_debut = $request->getParameter('date_debut');
        $this->date_fin = $request->getParameter('date_fin');
    }

    public function executeGererComptesDossier(sfWebRequest $request) {
        $dossier = $_SESSION['dossier_id'];
        $classe_compte = ClassecompteTable::getInstance()->findAll();
        $comptes = PlanComptableTable::getInstance()->loadByDossier($dossier);
        return $this->renderPartial("list_comptes", array("comptes" => $comptes, 'classe_compte' => $classe_compte));
    }

    public function executeShow(sfWebRequest $request) {
        $this->journal = JournalcomptableTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeShowEdit(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->journal = JournalComptableTable::getInstance()->find($id);
        $this->comptes = PlanComptableTable::getInstance()->getPlanComptableOrderByNumero();
        $this->type_journals = TypeJournalTable::getInstance()->findAll();
        $this->dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);
    }

    public function executeVerifierExistance(sfWebRequest $request) {
        $dossier = $request->getParameter('dossier');
        $code_comptable = $request->getParameter('code_comptable');
        $intitule = $request->getParameter('intitule');
        $journal_id = $request->getParameter('journal_id', '');

        $journal_exist = JournalComptableTable::getInstance()->findByCodeAndLibelle($dossier, $code_comptable, $intitule, $journal_id);
        $count = $journal_exist->count();

        if ($count != 0)
            return $this->renderText('0');
        else {
            $journal_exist_autre = JournalComptableTable::getInstance()->findByCodeAndLibelle('', $code_comptable, $intitule, $journal_id);
            $count_autre = $journal_exist_autre->count();
            if ($count_autre != 0)
                return $this->renderText('1');
            else {
                return $this->renderText('2');
            }
        }
    }

    public function executeSave(sfWebRequest $request) {
        $numerotation = $request->getParameter('numerotation');
        $date_debut_cloture = $request->getParameter('date_debut_cloture');
        $date_fin_cloture = $request->getParameter('date_fin_cloture');
        $type_journal = $request->getParameter('type_journal');
        $choix_contre_partie = $request->getParameter('choix_contre_partie');
        $dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);
        $journal = new Journalcomptable();
        $journal->setCode($request->getParameter('code_comptable'));
        $journal->setLibelle($request->getParameter('intitule'));
        $journal->setDate(date('Y-m-d'));
        $journal->setNumerotation($numerotation);
        $journal->setDatedebutcloture($date_debut_cloture);
        $journal->setDatefincloture($date_fin_cloture);
        if (intval($type_journal) > 0 && $type_journal != '')
            $journal->setIdTypeJournal($type_journal);
        if ($choix_contre_partie == 'true')
            $journal->setIdComptecontrepartie($request->getParameter('contre_partie'));
        $exercie_courant = $_SESSION['exercice_id'];
        $journal->setIdExercice($exercie_courant);
        $journal->setIdDossier($dossier);
        $comptes = explode(',', $request->getParameter('comptes'));
        for ($i = 0; $i < sizeof($comptes); $i++) {
            if ($comptes[$i] != '') {
                $souscompte = new Souscomptejournal();
                $souscompte->setIdSouscompte($comptes[$i]);
                $journal->getSouscomptejournal()->add($souscompte);
            }
        }
        if ($numerotation == 1) {
            $list_numserie = NumerotationSerie::genererNumerotationAnnuel($date_debut_cloture, $date_fin_cloture);
            $list_numserie_bloque = $request->getParameter('numserie');
//            if ($list_numserie_bloque != '') {
//                $numserie_bloque = explode(',', $list_numserie_bloque);
//                if ($list_numserie[0]) {
//                    $num_serie = new Numeroseriejournal();
//                    $num_serie->setPrefixe($list_numserie['prefix'])
//                            ->setDatedebut($list_numserie['datedebut'])
//                            ->setDatefin($list_numserie['datefin'])
//                            ->setNumerodebut($list_numserie['numdebut'])
//                            ->setNumerofin($list_numserie['numfin'])
//                            ->setAttendu($list_numserie['attendu'])
//                            ->setIsbloque($numserie_bloque[0]);
//                    $journal->getNumeroseriejournal()->add($num_serie);
//                }
//            } else {
            if ($list_numserie['prefix']) {
                $num_serie = new Numeroseriejournal();
                $num_serie->setPrefixe($list_numserie['prefix'])
                        ->setDatedebut($list_numserie['datedebut'])
                        ->setDatefin($list_numserie['datefin'])
                        ->setNumerodebut($list_numserie['numdebut'])
                        ->setNumerofin($list_numserie['numfin'])
                        ->setAttendu($list_numserie['attendu'])
                        ->setIsbloque($list_numserie['bloque']);
                $journal->getNumeroseriejournal()->add($num_serie);
//                }
            }
        }
        if ($numerotation == 2) {
            $list_numserie = NumerotationSerie::genererNumerotationMensuel($date_debut_cloture, $date_fin_cloture);

            $list_numserie_bloque = $request->getParameter('numserie');
            if ($list_numserie_bloque != '') {
                $numserie_bloque = explode(',', $list_numserie_bloque);
                for ($i = 0; $i < sizeof($list_numserie); $i++) {
                    if ($list_numserie[$i]) {
                        $num_serie = new Numeroseriejournal();
                        $num_serie->setPrefixe($list_numserie[$i]['prefix'])
                                ->setDatedebut($list_numserie[$i]['datedebut'])
                                ->setDatefin($list_numserie[$i]['datefin'])
                                ->setNumerodebut($list_numserie[$i]['numdebut'])
                                ->setNumerofin($list_numserie[$i]['numfin'])
                                ->setAttendu($list_numserie[$i]['attendu'])
                                ->setIsbloque($numserie_bloque[$i]);
                        $journal->getNumeroseriejournal()->add($num_serie);
                    }
                }
            } else {
                for ($i = 0; $i < sizeof($list_numserie); $i++) {
                    if ($list_numserie[$i]) {
                        $num_serie = new Numeroseriejournal();
                        $num_serie->setPrefixe($list_numserie[$i]['prefix'])
                                ->setDatedebut($list_numserie[$i]['datedebut'])
                                ->setDatefin($list_numserie[$i]['datefin'])
                                ->setNumerodebut($list_numserie[$i]['numdebut'])
                                ->setNumerofin($list_numserie[$i]['numfin'])
                                ->setAttendu($list_numserie[$i]['attendu'])
                                ->setIsbloque($list_numserie[$i]['bloque']);
                        $journal->getNumeroseriejournal()->add($num_serie);
                    }
                }
            }
        }

        $journal->save();
    }

    public function executeSaveEdit(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $generation_permission = $request->getParameter('generation_permission');
        $generation_compte_comptable = $request->getParameter('generation_compte_comptable');

        //S'il y a une nouvelle génération des comptes comptables
        if ($generation_compte_comptable == 1) {
            SousCompteJournalTable::getInstance()->deleteByJournal($id);
        }
        //S'il y a une nouvelle génération des numérotatioins de séries
        if ($generation_permission == 1) {
            NumeroseriejournalTable::getInstance()->deleteByJournal($id);
        }

        $numerotation = $request->getParameter('numerotation');
        $date_debut_cloture = $request->getParameter('date_debut_cloture');
        $date_fin_cloture = $request->getParameter('date_fin_cloture');
        $code_comptable = $request->getParameter('code_comptable');
        $intitule = $request->getParameter('intitule');
        $type_journal = $request->getParameter('type_journal');
        $contre_partie = $request->getParameter('contre_partie');

        $journal = JournalcomptableTable::getInstance()->find($id);

        $journal->setCode($code_comptable);
        $journal->setLibelle($intitule);
        $journal->setNumerotation($numerotation);
        $journal->setDatedebutcloture($date_debut_cloture);
        $journal->setDatefincloture($date_fin_cloture);
        if (intval($type_journal) > 0 && $type_journal != '')
            $journal->setIdTypeJournal($type_journal);
        if (intval($contre_partie) > 0 && $contre_partie != '')
            $journal->setIdComptecontrepartie($contre_partie);
        else
            $journal->setIdComptecontrepartie(null);

        //S'il y a une nouvelle génération des comptes comptables
        if ($generation_compte_comptable == 1) {
            $comptes = explode(',', $request->getParameter('comptes'));

            for ($i = 0; $i < sizeof($comptes); $i++) {
                if ($comptes[$i] != '') {
                    $souscompte = new Souscomptejournal();
                    $souscompte->setIdSouscompte($comptes[$i]);
                    $journal->getSouscomptejournal()->add($souscompte);
                }
            }
        }

        //S'il y a une nouvelle génération des numérotatioins de séries
        if ($generation_permission == 1) {
            if ($numerotation == 1) {
                $list_numserie = NumerotationSerie::genererNumerotationAnnuel($date_debut_cloture, $date_fin_cloture);
                $list_numserie_bloque = $request->getParameter('numserie');
                if ($list_numserie_bloque != '') {
                    $numserie_bloque = explode(',', $list_numserie_bloque);
//                    if ($list_numserie[0]) {
//                        $num_serie = new NumeroSerieJournal();
//                        $num_serie->setPrefixe($list_numserie['prefix'])
//                                ->setDatedebut($list_numserie['datedebut'])
//                                ->setDatefin($list_numserie['datefin'])
//                                ->setNumerodebut($list_numserie['numdebut'])
//                                ->setNumerofin($list_numserie['numfin'])
//                                ->setAttendu($list_numserie['attendu'])
//                                ->setIsbloque($numserie_bloque[0]);
//                        $journal->getNumeroseriejournal()->add($num_serie);
//                    }
//                } else {
//
//                    if ($list_numserie['prefix']) {
                    $num_serie = new NumeroSerieJournal();
                    $num_serie->setPrefixe($list_numserie['prefix'])
                            ->setDatedebut($list_numserie['datedebut'])
                            ->setDatefin($list_numserie['datefin'])
                            ->setNumerodebut($list_numserie['numdebut'])
                            ->setNumerofin($list_numserie['numfin'])
                            ->setAttendu($list_numserie['attendu'])
                            ->setIsbloque($list_numserie['bloque']);
                    $journal->getNumeroseriejournal()->add($num_serie);
//                    }
                }
            }
            if ($numerotation == 2) {
                $list_numserie = NumerotationSerie::genererNumerotationMensuel($date_debut_cloture, $date_fin_cloture);

                $list_numserie_bloque = $request->getParameter('numserie');
                if ($list_numserie_bloque != '') {
                    $numserie_bloque = explode(',', $list_numserie_bloque);
                    for ($i = 0; $i < sizeof($list_numserie); $i++) {
                        if ($list_numserie[$i]) {
                            $num_serie = new NumeroSerieJournal();
                            $num_serie->setPrefixe($list_numserie[$i]['prefix'])
                                    ->setDatedebut($list_numserie[$i]['datedebut'])
                                    ->setDatefin($list_numserie[$i]['datefin'])
                                    ->setNumerodebut($list_numserie[$i]['numdebut'])
                                    ->setNumerofin($list_numserie[$i]['numfin'])
                                    ->setAttendu($list_numserie[$i]['attendu'])
                                    ->setIsbloque($numserie_bloque[$i]);
                            $journal->getNumeroseriejournal()->add($num_serie);
                        }
                    }
                } else {
                    for ($i = 0; $i < sizeof($list_numserie); $i++) {
                        if ($list_numserie[$i]) {
                            $num_serie = new NumeroSerieJournal();
                            $num_serie->setPrefixe($list_numserie[$i]['prefix'])
                                    ->setDatedebut($list_numserie[$i]['datedebut'])
                                    ->setDatefin($list_numserie[$i]['datefin'])
                                    ->setNumerodebut($list_numserie[$i]['numdebut'])
                                    ->setNumerofin($list_numserie[$i]['numfin'])
                                    ->setAttendu($list_numserie[$i]['attendu'])
                                    ->setIsbloque($list_numserie[$i]['bloque']);
                            $journal->getNumeroseriejournal()->add($num_serie);
                        }
                    }
                }
            }
        }

        $journal->save();
    }

    public function executeGoPage(sfWebRequest $request) {
        $pager = $this->paginate($request);
        return $this->renderPartial("journal/liste", array("pager" => $pager));
    }

    public function executeDelete(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $journal = JournalComptableTable::getInstance()->find($id);
        SousCompteJournalTable::getInstance()->deleteByJournal($id);
        NumeroseriejournalTable::getInstance()->deleteByJournal($id);
        $journal->delete();

        $pager = $this->paginate($request);
        return $this->renderPartial("journal/liste", array("pager" => $pager));
    }

    public function executeListePlanJournal(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $numero = $request->getParameter('numero', '');
        $libelle = $request->getParameter('libelle', '');

        $this->classe_compte = ClassecompteTable::getInstance()->findAll();
        $this->comptes = PlancomptableTable::getInstance()->loadByJournal($id, $numero, $libelle);
        $this->journal = $id;
    }

    public function executeListeNumSerie(sfWebRequest $request) {
        $this->series = NumeroseriejournalTable::getInstance()->findByIdJournal($request->getParameter('id'));
        $this->journal = $request->getParameter('id');
    }

    public function executeDeleteCompteJournal(sfWebRequest $request) {
        $compte = $request->getParameter('compte');
        $journal = $request->getParameter('journal');

        $compte_journal = SouscomptejournalTable::getInstance()->findOneByIdSouscompteAndIdJournal($compte, $journal);
        $compte_journal->delete();

        $numero = $request->getParameter('numero', '');
        $libelle = $request->getParameter('libelle', '');
        $comptes = PlancomptableTable::getInstance()->loadByJournal($journal, $numero, $libelle);
        return $this->renderPartial("list_comptes_journal", array("comptes" => $comptes, "journal" => $journal));
    }

    public function executeBloquerCompteJournal(sfWebRequest $request) {
        $num = $request->getParameter('num');
        $journal = $request->getParameter('journal');

        $compte_journal = SouscomptejournalTable::getInstance()->findOneByIdSouscompteAndIdJournal($num, $journal);
        if ($compte_journal->getIsbloque() == 1)
            $compte_journal->setIsbloque(0);
        else
            $compte_journal->setIsbloque(1);

        $compte_journal->save();

        $numero = $request->getParameter('numero', '');
        $libelle = $request->getParameter('libelle', '');
        $comptes = PlancomptableTable::getInstance()->loadByJournal($journal, $numero, $libelle);
        return $this->renderPartial("list_comptes_journal", array("comptes" => $comptes, "journal" => $journal));
    }

    public function executeSaveAttendu(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $attendu = $request->getParameter('attendu');

//        die($id);
        $numeroserie = NumeroseriejournalTable::getInstance()->findOneById($id);
        $numeroserie->setAttendu($attendu);
        $numeroserie->save();
        die('bien');
    }

    public function executeBloquerNumSerieJournal(sfWebRequest $request) {
        $num = $request->getParameter('num');
        $journal = $request->getParameter('journal');

        $serie = NumeroseriejournalTable::getInstance()->find($num);
        if ($serie->getIsbloque() == 1)
            $serie->setIsbloque(0);
        else {
            $pieces_non_valide = PiececomptableTable::getInstance()->findByIdSerieAndValide($num, 0);
            if ($pieces_non_valide->count() == 0)
                $serie->setIsbloque(1);
        }
        $serie->save();

        $numSeries = NumeroseriejournalTable::getInstance()->findByIdJournalAndIsbloque($journal, 0);
        if ($numSeries->count() == 0) {
            $journal_bloque = JournalcomptableTable::getInstance()->find($journal);
            $journal_bloque->setIsbloque(1);
            $journal_bloque->save();
        }
        if ($numSeries->count() != 0) {
            $journal_bloque = JournalcomptableTable::getInstance()->find($journal);
            $journal_bloque->setIsbloque(0);
            $journal_bloque->save();
        }

        $series = NumeroseriejournalTable::getInstance()->findByIdJournal($journal);
        return $this->renderPartial("liste_numero_serie", array("series" => $series, "journal" => $journal));
    }

    public function executeValiderNumSerieJournal(sfWebRequest $request) {
        $num = $request->getParameter('num');
        $journal = $request->getParameter('journal');

        $serie = NumeroseriejournalTable::getInstance()->find($num);
        if ($serie->getIsvalide() == 1)
            $serie->setIsvalide(0);
        else
            $serie->setIsvalide(1);
        $serie->save();

        $numSeries = NumeroseriejournalTable::getInstance()->findByIdJournalAndIsvalide($journal, 0);
        if ($numSeries->count() == 0) {
            $journal_bloque = JournalcomptableTable::getInstance()->find($journal);
            $journal_bloque->setIsvalide(1);
            $journal_bloque->save();
        }
        if ($numSeries->count() != 0) {
            $journal_bloque = JournalcomptableTable::getInstance()->find($journal);
            $journal_bloque->setIsvalide(0);
            $journal_bloque->save();
        }

        $series = NumeroseriejournalTable::getInstance()->findByIdJournal($journal);
        return $this->renderPartial("liste_numero_serie", array("series" => $series, "journal" => $journal));
    }

    public function executeBloquerNumSerieJournalTous(sfWebRequest $request) {
        $check_bloque = $request->getParameter('check_bloque');
        $journal = $request->getParameter('journal');
        if ($check_bloque == 1) {
            $numSeries = NumeroseriejournalTable::getInstance()->findByIdJournal($journal);
            foreach ($numSeries as $numSerie) {
                $numSerie->setIsbloque(0);
                $numSerie->save();
            }

            $journal_bloque = JournalcomptableTable::getInstance()->find($journal);
            $journal_bloque->setIsbloque(0);
            $journal_bloque->save();
        } else {
            $numSeries = NumeroseriejournalTable::getInstance()->findByIdJournal($journal);
            foreach ($numSeries as $numSerie) {
                $numSerie->setIsbloque(1);
                $numSerie->save();
            }

            $journal_bloque = JournalcomptableTable::getInstance()->find($journal);
            $journal_bloque->setIsbloque(1);
            $journal_bloque->save();
        }

        $series = NumeroseriejournalTable::getInstance()->findByIdJournal($journal);
        return $this->renderPartial("liste_numero_serie", array("series" => $series, "journal" => $journal));
    }

    public function executeValiderNumSerieJournalTous(sfWebRequest $request) {
        $check_valide = $request->getParameter('check_valide');
        $journal = $request->getParameter('journal');
        if ($check_valide == 1) {
            $numSeries = NumeroseriejournalTable::getInstance()->findByIdJournal($journal);
            foreach ($numSeries as $numSerie) {
                $numSerie->setIsValide(0);
                $numSerie->save();
            }

            $journal_bloque = JournalcomptableTable::getInstance()->find($journal);
            $journal_bloque->setIsvalide(0);
            $journal_bloque->save();
        } else {
            $numSeries = NumeroseriejournalTable::getInstance()->findByIdJournal($journal);
            foreach ($numSeries as $numSerie) {
                $numSerie->setIsvalide(1);
                $numSerie->save();
            }

            $journal_bloque = JournalcomptableTable::getInstance()->find($journal);
            $journal_bloque->setIsvalide(1);
            $journal_bloque->save();
        }

        $series = NumeroseriejournalTable::getInstance()->findByIdJournal($journal);
        return $this->renderPartial("liste_numero_serie", array("series" => $series, "journal" => $journal));
    }

    public function executeBloquerJournal(sfWebRequest $request) {
        $journal_bloque = JournalcomptableTable::getInstance()->find($request->getParameter('id'));
        if ($journal_bloque->getIsbloque() == 1) {
            $journal_bloque->setIsbloque(0);
            $numSeries = NumeroseriejournalTable::getInstance()->findByIdJournal($request->getParameter('id'));
            foreach ($numSeries as $numSerie) {
                $numSerie->setIsbloque(0);
                $numSerie->save();
            }
        } else {
            $journal_bloque->setIsbloque(1);
            $numSeries = NumeroseriejournalTable::getInstance()->findByIdJournal($request->getParameter('id'));
            foreach ($numSeries as $numSerie) {
                $numSerie->setIsbloque(1);
                $numSerie->save();
            }
        }
        $journal_bloque->save();

        $pager = $this->paginate($request);
        return $this->renderPartial("liste", array("pager" => $pager));
    }

    public function executeValiderJournal(sfWebRequest $request) {
        $journal_valide = JournalcomptableTable::getInstance()->find($request->getParameter('id'));
        if ($journal_valide->getIsvalide() == 1) {
            $journal_valide->setIsvalide(0);
            $numSeries = NumeroseriejournalTable::getInstance()->findByIdJournal($request->getParameter('id'));
            foreach ($numSeries as $numSerie) {
                $numSerie->setIsvalide(0);
                $numSerie->save();
            }
        } else {
            $journal_valide->setIsvalide(1);
            $numSeries = NumeroseriejournalTable::getInstance()->findByIdJournal($request->getParameter('id'));
            foreach ($numSeries as $numSerie) {
                $numSerie->setIsvalide(1);
                $numSerie->save();
            }
        }
        $journal_valide->save();

        $pager = $this->paginate($request);
        return $this->renderPartial("liste", array("pager" => $pager));
    }

    public function executeEtatJournal(sfWebRequest $request) {
        
    }

    public function executeImportation(sfWebRequest $request) {
        $this->journals = JournalcomptableTable::getInstance()->findAll();
        $this->dossiers = DossiercomptableTable::getInstance()->findAll();
        $this->all_exercice = ExerciceTable::getInstance()->getAll();
//        $this->all_exercice==ExerciceTable::getInstance()->getAllByDossier($_SESSION['dossier_id']);
    }

    public function executeGetJournalForImportation(sfWebRequest $request) {
        $exercice_id = $request->getParameter('exercice_id');
        $dossier_id = $request->getParameter('dossier_id');
        $journals = JournalcomptableTable::getInstance()->findByIdExerciceAndIdDossier($exercice_id, $dossier_id);
        return $this->renderPartial("journal/listejournal", array('journals' => $journals));
    }

    public function executeSaveImportation(sfWebRequest $request) {

        $courant_dossier = $request->getParameter('courant_dossier');
        $courant_exercice = $request->getParameter('courant_exercice');
        $journals = $request->getParameter('journals');
        $journals = explode(',', $journals);

        $exercice = ExerciceTable::getInstance()->find($courant_exercice);

        for ($i = 0; $i < sizeof($journals); $i++) {
            if ($journals[$i] != '') {
                $journal_ancien = JournalcomptableTable::getInstance()->find($journals[$i]);
                $journal_new = new Journalcomptable();

                $journal_new->setCode($journal_ancien->getCode());
                $journal_new->setLibelle($journal_ancien->getLibelle());
                $journal_new->setNumerotation($journal_ancien->getNumerotation());
                $journal_new->setIssimule($journal_ancien->getIssimule());
                $journal_new->setIsIntegrer(0);
                $journal_new->setDate(date('Y-m-d'));
                $journal_new->setIscloture(0);
                $journal_new->setDatedebutcloture($exercice->getDateDebut());
                $journal_new->setDatefincloture($exercice->getDateFin());
                $journal_new->setIsbloque(0);
                $journal_new->setIsvalide(0);
                $journal_new->setIdTypeJournal($journal_ancien->getIdTypeJournal());
                $journal_new->setIdComptecontrepartie($journal_ancien->getIdComptecontrepartie());
                $journal_new->setIdDossier($courant_dossier);
                $journal_new->setIdExercice($courant_exercice);

                $journal_new->save();

                $comptes_ancien = SouscomptejournalTable::getInstance()->findByIdJournal($journals[$i]);
                foreach ($comptes_ancien as $c_a) {
                    $souscompte = new Souscomptejournal();
                    $souscompte->setIdSouscompte($c_a->getIdSouscompte());
                    $souscompte->setIdJournal($journal_new->getId());
                    $souscompte->save();
                }

                $num_serie_ancien = NumeroseriejournalTable::getInstance()->findByIdJournal($journals[$i]);
                $date_debut_cloture = $journal_new->getDatedebutcloture();
                $date_fin_cloture = $journal_new->getDatefincloture();
                $numerotation = $journal_new->getNumerotation();
                if ($numerotation == 1) {
                    $list_numserie = NumerotationSerie::genererNumerotationAnnuel($date_debut_cloture, $date_fin_cloture);


//                    if ($list_numserie[0]) {

                    $num_serie = new Numeroseriejournal();
                    $num_serie->setPrefixe($list_numserie['prefix'])
                            ->setDatedebut($list_numserie['datedebut'])
                            ->setDatefin($list_numserie['datefin'])
                            ->setNumerodebut($list_numserie['numdebut'])
                            ->setNumerofin($list_numserie['numfin'])
                            ->setAttendu($list_numserie['attendu'])
                            ->setIsbloque(0)
                            ->setIdJournal($journal_new->getId())
                            ->save();
//                    }
                }
                if ($numerotation == 2) {
                    $list_numserie = Numerotationserie::genererNumerotationMensuel($date_debut_cloture, $date_fin_cloture);
                    for ($j = 0; $j < sizeof($list_numserie); $j++) {
                        if ($list_numserie[$j]) {

                            $num_serie = new Numeroseriejournal();
                            $num_serie->setPrefixe($list_numserie[$j]['prefix'])
                                    ->setDatedebut($list_numserie[$j]['datedebut'])
                                    ->setDatefin($list_numserie[$j]['datefin'])
                                    ->setNumerodebut($list_numserie[$j]['numdebut'])
                                    ->setNumerofin($list_numserie[$j]['numfin'])
                                    ->setAttendu($list_numserie[$j]['attendu'])
                                    ->setIsbloque(0)
                                    ->setIdJournal($journal_new->getId())
                                    ->save();
                        }
                    }
                }
            }
        }
        die('ok');
//        return true;
    }

    public function executeGetJournalDejaImporte(sfWebRequest $request) {
        $exercice_id = $request->getParameter('exercice_id');
        $dossier_id = $request->getParameter('dossier_id');
        $ex_dossier_id = $request->getParameter('ex_dossier_id');
        $ex_exercice_id = $request->getParameter('ex_exercice_id');
        $this->dossier = DossiercomptableTable::getInstance()->find($dossier_id);
        $this->exercice = ExerciceTable::getInstance()->find($exercice_id);
        $this->journal_importe = JournalcomptableTable::getInstance()->findByIdExerciceAndIdDossier($exercice_id, $dossier_id);

        $this->journals = JournalcomptableTable::getInstance()->findByIdExerciceAndIdDossier($ex_exercice_id, $ex_dossier_id);
    }

    public function executeReportNouveau(sfWebRequest $request) {

        $dossier_id = $_SESSION['dossier_id'];
        $exercice_suivant = ExerciceTable::getInstance()->getByLibelle($_SESSION['exercice'] + 1)->getFirst();
        $exercice_id = $exercice_suivant->getId();
//$exercice_id=26;
        $this->journals = JournalcomptableTable::getInstance()->getAllSaufRan($dossier_id, $exercice_id);
        $this->journalRan = JournalcomptableTable::getInstance()->getRan($dossier_id, $exercice_id);
    }

    public function executeAfficherReportNouveau(sfWebRequest $request) {
        $exercice_id = $_SESSION['exercice_id'];
        $dossier_id = $_SESSION['dossier_id'];
        $report = calculReport::getReport($exercice_id, $dossier_id);

        return $this->renderPartial("list_comptes_report", array("report" => $report));
    }

    public function executeSaveReportNouveau(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $exercice_suivant = ExerciceTable::getInstance()->getByLibelle($_SESSION['exercice'] + 1)->getFirst();
//        $exercice_antireur = ExerciceTable::getInstance()->getByLibelle($_SESSION['exercice'] - 1)->getFirst();
        $journal = $request->getParameter('journal');
        $date = $request->getParameter('date');
        $compte = $request->getParameter('compte');

        $total_debit = $request->getParameter('total_debit');
        $total_debit = str_replace(' ', '', $total_debit);
        if ($total_debit == '')
            $total_debit = 0;
        $total_credit = $request->getParameter('total_credit');
        $total_credit = str_replace(' ', '', $total_credit);
        if ($total_credit == '')
            $total_credit = 0;

        $serie = NumeroseriejournalTable::getInstance()->getSerie($journal, $date)->getFirst();
      
        if (count($serie) > 0)
            $numero = trim($serie->getPrefixe()) . sprintf("%04s", $serie->getAttendu());
        $user = $this->getUser()->getAttribute('userB2m');

        $piece = new Piececomptable();

        $piece->setIdJournalcomptable($journal);
        $piece->setDate($date);
        $piece->setDatecreation(date('Y-m-d'));
        $piece->setIdUser($user->getId());
        $piece->setNumero($numero);
        $piece->setIdSerie($serie->getId());
        $piece->setTotaldebit(0);
        $piece->setTotalcredit(0);
        $piece->setLibelle('Report à Nouveau');
        $piece->setIdExercice($exercice_suivant->getId());
        $piece->save();

        $attendu = $serie->getAttendu() + 1;
        $this->updateAttendu($serie->getId(), $attendu);

        $date_ligne = date('Y-m-d');
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $query_solde = "UPDATE plandossiercomptable "
                . "set soldeouv = (SELECT  pdc.solde FROM plandossiercomptable pdc,plancomptable pl "
                . "WHERE plandossiercomptable.numerocompte = pdc.numerocompte "
                . "AND pdc.id_exercice = " . $exercice_id
                . " AND pdc.id_dossier = " . $dossier_id
                . " and pl.id_classe  in (1,2,3,4,5) "
                . " and pdc.id_plan=pl.id)"
                . "where plandossiercomptable.id_exercice = " . $exercice_suivant->getId() . " "
                . "AND plandossiercomptable.id_dossier = " . $dossier_id
        ;

        $resultat_solde = $conn->fetchAssoc($query_solde);
//        die('query'.$query_solde);
//die($query_solde);
        //Insertion des soldes des comptes comptables dans des lignes piece comptable
//        $resultat_insert = $conn->fetchAssoc($query_insert);
        //Mise à jour des soldes des comptes comptables des lignes déjà inserés

        $ligne_piece = new Lignepiececomptable();
        $ligne_piece->setIdComptecomptable($compte);
        $ligne_piece->setDate(date('Y-m-d'));
        $ligne_piece->setLettrelettrage('');
        if ($total_debit != 0)
            $ligne_piece->setMontantdebit($total_debit);
        if ($total_credit != 0)
            $ligne_piece->setMontantcredit($total_credit);
        $ligne_piece->setIdPiececomptable($piece->getId());

        $ligne_piece->save();
//die($ligne_piece->getId().'h');
        //Mise à jour de solde du compte comptable du ligne déjà inseré
        $compte_comptable_ligne = PlandossiercomptableTable::getInstance()->findOneById($compte);
//        
        $solde = -($total_debit - $total_credit);
//        die($total_debit- $total_credit.'m');
        $compte_comptable_ligne->setSoldeouv(-1 * $solde);
        $compte_comptable_ligne->setSolde($solde);
        $compte_comptable_ligne->save();

        $query_insert = "INSERT INTO lignepiececomptable"
                . "(date, montantdebit, montantcredit, id_piececomptable, id_comptecomptable)"
                . "select '" . $date_ligne . "', 
                    case WHEN plandossiercomptable.solde>=0 then abs(plandossiercomptable.solde) else 0 end, 
                    case WHEN plandossiercomptable.solde<0 then abs(plandossiercomptable.solde) else 0 end,
                    " . $piece->getId() . ",pl.id 
                    from plandossiercomptable,plancomptable,plandossiercomptable pl  
                    where plandossiercomptable.id_exercice=" . $exercice_id . "
                    and pl.id_plan=plancomptable.id 
                    and pl.id_exercice=" . $exercice_suivant->getId() . "
                    and plandossiercomptable.id_plan = plancomptable.id
                    and plancomptable.id_classe not in (6,7) 
                    and plandossiercomptable.numerocompte=pl.numerocompte 
                    and plandossiercomptable.id_dossier = " . $dossier_id . " and pl.id_dossier=" . $dossier_id

        ;
        $resultat_insert = $conn->fetchAssoc($query_insert);
        //Calculer Total débit & Total crédit de la pièce comptable
        $totaux = PiececomptableTable::getInstance()->getTotauxLignes($piece->getId())->getFirst();

        $piece->setTotaldebit($totaux->getDebit());
        $piece->setTotalcredit($totaux->getCredit());

        $piece->save();

        //set Exporte pour Exercice anterieur
        $dossier_exercice = DossierExerciceTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id)->getFirst();

        $dossier_exercice->setExporte(true);
        $dossier_exercice->save();

        $query_solde_plan = "UPDATE plandossiercomptable "
                . "set solde =( -1) * solde "
                . "where plandossiercomptable.id_exercice = " . $exercice_suivant->getId() . " "
                . "AND plandossiercomptable.id_dossier = " . $dossier_id
        ;

        $resultat_solde = $conn->fetchAssoc($query_solde_plan);
        return true;
    }

    public function updateAttendu($serie_id, $attendu) {
        $numero_serie = NumeroserieJournalTable::getInstance()->find($serie_id);
        $test_numero = trim($numero_serie->getPrefixe()) . sprintf("%03s", $attendu);

        $pieces = PiececomptableTable::getInstance()->findByNumero($test_numero);
//        if ($pieces->count() == 0) {
            $numero_serie->setAttendu($attendu);
            $numero_serie->save();
//        } else {
//            $attendu = $attendu + 1;
//            //appel recursif
//            $this->updateAttendu($serie_id, $attendu);
//        }
    }

    //********afiichage contre partie 
    public function executeAfficheContrepartie(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idtypejournal = $params['id_typejournal'];
//            if ($idtypejournal = 3) {
//                $id_class = 5;
//            }
//            if ($idtypejournal = 2) {
//                $id_class = 4;
//            }
//            if ($idtypejournal = 1) {
//                $id_class = 7;
//            }

            if ($idtypejournal == 3) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT plancomptable.id as id ,"
                        . "CONCAT( plancomptable.numerocompte,plancomptable.libelle )as libelle "
                        . " FROM plancomptable,journalcomptable,typejournal,classecompte,plandossiercomptable"
                        . " WHERE journalcomptable.id_comptecontrepartie=plancomptable.id"
                        . " and journalcomptable.id_type_journal= typejournal.id"
                        . " and journalcomptable.id_type_journal=" . 3
                        . " and plancomptable.id_classe= classecompte.id"
                        . " and plancomptable.id_classe = " . 5
                        . " and length(plandossiercomptable.numerocompte)>=7"
                        . " group by plancomptable.id "
                ;

                $resultat = $conn->fetchAssoc($query);

                die(json_encode($resultat));
            }
            if ($idtypejournal == 2) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT plancomptable.id as id ,"
                        . "CONCAT( plancomptable.numerocompte,plancomptable.libelle )as libelle "
                        . " FROM plancomptable,journalcomptable,typejournal,classecompte,plandossiercomptable"
                        . " WHERE journalcomptable.id_comptecontrepartie=plancomptable.id"
                        . " and journalcomptable.id_type_journal= typejournal.id"
                        . " and journalcomptable.id_type_journal=" . 2
                        . " and length(plandossiercomptable.numerocompte)>=7"
                        . " and plancomptable.id_classe= classecompte.id"
                        . " and (plancomptable.id_classe = " . 4 . "or plancomptable.id_classe = " . 6 . ")"
                        . " group by plancomptable.id "
                ;
                $resultat = $conn->fetchAssoc($query);

                die(json_encode($resultat));
            }
            if ($idtypejournal == 1) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT plancomptable.id as id ,"
                        . "CONCAT( plancomptable.numerocompte,plancomptable.libelle )as libelle "
                        . " FROM plancomptable,journalcomptable,typejournal,classecompte,plandossiercomptable"
                        . " WHERE journalcomptable.id_comptecontrepartie=plancomptable.id"
                        . " and journalcomptable.id_type_journal= typejournal.id"
                        . " and length(plandossiercomptable.numerocompte)>=7"
                        . " and journalcomptable.id_type_journal=" . 2
                        . " and plancomptable.id_classe= classecompte.id"
                        . " and (plancomptable.id_classe = " . 4 . "or plancomptable.id_classe = " . 7 . ")"
                        . " group by plancomptable.id "
                ;
                $resultat = $conn->fetchAssoc($query);

                die(json_encode($resultat));
            }
        }
//
//        die("Erreur");
    }

//    public function executeChargercontrepartie(sfWebRequest $request) {
//        $journals = JournalcomptableTable::getInstance()->findByIdTypeJournal($request->getParameter('id_type'));
//        $journal = explode(',', $journals);
//        for ($i = 0; $i < sizeof($journal); $i++) {
//            if ($journal[$i] != '') {
//                
//                // $plancomptable = new Plancomptable();
////                $journaux = JournalcomptableTable::getInstance()->getIdCOmptecontrepartie($journal[$i]);
////
////                $plancomptable->findBy($journal[$i]);
////                $journal->getSouscomptejournal()->add($souscompte);
//            }
//        }
////        $Activivte = new Activitetiers();
////        $Activivte->setLibelle($request->getParameter('new_libelle'));
////        $Activivte->save();
////        $this->activites = ActivitetiersTable::getInstance()->getAllByOrder();
//    }
}
