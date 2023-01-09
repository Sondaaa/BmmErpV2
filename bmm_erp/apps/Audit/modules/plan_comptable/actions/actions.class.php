<?php

/**
 * plan_comptable actions.
 *
 * @package    sw-commerciale
 * @subpackage plan_comptable
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class plan_comptableActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeAfficherLisCompte(sfWebRequest $request) {
        $compte_min = $request->getParameter('compte_min', '');
        $compte_max = $request->getParameter('compte_max', '');
        $exercice_id = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $dossier_id = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);
//        $pager = new sfDoctrinePager('Plandossiercomptable', 5);
        $comptes = PlandossiercomptableTable::getInstance()->loadByInterval($compte_min, $compte_max, $exercice_id, $dossier_id);
        return $this->renderPartial("list_comptes_plan_dossier", array("comptes" => $comptes));
    }

    public function executeSupprimerComptes(sfWebRequest $request) {
        $exercice_id = $_SESSION['exercice_id'];
        $dossier_id = $_SESSION['dossier_id'];
        $compte_min = trim($request->getParameter('compte_min', ''));
        $compte_max = trim($request->getParameter('compte_max', ''));

        $j = 0;
        $plandossiercomptabe_intervale = PlandossiercomptableTable::getInstance()->loadByIntervalCompta($compte_min, $compte_max);
//      die(count($plandossiercomptabe_intervale).'m');
        if (sizeof($plandossiercomptabe_intervale) >= 0) {
            foreach ($plandossiercomptabe_intervale as $compte_j) {
                $compte_j->delete();
                $j++;
            }
//             for ($j = 0; $j < sizeof($client_intervale_2); $j++) {
//                $client = ClientTable::getInstance()->findOneById($client_intervale_2[$j]['id']);
//                $client->delete();
//            }
        }
        $comptes = PlandossiercomptableTable::getInstance()->loadByInterval($compte_min, $compte_max, $exercice_id, $dossier_id);
        return $this->renderPartial("list_comptes_plan_dossier", array("comptes" => $comptes));
    }

    public function executeIndex(sfWebRequest $request) {
        $exercice_id = $_SESSION['exercice_id'];
        $this->comptes = PlandossiercomptableTable::getInstance()->getPlanComptableMinchiffreOrderByNumero($_SESSION['dossier_id'], $exercice_id);
        $this->classes = ClassecompteTable::getInstance()->findAll();
    }

    public function executeAjouterCompteComptable(sfWebRequest $request) {
        $this->devises = DeviseTable::getInstance()->findAll();
        $this->dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);
    }

    public function executeSave(sfWebRequest $request) {

        $annee = $_SESSION['exercice'] + 1;
        $exercice_prochain = DossierexerciceTable::getInstance()->getByAnneAndDossier($annee, $_SESSION['dossier_id']);

        if (!isset($_SESSION['dossier_id']))
            $numero_exist = PlandossiercomptableTable::getInstance()->findByNumerocompteAndIdDossierAndIdExercice($request->getParameter('numero_compte'), $_SESSION['dossier_id'], $_SESSION['exrcice_id']);
        else
            $numero_exist = PlandossiercomptableTable::getInstance()->findByNumerocompteAndIdDossierAndIdExercice($request->getParameter('numerocompte'), $_SESSION['dossier_id'], $_SESSION['exercice_id']);

        if ($numero_exist->count() != 0) {
            return $this->renderText('existe');
        } else {
            $id_compte_select = $request->getParameter('id_compte_select');
            $devise = $request->getParameter('devise');
            $dossier = $request->getParameter('dossier');
            $standard = $request->getParameter('standard');
            $lettrage = $request->getParameter('lettrage');
            $comptestandar = $request->getParameter('comptestandar');
            $senspardefaut = $request->getParameter('senspardefaut');
            $ensommeil = $request->getParameter('ensommeil');
//            die($ensommeil . 'vfd' . $devise . 'ensommeil' . $ensommeil);
            $compte = new Plancomptable();
            $compte->setDate(date('Y-m-d'));
            $compte->setNumerocompte($request->getParameter('numerocompte'));
            $compte->setLibelle($request->getParameter('libelle'));
            if ($standard)
                $compte->setStandard($standard);
            if ($senspardefaut)
                $compte->setSenspardefaut($senspardefaut);
            if ($lettrage != '')
                $compte->setLettrage($lettrage);
            if ($ensommeil != '')
                $compte->setEnsommeil($ensommeil);
            if ($dossier != '')
                $compte->setIdDossier($dossier);
            $user = new Utilisateur();
            $user = $this->getUser()->getAttribute('userB2m');
            $compte->setIdUser($user->getId());
//            $compte_comptable_superieur = PlancomptableTable::getInstance()->find($id_compte_select);
            $id_compte_select = substr($request->getParameter('numerocompte'), 0, 1);
            $compte->setIdClasse($id_compte_select);
            if (intval($devise) > 0 && $devise != '') {
                $compte->setIdDevise(intval($devise));
            }
            $compte->setTypesolde($request->getParameter('nature'));
//            $compte->setLettrage($request->getParameter('lettrage'));
//            $compte->setStandard(0);
            $compte->save();
            $this->saveCompteClasse($compte, $dossier, $id_compte_select);
            /* si i existe anne procahin ajouter ce compte dans les deux annee */
            if (sizeof($exercice_prochain) == 1) {
                $dossiercompte = new Plandossiercomptable();
                $dossiercompte->setDate(date('Y-m-d'));
                $dossiercompte->setLibelle($compte->getLibelle());
                $dossiercompte->setNumerocompte($compte->getNumeroCompte());
                $dossiercompte->setTypesolde($compte->getTypeSolde());
                $dossiercompte->setLettrage($compte->getLettrage());

                $dossiercompte->setIdDossier($dossier);
                $dossiercompte->setIdPlan($compte->getId());
                $dossiercompte->setIdExercice($exercice_prochain->getFirst()->getExercice()->getId());
                $dossiercompte->save();
            }
            return $this->renderText('ok');
        }
    }

    public function executeSaveEdit(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $annee = $_SESSION['exercice'] + 1;
        $exercice_prochain = DossierexerciceTable::getInstance()->getByAnneAndDossier($annee, $_SESSION['dossier_id']);

//        if (!isset($_SESSION['dossier_id']))
//            $numero_exist = PlandossiercomptableTable::getInstance()->findByNumerocompteAndIdDossierAndIdExercice($request->getParameter('numero_compte'), $_SESSION['dossier_id'], $_SESSION['exrcice_id']);
//        else
//            $numero_exist = PlandossiercomptableTable::getInstance()->findByNumerocompteAndIdDossierAndIdExercice($request->getParameter('numerocompte'), $_SESSION['dossier_id'], $_SESSION['exercice_id']);
//
//        if ($numero_exist->count() != 0) {
//            return $this->renderText('existe');
//        } else {
        $id_compte_select = $request->getParameter('id_compte_select');
        $devise = $request->getParameter('devise');
        $libelle = $request->getParameter('libelle');
        $code = $request->getParameter('code');
        $dossier = $request->getParameter('dossier');
        $standard = $request->getParameter('standard');
        $lettrage = $request->getParameter('lettrage');
        $comptestandar = $request->getParameter('comptestandar');
        $senspardefaut = $request->getParameter('senspardefaut');
        $ensommeil = $request->getParameter('ensommeil');
//            $this->saveCompteClasse($compte, $dossier, $id_compte_select);
//        if ($dossier != '-1') {
        $dossiercompte = PlandossiercomptableTable::getInstance()->findOneById($id);


        $dossiercompte->setDate(date('Y-m-d'));
        if ($libelle)
            $dossiercompte->setLibelle($libelle);
        if ($code)
            $dossiercompte->setNumerocompte($code);
//            $dossiercompte->setTypesolde($compte->getTypeSolde());
        if ($lettrage)
            $dossiercompte->setLettrage($lettrage);
//            $dossiercompte->setIdDossier($dossier);
        if ($comptestandar)
            $dossiercompte->setIdPlan($comptestandar);
        if ($senspardefaut)
            $dossiercompte->setSenspardefaut($senspardefaut);
        if ($ensommeil != '')
            $dossiercompte->setEnsommeil($ensommeil);
        if ($devise)
            $dossiercompte->setIdDevise($devise);
        $dossiercompte->setIdExercice($_SESSION['exercice_id']);
        $dossiercompte->save();
        /* si i existe anne procahin ajouter ce compte dans les deux annee */
        return $this->renderText('ok');
        // }
    }

    public function executeShow(sfWebRequest $request) {
        $this->compte = PlandossiercomptableTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeShowEdit(sfWebRequest $request) {
        $this->compte = PlandossiercomptableTable::getInstance()->find($request->getParameter('id'));
        $this->devises = DeviseTable::getInstance()->findAll();
    }

    public function executeShowEditComptecomptable(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->id = $id;
        $this->compte = PlandossiercomptableTable::getInstance()->find($id);
        $this->devises = DeviseTable::getInstance()->findAll();
        $this->dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);
    }

    public function saveCompteClasse($compte, $dossier, $id_compte_select) {

//        if ($dossier != '-1') {
        $dossiercompte = new Plandossiercomptable();

        $dossiercompte->setDate(date('Y-m-d'));
        $dossiercompte->setLibelle($compte->getLibelle());
        $dossiercompte->setNumerocompte($compte->getNumeroCompte());
        $dossiercompte->setTypesolde($compte->getTypeSolde());
        $dossiercompte->setLettrage($compte->getLettrage());
        $dossiercompte->setIdDossier($dossier);
        $dossiercompte->setIdPlan($compte->getId());
        //if ($senspardefaut)
        $dossiercompte->setSenspardefaut($compte->getSenspardefaut());
        //if ($ensommeil != '')
        $dossiercompte->setEnsommeil($compte->getEnsommeil());
        //if ($devise)
        $dossiercompte->setIdDevise($compte->getIdDevise());
        $dossiercompte->setIdExercice($_SESSION['exercice_id']);
        $dossiercompte->save();
//        }
//        $compte_classe = PlandossiercomptableTable::getInstance()->find($classe_compte);
//        if ($compte_classe->count() == 0) {
//            $compte_pere = PlancomptableTable::getInstance()->find($classe_compte);
//            $this->saveCompteClasse($compte_pere, $dossier, $compte_pere->getCompteId());
//        }
    }

    public function executeUpdate(sfWebRequest $request) {
        $devise = $request->getParameter('devise');
        $libelle = $request->getParameter('libelle');
        $code = $request->getParameter('code');

        $compte = PlandossiercomptableTable::getInstance()->findOneById($request->getParameter('id'));
//die($compte->getId());
        $compte->setNumerocompte($code);
        $compte->setLibelle($libelle);
//        if (intval($devise) > 0 && $devise != '')
//            $compte->setIdDevise($devise);
//        else
//            $compte->setIdDevise(null);
//        $compte->setTypeSolde($request->getParameter('nature'));
//        $compte->setLettrage($request->getParameter('lettrage'));

        $compte->save();

        $compte_dossier = PlandossiercomptableTable::getInstance()->findByIdPlan($request->getParameter('id'))->getLast();
        if ($compte_dossier != null) {
            $compte_dossier->setLibelle($request->getParameter('libelle'));
            $compte_dossier->setNumerocompte($request->getParameter('code'));
//            $compte_dossier->setTypeSolde($request->getParameter('nature'));
//            $compte_dossier->setLettrage($request->getParameter('lettrage'));

            $compte_dossier->save();
        }

        $exercice_id = $_SESSION['exercice_id'];

        $comptes = PlandossiercomptableTable::getInstance()->getPlanComptableOrderByNumero($_SESSION['dossier_id'], $exercice_id);
        return $this->renderPartial("list_comptes_plan_dossier", array("comptes" => $comptes));
    }

    public function executeVerifierExistanceLibelle(sfWebRequest $request) {
        if (!isset($_SESSION['dossier_id']))
            $libelle_exist = PlanComptableTable::getInstance()->findByLibelle($request->getParameter('lib'));
        else
            $libelle_exist = PlanComptableTable::getInstance()->findByLibelleAndIdDossier($request->getParameter('lib'), $_SESSION['dossier_id']);

        return $this->renderText($libelle_exist->count());
    }

    public function executeVerifierExistanceLibelleEdit(sfWebRequest $request) {
        if (!isset($_SESSION['dossier_id']))
            $libelle_exist = PlanComptableTable::getInstance()->findByLibelle($request->getParameter('lib'));
        else
            $libelle_exist = PlanComptableTable::getInstance()->findByLibelleAndIdDossier($request->getParameter('lib'), $_SESSION['dossier_id']);
        return $this->renderText($libelle_exist->count());
    }

    public function executeDelete(sfWebRequest $request) {

        $id = $request->getParameter('id');
        $compte = PlandossiercomptableTable::getInstance()->find($id);
        $compte_parent = $compte->getPlancomptable();
        if ($compte_parent->getPlandossiercomptable()->count() > 1)
            $delete_condition = false;
        else
            $delete_condition = true;
        $compte->delete();
        if ($delete_condition)
            $compte_parent->delete();

        $exercice_id = $_SESSION['exercice_id'];

        $comptes = PlandossiercomptableTable::getInstance()->getPlanComptableOrderByNumero($_SESSION['dossier_id'], $exercice_id);
        return $this->renderPartial("list_comptes_plan_dossier", array("comptes" => $comptes));
    }

    public function executeExtraitCompte(sfWebRequest $request) {
        $id = $request->getParameter('id');

        $this->compte = PlancomptableTable::getInstance()->findOneById($id);
        $this->journals = JournalcomptableTable::getInstance()->findAll();
    }

    public function executeImprimer(sfWebRequest $request) {
        
    }

    public function executeImprimerexporter(sfWebRequest $request) {
        
    }

    public function executeImprimergenerale(sfWebRequest $request) {
        
    }

    public function executeImprimercollectif(sfWebRequest $request) {
        
    }

    public function executeImprimerclient(sfWebRequest $request) {
        
    }

    public function executeImprimerfournisseur(sfWebRequest $request) {
        
    }

    public function executeExporterExcel(sfWebRequest $request) {
        
    }

    public function executeExporterExcelPlanclient(sfWebRequest $request) {
        
    }

    public function executeExporterExcelPlangeneral(sfWebRequest $request) {
        
    }

    public function executeExporterExcelPlancollectif(sfWebRequest $request) {
        
    }

    public function executeExporterExcelPlanfournisseur(sfWebRequest $request) {
        
    }

    public function executeImprimerClasse(sfWebRequest $request) {
        $pdf = new sfTCPDF();
        $pdf->setPrintHeader(false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $title = "Plan Comptable - Exercice" . $_SESSION['exercice'];
        $pdf->SetTitle($title);
        $pdf->SetSubject($title);
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
//        $soc = $societe;
//        $entete = $soc->getRaisonsociale();
//        $pdf->SetAuthor($entete);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');
        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(5, 5, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 7);

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
        $html = $this->ReadHtmlPlan($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $title = $title . '.pdf';
        $pdf->Output($title, 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPlan(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $plan = new Plandossiercomptable();
        $html .= $plan->ReadHtmlPlan($request);
        return $html;
    }

//***********Importation plan_comptable du dossier vers un autre dossier **********
    public function executeImportation(sfWebRequest $request) {
        $this->palncomptables = PlancomptableTable::getInstance()->findAll();
        $this->dossiers = DossiercomptableTable::getInstance()->findAll();
    }

    public function executeGetPlanDejaImporte(sfWebRequest $request) {
        $exercice_id = $request->getParameter('exercice_id');
        $dossier_id = $request->getParameter('dossier_id');
        $ex_dossier_id = $request->getParameter('ex_dossier_id');
        $ex_exercice_id = $request->getParameter('ex_exercice_id');
        $this->dossier = DossiercomptableTable::getInstance()->find($dossier_id);
        $this->exercice = ExerciceTable::getInstance()->findOneById($exercice_id);
        $this->plan_importe = PlancomptableTable::getInstance()->getByDossier($dossier_id, $exercice_id);

        $this->plancomptables = PlancomptableTable::getInstance()->getByDossier($ex_dossier_id, $ex_exercice_id);
    }

    public function executeSaveImportation(sfWebRequest $request) {
        $courant_dossier = $request->getParameter('courant_dossier');
        $exercice_id = $request->getParameter('exercice_id');
        $plancomptables = $request->getParameter('plancomptables');
        $plancomptables = explode(',', $plancomptables);

        for ($i = 0; $i < sizeof($plancomptables); $i++) {
            if ($plancomptables[$i] != '') {

                $plancomptables_ancien = PlancomptableTable::getInstance()->find($plancomptables[$i]);
                $plancomptable_new = new Plancomptable();
                $plancomptable_new->setNumerocompte($plancomptables_ancien->getNumerocompte());
                $plancomptable_new->setTypesolde($plancomptables_ancien->getTypesolde());
                $plancomptable_new->setLettrage($plancomptables_ancien->getLettrage());
                $plancomptable_new->setStandard($plancomptables_ancien->getStandard());
                $plancomptable_new->setLibelle($plancomptables_ancien->getLibelle());
                $plancomptable_new->setDate($plancomptables_ancien->getDate());
                $plancomptable_new->setIdClasse($plancomptables_ancien->getIdClasse());
                $plancomptable_new->setIdCompte($plancomptables_ancien->getIdCompte());
                $plancomptable_new->setIdDossier($courant_dossier);
                $plancomptable_new->save();
                $plan_dossier_ancicen = $plancomptables_ancien->getPlandossiercomptable()->getLast();

                $plan_dossier_new = new Plandossiercomptable();
                $plan_dossier_new->setNumerocompte($plan_dossier_ancicen->getNumerocompte());
                $plan_dossier_new->setDate(date('y-m-d'));
                $plan_dossier_new->setLibelle($plancomptables_ancien->getLibelle());
                $plan_dossier_new->setTypesolde($plan_dossier_ancicen->getTypesolde());
                $plan_dossier_new->setLettrage($plan_dossier_ancicen->getLettrage());
                $plan_dossier_new->setSolde(0.000);
                $plan_dossier_new->setIdDossier($courant_dossier);
                $plan_dossier_new->setIdExercice($exercice_id);
                $plan_dossier_new->setIdPlan($plancomptable_new->getId());
                $plan_dossier_new->setSoldeouv(0.000);
                $plan_dossier_new->save();
            }
        }

        die('ok');
    }

    //affiche detail compte comptable 

    public function executeTestexistancecompte(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $numero_compte = $params['numero_compte'];
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT plandossiercomptable.id as id, plandossiercomptable.numerocompte as numero "
                    . " FROM plancomptable,plandossiercomptable"
                    . " WHERE trim(plandossiercomptable.numerocompte) ='" . $numero_compte . "'"
                    . " and  plandossiercomptable.id_dossier =" . $_SESSION['dossier_id']
                    . " and plandossiercomptable.id_exercice=" . $_SESSION['exercice_id']
            ;

            $resultat = $conn->fetchAssoc($query);
            $resultat = json_encode($resultat);
            die($resultat);
        }

        die("Erreur");
    }

    public function executeAffecterexercice(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $dossier_id = $params['code'];
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT exercice.id as id"
                    . " FROM dossiercomptable,exercice,dossierexercice"
                    . " WHERE dossierexercice.id_dossier =" . $dossier_id
                    . " and dossierexercice.id_exercice=exercice.id"
                    . " and dossierexercice.id_dossier=dossiercomptable.id"
                    . " order by id desc"
                    . " limit 1"

            ;

            $resultat = $conn->fetchAssoc($query);
            $resultat = json_encode($resultat);
            die($resultat);
        }

        die("Erreur");
    }

    ////************************* fin import plan comptable **********
}
