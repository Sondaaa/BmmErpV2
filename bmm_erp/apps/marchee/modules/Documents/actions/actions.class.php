<?php

/**
 * Boncommandeexterne actions.
 *
 * @package    Bmm
 * @subpackage Boncommandeexterne
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentsActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->texte="";
        $this->id="";
        $this->documentachat=null;
        if ($request->getParameter('id')&&$request->getParameter('id')!="") {
            $this->documentachats = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')
                    ->where('id_typedoc=7')
                    ->andwhere('id_docparent='.$request->getParameter('id'))
                    ->execute();
            $this->documentdeponses = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')
                    ->where('id_typedoc=2')
                    ->andwhere('id_docparent='.$request->getParameter('id'))
                    ->execute();
            $this->demandesprix = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')
                    ->where('id_typedoc=8')
                    ->andwhere('id_docparent='.$request->getParameter('id'))
                    ->execute();
            $doc=new Documentachat();
            $document=Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('id'));
            $this->documentachat=$document;
            $doc=$document;
            $this->id=$request->getParameter('id');
            $this->texte=$doc->getDatecreation().'-'. $doc->getNumerodocachat().'-'.trim($doc->getReference()).'-'.$doc->getAgents();
        }
    }

    public function executeShow(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new documentachatForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new documentachatForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id'))), sprintf('Object documentachat does not exist (%s).', $request->getParameter('id')));
        $this->form = new documentachatForm($documentachat);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id'))), sprintf('Object documentachat does not exist (%s).', $request->getParameter('id')));
        $this->form = new documentachatForm($documentachat);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id'))), sprintf('Object documentachat does not exist (%s).', $request->getParameter('id')));
        $documentachat->delete();

        $this->redirect('Boncommandeexterne/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $documentachat = $form->save();

            $this->redirect('Boncommandeexterne/edit?id=' . $documentachat->getId());
        }
    }
    
    //___________________________________________________________________________Detail ligne doc Detail demande de prix
    public function executeDetaildemandedeprix(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $demandedeprix=new Documentachat();
            $dem=Doctrine_Core::getTable('documentachat')->findOneById($id);
            $demandedeprix=$dem;
           
            die($demandedeprix->getHtmlDemandedeprix());
        }
        //die($q);
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
     public function executeImprimerreclamation(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $id = $request->getParameter('iddoc');
        $reclamation = Doctrine_Core::getTable('reclamationfrs')->findOneById($id);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Réclamation');
        $pdf->SetSubject("Fiche Réclamation");

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

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // dejavusans or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        $html = $this->ReadHtmlReclamation($reclamation);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Réclamation' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlReclamation($reclamation) {
        $html = StyleCssHeader::header1();
        $rec = new Reclamationfrs();
        $rec = $reclamation;
        $html.='<div class="contenue">
                    <div class="titre"><h3 style="font-size: 18px;">Réclamation Fournisseur</h3></div>
                    &nbsp;<br>
                    <div> 
                        <table style="width:100%;" class="tablecontenue">
                            <tr>
                                <td style="width:15%">Date</td> 
                                <td style="width:2%">:</td>
                                <td style="width:83%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . date('d/m/Y', strtotime($rec->getDaterec())) . '</p></td>
                            </tr>
                            <tr>
                                <td style="width:15%;">Object</td>
                                <td style="width:2%">:</td>
                                <td style="width:83%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $rec->getObject() . '</p></td>
                            </tr>
                             <tr>
                                <td style="width:15%">Fournisseur</td>
                                <td style="width:2%">:</td>
                                <td style="width:83%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $rec->getFournisseur() . '</p></td>
                            </tr>
                        </table>
                    </div>
                    <div style="text-align:justify;">Sujet :<br>&nbsp;<br>
                        <table cellpadding="3">
                            <tr>
                                <td style="width:2%"></td>
                                <td style="width:98%;">' . html_entity_decode($rec->getSujet()) . '</td>
                            </tr>
                            <tr>
                                <td style="width:2%"></td>
                                <td style="width:98%; text-align: center; font-size: 18px;">&nbsp;<br>* * * * *</td>
                            </tr>
                        </table>
                    </div>
                </div>';

        return $html;
    }


}
