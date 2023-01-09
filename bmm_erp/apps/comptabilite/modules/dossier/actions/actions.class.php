<?php

/**
 * dossier actions.
 *
 * @package    sw-commerciale
 * @subpackage dossier
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dossierActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    function executeGetPager(sfWebRequest $request) {
        $pager = $this->paginate($request);
        return $this->renderPartial("liste_partial", array("pager" => $pager));
    }

    public function paginate(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $code = $request->getParameter('code', '');
        $etat = strtoupper($request->getParameter('etat', ''));
        $raisonsociale = $request->getParameter('raisonsociale', '');
        $pager = new sfDoctrinePager('Dossiercomptable', 10);
        $pager->setQuery(DossiercomptableTable::getInstance()->load($code, $raisonsociale, $etat));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeIndex(sfWebRequest $request) {
        $this->permission_profil = false;
//        $dossiers=$this->getAllDossier($request);
        $this->pager = $this->getAllDossier($request);
//        $pager = $this->paginate($request);
//        $this->pager=$pager;
        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste", array("pager" => $this->pager));
        }
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');

        if ($user->getProfil()->getId() != 30)
            $dossiers = DossiercomptableTable::getInstance()->getDossierByUser($user->getId());
        else
            $dossiers = DossiercomptableTable::getInstance()->getAll();

        if ($user->getProfil()->getId() != 1) {

            $dossiers = DossiercomptableTable::getInstance()->getDossierByUser($user->getId());
        } else {
            $this->permission_profil = true;
            $dossiers = DossiercomptableTable::getInstance()->getAll();
        }


        $this->dossiers = $dossiers;
    }

    public function goPagedossier(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $code = strtoupper($request->getParameter('code', ''));
        $raisonsociale = strtoupper($request->getParameter('raisonsociale', ''));

        $this->pager = $this->getAllDossierByCodeRaison($request);
        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("liste", array("pager" => $this->pager));
        }
    }

//    function getDossierByUser(sfWebRequest $request) {
//        $user = new Utilisateur();
//        $user =  $this->getUser()->getAttribute('userB2m');
//        $pager = new sfDoctrinePager('Dossiercomptable', 5);
//        $pager->setQuery(DossiercomptableTable::getInstance()->getDossierByUser($user->getId()));
//        $pager->setPage($request->getParameter('page', 1));
//        $pager->init();
//        die($user->getId());
//        return $pager;
//    }

    function getAllDossier(sfWebRequest $request) {

        $code = strtoupper($request->getParameter('code_filtre', ''));
        $libelle = strtoupper($request->getParameter('raisonsociale_filtre', ''));
        $pager = new sfDoctrinePager('Dossiercomptable', 5);
        $pager->setQuery(DossiercomptableTable::getInstance()->getAllDossier($code, $libelle));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();
        return $pager;
    }

    public function executeNew(sfWebRequest $request) {
        $this->payss = PaysTable::getInstance()->LoadAllPaysExecute();
        $this->devises = DeviseTable::getInstance()->findAll();
        $this->forme_juridiques = FormejuridiqueTable::getInstance()->getAllOrder();
        $this->secteur_activites = SecteuractiviteTable::getInstance()->findAll();
        $this->activites = ActivitetiersTable::getInstance()->findAll();

        $exercices = ExerciceTable::getInstance()->getAllexercie();

        $this->exercices = $exercices;
//        die(json_encode($exercices). $exercices->count().'vount');
        $this->compte_attente = PlancomptableTable::getInstance()->getPlanComptableOrderByNumeroForSelect();
    }

    public function executeArchiver(sfWebRequest $request) {
        $id = $request->getParameter('id');

        $dossier = DossiercomptableTable::getInstance()->find($id);
        $dossier->setArchive(true);
        $dossier->save();
    }

    public function executeShow(sfWebRequest $request) {
        $id = $request->getParameter('id', $_SESSION['dossier_id']);
        $this->dossier = DossiercomptableTable::getInstance()->findOneById($id);
        $this->referentiel = ReferentielcomptableTable::getInstance()->getOneByIdDossier($id);
        $this->referentiels = Doctrine_Core::getTable('referentielcomptable')->findByIdDossier($id);
        $this->id_dossier = $id;
    }

    function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }

    public function executeUploaderfile(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $id_dossier = $_REQUEST['id_dossier'];
        $titre = trim(str_replace(":", "", $_REQUEST['libelle']));
        $name = explode(".", $_FILES['fileSelected']['name']);
        $nom = $this->random_string(20);
        $uploads_dir = sfConfig::get('upload') . '/merge/' . $nom . '.' . $name[1];
        move_uploaded_file($_FILES['fileSelected']['tmp_name'], $uploads_dir);
        $refernciel = new Referentielcomptable();
        $refernciel->setLibelle($titre);
        $refernciel->setUrl($nom . '.' . $name[1]);
        $refernciel->setIdDossier($id_dossier);
        $refernciel->save();
        $array = ['msg' => 'Ajout avec succées', 'libelle' => $titre, 'url' => $nom . '.' . $name[1]];
        die(json_encode($array));
    }

    public function executeShowEdit(sfWebRequest $request) {
        $id = $request->getParameter('id', $_SESSION['dossier_id']);
        $this->dossier = DossiercomptableTable::getInstance()->findOneByID($id);
        $this->id_dossier = $id;
        $this->payss = PaysTable::getInstance()->LoadAllPaysExecute();
        $this->devises = DeviseTable::getInstance()->findAll();
        $this->forme_juridiques = FormejuridiqueTable::getInstance()->findAll();
        $this->secteur_activites = SecteuractiviteTable::getInstance()->findAll();
        $this->activites = ActivitetiersTable::getInstance()->findAll();
        $this->exercices = ExerciceTable::getInstance()->getAll();
        $this->compte_attente = PlancomptableTable::getInstance()->getPlanComptableOrderByNumeroForSelect();
        $this->referentiels = Doctrine_Core::getTable('referentielcomptable')->findByIdDossier($id);
        $adresse = $this->dossier->getAdresse();
        if ($adresse && $adresse->getIdCouvernera()) {
            $ville = GouverneraTable::getInstance()->find($adresse->getIdCouvernera());
            if ($ville != null) {
                $this->villes = GouverneraTable::getInstance()->LoadVilleByIdPays($ville->getIdPays());

                $this->pays_id = $ville->getIdPays();
            } else {
                $this->villes = null;
                $this->pays_id = null;
            }
        } else {
            $this->villes = null;
            $this->pays_id = null;
        }
        $this->adresse = $adresse;
//        $this->referentiel = ReferentielcomptableTable::getInstance()->getOneByIdDossier($id);
    }

    public function executeSaveEdit(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $code = $request->getParameter('code');
        $raison_sociale = $request->getParameter('raison_sociale');
        $date_entreprise = $request->getParameter('date_entreprise');
        $date_debut_ouverture = $request->getParameter('date_debut_ouverture');
        $date_fin_fermeture = $request->getParameter('date_fin_fermeture');
        $telephone_1 = $request->getParameter('telephone_1');
        $telephone_2 = $request->getParameter('telephone_2');
        $fax = $request->getParameter('fax');
        $email = $request->getParameter('email');
        $matricule_fiscale = $request->getParameter('matricule_fiscale');
        $registre_commerce = $request->getParameter('registre_commerce');
        $chiffre_compte = $request->getParameter('chiffre_compte');
        $chiffre_virgule = $request->getParameter('chiffre_virgule');
        $forme_juridique = $request->getParameter('forme_juridique');
        $devise = $request->getParameter('devise');
        $secteur_activite = $request->getParameter('secteur_activite');
        $activite = $request->getParameter('activite');
        $code_postal = $request->getParameter('code_postal');
        $ville = $request->getParameter('ville');
        $adresse = $request->getParameter('adresse');
        $exercice = $request->getParameter('exercice');
        $id_vente = $request->getParameter('id_vente');
        $id_achat = $request->getParameter('id_achat');
        $id_attente = $request->getParameter('id_attente');
        $lib_fichier = $request->getParameter('lib_fichier');
        $libelle = $request->getParameter('libelle');
        $description = $request->getParameter('description');
        $etat = $request->getParameter('etat');

        if ($id != 0)
            $dossier = DossiercomptableTable::getInstance()->find($id);
        else
            $dossier = new Dossiercomptable();
        $adresse_dossier = $dossier->getAdresse();
        $adresse_id = '';
        if (intval($code_postal) > 0 && $adresse != '') {
            if ($adresse_dossier == null)
                $adresse_dossier = new Adresse();

            $adresse_dossier->setAdresse($adresse);
            $adresse_dossier->setCodepostal($code_postal);
            $adresse_dossier->setIdCouvernera($ville);

            $adresse_dossier->save();
            $adresse_id = $adresse_dossier->getId();
        }else {
            if ($adresse_dossier != null)
                $adresse_dossier->delete();
        }


        if ($activite != '' && intval($activite) > 0)
            $dossier->setIdActivite($activite);
        if ($adresse_id != '')
            $dossier->setIdAdresse($adresse_id);
        $dossier->setCode($code);
        $dossier->setDate(date('Y-m-d'));
        $dossier->setDatecreationentreprise($date_entreprise);
        $dossier->setDatedebutouverture($date_debut_ouverture);
        $dossier->setDatefinouverture($date_fin_fermeture);
        $dossier->setEtat($etat);
        if ($devise != '' && intval($devise) > 0)
            $dossier->setIdDevise($devise);
        $dossier->setEmail($email);
        $dossier->setFax($fax);
        if ($forme_juridique != '' && intval($forme_juridique) > 0)
            $dossier->setIdFormejuridique($forme_juridique);
        $dossier->setMatriculefiscale($matricule_fiscale);
        $dossier->setNombrechiffreapresvirgule($chiffre_virgule);
        $dossier->setNombrechiffrenumerocompte($chiffre_compte);
        $dossier->setRaisonsociale($raison_sociale);
        $dossier->setRegistrecommerce($registre_commerce);
        if ($secteur_activite != '' && intval($secteur_activite) > 0)
            $dossier->setIdSecteuractivite($secteur_activite);
        $dossier->setTelephonedeux($telephone_2);
        $dossier->setTelephoneun($telephone_1);

//        if ($exercice != '' && intval($exercice) > 0)
//            $dossier->setIdExercice($exercice);

        if ($id_achat != '' && intval($id_achat) > 0)
            $dossier->setIdCompteachat($id_achat);

        if ($id_vente != '' && intval($id_vente) > 0)
            $dossier->setIdComptevente($id_vente);

        if ($id_attente != '' && intval($id_attente) > 0)
            $dossier->setIdCompteattente($id_attente);

        $dossier->save();
        $referentiel = new Referentielcomptable();
        if ($libelle != '')
            $referentiel->setLibelle($libelle);
        if ($description != '')
            $referentiel->setDescription($description);
        if ($lib_fichier != '')
            $referentiel->setUrl($lib_fichier);
        $referentiel->setIdDossier($dossier->getId());
        $referentiel->setStandard('0');
        $referentiel->setIdUtilisateur($this->getUser()->getAttribute('userB2m'));
        $referentiel->save();
        /*
         * Vérification plan comptable 
         * Creation de meme donnees dans la table plancomptable mais avec id_dossier= nouveaux dossier cree
         * 
         */


        $exercice_insert = new Exercice();
        $exercice_insert->setLibelle($exercice);
        $exercice_insert->setDateDebut($date_debut_ouverture);
        $exercice_insert->setDateFin($date_fin_fermeture);
        $exercice_insert->setType('comptablilite ');
        $exercice_insert->save();

        $dossier_exercice = new Dossierexercice();
        $dossier_exercice->setIdDossier($dossier->getId());
        $dossier_exercice->setIdExercice($exercice_insert->getId());
        $dossier_exercice->setDate(date('Y-m-d'));
        $dossier_exercice->save();


//        $plancomptable_new = PlancomptableTable::getInstance()->findByIdDossier($dossier->getId());
//
//        if (count($plancomptable_new) == 0) {
//
//            $plancomptable_new = PlancomptableTable::getInstance()->InsertQueryArray($dossier->getId());
//        }
        die('ok');
    }

    /* edit dossiercomptable */

    public function executeSaveeditdossier(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $code = $request->getParameter('code');
        $raison_sociale = $request->getParameter('raison_sociale');
        $date_entreprise = $request->getParameter('date_entreprise');
        $date_debut_ouverture = $request->getParameter('date_debut_ouverture');
        $date_fin_fermeture = $request->getParameter('date_fin_fermeture');
        $telephone_1 = $request->getParameter('telephone_1');
        $telephone_2 = $request->getParameter('telephone_2');
        $fax = $request->getParameter('fax');
        $email = $request->getParameter('email');
        $matricule_fiscale = $request->getParameter('matricule_fiscale');
        $registre_commerce = $request->getParameter('registre_commerce');
        $chiffre_compte = $request->getParameter('chiffre_compte');
        $chiffre_virgule = $request->getParameter('chiffre_virgule');
        $forme_juridique = $request->getParameter('forme_juridique');
        $devise = $request->getParameter('devise');
        $secteur_activite = $request->getParameter('secteur_activite');
        $activite = $request->getParameter('activite');
        $code_postal = $request->getParameter('code_postal');
        $ville = $request->getParameter('ville');
        $adresse = $request->getParameter('adresse');
        $exercice = $request->getParameter('exercice');
        $id_vente = $request->getParameter('id_vente');
        $id_achat = $request->getParameter('id_achat');
        $id_attente = $request->getParameter('id_attente');
        $lib_fichier = $request->getParameter('lib_fichier');
        $libelle = $request->getParameter('libelle');
        $description = $request->getParameter('description');
        $etat = $request->getParameter('etat');

        if ($id != 0)
            $dossier = DossiercomptableTable::getInstance()->find($id);
        else
            $dossier = new Dossiercomptable();
        $adresse_dossier = $dossier->getAdresse();
        $adresse_id = '';
        if (intval($code_postal) > 0 && $adresse != '') {
            if ($adresse_dossier == null)
                $adresse_dossier = new Adresse();

            $adresse_dossier->setAdresse($adresse);
            $adresse_dossier->setCodepostal($code_postal);
            $adresse_dossier->setIdCouvernera($ville);

            $adresse_dossier->save();
            $adresse_id = $adresse_dossier->getId();
        }else {
            if ($adresse_dossier != null)
                $adresse_dossier->delete();
        }


        if ($activite != '' && intval($activite) > 0)
            $dossier->setIdActivite($activite);
        if ($adresse_id != '')
            $dossier->setIdAdresse($adresse_id);
        $dossier->setCode($code);
        $dossier->setDate(date('Y-m-d'));
        $dossier->setDatecreationentreprise($date_entreprise);
        $dossier->setDatedebutouverture($date_debut_ouverture);
        $dossier->setEtat($etat);
        $dossier->setDatefinouverture($date_fin_fermeture);
        if ($devise != '' && intval($devise) > 0)
            $dossier->setIdDevise($devise);
        $dossier->setEmail($email);
        $dossier->setFax($fax);
        if ($forme_juridique != '' && intval($forme_juridique) > 0)
            $dossier->setIdFormejuridique($forme_juridique);
        $dossier->setMatriculefiscale($matricule_fiscale);
        $dossier->setNombrechiffreapresvirgule($chiffre_virgule);
        $dossier->setNombrechiffrenumerocompte($chiffre_compte);
        $dossier->setRaisonsociale($raison_sociale);
        $dossier->setRegistrecommerce($registre_commerce);
        if ($secteur_activite != '' && intval($secteur_activite) > 0)
            $dossier->setIdSecteuractivite($secteur_activite);
        $dossier->setTelephonedeux($telephone_2);
        $dossier->setTelephoneun($telephone_1);

//        if ($exercice != '' && intval($exercice) > 0)
//            $dossier->setIdExercice($exercice);

        if ($id_achat != '' && intval($id_achat) > 0)
            $dossier->setIdCompteachat($id_achat);

        if ($id_vente != '' && intval($id_vente) > 0)
            $dossier->setIdComptevente($id_vente);

        if ($id_attente != '' && intval($id_attente) > 0)
            $dossier->setIdCompteattente($id_attente);

        $dossier->save();
        $referentiel = new Referentielcomptable();
        if ($libelle != '')
            $referentiel->setLibelle($libelle);
        if ($description != '')
            $referentiel->setDescription($description);
        if ($lib_fichier != '')
            $referentiel->setUrl($lib_fichier);
        $referentiel->setIdDossier($dossier->getId());
        $referentiel->setStandard('0');
        $referentiel->setIdUtilisateur($this->getUser()->getAttribute('userB2m'));
        $referentiel->save();
        /*
         * Vérification plan comptable 
         * Creation de meme donnees dans la table plancomptable mais avec id_dossier= nouveaux dossier cree
         * 
         */

        if ($dossier->getDossierexercice()->getFirst()->getExercice()->getId() != '')
            $exercice_insert = ExerciceTable::getInstance()->findOneById($dossier->getDossierexercice()->getFirst()->getExercice()->getId());
        else
            $exercice_insert = new Exercice();
        $exercice_insert->setLibelle($exercice);
        $exercice_insert->setDateDebut($date_debut_ouverture);
        $exercice_insert->setDateFin($date_fin_fermeture);
        $exercice_insert->setType('comptablilite ');
        $exercice_insert->save();
        if ($dossier->getDossierexercice()->getFirst()->getExercice()->getId() != '')
            $dossier_exercice = DossierexerciceTable::getInstance()->findOneByIdDossierAndIdExercice($dossier->getDossierexercice()->getFirst()->getExercice()->getId(), $dossier->getId());
        else
            $dossier_exercice = new Dossierexercice();
        $dossier_exercice->setIdDossier($dossier->getId());
        $dossier_exercice->setIdExercice($exercice_insert->getId());
        $dossier_exercice->setDate(date('Y-m-d'));
        $dossier_exercice->save();


//        $plancomptable_new = PlancomptableTable::getInstance()->findByIdDossier($dossier->getId());
//
//        if (count($plancomptable_new) == 0) {
//
//            $plancomptable_new = PlancomptableTable::getInstance()->InsertQueryArray($dossier->getId());
//        }
        die('ok');
    }

    public function executeListePlanDossier(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $numero = $request->getParameter('numero', '');
        $libelle = $request->getParameter('libelle', '');
        $this->comptes = PlancomptableTable::getInstance()->loadByDossier($id, $numero, $libelle);
        $this->dossier = DossiercomptableTable::getInstance()->find($id);
    }

    public function executeGenererBaseStandard(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $plans = PlancomptableTable::getInstance()->findStandard();

        foreach ($plans as $plandoss) {
            $dossiercompte = new PlanDossierComptable();
            $dossiercompte->setDossierId($id);
            $dossiercompte->setIdPlan($plandoss->getId());
            $dossiercompte->setLibelle($plandoss->getLibelle());
            $dossiercompte->setNumerocompte($plandoss->getNumeroCompte());
            $dossiercompte->setTypeSolde($plandoss->getTypeSolde());
            $dossiercompte->setLettrage($plandoss->getLettrage());
            $dossiercompte->setDate(date('Y-m-d'));
            $dossiercompte->save();
        }

        return true;
    }

    public function executeBaseStandard(sfWebRequest $request) {
        $this->classe_compte = ClassecompteTable::getInstance()->findAll();
        $this->comptes = PlancomptableTable::getInstance()->getPlanComptableOrderByNumero();
    }

    public function executeLoadBaseStandard(sfWebRequest $request) {
        $compte = $request->getParameter('compte', '1');
        $this->comptes = PlanComptableTable::getInstance()->findListeByClasseOrderByNumero($compte);
    }

    public function executeCheckPlanStandardTous(sfWebRequest $request) {
        $check = $request->getParameter('check');
        $comptes = PlanComptableTable::getInstance()->findAll();

        foreach ($comptes as $compte) {
            $compte->setStandard($check);
            $compte->save();
        }
        $comptes = PlancomptableTable::getInstance()->findOrderByNumero();
        return $this->renderPartial('dossier/list_comptes_base_standard', array('comptes' => $comptes));
    }

    public function executeVillepayschoisi(sfWebRequest $request) {

        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $id = $params['id'];
            if ($id) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT gouvernera.id as id , gouvernera.gouvernera as libelle "
                        . " FROM gouvernera"
                        . " WHERE gouvernera.id_pays = " . $id;
                $villes = $conn->fetchAssoc($query);

                die(json_encode($villes));
            }
        }die('Erreur');
    }

    public function executePopupCompteDossier(sfWebRequest $request) {
        $dossier_id = $request->getParameter('dossier_id_compte');
        $this->type = $request->getParameter('type');
        $this->comptes = PlanDossierComptableTable::getInstance()->findByDossierOrder($dossier_id);
        switch ($this->type) {
            case 'attente':
                $this->compte_id = DossiercomptableTable::getInstance()->find($dossier_id)->getCompteAttenteId();
                break;
            case 'vente':
                $this->compte_id = DossiercomptableTable::getInstance()->find($dossier_id)->getCompteVenteId();
                break;
            case 'achat':
                $this->compte_id = DossiercomptableTable::getInstance()->find($dossier_id)->getCompteAchatId();
                break;

            default:
                $this->compte_id = DossiercomptableTable::getInstance()->find($dossier_id)->getCompteAttenteId();
                break;
        }
    }

    public function executeSaveCompteDossier(sfWebRequest $request) {
        $dossier_id = $request->getParameter('dossier_id_compte');
        $this->type = $request->getParameter('type');
        $compte_id = $request->getParameter('compte_id');
        $dossier = DossiercomptableTable::getInstance()->find($dossier_id);
        switch ($this->type) {
            case 'attente':
                $dossier->setIdCompteattente($compte_id);
                break;
            case 'vente':
                $dossier->setIdComptevente($compte_id);
                break;
            case 'achat':
                $dossier->setIdCompteachat($compte_id);
                break;

            default:
                $dossier->setIdCompteattente($compte_id);
                break;
        }
        $dossier->save();
    }

    public function executeImporterPlan(sfWebRequest $request) {
        
    }

    public function executeGoPlanExcel(sfWebRequest $request) {
        $tmp_name = $_FILES['lib_fichier']['tmp_name'];
        $name = $_FILES['lib_fichier']['name'];

        $url_fichier = "uploads/import/" . $name;
        move_uploaded_file($tmp_name, $url_fichier);

        $this->url_fichier = $url_fichier;
        $this->name = $name;
    }

    public function executeSavePlanComptable(sfWebRequest $request) {
        $code = $request->getParameter('code');
        $classe = $request->getParameter('classe');
        $libelle = $request->getParameter('libelle');
        $code = explode(';', $code);
        $classe = explode(';', $classe);
        $libelle = str_replace("'", "''", $libelle);
        $libelle = explode(';;', $libelle);
        $values = '';
        $standard = 0;
        $trouve = 0;
        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');

//        die($_SESSION['dossier_id']);

        for ($i = 0; $i < sizeof($code); $i++) {
            if ($code[$i] != '') {

                $plancomptable = PlancomptableTable::getInstance()->findOneByNumerocompteAndIdDossier($code[$i], $_SESSION['dossier_id']);

                if ($plancomptable && sizeof($plancomptable) > 0) {
                    $trouve = 1;
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                    $query_update = "UPDATE public.plancomptable"
                            . " SET libelle= '" . $libelle[$i] . "'"
                            . " , standard = " . $standard
                            . " where trim(numerocompte) = '" . $code[$i] .
                            "' and id_dossier = " . $_SESSION['dossier_id']
                            . ";";
                    $resultat_update = $conn->fetchAssoc($query_update);
                } else {
                    $trouve = 0;

                    if ($values == '')
                        $values = $values . '(';
                    else
                        $values = $values . ', (';

                    $values = $values . "'" . $code[$i] . "','" . $libelle[$i] . "','" . date('Y-m-d')
                            . "'," . $classe[$i] . "," . $_SESSION['dossier_id'] . "," . $user->getId() . "," . $standard;
                    $values = $values . ')';
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                }
            }
        }
        if ($trouve == 0) {
            $query_insert = "INSERT INTO plancomptable(numerocompte, libelle, date, id_classe, id_dossier, id_user,standard)
                            VALUES " . $values . ";";

            $resultat = $conn->fetchAssoc($query_insert);
        }

        die('OK');
    }

//  public function executeSavePlanDossierComptable(sfWebRequest $request) {
//        $soldeD = $request->getParameter('soldeD');
//        $soldeC = $request->getParameter('soldeC');
//        $code = $request->getParameter('code');
//        $libelle = $request->getParameter('libelle');
//        $code_parent = $request->getParameter('code_parent');
//        $soldeD = explode(';', $soldeD);
//        $soldeC = explode(';', $soldeC);
//        $code = explode(';', $code);
//        $code_parent = explode(';', $code_parent);
//        $libelle = str_replace("'", "''", $libelle);
//        $libelle = explode(';;', $libelle);
////  die(json_encode($libelle));
//        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//        $values = '';
//        $chinae = '';
//
//       
//        for ($i = 0; $i < sizeof($code); $i++) {
//             $solde[$i] = 0;
//        $typesolde = 0;
//            if ($code[$i] != '') {
//                $planDossierComptable = PlandossiercomptableTable::getInstance()->findByNumerocompteAndIdDossier($code[$i], $_SESSION['dossier_id']);
//
//
//                if (sizeof($planDossierComptable) != 0) {
//
//                    if ($soldeD[$i]) {
//                        $solde[$i] = $soldeD[$i];
//                        $typesolde = 1;
//                    } else {
//                        $soldeD[$i] = 0.000;
//                    }
//                    if ($soldeC[$i]) {
//                        $solde[$i] = $soldeC[$i];
//                        $typesolde = 2;
//                    } else {
//                        $soldeC[$i] = 0.000;
//                    }
//                    if ($code_parent[$i] != '') {
////update id_compte dans le table plancomptable
//                        $query_update = "UPDATE public.plancomptable"
//                                . " SET typesolde= " . $typesolde . ""
//                                . ", id_compte= (select id from plancomptable"
//                                . " where trim(numerocompte) = '" . $code_parent[$i] .
//                                "' and id_dossier = " . $_SESSION['dossier_id'] .
//                                " limit 1) WHERE trim(numerocompte) = '" . $code[$i] .
//                                "' AND id_dossier = " . $_SESSION['dossier_id'] . ";";
//                        $resultat_update = $conn->fetchAssoc($query_update);
//                        $query_update_plan_dossier = "UPDATE public.plandossiercomptable"
//                                . " SET libelle= '" . $libelle[$i] . "'"
//                                . ", typesolde= " . $typesolde . ","
//                                . " soldeouv = " . $solde[$i]
//                                . " where trim(numerocompte) = '" . $code[$i] .
//                                "' and id_dossier = " . $_SESSION['dossier_id']
//                                . ";";
//                        $resultat_update = $conn->fetchAssoc($query_update_plan_dossier);
//                    }
//                } else {
//
//                    if ($values == '')
//                        $values = $values . '(';
//                    else {
//                        $values = $values . ', (';
//                    }
//                    $chinae .='solded=' . $soldeD[$i] . '$soldeC[$i]=' . $soldeC[$i];
//                    if ($soldeD[$i]) {
//                        $solde[$i] = $soldeD[$i];
//                        $typesolde = 1;
//                    } else {
//                        $soldeD[$i] = 0.000;
//                    }
//                    if ($soldeC[$i]) {
//                        $solde[$i] = $soldeC[$i];
//                        $typesolde = 2;
//                    } else {
//                        $soldeC[$i] = 0.000;
//                    }
//
//                    $values = $values . "'" . $code[$i] . "','" . $libelle[$i] .
//                            "','" . date('Y-m-d') . "','" . $solde[$i] . "',"
//                            . $typesolde . "," .
//                            $_SESSION['dossier_id'] . "," .
//                            $_SESSION['exercice_id'] . ", "
//                            . "(select id from plancomptable where trim(numerocompte) = '"
//                            . $code[$i]
//                            . "' and id_dossier = " . $_SESSION['dossier_id'] . " limit 1)";
//                    $values = $values . ')';
////               //Insertion des comptes comptables dans le table plandossiercomptable
//
//                    $query = "INSERT INTO plandossiercomptable(numerocompte,libelle, date, soldeouv,typesolde,id_dossier, id_exercice, id_plan)
//                	VALUES " . $values . ";";
//                    $resultat = $conn->fetchAssoc($query);
//                }
//            }
//        }
//
//        die('OK');
//    }

    public function executeSavePlanDossierComptable(sfWebRequest $request) {
        $solde = $request->getParameter('solde');
        $code = $request->getParameter('code');
        $libelle = $request->getParameter('libelle');
        $code_parent = $request->getParameter('code_parent');
        $solde = explode(';', $solde);
        $code = explode(';', $code);
        $code_parent = explode(';', $code_parent);
        $libelle = str_replace("'", "''", $libelle);
        $libelle = explode(';;', $libelle);
        $trouve = 2;
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

        $values = '';
        for ($i = 0; $i < sizeof($code); $i++) {
            if ($code[$i] != '') {

                $planDossierComptable = PlandossiercomptableTable::getInstance()->findByNumerocompteAndDossierAndExercice($code[$i], $_SESSION['dossier_id'], $_SESSION['exercice_id']);
//                die($_SESSION['exercice_id'].'ss'.sizeof($planDossierComptable) . 'mm')
                if ($planDossierComptable && sizeof($planDossierComptable) > 0) {
                    $trouve = 1;
                    if ($code[$i] != '') {
                        //update id_compte dans le table plancomptable
                        $query_update = "UPDATE public.plancomptable SET"
                                . " id_compte= (select id from plancomptable "
                                . "where trim(numerocompte) = '" . $code[$i] .
                                "' and id_dossier = " . $_SESSION['dossier_id'] .
                                " limit 1) WHERE trim(numerocompte) = '" . $code[$i] .
                                "' AND id_dossier = " . $_SESSION['dossier_id'] . ";";
                        $resultat_update = $conn->fetchAssoc($query_update);
                        $query_update_plan_dossier = "UPDATE public.plandossiercomptable"
                                . " SET libelle= '" . $libelle[$i] . "'"
                                . " where trim(numerocompte) = '" . $code[$i] .
                                "' and id_dossier = " . $_SESSION['dossier_id']
                                . ";";
                        $resultat_update = $conn->fetchAssoc($query_update_plan_dossier);
                    }
                } else {
                    $trouve = 0;
                    if ($values == '')
                        $values = $values . '(';
                    else
                        $values = $values . ', (';
                    if (!$solde[$i])
                        $solde[$i] = 0.000;

                    if ($solde[$i] == "")
                        $solde[$i] = 0.000;
                    $values = $values . "'" . $code[$i] . "','" . $libelle[$i] . "','" . date('Y-m-d') . "','" . $solde[$i] . "'," . $_SESSION['dossier_id'] . "," . $_SESSION['exercice_id'] . ", (select id from plancomptable where trim(numerocompte) = '" . $code[$i] . "' and id_dossier = " . $_SESSION['dossier_id'] . " limit 1)";
                    $values = $values . ')';
                    //Insertion des comptes comptables dans le table plandossiercomptable
//                    die($values);
                }
            }
        }

        if ($trouve == 0) {
            $query = "INSERT INTO plandossiercomptable(numerocompte, libelle, date, solde, id_dossier, id_exercice, id_plan)
	VALUES "
                    . $values . ";";
//die($values);
            $resultat = $conn->fetchAssoc($query);
        }

        die('OK');
    }

//save forme juridique 


    public function executeAjouterForme(sfWebRequest $request) {
        $forme = FormejuridiqueTable::getInstance()->findByLibelle($request->getParameter('new_libelle'));
        if ($forme->count() != 0) {
            return $this->renderText('existe');
        } else {
            $forme = new

                    Formejuridique();
            $forme->setLibelle($request->getParameter('new_libelle'));
            $forme->save();
            $this->liste = FormejuridiqueTable::getInstance()->getAllOrder();
        }
    }

    public function executeAjouterActivite(sfWebRequest $request) {
        $Activivte = ActivitetiersTable::getInstance()->findByLibelle($request->getParameter('new_libelle'));
        if ($Activivte->count() != 0) {
            return $this->renderText('existe');
        } else {
            $Activivte = new Activitetiers();

            $Activivte->setLibelle($request->getParameter('new_libelle'));
            $Activivte->save();
            $this->activites = ActivitetiersTable::getInstance()->getAllByOrder();
        }
    }

    public function executeAjouterSecteurActivite(sfWebRequest $request) {
        $Secteuractivivte = SecteuractiviteTable::getInstance()->findByLibelle($request->getParameter('new_libelle'));
        if ($Secteuractivivte->count() != 0) {
            return $this->renderText('existe');
        } else {
            $Secteuractivivte = new Secteuractivite();
            $Secteuractivivte->setLibelle($request->getParameter('new_libelle'));
            $Secteuractivivte->save();
            $this->Secteuractivivte = SecteuractiviteTable::getInstance()->getAllByOrder();
        }
    }

    //existance du dossier 
    public function executeTestcodedossiercomptable(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $code = $params['code'];

            $dossier = new Dossiercomptable();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT dossiercomptable.id as id, dossiercomptable.code as code "
                    . " FROM dossiercomptable"
                    . " WHERE trim(dossiercomptable.code) =" . "'" . $code . "'";

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

//ajouter forme et lafficher ds une combobox
//    public function executeSaveforme(sfWebRequest $request) {
//        header('Access-Control-Allow-Origin: *');
//        $params = array();
//        $content = $request->getContent();
//        if (!empty($content)) {
//            $params = json_decode($content, true);
//            $libelle = $params['libelle'];
//
//            $forme = new Formejuridique();
////                $q = Doctrine_Query::create()
////                        ->select("*")
////                        ->from('Formejuridique');
//            if ($libelle != "") {
////                    $q = $q->where("libelle like '%" . $libelle . "%'");
//                $forme->setLibelle($libelle);
//                $forme->save();
//                $query = "SELECT Formejuridique.id as id, Formejuridique.libelle as libelle "
//                        . " FROM Formejuridique";
//                $resultat = $conn->fetchAssoc($query);
//                die(json_encode($resultat));
////                die($forme->getId());
//            }
//
//
//
////            $forme = FormejuridiqueTable::getInstance()->findByLibelle($request->getParameter($libelle));
////            if ($forme->count() != 0) {
////                return $this->renderText('existe');
////            } else {
////                $forme = new Formejuridique();
////                $forme->setLibelle($request->getParameter($libelle));
////                $forme->save();
////            $liste = FormejuridiqueTable::getInstance()->findAll();
////            $liste = Doctrine_Core::getTable('Formejuridique')->findAll();
////            $libelle = $liste->getLibelle();
////            die($libelle);
//        }
//    }

    public function executeSaveforme(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $libelle = $params['libelle'];
            $forme = FormejuridiqueTable::getInstance()->findByLibelle($libelle);
            if ($forme->count() != 0) {
                return $this->renderText('existe');
            } else {
                $forme = new Formejuridique();
                $forme->setLibelle($libelle);
                $forme->save();
            }
            $query = "SELECT Formejuridique.id as id, Formejuridique.libelle as libelle "
                    .
                    " FROM Formejuridique";
            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }
        die('Erreur d\'ajout');
    }

    //affichage periode de l'exericice

    public function executeAffichedetailexercice(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_exercie = $params['id_exercie'];

            $Exercice = new Exercice();
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT exercice.id as id,  exercice.date_debut as dated, exercice.date_fin as datef "
                    .
                    " FROM exercice"
                    . " WHERE exercice.libelle ='" . $id_exercie . "'";

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    public function executeUploadfichicer(sfWebRequest $request) {
        
    }

    //delete dossier
//    public function executeDelete(sfWebRequest $request) {
//        $id = $request->getParameter('id');
//        $dossier = DossiercomptableTable::getInstance()->find($id);
////        $dosserexercice = Dossierexercice();
//        $id_dossierexercice = DossierexerciceTable::getInstance()->getId($id);
//        DossierexerciceTable::getInstance()->deleteByDossier($id_dossierexercice);
//
//        DossierexerciceutilisateurTable::getInstance()->deleteByDossier();
//
//        $dossier->delete();
//
//        $pager = $this->paginate($request);
//        return $this->renderPartial("dossier/liste", array("pager" => $pager));
//    }

    public function executeDelete(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $dossier = DossiercomptableTable::getInstance()->find($id);
//        $dossierexercice = DossierexerciceTable::getInstance()->findByIdDossier($id);
//        $id_dossierexercice = $dossierexercice->getFirst()->getId();
//        die($id_dossierexercice->getId() . 'size');
//        DossierexerciceutilisateurTable::getInstance()->deleteByDossier($id_dossierexercice);
//        DossierexerciceTable::getInstance()->deleteByDossier($dossierexercice->getIdExercice());
        Doctrine_Query::create()->delete('Dossierexerciceutilisateur')
                ->where('id_dossierexercice in (select id from dossierexercice where id_dossier= ' . $id . ')')->execute();
        Doctrine_Query::create()->delete('Dossierexercice')
                ->where('id_dossier=' . $id)->execute();
//        $dossier->delete();
        Doctrine_Query::create()->delete('Referentielcomptable')
                ->where('id_dossier=' . $id)->execute();
        $plancomptable_new = PlancomptableTable::getInstance()->findByIdDossier($id);

        $client = ClientTable::getInstance()->findByIdDossier($id);
        $fournissuer = FournisseurTable::getInstance()->findByIdDossier($id);
        if (sizeof($plancomptable_new) > 1 || sizeof($client) > 1 || sizeof($fournissuer) > 1) {
            die("erreur");
        } else {
            $dossier->delete();
            $pager = $this->paginate($request);
            return $this->renderPartial("dossier/liste_partial", array("pager" => $pager));
        }
    }

}
