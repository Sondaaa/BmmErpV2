<?php

/**
 * parametre actions.
 *
 * @package    sw-commerciale
 * @subpackage parametre
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class parametreActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    //Forme Juridique //////////////////////////////////////////////////////////////////////////////////////////
    function getAllFormeJuridique(sfWebRequest $request) {
        $libelle = strtoupper($request->getParameter('libelle', ''));

        $pager = new sfDoctrinePager('Formejuridique', 5);
        $pager->setQuery(FormejuridiqueTable::getInstance()->getAllFormeJuridique($libelle));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeListeFormeJuridique(sfWebRequest $request) {
        $this->pager = $this->getAllFormeJuridique($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_forme_juridique", array("pager" => $this->pager));
        }
    }

    public function executeAjouterForme(sfWebRequest $request) {
        $forme = FormejuridiqueTable::getInstance()->findByLibelle($request->getParameter('new_libelle'));
        if ($forme->count() != 0) {
            return $this->renderText('existe');
        } else {
            $forme = new Formejuridique();
            $forme->setLibelle($request->getParameter('new_libelle'));
            $forme->save();

            $this->pager = $this->getAllFormeJuridique($request);

            if ($request->isXmlHttpRequest()) {
                return $this->renderPartial("liste_forme_juridique", array("pager" => $this->pager));
            }
        }
    }

    public function executeDeleteForme(sfWebRequest $request) {
        $forme = FormejuridiqueTable::getInstance()->find($request->getParameter('id'));
        $forme->delete();

        $this->pager = $this->getAllFormeJuridique($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_forme_juridique", array("pager" => $this->pager));
        }
    }

    public function executeEditForme(sfWebRequest $request) {
        $this->forme = FormejuridiqueTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeUpdateForme(sfWebRequest $request) {
        $forme = FormejuridiqueTable::getInstance()->getForExiste($request->getParameter('new_libelle'), $request->getParameter('id'));
        if ($forme->count() != 0) {
            return $this->renderText('existe');
        } else {
            $forme = FormejuridiqueTable::getInstance()->find($request->getParameter('id'));
            $forme->setLibelle($request->getParameter('new_libelle'));
            $forme->save();

            $this->pager = $this->getAllFormeJuridique($request);

            if ($request->isXmlHttpRequest()) {
                return $this->renderPartial("liste_forme_juridique", array("pager" => $this->pager));
            }
        }
    }

    //Type Journal //////////////////////////////////////////////////////////////////////////////////////////
    function getAllTypeJournal(sfWebRequest $request) {
        $libelle = strtoupper($request->getParameter('libelle', ''));

        $pager = new sfDoctrinePager('Typejournal', 5);
        $pager->setQuery(TypejournalTable::getInstance()->getAllTypeJournal($libelle));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeListeTypeJournal(sfWebRequest $request) {
        $this->pager = $this->getAllTypeJournal($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_type_journal", array("pager" => $this->pager));
        }
    }

    public function executeAjouterTypeJournal(sfWebRequest $request) {
        $type_journal = TypejournalTable::getInstance()->findByLibelle($request->getParameter('new_libelle'));
        if ($type_journal->count() != 0) {
            return $this->renderText('existe');
        } else {
            $type_journal = new Typejournal();
            $type_journal->setLibelle($request->getParameter('new_libelle'));
            $type_journal->save();

            $this->pager = $this->getAllTypeJournal($request);

            if ($request->isXmlHttpRequest()) {
                return $this->renderPartial("liste_type_journal", array("pager" => $this->pager));
            }
        }
    }

    public function executeDeleteTypeJournal(sfWebRequest $request) {
        $type_journal = TypejournalTable::getInstance()->find($request->getParameter('id'));
        $type_journal->delete();

        $this->pager = $this->getAllTypeJournal($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_type_journal", array("pager" => $this->pager));
        }
    }

    public function executeEditTypeJournal(sfWebRequest $request) {
        $this->type_journal = TypejournalTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeUpdateTypeJournal(sfWebRequest $request) {
        $type_journal = TypejournalTable::getInstance()->getForExiste($request->getParameter('new_libelle'), $request->getParameter('id'));
        if ($type_journal->count() != 0) {
            return $this->renderText('existe');
        } else {
            $type_journal = TypejournalTable::getInstance()->find($request->getParameter('id'));
            $type_journal->setLibelle($request->getParameter('new_libelle'));
            $type_journal->save();

            $this->pager = $this->getAllTypeJournal($request);

            if ($request->isXmlHttpRequest()) {
                return $this->renderPartial("liste_type_journal", array("pager" => $this->pager));
            }
        }
    }

    //Type Pièce //////////////////////////////////////////////////////////////////////////////////////////
    function getAllTypePiece(sfWebRequest $request) {
        $libelle = strtoupper($request->getParameter('libelle', ''));

        $pager = new sfDoctrinePager('Naturepiece', 5);
        $pager->setQuery(NaturepieceTable::getInstance()->getAllTypePiece($libelle));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeListeTypePiece(sfWebRequest $request) {
        $this->pager = $this->getAllTypePiece($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_type_piece", array("pager" => $this->pager));
        }
    }

    public function executeAjouterTypePiece(sfWebRequest $request) {
        $type_piece = NaturepieceTable::getInstance()->findByLibelle($request->getParameter('new_libelle'));
        if ($type_piece->count() != 0) {
            return $this->renderText('existe');
        } else {
            $type_piece = new Naturepiece();
            $type_piece->setLibelle($request->getParameter('new_libelle'));
            $type_piece->save();

            $this->pager = $this->getAllTypePiece($request);

            if ($request->isXmlHttpRequest()) {
                return $this->renderPartial("liste_type_piece", array("pager" => $this->pager));
            }
        }
    }

    public function executeDeleteTypePiece(sfWebRequest $request) {
        $type_piece = NaturepieceTable::getInstance()->find($request->getParameter('id'));
        $type_piece->delete();

        $this->pager = $this->getAllTypePiece($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_type_piece", array("pager" => $this->pager));
        }
    }

    public function executeEditTypePiece(sfWebRequest $request) {
        $this->type_piece = NaturepieceTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeUpdateTypePiece(sfWebRequest $request) {
        $type_piece = NaturepieceTable::getInstance()->getForExiste($request->getParameter('new_libelle'), $request->getParameter('id'));
        if ($type_piece->count() != 0) {
            return $this->renderText('existe');
        } else {
            $type_piece = NaturepieceTable::getInstance()->find($request->getParameter('id'));
            $type_piece->setLibelle($request->getParameter('new_libelle'));
            $type_piece->save();

            $this->pager = $this->getAllTypePiece($request);

            if ($request->isXmlHttpRequest()) {
                return $this->renderPartial("liste_type_piece", array("pager" => $this->pager));
            }
        }
    }

    //Secteur Actvité //////////////////////////////////////////////////////////////////////////////////////////
    function getAllSecteurActivite(sfWebRequest $request) {
        $libelle = strtoupper($request->getParameter('libelle', ''));

        $pager = new sfDoctrinePager('Secteuractivite', 5);
        $pager->setQuery(SecteuractiviteTable::getInstance()->getAllSecteurActvite($libelle));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeListeSecteurActivite(sfWebRequest $request) {
        $this->pager = $this->getAllSecteurActivite($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_secteur_activite", array("pager" => $this->pager));
        }
    }

    public function executeAjouterSecteurActivite(sfWebRequest $request) {
        $secteur_activite = SecteuractiviteTable::getInstance()->findByLibelle($request->getParameter('new_libelle'));
        if ($secteur_activite->count() != 0) {
            return $this->renderText('existe');
        } else {
            $secteur_activite = new Secteuractivite();
            $secteur_activite->setLibelle($request->getParameter('new_libelle'));
            $secteur_activite->save();

            $this->pager = $this->getAllSecteurActivite($request);

            if ($request->isXmlHttpRequest()) {
                return $this->renderPartial("liste_secteur_activite", array("pager" => $this->pager));
            }
        }
    }

    public function executeDeleteSecteurActivite(sfWebRequest $request) {
        $secteur_activite = SecteuractiviteTable::getInstance()->find($request->getParameter('id'));
        $secteur_activite->delete();

        $this->pager = $this->getAllSecteurActivite($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_secteur_activite", array("pager" => $this->pager));
        }
    }

    public function executeEditSecteurActivite(sfWebRequest $request) {
        $this->secteur_activite = SecteuractiviteTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeUpdateSecteurActivite(sfWebRequest $request) {
        $secteur_activite = SecteuractiviteTable::getInstance()->getForExiste($request->getParameter('new_libelle'), $request->getParameter('id'));
        if ($secteur_activite->count() != 0) {
            return $this->renderText('existe');
        } else {
            $secteur_activite = SecteuractiviteTable::getInstance()->find($request->getParameter('id'));
            $secteur_activite->setLibelle($request->getParameter('new_libelle'));
            $secteur_activite->save();

            $this->pager = $this->getAllSecteurActivite($request);

            if ($request->isXmlHttpRequest()) {
                return $this->renderPartial("liste_secteur_activite", array("pager" => $this->pager));
            }
        }
    }

    //Actvité Tier //////////////////////////////////////////////////////////////////////////////////////////
    function getAllActivite(sfWebRequest $request) {
        $libelle = strtoupper($request->getParameter('libelle', ''));

        $pager = new sfDoctrinePager('Activitetiers', 5);
        $pager->setQuery(ActivitetiersTable::getInstance()->getAllActivite($libelle));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeListeActivite(sfWebRequest $request) {
        $this->pager = $this->getAllActivite($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_activite", array("pager" => $this->pager));
        }
    }

    public function executeAjouterActivite(sfWebRequest $request) {
        $activite = ActivitetiersTable::getInstance()->findByLibelle($request->getParameter('new_libelle'));
        if ($activite->count() != 0) {
            return $this->renderText('existe');
        } else {
            $activite = new Activitetiers();
            $activite->setLibelle($request->getParameter('new_libelle'));
            $activite->save();

            $this->pager = $this->getAllActivite($request);

            if ($request->isXmlHttpRequest()) {
                return $this->renderPartial("liste_activite", array("pager" => $this->pager));
            }
        }
    }

    public function executeDeleteActivite(sfWebRequest $request) {
        $activite = ActivitetiersTable::getInstance()->find($request->getParameter('id'));
        $activite->delete();

        $this->pager = $this->getAllActivite($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_activite", array("pager" => $this->pager));
        }
    }

    public function executeEditActivite(sfWebRequest $request) {
        $this->activite = ActivitetiersTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeUpdateActivite(sfWebRequest $request) {
        $activite = ActivitetiersTable::getInstance()->getForExiste($request->getParameter('new_libelle'), $request->getParameter('id'));
        if ($activite->count() != 0) {
            return $this->renderText('existe');
        } else {
            $activite = ActivitetiersTable::getInstance()->find($request->getParameter('id'));
            $activite->setLibelle($request->getParameter('new_libelle'));
            $activite->save();

            $this->pager = $this->getAllActivite($request);

            if ($request->isXmlHttpRequest()) {
                return $this->renderPartial("liste_activite", array("pager" => $this->pager));
            }
        }
    }

    //Exercice Comptable //////////////////////////////////////////////////////////////////////////////////////////
    function getAllExercice(sfWebRequest $request) {
        $libelle = strtoupper($request->getParameter('libelle', ''));

        $pager = new sfDoctrinePager('Exercice', 5);
        $pager->setQuery(ExerciceTable::getInstance()->getAllExercice($libelle));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeListeExercice(sfWebRequest $request) {
        $this->pager = $this->getAllExercice($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_exercice", array("pager" => $this->pager));
        }
    }

    public function executeAjouterExercice(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->findByLibelle($request->getParameter('new_libelle'));
        if ($exercice->count() != 0) {
            return $this->renderText('existe');
        } else {
            $exercice = new Exercice();
            $exercice->setLibelle($request->getParameter('new_libelle'));
            $exercice->setDateDebut($request->getParameter('date_debut'));
            $exercice->setDateFin($request->getParameter('date_fin'));
            $exercice->setType('comptabilite');
            $exercice->save();

            $pager = $this->getAllExercice($request);
            return $this->renderPartial("liste_exercice", array("pager" => $pager));
        }
    }

    public function executeDeleteExercice(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($request->getParameter('id'));
        $dossier_exercice = DossierexerciceTable::getInstance()->findByIdExercice($request->getParameter('id'));
        foreach ($dossier_exercice as $de) {
            $de->delete();
        }
        $exercice->delete();

        $pager = $this->getAllExercice($request);
        return $this->renderPartial("liste_exercice", array("pager" => $pager));
    }

    public function executeEditExercice(sfWebRequest $request) {
        $this->exercice = ExerciceTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeUpdateExercice(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->getForExiste($request->getParameter('new_libelle'), $request->getParameter('id'));
        if ($exercice->count() != 0) {
            return $this->renderText('existe');
        } else {
            $exercice = ExerciceTable::getInstance()->find($request->getParameter('id'));
            $exercice->setLibelle($request->getParameter('new_libelle'));
            $exercice->setDateDebut($request->getParameter('date_debut'));
            $exercice->setDateFin($request->getParameter('date_fin'));
            $exercice->save();

            $pager = $this->getAllExercice($request);
            return $this->renderPartial("liste_exercice", array("pager" => $pager));
        }
    }

    //T.V.A //////////////////////////////////////////////////////////////////////////////////////////
    function getAllTva(sfWebRequest $request) {
        $libelle = strtoupper($request->getParameter('libelle', ''));

        $pager = new sfDoctrinePager('Tva', 5);
        $pager->setQuery(TvaTable::getInstance()->getAllTva($libelle));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeListeTva(sfWebRequest $request) {
        $this->pager = $this->getAllTva($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_tva", array("pager" => $this->pager));
        }
    }

    public function executeAjouterTva(sfWebRequest $request) {
        $tva = TvaTable::getInstance()->findByLibelle($request->getParameter('new_libelle'));
        if ($tva->count() != 0) {
            return $this->renderText('existe');
        } else {
            $tva = new Tva();
            $tva->setLibelle($request->getParameter('new_libelle'));
            $tva->setValeurtva($request->getParameter('valeur_tva'));
            $tva->save();

            $pager = $this->getAllTva($request);
            return $this->renderPartial("liste_tva", array("pager" => $pager));
        }
    }

    public function executeDeleteTva(sfWebRequest $request) {
        $tva = TvaTable::getInstance()->find($request->getParameter('id'));
        $tva->delete();

        $pager = $this->getAllTva($request);
        return $this->renderPartial("liste_tva", array("pager" => $pager));
    }

    public function executeEditTva(sfWebRequest $request) {
        $this->tva = TvaTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeUpdateTva(sfWebRequest $request) {
        $tva = TvaTable::getInstance()->getForExiste($request->getParameter('new_libelle'), $request->getParameter('id'));
        if ($tva->count() != 0) {
            return $this->renderText('existe');
        } else {
            $tva = TvaTable::getInstance()->find($request->getParameter('id'));
            $tva->setLibelle($request->getParameter('new_libelle'));
            $tva->setValeurtva($request->getParameter('valeur_tva'));
            $tva->save();

            $pager = $this->getAllTva($request);
            return $this->renderPartial("liste_tva", array("pager" => $pager));
        }
    }

    //Actvité Tier //////////////////////////////////////////////////////////////////////////////////////////
    function getAllTypeCompte(sfWebRequest $request) {
        $libelle = strtoupper($request->getParameter('libelle', ''));

        $pager = new sfDoctrinePager('Typecompte', 5);
        $pager->setQuery(TypecompteTable::getInstance()->getAllTypeCompte($libelle));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeListeTypeCompte(sfWebRequest $request) {
        $this->pager = $this->getAllTypeCompte($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_type_compte", array("pager" => $this->pager));
        }
    }

    public function executeAjouterTypeCompte(sfWebRequest $request) {
        $type_compte = TypecompteTable::getInstance()->findByLibelle($request->getParameter('new_libelle'));
        if ($type_compte->count() != 0) {
            return $this->renderText('existe');
        } else {
            $type_compte = new Typecompte();
            $type_compte->setLibelle($request->getParameter('new_libelle'));
            $type_compte->save();

            $pager = $this->getAllTypeCompte($request);
            return $this->renderPartial("liste_type_compte", array("pager" => $pager));
        }
    }

    public function executeDeleteTypeCompte(sfWebRequest $request) {
        $type_compte = TypecompteTable::getInstance()->find($request->getParameter('id'));
        $type_compte->delete();

        $pager = $this->getAllTypeCompte($request);
        return $this->renderPartial("liste_type_compte", array("pager" => $pager));
    }

    public function executeEditTypeCompte(sfWebRequest $request) {
        $this->type_compte = TypecompteTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeUpdateTypeCompte(sfWebRequest $request) {
        $type_compte = TypecompteTable::getInstance()->getForExiste($request->getParameter('new_libelle'), $request->getParameter('id'));
        if ($type_compte->count() != 0) {
            return $this->renderText('existe');
        } else {
            $type_compte = TypecompteTable::getInstance()->find($request->getParameter('id'));
            $type_compte->setLibelle($request->getParameter('new_libelle'));
            $type_compte->save();

            $pager = $this->getAllTypeCompte($request);
            return $this->renderPartial("liste_type_compte", array("pager" => $pager));
        }
    }

}
