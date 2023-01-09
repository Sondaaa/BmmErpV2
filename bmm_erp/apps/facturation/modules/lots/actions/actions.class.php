<?php

require_once dirname(__FILE__) . '/../lib/lotsGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/lotsGeneratorHelper.class.php';

/**
 * lots actions.
 *
 * @package    Bmm
 * @subpackage lots
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class lotsActions extends autoLotsActions {

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());
        $documentsachat = Doctrine_Core::getTable('lots')
                ->createQuery('a')
                ->where('id IN (SELECT d.id_lots FROM detailprix d WHERE d.id_typedetailprix = 2)');
        if (isset($filter['id_frs'])) {
            $documentsachat = $documentsachat->Andwhere('id_frs=' . $filter['id_frs']);
        }
        if (isset($filter['id_marche'])) {
            $documentsachat = $documentsachat->Andwhere('id_marche=' . $filter['id_marche']);
        }
        $this->addSortQuery($query);
        $query = $documentsachat->OrderBy('id desc');

        return $query;
    }

    public function executeSavesousdetail(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idlot'];
            $mntht = $params['mntht'];
            $rrr = $params['rrr'];
            $idtva = $params['idtva'];
            $mntapresrrr = $params['mntapresrrr'];
            $tauxtva = $params['tauxtva'];
            $idtype = $params['idtype'];
            $ttcnet = $params['ttcnet'];
            $ancin_id_type = "";
            $sousdetail = $params['sousdetail'];
            $detailprix = new Detailprix(); //die($id.'hh');
            $listesdetais = Doctrine_Core::getTable('detailprix')
                            ->createQuery('a')->where('id_lots=' . $id)
                            ->andwhere('id_typedetailprix in (1,2)')
                            ->orderBy('id asc')->execute();

            if (count($listesdetais) > 0) {
                $detailprix = $listesdetais[0];
                $ancin_id_type = $detailprix->getIdTypedetailprix();
            }

            if ((count($listesdetais) > 0 && $ancin_id_type != "" && $ancin_id_type == 1) || !$listesdetais[0]) {
                $detailprix->setIdTva($idtva);
                $detailprix->setTotalgeneral($ttcnet);
                $detailprix->setRrr($rrr);
                $detailprix->setTotalapresremise($mntapresrrr);
                $detailprix->setHtva($mntht);
                $detailprix->setTauxtva($tauxtva);
                $detailprix->setMnttva($ttcnet - $mntapresrrr);
                $detailprix->setTotal($mntht);
                $detailprix->setIdLots($id);
                $detailprix->setIdTypedetailprix($idtype);
                $detailprix->save();
            }

            $parent = "";
            $chaine = "";
            
            if ($ancin_id_type == 1) {
                foreach ($sousdetail as $sdetail) {
                    $Sdetail = new Sousdetailprix();
                    $nordre = $sdetail['nordre'];
                    $designation = $sdetail['designation'];
                    $idunite = $sdetail['idunite'];
                    $qte = $sdetail['qte'];
                    $puht = $sdetail['puht'];
                    $totalht = $sdetail['totalht'];

                    $chaine.='/' . $nordre;

                    $ss = Doctrine_Core::getTable('sousdetailprix')->findOneByIdDetailAndNordre($detailprix->getId(), $nordre);
                    if ($ss)
                        $Sdetail = $ss;

                    $type_av = "";
                    if ($sdetail['typeavenant']) {
                        $type_av = "avenant";
                        $Sdetail->setTypeavenant($type_av);
                    }
                    $Sdetail->setNordre($nordre);
                    if ($idunite != "")
                        $Sdetail->setIdUnite($idunite);
                    $Sdetail->setDesignation($designation);
                    if ($qte != "")
                        $Sdetail->setQuetiteant($qte);
                    if ($totalht != "")
                        $Sdetail->setPrixthtva($totalht);
                    if ($puht != "")
                        $Sdetail->setPrixunitaire($puht);
                    $Sdetail->setIdDetail($detailprix->getId());
                    if (intval($nordre) - $nordre == 0) {
                        $parent = $nordre;
                    }
                    if ($parent != "") {
                        $idsousdetail = Doctrine_Core::getTable('sousdetailprix')->findOneByIdDetailAndNordre($detailprix->getId(), $parent);
                        if ($idsousdetail && !$ss)
                            $Sdetail->setIdSousdetail($idsousdetail->getId());
                    }
                    $Sdetail->save();
                }
            }

            //$detailprix->save();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT sousdetailprix.nordre, sousdetailprix.designation as designation, "
                    . "sousdetailprix.id_unite as idunite, unitemarche.libelle as unite, "
                    . "sousdetailprix.quetiteant as qte, "
                    . "sousdetailprix.prixunitaire as puht, sousdetailprix.prixthtva as totalht "
                    . "FROM sousdetailprix, detailprix, lots,unitemarche "
                    . "WHERE sousdetailprix.id_detail = detailprix.id "
                    . "AND sousdetailprix.id_unite = unitemarche.id "
                    . "and (detailprix.id_typedetailprix = 1 OR detailprix.id_typedetailprix=2) "
                    . "and detailprix.id_lots = lots.id and lots.id = " . $id;

            $listessousdetail = $conn->fetchAssoc($query);
            die(json_encode($listessousdetail));
        }
    }

    public function executeSavedecompte(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $details = $params['details'];
            $id = $details['iddetail'];
            $sousdetail = $params['sousdetail'];
            $detailprix = new Detailprix(); //die($id.'hh');
            $listesdetais = Doctrine_Core::getTable('detailprix')->findOneById($id); //die('gg');
            if ($listesdetais)
                $detailprix = $listesdetais;

            $detailprix->setIdTva($details['idtva']);
            $detailprix->setTotalgeneral($details['totalhtax']);
            $detailprix->setRrr($details['rrr']);
            $detailprix->setTotalapresremise($details['totalapresrrr']);
            $detailprix->setHtva($details['totalhtva']);
            $detailprix->setTauxtva($details['tauxtva']);
            $detailprix->setMnttva($details['tvapayer']);
            $detailprix->setTotal($details['totalttc']);
            $detailprix->setDeponseantirieur($details['deponseAntirieur']);
            $detailprix->setNetapayer($details['netapyare']);
            $detailprix->setMntavance($details['mntavance']);
            $detailprix->setMntretenue($details['mntretenue']);
            $detailprix->setEtat(2);
            $detailprix->save();


            foreach ($sousdetail as $sdetail) {
                $Sdetail = new Sousdetailprix();
                $idsousdetail = $sdetail['idsousdetail'];

                $ss = Doctrine_Core::getTable('sousdetailprix')->findOneById($idsousdetail);

                if ($ss)
                    $Sdetail = $ss;
                if ($Sdetail->getIdUnite()) {
                    $qtemois = $sdetail['qtemois'];
                    $qtecumuler = $sdetail['qtecumule'];
                    $totalht = $sdetail['totalht'];
                    if ($sdetail['qtemois'] && $sdetail['qtemois'] != "")
                        $Sdetail->setQtemois($qtemois);

                    if ($sdetail['qtecumule'] && $sdetail['qtecumule'] != "")
                        $Sdetail->setQtecumule($qtecumuler);
                    if ($sdetail['totalht'] && $sdetail['totalht'] != "")
                        $Sdetail->setPrixthtva($totalht);
                    $Sdetail->save();
                }
            }
            die('bien');
        }
    }

    public function executeAffichedetailprix(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idlot'];
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT   detailprix.totalgeneral,   detailprix.rrr,  "
                    . " detailprix.totalapresremise, tva.id as idtva, tva.libelle,  "
                    . " detailprix.tauxtva,   detailprix.mnttva,   detailprix.total,detailprix.htva "
                    . "FROM    detailprix,    lots,   tva WHERE    detailprix.id_lots = lots.id AND  "
                    . " (detailprix.id_typedetailprix=1 or detailprix.id_typedetailprix=2) AND"
                    . " detailprix.id_tva = tva.id and lots.id=" . $id;
//die($query);
            $listessousdetail = $conn->fetchAssoc($query);
            die(json_encode($listessousdetail));
        }
    }

    public function executeRempliravanace(sfWebRequest $request) {
        
        $this->lots = Doctrine_Core::getTable('lots')->findOneById($request->getParameter('id'));
        $this->form = $this->configuration->getForm($this->lots);
        $this->marche = Doctrine_Core::getTable('marches')->findOneById($this->lots->getIdMarche());
        $detais = Doctrine_Core::getTable('detailprix')->findOneByIdLotsAndIdTypedetailprix($this->lots->getId(), 3);
        $this->listesDecompltes = Doctrine_Core::getTable('detailprix')->findByIdLotsAndIdTypedetailprix($this->lots->getId(), 4);
        $this->decompte1 = NULL;
        if ($detais)
            $this->decompte1 = $detais;
        //Numero decompte
        $detailss_numero = new Detailprix();
        $this->numerodecompte = $detailss_numero->getNumeroDcompte($this->lots->getId(), $this->lots->getIdFrs());

        //______________________________________________________________________Action pour valider décompte 1 == avance
        if ($request->getParameter('btn') && $request->getParameter('btn') == "valide") {
            $detail = new Detailprix();

            if ($detais)
                $detail = $detais;
            else {
                $detail->setDatecreation(date('Y-m-d'));
                $detail->setIdLots($this->lots->getId());
                $detail->setIdTypedetailprix(3);
                //________________________________________calcul ttc
                $ttcnet = $this->lots->getTtcnet();
                $avaance = $this->marche->getAvance();
                $avance = $ttcnet * ($avaance / 100);
                $detail->setNetapayer($avance);
                $detail->setNumero(1);
                $detail->setEtat(2);
                $detail->save();
            }
            $this->Redirect('lots/rempliravanace?id=' . $this->lots->getId());
        }


        //______________________________________________________________________Action pour crée décompte 2
        if ($request->getParameter('btn') && $request->getParameter('btn') == "creedecompte") {

            $detail = new Detailprix();
            $detais = Doctrine_Core::getTable('detailprix')
                            ->createQuery('a')->where('etat=0')
                            ->andWhere('id_typedetailprix=4')
                            ->andWhere('id_lots=' . $request->getParameter('id'))->execute();
            if (count($detais) > 0)
                $detail = $detais[count($detail) - 1];
            else {
                $detail->setDatecreation(date('Y-m-d'));
                $detail->setIdLots($this->lots->getId());
                $detail->setIdTypedetailprix(4);
                $detail->setNumero($detail->getNumeroDcompte($request->getParameter('id'), $this->lots->getIdFrs()));
                $detail->setEtat(0);
                $detail->setDeponseantirieur($detail->AjouterDeponse($request->getParameter('id')));
                //________________________________________calcul ttc

                $detail->save();
                $detail->CreesousdetailPrixDecompte($request->getParameter('id'));
            }
            $this->Redirect('lots/rempliravanace?id=' . $this->lots->getId());
        }
    }
    
    public function executeImprimerDecomptes(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $id = $request->getParameter('id');

        // pdf object
        $pdf = new sfTCPDF('L');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Décomptes');
        $pdf->SetSubject("Décomptes");
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

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // dejavusans or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);
//$pdf->SetFont('dejavusans', '', 12);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        $html = $this->ReadHtmlDecomptes($id);
      
        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
       
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Decomptes.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlDecomptes($id) {
        $html = StyleCssHeader::header1();
        $lot = new Lots();
        $html .= $lot->ReadHtmlDecomptes($id);

        return $html;
    }
    
    public function executeImprimerFiche(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $id = $request->getParameter('id');

        // pdf object
        $pdf = new sfTCPDF('L');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Lot Marchés');
        $pdf->SetSubject("Lot Marchés");
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

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // dejavusans or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);
//$pdf->SetFont('dejavusans', '', 12);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        $html = $this->ReadHtmlFiche($id);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Lot Marchés.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFiche($id) {
        $html = StyleCssHeader::header1();
        $lot = new Lots();
        $html .= $lot->ReadHtmlFiche($id);

        return $html;
    }

}
