<?php

require_once dirname(__FILE__) . '/../lib/declarationGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/declarationGeneratorHelper.class.php';

/**
 * declaration actions.
 *
 * @package    Bmm
 * @subpackage declaration
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class declarationActions extends autoDeclarationActions {

    public function executeChargerOrdonnance(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut');
        $date_fin = $request->getParameter('date_fin');
        $id_caissebanque = $request->getParameter('id_caissebanque');

        $ordonnances = DocumentbudgetTable::getInstance()->getOrdonnanceNonDeclare($date_debut, $date_fin, $id_caissebanque);
        return $this->renderPartial("ordonnances", array("ordonnances" => $ordonnances));
    }

    public function executeChargerOrdonnanceChoisi(sfWebRequest $request) {
        $ids = $request->getParameter('ids');
        $ids = substr($ids, 0, -1);
        $ids = explode(',', $ids);

        $ordonnances = DocumentbudgetTable::getInstance()->getByListeId($ids);
        return $this->renderPartial("ordonnances_choisi", array("ordonnances" => $ordonnances));
    }

    public function executeSaveDeclaration(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut');
        $date_fin = $request->getParameter('date_fin');
        $id_caissebanque = $request->getParameter('id_caissebanque');
        $libelle = $request->getParameter('libelle');
        $montant = $request->getParameter('montant');

        $ids = $request->getParameter('ids');
        $ids = substr($ids, 0, -1);
        $ids = explode(',', $ids);

        $declaration = new Declaration();

        $declaration->setLibelle($libelle);
        $declaration->setMontant($montant);
        $declaration->setDatedebut($date_debut);
        $declaration->setDatefin($date_fin);
        $declaration->setDatecreation(date('Y-m-d'));
        $declaration->setIdCaissebanque($id_caissebanque);
        $declaration->setEtat(false);

        $declaration->save();

        $ordonnances = DocumentbudgetTable::getInstance()->getByListeId($ids);
        foreach ($ordonnances as $ordonnance) {
            $ordonnance->setIdDeclaration($declaration->getId());
            $ordonnance->save();
        }

        return $this->renderText('OK');
    }

    public function executeShow(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->declaration = DeclarationTable::getInstance()->find($id);
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

        $declaration = $this->getRoute()->getObject();
        $ordonnances = $declaration->getDocumentbudget();
        foreach ($ordonnances as $ordonnance) {
            $ordonnance->setIdDeclaration(null);
            $ordonnance->save();
        }

        if ($this->getRoute()->getObject()->delete()) {
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }

        $this->redirect('@declaration');
    }

    public function executeImprimerListe(sfWebRequest $request) {
        $pdf = new sfTCPDF('L');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Déclaration');
        $pdf->SetSubject("Liste Déclaration");
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
        $html = $this->ReadHtmlListeDeclaration();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Déclaration.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeDeclaration() {
        $html = StyleCssHeader::header1();
        $declaration = new Declaration();
        $html .= $declaration->ReadHtmlListeDeclaration();
        return $html;
    }

    public function executeImprimer(sfWebRequest $request) {
        $pdf = new sfTCPDF('L');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Déclaration');
        $pdf->SetSubject("Fiche Déclaration");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getRs();
        $pdf->SetAuthor($entete);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');
// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
        $html = $this->ReadHtmlDeclaration($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Fiche Déclaration.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlDeclaration(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $declaration = new Declaration();
        $html .= $declaration->ReadHtmlDeclaration($request);
        return $html;
    }

}
