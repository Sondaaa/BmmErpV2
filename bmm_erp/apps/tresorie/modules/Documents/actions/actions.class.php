<?php

/**
 * Boncommandeexterne actions.
 *
 * @package    Bmm
 * @subpackage Boncommandeexterne
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentsActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;
        if ($request->getParameter('id') && $request->getParameter('id') != "") {
            $this->documentachats = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')
                    ->where('id_typedoc=6')
                    ->andwhere('id_docparent=' . $request->getParameter('id'))
                    ->execute();
            $this->documentdeponses = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')
                    ->where('id_typedoc=2')
                    ->andwhere('id_docparent=' . $request->getParameter('id'))
                    ->execute();
            $this->demandesprix = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')
                    ->where('id_typedoc=8')
                    ->andwhere('id_docparent=' . $request->getParameter('id'))
                    ->execute();
            $doc = new Documentachat();
            $document = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('id'));
            $this->documentachat = $document;
            $doc = $document;
            $this->id = $request->getParameter('id');
            $this->texte = $doc->getDatecreation() . '-' . $doc->getNumerodocachat() . '-' . trim($doc->getReference()) . '-' . $doc->getAgents();
        }
    }

    public function executeIndexfrs(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;

        $this->form = new DocumentachatFormFilter();
        $idtype = 7;
        if ($request->getParameter('idtype'))
            $idtype = $request->getParameter('idtype');
        $this->idtype = $idtype;
        $this->typedocachat = Doctrine_Core::getTable('typedoc')->findOneById($this->idtype);
        $ligneOperationCaisse = new Ligneoperationcaisse();
        $listesBDCP_NonValiderParCaisseOuBanque = $ligneOperationCaisse->getArrayDocumentsachats();
        $this->boncommandeexterne = Doctrine_Core::getTable('documentachat')
                ->createQuery('a')
                ->where('id_typedoc=' . $idtype)
//                ->andWhereNotIn('id', $listesBDCP_NonValiderParCaisseOuBanque)
        ;
        //->andWhereNotIn('id', $listesBDCP_NonValiderParCaisseOuBanque)
        $this->datedebut = "";
        $this->datefin = "";
        $this->idfrs = "";
        if ($request->getParameter('debut') && $request->getParameter('debut') != "") {
            $this->datedebut = $request->getParameter('debut');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation>='" . $request->getParameter('debut') . "'");
        }
        if ($request->getParameter('fin') && $request->getParameter('fin') != "") {
            $this->datefin = $request->getParameter('fin');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation<='" . $request->getParameter('debut') . "'");
        }

        if (!$request->getParameter('debut') && !$request->getParameter('debut') != "") {
            $this->boncommandeexterne = $this->boncommandeexterne
                    ->Andwhere("datecreation >='" . date('Y') . "-01-01" . "'")
                    ->Andwhere("datecreation <='" . date('Y') . "-12-31" . "'");
        }
        if ($request->getParameter('idfrs') && $request->getParameter('idfrs') != "") {
            $this->idfrs = $request->getParameter('idfrs');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_frs=" . $request->getParameter('idfrs'));
        }
        $this->boncommandeexterne = $this->boncommandeexterne->orderBy('id desc')->execute();
    }

    public function executeIndexfrsBDCG(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;

        $this->form = new DocumentachatFormFilter();
        $idtype = 7;
        if ($request->getParameter('idtype'))
            $idtype = $request->getParameter('idtype');
        $this->idtype = $idtype;
        $this->typedocachat = Doctrine_Core::getTable('typedoc')->findOneById($this->idtype);
        $ligneOperationCaisse = new Ligneoperationcaisse();
        $listesBDCP_NonValiderParCaisseOuBanque = $ligneOperationCaisse->getArrayDocumentsachats();
        $this->boncommandeexterne = Doctrine_Core::getTable('documentachat')
                ->createQuery('a')
                ->where('id_typedoc=' . $idtype)
//                ->andWhereNotIn('id', $listesBDCP_NonValiderParCaisseOuBanque)
        ;
        //->andWhereNotIn('id', $listesBDCP_NonValiderParCaisseOuBanque)
        $this->datedebut = "";
        $this->datefin = "";
        $this->idfrs = "";
        if ($request->getParameter('debut') && $request->getParameter('debut') != "") {
            $this->datedebut = $request->getParameter('debut');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation>='" . $request->getParameter('debut') . "'");
        }
        if ($request->getParameter('fin') && $request->getParameter('fin') != "") {
            $this->datefin = $request->getParameter('fin');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation<='" . $request->getParameter('debut') . "'");
        }
        if (!$request->getParameter('debut') && !$request->getParameter('debut') != "") {
            $this->boncommandeexterne = $this->boncommandeexterne
                    ->Andwhere("datecreation >='" . date('Y') . "-01-01" . "'")
                    ->Andwhere("datecreation <='" . date('Y') . "-12-31" . "'");
        }
        if ($request->getParameter('idfrs') && $request->getParameter('idfrs') != "") {
            $this->idfrs = $request->getParameter('idfrs');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_frs=" . $request->getParameter('idfrs'));
        }

        $this->boncommandeexterne = $this->boncommandeexterne->orderBy('id desc')->execute();
    }

    public function executePreengagement(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
        $this->boncommandeinterne = Doctrine_Core::getTable('documentachat')->findOneById($this->documentachat->getIdDocparent());
        $this->liste_demande_de_prix = Doctrine_Core::getTable('lignedocachat')
                        ->createQuery('a')
                        ->where('id_doc=' . $this->documentachat->getId())->orderBy('id asc')->execute();
        $this->idcategorie = 1;
        $this->categorie = "Provisoire";
        // die($this->documentachat->getIdTypedoc().'hh');
        if ($this->documentachat->getIdTypedoc() == 2) {
            $this->categorie = "Définitif";
            $this->idcategorie = 2;
        }
        $p = new Piecejointbudget();
        
        $this->idLigneRubrique = "";
        $this->piece_budget = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($this->documentachat->getId());
        if ($this->piece_budget) {
            //die($this->piece_budget);
            $p = $this->piece_budget;
            $chapitre = $p->getDocumentbudget()->getLigprotitrub()->getTitrebudjet()->getTypebudget();
           
            $this->idLigneRubrique = $p->getDocumentbudget()->getLigprotitrub()->getId();
        }
        $this->active = "home";
        $this->form = new LigneoperationcaisseForm();
//        $piece_ = new Ligneoperationcaisse();
        // $this->pieces_operations = Doctrine_Core::getTable('ligneoperationcaisse')->findByIdDocachat($this->documentachat->getId());
        $array = array();
        $array[] = $this->documentachat->getId();

        if ($request->getParameter('idoperation')) {

            $operations = Doctrine_Core::getTable('ligneoperationcaisse')->findOneByIdDocachatAndId($request->getParameter('id'), $request->getParameter('idoperation'));
            $this->active = "detail";
            if ($operations)
                $this->form = new LigneoperationcaisseForm($operations);
        }
        if ($this->documentachat->getIdFils()) {
            $this->documentFils = Doctrine_Core::getTable('documentachat')->findOneById($this->documentachat->getIdFils());
            if ($this->documentFils) {
                $this->ligneOperationCaisseFils = Doctrine_Core::getTable('ligneoperationcaisse')->findOneByIdDocachat($this->documentFils->getId());
                $array[] = $this->documentFils->getId();
            }
        }

        $this->pieces_operations = Doctrine_Core::getTable('ligneoperationcaisse')
                        ->createQuery('a')
                        ->whereIn('id_docachat', $array)->execute();
    }

    public function executePreengagementBDCG(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
        $this->boncommandeinterne = Doctrine_Core::getTable('documentachat')->findOneById($this->documentachat->getIdDocparent());
        $this->liste_demande_de_prix = Doctrine_Core::getTable('lignedocachat')
                        ->createQuery('a')
                        ->where('id_doc=' . $this->documentachat->getId())->orderBy('id asc')->execute();
        if ($this->documentachat->getIdTypedoc() == 21) {
            $this->idcategorie = 1;
            $this->categorie = "Provisoire";
        }
        if ($this->documentachat->getIdTypedoc() == 21) {
            if ($request->getParameter('idoperation')) {
                $this->categorie = "Définitif";
                $this->idcategorie = 2;
            }
        }
        $p = new Piecejointbudget();
        $this->rubrique = "";
        $this->idLigneRubrique = "";
        $this->piece_budget = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($this->documentachat->getId());
        if ($this->piece_budget) {
            //die($this->piece_budget);
            $p = $this->piece_budget;
            $chapitre = $p->getDocumentbudget()->getLigprotitrub()->getTitrebudjet()->getTypebudget();
            $this->rubrique = $p->getDocumentbudget()->getLigprotitrub()->getTitreEtRubrique();
            $this->idLigneRubrique = $p->getDocumentbudget()->getLigprotitrub()->getId();
        }
        $this->active = "home";
        $this->form = new LigneoperationcaisseForm();
//        $piece_ = new Ligneoperationcaisse();
        // $this->pieces_operations = Doctrine_Core::getTable('ligneoperationcaisse')->findByIdDocachat($this->documentachat->getId());
        $array = array();
        $array[] = $this->documentachat->getId();
        if ($request->getParameter('idoperation')) {
            $operations = Doctrine_Core::getTable('ligneoperationcaisse')->findOneByIdDocachatAndId($request->getParameter('id'), $request->getParameter('idoperation'));
            $this->active = "detail";
            if ($operations)
                $this->form = new LigneoperationcaisseForm($operations);
        }
        if ($this->documentachat->getIdFils()) {
            $this->documentFils = Doctrine_Core::getTable('documentachat')->findOneById($this->documentachat->getIdFils());
            if ($this->documentFils) {
                $this->ligneOperationCaisseFils = Doctrine_Core::getTable('ligneoperationcaisse')->findOneByIdDocachat($this->documentFils->getId());
                $array[] = $this->documentFils->getId();
            }
        }

        $this->pieces_operations = Doctrine_Core::getTable('ligneoperationcaisse')
                        ->createQuery('a')
                        ->whereIn('id_docachat', $array)->execute();
    }

    public function executePreengagementBDCGRetenue(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
        $this->boncommandeinterne = Doctrine_Core::getTable('documentachat')->findOneById($this->documentachat->getIdDocparent());
        $this->liste_demande_de_prix = Doctrine_Core::getTable('lignedocachat')
                        ->createQuery('a')
                        ->where('id_doc=' . $this->documentachat->getId())->orderBy('id asc')->execute();

        $this->categorie = "Retenue";
        $this->idcategorie = 3;

        $p = new Piecejointbudget();
        $this->rubrique = "";
        $this->idLigneRubrique = "";
        $this->piece_budget = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($this->documentachat->getId());
        if ($this->piece_budget) {
            //die($this->piece_budget);
            $p = $this->piece_budget;
            $chapitre = $p->getDocumentbudget()->getLigprotitrub()->getTitrebudjet()->getTypebudget();
            $this->rubrique = $p->getDocumentbudget()->getLigprotitrub()->getTitreEtRubrique();
            $this->idLigneRubrique = $p->getDocumentbudget()->getLigprotitrub()->getId();
        }
        $this->active = "home";
        $this->form = new LigneoperationcaisseForm();
//        $piece_ = new Ligneoperationcaisse();
        // $this->pieces_operations = Doctrine_Core::getTable('ligneoperationcaisse')->findByIdDocachat($this->documentachat->getId());
        $array = array();
        $array[] = $this->documentachat->getId();
        if ($request->getParameter('idoperation')) {
            $operations = Doctrine_Core::getTable('ligneoperationcaisse')->findOneByIdDocachatAndId($request->getParameter('id'), $request->getParameter('idoperation'));
            $this->active = "detail";
            if ($operations)
                $this->form = new LigneoperationcaisseForm($operations);
        }
        if ($this->documentachat->getIdFils()) {
            $this->documentFils = Doctrine_Core::getTable('documentachat')->findOneById($this->documentachat->getIdFils());
            if ($this->documentFils) {
                $this->ligneOperationCaisseFils = Doctrine_Core::getTable('ligneoperationcaisse')->findOneByIdDocachat($this->documentFils->getId());
                $array[] = $this->documentFils->getId();
            }
        }

        $this->pieces_operations = Doctrine_Core::getTable('ligneoperationcaisse')
                        ->createQuery('a')
                        ->whereIn('id_docachat', $array)->execute();
    }

    public function executeCloturer(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
        $this->boncommandeinterne = Doctrine_Core::getTable('documentachat')->findOneById($this->documentachat->getIdDocparent());
        $this->liste_demande_de_prix = Doctrine_Core::getTable('lignedocachat')
                        ->createQuery('a')
                        ->where('id_doc=' . $this->documentachat->getId())->orderBy('id asc')->execute();
        $this->idcategorie = 1;
        $this->categorie = "Provisoire";
        // die($this->documentachat->getIdTypedoc().'hh');
        if ($this->documentachat->getIdTypedoc() == 21) {
            $this->categorie = "Définitif";
            $this->idcategorie = 2;
        }
        $p = new Piecejointbudget();
        $this->rubrique = "";
        $this->idLigneRubrique = "";
        $this->piece_budget = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($this->documentachat->getId());
        if ($this->piece_budget) {
            //die($this->piece_budget);
            $p = $this->piece_budget;
            $chapitre = $p->getDocumentbudget()->getLigprotitrub()->getTitrebudjet()->getTypebudget();
            $this->rubrique = $p->getDocumentbudget()->getLigprotitrub()->getTitreEtRubrique();
            $this->idLigneRubrique = $p->getDocumentbudget()->getLigprotitrub()->getId();
        }
        $this->active = "home";
        $this->form = new LigneoperationcaisseForm();
//        $piece_ = new Ligneoperationcaisse();
        // $this->pieces_operations = Doctrine_Core::getTable('ligneoperationcaisse')->findByIdDocachat($this->documentachat->getId());
        $array = array();
        $array[] = $this->documentachat->getId();

        if ($request->getParameter('idoperation')) {

            $operations = Doctrine_Core::getTable('ligneoperationcaisse')->findOneByIdDocachatAndId($request->getParameter('id'), $request->getParameter('idoperation'));
            $this->active = "detail";
            if ($operations)
                $this->form = new LigneoperationcaisseForm($operations);
        }
        if ($this->documentachat->getIdFils()) {
            $this->documentFils = Doctrine_Core::getTable('documentachat')->findOneById($this->documentachat->getIdFils());
            if ($this->documentFils) {
                $this->ligneOperationCaisseFils = Doctrine_Core::getTable('ligneoperationcaisse')->findOneByIdDocachat($this->documentFils->getId());
                $array[] = $this->documentFils->getId();
            }
        }

        $this->pieces_operations = Doctrine_Core::getTable('ligneoperationcaisse')
                        ->createQuery('a')
                        ->whereIn('id_docachat', $array)->execute();
    }

    public function executePreengagementBDCGDef(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
        $this->boncommandeinterne = Doctrine_Core::getTable('documentachat')->findOneById($this->documentachat->getIdDocparent());
        $this->liste_demande_de_prix = Doctrine_Core::getTable('lignedocachat')
                        ->createQuery('a')
                        ->where('id_doc=' . $this->documentachat->getId())->orderBy('id asc')->execute();
        $this->categorie = "Définitif";
        $this->idcategorie = 2;

        $p = new Piecejointbudget();
        $this->rubrique = "";
        $this->idLigneRubrique = "";
        $this->piece_budget = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($this->documentachat->getId());
        if ($this->piece_budget) {
            //die($this->piece_budget);
            $p = $this->piece_budget;
            $chapitre = $p->getDocumentbudget()->getLigprotitrub()->getTitrebudjet()->getTypebudget();
            $this->rubrique = $p->getDocumentbudget()->getLigprotitrub()->getTitreEtRubrique();
            $this->idLigneRubrique = $p->getDocumentbudget()->getLigprotitrub()->getId();
        }
        $this->active = "home";
        $this->form = new LigneoperationcaisseForm();
//        $piece_ = new Ligneoperationcaisse();
        // $this->pieces_operations = Doctrine_Core::getTable('ligneoperationcaisse')->findByIdDocachat($this->documentachat->getId());
        $array = array();
        $array[] = $this->documentachat->getId();

        if ($request->getParameter('idoperation')) {

            $operations = Doctrine_Core::getTable('ligneoperationcaisse')->findOneByIdDocachatAndId($request->getParameter('id'), $request->getParameter('idoperation'));
            $this->active = "detail";
            if ($operations)
                $this->form = new LigneoperationcaisseForm($operations);
        }
        if ($this->documentachat->getIdFils()) {
            $this->documentFils = Doctrine_Core::getTable('documentachat')->findOneById($this->documentachat->getIdFils());
            if ($this->documentFils) {
                $this->ligneOperationCaisseFils = Doctrine_Core::getTable('ligneoperationcaisse')->findOneByIdDocachat($this->documentFils->getId());
                $array[] = $this->documentFils->getId();
            }
        }
        $this->pieces_operations = Doctrine_Core::getTable('ligneoperationcaisse')
                        ->createQuery('a')
                        ->whereIn('id_docachat', $array)->execute();
    }

    public function executePreengagementDefBDCNULL(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
        $this->boncommandeinterne = Doctrine_Core::getTable('documentachat')->findOneById($this->documentachat->getIdDocparent());
        $this->liste_demande_de_prix = Doctrine_Core::getTable('lignedocachat')
                        ->createQuery('a')
                        ->where('id_doc=' . $this->documentachat->getId())->orderBy('id asc')->execute();
        $this->idcategorie = 1;
        $this->categorie = "Provisoire";
        // die($this->documentachat->getIdTypedoc().'hh');
        if ($this->documentachat->getIdTypedoc() == 2) {
            $this->categorie = "Définitif";
            $this->idcategorie = 2;
        }
        $p = new Piecejointbudget();
        $this->rubrique = "";
        $this->idLigneRubrique = "";
        $this->piece_budget = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($this->documentachat->getId());
        if ($this->piece_budget) {
            //die($this->piece_budget);
            $p = $this->piece_budget;
            $chapitre = $p->getDocumentbudget()->getLigprotitrub()->getTitrebudjet()->getTypebudget();
            $this->rubrique = $p->getDocumentbudget()->getLigprotitrub()->getTitreEtRubrique();
            $this->idLigneRubrique = $p->getDocumentbudget()->getLigprotitrub()->getId();
        }
        $this->active = "home";
        $this->form = new LigneoperationcaisseForm();
//        $piece_ = new Ligneoperationcaisse();
        // $this->pieces_operations = Doctrine_Core::getTable('ligneoperationcaisse')->findByIdDocachat($this->documentachat->getId());
        $array = array();
        $array[] = $this->documentachat->getId();

        if ($request->getParameter('idoperation')) {

            $operations = Doctrine_Core::getTable('ligneoperationcaisse')->findOneByIdDocachatAndId($request->getParameter('id'), $request->getParameter('idoperation'));
            $this->active = "detail";
            if ($operations)
                $this->form = new LigneoperationcaisseForm($operations);
        }
        if ($this->documentachat->getIdFils()) {
            $this->documentFils = Doctrine_Core::getTable('documentachat')->findOneById($this->documentachat->getIdFils());
            if ($this->documentFils) {
                $this->ligneOperationCaisseFils = Doctrine_Core::getTable('ligneoperationcaisse')->findOneByIdDocachat($this->documentFils->getId());
                $array[] = $this->documentFils->getId();
            }
        }

        $this->pieces_operations = Doctrine_Core::getTable('ligneoperationcaisse')
                        ->createQuery('a')
                        ->whereIn('id_docachat', $array)->execute();
        $this->quitanceprovisoire = LigneoperationcaisseTable::getInstance()->findOneByIdDocachat($request->getParameter('id'));
//                Doctrine_Core::getTable('ligneoperationcaisse')
//                ->createQuery('a')
//                ->where('id_docachat=' . $request->getParameter('id'));
    }

    public function executePreengagementBDCNULL(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
        $this->boncommandeinterne = Doctrine_Core::getTable('documentachat')->findOneById($this->documentachat->getIdDocparent());
        $this->liste_demande_de_prix = Doctrine_Core::getTable('lignedocachat')
                        ->createQuery('a')
                        ->where('id_doc=' . $this->documentachat->getId())->orderBy('id asc')->execute();
        $this->idcategorie = 1;
        $this->categorie = "Provisoire";
        // die($this->documentachat->getIdTypedoc().'hh');
        if ($this->documentachat->getIdTypedoc() == 2) {
            $this->categorie = "Définitif";
            $this->idcategorie = 2;
        }
        $p = new Piecejointbudget();
        $this->rubrique = "";
        $this->idLigneRubrique = "";
        $this->piece_budget = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($this->documentachat->getId());
        if ($this->piece_budget) {
            //die($this->piece_budget);
            $p = $this->piece_budget;
            $chapitre = $p->getDocumentbudget()->getLigprotitrub()->getTitrebudjet()->getTypebudget();
            $this->rubrique = $p->getDocumentbudget()->getLigprotitrub()->getTitreEtRubrique();
            $this->idLigneRubrique = $p->getDocumentbudget()->getLigprotitrub()->getId();
        }
        $this->active = "home";
        $this->form = new LigneoperationcaisseForm();
//        $piece_ = new Ligneoperationcaisse();
        // $this->pieces_operations = Doctrine_Core::getTable('ligneoperationcaisse')->findByIdDocachat($this->documentachat->getId());
        $array = array();
        $array[] = $this->documentachat->getId();

        if ($request->getParameter('idoperation')) {

            $operations = Doctrine_Core::getTable('ligneoperationcaisse')->findOneByIdDocachatAndId($request->getParameter('id'), $request->getParameter('idoperation'));
            $this->active = "detail";
            if ($operations)
                $this->form = new LigneoperationcaisseForm($operations);
        }
        if ($this->documentachat->getIdFils()) {
            $this->documentFils = Doctrine_Core::getTable('documentachat')->findOneById($this->documentachat->getIdFils());
            if ($this->documentFils) {
                $this->ligneOperationCaisseFils = Doctrine_Core::getTable('ligneoperationcaisse')->findOneByIdDocachat($this->documentFils->getId());
                $array[] = $this->documentFils->getId();
            }
        }

        $this->pieces_operations = Doctrine_Core::getTable('ligneoperationcaisse')
                        ->createQuery('a')
                        ->whereIn('id_docachat', $array)->execute();
    }

    public function executeDetailpreengagement(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
        $this->boncommandeinterne = Doctrine_Core::getTable('documentachat')->findOneById($this->documentachat->getIdDocparent());
        $this->liste_demande_de_prix = Doctrine_Core::getTable('lignedocachat')
                        ->createQuery('a')
                        ->where('id_doc=' . $this->documentachat->getId())->orderBy('id asc')->execute();
        $p = new Piecejointbudget();
        $this->rubrique = "";
        $this->idLigneRubrique = "";
        $this->piece_budget = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($this->documentachat->getId());
        if ($this->piece_budget) {
            //die($this->piece_budget);
            $p = $this->piece_budget;
            $chapitre = $p->getDocumentbudget()->getLigprotitrub()->getTitrebudjet()->getTypebudget();
            $this->rubrique = $p->getDocumentbudget()->getLigprotitrub();
            $this->idLigneRubrique = $p->getDocumentbudget()->getLigprotitrub()->getId();
        }
        $this->active = "home";
        $this->form = new LigneoperationcaisseForm();
//        $piece_ = new Ligneoperationcaisse();
        $this->pieces_operations = Doctrine_Core::getTable('ligneoperationcaisse')->findByIdDocachat($this->documentachat->getId());

        if ($request->getParameter('idoperation')) {

            $operations = Doctrine_Core::getTable('ligneoperationcaisse')->findOneByIdDocachatAndId($request->getParameter('id'), $request->getParameter('idoperation'));
            $this->active = "detail";
            if ($operations)
                $this->form = new LigneoperationcaisseForm($operations);
        }
    }

    public function executeShow(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
    }

    public function executeDetail(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new documentachatForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new documentachatForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id'))), sprintf('Object documentachat does not exist (%s).', $request->getParameter('id')));
        $this->form = new documentachatForm($documentachat);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id'))), sprintf('Object documentachat does not exist (%s).', $request->getParameter('id')));
        $this->form = new documentachatForm($documentachat);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id'))), sprintf('Object documentachat does not exist (%s).', $request->getParameter('id')));
        $documentachat->delete();

        $this->redirect('Boncommandeexterne/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $documentachat = $form->save();

            $this->redirect('Boncommandeexterne/edit?id=' . $documentachat->getId());
        }
    }

    //___________________________________________________________________________Detail ligne doc Detail demande de prix
    public function executeDetaildemandedeprix(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $demandedeprix = new Documentachat();
            $dem = Doctrine_Core::getTable('documentachat')->findOneById($id);
            $demandedeprix = $dem;

            die($demandedeprix->getHtmlDemandedeprix());
        }
        //die($q);
    }

    public function executeImprimerprovisoirecaiise(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        // $iddoc = $request->getParameter('iddoc');
        $id = $request->getParameter('idfiche');
        //  $doc_budget = $doc = Doctrine_Core::getTable('documentbudget')->findOneById($id);

        $ligneoperationcaisse = Doctrine_Core::getTable('ligneoperationcaisse')->findOneById($id);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Bufget N°:');
        $pdf->SetSubject("fiche bidget");
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
        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
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

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // dejavusans or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);

//$pdf->SetFont('dejavusans', '', 12);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
//      


        $html = $this->ReadHtmlDocProvisoirecaisse($ligneoperationcaisse);

        // Print text using writeHTMLCell()
        // output the HTML content
        ob_end_clean();
        $pdf->writeHTML($html, true, false, true, false, '');


        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('titre_' . $id . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlDocProvisoirecaisse($ligneoperation) {
        $html = StyleCssHeader::header1();
        $html.=$ligneoperation->getHtmlDocProvisoirecaisse();

        return $html;
    }

    public function executeImprimerprovisoire(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $iddoc = $request->getParameter('iddoc');
        $id = $request->getParameter('idfiche');
        $doc_budget = $doc = Doctrine_Core::getTable('documentbudget')->findOneById($id);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Bufget N°:');
        $pdf->SetSubject("fiche bidget");
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
        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
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

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // dejavusans or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);
//$pdf->SetFont('dejavusans', '', 12);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
//      
        $idtype = 1;
        if ($request->getParameter('idtytpe'))
            $idtype = $request->getParameter('idtytpe');

        $html = $this->ReadHtmlDocProvisoire($iddoc, $doc_budget, $idtype);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');


        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('titre_' . $id . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlDocProvisoire($iddoc, $doc_budget, $idtype) {
        $html = StyleCssHeader::header1();
        $html.=$doc_budget->getHtmlDocProvisoire($iddoc, $idtype);

        return $html;
    }

    public function executeImprimerdemandedachat(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

        $listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche N°:' . $documentachat->getNumero());
        $pdf->SetSubject("demande de prix");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, '', strtoupper($entete), $soc->getAdresse());
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(5, 30, 5);
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

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // dejavusans or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
//      


        $html = $this->ReadHtmlDemandePrix($societe, $documentachat, $listesdocuments);
//die($html);
        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('demandedeprix' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlDemandePrix($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->getHtmlDemandedeprix();
        //die($html);
        return $html;
    }
   public function executeImprimerBDCProvisoire(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');
        $id_typedoc = $request->getParameter('id_typedoc');
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche B.D.C Provisoire');
        $pdf->SetSubject("Fiche B.D.C Provisoire");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $logo = $soc->getLogo();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail()
                . '<br>Adresse:' . $soc->getAdresse() . '';
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);


        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //$pdf->setFooterData(array(0,64,0), array(0,64,128));
        $pdf->CustomFooter($adresse, '');
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 12, '', true);
        $pdf->AddPage();

        $html = $this->ReadHtmlBDCProvisoire($iddoc);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Fiche B.D.C Provisoire.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBDCProvisoire($iddoc) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBDCProvisoire($iddoc);
        return $html;
    }
    
     public function executeImprimerbondeponseReg(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

        $listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche N°:' . $documentachat->getNumero());
        $pdf->SetSubject("Bon de déponse aux comptant");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, '', strtoupper($entete), $soc->getAdresse());
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
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

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // dejavusans or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
//      


        $html = $this->ReadHtmlBondeponseReg($societe, $documentachat, $listesdocuments);
//die($html);
        // Print text using writeHTMLCell()
        // output the HTML content
        ob_end_clean();

        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.

        $pdf->Output('demandedeprix' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBondeponseReg($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $doc = new Documentachat();
        $html.=$documentachat->ReadHtmlBondeponseRegroupe($documentachat->getId());
        //die($html);
        return $html;
    }
    public function executeImprimerbondeponse(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

        $listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche N°:' . $documentachat->getNumero());
        $pdf->SetSubject("Bon de déponse aux comptant");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, '', strtoupper($entete), $soc->getAdresse());
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
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

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // dejavusans or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
//      


        $html = $this->ReadHtmlBondeponse($societe, $documentachat, $listesdocuments);
//die($html);
        // Print text using writeHTMLCell()
        // output the HTML content
        ob_end_clean();

        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.

        $pdf->Output('demandedeprix' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBondeponse($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $doc = new Documentachat();
        $html.=$documentachat->ReadHtmlBondeponse();
        //die($html);
        return $html;
    }

    /*     * **Impression annexe ******* */

    public function executeImprimerAnnexebondeponse(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

        $listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche N°:' . $documentachat->getNumero());
        $pdf->SetSubject("Annexe Bon de déponse aux comptant");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, '', strtoupper($entete), $soc->getAdresse());
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
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

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // dejavusans or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
//      


        $html = $this->ReadHtmlAnnexeBondeponse($societe, $documentachat, $listesdocuments);
//die($html);
        // Print text using writeHTMLCell()
        // output the HTML content
        ob_end_clean();

        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.

        $pdf->Output('demandedeprix' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlAnnexeBondeponse($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $doc = new Documentachat();
        $html.=$documentachat->ReadHtmlAnnexeBondeponse();
        //die($html);
        return $html;
    }

    public function executeImprimerbonexterne(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche N°:' . $documentachat->getNumero());
        $pdf->SetSubject("Bon de commande externe");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, '', strtoupper($entete), $soc->getAdresse());
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setPrintFooter(true);
        $foter = $soc->getTel();
        $adr = $soc->getAdresse();
        $pdf->setFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($foter), strtoupper($adr), '', '');
        //$pdf->setFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');
//        $pdf->setFooterData(strtoupper($foter),strtoupper($adr));
//        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
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

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // dejavusans or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        $html = $this->ReadHtmlBonexterne($documentachat);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Bon commande ' . $documentachat->getNumero() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBonexterne($documentachat) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlBonexterne();
        //die($html);
        return $html;
    }

}
