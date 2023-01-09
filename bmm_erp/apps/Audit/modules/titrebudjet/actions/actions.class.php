<?php

require_once dirname(__FILE__) . '/../lib/titrebudjetGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/titrebudjetGeneratorHelper.class.php';

/**
 * titrebudjet actions.
 *
 * @package    Bmm
 * @subpackage titrebudjet
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class titrebudjetActions extends autoTitrebudjetActions {
    /*     * ***      valider attachement du scan       */

    public $type = "";

    public function executeIndex(sfWebRequest $request) {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }
        $this->type_budget = $request->getParameter('type', '');
//        $this->type = $request->getParameter('type', '');

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();
    }

    public function executeValiderattachement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idbudget'];
            $chaine = $params['chaine'];
            $piecejoint = new Piecejoint();
            $titre = Doctrine_Core::getTable('titrebudjet')->findOneById($id); //die($id.'hh');
            if ($titre) {
                $piecejoint->setIdTitrebudget($id);
                $piecejoint->setObjet("Budget:" . $titre);
            }

            $piecejoint->setIdTypepiece(7);

            $piecejoint->setChemin($chaine);
            $piecejoint->save();
            $this->CreateDossier($titre->getId() . '_' . $titre, $chaine);
            $q = Doctrine_Query::create()
                    ->select("piecejoint.objet as piece,  piecejoint.id")
                    ->from('piecejoint')
                    ->where('id_titrebudget=' . $id);

            $listespieces = $q->fetchArray();

            die(json_encode($listespieces));
        }
    }

    public function CreateDossier($url, $chaine) {
        $dossier = 'E:/xampp/htdocs/UploadBmmERP/' . urldecode($url);
        if (!is_dir($dossier)) {
            mkdir($dossier);
        }
        copy(sfconfig::get('sf_appdir') . 'uploads/scanner/' . $chaine, $dossier . '/' . $chaine);
    }

    public function executeUploaderfile(sfWebRequest $request) {

        $id = $_REQUEST['idbudget'];
        $titre = trim(str_replace(":", "", $_REQUEST['titre'])) . '_' . strtotime(date('Y-m-d H:m:s'));
        $name = explode(".", $_FILES['fileSelected']['name']);
        $nom = $titre;
        $uploads_dir = sfConfig::get('sf_upload') . $nom . '.' . $name[1];
        move_uploaded_file($_FILES['fileSelected']['tmp_name'], $uploads_dir);
        $piece_joint = new Piecejoint();
        $piece_joint->setChemin($nom . '.' . $name[1]);
        $piece_joint->setIdTitrebudget($id);
        $piece_joint->save();
        die("Ajout avec succès");
    }

    /*     * * fin scan * */

    public function executeAffichesousdetail(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idlot'];
            $detailbudget = new Titrebudjet(); //die($id.'hh');
            $listesdetais = Doctrine_Core::getTable('titrebudjet')
                    ->createQuery('a')->where('id=' . $id)
                    ->execute();
            if (count($listesdetais) > 0) {
                $detailbudget = $listesdetais[0];
            }
            die($detailbudget->GetJson());
        }
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = $this->configuration->getForm();
        $this->titrebudjet = $this->form->getObject();
        $this->prototype = "Exercice:" . date('Y');
        if ($request->getParameter('prototype'))
            $this->prototype = $request->getParameter('prototype');
        if ($request->getParameter('type'))
            $this->prototype = $request->getParameter('type');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->titrebudjet = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->titrebudjet);
        $this->prototype = trim($this->titrebudjet->getTypebudget());
//        $this->prototype = "Exercice:" . date('Y');
//        if ($request->getParameter('prototype'))
//            $this->prototype = $request->getParameter('prototype');
//        if ($request->getParameter('type'))
//            $this->prototype = $request->getParameter('type');
    }

    public function executeDetailbudget(sfWebRequest $request) {
        $this->titrebudjet = new Titrebudjet();
        $this->titrebudjet = Doctrine_Core::getTable('titrebudjet')->findOneById($request->getParameter('id'));
    }

    public function executeSavesousdetail(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idbudget'];
            $idtype = $params['idtype'];
            $sousdetail = $params['sousdetail'];
            $detailbudget = new Titrebudjet();
            $listesdetais = Doctrine_Core::getTable('titrebudjet')
                            ->createQuery('a')->where('id=' . $id)->execute();
            if (count($listesdetais) > 0) {
                $detailbudget = $listesdetais[0];
            }
            $detailbudget->setEtatbudget($idtype);
            $detailbudget->save();

            foreach ($sousdetail as $sdetail) {

                $nordre = $sdetail['nordre'];
                $designation = $sdetail['designation'];
                $totalht = $sdetail['mnt'];
                $SousRubriques = $sdetail['sousrubrique'];
                $idligne = $sdetail['idligne'];

                $ligne_budget = new Ligprotitrub();
                $rub = new Rubrique(); //*****
//                $ss = Doctrine_Core::getTable('ligprotitrub')->findOneByIdTitreAndNordre($id, $nordre);
                if ($idligne != "") {
                    $ss = LigprotitrubTable::getInstance()->find($idligne);
                    if ($ss) {
                        $ligne_budget = $ss;
                        //Debut *****
                        $rubrique = RubriqueTable::getInstance()->find($ligne_budget->getIdRubrique());
                        if ($rubrique)
                            $rub = $rubrique;
                        //Fin   *****
                    }
                }

                //Debut ****************************************************// ce code est remplacé par le code du *****
//                $rub = new Rubrique();
//                $lignebudget = Doctrine_Core::getTable('ligprotitrub')->findByIdTitre($detailbudget->getId());
//                foreach ($lignebudget as $ligne) {
//                    //$designation=  str_replace($ligne, $lignebudget, $rub)
//                    $rubrique = Doctrine_Core::getTable('rubrique')->findOneByIdAndLibelle($ligne->getIdRubrique(), $designation);
//
//                    if ($rubrique)
//                        $rub = $rubrique;
//                }
                //Fin   ****************************************************//
//                $query = "SELECT ligprotitrub.id_rubrique  "
//                        . "FROM ligprotitrub   "
//                        . "WHERE id_titre=" . $detailbudget->getId()
//                        . " and rubrique.id=ligprotitrub.id_rubrique "
//                        . " and trim(rubrique.libelle) like trim('" . $designation . "')";
//                die($query);
//                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//                $Rubriques = $conn->execute($query);
//////                    $Rubriques = Doctrine_Core::getTable('rubrique')
//////                                    ->createQuery('a')->where("trim(libelle) like '" . trim($designation) . "'")->execute();
//                $id_rib = -1;
//
//                foreach ($Rubriques as $rib)
//                    $id_rib = $rib['id'];
//                if (count($Rubriques) > 0 && $id_rib != -1)
//                    $rub = Doctrine_Core::getTable('rubrique')->findOneById($id_rib);
                $rub->setLibelle($designation);
                $rub->save();
                $ligne_budget->setIdTitre($detailbudget->getId());
                $ligne_budget->setIdRubrique($rub->getId());
                if ($totalht && $totalht != "")
                    $ligne_budget->setMnt($totalht);
                $ligne_budget->setNordre($nordre);
                $ligne_budget->save();

                foreach ($SousRubriques as $sr) {
                    $nordre_s = $sr['nordre'];
                    $designation_s = $sr['designation'];
                    $idligne_sous_rubrique = $sr['idligne'];
                    if (isset($sr['mnt']))
                        $mnt_s = $sr['mnt'];
                    else
                        $mnt_s = "";
                    $ligne_budget1 = new Ligprotitrub();
                    $sous_rub = new Rubrique(); //*****
//                    $ss1 = Doctrine_Core::getTable('ligprotitrub')->findOneByIdTitreAndNordre($id, $nordre_s);

                    if ($idligne_sous_rubrique != "") {
                        $ss1 = Doctrine_Core::getTable('ligprotitrub')->findOneById($idligne_sous_rubrique);
                        if ($ss1) {
                            $ligne_budget1 = $ss1;
                            //Debut *****
                            $Sous_Rubriques = RubriqueTable::getInstance()->find($ligne_budget1->getIdRubrique());
                            if ($Sous_Rubriques)
                                $sous_rub = $Sous_Rubriques;
                            //Fin   *****
                        }
                    }

                    //Debut ****************************************************// ce code est remplacé par le code du *****
//                    $sous_rub = new Rubrique();
//                    $Sous_Rubriques = Doctrine_Core::getTable('rubrique')->findOneByIdRubriqueAndLibelle($rub->getId(), $designation_s);
////                    Doctrine_Core::getTable('rubrique')
////                                    ->createQuery('a')->where("libelle like '%" . $designation_s . "%'")
////                                    ->AndWhere('id_rubrique=' . $rub->getId())->execute();
//                    if ($Sous_Rubriques) {
//                        $sous_rub = $Sous_Rubriques;
//                    }
                    //Fin   ****************************************************//

                    $sous_rub->setLibelle($designation_s);
                    $sous_rub->setIdRubrique($rub->getId());
                    $sous_rub->save();
                    $ligne_budget1->setIdTitre($id);
                    $ligne_budget1->setNordre($nordre_s);
                    $ligne_budget1->setIdRubrique($sous_rub->getId());
                    if ($mnt_s && $mnt_s != "")
                        $ligne_budget1->setMnt($mnt_s);
                    $ligne_budget1->save();
                }
            }

            die($detailbudget->GetJson());
        }
    }

    public function executeDeletesousdetail(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['idsousdetail'];

            $ligne = Doctrine_Core::getTable('ligprotitrub')->findOneById($id);

            if ($ligne) {
                $idlignerubrique = $ligne->getIdRubrique();
                $id_titre = $ligne->getIdTitre();
                $query = Doctrine_Query::create()
                        ->delete('ligprotitrub')
                        ->where('id=' . $id);
                //die($query);
                $query = $query->execute();
                $rubriques = Doctrine_Core::getTable('rubrique')->findByIdRubrique($ligne->getIdRubrique());
//                if (count($rubrique) > 0) {
                foreach ($rubriques as $rub) {
                    $query = Doctrine_Query::create()
                            ->delete('ligprotitrub')
                            ->where('id_rubrique=' . $rub->getId())
                            ->andWhere('id_titre=' . $id_titre);
                    $query = $query->execute();
                }

//                    $query = Doctrine_Query::create()
//                                    ->delete('rubrique')
//                                    ->where('id_rubrique=' . $rubrique[count($rubrique) - 1]->getId())->execute();
//
//                    $query = Doctrine_Query::create()
//                                    ->delete('rubrique')
//                                    ->where('id=' . $rubrique[count($rubrique) - 1]->getId())->execute();
//                } else {
//                    $query = Doctrine_Query::create()
//                                    ->delete('rubrique')
//                                    ->where('id=' . $idlignerubrique)->execute();
//                }
            }


            die("bien");
        }
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $titrebudjet = $form->save();
                $titre = new Titrebudjet();
                $budget = Doctrine_Core::getTable('titrebudjet')->findOneById($titrebudjet->getId());

                if ($budget) {
                    $titre = $budget;
                    if ($request->getParameter('prototypebudget') && $request->getParameter('prototypebudget') != "0") {
                        $titre->setIdTitrebudget($request->getParameter('prototypebudget'));
                        if ($titre->getEtatbudget() == null)
                            $titre->setEtatbudget(1);
                        $titre->save();
                        $titre->CopierRubriqueEtSousRubrique($request->getParameter('prototypebudget'));
                    } else {
                        if (trim($titre->getTypebudget()) == "Budget Prévisionnel Global") {
                            if ($titre->getLigprotitrub()->count() == 0) {
                                $titre_budget_annees = TitrebudjetTable::getInstance()->getByTypeForGlobal(date('Y', strtotime($titre->getDatecreation())));
                                foreach ($titre_budget_annees as $titre_budget_annee) {
                                    $titre->CopierRubriqueEtSousRubriqueForGlobal($titre_budget_annee->getId());
                                }
                                //set total montant global
                                $montant_titres = LigprotitrubTable::getInstance()->getTotalTitreBudget($titre->getId());
                                $titre->setMntglobal($montant_titres);
                                $titre->save();
                            }
                        }
                        if ($titre->getEtatbudget() == null) {
                            $titre->setEtatbudget(1);
                            $titre->save();
                        }
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $titrebudjet)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@titrebudjet_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'titrebudjet_edit', 'sf_subject' => $titrebudjet));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);
        $query = $this->filters->buildQuery($this->getFilters());

        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        if (isset($_SESSION['exercice_budget']) && $_SESSION['exercice_budget'] != null && $this->type_budget != 'Prototype') {
            $query = $query->andWhere("EXTRACT(YEAR FROM datecreation) = '" . $_SESSION['exercice_budget'] . "'");
        }

        if ($this->type_budget == "Budget Prévisionnel") {
            $query = $query->AndWhere("typebudget like '%Budget Prévisionnel / Direction & Projet%'")->OrderBy('id desc');
        } elseif ($this->type_budget == "Budget Prévisionnel Global") {
            $query = $query->AndWhere("typebudget like '%Budget Prévisionnel Global%'")->OrderBy('id desc');
        } elseif ($this->type_budget == 'Final') {
            $query = $query->AndWhere("typebudget not like '%Prototype%'");
            $query = $query->AndWhere("typebudget not like '%Budget Prévisionnel / Direction & Projet%'");
            $query = $query->AndWhere("typebudget not like '%Budget Prévisionnel Global%'");
            $query = $query->AndWhere("typebudget like '%" . $_SESSION['exercice_budget'] . "%'")->OrderBy('id desc');
        } else {
            $query = $query->AndWhere("typebudget like '%Prototype%'")->OrderBy('id desc');
        }


        return $query;
    }

    public function executeImprimerListe(sfWebRequest $request) {
        $type = $request->getParameter('type', "");
        $pdf = new sfTCPDF('L');

// set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste Budgets');
        $pdf->SetSubject("Liste Budgets");
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
        $html = $this->ReadHtmlListeBudget($type);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste Budgets.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeBudget($type) {
        $html = StyleCssHeader::header1();
        $budget = new Titrebudjet();
        $html .= $budget->ReadHtmlListeBudget($type);
        return $html;
    }

    public function executeRecapCourant(sfWebRequest $request) {
        
    }

    public function executeRecapFinMois(sfWebRequest $request) {
        
    }

    public function executeAfficherEtatRecap(sfWebRequest $request) {
        $this->mois = $request->getParameter('mois');
        $this->annee = $request->getParameter('annee');
        $this->titre = $request->getParameter('titre');
        $this->listes = RecapbudgetTable::getInstance()->getByAnneeAndMois($this->annee, $this->mois, $this->titre);
    }

    public function executeAfficherSousEtatRecap(sfWebRequest $request) {
        $this->mois = $request->getParameter('mois');
        $this->annee = $request->getParameter('annee');
        $this->titre = $request->getParameter('titre');
        $this->id_rubrique = $request->getParameter('id_rubrique');
        $this->listes = RecapbudgetTable::getInstance()->getSousByAnneeAndMois($this->annee, $this->mois, $this->titre, $this->id_rubrique);
    }

    public function executeImprimerRecap(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('RECAPITULATIF DES ENGAGEMENTS BUDGETAIRES');
        $pdf->SetSubject("RECAPITULATIF DES ENGAGEMENTS BUDGETAIRES");
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
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 10);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlRecap($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('RECAPITULATIF DES ENGAGEMENTS BUDGETAIRES.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlRecap(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $recap = new Recapbudget();
        $html .= $recap->ReadHtmlRecap($request);
        return $html;
    }

    public function executeRecapDepenseCourant(sfWebRequest $request) {
        
    }

    public function executeRecapDepenseFinMois(sfWebRequest $request) {
        
    }

    public function executeAfficherEtatRecapDepense(sfWebRequest $request) {
        $this->mois = $request->getParameter('mois');
        $this->annee = $request->getParameter('annee');
        $this->titre = $request->getParameter('titre');
        $this->listes = RecapDeponseTable::getInstance()->getByAnneeAndMois($this->annee, $this->mois, $this->titre);
    }

    public function executeAfficherSousEtatRecapDepense(sfWebRequest $request) {
        $this->mois = $request->getParameter('mois');
        $this->annee = $request->getParameter('annee');
        $this->titre = $request->getParameter('titre');
        $this->id_rubrique = $request->getParameter('id_rubrique');
        $this->listes = RecapDeponseTable::getInstance()->getSousByAnneeAndMois($this->annee, $this->mois, $this->titre, $this->id_rubrique);
    }

    public function executeImprimerRecapDepense(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('RECAPITULATIF DES DEPENSES');
        $pdf->SetSubject("RECAPITULATIF DES DEPENSES");
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
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 10);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlRecapDepense($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('RECAPITULATIF DES DEPENSES.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlRecapDepense(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $recap = new Recapdeponse();
        $html .= $recap->ReadHtmlRecap($request);
        return $html;
    }

    public function executeSituationCumulee(sfWebRequest $request) {
        
    }

    public function executeAfficherTableauSituation(sfWebRequest $request) {
        $this->annee_debut = $request->getParameter('annee_debut');
        $this->annee_fin = $request->getParameter('annee_fin');
        $this->titre = $request->getParameter('titre');
        $this->type_montant = $request->getParameter('type_montant');
    }

    public function executeSaveMontantSituation(sfWebRequest $request) {
        $montant = $request->getParameter('montant');
        $annee = $request->getParameter('annee');
        $id = $request->getParameter('id');
        $type_montant = $request->getParameter('type_montant');

        $situations = SituationcumuleeTable::getInstance()->findByIdLigprotitreAndAnnees($id, $annee);
        if ($situations->count() != 0) {
            foreach ($situations as $situation) {
                if ($type_montant == 0)
                    $situation->setMntEngagement($montant);
                else
                    $situation->setMntPaiement($montant);

                $situation->save();
            }
        }else {
            for ($i = 1; $i <= 12; $i++) {
                $ligprotitre = LigprotitrubTable::getInstance()->find($id);

                $situation = new Situationcumulee();

                $situation->setMois($i);
                $situation->setAnnees($annee);
                $situation->setIdLigprotitre($id);

                $situation->setIdRubrique($ligprotitre->getIdRubrique());
                $situation->setIdTitre($ligprotitre->getIdTitre());
                $situation->setLibRubrique($ligprotitre->getRubrique()->getLibelle());

                if ($type_montant == 0)
                    $situation->setMntEngagement($montant);
                else
                    $situation->setMntPaiement($montant);

                $situation->save();
            }
        }
        return true;
    }

    public function executeRecapSituationCumulee(sfWebRequest $request) {
        
    }

    public function executeAfficherEtatRecapSituation(sfWebRequest $request) {
        $this->min_mois = $request->getParameter('min_mois');
        $this->max_mois = $request->getParameter('max_mois');
        $this->titre = $request->getParameter('titre');
        $this->min_annee = $request->getParameter('min_annee');
        $this->max_annee = $request->getParameter('max_annee');

        $this->liste = calculSituationCumulee::getSituation($this->titre, $this->min_mois, $this->max_mois, $this->min_annee, $this->max_annee);
    }

    public function executeImprimerRecapSituation(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('RECAPITULATIF SITUATION CUMULEE');
        $pdf->SetSubject("RECAPITULATIF SITUATION CUMULEE");
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
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 10);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlRecapSituation($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('RECAPITULATIF SITUATION CUMULEE.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlRecapSituation(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $recap = new Situationcumulee();
        $html .= $recap->ReadHtmlRecapSituation($request);
        return $html;
    }
    public function executeGetPrototypeByOrigineAndCategorie($request)
    {
        header('Access-Control-Allow-Origin: *');
        $html='';
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_origine=$params['id_origine'];
            $id_categorie=$params['id_categorie'];
            $prototypes=TitrebudjetTable::getInstance()->findByIdSourceAndIdCatAndTypebudget($id_origine,$id_categorie,'Prototype');
            // die($prototypes);
            foreach($prototypes as $prototype):
                $html.='<option value="'.$prototype->getId().'">'.$prototype.'</option>';
            endforeach;
        }
        die($html);
    }
    public function executeGetCodeRubrique(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $code = $params['code'];
            if ($code) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT trim(ligprotitrub.code) as ref, trim(rubrique.libelle) as name "
                        . " FROM ligprotitrub, rubrique "
                        . "WHERE ligprotitrub.id_rubrique = rubrique.id "
                        . "AND trim(ligprotitrub.code) like '%" . $code . "%' ";
                $titresBudget = $conn->fetchAssoc($query);

                die(json_encode($titresBudget));
            }
        }die('Erreur');
    }

    public function executeGetLibelleRubrique(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $libelle = $params['libelle'];
            if ($libelle) {
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT COALESCE(trim(ligprotitrub.code), '') as name, trim(rubrique.libelle) as ref "
                        . " FROM ligprotitrub, rubrique "
                        . "WHERE ligprotitrub.id_rubrique = rubrique.id "
                        . "AND lower(trim(rubrique.libelle)) like '%" . strtolower($libelle) . "%' ";
                $titresBudget = $conn->fetchAssoc($query);

                die(json_encode($titresBudget));
            }
        }die('Erreur');
    }

    public function executeGetListe(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $etatbudget = $params['etatbudget'];

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT id, mntglobal, libelle "
                    . "FROM titrebudjet "
                    . "WHERE etatbudget = " . $etatbudget . " "
                    . "AND typebudget LIKE '%Exercice%'";

            $resultat = $conn->fetchAssoc($query);
            die(json_encode($resultat));
        }

        die("Erreur");
    }

    public function executeDelete(sfWebRequest $request) {
        $id = $request->getParameter('id', "");
        $query_parents = Doctrine_Query::create()
                ->delete('Ligprotitrub')
                ->where('id_titre=' . $id);
        $query_parents->execute();
        $query = Doctrine_Query::create()
                ->delete('titrebudjet')
                ->where('id=' . $id);
        $query = $query->execute();
        $this->redirect('titrebudjet/index?type=Budget Prévisionnel');
    }

}
