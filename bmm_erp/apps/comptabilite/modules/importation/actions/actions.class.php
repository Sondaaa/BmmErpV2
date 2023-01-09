<?php

/**
 * importation actions.
 *
 * @package    sw-commerciale
 * @subpackage importation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class importationActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
    }

    public function executeImprimerordonnance(sfWebRequest $request) {
        $id = $request->getParameter('id');
       
        $pdf = new sfTCPDF();
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Ordonnance de Paiement');
        $pdf->SetSubject("Ordonnance de Paiement");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getRs();
        $pdf->SetAuthor($entete);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(0, 0, 0);

        // set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
//        $pdf->SetMargins(5, 10, 5);
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
        $html = $this->ReadHtmlOrdonnance($id);
        $pdf->writeHTML($html, true, false, true, false, '');
//        ob_end_clean();
        $pdf->Output('Ordonnance de Paiement.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlOrdonnance($id) {
        $html = StyleCssHeader::header1();
        $document_budget = new Documentbudget();
        $html .= $document_budget->ReadHtmlOrdonnanceComp($id);
        return $html;
    }

     public function executeImprimerordonnanceBDCReg(sfWebRequest $request) {
        $id = $request->getParameter('id');
         $id_docachat = $request->getParameter('id_docachat');

        $pdf = new sfTCPDF();
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Ordonnance de Paiement');
        $pdf->SetSubject("Ordonnance de Paiement");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getRs();
        $pdf->SetAuthor($entete);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(0, 0, 0);

        // set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
//        $pdf->SetMargins(5, 10, 5);
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
        $html = $this->ReadHtmlOrdonnanceBDCReg($id,$id_docachat);
        $pdf->writeHTML($html, true, false, true, false, '');
//        ob_end_clean();
        $pdf->Output('Ordonnance de Paiement.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlOrdonnanceBDCReg($id,$id_docachat) {
        $html = StyleCssHeader::header1();
        $document_budget = new Documentbudget();
        $html .= $document_budget->ReadHtmlOrdonnanceComp($id,$id_docachat);
        return $html;
    }
    public function executeDeleteSoldecompte(sfWebRequest $request) {

        $id = $request->getParameter('id');
        $plan = PlandossiercomptableTable::getInstance()->find($id);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $query_update = "UPDATE public.plandossiercomptable"
                . " SET typesolde= '" . 0 . "'"
                . " , solde = " . 0.000
                . " where id=" . $id
                . ";";
        $resultat_update = $conn->fetchAssoc($query_update);
        $compte_comptable = PlandossiercomptableTable::getInstance()->getBalance($_SESSION['dossier_id'], $exercice_id);
//        return $this->renderPartial("list_comptes_plan_dossier", array("comptes" => $compte_comptable));
        $pager = $this->getAllBalance($request);
        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("impotation/list_comptes_plan_dossier", array("comptes" => $compte_comptable, "pager" => $pager));
        }
//        $pager = $this->getAllBalance($request);
//        if ($request->isXmlHttpRequest()) {
//        return $this->renderPartial("impotation/list_comptes_balance", array("pager" => $pager));
//        }
//        die("ok");
    }

    function getAllBalance(sfWebRequest $request) {
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $pager = new sfDoctrinePager('Plandossiercomptable', 5);
        $pager->setQuery(PlandossiercomptableTable::getInstance()->getBalance($dossier_id, $exercice_id));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        return $pager;
    }

    function getPager(sfWebRequest $request) {

        $pager = new sfDoctrinePager('Plandossiercomptable', 10);
        $pager->setQuery(PlandossiercomptableTable::getInstance()->findAll());

        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeAchat(sfWebRequest $request) {
        $this->dossiers = DossiercomptableTable::getInstance()->findAll();
        $this->exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
    }

    public function executeVente(sfWebRequest $request) {
        $this->dossiers = DossiercomptableTable::getInstance()->findAll();
        $this->exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
    }

    public function executeAchatExcel(sfWebRequest $request) {
        
    }

    public function executeGoBalanceExcel(sfWebRequest $request) {
        $tmp_name = $_FILES['lib_fichier']['tmp_name'];
        $name = $_FILES['lib_fichier']['name'];

        $url_fichier = "uploads/import/" . $name;
        move_uploaded_file($tmp_name, $url_fichier);

        $this->url_fichier = $url_fichier;
        $this->name = $name;
    }

    public function executeGoOdExcel(sfWebRequest $request) {
        $tmp_name = $_FILES['lib_fichier']['tmp_name'];
        $name = $_FILES['lib_fichier']['name'];

        $url_fichier = "uploads/import/" . $name;
        move_uploaded_file($tmp_name, $url_fichier);

        $this->url_fichier = $url_fichier;
        $this->name = $name;
    }

    public function executeGoOdExcelClient(sfWebRequest $request) {
        $tmp_name = $_FILES['lib_fichier']['tmp_name'];
        $name = $_FILES['lib_fichier']['name'];

        $url_fichier = "uploads/import/" . $name;
        move_uploaded_file($tmp_name, $url_fichier);

        $this->url_fichier = $url_fichier;
        $this->name = $name;
    }

    public function executeBalanceexcel(sfWebRequest $request) {
        
    }

    public function executeOdExcel(sfWebRequest $request) {
        
    }

    public function executeOdExcelClient(sfWebRequest $request) {
        
    }

    public function executeSavePlanComptable(sfWebRequest $request) {
        $code = $request->getParameter('code');
        $classe = $request->getParameter('classe');
        $libelle = $request->getParameter('libelle');
        $code = explode(';', $code);
        $classe = explode(';', $classe);
        $libelle = str_replace("'", "''", $libelle);
        $libelle = explode(';;', $libelle);
        $standard = 0;
        $values = '';
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');
        $trouve = 2;
//        die($_SESSION['dossier_id']);

        for ($i = 0; $i < sizeof($code); $i++) {
            if ($code[$i] != '') {

                $plancomptable = PlancomptableTable::getInstance()->findOneByNumerocompteAndIdDossier($code[$i], $_SESSION['dossier_id']);

                if (sizeof($plancomptable) > 0) {
                    $trouve = 1;
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                    $query_update = "UPDATE public.plancomptable"
                            . " SET libelle= '" . $libelle[$i] . "'"
                            . " , standard = " . $standard
                            . " where trim(numerocompte) = '" . $code[$i] .
                            "' and id_dossier = " . $_SESSION['dossier_id']
                            . ";";
                    $resultat_update = $conn->fetchAssoc($query_update);
                } else {
                    $trouve = 0;
                    if ($values == '')
                        $values = $values . '(';
                    else
                        $values = $values . ', (';

                    $values = $values . "'" . $code[$i] . "','" . $libelle[$i] . "','" . date('Y-m-d')
                            . "'," . $classe[$i] . "," . $_SESSION['dossier_id'] . "," . $user->getId() . "," . $standard;
                    $values = $values . ')';
                }
            }
        }

        if ($trouve == 0) {
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query_insert = "INSERT INTO plancomptable(numerocompte, libelle, date, id_classe, id_dossier, id_user,standard)
	VALUES " . $values . ";";
            $resultat = $conn->fetchAssoc($query_insert);
        }
//Insertion des comptes comptables dans le table plancomptable


        die('OK');
    }

    public function executeSavePlanDossierComptable(sfWebRequest $request) {
        $soldeD = $request->getParameter('soldeD');
        $soldeC = $request->getParameter('soldeC');
        $code = $request->getParameter('code');
        $libelle = $request->getParameter('libelle');
        $code_parent = $request->getParameter('code_parent');
        $soldeD = explode(';', $soldeD);
        $soldeC = explode(';', $soldeC);
        $code = explode(';', $code);
        $code_parent = explode(';', $code_parent);
        $libelle = str_replace("'", "''", $libelle);
        $libelle = explode(';;', $libelle);
        $trouve = 2;
//  die(json_encode($libelle));
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $values = '';
        $chinae = '';
        for ($i = 0; $i < sizeof($code); $i++) {
            $solde[$i] = 0;
            $typesolde = 0;
            if ($code[$i] != '') {

                $planDossierComptable = PlandossiercomptableTable::getInstance()->findByNumerocompteAndDossierAndExercice($code[$i], $_SESSION['dossier_id'], $_SESSION['exercice_id']);


                if (sizeof($planDossierComptable) > 0) {
                    $trouve = 1;
                    if ($soldeD[$i]) {
                        $solde[$i] = $soldeD[$i];
                        $typesolde = 1;
                    } else {
                        $soldeD[$i] = 0.000;
                    }
                    if ($soldeC[$i]) {
                        $solde[$i] = -$soldeC[$i];
                        $typesolde = 2;
                    } else {
                        $soldeC[$i] = 0.000;
                    }
                    if ($code[$i] != '') {
//update id_compte dans le table plancomptabledie
                        $query_update = "UPDATE public.plancomptable"
                                . " SET typesolde= " . $typesolde . ""
                                . ", id_compte= (select id from plancomptable"
                                . " where trim(numerocompte) = '" . $code[$i] .
                                "' and id_dossier = " . $_SESSION['dossier_id'] .
                                " limit 1) WHERE trim(numerocompte) = '" . $code[$i] .
                                "' AND id_dossier = " . $_SESSION['dossier_id']
                                . ";";
                        $resultat_update = $conn->fetchAssoc($query_update);
                        $query_update_plan_dossier = "UPDATE public.plandossiercomptable"
                                . " SET libelle= '" . $libelle[$i] . "'"
                                . ", typesolde= " . $typesolde . ","
                                . " solde = " . $solde[$i]
                                . " where trim(numerocompte) = '" . $code[$i] .
                                "' and id_dossier = " . $_SESSION['dossier_id']
                                . " and id_exercice = " . $_SESSION['exercice_id']
                                . ";";
                        $resultat_update = $conn->fetchAssoc($query_update_plan_dossier);
                    }
                } else {
                    $trouve = 0;
                    if ($values == '')
                        $values = $values . '(';
                    else {
                        $values = $values . ', (';
                    }
                    $chinae .='solded=' . $soldeD[$i] . '$soldeC[$i]=' . $soldeC[$i];
                    if ($soldeD[$i]) {
                        $solde[$i] = $soldeD[$i];
                        $typesolde = 1;
                    } else {
                        $soldeD[$i] = 0.000;
                    }
                    if ($soldeC[$i]) {
                        $solde[$i] = -$soldeC[$i];
                        $typesolde = 2;
                    } else {
                        $soldeC[$i] = 0.000;
                    }

                    $values = $values . "'" . $code[$i] . "','" . $libelle[$i] .
                            "','" . date('Y-m-d') . "','" . $solde[$i] . "',"
                            . $typesolde . "," .
                            $_SESSION['dossier_id'] . "," .
                            $_SESSION['exercice_id'] . ", "
                            . "(select id from plancomptable where trim(numerocompte) = '"
                            . $code[$i]
                            . "' and id_dossier = " . $_SESSION['dossier_id']
                            . " and id_exercice = " . $_SESSION['exercice_id'] .
                            " limit 1)";
                    $values = $values . ')';
//               //Insertion des comptes comptables dans le table plandossiercomptable
                }
            }
        }

        if ($trouve == 0) {
            $query = "INSERT INTO plandossiercomptable(numerocompte,libelle, date, solde,typesolde,id_dossier, id_exercice, id_plan)
                	VALUES " . $values . ";";
            $resultat = $conn->fetchAssoc($query);
        }
        die('OK');
    }

    public function executeGoAchatExcel(sfWebRequest $request) {
        $tmp_name = $_FILES['lib_fichier']['tmp_name'];
        $name = $_FILES['lib_fichier']['name'];

        $url_fichier = "uploads/import/" . $name;
        move_uploaded_file($tmp_name, $url_fichier);

        $this->url_fichier = $url_fichier;
        $this->name = $name;
    }

    public function executeVerifFournisseur(sfWebRequest $request) {
//        $libelles = $request->getParameter('libelles');
//        $libelles = explode(';;', $libelles);
        $codes = $request->getParameter('codes');
        $codes = explode(';;', $codes);
//        $this->fournisseurs = FournisseurTable::getInstance()->getByListeLibelle($libelles);
        $this->fournisseurs = FournisseurTable::getInstance()->getByListeCode($codes);
    }

    public function executeVerifPlancomptable(sfWebRequest $request) {
        $compte_comptable = $request->getParameter('compte_comptable');
        $compte_comptable = explode(';;', $compte_comptable);
        $compte_charge = $request->getParameter('compte_charge');
        $compte_charge = explode(';;', $compte_charge);
        $comptecomptable = PlandossiercomptableTable::getInstance()->getByListeCompte($compte_comptable, $compte_charge);
        $this->comptecomptable = $comptecomptable;
    }

    public function executeVerifPlancomptableretenue(sfWebRequest $request) {
        $compte_comptable = $request->getParameter('compte_comptable');
        $compte_comptable = explode(';;', $compte_comptable);
        $compte_charge = $request->getParameter('compte_charge');
        $compte_charge = explode(';;', $compte_charge);
        $comptecomptable = PlandossiercomptableTable::getInstance()->getByListeCompte($compte_comptable, $compte_charge);
        $this->comptecomptable = $comptecomptable;
    }

    public function executeVerifPlancomptableClient(sfWebRequest $request) {
        $compte_comptable = $request->getParameter('compte_comptable');
        $compte_comptable = explode(';;', $compte_comptable);
        $comptecomptable = PlandossiercomptableTable::getInstance()->getByListeCompteClient($compte_comptable);
        $this->comptecomptable = $comptecomptable;
    }

    public function executeVerifPlancomptableBalance(sfWebRequest $request) {
        $compte_comptable = $request->getParameter('compte_comptable');
        $compte_comptable = explode(';;', $compte_comptable);
        $comptecomptable = PlandossiercomptableTable::getInstance()->getByListeCompteClient($compte_comptable);
        $this->comptecomptable = $comptecomptable;
    }

    public function executeVerifPlancomptableMouvement(sfWebRequest $request) {
        $compte_comptable = $request->getParameter('compte_comptable');
        $compte_comptable = explode(';;', $compte_comptable);
        $comptecomptable = PlandossiercomptableTable::getInstance()->getByListeCompteClient($compte_comptable);
        $this->comptecomptable = $comptecomptable;
    }

    public function executeVerifClient(sfWebRequest $request) {
        $codes = $request->getParameter('codes');
        $codes = explode(';;', $codes);
        $clients = ClientTable::getInstance()->getByListeCode($codes);
        $this->clients = $clients;
    }

    public function executeSaveFournisseur(sfWebRequest $request) {
        $libelles = $request->getParameter('libelles');
        $libelles = explode(';;', $libelles);
        $codes = $request->getParameter('codes');
        $codes = explode(';;', $codes);
        $comptes = $request->getParameter('comptes');
        $comptes = explode(';;', $comptes);
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');

        for ($i = 0; $i < sizeof($libelles); $i++) {
            if ($libelles[$i] != '') {
                $fournisseur = new Fournisseur();
                $fournisseur->setRs($libelles[$i]);
                $fournisseur->setCodefrs($codes[$i]);
                $fournisseur->setDatecreation(date('Y-m-d'));
                $fournisseur->setDatemisajour(date('Y-m-d'));
                $fournisseur->setEtatfrs('Actif');
                $fournisseur->setCertificatrs(false);
                $fournisseur->setIdDossier($_SESSION['dossier_id']);
                $fournisseur->save();

//Insertion du compte comptable du fournisseur s'il existe
                if ($comptes[$i] != '') {
                    $plan_comptable = PlancomptableTable::getInstance()->findOneByNumerocompteAndIdDossier($comptes[$i], $_SESSION['dossier_id']);

                    if ($plan_comptable != null) {
                        $fournisseur->setIdPlancomptable($plan_comptable->getId());
                        $fournisseur->save();
                    } else {
                        $dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);
                        $numero_compte_parent = str_pad("401", $dossier->getNombrechiffrenumerocompte());
                        $plan_comptable_parent = PlancomptableTable::getInstance()->findByNumerocompte($numero_compte_parent)->getFirst();
                        if (!$plan_comptable_parent)
                            $plan_comptable_parent = PlancomptableTable::getInstance()->findByNumerocompte("401")->getFirst();

//Ajout du plan comptable
                        $plan_comptable = new Plancomptable();
                        $plan_comptable->setDate(date('Y-m-d'));
                        $plan_comptable->setIdClasse(4);
                        $plan_comptable->setNumerocompte($comptes[$i]);
                        $plan_comptable->setLibelle($libelles[$i]);
                        $plan_comptable->setIdDossier($_SESSION['dossier_id']);
                        $plan_comptable->setStandard(0);
                        $plan_comptable->setIdCompte($plan_comptable_parent->getId());
                        $plan_comptable->setIdUser($user->getId());
                        $plan_comptable->save();
//die($plan_comptable->getId().'ll');
//Ajout du plan dossier comptable
                        $plan_dossier = new Plandossiercomptable();
                        $plan_dossier->setDate(date('Y-m-d'));
                        $plan_dossier->setNumerocompte($comptes[$i]);
                        $plan_dossier->setLibelle($libelles[$i]);
                        $plan_dossier->setIdPlan($plan_comptable->getId());
                        $plan_dossier->setIdDossier($_SESSION['dossier_id']);
                        $plan_dossier->setIdExercice($_SESSION['exercice_id']);
                        $plan_dossier->setSolde(0);
                        $plan_dossier->save();

                        $fournisseur->setIdPlancomptable($plan_comptable->getId());
                        $fournisseur->save();
                    }
                }
            }
        }
        die('OK');
    }

    public function executeSaveFactureAchat(sfWebRequest $request) {

        $params = array();
        $content = $request->getContent();
        $params = json_decode($content, true);
        $numero = $params['numero'];
        $reference = $params['reference'];
        $fournisseur = $params['fournisseur'];
        $doc = $params['doc'];
        $date = $params['date'];
        $montant_ht = $params['montant_ht'];
        $montant_tva = $params['montant_tva'];
        $montant_timbre = $params['montant_timbre'];
        $montant_ttc = $params['montant_ttc'];
        $comptes_charge = $params['comptes_charge'];
        $libelle = $params['libelle'];
        $numero = explode(';', $numero);
        $reference = explode(';', $reference);
        $doc = explode(';', $doc);
        $date = explode(';', $date);
        $fournisseur = str_replace("'", "''", $fournisseur);
        $fournisseur = explode(';;', $fournisseur);
        $montant_ht = explode(';', $montant_ht);
        $montant_tva = explode(';', $montant_tva);
        $montant_timbre = explode(';', $montant_timbre);
        $montant_ttc = explode(';', $montant_ttc);
        $comptes_charge = explode(';', $comptes_charge);
        $libelle = explode(';', $libelle);
        $values = '';
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');
//        die(json_encode($reference));
        for ($i = 0; $i < sizeof($reference); $i++) {
            if ($reference[$i] != '') {
                if ($values == '')
                    $values = $values . '(';
                else
                    $values = $values . ', (';

                if ($date[$i] != '') {
                    $date_document = explode('/', $date[$i]);
                    $date_doc = $date_document[2] . '-' . $date_document[1] . '-' . $date_document[0];
                } else {
                    $date_doc = date('Y-m-d', strtotime($date[$i]));
                }
                $plan_comptable = PlandossiercomptableTable::getInstance()->getByNumeroAndDossierAndExercice($comptes_charge[$i], $_SESSION['dossier_id'], $_SESSION['exercice_id']);
//die('siz'.sizeof($plan_comptable).$comptes_charge[0]);
                $values = $values . substr(preg_replace("/[^0-9]/", "", $doc[$i]), 0, 9) . ",'" . $reference[$i] . "','" . $date_doc . "','" . date('Y-m-d') . "'," . $_SESSION['dossier_id'] . ",0," . " (select id from fournisseur where lower(trim(rs)) like  '%" . strtolower($fournisseur[$i]) . "%' and id_dossier=" . $_SESSION['dossier_id'] . " Limit 1)" . "," . $montant_ht[$i] . "," . $montant_tva[$i] . "," . $montant_timbre[$i] . "," . $montant_ttc[$i] . ","
                        . $plan_comptable->getFirst()->getIdPlan() . ",'" . $libelle[$i] . "'";
                $values = $values . ')';
            }
        }

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

//die($values);
        if ($values != '')
            $query = "INSERT INTO facturecomptableachat(numero, reference, date, dateimportation, id_dossier, saisie, id_fournisseur, totalht, totaltva, timbre, totalttc,id_comptecharge,libelle)
	VALUES " . $values . ";"
            ;

        $resultat = $conn->fetchAssoc($query);
 die('OK');

//        $this->getResponse()->setContentType('text/json');
//
//        return $this->renderText(json_encode(array(
//                    "msg" => "OK"
//        )));
    }

    public function executeSaveFactureod(sfWebRequest $request) {
        $reference = $request->getParameter('numero');
        $doc = $request->getParameter('doc');
        $date = $request->getParameter('date');
        $fournisseur = $request->getParameter('fournisseur');
        $montant_ht = $request->getParameter('montant_ht');
        $montant_tva = $request->getParameter('montant_tva');
        $montant_timbre = $request->getParameter('montant_timbre');
        $montant_ttc = $request->getParameter('montant_ttc');
        $comptes = $request->getParameter('comptes');
        $comptes = $request->getParameter('comptes');
        $comptes = explode(';', $comptes);
        $reference = explode(';', $reference);
        $doc = explode(';', $doc);
        $date = explode(';', $date);
        $fournisseur = str_replace("'", "''", $fournisseur);
        $fournisseur = explode(';;', $fournisseur);
        $montant_ht = explode(';', $montant_ht);
        $montant_tva = explode(';', $montant_tva);
        $montant_timbre = explode(';', $montant_timbre);
        $montant_ttc = explode(';', $montant_ttc);
        $values = '';
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');

        for ($i = 0; $i < sizeof($reference); $i++) {
            if ($reference[$i] != '') {
                if ($values == '')
                    $values = $values . '(';
                else
                    $values = $values . ', (';

                if ($date[$i] != '') {
                    $date_document = explode('/', $date[$i]);
                    $date_doc = $date_document[2] . '-' . $date_document[1] . '-' . $date_document[0];
                } else {
                    $date_doc = date('Y-m-d', strtotime($date[$i]));
                }

                $plan_comptable = PlandossiercomptableTable::getInstance()->getByNumeroAndDossierAndExercice($comptes[$i], $_SESSION['dossier_id'], $_SESSION['exercice_id']);
//die(($plan_comptable->getFirst()->getIdPlan()).'num'. $_SESSION['dossier_id'].'dos'.$_SESSION['exercice_id']);
                $values = $values . substr(preg_replace("/[^0-9]/", "", $doc[$i]), 0, 9) . ",'" . $reference[$i] . "','" . $date_doc . "','" . date('Y-m-d') . "'," . $_SESSION['dossier_id'] . ",0," . " (select id from fournisseur where lower(trim(rs)) = '" . strtolower($fournisseur[$i]) . "' and id_dossier=" . $_SESSION['dossier_id'] . " Limit 1)" . "," . $montant_ht[$i] . "," . $montant_tva[$i] . "," . $montant_timbre[$i] . "," . $montant_ttc[$i] . ","
                        . $plan_comptable->getFirst()->getIdPlan();
                $values = $values . ')';
            }
        }

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

//Insertion des Factures
        if ($values != '')
            $query = "INSERT INTO facturecomptableod(numero, reference, date, dateimportation, id_dossier, saisie, id_fournisseur, totalht, totaltva, timbre, totalttc,id_compteretenue)
	VALUES " . $values . ";"
            ;
        $resultat = $conn->fetchAssoc($query);
//      if ($comptes[$i] != '') {
//            $plan_comptable = PlancomptableTable::getInstance()->findByNumerocompteAndIdDossier($comptes[$i], $_SESSION['dossier_id'])->getFirst();
//
//            if ($plan_comptable != null) {
//                $resultat = $conn->fetchAssoc($query);
//            } else {
//                $dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);
//                $numero_compte_parent = str_pad("432", $dossier->getNombrechiffrenumerocompte());
//                $plan_comptable_parent = PlancomptableTable::getInstance()->findByNumerocompte($numero_compte_parent)->getFirst();
//                if (!$plan_comptable_parent)
//                    $plan_comptable_parent = PlancomptableTable::getInstance()->findByNumerocompte("432")->getFirst();
//
////Ajout du plan comptable
//                $plan_comptable = new Plancomptable();
//                $plan_comptable->setDate(date('Y-m-d'));
//                $plan_comptable->setIdClasse(4);
//                $plan_comptable->setNumerocompte($comptes[$i]);
//                $plan_comptable->setLibelle($libelles[$i]);
//                $plan_comptable->setIdDossier($_SESSION['dossier_id']);
//                $plan_comptable->setStandard(0);
//                $plan_comptable->setIdCompte($plan_comptable_parent->getId());
//                $plan_comptable->setIdUser($user->getId());
//                $plan_comptable->save();
////die($plan_comptable->getId().'ll');
////Ajout du plan dossier comptable
//                $plan_dossier = new Plandossiercomptable();
//                $plan_dossier->setDate(date('Y-m-d'));
//                $plan_dossier->setNumerocompte($comptes[$i]);
//                $plan_dossier->setLibelle($libelles[$i]);
//                $plan_dossier->setIdPlan($plan_comptable->getId());
//                $plan_dossier->setIdDossier($_SESSION['dossier_id']);
//                $plan_dossier->setIdExercice($_SESSION['exercice_id']);
//                $plan_dossier->setSolde(0);
//                $plan_dossier->save();
//                $resultat = $conn->fetchAssoc($query);
//            }
//        }


        die('OK');
    }

    public function executeSaveFactureodClient(sfWebRequest $request) {
        $reference = $request->getParameter('numero');
        $doc = $request->getParameter('doc');
        $date = $request->getParameter('date');
        $fournisseur = $request->getParameter('fournisseur');
        $montant_ht = $request->getParameter('montant_ht');
        $montant_tva = $request->getParameter('montant_tva');
        $montant_timbre = $request->getParameter('montant_timbre');
        $montant_ttc = $request->getParameter('montant_ttc');
        $comptes = $request->getParameter('comptes');
        $comptes = $request->getParameter('comptes');
        $comptes = explode(';', $comptes);
        $reference = explode(';', $reference);
        $doc = explode(';', $doc);
        $date = explode(';', $date);
        $fournisseur = str_replace("'", "''", $fournisseur);
        $fournisseur = explode(';;', $fournisseur);
        $montant_ht = explode(';', $montant_ht);
        $montant_tva = explode(';', $montant_tva);
        $montant_timbre = explode(';', $montant_timbre);
        $montant_ttc = explode(';', $montant_ttc);
        $values = '';
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');

        for ($i = 0; $i < sizeof($reference); $i++) {
            if ($reference[$i] != '') {
                if ($values == '')
                    $values = $values . '(';
                else
                    $values = $values . ', (';

                if ($date[$i] != '') {
                    $date_document = explode('/', $date[$i]);
                    $date_doc = $date_document[2] . '-' . $date_document[1] . '-' . $date_document[0];
                } else {
                    $date_doc = date('Y-m-d', strtotime($date[$i]));
                }

                $plan_comptable = PlandossiercomptableTable::getInstance()->getByNumeroAndDossierAndExercice($comptes[$i], $_SESSION['dossier_id'], $_SESSION['exercice_id']);
//die(($plan_comptable->getFirst()->getIdPlan()).'num'. $_SESSION['dossier_id'].'dos'.$_SESSION['exercice_id']);
                $values = $values . substr(preg_replace("/[^0-9]/", "", $doc[$i]), 0, 9) . ",'" . $reference[$i] . "','" . $date_doc . "','" . date('Y-m-d') . "'," . $_SESSION['dossier_id'] . ",0," . " (select id from client where lower(trim(rs)) = '" . strtolower($fournisseur[$i]) . "' and id_dossier=" . $_SESSION['dossier_id'] . " Limit 1)" . "," . $montant_ht[$i] . "," . $montant_tva[$i] . "," . $montant_timbre[$i] . "," . $montant_ttc[$i] . ","
                        . $plan_comptable->getFirst()->getIdPlan();
                $values = $values . ')';
            }
        }

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

//Insertion des Factures
        if ($values != '')
            $query = "INSERT INTO facturecomptableodclient(numero, reference, date, dateimportation, id_dossier, saisie, id_client, totalht, totaltva, timbre, totalttc,id_compteretenue)
	VALUES " . $values . ";"
            ;
        $resultat = $conn->fetchAssoc($query);


        die('OK');
    }

    public function executeVenteExcel(sfWebRequest $request) {
        
    }

    public function executeTresorieExcel(sfWebRequest $request) {
        
    }

    public function executeMouvementExcel(sfWebRequest $request) {
        
    }

    public function executeGoVenteExcel(sfWebRequest $request) {
        $tmp_name = $_FILES['lib_fichier']['tmp_name'];
        $name = $_FILES['lib_fichier']['name'];

        $url_fichier = "uploads/import/" . $name;
        move_uploaded_file($tmp_name, $url_fichier);

        $this->url_fichier = $url_fichier;
        $this->name = $name;
    }

    public function executeGoTresorerieExcel(sfWebRequest $request) {
        $tmp_name = $_FILES['lib_fichier']['tmp_name'];
        $name = $_FILES['lib_fichier']['name'];

        $url_fichier = "uploads/import/" . $name;
        move_uploaded_file($tmp_name, $url_fichier);

        $this->url_fichier = $url_fichier;
        $this->name = $name;
    }

    public function executeGoMouvementExcel(sfWebRequest $request) {
        $tmp_name = $_FILES['lib_fichier']['tmp_name'];
        $name = $_FILES['lib_fichier']['name'];

        $url_fichier = "uploads/import/" . $name;
        move_uploaded_file($tmp_name, $url_fichier);

        $this->url_fichier = $url_fichier;
        $this->name = $name;
    }

    public function executeSaveClient(sfWebRequest $request) {
        $libelles = $request->getParameter('libelles');
        $libelles = explode(';;', $libelles);
        $codes = $request->getParameter('codes');
        $codes = explode(';;', $codes);
        $comptes = $request->getParameter('comptes');
        $comptes = explode(';;', $comptes);
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');
        for ($i = 0; $i < sizeof($libelles); $i++) {
            if ($libelles[$i] != '') {
                $client = new Client();
                $client->setRs($libelles[$i]);
                $client->setCodeclt($codes[$i]);
                $client->setDatecreation(date('Y-m-d'));
                $client->setIdDossier($_SESSION['dossier_id']);
                $client->save();

//Insertion du compte comptable du client s'il existe
                if ($comptes[$i] != '') {
                    $plan_comptable = PlancomptableTable::getInstance()->findByNumerocompteAndIdDossier($comptes[$i], $_SESSION['dossier_id'])->getFirst();


                    if ($plan_comptable != null) {
                        $client->setIdPlancomptable($plan_comptable->getId());
                        $client->save();
                    } else {
                        $dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);
                        $numero_compte_parent = str_pad("411", $dossier->getNombrechiffrenumerocompte());
                        $plan_comptable_parent = PlancomptableTable::getInstance()->findByNumerocompte($numero_compte_parent)->getFirst();
                        if (!$plan_comptable_parent)
                            $plan_comptable_parent = PlancomptableTable::getInstance()->findByNumerocompte("411")->getFirst();

//Ajout du plan comptable
                        $plan_comptable = new Plancomptable();
                        $plan_comptable->setDate(date('Y-m-d'));
                        $plan_comptable->setIdClasse(4);
                        $plan_comptable->setNumerocompte($comptes[$i]);
                        $plan_comptable->setLibelle($libelles[$i]);
                        $plan_comptable->setIdDossier($_SESSION['dossier_id']);
                        $plan_comptable->setStandard(0);
                        $plan_comptable->setIdCompte($plan_comptable_parent->getId());
                        $plan_comptable->setIdUser($user->getId());
                        $plan_comptable->save();

//Ajout du plan dossier comptable
                        $plan_dossier = new Plandossiercomptable();
                        $plan_dossier->setDate(date('Y-m-d'));
                        $plan_dossier->setNumerocompte($comptes[$i]);
                        $plan_dossier->setLibelle($libelles[$i]);
                        $plan_dossier->setIdPlan($plan_comptable->getId());
                        $plan_dossier->setIdDossier($_SESSION['dossier_id']);
                        $plan_dossier->setIdExercice($_SESSION['exercice_id']);
                        $plan_dossier->setSolde(0);
                        $plan_dossier->save();

                        $client->setIdPlancomptable($plan_comptable->getId());
                        $client->save();
                    }
                }
            }
        }
        die('OK');
    }

    public function executeSaveFactureVente(sfWebRequest $request) {
        $reference = $request->getParameter('numero');
        $ref = $request->getParameter('reference');
        $doc = $request->getParameter('doc');
        $date = $request->getParameter('date');
        $fournisseur = $request->getParameter('fournisseur');
        $montant_htax = $request->getParameter('montant_htax');
        $montant_fodec = $request->getParameter('montant_fodec');
        $montant_ht = $request->getParameter('montant_ht');
        $montant_tva = $request->getParameter('montant_tva');
        $montant_timbre = $request->getParameter('montant_timbre');
        $montant_ttc = $request->getParameter('montant_ttc');

        $reference = explode(';', $reference);
        $ref = explode(';', $ref);
        $doc = explode(';', $doc);
        $date = explode(';', $date);
        $fournisseur = str_replace("'", "''", $fournisseur);
        $fournisseur = explode(';;', $fournisseur);
        $montant_ht = explode(';', $montant_ht);
        $montant_tva = explode(';', $montant_tva);
        $montant_htax = explode(';', $montant_htax);
        $montant_fodec = explode(';', $montant_fodec);
        $montant_timbre = explode(';', $montant_timbre);
        $montant_ttc = explode(';', $montant_ttc);

        $values = '';
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');
//        die(json_encode($reference).'mp');
        for ($i = 0; $i < sizeof($reference); $i++) {
            if ($reference[$i] != '') {
                if ($values == '')
                    $values = $values . '(';
                else
                    $values = $values . ', (';

                if ($date[$i] != '') {
                    $date_document = explode('/', $date[$i]);
                    $date_doc = $date_document[2] . '-' . $date_document[1] . '-' . $date_document[0];
                } else {
                    $date_doc = date('Y-m-d', strtotime($date[$i]));
                }

                $values = $values . substr(preg_replace("/[^0-9]/", "", $doc[$i]), 0, 9) . ",'" . $ref[$i] . "','" . $date_doc . "','" . date('Y-m-d') . "'," . $_SESSION['dossier_id'] . ",0," . " (select id from client where lower(trim(rs)) = '" . strtolower($fournisseur[$i]) . "' and id_dossier=" . $_SESSION['dossier_id'] . " Limit 1)" . "," . $montant_ht[$i] . "," . $montant_tva[$i] . "," . $montant_timbre[$i] . "," . $montant_ttc[$i] . "," . $montant_htax[$i] . "," . $montant_fodec[$i];
                $values = $values . ')';
            }
        }

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

//Insertion des Factures
        $query = "INSERT INTO facturecomptablevente(numero, reference, date, dateimportation, id_dossier, saisie, id_client, totalht, totaltva, timbre, totalttc , totalhtax , tfodec)
	VALUES " . $values . ";";

        $resultat = $conn->fetchAssoc($query);

        die('OK');
    }

    public function executeSaveFactureTresorie(sfWebRequest $request) {
        $params = array();
        $content = $request->getContent();
        $params = json_decode($content, true);
        $date_valeur = $params['date_valeur'];
        $reference = $params['numero'];
        $libelle = $params['libelle'];
        $doc = $params['doc'];
        $date = $params['date'];
//        $type = $params['type'];
        $montant_ht = $params['montant_ht'];
        $montant_tva = $params['montant_tva'];
        $type = $params['type'];
        $montant_ttc = $params['montant_ttc'];
        $numero_compte = $params['numero_compte'];
        $reference = explode(';', $reference);
        $doc = explode(';', $doc);
        $date = explode(';', $date);
        $libelle = explode(';', $libelle);
        $type = explode(';', $type);
        $montant_ht = explode(';', $montant_ht);
        $montant_tva = explode(';', $montant_tva);
        $date_valeur = explode(';', $date_valeur);
        $montant_ttc = explode(';', $montant_ttc);
        $numero_compte = explode(';', $numero_compte);
        $values = '';
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');

        for ($i = 0; $i < sizeof($date); $i++) {

            if ($reference[$i] != '') {
                if ($values == '')
                    $values = $values . '(';
                else
                    $values = $values . ', (';

                if ($date[$i] != '') {
                    $date_document = explode('/', $date[$i]);
                    $date_doc = $date_document[2] . '-' . $date_document[1] . '-' . $date_document[0];
                } else {
                    $date_doc = date('Y-m-d', strtotime($date[$i]));
                }
                if ($numero_compte[$i] != '') {

                    $compte_comptable = PlandossiercomptableTable::getInstance()->findOneByNumerocompteAndIdDossierAndIdExercice($numero_compte[$i], $_SESSION['dossier_id'], $_SESSION['exercice_id']);
                    $id_compte = $compte_comptable->getId();
                } else {
                    $compte_comptable = null;
                    $id_compte = null;
                }
                if ($date_valeur[$i] != '') {
                    $date_document = explode('/', $date_valeur[$i]);
                    $date_val = $date_document[2] . '-' . $date_document[1] . '-' . $date_document[0];
                } else {
                    $date_val = date('Y-m-d', strtotime($date_valeur[$i]));
                }
                if ($id_compte != null) {
                    $values = $values . "'" . $reference[$i] . "','" . $date_doc . "','" . date('Y-m-d') . "'," . $_SESSION['dossier_id'] . ",0," . $montant_ht[$i] . "," . $montant_tva[$i] . ",'" . $type[$i] . "'," . $montant_ttc[$i] . ",'" . $libelle[$i] . "'," . $id_compte . ",'" . $date_val . "'";
                    $values = $values . ')';
                } else {
                    $values = $values . "'" . $reference[$i] . "','" . $date_doc . "','" . date('Y-m-d') . "'," . $_SESSION['dossier_id'] . ",0," . $montant_ht[$i] . "," . $montant_tva[$i] . ",'" . $type[$i] . "'," . $montant_ttc[$i] . ",'" . $libelle[$i] . "'," . "NULL" . ",'" . $date_val . "'";
                    $values = $values . ')';
                }
            }
        }

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

//Insertion des Factures
        $query = "INSERT INTO reglementcomptable( numero,date, dateimportation, id_dossier, saisie,  totalht, totaltva, type, totalttc,libelle,id_comptecomptable,datevaleur)
	VALUES " . $values . ";";

        $resultat = $conn->fetchAssoc($query);

        $this->getResponse()->setContentType('text/json');

        return $this->renderText(json_encode(array(
                    "msg" => "OK"
        )));
    }

    public function executeSaveMouvementcomptable(sfWebRequest $request) {
        $params = array();
        $content = $request->getContent();
        $params = json_decode($content, true);
//        $date_valeur = $params['date_valeur'];
        $reference = $params['numero'];
        $libelle = $params['libelle'];
        $doc = $params['doc'];
        $date = $params['date'];
        $montant_ht = $params['montant_ht'];
        $type = $params['type'];
        $numero_compte = $params['numero_compte'];
        $reference = explode(';', $reference);
        $doc = explode(';', $doc);
        $date = explode(';', $date);
        $libelle = explode(';', $libelle);
        $type = explode(';', $type);
        $montant_ht = explode(';', $montant_ht);

        $numero_compte = explode(';', $numero_compte);
        $values = '';
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');
        for ($i = 0; $i <= sizeof($libelle); $i++) {

            if ($reference[$i] != '') {
                if ($values == '')
                    $values = $values . '(';
                else
                    $values = $values . ', (';

                if ($date[$i] != '') {
                    $date_document = explode('/', $date[$i]);
                    $date_doc = $date_document[2] . '-' . $date_document[1] . '-' . $date_document[0];
                } else {
                    $date_doc = date('Y-m-d', strtotime($date[$i]));
                }

                if ($numero_compte[$i] != '') {

                    $compte_comptable = PlandossiercomptableTable::getInstance()->getByNumeroAndDossierAndExercice($numero_compte[$i], $_SESSION['dossier_id'], $_SESSION['exercice_id']);
//               die(sizeof($compte_comptable).'ni');    
                    $id_compte = $compte_comptable->getFirst()->getId();
                } else {
                    $compte_comptable = null;
                    $id_compte = null;
                }

                if ($id_compte != null) {
                    $values = $values . "'" . $reference[$i] . "','" . $reference[$i] . "','" . $date_doc . "','" . date('Y-m-d') . "'," . $_SESSION['dossier_id'] . ",0," . $montant_ht[$i] . ",'" . $type[$i] . "','" . $libelle[$i] . "'," . $id_compte;
                    $values = $values . ')';
                } else {
                    $values = $values . "'" . $reference[$i] . "','" . $date_doc . "','" . date('Y-m-d') . "'," . $_SESSION['dossier_id'] . ",0," . $montant_ht[$i] . ",'" . $type[$i] . "','" . $libelle[$i] . "'," . "NULL";
                    $values = $values . ')';
                }
            }
        }

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

//Insertion des Factures
        $query = "INSERT INTO movementpiece (numero,reference,date, dateimportation, id_dossier, saisie,  montant, type, libelle,id_comptecomptable)
	VALUES " . $values . ";";

        $resultat = $conn->fetchAssoc($query);

        $this->getResponse()->setContentType('text/json');

        return $this->renderText(json_encode(array(
                    "msg" => "OK"
        )));
    }

    public function executeGetFactureAchat(sfWebRequest $request) {
        $this->date_debut = $request->getParameter('date_debut');
        $this->date_fin = $request->getParameter('date_fin');

//Documents achats à travers les documents budgets (Ordonnances de paiements)
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $query = "SELECT DISTINCT (documentachat.id) as id, documentachat.*, fournisseur.rs as rs "
                . "FROM  documentachat, documentbudget, piecejointbudget, fournisseur, mouvementbanciare "
                . "WHERE documentachat.id = piecejointbudget.id_docachat "
                . "AND piecejointbudget.id_documentbudget = documentbudget.id "
                . "AND documentachat.id_frs = fournisseur.id "
                . "AND documentachat.transfertcomptabilite = false "
                . "AND mouvementbanciare.id_documentbudget = documentbudget.id "
                . "AND mouvementbanciare.dateoperation >= '" . $this->date_debut . "' "
                . " AND mouvementbanciare.dateoperation <= '" . $this->date_fin . "' "
                . " AND documentbudget.annule = false"
                . " AND documentbudget.id_type = 2";

        $this->factures = $conn->fetchAssoc($query);

//Documents achats à travers les paiements du caisse (Ordonnances de paiements du caisse)
        $query = "SELECT DISTINCT (documentachat.id) as id, documentachat.*, fournisseur.rs as rs "
                . "FROM  documentachat, ligneoperationcaisse, fournisseur "
                . "WHERE documentachat.id = ligneoperationcaisse.id_docachat "
                . "AND documentachat.id_frs = fournisseur.id "
                . "AND documentachat.transfertcomptabilite = false "
                . "AND ligneoperationcaisse.dateoperation >= '" . $this->date_debut . "' "
                . "AND ligneoperationcaisse.dateoperation <= '" . $this->date_fin . "' ";

        $this->factures_caisses = $conn->fetchAssoc($query);
    }

    public function executeSaveFactureAchatImport(sfWebRequest $request) {
        $ids = $request->getParameter('ids');
        $ids = substr($ids, 0, -1);
        $ids = explode(',', $ids);
        $dossier = DossiercomptableTable::getInstance()->findAll()->getFirst();

        $listetva = TvaTable::getInstance()->findAll();
        $factures = DocumentachatTable::getInstance()->getByTableId($ids);
        foreach ($factures as $facture) {
            $fac_import = new Facturecomptableachat();
            $fac_import->setDate($facture->getDatecreation());
            $fac_import->setReference(trim($facture->getReference()) . ' (' . trim($facture->getNumero()) . ')');
            $fac_import->setTotalht($facture->getMht());
            $fac_import->setTotaltva($facture->getMnttva());
            $fac_import->setTotalttc($facture->getMntttc());
            $fac_import->setIdDossier($dossier->getId());
            $fac_import->setIdFacture($facture->getId());
            $fac_import->setIdFournisseur($facture->getIdFrs());
            $fac_import->setDateimportation(date('Y-m-d'));
            $fac_import->save();

//changer l'état du transfert du facture vers la comptabilité
            $facture->setTransfertcomptabilite(true);
            $facture->save();

            foreach ($listetva as $tva) {
                $basetva = 0;

                foreach ($facture->getLignedocachat() as $ligne) {
                    if ($ligne->getIdTva() != null) {
                        if ($ligne->getIdTva() == $tva->getId()) {
                            $qte = 1;
                            if ($ligne->getQtelignedoc()->count() != 0)
                                $qte = $ligne->getQtelignedoc()->getLast()->getQteaachat();
                            $basetva = $basetva + (floatval($ligne->getMntht()) * $qte);
                        }
                    }else {
                        if (intval($tva->getValeurtva()) == 0) {
                            $qte = 1;
                            if ($ligne->getQtelignedoc()->count() != 0)
                                $qte = $ligne->getQtelignedoc()->getLast()->getQteaachat();
                            $basetva = $basetva + (floatval($ligne->getMntht()) * $qte);
                        }
                    }
                }

                if ($basetva != 0) {
                    $mnttva = 0;
                    $mnttva = ($tva->getValeurtva() / 100) * $basetva;

                    $ligne_fac_import = new Lignefacturecomptableachat();
                    $ligne_fac_import->setTotalht($basetva);
                    $ligne_fac_import->setTotaltva($mnttva);
                    $ligne_fac_import->setIdTva($tva->getId());
                    $ligne_fac_import->setIdFacturecomptableachat($fac_import->getId());
                    $ligne_fac_import->save();
                }
            }
        }

        return true;
    }

    public function executeGetFactureVente(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut');
        $date_fin = $request->getParameter('date_fin');

        $this->factures = null;
    }

    public function executeSaveFactureVenteImport(sfWebRequest $request) {
        $ids = $request->getParameter('ids');
        $ids = explode(',', $ids);
        $dossier = $request->getParameter('dossier');

        $listetva = TVATable::getInstance()->findAll();
        $factures = FactureClientTable::getInstance()->getFactures($ids);
        foreach ($factures as $facture) {
            $fac_import = new FactureComptableVente();
            $fac_import->setDate($facture->getDate());
            $fac_import->setReference($facture->getReference());
            $fac_import->setTotalHt($facture->getTotalHt());
            $fac_import->setTotalTva($facture->getTotalTva());
            $fac_import->setTimbre($facture->getTimbre());
            $fac_import->setTotalTtc($facture->getTotalTtc());
            $fac_import->setTotalTtc($facture->getTotalTtc());
            $fac_import->setDossierId($dossier);
            $fac_import->setFactureId($facture->getId());
            $fac_import->setClientId($facture->getClientId());
            $fac_import->setDateImportation(date('Y-m-d'));
            $fac_import->save();

//changer l'état du transfert du facture vers la comptabilité
            $facture->setTransfertComptabilite(true);
            $facture->save();

            foreach ($listetva as $tva) {

                $basetva = 0;
                $total_base = 0;
                $total_montant_tva = 0;

                foreach ($facture->getLigneFactureClient() as $ligne) {
                    if ($ligne->getTauxTva() == $tva->getTaux()) {

                        $basetva = $basetva + $ligne->getPrixTotalTtcnet();
                        $mnttva = ($ligne->getTauxTva() / 100) * $basetva;

                        $ligne_fac_import = new LigneFactureComptableVente();
                        $ligne_fac_import->setTotalHt($basetva);
                        $ligne_fac_import->setTotalTva($mnttva);
                        $ligne_fac_import->setTvaId($tva->getId());
                        $ligne_fac_import->setFactureComptableVenteId($fac_import->getId());
                        $ligne_fac_import->setDateImportation(date('Y-m-d'));
                        $ligne_fac_import->save();
                    }
                }
            }
        }
        return true;
    }

    public function executeListAchat(sfWebRequest $request) {
        $this->reference = $request->getParameter('reference', '');
        $this->fournisseur = $request->getParameter('fournisseur', '');
        $this->pager = $this->paginateAchat($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function executeListBalance(sfWebRequest $request) {
        $exercice_id = $_SESSION['exercice_id'];

        $this->comptes = PlandossiercomptableTable::getInstance()->getBalance($_SESSION['dossier_id'], $exercice_id);
        $this->classes = ClassecompteTable::getInstance()->findAll();
    }

    public function executeListeOd(sfWebRequest $request) {
        $this->reference = $request->getParameter('reference', '');
        $this->fournisseur = $request->getParameter('fournisseur', '');
        $this->pager = $this->paginateOd($request);
        $this->page = $request->getParameter('page', 1);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_od", array("pager" => $this->pager));
        }
    }

    public function executeListeOd_1(sfWebRequest $request) {
        $this->reference = $request->getParameter('reference', '');
        $this->fournisseur = $request->getParameter('fournisseur', '');
        $this->pager = $this->paginateOd($request);
        $this->page = $request->getParameter('page', 1);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_od_1", array("pager" => $this->pager));
        }
    }

    public function executeListeOdClient(sfWebRequest $request) {
        $this->reference = $request->getParameter('reference', '');
        $this->fournisseur = $request->getParameter('fournisseur', '');
        $this->pager = $this->paginateOdClient($request);
        $this->page = $request->getParameter('page', 1);
        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_od_client", array("pager" => $this->pager));
        }
    }

    public function paginateOd(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference', '');
        $fournisseur = $request->getParameter('fournisseur', '');
        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());
        $pager = new sfDoctrinePager('Facturecomptableod', 10);
        $pager->setQuery(FacturecomptableodTable::getInstance()->load($date_debut, $date_fin, $reference, $fournisseur));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function paginateOdClient(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference', '');
        $fournisseur = $request->getParameter('fournisseur', '');
        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());
        $pager = new sfDoctrinePager('Facturecomptableodclient', 10);
        $pager->setQuery(FacturecomptableodclientTable::getInstance()->load($date_debut, $date_fin, $reference, $fournisseur));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeGoPageAchat(sfWebRequest $request) {
        $pager = $this->paginateAchat($request);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference');
        $fournisseur = $request->getParameter('fournisseur');

        return $this->renderPartial("importation/liste_achat", array("pager" => $pager, "page" => $page, "reference" => $reference, "fournisseur" => $fournisseur));
    }

    public function executeGoFichePageOd(sfWebRequest $request) {
        $pager = $this->paginateOd($request);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference');
        $fournisseur = $request->getParameter('fournisseur');

        return $this->renderPartial("importation/liste_od_partial ", array("pager" => $pager, "page" => $page, "reference" => $reference, "fournisseur" => $fournisseur));
    }

    public function paginateFinalOd(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference', '');
        $fournisseur = $request->getParameter('fournisseur', '');
        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());
        $pager = new sfDoctrinePager('Facturecomptableod', 10);
        $pager->setQuery(FacturecomptableodTable::getInstance()->load($date_debut, $date_fin, $reference, $fournisseur));
        $pager->setPage($page);
        $pager->init();
        return $pager;
    }

    public function executeGoPageOdSaisie(sfWebRequest $request) {
        $pager = $this->paginateOdSaisie($request);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference');
        $fournisseur = $request->getParameter('fournisseur');

        return $this->renderPartial("importation/liste_od_saisie", array("pager" => $pager, "page" => $page, "reference" => $reference, "fournisseur" => $fournisseur));
    }

    public function executeListAchatSaisie(sfWebRequest $request) {
        $this->reference = $request->getParameter('reference', '');
        $this->fournisseur = $request->getParameter('fournisseur', '');
        $this->pager = $this->paginateAchatSaisie($request);
        $this->page = $request->getParameter('page', 1);
//        return $this->renderPartial("importation/liste_achat_saisie", array("pager" => $pager, "page" => $page, "reference" => $reference, "fournisseur" => $fournisseur));
    }

    public function executeListOdSaisie(sfWebRequest $request) {
        $this->reference = $request->getParameter('reference', '');
        $this->fournisseur = $request->getParameter('fournisseur', '');
        $this->pager = $this->paginateOdSaisie($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function executeListOdSaisieClient(sfWebRequest $request) {
        $this->reference = $request->getParameter('reference', '');
        $this->fournisseur = $request->getParameter('fournisseur', '');
        $this->pager = $this->paginateOdClientSaisie($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function paginateOdSaisie(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);

        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('ref', '');
        $fournisseur = $request->getParameter('fournisseur', '');
        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());

        $pager = new sfDoctrinePager('Facturecomptableod', 10);
        $pager->setQuery(FacturecomptableodTable::getInstance()->loadSaisie($date_debut, $date_fin, $reference, $fournisseur));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function paginateOdClientSaisie(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('ref', '');
        $fournisseur = $request->getParameter('fournisseur', '');
        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());
        $pager = new sfDoctrinePager('Facturecomptableodclient', 10);
        $pager->setQuery(FacturecomptableodclientTable::getInstance()->loadSaisie($date_debut, $date_fin, $reference, $fournisseur));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeDetailfacture(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
    }

    public function executeGoPageAchatSaisie(sfWebRequest $request) {

        $pager = $this->paginateAchatSaisie($request);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference');
        $fournisseur = $request->getParameter('fournisseur');

        return $this->renderPartial("importation/liste_achat_saisie", array("pager" => $pager, "page" => $page, "reference" => $reference, "fournisseur" => $fournisseur));
    }

    public function executeShowAchat(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $facture = FacturecomptableachatTable::getInstance()->find($id);

        return $this->renderPartial('importation/liste_ligne_achat', array('facture' => $facture));
    }

    public function executeShowOd(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $facture = FacturecomptableodTable::getInstance()->find($id);

        return $this->renderPartial('importation/liste_ligne_od', array('facture' => $facture));
    }

    public function executeShowOdClient(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $facture = FacturecomptableodclientTable::getInstance()->find($id);

        return $this->renderPartial('importation/liste_ligne_od', array('facture' => $facture));
    }

    public function executeAnnulerAchat(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $facture = FacturecomptableachatTable::getInstance()->find($id);

        $ligne_facture = LignefacturecomptableachatTable::getInstance()->findByIdFacturecomptableachat($id);
        foreach ($ligne_facture as $lf) {
            $lf->delete();
        }

        if ($facture->getIdFacture() != null) {
//changer l'état du transfert du facture vers la comptabilité
            $facture_source = DocumentachatTable::getInstance()->find($facture->getIdFacture());
            $facture_source->setTransfertcomptabilite(false);
            $facture_source->save();
        }

        $facture->delete();

        $pager = $this->paginateAchat($request);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference');
        $fournisseur = $request->getParameter('fournisseur');

        return $this->renderPartial("importation/liste_achat", array("pager" => $pager, "page" => $page, "reference" => $reference, "fournisseur" => $fournisseur));
    }

    public function executeAnnulerOd(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $facture = FacturecomptableodTable::getInstance()->find($id);

        $ligne_facture = LignefacturecomptableodTable::getInstance()->findByIdFacturecomptableod($id);
        foreach ($ligne_facture as $lf) {
            $lf->delete();
        }
//
        if ($facture->getIdFacture() != null) {
//changer l'état du transfert du facture vers la comptabilité
            $facture_source = DocumentodTable::getInstance()->find($facture->getIdFacture());
//            $facture_source->setTransfertcomptabilite(false);
            $facture_source->save();
        }
//
        $facture->delete();
//
        $pager = $this->paginateOd($request);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference');
        $fournisseur = $request->getParameter('fournisseur');

        return $this->renderPartial("importation/liste_od", array("pager" => $pager, "page" => $page, "reference" => $reference, "fournisseur" => $fournisseur));
    }

    public function executeAnnulerOdClient(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $facture = FacturecomptableodclientTable::getInstance()->find($id);

//        $ligne_facture = LignefacturecomptableodTable::getInstance()->findByIdFacturecomptableod($id);
//        foreach ($ligne_facture as $lf) {
//            $lf->delete();
//        }
//
        if ($facture->getIdFacture() != null) {
//changer l'état du transfert du facture vers la comptabilité
            $facture_source = DocumentodTable::getInstance()->find($facture->getIdFacture());
//            $facture_source->setTransfertcomptabilite(false);
            $facture_source->save();
        }
//
        $facture->delete();
//
        $pager = $this->paginateOdClient($request);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference');
        $fournisseur = $request->getParameter('fournisseur');

        return $this->renderPartial("importation/liste_od_client", array("pager" => $pager, "page" => $page, "reference" => $reference, "fournisseur" => $fournisseur));
    }

    public function paginateAchat(sfWebRequest $request) {


        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference', '');
        $fournisseur = $request->getParameter('fournisseur', '');
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());

        $pager = new sfDoctrinePager('Facturecomptableachat', 10);
        $pager->setQuery(FacturecomptableachatTable::getInstance()->load($date_debut, $date_fin, $reference, $fournisseur));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function paginateAchatSaisie(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);

        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference', '');
        $fournisseur = $request->getParameter('fournisseur', '');
        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());

        $pager = new sfDoctrinePager('FacturecomptableachatSaisie', 10);
        $pager->setQuery(FacturecomptableachatTable::getInstance()->loadSaisie($date_debut, $date_fin, $reference, $fournisseur, ''));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

//public function paginatePiecesaisie(sfWebRequest $request) {
//        $page = $request->getParameter('page', 1);
//        $journal = strtoupper($request->getParameter('journal', ''));
//        $num = $request->getParameter('num', '');
//        $date_debut = $request->getParameter('date_debut', '');
//        $date_fin = $request->getParameter('date_fin', '');
//
//        $num_debut = $request->getParameter('num_debut', '');
//        $num_fin = $request->getParameter('num_fin', '');
//        $type_tri = $request->getParameter('type_tri', '');
//        $tri = $request->getParameter('tri', '');
//
//        $exercice_id = $_SESSION['exercice_id'];
//
//        $pager = new sfDoctrinePager('PieceComptable', 10);
//        $pager->setQuery(PiececomptableTable::getInstance()->loadAllFiltre($journal, $num, $date_debut, $date_fin, $num_debut, $num_fin, $type_tri, $tri, '', $exercice_id));
//        $pager->setPage($page);
//        $pager->init();
//
//        return $pager;
//    }

    public function executeListVente(sfWebRequest $request) {
        $this->reference = $request->getParameter('reference', '');
        $this->client = $request->getParameter('client', '');
        $this->pager = $this->paginateVente($request);
        $this->page = $request->getParameter('page', 1);
    }

    /*     * ***tresorerie* */

    public function executeListTresorerie(sfWebRequest $request) {
        $this->reference = $request->getParameter('numero', '');
        $this->libelle = $request->getParameter('libelle', '');
        $this->type = $request->getParameter('type', '');
        $this->pager = $this->paginateTresorerie($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function executeListTresorerieSaisie(sfWebRequest $request) {
        $this->reference = $request->getParameter('numero', '');
        $this->libelle = $request->getParameter('libelle', '');
        $this->type = $request->getParameter('type', '');
        $this->pager = $this->paginateTresorerieSaisie($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function executeListMouvement(sfWebRequest $request) {
        $this->reference = $request->getParameter('numero', '');
        $this->libelle = $request->getParameter('libelle', '');
        $this->type = $request->getParameter('type', '');
        $this->pager = $this->paginateMouement($request);
        $this->page = $request->getParameter('page', 1);
        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste_mouvement", array("pager" => $this->pager));
        }
    }

    public function paginateMouement(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);

        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('numero', '');
        $libelle = $request->getParameter('libelle', '');
        $type = $request->getParameter('type', '');

        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());

        $pager = new sfDoctrinePager('Movementpiece', 10);
        $pager->setQuery(MovementpieceTable::getInstance()->load($date_debut, $date_fin, $reference, $libelle, $type));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeListMouvementSaisie(sfWebRequest $request) {
        $this->reference = $request->getParameter('numero', '');
        $this->libelle = $request->getParameter('libelle', '');
        $this->type = $request->getParameter('type', '');
        $this->pager = $this->paginateMouvementSaisie($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function paginateMouvementSaisie(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $ref = $request->getParameter('numero', '');
        $libelle = $request->getParameter('libelle', '');
        $type = $request->getParameter('type', '');
        $dossier = $request->getParameter('dossier', '');
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);

        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());

        $pager = new sfDoctrinePager('Movementpiece', 10);
        $pager->setQuery(MovementpieceTable::getInstance()->loadSaisie($date_debut, $date_fin, $ref, $libelle, $type));
        $pager->setPage($page);
        $pager->init();
        return $pager;
    }

    public function paginateTresorerieSaisie(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $ref = $request->getParameter('numero', '');
        $libelle = $request->getParameter('libelle', '');
        $type = $request->getParameter('type', '');
        $dossier = $request->getParameter('dossier', '');
        $banque = $request->getParameter('banque', '');
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);

        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());

        $pager = new sfDoctrinePager('Reglementcomptable', 10);
        $pager->setQuery(ReglementcomptableTable::getInstance()->loadSaisie($date_debut, $date_fin, $ref, $libelle, $type, $banque));
        $pager->setPage($page);
        $pager->init();
        return $pager;
    }

    public function paginateTresorerie(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);

        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('numero', '');
        $libelle = $request->getParameter('libelle', '');
        $type = $request->getParameter('type', '');
        $banque = $request->getParameter('banque', '');
        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());

        $pager = new sfDoctrinePager('Reglementcomptable', 10);
        $pager->setQuery(ReglementcomptableTable::getInstance()->load($date_debut, $date_fin, $reference, $libelle, $type, $banque));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    /*     * ***** */

    public function executeGoPageVente(sfWebRequest $request) {
        $reference = $request->getParameter('reference', '');
        $client = $request->getParameter('client', '');
        $codeclient = $request->getParameter('codeclient', '');
        $pager = $this->paginateVente($request);
        $page = $request->getParameter('page', 1);

        return $this->renderPartial("importation/liste_vente", array("pager" => $pager, "page" => $page, "reference" => $reference, "client" => $client, " codeclient" => $codeclient));
    }

    public function executeGoPageReglement(sfWebRequest $request) {
        $libelle = $request->getParameter('libelle', '');
        $reference = $request->getParameter('numero', '');
        $type = $request->getParameter('type', '');
        $banque = $request->getParameter('banque', '');
        $pager = $this->paginateTresorerie($request);
        $page = $request->getParameter('page', 1);

        return $this->renderPartial("importation/liste_tresorerie", array("pager" => $pager, "page" => $page, "reference" => $reference, "type" => $type, " libelle" => $libelle, " banque" => $banque));
    }

    public function executeGoPageMouement(sfWebRequest $request) {
        $libelle = $request->getParameter('libelle', '');
        $reference = $request->getParameter('numero', '');
        $type = $request->getParameter('type', '');
        $pager = $this->paginateTresorerie($request);
        $page = $request->getParameter('page', 1);

        return $this->renderPartial("importation/liste_mouvement", array("pager" => $pager, "page" => $page, "reference" => $reference, "type" => $type, " libelle" => $libelle));
    }

    public function executeGoPageReglementSaisie(sfWebRequest $request) {
        $libelle = $request->getParameter('libelle', '');
        $reference = $request->getParameter('numero', '');
        $type = $request->getParameter('type', '');
        $banque = $request->getParameter('banque', '');
        $pager = $this->paginateTresorerieSaisie($request);
        $page = $request->getParameter('page', 1);

        return $this->renderPartial("importation/liste_tresorerie_saisie", array("pager" => $pager, "page" => $page, "reference" => $reference, "type" => $type, " libelle" => $libelle, " banque" => $banque));
    }

    public function executeGoPageMouvementSaisie(sfWebRequest $request) {
        $libelle = $request->getParameter('libelle', '');
        $reference = $request->getParameter('numero', '');
        $type = $request->getParameter('type', '');
        $pager = $this->paginateMouvementSaisie($request);
        $page = $request->getParameter('page', 1);

        return $this->renderPartial("importation/liste_mouvement_saisie", array("pager" => $pager, "page" => $page, "reference" => $reference, "type" => $type, " libelle" => $libelle));
    }

    public function executeListVenteSaisie(sfWebRequest $request) {
        $this->reference = $request->getParameter('reference', '');
        $this->client = $request->getParameter('client', '');
        $this->pager = $this->paginateVenteSaisie($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function executeGoPageVenteSaisie(sfWebRequest $request) {
        $reference = $request->getParameter('reference', '');
        $this->reference = $reference;
        $client = $request->getParameter('client', '');
        $this->client = $client;
        $pager = $this->paginateVenteSaisie($request);
        $this->pager = $pager;
        $page = $request->getParameter('page', 1);
        $this->page = $page;
        return $this->renderPartial("importation/liste_vente_saisie", array("pager" => $pager, "page" => $page, "reference" => $reference, "client" => $client));
    }

    public function executeShowVente(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $facture = FacturcomptableventeTable::getInstance()->find($id);
        return $this->renderPartial('importation/liste_ligne_vente', array('facture' => $facture));
    }

    public function executeAnnulerVente(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $facture = FacturecomptableventeTable::getInstance()->find($id);

        $ligne_facture = LignefacturecomptableventeTable::getInstance()->findByIdFacturecomptablevente($id);
        foreach ($ligne_facture as $lf) {
            $lf->delete();
        }

        if ($facture->getIdFacture() != null) {
//changer l'état du transfert du facture vers la comptabilité
            $facture_source = DocumentachatTable::getInstance()->find($facture->getIdFacture());
            $facture_source->setTransfertcomptabilite(false);
            $facture_source->save();
        }

        $facture->delete();

        $pager = $this->paginateVente($request);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference');
        $client = $request->getParameter('client');

        return $this->renderPartial("importation/liste_vente", array("pager" => $pager, "page" => $page, "reference" => $reference, "client" => $client));
    }

    public function paginateVente(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);

        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference', '');
        $client = $request->getParameter('client', '');
        $codeclient = $request->getParameter('codeclient', '');
        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());

        $pager = new sfDoctrinePager('Facturecomptablevente', 10);
        $pager->setQuery(FacturecomptableventeTable::getInstance()->load($date_debut, $date_fin, $reference, $client, $codeclient));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function paginateVenteSaisie(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $ref = $request->getParameter('ref', '');
        $dossier = $request->getParameter('dossier', '');
        $client = $request->getParameter('client', '');

        $pager = new sfDoctrinePager('Facturecomptableventevaisie', 10);
        $pager->setQuery(FacturecomptableventeTable::getInstance()->loadSaisie($ref, $dossier, $client, ''));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeAchatAnnulation(sfWebRequest $request) {
        $this->dossiers = DossierComptableTable::getInstance()->findAll();
    }

    public function executeImportAnnulation(sfWebRequest $request) {
        $this->dossiers = DossiercomptableTable::getInstance()->findAll();
    }

    public function executeGetFactureAchatImportForAnnuler(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut');
        $date_fin = $request->getParameter('date_fin');

        $this->factures = FacturecomptableachatTable::getInstance()->findByPeriode($date_debut, $date_fin);
    }

    public function executeGetFactureAchatAnnuler(sfWebRequest $request) {
        $this->ids = $request->getParameter('ids');
        $ids = explode(',', $this->ids);

        $this->factures = FacturecomptableachatTable::getInstance()->getByIds($ids);
    }

    public function executeVenteAnnulation(sfWebRequest $request) {
        $this->dossiers = DossierComptableTable::getInstance()->findAll();
    }

    public function executeGetFactureVenteImportForAnnuler(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut');
        $date_fin = $request->getParameter('date_fin');

        $this->factures = FacturecomptableventeTable::getInstance()->findByPeriode($date_debut, $date_fin);
    }

    public function executeGetFactureVenteAnnuler(sfWebRequest $request) {
        $this->ids = $request->getParameter('ids');
        $ids = explode(',', $this->ids);

        $this->factures = FacturecomptableventeTable::getInstance()->getByIds($ids);
    }

    public function executeSaisirFactureVente(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $journal_id = $request->getParameter('journal_id');
        $date = $request->getParameter('date');
        $total_credit = $request->getParameter('total_credit', '');
        $total_debit = $request->getParameter('total_debit', '');

        $facture = FacturecomptableventeTable::getInstance()->find($id);
        $exercice_id = $_SESSION['exercice_id'];
        $user = $this->getUser()->getAttribute('userB2m');

        $piece_vente = new Piececomptable();

        $piece_vente->setDate($date);
        $piece_vente->setDatecreation(date('Y-m-d'));
        $piece_vente->setIdUser($user->getId());
        if ($total_credit != '')
            $piece_vente->setTotalcredit($total_credit);
        else
            $piece_vente->setTotalcredit($facture->getTotalttc());

        if ($total_debit != '')
            $piece_vente->setTotaldebit($total_debit);
        else
            $piece_vente->setTotaldebit($facture->getTotalttc());
        $piece_vente->setLibelle($facture->getReference());
        $piece_vente->setIdJournalcomptable($journal_id);
        $piece_vente->setIdExercice($exercice_id);

        $tab = $this->getSerieJournal($journal_id, $facture->getDate());

        $piece_vente->setNumero($tab['numero']);
        $piece_vente->setIdSerie($tab['serie_id']);

        $piece_vente->save();
        $this->updateAttenduLastNumber($tab['serie_id'], $tab['numero']);

        $id_compte = $request->getParameter('id_compte');
        $debit = $request->getParameter('debit');
        $credit = $request->getParameter('credit');
        $id_contre = $request->getParameter('id_contre');

        $id_compte = explode(',', $id_compte);
        $debit = explode(';', $debit);
        $credit = explode(';', $credit);
        $id_contre = explode(',', $id_contre);

        for ($i = 0; $i < sizeof($id_compte); $i++):
            if ($id_compte[$i] != ''):
                $ligne_vente = new Lignepiececomptable();

                $ligne_vente->setIdFacturevente($facture->getId());
                $ligne_vente->setReference($facture->getReference());
                $ligne_vente->setDate($date);
                if ($credit[$i] != '')
                    $ligne_vente->setMontantcredit($credit[$i]);
                if ($debit[$i] != '')
                    $ligne_vente->setMontantdebit($debit[$i]);
                $ligne_vente->setIdPiececomptable($piece_vente->getId());
                $ligne_vente->setIdComptecomptable($id_compte[$i]);
                $ligne_vente->setIdContrepartie($id_contre[$i]);
//7 => FACTURE
                $ligne_vente->setIdNaturepiece(7);
                $ligne_vente->setNumeroexterne($facture->getReference());

                $ligne_vente->save();
            endif;
        endfor;

        $facture->setSaisie(1);
        $facture->setIdPiececomptable($piece_vente->getId());
        $facture->save();

        $this->refrence = $request->getParameter('refrence', '');
        $this->client = $request->getParameter('client', '');
        $this->pager = $this->paginateVente($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function executeSaisirFactureTresorerie(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $journal_id = $request->getParameter('journal_id');
        $numero_externe = $request->getParameter('numero_externe');
        $date = $request->getParameter('date');
        $total_credit = $request->getParameter('total_credit', '');
        $total_debit = $request->getParameter('total_debit', '');
//        die($numero_externe);
        $facture = ReglementcomptableTable::getInstance()->find($id);
        $exercice_id = $_SESSION['exercice_id'];
//        $user =  $this->getUser()->getAttribute('userB2m');
        $user = $this->getUser()->getAttribute('userB2m');
        $piece_tresorerie = new Piececomptable();

        $piece_tresorerie->setDate($date);
        $piece_tresorerie->setDatecreation(date('Y-m-d'));
        $piece_tresorerie->setIdUser($user->getId());
        if ($total_credit != '')
            $piece_tresorerie->setTotalcredit($total_credit);
        else
            $piece_tresorerie->setTotalcredit($facture->getTotalttc());

        if ($total_debit != '')
            $piece_tresorerie->setTotaldebit($total_debit);
        else
            $piece_tresorerie->setTotaldebit($facture->getTotalttc());
        $piece_tresorerie->setLibelle('Règlement N°' . $facture->getNumero());
        $piece_tresorerie->setIdJournalcomptable($journal_id);
        $piece_tresorerie->setIdExercice($exercice_id);

        $tab = $this->getSerieJournal($journal_id, $facture->getDate());

        $piece_tresorerie->setNumero($tab['numero']);
        $piece_tresorerie->setIdSerie($tab['serie_id']);

        $piece_tresorerie->save();
        $this->updateAttenduLastNumber($tab['serie_id'], $tab['numero']);

        $id_compte = $request->getParameter('id_compte');
        $debit = $request->getParameter('debit');
        $credit = $request->getParameter('credit');
        $id_contre = $request->getParameter('id_contre');

        $id_compte = explode(',', $id_compte);
        $debit = explode(';', $debit);
        $credit = explode(';', $credit);
        $id_contre = explode(',', $id_contre);

        for ($i = 0; $i < sizeof($id_compte); $i++):
            if ($id_compte[$i] != '' && $id_compte[$i] != 'undefined'):
                if ($debit[$i] == 'undefined')
                    $debit[$i] = 0;
                if ($credit[$i] == 'undefined')
                    $credit[$i] = 0;
                $ligne_vente = new Lignepiececomptable();
                if ($numero_externe)
                    $ligne_vente->setNumeroexterne($numero_externe);
                $ligne_vente->setIdRegelment($facture->getId());
                $ligne_vente->setReference($facture->getNumero());
                $ligne_vente->setDate($date);
                if ($credit[$i] != '' && $credit[$i] != 'undefined')
                    $ligne_vente->setMontantcredit($credit[$i]);
                if ($debit[$i] != '' && $debit[$i] != 'undefined')
                    $ligne_vente->setMontantdebit($debit[$i]);
                $ligne_vente->setIdPiececomptable($piece_tresorerie->getId());

                $ligne_vente->setIdComptecomptable($id_compte[$i]);
//                $ligne_vente->setIdContrepartie($id_contre[$i]);
//7 => FACTURE
                $ligne_vente->setIdNaturepiece(11);


                $ligne_vente->save();
            endif;
        endfor;
//die($piece_tresorerie->getId().'mp');
        $facture->setSaisie(1);
        $facture->setIdPiececomptable($piece_tresorerie->getId());
        $facture->save();

        $refrence = $request->getParameter('numero', '');
//        $this->client = $request->getParameter('client', '');
        $pager = $this->paginateTresorerie($request);
        $page = $request->getParameter('page', 1);
        return $this->renderPartial("importation/liste_tresorerie", array("pager" => $pager, "page" => $page, "reference" => $refrence));
    }

    public function executeSaisirFactureMouvement(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $journal_id = $request->getParameter('journal_id');
        $date = $request->getParameter('date');
        $numero_externe = $request->getParameter('numero_externe');
        $total_credit = $request->getParameter('total_credit', '');
        $total_debit = $request->getParameter('total_debit', '');

        $facture = MovementpieceTable::getInstance()->find($id);
        $exercice_id = $_SESSION['exercice_id'];
        $user = $this->getUser()->getAttribute('userB2m');

        $piece_tresorerie = new Piececomptable();

        $piece_tresorerie->setDate($date);
        $piece_tresorerie->setDatecreation(date('Y-m-d'));
        $piece_tresorerie->setIdUser($user->getId());
        if ($total_credit != '')
            $piece_tresorerie->setTotalcredit($total_credit);
        else
            $piece_tresorerie->setTotalcredit($facture->getMontant());

        if ($total_debit != '')
            $piece_tresorerie->setTotaldebit($total_debit);
        else
            $piece_tresorerie->setTotaldebit($facture->getMontant());
        $piece_tresorerie->setLibelle('Mouvement Pièce N°' . $facture->getNumero());
        $piece_tresorerie->setIdJournalcomptable($journal_id);
        $piece_tresorerie->setIdExercice($exercice_id);

        $tab = $this->getSerieJournal($journal_id, $facture->getDate());

        $piece_tresorerie->setNumero($tab['numero']);
        $piece_tresorerie->setIdSerie($tab['serie_id']);

        $piece_tresorerie->save();
        $this->updateAttenduLastNumber($tab['serie_id'], $tab['numero']);

        $id_compte = $request->getParameter('id_compte');
        $debit = $request->getParameter('debit');
        $credit = $request->getParameter('credit');
        $id_contre = $request->getParameter('id_contre');

        $id_compte = explode(',', $id_compte);
        $debit = explode(';', $debit);
        $credit = explode(';', $credit);
        $id_contre = explode(',', $id_contre);

        for ($i = 0; $i < sizeof($id_compte); $i++):
            if ($id_compte[$i] != ''):
                if ($debit[$i] == 'undefined')
                    $debit[$i] = 0;
                if ($credit[$i] == 'undefined')
                    $credit[$i] = 0;
                $ligne_vente = new Lignepiececomptable();
                $ligne_vente->setIdMouvement($facture->getId());
                $ligne_vente->setReference($facture->getNumero());
                $ligne_vente->setDate($date);
                if ($credit[$i] != '' && $credit[$i] != 'undefined')
                    $ligne_vente->setMontantcredit($credit[$i]);
                if ($debit[$i] != '' && $debit[$i] != 'undefined')
                    $ligne_vente->setMontantdebit($debit[$i]);
                $ligne_vente->setIdPiececomptable($piece_tresorerie->getId());

                $ligne_vente->setIdComptecomptable($id_compte[$i]);
//                $ligne_vente->setIdContrepartie($id_contre[$i]);
//7 => FACTURE
                $ligne_vente->setIdNaturepiece(11);
//                $ligne_vente->setNumeroexterne($facture->getNumero());
                if ($numero_externe)
                    $ligne_vente->setNumeroexterne($numero_externe);

                $ligne_vente->save();
            endif;
        endfor;
//die($piece_tresorerie->getId().'mp');
        $facture->setSaisie(1);
        $facture->setIdPiececomptable($piece_tresorerie->getId());
        $facture->save();

        $refrence = $request->getParameter('numero', '');
//        $this->client = $request->getParameter('client', '');
        $pager = $this->paginateMouement($request);
        $page = $request->getParameter('page', 1);
        return $this->renderPartial("importation/liste_mouvement", array("pager" => $pager, "page" => $page, "reference" => $refrence));
    }

    public function executeSaisirFactureOd(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $journal_id = $request->getParameter('journal_id');
        $date = $request->getParameter('date');
        $total_credit = $request->getParameter('total_credit', '');
        $total_debit = $request->getParameter('total_debit', '');

        $facture = FacturecomptableodTable::getInstance()->find($id);
        $exercice_id = $_SESSION['exercice_id'];
        $user = $this->getUser()->getAttribute('userB2m');

        $piece_achat = new Piececomptable();

        $piece_achat->setDate($date);
        $piece_achat->setDatecreation(date('Y-m-d'));
        $piece_achat->setIdUser($user->getId());
        if ($total_credit != '')
            $piece_achat->setTotalcredit($total_credit);
        else
            $piece_achat->setTotalcredit($facture->getTimbre());

        if ($total_debit != '')
            $piece_achat->setTotaldebit($total_debit);
        else
            $piece_achat->setTotaldebit($facture->getTimbre());
        $piece_achat->setLibelle($facture->getReference());
        $piece_achat->setIdJournalcomptable($journal_id);
        $piece_achat->setIdExercice($exercice_id);

        $tab = $this->getSerieJournal($journal_id, $facture->getDate());

        $piece_achat->setNumero($tab['numero']);
        $piece_achat->setIdSerie($tab['serie_id']);

        $piece_achat->save();

        $this->updateAttenduLastNumber($tab['serie_id'], $tab['numero']);

        $id_compte = $request->getParameter('id_compte');
        $debit = $request->getParameter('debit');
        $credit = $request->getParameter('credit');
        $id_contre = $request->getParameter('id_contre');

        $id_compte = explode(',', $id_compte);
        $debit = explode(';', $debit);
        $credit = explode(';', $credit);
        $id_contre = explode(',', $id_contre);

        for ($i = 0; $i < sizeof($id_compte); $i++):
            if ($debit[$i] == 'undefined')
                $debit[$i] = 0;
            if ($credit[$i] == 'undefined')
                $credit[$i] = 0;

            if ($id_compte[$i] != '' && $id_compte[$i] != 'undefined'):
                $ligne_achat = new Lignepiececomptable();

                $ligne_achat->setIdFactureod($facture->getId());
                $ligne_achat->setReference($facture->getReference());
                $ligne_achat->setDate($date);
                if ($credit[$i] != '')
                    $ligne_achat->setMontantcredit($credit[$i]);
                if ($debit[$i] != '')
                    $ligne_achat->setMontantdebit($debit[$i]);
                $ligne_achat->setIdPiececomptable($piece_achat->getId());

                if ($id_compte[$i] != '')
                    $ligne_achat->setIdComptecomptable($id_compte[$i]);
                if ($id_contre[$i] != '')
                    $ligne_achat->setIdContrepartie($id_contre[$i]);
//7 => FACTURE
                $ligne_achat->setIdNaturepiece(7);
                $ligne_achat->setNumeroexterne($facture->getReference());

                $ligne_achat->save();
//                die($ligne_achat->getId().'pm'.$id_compte[$i] );
            endif;
        endfor;

        $facture->setSaisie(1);
        $facture->setIdPiececomptable($piece_achat->getId());
        $facture->save();

        $pager = $this->paginateOd($request);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference');
//        $fournisseur = $request->getParameter('fournisseur');

        return $this->renderPartial("importation/liste_od", array("pager" => $pager, "page" => $page, "reference" => $reference));
    }

    public function executeSaisirFactureOd_1(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $journal_id = $request->getParameter('journal_id');
        $date = $request->getParameter('date');
        $numero_externe = $request->getParameter('numero_externe');
        $total_credit = $request->getParameter('total_credit', '');
        $total_debit = $request->getParameter('total_debit', '');
        $facture = FacturecomptableodTable::getInstance()->find($id);
        $exercice_id = $_SESSION['exercice_id'];
        $user = $this->getUser()->getAttribute('userB2m');
        $piece_achat = new Piececomptable();
        $piece_achat->setDate($date);
        $piece_achat->setDatecreation(date('Y-m-d'));
        $piece_achat->setIdUser($user->getId());
        if ($total_credit != '')
            $piece_achat->setTotalcredit($total_credit);
        else
            $piece_achat->setTotalcredit($facture->getTimbre());

        if ($total_debit != '')
            $piece_achat->setTotaldebit($total_debit);
        else
            $piece_achat->setTotaldebit($facture->getTimbre());
        $piece_achat->setLibelle($facture->getReference());
        $piece_achat->setIdJournalcomptable($journal_id);
        $piece_achat->setIdExercice($exercice_id);

        $tab = $this->getSerieJournal($journal_id, $facture->getDate());

        $piece_achat->setNumero($tab['numero']);
        $piece_achat->setIdSerie($tab['serie_id']);

        $piece_achat->save();

        $this->updateAttenduLastNumber($tab['serie_id'], $tab['numero']);

        $id_compte = $request->getParameter('id_compte');
        $debit = $request->getParameter('debit');
        $credit = $request->getParameter('credit');
        $id_contre = $request->getParameter('id_contre');

        $id_compte = explode(',', $id_compte);
        $debit = explode(';', $debit);
        $credit = explode(';', $credit);
        $id_contre = explode(',', $id_contre);
        for ($i = 0; $i < sizeof($id_compte); $i++):
            if ($debit[$i] == 'undefined')
                $debit[$i] = 0;
            if ($credit[$i] == 'undefined')
                $credit[$i] = 0;
            if ($id_compte[$i] != '' && $id_compte[$i] != 'undefined'):
                $ligne_achat = new Lignepiececomptable();
                $ligne_achat->setIdFactureod($facture->getId());
                $ligne_achat->setReference($facture->getReference());
                $ligne_achat->setDate($date);
                if ($credit[$i] != '')
                    $ligne_achat->setMontantcredit($credit[$i]);
                if ($debit[$i] != '')
                    $ligne_achat->setMontantdebit($debit[$i]);
                $ligne_achat->setIdPiececomptable($piece_achat->getId());
                if ($id_compte[$i] != '')
                    $ligne_achat->setIdComptecomptable($id_compte[$i]);
                if ($id_contre[$i] != '')
                    $ligne_achat->setIdContrepartie($id_contre[$i]);
//7 => FACTURE
                $ligne_achat->setIdNaturepiece(7);
//                $ligne_achat->setNumeroexterne($facture->getReference());
                if ($numero_externe)
                    $ligne_achat->setNumeroexterne($numero_externe);
                $ligne_achat->save();
//                die($ligne_achat->getId().'pm'.$id_compte[$i] );
            endif;
        endfor;

        $facture->setSaisie(1);
        $facture->setIdPiececomptable($piece_achat->getId());
        $facture->save();

        $pager = $this->paginateOd($request);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference');
//        $fournisseur = $request->getParameter('fournisseur');

        return $this->renderPartial("importation/liste_od_1", array("pager" => $pager, "page" => $page, "reference" => $reference));
    }

    public function executeSaisirFactureOdClient(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $journal_id = $request->getParameter('journal_id');
        $date = $request->getParameter('date');
        $total_credit = $request->getParameter('total_credit', '');
        $total_debit = $request->getParameter('total_debit', '');

        $facture = FacturecomptableodclientTable::getInstance()->find($id);
        $exercice_id = $_SESSION['exercice_id'];
        $user = $this->getUser()->getAttribute('userB2m');

        $piece_achat = new Piececomptable();

        $piece_achat->setDate($date);
        $piece_achat->setDatecreation(date('Y-m-d'));
        $piece_achat->setIdUser($user->getId());
        if ($total_credit != '')
            $piece_achat->setTotalcredit($total_credit);
        else
            $piece_achat->setTotalcredit($facture->getTimbre());

        if ($total_debit != '')
            $piece_achat->setTotaldebit($total_debit);
        else
            $piece_achat->setTotaldebit($facture->getTimbre());
        $piece_achat->setLibelle($facture->getReference());
        $piece_achat->setIdJournalcomptable($journal_id);
        $piece_achat->setIdExercice($exercice_id);

        $tab = $this->getSerieJournal($journal_id, $facture->getDate());

        $piece_achat->setNumero($tab['numero']);
        $piece_achat->setIdSerie($tab['serie_id']);

        $piece_achat->save();

        $this->updateAttenduLastNumber($tab['serie_id'], $tab['numero']);

        $id_compte = $request->getParameter('id_compte');
        $debit = $request->getParameter('debit');
        $credit = $request->getParameter('credit');
        $id_contre = $request->getParameter('id_contre');

        $id_compte = explode(',', $id_compte);
        $debit = explode(';', $debit);
        $credit = explode(';', $credit);
        $id_contre = explode(',', $id_contre);

        for ($i = 0; $i < sizeof($id_compte); $i++):
            if ($id_compte[$i] != ''):
                $ligne_achat = new Lignepiececomptable();

                $ligne_achat->setIdFactureodclient($facture->getId());
                $ligne_achat->setReference($facture->getReference());
                $ligne_achat->setDate($date);
                if ($credit[$i] != '')
                    $ligne_achat->setMontantcredit($credit[$i]);
                if ($debit[$i] != '')
                    $ligne_achat->setMontantdebit($debit[$i]);
                $ligne_achat->setIdPiececomptable($piece_achat->getId());

                if ($id_compte[$i] != '')
                    $ligne_achat->setIdComptecomptable($id_compte[$i]);
                if ($id_contre[$i] != '')
                    $ligne_achat->setIdContrepartie($id_contre[$i]);
//7 => FACTURE
                $ligne_achat->setIdNaturepiece(7);
                $ligne_achat->setNumeroexterne($facture->getReference());

                $ligne_achat->save();
//                die($ligne_achat->getId().'pm'.$id_compte[$i] );
            endif;
        endfor;

        $facture->setSaisie(1);
        $facture->setIdPiececomptable($piece_achat->getId());
        $facture->save();

        $pager = $this->paginateOdClient($request);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference');
//        $fournisseur = $request->getParameter('fournisseur');

        return $this->renderPartial("importation/liste_od_client", array("pager" => $pager, "page" => $page, "reference" => $reference));
    }

    public function executePreparationSaisirFactureAchat(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->facture = FacturecomptableachatTable::getInstance()->find($id);
        $this->dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];

        $this->journaux = JournalcomptableTable::getInstance()->findByLibelleTypeAndIdDossierAndIdExercice('ACHATS', $dossier_id, $exercice_id);
    }

     public function executePreparationSaisirFactureAchatBDCReg(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->facture = FacturecomptableachatTable::getInstance()->find($id);
        $this->dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];

        $this->journaux = JournalcomptableTable::getInstance()->findByLibelleTypeAndIdDossierAndIdExercice('ACHATS', $dossier_id, $exercice_id);
    }
    public function executePreparationSaisirFactureOd(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->facture = FacturecomptableodTable::getInstance()->find($id);
        $this->dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];

        $this->journaux = JournalcomptableTable::getInstance()->findByLibelleTypeAndIdDossierAndIdExercice('OD', $dossier_id, $exercice_id);
    }

     public function executePreparationSaisirFactureOdBDCRegroupe(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->facture = FacturecomptableodTable::getInstance()->find($id);
        $this->dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];

        $this->journaux = JournalcomptableTable::getInstance()->findByLibelleTypeAndIdDossierAndIdExercice('OD', $dossier_id, $exercice_id);
    }
    public function executePreparationSaisirFactureOdClient(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->facture = FacturecomptableodclientTable::getInstance()->find($id);
        $this->dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];

        $this->journaux = JournalcomptableTable::getInstance()->findByLibelleTypeAndIdDossierAndIdExercice('OD', $dossier_id, $exercice_id);
    }

    public function executeSaisirFactureAchat(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $journal_id = $request->getParameter('journal_id');
        $date = $request->getParameter('date');
        $total_credit = $request->getParameter('total_credit', '');
        $total_debit = $request->getParameter('total_debit', '');
        $numero_externe = $request->getParameter('numero_externe');

        $facture = FacturecomptableachatTable::getInstance()->find($id);
        $exercice_id = $_SESSION['exercice_id'];
        $user = $this->getUser()->getAttribute('userB2m');

        $piece_achat = new Piececomptable();

        $piece_achat->setDate($date);
        $piece_achat->setDatecreation(date('Y-m-d'));
        $piece_achat->setIdUser($user->getId());
        if ($total_credit != '')
            $piece_achat->setTotalcredit($total_credit);
        else
            $piece_achat->setTotalcredit($facture->getTotalttc());

        if ($total_debit != '')
            $piece_achat->setTotaldebit($total_debit);
        else
            $piece_achat->setTotaldebit($facture->getTotalttc());
        $piece_achat->setLibelle($facture->getReference());
        $piece_achat->setIdJournalcomptable($journal_id);
        $piece_achat->setIdExercice($exercice_id);

        $tab = $this->getSerieJournal($journal_id, $facture->getDate());

        $piece_achat->setNumero($tab['numero']);
        $piece_achat->setIdSerie($tab['serie_id']);

        $piece_achat->save();

        $this->updateAttenduLastNumber($tab['serie_id'], $tab['numero']);

        $id_compte = $request->getParameter('id_compte');
        $debit = $request->getParameter('debit');
        $credit = $request->getParameter('credit');
        $id_contre = $request->getParameter('id_contre');

        $id_compte = explode(',', $id_compte);
        $debit = explode(';', $debit);
        $credit = explode(';', $credit);
        $id_contre = explode(',', $id_contre);
//die(sizeof($id_compte).'size');
        for ($i = 0; $i < sizeof($id_compte); $i++):
//            die($id_compte[$i].'--');
            if ($id_compte[$i] != ''):
                $ligne_achat = new Lignepiececomptable();
                if ($numero_externe)
                    $ligne_achat->setNumeroexterne($numero_externe);
                $ligne_achat->setIdFactureachat($facture->getId());
                $ligne_achat->setReference($facture->getReference());
                $ligne_achat->setDate($date);
                if ($credit[$i] != '' && $credit[$i] != 'undefined')
                    $ligne_achat->setMontantcredit($credit[$i]);
                if ($debit[$i] != '' && $debit[$i] != 'undefined')
                    $ligne_achat->setMontantdebit($debit[$i]);
                $ligne_achat->setIdPiececomptable($piece_achat->getId());
                if ($id_compte[$i] != '' && $id_compte[$i] != 'undefined')
                    $ligne_achat->setIdComptecomptable($id_compte[$i]);
                if ($id_contre[$i] != '' && $id_contre[$i] != 'undefined')
                    $ligne_achat->setIdContrepartie($id_contre[$i]);
//7 => FACTURE
                $ligne_achat->setIdNaturepiece(7);
//                $ligne_achat->setNumeroexterne($facture->getReference());

                $ligne_achat->save();
            endif;
        endfor;

        $facture->setSaisie(1);
        $facture->setIdPiececomptable($piece_achat->getId());
        $facture->save();

        $pager = $this->paginateAchat($request);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference');
        $fournisseur = $request->getParameter('fournisseur');

        return $this->renderPartial("importation/liste_achat", array("pager" => $pager, "page" => $page, "reference" => $reference, "fournisseur" => $fournisseur));
    }

    public function getSerieJournal($journal, $date) {

        $serie = NumeroseriejournalTable::getInstance()->getSerie($journal, $date)->getFirst();

        $tab = array();
        $tab['serie_id'] = $serie->getId();
        $tab['numero'] = str_replace(' ', '', $serie->getPrefixe()) . sprintf("%03s", $serie->getAttendu());
        return $tab;
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

    public function executeValiderCompteAchat(sfWebRequest $request) {
        $compte = $request->getParameter('compte');

        $fournisseur = FournisseurTable::getInstance()->find($request->getParameter('id'));
        $fournisseur->setIdPlancomptable($compte);
        $fournisseur->save();

        $pager = $this->paginateAchat($request);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference');
        $fournisseur = $request->getParameter('fournisseur');

        return $this->renderPartial("importation/liste_achat", array("pager" => $pager, "page" => $page, "reference" => $reference, "fournisseur" => $fournisseur));
    }

    public function executeValiderCompteOdclient(sfWebRequest $request) {
        $compte = $request->getParameter('compte');

        $fournisseur = ClientTable::getInstance()->find($request->getParameter('id'));
        $fournisseur->setIdPlancomptable($compte);
        $fournisseur->save();

        $pager = $this->paginateOdClient($request);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference');
        $fournisseur = $request->getParameter('fournisseur');

        return $this->renderPartial("importation/liste_od_client", array("pager" => $pager, "page" => $page, "reference" => $reference, "fournisseur" => $fournisseur));
    }

    public function executeValiderCompteVente(sfWebRequest $request) {

        $compte = $request->getParameter('compte');

        $client = ClientTable::getInstance()->find($request->getParameter('id'));
        $client->setIdPlancomptable($compte);
        $client->save();

        $pager = $this->paginateVente($request);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference');
        $client = $request->getParameter('client');

        return $this->renderPartial("importation/liste_vente", array("pager" => $pager, "page" => $page, "reference" => $reference, "client" => $client));
    }

    public function executeAffecterCompteClientVente(sfWebRequest $request) {
        $this->client = ClientTable::getInstance()->find($request->getParameter('id'));
        $this->comptes = PlancomptableTable::getInstance()->findOrderByNumeroSousClasse('41');
    }

    public function executeAffecterCompteFournisseurAchat(sfWebRequest $request) {
        $this->fournisseur = FournisseurTable::getInstance()->find($request->getParameter('id'));
        $this->comptes = PlancomptableTable::getInstance()->findOrderByNumeroSousClasse('40');
    }

    public function executeAffecterComptelientOdclient(sfWebRequest $request) {
        $this->clients = ClientTable::getInstance()->find($request->getParameter('id'));
        $this->comptes = PlancomptableTable::getInstance()->findOrderByNumeroSousClasse('41');
    }

    public function executePreparationSaisirFactureVente(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->facture = FacturecomptableventeTable::getInstance()->find($id);
        $this->dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];

        $this->journaux = JournalcomptableTable::getInstance()->findByLibelleTypeAndIdDossierAndIdExercice("CHIFFRE D'AFFAIRES", $dossier_id, $exercice_id);
    }

    public function executePreparationSaisirFactureTresorerie(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->facture = ReglementcomptableTable::getInstance()->find($id);
        $this->dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];

        $this->journaux = JournalcomptableTable::getInstance()->findByLibelleTresorerieTypeAndDossierAndExercice("CHIFFRE D'AFFAIRES", "OUVERTURE", $dossier_id, $exercice_id);
    }

//    public function executePreparationSaisirFactureMouvement(sfWebRequest $request) {
//        $id = $request->getParameter('id');
//        $this->facture = MovementpieceTable::getInstance()->find($id);
//        $this->dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);
//        $dossier_id = $_SESSION['dossier_id'];
//        $exercice_id = $_SESSION['exercice_id'];
//
//        $this->journaux = JournalcomptableTable::getInstance()->findByLibelleTresorerieTypeAndDossierAndExercice("OD", "OUVERTURE", $dossier_id, $exercice_id);
//    }

    public function executePreparationsaisirmouvement(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->facture = MovementpieceTable::getInstance()->find($id);
        $this->dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);
        $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $this->journaux = JournalcomptableTable::getInstance()->findByLibelleTypeAndIdDossierAndIdExercice('OD', $dossier_id, $exercice_id);
    }

    public function executePreparationMaquetteAchat(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->facture = FacturecomptableachatTable::getInstance()->find($id);
        $this->dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);

//2 => journal de type achat
        $this->maquettes = MaquetteTable::getInstance()->getAllFiltre(2);
    }

    public function executePreparationMaquetteOdClient(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->facture = FacturecomptableodclientTable::getInstance()->find($id);
        $this->dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);

//2 => journal de type achat
        $this->maquettes = MaquetteTable::getInstance()->getAllFiltre(5);
    }

    public function executePreparationMaquetteVente(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->facture = FacturecomptableventeTable::getInstance()->find($id);
        $this->dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);

//1 => journal de type vente
        $this->maquettes = MaquetteTable::getInstance()->getAllFiltre(1);
    }

    public function executeChargerMaquetteSaisie(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $facture_id = $request->getParameter('facture_id');
        $type_facture = $request->getParameter('type_facture');
        $this->maquette = MaquetteTable::getInstance()->find($id);
        if ($type_facture == 'achat')
            $this->facture = FacturecomptableachatTable::getInstance()->find($facture_id);
        else
            $this->facture = FacturecomptableventeTable::getInstance()->find($facture_id);
        $this->type_facture = $type_facture;
    }

    public function executePreparationMaquetteForAll(sfWebRequest $request) {
        $type = $request->getParameter('type');
        $this->reference = $request->getParameter('reference', '');
        $this->client = $request->getParameter('client', '');

        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());

        if ($type == "achat") {
//2 => journal de type achat
            $this->maquettes = MaquetteTable::getInstance()->getAllFiltre(2);
            $this->factures = FacturecomptableachatTable::getInstance()->findByPeriode($date_debut, $date_fin);
        } elseif ($type == "vente") {
//1 => journal de type vente
            $this->maquettes = MaquetteTable::getInstance()->getAllFiltre(1);
            $this->factures = FacturecomptableventeTable::getInstance()->findByPeriode($date_debut, $date_fin);
        } elseif ($type == "od") {
            $this->maquettes = MaquetteTable::getInstance()->getAllFiltre(5);
            $this->factures = FacturecomptableodTable::getInstance()->findByPeriode($date_debut, $date_fin);
        } elseif ($type == "banque") {
            $this->maquettes = MaquetteTable::getInstance()->getAllFiltre(3);
            $this->factures = ReglementcomptableTable::getInstance()->findByPeriode($date_debut, $date_fin);
        } elseif ($type == "od_client") {
            $this->maquettes = MaquetteTable::getInstance()->getAllFiltre(5);
            $this->factures = FacturecomptableodclientTable::getInstance()->findByPeriode($date_debut, $date_fin);
        } elseif ($type == "od_mouvement") {
            $this->maquettes = MaquetteTable::getInstance()->getAllFiltre(5);
            $this->factures = MovementpieceTable::getInstance()->findByPeriode($date_debut, $date_fin);
        }


        $this->type = $type;
    }

    public function executeShowMaquetteSaisie(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->maquette = MaquetteTable::getInstance()->find($id);
    }

    public function executeSaisirAllPieceByMaquette(sfWebRequest $request) {
        $params = array();
        $content = $request->getContent();
        $params = json_decode($content, true);
        $id = $params['id'];
        $factures = $params['factures'];
        $type = $params['type_facture'];
        $factures = $factures;
        $maquette = MaquetteTable::getInstance()->find($id);

        try {
            //Pièces comptables
            if ($factures != ''):
                if ($type == "achat")
                    $facture = FacturecomptableachatTable::getInstance()->find($factures);
                elseif ($type == "vente")
                    $facture = FacturecomptableventeTable::getInstance()->find($factures);
                elseif ($type == "od")
                    $facture = FacturecomptableodTable::getInstance()->find($factures);
                elseif ($type == "od_client")
                    $facture = FacturecomptableodclientTable::getInstance()->find($factures);
                elseif ($type == "banque")
                    $facture = ReglementcomptableTable::getInstance()->find($factures);
                elseif ($type == "od_mouvement")
                    $facture = MovementpieceTable::getInstance()->find($factures);
                $exercice_id = $_SESSION['exercice_id'];
                $user = $this->getUser()->getAttribute('userB2m');
                $piece_comptable = new Piececomptable();
                $piece_comptable->setDate($facture->getDate());
                $piece_comptable->setDatecreation(date('Y-m-d'));
                $piece_comptable->setIdUser($user->getId());
                if ($type == "od")
                    $piece_comptable->setLibelle('Certificat de retenue à la source ' . ' N° ' . $facture->getReference());
                elseif ($type == "od_client")
                    $piece_comptable->setLibelle('Certificat de retenue à la source ' . ' N° ' . $facture->getReference());
                elseif ($type == "banque" && $facture->getLibelle() != '')
                    $piece_comptable->setLibelle($facture->getLibelle());
                elseif ($type == "banque" && $facture->getLibelle() == '')
                    $piece_comptable->setLibelle('Regelement  Fournissuer ' . $facture->getFournisseur()->getRs());
                elseif ($type == "achat" && $facture->getLibelle() != '')
                    $piece_comptable->setLibelle($facture->getLibelle());
                elseif ($type == "achat" && $facture->getLibelle() == '')
                    $piece_comptable->setLibelle('Facture Fournisseur ' . $facture->getFournisseur()->getRs());
                elseif ($type == "vente")
                    $piece_comptable->setLibelle('Facture  ' . $facture->getReference());
                elseif ($type == "od_mouvement")
                    $piece_comptable->setLibelle($facture->getLibelle());

                $piece_comptable->setIdJournalcomptable($maquette->getIdJournal());
                $piece_comptable->setIdExercice($exercice_id);
                $tab = $this->getSerieJournal($maquette->getIdJournal(), $facture->getDate());
                $piece_comptable->setNumero($tab['numero']);
                $piece_comptable->setIdSerie($tab['serie_id']);
                $piece_comptable->save();
                $facture->setSaisie(1);
                $facture->setIdPiececomptable($piece_comptable->getId());
                $facture->save();
                $piece_comptable->setDate($facture->getDate());
                $piece_comptable->setDatecreation(date('Y-m-d'));
                $piece_comptable->setIdUser($user->getId());
//                if ($type == "od")
//                    $piece_comptable->setLibelle('Certificat de retenue à la source ' . ' N° ' . $facture->getReference());
//                if ($type == "od_client")
//                    $piece_comptable->setLibelle('Certificat de retenue à la source ' . ' N° ' . $facture->getReference());
//
//                elseif ($type == "banque")
//                    $piece_comptable->setLibelle('Pièce Banquaire ' . ' N° ' . $facture->getNumero());
//                elseif ($type == "achat")
//                    $piece_comptable->setLibelle('Facture Achat' . ' N° ' . $facture->getReference());
//                elseif ($type == "vente")
//                    $piece_comptable->setLibelle('Facture Vente' . ' N° ' . $facture->getReference());
//                elseif ($type == "od_mouvement")
//                    $piece_comptable->setLibelle('Pièce mouvementé ' . ' N° ' . $facture->getReference());

                $piece_comptable->setIdJournalcomptable($maquette->getIdJournal());
                $piece_comptable->setIdExercice($exercice_id);

                $tab = $this->getSerieJournal($maquette->getIdJournal(), $facture->getDate());

                $piece_comptable->setNumero($tab['numero']);
                $piece_comptable->setIdSerie($tab['serie_id']);

                $piece_comptable->save();

                $facture->setSaisie(1);
                $facture->setIdPiececomptable($piece_comptable->getId());
                $facture->save();

                $this->updateAttenduLastNumber($tab['serie_id'], $tab['numero']);

                if ($type == "achat") {
                    $montant[1] = $facture->getTotalht() + $facture->getTimbre();
                    $montant[2] = $facture->getTotaltva();
                    $montant[3] = $facture->getTotalttc();
                } elseif ($type == "vente") {
                    $montant[1] = $facture->getTotalhtax();
                    $montant[2] = $facture->getTfodec();
                    $montant[3] = $facture->getTotalht();
                    $montant[4] = $facture->getTotaltva();
                    $montant[5] = $facture->getTimbre();
                    $montant[6] = $facture->getTotalttc();
                } elseif ($type == "od") {
                    $montant[1] = $facture->getTotalht();
                    $montant[2] = 0;
                    $montant[3] = $facture->getTimbre();
                    $montant[4] = 0;
                } elseif ($type == "banque") {
                    $montant[1] = $facture->getTotalht();
                    $montant[2] = $facture->getTotaltva();
                    $montant[3] = $facture->getTotalttc();
                    $montant[4] = 0;
                } elseif ($type == "od_client") {
                    $montant[1] = $facture->getTotalht();
                    $montant[2] = 0;
                    $montant[3] = $facture->getTimbre();
                    $montant[4] = 0;
                } elseif ($type == "od_mouvement") {
                    $montant[1] = 0;
                    $montant[2] = 0;
                    $montant[3] = $facture->getMontant();
                    $montant[4] = 0;
                }
                $total_debit = 0;
                $total_credit = 0;
//Lignes pièces comptables

                foreach ($maquette->getLignemaquette() as $ligne):

                    $ligne_piece = new Lignepiececomptable();

                    if ($type == "achat")
                        $ligne_piece->setIdFactureachat($facture->getId());
                    elseif ($type == "vente")
                        $ligne_piece->setIdFacturevente($facture->getId());
                    elseif ($type == "od")
                        $ligne_piece->setIdFactureod($facture->getId());
                    elseif ($type == "od_client")
                        $ligne_piece->setIdFactureodclient($facture->getId());
                    elseif ($type == "banque")
                        $ligne_piece->setIdRegelment($facture->getId());
                    elseif ($type == "od_mouvement")
                        $ligne_piece->setIdMouvement($facture->getId());
                    if ($type != "banque")
                        $ligne_piece->setReference($facture->getReference());
                    if ($type == "banque")
                        $ligne_piece->setReference($facture->getNumero());

                    $ligne_piece->setDate($facture->getDate());
                    $ligne_piece->setIdPiececomptable($piece_comptable->getId());
//7 => FACTURE   
                    if ($type == "achat" || $type == "vente" || $type == "od" || $type == "od_mouvement")
                        $ligne_piece->setIdNaturepiece(7);
                    if ($type == "od")
                        $ligne_piece->setIdNaturepiece(10);
                    if ($type == "od_client")
                        $ligne_piece->setIdNaturepiece(10);
                    if ($type == "banque")
                        $ligne_piece->setIdNaturepiece(11);
                    $ligne_piece->setNumeroexterne($facture->getNumero());
//                    $ligne_piece->setMontantcredit($facture->get);
//                    $ligne_piece->setMontantdebit();
                    $credit_ligne = '';
                    $debit_ligne = '';

                    if (trim($ligne->getType()) == 'credit'):
                        if (trim($ligne->getSpecificationmontant()) == 'fixe'):
                            $credit_ligne = $ligne->getMontant();
                        endif;
                        if (trim($ligne->getSpecificationmontant()) == 'copie'):
                            $credit_ligne = $montant[$ligne->getNumerolignemontant()];
                        endif;
                        if (trim($ligne->getSpecificationmontant()) == 'taux'):
                            $credit_ligne = $montant[$ligne->getNumerolignemontant()] * $ligne->getTaux();
                        endif;
                    else:
                        if (trim($ligne->getSpecificationmontant()) == 'fixe'):
                            $debit_ligne = $ligne->getMontant();
                        endif;
                        if (trim($ligne->getSpecificationmontant()) == 'copie'):
                            $debit_ligne = $montant[$ligne->getNumerolignemontant()];
                        endif;
                        if (trim($ligne->getSpecificationmontant()) == 'taux'):
                            $debit_ligne = $montant[$ligne->getNumerolignemontant()] * $ligne->getTaux();
                        endif;
                    endif;

                    if ($credit_ligne != '') {
                        $ligne_piece->setMontantcredit($credit_ligne);
                        $total_credit = $total_credit + $credit_ligne;
                    }

                    if ($debit_ligne != '') {
                        $ligne_piece->setMontantdebit($debit_ligne);
                        $total_debit = $total_debit + $debit_ligne;
                    }

//                    if ($total_credit - $total_debit == 0.000) {
                    $id_compte_ligne = '';
                    $id_contre_ligne = '';

                    if ($ligne->getTiers() == 1):
                        if ($type == "achat"):
//                            die($facture->getFournisseur()->getPlancomptable()->getId() .'id');
                            if ($facture->getFournisseur()->getPlancomptable()->getId() != null):
                                $plan_dossier_comptable = PlandossiercomptableTable::getInstance()->getByPlanDossieExercice($facture->getFournisseur()->getPlancomptable()->getId(), $_SESSION['dossier_id'], $_SESSION['exercice_id'])->getFirst();
                                $id_compte_ligne = $plan_dossier_comptable->getId();
                            endif;
                        elseif ($type == "vente"):
                            if ($facture->getClient()->getPlancomptable()->getId() != null):
                                $plan_dossier_comptable = PlandossiercomptableTable::getInstance()->getByPlanDossieExercice($facture->getClient()->getPlancomptable()->getId(), $_SESSION['dossier_id'], $_SESSION['exercice_id'])->getFirst();
                                if ($plan_dossier_comptable):
                                    $id_compte_ligne = $plan_dossier_comptable->getId();
                                endif;
                            endif;
                        elseif ($type == "od"):
                            if ($facture->getFournisseur()->getPlancomptable()->getId() != null):
                                $plan_dossier_comptable = PlandossiercomptableTable::getInstance()->getByPlanDossieExercice($facture->getFournisseur()->getPlancomptable()->getId(), $_SESSION['dossier_id'], $_SESSION['exercice_id'])->getFirst();
                                $id_compte_ligne = $plan_dossier_comptable->getId();
                                $plan_od = PlandossiercomptableTable::getInstance()->findByIdPlan($facture->getIdCompteretenue())->getFirst();
//                                $id_compte_ligne_retenue = $plan_od->getId();
                            endif;
                        elseif ($type == "od_client"):
                            if ($facture->getClient()->getPlancomptable()->getId() != null):
                                $plan_dossier_comptable = PlandossiercomptableTable::getInstance()->getByPlanDossieExercice($facture->getClient()->getPlancomptable()->getId(), $_SESSION['dossier_id'], $_SESSION['exercice_id'])->getFirst();
                                $id_compte_ligne = $plan_dossier_comptable->getId();
                                $plan_od = PlandossiercomptableTable::getInstance()->findByIdPlan($facture->getIdCompteretenue())->getFirst();
//                                $id_compte_ligne_retenue = $plan_od->getId();
                            endif;
                        elseif ($type == "banque"):
                            $id_compte_ligne = $facture->getIdComptecomptable();
                        elseif ($type == "od_mouvement"):
                            if ($facture->getIdComptecomptable() != null):
                                $plan_dossier_comptable = PlandossiercomptableTable::getInstance()->findOnebyIdAndIdDossierAndIdExercice($facture->getIdComptecomptable(), $_SESSION['dossier_id'], $_SESSION['exercice_id']);
                                $id_compte_ligne = $plan_dossier_comptable->getId();
//                                $plan_od = PlandossiercomptableTable::getInstance()->findByIdPlan($facture->getIdCompteretenue())->getFirst();
//                                $id_compte_ligne_retenue = $plan_od->getId();
                            endif;
                        endif;
                    else:
                        if ($ligne->getCompteretenue() == 1):
                            if ($type == "od"):
                                if ($facture->getIdCompteretenue() != null):
                                    $plan_dossier_comptable = PlandossiercomptableTable::getInstance()->findByIdPlanAndIdDossierAndIdExercice($facture->getIdCompteretenue(), $_SESSION['dossier_id'], $_SESSION['exercice_id'])->getFirst();
                                    $id_compte_ligne = $plan_dossier_comptable->getId();
                                endif;
                            elseif ($type == "achat"):
                                if ($facture->getIdComptecharge() != null):
                                    $plan_dossier_comptable = PlandossiercomptableTable::getInstance()->findByIdPlanAndIdDossierAndIdExercice($facture->getIdComptecharge(), $_SESSION['dossier_id'], $_SESSION['exercice_id'])->getFirst();
                                    $id_compte_ligne = $plan_dossier_comptable->getId();
                                endif;
                            elseif ($type == "od_client"):
                                if ($facture->getIdCompteretenue() != null):
                                    $plan_dossier_comptable = PlandossiercomptableTable::getInstance()->findByIdPlanAndIdDossierAndIdExercice($facture->getIdCompteretenue(), $_SESSION['dossier_id'], $_SESSION['exercice_id'])->getFirst();
                                    $id_compte_ligne = $plan_dossier_comptable->getId();
                                endif;
                            endif;
                        else:
                            if (trim($ligne->getSpecificationcompte()) != 'sans'):
                                $plan_dossier_comptable = PlandossiercomptableTable::getInstance()->findByIdPlanAndIdDossierAndIdExercice($ligne->getPlancomptable()->getId(), $_SESSION['dossier_id'], $_SESSION['exercice_id'])->getFirst();
                                $id_compte_ligne = $plan_dossier_comptable->getId();
                            //$ligne->getPlancomptable()->getPlandossiercomptable()->getFirst()->getId();
                            endif;
                        endif;

                    endif;
                    if (trim($ligne->getSpecificationcontre()) != 'sans'):
                        $contrepartie = PlancomptableTable::getInstance()->findOneById($ligne->getIdContrepartie());
                        $id_contre_ligne = $contrepartie->getPlandossiercomptable()->getLast()->getId();
                    endif;

                    if ($id_compte_ligne != '')
                        $ligne_piece->setIdComptecomptable($id_compte_ligne);

//                    
                    if ($id_contre_ligne != '')
                        if (isset($id_compte_ligne_retenue) && $id_compte_ligne_retenue != '')
                            $ligne_piece->setIdComptecomptable($id_compte_ligne_retenue);
                    if ($id_contre_ligne && $id_contre_ligne != '')
                        $ligne_piece->setIdContrepartie($id_contre_ligne);

                    $ligne_piece->save();
//                   } 
                endforeach;
//                if ($total_credit - $total_debit == 0.000) {
                $piece_comptable->setTotalcredit($total_credit);
                $piece_comptable->setTotaldebit($total_debit);

                $piece_comptable->save();
//                if ($piece_comptable->getLignepiececomptable()->getFirst()->getIdComptecomptable() == null) {
//
//                    $id_piece = $piece_comptable->getId();
//                    $this->id = $id_piece;
//                    $this->supprimerPieceSeul($id_piece);
//                }
//                }
//                else {
//                  
//                    $piece_comptable->save();
//                    $id_piece = $piece_comptable->getId();
//                    $this->id = $id_piece;
//                    $this->supprimerPieceSeul($id_piece);
//                    
//                }

            endif;
//        die('ok');
            $this->getResponse()->setContentType('text/json');

            return $this->renderText(json_encode(array(
                        "msg" => "OK"
            )));
        } catch (Exception $ex) {
            $this->getResponse()->setContentType('text/json');

            return $this->renderText(json_encode(array(
                        "msg" => "Error"
            )));
        }
    }

    public function executeImprimeListe(sfWebRequest $request) {
        $pdf = new sfTCPDF();

// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $type = $request->getParameter('type');
        if ($type == "achat"):
            $title = "Factures Achats Importées";
        elseif ($type == "vente"):
            $title = "Factures Ventes Importées";
        elseif ($type == "od"):
            $title = "Factures Retenue à la source Importées";
        elseif ($type == "banque"):
            $title = "Réglement comptable Importées";
        endif;
        $pdf->SetTitle($title);
        $pdf->SetSubject($title);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
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
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
//        $pdf->SetMargins(5, 30, 5);
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
        $html = $this->ReadHtmlListePieceComptable($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste factures importées.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListePieceComptable(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $type = $request->getParameter('type');
        if ($type == "achat") {
            $piece = new Facturecomptableachat();
            $html .= $piece->ReadHtmlListe($request);
        } elseif ($type == "vente") {
            $piece = new Facturecomptablevente();
            $html .= $piece->ReadHtmlListe($request);
        } elseif ($type == "od") {
            $piece = new Facturecomptableod();
            $html .= $piece->ReadHtmlListe($request);
        } elseif ($type == "banque") {
            $piece = new Reglementcomptable();
            $html .= $piece->ReadHtmlListe($request);
        }

        return $html;
    }

    public function executeSuprimerPiecedeFactureAchat(sfWebRequest $request) {

        $this->supprimerPiece($request);

        $this->pager = $this->paginate($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function supprimerPieceSeul($id) {

        $piece = PieceComptableTable::getInstance()->findOneById($id);

        $serie = NumeroSerieJournalTable::getInstance()->find($piece->getIdSerie());

        $attendu = $serie->getAttendu();
        $prefixe = $serie->getPrefixe();
        $numero = $piece->getNumero();

        $numero_sans_prefixe = str_replace($prefixe, "", $numero);

        if (intval($numero_sans_prefixe) < $attendu) {
            $serie->setAttendu(($numero_sans_prefixe));
            $serie->save();
        }
        $dossier_comptable = DossiercomptableTable::getInstance()->findAll()->getFirst();
        $type = "";
        $id_facture_importe = "";
        if (count($piece->getLignepiececomptable()) > 0) {
            foreach ($piece->getLignepiececomptable() as $l_p) {

//en cas de création par facture importée par l'excel
                if ($l_p->getIdFactureachat()) {
                    $type = "achat";
                    $id_facture_importe = $l_p->getIdFactureachat();
                }
                if ($l_p->getIdFacturevente()) {
                    $type = "vente";
                    $id_facture_importe = $l_p->getIdFacturevente();
                }
                if ($l_p->getIdFactureod()) {
                    $type = "do";
                    $id_facture_importe = $l_p->getIdFactureod();
                }
                if ($l_p->getIdRegelment()) {
                    $type = "banque";
                    $id_facture_importe = $l_p->getIdRegelment();
                }

                $l_p->delete();
            }
        }

//Vérifier si la pièce est créée par une facture importée par l'excel
        switch ($type) {
            case "achat":
                $facture_importe = FacturecomptableachatTable::getInstance()->find($id_facture_importe);
                $facture_importe->setSaisie(0);
                $facture_importe->setIdPiececomptable(null);
                $facture_importe->save();
                break;

            case "vente":
                $facture_importe = FacturecomptableventeTable::getInstance()->find($id_facture_importe);
                $facture_importe->setSaisie(0);
                $facture_importe->setIdPiececomptable(null);
                $facture_importe->save();
                break;
            case "od":
                $facture_importe = FacturecomptableodTable::getInstance()->find($id_facture_importe);
                $facture_importe->setSaisie(0);
                $facture_importe->setIdPiececomptable(null);
                $facture_importe->save();
                break;
            case "banque":
                $facture_importe = ReglementcomptableTable::getInstance()->find($id_facture_importe);
                $facture_importe->setSaisie(0);
                $facture_importe->setIdPiececomptable(null);
                $facture_importe->save();
                break;
            default :

                break;
        }

        $piece->delete();

//        return $facture_importe;
    }

    public function supprimerPiece(sfWebRequest $request) {
        $id = $request->getParameter('id');

        $piece = PieceComptableTable::getInstance()->findById($id);

        $serie = NumeroSerieJournalTable::getInstance()->find($piece->getIdSerie());

        $attendu = $serie->getAttendu();
        $prefixe = $serie->getPrefixe();
        $numero = $piece->getNumero();

        $numero_sans_prefixe = str_replace($prefixe, "", $numero);

        if (intval($numero_sans_prefixe) < $attendu) {
            $serie->setAttendu(($numero_sans_prefixe));
            $serie->save();
        }
        $dossier_comptable = DossiercomptableTable::getInstance()->findAll()->getFirst();
        $type = "";
        $id_facture_importe = "";

        foreach ($piece->getLignepiececomptable() as $l_p) {
//Mise à jour solde plan dossier comptable (solde du compte comptable associé au dossier & exercice)
//            $dossier_plan = PlandossiercomptableTable::getInstance()->findByIdDossierAndIdPlanAndIdExercice($dossier_comptable->getId(), $l_p->getIdComptecomptable(), $piece->getIdExercice())->getFirst();
//            $dossier_plan_solde = $dossier_plan->getSolde();
//            if ($l_p->getMontantdebit() != 0)
//                $dossier_plan_solde = $dossier_plan_solde - $l_p->getMontantdebit();
//            if ($l_p->getMontantcredit() != 0)
//                $dossier_plan_solde = $dossier_plan_solde + $l_p->getMontantcredit();
//            $dossier_plan->setSolde($dossier_plan_solde);
//            $dossier_plan->save();
//en cas de création par facture importée par l'excel
            if ($l_p->getIdFactureachat()) {
                $type = "achat";
                $id_facture_importe = $l_p->getIdFactureachat();
            }
            if ($l_p->getIdFacturevente()) {
                $type = "vente";
                $id_facture_importe = $l_p->getIdFacturevente();
            }
            if ($l_p->getIdFactureod()) {
                $type = "do";
                $id_facture_importe = $l_p->getIdFactureod();
            }
            if ($l_p->getIdRegelment()) {
                $type = "banque";
                $id_facture_importe = $l_p->getIdRegelment();
            }
            $l_p->delete();
        }

//Vérifier si la pièce est créée par une facture importée par l'excel
        switch ($type) {
            case "achat":
                $facture_importe = FacturecomptableachatTable::getInstance()->find($id_facture_importe);
                $facture_importe->setSaisie(0);
                $facture_importe->setIdPiececomptable(null);
                $facture_importe->save();
                break;

            case "vente":
                $facture_importe = FacturecomptableventeTable::getInstance()->find($id_facture_importe);
                $facture_importe->setSaisie(0);
                $facture_importe->setIdPiececomptable(null);
                $facture_importe->save();
                break;

            case "od":
                $facture_importe = FacturecomptableodTable::getInstance()->find($id_facture_importe);
                $facture_importe->setSaisie(0);
                $facture_importe->setIdPiececomptable(null);
                $facture_importe->save();
                break;
            case "banque":
                $facture_importe = ReglementcomptableTable::getInstance()->find($id_facture_importe);
                $facture_importe->setSaisie(0);
                $facture_importe->setIdPiececomptable(null);
                $facture_importe->save();
                break;
            default :
                break;
        }

        $piece->delete();
    }

    public function executeGoPage(sfWebRequest $request) {
        $client = $request->getParameter('client', '');
        $reference = $request->getParameter('reference', '');
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());
        $factures = FacturecomptableventeTable::getInstance()->findByPeriodeAndRefClient($date_debut, $date_fin, $reference, $client);
//        return ($factures);

        return $this->renderPartial("importation/liste_factures_vente", array("factures" => $factures));
    }

    public function executeGoPageAch(sfWebRequest $request) {

        $frs = $request->getParameter('frs', '');

        $reference = $request->getParameter('reference', '');
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());
        $factures = FacturecomptableachatTable::getInstance()->findByPeriodeAndRefFournisseur($date_debut, $date_fin, $reference, $frs);
//        return ($factures);

        return $this->renderPartial("importation/liste_factures_achat", array("factures" => $factures));
    }

    public function executeGoPageVen(sfWebRequest $request) {

        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());
        $reference = $request->getParameter('ref');
        $clt = $request->getParameter('clt');
        $factures = FacturecomptableventeTable::getInstance()->findByPeriodeAndType($date_debut, $date_fin, $reference, $clt);

        return $this->renderPartial("importation/liste_vente_partial", array("factures" => $factures));
    }

    public function executeGoPageOd(sfWebRequest $request) {

        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());
        $reference = $request->getParameter('ref');
        $fournisseur = $request->getParameter('frs');
        $factures = FacturecomptableodTable::getInstance()->findByPeriodeAndType($date_debut, $date_fin, $reference, $fournisseur);

        return $this->renderPartial("importation/liste_od_partial", array("factures" => $factures));
    }

    public function executeGoPageOdClient(sfWebRequest $request) {

        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());
        $reference = $request->getParameter('ref');
        $fournisseur = $request->getParameter('frs');
        $factures = FacturecomptableodclientTable::getInstance()->findByPeriodeAndType($date_debut, $date_fin, $reference, $fournisseur);
//        $this->pager = $this->paginateOdClientRecherche($request);
//        $this->page = $request->getParameter('page', 1);
        return $this->renderPartial("importation/liste_od_partial_client", array("factures" => $factures));
    }

    public function paginateOdClientRecherche(sfWebRequest $request) {
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $page = $request->getParameter('page', 1);
        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());
        $reference = $request->getParameter('ref');
        $fournisseur = $request->getParameter('frs');
        $pager = new sfDoctrinePager('Facturecomptableodclient', 10);
        $pager->setQuery(FacturecomptableodclientTable::getInstance()->findByPeriodeAndType($date_debut, $date_fin, $reference, $fournisseur));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeGoPageTre(sfWebRequest $request) {
        $type = $request->getParameter('type', '');

        $reference = $request->getParameter('reference', '');
        $libelle = $request->getParameter('libelle', '');
        $banque = $request->getParameter('banque', '');
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());
        $factures = ReglementcomptableTable::getInstance()->findByPeriodeAndType($date_debut, $date_fin, $reference, $type, $libelle, $banque);
//die(count($factures).'count');

        return $this->renderPartial("importation/liste_reglement_partial", array("factures" => $factures));
    }

    public function executeGoPageMvt(sfWebRequest $request) {
        $type = $request->getParameter('type', '');
        $reference = $request->getParameter('reference', '');
        $libelle = $request->getParameter('libelle', '');
        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());
        $factures = MovementpieceTable::getInstance()->findByPeriodeAndType($date_debut, $date_fin, $reference, $type);
//die(count($factures).'count');

        return $this->renderPartial("importation/liste_mvt_partial", array("factures" => $factures));
    }

    public function executeEditReglement(sfWebRequest $request) {
        $this->reglement = ReglementcomptableTable::getInstance()->find($request->getParameter('id'));
        $this->comptes = PlandossierComptableTable::getInstance()->findOrderByNumero();
    }

    public function executeEditMouvement(sfWebRequest $request) {
        $this->mouvement = MouvementcomptableTable::getInstance()->find($request->getParameter('id'));
        $this->comptes = PlandossierComptableTable::getInstance()->findOrderByNumero();
    }

//    public function executeGoTypeReglement(sfWebRequest $request) {
//        $type = $request->getParameter('type', '');
//
//        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
//        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
//        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());
//        $factures = ReglementcomptableTable::getInstance()->findType($date_debut, $date_fin, $type);
//
//        return $this->renderPartial("importation/liste_reglement", array("factures" => $factures));
//    }
    public function executeUpdateReglement(sfWebRequest $request) {
        $compte = $request->getParameter('compte_comptable');
        if ($compte != '') {
            $regelment = ReglementcomptableTable::getInstance()->find($request->getParameter('id'));

            $regelment->setIdComptecomptable($compte);
            $regelment->save();
        }

        $pager = $this->getAllReglement($request);
        return $this->renderPartial("liste_tresorerie", array("pager" => $pager));
    }

    public function executeUpdateMouvement(sfWebRequest $request) {
        $compte = $request->getParameter('compte_comptable');
        if ($compte != '') {
            $mvt = MouvementcomptableTable::getInstance()->find($request->getParameter('id'));

            $mvt->setIdComptecomptable($compte);
            $mvt->save();
        }

        $pager = $this->getAllMouvement($request);
        return $this->renderPartial("liste_mouvement", array("pager" => $pager));
    }

    function getAllMouvement(sfWebRequest $request) {
        $numero = strtoupper($request->getParameter('numero', ''));
        $libelle = strtoupper($request->getParameter('libelle', ''));
        $type = $request->getParameter('type', '');
        $compte = $request->getParameter('compte', '');

        $pager = new sfDoctrinePager('Mouvementcomptable', 5);
        $pager->setQuery(MouvementcomptableTable::getInstance()->getAllPagerComptabilite($numero, $libelle, $type, $compte));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    function getAllReglement(sfWebRequest $request) {
        $numero = strtoupper($request->getParameter('numero', ''));
        $libelle = strtoupper($request->getParameter('libelle', ''));
        $type = $request->getParameter('type', '');
        $compte = $request->getParameter('compte', '');

        $pager = new sfDoctrinePager('Reglementcomptable', 5);
        $pager->setQuery(ReglementcomptableTable::getInstance()->getAllPagerComptabilite($numero, $libelle, $type, $compte));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeAnnulerReglement(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $facture = ReglementcomptableTable::getInstance()->find($id);
        $facture->delete();
        $pager = $this->paginateTresorerie($request);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference');

        return $this->renderPartial("importation/liste_tresorerie", array("pager" => $pager, "page" => $page, "reference" => $reference));
    }

    public function executeAnnulerMouvement(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $facture = MovementpieceTable::getInstance()->find($id);
        $facture->delete();
        $pager = $this->paginateMouement($request);
        $page = $request->getParameter('page', 1);
        $reference = $request->getParameter('reference');

        return $this->renderPartial("importation/liste_mouvement", array("pager" => $pager, "page" => $page, "reference" => $reference));
    }

//    public function executeImprimerCertificat(sfWebRequest $request) {
//        $config = sfTCPDFPluginConfigHandler::loadConfig();
//
//        $id = $request->getParameter('id');
//
//        $pdf = new sfTCPDF();
//        // remove default header/footer
//        $pdf->setPrintHeader(false);
//        $pdf->setPrintFooter(false);
//
//        // set document information
//        $pdf->SetCreator(PDF_CREATOR);
//
//        $pdf->SetTitle('Certificat Retenue');
//        $pdf->SetSubject("Certificat Retenue");
//
//        // set default monospaced font
//        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//        // set margins
//        $pdf->SetMargins(10, 10, 10);
//
//        // set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }
//        ob_end_clean();
//        $pdf->SetFont('dejavusans', '', 10, '', true);
//        $pdf->AddPage();
//        $html = $this->ReadHtmlCertificat($id);
//        $pdf->writeHTML($html, true, false, true, false, '');
//        $pdf->Output('Certificat Retenue.pdf', 'I');
//
//        // Stop symfony process
//        throw new sfStopException();
//    }
//
//    public function ReadHtmlCertificat($id) {
//        $html = StyleCssHeader::header1();
//        $mvb = new Certificatretenue();
//        $html .= $mvb->ReadHtmlCertificat($id);
//        return $html;
//    }

    public function executeImprimerCertificat(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Certificat Retenue');
        $pdf->SetSubject("Certificat Retenue");

        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
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
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
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

        $html = $this->ReadHtmlCertificat($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
        $pdf->Output('Certificat Retenue.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlCertificat($id) {
        $html = StyleCssHeader::header1();
        $mvb = new Certificatretenue();
        $html .= $mvb->ReadHtmlCertificat($id);
        return $html;
    }

    public function executeImprimerdocachat(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $id = $request->getParameter('id');
        // pdf object
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche BCI N°:');
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
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
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
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

        $html = $this->ReadHtmlFactureCompta($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
        $pdf->Output('Facture Achat ' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFactureCompta($id) {
        $html = StyleCssHeader::header1();
        $documentachat = new Documentachat();
        $html .= $documentachat->ReadHtmlFactureImressionComptabilite($id);

        return $html;
    }

    
     public function executeImprimerdocachatBDCRegroupe(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $id = $request->getParameter('id');
        // pdf object
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche BCI N°:');
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
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
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
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

        $html = $this->ReadHtmlFactureComptaBDCRegrouppe($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
        $pdf->Output('Facture Achat ' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFactureComptaBDCRegrouppe($id) {
        $html = StyleCssHeader::header1();
        $documentachat = new Documentachat();
        $html .= $documentachat->ReadHtmlFactureImressionComptabiliteBDCReg($id);

        return $html;
    }
    
    
    public function executeImprimerdocentre(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $aviss = Doctrine_Core::getTable('avis')
                        ->createQuery('a')->where('id_poste=5')
                        ->orderBy('id asc')->execute();
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
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
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
        if ($documentachat->getIdTypedoc() == 10)
            $html = $this->ReadHtmlBonEntrer($societe, $documentachat, $listesdocuments);
        if ($documentachat->getIdTypedoc() == 11)
            $html = $this->ReadHtmlBonSortie($societe, $documentachat, $listesdocuments);
        if ($documentachat->getIdTypedoc() == 13)
            $html = $this->ReadHtmlBonTransfert($societe, $documentachat, $listesdocuments);
        if ($documentachat->getIdTypedoc() == 12)
            $html = $this->ReadHtmlBonRetour($societe, $documentachat, $listesdocuments);
        if ($documentachat->getIdTypedoc() == 14)
            $html = $this->ReadHtmlAvoir($societe, $documentachat, $listesdocuments);
        if ($documentachat->getIdTypedoc() == 15)
            $html = $this->ReadHtmlFacture($societe, $documentachat, $listesdocuments);


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
        $html.=$documentachat->ReadHtmlBonEntree();
        //die($html);
        return $html;
    }

    public function ReadHtmlFacture($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlFactureImression();
        //die($html);
        return $html;
    }

    public function ReadHtmlAvoir($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlAvoir();
        //die($html);
        return $html;
    }

    public function ReadHtmlBonSortie($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlBonSortie();
        //die($html);
        return $html;
    }

    public function ReadHtmlBonTransfert($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlBonTransfert();
        //die($html);
        return $html;
    }

    public function ReadHtmlBonRetour($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlBonRetour();
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
        $html.=$documentachat->ReadHtmlBondeponse();
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
