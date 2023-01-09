<?php

/**
 * Reglementcomptable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    Bmm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Reglementcomptable extends BaseReglementcomptable {

    public function ReadHtmlListe(sfWebRequest $request) {

        $libelle = $request->getParameter('libelle', '');
        $reference = $request->getParameter('reference', '');
//        $type = $request->getParameter('type', '');
        $saisie = $request->getParameter('saisie', '');

        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);

        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());

        $dossier = DossiercomptableTable::getInstance()->find($_SESSION['dossier_id']);
        $factures = ReglementcomptableTable::getInstance()->getForPrint($saisie, $reference, $libelle, $date_debut, $date_fin);

        if ($saisie == 0)
            $saisie = "Non Saisies";
        else
            $saisie = "Saisies";

        $html = '<div border="1">
                    <table cellspacing="0" cellpadding="3">
                        <tr align="center" style="font-size: 12px;">
                            <td colspan="3" style="font-weight:bold;font-size:18px;width:100%;">' . $dossier->getRaisonsociale() . '</td>
                        </tr>
                        <tr><td colspan="3" style="width:100%;" align="center"><b>Liste des Reglements Comptables -  ' . $saisie . '</b></td></tr>
                    </table>
                </div>';

        if ($date_debut == '')
            $date_debut = '--/--/----';
        else
            $date_debut = date('d/m/Y', strtotime($date_debut));
        if ($date_fin == '')
            $date_fin = '--/--/----';
        else
            $date_fin = date('d/m/Y', strtotime($date_fin));

        $html.='<div border="1">
                    <table cellspacing="0" cellpadding="3">
                        <tr style="font-size: 11px;">
                            <td style="width:40%;text-align:right;"><b>Période du : </b>' . $date_debut . ' <b>Au :</b> ' . $date_fin . '</td>
                   
</tr>
                    </table>
                </div>&nbsp;<br>';

        $html.= '<table cellspacing="0" cellpadding="3" border="1">
                        <tr align="center" style="font-size:11px;font-weight:bold;background-color:#F0F0F0;">
                         
                            <td style="width:13%;">Date opèration</td>
                            <td style="width:12%;">Numéro pièce</td>
                            <td style="width:31%;">Libellé</td>
                            <td style="width:11%;">Total HT</td>
                            <td style="width:11%;">Total TVA</td>
                            <td style="width:11%;">Total TTC</td>
                            <td style="width:11%;">Type</td>
                            
                        </tr>';

        foreach ($factures as $facture) {
            $html.='<tr style="font-size:10px;">
                      
                        <td style="text-align:center;">' . date('d/m/Y', strtotime($facture->getDate())) . '</td>
                        <td style="text-align:center;">' . $facture->getNumero() . '</td>
                        <td>' . $facture->getLibelle() . '</td>
                        <td style="text-align:right;">' . $facture->getTotalht() . '</td>
                        <td style="text-align:right;">' . $facture->getTotaltva() . '</td>
                        <td style="text-align:right;">' . $facture->getTotalttc() . '</td>
                        <td style="text-align:center;">' . $facture->getType() . '</td>
                    </tr>';
        }

        $html.='</table>';


        return $html;
    }

}