<?php

require_once dirname(__FILE__) . '/../lib/caissesbanquesGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/caissesbanquesGeneratorHelper.class.php';

/**
 * caissesbanques actions.
 *
 * @package    Bmm
 * @subpackage caissesbanques
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class caissesbanquesActions extends autoCaissesbanquesActions {

//    protected function buildQuery() {
//        $tableMethod = $this->configuration->getTableMethod();
//        if (null === $this->filters) {
//            $this->filters = $this->configuration->getFilterForm($this->getFilters());
//        }
//
//        $this->filters->setTableMethod($tableMethod);
//
//        $query = $this->filters->buildQuery($this->getFilters());
//
//        $this->addSortQuery($query);
//
//        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
//        if (!isset($filter['dateouvert']['from']) && !isset($filter['dateouvert']['to'])) {
//            $query = $documentsachat->Andwhere("dateouvert >='" . date('Y') . "-01-01" . "'")
//                    ->Andwhere("dateouvert <='" . date('Y') . "-12-31" . "'")
//                    ->OrderBy('id desc');
//        }
//        $query = $event->getReturnValue();
//
//        return $query;
//    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $caissesbanques = $form->save();
                $banque = new Caissesbanques();
                $banque = $caissesbanques;
                $banque->setIdTypecb(1);
                $banque->setMntprov($banque->getMntouverture());
                $banque->setMntdefini($banque->getMntouverture());
                $banque->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $caissesbanques)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@caissesbanques_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'caissesbanques_edit', 'sf_subject' => $caissesbanques));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
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

        $this->idtype = 1;
        $this->pager = $this->getPager();
        $this->sort = $this->getSort();
    }

    public function executeFilter(sfWebRequest $request) {
        $this->setPage(1);

        if ($request->hasParameter('_reset')) {
            $this->setFilters($this->configuration->getFilterDefaults());

            $this->redirect('@caissesbanques');
        }

        $this->filters = $this->configuration->getFilterForm($this->getFilters());

        $this->filters->bind($request->getParameter($this->filters->getName()));
        if ($this->filters->isValid()) {
            $this->setFilters($this->filters->getValues());

            $this->redirect('@caissesbanques');
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();

        $this->setTemplate('index');
    }

    public function executeNew(sfWebRequest $request) {
        $this->idtype = 1;
        $this->form = $this->configuration->getForm();
        $this->caissesbanques = $this->form->getObject();
    }

    public function executeEdit(sfWebRequest $request) {
        $this->caissesbanques = $this->getRoute()->getObject();

        $this->form = $this->configuration->getForm($this->caissesbanques);
    }

    public function executeSavespiecepreengagement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $numero = $params['numero'];
            $iddoc_achat = $params['iddoc'];
            $idCatoperation = $params['idCatoperation'];
            $id_user = $params['id_user'];
            $date = date('Y-m-d', strtotime($params['date']));
            $mnt = $params['mnt']; //die($iddocbudget.'hh');
            $id_demandeur = $params['id_demandeur'];
            $id_caisse = $params['id_caisse'];
            $objet = $params['objet'];
            $chequen = $params['chequen'];
            $idcaisse = $params['idcaisse'];
            $idlignerubrique = $params['idlignerubrique'];
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
            $achat_document->setIdEtatdoc(26);
            $achat_document->save();
            $ligne = new Ligneoperationcaisse();
            if ($idcaisse && $idcaisse != "") {
                $ligneoperation = Doctrine_Core::getTable('ligneoperationcaisse')->findOneById($idcaisse);
//                 die($ligneoperation);
                if ($ligneoperation) {
                    $ligne = $ligneoperation;
                }
            }
            if ($numero)
                $ligne->setNumeroo($numero);
            if ($id_user)
                $ligne->setIdUser($id_user);
            if ($id_demandeur && $id_demandeur != "")
                $ligne->setIdDemarcheur($id_demandeur);
            if ($id_caisse)
                $ligne->setIdCaisse($id_caisse);

            if ($iddoc_achat)
                $ligne->setIdDocachat($iddoc_achat);
            if ($objet)
                $ligne->setObjet($objet);
            if ($date)
                $ligne->setDateoperation($date);
            if ($idCatoperation)
                $ligne->setIdCategorie($idCatoperation);
            if ($mnt)
                $ligne->setMntoperation($mnt);
//            die($idlignerubrique.'pm');

            if ($chequen)
                $ligne->setChequen($chequen);
            $ligne->setEtat('Actif');
            $ligne->save();
//            die($ligne->getId() . 'id=');
            if ($idlignerubrique && $idlignerubrique != "")
                $ligne->setIdBudget($idlignerubrique);
            $ligne->save();
//            die($ligne->getId() . 'idcdc=');
            //ajouter ligne doc par quittance
            $listeslignesdoc = $params['listearticle'];
            $lignedoc_caisse = Doctrine_Core::getTable('lignearticlecaisse')->findByIdLigneoperationcaisse($ligne->getId());
            if (count($lignedoc_caisse) > 0) {
                Doctrine_Query::create()->delete('lignearticlecaisse')
                        ->where('id_ligneoperationcaisse=' . $ligne->getId())->execute();
            }
            foreach ($listeslignesdoc as $ligne_art) {
                $idligne = $ligne_art['idligne'];
                $ligne_article_caisse = new Lignearticlecaisse();
                $ligne_article_caisse->setIdLignearticle($idligne);
                $ligne_article_caisse->setIdLigneoperationcaisse($ligne->getId());
                $ligne_article_caisse->save();
            }
            /*             * ***************modification engagement budget ************ */
            if ($achat_document->getMntttc() == 0.000 || $achat_document->getMntttc() == null):
                $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($idlignerubrique);
                /*                 * ****test de quitance provisoire **** */
//            die($lignesbudgets->getId().'mp');
//            $mntquitance_prov = $ligneoper->getMntoperation();
//            $mntquitance_prov = $mnt;
                /* test existance du quitance provioire */
                $quitance = LigneoperationcaisseTable::getInstance()->findbyIdCategorieAndIdDocachat(2, $achat_document->getId());
                $quitance_pro = LigneoperationcaisseTable::getInstance()->findbyIdCategorieAndIdDocachat(1, $achat_document->getId());
//             die(count($quitance).'bg');
                if (count($quitance) == 0) {
                    if ($lignesbudgets) {
                        $doc_budget_pov = DocumentbudgetTable::getInstance()->findOneByIdBudgetAndIdType($lignesbudgets->getId(), 3);
                        if ($doc_budget_pov)
                            $mntquitanceprov = $doc_budget_pov->getMnt();
                        else
                            $mntquitanceprov = 0;
                        $ligne = $lignesbudgets;
                        $mnt_provisoire = 0;
                        if ($ligne->getMntprovisoire() != null)
                            $mnt_provisoire = $ligne->getMntprovisoire();
                        $mnt_provisoire = floatval($mnt_provisoire + $mnt);
                        $ligne->setMntprovisoire($mnt_provisoire);
                        $ligne->setRelicaengager($ligne->getMnt() - $ligne->getMntengage());
                        $ligne->save();
                        $ligne = $lignesbudgets;
                        $piecejoint = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($achat_document->getId());
//                        $piecej = new Piecejointbudget();
//                        $piecej->setIdDocachat($achat_document->getId());
//                        $piecej->setIdDocumentbudget($doc_budget_pov->getId());
//                        $piecej->setIdType(4);
//                        $piecej->save();
//                           die(count($piecejoint).'gfg'.$achat_document->getId());
                        $id_docbudget = $doc_budget_pov->getId();
                        $documentbudget = DocumentbudgetTable::getInstance()->findById($id_docbudget)->getFirst();
                        $doc = $documentbudget;
                        $mnt_budger = $doc->getMnt();
                        $mnt_budger+= $mnt;
                        $doc->setMnt($mnt);
                        $doc->setMntnet($mnt);
                        $doc->setMntengage($ligne->getMntprovisoire());
                        $relicat = $ligne->getMntencaisse() - $ligne->getMntprovisoire();
                        $doc->setMntrelicat($relicat);
                        $doc->save();
                    }
                }
                if (count($quitance) >= 1) {
                    $ligne = LigprotitrubTable::getInstance()->find($quitance->getFirst()->getIdBudget());
                    $doc_budget_pov = DocumentbudgetTable::getInstance()->findOneByIdBudgetAndIdType($lignesbudgets->getId(), 1);

                    if ($doc_budget_pov)
                        $mntquitanceprov = $quitance->getFirst()->getMntoperation();
                    else
                        $mntquitanceprov = 0;
//                    die($mntquitanceprov);
                    $ligne = $lignesbudgets;
                    $mnt_provisoire = 0;
                    if ($ligne->getMntprovisoire() != null)
                        $mnt_provisoire = $ligne->getMntprovisoire();
                    $mnt_provisoire = $mnt_provisoire - $mntquitanceprov + $mnt;
                    $ligne->setMntprovisoire($mnt_provisoire);
                    $mnteng = $ligne->getMntengage();
                    $mntengfinal = $mnteng + $mnt;
                    $ligne->setMntengage($mntengfinal);
                    $ligne->setRelicaengager($ligne->getMnt() - $mntengfinal);
                    $ligne->save();
                    $piecejoint = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($iddoc_achat);
                    $id_docbudget = $piecejoint->getidDocumentbudget();
                    $documentbudget = DocumentbudgetTable::getInstance()->findById($id_docbudget)->getFirst();
                    $doc = $documentbudget;
                    $mnt_budger = $doc->getMnt();

                    $mnt_budger+= $mnt;
                    $doc->setMnt($mnt);
                    $doc->setMntnet($mnt);
                    $doc->setMntengage($ligne->getMntprovisoire());
                    $relicat = $ligne->getMntencaisse() - $ligne->getMntprovisoire();
                    $doc->setMntrelicat($relicat);
                    $doc->save();
                }endif;
            /*             * ***fin modification engagement budget****** */
            die('bien');
        }
    }

    public function executeSavecloture(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddoc_achat = $params['iddoc'];
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
            $achat_document->setIdEtatdoc(62);
            $quitances_prvisoire = LigneoperationcaisseTable::getInstance()->findByIdDocachatAndIdCategorie($iddoc_achat, 1);
            if ($quitances_prvisoire) {
                foreach ($quitances_prvisoire as $quitance_prvisoire):
                    $quitance_prvisoire->setEtat('Inactif');
                    $quitance_prvisoire->save();
                endforeach;
            }
            $achat_document->save();
            die('bien');
        }
    }

    public function executeSavespiecepreengagementBDC(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $numero = $params['numero'];
            $iddoc_achat = $params['iddoc'];
            $idCatoperation = $params['idCatoperation'];
            $id_user = $params['id_user'];
            $date = date('Y-m-d', strtotime($params['date']));
            $mnt = $params['mnt']; //die($iddocbudget.'hh');
            $id_demandeur = $params['id_demandeur'];
            $id_caisse = $params['id_caisse'];
            $objet = $params['objet'];
            $chequen = $params['chequen'];
            $idcaisse = $params['idcaisse'];
//            die($idcaisse.'id_caisse');
//            $idlignerubrique = $params['idlignerubrique'];
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
            $achat_document->setIdEtatdoc(61);
            $achat_document->save();
            $ligne = new Ligneoperationcaisse();
//            if ($idcaisse && $idcaisse != "") {
//                $ligneoperation = Doctrine_Core::getTable('ligneoperationcaisse')->findOneById($idcaisse);
//                // die($lignesbudgets);
//                if ($ligneoperation) {
//                    $ligne = $ligneoperation;
//                }
//            }
//            if ($iddoc_achat) {
//                $ligneoperation = Doctrine_Core::getTable('ligneoperationcaisse')->findByIdDocachatAndIdCategorie($iddoc_achat, 1);
//                if (sizeof($ligneoperation) >= 1)
//                    $ligne = new Ligneoperationcaisse();
//                else {
//                    $ligneoperation = Doctrine_Core::getTable('ligneoperationcaisse')->findOneById($idcaisse);
//                    if ($ligneoperation) {
//                        $ligne = $ligneoperation;
//                    }
//                }
//            }
            if ($idcaisse && $idcaisse != "") {
                $ligneoperation = Doctrine_Core::getTable('ligneoperationcaisse')->findOneById($idcaisse);
//                 die($ligneoperation);
                if ($ligneoperation) {
                    $ligne = $ligneoperation;
                }
            }
            if ($numero)
                $ligne->setNumeroo($numero);
            if ($id_user)
                $ligne->setIdUser($id_user);
            if ($id_demandeur && $id_demandeur != "")
                $ligne->setIdDemarcheur($id_demandeur);
            if ($id_caisse)
                $ligne->setIdCaisse($id_caisse);

            if ($iddoc_achat)
                $ligne->setIdDocachat($iddoc_achat);
            if ($objet)
                $ligne->setObjet($objet);
            if ($date)
                $ligne->setDateoperation($date);
            if ($idCatoperation)
                $ligne->setIdCategorie($idCatoperation);
            if ($mnt)
                $ligne->setMntoperation($mnt);
//            die($idlignerubrique.'pm');
            $ligne->setEtat('Actif');
            if ($chequen)
                $ligne->setChequen($chequen);

            $ligne->save();
//            die($ligne->getId() . 'id=');
//            if ($idlignerubrique && $idlignerubrique != "")
//                $ligne->setIdBudget($idlignerubrique);
//            $ligne->save();
//            die($ligne->getId() . 'idcdc=');
            //ajouter ligne doc par quittance
            $listeslignesdoc = $params['listearticle'];
            $lignedoc_caisse = Doctrine_Core::getTable('lignearticlecaisse')->findByIdLigneoperationcaisse($ligne->getId());
            if (count($lignedoc_caisse) > 0) {
                Doctrine_Query::create()->delete('lignearticlecaisse')
                        ->where('id_ligneoperationcaisse=' . $ligne->getId())->execute();
            }
            foreach ($listeslignesdoc as $ligne_art) {
                $idligne = $ligne_art['idligne'];
                $ligne_article_caisse = new Lignearticlecaisse();
                $ligne_article_caisse->setIdLignearticle($idligne);
                $ligne_article_caisse->setIdLigneoperationcaisse($ligne->getId());
                $ligne_article_caisse->save();
            }

            die('bien');
        }
    }

    public function executeSavespiecepreengagementBDCRetenue(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $numero = $params['numero'];
            $iddoc_achat = $params['iddoc'];
            $idCatoperation = $params['idCatoperation'];
            $id_user = $params['id_user'];
            $date = date('Y-m-d', strtotime($params['date']));
            $mnt = $params['mnt']; //die($iddocbudget.'hh');
            $id_demandeur = $params['id_demandeur'];
            $id_caisse = $params['id_caisse'];
            $objet = $params['objet'];
            $chequen = $params['chequen'];
            $idcaisse = $params['idcaisse'];
//            die($idcaisse.'id_caisse');
//            $idlignerubrique = $params['idlignerubrique'];
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
            $achat_document->setIdEtatdoc(61);
            $achat_document->save();
            $ligne = new Ligneoperationcaisse();
            if ($iddoc_achat) {
                $ligneoperation = Doctrine_Core::getTable('ligneoperationcaisse')->findByIdDocachatAndIdCategorie($iddoc_achat, 1);
                if (sizeof($ligneoperation) >= 1)
                    $ligne = new Ligneoperationcaisse();
                else {
                    $ligneoperation = Doctrine_Core::getTable('ligneoperationcaisse')->findOneById($idcaisse);
                    if ($ligneoperation) {
                        $ligne = $ligneoperation;
                    }
                }
            }
            if ($numero)
                $ligne->setNumeroo($numero);
            if ($id_user)
                $ligne->setIdUser($id_user);
            if ($id_demandeur && $id_demandeur != "")
                $ligne->setIdDemarcheur($id_demandeur);
            if ($id_caisse)
                $ligne->setIdCaisse($id_caisse);

            if ($iddoc_achat)
                $ligne->setIdDocachat($iddoc_achat);
            if ($objet)
                $ligne->setObjet($objet);
            if ($date)
                $ligne->setDateoperation($date);
            if ($idCatoperation)
                $ligne->setIdCategorie($idCatoperation);
            if ($mnt)
                $ligne->setMntoperation($mnt);
//            die($idlignerubrique.'pm');
            $ligne->setEtat('Actif');
            if ($chequen)
                $ligne->setChequen($chequen);

            $ligne->save();
//            die($ligne->getId() . 'id=');
            $listeslignesdoc = $params['listearticle'];
            $lignedoc_caisse = Doctrine_Core::getTable('lignearticlecaisse')->findByIdLigneoperationcaisse($ligne->getId());
            if (count($lignedoc_caisse) > 0) {
                Doctrine_Query::create()->delete('lignearticlecaisse')
                        ->where('id_ligneoperationcaisse=' . $ligne->getId())->execute();
            }
            foreach ($listeslignesdoc as $ligne_art) {
                $idligne = $ligne_art['idligne'];
                $ligne_article_caisse = new Lignearticlecaisse();
                $ligne_article_caisse->setIdLignearticle($idligne);
                $ligne_article_caisse->setIdLigneoperationcaisse($ligne->getId());
                $ligne_article_caisse->save();
            }

            die('bien');
        }
    }

    public function executeSavespiecepreengagementBDCDef(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $numero = $params['numero'];
            $iddoc_achat = $params['iddoc'];
            $idCatoperation = $params['idCatoperation'];
            $id_user = $params['id_user'];
            $date = date('Y-m-d', strtotime($params['date']));
            $mnt = $params['mnt']; //die($iddocbudget.'hh');
            $id_demandeur = $params['id_demandeur'];
            $id_caisse = $params['id_caisse'];
            $objet = $params['objet'];
            $chequen = $params['chequen'];
            $idcaisse = $params['idcaisse'];
            $is_valide = $params['is_valide'];
            $retenueirpp = $params['retenueirpp'];
            $retenuetva = $params['retenuetva'];
//            die($idcaisse.'id_caisse');
//            $idlignerubrique = $params['idlignerubrique'];
            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
            if ($is_valide == true) {
                $achat_document->setIdEtatdoc(62);
            } else {
                $achat_document->setIdEtatdoc(61);
            }
            $achat_document->save();
            /*             * ****************************Update des quitance provisoire Inactif********************************* */
            if ($is_valide == true) {
                $quitances_prvisoire = LigneoperationcaisseTable::getInstance()->findByIdDocachatAndIdCategorie($iddoc_achat, 1);
                foreach ($quitances_prvisoire as $quitance_prvisoire):
                    $quitance_prvisoire->setEtat('Inactif');
                    $quitance_prvisoire->save();
                endforeach;
            }
            /*             * ************************************************************************************************* */
            $ligne = new Ligneoperationcaisse();
            if ($iddoc_achat) {
                $ligneoperation = Doctrine_Core::getTable('ligneoperationcaisse')->findByIdDocachatAndIdCategorie($iddoc_achat, 1);
                if (sizeof($ligneoperation) >= 1)
                    $ligne = new Ligneoperationcaisse();
                else {
                    $ligneoperation = Doctrine_Core::getTable('ligneoperationcaisse')->findOneById($idcaisse);
                    if ($ligneoperation) {
                        $ligne = $ligneoperation;
                    }
                }
            }
            if ($numero)
                $ligne->setNumeroo($numero);
            if ($id_user)
                $ligne->setIdUser($id_user);
            if ($id_demandeur && $id_demandeur != "")
                $ligne->setIdDemarcheur($id_demandeur);
            if ($id_caisse)
                $ligne->setIdCaisse($id_caisse);

            if ($iddoc_achat)
                $ligne->setIdDocachat($iddoc_achat);
            if ($objet)
                $ligne->setObjet($objet);
            if ($date)
                $ligne->setDateoperation($date);
            if ($idCatoperation)
                $ligne->setIdCategorie($idCatoperation);
            if ($mnt)
                $ligne->setMntoperation($mnt);
//            die($idlignerubrique.'pm');
            $ligne->setEtat('Actif');
            if ($chequen)
                $ligne->setChequen($chequen);
            if ($retenueirpp)
                $ligne->setRetenueirrp($retenueirpp);
            if ($retenuetva)
                $ligne->setRetenuetva($retenuetva);

            $ligne->save();
            die($ligne->getId() . 'id=');
//            if ($idlignerubrique && $idlignerubrique != "")
//                $ligne->setIdBudget($idlignerubrique);
//            $ligne->save();
//            die($ligne->getId() . 'idcdc=');
            //ajouter ligne doc par quittance
            $listeslignesdoc = $params['listearticle'];
            $lignedoc_caisse = Doctrine_Core::getTable('lignearticlecaisse')->findByIdLigneoperationcaisse($ligne->getId());
            if (count($lignedoc_caisse) > 0) {
                Doctrine_Query::create()->delete('lignearticlecaisse')
                        ->where('id_ligneoperationcaisse=' . $ligne->getId())->execute();
            }
            foreach ($listeslignesdoc as $ligne_art) {
                $idligne = $ligne_art['idligne'];
                $ligne_article_caisse = new Lignearticlecaisse();
                $ligne_article_caisse->setIdLignearticle($idligne);
                $ligne_article_caisse->setIdLigneoperationcaisse($ligne->getId());
                $ligne_article_caisse->save();
            }
            /*             * ****************modification du montant ttc dans l bdc provisoire est la somme des quitance defintif ********** */
            die('bien');
        }
    }

    public function executeSavespiecepreengagementDef(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $numero = $params['numero'];
            $iddoc_achat = $params['iddoc'];
//            $idCatoperation = $params['idCatoperation'];
            $id_user = $params['id_user'];
            $date = date('Y-m-d', strtotime($params['date']));
            $mnt = $params['mnt']; //die($iddocbudget.'hh');
            $id_demandeur = $params['id_demandeur'];
            $id_caisse = $params['id_caisse'];
            $objet = $params['objet'];
            $chequen = $params['chequen'];
            $idcaisse = $params['idcaisse'];

            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
            $achat_document->setIdEtatdoc(59);
            $achat_document->save();
            /*             * ****************************Update des quitance provisoire Inactif********************************* */

            $quitances_prvisoire = LigneoperationcaisseTable::getInstance()->findByIdDocachatAndIdCategorie($iddoc_achat, 1);
            if ($quitances_prvisoire) {
                foreach ($quitances_prvisoire as $quitance_prvisoire):
                    $quitance_prvisoire->setEtat('Inactif');
                    $quitance_prvisoire->save();
                endforeach;
            }
            /*             * ************************************************************************************************* */

            $ligne = new Ligneoperationcaisse();


            if ($idcaisse && $idcaisse != "") {
                $ligneoperation = Doctrine_Core::getTable('ligneoperationcaisse')->findOneById($idcaisse);
                if ($ligneoperation) {
                    $ligne = $ligneoperation;
                }
            }
            if ($numero)
                $ligne->setNumeroo($numero);
            if ($id_user)
                $ligne->setIdUser($id_user);
            if ($id_demandeur && $id_demandeur != "")
                $ligne->setIdDemarcheur($id_demandeur);
            if ($id_caisse)
                $ligne->setIdCaisse($id_caisse);

            if ($iddoc_achat)
                $ligne->setIdDocachat($iddoc_achat);
            if ($objet)
                $ligne->setObjet($objet);
            if ($date)
                $ligne->setDateoperation($date);
            $ligne->setIdCategorie(2);
            if ($idCatoperation)
                $ligne->setIdCategorie($idCatoperation);
            if ($mnt)
                $ligne->setMntoperation($mnt);
            $ligne->setEtat('Actif');
            if ($chequen)
                $ligne->setChequen($chequen);
            $ligne->save();
            if ($idlignerubrique && $idlignerubrique != "")
                $ligne->setIdBudget($idlignerubrique);
            $ligne->save();
            //ajouter ligne doc par quittance
            $listeslignesdoc = $params['listearticle'];
            $lignedoc_caisse = Doctrine_Core::getTable('lignearticlecaisse')->findByIdLigneoperationcaisse($ligne->getId());
            if (count($lignedoc_caisse) > 0) {
                Doctrine_Query::create()->delete('lignearticlecaisse')
                        ->where('id_ligneoperationcaisse=' . $ligne->getId())->execute();
            }
            foreach ($listeslignesdoc as $ligne_art) {
                $idligne = $ligne_art['idligne'];
                $ligne_article_caisse = new Lignearticlecaisse();
                $ligne_article_caisse->setIdLignearticle($idligne);
                $ligne_article_caisse->setIdLigneoperationcaisse($ligne->getId());
                $ligne_article_caisse->save();
            }
            /*             * ***************modification engagement budget ************ */
            if ($achat_document->getMntttc() == 0.000 || $achat_document->getMntttc() == null):
//                $lignesbudgets = Doctrine_Core::getTable('ligprotitrub')->findOneById($idlignerubrique);
                /*                 * ****test de quitance provisoire **** */
//            $mntquitance_prov = $ligneoper->getMntoperation();
//            $mntquitance_prov = $mnt;
                /* test existance du quitance provioire */
                $quitance = LigneoperationcaisseTable::getInstance()->findbyIdCategorieAndIdDocachat(2, $achat_document->getId());
                $quitance_pro = LigneoperationcaisseTable::getInstance()->findbyIdCategorieAndIdDocachat(1, $achat_document->getId());
//                if (count($quitance) == 0) {
//                    if ($lignesbudgets) {
//                        $doc_budget_pov = DocumentbudgetTable::getInstance()->findOneByIdBudgetAndIdType($lignesbudgets->getId(), 3);
//                        if ($doc_budget_pov)
//                            $mntquitanceprov = $doc_budget_pov->getMnt();
//                        else
//                            $mntquitanceprov = 0;
//                        $ligne = $lignesbudgets;
//                        $mnt_provisoire = 0;
//                        if ($ligne->getMntprovisoire() != null)
//                            $mnt_provisoire = $ligne->getMntprovisoire();
//                        $mnt_provisoire = floatval($mnt_provisoire + $mnt);
//                        $ligne->setMntprovisoire($mnt_provisoire);
//                        $ligne->setRelicaengager($ligne->getMnt() - $ligne->getMntengage());
//                        $ligne->save();
//                        $ligne = $lignesbudgets;
//                        $piecejoint = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($achat_document->getId());
////                        $piecej = new Piecejointbudget();
////                        $piecej->setIdDocachat($achat_document->getId());
////                        $piecej->setIdDocumentbudget($doc_budget_pov->getId());
////                        $piecej->setIdType(4);
////                        $piecej->save();
////                           die(count($piecejoint).'gfg'.$achat_document->getId());
//                        $id_docbudget = $doc_budget_pov->getId();
//                        $documentbudget = DocumentbudgetTable::getInstance()->findById($id_docbudget)->getFirst();
//                        $doc = $documentbudget;
//                        $mnt_budger = $doc->getMnt();
//                        $mnt_budger+= $mnt;
//                        $doc->setMnt($mnt);
//                        $doc->setMntnet($mnt);
//                        $doc->setMntengage($ligne->getMntprovisoire());
//                        $relicat = $ligne->getMntencaisse() - $ligne->getMntprovisoire();
//                        $doc->setMntrelicat($relicat);
//                        $doc->save();
//                    }
//                }
//                if (count($quitance) >= 1) {
//                    $ligne = LigprotitrubTable::getInstance()->find($quitance->getFirst()->getIdBudget());
//                    $doc_budget_pov = DocumentbudgetTable::getInstance()->findOneByIdBudgetAndIdType($lignesbudgets->getId(), 1);
//
//                    if ($doc_budget_pov)
//                        $mntquitanceprov = $quitance->getFirst()->getMntoperation();
//                    else
//                        $mntquitanceprov = 0;
////                    die($mntquitanceprov);
//                    $ligne = $lignesbudgets;
//                    $mnt_provisoire = 0;
//                    if ($ligne->getMntprovisoire() != null)
//                        $mnt_provisoire = $ligne->getMntprovisoire();
//                    $mnt_provisoire = $mnt_provisoire - $mntquitanceprov + $mnt;
//                    $ligne->setMntprovisoire($mnt_provisoire);
//                    $mnteng = $ligne->getMntengage();
//                    $mntengfinal = $mnteng + $mnt;
//                    $ligne->setMntengage($mntengfinal);
//                    $ligne->setRelicaengager($ligne->getMnt() - $mntengfinal);
//                    $ligne->save();
//                    $piecejoint = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($iddoc_achat);
//                    $id_docbudget = $piecejoint->getidDocumentbudget();
//                    $documentbudget = DocumentbudgetTable::getInstance()->findById($id_docbudget)->getFirst();
//                    $doc = $documentbudget;
//                    $mnt_budger = $doc->getMnt();
//
//                    $mnt_budger+= $mnt;
//                    $doc->setMnt($mnt);
//                    $doc->setMntnet($mnt);
//                    $doc->setMntengage($ligne->getMntprovisoire());
//                    $relicat = $ligne->getMntencaisse() - $ligne->getMntprovisoire();
//                    $doc->setMntrelicat($relicat);
//                    $doc->save();
//                }
            endif;
            /*             * ***fin modification engagement budget****** */
            die('bien');
        }
    }

    public function executeSavespiecepreengagementBDCNULL(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $numero = $params['numero'];
            $iddoc_achat = $params['iddoc'];
            $idCatoperation = $params['idCatoperation'];
            $id_user = $params['id_user'];
            $date = date('Y-m-d', strtotime($params['date']));
            $mnt = $params['mnt']; //die($iddocbudget.'hh');
            $id_demandeur = $params['id_demandeur'];
            $id_caisse = $params['id_caisse'];
            $objet = $params['objet'];
            $chequen = $params['chequen'];
            $idcaisse = $params['idcaisse'];

            $achat_document = Doctrine_Core::getTable('documentachat')->findOneById($iddoc_achat);
            $achat_document->setIdEtatdoc(56);
            $achat_document->save();
            $ligne = new Ligneoperationcaisse();
            if ($idcaisse && $idcaisse != "") {
                $ligneoperation = Doctrine_Core::getTable('ligneoperationcaisse')->findOneById($idcaisse);
                // die($lignesbudgets);
                if ($ligneoperation) {
                    $ligne = $ligneoperation;
                }
            }
            if ($numero)
                $ligne->setNumeroo($numero);
            if ($id_user)
                $ligne->setIdUser($id_user);
            if ($id_demandeur && $id_demandeur != "")
                $ligne->setIdDemarcheur($id_demandeur);
            if ($id_caisse)
                $ligne->setIdCaisse($id_caisse);

            if ($iddoc_achat)
                $ligne->setIdDocachat($iddoc_achat);
            if ($objet)
                $ligne->setObjet($objet);
            if ($date)
                $ligne->setDateoperation($date);
            if ($idCatoperation)
                $ligne->setIdCategorie($idCatoperation);
            if ($mnt)
                $ligne->setMntoperation($mnt);

            if ($chequen)
                $ligne->setChequen($chequen);
            $ligne->setEtat('Actif');
            $ligne->save();
            $listeslignesdoc = $params['listearticle'];
            $lignedoc_caisse = Doctrine_Core::getTable('lignearticlecaisse')->findByIdLigneoperationcaisse($ligne->getId());
            if (count($lignedoc_caisse) > 0) {
                Doctrine_Query::create()->delete('lignearticlecaisse')
                        ->where('id_ligneoperationcaisse=' . $ligne->getId())->execute();
            }
            foreach ($listeslignesdoc as $ligne_art) {
                $idligne = $ligne_art['idligne'];
                $ligne_article_caisse = new Lignearticlecaisse();
                $ligne_article_caisse->setIdLignearticle($idligne);
                $ligne_article_caisse->setIdLigneoperationcaisse($ligne->getId());
                $ligne_article_caisse->save();
            }
            die('bien');
        }
    }

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());
//        $filter = $this->filters;
//        $ciassebanque = Doctrine_Core::getTable('caissesbanques')
//                        ->createQuery('a')->where('id_typecb=' . $idtype);
//       
//        $query = $ciassebanque->OrderBy('id desc');
//        $this->filters
        $this->addSortQuery($query);
        if (!isset($filter['dateouvert']['from']) && !isset($filter['dateouvert']['to'])) {
            $query = $query->Andwhere("dateouvert >='" . date('Y') . "-01-01" . "'")
                    ->Andwhere("dateouvert <='" . date('Y') . "-12-31" . "'")
            ;
        }
        $query = $query->where('id_typecb=1')->OrderBy('id desc');
        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        return $query;
    }

    public function executeListeCompteForTransfert(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idbanque'];

            $q = Doctrine_Query::create()
                    ->select("id, libelle, rib as codeop")
                    ->from('caissesbanques')
                    ->where('id <>' . $id)
                    ->andWhere("id_typecb = 1");
            $q = $q->orderBy('libelle')
                    ->fetchArray();
            die(json_encode($q));
        }
        die('Erreur');
    }

    public function executeAddnewsolde(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idbanque'];
            $mnt = $params['mnt'];
            Doctrine_Query::create()
                    ->update('caissesbanques')
                    ->set('mntouverture', '?', $mnt)
                    ->set('mntprov', '?', $mnt)
                    ->set('mntdefini', '?', $mnt)
                    ->where('id=' . $id)
                    ->execute();
            die('bien');
        }
        die('Erreur');
    }

    public function executeLastOpeartionInCompte(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idbanque'];
            $mvt = MouvementbanciareTable::getInstance()->getLastOpeartionInCompte($id);
            if ($mvt != null)
                die(json_encode($mvt->getNumero()));
            else
                die(json_encode(''));
        }
        die('Erreur');
    }

    public function executeAffichedetailcaisseSuivi(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idbanque'];

            $q = Doctrine_Query::create()
                    ->select("*")
                    ->from('caissesbanques c')
                    ->where('id=' . $id)
                    ->fetchArray()

            ;
            die(json_encode($q));
        }
//        if (!empty($content)) {
//            $params = json_decode($content, true);
//            $id = $params['idbanque'];
//            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//
//
//            $q1 = "select .*"
//                    . " from caissesbanques "
//                    . " Where caissesbanques.id= " . $id
//            ;
//            $resultat1 = $conn->fetchAssoc($q1);
//            $q = "select COALESCE(Sum(mouvementbanciare.debit),0) as depense "
//                    . ", COALESCE( SUM(mouvementbanciare.credit),0) as recette"
//                    . " from mouvementbanciare ,caissesbanques "
//                    . " Where mouvementbanciare.id_banque=" . $id
//                    . " and caissesbanques.id= " . $id
//            ;
//            $resultat = $conn->fetchAssoc($q);
//
//            die(json_encode($resultat));
//        }
        die('Erreur');
    }

    public function executeAffichedetailSolde(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idbanque'];
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $q = "select COALESCE(Sum(mouvementbanciare.debit),0) as depense "
                    . ", COALESCE( SUM(mouvementbanciare.credit),0) as recette"
                    . " from mouvementbanciare ,caissesbanques "
                    . " Where mouvementbanciare.id_banque=" . $id
                    . " and caissesbanques.id= " . $id
//                    . " and  mouvementbanciare.dateoperation >= '14-01-2021'"
//                    . " and mouvementbanciare.dateoperation <= '31-12-2021' "
            ;
//            if ($date_debut != '') {
//            $q = $q->andWhere('mv.dateoperation >= ?', $date_debut);
//        }
//        if ($date_fin != '') {
//            $q = $q->andWhere('mv.dateoperation <= ?', $date_fin);
//        }
            $resultat = $conn->fetchAssoc($q);
            die(json_encode($resultat));
        }
        die('Erreur');
    }

    public function executeAffichedetailquitanceSuivi(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idbanque'];
            $query = "SELECT  COALESCE(Sum(ligneoperationcaisse.mntoperation),0) as mntquitanced "
                    . " FROM caissesbanques,ligneoperationcaisse  "
                    . " where caissesbanques.id=" . $id
                    . " and id_categorie=2"
                    . " and ligneoperationcaisse.etat ='Actif'";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }
        die('Erreur');
    }

    public function executeAffichedetailquitanceSuiviProvisoire(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idbanque'];
            $query = "SELECT  COALESCE( Sum(ligneoperationcaisse.mntoperation),0) as mntquitancep "
                    . " FROM caissesbanques,ligneoperationcaisse "
                    . " where caissesbanques.id=" . $id
                    . " and id_categorie=1  "
                    . " and ligneoperationcaisse.etat ='Actif'";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//            die($query);
            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }
        die('Erreur');
    }

    public function executeAffichedetailcaisse(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idbanque'];

            $q = Doctrine_Query::create()
                    ->select("*")
                    ->from('caissesbanques c')
                    ->where('id=' . $id)
                    ->fetchArray()

            ;
            die(json_encode($q));
        }
        die('Erreur');
    }

    public function executeImprimerCaisse(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $id = $request->getParameter('id');
        $caisse = CaissesbanquesTable::getInstance()->find($id);

        //Doctrine_Core::getTable('lignedocachat')->findByIdDoc($iddoc);
        // pdf object
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Fiche Caisse');
        $pdf->SetSubject("document du caisse");
        $soc = SocieteTable::getInstance()->find(1);
        $entete = $soc->getRs();
        $pdf->SetAuthor($entete);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');


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

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // dejavusans or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);
//$pdf->SetFont('dejavusans', '', 12);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
//      


        $html = $this->ReadHtmlCaisse($caisse);

        $pdf->writeHTML($html, true, false, true, false, '');

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('caisse.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlCaisse($caisse) {
        $html = StyleCssHeader::header1();
        $html .= $caisse->ReadHtmlCaisse();

        return $html;
    }

//************************tester le montant definitf avec provisoire

    public function executeTesterQuitancedefavectotalprovisoire(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $msg = 'bien';
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_docachat = $params['id'];
            $mntquitancedef = $params['mntoperation'];
            $quitancepro = LigneoperationcaisseTable::getInstance()->findOneByIdDocachat($id_docachat);
            $mntquitancepro = $quitancepro->getMntoperation();
            if ($mntquitancedef > floatval($mntquitancepro))
                $msg = 0;
            else
                $msg = 1;
        }
        return $this->renderText($msg);
    }

//tester le nombre des quitance proviosire avec le nombre des quitance total   
    public function executeTesterQuitancedefavecnombreprovisire(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $msg = 'bien';
        $params = array();
        $content = $request->getContent();
        $user = $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_docachat = $params['id'];

            $quitancepro = LigneoperationcaisseTable::getInstance()->findByIdDocachatAndIdCategorie($id_docachat, 1);
            $quitancedef = LigneoperationcaisseTable::getInstance()->findByIdDocachatAndIdCategorie($id_docachat, 2);
            if (sizeof($quitancedef) == (sizeof($quitancepro) - 1))
                $msg = 1;
            else
                $msg = 0;
        }
        return $this->renderText($msg);
    }

}
