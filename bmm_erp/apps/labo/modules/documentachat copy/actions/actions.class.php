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
class documentachatActions extends autoDocumentachatActions
{

    //__________________________________________________Envoie fiche vers stock et patrimoine
    public function executeValideretenvoyer(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

        if ($request->getParameter('iddoc') && $request->getParameter('btn') && $request->getParameter('btn') == "envoyer") {
            //______________________________Mis a jour document
            $documentachat = new Documentachat();
            $da = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('iddoc'));
            if ($da) {
                $documentachat = $da;

                if ($documentachat->getIdTypedoc() != 9) {
                    $documentachat->setIdEtatdoc(9);
                } else {
                    $documentachat->setIdEtatdoc(6);
                }

                $documentachat->save();
            }
            $this->redirect('@documentachat');
        }
        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->idtype = 10;
        // $this->idfrs ='';
        // $this->iddocparent ='';
        if ($request->getParameter('idtype')) {
            $this->idtype = $request->getParameter('idtype');
        }

        $iddoc = "";
        if ($request->getParameter('iddoc')) {
            $iddoc = $request->getParameter('iddoc');
            $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
            $this->form = $this->configuration->getForm($this->documentachat);
            $this->idtype = $this->documentachat->getIdTypedoc();
        } else {
            $this->form = $this->configuration->getForm();
            $this->documentachat = $this->form->getObject();

            $this->documentachat->setIdTypedoc($this->idtype);
            $this->documentachat->setNumero($this->documentachat->NumeroSeqDocumentAchat($this->idtype));
            $this->documentachat->setDatecreation(date('Y-m-d'));
            if ($request->getParameter('iddocparent')) {
                $documentparent = Doctrine_Core::getTable('documentachat')->findOneById($request->getParameter('iddocparent'));

                $this->idfrs = $documentparent->getIdFrs();
                $this->iddemandeur = $documentparent->getIdDemandeur();
                $this->iddocparent = $documentparent->getId();
                if ($documentparent->getIdFrs()) {
                    $this->documentachat->setIdFrs($documentparent->getIdFrs());
                }

                if ($documentparent->getIdDemandeur()) {
                    $this->documentachat->setIdDemandeur($documentparent->getIdDemandeur());
                }

                $this->documentachat->setIdDocparent($this->iddocparent);
            }
        }
        $this->titre = "";
        if ($this->idtype == 10) {
            $this->titre = "Nouvelle Fiche de Réception (P.V. de Réception)";
        }
        if ($this->idtype == 11) {
            $this->titre = "Nouvelle Fiche de Sortie (Bon de Sortie)";
        }

        if ($this->idtype == 13) {
            $this->titre = "Nouvelle Fiche de Transfert ";
        }

        if ($this->idtype == 12) {
            $this->titre = "Nouvelle Fiche de Retour ";
        }

        if ($this->idtype == 14) {
            $this->titre = "Nouvelle Fiche Avoir Fournisseur ";
        }

    }

    public function executeIndex(sfWebRequest $request)
    {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }
        $idtype = 10;
        if ($request->getParameter('idtype')) {
            $idtype = $request->getParameter('idtype');
        }

        $this->idtypedoc = $idtype;
        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }

        $this->pager = $this->getPager($idtype);
        $this->sort = $this->getSort();
    }

    protected function getPager($idtype)
    {
        $pager = $this->configuration->getPager('documentachat');
        $pager->setQuery($this->buildQuery($idtype));
        $pager->setPage($this->getPage());
        $pager->init();

        return $pager;
    }

    //______________________________________________________________________Remplir les demande de prix
    public function executeRemplirdemandedeprix(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);

        $demande_de_prix = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($iddoc, 8);
        $this->numerodemande = sprintf('%02d', count($demande_de_prix) + 1);
    }

    //______________________________________________________________________Affiche listes des fournisseurs
    public function executeListefournisseur(sfWebRequest $request)
    {
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
            if ($frs != "") {
                $q = $q->where("upper(rs) like '%" . $frs . "%' or upper(nom) like '%" . $frs . "%' or upper(prenom) like '%" . $frs . "%'");
            }

            if ($ref != "") {
                $q = $q->Where("upper(reference) like '%" . $ref . "%'");
            }

        }
        $q = $q->orderBy('id desc')->limit('100');

        $listefournisseur = $q->fetchArray();
        die(json_encode($listefournisseur));
    }

    //______________________________________________________________________Affiche listes des fournisseurs
    public function executeListesbcommnadeexterne(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idfrs = $params['idfrs'];
            $query = "SELECT    concat(trim(typedoc.prefixetype),lpad(documentachat.numero::text,7,'0')) as numero , "
                . "documentachat.mntttc, documentachat.id    FROM    documentachat,    typedoc"
                . " WHERE    documentachat.id_typedoc = typedoc.id   "
                . "and  (documentachat.id_typedoc=7 or documentachat.id_typedoc=2) "
                . "and  documentachat.id_frs=" . $idfrs . ""
                . " order by id desc;";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

            $listesdocs = $conn->fetchAssoc($query);

            die(json_encode($listesdocs));
        }
        die('bien');
    }

    //______________________________________________________________________Affiche listes des fournisseurs
    public function executeListespvdereception(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idfrs = $params['idfrs'];
            $query = "SELECT    concat(trim(typedoc.libelle),' N°:',lpad(documentachat.numero::text,7,'0')) as numero , "
                . "documentachat.mntttc, documentachat.id    FROM    documentachat,    typedoc"
                . " WHERE    documentachat.id_typedoc = typedoc.id   "
                . "and  (documentachat.id_typedoc=10) "
                . "and  documentachat.id_frs=" . $idfrs . ""
                . " order by id desc;";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

            $listesdocs = $conn->fetchAssoc($query);

            die(json_encode($listesdocs));
        }
        die('bien');
    }

    //__________________________________________________________________________Affiche liste des bon commande interne
    public function executeListesbcommnadeinterne(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddemandeur = $params['iddemandeur'];
            $query = "SELECT    concat(trim(typedoc.prefixetype),lpad(documentachat.numero::text,7,'0')) as numero , "
                . "documentachat.mntttc, documentachat.id    "
                . " FROM    documentachat,    typedoc"
                . " WHERE    documentachat.id_typedoc = typedoc.id   "
                . "and  documentachat.id_typedoc=6  "
                . "and  documentachat.id_demandeur=" . $iddemandeur . ""
                . " order by id desc;";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

            $listesdocs = $conn->fetchAssoc($query);

            die(json_encode($listesdocs));
        }
        die('bien');
    }

    //_______________________________________________Listeslignesbce___________________________Lignes documents bon commande externe
    public function executeListeslignesbce(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            if ($iddoc) {
                $query = "SELECT    lignedocachat.designationarticle,   lignedocachat.id_tva, lignedocachat.observation,"
                    . "  lignedocachat.pu,   lignedocachat.mntht,  "
                    . " lignedocachat.mntttc,    lignedocachat.mnttva,  "
                    . "  COALESCE(qtelignedoc.qtelivrefrs,0) as qtelivrefrs,    COALESCE(qtelignedoc.qtedemander,0) as qtedemander,  "
                    . "  lignedocachat.id_articlestock, lignedocachat.codearticle, "
                    . "  lignedocachat.id,    tva.valeurtva, lignedocachat.nordre, "
                    . "  lignedocachat.id_doc "
                    . "FROM    lignedocachat,    qtelignedoc,    tva "
                    . "WHERE    lignedocachat.id_tva = tva.id "
                    . "AND   qtelignedoc.id_lignedocachat = lignedocachat.id "
                    . "and lignedocachat.id_doc=" . $iddoc;

                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $listesdocs = $conn->fetchAssoc($query);

                die(json_encode($listesdocs));
            }
        }
        die('bien');
    }

    //_______________________________________________Listeslignesbce___________________________Lignes Pv ->avoir
    public function executeListeslignespvavoir(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            if ($iddoc) {
                $query = "SELECT    lignedocachat.designationarticle, magasin.id as id_mag,   "
                    . " lignedocachat.mntttc,    COALESCE(lignedocachat.qte,0) as qte,  "
                    . "  lignedocachat.id_articlestock, lignedocachat.codearticle, "
                    . "  lignedocachat.id,  magasin.libelle,   lignedocachat.nordre, "
                    . "  lignedocachat.id_doc "
                    . "FROM    lignedocachat,  magasin "
                    . "WHERE   magasin.id=lignedocachat.id_mag "
                    . " and  lignedocachat.id_doc=" . $iddoc;
                // die($query);
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $listesdocs = $conn->fetchAssoc($query);

                die(json_encode($listesdocs));
            }
        }
        die('bien');
    }

    //_______________________________________________Listeslignesbce___________________________Lignes documents bon commande externe
    public function executeListeslignesbcinterne(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            $idmag = $params['idmag'];
            if ($iddoc) {
                $query = "SELECT    article.pamp,   article.codeart,   article.designation,   "
                    . "article.id as idarticle,   lignedocachat.id as idligne, "
                    . "  lignedocachat.id_doc,   magasin.id as idmag,   magasin.libelle, "
                    . "  lignedocachat.qte,    qtelignedoc.qtedemander "
                    . " FROM   lignedocachat,   article,   stock,   magasin,    qtelignedoc "
                    . "WHERE    lignedocachat.designationarticle = article.designation AND   "
                    . " stock.id_article = article.id AND   stock.id_mag = magasin.id AND   "
                    . "qtelignedoc.id_lignedocachat = lignedocachat.id and lignedocachat.id_doc=" . $iddoc . " and magasin.id=" . $idmag . " ;";
                //die($query);
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $listesdocs = $conn->fetchAssoc($query);

                die(json_encode($listesdocs));
            }
        }
        die('bien');
    }

    public function executeListeslignesdocumentpv(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc = $params['iddoc'];
            if ($iddoc) {
                $query = "SELECT    lignedocachat.designationarticle, magasin.id as idmag,magasin.libelle as nommag,  lignedocachat.id_tva, "
                    . "  lignedocachat.pu as mntht,  "
                    . " lignedocachat.mntttc,    lignedocachat.mnttva,  "
                    . "  COALESCE(lignedocachat.qte,0) as qte,  "
                    . "  lignedocachat.id_articlestock, lignedocachat.codearticle, "
                    . "  lignedocachat.id,    tva.valeurtva, lignedocachat.nordre, "
                    . "  lignedocachat.id_doc "
                    . "FROM    lignedocachat,   magasin,     tva "
                    . "WHERE  lignedocachat.id_mag=magasin.id and"
                    . "  lignedocachat.id_tva = tva.id "
                    . "and lignedocachat.id_doc=" . $iddoc;
                //die($query);
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $listesdocs = $conn->fetchAssoc($query);

                die(json_encode($listesdocs));
            }
        }
        die('bien');
    }

    //______________________________________________________________________Affiche listes des fournisseurs
    public function executeAffichefournisseur(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idfrs = $params['idfrs'];

            $q = Doctrine_Query::create()
                ->select("    CONCAT(fournisseur.nom, ' ',  fournisseur.prenom) as nomcomplet,  fournisseur.rs,   fournisseur.mail,   fournisseur.tel,   fournisseur.gsm,   fournisseur.fodec,   fournisseur.assujtva,   fournisseur.adr,   fournisseur.codefrs,   fournisseur.id ")
                ->from('fournisseur ')->where('id=' . $idfrs);

            // die($q);
            $frs = $q->fetchArray();
            die(json_encode($frs));
        }
        die('bien');
    }

    //______________________________________________________________________Réquette affichier listes documents desc
    protected function buildQuery($idtype)
    {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);
        $filter = $this->getFilters();

        // die($idtype.'hh');

        $query = $this->filters->buildQuery($this->getFilters());
        $documentsachat = Doctrine_Core::getTable('documentachat')
            ->createQuery('a');
        if (isset($filter['id_typedoc']) && !$idtype) {
            $documentsachat = $documentsachat->where('id_typedoc=' . $filter['id_typedoc']);
        } else if ($idtype) {
            $filter['id_typedoc'] = $idtype;
            $documentsachat = $documentsachat->where('id_typedoc=' . $idtype);
        }
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

        if (isset($filter['id_frs'])) {
            $documentsachat = $documentsachat->Andwhere('id_frs=' . $filter['id_frs']);
        }
        if (isset($filter['id_demandeur'])) {
            $documentsachat = $documentsachat->Andwhere('id_demandeur=' . $filter['id_demandeur']);
        }

        $query = $documentsachat->OrderBy('id desc');
        $this->addSortQuery($query);

        // die($query);

        return $query;
    }

    public function executeArticlebycodeanddesignation(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $codearticle = $params['codearticle'];
            $designation = strtoupper($params['designation']);
            $q = Doctrine_Query::create()
                ->select(" article.id,article.codeart as ref, article.designation as name")
                ->from('article');
            if ($codearticle != "" && $designation == "") {
                $q = $q->where("codeart like '%" . $codearticle . "%'");
            }

            if ($codearticle == "" && $designation != "") {
                $q = $q->Where("upper(designation) like '%" . $designation . "%'");
            }

            if ($codearticle != "" && $designation != "") {
                $q = $q->Where("upper(designation) like '%" . $designation . "%'")
                    ->AndWhere("codeart like '%" . $codearticle . "%'");
            }

            $listesarticles = $q->fetchArray();
            die(json_encode($listesarticles));
        }
        die('bien');
    }

    //_________________________________________________Listes des Projets du société
    public function executeProjetparmotif(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');

        $q = Doctrine_Query::create()
            ->select("id,libelle as name")
            ->from('projet');
        //die($q);
        $listesprojets = $q->fetchArray();
        die(json_encode($listesprojets));
    }

    //_________________________________________________Listes des motif par projet
    public function executeListesmotifparprojet(sfWebRequest $request)
    {
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
            if ($motiftext != "") {
                $q = $q->andwhere("upper(rubrique.libelle) like '%" . $motiftext . "%'");
            }

            $listemotif = $q->fetchArray();
            die(json_encode($listemotif));
        }

        // die($q);

        die('bien');
    }

    //_________________________________________________Ajouter nouveau fiche par type: BE
    public function executeSavedocument(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $numero = $params['numero'];
            $date = date('d-m-Y', strtotime($params['date']));
            $idtypedoc = 10;
            $user = new Utilisateur();
            $user = $this->getUser()->getAttribute('userB2m');
            $paramaction = $params['paramaction'];
            $iddcoparent = $params['iddocparent'];
            $idmagazin = $params['idmag'];
            //______________________ajouter Bon entrer
            $documentachat = new Documentachat();

            $doc = Doctrine_Core::getTable('documentachat')->findOneByNumeroAndIdTypedocAndIdDocparent(intval($numero), $idtypedoc, $iddcoparent);
            //die($doc);
            if ($doc) {
                $documentachat = $doc;
            }

            $documentachat->setNumero($numero);
            $documentachat->setIdTypedoc($idtypedoc);
            if ($paramaction == 0) {
                $documentachat->setIdEtatdoc(17);
            }

            if ($paramaction == 1) {
                $documentachat->setIdEtatdoc(18);
            }

            $documentachat->setDatecreation($date);
            $documentachat->setIdUser($user->getId());
            //______________________________________Bon entrer et listes des prix
            $enteteprix = $params['docentete'];

            $documentachat->setMnthtax($enteteprix['thtxa']);
            $documentachat->setMntremise($enteteprix['totalremise']);
            $documentachat->setMntfodec($enteteprix['fodec']);
            $documentachat->setMht($enteteprix['tht']);
            $documentachat->setMnttva($enteteprix['ttva']);
            $documentachat->setMntttc($enteteprix['ttcnet']);
            $documentachat->setIdDocparent($iddcoparent);
            //______________________________________Fournisseur
            $entetefrs = $params['frs'];
            $documentachat->setIdFrs($entetefrs['id']);
            $documentachat->save();
            //_______________________________________Base tva

            $tvabasess = $params['basetva'];
            Doctrine_Query::create()
                ->delete('tvabase')->where('id_doc=' . $documentachat->getId())->execute();

            foreach ($tvabasess as $tva) {
                $tvabase = new Tvabase();
                $tvabase->setIdDoc($documentachat->getId());
                $tvabase->setLibelle($tva['titre']);
                $tvabase->setValeurbase($tva['valeur']);
                $tvabase->save();
            }
            // die($documentachat);
            $lignesdocs = $params['lignedoc'];
            foreach ($lignesdocs as $lignedoc) {
                $norgdre = $lignedoc['norgdre'];
                $idarticle = $lignedoc['idarticle'];
                $qte = $lignedoc['qte'];
                $codearticle = $lignedoc['codearticle'];
                $designation = $lignedoc['designation'];
                $puorigine = floatval($lignedoc['puorigine'], 3);
                $puht = floatval($lignedoc['puht'], 3);
                $mnttva = $lignedoc['mnttva'];
                $mntttc = $lignedoc['mntttc'];
                $totalht = $lignedoc['totalht'];
                $totalhtva = $lignedoc['totalhtva'];
                $fodec = $lignedoc['fodec'];
                $remise = $lignedoc['remise'];
                $tauxremise = $lignedoc['tauxremise'];
                /* REcherche tva par fournisseur */
                $fournusseur = new Fournisseur();
                $frs = Doctrine_Core::getTable('fournisseur')->findOneById($entetefrs['id']);
                if ($frs) {
                    $fournusseur = $frs;
                }

                if ($fournusseur && $fournusseur->getAssujtva() && $fournusseur->getAssujtva() == 1) {
                    $tva = $lignedoc['tva'];

                    $idtva = $lignedoc['idtva'];
                } else {
                    $tva = 0;
                    $idtva = 3;
                }
                /**/

                $idligne = $lignedoc['idligne'];
                $iddoc = $lignedoc['iddoc'];
                $idmag = $lignedoc['idmag'];
                $magasin = $lignedoc['magasin'];
                $lignedoc = new Lignedocachat();
                // die($idarticle.','. $documentachat->getId().','. $idmag);
                if ($idarticle) {
                    $lgdoc_recherche = LignedocachatTable::getInstance()->findOneByIdArticlestockAndIdDocAndIdMag($idarticle, $documentachat->getId(), $idmag);
                }

                //die($lgdoc_recherche);
                if ($lgdoc_recherche) {
                    $lignedoc = $lgdoc_recherche;
                }

                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                if ($codearticle) {
                    $lignedoc->setCodearticle($codearticle);
                }

                if ($designation) {
                    $lignedoc->setDesignationarticle($designation);
                }

                //____________________________________rech article en stock

                if ($idarticle) {
                    $article = Doctrine_Core::getTable('article')->findOneById($idarticle);
                }
//                if ($codearticle != "") {
                //                    $article = Doctrine_Core::getTable('article')->findOneByCodeart($codearticle);
                //                }
                // die($paramaction."/".$iddoc);
                if ($article) {
                    $lignedoc->setIdArticlestock($article->getId());
                    if ($iddoc && $iddoc != "") {
                        if ($paramaction != 0) {
                            $rechercheligne = Doctrine_Core::getTable('lignedocachat')->findOneById($idligne);

                            if ($rechercheligne) {
                                $docligneid = $idligne;
                                if ($rechercheligne->getIdLigneparent()) {
                                    $docligneid = $rechercheligne->getIdLigneparent();
                                }
                                $qtteretirer = new Qtelignedoc();
                                $qtes = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($docligneid);
                                if ($qtes) {
                                    $qtteretirer = $qtes;
                                    $qtemisajour = $qte + $qtteretirer->getQtedemander();
                                    $qtteretirer->setQtedemander($qtemisajour);
                                    $qtteretirer->save();
                                }
                            }
                        } else {
                            $lignedoc->setIdLigneparent($idligne);
                        }
                    }
                    //______________________________________________________________Tarification
                    $lignedoc->setPu(floatval($puht));
                    $lignedoc->setMntht(floatval($totalht));
                    $lignedoc->setMnttva(floatval($mnttva));
                    $mntttcnet = $totalht + $mnttva;
                    $lignedoc->setMntttc(floatval($mntttcnet));
                    if ($idtva && $idtva != "") {
                        $lignedoc->setIdTva($idtva);
                    } else {
                        $lignedoc->setIdTva(3);
                    }

                    $lignedoc->setQte($qte);
                    //______________________________________________________________Recherche pamp
                    if ($idmag) {
                        $lignedoc->setIdMag($idmag);
                    } else {
                        $lignedoc->setIdMag($idmagazin);
                    }

                    $lignedoc->save();
                    //______________________________________________________________PAMP
                    if ($paramaction != 0) {
                        $article->getPampNew($qte, $puht, $mntttc, $lignedoc);
                    }

                } else {
                    die('Erreur');
                }
            }

            die('iddoc/' . $documentachat->getId());
        }
    }

    //_________________________________________________Ajouter nouveau fiche par type: BE
    public function executeSavedocumentsortie(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $numero = $params['numero'];
            $date = date('d-m-Y', strtotime($params['date']));
            $idtypedoc = 11;
            $iddoc = $params['iddoc'];
            $user = new Utilisateur();
            $user = $this->getUser()->getAttribute('userB2m');
            //______________________ajouter Bon entrer
            $documentachat = new Documentachat();

            $doc = Doctrine_Core::getTable('documentachat')->findOneByNumeroAndIdTypedoc(intval($numero), $idtypedoc);
            if ($doc) {
                $documentachat = $doc;
            }

            $documentachat->setNumero($numero);
            $documentachat->setIdTypedoc($idtypedoc);
            $documentachat->setIdDocparent($iddoc);
            $documentachat->setIdEtatdoc(1);
            $documentachat->setDatecreation($date);
            $documentachat->setIdUser($user->getId());
            //______________________________________Bon entrer et listes des prix
            $enteteprix = $params['docentete'];
            $documentachat->setMntttc($enteteprix['ttcnet']);

            //______________________________________Fournisseur
            $iddemandeur = $params['iddemandeur'];
            $documentachat->setIdDemandeur($iddemandeur);
            $documentachat->save();

            $lignesdocs = $params['lignedoc'];
            foreach ($lignesdocs as $lignedoc) {

                $norgdre = $lignedoc['norgdre'];
                $idarticle = $lignedoc['idarticle'];

                $qte = $lignedoc['qte'];
                $codearticle = $lignedoc['codearticle'];
                $designation = $lignedoc['designation'];
                $puorigine = $lignedoc['puorigine'];
                $puht = $lignedoc['puht'];
                $idmag = $lignedoc['idmag'];
                $mntttc = $lignedoc['mntttc'];

                $idligne = $lignedoc['idligne'];
                $iddoc = $documentachat->getId();

                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                if ($norgdre) {
                    $lignedoc->setNordre($norgdre);
                }

                if ($idmag) {
                    $lignedoc->setIdMag($idmag);
                }

                if ($idligne) {
                    $lignedoc->setIdLigneparent($idligne);
                }

                if ($codearticle) {
                    $lignedoc->setCodearticle($codearticle);
                }

                if ($designation) {
                    $lignedoc->setDesignationarticle($designation);
                }

                //____________________________________rech article en stock
                $art = new Article();
                if ($idarticle) {
                    $article = Doctrine_Core::getTable('article')->findOneById($idarticle);
                }
                if ($codearticle != "" && !$idarticle) {
                    $article = Doctrine_Core::getTable('article')->findOneByCodeart($codearticle);
                }

                if ($article) {
                    $lignedoc->setIdArticlestock($article->getId());
                    $art = $article;
                    //______________________________________________________________Tarification

                    $lignedoc->setMntttc(floatval($mntttc));
                    $lignedoc->setPamp(floatval($mntttc));
                    $lignedoc->setQte($qte);
                    //______________________________________________________________Recherche pamp

                    $lignedoc->save();
                    //______________________________________________________________Qte
                    $art->UpdateStock($qte, $idmag);
                } else {
                    die('Erreur');
                }
            }

            die('iddoc/' . $documentachat->getId());
        }
    }

    //_________________________________________________Ajouter nouveau fiche de trasfert stock
    public function executeSavedocumenttransfert(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $numero = $params['numero'];
            $date = date('d-m-Y', strtotime($params['date']));
            $idtypedoc = 13;
            $idmagdepart = $params['idmagdepart'];
            $idmagarrive = $params['idmagarrive'];
            $ref = $params['ref'];
            $user = new Utilisateur();
            $user = $this->getUser()->getAttribute('userB2m');
            //______________________ajouter Bon entrer
            $documentachat = new Documentachat();

            $doc = Doctrine_Core::getTable('documentachat')->findOneByNumeroAndIdTypedoc(intval($numero), $idtypedoc);
            if ($doc) {
                $documentachat = $doc;
            }

            $documentachat->setNumero($numero);
            $documentachat->setIdTypedoc($idtypedoc);

            $documentachat->setIdEtatdoc(1);
            $documentachat->setDatecreation($date);
            $documentachat->setIdUser($user->getId());
            $documentachat->setIdmagdepart($idmagdepart);
            $documentachat->setIdmagarrive($idmagarrive);

            $documentachat->save();

            $lignesdocs = $params['lignedoc'];
            foreach ($lignesdocs as $lignedoc) {

                $norgdre = $lignedoc['norgdre'];

                $qte = $lignedoc['qte'];
                $codearticle = $lignedoc['codearticle'];
                $designation = $lignedoc['designation'];
                $idarticlemag = $lignedoc['idarticle'];
                $idmag = $lignedoc['idmag'];
                $stock = new Stock();
                $sts = Doctrine_Core::getTable('stock')->findOneById($idarticlemag);
                $stock = $sts;

                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                $lignedoc->setIdMag($idmag);
                $lignedoc->setIdArticlestock($stock->getIdArticle());
                if ($codearticle) {
                    $lignedoc->setCodearticle($codearticle);
                }

                if ($designation) {
                    $lignedoc->setDesignationarticle($designation);
                }

                //____________________________________rech article en stock
                $art = new Article();
                if ($stock->getIdArticle()) {
                    $article = Doctrine_Core::getTable('article')->findOneById($stock->getIdArticle());
                }
                if ($codearticle != "" && !$stock->getIdArticle()) {
                    $article = Doctrine_Core::getTable('article')->findOneByCodeart($codearticle);
                }

                if ($article) {
                    $lignedoc->setIdArticlestock($stock->getIdArticle());
                    $art = $article;

                    $lignedoc->setQte($qte);
                    //______________________________________________________________Recherche pamp

                    $lignedoc->save();
                    //______________________________________________________________Qte
                    $art->UpdateStockTransfert($qte, $stock, $idmagarrive);
                } else {
                    die('Erreur');
                }
            }

            die('iddoc/' . $documentachat->getId());
        }
    }

    //_________________________________________________Ajouter nouveau fiche de trasfert stock
    public function executeSavedocumentretour(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $numero = $params['numero'];
            $date = date('d-m-Y', strtotime($params['date']));
            $idtypedoc = 12;
            $iddocparent = "";
            $iddemandeur = $params['iddemandeur'];
            $ref = $params['ref'];
            $user = new Utilisateur();
            $user = $this->getUser()->getAttribute('userB2m');
            //______________________ajouter Bon entrer
            $documentachat = new Documentachat();

            $doc = Doctrine_Core::getTable('documentachat')->findOneByNumeroAndIdTypedoc(intval($numero), $idtypedoc);
            if ($doc) {
                $documentachat = $doc;
            }

            $documentachat->setNumero($numero);
            $documentachat->setIdTypedoc($idtypedoc);
            if ($ref != "") {
                $documentachat->setReference($ref);
            }

            $documentachat->setIdDemandeur($iddemandeur);
            $documentachat->setIdEtatdoc(1);
            $documentachat->setDatecreation($date);
            $documentachat->setIdUser($user->getId());
            $enteteprix = $params['docentete'];

            $documentachat->setMntttc($enteteprix['ttcnet']);
            $documentachat->save();

            $lignesdocs = $params['lignedoc'];
            foreach ($lignesdocs as $lignedoc) {

                $norgdre = $lignedoc['norgdre'];

                $qte = $lignedoc['qte'];
                $codearticle = $lignedoc['codearticle'];
                $designation = $lignedoc['designation'];
                $idarticle = $lignedoc['idarticle'];
                $idmag = $lignedoc['idmag'];
                $idligne = $lignedoc['idligne'];
                $iddoc = $lignedoc['iddoc'];
                $pamp = $lignedoc['pamp'];
                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                $lignedoc->setIdMag($idmag);
                $lignedoc->setIdArticlestock($idarticle);
                $iddocparent = $iddoc;
                if ($codearticle) {
                    $lignedoc->setCodearticle($codearticle);
                }

                if ($designation) {
                    $lignedoc->setDesignationarticle($designation);
                }

                $lignedoc->setPamp($pamp);
                $lignedoc->setMntttc($pamp);
                //____________________________________rech article en stock
                $art = new Article();
                if ($idarticle) {
                    $article = Doctrine_Core::getTable('article')->findOneById($idarticle);
                }
                if ($codearticle != "" && !$idarticle) {
                    $article = Doctrine_Core::getTable('article')->findOneByCodeart($codearticle);
                }
                if ($article) {
                    $lignedoc->setIdArticlestock($idarticle);
                    $art = $article;
                    $lignedoc->setQte($qte);
                    //______________________________________________________________Recherche pamp
                    $lignedoc->save();
                    //______________________________________________________________Qte
                    $art->UpdateRetour($qte, $idmag, $pamp);
                } else {
                    die('Erreur');
                }
            }
            if ($iddocparent != "") {
                $documentachat->setIdDocparent($iddocparent);
                $documentachat->save();
            }
            die('iddoc/' . $documentachat->getId());
        }
    }

    //_________________________________________________Ajouter nouveau fiche de trasfert stock
    public function executeSavedocumentavoir(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $numero = $params['numero'];
            $date = date('d-m-Y', strtotime($params['date']));
            $idtypedoc = 14;
            $iddocparent = "";
            $idfrs = $params['idfrs'];
            $ref = $params['ref'];
            $user = new Utilisateur();
            $user = $this->getUser()->getAttribute('userB2m');
            //______________________ajouter Bon entrer
            $documentachat = new Documentachat();

            $doc = Doctrine_Core::getTable('documentachat')->findOneByNumeroAndIdTypedoc(intval($numero), $idtypedoc);
            if ($doc) {
                $documentachat = $doc;
            }

            $documentachat->setNumero($numero);
            $documentachat->setIdTypedoc($idtypedoc);
            if ($ref != "") {
                $documentachat->setReference($ref);
            }

            $documentachat->setIdFrs($idfrs);
            $documentachat->setIdEtatdoc(1);
            $documentachat->setDatecreation($date);
            $documentachat->setIdUser($user->getId());
            $enteteprix = $params['docentete'];

            $documentachat->setMntttc($enteteprix['ttcnet']);
            $documentachat->save();

            $lignesdocs = $params['lignedoc'];
            foreach ($lignesdocs as $lignedoc) {

                $norgdre = $lignedoc['norgdre'];

                $qte = $lignedoc['qte'];
                $codearticle = $lignedoc['codearticle'];
                $designation = $lignedoc['designation'];
                $idarticle = $lignedoc['idarticle'];
                $idmag = $lignedoc['idmag'];
                $idligne = $lignedoc['idligne'];
                $iddoc = $lignedoc['iddoc'];
                $mntttc = $lignedoc['mntttc'];
                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                $lignedoc->setIdMag($idmag);
                $lignedoc->setIdArticlestock($idarticle);
                $iddocparent = $iddoc;
                if ($codearticle) {
                    $lignedoc->setCodearticle($codearticle);
                }

                if ($designation) {
                    $lignedoc->setDesignationarticle($designation);
                }

                $lignedoc->setMntttc($mntttc);
                //____________________________________rech article en stock
                $art = new Article();
                if ($idarticle) {
                    $article = Doctrine_Core::getTable('article')->findOneById($idarticle);
                }
                if ($codearticle != "" && !$idarticle) {
                    $article = Doctrine_Core::getTable('article')->findOneByCodeart($codearticle);
                }
                if ($article) {
                    $lignedoc->setIdArticlestock($idarticle);
                    $art = $article;
                    $lignedoc->setQte($qte);
                    //______________________________________________________________Recherche pamp
                    $lignedoc->save();
                    //______________________________________________________________Qte
                    $art->UpdatePampAvoir($qte, $idmag, $mntttc);
                } else {
                    die('Erreur');
                }
            }
            if ($iddocparent != "") {
                $documentachat->setIdDocparent($iddocparent);
                $documentachat->save();
            }
            die('iddoc/' . $documentachat->getId());
        }
    }

    //________________________________________________________Valider Visa et passer a la processus suivant
    public function executeValidervisa(sfWebRequest $request)
    {
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
    public function executeShowdocument(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        $this->basetvas = Doctrine_Core::getTable('tvabase')->findByIdDoc($iddoc);
    }

    //__________________________________________________Envoie fiche vers stock et patrimoine
    public function executeEnvoistock(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

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
    public function executeEnvoibudget(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

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
    public function executeDelete(sfWebRequest $request)
    {
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
    public function executeRempliretexporter(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

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

    public function executeAjoutervisa(sfWebRequest $request)
    {
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
                if ($ligne) {
                    $lignevisadoc = $ligne;
                }

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
    public function executeChoisarticle(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $designation = $params['designation'];

            $query = "SELECT coalesce(trim(codeart),' ') as ref, "
                . "trim(designation) as name, coalesce(pamp,0) as prix , id_tva as tva  "
                . "FROM    public.article   "
                . "";
            if ($designation != "") {
                $query .= "where designation like '%" . $designation . "%' or codeart like '%" . $designation . "%'   ";
            }

            $query .= " limit 100";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die('Erreur ....!!!');
    }

    //________________________________________________________________________Chois des article a partir document achat
    public function executeChoisarticlebymagasin(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $designation = $params['designation'];
            $idmag1 = $params['idmag1'];
            $query = "SELECT stock.id as tva ,   coalesce(trim(codeart),' ') as ref, "
                . " trim(designation) as name,   stock.qtereel as prix "
                . "FROM    article,    stock"
                . " WHERE    stock.id_article = article.id AND   stock.id_mag = " . $idmag1;
            if ($designation != "") {
                $query .= " AND    (article.designation LIKE '%" . $designation . "%' OR    article.codeart LIKE '%" . $designation . "%') ";
            }

            $query .= " limit 100";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die('Erreur ....!!!');
    }

    //________________________________________________________________________Chois des article a partir document achat
    public function executeChoisarticlebydemandeur(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $designation = $params['designation'];
            $iddem = $params['iddem'];
            $query = "SELECT    article.codeart as ref,    article.designation as name ,   "
                . " concat(lignedocachat.id_articlestock,'/', lignedocachat.id,'/',documentachat.id,'/',lignedocachat.qte,'/',lpad(documentachat.numero::text,7,'0')) as tva,   "
                . "  lignedocachat.pamp as prix FROM    lignedocachat,   documentachat,    article "
                . "WHERE    lignedocachat.id_doc = documentachat.id AND   lignedocachat.id_articlestock = article.id "
                . "AND   documentachat.id_demandeur = " . $iddem . " AND    documentachat.id_typedoc = 11 ";
            if ($designation != "") {
                $query .= " AND    (article.designation LIKE '%" . $designation . "%' OR    article.codeart LIKE '%" . $designation . "%') ";
            }

            $query .= " limit 100";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listearticles = $conn->fetchAssoc($query);
            die(json_encode($listearticles));
        }
        die('Erreur ....!!!');
    }

    //_____________________________________________________Liste document demande de prix
    public function executeListedemandeprix(sfWebRequest $request)
    {
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
        //die($q);
    }

    //__________________________________________________________________________Liste bon de deponse Listebondeponse
    public function executeListebondeponse(sfWebRequest $request)
    {
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
                . " where documentachat.id_typedoc=2 and  documentachat.id_frs = fournisseur.id and documentachat.id_docparent=" . $iddoc;
            // die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        //die($q);
    }

    //__________________________________________________________________________Liste bon de commande externe
    public function executeListebonexterne(sfWebRequest $request)
    {
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
                . " where documentachat.id_typedoc=7 and  documentachat.id_frs = fournisseur.id and documentachat.id_docparent=" . $iddoc;
            // die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        //die($q);
    }

    //__________________________________________________________________________Liste bon de commande interne
    public function executeListeboninterne(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $texte = strtoupper($params['recherche']);
            if ($texte != "") {
                $query = "SELECT documentachat.id as ref,"
                    . "concat( documentachat.datecreation,'-', typedoc.prefixetype,LPAD(documentachat.numero::text, 7, '0'),'-',  trim( documentachat.reference),'-', agents.nomcomplet) as name "
                    . "FROM    documentachat,   agents,typedoc "
                    . "WHERE   documentachat.id_demandeur = agents.id and documentachat.id_typedoc=typedoc.id and typedoc.id=6 "
                    . "and   (documentachat.numero::text like '%" . $texte . "%' or upper(documentachat.reference) like '%" . $texte . "%' "
                    . "or documentachat.datecreation::text like '%" . $texte . "%' "
                    . "or upper(agents.nomcomplet) like '%" . $texte . "%')";
            } else {
                $query = "SELECT documentachat.id as ref,"
                    . "concat( documentachat.datecreation,'-', typedoc.prefixetype,LPAD(documentachat.numero::text, 7, '0'),'-',  trim( documentachat.reference),'-', agents.nomcomplet) as name "
                    . "FROM    documentachat,   agents,typedoc "
                    . "WHERE   "
                    . "documentachat.id_demandeur = agents.id and documentachat.id_typedoc=typedoc.id  "
                    . "and typedoc.id=6  LIMIT 5";
            }

            //die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        //die($q);
    }

    //___________________________________________________________________________Detail ligne doc Detaillignedemandeprix
    public function executeDetaillignedemandeprix(sfWebRequest $request)
    {
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
                . " fournisseur.rs,annuaire,qtelignedoc.qteaachat, fournisseur.adr;";

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        //die($q);
    }

    //___________________________________________________________________________Passer le BCI(les demande de prix ) en BCE ou BCC
    public function executeEtapefinal(sfWebRequest $request)
    {
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
    public function executeExportbcc(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->liste_bcc = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        $demande_de_prix = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($iddoc, 2);
        $this->numerodemande = sprintf('%02d', count($demande_de_prix) + 1);
    }

    //__________________________________________________________________________Expoter BCE
    public function executeExportbce(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->liste_bcc = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        $demande_de_prix = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($iddoc, 7);
        $this->numerodemande = sprintf('%02d', count($demande_de_prix) + 1);
    }

    //__________________________________________________________________________Listes des TVA
    public function executeListetva(sfWebRequest $request)
    {

        $listes_tva = Doctrine_Query::create()
            ->select("*")
            ->from('tva');

        $listes_tva = $listes_tva->fetchArray();
        die(json_encode($listes_tva));
    }

    //__________________________________________________________________________Ajouter bon de deponse
    public function executeSavebondedeponse(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
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
            if (count($fournisseurs) > 0) {
                $fournisseur = $fournisseurs[0];
            } else {
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
            die("Bon de déponses aux comptant créé avec succès");
        }
        die('Erreur .....!!!!');
    }

    //__________________________________________________________________________Ajouter bon de deponse
    public function executeSavebonexterne(sfWebRequest $request)
    {
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

            $listeslignesdoc = $params['listearticle'];
            $frs = $params['frs'];
            $fournisseurs = Doctrine_Query::create()
                ->select("*")
                ->from('fournisseur')
                ->where("rs like '%" . $frs . "%'")->execute();
            $fournisseur = new Fournisseur();
            if (count($fournisseurs) > 0) {
                $fournisseur = $fournisseurs[0];
            } else {
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
    public function executeDetaillignedeponse(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idlignedoc = $params['idlignedoc'];

            $query = "select documentachat.id as demandedeprixid,qtelignedoc.qtelivrefrs as qte,lignedocachat.mntht,"
                . "lignedocachat.observation,lignedocachat.nordre,lignedocachat.designationarticle, "
                . "   fournisseur.rs,fournisseur.adr  as adrs, "
                . "CONCAT('E-mail:', fournisseur.mail,' Tél:',  fournisseur.tel,' Gsm:',   fournisseur.gsm) as annuaire "
                . " from fournisseur, qtelignedoc,  lignedocachat,   documentachat  "
                . "where qtelignedoc.id_lignedocachat=lignedocachat.id and"
                . "   lignedocachat.id_doc = documentachat.id  "
                . "AND   documentachat.id_frs = fournisseur.id "
                . " AND  documentachat.id=" . $idlignedoc
                . " group by demandedeprixid,lignedocachat.nordre,lignedocachat.designationarticle,"
                . " adrs ,  "
                . "  fournisseur.rs,annuaire ,qtelignedoc.qtelivrefrs,lignedocachat.mntht,lignedocachat.observation;";
            // die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        //die($q);
    }

    //___________________________________________________________________________Detail ligne doc DetailligneBondedeponse
    public function executeSignature(sfWebRequest $request)
    {
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

            die("date signature ajouté avec succès le " . $datesignature);
        }
        //die($q);
    }

    //____________________________________________________Valider ligne
    public function executeValiderligne(sfWebRequest $request)
    {
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
            } else {
                die('Erreur au niveau de mise à jour !');
            }

        }
        die('Mise à jour effectuée avec succès !');
    }

    public function executeImprimerdocachat(sfWebRequest $request)
    {
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

        $pdf->SetTitle('Fiche D.I. N°:');
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
        $logo=PDF_HEADER_LOGO.'/'.$societe->getLogo();
        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, $entete,$rs, '', '');

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

    public function ReadHtml($societe, $aviss, $documentachat, $listesdocuments)
    {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBonCommandeInterne($aviss, $listesdocuments);

        return $html;
    }
  
}
