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
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;
        if ($request->getParameter('id') && $request->getParameter('id') != "") {
            $this->documentachats = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')
                    ->where('id_typedoc=6')
                    ->andwhere('id_docparent=' . $request->getParameter('id'))
                    ->execute();
            $this->documentdeponses = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')
                    ->where('id_typedoc=2')
                    ->andwhere('id_docparent=' . $request->getParameter('id'))
                    ->execute();
            $this->demandesprix = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')
                    ->where('id_typedoc=8')
                    ->andwhere('id_docparent=' . $request->getParameter('id'))
                    ->execute();
            $doc = new Documentachat();
            $document = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('id'));
            $this->documentachat = $document;

            $doc = $document;
            $this->id = $request->getParameter('id');
            $this->texte = $doc->getDatecreation() . '-' . $doc->getNumerodocachat() . '-' . trim($doc->getReference()) . '-' . $doc->getAgents();
        }
    }
    public function executeImprimerBDCDefinitf(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche B.D.C Définitf');
        $pdf->SetSubject("Fiche B.D.C Définitf");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $logo = $soc->getLogo();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail()
                . '<br>Adresse:' . $soc->getAdresse() . '';
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);

        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //$pdf->setFooterData(array(0,64,0), array(0,64,128));
        $pdf->CustomFooter($adresse, '');
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 12, '', true);
        $pdf->AddPage();

        $html = $this->ReadHtmlBDCDefinitif($iddoc);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Fiche B.D.C Définitf.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBDCDefinitif($iddoc) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBDCProvisoire($iddoc);
        return $html;
    }
    public function executeIndexfrs(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;

        $this->form = new DocumentachatFormFilter();
        $idtype = 7;
        if ($request->getParameter('idtype'))
            $idtype = $request->getParameter('idtype');
        $this->idtype = $idtype;
        $this->boncommandeexterne = Doctrine_Core::getTable('documentachat')
                        ->createQuery('a')->where('id_typedoc=' . $idtype);
        $this->datedebut = "";
        $this->datefin = "";
        $this->idfrs = "";
        if ($request->getParameter('debut') && $request->getParameter('debut') != "") {
            $this->datedebut = $request->getParameter('debut');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation>='" . $request->getParameter('debut') . "'");
        }
        if ($request->getParameter('fin') && $request->getParameter('fin') != "") {
            $this->datefin = $request->getParameter('fin');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation<='" . $request->getParameter('debut') . "'");
        }
        if ($request->getParameter('idfrs') && $request->getParameter('idfrs') != "") {
            $this->idfrs = $request->getParameter('idfrs');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_frs=" . $request->getParameter('idfrs'));
        }
        $this->boncommandeexterne = $this->boncommandeexterne->orderby('id desc')->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
        $this->idtype = "";
        if ($request->getParameter('idtype'))
            $this->idtype = $request->getParameter('idtype');
    }

    public function executeExportfacture(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
        $this->idtype = "";
        $fac = new Documentachat();
        $fac->setIdTypedoc(15);
        $fac->setIdDocparent($this->documentachat->getId());
        $fac->setNumero($fac->NumeroSeqDocumentAchat(15));
        $fac->setDatecreation(date("Y-m-d"));
        $this->facture = $fac;

        $this->formfacture = new DocumentachatForm($this->facture);
        if ($request->getParameter('idtype'))
            $this->idtype = $request->getParameter('idtype');
    }

//validerfacture
    public function executeValiderfacture(sfWebRequest $request) {
        $pv = new Documentachat();
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
        $pv = $this->documentachat;
        $this->idtype = "";
        $fac = new Documentachat();
        $fac->setIdTypedoc(15);
        $fac->setIdDocparent($this->documentachat->getId());
        $fac->setNumero($fac->NumeroSeqDocumentAchat(15));
        $fac->setDatecreation(date("Y-m-d"));
        $fac->setIdFrs($pv->getIdFrs());
        $fac->setMht($pv->getMht());
        $fac->setIdFrs($pv->getIdFrs());
        $fac->setMntttc($pv->getMntttc());
        $fac->setMnttva($pv->getMnttva());
        $fac->save();

        $listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($request->getParameter('id'));

        foreach ($listesdocuments as $ligne) {

            $docligne = new Lignedocachat();
            $qtelivree = $fac->getQteLivreeParFournisseur($ligne->getId());
            $docligne->setIdDoc($fac->getId());
            $docligne->setIdArticlestock($ligne->getIdArticlestock());
            $docligne->setIdTva($ligne->getIdTva());
            $docligne->setCodearticle($ligne->getCodearticle());
            $docligne->setMntht($ligne->getMntht());
            $docligne->setMntttc($ligne->getMntttc());
            $docligne->setMnttva($ligne->getMnttva());
            $docligne->setDesignationarticle($ligne->getDesignationarticle());
            $docligne->setQte($qtelivree);
            $docligne->setPu($ligne->getPu());
            $docligne->save();
        }
        $this->redirect('Documents/detail?id=' . $this->documentachat->getId());
    }

    public function executeDetail(sfWebRequest $request) {
        $doc = new Documentachat();

        $documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->id = $request->getParameter('id');
        $this->documentachat = $documentachat;
        $this->forward404Unless($this->documentachat);
        $idbce = $this->documentachat->getId();
        $doc_achat = $this->documentachat;
       // $doc_achat->setIdEtatdoc(29);
        $doc_achat->save();
        if ($documentachat->getIdTypedoc() != 6) {
            if ($request->getParameter('exporterjeton'))
                $this->ExporterBCexterne($request->getParameter('exporterjeton'), 16, $request->getParameter('exporterjeton'));
            if ($request->getParameter('exporterfacture')) {
                $verif_jeton = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($request->getParameter('exporterfacture'), 16);
                if ($verif_jeton) {
                    $this->ExporterBCexterne($verif_jeton->getId(), 15, $request->getParameter('exporterfacture'));
                } else
                    $this->ExporterBCexterne($request->getParameter('exporterfacture'), 15, $request->getParameter('exporterfacture'));
            }
        }else {
            if ($request->getParameter('exporterjeton'))
                $this->ExporterBCIcontrat($request->getParameter('exporterjeton'), 16, $request->getParameter('exporterjeton'));
            if ($request->getParameter('exporterfacture')) {
                $verif_jeton = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($request->getParameter('exporterfacture'), 16);
                if ($verif_jeton) {
                    $this->ExporterBCIcontrat($verif_jeton->getId(), 15, $request->getParameter('exporterfacture'));
                } else
                    $this->ExporterBCIcontrat($request->getParameter('exporterfacture'), 15, $request->getParameter('exporterfacture'));
            }
        }
        $verif_jeton = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($request->getParameter('id'), 16);

        if ($verif_jeton) {
            $idbce = $verif_jeton->getId();
        }
        $doc = $this->documentachat;
        $this->classBtn = "disabledbutton";
        $this->classBtnF = "";
        $this->classBtnJ = "";
        $piecejoint = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($doc->getId());
        $this->lienBCEJ = 0;
        $this->lienFacture = 0;
        $this->jeton = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($doc->getId(), 16);
        if ($this->jeton) {
            $this->lienBCEJ = 1;
            $this->classBtnJ = "disabledbutton";
        }

        $this->facture = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($idbce, 15);
        if ($this->facture) {
            $this->lienFacture = 1;
            $this->classBtnF = "disabledbutton";
        }
        if ($piecejoint && $doc->getDatesignature()) {
            $this->classBtn = "";
        }
    }

    public function executeDetailBCI(sfWebRequest $request) {
        $doc = new Documentachat();
        $this->id = $request->getParameter('id');
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
        $idbce = $this->documentachat->getId();
        $doc_achat = $this->documentachat;
        $doc_achat->setIdEtatdoc(29);
        $doc_achat->save();
        if ($request->getParameter('exporterjeton'))
            $this->ExporterBCexterne($request->getParameter('exporterjeton'), 16, $request->getParameter('exporterjeton'));
        if ($request->getParameter('exporterfacture')) {
            $verif_jeton = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($request->getParameter('exporterfacture'), 16);
            if ($verif_jeton) {
                $this->ExporterBCInterne($verif_jeton->getId(), 15, $request->getParameter('exporterfacture'));
            } else
                $this->ExporterBCInterne($request->getParameter('exporterfacture'), 15, $request->getParameter('exporterfacture'));
        }
        $verif_jeton = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($request->getParameter('id'), 16);

        if ($verif_jeton) {
            $idbce = $verif_jeton->getId();
        }
        $doc = $this->documentachat;
        $this->classBtn = "disabledbutton";
        $this->classBtnF = "";
        $this->classBtnJ = "";
        $piecejoint = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($doc->getId());
        $this->lienBCEJ = 0;
        $this->lienFacture = 0;
        $this->jeton = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($doc->getId(), 16);
        if ($this->jeton) {
            $this->lienBCEJ = 1;
            $this->classBtnJ = "disabledbutton";
        }

        $this->facture = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($idbce, 15);
        if ($this->facture) {
            $this->lienFacture = 1;
            $this->classBtnF = "disabledbutton";
        }
        if ($piecejoint && $doc->getDatesignature()) {
            $this->classBtn = "";
        }
    }

    public function executeTraiterFacture(sfWebRequest $request) {
//        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
//        $this->forward404Unless($this->documentachat);

        if (!$request->getParameter('id'))
            $this->redirect('@documentachat');
        $this->id = $request->getParameter('id');
        $iddoc = $request->getParameter('id');
        $this->ids = $iddoc;
        $iddoc = explode(',', $iddoc);
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc[0]);
        $this->liste_bcc = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc[0]);
        $demande_de_prix = new Documentachat();
        $this->numerodemande = $demande_de_prix->getNumeroBDCPParBCI($this->documentachat->getId());
        $demande_de_prix_defini = $demande_de_prix->getNumeroBDCDParBCI($this->documentachat->getId());
        $this->numerodemande_defi = $demande_de_prix_defini;
        $this->lieuxlivraisons = Doctrine_Core::getTable('lieulivraisson')->findAll();
        $this->idbdcp = 0;
        $this->tab = "";
        if ($request->getParameter('idbdc'))
            $this->idbdcp = $request->getParameter('idbdc');
        if ($request->getParameter('tab'))
            $this->tab = $request->getParameter('tab');
        $this->liste_document_achats = DocumentachatTable::getInstance()->getByIds($iddoc);
    }

    public function executeDetaillignemouvementBDCG(sfWebRequest $request) {
        $doc = new Documentachat();

        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
        $idbce = $this->documentachat->getId();
        $doc_achat = $this->documentachat;
//        $doc_achat->setIdEtatdoc(29);
        $doc_achat->save();
//        if ($request->getParameter('exporterjeton'))
//            $this->ExporterBCexterne($request->getParameter('exporterjeton'), 16, $request->getParameter('exporterjeton'));
//        if ($request->getParameter('exporterfacture')) {
//            $verif_jeton = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($request->getParameter('exporterfacture'), 16);
//            if ($verif_jeton) {
//                $this->ExporterBCexterne($verif_jeton->getId(), 15, $request->getParameter('exporterfacture'));
//            } else
//                $this->ExporterBCexterne($request->getParameter('exporterfacture'), 15, $request->getParameter('exporterfacture'));
//        }
//        $verif_jeton = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($request->getParameter('id'), 16);
//
//        if ($verif_jeton) {
//            $idbce = $verif_jeton->getId();
//        }
//        $doc = $this->documentachat;
//        $this->classBtn = "disabledbutton";
//        $this->classBtnF = "";
//        $this->classBtnJ = "";
//        $piecejoint = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($doc->getId());
//        $this->lienBCEJ = 0;
//        $this->lienFacture = 0;
//        $this->jeton = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($doc->getId(), 16);
//        if ($this->jeton) {
//            $this->lienBCEJ = 1;
//            $this->classBtnJ = "disabledbutton";
//        }
//
//        $this->facture = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($idbce, 15);
//        if ($this->facture) {
//            $this->lienFacture = 1;
//            $this->classBtnF = "disabledbutton";
//        }
//        if ($piecejoint && $doc->getDatesignature()) {
//            $this->classBtn = "";
//        }
    }

    public function executeDetaillignemouvement(sfWebRequest $request) {
        $doc = new Documentachat();
        $id = $request->getParameter('id');
        $this->id = $id;
        $ligne = Doctrine_Core::getTable('lignemouvementfacturation')->findOneById(array($request->getParameter('id')));
        $this->documentachat = $ligne->getDocumentachat();
        $this->forward404Unless($this->documentachat);
        $idbce = $this->documentachat->getId();
        $doc_achat = $this->documentachat;
        $doc_achat->setIdEtatdoc(29);
        $doc_achat->save();

        if ($request->getParameter('exporterjeton'))
            $this->ExporterBCexterne($request->getParameter('exporterjeton'), 16, $request->getParameter('exporterjeton'));
        if ($request->getParameter('exporterfacture')) {
            $verif_jeton = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($request->getParameter('exporterfacture'), 16);
            if ($verif_jeton) {
                $this->ExporterBCexterne($verif_jeton->getId(), 15, $request->getParameter('exporterfacture'));
            } else
                $this->ExporterBCexterne($request->getParameter('exporterfacture'), 15, $request->getParameter('exporterfacture'));
        }
        $verif_jeton = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($request->getParameter('id'), 16);

        if ($verif_jeton) {
            $idbce = $verif_jeton->getId();
        }
        $doc = $this->documentachat;
        $this->classBtn = "disabledbutton";
        $this->classBtnF = "";
        $this->classBtnJ = "";
        $piecejoint = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($doc->getId());
        $this->lienBCEJ = 0;
        $this->lienFacture = 0;
        $this->jeton = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($doc->getId(), 16);
        if ($this->jeton) {
            $this->lienBCEJ = 1;
            $this->classBtnJ = "disabledbutton";
        }


//        $factures = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedocAndIdContrat($idbce, 15, $doc_achat->getIdContrat());
        $factures = Doctrine_Core::getTable('documentachat')->getByDocparentAndContrat($idbce, 15, $doc_achat->getIdContrat());
//        $this->facture = $factures;
        $somme = 0;
        foreach ($factures as $facture):
//            die(sizeof($factures).'dde'.$facture->getId());
            $somme = $somme + floatval($facture->getMntttc());
            $this->facture = $facture;
        endforeach;

        //somme des mnt == mnt ttc du contrat 
//        die('somme=' . intval($somme) . 'ttc=' . intval($doc_achat->getContratachat()->getMnttc()));
        if ($this->facture) {
            $this->lienFacture = 1;
            if (intval($somme) == intval($doc_achat->getContratachat()->getMnttc())) {
                $this->classBtnF = "disabledbutton";
            }
        }
        if ($piecejoint && $doc->getDatesignature()) {
            $this->classBtn = "";
        }
    }

    public function executeDetailContrat(sfWebRequest $request) {
        $doc = new Documentachat();

        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
        $idbce = $this->documentachat->getId();
        $doc_achat = $this->documentachat;
        $doc_achat->setIdEtatdoc(29);
        $doc_achat->save();

        $doc = $this->documentachat;
        $this->classBtn = "disabledbutton";
        $this->classBtnF = "";
        $this->classBtnJ = "";
        $piecejoint = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($doc->getId());
        $this->ExporterContrat($request->getParameter('exporterfacture'), 15, $request->getParameter('exporterfacture'), $request->getParameter('id_mouvement'));
        $this->lienFacture = 0;


        $this->facture = Doctrine_Core::getTable('documentachat')->findOneByIdAndIdTypedoc($doc->getId(), 15);
        if ($this->facture) {
            $this->lienFacture = 1;
            $this->classBtnF = "disabledbutton";
        }
        if ($piecejoint && $doc->getDatesignature()) {
            $this->classBtn = "";
        }
    }

    public function executeDetailfacture(sfWebRequest $request) {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
        $this->id = $request->getParameter('id');
    }

    public function ExporterBCexterneR($id, $idtypefacture, $idparent, $id_ligne) {
        $bon = new Documentachat();
        $bce = Doctrine_Core::getTable('documentachat')->findOneById($id);
        $lignemvt = LignemouvementfacturationTable::getInstance()->find(($id_ligne));
//      die($id_ligne.'mp');
        if ($bce) {
            $bon = $bce;
            $jeton = new Documentachat();
            $j = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($id, $idtypefacture);
            if ($j)
                $jeton = $j;
            if ($idtypefacture == 16)
                $jeton->setNumero($bon->getNumero());
            else
                $jeton->setNumero($jeton->NumeroSeqDocumentAchat(15));
            $jeton->setDatecreation(date('Y-m-d'));
            $jeton->setIdDocparent($id);
            $jeton->setIdTypedoc($idtypefacture);
            if ($bon->getMht())
                $jeton->setMht($bon->getMht());
            if ($bon->getReference())
                $jeton->setReference($bon->getReference());
            if ($bon->getMnttva())
                $jeton->setMnttva($bon->getMnttva());
            if ($lignemvt->getMontant())
                $jeton->setMntttc($lignemvt->getMontant());
            $jeton->setIdFrs($bon->getIdFrs());
            $jeton->setIdUser($this->getUser()->getAttribute('userB2m'));
            $jeton->setDatesignature($bon->getDatesignature());
            $jeton->save();
//            $piece = new Piecejointbudget();
//            $p = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($jeton->getId());
//            $p_parent = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($id);
////            die($id.'mpp');
//            if ($p)
//                $piece = $p;
//            $piece->setIdDocachat($jeton->getId());
//            if ($p_parent->getIdType())
//                $piece->setIdType($p_parent->getIdType());
//            $piece->setReference($p_parent->getReference());
//            $piece->setIdDocumentbudget($p_parent->getIdDocumentbudget());
//            $piece->save();
//ligne doc
            $ligne = new Lignedocachat();
            foreach ($bon->getLignedocachat() as $l) {
                $ligne = $l;
                $ex = new Lignedocachat();
                $ex_test = Doctrine_Core::getTable('lignedocachat')->findOneByIdDocAndIdArticlestock($jeton->getId(), $ligne->getIdArticlestock());
                if ($ex_test)
                    $ex = $ex_test;
                $ex->setIdArticlestock($ligne->getIdArticlestock());
                $ex->setIdDoc($jeton->getId());
                $ex->setMntht($ligne->getMntht());
                $ex->setMntttc($ligne->getMntttc());
                $ex->setMnttva($ligne->getMnttva());
                $ex->setNordre($ligne->getNordre());
                $ex->setCodearticle($ligne->getCodearticle());
                $ex->setDesignationarticle($ligne->getDesignationarticle());
                $ex->setIdTva($ligne->getIdTva());
                $ex->save();
// verifier qte
                $qte = new Qtelignedoc();
                $qte_verif = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($ex->getId());
                $qte_ligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($ligne->getId());
                if ($qte_verif)
                    $qte = $qte_verif;
                $qte->setQtelivrefrs($qte_ligne->getQtelivrefrs());
                $qte->setIdLignedocachat($ex->getId());
                $qte->save();
            }

            /* save facture comptable achat */
            $dossier = DossiercomptableTable::getInstance()->findAll()->getFirst();
            $fournissuer = FournisseurTable::getInstance()->findOneById($bon->getIdFrs());
            $year = date('Y', strtotime($bon->getLignemouvementfacturation()->getFirst()->getDate()));
            $exercie = ExerciceTable::getInstance()->findByLibelle($year);
            if ($bce->getIdTypedoc() == 18 || $bce->getIdTypedoc() == 2 || $bce->getIdTypedoc() == 7) {
                $facture_achat = new Facturecomptableachat();
                if ($bon->getMht())
                    $facture_achat->setTotalht($bon->getMht());
                if ($bon->getReference())
                    $facture_achat->setReference($bon->getReference());
                if ($bon->getMnttva())
                    $facture_achat->setTotaltva($bon->getMnttva());
                if ($bon->getMntttc())
                    $facture_achat->setTotalttc($bon->getMntttc());
                if ($bon->getLignemouvementfacturation()->getFirst()->getDate())
                    $facture_achat->setDate($bon->getLignemouvementfacturation()->getFirst()->getDate());
                if ($bon->getDatecreation())
                    $facture_achat->setDate($bon->getLignemouvementfacturation()->getFirst()->getDate());
                $facture_achat->setDateimportation($bon->getLignemouvementfacturation()->getFirst()->getDate());
                $facture_achat->setSaisie(0);
                $facture_achat->setIdFacture($jeton->getId());
                if ($bon->getIdFrs())
                    $facture_achat->setIdFournisseur($bon->getIdFrs());
                $facture_achat->setIdDossier($dossier->getId());
                $id_plan = $fournissuer->getIdPlancomptable();
                if ($id_plan != null)
                    $plandossier = PlandossiercomptableTable::getInstance()->findOneByIdPlanAndIdExerciceAndIdDossier($id_plan, $exercie->getFirst()->getId(), $dossier->getId());
//              die($plandossier->getId().'mp');
//              $facture_achat->setIdComptecomptable($plandossier->getId());

                $facture_achat->save();
//            die($facture_achat->getId() . 'pm');
            }
        }

        $this->Redirect('Documents/detail?id=' . $idparent);
    }

    public function ExporterBCIcontrat($id, $idtypefacture, $idparent) {
        $bon = new Documentachat();
        $bci_contrat = Doctrine_Core::getTable('documentachat')->findOneById($id);

//      die($id_ligne.'mp');
        if ($bci_contrat) {
            $bon = $bci_contrat;
            $jeton = new Documentachat();
            $j = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($id, $idtypefacture);
            if ($j)
                $jeton = $j;
            if ($idtypefacture == 16)
                $jeton->setNumero($bon->getNumero());
            else
                $jeton->setNumero($jeton->NumeroSeqDocumentAchat(15));
            $jeton->setDatecreation(date('Y-m-d'));
            $jeton->setIdDocparent($id);
            $jeton->setIdTypedoc($idtypefacture);
            if ($bon->getMht())
                $jeton->setMht($bon->getMht());
            if ($bon->getReference())
                $jeton->setReference($bon->getReference());
            if ($bon->getMnttva())
                $jeton->setMnttva($bon->getMnttva());
            if ($bon->getMntfodec())
                $jeton->setMntfodec($bon->getMntfodec());
            if ($bon->getMntttc())
                $jeton->setMntttc($bon->getMntttc());
            $jeton->setIdFrs($bon->getIdFrs());
            $jeton->setIdUser($this->getUser()->getAttribute('userB2m'));
            $jeton->setDatesignature($bon->getDatesignature());
            $jeton->save();
            $piece = new Piecejointbudget();
            $p = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($jeton->getId());

            $doc_achat_contrat = DocumentachatTable::getInstance()->findOneByIdContratAndIdTypedoc($bci_contrat->getIdContrat(), 20);
//            die($doc_achat_contrat.'ss');
            $p_parent = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($doc_achat_contrat->getId());
            if ($p)
                $piece = $p;
            $piece->setIdDocachat($jeton->getIdDocparent());
            $piece->setIdType(7);
            /*             * ********doc budget********* */
            if ($p_parent->getReference())
                $piece->setReference($p_parent->getReference());
            if ($p_parent->getIdDocumentbudget())
                $piece->setIdDocumentbudget($p_parent->getIdDocumentbudget());

            $piece->save();

            /*             * ** */
            $piece = new Piecejointbudget();
            $piece->setIdDocachat($jeton->getId());
            $piece->setIdType(7);
            /*             * ********doc budget********* */
            if ($p_parent->getReference())
                $piece->setReference($p_parent->getReference());
            if ($p_parent->getIdDocumentbudget())
                $piece->setIdDocumentbudget($p_parent->getIdDocumentbudget());

            $piece->save();
//ligne doc
            $ligne = new Lignedocachat();
            foreach ($bon->getLignedocachat() as $l) {
                $ligne = $l;
                $ex = new Lignedocachat();
                $ex_test = Doctrine_Core::getTable('lignedocachat')->findOneByIdDocAndIdArticlestock($jeton->getId(), $ligne->getIdArticlestock());
                if ($ex_test)
                    $ex = $ex_test;
                $ex->setIdArticlestock($ligne->getIdArticlestock());
                $ex->setIdDoc($jeton->getId());
                $ex->setMntht($ligne->getMntht());
                $ex->setMntttc($ligne->getMntttc());
                $ex->setMnttva($ligne->getMnttva());
                $ex->setNordre($ligne->getNordre());
                $ex->setCodearticle($ligne->getCodearticle());
                $ex->setDesignationarticle($ligne->getDesignationarticle());
                $ex->setIdTva($ligne->getIdTva());
                $ex->save();
// verifier qte
                $qte = new Qtelignedoc();
                $qte_verif = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($ex->getId());
                $qte_ligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($ligne->getId());
                if ($qte_verif)
                    $qte = $qte_verif;
                $qte->setQtelivrefrs($qte_ligne->getQtelivrefrs());
                $qte->setIdLignedocachat($ex->getId());
                $qte->save();
            }

            /* save facture comptable achat */
            $dossier = DossiercomptableTable::getInstance()->findAll()->getFirst();
            $fournissuer = FournisseurTable::getInstance()->findOneById($bon->getIdFrs());
            $year = date('Y', strtotime($bon->getLignemouvementfacturation()->getFirst()->getDate()));
            $exercie = ExerciceTable::getInstance()->findByLibelle($year);
            if ($bci_contrat->getIdTypedoc() == 6) {
                $facture_achat = new Facturecomptableachat();
                if ($bon->getMht())
                    $facture_achat->setTotalht($bon->getMht());
                if ($bon->getReference())
                    $facture_achat->setReference($bon->getReference());
                if ($bon->getMnttva())
                    $facture_achat->setTotaltva($bon->getMnttva());
                if ($bon->getMntttc())
                    $facture_achat->setTotalttc($bon->getMntttc());
                if ($bon->getLignemouvementfacturation()->getFirst()->getDate())
                    $facture_achat->setDate($bon->getLignemouvementfacturation()->getFirst()->getDate());
                if ($bon->getDatecreation())
                    $facture_achat->setDate($bon->getLignemouvementfacturation()->getFirst()->getDate());
                $facture_achat->setDateimportation($bon->getLignemouvementfacturation()->getFirst()->getDate());
                $facture_achat->setSaisie(0);
                $facture_achat->setIdFacture($jeton->getId());
                if ($bon->getIdFrs())
                    $facture_achat->setIdFournisseur($bon->getIdFrs());
                $facture_achat->setIdDossier($dossier->getId());
                $id_plan = $fournissuer->getIdPlancomptable();
                if ($id_plan != null)
                    $plandossier = PlandossiercomptableTable::getInstance()->findOneByIdPlanAndIdExerciceAndIdDossier($id_plan, $exercie->getFirst()->getId(), $dossier->getId());
//              die($plandossier->getId().'mp');
//              $facture_achat->setIdComptecomptable($plandossier->getId());

                $facture_achat->save();
//            die($facture_achat->getId() . 'pm');
            }
        }

        $this->Redirect('Documents/detail?id=' . $idparent);
    }

    public function ExporterBCexterne($id, $idtypefacture, $idparent) {
        $bon = new Documentachat();
        $bce = Doctrine_Core::getTable('documentachat')->findOneById($id);
        if ($bce) {
            $bon = $bce;
            $jeton = new Documentachat();
            $j = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($id, $idtypefacture);
            if ($j)
                $jeton = $j;
            if ($idtypefacture == 16)
                $jeton->setNumero($bon->getNumero());
            else
                $jeton->setNumero($jeton->NumeroSeqDocumentAchat(15));
            $jeton->setDatecreation(date('Y-m-d'));
            $jeton->setIdDocparent($id);
            $jeton->setIdTypedoc($idtypefacture);
            if ($bon->getMht())
                $jeton->setMht($bon->getMht());
            if ($bon->getReference())
                $jeton->setReference($bon->getReference());
            if ($bon->getMnttva())
                $jeton->setMnttva($bon->getMnttva());
            if ($bon->getMntttc())
                $jeton->setMntttc($bon->getMntttc());
//             if ($bon->getDroittimbre())
//                $jeton->setDroittimbre($bon->getDroittimbre());
            $jeton->setIdFrs($bon->getIdFrs());
            $jeton->setIdUser($this->getUser()->getAttribute('userB2m'));
            $jeton->setDatesignature($bon->getDatesignature());
            $jeton->save();
            // $piece = new Piecejointbudget();
//            $p = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($jeton->getId());
//            $p_parent = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($id);
////            die($id.'mpp');
//            if ($p)
//                $piece = $p;
//            $piece->setIdDocachat($jeton->getId());
//            if ($p_parent->getIdType())
//                $piece->setIdType($p_parent->getIdType());
//            $piece->setReference($p_parent->getReference());
//            $piece->setIdDocumentbudget($p_parent->getIdDocumentbudget());
//            $piece->save();
//ligne doc
            $ligne = new Lignedocachat();
            foreach ($bon->getLignedocachat() as $l) {
                $ligne = $l;
                $ex = new Lignedocachat();
                $ex_test = Doctrine_Core::getTable('lignedocachat')->findOneByIdDocAndIdArticlestock($jeton->getId(), $ligne->getIdArticlestock());
                if ($ex_test)
                    $ex = $ex_test;
                $ex->setIdArticlestock($ligne->getIdArticlestock());
                $ex->setIdDoc($jeton->getId());
                $ex->setMntht($ligne->getMntht());
                $ex->setMntttc($ligne->getMntttc());
                $ex->setMnttva($ligne->getMnttva());
                $ex->setNordre($ligne->getNordre());
                $ex->setCodearticle($ligne->getCodearticle());
                $ex->setDesignationarticle($ligne->getDesignationarticle());
                $ex->setIdTva($ligne->getIdTva());
                $ex->save();
// verifier qte
                $qte = new Qtelignedoc();
                $qte_verif = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($ex->getId());
                $qte_ligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($ligne->getId());
                if ($qte_verif)
                    $qte = $qte_verif;
                $qte->setQtelivrefrs($qte_ligne->getQtelivrefrs());
                $qte->setIdLignedocachat($ex->getId());
                $qte->save();
            }

            /* save facture comptable achat */
            $dossier = DossiercomptableTable::getInstance()->findAll()->getFirst();
            $fournissuer = FournisseurTable::getInstance()->findOneById($bon->getIdFrs());
            if ($bon->getLignemouvementfacturation()->getFirst())
                $year = date('Y', strtotime($bon->getLignemouvementfacturation()->getFirst()->getDate()));
            else
                $year = date('Y');
            $exercie = ExerciceTable::getInstance()->findByLibelle($year);
            if ($bce->getIdTypedoc() == 18 || $bce->getIdTypedoc() == 2 || $bce->getIdTypedoc() == 7) {
                $facture_achat = new Facturecomptableachat();
                if ($bon->getMht())
                    $facture_achat->setTotalht($bon->getMht());
                if ($bon->getReference())
                    $facture_achat->setReference($bon->getReference());
                if ($bon->getMnttva())
                    $facture_achat->setTotaltva($bon->getMnttva());
                if ($bon->getMntttc())
                    $facture_achat->setTotalttc($bon->getMntttc());
                if ($bon->getLignemouvementfacturation()->getFirst()->getDate())
                    $facture_achat->setDate($bon->getLignemouvementfacturation()->getFirst()->getDate());
                if ($bon->getDatecreation())
                    $facture_achat->setDate($bon->getLignemouvementfacturation()->getFirst()->getDate());
                $facture_achat->setDateimportation($bon->getLignemouvementfacturation()->getFirst()->getDate());
                $facture_achat->setSaisie(0);
                $facture_achat->setIdFacture($jeton->getId());
                if ($bon->getIdFrs())
                    $facture_achat->setIdFournisseur($bon->getIdFrs());
                $facture_achat->setIdDossier($dossier->getId());
                $id_plan = $fournissuer->getIdPlancomptable();
                if ($id_plan != null)
                    $plandossier = PlandossiercomptableTable::getInstance()->findOneByIdPlanAndIdExerciceAndIdDossier($id_plan, $exercie->getFirst()->getId(), $dossier->getId());
//              die($plandossier->getId().'mp');
//              $facture_achat->setIdComptecomptable($plandossier->getId());

                $facture_achat->save();
//            die($facture_achat->getId() . 'pm');
            }
        }

        $this->Redirect('Documents/detail?id=' . $idparent);
    }

    public function ExporterBCInterne($id, $idtypefacture, $idparent) {
        $bon = new Documentachat();
        $bce = Doctrine_Core::getTable('documentachat')->findOneById($id);
        if ($bce) {
            $bon = $bce;
            $jeton = new Documentachat();
            $j = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($id, $idtypefacture);
            if ($j)
                $jeton = $j;
            if ($idtypefacture == 16)
                $jeton->setNumero($bon->getNumero());
            else
                $jeton->setNumero($jeton->NumeroSeqDocumentAchat(15));
            $jeton->setDatecreation(date('Y-m-d'));
            $jeton->setIdDocparent($id);
            $jeton->setIdTypedoc($idtypefacture);
            if ($bon->getMht())
                $jeton->setMht($bon->getMht());
            if ($bon->getReference())
                $jeton->setReference($bon->getReference());
            if ($bon->getMnttva())
                $jeton->setMnttva($bon->getMnttva());
            if ($bon->getMntttc())
                $jeton->setMntttc($bon->getMntttc());
            $jeton->setIdFrs($bon->getIdFrs());
            $jeton->setIdUser($this->getUser()->getAttribute('userB2m'));
            $jeton->setDatesignature($bon->getDatesignature());
            $jeton->setIdContrat($bon->getIdContrat());
            $jeton->setValide(true);
            $jeton->save();
            $piece = new Piecejointbudget();

//            $contrat_achat = $bce->getContratachat()->getIdDocparent();
//            $contra_achat_fils = ContratachatTable::getInstance()->findOneById($contrat_achat);
//            $id_docparent = $contra_achat_fils->getIdDoc();
//                $doc_parent = DocumentachatTable::getInstance()->findByIdTypedocAndIdContrat(20, $id_contrat);
            $documentachatcontrat = DocumentachatTable::getInstance()->find($bce->getIdDocparent());

            $p = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($documentachatcontrat->getId());
//            die($bce->getIdDocparent() . 'fr' . $documentachatcontrat->getId());
//             $p_parent = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($id);
            if ($p)
                $piece = $p;
            $piece->setIdDocachat($jeton->getId());
            $piece->setIdType($p->getIdType());
            $piece->setReference($p->getReference());
            $piece->setIdDocumentbudget($p->getIdDocumentbudget());
            $piece->save();
//ligne doc
            $ligne = new Lignedocachat();
            foreach ($bon->getLignedocachat() as $l) {
                $ligne = $l;
                $ex = new Lignedocachat();
                $ex_test = Doctrine_Core::getTable('lignedocachat')->findOneByIdDocAndIdArticlestock($jeton->getId(), $ligne->getIdArticlestock());
                if ($ex_test)
                    $ex = $ex_test;
                $ex->setIdArticlestock($ligne->getIdArticlestock());
                $ex->setIdDoc($jeton->getId());
                $ex->setMntht($ligne->getMntht());
                $ex->setMntttc($ligne->getMntttc());
                $ex->setMnttva($ligne->getMnttva());
                $ex->setNordre($ligne->getNordre());
                $ex->setCodearticle($ligne->getCodearticle());
                $ex->setDesignationarticle($ligne->getDesignationarticle());
                $ex->setIdTva($ligne->getIdTva());
                $ex->save();
// verifier qte
                $qte = new Qtelignedoc();
                $qte_verif = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($ex->getId());
                $qte_ligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($ligne->getId());
                if ($qte_verif)
                    $qte = $qte_verif;
                $qte->setQtelivrefrs($qte_ligne->getQtelivrefrs());
                $qte->setIdLignedocachat($ex->getId());
                $qte->save();
            }

            /* save facture comptable achat */
            $dossier = DossiercomptableTable::getInstance()->findAll()->getFirst();
            $fournissuer = FournisseurTable::getInstance()->findOneById($bon->getIdFrs());
            $year = date('Y', strtotime($bon->getLignemouvementfacturation()->getFirst()->getDate()));
            $exercie = ExerciceTable::getInstance()->findByLibelle($year);
            $facture_achat = new Facturecomptableachat();
            if ($bon->getMht())
                $facture_achat->setTotalht($bon->getMht());
            if ($bon->getReference())
                $facture_achat->setReference($bon->getReference());
            if ($bon->getMnttva())
                $facture_achat->setTotaltva($bon->getMnttva());
            if ($bon->getMntttc())
                $facture_achat->setTotalttc($bon->getMntttc());
            if ($bon->getLignemouvementfacturation()->getFirst()->getDate())
                $facture_achat->setDate($bon->getLignemouvementfacturation()->getFirst()->getDate());
            if ($bon->getDatecreation())
                $facture_achat->setDate($bon->getLignemouvementfacturation()->getFirst()->getDate());
            $facture_achat->setDateimportation($bon->getLignemouvementfacturation()->getFirst()->getDate());
            $facture_achat->setSaisie(0);
            $facture_achat->setIdFacture($jeton->getId());
            if ($bon->getIdFrs())
                $facture_achat->setIdFournisseur($bon->getIdFrs());
            $facture_achat->setIdDossier($dossier->getId());
            $id_plan = $fournissuer->getIdPlancomptable();
            if ($id_plan != null)
                $plandossier = PlandossiercomptableTable::getInstance()->findOneByIdPlanAndIdExerciceAndIdDossier($id_plan, $exercie->getFirst()->getId(), $dossier->getId());
//              die($plandossier->getId().'mp');
//              $facture_achat->setIdComptecomptable($plandossier->getId());

            $facture_achat->save();
//            die($facture_achat->getId() . 'pm');
        }

        $this->Redirect('Documents/detailBCI?id=' . $idparent);
    }

    public function ExporterContrat($id, $idtypefacture, $idparent, $id_mvt) {
        $bon = new Documentachat();
        $bcontrat = Doctrine_Core::getTable('documentachat')->findOneById($id);
        $mvt = Doctrine_Core::getTable('lignemouvementfacturation')->findOneById($id_mvt);
        if ($bcontrat) {
            $bon = $bcontrat;
            $jeton = new Documentachat();
            $j = Doctrine_Core::getTable('documentachat')->findOneByIdAndIdTypedoc($id, $idtypefacture);
            if ($j)
                $jeton = $j;
            if ($idtypefacture == 16)
                $jeton->setNumero($bon->getNumero());
            else
                $jeton->setNumero($jeton->NumeroSeqDocumentAchat(15));
            $jeton->setDatecreation(date('Y-m-d'));
            $jeton->setIdDocparent($id);
            $jeton->setIdTypedoc($idtypefacture);
            if ($mvt->getMontant())
                $jeton->setMht($mvt->getMontant());
            if ($bon->getReference())
                $jeton->setReference($bon->getReference());
//            if ($bon->getMnttva())
//                $jeton->setMnttva($bon->getMnttva());
            if ($mvt->getMontant())
                $jeton->setMntttc($mvt->getMontant());
            $jeton->setIdFrs($bon->getContratachat()->getIdFrs());
            $jeton->setIdUser($this->getUser()->getAttribute('userB2m')->getId());
            $jeton->setDatesignature($bon->getContratachat()->getDatesigntaure());

            $jeton->setIdContrat($bon->getContratachat()->getId());
            $jeton->setIdEtatdoc(29);
            $jeton->setIdLignemouvementfacturation($mvt->getId());
            $jeton->save();
            $piece = new Piecejointbudget();
            $p = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($jeton->getId());
            $p_parent = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($id);
            if ($p)
                $piece = $p;
            $piece->setIdDocachat($jeton->getId());
            $piece->setIdType($p_parent->getIdType());
            $piece->setReference($p_parent->getReference());
            $piece->setIdDocumentbudget($p_parent->getIdDocumentbudget());
            $piece->save();
//ligne doc
            $ligne = new Lignedocachat();
            foreach ($bon->getContratachat()->getLignecontrat() as $l) {
                $ligne = $l;
                $ex = new Lignedocachat();
                $ex_test = Doctrine_Core::getTable('lignedocachat')->findOneByIdDocAndIdArticlestock($jeton->getId(), $ligne->getIdArticlestock());
                if ($ex_test)
                    $ex = $ex_test;
                $ex->setIdArticlestock($ligne->getIdArticlestock());
                $ex->setIdDoc($jeton->getId());
                $ex->setMntht($ligne->getMntht());
                $ex->setMntttc($ligne->getMntttc());
                $ex->setMnttva($ligne->getMnttva());
                $ex->setNordre($ligne->getNordre());
                $ex->setCodearticle($ligne->getCodearticle());
                $ex->setDesignationarticle($ligne->getDesignationartcile());
                $ex->setIdTva($ligne->getIdTva());
                $ex->save();
// verifier qte
            }
            foreach ($bon->getLignedocachat() as $l) {
                $qte = new Qtelignedoc();
                $qte_verif = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($ex->getId());
                $qte_ligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($l->getId());
                if ($qte_verif)
                    $qte = $qte_verif;
                $qte->setQtelivrefrs($qte_ligne->getQtelivrefrs());
                $qte->setIdLignedocachat($ex->getId());
                $qte->save();
            }
            /* save facture comptable achat */
            $dossier = DossiercomptableTable::getInstance()->findAll()->getFirst();
            $fournissuer = FournisseurTable::getInstance()->findOneById($bon->getIdFrs());
            $year = date('Y', strtotime($bon->getLignemouvementfacturation()->getFirst()->getDate()));
            $exercie = ExerciceTable::getInstance()->findByLibelle($year);
            $facture_achat = new Facturecomptableachat();
//            if ($bon->getMht())
//                $facture_achat->setTotalht($bon->getMht());
            if ($mvt->getMontant())
                $facture_achat->setTotalht($mvt->getMontant());
            if ($bon->getReference())
                $facture_achat->setReference($bon->getReference());
//            if ($bon->getMnttva())
//                $facture_achat->setTotaltva($bon->getMnttva());
            if ($bon->getMntttc())
                $facture_achat->setTotalttc($mvt->getMontant());
            if ($bon->getLignemouvementfacturation()->getFirst()->getDate())
                $facture_achat->setDate($bon->getLignemouvementfacturation()->getFirst()->getDate());
            if ($bon->getDatecreation())
                $facture_achat->setDate(date('Y-m-d'));
            $facture_achat->setDateimportation($bon->getLignemouvementfacturation()->getFirst()->getDate());
            $facture_achat->setSaisie(0);
            $facture_achat->setIdFacture($jeton->getId());
            if ($bon->getIdFrs())
                $facture_achat->setIdFournisseur($bon->getIdFrs());
            $facture_achat->setIdDossier($dossier->getId());
            $id_plan = $fournissuer->getIdPlancomptable();
            if ($id_plan != null)
                $plandossier = PlandossiercomptableTable::getInstance()->findOneByIdPlanAndIdExerciceAndIdDossier($id_plan, $exercie->getFirst()->getId(), $dossier->getId());
//              die($plandossier->getId().'mp');
//              $facture_achat->setIdComptecomptable($plandossier->getId());

            $facture_achat->save();
//            die($facture_achat->getId() . 'pm');
        }

        $this->Redirect('Documents/detail?id=' . $idparent);
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
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $demandedeprix = new Documentachat();
            $dem = Doctrine_Core::getTable('documentachat')->findOneById($id);
            $demandedeprix = $dem;

            die($demandedeprix->getHtmlDemandedeprix());
        }
//die($q);
    }

    public function executeImprimerdocentre(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $aviss = Doctrine_Core::getTable('avis')
                        ->createQuery('a')->where('id_poste=5')
                        ->orderBy('id asc')->execute();
        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

        $listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);

        // pdf object
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche BCI N°:');
        $pdf->SetSubject("document d'achat");
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
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(10, 30, 10);
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
//die($documentachat->getIdTypedoc().'gg');
//die($html);
        if ($documentachat->getIdTypedoc() == 10)
            $html = $this->ReadHtmlBonEntrer($societe, $documentachat, $listesdocuments);
        if ($documentachat->getIdTypedoc() == 11)
            $html = $this->ReadHtmlBonSortie($societe, $documentachat, $listesdocuments);
        if ($documentachat->getIdTypedoc() == 13)
            $html = $this->ReadHtmlBonTransfert($societe, $documentachat, $listesdocuments);
        if ($documentachat->getIdTypedoc() == 12)
            $html = $this->ReadHtmlBonRetour($societe, $documentachat, $listesdocuments);
        if ($documentachat->getIdTypedoc() == 14)
            $html = $this->ReadHtmlAvoir($societe, $documentachat, $listesdocuments);
        if ($documentachat->getIdTypedoc() == 15)
            $html = $this->ReadHtmlFacture($societe, $documentachat, $listesdocuments);


        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');


        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('documentachat' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBonEntrer($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlBonEntree();
        //die($html);
        return $html;
    }

    public function ReadHtmlFacture($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlFactureImression($documentachat->getId());
        //die($html);
        return $html;
    }

    public function ReadHtmlAvoir($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlAvoir();
        //die($html);
        return $html;
    }

    public function ReadHtmlBonSortie($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlBonSortie();
        //die($html);
        return $html;
    }

    public function ReadHtmlBonTransfert($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlBonTransfert();
        //die($html);
        return $html;
    }

    public function ReadHtmlBonRetour($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html.=$documentachat->ReadHtmlBonRetour();
        //die($html);
        return $html;
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
        $doc = new Documentachat();
        $html.=$documentachat->ReadHtmlBondeponse();
        //die($html);
        return $html;
    }

    public function executeImprimerFacture(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

        $listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche N°:' . $documentachat->getNumero());
        $pdf->SetSubject("Facture");
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


        $html = $this->ReadHtmlFactureBDCREG($societe, $documentachat, $listesdocuments);
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

    public function ReadHtmlFactureBDCREG($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $doc = new Documentachat();
        $html.=$documentachat->ReadHtmlFactureImressionDuBDCR();
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
        //$pdf->setFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($foter), strtoupper($adr), '', '');
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

    public function executeImprimerBCEDefinitf(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');
        $pdf = new sfTCPDF('');
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche B.C.E Définitf');
        $pdf->SetSubject("Fiche B.C.E Définitf");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $logo = $soc->getLogo();
        $adresse = 'Téléphone:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail()
                . '<br>Adresse:' . $soc->getAdresse() . '';
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);

         $pdf->SetHeaderData($logo,PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');
        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //$pdf->setFooterData(array(0,64,0), array(0,64,128));
        $pdf->CustomFooter($adresse, '');
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 12, '', true);
        $pdf->AddPage();

        $html = $this->ReadHtmlBCEDefinitif($iddoc);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Fiche B.C.E Définitf.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBCEDefinitif($iddoc) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBCEDefinitif($iddoc);
        return $html;
    }

    public function executeImprimerBCEDefinitfContrat(sfWebRequest $request) {
        $id = $request->getParameter('iddoc');
        $iddoc = DocumentachatTable::getInstance()->find($id)->getIdContrat();

        $pdf = new sfTCPDF('');
// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche Contrat Défifnitf ');
        $pdf->SetSubject("Fiche Contrat Défifnitf ");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $logo = $soc->getLogo();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail()
                . '<br>Adresse:' . $soc->getAdresse() . '';
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);

        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//$pdf->setFooterData(array(0,64,0), array(0,64,128));
        $pdf->CustomFooter($adresse, '');
// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 12, '', true);
        $pdf->AddPage();

        $html = $this->ReadHtmlContratdefinitif($iddoc);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Fiche Contrat Défifnitf .pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlContratdefinitif($iddoc) {
        $html = StyleCssHeader::header1();
        $piece = new Contratachat();
        $html .= $piece->ReadHtmlcontratdefintif($iddoc);
        return $html;
    }

    public function executeImprimerlistedocument(sfWebRequest $request) {
//        die('hh');
//        if($request->getParameter('arraycourrier'))
//            die($request->getParameter('arraycourrier'));
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $pdf = new sfTCPDF();

        $pdf->SetTitle('Listes des bons Commnade interne ');
        $pdf->SetSubject("Listes des bons Commnade interne");

        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($societe), PDF_HEADER_STRING);
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
        //die('test=' . $request->getParameter('idtype'));

        $html = $this->ReadHtmlListesDocument($request);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('ListesBCI' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListesDocument(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $datedebut = "";
        $datefin = "";
        $etatdoc = "";

        $typedoc = Doctrine_Core::getTable('typedoc')->findOneById($_REQUEST['idtype']);
        if ($_REQUEST['idtype'] == 6)
            $typedoc = $typedoc . ' Du Contrat Partiel';
        $documentsachat = Doctrine_Core::getTable('documentachat')
                        ->createQuery('a')->where('id_typedoc=' . $_REQUEST['idtype'])
        ;
        if ($_REQUEST['idtype'] == 6) {
            $documentsachat = $documentsachat->andWhere('id_contrat is not null');
        }
        if (isset($_REQUEST['De']) && isset($_REQUEST['à']) && $_REQUEST['De'] != "1970-01-01" && $_REQUEST['à'] != "1970-01-01") {
//            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $_REQUEST['De'] . "'");
//            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $_REQUEST['à'] . "'");
            $datedebut = $_REQUEST['De'];
            $datefin = $_REQUEST['à'];
        }
        if (isset($_REQUEST['De']) && !isset($_REQUEST['à']) && $_REQUEST['De'] != "1970-01-01") {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $_REQUEST['De'] . "'");
            $datedebut = $_REQUEST['De'];
        }
        if (!isset($_REQUEST['De']) && isset($_REQUEST['à']) && $_REQUEST['à'] != "1970-01-01") {

            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $_REQUEST['à'] . "'");

            $datefin = $_REQUEST['à'];
        }
        if (!isset($_REQUEST['De']) && !isset($_REQUEST['à']) && ( $_REQUEST['De'] = "1970-01-01" || $_REQUEST['à'] = "1970-01-01")) {
            $documentsachat = $documentsachat->AndWhere("datecreation>='" . date('Y') . "-01-01" . "'");
            $documentsachat = $documentsachat->AndWhere("datecreation<='" . date('Y') . "-12-31" . "'");
        }

        if (isset($_REQUEST['id_etatdoc']) && $_REQUEST['id_etatdoc'] != "") {
            $documentsachat = $documentsachat->Andwhere('id_etatdoc=' . $_REQUEST['id_etatdoc']);
            $etatdoc = Doctrine_Core::getTable('etatdocument')->findOneById($_REQUEST['id_etatdoc']);
        }

        $html.='<div class="titre"><h3 style="font-size:22px;">' . $typedoc . '</h3></div>&nbsp;<br>
                <div> 
                    <table style="width:100%;" class="tablecontenue">';
        if ($datedebut || $datefin) {
            $html.='      <tr>
                            <td style="width:10%">Date</td>
                            <td style="width:90%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $datedebut . ' ==>' . $datefin . '</p></td>
        </tr>';
        }
//                        <tr>
//                            <td style="width:10%">Etat</td>
//                            <td style="width:90%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $etatdoc . '</p></td>
//                        </tr>
        $html.='  </table>
                </div>';

        $html.='<div class="tableligne">
                    <table style="font-size:11px;" cellpadding="3">
                        <tr style="background-color:#EDEDED">
                            <th style="width: 15%; height:25px;">Numéro</th>
                            <th style="width: 15%; height:25px;">Date</th>
                            <th style="width: 20%">Référence</th>
                            <th style="width: 30%">Etat</th>   
                            <th style="width: 20%">Mnt TTC</th>
                        </tr>';

        $documentsachat = $documentsachat->OrderBy('id Asc')->execute();
        $doc = new Documentachat();
        if (sizeof($documentsachat) > 0):
            foreach ($documentsachat as $docach) {
                $doc = $docach;
                $avisss = "";
                $aviss = Doctrine_Core::getTable('ligavisdoc')->findOneByIdDoc($doc->getId());
                if ($aviss)
                    $avisss = $aviss->getAvis();
                $etat = "";
                if ($doc->getIdEtatdoc()) {
                    $etatdoc = Doctrine_Core::getTable('etatdocument')->findOneById($doc->getIdEtatdoc());
                    if ($etatdoc)
                        $etat = $etatdoc;
                }
                $html.='<tr>
                        <td><p>' . $doc->getNumerodocachat() . '</p></td>'
                        . '<td><p>' . date('d/m/Y', strtotime($doc->getDatecreation())) . '</p></td>';
                if ($doc->getDocumentparent())
                    $html.='<td><p>' . $doc->getDocumentparent() . '<br>' . $doc->getDocumentparent()->getTiersPrint() . '</p></td>';
                else {
                    $html.='<td></td>';
                }

                $html.='<td><p>' . $etat . '</p></td>
                    <td style="text-align:right;">' . number_format($doc->getMntttc(), 3, ',', '.') . '</td>
                </tr>';
            }
        else:
            $html.='<tr><td colspan="5"> Liste des Document est vide</td></tr>';
        endif;
        $html.='</table></div>';

        return $html;
    }

    public function executeImprimerlistepvreception(sfWebRequest $request) {
//        if($request->getParameter('arraycourrier'))
//            die($request->getParameter('arraycourrier'));
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $pdf = new sfTCPDF();

        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($societe), PDF_HEADER_STRING);
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(7, 30, 7);
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
        //die('test=' . $request->getParameter('idtype'));

        $html = $this->ReadHtmlListesDocumentRec($request);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('ListesPv' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListesDocumentRec(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $datedebut = "";
        $datefin = "";
        $etatdoc = "";

        $typedoc = Doctrine_Core::getTable('typedoc')->findOneById($_REQUEST['idtype']);

        $documentsachat = Doctrine_Core::getTable('documentachat')
                        ->createQuery('a')->where('id_typedoc=' . $_REQUEST['idtype']);
        if (isset($_REQUEST['De']) && isset($_REQUEST['à']) && $_REQUEST['De'] != "1970-01-01" && $_REQUEST['à'] != "1970-01-01") {
//            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $_REQUEST['De'] . "'");
//            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $_REQUEST['à'] . "'");
            $datedebut = $_REQUEST['De'];
            $datefin = $_REQUEST['à'];
        }
        if (isset($_REQUEST['De']) && !isset($_REQUEST['à']) && $_REQUEST['De'] != "1970-01-01") {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $_REQUEST['De'] . "'");
            $datedebut = $_REQUEST['De'];
        }
        if (!isset($_REQUEST['De']) && isset($_REQUEST['à']) && $_REQUEST['à'] != "1970-01-01") {

            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $_REQUEST['à'] . "'");

            $datefin = $_REQUEST['à'];
        }

        if (isset($_REQUEST['id_etatdoc']) && $_REQUEST['id_etatdoc'] != "") {
            $documentsachat = $documentsachat->Andwhere('id_etatdoc=' . $_REQUEST['id_etatdoc']);
            $etatdoc = Doctrine_Core::getTable('etatdocument')->findOneById($_REQUEST['id_etatdoc']);
        }

        $html.='<div class="titre"><h3 style="font-size:22px;">' . $typedoc . '</h3></div>&nbsp;<br>
                <div> 
                    <table style="width:100%;" class="tablecontenue">
                        <tr>
                            <td style="width:10%">Date</td>
                            <td style="width:90%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $datedebut . ' ==>' . $datefin . '</p></td>
                        </tr>
                        <tr>
                            <td style="width:10%">Etat</td>
                            <td style="width:90%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $etatdoc . '</p></td>
                        </tr>
                    </table>
                </div>';

        $html.='<div class="tableligne">
                    <table style="font-size:11px;" cellpadding="3">
                        <tr style="background-color:#EDEDED">
                            <th style="width: 15%; height:25px;">Numéro</th>
                            <th style="width: 15%; height:25px;">Date</th>
                            <th style="width: 20%">Référence</th>
                            <th style="width: 30%">Etat</th>   
                            <th style="width: 20%">Mnt TTC</th>
                        </tr>';

        $documentsachat = $documentsachat->OrderBy('id Asc')->execute();
        $doc = new Documentachat();
        foreach ($documentsachat as $docach) {
            $doc = $docach;
            $avisss = "";
            $aviss = Doctrine_Core::getTable('ligavisdoc')->findOneByIdDoc($doc->getId());
            if ($aviss)
                $avisss = $aviss->getAvis();
            $etat = "";
            if ($doc->getIdEtatdoc()) {
                $etatdoc = Doctrine_Core::getTable('etatdocument')->findOneById($doc->getIdEtatdoc());
                if ($etatdoc)
                    $etat = $etatdoc;
            }
            $html.='<tr>
                        <td><p>' . $doc->getNumerodocachat() . '</p></td>'
                    . '<td><p>' . date('d/m/Y', strtotime($doc->getDatecreation())) . '</p></td>';
            if ($doc->getDocumentparent())
                $html.='<td><p>' . $doc->getDocumentparent() . '<br>' . $doc->getDocumentparent()->getTiersPrint() . '</p></td>';
            else {
                $html.='<td></td>';
            }

            $html.='<td><p>' . $etat . '</p></td>
                    <td style="text-align:right;">' . number_format($doc->getMntttc(), 3, ',', '.') . '</td>
                </tr>';
        }
        $html.='</table></div>';

        return $html;
    }

    public function executeDetaillignemouvementAchat(sfWebRequest $request) {
        $doc = new Documentachat();
        $id = $request->getParameter('id');
        $this->id = $id;
        $ligne = Doctrine_Core::getTable('lignemouvementfacturation')->find(array($request->getParameter('id')));
        $this->documentachat = $ligne->getDocumentachat();
        $this->forward404Unless($this->documentachat);
        $idbce = $this->documentachat->getId();
        $doc_achat = $this->documentachat;
        $doc_achat->setIdEtatdoc(29);
//        $doc_achat->setMntttc($ligne->getMontant());
//        $doc_achat->setIdFrs($ligne->getIdFournisseur());
        $doc_achat->save();

        if ($request->getParameter('exporterjeton'))
            $this->ExporterBCexterne($request->getParameter('exporterjeton'), 16, $request->getParameter('exporterjeton'));
        if ($request->getParameter('exporterfacture')) {
            $verif_jeton = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($request->getParameter('exporterfacture'), 16);
            if ($verif_jeton) {
                $this->ExporterBCexterne($verif_jeton->getId(), 15, $request->getParameter('exporterfacture'), $id);
            } else
                $this->ExporterBCexterne($request->getParameter('exporterfacture'), 15, $request->getParameter('exporterfacture'), $id);
        }
        $verif_jeton = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($request->getParameter('id'), 16);

        if ($verif_jeton) {
            $idbce = $verif_jeton->getId();
        }
        $doc = $this->documentachat;
        $this->classBtn = "disabledbutton";
        $this->classBtnF = "";
        $this->classBtnJ = "";
        $piecejoint = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($doc->getId());
        $this->lienBCEJ = 0;
        $this->lienFacture = 0;
        $this->jeton = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($doc->getId(), 16);
        if ($this->jeton) {
            $this->lienBCEJ = 1;
            $this->classBtnJ = "disabledbutton";
        }

        $this->facture = Doctrine_Core::getTable('documentachat')->findOneByIdDocparentAndIdTypedoc($idbce, 15);
        if ($this->facture) {
            $this->lienFacture = 1;
            $this->classBtnF = "disabledbutton";
        }
        if ($piecejoint && $doc->getDatesignature()) {
            $this->classBtn = "";
        }
    }

    /*     * ************save facture******************* */

    public function executeSavefacture(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $iddoc = explode(',', $iddoc);
            $mnttotal = $params['mnttotal'];
            $idlieux = $params['lieulivraison'];
            if ($mnttotal == "")
                $mnttotal = 0;
            $listeslignesdoc = $params['listearticle'];

            $val_droit_timbre = $params['val_droit_timbre'];

            $frs = $params['frs'];

            $achat = new Documentachat();
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc[0]);
            $achat = $achat_document;
            //______________________ajouter document demande de prix
            $documentachat = new Documentachat();
            $numero = $documentachat->getNumeroFactureParBCI($achat->getId());
            $documentachat->setNumero($numero);
            if ($frs != '') {
                $documentachat->setIdFrs($frs);
            }
            $documentachat->setIdTypedoc(15);
            $documentachat->setIdDocparent($achat->getId());
            $documentachat->setReference($achat->getNumero());
            $documentachat->setIdUser($user->getId());
            $documentachat->setIdEtatdoc(68);

            if ($val_droit_timbre)
                $documentachat->setDroittimbre($val_droit_timbre);
            $documentachat->setDatecreation(date('Y-m-d'));
            if ($idlieux != "0")
                $documentachat->setIdLieu($idlieux);
            $documentachat->save();
            //Documents Parents
            for ($i = 0; $i < sizeof($iddoc); $i++) {
                $document_parent = new Documentparent();
                $document_parent->setIdDocumentachat($documentachat->getId());
                $document_parent->setIdDocumentparent($iddoc[$i]);
                $document_parent->save();
            }
            $mntht = 0;
            $mntttc = 0;
            $montanttotaltva = 0;
            $montanttotalfodec = 0;
            $pttva = 0;
//            die('cccc'.$documentachat->getId());
            foreach ($listeslignesdoc as $lignedoc) {
                $norgdre = $lignedoc['norgdre'];
                $designation = $lignedoc['designation'];
                $qte = $lignedoc['qte'];
//                $puht = $lignedoc['mntht'];
                $idtva = $lignedoc['idtva'];
                $observation = $lignedoc['observation'];
                $unite = $lignedoc['unitedemander'];
                $totalhtva = $lignedoc['totalhtva'];
                $fodec = $lignedoc['fodec'];
//                $prixttc = $lignedoc['prixttc'];
                $taufodec = $lignedoc['idtaufodec'];
                $totalhax = $lignedoc['totalhax'];
                $totalttc = $lignedoc['totalttc'];
                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                if ($unite && $unite != "")
                    $lignedoc->setUnitedemander($unite);
                if ($designation != "") {
                    $lignedoc->setDesignationarticle($designation);
                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
                    if ($article) {
                        $lignedoc->setIdArticlestock($article->getId());
                        $lignedoc->setCodearticle($article->getCodeart());
                    }
                }
                if ($qte)
                    $lignedoc->setQte($qte);
                if ($idtva)
                    $tva = Doctrine_Core::getTable('tva')->findOneById($idtva);

                if ($idtva) {
                    $lignedoc->setIdTva($idtva);
                } else {
                    $tvas = Doctrine_Core::getTable('tva')->findAll();
                    foreach ($tvas as $tva) :
                        if ($tva->getValeurtva() == 0.00)
                            $id_tva_null = $tva->getId();
                    endforeach;
                    $lignedoc->setIdTva($id_tva_null);
                }
                $mntht+= $totalhax;

                if ($totalhax && $totalhax != "")
                    $lignedoc->setMntht($totalhax);
                if ($totalhtva && $totalhtva != "")
                    $lignedoc->setMntthtva($totalhtva);

                if ($totalttc && $totalttc != "")
                    $lignedoc->setMntttc($totalttc);
                if ($totalhax)
                    $lignedoc->setMntht($totalhax);

                if ($totalttc && $totalhtva)
                    $mnttva = $totalttc - $totalhtva;
                $montanttotaltva+= $mnttva;
                if ($mnttva)
                    $lignedoc->setMnttva($mnttva);
                if ($totalhtva)
                    $lignedoc->setMntthtva($totalhtva);
                if ($fodec)
                    $lignedoc->setMntfodec($fodec);
                $montanttotalfodec+= $fodec;
                if ($taufodec)
                    $lignedoc->setIdTauxfodec($taufodec);
                else {
                    $tauxfodecs = Doctrine_Core::getTable('tauxfodec')->findAll();
                    foreach ($tauxfodecs as $tauxfodec) :
                        if ($tauxfodec->getValeur() == 0)
                            $id_tauxfodec_null = $tauxfodec->getId();
                    endforeach;
                    $lignedoc->setIdTauxfodec($id_tauxfodec_null);
                }
                $lignedoc->setObservation($observation);
                $lignedoc->save();
                $qteligne = new Qtelignedoc();
                $qteligne->setIdLignedocachat($lignedoc->getId());
                $qteligne->setQtelivrefrs($qte);
                $qteligne->save();
                $ErpHistorique = new Erphistorique();
                $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
            }
            $documentachat->setMht($mntht);
//            $total_ttc = $montanttotaltva + $mntht + $montanttotalfodec;
//            if ($droit_timbre == "1")
//                $total_ttc = $total_ttc + 0.600;
            if ($mnttotal)
                $documentachat->setMntttc($mnttotal);
            if ($montanttotaltva)
                $documentachat->setMnttva($montanttotaltva);
            if ($montanttotalfodec)
                $documentachat->setMntfodec($montanttotalfodec);
            if ($quitance_def_bdcr)
                $documentachat->setMntttc($quitance_def_bdcr);
            $documentachat->save();
            die("Facture Système crée avec succès");
        }
        die('Erreur .....!!!!');
    }

    /*     * *******fin save facture********** */
    /*     * *********cloture facture************** */

    public function executeCloturerfacture(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $total_facture = $params['total_facture'];
            $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
            $documentachat->setIdEtatdoc(69);
            if ($total_facture)
                $documentachat->setMontanttotlafacture($total_facture);
            $documentachat->save();
            die("Facture Système Clôture  avec succès");
        }
        die('Erreur .....!!!!');
    }

    /*     * ********************Liste des Factures*********************** */

    public function executeListeFactures(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $iddoc = explode(',', $iddoc);

            // $documentfils = Doctrine_Core::getTable('documentachat')->findOneByIdDocparent($iddoc);
            $query = "select typedoc.id as idtypedoc, CONCAT(fournisseur.rs,' ----Nom du Responsable:   '"
                    . " ,fournisseur.nom,fournisseur.prenom) as rs, documentachat.etatdocachat, documentachat.mntttc as montant, "
                    . " documentachat.id,documentachat.numero, typedoc.libelle as typedoc"
                    . " , SUM(documentachat.mntttc  ) as montanttotal"
                    . " from fournisseur,documentachat,typedoc,documentparent "
//                    . " where (documentachat.id_typedoc=2 or documentachat.id_typedoc=17)   "
                    . " where  documentachat.id_typedoc=15   "
                    . "and typedoc.id=documentachat.id_typedoc "
                    . "and  documentachat.id_frs = fournisseur.id "
                    . "and documentachat.id = documentparent.id_documentachat "
                    . "and documentparent.id_documentparent IN (" . implode(',', array_map('intval', $iddoc)) . ") "
                    . " group by (documentachat.id, typedoc.id, fournisseur.rs, fournisseur.nom, fournisseur.prenom)";
            // . "and documentachat.id not in(select id_fils from documentachat where id_typedoc=2  )";
            //die($query);

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
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

    public function executeDetaillignedemandeprix(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idlignedoc = $params['idlignedoc'];

            $query = "select lignedocachat.id as idligne,documentachat.id as demandedeprixid, "
                    . "lignedocachat.nordre,lignedocachat.designationarticle, lignedocachat.unitedemander, "
                    . "fournisseur.rs,qtelignedoc.qteaachat,lignedocachat.qte as qte,"
                    . " COALESCE(fournisseur.adr, '-') as adrs,lignedocachat.mntht as mntht,"
                    . "  lignedocachat.mntttc as mnttc, "
                    . "  tauxfodec.libelle as fodec, tva.libelle as tva, "
                    . "CONCAT('E-mail : ', COALESCE(fournisseur.mail, '-'),' | Tél : ',"
                    . " COALESCE(fournisseur.tel,'-') ,' | Gsm : ', COALESCE(fournisseur.gsm, '-')) as annuaire  "
                    . "from fournisseur, lignedocachat, documentachat ,qtelignedoc, activitetiers,tva , tauxfodec "
                    . "where lignedocachat.id=qtelignedoc.id_lignedocachat "
                    . " and tva.id=lignedocachat.id_tva"
                    . " and tauxfodec.id=lignedocachat.id_tauxfodec"
                    . " and lignedocachat.id_doc = documentachat.id  "
                    . "AND documentachat.id_frs = fournisseur.id AND documentachat.id=" . $idlignedoc . " "
                    . " group by idligne, demandedeprixid,lignedocachat.nordre,"
                    . "lignedocachat.designationarticle, "
                    . " fournisseur.rs,annuaire,qtelignedoc.qteaachat, fournisseur.adr,tauxfodec.libelle,tva.libelle "
                    . " order by  lignedocachat.id asc;";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
    }

    public function executeImprimertousbondeponseregroupe(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $iddoc = $request->getParameter('iddoc');
        $idtype = $request->getParameter('idtype');
        $documentachats = DocumentachatTable::getInstance()->getBybceBdcAndType($iddoc, $idtype);

//        foreach ($documentachats as $documentachat):
//            $listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($documentachat->getId());
//        endforeach;
//        die(sizeof($documentachats) . 'cds' . $documentachats->getFirst()->getId());
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
//        foreach ($documentachats as $documentachat)
        $pdf->SetTitle('Fiche N°:' . $documentachats->getLast()->getNumero());
//        endforeach;
        $pdf->SetSubject("Bon de déponse aux comptant Regroupé");
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
        $idtype = $request->getParameter('idtype');

        $html = $this->ReadHtmlTousBondeponseRegroupe($societe, $documentachats, $idtype);
//die($html);
        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Bon Dépense aux comptant Regroupe' . $documentachats->getLast()->getNumero() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlTousBondeponseRegroupe($societe, $documentachats, $idtype) {
        $html = StyleCssHeader::header1();
        $doc = new Documentachat();
        $html.=$doc->ReadHtmlttBondeponseRegroupe($documentachats->getLast()->getId(), $idtype);
        //die($html);
        return $html;
    }

    /*     * ****traitement de retenue à la source********* */

    public function executeCertificatRs(sfWebRequest $request) {
//        $this->documentbudget = DocumentbudgetTable::getInstance()->find($request->getParameter('id'));
        $ids = $request->getParameter('ids');
        $this->ids = $ids;
        $doc_facture = DocumentachatTable::getInstance()->find($ids);
        $this->fournisseur = FournisseurTable::getInstance()->find($doc_facture->getIdFrs());


        $this->societe = Doctrine_Core::getTable('societe')->findOneById(1);
    }

    /*     * ******************fin traitement rs*************** */
}
