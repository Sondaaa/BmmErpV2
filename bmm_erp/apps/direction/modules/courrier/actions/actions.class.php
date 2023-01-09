<?php

require_once dirname(__FILE__) . '/../lib/courrierGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/courrierGeneratorHelper.class.php';

/**
 * courrier actions.
 *
 * @package    Bmm
 * @subpackage courrier
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class courrierActions extends autoCourrierActions {

    public function executeIndex(sfWebRequest $request) {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();
    }

    //__________________________________________________________________________Afficher courrier et faire quelque modification
    public function executeShowcourrier(sfWebRequest $request) {
        if (!$request->getParameter('idcourrier'))
            $this->redirect('expdest/index');

        $idcourrier = $request->getParameter('idcourrier');
        $this->courrier = new Courrier();
        $this->courrier = Doctrine_Core::getTable('courrier')->findOneById($idcourrier);
        $this->form = new CourrierForm($this->courrier);
        $idtype = $this->courrier->getIdType();

        $expdest = $this->courrier->getUtilisateur()->getExpdestinataire();
        $this->parameter_exp = Doctrine_Core::getTable('parametreexpedition')->findByIdTypecourrierAndIdExp($idtype, $expdest->getId());

        $idtype = $this->courrier->getIdType();
        $this->actions = Doctrine_Core::getTable('actionparcour')->findAll();

        $this->mvc = Doctrine_Core::getTable('parcourcourier')->findOneByIdCourrierdestAndIdRec($idcourrier, $expdest->getId());
    }

    //__________________________________________________________________________Afficher courrier et Imprimer un fichier pdf
    public function executeShocimprimer(sfWebRequest $request) {
        if (!$request->getParameter('idcourrier'))
            $this->redirect('expdest/index');

        $idcourrier = $request->getParameter('idcourrier');
        $this->courrier = new Courrier();
        $this->courrier = Doctrine_Core::getTable('courrier')->findOneById($idcourrier);
        $idtype = $this->courrier->getIdType();
        $user = $this->courrier->getUtilisateur(); //die($user);
        $expdest = $user->getExpdestinataire();

        $this->mvc = Doctrine_Core::getTable('parcourcourier')->findOneByIdCourrierdestAndIdRec($idcourrier, $expdest->getId());

        $this->parcourcou = Doctrine_Core::getTable('parcourcourier')->findByIdCourierAndIdExp($this->courrier->getId(), $expdest->getId());
    }

    //_____________________________Transformer courrier interieur -> exterieur
    public function executeTransformer(sfWebRequest $request) {
        $user = new Utilisateur();
        $user =  $this->getUser()->getAttribute('userB2m');

        $idcourrier = $request->getParameter('idcourrier');
        $idtypecourrier = $request->getParameter('idtype1');
        $idtypetransformer = $request->getParameter('idtype2');

        $cour = Doctrine_Core::getTable('courrier')->findOneById($idcourrier);
        if ($cour) {
            $c_arrive_int = new Courrier();
            $courrierTyb = new Courrier();
            if ($user) {
                $c_arrive_int->setIdUser($user->getId());
                $c_arrive_int->setNumero($courrierTyb->getNumerocourrier($user->getId(), $idtypetransformer));
                $c_arrive_int->setIdBureaux($user->getAgents()->getIdBureaux());
            }
            $c_arrive_int->setIdCourrier($idcourrier);
            if ($cour->getTitre())
                $c_arrive_int->setTitre($cour->getTitre());
            if ($cour->getObject())
                $c_arrive_int->setObject($cour->getObject());
            if ($cour->getSujet())
                $c_arrive_int->setSujet($cour->getSujet());
            if ($cour->getDescription())
                $c_arrive_int->setDescription($cour->getDescription());
            $c_arrive_int->setIdMode($cour->getIdMode());
            $c_arrive_int->setDatecreation(date('d-m-Y'));
            $c_arrive_int->setIdType(4);

            $referencecourrier = $cour->getTypecourrier()->getPrefix() . $cour->getNumero() . ' ' . $cour->getReferencecourrier();
            $c_arrive_int->setReferencecourrier($referencecourrier);

            $c_arrive_int->save();
            Doctrine_Query::create()
                    ->update('courrier')
                    ->set('datereponse', '?', date('d-m-Y'))
                    ->where('id=' . $idcourrier)
                    ->execute();
            $this->redirect('courrier/showcourrier?idcourrier=' . $c_arrive_int->getId() . '&idtab=1');
        }
        $this->redirect('courrier/index?idtype=' . $idtypecourrier);
    }

    //_____________________________Transfercourrier
    public function executeTransfercourrier(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $user = new Utilisateur();
        $user =  $this->getUser()->getAttribute('userB2m');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idcourrier'];
            $idaction = $params['id_action'];
            $id_dest = $params['id_dest'];
            $datemax = $params['datemax'];

            $exp = $user->getExpdestinataire();
            if ($idaction != "0" && $id_dest != "0") {



                //______________________________________________________________Creation courrier interieur
                $cour = Doctrine_Core::getTable('courrier')->findOneById($id);
                $recetiniste = Doctrine_Core::getTable('expdest')->findOneById($id_dest);

                $courrierTyb = new Courrier();


                $user_transfer = $recetiniste->getUser();

                $c_arrive_int = new Courrier();
                if ($user_transfer) {
                    $c_arrive_int->setIdUser($user_transfer->getId());
                    $c_arrive_int->setNumero($courrierTyb->getNumerocourrier($user_transfer->getId(), 1));
                    $c_arrive_int->setIdBureaux($user_transfer->getAgents()->getIdBureaux());
                    $c_arrive_int->setIdCourrier($id);
                    if ($cour->getTitre())
                        $c_arrive_int->setTitre($cour->getTitre());
                    if ($cour->getObject())
                        $c_arrive_int->setObject($cour->getObject());
                    if ($cour->getSujet())
                        $c_arrive_int->setSujet($cour->getSujet());
                    if ($cour->getDescription())
                        $c_arrive_int->setDescription($cour->getDescription());

                    $c_arrive_int->setIdMode($cour->getIdMode());
                    $c_arrive_int->setDatecreation(date('d-m-Y'));
                    $c_arrive_int->setIdType(1);
                    $referencecourrier = $cour->getTypecourrier()->getPrefix() . $cour->getNumero() . ' ' . $cour->getReferencecourrier();
                    $c_arrive_int->setReferencecourrier($referencecourrier);

                    $c_arrive_int->save();
                    Doctrine_Query::create()
                            ->update('courrier')
                            ->set('datereponse', '?', date('d-m-Y'))
                            ->where('id=' . $id)
                            ->execute();
                }
                $mvc = new Parcourcourier();
                $parcourcourrier = Doctrine_Core::getTable('parcourcourier')->findOneByIdCourierAndIdRecAndIdExpAndIdAction($id, $id_dest, $exp->getId(), $idaction);
                if ($parcourcourrier)
                    $mvc = $parcourcourrier;
                $coursource = Doctrine_Core::getTable('courrier')->findOneByIdCourrier($id);
                if ($coursource)
                    $mvc->setIdCourrierdest($coursource->getId());
                else
                    $mvc->setIdCourrierdest($id);
                $mvc->setIdCourier($id);
                $mvc->setIdAction($idaction);
                $mvc->setIdExp($exp->getId());
                $mvc->setIdRec($id_dest);
                $mvc->setDatecreation(date("d-m-Y"));
                if ($datemax != "00")
                    $mvc->setMdreponse($datemax);
                $mvc->setIdUser($user->getId());
                $mvc->save();
            }
            $query = "SELECT   CONCAT(exp.rs,' - ',exp.npresponsable) as ex,   actionparcour.action,   CONCAT(dest.rs,' - ',dest.npresponsable) as de,mdreponse as maxreponse "
                    . "FROM   expdest exp,   parcourcourier,   actionparcour,    expdest dest "
                    . "WHERE   parcourcourier.id_exp = exp.id "
                    . "AND   parcourcourier.id_action = actionparcour.id "
                    . "AND   parcourcourier.id_rec = dest.id "
                    . "and parcourcourier.id_courier=" . $id;

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();



            //die($q);
            $parcc = $conn->fetchAssoc($query);
            die(json_encode($parcc));
        }
        die('Erreur...');
    }

    public function executeReflichisement(sfWebRequest $request) {
        $user =  $this->getUser()->getAttribute('userB2m');
        header('Access-Control-Allow-Origin: *');

        $id_famille = 0;

        $rec = new Expdest();
        $expdest = Doctrine_Core::getTable('expdest')->findAll();
        foreach ($expdest as $expde) {
            $rec = $expde;
            if ($rec->getUser() && $rec->getUser()->getId() == $user->getId()) {

                if ($rec->getIdFamille())
                    $id_famille = $rec->getIdFamille();
            }
        }

        if ($id_famille != 0) {
            $query = "select "
                    . "concat(typecourrier.prefix,utilisateur.id,courrier.numero) as numero ,"
                    . "exp.npresponsable as nexp,concat(dest.npresponsable,' : ',agents.nomcomplet) as ndest, "
                    . " actionparcour.action,to_char(parcourcourier.mdreponse::timestamp without time zone - current_date::timestamp without time zone, 'dd') as diff_date"
                    . " from   expdest dest,   expdest exp,  courrier, agents,  parcourcourier,   utilisateur,   typecourrier,    actionparcour"
                    . " where courrier.datereponse is null and "
                    . "courrier.id_type = typecourrier.id "
                    . " AND   parcourcourier.id_rec = dest.id "
                    . "AND   parcourcourier.id_exp = exp.id "
                    . "AND   parcourcourier.id_action = actionparcour.id "
                    . "AND   parcourcourier.id_courrierdest = courrier.id    "
                    . "AND courrier.datereponse is null and agents.id=utilisateur.id_parent   "
                    . "and  dest.id_famille= " . $id_famille . " and utilisateur.id=" . $user->getId();
        } else {
            $query = "select concat(typecourrier.prefix,utilisateur.id,courrier.numero) as numero ,expdest.npresponsable,actionparcour.action,to_char(parcourcourier.mdreponse::timestamp without time zone - current_date::timestamp without time zone, 'dd') as diff_date"
                    . " from courrier,   utilisateur,  parcourcourier,  typecourrier,expdest,actionparcour"
                    . " where actionparcour.id=parcourcourier.id_action and "
                    . " expdest.id=parcourcourier.id_exp and  "
                    . " courrier.datereponse is null and courrier.id_user=" . $user->getId() . ""
                    . " AND courrier.id = parcourcourier.id_courrierdest"
                    . " AND   courrier.id_type = typecourrier.id "
                    . " AND   utilisateur.id = courrier.id_user  "
                    . "  order by courrier.id desc limit 5 ";
        }
        //die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeListetypepiece(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $q = Doctrine_Query::create()
                ->select("*")
                ->from('typepiece g');
        $typespieces = $q->fetchArray();
        die(json_encode($typespieces));
    }

    public function executeCourriersarrive(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $user = $request->getParameter('user');
        $q = Doctrine_Query::create()
                ->select("CONCAT('Numero:',prefix,utilisateur.id,numero,' Date:',datecreation,' Objet:',object,' Type:',type)  as object , courrier.id ")
                ->from('courrier ,typecourrier,utilisateur')
                ->where('id_user=' . $user)
                ->andwhere('courrier.id_type=typecourrier.id')
                ->andwhere('utilisateur.id=courrier.id_user')
                ->andwhere('id_type=1');
//die($q);
        $courriers = $q->fetchArray();

        die(json_encode($courriers));
    }

    public function executeCourriersdepart(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $user = $request->getParameter('user');
        $q = Doctrine_Query::create()
                ->select("CONCAT('Numero:',prefix,utilisateur.id,numero,' Date:',datecreation,' Objet:',object,' Type:',type) as object , courrier.id ")
                ->from('courrier ,typecourrier,utilisateur')
                ->where('id_user=' . $user)
                ->andwhere('courrier.id_type=typecourrier.id')
                ->andwhere('utilisateur.id=courrier.id_user')
                ->andwhere('id_type=2');

        $courriers = $q->fetchArray();

        die(json_encode($courriers));
    }

    public function executeCodebureaux(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $user = $request->getParameter('user');

        $q = Doctrine_Query::create()
                ->select("bureaux.id")
                ->from(' bureaux,  utilisateur,  agents, contrat ')
                ->where("utilisateur.id_parent = agents.id and contrat.id_agents=agents.id AND contrat.id_bureaux = bureaux.id and  utilisateur.id=" . $user);
        // die($q);
        $idburaux = $q->fetchArray();

        die(json_encode($idburaux));
    }

    public function executeAjoutpiecejoint(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $type = $params['type'];
            $object = $params['object'];
            $sujet = $params['sujet'];

            $piecejoint = new Piecejoint();


            $Exp = Doctrine_Core::getTable('piecejoint')->findOneByObjet($object);
            if ($Exp)
                $piecejoint = $Exp;

            $piecejoint->setObjet($object);
            $piecejoint->setSujet($sujet);
            $typep = new Typepiece();
            if ($type != "")
                $piecejoint->setIdTypepiece($type);
            $piecejoint->save();
            $q = Doctrine_Query::create()
                    ->select("piecejoint.objet as piece,  piecejoint.id")
                    ->from('piecejoint');

            $listespieces = $q->fetchArray();

            die(json_encode($listespieces));
        }
    }

    public function CreateDossier($url, $chaine) {
        $dossier = '/var/www/html/BmmErp/' . urldecode($url);
        if (!is_dir($dossier)) {
            mkdir($dossier);
        }
        copy(sfconfig::get('sf_appdir') . 'uploads/scanner/' . $chaine, $dossier . '/' . $chaine);
    }

    public function executeUploaderfile(sfWebRequest $request) {


        $id = $_REQUEST['idcourrier'];
        $uploads_dir = sfConfig::get('sf_upload') . $_FILES['fileSelected']['name'];
        move_uploaded_file($_FILES['fileSelected']['tmp_name'], $uploads_dir);
        $piece_joint = new Piecejoint();
        $piece_joint->setChemin($_FILES['fileSelected']['name']);
        $piece_joint->setIdCourrier($id);
        $piece_joint->save();
        die("Ajout  avec succès");
    }

    public function executeValiderattachement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idcourrier'];
            $chaine = $params['chaine'];
            $piecejoint = new Piecejoint();
            $courrier = Doctrine_Core::getTable('courrier')->findOneById($id);
            if ($courrier) {
                $piecejoint->setIdCourrier($id);
                $piecejoint->setObjet($courrier->getObject());
            }

            $piecejoint->setIdTypepiece(7);

            $piecejoint->setChemin($chaine);
            $piecejoint->save();
            $this->CreateDossier($courrier->getObject() . '_' . $courrier->getTitre(), $chaine);
            $q = Doctrine_Query::create()
                    ->select("piecejoint.objet as piece,  piecejoint.id")
                    ->from('piecejoint');

            $listespieces = $q->fetchArray();

            die(json_encode($listespieces));
        }
    }

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }


        $this->filters->setTableMethod($tableMethod);
        $filter = $this->getFilters();
        $user =  $this->getUser()->getAttribute('userB2m');

        $id_user = $user->getId();
        $query = $this->filters->buildQuery($this->getFilters());
        $id_famille = 0;

        $rec = new Expdest();
        $expdest = Doctrine_Core::getTable('expdest')->findAll();
        $id_famille = 0;
        $arrayUser = array();
        foreach ($expdest as $expde) {
            $rec = $expde;
            if ($rec->getUser() && $rec->getUser()->getId() == $user->getId()) {

                if ($rec->getIdFamille())
                    $id_famille = $rec->getIdFamille();
            }
        }
        if ($id_famille != 0) {
            $expdest = Doctrine_Core::getTable('expdest')->findByIdFamille($id_famille);
            $i = 0;
            foreach ($expdest as $expdesti) {
                if ($expdesti->getUser()) {
                    $arrayUser[$i] = $expdesti->getUser()->getId();
                    $i++;
                }
            }
        }


        if ($id_famille != 0 && count($arrayUser) > 0)
            $courriers = Doctrine_Core::getTable('courrier')
                    ->createQuery('a')
                    ->whereIn('id_user', $arrayUser);
        else
            $courriers = Doctrine_Core::getTable('courrier')
                    ->createQuery('a')
                    ->where('id_user=' . $id_user);
        // die($courriers);
        if (isset($filter['titre']) && $filter['titre']['text'] != "") {

            $courriers = $courriers->Andwhere("(titre like '%" . $filter['titre']['text'] . "%' or description like '%" . $filter['titre']['text'] . "%' )");
        }
        if (isset($filter['object']) && $filter['object']['text'] != "") {

            $courriers = $courriers->Andwhere("(object like '%" . $filter['object']['text'] . "%' or description like '%" . $filter['object']['text'] . "%' )");
        }

        // die($filter['datecreation']['from'] . 't');
        if (isset($filter['referencecourrier']) && $filter['referencecourrier']['text'] != "") {
            $courriers = $courriers->Andwhere("referencecourrier like '%" . $filter['referencecourrier']['text'] . "%'");
        }
        if (isset($filter['id_mode']) && $filter['id_mode'][0] != "") {
            $courriers = $courriers->Andwhere('id_mode=' . $filter['id_mode'][0]);
        }
        if (isset($filter['id_famille']) && $filter['id_famille'][0] != "") {
            $courriers = $courriers->Andwhere('id_famille=' . $filter['id_famille'][0]);
        }
        if (isset($filter['id_type']) && $filter['id_type'][0] != "" && !isset($_REQUEST['idtype'])) {
            $courriers = $courriers->Andwhere('id_type=' . $filter['id_type'][0]);
        }
        if (isset($_REQUEST['idtype'])) {
            $courriers = $courriers->Andwhere('id_type=' . $_REQUEST['idtype']);
        }

        if (isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
            $courriers = $courriers->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
            $courriers = $courriers->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        }
        if (isset($filter['datecreation']['from']) && !isset($filter['datecreation']['to'])) {
            $courriers = $courriers->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
        }
        if (!isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {

            $courriers = $courriers->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        }

        $query = $courriers->orderBy('id desc');
        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        return $query;
    }

    public function executeFilter(sfWebRequest $request) {
        $this->setPage(1);

        if ($request->hasParameter('_reset')) {
            $this->setFilters($this->configuration->getFilterDefaults());

            $this->redirect('@courrier');
        }

        $this->filters = $this->configuration->getFilterForm($this->getFilters());

        $this->filters->bind($request->getParameter($this->filters->getName()));
        if ($this->filters->isValid()) {
            $this->setFilters($this->filters->getValues());

            $this->redirect('@courrier');
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();

        $this->setTemplate('index');
    }

    //_________________________________________Function Numéro courrier
    public function executeNumerocourrier(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $idtype = $request->getParameter('idtype');
        //SELECT    FROM public.courrier   where id_type=2;
        $user = new Utilisateur();
        $user =  $this->getUser()->getAttribute('userB2m');
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $query = "SELECT COALESCE(MAX(numero)+1, (overlay(EXTRACT('YEAR' FROM current_date)::text placing ' ' from 1 for 2))::integer*10000+1) as numero "
                . "FROM courrier "
                . "WHERE id_type=" . $idtype . " and id_user=" . $user->getId();


        //die($q);
        $numeros = $conn->fetchAssoc($query);
        die(json_encode($numeros));
    }

    //_________________________________________Function affectation note
    public function executeAffectationnote(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idnote = $params['idnote'];
            $idcourrier = $params['idc'];
            $etat = $params['etat'];
            if ($etat > 0)
                Doctrine_Query::create()
                        ->update('courrier')
                        ->set('id_famille', '?', $idnote)
                        ->where('id=' . $idcourrier)
                        ->execute();
//            else{
//                Doctrine_Query::create()
//                    ->update('courrier')
//                    ->set("id_famille","?","-1")
//                    ->where('id=' . $idcourrier)
//                    ->execute();
//                die('Suppression effectuée avec succès');
//            }
            die('Mise à jour effectuée avec succès');
        }
        die('Erreur ...!!!');
    }

    //_________________________________________Function retourne la responsable expéditeur ou destinataire
    public function executeResponsable(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $user = new Utilisateur();
        $user =  $this->getUser()->getAttribute('userB2m');
        $expdest = $user->getExpdestinataire();
//        $q = Doctrine_Query::create()
//                ->select(" id, npresponsable")
//                ->from('expdest')
//                ->where('id=' . $expdest->getId());
//        $tiers=$q->fetchArray();
        die($expdest->getId() . '');
    }

    //_________________________________________Delete courrier
    public function executeDelete(sfWebRequest $request) {
        //$request->checkCSRFProtection();
//        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
//
//        if ($this->getRoute()->getObject()->delete()) {
//            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
//        }
//        $idtype=$request->getParameter('idtype');
//        $this->redirect('courrier/?idtype='.$idtype);
    }

    //_________________________________________Save courrier
    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $courrier = $form->save();

                //Creation une mouvement de courrier 
                $expdest = new Expdest();
                $user = new Utilisateur();
                $user =  $this->getUser()->getAttribute('userB2m');
                $expdest = $user->getExpdestinataire();

                $mouvementcourrier = Doctrine_Core::getTable('parcourcourier')->findOneByIdCourierAndIdRec($form->getObject()->getId(), $expdest->getId());

                if ($request->getParameter('courrier_expdest') && $request->getParameter('courrier_expdest') != "36") {


                    if ($form->getObject()->isNew() || !$mouvementcourrier) {

                        $mouvementC = new Parcourcourier();
                        $mouvementC->setDatecreation(date('d-m-Y'));
                        $mouvementC->setIdCourier($courrier->getId()); //_________courrier destination
                        $mouvementC->setIdExp($request->getParameter('courrier_expdest'));
                        if ($courrier->getIdCourrier())
                            $mouvementC->setIdCourrierdest($courrier->getIdCourrier()); //___________courier source
                        else
                            $mouvementC->setIdCourrierdest($courrier->getId());
                        //_________test si receptioniste exite dans la table exprecp....
                        $mouvementC->setIdRec($expdest->getId());
                        $mouvementC->setIdUser($courrier->getIdUser());
                        $mouvementC->setOrdredetransfer(1);
                        $mouvementC->save();
                    }
                    else
                    if ($mouvementcourrier) {
                        Doctrine_Query::create()
                                ->update('Parcourcourier l')
                                ->set('l.id_exp', '?', $request->getParameter('courrier_expdest'))
                                ->where('id=' . $mouvementcourrier->getId())
                                ->execute();
                    }
                } else {
                    if ($form->getObject()->isNew() || !$mouvementcourrier) {
                        $mouvementC = new Parcourcourier();
                        $mouvementC->setDatecreation(date('d-m-Y'));
                        $mouvementC->setIdCourier($courrier->getId());
                        $mouvementC->setIdExp($expdest->getId());
                        if ($courrier->getIdCourrier())
                            $mouvementC->setIdCourrierdest($courrier->getIdCourrier()); //___________courier source
                        else
                            $mouvementC->setIdCourrierdest($courrier->getId());
                        //_________test si receptioniste exite dans la table exprecp....
                        $mouvementC->setIdRec($expdest->getId());
                        $mouvementC->setIdUser($courrier->getIdUser());
                        $mouvementC->setOrdredetransfer(1);
                        $mouvementC->save();
                    }
                }
                $idexp = $request->getParameter('courrier_expdest');
            } catch (Doctrine_Validator_Exception $e) {

                $errorStack = $form->getObject()->getErrorStack();

                $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ? 's' : null) . " with validation errors: ";
                foreach ($errorStack as $field => $errors) {
                    $message .= "$field (" . implode(", ", $errors) . "), ";
                }
                $message = trim($message, ', ');

                $this->getUser()->setFlash('error', $message);
                return sfView::SUCCESS;
            }

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $courrier)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@courrier_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'courrier_edit', 'sf_subject' => $courrier));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }
   public function executeImprimercourrier(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $idcourrier = $request->getParameter('idcourrier');
        $courrier = Doctrine_Core::getTable('courrier')->findOneById($idcourrier);

        $idtype = $courrier->getIdType();
        $user = $courrier->getUtilisateur();
        if ($courrier->getIdUser()) {
            $expdest = $user->getExpdestinataire();
            $mvc = Doctrine_Core::getTable('parcourcourier')->findOneByIdCourrierdestAndIdRec($courrier->getId(), $expdest->getId());
            $parcourcou = Doctrine_Core::getTable('parcourcourier')->findByIdCourierAndIdExp($courrier->getId(), $expdest->getId());
        } else {
            $mvc = Doctrine_Core::getTable('parcourcourier')->findOneByIdCourrierdestAndIdFamexpdes($courrier->getId(), $courrier->getIdFamexpdes());
            $parcourcou = Doctrine_Core::getTable('parcourcourier')->findByIdCourierAndIdExp($courrier->getId(), $mvc->getIdExp());
        }
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Courrier N°:');
        $pdf->SetSubject("fiche courrier");

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

        // set some language dependent data:
//        $lg = Array();
//        $lg['a_meta_charset'] = 'UTF-8';
//       // $lg['a_meta_dir'] = 'rtl';
//        //$lg['a_meta_language'] = 'ar';
//        $lg['w_page'] = 'page';
//
//// set some language-dependent strings (optional)
//        $pdf->setLanguageArray($lg);
        $pdf->SetFont('dejavusans', '', 10, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        $html = $this->ReadHtmlCourrier($societe, $courrier, $mvc, $parcourcou);

//die($html);
        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('fichecourrier' . $courrier->getNumerocourrierstring() . $courrier->getId() . '.pdf', 'I');

//        $pdf->Output(sfconfig::get('sf_upload_dir') . '/merge/' . 'fichecourrier' . $courrier->getNumerocourrierstring() . $courrier->getId() . '.pdf', 'F');
//        $file = sfconfig::get('sf_upload_dir') . '/merge/' . 'fichecourrier' . $courrier->getNumerocourrierstring() . $courrier->getId() . '.pdf';
        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlCourrier($societe, $courrier, $mvc, $parcourcou) {
        $html = '<style>
    h3 {
        font-family: times;
        font-size: 12pt;
         text-align: center;
    }
    span {
        font-family: times;
        font-size: 10pt;
    }
    h6 {
        font-family: times;
        font-size: 9pt;
    }
    p.first {
        color: #003300;
        font-family: dejavusans;
        font-size: 12pt;
    }
    p{
        margin:  -2px;
    }
    p>span{
        color: #0066cc;
    }
    p.first span {
        color: #006600;
        font-style: italic;
    }
    p#second {
        color: rgb(00,63,127);
        font-family: times;
        font-size: 12pt;
        text-align: justify;
    }
    p#second > span {
        background-color: #FFFFAA;
    }
    table.first {
        color: #003300;
        font-family: dejavusans;
        font-size: 8pt;
        background-color: #ccffcc;
    }
    .tableclass{
        width: 750px;
        padding-left: 59%;
        margin-top: -6%;
    }
    .tableclass td {
        border: 2px solid #000;
    }
    td.second {
        /*border: 2px dashed green;*/
    }
    div.test {
        color: #CC0000;
        background-color: #FFFF66;
        font-family: dejavusans;
        font-size: 10pt;
        border-style: solid solid solid solid;
        border-width: 2px 2px 2px 2px;
        border-color: green #FF00FF blue red;
        text-align: center;
    }
    .lowercase {
        text-transform: lowercase;
    }
    .uppercase {
        text-transform: uppercase;
    }
    .capitalize {
        text-transform: capitalize;
    }
     .tableligne{
        padding: 1px;
        border: 1px solid #000;
    }
    .tableclass{
 border: 1px dashed #000000 ;
 padding: 5px;
}
.tableligne{
padding: 5px;
}
    .tableligne td{
      border: 1px solid #000;
      padding: 5px;
      text-align: center;
} 
 .tableclass  th{
      border: 1px solid #000;
      font-weight: bold;
      font-size: 9pt;
      text-align: center;
} 
.tableligne th{
      border: 1px solid #000;
      font-weight: bold;
      font-size: 9pt;
      text-align: center;
} 
.tableclass td{
      text-align: justify;
      border: 1px solid #000;
}
.contenue{
font-size: 9pt;
}
body{
border: 1px solid #000;
}
.secondtd{
 background-color: #fff;
}
.fersttd{
 background-color: #f6f8f4;
}
td{
padding: 2%;
}
</style>';
        $famille = "";
        if ($courrier->getIdFamille())
            $famille = $courrier->getFamillecourrier();
        $expiditeur = "";
        $action = "";
        if ($mvc) {
            $expiditeur = $mvc->getExpdest();
            $action = $mvc->getActionparcour();
        }

        $recepteur = '';
        if ($courrier->getIdUser() != null)
            $recepteur = $courrier->getUtilisateur() . $courrier->getBureaux();
        else
            $recepteur = $courrier->getFamexpdes();

        $html.='<div class="contenue">
                    <div class="titre"><h3>Courrier N°: ' . $courrier->getNumerocourrierstring() . ' </h3></div>
                    <div> 
                    <table style="width:100%;" class="tablecontenue">';
        if ($famille != "")
            $html.='<tr>
                        <td style="width:25%;font-weight:bold;"><span>Note du Courrier</span></td> 
                        <td style="width:5%;font-weight:bold;">:</td>
                        <td style="width:70%;" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $famille . '</p></td>
                    </tr>';

        $html.='<tr>
                    <td style="width:25%;font-weight:bold;"><span>Date de Création</span></td>
                    <td style="width:5%;font-weight:bold;">:</td>
                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . date('d/m/Y', strtotime($courrier->getDatecreation())) . '</p></td>
                </tr>
                <tr>
                    <td style="width:25%;font-weight:bold;"><span>Numéro</span></td>
                    <td style="width:5%;font-weight:bold;">:</td>
                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $courrier->getNumerocourrierstring() . '</p></td>
                </tr>
                <tr>
                    <td style="width:25%;font-weight:bold;"><span>Numéro Correspondance</span></td>
                    <td style="width:5%;font-weight:bold;">:</td>
                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $courrier->getNumeroseq() . '</p></td>
                </tr>
                 <tr>
                    <td style="width:25%;font-weight:bold;"><span>Type:</span></td>
                    <td style="width:5%;font-weight:bold;">:</td>
                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $courrier->getTypecourrier() . '</p></td>
                </tr>
                 <tr>
                    <td style="width:25%;font-weight:bold;"><span>Mode ENV.||REC.</span></td>
                    <td style="width:5%;font-weight:bold;">:</td>
                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $courrier->getModescourrier() . '</p></td>
                </tr>
                <tr>
                    <td style="width:25%;font-weight:bold;"><span>Type d\'envoie</span></td>
                    <td style="width:5%;font-weight:bold;">:</td>
                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $courrier->getTypeparamcourrier() . '</p></td>
                </tr>
                <tr>
                    <td style="width:25%;font-weight:bold;"><span>Référence Courrier</span></td>
                    <td style="width:5%;font-weight:bold;">:</td>
                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $courrier->getReferencecourrier() . '</p></td>
                </tr>
                <tr>
                    <td style="width:25%;font-weight:bold;"><span>Date Correspondance</span></td>
                    <td style="width:5%;font-weight:bold;">:</td>
                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . date('d/m/Y', strtotime($courrier->getDatecorespondanse())) . '</p></td>
                </tr>
                <tr>
                    <td style="width:25%;font-weight:bold;"><span>Expéditeur</span></td>
                    <td style="width:5%;font-weight:bold;">:</td>
                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $expiditeur . ': <span style="color:red">' . $action . ' ===>> </span>' . $recepteur . '</p>
                   </td>
                </tr>
                <tr>
                    <td style="width:25%;font-weight:bold;"><span>Titre</span></td>
                    <td style="width:5%;font-weight:bold;">:</td>
                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;" >' . $courrier->getTitre() . '</p></td>
                </tr>
                <tr>
                    <td style="width:25%;font-weight:bold;"><span>Objet</span></td>
                    <td style="width:5%;font-weight:bold;">:</td>
                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;" >' . $courrier->getObject() . '</p></td>
                </tr>
                <tr>
                    <td style="width:25%;font-weight:bold;"><span>Sujet</span></td>
                    <td style="width:5%;font-weight:bold;">:</td>
                    <td style="width:70%" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . $courrier->getSujet() . '</p></td>
                </tr>
                <tr>
                    <td style="width:25%;font-weight:bold;"><span>Description du courrier</span></td>
                    <td style="width:5%;font-weight:bold;">:</td>
                    <td style="width:70%; text-align:right; direction:rtl;" colspan="2"><p style="border-bottom: 1px dashed #000000;">' . trim(str_replace('p', 'div', str_replace('strong', 'b', $courrier->getDescription()))) . '</p></td>
                </tr>
            </table>
            </div>';

        $html.='<div class="tableligne">
                    <table cellpadding="3">
                        <tr style="background-color:#ECECEC">
                            <th style="height:25px;">Expédition</th>
                            <th>Destination</th>
                            <th>Action d\'envoie</th>
                        </tr>';

        $parcourcourriers = new Parcourcourier();
        foreach ($parcourcou as $par) {
            $parcourcourriers = $par;
            $reception = "";
            if ($parcourcourriers->getIdRec()) {
                $rec = Doctrine_Core::getTable('expdest')->findOneById($parcourcourriers->getIdRec());
                if ($rec)
                    $reception = $rec->getRtl();
            }
            $html.='<tr>
                        <td style="height:25px;"><p>' . $parcourcourriers->getExpdest() . '</p></td>
                        <td><p>' . $reception . '</p></td>
                        <td><p style="color:red">' . $parcourcourriers->getActionparcour() . '</p></td>
                    </tr>';
        }
        $html.='</table></div></div>';

        return $html;
    }

}
