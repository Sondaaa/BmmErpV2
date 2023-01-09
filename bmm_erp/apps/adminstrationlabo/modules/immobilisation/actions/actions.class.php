<?php

require_once dirname(__FILE__) . '/../lib/immobilisationGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/immobilisationGeneratorHelper.class.php';

/**
 * immobilisation actions.
 *
 * @package    Bmm
 * @subpackage immobilisation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class immobilisationActions extends autoImmobilisationActions
{
    public function executeImprimercb(sfWebRequest $request)
    {
        $this->bur = -1;

        if ($request->getParameter('bur')) {
            $this->bur = $request->getParameter('bur');
            $this->immobilisations = ImmobilisationTable::getInstance()->findByIdBureaux($request->getParameter('bur'));
        }

        $this->bureaux = BureauxTable::getInstance()->findByLaboUser();
    }

    public function executeImprimercode(sfWebRequest $request)
    {
        $bur = -1;
        if ($request->getParameter('tous')) {

            $bur = $request->getParameter('bur');
            $immobilisations = Doctrine_Core::getTable('immobilisation')->findByIdBureaux($request->getParameter('bur'));
            return $this->renderPartial('immobilisation/impressiontous', array('immobilisations' => $immobilisations, 'bur' => $bur));
        }

        if ($request->getParameter('bur')) {
            $bur = $request->getParameter('bur');
            $immobilisations = Doctrine_Core::getTable('immobilisation')->findByIdBureaux($request->getParameter('bur'));
        }
        return $this->renderPartial('immobilisation/impression', array('immobilisations' => $immobilisations, 'bur' => $bur));
    }
    public function executeShow(sfWebRequest $request)
    {
        $this->immobilisation = Doctrine_Core::getTable('immobilisation')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->immobilisation);
        if ($request->getParameter('page')) {
            return $this->renderPartial('Immob/impression', array('immobilisation' => $this->immobilisation));
        }
    }
    public function executeListeType(sfWebRequest $request)
    {
    }
    public function executeGetByTypeAffectation(sfWebRequest $request)
    {
        $this->id = $request->getParameter('id');
    }
    protected function buildQuery($idcategorie = 0)
    {
        $labo_id_projet = [];
        $user = $this->getUser()->getAttribute('userB2m');
        $user = UtilisateurTable::getInstance()->find($this->getUser()->getAttribute('userB2m')->getId());
        if ($user->getIdMagasin() || $user->getIdLabo()) {
            $labo_id = json_decode($user->getIdLabo());
            if (!$labo_id) {
                $labo_id = json_decode($user->getIdMagasin());
            }
        }

        if ($user->getIdProjet() && $user->getIsChefprojet() == true) {
            $projet_ids = json_decode($user->getIdProjet());

            foreach ($projet_ids as $id_pro) {
                $projet = ProjetTable::getInstance()->find($id_pro);
                array_push($labo_id_projet, $projet->getIdSoussite());
            }
        }
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);
        $filter = $this->getFilters();
        $query = $this->filters->buildQuery($this->getFilters());
        //if ($filter && $idcategorie == 0) {
        $etat = $filter['etat'];
        $id_bureau = $filter['id_bureaux'];
        $deseignation = $filter['designation']['text'];
        $id_agent = $filter['id_agent'];
        $dateac = $filter['dateacquisition']['text'];
        $compte = $filter['comptecomptabel']['text'];
        $id_site = $filter['id_site'];
        $id_etage = $filter['id_etage'];
        $id_categorie = $filter['id_categorie'];
        $id_famille = $filter['id_famille'];
        $id_sousfamille = $filter['id_sousfamille'];
        $immobilisation = Doctrine_Core::getTable('immobilisation')
            ->createQuery('a');
        if ($user->getIdLabo() && $labo_id) {
            $immobilisation = $immobilisation->whereIn('id_etage ', $labo_id);
        }

        if ($user->getIdProjet() && $labo_id_projet && !$labo_id) {
            $immobilisation = $immobilisation->where('id_etage IN (' . implode(',', array_map('intval', $labo_id_projet)) . ')');

        }

        if ($etat) {
            $immobilisation = $immobilisation->andWhere("trim(etat)='" . $etat . "'");
        }
        if ($dateac != "") {
            $immobilisation = $immobilisation->andWhere("dateacquisition::text like '%" . $dateac . "%'");
        }
        if ($compte != "") {
            $immobilisation = $immobilisation->andWhere("comptecomptabel in(SELECT id FROM compte where compte.comptecomptable='" . $compte . "')");
        }
        if ($id_agent != "") {
            $immobilisation = $immobilisation->andWhere('id_agent=' . $id_agent);
        }
        if ($id_bureau != "") {
            $immobilisation = $immobilisation->AndWhere('id_bureaux=' . $id_bureau);
        }
        if ($id_sousfamille != "") {
            $immobilisation = $immobilisation->AndWhere('id_sousfamille=' . $id_sousfamille);
        }
        if ($id_famille != "") {
            $immobilisation = $immobilisation->AndWhere('id_famille=' . $id_famille);
        }
        if ($id_categorie != "") {
            $immobilisation = $immobilisation->AndWhere('id_categorie=' . $id_categorie);
        }
        if ($id_etage != "") {
            $immobilisation = $immobilisation->AndWhere('id_etage=' . $id_etage);
        }
        if ($id_site != "") {
            $immobilisation = $immobilisation->AndWhere('id_site=' . $id_site);
        }
        if ($deseignation != "") {
            if (strpos($deseignation, "'") > 0) {
                $deseignation = str_replace("'", "''", $deseignation);
            }

            $immobilisation = $immobilisation->AndWhere("UPPER(designation) like '%" . strtoupper($deseignation) . "%'");
        }

        $query = $immobilisation->orderBy('datemisajour desc');

        if ($idcategorie != 0) {
            $query->where('id_categorie=' . $idcategorie);
        }
        $this->addSortQuery($query->orderBy('id desc'));
        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();
        return $query;
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->immobilisation = Doctrine_Core::getTable('immobilisation')->findOneById($request->getParameter('id'));
        $this->form = $this->configuration->getForm($this->immobilisation);
        $check = "off";
        if ($request->getParameter('check')) {
            $check = $request->getParameter('check');
        }

        $this->processForm($request, $this->form, $check);

        $this->setTemplate('edit');
    }

    protected function processForm(sfWebRequest $request, sfForm $form, $check = "off")
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
            $trouve = 0;
            $reference = $form['refcodeabarre']->getValue();

            $immobilisation = Doctrine_Core::getTable('immobilisation')->findOneByRefcodeabarre($reference);
            if ($immobilisation) {
                $immobilisation = "Code d'immobilisation Existe Déja";
                $trouve = 1;
            }
            try {
                if ($trouve == 0) {
                    // die('kkk'.$form['datemiseenservice']->render(array('value'=>'null')));
                    // if ($request->getParameter($form->getName())['datemiseenservice'] == '')
                    // $form['datemiseenservice']['text']=null;
                    // if ($request->getParameter($form->getName())['datemiseenrebut'] == '')
                    // $form['datemiseenrebut']['text']=null;
                    // if ($request->getParameter($form->getName())['datemisajour'] == '')
                    // $form['datemisajour']['text']=null;
                    // die($form['datemisajour']['text']);
                    $immobilisation = $form->save();
                    $immo = new Immobilisation();
                    // die('ok');
                    if ($check == "on") {
                        $immo = $immobilisation;

                        $emplacement = Doctrine_Core::getTable('emplacement')->findOneByIdImmoAndIdBureau($immo->getId(), $immo->getIdBureaux());
                        if (!$emplacement && ($immo->getIdBureaux() || $immo->getIdEtage() || $immo->getIdSite())) {
                            $empl = new Emplacement();
                            $empl->setIdImmo($immo->getId());
                            $empl->setDateaffectation(date("Y-m-d"));
                            $empl->setIdSite($immo->getIdSite());
                            $empl->setIdEtage($immo->getIdEtage());
                            $empl->setIdUser($immo->getIdAgent());
                            $empl->setAdresse("Affectation");
                            $empl->setIdBureau($immo->getIdBureaux());
                            $codeemplacement = '';
                            if ($immo->getIdBureaux()) {
                                $bureaux = BureauxTable::getInstance()->findOneByBureau($immo->getIdBureaux());
                                if ($bureaux) {
                                    $codeemplacement = $bureaux->getCode() . '' . sprintf('%04d', $immo->getNumero());
                                }
                            } elseif (!$immo->getIdBureaux() && $immo->getIdEtage()) {
                                $soussiteTabe = EtageTable::getInstance()->findOneByEtage($immo->getIdEtage());
                                if ($soussiteTabe) {
                                    $codeemplacement = $soussiteTabe->getCode() . '' . sprintf('%08d', $immo->getNumero());
                                }
                            } elseif (!$immo->getIdBureaux() && !$immo->getIdEtage() && $immo->getIdSite()) {
                                $siteTable = SiteTable::getInstance()->findOneBySite($immo->getIdSite());
                                if ($siteTable) {
                                    $codeemplacement = $siteTable->getCode() . '' . sprintf('%010d', $immo->getNumero());
                                }
                            }
                            $empl->setReference($codeemplacement);
                            $empl->save();
                        }
                    }
                    //____________________________mis a jour fichier batrimoine
                    $datemiasajour = date("Y-m-d");
                    $immobilisation->setDatemisajour($datemiasajour);
                    $immobilisation->save();
                } else {
                    $this->getUser()->setFlash('notice', $notice);
                    return sfView::SUCCESS;
                }
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $immobilisation)));

            //            if ($request->hasParameter('_save_and_add')) {
            //                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');
            //
            //                $this->redirect('@immobilisation_new');
            //            } else {
            //                $this->getUser()->setFlash('notice', $notice);
            //
            //                $this->redirect(array('sf_route' => 'immobilisation_edit', 'sf_subject' => $immobilisation));
            //            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    public function executeStatistique(sfWebRequest $request)
    {
        $this->stat = "";
        if ($request->getParameter('categorie')) {
            $this->categories = Doctrine_Core::getTable('categoerie')->findAll();
            $this->stat = "cat";
        }
        if ($request->getParameter('famille')) {
            $this->categories = Doctrine_Core::getTable('categoerie')->findAll();

            $this->stat = "fam";
        }
        //famillegeneral
        if ($request->getParameter('famillegeneral')) {
            $this->typefamilles = Doctrine_Core::getTable('typefamille')->findAll();
            $this->id_type = "-1";
            $this->id_famille = -1;
            if ($request->getParameter('idtype')) {
                $this->typefamilles = Doctrine_Core::getTable('typefamille')->findById($request->getParameter('idtype'));
                $this->famillestypes = Doctrine_Core::getTable('famille')->findByIdTypefamille($request->getParameter('idtype'));
                $this->id_type = $request->getParameter('idtype');
                $this->id_famille = $request->getParameter('idfamille');
            }
            $this->stat = "famg";
        }
        if ($request->getParameter('tous')) {
            $this->stat = "tous";
        }
        if ($request->getParameter('toussite')) {
            $this->stat = "toussite";
        } //touslocal
        if ($request->getParameter('touslocal')) {
            $this->stat = "touslocal";
        }
        if ($request->getParameter('sfamille')) {
            $this->familles = Doctrine_Core::getTable('famille')->findAll();

            $this->stat = "sfam";
        }
    }

    public function executeExporter(sfWebRequest $request)
    {

        $date_debut = date('Y-m-d');
        $date_fin = date('Y-m-d');
        if ($request->getParameter('filter')) {

            if ($request->getParameter('date_debut')) {
                $date_debut = $request->getParameter('date_debut');
            }

            if ($request->getParameter('date_fin')) {
                $date_fin = $request->getParameter('date_fin');
            }

        }
        $this->FilterImmobilisation = new ImmobilisationFormFilter();
        $this->FilterFamille = new FamilleFormFilter();
        if ($request->getParameter('immobilisation_filters')) {
            $this->FilterImmobilisation = new ImmobilisationFormFilter($request->getParameter('immobilisation_filters'));
        }

        if ($request->getParameter('famille_filters')) {
            $this->FilterFamille = new FamilleFormFilter($request->getParameter('famille_filters'));
        }

        $q = Doctrine_Query::create()
            ->select("COALESCE(SUM(mntttc),0) as totalttc ")
            ->from('immobilisation');

        $q = $q->where("dateacquisition>= '" . $date_debut . "'")
            ->andwhere("dateacquisition<= '" . $date_fin . "'");

        //calcul montant
        if ($this->FilterImmobilisation['id_categorie']->getValue()) {
            $q = $q->andwhere('id_categorie= ' . $this->FilterImmobilisation['id_categorie']->getValue());
        }
        if ($this->FilterImmobilisation['id_famille']->getValue()) {
            $q = $q->andwhere('id_famille= ' . $this->FilterImmobilisation['id_famille']->getValue());
        }
        if ($this->FilterImmobilisation['id_sousfamille']->getValue()) {
            $q = $q->andwhere('id_sousfamille= ' . $this->FilterImmobilisation['id_sousfamille']->getValue());
        } //die($filterfamille['id_typefamille']->getValue());
        //die($filterfamille['id_typefamille']->getValue());

        if ($this->FilterFamille['id_typefamille']->getValue() != "") {
            $type = $this->FilterFamille['id_typefamille']->getValue();
            $familles = Doctrine_Core::getTable('famille')
                ->createQuery('a')
                ->where('id_typefamille=' . $type)
                ->execute();

            $arrayfamille = array();
            $j = 1;
            $arrayfamille[0] = -1;
            foreach ($familles as $famille) {
                $arrayfamille[$j] = $famille->getId();
                $j++;
            }

            $q = $q->andwhereIn('id_famille ', $arrayfamille);
        }
        $total = $q->fetchArray();
        $ttctotal = number_format($total[0]['totalttc'], 3);

        $nomfichier = "uploads/import/fichier" . strtotime(date('Y-m-d h:m:s')) . ".csv";
        $fp = fopen($nomfichier, "w");
        $immobs = $this->Filterimmob($request, $this->FilterImmobilisation, $this->FilterFamille)->execute();
        $ligneE = array(utf8_decode('Date Début'), $date_debut, 'Date fin', $date_fin, 'Total', $ttctotal);
        fputcsv($fp, $ligneE, ";");
        $ligneE = array(utf8_decode('Numéro'), 'Deseignation', 'Famille', 'Sous Famille', 'Bureau', 'Site', 'Etage', 'Adresse', 'Date d\'acquisistion ', 'Mnt TTC');
        fputcsv($fp, $ligneE, ";");
        foreach ($immobs as $immo) {
            //E    site    Type    code client    Date Cde    Site    Devise *****E    site    Type    code client    Date Cde    Site    Devise

            $ligneE = array($immo->getNumero(), utf8_decode($immo->getDesignation()), utf8_decode($immo->getFamille()), utf8_decode($immo->getSousfamille()), utf8_decode($immo->getBureaux()), $immo->getSite(), $immo->getEtage(), $immo->getAdresse(), date("Y-m-d", strtotime($immo->getDateacquisition())), $immo->getMntttc());
            fputcsv($fp, $ligneE, ";");
        }
        $FilterImmobilisation = $this->FilterImmobilisation;
        $FilterFamille = $this->FilterFamille;
        $lien = "";
        if ($FilterImmobilisation['id_categorie']->getValue()) {
            $lien .= "&immobilisation_filters[id_categorie]=" . $FilterImmobilisation['id_categorie']->getValue();
        }

        if ($FilterFamille['id_typefamille']->getValue()) {
            $lien .= "&famille_filters[id_typefamille]=" . $FilterFamille['id_typefamille']->getValue();
        }

        if ($FilterImmobilisation['id_famille']->getValue()) {
            $lien .= "&immobilisation_filters[id_famille]=" . $FilterImmobilisation['id_famille']->getValue();
        }

        if ($FilterImmobilisation['id_sousfamille']->getValue()) {
            $lien .= "&immobilisation_filters[id_sousfamille]=" . $FilterImmobilisation['id_sousfamille']->getValue();
        }

        return $this->redirect('immobilisation/statistiquedate?date_debut=' . $date_debut . '&date_fin=' . $date_fin . '&filter=Filtrer&fichier=' . sfconfig::get('sf_appdir') . '/' . $nomfichier . $lien);
    }

    public function executeStatistiquedate(sfWebRequest $request)
    {
        $this->date_debut = date('Y-m-d');
        $this->date_fin = date('Y-m-d');
        $page = 0;
        $offset = 0;
       
        $this->FilterImmobilisation = new ImmobilisationFormFilter();
        $this->FilterFamille = new FamilleFormFilter();
        if ($request->getParameter('immobilisation_filters')) {
            $this->FilterImmobilisation = new ImmobilisationFormFilter($request->getParameter('immobilisation_filters'));
        }

        if ($request->getParameter('famille_filters')) {
            $this->FilterFamille = new FamilleFormFilter($request->getParameter('famille_filters'));
        }

        if ($request->getParameter('filter')) {
            if ($request->getParameter('date_debut')) {
                $this->date_debut = $request->getParameter('date_debut');
            }

            if ($request->getParameter('date_fin')) {
                $this->date_fin = $request->getParameter('date_fin');
            }

        }

        $immobquery = $this->Filterimmob($request, $this->FilterImmobilisation, $this->FilterFamille);

        $q = Doctrine_Query::create()
            ->select("COALESCE(SUM(mntttc),0) as totalttc ")
            ->from('immobilisation');
        
        //calcul montant
        if ($this->FilterImmobilisation['id_categorie']->getValue()) {
            $q = $q->andwhere('id_categorie= ' . $this->FilterImmobilisation['id_categorie']->getValue());
        }
        if ($this->FilterImmobilisation['id_famille']->getValue()) {
            $q = $q->andwhere('id_famille= ' . $this->FilterImmobilisation['id_famille']->getValue());
        }
        if ($this->FilterImmobilisation['id_sousfamille']->getValue()) {
            $q = $q->andwhere('id_sousfamille= ' . $this->FilterImmobilisation['id_sousfamille']->getValue());
        } //die($filterfamille['id_typefamille']->getValue());
        //die($filterfamille['id_typefamille']->getValue());

        if ($this->FilterFamille['id_typefamille']->getValue() != "") {
            $type = $this->FilterFamille['id_typefamille']->getValue();
            $familles = Doctrine_Core::getTable('famille')
                ->createQuery('a')
                ->where('id_typefamille=' . $type)
                ->execute();

            $arrayfamille = array();
            $j = 1;
            $arrayfamille[0] = -1;
            foreach ($familles as $famille) {
                $arrayfamille[$j] = $famille->getId();
                $j++;
            }

            $q = $q->andwhereIn('id_famille ', $arrayfamille);
        }

        $total = $q->fetchArray();
        $this->ttctotal = $total[0]['totalttc'];

        if ($request->getParameter('page')) {
            $page = ($request->getParameter('page') - 1) * 10;
        }

        $this->immobilisations = $this->Filterimmob($request, $this->FilterImmobilisation, $this->FilterFamille)->limit(10)->offset($page)->execute();

        $countimmob = $immobquery->count();
        $this->pagerimmob = new sfDoctrinePager('Immobilisation', 10);
        $this->pagerimmob->setQuery($immobquery);
        $this->pagerimmob->setPage($request->getParameter('page', 1));
        $this->pagerimmob->init();
    }

    public function Filterimmob($request, $filterimmobilisation, $filterfamille)
    {
        $dated = date('Y-m-d');
        $datef = date('Y-m-d');
        if ($request->getParameter('date_debut')) {
            $dated = $request->getParameter('date_debut');
        }
        $user = sfContext::getInstance()->getUser()->getAttribute('userB2m');

        if ($user->getIdMagasin() || $user->getIdLabo()) {
            $labo_id = json_decode($user->getIdLabo());
            if (!$labo_id) {
                $labo_id = json_decode($user->getIdMagasin());
            }
        }
        $labo_id_projet = [];
        if ($user->getIdProjet() && $user->getIsChefprojet() == true) {
            $projet_ids = json_decode($user->getIdProjet());

            foreach ($projet_ids as $id_pro) {
                $projet = ProjetTable::getInstance()->find($id_pro);
                array_push($labo_id_projet, $projet->getIdSoussite());
            }
        }

        if ($request->getParameter('date_fin')) {
            $datef = $request->getParameter('date_fin');
        }

        $immobilisations = Doctrine_Core::getTable('immobilisation')
            ->createQuery('a')
            ->where("dateacquisition>='" . $dated . "'")
            ->andwhere("dateacquisition<='" . $datef . "'");
           
            if ($labo_id) {
                $immobilisations= $immobilisations->andwhereIn("id_etage " ,$labo_id ) ;
            }
            if ($user->getIdProjet() && $labo_id_projet && !$labo_id) {
            $immobilisations=$immobilisations->andwhereIn ("id_etage " , $labo_id_projet);
        }
        if ($filterimmobilisation['id_categorie']->getValue()) {
            $immobilisations = $immobilisations->andwhere('id_categorie= ' . $filterimmobilisation['id_categorie']->getValue());
        }
        if ($filterimmobilisation['id_famille']->getValue()) {
            $immobilisations = $immobilisations->andwhere('id_famille= ' . $filterimmobilisation['id_famille']->getValue());
        }
        if ($filterimmobilisation['id_sousfamille']->getValue()) {
            $immobilisations = $immobilisations->andwhere('id_sousfamille= ' . $filterimmobilisation['id_sousfamille']->getValue());
        }
        if ($filterfamille['id_typefamille']->getValue() != "") {
            $type = $filterfamille['id_typefamille']->getValue();
            $familles = Doctrine_Core::getTable('famille')
                ->createQuery('a')
                ->where('id_typefamille=' . $type)
                ->execute();

            $arrayfamille = array();
            $j = 1;
            $arrayfamille[0] = -1;
            foreach ($familles as $famille) {
                $arrayfamille[$j] = $famille->getId();
                $j++;
            }

            $immobilisations = $immobilisations->andwhereIn('id_famille ', $arrayfamille);
        }
        //die($immobilisations);
        return $immobilisations;
    }

    protected function getPager($idcategorie = 0)
    {
        $pager = $this->configuration->getPager('immobilisation');
        // die("kk".$idcategorie);
        $pager->setQuery($this->buildQuery($idcategorie));
        $pager->setPage($this->getPage());
        $pager->init();

        return $pager;
    }

    public function executeImprimerFiche(sfWebRequest $request)
    {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche Immobilistaion');
        $pdf->SetSubject("Fiche Immobilistaion");
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
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlFiche($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
        $pdf->Output('Fiche Immobilistaion' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFiche($id)
    {
        $html = StyleCssHeader::header1();
        $immobilisation = new Immobilisation();
        $html .= $immobilisation->ReadHtmlFiche($id);

        return $html;
    }

    public function executeImprimerlisteImmobilisation(sfWebRequest $request)
    {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('liste Immobilistaion');
        $pdf->SetSubject("liste Immobilistaion");
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
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlListeImmobilisation($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
        $pdf->Output('liste Immobilistaion' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeImmobilisation(sfWebRequest $request)
    {
        $html = StyleCssHeader::header1();
        $immobilisation = new Immobilisation();

        $html .= $immobilisation->ReadHtmListeImmobilisation($request);

        return $html;
    }

    public function executeExporterListeImmobilisationExcel(sfWebRequest $request)
    {
        $designation = $request->getParameter('designation', '');
        $id_site = $request->getParameter('id_site', '');
        $id_soussite = $request->getParameter('id_soussite', '');
        $id_bureau = $request->getParameter('id_bureau', '');
        $id_cat = $request->getParameter('id_cat', '');
        $id_famille = $request->getParameter('id_famille', '');
        $id_sousfamille = $request->getParameter('id_sousfamille', '');
        $this->designation = $designation;
        $this->id_site = $id_site;
        $this->id_soussite = $id_soussite;
        $this->id_bureau = $id_bureau;
        $this->id_cat = $id_cat;
        $this->id_sousfamille = $id_sousfamille;
        $this->id_famille = $id_famille;

        if ($id_site == '') {
            $site_libelle = '';
        }

        if ($id_site != '') {
            $site = SiteTable::getInstance()->find($id_site);
            $site_libelle = $site->getCode()+' '+$site->getSite();
        }
        $this->site_libelle = $site_libelle;
        if ($id_soussite == '') {
            $souss_site_libelle = '';
        }

        if ($id_soussite != '') {
            $soussite = EtageTable::getInstance()->find($id_soussite);
            $souss_site_libelle = $soussite->getCode()+' '+$soussite->getEtage();
        }
        $this->souss_site_libelle = $souss_site_libelle;
        if ($id_bureau == '') {
            $bureau_libelle = '';
        }

        if ($id_cat != '') {
            $bureau = CategoerieTable::getInstance()->find($id_bureau);
            $bureau_libelle = $bureau->getCode()+' '+$bureau->getBureau();
        }
        $this->bureau_libelle = $bureau_libelle;

        if ($id_cat == '') {
            $cat_libelle = '';
        }

        if ($id_cat != '') {
            $categ = CategoerieTable::getInstance()->find($id_cat);
            $cat_libelle = $categ->getCodecategoeie()+' '+$categ->getCategorie();
        }
        $this->cat_libelle = $cat_libelle;
        if ($id_famille == '') {
            $famille_libelle = '';
        }

        if ($id_famille != '') {
            $famille = FamilleTable::getInstance()->find($id_famille);
            $famille_libelle = $famille->getCode()+' '+$famille->getFamille();
        }
        $this->famille_libelle = $famille_libelle;
        if ($id_sousfamille == '') {
            $sousfamille = '';
        }

        if ($id_sousfamille != '') {
            $sous_famille = SousfamilleTable::getInstance()->find($id_sousfamille);
            $sousfamille = $sous_famille->getCode()+' '+$sous_famille->getSousfamille();
        }
        $this->sousfamille = $sousfamille;
        // $immobilisation = ImmobilisationTable::getInstance()->getActif($codefrs, $rs, $id_activite, $id_famille);
        // $this->fournisseurs = $forunisseur;
    }

    public function executeImprimerListeBarcode(sfWebRequest $request)
    {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('bur');

        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Code à Barre');
        $pdf->SetSubject("Liste Code à Barre");
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
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlListeBarcode($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Code à Barre' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeBarcode($id)
    {
        $html = StyleCssHeader::header1();
        $immobilisation = new Immobilisation();
        $html .= $immobilisation->ReadHtmlListeBarcode($id);

        return $html;
    }

    public function executePrintListeType(sfWebRequest $request)
    {
        $config = sfTCPDFPluginConfigHandler::loadConfig();
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF("L");
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Immobilisation par Type');
        $pdf->SetSubject("Liste Immobilisation par Type");
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
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlListeType($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Immobilisation par Type' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeType($id)
    {
        $html = StyleCssHeader::header1();
        $immobilisation = new Immobilisation();
        $html .= $immobilisation->ReadHtmlListeType($id);

        return $html;
    }

    public function executeImprimerFicheImmobAvecChoix(sfWebRequest $request)
    {

        $pdf = new sfTCPDF('');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Immobilisation');
        $pdf->SetSubject("Fiche Immobilisation");
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
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlImmobilisationAvecChoix($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
        $pdf->Output('Fiche Immobilisation.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlImmobilisationAvecChoix(sfWebRequest $request)
    {
        $html = StyleCssHeader::header1();
        $immo = new Immobilisation();

        $html .= $immo->ReadHtmlFicheImmobbilisationAvecChoix($request);
        return $html;
    }

}
