<?php

/**
 * import actions.
 *
 * @package    Commercial
 * @subpackage import
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class importActions extends sfActions
{

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    /***************Importation Immobilisation excel******/
    public function executeGoImmoExcel(sfWebRequest $request)
    {
        $tmp_name = $_FILES['lib_fichier']['tmp_name'];
        $name = $_FILES['lib_fichier']['name'];
        $timestamp = strtotime("now");
        $url_fichier = "uploads/import/" . $timestamp . '_' . $name;
        move_uploaded_file($tmp_name, $url_fichier);

        $this->url_fichier = $url_fichier;
        $this->name = $name;
    }
    public function executeImportimmobExcel(sfWebRequest $request)
    {
    }

    public function executeImportEmplacementExcel(sfWebRequest $request)
    {
    }
    public function executeGoEmplacementExcel(sfWebRequest $request)
    {
        $tmp_name = $_FILES['lib_fichier']['tmp_name'];
        $name = $_FILES['lib_fichier']['name'];

        $url_fichier = "uploads/import/" . $name;
        move_uploaded_file($tmp_name, $url_fichier);

        $this->url_fichier = $url_fichier;
        $this->name = $name;
    }
    public function executeSaveImmobImport(sfWebRequest $request)
    {

        $params = array();
        $content = $request->getContent();
        $params = json_decode($content, true);
        $numerocompte = $params['numerocompte'];
        $designation = $params['designation'];
        $codeCategorie = $params['codeCategorie'];
        $classification = $params['classification'];
        $fournisseur = $params['fournisseur'];
        $numerofacture = $params['numerofacture'];
        $anciennum_invetaire = $params['anciennum_invetaire'];
        $valeuorrigine = $params['valeurorigine'];
        $dateacquition = $params['dateacquition'];
        $tauxammortisement = $params['tauxammortisement'];
        $categorie = $params['categorie'];

        $famille = $params['famille'];
        $sousfamille = $params['sousfamille'];
        $site = $params['site'];
        $soussite = $params['soussite'];
        $local = $params['local'];
        $numerocompte = explode(';', $numerocompte);
        $designation = explode(';', $designation);
        $codeCategorie = explode(';', $codeCategorie);
        $classification = explode(';', $classification);
        $fournisseur = explode(';', $fournisseur);
        $numerofacture = explode(';', $numerofacture);
        $anciennum_invetaire = explode(';', $anciennum_invetaire);
        $valeuorrigine = explode(';', $valeuorrigine);
        $dateacquition = explode(';', $dateacquition);
        $tauxammortisement = explode(';', $tauxammortisement);
        $categorie = explode(';', $categorie);

        $famille = explode(';', $famille);

        $sousfamille = explode(';', $sousfamille);
        $site = explode(';', $site);
        $soussite = explode(';', $soussite);
        $local = explode(';', $local);
        $values = '';
        $inc = 0;
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');
        for ($i = 0; $i < sizeof($designation); $i++) {
            $j = 1;
            if ($designation[$i] != '') {
                if ($values == '')
                    $values = $values . '(';
                else
                    $values = $values . ', (';
                if ($dateacquition[$i] != '') {
                    $date_document = explode('/', $dateacquition[$i]);
                    $date_doc_acquisition = $date_document[2] . '-' . $date_document[1] . '-' . $date_document[0];
                } else {
                    $date_doc_acquisition = date('Y-m-d', strtotime($dateacquition[$i]));
                }
                if ($anciennum_invetaire[$i] != '') {
                    $immob = Doctrine_Core::getTable('immobilisation')->findOneByNumeropiece($anciennum_invetaire[$i]);
                }
                if ($designation[$i] != '')
                    $immob = Doctrine_Core::getTable('immobilisation')->findOneByDesignation($designation[$i]);
                if (!$immob)
                    $immobilisation = new Immobilisation();
                else
                    $immobilisation = $immob;
                $immobilisation->setReference($anciennum_invetaire[$i]);
                $immobilisation->setDesignation($designation[$i]);
                if (!$immob)
                    $immobilisation->setDatecreation(date('Y-m-d'));
                $immobilisation->setIdUser($user->getId());
                if ($date_doc_acquisition)
                    $immobilisation->setDateacquisition($date_doc_acquisition);
                $immobilisation->setIdTypeaffectationimmo(1);
                //_________________________Find numero plan comtable
                if ($numerocompte[$i] != '') {
                    $numero_compte_comptable = $numerocompte[$i];
                    if (strlen($numerocompte[$i]) < 7) {
                        for ($j = strlen($numerocompte[$i]); $j <= 7; $j++)
                            $numero_compte_comptable .= '0';
                    }
                    $plancomptable = PlancomptableTable::getInstance()->findOneByNumerocompte($numero_compte_comptable);
                    if ($plancomptable) {
                        $immobilisation->setComptecomptabel($plancomptable->getId());
                    }
                }
                //___________________Find classement comptable === categorie comptable
                if ($codeCategorie[$i] != '') {
                    $categorieTable = CategoerieTable::getInstance()->findOneByCodecategoeie($codeCategorie[$i]);
                    if (!$categorieTable) {
                        $categorieTable = new Categoerie();
                        $categorieTable->setCategorie($codeCategorie[$i]);
                        $categorieTable->save();
                    }
                    $immobilisation->setIdClassement($categorieTable->getId());
                }
                //________________Find Suppliers
                if ($fournisseur[$i] != '') {
                    $frs = FournisseurTable::getInstance()->findOneByRs($fournisseur[$i]);

                    if (!$frs) {
                        $frs = new Fournisseur();
                        $frs->setRs($fournisseur[$i]);
                        $frs->save();
                    }

                    $immobilisation->setIdFournisseur($frs->getId());
                }
                //______________ADD Numero facture
                if ($numerofacture[$i] != '')
                    $immobilisation->setNumerofacture($numerofacture[$i]);
                //______________add valeur d'origine
                if ($valeuorrigine[$i] != '')
                    $immobilisation->setMntttc($valeuorrigine[$i]);
                //_______________Add taux ammortisment
                if ($tauxammortisement[$i] != '') {
                    $valeur_taux = $tauxammortisement[$i];
                    if (strpos($tauxammortisement[$i], '%') === false) {
                        $valeur_taux = $tauxammortisement[$i] * 100;
                        $valeur_taux = $valeur_taux . '%';
                    }
                    $tauxAmmTable = TauxammortisementTable::getInstance()->findOneByTauxammortisement($valeur_taux);

                    if (!$tauxAmmTable) {

                        $tauxAmmTable = new Tauxammortisement();
                        $tauxAmmTable->setTauxammortisement($valeur_taux);
                        $tauxAmmTable->save();
                    }

                    $immobilisation->setTauxammortisement($tauxAmmTable);
                    $immobilisation->setTauxammor2($valeur_taux);
                }
                //____________Find categ famille and sous famille

                if ($categorie[$i] != '') {

                    $typefamille = TypefamilleTable::getInstance()->findOneByLibelle($categorie[$i]);
                    if (!$typefamille) {
                        $typefamille = new Typefamille();
                        $typefamille->setLibelle($categorie[$i]);
                        $count_typefamille = Doctrine_Core::getTable('Typefamille')->createQuery('a')->count();
                        $typefamille->setCode(sprintf('%02d', $count_typefamille + 1));
                        $typefamille->save();
                    }
                    $code_typefamille = $typefamille->getCode();
                    $immobilisation->setIdCategorie($typefamille->getId());
                }

                if ($famille[$i] != '') {
                    $familleTable = FamilleTable::getInstance()->findOneByFamille($famille[$i]);
                    if (!$familleTable) {
                        $familleTable = new Famille();
                        $familleTable->setFamille($famille[$i]);
                        $count_famille = Doctrine_Core::getTable('Famille')->createQuery('a')->count();
                        $code_famille = $code_typefamille . '' . sprintf('%03d', $count_famille + 1);
                        $familleTable->setCode($code_famille);
                        $familleTable->setIdTypefamille($typefamille->getId());
                        $familleTable->save();
                    }
                    $code_famille = $familleTable->getCode();
                    $immobilisation->setIdFamille($familleTable->getId());
                }

                if ($sousfamille[$i] != '') {
                    $sousfamilleTable = SousfamilleTable::getInstance()->findOneBySousfamille($famille[$i]);
                    if (!$sousfamilleTable) {
                        $sousfamilleTable = new Sousfamille();
                        $sousfamilleTable->setSousfamille($famille[$i]);
                        $count_sousfamille = Doctrine_Core::getTable('Sousfamille')->createQuery('a')->count();
                        $code_sousfamille = $code_famille . '' . sprintf('%03d', $count_sousfamille + 1);
                        $sousfamilleTable->setCode($code_sousfamille);
                        $sousfamilleTable->setIdFamille($sousfamilleTable->getId());
                        $sousfamilleTable->save();
                    }
                    $code_sousfamille = $sousfamilleTable->getCode();
                    $immobilisation->setIdSousfamille($sousfamilleTable->getId());
                }
                if ($sousfamilleTable && $typefamille && $familleTable) {
                    $listeimmobilisations = Doctrine_Core::getTable('Immobilisation')->createQuery('a')
                        ->where('id_categorie=' . $typefamille->getId())
                        ->AndWhere('id_famille=' . $familleTable->getId())
                        ->AndWhere('id_sousfamille=' . $sousfamilleTable->getId())->execute();
                    $j = count($listeimmobilisations) + 1;
                    $chaine = $code_sousfamille . '' . sprintf('%04d', $j);
                    $immobilisation->setRefcodeabarre($chaine);
                } elseif ($typefamille && $familleTable) {

                    $listeimmobilisations = Doctrine_Core::getTable('Immobilisation')->createQuery('a')
                        ->Where('id_categorie=' . $typefamille->getId())
                        ->AndWhere('id_famille=' . $familleTable->getId())->execute();
                    $j = count($listeimmobilisations) + 1;
                    $chaine = $code_famille . '' . sprintf('%07d', $j);
                    $immobilisation->setRefcodeabarre($chaine);
                } elseif ($typefamille) {
                    $listeimmobilisations = Doctrine_Core::getTable('Immobilisation')->createQuery('a')
                        ->where('id_categorie=' . $typefamille->getId())->execute();
                    $j = count($listeimmobilisations) + 1;
                    $chaine = $code_famille . '' . sprintf('%06d', $j);
                    $immobilisation->setRefcodeabarre($chaine);
                }
                if ($site[$i] != '') {
                    $siteTable = SiteTable::getInstance()->findOneBySite($site[$i]);
                    if (!$siteTable) {
                        $siteTable = new Site();
                        $siteTable->setSite($site[$i]);
                        $listeSiteCount = count(Doctrine_Core::getTable('Site')->createQuery('a')->execute()) + 1;
                        $code_site = sprintf('%02d', $listeSiteCount);
                        $siteTable->setCode($code_site);
                        $siteTable->save();
                    }
                    $code_site = $siteTable->getCode();
                    $immobilisation->setIdSite($siteTable->getId());
                }
                if ($soussite[$i] != '') {

                    $soussiteTabe = EtageTable::getInstance()->findOneByEtage($soussite[$i]);
                    if (!$soussiteTabe) {
                        $soussiteTabe = new Etage();
                        $soussiteTabe->setEtage($soussite[$i]);
                        $listeSousSiteCount = count(Doctrine_Core::getTable('Etage')->createQuery('a')->execute()) + 1;

                        if ($code_site) {
                            $code_soussite = $code_site . '' . sprintf('%03d', $listeSousSiteCount);
                        } else {
                            $code_soussite = sprintf('%05d', $listeSousSiteCount);
                        }

                        if ($siteTable)
                            $soussiteTabe->setIdSite($siteTable->getId());
                        $soussiteTabe->setCode($code_soussite);
                        $soussiteTabe->save();
                    }
                    $code_soussite = $soussiteTabe->getCode();
                    $immobilisation->setIdEtage($soussiteTabe->getId());
                }
                if ($local[$i] != '') {

                    $localTable = BureauxTable::getInstance()->findOneByBureau($local[$i]);

                    if (!$localTable) {
                        $localTable = new Bureaux();
                        $localTable->setBureau($local[$i]);
                        $localTableCount = count(Doctrine_Core::getTable('Bureaux')->createQuery('a')->execute()) + 1;

                        if ($code_soussite) {
                            $code_local = $code_soussite . '' . sprintf('%04d', $localTableCount);
                        } else {
                            $code_local = sprintf('%09d', $localTableCount);
                        }
                        if ($soussiteTabe) {

                            $localTable->setIdEtage($soussiteTabe->getId());
                        }

                        if ($siteTable)
                            $localTable->setIdSite($siteTable->getId());

                        $localTable->setCode($code_local);

                        $localTable->save();
                    }
                    $code_local = $localTable->getCode();

                    $immobilisation->setIdBureaux($localTable->getId());
                }
                //count all imm
                $countlisteimmobilisations = Doctrine_Core::getTable('Immobilisation')->createQuery('a')->execute();
                $immobilisation->setNumero(count($countlisteimmobilisations)+1);
                $immobilisation->save();
                if ($code_local && $localTable) {
                    $emplacementTable = EmplacementTable::getInstance()->findOneByIdImmoAndIdBureau($immobilisation->getId(), $localTable->getId());
                    if (!$emplacementTable) {
                        $emplacementTable = new Emplacement();
                        $emplacementTable->setIdBureau($localTable->getId());
                        $emplacementTable->setIdImmo($immobilisation->getId());
                        if ($soussiteTabe)
                            $emplacementTable->setIdEtage($soussiteTabe->getId());
                        if ($siteTable)
                            $emplacementTable->setIdSite($siteTable->getId());
                        $emplacementTable->setDateaffectation(Date('Y-m-d'));
                        $reference = $code_local . '' . $immobilisation->getNumero();
                        $emplacementTable->setReference($reference);
                        $emplacementTable->save();
                    }
                }
            }
        }

        $this->getResponse()->setContentType('text/json');

        return $this->renderText(json_encode(array(
            "msg" => "OK"
        )));
    }
    public function ConvertToCaractere($nbre, $code)
    {
        if (strlen($code) < $nbre)
            return      sprintf("%0" . $nbre . "d", $code);
        return $code;
    }
    public function executeSaveEmplacementImport(sfWebRequest $request)
    {
        $params = array();
        $content = $request->getContent();
        $params = json_decode($content, true);
        $codesite = $params['codesite'];
        $site = $params['site'];
        $codesoussite = $params['codesoussite'];
        $soussite = $params['soussite'];
        $codelocal = $params['codelocal'];
        $local = $params['local'];
        $codesite = explode(';', $codesite);
        $site = explode(';', $site);
        $codesoussite = explode(';', $codesoussite);
        $soussite = explode(';', $soussite);
        $codelocal = explode(';', $codelocal);
        $local = explode(';', $local);
        $values = '';
        $inc = 0;
        $i = 1;
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');
        for ($i = 0; $i < sizeof($site); $i++) {
            if ($codesite[$i] != '') {
                if ($codesite[$i] != '') {
                    $site_immo = new site();
                    //__________________________________________________________Recherche Site
                    $site_epmlacement = Doctrine_Core::getTable('site')->findOneByCode($this->ConvertToCaractere(2, $codesite[$i]));
                    if ($site_epmlacement)
                        $site_immo = $site_epmlacement;
                    $site_immo->setCode($this->ConvertToCaractere(2, $codesite[$i]));

                    $site_immo->setSite($site[$i]);
                    $site_immo->save();
                }
                if ($codesoussite[$i] != '') {
                    $sous_site_immo = new etage();
                    $sous_site_code = $this->ConvertToCaractere(2, $codesite[$i]) . $this->ConvertToCaractere(3, $codesoussite[$i]);
                    //__________________________________________________________Recherche Sous Site
                    $sous_site_epmlacement = Doctrine_Core::getTable('etage')->findOneByCode($sous_site_code);
                    if ($sous_site_epmlacement)
                        $sous_site_immo = $sous_site_epmlacement;
                    $sous_site_immo->setCode($sous_site_code);
                    $sous_site_immo->setEtage($soussite[$i]);

                    $site_epmlacement = Doctrine_Core::getTable('site')->findOneByCode($this->ConvertToCaractere(2, $codesite[$i]));
                    if ($site_epmlacement)
                        $sous_site_immo->setIdSite($site_epmlacement->getId());
                    $sous_site_immo->save();
                }
                if ($codelocal[$i] != '') {
                    $local_empl = new bureaux();
                    $code_local = $this->ConvertToCaractere(2, $codesite[$i]) . $this->ConvertToCaractere(3, $codesoussite[$i]) . $this->ConvertToCaractere(4, $codelocal[$i]);
                    //__________________________________________________________Recherche Local
                    $local_epmlacement = Doctrine_Core::getTable('bureaux')->findOneByCode($code_local);
                    if ($local_epmlacement)
                        $local_empl = $local_epmlacement;
                    $local_empl->setCode($code_local);
                    $local_empl->setBureau($local[$i]);
                    $site_epmlacement = Doctrine_Core::getTable('site')->findOneByCode($this->ConvertToCaractere(2, $codesite[$i]));
                    if ($site_epmlacement)
                        $local_empl->setIdSite($site_epmlacement->getId());
                    $sous_site_code = $this->ConvertToCaractere(2, $codesite[$i]) . $this->ConvertToCaractere(3, $codesoussite[$i]);
                    $sous_site_epmlacement = Doctrine_Core::getTable('etage')->findOneByCode($sous_site_code);
                    if ($sous_site_epmlacement)
                        $local_empl->setIdEtage($sous_site_epmlacement->getId());
                    $local_empl->save();
                } else {

                    $local_empl_bureau = new bureaux();
                    $local_epmlacement = Doctrine_Core::getTable('bureaux')->findAll();
                    // if ($local_epmlacement->getLast()->getCode() != "") {
                    //     $last_bureau = $local_epmlacement->getLast()->getCode();
                    //     $locale = intval($last_bureau);
                    // } else {
                    $last_bureau = '1000';
                    $nv_code_local = intval($last_bureau) + $i;
                    $code_local = $this->ConvertToCaractere(2, $codesite[$i]) . $this->ConvertToCaractere(3, $codesoussite[$i]) . $nv_code_local;

                    // }
                    // $nv_code_local = $last_bureau + 1;
                    // die($nv_code_local . 'dv' . $last_bureau);
                    $local_empl_bureau->setCode($code_local);

                    $local_empl_bureau->setBureau($local[$i]);
                    $site_epmlacement = Doctrine_Core::getTable('site')->findOneByCode($this->ConvertToCaractere(2, $codesite[$i]));
                    if ($site_epmlacement)
                        $local_empl_bureau->setIdSite($site_epmlacement->getId());
                    $sous_site_code = $this->ConvertToCaractere(2, $codesite[$i]) . $this->ConvertToCaractere(3, $codesoussite[$i]);
                    $sous_site_epmlacement = Doctrine_Core::getTable('etage')->findOneByCode($sous_site_code);
                    if ($sous_site_epmlacement)
                        $local_empl_bureau->setIdEtage($sous_site_epmlacement->getId());
                    $local_empl_bureau->save();
                    $i++;
                }
            }
        }

        // $this->getResponse()->setContentType('text/json');

        return $this->renderText(json_encode(array(
            "msg" => "OK"
        )));
    }
    public function TestExtraireTva($taux, $immobilisation)
    {
        $tva = new Tva();
        $tvarecherche = Doctrine_Core::getTable('tva')->findOneByValeurtva($taux);
        if ($tvarecherche)
            $tva = $tvarecherche;
        $taux = intval($taux);
        $tva->setLibelle($taux . "%");
        $tva->setValeurtva($taux);
        $tva->save();
        $immob = $immobilisation;
        $immob->setIdTva($tva->getId());
        $immob->save();
    }
    public function TestSite($site, $immobilisation)
    {
        $sit = new Site();
        $site_immo = SiteTable::getInstance()->getBySite($site);
        if ($site_immo->getFirst())
            $sit = $site_immo->getFirst();
        $sit->setSite($site);
        $sit->save();
        $immob = $immobilisation;
        $immob->setIdSite($sit->getId());
        $immob->save();
    }

    public function TestCodeSousSite($soussite, $site, $immobilisation)
    {
        $soussit = new Etage();
        $sous_site_immo = EtageTable::getInstance()->getBySousSite($soussite);
        if ($sous_site_immo->getFirst())
            $soussit = $sous_site_immo->getFirst();
        $soussit->setEtage($soussite);
        if ($site) {
            $site_immo = SiteTable::getInstance()->getBySite($site);
            $soussit->setIdSite($site_immo->getFirst()->getId());
        }
        $soussit->save();
        $immob = $immobilisation;
        $immob->setIdEtage($soussit->getId());
        $immob->save();
    }


    public function TestCodeBureaux($codebureux, $soussite, $site, $immobilisation)
    {
        $nv_bureau = new Bureaux();
        $bureau = BureauxTable::getInstance()->getByCodeBureaux($codebureux);
        if ($bureau->getFirst())
            $nv_bureau = $bureau->getFirst();
        $nv_bureau->setCode($codebureux);
        if ($soussite) {
            $sous_site_immo = EtageTable::getInstance()->getBySousSite($soussite);
            if ($sous_site_immo->getfirst())
                $nv_bureau->setIdEtage($sous_site_immo->getfirst()->getId());
        }
        $nv_bureau->save();
        $immob = $immobilisation;
        $immob->setIdBureaux($nv_bureau->getId());
        $immob->save();
    }

    public function TestCodeCategorie($codeCategorie, $immobilisation)
    {
        $nv_categorie = new Categoerie();
        $categorie = CategoerieTable::getInstance()->getByCodeCategorie($codeCategorie);
        if ($categorie->getFirst())
            $nv_categorie = $categorie->getFirst();
        $nv_categorie->setCodecategoeie($codeCategorie);
        $nv_categorie->save();
        $immob = $immobilisation;
        $immob->setIdCategorie($nv_categorie->getId());
        $immob->save();
    }

    public function TestFamille($famille, $codeCategorie, $immobilisation)
    {
        $famil = new Famille();
        $famille_imm = FamilleTable::getInstance()->getByFamille($famille);
        if ($famille_imm->getFirst())
            $famil = $famille_imm->getFirst();
        $famil->setFamille($famille);
        if ($codeCategorie) {
            $categorie = CategoerieTable::getInstance()->getByCodeCategorie($codeCategorie);
            $famil->setIdCategorie($categorie->getFirst()->getId());
        }
        $famil->setIdTypefamille(1);
        $famil->save();
        $immob = $immobilisation;
        $immob->setIdFamille($famil->getId());

        $immob->save();
    }

    public function TestSousFamille($sousfamille, $famille, $immobilisation)
    {
        $sousfamil = new Sousfamille();
        $sousfamille = SousfamilleTable::getInstance()->getBySousFamille($sousfamille);
        if ($sousfamille->getFirst())
            $sousfamil = $sousfamille->getFirst();
        $sousfamil->setSousfamille($sousfamille);
        if ($famille) {
            $famille_imm = FamilleTable::getInstance()->getByFamille($famille);
            $sousfamil->setIdFamille($famille_imm->getFirst()->getId());
        }
        $sousfamil->save();
        $immob = $immobilisation;
        $immob->setIdSousfamille($sousfamil->getId());
        $immob->save();
    }
    public function executeIndex(sfWebRequest $request)
    {
        if ($request->getParameter('imp')) {
            if ($request->getParameter('imp') == "taux") {
                $this->importTaux();
            }
            if ($request->getParameter('imp') == "mode") {
                $this->importMode();
            }
            if ($request->getParameter('imp') == "codec") {
                $this->importCodec();
            }
        }
    }

    public function executeParcategorie(sfWebRequest $request)
    {
        if ($request->getParameter('imp')) {
            if ($request->getParameter('imp') == "categorie") {
                $this->importCategorie();
            }
        }
    }

    public function importCategorie()
    {
        $tmp_name = $_FILES['lib_fichier']['tmp_name'];
        $name = $_FILES['lib_fichier']['name'];

        move_uploaded_file($tmp_name, "uploads/import/" . $name);
        $arrLines = file('uploads/import/' . $name);

        $ArrayColumn = explode(";", $arrLines[0]);



        foreach ($arrLines as $line) {
            $arrResult = explode(';', $line);
            if (utf8_encode($arrResult[0]) != "") {
                $categorie = new Categoerie();
                $listecategories = Doctrine_Core::getTable('categoerie')->findOneByCategorie(utf8_encode($arrResult[0]));
                if (!$listecategories) {

                    $categorie->setCategorie(utf8_encode($arrResult[0]));
                    $categorie->save();
                } else {
                    $categorie = $listecategories;
                }
                $famille = new Famille();
                $listefamille = Doctrine_Core::getTable('famille')->findOneByFamilleAndIdCategorie(utf8_encode($arrResult[1]), $categorie->getId());
                if (!$listefamille) {
                    $famille->setFamille(utf8_encode($arrResult[1]));
                    $famille->setIdCategorie($categorie->getId());
                    $famille->save();
                } else {

                    $famille = $listefamille;
                }
                $sousfamille = new Sousfamille();
                $listesousfamille = Doctrine_Core::getTable('sousfamille')->findOneByIdFamilleAndSousfamille($famille->getId(), utf8_encode($arrResult[2]));
                if (!$listefamille) {
                    $sousfamille->setIdFamille($famille->getId());
                    $sousfamille->setSousfamille(utf8_encode($arrResult[2]));
                    $sousfamille->save();
                }
            }
        }
    }

    public function importCodec()
    {
        $tmp_name = $_FILES['lib_fichier']['tmp_name'];
        $name = $_FILES['lib_fichier']['name'];

        move_uploaded_file($tmp_name, "uploads/import/" . $name);
        $arrLines = file('uploads/import/' . $name);

        $ArrayColumn = explode(";", $arrLines[0]);



        foreach ($arrLines as $line) {
            $arrResult = explode(';', $line);
            if (utf8_encode($arrResult[0]) != "") {
                $listecodecomptables = Doctrine_Core::getTable('compte')->findOneByComptecomptable(utf8_encode($arrResult[0]));
                if (!$listecodecomptables) {
                    $compte = new Compte();
                    $compte->setComptecomptable(utf8_encode($arrResult[0]));
                    $compte->save();
                }
            }
        }
    }

    public function importMode()
    {
        $tmp_name = $_FILES['lib_fichier']['tmp_name'];
        $name = $_FILES['lib_fichier']['name'];

        move_uploaded_file($tmp_name, "uploads/import/" . $name);
        $arrLines = file('uploads/import/' . $name);

        $ArrayColumn = explode(";", $arrLines[0]);



        foreach ($arrLines as $line) {
            $arrResult = explode(';', $line);
            if (utf8_encode($arrResult[0]) != "") {
                $listesmode = Doctrine_Core::getTable('modeammortisement')->findOneByModeammortisement(utf8_encode($arrResult[0]));
                if (!$listesmode) {
                    $mode = new Modeammortisement();
                    $mode->setModeammortisement(utf8_encode($arrResult[0]));
                    $mode->save();
                }
            }
        }
    }

    public function importTaux()
    {
        $tmp_name = $_FILES['lib_fichier']['tmp_name'];
        $name = $_FILES['lib_fichier']['name'];

        move_uploaded_file($tmp_name, "uploads/import/" . $name);
        $arrLines = file('uploads/import/' . $name);

        $ArrayColumn = explode(";", $arrLines[0]);



        foreach ($arrLines as $line) {
            $arrResult = explode(';', $line);
            if ($arrResult[0] != "") {
                $listestaux = Doctrine_Core::getTable('tauxammortisement')->findOneByTauxammortisement($arrResult[0]);
                if (!$listestaux) {
                    $taux = new Tauxammortisement();
                    $taux->setTauxammortisement($arrResult[0]);
                    $taux->save();
                }
            }
        }
    }

    public function executeParemplacment(sfWebRequest $request)
    {
        if ($request->getParameter('imp')) {
            if ($request->getParameter('imp') == "emplacment") {
                $this->importEmplacement();
            }
        }
    }

    public function importEmplacement()
    {
        if (isset($_FILES['lib_fichier']['tmp_name'])) {
            $tmp_name = $_FILES['lib_fichier']['tmp_name'];
            $name = $_FILES['lib_fichier']['name'];

            move_uploaded_file($tmp_name, "uploads/import/" . $name);
            $arrLines = file('uploads/import/' . $name);

            $ArrayColumn = explode(",", $arrLines[0]);



            foreach ($arrLines as $line) {
                $arrResult = explode(';', $line);
                $pays_new = new Pays();
                $gouvernera_new = new Gouvernera();
                $site_new = new Site();
                $adresse_new = new Adresse();
                $local_new = new Typebureaux();
                $etage_new = new Etage();
                $bureau_new = new Bureaux();
                //_______________________________________ import pays
                if (utf8_encode($arrResult[0]) != "") {

                    $pays = Doctrine_Core::getTable('pays')->findOneByPays($arrResult[0]);
                    if ($pays)
                        $pays_new = $pays;
                    $pays_new->setPays(utf8_encode($arrResult[0]));
                    $pays_new->save();
                }
                //______________________________________ import gouvernera
                if (utf8_encode($arrResult[1]) != "") {

                    $gouvernera = Doctrine_Core::getTable('gouvernera')->findOneByGouvernera($arrResult[1]);
                    if ($gouvernera)
                        $gouvernera_new = $gouvernera;
                    $gouvernera_new->setGouvernera(utf8_encode($arrResult[1]));
                    $gouvernera_new->setIdPays($pays_new->getId());
                    $gouvernera_new->save();
                }
                //______________________________________ import adresse
                if (utf8_encode($arrResult[3]) != "") {

                    $adresse = Doctrine_Core::getTable('adresse')->findOneByAdresse($arrResult[3]);
                    if ($adresse)
                        $adresse_new = $adresse;

                    $adresse_new->setAdresse(utf8_encode($arrResult[3]));
                    $adresse_new->setIdCouvernera($gouvernera_new->getId());
                    $adresse_new->save();
                }
                //_________________________________ import site
                if (utf8_encode($arrResult[2]) != "") {

                    $site = Doctrine_Core::getTable('site')->findOneBySiteAndIdAdresse(utf8_encode($arrResult[2]), $adresse_new->getId());
                    if ($site)
                        $site_new = $site;
                    $site_new->setSite(utf8_encode($arrResult[2]));
                    $site_new->setIdAdresse($adresse_new->getId());
                    $site_new->save();
                }
                //_____________________________________ import local
                if (utf8_encode($arrResult[4]) != "") {

                    $local = Doctrine_Core::getTable('typebureaux')->findOneByTypebureaux(utf8_encode($arrResult[4]));
                    if ($local)
                        $local_new = $local;
                    $local_new->setTypebureaux(utf8_encode($arrResult[4]));

                    $local_new->save();
                }
                //_______________________________________ import etage
                if (utf8_encode($arrResult[5]) != "") {

                    $etage = Doctrine_Core::getTable('etage')->findOneByEtageAndIdSite($arrResult[5], $site_new->getId());
                    if ($etage)
                        $etage_new = $etage;
                    $etage_new->setEtage(utf8_encode($arrResult[5]));
                    $etage_new->setIdSite($site_new->getId());
                    $etage_new->save();
                }
                //_______________________________________ import bureaux
                if ($arrResult[6] != "") {

                    $bureau = Doctrine_Core::getTable('bureaux')->findOneByCodeAndIdEtageAndIdType($arrResult[6], $etage_new->getId(), $local_new->getId());
                    if ($bureau)
                        $bureau_new = $bureau;
                    $bureau_new->setBureaux(utf8_encode($arrResult[7]));
                    $bureau_new->setIdEtage($etage_new->getId());
                    $bureau_new->setIdType($local_new->getId());
                    $bureau_new->setCode($arrResult[6]);
                    $bureau_new->save();
                }
            }
        }
    }

    public function executeParimmob(sfWebRequest $request)
    {
        if ($request->getParameter('imp')) {
            if ($request->getParameter('imp') == "immob") {
                $this->importImmobilisation();
            }
        }
    }

    public function importImmobilisation()
    {

        if (isset($_FILES['lib_fichier']['tmp_name'])) {
            $tmp_name = $_FILES['lib_fichier']['tmp_name'];
            $name = $_FILES['lib_fichier']['name'];
            move_uploaded_file($tmp_name, "uploads/import/" . $name);
            $arrLines = file('uploads/import/' . $name);
            $ArrayColumn = explode(";", $arrLines[0]);
            foreach ($arrLines as $line) {
                $arrResult = explode(';', $line);
                $bureau_new = new Bureaux();
                $responsable_new = new Agents();
                $immobilisation_new = new Immobilisation();
                $categorie_new = new Categoerie();
                $famille_new = new Famille();
                $sousfamille_new = new Sousfamille();
                $tauxammo_new = new Tauxammortisement();
                $mode_new = new Modeammortisement();
                $fournisseur_new = new Fournisseur();
                $fabricant_new = new Fabricant();
                $comptecomptable_new = new Compte();
                $source = new Sourcesfinancemment();
                $typefamille = new Typefamille();
                //______________________________________Recherche code bureau
                if ($arrResult[6] != "") {
                    $Bureau = Doctrine_Core::getTable('bureaux')->findOneByCode($arrResult[6]);
                    if ($Bureau) {
                        $bureau_new = $Bureau;
                    } else {
                        $this->importEmplacement2($line);
                        $Bureau = Doctrine_Core::getTable('bureaux')->findOneByCode($arrResult[6]);
                        $bureau_new = $Bureau;
                    }
                } else {
                    $this->importEmplacement2($line);
                    $Bureau = Doctrine_Core::getTable('bureaux')->findOneByCode(49);
                    $bureau_new = $Bureau;
                    // die($bureau_new);
                }

                //____________________________________ import personnel
                if (utf8_encode($arrResult[8]) != "") {
                    $personnel = Doctrine_Core::getTable('agents')->findOneByNomcomplet(utf8_encode($arrResult[8]));
                    if ($personnel)
                        $responsable_new = $personnel;
                    $responsable_new->setNomcomplet(utf8_encode($arrResult[8]));
                    $responsable_new->setIdBureaux($bureau_new->getId());
                    $responsable_new->save();
                }
                //______________________________________ import fournisseur
                if (utf8_encode($arrResult[11]) != "") {
                    $fornisseur = Doctrine_Core::getTable('fournisseur')->findOneByRs(utf8_encode($arrResult[11]));
                    if ($fornisseur)
                        $fournisseur_new = $fornisseur;
                    $fournisseur_new->setRs(utf8_encode($arrResult[11]));
                    $fournisseur_new->setReference($arrResult[12]);
                    $fournisseur_new->save();
                }
                //__________________________________ import fabricant
                if (utf8_encode($arrResult[13]) != "") {
                    $fabricant = Doctrine_Core::getTable('fabricant')->findOneByRs(utf8_encode($arrResult[13]));
                    if ($fabricant)
                        $fabricant_new = $fabricant;
                    $fabricant_new->setFabricant(utf8_encode($arrResult[13]));
                    $fabricant_new->setReference($arrResult[14]);
                    $fabricant_new->save();
                }
                //_______________________________________ import categorie/famille/sous famille/type famille

                if (utf8_encode($arrResult[29]) != "") {
                    $typefamille_bydoc = Doctrine_Core::getTable('typefamille')->findOneByLibelle(utf8_encode($arrResult[29]));

                    if ($typefamille_bydoc)
                        $typefamille = $typefamille_bydoc;
                    $typefamille->setLibelle(utf8_encode($arrResult[29]));
                    $typefamille->save();
                    // die($typefamille);
                }
                if (utf8_encode($arrResult[15]) != "" && utf8_encode($arrResult[16]) != "" && utf8_encode($arrResult[17]) != "") {
                    $categorie = Doctrine_Core::getTable('categoerie')->findOneByCategorie(utf8_encode($arrResult[15]));
                    $famille = Doctrine_Core::getTable('famille')->findOneByFamille(utf8_encode($arrResult[16]));
                    $sousfamille = Doctrine_Core::getTable('sousfamille')->findOneBySousfamille(utf8_encode($arrResult[17]));
                    if ($categorie)
                        $categorie_new = $categorie;
                    $categorie_new->setCategorie(utf8_encode($arrResult[15]));
                    $categorie_new->save();
                    if ($famille)
                        $famille_new = $famille;
                    $famille_new->setFamille(utf8_encode($arrResult[16]));
                    if ($typefamille->getId())
                        $famille_new->setIdTypefamille($typefamille->getId());
                    $famille_new->setIdCategorie($categorie_new->getId());
                    $famille_new->save();
                    if ($sousfamille)
                        $sousfamille_new = $sousfamille;
                    $sousfamille_new->setSousfamille(utf8_encode($arrResult[17]));
                    $sousfamille_new->setIdFamille($famille_new->getId());
                    $sousfamille_new->save();
                }
                //________________________ import  compte comptable
                if (utf8_encode($arrResult[25]) != "") {
                    $compte = Doctrine_Core::getTable('compte')->findOneByComptecomptable(utf8_encode($arrResult[25]));
                    if ($compte)
                        $comptecomptable_new = $compte;
                    $comptecomptable_new->setComptecomptable(utf8_encode($arrResult[25]));
                    $comptecomptable_new->save();
                }
                //________________________ import  compte taux ammortisement
                if (utf8_encode($arrResult[26]) != "") {
                    $taux = Doctrine_Core::getTable('tauxammortisement')->findOneByTauxammortisement(utf8_encode($arrResult[26]));

                    if ($taux)
                        $tauxammo_new = $taux;

                    $tauxammo_new->setTauxammortisement($arrResult[26]);

                    $tauxammo_new->save();
                }
                //________________________ import  compte mode ammortisment
                if (utf8_encode($arrResult[27]) != "") {
                    $mode = Doctrine_Core::getTable('modeammortisement')->findOneByModeammortisement(utf8_encode($arrResult[27]));

                    if ($mode)
                        $mode_new = $mode;
                    $mode_new->setModeammortisement(utf8_encode($arrResult[27]));
                    $mode_new->save();
                }
                if (utf8_encode($arrResult[28]) != "") {
                    $sourcefinacement = Doctrine_Core::getTable('sourcesfinancemment')->findOneBySourcefinancement(utf8_encode($arrResult[28]));

                    if ($sourcefinacement)
                        $source = $sourcefinacement;
                    $source->setSourcefinancement(utf8_encode($arrResult[28]));
                    $source->save();
                }

                //____________________________ import fiche immobilisation

                if (utf8_encode($arrResult[10])) {
                    $immobilisation_new->setReference($immobilisation_new->getCodebarre(1));
                    $immobilisation_new->setNumero($immobilisation_new->getnumerocode(1));
                    $immobilisation_new->setDesignation(utf8_encode($arrResult[10]));
                    $immobilisation_new->setEtat(0);
                    if ($arrResult[11] != "")
                        $immobilisation_new->setIdFournisseur($fournisseur_new->getId());
                    if ($arrResult[13] != "")
                        $immobilisation_new->setIdFabricant($fabricant_new->getId());
                    $immobilisation_new->setIdCategorie($categorie_new->getId());
                    $immobilisation_new->setIdFamille($famille_new->getId());
                    $immobilisation_new->setIdSousfamille($sousfamille_new->getId());

                    if ($arrResult[18] != "")
                        $immobilisation_new->setDateacquisition(date('Y-m-d', strtotime($arrResult[18])));
                    if ($arrResult[19] != "")
                        $immobilisation_new->setDatemiseenservice(date('Y-m-d', strtotime($arrResult[19])));
                    // die($arrResult[20]);
                    if ($arrResult[20] != "")
                        $immobilisation_new->setDatemiseenrebut(date('Y-m-d', strtotime($arrResult[20])));
                    if ($arrResult[21] != "") {

                        $mntht = str_replace(",", ".", $arrResult[21]);
                        $mntht = str_replace(" ", "", $mntht);
                        $immobilisation_new->setPrixhtva($mntht);
                    }
                    if ($arrResult[22] != "")
                        $immobilisation_new->setTva($arrResult[22]);
                    if ($arrResult[23] != "") {
                        $mnt = str_replace(",", ".", $arrResult[23]);
                        $mnt = str_replace(" ", "", $mnt);

                        $immobilisation_new->setMntttc($mnt);
                    }
                    if ($arrResult[24] != "")
                        $immobilisation_new->setNumerofacture($arrResult[24]);
                    if ($arrResult[25] != "")
                        $immobilisation_new->setComptecomptabel($comptecomptable_new->getId());

                    if ($arrResult[26] != "")
                        $immobilisation_new->setTauxammortisement($tauxammo_new);

                    if ($arrResult[27] != "")
                        $immobilisation_new->setModeamortisement($mode_new->getId());
                    if ($arrResult[28] != "")
                        $immobilisation_new->setSourcefinancement($source);
                    $immobilisation_new->setIdBureaux($bureau_new->getId());
                    //____________recherche pays/gouve/adresse/site/local/etage/bureaux
                    $etage_new = new Etage();
                    $local_new = new Typebureaux();
                    $site_new = new Site();
                    $adresse_new = new Adresse();
                    $gouvernera_new = new Gouvernera();

                    $etage = Doctrine_Core::getTable('etage')->findOneById($bureau_new->getIdEtage());
                    $etage_new = $etage;
                    $local = Doctrine_Core::getTable('typebureaux')->findOneById($bureau_new->getIdType());
                    $local_new = $local;
                    $site = Doctrine_Core::getTable('site')->findOneById($etage_new->getIdSite());
                    $site_new = $site;
                    if ($site_new->getIdAdresse()) {
                        $adresse = Doctrine_Core::getTable('adresse')->findOneById($site_new->getIdAdresse());
                        $adresse_new = $adresse;
                    } else {
                        $adresse_new->setAdresse('NON AFFECTER');
                        $adresse_new->setIdCouvernera(1);
                        $adresse_new->save();
                    }

                    $gouvernera = Doctrine_Core::getTable('gouvernera')->findOneById($adresse_new->getIdCouvernera());
                    $gouvernera_new = $gouvernera;
                    $pays = Doctrine_Core::getTable('pays')->findOneById($gouvernera_new->getIdPays());


                    //________________ ajouter emplacment
                    $immobilisation_new->setIdBureaux($bureau_new->getId());
                    $immobilisation_new->setIdEtage($etage_new->getId());
                    $immobilisation_new->setIdSite($site_new->getId());
                    $immobilisation_new->setAdresse($adresse_new->getAdresse());
                    $immobilisation_new->setIdGouvernera($gouvernera_new->getId());
                    $immobilisation_new->setIdPays($pays->getId());
                    $immobilisation_new->setIdAgent($responsable_new->getId());
                    $immobilisation_new->save();


                    $empl = new Emplacement();
                    $empl->setDateaffectation(date('Y-m-d', strtotime($arrResult[19])));
                    $empl->setIdPays($immobilisation_new->getIdPays());
                    $empl->setIdGouvernera($immobilisation_new->getIdGouvernera());
                    $empl->setIdSite($immobilisation_new->getIdSite());
                    $empl->setIdEtage($immobilisation_new->getIdEtage());
                    $empl->setIdUser($immobilisation_new->getIdAgent());
                    $empl->setAdresse("Affectation");
                    $empl->setIdImmo($immobilisation_new->getId());
                    $empl->setIdBureau($immobilisation_new->getIdBureaux());
                    $empl->setReference($immobilisation_new->getReference() . '00' . $immobilisation_new->getIdBureaux());
                    $empl->save();
                }
            }
        }
    }

    public function importCategorie2($arrResult1, $arrResult2, $arrResult3)
    {
        $arrResult[0] = $arrResult1;
        $arrResult[1] = $arrResult2;
        $arrResult[2] = $arrResult3;
        if (utf8_encode($arrResult[0]) != "") {
            $categorie = new Categoerie();
            $listecategories = Doctrine_Core::getTable('categoerie')->findOneByCategorie(utf8_encode($arrResult[0]));
            if (!$listecategories) {

                $categorie->setCategorie(utf8_encode($arrResult[0]));
                $categorie->save();
            } else {
                $categorie = $listecategories;
            }
            $famille = new Famille();
            $listefamille = Doctrine_Core::getTable('famille')->findOneByFamilleAndIdCategorie(utf8_encode($arrResult[1]), $categorie->getId());
            if (!$listefamille) {
                $famille->setFamille(utf8_encode($arrResult[1]));
                $famille->setIdCategorie($categorie->getId());
                $famille->save();
            } else {

                $famille = $listefamille;
            }
            $sousfamille = new Sousfamille();
            $listesousfamille = Doctrine_Core::getTable('sousfamille')->findOneByIdFamilleAndSousfamille($famille->getId(), utf8_encode($arrResult[2]));
            if (!$listefamille) {
                $sousfamille->setIdFamille($famille->getId());
                $sousfamille->setSousfamille(utf8_encode($arrResult[2]));
                $sousfamille->save();
            }
        }
    }

    public function importEmplacement2($line)
    {

        $arrResult = explode(';', $line);
        $pays_new = new Pays();
        $gouvernera_new = new Gouvernera();
        $site_new = new Site();
        $adresse_new = new Adresse();
        $local_new = new Typebureaux();
        $etage_new = new Etage();
        $bureau_new = new Bureaux();
        //_______________________________________ import pays
        if (utf8_encode($arrResult[0]) != "") {

            $pays = Doctrine_Core::getTable('pays')->findOneByPays($arrResult[0]);
            if ($pays)
                $pays_new = $pays;
            $pays_new->setPays(utf8_encode($arrResult[0]));
            $pays_new->save();
        }
        //______________________________________ import gouvernera
        if (utf8_encode($arrResult[1]) != "") {

            $gouvernera = Doctrine_Core::getTable('gouvernera')->findOneByGouvernera($arrResult[1]);
            if ($gouvernera)
                $gouvernera_new = $gouvernera;
            $gouvernera_new->setGouvernera(utf8_encode($arrResult[1]));
            $gouvernera_new->setIdPays($pays_new->getId());
            $gouvernera_new->save();
        }
        //______________________________________ import adresse
        if (utf8_encode($arrResult[3]) != "") {

            $adresse = Doctrine_Core::getTable('adresse')->findOneByAdresse($arrResult[3]);
            if ($adresse)
                $adresse_new = $adresse;

            $adresse_new->setAdresse(utf8_encode($arrResult[3]));
            $adresse_new->setIdCouvernera($gouvernera_new->getId());
            $adresse_new->save();
        }
        //_________________________________ import site
        if (utf8_encode($arrResult[2]) != "") {

            $site = Doctrine_Core::getTable('site')->findOneBySiteAndIdAdresse(utf8_encode($arrResult[2]), $adresse_new->getId());
            if ($site)
                $site_new = $site;
            $site_new->setSite(utf8_encode($arrResult[2]));
            $site_new->setIdAdresse($adresse_new->getId());
            $site_new->save();
        }
        //_____________________________________ import local
        if (utf8_encode($arrResult[4]) != "") {

            $local = Doctrine_Core::getTable('typebureaux')->findOneByTypebureaux(utf8_encode($arrResult[4]));
            if ($local)
                $local_new = $local;
            $local_new->setTypebureaux(utf8_encode($arrResult[4]));

            $local_new->save();
        }
        //_______________________________________ import etage
        if (utf8_encode($arrResult[5]) != "") {

            $etage = Doctrine_Core::getTable('etage')->findOneByEtageAndIdSite($arrResult[5], $site_new->getId());
            if ($etage)
                $etage_new = $etage;
            $etage_new->setEtage(utf8_encode($arrResult[5]));
            $etage_new->setIdSite($site_new->getId());
            $etage_new->save();
        }
        //_______________________________________ import bureaux
        if ($arrResult[6] != "") {

            $bureau = Doctrine_Core::getTable('bureaux')->findOneByCodeAndIdEtageAndIdType($arrResult[6], $etage_new->getId(), $local_new->getId());
            if ($bureau)
                $bureau_new = $bureau;
            $bureau_new->setBureaux(utf8_encode($arrResult[7]));
            $bureau_new->setIdEtage($etage_new->getId());
            $bureau_new->setIdType($local_new->getId());
            $bureau_new->setCode($arrResult[6]);
            $bureau_new->save();
        } else {
            $bureau = Doctrine_Core::getTable('bureaux')->findOneByCodeAndIdEtageAndIdType('NON AFFECTER', $etage_new->getId(), $local_new->getId());
            if ($bureau)
                $bureau_new = $bureau;
            $bureau_new->setBureaux('NON AFFECTER');
            $bureau_new->setIdEtage($etage_new->getId());
            $bureau_new->setIdType($local_new->getId());
            $bureau_new->setCode(49);
            $bureau_new->save();
        }
    }

    //import tableau agents
    public function executeParagents(sfWebRequest $request)
    {
        if ($request->getParameter('imp')) {
            if ($request->getParameter('imp') == "agent") {
                $this->importAgents();
            }
        }
    }

    public function importAgents()
    {
        if (isset($_FILES['lib_fichier']['tmp_name'])) {
            $tmp_name = $_FILES['lib_fichier']['tmp_name'];
            $name = $_FILES['lib_fichier']['name'];

            move_uploaded_file($tmp_name, "uploads/import/" . $name);
            $arrLines = file('uploads/import/' . $name);

            $ArrayColumn = explode(";", $arrLines[0]);
            foreach ($arrLines as $line) {
                $arrResult = explode(';', $line);
                $agents_new = new Agents();

                //_______________________________________ import pays
                if (utf8_encode($arrResult[0]) != "") {

                    $agents = Doctrine_Core::getTable('agents')->findOneByAgents($arrResult[0]);
                    if ($agents)
                        $agents_new = $agents;
                    $agents_new->setPays(utf8_encode($arrResult[0]));
                    $agents_new->save();
                }
            }
        }
    }
}
