<?php

/**
 * multicriteres actions.
 *
 * @package    sw-commerciale
 * @subpackage multicriteres
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class multicriteresActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
    }

    public function executeReimputation(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];

        $this->journals = JournalcomptableTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id);
    }

    public function executeReimpiter(sfWebRequest $request) {
        $ids = split(',', $request->getParameter('arrayid'));
        $id_compte = $request->getParameter('id_compte');
        for ($i = 0; $i < count($ids); $i++) {
            if ($ids[$i] != 'undefined') {
                $fiche = new Lignepiececomptable();
                $fiche = LignepiececomptableTable::getInstance()->findOneById($ids[$i]);
                $fiche->setIdComptecomptable($id_compte);
                $fiche->save();
            }
        }
        die('ok');
    }

    public function executeAfficherEtatJournalSeul(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut');
        $date_fin = $request->getParameter('date_fin');
        $journal_id = $request->getParameter('journal_id', '');
        $compte_id = $request->getParameter('compte_id', '');
        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = $_SESSION['exercice'] . '-01-01';

        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = $_SESSION['exercice'] . '-12-31';
        if ($journal_id != '')
            $journal = JournalcomptableTable::getInstance()->find($journal_id);
        $etatJournal = LignepiececomptableTable::getInstance()->loadEtatJournalSeulParCommte($compte_id, $journal_id, $date_debut, $date_fin);

        return $this->renderPartial("etat_journal_seul", array("etatJournal" => $etatJournal, "date_debut" => $date_debut, "date_fin" => $date_fin));
    }

    public function executeGetFiltreMulticritere(sfWebRequest $request) {

        $filtre = $request->getParameter('filtre');
        $partial = 'recherche_' . $filtre;
        return $this->renderPartial($partial, array());
    }

    public function executeRechercheDatePiece(sfWebRequest $request) {

        $page = $request->getParameter('page', 1);
        $operation = $request->getParameter('operation');
        $date = $request->getParameter('date', '');
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');

        $filtre = $request->getParameter('filtre');

        $pager = new sfDoctrinePager('PieceComptable', 10);
        $pager->setQuery(PieceComptableTable::getInstance()->loadByDatePiece($date, $date_debut, $date_fin, $operation));
        $pager->setPage($page);
        $pager->init();

        return $this->renderPartial('liste_multicritere', array('pager' => $pager, 'page' => $page, 'filtre' => $filtre, 'operation' => $operation, 'date' => $date, 'date_debut' => $date_debut, 'date_fin' => $date_fin));
    }

    public function executeRechercheDateSaisie(sfWebRequest $request) {

        $page = $request->getParameter('page', 1);
        $operation = $request->getParameter('operation');
        $date = $request->getParameter('date');
        $date_debut = $request->getParameter('date_debut');
        $date_fin = $request->getParameter('date_fin');

        $filtre = $request->getParameter('filtre');

        $pager = new sfDoctrinePager('PieceComptable', 10);
        $pager->setQuery(PieceComptableTable::getInstance()->loadByDateSaisie($date, $date_debut, $date_fin, $operation));
        $pager->setPage($page);
        $pager->init();

        return $this->renderPartial('liste_multicritere', array('pager' => $pager, 'page' => $page, 'filtre' => $filtre, 'operation' => $operation, 'date' => $date, 'date_debut' => $date_debut, 'date_fin' => $date_fin));
    }

    public function executeRechercheDateModification(sfWebRequest $request) {

        $page = $request->getParameter('page', 1);
        $operation = $request->getParameter('operation');
        $date = $request->getParameter('date');
        $date_debut = $request->getParameter('date_debut');
        $date_fin = $request->getParameter('date_fin');

        $filtre = $request->getParameter('filtre');

        $pager = new sfDoctrinePager('PieceComptable', 10);
        $pager->setQuery(PieceComptableTable::getInstance()->loadByDateModification($date, $date_debut, $date_fin, $operation));
        $pager->setPage($page);
        $pager->init();

        return $this->renderPartial('liste_multicritere', array('pager' => $pager, 'page' => $page, 'filtre' => $filtre, 'operation' => $operation, 'date' => $date, 'date_debut' => $date_debut, 'date_fin' => $date_fin));
    }

    public function executeRechercheMontant(sfWebRequest $request) {

        $page = $request->getParameter('page', 1);
        $operation = $request->getParameter('operation');
        $montant = trim($request->getParameter('montant'));
        $montant_min = $request->getParameter('montant_min');
        $montant_max = $request->getParameter('montant_max');

        $filtre = $request->getParameter('filtre');

        $pager = new sfDoctrinePager('PieceComptable', 10);
        $pager->setQuery(PieceComptableTable::getInstance()->loadByMontant($montant, $montant_min, $montant_max, $operation));
        $pager->setPage($page);
        $pager->init();

        return $this->renderPartial('liste_multicritere', array('pager' => $pager, 'page' => $page, 'filtre' => $filtre, 'operation' => $operation, 'montant' => $montant, 'montant_min' => $montant_min, 'montant_max' => $montant_max));
    }

     public function executeRecherchePiecenonvalide(sfWebRequest $request) {

        $page = $request->getParameter('page', 1);
       
        $filtre = $request->getParameter('filtre');

        $pager = new sfDoctrinePager('PieceComptable', 10);
        $pager->setQuery(PieceComptableTable::getInstance()->loadByNonValide());
        $pager->setPage($page);
        $pager->init();

        return $this->renderPartial('liste_multicritere', array('pager' => $pager, 'page' => $page, 'filtre' => $filtre));
    }
    public function executeRechercheLibelle(sfWebRequest $request) {

        $page = $request->getParameter('page', 1);
        $libelle = $request->getParameter('libelle');

        $filtre = $request->getParameter('filtre');

        $pager = new sfDoctrinePager('PieceComptable', 10);
        $pager->setQuery(PieceComptableTable::getInstance()->loadByLibelle($libelle));
        $pager->setPage($page);
        $pager->init();

        return $this->renderPartial('liste_multicritere', array('pager' => $pager, 'page' => $page, 'filtre' => $filtre, 'libelle' => $libelle));
    }

    public function executeRechercheNumero(sfWebRequest $request) {

        $page = $request->getParameter('page', 1);
        $numero = $request->getParameter('numero');

        $filtre = $request->getParameter('filtre');

        $pager = new sfDoctrinePager('PieceComptable', 10);
        $pager->setQuery(PieceComptableTable::getInstance()->loadByNumero($numero));
        $pager->setPage($page);
        $pager->init();

        return $this->renderPartial('liste_multicritere', array('pager' => $pager, 'page' => $page, 'filtre' => $filtre, 'numero' => $numero));
    }

    public function executeRechercheReference(sfWebRequest $request) {

        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference');

        $filtre = $request->getParameter('filtre');

        $pager = new sfDoctrinePager('PieceComptable', 10);
        $pager->setQuery(PieceComptableTable::getInstance()->loadByReference($reference));
        $pager->setPage($page);
        $pager->init();

        return $this->renderPartial('liste_multicritere', array('pager' => $pager, 'page' => $page, 'filtre' => $filtre, 'reference' => $reference));
    }

    public function executeRechercheJournal(sfWebRequest $request) {

        $page = $request->getParameter('page', 1);
        $date_debut = $request->getParameter('date_debut');
        $date_fin = $request->getParameter('date_fin');

        $filtre = $request->getParameter('filtre');

        $pager = new sfDoctrinePager('PieceComptable', 10);
        $pager->setQuery(PieceComptableTable::getInstance()->loadByJournal($date_debut, $date_fin));
        $pager->setPage($page);
        $pager->init();

        return $this->renderPartial('liste_multicritere', array('pager' => $pager, 'page' => $page, 'filtre' => $filtre, 'date_debut' => $date_debut, 'date_fin' => $date_fin));
    }

    public function executeRechercheExterne(sfWebRequest $request) {

        $page = $request->getParameter('page', 1);
        $externe = $request->getParameter('externe');

        $filtre = $request->getParameter('filtre');

        $pager = new sfDoctrinePager('PieceComptable', 10);
        $pager->setQuery(PieceComptableTable::getInstance()->loadByExterne($externe));
        $pager->setPage($page);
        $pager->init();

        return $this->renderPartial('liste_multicritere', array('pager' => $pager, 'page' => $page, 'filtre' => $filtre, 'externe' => $externe));
    }

    public function executeRechercheCompte(sfWebRequest $request) {

        $page = $request->getParameter('page', 1);
        $compte_debut = $request->getParameter('compte_debut');
        $compte_fin = $request->getParameter('compte_fin');

        $filtre = $request->getParameter('filtre');

        $pager = new sfDoctrinePager('PieceComptable', 10);
        $pager->setQuery(PieceComptableTable::getInstance()->loadByCompte($compte_debut, $compte_fin));
        $pager->setPage($page);
        $pager->init();

        return $this->renderPartial('liste_multicritere', array('pager' => $pager, 'page' => $page, 'filtre' => $filtre, 'compte_debut' => $compte_debut, 'compte_fin' => $compte_fin));
    }

    public function executeRechercheDevise(sfWebRequest $request) {

        $page = $request->getParameter('page', 1);
        $devise = $request->getParameter('devise');

        $filtre = $request->getParameter('filtre');

        $pager = new sfDoctrinePager('PieceComptable', 10);
        $pager->setQuery(PieceComptableTable::getInstance()->loadByDevise($devise));
        $pager->setPage($page);
        $pager->init();

        return $this->renderPartial('liste_multicritere', array('pager' => $pager, 'page' => $page, 'filtre' => $filtre, 'devise' => $devise));
    }

    public function executeRechercheSens(sfWebRequest $request) {

        $page = $request->getParameter('page', 1);
        $credit = $request->getParameter('credit');
        $debit = $request->getParameter('debit');
        $creditdebit = $request->getParameter('creditdebit');

        $filtre = $request->getParameter('filtre');

        $pager = new sfDoctrinePager('PieceComptable', 10);
        $pager->setQuery(PieceComptableTable::getInstance()->loadBySens($credit, $debit, $creditdebit));
        $pager->setPage($page);
        $pager->init();

        return $this->renderPartial('liste_multicritere', array('pager' => $pager, 'page' => $page, 'filtre' => $filtre, 'credit' => $credit, 'debit' => $debit, 'creditdebit' => $creditdebit));
    }

    public function executeRechercheUser(sfWebRequest $request) {

        $page = $request->getParameter('page', 1);
        $user = $request->getParameter('user');

        $filtre = $request->getParameter('filtre');

        $pager = new sfDoctrinePager('PieceComptable', 10);
        $pager->setQuery(PieceComptableTable::getInstance()->loadByUser($user));
        $pager->setPage($page);
        $pager->init();

        return $this->renderPartial('liste_multicritere', array('pager' => $pager, 'page' => $page, 'filtre' => $filtre, 'user' => $user));
    }

    public function executeImprimerListe(sfWebRequest $request) {
        $pdf = new sfTCPDF("L");

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Pièce (Recherche Multicritères)');
        $pdf->SetSubject("Liste Pièce (Recherche Multicritères)");
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
        $html = $this->ReadHtmlMulticritereListe($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Pièce (Recherche Multicritères).pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlMulticritereListe(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Piececomptable();
        $html .= $piece->ReadHtmlMulticritereListe($request);
        return $html;
    }

}
