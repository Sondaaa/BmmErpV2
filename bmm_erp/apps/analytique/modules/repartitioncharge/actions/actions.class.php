<?php

require_once dirname(__FILE__) . '/../lib/repartitionchargeGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/repartitionchargeGeneratorHelper.class.php';

/**
 * repartitioncharge actions.
 *
 * @package    Bmm
 * @subpackage repartitioncharge
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class repartitionchargeActions extends autoRepartitionchargeActions {

    public function executeEnregistrer(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $annee = $request->getParameter('annee');
        $libelles = $request->getParameter('libelles');
        $main_ids = $request->getParameter('main_ids');
        $intrant_ids = $request->getParameter('intrant_ids');
        $mecanisation_ids = $request->getParameter('mecanisation_ids');

        //Mise à jour montant rapport
        if ($id != '')
            $repartition = RepartitionchargeTable::getInstance()->find($id);
        else {
            $repartition = new Repartitioncharge();
            $repartition->setMontant(0);
        }
        $repartition->setDate(date('Y-m-d'));
        $repartition->setAnnee($annee);

        $repartition->save();

        $libelles = substr($libelles, 0, -4);
        $libelles = explode(',**,', $libelles);

        $main_ids = substr($main_ids, 0, -1);
        $main_ids = explode(';', $main_ids);

        $intrant_ids = substr($intrant_ids, 0, -1);
        $intrant_ids = explode(';', $intrant_ids);

        $mecanisation_ids = substr($mecanisation_ids, 0, -1);
        $mecanisation_ids = explode(';', $mecanisation_ids);

        //Ajout des Travaux du Rapport et leurs Tâches
        for ($i = 0; $i < sizeof($libelles); $i++) {
            if ($libelles[$i] != '') {
                $unite = new Uniterepartitioncharge();
                $unite->setDate(date('Y-m-d'));
                $unite->setLibelle($libelles[$i]);
                $unite->setMontant(0);
                $unite->setIdRepartitioncharge($repartition->getId());
                $unite->save();

                //Ajouter Paramètres Chantier
                if ($main_ids[$i] != 'null') {
                    $unite_main_ids = $main_ids[$i];
                    $unite_main_ids = explode(',', $unite_main_ids);

                    for ($j = 0; $j < sizeof($unite_main_ids); $j++) {
                        if ($unite_main_ids[$j] != '') {
                            $param = new Parametreuniterepartition();
                            $param->setIdChantierrepartition($unite_main_ids[$j]);
                            $param->setIdUniterepartition($unite->getId());
                            $param->save();
                        }
                    }
                }

                //Ajouter Paramètres rapport travaux
                if ($intrant_ids[$i] != 'null') {
                    $unite_intrant_ids = $intrant_ids[$i];
                    $unite_intrant_ids = explode(',', $unite_intrant_ids);

                    for ($j = 0; $j < sizeof($unite_intrant_ids); $j++) {
                        if ($unite_intrant_ids[$j] != '' && $unite_intrant_ids[$j] != 'null') {
                            $param = new Parametreuniterepartition();
                            $param->setIdRapporttravaux($unite_intrant_ids[$j]);
                            $param->setIdUniterepartition($unite->getId());
                            $param->save();
                        }
                    }
                }

                //Ajouter Paramètres type mecanisation
                if ($mecanisation_ids[$i] != 'null') {
                    $unite_mecanisation_ids = $mecanisation_ids[$i];
                    $unite_mecanisation_ids = explode(',', $unite_mecanisation_ids);

                    for ($j = 0; $j < sizeof($unite_mecanisation_ids); $j++) {
                        if ($unite_mecanisation_ids[$j] != '' && $unite_mecanisation_ids[$j] != 'null') {
                            $param = new Parametreuniterepartition();
                            $param->setTypemecanisation($unite_mecanisation_ids[$j]);
                            $param->setIdUniterepartition($unite->getId());
                            $param->save();
                        }
                    }
                }
            }
        }
        die("OK");
    }

    public function executeDeleteUnite(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $unite = UniterepartitionchargeTable::getInstance()->find($id);
        $repartition = $unite->getRepartitioncharge();
        $new_montant = $repartition->getMontant() - $unite->getMontant();
        $repartition->setMontant($new_montant);
        $repartition->save();

        //Supprimer Ligne unité
        foreach ($unite->getLigneuniterepartition() as $ligne):
            $ligne->delete();
        endforeach;

        //Supprimer Ligne paramètres
        foreach ($unite->getParametreuniterepartition() as $param):
            $param->delete();
        endforeach;

        $unite->delete();

        die("OK");
    }

    public function executeGenererUnite(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->repartition = RepartitionchargeTable::getInstance()->find($id);
    }

    public function executeInfo(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->repartitioncharge = RepartitionchargeTable::getInstance()->find($id);
    }

    public function executeTableau(sfWebRequest $request) {
        $id = $request->getParameter('id');

        $main_total = str_replace(' ', '', $request->getParameter('main_total'));
        $intrant_total = str_replace(' ', '', $request->getParameter('intrant_total'));
        $mecanisation_total = str_replace(' ', '', $request->getParameter('mecanisation_total'));
        $jour_total = str_replace(' ', '', $request->getParameter('jour_total'));
        $total = str_replace(' ', '', $request->getParameter('total'));

        $ids = $request->getParameter('ids');

        $main_montants = $request->getParameter('main_montants');
        $main_jours = $request->getParameter('main_jours');
        $intrant_montants = $request->getParameter('intrant_montants');
        $mecanisation_montants = $request->getParameter('mecanisation_montants');
        $unite_totaux = $request->getParameter('unite_totaux');

        $repartition = RepartitionchargeTable::getInstance()->find($id);

        $montant_charges = 0;
        $charge_directe = FraisgenerauxTable::getInstance()->findOneByAnnee($repartition->getAnnee());
        if ($charge_directe != null)
            $montant_charges = $charge_directe->getMontant();

        $base_frais = $total - $montant_charges;

        $repartition->setMontant($total);
        $repartition->setMain($main_total);
        $repartition->setJour($jour_total);
        $repartition->setIntrant($intrant_total);
        $repartition->setMecanisation($mecanisation_total);

        $repartition->save();

        //Delete old Lignes unité répartition
        $lignes = LigneuniterepartitionTable::getInstance()->getByRepartition($repartition->getId());
        foreach ($lignes as $ligne):
            $ligne->delete();
        endforeach;

        $ids = substr($ids, 0, -1);
        $ids = explode(',', $ids);

        $main_montants = substr($main_montants, 0, -1);
        $main_montants = explode(';', $main_montants);

        $main_jours = substr($main_jours, 0, -1);
        $main_jours = explode(';', $main_jours);

        $intrant_montants = substr($intrant_montants, 0, -1);
        $intrant_montants = explode(';', $intrant_montants);

        $mecanisation_montants = substr($mecanisation_montants, 0, -1);
        $mecanisation_montants = explode(';', $mecanisation_montants);

        $unite_totaux = substr($unite_totaux, 0, -1);
        $unite_totaux = explode(';', $unite_totaux);

        for ($i = 0; $i < sizeof($ids); $i++) {
            if ($ids[$i] != '') {
                //Mise à jour des Montants des Unité
                $unite = UniterepartitionchargeTable::getInstance()->find($ids[$i]);
                $unite->setMontant(str_replace(' ', '', $unite_totaux[$i]));
                $unite->save();

                //Ajout des lignes des Unité
                $ligne = new Ligneuniterepartition();

                $ligne->setIdUniterepartition($ids[$i]);
                $ligne->setJourmod(str_replace(' ', '', $main_jours[$i]));
                $ligne->setMontantmod(str_replace(' ', '', $main_montants[$i]));
                $ligne->setIntrant(str_replace(' ', '', $intrant_montants[$i]));
                $ligne->setMecanisation(str_replace(' ', '', $mecanisation_montants[$i]));

                //Calcule Coefficient
                $coefficient = round(str_replace(' ', '', $main_jours[$i]) * 100 / $jour_total, 2);
                $ligne->setCoefficient($coefficient);

                //Calcule Frais
                $frais = round($coefficient * $base_frais / 100, 3);
                $ligne->setFraisgeneraux($frais);

                //Calcule Total
                $total_ligne = str_replace(' ', '', $main_montants[$i]) + str_replace(' ', '', $intrant_montants[$i]) + str_replace(' ', '', $mecanisation_montants[$i]) - $frais;
                $ligne->setTotal($total_ligne);

                $ligne->save();
            }
        }

        die("OK");
    }

    public function executeShowTableau(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->repartition = RepartitionchargeTable::getInstance()->find($id);
    }

    public function executeAjouterCompte(sfWebRequest $request) {
        $ids = $request->getParameter('ids');
        $libelles = $request->getParameter('libelles');

        $ids = substr($ids, 0, -1);
        $ids = explode(',', $ids);

        $libelles = substr($libelles, 0, -4);
        $libelles = explode(';**;', $libelles);

        for ($i = 0; $i < sizeof($ids); $i++) {
            if ($ids[$i] != '') {
                $ligne = LigneuniterepartitionTable::getInstance()->find($ids[$i]);
                $ligne->setCompteapproprie($libelles[$i]);
                $ligne->save();
            }
        }

        die("OK");
    }

    public function executeImprimer(sfWebRequest $request) {
        $pdf = new sfTCPDF("L");

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Tableau Répartition Charges');
        $pdf->SetSubject("Tableau Répartition Charges");
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
        $pdf->Output('Tableau Répartition Charges', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlRapport(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $rapport = new Repartitioncharge();
        $html .= $rapport->ReadHtmlRapport($request);
        return $html;
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
        $repartition = $this->getRoute()->getObject();

        //Delete Lignes unité répartition
        $lignes = LigneuniterepartitionTable::getInstance()->getByRepartition($repartition->getId());
        foreach ($lignes as $ligne):
            $ligne->delete();
        endforeach;

        $unites = $repartition->getUniterepartitioncharge();
        foreach ($unites as $unite):
            foreach ($unite->getParametreuniterepartition() as $param):
                $param->delete();
            endforeach;
            $unite->delete();
        endforeach;

        if ($this->getRoute()->getObject()->delete()) {
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }

        $this->redirect('@repartitioncharge');
    }

}
