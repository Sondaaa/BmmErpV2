<?php

require_once dirname(__FILE__) . '/../lib/mouvementbanciareGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/mouvementbanciareGeneratorHelper.class.php';

/**
 * mouvementbanciare actions.
 *
 * @package    Bmm
 * @subpackage mouvementbanciare
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mouvementbanciareActions extends autoMouvementbanciareActions {

    public function executeNew(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->mouvementbanciare = $this->form->getObject();
        $this->id = $request->getParameter('id');
    }

    //______________________________________Affichier les tranche non deponser
    public function executeAfficheTranche(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $tranches = TitrebudjetTable::getInstance()->getTranchesNonDeponser($id);

            return $this->renderText(json_encode(
                array('tranches' => $tranches)
            ));
        }
        return $this->renderText(json_encode(
            array('tranches' => [])
        ));
    }

    //_________________________________________________Ajouter nouveau fiche par type: BCI
    public function executeSavemouvement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $soldefinal = 0;
        $i = 0;
        $banqueid = -1;
        $ids = '';
        if (!empty($content)) {

            $params1 = json_decode($content, true);
            $id_doc = $params1['id_doc'];

            $operations = $params1['operations'];
            foreach ($operations as $params) {
                $idbanque = $params['id_banque'];
                $banqueid = $idbanque;
                $numero = $params['nb'];
                $reford = $params['reford'];
                $numero_doc = $params['numero_doc'];
                $id_object = $params['id_object'];
                $refbenifi = $params['refbenifi'];
                $id_instrument = $params['id_instrument'];
                $id_tranchebudget = $params['tranchebudget_id'];
                $id_cheque = $params['id_cheque'];
                $debit = $params['debit'];
                $credit = $params['credit'];
                $solde = $params['solde'];
                $tvaretenue = $params['tvaretenue'];
                $retenue = $params['retenue'];
                $ribbeni = $params['ribbeni'];
                $dateoperation = $params['dateoperation'];
                $id_type = $params['id_type'];
                $nomoperation = $params['nomoperation'];
                $idcomm = $params['idcomm'];
                $valeurcomm = $params['valeurcomm'];
                $soldecomm = $params['soldecomm'];
                $refinstrument = $params['refinstrument'];
                $id_documentbudget = $params['id_documentbudget'];
                $id_declaration = $params['id_declaration'];
                if ($i == count($operations) - 1) {
                    $soldefinal = $soldecomm;
                }

                $i++;

                if ($id_documentbudget) {
                    $piecejoint = PiecejointbudgetTable::getInstance()->findOneByIdDocumentbudget($id_documentbudget);
                }

                if ($id_doc) {
                    $piecejoint = PiecejointbudgetTable::getInstance()->findOneByIdDocumentbudget($id_doc);
                    $id_doc_achat = $piecejoint->getIdDocachat();
                    if ($id_doc_achat) {
                        $doc_achat = Doctrine_Core::getTable('documentachat')->findOneById($id_doc_achat);
                        $doc_achat->setIdEtatdoc(31);
                        $doc_achat->save();
                    }
                }
                //                die($doc_achat->getId().'mp');
                $mouvement = new Mouvementbanciare();
                $mouvement->setNumero($numero);
                $mouvement->setNomoperation($nomoperation);
                if ($reford) {
                    $mouvement->setReford($reford);
                }

                if ($numero_doc) {
                    $mouvement->setReford($numero_doc);
                }

                if ($id_documentbudget) {
                    $mouvement->setIdDocumentbudget($id_documentbudget);
                }

                if ($id_doc) {
                    $mouvement->setIdDocumentbudget($id_doc);
                }

                if ($id_declaration) {
                    $mouvement->setIdDeclaration($id_declaration);
                }

                if ($idbanque) {
                    $mouvement->setIdBanque($idbanque);
                }

                if ($id_type) {
                    $mouvement->setIdType($id_type);
                }

                if ($id_object) {
                    $mouvement->setIdObject($id_object);
                }

                if ($id_instrument) {
                    $mouvement->setIdInstrument($id_instrument);
                }

                if ($id_tranchebudget) {
                    $mouvement->setIdBudget($id_tranchebudget);
                }

                if ($refinstrument) {
                    $mouvement->setReferenceautre($refinstrument);
                }

                if ($credit != "") {
                    $mouvement->setCredit($credit);
                }

                if ($debit != "") {
                    $mouvement->setDebit($debit);
                }
                if ($id_cheque) {
                    $mouvement->setIdCheque($id_cheque);
                    $cheque = new Papiercheque();
                    $cheque = Doctrine_Core::getTable('papiercheque')->findOneById($id_cheque);
                    //pour l'utiliser en cas : objet de règlement = transfert; dans le mouvement du compte cible
                    $numero_cheque = $cheque->getRefpapier();
                    $cheque->setDatesignature($dateoperation);
                    $cheque->setMntcheque($soldecomm);
                    $cheque->setCible($refbenifi);
                    $cheque->setEtat(1);
                    $cheque->save();
                }
                if ($refbenifi) {
                    $mouvement->setRefbenifi($refbenifi);
                }

                if ($ribbeni) {
                    $mouvement->setRibbeni($ribbeni);
                }

                if ($dateoperation) {
                    $mouvement->setDateoperation($dateoperation);
                }

                if ($solde) {
                    $mouvement->setSolde($solde);
                }

                if ($id_doc) {
                    if ($id_doc_achat) {
                        $mouvement->setIdDocumentachat($id_doc_achat);
                    }
                }
                if ($valeurcomm != '') {
                    $mouvement->setMntenoper($valeurcomm);
                }

                $id_document_budget_declaration = '';
                if ($id_object == 3) {
                    if ($id_declaration) {
                        $declaration = DeclarationTable::getInstance()->find($id_declaration);
                        $document_budget_declaration = DocumentbudgetTable::getInstance()->findByIdDeclaration($id_declaration)->getFirst();
                        if ($document_budget_declaration != null) {
                            $id_document_budget_declaration = $document_budget_declaration->getId();
                        }

                        $declaration->setEtat(true);
                        $declaration->save();
                    }
                }
                if ($id_document_budget_declaration != '' && !$id_documentbudget) {
                    $mouvement->setIdDocumentbudget($id_document_budget_declaration);
                }

                $mouvement->save();

                //Ajout du mouvement lié au compte cible du transfert du compte au compte ou caisse.

                if ($id_object == 4) {
                    $id_banque_cible = $params['id_banque_cible'];
                    $mouvement_cible = new Mouvementbanciare();
                    //trouver le numéro suivant pour le mouvement du compte
                    $mvt = MouvementbanciareTable::getInstance()->getLastOpeartionInCompte($id_banque_cible);
                    if ($mvt != null) {
                        $numero_cible = intval(intval($mvt->getNumero()) + 1);
                    } else {
                        $numero_cible = 1;
                    }

                    $mouvement_cible->setNumero($numero_cible);
                    $mouvement_cible->setNomoperation($nomoperation);
                    $mouvement_cible->setReford($reford);
                    if ($id_documentbudget) {
                        $mouvement_cible->setIdDocumentbudget($id_documentbudget);
                    }

                    $mouvement_cible->setIdBanque($id_banque_cible);
                    $mouvement_cible->setIdType($id_type);
                    $mouvement_cible->setIdObject($id_object);
                    $mouvement_cible->setIdInstrument($id_instrument);
                    if ($id_cheque) {
                        $mouvement_cible->setReferenceautre($numero_cheque);
                    }
                    //Calculer le nouveau solde du compte cible
                    $banque_cible = CaissesbanquesTable::getInstance()->find($id_banque_cible);
                    $solde_cible = $banque_cible->getMntdefini();
                    //inverser le crédit et le débit par rapport au compte précédent
                    if ($credit != "") {
                        $mouvement_cible->setDebit($credit);
                        $solde_cible = $solde_cible - $credit;
                    }
                    if ($debit != "") {
                        $mouvement_cible->setCredit($debit);
                        $solde_cible = $solde_cible + $debit;
                    }
                    if ($id_cheque) {
                        //                        $mouvement_cible->setIdCheque($id_cheque);
                        //Le traitement du chèque déjà été effectué dans le compte précédent
                    }
                    //Set les paramètres du bénéficiaire (1èr compte est le bénéficiaire du 2ème compte et vice versa)
                    $banque = CaissesbanquesTable::getInstance()->find($banqueid);
                    $mouvement_cible->setRefbenifi($banque->getLibelle());
                    $mouvement_cible->setRibbeni($banque->getRib());
                    $mouvement_cible->setDateoperation($dateoperation);

                    $mouvement_cible->setSolde($solde_cible);
                    //Pas de commission dans le mouvement du compte cible
                    //                    if ($valeurcomm != '')
                    //                        $mouvement_cible->setMntenoper($valeurcomm);
                    //Set id mouvement précédent.
                    $mouvement_cible->setIdMouvement($mouvement->getId());
                    $mouvement_cible->save();

                    $banque_cible->setMntdefini($solde_cible);
                    $banque_cible->save();
                }

                $ids = $ids . $mouvement->getId() . '-';
                if ($id_object != 6) {
                    $dossier = DossiercomptableTable::getInstance()->findAll()->getFirst();
                    $reglemet = new Reglementcomptable();
                    if ($dateoperation) {
                        $reglemet->setDate($dateoperation);
                    }

                    if ($dateoperation) {
                        $reglemet->setDateimportation($dateoperation);
                    }

                    if ($dateoperation) {
                        $reglemet->setDatevaleur($dateoperation);
                    }

                    if ($idbanque) {
                        $reglemet->setIdBanque($idbanque);
                    }

                    $reglemet->setSaisie(0);
                    if ($mouvement->getDebit() != '' && $mouvement->getDebit() != null) {
                        $reglemet->setTotalttc($mouvement->getDebit());
                        $reglemet->setType('Debit');
                    }
                    if ($mouvement->getCredit() != '' && $mouvement->getCredit() != null) {
                        $reglemet->setTotalttc($mouvement->getCredit());
                        $reglemet->setType('Credit');
                    }
                    $reglemet->setIdMouvement($mouvement->getId());
                    $reglemet->setIdDossier($dossier->getId());
                    $year = date('Y', strtotime($mouvement->getDateoperation()));
                    $exercie = ExerciceTable::getInstance()->findByLibelle($year);
                    $reglemet->setNumero($numero);
                    if (sizeof($mouvement->getDocumentbudget()->getPiecejointbudget()) >= 1) {
                        if ($mouvement->getDocumentbudget()->getPiecejointbudget()->getFirst()->getDocumentachat()->getFournisseur()->getId() != null) {
                            //             $reglemet$reglemet->setIdFrs($mouvement->getPiecejointbudget()->getDocumentachat()->getFourniseur()->getId());
                            $frs = $mouvement->getDocumentbudget()->getPiecejointbudget()->getFirst()->getDocumentachat()->getFournisseur();
                            $id_plan = $frs->getIdPlancomptable();
                            if ($id_plan != null) {
                                $plandossier = PlandossiercomptableTable::getInstance()->findByIdPlan($id_plan)->getFirst();
                                $reglemet->setIdFrs($frs->getId());
                                $reglemet->setIdComptecomptable($plandossier->getId());
                            }
                        }
                    }
                    $reglemet->save();
                    $mnt_frs = floatval($tvaretenue + $retenue);
                    if ($mnt_frs != 0.000) {
                        $facture_od = new Facturecomptableod();
                        if ($dateoperation) {
                            $facture_od->setDate($dateoperation);
                        }

                        if ($dateoperation) {
                            $facture_od->setDateimportation($dateoperation);
                        }

                        $facture_od->setSaisie(0);

                        //                if ($mouvement->getDebit() != '' && $mouvement->getDebit() != null) {
                        $mnt_frs = floatval($tvaretenue + $retenue);
                        $facture_od->setTotalttc($mnt_frs);
                        //                }
                        //                if ($mouvement->getCredit() != '' && $mouvement->getCredit() != null) {
                        //                    $facture_od->setTotalttc($mnt_frs);
                        //                }
                        //tva
                        if ($tvaretenue) {
                            $facture_od->setTotaltva($tvaretenue);
                        }

                        //retenue
                        if ($retenue) {
                            $facture_od->setTotalht($retenue);
                        }

                        /*                         * document achat not null* */
                        if ($mouvement->getIdDocumentachat() != null && $mouvement->getIdDocumentachat() != '') {
                            $doc_achat = DocumentachatTable::getInstance()->findOneById($mouvement->getIdDocumentachat());
                            $doc_parent = DocumentachatTable::getInstance()->findOneById($doc_achat->getIdDocparent());
                            if (!$doc_parent && $doc_parent->getIdTypedoc() != 6) {
                                $document_fac = DocumentachatTable::getInstance()->findOneByIdDocparent($mouvement->getIdDocumentachat());
                                $facture_od->setIdFacture($document_fac->getId());
                            } else {
                                $document_fac = DocumentachatTable::getInstance()->findOneById($mouvement->getIdDocumentachat());
                                $facture_od->setIdFacture($document_fac->getId());
                            }
                            $facture_od->setIdFournisseur($document_fac->getIdFrs());
                        }
                        if ($mouvement->getDocumentbudget() != null && $mouvement->getDocumentbudget() != '') {
                            if (sizeof($mouvement->getDocumentbudget()->getPiecejointbudget()) >= 1) {
                                if ($mouvement->getDocumentbudget()->getPiecejointbudget()->getFirst()->getDocumentachat()->getFournisseur()->getId() != null) {
                                    //             $reglemet$reglemet->setIdFrs($mouvement->getPiecejointbudget()->getDocumentachat()->getFourniseur()->getId());
                                    $frs = $mouvement->getDocumentbudget()->getPiecejointbudget()->getFirst()->getDocumentachat()->getFournisseur();
                                    $facture_od->setIdFournisseur($frs->getId());
                                    $document_achat = DocumentachatTable::getInstance()->findOneByIdDocparent($mouvement->getDocumentbudget()->getPiecejointbudget()->getFirst()->getIdDocachat());
                                    //                        die(sizeof($document_achat).'ecf'.$mouvement->getDocumentbudget()->getPiecejointbudget()->getFirst()->getIdDocachat());
                                    $facture_od->setIdFacture($mouvement->getDocumentbudget()->getPiecejointbudget()->getFirst()->getIdDocachat());
                                }
                            }
                            $document_b = DocumentbudgetTable::getInstance()->findOneById($mouvement->getIdDocumentbudget());
                            $certficat = CertificatretenueTable::getInstance()->getByBudget($document_b->getIdDocumentbudget());
                            //die($mouvement->getIdDocumentbudget() );
                            if (sizeof($certficat) >= 1) {
                                $facture_od->setIdCertfificat($certficat->getFirst()->getId());
                            }
                        }

                        $facture_od->setIdDossier($dossier->getId());
                        $year = date('Y', strtotime($mouvement->getDateoperation()));

                        $exercie = ExerciceTable::getInstance()->findByLibelle($year);

                        $facture_od->setNumero($numero);
                        if ($reford) {
                            $facture_od->setReference($reford);
                        }

                        $facture_od->save();
                    }
                }
            }

            // $banque = new Caissesbanques();
            // $banque = Doctrine_Core::getTable('caissesbanques')->findOneById($banqueid);
            // $banque->setMntdefini($soldefinal);
            // $banque->save();
            if ($id_object == 6) {
                $banque_cible = CaissesbanquesTable::getInstance()->find($idbanque);
                $solde_cible = $banque_cible->getMntdefini();
                if ($credit != "") {
                    $solde_cible = $solde_cible + $credit;
                }

                $banque_cible->setMntdefini($solde_cible);
                $banque_cible->save();
                $titrebudget = TitrebudjetTable::getInstance()->find($id_tranchebudget);
//                $mnt_ancien_debloque = $titrebudget->getMntdebloque();
//                if ($credit != "") {
//                    $nv_solde = $mnt_ancien_debloque + $credit;
//                }
//                $tranche_budget->setMntdebloque($nv_solde);
//                $tranche_budget->save();
                
                
                $alimentation_compte = AlimentationcompteTable::getInstance()->findOneByIdTitrebudget($id_tranchebudget);
                if (!$alimentation_compte) {
                    $alimentation_compte = new Alimentationcompte();
                    $alimentation_compte->setIdTitrebudget($titrebudget->getId());
                    $alimentation_compte->setIdCompte($idbanque);
                    $alimentation_compte->setDate($dateoperation);
                    $alimentation_compte->setLibellesource($nomoperation);
                    $alimentation_compte->setMontant($credit);
                    $alimentation_compte->save();
                } else {
                    $ancien_montant = $alimentation_compte->getMontant();
                    $alimentation_compte->setMontant($credit + $ancien_montant);
                    $alimentation_compte->save();
                }
            }

            die("" . $ids);
        }
    }

    public function executeShow(sfWebRequest $request) {
        $ids = $request->getParameter('ids');
        $this->ids = $ids;
        $ids = substr($ids, 0, -1);
        $ids = explode('-', $ids);

        $this->mouvements = MouvementbanciareTable::getInstance()->getByListeId($ids);
    }

    public function executeIndex(sfWebRequest $request) {
        $this->banques = CaissesbanquesTable::getInstance()->getAllBanque();
    }

    //imprimer mouvements banque
    public function executeImprimerMouvementBanque(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $ids = $request->getParameter('ids');
        $ids = substr($ids, 0, -1);
        $ids = explode('-', $ids);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Mouvements Bancaires');
        $pdf->SetSubject("Mouvements Bancaires");
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

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlMouvementBanque($ids);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Mouvements Bancaires.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlMouvementBanque($ids) {
        $html = StyleCssHeader::header1();
        $mvb = new Mouvementbanciare();
        $html .= $mvb->ReadHtmlMouvementsBanque($ids);
        return $html;
    }

    public function executeGoPage(sfWebRequest $request) {
        $pager = $this->getAllMouvements($request);
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');
        return $this->renderPartial("list", array("pager" => $pager, "date_debut" => $date_debut, "date_fin" => $date_fin, "id_banque" => $id_banque));
    }

    public function getAllMouvements(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');
        $type = $request->getParameter('type', 'tout');

        $pager = new sfDoctrinePager('Mouvementbanciare', 10);
        $pager->setQuery(MouvementbanciareTable::getInstance()->getAllMouvement($date_debut, $date_fin, $id_banque, $type));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeImprimerSearchMouvementBanque(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Mouvements Bancaires/CCP');
        $pdf->SetSubject("Mouvements Bancaires/CCP");
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

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlSearchMouvementBanque($date_debut, $date_fin, $id_banque);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Mouvements Bancaires-CCP.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlSearchMouvementBanque($date_debut, $date_fin, $id_banque) {
        $html = StyleCssHeader::header1();
        $mvb = new Mouvementbanciare();
        $html .= $mvb->ReadHtmlSearchMouvementsBanque($date_debut, $date_fin, $id_banque);
        return $html;
    }

    public function executeBordereau(sfWebRequest $request) {
        $this->banques = CaissesbanquesTable::getInstance()->getAllBanque();
        $this->natures_compte = NaturebanqueTable::getInstance()->findAll();
    }

    public function executeGetBordereau(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');
        $id_type = $request->getParameter('id_type', '');
        $id_nature = $request->getParameter('id_nature', '');

        $mouvements = MouvementbanciareTable::getInstance()->findAllMouvementForBordereau($date_debut, $date_fin, $id_banque, $id_type, $id_nature);
        return $this->renderPartial("list_bordereau", array("mouvements" => $mouvements));
    }

    public function executeGetFinalBordereau(sfWebRequest $request) {
        $ids = $request->getParameter('ids');
        $this->ids = $ids;
        $ids = substr($ids, 0, -1);
        $ids = explode(',', $ids);
        $this->mouvements = MouvementbanciareTable::getInstance()->getByListeId($ids);
    }

    public function executeImprimerBordereau(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $ids = $request->getParameter('ids');
        $ids = substr($ids, 0, -1);
        $ids = explode(',', $ids);

        $pdf = new sfTCPDF('L');

        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Bordereau');
        $pdf->SetSubject("Bordereau");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getRs();
        $pdf->SetAuthor($entete);
        //        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');
        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlBordereau($ids);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Bordereau.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBordereau($ids) {
        $html = StyleCssHeader::header1();
        $mvb = new Mouvementbanciare();
        $html .= $mvb->ReadHtmlBordereau($ids);
        return $html;
    }

    public function executeJournal(sfWebRequest $request) {
        $this->banques = CaissesbanquesTable::getInstance()->getAllBanque();
        $this->fournisseurs = FournisseurTable::getInstance()->getAllOrderByRaisonSociale();
    }

    public function executeGoPageJournal(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');
        $type = $request->getParameter('type', 'tout');
        $mouvements = MouvementbanciareTable::getInstance()->findAllMouvement($date_debut, $date_fin, $id_banque);
        return $this->renderPartial("list_journal", array("mouvements" => $mouvements, "date_debut" => $date_debut, "date_fin" => $date_fin, "id_banque" => $id_banque, "type" => $type));
    }

    public function executeImprimerJournalMouvementBanque(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');
        $type = $request->getParameter('type', 'tout');

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
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlJournalMouvementBanque($date_debut, $date_fin, $id_banque, $type);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Journal Mouvements Bancaires-CCP.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlJournalMouvementBanque($date_debut, $date_fin, $id_banque, $type) {
        $html = StyleCssHeader::header1();
        $mvb = new Mouvementbanciare();
        $html .= $mvb->ReadHtmlJournalMouvementsBanque($date_debut, $date_fin, $id_banque, $type);
        return $html;
    }

    public function executeListeOrdonnance(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idbanque'];
            $q = Doctrine_Query::create()
                    ->select("db.id as id, db.numero as libelle")
                    ->from('Documentbudget db')
                    ->leftJoin('db.Ligprotitrub l')
                    ->leftJoin('l.Lignebanquecaisse lbc')
                    ->where('lbc.id_caissebanque=' . $id)
                    ->andWhere('db.id_type=2')
                    ->andWhere('db.id NOT IN (SELECT DISTINCT(mb.id_documentbudget) '
                            . 'FROM mouvementbanciare mb where mb.id_documentbudget IS NOT NULL)')
                    ->orderBy('db.numero')
                    ->fetchArray();
            //            die($q);
            die(json_encode($q));
        }
        die('Erreur');
    }

    public function executeListeDeclaration(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idbanque'];
            $q = Doctrine_Query::create()
                    ->select("d.id as id, d.libelle as libelle")
                    ->from('Declaration d')
                    ->where('d.id_caissebanque=' . $id)
                    ->andWhere('d.etat=false')
                    ->orderBy('d.libelle')
                    ->fetchArray();
            die(json_encode($q));
        }
        die('Erreur');
    }

    public function executeDetailsDeclaration(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];

            $q = Doctrine_Query::create()
                    ->from('Declaration d')
                    ->select("d.id as id, d.libelle as libelle, d.montant as montant")
                    ->where('d.id=' . $id)
                    ->fetchArray();
            die(json_encode($q));
        }
        die('Erreur');
    }

    public function executeDetailsOrdonnance(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];

            $q = Doctrine_Query::create()
                    ->from('Documentbudget db')
                    ->leftJoin('db.Piecejointbudget pjb')
                    ->leftJoin('pjb.Documentachat da')
                    ->leftJoin('da.Fournisseur f')
                    ->select("db.id as id,db.numero as numero, db.mntnet as mnt, pjb.id as pjb_id, da.id as da_id, f.id as fournisseur_id, f.rs as fournisseur_rs, f.rib as fournisseur_rib")
                    ->where('db.id=' . $id)
                    ->fetchArray();
            die(json_encode($q));
        }
        die('Erreur');
    }

    public function executeDetailsOrdonnanceCertifie(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $id_certif = $params['id_certif'];
            $ordonnance = DocumentbudgetTable::getInstance()->find($id);

            $id_doc = $ordonnance->getIdDocumentbudget();
            $q = Doctrine_Query::create()
                    ->from('Certificatretenue certif')
                    ->leftJoin('certif.Documentbudget db ')
                    ->leftJoin('db.Piecejointbudget pjb')
                    ->leftJoin('pjb.Documentachat da')
                    ->leftJoin('da.Fournisseur f')
                    ->select("db.id as id,db.numero as numero, db.mntnet as mnt,"
                            . " pjb.id as pjb_id, da.id as da_id, f.id as fournisseur_id,"
                            . " f.rs as fournisseur_rs, f.rib as fournisseur_rib,"
                            . "certif.montantretenue as mnt_retenue ,certif.tvaretenue as  mnt_retenuetva")
                    ->where('db.id=' . $id_doc)
                    //                    ->andWhere('certif.id_documentbudget=db.id')
                    ->fetchArray();
            die(json_encode($q));
        }
        die('Erreur');
    }

    public function executeTestExistantccertificat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $ordonnance = DocumentbudgetTable::getInstance()->find($id);

            $id_doc = $ordonnance->getIdDocumentbudget();
            //            die($id_doc.'mmm');
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT certificatretenue.id as id, documentbudget.id as idbudget "
                    . " FROM certificatretenue ,documentbudget "
                    . " WHERE certificatretenue.id_documentbudget =" . $id_doc
                    . " and certificatretenue.id_documentbudget =documentbudget.id";
            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }
        die('Erreur');
    }

    public function executeSupprimerMouvement(sfWebRequest $request) {
        $id = $request->getParameter('id', '');
        $id_existe = $request->getParameter('id_existe', 0);

        $mvt = MouvementbanciareTable::getInstance()->find($id);
        $reglementcomptable = ReglementcomptableTable::getInstance()->findOneByIdMouvement($mvt->getId());
        //        if (sizeof($reglementcomptable) >= 1)
        //            $reglementcomptable->delete();
        if (sizeof($mvt) >= 1) {
            Doctrine_Query::create()->delete('Reglementcomptable')
                    ->where('id_mouvement=' . $mvt->getId())->execute();
        }

        if ($mvt->getIdObject() == 4) {
            //Traitement sur solde compte & suppression en cas : objet de règlement = transfert
            //mouvement parent
            $mvt_parent = MouvementbanciareTable::getInstance()->find($mvt->getIdMouvement());
            if ($mvt_parent != null) {
                //Mise à jour du solde du compte du mouvement parent
                $banque_parent = CaissesbanquesTable::getInstance()->find($mvt_parent->getIdBanque());
                $soldefinal = 0;
                if ($mvt_parent->getCredit() != null) {
                    $soldefinal = $banque_parent->getMntdefini() - $mvt_parent->getCredit();
                } else {
                    $soldefinal = $banque_parent->getMntdefini() + $mvt_parent->getDebit();
                }

                if ($mvt_parent->getMntenoper() != null) {
                    $soldefinal = $soldefinal + $mvt_parent->getMntenoper();
                }

                $banque_parent->setMntdefini($soldefinal);
                $banque_parent->save();

                //Traitement sur le chèque associé au mouvement parent
                if ($mvt_parent->getIdCheque() != null) {
                    $cheque_parent = PapierchequeTable::getInstance()->find($mvt_parent->getIdCheque());
                    if ($request->getParameter('choix_annulation') == 1) {
                        $cheque_parent->setAnnule(true);
                    } else {
                        $cheque_parent->setDatesignature(null);
                        $cheque_parent->setMntcheque(null);
                        $cheque_parent->setCible(null);
                        $cheque_parent->setEtat(0);
                    }
                    $cheque_parent->save();
                }

                $mvt_parent->delete();
            }
            //$mouvement fils
            $mvt_fils = MouvementbanciareTable::getInstance()->findOneByIdMouvement($mvt->getId());
            if ($mvt_fils != null) {
                //Mise à jour du solde du compte du mouvement fils
                $banque_fils = CaissesbanquesTable::getInstance()->find($mvt_fils->getIdBanque());
                $soldefinal = 0;
                if ($mvt_parent->getCredit() != null) {
                    $soldefinal = $banque_fils->getMntdefini() - $mvt_fils->getCredit();
                } else {
                    $soldefinal = $banque_fils->getMntdefini() + $mvt_fils->getDebit();
                }

                if ($mvt_parent->getMntenoper() != null) {
                    $soldefinal = $soldefinal + $mvt_fils->getMntenoper();
                }

                $banque_fils->setMntdefini($soldefinal);
                $banque_fils->save();

                //Pas de traitement du chèque pour le mouvement fils

                $mvt_fils->delete();
            }
        }

        //Mise à jour du solde du compte
        $banque = CaissesbanquesTable::getInstance()->find($mvt->getIdBanque());
        $soldefinal = 0;
        if ($mvt->getCredit() != null) {
            $soldefinal = $banque->getMntdefini() - $mvt->getCredit();
        } else {
            $soldefinal = $banque->getMntdefini() + $mvt->getDebit();
        }

        if ($mvt->getMntenoper() != null) {
            $soldefinal = $soldefinal + $mvt->getMntenoper();
        }

        $banque->setMntdefini($soldefinal);
        $banque->save();

        //Mise à jour déclaration
        if ($mvt->getIdDeclaration() != null) {
            $declaration = DeclarationTable::getInstance()->find($id_declaration);
            $declaration->setEtat(false);
            $declaration->save();
        }

        $mvt->delete();

        //Traitement sur le chèque associé au mouvement
        if ($id_existe > 0) {
            $cheque = PapierchequeTable::getInstance()->find($id_existe);
            if ($request->getParameter('choix_annulation') == 1) {
                $cheque->setAnnule(true);
            } else {
                $cheque->setDatesignature(null);
                $cheque->setMntcheque(null);
                $cheque->setCible(null);
                $cheque->setEtat(0);
            }
            $cheque->save();
        }

        //Ré-numérotation des mouvements suivants pour garder la succession des numéros
        $mvts = MouvementbanciareTable::getInstance()->setNumerotation($id);
        foreach ($mvts as $mvt) {
            $nouveau_numero = $mvt->getNumero() - 1;
            $mvt->setNumero($nouveau_numero);
            $mvt->save();
        }

        $pager = $this->getAllMouvements($request);
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');
        return $this->renderPartial("list", array("pager" => $pager, "date_debut" => $date_debut, "date_fin" => $date_fin, "id_banque" => $id_banque));
    }

    public function executeRapprochement(sfWebRequest $request) {
        $this->banques = CaissesbanquesTable::getInstance()->getAllBanque();
    }

    public function getAllMouvementsForRapprochement(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');
        $rapproche = $request->getParameter('rapproche', 'false');

        $pager = new sfDoctrinePager('Mouvementbanciare', 10);
        $pager->setQuery(MouvementbanciareTable::getInstance()->getAllMouvementRapprochement($date_debut, $date_fin, $id_banque, $rapproche));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeGoPageRapprochement(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');
        $mouvements = MouvementbanciareTable::getInstance()->findAllMouvementRapprochement($date_debut, $date_fin, $id_banque);
        return $this->renderPartial("list_rapprochement", array("mouvements" => $mouvements, "date_debut" => $date_debut, "date_fin" => $date_fin, "id_banque" => $id_banque));
    }

    public function executeAddLigne(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->id = $id;
    }

    public function executeValiderOperation(sfWebRequest $request) {
        $date = $request->getParameter('date');
        $nom = $request->getParameter('nom');

        $id = $request->getParameter('id');
        $debit = $request->getParameter('debit');
        $user = $this->getUser()->getAttribute('userB2m');
        $mvt_cible = MouvementbanciareTable::getInstance()->find($id);

        $mouvement = new Mouvementbanciare();
        $mouvement->setDateoperation($date);
        $mouvement->setNomoperation($nom);
        $mouvement->setIdBanque($mvt_cible->getIdBanque());
        if ($mvt_cible->getIdDocumentachat()) {
            $mouvement->setIdDocumentachat($mvt_cible->getIdDocumentachat());
        }

        if ($mvt_cible->getIdDocumentbudget()) {
            $mouvement->setIdDocumentbudget($mvt_cible->getIdDocumentbudget());
        }

        $solde_cible = $mvt_cible->getSolde();
        $mouvement->setDebit($debit);
        $solde_cible = $solde_cible + $debit;
        $mouvement->setSolde($solde_cible);
        $mouvement->save();
        die($mouvement->getId() . '');
    }

    public function executeValiderRapprochement(sfWebRequest $request) {
        $mvt = MouvementbanciareTable::getInstance()->find($request->getParameter('id'));
        if ($request->getParameter('type') == '1') {
            if (!$mvt->getRapproche()) {
                $mvt->setRapproche(true);
            } else {
                $mvt->setRapproche(false);
            }
        } else {
            if (!$mvt->getRapprochecommission()) {
                $mvt->setRapprochecommission(true);
            } else {
                $mvt->setRapprochecommission(false);
            }
        }
        $mvt->save();

        return $this->renderText('OK');
    }

    public function executeAnnulerMouvement(sfWebRequest $request) {
        $id = $request->getParameter('id', '');

        $mvt = MouvementbanciareTable::getInstance()->find($id);

        //Mise à jour du solde du compte
        $banque = CaissesbanquesTable::getInstance()->find($mvt->getIdBanque());
        $soldefinal = 0;
        if ($mvt->getCredit() != null) {
            $soldefinal = $banque->getMntdefini() - $mvt->getCredit();
        } else {
            $soldefinal = $banque->getMntdefini() - $mvt->getDebit();
        }

        if ($mvt->getMntenoper() != null) {
            $soldefinal = $soldefinal - $mvt->getMntenoper();
        }

        $banque->setMntdefini($soldefinal);
        $banque->save();

        $mvt->setAnnule(true);
        $mvt->save();

        return $this->renderText('OK');
    }

    public function executeEtatordonnance(sfWebRequest $request) {
        $this->id = $request->getParameter('id');
    }

    public function executeImprimerordonnance(sfWebRequest $request) {
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Ordonnance de Paiement');
        $pdf->SetSubject("Ordonnance de Paiement");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getRs();
        $pdf->SetAuthor($entete);
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
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once dirname(__FILE__) . '/lang/eng.php';
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlOrdonnance($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Ordonnance de Paiement.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlOrdonnance($id) {
        $html = StyleCssHeader::header1();
        $document_budget = new Documentbudget();
        $html .= $document_budget->ReadHtmlOrdonnance($id);
        return $html;
    }

}
