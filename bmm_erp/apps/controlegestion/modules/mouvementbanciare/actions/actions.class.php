<?php

require_once dirname(__FILE__) . '/../lib/mouvementbanciareGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/mouvementbanciareGeneratorHelper.class.php';

/**
 * mouvementbanciare actions.
 *
 * @package    Bmm
 * @subpackage mouvementbanciare
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mouvementbanciareActions extends autoMouvementbanciareActions {

    //_________________________________________________Ajouter nouveau fiche par type: BCI
    public function executeSavemouvement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $soldefinal = 0;
        $banqueid = -1;
        $ids = '';
        if (!empty($content)) {
            $params1 = json_decode($content, true);

            $operations = $params1['operations'];
            foreach ($operations as $params) {
                $idbanque = $params['id_banque'];
                $banqueid = $idbanque;
                $numero = $params['nb'];
                $reford = $params['reford'];
                $id_object = $params['id_object'];
                $refbenifi = $params['refbenifi'];
                $debit = $params['debit'];
                $credit = $params['credit'];
                $solde = $params['solde'];
                $dateoperation = $params['dateoperation'];
                $nomoperation = $params['nomoperation'];
                $refinstrument = $params['refinstrument'];
                $id_documentachat = $params['id_documentachat'];

                $mouvement = new Mouvementbanciare();
                $mouvement->setNumero($numero);
                $mouvement->setNomoperation($nomoperation);
                $mouvement->setReford($reford);
                if ($id_documentachat)
                    $mouvement->setIdDocumentachat($id_documentachat);
                $mouvement->setIdBanque($idbanque);
                $mouvement->setIdObject($id_object);
                $mouvement->setReferenceautre($refinstrument);
                if ($credit != "")
                    $mouvement->setCredit($credit);
                if ($debit != "") {
                    $mouvement->setDebit($debit);
                }

                $mouvement->setRefbenifi($refbenifi);
                $mouvement->setDateoperation($dateoperation);
                $mouvement->setSolde($solde);

                $mouvement->save();

                //Ajout du mouvement lié au compte cible du transfert du compte au compte ou caisse.
                if ($id_object == 4) {
                    $id_banque_cible = $params['id_banque_cible'];
                    $mouvement_cible = new Mouvementbanciare();
                    //trouver le numéro suivant pour le mouvement du compte
                    $mvt = MouvementbanciareTable::getInstance()->getLastOpeartionInCompte($id_banque_cible);
                    if ($mvt != null)
                        $numero_cible = intval(intval($mvt->getNumero()) + 1);
                    else
                        $numero_cible = 1;
                    $mouvement_cible->setNumero($numero_cible);
                    $mouvement_cible->setNomoperation($nomoperation);
                    $mouvement_cible->setReford($reford);
                    if ($id_documentachat)
                        $mouvement_cible->setIdDocumentachat($id_documentachat);
                    $mouvement_cible->setIdBanque($id_banque_cible);
                    $mouvement_cible->setIdObject($id_object);
                    $mouvement_cible->setReferenceautre($numero_cheque);
                    //Calculer le nouveau solde du compte cible
                    $banque_cible = CaissesbanquesTable::getInstance()->find($id_banque_cible);
                    $solde_cible = $banque_cible->getMntdefini();
                    //inverser le crédit et le débit par rapport au compte précédent
                    if ($credit != "") {
                        $mouvement_cible->setDebit($credit);
                        $solde_cible = $solde_cible - $credit;
                    }
                    if ($debit != "") {
                        $mouvement_cible->setCredit($debit);
                        $solde_cible = $solde_cible + $debit;
                    }
                    //Set les paramètres du bénéficiaire (1èr compte est le bénéficiaire du 2ème compte et vice versa)
                    $banque = CaissesbanquesTable::getInstance()->find($banqueid);
                    $mouvement_cible->setRefbenifi($banque->getLibelle());
                    $mouvement_cible->setDateoperation($dateoperation);
                    $mouvement_cible->setSolde($solde_cible);
                    //Set id mouvement précédent.
                    $mouvement_cible->setIdMouvement($mouvement->getId());
                    $mouvement_cible->save();

                    $banque_cible->setMntdefini($solde_cible);
                    $banque_cible->save();
                }

                $ids = $ids . $mouvement->getId() . '-';
                $soldefinal = $solde;
            }

            $banque = new Caissesbanques();
            $banque = Doctrine_Core::getTable('caissesbanques')->findOneById($banqueid);

            $banque->setMntdefini($soldefinal);
            $banque->save();

            die("" . $ids);
        }
    }

    public function executeShow(sfWebRequest $request) {
        $ids = $request->getParameter('ids');
        $this->ids = $ids;
        $ids = substr($ids, 0, -1);
        $ids = explode('-', $ids);

        $this->mouvements = MouvementbanciareTable::getInstance()->getByListeId($ids);
    }

    public function executeIndex(sfWebRequest $request) {
        $this->caisses = CaissesbanquesTable::getInstance()->findAll();
    }

    //imprimer mouvements banque
    public function executeImprimerMouvementCaisse(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $ids = $request->getParameter('ids');
        $ids = substr($ids, 0, -1);
        $ids = explode('-', $ids);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Mouvements');
        $pdf->SetSubject("Mouvements");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
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
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlMouvementCaisse($ids);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Mouvements.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlMouvementCaisse($ids) {
        $html = StyleCssHeader::header1();
        $mvb = new Mouvementbanciare();
        $html .= $mvb->ReadHtmlMouvementsCaisse($ids);
        return $html;
    }

    public function executeGoPage(sfWebRequest $request) {
        $pager = $this->getAllMouvements($request);
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');
        return $this->renderPartial("list", array("pager" => $pager, "date_debut" => $date_debut, "date_fin" => $date_fin, "id_banque" => $id_banque));
    }

    function getAllMouvements(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');
        $type = $request->getParameter('type', 'tout');

        $pager = new sfDoctrinePager('Mouvementbanciare', 10);
        $pager->setQuery(MouvementbanciareTable::getInstance()->getAllMouvement($date_debut, $date_fin, $id_banque, $type));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeImprimerSearchMouvementCaisse(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Mouvements Caisse');
        $pdf->SetSubject("Mouvements Caisse");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
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
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlSearchMouvementCaisse($date_debut, $date_fin, $id_banque);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Mouvements Caisse.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlSearchMouvementCaisse($date_debut, $date_fin, $id_banque) {
        $html = StyleCssHeader::header1();
        $mvb = new Mouvementbanciare();
        $html .= $mvb->ReadHtmlSearchMouvementsCaisse($date_debut, $date_fin, $id_banque);
        return $html;
    }

    public function executeJournal(sfWebRequest $request) {
        $this->caisses = CaissesbanquesTable::getInstance()->findAll();
        $this->fournisseurs = FournisseurTable::getInstance()->getAllOrderByRaisonSociale();
    }

    public function executeGoPageJournal(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');
        $type = $request->getParameter('type', 'tout');
        $mouvements = MouvementbanciareTable::getInstance()->findAllMouvement($date_debut, $date_fin, $id_banque);
        return $this->renderPartial("list_journal", array("mouvements" => $mouvements, "date_debut" => $date_debut, "date_fin" => $date_fin, "id_banque" => $id_banque, "type" => $type));
    }

    public function executeImprimerJournalMouvementCaisse(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');
        $type = $request->getParameter('type', 'tout');

        $pdf = new sfTCPDF('L');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Journal Mouvements Caisse');
        $pdf->SetSubject("Journal Mouvements Caisse");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
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
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlJournalMouvementCaisse($date_debut, $date_fin, $id_banque, $type);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Journal Mouvements Caisse.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlJournalMouvementCaisse($date_debut, $date_fin, $id_banque, $type) {
        $html = StyleCssHeader::header1();
        $mvb = new Mouvementbanciare();
        $html .= $mvb->ReadHtmlJournalMouvementsCaisse($date_debut, $date_fin, $id_banque, $type);
        return $html;
    }

    public function executeListeBonDepenseComptant(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idbanque'];
            $q = Doctrine_Query::create()
                    ->select("da.id as id, da.numero as libelle")
                    ->from('Documentachat da')
                    ->leftJoin('da.Ligneoperationcaisse l')
                    ->where('da.id_typedoc=2')
                    ->andwhere('l.id_caisse=' . $id)
                    ->andwhere('da.id NOT IN (SELECT DISTINCT(Piecejointbudget.id_docachat) FROM Piecejointbudget, documentbudget WHERE Piecejointbudget.id_documentbudget = documentbudget.id AND documentbudget.id_type=2)')
//                    ->andWhere('da.id NOT IN (SELECT DISTINCT(mb.id_documentachat) FROM mouvementbanciare mb where mb.id_documentachat IS NOT NULL)')
                    ->orderBy('da.numero')
                    ->fetchArray();
            die(json_encode($q));
        }
        die('Erreur');
    }

    public function executeDetailsBonDepensesComptant(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];

            $q = Doctrine_Query::create()
                    ->from('Documentachat da')
                    ->leftJoin('da.Fournisseur f')
                    ->select("da.id as id,da.numero as numero, da.mntttc as mnt, f.id as fournisseur_id, f.rs as fournisseur_rs")
                    ->where('da.id=' . $id)
                    ->fetchArray();
            die(json_encode($q));
        }
        die('Erreur');
    }

    public function executeSupprimerMouvement(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $mvt = MouvementbanciareTable::getInstance()->find($id);

        if ($mvt->getIdObject() == 4) {
            //Traitement sur solde compte & suppression en cas : objet de règlement = transfert
            //mouvement parent
            $mvt_parent = MouvementbanciareTable::getInstance()->find($mvt->getIdMouvement());
            if ($mvt_parent != null) {
                //Mise à jour du solde du compte du mouvement parent
                $banque_parent = CaissesbanquesTable::getInstance()->find($mvt_parent->getIdBanque());
                $soldefinal = 0;
                if ($mvt_parent->getCredit() != null)
                    $soldefinal = $banque_parent->getMntdefini() - $mvt_parent->getCredit();
                else
                    $soldefinal = $banque_parent->getMntdefini() + $mvt_parent->getDebit();

                if ($mvt_parent->getMntenoper() != null)
                    $soldefinal = $soldefinal + $mvt_parent->getMntenoper();

                $banque_parent->setMntdefini($soldefinal);
                $banque_parent->save();

                $mvt_parent->delete();
            }
            //$mouvement fils
            $mvt_fils = MouvementbanciareTable::getInstance()->findOneByIdMouvement($mvt->getId());
            if ($mvt_fils != null) {
                //Mise à jour du solde du compte du mouvement fils
                $banque_fils = CaissesbanquesTable::getInstance()->find($mvt_fils->getIdBanque());
                $soldefinal = 0;
                if ($mvt_parent->getCredit() != null)
                    $soldefinal = $banque_fils->getMntdefini() - $mvt_fils->getCredit();
                else
                    $soldefinal = $banque_fils->getMntdefini() + $mvt_fils->getDebit();

                if ($mvt_parent->getMntenoper() != null)
                    $soldefinal = $soldefinal + $mvt_fils->getMntenoper();

                $banque_fils->setMntdefini($soldefinal);
                $banque_fils->save();

                //Pas de traitement du chèque pour le mouvement fils

                $mvt_fils->delete();
            }
        }

        //Mise à jour du solde du compte
        $banque = CaissesbanquesTable::getInstance()->find($mvt->getIdBanque());
        $soldefinal = 0;
        if ($mvt->getCredit() != null)
            $soldefinal = $banque->getMntdefini() - $mvt->getCredit();
        else
            $soldefinal = $banque->getMntdefini() + $mvt->getDebit();

        if ($mvt->getMntenoper() != null)
            $soldefinal = $soldefinal + $mvt->getMntenoper();

        $banque->setMntdefini($soldefinal);
        $banque->save();

        $mvt->delete();

        //Ré-numérotation des mouvements suivants pour garder la succession des numéros
        $mvts = MouvementbanciareTable::getInstance()->setNumerotation($id);
        foreach ($mvts as $mvt) {
            $nouveau_numero = $mvt->getNumero() - 1;
            $mvt->setNumero($nouveau_numero);
            $mvt->save();
        }

        $pager = $this->getAllMouvements($request);
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');
        return $this->renderPartial("list", array("pager" => $pager, "date_debut" => $date_debut, "date_fin" => $date_fin, "id_banque" => $id_banque));
    }

    public function executeEtatordonnance(sfWebRequest $request) {
        $this->id = $request->getParameter('id');
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
         $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
       $soc = $societe;
        $entete =  $soc->getMinistere();
        $rs=$soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');

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
        $pdf->SetMargins(5, 10, 5);
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
        $html = $this->ReadHtmlOrdonnance($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Ordonnance de Paiement.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlOrdonnance($id) {
        $html = StyleCssHeader::header1();
        $document_budget = new Documentbudget();
        $html .= $document_budget->ReadHtmlOrdonnance($id);
        return $html;
    }

    public function executeRapprochement(sfWebRequest $request) {
        $this->banques = CaissesbanquesTable::getInstance()->getAllBanque();
    }

    function getAllMouvementsForRapprochement(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');
        $rapproche = $request->getParameter('rapproche', 'false');

        $pager = new sfDoctrinePager('Mouvementbanciare', 10);
        $pager->setQuery(MouvementbanciareTable::getInstance()->getAllMouvementRapprochement($date_debut, $date_fin, $id_banque, $rapproche));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeGoPageRapprochement(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');
        $mouvements = MouvementbanciareTable::getInstance()->findAllMouvementRapprochement($date_debut, $date_fin, $id_banque);
        return $this->renderPartial("list_rapprochement", array("mouvements" => $mouvements, "date_debut" => $date_debut, "date_fin" => $date_fin, "id_banque" => $id_banque));
    }

    public function executeStatistiqueBanque(sfWebRequest $request) {
        
    }

    public function executeAfficherStatCompte(sfWebRequest $request) {
        $annee = $request->getParameter('annee');
        $mois = $request->getParameter('mois');

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $query = "SELECT mouvementbanciare.id_banque as id_banque, COALESCE(SUM(COALESCE(mouvementbanciare.debit, 0)), 0) as totaldebit, "
                . " COALESCE(SUM(COALESCE(mouvementbanciare.mntenoper, 0)), 0) as totalmntoper, caissesbanques.libelle as libellecaisse"
                . " FROM  mouvementbanciare, caissesbanques "
                . " WHERE (TO_CHAR(mouvementbanciare.dateoperation, 'yyyy-mm'))= '" . $annee . "-" . $mois . "'"
                . " AND mouvementbanciare.annule=false"
                . " AND mouvementbanciare.id_banque IN (select caissesbanques.id from caissesbanques where caissesbanques.id_typecb = 2)"
                . " AND mouvementbanciare.id_banque = caissesbanques.id"
                . " GROUP BY mouvementbanciare.id_banque, caissesbanques.libelle"
                . " ORDER BY mouvementbanciare.id_banque";

        $total_comptes = $conn->fetchAssoc($query);

        $query_rubriques = "SELECT mouvementbanciare.id_banque as id_banque, COALESCE(SUM(COALESCE(documentbudget.mntnet, 0)), 0) as total, "
                . " rubrique.libelle as libellerubrique"
                . " FROM  mouvementbanciare, ligprotitrub, documentbudget, rubrique "
                . " WHERE (TO_CHAR(mouvementbanciare.dateoperation, 'yyyy-mm'))= '" . $annee . "-" . $mois . "'"
                . " AND mouvementbanciare.annule=false"
                . " AND mouvementbanciare.id_banque IN (select caissesbanques.id from caissesbanques where caissesbanques.id_typecb = 2)"
                . " AND mouvementbanciare.id_documentbudget = documentbudget.id"
                . " AND documentbudget.id_budget = ligprotitrub.id"
                . " AND ligprotitrub.id_rubrique = rubrique.id"
                . " GROUP BY mouvementbanciare.id_banque, rubrique.libelle"
                . " ORDER BY mouvementbanciare.id_banque";

        $this->rubriques = $conn->fetchAssoc($query_rubriques);

        $this->total_tous = 0;
        $this->liste = array();
        for ($j = 0; $j < sizeof($total_comptes); $j++) {
            $this->liste[$total_comptes[$j]['id_banque']]['total'] = $total_comptes[$j]['totaldebit'] + $total_comptes[$j]['totalmntoper'];
            $this->liste[$total_comptes[$j]['id_banque']]['libellecaisse'] = $total_comptes[$j]['libellecaisse'];
            $this->total_tous = $this->total_tous + $total_comptes[$j]['totaldebit'] + $total_comptes[$j]['totalmntoper'];
        }

        $this->comptes = CaissesbanquesTable::getInstance()->getAllBanque();
        $this->mois = $mois;
        $this->annee = $annee;
    }

}
