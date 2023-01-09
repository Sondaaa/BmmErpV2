<?php

require_once dirname(__FILE__) . '/../lib/rapporttravauxGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/rapporttravauxGeneratorHelper.class.php';

/**
 * rapporttravaux actions.
 *
 * @package    Bmm
 * @subpackage rapporttravaux
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class rapporttravauxActions extends autoRapporttravauxActions {

    public function executeSaisir(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->rapport = RapporttravauxTable::getInstance()->find($id);
    }

    public function executeEnregistrer(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $total = $request->getParameter('total');
        $ids = $request->getParameter('ids');
        $libelles = $request->getParameter('libelles');
        $montants = $request->getParameter('montants');
        $tache_libelles = $request->getParameter('tache_libelles');
        $tache_montants = $request->getParameter('tache_montants');

//Mise à jour montant rapport
        $rapport = RapporttravauxTable::getInstance()->find($id);
        $rapport->setMontant($total);
        $rapport->save();

        $ids = substr($ids, 0, -1);
        $ids = explode(',', $ids);

        $libelles = substr($libelles, 0, -4);
        $libelles = explode(',**,', $libelles);

        $montants = substr($montants, 0, -1);
        $montants = explode(';', $montants);

        $tache_libelles = substr($tache_libelles, 0, -4);
        $tache_libelles = explode(',**,', $tache_libelles);

        $tache_montants = substr($tache_montants, 0, -3);
        $tache_montants = explode(';*;', $tache_montants);

        //Ajout des Travaux du Rapport et leurs Tâches
        for ($i = 0; $i < sizeof($ids); $i++) {
            if ($ids[$i] != '') {
                if ($libelles[$i] != '') {
                    $travail = new Travailrapporttravaux();
                    $travail->setLibelle($libelles[$i]);
                    $travail->setMontant($montants[$i]);
                    $travail->setIdRapporttravaux($rapport->getId());
                    $travail->save();
                } else {
                    $travail = TravailrapporttravauxTable::getInstance()->find($ids[$i]);
                    $travail->setMontant($montants[$i]);
                    $travail->save();
                }

                for ($j = 0; $j < sizeof($tache_libelles); $j++) {
                    if ($tache_libelles[$j] != '') {
                        $tache_libelle = explode(';*;', $tache_libelles[$j]);
                        if ($tache_libelle[0] == $ids[$i]) {
                            $tache_montant = explode(';', $tache_montants[$j]);

                            $tache = new Lignetravailrapport();
                            $tache->setLibelle($tache_libelle[1]);
                            $tache->setMontant($tache_montant[1]);
                            $tache->setIdTravailrapport($travail->getId());
                            $tache->save();
                        }
                    }
                }
            }
        }

        die("OK");
    }

    public function executeDeleteTravail(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $travail = TravailrapporttravauxTable::getInstance()->find($id);
        $rapport = $travail->getRapporttravaux();
        $new_montant = $rapport->getMontant() - $travail->getMontant();
        $rapport->setMontant($new_montant);
        $rapport->save();

        foreach ($travail->getLignetravailrapport() as $ligne) {
            $ligne->delete();
        }

        $travail->delete();
        die("OK");
    }

    public function executeDeleteTache(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $id_tache = $request->getParameter('id_tache');
        $ligne = LignetravailrapportTable::getInstance()->find($id_tache);
        $travail = TravailrapporttravauxTable::getInstance()->find($id);
        $rapport = $travail->getRapporttravaux();
        $new_montant_rapport = $rapport->getMontant() - $ligne->getMontant();
        $rapport->setMontant($new_montant_rapport);
        $rapport->save();
        $new_montant_travail = $travail->getMontant() - $ligne->getMontant();
        $travail->setMontant($new_montant_travail);
        $travail->save();

        $ligne->delete();

        die("OK");
    }

    public function executeImprimer(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Rapport Travaux');
        $pdf->SetSubject("Rapport Travaux");
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
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetFooterMargin(7);

        // set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 7);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlRapport($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Rapport Travaux', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlRapport(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $rapport = new Rapporttravaux();
        $html .= $rapport->ReadHtmlRapport($request);
        return $html;
    }

    public function executeChargerArticle(sfWebRequest $request) {
        $libelle = $request->getParameter('libelle');
        if ($libelle) {
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT immobilisation.id as id , TRIM(immobilisation.designation) as name"
                    . " FROM immobilisation"
                    . " WHERE immobilisation.designation LIKE '%" . $libelle . "%'"
                    . " ORDER BY immobilisation.designation";
            $comptes = $conn->fetchAssoc($query);

            die(json_encode($comptes));
        }
    }

    public function executeEnregistrerArticles(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $total = $request->getParameter('total');

        $ids = $request->getParameter('ids');
        $total_mre = $request->getParameter('total_mre');
        $total_dps = $request->getParameter('total_dps');
        $total_maint = $request->getParameter('total_maint');
        $total_bat = $request->getParameter('total_bat');
        $total_dts = $request->getParameter('total_dts');
        $montants = $request->getParameter('montants');

        //Mise à jour montant rapport
        $rapport = RapporttravauxTable::getInstance()->find($id);
        $rapport->setMontant($total);
        $rapport->save();

        $ids = substr($ids, 0, -1);
        $ids = explode(',', $ids);

        $total_mre = substr($total_mre, 0, -1);
        $total_mre = explode(';', $total_mre);

        $total_dps = substr($total_dps, 0, -1);
        $total_dps = explode(';', $total_dps);

        $total_maint = substr($total_maint, 0, -1);
        $total_maint = explode(';', $total_maint);

        $total_bat = substr($total_bat, 0, -1);
        $total_bat = explode(';', $total_bat);

        $total_dts = substr($total_dts, 0, -1);
        $total_dts = explode(';', $total_dts);

        $montants = substr($montants, 0, -1);
        $montants = explode(';', $montants);

        //Ajout des Articles du Rapport et leurs Montants
        for ($i = 0; $i < sizeof($ids); $i++) {
            if ($ids[$i] != '') {
                $article = new Articlerapporttravaux();
                if ($total_mre[$i] != '')
                    $article->setMre($total_mre[$i]);
                if ($total_dps[$i] != '')
                    $article->setDps($total_dps[$i]);
                if ($total_maint[$i] != '')
                    $article->setMaint($total_maint[$i]);
                if ($total_bat[$i] != '')
                    $article->setBat($total_bat[$i]);
                if ($total_dts[$i] != '')
                    $article->setPlant($total_dts[$i]);
                $article->setMontant($montants[$i]);
                $article->setIdImmobilisation($ids[$i]);
                $article->setIdRapporttravaux($rapport->getId());
                $article->save();
            }
        }

        die("OK");
    }

    public function executeSupprimerArticle(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $id_article = $request->getParameter('id_article');

        $article = ArticlerapporttravauxTable::getInstance()->find($id_article);

        //Mise à jour montant rapport
        $rapport = RapporttravauxTable::getInstance()->find($id);
        $new_montant = $rapport->getMontant() - $article->getMontant();
        $rapport->setMontant($new_montant);
        $rapport->save();

        $article->delete();

        die("OK");
    }

    public function executeImprimerArticle(sfWebRequest $request) {
        $pdf = new sfTCPDF("L");

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Rapport Travaux');
        $pdf->SetSubject("Rapport Travaux");
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
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetFooterMargin(7);

        // set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 9);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlRapportArticle($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Rapport Travaux', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlRapportArticle(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $rapport = new Rapporttravaux();
        $html .= $rapport->ReadHtmlRapportArticle($request);
        return $html;
    }

    public function executeChargeDirecte(sfWebRequest $request) {
        
    }

    public function executeAfficherChargeDirecte(sfWebRequest $request) {
        $annee = $request->getParameter('annee');
        $this->repartition = RepartitionsalaireouvrierTable::getInstance()->findOneByAnnee($annee);
        $this->rapports = RapporttravauxTable::getInstance()->findByAnnee($annee);
        $this->annee = $annee;
    }
    
    public function executeImprimerChargeDirecte(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Charges Directes');
        $pdf->SetSubject("Charges Directes");
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
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetFooterMargin(7);

        // set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 7);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlRapportChargeDirecte($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Charges Directes', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlRapportChargeDirecte(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $rapport = new Rapporttravaux();
        $html .= $rapport->ReadHtmlRapportChargeDirecte($request);
        return $html;
    }
    
    public function executeImprimerToutCharge(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Frais généraux');
        $pdf->SetSubject("Frais généraux");
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
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetFooterMargin(7);

        // set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 7);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlRapportToutCharge($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Frais généraux', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlRapportToutCharge(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $rapport = new Rapporttravaux();
        $html .= $rapport->ReadHtmlRapportToutCharge($request);
        return $html;
    }

}
