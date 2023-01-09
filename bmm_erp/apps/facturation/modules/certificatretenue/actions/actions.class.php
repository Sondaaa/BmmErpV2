<?php

require_once dirname(__FILE__).'/../lib/certificatretenueGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/certificatretenueGeneratorHelper.class.php';

/**
 * certificatretenue actions.
 *
 * @package    Bmm
 * @subpackage certificatretenue
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class certificatretenueActions extends autoCertificatretenueActions
{
    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

        //Mise à jour Net TTC de l'ordonnance ( = TTC)
        $certificat = $this->getRoute()->getObject();
        $document_budget = $certificat->getDocumentbudget();
        $document_budget->setMntnet($document_budget->getMnt());
        $document_budget->save();

        if ($this->getRoute()->getObject()->delete()) {
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }

        $this->redirect('@certificatretenue');
    }

    public function executeShow(sfWebRequest $request) {
        $this->certificat = CertificatretenueTable::getInstance()->find($request->getParameter('id'));
        $this->fournisseur = $this->certificat->getFournisseur();
        $this->documentbudget = $this->certificat->getDocumentbudget();
        $this->societe = Doctrine_Core::getTable('societe')->findOneById(1);
    }

    //imprimer certificat de retenue à la source
    public function executeImprimerCertificat(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Certificat Retenue');
        $pdf->SetSubject("Certificat Retenue");

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(10, 10, 10);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
     //   ob_end_clean();
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlCertificat($id);
        $pdf->writeHTML($html, true, false, true, false, '');
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

    //imprimer recap de règlement factures
    public function executeImprimerRecap(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Certificat Retenue');
        $pdf->SetSubject("Certificat Retenue");

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(10, 10, 10);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage("L");
        $html = $this->ReadHtmlRecap($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Certificat Retenue.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlRecap($id) {
        $html = StyleCssHeader::header1();
        $mvb = new Certificatretenue();
        $html .= $mvb->ReadHtmlRecap($id);
        return $html;
    }

    public function executeImprimerListe(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Certificats de Retenue');
        $pdf->SetSubject("Liste Certificats de Retenue");
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
        $pdf->SetMargins(8, 30, 8);
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
        $html = $this->ReadHtmlListeCertificat();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Certificats de Retenue.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeCertificat() {
        $html = StyleCssHeader::header1();
        $certificat_reteunue = new Certificatretenue();
        $html .= $certificat_reteunue->ReadHtmlListeCertificat();
        return $html;
    }

}
