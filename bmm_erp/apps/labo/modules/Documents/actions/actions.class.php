<?php

/**
 * Boncommandeexterne actions.
 *
 * @package    Bmm
 * @subpackage Boncommandeexterne
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentsActions extends sfActions
{

    public function executeIndex(sfWebRequest $request)
    {
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

    public function executeIndexfrs(sfWebRequest $request)
    {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;
        $user = $this->getUser()->getAttribute('userB2m');
        
        if ($user->getIdMagasin()) {
           $labo = $user->getLaboName();
          $id_emplacemnt = $labo->getId();
            
        }
        $this->form = new DocumentachatFormFilter();
        $idtype = 7;
        if ($request->getParameter('idtype')) {
            $idtype = $request->getParameter('idtype');
        }

        $this->idtype = $idtype;
        $this->type = Doctrine_Core::getTable('typedoc')->findOneById($this->idtype);
       
        $this->boncommandeexterne = Doctrine_Core::getTable('documentachat')
            ->createQuery('a')
          //  ->leftJoin('a.Lignedocachat lg')
          //  ->leftJoin('lg.Qtelignedoc qte')
            ->where('a.id_typedoc=' . $idtype)
            ->andwhere(' a.id_emplacement= ' . $id_emplacemnt);
        
        $this->datedebut = "";
        $this->datefin = "";
        $this->idfrs = "";
        $year = date('Y');
        if ($request->getParameter('debut') && $request->getParameter('debut') != "") {
            $this->datedebut = $request->getParameter('debut');
            $this->boncommandeexterne = $this->boncommandeexterne
                ->Andwhere("datecreation>='" . $request->getParameter('debut') . "'");
        }
        if ($request->getParameter('fin') && $request->getParameter('fin') != "") {
            $this->datefin = $request->getParameter('fin');
            $this->boncommandeexterne = $this->boncommandeexterne
                ->Andwhere("datecreation<='" . $request->getParameter('fin') . "'");
        }
        if ($request->getParameter('fin') && $request->getParameter('debut')) {
            $this->datefin = $request->getParameter('fin');
            $this->datedebut = $request->getParameter('debut');
            $this->boncommandeexterne = $this->boncommandeexterne
                ->Andwhere("datecreation>='" . $request->getParameter('debut') . "'")
                ->Andwhere("datecreation<='" . $request->getParameter('fin') . "'");
        }
        if (!$request->getParameter('fin') && $request->getParameter('fin') == "" && !$request->getParameter('debut') && $request->getParameter('debut') == "") {

            $this->boncommandeexterne = $this->boncommandeexterne
                ->andWhere("datecreation >= '" . $year . "-01-01'")
                ->andWhere("datecreation <= '" . $year . "-12-31'");
        }
        if ($request->getParameter('idfrs') && $request->getParameter('idfrs') != "") {
            $this->idfrs = $request->getParameter('idfrs');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_frs=" . $request->getParameter('idfrs'));
        }
        //die($this->boncommandeexterne);
        $this->boncommandeexterne = $this->boncommandeexterne->orderBy('id desc')->execute();
    }
    public function executeArticlebycodeanddesignationLabo(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_naturedoc = $params['id_naturedoc'];
            $codearticle = $params['codearticle'];
            $is_stockable = $params['is_stockable'];
            $is_patrimoine = $params['is_patrimoine'];
            $is_service = $params['is_service'];
            //  $id_type = $params['id_type'];
            $id_emplacement = $params['id_emplacement'];
            $designation = strtoupper($params['designation']);
            if ($id_naturedoc == 2) {
                $q = Doctrine_Query::create();
                // ->select(" article.id,article.codeart as ref
                // ,trim( both '  ' from article.designation) as name")
                // ->from('article');
                  if (!$is_stockable) {
                     $q = $q->select("distinct( designationarticle) as name,
                     lignedocachat.codearticle as ref")
               ->from('Lignedocachat')
                ->innerJoin('Documentachat
                 on Lignedocachat.id_doc=Documentachat.id')
                ->Where('Documentachat.id_naturedoc = 2 ')
                    ->Where("
                    (id_articlestock is not  null
                    or (id_articlestock is null
                    and ( Lignedocachat.is_sps = 'is_service'
                    or Lignedocachat.is_sps = 'is_patrimoine'  )))")
                    ->GroupBy('name,ref');
                 }else{
                   $q=$q->select(" article.id,article.codeart as ref,trim( both '  ' from article.designation) as name")
                        ->from('article')->AndWhere('article.id_emplacement is  null');
                 }
                    
                  //  ->distinct('name')
                    ;
                //->GroupBy('designationarticle,lignedocachat.codearticle,Lignedocachat.is_sps');
                //die($q);

                if ($is_patrimoine) {
                    $q = $q->AndWhere("Lignedocachat.is_sps='is_patrimoine' ");
                }
                if ($is_service) {
                    $q = $q->AndWhere("Lignedocachat.is_sps='is_service' ");
                }
                $designation = str_replace("'", "''", $designation);
                if ($codearticle != "" && $designation == "") {
                    $q = $q->where("codearticle like '%" . $codearticle . "%'");
                }
                if ($codearticle == "" && $designation != "") {
                    if (!$is_stockable ) 
                    $q = $q->Where("upper(designationarticle) like '%" . strtoupper($designation) . "%'");
                    else
                    $q = $q->Where("upper(designation) like '%" . strtoupper($designation) . "%'");
                }
                if ($codearticle != "" && $designation != "") {
                     if (!$is_stockable ) 
                    $q = $q->Where("upper(designationarticle) like '%" . strtoupper($designation) . "%'")
                        ->AndWhere("codearticle like '%" . $codearticle . "%'");
                        else
                         $q = $q->Where("upper(designation) like '%" . strtoupper($designation) . "%'")
                        ->AndWhere("codearticle like '%" . $codearticle . "%'");
                }
                // if (!$is_stockable) {
                //     $q = $q->AndWhere('lignedocachat.id_emplacement is  null');
                // }

                // if ($user->getIsAdmin()) {
                //     $labo = $user->getAdministartionSite();
                //     $q = $q->AndWhere('id_emplacement=' . $labo->getId());
                // }
            } else if ($id_naturedoc == 6) {
                $user = $this->getUser()->getAttribute('userB2m');
                $q = Doctrine_Query::create()
                    ->select(" article.id,article.codeart as ref,trim( both '  ' from article.designation) as name")
                    ->from('article')
                    ->Where('id_emplacement is  null');
                $designation = str_replace("'", "''", $designation);
                if ($codearticle != "" && $designation == "") {
                    $q = $q->AndWhere("codeart like '%" . $codearticle . "%'");
                }

                if ($codearticle == "" && $designation != "") {
                    $q = $q->AndWhere("upper(designation) like '%" . $designation . "%'");
                }

                if ($codearticle != "" && $designation != "") {
                    $q = $q->AndWhere("upper(designation) like '%" . $designation . "%'")
                        ->AndWhere("codeart like '%" . $codearticle . "%'");
                }
                // $labo = $user->getAdministartionSite();
                // if ($labo)
                //     $q = $q->AndWhere('id_emplacement=' . $labo->getId())
                //         ->AndWhere('id_emplacement is not null');
            } else if ($id_naturedoc == 1) {
                $user = $this->getUser()->getAttribute('userB2m');
                $q = Doctrine_Query::create()
                    ->select(" article.id,article.codeart as ref,
                    trim( both '  ' from article.designation) as name")
                    ->from('article');
                $designation = str_replace("'", "''", $designation);
                if ($codearticle != "" && $designation == "") {
                    $q = $q->AndWhere("codeart like '%" . $codearticle . "%'");
                }

                if ($codearticle == "" && $designation != "") {
                    $q = $q->AndWhere("upper(designation) like '%" . $designation . "%'");
                }
                if ($codearticle != "" && $designation != "") {
                    $q = $q->AndWhere("upper(designation) like '%" . $designation . "%'")
                        ->AndWhere("codeart like '%" . $codearticle . "%'");
                }
                $q = $q->AndWhere("id_emplacement is not null");
            }
            else if ($id_naturedoc == 7) {
                $user = $this->getUser()->getAttribute('userB2m');
                $q = Doctrine_Query::create()
                    ->select(" immobilisation.id,immobilisation.reference as ref,
                    trim( both '  ' from immobilisation.designation) as name")
                    ->from('immobilisation');
                $designation = str_replace("'", "''", $designation);
                if ($codearticle != "" && $designation == "") {
                    $q = $q->AndWhere("reference like '%" . $codearticle . "%'");
                }

                if ($codearticle == "" && $designation != "") {
                    $q = $q->AndWhere("upper(designation) like '%" . $designation . "%'");
                }
                if ($codearticle != "" && $designation != "") {
                    $q = $q->AndWhere("upper(designation) like '%" . $designation . "%'")
                        ->AndWhere("codeart like '%" . $codearticle . "%'");
                }
                $q = $q->AndWhere("id_etage is not null");
            }  
            else {
                $q = Doctrine_Query::create()
                    ->select("lignedocachat.id,lignedocachat.codearticle as ref,
                    trim( both '  ' from lignedocachat.designationarticle) as name")
                    ->from('Lignedocachat')
                    ->innerJoin('Documentachat on Lignedocachat.id_doc=Documentachat.id')
                    ->Where('id_articlestock is  null')
                    ->andWhere('id_naturedoc not in (1,2,6)');
            }          
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listesarticles = $conn->fetchAssoc($q);
            //  $listesarticles = $q->fetchArray();
            die(json_encode($listesarticles));
        }
        die('bien');
    }

    public function executeGetListedemandebciAnnuler(sfWebRequest $request)
    {
        $user = $this->getUser()->getAttribute('userB2m');

        if ($user->getIdMagasin()) {
            $ids = json_decode($user->getIdMagasin());
        }

        $query = "select documentachat.id as id,
        LPAD(documentachat.numero::text, 7, '0') as numero"
            . " from documentachat  "
            . " where documentachat.id_typedoc= 4"
            . " and documentachat.id_etatdoc = 97";
        if ($ids) {
            $query .= " and   documentachat.id_emplacement IN (" . implode(',', array_map('intval', $ids)) . ") ";
        }
        // (". $arrayMagasin .")"
        $query .= " order by documentachat.id desc ";
        // ->andwhere(' a.id_emplacement= ' . $idmagasins);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }
    public function executeGetListedemandeapproviosionementAnnuler(sfWebRequest $request)
    {
        $query = "select documentachat.id as id,
        LPAD(documentachat.numero::text, 7, '0') as numero"
            . " from documentachat  "
            . " where documentachat.id_typedoc= 23"
            . " and documentachat.id_etatdoc = 88"
            . " order by documentachat.id desc ";
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }
    public function executeIndexfrsbceregroupe(sfWebRequest $request)
    {
        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;
        $user = $this->getUser()->getAttribute('userB2m');
        $magasins = EtageTable::getInstance()->getByadmin();
        $array_code = array();
        $i = 0;
        foreach ($magasins as $j_i) {
            $array_code[$i] = $j_i->getId();
            $i++;
        }
        $arrayMagasin = [];
        $idmagasins = [];
        if ($user->getIdMagasin()) {
            $arrayMagasin = json_decode($user->getIdMagasin());
            for ($i = 0; $i <= sizeof($arrayMagasin) - 1; $i++):
                if (in_array($arrayMagasin[$i], $array_code)):
                    if (sizeof($idmagasins) == 0) {
                        $idmagasins = $arrayMagasin[$i];
                    } else {
                        $idmagasins = $idmagasins . ',,' . $arrayMagasin[$i];
                    }

                endif;
            endfor;
        }
        $this->form = new DocumentachatFormFilter();
        $idtype = 7;
        if ($request->getParameter('idtype')) {
            $idtype = $request->getParameter('idtype');
        }

        if ($request->getParameter('type')) {
            $type_regroupe = $request->getParameter('type');
        }

        $this->idtype = $idtype;
        $this->type = Doctrine_Core::getTable('typedoc')->findOneById($this->idtype);
        // donner les document de type bon commnade externe ou bdc et non transferer
        $query = "SELECT  documentachat.id  "
            . "FROM  documentachat, lignedocachat, qtelignedoc "
            . "WHERE qtelignedoc.id_lignedocachat = lignedocachat.id "
            . "and documentachat.id=lignedocachat.id_doc "
            . "and documentachat.id_typedoc= " . $idtype;
        //die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $listesdocs = $conn->fetchArray($query);
        // die(json_encode($listesdocs));
        $this->boncommandeexterne = Doctrine_Core::getTable('documentachat')
            ->createQuery('a')
            ->leftJoin('a.Lignedocachat lg')
            ->leftJoin('lg.Qtelignedoc qte')
            ->where('a.id_typedoc=' . $idtype)
            ->andwhere(' a.id_emplacement= ' . $idmagasins);
        $this->datedebut = "";
        $this->datefin = "";
        $this->idfrs = "";
        $year = date('Y');
        if ($request->getParameter('debut') && $request->getParameter('debut') != "") {
            $this->datedebut = $request->getParameter('debut');
            $this->boncommandeexterne = $this->boncommandeexterne
                ->Andwhere("datecreation>='" . $request->getParameter('debut') . "'");
        }
        if ($request->getParameter('fin') && $request->getParameter('fin') != "") {
            $this->datefin = $request->getParameter('fin');
            $this->boncommandeexterne = $this->boncommandeexterne
                ->Andwhere("datecreation<='" . $request->getParameter('fin') . "'");
        }
        if ($request->getParameter('fin') && $request->getParameter('debut')) {
            $this->datefin = $request->getParameter('fin');
            $this->datedebut = $request->getParameter('debut');
            $this->boncommandeexterne = $this->boncommandeexterne
                ->Andwhere("datecreation>='" . $request->getParameter('debut') . "'")
                ->Andwhere("datecreation<='" . $request->getParameter('fin') . "'");
        }
        if (!$request->getParameter('fin') && $request->getParameter('fin') == "" && !$request->getParameter('debut') && $request->getParameter('debut') == "") {

            $this->boncommandeexterne = $this->boncommandeexterne
                ->andWhere("datecreation >= '" . $year . "-01-01'")
                ->andWhere("datecreation <= '" . $year . "-12-31'");
        }
        if ($request->getParameter('idfrs') && $request->getParameter('idfrs') != "") {
            $this->idfrs = $request->getParameter('idfrs');
            $this->boncommandeexterne = $this->boncommandeexterne->Andwhere("id_frs=" . $request->getParameter('idfrs'));
        }
        // die($this->boncommandeexterne);
        $this->boncommandeexterne = $this->boncommandeexterne->orderBy('id desc')->execute();
    }
    //____________________________________________________________________________indexdemandeur
    public function executeIndexdemandeur(sfWebRequest $request)
    {

        $user = $this->getUser()->getAttribute('userB2m');
        $magasins = EtageTable::getInstance()->getByadmin();
        $array_code = array();
        $i = 0;
        foreach ($magasins as $j_i) {
            $array_code[$i] = $j_i->getId();
            $i++;
        }

        if ($user) {
            $ids = json_decode($user->getIdMagasin());

        }

        $this->texte = "";
        $this->id = "";
        $this->documentachat = null;

        $this->form = new DocumentachatFormFilter();
        $idtype = 4;
        if ($request->getParameter('idtype')) {
            $idtype = $request->getParameter('idtype');
        }

        $this->idtype = $idtype;

        $this->boncommandeexterne = Doctrine_Core::getTable('documentachat')
            ->createQuery('a')
            ->leftJoin('a.Documentachat doc')
            ->where('id_typedoc=' . $idtype)
            ->andWhere('id_naturedoc=6')
            ->andWhere('id_etatdoc=92')
        // ->Andwhere(' a.id  not in
        // (select doc.id_docparent from documentachat
        // where doc.id_typedoc != 6 and
        // doc.id_docparent is not null
        // and doc.id_docparent=a.id )')
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
        if ($ids) {
            $this->boncommandeexterne = $this->boncommandeexterne->AndwhereIn("id_emplacement", $ids);
        }

        $this->boncommandeexterne = $this->boncommandeexterne->execute();
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
    }

    public function executeDetail(sfWebRequest $request)
    {
        $this->documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->documentachat);
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new documentachatForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new documentachatForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id'))), sprintf('Object documentachat does not exist (%s).', $request->getParameter('id')));
        $this->form = new documentachatForm($documentachat);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id'))), sprintf('Object documentachat does not exist (%s).', $request->getParameter('id')));
        $this->form = new documentachatForm($documentachat);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($documentachat = Doctrine_Core::getTable('documentachat')->find(array($request->getParameter('id'))), sprintf('Object documentachat does not exist (%s).', $request->getParameter('id')));
        $documentachat->delete();

        $this->redirect('Boncommandeexterne/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $documentachat = $form->save();

            $this->redirect('Boncommandeexterne/edit?id=' . $documentachat->getId());
        }
    }

    //___________________________________________________________________________Detail ligne doc Detail demande de prix
    public function executeDetaildemandedeprix(sfWebRequest $request)
    {
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
        //
        //die($documentachat->getIdTypedoc().'gg');
        //die($html);
        if ($documentachat->getIdTypedoc() == 10) {
            $html = $this->ReadHtmlBonEntrer($societe, $documentachat, $listesdocuments);
        }

        if ($documentachat->getIdTypedoc() == 11) {
            $html = $this->ReadHtmlBonSortie($societe, $documentachat, $listesdocuments);
        }

        if ($documentachat->getIdTypedoc() == 13) {
            $html = $this->ReadHtmlBonTransfert($societe, $documentachat, $listesdocuments);
        }

        if ($documentachat->getIdTypedoc() == 12) {
            $html = $this->ReadHtmlBonRetour($societe, $documentachat, $listesdocuments);
        }

        if ($documentachat->getIdTypedoc() == 14) {
            $html = $this->ReadHtmlAvoir($societe, $documentachat, $listesdocuments);
        }

        if ($documentachat->getIdTypedoc() == 15) {
            $html = $this->ReadHtmlFacture($societe, $documentachat, $listesdocuments);
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

    public function ReadHtmlBonEntrer($societe, $documentachat, $listesdocuments)
    {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBonEntree();
        //die($html);
        return $html;
    }

    public function ReadHtmlFacture($societe, $documentachat, $listesdocuments)
    {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlFactureImression();
        //die($html);
        return $html;
    }

    public function ReadHtmlAvoir($societe, $documentachat, $listesdocuments)
    {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlAvoir();
        //die($html);
        return $html;
    }

    public function ReadHtmlBonSortie($societe, $documentachat, $listesdocuments)
    {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBonSortie();
        //die($html);
        return $html;
    }

    public function ReadHtmlBonTransfert($societe, $documentachat, $listesdocuments)
    {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBonTransfert();
        //die($html);
        return $html;
    }

    public function ReadHtmlBonRetour($societe, $documentachat, $listesdocuments)
    {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBonRetour();
        //die($html);
        return $html;
    }

    public function executeImprimerdemandedachat(sfWebRequest $request)
    {
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
        $logo = PDF_HEADER_LOGO . '/' . $societe->getLogo();
        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, $entete, $rs, '', '');
        //        $pdf->SetHeaderData(PDF_HEADER_LOGO, '', strtoupper($entete), $soc->getAdresse());
        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        //        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
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

    public function ReadHtmlDemandePrix($societe, $documentachat, $listesdocuments)
    {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->getHtmlDemandedeprix();
        //die($html);
        return $html;
    }

    public function executeImprimerbondeponse(sfWebRequest $request)
    {
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
        $logo = PDF_HEADER_LOGO . '/' . $societe->getLogo();
        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, $entete, $rs, '', '');
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

    public function ReadHtmlBondeponse($societe, $documentachat, $listesdocuments)
    {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBondeponse();
        //die($html);
        return $html;
    }

    public function executeImprimerbonexterne(sfWebRequest $request)
    {
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
        $logo = PDF_HEADER_LOGO . '/' . $societe->getLogo();
        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, $entete, $rs, '', '');
        //        $pdf->SetHeaderData(PDF_HEADER_LOGO, '', strtoupper($entete), $soc->getAdresse());
        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setPrintFooter(true);
        $foter = $soc->getTel();
        $adr = $soc->getAdresse();
        $pdf->setFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($foter), strtoupper($adr), '', '');
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

    public function ReadHtmlBonexterne($documentachat)
    {
        $html = StyleCssHeader::header1();
        $html .= $documentachat->ReadHtmlBonexterne();
        //die($html);
        return $html;
    }

    public function executeImprimerlistepvreception(sfWebRequest $request)
    {
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
        $logo = PDF_HEADER_LOGO . '/' . $societe->getLogo();
        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, $entete, $rs, '', '');

        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($societe), PDF_HEADER_STRING);
        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        //        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(7, 30, 7);
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
        //die('test=' . $request->getParameter('idtype'));

        $html = $this->ReadHtmlListesDocument($request);

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

    public function ReadHtmlListesDocument(sfWebRequest $request)
    {
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

        $html .= '<div class="titre"><h3 style="font-size:22px;">' . $typedoc . '</h3></div>&nbsp;<br>
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

        $html .= '<div class="tableligne">
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
            if ($aviss) {
                $avisss = $aviss->getAvis();
            }

            $etat = "";
            if ($doc->getIdEtatdoc()) {
                $etatdoc = Doctrine_Core::getTable('etatdocument')->findOneById($doc->getIdEtatdoc());
                if ($etatdoc) {
                    $etat = $etatdoc;
                }

            }
            $html .= '<tr>
                        <td><p>' . $doc->getNumerodocachat() . '</p></td>'
            . '<td><p>' . date('d/m/Y', strtotime($doc->getDatecreation())) . '</p></td>';
            if ($doc->getDocumentparent()) {
                $html .= '<td><p>' . $doc->getDocumentparent() . '<br>' . $doc->getDocumentparent()->getTiersPrint() . '</p></td>';
            } else {
                $html .= '<td></td>';
            }

            $html .= '<td><p>' . $etat . '</p></td>
                    <td style="text-align:right;">' . number_format($doc->getMntttc(), 3, '.', ' ') . '</td>
                </tr>';
        }
        $html .= '</table></div>';

        return $html;
    }
}
