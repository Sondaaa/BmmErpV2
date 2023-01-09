<?php

require_once dirname(__FILE__) . '/../lib/rapportcontroleGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/rapportcontroleGeneratorHelper.class.php';

/**
 * rapportcontrole actions.
 *
 * @package    Bmm
 * @subpackage rapportcontrole
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class rapportcontroleActions extends autoRapportcontroleActions {

    public function executeShow(sfWebRequest $request) {
        $this->rapportcontrole = RapportcontroleTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeSaisir(sfWebRequest $request) {
        $this->rapportcontrole = RapportcontroleTable::getInstance()->find($request->getParameter('id'));
    }

    public function executeEnregistrer(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $numero = $request->getParameter('numero');
        $designation = $request->getParameter('designation');
        $quantite = $request->getParameter('quantite');

        $numero = substr($numero, 0, -1);
        $numero = explode(',', $numero);

        $designation = substr($designation, 0, -4);
        $designation = explode(',**,', $designation);

        $quantite = substr($quantite, 0, -3);
        $quantite = explode(';*;', $quantite);
        
        $rapport = RapportcontroleTable::getInstance()->find($id);

        if ($rapport->getIdNaturetravaux() == 1 || $rapport->getIdServicecontrole() == 2 || $rapport->getIdServicecontrole() == 4):
            $total = $request->getParameter('total');
            $unite = $request->getParameter('unite');
            $prix_unitaire = $request->getParameter('prix_unitaire');
            $prix_total = $request->getParameter('prix_total');

            $unite = substr($unite, 0, -4);
            $unite = explode(',**,', $unite);

            $prix_unitaire = substr($prix_unitaire, 0, -1);
            $prix_unitaire = explode(';', $prix_unitaire);

            $prix_total = substr($prix_total, 0, -1);
            $prix_total = explode(';', $prix_total);

        elseif ($rapport->getIdNaturetravaux() == 2):
            $observation = $request->getParameter('observation');

            $observation = substr($observation, 0, -3);
            $observation = explode(';*;', $observation);

        endif;

        //Mise à jour montant rapport
        if ($rapport->getIdNaturetravaux() == 1 || $rapport->getIdServicecontrole() == 2 || $rapport->getIdServicecontrole() == 4) {
            $rapport->setTotal($total);
            $rapport->save();
        }

        foreach ($rapport->getLignerapportcontrole() as $ligne) {
            $ligne->delete();
        }

        //Ajout des Articles du Rapport
        for ($i = 0; $i < sizeof($numero); $i++) {
            if ($numero[$i] != '') {
                $ligne_rapport = new Lignerapportcontrole();

                $ligne_rapport->setNumero($numero[$i]);
                $ligne_rapport->setDesignation($designation[$i]);
                $ligne_rapport->setQuantite($quantite[$i]);

                if ($rapport->getIdNaturetravaux() == 1 || $rapport->getIdServicecontrole() == 2 || $rapport->getIdServicecontrole() == 4) {
                    $ligne_rapport->setUnite($unite[$i]);
                    if ($prix_unitaire[$i] != '') {
                        $ligne_rapport->setPrixunitaire($prix_unitaire[$i]);
                    }
                    if ($prix_total[$i] != '') {
                        $ligne_rapport->setPrixtotal($prix_total[$i]);
                    }
                } elseif ($rapport->getIdNaturetravaux() == 2) {
                    $ligne_rapport->setObservation($observation[$i]);
                }
                $ligne_rapport->setIdRapportcontrole($rapport->getId());

                $ligne_rapport->save();
            }
        }

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
        $rapport = new Rapportcontrole();
        $html .= $rapport->ReadHtmlRapport($request);
        return $html;
    }

}
