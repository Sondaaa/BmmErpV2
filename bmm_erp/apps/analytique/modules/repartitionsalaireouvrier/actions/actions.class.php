<?php

require_once dirname(__FILE__) . '/../lib/repartitionsalaireouvrierGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/repartitionsalaireouvrierGeneratorHelper.class.php';

/**
 * repartitionsalaireouvrier actions.
 *
 * @package    Bmm
 * @subpackage repartitionsalaireouvrier
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class repartitionsalaireouvrierActions extends autoRepartitionsalaireouvrierActions {

    public function executeCompteparnumero(sfWebRequest $request) {
        $numero = $request->getParameter('numero');
        if ($numero) {
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT plancomptable.id as id , concat(TRIM(plancomptable.numerocompte) ,' - ',TRIM(plancomptable.libelle)) as name, TRIM(plancomptable.numerocompte) as numero"
                    . " FROM plancomptable"
                    . " WHERE plancomptable.numerocompte LIKE '" . $numero . "%'"
                    . " ORDER BY plancomptable.numerocompte";
            $comptes = $conn->fetchAssoc($query);

            die(json_encode($comptes));
        }
    }

    public function executeEnregistrer(sfWebRequest $request) {
        $annee = $request->getParameter('annee');
        $id = $request->getParameter('id');
        $compte_ids = $request->getParameter('compte_ids');
        $libelles = $request->getParameter('libelles');
        $projet_ids = $request->getParameter('projet_ids');

        $compte_ids = explode(',', $compte_ids);
        $libelles = explode(',**,', $libelles);
        $projet_ids = explode(',', $projet_ids);

        //Ajouter la répartition
        if ($id != '') {
            $repartition = RepartitionsalaireouvrierTable::getInstance()->find($id);
        } else {
            $repartition = new Repartitionsalaireouvrier();
            $repartition->setJour(0);
            $repartition->setMontant(0);
        }

        $repartition->setDate(date('Y-m-d'));
        $repartition->setAnnee($annee);

        $repartition->save();

        //Ajouter les comptes comptables de la répartition
        for ($i = 0; $i < sizeof($compte_ids); $i++) {
            if ($compte_ids[$i] != '') {
                $repartition_compte = new Compterepartitionsalaireouvrier();

                $repartition_compte->setIdComptecomptable($compte_ids[$i]);
                $repartition_compte->setIdRepartition($repartition->getId());

                $repartition_compte->save();
            }
        }

        //Ajouter les chantiers de la répartition
        for ($i = 0; $i < sizeof($projet_ids); $i++) {
            if ($projet_ids[$i] != '') {
                $repartition_chantier = new Chantierrepartitionsalaireouvrier();

                $repartition_chantier->setLibelle($libelles[$i]);
                $repartition_chantier->setIdProjet($projet_ids[$i]);
                $repartition_chantier->setIdRepartition($repartition->getId());
                $repartition_chantier->setJour(0);
                $repartition_chantier->setMontant(0);

                $repartition_chantier->save();
            }
        }

        die("OK");
    }

    public function executeDeleteCompte(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $repartition_compte = CompterepartitionsalaireouvrierTable::getInstance()->find($id);
        $repartition_compte->delete();
        die("OK");
    }

    public function executeDeleteChantier(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $repartition_chantier = ChantierrepartitionsalaireouvrierTable::getInstance()->find($id);

        $jour = $repartition_chantier->getJour();
        $montant = $repartition_chantier->getMontant();
        $id_repartition = $repartition_chantier->getIdRepartition();

        $repartition = RepartitionsalaireouvrierTable::getInstance()->find($id_repartition);

        $new_jour = $repartition->getJour() - $jour;
        $new_montant = $repartition->getMontant() - $montant;

        $repartition->setJour($new_jour);
        $repartition->setMontant($new_montant);
        $repartition->save();

        $lignes = $repartition_chantier->getLignerepartitionsalaireouvrier();
        foreach ($lignes as $ligne) {
            $ligne->delete();
        }
        $repartition_chantier->delete();
        die("OK");
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

        $repartition = $this->getRoute()->getObject();
        //Supprimer les comptes comptables
        $repartition_comptes = $repartition->getCompterepartitionsalaireouvrier();
        foreach ($repartition_comptes as $repartition_compte):
            $repartition_compte->delete();
        endforeach;
        //Supprimer les chantiers
        $repartition_chantiers = $repartition->getChantierrepartitionsalaireouvrier();
        foreach ($repartition_chantiers as $repartition_chantier):
            $lignes = $repartition_chantier->getLignerepartitionsalaireouvrier();
            foreach ($lignes as $ligne) {
                $ligne->delete();
            }
            $repartition_chantier->delete();
        endforeach;

        if ($this->getRoute()->getObject()->delete()) {
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }

        $this->redirect('@repartitionsalaireouvrier');
    }

    public function executeSaisir(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->repartition = RepartitionsalaireouvrierTable::getInstance()->find($id);
    }

    public function executeSaveJour(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $id_chantier = $request->getParameter('id_chantier');
        $mois = $request->getParameter('mois');
        $jour = $request->getParameter('jour');
        $total_jour_chantier = $request->getParameter('total_jour_chantier');
        $total_jour = $request->getParameter('total_jour');

        $repartition = RepartitionsalaireouvrierTable::getInstance()->find($id);
        $repartition->setJour($total_jour);
        $repartition->save();

        $chantier = ChantierrepartitionsalaireouvrierTable::getInstance()->find($id_chantier);
        $chantier->setJour($total_jour_chantier);
        $chantier->save();

        $ligne_chantier = LignerepartitionsalaireouvrierTable::getInstance()->findOneByIdChantierrepartitionAndMois($id_chantier, $mois);
        if ($ligne_chantier != null) {
            //rien à faire
        } else {
            $ligne_chantier = new Lignerepartitionsalaireouvrier();
        }

        $ligne_chantier->setIdChantierrepartition($id_chantier);
        $ligne_chantier->setMois($mois);
        $ligne_chantier->setJour($jour);
        $ligne_chantier->save();

        die("OK");
    }

    public function executeSaveMontant(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $id_chantier = $request->getParameter('id_chantier');
        $mois = $request->getParameter('mois');
        $montant = $request->getParameter('montant');
        $total_montant_chantier = $request->getParameter('total_montant_chantier');
        $total_montant = $request->getParameter('total_montant');

        $repartition = RepartitionsalaireouvrierTable::getInstance()->find($id);
        $repartition->setMontant($total_montant);
        $repartition->save();

        $chantier = ChantierrepartitionsalaireouvrierTable::getInstance()->find($id_chantier);
        $chantier->setMontant($total_montant_chantier);
        $chantier->save();

        $ligne_chantier = LignerepartitionsalaireouvrierTable::getInstance()->findOneByIdChantierrepartitionAndMois($id_chantier, $mois);
        if ($ligne_chantier != null) {
            //rien à faire
        } else {
            $ligne_chantier = new Lignerepartitionsalaireouvrier();
        }

        $ligne_chantier->setIdChantierrepartition($id_chantier);
        $ligne_chantier->setMois($mois);
        $ligne_chantier->setMontant($montant);
        $ligne_chantier->save();

        die("OK");
    }

    public function executeImprimer(sfWebRequest $request) {
        $pdf = new sfTCPDF("L");

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Répartition mensuelle');
        $pdf->SetSubject("Répartition mensuelle");
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
        $html = $this->ReadHtmlRepartition($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Répartition mensuelle', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlRepartition(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $repartition = new Repartitionsalaireouvrier();
        $html .= $repartition->ReadHtmlRepartition($request);
        return $html;
    }

    public function executeImprimerRecap(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Récap. Répartition mensuelle');
        $pdf->SetSubject("Récap. Répartition mensuelle");
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
        $pdf->SetMargins(10, 30, 10);
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
        $html = $this->ReadHtmlRepartitionRecap($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Récap. Répartition mensuelle', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlRepartitionRecap(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $repartition = new Repartitionsalaireouvrier();
        $html .= $repartition->ReadHtmlRepartitionRecap($request);
        return $html;
    }

}
