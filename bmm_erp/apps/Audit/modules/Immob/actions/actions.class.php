<?php

/**
 * Immob actions.
 *
 * @package    Commercial
 * @subpackage Immob
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ImmobActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->immobilisations = Doctrine_Core::getTable('immobilisation')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->immobilisation = Doctrine_Core::getTable('immobilisation')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->immobilisation);
        if ($request->getParameter('page')) {
            return $this->renderPartial('Immob/impression', array('immobilisation' => $this->immobilisation));
        }
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new immobilisationForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new immobilisationForm();

        $this->processForm($request, $this->form, 'on');

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($immobilisation = Doctrine_Core::getTable('immobilisation')->find(array($request->getParameter('id'))), sprintf('Object immobilisation does not exist (%s).', $request->getParameter('id')));
        $this->form = new immobilisationForm($immobilisation);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($immobilisation = Doctrine_Core::getTable('immobilisation')->find(array($request->getParameter('id'))), sprintf('Object immobilisation does not exist (%s).', $request->getParameter('id')));
        $this->form = new immobilisationForm($immobilisation);
        $check = "off";
        if ($request->getParameter('check'))
            $check = $request->getParameter('check');

        $this->processForm($request, $this->form, $check);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($immobilisation = Doctrine_Core::getTable('immobilisation')->find(array($request->getParameter('id'))), sprintf('Object immobilisation does not exist (%s).', $request->getParameter('id')));
        $immobilisation->delete();

        $this->redirect('Immob/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form, $check) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $user =  $this->getUser()->getAttribute('userB2m');

        if ($form->isValid()) {
            $immo = new Immobilisation();
            $taux2 = 0;

            if ($request->getParameter('id')) {
                $immo123 = new Immobilisation();
                $immoverif = Doctrine_Core::getTable('immobilisation')->findOneById($request->getParameter('id'));
                $immo123 = $immoverif;
                $taux2 = $immo123->getTauxammor2();
            }
            //die($form->getObject()->getIdFournisseur().'hh');
            $immobilisation = $form->save();
            //die($request->getParameter('idfrs').'hh');
            if ($request->getParameter('idfrs') != "-1") {
                $immobilisation->setIdFournisseur($request->getParameter('idfrs'));
                $immobilisation->save();
            }
            if ($request->getParameter('sourcefinancement')) {
                $sourcef = new Sourcesfinancemment();
                $source = Doctrine_Core::getTable('sourcesfinancemment')->findOneBySourcefinancement($request->getParameter('sourcefinancement'));
                if ($source) {
                    $sourcef = $source;
                }
                $sourcef->setSourcefinancement($request->getParameter('sourcefinancement'));
                $sourcef->save();
                $immobilisation->setSourcefinancement($sourcef->getId());
            }
            if ($taux2 != 0) {
                $immobilisation->setTauxammor2($taux2);
                $immobilisation->save();
            }
            if ($check == "on") {
                $immo = $immobilisation;
                $empl = new Emplacement();
                $emplacement = Doctrine_Core::getTable('emplacement')->findByIdImmo($immo->getId());
                if (count($emplacement) > 0) {

                    $empl->setIdImmo($immo->getId());
                    $empl->setDateaffectation(date("Y-m-d"));
                    $empl->setIdPays($immo->getIdPays());
                    $empl->setIdGouvernera($immo->getIdGouvernera());
                    $empl->setIdSite($immo->getIdSite());
                    $empl->setIdEtage($immo->getIdEtage());
                    $empl->setIdUser($immo->getIdAgent());
                    $empl->setAdresse("Transfert");
                    //_______recherche reference
                    $codebarre = $immo->getReference() . '11' . $immo->getIdBureaux();
                    $emplacement_filter = Doctrine_Core::getTable('emplacement')->findByReference($codebarre);
                    //die(count($emplacement_filter)."hh");
                    if (count($emplacement_filter) > 0)
                        $codebarre = $emplacement[count($emplacement) - 1]->getReference() + 1;
                    $empl->setReference($codebarre);

                    $empl->setIdBureau($immo->getIdBureaux());
                    $empl->save();
                }
                else {
                    $immobilisation->setDatecreation(date("Y-m-d"));
                    $immobilisation->save();
                    $empl->setDateaffectation(date("Y-m-d"));
                    $empl->setIdPays($immo->getIdPays());
                    $empl->setIdGouvernera($immo->getIdGouvernera());
                    $empl->setIdSite($immo->getIdSite());
                    $empl->setIdEtage($immo->getIdEtage());
                    $empl->setIdUser($immo->getIdAgent());
                    $empl->setAdresse("Affectation");
                    $empl->setIdImmo($immo->getId());
                    $empl->setIdBureau($immo->getIdBureaux());
                    //_______recherche reference
                    $codebarre = $immo->getReference() . '00' . $immo->getIdBureaux();
                    $emplacement_filter = Doctrine_Core::getTable('emplacement')->findByReference($codebarre);
                    if (count($emplacement_filter) > 0)
                        $codebarre = $codebarre + "" + count($emplacement_filter) + 1;
                    $empl->setReference($codebarre);
                    $empl->save();
                }
            }
            //____________________________mis a jour fichier batrimoine
            $datemiasajour = date("Y-m-d");
            $immobilisation->setDatemisajour($datemiasajour);
            $user = new Utilisateur();
            $user =  $this->getUser()->getAttribute('userB2m');
            if ($user->getRole()->getId() != "1")
                $immobilisation->setEtat(0);
            $immobilisation->save();
            // $immobilisation->setDa
            if ($user->getRole()->getId() == 3)
                $this->redirect('immobilisation/new?msg=' . $immobilisation . '&meth=0');
            $this->redirect('immobilisation/edit?id=' . $immobilisation->getId() . '&msg=' . $immobilisation . '&meth=1');
        }
    }

    public function executeChargerTaux(sfWebRequest $request) {
        $idimmobilisation = $_REQUEST['idimmobilisation'];
        $immobilisation_ajour = new Immobilisation();
        if ($idimmobilisation != "-1") {
            $immobilisation = Doctrine_Core::getTable('immobilisation')->findOneById($idimmobilisation);
            if (isset($_REQUEST['mode'])) {
                $mode = $_REQUEST['mode'];

                $modeamoortisment = Doctrine_Core::getTable('modeammortisement')->findOneById($mode);

                if ($immobilisation) {
                    $immobilisation_ajour = $immobilisation;
                    $immobilisation_ajour->setModeamortisement($modeamoortisment->getId());
                    $immobilisation_ajour->setTauxammor2($modeamoortisment->getValeurmode());
                    $immobilisation_ajour->save();
                    if ($modeamoortisment->getId() == 4) {
                        $tauxammortisment = Doctrine_Core::getTable('tauxammortisement')->findOneById(2);
                        $immobilisation_ajour->setTauxammortisement($tauxammortisment);
                        $immobilisation_ajour->setTauxammor2('100');
                        $immobilisation_ajour->save();
                        return $this->renderText('100%');
                    }
                    if ($modeamoortisment->getId() == 5) {
                        $immobilisation_ajour->setTauxammor2('0');
                        $immobilisation_ajour->save();
                        return $this->renderText('0');
                    }
                }

                return $this->renderText('ok');
            } else {
                $immobilisation_ajour = $immobilisation;

                $taux = Doctrine_Core::getTable('tauxammortisement')->findOneById($_REQUEST['taux']);
                $immobilisation_ajour->setTauxammortisement($taux);
                $immobilisation_ajour->save();

                $taux_ammo1 = str_replace(",", ".", $immobilisation_ajour->getTauxammortisement()->getTauxammortisement());
                $taux1 = number_format(str_replace("%", "", $taux_ammo1) / 100, 4);
                // die('ff'.$_REQUEST['taux']."hh".$immobilisation_ajour->getModeammortisement()->getId());
                if ($_REQUEST['taux'] != 2)
                    $immobilisation_ajour->setTauxammor2($taux1 * $immobilisation_ajour->getModeammortisement()->getValeurmode());
                else {
                    $immobilisation_ajour->setTauxammortisement(null);
                    $immobilisation_ajour->save();
                    return $this->renderText("erreur");
                }
                $immobilisation_ajour->save();
                die('hh' . $immobilisation_ajour->getModeammortisement());
                return $this->renderText("ok");
            }
        }
    }

    public function executeListeDes(sfWebRequest $request) {

        header('Access-Control-Allow-Origin: *');
        $des = split(" ", $request->getParameter('desc'));

        $q = Doctrine_Query::create()
                ->select('*')
                ->from('immobilisation f')
                ->where("designation like '%" . $des[0] . "%'")
                ->orderBy('id desc')
                ->offset(0)
                ->limit(20);

        $frs = $q->fetchArray();
        $data = '{';
        $data.='"entities":';
        $data.='[';
        $l = count($frs);

        for ($i = 0; $i < $l; $i++) {
            $a = $frs[$i];
            $id = $a['id'];
            $immo = new Immobilisation();
            $immobilisation = Doctrine_Core::getTable('immobilisation')->findOneById($id);
            $immo = $immobilisation;
            $nom = $a['designation'];

            if ($i == $l - 1) {
                $data.='{"famille":"' . $immo->getIdFamille() . '","sousfamille":"' . $immo->getIdSousfamille() . '","categorie":"' . $immo->getIdCategorie() . '","nom":"' . $nom . '"}';
            } else {
                $data.='{"famille":"' . $immo->getIdFamille() . '","sousfamille":"' . $immo->getIdSousfamille() . '","categorie":"' . $immo->getIdCategorie() . '","nom":"' . $nom . '"},';
            }
        }

        $data.=']';
        $data.='}';
        die($data);
    }

    public function executeListesourcef(sfWebRequest $request) {

        header('Access-Control-Allow-Origin: *');
        $des = $request->getParameter('sourcef');

        $q = Doctrine_Query::create()
                ->select('*')
                ->from('sourcesfinancemment f');

        $frs = $q->fetchArray();
        $data = '{';
        $data.='"entities":';
        $data.='[';
        $l = count($frs);

        for ($i = 0; $i < $l; $i++) {
            $a = $frs[$i];
            $id = $a['id'];
            $source = $a['sourcefinancement'];

            if ($i == $l - 1) {
                $data.='{"id":"' . $id . '","source":"' . $source . '"}';
            } else {
                $data.='{"id":"' . $id . '","source":"' . $source . '"},';
            }
        }

        $data.=']';
        $data.='}';
        die($data);
    }

    public function executeTransfer(sfWebRequest $request) {
        
    }

    public function executeRechercheb(sfWebRequest $request) {
        $bur = $request->getParameter('idb');
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('emplacement b')
                ->where('id_bureau=' . $bur)
                ->GroupBy('id_bureau');

        $bureaux = $q->fetchArray();
        $data = '{';
        $data.='"entities":';
        $data.='[';
        $l = count($bureaux);

        for ($i = 0; $i < $l; $i++) {
            $a = $bureaux[$i];
            $id_immob = $a['id_immo'];
            $id = $a['id_bureau'];
            $immob = Doctrine_Core::getTable('immobilisation')->findOneById($id_immob);
            $adresse = "";
            if ($immob)
                $adresse = $immob->getAdresse();
            if ($i == $l - 1) {
                $data.='{"adr":"' . $adresse . '","idb":"' . $id . '", "idp":"' . $a['id_pays'] . '","idg":"' . $a['id_gouvernera'] . '","ids":"' . $a['id_site'] . '","ide":"' . $a['id_etage'] . '","idu":"' . $a['id_user'] . '"}';
            } else {
                $data.='{"adr":"' . $adresse . '","idb":"' . $id . '", "idp":"' . $a['id_pays'] . '","idg":"' . $a['id_gouvernera'] . '","ids":"' . $a['id_site'] . '","ide":"' . $a['id_etage'] . '","idu":"' . $a['id_user'] . '"},';
            }
        }

        $data.=']';
        $data.='}';
        die($data);
    }

    public function executeListeBureauxd(sfWebRequest $request) {
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('bureaux b');

        $bureaux = $q->fetchArray();
        $data = '{';
        $data.='"entities":';
        $data.='[';
        $l = count($bureaux);

        for ($i = 0; $i < $l; $i++) {
            $a = $bureaux[$i];
            $id = $a['id'];
            $bureau_req = Doctrine_Core::getTable('bureaux')->findOneById($id);
            $nom = $bureau_req;

            if ($i == $l - 1) {
                $data.='{"id":"' . $id . '", "nom":"' . $nom . '"}';
            } else {
                $data.='{"id":"' . $id . '","nom":"' . $nom . '"},';
            }
        }

        $data.=']';
        $data.='}';
        die($data);
    }

    public function executeListeUser(sfWebRequest $request) {
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('agents b');

        $bureaux = $q->fetchArray();
        $data = '{';
        $data.='"entities":';
        $data.='[';
        $l = count($bureaux);

        for ($i = 0; $i < $l; $i++) {
            $a = $bureaux[$i];
            $id = $a['id'];

            $nom = $a['nomcomplet'];

            if ($i == $l - 1) {
                $data.='{"id":"' . $id . '", "nom":"' . $nom . '"}';
            } else {
                $data.='{"id":"' . $id . '","nom":"' . $nom . '"},';
            }
        }

        $data.=']';
        $data.='}';
        die($data);
    }

    public function executeListeArticleByBureauxd(sfWebRequest $request) {

        $codebu = $request->getParameter('codebu');
        $q = Doctrine_Query::create()
                ->select('*')
                ->from(' immobilisation b')
                ->where('id_bureaux=' . $codebu);
        $articles = $q->fetchArray();
        $data = '{';
        $data.='"entities":';
        $data.='[';
        $l = count($articles);

        for ($i = 0; $i < $l; $i++) {
            $a = $articles[$i];
            $id = $a['id'];
            // $immob=Doctrine_Core::getTable('immobilisation')->findOneById($id);
            $nom = $a['designation'];

            if ($i == $l - 1) {
                $data.='{"id":"' . $id . '", "nom":"' . $nom . '"}';
            } else {
                $data.='{"id":"' . $id . '","nom":"' . $nom . '"},';
            }
        }

        $data.=']';
        $data.='}';
        die($data);
    }

    public function executeValiderTransfer(sfWebRequest $request) {
        $listearticle = $request->getParameter('listearticle');
        $table = explode("*", $listearticle);
        for ($i = 0; $i < count($table); $i++) {
            $ligne = explode("-", $table[$i]);
            if ($ligne[0]) {
                $emplacement = new Emplacement();
                $emplacement->setIdImmo($ligne[0]);

                //recherche immobilsation
                $immob = Doctrine_Core::getTable('immobilisation')->findOneById($ligne[0]);
                $codebarre = $immob->getReference() . '11' . $ligne[2];

                $emplacement->setReference($codebarre);
                $emplacement->setDateaffectation(date("Y-m-d"));
                //rechreche etage
                $bureaux = Doctrine_Core::getTable('bureaux')->findOneById($ligne[1]);
                $emplacement->setIdEtage($bureaux->getIdEtage());
                $emplacement->setAdresse("Transfert");
                //recherche site
                $etage = Doctrine_Core::getTable('etage')->findOneById($bureaux->getIdEtage());
                $emplacement->setIdSite($etage->getIdSite());
                $emplacement->setIdUser($ligne[3]);
                $emplacement->setIdPays($immob->getIdPays());
                $emplacement->setIdGouvernera($immob->getIdGouvernera());
                $emplacement->setIdBureau($ligne[2]);
                $emplacement->save();
            }
        }
        die('bien');
    }

    public function executeListeAgents(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $raison = strtoupper($params['raison']);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            if ($raison != '') {
                $query = "SELECT id , nomcomplet as name "
                        . " FROM agents"
                        . " WHERE UPPER(nomcomplet) LIKE '%" . $raison . "%' "
                        . " ORDER BY nomcomplet";
            } else {
                $query = "SELECT id , nomcomplet as name "
                        . " FROM agents"
                        . " ORDER BY nomcomplet";
            }
            $liste_agents = $conn->fetchAssoc($query);

            die(json_encode($liste_agents));
        }

        die("Erreur");
    }

    public function executeListeBureauxdepart(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $bureau = strtoupper($params['bureau']);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            if ($bureau != '') {
                $query = "SELECT id , CONCAT(code, ' ', bureau) as name "
                        . " FROM bureaux"
                        . " WHERE UPPER(bureau) LIKE '%" . $bureau . "%' "
                        . " ORDER BY bureau";
            } else {
                $query = "SELECT bureaux.id as id , CONCAT(bureaux.code, ' ', bureaux.bureau) as name "
                        . " FROM bureaux"
                        . " ORDER BY bureaux.bureau";
            }
            $liste_bureaux = $conn->fetchAssoc($query);

            die(json_encode($liste_bureaux));
        }

        die("Erreur");
    }

    public function executeListeArticleByBureauxDepart(sfWebRequest $request) {

        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idbd = $params['idbd'];
            $designation = strtoupper($params['designation']);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            if ($designation != '') {
                $query = "SELECT id , designation as name "
                        . " FROM immobilisation"
                        . " WHERE UPPER(designation) LIKE '%" . $designation . "%' "
                        . " AND id_bureaux = " . $idbd
                        . " ORDER BY designation";
            } else {
                $query = "SELECT id , designation as name "
                        . " FROM immobilisation"
                        . " WHERE id_bureaux = " . $idbd
                        . " ORDER BY designation";
            }
            $liste_bureaux = $conn->fetchAssoc($query);

            die(json_encode($liste_bureaux));
        }

        die("Erreur");
    }

}
