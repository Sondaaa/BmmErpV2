<?php

require_once dirname(__FILE__) . '/../lib/planingGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/planingGeneratorHelper.class.php';

/**
 * planing actions.
 *
 * @package    Bmm
 * @subpackage planing
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class planingActions extends autoPlaningActions {

    public function executeFiltrerAgents(sfWebRequest $request) {
        $iddebut = $request->getParameter('iddebut');
        $idfin = $request->getParameter('idfin');
        $idu = $request->getParameter('idunite');
        $idregr = $request->getParameter('idregr');
        $ido = $request->getParameter('idorganisme');
        $idF = $request->getParameter('idF');
        $ids = $request->getParameter('idSousRubrique');
        $idd = $request->getParameter('idd');
        $idr = $request->getParameter('idRubrique');

        return $this->renderPartial("liste_filtre", array("iddebut" => $iddebut, "idfin" => $idfin, "idu" => $idu, "idregr" => $idregr, "ido" => $ido, "idF" => $idF, "ids" => $ids, "idd" => $idd, "idr" => $idr));
    }

     public function executeFiltrerFormationPArAgents(sfWebRequest $request) {
        $iddebut = $request->getParameter('iddebut');
        $idfin = $request->getParameter('idfin');
        $idu = $request->getParameter('idunite');
        $idag = $request->getParameter('idag');
        $ido = $request->getParameter('idorganisme');
        $idF = $request->getParameter('idF');
        $ids = $request->getParameter('idSousRubrique');
        $idd = $request->getParameter('idd');
        $idr = $request->getParameter('idRubrique');

        return $this->renderPartial("liste_filtre_formation", array("iddebut" => $iddebut, "idfin" => $idfin, "idu" => $idu, "idag" => $idag, "ido" => $ido, "idF" => $idF, "ids" => $ids, "idd" => $idd, "idr" => $idr));
    }
    //imprimer All listes
    public function executeImprimerAlllisteAllFilter(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $idreg = $request->getParameter('idreg');
        $ido = $request->getParameter('ido');
        $idf = $request->getParameter('idF');
        $iddebut = $request->getParameter('iddebut');
        $idfin = $request->getParameter('idfin');
        $idd = $request->getParameter('idd');
        $idr = $request->getParameter('idr');
        $ids = $request->getParameter('ids');
        $idu = $request->getParameter('idu');

        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
        $pdf->SetSubject("document du liste agents");
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
        $html = $this->ReadHtmlPersonelleAll($idreg, $ido, $idf, $iddebut, $idfin, $idd, $idr, $ids, $idu);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleAll($idreg, $ido, $idf, $iddebut, $idfin, $idd, $idr, $ids, $idu) {
        $html = StyleCssHeader::header1();
        $agent = new Agents();
        $html .= $agent->ReadHtmllisteAgentsAllFilter($idreg, $ido, $idf, $iddebut, $idfin, $idd, $idr, $ids, $idu);

        return $html;
    }

    
    //imprimer all liste des formtions par agents 
    
    
    public function executeImprimerAlllisteAllFilterFormationParAgents(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $idag = $request->getParameter('idag');
        $ido = $request->getParameter('ido');
        $idf = $request->getParameter('idF');
        $iddebut = $request->getParameter('iddebut');
        $idfin = $request->getParameter('idfin');
        $idd = $request->getParameter('idd');
        $idr = $request->getParameter('idr');
        $ids = $request->getParameter('ids');
        $idu = $request->getParameter('idu');

        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
        $pdf->SetSubject("document du liste agents");
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
        $html = $this->ReadHtmlPersonelleAllFormation($idag, $ido, $idf, $iddebut, $idfin, $idd, $idr, $ids, $idu);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleAllFormation($idag, $ido, $idf, $iddebut, $idfin, $idd, $idr, $ids, $idu) {
        $html = StyleCssHeader::header1();
        $agent = new Agents();
        $html .= $agent->ReadHtmllisteAgentsAllFilterParAgents($idag, $ido, $idf, $iddebut, $idfin, $idd, $idr, $ids, $idu);

        return $html;
    }

    //charger agents par regrouppement
    public function executeChargerAgnetsParRegroppement(sfWebRequest $request) {
        $idd = $request->getParameter('idd');
        return $this->renderPartial("listeagentsparregroupement", array("idd" => $idd));
    }

    //par sous rubrique
    public function executeChargerAgnetsParSousrubrique(sfWebRequest $request) {
        $idd = $request->getParameter('idd');
        return $this->renderPartial("listeagentsparsousrubrique", array("idd" => $idd));
    }

    //par rubrique 
    public function executeChargerAgnetsParRubrique(sfWebRequest $request) {
        $idd = $request->getParameter('idd');
        return $this->renderPartial("listeagentsparubrique", array("idd" => $idd));
    }

    //par dmaine d'utilisatin
    public function executeChargerAgnetsParDomaine(sfWebRequest $request) {
        $idd = $request->getParameter('idd');
        return $this->renderPartial("listeagentspardomaine", array("idd" => $idd));
    }

    public function executeChargerAgnetsParDomaineSousrubrique(sfWebRequest $request) {
        $idd = $request->getParameter('idd');
        $ids = $request->getParameter('idSousRubrique');
        return $this->renderPartial("listeagentspardomainesousrubrique", array("idd" => $idd, "ids" => $ids));
    }

    //charger pa domaine et rubrique
    public function executeChargerAgnetsParDomainerubrique(sfWebRequest $request) {
        $idd = $request->getParameter('idd');
        $idr = $request->getParameter('idRubrique');
        return $this->renderPartial("listeagentspardomainerubrique", array("idd" => $idd, "idr" => $idr));
    }

    //charger agents par sousrubrique et rubrique
    public function executeChargerAgnetsParSouRunriquerubrique(sfWebRequest $request) {
        $idd = $request->getParameter('idd');
        $idr = $request->getParameter('idRubrique');

        return $this->renderPartial("listeagentspasousrubriquerubrique", array("idd" => $idd, "idr" => $idr));
    }

    //charger agents par organisme 
    public function executeChargerAgnetsParOrganisme(sfWebRequest $request) {
        $idd = $request->getParameter('idd');
        return $this->renderPartial("listeagentsparorganisme", array("idd" => $idd));
    }

    //par formateur
    public function executeChargerAgnetsParFormateur(sfWebRequest $request) {
        $idd = $request->getParameter('idd');
        return $this->renderPartial("listeagentsparformateur", array("idd" => $idd));
    }

    public function executeChargerAgnetsParUnite(sfWebRequest $request) {
        $idd = $request->getParameter('idd');
        return $this->renderPartial("listeagentsparunite", array("idd" => $idd));
    }

    //unite regouppement 
    public function executeChargerAgnetsParUniteRegroupement(sfWebRequest $request) {
        $idd = $request->getParameter('idd');
        $idr = $request->getParameter('idregr');
        return $this->renderPartial("listeagentsparuniteregrouppement", array("idd" => $idd, "idr" => $idr));
    }

    //charger unite pa oganisme 
    public function executeChargerAgnetsParUniteOrganisme(sfWebRequest $request) {
        $idd = $request->getParameter('idd');
        $ido = $request->getParameter('idorganisme');
        return $this->renderPartial("listeagentsparuniteorganisme", array("idd" => $idd, "ido" => $ido));
    }

    //charger unite formateur 
    public function executeChargerAgnetsParUniteFormateur(sfWebRequest $request) {
        $idd = $request->getParameter('idd');
        $idF = $request->getParameter('idF');
        return $this->renderPartial("listeagentsparuniteformateur", array("idd" => $idd, "idF" => $idF));
    }

    //cahrger agents par annee
    public function executeChargerAgnetsParAnnee(sfWebRequest $request) {
        $idd = $request->getParameter('idd');
        return $this->renderPartial("listeagentsparannee", array("idd" => $idd));
    }

    //chager par annee debut 
    public function executeChargerAgnetsParAnneeDebut(sfWebRequest $request) {
        $idd = $request->getParameter('idd');
        return $this->renderPartial("listeagentsparanneedebut", array("idd" => $idd));
    }

    //debut et fin 
    public function executeChargerAgnetsParAnneeDebutFin(sfWebRequest $request) {
        $idd = $request->getParameter('idd');
        $idf = $request->getParameter('idfin');
        return $this->renderPartial("listeagentsparanneedebutfin", array("idd" => $idd, "idf" => $idf));
    }

    //anne fin unite 

    public function executeChargerAgnetsParAnneeFinUnite(sfWebRequest $request) {
        $idanne = $request->getParameter('idanne');
        $idu = $request->getParameter('idunite');
        return $this->renderPartial("listeagentsparanneefinunite", array("idanne" => $idanne, "idu" => $idu));
    }

    //charger par unite anne debut et fin 
    public function executeChargerAgnetsParAnneeDebutFinUnite(sfWebRequest $request) {
        $idd = $request->getParameter('idd');
        $idf = $request->getParameter('idfin');
        $idunite = $request->getParameter('idunite');
        return $this->renderPartial("listeagentsparanneedebutfinunite", array("idd" => $idd, "idf" => $idf, "idunite" => $idunite));
    }

    //annne debut unite 
    public function executeChargerAgnetsParAnneeDebutUnite(sfWebRequest $request) {
        $idd = $request->getParameter('idd');
        $idunite = $request->getParameter('idunite');
        return $this->renderPartial("listeagentsparanneedebutunite", array("idd" => $idd, "idunite" => $idunite));
    }

    //impression  edition consultation
    public function executeImprimerConsultation(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Planing();
        $idd = $request->getParameter('iddoc');

        $documents = Doctrine_Core::getTable('planing')->findOneById($idd);
        $doc = $documents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des Consultations:');
        $pdf->SetSubject("document du liste consultation");
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
        $html = $this->ReadHtmlPlaning($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Consultations' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPlaning($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllistePlaning($idd);

        return $html;
    }

//---------------------------
//-----------------
//impression planing previsionnel 

    public function executeImprimerPlannigprevisionnel(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Planing();
        $idd = $request->getParameter('iddoc');

        $documents = Doctrine_Core::getTable('planing')->findOneById($idd);
        $doc = $documents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des Consultations:');
        $pdf->SetSubject("document du liste consultation");
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
        $html = $this->ReadHtmlPlaningPrvisionnelle($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Consultations' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPlaningPrvisionnelle($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllistePlaningPrevisionnlle($idd);

        return $html;
    }

    //----------------------------
    //impressin all agents qu font la formation 

    public function executeImprimerAlllisteparregrouppement(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('idreg');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
        $pdf->SetSubject("document du liste agents");
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
        $html = $this->ReadHtmlPersonelleParRegroupement($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleParRegroupement($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparRegrouppement($idd);

        return $html;
    }

//par sous rubrique 


    public function executeImprimerAlllisteparsousrubrique(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('idsousrubrique');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
        $pdf->SetSubject("document du liste agents");
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
        $html = $this->ReadHtmlPersonelleParsousrubrique($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleParsousrubrique($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparSousrubrique($idd);

        return $html;
    }

//par rubrique 

    public function executeImprimerAlllisteparrubrique(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('idrubrique');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
        $pdf->SetSubject("document du liste agents");
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
        $html = $this->ReadHtmlPersonelleParrubrique($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleParrubrique($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparRubrique($idd);

        return $html;
    }

//par domaine dutlisation 


    public function executeImprimerAlllisteparDomaine(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('iddomaine');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
        $pdf->SetSubject("document du liste agents");
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
        $html = $this->ReadHtmlPersonelleParDomaine($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleParDomaine($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparDomaine($idd);

        return $html;
    }

//domaine et sous rubrique 

    public function executeImprimerAlllisteparDomaineSousRubrique(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('iddomaine');
        $ids = $request->getParameter('idsousrubriique');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
        $pdf->SetSubject("document du liste agents");
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
        $html = $this->ReadHtmlPersonelleParDomaineSousrubrique($idd, $doc, $ids);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleParDomaineSousrubrique($idd, $documents, $ids) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparDomaineSousRubrique($idd, $ids);

        return $html;
    }

//impression par organisme 

    public function executeImprimerAlllisteparorganisme(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('idfournisseur');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
        $pdf->SetSubject("document du liste agents");
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
        $html = $this->ReadHtmlPersonelleParOrganisme($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleParOrganisme($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparOrganisme($idd);

        return $html;
    }

    //par formateur


    public function executeImprimerAlllisteparFormateur(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('idformateur');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
        $pdf->SetSubject("document du liste agents");
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
        $html = $this->ReadHtmlPersonelleParFormateur($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleParFormateur($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparFormateur($idd);

        return $html;
    }

//impression all agents par unite


    public function executeImprimerAlllisteparunite(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('idunite');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
        $pdf->SetSubject("document du liste agents");
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
        $html = $this->ReadHtmlPersonelleParUnite($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleParUnite($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparUniteFormation($idd);

        return $html;
    }

//unite regroupement theme 


    public function executeImprimerAlllisteparuniteRegrouppement(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('idunite');
        $idreg = $request->getParameter('idreg');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
        $pdf->SetSubject("document du liste agents");
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
        $html = $this->ReadHtmlPersonelleParUniteRegroupement($idd, $doc, $idreg);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleParUniteRegroupement($idd, $documents, $idreg) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparUniteRegroupement($idd, $idreg);

        return $html;
    }

//unite organisme 

    public function executeImprimerAlllisteparuniteOrganisme(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('idunite');
        $ido = $request->getParameter('idorganisme');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
        $pdf->SetSubject("document du liste agents");
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
        $html = $this->ReadHtmlPersonelleParUniteOrganisme($idd, $doc, $ido);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleParUniteOrganisme($idd, $documents, $ido) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparUniteOrganisme($idd, $ido);

        return $html;
    }

//unite formateur 

    public function executeImprimerAlllisteparuniteFormateur(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Agents();
        $idd = $request->getParameter('idunite');
        $idF = $request->getParameter('idformateur');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
        $pdf->SetSubject("document du liste agents");
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
        $html = $this->ReadHtmlPersonelleParUniteFormateur($idd, $doc, $idF);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleParUniteFormateur($idd, $documents, $idF) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparUniteFormateur($idd, $idF);

        return $html;
    }

//---------impression domaine dutilisation

    public function executeImprimerAlllisteDomaine(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Domaineuntilisation();

        $documentagents = Doctrine_Core::getTable('Domaineuntilisation')->findOneById(4);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des Domaine d"utilisaton:');
        $pdf->SetSubject("document du liste Domaine dutilisation");
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
        $html = $this->ReadHtmlDomaine($doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlDomaine($documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteDomaineutilisation();

        return $html;
    }

//--------impresson all rubrique
    public function executeImprimerAlllisteRubrique(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Rubriqueformation();

        $document = Doctrine_Core::getTable('rubriqueformation')->findOneById(1);

        $doc = $document;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des Rbriques :');
        $pdf->SetSubject("document du liste des Rubriques");
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
        $html = $this->ReadHtmlRubrique($doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlRubrique($documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteRubriique();

        return $html;
    }

//charger rubrique par domaine 


    public function executeChargerRubriquePardomaine(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("rubriqueformation/rubriquepardomaine", array("idd" => $idd));
    }
    
    public function executeChargerRubriquePardomaine1(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("rubriqueformation/rubriquepardomaine1", array("idd" => $idd));
    }

//charger sous rubrique par domaine **

    public function executeChargerSousRubriquePardomine(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("sousrubrique/sousrubriquepardomaine", array("idd" => $idd));
    }
     public function executeChargerSousRubriquePardomine1(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("sousrubrique/sousrubriquepardomaine1", array("idd" => $idd));
    }
    //cahrger sous rubriique par rubrique 

    public function executeChargerSousRubriqueParRubrique(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("sousrubrique/sousrubriqueparrubrique", array("idd" => $idd));
    }
     public function executeChargerSousRubrique_ParRubrique1(sfWebRequest $request) {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("sousrubrique/sousrubriqueparrubrique_2", array("idd" => $idd));
    }
    //imression sousrubrique par rubrique
    //--------impression sous rubrique 


    public function executeImprimerAlllisteSousrubrique(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Sousrubrique();

        $document = Doctrine_Core::getTable('sousrubrique')->findOneById(1);

        $doc = $document;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des Sous Rubriques:');
        $pdf->SetSubject("document du liste Sous Rubriques");
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
        $html = $this->ReadHtmlSousRubrique($doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlSousRubrique($documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteSousRubriique();

        return $html;
    }

//---impression organisme 

    public function executeImprimerAlllisteOrganisme(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Fournisseur();

        $fournisseur = Doctrine_Core::getTable('fournisseur')->findOneById(104);

        $doc = $fournisseur;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des Fournisseurs:');
        $pdf->SetSubject("document du liste Fournisseur");
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
        $html = $this->ReadHtmlOrganisme($doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlOrganisme($documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteOrganisme($idd);

        return $html;
    }

//-----------impession agents qui font formation en annee


    public function executeImprimerAlllisteparAnnee(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Corps();
        $idd = $request->getParameter('idannee');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
        $pdf->SetSubject("document du liste agents");
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
        $html = $this->ReadHtmlPersonelleparAnnee($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparAnnee($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparAnnee($idd);

        return $html;
    }

    //imprimer liset anne debut 


    public function executeImprimerAlllisteparAnneedebut(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Corps();
        $idd = $request->getParameter('idannee');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
        $pdf->SetSubject("document du liste agents");
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
        $html = $this->ReadHtmlPersonelleparAnneeDebut($idd, $doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparAnneeDebut($idd, $documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparAnneeDebut($idd);

        return $html;
    }

//------------- anne debut et fin 

    public function executeImprimerAlllisteparAnneedebutfin(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Corps();
        $idd = $request->getParameter('idannee');
        $idf = $request->getParameter('idannefin');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
        $pdf->SetSubject("document du liste agents");
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
        $html = $this->ReadHtmlPersonelleparAnneeDebutFin($idd, $doc, $idf);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparAnneeDebutFin($idd, $documents, $idf) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparAnneeDebutFin($idd, $idf);

        return $html;
    }

//annne debut unite 
    public function executeImprimerAlllisteparAnneedebutUnite(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Corps();
        $idd = $request->getParameter('idannee');
        $idu = $request->getParameter('idunite');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
        $pdf->SetSubject("document du liste agents");
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
        $html = $this->ReadHtmlPersonelleparAnneeDebutUnite($idd, $doc, $idu);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparAnneeDebutUnite($idd, $documents, $idu) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparAnneeDebutUnite($idd, $idu);

        return $html;
    }

//anne fin unite 

    public function executeImprimerAlllisteparAnneefinUnite(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Corps();
        $idd = $request->getParameter('idannee');
        $idu = $request->getParameter('idunite');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
        $pdf->SetSubject("document du liste agents");
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
        $html = $this->ReadHtmlPersonelleparAnneefinUnite($idd, $doc, $idu);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparAnneefinUnite($idd, $documents, $idu) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparAnneefinUnite($idd, $idu);

        return $html;
    }

//anne debut et fin et unite 
//
    public function executeImprimerAlllisteparAnneedebutfinUnite(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Corps();
        $idd = $request->getParameter('idannee');
        $idf = $request->getParameter('idannefin');
        $idunite = $request->getParameter('idunite');

        $documentagents = Doctrine_Core::getTable('agents')->findOneById(104);

        $doc = $documentagents;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des agents:');
        $pdf->SetSubject("document du liste agents");
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
        $html = $this->ReadHtmlPersonelleparAnneeDebutFinUnite($idd, $doc, $idf, $idunite);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlPersonelleparAnneeDebutFinUnite($idd, $documents, $idf, $idunite) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteAgentsparAnneeDebutFinUnite($idd, $idf, $idunite);

        return $html;
    }

//-------impresson liste unite 

    public function executeImprimerAllliste(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Unite();

        $documentd = Doctrine_Core::getTable('unite')->findOneById(25);

        $doc = $documentd;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des unite :');
        $pdf->SetSubject("document du liste unite");
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
        $html = $this->ReadHtmlAllUnite($doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste service ' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlAllUnite($documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmlAlllisteUnite();

        return $html;
    }

    //-------------formateur
    public function executeImprimerAlllisteFormateur(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Formateur();

        $formateur = Doctrine_Core::getTable('Formateur')->findOneById(1);

        $doc = $formateur;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des Formateurs:');
        $pdf->SetSubject("document du liste Formateurs");
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
        $html = $this->ReadHtmlFormateur($doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFormateur($documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteFormateur();

        return $html;
    }

    //impression liste annee 

    public function executeImprimerAlllisteAnee(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $doc = new Besoinsdeformation();

        $besoions = Doctrine_Core::getTable('besoinsdeformation')->findOneById(11);

        $doc = $besoions;
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Listes des Besoins de Formation:');
        $pdf->SetSubject("document du liste Besoins de Formation");
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
        $html = $this->ReadHtmlbesoinsdeformation($doc);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste agents' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlbesoinsdeformation($documents) {
        $html = StyleCssHeader::header1();

        $html .= $documents->ReadHtmllisteBesoinsFormation();

        return $html;
    }

//---------------
    public function executeAffichedetailBesoins(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idagent = $params['idag'];
            $ag = new Agents();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT  besoinsdeformation.id_agents idage, agents.idrh as idrh ,agents.nomcomplet as nom "
                    . " FROM agents,besoinsdeformation "
                    . " WHERE besoinsdeformation.id_agents=agents.id "
                    . " and besoinsdeformation.id=" . $idagent
                    . "Limit 1";


            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    //save document 
    public function executeSavedocumentPlaning(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);

            $listeslignesdocP = $params['listeLignedocsPlaning'];
            $montantTotal = $params['montantT'];
            $idp = $params['idplaning'];



            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

            Doctrine_Query::create()->delete('ligneplaning')
                    ->where('id_pluning=' . $idp)
                    ->execute();

            foreach ($listeslignesdocP as $lignedocL) {
                $ntheme = $lignedocL['ntheme'];
                $theme = $lignedocL['theme'];
                $magbesoins = $lignedocL['idmagbesoins'];
                $nordre1 = $lignedocL['norgdre'];
                $magreg = $lignedocL['idmagreg'];
                $magsousrubrique = $lignedocL['idmagsousru'];
                $montant = $lignedocL['montantht'];
                $valide = $lignedocL['valide'];


                $ligneplaning = new ligneplaning();
                if ($valide == 'true')
                    $ligneplaning->setValide(true);
                else
                    $ligneplaning->setValide(false);

                if ($ntheme != "")
                    $ligneplaning->setNumtheme($ntheme);
                if ($theme != "")
                    $ligneplaning->setTheme($theme);
                if ($magbesoins != "")
                    $ligneplaning->setIdBesoins($magbesoins);
                if ($magreg != "")
                    $ligneplaning->setIdRegroupement($magreg);
                if ($magsousrubrique != "")
                    $ligneplaning->setIdSousrubrique($magsousrubrique);
                if ($nordre1 != "")
                    $ligneplaning->setNordre($nordre1);
                if ($montant != "")
                    $ligneplaning->setMontant($montant);
                if ($montantTotal != "")
                    $ligneplaning->setMontanttotalht($montantTotal);
                if ($idp != "")
                    $ligneplaning->setIdPluning($idp);

                $ligneplaning->save();
            }


            $ligneplaning->save();
        }
        die('ajout avec succe');
    }

//save entete
    public function executeSavedocument(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {

            $params = json_decode($content, true);
            $annee = $params['annee'];
            $obj = $params['ob'];
            $eligible = $params['eligible'];
            $noeligible = $params['noneligible'];

            $id = $params['id'];
            $plani = new Planing();
            if ($id != "") {
                $pla = Doctrine_Core::getTable('planing')->findOneById($id);
                if ($pla)
                    $plani = $pla;
            }
            if ($annee != "")
                $plani->setAnnee($annee);
            if ($obj != "")
                $plani->setObjet($obj);

            if ($eligible == 'true')
                $plani->setElignible(true);
            else
                $plani->setElignible(false);

            if ($noeligible == 'true')
                $plani->setNoneligibletfp(true);
            else
                $plani->setNoneligibletfp(false);



            $plani->save();
            die($plani->getId() . "");
        }
        die('erreurr !!!');
    }

    //edit 
    public function executeEdit(sfWebRequest $request) {

        $this->planing = Doctrine_Core::getTable('planing')->findOneById($request->getParameter('id'));
        $this->form = $this->configuration->getForm($this->planing);
    }

    //affichage pla 
    public function executeAffichePlan(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idpl = $params['id'];
            $query = " select ligneplaning.nordre as norgdre ,"
                    . ""
                    . " ligneplaning.id_formateur as is dif"
                    . " ,formateur.nom as formateur "
                    . ",ligneplaning.id_besoins as idbesoin ,"
                    . " ligneplaning.numtheme as ntheme , "
                    . " ligneplaning.theme  as theme ,"
                    . " ligneplaning.montant as montantht  ,"
                    . " ligneplaning.montanttotalht as montanttotal"
                    . ", besoinsdeformation.besoins as magbesoins,"
                    . " besoinsdeformation.id_agents as idage ,agents.idrh as idrh , "
                    . " agents.nomcomplet as nom ,ligneplaning.valide as valide "
                    . " , ligneplaning.id_regroupement  as idgr ,"
                    . " regroupementtheme.libelle as magreg"
                    . " , ligneplaning.id_sousrubrique as idsous, "
                    . " sousrubrique.libelle as magsousrubrique"
                    . " from formateur,ligneplaning,besoinsdeformation,agents,regroupementtheme,sousrubrique"
                    . " where ligneplaning.id_regroupement= regroupementtheme.id "
                    . " and ligneplaning.id_besoins=besoinsdeformation.id"
                    . " and besoinsdeformation.id_agents =agents.id"
                    . " and ligneplaning.id_sousrubrique= sousrubrique.id"
                    . " and ligneplaning.id_pluning=" . $idpl


            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }

    //affichage ligne planing 

    public function executeAffichelignePlaning(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idpl = $params['id'];

            $query = " select ligneplaning.nordre as norgdre"
                    . ",ligneplaning.numtheme as ntheme ,"
                    . " ligneplaning.theme  as theme,"
                    . " TRIM(ligneplaning.montant) as montantht  , "
                    . " ligneplaning.id_besoins as idmagbesoins ,"
                    . "  besoinsdeformation.besoins as magbesoins ,"
                    . " besoinsdeformation.id_agents as idage ,"
                    . " agents.idrh as idrh ,agents.nomcomplet as nom "
                    . " ,ligneplaning.valide as valide ,"
                    . " ligneplaning.id_regroupement  as idmagreg, "
                    . " regroupementtheme.libelle as magreg ,"
                    . " ligneplaning.id_sousrubrique as idmagsousru ,"
                    . " sousrubrique.libelle as magsousrubrique  "
                    . " from ligneplaning , besoinsdeformation ,agents,regroupementtheme ,sousrubrique"
                    . " where ligneplaning.id_besoins=besoinsdeformation.id"
                    . " and ligneplaning.id_regroupement= regroupementtheme.id"
                    . " and besoinsdeformation.id_agents =agents.id "
                    . " and ligneplaning.id_sousrubrique=sousrubrique.id "
                    . " and ligneplaning.id_pluning=" . $idpl
                    . " GROUP BY nordre ,ligneplaning.numtheme,ligneplaning.montant,ligneplaning.theme,"
                    . " ligneplaning.nordre,ligneplaning.id_besoins,ligneplaning.montanttotalht,"
                    . " besoinsdeformation.besoins,besoinsdeformation.id_agents"
                    . ",agents.idrh,agents.nomcomplet,ligneplaning.valide "
                    . ",ligneplaning.id_regroupement,ligneplaning.id_sousrubrique,sousrubrique.libelle"
                    . " ,regroupementtheme.libelle"
                    . " ORDER BY nordre ASC"
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }

    public function executeAffichemontant(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idpl = $params['id'];

            $query = " select ligneplaning.montanttotalht as montanttotal"
                    . " from ligneplaning"
                    . " where ligneplaning.id_pluning=" . $idpl

            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $res = $conn->fetchAssoc($query);
            die(json_encode($res));
        }
        die("bien");
    }

//    public function executeAffichePlan(sfWebRequest $request) {
//        header('Access-Control-Allow-Origin: *');
//        $params = array();
//        $content = $request->getContent();
//        $user =  $this->getUser()->getAttribute('userB2m');
//        if (!empty($content)) {
//            $params = json_decode($content, true);
//            $idpl = $params['id'];
//            //$planing = new Planing();
//
//            // die(json_encode($idpl));
//            die("/iddoc/" . $idpl);
//        }
//        die("bien");
//    }

    public function executeShowdocument(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@planing');
        $iddoc = $request->getParameter('iddoc');
        $this->planing = Doctrine_Core::getTable('planing')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('ligneplaning')
                        ->createQuery('a')
                        ->where('id_pluning=' . $iddoc)
                        ->orderBy('id asc')->execute();
    }

    public function executeShowRealisation(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@planing');
        $iddoc = $request->getParameter('iddoc');
        $this->planing = Doctrine_Core::getTable('planing')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('ligneplaning')
                        ->createQuery('a')
                        ->where('id_pluning=' . $iddoc)
                        ->orderBy('id asc')->execute();
    }

//delete 
    public function executeDelete(sfWebRequest $request) {
        $iddoc = $request->getParameter('id');
        //_________suppr. ligne doc
        Doctrine_Query::create()->delete('ligneplaning')
                ->where('id_pluning=' . $iddoc)->execute();

        $this->forward404Unless($agents = Doctrine_Core::getTable('planing')->find(array($request->getParameter('id'))), sprintf('Object fiche does not exist (%s).', $request->getParameter('id')));
        $agents->delete();

        $this->redirect('@planing');
    }

//save ligne planing realisation 

    public function executeSavelignePlaningRealisation(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $iddoc = $request->getParameter('iddoc');

        $content = $request->getContent();

        if (!empty($content)) {

            $params = json_decode($content, true);
            $id = $params['id'];
            $fo = $params['form'];
            $montanttotal = $params['monttotal'];

            $org = $params['org'];
            $mtva = $params['mtva'];
            $mo = $params['mont'];
            $tva = $params['tva'];
            $monttc = $params['montanttc'];

            $datedprevu = $params['datedprevu'];
            $datefprevu = $params['datefprevu'];

            $plani = LigneplaningTable::getInstance()->find($id);
            if ($fo != "")
                $plani->setIdFormateur($fo);
            if ($mtva != "")
                $plani->setMtva($mtva);
            if ($org != "")
                $plani->setIdFournisseur($org);
            if ($mo != "")
                $plani->setMontantht($mo);
            if ($tva != "")
                $plani->setIdTva($tva);
            if ($monttc != "")
                $plani->setMontantttc($monttc);
            if ($montanttotal != "")
                $plani->getPlaning()->setMontanttotalht($montanttotal);

            if ($datedprevu != "")
                $plani->setDatedebutprevu($datedprevu);
            if ($datefprevu != "")
                $plani->setDatefinprevu($datefprevu);

            $plani->save();
        }
        die('erreurr !!!');
    }

//save ligne suivi reglment 

    public function executeSavelignesuivireglement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {

            $params = json_decode($content, true);
            $id = $params['id'];
            $idfacture = $params['idfacture'];

            $plani = LigneplaningTable::getInstance()->find($id);
            if ($idfacture != "")
                $plani->setIdFacture($idfacture);

            $plani->save();
        }
        die('ajout avec success !!!');
    }

//save ligne planing
    public function executeSavelignePlaning(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $iddoc = $request->getParameter('iddoc');

        $content = $request->getContent();

        if (!empty($content)) {

            $params = json_decode($content, true);
            $id = $params['id'];
            $fo = $params['form'];
            $montanttotal = $params['monttotal'];

            $org = $params['org'];
            $mtva = $params['mtva'];
            $mo = $params['mont'];
            $tva = $params['tva'];
            $monttc = $params['montanttc'];
            $dated = $params['datede'];
            $datef = $params['datefin'];

            $nbj = $params['nbrj'];
            $nbh = $params['nbh'];
            $mris = $params['mris'];
            $msoc = $params['msoc'];

            $motif = $params['motif'];
            $realise = $params['realise'];
            $montanttotalresalise = $params['montanttotalresalise'];


            $plani = LigneplaningTable::getInstance()->find($id);
            if ($realise == 'true')
                $plani->setRealise(true);
            else
                $plani->setRealise(false);
            if ($motif != "")
                $plani->setMotif($motif);

            if ($fo != "")
                $plani->setIdFormateur($fo);
            if ($mtva != "")
                $plani->setMtva($mtva);
            if ($org != "")
                $plani->setIdOrganisme($org);
            if ($mo != "")
                $plani->setMontantht($mo);
            if ($tva != "")
                $plani->setIdTva($tva);
            if ($monttc != "")
                $plani->setMontantttc($monttc);
            if ($dated != "")
                $plani->setDateformation($dated);
            if ($datef != "")
                $plani->setDatefin($datef);
            if ($nbj != "")
                $plani->setNbrjour($nbj);

            if ($nbh != "")
                $plani->setNbrheure($nbh);


            if ($msoc != "")
                $plani->setMontantristourne($msoc);

            if ($mris != "")
                $plani->setMontantsociete($mris);


            if ($montanttotal != "")
                $plani->getPlaning()->setMontanttotalht($montanttotal);
            if ($montanttotalresalise != "")
                $plani->getPlaning()->setMontantttc($montanttotalresalise);


            $plani->save();
        }
        die('erreurr !!!');
    }

//save ligne tableau

    public function executeSaveligneTableau(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $iddoc = $request->getParameter('iddoc');

        $content = $request->getContent();

        if (!empty($content)) {

            $params = json_decode($content, true);

            $nbrjr = $params['nbjr'];
            $nbrh = $params['nbrh'];
            $mris = $params['mris'];

            $msoc = $params['msoc'];
            $modal = $params['modalite'];

            $id = $params['id'];
            $plani = LigneplaningTable::getInstance()->find($id);
            if ($nbrjr != "")
                $plani->setNbrjour($nbrjr);
            if ($nbrh != "")
                $plani->setNbrheure($nbrh);
            if ($mris != "")
                $plani->setMontantristourne($mris);
            if ($msoc != "")
                $plani->setMontantsociete($msoc);

            if ($modal != "")
                $plani->setModalitecalcul($modal);
            $plani->save();
        }
        die('erreurr !!!');
    }

//calcul M.TTC
    public function executeShowPlan(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@planing');
        $iddoc = $request->getParameter('iddoc');
        $this->planing = Doctrine_Core::getTable('planing')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('ligneplaning')
                        ->createQuery('a')
                        ->where('id_pluning=' . $iddoc)
                        ->orderBy('id asc')->execute();
    }

//    public function executeTableaudebordformation(sfWebRequest $request) {
//        if (!$request->getParameter('iddoc'))
//            $this->redirect('@planing');
//        $iddoc = $request->getParameter('iddoc');
//
//
//        $this->planing = Doctrine_Core::getTable('planing')->findOneById($iddoc);
//        $this->listesdocuments = Doctrine_Core::getTable('ligneplaning')
//                        ->createQuery('a')
//                        ->where('id_pluning=' . $iddoc)
//                        ->orderBy('id asc')->execute();
//    }

    public function executeFacturation(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@planing');
        $iddoc = $request->getParameter('iddoc');


        $this->planing = Doctrine_Core::getTable('planing')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('ligneplaning')
                        ->createQuery('a')
                        ->where('id_pluning=' . $iddoc)
                        ->orderBy('id asc')->execute();
    }

//affiche detail facture


    public function executeAffichedetailFacture(sfWebRequest $request) {
//        header('Access-Control-Allow-Origin: *');
//        $params = array();
//        $content = $request->getContent();
//        $params = json_decode($content, true);
        $idFacture = $request->getParameter('idf');

//        $ag = new Documentachat();
//        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//        $query = "SELECT documentachat.mntttc as montantfacturenet"
//                . " ,documentachat.id_docparent as idbce , "
//                . "documentachat.id as iddoce"
//                . " FROM documentachat"
//                . " WHERE  documentachat.id= " . $idFacture
//        ;
//        $query2 = "SELECT documentachat.id_docparent as idbci , "
//                . "documentachat.id as id"
//                . " FROM documentachat"
//                . " WHERE  documentachat.id= documentachat.id_docparent" 
//        ;
        $this->facture = DocumentachatTable::getInstance()->find($idFacture);
        $this->piecejout = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($idFacture);
        $this->certificat = CertificatretenueTable::getInstance()->findOneByIdDocumentbudget($this->piecejout->getIdDocumentbudget());

        $this->bce = DocumentachatTable::getInstance()->find($this->facture->getIdDocparent());
        if ($this->bce->getIdTypedoc() == 7) {
            $this->bci = DocumentachatTable::getInstance()->find($this->bce->getIdDocparent());

            $this->ordonencement = LigneoperationcaisseTable::getInstance()->findOneByIdDocachat($this->bce->getId());
        } else {
            $this->bce2 = DocumentachatTable::getInstance()->find($this->bce->getIdDocparent());

            $this->bci = DocumentachatTable::getInstance()->find($this->bce2->getIdDocparent());
            $this->ordonencement = LigneoperationcaisseTable::getInstance()->findOneByIdDocachat($this->bce2->getId());
        }

        $this->idligne = $request->getParameter('idl');


//        $resultat = $conn->fetchAssoc($query);
//        die(json_encode($resultat));
    }

    public function executeVerifExistance(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $annee = $params['annee'];
            $id = $params['id'];

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT coalesce(planing.id, 0) id"
                    . " FROM planing "
                    . " WHERE planing.annee=" . $annee;


//            $plannings = Doctrine_Query::create()
//                    ->select('p.*')
//                    ->from('Planing p')
//                    ->where('p.annee=' . $annee);


            if ($id != '')
                $query = $query . " AND planing.id <> " . $id;

            $resultat = $conn->fetchAssoc($query);

            die(json_encode($resultat));

//            $planing_existe = $plannings->execute();
//
//            die($planing_existe->count());
        }
        die('test');
    }

}
