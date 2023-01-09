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
        // die($this->documentachat->NumeroSeqDocumentAchat().'hh');
        $this->documentachat->setNumero($this->documentachat->NumeroSeqDocumentAchat(6));
        $this->documentachat->setDatecreation(date('Y-m-d'));
    }

    public function executeIndex(sfWebRequest $request) {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }
        $idtype = 6;
        if ($request->getParameter('idtype'))
            $idtype = $request->getParameter('idtype');
        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }

        $this->pager = $this->getPager($idtype);
        $this->sort = $this->getSort();
        $this->idtype = $idtype;
    }

    protected function getPager($idtype) {
        $pager = $this->configuration->getPager('documentachat');
        $pager->setQuery($this->buildQuery($idtype));
        $pager->setPage($this->getPage());
        $pager->init();

        return $pager;
    }

    //______________________________________________________________________Remplir les demande de prix
    public function executeRemplirdemandedeprix(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        $iddoc = $request->getParameter('iddoc');
        $this->lieuxlivraisons = Doctrine_Core::getTable('lieulivraisson')->findAll();
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $demande_prix = new Documentachat();
//        $demande_de_prix = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedocAndIdDocparent($iddoc, 8,$iddoc);
        $this->numerodemande = $demande_prix->getNumeroBonCommandeInterne($iddoc);
        $this->refernece = $demande_prix->getNumeroSeqDemandeDePrixParBCI($iddoc);
    }

    //______________________________________________________________________Affiche listes des fournisseurs
    public function executeListefournisseur(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $q = Doctrine_Query::create()
                ->select("fournisseur.id, fournisseur.rs as name, fournisseur.reference as ref ")
                ->from('fournisseur');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $frs = strtoupper($params['frs']);
            $ref = strtoupper($params['ref']);
            if ($frs != "")
                $q = $q->where("upper(rs) like '%" . $frs . "%' or upper(nom) like '%" . $frs . "%' or upper(prenom) like '%" . $frs . "%'");

            if ($ref != "")
                $q = $q->Where("upper(reference) like '%" . $ref . "%'");
        }
        $q = $q->orderBy('id desc')->limit('100');

        $listefournisseur = $q->fetchArray();
        die(json_encode($listefournisseur));
    }

    //______________________________________________________________________Réquette affichier listes documents desc
    protected function buildQuery($idtype) {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);
        $filter = $this->getFilters();

        $query = $this->filters->buildQuery($this->getFilters());
        $documentsachat = Doctrine_Core::getTable('documentachat')
                        ->createQuery('a')->where('id_typedoc=' . $idtype);
        if (isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        }
        if (isset($filter['datecreation']['from']) && !isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
        }
        if (!isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {

            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
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

    public function executeShowdocumentBDCR(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');
        $iddoc = $request->getParameter('iddoc');
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

    public function executeShowdocumentBDCNULL(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');
        $iddoc = $request->getParameter('iddoc');
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

    public function executeShowdocumentContrat(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');
        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->documentachat=$documentachat;
//        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        if ($documentachat->getIdTypedoc() != 20 && $documentachat->getIdTypedoc() != 19 )
            $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        else
            $this->listesdocuments = Doctrine_Core::getTable('lignecontrat')->findByIdContrat($documentachat->getIdContrat());
  
    }

    public function executeShowdocumentContratDef(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');
        $iddoc = $request->getParameter('iddoc');
        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->documentachat = $documentachat;
        $contratachat = ContratachatTable::getInstance()->find($documentachat->getIdContrat());
        $this->contratachat = $contratachat;
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        $this->listesdocumentscontrat = Doctrine_Core::getTable('lignecontrat')->findByIdContrat($documentachat->getIdContrat());
    }

    public function executeShowdocumentBCE(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');
        $iddoc = $request->getParameter('iddoc');
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
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
            $id_nature = $params['id_nature'];
            $user = new Utilisateur();
            $user = $this->getUser()->getAttribute('userB2m');
            //______________________ajouter document achat
            $documentachat = new Documentachat();
            $numero = $documentachat->NumeroSeqDocumentAchat(6);
            $documentachat->setNumero($numero);
            $documentachat->setIdDemandeur($iddemandeur);
            if ($id_nature && $id_nature != "")
                $documentachat->setIdObjet($id_nature);
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
                $observation = $lignedoc['observation'];
                $unitedemander = $lignedoc['unitedemander'];
                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                //$lignedoc->setEtatligne("EnCours");
                //$lignedoc->setQtedemander($qte);
                if ($observation && $observation != "")
                    $lignedoc->setObservation($observation);
                if ($unitedemander && $unitedemander != "")
                    $lignedoc->setUnitedemander($unitedemander);
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
//                $qte = number_format($qte,3,'.','.');
                // die($qte.'hh');
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

    //________________________________________________________Valider Visa et passer a la processus suivant
    public function executeValidervisa(sfWebRequest $request) {
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
//         $this->quitance = LigneoperationcaisseTable::getInstance()->findOneByIdDocachat($iddoc);
        //Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

    public function executeShowdocumentBDC(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')
                        ->createQuery('a')
                        ->where('id_doc=' . $iddoc)->orderBy('id asc')->execute();
//         $this->quitance = LigneoperationcaisseTable::getInstance()->findOneByIdDocachat($iddoc);
        //Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

    public function executeShowdocumentAvecQuitance(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');
        $iddoc = $request->getParameter('iddoc');
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        $this->quitance = LigneoperationcaisseTable::getInstance()->findOneByIdDocachat($iddoc);
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
        //_________suppr. ligne doc
        Doctrine_Query::create()->delete('lignedocachat')
                ->where('id_doc=' . $iddoc)->execute();
        $this->forward404Unless($documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id'))), sprintf('Object fiche does not exist (%s).', $request->getParameter('id')));
        $documentachat->delete();

        $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        $this->redirect('@documentachat');
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
            if ($idvisa != 0) {
                $lignevisadoc = new Ligavissig();
                $ligne = Doctrine_Core::getTable('ligavissig')->findOneByIdDocAndIdVisa($iddoc, $idvisa);
                if ($ligne)
                    $lignevisadoc = $ligne;
                $lignevisadoc->setIdDoc($iddoc);
                $lignevisadoc->setIdVisa($idvisa);
                $lignevisadoc->setDatevisa($datevisa);
                $lignevisadoc->save();
            }
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT   visaachat.chemin,  CONCAT(visaachat.libelle,'',agents.nomcomplet) as ag, "
                    . " ligavissig.id,ligavissig.datevisa "
                    . "FROM    documentachat,  visaachat,   ligavissig,   agents "
                    . "WHERE   visaachat.id_agent = agents.id "
                    . "AND   ligavissig.id_visa = visaachat.id "
                    . "AND   ligavissig.id_doc = documentachat.id   "
                    . "AND documentachat.id=" . $iddoc;
            //die($query);
            $listevisadoc = $conn->fetchAssoc($query);
            die(json_encode($listevisadoc));
        }
        die('bien');
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
            $delai = $params['delai'];
            $datemax = date('Y-m-d', strtotime($params['datemax']));
            $ref = $params['ref'];
            $numero_dp = $params['numerodoc'];
            $listeslignesdoc = $params['listearticle'];
            $numerodossier = $params['numerodossier'];
            $lieu = $params['idlieu'];
            $frs = $params['frs'];
            $objet = $params['objet'];
            $fournisseurs = Doctrine_Query::create()
                            ->select("*")
                            ->from('fournisseur')
                            ->where("rs like '%" . $frs . "%'")->execute();
            $fournisseur = new Fournisseur();
            if (count($fournisseurs) > 0)
                $fournisseur = $fournisseurs[0];
            else {
                $fournisseur->setRs($frs);
                $fournisseur->save();
            }

            $achat = new Documentachat();
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
            $achat = $achat_document;
            //______________________ajouter document demande de prix
            $documentachat = new Documentachat();

            $documentachat->setNumero($numero_dp);
            if ($numerodossier && $numerodossier != "")
                $documentachat->setNumerodossier($numerodossier);
            if ($lieu && $lieu != 0) {
                $documentachat->setIdLieu($lieu);
            }
            $documentachat->setIdFrs($fournisseur->getId());
            $documentachat->setIdTypedoc(8);
            $documentachat->setIdDocparent($achat->getId());
            //$documentachat->setReference($achat->getNumero());
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

            foreach ($listeslignesdoc as $ldoc) {
                $norgdre = $ldoc['norgdre'];
                $designation = $ldoc['designation'];
                $qte = $ldoc['qte'];
                $unite = $ldoc['unitedemander'];

                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                if ($unite && $unite != "")
                    $lignedoc->setUnitedemander($unite);
//                $lignedoc->setEtatligne("EnCours");
                $lignedoc->setDesignationarticle($designation);

                $lignedoc->save();
                $qteachat = new Qtelignedoc();
                $qteachat->setIdLignedocachat($lignedoc->getId());
                $qteachat->setQteaachat($qte);
                $qteachat->save(); //die($qteachat.'hh');
                $ErpHistorique = new Erphistorique();
                $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
            }

            $ErpHistorique = new Erphistorique();
            $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);
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

    //__________________________________________________________________________Liste bon de deponse Listebondeponse
    public function executeListebondeponse(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            // $documentfils = Doctrine_Core::getTable('documentachat')->findOneByIdDocparent($iddoc);
            $query = "select typedoc.id as idtypedoc, CONCAT(fournisseur.rs,' ----Nom du Responsable:   ',fournisseur.nom,fournisseur.prenom) as rs, documentachat.etatdocachat,  documentachat.id,documentachat.numero, typedoc.libelle as typedoc"
                    . " from fournisseur,documentachat,typedoc "
                    . " where (documentachat.id_typedoc=2 or documentachat.id_typedoc=17)   "
                    . "and typedoc.id=documentachat.id_typedoc "
                    . "and  documentachat.id_frs = fournisseur.id "
                    . "and documentachat.id_docparent=" . $iddoc . " ";
            // . "and documentachat.id not in(select id_fils from documentachat where id_typedoc=2  )";
            //die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        //die($q);
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
            // $documentfils = Doctrine_Core::getTable('documentachat')->findOneByIdDocparent($iddoc);
            $query = "select typedoc.id as idtypedoc, "
                    . "CONCAT(fournisseur.rs,' ----Nom du Responsable: ',fournisseur.nom,fournisseur.prenom) as rs, documentachat.id,documentachat.numero, typedoc.prefixetype as typedoc"
                    . " from fournisseur,documentachat,typedoc "
                    . " where (documentachat.id_typedoc=18) "
                    . "and typedoc.id=documentachat.id_typedoc "
                    . "and documentachat.id_frs = fournisseur.id "
                    . "and documentachat.id_docparent=" . $iddoc . " ";
            // . "and documentachat.id not in(select id_fils from documentachat where id_typedoc=2)";

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
            $documentfils = Doctrine_Core::getTable('documentachat')->findOneByIdDocparent($iddoc);
            $query = "select typedoc.id as idtypedoc, typedoc.libelle as libelletypedoc, CONCAT(fournisseur.rs,' ----Nom&Prenom Responsable:   ',fournisseur.nom,fournisseur.prenom) as rs"
                    . ",documentachat.etatdocachat as atrb, "
                    . "documentachat.etatdocachat,  documentachat.id,documentachat.numero"
                    . " from fournisseur,documentachat,typedoc"
                    . " where documentachat.id_typedoc=typedoc.id and "
                    . "(documentachat.id_typedoc=7 or documentachat.id_typedoc=18) "
                    . "and  documentachat.id_frs = fournisseur.id and documentachat.id_docparent=" . $iddoc;
            // die($query);
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

            $query = "select lignedocachat.id as idligne,documentachat.id as demandedeprixid,"
                    . "lignedocachat.nordre,lignedocachat.designationarticle,   "
                    . "fournisseur.rs,qtelignedoc.qteaachat, fournisseur.adr as adrs, "
                    . "CONCAT('E-mail:', fournisseur.mail,' Tél:', fournisseur.tel,' Gsm:', fournisseur.gsm) as annuaire  "
                    . "from fournisseur, lignedocachat, documentachat ,qtelignedoc "
                    . "where   lignedocachat.id=qtelignedoc.id_lignedocachat "
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
                        ->where('id=' . $request->getParameter('iddoc'))
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

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->liste_bcc = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
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
        $this->lieuxlivraisons = Doctrine_Core::getTable('lieulivraisson')->findAll();
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->liste_bcc = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
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
    }

    //__________________________________________________________________________Listes des TVA
    public function executeListetva(sfWebRequest $request) {

        $listes_tva = Doctrine_Query::create()
                ->select("*")
                ->from('tva');

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
            $idfils = $params['id_fils'];
            $id_lieu = $params['id_lieu'];
            $listeslignesdoc = $params['listearticle'];
            $frs = $params['frs'];
            $fournisseurs = Doctrine_Query::create()
                            ->select("*")
                            ->from('fournisseur')
                            ->where("rs like '%" . $frs . "%'")->execute();
            $fournisseur = new Fournisseur();
            if (count($fournisseurs) > 0)
                $fournisseur = $fournisseurs[0];
            else {
                $fournisseur->setRs($frs);
                $fournisseur->save();
            }

            $achat = new Documentachat();
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
            $achat = $achat_document;
            //______________________ajouter document demande de prix
            $documentachat = new Documentachat();
            $numero = $documentachat->getNumeroBDCDParBCI($achat->getId());
            $documentachat->setNumero($numero);
            $documentachat->setIdFrs($fournisseur->getId());
            $documentachat->setIdTypedoc(2);
            $documentachat->setIdDocparent($achat->getId());
            $documentachat->setReference($achat->getNumero());
            $documentachat->setIdUser($user->getId());
            $documentachat->setIdEtatdoc(12);
            $documentachat->setDatecreation(date('Y-m-d'));
            if ($idfils != 0) {
                $documentachat->setIdFils($idfils);
                $documentachat->save();
                // valider budget ....
                $documentachat->ExporterBudgetVersBdC($idfils);
            }
            if ($id_lieu != '0')
                $documentachat->setIdLieu($id_lieu);
            $documentachat->save();
            $mntht = 0;
            $mntttc = 0;
            $pttva = 0;
            foreach ($listeslignesdoc as $lignedoc) {
                $norgdre = $lignedoc['norgdre'];
                $designation = $lignedoc['designation'];
                $qte = $lignedoc['qte'];
                $puht = $lignedoc['puht'];
                $idtva = $lignedoc['idtva'];
                $observation = $lignedoc['observation'];
                $unite = $lignedoc['unitedemander'];
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
                //$lignedoc->setQte($qte);
                $lignedoc->setMntht($puht);
                $tva = Doctrine_Core::getTable('tva')->findOneById($idtva);
                $mntht+=$qte * $puht;
                if ($tva) {
                    $prixttc = $puht * (1 + ($tva->getValeurtva() / 100));
                    $mnttva = $prixttc - $puht;
                    $lignedoc->setMntttc($prixttc);
                    $mntttc+=$qte * $prixttc;
                    $lignedoc->setMnttva($mnttva);
                    $pttva+=$qte * $mnttva;
                }
                $lignedoc->setIdTva($idtva);
                $lignedoc->setObservation($observation);
                // $lignedoc->set
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
            die("Bon de dépense aux comptant crée avec succès");
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
            $mnttotal = $params['mnttotal'];

            $listeslignesdoc = $params['listearticle'];
            $frs = $params['frs'];
            $fournisseurs = Doctrine_Query::create()
                            ->select("*")
                            ->from('fournisseur')
                            ->where("rs like '%" . $frs . "%'")->execute();
            $idlieux = $params['lieulivraison'];
            $fournisseur = new Fournisseur();
            if (count($fournisseurs) > 0)
                $fournisseur = $fournisseurs[0];
            else {
                $fournisseur->setRs($frs);
                $fournisseur->save();
            }

            $achat = new Documentachat();
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
            $achat = $achat_document;
            //______________________ajouter document demande de prix
            $documentachat = new Documentachat();
            $numero = $documentachat->getNumeroBDCPParBCI($achat->getId());
            $documentachat->setNumero($numero);
            $documentachat->setIdFrs($fournisseur->getId());
            $documentachat->setIdTypedoc(17);
            $documentachat->setIdDocparent($achat->getId());
            $documentachat->setReference($achat->getNumero());
            $documentachat->setIdUser($user->getId());
            $documentachat->setIdEtatdoc(24);
            $documentachat->setDatecreation(date('Y-m-d'));
            //lieu de livraison
            if ($idlieux != "0")
                $documentachat->setIdLieu($idlieux);
            $documentachat->save();



            foreach ($listeslignesdoc as $lignedoc) {
                $norgdre = $lignedoc['norgdre'];
                $designation = $lignedoc['designation'];
                $qte = $lignedoc['qte'];
                $puht = $lignedoc['puht'];
                $unite = $lignedoc['unitedemander'];
//                $idtva = $lignedoc['idtva'];
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
                //$lignedoc->setQte($qte);
                if ($puht)
                    $lignedoc->setMntht($puht);
                /* $tva = Doctrine_Core::getTable('tva')->findOneById($idtva);
                  $mntht+=$qte * $puht;
                  if ($tva) {
                  $prixttc = $puht * (1 + ($tva->getValeurtva() / 100));
                  $mnttva = $prixttc - $puht;
                  $lignedoc->setMntttc($prixttc);
                  $mntttc+=$qte * $prixttc;
                  $lignedoc->setMnttva($mnttva);
                  $pttva+=$qte * $mnttva;
                  } */
                //$lignedoc->setIdTva($idtva);
                $lignedoc->setObservation($observation);
                // $lignedoc->set
                $lignedoc->save();
                $qteligne = new Qtelignedoc();
                $qteligne->setIdLignedocachat($lignedoc->getId());
                $qteligne->setQtelivrefrs($qte);
                $qteligne->save();
                $ErpHistorique = new Erphistorique();
                $ErpHistorique->AjouterLigne($lignedoc->getId(), 'lignedocachat', $user->getId(), $user);
            }
//            $documentachat->setMht($mntht);
            if ($mnttotal != "" && $mnttotal >= 0) {
                $documentachat->setMntttc($mnttotal);
                $documentachat->save();
            }
//            $documentachat->setMnttva($pttva);

            $ErpHistorique = new Erphistorique();
            $ErpHistorique->AjouterLigne($documentachat->getId(), 'documentachat', $user->getId(), $user);
            die("Bon de dépense aux comptant provisoire crée avec succès");
        }
        die('Erreur .....!!!!');
    }

    //enregister contrat
    public function executeSavecontrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $mnttotal = $params['mnttotal'];

            $listeslignesdoc = $params['listearticle'];
            $frs = $params['frs'];
//            $fournisseurs = Doctrine_Query::create()
//                            ->select("*")
//                            ->from('fournisseur')
//                            ->where("rs like '%" . $frs . "%'")->execute();
//
//            $fournisseur = new Fournisseur();
//            if (count($fournisseurs) > 0)
//                $fournisseur = $fournisseurs[0];
//            else {
//                $fournisseur->setRs($frs);
//                $fournisseur->save();
//            }

            $achat = new Documentachat();
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
            $achat = $achat_document;
            //______________________ajouter document demande de prix
            $documentachat = new Documentachat();
            $numero = $documentachat->getNumeroBDCPParBCI($achat->getId());
            $documentachat->setNumero($numero);
            $documentachat->setIdFrs($frs);
            $documentachat->setIdTypedoc(19);
            $documentachat->setIdDocparent($achat->getId());
            $documentachat->setReference($achat->getNumero());
            $documentachat->setIdUser($user->getId());
            $documentachat->setIdEtatdoc(21);
            $documentachat->setDatecreation(date('Y-m-d'));

            $documentachat->save();

            foreach ($listeslignesdoc as $lignedoc) {
                $norgdre = $lignedoc['norgdre'];
                $designation = $lignedoc['designation'];
                $qte = $lignedoc['qte'];
                $puht = $lignedoc['puht'];
                $unite = $lignedoc['unite'];
                $idtva = $lignedoc['idtva'];
                $observation = $lignedoc['observation'];
                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                //$lignedoc->setEtatligne("EnCours");
                if ($unite && $unite != "")
                    $lignedoc->setUnitedemander($unite);
                if ($designation != "") {
                    $lignedoc->setDesignationarticle($designation);
                }
                $lignedoc->setQte($qte);
                if ($puht)
                    $lignedoc->setMntht($puht);
                if (!empty($idtva)) {
                    $tva = Doctrine_Core::getTable('tva')->findOneById($idtva);
                    $mntht+=$qte * $puht;
                    if ($tva) {
                        $prixttc = $puht * (1 + ($tva->getValeurtva() / 100));
                        $mnttva = $prixttc - $puht;
                        $lignedoc->setMntttc($prixttc);
                        $mntttc+=$qte * $prixttc;
                        $lignedoc->setMnttva($mnttva);
                        $pttva+=$qte * $mnttva;
                    }
                    $lignedoc->setIdTva($idtva);
                }
                $lignedoc->setObservation($observation);

                $lignedoc->save();
            }
//            $documentachat->setMht($mntht);
            if ($mnttotal != "" && $mnttotal >= 0) {
                $documentachat->setMntttc($mnttotal);
                $documentachat->save();
            }
            die("Contrat n° " . $documentachat->getNumerodocachat() . " créé avec succès");
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
            $datemax = $params['datemax'];
            $id_note = $params['id_note'];
            $designation = $params['designation'];
            $id_lieu = $params['id_lieu'];
            $p = $params['p'];
            $id_fils = $params['id_fils'];
            $listeslignesdoc = $params['listearticle'];
            $frs = $params['frs'];
            $fournisseurs = Doctrine_Query::create()
                            ->select("*")
                            ->from('fournisseur')
                            ->where("rs like '%" . $frs . "%'")->execute();
            $fournisseur = new Fournisseur();
            if (count($fournisseurs) > 0)
                $fournisseur = $fournisseurs[0];
            else {
                $fournisseur->setRs($frs);
                $fournisseur->save();
            }

            $achat = new Documentachat();
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
            $achat = $achat_document;
            //______________________ajouter document demande de prix
            $documentachat = new Documentachat();
            if ($p === '') {
                $numero = $documentachat->NumeroSeqDocumentAchat(7);
                $documentachat->setIdTypedoc(7);
                $documentachat->setIdFils($id_fils);
                $documentachat->save();
                $documentachat->ExporterBudgetVersBdC($id_fils);
            } else {
                $numero = $documentachat->NumeroSeqDocumentAchat(18);
                $documentachat->setIdTypedoc(18);
            }
            // die($p);
            $documentachat->setNumero($numero);
            $documentachat->setIdFrs($fournisseur->getId());

            $documentachat->setIdDocparent($achat->getId());
            $documentachat->setReference($achat->getNumero());
            $documentachat->setIdUser($user->getId());
            $documentachat->setIdEtatdoc(24);
            $documentachat->setDatecreation(date('Y-m-d'));
            $documentachat->setMaxreponsefrs($datemax);
            $documentachat->setIdNote($id_note);
            $documentachat->setDesiegniation($designation);
            if ($id_lieu != 0)
                $documentachat->setIdLieu($id_lieu);
            $documentachat->save();
            $mntht = 0;
            $mntttc = 0;
            $pttva = 0;
            foreach ($listeslignesdoc as $lignedoc) {
                $norgdre = $lignedoc['norgdre'];
                $designation = $lignedoc['designation'];
                $qte = $lignedoc['qte'];
                $puht = $lignedoc['puht'];
                $idtva = $lignedoc['idtva'];
                $unite = $lignedoc['unitedemander'];
                $observation = $lignedoc['observation'];
                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                if ($unite && $unite != "")
                    $lignedoc->setUnitedemander($unite);
                // $lignedoc->setEtatligne("EnCours");
                if ($designation != "") {
                    $lignedoc->setDesignationarticle($designation);
                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
                    if ($article) {
                        $lignedoc->setIdArticlestock($article->getId());
                        $lignedoc->setCodearticle($article->getCodeart());
                    }
                }
                // $lignedoc->setQte($qte);
                $lignedoc->setMntht($puht);
                // die($idtva.'hh');
                $tva = Doctrine_Core::getTable('tva')->findOneById($idtva);
                //die($tva);
                $mntht+=$qte * $puht;
                if ($tva) {
                    $prixttc = $puht * (1 + ($tva->getValeurtva() / 100));
                    $mnttva = $prixttc - $puht;
                    $lignedoc->setMntttc($prixttc);
                    $mntttc+=$qte * $prixttc;
                    $lignedoc->setMnttva($mnttva);
                    $pttva+=$qte * $mnttva;
                }
                $lignedoc->setIdTva($idtva);
                $lignedoc->setObservation($observation);
                // $lignedoc->set
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

//___________________________________________________________________________Detail ligne doc DetailligneBondedeponse
    public function executeDetaillignedeponse(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idlignedoc = $params['idlignedoc'];

            $query = "select documentachat.id_lieu, documentachat.id as demandedeprixid,qtelignedoc.qtelivrefrs as qte,lignedocachat.mntht,"
                    . "lignedocachat.observation,lignedocachat.nordre,lignedocachat.designationarticle, "
                    . "  fournisseur.reference as ref, fournisseur.rs,fournisseur.adr  as adrs, "
                    . "CONCAT('E-mail:', fournisseur.mail,' Tél:',  fournisseur.tel,' Gsm:',   fournisseur.gsm) as annuaire "
                    . " from fournisseur, qtelignedoc,  lignedocachat,   documentachat  "
                    . "where qtelignedoc.id_lignedocachat=lignedocachat.id and"
                    . "   lignedocachat.id_doc = documentachat.id  "
                    . "AND   documentachat.id_frs = fournisseur.id "
                    . " AND  documentachat.id=" . $idlignedoc
                    . " group by demandedeprixid,lignedocachat.nordre,lignedocachat.designationarticle,"
                    . " adrs ,  "
                    . " ref, fournisseur.rs,annuaire ,qtelignedoc.qtelivrefrs,lignedocachat.mntht,lignedocachat.observation;";
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

            $query = "select documentachat.maxreponsefrs,documentachat.id_note as id_note,documentachat.observation,"
                    . " documentachat.id_lieu, documentachat.id as demandedeprixid,qtelignedoc.qtelivrefrs as qte,lignedocachat.mntht,"
                    . "lignedocachat.observation,lignedocachat.nordre,lignedocachat.designationarticle, "
                    . "  fournisseur.reference as ref, fournisseur.rs,fournisseur.adr  as adrs, "
                    . "CONCAT('E-mail:', fournisseur.mail,' Tél:',  fournisseur.tel,' Gsm:',   fournisseur.gsm) as annuaire "
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

    //__________________________________________________________________________Liste ligne bon de commande interne
    public function executeAfficheligneboninterne(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Bon_Comm_Interne = $params['id'];

            $query = "select lignedocachat.unitedemander, lignedocachat.mntht ,lignedocachat.nordre as norgdre, lignedocachat.id,designationarticle as designation,qtelignedoc.qteaachat as qte "
                    . " from lignedocachat,qtelignedoc"
                    . " where id_doc=" . $id_Bon_Comm_Interne . " and qtelignedoc.id_lignedocachat=lignedocachat.id "
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

            $query = "select lignedocachat.id_tva,lignedocachat.observation,lignedocachat.unitedemander, lignedocachat.mntht ,lignedocachat.nordre as norgdre, lignedocachat.id,designationarticle as designation,qtelignedoc.qtelivrefrs as qte "
                    . " from lignedocachat,qtelignedoc"
                    . " where id_doc=" . $id_Bon_Comm_Interne . " and qtelignedoc.id_lignedocachat=lignedocachat.id "
                    . " order by lignedocachat.id asc";


            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die("bien");
    }

    // donner l'état du bon du deponse aux comptant dans le budget -- imputation budgetaire --
    public function executeEtatbdcpenbudget(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_Bon_Comm_Interne = $params['id'];
            $docachat = Doctrine_Core::getTable('documentachat')->findOneByIdFils($id_Bon_Comm_Interne);
            if ($docachat)
                die('2');
            $piecej = new Piecejointbudget();
            $pieces = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($id_Bon_Comm_Interne);
            if ($pieces)
                die('0');
            else
                die('1');
        }
        die("bien");
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
        $demande_prix = new Documentachat();
        $demande_prix = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('iddemandedeprix'));
        $pdf->SetFont('dejavusans', '', 10, '', true);
//        $pdf->SetFont('aefurat', '', 10);
        $pdf->AddPage();
        $html = $demande_prix->ImpprimerDetailCheque();
        $pdf->writeHTML($html, true, false, true, false, '');
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

        $html = $this->ReadHtml($aviss, $documentachat, $listesdocuments);

        // Print text using writeHTMLCell()
        // output the HTML content
        ob_end_clean();
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
                $pdf->Text($conteurtext, $conteurcercle + 12, date('d/m/Y', strtotime($visa->getDatevisa())));
                $pdf->Text($conteurtext, $conteurcercle + 17, $visaachat);
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

    public function ReadHtml($aviss, $documentachat, $listesdocuments) {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBonCommandeInterne($aviss, $listesdocuments);
        return $html;
    }

    public function executeImprimerStockDocument(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $id = $request->getParameter('id');

        // pdf object
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle("Stock pour BCI");
        $pdf->SetSubject("Stock pour BCI");
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

        $html = $this->ReadHtmlStockDocument($id);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Stock pour BCI.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlStockDocument($id) {
        $html = StyleCssHeader::header1();
        $documentachat = new Documentachat();
        $html .= $documentachat->ReadHtmlStockDocument($id);
        return $html;
    }

    public function executeValiderEngagementContrat(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $etat_budget = $request->getParameter('etat_budegt');
        $documentachat = DocumentachatTable::getInstance()->find($id);
//        $documentachat->setIdEtatdoc(38);
//        $documentachat->setDatesignature(date('Y-m-d H:i:s'));
        if ($etat_budget == '1') {
            $documentachat->setIdEtatdoc(38);
            $documentachat->setDatevalidebudget(date('Y-m-d H:i:s'));
            $documentachat->setDatesignature(date('Y-m-d H:i:s'));
        }
        if ($etat_budget == '2') {
            $documentachat->setIdEtatdoc(53);
        }
        $documentachat->save();
        die("OK");
    }

    public function executeValiderEngagement(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $etat_budget = $request->getParameter('etat_budegt');
        $datevalidebudget = $request->getParameter('datevalidebudget');
        $documentachat = DocumentachatTable::getInstance()->find($id);

        if ($etat_budget == '1') {
            $documentachat->setIdEtatdoc(26);
            if ($documentachat->getIdTypedoc() == 17)
                $documentachat->setIdEtatdoc(39);
            $documentachat->setDatevalidebudget(date('Y-m-d H:i:s'));
            $documentachat->setDatesignature(date('Y-m-d H:i:s'));
        }
        if ($etat_budget == '2') {
            if ($documentachat->getIdTypedoc() == 17)
                $documentachat->setIdEtatdoc(52);
            if ($documentachat->getIdTypedoc() == 18)
                $documentachat->setIdEtatdoc(51);
            if ($documentachat->getIdTypedoc() == 19)
                $documentachat->setIdEtatdoc(53);
        }

        $documentachat->save();
        die($etat_budget);
    }

    public function executeValiderEngagementDefiBDCReg(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $etat_budget = $request->getParameter('etat_budegt');
        $datevalidebudget = $request->getParameter('datevalidebudget');
        $documentachat = DocumentachatTable::getInstance()->find($id);

        if ($etat_budget == '1') {
//            if ($documentachat->getIdTypedoc() == 22)
            $documentachat->setIdEtatdoc(65);
            $documentachat->setDatevalidebudget(date('Y-m-d H:i:s'));
            $documentachat->setDatesignature(date('Y-m-d H:i:s'));
        }
        if ($etat_budget == '2') {
//            if ($documentachat->getIdTypedoc() == 22)
            $documentachat->setIdEtatdoc(66);
        }
        $documentachat->save();
        die($etat_budget);
    }

    public function executeValiderEngagementBDC(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $etat_budget = $request->getParameter('etat_budegt');
        $datevalidebudget = $request->getParameter('datevalidebudget');
        $documentachat = DocumentachatTable::getInstance()->find($id);
        if ($etat_budget == '1') {
//            $documentachat->setIdEtatdoc(26);
//            if ($documentachat->getIdTypedoc() == 17)
            $documentachat->setIdEtatdoc(58);
            $documentachat->setDatevalidebudget(date('Y-m-d H:i:s'));
            $documentachat->setDatesignature(date('Y-m-d H:i:s'));
        }
        if ($etat_budget == '2') {
//            if ($documentachat->getIdTypedoc() == 17)
            $documentachat->setIdEtatdoc(52);
        }

        $documentachat->save();
        die($etat_budget);
    }

    public function executeValiderEngagementBDCNULL(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $etat_budget = $request->getParameter('etat_budegt');
        $datevalidebudget = $request->getParameter('datevalidebudget');
        $documentachat = DocumentachatTable::getInstance()->find($id);
        if ($etat_budget == '1') {
            $documentachat->setIdEtatdoc(72);
            $documentachat->setDatevalidebudget(date('Y-m-d H:i:s'));
            $documentachat->setDatesignature(date('Y-m-d H:i:s'));
        }
        if ($etat_budget == '2') {
            $documentachat->setIdEtatdoc(71);
        }

        $documentachat->save();
        die($etat_budget);
    }

    public function executeValiderEngagementBCEDEfinitif(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $etat_budget = $request->getParameter('etat_budegt');
        $datevalidebudget = $request->getParameter('datevalidebudget');
        $documentachat = DocumentachatTable::getInstance()->find($id);
        if ($etat_budget == '1') {
            $documentachat->setIdEtatdoc(72);
            $documentachat->setDatevalidebudget(date('Y-m-d H:i:s'));
            $documentachat->setDatesignature(date('Y-m-d H:i:s'));
        }
        if ($etat_budget == '2') {
            $documentachat->setIdEtatdoc(71);
        }

        $documentachat->save();
        die($etat_budget);
    }

    public function executeValiderToutEngagement(sfWebRequest $request) {
        $id = $request->getParameter('id');

        $documentbudget = DocumentbudgetTable::getInstance()->find($id);
        foreach ($documentbudget->getPiecejointbudget() as $piece_jointe) {
            $documentachat = $piece_jointe->getDocumentachat();
            if ($documentachat->getDatesignature() == null) {
                $documentachat->setDatesignature(date('Y-m-d'));
                $documentachat->save();
            }
        }

        die("OK");
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

    public function executeImprimerBDCProvisoire(sfWebRequest $request) {
        $iddoc = $request->getParameter('iddoc');
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

}
