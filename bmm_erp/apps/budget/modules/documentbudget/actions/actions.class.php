
<?php

require_once dirname(__FILE__) . '/../lib/documentbudgetGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/documentbudgetGeneratorHelper.class.php';

/**
 * documentbudget actions.
 *
 * @package    Bmm
 * @subpackage documentbudget
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class documentbudgetActions extends autoDocumentbudgetActions {

//
    public function executeNewordenanace(sfWebRequest $request) {
        $this->form = new DocumentbudgetForm();
        $this->documentbudget = $this->form->getObject();
    }

    public function executeNewordenanaceparfour(sfWebRequest $request) {
        $this->form = new DocumentbudgetForm();
        $this->documentbudget = $this->form->getObject();
    }

    public function executeNewordonancehorsBCI(sfWebRequest $request) {
        $this->form = new DocumentbudgetForm();
        $this->documentbudget = $this->form->getObject();
        $this->id = $request->getParameter('id');
        $this->documentbudgetdefinitif = DocumentbudgetTable::getInstance()->findOneById($this->id);
        $this->documentachat = null;
        $piece = PiecejointbudgetTable::getInstance()->findOneByIdDocumentbudget($this->id);
        if ($piece && $piece->getIdDocachat()) {
            $this->documentachat = DocumentachatTable::getInstance()->findOneById($piece->getIdDocachat());
        }
    }

    public function executeOrdonnancefournisseur(sfWebRequest $request) {
        $this->form = new DocumentbudgetForm();
        $this->form_achat = new DocumentachatForm();
        $this->documentbudget = $this->form->getObject();
    }

    public function executeAffichelistesengagementfournisseur(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            if ($id) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT  piecejointbudget.id as idpi,documentachat.numero, "
                        . "typedoc.prefixetype, LPAD(documentachat.numero::text, 7, '0') as numero, "
                        . "typedoc.libelle, documentachat.mntttc, documentachat.id as iddocachat, "
                        . " documentbudget.id as iddocbu, documentbudget.numero as numero_engagement "
                        . "FROM  piecejointbudget, documentachat, typedoc, ligprotitrub, documentbudget, lignemouvementfacturation "
                        . "WHERE piecejointbudget.id_docachat = documentachat.id "
                        . "AND lignemouvementfacturation.id_documentachat = documentachat.id "
                        . "AND lignemouvementfacturation.valide = true "
                        . "AND lignemouvementfacturation.id_documentachat IN (SELECT documentachat.id_docparent FROM documentachat WHERE documentachat.id_docparent IS NOT NULL AND documentachat.etatdocachat IS NULL) "
                        . "AND piecejointbudget.id_documentbudget = documentbudget.id "
                        . "AND documentachat.id_typedoc = typedoc.id and documentbudget.id_type =1 "
                        . "AND documentachat.id_frs = " . $id . " "
                        . "AND documentbudget.id_budget = ligprotitrub.id "
                        . "AND documentbudget.annule = false "
                        . "AND documentbudget.id not in "
                        . "(select documentbudget.id from documentbudget,piecejointbudget where documentbudget.id_type=2 "
                        . "and documentbudget.id!=piecejointbudget.id_documentbudget) "
                        . "AND documentbudget.id not in "
                        . "(select COALESCE(documentbudget.id_documentbudget, 0) from documentbudget where documentbudget.id_type=2 "
                        . "and annule = false ) "
                        . "AND documentachat.id_docparent not in "
                        . "(select documentachat.id from documentachat,piecejointbudget where "
                        . " documentachat.id=piecejointbudget.id_docachat)";

                $titresBudget = $conn->fetchAssoc($query);
                die(json_encode($titresBudget));
            }
        }
        die('Erreur');
    }

    public function executeGetListeFactureOrdonnance(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $query = "SELECT piecejointbudget.id as idpi, "
                . "typedoc.prefixetype as type, LPAD(documentachat.numero::text, 7, '0') as numero, "
                . "documentachat.id as id, documentachat.mntttc, fournisseur.rs as rs "
                . "FROM  piecejointbudget, fournisseur, documentachat, typedoc, ligprotitrub, documentbudget, lignemouvementfacturation "
                . "WHERE piecejointbudget.id_docachat = documentachat.id "
                . "AND lignemouvementfacturation.id_documentachat = documentachat.id "
                . "AND documentachat.id_frs = fournisseur.id "
                . "AND lignemouvementfacturation.valide = true"
                . "  AND lignemouvementfacturation.etatfrs = '1' "
                . " AND  documentachat.id_contrat  IS  NULL   "
                . " AND lignemouvementfacturation.id_documentachat IN 
                (SELECT documentachat.id_docparent FROM documentachat 
                WHERE documentachat.id_docparent IS NOT NULL 
                AND documentachat.etatdocachat IS NULL) "
                . " and piecejointbudget.id_docachat = documentachat.id "
                . "AND piecejointbudget.id_documentbudget = documentbudget.id "
                . "AND documentachat.id_typedoc = typedoc.id"
                . " and documentbudget.id_type =1 "
                . " AND documentbudget.id_budget = ligprotitrub.id "
                . " AND documentbudget.annule = false "
                . "AND documentachat.id_etatdoc = 29 "
                . "AND documentachat.id not in "
                . " (select id_docparent from documentachat  where id_typedoc <> 16 )"
                //. "AND documentbudget.id not in "
                //  . "(select documentbudget.id from documentbudget,piecejointbudget "
                //. "where documentbudget.id_type=2 "
                //  . "and documentbudget.id <> piecejointbudget.id_documentbudget) "
                . "AND documentbudget.id not in "
                . "(select COALESCE(documentbudget.id_documentbudget, 0) from documentbudget "
                . "where documentbudget.id_type=2 "
                . "and annule = false ) "
                //                . "AND documentachat.id_docparent not in "
                //                . "(select documentachat.id from documentachat,piecejointbudget where "
                //                . " documentachat.id=piecejointbudget.id_docachat)"
                . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
                . " order by documentachat.id desc ";
        //die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListeFactureOrdonnancejeton(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $query = '  SELECT piecejointbudget.id as idpi,documentachat.id as id , typedoc.prefixetype as type
                 , documentachat.numero as numero,documentachat.id as id_docachat, documentachat.mntttc as mntttc ,'
                . '    fournisseur.rs as rs'
                . '  FROM piecejointbudget, fournisseur, documentachat, typedoc, ligprotitrub, documentbudget'
                . '  WHERE piecejointbudget.id_docachat = documentachat.id'
                . '  AND documentachat.id_frs = fournisseur.id '
                . '  AND documentachat.id_contrat IS  NULL '
                . ' and documentachat.id_typedoc = 16 '
//                . " AND documentachat.id  in "
//                . " (select id_docparent from documentachat  where id_typedoc = 16 )"
                . '  AND documentachat.id_etatdoc =  77'
                . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
                . ' AND documentbudget.id not in '
                . '(select COALESCE(documentbudget.id_documentbudget, 0) from documentbudget '
                . 'where documentbudget.id_type=2 '
                . 'and annule = false ) '
//                . ' and lignemouvementfacturation.id_documentachat = documentachat.id'
//                . ' and  documentachat.id_lignemouvementfacturation is null'
                . ' AND piecejointbudget.id_documentbudget = documentbudget.id '
                . ' AND documentachat.id_typedoc = typedoc.id '
                . ' and documentbudget.id_type =1 '
                . '  AND documentbudget.id_budget = ligprotitrub.id'
//                . ' and documentachat.id NOT IN(select id_facture from facturecomptableachat where facturecomptableachat.id_facture=documentachat.id)'
//                . ' group by piecejointbudget.id, typedoc.prefixetype, documentachat.numero, lignemouvementfacturation.id, lignemouvementfacturation.montant,
//                    fournisseur.rs, documentachat.id
                . ' order by documentachat.id desc ';
        //   die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListeFactureOrdonnanceBDCR(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $query = "SELECT documentachat.id as id, typedoc.prefixetype as type, 
                    LPAD(documentachat.numero::text, 7, '0') as numero,
                    documentachat.id as id, documentachat.montanttotlafacture"
                . " FROM documentachat, typedoc"
                . " WHERE documentachat.id_typedoc = typedoc.id"
                . "  AND documentachat.id_typedoc =22"
                . "  AND documentachat.id_etatdoc = 69"
                . " order by documentachat.id desc  ";
        //        die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListeFactureOrdonnanceBDCG(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $query = "SELECT documentachat.id as id, piecejointbudget.id as idpi, typedoc.prefixetype as type,"
                . " LPAD(documentachat.numero::text, 7, '0') as numero, documentachat.id as id,"
                . " documentachat.mntttc, fournisseur.rs as rs"
                . " FROM piecejointbudget, fournisseur, documentachat, "
                . " typedoc, ligprotitrub, documentbudget, lignemouvementfacturation "
                . " WHERE piecejointbudget.id_docachat = documentachat.id_docparent"
                . "  AND lignemouvementfacturation.id_documentachat = documentachat.id_docparent"
                . " AND documentachat.id_frs is  not null"
                . "  and documentachat.id_frs=fournisseur.id"
                . " AND lignemouvementfacturation.valide = true"
                . " AND lignemouvementfacturation.id_documentachat "
                . "  AND lignemouvementfacturation.etatfrs = '1' "
                . "IN (SELECT documentachat.id_docparent  FROM documentachat"
                . "   WHERE documentachat.id_docparent IS NOT NULL"
                . "  AND documentachat.etatdocachat IS NULL)"
                . "AND piecejointbudget.id_documentbudget = documentbudget.id "
                . "AND documentachat.id_typedoc = typedoc.id"
                . "  AND documentachat.id_typedoc =15"
                . " and documentbudget.id_type =1 "
                . " AND documentbudget.id_budget = ligprotitrub.id "
                . "   AND documentbudget.annule = false "
                . "    AND documentachat.id_etatdoc = 29"
                . " order by documentachat.id desc  ";
        //        die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListeFactureOrdonnanceContrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $query = 'SELECT piecejointbudget.id as idpi, typedoc.prefixetype as type, documentachat.numero as numero,documentachat.id as id_docachat, 
                    lignemouvementfacturation.id as id, lignemouvementfacturation.montant as mntttc, fournisseur.rs as rs'
                . ' FROM piecejointbudget, fournisseur, documentachat, typedoc, ligprotitrub, documentbudget, lignemouvementfacturation '
                . '  WHERE piecejointbudget.id_docachat = documentachat.id'
                . '   AND documentachat.id_frs = fournisseur.id '
                . ' AND lignemouvementfacturation.valide = true'
                . " AND lignemouvementfacturation.etatfrs = '1' "
                . '  AND documentachat.id_contrat IS NOT NULL '
                . ' and documentachat.id_typedoc <> 6'
                . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
                . ' and lignemouvementfacturation.id_documentachat = documentachat.id_docparent'
                //.'and lignemouvementfacturation.id=documentachat.id_lignemouvementfacturation '
                . ' and documentachat.id not in (select piecejointbudget.id_docachat
                    from piecejointbudget where piecejointbudget.id_docachat=documentachat.id
		    and piecejointbudget.id_type is null )'
                . ' AND documentbudget.id not in '
                . '(select COALESCE(documentbudget.id_documentbudget, 0) from documentbudget '
                . 'where documentbudget.id_type=2 '
                . 'and annule = false ) '
                . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
                . ' AND piecejointbudget.id_documentbudget = documentbudget.id '
                . '   AND documentachat.id_typedoc = typedoc.id '
                . '   and documentbudget.id_type =1 '
                . '    AND documentbudget.id_budget = ligprotitrub.id'
                //                . ' and documentachat.id NOT IN(select id_facture from facturecomptableachat
                //                 where facturecomptableachat.id_facture=documentachat.id)'
                . ' group by piecejointbudget.id, typedoc.prefixetype, documentachat.numero, lignemouvementfacturation.id, lignemouvementfacturation.montant, fournisseur.rs, documentachat.id
        order by documentachat.id desc ';
        //           die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeGetListeFactureOrdonnanceBCIContrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $query = '  SELECT piecejointbudget.id as idpi, typedoc.prefixetype as type, documentachat.numero as numero,documentachat.id as id_docachat, 
                    lignemouvementfacturation.id as id, lignemouvementfacturation.montant as mntttc, fournisseur.rs as rs'
                . '  FROM piecejointbudget, fournisseur, documentachat, typedoc, ligprotitrub, documentbudget, lignemouvementfacturation '
                . '  WHERE piecejointbudget.id_docachat = documentachat.id'
                . '  AND documentachat.id_frs = fournisseur.id '
                . '  AND lignemouvementfacturation.valide = true'
                . "  AND lignemouvementfacturation.etatfrs = '1' "
                . '  AND documentachat.id_contrat IS NOT NULL '
                . '  AND documentachat.id_typedoc =  6'
                . " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
                . ' AND documentbudget.id not in '
                . '(select COALESCE(documentbudget.id_documentbudget, 0) from documentbudget '
                . 'where documentbudget.id_type=2 '
                . 'and annule = false ) '
                . ' and lignemouvementfacturation.id_documentachat = documentachat.id'
                . ' and  documentachat.id_lignemouvementfacturation is null'
                . ' AND piecejointbudget.id_documentbudget = documentbudget.id '
                . ' AND documentachat.id_typedoc = typedoc.id '
                . ' and documentbudget.id_type =1 '
                . '  AND documentbudget.id_budget = ligprotitrub.id'
                . ' and documentachat.id NOT IN(select id_facture from facturecomptableachat where facturecomptableachat.id_facture=documentachat.id)'
                . ' group by piecejointbudget.id, typedoc.prefixetype, documentachat.numero, lignemouvementfacturation.id, lignemouvementfacturation.montant, fournisseur.rs, documentachat.id
        order by documentachat.id desc ';
        // die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $parcc = $conn->fetchAssoc($query);
        die(json_encode($parcc));
    }

    public function executeAffichelistesengagement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id'];
            if ($id) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT piecejointbudget.id as idpi, documentachat.numero, "
                        . "typedoc.prefixetype, LPAD(documentachat.numero::text, 6, '0') as numero, "
                        . "typedoc.libelle, documentachat.mntttc, documentachat.id as iddocachat, "
                        . " documentbudget.id as iddocbu, documentbudget.numero as numero_engagement "
                        . "FROM piecejointbudget, documentachat, typedoc, ligprotitrub, documentbudget, lignemouvementfacturation "
                        . "WHERE piecejointbudget.id_docachat = documentachat.id "
                        . "AND lignemouvementfacturation.id_documentachat = documentachat.id "
                        . "AND lignemouvementfacturation.valide = true "
                        . "AND piecejointbudget.id_documentbudget = documentbudget.id "
                        . "AND documentachat.id_typedoc = typedoc.id AND documentbudget.id_type = 1 "
                        . "AND documentbudget.id_budget = ligprotitrub.id "
                        . "AND documentbudget.annule = false "
                        . "AND ligprotitrub.id = " . $id . " and documentbudget.id not in "
                        . "(select documentbudget.id from documentbudget, piecejointbudget where documentbudget.id_type = 2 "
                        . "and documentbudget.id!=piecejointbudget.id_documentbudget) "
                        . "AND documentbudget.id not in "
                        . "(select COALESCE(documentbudget.id_documentbudget, 0) from documentbudget where documentbudget.id_type = 2 and annule = 'false' ) "
                        . "AND documentachat.id_docparent not in "
                        . "(select documentachat.id from documentachat, piecejointbudget where "
                        . " documentachat.id = piecejointbudget.id_docachat)";
                //                        . " GROUP BY (documentbudget.id)";
                //die($query);
                $titresBudget = $conn->fetchAssoc($query);

                die(json_encode($titresBudget));
            }
        }
        die('Erreur');
    }

    public function executeIndex(sfWebRequest $request) {

        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }
        $idtype = 1;
        if (isset($_REQUEST['idtype']))
            $idtype = $_REQUEST['idtype'];
        $this->pager = $this->getPager($idtype);
        $this->sort = $this->getSort();
        $this->idtype = $idtype;
    }

    public function executeChargerparent(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();
        $array = [];
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_rubrique = $params['id_rubrique'];
            $ligne = $params['ligne'];
            if ($ligne == 'ligne') {
                $lignebudget = LigprotitrubTable::getInstance()->findOneById($id_rubrique);
                if ($lignebudget) {
                    $rubriques = RubriqueTable::getInstance()->findOneById($lignebudget->getIdRubrique());
                    if ($rubriques && $rubriques->getIdRubrique()) {
                        $rubrique_parent = RubriqueTable::getInstance()->findOneById($rubriques->getIdRubrique());
                        if ($rubrique_parent) {
                            $ligneParent = LigprotitrubTable::getInstance()->findOneByIdRubriqueAndIdTitre($rubrique_parent->getId(), $lignebudget->getIdTitre());
                            $array = ['id_rubrique' => $ligneParent->getId(), 'libelle' => $lignebudget->getCode()];
                        } else
                            $array = ['id_rubrique' => $rubriques->getId(), 'libelle' => 'liste_rubrique'];
                    }
                }
            }
        }
        return $this->renderText(json_encode($array));
    }

    public function executeAffichesourceTransfertBudget(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $table = $params['table'];

            if ($table == "titrebudjet") {
                $id = $params['id'];
                if ($id) {
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                    $query = "SELECT ligprotitrub.id, ligprotitrub.nordre, ligprotitrub.code, "
                            . " rubrique.libelle, ligprotitrub.mnt, "
                            . " ligprotitrub.mntengage, ligprotitrub.mntdeponser, "
                            . " ligprotitrub.mntencaisse, mntprovisoire, ligprotitrub.mntretire as mntretire,"
                            . " ligprotitrub.mntexterne as mntexterne "
                            . " FROM ligprotitrub, rubrique "
                            . " WHERE ligprotitrub.id_rubrique = rubrique.id "
                            . " AND ligprotitrub.id_titre = " . $id . " "
                            //                            . " and rubrique.id not in (select rb.id from rubrique rb
                            //                              where rb.id_rubrique is  null and (select count(*)
                            //                              from rubrique r where rb.id=r.id_rubrique) >= 1
                            //                              order by id,libelle desc)"
                            . " order by ligprotitrub.nordre asc";
                    //  die($query);
                    $titresBudget = $conn->fetchAssoc($query);

                    die(json_encode($titresBudget));
                }
            }
        }
        die('Erreur');
    }

    public function executeAffichesourceParamCompte(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $table = $params['table'];

            if ($table == "titrebudjet") {
                $id = $params['id'];
                if ($id) {
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                    $query = "SELECT ligprotitrub.id, ligprotitrub.nordre, ligprotitrub.code, "
                            . " rubrique.libelle, ligprotitrub.mnt, "
                            . " ligprotitrub.mntengage, ligprotitrub.mntdeponser, "
                            . " ligprotitrub.mntencaisse, mntprovisoire, ligprotitrub.mntretire as mntretire,"
                            . " ligprotitrub.mntexterne as mntexterne "
                            . " FROM ligprotitrub, rubrique "
                            . " WHERE ligprotitrub.id_rubrique = rubrique.id "
                            . " AND ligprotitrub.id_titre = " . $id . " "
//                            . " and rubrique.id not in (select rb.id from rubrique rb
//                              where rb.id_rubrique is  null and (select count(*)
//                              from rubrique r where rb.id=r.id_rubrique) >= 1
//                              order by id,libelle desc)"
                            . " order by ligprotitrub.nordre asc";
                    //  die($query);
                    $titresBudget = $conn->fetchAssoc($query);

                    die(json_encode($titresBudget));
                }
            }
        }die('Erreur');
    }

    public function executeAffichesourceEngDEfContrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $table = $params['table'];

            if ($table == "titrebudjet") {
                $id = $params['id'];
                if ($id) {
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                    $query = "SELECT ligprotitrub.id, ligprotitrub.nordre, ligprotitrub.code, "
                            . " rubrique.libelle, ligprotitrub.mnt, "
                            . " ligprotitrub.mntengage, ligprotitrub.mntdeponser, "
                            . " ligprotitrub.mntencaisse, mntprovisoire, ligprotitrub.mntretire as mntretire,"
                            . " ligprotitrub.mntexterne as mntexterne "
                            . " FROM ligprotitrub, rubrique "
                            . " WHERE ligprotitrub.id_rubrique = rubrique.id "
                            . " AND ligprotitrub.id = " . $id . " "
                            . " order by ligprotitrub.nordre asc";
                    //  die($query);
                    $titresBudget = $conn->fetchAssoc($query);

                    die(json_encode($titresBudget));
                }
            }
        }die('Erreur');
    }

    public function executeAffichesourceBDC(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $table = $params['table'];

            if ($table == "titrebudjet") {
                $id = $params['id'];
                if ($id) {
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                    $query = "SELECT ligprotitrub.id, ligprotitrub.nordre, ligprotitrub.code, "
                            . " rubrique.libelle, ligprotitrub.mnt, "
                            . " ligprotitrub.mntengage, ligprotitrub.mntdeponser, "
                            . " ligprotitrub.mntencaisse, mntprovisoire, ligprotitrub.mntretire as mntretire,"
                            . " ligprotitrub.mntexterne as mntexterne "
                            . " FROM ligprotitrub, rubrique "
                            . " WHERE ligprotitrub.id_rubrique = rubrique.id "
                            . " AND ligprotitrub.id_titre = " . $id . " "
//                            . " and rubrique.id not in (select rb.id from rubrique rb
//                              where rb.id_rubrique is  null and (select count(*)
//                              from rubrique r where rb.id=r.id_rubrique) >= 1
//                              order by id,libelle desc)"
                            . " order by ligprotitrub.nordre asc";
                    //  die($query);
                    $titresBudget = $conn->fetchAssoc($query);

                    die(json_encode($titresBudget));
                }
            }
        }die('Erreur');
    }

    public function executeAffichesource(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $table = 'titrebudjet';
            $param_filter = $params['rubrique'];
            $titresBudget = [];
            if ($table == "titrebudjet") {
                $id = $params['id'];
                if ($id) {
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                    if ($param_filter == 'liste_rubrique')
                        $query = "SELECT ligprotitrub.id, ligprotitrub.nordre, ligprotitrub.code, "
                                . " rubrique.libelle, ligprotitrub.mnt, "
                                . " ligprotitrub.mntengage, ligprotitrub.mntdeponser, "
                                . " ligprotitrub.mntencaisse, mntprovisoire "
                                . " FROM ligprotitrub, rubrique "
                                . " WHERE ligprotitrub.id_rubrique = rubrique.id and rubrique.id_rubrique is null "
                                . " AND ligprotitrub.id_titre = " . $id . " "
                                //                            . " and rubrique.id not in (select rb.id from rubrique rb
                                //                              where rb.id_rubrique is  null and (select count(*)
                                //                              from rubrique r where rb.id=r.id_rubrique) >= 1
                                //                              order by id,libelle desc)"
                                . " order by ligprotitrub.nordre asc";
                    else {
                        $ligne_rubrique = LigprotitrubTable::getInstance()->findOneByCodeAndIdTitre(trim($param_filter), $id);

                        if ($ligne_rubrique) {
                            $query = "SELECT ligprotitrub.id, ligprotitrub.nordre, ligprotitrub.code, "
                                    . " rubrique.libelle, ligprotitrub.mnt, "
                                    . " ligprotitrub.mntengage, ligprotitrub.mntdeponser, "
                                    . " ligprotitrub.mntencaisse, mntprovisoire "
                                    . " FROM ligprotitrub, rubrique "
                                    . " WHERE ligprotitrub.id_rubrique = rubrique.id"
                                    . " AND ligprotitrub.id_titre = " . $id . " "
                                    . " AND rubrique.id_rubrique='" . $ligne_rubrique->getIdRubrique() . "'"
                                    //                            . " and rubrique.id not in (select rb.id from rubrique rb
                                    //                              where rb.id_rubrique is  null and (select count(*)
                                    //                              from rubrique r where rb.id=r.id_rubrique) >= 1
                                    //                              order by id,libelle desc)"
                                    . " order by ligprotitrub.nordre asc";
                            // die($query);
                        }
                    }

                    //  die($query);
                    if ($query && $query != '')
                        $titresBudget = $conn->fetchAssoc($query);

                    die(json_encode($titresBudget));
                }
            }
        }
        die('Erreur');
    }

    public function executeAffichesourceContrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $table = $params['table'];

            if ($table == "titrebudjet") {
                $id = $params['id'];
                if ($id) {
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                    $query = "SELECT ligprotitrub.id, ligprotitrub.nordre, ligprotitrub.code, "
                            . " rubrique.libelle, ligprotitrub.mnt, "
                            . " ligprotitrub.mntengage, ligprotitrub.mntdeponser, "
                            . " ligprotitrub.mntencaisse, mntprovisoire "
                            . " FROM ligprotitrub, rubrique "
                            . " WHERE ligprotitrub.id_rubrique = rubrique.id "
                            . " AND ligprotitrub.id_titre = " . $id . " "
                            . " and rubrique.id not in (select rb.id from rubrique rb
                              where rb.id_rubrique is  null and (select count(*)
                              from rubrique r where rb.id=r.id_rubrique) >= 1
                              order by id,libelle desc)"
                            . " order by ligprotitrub.nordre asc";
                    //  die($query);
                    $titresBudget = $conn->fetchAssoc($query);

                    die(json_encode($titresBudget));
                }
            }
        }
        die('Erreur');
    }

    public function executeEngagement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();
        if (!empty($content)) {

            $params = json_decode($content, true);
            $lists = $params['list'];

            return $this->renderPartial('Documents/rubriquebudget', array('listdoc' => $lists));
        }
    }

    public function executeAfficheBudgetByExercice(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $annees = $params['exercice'];

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT * "
                    . " FROM titrebudjet "
                    . "WHERE Etatbudget = 2 "
                    . "AND trim(typebudget) not like trim('Prototype') "
                    . "AND trim(typebudget) like trim('Exercice:" . $annees . "') "
                    . "order by id asc";
            $titresBudget = $conn->fetchAssoc($query);

            die(json_encode($titresBudget));
        }
        die('Erreur');
    }

    public function executeAffichesourceParentOrFils(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $table = $params['table'];

            if ($table == "titrebudjet") {
                $id = $params['id'];
                if ($id) {
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                    $query = "SELECT ligprotitrub.id, ligprotitrub.code as nordre, "
                            . " rubrique.libelle, ligprotitrub.mnt, "
                            . " ligprotitrub.mntengage, ligprotitrub.mntdeponser, "
                            . " ligprotitrub.mntencaisse, mntprovisoire "
                            . " FROM ligprotitrub, rubrique "
                            . "WHERE ligprotitrub.id_rubrique = rubrique.id "
                            . "AND ligprotitrub.id_titre = " . $id . " "
                            //. "AND ligprotitrub.id NOT IN"
                            //                            . " (SELECT ligprotitrub.id FROM ligprotitrub where ligprotitrub.id_rubrique "
                            //                            . "IN (SELECT rubrique.id_rubrique FROM rubrique WHERE rubrique.id_rubrique IS NOT NULL)) "
                            . "order by id asc";
                    $titresBudget = $conn->fetchAssoc($query);

                    die(json_encode($titresBudget));
                }
            }
        }
        die('Erreur');
    }

    public function executeAffichedetail(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $id = $params['id'];
            if ($id) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT ligprotitrub.id, ligprotitrub.nordre, "
                        . " TRIM(rubrique.libelle) as libelle, ligprotitrub.mnt, "
                        . " ligprotitrub.mntengage, ligprotitrub.mntdeponser, "
                        . "ligprotitrub.mntencaisse, ligprotitrub.mntprovisoire,ligprotitrub.mntexterne , ligprotitrub.mntretire  "
                        . " FROM ligprotitrub, rubrique "
                        . "WHERE ligprotitrub.id_rubrique = rubrique.id "
                        . "AND ligprotitrub.id = " . $id;
                $titresBudget = $conn->fetchAssoc($query);

                die(json_encode($titresBudget));
            }
        }
        die('Erreur');
    }

    //Chargerbce
    public function executeChargerbce(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $id = $params['id'];
            if ($id) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT documentachat.id,
                    CONCAT(typedoc.prefixetype, documentachat.numero) as numero, documentachat.mntttc
                   FROM documentachat, typedoc
                   WHERE documentachat.id_typedoc = typedoc.id
                   AND documentachat.id_typedoc = 7;
                   ";
                $docachats = $conn->fetchAssoc($query);

                die(json_encode($docachats));
            }
        }
        die('Erreur');
    }

    public function executeSavespiecepreengagementDefinitifSansBCI(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);

            $idtype = $params['idtype'];
            $idtypep = $params['idtypep'];
            $numero = $params['numero'];
            $date = $params['datecreation'];
            if (!$date || $date == '')
                $date = date('Y-m-d');
            $iddocbudget = $params['idbudget'];
            $description = $params['description'];
            $mntttc = floatval($params['mntttc']);
            $id = $params['id'];
            $documentbudget = new Documentbudget();
            if ($id)
                $docb = Doctrine_Core::getTable('documentbudget')->findOneById($id);
            if ($id) {
                if ($docb)
                    $id_docbudget_precedent = $docb->getIdBudget();
            }
            if ($id) {
                if ($docb)
                    $documentbudget = $docb;
            }
            else {
                $documentbudget = new Documentbudget();
            }
            $documentbudget->setIdType($idtype);
            $documentbudget->setNumero($documentbudget->NumeroSeqDocumentAchat($idtype));
            if ($date)
                $documentbudget->setDatecreation($date);
//            else
//                $documentbudget->setDatecreation(date('Y-m-d'));
            if ($description)
                $documentbudget->setDescription($description);
            $documentbudget->setIdBudget($iddocbudget);
            $documentbudget->save();

            $ligne = new Ligprotitrub();
            if ($id) {
                if ($id_docbudget_precedent != $iddocbudget) {
                    $lig_precedenet = Doctrine_Core::getTable('ligprotitrub')->findOneById($id_docbudget_precedent);
                    if ($lig_precedenet->getMntengage())
                        $mntrestant = $lig_precedenet->getMntengage();
                    $relicat = $mntrestant - $mntttc;
                    $lig_precedenet->setMntengage($relicat);
                    $relicat_engager = 0;
                    $relicat_engager = $lig_precedenet->getMnt() - $relicat;
                    $lig_precedenet->setRelicaengager($relicat_engager);
                    $lig_precedenet->save();
                }
            }
            $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($iddocbudget);
            if ($lignesbudgets) {
                $ligne = $lignesbudgets;
                if ($ligne->getMntengage())
                    $mntrestant = $ligne->getMntengage();
                $relicat = $mntrestant + $mntttc;
                $ligne->setMntengage($relicat);
                $relicat_engager = 0;
                $relicat_engager = $ligne->getMnt() - $relicat;
                $ligne->setRelicaengager($relicat_engager);
                $ligne->save();
                $documentbudget->setMnt($mntttc);
                $documentbudget->setMntnet($mntttc);
                $documentbudget->setMntengage(abs($ligne->getMntengage()));
                $relicat = $ligne->getMnt() - $ligne->getMntengage();
                $documentbudget->setMntrelicat($relicat);
                $documentbudget->save();
            }
            $piecej = new Piecejointbudget();
            $piecejoint = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocumentbudget($documentbudget->getId());
            if ($piecejoint && $docb)
                $piecej = $piecejoint;
            $piecej->setIdType(6);
            $piecej->setDescription($description);
            $piecej->setIdDocumentbudget($documentbudget->getId());
            $piecej->save();
            /*             * **********edit recap **************** */
            $mois = date('m');
            if ($mois < 10)
                $mois = intval(substr($mois, -1));
            else
                $mois = intval($mois);
            $recaps = RecapbudgetTable::getInstance()->getByIdLigrubMois($iddocbudget, $mois);
            foreach ($recaps as $recap) :
                $mntttc_recap = $mntttc + $recap->getMntEncager();
                $recap->setMntEncager($mntttc_recap);
                $recap->save();
            endforeach;

            /*             * *******************edit recap parent***************** */
            $id_rubrique = $lignesbudgets->getIdRubrique();
            $rubrique = RubriqueTable::getInstance()->find($id_rubrique);
            if ($rubrique->getIdRubrique()) {
                $mois = date('m');
                if ($mois < 10)
                    $mois = intval(substr($mois, -1));
                else
                    $mois = intval($mois);
                $lig_parent = LigprotitrubTable::getInstance()->findByIdRubriqueAndIdTitre($rubrique->getIdRubrique(), $lignesbudgets->getIdTitre())->getFirst();
                $recaps_parent = RecapbudgetTable::getInstance()->getByIdLigrubMois($lig_parent->getId(), $mois);
                foreach ($recaps_parent as $recapp) :
                    $mntttc_recapparent = $mntttc + $recapp->getMntEncager();
                    $recapp->setMntEncager($mntttc_recapparent);
                    $recapp->save();
                endforeach;
            }
            /*             * **************situation Cumulee************************* */
            $mois = date('m');
            if ($mois < 10)
                $mois = intval(substr($mois, -1));
            else
                $mois = intval($mois);
            $situationcumulles = SituationcumuleeTable::getInstance()->getByIdLigrubMois($iddocbudget, $mois);
            foreach ($situationcumulles as $situation) :
                $mntttc_situation = $mntttc + $situation->getMntEngagement();

                $situation->setMntEngagement($mntttc_situation);
                $situation->save();
            endforeach;
            /*             * **************situation Cumulee parent************************* */
            $id_rubrique = $lignesbudgets->getIdRubrique();
            $rubrique = RubriqueTable::getInstance()->find($id_rubrique);
            if ($rubrique->getIdRubrique()) {
                $lig_parent = LigprotitrubTable::getInstance()->findByIdRubriqueAndIdTitre($rubrique->getIdRubrique(), $lignesbudgets->getIdTitre())->getFirst();
                $mois = date('m');
                if ($mois < 10)
                    $mois = intval(substr($mois, -1));
                else
                    $mois = intval($mois);
                $situationcumulles_parent = SituationcumuleeTable::getInstance()->getByIdLigrubMois($lig_parent->getId(), $mois);
                foreach ($situationcumulles_parent as $situationp) :
                    $mntttc_situation_parent = $mntttc + $situationp->getMntEngagement();

                    $situationp->setMntEngagement($mntttc_situation_parent);
                    $situationp->save();
                endforeach;
            }
            die('bien');
        }

        die('erreuur !!!');
    }

    public function executeSavespiecepreengagement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc_achat = $params['iddoc'];
            $idtype = $params['idtype'];
            $idtypep = $params['idtypep'];
            $numero = $params['numero'];
            $date = $params['datecreation'];
            if (!$date || $date == '')
                $date = date('Y-m-d');
            $iddocbudget = $params['idbudget'];
            $desc = $params['object'];
            $mntttc = $params['mntttc'];
            $doc_achat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
            $doc_achat->setIdEtatdoc(25);
            $doc_achat->save();
            $ligne = new Ligprotitrub();
            $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($iddocbudget);
            //die($lignesbudgets);
            /*             * *********Mis ajour lig rubriique parent*************** */
            if ($lignesbudgets) {
                $id_rubrique = $lignesbudgets->getIdRubrique();
                $rubrique_budget = RubriqueTable::getInstance()->find($id_rubrique);
                if ($rubrique_budget) {
                    if ($rubrique_budget->getIdRubrique() != null) {
                        $id_rubrique_parent = $rubrique_budget->getIdRubrique();
                        //die('e'.$id_rubrique_parent.' '. $lignesbudgets->getIdTitre());
                        $ligp_rubrique_parent = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubriqueAndIdTitre($id_rubrique_parent, $lignesbudgets->getIdTitre());
                        if ($ligp_rubrique_parent) {
                            $mntprov_rubrique_parent = $ligp_rubrique_parent->getMntprovisoire() + $mntttc;
                            $ligp_rubrique_parent->setMntprovisoire($mntprov_rubrique_parent);
                            $ligp_rubrique_parent->save();
                        }
                    }
                }
            }
            //die($lignesbudgets->getId() . 'rr');
            if ($lignesbudgets) {
                $ligne = $lignesbudgets;
                $mnt_provisoire = 0;
                if ($ligne->getMntprovisoire())
                    $mnt_provisoire = $ligne->getMntprovisoire();
                $mnt_provisoire += $mntttc;
                $ligne->setMntprovisoire($mnt_provisoire);
                $ligne->save();
                $doc = new Documentbudget();
                $doc = $doc->NouvelleficheEngagementProvisoire($ligne, $numero, $idtype, $date, $ligne->getId(), $mntttc, $ligne->getMntprovisoire());
                $piecej = new Piecejointbudget();
                $piecej->NouvelleInsertionDocAchatParDocumentBudget($iddoc_achat, $idtypep, $desc, $doc->getId());
            }

            return $this->renderText(json_encode(array(
                        "msg" => "ok"
            )));
        }
    }

    public function executeSavespiecepreengagementDefinitif(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc_achat = $params['iddoc'];
            $idtype = $params['idtype'];
            $idtypep = $params['idtypep'];
            $numero = $params['numero'];
            $date = $params['datecreation'];
            $iddocbudget = $params['idbudget']; //die($iddocbudget.'hh');
            $desc = $params['object'];
            $mntttc = $params['mntttc'];
            $doc_achat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
            $doc_achat->setIdEtatdoc(64);
            $doc_achat->save();

            $documentbudget = new Documentbudget();
            //            $docb = Doctrine_Core::getTable('documentbudget')->findOneByIdBudgetAndIdType($iddocbudget, $idtype);
            //            if ($docb)
            //                $documentbudget = $docb;
            //            else {
            $documentbudget->setIdType($idtype);
            $documentbudget->setNumero($documentbudget->NumeroSeqDocumentAchat($idtype));
            $documentbudget->setDatecreation(date('Y-m-d'));
            $documentbudget->setIdBudget($iddocbudget);
            $documentbudget->save();
            //            }
            $ligne = new Ligprotitrub();
            $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($iddocbudget);

            if ($lignesbudgets) {
                $ligne = $lignesbudgets;
                $ligne->MisAjourMntRubrique($doc_achat);
                $ligne->save();
                $documentbudget->setMnt($doc_achat->getMntttc());
                $documentbudget->setMntnet($doc_achat->getMntttc());
                $documentbudget->setMntengage($ligne->getMntprovisoire());
                $relicat = $ligne->getMnt() - $ligne->getMntprovisoire();
                $documentbudget->setMntrelicat($relicat);
                $documentbudget->save();
            }

            $piecej = new Piecejointbudget();
            $piecejoint = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocumentbudget($iddocbudget);
            if ($piecejoint && $docb)
                $piecej = $piecejoint;
            $piecej->setIdDocachat($iddoc_achat);
            $piecej->setIdType(6);
            $piecej->setDescription($desc);
            $piecej->setIdDocumentbudget($documentbudget->getId()); //die('gg');
            $piecej->save();
            die('bien');
        }

        die('erreuur !!!');
    }

    public function executeSavespiecepreengagementBDCNULL(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc_achat = $params['iddoc'];
            $idtype = $params['idtype'];
            $idtypep = $params['idtypep'];
            $numero = $params['numero'];
            $date = $params['datecreation'];
            $iddocbudget = $params['idbudget']; //die($iddocbudget.'hh');
            $desc = $params['object'];
            $mntttc = $params['mntttc'];
            $doc_achat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
            $doc_achat->setIdEtatdoc(57);
            $doc_achat->save();
            $ligne = new Ligprotitrub();
            $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($iddocbudget);
            /*             * *********Mis ajour lig rubriique parent*************** */
            if ($lignesbudgets) {
                $id_rubrique = $lignesbudgets->getIdRubrique();
                $rubrique_budget = RubriqueTable::getInstance()->find($id_rubrique);
                if ($rubrique_budget) {
                    if ($rubrique_budget->getIdRubrique() != null) {
                        $id_rubrique_parent = $rubrique_budget->getIdRubrique();
                        //die('e'.$id_rubrique_parent.' '. $lignesbudgets->getIdTitre());
                        $ligp_rubrique_parent = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubriqueAndIdTitre($id_rubrique_parent, $lignesbudgets->getIdTitre());
                        if ($ligp_rubrique_parent) {
                            $mntprov_rubrique_parent = $ligp_rubrique_parent->getMntprovisoire() + $mntttc;
                            $ligp_rubrique_parent->setMntprovisoire($mntprov_rubrique_parent);
                            $ligp_rubrique_parent->save();
                        }
                    }
                }
            }

            if ($lignesbudgets) {
                $ligne = $lignesbudgets;
                $mnt_provisoire = 0;
                if ($ligne->getMntprovisoire())
                    $mnt_provisoire = $ligne->getMntprovisoire();
                $mnt_provisoire += $mntttc;
                $ligne->setMntprovisoire($mnt_provisoire);
                $ligne->save();

                $doc = new Documentbudget();
                $doc = $doc->NouvelleficheEngagementProvisoire($ligne, $numero, $idtype, $date, $ligne->getId(), $mntttc, $ligne->getMntprovisoire());

                $piecej = new Piecejointbudget();
                $piecej->NouvelleInsertionDocAchatParDocumentBudget($iddoc_achat, $idtypep, $desc, $doc->getId());
            }

            die('bien');
        }
    }

    public function executeSavespiecepreengagementContrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc_contrat = $params['iddoc'];
            $idtype = $params['idtype'];
            $idtypep = $params['idtypep'];
            $numero = $params['numero'];
            $date = $params['datecreation'];
            $iddocbudget = $params['idbudget']; //die($iddocbudget.'hh');
            $desc = $params['object'];
            $mntttc = $params['mntttc'];
            //            $doc_contrat_achat = Doctrine_Core::getTable('contratachat')->findOneById($iddoc_contrat);
            //            die($iddoc_contrat.'id_conra');
            //            $iddoc_achat = $doc_contrat_achat->getDocumentachat()->getFirst()->getId();
            $doc_achat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_contrat);
            $doc_achat->setIdEtatdoc(37);
            $doc_achat->save();
            $ligne = new Ligprotitrub();
            $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($iddocbudget);

            /*             * *********Mis ajour lig rubriique parent*************** */
            if ($lignesbudgets) {
                $id_rubrique = $lignesbudgets->getIdRubrique();
                $rubrique_budget = RubriqueTable::getInstance()->find($id_rubrique);
                if ($rubrique_budget) {
                    if ($rubrique_budget->getIdRubrique() != null) {
                        $id_rubrique_parent = $rubrique_budget->getIdRubrique();
                        //die('e'.$id_rubrique_parent.' '. $lignesbudgets->getIdTitre());
                        $ligp_rubrique_parent = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubriqueAndIdTitre($id_rubrique_parent, $lignesbudgets->getIdTitre());
                        if ($ligp_rubrique_parent) {
                            $mntprov_rubrique_parent = $ligp_rubrique_parent->getMntprovisoire() + $mntttc;
                            $ligp_rubrique_parent->setMntprovisoire($mntprov_rubrique_parent);
                            $ligp_rubrique_parent->save();
                        }
                    }
                }
            }
            if ($lignesbudgets) {
                $ligne = $lignesbudgets;
                $mnt_provisoire = 0;
                if ($ligne->getMntprovisoire())
                    $mnt_provisoire = $ligne->getMntprovisoire();
                $mnt_provisoire += $mntttc;
                $ligne->setMntprovisoire($mnt_provisoire);
                $ligne->save();

                $doc = new Documentbudget();
                $doc = $doc->NouvelleficheEngagementProvisoire($ligne, $numero, $idtype, $date, $ligne->getId(), $mntttc, $ligne->getMntprovisoire());

                $piecej = new Piecejointbudget();
                $piecej->NouvelleInsertionDocAchatParDocumentBudget($iddoc_contrat, $idtypep, $desc, $doc->getId());
            }

            die('bien');
        }
    }

    public function executeAnnulerEngagementJeton(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['iddoc'];
            $id_documentbudget = $params['idpreengagement'];

            $document_budget = DocumentbudgetTable::getInstance()->find($id_documentbudget);
            $document_budget->setAnnule(true);
            $document_budget->save();
            //engagement définitif
            if ($document_budget->getIdType() == 1) {
                $ligprotitrub = $document_budget->getLigprotitrub();
                $ancien_mntengage = $ligprotitrub->getMntengage();
                $ancien_relicaengager = $ligprotitrub->getRelicaengager();
                $new_mntengage = $ancien_mntengage - $document_budget->getMnt();
                $new_relicaengager = $ancien_relicaengager - $document_budget->getMnt();

                $ligprotitrub->setMntengage($new_mntengage);
                $ligprotitrub->setRelicaengager($new_relicaengager);

                $ligprotitrub->save();
            }
            die('ok');
        } else {
            die('erreur !!! ');
        }
    }

    public function executeValiderengagementJeton(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            //  $id_docbudget = $params['idpreengagement'];
            $iddoc_achat = $params['iddoc'];

            $iddodcbce = $params['iddodcbce'];
            $piecejointb = PiecejointbudgetTable::getInstance()->findByIdDocachat($iddodcbce)->getLast();
            $document_budget_pr = DocumentbudgetTable::getInstance()->find($piecejointb->getIdDocumentbudget());

            $doc_achat = new Documentachat();
            $docachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
            $doc_achat = $docachat;
            $docachat->setIdEtatdoc(77);
            $docachat->save();

            // $idbudget = $params['idbudget'];

            $idtype = $params['idtype'];
            $documentbudget = new Documentbudget();
//            if ($id_docbudget) {
//                $document_budget_pr = DocumentbudgetTable::getInstance()->find($id_docbudget);
//                if ($idbudget)
//                    $idbudget = $idbudget;
//                else
//                    $idbudget = $document_budget_pr->getIdBudget();
//                $docb = Doctrine_Core::getTable('documentbudget')->findOneByIdAndIdType($i_docbudget, $idtype);
//            }

            $documentbudget->setIdType($idtype);
            $documentbudget->setNumero($documentbudget->NumeroSeqDocumentAchat($idtype));
            $documentbudget->setDatecreation(date('Y-m-d'));

            $documentbudget->setIdBudget($document_budget_pr->getIdBudget());
            $documentbudget->save();

            $ligne = new Ligprotitrub();
            $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($document_budget_pr->getIdBudget());
            if ($lignesbudgets) {
                $id_rubrique = $lignesbudgets->getIdRubrique();
                $rubrique_budget = RubriqueTable::getInstance()->find($id_rubrique);
                if ($rubrique_budget) {
                    $ligne = $lignesbudgets;
                    //   $mnttc = 0;
                    // if ($doc_achat->getDroittimbre() == 1) {
                    //     $mnttc = $doc_achat->getMntttc() + 0.600;
                    // } else
                    $mnttc = $doc_achat->getMntttc();
                    if ($rubrique_budget->getIdRubrique() != null) {
                        $id_rubrique_parent = $rubrique_budget->getIdRubrique();
                        $ligp_rubrique_parent = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubriqueAndIdTitre($id_rubrique_parent, $lignesbudgets->getIdTitre());
                        if ($ligp_rubrique_parent) {
                            $mntprov_rubrique_parent = $ligp_rubrique_parent->getMntengage() + $mnttc;
                            //   die($mntprov_rubrique_parent->getId().'rr'.$mnttc);
                            $ligp_rubrique_parent->setMntengage($mntprov_rubrique_parent);
                            $ligp_rubrique_parent->save();
                            /*                             * ****************Mis a jour recap budget************** */

                            // $recap = RecapbudgetTable::getInstance()->getByMoisAndLigpr($ligp_rubrique_parent->getId(), date('m'))->getFirst();
                            // //                            $id_rubrique = $recap_sousrubrique->getIdRubrique();
                            // //                            $rubrique = RubriqueTable::getInstance()->find($id_rubrique);
                            // //                            if ($rubrique->getIdRubrique())
                            // //                                $rubrique = RubriqueTable::getInstance()->find($rubrique->getIdRubrique());
                            // //                            $recap = RecapbudgetTable::getInstance()->getByMoisAndRubrique($rubrique->getId(), date('m'), date('Y'))->getFirst();
                            // // die(date('m') . ' ' . $ligp_rubrique_parent->getId() . ' ' . $idbudget . '  ' . $recap->getId());
                            // $mnt_recap_egager = $recap->getMntEncager() + $mnttc;
                            // $recap->setMntEncager($mnt_recap_egager);
                            // $mnt_recap_relic_egager = $recap->getRelicatEngager() - $mnttc;
                            // $recap->setRelicatEngager($mnt_recap_relic_egager);
                            // $recap->save();
                        }
                    }
                }
            }
            if ($lignesbudgets) {
                $ligne = $lignesbudgets;
                $ligne->MisAjourMntRubrique($doc_achat);
                $ligne->save();
                // if ($doc_achat->getDroittimbre() == 1) {
                //     $mnttc = $doc_achat->getMntttc() + 0.600;
                // } else
                //$mnttc = $doc_achat->getMntttc();
                $documentbudget->setMnt($mnttc);
                $documentbudget->setMntnet($mnttc);
                $documentbudget->setMntengage($ligne->getMntprovisoire());
                $relicat = $ligne->getMnt() - $ligne->getMntprovisoire();
                $documentbudget->setMntrelicat($relicat);
                $documentbudget->save();
            }

            $piecej = new Piecejointbudget();
//           // $piecejoint = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocumentbudget($id_docbudget);
//            if ($piecejoint && $docb)
//                $piecej = $piecejoint;
            $piecej->setIdDocachat($iddoc_achat);
            $piecej->setIdType(4);
            //$piecej->setDescription($txt_object);
            $piecej->setIdDocumentbudget($documentbudget->getId()); //die('gg');
            $piecej->save();

            die('bien');
        }
    }

    public function executeValiderengagement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_docbudget = $params['idpreengagement'];
            $iddoc_achat = $params['iddoc'];
            $doc_achat = new Documentachat();
            $docachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
            $doc_achat = $docachat;
            $docachat->setIdEtatdoc(74);
            $docachat->save();
            $txt_object = $params['txt_object'];
            $idbudget = $params['idbudget'];

            $idtype = $params['idtype'];
            $documentbudget = new Documentbudget();
            $document_budget_pr = DocumentbudgetTable::getInstance()->find($id_docbudget);
            if ($idbudget)
                $idbudget = $idbudget;
            else
                $idbudget = $document_budget_pr->getIdBudget();
            $docb = Doctrine_Core::getTable('documentbudget')->findOneByIdAndIdType($id_docbudget, $idtype);
            if ($docb)
                $documentbudget = $docb;
            else {
                $documentbudget->setIdType($idtype);
                $documentbudget->setNumero($documentbudget->NumeroSeqDocumentAchat($idtype));
                $documentbudget->setDatecreation(date('Y-m-d'));
                if ($idbudget)
                    $documentbudget->setIdBudget($idbudget);
                else
                    $documentbudget->setIdBudget($document_budget_pr->getIdBudget());
                $documentbudget->save();
            }
            $ligne = new Ligprotitrub();
            $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($idbudget);
            if ($lignesbudgets) {
                $id_rubrique = $lignesbudgets->getIdRubrique();
                $rubrique_budget = RubriqueTable::getInstance()->find($id_rubrique);
                if ($rubrique_budget) {
                    $ligne = $lignesbudgets;
                    //   $mnttc = 0;
                    // if ($doc_achat->getDroittimbre() == 1) {
                    //     $mnttc = $doc_achat->getMntttc() + 0.600;
                    // } else
                    $mnttc = $doc_achat->getMntttc();
                    if ($rubrique_budget->getIdRubrique() != null) {
                        $id_rubrique_parent = $rubrique_budget->getIdRubrique();
                        $ligp_rubrique_parent = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubriqueAndIdTitre($id_rubrique_parent, $lignesbudgets->getIdTitre());
                        if ($ligp_rubrique_parent) {
                            $mntprov_rubrique_parent = $ligp_rubrique_parent->getMntengage() + $mnttc;
                            //   die($mntprov_rubrique_parent->getId().'rr'.$mnttc);
                            $ligp_rubrique_parent->setMntengage($mntprov_rubrique_parent);
                            $ligp_rubrique_parent->save();
                            /*                             * ****************Mis a jour recap budget************** */

                            // $recap = RecapbudgetTable::getInstance()->getByMoisAndLigpr($ligp_rubrique_parent->getId(), date('m'))->getFirst();
                            // //                            $id_rubrique = $recap_sousrubrique->getIdRubrique();
                            // //                            $rubrique = RubriqueTable::getInstance()->find($id_rubrique);
                            // //                            if ($rubrique->getIdRubrique())
                            // //                                $rubrique = RubriqueTable::getInstance()->find($rubrique->getIdRubrique());
                            // //                            $recap = RecapbudgetTable::getInstance()->getByMoisAndRubrique($rubrique->getId(), date('m'), date('Y'))->getFirst();
                            // // die(date('m') . ' ' . $ligp_rubrique_parent->getId() . ' ' . $idbudget . '  ' . $recap->getId());
                            // $mnt_recap_egager = $recap->getMntEncager() + $mnttc;
                            // $recap->setMntEncager($mnt_recap_egager);
                            // $mnt_recap_relic_egager = $recap->getRelicatEngager() - $mnttc;
                            // $recap->setRelicatEngager($mnt_recap_relic_egager);
                            // $recap->save();
                        }
                    }
                }
            }
            if ($lignesbudgets) {
                $ligne = $lignesbudgets;
                $ligne->MisAjourMntRubrique($doc_achat);
                $ligne->save();
                // if ($doc_achat->getDroittimbre() == 1) {
                //     $mnttc = $doc_achat->getMntttc() + 0.600;
                // } else
                //$mnttc = $doc_achat->getMntttc();
                $documentbudget->setMnt($mnttc);
                $documentbudget->setMntnet($mnttc);
                $documentbudget->setMntengage($ligne->getMntprovisoire());
                $relicat = $ligne->getMnt() - $ligne->getMntprovisoire();
                $documentbudget->setMntrelicat($relicat);
                $documentbudget->save();
            }

            $piecej = new Piecejointbudget();
            $piecejoint = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocumentbudget($id_docbudget);
            if ($piecejoint && $docb)
                $piecej = $piecejoint;
            $piecej->setIdDocachat($iddoc_achat);
            $piecej->setIdType(4);
            $piecej->setDescription($txt_object);
            $piecej->setIdDocumentbudget($documentbudget->getId()); //die('gg');
            $piecej->save();

            die('bien');
        }
    }

    public function executeValiderengagementBDC(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_docbudget = $params['idpreengagement'];
            $relicat_total = $params['relicat_total'];
            $iddoc_achat = $params['iddoc'];
            $doc_achat = new Documentachat();
            $docachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
            $doc_achat = $docachat;
            //            $docachat->setIdEtatdoc(28);
            $docachat->setIdEtatdoc(70);
            $docachat->save();
            $txt_object = $params['txt_object'];
            $idbudget = $params['idbudget'];
            $idtype = $params['idtype'];
            $documentbudget = new Documentbudget();
            $docb = Doctrine_Core::getTable('documentbudget')->findOneByIdAndIdType($id_docbudget, $idtype);

            if ($docb)
                $documentbudget = $docb;
            else {
                $documentbudget->setIdType($idtype);
                $documentbudget->setNumero($documentbudget->NumeroSeqDocumentAchat($idtype));
                $documentbudget->setDatecreation(date('Y-m-d'));
                $documentbudget->setIdBudget($idbudget);
                $documentbudget->save();
            }

            $ligne = new Ligprotitrub();
            $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($idbudget);
            if ($lignesbudgets) {
                $id_rubrique = $lignesbudgets->getIdRubrique();
                $rubrique_budget = RubriqueTable::getInstance()->find($id_rubrique);
                if ($rubrique_budget) {
                    $ligne = $lignesbudgets;
                    //   $mnttc = 0;
                    // if ($doc_achat->getDroittimbre() == 1) {
                    //     $mnttc = $doc_achat->getMntttc() + 0.600;
                    // } else
                    $mnttc = $doc_achat->getMntttc();
                    if ($rubrique_budget->getIdRubrique() != null) {
                        $id_rubrique_parent = $rubrique_budget->getIdRubrique();
                        $ligp_rubrique_parent = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubriqueAndIdTitre($id_rubrique_parent, $lignesbudgets->getIdTitre());
                        if ($ligp_rubrique_parent) {
                            $mntprov_rubrique_parent = $ligp_rubrique_parent->getMntengage() + $mnttc;
                            $ligp_rubrique_parent->setMntengage($mntprov_rubrique_parent);
                            $ligp_rubrique_parent->save();
                            /*                             * ****************Mis a jour recap budget************** */
                            // $recap = RecapbudgetTable::getInstance()->getByMoisAndLigpr($ligp_rubrique_parent->getId(), date('m'))->getFirst();
                            // $mnt_recap_egager = $recap->getMntEncager() + $mnttc;
                            // $recap->setMntEncager($mnt_recap_egager);
                            // $mnt_recap_relic_egager = $recap->getRelicatEngager() - $mnttc;
                            // $recap->setRelicatEngager($mnt_recap_relic_egager);
                            // $recap->save();
                        }
                    }
                }
            }
            if ($lignesbudgets) {
                $ligne = $lignesbudgets;
                $ligne->MisAjourMntRubrique($doc_achat);
                $ligne->save();
                $documentbudget->setMnt($doc_achat->getMntttc());
                $documentbudget->setMntnet($doc_achat->getMntttc());
                $mntengage = $ligne->getMntengage() + $doc_achat->getMntttc();
                $documentbudget->setMntengage($mntengage);
                $relicat = $ligne->getMnt() - $ligne->getMntprovisoire();

                if ($relicat_total)
                    $documentbudget->setMntrelicat($relicat_total);
                $documentbudget->save();
            }

            $piecej = new Piecejointbudget();
            $piecejoint = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocumentbudget($id_docbudget);
            if ($piecejoint && $docb)
                $piecej = $piecejoint;
            $piecej->setIdDocachat($iddoc_achat);
            $piecej->setIdType(4);
            $piecej->setDescription($txt_object);
            $piecej->setIdDocumentbudget($documentbudget->getId()); //die('gg');
            $piecej->save();
            die('bien');
        }
    }

    public function executeValiderengagementContrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_docbudget = $params['idpreengagement'];
            $iddoc_achat = $params['iddoc'];
            $doc_achat = new Documentachat();
            $docachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
            $doc_achat = $docachat;
            $doc_achat->setIdEtatdoc(76);
            $doc_achat->save();
            $txt_object = $params['txt_object'];
            $idbudget = $params['idbudget'];
            $idtype = $params['idtype'];

            $documentbudget = new Documentbudget();
            $docb = Doctrine_Core::getTable('documentbudget')->findOneByIdAndIdType($id_docbudget, $idtype);

            if ($docb)
                $documentbudget = $docb;
            else {
                $documentbudget->setIdType($idtype);
                $documentbudget->setNumero($documentbudget->NumeroSeqDocumentAchat($idtype));
                $documentbudget->setDatecreation(date('Y-m-d'));
                $documentbudget->setIdBudget($idbudget);
                $documentbudget->save();
            }

            $ligne = new Ligprotitrub();
            $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($idbudget);
            if ($lignesbudgets) {
                $id_rubrique = $lignesbudgets->getIdRubrique();
                $rubrique_budget = RubriqueTable::getInstance()->find($id_rubrique);
                if ($rubrique_budget) {
                    $ligne = $lignesbudgets;
                    //   $mnttc = 0;
                    // if ($doc_achat->getDroittimbre() == 1) {
                    //     $mnttc = $doc_achat->getMntttc() + 0.600;
                    // } else
                    $mnttc = $doc_achat->getMntttc();
                    if ($rubrique_budget->getIdRubrique() != null) {
                        $id_rubrique_parent = $rubrique_budget->getIdRubrique();
                        $ligp_rubrique_parent = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubriqueAndIdTitre($id_rubrique_parent, $lignesbudgets->getIdTitre());
                        if ($ligp_rubrique_parent) {
                            $mntprov_rubrique_parent = $ligp_rubrique_parent->getMntengage() + $mnttc;
                            $ligp_rubrique_parent->setMntengage($mntprov_rubrique_parent);
                            $ligp_rubrique_parent->save();
                            /*                             * ****************Mis a jour recap budget************** */
                            // $recap = RecapbudgetTable::getInstance()->getByMoisAndLigpr($ligp_rubrique_parent->getId(), date('m'))->getFirst();
                            // $mnt_recap_egager = $recap->getMntEncager() + $mnttc;
                            // $recap->setMntEncager($mnt_recap_egager);
                            // $mnt_recap_relic_egager = $recap->getRelicatEngager() - $mnttc;
                            // $recap->setRelicatEngager($mnt_recap_relic_egager);
                            // $recap->save();
                        }
                    }
                }
            }
            if ($lignesbudgets) {
                $ligne = $lignesbudgets;
                $ligne->MisAjourMntRubrique($doc_achat);
                $ligne->save();

                $documentbudget->setMnt($doc_achat->getContratachat()->getMontantcontrat());
                $documentbudget->setMntnet($doc_achat->getContratachat()->getMontantcontrat());
                $documentbudget->setMntengage($ligne->getMntprovisoire());
                $relicat = $ligne->getMntencaisse() - $ligne->getMntprovisoire();
                $documentbudget->setMntrelicat($relicat);
                $documentbudget->save();
            }
            $piecej = new Piecejointbudget();
            $piecej->setIdDocachat($iddoc_achat);
            $piecej->setIdType(1);
            $piecej->setDescription($txt_object);
            $piecej->setIdDocumentbudget($documentbudget->getId()); //die('gg');
            $piecej->save();
            die('bien');
        }
    }

    public function executeValiderengagementAvenantContrat(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_docbudget = $params['idpreengagement'];
            $iddoc_achat = $params['iddoc'];
            $idcontrat = $params['idcontrat'];
            $doc_achat = new Documentachat();
            $docachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
            $doc_contrat = Doctrine_Core::getTable('contratachat')->findOneById($idcontrat);
            $doc_achat = $docachat;
            $txt_object = $params['txt_object'];
            $idbudget = $params['idbudget'];
            $idtype = $params['idtype'];

            $documentbudget = new Documentbudget();
            $docb = Doctrine_Core::getTable('documentbudget')->findOneByIdAndIdType($id_docbudget, $idtype);
            //            if ($docb)
            //                $documentbudget = $docb;
            //            else {
            $documentbudget->setIdType($idtype);
            $documentbudget->setNumero($documentbudget->NumeroSeqDocumentAchat($idtype));
            $documentbudget->setDatecreation(date('Y-m-d'));
            $documentbudget->setIdBudget($idbudget);
            $documentbudget->save();
            //            }
            $ligne = new Ligprotitrub();
            $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($idbudget);
            if ($lignesbudgets) {
                $id_rubrique = $lignesbudgets->getIdRubrique();
                $rubrique_budget = RubriqueTable::getInstance()->find($id_rubrique);
                if ($rubrique_budget) {
                    $ligne = $lignesbudgets;
                    // if ($doc_achat->getDroittimbre() == 1) {
                    //     $mnttc = $doc_achat->getMntttc() + 0.600;
                    // } else
                    $mnttc = $doc_achat->getMntttc();
                    if ($rubrique_budget->getIdRubrique() != null) {
                        $id_rubrique_parent = $rubrique_budget->getIdRubrique();
                        $ligp_rubrique_parent = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubriqueAndIdTitre($id_rubrique_parent, $lignesbudgets->getIdTitre());
                        if ($ligp_rubrique_parent) {
                            $mntprov_rubrique_parent = $ligp_rubrique_parent->getMntengage() + $mnttc;
                            //   die($mntprov_rubrique_parent->getId().'rr'.$mnttc);
                            $ligp_rubrique_parent->setMntengage($mntprov_rubrique_parent);
                            $ligp_rubrique_parent->save();
                            /*                             * ****************Mis a jour recap budget************** */
                            // $recap = RecapbudgetTable::getInstance()->getByMoisAndLigpr($ligp_rubrique_parent->getId(), date('m'))->getFirst();
                            // $mnt_recap_egager = $recap->getMntEncager() + $mnttc;
                            // $recap->setMntEncager($mnt_recap_egager);
                            // $mnt_recap_relic_egager = $recap->getRelicatEngager() - $mnttc;
                            // $recap->setRelicatEngager($mnt_recap_relic_egager);
                            // $recap->save();
                        }
                    }
                }
            }
            if ($lignesbudgets) {
                $ligne = $lignesbudgets;
                $ligne->MisAjourMntRubriqueAvenantcontrat($doc_achat, $idcontrat);
                $ligne->save();

                $documentbudget->setMnt($doc_achat->getContratachat()->getMontantavenant());
                $documentbudget->setMntnet($doc_achat->getContratachat()->getMontantavenant());
                $documentbudget->setMntengage($ligne->getMntprovisoire());
                $relicat = $ligne->getMntencaisse() - $ligne->getMntprovisoire();
                $documentbudget->setMntrelicat($relicat);
                $documentbudget->save();
            }

            $piecej = new Piecejointbudget();
            $piecej->setIdDocachat($iddoc_achat);
            $piecej->setIdType(1);
            $piecej->setDescription($txt_object);
            $piecej->setIdDocumentbudget($documentbudget->getId()); //die('gg');
            $piecej->save();
            die('bien');
        }
    }

    public function executeSavespiece(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $sousdetail = $params['pieces'];
            $mnt = $params['mnttotal'];
            $id = $params['iddoc'];
            $iddocbudget = $params['iddocbudget'];
            $ligne = new Ligprotitrub();
            $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($id);
            if ($lignesbudgets) {
                $ligne = $lignesbudgets;
                $mntrestant = 0;
                if ($ligne->getMntengage())
                    $mntrestant = $ligne->getMntengage();
                $relicat = $mntrestant + $mnt;
                $ligne->setMntengage($relicat);
                $ligne->save();
            }
            foreach ($sousdetail as $sdetail) {

                $id_doc = $sdetail['id'];
                $mnt = $sdetail['mnt'];
                $ref = $sdetail['ref'];
                $piecej = new Piecejointbudget();
                $piecej->setIdDocachat($id_doc);
                if ($ref && $ref != "")
                    $piecej->setReference($ref);

                $piecej->setIdDocumentbudget($iddocbudget);
                $piecej->save();
            }

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT documentachat.id, "
                    . " CONCAT( typedoc.prefixetype, documentachat.numero) as doc "
                    . ", documentachat.mntttc as mnt, "
                    . " piecejointbudget.reference as ref, "
                    . " typepiecejointbudget.libelle as type"
                    . " FROM documentachat, typedoc, "
                    . " piecejointbudget, documentbudget, typepiecejointbudget "
                    . "WHERE "
                    . " documentachat.id_typedoc = typedoc.id "
                    . "AND piecejointbudget.id_docachat = documentachat.id "
                    . "AND piecejointbudget.id_documentbudget = documentbudget.id "
                    . "AND piecejointbudget.id_type = typepiecejointbudget.id "
                    . "AND documentbudget.id = " . $iddocbudget;
            $titresBudget = $conn->fetchAssoc($query);

            die(json_encode($titresBudget));
        }
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $documentbudget = $form->save();
                $doc = new Documentbudget();
                if ($request['numeroengaement']) {
                    $docs = Doctrine_Core::getTable('documentbudget')->findOneById($documentbudget->getId());
                    if ($docs) {
                        $doc = $docs;
                        $doc->setIdBudget($request['numeroengaement']);

                        $doc->save();
                    }
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $documentbudget)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@documentbudget_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'documentbudget_edit', 'sf_subject' => $documentbudget));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    public function executeValiderordennace(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_docbudget = $params['idpreengagement'];
            $iddoc_achat = $params['iddoc'];
            $txt_object = $params['txt_object'];
            $doc_achat = new Documentachat();
            $docachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
            $doc_achat = $docachat;
            $doc_achat->setIdEtatdoc(28);
            $doc_achat->save();
            $idbudget = $params['idbudget'];
            $idtype = $params['idtype'];

            $documentbudget = new Documentbudget();
            $docb = Doctrine_Core::getTable('documentbudget')->findOneByIdAndIdType($id_docbudget, $idtype);

            if ($docb)
                $documentbudget = $docb;
            else {
                $documentbudget->setIdType($idtype);
                $documentbudget->setNumero($documentbudget->NumeroSeqDocumentAchat($idtype));
                $documentbudget->setDatecreation(date('Y-m-d'));
                $documentbudget->setIdBudget($idbudget);
                $documentbudget->save();
            }

            $ligne = new Ligprotitrub();
            $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($idbudget);
            if ($lignesbudgets) {
                $ligne = $lignesbudgets;
                $ligne->MisAjourMntRubrique($doc_achat);
                $ligne->save();

                $documentbudget->setMnt($doc_achat->getMntttc());
                $documentbudget->setMntnet($doc_achat->getMntttc());
                $documentbudget->setMntengage($ligne->getMntprovisoire());
                $relicat = $ligne->getMntencaisse() - $ligne->getMntprovisoire();
                $documentbudget->setMntrelicat($relicat);
                $documentbudget->save();
            }

            $piecej = new Piecejointbudget();
            //            $piecejoint = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocumentbudget($id_docbudget);
            //            if ($piecejoint && $docb)
            //                $piecej = $piecejoint;
            $piecej->setIdDocachat($iddoc_achat);
            // $piecej->setIdType($piecejoint->getIdType());
            $piecej->setDescription($txt_object);
            $piecej->setIdDocumentbudget($documentbudget->getId()); //die('gg');
            $piecej->save();
            die('bien');
        }
    }

    public function executeCertificatRs(sfWebRequest $request) {
        $this->documentbudget = DocumentbudgetTable::getInstance()->find($request->getParameter('id'));
        $this->fournisseur = FournisseurTable::getInstance()->find($request->getParameter('fournisseur_id'));
        $this->ids = $request->getParameter('ids');

        $this->societe = Doctrine_Core::getTable('societe')->findOneById(1);
    }

    public function executeCertificatRsFacBDCR(sfWebRequest $request) {
        $this->documentbudget = DocumentbudgetTable::getInstance()->find($request->getParameter('id'));
        $this->fournisseur = FournisseurTable::getInstance()->find($request->getParameter('fournisseur_id'));
        $this->ids = $request->getParameter('ids');

        $this->societe = Doctrine_Core::getTable('societe')->findOneById(1);
    }

    public function executeSaveCertificatRetenue(sfWebRequest $request) {
        $certificat_retenue = new Certificatretenue();
        //        die($request->getParameter('montant_net_ttc') . 'mp'.$request->getParameter('montant_retenue'));

        $certificat_retenue->setDatecreation(date('Y-m-d'));
        $certificat_retenue->setIdDocumentbudget($request->getParameter('ordonnance_id'));
        $certificat_retenue->setIdFournisseur($request->getParameter('fournisseur_id'));
        $certificat_retenue->setIdRetenuesource($request->getParameter('retenu_id'));
        $certificat_retenue->setMontantordonnance($request->getParameter('montant'));
        $certificat_retenue->setMontantordonnancenet($request->getParameter('montant_net_ttc'));
        $certificat_retenue->setMontantht($request->getParameter('montant_ht'));
        $certificat_retenue->setTvadue($request->getParameter('tva_due'));
        $certificat_retenue->setTvacomprise($request->getParameter('tva_comprise'));
        $certificat_retenue->setTvaretenue($request->getParameter('tva_retenue'));
        $certificat_retenue->setMontantretenue($request->getParameter('montant_retenue'));
        $certificat_retenue->setObjetreglement($request->getParameter('objet_reglement'));

        $certificat_retenue->save();
        //die($certificat_retenue->getMontantretenue().'m');
        $ordonnance = DocumentbudgetTable::getInstance()->find($request->getParameter('ordonnance_id'));
        $ordonnance->setMntnet($request->getParameter('montant_net_ttc'));
        $ordonnance->save();

        //Création du 2ème Ordonnance lié au 1èr Ordonnance
        $documentbudget = new Documentbudget();
        $ligne = LigprotitrubTable::getInstance()->find($ordonnance->getIdBudget());

        $documentbudget->setIdType($ordonnance->getIdType());
        $documentbudget->setNumero($ordonnance->NumeroSeqDocumentAchat($ordonnance->getIdType()));
        $documentbudget->setDatecreation(date('Y-m-d'));
        $documentbudget->setIdBudget($ordonnance->getIdBudget());

        //        //Mise à jour rubrique
        //        $ligne->MisAjourMntRubrique($doc_achat);
        //        $ligne->save();

        $documentbudget->setMnt($request->getParameter('montant_retenue'));
        $documentbudget->setMntnet($request->getParameter('montant_retenue'));
        $documentbudget->setMntengage($ligne->getMntprovisoire());
        $relicat = $ligne->getMntencaisse() - $ligne->getMntprovisoire();
        $documentbudget->setMntrelicat($relicat);
        $documentbudget->setIdDocumentbudget($ordonnance->getId());

        $documentbudget->save();

        die("Certificat enregistrée avec succès!");
    }

    public function executeSaveCertificatRetenueBdcReg(sfWebRequest $request) {
        $certificat_retenue = new Certificatretenue();
        $certificat_retenue->setDatecreation(date('Y-m-d'));
        $certificat_retenue->setIdDocumentbudget($request->getParameter('ordonnance_id'));
        $certificat_retenue->setIdFournisseur($request->getParameter('fournisseur_id'));
        $certificat_retenue->setIdRetenuesource($request->getParameter('retenu_id'));
        $certificat_retenue->setMontantordonnance($request->getParameter('montant'));
        $certificat_retenue->setMontantordonnancenet($request->getParameter('montant_net_ttc'));
        $certificat_retenue->setMontantht($request->getParameter('montant_ht'));
        $certificat_retenue->setTvadue($request->getParameter('tva_due'));
        $certificat_retenue->setTvacomprise($request->getParameter('tva_comprise'));
        $certificat_retenue->setTvaretenue($request->getParameter('tva_retenue'));
        $certificat_retenue->setMontantretenue($request->getParameter('montant_retenue'));
        $certificat_retenue->setObjetreglement($request->getParameter('objet_reglement'));

        $certificat_retenue->save();
        //die($certificat_retenue->getMontantretenue().'m');
        $ordonnance = DocumentbudgetTable::getInstance()->find($request->getParameter('ordonnance_id'));
        $ordonnance->setMntnet($request->getParameter('montant_net_ttc'));
        $ordonnance->save();

        //Création du 2ème Ordonnance lié au 1èr Ordonnance
        $documentbudget = new Documentbudget();
        $ligne = LigprotitrubTable::getInstance()->find($ordonnance->getIdBudget());

        $documentbudget->setIdType($ordonnance->getIdType());
        $documentbudget->setNumero($ordonnance->NumeroSeqDocumentAchat($ordonnance->getIdType()));
        $documentbudget->setDatecreation(date('Y-m-d'));
        $documentbudget->setIdBudget($ordonnance->getIdBudget());

        //        //Mise à jour rubrique
        //        $ligne->MisAjourMntRubrique($doc_achat);
        //        $ligne->save();

        $documentbudget->setMnt($request->getParameter('montant_retenue'));
        $documentbudget->setMntnet($request->getParameter('montant_retenue'));
        $documentbudget->setMntengage($ligne->getMntprovisoire());
        $relicat = $ligne->getMntencaisse() - $ligne->getMntprovisoire();
        $documentbudget->setMntrelicat($relicat);
        $documentbudget->setIdDocumentbudget($ordonnance->getId());

        $documentbudget->save();

        die("Certificat enregistrée avec succès!");
    }

    public function executeValiderOrdonnance(sfWebRequest $request) {
        $id_docbudget = $request->getParameter('idpreengagement');
        $iddoc_achat = $request->getParameter('iddoc');
        $idbudget = $request->getParameter('idbudget');
        $idtype = $request->getParameter('idtype');
        $doc_achat = new Documentachat();
        $docachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
        $doc_achat = $docachat;
        $doc_achat->setIdEtatdoc(30);
        $doc_achat->save();

        $documentbudget = new Documentbudget();
        $docb = Doctrine_Core::getTable('documentbudget')->findOneByIdAndIdType($id_docbudget, $idtype);

        if ($docb)
            $documentbudget = $docb;
        else {
            $documentbudget->setIdType($idtype);
            $documentbudget->setNumero($documentbudget->NumeroSeqDocumentAchat($idtype));
            $documentbudget->setDatecreation(date('Y-m-d'));
            $documentbudget->setIdBudget($idbudget);
            $documentbudget->setIdDocumentbudget($id_docbudget);
            $documentbudget->save();
        }

        $ligne = new Ligprotitrub();
        $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($idbudget);
        if ($lignesbudgets) {
            $ligne = $lignesbudgets;
            // $ligne->MisAjourMntRubrique($doc_achat);
            if ($ligne->getMnt())
                $mntrestant = $ligne->getMntdeponser();
            $relicat = $mntrestant + $mnttc;
            $ligne->setMntdeponser($relicat);
            $relicat_engager = 0;
            $relicat_engager = $ligne->getMnt() - $relicat;
            $ligne->setRelicadeponser($relicat_engager);
            $ligne->save();


            $documentbudget->setMnt($doc_achat->getMntttc());
            $documentbudget->setMntnet($doc_achat->getMntttc());

            $documentbudget->setMntengage($ligne->getMntengage());
            $relicat = $ligne->getMnt() - $ligne->getMntengage();
            $documentbudget->setMntrelicat($relicat);
            $documentbudget->save();
        }

        $piecej = new Piecejointbudget();
        $piecej->setIdDocachat($iddoc_achat);
        $piecej->setIdDocumentbudget($documentbudget->getId());
        $piecej->save();
        return $this->renderText('bien');
    }

    public function executeValiderOrdonnanceHorsBCI(sfWebRequest $request) {
        $id_docbudget = $request->getParameter('idpreengagement');
        $idbudget = $request->getParameter('idbudget');
        $idtype = $request->getParameter('idtype');
        $mnttc = $request->getParameter('mnttc');
        $documentbudget = new Documentbudget();
        $docb = Doctrine_Core::getTable('documentbudget')->findOneByIdAndIdType($id_docbudget, $idtype);
        if ($docb)
            $documentbudget = $docb;
        else {
            $documentbudget->setIdType($idtype);
            $documentbudget->setNumero($documentbudget->NumeroSeqDocumentAchat($idtype));
            $documentbudget->setDatecreation(date('Y-m-d'));
            $documentbudget->setIdBudget($idbudget);
            $documentbudget->setIdDocumentbudget($id_docbudget);
            $documentbudget->save();
        }

        $ligne = new Ligprotitrub();
        $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($idbudget);
        if ($lignesbudgets) {
            $ligne = $lignesbudgets;
            if ($ligne->getMnt())
                $mntrestant = $ligne->getMntdeponser();
            $relicat = $mntrestant + $mnttc;
            $ligne->setMntdeponser($relicat);
            $relicat_engager = 0;
            $relicat_engager = $ligne->getMnt() - $relicat;
            $ligne->setRelicadeponser($relicat_engager);
            $ligne->save();

            $documentbudget->setMnt($mnttc);
            $documentbudget->setMntnet($mnttc);
            $documentbudget->setMntengage($ligne->getMntengage());
            $relicat = $ligne->getMnt() - $ligne->getMntengage();
            $documentbudget->setMntrelicat($relicat);
            $documentbudget->save();
        }
        $piecej = new Piecejointbudget();
        $piecej->setIdDocumentbudget($documentbudget->getId());
        $piecej->save();
        return $this->renderText('bien');
    }

    public function executeValiderOrdonnanceBDCReg(sfWebRequest $request) {
        $id_docbudget = $request->getParameter('idpreengagement');
        $iddoc_achat = $request->getParameter('iddoc');
        $idbudget = $request->getParameter('idbudget');
        $idtype = $request->getParameter('idtype');
        $doc_achat = new Documentachat();
        $docachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
        $doc_achat = $docachat;
        $doc_achat->setIdEtatdoc(30);
        $doc_achat->save();

        //        $docparent=  DocumentachatTable::getInstance()->find($docachat->getIdDcoparent());
        //        $quitances_def = LigneoperationcaisseTable::getInstance()->findByIdDocachatAndIdCategorie($docachat->getIdFils(), 2);
        //        if ($quitances_def) {
        //            foreach ($quitances_def as $quitance_def):
        //                $quitance_def->setEtat('Inactif');
        //                $quitance_def->save();
        //            endforeach;
        //        }
        //        die(sizeof($quitances_def).'fsd'.$docachat->getIdFils());
        $documentbudget = new Documentbudget();
        $docb = Doctrine_Core::getTable('documentbudget')->findOneByIdAndIdType($id_docbudget, $idtype);
        if ($docb)
            $documentbudget = $docb;
        else {
            $documentbudget->setIdType($idtype);
            $documentbudget->setNumero($documentbudget->NumeroSeqDocumentAchat($idtype));
            $documentbudget->setDatecreation(date('Y-m-d'));
            $documentbudget->setIdBudget($idbudget);
            $documentbudget->setIdDocumentbudget($id_docbudget);
            $documentbudget->save();
        }

        $ligne = new Ligprotitrub();
        $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($idbudget);
        if ($lignesbudgets) {
            $ligne = $lignesbudgets;
            //  $ligne->MisAjourMntRubrique($doc_achat);

            if ($ligne->getMnt())
                $mntrestant = $ligne->getMntdeponser();
            $relicat = $mntrestant + $mnttc;
            $ligne->setMntdeponser($relicat);
            $relicat_engager = 0;
            $relicat_engager = $ligne->getMnt() - $relicat;
            $ligne->setRelicadeponser($relicat_engager);
            $ligne->save();


            $documentbudget->setMnt($doc_achat->getMntttc());
            $documentbudget->setMntnet($doc_achat->getMntttc());
            $documentbudget->setMntengage($ligne->getMntengage());
            $relicat = $ligne->getMnt() - $ligne->getMntengage();
            $documentbudget->setMntrelicat($relicat);
            $documentbudget->save();
        }

        $piecej = new Piecejointbudget();
        $piecej->setIdDocachat($iddoc_achat);
        $piecej->setIdDocumentbudget($documentbudget->getId());
        $piecej->setIdType(6);
        $piecej->save();
        return $this->renderText('bien');
    }

    public function executeValiderOrdonnanceFacBDCG(sfWebRequest $request) {
        $id_docbudget = $request->getParameter('idpreengagement');
        $iddoc_achat = $request->getParameter('iddoc');
        $idbudget = $request->getParameter('idbudget');
        $idtype = $request->getParameter('idtype');
        $doc_achat = new Documentachat();
        $docachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
        $doc_achat = $docachat;
        $doc_achat->setIdEtatdoc(30);
        $doc_achat->save();
        $documentbudget = new Documentbudget();
        $docb = Doctrine_Core::getTable('documentbudget')->findOneByIdAndIdType($id_docbudget, $idtype);
        if ($docb)
            $documentbudget = $docb;
        else {
            $documentbudget->setIdType($idtype);
            $documentbudget->setNumero($documentbudget->NumeroSeqDocumentAchat($idtype));
            $documentbudget->setDatecreation(date('Y-m-d'));
            $documentbudget->setIdBudget($idbudget);
            $documentbudget->setIdDocumentbudget($id_docbudget);
            $documentbudget->save();
        }
        $ligne = new Ligprotitrub();
        $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($idbudget);
        if ($lignesbudgets) {
            $ligne = $lignesbudgets;
            //  $ligne->MisAjourMntRubrique($doc_achat);
            if ($ligne->getMnt())
                $mntrestant = $ligne->getMntdeponser();
            $relicat = $mntrestant + $mnttc;
            $ligne->setMntdeponser($relicat);
            $relicat_engager = 0;
            $relicat_engager = $ligne->getMnt() - $relicat;
            $ligne->setRelicadeponser($relicat_engager);
            $ligne->save();


            $documentbudget->setMnt($doc_achat->getMntttc());
            $documentbudget->setMntnet($doc_achat->getMntttc());
            $documentbudget->setMntengage($ligne->getMntengage());
            $relicat = $ligne->getMntencaisse() - $ligne->getMntengage();
            $documentbudget->setMntrelicat($relicat);
            $documentbudget->save();
        }

        $piecej = new Piecejointbudget();
        $piecej->setIdDocachat($iddoc_achat);
        $piecej->setIdDocumentbudget($documentbudget->getId());
        $piecej->save();
        $midfication = $this->ModificationEngagementBudget($request);
        return $this->renderText('bien');
    }

    public function ModificationEngagementBudget(sfWebRequest $request) {
        $iddoc_achat = $request->getParameter('iddoc');
        $docachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
        $Piecejoint = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($docachat->getIdDocparent());
        $id_documenbudget = $Piecejoint->getIdDocumentbudget();
        $documentbudget = DocumentbudgetTable::getInstance()->find($id_documenbudget);
        $mnt = $documentbudget->getMnt();
        $mnteng = $documentbudget->getMntengage();
        $Mntrelicat = $documentbudget->getMntrelicat();
        $nouveau_mnt = $docachat->getMntttc() + $mnt;
        $idbudget = $documentbudget->getIdBudget();
        $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($idbudget);
        $nouveu_mnteng = $lignesbudgets->getMntprovisoire() + $mnteng;
        $documentbudget->setMnt($nouveau_mnt);
        $documentbudget->setMntnet($nouveau_mnt);
        $documentbudget->setMntengage($nouveu_mnteng);
        $relicat = $lignesbudgets->getMntencaisse() - $nouveu_mnteng;
        $documentbudget->setMntrelicat($relicat);
        $documentbudget->save();
        if ($lignesbudgets) {
            $ligne = $lignesbudgets;
            $ligne->MisAjourMntRubriqueBDCG($docachat);
            $ligne->save();
        }
        return $this->renderText('bien modifié ');
    }

    public function executeValiderOrdonnanceLignecontrat(sfWebRequest $request) {
        $id_docbudget = $request->getParameter('idpreengagement');
        $iddoc_achat = $request->getParameter('iddoc');

        $idbudget = $request->getParameter('idbudget');
        $idtype = $request->getParameter('idtype');
        $id_mvt = $request->getParameter('id_mvt');
        $ligne_mvt = LignemouvementfacturationTable::getInstance()->findOneById($id_mvt);
        //         die($ligne_mvt->getMontant().'mp');
        $doc_achat = new Documentachat();
        $docachat = DocumentachatTable::getInstance()->findOneByIdDocparentAndIdLignemouvementfacturation($iddoc_achat, $id_mvt);
        $iddoc_achat_nv = $docachat->getId();
        //die($docachat->getId().'mppppp');
        //        $docachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);

        $doc_achat = $docachat;
        $doc_achat->setIdEtatdoc(30);
        $doc_achat->save();

        $documentbudget = new Documentbudget();
        $docb = Doctrine_Core::getTable('documentbudget')->findOneByIdAndIdType($id_docbudget, $idtype);

        if ($docb)
            $documentbudget = $docb;
        else {
            $documentbudget->setIdType($idtype);
            $documentbudget->setNumero($documentbudget->NumeroSeqDocumentAchat($idtype));
            $documentbudget->setDatecreation(date('Y-m-d'));
            $documentbudget->setIdBudget($idbudget);
            $documentbudget->setIdDocumentbudget($id_docbudget);
            $documentbudget->save();
        }

        $ligne = new Ligprotitrub();
        $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($idbudget);
        if ($lignesbudgets) {
            $ligne = $lignesbudgets;
            //    $ligne->MisAjourMntRubrique($doc_achat);
            $ligne->save();

            $documentbudget->setMnt($ligne_mvt->getMontant());
            $documentbudget->setMntnet($ligne_mvt->getMontant());
            $documentbudget->setMntengage($ligne->getMntprovisoire());
            $relicat = $ligne->getMntencaisse() - $ligne->getMntprovisoire();
            $documentbudget->setMntrelicat($relicat);
            $documentbudget->save();
        }

        $piecej = new Piecejointbudget();
        $piecej->setIdDocachat($iddoc_achat_nv);
        $piecej->setIdDocumentbudget($documentbudget->getId());
        $piecej->save();
        return $this->renderText('bien');
    }

    public function executeValiderOrdonnanceLigneBCIcontrat(sfWebRequest $request) {
        $id_docbudget = $request->getParameter('idpreengagement');
        $iddoc_achat = $request->getParameter('iddoc');

        $idbudget = $request->getParameter('idbudget');
        $idtype = $request->getParameter('idtype');
        $id_mvt = $request->getParameter('id_mvt');
        $ligne_mvt = LignemouvementfacturationTable::getInstance()->findOneById($id_mvt);
        //         die($ligne_mvt->getMontant().'mp');
        $doc_achat = new Documentachat();
        //        $docachat = DocumentachatTable::getInstance()->findOneByIdDocparentAndIdLignemouvementfacturation($iddoc_achat, $id_mvt);
        $docachat = DocumentachatTable::getInstance()->findOneById($iddoc_achat);
        //      die($iddoc_achat.'id_docachat');
        $iddoc_achat_nv = $iddoc_achat;
        //die($docachat->getId().'mppppp');
        //        $docachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);

        $doc_achat = $docachat;
        $doc_achat->setIdEtatdoc(30);
        $doc_achat->save();

        $documentbudget = new Documentbudget();
        $docb = Doctrine_Core::getTable('documentbudget')->findOneByIdAndIdType($id_docbudget, $idtype);

        if ($docb)
            $documentbudget = $docb;
        else {
            $documentbudget->setIdType($idtype);
            $documentbudget->setNumero($documentbudget->NumeroSeqDocumentAchat($idtype));
            $documentbudget->setDatecreation(date('Y-m-d'));
            $documentbudget->setIdBudget($idbudget);
            $documentbudget->setIdDocumentbudget($id_docbudget);
            $documentbudget->save();
        }

        $ligne = new Ligprotitrub();
        $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($idbudget);
        if ($lignesbudgets) {
            $ligne = $lignesbudgets;
            //   $ligne->MisAjourMntRubrique($doc_achat);
            $ligne->save();

            $documentbudget->setMnt($ligne_mvt->getMontant());
            $documentbudget->setMntnet($ligne_mvt->getMontant());
            $documentbudget->setMntengage($ligne->getMntprovisoire());
            $relicat = $ligne->getMntencaisse() - $ligne->getMntprovisoire();
            $documentbudget->setMntrelicat($relicat);
            $documentbudget->save();
        }

        $piecej = new Piecejointbudget();
        $piecej->setIdDocachat($iddoc_achat_nv);
        $piecej->setIdDocumentbudget($documentbudget->getId());

        $piecej->save();
        return $this->renderText('bien');
    }

    public function executeValiderOrdonnanceBCIcontrat(sfWebRequest $request) {
        $id_docbudget = $request->getParameter('idpreengagement');
        $iddoc_achat = $request->getParameter('iddoc');

        $idbudget = $request->getParameter('idbudget');
        $idtype = $request->getParameter('idtype');
        $id_mvt = $request->getParameter('id_mvt');
        $ligne_mvt = LignemouvementfacturationTable::getInstance()->findOneById($id_mvt);
        //         die($ligne_mvt->getMontant().'mp');
        $doc_achat = new Documentachat();
        //        $docachat = DocumentachatTable::getInstance()->findOneByIdDocparentAndIdLignemouvementfacturation($iddoc_achat, $id_mvt);
        $docachat = DocumentachatTable::getInstance()->findOneById($iddoc_achat);
        //      die($iddoc_achat.'id_docachat');
        $iddoc_achat_nv = $iddoc_achat;
        //die($docachat->getId().'mppppp');
        //        $docachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);

        $doc_achat = $docachat;
        $doc_achat->setIdEtatdoc(30);
        $doc_achat->save();

        $documentbudget = new Documentbudget();
        $docb = Doctrine_Core::getTable('documentbudget')->findOneByIdAndIdType($id_docbudget, $idtype);

        if ($docb)
            $documentbudget = $docb;
        else {
            $documentbudget->setIdType($idtype);
            $documentbudget->setNumero($documentbudget->NumeroSeqDocumentAchat($idtype));
            $documentbudget->setDatecreation(date('Y-m-d'));
            $documentbudget->setIdBudget($idbudget);
            $documentbudget->setIdDocumentbudget($id_docbudget);
            $documentbudget->save();
        }

        $ligne = new Ligprotitrub();
        $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($idbudget);
        if ($lignesbudgets) {
            $ligne = $lignesbudgets;
            //       $ligne->MisAjourMntRubrique($doc_achat);
            $ligne->save();

            $documentbudget->setMnt($ligne_mvt->getMontant());
            $documentbudget->setMntnet($ligne_mvt->getMontant());
            $documentbudget->setMntengage($ligne->getMntprovisoire());
            $relicat = $ligne->getMntencaisse() - $ligne->getMntprovisoire();
            $documentbudget->setMntrelicat($relicat);
            $documentbudget->save();
        }

        $piecej = new Piecejointbudget();
        $piecej->setIdDocachat($iddoc_achat_nv);
        $piecej->setIdDocumentbudget($documentbudget->getId());

        $piecej->save();
        return $this->renderText('bien');
    }

    public function executeAnnulerEngagement(sfWebRequest $request) {
        $id_ligprotitrub = $request->getParameter('id_ligprotitrub');
        $iddoc_achat = $request->getParameter('iddoc');
        $id_lignemouvement = $request->getParameter('id_lignemouvement');
        $montantecart = $request->getParameter('montantecart');
        $totale = $request->getParameter('totale');

        $annulation = new Annulationengagement();
        $annulation->setDate(date('Y-m-d'));
        if ($iddoc_achat != '')
            $annulation->setIdDocumentachat($iddoc_achat);
        if ($id_lignemouvement != '')
            $annulation->setIdLignemouvementfacturation($id_lignemouvement);
        if ($id_ligprotitrub != '')
            $annulation->setIdLigprotitrub($id_ligprotitrub);
        $annulation->setMontantecart($montantecart);
        if ($totale == 'Totale')
            $annulation->setTotale(true);
        else
            $annulation->setTotale(false);
        $annulation->save();

        $ligprotitrub = LigprotitrubTable::getInstance()->find($id_ligprotitrub);
        $new_mntengage = $ligprotitrub->getMntengage() + $montantecart;
        $ligprotitrub->setMntengage($new_mntengage);
        $ligprotitrub->save();

        return $this->renderText('bien');
    }

    public function executeValiderEcartEngagement(sfWebRequest $request) {
        $id_ligprotitrub = $request->getParameter('id_ligprotitrub');
        $iddoc_achat = $request->getParameter('iddoc');
        $id_lignemouvement = $request->getParameter('id_lignemouvement');
        $montantecart = $request->getParameter('montantecart');
        $totale = $request->getParameter('totale');

        $annulation = new Annulationengagement();
        $annulation->setDate(date('Y-m-d'));
        if ($iddoc_achat != '')
            $annulation->setIdDocumentachat($iddoc_achat);
        if ($id_lignemouvement != '')
            $annulation->setIdLignemouvementfacturation($id_lignemouvement);
        if ($id_ligprotitrub != '')
            $annulation->setIdLigprotitrub($id_ligprotitrub);
        $annulation->setMontantecart($montantecart);
        if ($totale == 'Totale')
            $annulation->setTotale(true);
        else
            $annulation->setTotale(false);
        $annulation->save();

        $ligprotitrub = LigprotitrubTable::getInstance()->find($id_ligprotitrub);
        $new_mntengage = $ligprotitrub->getMntengage() + $montantecart;
        $ligprotitrub->setMntengage($new_mntengage);
        $ligprotitrub->save();

        $idtype = $request->getParameter('idtype');
        $doc_achat = DocumentachatTable::getInstance()->find($iddoc_achat);

        $documentbudget = new Documentbudget();
        $documentbudget->setIdType($idtype);
        $documentbudget->setNumero($documentbudget->NumeroSeqDocumentAchat($idtype));
        $documentbudget->setDatecreation(date('Y-m-d'));
        $documentbudget->setIdBudget($id_ligprotitrub);
        $documentbudget->save();


        $ligne = LigprotitrubTable::getInstance()->find($id_ligprotitrub);
        if ($ligne) {
            $ligne->MisAjourMntRubrique($doc_achat);
            $ligne->save();

            $documentbudget->setMnt($doc_achat->getMntttc());
            $documentbudget->setMntnet($doc_achat->getMntttc());
            $documentbudget->setMntengage($ligne->getMntprovisoire());
            $relicat = $ligne->getMntencaisse() - $ligne->getMntprovisoire();
            $documentbudget->setMntrelicat($relicat);
            $documentbudget->save();
        }

        $piecej = new Piecejointbudget();
        $piecej->setIdDocachat($iddoc_achat);
        $piecej->setIdDocumentbudget($documentbudget->getId());
        $piecej->save();
        return $this->renderText('bien');
    }

    public function executeImprimerordonnanceHorsBci(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $id = $request->getParameter('id');
        $pdf = new sfTCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Ordonnance de Paiement');
        $pdf->SetSubject("Ordonnance de Paiement");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

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
        $pdf->SetFont('dejavusans', '', 10, '', true);

        $pdf->AddPage();
        $html = $this->ReadHtmlOrdonnanceHorsBci($id);
        ob_end_clean();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Ordonnance de Paiement.pdf', 'I');
        throw new sfStopException();
    }

    public function ReadHtmlOrdonnanceHorsBci($id) {
        $html = StyleCssHeader::header1();
        $document_budget = new Documentbudget();
        $html .= $document_budget->ReadHtmlOrdonnanceHorBCI($id);
        return $html;
    }

    // public function executeAfficherBudgetSelected(sfWebRequest $request)
    // {
    //     header('Access-Control-Allow-Origin: *');
    //     $content = $request->getContent();
    //     if (!empty($content)) {
    //         $params = json_decode($content, true);
    //         $table = $params['table'];
    //         if ($table == "titrebudjet") {
    //             $id = $params['id'];
    //             $id_budget = $params['id_budget'];
    //             if ($id && $d_budget) {
    //                 $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
    //                 $query = "SELECT ligprotitrub.id, ligprotitrub.nordre, ligprotitrub.code, "
    //                     . " rubrique.libelle, ligprotitrub.mnt, "
    //                     . " ligprotitrub.mntengage, ligprotitrub.mntdeponser, "
    //                     . " ligprotitrub.mntencaisse, mntprovisoire, ligprotitrub.mntretire as mntretire,"
    //                     . " ligprotitrub.mntexterne as mntexterne "
    //                     . " FROM ligprotitrub, rubrique "
    //                     . " WHERE ligprotitrub.id_rubrique = rubrique.id "
    //                     . " AND ligprotitrub.id = " . $id . " "
    //                     //                            . " and rubrique.id not in (select rb.id from rubrique rb
    //                     //                              where rb.id_rubrique is  null and (select count(*)
    //                     //                              from rubrique r where rb.id=r.id_rubrique) >= 1
    //                     //                              order by id,libelle desc)"
    //                     . " order by ligprotitrub.nordre asc";
    //                 //  die($query);
    //                 $titresBudget = $conn->fetchAssoc($query);
    //                 die(json_encode($titresBudget));
    //             }
    //         }
    //     }
    //     die('Erreur');
    // }
}
