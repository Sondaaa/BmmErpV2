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

    public function executeNew(sfWebRequest $request) {
        $this->idtype = 9;
        if ($request->getParameter('idtype'))
            $this->idtype = $request->getParameter('idtype');

        $this->form = $this->configuration->getForm();
        $this->documentachat = $this->form->getObject();

        $this->documentachat->setIdTypedoc($this->idtype);
        $this->documentachat->setNumero($this->documentachat->NumeroSeqDocumentAchat(9));
        $this->documentachat->setDatecreation(date('Y-m-d'));
    }

    public function executeEdit(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->documentachat = DocumentachatTable::getInstance()->find($id);
        $this->form = $this->configuration->getForm($this->documentachat);
    }

    public function executeIndex(sfWebRequest $request) {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }
        $idtype = 9;
        if ($request->getParameter('idtype'))
            $idtype = $request->getParameter('idtype');
        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }
        $this->idtype = $idtype;
        $this->pager = $this->getPager($idtype);
        $this->sort = $this->getSort();
    }

    protected function getPager($idtype) {
        $pager = $this->configuration->getPager('documentachat');
        $pager->setQuery($this->buildQuery($idtype));
        $pager->setPage($this->getPage());
        $pager->init();

        return $pager;
    }

    //______________________________________________________________________Remplir les demande de prix
    public function executeRemplirfichemarche(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->form = new MarchesForm();
    }

    //______________________________________________________________________Affiche listes des fournisseurs
    public function executeListefournisseur(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $q = Doctrine_Query::create()
                ->select("fournisseur.id, fournisseur.rs as name,fournisseur.reference as ref ")
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

        // die($query);

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
                    ->select(" article.id,article.codearticle as ref, article.deseignation as name")
                    ->from('article');
            if ($codearticle != "" && $designation == "")
                $q = $q->where("codearticle like '%" . $codearticle . "%'");
            if ($codearticle == "" && $designation != "")
                $q = $q->Where("upper(deseignation) like '%" . $designation . "%'");
            if ($codearticle != "" && $designation != "")
                $q = $q->Where("upper(deseignation) like '%" . $designation . "%'")
                        ->AndWhere("codearticle like '%" . $codearticle . "%'");

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
        //die($q);
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

        // die($q);

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
            $idtypedoc = $params['typedoc']; //die($idtypedoc.'hh');
            $ref = $params['ref'];
            $listeslignesdoc = $params['listeslignesdoc'];
            $montant_estimatif = $params['montant_estimatif'];
            $iddoc = $params['iddoc'];
            $user = new Utilisateur();
            $user =  $this->getUser()->getAttribute('userB2m');

            if ($iddoc == '') {
                //______________________ajouter document achat
                $documentachat = new Documentachat();

                $numero = $documentachat->NumeroSeqDocumentAchat($idtypedoc);
                $documentachat->setNumero($numero);
                $documentachat->setIdTypedoc($idtypedoc);
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
            if ($montant_estimatif && $montant_estimatif != "")
                $documentachat->setMontantestimatif($montant_estimatif);

            if ($ref)
                $documentachat->setReference($ref);
            $documentachat->setDatecreation(date('Y-m-d'));
            $documentachat->save();

            foreach ($listeslignesdoc as $lignedoc) {
                $norgdre = $lignedoc['norgdre'];
                $qte = $lignedoc['quantite'];
                $codearticle = $lignedoc['codearticle'];
                $designation = $lignedoc['designation'];
                $observation = $lignedoc['observation'];
//                $motif = $lignedoc['motif'];
//                $projet = $lignedoc['projet'];
                $idprojet = $lignedoc['idprojet'];
                $unitedemander = $lignedoc['unitedemander'];
                $idunitemarche = $lignedoc['idunitemarche'];
//                $mid = $lignedoc['mid'];

                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                $lignedoc->setObservation($observation);
                //$lignedoc->setEtatligne("EnCours");
                //$lignedoc->setQtedemander($qte);
//                if ($motif && $motif != "")
//                    $lignedoc->setObservation($motif);

                if ($codearticle)
                    $lignedoc->setCodearticle($codearticle);
                if ($designation)
                    $lignedoc->setDesignationarticle($designation);
                if ($unitedemander && $unitedemander != "")
                    $lignedoc->setUnitedemander($unitedemander);
                if ($idunitemarche && $idunitemarche != "")
                    $lignedoc->setIdUnitemarche($idunitemarche);
                //____________________________________rech article en stock
                if ($codearticle) {
                    $article = Doctrine_Core::getTable('article')->findOneByCodearticleAndDeseignation($codearticle, $designation);
                    if ($article)
                        $lignedoc->setIdArticlestock($article->getId());
                }
                //_____________________________________Fin recherche
                $lignedoc->setIdProjet($idprojet);
//                $lignedoc->setImpbudget($motif);
                //___________________________________rech motif par budget et par projet
//                $motifparprojet = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubriqueAndIdProjet($mid, $idprojet);
//                if ($motifparprojet)
//                    $lignedoc->setCodebudget($motifparprojet->getId());
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

    //________________________________________________________Valider Visa et passer a la processus suivant
    public function executeValidervisa(sfWebRequest $request) {
        if ($request->getParameter('iddoc')) {
            $iddoc = $request->getParameter('iddoc');
            Doctrine_Query::create()
                    ->update('documentachat')
                    ->set('id_etatdoc', '?', 14)
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
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
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
//        $iddoc = $request->getParameter('id');
        //_________suppr. ligne doc
//        Doctrine_Query::create()->delete('lignedocachat')
//                ->where('id_doc=' . $iddoc)->execute();
        $this->forward404Unless($documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id'))), sprintf('Object fiche does not exist (%s).', $request->getParameter('id')));

        //Suppression All Lignedocachat && Qtelignedoc
        foreach ($documentachat->getLignedocachat() as $lignedocachat) {
            foreach ($lignedocachat->getQtelignedoc() as $qtelignedoc) {
                $qtelignedoc->delete();
            }
            $lignedocachat->delete();
        }

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
                $documentachat->setIdEtatdoc(14);
                $documentachat->save();
            }
            $this->redirect('@documentachat');
        }
        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
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

        // die($q);

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
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $delai = $params['delai'];
            $datemax = date('Y-m-d', strtotime($params['datemax']));

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
            $numero = $documentachat->NumeroSeqDocumentAchat(8);
            $documentachat->setNumero($numero);
            $documentachat->setIdFrs($fournisseur->getId());
            $documentachat->setIdTypedoc(8);
            $documentachat->setIdDocparent($achat->getId());
            $documentachat->setReference($achat->getNumero());
            $documentachat->setIdUser($user->getId());
            $documentachat->setIdEtatdoc(10);
            $documentachat->setDatecreation(date('Y-m-d'));
            $documentachat->setDelaifrs($delai);
            $documentachat->setMaxreponsefrs($datemax);
            $documentachat->save();

            foreach ($listeslignesdoc as $lignedoc) {
                $norgdre = $lignedoc['norgdre'];
                $designation = $lignedoc['designation'];
                $qte = $lignedoc['qte'];
                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
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
        $user =  $this->getUser()->getAttribute('userB2m');
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
        //die($q);
    }

    //__________________________________________________________________________Liste bon de deponse Listebondeponse
    public function executeListebondeponse(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $documentfils = Doctrine_Core::getTable('documentachat')->findOneByIdDocparent($iddoc);
            $query = "select CONCAT(fournisseur.rs,' ----Nom&Prenom Responsable:   ',fournisseur.nom,fournisseur.prenom) as rs, documentachat.etatdocachat,  documentachat.id,documentachat.numero"
                    . " from fournisseur,documentachat"
                    . " where documentachat.id_typedoc=2 and  documentachat.id_frs = fournisseur.id and documentachat.id_docparent=" . $iddoc;
            // die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        //die($q);
    }

    //__________________________________________________________________________Liste bon de commande externe
    public function executeListebonexterne(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $documentfils = Doctrine_Core::getTable('documentachat')->findOneByIdDocparent($iddoc);
            $query = "select CONCAT(fournisseur.rs,' ----Nom&Prenom Responsable:   ',fournisseur.nom,fournisseur.prenom) as rs, documentachat.etatdocachat,  documentachat.id,documentachat.numero"
                    . " from fournisseur,documentachat"
                    . " where documentachat.id_typedoc=7 and  documentachat.id_frs = fournisseur.id and documentachat.id_docparent=" . $iddoc;
            // die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        //die($q);
    }

    //__________________________________________________________________________Liste bon de commande interne
    public function executeListeboninterne(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $texte = strtoupper($params['recherche']);
            if ($texte != "")
                $query = "SELECT documentachat.id as ref,"
                        . "concat( documentachat.datecreation,'-', typedoc.prefixetype,LPAD(documentachat.numero::text, 7, '0'),'-',  trim( documentachat.reference),'-', agents.nomcomplet) as name "
                        . "FROM    documentachat,   agents,typedoc "
                        . "WHERE   documentachat.id_demandeur = agents.id and documentachat.id_typedoc=typedoc.id "
                        . "and   (documentachat.numero::text like '%" . $texte . "%' or upper(documentachat.reference) like '%" . $texte . "%' "
                        . "or documentachat.datecreation::text like '%" . $texte . "%' "
                        . "or upper(agents.nomcomplet) like '%" . $texte . "%')";
            else
                $query = "SELECT documentachat.id as ref,"
                        . "concat( documentachat.datecreation,'-', typedoc.prefixetype,LPAD(documentachat.numero::text, 7, '0'),'-',  trim( documentachat.reference),'-', agents.nomcomplet) as name "
                        . "FROM    documentachat,   agents,typedoc "
                        . "WHERE   documentachat.id_demandeur = agents.id and documentachat.id_typedoc=typedoc.id "
                        . " LIMIT 5";
            //die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        //die($q);
    }

    //___________________________________________________________________________Detail ligne doc Detaillignedemandeprix
    public function executeDetaillignedemandeprix(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idlignedoc = $params['idlignedoc'];


            $query = "select documentachat.id as demandedeprixid,lignedocachat.nordre,lignedocachat.designationarticle, "
                    . "activite.description ,  adresse.adrs  ,    fournisseur.rs,qtelignedoc.qteaachat, "
                    . "CONCAT('E-mail:', fournisseur.mail,' Tél:',  fournisseur.tel,' Gsm:',   fournisseur.gsm) as annuaire "
                    . " from fournisseur,   lignedocachat,   documentachat  ,qtelignedoc,"
                    . "(select activitetiers.description,activitetiers.id from activitetiers,fournisseur where fournisseur.id_activite = activitetiers.id) as activite,"
                    . " (select CONCAT( adressefrs.adrs,' ', adressefrs.codepostal) as adrs ,"
                    . " adressefrs.id_frs from adressefrs,fournisseur where adressefrs.id_frs = fournisseur.id ) as adresse  "
                    . "where lignedocachat.id=qtelignedoc.id_lignedocachat and"
                    . "   lignedocachat.id_doc = documentachat.id  "
                    . "AND   documentachat.id_frs = fournisseur.id "
                    . " AND  documentachat.id=" . $idlignedoc
                    . " group by demandedeprixid,lignedocachat.nordre,lignedocachat.designationarticle,"
                    . " activite.description ,  adresse.adrs  ,  "
                    . "  fournisseur.rs,annuaire,qtelignedoc.qteaachat;";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        //die($q);
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
        $demande_de_prix = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($iddoc, 2);
        $this->numerodemande = sprintf('%02d', count($demande_de_prix) + 1);
    }

    //__________________________________________________________________________Expoter BCE
    public function executeExportbce(sfWebRequest $request) {
        if (!$request->getParameter('iddoc'))
            $this->redirect('@documentachat');

        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->liste_bcc = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        $demande_de_prix = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($iddoc, 7);
        $this->numerodemande = sprintf('%02d', count($demande_de_prix) + 1);
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
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];

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
            $numero = $documentachat->NumeroSeqDocumentAchat(2);
            $documentachat->setNumero($numero);
            $documentachat->setIdFrs($fournisseur->getId());
            $documentachat->setIdTypedoc(2);
            $documentachat->setIdDocparent($achat->getId());
            $documentachat->setReference($achat->getNumero());
            $documentachat->setIdUser($user->getId());
            $documentachat->setIdEtatdoc(12);
            $documentachat->setDatecreation(date('Y-m-d'));
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
                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                //$lignedoc->setEtatligne("EnCours");
                $lignedoc->setDesignationarticle($designation);
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
            die("Bon de dépense aux comptant créé avec succès");
        }
        die('Erreur .....!!!!');
    }

    //__________________________________________________________________________Ajouter bon de deponse 
    public function executeSavebonexterne(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $datemax = $params['datemax'];
            $id_note = $params['id_note'];
            $designation = $params['designation'];

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
            $numero = $documentachat->NumeroSeqDocumentAchat(7);
            $documentachat->setNumero($numero);
            $documentachat->setIdFrs($fournisseur->getId());
            $documentachat->setIdTypedoc(7);
            $documentachat->setIdDocparent($achat->getId());
            $documentachat->setReference($achat->getNumero());
            $documentachat->setIdUser($user->getId());
            $documentachat->setIdEtatdoc(13);
            $documentachat->setDatecreation(date('Y-m-d'));
            $documentachat->setMaxreponsefrs($datemax);
            $documentachat->setIdNote($id_note);
            $documentachat->setDesiegniation($designation);
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
                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                // $lignedoc->setEtatligne("EnCours");
                $lignedoc->setDesignationarticle($designation);
                // $lignedoc->setQte($qte);
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
            die("Bon de commande externe créé avec succès");
        }
        die('Erreur .....!!!!');
    }

//___________________________________________________________________________Detail ligne doc DetailligneBondedeponse
    public function executeDetaillignedeponse(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idlignedoc = $params['idlignedoc'];


            $query = "select documentachat.id as demandedeprixid,qtelignedoc.qtelivrefrs as qte,lignedocachat.mntht,"
                    . "lignedocachat.observation,lignedocachat.nordre,lignedocachat.designationarticle, "
                    . "activite.description ,  adresse.adrs  ,    fournisseur.rs, "
                    . "CONCAT('E-mail:', fournisseur.mail,' Tél:',  fournisseur.tel,' Gsm:',   fournisseur.gsm) as annuaire "
                    . " from fournisseur, qtelignedoc,  lignedocachat,   documentachat  ,"
                    . "(select activitetiers.description,activitetiers.id from activitetiers,fournisseur where fournisseur.id_activite = activitetiers.id) as activite,"
                    . " (select CONCAT( adressefrs.adrs,' ', adressefrs.codepostal) as adrs ,"
                    . " adressefrs.id_frs from adressefrs,fournisseur where adressefrs.id_frs = fournisseur.id ) as adresse  "
                    . "where qtelignedoc.id_lignedocachat=lignedocachat.id and"
                    . "   lignedocachat.id_doc = documentachat.id  "
                    . "AND   documentachat.id_frs = fournisseur.id "
                    . " AND  documentachat.id=" . $idlignedoc
                    . " group by demandedeprixid,lignedocachat.nordre,lignedocachat.designationarticle,"
                    . " activite.description ,  adresse.adrs  ,  "
                    . "  fournisseur.rs,annuaire ,qtelignedoc.qtelivrefrs,lignedocachat.mntht,lignedocachat.observation;";
            // die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        //die($q);
    }

    //___________________________________________________________________________Detail ligne doc DetailligneBondedeponse
    public function executeSignature(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            $datesignature = $params['datesignature'];
            $doc_achat = new Documentachat();
            $doc = Doctrine_Core::getTable('documentachat')->findOneById($id);
            $doc_achat = $doc;
            $doc_achat->setDatesignature($datesignature);
            $doc_achat->save();

            die("date signature ajouté avec succès le " . $datesignature);
        }
        //die($q);
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
                die('Erreur au niveau de mise à jour !');
        }
        die('Mise à jour effectuée avec succès !');
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

        $pdf->SetTitle('Fiche BCIMP N°:');
        $pdf->SetSubject("document d'achat");
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

}
