<?php

require_once dirname(__FILE__) . '/../lib/PrototypeGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/PrototypeGeneratorHelper.class.php';

/**
 * Prototype actions.
 *
 * @package    symfony
 * @subpackage Prototype
 * @author     Your name here
 * @version    SVN: $Id$
 */
class PrototypeActions extends autoPrototypeActions
{

    public function executeAjoutercategorie(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $libelle = $params['libelle'];

            $categ = new Categorietitre();
            $categorie = CategorietitreTable::getInstance()->getbylibelle($libelle);

            if (count($categorie) > 0 && $categorie) {
                $categ = $categorie;
            }

            $categ->setLibelle($libelle);
            $categ->save();
            $listes = Doctrine_Query::create()
                ->select("*")
                ->from('Categorietitre');

            $listes = $listes->fetchArray();
            die(json_encode($listes));
        }
        die('Erreur d\'ajout');
    }

    public function executeAjouterprojet(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $libelle = $params['libelle'];
            $site = $params['site'];
            $sous_site = $params['sous_site'];
            $proj = new Projet();
            $projet = ProjetTable::getInstance()->getbylibelle($libelle, $site, $sous_site);

            if (count($projet) > 0 && $projet) {
                $proj = $projet;
            }
            if ($site) {
                $proj->setidSite($site);
            }

            if ($sous_site) {
                $proj->setIdSoussite($sous_site);
            }

            if ($libelle) {
                $proj->setLibelle($libelle);
            }

            $proj->save();
            $listes = Doctrine_Query::create()
                ->select("*")
                ->from('projet');

            $listes = $listes->fetchArray();
            die(json_encode($listes));
        }
        die('Erreur d\'ajout');
    }

    public function executeAffichesoussite(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idsite = $params['idsite']; 
            if ($idsite) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT etage.id as id ,
                concat (etage.code , ' ', etage.etage )as libelle "
                    . " FROM etage"
                    . " WHERE etage.id_site= " . $idsite;
                $resultat = $conn->fetchAssoc($query);
                die(json_encode($resultat));
            }
        }

        die("Erreur");
    }
    public function executeImportbudget(sfWebRequest $request)
    {
    }

    public function executeGoBudgetExcel(sfWebRequest $request)
    {
        $tmp_name = $_FILES['lib_fichier']['tmp_name'];
        $name = $_FILES['lib_fichier']['name'];

        $url_fichier = "uploads/import/" . $name;
        move_uploaded_file($tmp_name, $url_fichier);

        $this->url_fichier = $url_fichier;
        $this->name = $name;
    }
    public function executeSaveBudget(sfWebRequest $request)
    {
        $params = array();
        $content = $request->getContent();
        $params = json_decode($content, true);
        $sources = $params['source'];
        $categorie = $params['categorie'];
        $rubrique = $params['rubrique'];
        $sous_rubrique = $params['sous_rubrique'];
        $projet = $params['projet'];
        $responsable = $params['responsable'];

        $sources = explode(';', $sources);
        $categorie = explode(';', $categorie);
        $rubrique = explode(";", $rubrique);
        $sous_rubrique = explode(';', $sous_rubrique);
        $projet = explode(';', $projet);
        $responsable = explode(';', $responsable);

        $user = new Utilisateur();
        $user = $this->getUser()->getAttribute('userB2m');
        for ($i = 0; $i <= sizeof($sources); $i++) {
            if (!empty($sources[$i])) {
                $source_budget = new Sourcesbudget();
                $source_budget_table = SourcesbudgetTable::getInstance()->findOneBySource($sources[$i]);
                if ($source_budget_table) {
                    $source_budget = $source_budget_table;
                } else {
                    $source_budget->setSource($sources[$i]);
                    $source_budget->save();
                }
                $categorie_titre = new Categorietitre();
                $categorie_table = CategorietitreTable::getInstance()->findOneByLibelle($categorie[$i]);
                if ($categorie_table) {
                    $categorie_titre = $categorie_table;
                } else {
                    $count_categorie = Doctrine_Core::getTable('Categorietitre')->createQuery('q')->count() + 1;
                    $categorie_titre->setLibelle($categorie[$i]);
                    $categorie_titre->setId($count_categorie);
                    $categorie_titre->save();
                }
                if($responsable[$i])
                $responsable_agent = AgentsTable::getInstance()->findOneByIdrh($responsable[$i]);
                $projet_titre = new Projet();
                $projet_table = ProjetTable::getInstance()->findOneByLibelle($projet[$i]);
                if ($projet_table) {
                    $projet_titre = $projet_table;
                } else {
                    $projet_titre->setLibelle($projet[$i]);
                    if($responsable[$i] && $responsable_agent)
                    $projet_titre->setResponsableProjet($responsable_agent->getId());
                    $projet_titre->save();
                }
               

                $titre = new Titrebudjet();
                $titre_table = TitrebudjetTable::getInstance()->findOneByIdSourceAndIdCatAndIdProjet($source_budget->getId(), $categorie_titre->getId(), $projet_titre->getId());
                if ($titre_table) {
                    $titre = $titre_table;
                } else {

                    $titre->setIdUser($user->getId());
                    $titre->setIdSource($source_budget->getId());
                    $titre->setIdCat($categorie_titre->getId());
                    $titre->setIdProjet($projet_titre->getId());
                    if ($responsable[$i] && $responsable_agent) {
                        $titre->setResponsableId($responsable_agent->getId());
                    }

                    $titre->setTypebudget('Prototype');
                    $titre->setDatecreation(date('Y-m-d'));
                    $titre->setLibelle($categorie_titre->getLibelle());
                    $titre->setEtatbudget(1);
                    $titre->save();
                }

                $rubrique_budget = new Rubrique();
                $rubrique_name=explode('/',$rubrique[$i]);
                $libelle=$rubrique_name[0];
                
                $code=$rubrique_name[1];
                $rubrique_table = RubriqueTable::getInstance()->findOneByCode($code);
                if ($rubrique_table) {
                    $rubrique_budget = $rubrique_table;
                } else {
                    $rubrique_budget->setLibelle($libelle);
                    $rubrique_budget->setCode($code);
                    $rubrique_budget->save();
                }
                $ligne = new Ligprotitrub();
                $ligne_table = LigprotitrubTable::getInstance()->findOneByIdTitreAndIdRubrique($titre->getId(), $rubrique_budget->getId());
                if (!$ligne_table) {
                    $ligne->setIdTitre($titre->getId());
                    $ligne->setIdRubrique($rubrique_budget->getId());
                    $ligne->setCode($rubrique_budget->getCode());
                    $ligne->save();
                }
                if (!empty($sous_rubrique[$i])) {
                    $sous_rubrique_budget = new Rubrique();
                    $name_sous_rubrique=explode('/',$sous_rubrique[$i]);
                    $libelle_sous_rubrique=$name_sous_rubrique[0];
                    $code_sous_rubrique=$name_sous_rubrique[1];
                    $sous_rubrique_table = RubriqueTable::getInstance()->findOneByCodeAndIdRubrique($code_sous_rubrique, $rubrique_budget->getId());
                    if ($sous_rubrique_table) {
                        $sous_rubrique_budget = $sous_rubrique_table;
                    } else {
                        $sous_rubrique_budget->setLibelle($libelle_sous_rubrique);
                        
                        $sous_rubrique_budget->setCode($code_sous_rubrique);
                        $sous_rubrique_budget->setIdRubrique($rubrique_budget->getId());
                        $sous_rubrique_budget->save();
                    }
                    $ligne = new Ligprotitrub();
                    $ligne_table = LigprotitrubTable::getInstance()->findOneByIdTitreAndIdRubrique($titre->getId(), $sous_rubrique_budget->getId());
                    if (!$ligne_table) {
                        $ligne->setIdTitre($titre->getId());
                        $ligne->setIdRubrique($sous_rubrique_budget->getId());
                        $ligne->setCode($sous_rubrique_budget->getCode());
                        $ligne->save();
                    }
                }
            }
        }
        $this->getResponse()->setContentType('text/json');

        return $this->renderText(json_encode(array(
            "msg" => "OK",
        )));
    }
    protected function buildQuery()
    {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);
        $query = $this->filters->buildQuery($this->getFilters());

        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();
        $query = $query->AndWhere("typebudget  like '%Prototype%'")->OrderBy('id desc');

        return $query;
    }
    public function executeDelete(sfWebRequest $request)
    {
        $id = $request->getParameter('id', "");
        $doc_budget = TitrebudjetTable::getInstance()->find($id);

        Doctrine_Query::create()
            ->delete('recapbudget')
            ->where('id_ligrubtitre in (select id from  ligprotitrub where id_titre=' . $id . ')')->execute();

        Doctrine_Query::create()
            ->delete('recapdeponse')
            ->where('id_titre=' . $id)->execute();
        Doctrine_Query::create()
            ->delete('situationcumulee')
            ->where('id_titre=' . $id)->execute();
        Doctrine_Query::create()
            ->delete('Lignebanquecaisse')
            ->where('id_budget in (select id from  ligprotitrub where id_titre=' . $id . ')')->execute();
        Doctrine_Query::create()
            ->delete('ligprotitrub')
            ->where('id_titre=' . $id)->execute();
        Doctrine_Query::create()
            ->delete('tranchebudget')
            ->where('id_titrebudget=' . $id)->execute();

        $query = Doctrine_Query::create()
            ->delete('titrebudjet')
            ->where('id=' . $id);
        $query = $query->execute();

        $this->redirect('@titrebudjet');

    }
}
