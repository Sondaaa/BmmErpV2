<?php

require_once dirname(__FILE__) . '/../lib/AchatdocGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/AchatdocGeneratorHelper.class.php';

/**
 * Achatdoc actions.
 *
 * @package    symfony
 * @subpackage Achatdoc
 * @author     Your name here
 * @version    SVN: $Id$
 */
class AchatdocActions extends autoAchatdocActions
{
    public function executeShowSuivicommande(sfWebRequest $request)
    {
        $this->offset = 0;
        $this->start_date = date('Y-m-d', strtotime(date('Y/m/01')));
        $this->id_bci = null;
        $this->id_bce = null;
        $this->id_bcedef = null;
        $this->id_bcilabo = null;
        $this->id_fac = null;
        if ($request->getParameter('start')) {
            $this->start_date = date('Y-m-d', strtotime($request->getParameter('start')));
        }
        $d = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
        $this->end_date = date('Y-m-d', strtotime(date("Y") . '-' . date("m") . '-' . $d));
        if ($request->getParameter('end')) {
            $this->end_date = date('Y-m-d', strtotime($request->getParameter('end')));
        }
        if ($request->getParameter('id_bci')) {
            $this->id_bci = $request->getParameter('id_bci');
        }
        if ($request->getParameter('id_bce')) {
            $this->id_bce = $request->getParameter('id_bce');
        }
        if ($request->getParameter('id_bce')) {
            $this->id_bce = $request->getParameter('id_bce');
        }
        if ($request->getParameter('id_bcilabo')) {
            $this->id_bcilabo = $request->getParameter('id_bcilabo');
        }
        if ($request->getParameter('id_fac')) {
            $this->id_fac = $request->getParameter('id_fac');
        }

        if ($request->getParameter('id_bcedef')) {
            $this->id_bcedef = $request->getParameter('id_bcedef');
        }
        $this->documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDate(6, 5, $this->offset, $this->start_date, $this->end_date, $this->id_bci, $this->id_bce, $this->id_bcedef, $this->id_fac, $this->id_bcilabo);

        $this->AllBCI = DocumentachatTable::getInstance()->getAllBciByDate(6, $this->start_date, $this->end_date, $this->id_bci, $this->id_bce);
        $this->AllBCE = DocumentachatTable::getInstance()->getAllBciByDateBCE($this->start_date, $this->end_date, $this->id_bci, $this->id_bce);
        $this->AllBCEDef = DocumentachatTable::getInstance()->getAllBciByDateBCEdef($this->start_date, $this->end_date, $this->id_bci, $this->id_bce, $this->id_bcedef);
        $this->AllBCIlabo = DocumentachatTable::getInstance()->getAllBciByDateBCILabo($this->start_date, $this->end_date, $this->id_bci, $this->id_bce);
        $this->AllFacture = DocumentachatTable::getInstance()->getAllBciByDateFacture($this->start_date, $this->end_date, $this->id_bci, $this->id_bce, $this->id_bcedef);
    }

    public function executeGetcommandebypager(sfWebRequest $request)
    {
        $params = array();
        $content = $request->getContent();
        $this->offset = 0;
        $this->start_date = date('Y-m-d', strtotime(date('Y/m/01')));
        $d = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
        $this->end_date = date('Y-m-d', strtotime(date("Y") . '-' . date("m") . '-' . $d));
        $id_bci = null;
        $id_bce = null;
        $id_fac = null;
        $id_bcedef = null;
        $id_bcilabo = null;
        if (!empty($content)) {
            $params = json_decode($content, true);

            if ($params['start_date']) {
                $this->start_date = date('Y-m-d', strtotime($params['start_date']));
            }

            if ($params['end_date']) {
                $this->end_date = date('Y-m-d', strtotime($params['end_date']));
            }

            if ($params['offset']) {
                $this->offset = ($params['offset'] - 1) * 5;
            }
            if ($params['id_bci'] && is_numeric($params['id_bci'])) {
                $id_bci = intval($params['id_bci']);
            }
            if ($params['id_bce'] && is_numeric($params['id_bce'])) {
                $id_bce = intval($params['id_bce']);
            }
            if ($params['id_fac'] && is_numeric($params['id_fac'])) {
                $id_fac = intval($params['id_fac']);
            }
            if ($params['id_bcedef'] && is_numeric($params['id_bcedef'])) {
                $id_bcedef = intval($params['id_bcedef']);
            }
            if ($params['id_bcilabo'] && is_numeric($params['id_bcilabo'])) {
                $id_bcilabo = intval($params['id_bcilabo']);
            }
        }
        $documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDate(6, 5, $this->offset, $this->start_date, $this->end_date, $id_bci);

        return $this->renderPartial("listCommandes", array("documentachats" => $documentachats));
    }
    public function random_string($length)
    {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }
    public function executeUploaderfile(sfWebRequest $request)
    {

        header('Access-Control-Allow-Origin: *');
        $id = $_REQUEST['id'];
        $objet = $_REQUEST['piecejoint_objet'];
        $sujet = $_REQUEST['piecejoint_sujet'];

        $name = explode(".", $_FILES['fileSelected']['name']);

        $name_uploaded = $this->random_string(20) . '.' . $name[1];
        $uploads_dir = sfConfig::get('sf_upload') . $name_uploaded;

        if (move_uploaded_file($_FILES['fileSelected']['tmp_name'], $uploads_dir)) {
            $piece_joint = new Piecejoint();
            $piece_joint->setChemin($name_uploaded);
            $piece_joint->setObjet($objet);
            $piece_joint->setSujet($sujet);
            $piece_joint->setIdDocachat($id);
            $piece_joint->save();

            return $this->renderText(json_encode(array(
                "valid" => 'upload success',
            )));
        }
        return $this->renderText(json_encode(array(
            "valid" => 'Erreur',
        )));
    }

    public function executeNew(sfWebRequest $request)
    {
        $idtype = 4;
        if ($request->getParameter('idtype')) {
            $idtype = $request->getParameter('idtype');
        }
        $this->idtype = $idtype;
       
        $this->form = $this->configuration->getForm();
        $this->documentachat = $this->form->getObject();
        $this->documentachat->setIdTypedoc($this->idtype);
        $this->documentachat->setNumero($this->documentachat->NumeroSeqDocumentAchat(6));
        $this->documentachat->setDatecreation(date('Y-m-d'));
    }
    public function executeIndex(sfWebRequest $request)
    {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }

        if ($request->getParameter('idtype')) {
            $this->idtype = $request->getParameter('idtype');
            $this->id_type_doc = $this->idtype;

        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();
    }
    public function executeIndexbonsortie(sfWebRequest $request)
    {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;
        $this->form = new DocumentachatFormFilter();
        $idtype = 23;
        if ($request->getParameter('idtype')) {
            $idtype = $request->getParameter('idtype');
        }
        $this->idtype = $idtype;
        $this->boncommandeexterne = Doctrine_Core::getTable('documentachat')
            ->createQuery('a')
            ->where('id_typedoc=' . $idtype)
            ->andwhere('id_naturedoc is null')
        ;
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
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_demandeur=" . $request->getParameter('idfrs'));
        }
        $this->boncommandeexterne = $this->boncommandeexterne->execute();
    }
    public function executeGetListeBCIMagasin(sfWebRequest $request)
    {
        $query = "select documentachat.id as id,
                LPAD(documentachat.numero::text, 7, '0') as numero,
                naturedocachat.code as type"
            . " from documentachat,naturedocachat  "
            . " where documentachat.id_typedoc= 4"
            . " and  documentachat.id_naturedoc = 1 "
            . " and documentachat.id_etatdoc = 102"
            . " and  documentachat.id_user is null "
            . " and naturedocachat.id =documentachat.id_naturedoc"
            . " order by documentachat.id desc ";
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListeBCIMagasinBonsortie(sfWebRequest $request)
    {
        $query = "select documentachat.id as id,
                LPAD(documentachat.numero::text, 7, '0') as numero,
                typedoc.prefixetype as type"
            . " from documentachat  "
            . " left Join naturedocachat  on naturedocachat.id =documentachat.id_naturedoc"
            . "  left Join typedoc on typedoc.id =documentachat.id_typedoc "
            . " where documentachat.id_typedoc= 23"
            . " and  documentachat.id_naturedoc is null "
            . " and documentachat.id_etatdoc = 1"
            . " and documentachat.id_docparent  in
              (select id from documentachat
                     where documentachat.id_typedoc=4 and documentachat.id_naturedoc=1
                     and documentachat.id_etatdoc = 102
                     and documentachat.id_user is null )"
            . " and documentachat.etat is null "
            . " order by documentachat.id desc ";
        // die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        if(count($parcc)>0)
        die(json_encode($parcc));
        die(json_encode([]));
    }
    protected function getPager()
    {
        $pager = $this->configuration->getPager('documentachat');
        $pager->setQuery($this->buildQuery());
        $pager->setPage($this->getPage());
        $pager->init();

        return $pager;
    }
    protected function buildQuery()
    {

        $idtype = $this->id_type_doc;
        $user = UtilisateurTable::getInstance()->find($this->getUser()->getAttribute('userB2m')->getId());
        $magasins = EtageTable::getInstance()->findAll();
        //   $id_emplacemnt = $user->getIdMagasin();
        $idmagasins = [];
        if ($user->getIdMagasin()) {
            $idmagasins = json_decode($user->getIdMagasin());
        }
        $idmagasins_chaine = '';
        foreach ($idmagasins as $key => $l):
            $idmagasins_chaine = $idmagasins_chaine . $l;
            if ($key < count($idmagasins) - 1) {
                $idmagasins_chaine = $idmagasins_chaine . ',';
            }
        endforeach;
        // die($idmagasins_chaine.'r');
        $tableMethod = $this->configuration->getTableMethod();

        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }
        // if ($request->getParameter('idtype'))
        // $this->idtype = $request->getParameter('idtype');
        $this->filters->setTableMethod($tableMethod);
        $filter = $this->getFilters();

        $query = $this->filters->buildQuery($this->getFilters());
        $documentsachat = Doctrine_Core::getTable('documentachat')
            ->createQuery('a');
        if ($idtype == 23) {
            $documentsachat = $documentsachat->where('id_typedoc =' . $idtype);
        } else if ($idtype == 6) {
            $documentsachat = $documentsachat->where('id_typedoc =' . $idtype);
        } else {
            $documentsachat = $documentsachat->where('id_typedoc =' . 4);
        }

        if (isset($filter['reference'])) {
            $documentsachat = $documentsachat->Andwhere("reference like '%" . $filter['reference'] . "%'");
        }

        if (isset($filter['numero']) && is_numeric($filter['numero'])) {
            $documentsachat = $documentsachat->Andwhere("numero = " . $filter['numero'] . "");
        }

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
        if ($idmagasins && count($idmagasins) > 0 && $idtype != 23) {
            $documentsachat = $documentsachat->AndwhereIn('id_emplacement ', $idmagasins);
        }
        if ($idmagasins && count($idmagasins) > 0 && $idtype == 23) {
            $documentsachat = $documentsachat->
                Andwhere('a.id in (select id
            where a.id_emplacement in (' . $idmagasins_chaine . '))');
        }
        if ($user) {
            // $documentsachat = $documentsachat->Andwhere('a.id_user=' . $user->getId());
        }

        //die($documentsachat);
        $query = $documentsachat->OrderBy('id desc');
        $this->addSortQuery($query);

        return $query;
    }
    public function executeShowdocumentbnsortie(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

        $iddoc = $request->getParameter('iddoc');

        $documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->documentachat = $documentachat;
        $documentachat->setEtat(1);
        $documentachat->save();
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        $this->basetvas = Doctrine_Core::getTable('tvabase')->findByIdDoc($iddoc);

    }

    public function executeSavedocument(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddemandeur = $params['id_utilisateur'];
            $id_projet = $params['id_projet'];
            $idtypedoc = $params['typedoc'];

            $id_emplacement = $params['id_emplacement'];
            $datesignaturebci = $params['datesignaturebci'];
            $ref = $params['ref'];

            $datecreation = $params['datecreation'];
            $listeslignesdoc = $params['listeslignesdoc'];
            $id_nature = $params['id_nature'];
            $montant_estimatif = $params['montant_estimatif'];
            $iddoc = $params['iddoc'];
            $is_valide = $params['is_valide'];
            if ($iddemandeur) {
                $demandeur = DemandeurTable::getInstance()->find($iddemandeur);
            }

            $user = new Utilisateur();
            $user = $this->getUser()->getAttribute('userB2m');
            //die($valide);
            if ($iddoc == '') {
                //______________________ajouter document achat
                $documentachat = new Documentachat();
                $numero = $documentachat->NumeroSeqDocumentAchat(4);
                $documentachat->setNumero($numero);
                if ($id_nature == 2) {
                    if (!$datesignaturebci) {
                        $documentachat->setIdEtatdoc(94);
                    } else {
                        $documentachat->setIdEtatdoc(1);
                    }
                }
                if ($id_nature == 1) {
                    if (!$datesignaturebci) {
                        $documentachat->setIdEtatdoc(94);
                    } else {
                        $documentachat->setIdEtatdoc(86);
                    }
                }
                if ($id_nature == 3) {
                    if (!$datesignaturebci) {
                        $documentachat->setIdEtatdoc(94);
                    } else {
                        $documentachat->setIdEtatdoc(89);
                    }
                }
                if ($id_nature == 4) {
                    if (!$datesignaturebci) {
                        $documentachat->setIdEtatdoc(94);
                    } else {
                        $documentachat->setIdEtatdoc(90);
                    }
                }
                if ($id_nature == 5) {
                    if (!$datesignaturebci) {
                        $documentachat->setIdEtatdoc(94);
                    } else {
                        $documentachat->setIdEtatdoc(91);
                    }
                }
                if ($id_nature == 6) {
                    if (!$datesignaturebci) {
                        $documentachat->setIdEtatdoc(94);
                    } else {
                        $documentachat->setIdEtatdoc(92);
                    }
                }
                if ($id_nature == 7) {
                    if (!$datesignaturebci) {
                        $documentachat->setIdEtatdoc(86);
                    } else {
                        $documentachat->setIdEtatdoc(103);
                    }                
                }
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
            //  $documentachat->setNumero($numero);
            if ($id_nature == 2) {
                if (!$datesignaturebci) {
                    if ($idtypedoc == 4) {
                        $documentachat->setIdEtatdoc(94);
                    } else if ($idtypedoc == 6) {
                        $documentachat->setTypedocexporter(1);
                        if ($montant_estimatif && $montant_estimatif != "") {
                            $documentachat->setMntttc($montant_estimatif);
                        }

                    }
                } else {
                    if ($idtypedoc == 4) {
                        $documentachat->setIdEtatdoc(1);
                    } else if ($idtypedoc == 6) {
                        $documentachat->setIdEtatdoc(24);
                        $documentachat->setTypedocexporter(1);
                        if ($montant_estimatif && $montant_estimatif != "") {
                            $documentachat->setMntttc($montant_estimatif);
                        }
                    }
                }
            }
            if ($id_nature == 1) {
                if (!$datesignaturebci) {
                    $documentachat->setIdEtatdoc(94);
                } else {
                    $documentachat->setIdEtatdoc(86);
                }
            }
            if ($id_nature == 3) {
                if (!$datesignaturebci) {
                    $documentachat->setIdEtatdoc(94);
                } else {
                    $documentachat->setIdEtatdoc(89);
                }
            }
            if ($id_nature == 4) {
                if (!$datesignaturebci) {
                    $documentachat->setIdEtatdoc(94);
                } else {
                    $documentachat->setIdEtatdoc(90);
                }
            }
            if ($id_nature == 5) {
                $documentachat->setIdEtatdoc(91);
            }
            if ($id_nature == 6) {
                if (!$datesignaturebci) {
                    $documentachat->setIdEtatdoc(94);
                } else {
                    $documentachat->setIdEtatdoc(92);
                }
            }

            if ($iddemandeur) {
                $documentachat->setIdDemandeur($iddemandeur);
            }

            if ($id_nature && $id_nature != "") {
                $documentachat->setIdNaturedoc($id_nature);
            }

            // if ($id_emplacement && $id_emplacement != "") {
            //     $documentachat->setIdEmplacement($id_emplacement);
            // }

            if ($demandeur && $iddemandeur != "") {
                $documentachat->setIdEmplacement($demandeur->getIdLabo());
            }
            /* */

            if ($montant_estimatif && $montant_estimatif != "") {
                $documentachat->setMontantestimatif($montant_estimatif);
            }

            $documentachat->setIdTypedoc($idtypedoc);
            if ($ref) {
                $documentachat->setReference($ref);
            }

            if ($datesignaturebci) {
                $documentachat->setValide(true);
            } 
            else {
                $documentachat->setValide(false);
            }
            if ($datecreation != "") {
                $documentachat->setDatecreation($datecreation);
            } else {
                $documentachat->setDatecreation(date('Y-m-d'));
            }

            if ($id_projet) {
                $documentachat->setIdProjet($id_projet);
            }
            // $file=$params['fileSelected'];
            // die('hello'.$_FILES[$file]['name']);
            if ($datesignaturebci) {
                $documentachat->setDatesignaturebci($datesignaturebci);
            }

            $documentachat->save();

            foreach ($listeslignesdoc as $lignedoc) {

                $norgdre = $lignedoc['norgdre'];
                $qte = $lignedoc['quantite'];
                $codearticle = $lignedoc['codearticle'];
                $designation = $lignedoc['designation'];
                //$stockable = $lignedoc['stockable'];
                // $idprojet = $lignedoc['idprojet'];
                // $mid = $lignedoc['mid'];
                if ($id_nature == 2) {
                $stockable = $lignedoc['stockable'];
                $patrimoine = $lignedoc['patrimoine'];
                $service = $lignedoc['service'];}
                $observation = $lignedoc['observation'];
                $unitedemander = $lignedoc['unitedemander'];
                $idunitemarche = $lignedoc['idunitemarche'];
                $emplacement_id = $lignedoc['id_emplacement'];
                $lignedoc = new Lignedocachat();
                $lignedoc->setIdDoc($documentachat->getId());
                $lignedoc->setNordre($norgdre);
                $lignedoc->setQte($qte);
                $lignedoc->setIdEmplacement($emplacement_id);
                if ($observation && $observation != "") {
                    $lignedoc->setObservation($observation);
                }

                if ($unitedemander && $unitedemander != "") {
                    $lignedoc->setUnitedemander($unitedemander);
                }

                if ($idunitemarche && $idunitemarche != "") {
                    $lignedoc->setIdUnitemarche($idunitemarche);
                }
                if ($id_nature == 2) {
                if ($stockable && $stockable != "") {
                    $lignedoc->setIsSps('is_stockable');
                }
                if ($service && $service != "") {
                    $lignedoc->setIsSps('is_service');
                }
                if ($patrimoine && $patrimoine != "") {
                    $lignedoc->setIsSps('is_patrimoine');
                }
            }
                if ($codearticle) {
                    $lignedoc->setCodearticle($codearticle);
                }

                if ($designation) {
                    $lignedoc->setDesignationarticle($designation);
                }

                //____________________________________rech article en stock
                if ($designation != "") {
                    $lignedoc->setDesignationarticle($designation);
                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
                    if ($article) {
                        $lignedoc->setIdArticlestock($article->getId());
                        $lignedoc->setCodearticle($article->getCodeart());
                    }
                }
                if ($designation != "") {
                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
                    if ($article) {
                        $lignedoc->setIdArticlestock($article->getId());
                    }
                    // else {

                    //     $article = new Article();

                    //     $article->setDatecreation(date('Y-m-d'));
                    //     $article->setIdUser($user->getId());
                    //     if ($designation && $designation != "") {
                    //         $article->setDesignation($designation);
                    //     }

                    //     if ($stockable == 'true') {
                    //         $article->setStocable(true);
                    //     } else {
                    //         $article->setStocable(false);
                    //     }

                    //     if ($id_nature == 1) {
                    //         $article->setStocable(true);
                    //     }

                    //     if ($idunitemarche && $idunitemarche != "") {
                    //         $article->setIdUnite($idunitemarche);
                    //     }

                    //     // if ($user->getIsAdmin()) {
                    //     //     $idemplacement = $user->getAdministartionSite()->getId();
                    //     //     if ($idemplacement)
                    //     //         $article->setIdEmplacement($idemplacement);
                    //     // }
                    //     $article->save();
                    //     $lignedoc->setIdArticlestock($article->getId());
                    //     $article->save();
                    //     $lignedoc->setIdArticlestock($article->getId());
                    // }
                }

                // else
                //     $ligneplaning->setStocable(false);
                //_____________________________________Fin recherche
                if ($id_projet != '') {
                    $lignedoc->setIdProjet($id_projet);
                }
                // if ($demandeur && $iddemandeur != "") {
                //     $lignedoc->setIdEmplacement($demandeur->getIdLabo());
                // }
                $lignedoc->save();
                $lignedocqte = new Qtelignedoc();
                $lignedocqte->setQtedemander($qte);
                $lignedocqte->setIdLignedocachat($lignedoc->getId());
                $lignedocqte->save();

            }

            die(trim($documentachat->getId()) . "");
        }
    }
    public function executeEdit(sfWebRequest $request)
    {
        $id = $request->getParameter('id');
        $this->idtype = 4;
        $documentachat = DocumentachatTable::getInstance()->find($id);
        $this->documentachat = $documentachat;
        $this->form = $this->configuration->getForm($this->documentachat);
        $this->idtype = $documentachat->getIdTypedoc();
    }
    public function executeShowdocument(sfWebRequest $request)
    {

        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

        $iddoc = $request->getParameter('iddoc');
        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')
            ->createQuery('a')
            ->where('id_doc=' . $iddoc)
            ->orderBy('id asc')->execute();
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

    public function ReadHtml($societe, $aviss, $documentachat, $listesdocuments)
    {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBonCommandeInterneLAbo($aviss, $listesdocuments);
        return $html;
    }

    public function executeAfficherPartial(sfWebRequest $request)
    {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("Achatdoc/listearticles");
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $iddoc = $request->getParameter('id');
        $documentachat = DocumentachatTable::getInstance()->find($iddoc);
        $piece=PiecejointTable::getInstance()->findOneByIdDocachat($iddoc);
        if($piece)
        $piece->delete();
        //Suppression All Lignedocachat && Qtelignedoc
        foreach ($documentachat->getLignedocachat() as $lignedocachat) {
            foreach ($lignedocachat->getQtelignedoc() as $qtelignedoc) {
                $qtelignedoc->delete();
            }
            $lignedocachat->delete();
        }

        $this->forward404Unless($documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id'))), sprintf('Object fiche does not exist (%s).', $request->getParameter('id')));
        $documentachat->delete();

        $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        $this->redirect('Achatdoc/index');
    }
    public function executeImprimerFicheBoncommandeAvecChoix(sfWebRequest $request)
    {
        $pdf = new sfTCPDF('L');
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Suivi des bons commandes ');
        $pdf->SetSubject("Suivi des bons commandes ");
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
        $pdf->SetMargins(5, 30, 5);
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
        $html = $this->ReadHtmlSuivibce($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Suivi des bons commandes .pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlSuivibce(sfWebRequest $request)
    {
        $html = StyleCssHeader::header1();
        $piece = new Documentachat();
        $html .= $piece->ReadHtmlSuivibcilabo($request);
        return $html;
    }
    public function executeGetListeDemandeAppAnnuler(sfWebRequest $request)
    {
        $user = $this->getUser()->getAttribute('userB2m');
        $ids = json_decode($user->getIdMagasin());
        $query = "select documentachat.id as id,
        LPAD(documentachat.numero::text, 7, '0') as numero ,
            naturedocachat.libelle as nature
            , naturedocachat.code as type  "
        . " from documentachat  ,naturedocachat"
        . " where documentachat.id_typedoc= 4"
        . " and  documentachat.id_naturedoc = 6 "
        . " and documentachat.id_etatdoc = 85"
        . " and naturedocachat.id=documentachat.id_naturedoc"
        . " and   documentachat.id_emplacement IN (" . implode(',', array_map('intval', $ids)) . ") "
            . " order by documentachat.id desc ";
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        if(count($parcc)>0)
        die(json_encode($parcc));
        die(json_encode([]));

    }

    public function executeShowdocumentbonsortie(sfWebRequest $request)
    {
        if (!$request->getParameter('iddoc')) {
            $this->redirect('@documentachat');
        }

        $iddoc = $request->getParameter('iddoc');

        $this->documentachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc);
        $this->listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        $this->basetvas = Doctrine_Core::getTable('tvabase')->findByIdDoc($iddoc);
    }

    public function executeImprimerdocentre(sfWebRequest $request)
    {
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

        $pdf->SetTitle('Fiche D.I. N°:');
        $pdf->SetSubject("document d'achat");
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
        //        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(10, 30, 10);
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

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
//
        //die($documentachat->getIdTypedoc().'gg');
        //die($html);

        if ($documentachat->getIdTypedoc() == 11 || $documentachat->getIdTypedoc() == 23) {
            $html = $this->ReadHtmlBonSortie($societe, $documentachat, $listesdocuments);
        }

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

    public function ReadHtmlBonSortie($societe, $documentachat, $listesdocuments)
    {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBonSorties();
        //die($html);
        return $html;
    }
}
