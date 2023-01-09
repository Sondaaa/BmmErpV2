
<?php

require_once dirname(__FILE__) . '/../lib/lignemouvementfacturationGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/lignemouvementfacturationGeneratorHelper.class.php';

/**
 * lignemouvementfacturation actions.
 *
 * @package    Bmm
 * @subpackage lignemouvementfacturation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class lignemouvementfacturationActions extends autoLignemouvementfacturationActions {

    public function executeGetLastOrder(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $date = strtoupper($params['date']);
            $q = Doctrine_Query::create()
                    ->select("ordre")
                    ->from('lignemouvementfacturation')
                    ->where("EXTRACT (YEAR FROM date) = " . date('Y', strtotime($date)))
                    ->orderBy('ordre desc')
                    ->limit('1');
        }

        $order = $q->fetchArray();
        die(json_encode($order));
    }

    public function executeSavemouvement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params1 = json_decode($content, true);

            $operations = $params1['operations'];
            foreach ($operations as $params) {
                $numero = $params['nb'];
                $date_mouvement = $params['date_mouvement'];
                $numerofacture = $params['numerofacture'];
                $montant = $params['montant'];
                $id_documentachat = $params['id_documentachat'];
                $rrs = $params['rrs'];
                $pvr = $params['pvr'];
                $taux_pourcentage = $params['taux_pourcentage'];
                $date_rrs_pvr = $params['date_rrs_pvr'];
                $id_fournisseur = $params['id_fournisseur'];
                $valide = $params['valide'];
                $etat_frs = $params['etat_frs'];

                $mouvement = new Lignemouvementfacturation();
                if ($numero)
                    $mouvement->setOrdre($numero);
                if ($date_mouvement)
                    $mouvement->setDate($date_mouvement);
                if ($numerofacture)
                    $mouvement->setNumerofacture($numerofacture);
                if ($montant)
                    $mouvement->setMontant($montant);
                if ($id_documentachat)
                    $mouvement->setIdDocumentachat($id_documentachat);
                if ($rrs)
                    $mouvement->setRrs($rrs);
                if ($pvr)
                    $mouvement->setPvr($pvr);
                if ($date_rrs_pvr)
                    $mouvement->setDaterrspvr($date_rrs_pvr);
                if ($id_fournisseur)
                    $mouvement->setIdFournisseur($id_fournisseur);
                if ($valide == "true")
                    $mouvement->setValide(true);
                else
                    $mouvement->setValide(false);

                if ($etat_frs)
                    $mouvement->setEtatfrs($etat_frs);
                if ($taux_pourcentage)
                    $mouvement->setTauxpourcetage($taux_pourcentage);
                $mouvement->save();
                $historique = new Historiquemouvement();
                if ($id_fournisseur)
                    $historique->setIdFrs($id_fournisseur);
                if ($mouvement->getId())
                    $historique->setIdLignemvt($mouvement->getId());
                if ($etat_frs)
                    $historique->setEtatfrs($etat_frs);
                $historique->setDatecreation(date('Y-m-d'));
                $historique->save();
            }

            die("Succés d'\enregistrement");
        }
    }

    public function executeJournal(sfWebRequest $request) {
        $this->idtype = $request->getParameter('idtype', '');
        $this->fournisseurs = FournisseurTable::getInstance()->getAll();
    }

    public function executeShowEditEtatFrs(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->mvt = LignemouvementfacturationTable::getInstance()->find($id);
    }

    public function executeEditEtatFournisseur(sfWebRequest $request) {
        $this->mvt = LignemouvementfacturationTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeUpdateEtatFournisseur(sfWebRequest $request) {
        $etat = $request->getParameter('etat_frs');
        $id = $request->getParameter('id');
        $mouvement = LignemouvementfacturationTable::getInstance()->find($id);
        $mouvement->setEtatfrs($etat);
        $mouvement->save();
        $historique = new Historiquemouvement();
        if ($mouvement->getIdFournisseur())
            $historique->setIdFrs($mouvement->getIdFournisseur());
        if ($mouvement->getId())
            $historique->setIdLignemvt($mouvement->getId());
        if ($etat)
            $historique->setEtatfrs($etat);
        $historique->setDatecreation(date('Y-m-d'));
        $historique->save();
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $facture = $request->getParameter('facture', '');
        $fournisseur_id = $request->getParameter('fournisseur_id', '');
        $idtype = $request->getParameter('idtype', '');
        $valide = $request->getParameter('valide', '');
        $mouvements = LignemouvementfacturationTable::getInstance()->findAllMouvement($date_debut, $date_fin, $fournisseur_id, $facture, $idtype, $valide);
        return $this->renderPartial("list_journal", array("mouvements" => $mouvements, "date_debut" => $date_debut, "date_fin" => $date_fin, "fournisseur_id" => $fournisseur_id, "idtype" => $idtype, "facture" => $facture, "valide" => $valide));
    }

    public function executeGoPageJournal(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $facture = $request->getParameter('facture', '');
        $fournisseur_id = $request->getParameter('fournisseur_id', '');
        $idtype = $request->getParameter('idtype', '');
        $valide = $request->getParameter('valide', '');
        $etatfrs = $request->getParameter('etatfrs', '');
        $mouvements = LignemouvementfacturationTable::getInstance()->findAllMouvement($date_debut, $date_fin, $fournisseur_id, $facture, $idtype, $valide, $etatfrs);
        return $this->renderPartial("list_journal", array("mouvements" => $mouvements, "date_debut" => $date_debut, "date_fin" => $date_fin, "fournisseur_id" => $fournisseur_id, "idtype" => $idtype, "facture" => $facture, "valide" => $valide));
    }

    public function executeImprimerJournalMouvement(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $facture = $request->getParameter('facture', '');
        $fournisseur_id = $request->getParameter('fournisseur_id', '');
        $idtype = $request->getParameter('idtype', '');
        $valide = $request->getParameter('valide', '');

        $pdf = new sfTCPDF('L');

// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Journal Mouvements Bancaires/CCP');
        $pdf->SetSubject("Journal Mouvements Bancaires/CCP");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
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
        $html = $this->ReadHtmlJournalMouvement($date_debut, $date_fin, $fournisseur_id, $facture, $idtype, $valide);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Journal Mouvements Bancaires-CCP.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlJournalMouvement($date_debut, $date_fin, $fournisseur_id, $facture, $idtype, $valide) {
        $html = StyleCssHeader::header1();
        $mvb = new Lignemouvementfacturation();
        $html .= $mvb->ReadHtmlMouvements($date_debut, $date_fin, $fournisseur_id, $facture, $idtype, $valide);
        return $html;
    }

    public function executeImprimerMouvement(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $pdf = new sfTCPDF('L');
// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Registre des Mouvements');
        $pdf->SetSubject("Registre des Mouvements");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
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
        $html = $this->ReadHtmlMouvement();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Journal Mouvements Bancaires-CCP.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlMouvement() {
        $html = StyleCssHeader::header1();
        $mvb = new Lignemouvementfacturation();
        $html .= $mvb->ReadHtmlListesdesMouvements();
        return $html;
    }

    public function executeShowHistorique(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->document = DocumentachatTable::getInstance()->find($id);
        $this->mouvements = LignemouvementfacturationTable::getInstance()->findByIdDocumentachat($id);
    }

    public function executeShowHistoriqueContrat(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->document = DocumentachatTable::getInstance()->find($id);
        $this->mouvements = LignemouvementfacturationTable::getInstance()->findByIdDocumentachat($id);
    }

    public function executeValider(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $mouvement = LignemouvementfacturationTable::getInstance()->find($id);
        $mouvement->setValide(true);
        $mouvement->save();

        return $this->renderText('Ok');
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->lignemouvementfacturation = $this->form->getObject();
        $this->id = $request->getParameter('id');
    }

    public function executeNewMvtBDCregroupe(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->lignemouvementfacturation = $this->form->getObject();
        $this->id = $request->getParameter('id');
    }

    public function executeNewMvtBDCG(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->lignemouvementfacturation = $this->form->getObject();
        $this->id = $request->getParameter('id');
    }

    public function executeNewMvtContratPartiel(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->lignemouvementfacturation = $this->form->getObject();
        $this->id = $request->getParameter('id');
    }

    public function executeNouveaumouvement(sfWebRequest $request) {

        $this->id = $request->getParameter('id');
    }

    public function executeNouveaumouvementstandard(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->lignemouvementfacturation = $this->form->getObject();

        $this->id = $request->getParameter('id');
    }

    public function executeAfficherMouvementPardate(sfWebRequest $request) {
//        $date_mouvement = $request->getParameter('date_mouvement', '');
        $listelignemouvement = LignemouvementfacturationTable::getInstance()->getByDate();
//        die(json_encode($listelignemouvement) . sizeof($listelignemouvement));
        return $this->renderPartial("mouvement_par_date", array("listelignemouvement" => $listelignemouvement));
    }

    public function executeAfficherMouvementBDCREg(sfWebRequest $request) {
        $listelignemouvement = LignemouvementfacturationTable::getInstance()->getByBDCRegrouppe();
        return $this->renderPartial("mouvement_par_date", array("listelignemouvement" => $listelignemouvement));
    }

    public function executeAfficherMouvementContrat(sfWebRequest $request) {
        $listelignemouvement = LignemouvementfacturationTable::getInstance()->getByBCIContrat();
//        die(json_encode($listelignemouvement). sizeof($listelignemouvement));
        return $this->renderPartial("mouvement_par_date", array("listelignemouvement" => $listelignemouvement));
    }

    public function executeTesterExistancefacture(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $mvt = LignemouvementfacturationTable::getInstance()->find($id);
        $id_docachat = $mvt->getIdDocumentachat();
        $msg = 'bien';
        $docachat = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($id_docachat, 15);
        if ($docachat)
            $msg = 1;
        else
            $msg = 0;
        return $this->renderText($msg);
    }

    public function executeDelete(sfWebRequest $request) {
        $this->supprimerPiece($request);
        $this->pager = $this->paginate($request);
        $this->page = $request->getParameter('page', 1);
    }

    public function paginate(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);

        $date = $request->getParameter('date');
        $pager = new sfDoctrinePager('Lignemouvementfacturation', 10);
        $pager->setQuery(LignemouvementfacturationTable::getInstance()->loadAllBydate($date));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function supprimerPiece(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $piece = LignemouvementfacturationTable::getInstance()->find($id);
        $piece->delete();
    }

}
