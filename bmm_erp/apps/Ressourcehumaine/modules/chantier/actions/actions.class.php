<?php

require_once dirname(__FILE__) . '/../lib/chantierGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/chantierGeneratorHelper.class.php';

/**
 * chantier actions.
 *
 * @package    Bmm
 * @subpackage chantier
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class chantierActions extends autoChantierActions {

    public function executeChargerOuvrierChantier(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->chantier = ChantierTable::getInstance()->find($id);
    }

    public function executeChargerOuvrierChantierFiltre(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->annee = $request->getParameter('annee');
        $this->id_ouvrier = $request->getParameter('id_ouvrier');
        $this->chantier = ChantierTable::getInstance()->find($id);
    }

    public function executeImprimerListe(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');
        $id_ouvrier = $request->getParameter('id_ouvrier');
        $annee = $request->getParameter('annee');

        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Historique Chantier');
        $pdf->SetSubject("Liste Historique Chantier");
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
        $html = $this->ReadHtmlListe($id, $id_ouvrier, $annee);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Historique Chantier' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListe($id, $id_ouvrier, $annee) {
        $html = StyleCssHeader::header1();
        $historique_contrat = new Historiquecontratouvrier();
        $html .= $historique_contrat->ReadHtmlChantierListe($id, $id_ouvrier, $annee);
        return $html;
    }

    public function executeImprimerHistorique(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id_chantier = $request->getParameter('id_chantier');
        $id_ouvrier = $request->getParameter('id_ouvrier');
        $annee = $request->getParameter('annee');

        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Historique Chantier');
        $pdf->SetSubject("Historique Chantier");
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
        $html = $this->ReadHtmlHistorique($id_chantier, $id_ouvrier, $annee);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Historique Chantier' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlHistorique($id_chantier, $id_ouvrier, $annee) {
        $html = StyleCssHeader::header1();
        $historique_contrat = new Historiquecontratouvrier();
        $html .= $historique_contrat->ReadHtmlChantierHistorique($id_chantier, $id_ouvrier, $annee);
        return $html;
    }

}
