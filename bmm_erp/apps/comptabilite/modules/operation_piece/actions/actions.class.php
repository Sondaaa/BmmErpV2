<?php

/**
 * operation_piece actions.
 *
 * @package    sw-commerciale
 * @subpackage operation_piece
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class operation_pieceActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
    }

    public function executeSuppression(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $this->journals = JournalcomptableTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id);
    }

    public function executeGoPageSuppression(sfWebRequest $request) {
        $pager = $this->paginate($request);
        $page = $request->getParameter('page', 1);
        return $this->renderPartial("liste_suppression", array("pager" => $pager, "page" => $page));
    }

    public function executeDeleteSuppression(sfWebRequest $request) {
        $id = $request->getParameter('id');

        $piece = PiececomptableTable::getInstance()->find($id);
        $serie = NumeroseriejournalTable::getInstance()->find($piece->getSerieId());

        $attendu = $serie->getAttendu();
        $prefixe = $serie->getPrefixe();
        $numero = $piece->getNumero();

        $numero_sans_prefixe = str_replace($prefixe, ",", $numero);
        $numero_sans_prefixe = explode(',', $numero_sans_prefixe);

        if (intval($numero_sans_prefixe[1]) < $attendu) {
            $serie->setAttendu(($numero_sans_prefixe[1]));
            $serie->save();
        }
        foreach ($piece->getLignepiececomptable() as $ligne) {
            $ligne->delete();
        }

        $piece->delete();

        $pager = $this->paginate($request);
        $page = $request->getParameter('page', 1);
        return $this->renderPartial("liste_suppression", array("pager" => $pager, "page" => $page));
    }

    public function executeShowSuppression(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->piece = PiececomptableTable::getInstance()->find($id);
    }

    public function executeShowProprieteSuppression(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->piece = PiececomptableTable::getInstance()->find($id);
    }

    public function paginate(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $journal = $request->getParameter('journal', '');
        $num = $request->getParameter('num', '');
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');

        $exercice_id = $_SESSION['exercice_id'];

        $num_debut = $request->getParameter('num_debut', '');
        $num_fin = $request->getParameter('num_fin', '');
        $type_tri = $request->getParameter('type_tri', '');
        $tri = $request->getParameter('tri', '');
        $journal_id = $request->getParameter('journal_id', '');

        $pager = new sfDoctrinePager('Piececomptable', 5);
        $pager->setQuery(PiececomptableTable::getInstance()->loadAllFiltre($journal, $num, $date_debut, $date_fin, $num_debut, $num_fin, $type_tri, $tri, $journal_id, $exercice_id));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeDuplication(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $this->journals = JournalcomptableTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id);
    }

    public function executeDupliquer(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $piece = PiececomptableTable::getInstance()->find($id);
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $journal_piece = JournalcomptableTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id);
        return $this->renderPartial("zone_duplication", array("piece" => $piece, "journal_piece" => $journal_piece));
    }

    public function executeGoPageDuplication(sfWebRequest $request) {
        $pager = $this->paginate($request);
        $page = $request->getParameter('page', 1);
        return $this->renderPartial("liste_dupliquer", array("pager" => $pager, "page" => $page));
    }

    public function executeValiderDupliquerPiece(sfWebRequest $request) {
        $journal = $request->getParameter('journal');
        $date = $request->getParameter('date');
        $numero = $request->getParameter('numero');
        $libelle = $request->getParameter('libelle');
        $serie_id = $request->getParameter('serie_id');

        $piece_source_id = $request->getParameter('piece_source');

        $piece_source = PiececomptableTable::getInstance()->find($piece_source_id);

        $user =  $this->getUser()->getAttribute('userB2m');
        $exercice_id = $_SESSION['exercice_id'];

        $piece = new Piececomptable();
        $piece->setIdJournalcomptable($journal);
        $piece->setDate($date);
        $piece->setDatecreation(date('Y-m-d'));
        $piece->setIdUser($user->getId());
        $piece->setNumero($numero);
        $piece->setIdSerie($serie_id);
        $piece->setTotaldebit($piece_source->getTotaldebit());
        $piece->setTotalcredit($piece_source->getTotalcredit());
        $piece->setLibelle($libelle);
        $piece->setIdPiecesource($piece_source_id);
        $piece->setIdExercice($exercice_id);

        $piece->save();

        $this->updateAttenduLastNumber($serie_id, $numero);

        foreach ($piece_source->getLignepiececomptable() as $ligne) {

            $ligne_piece = new Lignepiececomptable();

            $ligne_piece->setIdComptecomptable($ligne->getIdComptecomptable());
            $ligne_piece->setIdContrepartie($ligne->getIdContrepartie());
            $ligne_piece->setDate(date('Y-m-d'));
            $ligne_piece->setMontantcredit($ligne->getMontantcredit());
            $ligne_piece->setMontantdebit($ligne->getMontantdebit());
            $ligne_piece->setIdNaturepiece($ligne->getIdNaturepiece());
            $ligne_piece->setIdPiececomptable($piece->getId());

            $ligne_piece->save();
        }

        die($piece_source_id);
    }

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
    public function executeListePieceDuplique(sfWebRequest $request) {
        $this->pager = $this->paginateDuplique($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function executeGoPage(sfWebRequest $request) {
        $this->pager = $this->paginateDuplique($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function executeDelete(sfWebRequest $request) {
        $id = $request->getParameter('id');

        $piece = PiececomptableTable::getInstance()->find($id);
        $piece->delete();

        $this->pager = $this->paginateDuplique($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function executeShow(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->piece = PiececomptableTable::getInstance()->find($id);
    }

    public function executeAfficher(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->piece = PiececomptableTable::getInstance()->find($id);
    }

    public function executeShowSource(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->piece = PiececomptableTable::getInstance()->find($id);
    }

    public function executeShowPropriete(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->piece = PiececomptableTable::getInstance()->find($id);
    }

    public function paginateDuplique(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $journal = $request->getParameter('journal', '');
        $num = $request->getParameter('num', '');
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');

        $num_debut = $request->getParameter('num_debut', '');
        $num_fin = $request->getParameter('num_fin', '');
        $type_tri = $request->getParameter('type_tri', '');
        $tri = $request->getParameter('tri', '');
        $journal_id = $request->getParameter('journal_id', '');

        $exercice_id = $_SESSION['exercice_id'];

        $pager = new sfDoctrinePager('Piececomptable', 5);
        $pager->setQuery(PiececomptableTable::getInstance()->loadAllFiltreDuplique($journal, $num, $date_debut, $date_fin, $num_debut, $num_fin, $type_tri, $tri, $journal_id, $exercice_id));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeLiberation(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $this->journals = JournalcomptableTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id);
    }

    public function executeListePieceLibere(sfWebRequest $request) {
        $this->pager = $this->paginateLiberer($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function executeGoPageLibere(sfWebRequest $request) {
        $this->pager = $this->paginateLiberer($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function executeGoPageLiberation(sfWebRequest $request) {
        $pager = $this->paginateLiberation($request);
        $page = $request->getParameter('page', 1);
        return $this->renderPartial("liste_liberation", array("pager" => $pager, "page" => $page));
    }

    public function executeLiberer(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $piece = PiececomptableTable::getInstance()->find($id);
        $piece->setDateliberation(date('Y-m-d'));
        $piece->setLiberer(1);
        $piece->setIdPiecesource(null);
        $piece->save();

        $pager = $this->paginateLiberation($request);
        $page = $request->getParameter('page', 1);
        return $this->renderPartial("liste_liberation", array("pager" => $pager, "page" => $page));
    }

    public function executeLibererTout(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $piece_source = PiececomptableTable::getInstance()->find($id);
        foreach ($piece_source->getPiececomptable() as $piece) {
            $piece->setDateliberation(date('Y-m-d'));
            $piece->setLiberer(1);
            $piece->setIdPiecesource(null);
            $piece->save();
        }


        $pager = $this->paginateLiberation($request);
        $page = $request->getParameter('page', 1);
        return $this->renderPartial("liste_liberation", array("pager" => $pager, "page" => $page));
    }

    public function paginateLiberer(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $journal = $request->getParameter('journal', '');
        $num = $request->getParameter('num', '');
        $statut = $request->getParameter('statut', '');
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');

        $num_debut = $request->getParameter('num_debut', '');
        $num_fin = $request->getParameter('num_fin', '');
        $type_tri = $request->getParameter('type_tri', '');
        $tri = $request->getParameter('tri', '');

        $pager = new sfDoctrinePager('Piececomptable', 5);
        $pager->setQuery(PiececomptableTable::getInstance()->loadAllFiltreLiberer($journal, $num, $statut, $date_debut, $date_fin, $num_debut, $num_fin, $type_tri, $tri));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function paginateLiberation(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $journal = $request->getParameter('journal', '');
        $num = $request->getParameter('num', '');
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');

        $num_debut = $request->getParameter('num_debut', '');
        $num_fin = $request->getParameter('num_fin', '');
        $type_tri = $request->getParameter('type_tri', '');
        $tri = $request->getParameter('tri', '');
        $journal_id = $request->getParameter('journal_id', '');

        $exercice_id = $_SESSION['exercice_id'];

        $array = Doctrine_Query::create()
                ->select("id_piecesource")
                ->from('Piececomptable p')
                ->leftJoin('p.Journalcomptable j')
                ->where('id_piecesource IS NOT NULL')
                ->andwhere('p.id_exercice=' . $exercice_id)
                ->andWhere('j.id_dossier =' . $_SESSION['dossier_id'])
                ->fetchArray();

        $pager = new sfDoctrinePager('Piececomptable', 5);
        $pager->setQuery(PiececomptableTable::getInstance()->loadAllFiltreLiberation($journal, $num, $date_debut, $date_fin, $num_debut, $num_fin, $type_tri, $tri, $journal_id, $exercice_id));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeGetPieceDupliqueeForLiberer(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->piece = PiececomptableTable::getInstance()->find($id);
    }

}
