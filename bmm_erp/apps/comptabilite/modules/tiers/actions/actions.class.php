<?php

/**
 * tiers actions.
 *
 * @package    sw-commerciale
 * @subpackage tiers
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tiersActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    function getAllFournisseur(sfWebRequest $request) {
        $raisonSociale = strtoupper($request->getParameter('raison_sociale', ''));
        $code = strtoupper($request->getParameter('code', ''));
        $compte = $request->getParameter('compte', '');

        $pager = new sfDoctrinePager('Fournisseur', 5);
        $pager->setQuery(FournisseurTable::getInstance()->getAllPagerComptabilite($raisonSociale, $code, $compte));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    function getAllClient(sfWebRequest $request) {
        $raisonSociale = strtoupper($request->getParameter('raison_sociale', ''));
        $code = strtoupper($request->getParameter('code', ''));
        $compte = $request->getParameter('compte', '');

        $pager = new sfDoctrinePager('Client', 5);
        $pager->setQuery(ClientTable::getInstance()->getAllPagerComptabilite($raisonSociale, $code, $compte));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeDeleteClient(sfWebRequest $request) {
        $facturevente = FacturecomptableventeTable::getInstance()->findByIdClient($request->getParameter('id'));
//        die(sizeof($facturevente) . 'll');
        if (sizeof($facturevente) > 1) {
            $i = 0;
            foreach ($factures_intervale as $fac_i) {
                $facture = FacturecomptableventeTable::getInstance()->findOneById($fac_i->getId()); //            $client = ClientTable::getInstance()->findOneById($facture->getIdClient());
                $facture->delete();
                $i++;
            }
        }
        if (sizeof($facturevente) == 1) {
            $facturevente->delete();
        }
        $client = ClientTable::getInstance()->find($request->getParameter('id'));
        $client->delete();
        $this->pager = $this->getAllClientCompta($request);
        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("list", array("pager" => $this->pager));
        }
    }

    public function executeDeleteFournisseur(sfWebRequest $request) {
        $factureachat = FacturecomptableachatTable::getInstance()->findByIdFournisseur($request->getParameter('id'));
        if (sizeof($factureachat) > 1) {
            $i = 0;
            foreach ($factureachat as $fac_i):
                $facture = FacturecomptableachatTable::getInstance()->findOneById($fac_i->getId());
                $facture->delete();
                $i++;
            endforeach;
        }
        if (sizeof($factureachat) == 1) {
            $factureachat->delete();
        }

        $fournisseur = FournisseurTable::getInstance()->findOneById($request->getParameter('id'));
        $fournisseur->delete();
//        $this->pager = $this->load($request);
//        if ($request->isXmlHttpRequest()) {
//            return $this->renderPartial("list_frs", array("pager" => $this->pager));
//        }
        $raisonSociale = strtoupper($request->getParameter('raison_sociale', ''));
        $code = strtoupper($request->getParameter('code', ''));
        $compte = $request->getParameter('compte', '');

        $pager = new sfDoctrinePager('Fournisseur', 5);
        $pager->setQuery(FournisseurTable::getInstance()->getAllPagerComptabilite($raisonSociale, $code, $compte));
        $this->pager = $pager;
        return $this->renderPartial("tiers/list_frs", array("pager" => $pager));
    }

    function getAllClientCompta(sfWebRequest $request) {
        $raisonSociale = strtoupper($request->getParameter('raison_sociale', ''));
        $code = strtoupper($request->getParameter('code', ''));
        $compte = $request->getParameter('compte', '');

        $pager = new sfDoctrinePager('Client', 10);
        $pager->setQuery(ClientTable::getInstance()->getAllPagerComptabilite($raisonSociale, $code, $compte));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    function getAllBanqueCaisse(sfWebRequest $request) {
        $libelle = strtoupper($request->getParameter('libelle', ''));
        $code = strtoupper($request->getParameter('code', ''));
        $compte = $request->getParameter('compte', '');

        $pager = new sfDoctrinePager('Caissesbanques', 10);
        $pager->setQuery(CaissesbanquesTable::getInstance()->getAllPagerComptabilite($libelle, $code, $compte));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeListFournisseur(sfWebRequest $request) {
//        $this->pager = $this->getAllFournisseur($request);
//
//        if ($request->isXmlHttpRequest()) {
//            return $this->renderPartial("list_frs", array("pager" => $this->pager));
//        }
        $raisonSociale = strtoupper($request->getParameter('raison_sociale', ''));
        $code = strtoupper($request->getParameter('code', ''));
        $compte = $request->getParameter('compte', '');
        $pager = new sfDoctrinePager('Fournisseur', 5);
        $pager->setQuery(FournisseurTable::getInstance()->getAllPagerComptabilite($raisonSociale, $code, $compte));
        $this->pager = $pager;
    }

    public function executeShowFournisseur(sfWebRequest $request) {
        $this->fournisseur = FournisseurTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeEditFournisseur(sfWebRequest $request) {
        $this->fournisseur = FournisseurTable::getInstance()->find($request->getParameter('id'));
        $this->comptes = PlanComptableTable::getInstance()->findOrderByNumeroSousClasse('40');
    }

    public function executeUpdateFournisseur(sfWebRequest $request) {
        $compte = $request->getParameter('compte_comptable');
        if ($compte != '') {
            $fournisseur = FournisseurTable::getInstance()->find($request->getParameter('id'));
            $fournisseur->setIdPlancomptable($compte);
            $fournisseur->save();
        }

        $pager = $this->getAllFournisseur($request);
        return $this->renderPartial("list_frs", array("pager" => $pager));
    }

    public function executeListClient(sfWebRequest $request) {

//        $this->pager = $this->getAllClient($request);
        $raisonSociale = strtoupper($request->getParameter('raison_sociale', ''));
        $code = strtoupper($request->getParameter('code', ''));
        $compte = $request->getParameter('compte', '');
        $pager = new sfDoctrinePager('Client', 5);
        $pager->setQuery(ClientTable::getInstance()->getAllPagerComptabilite($raisonSociale, $code, $compte));
        $this->pager = $pager;
//        if ($request->isXmlHttpRequest()) {
//            return $this->renderPartial("list", array("pager" => $this->pager));
//        }
    }

    public function executeShowClient(sfWebRequest $request) {
        $this->client = ClientTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeEditClient(sfWebRequest $request) {
        $this->client = ClientTable::getInstance()->find($request->getParameter('id'));
        $this->comptes = PlanComptableTable::getInstance()->findOrderByNumeroSousClasse('41');
//         $pager = new sfDoctrinePager('Client', 5);
//        $pager->setQuery(ClientTable::getInstance()->getAllPagerComptabilite());
//        $this->pager = $pager;
//        return $this->renderPartial("tiers/list", array("pager" => $pager));
    }

    public function executeUpdateClient(sfWebRequest $request) {
        $compte = $request->getParameter('compte_comptable');
        if ($compte != '') {
            $client = ClientTable::getInstance()->find($request->getParameter('id'));
            $client->setIdPlancomptable($compte);
            $client->save();
        }

        $pager = $this->getAllClient($request);
        return $this->renderPartial("list", array("pager" => $pager));
    }

    public function executeListBanqueCaisse(sfWebRequest $request) {
        $this->pager = $this->getAllBanqueCaisse($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("list_banque_caisse", array("pager" => $this->pager));
        }
    }

    public function executeShowCompteBc(sfWebRequest $request) {
        $this->compte = CaissesbanquesTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeEditCompteBc(sfWebRequest $request) {
        $this->compte_cb = CaissesbanquesTable::getInstance()->find($request->getParameter('id'));
        if ($this->compte_cb->getIdTypecb() == 1):
            $this->comptes = PlanComptableTable::getInstance()->findOrderByNumeroSousClasse('54');
        else:
            $this->comptes = PlanComptableTable::getInstance()->findOrderByNumeroSousClasse('53');
        endif;
    }

    public function executeUpdateCompteBc(sfWebRequest $request) {
        $compte = $request->getParameter('compte_comptable');
        if ($compte != '') {
            $compte_cb = CaissesbanquesTable::getInstance()->find($request->getParameter('id'));
            $compte_cb->setIdPlancomptable($compte);
            $compte_cb->save();
        }

        $pager = $this->getAllBanqueCaisse($request);
        return $this->renderPartial("list_banque_caisse", array("pager" => $pager));
    }

    public function executeShowEditClient(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->client = ClientTable::getInstance()->find($id);
    }

    public function executeShowEditFournisseur(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->fournisseur = FournisseurTable::getInstance()->findOneById($id);
    }

    public function executeSaveEdit(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $reference = $request->getParameter('reference');
        $code = $request->getParameter('code');
        $nom = $request->getParameter('nom');
        $prenom = $request->getParameter('prenom');
        $rs = $request->getParameter('rs');
        $telephone = $request->getParameter('telephone');
        $gsm = $request->getParameter('gsm');
        $mail = $request->getParameter('mail');
        $compte = $request->getParameter('compte');
        $observation = $request->getParameter('observation');
        $client = ClientTable::getInstance()->findOneById($id);
        if ($reference)
            $client->setReference($reference);
        if ($code)
            $client->setCodeclt($code);
        if ($nom)
            $client->setNom($nom);
        if ($prenom)
            $client->setPrenom($prenom);
        if ($rs)
            $client->setRs($rs);
        if ($telephone)
            $client->setTel($telephone);
        if ($mail)
            $client->setMail($mail);
        if ($gsm)
            $client->setGsm($gsm);
        if ($compte)
            $client->setIdPlancomptable($compte);
        if ($observation)
            $client->setObservation($observation);
        $client->save();
        die('Ok');
    }

    public function executeSaveEditFournisseur(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $reference = $request->getParameter('reference');
        $code = $request->getParameter('code');
        $nom = $request->getParameter('nom');
        $prenom = $request->getParameter('prenom');
        $rs = $request->getParameter('rs');
        $telephone = $request->getParameter('telephone');
        $gsm = $request->getParameter('gsm');
        $mail = $request->getParameter('mail');
        $compte = $request->getParameter('compte');
        $observation = $request->getParameter('observation');
        $fournisseur = FournisseurTable::getInstance()->findOneById($id);
        if ($reference)
            $fournisseur->setReference($reference);
        if ($code)
            $fournisseur->setCodefrs($code);
        if ($nom)
            $fournisseur->setNom($nom);
        if ($prenom)
            $fournisseur->setPrenom($prenom);
        if ($rs)
            $fournisseur->setRs($rs);
        if ($telephone)
            $fournisseur->setTel($telephone);
        if ($mail)
            $fournisseur->setMail($mail);
        if ($gsm)
            $fournisseur->setGsm($gsm);
        if ($compte)
            $fournisseur->setIdPlancomptable($compte);
        if ($observation)
            $fournisseur->setObservation($observation);
        $fournisseur->save();
        die('Ok');
    }

    public function executeAfficherListClient(sfWebRequest $request) {
        $client_min = $request->getParameter('client_min', '');
        $client_max = $request->getParameter('client_max', '');
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $pager = new sfDoctrinePager('Client', 5);
        $pager->setQuery(ClientTable::getInstance()->loadByInterval($client_min, $client_max));
        $this->pager = $pager;
        return $this->renderPartial("tiers/list", array("pager" => $pager));
    }

    public function executeAfficherListFournisseur(sfWebRequest $request) {
        $fournisseur_min = $request->getParameter('fournisseur_min', '');
        $fournisseur_max = $request->getParameter('fournisseur_max', '');
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $pager = new sfDoctrinePager('Fournisseur', 5);
        $pager->setQuery(FournisseurTable::getInstance()->loadByInterval($fournisseur_min, $fournisseur_max));
        $this->pager = $pager;
        return $this->renderPartial("tiers/list_frs", array("pager" => $pager));
    }

    //suppression all client avec ses factures
    public function executeSupprimerClients(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();
        $client_min = $request->getParameter('client_min', '');
        $client_max = $request->getParameter('client_max', '');
        $raisonSociale = strtoupper($request->getParameter('raison_sociale', ''));
        $code = strtoupper($request->getParameter('code', ''));
        $compte = $request->getParameter('compte', '');
        $factures_intervale = FacturecomptableventeTable::getInstance()->loadByIntervalClient($client_min, $client_max, $date_debut, $date_fin);
        $i = 0;
//       die ($client_min. ' '.$client_max.'mm');
        foreach ($factures_intervale as $fac_i) {
            $facture = FacturecomptableventeTable::getInstance()->findOneById($fac_i->getId());
            $facture->delete();
            $i++;
        }
        $client_intervale_1 = ClientTable::getInstance()->loadByIntervalCompta($client_min, $client_max);
        $client_intervale_2 = ClientTable::getInstance()->loadByInterval($client_min, $client_max);

        $j = 0;
        $k = 0;

        if (sizeof($client_intervale_1) >= 0) {
            foreach ($client_intervale_1 as $client_j) {
//                die(sizeof($client_intervale_1) . 'rr');
//                die($client_i->getId() . +sizeof($client_intervale) . 'rr');
                $plandossiercomptabe = PlandossiercomptableTable::getInstance()->getclient($client_j->getIdPlancomptable());
//            
//                    die(sizeof($plandossiercomptabe) . 'rr');
                $client = ClientTable::getInstance()->findOneById($client_j->getId());
//             die($client_j->getIdPlancomptable().'c'.count($plandossiercomptabe).'p');

                $client->delete();
                $plandossiercomptabe->delete();

                $j++;
            }
//            for ($j = 0; $j < sizeof($client_intervale_1); $j++) {
//                $client = ClientTable::getInstance()->findOneById($client_intervale_1[$j]['id']);
//                $plandossiercomptabe = PlandossiercomptableTable::getInstance()->getclient($client_intervale_1[$j]['id_plan']);
//                $client = ClientTable::getInstance()->findOneById($client_intervale_1[$j]['id']);
//                
////               die($client_intervale_1[$j]['id_plan'].'mmp');
//               
//                $plandossiercomptabe->delete();
//                $client->delete();
////                $plandossiercomptabe->getPlancomptable()->delete();               
//
//            }
        }

        if (count($client_intervale_2) >= 0 && sizeof($client_intervale_1) == 0) {
            for ($j = 0; $j < sizeof($client_intervale_2); $j++) {
                $client = ClientTable::getInstance()->findOneById($client_intervale_2[$j]['id']);
                $client->delete();
            }
//            foreach ($client_intervale_2 as $client_j) {
////                $plandossiercomptabe = PlandossiercomptableTable::getInstance()->getclient($client_j->getIdPlancomptable());
////                $client = ClientTable::getInstance()->findOneById($client_j->getId());
//                $client_j->delete();
////                $plandossiercomptabe->delete();
//                $k++;
//            }
        }
        $pager = new sfDoctrinePager('Client', 5);
        $pager->setQuery(ClientTable::getInstance()->getAllPagerComptabilite($raisonSociale, $code, $compte));
        $this->pager = $pager;
        return $this->renderPartial("tiers/list", array("pager" => $pager));
    }

    public function executeSupprimerFournisseur(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $exercice->getDateDebut();
        $date_fin = $exercice->getDateFin();
        $fournisseur_min = $request->getParameter('fournisseur_min', '');
        $fournisseur_max = $request->getParameter('fournisseur_max', '');
        $raisonSociale = strtoupper($request->getParameter('raison_sociale', ''));
        $code = strtoupper($request->getParameter('code', ''));
        $compte = $request->getParameter('compte', '');
        $factures_intervale = FacturecomptableachatTable::getInstance()->loadByIntervalFournisseur($fournisseur_min, $fournisseur_max, $date_debut, $date_fin);
        $i = 0;
        foreach ($factures_intervale as $fac_i):
            $facture = FacturecomptableachatTable::getInstance()->findOneById($fac_i->getId());
            $facture->delete();
            $i++;
        endforeach;
        $fournisseur_intervale = array();
        $fournisseur_intervale_1 = FournisseurTable::getInstance()->loadByIntervalCompta($fournisseur_min, $fournisseur_max);


        $j = 0;
        if (sizeof($fournisseur_intervale_1) >= 0):
//            die((sizeof($fournisseur_intervale_1) . 'm'));
            foreach ($fournisseur_intervale_1 as $fournisseur_j):
                $fournisseur = FournisseurTable::getInstance()->findOneById($fournisseur_j->getId());
                $fournisseur->delete();
                $j++;
            endforeach;
//            for ($j = 0; $j < sizeof($fournisseur_intervale_1); $j++) {
//                $fournisseur = FournisseurTable::getInstance()->findOneById($fournisseur_intervale_1[$j]['id']);
//                $fournisseur->delete();
//            }
        endif;
        $pager = new sfDoctrinePager('Fournisseur', 5);

        $pager->setQuery(FournisseurTable::getInstance()->getAllPagerComptabilite($raisonSociale, $code, $compte));
//        $pager->setPage($request->getParameter('page', 1));
//        $pager->init();
        $this->pager = $pager;
        return $this->renderPartial("tiers/list_frs", array("pager" => $pager));
    }

    public function executeEtatFournisseur(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $this->comptes = PlandossiercomptableTable::getInstance()->getPlanComptableOrderByNumero($dossier_id, $exercice_id);
        $this->journals = JournalComptableTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id);
       if($_SESSION['dossier_id']==1)
            $this->fournisseur = FournisseurTable::getInstance()->findAll();
       else 
        $this->fournisseur = FournisseurTable::getInstance()->findByIdDossier($dossier_id);
    }

    public function executeAfficherEtatExtraitCompteFournissuer(sfWebRequest $request) {
        $id_frs = $request->getParameter('id_frs', '');
        $exercice = $_SESSION['exercice'];
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $date_debut = $request->getParameter('date_debut');
//        if ($date_debut == '' || $date_debut == NULL)
//            $date_debut = $exercice . '-01-01';
        $date_fin = $request->getParameter('date_fin');
//        if ($date_fin == '' || $date_fin == NULL)
//            $date_fin = $exercice . '-12-31';
        $journal = $request->getParameter('journal', '');
        $order = $request->getParameter('order', '');
//       die($date_debut.'fin'.$date_fin);
        $debit = $request->getParameter('debit', '');
        $credit = $request->getParameter('credit', '');
        $tout = $request->getParameter('tout', '');

        $fournisseur = FournisseurTable::getInstance()->findOneById($id_frs);
        $etatExtraitCompte = LignePieceComptableTable::getInstance()->loadEtatExtraitCompteFournisseur($id_frs, $date_debut, $date_fin, $journal, $order,  $credit,$debit, $dossier_id, $exercice_id);
        return $this->renderPartial("etat_fournisseur_compte", array("compte_comptable" => $fournisseur, "etatExtraitCompte" => $etatExtraitCompte, "date_debut" => $date_debut, "date_fin" => $date_fin, "compte" => $id_frs, "journal" => $journal, "order" => $order, "debit" => $debit, "credit" => $credit));
    }

    public function executeEtatClient(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $this->comptes = PlandossiercomptableTable::getInstance()->getPlanComptableOrderByNumero($dossier_id, $exercice_id);
        $this->journals = JournalComptableTable::getInstance()->findByIdDossierAndIdExercice($dossier_id, $exercice_id);
    if($_SESSION['dossier_id']==1)
         $this->client = ClientTable::getInstance()->findAll();
        else
        $this->client = ClientTable::getInstance()->findByIdDossier($dossier_id);
    
    }

    public function executeAfficherEtatExtraitCompteClient(sfWebRequest $request) {
        $id_client = $request->getParameter('id_client', '');
        $exercice = $_SESSION['exercice'];
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $date_debut = $request->getParameter('date_debut');
//        if ($date_debut == '' || $date_debut == NULL)
//            $date_debut = $exercice . '-01-01';
        $date_fin = $request->getParameter('date_fin');
//        if ($date_fin == '' || $date_fin == NULL)
//            $date_fin = $exercice . '-12-31';
        $journal = $request->getParameter('journal', '');
        $order = $request->getParameter('order', '');
//       die($date_debut.'fin'.$date_fin);
        $debit = $request->getParameter('debit', '');
        $credit = $request->getParameter('credit', '');
        $tout = $request->getParameter('tout', '');

        $client = ClientTable::getInstance()->findOneById($id_client);
        $etatExtraitCompte = LignePieceComptableTable::getInstance()->loadEtatExtraitCompteClient($id_client, $date_debut, $date_fin, $journal, $order, $debit, $credit, $dossier_id, $exercice_id);
        return $this->renderPartial("etat_client_compte", array("compte_comptable" => $client, "etatExtraitCompte" => $etatExtraitCompte, "date_debut" => $date_debut, "date_fin" => $date_fin, "compte" => $id_client, "journal" => $journal, "order" => $order, "debit" => $debit, "credit" => $credit));
    }

    public function executeImprimeEtatExtraitFournisseur(sfWebRequest $request) {
        $pdf = new sfTCPDF("L");

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Extrait Auxiliaire Fournisseur ');
        $pdf->SetSubject("Extrait Auxiliaire Fournisseur");
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
        $html = $this->ReadHtmlExtraitCompteFournisseur($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Extrait Auxiliaire Fournisseur.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlExtraitCompteFournisseur(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $compte = new Fournisseur();
        $html .= $compte->ReadHtmlExtraitCompteFournisseur($request);
        return $html;
    }

    /* extrait client */

    public function executeImprimeEtatExtraitClient(sfWebRequest $request) {
        $pdf = new sfTCPDF("L");

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Extrait Auxiliaire Client ');
        $pdf->SetSubject("Extrait Auxiliaire Client");
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
        $html = $this->ReadHtmlExtraitCompteClient($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Extrait Auxiliaire Client.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlExtraitCompteClient(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $compte = new Client();
        $html .= $compte->ReadHtmlExtraitCompteClient($request);
        return $html;
    }

       public function executeExporterExtraitFournisseurExcel(sfWebRequest $request) {
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

        $fournisseur = FournisseurTable::getInstance()->find($compte);

        $etatExtraitCompte = LignePieceComptableTable::getInstance()->loadEtatExtraitCompteClient($compte, $date_debut, $date_fin, $journal, $order, $lettre, $non_lettre, $debit, $credit, $dossier_id, $exercice_id);

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
        $this->fournisseur = $fournisseur;
        $this->etatExtraitCompte = $etatExtraitCompte;
    }

    public function executeExporterExtraitClientExcel(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $compte = $request->getParameter('compte', '');

        $date_debut = $request->getParameter('date_debut');

//        if ($date_debut == '' || $date_debut == NULL)
//            $date_debut = date('Y') . '-01-01';

        $date_fin = $request->getParameter('date_fin');
//        if ($date_fin == '' || $date_fin == NULL)
//            $date_fin = date('Y') . '-12-31';

        $journal = $request->getParameter('journal', '');
        $order = $request->getParameter('order', '');
        $lettre = $request->getParameter('lettre', '');
        $non_lettre = $request->getParameter('non_lettre', '');
        $debit = $request->getParameter('debit', '');
        $credit = $request->getParameter('credit', '');

        $client = ClientTable::getInstance()->find($compte);

        $etatExtraitCompte = LignePieceComptableTable::getInstance()->loadEtatExtraitCompteClient($compte, $date_debut, $date_fin, $journal, $order, $lettre, $non_lettre, $debit, $credit, $dossier_id, $exercice_id);

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
        $this->client = $client;
        $this->etatExtraitCompte = $etatExtraitCompte;
    }
  public function executeImprimerListeFounisseur(sfWebRequest $request)
    {

        $pdf = new sfTCPDF('L');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Des Fournisseurs');
        $pdf->SetSubject("Liste Des Fournisseurs");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete =  $soc->getMinistere();
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
        $pdf->SetMargins(10, 30, 10);
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
        $pdf->AddPage();
        $html = $this->ReadHtmlListeFournisseur($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Des Fournisseurs.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeFournisseur(sfWebRequest $request)
    {
        $html = StyleCssHeader::header1();
        $frounisseur = new Fournisseur();

        $html .= $frounisseur->ReadHtmAlllListeFounisseurCompta($request);
        return $html;
    }

    public function executeExporterFourniseseurExcel(sfWebRequest $request)
    {
        
        $forunisseur = FournisseurTable::getInstance()->findAll();
        $this->fournisseurs = $forunisseur;
    }
 
}
