<?php

require_once dirname(__FILE__) . '/../lib/transfertbudgetGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/transfertbudgetGeneratorHelper.class.php';

/**
 * transfertbudget actions.
 *
 * @package    Bmm
 * @subpackage transfertbudget
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class transfertbudgetActions extends autoTransfertbudgetActions {

    public function executeValiderattachement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idbudget'];
            $chaine = $params['chaine'];
            $piecejoint = new Piecejoint();
            $transfert = Doctrine_Core::getTable('transfertbudget')->findOneById($id); //die($id.'hh');
            if ($transfert) {
                $piecejoint->setIdTransfert($id);
                $piecejoint->setObjet("Budget:" . $titre);
            }

            $piecejoint->setIdTypepiece(7);

            $piecejoint->setChemin($chaine);
            $piecejoint->save();
            $this->CreateDossier($titre->getId() . '_' . $titre, $chaine);
            $q = Doctrine_Query::create()
                    ->select("piecejoint.objet as piece,  piecejoint.id")
                    ->from('piecejoint')
                    ->where('id_transfert=' . $id);

            $listespieces = $q->fetchArray();

            die(json_encode($listespieces));
        }
    }

    public function executeUploaderfile(sfWebRequest $request) {
        $id = $_REQUEST['id'];
        $titre = trim(str_replace(":", "", $_REQUEST['titre'])) . '_' . strtotime(date('Y-m-d H:m:s'));
        $name = explode(".", $_FILES['fileSelected']['name']);
        $nom = $titre;
        $uploads_dir = sfConfig::get('sf_upload') . $nom . '.' . $name[1];
        move_uploaded_file($_FILES['fileSelected']['tmp_name'], $uploads_dir);
        $piece_joint = new Piecejoint();
        $piece_joint->setChemin($nom . '.' . $name[1]);
        $piece_joint->setIdTransfert($id);
        $piece_joint->save();
        die("Ajout avec succès");
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
            //Dans le cas du modification : on annule les changements des montants
            if (!$form->getObject()->isNew()) {
                $transfertbudget = new Transfertbudget();
                $transfertbudget = $this->getRoute()->getObject();
                $mnt = $transfertbudget->getMnttransfert();
                if ($transfertbudget->getIdSource() != null) {
                    $ligne_bud_source = LigprotitrubTable::getInstance()->find($transfertbudget->getIdSource());
                    if ($ligne_bud_source) {
                        $ligne_bud_source->setMntretire($ligne_bud_source->getMntretire() + $mnt);
                        $ligne_bud_source->save();
                    }
                    //Mise à jour du Rubrique Parent
                    $rubrique_source = RubriqueTable::getInstance()->find($ligne_bud_source->getIdRubrique());
                    if ($rubrique_source->getIdRubrique() != null) {
                        $grand_ligne_source = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubrique($rubrique_source->getIdRubrique());
                        $grand_ligne_source->setMntexterne($grand_ligne_source->getMntretire() - $mnt);
                        $grand_ligne_source->save();
                    }
                }
                if ($transfertbudget->getIdDestination() != null) {
                    $ligne_bud_dest = LigprotitrubTable::getInstance()->find($transfertbudget->getIdDestination());
                    if ($ligne_bud_dest) {
                        $ligne_bud_dest->setMntexterne($ligne_bud_dest->getMntexterne() - $mnt);
                        $ligne_bud_dest->save();

                        /*                         * *************************** */
                        //Mise à jour du Rubrique Parent
                        $rubrique_destinateur = RubriqueTable::getInstance()->find($ligne_bud_dest->getIdRubrique());
                        if ($rubrique_destinateur->getIdRubrique() != null) {
                            $grand_ligne_dest = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubrique($rubrique_destinateur->getIdRubrique());
                            $grand_ligne_dest->setMntexterne($grand_ligne_dest->getMntexterne() + $mnt);
//                            $grand_ligne_dest->setMnt($grand_ligne_dest->getMntencaisse() - $mnt);
                            $grand_ligne_dest->save();
                        }
                        /*                         * **************************** */

                        //Ajout du montant externe (transfert) dans total externe  dans le titre budget
                        $titrebudget = TitrebudjetTable::getInstance()->find($ligne_bud_dest->getIdTitre());
                        $titrebudget->setMntexterne($titrebudget->getMntexterne() - $mnt);
                        $titrebudget->save();
                    }
                }
            }
            //Fin changements des montants
            try {
                $transfertbudget = $form->save();
                $ligne_bud_source = new Ligprotitrub();
                $ligne_bud_dest = new Ligprotitrub();
                $mnt = $transfertbudget->getMnttransfert();
                if ($transfertbudget->getIdSource()) {
                    $source = Doctrine_Core::getTable('ligprotitrub')->findOneById($transfertbudget->getIdSource());
                    if ($source) {
                        $ligne_bud_source = $source;
                        $ligne_bud_source->setMntretire($ligne_bud_source->getMntretire() - $mnt);
                        $ligne_bud_source->save();
                    }
                    //Mise à jour du Rubrique Parent
                    $rubrique_source = RubriqueTable::getInstance()->find($ligne_bud_source->getIdRubrique());
                    if ($rubrique_source->getIdRubrique() != null) {
                        $grand_ligne_source = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubrique($rubrique_source->getIdRubrique());
                        $grand_ligne_source->setMntexterne($grand_ligne_source->getMntretire() - $mnt);
                        $grand_ligne_source->save();
                    }
                    $rubrique = Doctrine_Core::getTable('rubrique')->findOneById($source->getIdRubrique());
                    if ($rubrique->getIdRubrique() != null) {
                        $rubrique_parent = Doctrine_Core::getTable('rubrique')->findOneById($rubrique->getIdRubrique());
                        if (intval(date('m')) >= 10)
                            $mois = intval(date('m'));
                        else
                            $mois = intval(substr(date('m'), 1, 1));

                        $source_parent = Doctrine_Core::getTable('ligprotitrub')->findByIdRubriqueAndIdTitre($rubrique_parent->getId(), $transfertbudget->getLigprotitrub_2()->getIdTitre());

                        // $recap_parent = Doctrine_Core::getTable('recapbudget')->findByIdLigrubtitreAndMois($source_parent->getFirst()->getId(), $mois)->getFirst();
                        // //   die($source_parent->getFirst()->getId() . 'id_rubrique=' . $recap_parent->getId());
                        // $recap_parent->setMntAllouer($recap->getMntAllouer() - $mnt);
                        // $recap_parent->save();
                        // die($recap_parent->getId() . 'fr');
                    }
                }
                $dest = Doctrine_Core::getTable('ligprotitrub')->findOneById($transfertbudget->getIdDestination());
                if ($dest) {
                    $ligne_bud_dest = $dest;
//                    $ligne_bud_dest->setMnt($ligne_bud_dest->getMnt() + $mnt);
                    $ligne_bud_dest->setMntexterne($ligne_bud_dest->getMntexterne() + $mnt);
//                    $ligne_bud_dest->setMnt($ligne_bud_dest->getMntencaisse() + $mnt);
                    $ligne_bud_dest->save();
                    /*                     * *************************** */
                    //Mise à jour du Rubrique Parent
                    $rubrique_destinateur = RubriqueTable::getInstance()->find($ligne_bud_dest->getIdRubrique());
                    //Mise à jour du Rubrique Parent
                    $rubrique_destinateur = RubriqueTable::getInstance()->find($ligne_bud_dest->getIdRubrique());
                    if ($rubrique_destinateur->getIdRubrique() != null) {
                        $grand_ligne_dest = Doctrine_Core::getTable('ligprotitrub')->findOneByIdRubrique($rubrique_destinateur->getIdRubrique());
                        $grand_ligne_dest->setMntexterne($grand_ligne_dest->getMntexterne() + $mnt);
//                            $grand_ligne_dest->setMnt($grand_ligne_dest->getMntencaisse() - $mnt);
                        $grand_ligne_dest->save();

                        /*                         * rcap du rubrique parent ** */
                        if ($rubrique_destinateur->getIdRubrique() != null) {
                            $rubrique_destinateur_aprent = RubriqueTable::getInstance()->find($rubrique_destinateur->getIdRubrique());
                            if (intval(date('m')) >= 10)
                                $mois = intval(date('m'));
                            else
                                $mois = intval(substr(date('m'), 1, 1));
                            $grand_ligne_dest_parent = Doctrine_Core::getTable('ligprotitrub')->findByIdRubriqueAndIdTitre($rubrique_destinateur_aprent->getId(), $transfertbudget->getLigprotitrub_2()->getIdTitre());
                            // $recap_rubriqueparent = Doctrine_Core::getTable('recapbudget')->findByIdLigrubtitreAndMois($grand_ligne_dest_parent->getFirst()->getId(), $mois)->getFirst();
                            // $recap_rubriqueparent->setMntAllouer($recap->getMntAllouer() + $mnt);
                            // $recap_rubriqueparent->save();
                            // die($recap_rubriqueparent->getId() . 'fr');
                        }
                    }
//                    /*                     * **************************** */
                    //Ajout du montant externe (transfert) dans total externe dans le titre budget
                    $titrebudget = TitrebudjetTable::getInstance()->find($ligne_bud_dest->getIdTitre());
                    $titrebudget->setMntexterne($titrebudget->getMntexterne() + $mnt);
                    $titrebudget->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $transfertbudget)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@transfertbudget_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'transfertbudget_edit', 'sf_subject' => $transfertbudget));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

        $transfertbudget = new Transfertbudget();
        $transfertbudget = $this->getRoute()->getObject();
        $mnt = $transfertbudget->getMnttransfert();
        if ($transfertbudget->getIdSource() != null) {
            $ligne_bud_source = LigprotitrubTable::getInstance()->find($transfertbudget->getIdSource());
            if ($ligne_bud_source) {
                $ligne_bud_source->setMnt($ligne_bud_source->getMnt() + $mnt);
                $ligne_bud_source->setMntencaisse($ligne_bud_source->getMntencaisse() + $mnt);
                $ligne_bud_source->save();
            }
        }
        if ($transfertbudget->getIdDestination() != null) {
            $ligne_bud_dest = LigprotitrubTable::getInstance()->find($transfertbudget->getIdDestination());
            if ($ligne_bud_dest) {
                $ligne_bud_dest->setMntexterne($ligne_bud_dest->getMntexterne() - $mnt);
                $ligne_bud_dest->setMntencaisse($ligne_bud_dest->getMntencaisse() - $mnt);
                $ligne_bud_dest->save();
                //Ajout du montant externe (transfert) dans total externe  dans le titre budget
                $titrebudget = TitrebudjetTable::getInstance()->find($ligne_bud_dest->getIdTitre());
                $titrebudget->setMntexterne($titrebudget->getMntexterne() - $mnt);
                $titrebudget->save();
            }
        }

        if ($this->getRoute()->getObject()->delete()) {
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }

        $this->redirect('@transfertbudget');
    }

    public function executeImprimerListe(sfWebRequest $request) {
        $annee = $request->getParameter('annee', "");
        $pdf = new sfTCPDF('L');

// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Transferts');
        $pdf->SetSubject("Liste Transferts");
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
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

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
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlListeTransfert($annee);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Transferts.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeTransfert($annee) {
        $html = StyleCssHeader::header1();
        $transfert_budget = new Transfertbudget();
        $html .= $transfert_budget->ReadHtmlListeTransfert($annee);
        return $html;
    }

    public function executeIndex(sfWebRequest $request) {
        $etat = $request->getParameter('etat');
        $this->etat = $etat;
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }
        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }
        $this->pager = $this->getPager($etat);
        $this->sort = $this->getSort();
    }

    protected function getPager($etat) {
        $pager = $this->configuration->getPager('transfertbudget');
        $pager->setQuery($this->buildQuery($etat));
        $pager->setPage($this->getPage());
        $pager->init();

        return $pager;
    }

    protected function buildQuery($etat) {

        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }
        $this->filters->setTableMethod($tableMethod);
        $filter = $this->getFilters();
        $query = $this->filters->buildQuery($this->getFilters());
        $this->addSortQuery($query);
        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();
        $transfertbudget = Doctrine_Core::getTable('transfertbudget')
                ->createQuery('a');

        if (isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
            $transfertbudget = $transfertbudget->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
            $transfertbudget = $transfertbudget->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        } elseif (isset($filter['datecreation']['from']) && !isset($filter['datecreation']['to'])) {
            $transfertbudget = $transfertbudget->Andwhere("datecreation>='" . $filter['datecreation']['from'] . "'");
            $transfertbudget = $transfertbudget->Andwhere("datecreation<='" . date('Y') . "-12-31" . "'");
        } elseif (!isset($filter['datecreation']['from']) && isset($filter['datecreation']['to'])) {
            $transfertbudget = $transfertbudget->Andwhere("datecreation>='" . date('Y') . "-01-01" . "'");
            $transfertbudget = $transfertbudget->Andwhere("datecreation<='" . $filter['datecreation']['to'] . "'");
        } else {
            $transfertbudget = $transfertbudget->Andwhere("datecreation>='" . date('Y') . "-01-01" . "'");
            $transfertbudget = $transfertbudget->Andwhere("datecreation<='" . date('Y') . "-12-31" . "'");
        }
        if (isset($filter['id_typetransfert'])) {
            $transfertbudget = $transfertbudget->Andwhere('id_typetransfert=' . $filter['id_typetransfert']);
        }
        if (isset($filter['id_source'])) {
            $transfertbudget = $transfertbudget->Andwhere('id_source=' . $filter['id_source']);
        }
        if (isset($filter['id_destination'])) {
            $transfertbudget = $transfertbudget->Andwhere('id_destination=' . $filter['id_destination']);
        }

        if ($etat)
            $query = $transfertbudget->andWhere("trim(etattransfert) ='" . trim("Annulé(e)") . "'");
        else
            $query = $transfertbudget->andWhere("(trim(etattransfert) !='" . trim("Annulé(e)") . "' or   etattransfert is  null)");
        //  die($query);
        $query = $transfertbudget->OrderBy('id desc');
        return $query;
    }

    public function executeDeleteTransfertBudget(sfWebRequest $request) {
        $request->checkCSRFProtection();
        $this->forward404Unless($transfertbudget = Doctrine_Core::getTable('transfertbudget')->find(array($request->getParameter('id'))), sprintf('Object documentachat does not exist (%s).', $request->getParameter('id')));
        $transfertbudget = TransfertbudgetTable::getInstance()->find($request->getParameter('id'));
        /*         * *edit lig source */
        $lig_source = LigprotitrubTable::getInstance()->find($transfertbudget->getIdSource());
        $mnt = -1 * ( abs($lig_source->getMntretire()) - $transfertbudget->getMnttransfert());
        $lig_source->setMntretire($mnt);

        $lig_source->save();
        //lig parent
        $id_rubrique = $lig_source->getIdRubrique();
        $rubrique = RubriqueTable::getInstance()->find($id_rubrique);
        if ($rubrique->getIdRubrique()) {
            $rubrique_parent = RubriqueTable::getInstance()->find($rubrique->getIdRubrique());
            $lig_source_parent = LigprotitrubTable::getInstance()->getByIdRubriqueAndIdTitre($rubrique_parent->getId(), $lig_source->getIdTitre());
            $mnt_parent = -1 * ( abs($lig_source_parent->getFirst()->getMntretire()) - $transfertbudget->getMnttransfert());
            $lig_source_parent->getFirst()->setMntretire($mnt_parent);
            $lig_source_parent->getFirst()->save();
        }

        $mois = date('m');
        if ($mois < 10)
            $mois = intval(substr($mois, -1));
        else
            $mois = intval($mois);
        $recap_budgets_source = RecapbudgetTable::getInstance()->getByIdLigrubMois($transfertbudget->getIdSource(), $mois);

        foreach ($recap_budgets_source as $recap_budget):
            if ($recap_budget->getMois() >= $mois):
                $mnt_aloue_recap = $recap_budget->getMntAllouer() + $transfertbudget->getMnttransfert();
                $recap_budget->setMntAllouer($mnt_aloue_recap);
                $recap_budget->save();
            endif;
        endforeach;

        if ($rubrique->getIdRubrique()) {
            $rubrique_parent = RubriqueTable::getInstance()->find($rubrique->getIdRubrique());
            $lig_source_parent = LigprotitrubTable::getInstance()->findByIdRubriqueAndIdTitre($rubrique_parent->getId(), $lig_source->getIdTitre())->getFirst();
            $recap_budgets_source_parent = RecapbudgetTable::getInstance()->getByIdLigrubMois($lig_source_parent->getId(), $mois);

            foreach ($recap_budgets_source_parent as $recap_budget_par):
                if ($recap_budget_par->getMois() >= $mois):
                    $mnt_aloue_pp = $recap_budget_par->getMntAllouer() + $transfertbudget->getMnttransfert();
                    $recap_budget_par->setMntAllouer($mnt_aloue_pp);
                    $recap_budget_par->save();
                endif;
            endforeach;
        }

        /*         * *****lig destination********* */
        $lig_designation = LigprotitrubTable::getInstance()->find($transfertbudget->getIdDestination());
        $mnt_externe_des = $lig_designation->getMntexterne() - $transfertbudget->getMnttransfert();
        $lig_designation->setMntexterne($mnt_externe_des);
        $lig_designation->save();
//lig desig parent
        $id_rubrique = $lig_designation->getIdRubrique();
        $rubrique = RubriqueTable::getInstance()->find($id_rubrique);
        if ($rubrique->getIdRubrique()) {
            $rubrique_parent = RubriqueTable::getInstance()->find($rubrique->getIdRubrique());
            $lig_designation_parent = LigprotitrubTable::getInstance()->getByIdRubriqueAndIdTitre($rubrique_parent->getId(), $lig_designation->getIdTitre());
            $mnt_pa = abs($lig_designation_parent->getFirst()->getMntexterne()) - $transfertbudget->getMnttransfert();
            $lig_designation_parent->getFirst()->setMntexterne($mnt_pa);

            $lig_designation_parent->getFirst()->save();
        }
        $mois = date('m');
        if ($mois < 10)
            $mois = intval(substr($mois, -1));
        else
            $mois = intval($mois);
        $recap_budgets_destination = RecapbudgetTable::getInstance()->getByIdLigrubMois($transfertbudget->getIdDestination(), $mois);
        foreach ($recap_budgets_destination as $recap_budget):
            if ($recap_budget->getMois() >= $mois):
                $mnt_aloue = $recap_budget->getMntAllouer() - $transfertbudget->getMnttransfert();
                $recap_budget->setMntAllouer($mnt_aloue);

                $recap_budget->save();
            endif;
        endforeach;
        if ($rubrique->getIdRubrique()) {
            $rubrique_parent = RubriqueTable::getInstance()->find($rubrique->getIdRubrique());
            $lig_designation_parent = LigprotitrubTable::getInstance()->findByIdRubriqueAndIdTitre($rubrique_parent->getId(), $lig_designation->getIdTitre())->getFirst();
            $recap_budgets_destination_par = RecapbudgetTable::getInstance()->getByIdLigrubMois($lig_designation_parent->getId(), $mois);
            foreach ($recap_budgets_destination_par as $recap_budget):
                if ($recap_budget->getMois() >= $mois):
                    $mnt_aloue_pare = $recap_budget->getMntAllouer() - $transfertbudget->getMnttransfert();
                    $recap_budget->setMntAllouer($mnt_aloue_pare);

                    $recap_budget->save();
                endif;
            endforeach;
        }
        $transfertbudget->setEtattransfert('Annulé(e)');
        $transfertbudget->save();
        $this->redirect('@transfertbudget');
        Header('Location: ' . $_SERVER['PHP_SELF']);
        exit(); 
    }

}
