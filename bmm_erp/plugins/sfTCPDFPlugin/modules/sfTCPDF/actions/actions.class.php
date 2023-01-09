<?php

/**
 * sfTCPDF actions.
 *
 * @package    sfTCPDFPlugin
 * @author     Vernet Loïc aka COil <qrf_coil@yahoo.fr>
 * @since      16 march 2007
 */
require_once(dirname(__FILE__) . '/../lib/BasesfTCPDFActions.class.php');

class sfTCPDFActions extends BasesfTCPDFActions {

//imprimer attestation
//    public function executeImprimerattestation(sfWebRequest $request) {
//        $config = sfTCPDFPluginConfigHandler::loadConfig();
//
//        $doc = new Contrat();
//        $iddoc = $request->getParameter('iddoc');
//        $documentachat = Doctrine_Core::getTable('contrat')->findOneById($iddoc);
//        $doc = $documentachat;
//        $pdf = new sfTCPDF();
//
//        // set document information
//        $pdf->SetCreator(PDF_CREATOR);
//
//        $pdf->SetTitle('Fiche Attestation N°:');
//        $pdf->SetSubject("document du contrat");
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getMinistere();
//        $rs = $soc->getRs();
//        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
//        $pdf->SetAuthor($entete);
//        $pdf->SetAuthor($rs);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//// set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//// set default monospaced font
//        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//// set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
//// set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//// set image scale factor
//        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//// set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }
//        $pdf->SetFont('dejavusans', '', 10, '', true);
//        $pdf->AddPage();
//        $html = $this->ReadHtmlPersonnelle($doc);
//        $pdf->writeHTML($html, true, false, true, false, '');
//        $pdf->Output('contrat' . $doc->getIdAgents() . $doc->getId() . '.pdf', 'I');
//
//        // Stop symfony process
//        throw new sfStopException();
//    }
//
//    public function ReadHtmlPersonnelle($document) {
//        $html = StyleCssHeader::header1();
//        // die('dd'.$document->getId().''.$document->getDateouvert());
//        $html .= $document->ReadHtmlAttestation();
//
//        return $html;
//    }

//    public function executeImprimerattestationdesalaire(sfWebRequest $request) {
//        $config = sfTCPDFPluginConfigHandler::loadConfig();
//
//        $doc = new Contrat();
//        $iddoc = $request->getParameter('iddoc');
//        $documentachat = Doctrine_Core::getTable('contrat')->findOneById($iddoc);
//        $doc = $documentachat;
//        $pdf = new sfTCPDF();
//
//        // set document information
//        $pdf->SetCreator(PDF_CREATOR);
//
//        $pdf->SetTitle('Fiche Attestation de salaire:');
//        $pdf->SetSubject("document du contrat");
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getMinistere();
//        $rs = $soc->getRs();
//        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
//        $pdf->SetAuthor($entete);
//        $pdf->SetAuthor($rs);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//// set default monospaced font
//        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//// set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
//// set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//// set image scale factor
//        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//// set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }
//        $pdf->SetFont('dejavusans', '', 10, '', true);
//        $pdf->AddPage();
//        $html = $this->ReadHtmlAttestationdesalaire($doc);
//        $pdf->writeHTML($html, true, false, true, false, '');
//        $pdf->Output('contrat' . $doc->getIdAgents() . $doc->getId() . '.pdf', 'I');
//
//        // Stop symfony process
//        throw new sfStopException();
//    }
//
//    public function ReadHtmlAttestationdesalaire($document) {
//        $html = StyleCssHeader::header1();
//        $html .= $document->ReadHtmlAttestationSalaire();
//
//        return $html;
//    }

//    public function executeImprimerprovisoirecaiise(sfWebRequest $request) {
//        $config = sfTCPDFPluginConfigHandler::loadConfig();
//        // $iddoc = $request->getParameter('iddoc');
//        $id = $request->getParameter('idfiche');
//        //  $doc_budget = $doc = Doctrine_Core::getTable('documentbudget')->findOneById($id);
//
//        $ligneoperationcaisse = Doctrine_Core::getTable('ligneoperationcaisse')->findOneById($id);
//
//        $pdf = new sfTCPDF();
//
//        // set document information
//        $pdf->SetCreator(PDF_CREATOR);
//
//        $pdf->SetTitle('Fiche Bufget N°:');
//        $pdf->SetSubject("fiche bidget");
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getMinistere();
//        $rs = $soc->getRs();
//        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
//        $pdf->SetAuthor($entete);
//        $pdf->SetAuthor($rs);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//
//
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//// set default monospaced font
//        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//// set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
//// set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//// set image scale factor
//        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//// set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }
//
//        // Set font
//        // dejavusans is a UTF-8 Unicode font, if you only need to
//        // print standard ASCII chars, you can use core fonts like
//        // dejavusans or times to reduce file size.
//        $pdf->SetFont('dejavusans', '', 10, '', true);
//        ob_end_clean();
////$pdf->SetFont('dejavusans', '', 12);
//        // Add a page
//        // This method has several options, check the source code documentation for more information.
//        $pdf->AddPage();
////      
//
//
//        $html = $this->ReadHtmlDocProvisoirecaisse($ligneoperationcaisse);
//
//        // Print text using writeHTMLCell()
//        // output the HTML content
//        $pdf->writeHTML($html, true, false, true, false, '');
//
//
//        // ---------------------------------------------------------
//        // Close and output PDF document
//        // This method has several options, check the source code documentation for more information.
//        $pdf->Output('titre_' . $id . '.pdf', 'I');
//
//        // Stop symfony process
//        throw new sfStopException();
//    }
//
//    public function ReadHtmlDocProvisoirecaisse($ligneoperation) {
//        $html = StyleCssHeader::header1();
//        $html.=$ligneoperation->getHtmlDocProvisoirecaisse();
//
//        return $html;
//    }
//    public function executeImprimerprovisoire(sfWebRequest $request) {
//        $config = sfTCPDFPluginConfigHandler::loadConfig();
//
//        $iddoc = $request->getParameter('iddoc');
//        $id = $request->getParameter('idfiche');
//        $doc_budget = $doc = Doctrine_Core::getTable('documentbudget')->findOneById($id);
//
//        $pdf = new sfTCPDF();
//
//        // set document information
//        $pdf->SetCreator(PDF_CREATOR);
//
//        $pdf->SetTitle('Fiche Bufget N°:');
//        $pdf->SetSubject("fiche bidget");
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getMinistere();
//        $rs = $soc->getRs();
//        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
//        $pdf->SetAuthor($entete);
//        $pdf->SetAuthor($rs);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//// set default monospaced font
//        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//// set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
//// set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//// set image scale factor
//        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//// set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }
//
//        // Set font
//        // dejavusans is a UTF-8 Unicode font, if you only need to
//        // print standard ASCII chars, you can use core fonts like
//        // dejavusans or times to reduce file size.
//        $pdf->SetFont('dejavusans', '', 10, '', true);
////$pdf->SetFont('dejavusans', '', 12);
//        // Add a page
//        // This method has several options, check the source code documentation for more information.
//        $pdf->AddPage();
////      
//        $idtype = 1;
//        if ($request->getParameter('idtytpe'))
//            $idtype = $request->getParameter('idtytpe');
//
//        $html = $this->ReadHtmlDocProvisoire($iddoc, $doc_budget, $idtype);
//
//        // Print text using writeHTMLCell()
//        // output the HTML content
//        $pdf->writeHTML($html, true, false, true, false, '');
//
//
//        // ---------------------------------------------------------
//        // Close and output PDF document
//        // This method has several options, check the source code documentation for more information.
//        $pdf->Output('titre_' . $id . '.pdf', 'I');
//
//        // Stop symfony process
//        throw new sfStopException();
//    }
//
//    public function ReadHtmlDocProvisoire($iddoc, $doc_budget, $idtype) {
//        $html = StyleCssHeader::header1();
//        $html.=$doc_budget->getHtmlDocProvisoire($iddoc, $idtype);
//
//        return $html;
//    }
//    public function executeImprimerfichebudget(sfWebRequest $request) {
//        $config = sfTCPDFPluginConfigHandler::loadConfig();
//
//        $id = $request->getParameter('idfiche');
//        $titrebudget = Doctrine_Core::getTable('titrebudjet')->findOneById($id);
//
//        $pdf = new sfTCPDF();
//
//        // set document information
//        $pdf->SetCreator(PDF_CREATOR);
//
//        $pdf->SetTitle('Fiche Budget N°:');
//        $pdf->SetSubject("fiche budget");
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getMinistere();
//        $rs = $soc->getRs();
//        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
//        $pdf->SetAuthor($entete);
//        $pdf->SetAuthor($rs);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//        // set default monospaced font
//        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//        // set margins
////        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
//        $pdf->SetMargins(5, 30, 5);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
////        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//        // set auto page breaks
////        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//        $pdf->SetAutoPageBreak(TRUE, 13);
//
//        // set image scale factor
//        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//        // set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }
//
//        // Set font
//        // dejavusans is a UTF-8 Unicode font, if you only need to
//        // print standard ASCII chars, you can use core fonts like
//        // dejavusans or times to reduce file size.
//        $pdf->SetFont('dejavusans', '', 10, '', true);
//        //$pdf->SetFont('dejavusans', '', 12);
//        // Add a page
//        // This method has several options, check the source code documentation for more information.
//        $pdf->AddPage();
//
//        $html = $this->ReadHtmlBudget($societe, $titrebudget);
//
//        // Print text using writeHTMLCell()
//        // output the HTML content
//        $pdf->writeHTML($html, true, false, true, false, '');
//
//        // ---------------------------------------------------------
//        // Close and output PDF document
//        // This method has several options, check the source code documentation for more information.
//        $pdf->Output('Fiche Budget : ' . $titrebudget->getLibelle() . '.pdf', 'I');
//
//        // Stop symfony process
//        throw new sfStopException();
//    }
//  public function ReadHtmlBudget($societe, $titrebudget) {
//        $html = StyleCssHeader::header1();
//        $html.=$titrebudget->getHtmlBudget();
//
//        return $html;
//    }
//Imprimerreliverbancaire
//    public function executeImprimerreliverbancaire(sfWebRequest $request) {
//        $config = sfTCPDFPluginConfigHandler::loadConfig();
//
//        $doc = new Caissesbanques();
//        $iddoc = $request->getParameter('iddoc');
//        $documentachat = Doctrine_Core::getTable('caissesbanques')->findOneById($iddoc);
//        $doc = $documentachat;
//
//        //Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
//        // pdf object
//        $pdf = new sfTCPDF();
//
//        // set document information
//        $pdf->SetCreator(PDF_CREATOR);
//
//        $pdf->SetTitle('Fiche Bnaque N°:');
//        $pdf->SetSubject("document du banque");
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getMinistere();
//        $rs = $soc->getRs();
//        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
//        $pdf->SetAuthor($entete);
//        $pdf->SetAuthor($rs);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//
//
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//// set default monospaced font
//        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//// set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
//// set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//// set image scale factor
//        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//// set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }
//
//        // Set font
//        // dejavusans is a UTF-8 Unicode font, if you only need to
//        // print standard ASCII chars, you can use core fonts like
//        // dejavusans or times to reduce file size.
//        $pdf->SetFont('dejavusans', '', 10, '', true);
////$pdf->SetFont('dejavusans', '', 12);
//        // Add a page
//        // This method has several options, check the source code documentation for more information.
//        $pdf->AddPage();
////      
//
//
//        $html = $this->ReadHtmlCaissesBanques($doc);
//
//        $pdf->writeHTML($html, true, false, true, false, '');
//
//        // ---------------------------------------------------------
//        // Close and output PDF document
//        // This method has several options, check the source code documentation for more information.
//        $pdf->Output('caissesbanques' . $doc->getRib() . $doc->getId() . '.pdf', 'I');
//
//        // Stop symfony process
//        throw new sfStopException();
//    }
//
//    public function ReadHtmlCaissesBanques($documentCaissesBanques) {
//        $html = StyleCssHeader::header1();
//        // die('dd'.$documentCaissesBanques->getId().''.$documentCaissesBanques->getDateouvert());
//        $html .= $documentCaissesBanques->ReadHtmlBonCaissesBanques();
//
//        return $html;
//    }
//    public function executeImprimerdocentre(sfWebRequest $request) {
//        $config = sfTCPDFPluginConfigHandler::loadConfig();
//
//        $aviss = Doctrine_Core::getTable('avis')
//                        ->createQuery('a')->where('id_poste=5')
//                        ->orderBy('id asc')->execute();
//        $iddoc = $request->getParameter('iddoc');
//        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
//
//        $listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
//
//        // pdf object
//        $pdf = new sfTCPDF();
//
//        // set document information
//        $pdf->SetCreator(PDF_CREATOR);
//
//        $pdf->SetTitle('Fiche BCI N°:');
//        $pdf->SetSubject("document d'achat");
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getMinistere();
//        $rs = $soc->getRs();
//        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
//        $pdf->SetAuthor($entete);
//        $pdf->SetAuthor($rs);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//
//
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//// set default monospaced font
//        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//// set margins
////        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
//        $pdf->SetMargins(10, 30, 10);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
//// set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//// set image scale factor
//        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//// set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }
//
//        // Set font
//        // dejavusans is a UTF-8 Unicode font, if you only need to
//        // print standard ASCII chars, you can use core fonts like
//        // dejavusans or times to reduce file size.
//        $pdf->SetFont('dejavusans', '', 10, '', true);
//
//        // Add a page
//        // This method has several options, check the source code documentation for more information.
//        $pdf->AddPage();
////      
////die($documentachat->getIdTypedoc().'gg');
////die($html);
//        if ($documentachat->getIdTypedoc() == 10)
//            $html = $this->ReadHtmlBonEntrer($societe, $documentachat, $listesdocuments);
//        if ($documentachat->getIdTypedoc() == 11)
//            $html = $this->ReadHtmlBonSortie($societe, $documentachat, $listesdocuments);
//        if ($documentachat->getIdTypedoc() == 13)
//            $html = $this->ReadHtmlBonTransfert($societe, $documentachat, $listesdocuments);
//        if ($documentachat->getIdTypedoc() == 12)
//            $html = $this->ReadHtmlBonRetour($societe, $documentachat, $listesdocuments);
//        if ($documentachat->getIdTypedoc() == 14)
//            $html = $this->ReadHtmlAvoir($societe, $documentachat, $listesdocuments);
//        if ($documentachat->getIdTypedoc() == 15)
//            $html = $this->ReadHtmlFacture($societe, $documentachat, $listesdocuments);
//
//
//        // Print text using writeHTMLCell()
//        // output the HTML content
//        $pdf->writeHTML($html, true, false, true, false, '');
//
//
//        // ---------------------------------------------------------
//        // Close and output PDF document
//        // This method has several options, check the source code documentation for more information.
//        $pdf->Output('documentachat' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');
//
//        // Stop symfony process
//        throw new sfStopException();
//    }
//
//    public function ReadHtmlBonEntrer($societe, $documentachat, $listesdocuments) {
//        $html = StyleCssHeader::header1();
//        $html.=$documentachat->ReadHtmlBonEntree();
//        //die($html);
//        return $html;
//    }
//
//    public function ReadHtmlFacture($societe, $documentachat, $listesdocuments) {
//        $html = StyleCssHeader::header1();
//        $html.=$documentachat->ReadHtmlFactureImression();
//        //die($html);
//        return $html;
//    }
//
//    public function ReadHtmlAvoir($societe, $documentachat, $listesdocuments) {
//        $html = StyleCssHeader::header1();
//        $html.=$documentachat->ReadHtmlAvoir();
//        //die($html);
//        return $html;
//    }
//
//    public function ReadHtmlBonSortie($societe, $documentachat, $listesdocuments) {
//        $html = StyleCssHeader::header1();
//        $html.=$documentachat->ReadHtmlBonSortie();
//        //die($html);
//        return $html;
//    }
//
//    public function ReadHtmlBonTransfert($societe, $documentachat, $listesdocuments) {
//        $html = StyleCssHeader::header1();
//        $html.=$documentachat->ReadHtmlBonTransfert();
//        //die($html);
//        return $html;
//    }
//
//    public function ReadHtmlBonRetour($societe, $documentachat, $listesdocuments) {
//        $html = StyleCssHeader::header1();
//        $html.=$documentachat->ReadHtmlBonRetour();
//        //die($html);
//        return $html;
//    }
//    public function executeImprimerdemandedachat(sfWebRequest $request) {
//        $config = sfTCPDFPluginConfigHandler::loadConfig();
//
//        $iddoc = $request->getParameter('iddoc');
//        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
//
//        $listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
//
//        $pdf = new sfTCPDF();
//
//        // set document information
//        $pdf->SetCreator(PDF_CREATOR);
//
//        $pdf->SetTitle('Fiche N°:' . $documentachat->getNumero());
//        $pdf->SetSubject("demande de prix");
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getMinistere();
//        $rs = $soc->getRs();
//        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
//        $pdf->SetAuthor($entete);
//        $pdf->SetAuthor($rs);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
////        $pdf->SetHeaderData(PDF_HEADER_LOGO, '', strtoupper($entete), $soc->getAdresse());
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//// set default monospaced font
//        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//// set margins
////        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
//        $pdf->SetMargins(5, 30, 5);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
//// set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//// set image scale factor
//        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//// set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }
//
//        // Set font
//        // dejavusans is a UTF-8 Unicode font, if you only need to
//        // print standard ASCII chars, you can use core fonts like
//        // dejavusans or times to reduce file size.
//        $pdf->SetFont('dejavusans', '', 10, '', true);
//
//        // Add a page
//        // This method has several options, check the source code documentation for more information.
//        $pdf->AddPage();
////      
//
//
//        $html = $this->ReadHtmlDemandePrix($societe, $documentachat, $listesdocuments);
////die($html);
//        // Print text using writeHTMLCell()
//        // output the HTML content
//        $pdf->writeHTML($html, true, false, true, false, '');
//        // ---------------------------------------------------------
//        // Close and output PDF document
//        // This method has several options, check the source code documentation for more information.
//        $pdf->Output('demandedeprix' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');
//
//        // Stop symfony process
//        throw new sfStopException();
//    }
//
//    public function ReadHtmlDemandePrix($societe, $documentachat, $listesdocuments) {
//        $html = StyleCssHeader::header1();
//        $html.=$documentachat->getHtmlDemandedeprix();
//        //die($html);
//        return $html;
//    }
//    public function executeImprimercourrier(sfWebRequest $request) {
//        $config = sfTCPDFPluginConfigHandler::loadConfig();
//
//        $idcourrier = $request->getParameter('idcourrier');
//        $courrier = Doctrine_Core::getTable('courrier')->findOneById($idcourrier);
//
//        $idtype = $courrier->getIdType();
//        $user = $courrier->getUtilisateur();
//        if ($courrier->getIdUser()) {
//            $expdest = $user->getExpdestinataire();
//            $mvc = Doctrine_Core::getTable('parcourcourier')->findOneByIdCourrierdestAndIdRec($courrier->getId(), $expdest->getId());
//            $parcourcou = Doctrine_Core::getTable('parcourcourier')->findByIdCourierAndIdExp($courrier->getId(), $expdest->getId());
//        } else {
//            $mvc = Doctrine_Core::getTable('parcourcourier')->findOneByIdCourrierdestAndIdFamexpdes($courrier->getId(), $courrier->getIdFamexpdes());
//            $parcourcou = Doctrine_Core::getTable('parcourcourier')->findByIdCourierAndIdExp($courrier->getId(), $mvc->getIdExp());
//        }
//        $pdf = new sfTCPDF();
//
//        // set document information
//        $pdf->SetCreator(PDF_CREATOR);
//
//        $pdf->SetTitle('Fiche Courrier N°:');
//        $pdf->SetSubject("fiche courrier");
//
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getMinistere();
//        $rs = $soc->getRs();
//        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
//        $pdf->SetAuthor($entete);
//        $pdf->SetAuthor($rs);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//// set default monospaced font
//        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//// set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
//// set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//// set image scale factor
//        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//// set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }
//
//        // set some language dependent data:
////        $lg = Array();
////        $lg['a_meta_charset'] = 'UTF-8';
////       // $lg['a_meta_dir'] = 'rtl';
////        //$lg['a_meta_language'] = 'ar';
////        $lg['w_page'] = 'page';
////
////// set some language-dependent strings (optional)
////        $pdf->setLanguageArray($lg);
//        $pdf->SetFont('dejavusans', '', 10, '', true);
//
//        // Add a page
//        // This method has several options, check the source code documentation for more information.
//        $pdf->AddPage();
//
//        $html = $this->ReadHtmlCourrier($societe, $courrier, $mvc, $parcourcou);
//
////die($html);
//        // Print text using writeHTMLCell()
//        // output the HTML content
//        $pdf->writeHTML($html, true, false, true, false, '');
//        // ---------------------------------------------------------
//        // Close and output PDF document
//        // This method has several options, check the source code documentation for more information.
//        $pdf->Output('fichecourrier' . $courrier->getNumerocourrierstring() . $courrier->getId() . '.pdf', 'I');
//
////        $pdf->Output(sfconfig::get('sf_upload_dir') . '/merge/' . 'fichecourrier' . $courrier->getNumerocourrierstring() . $courrier->getId() . '.pdf', 'F');
////        $file = sfconfig::get('sf_upload_dir') . '/merge/' . 'fichecourrier' . $courrier->getNumerocourrierstring() . $courrier->getId() . '.pdf';
//        // Stop symfony process
//        throw new sfStopException();
//    }
//
//    public function ReadHtmlCourrier($societe, $courrier, $mvc, $parcourcou) {
//        $html = '<style>
//    h3 {
//        font-family: times;
//        font-size: 12pt;
//         text-align: center;
//    }
//    span {
//        font-family: times;
//        font-size: 10pt;
//    }
//    h6 {
//        font-family: times;
//        font-size: 9pt;
//    }
//    p.first {
//        color: #003300;
//        font-family: dejavusans;
//        font-size: 12pt;
//    }
//    p{
//        margin:  -2px;
//    }
//    p>span{
//        color: #0066cc;
//    }
//    p.first span {
//        color: #006600;
//        font-style: italic;
//    }
//    p#second {
//        color: rgb(00,63,127);
//        font-family: times;
//        font-size: 12pt;
//        text-align: justify;
//    }
//    p#second > span {
//        background-color: #FFFFAA;
//    }
//    table.first {
//        color: #003300;
//        font-family: dejavusans;
//        font-size: 8pt;
//        background-color: #ccffcc;
//    }
//    .tableclass{
//        width: 750px;
//        padding-left: 59%;
//        margin-top: -6%;
//    }
//    .tableclass td {
//        border: 2px solid #000;
//    }
//    td.second {
//        /*border: 2px dashed green;*/
//    }
//    div.test {
//        color: #CC0000;
//        background-color: #FFFF66;
//        font-family: dejavusans;
//        font-size: 10pt;
//        border-style: solid solid solid solid;
//        border-width: 2px 2px 2px 2px;
//        border-color: green #FF00FF blue red;
//        text-align: center;
//    }
//    .lowercase {
//        text-transform: lowercase;
//    }
//    .uppercase {
//        text-transform: uppercase;
//    }
//    .capitalize {
//        text-transform: capitalize;
//    }
//     .tableligne{
//        padding: 1px;
//        border: 1px solid #000;
//    }
//    .tableclass{
// border: 1px dashed #000000 ;
// padding: 5px;
//}
//.tableligne{
//padding: 5px;
//}
//    .tableligne td{
//      border: 1px solid #000;
//      padding: 5px;
//      text-align: center;
//} 
// .tableclass  th{
//      border: 1px solid #000;
//      font-weight: bold;
//      font-size: 9pt;
//      text-align: center;
//} 
//.tableligne th{
//      border: 1px solid #000;
//      font-weight: bold;
//      font-size: 9pt;
//      text-align: center;
//} 
//.tableclass td{
//      text-align: justify;
//      border: 1px solid #000;
//}
//.contenue{
//font-size: 9pt;
//}
//body{
//border: 1px solid #000;
//}
//.secondtd{
// background-color: #fff;
//}
//.fersttd{
// background-color: #f6f8f4;
//}
//td{
//padding: 2%;
//}
//</style>';
//        $famille = "";
//        if ($courrier->getIdFamille())
//            $famille = $courrier->getFamillecourrier();
//        $expiditeur = "";
//        $action = "";
//        if ($mvc) {
//            $expiditeur = $mvc->getExpdest();
//            $action = $mvc->getActionparcour();
//        }
//
//        $recepteur = '';
//        if ($courrier->getIdUser() != null)
//            $recepteur = $courrier->getUtilisateur() . $courrier->getBureaux();
//        else
//            $recepteur = $courrier->getFamexpdes();
//
//        $html.='<div class="contenue">
//                    <div class="titre"><h3>Courrier N°: ' . $courrier->getNumerocourrierstring() . ' </h3></div>
//                    <div> 
//                    <table style="width:100%;" class="tablecontenue">';
//        if ($famille != "")
//            $html.='<tr>
//                        <td style="width:25%;font-weight:bold;"><span>Note du Courrier</span></td> 
//                        <td style="width:5%;font-weight:bold;">:</td>
//                        <td style="width:70%;" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $famille . '</p></td>
//                    </tr>';
//
//        $html.='<tr>
//                    <td style="width:25%;font-weight:bold;"><span>Date de Création</span></td>
//                    <td style="width:5%;font-weight:bold;">:</td>
//                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . date('d/m/Y', strtotime($courrier->getDatecreation())) . '</p></td>
//                </tr>
//                <tr>
//                    <td style="width:25%;font-weight:bold;"><span>Numéro</span></td>
//                    <td style="width:5%;font-weight:bold;">:</td>
//                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $courrier->getNumerocourrierstring() . '</p></td>
//                </tr>
//                <tr>
//                    <td style="width:25%;font-weight:bold;"><span>Numéro Correspondance</span></td>
//                    <td style="width:5%;font-weight:bold;">:</td>
//                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $courrier->getNumeroseq() . '</p></td>
//                </tr>
//                 <tr>
//                    <td style="width:25%;font-weight:bold;"><span>Type:</span></td>
//                    <td style="width:5%;font-weight:bold;">:</td>
//                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $courrier->getTypecourrier() . '</p></td>
//                </tr>
//                 <tr>
//                    <td style="width:25%;font-weight:bold;"><span>Mode ENV.||REC.</span></td>
//                    <td style="width:5%;font-weight:bold;">:</td>
//                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $courrier->getModescourrier() . '</p></td>
//                </tr>
//                <tr>
//                    <td style="width:25%;font-weight:bold;"><span>Type d\'envoie</span></td>
//                    <td style="width:5%;font-weight:bold;">:</td>
//                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $courrier->getTypeparamcourrier() . '</p></td>
//                </tr>
//                <tr>
//                    <td style="width:25%;font-weight:bold;"><span>Référence Courrier</span></td>
//                    <td style="width:5%;font-weight:bold;">:</td>
//                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $courrier->getReferencecourrier() . '</p></td>
//                </tr>
//                <tr>
//                    <td style="width:25%;font-weight:bold;"><span>Date Correspondance</span></td>
//                    <td style="width:5%;font-weight:bold;">:</td>
//                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . date('d/m/Y', strtotime($courrier->getDatecorespondanse())) . '</p></td>
//                </tr>
//                <tr>
//                    <td style="width:25%;font-weight:bold;"><span>Expéditeur</span></td>
//                    <td style="width:5%;font-weight:bold;">:</td>
//                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $expiditeur . ': <span style="color:red">' . $action . ' ===>> </span>' . $recepteur . '</p>
//                   </td>
//                </tr>
//                <tr>
//                    <td style="width:25%;font-weight:bold;"><span>Titre</span></td>
//                    <td style="width:5%;font-weight:bold;">:</td>
//                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;" >' . $courrier->getTitre() . '</p></td>
//                </tr>
//                <tr>
//                    <td style="width:25%;font-weight:bold;"><span>Objet</span></td>
//                    <td style="width:5%;font-weight:bold;">:</td>
//                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;" >' . $courrier->getObject() . '</p></td>
//                </tr>
//                <tr>
//                    <td style="width:25%;font-weight:bold;"><span>Sujet</span></td>
//                    <td style="width:5%;font-weight:bold;">:</td>
//                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $courrier->getSujet() . '</p></td>
//                </tr>
//                <tr>
//                    <td style="width:25%;font-weight:bold;"><span>Description du courrier</span></td>
//                    <td style="width:5%;font-weight:bold;">:</td>
//                    <td style="width:70%; text-align:right; direction:rtl;" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . trim(str_replace('p', 'div', str_replace('strong', 'b', $courrier->getDescription()))) . '</p></td>
//                </tr>
//            </table>
//            </div>';
//
//        $html.='<div class="tableligne">
//                    <table cellpadding="3">
//                        <tr style="background-color:#ECECEC">
//                            <th style="height:25px;">Expédition</th>
//                            <th>Destination</th>
//                            <th>Action d\'envoie</th>
//                        </tr>';
//
//        $parcourcourriers = new Parcourcourier();
//        foreach ($parcourcou as $par) {
//            $parcourcourriers = $par;
//            $reception = "";
//            if ($parcourcourriers->getIdRec()) {
//                $rec = Doctrine_Core::getTable('expdest')->findOneById($parcourcourriers->getIdRec());
//                if ($rec)
//                    $reception = $rec->getRtl();
//            }
//            $html.='<tr>
//                        <td style="height:25px;"><p>' . $parcourcourriers->getExpdest() . '</p></td>
//                        <td><p>' . $reception . '</p></td>
//                        <td><p style="color:red">' . $parcourcourriers->getActionparcour() . '</p></td>
//                    </tr>';
//        }
//        $html.='</table></div></div>';
//
//        return $html;
//    }
//    public function executeImprimerlistecourrier(sfWebRequest $request) {
////        if($request->getParameter('arraycourrier'))
////            die($request->getParameter('arraycourrier'));
//        $config = sfTCPDFPluginConfigHandler::loadConfig();
//
//        $pdf = new sfTCPDF();
//
//        $pdf->SetTitle('Mouvement des courriers');
//        $pdf->SetSubject("Liste des courriers par utilisateur");
//
////         $image_file =  '../../../uploads/' . $societe->getLogo();
////        $pdf->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
//
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getMinistere();
//        $rs = $soc->getRs();
//        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
//        $pdf->SetAuthor($entete);
//        $pdf->SetAuthor($rs);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//
//        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($societe), PDF_HEADER_STRING);
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//// set default monospaced font
//        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//// set margins
//        $pdf->SetMargins(10, 30, 10);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
//// set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//// set image scale factor
//        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//// set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }
//
//        // Set font
//        // dejavusans is a UTF-8 Unicode font, if you only need to
//        // print standard ASCII chars, you can use core fonts like
//        // dejavusans or times to reduce file size.
////        $pdf->SetFont('dejavusans', '', 10, '', true);
//        $pdf->SetFont('aefurat', '', 10);
////        $pdf->SetFont('aealarabiya', '', 10);
//        // Add a page
//        // This method has several options, check the source code documentation for more information.
//        $pdf->AddPage();
//
//        $html = $this->ReadHtmlListesCourrier($request);
//
//        // Print text using writeHTMLCell()
//        // output the HTML content
//        $pdf->writeHTML($html, true, false, true, false, '');
//        // ---------------------------------------------------------
//        // Close and output PDF document
//        // This method has several options, check the source code documentation for more information.
//        $pdf->Output('ListesCourrier' . '.pdf', 'I');
//
//        // Stop symfony process
//        throw new sfStopException();
//    }
//
//    public function ReadHtmlListesCourrier(sfWebRequest $request) {
//        $html = '<style>
//    h3 {
//        font-family: times;
//        font-size: 12pt;
//        text-align: center;
//    }
//    span {
//        font-family: times;
//        font-size: 10pt;
//    }
//    h6 {
//        font-family: times;
//        font-size: 9pt;
//    }
//    .tableclass{
//        width: 750px;
//        padding-left: 59%;
//        margin-top: -6%;
//    }
//    .tableclass td {
//        border: 2px solid #000;
//    }
//    .lowercase {
//        text-transform: lowercase;
//    }
//    .uppercase {
//        text-transform: uppercase;
//    }
//    .capitalize {
//        text-transform: capitalize;
//    }
//     .tableligne{
//        padding: 1px;
//        border: 1px solid #000;
//        
//    }
//    .tableclass{
// border: 1px dashed #000000 ;
// padding: 5px;
//}
//.tableligne{
//padding: 5px;
//}
//    .tableligne td{
//      border: 1px solid #000;
//      padding: 5px;
//      text-align: center;
//} 
// .tableclass  th{
//     
//      border: 1px solid #000;
//      font-weight: bold;
//      font-size: 9pt;
//      text-align: center;
//} 
//.tableligne th{
//      border: 1px solid #000;
//      font-weight: bold;
//      font-size: 9pt;
//      text-align: center;
//} 
//.tableclass td{
//      text-align: justify;
//      border: 1px solid #000;
//}
//body{
//border: 1px solid #000;
//}
//.secondtd{
// background-color: #fff;
//}
//.fersttd{
// background-color: #f6f8f4;
//}
//td{
//padding: 1%;
//}
//</style>';
//        $mv_courrier = new Parcourcourier();
//        $parcourcourriers = Doctrine_Core::getTable('parcourcourier')
//                ->createQuery('a');
//        $datecreation = "";
//        if ($request->getParameter('datecreation'))
//            $datecreation = $request->getParameter('datecreation');
//        $datedebut = "";
//        if ($request->getParameter('datecreationfrom')) {
//            $datedebut = $request->getParameter('datecreationfrom');
//            $parcourcourriers = $parcourcourriers->AndWhere("datecreation >='" . $datedebut . "'");
//        }
//        $datefin = "";
//        if ($request->getParameter('datecreationto')) {
//            $datefin = date('Y-m-d', strtotime($request->getParameter('datecreationto')));
//            $parcourcourriers = $parcourcourriers->AndWhere("datecreation <='" . $datefin . "'");
//        }
//        $action = "";
//        if ($request->getParameter('id_action')) {
//            $action = Doctrine_Core::getTable('actionparcour')->findOneById($request->getParameter('id_action'));
//            $parcourcourriers = $parcourcourriers->AndWhere("id_action=" . $request->getParameter('id_action'));
//        }
//        $expediteur = "";
//        if ($request->getParameter('id_exp')) {
//            $expediteur = Doctrine_Core::getTable('expdest')->findOneById($request->getParameter('id_exp'));
//            $parcourcourriers = $parcourcourriers->AndWhere("id_exp=" . $request->getParameter('id_exp'));
//        }
//        $destination = "";
//        if ($request->getParameter('id_dest')) {
//            $destination = Doctrine_Core::getTable('expdest')->findOneById($request->getParameter('id_dest'));
//            $parcourcourriers = $parcourcourriers->AndWhere("id_dest=" . $request->getParameter('id_dest'));
//        }
//        $utilisateur = "";
//        if ($request->getParameter('id_user')) {
//            $utilisateur = Doctrine_Core::getTable('utilisateur')->findOneById($request->getParameter('id_user'));
//            $parcourcourriers = $parcourcourriers->AndWhere("id_user=" . $request->getParameter('id_user'));
//        }
//        $courrier = "";
//        if ($request->getParameter('id_courier')) {
//            $courrier = Doctrine_Core::getTable('courrier')->findOneById($request->getParameter('id_courier'));
//            $array = $courrier->RecursiveCourrier();
//            $parcourcourriers = $parcourcourriers->OrWhereIn('id_courrierdest', $array);
//        }
//        if ($request->getParameter('id_typecourrier')) {
//            $parcourcourriers = $parcourcourriers->Andwhere('id_typecourrier=' . $request->getParameter('id_typecourrier'));
//        }
//        $html.='<div class="contenue">
//                    <div class="titre"><h3 style="font-size:20px;">Mouvement des courriers</h3></div>
//                    <div> 
//                        <table style="width:100%;" class="tablecontenue">
//                            <tr>
//                                <td style="width:25%;font-weight:bold;"><span>Date</span></td> 
//                                <td style="width:5%;font-weight:bold;">:</td>
//                                <td style="width:70%"><p style="border-bottom: 1px dashed #000000;">' . $datedebut . ' ==>' . $datefin . '</p></td>
//                            </tr>
//                            <tr>
//                                <td style="width:25%;font-weight:bold;"><span>Courrier</span></td>
//                                <td style="width:5%;font-weight:bold;">:</td>
//                                <td style="width:70%"><p style="border-bottom: 1px dashed #000000;">' . $courrier . '</p></td>
//                            </tr>
//                            <tr>
//                                <td style="width:25%;font-weight:bold;"><span>Type d\'action</span></td>
//                                <td style="width:5%;font-weight:bold;">:</td>
//                                <td style="width:70%"><p style="border-bottom: 1px dashed #000000;">' . $action . '</p></td>
//                            </tr>
//                             <tr>
//                                <td style="width:25%;font-weight:bold;"><span>Expéditeur</span></td>
//                                <td style="width:5%;font-weight:bold;">:</td>
//                                <td style="width:70%"><p style="border-bottom: 1px dashed #000000;">' . $expediteur . '</p></td>
//                            </tr>
//                             <tr>
//                                <td style="width:25%;font-weight:bold;"><span>Destinataire</span></td>
//                                <td style="width:5%;font-weight:bold;">:</td>
//                                <td style="width:70%"><p style="border-bottom: 1px dashed #000000;">' . $destination . '</p></td>
//                            </tr>
//                            <tr>
//                                <td style="width:25%;font-weight:bold;"><span>Utilisateur</span></td>
//                                <td style="width:5%;font-weight:bold;">:</td>
//                                <td style="width:70%"><p style="border-bottom: 1px dashed #000000;">' . $utilisateur . '</p></td>
//                            </tr>
//                        </table>
//                    </div>';
//
//        $html.= '<div>
//                    <table cellpadding="3">
//                        <tr>';
//        $typecourriers = Doctrine_Core::getTable('typecourrier')->findAll();
//        foreach ($typecourriers as $type) {
//            $html.= '<td style="' . trim($type->getCoul()) . ';height:25x;">' . $type . '</td>';
//        }
//
//        $html.='</tr></table>
//            </div>';
//
//        $html.='<div class="tableligne">
//                    <table cellpadding="3">
//                        <tr>
//                            <th style="width:25%;height:25px;font-weight:bold;font-size:14px;">Détail Création</th>
//                            <th style="width:35%;font-weight:bold;font-size:14px;">Détail Courrier</th>
//                            <th style="width:40%;font-weight:bold;font-size:14px;">Détail Parcour</th>
//                        </tr>';
//
//        $parcourcourriers = $parcourcourriers->OrderBy('id Asc')->execute();
//        foreach ($parcourcourriers as $par) {
//            $mv_courrier = $par;
//            $courrier_dest = Doctrine_Core::getTable('courrier')->findOneById($mv_courrier->getIdCourrierdest());
//            $html.='  <tr style="' . $courrier_dest->getTypecourrier()->getCoul() . '">
//                            <td><p>' . $mv_courrier->getDatecreationetdatemax1() . '</p></td>
//                            <td><p>' . $mv_courrier->getCourrieretcourriersource1() . '</p></td>
//                            <td><p>' . $mv_courrier->getExpdestinataire1() . '</p></td>
//                        </tr>';
//        }
//        $html.='</table></div></div>';
//
//        return $html;
//    }

//    public function executeImprimerbondeponse(sfWebRequest $request) {
//        $config = sfTCPDFPluginConfigHandler::loadConfig();
//
//        $iddoc = $request->getParameter('iddoc');
//        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
//
//        $listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
//
//        $pdf = new sfTCPDF();
//
//        // set document information
//        $pdf->SetCreator(PDF_CREATOR);
//
//        $pdf->SetTitle('Fiche N°:' . $documentachat->getNumero());
//        $pdf->SetSubject("Bon de déponse aux comptant");
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getMinistere();
//        $rs = $soc->getRs();
//        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
//        $pdf->SetAuthor($entete);
//        $pdf->SetAuthor($rs);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
////        $pdf->SetHeaderData(PDF_HEADER_LOGO, '', strtoupper($entete), $soc->getAdresse());
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//// set default monospaced font
//        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//// set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
//// set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//// set image scale factor
//        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//// set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }
//
//        // Set font
//        // dejavusans is a UTF-8 Unicode font, if you only need to
//        // print standard ASCII chars, you can use core fonts like
//        // dejavusans or times to reduce file size.
//        $pdf->SetFont('dejavusans', '', 10, '', true);
//
//        // Add a page
//        // This method has several options, check the source code documentation for more information.
//        $pdf->AddPage();
////      
//
//
//        $html = $this->ReadHtmlBondeponse($societe, $documentachat, $listesdocuments);
////die($html);
//        // Print text using writeHTMLCell()
//        // output the HTML content
//        $pdf->writeHTML($html, true, false, true, false, '');
//        // ---------------------------------------------------------
//        // Close and output PDF document
//        // This method has several options, check the source code documentation for more information.
//
//        $pdf->Output('demandedeprix' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');
//
//        // Stop symfony process
//        throw new sfStopException();
//    }
//
//    public function ReadHtmlBondeponse($societe, $documentachat, $listesdocuments) {
//        $html = StyleCssHeader::header1();
//        $html.=$documentachat->ReadHtmlBondeponse();
//        //die($html);
//        return $html;
//    }

//    public function executeImprimertousbondeponse(sfWebRequest $request) {
//        $config = sfTCPDFPluginConfigHandler::loadConfig();
//
//        $iddoc = $request->getParameter('iddoc');
//        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
//        $listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
//
//        $pdf = new sfTCPDF();
//
//        // set document information
//        $pdf->SetCreator(PDF_CREATOR);
//
//        $pdf->SetTitle('Fiche N°:' . $documentachat->getNumero());
//        $pdf->SetSubject("Bon de déponse aux comptant");
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getMinistere();
//        $rs = $soc->getRs();
//        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
//        $pdf->SetAuthor($entete);
//        $pdf->SetAuthor($rs);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
////        $pdf->SetHeaderData(PDF_HEADER_LOGO, '', strtoupper($entete), $soc->getAdresse());
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//// set default monospaced font
//        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//// set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
//// set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//// set image scale factor
//        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//// set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }
//
//        // Set font
//        // dejavusans is a UTF-8 Unicode font, if you only need to
//        // print standard ASCII chars, you can use core fonts like
//        // dejavusans or times to reduce file size.
//        $pdf->SetFont('dejavusans', '', 10, '', true);
//
//        // Add a page
//        // This method has several options, check the source code documentation for more information.
//        $pdf->AddPage();
////      
//        $idtype = $request->getParameter('idtype');
//
//        $html = $this->ReadHtmlTousBondeponse($societe, $documentachat, $listesdocuments, $idtype);
////die($html);
//        // Print text using writeHTMLCell()
//        // output the HTML content
//        $pdf->writeHTML($html, true, false, true, false, '');
//        // ---------------------------------------------------------
//        // Close and output PDF document
//        // This method has several options, check the source code documentation for more information.
//        $pdf->Output('demandedeprix' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');
//
//        // Stop symfony process
//        throw new sfStopException();
//    }
//
//    public function ReadHtmlTousBondeponse($societe, $documentachat, $listesdocuments, $idtype) {
//        $html = StyleCssHeader::header1();
//        $html.=$documentachat->ReadHtmlTousBondeponse($idtype);
//        //die($html);
//        return $html;
//    }

//    public function executeImprimerbonexterne(sfWebRequest $request) {
//        $config = sfTCPDFPluginConfigHandler::loadConfig();
//
//        $iddoc = $request->getParameter('iddoc');
//        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
//
//        $pdf = new sfTCPDF();
//
//        // set document information
//        $pdf->SetCreator(PDF_CREATOR);
//
//        $pdf->SetTitle('Fiche N°:' . $documentachat->getNumero());
//        $pdf->SetSubject("Bon de commande externe");
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getMinistere();
//        $rs = $soc->getRs();
//        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
//        $pdf->SetAuthor($entete);
//        $pdf->SetAuthor($rs);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
////        $pdf->SetHeaderData(PDF_HEADER_LOGO, '', strtoupper($entete), $soc->getAdresse());
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setPrintFooter(true);
//        $foter = $soc->getTel();
//        $adr = $soc->getAdresse();
//        $pdf->setFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($foter), strtoupper($adr), '', '');
//        //$pdf->setFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');
////        $pdf->setFooterData(strtoupper($foter),strtoupper($adr));
////        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
//// set default monospaced font
//        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//// set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
//// set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//// set image scale factor
//        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//// set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }
//
//        // Set font
//        // dejavusans is a UTF-8 Unicode font, if you only need to
//        // print standard ASCII chars, you can use core fonts like
//        // dejavusans or times to reduce file size.
//        $pdf->SetFont('dejavusans', '', 10, '', true);
//
//        // Add a page
//        // This method has several options, check the source code documentation for more information.
//        $pdf->AddPage();
//
//        $html = $this->ReadHtmlBonexterne($documentachat);
//
//        // Print text using writeHTMLCell()
//        // output the HTML content
//        $pdf->writeHTML($html, true, false, true, false, '');
//        // ---------------------------------------------------------
//        // Close and output PDF document
//        // This method has several options, check the source code documentation for more information.
//        $pdf->Output('Bon commande ' . $documentachat->getNumero() . '.pdf', 'I');
//
//        // Stop symfony process
//        throw new sfStopException();
//    }
//
//    public function ReadHtmlBonexterne($documentachat) {
//        $html = StyleCssHeader::header1();
//        $html.=$documentachat->ReadHtmlBonexterne();
//        //die($html);
//        return $html;
//    }

//    public function executeImprimerlistedocument(sfWebRequest $request) {
////        die('hh');
////        if($request->getParameter('arraycourrier'))
////            die($request->getParameter('arraycourrier'));
//        $config = sfTCPDFPluginConfigHandler::loadConfig();
//
//        $pdf = new sfTCPDF();
//
//        $pdf->SetTitle('Listes des bons Commnade interne ');
//        $pdf->SetSubject("Listes des bons Commnade interne");
//
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getMinistere();
//        $rs = $soc->getRs();
//        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
//        $pdf->SetAuthor($entete);
//        $pdf->SetAuthor($rs);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//
//        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($societe), PDF_HEADER_STRING);
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//// set default monospaced font
//        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//// set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
//// set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//// set image scale factor
//        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//// set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }
//
//        // Set font
//        // dejavusans is a UTF-8 Unicode font, if you only need to
//        // print standard ASCII chars, you can use core fonts like
//        // dejavusans or times to reduce file size.
//        $pdf->SetFont('dejavusans', '', 10, '', true);
//
//        // Add a page
//        // This method has several options, check the source code documentation for more information.
//        $pdf->AddPage();
////      
//        //die('test=' . $request->getParameter('idtype'));
//
//        $html = $this->ReadHtmlListesDocument($request);
//
//        // Print text using writeHTMLCell()
//        // output the HTML content
//        $pdf->writeHTML($html, true, false, true, false, '');
//        // ---------------------------------------------------------
//        // Close and output PDF document
//        // This method has several options, check the source code documentation for more information.
//        $pdf->Output('ListesBCI' . '.pdf', 'I');
//
//        // Stop symfony process
//        throw new sfStopException();
//    }
//      public function ReadHtmlListesDocument(sfWebRequest $request) {
//        $html = StyleCssHeader::header1();
//        $datedebut = "";
//        $datefin = "";
//        $etatdoc = "";
//
//        $typedoc = Doctrine_Core::getTable('typedoc')->findOneById($_REQUEST['idtype']);
//
//        $documentsachat = Doctrine_Core::getTable('documentachat')
//                        ->createQuery('a')->where('id_typedoc=' . $_REQUEST['idtype']);
//        if (isset($_REQUEST['De']) && isset($_REQUEST['à']) && $_REQUEST['De'] != "1970-01-01" && $_REQUEST['à'] != "1970-01-01") {
////            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $_REQUEST['De'] . "'");
////            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $_REQUEST['à'] . "'");
//            $datedebut = $_REQUEST['De'];
//            $datefin = $_REQUEST['à'];
//        }
//        if (isset($_REQUEST['De']) && !isset($_REQUEST['à']) && $_REQUEST['De'] != "1970-01-01") {
//            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $_REQUEST['De'] . "'");
//            $datedebut = $_REQUEST['De'];
//        }
//        if (!isset($_REQUEST['De']) && isset($_REQUEST['à']) && $_REQUEST['à'] != "1970-01-01") {
//
//            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $_REQUEST['à'] . "'");
//
//            $datefin = $_REQUEST['à'];
//        }
//
//        if (isset($_REQUEST['id_etatdoc']) && $_REQUEST['id_etatdoc'] != "") {
//            $documentsachat = $documentsachat->Andwhere('id_etatdoc=' . $_REQUEST['id_etatdoc']);
//            $etatdoc = Doctrine_Core::getTable('etatdocument')->findOneById($_REQUEST['id_etatdoc']);
//        }
//
//        $html.='<div class="titre"><h3 style="font-size:22px;">' . $typedoc . '</h3></div>&nbsp;<br>
//                <div> 
//                    <table style="width:100%;" class="tablecontenue">
//                        <tr>
//                            <td style="width:10%">Date</td>
//                            <td style="width:90%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $datedebut . ' ==>' . $datefin . '</p></td>
//                        </tr>
//                        <tr>
//                            <td style="width:10%">Etat</td>
//                            <td style="width:90%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $etatdoc . '</p></td>
//                        </tr>
//                    </table>
//                </div>';
//
//        $html.='<div class="tableligne">
//                    <table style="font-size:11px;" cellpadding="3">
//                        <tr style="background-color:#EDEDED">
//                            <th style="width: 15%; height:25px;">Numéro</th>
//                            <th style="width: 15%; height:25px;">Date</th>
//                            <th style="width: 20%">Référence</th>
//                            <th style="width: 30%">Etat</th>   
//                            <th style="width: 20%">Mnt TTC</th>
//                        </tr>';
//
//        $documentsachat = $documentsachat->OrderBy('id Asc')->execute();
//        $doc = new Documentachat();
//        foreach ($documentsachat as $docach) {
//            $doc = $docach;
//            $avisss = "";
//            $aviss = Doctrine_Core::getTable('ligavisdoc')->findOneByIdDoc($doc->getId());
//            if ($aviss)
//                $avisss = $aviss->getAvis();
//            $etat = "";
//            if ($doc->getIdEtatdoc()) {
//                $etatdoc = Doctrine_Core::getTable('etatdocument')->findOneById($doc->getIdEtatdoc());
//                if ($etatdoc)
//                    $etat = $etatdoc;
//            }
//            $html.='<tr>
//                        <td><p>' . $doc->getNumerodocachat() . '</p></td>'
//                    . '<td><p>' . date('d/m/Y', strtotime($doc->getDatecreation())) . '</p></td>';
//            if ($doc->getDocumentparent())
//                $html.='<td><p>' . $doc->getDocumentparent() . '<br>' . $doc->getDocumentparent()->getTiersPrint() . '</p></td>';
//            else {
//                $html.='<td></td>';
//            }
//
//            $html.='<td><p>' . $etat . '</p></td>
//                    <td style="text-align:right;">' . number_format($doc->getMntttc(), 3, ',', '.') . '</td>
//                </tr>';
//        }
//        $html.='</table></div>';
//
//        return $html;
//    }
//
//    public function executeImprimerlistepvreception(sfWebRequest $request) {
////        if($request->getParameter('arraycourrier'))
////            die($request->getParameter('arraycourrier'));
//        $config = sfTCPDFPluginConfigHandler::loadConfig();
//
//        $pdf = new sfTCPDF();
//
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getMinistere();
//        $rs = $soc->getRs();
//        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
//        $pdf->SetAuthor($entete);
//        $pdf->SetAuthor($rs);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//
//        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($societe), PDF_HEADER_STRING);
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//// set default monospaced font
//        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//// set margins
////        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
//        $pdf->SetMargins(7, 30, 7);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
//// set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//// set image scale factor
//        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//// set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }
//
//        // Set font
//        // dejavusans is a UTF-8 Unicode font, if you only need to
//        // print standard ASCII chars, you can use core fonts like
//        // dejavusans or times to reduce file size.
//        $pdf->SetFont('dejavusans', '', 10, '', true);
//
//        // Add a page
//        // This method has several options, check the source code documentation for more information.
//        $pdf->AddPage();
////      
//        //die('test=' . $request->getParameter('idtype'));
//
//        $html = $this->ReadHtmlListesDocument($request);
//
//        // Print text using writeHTMLCell()
//        // output the HTML content
//        $pdf->writeHTML($html, true, false, true, false, '');
//        // ---------------------------------------------------------
//        // Close and output PDF document
//        // This method has several options, check the source code documentation for more information.
//        $pdf->Output('ListesPv' . '.pdf', 'I');
//
//        // Stop symfony process
//        throw new sfStopException();
//    }

  

//    public function executeImprimerreclamation(sfWebRequest $request) {
//        $config = sfTCPDFPluginConfigHandler::loadConfig();
//
//        $id = $request->getParameter('iddoc');
//        $reclamation = Doctrine_Core::getTable('reclamationfrs')->findOneById($id);
//
//        $pdf = new sfTCPDF();
//
//        // set document information
//        $pdf->SetCreator(PDF_CREATOR);
//
//        $pdf->SetTitle('Fiche Réclamation');
//        $pdf->SetSubject("Fiche Réclamation");
//
//        $soc = new Societe();
//        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
//        $soc = $societe;
//        $entete = $soc->getMinistere();
//        $rs = $soc->getRs();
//        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
//        $pdf->SetAuthor($entete);
//        $pdf->SetAuthor($rs);
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
//
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//// set default monospaced font
//        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//// set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
//// set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//// set image scale factor
//        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//// set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }
//
//        // Set font
//        // dejavusans is a UTF-8 Unicode font, if you only need to
//        // print standard ASCII chars, you can use core fonts like
//        // dejavusans or times to reduce file size.
//        $pdf->SetFont('dejavusans', '', 10, '', true);
//
//        // Add a page
//        // This method has several options, check the source code documentation for more information.
//        $pdf->AddPage();
//
//        $html = $this->ReadHtmlReclamation($reclamation);
//
//        // Print text using writeHTMLCell()
//        // output the HTML content
//        $pdf->writeHTML($html, true, false, true, false, '');
//        // ---------------------------------------------------------
//        // Close and output PDF document
//        // This method has several options, check the source code documentation for more information.
//        $pdf->Output('Réclamation' . '.pdf', 'I');
//
//        // Stop symfony process
//        throw new sfStopException();
//    }
//
//    public function ReadHtmlReclamation($reclamation) {
//        $html = StyleCssHeader::header1();
//        $rec = new Reclamationfrs();
//        $rec = $reclamation;
//        $html.='<div class="contenue">
//                    <div class="titre"><h3 style="font-size: 18px;">Réclamation Fournisseur</h3></div>
//                    &nbsp;<br>
//                    <div> 
//                        <table style="width:100%;" class="tablecontenue">
//                            <tr>
//                                <td style="width:15%">Date</td> 
//                                <td style="width:2%">:</td>
//                                <td style="width:83%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . date('d/m/Y', strtotime($rec->getDaterec())) . '</p></td>
//                            </tr>
//                            <tr>
//                                <td style="width:15%;">Object</td>
//                                <td style="width:2%">:</td>
//                                <td style="width:83%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $rec->getObject() . '</p></td>
//                            </tr>
//                             <tr>
//                                <td style="width:15%">Fournisseur</td>
//                                <td style="width:2%">:</td>
//                                <td style="width:83%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $rec->getFournisseur() . '</p></td>
//                            </tr>
//                        </table>
//                    </div>
//                    <div style="text-align:justify;">Sujet :<br>&nbsp;<br>
//                        <table cellpadding="3">
//                            <tr>
//                                <td style="width:2%"></td>
//                                <td style="width:98%;">' . html_entity_decode($rec->getSujet()) . '</td>
//                            </tr>
//                            <tr>
//                                <td style="width:2%"></td>
//                                <td style="width:98%; text-align: center; font-size: 18px;">&nbsp;<br>* * * * *</td>
//                            </tr>
//                        </table>
//                    </div>
//                </div>';
//
//        return $html;
//    }

}
