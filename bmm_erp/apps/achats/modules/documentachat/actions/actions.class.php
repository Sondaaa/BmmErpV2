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

    //__________________________________________________Annuler document achat




    public function executeAfficheSumBCI(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_contrat = $params['id'];

            $query = "select coalesce( SUM(documentachat.mntttc),0) as sommettc "
                    . " from documentachat"
                    . " where id_contrat = " . $id_contrat
                    . " and id_typedoc = 6"
                    . " and valide=true"
                    . " and id_etatdoc is not null ";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die("bien");
    }

    public function executeAnnuler(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

    public function executeAnnulationContratProvisoire(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');
        $idcontrat = $request->getParameter('idcontrat');
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);

        $this->contratachat = ContratachatTable::getInstance()->find($idcontrat);
        $this->listesdocumentscontrat = Doctrine_Core::getTable('lignecontrat')->findByIdContrat($idcontrat);
    }

    public function executeValiderAnnulation(sfWebRequest $request) {
        $iddoc = $request->getParameter('id');
        $motif = $request->getParameter('motif');
        $url = $request->getParameter('url');

        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $documentachat->setEtatdocachat('Annulé(e)');
        $documentachat->setIdEtatdoc(45);
        $documentachat->save();

        $piecejoint_budget = PiecejointbudgetTable::getInstance()->findByIdDocachat($iddoc);
        if (sizeof($piecejoint_budget) >= 1) {
            foreach ($piecejoint_budget as $piecejo) :
                $document_budget = DocumentbudgetTable::getInstance()->findOneById($piecejo->getIdDocumentbudget());
                $document_budget->setAnnule(true);
                $document_budget->save();
            endforeach;
        }

        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');

        $valide_budget = false;
        //Vérifier si engagement budget existe ou non
        //        if ($documentachat->ActionSignature() != "") {
        //            $valide_budget = false;
        //        }
        $doc_annulation = DocumentachatannulationTable::getInstance()->findOneByIdDocumentachat($iddoc);
        if ($doc_annulation)
            $annulation = $doc_annulation;
        else
            $annulation = new Documentachatannulation();
        //        $annulation = DocumentachatannulationTable::getInstance()->find();
        $annulation->setDateannulation(date('Y-m-d'));
        $annulation->setIdDocumentachat($iddoc);
        $annulation->setIdUser($user->getId());
        $annulation->setMotifannulation($motif);
        $annulation->setUrldocumentscan($url);
        $annulation->setValideBudget($valide_budget);
        $annulation->save();

        if ($documentachat->getIdTypedoc() == 6) {
            $document_achat_fils = DocumentachatTable::getInstance()->findByIdDocparent($documentachat->getId());
            foreach ($document_achat_fils as $doc) {
                if ($doc->getEtatdocachat() == '') {
                    $doc->setEtatdocachat('Annulé(e)');
                    $doc->setIdEtatdoc(45);
                    $doc->save();

                    $doc_annulation = DocumentachatannulationTable::getInstance()->findOneByIdDocumentachat($iddoc);
                    if ($doc_annulation)
                        $annulation = $doc_annulation;
                    else
                        $annulation = new Documentachatannulation();
                    $annulation->setDateannulation(date('Y-m-d'));
                    //                    $annulation->setIdDocumentachat($doc->getId());
                    $annulation->setIdDocumentachat($iddoc);
                    $annulation->setIdUser($user->getId());
                    $annulation->setMotifannulation($motif);
                    $annulation->setUrldocumentscan($url);
                    $annulation->setValideBudget($valide_budget);
                    $annulation->save();
                }
            }
        } else {
            $document_achat_fils_du_parent = DocumentachatTable::getInstance()->findByIdDocparent($documentachat->getIdDocparent());
            foreach ($document_achat_fils_du_parent as $doc) {
                if ($doc->getEtatdocachat() == '') {
                    $doc->setEtatdocachat('Annulé(e)');
                    $doc->setIdEtatdoc(45);
                    $doc->save();

                    $doc_annulation = DocumentachatannulationTable::getInstance()->findOneByIdDocumentachat($iddoc);
                    if ($doc_annulation)
                        $annulation = $doc_annulation;
                    else
                        $annulation = new Documentachatannulation();
                    $annulation->setDateannulation(date('Y-m-d'));
                    //                    $annulation->setIdDocumentachat($doc->getId());
                    $annulation->setIdDocumentachat($iddoc);
                    $annulation->setIdUser($user->getId());
                    $annulation->setMotifannulation($motif);
                    $annulation->setUrldocumentscan($url);
                    $annulation->setValideBudget($valide_budget);
                    $annulation->save();
                }
            }
        }

        die('bien');
    }

    public function executeValiderAnnulationContratprovisoire(sfWebRequest $request) {
        $iddoc = $request->getParameter('id');
        $motif = $request->getParameter('motif');
        $url = $request->getParameter('url');
        $id_docachat = $request->getParameter('id_docachat');
        //edit contrat achat 
        $contratProvisoireachat = Doctrine_Core::getTable('contratachat')->findOneById($iddoc);
        $contratProvisoireachat->setEtatdocachat('Annulé(e)');
        $contratProvisoireachat->setIdEtatdoc(46);
        $contratProvisoireachat->save();

        $docachatachat = Doctrine_Core::getTable('documentachat')->findOneById($id_docachat);
        $docachatachat->setEtatdocachat('Annulé(e)');
        $docachatachat->setIdEtatdoc(46);
        $docachatachat->save();

        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');
        $valide_budget = false;
        //add dans le table contratnnulation
        $doc_annulation = DocumentcontratannulationTable::getInstance()->findOneByIdDoccontrat($iddoc);
        if ($doc_annulation)
            $annulation = $doc_annulation;
        else
            $annulation = new Documentcontratannulation();
        $annulation->setDateannulation(date('Y-m-d'));
        $annulation->setIdDocachat($id_docachat);
        $annulation->setIdDoccontrat($iddoc);
        $annulation->setIdUser($user->getId());
        $annulation->setMotifannulation($motif);
        $annulation->setUrldocscaner($url);
        $annulation->setValideBudget($valide_budget);
        $annulation->save();
        //******annulsation le budget engage*******/
        $piecejointbudget = PiecejointbudgetTable::getInstance()->findOneByIdDocachatAndIdType($id_docachat, 4);
        if (sizeof($piecejointbudget) >= 1) {
            $doc_budget = DocumentbudgetTable::getInstance()->find($piecejointbudget->getIdDocumentbudget());
            $ligpr = LigprotitrubTable::getInstance()->find($doc_budget->getIdBudget());
            $mnt_retire = floatval($ligpr->getMntprovisoire() - $contratProvisoireachat->getMontantcontrat());
            $ligpr->setMntprovisoire($mnt_retire);
            $ligpr->save();
            $piecejointbudget->delete();
            //$doc_budget->delete();
            $doc_budget->setAnnule(true);
            $doc_budget->save();
        }
        die('bien');
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

    public function executeNew(sfWebRequest $request) {
        $this->idtype = 6;
        if ($request->getParameter('idtype'))
            $this->idtype = $request->getParameter('idtype');

        $this->form = $this->configuration->getForm();
        $this->documentachat = $this->form->getObject();
        $this->documentachat->setIdTypedoc($this->idtype);
        $this->documentachat->setNumero($this->documentachat->NumeroSeqDocumentAchat(6));
        $this->documentachat->setDatecreation(date('Y-m-d'));
    }

    public function executeEdit(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->documentachat = DocumentachatTable::getInstance()->find($id);
        //        $this->documentachat = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->documentachat);
    }

    //______________________________________________________________________Remplir les demande de prix
    public function executeRemplirdemandedeprix(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        $iddoc = $request->getParameter('iddoc');
        $this->ids = $iddoc;
        $iddoc = explode(',', $iddoc);
        $this->lieuxlivraisons = Doctrine_Core::getTable('lieulivraisson')->findAll();
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc[0]);
        $demande_prix = new Documentachat();
        //        $demande_de_prix = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedocAndIdDocparent($iddoc, 8,$iddoc);
        $this->numerodemande = $demande_prix->getNumeroBonCommandeInterne($iddoc[0]);
        $this->refernece = $demande_prix->getNumeroSeqDemandeDePrixParBCI($iddoc[0]);
        $this->liste_document_achats = DocumentachatTable::getInstance()->getByIds($iddoc);
        $this->fournisseurs = FournisseurTable::getInstance()->getAllFournisseurOrderByRaisonSociale();
    }

    //______________________________________________________________________Affiche listes des fournisseurs
    //    public function executeListefournisseur(sfWebRequest $request) {
    //        header('Access-Control-Allow-Origin: *');
    //        $params = array();
    //        $content = $request->getContent();
    //        $q = Doctrine_Query::create()
    //                ->select("fournisseur.id, fournisseur.rs as name,fournisseur.reference as ref ")
    //                ->from('fournisseur');
    //        if (!empty($content)) {
    //            $params = json_decode($content, true);
    //            $frs = strtoupper($params['frs']);
    //            $ref = strtoupper($params['ref']);
    //            if ($frs != "")
    //                $q = $q->where("upper(rs) like '%" . $frs . "%' or upper(nom) like '%" . $frs . "%' or upper(prenom) like '%" . $frs . "%'");
    //
    //            if ($ref != "")
    //                $q = $q->Where("upper(reference) like '%" . $ref . "%'");
    //        }
    //        $q = $q->orderBy('id desc');
    //
    //        $listefournisseur = $q->fetchArray();
    //        die(json_encode($listefournisseur));
    //    }
    //______________________________________________________________________Affiche listes des fournisseurs
    public function executeListefournisseur(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $q = Doctrine_Query::create()
                ->select("fournisseur.id, fournisseur.rs as name,fournisseur.reference as ref ")
                ->from('fournisseur')
        //->where("etatfrs='Actif'")


        ;
        if (!empty($content)) {
            $params = json_decode($content, true);
            $frs = strtoupper($params['frs']);
            $ref = strtoupper($params['ref']);
            if ($frs != "")
                $q = $q->where("upper(rs) like '%" . $frs . "%' or upper(nom) like '%" . $frs . "%' or upper(prenom) like '%" . $frs . "%'");

            if ($ref != "")
                $q = $q->Where("upper(reference) like '%" . $ref . "%'");
        }
        $q = $q->orderBy('id desc');

        $listefournisseur = $q->fetchArray();
        die(json_encode($listefournisseur));
    }

    ///__________________________Afficher dorit Timbre

    public function executeAficheroitTimbre(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

            $id_droit = $params['id_droittimbre'];
            //     $q = Doctrine_Query::create()
            //     ->select("droittimbre.id, droittimbre.valeur as valeur ")
            //     ->from('droittimbre')
            //     ->where("droittimbre.id=".$id_droit)
            // ;    
            //     $q = $q->orderBy('id desc');
            //     $droittimres = $q->fetchArray();

            $query = "select droittimbre.id , droittimbre.valeur as valeur
                  from droittimbre where  droittimbre.id = " . $id_droit;
            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }
    }

    public function executeAficheroitTimbreSociete(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $societe = SocieteTable::getInstance()->findAll()->getFirst();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $id_droit = $params['id_droittimbre'];
            $query = "select parametragesociete.id , parametragesociete.timbre  as valeur
                  from parametragesociete
                  where  parametragesociete.id_societe = " . $societe->getId();
            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }
    }

    //______________________________________________________________________Réquette affichier listes documents desc
    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();

        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);
        $filter = $this->getFilters();

        $query = $this->filters->buildQuery($this->getFilters());
        $documentsachat = Doctrine_Core::getTable('documentachat')
                ->createQuery('a')->where('id_typedoc=6')
                ->andWhere('a.id_etatdoc <> 45');
        if (isset($filter['reference']))
            $documentsachat = $documentsachat->Andwhere("reference like '%" . $filter['reference'] . "%'");
        if (isset($filter['numero']) && is_numeric($filter['numero']))
            $documentsachat = $documentsachat->Andwhere("numero = " . $filter['numero'] . "");
        if (isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        } elseif (isset($filter['datecreation']['from']) && !isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . date('Y') . "-12-31" . "'");
        } elseif (!isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . date('Y') . "-01-01" . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        } else {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . date('Y') . "-01-01" . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . date('Y') . "-12-31" . "'");
        }

        if (isset($filter['id_etatdoc'])) {
            $documentsachat = $documentsachat->Andwhere('id_etatdoc=' . $filter['id_etatdoc']);
        }
        $query = $documentsachat->OrderBy('id desc');
        $this->addSortQuery($query);

        return $query;
    }

    public function executeArticlebycodeanddesignation(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $codearticle = $params['codearticle'];
            $designation = strtoupper($params['designation']);
            $q = Doctrine_Query::create()
                    ->select(" article.id,article.codeart as ref,trim( both '  ' from article.designation) as name")
                    ->from('article');
            $designation = str_replace("'", "''", $designation);

            if ($codearticle != "" && $designation == "")
                $q = $q->where("codeart like '%" . $codearticle . "%'");
            if ($codearticle == "" && $designation != "")
                $q = $q->Where("upper(designation) like '%" . $designation . "%'");
            if ($codearticle != "" && $designation != "")
                $q = $q->Where("upper(designation) like '%" . $designation . "%'")
                        ->AndWhere("codeart like '%" . $codearticle . "%'");

            $listesarticles = $q->fetchArray();
            die(json_encode($listesarticles));
        }
        die('bien');
    }

    public function executeGetArticleByDesignation(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $designation = strtoupper($params['designation']);
            $designation = str_replace("'", "''", $designation);
            $q = Doctrine_Query::create()
                    ->select(" article.id,article.codeart as ref,trim( both '  ' from article.designation) as name")
                    ->from('article')
                    ->Where("upper(designation) like '%" . $designation . "%'");

            $listesarticles = $q->fetchArray();
            die(json_encode($listesarticles));
        }
        die('bien');
    }

    //_________________________________________________Listes des Projets du société
    public function executeUniteMarche(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $libelle = $params['libelle'];
            $q = Doctrine_Query::create()
                    ->select("id,libelle as name")
                    ->from('unitemarche')
                    ->where("UPPER(libelle) like '" . strtoupper($libelle) . "%'")
                    ->orderBy('libelle');

            $listesprojets = $q->fetchArray();
            die(json_encode($listesprojets));
        }
        die('rien');
    }

    //_________________________________________________Listes des Projets du société
    public function executeProjetparmotif(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $q = Doctrine_Query::create()
                ->select("id,libelle as name")
                ->from('projet');

        $listesprojets = $q->fetchArray();
        die(json_encode($listesprojets));
    }

    //_________________________________________________Listes des motif par projet
    public function executeListesmotifparprojet(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $projet = $params['idprojet'];
            $motiftext = strtoupper($params['motiftext']);
            $q = Doctrine_Query::create()
                    ->select("r.id,r.libelle as name")
                    ->from('rubrique r')
                    ->leftJoin('ligprotitrub l on r.id=l.id_rubrique')
                    ->where('r.id_rubrique is not null')
                    ->andwhere('l.id_projet=' . $projet);
            if ($motiftext != "")
                $q = $q->andwhere("upper(rubrique.libelle) like '%" . $motiftext . "%'");

            $listemotif = $q->fetchArray();
            die(json_encode($listemotif));
        }

        die('bien');
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
            $id_contrat = $params['id_contrat'];
            $ref = $params['ref'];
            $valide = $params['valide'];
            $datecreation = $params['datecreation'];
            $listeslignesdoc = $params['listeslignesdoc'];
            $id_nature = $params['id_nature'];
            $montant_estimatif = $params['montant_estimatif'];
            $iddoc = $params['iddoc'];
            $is_valide = $params['is_valide'];

            $user = new Utilisateur();
            $user = $this->getUser()->getAttribute('userB2m');
            //die($valide);
            if ($iddoc == '') {
                //______________________ajouter document achat
                $documentachat = new Documentachat();
                if (!isset($_SESSION['exercice_budget']))
                    $numero = $documentachat->NumeroSeqDocumentAchat(6);
                else
                    $numero = $documentachat->NumeroSeqDocumentAchat(6, $_SESSION['exercice_budget']);

                $documentachat->setNumero($numero);
                $documentachat->setIdEtatdoc(1);
            } else {
                //modifier document achat
                $documentachat = DocumentachatTable::getInstance()->find($iddoc);

                //Suppression All Lignedocachat && Qtelignedoc
                foreach ($documentachat->getLignedocachat() as $lignedocachat) {
                    foreach ($lignedocachat->getQtelignedoc() as $qtelignedoc) {
                        $qtelignedoc->delete();
                    }
                    $lignedocachat->delete();
                }
            }

            $documentachat->setIdDemandeur($iddemandeur);
            if ($id_nature && $id_nature != "")
                $documentachat->setIdObjet($id_nature);

            if ($id_contrat && $id_contrat != "")
                $documentachat->setIdContrat($id_contrat);
            if ($montant_estimatif && $montant_estimatif != "")
                $documentachat->setMontantestimatif($montant_estimatif);
            $documentachat->setIdTypedoc($idtypedoc);
            if ($ref)
                $documentachat->setReference($ref);
            if ($valide == 1)
                $documentachat->setValide(true);
            if ($valide == 0)
                $documentachat->setValide(false);
            if ($is_valide) {
                $documentachat->setValide(true);
                $documentachat->setIdEtatdoc(24);
            } else {
                $documentachat->setValide(false);
                $documentachat->setIdEtatdoc(1);
            }
            if ($datecreation != "")
                $documentachat->setDatecreation($datecreation);
            else
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
                $observation = $lignedoc['observation'];
                $unitedemander = $lignedoc['unitedemander'];
                $idunitemarche = $lignedoc['idunitemarche'];
                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                $lignedoc->setQte($qte);
                if ($observation && $observation != "")
                    $lignedoc->setObservation($observation);
                if ($unitedemander && $unitedemander != "")
                    $lignedoc->setUnitedemander($unitedemander);
                if ($idunitemarche && $idunitemarche != "")
                    $lignedoc->setIdUnitemarche($idunitemarche);
                if ($codearticle)
                    $lignedoc->setCodearticle($codearticle);
                if ($designation)
                    $lignedoc->setDesignationarticle($designation);

                //____________________________________rech article en stock
                if ($codearticle != "" && $designation != "") {
                    $article = Doctrine_Core::getTable('article')->findOneByCodeartAndDesignation($codearticle, $designation);
                    if ($article)
                        $lignedoc->setIdArticlestock($article->getId());
                }
                //_____________________________________Fin recherche
                if ($idprojet != '')
                    $lignedoc->setIdProjet($idprojet);
                if ($motif != '')
                    $lignedoc->setImpbudget($motif);

                //___________________________________rech motif par budget et par projet
                if ($idprojet != "" && $mid != "") {
                    $motifparprojet = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubriqueAndIdProjet($mid, $idprojet);
                    if ($motifparprojet)
                        $lignedoc->setCodebudget($motifparprojet->getId());
                }
                $lignedoc->save();

                $lignedocqte = new Qtelignedoc();
                $lignedocqte->setQtedemander($qte);
                $lignedocqte->setIdLignedocachat($lignedoc->getId());
                $lignedocqte->save();
                $ErpHistorique = new Erphistorique();
                $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
            }

            $ErpHistorique = new Erphistorique();
            $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);
            die("/iddoc/" . $documentachat->getId());
        }
    }

    public function executeSavedocumentEtEnvoyecg(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddemandeur = $params['id_utilisateur'];
            $idtypedoc = $params['typedoc'];
            $id_contrat = $params['id_contrat'];
            $ref = $params['ref'];
            $valide = $params['valide'];
            $datecreation = $params['datecreation'];
            $listeslignesdoc = $params['listeslignesdoc'];
            $id_nature = $params['id_nature'];
            $montant_estimatif = $params['montant_estimatif'];
            $iddoc = $params['iddoc'];
            $is_valide = $params['is_valide'];

            $user = new Utilisateur();
            $user = $this->getUser()->getAttribute('userB2m');
            //die($valide);
            if ($iddoc == '') {
                //______________________ajouter document achat
                $documentachat = new Documentachat();
                if (!isset($_SESSION['exercice_budget']))
                    $numero = $documentachat->NumeroSeqDocumentAchat(6);
                else
                    $numero = $documentachat->NumeroSeqDocumentAchat(6, $_SESSION['exercice_budget']);

                $documentachat->setNumero($numero);
                $documentachat->setIdEtatdoc(49);
            } else {
                //modifier document achat
                $documentachat = DocumentachatTable::getInstance()->find($iddoc);

                //Suppression All Lignedocachat && Qtelignedoc
                foreach ($documentachat->getLignedocachat() as $lignedocachat) {
                    foreach ($lignedocachat->getQtelignedoc() as $qtelignedoc) {
                        $qtelignedoc->delete();
                    }
                    $lignedocachat->delete();
                }
            }

            $documentachat->setIdDemandeur($iddemandeur);
            if ($id_nature && $id_nature != "")
                $documentachat->setIdObjet($id_nature);

            if ($id_contrat && $id_contrat != "")
                $documentachat->setIdContrat($id_contrat);
            if ($montant_estimatif && $montant_estimatif != "")
                $documentachat->setMontantestimatif($montant_estimatif);
            $documentachat->setIdTypedoc($idtypedoc);
            if ($ref)
                $documentachat->setReference($ref);
            if ($valide == 1)
                $documentachat->setValide(true);
            if ($valide == 0)
                $documentachat->setValide(false);
            if ($is_valide) {
                $documentachat->setValide(true);
                $documentachat->setIdEtatdoc(49);
            } else {
                $documentachat->setValide(false);
                $documentachat->setIdEtatdoc(1);
            }
            if ($datecreation != "")
                $documentachat->setDatecreation($datecreation);
            else
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
                $observation = $lignedoc['observation'];
                $unitedemander = $lignedoc['unitedemander'];
                $idunitemarche = $lignedoc['idunitemarche'];
                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                $lignedoc->setQte($qte);
                if ($observation && $observation != "")
                    $lignedoc->setObservation($observation);
                if ($unitedemander && $unitedemander != "")
                    $lignedoc->setUnitedemander($unitedemander);
                if ($idunitemarche && $idunitemarche != "")
                    $lignedoc->setIdUnitemarche($idunitemarche);
                if ($codearticle)
                    $lignedoc->setCodearticle($codearticle);
                if ($designation)
                    $lignedoc->setDesignationarticle($designation);

                //____________________________________rech article en stock
                if ($codearticle != "" && $designation != "") {
                    $article = Doctrine_Core::getTable('article')->findOneByCodeartAndDesignation($codearticle, $designation);
                    if ($article)
                        $lignedoc->setIdArticlestock($article->getId());
                }
                //_____________________________________Fin recherche
                if ($idprojet != '')
                    $lignedoc->setIdProjet($idprojet);
                if ($motif != '')
                    $lignedoc->setImpbudget($motif);

                //___________________________________rech motif par budget et par projet
                if ($idprojet != "" && $mid != "") {
                    $motifparprojet = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubriqueAndIdProjet($mid, $idprojet);
                    if ($motifparprojet)
                        $lignedoc->setCodebudget($motifparprojet->getId());
                }
                $lignedoc->save();

                $lignedocqte = new Qtelignedoc();
                $lignedocqte->setQtedemander($qte);
                $lignedocqte->setIdLignedocachat($lignedoc->getId());
                $lignedocqte->save();
                $ErpHistorique = new Erphistorique();
                $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
            }

            $ErpHistorique = new Erphistorique();
            $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);
            die("/iddoc/" . $documentachat->getId());
        }
    }

    public function executeSavedocumentBCiContrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddemandeur = $params['id_utilisateur'];
            $idtypedoc = $params['typedoc'];
            $id_contrat = $params['id_contrat'];
            $ref = $params['ref'];
            $valide = $params['is_valide'];
            $datecreation = $params['datecreation'];
            $listeslignesdoc = $params['listeslignesdoc'];
            $id_nature = $params['id_nature'];
            $montant_estimatif = $params['montant_estimatif'];
            $total_ttc_bdc = $params['total_ttc_bdc'];

            $iddoc = $params['iddoc'];
            $is_valide = $params['is_valide'];
            $id_frs = $params['id_frs'];
            $doc_parent = DocumentachatTable::getInstance()->findByIdTypedocAndIdContrat(20, $id_contrat);
            //          die($doc_parent->getFirst()->getId().'xssssssj');
            $user = new Utilisateur();
            $user = $this->getUser()->getAttribute('userB2m');
            //            die( $total_ttc_bdc. 'rf'.$valide);
            //die($iddoc.'vf');
            //            if ($iddoc == '') {
            //______________________ajouter document achat
            $documentachat = new Documentachat();
            if (!isset($_SESSION['exercice_budget']))
                $numero = $documentachat->NumeroSeqDocumentAchat(6);
            else
                $numero = $documentachat->NumeroSeqDocumentAchat(6, $_SESSION['exercice_budget']);

            $documentachat->setNumero($numero);
            $documentachat->setIdEtatdoc(1);
            //            }
            //            else {
            //                //modifier document achat
            //                $documentachat = DocumentachatTable::getInstance()->find($iddoc);
            //
            //                //Suppression All Lignedocachat && Qtelignedoc
            //                foreach ($documentachat->getLignedocachat() as $lignedocachat) {
            //                    foreach ($lignedocachat->getQtelignedoc() as $qtelignedoc) {
            //                        $qtelignedoc->delete();
            //                    }
            //                    $lignedocachat->delete();
            //                }
            //            }

            if ($iddemandeur && $iddemandeur != "")
                $documentachat->setIdDemandeur($iddemandeur);
            if ($id_nature && $id_nature != "")
                $documentachat->setIdObjet($id_nature);

            if ($id_contrat && $id_contrat != "")
                $documentachat->setIdContrat($id_contrat);
            if ($montant_estimatif && $montant_estimatif != "")
                $documentachat->setMontantestimatif($montant_estimatif);
            $documentachat->setIdTypedoc($idtypedoc);
            if ($ref)
                $documentachat->setReference($ref);

            if ($id_frs)
                $documentachat->setIdFrs($id_frs);

            if ($is_valide) {
                $documentachat->setValide(true);
                $documentachat->setIdEtatdoc(42);
            } else {
                $documentachat->setValide(false);
                $documentachat->setIdEtatdoc(1);
            }
            if ($datecreation != "")
                $documentachat->setDatecreation($datecreation);
            else
                $documentachat->setDatecreation(date('Y-m-d'));
            $documentachat->save();

            //            foreach ($listeslignesdoc as $lignedoc) {
            //
            //                $norgdre = $lignedoc['norgdre'];
            //                $qte = $lignedoc['qte'];
            //                $codearticle = $lignedoc['codearticle'];
            //                $designation = $lignedoc['designation'];
            ////                $motif = $lignedoc['motif'];
            //                $projet = $lignedoc['projet'];
            //                $idprojet = $lignedoc['idprojet'];
            ////                $mid = $lignedoc['mid'];
            //                $observation = $lignedoc['observation'];
            ////                $unitedemander = $lignedoc['unitedemander'];
            ////                $idunitemarche = $lignedoc['idunitemarche'];
            //                $totalhax = $lignedoc['totalhax'];
            //                $totalttc = $lignedoc['totalttc'];
            //
            //                $totalhtva = $lignedoc['totalhtva'];
            //                $lignedoc = new Lignedocachat();
            //                $lignedoc->setIdDoc($documentachat->getId());
            //
            //
            //                if ($totalttc && $totalttc != "")
            //                    $lignedoc->setMntttc($totalttc);
            //
            //                if ($totalhax && $totalhax != "")
            //                    $lignedoc->setMntht($totalhax);
            //
            //                if ($totalhtva && $totalhtva != "")
            //                    $lignedoc->setMnttva($totalhtva);
            //                $lignedoc->setNordre($norgdre);
            //
            //                $lignedoc->setQte($qte);
            //                if ($observation && $observation != "")
            //                    $lignedoc->setObservation($observation);
            ////                if ($unitedemander && $unitedemander != "")
            ////                    $lignedoc->setUnitedemander($unitedemander);
            ////                if ($idunitemarche && $idunitemarche != "")
            ////                    $lignedoc->setIdUnitemarche($idunitemarche);
            //                if ($codearticle)
            //                    $lignedoc->setCodearticle($codearticle);
            //                if ($designation)
            //                    $lignedoc->setDesignationarticle($designation);
            //
            //                //____________________________________rech article en stock
            //                if ($codearticle != "" && $designation != "") {
            //                    $article = Doctrine_Core::getTable('article')->findOneByCodeartAndDesignation($codearticle, $designation);
            //                    if ($article)
            //                        $lignedoc->setIdArticlestock($article->getId());
            //                }
            //                //_____________________________________Fin recherche
            //                if ($idprojet != '')
            //                    $lignedoc->setIdProjet($idprojet);
            ////                if ($motif != '')
            ////                    $lignedoc->setImpbudget($motif);
            //                //___________________________________rech motif par budget et par projet
            ////                if ($idprojet != "" && $mid != "") {
            ////                    $motifparprojet = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubriqueAndIdProjet($mid, $idprojet);
            ////                    if ($motifparprojet)
            ////                        $lignedoc->setCodebudget($motifparprojet->getId());
            ////                }
            //                $lignedoc->save();
            //                $documentachat->setMht($lignedoc->getMntht());
            //                $documentachat->setMnttva($lignedoc->getMnttva());
            //                $documentachat->setMntttc($lignedoc->getMntttc());
            //                $documentachat->setIdDocparent($doc_parent->getFirst()->getId());
            //
            //
            //
            //                $lignedocqte = new Qtelignedoc();
            //                $lignedocqte->setQtedemander($qte);
            //                $lignedocqte->setIdLignedocachat($lignedoc->getId());
            //                $lignedocqte->save();
            //                $ErpHistorique = new Erphistorique();
            //                $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
            //            }

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
                //$lignedoc->setEtatligne("EnCours");
                if ($designation != "") {
                    $lignedoc->setDesignationarticle($designation);
                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
                    if ($article) {
                        $lignedoc->setIdArticlestock($article->getId());
                        $lignedoc->setCodearticle($article->getCodeart());
                    }
                }
                $lignedoc->setQte($qte);
                //                $lignedoc->setMntht($puht);
                if ($idtva)
                    $tva = Doctrine_Core::getTable('tva')->findOneById($idtva);
                //                $mntht+=$qte * $puht;
                $mntht += $totalhax;
                //                if ($tva) {
                //                    $prixttc = $puht * (1 + ($tva->getValeurtva() / 100));
                //                    $mnttva = $prixttc - $puht;
                //                    $lignedoc->setMntttc($prixttc);
                //                    $mntttc+=$qte * $prixttc;
                //                    $lignedoc->setMnttva($mnttva);
                //                    $pttva+=$qte * $mnttva;
                //                }
                if ($totalhax && $totalhax != "")
                    $lignedoc->setMntht($totalhax);
                if ($totalhtva && $totalhtva != "")
                    $lignedoc->setMntthtva($totalhtva);

                if ($totalttc && $totalttc != "")
                    $lignedoc->setMntttc($totalttc);
                if ($totalhax)
                    $lignedoc->setMntht($totalhax);
                //if ($idtva)
                $lignedoc->setIdTva($idtva);
                if ($totalttc && $totalhtva)
                    $mnttva = $totalttc - $totalhtva;
                $montanttotaltva += $mnttva;
                //                $mntttc+=$qte * $totalttc;
                if ($mnttva)
                    $lignedoc->setMnttva($mnttva);
                if ($totalhtva)
                    $lignedoc->setMntthtva($totalhtva);
                if ($fodec)
                    $lignedoc->setMntfodec($fodec);
                $montanttotalfodec += $fodec;
                if ($taufodec)
                    $lignedoc->setIdTauxfodec($taufodec);
                $lignedoc->setObservation($observation);
                //                 $lignedoc->set
                $lignedoc->save();
                $qteligne = new Qtelignedoc();
                $qteligne->setIdLignedocachat($lignedoc->getId());
                $qteligne->setQtelivrefrs($qte);
                $qteligne->save();
                $ErpHistorique = new Erphistorique();
                $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
            }

            $documentachat->setMht($mntht);

            //            $documentachat->setMnttva($pttva);

            $documentachat->setMht($mntht);
            $total_ttc = $montanttotaltva + $mntht + $montanttotalfodec;

            if ($montanttotaltva)
                $documentachat->setMnttva($montanttotaltva);
            if ($montanttotalfodec)
                $documentachat->setMntfodec($montanttotalfodec);
            if ($total_ttc_bdc)
                $documentachat->setMntttc($total_ttc_bdc);
            $documentachat->save();


            $documentachat->save();
            $ErpHistorique = new Erphistorique();
            $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);
            die("/iddoc/" . $documentachat->getId());
        }
    }

    public function executeTestexistancereference(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $code = $params['code'];
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT  documentachat.id as id ,"
                    . " documentachat.reference as reference "
                    . " FROM documentachat"
                    . " WHERE  trim(documentachat.reference) ='" . $code . "'"
                    . " and documentachat.reference is not null and documentachat.reference != ''";

            $resultat = $conn->fetchAssoc($query);
            $resultat = json_encode($resultat);
            die($resultat);
        }

        die("Erreur");
    }

    public function executeTestexistancomptecomptable(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $code = $params['idfrs'];
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT  fournisseur.id as id ,"
                    . " fournisseur.id_plancomptable as id_compte, fournisseur.matriculefiscale as matriculefiscale "
                    . " FROM fournisseur"
                    . " WHERE  fournisseur.id =" . $code . "";
            $resultat = $conn->fetchAssoc($query);
            $resultat = json_encode($resultat);
            die($resultat);
        }

        die("Erreur");
    }

    //________________________________________________________Valider Visa et passer a la processus suivant
    public function executeValidervisa(sfWebRequest $request) {
        //        die( 'id='.$request->getParameter('iddoc'));
        if ($request->getParameter('iddoc')) {
            $iddoc = $request->getParameter('iddoc');
            Doctrine_Query::create()
                    ->update('documentachat')
                    ->set('id_etatdoc', '?', 10)
                    ->where('id=' . $iddoc)
                    ->execute();
            $this->redirect('documentachat/showdocument?iddoc=' . $iddoc);
        }
        $this->redirect('@documentachat');
    }

    //__________________________________________________Afficher document
    public function executeShowdocument(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')
                        ->createQuery('a')
                        ->where('id_doc=' . $iddoc)->orderBy('id asc')->execute();
        //Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

    public function executeShowdocumentBCIcontrat(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')
                        ->createQuery('a')
                        ->where('id_doc=' . $iddoc)->orderBy('id asc')->execute();
        //Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

    //__________________________________________________Envoie fiche vers stock et patrimoine
    public function executeEnvoistock(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        if ($request->getParameter('iddoc') && $request->getParameter('btn')) {
            //______________________________Mis a jour document
            $documentachat = new Documentachat();
            $da = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('iddoc'));
            if ($da) {
                $documentachat = $da;
                $documentachat->setIdEtatdoc(2);
                $documentachat->save();
            }
            $this->redirect('@documentachat');
        }
        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

    //__________________________________________________Envoie fiche vers budget
    public function executeEnvoibudget(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        if ($request->getParameter('iddoc') && $request->getParameter('btn')) {
            //______________________________Mis a jour document
            $documentachat = new Documentachat();
            $da = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('iddoc'));
            if ($da) {
                $documentachat = $da;
                $documentachat->setIdEtatdoc(3);
                $documentachat->save();
            }
            $this->redirect('@documentachat');
        }
        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

    //__________________________________________________________________________Supprimer fiche et ligne document d'achat
    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        //        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
        $iddoc = $request->getParameter('id');
        //        //_________suppr. ligne doc
        //        Doctrine_Query::create()->delete('lignedocachat')
        //                ->where('id_doc=' . $iddoc)->execute();

        $documentachat = DocumentachatTable::getInstance()->find($iddoc);

        //Suppression All Lignedocachat && Qtelignedoc
        foreach ($documentachat->getLignedocachat() as $lignedocachat) {
            foreach ($lignedocachat->getQtelignedoc() as $qtelignedoc) {
                $qtelignedoc->delete();
            }
            $lignedocachat->delete();
        }

        //Suppression All ligavisdoc
        foreach ($documentachat->getLigavisdoc() as $ligavisdoc) {
            $ligavisdoc->delete();
        }

        $this->forward404Unless($documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id'))), sprintf('Object fiche does not exist (%s).', $request->getParameter('id')));
        $documentachat->delete();

        $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        $this->redirect('@documentachat');
    }

    public function executeDeleteBDcNull(sfWebRequest $request) {

        $iddoc = $request->getParameter('id');
        $documentachat = DocumentachatTable::getInstance()->find($iddoc);
        $doc_parent = DocumentparentTable::getInstance()->findOneByIdDocumentachat($iddoc);
        if ($doc_parent)
            $doc_parent->delete();
        //Suppression All Lignedocachat && Qtelignedoc
        if (sizeof($documentachat->getLignedocachat()) >= 1) :
            foreach ($documentachat->getLignedocachat() as $lignedocachat) {
                foreach ($lignedocachat->getQtelignedoc() as $qtelignedoc) {
                    $qtelignedoc->delete();
                }
                $lignedocachat->delete();
            }
        endif;
        $this->forward404Unless($documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id'))), sprintf('Object fiche does not exist (%s).', $request->getParameter('id')));
        $documentachat->delete();

        //   $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        // $this->redirect('Documents/indexfrsBDCNull/idtype/17');
        header("Location: Documents/indexfrsBDCNull/idtype/17");
    }

    //__________________________________________________Ajouter visa bci et transformer bce
    public function executeRempliretexporter(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        if ($request->getParameter('iddoc') && $request->getParameter('btn')) {
            //______________________________Mis a jour document
            $documentachat = new Documentachat();
            $da = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('iddoc'));
            if ($da) {
                $documentachat = $da;
                $documentachat->setIdEtatdoc(3);
                $documentachat->save();
            }
            $this->redirect('@documentachat');
        }
        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')
                        ->createQuery('a')
                        ->where('id_doc=' . $iddoc)->orderBy('id asc')->execute();
    }

    public function executeAjoutervisa(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $idvisa = $params['idvisa'];
            $datevisa = $params['datevisa'];
            $etatvalide = $params['etatvisa'];
            $motif = $params['motif'];
            if ($idvisa != 0) {
                $lignevisadoc = new Ligavissig();
                $ligne = Doctrine_Core::getTable('ligavissig')->findOneByIdDocAndIdVisa($iddoc, $idvisa);
                if ($ligne)
                    $lignevisadoc = $ligne;
                $lignevisadoc->setIdDoc($iddoc);
                $lignevisadoc->setIdVisa($idvisa);
                $lignevisadoc->setDatevisa($datevisa);
                if ($etatvalide == '0') {
                    $lignevisadoc->setEtatvalide(false);
                }
                if ($etatvalide == '1') {
                    $lignevisadoc->setEtatvalide(true);
                }
                if ($etatvalide == '2') {
                    $lignevisadoc->setEtatvalide(false);
                }
                $lignevisadoc->save();

                $documentachat = DocumentachatTable::getInstance()->find($iddoc);
                if ($documentachat->getIdTypedoc() == 6) {
                    if ($etatvalide == '0') {
                        $documentachat->setIdEtatdoc(33);
                    }
                    if ($etatvalide == '1') {
                        $documentachat->setIdEtatdoc(23);
                    }
                    if ($etatvalide == '2') {
                        $documentachat->setIdEtatdoc(34);
                    }
                    $documentachat->save();
                }
                if ($documentachat->getIdTypedoc() == 9) {
                    if ($etatvalide == '0') {
                        $documentachat->setIdEtatdoc(33);
                    }
                    if ($etatvalide == '1') {
                        $documentachat->setIdEtatdoc(41);
                    }
                    if ($etatvalide == '2') {
                        $documentachat->setIdEtatdoc(34);
                    }
                    $documentachat->save();
                }
                if ($etatvalide == '0') {
                    //Annulation du B.C.I
                    $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
                    //                    $documentachat->setEtatdocachat('Annulé(e)');
                    $documentachat->save();

                    $user = new Utilisateur();
                    $user = $this->getUser()->getAttribute('userB2m');

                    $annulation = new Documentachatannulation();
                    $annulation->setDateannulation(date('Y-m-d'));
                    $annulation->setIdDocumentachat($iddoc);
                    $annulation->setIdUser($user->getId());
                    $annulation->setMotifannulation($motif);
                    //                    $annulation->setUrldocumentscan('');
                    //                    $annulation->setValideBudget(true);
                    $annulation->save();
                }
                if ($etatvalide == '2') {
                    //Annulation du B.C.I
                    $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
                    $documentachat->setEtatdocachat('Imputation Budgétaire refusé(e)');
                    $documentachat->save();
                }
            }
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT  visaachat.chemin, CONCAT(visaachat.libelle,'',agents.nomcomplet) as ag, "
                    . " ligavissig.id,ligavissig.datevisa, ligavissig.etatvalide "
                    . "FROM   documentachat, visaachat, ligavissig, agents "
                    . "WHERE  visaachat.id_agent = agents.id "
                    . "AND  ligavissig.id_visa = visaachat.id "
                    . "AND  ligavissig.id_doc = documentachat.id "
                    . "AND documentachat.id=" . $iddoc;

            $listevisadoc = $conn->fetchAssoc($query);
            die(json_encode($listevisadoc));
        }
        die('bien');
    }

    public function executeChargerVisa(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT  visaachat.chemin, CONCAT(visaachat.libelle,'',agents.nomcomplet) as ag, "
                    . " ligavissig.id,ligavissig.datevisa, ligavissig.etatvalide "
                    . "FROM   documentachat, visaachat, ligavissig, agents "
                    . "WHERE  visaachat.id_agent = agents.id "
                    . "AND  ligavissig.id_visa = visaachat.id "
                    . "AND  ligavissig.id_doc = documentachat.id "
                    . "AND documentachat.id=" . $iddoc;

            $listevisadoc = $conn->fetchAssoc($query);
            die(json_encode($listevisadoc));
        }
    }

    //________________________________________________________________________Chois des article a partir document achat
    public function executeChoisarticle(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $designation = $params['designation'];

            $query = "select lignedocachat.id,designationarticle as name,qtelignedoc.qteaachat as ref "
                    . " from lignedocachat,qtelignedoc"
                    . " where id_doc=" . $iddoc . " and qtelignedoc.id_lignedocachat=lignedocachat.id";
            if ($designation != "")
                $query .= " and designationarticle like '%" . $designation . "%' ";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die('Erreur ....!!!');
    }

    //_________________________________________________Ajouter nouveau fiche demande de prix par type: BCI
    public function executeSavedocumentprix(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $iddoc = explode(',', $iddoc);
            $delai = $params['delai'];
            $datemax = date('Y-m-d', strtotime($params['datemax']));
            $ref = $params['ref'];
            $numero_dp = $params['numerodoc'];
            $operation_dps = $params['operation_dps'];
            $listeslignesdoc = $params['listearticle'];
            $numerodossier = $params['numerodossier'];
            $lieu = $params['idlieu'];
            $frs = $params['frs'];
            $objet = $params['objet'];

            $frs = explode(',', $frs);

            for ($k = 0; $k < sizeof($frs); $k++) {
                if ($frs[$k] != '') {
                    $fournisseur = FournisseurTable::getInstance()->find($frs[$k]);

                    $achat = new Documentachat();
                    $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc[0]);
                    $achat = $achat_document;
                    //______________________ajouter document demande de prix
                    $documentachat = new Documentachat();
                    $documentachat->setNumero($numero_dp);
                    $documentachat->setNumerooperation($operation_dps);
                    if ($numerodossier && $numerodossier != "")
                        $documentachat->setNumerodossier($numerodossier);
                    if ($lieu && $lieu != 0) {
                        $documentachat->setIdLieu($lieu);
                    }
                    $documentachat->setIdFrs($fournisseur->getId());
                    $documentachat->setIdTypedoc(8);
                    $documentachat->setIdDocparent($achat->getId());
                    $documentachat->setReference($achat->getReference());
                    if ($objet)
                        $documentachat->setObservation($objet);
                    $documentachat->setIdUser($user->getId());
                    $documentachat->setIdEtatdoc(10);
                    $documentachat->setDatecreation(date('Y-m-d'));
                    $documentachat->setDelaifrs($delai);

                    if ($ref && $ref != "")
                        $documentachat->setReference($ref);

                    $documentachat->setMaxreponsefrs($datemax);
                    $documentachat->save();

                    //Documents Parents
                    for ($i = 0; $i < sizeof($iddoc); $i++) {
                        $document_parent = new Documentparent();
                        $document_parent->setIdDocumentachat($documentachat->getId());
                        $document_parent->setIdDocumentparent($iddoc[$i]);

                        $document_parent->save();
                    }

                    foreach ($listeslignesdoc as $ldoc) {
                        $norgdre = $ldoc['norgdre'];
                        $designation = $ldoc['designation'];
                        $qte = $ldoc['qte'];
                        $observation = $ldoc['observation'];

                        $unite = $ldoc['unitedemander'];
                        $id_unitemarche = $ldoc['id_unitemarche'];
                        $id_projet = $ldoc['id_projet'];

                        $lignedoc = new Lignedocachat();
                        $lignedoc->setIdDoc($documentachat->getId());
                        $lignedoc->setNordre($norgdre);
                        $lignedoc->setQte($qte);
                        if ($unite && $unite != "")
                            $lignedoc->setUnitedemander($unite);
                        if ($id_unitemarche && $id_unitemarche != "")
                            $lignedoc->setIdUnitemarche($id_unitemarche);
                        if ($id_projet && $id_projet != "")
                            $lignedoc->setIdProjet($id_projet);
                        $lignedoc->setDesignationarticle($designation);
                        if ($observation)
                            $lignedoc->setObservation($observation);
                        $lignedoc->save();

                        $qteachat = new Qtelignedoc();
                        $qteachat->setIdLignedocachat($lignedoc->getId());
                        $qteachat->setQteaachat($qte);
                        $qteachat->save();
                        $ErpHistorique = new Erphistorique();
                        $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
                    }

                    $ErpHistorique = new Erphistorique();
                    $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);


                    $numero_dp = $numero_dp + 1;
                    $numero_dp = str_pad($numero_dp, 8, '0', STR_PAD_LEFT);
                }
            }
            die("Demande de prix créée avec succès");
        }

        die('Erreur .....!!!!');
    }

    //_____________________________________________________Liste document demande de prix
    public function executeListedemandeprix(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $documentfils = Doctrine_Core::getTable('documentachat')->findOneByIdDocparent($iddoc);
            $query = "select CONCAT(fournisseur.rs,' ----Nom&Prenom Responsable:   ',fournisseur.nom,fournisseur.prenom) as rs, documentachat.etatdocachat,  documentachat.id,documentachat.numero"
                    . " from fournisseur,documentachat"
                    . " where documentachat.id_typedoc=8 and  documentachat.id_frs = fournisseur.id and documentachat.id_docparent=" . $iddoc;
            // die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
    }

    //_____________________________________________________Liste document demande de prix
    public function executeListedemandeprixByDocs(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $iddoc = explode(',', $iddoc);

            $query = "select CONCAT(fournisseur.rs,' ----Nom&Prenom Responsable:   '"
                    . ",fournisseur.nom,fournisseur.prenom) as rs"
                    . ", documentachat.etatdocachat,  documentachat.id"
                    . ", CONCAT(documentachat.numero, '/', documentachat.numerooperation) as numero"
                    . " from fournisseur,documentachat"
                    . " where documentachat.id_typedoc=8 and  documentachat.id_frs = fournisseur.id and documentachat.id_docparent IN (" . implode(',', array_map('intval', $iddoc)) . ")";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
    }

    //__________________________________________________________________________Liste bon de deponse Listebondeponse
    public function executeListebondeponse(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $iddoc = explode(',', $iddoc);
//            // $documentfils = Doctrine_Core::getTable('documentachat')->findOneByIdDocparent($iddoc);
//            $query = "select typedoc.id as idtypedoc,"
//                    //  . ", CONCAT(fournisseur.rs,' ----Nom du Responsable:   '"
//                    // . " ,fournisseur.nom,fournisseur.prenom) as rs,"
//                    . "  documentachat.etatdocachat, documentachat.mntttc as montant, "
//                    . " documentachat.id,documentachat.numero, typedoc.libelle as typedoc"
//                    . " , SUM(documentachat.mntttc  ) as montanttotal"
//                    . " from documentachat,typedoc,documentparent "
//                    . " where  (documentachat.id_typedoc=17 or  documentachat.id_typedoc=2 )  "
//                    . "and typedoc.id=documentachat.id_typedoc "
//                    //. "and  documentachat.id_frs = fournisseur.id "
//                    . "and documentachat.id = documentparent.id_documentachat "
//                    . "and documentparent.id_documentparent IN (" . implode(',', array_map('intval', $iddoc)) . ") "
//                    . " group by (documentachat.id, typedoc.id)";
//            // . "and documentachat.id not in(select id_fils from documentachat where id_typedoc=2  )";                       

            $q = Doctrine_Core::getTable('Documentachat')
                    ->createQuery('a')
                    ->select("a.*"
                            . " ,ty.id as idtypedoc, CONCAT(frs.rs,' ----Nom du Responsable:   '"
                            . " ,frs.nom,frs.prenom) as rs,"
                            . "  a.etatdocachat, a.mntttc as montant, "
                            . " a.id,a.numero, ty.libelle as typedoc")
                    ->from('Documentachat a')
                    ->LeftJoin('a.Fournisseur frs  ')
                    ->LeftJoin('a.Typedoc ty  ')
                    ->LeftJoin('a.Documentparent dc')
                    ->where('(a.id_typedoc=17 or a.id_typedoc=2)')
                    ->andwhere("dc.id_documentparent IN (" . implode(',', array_map('intval', $iddoc)) . ")")
                    // ->groupBy('a.id , ty.id , frs.id , dc.id')
                    ->orderBy('a.id ')
            ;
            //die($q);
            $parcc = $q->fetchArray();
//            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
    }

    public function executeListebondeponseRegroupe(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $iddoc = explode(',', $iddoc);
            $query = "select typedoc.id as idtypedoc, documentachat.etatdocachat, "
                    . " documentachat.mntttc as montant, "
                    . " documentachat.id,documentachat.numero, typedoc.libelle as typedoc"
                    . " , SUM(documentachat.mntttc  ) as montanttotal"
                    . " from documentachat,typedoc,documentparent "
                    . " where  (documentachat.id_typedoc=21  or  documentachat.id_typedoc=22 )"
                    . "and typedoc.id=documentachat.id_typedoc "
                    . "and documentachat.id = documentparent.id_documentachat "
                    . "and documentparent.id_documentparent IN (" . implode(',', array_map('intval', $iddoc)) . ") "
                    . " group by (documentachat.id, typedoc.id)";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
    }

    public function executeListebondeponseRegroupeProvisore(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $iddoc = explode(',', $iddoc);
            $query = "select  typedoc.id as id_tye, documentachat.id,documentachat.numero, typedoc.libelle as typedoc"
                    . " from documentachat,typedoc "
                    . " where  documentachat.id_typedoc=21   "
                    . "and typedoc.id=documentachat.id_typedoc "
                    //                    . "and  documentachat.id_frs = fournisseur.id "
                    //                    . "and documentachat.id = documentparent.id_documentachat "
                    . "and documentachat.id_docparent IN (" . implode(',', array_map('intval', $iddoc)) . ") ";
            //                    . " group by (documentachat.id, typedoc.id, fournisseur.rs, fournisseur.nom, fournisseur.prenom)";
            // . "and documentachat.id not in(select id_fils from documentachat where id_typedoc=2  )";
            //die($query);

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
    }

    public function executeAfficheMontanttotal(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $mnttotal = '0.000';
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $iddoc = explode(',', $iddoc);
            $query = "select COALESCE(SUM(documentachat.mntttc) ,0) as montanttotal"
                    . " from fournisseur,documentachat,typedoc,documentparent "
                    //                    . " where (documentachat.id_typedoc=2 or documentachat.id_typedoc=17)   "
                    . " where  documentachat.id_typedoc=17   "
                    . "and typedoc.id=documentachat.id_typedoc "
                    . "and  documentachat.id_frs = fournisseur.id "
                    . "and documentachat.id = documentparent.id_documentachat "
                    . "and documentparent.id_documentparent IN (" . implode(',', array_map('intval', $iddoc)) . ") ";
            ;
            // . "and documentachat.id not in(select id_fils from documentachat where id_typedoc=2  )";
            // die($query);

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            return $this->renderText(json_encode($parcc[0]));
        }
        return $this->renderText(json_encode(['msg' => 'error']));
    }

    //__________________________________________________________________________Liste bon de deponse Listebondeponse
    public function executeListebcommandeexterne(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $iddoc = explode(',', $iddoc);
            // $documentfils = Doctrine_Core::getTable('documentachat')->findOneByIdDocparent($iddoc);
            $query = "select typedoc.id as idtypedoc, "
                    . "CONCAT(fournisseur.rs,' ----Nom du Responsable: ',fournisseur.nom,fournisseur.prenom) as rs, fournisseur.id as id_fournisseur, documentachat.id,documentachat.numero, typedoc.prefixetype as typedoc"
                    . " from fournisseur,documentachat,typedoc,documentparent "
                    . " where (documentachat.id_typedoc=18) "
                    . "and typedoc.id=documentachat.id_typedoc "
                    . "and documentachat.id_frs = fournisseur.id "
                    . "and documentachat.id = documentparent.id_documentachat "
                    . "and documentparent.id_documentparent IN (" . implode(',', array_map('intval', $iddoc)) . ") "
                    . " group by (documentachat.id, typedoc.id, fournisseur.rs, fournisseur.nom, fournisseur.prenom, fournisseur.id)";
            // . "and documentachat.id not in(select id_fils from documentachat where id_typedoc=2)";
            //die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
    }

    //__________________________________________________________________________Liste bon de commande externe
    public function executeListebonexterne(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $iddoc = explode(',', $iddoc);
            //            $documentfils = Doctrine_Core::getTable('documentachat')->findOneByIdDocparent($iddoc);
            $query = "select typedoc.id as idtypedoc, typedoc.libelle as libelletypedoc, CONCAT(fournisseur.rs,' ----Nom&Prenom Responsable:   ',fournisseur.nom,fournisseur.prenom) as rs"
                    . ",documentachat.etatdocachat as atrb, "
                    . "documentachat.etatdocachat, documentachat.id,documentachat.numero"
                    . " from fournisseur,documentachat,typedoc,documentparent"
                    . " where documentachat.id_typedoc=typedoc.id and "
                    . "(documentachat.id_typedoc=7 or documentachat.id_typedoc=18) "
                    . "and documentachat.id_frs = fournisseur.id "
                    . "and documentachat.id_docparent IN (" . implode(',', array_map('intval', $iddoc)) . ") "
                    . " group by (documentachat.id, typedoc.id, fournisseur.rs, fournisseur.nom, fournisseur.prenom)";
            //  die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
    }

    public function executeAfficheatributionbudget(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $p = "";
            $pie = new Piecejointbudget();
            $piece = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($iddoc);
            if ($piece) {
                $pie = $piece;

                $p = html_entity_decode($pie->getDocumentbudget()->getLigprotitrub());
            }
            die($p);
        }
    }

    //__________________________________________________________________________Liste bon de commande interne
    public function executeListeboninterne(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $texte = strtoupper($params['recherche']);
            if ($texte != "")
                $query = "SELECT documentachat.id as ref,"
                        . "concat( documentachat.datecreation,'-', typedoc.prefixetype,LPAD(documentachat.numero::text, 7, '0'),'-',  trim( documentachat.reference),'-', agents.nomcomplet) as name "
                        . "FROM    documentachat,   agents,typedoc "
                        . "WHERE   documentachat.id_demandeur = agents.id and documentachat.id_typedoc=typedoc.id and typedoc.id=6 "
                        . "and   (documentachat.numero::text like '%" . $texte . "%' or upper(documentachat.reference) like '%" . $texte . "%' "
                        . "or documentachat.datecreation::text like '%" . $texte . "%' "
                        . "or upper(agents.nomcomplet) like '%" . $texte . "%')";
            else
                $query = "SELECT documentachat.id as ref,"
                        . "concat( documentachat.datecreation,'-', typedoc.prefixetype,LPAD(documentachat.numero::text, 7, '0'),'-',  trim( documentachat.reference),'-', agents.nomcomplet) as name "
                        . "FROM    documentachat,   agents,typedoc "
                        . "WHERE   "
                        . "documentachat.id_demandeur = agents.id and documentachat.id_typedoc=typedoc.id  "
                        . "and typedoc.id=6  LIMIT 5";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
    }

    //___________________________________________________________________________Detail ligne doc Detaillignedemandeprix
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
                    . "fournisseur.rs,qtelignedoc.qteaachat, COALESCE(fournisseur.adr, '-') as adrs, "
                    . "CONCAT('E-mail : ', COALESCE(fournisseur.mail, '-'),' | Tél : ', COALESCE(fournisseur.tel,'-') ,' | Gsm : ', COALESCE(fournisseur.gsm, '-')) as annuaire  "
                    . "from fournisseur, lignedocachat, documentachat ,qtelignedoc, activitetiers "
                    . "where lignedocachat.id=qtelignedoc.id_lignedocachat "
                    . "and lignedocachat.id_doc = documentachat.id  "
                    . "AND documentachat.id_frs = fournisseur.id AND documentachat.id=" . $idlignedoc . " "
                    . " group by idligne, demandedeprixid,lignedocachat.nordre,"
                    . "lignedocachat.designationarticle, "
                    . " fournisseur.rs,annuaire,qtelignedoc.qteaachat, fournisseur.adr "
                    . " order by  lignedocachat.id asc;";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
    }

    //___________________________________________________________________________Passer le BCI(les demande de prix ) en BCE ou BCC
    public function executeEtapefinal(sfWebRequest $request) {
        if ($request->getParameter('iddoc')) {
            $iddoc = $request->getParameter('iddoc');
            $iddoc = explode(',', $iddoc);
            if ($request->getParameter('etapedoc') && $request->getParameter('etapedoc') == 10) {
                Doctrine_Query::create()
                        ->update('documentachat')
                        ->set('id_etatdoc', '?', 12)
                        ->where('id=' . $request->getParameter('iddoc'))
                        ->execute();
            }
            if ($request->getParameter('etapedoc') && $request->getParameter('etapedoc') == 9) {
                Doctrine_Query::create()
                        ->update('documentachat')
                        ->set('id_etatdoc', '?', 11)
                        ->where('id IN (' . implode(',', array_map('intval', $iddoc)) . ')')
                        ->execute();
            }
            if ($request->getParameter('etapedoc') && $request->getParameter('etapedoc') == 11) {
                Doctrine_Query::create()
                        ->update('documentachat')
                        ->set('id_etatdoc', '?', 13)
                        ->where('id=' . $request->getParameter('iddoc'))
                        ->execute();
            }
        }
        $this->redirect('documentachat/index');
    }

    //__________________________________________________________________________Expoter BDC
    public function executeExportbcc(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        $iddoc = $request->getParameter('iddoc');

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

    public function executeExportbccnull(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        $iddoc = $request->getParameter('iddoc');
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

    public function executeExportbccrp(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        $iddoc = $request->getParameter('iddoc');
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

    public function executeExportcontratdefinitif(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        $id_contrat = $request->getParameter('idcontrat');
        //        die($id_contrat);
        $contrat = Doctrine_Core::getTable('contratachat')->findOneById($id_contrat);
        $this->contrat = $contrat;
        $this->numerocomntrat = $contrat->getNumero();
        $iddoc = $request->getParameter('iddoc');
        $this->ids = $iddoc;
        $iddoc = explode(',', $iddoc);
        $this->lieuxlivraisons = Doctrine_Core::getTable('lieulivraisson')->findAll();
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc[0]);
        $this->liste_bcc = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc[0]);
        $demande_de_prix = new Documentachat(); // Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($iddoc, 7);
        $this->numerodemande = $demande_de_prix->NumeroSeqDocumentAchat(7);
        $this->numerobcep = $demande_de_prix->NumeroSeqDocumentAchat(19);
        //sprintf('%03d', count($demande_de_prix) + 1);
        $this->idbdcp = 0;

        if ($request->getParameter('idbdc'))
            $this->idbdcp = $request->getParameter('idbdc');
        $this->tab = "";
        if ($request->getParameter('tab'))
            $this->tab = $request->getParameter('tab');
        $this->liste_document_achats = DocumentachatTable::getInstance()->getByIds($iddoc);
    }

    //__________________________________________________________________________Expoter BDC
    public function executeExportcontrat(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->liste_bcc = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        $demande_de_prix = new Documentachat();
        $this->numerodemande = $demande_de_prix->getNumeroContart($this->documentachat->getId());
        $demande_de_prix_defini = $demande_de_prix->getNumeroContart($this->documentachat->getId());
        $this->numerodemande_defi = $demande_de_prix_defini;
        $this->lieuxlivraisons = Doctrine_Core::getTable('lieulivraisson')->findAll();
        $this->idbdcp = 0;
        $this->tab = "";
        if ($request->getParameter('idbdc'))
            $this->idbdcp = $request->getParameter('idbdc');
        if ($request->getParameter('tab'))
            $this->tab = $request->getParameter('tab');
    }

    //__________________________________________________________________________Expoter BCE
    public function executeExportbce(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');
        $iddoc = $request->getParameter('iddoc');
        $this->ids = $iddoc;
        $iddoc = explode(',', $iddoc);
        $this->lieuxlivraisons = Doctrine_Core::getTable('lieulivraisson')->findAll();
        $this->droitTimbre = Doctrine_Core::getTable('droittimbre')->findAll();
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc[0]);
        $this->liste_bcc = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc[0]);
        $demande_de_prix = new Documentachat(); // Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($iddoc, 7);
        $this->numerodemande = $demande_de_prix->NumeroSeqDocumentAchat(7);
        $this->numerobcep = $demande_de_prix->NumeroSeqDocumentAchat(18);
        //sprintf('%03d', count($demande_de_prix) + 1);
        $this->idbdcp = 0;
        $this->tab = "";
        if ($request->getParameter('idbdc'))
            $this->idbdcp = $request->getParameter('idbdc');
        if ($request->getParameter('tab'))
            $this->tab = $request->getParameter('tab');
        $this->liste_document_achats = DocumentachatTable::getInstance()->getByIds($iddoc);
    }

    //__________________________________________________________________________Listes des TVA
    public function executeListetva(sfWebRequest $request) {

        $listes_tva = Doctrine_Query::create()
                ->select("*")
                ->from('tva');

        $listes_tva = $listes_tva->fetchArray();
        die(json_encode($listes_tva));
    }

    public function executeListeUnite(sfWebRequest $request) {

        $listes_tva = Doctrine_Query::create()
                ->select("*")
                ->from('unitemarche');

        $listes_tva = $listes_tva->fetchArray();
        die(json_encode($listes_tva));
    }

    //____________________________________________________________________________________listes des fodec

    public function executeListetauxfodec(sfWebRequest $request) {

        $listes_tva = Doctrine_Query::create()
                ->select("*")
                ->from('tauxfodec');

        $listes_tva = $listes_tva->fetchArray();
        die(json_encode($listes_tva));
    }

    //__________________________________________________________________________Ajouter bon de deponse 
    public function executeSavebondedeponse(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $idbdcp = $params['idbdcp'];
            $iddoc = explode(',', $iddoc);
            $idfils = $params['id_fils'];
            $id_lieu = $params['id_lieu'];
            $reference = $params['reference'];
            $droit_tmibre = $params['droit_tmibre'];
            $total_ttc_bdc = $params['total_ttc_bdc'];
            $listeslignesdoc = $params['listearticle'];
            $total_htax = $params['total_htax'];
            $remisetotalvaleurHT = $params['remisetotalvaleurHT'];
            $remisetotalpourcentageHT = $params['remisetotalpourcentageHT'];
            $frs = $params['frs'];
            if ($frs != '') {
                $fournisseurs = Doctrine_Query::create()
                                ->select("*")
                                ->from('fournisseur')
                                ->where("rs like '%" . $frs . "%'")->execute();
                $fournisseur = new Fournisseur();
                if (count($fournisseurs) > 0)
                    $fournisseur = $fournisseurs[0];
            }
            $achat = new Documentachat();
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc[0]);
            $achat = $achat_document;
            //______________________ajouter document demande de prix
            $documentachat = new Documentachat();
            $numero = $documentachat->getNumeroBDCDParBCI($achat->getId());
            $documentachat->setNumero($numero);
            if ($frs != '' && count($fournisseurs) > 0)
                $documentachat->setIdFrs($fournisseur->getId());
            $documentachat->setIdTypedoc(2);
            $documentachat->setIdDocparent($achat->getId());
            if ($reference)
                $documentachat->setReference($reference);
            else
                $documentachat->setReference($achat->getReference());


            $documentachat->setIdUser($user->getId());
            $documentachat->setIdEtatdoc(27);
            $documentachat->setDatecreation(date('Y-m-d'));
            $documentachat->setDateSignature(date('Y-m-d'));

            if ($remisetotalvaleurHT)
                $documentachat->setTotalremisevaleur($remisetotalvaleurHT);
            if ($remisetotalpourcentageHT)
                $documentachat->setTotalremisehpour($remisetotalpourcentageHT);

            if ($idfils != 0) {
                $documentachat->setIdFils($idfils);
                $documentachat->save();
                // valider budget ....
                $documentachat->ExporterBudgetVersBdC($idfils);
            } else {
                $documentachat->setIdFils($idbdcp);
                $documentachat->ExporterBudgetVersBdC($idbdcp);
            }
            if ($id_lieu != '0')
                $documentachat->setIdLieu($id_lieu);
            if ($droit_tmibre != "")
                $documentachat->setDroittimbre($droit_tmibre);
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
                $idtva = $lignedoc['id_tva'];
                $observation = $lignedoc['observation'];
                $unite = $lignedoc['unitedemander'];
                $totalhtva = $lignedoc['totalhtva'];
                $fodec = $lignedoc['fodec'];
                //                $prixttc = $lignedoc['prixttc'];
                $taufodec = $lignedoc['idtaufodec'];
                $totalhax = $lignedoc['totalhax'];
                $totalhtax = $lignedoc['totalhtax'];
                $tauxremise = $lignedoc['tauxremise'];
                $totalttc = $lignedoc['totalttc'];
                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                if ($unite && $unite != "")
                    $lignedoc->setUnitedemander($unite);
                //$lignedoc->setEtatligne("EnCours");
                if ($designation != "") {
                    $lignedoc->setDesignationarticle($designation);
                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
                    if ($article) {
                        $lignedoc->setIdArticlestock($article->getId());
                        $lignedoc->setCodearticle($article->getCodeart());
                    }
                }
                $lignedoc->setQte($qte);
                //                $lignedoc->setMntht($puht);
                if ($idtva)
                    $tva = Doctrine_Core::getTable('tva')->findOneById($idtva);
                //                $mntht+=$qte * $puht;
                $mntht += $totalhax;
                //                if ($tva) {
                //                    $prixttc = $puht * (1 + ($tva->getValeurtva() / 100));
                //                    $mnttva = $prixttc - $puht;
                //                    $lignedoc->setMntttc($prixttc);
                //                    $mntttc+=$qte * $prixttc;
                //                    $lignedoc->setMnttva($mnttva);
                //                    $pttva+=$qte * $mnttva;
                //                }
//                if ($totalhax && $totalhax != "")
//                    $lignedoc->setMntht($totalhax);

                if ($totalhax && $totalhax != "")
                    $lignedoc->setMnhtaxnet($totalhax);
                if ($totalhtax && $totalhtax != "")
                    $lignedoc->setMntht($totalhtax);

                if ($totalhtva && $totalhtva != "")
                    $lignedoc->setMntthtva($totalhtva);

                if ($totalttc && $totalttc != "")
                    $lignedoc->setMntttc($totalttc);

                //if ($idtva)
                $lignedoc->setIdTva($idtva);
                if ($totalttc && $totalhtva)
                    $mnttva = $totalttc - $totalhtva;
                $montanttotaltva += $mnttva;
                //                $mntttc+=$qte * $totalttc;
                if ($mnttva)
                    $lignedoc->setMnttva($mnttva);
                if ($totalhtva)
                    $lignedoc->setMntthtva($totalhtva);
                if ($fodec)
                    $lignedoc->setMntfodec($fodec);
                $montanttotalfodec += $fodec;
                if ($taufodec)
                    $lignedoc->setIdTauxfodec($taufodec);
                $lignedoc->setObservation($observation);
                if ($tauxremise) {
                    $tauxremise = $tauxremise * 100;
                    $lignedoc->setMntremise($tauxremise);
                }
                //                 $lignedoc->set
                $lignedoc->save();
                $qteligne = new Qtelignedoc();
                $qteligne->setIdLignedocachat($lignedoc->getId());
                $qteligne->setQtelivrefrs($qte);
                $qteligne->save();
                $ErpHistorique = new Erphistorique();
                $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
            }

            $documentachat->setMht($mntht);

            //            $documentachat->setMnttva($pttva);

            $documentachat->setMht($mntht);
            $total_ttc = $montanttotaltva + $mntht + $montanttotalfodec;

//            if ($total_ttc)
//                $documentachat->setMntttc($total_ttc);
            if ($total_ttc_bdc)
                $documentachat->setMntttc($total_ttc_bdc);
            if ($total_htax)
                $documentachat->setMht($total_htax);
            if ($montanttotaltva)
                $documentachat->setMnttva($montanttotaltva);
            if ($montanttotalfodec)
                $documentachat->setMntfodec($montanttotalfodec);
            $documentachat->save();
            return $this->renderText(json_encode(array(
                        'idbdc' => $documentachat->getId(),
                        'tab' => '4'
            )));
        }
        return $this->renderText(json_encode(array(
                    'error' => 'ERROR'
        )));
    }

    public function executeSavebondedeponseRegroupe(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $idbdcp = $params['idbdcp'];
            $iddoc = explode(',', $iddoc);
            $idfils = $params['id_fils'];
            $id_lieu = $params['id_lieu'];
            $droit_tmibre = $params['droit_tmibre'];
            $total_ttc_bdc = $params['total_ttc_bdc'];
            $quitance_def_bdcr = $params['quitance_def_bdcr'];
            $listeslignesdoc = $params['listearticle'];
            $frs = $params['frs'];
            $achat = new Documentachat();
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc[0]);
            $achat = $achat_document;
            //______________________ajouter document demande de prix
            $documentachat = new Documentachat();
            $numero = $documentachat->getNumeroBDCDParBCI($achat->getId());
            $documentachat->setNumero($numero);
            if ($frs != '' && count($fournisseurs) > 0)
                $documentachat->setIdFrs($fournisseur->getId());
            $documentachat->setIdTypedoc(22);
            $documentachat->setIdDocparent($achat->getId());
            $documentachat->setReference($achat->getReference());
            $documentachat->setIdUser($user->getId());
            $documentachat->setIdEtatdoc(63);
            $documentachat->setDatecreation(date('Y-m-d'));
            $documentachat->setDateSignature(date('Y-m-d'));
            if ($idfils != 0) {
                $documentachat->setIdFils($idfils);
                $documentachat->save();
                // valider budget ....
                //                $documentachat->ExporterBudgetVersBdC($idfils);
            } else {
                $documentachat->setIdFils($idbdcp);
                //                $documentachat->ExporterBudgetVersBdC($idbdcp);
            }
            if ($id_lieu != '0')
                $documentachat->setIdLieu($id_lieu);
            if ($droit_tmibre != "")
                $documentachat->setDroittimbre($droit_tmibre);
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
                $idtva = $lignedoc['id_tva'];
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
                //$lignedoc->setEtatligne("EnCours");
                if ($designation != "") {
                    $lignedoc->setDesignationarticle($designation);
                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
                    if ($article) {
                        $lignedoc->setIdArticlestock($article->getId());
                        $lignedoc->setCodearticle($article->getCodeart());
                    }
                }
                $lignedoc->setQte($qte);
                //                $lignedoc->setMntht($puht);
                if ($idtva)
                    $tva = Doctrine_Core::getTable('tva')->findOneById($idtva);
                //                $mntht+=$qte * $puht;
                $mntht += $totalhax;
                //                if ($tva) {
                //                    $prixttc = $puht * (1 + ($tva->getValeurtva() / 100));
                //                    $mnttva = $prixttc - $puht;
                //                    $lignedoc->setMntttc($prixttc);
                //                    $mntttc+=$qte * $prixttc;
                //                    $lignedoc->setMnttva($mnttva);
                //                    $pttva+=$qte * $mnttva;
                //                }
                if ($totalhax && $totalhax != "")
                    $lignedoc->setMntht($totalhax);
                if ($totalhtva && $totalhtva != "")
                    $lignedoc->setMntthtva($totalhtva);

                if ($totalttc && $totalttc != "")
                    $lignedoc->setMntttc($totalttc);
                if ($totalhax)
                    $lignedoc->setMntht($totalhax);
                //if ($idtva)
                $lignedoc->setIdTva($idtva);
                if ($totalttc && $totalhtva)
                    $mnttva = $totalttc - $totalhtva;
                $montanttotaltva += $mnttva;
                //                $mntttc+=$qte * $totalttc;
                if ($mnttva)
                    $lignedoc->setMnttva($mnttva);
                if ($totalhtva)
                    $lignedoc->setMntthtva($totalhtva);
                if ($fodec)
                    $lignedoc->setMntfodec($fodec);
                $montanttotalfodec += $fodec;
                if ($taufodec)
                    $lignedoc->setIdTauxfodec($taufodec);
                $lignedoc->setObservation($observation);
                //                 $lignedoc->set
                $lignedoc->save();
                $qteligne = new Qtelignedoc();
                $qteligne->setIdLignedocachat($lignedoc->getId());
                $qteligne->setQtelivrefrs($qte);
                $qteligne->save();
                $ErpHistorique = new Erphistorique();
                $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
            }

            $documentachat->setMht($mntht);
            //          if($total_ttc_bdc)
            //            $documentachat->setMntttc($total_ttc_bdc);
            //            $documentachat->setMnttva($pttva);

            $documentachat->setMht($mntht);
            $total_ttc = $montanttotaltva + $mntht + $montanttotalfodec;
            if ($droit_tmibre == "1")
                $total_ttc = $total_ttc + 0.600;
            if ($total_ttc)
                $documentachat->setMntttc($total_ttc);
            if ($montanttotaltva)
                $documentachat->setMnttva($montanttotaltva);
            if ($montanttotalfodec)
                $documentachat->setMntfodec($montanttotalfodec);
            if ($quitance_def_bdcr)
                $documentachat->setMntttc($quitance_def_bdcr);
            $documentachat->save();
            $ErpHistorique = new Erphistorique();
            $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);
            die("Bon de dépenses aux comptant Regroupe crée avec succès");
        }
        die('Erreur .....!!!!');
    }

    public function executeSavebondedeponseDef(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $idbdcp = $params['idbdcp'];
            $iddoc = explode(',', $iddoc);
            $idfils = $params['id_fils'];
            $id_lieu = $params['id_lieu'];
            $droit_tmibre = $params['droit_tmibre'];

            $total_ttc_bdc = $params['total_ttc_bdc'];
            $listeslignesdoc = $params['listearticle'];
            $frs = $params['frs'];
            //            if ($frs != '') {
            //                $fournisseurs = Doctrine_Query::create()
            //                                ->select("*")
            //                                ->from('fournisseur')
            //                                ->where("rs like '%" . $frs . "%'")->execute();
            //                $fournisseur = new Fournisseur();
            //                if (count($fournisseurs) > 0)
            //                    $fournisseur = $fournisseurs[0];
            //                else {
            //                    $fournisseur->setRs($frs);
            //                    $fournisseur->save();
            //                }
            //            }
            $achat = new Documentachat();
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc[0]);
            $achat = $achat_document;
            //______________________ajouter document demande de prix
            $documentachat = new Documentachat();
            $numero = $documentachat->getNumeroBDCDParBCI($achat->getId());
            $documentachat->setNumero($numero);
            if ($frs != '')
                $documentachat->setIdFrs($frs);
            $documentachat->setIdTypedoc(2);
            $documentachat->setIdDocparent($achat->getId());
            $documentachat->setReference($achat->getReference());
            $documentachat->setIdUser($user->getId());
            $documentachat->setIdEtatdoc(60);
            $documentachat->setDatecreation(date('Y-m-d'));
            $documentachat->setDateSignature(date('Y-m-d'));
            if ($idfils != 0) {
                $documentachat->setIdFils($idfils);
                $documentachat->save();
                // valider budget ....
                $documentachat->ExporterBudgetVersBdCNULL($idfils);
            } else {
                $documentachat->setIdFils($idbdcp);
                $documentachat->ExporterBudgetVersBdCNULL($idbdcp);
            }
            if ($id_lieu != '0')
                $documentachat->setIdLieu($id_lieu);
            if ($droit_tmibre != "")
                $documentachat->setDroittimbre($droit_tmibre);
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
                $idtva = $lignedoc['id_tva'];
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
                //$lignedoc->setEtatligne("EnCours");
                if ($designation != "") {
                    $lignedoc->setDesignationarticle($designation);
                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
                    if ($article) {
                        $lignedoc->setIdArticlestock($article->getId());
                        $lignedoc->setCodearticle($article->getCodeart());
                    }
                }
                $lignedoc->setQte($qte);
                //                $lignedoc->setMntht($puht);
                if ($idtva)
                    $tva = Doctrine_Core::getTable('tva')->findOneById($idtva);
                //                $mntht+=$qte * $puht;
                $mntht += $totalhax;
                //                if ($tva) {
                //                    $prixttc = $puht * (1 + ($tva->getValeurtva() / 100));
                //                    $mnttva = $prixttc - $puht;
                //                    $lignedoc->setMntttc($prixttc);
                //                    $mntttc+=$qte * $prixttc;
                //                    $lignedoc->setMnttva($mnttva);
                //                    $pttva+=$qte * $mnttva;
                //                }
                if ($totalhax && $totalhax != "")
                    $lignedoc->setMntht($totalhax);
                if ($totalhtva && $totalhtva != "")
                    $lignedoc->setMntthtva($totalhtva);

                if ($totalttc && $totalttc != "")
                    $lignedoc->setMntttc($totalttc);
                if ($totalhax)
                    $lignedoc->setMntht($totalhax);
                //if ($idtva)
                $lignedoc->setIdTva($idtva);
                if ($totalttc && $totalhtva)
                    $mnttva = $totalttc - $totalhtva;
                $montanttotaltva += $mnttva;
                //                $mntttc+=$qte * $totalttc;
                if ($mnttva)
                    $lignedoc->setMnttva($mnttva);
                if ($totalhtva)
                    $lignedoc->setMntthtva($totalhtva);
                if ($fodec)
                    $lignedoc->setMntfodec($fodec);
                $montanttotalfodec += $fodec;
                if ($taufodec)
                    $lignedoc->setIdTauxfodec($taufodec);
                $lignedoc->setObservation($observation);
                //                 $lignedoc->set
                $lignedoc->save();
                $qteligne = new Qtelignedoc();
                $qteligne->setIdLignedocachat($lignedoc->getId());
                $qteligne->setQtelivrefrs($qte);
                $qteligne->save();
                $ErpHistorique = new Erphistorique();
                $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
            }

            $documentachat->setMht($mntht);
            //          if($total_ttc_bdc)
            //            $documentachat->setMntttc($total_ttc_bdc);
            //            $documentachat->setMnttva($pttva);

            $documentachat->setMht($mntht);
            $total_ttc = $montanttotaltva + $mntht + $montanttotalfodec;
            //            if ($droit_tmibre == "1")
            //                $total_ttc = $total_ttc + 0.600;
            if ($total_ttc)
                $documentachat->setMntttc($total_ttc);
            if ($montanttotaltva)
                $documentachat->setMnttva($montanttotaltva);
            if ($montanttotalfodec)
                $documentachat->setMntfodec($montanttotalfodec);
            $documentachat->save();


            $ErpHistorique = new Erphistorique();
            $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);
            die("Bon de dépenses aux comptant crée avec succès");
        }
        die('Erreur .....!!!!');
    }

    public function executeSavebondedeponseprovisoire(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $droit_tmibre = $params['droit_timbre'];
            $iddoc = explode(',', $iddoc);
            $mnttotal_bdc = $params['mnttotal_bdc'];
            $reference = $params['reference'];
            $mnttotal = $params['mnttotal'];
            $type_bdc = $params['type_bdc'];
            $total_htax = $params['total_htax'];
            $remisetotalvaleurHT = $params['remisetotalvaleurHT'];
            $remisetotalpourcentageHT = $params['remisetotalpourcentageHT'];
            $droit_timbre_societe = $params['droit_timbre_societe'];
            $idlieux = $params['lieulivraison'];
            if ($mnttotal == "")
                $mnttotal = 0;
            //            die($mnttotal_bdc.' '.$droit_tmibre );
            $listeslignesdoc = $params['listearticle'];
            $idlieux = $params['lieulivraison'];
            $frs = $params['frs'];
            if ($frs != '') {
                $fournisseurs = Doctrine_Query::create()
                                ->select("*")
                                ->from('fournisseur')
                                ->where("rs like '%" . $frs . "%'")->execute();

                if (count($fournisseurs) > 0)
                    $fournisseur = $fournisseurs[0];
                //                $fournisseur = new Fournisseur();
                //                if (count($fournisseurs) > 0)
                //                    $fournisseur = $fournisseurs[0];
                //                else {
                //                    $fournisseur->setRs($frs);
                //                    $fournisseur->save();
                //                }
            }
            $achat = new Documentachat();
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc[0]);
            $achat = $achat_document;
            //______________________ajouter document demande de prix
            $documentachat = new Documentachat();
            $numero = $documentachat->getNumeroBDCPParBCI($achat->getId());
            $documentachat->setNumero($numero);
            if ($frs != '') {
                if (count($fournisseurs) > 0)
                    $documentachat->setIdFrs($fournisseur->getId());
            }
            if ($type_bdc == 0)
                $documentachat->setIdTypedoc(17);
            if ($type_bdc == 1)
                $documentachat->setIdTypedoc(21);
            $documentachat->setIdDocparent($achat->getId());
            if ($reference)
                $documentachat->setReference($reference);
            else
                $documentachat->setReference($achat->getReference());
            $documentachat->setIdUser($user->getId());
            if ($mnttotal_bdc != '' && $frs != '')
                $documentachat->setIdEtatdoc(24);
            else
                $documentachat->setIdEtatdoc(55);
            $documentachat->setDatecreation(date('Y-m-d'));
            //lieu de livraison
            //die($droit_tmibre);
            if ($droit_tmibre != "" && $droit_tmibre != "undefined" && $droit_tmibre && $droit_tmibre != '? undefined:undefined ?')
                $documentachat->setDroittimbre($droit_tmibre);
            else
                $documentachat->setDroittimbre(null);
            if ($idlieux != "0")
                $documentachat->setIdLieu($idlieux);
            if ($remisetotalvaleurHT)
                $documentachat->setTotalremisevaleur($remisetotalvaleurHT);
            if ($remisetotalpourcentageHT)
                $documentachat->setTotalremisehpour($remisetotalpourcentageHT);
            if ($droit_timbre_societe)
                $documentachat->setDroittimbre($droit_timbre_societe);
            $documentachat->save();

            //Documents Parents
            for ($i = 0; $i < sizeof($iddoc); $i++) {
                $document_parent = new Documentparent();
                $document_parent->setIdDocumentachat($documentachat->getId());
                $document_parent->setIdDocumentparent($iddoc[$i]);

                $document_parent->save();
            }

            foreach ($listeslignesdoc as $lignedoc) {
                $norgdre = $lignedoc['norgdre'];
                $designation = $lignedoc['designation'];
                $qte = $lignedoc['qte'];
                $puht = $lignedoc['puht'];
                $unite = $lignedoc['unitedemander'];
                $idtva = $lignedoc['idtva'];

                $totalhtva = $lignedoc['totalhtva'];
                $fodec = $lignedoc['fodec'];
                $prixttc = $lignedoc['prixttc'];
                $taufodec = $lignedoc['idtaufodec'];
                $totalhTax = $lignedoc['totalhTax'];
                $totalhax = $lignedoc['totalhax'];
                $totalttc = $lignedoc['totalttc'];
                $tauxremise = $lignedoc['tauxremise'];
                $totalhtax = $lignedoc['totalhTax'];
                $observation = $lignedoc['observation'];
                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);

                //$lignedoc->setEtatligne("EnCours");
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
                $mntht += $qte * $puht;

                if ($idtva)
                    $tva = Doctrine_Core::getTable('tva')->findOneById($idtva);


                //                die($tva. ' tva');
                //                if ($tva) {
                //                    $prixttc = $puht * (1 + ($tva->getValeurtva() / 100));
                //                    $mnttva = $prixttc - $puht;
                ////                      die($prixttc . '  frf '.$mnttva);
                //                    $lignedoc->setMntttc($prixttc);
                //                    $mntttc+=$qte * $prixttc;
                //                    $lignedoc->setMnttva($mnttva);
                ////                    die($mnttva);
                //                    $pttva+=$qte * $mnttva;
                //                }
                //die($mntht.$mnttva);
                //                if ($mntht)
                //                    $lignedoc->setMntht($mntht);
                //                if ($idtva)
                //                    $lignedoc->setIdTva($idtva);

                $lignedoc->setObservation($observation);
                if ($totalhax && $totalhax != "")
                    $lignedoc->setMnhtaxnet($totalhax);
                if ($totalhtva && $totalhtva != "")
                    $lignedoc->setMntthtva($totalhtva);
                if ($qte)
                    $lignedoc->setQte($qte);
                if ($totalttc && $totalttc != "")
                    $lignedoc->setMntttc($totalttc);
                if ($totalhTax)
                    $lignedoc->setMntht($totalhTax);
                if ($idtva)
                    $lignedoc->setIdTva($idtva);
                else {
                    $tvas = Doctrine_Core::getTable('tva')->findAll();
                    foreach ($tvas as $tva) :
                        if ($tva->getValeurtva() == 0.00)
                            $id_tva_null = $tva->getId();
                    endforeach;
                    $lignedoc->setIdTva($id_tva_null);
                }
                if ($totalttc && $totalhtva)
                    $mnttva = $totalttc - $totalhtva;
                $montanttotaltva += $mnttva;
                //                $mntttc+=$qte * $totalttc;
                if ($mnttva)
                    $lignedoc->setMnttva($mnttva);
                if ($totalhtva)
                    $lignedoc->setMntthtva($totalhtva);
                if ($fodec)
                    $lignedoc->setMntfodec($fodec);
                $montanttotalfodec += $fodec;
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
                if ($tauxremise) {
                    $tauxremise = $tauxremise * 100;
                    $lignedoc->setMntremise($tauxremise);
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
            //            $documentachat->setMht($mntht);
            //            if ($mnttotal != "" && $total_ttc >= 0) {
            //                $documentachat->setMntttc($mnttotal);
            //                if ($mntht)
            //                    $documentachat->setMht($mntht);
            //                $documentachat->setMntttc($mnttotal);
            //                if ($pttva)
            //                    $documentachat->setMnttva($pttva);
            if ($mntht)
                $documentachat->setMht($mntht);
            $total_ttc = $montanttotaltva + $mntht + $montanttotalfodec;
            //            if ($total_ttc)
            //                $documentachat->setMntttc($total_ttc);
            if ($mnttotal_bdc)
                $documentachat->setMntttc($mnttotal_bdc);
            if ($montanttotaltva)
                $documentachat->setMnttva($montanttotaltva);
            if ($montanttotalfodec)
                $documentachat->setMntfodec($montanttotalfodec);
            $documentachat->save();
            //            } else {
            //                $documentachat->setMntttc(0);
            //                $documentachat->setMht(0);
            //                $documentachat->setMntttc(0);
            //                $documentachat->setMnttva(0);
            //                $documentachat->save();
            //            }
            //            $documentachat->setMnttva($pttva);

            $ErpHistorique = new Erphistorique();
            $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);
            die("Bon de dépenses aux comptant provisoire crée avec succès");
        }
        die('Erreur .....!!!!');
    }

    //save bdc regroupe provisoire

    public function executeSavebondedeponseprovisoireregrouepe(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $iddoc = explode(',', $iddoc);
            $mnttotal = $params['mnttotal'];
            //die(json_encode($iddoc));


            $achat = new Documentachat();
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc[0]);
            $achat = $achat_document;
            //______________________ajouter document demande de prix
            $documentachat = new Documentachat();
            $numero = $documentachat->getNumeroBDCPParBCI($achat->getId());
            $documentachat->setNumero($numero);
            $documentachat->setIdTypedoc(21);

            $documentachat->setIdDocparent($achat->getId());
            $documentachat->setReference($achat->getReference());


            $documentachat->setIdUser($user->getId());
            $documentachat->setIdEtatdoc(44);
            $documentachat->setDatecreation(date('Y-m-d'));

            //lieu de livraison

            if ($mnttotal != "" && $mnttotal >= 0) {
                $documentachat->setMntttc($mnttotal);
                $documentachat->save();
            }

            $documentachat->save();
            //Documents Parents
            for ($i = 0; $i < sizeof($iddoc); $i++) {
                $document_parent = new Documentparent();
                $document_parent->setIdDocumentachat($documentachat->getId());
                $document_parent->setIdDocumentparent($iddoc[$i]);

                $document_parent->save();
            }

            //            foreach ($listeslignesdoc as $lignedoc) {
            //                $norgdre = $lignedoc['norgdre'];
            //                $designation = $lignedoc['designation'];
            //                $qte = $lignedoc['qte'];
            //                $puht = $lignedoc['puht'];
            //
            //                $unite = $lignedoc['unitedemander'];
            //                $idtva = $lignedoc['idtva'];
            //                $observation = $lignedoc['observation'];
            //                $lignedoc = new Lignedocachat();
            //                $lignedoc->setIdDoc($documentachat->getId());
            //                $lignedoc->setNordre($norgdre);
            //
            //                //$lignedoc->setEtatligne("EnCours");
            //                if ($unite && $unite != "")
            //                    $lignedoc->setUnitedemander($unite);
            //                if ($designation != "") {
            //                    $lignedoc->setDesignationarticle($designation);
            //                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
            //                    if ($article) {
            //                        $lignedoc->setIdArticlestock($article->getId());
            //                        $lignedoc->setCodearticle($article->getCodeart());
            //                    }
            //                }
            //                //$lignedoc->setQte($qte);
            //
            //                $tva = Doctrine_Core::getTable('tva')->findOneById($idtva);
            //                $mntht+=$qte * $puht;
            ////                die($tva. ' tva');
            ////                if ($tva) {
            //                $prixttc = $puht * (1 + ($tva->getValeurtva() / 100));
            //
            //
            //                $mnttva = $prixttc - $puht;
            ////                      die($prixttc . '  frf '.$mnttva);
            //                $lignedoc->setMntttc($prixttc);
            //                $mntttc+=$qte * $prixttc;
            //                $lignedoc->setMnttva($mnttva);
            ////                    die($mnttva);
            //                $pttva+=$qte * $mnttva;
            ////                }
            ////die($mntht.$mnttva);
            ////                if ($mntht)
            //                $lignedoc->setMntht($mntht);
            //                if ($idtva)
            //                    $lignedoc->setIdTva($idtva);
            //
            //                $lignedoc->setObservation($observation);
            //                // $lignedoc->set
            //                $lignedoc->save();
            //
            //                $qteligne = new Qtelignedoc();
            //                $qteligne->setIdLignedocachat($lignedoc->getId());
            //                $qteligne->setQtelivrefrs($qte);
            //                $qteligne->save();
            //                $ErpHistorique = new Erphistorique();
            //                $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
            //            }
            //            $documentachat->setMht($mntht);
            //            $documentachat->setMnttva($pttva);
            //            $ErpHistorique = new Erphistorique();
            //            $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);
            die("Bon de dépenses aux comptant regroupé provisoire crée avec succès");
        }
        die('Erreur .....!!!!');
    }

    //__________________________________________________________________________Ajouter bon de deponse 
    public function executeSavebonexterne(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $iddoc = explode(',', $iddoc);
            $datemax = $params['datemax'];
            $id_note = $params['id_note'];
            $designation = $params['designation'];
            $total_ttc_provisoire = $params['total_ttc_provisoire'];
            $total_htax = $params['total_htax'];
            $remisetotalvaleurHT = $params['remisetotalvaleurHT'];
            $remisetotalpourcentageHT = $params['remisetotalpourcentageHT'];
            $droit_timbre_societe = $params['droit_timbre_societe'];
            $id_lieu = $params['id_lieu'];
            $datecreation = $params['datecreation'];
            $p = $params['p'];
            $id_fils = $params['id_fils'];
            $listeslignesdoc = $params['listearticle'];
            $reference = $params['reference'];
            $frs = $params['frs'];
            $fournisseur = FournisseurTable::getInstance()->find($frs);
            $achat = new Documentachat();
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc[0]);
            $achat = $achat_document;
            //______________________ajouter document demande de prix
            $documentachat = new Documentachat();
            if ($p === '') {
                $numero = $documentachat->NumeroSeqDocumentAchat(7);
                $documentachat->setIdTypedoc(7);
                $documentachat->setIdFils($id_fils);
                $documentachat->setIdEtatdoc(32);
                $documentachat->save();
                $documentachat->ExporterBudgetVersBdC($id_fils);
            } else {
                $numero = $documentachat->NumeroSeqDocumentAchat(18);
                $documentachat->setIdTypedoc(18);
                $documentachat->setIdEtatdoc(24);
            }
            if ($remisetotalvaleurHT)
                $documentachat->setTotalremisevaleur($remisetotalvaleurHT);
            if ($remisetotalpourcentageHT)
                $documentachat->setTotalremisehpour($remisetotalpourcentageHT);

            $documentachat->setNumero($numero);
            $documentachat->setIdFrs($fournisseur->getId());
            $documentachat->setIdDocparent($achat->getId());
            if ($reference)
                $documentachat->setReference($reference);
            else
                $documentachat->setReference($achat->getReference());
            $documentachat->setIdUser($user->getId());
            if ($droit_timbre_societe)
                $documentachat->setDroittimbre($droit_timbre_societe);
            if ($datecreation != "")
                $documentachat->setDatecreation($datecreation);
            else
                $documentachat->setDatecreation(date('Y-m-d'));
            $documentachat->setMaxreponsefrs($datemax);
            $documentachat->setIdNote($id_note);
            $documentachat->setDesiegniation($designation);
            if ($id_lieu != 0)
                $documentachat->setIdLieu($id_lieu);
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

            foreach ($listeslignesdoc as $lignedoc) {
                $norgdre = $lignedoc['norgdre'];
                $designation = $lignedoc['designation'];
                $qte = $lignedoc['qte'];
                $puht = $lignedoc['puht'];
                if ($p)
                    $id_tva = $lignedoc['id_tva'];
                else
                    $id_tva = $lignedoc['idtva'];
                $unite = $lignedoc['unitedemander'];
                $observation = $lignedoc['observation'];
                $totalhtva = $lignedoc['totalhtva'];
                $fodec = $lignedoc['fodec'];
                $prixttc = $lignedoc['prixttc'];
                $taufodec = $lignedoc['idtaufodec'];
                if ($p === '') {
                    $totalhtax = $lignedoc['totalhtax'];
                } else {
                    $totalhtax = $lignedoc['totalhTax'];
                }


                $totalhax = $lignedoc['totalhax'];
                $tauxremise = $lignedoc['tauxremise'];
                $totalttc = $lignedoc['totalttc'];
                $id_unitemarche = $lignedoc['id_unitemarche'];
                $id_projet = $lignedoc['id_projet'];
                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                if ($unite && $unite != "")
                    $lignedoc->setUnitedemander($unite);
                if ($id_unitemarche && $id_unitemarche != "")
                    $lignedoc->setIdUnitemarche($id_unitemarche);
                //                if ($id_projet && $id_projet != "")
                //                    $lignedoc->setIdProjet($id_projet);
                if ($designation != "") {
                    $lignedoc->setDesignationarticle($designation);
                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
                    if ($article) {
                        $lignedoc->setIdArticlestock($article->getId());
                        $lignedoc->setCodearticle($article->getCodeart());
                    }
                }
                $lignedoc->setQte($qte);
                //                $lignedoc->setMntht($puht);
                if ($id_tva)
                    $tva = Doctrine_Core::getTable('tva')->findOneById($id_tva);

                //$mntht+=$qte * $puht;
                $mntht += $totalhax;
                //                if ($tva) {
                //                    $prixttc = $puht * (1 + ($tva->getValeurtva() / 100));
                //                    $mnttva = $prixttc - $puht;
                //                    $lignedoc->setMntttc($prixttc);
                //                    $mntttc+=$qte * $prixttc;
                //                    $lignedoc->setMnttva($mnttva);
                //                    $pttva+=$qte * $mnttva;
                //                }
                if ($totalhax && $totalhax != "")
                    $lignedoc->setMnhtaxnet($totalhax);
                if ($totalhtax && $totalhtax != "")
                    $lignedoc->setMntht($totalhtax);
                if ($totalhtva && $totalhtva != "")
                    $lignedoc->setMntthtva($totalhtva);

                if ($totalttc && $totalttc != "")
                    $lignedoc->setMntttc($totalttc);
//                if ($totalhax)
//                    $lignedoc->setMntht($totalhax);

                if ($id_tva) {
                    $lignedoc->setIdTva($id_tva);
                } else {
                    $tvas = Doctrine_Core::getTable('tva')->findAll();
                    foreach ($tvas as $tva) :
                        if ($tva->getValeurtva() == 0.00)
                            $id_tva_null = $tva->getId();
                    endforeach;
                    $lignedoc->setIdTva($id_tva_null);
                }

                if ($totalttc && $totalhtva)
                    $mnttva = $totalttc - $totalhtva;
                $montanttotaltva += $mnttva;
                //die('$mnttva' . $mnttva . '$totalhtva=' . $totalhtva . '$totalttc=' . $totalttc);
                //                $mntttc+=$qte * $totalttc;
                if ($mnttva)
                    $lignedoc->setMnttva($mnttva);
                if ($totalhtva)
                    $lignedoc->setMntthtva($totalhtva);
                if ($fodec)
                    $lignedoc->setMntfodec($fodec);
                $montanttotalfodec += $fodec;

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
                if ($tauxremise) {
                    $tauxremise = $tauxremise * 100;
                    $lignedoc->setMntremise($tauxremise);
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

            $total_ttc = $montanttotaltva + $mntht + $montanttotalfodec;
            if ($total_ttc_provisoire)
                $documentachat->setMntttc($total_ttc_provisoire);
            if ($total_htax)
                $documentachat->setMht($total_htax);
            if ($montanttotaltva)
                $documentachat->setMnttva($montanttotaltva);
            if ($montanttotalfodec)
                $documentachat->setMntfodec($montanttotalfodec);
            $documentachat->save();
            $ErpHistorique = new Erphistorique();
            $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);
            return $this->renderText(json_encode(array(
                        'idbdc' => $documentachat->getId(),
                        'tab' => '4'
            )));
        }
        return $this->renderText(json_encode(array(
                    'error' => 'ERROR'
        )));
    }

    public function executeSavebonexternedefitinf(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $iddoc = explode(',', $iddoc);
            $datemax = $params['datemax'];
            $id_note = $params['id_note'];
            $designation = $params['designation'];
            $id_lieu = $params['id_lieu'];
            $datecreation = $params['datecreation'];
            $p = $params['p'];
            $id_fils = $params['id_fils'];
            $listeslignesdoc = $params['listearticle'];
            $frs = $params['frs'];
            //            if ($p != '') {
            //                $fournisseurs = Doctrine_Query::create()
            //                                ->select("*")
            //                                ->from('fournisseur')
            //                                ->where("rs like '%" . $frs . "%'")->execute();
            //                $fournisseur = new Fournisseur();
            //                if (count($fournisseurs) > 0)
            //                    $fournisseur = $fournisseurs[0];
            //                else {
            //                    $fournisseur->setRs($frs);
            //                    $fournisseur->save();
            //                }
            //            } else {
            $fournisseur = FournisseurTable::getInstance()->find($frs);
            //            }
            $achat = new Documentachat();
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc[0]);
            $achat = $achat_document;
            //______________________ajouter document demande de prix
            $documentachat = new Documentachat();
            if ($p === '') {
                $numero = $documentachat->NumeroSeqDocumentAchat(7);
                $documentachat->setIdTypedoc(7);
                $documentachat->setIdFils($id_fils);
                $documentachat->setIdEtatdoc(32);
                $documentachat->save();
                $documentachat->ExporterBudgetVersBdC($id_fils);
            } else {
                $numero = $documentachat->NumeroSeqDocumentAchat(18);
                $documentachat->setIdTypedoc(18);
                $documentachat->setIdEtatdoc(24);
            }

            $documentachat->setNumero($numero);
            $documentachat->setIdFrs($fournisseur->getId());

            $documentachat->setIdDocparent($achat->getId());
            $documentachat->setReference($achat->getNumero());
            $documentachat->setIdUser($user->getId());


            if ($datecreation != "")
                $documentachat->setDatecreation($datecreation);
            else
                $documentachat->setDatecreation(date('Y-m-d'));

            $documentachat->setMaxreponsefrs($datemax);
            $documentachat->setIdNote($id_note);
            $documentachat->setDesiegniation($designation);
            if ($id_lieu != 0)
                $documentachat->setIdLieu($id_lieu);
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
            $pttva = 0;
            foreach ($listeslignesdoc as $lignedoc) {
                $norgdre = $lignedoc['norgdre'];
                $designation = $lignedoc['designation'];
                $qte = $lignedoc['qte'];
                $puht = $lignedoc['mntht'];
                $idtva = $lignedoc['id_tva'];
                $unite = $lignedoc['unitedemander'];
                $observation = $lignedoc['observation'];
                $id_unitemarche = $lignedoc['id_unitemarche'];
                $id_projet = $lignedoc['id_projet'];

                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                if ($unite && $unite != "")
                    $lignedoc->setUnitedemander($unite);
                if ($id_unitemarche && $id_unitemarche != "")
                    $lignedoc->setIdUnitemarche($id_unitemarche);
                if ($id_projet && $id_projet != "")
                    $lignedoc->setIdProjet($id_projet);

                if ($designation != "") {
                    $lignedoc->setDesignationarticle($designation);
                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
                    if ($article) {
                        $lignedoc->setIdArticlestock($article->getId());
                        $lignedoc->setCodearticle($article->getCodeart());
                    }
                }

                $lignedoc->setQte($qte);
                $lignedoc->setMntht($puht);
                $tva = Doctrine_Core::getTable('tva')->findOneById($idtva);

                $mntht += $qte * $puht;
                if ($tva) {
                    $prixttc = $puht * (1 + ($tva->getValeurtva() / 100));
                    $mnttva = $prixttc - $puht;
                    $lignedoc->setMntttc($prixttc);
                    $mntttc += $qte * $prixttc;
                    $lignedoc->setMnttva($mnttva);
                    $pttva += $qte * $mnttva;
                }

                $lignedoc->setIdTva($idtva);
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
            $documentachat->setMntttc($mntttc);
            $documentachat->setMnttva($pttva);
            $documentachat->save();
            $ErpHistorique = new Erphistorique();
            $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);
            die("Bon de commande externe créé avec succès");
        }
        die('Erreur .....!!!!');
    }

    //___________________________________________________ajouter contrat definitif


    public function executeSaveContratdefintif(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $iddoc = explode(',', $iddoc);
            $designation = $params['designation'];
            $datefin = $params['datefin'];

            $cautionement = $params['cautionement'];
            $retenuegaraentie = $params['retenuegaraentie'];
            $avance = $params['avance'];
            $penalite = $params['penalite'];


            $mnttotal = $params['total_ttc'];
            $p = $params['p'];
            $id_fils = $params['id_fils'];
            $listeslignesdoc = $params['listearticle'];
            $listelignelignecontrat = $params['listelignecontrat'];
            $frs = $params['frs'];

            $idcontrat = $params['idcontrat'];
            $fournisseur = FournisseurTable::getInstance()->find($frs);

            //$date_sys=new date('Y-m-d');
            $contrat_document = Doctrine_Core::getTable('contratachat')->findOneById($idcontrat);
            $achat = $contrat_document;
            //______________________ajouter document demande de prix
            $documentachat = new Contratachat();
            $numero = $contrat_document->getNumero();
            $documentachat->setNumero($contrat_document->getNumero());
            $documentachat->setIdTypedoc(20);
            $documentachat->setIdEtatdoc(75);
            $documentachat->setMontantcontrat($contrat_document->getMontantcontrat());
            $documentachat->setMontantplanfonne($contrat_document->getMontantplanfonne());
            $documentachat->setIdDocparent($contrat_document->getId());
            //                $documentachat->setIdFils($id_fils);
            //                $documentachat->setIdEtatdoc(32);
            $documentachat->setDatesigntaure(date('Y-m-d'));
            if ($penalite)
                $documentachat->setPenalite($penalite);
            if ($avance)
                $documentachat->setAvance($avance);
            if ($retenuegaraentie)
                $documentachat->setRetenuegaraentie($retenuegaraentie);
            if ($cautionement)
                $documentachat->setCautionement($cautionement);
            $documentachat->save();
            $achat = new Documentachat();
            $achat->ExporterBudgetVersContratD($iddoc[0]);
            //die($iddoc);

            $documentachat->setNumero($numero);
            $documentachat->setIdFrs($fournisseur->getId());

            $documentachat->setIdDocparent($contrat_document->getId());
            $documentachat->setReference($contrat_document->getReference());
            $documentachat->setIdUser($user->getId());
            $documentachat->setDatecreation(date('Y-m-d'));

            $documentachat->setType($contrat_document->getType());
            $documentachat->setTypepaiment($contrat_document->getTypepaiment());
            if ($designation)
                $documentachat->setDesigntaion($designation);

            $documentachat->setDatesigntaure(date('Y-m-d'));
            if ($datefin)
                $documentachat->setDatefin($datefin);
            $documentachat->save();

            $mntht = 0;
            $mntttc = 0;
            $pttva = 0;
            foreach ($listeslignesdoc as $lignedoc) {
                $norgdre = $lignedoc['norgdre'];
                $designation = $lignedoc['designation'];
                $qte = $lignedoc['qte'];
                $puht = $lignedoc['puht'];
                $unite = $lignedoc['idunite'];
                $idtva = $lignedoc['idtva'];
                $idprojet = $lignedoc['idprojet'];
                $totalhax = $lignedoc['totalhax'];
                $totalhtva = $lignedoc['totalhtva'];
                $totalttc = $lignedoc['totalttc'];
                $fodec = $lignedoc['fodec'];
                //                $taufodec = $lignedoc['taufodec'];
                $idtaufodec = $lignedoc['idtaufodec'];
                $observation = $lignedoc['observation'];
                $lignedoc = new Lignecontrat();
                $lignedoc->setIdContrat($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                if ($unite && $unite != "")
                    $lignedoc->setIdUnite($unite);
                if ($unite && $unite != "")
                    $lignedoc->setIdUnitemarche($unite);
                if ($designation != "") {
                    $lignedoc->setDesignationartcile($designation);
                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
                    if ($article) {
                        $lignedoc->setIdArticlestock($article->getId());
                        $lignedoc->setCodearticle($article->getCodeart());
                    }
                }
                $lignedoc->setQte($qte);
                if ($puht)
                    $lignedoc->setPrixu($puht);
                if ($idtaufodec)
                    $lignedoc->setIdTauxfodec($idtaufodec);
                if ($totalhax)
                    $lignedoc->setMntht($totalhax);
                if ($fodec)
                    $lignedoc->setFodec($fodec);
                if ($totalhtva)
                    $lignedoc->setMntthtva($totalhtva);
                if ($totalttc)
                    $lignedoc->setMntttc($totalttc);
                if ($idtva && $idtva != "") {
                    $lignedoc->setIdTva($idtva);
                }
                if ($idtva && $idtva != "") {
                    $tva = Doctrine_Core::getTable('tva')->findOneById($idtva);
                }
                $mntht += $qte * $puht;
                if ($tva) {
                    $prixttc = $puht * (1 + ($tva->getValeurtva() / 100));
                    $mnttva = $prixttc - $puht;
                    //                    $lignedoc->setMntttc($prixttc);
                    $mntttc += $qte * $prixttc;
                    //                    $lignedoc->setMnttva($mnttva);
                    $pttva += $qte * $mnttva;
                }
                if (!empty($idprojet)) {
                    $lignedoc->setIdProjet($idprojet);
                }
                //                if($observation)
                //                $lignedoc->setObservation($observation);
                $lignedoc->save();
            }
            foreach ($listelignelignecontrat as $lignelignedoc) {
                $norgdre = $lignelignedoc['norgdre'];
                $designation = $lignelignedoc['designation'];
                $typepiece = $lignelignedoc['idtypepiece'];
                $tauxpourcentage = $lignelignedoc['tauxpourcentage'];
                $ligne = new Lignecontrat();
                $ligne->setNordre($norgdre);
                $ligne->setIdTypepiece($typepiece);
                $ligne->setTauxpourcentage($tauxpourcentage);
                $ligne->setDesignationartcile($designation);
                $ligne->setIdDocparent($lignedoc->getId());
                $ligne->save();
            }
            $documentachat->setMht($mntht);
            $documentachat->setMnttc($totalttc);
            if ($pttva)
                $documentachat->setMnttva($pttva);
            if ($mnttotal != "" && $mnttotal >= 0) {
                $documentachat->setMontantcontrat($mnttotal);
                $documentachat->save();
            }
            $id_doc = $documentachat->getId();

            $document_achat_contrat = new Documentachat();
            $document_achat_contrat_ancien = DocumentachatTable::getInstance()->findOneByIdContrat($idcontrat);

            //                die($document_achat->getId().'ol'.$id_doc);
            $document_achat_contrat->setNumero($document_achat_contrat_ancien->getNumero());
            $document_achat_contrat->setReference($document_achat_contrat_ancien->getReference());
            $document_achat_contrat->setDatecreation($document_achat_contrat_ancien->getDatecreation());
            $document_achat_contrat->setObservation($document_achat_contrat_ancien->getObservation());
            $document_achat_contrat->setIdDemandeur($document_achat_contrat_ancien->getIdDemandeur());

            $document_achat_contrat->setIdContrat($id_doc);
            $document_achat_contrat->setIdTypedoc(20);
            $document_achat_contrat->setIdEtatdoc(75);
            $document_achat_contrat->setMht($mntht);
            $document_achat_contrat->setMntttc($totalttc);
            if ($pttva)
                $document_achat_contrat->setMnttva($pttva);
            $document_achat_contrat->setIdFrs($contrat_document->getIdFrs());
            $document_achat_contrat->setMntttc($contrat_document->getMontantcontrat());

            $document_achat_contrat->setIdFils($iddoc[0]);
            $document_achat_contrat->setIdUser($document_achat_contrat_ancien->getIdUser());

            $document_achat_contrat->setIdDocparent($document_achat_contrat_ancien->getId());
            $document_achat_contrat->save();
            //            }   
            //
            //                $qteligne = new Qtelignedoc();
            //                $qteligne->setIdLignedocachat($lignedoc->getId());
            //                $qteligne->setQtelivrefrs($qte);
            //                $qteligne->save();
            //                $ErpHistorique = new Erphistorique();
            //                $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
            //            }
            //
            //            $documentachat->setMht($mntht);
            //            $documentachat->setMntttc($mntttc);
            //            $documentachat->setMnttva($pttva);
            //            $documentachat->save();
            //            $ErpHistorique = new Erphistorique();
            //            $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);
            die("Contrat Définitf  créé avec succès");
        }
        die('Erreur .....!!!!');
    }

    //___________________________________________________________________________Detail ligne doc DetailligneBondedeponse
    public function executeDetaillignedeponse(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idlignedoc = $params['idlignedoc'];

            $query = "select documentachat.id_lieu, documentachat.reference as reference, "
                    . "documentachat.id as demandedeprixid,qtelignedoc.qtelivrefrs as qte,lignedocachat.mntht,"
                    . "lignedocachat.observation,lignedocachat.nordre,lignedocachat.designationarticle, lignedocachat.unitedemander, "
                    . "fournisseur.reference as ref, fournisseur.rs,fournisseur.adr  as adrs, "
                    . "CONCAT('E-mail : ', COALESCE(fournisseur.mail, '-'),' | Tél : ', COALESCE(fournisseur.tel,'-') ,' | Gsm : ', COALESCE(fournisseur.gsm, '-')) as annuaire , "
                    . " documentachat.droittimbre as droittimbre , documentachat.totalremisevaleur as totalremisevaleur"
                    . " ,  documentachat.totalremisehpour as totalremisehpour , documentachat.mht as total_htax "
                    . " from  qtelignedoc, lignedocachat, documentachat "
                    . "  left join fournisseur on fournisseur.id=documentachat.id_frs "
                    . "where qtelignedoc.id_lignedocachat=lignedocachat.id "
                    . "AND  lignedocachat.id_doc = documentachat.id "
                    . "AND  documentachat.id=" . $idlignedoc
                    . " group by demandedeprixid,lignedocachat.nordre,lignedocachat.designationarticle,lignedocachat.unitedemander, "
                    . " adrs ,  "
                    . " ref, fournisseur.rs,annuaire ,qtelignedoc.qtelivrefrs,lignedocachat.mntht,lignedocachat.observation;";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
    }

    public function executeDetaillignedeponseBDCR(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idlignedoc = $params['idlignedoc'];
            $query = "select documentachat.id_lieu, documentachat.id as demandedeprixid,"
                    . "qtelignedoc.qtelivrefrs as qte,lignedocachat.mntht,"
                    . "lignedocachat.observation,lignedocachat.nordre,lignedocachat.designationarticle, "
                    . "lignedocachat.unitedemander "
                    . " from  qtelignedoc, lignedocachat, documentachat "
                    . "where qtelignedoc.id_lignedocachat=lignedocachat.id "
                    . "AND  lignedocachat.id_doc = documentachat.id "
                    . "AND  documentachat.id=" . $idlignedoc
                    . " group by demandedeprixid,lignedocachat.nordre,lignedocachat.designationarticle,"
                    . "lignedocachat.unitedemander,  "
                    . "  qtelignedoc.qtelivrefrs,lignedocachat.mntht,lignedocachat.observation;";
            // die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
    }

    public function executeDetaillignebcep(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idlignedoc = $params['idlignedoc'];

            $query = "select documentachat.maxreponsefrs, documentachat.reference as reference , "
                    . "documentachat.id_note as id_note,documentachat.observation,"
                    . " documentachat.id_lieu, documentachat.id as demandedeprixid,qtelignedoc.qtelivrefrs as qte,"
                    . "lignedocachat.mntht, lignedocachat.observation,lignedocachat.nordre,lignedocachat.designationarticle, "
                    . "  fournisseur.reference as ref, fournisseur.rs,fournisseur.adr  as adrs, "
                    . "CONCAT('E-mail:', fournisseur.mail,' Tél:',  fournisseur.tel,' Gsm:',   fournisseur.gsm) as annuaire,"
                    . " documentachat.droittimbre as droittimbre , documentachat.totalremisevaleur as totalremisevaleur"
                    . " ,  documentachat.totalremisehpour as totalremisehpour , documentachat.mht as total_htax "
                    . " from notesbce,fournisseur, qtelignedoc,  lignedocachat,   documentachat  "
                    . "where qtelignedoc.id_lignedocachat=lignedocachat.id and"
                    . "   lignedocachat.id_doc = documentachat.id  "
                    . "AND   documentachat.id_frs = fournisseur.id "
                    . " AND  documentachat.id=" . $idlignedoc
                    . " group by documentachat.observation,documentachat.maxreponsefrs,documentachat.id_note,"
                    . "demandedeprixid,lignedocachat.nordre,lignedocachat.designationarticle,"
                    . " adrs , ref, fournisseur.rs,annuaire ,qtelignedoc.qtelivrefrs,lignedocachat.mntht,lignedocachat.observation;";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
    }

    //___________________________________________________________________________Detail ligne doc DetailligneBondedeponse
    public function executeSignature(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $datesignature = $params['datesignature'];
            $doc_achat = new Documentachat();
            $doc = Doctrine_Core::getTable('documentachat')->findOneById($id);
            $doc_achat = $doc;
            $doc_achat->setDatesignature($datesignature);
            $doc_achat->setIdEtatdoc(27);
            $doc_achat->save();

            die("date signature ajoutée avec succès le " . $datesignature);
        }
    }

    //____________________________________________________Valider ligne 
    public function executeValiderligne(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $idligne = $params['id'];
            $input_enlevement = $params['input1'];
            $input_achat = $params['input2'];
            $qtelignedoc = new Qtelignedoc();
            $lgdoc = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($idligne);
            if ($lgdoc) {
                $qtelignedoc = $lgdoc;
                $qtelignedoc->setQteeachat($input_enlevement);
                $qtelignedoc->setQteaachat($input_achat);

                $qtelignedoc->save();
            } else
                die('Erreur au niveau de mise à jour');
        }
        die('Mise à jour effectuée avec succès');
    }

    //Liste Ligne BCI pour Contrat
    public function executeAfficheligneBCIpourContrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Bon_Comm_Interne = $params['id'];

            $query = "select unitedemander as unite, mntht as puht, nordre as norgdre, id as id, designationarticle as designation, qte as qte"
                    . " from lignedocachat"
                    . " where id_doc=" . $id_Bon_Comm_Interne
                    . " order by lignedocachat.id asc";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die("bien");
    }

    //__________________________________________________________________________Liste ligne bon de commande interne pour modification
    public function executeAfficheligneboninterneForEdite(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Bon_Comm_Interne = $params['id'];

            $query = "(select lignedocachat.unitedemander, lignedocachat.id_unitemarche as idunitemarche, "
                    . "lignedocachat.mntht ,lignedocachat.nordre as norgdre, lignedocachat.id, "
                    //                    . " CAST( (lignedocachat.mntht/qte) as decimal(18,3)) as puht, ". ", lignedocachat.mntht as totalhax , ". " tauxfodec.libelle  as taufodec,"
                    //                    . "   lignedocachat.mntfodec as fodec," . "  tva.libelle as tva,"  . "  lignedocachat.mntttc  as totalttc  , "
                    . " lignedocachat.mntttc  as totalttc,designationarticle as designation, codearticle as codearticle, "
                    . " observation as observation, "
                    . "id_projet as idprojet, projet.libelle as projet, qtelignedoc.qtedemander as quantite "
                    . " from lignedocachat,qtelignedoc,projet"
                    . " where lignedocachat.id_projet = projet.id"
                    //                    . " and  lignedocachat.id_tauxfodec=tauxfodec.id" . " and lignedocachat.id_tva= tva.id"
                    . " and id_doc=" . $id_Bon_Comm_Interne . " and qtelignedoc.id_lignedocachat=lignedocachat.id "
                    . " ) "
                    . " UNION "
                    . " (select lignedocachat.unitedemander, lignedocachat.id_unitemarche as idunitemarche, "
                    . "lignedocachat.mntht ,lignedocachat.nordre as norgdre, lignedocachat.id ,"
                    //                    . " CAST( (lignedocachat.mntht/qte) as decimal(18,3)) as puht, "
                    //                    . ", lignedocachat.mntht as totalhax , " . " tauxfodec.libelle  as taufodec," . "   lignedocachat.mntfodec as fodec,". "  lignedocachat.mntthtva as totalhtva,". "  tva.libelle as tva,"
                    . " lignedocachat.mntttc  as totalttc, "
                    . "designationarticle as designation, codearticle as codearticle, observation as observation, "
                    . "id_projet as idprojet, CONCAT('', '') as projet, qtelignedoc.qtedemander as quantite "
                    . " from lignedocachat,qtelignedoc"
                    . " where lignedocachat.id_projet IS NULL "
                    . " and id_doc=" . $id_Bon_Comm_Interne . " and qtelignedoc.id_lignedocachat=lignedocachat.id "
                    . " )"
                    //                    . " and  lignedocachat.id_tauxfodec=tauxfodec.id"
                    //                    . " and lignedocachat.id_tva= tva.id"
                    . " order by id asc";
            // die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die("bien");
    }

    //__________________________________________________________________________Liste ligne bon de commande interne
    public function executeAfficheligneboninterne(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Bon_Comm_Interne = $params['id'];

            $query = "select lignedocachat.unitedemander, lignedocachat.mntht "
                    . ",lignedocachat.nordre as norgdre, "
                    . "lignedocachat.id,designationarticle as designation,"
                    . "qtelignedoc.qteaachat as qte "
                    //                    . " CAST( (lignedocachat.mntht/qte) as decimal(18,3)) as puht, "
                    //                    . ", lignedocachat.mntht as totalhax , "
                    //                    . " tauxfodec.libelle  as taufodec,"
                    //                    . "   lignedocachat.mntfodec as fodec,"
                    //                    . "  lignedocachat.mntthtva as totalhtva,"
                    //                    . "  tva.libelle as tva,"
                    . " from lignedocachat,qtelignedoc"
                    . " where id_doc=" . $id_Bon_Comm_Interne
                    . " and qtelignedoc.id_lignedocachat=lignedocachat.id "
                    //                    . " and  lignedocachat.id_tauxfodec=tauxfodec.id"
                    //                    . " and lignedocachat.id_tva= tva.id"
                    . " order by lignedocachat.id asc";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die("bien");
    }

    public function executeAfficheligneListeboninterne(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Bon_Comm_Interne = $params['id'];
            $id_Bon_Comm_Interne = explode(',', $id_Bon_Comm_Interne);
            //            $array = array($id_Bon_Comm_Interne);

            $query = "select lignedocachat.unitedemander, "
                    . " lignedocachat.mntht ,designationarticle as designation, 
                   lignedocachat.observation as observation , "
                    . " SUM(qtelignedoc.qteaachat) as qte
                 ,SUM(qtelignedoc.qteaachat) as qtemax,"
                    . " id_articlestock as id_articlestock, codearticle, 
                id_unitemarche, id_projet,lignedocachat.mntremise as tauxremise "
                    . " from lignedocachat,qtelignedoc"
                    . " where id_doc IN (" . implode(',', array_map('intval', $id_Bon_Comm_Interne)) . ") and qtelignedoc.id_lignedocachat=lignedocachat.id "
                    . " group by (observation, id_articlestock, lignedocachat.unitedemander, lignedocachat.mntht, designation, codearticle, id_unitemarche, id_projet,lignedocachat.id)"
                    . " order by lignedocachat.id asc";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die("bien");
    }

    public function executeAffichelignebdcp(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Bon_Comm_Interne = $params['id'];
            //cast((lignedocachat.mntht/lignedocachat.qte) as decimal(18,3)) 
            $query = "select documentachat.mntttc as mntttc,documentachat.droittimbre as droittimbre, "
                    . "  lignedocachat.id_tva as id_tva,lignedocachat.observation,"
                    . "lignedocachat.unitedemander, "
                    . " CAST( (lignedocachat.mntht/qte) as decimal(18,3)) as puht "
                    . ", lignedocachat.mntht as totalhTax ,
                ROUND( lignedocachat.mntht - ((lignedocachat.mntht * COALESCE(lignedocachat.mntremise,0)) / 100 ),3) as totalhax, "
                    . " tauxfodec.libelle  as taufodec,tauxfodec.id  as idtaufodec,"
                    . "   lignedocachat.mntfodec as fodec,"
                    . "  lignedocachat.mntthtva as totalhtva,"
                    . "  tva.libelle as tva, tva.id as idtva,"
                    . "  lignedocachat.mntttc  as totalttc"
                    . " ,lignedocachat.nordre as norgdre, lignedocachat.id,"
                    . " designationarticle as designation,qtelignedoc.qtelivrefrs as qte,  "
                    . " COALESCE(lignedocachat.mntremise/100,0) as tauxremise "
                    . " from documentachat,lignedocachat,qtelignedoc,tauxfodec,tva"
                    . " where lignedocachat.id_doc=" . $id_Bon_Comm_Interne . ""
                    . " and lignedocachat.id_doc=documentachat.id"
                    . " and qtelignedoc.id_lignedocachat=lignedocachat.id "
                    . " and  lignedocachat.id_tauxfodec=tauxfodec.id"
                    . " and lignedocachat.id_tva= tva.id"
                    . " order by lignedocachat.id asc";
            //die($query);

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die("bien");
    }

    // donner l'état du bon du deponse aux comptant dans le budget -- imputation budgetaire --
    public function executeEtatbdcpenbudget(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $msg = 'bien';
        $params = array();
        $content = $request->getContent();

        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {

            $params = json_decode($content, true);
            $id_Bon_Comm_Interne = $params['id'];
            //               die('id'.$id_Bon_Comm_Interne);
            $docachat = Doctrine_Core::getTable('documentachat')->findOneByIdFils($id_Bon_Comm_Interne);
            if ($docachat)
                $msg = 2;

            $piecej = new Piecejointbudget();
            $pieces = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($id_Bon_Comm_Interne);
            if ($pieces)
                $msg = 0;
            else
                $msg = 1;
            //             die('id'.$id_Bon_Comm_Interne.$msg);
        }
        return $this->renderText($msg);
    }

    //***** imprimer les conditions  des demandes de prix
    public function executeImprimerconditionsdprix(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $ids = $request->getParameter('iddemande');
        $ids = substr($ids, 0, -1);
        $ids = explode('-', $ids);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Conditions demande de prix');
        $pdf->SetSubject("Conditions demande de prix");
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
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $demande_prix = new Documentachat();
        $demande_prix = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('iddemandedeprix'));
        $pdf->SetFont('dejavusans', '', 10, '', true);
        //        $pdf->SetFont('aefurat', '', 10);
        $pdf->AddPage();
        $html = $demande_prix->ImpprimerDetailCheque();
        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
        $pdf->Output('ConditionsDemandedeprix.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function executeImprimercontrat(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $iddoc = $request->getParameter('id');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

        $listesdocuments = Doctrine_Core::getTable('lignedocachat')
                        ->createQuery('a')
                        ->where('id_doc=' . $iddoc)->orderBy('id asc')->execute();
        //Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        // pdf object
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Contrat N°:');
        $pdf->SetSubject("contrat");
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


        $html = $this->ReadHtmlContrat($documentachat, $listesdocuments);

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

                $conteurtext += 35;
            }
        }

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('documentachat' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlContrat($documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlContrat($listesdocuments);

        return $html;
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
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
        $conteurtext = 10;
        $conteurcercle = 250;
        foreach ($visaas as $visa) {
            $visaachat = new Visaachat();
            $vi = Doctrine_Core::getTable('visaachat')->findOneById($visa->getIdVisa());
            if ($vi) {
                $visaachat = $vi;
                $cheminimage = sfconfig::get('sf_appdir') . 'uploads/images/' . $visaachat->getChemin();
                //                $pdf->Image($cheminimage, $conteurtext - 5, $conteurcercle - 15, 30, 30, 'JPG', '', '', true, 50, '', false, false, 0, false, false, false);
                $pdf->Text($conteurtext, $conteurcercle + 10, $visa->getDatevisa());
                $pdf->Text($conteurtext, $conteurcercle + 15, $visaachat);
                // $pdf->Text($conteurtext, $conteurcercle+25, $visaachat->getAgents());
                // $pdf->Circle($conteurtext + 10, $conteurcercle, 15);

                $conteurtext += 25;
            }
        }
        //        ob_end_clean();
        //          $pdf->Footer();
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

    public function executeImprimerdocachatBCIContrat(sfWebRequest $request) {
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
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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


        $html = $this->ReadHtmlBCIducontrat($societe, $aviss, $documentachat, $listesdocuments, $iddoc);

        // Print text using writeHTMLCell()
        // output the HTML content
        ob_end_clean();
        $pdf->writeHTML($html, true, false, true, false, '');
        $visaas = Doctrine_Core::getTable('ligavissig')->findByIdDoc($documentachat->getId());
        $conteurtext = 15;
        $conteurcercle = 250;
        //        foreach ($visaas as $visa) {
        //            $visaachat = new Visaachat();
        //            $vi = Doctrine_Core::getTable('visaachat')->findOneById($visa->getIdVisa());
        //            if ($vi) {
        //                $visaachat = $vi;
        //                $cheminimage = sfconfig::get('sf_appdir') . 'uploads/images/' . $visaachat->getChemin();
        //                $pdf->Image($cheminimage, $conteurtext - 5, $conteurcercle - 15, 30, 30, 'JPG', '', '', true, 50, '', false, false, 0, false, false, false);
        //                $pdf->Text($conteurtext, $conteurcercle + 10, $visa->getDatevisa());
        //                $pdf->Text($conteurtext, $conteurcercle + 15, $visaachat);
        //                // $pdf->Text($conteurtext, $conteurcercle+25, $visaachat->getAgents());
        //                // $pdf->Circle($conteurtext + 10, $conteurcercle, 15);
        //
        //                $conteurtext+=35;
        //            }
        //        }
        //        ob_end_clean();
        //          $pdf->Footer();
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('documentachat' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBCIducontrat($societe, $aviss, $documentachat, $listesdocuments, $iddoc) {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBCIDucontrat($iddoc);
        return $html;
    }

    public function executeImprimerdocachatcontrat(sfWebRequest $request) {
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
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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


        $html = $this->ReadHtmlBCIContrat($societe, $aviss, $documentachat, $listesdocuments);

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

                $conteurtext += 35;
            }
        }

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('documentachat' . $documentachat->getNumero() . $documentachat->getId() . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBCIContrat($societe, $aviss, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBonCommandeInternecontrat($aviss, $listesdocuments);
        return $html;
    }

    public function executeExporterdocumentExcel(sfWebRequest $request) {
        $datedebut = "";
        $datefin = "";
        $reference = "";
        $datedebut = $request->getParameter('datedebut', '');
        $datefin = $request->getParameter('datefin', '');
        $reference = $request->getParameter('reference', '');
        $this->datedebut = $datedebut;
        $this->datefin = $datefin;
        $this->reference = $reference;
    }

    public function executeImprimerboncomande(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');
        $pdf = new sfTCPDF('L');
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche B.C.I');
        $pdf->SetSubject("Fiche B.C.I");
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

        $html = $this->ReadHtmlBoncommande($iddoc);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Fiche B.C.I.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBoncommande($iddoc) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBoncommmande($iddoc);
        return $html;
    }

    public function executeAffichelignecontrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Contrat = $params['id'];

            $query = "select contrat.montantcontrat as montantcontrat , "
                    . "lg.mntht ,lg.nordre as norgdre, "
                    . "lg.id, "
                    . " lg.designationartcile as designation, lg.codearticle as codearticle,"
                    . " lg.observation as observation, "
                    . " lg.mntht as totalhax, "
                    . " lg.mntthtva as totalhtva ,"
                    . "  tv.libelle as tva ,"
                    . "  tv.id as idtva ,"
                    . " mntttc as totalttc,"
                    . " fodec as fodec,"
                    . " fode.id as idtaufodec,"
                    . " fode.libelle as taufodec , "
                    . " prixu as puht,"
                    . " lg.id_projet as idprojet,"
                    . " projet.libelle as projet,"
                    . " lg.qte as qte  "
//                    . " from lignecontrat,tva,tauxfodec"
                    . " from lignecontrat lg"
                    . "  left Join Projet projet on lg.id_projet=projet.id "
                    . " left Join Tauxfodec fode on fode.id = lg.id_tauxfodec "
                    . " left Join Tva  tv on tv.id = lg.id_tva "
                    . " left Join Contratachat contrat  on contrat.id = lg.id_contrat "
                    //. " where lignecontrat.id_projet = projet.id"
//                    . " where lignecontrat.id_tauxfodec=tauxfodec.id "
                    . " where lg.id_contrat=" . $id_Contrat
                    . " and contrat.id = " . $id_Contrat
//                    . " and lignecontrat.id_tva=tva.id "
                    . " order by id asc";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die("bien");
    }

    public function executeAffichagefournisseur(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Contrat = $params['id_contrat'];

            $query = "select  contratachat.montantcontrat as montantcontrat, "
                    . "fournisseur.id as id_frs , fournisseur.rs as rs  "
                    . " from fournisseur,contratachat"
                    . " where contratachat.id_frs = fournisseur.id"
                    . " and contratachat.id=" . $id_Contrat;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die("Erreur");
    }

    public function executeGetListeAnnuleNonValideCg(sfWebRequest $request) {
        $query = "select documentachat.id as id, "
                . " documentachatannulation.dateannulation as date,"
                . " LPAD(documentachat.numero::text, 5, '0') as numero, typedoc.prefixetype as type, "
                . " concat(agents.nomcomplet,' ',agents.prenom ,' ',agents.idrh) as user"
                . " from documentachatannulation, documentachat, utilisateur, agents, typedoc "
                . " where documentachatannulation.id_documentachat=documentachat.id and "
                . " documentachat.id_typedoc=typedoc.id "
                . " AND documentachatannulation.id_user = utilisateur.id"
                . " and utilisateur.id_parent=agents.id"
                . " AND utilisateur.id_parent = agents.id "
                . " AND documentachatannulation.valide_budget is null "
                . " and documentachat.id_etatdoc=33"
                . "  order by documentachatannulation.id desc ";
        //die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeListeBCEAnnule(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->date_debut = $request->getParameter('debut');
        $this->date_fin = $request->getParameter('fin');
        $this->idfrs = $request->getParameter('idfrs');
        $this->pager = $this->getDocumentachatBCEAnnuler($request);
    }

    function getDocumentachatBCEAnnuler(sfWebRequest $request) {
        $date_debut = $request->getParameter('debut');
        $date_fin = $request->getParameter('fin');
        $idfrs = $request->getParameter('idfrs');
        $page = $request->getParameter('page', 1);
        $pager = new sfDoctrinePager('Documentachatannulation', 5);
        $pager->setQuery(DocumentachatannulationTable::getInstance()->getAllDocBCEAnnuler($date_debut, $date_fin));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        return $pager;
    }

    public function executeListeBDCAnnule(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->date_debut = $request->getParameter('debut');
        $this->date_fin = $request->getParameter('fin');
        $this->idfrs = $request->getParameter('idfrs');
        $this->pager = $this->getDocumentachatBDCAnnuler($request);
    }

    function getDocumentachatBDCAnnuler(sfWebRequest $request) {
        $date_debut = $request->getParameter('debut');
        $date_fin = $request->getParameter('fin');
        $idfrs = $request->getParameter('idfrs');
        $page = $request->getParameter('page', 1);
        $pager = new sfDoctrinePager('Documentachatannulation', 5);
        $pager->setQuery(DocumentachatannulationTable::getInstance()->getAllDocBDCAnnuler($date_debut, $date_fin));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        return $pager;
    }

    public function executeListeAnnule(sfWebRequest $request) {
        $this->texte = "";
        $this->id = "";
        $this->date_debut = $request->getParameter('debut');
        $this->id_type = $request->getParameter('id_type');
        $this->date_fin = $request->getParameter('fin');
        $this->idfrs = $request->getParameter('idfrs');
        $this->pager = $this->getDocumentachatAnnuler($request);
    }

    function getDocumentachatAnnuler(sfWebRequest $request) {
        $date_debut = $request->getParameter('debut');
        $id_type = $request->getParameter('id_type');
        $date_fin = $request->getParameter('fin');
        $idfrs = $request->getParameter('idfrs');
        $page = $request->getParameter('page', 1);
        $pager = new sfDoctrinePager('Documentachatannulation', 5);
        $pager->setQuery(DocumentachatannulationTable::getInstance()->getAllDocAnnuler($date_debut, $date_fin, $id_type));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        return $pager;
    }

    public function executeShowAnnule(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');
        $this->document_annule = DocumentachatannulationTable::getInstance()->findOneByIdDocumentachat($iddoc);
        $this->id = $iddoc;
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

    public function executeImprimerBCEProvisoire(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');
        $pdf = new sfTCPDF('');
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche B.C.E Provisoire');
        $pdf->SetSubject("Fiche B.C.E Provisoire");
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

        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(7, 30, 7);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(12);
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

        $html = $this->ReadHtmlBCEProvisoire($iddoc);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Fiche B.C.E Provisoire.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBCEProvisoire($iddoc) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBCEProvisoire($iddoc);
        return $html;
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

    public function executeImprimerBDCRegroupeProvisoire(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');


        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche B.D.C Regroupe Provisoire');
        $pdf->SetSubject("Fiche B.D.C Regroupe Provisoire");
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

        $html = $this->ReadHtmlBDCRegroupeProvisoire($iddoc);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Fiche B.D.C Regroupe Provisoire.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBDCRegroupeProvisoire($iddoc) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBDCRegroupeProvisoire($iddoc);
        return $html;
    }

    public function executeImprimerBDCProvisoire(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');
        $id_typedoc = $request->getParameter('id_typedoc');
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche B.D.C Provisoire');
        $pdf->SetSubject("Fiche B.D.C Provisoire");
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

        $html = $this->ReadHtmlBDCProvisoire($iddoc);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Fiche B.D.C Provisoire.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBDCProvisoire($iddoc) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBDCProvisoire($iddoc);
        return $html;
    }

    public function executeAddLigne(sfWebRequest $request) {

        $id_Contrat = $request->getParameter('id_ligne_achat');
        $id_ligne = $request->getParameter('id_ligne');
        $nordre = $request->getParameter('nordre');
        //        die($id_Contrat.'r'.$id_ligne.'ggggg' .$nordre);
        //        die('fr' . $id_ligne . 'ghb');
        $this->id_contrat = $id_Contrat;
        $this->numero_ligne = 0;

        $this->id_ligne = $id_ligne;
        $this->nordre = $nordre;
    }

    public function executeImprimerlisteDocachatAnnuler(sfWebRequest $request) {
        //        die('hh');
        //        if($request->getParameter('arraycourrier'))
        //            die($request->getParameter('arraycourrier'));
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $pdf = new sfTCPDF();

        $pdf->SetTitle('Listes des bons Commnades Annulés ');
        $pdf->SetSubject("Listes des bons Commnade Annulés");

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
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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

        $html = $this->ReadHtmlListesDocumentAnnule($request);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('ListesBCI Annulés' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListesDocumentAnnule(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlBCIAnnule($request);
        return $html;
    }

    public function executeExporterlisteDocumentachatAnnule(sfWebRequest $request) {
        $datedebut = "";
        $datefin = "";
        $reference = "";
        $datedebut = $request->getParameter('datedebut', '');

        $id_type = $request->getParameter('id_type', '');
        $datefin = $request->getParameter('datefin', '');
        $idfrs = $request->getParameter('idfrs', '');
        $this->date_debut = $datedebut;
        $this->date_fin = $datefin;
        $this->idfrs = $idfrs;

        $this->id_type = $id_type;
    }

    public function executeImprimerbondeponseRegrouppe(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

        $listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);

        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Bon de déponse aux comptant Regroupe Défifnitif');
        $pdf->SetSubject("Bon de déponse aux comptant Regroupe Défifnitif");
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
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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


        $html = $this->ReadHtmlBondeponseRegroupeDef($societe, $documentachat, $listesdocuments);
        //die($html);
        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.

        $pdf->Output('Bon de déponse aux comptant Regroupe Défifnitif' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBondeponseRegroupeDef($societe, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $doc = new Documentachat();
        $html .= $documentachat->ReadHtmlBondeponseRegroupeDefinitif($documentachat->getId());
        //die($html);
        return $html;
    }

}

//  public function executeAfficheligneListeboninterne(sfWebRequest $request) {
//        header('Access-Control-Allow-Origin: *');
//
//        $params = array();
//        $content = $request->getContent();
//        $user = $this->getUser()->getAttribute('userB2m');
//        if (!empty($content)) {
//            $params = json_decode($content, true);
//            $id_Bon_Comm_Interne = $params['id'];
//            $id_Bon_Comm_Interne = explode(',', $id_Bon_Comm_Interne);
//
////            $array = array($id_Bon_Comm_Interne);
//
//            $query = "select lignedocachat.unitedemander, "
//                    . "lignedocachat.mntht ,designationarticle as designation, lignedocachat.observation as observation , "
////                    . " SUM(qtelignedoc.qteaachat) as qte"
//                    ." lignedocachat.qte as qte"
//                    . ",SUM(qtelignedoc.qteaachat) as qtemax,"
//                    . " id_articlestock as id_articlestock, codearticle, id_unitemarche, lignedocachat.id_projet ,"
//                    . " CAST( (lignedocachat.mntht/qte) as decimal(18,3)) as puht "
//                    . ", lignedocachat.mntht as totalhax , "
//                    . " tauxfodec.libelle  as taufodec,"
//                    . "   lignedocachat.mntfodec as fodec,"
//                    . "  lignedocachat.mntthtva as totalhtva,"
//                    . "  tva.libelle as tva,lignedocachat.mntttc as totalttc , documentachat.mntttc as total_ttc"
//                    . " from lignedocachat,qtelignedoc,tauxfodec,tva,documentachat"
//                    . " where id_doc IN (" . implode(',', array_map('intval', $id_Bon_Comm_Interne)) . ") "
//                    . "and qtelignedoc.id_lignedocachat=lignedocachat.id "
//                    . " and documentachat.id=lignedocachat.id_doc"
//                    . " and  lignedocachat.id_tauxfodec=tauxfodec.id"
//                    . " and lignedocachat.id_tva= tva.id"
//                    . " group by (lignedocachat.observation, id_articlestock, "
//                    . "lignedocachat.unitedemander, lignedocachat.mntht,"
//                    . " designation, codearticle, id_unitemarche, lignedocachat.id_projet,lignedocachat.qte,"
//                    . " lignedocachat.mntht , tauxfodec.libelle,lignedocachat.mntfodec,lignedocachat.mntthtva"
//                    . "   ,tva.libelle,lignedocachat.mntttc,documentachat.mntttc)";
////                    . " order by lignedocachat.id asc";
////die($query);
//            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//            $listearticles = $conn->fetchAssoc($query);
//            die(json_encode($listearticles));
//        }
//        die("bien");
//    }