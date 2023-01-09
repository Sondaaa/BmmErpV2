<?php

require_once dirname(__FILE__) . '/../lib/certificatretenueGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/certificatretenueGeneratorHelper.class.php';

/**
 * certificatretenue actions.
 *
 * @package    Bmm
 * @subpackage certificatretenue
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class certificatretenueActions extends autoCertificatretenueActions {

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

}
