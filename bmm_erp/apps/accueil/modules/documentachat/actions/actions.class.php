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
    protected $idtype = 4;
    public function executeIndex(sfWebRequest $request)
    {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }
        $id_typedoc = 4;
        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }
        if ($request->getParameter('idtype')) {
            $id_typedoc = $request->getParameter('idtype');
        }
        $this->idtype = $id_typedoc;

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();
        $this->idtyped = $this->idtype;
    }

    public function executeShowSuivicommandeBCI(sfWebRequest $request)
    {
        $this->offset = 0;
        $this->start_date = date('Y-m-d', strtotime(date('Y/m/01')));
        $this->id_bci = null;
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

        $this->documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDate(4, 5, $this->offset, $this->start_date, $this->end_date, $this->id_bci);

        $this->AllBCI = DocumentachatTable::getInstance()->getAllBciByDate(4, $this->start_date, $this->end_date, $this->id_bci);
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
        }
        $documentachats = DocumentachatTable::getInstance()->getDocByTypeDocAndDate(4, 5, $this->offset, $this->start_date, $this->end_date, $id_bci);

        return $this->renderPartial("listCommandes", array("documentachats" => $documentachats));
    }

    public function executeUploaderfile(sfWebRequest $request)
    {
        //header('Access-Control-Allow-Origin: *');
        $id = $_REQUEST['id'];
        $name = $_FILES['fileSelected']['name'];
        $uploads_dir = sfConfig::get('sf_upload') . $name;
        move_uploaded_file($_FILES['fileSelected']['tmp_name'], $uploads_dir);

        $piece_joint = new Piecejoint();
        $piece_joint->setChemin($name);
        $piece_joint->setIdDocachat($id);
        $piece_joint->save();
        // $this->redirect('Achatdoc/showdocument?iddoc=' . $id . '&idtab=1');
        // return  $this->redirect('url',200);
        return $this->renderText(json_encode(array(
            "valid" => 'upload success',
        )));
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->idtyped = $this->idtype;

        if ($request->getParameter('idtype')) {
            $this->idtyped = $request->getParameter('idtype');
        }

        $this->form = $this->configuration->getForm();
        $this->documentachat = $this->form->getObject();
        $this->documentachat->setIdTypedoc($this->idtype);
        $this->documentachat->setNumero($this->documentachat->NumeroSeqDocumentAchat(6));
        $this->documentachat->setDatecreation(date('Y-m-d'));
        //die($this->idtype);
    }
    public function executeArticlebycodeanddesignation(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_naturedoc = $params['id_naturedoc'];
            $codearticle = $params['codearticle'];
            $id_emplacement = $params['id_emplacement'];
            $designation = strtoupper($params['designation']);
            if ($id_naturedoc != 1) {
                $q = Doctrine_Query::create()
                    ->select(" article.id,article.codeart as ref,trim( both '  ' from article.designation) as name")
                    ->from('article');
                $designation = str_replace("'", "''", $designation);
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

                if ($user->getIsAdmin()) {
                    $labo = $user->getAdministartionSite();
                    $q = $q->AndWhere('id_emplacement=' . $labo->getId());
                }
            } else {
                $user = $this->getUser()->getAttribute('userB2m');

                $idemplacement = $user->getAdministartionSite()->getId();
                $q = Doctrine_Query::create()
                    ->select(" article.id,article.codeart as ref,trim( both '  ' from article.designation) as name")
                    ->from('article');
                $designation = str_replace("'", "''", $designation);
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

                $q = $q->AndWhere('id_emplacement is not null');
            }
            if ($id_emplacement == '') {
                $q = $q->AndWhere('id_emplacement is null');
            }

            $listesarticles = $q->fetchArray();
            die(json_encode($listesarticles));
        }
        die('bien');
    }

    protected function buildQuery()
    { //$this->idtyped
        $id_typedoc = $this->idtype;
        // die($id_typedoc.'rr');
        $user = UtilisateurTable::getInstance()->find($this->getUser()->getAttribute('userB2m')->getId());
        $userconnected = $this->getUser()->getAttribute('userB2m');
        $acces_magasin = $userconnected->getProfilApplication("ADMINISTRATEUR MAGASIN");
        $acces_stock = $userconnected->getProfilApplication("Unité Gestion des Stocks");
        $magasins = EtageTable::getInstance()->findAll();
        //   $id_emplacemnt = $user->getIdMagasin();
        $idmagasins = [];
        if ($user->getIdMagasin()) {
            $idmagasins = json_decode($user->getIdMagasin());
        }

        $tableMethod = $this->configuration->getTableMethod();

        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);
        $filter = $this->getFilters();

        $query = $this->filters->buildQuery($this->getFilters());
        $documentsachat = Doctrine_Core::getTable('documentachat')
            ->createQuery('a')
            ->where('id_typedoc=' . $id_typedoc);

        if (isset($filter['reference']) && $filter['reference'] != '') {
            $documentsachat = $documentsachat->Andwhere("reference like '%" . $filter['reference'] . "%'");
        }

        if (isset($filter['numero']) && is_numeric($filter['numero'])) {

            $documentsachat = $documentsachat->Andwhere("cast(numero as varchar(255)) like '%" . $filter['numero'] . "%'");
        }
        // die($documentsachat);
        if (isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        } elseif (isset($filter['datecreation']['from']) && !isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . date('Y') . "-12-31" . "'");
        }

        if ($idmagasins && count($idmagasins) > 0 && $id_typedoc != 23 && !$acces_stock) {
            $documentsachat = $documentsachat->AndwhereIn('id_emplacement ', $idmagasins);
        }

        if ($acces_magasin || $acces_stock) {
            $documentsachat = $documentsachat->Andwhere('id_naturedoc= 1 or id_naturedoc= 7 or (id_user= ' . $user->getId() . ' and id_naturedoc not in (1,7))');
        } else {
            $documentsachat = $documentsachat->Andwhere('id_user= ' . $user->getId())
                ->andWhere('id_naturedoc!=1');
        }
        // if ($user && $id_typedoc != 23) {
        //     $documentsachat = $documentsachat->Andwhere('id_user= ' . $user->getId())
        //     ->andWhere('id_naturedoc!=1');
        // }
        if ($user && $id_typedoc == 23) {
            $documentsachat =
            $documentsachat
                ->Andwhere('a.id_docparent in
              (select id from documentachat
               where documentachat.id_typedoc=4
               and documentachat.id_naturedoc=1
               and documentachat.id_user= ' . $user->getId() . ")");
        }
        //  die($documentsachat);
        $query = $documentsachat->OrderBy('id desc');

        $this->addSortQuery($query);

        return $query;
    }
    public function executeIndexbonsortie(sfWebRequest $request)
    {
        $user = UtilisateurTable::getInstance()->find($this->getUser()->getAttribute('userB2m')->getId());
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;
        $this->form = new DocumentachatFormFilter();
        $idtype = 23;
        if ($request->getParameter('idtype')) {
            $idtype = $request->getParameter('idtype');
        }
        $this->idtype = $idtype;
        // $this->boncommandeexterne = Doctrine_Core::getTable('documentachat')
        //     ->createQuery('a')
        //     ->where('id_typedoc=' . $idtype)
        //     ->andwhere('id_naturedoc is null')
        //     ;
        // $this->datedebut = "";
        // $this->datefin = "";
        // $this->idfrs = "";
        // if ($request->getParameter('debut') && $request->getParameter('debut') != "") {
        //     $this->datedebut = $request->getParameter('debut');
        //     $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation>='" . $request->getParameter('debut') . "'");
        // }
        // if ($request->getParameter('fin') && $request->getParameter('fin') != "") {
        //     $this->datefin = $request->getParameter('fin');
        //     $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("datecreation<='" . $request->getParameter('debut') . "'");
        // }
        // if ($request->getParameter('idfrs') && $request->getParameter('idfrs') != "") {
        //     $this->idfrs = $request->getParameter('idfrs');
        //     $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_demandeur=" . $request->getParameter('idfrs'));
        // }
        $this->boncommandeexterne = Doctrine_Core::getTable('documentachat')
            ->createQuery('a')
            ->where('id_typedoc=' . $idtype)
            ->andwhere('id_naturedoc is null');
        $query = "select a.id as id,a.id_docparent ,
       typedoc.prefixetype, LPAD(a.numero::text, 7, '0') as numero,
        a.datecreation as datecreation , demandeur.libelle as libelle,
         agents.nomcomplet , agents.prenom , a.mntttc,
         etatdocument.etatdocachat "
        . " from documentachat a ,typedoc ,demandeur,agents,etatdocument"
        . " where a.id_typedoc= " . $idtype
        . " and typedoc.id=a.id_typedoc "
        . " and  demandeur.id =a.id_demandeur "
        . " and demandeur.id_agent=agents.id"
        . " and etatdocument.id=a.id_etatdoc"
        . " and  a.id_naturedoc is null "
        . " and a.id_docparent in
        (select id from documentachat
                where documentachat.id_typedoc=4
                and documentachat.id_naturedoc=1
                and documentachat.id_user= " . $user->getId() . ")"
            . "  ";
        //die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $this->boncommandeexterne = $conn->fetchAssoc($query);
        // if ($user ) {
        //     $this->boncommandeexterne =
        //     $this->boncommandeexterne
        //       ->Andwhere('a.id_docparent in
        //       (select id from documentachat
        //        where documentachat.id_typedoc=4
        //        and documentachat.id_naturedoc=1
        //        and documentachat.id_user= ' . $user->getId() . ")");
        // }
        // die($this->boncommandeexterne);
        // $this->boncommandeexterne = $this->boncommandeexterne->execute();
    }
    public function executeSavedocument(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddemandeur = $params['id_utilisateur'];
            $idtypedoc = $params['typedoc'];
            $id_emplacement = $params['id_emplacement'];
            $ref = $params['ref'];
            $datecreation = $params['datecreation'];
            $listeslignesdoc = $params['listeslignesdoc'];
            $id_nature = $params['id_nature'];
            $montant_estimatif = $params['montant_estimatif'];
            $iddoc = $params['iddoc'];
            $is_valide = $params['is_valide'];
            $project_id = $params['project_id'];
            $datesignaturebci = $params['datesignaturebci'];
           
            $user = new Utilisateur();
            $user = $this->getUser()->getAttribute('userB2m');
            //die($valide);
            if ($iddoc == '') {
                //______________________ajouter document achat
                $documentachat = new Documentachat();
                $numero = $documentachat->NumeroSeqDocumentAchat($idtypedoc);
                if ($numero) {
                    $documentachat->setNumero($numero);
                }

                if ($project_id) {
                    $documentachat->setIdProjet($project_id);
                }

                if ($idtypedoc == 4):

                    if ($id_nature != 7) {
                        if ($user->getIsAdmin()) {
                            $documentachat->setIdEtatdoc(1);
                        } else {
                            $documentachat->setIdEtatdoc(94);
                        }
                    } else {
                       // die($params['datesignaturebci']);
                        if ($user->getIsAdmin()  ) {
                            if(isset($params['datesignaturebci'] ) && $params['datesignaturebci']!='')
                             $documentachat->setIdEtatdoc(103);
                             else
                            $documentachat->setIdEtatdoc(1);
                        } else {
                         if(isset($params['datesignaturebci'] ) && $params['datesignaturebci']!='')
                             $documentachat->setIdEtatdoc(103);
                             else
                            $documentachat->setIdEtatdoc(1);
                        }
                    } elseif ($idtypedoc == 6):

                    if ($user->getIsAdmin()) {
                        $documentachat->setIdEtatdoc(24);
                    } else {
                        $documentachat->setIdEtatdoc(94);
                    }

                    $documentachat->setTypedocexporter(1);
                    if ($montant_estimatif && $montant_estimatif != "") {
                        $documentachat->setMntttc($montant_estimatif);
                    }
                endif;
            } else {
                //modifier document achat
                $documentachat = DocumentachatTable::getInstance()->find($iddoc);

                //Suppression All Lignedocachat && Qtelignedoc
                foreach ($documentachat->getLignedocachat() as $lignedocachat) {
                    foreach ($lignedocachat->getQtelignedoc() as $qtelignedoc) {
                        $qtelignedoc->delete();
                    }
                }
                Doctrine_Query::create()->delete('lignedocachat')
                    ->where('id_doc=' . $iddoc)->execute();
            }
            if ($iddemandeur) {
                $documentachat->setIdDemandeur($iddemandeur);
            }

            if ($id_nature && $id_nature != "") {
                $documentachat->setIdNaturedoc($id_nature);
            }

            if ($id_emplacement && $id_emplacement != "") {
                $documentachat->setIdEmplacement($id_emplacement);
            }

            if ($montant_estimatif && $montant_estimatif != "") {
                $documentachat->setMontantestimatif($montant_estimatif);
            }
            if ($idtypedoc) {
                $documentachat->setIdTypedoc($idtypedoc);
            }

            if ($ref) {
                $documentachat->setReference($ref);
            }

            if ($is_valide) {
                $documentachat->setValide(true);
                if ($idtypedoc == 4):
                    if ($id_nature != 7) {
                        if ($user->getIsAdmin()) {
                            $documentachat->setIdEtatdoc(1);
                        } else {
                            $documentachat->setIdEtatdoc(94);
                        }
                    } else {
                           if ($user->getIsAdmin()  ) {
                            if(isset($params['datesignaturebci'] ) && $params['datesignaturebci']!='')
                             $documentachat->setIdEtatdoc(103);
                             else
                            $documentachat->setIdEtatdoc(1);
                        } else {
                           if(isset($params['datesignaturebci'] ) && $params['datesignaturebci']!='')
                             $documentachat->setIdEtatdoc(103);
                             else
                            $documentachat->setIdEtatdoc(1);
                        }
                    } elseif ($idtypedoc == 6):
                    if ($user->getIsAdmin()) {
                        $documentachat->setIdEtatdoc(24);
                    } else {
                        $documentachat->setIdEtatdoc(94);
                    }

                    $documentachat->setTypedocexporter(1);
                    if ($montant_estimatif && $montant_estimatif != "") {
                        $documentachat->setMntttc($montant_estimatif);
                    }
                endif;
            }
            if ($datecreation != "") {
                $documentachat->setDatecreation($datecreation);
            } else {
                $documentachat->setDatecreation(date('Y-m-d'));
            }

            if ($user) {
                $documentachat->setIdUser($user->getId());
            }
            if ($datesignaturebci) {
                $documentachat->setDatesignaturebci($datesignaturebci);
            }

            $documentachat->save();
            //die(json_encode($listeslignesdoc ));
            foreach ($listeslignesdoc as $lignedoc) {

                $norgdre = $lignedoc['norgdre'];
                $qte = $lignedoc['quantite'];
                $codearticle = $lignedoc['codearticle'];
                $designation = $lignedoc['designation'];
                $is_sps = $lignedoc['is_sps'];

                $idprojet = $project_id;
                $observation = $lignedoc['observation'];
                $unitedemander = $lignedoc['unitedemander'];
                $idunitemarche = $lignedoc['idunitemarche'];
                $id_eplacement = $lignedoc['id_emplacement'];
                $ligne_doc = new Lignedocachat();
                $ligne_doc->setIdDoc($documentachat->getId());
                $ligne_doc->setNordre($norgdre);
                $ligne_doc->setQte($qte);
                $ligne_doc->setIdEmplacement($id_eplacement);

                if ($is_sps && $is_sps == "is_stockable") {
                    $ligne_doc->setIsSps('is_stockable');
                }
                if ($is_sps && $is_sps == "is_service") {
                    $ligne_doc->setIsSps('is_service');
                }
                if ($is_sps && $is_sps == "is_patrimoine") {
                    $ligne_doc->setIsSps('is_patrimoine');
                }

                if ($observation && $observation != "") {
                    $ligne_doc->setObservation($observation);
                }

                if ($unitedemander && $unitedemander != "") {
                    $ligne_doc->setUnitedemander($unitedemander);
                }

                if ($idunitemarche && $idunitemarche != "") {
                    $ligne_doc->setIdUnitemarche($idunitemarche);
                }

                if ($codearticle) {
                    $ligne_doc->setCodearticle($codearticle);
                }

                if ($designation) {
                    $ligne_doc->setDesignationarticle($designation);
                }

                //____________________________________rech article en stock
                if ($designation != "") {
                    $ligne_doc->setDesignationarticle($designation);
                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
                    if ($article) {
                        $ligne_doc->setIdArticlestock($article->getId());
                        $ligne_doc->setCodearticle($article->getCodeart());
                    }
                }
                if ($designation != "") {
                    $article = Doctrine_Core::getTable('article')->findOneByDesignation($designation);
                    if ($article) {
                        $ligne_doc->setIdArticlestock($article->getId());
                    }
                }

                //_____________________________________Fin recherche
                if ($idprojet != '') {
                    $ligne_doc->setIdProjet($idprojet);
                }

                $ligne_doc->save();

                $lignedocqte = new Qtelignedoc();
                $lignedocqte->setQtedemander($qte);
                $lignedocqte->setIdLignedocachat($ligne_doc->getId());
                $lignedocqte->save();
            }

            die(trim($documentachat->getId()) . "");
        }
    }
    public function executeEdit(sfWebRequest $request)
    {
        $this->documentachat = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->documentachat);
        $this->idtypep = $this->idtype;
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
    public function executeImprimerdocachatBCIM(sfWebRequest $request)
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

        $societe = Doctrine_Core::getTable('societe')->findOneById(1);

        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);

        $pdf->SetAuthor($rs);

        $logo = PDF_HEADER_LOGO . '/' . $societe->getLogo();
        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, $entete, $rs, '', '');

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
        $html .= $documentachat->ReadHtmlBonCommandeInterneMagasin($aviss, $listesdocuments);
        return $html;
    }

    public function executeAfficherPartial(sfWebRequest $request)
    {

        $idd = $request->getParameter('idd');

        return $this->renderPartial("documentachat/listearticles");
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $iddoc = $request->getParameter('id');
        $documentachat = DocumentachatTable::getInstance()->find($iddoc);
        Doctrine_Query::create()->delete('piecejoint')
            ->where('id_docachat=' . $iddoc)->execute();
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
        $this->redirect('documentachat/index');
    }
    public function executeDeletePiecejoint(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($piecejoint = Doctrine_Core::getTable('piecejoint')->find(array($request->getParameter('id'))), sprintf('Object piecejoint does not exist (%s).', $request->getParameter('id')));
        $iddocahat = $piecejoint->getIdDocachat();
        $piecejoint->delete();

        $this->redirect('documentachat/edit?id=' . $iddocahat);
    }
    public function executeGetListeBCIMagasinParUser(sfWebRequest $request)
    {
        $user = $this->getUser()->getAttribute('userB2m');
        $query = "select documentachat.id as id,
        LPAD(documentachat.numero::text, 7, '0') as numero,naturedocachat.code as type"
        . " from documentachat ,naturedocachat "
        . " where documentachat.id_typedoc= 4"
        . " and  documentachat.id_naturedoc = 1 "
        . " and documentachat.id_etatdoc = 102"
        . " and naturedocachat.id=documentachat.id_naturedoc "
        . " and  documentachat.id_user  =" . $user->getId()
            . " order by documentachat.id desc ";
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
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

    public function executeGetListeBCIMagasinParUserBnsortie(sfWebRequest $request)
    {
        $user = $this->getUser()->getAttribute('userB2m');
        // $query = "select documentachat.id as id,
        // LPAD(documentachat.numero::text, 7, '0') as numero,naturedocachat.code as type"
        // . " from documentachat ,naturedocachat "
        // . " where documentachat.id_typedoc= 4"
        // . " and  documentachat.id_naturedoc = 1 "
        // . " and documentachat.id_etatdoc = 102"
        // . " and naturedocachat.id=documentachat.id_naturedoc "
        // . " and  documentachat.id_user  =" . $user->getId()
        //     . " order by documentachat.id desc ";
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
        where documentachat.id_typedoc=4 and
        documentachat.id_naturedoc=1
        and documentachat.id_etatdoc = 102
         and  documentachat.id_user  =" . $user->getId() . " )"
            . " and documentachat.etat is null "
            . " order by documentachat.id desc ";
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
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
        $logo = PDF_HEADER_LOGO . '/' . $societe->getLogo();
        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, $entete, $rs, '', '');

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
        $html .= $documentachat->ReadHtmlBonSortie();
        //die($html);
        return $html;
    }
}
