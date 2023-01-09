<?php

require_once dirname(__FILE__) . '/../lib/financementGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/financementGeneratorHelper.class.php';

/**
 * financement actions.
 *
 * @package    Bmm
 * @subpackage financement
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class financementActions extends autoFinancementActions {

    public function executeChargerFinancement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idmarche = $params['idmarche'];
            if ($idmarche != "") {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT financement.id as idfinancement, ligprotitrub.id as idligpr,"
                        . "financement.mntht as mntht, financement.mntttc, "
                        . " financement.mnttva,   financement.tauxtva as tva,financement.id_tva as id_tva ,  "
                        . " financement.caracteristiqueprix as caractere,   financement.natureprix as nature,"
                        . " titrebudjet.libelle as titre, sourcesbudget.source as budget, ligprotitrub.id_titre,"
                        . " ligprotitrub.id_rubrique as id_rubrique, ligprotitrub.id_rubrique as id_sousrubrique, "
                        . " titrebudjet.id_projet, titrebudjet.id_source as id_budget, rubrique.libelle as sousrubrique "
                        . " FROM financement, ligprotitrub, sourcesbudget, titrebudjet, rubrique "
                        . " WHERE financement.id_lignebudget = ligprotitrub.id "
                        . " AND ligprotitrub.id_titre = titrebudjet.id "
                        . " AND ligprotitrub.id_rubrique = rubrique.id "
                        . " AND titrebudjet.id_source = sourcesbudget.id "
                        . " AND financement.id_marche=" . $idmarche;

                $listes = $conn->fetchAssoc($query);

                die(json_encode($listes));
            }
        }
    }

    public function executeSavefinancement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idmarche = $params['idmarche']; //die($idmarche);
            $listesfinas = $params['source'];
//die(count($listesfinas));
            if ($idmarche != "") {
                foreach ($listesfinas as $source) {
                    $id_source = $source['id_budget'];
                    $id_titre = $source['id_titre'];
                    $id_rubrique = $source['id_rubrique'];
                    $id_sousrubrique = null;
                    if ($source['id_sousrubrique'])
                        $id_sousrubrique = $source['id_sousrubrique'];
                    $mntht = $source['mntht'];
                    $id_tva = $source['id_tva'];
                    $tva = floatval(str_replace("%", "", $source['tva'])); //die($tva);
                    $mnttva = $source['mnttva'];
                    $mntttc = $source['mntttc'];
                    $nature = $source['nature'];
                    $caractere = $source['caractere'];
//Find by id ligne bubget
                    $titrebudget = Doctrine_Core::getTable('titrebudjet')->findOneByIdAndIdSource($id_titre, $id_source);
                    if (!$titrebudget)
                        die('Budget Non réservé');
                    else {
                        $finacement = new Financement();
                        if ($id_sousrubrique && $id_sousrubrique != "")
                            $lg = Doctrine_Core::getTable('ligprotitrub')->findOneByIdTitreAndIdRubrique($id_titre, $id_sousrubrique);
                        else {
                            $lg = Doctrine_Core::getTable('ligprotitrub')->findOneByIdTitreAndIdRubrique($id_titre, $id_rubrique);
                        }
                        if ($lg) {
                            $fin = Doctrine_Core::getTable('financement')->findOneByIdLignebudgetAndIdMarche($lg->getId(), $idmarche);
                            if ($fin)
                                $finacement = $fin;
                            $finacement->setIdLignebudget($lg->getId());
                            $finacement->setMntht($mntht);
                            $finacement->setIdTva($id_tva);
                            $finacement->setTauxtva($tva);
                            $finacement->setMnttva($mnttva);
                            $finacement->setMntttc($mntttc);
                            $finacement->setNatureprix($nature);
                            $finacement->setCaracteristiqueprix($caractere);
                            $finacement->setIdMarche($idmarche);
                            $finacement->save();
                        }
                    }
                    /*                     * ***************save engagement budget ********************* */
                    $documentbudget = new Documentbudget();
                    $docb = Doctrine_Core::getTable('documentbudget')->findOneByIdBudgetAndIdType($lg->getId(), 1);
//                    if ($docb)
//                        $documentbudget = $docb;
//                    else {
                    $documentbudget->setIdType(1);
                    $documentbudget->setNumero($documentbudget->NumeroSeqDocumentAchat(1));
                    $documentbudget->setDatecreation(date('Y-m-d'));
                    $documentbudget->setIdBudget($lg->getId());
                    $documentbudget->save();
//                    }
                    $ligne = new Ligprotitrub();
                    if ($idmarche)
                        $marche = MarchesTable::getInstance()->find($idmarche);
                    $id_doc_achat = $marche->getIdDocumentachat();
                    $piecej = new Piecejointbudget();
//                    $piecejoint = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocumentbudget($documentbudget->getId());
//                    if ($piecejoint && $docb)
//                        $piecej = $piecejoint;
                    $piecej->setIdDocachat($id_doc_achat);
                    $piecej->setIdType(4);
//                    $piecej->setDescription($txt_object);
//                    $piecej->setIdDocumentbudget($documentbudget->getId()); //die('gg');
                    $piecej->save();
                    $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($lg->getId());

                    if ($lignesbudgets) {
                        $ligne = $lignesbudgets;
                        $ligne->MisAjourMntRubriqueMarche($ligne->getId(), $id_doc_achat, $mntttc);
                        $ligne->save();
                        $documentbudget->setMnt($mntttc);
                        $documentbudget->setMntnet($mntttc);
//                        $mnt_engage = $ligne->getMntengage();
//                        $mnt_engage_nv = $mnt_engage + $mntttc;
                        $documentbudget->setMntengage($ligne->getMntprovisoire());
                        if ($ligne->getMntencaisse())
                            $relicat = $ligne->getMntencaisse() - $ligne->getMntprovisoire();
                        else
                            $relicat = 0 - $ligne->getMntprovisoire();
                        $documentbudget->setMntrelicat($relicat);
                        $documentbudget->save();
                    }
                    $piecej->setIdDocumentbudget($documentbudget->getId()); //die('gg');
                    $piecej->save();
                    /*                     * ********************fin engagement budget********************************** */
                }
                die("reload");

                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT financement.id as idfinancement, financement.mntht as mntht,"
                        . "financement.mntttc, "
                        . " financement.mnttva,   financement.tauxtva as tva,"
                        . "financement.id_tva as id_tva ,  "
                        . " financement.caracteristiqueprix as caractere,   "
                        . "financement.natureprix as nature,"
                        . " titrebudjet.libelle as titre, ligprotitrub.id as idligpr,"
                        . " sourcesbudget.source as budget, ligprotitrub.id_titre,"
                        . " ligprotitrub.id_rubrique as id_rubrique, ligprotitrub.id_rubrique as id_sousrubrique, "
                        . " titrebudjet.id_projet, titrebudjet.id_source as id_budget, rubrique.libelle as sousrubrique "
                        . " FROM financement, ligprotitrub, sourcesbudget, titrebudjet, rubrique "
                        . " WHERE financement.id_lignebudget = ligprotitrub.id "
                        . " AND ligprotitrub.id_titre = titrebudjet.id "
                        . " AND ligprotitrub.id_rubrique = rubrique.id "
                        . " AND titrebudjet.id_source = sourcesbudget.id "
                        . " AND financement.id_marche=" . $idmarche;
// die($query);
                $listes = $conn->fetchAssoc($query);

                die(json_encode($listes));
            } else
                die('Erreur d\'ajout la source de financement');
            die('Ajout...');
        }
    }

//___________________________________________________________________________Delete sous detail de prix
    public function executeDeletefinancement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idf'];
            $id_lig = $params['id_lig'];
            $id_marche = FinancementTable::getInstance()->find($id)->getIdMarche();
            $financement = FinancementTable::getInstance()->find($id);
            $mntttc = $financement->getMntttc();
            $id_ligne = $financement->getIdLignebudget();
            /*             * ****************delete l'engagement budgetaire**************** */
            $marche = MarchesTable::getInstance()->find($id_marche);
            $id_docachat = $marche->getIdDocumentachat();
            $piecejoint = PiecejointbudgetTable::getInstance()->getbyDocAchatAndLig($id_docachat, 4, $id_ligne);
           
            $id_docbudget = $piecejoint[0]['id_documentbudget'];
            $piecejoint_budget = Doctrine_Core::getTable('Piecejointbudget')->findOneById($piecejoint[0]['id']);
            $piecejoint_budget->delete();
            $docb = Doctrine_Core::getTable('documentbudget')->findOneById($id_docbudget);
            $ligne = LigprotitrubTable::getInstance()->find($docb->getIdBudget());
            $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($id_lig);
            if ($lignesbudgets) {
                $ligne = $lignesbudgets;
                $ligne = LigprotitrubTable::getInstance()->find($ligne->getId());
                $mntrestant = 0;
                // calcul relicat enagé et mnt engagé définitif       
                /* -------- Mis a jour montant engager ------------ */
                if ($ligne->getMntengage())
                    $mntrestant = $ligne->getMntengage();

                $mnt_enga = $mntrestant - $mntttc;
                $ligne->setMntengage($mnt_enga);
//        die($mnt_enga.'fr'.$mntrestant.'vf'.$mntttc);
                /* --------- Fin mis a jour montant engager ------------ */
                /* ---------Mis à jour relicat engager ----------------- */
                $relicat_engager = 0;
                $relicat_engager = $ligne->getMntencaisse() - $mnt_enga;
                $ligne->setRelicaengager($relicat_engager);
                /* ---------fin Reliqut mnt engager------------------------- */
                /* --------- mis a jour mont provisoire et relicat provisoire- */
                $mnt_provisoire_def = floatval($ligne->getMntprovisoire() - $mntttc);
//                $ligne->setMntprovisoire($mnt_provisoire_def);
                $ligne->save();
//                $ligne->MisAjourMntRubriqueMarcheFinan($ligne->getId(), $mntttc);
//                $mnttc_elimine = $mntttc;
//                $mnt_engege = $docb->getMnt();
//                $mnt_restant = $mnt_engege - $mnttc_elimine;
//                $docb->setMnt($mnt_restant);
////                die($mnt_engege . 'mfr' . $mnttc_elimine . $id_docbudget);
//                $docb->setMntnet($mnt_restant);
//                $docb->setMntengage($mnt_restant);
//                $relicat = $ligne->getMntencaisse() - $mnt_restant;
//                $docb->setMntrelicat($relicat);
//                $docb->save();
//                die($mnt_engege . 'vf' . $mnt_restant . 'ffd' . $mnttc_elimine . 'fr' . $docb->getMnt());
            }
//die($id_docbudget.'df');
            $docb = Doctrine_Query::create()
                    ->delete('documentbudget')
                    ->where('id=' . $id_docbudget);
            $piecejoint = Doctrine_Query::create()
                    ->delete('Piecejointbudget')
                    ->where('ididocumentbudget=' . $id_docbudget);
            $query = Doctrine_Query::create()
                    ->delete('financement')
                    ->where('id=' . $id);
// die($query);
            $query = $query->execute();

            /*             * ***************fin delete engagement budget***************** */
            die("bien");
        }
    }

    public function executeImprimerEngagement(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $id_marche = $request->getParameter('id_marche');

        $pdf = new sfTCPDF();
// remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Engagement Budget Définitif');
        $pdf->SetSubject("Engagement Budget Définitif");
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

//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(0, 0, 0);

// set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(5, 10, 5);
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

        $html = $this->ReadHtmlOrdonnance($id, $id_marche);
        ob_end_clean();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Engagement Budget Définitif' . '.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlOrdonnance($id, $id_marche) {
        $html = StyleCssHeader::header1();
        $document_budget = new Documentbudget();
        $html .= $document_budget->ReadHtmlEngagementdefinitifMarche($id, $id_marche);

        return $html;
    }

}
