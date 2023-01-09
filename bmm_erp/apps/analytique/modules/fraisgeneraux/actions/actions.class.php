<?php

require_once dirname(__FILE__) . '/../lib/fraisgenerauxGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/fraisgenerauxGeneratorHelper.class.php';

/**
 * fraisgeneraux actions.
 *
 * @package    Bmm
 * @subpackage fraisgeneraux
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fraisgenerauxActions extends autoFraisgenerauxActions {

    public function executeEnregistrer(sfWebRequest $request) {
        $annee = $request->getParameter('annee');
        $id = $request->getParameter('id');
        $charges_ids = $request->getParameter('charges_ids');
        $produit_ids = $request->getParameter('produit_ids');

        $charges_ids = explode(',', $charges_ids);
        $produit_ids = explode(',', $produit_ids);

        //Ajouter la répartition
        if ($id != '') {
            $rapport = FraisgenerauxTable::getInstance()->find($id);
        } else {
            $rapport = new Fraisgeneraux();
            $rapport->setMontantcharge(0);
            $rapport->setMontantproduit(0);
            $rapport->setMontant(0);
        }

        $rapport->setDate(date('Y-m-d'));
        $rapport->setAnnee($annee);

        $rapport->save();

        //Ajouter les comptes comptables des charges
        for ($i = 0; $i < sizeof($charges_ids); $i++) {
            if ($charges_ids[$i] != '') {
                $ligne = new Lignefraisgeneraux();

                $ligne->setIdPlandossiercomptable($charges_ids[$i]);
                $ligne->setIdFraisgeneraux($rapport->getId());
                $ligne->setMontant(0);

                $ligne->save();
            }
        }

        //Ajouter les chantiers des produits
        for ($i = 0; $i < sizeof($produit_ids); $i++) {
            if ($produit_ids[$i] != '') {
                $ligne = new Lignefraisgeneraux();

                $ligne->setIdPlandossiercomptable($produit_ids[$i]);
                $ligne->setIdFraisgeneraux($rapport->getId());
                $ligne->setMontant(0);

                $ligne->save();
            }
        }

        die("OK");
    }

    public function executeDeleteLigne(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $id_ligne = $request->getParameter('id_ligne');
        $type = $request->getParameter('type');

        $rapport = FraisgenerauxTable::getInstance()->find($id);
        $ligne = LignefraisgenerauxTable::getInstance()->find($id_ligne);

        //Mise à jour des montants du rapport des frais généraux
        if ($type == 'charge') {
            $new_charges = $rapport->getMontantcharge() - $ligne->getMontant();
            $new_produits = $rapport->getMontantproduit();
        } else {
            $new_charges = $rapport->getMontantcharge();
            $new_produits = $rapport->getMontantproduit() - $ligne->getMontant();
        }

        $new_montant = $new_charges - $new_produits;
        $rapport->setMontantcharge($new_charges);
        $rapport->setMontantproduit($new_produits);
        $rapport->setMontant($new_montant);
        $rapport->save();

        $ligne->delete();

        die("OK");
    }

    public function executeGenerer(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->rapport = FraisgenerauxTable::getInstance()->find($id);
    }

    public function executeImprimer(sfWebRequest $request) {
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Rapport Frais Généraux');
        $pdf->SetSubject("Rapport Frais Généraux");
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
        $pdf->Output('Rapport Frais Généraux', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlRapport(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $rapport = new Fraisgeneraux();
        $html .= $rapport->ReadHtmlRapport($request);
        return $html;
    }

    public function executeGenerationSolde(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $this->rapport = FraisgenerauxTable::getInstance()->find($id);
    }

    public function executeEnregistrerGeneration(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $charge_rapport = $request->getParameter('charge_rapport');
        $produit_rapport = $request->getParameter('produit_rapport');
        $montant_rapport = $request->getParameter('montant_rapport');

        $ligne_ids = $request->getParameter('ligne_ids');
        $montants = $request->getParameter('montants');

        $ligne_ids = explode(',', $ligne_ids);
        $montants = explode(';', $montants);

        //Mise à jour les montants du rapport
        $rapport = FraisgenerauxTable::getInstance()->find($id);
        $rapport->setMontantcharge($charge_rapport);
        $rapport->setMontantproduit($produit_rapport);
        $rapport->setMontant($montant_rapport);
        $rapport->save();

        //Mise à jour les soldes des lignes du rapport
        for ($i = 0; $i < sizeof($ligne_ids); $i++) {
            if ($ligne_ids[$i] != '') {
                $ligne = LignefraisgenerauxTable::getInstance()->find($ligne_ids[$i]);
                $ligne->setMontant($montants[$i]);
                $ligne->save();
            }
        }

        die("OK");
    }

}
