<?php

/**
 * renumerotation actions.
 *
 * @package    sw-commerciale
 * @subpackage renumerotation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class renumerotationActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $this->journals = JournalComptableTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id);
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
//        $numero = trim($numero_serie->getPrefixe()) . trim(sprintf("%03s", $numero_serie->getAttendu()));
        $numero = trim($numero_serie->getPrefixe()) . trim(sprintf("%03s", $numero_serie->getNumerodebut()));

        $pieces = PiececomptableTable::getInstance()->loadBySerie($journal, $serie, $type_tri, $tri);

        return $this->renderPartial('liste_pieces', array('pieces' => $pieces, 'numero' => $numero));
    }

    public function executeListe(sfWebRequest $request) {
        $this->pager = $this->paginate($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function executeGoPage(sfWebRequest $request) {
        $pager = $this->paginate($request);
        $page = $request->getParameter('page', 1);
        return $this->renderPartial('liste', array('pager' => $pager, 'page' => $page));
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

    public function paginate(sfWebRequest $request) {
        $exercice_id = $_SESSION['exercice_id'];

        $page = $request->getParameter('page', 1);
        $journal = $request->getParameter('journal', '');
        $num = $request->getParameter('num', '');
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');

        $num_debut = $request->getParameter('num_debut', '');
        $num_fin = $request->getParameter('num_fin', '');
        $type_tri = $request->getParameter('type_tri', '');
        $tri = $request->getParameter('tri', '');

        $pager = new sfDoctrinePager('Piececomptable', 5);
        $pager->setQuery(PiececomptableTable::getInstance()->loadAllFiltreRenumerotation($journal, $num, $date_debut, $date_fin, $num_debut, $num_fin, $type_tri, $tri, $exercice_id));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeSaveNumerotation($request) {
        $serie_id = $request->getParameter('serie_id');
        $lignes = $request->getParameter('lignes');
        $nouveau_numeros = $request->getParameter('new_number');

        $lignes = explode(',', $lignes);
        $nouveau_numeros = explode(',', $nouveau_numeros);
        $last_numero = '';
        
        for ($i = 0; $i < sizeof($lignes); $i++) {
            if ($lignes[$i] != '') {
                $piece = PiececomptableTable::getInstance()->find($lignes[$i]);
                $piece->setAnciennumero($piece->getNumero());
                $piece->setNumero($nouveau_numeros[$i]);
                $piece->setDaterenumerotation(date('Y-m-d'));
                $piece->save();

                $last_numero = $nouveau_numeros[$i];
            }
        }

        if ($last_numero != '') {
            $last_numero = intval(substr($last_numero, 4));
            $serie = NumeroseriejournalTable::getInstance()->find($serie_id);
            $serie->setNumerofin($last_numero);
            $last_numero++;
            $serie->setAttendu($last_numero);
            $serie->save();
        }

        return true;
    }

}
