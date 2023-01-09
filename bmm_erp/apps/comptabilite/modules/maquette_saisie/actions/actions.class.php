<?php

/**
 * maquette_saisie actions.
 *
 * @package    sw-commerciale
 * @subpackage maquette_saisie
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class maquette_saisieActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeAddLigne(sfWebRequest $request) {
        $journal_id = $request->getParameter('journal_id');
        $exercice_id = $_SESSION['exercice_id'];
        $this->comptes = PlandossiercomptableTable::getInstance()->getPlanComptableMinchiffreOrderByNumero($_SESSION['dossier_id'], $exercice_id);
        if ($request->getParameter('credit'))
            $this->credit = $request->getParameter('credit');
        if ($request->getParameter('debit'))
            $this->debit = $request->getParameter('debit');
        if ($request->getParameter('typeop'))
            $this->typeop = $request->getParameter('typeop');
        if ($request->getParameter('typespec'))
            $this->typespec = $request->getParameter('typespec');
        if ($request->getParameter('montant_ligne_saisi'))
            $this->montant_ligne_saisi = $request->getParameter('montant_ligne_saisi');
        if ($request->getParameter('montant_ligne'))
            $this->montant_ligne = $request->getParameter('montant_ligne');
        if ($request->getParameter('numero_ligne'))
            $this->numero_ligne = $request->getParameter('numero_ligne');
        if ($request->getParameter('taux'))
            $this->taux = $request->getParameter('taux');
        if ($request->getParameter('total'))
            $this->total = $request->getParameter('total');
//        $maquette_id = $request->getParameter('maquette_id');
//        $this->maquette = null;
//        $this->numero_externe = $request->getParameter('numero_externe');
//        $type_journal_id = $request->getParameter('type_journal_id');
//        $nature_id = $request->getParameter('nature_id');
//        $reference = $request->getParameter('reference');
//        $journal_id = $request->getParameter('journal_id');
//        $this->reference = $reference;
//
//        $this->facture = null;
//        if ($type_journal_id == 1 && $nature_id == 7) {
//            $this->facture = FacturecomptableventeTable::getInstance()->findOneByReference($reference);
//            $this->type = 'vente';
//        }
//        if ($type_journal_id == 2 && $nature_id == 7) {
//            $this->facture = FacturecomptableachatTable::getInstance()->findOneByReference($reference);
//            $this->type = 'achat';
//        }
//        $contre_partie = '';
//        $journal = JournalcomptableTable::getInstance()->find($journal_id);
//        $contre_partie = $journal->getIdComptecontrepartie();
//        $this->selected_compte = $request->getParameter('selected_compte', '');
//        $this->selected_contre = $request->getParameter('selected_contre', $contre_partie);
//        if ($maquette_id && $maquette_id != '')
//            $this->maquette = MaquetteTable::getInstance()->find($maquette_id);
    }

    public function executeTestexistancemaquette(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $code = $params['code'];

            $maquette = new Maquette();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT maquette.id as id, maquette.code as code "
                    . " FROM maquette,journalcomptable "
                    . " WHERE maquette.code ='" . $code . "'"
                    . " and maquette.id_journal=journalcomptable.id"
                    . " and journalcomptable.id_dossier= " . $_SESSION['dossier_id']
                    . " and journalcomptable.id_exercice= " . $_SESSION['exercice_id'];

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    public function executeIndex(sfWebRequest $request) {
        $exercice_id = $_SESSION['exercice_id'];
        $this->journals = JournalcomptableTable::getInstance()->getAllByDossierAndExercice($_SESSION['dossier_id'], $exercice_id);
        $this->natures = NaturepieceTable::getInstance()->findAll();
        $this->pager = $this->paginate($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function executeShow(sfWebRequest $request) {
        $maquette_id = $request->getParameter('maquette_id');
        $this->maquette = MaquetteTable::getInstance()->find($maquette_id);
    }

    public function executeShowEdit(sfWebRequest $request) {
        $maquette_id = $request->getParameter('id');
        $maquette = MaquetteTable::getInstance()->find($maquette_id);
        $this->nature_pieces = NaturepieceTable::getInstance()->findAll();
        $exercice_id = $_SESSION['exercice_id'];
        $this->journals = JournalcomptableTable::getInstance()->getAllByDossierAndExercice($_SESSION['dossier_id'], $exercice_id);
        $this->maquette = $maquette;
        $this->comptes = PlandossiercomptableTable::getInstance()->getPlanComptableMinchiffreOrderByNumero($_SESSION['dossier_id'], $exercice_id);
          
        }

    public function executeDelete(sfWebRequest $request) {
        $maquette_id = $request->getParameter('id');
        $maquette = MaquetteTable::getInstance()->find($maquette_id);

        foreach ($maquette->getLignemaquette() as $ligne) {
            $ligne->delete();
        }

        $maquette->delete();

        $pager = $this->paginate($request);
        $this->pager = $pager;
        $page = $request->getParameter('page', 1);
        $this->page = $page;
        return $this->renderPartial("liste_maquette", array("pager" => $pager, "page" => $page));
    }

    public function executeGoPage(sfWebRequest $request) {
        $pager = $this->paginate($request);
        $page = $request->getParameter('page', 1);
        return $this->renderPartial("liste_maquette", array("pager" => $pager, "page" => $page));
    }

    public function executeGoSaisie(sfWebRequest $request) {
        $pager = $this->paginateSaisie($request);
        $page = $request->getParameter('page', 1);
        return $this->renderPartial("liste_maquette_filter", array("pager" => $pager, "page" => $page));
    }

    public function executeNew(sfWebRequest $request) {
        $this->nature_pieces = NaturepieceTable::getInstance()->findAll();
        $exercice_id = $_SESSION['exercice_id'];
        $this->journals = JournalcomptableTable::getInstance()->getAllByDossierAndExercice($_SESSION['dossier_id'], $exercice_id);
    }

    public function executeNouvelle(sfWebRequest $request) {
        $this->nature_pieces = NaturepieceTable::getInstance()->findAll();
        $exercice_id = $_SESSION['exercice_id'];
        $this->journals = JournalcomptableTable::getInstance()->getAllByDossierAndExercice($_SESSION['dossier_id'], $exercice_id);
    }

    /*
     * Paginate with interface from maquette
     */

    public function paginate(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $journal = $request->getParameter('journal', '');
        $code = $request->getParameter('code', '');
        $libelle = $request->getParameter('libelle', '');
        $nature = $request->getParameter('nature', '');

        $type_tri = $request->getParameter('type_tri', '');
        $tri = $request->getParameter('tri', '');

        $journal_id = $request->getParameter('journal_id', '');
        $nature_id = $request->getParameter('nature_id', '');

        $pager = new sfDoctrinePager('Maquette', 10);

        $pager->setQuery(MaquetteTable::getInstance()->loadAllFiltre($journal, $code, $nature, $libelle, $type_tri, $tri, $journal_id, $nature_id));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeAffichetypejournal(sfWebRequest $request) {
        $id_journal = $request->getParameter('journal_id', '');
        if ($id_journal != '') {
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT journalcomptable.id_type_journal as id_journal,journalcomptable.*"
                    . " FROM journalcomptable,typejournal"
                    . " WHERE journalcomptable.id_type_journal =typejournal.id"
                    . " and journalcomptable.id= " . $id_journal;

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }
        die("Erreur");
    }

    /*
     * Paginate with interface form saisie
     */

    public function paginateSaisie(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $journal = $request->getParameter('journal', '');
        $code = $request->getParameter('code', '');
        $libelle = $request->getParameter('libelle', '');
        $nature = $request->getParameter('nature', '');

        $type_tri = $request->getParameter('type_tri', '');
        $tri = $request->getParameter('tri', '');

        $journal_id = $request->getParameter('journal_id', '');
        $nature_id = $request->getParameter('nature_id', '');

        $pager = new sfDoctrinePager('Maquette', 5);

        $pager->setQuery(MaquetteTable::getInstance()->loadAllFiltreBySasie($journal, $code, $nature, $libelle, $type_tri, $tri, $journal_id, $nature_id));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeValiderMaquette(sfWebRequest $request) {
        $journal = $request->getParameter('journal');
        $nature_piece = $request->getParameter('nature_piece');
        $libelle = $request->getParameter('libelle');
        $code = $request->getParameter('code');
        $numero_compte = $request->getParameter('numero_compte');
        $ligne_contre = $request->getParameter('ligne_contre');
        $ck_compte = $request->getParameter('ck_compte');
        $ck_compte_tiers = $request->getParameter('ck_compte_tiers');
        $ck_compte_retenue = $request->getParameter('ck_compte_retenue');
        $ck_montant = $request->getParameter('ck_montant');
        $ck_contre = $request->getParameter('ck_contre');
        $spec_compte = $request->getParameter('spec_compte');
        $spec_montant = $request->getParameter('spec_montant');
        $spec_contre = $request->getParameter('spec_contre');
        $type_montant = $request->getParameter('type_montant');
        $ligne_montant_saisi = $request->getParameter('ligne_montant_saisi');
        $ligne_montant = $request->getParameter('ligne_montant');
        $ligne_numero_ligne = $request->getParameter('ligne_numero_ligne');
        $ligne_taux = $request->getParameter('ligne_taux');
        $numero_compte = explode(',,', $numero_compte);
        $ligne_contre = explode(',,', $ligne_contre);
        $ck_compte = explode(',,', $ck_compte);
        $ck_compte_tiers = explode(',,', $ck_compte_tiers);
        $ck_compte_retenue = explode(',,', $ck_compte_retenue);
        $ck_montant = explode(',,', $ck_montant);
        $ck_contre = explode(',,', $ck_contre);
        $spec_compte = explode(',,', $spec_compte);
        $spec_montant = explode(',,', $spec_montant);
        $spec_contre = explode(',,', $spec_contre);
        $type_montant = explode(',,', $type_montant);
        $ligne_montant_saisi = explode(',,', $ligne_montant_saisi);
        $ligne_montant = explode(',,', $ligne_montant);
        $ligne_numero_ligne = explode(',,', $ligne_numero_ligne);
        $ligne_taux = explode(',,', $ligne_taux);
        $user =  $this->getUser()->getAttribute('userB2m');
        $maquette = new Maquette();
        $maquette->setCode($code);
        $maquette->setDate(date('Y-m-d'));
        $maquette->setIdJournal($journal);
        $maquette->setLibelle($libelle);
        $maquette->setIdNaturepiece($nature_piece);
        $maquette->setIdUser($user->getId());
        $maquette->save();
        $j = 1;
        for ($i = 0; $i < sizeof($ck_montant); $i++) {
            if ($ck_montant[$i] != '') {
                $ligne_maquette = new Lignemaquette();
                $ligne_maquette->setNumero($j);
                if ($numero_compte[$i] != '' && $numero_compte[$i] != '-1') {
                    /*
                     * GET ID from plandossiercomptable ---> plancomptable
                     */
                    $plandossier_comptable = PlandossiercomptableTable::getInstance()->findOneById($numero_compte[$i]);
                    if ($plandossier_comptable)
                        $ligne_maquette->setIdComptecomptable($plandossier_comptable->getIdPlan());
                }
                if ($ligne_contre[$i] != '' && $ligne_contre[$i] != '-1') {
//                    $ligne_maquette->setIdContrepartie($ligne_contre[$i]);
                    $plandossier_comptable = PlandossiercomptableTable::getInstance()->findOneById($ligne_contre[$i]);
                    if ($plandossier_comptable)
                        $ligne_maquette->setIdContrepartie($plandossier_comptable->getIdPlan());
                }
                $ligne_maquette->setIdMaquette($maquette->getId());
                if ($ligne_montant_saisi[$i] != '' && $ligne_montant_saisi[$i] != 'undefined')
                    $ligne_maquette->setMontant($ligne_montant_saisi[$i]);
                if ($ligne_montant[$i] != '' && $ligne_montant[$i] != 'undefined')
                    $ligne_maquette->setMontant($ligne_montant[$i]);
                if ($ligne_numero_ligne[$i] != '')
                    $ligne_maquette->setNumerolignemontant($ligne_numero_ligne[$i]);
                if ($ck_compte[$i] == 'true')
                    $ligne_maquette->setObligatoirecompte(true);
                if ($ck_compte_tiers[$i] == 'true')
                    $ligne_maquette->setTiers(true);
                if ($ck_compte_retenue[$i] == 'true')
                    $ligne_maquette->setCompteretenue(true);
                if ($ck_contre[$i] == 'true')
                    $ligne_maquette->setObligatoirecontre(true);
                if ($ck_montant[$i] == 'true')
                    $ligne_maquette->setObligatoiremontant(true);
                if ($spec_compte[$i] != '')
                    $ligne_maquette->setSpecificationcompte($spec_compte[$i]);
                if ($spec_contre[$i] != '')
                    $ligne_maquette->setSpecificationcontre($spec_contre[$i]);
                if ($spec_montant[$i] != '')
                    $ligne_maquette->setSpecificationmontant($spec_montant[$i]);
                if ($type_montant[$i] != '')
                    $ligne_maquette->setType($type_montant[$i]);
                if ($ligne_taux[$i] != '')
                    $ligne_maquette->setTaux($ligne_taux[$i]);

                $ligne_maquette->save();
                $j++;
            }
        }

        $this->nature_pieces = NaturepieceTable::getInstance()->findAll();
//        $dossier_comptable = DossiercomptableTable::getInstance()->findAll()->getFirst();
        $exercice_id = $_SESSION['exercice_id'];
        $this->journals = JournalcomptableTable::getInstance()->getAllByDossierAndExercice($_SESSION['dossier_id'], $exercice_id);
    }

    public function executeValiderModifierMaquette(sfWebRequest $request) {
        $journal = $request->getParameter('journal');
        $maquette_id = $request->getParameter('maquette_id');
        $nature_piece = $request->getParameter('nature_piece');
        $libelle = $request->getParameter('libelle');
        $code = $request->getParameter('code');
        $numero_compte = $request->getParameter('numero_compte');
        $ligne_contre = $request->getParameter('ligne_contre');
        $ck_compte = $request->getParameter('ck_compte');
        $ck_compte_tiers = $request->getParameter('ck_compte_tiers');
          $ck_compte_retenue = $request->getParameter('ck_compte_retenue');
        $ck_montant = $request->getParameter('ck_montant');
        $ck_contre = $request->getParameter('ck_contre');
        $spec_compte = $request->getParameter('spec_compte');
        $spec_montant = $request->getParameter('spec_montant');
        $spec_contre = $request->getParameter('spec_contre');
        $type_montant = $request->getParameter('type_montant');
        $ligne_montant = $request->getParameter('ligne_montant');
        $ligne_montant_saisi = $request->getParameter('ligne_montant_saisi');
        $ligne_numero_ligne = $request->getParameter('ligne_numero_ligne');
        $ligne_taux = $request->getParameter('ligne_taux');
        $numero_compte = explode(',,', $numero_compte);
        $ligne_contre = explode(',,', $ligne_contre);
        $ck_compte = explode(',,', $ck_compte);
        $ck_compte_tiers = explode(',,', $ck_compte_tiers);
           $ck_compte_retenue = explode(',,', $ck_compte_retenue);
        $ck_montant = explode(',,', $ck_montant);
        $ck_contre = explode(',,', $ck_contre);
        $spec_compte = explode(',,', $spec_compte);
        $spec_montant = explode(',,', $spec_montant);
        $spec_contre = explode(',,', $spec_contre);
        $type_montant = explode(',,', $type_montant);
        $ligne_montant = explode(',,', $ligne_montant);
        $ligne_montant_saisi = explode(',,', $ligne_montant_saisi);
        $ligne_numero_ligne = explode(',,', $ligne_numero_ligne);
        $ligne_taux = explode(',,', $ligne_taux);
        $user =  $this->getUser()->getAttribute('userB2m');
        $maquette = MaquetteTable::getInstance()->find($maquette_id);
        $maquette->setCode($code);
        $maquette->setDate(date('Y-m-d'));
        $maquette->setIdJournal($journal);
        $maquette->setLibelle($libelle);
        $maquette->setIdNaturepiece($nature_piece);
        $maquette->setIdUser($user->getId());
        $maquette->save();
        foreach ($maquette->getLignemaquette() as $ligne) {
            $ligne->delete();
        }
        $j = 1;
        for ($i = 0; $i < sizeof($ck_montant); $i++) {
            if ($ligne_montant_saisi[$i] === '') {
                $ligne_montant_saisi[$i] = 0.000;
            }
            if ($ck_montant[$i] != '') {
                $ligne_maquette = new Lignemaquette();
                $ligne_maquette->setNumero($j);

//                if ($numero_compte[$i] != '' && $numero_compte[$i] != '-1' )
//                    $ligne_maquette->setIdComptecomptable($numero_compte[$i]);
                if ($numero_compte[$i] != '' && $numero_compte[$i] != '-1') {
                    /*
                     * GET ID from plandossiercomptable ---> plancomptable
                     */
                    $plandossier_comptable = PlandossiercomptableTable::getInstance()->findOneById($numero_compte[$i]);
                    if ($plandossier_comptable)
                        $ligne_maquette->setIdComptecomptable($plandossier_comptable->getIdPlan());
                }
                if ($ligne_contre[$i] != '' && $ligne_contre[$i] != '-1') {
//                    $ligne_maquette->setIdContrepartie($ligne_contre[$i]);
                    $plandossier_comptable = PlandossiercomptableTable::getInstance()->findOneById($ligne_contre[$i]);
                    if ($plandossier_comptable)
                        $ligne_maquette->setIdContrepartie($plandossier_comptable->getIdPlan());
                }
                $ligne_maquette->setIdMaquette($maquette->getId());
                if ($ligne_montant[$i] != '' && $ligne_montant[$i] != 'undefined')
                    $ligne_maquette->setMontant($ligne_montant[$i]);
                if ($ligne_montant_saisi[$i] != '' && $ligne_montant_saisi[$i] != 'undefined')
                    $ligne_maquette->setMontant($ligne_montant_saisi[$i]);
                if ($ligne_numero_ligne[$i] != '')
                    $ligne_maquette->setNumerolignemontant($ligne_numero_ligne[$i]);
                if ($ck_compte[$i] == 'true')
                    $ligne_maquette->setObligatoirecompte(true);
                if ($ck_compte_tiers[$i] == 'true')
                    $ligne_maquette->setTiers(true);
                  if ($ck_compte_retenue[$i] == 'true')
                    $ligne_maquette->setCompteretenue(true);
                if ($ck_contre[$i] == 'true')
                    $ligne_maquette->setObligatoirecontre(true);
                if ($ck_montant[$i] == 'true')
                    $ligne_maquette->setObligatoiremontant(true);
                if ($spec_compte[$i] != '')
                    $ligne_maquette->setSpecificationcompte($spec_compte[$i]);
                if ($spec_contre[$i] != '')
                    $ligne_maquette->setSpecificationcontre($spec_contre[$i]);
                if ($spec_montant[$i] != '')
                    $ligne_maquette->setSpecificationmontant($spec_montant[$i]);
                if ($type_montant[$i] != '')
                    $ligne_maquette->setType($type_montant[$i]);
                if ($ligne_taux[$i] != '')
                    $ligne_maquette->setTaux($ligne_taux[$i]);
                $ligne_maquette->save();
                $j++;
            }
        }

        die("OK");
    }

}
