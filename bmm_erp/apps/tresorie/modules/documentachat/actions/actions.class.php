
<?php

require_once dirname(__FILE__) . '/../lib/documentachatGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/documentachatGeneratorHelper.class.php';

/**
 * documentachat actions.
 *
 * @package    Bmm
 * @subpackage documentachat
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class documentachatActions extends autoDocumentachatActions {

    //______________________________________________________________________Réquette affichier listes documents desc
    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());

        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();
        $query = $query->AndWhere('id_etatdoc=3')->OrderBy('id desc');
        return $query;
    }

    //_________________________________________________Ajouter nouveau fiche par type: BCI
    public function executeSavedocument(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddemandeur = $params['id_utilisateur'];
            $idtypedoc = $params['typedoc'];
            $ref = $params['ref'];
            $listeslignesdoc = $params['listeslignesdoc'];

            $user = new Utilisateur();
            $user = $this->getUser()->getAttribute('userB2m');
            //______________________ajouter document achat
            $documentachat = new Documentachat();
            $numero = $documentachat->NumeroSeqDocumentAchat();
            $documentachat->setNumero($numero);
            $documentachat->setIdDemandeur($iddemandeur);
            $documentachat->setIdTypedoc($idtypedoc);
            if ($ref)
                $documentachat->setReference($ref);
            $documentachat->setIdEtatdoc(1);
            $documentachat->setDatecreation(date('Y-m-d'));
            $documentachat->save();

            foreach ($listeslignesdoc as $lignedoc) {


                $norgdre = $lignedoc['norgdre'];
                $qte = $lignedoc['quantite'];
                $codearticle = $lignedoc['codearticle'];
                $designation = $lignedoc['designation'];
                $motif = $lignedoc['motif'];
                $projet = $lignedoc['projet'];
                $idprojet = $lignedoc['idprojet'];
                $mid = $lignedoc['mid'];

                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                $lignedoc->setEtatligne("EnCours");
                $lignedoc->setQtedemander($qte);

                if ($codearticle)
                    $lignedoc->setCodearticle($codearticle);
                if ($designation)
                    $lignedoc->setDesignationarticle($designation);

                //____________________________________rech article en stock
                $article = Doctrine_Core::getTable('article')->findOneByCodearticleAndDeseignation($codearticle, $designation);
                if ($article)
                    $lignedoc->setIdArticlestock($article->getId());
                //_____________________________________Fin recherche
                $lignedoc->setIdProjet($idprojet);
                $lignedoc->setImpbudget($motif);
                //___________________________________rech motif par budget et par projet
                $motifparprojet = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubriqueAndIdProjet($mid, $idprojet);
                if ($motifparprojet)
                    $lignedoc->setCodebudget($motifparprojet->getId());
                $lignedoc->save();

                $ErpHistorique = new Erphistorique();
                $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
            }

            $ErpHistorique = new Erphistorique();
            $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);
            die("/iddoc/" . $documentachat->getId());
        }
    }

    //__________________________________________________Afficher document
    public function executeShowdocument(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

    //__________________________________________________Envoie fiche vers stock et patrimoine
    public function executeValideretenvoyer(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        if ($request->getParameter('iddoc') && $request->getParameter('btn') && $request->getParameter('btn') == "envoyer") {
            //______________________________Mis a jour document
            $documentachat = new Documentachat();
            $da = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('iddoc'));
            if ($da) {
                $documentachat = $da;

                if ($documentachat->getIdTypedoc() != 9)
                    $documentachat->setIdEtatdoc(9);
                else
                    $documentachat->setIdEtatdoc(6);
                $documentachat->save();
            }
            $this->redirect('@documentachat');
        }
        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

    //____________________________________________________Valider ligne 
    public function executeValiderligne(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $actionpour = $params['valip'];
            $idligne = $params['id'];
            $iddoc = $params['iddoc'];
            $ligneavisdoc = new Ligavisdoc();
            $lgdoc = Doctrine_Core::getTable('ligavisdoc')->findOneByIdDocAndIdAvis($iddoc, $idligne);
            if ($lgdoc) {
                $ligneavisdoc = $lgdoc;
            }
            if ($actionpour > 0) {
                $ligneavisdoc->setIdAvis($idligne);
                $ligneavisdoc->setIdDoc($iddoc);
                $ligneavisdoc->save();
            } else {
                Doctrine_Query::create()->delete('ligavisdoc')
                        ->where('id_doc=' . $iddoc)
                        ->AndWhere('id_avis=' . $idligne)->execute();
                die('Suppression avec succès...');
            }
        }
        die('Mise à jour effectuée avec succès...');
    }

    public function executeImprimerdocachat(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $aviss = Doctrine_Core::getTable('avis')
                        ->createQuery('a')->where('id_poste=5')
                        ->orderBy('id asc')->execute();
        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

        $listesdocuments = Doctrine_Core::getTable('lignedocachat')
                        ->createQuery('a')
                        ->where('id_doc=' . $iddoc)->orderBy('id asc')->execute();
        //Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        // pdf object
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche BCI N°:');
        $pdf->SetSubject("document d'achat");
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

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // dejavusans or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);
//$pdf->SetFont('dejavusans', '', 12);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
//      


        $html = $this->ReadHtml($societe, $aviss, $documentachat, $listesdocuments);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        $visaas = Doctrine_Core::getTable('ligavissig')->findByIdDoc($documentachat->getId());
        $conteurtext = 15;
        $conteurcercle = 250;
        foreach ($visaas as $visa) {
            $visaachat = new Visaachat();
            $vi = Doctrine_Core::getTable('visaachat')->findOneById($visa->getIdVisa());
            if ($vi) {
                $visaachat = $vi;
                $cheminimage = sfconfig::get('sf_appdir') . 'uploads/images/' . $visaachat->getChemin();
                $pdf->Image($cheminimage, $conteurtext - 5, $conteurcercle - 15, 30, 30, 'JPG', '', '', true, 50, '', false, false, 0, false, false, false);
                $pdf->Text($conteurtext, $conteurcercle + 10, $visa->getDatevisa());
                $pdf->Text($conteurtext, $conteurcercle + 15, $visaachat);
                // $pdf->Text($conteurtext, $conteurcercle+25, $visaachat->getAgents());
                // $pdf->Circle($conteurtext + 10, $conteurcercle, 15);

                $conteurtext+=35;
            }
        }

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('documentachat' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtml($societe, $aviss, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBonCommandeInterne($aviss, $listesdocuments);

        return $html;
    }

    public function executeIndex(sfWebRequest $request) {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }
        $idtype = 1;
        if (isset($_REQUEST['idtype']))
            $idtype = $_REQUEST['idtype'];
        $this->pager = $this->getPager($idtype);
        $this->sort = $this->getSort();
        $this->idtype = $idtype;
    }

//    public function executeGetNewOrdonnace(sfWebRequest $request) {
//        $q = Doctrine_Query::create()
//                ->select("da.id as id, da.numero as numero")
//                ->from('Documentachat da')
//                ->leftJoin('da.Ligneoperationcaisse l')
//                ->where('da.id_typedoc=17')
//                ->andwhere('l.id_caisse is not null')
////                ->andwhere('l.id_caisse =' . 14)
//                ->andwhere('da.id  IN (SELECT DISTINCT(Piecejointbudget.id_docachat) '
//                        . 'FROM Piecejointbudget, documentbudget,documentachat'
//                        . ' WHERE Piecejointbudget.id_docachat = documentachat.id '
//                        . 'AND documentachat.id_typedoc=2)')
//                
//                ->andWhere('da.id  NOT IN (SELECT DISTINCT(mb.id_documentachat)'
//                        . ' FROM mouvementbanciare mb 
//                                where  mb.id_documentachat IS NOT NULL)')
//                ->orderBy('da.numero');
////        die($q);
//               $q ->fetchArray();
//
//
//        die(json_encode($q));
//    }
   public function executeGetNewOrdonnace(sfWebRequest $request) {
        $q = Doctrine_Query::create()
                ->select("da.id as id, da.numero as numero ,da.mntttc as mntttc,
                        frs.rs as rs")
                ->from('Documentachat da')
                ->leftJoin('da.Lignemouvementfacturation lg')
                ->leftJoin('da.Piecejointbudget p')
                ->leftJoin('p.Documentbudget db')
                ->leftJoin('db.Ligprotitrub l')
                ->leftJoin('l.Ligneoperationcaisse lbc')
                ->leftJoin('lbc.Caissesbanques ca')
                ->leftJoin('ca.Typecaisse typc')
                ->leftJoin('da.Fournisseur frs')
                ->leftJoin('da.Typedoc type ')
                ->andwhere('da.id_etatdoc=30 ')
                ->andWhere('da.mntttc is not null ')
//                ->andwhere('da.id  IN (SELECT DISTINCT(Piecejointbudget.id_docachat) '
//                        . 'FROM Piecejointbudget, documentbudget,documentachat'
//                        . ' WHERE Piecejointbudget.id_docachat = documentachat.id '
//                        . 'AND documentachat.id_typedoc=2 '
//                        . 'AND Piecejointbudget.id_type =4 )')
                ->andwhere('da.id  IN (SELECT DISTINCT(Piecejointbudget.id_docachat) '
                        . 'FROM Piecejointbudget, documentbudget,documentachat'
                        . ' WHERE Piecejointbudget.id_docachat = documentachat.id '
                        . 'AND documentachat.id_typedoc=2)')
//                ->andwhere('typc.id  = 1')
//                ->andwhere('da.id  IN (SELECT DISTINCT(Piecejointbudget.id_docachat) '
//                        . 'FROM Piecejointbudget, documentbudget,documentachat'
//                        . ' WHERE Piecejointbudget.id_docachat = documentachat.id '
//                        . 'AND documentachat.id_typedoc=2)')
//                 ->andwhere('lbc.id_caisse  = 14')
                ->andWhere('da.id NOT IN '
                        . '(SELECT DISTINCT(mb.id_documentachat) FROM mouvementbanciare mb '
                        . 'where mb.id_documentachat IS NOT NULL)')
                ->orderBy('da.numero')
                ->fetchArray();
        die(json_encode($q));
    }
    public function executeGetNewOrdonnaceBDCNULL(sfWebRequest $request) {
        $q = Doctrine_Query::create()
                ->select("da.id as id, da.numero as numero")
                ->from('Documentachat da')
                ->leftJoin('da.Lignemouvementfacturation lg')
                ->leftJoin('da.Piecejointbudget p')
                ->leftJoin('p.Documentbudget db')
                ->leftJoin('db.Ligprotitrub l')
                ->leftJoin('l.Ligneoperationcaisse lbc')
                ->leftJoin('lbc.Caissesbanques ca')
                ->leftJoin('ca.Typecaisse typc')
                ->andwhere('da.id_etatdoc=30 ')
                // ->andWhere('da.id_fils in ( select documentachat.id from documentachat where documentachat.mntttc is null ')
//                ->andwhere('da.id  IN (SELECT DISTINCT(Piecejointbudget.id_docachat) '
//                        . 'FROM Piecejointbudget, documentbudget,documentachat'
//                        . ' WHERE Piecejointbudget.id_docachat = documentachat.id '
//                        . 'AND documentachat.id_typedoc=2 '
//                        . 'AND Piecejointbudget.id_type =4 )')
                ->andwhere('da.id  IN (SELECT DISTINCT(Piecejointbudget.id_docachat) '
                        . 'FROM Piecejointbudget, documentbudget,documentachat'
                        . ' WHERE Piecejointbudget.id_docachat = documentachat.id '
                        . 'AND documentachat.id_typedoc=2)')
//                ->andwhere('typc.id  = 1')
//                ->andwhere('da.id  IN (SELECT DISTINCT(Piecejointbudget.id_docachat) '
//                        . 'FROM Piecejointbudget, documentbudget,documentachat'
//                        . ' WHERE Piecejointbudget.id_docachat = documentachat.id '
//                        . 'AND documentachat.id_typedoc=2)')
//                 ->andwhere('lbc.id_caisse  = 14')
                ->andWhere('da.id NOT IN '
                        . '(SELECT DISTINCT(mb.id_documentachat) FROM mouvementbanciare mb '
                        . 'where mb.id_documentachat IS NOT NULL)')
                ->orderBy('da.numero')
                ->fetchArray();
        die(json_encode($q));
    }

    public function executeGetNewOrdonnaceBDCRegroupe(sfWebRequest $request) {
        $q = Doctrine_Query::create()
                ->select("da.id as id, da.numero as numero")
                ->from('Documentachat da')
                ->leftJoin('da.Lignemouvementfacturation lg')
                ->leftJoin('da.Piecejointbudget p')
                ->leftJoin('p.Documentbudget db')
                ->leftJoin('db.Ligprotitrub l')
                ->leftJoin('l.Ligneoperationcaisse lbc')
                ->leftJoin('lbc.Caissesbanques ca')
                ->leftJoin('ca.Typecaisse typc')
                ->andwhere('da.id_etatdoc=30 ')
                ->andWhere('da.mntttc is not null ')
                ->andwhere('da.id  IN (SELECT DISTINCT(Piecejointbudget.id_docachat) '
                        . 'FROM Piecejointbudget, documentbudget,documentachat'
                        . ' WHERE Piecejointbudget.id_docachat = documentachat.id '
                        . 'AND documentachat.id_typedoc=22 '
                        . 'AND Piecejointbudget.id_type =6 '
                        . ' and Piecejointbudget.id_documentbudget=documentbudget.id '
                        . ' and documentbudget.id_type=2)')
//                ->andwhere('typc.id  = 1')
//                 ->andwhere('lbc.id_caisse  = 14')
                ->andWhere('da.id NOT IN '
                        . '(SELECT DISTINCT(mb.id_documentachat) FROM mouvementbanciare mb '
                        . 'where mb.id_documentachat IS NOT NULL)')
                ->orderBy('da.numero');
//        die($q);
        $q = $q->fetchArray();
        die(json_encode($q));
    }

    public function executeGetNewOrdonnaceBDCG(sfWebRequest $request) {
//        $q = Doctrine_Query::create()
//                ->select("da.id as id, da.numero as numero")
//                ->from('Documentachat da')
//                ->leftJoin('da.Lignemouvementfacturation lg')
//                ->leftJoin('da.Piecejointbudget p')
//                ->leftJoin('p.Documentbudget db')
//                ->leftJoin('db.Ligprotitrub l')
//                ->leftJoin('l.Ligneoperationcaisse lbc')
//                ->leftJoin('lbc.Caissesbanques ca')
//                ->leftJoin('ca.Typecaisse typc')
//                ->andwhere('da.id_etatdoc=30 ')
//                ->andwhere('typc.id  = 1')
//                ->andwhere('da.id_docparent  IN (SELECT DISTINCT(Piecejointbudget.id_docachat) '
//                        . 'FROM Piecejointbudget, documentbudget,documentachat'
//                        . ' WHERE Piecejointbudget.id_docachat = documentachat.id '
//                        . 'AND documentachat.id_typedoc=2)')
//                ->andWhere('da.id_docparent NOT IN '
//                        . '(SELECT DISTINCT(mb.id_documentachat) FROM mouvementbanciare mb '
//                        . 'where mb.id_documentachat IS NOT NULL)')
//                ->orderBy('da.numero');
        $query = "SELECT da.id as id, da.numero as numero "
                . "FROM Documentachat da,Lignemouvementfacturation lg ,Piecejointbudget p,"
                . " Documentbudget db,Ligprotitrub l ,Typecaisse typc ,Caissesbanques ca ,Ligneoperationcaisse lbc "
                . " where lg.id_documentachat=da.id_docparent"
                . " and p.id_docachat=da.id_docparent"
                . " and  p.id_documentbudget=db.id"
                . " and db.id_budget=l.id"
                . " and lbc.id_budget=l.id"
                . " and lbc.id_caisse=ca.id"
                . " and ca.id_typecb=typc.id"
                . " AND da.id_etatdoc=30 "
                . " and da.id_typedoc=15"
                . " AND typc.id  = 1 "
                . " AND da.id_docparent  IN (SELECT DISTINCT(Piecejointbudget.id_docachat) "
                . " FROM Piecejointbudget, documentbudget,documentachat"
                . " WHERE Piecejointbudget.id_docachat = documentachat.id"
                . " AND documentachat.id_typedoc=2) "
                . " AND da.id_docparent NOT IN (SELECT DISTINCT(mb.id_documentachat) "
                . "	FROM mouvementbanciare mb where mb.id_documentachat IS NOT NULL)"
                . " group by da.id"
                . " ORDER BY da.numero";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $resultat = $conn->fetchAssoc($query);
        die(json_encode($resultat));
    }

    public function executeGetQuitances(sfWebRequest $request) {
        $query = "select documentachat.id as id, "
                . "LPAD(documentachat.numero::text, 7, '0') as numero,"
                . " typedoc.prefixetype as type, documentachat.id_docparent as id_docparent "
                . " from documentachat, typedoc  "
                . " where documentachat.etatdocachat IS NULL "
                . " AND documentachat.id_typedoc = typedoc.id "
                . " AND documentachat.id IN (SELECT piecejointbudget.id_docachat "
                . "FROM piecejointbudget "
                . "WHERE piecejointbudget.id_type = 4 "
                . " OR piecejointbudget.id_type = 5) "
                . " AND documentachat.id_etatdoc = 39 "
                . " AND  documentachat.id_typedoc = 17"
                . " AND documentachat.id NOT IN (SELECT d.id_fils "
                . "FROM documentachat d WHERE d.etatdocachat IS NULL AND d.id_fils IS NOT NULL) "
                . " order by documentachat.id desc ";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetQuitancesBDCRegroupe(sfWebRequest $request) {
        $query = "select documentachat.id as id, "
                . "LPAD(documentachat.numero::text, 7, '0') as numero,"
                . " typedoc.prefixetype as type, documentachat.id_docparent as id_docparent "
                . " from documentachat, typedoc  "
                . " where documentachat.etatdocachat IS NULL "
                . " AND documentachat.id_typedoc = typedoc.id "
//                . " AND documentachat.id IN (SELECT piecejointbudget.id_docachat "
//                . " FROM piecejointbudget "
//                . " WHERE piecejointbudget.id_type = 4 "
//                . " OR piecejointbudget.id_type = 5) "
                . " AND documentachat.id_etatdoc = 55 "
                . " AND  documentachat.id_typedoc = 21"
//                . " AND documentachat.id NOT IN (SELECT d.id_fils "
//                . "FROM documentachat d WHERE d.etatdocachat IS NULL AND d.id_fils IS NOT NULL) "
                . " order by documentachat.id desc ";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetQuitancesBDCNULL(sfWebRequest $request) {
        $query = "select documentachat.id as id, "
                . "LPAD(documentachat.numero::text, 7, '0') as numero,"
                . " typedoc.prefixetype as type, documentachat.id_docparent as id_docparent "
                . " from documentachat, typedoc  "
                . " where documentachat.etatdocachat IS NULL "
                . " AND documentachat.id_typedoc = typedoc.id "
                . " AND documentachat.id_etatdoc = 55 "
                . " AND  documentachat.id_typedoc = 17"
                . " AND documentachat.id NOT IN (SELECT d.id_fils "
                . "FROM documentachat d WHERE d.etatdocachat IS NULL AND d.id_fils IS NOT NULL) "
                . " order by documentachat.id desc ";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetQuitancesDefBDCNULL(sfWebRequest $request) {
        $query = "select documentachat.id as id, "
                . "LPAD(documentachat.numero::text, 7, '0') as numero,"
                . " typedoc.prefixetype as type, documentachat.id_docparent as id_docparent "
                . " from documentachat, typedoc  "
                . " where documentachat.etatdocachat IS NULL "
                . " AND documentachat.id_typedoc = typedoc.id "
                . " AND documentachat.id_etatdoc = 58 "
                . " AND  documentachat.id_typedoc = 17"
                . " AND documentachat.id NOT IN (SELECT d.id_fils "
                . "FROM documentachat d WHERE d.etatdocachat IS NULL AND d.id_fils IS NOT NULL) "
                . " order by documentachat.id desc ";

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

}
