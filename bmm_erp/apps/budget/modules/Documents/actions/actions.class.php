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
        $this->formfiletr = new DocumentachatFormFilter();
        $idtype = 7;
        $documentachat = new Documentachat();
        $this->form = new DocumentbudgetForm();
        if ($request->getParameter('idtype')) {
            $idtype = $request->getParameter('idtype');
        }

        $this->idtype = $idtype;
        $this->boncommandeexterne = $documentachat->getListesBdcpNonImputer();
        $this->datedebut = "";
        $this->datefin = "";
        $this->idfrs = "";
        $this->id_bci = "";
        $this->id_dem = "";

        if ($request->getParameter('debut') && $request->getParameter('debut') != "") {
            $this->datedebut = $request->getParameter('debut');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation>='" . $request->getParameter('debut') . "'");
        }
        if ($request->getParameter('id_bci') && $request->getParameter('id_bci') != "") {
            $this->id_bci = $request->getParameter('id_bci');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_docparent='" . $request->getParameter('id_bci') . "'");
        }
        if ($request->getParameter('id_dem') && $request->getParameter('id_dem') != "") {
            $this->id_dem = $request->getParameter('id_dem');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_demandeur='" . $request->getParameter('id_dem') . "'");
        }
        if ($request->getParameter('fin') && $request->getParameter('fin') != "") {
            $this->datefin = $request->getParameter('fin');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation<='" . $request->getParameter('fin') . "'");
        }
        // die('dede' . $this->boncommandeexterne);
        if ($request->getParameter('idfrs') && $request->getParameter('idfrs') != "") {
            $this->idfrs = $request->getParameter('idfrs');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_frs=" . $request->getParameter('idfrs'));
        }

        $this->boncommandeexterne = $this->boncommandeexterne
                ->orderBy('id desc')
                ->execute();

        $this->type = Doctrine_Core::getTable('typedoc')->findOneById($idtype);
        $boncommandeexterne = $this->boncommandeexterne;
        //        die(sizeof($boncommandeexterne).'gt');
    }

    public function executeIndexfrsBDCNull(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;
        $this->formfiletr = new DocumentachatFormFilter();
        $idtype = 7;
        $documentachat = new Documentachat();
        $this->form = new DocumentbudgetForm();
        if ($request->getParameter('idtype')) {
            $idtype = $request->getParameter('idtype');
        }

        $this->idtype = $idtype;
        $this->boncommandeexterne = $documentachat->getListesBdcpNonImputerBDC();

        $this->datedebut = "";
        $this->datefin = "";
        $this->idfrs = "";
        $this->id_bci = "";
        $this->id_dem = "";
        $this->boncommandeexterne = $this->boncommandeexterne->orderBy('id desc')->execute();
        $this->type = Doctrine_Core::getTable('typedoc')->findOneById($idtype);
        $boncommandeexterne = $this->boncommandeexterne;
    }

    public function executeIndexfrsBDC(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;
        $this->formfiletr = new DocumentachatFormFilter();
        $idtype = 7;
        $documentachat = new Documentachat();
        $this->form = new DocumentbudgetForm();
        if ($request->getParameter('idtype')) {
            $idtype = $request->getParameter('idtype');
        }

        $this->idtype = $idtype;
        $this->boncommandeexterne = $documentachat->getListesBdcpNonImputerNULL();
        $this->datedebut = "";
        $this->datefin = "";
        $this->idfrs = "";
        $this->id_bci = "";
        $this->id_dem = "";
        $this->boncommandeexterne = $this->boncommandeexterne->orderBy('id desc')->execute();
        $this->type = Doctrine_Core::getTable('typedoc')->findOneById($idtype);
        $boncommandeexterne = $this->boncommandeexterne;
    }

    public function executeIndexfrsBDCRegroupe(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;
        $this->formfiletr = new DocumentachatFormFilter();
        $idtype = 22;
        $documentachat = new Documentachat();
        $this->form = new DocumentbudgetForm();
        if ($request->getParameter('idtype')) {
            $idtype = $request->getParameter('idtype');
        }

        $this->idtype = $idtype;
        $this->boncommandeexterne = $documentachat->getListesBdcpNonImputerBDCRegroupe();
        $this->boncommandeexterne = $this->boncommandeexterne->orderBy('id desc')->execute();
        $this->type = Doctrine_Core::getTable('typedoc')->findOneById($idtype);
        $boncommandeexterne = $this->boncommandeexterne;
        //        die(sizeof($documentachat->getListesBdcpNonImputer()).'m'.$boncommandeexterne->getLast()->getId());
    }

    public function executeIndexfrsBDCR(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;
        $this->formfiletr = new DocumentachatFormFilter();
        $idtype = 7;
        $documentachat = new Documentachat();
        $this->form = new DocumentbudgetForm();
        if ($request->getParameter('idtype')) {
            $idtype = $request->getParameter('idtype');
        }

        $this->idtype = $idtype;

        $this->boncommandeexterne = $documentachat->getListesBdcpNonImputerBDCR();

        $this->datedebut = "";
        $this->datefin = "";
        $this->idfrs = "";
        $this->id_bci = "";
        $this->id_dem = "";

        if ($request->getParameter('debut') && $request->getParameter('debut') != "") {
            $this->datedebut = $request->getParameter('debut');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation>='" . $request->getParameter('debut') . "'");
        }
        if ($request->getParameter('id_bci') && $request->getParameter('id_bci') != "") {
            $this->id_bci = $request->getParameter('id_bci');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_docparent='" . $request->getParameter('id_bci') . "'");
        }
        if ($request->getParameter('id_dem') && $request->getParameter('id_dem') != "") {
            $this->id_dem = $request->getParameter('id_dem');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_demandeur='" . $request->getParameter('id_dem') . "'");
        }
        if ($request->getParameter('fin') && $request->getParameter('fin') != "") {
            $this->datefin = $request->getParameter('fin');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation<='" . $request->getParameter('debut') . "'");
        }
        if ($request->getParameter('idfrs') && $request->getParameter('idfrs') != "") {
            $this->idfrs = $request->getParameter('idfrs');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_frs=" . $request->getParameter('idfrs'));
        }
        $this->boncommandeexterne = $this->boncommandeexterne->orderBy('id desc')->execute();
        $this->type = Doctrine_Core::getTable('typedoc')->findOneById($idtype);
        $boncommandeexterne = $this->boncommandeexterne;
        //        die(sizeof($documentachat->getListesBdcpNonImputer()).'m'.$boncommandeexterne->getLast()->getId());
    }

    public function executeIndexfrsBcicontrat(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;
        $this->formfiletr = new DocumentachatFormFilter();
        $idtype = 19;
        $documentachat = new Documentachat();
        $this->form = new DocumentbudgetForm();
        if ($request->getParameter('idtype')) {
            $idtype = $request->getParameter('idtype');
        }

        $this->idtype = $idtype;
        $boncommandeexterne = $documentachat->getListesBdcpNonImputercontrat();
        $this->boncommandeexterne = $boncommandeexterne;
        $this->datedebut = "";
        $this->datefin = "";
        $this->idfrs = "";
        $this->id_bci = "";
        $this->id_dem = "";

        //        if ($request->getParameter('debut') && $request->getParameter('debut') != "") {
        //            $this->datedebut = $request->getParameter('debut');
        //            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation>='" . $request->getParameter('debut') . "'");
        //        }
        //
        //        if ($request->getParameter('id_bci') && $request->getParameter('id_bci') != "") {
        //            $this->id_bci = $request->getParameter('id_bci');
        //            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_contrat='" . $request->getParameter('id_bci') . "'");
        //        }
        //
        //        if ($request->getParameter('fin') && $request->getParameter('fin') != "") {
        //            $this->datefin = $request->getParameter('fin');
        //            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation<='" . $request->getParameter('debut') . "'");
        //        }
        //        if ($request->getParameter('idfrs') && $request->getParameter('idfrs') != "") {
        //            $this->idfrs = $request->getParameter('idfrs');
        //            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_frs=" . $request->getParameter('idfrs'));
        //        }
        $this->boncommandeexterne = $this->boncommandeexterne->orderBy('id desc')->execute();
        $this->type = Doctrine_Core::getTable('typedoc')->findOneById($idtype);
        $boncommandeexterne = $this->boncommandeexterne;
        //        die(sizeof($documentachat->getListesBdcpNonImputer()).'m'.$boncommandeexterne->getLast()->getId());
    }

    //Doc Achat Pager //////////////////////////////////////////////////////////////////////////////////////////
    public function getDocumentAchatByPage(sfWebRequest $request) {
        $date_debut = $request->getParameter('debut', '');
        $date_fin = $request->getParameter('fin', '');
        $idfrs = $request->getParameter('idfrs', '');
        $idtype = $request->getParameter('idtype', '');
        $pager = new sfDoctrinePager('Documentachat', 5);

        if ($date_debut == '') {
            $date_debut = $_SESSION['exercice_budget'] . "-01-01";
        }

        if ($date_fin == '') {
            $date_fin = $_SESSION['exercice_budget'] . "-12-31";
        }

        $pager->setQuery(DocumentachatTable::getInstance()->getAllDocByFilter($date_debut, $date_fin, $idtype, $idfrs));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        return $pager;
    }

    public function executeIndexAchatfrs(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;
        $this->idtype = 7;
        if ($request->getParameter('idtype')) {
            $this->idtype = $request->getParameter('idtype');
        }

        $this->form = new DocumentachatFormFilter();
        $this->typedocument = "";
        $type_document = Doctrine_Core::getTable('typedoc')->findOneById($this->idtype);
        if ($type_document) {
            $this->typedocument = $type_document->getLibelle();
        }

        //  die($request->getParameter('idtype').'hhhhhh');
        $this->date_debut = $request->getParameter('debut');
        $this->date_fin = $request->getParameter('fin');
        $this->idfrs = $request->getParameter('idfrs');
        $this->boncommandeexterne = $this->getDocumentAchatByPage($request);
        if ($this->idtype == 19) {
            $this->typedocument = 'Contrat';
        }

        //        if ($request->isXmlHttpRequest()) {
        //            return $this->renderPartial("liste_type_compte", array("pager" => $this->pager));
        //        }
    }

    public function executeBondefinitif(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;
        $this->formfiletr = new DocumentachatFormFilter();
        $idtype = 7;
        $documentachat = new Documentachat();
        $this->form = new DocumentbudgetForm();
        //        if ($request->getParameter('idtype'))
        //            $idtype = $request->getParameter('idtype');
        //        $this->idtype = $idtype;
        $this->boncommandeexterne = null;
        if ($documentachat->getListesBdcDefinitifNonEncoreValider()) {
            $this->boncommandeexterne = $documentachat->getListesBdcDefinitifNonEncoreValider();
            $this->datedebut = "";
            $this->datefin = "";
            $this->idfrs = "";
            $this->id_bci = "";
            $this->id_dem = "";
            if ($request->getParameter('debut') && $request->getParameter('debut') != "") {
                $this->datedebut = $request->getParameter('debut');
                $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation>='" . $request->getParameter('debut') . "'");
            }
            if ($request->getParameter('id_bci') && $request->getParameter('id_bci') != "") {
                $this->id_bci = $request->getParameter('id_bci');
                $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_docparent='" . $request->getParameter('id_bci') . "'");
            }
            if ($request->getParameter('id_dem') && $request->getParameter('id_dem') != "") {
                $this->id_dem = $request->getParameter('id_dem');
                $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_demandeur='" . $request->getParameter('id_dem') . "'");
            }
            if ($request->getParameter('fin') && $request->getParameter('fin') != "") {
                $this->datefin = $request->getParameter('fin');
                $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation<='" . $request->getParameter('debut') . "'");
            }
            if ($request->getParameter('idfrs') && $request->getParameter('idfrs') != "") {
                $this->idfrs = $request->getParameter('idfrs');
                $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_frs=" . $request->getParameter('idfrs'));
            }
            $this->boncommandeexterne = $this->boncommandeexterne->orderBy('id desc')->execute();
        }
        //        $this->type = Doctrine_Core::getTable('typedoc')->findOneById($idtype);
    }

    public function executeBondefinitifcontrat(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;
        $this->formfiletr = new DocumentachatFormFilter();
        //        $idtype = 7;
        $documentachat = new Documentachat();
        $this->form = new DocumentbudgetForm();
        //        if ($request->getParameter('idtype'))
        //            $idtype = $request->getParameter('idtype');
        //        $this->idtype = $idtype;
        $this->boncommandeexterne = null;
        if ($documentachat->getListesBdcDefinitifNonEncoreValiderContrat()) {
            $this->boncommandeexterne = $documentachat->getListesBdcDefinitifNonEncoreValiderContrat();
            $this->datedebut = "";
            $this->datefin = "";
            $this->idfrs = "";
            $this->id_bci = "";
            $this->id_dem = "";
            if ($request->getParameter('debut') && $request->getParameter('debut') != "") {
                $this->datedebut = $request->getParameter('debut');
                $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation>='" . $request->getParameter('debut') . "'");
            }
            if ($request->getParameter('id_bci') && $request->getParameter('id_bci') != "") {
                $this->id_bci = $request->getParameter('id_bci');
                $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_docparent='" . $request->getParameter('id_bci') . "'");
            }
            if ($request->getParameter('id_dem') && $request->getParameter('id_dem') != "") {
                $this->id_dem = $request->getParameter('id_dem');
                $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_demandeur='" . $request->getParameter('id_dem') . "'");
            }
            if ($request->getParameter('fin') && $request->getParameter('fin') != "") {
                $this->datefin = $request->getParameter('fin');
                $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation<='" . $request->getParameter('debut') . "'");
            }
            if ($request->getParameter('idfrs') && $request->getParameter('idfrs') != "") {
                $this->idfrs = $request->getParameter('idfrs');
                $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_frs=" . $request->getParameter('idfrs'));
            }
            $this->boncommandeexterne = $this->boncommandeexterne->orderBy('id desc')->execute();
        }
        //        $this->type = Doctrine_Core::getTable('typedoc')->findOneById($idtype);
    }

    public function executePreengagement(sfWebRequest $request) {
        $this->documentachat = DocumentachatTable::getInstance()->findOneById($request->getParameter('id'));
        $this->forward404Unless($this->documentachat);
        $piece = PiecejointbudgetTable::getInstance()->findByIdDocachat($request->getParameter('id'))->getLast();
//        $this->form = new DocumentbudgetForm();
        if ($piece) {
            $doc = DocumentbudgetTable::getInstance()->findById($piece->getIdDocumentbudget())->getLast();
            if ($doc) {
                $this->form = new DocumentbudgetForm($doc);
            }

            $this->piece = $piece;
        } else {

            $piece_provisoire = PiecejointbudgetTable::getInstance()->findByIdDocachat($this->documentachat->getIdFils())->getLast();
            if ($piece_provisoire) {
                $doc_piece_provisoire = DocumentbudgetTable::getInstance()->findOneById($piece_provisoire->getIdDocumentbudget());
                $this->form = new DocumentbudgetForm($doc_piece_provisoire);
            }
            $this->piece = $piece_provisoire;
        }

        $id = $this->documentachat->getId();

        $bcej = Doctrine_Core::getTable('Documentachat')->findOneByIdDocparentAndIdTypedoc($id, 16);
        if ($bcej) {
            $id = $bcej->getId();
        }
        if ($this->documentachat->getIdFils()) {
            $this->documentfils = DocumentachatTable::getInstance()->findOneById($this->documentachat->getIdFils());
        }

        if ($this->documentachat->getIdDocparent()) {
            $this->documentparent = DocumentachatTable::getInstance()->findOneById($this->documentachat->getIdDocparent());
        }
    }

    public function executePreengagementJeton(sfWebRequest $request) {
        $piece_jeton = null;

        $documentachatjeton = DocumentachatTable::getInstance()->findOneById($request->getParameter('id'));
        $this->documentachatjeton = $documentachatjeton;
        $id_doc = $documentachatjeton->getIdDocparent();
        $this->documentachat = DocumentachatTable::getInstance()->findOneById($id_doc);
        $this->forward404Unless($this->documentachat);

        $piece = PiecejointbudgetTable::getInstance()->findByIdDocachat($id_doc)->getLast();
        $piece_jeton = PiecejointbudgetTable::getInstance()->findByIdDocachat($request->getParameter('id'))->getLast();

        //        $this->form = new DocumentbudgetForm();
        if ($piece) {
            $doc = DocumentbudgetTable::getInstance()->findById($piece->getIdDocumentbudget())->getLast();
            if ($doc) {
                $this->form = new DocumentbudgetForm($doc);
            }

            $this->piece = $piece;
        } else {

            $piece_provisoire = PiecejointbudgetTable::getInstance()->findByIdDocachat($this->documentachat->getIdFils())->getLast();
            if ($piece_provisoire) {
                $doc_piece_provisoire = DocumentbudgetTable::getInstance()->findOneById($piece_provisoire->getIdDocumentbudget());
                $this->form = new DocumentbudgetForm($doc_piece_provisoire);
            }
            $this->piece = $piece_provisoire;
        }
        // $this->form_jeton = new DocumentbudgetForm();
        if ($piece_jeton) {
            $doc_jeton = DocumentbudgetTable::getInstance()->findById($piece_jeton->getIdDocumentbudget())->getLast();
            if ($doc_jeton) {
                $this->form_jeton = new DocumentbudgetForm($doc_jeton);
            }

            $this->piece_jeton = $piece_jeton;
        } else {
            $piece_jeton = new Piecejointbudget();
            $this->form_jeton = new DocumentbudgetForm();
        }
        $this->piece_jeton = $piece_jeton;
        $id = $this->documentachat->getId();

        $bcej = Doctrine_Core::getTable('Documentachat')->findOneByIdDocparentAndIdTypedoc($id, 16);
        if ($bcej) {
            $this->bcej = $bcej;
            $id = $bcej->getId();
        } else {
            $this->bcej = $this->documentachat;
        }
        if ($this->documentachat->getIdFils()) {
            $this->documentfils = DocumentachatTable::getInstance()->findOneById($this->documentachat->getIdFils());
        }

        if ($this->documentachat->getIdDocparent()) {
            $this->documentparent = DocumentachatTable::getInstance()->findOneById($this->documentachat->getIdDocparent());
        }
    }

    public function executePreengagementSansBCI(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->id = $id;
        if ($id) {
            $doc_budget = DocumentbudgetTable::getInstance()->find($id);
            $this->documentbudget = $doc_budget;
            $this->form = new DocumentbudgetForm($doc_budget);
        } else {
            $this->form = new DocumentbudgetForm();
        }
    }

    public function executePreengagementSansBCII(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->id = $id;
        if ($id) {
            $doc_budget = DocumentbudgetTable::getInstance()->find($id);
            $this->documentbudget = $doc_budget;
            $this->form = new DocumentbudgetForm($doc_budget);
        } else {
            $this->form = new DocumentbudgetForm();
        }
    }

    public function executePreengagementBDC(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));

        $documentachat = $this->documentachat;
        //        $documentachat->setIdEtatdoc(28);
        $documentachat->save();
        $this->forward404Unless($this->documentachat);
        $piece = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($this->documentachat->getId());
        $idpiece = 0;
        $this->tab = "";
        if ($request->getParameter('tab')) {
            $this->tab = $request->getParameter('tab');
        }

        $this->form = new DocumentbudgetForm();
        if ($piece) {
            $idpiece = $piece->getId();

            $doc = Doctrine_Core::getTable('documentbudget')->findOneById($piece->getIdDocumentbudget());
            if ($doc) {
                $this->form = new DocumentbudgetForm($doc);
            }
        } else {
            $piece_provisoire = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($this->documentachat->getIdFils());
            //            $piece_provisoire = PiecejointbudgetTable::getInstance()->getByIdDocAchat($this->documentachat->getIdFils());

            if (sizeof($piece_provisoire) >= 1) {
                $doc_piece_provisoire = Doctrine_Core::getTable('documentbudget')->findOneById($piece_provisoire->getIdDocumentbudget());
                $this->form = new DocumentbudgetForm($doc_piece_provisoire);
            }
        }
        $this->trouve_facture = 0;
        $id = $this->documentachat->getId();

        $bcej = Doctrine_Core::getTable('Documentachat')->findOneByIdDocparentAndIdTypedoc($id, 16);
        if ($bcej) {
            $id = $bcej->getId();
        }
        $this->facture = Doctrine_Core::getTable('Documentachat')->findOneByIdDocparentAndIdTypedoc($id, 15);
        if ($this->facture) {
            $this->trouve_facture = 1;
        }
    }

    public function executePreengagementContrat(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $documentachat = $this->documentachat;
        //       $documentachat->setIdEtatdoc(28);
        $documentachat->save();
        $this->forward404Unless($this->documentachat);
        $piece = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($this->documentachat->getId());
        $idpiece = 0;
        $this->tab = "";
        if ($request->getParameter('tab')) {
            $this->tab = $request->getParameter('tab');
        }

        $this->form = new DocumentbudgetForm();
        if ($piece) {
            $idpiece = $piece->getId();

            $doc = Doctrine_Core::getTable('documentbudget')->findOneById($piece->getIdDocumentbudget());
            if ($doc) {
                $this->form = new DocumentbudgetForm($doc);
            }
        } else {
            $piece_provisoire = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($this->documentachat->getIdFils());
            $doc_piece_provisoire = Doctrine_Core::getTable('documentbudget')->findOneById($piece_provisoire->getIdDocumentbudget());
            $this->form = new DocumentbudgetForm($doc_piece_provisoire);
        }
        $this->trouve_facture = 0;
        $id = $this->documentachat->getId();

        $bcej = Doctrine_Core::getTable('Documentachat')->findOneByIdDocparentAndIdTypedoc($id, 16);
        if ($bcej) {
            $id = $bcej->getId();
        }
        $this->facture = Doctrine_Core::getTable('Documentachat')->findOneByIdDocparentAndIdTypedoc($id, 15);
        if ($this->facture) {
            $this->trouve_facture = 1;
        }
    }

    public function executePreengagementAvenantContrat(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->contratachat = Doctrine_core::getTable('contratachat')->find(array($request->getParameter('id_contrat')));
        $documentachat = $this->documentachat;
        //       $documentachat->setIdEtatdoc(28);
        $documentachat->save();
        $this->forward404Unless($this->documentachat);
        $piece = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($this->documentachat->getId());
        $idpiece = 0;
        $this->tab = "";
        if ($request->getParameter('tab')) {
            $this->tab = $request->getParameter('tab');
        }

        $this->form = new DocumentbudgetForm();
        if ($piece) {
            $idpiece = $piece->getId();

            $doc = Doctrine_Core::getTable('documentbudget')->findOneById($piece->getIdDocumentbudget());
            if ($doc) {
                $this->form = new DocumentbudgetForm($doc);
            }
        } else {
            $piece_provisoire = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($this->documentachat->getIdFils());
            $doc_piece_provisoire = Doctrine_Core::getTable('documentbudget')->findOneById($piece_provisoire->getIdDocumentbudget());
            $this->form = new DocumentbudgetForm($doc_piece_provisoire);
        }
        $this->trouve_facture = 0;
        $id = $this->documentachat->getId();

        $bcej = Doctrine_Core::getTable('Documentachat')->findOneByIdDocparentAndIdTypedoc($id, 16);
        if ($bcej) {
            $id = $bcej->getId();
        }
        $this->facture = Doctrine_Core::getTable('Documentachat')->findOneByIdDocparentAndIdTypedoc($id, 15);
        if ($this->facture) {
            $this->trouve_facture = 1;
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

    public function executeDeleteBudget(sfWebRequest $request) {
        $request->checkCSRFProtection();
        $this->forward404Unless($documentbudget = Doctrine_Core::getTable('documentbudget')->find(array($request->getParameter('id'))), sprintf('Object documentachat does not exist (%s).', $request->getParameter('id')));
        $piecejointbudget = PiecejointbudgetTable::getInstance()->findOneByIdDocumentbudget($documentbudget->getId());
        // $piecejointbudget->delete();
        $id_ligpro = $documentbudget->getIdBudget();

        /*         * *********edit Ligprotitrub  *************************** */
        $ligp = LigprotitrubTable::getInstance()->findOneById($id_ligpro);
        $mntengager = $documentbudget->getMnt();
        $mnt_enga_lig = $ligp->getMntengage();
        $nv_mnt_eng = $mnt_enga_lig - $mntengager;
        $ligp->setMntengage($nv_mnt_eng);
        $mnt_relica = $ligp->getMnt() - $nv_mnt_eng;
        $ligp->setRelicaengager($mnt_relica);
        $ligp->save();
        /*         * ***********************edit recap ********************* */

        $mois = date('m');
        if ($mois < 10) {
            $mois = intval(substr($mois, -1));
        } else {
            $mois = intval($mois);
        }

        $recap_budgets = RecapbudgetTable::getInstance()->getByIdLigrubMois($id_ligpro, $mois);
        //  die(count($recap_budgets) . "ed");
        foreach ($recap_budgets as $recap_budget):
            if ($recap_budget->getMois() >= $mois):
                $mnt_aloue_recap = $recap_budget->getMntEncager() - $mntengager;
                $recap_budget->setMntEncager($mnt_aloue_recap);
                $recap_budget->save();
            endif;
        endforeach;
        /*         * *************edit Ligprotitrub parent ** */
        $rubrique = RubriqueTable::getInstance()->findOneById($ligp->getIdRubrique());
        if ($rubrique->getIdRubrique()) {
            $id_rubrique_pare = $rubrique->getIdRubrique();
            $id_titre_budget = $ligp->getIdTitre();
            $ligp_parent = LigprotitrubTable::getInstance()->getSousrubriqueByTitreBudget($id_titre_budget, $id_rubrique_pare);
            $mntengager = $documentbudget->getMnt();
            $mnt_enga_lig_parent = $ligp_parent->getFirst()->getMntengage();

            $nv_mnt_eng_parent = $mnt_enga_lig_parent - $mntengager;
            $ligp->setMntengage($nv_mnt_eng_parent);
            $mnt_relica_parent = $ligp_parent->getFirst()->getMnt() - $nv_mnt_eng_parent;
            $ligp_parent->getFirst()->setRelicaengager($mnt_relica_parent);
            $ligp_parent->getFirst()->save();

            /*             * *****************edit recap parent ********************* */
            $mois = date('m');
            if ($mois < 10) {
                $mois = intval(substr($mois, -1));
            } else {
                $mois = intval($mois);
            }

            $recap_budgets_parent = RecapbudgetTable::getInstance()->getByIdLigrubMois($ligp_parent->getFirst()->getId(), $mois);
            foreach ($recap_budgets_parent as $recap_budget):
                if ($recap_budget->getMois() >= $mois):
                    $mnt_aloue_recap = $recap_budget->getMntAllouer() - $mntengager;
                    $recap_budget->setMntAllouer($mnt_aloue_recap);
                    $recap_budget->save();
                endif;
            endforeach;
        }
        $documentbudget->setAnnule(true);
        $documentbudget->save();
        $this->redirect('documentbudget_DocumentDef');
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
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
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
        if ($request->getParameter('idtytpe')) {
            $idtype = $request->getParameter('idtytpe');
        }

        $html = $this->ReadHtmlDocProvisoire($iddoc, $doc_budget, $idtype);

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

    public function ReadHtmlDocProvisoire($iddoc, $doc_budget, $idtype) {
        $html = StyleCssHeader::header1();
        $html .= $doc_budget->getHtmlDocProvisoire($iddoc, $idtype);

        return $html;
    }

    public function executeImprimerprovisoireBDC(sfWebRequest $request) {
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
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
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
        if ($request->getParameter('idtytpe')) {
            $idtype = $request->getParameter('idtytpe');
        }

        $html = $this->ReadHtmlDocProvisoireBDC($iddoc, $doc_budget, $idtype);

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

    public function ReadHtmlDocProvisoireBDC($iddoc, $doc_budget, $idtype) {
        $html = StyleCssHeader::header1();
        $html .= $doc_budget->getHtmlDocProvisoireBDC($iddoc, $idtype);

        return $html;
    }

    public function executeImprimerprovisoireavenantcontrat(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $iddoc = $request->getParameter('iddoc');
        $id = $request->getParameter('idfiche');
        $doc_budget = $doc = Doctrine_Core::getTable('documentbudget')->findOneById($id);
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche Budget N°:');
        $pdf->SetSubject("fiche Budget");
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
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
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
        if ($request->getParameter('idtytpe')) {
            $idtype = $request->getParameter('idtytpe');
        }

        $html = $this->ReadHtmlDocProvisoireAvenantContrat($iddoc, $doc_budget, $idtype);

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

    public function ReadHtmlDocProvisoireAvenantContrat($iddoc, $doc_budget, $idtype) {
        $html = StyleCssHeader::header1();
        $html .= $doc_budget->getHtmlDocProvisoireAvenant($iddoc, $doc_budget, $idtype);

        return $html;
    }

    public function executeImprimerfichebudget(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $id = $request->getParameter('idfiche');
        $titrebudget = Doctrine_Core::getTable('titrebudjet')->findOneById($id);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Budget N°:');
        $pdf->SetSubject("fiche budget");
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
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        //        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set auto page breaks
        //        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(true, 13);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
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

        $html = $this->ReadHtmlBudget($societe, $titrebudget);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Fiche Budget : ' . $titrebudget->getLibelle() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBudget($societe, $titrebudget) {
        $html = StyleCssHeader::header1();
        $user = $this->getUser()->getAttribute('userB2m');
        $html .= $titrebudget->getHtmlBudget($user);

        return $html;
    }

    public function executeImprimerdocentre(sfWebRequest $request) {

        $iddoc = $request->getParameter('iddoc');

        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

        $listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);

        // pdf object
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche BCI N°:');
        $pdf->SetSubject("document d'achat");
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
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        //        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(10, 30, 10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
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
        //die($documentachat->getIdTypedoc().'gg');
        //die($html);
        if ($documentachat->getIdTypedoc() == 10) {
            $html = $this->ReadHtmlBonEntrer($societe, $documentachat, $listesdocuments);
        }

        if ($documentachat->getIdTypedoc() == 11) {
            $html = $this->ReadHtmlBonSortie($societe, $documentachat, $listesdocuments);
        }

        if ($documentachat->getIdTypedoc() == 13) {
            $html = $this->ReadHtmlBonTransfert($societe, $documentachat, $listesdocuments);
        }

        if ($documentachat->getIdTypedoc() == 12) {
            $html = $this->ReadHtmlBonRetour($societe, $documentachat, $listesdocuments);
        }

        if ($documentachat->getIdTypedoc() == 14) {
            $html = $this->ReadHtmlAvoir($societe, $documentachat, $listesdocuments);
        }

        if ($documentachat->getIdTypedoc() == 15) {
            $html = $this->ReadHtmlFacture($societe, $documentachat, $listesdocuments);
        }

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('documentachat' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBonEntrer($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBonEntree();
        //die($html);
        return $html;
    }

    public function ReadHtmlFacture($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlFactureImression($documentachat->getId());
        //die($html);
        return $html;
    }

    public function ReadHtmlAvoir($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlAvoir();
        //die($html);
        return $html;
    }

    public function ReadHtmlBonSortie($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBonSortie();
        //die($html);
        return $html;
    }

    public function ReadHtmlBonTransfert($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBonTransfert();
        //die($html);
        return $html;
    }

    public function ReadHtmlBonRetour($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBonRetour();
        //die($html);
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
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        //        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
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
        $html .= $documentachat->getHtmlDemandedeprix();
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
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
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
        $html .= $documentachat->ReadHtmlBondeponse();
        //die($html);
        return $html;
    }

    public function executeImprimertousbondeponse(sfWebRequest $request) {
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
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
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
        $idtype = $request->getParameter('idtype');

        $html = $this->ReadHtmlTousBondeponse($societe, $documentachat, $listesdocuments, $idtype);
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

    public function ReadHtmlTousBondeponse($societe, $documentachat, $listesdocuments, $idtype) {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlTousBondeponse($idtype);
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
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 12, '', true);
        $pdf->AddPage();

        $html = $this->ReadHtmlBonexterne($documentachat);

        // Print text using writeHTMLCell()
        // output the HTML content
        ob_end_clean();
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
        $html .= $documentachat->ReadHtmlBonexterne();
        //die($html);
        return $html;
    }

    public function executeImprimerAnnexBCEP(sfWebRequest $request) {
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
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
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
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
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

        $html = $this->ReadHtmlAnnexe($documentachat);

        // Print text using writeHTMLCell()
        // output the HTML content
        ob_end_clean();
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Bon commande ' . $documentachat->getNumero() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlAnnexe($documentachat) {
        $html = StyleCssHeader::header1();
        $doc = new Documentachat();
        $html .= $documentachat->ReadHtmlAnnexe();
        //die($html);
        return $html;
    }

    public function executeImprimerAnnexebonexterne(sfWebRequest $request) {
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
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
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
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
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

        $html = $this->ReadHtmlAnnexeBCE($documentachat);

        // Print text using writeHTMLCell()
        // output the HTML content
        ob_end_clean();
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Bon commande ' . $documentachat->getNumero() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlAnnexeBCE($documentachat) {
        $html = StyleCssHeader::header1();
        $doc = new Documentachat();
        $html .= $documentachat->ReadHtmlAnnexe();
        //die($html);
        return $html;
    }

    public function executeAffichesourceSanBci(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $table = $params['table'];

            if ($table == "titrebudjet") {
                $id = $params['id'];
                if ($id) {
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                    $query = "SELECT ligprotitrub.id, ligprotitrub.nordre, ligprotitrub.code, "
                            . " rubrique.libelle, ligprotitrub.mnt, "
                            . " ligprotitrub.mntengage, ligprotitrub.mntdeponser, "
                            . " ligprotitrub.mntencaisse, mntprovisoire "
                            . " FROM ligprotitrub, rubrique "
                            . " WHERE ligprotitrub.id_rubrique = rubrique.id "
                            . " AND ligprotitrub.id_titre = " . $id . " "
                            . " order by ligprotitrub.nordre asc";
                    $titresBudget = $conn->fetchAssoc($query);

                    die(json_encode($titresBudget));
                }
            }
        }
        die('Erreur');
    }

}
