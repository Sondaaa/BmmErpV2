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
        if ($request->getParameter('type'))
            $this->type = $request->getParameter('type', 'abc');

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

    public function executeUploaderfileAlimentation(sfWebRequest $request) {

        $titre = 'Alimentation_' . strtotime(date('Y-m-d H:m:s'));
        $name = explode(".", $_FILES['fileSelected']['name']);
        $nom = $titre;
        $uploads_dir = sfConfig::get('sf_upload') . $nom . '.' . $name[1];
        move_uploaded_file($_FILES['fileSelected']['tmp_name'], $uploads_dir);

        die($nom . '.' . $name[1]);
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
                            ->createQuery('a')->where('id=' . $id)->execute();
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
    }

    public function executeEdit(sfWebRequest $request) {
        $this->titrebudjet = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->titrebudjet);
        $this->prototype = "Exercice:" . date('Y');
        if ($request->getParameter('prototype'))
            $this->prototype = $request->getParameter('prototype');
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
            if ($idtype == 2)
                $detailbudget->setDatesignature(date('Y-m-d'));
            else
                $detailbudget->setDatesignature(null);
            $detailbudget->save();

            foreach ($sousdetail as $sdetail) {
               
                $nordre = $sdetail['nordre'];
                $code = $sdetail['code'];
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
                $rub->setCode($code);
                $rub->save();
                $ligne_budget->setIdTitre($detailbudget->getId());
                $ligne_budget->setIdRubrique($rub->getId());
                if ($totalht && $totalht != "")
                    $ligne_budget->setMnt($totalht);
                $ligne_budget->setNordre($nordre);
                $ligne_budget->setCode($code);
                $ligne_budget->save();

                foreach ($SousRubriques as $sr) {
                    $nordre_s = $sr['nordre'];
                    $code_s = $sr['code'];
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
                    $sous_rub->setCode($code_s);
                    $sous_rub->save();

                    $ligne_budget1->setIdTitre($id);
                    $ligne_budget1->setNordre($nordre_s);
                    $ligne_budget1->setCode($code_s);
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
                        $titre->save();
                        $titre->CopierRubriqueEtSousRubrique($request->getParameter('prototypebudget'));
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
        if ($this->type == "") {
            $query = $query->AndWhere("typebudget not like '%Prototype%'")->OrderBy('datecreation desc');
            
        }else {
            $query = $query->AndWhere("typebudget like '%Prototype%'")->OrderBy('datecreation desc');
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
        $entete =  $soc->getMinistere();
        $rs=$soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');

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
        $entete =  $soc->getMinistere();
        $rs=$soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');

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
        $entete =  $soc->getMinistere();
        $rs=$soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');

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
        $entete =  $soc->getMinistere();
        $rs=$soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');

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

    public function executeValiderattachementAlimentation(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $chaine = $params['chaine'];

            $this->CreateDossier('alimentation_compte', $chaine);

            die(json_encode($chaine));
        }
    }

    public function executeEngagementAntecedent(sfWebRequest $request) {
        
    }

    public function executeGetTitreBudget(sfWebRequest $request) {
        $annee = $request->getParameter('annee');
        $titre_budgets = TitrebudjetTable::getInstance()->getByExercice($annee);
        if ($titre_budgets->count() == 0) {
            $titre_budgets = TitrebudjetTable::getInstance()->getByType('Prototype');
        }

        $this->titre_budgets = $titre_budgets;
    }

    public function executeGetFormAjout(sfWebRequest $request) {
        $annee = $request->getParameter('annee');
        $titre_id = $request->getParameter('titre_id');

        $this->rubriques = LigprotitrubTable::getInstance()->getParentByTitreBudget($titre_id);
        //Charger les engagements définitifs (de type 1) qui n'ont pas passer au ordonnances
        //de paiement (documents budget de type 2) => pour charger les BCIs, les BDCs et les Contrats
        $this->documents = Doctrine_Query::create()
                ->from('Documentachat da')
                ->where('(da.transfertcomptabilite=false OR da.transfertcomptabilite IS NULL)')
                ->andWhere('da.etatdocachat IS NULL')
                ->andWhere('da.id_etatdoc = 11')
                ->andWhere("da.datecreation <= '" . $annee . "-12-31'")
                ->andWhere('(da.id_typedoc = 7 OR da.id_typedoc = 2 OR da.id_typedoc = 19)')
                ->andWhere('da.id NOT IN (SELECT DISTINCT(pjb.id_docachat) FROM piecejointbudget pjb, documentbudget db where pjb.id_documentbudget=db.id and db.id_type=2 and (db.annule=false OR db.annule IS NULL))')
                ->orderBy('da.numero')
                ->execute();

        $this->engagements = EngagementantecedentTable::getInstance()->findByIdTitre($titre_id);
        $this->annee = $annee;
    }

    public function executeGetSousRubrique(sfWebRequest $request) {
        $rubrique_id = $request->getParameter('rubrique_id');
        $titre_id = $request->getParameter('titre_id');
        $this->sous_rubriques = LigprotitrubTable::getInstance()->getSousRubrique($rubrique_id, $titre_id);
    }

    public function executeSaveEngagementAntecedent(sfWebRequest $request) {
        $rubrique_id = $request->getParameter('rubrique_id');
        $id_sous_rubrique = $request->getParameter('id_sous_rubrique');
        $description = $request->getParameter('description');
        $montant = $request->getParameter('montant');
        $id_document_achat = $request->getParameter('id_document_achat');
        $titre_id = $request->getParameter('titre_id');
        $annee = $request->getParameter('annee');

        $engagement = new Engagementantecedent();

        $engagement->setDate(date('Y-m-d'));
        $engagement->setAnnee(intval($annee));
        $engagement->setIdTitre($titre_id);
        if ($id_document_achat != '0' && $id_document_achat != 'null')
            $engagement->setIdDocachat($id_document_achat);
        if ($id_sous_rubrique != '0' && $id_sous_rubrique != 'null')
            $engagement->setIdLigprotitrub($id_sous_rubrique);
        else
            $engagement->setIdLigprotitrub($rubrique_id);
        $engagement->setDescription($description);
        $engagement->setMontant($montant);

        $engagement->save();

        die("OK");
    }

    public function executeDeleteEngagementAntecedent(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $titre_id = $request->getParameter('titre_id');
        $engagement = EngagementantecedentTable::getInstance()->find($id);
        $engagement->delete();

        $this->engagements = EngagementantecedentTable::getInstance()->findByIdTitre($titre_id);
    }

    public function executeEtatEngagementAntecedent(sfWebRequest $request) {
        
    }

    public function executeGetEtatEngagement(sfWebRequest $request) {
        $id_titre = $request->getParameter('id_titre');
        $annee = $request->getParameter('annee');
        $this->titre = TitrebudjetTable::getInstance()->find($id_titre);
        $this->engagements = EngagementantecedentTable::getInstance()->getEngagementFirstDegreeByTitre($id_titre, $annee);
    }

    public function executeImprimerEtatAntecedent(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('ENGAGEMENT ANTECEDENT A PAYER');
        $pdf->SetSubject("ENGAGEMENT ANTECEDENT A PAYER");
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
        $html = $this->ReadHtmlEtatAntecedent($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('ENGAGEMENT ANTECEDENT A PAYER.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlEtatAntecedent(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $recap = new Engagementantecedent();
        $html .= $recap->ReadHtmlEtatAntecedent($request);
        return $html;
    }

    public function executeSituationEngagement(sfWebRequest $request) {
        
    }

    public function executeAfficherEtatSituationEngagement(sfWebRequest $request) {
        $this->mois = $request->getParameter('mois');
        $this->annee = $request->getParameter('annee');
        $this->titre = $request->getParameter('titre');
        $this->listes = LigprotitrubTable::getInstance()->getParentByTitreBudget($this->titre);
    }

    public function executeImprimerSituationEngagement(sfWebRequest $request) {
        $pdf = new sfTCPDF("L");

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('SITUATION DES ENGAGEMENTS BUDGETAIRES');
        $pdf->SetSubject("SITUATION DES ENGAGEMENTS BUDGETAIRES");
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
        $html = $this->ReadHtmlSituationEngagement($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('SITUATION DES ENGAGEMENTS BUDGETAIRES.pdf', 'I');

// Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlSituationEngagement(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $recap = new Ligprotitrub();
        $html .= $recap->ReadHtmlSituationEngagement($request);
        return $html;
    }

}
