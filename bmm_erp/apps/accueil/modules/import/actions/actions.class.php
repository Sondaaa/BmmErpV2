<?php


/**
 * import actions.
 *
 * @package    Commercial
 * @subpackage import
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class importActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
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

    public function executeParcategorie(sfWebRequest $request) {
        if ($request->getParameter('imp')) {
            if ($request->getParameter('imp') == "categorie") {
                $this->importCategorie();
            }
        }
    }

    public function importCategorie() {
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

    public function importCodec() {
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

    public function importMode() {
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

    public function importTaux() {
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

    public function executeParemplacment(sfWebRequest $request) {
        if ($request->getParameter('imp')) {
            if ($request->getParameter('imp') == "emplacment") {
                $this->importEmplacement();
            }
        }
    }

    public function importEmplacement() {
        if (isset($_FILES['lib_fichier']['tmp_name'])) {
            $tmp_name = $_FILES['lib_fichier']['tmp_name'];
            $name = $_FILES['lib_fichier']['name'];

            move_uploaded_file($tmp_name, "uploads/import/" . $name);
            $arrLines = file('uploads/import/' . $name);

            $ArrayColumn = explode(";", $arrLines[0]);



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

    public function executeParimmob(sfWebRequest $request) {
        if ($request->getParameter('imp')) {
            if ($request->getParameter('imp') == "immob") {
                $this->importImmobilisation();
            }
        }
    }

    public function importImmobilisation() {
      
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

    public function importCategorie2($arrResult1, $arrResult2, $arrResult3) {
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

    public function importEmplacement2($line) {

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
        }else {
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

}
