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

    public function executeNewordenanace(sfWebRequest $request) {
        $this->form = new DocumentbudgetForm();
        $this->documentbudget = $this->form->getObject();
    }

    public function executeNewordenanaceparfour(sfWebRequest $request) {
        $this->form = new DocumentbudgetForm();
        $this->documentbudget = $this->form->getObject();
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
                        . "FROM  piecejointbudget, documentachat, typedoc, ligprotitrub, documentbudget "
                        . "WHERE piecejointbudget.id_docachat = documentachat.id "
                        . "AND documentachat.etatdocachat IS NULL "
                        . "AND piecejointbudget.id_documentbudget = documentbudget.id "
                        . "AND documentachat.id_typedoc = typedoc.id and documentbudget.id_type =1 "
                        . "AND documentachat.id_frs = " . $id . " "
                        . "AND documentbudget.id_budget = ligprotitrub.id "
                        . "AND documentbudget.id not in "
                        . "(select documentbudget.id from documentbudget,piecejointbudget where documentbudget.id_type=2 "
                        . "and documentbudget.id!=piecejointbudget.id_documentbudget) "
                        . "AND documentachat.id_docparent not in "
                        . "(select documentachat.id from documentachat,piecejointbudget where "
                        . " documentachat.id=piecejointbudget.id_docachat)";

                $titresBudget = $conn->fetchAssoc($query);
                die(json_encode($titresBudget));
            }
        }die('Erreur');
    }

    public function executeAffichelistesengagement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            //
            $id = $params['id']; //die('ss'.$id);
            if ($id) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT  piecejointbudget.id as idpi,documentachat.numero, "
                        . "typedoc.prefixetype,LPAD(documentachat.numero::text, 7, '0') as numero ,"
                        . "typedoc.libelle,documentachat.mntttc ,documentachat.id as iddocachat,"
                        . " documentbudget.id as iddocbu , documentbudget.numero as numero_engagement "
                        . "FROM  piecejointbudget,  documentachat, typedoc, ligprotitrub, documentbudget "
                        . "WHERE piecejointbudget.id_docachat = documentachat.id "
                        . "AND documentachat.etatdocachat IS NULL "
                        . "AND piecejointbudget.id_documentbudget = documentbudget.id "
                        . "AND documentachat.id_typedoc = typedoc.id and documentbudget.id_type =1 "
                        . "AND documentbudget.id_budget = ligprotitrub.id "
                        . "AND ligprotitrub.id = " . $id . "  and documentbudget.id not in "
                        . "(select documentbudget.id from documentbudget,piecejointbudget where documentbudget.id_type=2 "
                        . "and documentbudget.id!=piecejointbudget.id_documentbudget) "
                        . "AND documentachat.id_docparent not in "
                        . "(select documentachat.id from documentachat,piecejointbudget where "
                        . " documentachat.id=piecejointbudget.id_docachat)";
//                        . " GROUP BY (documentbudget.id)";
                //die($query);
                $titresBudget = $conn->fetchAssoc($query);

                die(json_encode($titresBudget));
            }
        }die('Erreur');
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
//        $idtype = '';
        $idtype = 1;
        if (isset($_REQUEST['idtype']))
            $idtype = $_REQUEST['idtype'];
        $this->pager = $this->getPager($idtype);
        $this->sort = $this->getSort();
        $this->idtype = $idtype;
    }

    protected function getPager($idtype) {
        $pager = $this->configuration->getPager('documentbudget');
        $pager->setQuery($this->buildQuery($idtype));
        $pager->setPage($this->getPage());
        $pager->init();

        return $pager;
    }

    protected function buildQuery($idtype) {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);
        $documentsachat = Doctrine_Core::getTable('documentbudget')
                ->createQuery('a');
        $query = $this->filters->buildQuery($this->getFilters());
        $filter = $this->getFilters();
        if (isset($filter['id_type']) && !$idtype) {
            $documentsachat = $documentsachat->where('id_type=' . $filter['id_type']);
        } else if ($idtype) {
            $filter['id_type'] = $idtype;
            $documentsachat = $documentsachat->where('id_type=' . $idtype);
        }
//        die ($filter['datecreation']['from']);
        if (isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        } elseif (!isset($filter['datecreation']['from']) && !isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $_SESSION['exercice_budget'] . "-01-01'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $_SESSION['exercice_budget'] . "-12-31'");
        } elseif (isset($filter['datecreation']['from']) && !isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $_SESSION['exercice_budget'] . "-12-31'");
        } elseif (!isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
            $documentsachat = $documentsachat->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        }

        $query = $documentsachat->OrderBy('datecreation desc');
        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        return $query;
    }

    public function executeAffichesource(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $table = $params['table'];

            if ($table == "titrebudjet") {
                $id = $params['id'];
                if ($id) {
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                    $query = "SELECT ligprotitrub.id, ligprotitrub.nordre, "
                            . " rubrique.libelle, ligprotitrub.mnt, "
                            . " ligprotitrub.mntengage, ligprotitrub.mntdeponser,"
                            . " ligprotitrub.mntencaisse,mntprovisoire "
                            . " FROM ligprotitrub, rubrique "
                            . "WHERE ligprotitrub.id_rubrique = rubrique.id "
                            . "AND ligprotitrub.id_titre = " . $id . " "
                            . "order by id asc";
                    $titresBudget = $conn->fetchAssoc($query);

                    die(json_encode($titresBudget));
                }
            }
        }die('Erreur');
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
                    $query = "SELECT ligprotitrub.id, ligprotitrub.nordre, "
                            . " rubrique.libelle, ligprotitrub.mnt, "
                            . " ligprotitrub.mntengage, ligprotitrub.mntdeponser,"
                            . " ligprotitrub.mntencaisse,mntprovisoire "
                            . " FROM ligprotitrub, rubrique "
                            . "WHERE ligprotitrub.id_rubrique = rubrique.id "
                            . "AND ligprotitrub.id_titre = " . $id . " "
                            . "AND ligprotitrub.id NOT IN (SELECT ligprotitrub.id FROM ligprotitrub where ligprotitrub.id_rubrique IN (SELECT rubrique.id_rubrique FROM rubrique WHERE rubrique.id_rubrique IS NOT NULL)) "
                            . "order by id asc";
                    $titresBudget = $conn->fetchAssoc($query);

                    die(json_encode($titresBudget));
                }
            }
        }die('Erreur');
    }

    public function executeAffichedetail(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $id = $params['id'];
            if ($id) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT    ligprotitrub.id,    ligprotitrub.nordre,  "
                        . "  rubrique.libelle,    ligprotitrub.mnt,   "
                        . " ligprotitrub.mntengage,   ligprotitrub.mntdeponser,"
                        . "ligprotitrub.mntencaisse,   ligprotitrub.mntprovisoire "
                        . " FROM    ligprotitrub,    rubrique "
                        . "WHERE    ligprotitrub.id_rubrique = rubrique.id "
                        . "AND   ligprotitrub.id = " . $id;
                $titresBudget = $conn->fetchAssoc($query);

                die(json_encode($titresBudget));
            }
        }die('Erreur');
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
                    CONCAT(typedoc.prefixetype, documentachat.numero) as numero , documentachat.mntttc 
                    FROM documentachat, typedoc 
                    WHERE documentachat.id_typedoc = typedoc.id 
                    AND documentachat.id_typedoc = 7;";
                $docachats = $conn->fetchAssoc($query);

                die(json_encode($docachats));
            }
        }die('Erreur');
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
            $iddocbudget = $params['idbudget']; //die($iddocbudget.'hh');
            $desc = $params['object'];
            $mntttc = $params['mntttc'];
            $ligne = new Ligprotitrub();
            $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($iddocbudget);
            if ($lignesbudgets) {
                $ligne = $lignesbudgets;
                $mnt_provisoire = 0;
                if ($ligne->getMntprovisoire())
                    $mnt_provisoire = $ligne->getMntprovisoire();
                $mnt_provisoire+= $mntttc;
                $ligne->setMntprovisoire($mnt_provisoire);
                $ligne->save();

                $doc = new Documentbudget();
                $doc = $doc->NouvelleficheEngagementProvisoire($ligne, $numero, $idtype, $date, $ligne->getId(), $mntttc, $ligne->getMntprovisoire());

                $piecej = new Piecejointbudget();
                $piecej->NouvelleInsertionDocAchatParDocumentBudget($iddoc_achat, $idtypep, $desc, $doc->getId());
                die($piecej . 'hh');
            }

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
                $ligne = $lignesbudgets;
                $ligne->MisAjourMntRubrique($doc_achat);
                $ligne->save();

                $documentbudget->setMnt($doc_achat->getMntttc());
                $documentbudget->setMntengage($ligne->getMntprovisoire());
                $relicat = $ligne->getMntencaisse() - $ligne->getMntprovisoire();
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
            $query = "SELECT documentachat.id,  "
                    . " CONCAT( typedoc.prefixetype,documentachat.numero) as doc   "
                    . ", documentachat.mntttc as mnt,   "
                    . "  piecejointbudget.reference as ref, "
                    . "  typepiecejointbudget.libelle as type"
                    . " FROM    documentachat,    typedoc,   "
                    . " piecejointbudget,    documentbudget,    typepiecejointbudget "
                    . "WHERE   "
                    . " documentachat.id_typedoc = typedoc.id "
                    . "AND   piecejointbudget.id_docachat = documentachat.id "
                    . "AND   piecejointbudget.id_documentbudget = documentbudget.id "
                    . "AND   piecejointbudget.id_type = typepiecejointbudget.id "
                    . "AND   documentbudget.id = " . $iddocbudget;
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

    public function executeSaveCertificatRetenue(sfWebRequest $request) {
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

        $ordonnance = DocumentbudgetTable::getInstance()->find($request->getParameter('ordonnance_id'));
        $ordonnance->setMntnet($request->getParameter('montant_net_ttc'));
        $ordonnance->save();

        die("Certificat enregistrée avec succès !");
    }

    public function executeValiderOrdonnance(sfWebRequest $request) {
        $id_docbudget = $request->getParameter('idpreengagement');
        $iddoc_achat = $request->getParameter('iddoc');
        $idbudget = $request->getParameter('idbudget');
        $idtype = $request->getParameter('idtype');
        $doc_achat = new Documentachat();
        $docachat = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
        $doc_achat = $docachat;


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
        $piecej->setIdDocachat($iddoc_achat);
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

    public function executeImprimerordonnance(sfWebRequest $request) {
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF();
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Ordonnance de Paiement');
        $pdf->SetSubject("Ordonnance de Paiement");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
       $soc = $societe;
        $entete =  $soc->getMinistere();
        $rs=$soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');

//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(0, 0, 0);

        // set margins
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(5, 10, 5);
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
        $html = $this->ReadHtmlOrdonnance($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Ordonnance de Paiement.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlOrdonnance($id) {
        $html = StyleCssHeader::header1();
        $document_budget = new Documentbudget();
        $html .= $document_budget->ReadHtmlOrdonnance($id);
        return $html;
    }

}
