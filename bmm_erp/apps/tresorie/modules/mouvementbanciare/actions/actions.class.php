
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
        $this->type = $request->getParameter('type');
    }

    public function executeNewOrdonnaceHorsBci(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->mouvementbanciare = $this->form->getObject();
        $this->id = $request->getParameter('id');
    }

    public function executeNewHorsBci(sfWebRequest $request) {
//        $this->form = $this->configuration->getForm();
//        $this->mouvementbanciare = $this->form->getObject();
        $this->id = $request->getParameter('id');
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
                    ->leftJoin('db.Piecejointbudget Piece')
                    ->where('lbc.id_caissebanque=' . $id)
                    ->andWhere('db.id_type=1')
                    ->andWhere('db.id NOT IN (SELECT DISTINCT(mb.id_documentbudget) '
                            . 'FROM mouvementbanciare mb where mb.id_documentbudget IS NOT NULL)')
                    ->andWhere('Piece.id_docachat is null')
                    ->orderBy('db.numero')
                    ->fetchArray();
//            die($q);
            die(json_encode($q));
        }
        die('Erreur');
    }

    public function executeListeOrdonnanceHorBci(sfWebRequest $request) {
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
                    ->leftJoin('db.Piecejointbudget Piece')
                    ->where('lbc.id_caissebanque=' . $id)
                    ->andWhere('db.id_type=2')
                    ->andWhere('db.id NOT IN (SELECT DISTINCT(mb.id_documentbudget) '
                            . 'FROM mouvementbanciare mb where mb.id_documentbudget IS NOT NULL)')
                    ->andWhere('Piece.id_docachat is null')
                    ->orderBy('db.numero')
                    ->fetchArray();
//            die($q);
            die(json_encode($q));
        }
        die('Erreur');
    }

    public function executeNewBDCG(sfWebRequest $request) {

        $this->id = $request->getParameter('id');
    }

    public function executeNewBDC(sfWebRequest $request) {

        $this->id = $request->getParameter('id');
    }

    //_________________________________________________Ajouter nouveau fiche par type: BCI
    public function executeSavemouvement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $soldefinal = 0;
        $banqueid = -1;
        $ids = '';
        if (!empty($content)) {
            $params1 = json_decode($content, true);

            $operations = $params1['operations'];
            $id_doc = $params1['id_doc'];
            foreach ($operations as $params) {
                $idbanque = $params['id_banque'];
                $banqueid = $idbanque;
                $numero = $params['nb'];
                $reford = $params['reford'];
                $id_documentbudget = $params['reford_id'];

                $numero_doc = $params['numero_doc'];
                $id_object = $params['id_object'];
                $refbenifi = $params['refbenifi'];
                $debit = $params['debit'];
                $credit = $params['credit'];
                $solde = $params['solde'];
                $tvaretenue = $params['tvaretenue'];
                $retenue = $params['retenue'];
                $dateoperation = $params['dateoperation'];
                $nomoperation = $params['nomoperation'];
                $refinstrument = $params['refinstrument'];
                $id_documentachat = $params['id_documentachat'];
                if ($id_documentachat) {
                    $piecejoint = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($id_documentachat);
                    $id_doc_achat = $piecejoint->getIdDocachat();

                    $id_doc_achat = $piecejoint->getIdDocachat();

                    $doc_achat = Doctrine_Core::getTable('documentachat')->findOneById($id_doc_achat);
                    $doc_achat->setIdEtatdoc(31);
                    $doc_achat->save();
                    /*                     * ****************************Update des quitance provisoire Inactif********************************* */
                    $id_doc_parent = $doc_achat->getIdDocparent();
                    $document_achat = DocumentachatTable::getInstance()->findOneByIdDocparentAndIdTypedoc($id_doc_parent, 17);
                    $quitances_def = LigneoperationcaisseTable::getInstance()->findByIdDocachatAndIdCategorie($document_achat->getId(), 2);

                    if ($quitances_def) {
//                    die(sizeof($quitances_def) . 'fs' . $document_achat->getId().$id_doc_parent);
                        foreach ($quitances_def as $quitance_def):
                            $quitance_def->setEtat('Ordonnonce');
                            $quitance_def->save();
                        endforeach;
                    }
                }
                /*                 * ************************************************************************************************* */

                $mouvement = new Mouvementbanciare();
                if ($numero)
                    $mouvement->setNumero($numero);
                if ($nomoperation)
                    $mouvement->setNomoperation($nomoperation);
                if ($numero_doc)
                    $mouvement->setReford($numero_doc);
                if ($reford)
                    $mouvement->setReford($reford);
                if ($id_doc)
                    $mouvement->setIdDocumentbudget($id_doc);

                if ($id_documentbudget)
                    $mouvement->setIdDocumentbudget($id_documentbudget);
                if ($id_documentachat)
                    $mouvement->setIdDocumentachat($id_documentachat);

                $mouvement->setIdBanque($idbanque);
                $mouvement->setIdObject($id_object);
                $mouvement->setReferenceautre($refinstrument);
                if ($credit != "")
                    $mouvement->setCredit($credit);
                if ($debit != "") {
                    $mouvement->setDebit($debit);
                }

                $mouvement->setRefbenifi($refbenifi);
                $mouvement->setDateoperation($dateoperation);
                $mouvement->setSolde($solde);

                $mouvement->save();

                //Ajout du mouvement lié au compte cible du transfert du compte au compte ou caisse.
                if ($id_object == 4) {
                    $id_banque_cible = $params['id_banque_cible'];
                    $mouvement_cible = new Mouvementbanciare();
                    //trouver le numéro suivant pour le mouvement du compte
                    $mvt = MouvementbanciareTable::getInstance()->getLastOpeartionInCompte($id_banque_cible);
                    if ($mvt != null)
                        $numero_cible = intval(intval($mvt->getNumero()) + 1);
                    else
                        $numero_cible = 1;
                    $mouvement_cible->setNumero($numero_cible);
                    $mouvement_cible->setNomoperation($nomoperation);
                    $mouvement_cible->setReford($reford);
                    if ($id_documentachat)
                        $mouvement_cible->setIdDocumentachat($id_documentachat);
                    $mouvement_cible->setIdBanque($id_banque_cible);
                    $mouvement_cible->setIdObject($id_object);
                    $mouvement_cible->setReferenceautre($numero_cheque);
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
                    //Set les paramètres du bénéficiaire (1èr compte est le bénéficiaire du 2ème compte et vice versa)
                    $banque = CaissesbanquesTable::getInstance()->find($banqueid);
                    $mouvement_cible->setRefbenifi($banque->getLibelle());
                    $mouvement_cible->setDateoperation($dateoperation);
                    $mouvement_cible->setSolde($solde_cible);
                    //Set id mouvement précédent.
                    $mouvement_cible->setIdMouvement($mouvement->getId());
                    $mouvement_cible->save();

                    $banque_cible->setMntdefini($solde_cible);
                    $banque_cible->save();
                }



                $ids = $ids . $mouvement->getId() . '-';
                $soldefinal = $solde;
                $dossier = DossiercomptableTable::getInstance()->findAll()->getFirst();
                $reglemet = new Reglementcomptable();
                if ($dateoperation)
                    $reglemet->setDate($dateoperation);
                if ($dateoperation)
                    $reglemet->setDateimportation($dateoperation);
                if ($dateoperation)
                    $reglemet->setDatevaleur($dateoperation);
                if ($idbanque)
                    $reglemet->setIdBanque($idbanque);
                $reglemet->setSaisie(0);
                if ($mouvement->getDebit() != '' && $mouvement->getDebit() != null) {
                    $reglemet->setTotalttc($mouvement->getDebit());
                    $reglemet->setType('Debit');
                }
                if ($mouvement->getCredit() != '' && $mouvement->getCredit() != null) {
                    $reglemet->setTotalttc($mouvement->getCredit());
                    $reglemet->setType('Credit');
                }
                $reglemet->setIdDossier($dossier->getId());
                $year = date('Y', strtotime($mouvement->getDateoperation()));
                $exercie = ExerciceTable::getInstance()->getAllExerciceByAnnee($year);
//                die($year. sizeof($exercie));
                $reglemet->setNumero($numero);
                $reglemet->setIdMouvement($mouvement->getId());
                if (sizeof($mouvement->getDocumentbudget()->getPiecejointbudget()) >= 1) {

                    if ($mouvement->getDocumentbudget()->getPiecejointbudget()->getFirst()->getDocumentachat()->getFournisseur()->getId() != null) {
                        $frs = $mouvement->getDocumentbudget()->getPiecejointbudget()->getFirst()->getDocumentachat()->getFournisseur();
                        $id_plan = $frs->getIdPlancomptable();
                        if ($id_plan != null) {
                            $plandossier = PlandossiercomptableTable::getInstance()->findOneByIdPlanAndIdExerciceAndIdDossier($id_plan, $exercie->getFirst()->getId(), $dossier->getId());
                            $reglemet->setIdFrs($frs->getId());
                            $reglemet->setIdComptecomptable($plandossier->getId());
                        }
                    }
                }
                if (sizeof($mouvement->getDocumentachat()->getPiecejointbudget()) >= 1) {
//                    die('id=' . $mouvement->getDocumentachat()->getPiecejointbudget()->getFirst()->getDocumentachat()->getFournisseur()->getId());
                    if ($mouvement->getDocumentachat()->getPiecejointbudget()->getFirst()->getDocumentachat()->getFournisseur()->getId() != null) {
                        $frs = $mouvement->getDocumentachat()->getPiecejointbudget()->getFirst()->getDocumentachat()->getFournisseur();
                        $id_plan = $frs->getIdPlancomptable();
                        if ($id_plan != null) {
//                            die($id_plan.'id_pla= id_exer' . $exercie->getFirst()->getId(). ' id_dos'.  $dossier->getId());
                            $plandossier = PlandossiercomptableTable::getInstance()->findOneByIdPlanAndIdExerciceAndIdDossier($id_plan, $exercie->getFirst()->getId(), $dossier->getId());
                            $reglemet->setIdFrs($frs->getId());

                            $reglemet->setIdComptecomptable($plandossier->getId());
                        }
                    }
                }
                $reglemet->save();


                $facture_od = new Facturecomptableod();
                if ($dateoperation)
                    $facture_od->setDate($dateoperation);
                if ($dateoperation)
                    $facture_od->setDateimportation($dateoperation);
                $facture_od->setSaisie(0);

//                if ($mouvement->getDebit() != '' && $mouvement->getDebit() != null) {
                $mnt_frs = floatval($tvaretenue + $retenue);
                $facture_od->setTotalttc($mnt_frs);
//                }
//                if ($mouvement->getCredit() != '' && $mouvement->getCredit() != null) {
//                    $facture_od->setTotalttc($mnt_frs);
//                }
                //tva 
                if ($tvaretenue)
                    $facture_od->setTotaltva($tvaretenue);
                //retenue
                if ($retenue)
                    $facture_od->setTotalht($retenue);
                /*                 * document achat not null* */
                if ($mouvement->getIdDocumentachat() != null && $mouvement->getIdDocumentachat() != '') {
                    $document_fac = DocumentachatTable::getInstance()->findOneByIdDocparent($mouvement->getIdDocumentachat());
                    $document = DocumentachatTable::getInstance()->find($id_documentachat);
                    $facture_od->setIdFacture($id_documentachat);
                    $facture_od->setIdFournisseur($document->getIdFrs());

                    $pice_joint_budget = PiecejointbudgetTable::getInstance()->findByIdDocachat($mouvement->getIdDocumentachat());
//                    die('id='.$mouvement->getIdDocumentachat().'  '.$document_fac->getId().'fffffffff'. $pice_joint_budget->getFirst()->getId().'ds');
                    $id_doc_budget = $pice_joint_budget->getFirst()->getIdDocumentbudget();
                    $certficat = CertificatretenueTable::getInstance()->getByBudget($id_doc_budget);
                    if (sizeof($certficat) >= 1)
                        $facture_od->setIdCertfificat($certficat->getId());
                }
                if ($mouvement->getDocumentbudget() != null && $mouvement->getDocumentbudget() != '' && $mouvement->getIdDocumentachat() == null) {
                    if (sizeof($mouvement->getDocumentbudget()->getPiecejointbudget()) >= 1) {
                        if ($mouvement->getDocumentbudget()->getPiecejointbudget()->getFirst()->getDocumentachat()->getFournisseur()->getId() != null) {
//             $reglemet$reglemet->setIdFrs($mouvement->getPiecejointbudget()->getDocumentachat()->getFourniseur()->getId());
                            $frs = $mouvement->getDocumentbudget()->getPiecejointbudget()->getFirst()->getDocumentachat()->getFournisseur();
                            $facture_od->setIdFournisseur($frs->getId());
                            $document_achat = DocumentachatTable::getInstance()->findOneByIdDocparent($mouvement->getDocumentbudget()->getPiecejointbudget()->getFirst()->getIdDocachat());
                            $facture_od->setIdFacture($document_achat->getId());
                        }
                    }
                    $document_b = DocumentbudgetTable::getInstance()->findOneById($mouvement->getIdDocumentbudget());
                    $certficat = CertificatretenueTable::getInstance()->getByBudget($document_b->getIdDocumentbudget());
//die($mouvement->getIdDocumentbudget() );
                    if (sizeof($certficat) >= 1)
                        $facture_od->setIdCertfificat($certficat->getId());
                }

                $facture_od->setIdDossier($dossier->getId());
                $year = date('Y', strtotime($mouvement->getDateoperation()));

                $exercie = ExerciceTable::getInstance()->findByLibelle($year);

                $facture_od->setNumero($numero);
                if ($reford)
                    $facture_od->setReference($reford);


                $facture_od->save();
            }


            $banque = new Caissesbanques();
            $banque = Doctrine_Core::getTable('caissesbanques')->findOneById($banqueid);

            $banque->setMntdefini($soldefinal);
            $banque->save();

            die("" . $ids);
        }
    }

    public function executeSavemouvementBDCReg(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $soldefinal = 0;
        $banqueid = -1;
        $ids = '';
        if (!empty($content)) {
            $params1 = json_decode($content, true);
            $operations = $params1['operations'];
            $id_doc = $params1['id_doc'];
            foreach ($operations as $params) {
                $idbanque = $params['id_banque'];
                $banqueid = $idbanque;
                $numero = $params['nb'];
                $reford = $params['reford'];
                $id_object = $params['id_object'];
                $refbenifi = $params['refbenifi'];
                $debit = $params['debit'];
                $credit = $params['credit'];
                $solde = $params['solde'];
                $tvaretenue = $params['tvaretenue'];
                $retenue = $params['retenue'];
                $dateoperation = $params['dateoperation'];
                $nomoperation = $params['nomoperation'];
                $refinstrument = $params['refinstrument'];
                $id_documentachat = $id_doc;
                if ($id_documentachat)
                    $piecejoint = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($id_documentachat);
                $id_doc_achat = $piecejoint->getIdDocachat();

                $id_doc_achat = $piecejoint->getIdDocachat();

                $doc_achat = Doctrine_Core::getTable('documentachat')->findOneById($id_doc_achat);
                $doc_achat->setIdEtatdoc(31);
                $doc_achat->save();
                /*                 * ****************************Update des quitance provisoire Inactif********************************* */

                $quitances_def = LigneoperationcaisseTable::getInstance()->findByIdDocachatAndIdCategorie($doc_achat->getIdFils(), 2);
                if ($quitances_def) {
                    foreach ($quitances_def as $quitance_def):
                        $quitance_def->setEtat('Ordonnonce');
                        $quitance_def->save();
                    endforeach;
                }
                /*                 * ************************************************************************************************ */
                $mouvement = new Mouvementbanciare();
                $mouvement->setNumero($numero);
                $mouvement->setNomoperation($nomoperation);
                $mouvement->setReford($reford);
                if ($id_documentachat)
                    $mouvement->setIdDocumentachat($id_documentachat);
                $mouvement->setIdBanque($idbanque);
                $mouvement->setIdObject($id_object);
                $mouvement->setReferenceautre($refinstrument);
                if ($credit != "")
                    $mouvement->setCredit($credit);
                if ($debit != "") {
                    $mouvement->setDebit($debit);
                }
                $mouvement->setRefbenifi($refbenifi);
                $mouvement->setDateoperation($dateoperation);
                $mouvement->setSolde($solde);
                $mouvement->save();
                //Ajout du mouvement lié au compte cible du transfert du compte au compte ou caisse.
                $ids = $ids . $mouvement->getId() . '-';
                $soldefinal = $solde;
                $dossier = DossiercomptableTable::getInstance()->findAll()->getFirst();
                $reglemet = new Reglementcomptable();
                if ($dateoperation)
                    $reglemet->setDate($dateoperation);
                if ($dateoperation)
                    $reglemet->setDateimportation($dateoperation);
                if ($dateoperation)
                    $reglemet->setDatevaleur($dateoperation);
                if ($idbanque)
                    $reglemet->setIdBanque($idbanque);
                $reglemet->setSaisie(0);
                if ($mouvement->getDebit() != '' && $mouvement->getDebit() != null) {
                    $reglemet->setTotalttc($mouvement->getDebit());
                    $reglemet->setType('Debit');
                }
                if ($mouvement->getCredit() != '' && $mouvement->getCredit() != null) {
                    $reglemet->setTotalttc($mouvement->getCredit());
                    $reglemet->setType('Credit');
                }
                $reglemet->setIdDossier($dossier->getId());
                $year = date('Y', strtotime($mouvement->getDateoperation()));
                $exercie = ExerciceTable::getInstance()->getAllExerciceByAnnee($year);
                $reglemet->setNumero($numero);
                $reglemet->setIdMouvement($mouvement->getId());
                $reglemet->save();

                if ($retenue) {
                    $facture_od = new Facturecomptableod();
                    if ($dateoperation)
                        $facture_od->setDate($dateoperation);
                    if ($dateoperation)
                        $facture_od->setDateimportation($dateoperation);
                    $facture_od->setSaisie(0);

//                if ($mouvement->getDebit() != '' && $mouvement->getDebit() != null) {
                    $mnt_frs = floatval($tvaretenue + $retenue);
                    $facture_od->setTotalttc($mnt_frs);

                    if ($tvaretenue)
                        $facture_od->setTotaltva($tvaretenue);
                    //retenue
                    if ($retenue)
                        $facture_od->setTotalht($retenue);
                    /*                     * document achat not null* */
                    if ($mouvement->getIdDocumentachat() != null && $mouvement->getIdDocumentachat() != '') {
                        $document_fac = DocumentachatTable::getInstance()->findOneByIdDocparent($mouvement->getIdDocumentachat());
                        $document = DocumentachatTable::getInstance()->find($id_documentachat);
                        $facture_od->setIdFacture($id_documentachat);
                        $pice_joint_budget = PiecejointbudgetTable::getInstance()->findByIdDocachat($mouvement->getIdDocumentachat());
                        $id_doc_budget = $pice_joint_budget->getFirst()->getIdDocumentbudget();
                        $certficats = CertificatretenueTable::getInstance()->getByBudget($id_doc_budget);
//                        if (sizeof($certficats) >= 1)
//                            foreach ($certficats as $certficat)
//                             $facture_od->setIdCertfificat($certficat->getId());
                    }
                    if ($mouvement->getDocumentbudget() != null && $mouvement->getDocumentbudget() != '' && $mouvement->getIdDocumentachat() == null) {
                        if (sizeof($mouvement->getDocumentbudget()->getPiecejointbudget()) >= 1) {
                            if ($mouvement->getDocumentbudget()->getPiecejointbudget()->getFirst()->getDocumentachat()->getFournisseur()->getId() != null) {
                                $document_achat = DocumentachatTable::getInstance()->findOneByIdDocparent($mouvement->getDocumentbudget()->getPiecejointbudget()->getFirst()->getIdDocachat());
                                $facture_od->setIdFacture($document_achat->getId());
                            }
                        }
                        $document_b = DocumentbudgetTable::getInstance()->findOneById($mouvement->getIdDocumentbudget());
                        $certficat = CertificatretenueTable::getInstance()->getByBudget($document_b->getIdDocumentbudget());
                        if (sizeof($certficat) >= 1)
                            $facture_od->setIdCertfificat($certficat->getId());
                    }
                    $facture_od->setIdDossier($dossier->getId());
                    $year = date('Y', strtotime($mouvement->getDateoperation()));

                    $exercie = ExerciceTable::getInstance()->findByLibelle($year);
                    $facture_od->setNumero($numero);
                    if ($reford)
                        $facture_od->setReference($reford);
                    $facture_od->save();
                }
            }

            $banque = new Caissesbanques();
            $banque = Doctrine_Core::getTable('caissesbanques')->findOneById($banqueid);

            $banque->setMntdefini($soldefinal);
            $banque->save();

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
        $this->caisses = CaissesbanquesTable::getInstance()->getAllCaisse();
    }

    //imprimer mouvements banque
    public function executeImprimerMouvementCaisse(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $ids = $request->getParameter('ids');
        $ids = substr($ids, 0, -1);
        $ids = explode('-', $ids);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Mouvements Caisse');
        $pdf->SetSubject("Mouvements Caisse");
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
        $html = $this->ReadHtmlMouvementCaisse($ids);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Mouvements Caisse.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlMouvementCaisse($ids) {
        $html = StyleCssHeader::header1();
        $mvb = new Mouvementbanciare();
        $html .= $mvb->ReadHtmlMouvementsCaisse($ids);
        return $html;
    }

    public function executeGoPage(sfWebRequest $request) {
        $pager = $this->getAllMouvements($request);
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');
        return $this->renderPartial("list", array("pager" => $pager, "date_debut" => $date_debut, "date_fin" => $date_fin, "id_banque" => $id_banque));
    }

    function getAllMouvements(sfWebRequest $request) {
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

    public function executeImprimerSearchMouvementCaisse(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Mouvements Caisse');
        $pdf->SetSubject("Mouvements Caisse");
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
        $html = $this->ReadHtmlSearchMouvementCaisse($date_debut, $date_fin, $id_banque);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Mouvements Caisse.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlSearchMouvementCaisse($date_debut, $date_fin, $id_banque) {
        $html = StyleCssHeader::header1();
        $mvb = new Mouvementbanciare();
        $html .= $mvb->ReadHtmlSearchMouvementsCaisse($date_debut, $date_fin, $id_banque);
        return $html;
    }

    public function executeJournal(sfWebRequest $request) {
        $this->caisses = CaissesbanquesTable::getInstance()->getAllCaisse();
        $this->fournisseurs = FournisseurTable::getInstance()->getAllOrderByRaisonSociale();
    }

    public function executeSuivisoldeCaisse(sfWebRequest $request) {
        $this->caisses = CaissesbanquesTable::getInstance()->getAllCaisse();
        $this->fournisseurs = FournisseurTable::getInstance()->getAllOrderByRaisonSociale();
    }

    public function executeSuivisoldeCaisseParCaisse(sfWebRequest $request) {
//        $id = $request->getParameter('id', '');
//        $this->caisse = CaissesbanquesTable::getInstance()->find($id);
        $this->caisses = CaissesbanquesTable::getInstance()->getAllCaisse();
        $this->fournisseurs = FournisseurTable::getInstance()->getAllOrderByRaisonSociale();
    }

    public function executeGoPageJournal(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');
        $type = $request->getParameter('type', 'tout');
        $quitance = $request->getParameter('quitance', '');

        $mouvements = MouvementbanciareTable::getInstance()->findAllMouvement($date_debut, $date_fin, $id_banque, $quitance);
        return $this->renderPartial("list_journal", array("mouvements" => $mouvements, "date_debut" => $date_debut, "date_fin" => $date_fin, "id_banque" => $id_banque, "type" => $type, "quitance" => $quitance));
    }

    public function executeImprimerJournalMouvementCaisse(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_banque = $request->getParameter('id_banque', '');
        $type = $request->getParameter('type', 'tout');

        $pdf = new sfTCPDF('L');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Journal Mouvements Caisse');
        $pdf->SetSubject("Journal Mouvements Caisse");
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
        $html = $this->ReadHtmlJournalMouvementCaisse($date_debut, $date_fin, $id_banque, $type);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Journal Mouvements Caisse.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlJournalMouvementCaisse($date_debut, $date_fin, $id_banque, $type) {
        $html = StyleCssHeader::header1();
        $mvb = new Mouvementbanciare();
        $html .= $mvb->ReadHtmlJournalMouvementsCaisse($date_debut, $date_fin, $id_banque, $type);
        return $html;
    }

    public function executeListeBonDepenseComptant(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idbanque'];
            $q = Doctrine_Query::create()
                    ->select("da.id as id, da.numero as libelle")
                    ->from('Documentachat da')
                    ->leftJoin('da.Piecejointbudget p')
                    ->leftJoin('p.Documentbudget db')
                    ->leftJoin('db.Ligprotitrub l')
                    ->leftJoin('l.Ligneoperationcaisse lbc')
                    ->where('lbc.id_caisse=' . $id)
                    ->andWhere('db.id_type=2 ')
                    ->andwhere('da.id  IN (SELECT DISTINCT(Piecejointbudget.id_docachat) '
                            . 'FROM Piecejointbudget, documentbudget,documentachat'
                            . ' WHERE Piecejointbudget.id_docachat = documentachat.id '
                            . 'AND (documentachat.id_typedoc=2 or documentachat.id_typedoc=15) )')
                    ->andWhere('da.id  NOT IN (SELECT DISTINCT(mb.id_documentachat)'
                            . ' FROM mouvementbanciare mb '
                            . ' where mb.id_documentachat=da.id'
                            . ' and  mb.id_documentachat IS NOT NULL)')
                    ->orderBy('da.numero')
                    ->fetchArray();
//            die($q);
            die(json_encode($q));

//            $q = Doctrine_Query::create()
//                    ->select("da.id as id, da.numero as libelle")
//                    ->from('Documentachat da')
//                    ->leftJoin('da.Ligneoperationcaisse l')
//                    ->where('da.id_typedoc=2')
//                    ->andwhere('l.id_caisse is not null')
//                ->andwhere('l.id_caisse=' . $id)
//                    ->andwhere('da.id  IN (SELECT DISTINCT(Piecejointbudget.id_docachat) '
//                            . 'FROM Piecejointbudget, documentbudget,documentachat'
//                            . ' WHERE Piecejointbudget.id_docachat = documentachat.id '
//                            . 'AND documentachat.id_typedoc=2)')
//                    
//                    ->andWhere('da.id  NOT IN (SELECT DISTINCT(mb.id_documentachat)'
//                            . ' FROM mouvementbanciare mb 
//                                where  mb.id_documentachat IS NOT NULL)')
//                    ->orderBy('da.numero')
//                    ->select("da.id as id, da.numero as libelle")
//                    ->from('Documentachat da')
//                    ->leftJoin('da.Ligneoperationcaisse l')
//                    ->where('da.id_typedoc=2')
//                    ->andwhere('l.id_caisse=' . $id)
////                    ->andwhere('da.id NOT IN (SELECT DISTINCT(Piecejointbudget.id_docachat) '
////                            . 'FROM Piecejointbudget, documentbudget'
////                            . ' WHERE Piecejointbudget.id_documentbudget = documentbudget.id '
////                            . 'AND documentbudget.id_type=2)')
//                    ->andwhere('da.id NOT IN (SELECT DISTINCT(Piecejointbudget.id_docachat) '
//                            . 'FROM Piecejointbudget, documentbudget,documentachat'
//                            . ' WHERE Piecejointbudget.id_docachat = documentachat.id '
//                            . 'AND documentachat.id_typedoc=2)')
//                    ->andWhere('da.id  NOT IN (SELECT DISTINCT(mb.id_documentachat)'
//                            . ' FROM mouvementbanciare mb ,documentachat where mb.id_documentachat=documentachat.id'
//                            . ' and  mb.id_documentachat IS NOT NULL)')
//                    ->orderBy('da.numero')
//                    ->fetchArray();
//            die(json_encode($q));
        }
        die('Erreur');
    }

    public function executeDetailsBonDepensesComptant(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "select da.id as id,da.numero as numero, da.mntttc as mnt, f.id as fournisseur_id, f.rs as fournisseur_rs "
                    . " FROM Documentachat da ,Fournisseur f "
                    . " WHERE da.id= " . $id
                    . " and da.id_frs =f.id"
            ;
            $resultat = $conn->fetchAssoc($query);
//            $q = Doctrine_Query::create()
//                    ->from('Documentachat da')
//                    ->leftJoin('da.Fournisseur f ')
//                    ->select("da.id as id,da.numero as numero, da.mntttc as mnt, f.id as fournisseur_id, f.rs as fournisseur_rs")
//                    ->where('da.id=' . $id)
//                    ->fetchArray();
            die(json_encode($resultat));
        }
        die('Erreur');
    }

    public function executeSupprimerMouvement(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $mvt = MouvementbanciareTable::getInstance()->find($id);

        if ($mvt->getIdObject() == 4) {
            //Traitement sur solde compte & suppression en cas : objet de règlement = transfert
            //mouvement parent
            $mvt_parent = MouvementbanciareTable::getInstance()->find($mvt->getIdMouvement());
            if ($mvt_parent != null) {
                //Mise à jour du solde du compte du mouvement parent
                $banque_parent = CaissesbanquesTable::getInstance()->find($mvt_parent->getIdBanque());
                $soldefinal = 0;
                if ($mvt_parent->getCredit() != null)
                    $soldefinal = $banque_parent->getMntdefini() - $mvt_parent->getCredit();
                else
                    $soldefinal = $banque_parent->getMntdefini() + $mvt_parent->getDebit();

                if ($mvt_parent->getMntenoper() != null)
                    $soldefinal = $soldefinal + $mvt_parent->getMntenoper();

                $banque_parent->setMntdefini($soldefinal);
                $banque_parent->save();

                $mvt_parent->delete();
            }
            //$mouvement fils
            $mvt_fils = MouvementbanciareTable::getInstance()->findOneByIdMouvement($mvt->getId());
            if ($mvt_fils != null) {
                //Mise à jour du solde du compte du mouvement fils
                $banque_fils = CaissesbanquesTable::getInstance()->find($mvt_fils->getIdBanque());
                $soldefinal = 0;
                if ($mvt_parent->getCredit() != null)
                    $soldefinal = $banque_fils->getMntdefini() - $mvt_fils->getCredit();
                else
                    $soldefinal = $banque_fils->getMntdefini() + $mvt_fils->getDebit();

                if ($mvt_parent->getMntenoper() != null)
                    $soldefinal = $soldefinal + $mvt_fils->getMntenoper();

                $banque_fils->setMntdefini($soldefinal);
                $banque_fils->save();

                //Pas de traitement du chèque pour le mouvement fils

                $mvt_fils->delete();
            }
        }

        //Mise à jour du solde du compte
        $banque = CaissesbanquesTable::getInstance()->find($mvt->getIdBanque());
        $soldefinal = 0;
        if ($mvt->getCredit() != null)
            $soldefinal = $banque->getMntdefini() - $mvt->getCredit();
        else
            $soldefinal = $banque->getMntdefini() + $mvt->getDebit();

        if ($mvt->getMntenoper() != null)
            $soldefinal = $soldefinal + $mvt->getMntenoper();

        $banque->setMntdefini($soldefinal);
        $banque->save();

        $mvt->delete();

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

    public function executeTestExistantccertificat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $pice_joint_budget = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($id);
            if ($pice_joint_budget)
                $id_doc_budget = $pice_joint_budget->getIdDocumentbudget();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT certificatretenue.id as id, documentbudget.id as idbudget "
                    . " FROM certificatretenue ,documentbudget "
                    . " WHERE certificatretenue.id_documentbudget =" . $id_doc_budget
                    . " and certificatretenue.id_documentbudget =documentbudget.id"
            ;
            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }
        die('Erreur');
    }

    public function executeTestExistantccertificatReg(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $pice_joint_budget = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($id);
            $id_doc_budget = $pice_joint_budget->getIdDocumentbudget();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT certificatretenue.id as id, documentbudget.id as idbudget "
                    . " FROM certificatretenue ,documentbudget "
                    . " WHERE certificatretenue.id_documentbudget =" . $id_doc_budget
                    . " and certificatretenue.id_documentbudget =documentbudget.id"
            ;
            $resultat = $conn->fetchArray($query);
            die(json_encode($resultat));
        }
        die('Erreur');
    }

    public function executeDetailsOrdonnanceCertifieReg(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $id_certif = $params['id_certif'];

            $id_docbudget = $params['id_docbudget'];
            $pice_joint_budget = PiecejointbudgetTable::getInstance()->findByIdDocachat($id);
            $id_doc_budget = $pice_joint_budget->getFirst()->getIdDocumentbudget();

            $q = Doctrine_Query::create()
                    ->from('Certificatretenue certif')
                    ->leftJoin('certif.Documentbudget db ')
                    ->leftJoin('db.Piecejointbudget pjb')
                    ->leftJoin('pjb.Documentachat da')
                    ->leftJoin('da.Typedoc typdoc')
                    ->leftJoin('certif.Fournisseur f')
//                    ->where('da.id_docparent=' . $id)
//                    ->andWhere('da.id_typedoc=15')
                    ->select("db.id as id,db.numero as numero, db.mntnet as mnt,"
                            . " certif.montantordonnancenet as montant_ordonnancenet, "
                            . " pjb.id as pjb_id, da.id as da_id, f.id as fournisseur_id,"
                            . " f.rs as fournisseur_rs, f.rib as fournisseur_rib,"
                            . "certif.montantretenue as mnt_retenue ,certif.tvaretenue as  mnt_retenuetva")
                    ->where('db.id=' . $id_doc_budget)
//                    ->andWhere('certif.id_documentbudget=db.id')
                    ->fetchArray();
            die(json_encode($q));
        }
        die('Erreur');
    }

    public function executeDetailslistesFactures(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $query = "SELECT documentachat.id as ref,"
                    . "concat( trim(typedoc.prefixetype),trim(documentachat.numero::text)) as name "
                    . "FROM    documentachat,typedoc "
                    . "WHERE documentachat.id_typedoc=typedoc.id  "
                    . "and typedoc.id=15"
                    . " and documentachat.id_docparent= " . $id;

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
    }

    public function executeDetailsOrdonnanceCertifie(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $id_certif = $params['id_certif'];
            $pice_joint_budget = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($id);
            $id_doc_budget = $pice_joint_budget->getIdDocumentbudget();

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
                    ->where('db.id=' . $id_doc_budget)
//                    ->andWhere('certif.id_documentbudget=db.id')
                    ->fetchArray();
            die(json_encode($q));
        }
        die('Erreur');
    }

}
