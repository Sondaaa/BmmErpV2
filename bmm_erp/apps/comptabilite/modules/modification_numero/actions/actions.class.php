<?php

/**
 * renumerotation actions.
 *
 * @package    sw-commerciale
 * @subpackage renumerotation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class modification_numeroActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $this->journals = JournalcomptableTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id);
    }

    public function executeGetSeriesJournal(sfWebRequest $request) {
        $journal = $request->getParameter('journal');
        $series = NumeroseriejournalTable::getInstance()->findByIdJournal($journal);
        return $this->renderPartial('liste_series', array('series' => $series));
    }

    public function executeGetPiecesJournal(sfWebRequest $request) {
        $journal = $request->getParameter('journal');
        $serie = $request->getParameter('serie');
        $type_tri = $request->getParameter('type_tri', '');
        $tri = $request->getParameter('tri', '');

        $numero_serie = NumeroseriejournalTable::getInstance()->find($serie);
        $numero = trim($numero_serie->getPrefixe()) . trim(sprintf("%03s", $numero_serie->getAttendu()));
        $prefixe = trim($numero_serie->getPrefixe());
        $pieces = PiececomptableTable::getInstance()->loadBySerie($journal, $serie, $type_tri, $tri);

        return $this->renderPartial('liste_pieces', array('pieces' => $pieces, 'numero' => $numero, 'prefixe' => $prefixe));
    }
    
    public function executeGetPiecesJournalForJournal(sfWebRequest $request) {
        $journal = $request->getParameter('journal');
        $serie = $request->getParameter('serie');
        $type_tri = $request->getParameter('type_tri', '');
        $tri = $request->getParameter('tri', '');

        $numero_serie = NumeroseriejournalTable::getInstance()->find($serie);
        $numero = trim($numero_serie->getPrefixe()) . trim(sprintf("%03s", $numero_serie->getAttendu()));
        $prefixe = trim($numero_serie->getPrefixe());
        $pieces = PiececomptableTable::getInstance()->loadBySerie($journal, $serie, $type_tri, $tri);

        return $this->renderPartial('liste_pieces_journal', array('pieces' => $pieces, 'numero' => $numero, 'prefixe' => $prefixe));
    }

    public function executeListe(sfWebRequest $request) {
        $this->pager = $this->paginate($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function executeGoPage(sfWebRequest $request) {
        $this->pager = $this->paginate($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function executeDelete(sfWebRequest $request) {
        $id = $request->getParameter('id');

        $piece = PiececomptableTable::getInstance()->find($id);
        $piece->delete();

        $this->pager = $this->paginate($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function executeShow(sfWebRequest $request) {
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

    public function executeSaveModifNum(sfWebRequest $request) {
        $piece_id = $request->getParameter('piece_id');
        $nouveau_numero = $request->getParameter('nouveau_numero');
        $nouvelle_serie = $request->getParameter('nouvelle_serie');
        $nouvelle_date = $request->getParameter('nouvelle_date');

        if ($nouveau_numero != '') {
            $piece = PiececomptableTable::getInstance()->find($piece_id);
            $piece->setAncienNumero($piece->getNumero());
            $piece->setNumero($nouveau_numero);
            $piece->setIdSerie($nouvelle_serie);
            $piece->setDaterenumerotation(date('Y-m-d'));
            $piece->setDate($nouvelle_date);
            $piece->save();
            $this->updateAttenduLastNumber($nouvelle_serie, $nouveau_numero);
        }

        return true;
    }

    public function updateAttenduLastNumber($serie_id, $numero) {
        $numero_serie = NumeroseriejournalTable::getInstance()->find($serie_id);
        $numero_courant = trim($numero_serie->getPrefixe()) . trim(sprintf("%03s", $numero_serie->getAttendu()));
        if ($numero_courant == $numero) {
            $attendu = $numero_serie->getNumerofin() + 1;
            if ($numero_serie->getPiececomptable()->count() != 1) {
                if ($numero_serie->getNumerofin() < $numero_serie->getAttendu() && $numero_serie->getAttendu() != 1) {
                    $numero_serie->setNumerofin($numero_serie->getAttendu());
                    $numero_serie->save();
                }
            }

            $attendu = $numero_serie->getAttendu();

            //test si attendu existe ou non
            $test_numero = trim($numero_serie->getPrefixe()) . trim(sprintf("%03s", $attendu));
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
        $test_numero = trim($numero_serie->getPrefixe()) . trim(sprintf("%03s", $attendu));
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

    public function paginate(sfWebRequest $request) {
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
        $pager->setQuery(PiececomptableTable::getInstance()->loadAllFiltre($journal, $num, $statut, $date_debut, $date_fin, $num_debut, $num_fin, $type_tri, $tri));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeModificationJournal(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $this->journals = JournalcomptableTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id);
    }

    public function executeGetJournalModifJournal(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $journal = JournalcomptableTable::getInstance()->find($id);
        $comptes = PlancomptableTable::getInstance()->findOrderByNumero();
        $type_journals = TypejournalTable::getInstance()->findAll();
        $dossiers = DossiercomptableTable::getInstance()->FindAll();
        return $this->renderPartial('edit_journal', array('dossiers' => $dossiers, 'journal' => $journal, 'comptes' => $comptes, 'type_journals' => $type_journals));
    }

    public function executeShowFormDate($request) {
        $id = $request->getParameter('id');
        $this->piece = PiececomptableTable::getInstance()->find($id);
    }
    
    public function executeShowFormDateForJournal($request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $id = $request->getParameter('id');
        $this->piece = PiececomptableTable::getInstance()->find($id);
        $this->journals = JournalcomptableTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id);
    }
    
    public function executeSaveModifNumJournal(sfWebRequest $request) {
        $piece_id = $request->getParameter('piece_id');
        $nouveau_numero = $request->getParameter('nouveau_numero');
        $nouvelle_serie = $request->getParameter('nouvelle_serie');
        $nouveau_journal = $request->getParameter('nouveau_journal');

        if ($nouveau_numero != '') {
            $piece = PiececomptableTable::getInstance()->find($piece_id);
            $piece->setAncienNumero($piece->getNumero());
            $piece->setNumero($nouveau_numero);
            $piece->setIdSerie($nouvelle_serie);
            $piece->setDaterenumerotation(date('Y-m-d'));
            $piece->setIdJournalcomptable($nouveau_journal);
            $piece->save();
            $this->updateAttenduLastNumber($nouvelle_serie, $nouveau_numero);
        }

        return true;
    }

}
