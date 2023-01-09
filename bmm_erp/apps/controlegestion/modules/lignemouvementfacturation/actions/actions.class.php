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
                $date_rrs_pvr = $params['date_rrs_pvr'];
                $id_fournisseur = $params['id_fournisseur'];

                $mouvement = new Lignemouvementfacturation();

                $mouvement->setOrdre($numero);
                $mouvement->setDate($date_mouvement);
                $mouvement->setNumerofacture($numerofacture);
                $mouvement->setMontant($montant);
                $mouvement->setIdDocumentachat($id_documentachat);
                $mouvement->setRrs($rrs);
                $mouvement->setPvr($pvr);
                $mouvement->setDaterrspvr($date_rrs_pvr);
                $mouvement->setIdFournisseur($id_fournisseur);

                $mouvement->save();
            }

            die("Succés d'\enregistrement");
        }
    }

    public function executeJournal(sfWebRequest $request) {
        $this->idtype = $request->getParameter('idtype', '');
        $this->fournisseurs = FournisseurTable::getInstance()->getAllOrderByRaisonSociale();
    }

    public function executeGoPageJournal(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $facture = $request->getParameter('facture', '');
        $fournisseur_id = $request->getParameter('fournisseur_id', '');
        $idtype = $request->getParameter('idtype', '');
        $valide = $request->getParameter('valide', 'true');
        $mouvements = LignemouvementfacturationTable::getInstance()->findAllMouvement($date_debut, $date_fin, $fournisseur_id, $facture, $idtype, $valide);
        if($idtype == '')
            $idtype = 0;
        if($facture == '')
            $facture = '*';
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
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(7, 30, 7);
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

    public function executeShowHistorique(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->document = DocumentachatTable::getInstance()->find($id);
        $this->mouvements = LignemouvementfacturationTable::getInstance()->findByIdDocumentachat($id);
    }

    public function executeDetailsFacture(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $documentachat = DocumentachatTable::getInstance()->find($id);
        $this->mvt = LignemouvementfacturationTable::getInstance()->findByIdDocumentachat($id)->getLast();
        $type_doc = $documentachat->getIdTypedoc();
        if ($type_doc = 2) {
            $this->documentachat = $documentachat;
        } else {
            while ($type_doc != '15') {
                $documentachat = DocumentachatTable::getInstance()->findOneByIdDocparent($documentachat->getId());
                $type_doc = $documentachat->getIdTypedoc();
            }
            $this->documentachat = $documentachat;
        }
    }

}
