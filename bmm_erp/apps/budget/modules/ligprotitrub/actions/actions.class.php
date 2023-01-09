<?php

require_once dirname(__FILE__) . '/../lib/ligprotitrubGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/ligprotitrubGeneratorHelper.class.php';

/**
 * ligprotitrub actions.
 *
 * @package    Bmm
 * @subpackage ligprotitrub
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ligprotitrubActions extends autoLigprotitrubActions {

    public function executeSavemntencaisser(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id_ligne = $params['idligne'];
            $mnt_encaisser = $params['mnt_encaisser'];
            $ligne_titre_r = new Ligprotitrub();
            $linge = Doctrine_Core::getTable('ligprotitrub')->findOneById($id_ligne);
            if ($linge) {
                $ligne_titre_r = $linge;
                if ($ligne_titre_r->getMnt() >= $mnt_encaisser) {
                    $ligne_titre_r->setMntencaisse($mnt_encaisser);
                    $ligne_titre_r->setModifseul(1);
                    $ligne_titre_r->save();
                    die('Mise à jour  avec succès');
                } else
                    die('Erreur au niveau du montant Bloqué');
            }
            die('Erreur de mise à jour');
        }
    }

    public function executeSavemntencaisserpourcentage(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            // paramétre des tranche

            $id = $params['id'];
            $mnt_encaisser = $params['mnt_encaisser'];
            $mnt_tr = $params['mnt_tr'];
            $date = $params['date'];
            $id_para_tr = $params['id_para_tr'];
            $alimentation_id = $params['alimentation_id'];

            $rubrique_id = $params['rubrique_id'];
            $montants = $params['montants'];

            $rubrique_id = explode(',', $rubrique_id);
            $montants = explode(';', $montants);

            for ($i = 0; $i < sizeof($rubrique_id); $i++) {
                if ($rubrique_id[$i] != '') {
                    Doctrine_Query::create()
                            ->update('ligprotitrub')
                            ->set('mntencaisse', '?', $montants[$i])
                            ->where('id=' . $rubrique_id[$i])
                            ->andWhere('modifseul is null')->execute();
                }
            }

//            $linges = Doctrine_Core::getTable('ligprotitrub')->findByIdTitre($id);
//            foreach ($linges as $ligne) {
//                if ($ligne->getMnt() > 0) {
//                    $mnt = $ligne->getMnt() * ( $mnt_encaisser / 100);
//                    Doctrine_Query::create()
//                            ->update('ligprotitrub')
//                            ->set('mntencaisse', '?', $mnt)
//                            ->where('id=' . $ligne->getId())
//                            ->andWhere('modifseul is null')->execute();
//                }
//            }

            $tr = new Tranchebudget();
            $tranche = Doctrine_Core::getTable('tranchebudget')->findOneByIdTitrebudgetAndIdParametragetranche($id, $id_para_tr);
            if ($tranche)
                $tr = $tranche;
            $tr->setDatetranche($date);
            $tr->setIdParametragetranche($id_para_tr);
            $tr->setIdTitrebudget($id);
            $tr->setMntvaleur($mnt_tr);
            $tr->setMntpourcentage($mnt_encaisser);
            $tr->save();

            if ($alimentation_id != '') {
                $alimentation = AlimentationcompteTable::getInstance()->find($alimentation_id);
                $alimentation->setIdTranchebudget($tr->getId());
                $alimentation->save();
            }

            die('Mise à jour avec succès');
        }
    }

    public function executeRapportSousRubrique(sfWebRequest $request) {
        $annees = $_SESSION['exercice_budget'];
        $this->budgets = Doctrine_Query::create()
                        ->select("*")
                        ->from('titrebudjet')
                        ->andwhere("trim(typebudget) not like trim('Prototype')")
                        ->andwhere("trim(typebudget) like trim('Exercice:" . $annees . "')")
                        ->orderBy('id asc')->execute();
    }

    public function executeDetailSousRubrique(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $titre_budget = TitrebudjetTable::getInstance()->find($id);
        $ligne_detail_budgets = Doctrine_Query::create()
                        ->select("*, CAST(coalesce(regexp_replace(l.nordre, '[^\w]+',''), '[^0-9]*' , '0') AS integer) as int_nordre")
                        ->from('Ligprotitrub l')
                        ->leftJoin('l.Rubrique r')
                        ->where("l.id_titre=" . $id)
                        ->andWhere("r.id_rubrique IS NULL")
                        ->orderBy('int_nordre asc')->execute();

        return $this->renderPartial("ligne_detail_budget", array("ligne_detail_budgets" => $ligne_detail_budgets, "id" => $id, "titre_budget" => $titre_budget));
    }

    public function executeImprimerRapportRubrique(sfWebRequest $request) {
        $id = $request->getParameter('id', '');

        $pdf = new sfTCPDF('L');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Rapport Rubrique');
        $pdf->SetSubject("Rapport Rubrique ");
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
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(7, 30, 7);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetFooterMargin(8);

        // set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 11.9);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlRapportRubrique($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Rapport Rubrique.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlRapportRubrique($id) {
        $html = StyleCssHeader::header1();
        $lptr = new Ligprotitrub();
        $html .= $lptr->ReadHtmlRapportRubrique($id);
        return $html;
    }

    public function executeDetailsLigprotitrub(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->rubrique = LigprotitrubTable::getInstance()->find($id);
    }

    public function executeImprimerDetailsRubrique(sfWebRequest $request) {
        $id = $request->getParameter('id');

        $pdf = new sfTCPDF('L');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Détails Rapport Rubrique');
        $pdf->SetSubject("Détails Rapport Rubrique ");
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
//        $pdf->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(7, 30, 7);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetFooterMargin(10);

        // set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 13);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlDetailsRubrique($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Détails Rapport Rubrique.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlDetailsRubrique($id) {
        $html = StyleCssHeader::header1();
        $lptr = new Ligprotitrub();
        $html .= $lptr->ReadHtmlDetailsRubrique($id);
        return $html;
    }

    public function executeAjouterRubrique(sfWebRequest $request) {
        $this->id = $request->getParameter('id');
        $this->code = $request->getParameter('code');
        $this->libelle = $request->getParameter('libelle');
        $this->id_titre = $request->getParameter('id_titre');
        $this->credit_alloue = $request->getParameter('credit_alloue');
    }

    public function executeAjouterSousRubrique(sfWebRequest $request) {
        $this->id = $request->getParameter('id');
        $this->index = $request->getParameter('index');
        $this->nordre = $request->getParameter('nordre');
        $this->code = $request->getParameter('code');
        $this->libelle = $request->getParameter('libelle');
        $this->id_titre = $request->getParameter('id_titre');
        $this->montant = $request->getParameter('montant');
    }

    public function executeSaveTableRubrique(sfWebRequest $request) {
        $id_titre = $request->getParameter('id_titre');
        $code_rubrique_parent = $request->getParameter('code_rubrique_parent');
        $ids = $request->getParameter('ids');
        $nordre_rubrique = $request->getParameter('nordre_rubrique');
        $code_rubrique = $request->getParameter('code_rubrique');
        $rubrique = $request->getParameter('rubrique');
        $credits = $request->getParameter('credits');
        $ids = explode(';', $ids);
        $code_rubrique = explode(';', $code_rubrique);
        $nordre_rubrique = explode(';', $nordre_rubrique);
        $rubrique = explode(';;', $rubrique);
        $credits = explode(';', $credits);
        $id_rubrique_parent = null;
        if ($code_rubrique_parent != '') {
            $rubrique_parent = LigprotitrubTable::getInstance()->getOneByIdTitreAndCode($id_titre, $code_rubrique_parent);
            $id_rubrique_parent = $rubrique_parent->getRubrique()->getId();
        }
        $titre_budget = TitrebudjetTable::getInstance()->find($id_titre);
        for ($i = 0; $i < sizeof($code_rubrique); $i++) {
            if ($code_rubrique[$i] != '') {
                if ($ids[$i] != '') {
                    //Update Ligprotitrub
                    $old_ligprotitrub = LigprotitrubTable::getInstance()->find($ids[$i]);
                    $old_ligprotitrub->setCode($code_rubrique[$i]);
                    $old_ligprotitrub->setNordre($nordre_rubrique[$i]);
                    if (trim($titre_budget->getTypebudget()) != 'Prototype')
                        $old_ligprotitrub->setMnt(floatval($credits[$i]));
                    $old_ligprotitrub->save();
                    //Update Rubrique
                    $old_rubrique = $old_ligprotitrub->getRubrique();
                    $old_rubrique->setLibelle($rubrique[$i]);
                    $old_rubrique->setCode($code_rubrique[$i]);
                    $old_rubrique->save();
                } else {
                    //Add Rubrique
                    $new_rubrique = new Rubrique();
                    $new_rubrique->setIdRubrique($id_rubrique_parent);
                    $new_rubrique->setLibelle($rubrique[$i]);
                    $new_rubrique->setCode($code_rubrique[$i]);
                    $new_rubrique->save();

                    //Add Ligprotitrub
                    $new_ligprotitrub = new Ligprotitrub();
                    $new_ligprotitrub->setIdTitre($id_titre);
                    $new_ligprotitrub->setIdRubrique($new_rubrique->getId());
                    $new_ligprotitrub->setCode($code_rubrique[$i]);
                    $new_ligprotitrub->setNordre($nordre_rubrique[$i]);
                    if (trim($titre_budget->getTypebudget()) != 'Prototype')
                        $new_ligprotitrub->setMnt(floatval($credits[$i]));
                    $new_ligprotitrub->save();
                }
            }
        }

        die("OK");
    }

    public function executeSetValideBudget(sfWebRequest $request) {
        $id_titre = $request->getParameter('id_titre');
        $etat = intval($request->getParameter('etatbudget'));

        $titre_budget = TitrebudjetTable::getInstance()->find($id_titre);
        $titre_budget->setEtatbudget($etat);
        $titre_budget->save();

        die("OK");
    }

    public function executeRemoveRubrique(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $ligne_rubrique = LigprotitrubTable::getInstance()->find($id);
        $this->removeRubrique($ligne_rubrique);

        die("OK");
    }

    function removeRubrique($ligne_rubrique) {
        $sous_ligne_rubriques = LigprotitrubTable::getInstance()->getSousRubrique($ligne_rubrique->getIdRubrique(), $ligne_rubrique->getIdTitre());
        foreach ($sous_ligne_rubriques as $sous_ligne_rubrique) {
            $this->removeRubrique($sous_ligne_rubrique);
        }
        //Update montant ligne rubrique parent
        $this->updateMontantLigneRubriqueParent($ligne_rubrique, $ligne_rubrique->getMnt());

        $ligne_rubrique->delete();
        return true;
    }

    function updateMontantLigneRubriqueParent($ligne_rubrique, $montant) {
        $rubrique = $ligne_rubrique->getRubrique();
        if ($rubrique->getIdRubrique() != null) {
            $ligne_parent = LigprotitrubTable::getInstance()->findOneByIdTitreAndIdRubrique($ligne_rubrique->getIdTitre(), $rubrique->getIdRubrique());
            $new_montant = $ligne_parent->getMnt() - $montant;
            $ligne_parent->setMnt($new_montant);
            $ligne_parent->save();

            //Update montant ligne rubrique parent
            $this->updateMontantLigneRubriqueParent($ligne_parent, $montant);
        }
    }

}
