<?php

/**
 * Lignepiececomptable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Lignepiececomptable extends BaseLignepiececomptable {

    public function ReadHtmlEtatLivre(sfWebRequest $request) {
        $societe = Doctrine_Core::getTable('dossiercomptable')->findOneById($_SESSION['dossier_id']);
        $compte_min = $request->getParameter('compte_min', '');
        $compte_max = $request->getParameter('compte_max', '');
        $date_debut = $request->getParameter('date_debut');
        $date_fin = $request->getParameter('date_fin');
        $toutlivre = $request->getParameter('toutlivre');

        $order = $request->getParameter('order', '');

        $etatLivres = LignePieceComptableTable::getInstance()->loadEtatLivre2($compte_min, $compte_max, $date_debut, $date_fin, $order, $_SESSION['dossier_id'], $_SESSION['exercice_id']);

        $etatLivres_pres = LignePieceComptableTable::getInstance()->loadEtatLivre2Pre($compte_min, $compte_max, $date_debut, $order, $_SESSION['dossier_id'], $_SESSION['exercice_id']);
       $dossier_id = $_SESSION['dossier_id'];
        $exercice_id = $_SESSION['exercice_id'];
        $compte_min_comptable = PlandossiercomptableTable::getInstance()->findByNumerocompteAndIdDossierAndIdExercice($compte_min,$dossier_id,$exercice_id)->getFirst();
        $compte_max_comptable = PlandossiercomptableTable::getInstance()->findByNumerocompteAndIdDossierAndIdExercice($compte_max,$dossier_id,$exercice_id)->getFirst();
        if ($date_debut != '' && $date_debut != NULL)
            $date_debut = date('d/m/Y', strtotime($date_debut));
        else
            $date_debut = '';
        if ($date_fin != '' && $date_fin != NULL)
            $date_fin = date('d/m/Y', strtotime($date_fin));
        else
            $date_fin = '';

        $html = '<div border="1">
                    <table cellspacing="0" cellpadding="3">
                        <tr align="center">
                            <td style="font-weight:bold;font-size:14px;width:100%;">' . $societe->getRaisonsociale() . '</td>
                        </tr>
                        <tr align="center">
                            <td style="font-weight:bold;font-size:14px;width:100%;">Etat Grand Livre : ' . $_SESSION['exercice'] . '</td>
                        </tr>
                    </table>
                </div>&nbsp;<br>';

        $html.= '<table cellspacing="0" cellpadding="5" border="1">
                    <tr>
                        <td style="font-size:10px;width:100%;">
                            <b>Période du : </b> &nbsp;&nbsp;' . $date_debut . '&nbsp;&nbsp; <b>Au : </b> &nbsp;&nbsp;' . $date_fin . '
                            <ul><b>Compte Comptable :</b>
                                <li>
                                    <b>Du :</b> ' . $compte_min_comptable->getNumerocompte() . ' - ' . $compte_min_comptable->getLibelle() . '
                                </li>
                                <li>
                                    <b>Au :</b> ' . $compte_max_comptable->getNumerocompte() . ' - ' . $compte_max_comptable->getLibelle() . '
                                </li>
                            </ul>
                        </td>
                    </tr>
                </table>&nbsp;<br>';

        $html.= '<table cellspacing="0" cellpadding="3" border="1">
                    <thead>
                        <tr style="font-weight:bold;font-size:7px;text-align:center;background-color:#F3F3F3;">
                            <td style="width:9%;">Date</td>
                            <td style="width:6%">Journal</td>
                            <td style="width:9%">N° Pièce</td>
                            <td style="width:23%">Libellé</td>
                            
                            <td style="width:13%">Débit</td>
                            <td style="width:13%">Crédit</td>
                            <td style="width:13%">Solde Débiteur</td>
                            <td style="width:13%">Solde Créditeur</td>
                        </tr>
                    </thead>';
//die($etatLivres->count().'f');
        if ($etatLivres->count() == 0):
            $html.= '<tr>
                        <td style="text-align:center;font-weight:bold;font-size:10px;width:100%;">Liste des Fiches Vide</td>
                    </tr>';
        else:
            $numero_compte = '';
            $totalcredit = 0;
            $totaldebit_prece=0;
            $totaldebit = 0;
             $totalsoldedebit_prece =0;
            $totalsoldecredit_prece =0;
            $totalsoldecredit = 0;
            $totalsoldedebit = 0;
            $solde = 0;
            $soldedebiteur = 0;
            $soldecrediteur = 0;
            $total_solde = 0;
            $soldedebiteur_prece = 0;
            $soldecrediteur_prece = 0;
            $total_solde_prece = 0;
            $totalcredit_prece = 0;
            foreach ($etatLivres_pres as $livre_precedent):
                $totalcredit_prece += $livre_precedent->getMontantcredit();
                $totaldebit_prece += $livre_precedent->getMontantdebit();
                if ($livre_precedent->getMontantdebit() != 0)
                    $total_solde_prece = $total_solde_prece + $livre_precedent->getMontantdebit();
                if ($livre_precedent->getMontantcredit() != 0)
                    $total_solde_prece = $total_solde_prece - $livre_precedent->getMontantcredit();
                if ($total_solde_prece >= 0) {
                    $soldedebiteur_prece = abs($total_solde_prece);
                }
                if ($total_solde_prece < 0) {
                    $soldecrediteur_prece = abs($total_solde_prece);
                }
                $totalsoldedebit_prece = $soldedebiteur_prece;
                $totalsoldecredit_prece = $soldecrediteur_prece;
            endforeach;
            if ($etatLivres->count() != 0 || $toutlivre == 'true'):
                foreach ($etatLivres as $livre):
                    if ($numero_compte != $livre->getPlandossiercomptable()->getNumerocompte()):
                        if ($numero_compte != ''):
                            if ($totaldebit == 0)
                                $totaldebit_affich = '';
                            else
                                $totaldebit_affich = number_format($totaldebit, 3, '.', ' ');

                            if ($totalcredit == 0)
                                $totalcredit_affich = '';
                            else
                                $totalcredit_affich = number_format($totalcredit, 3, '.', ' ');

                            if ($totalsoldedebit == 0)
                                $totalsoldedebit_affich = '';
                            else
                                $totalsoldedebit_affich = number_format($totalsoldedebit, 3, '.', ' ');

                            if ($totalsoldecredit == 0)
                                $totalsoldecredit_affich = '';
                            else
                                $totalsoldecredit_affich = number_format($totalsoldecredit, 3, '.', ' ');

                            $html.='<tr>
                                        <td  style="height:25px;width:24%">&nbsp;</td>
                                        <td colspan="2" style="font-weight:bold;text-align:center;font-size: 7px;width:23%">Total Période</td>
                                        <td style="text-align:right;width:13%">' . $totaldebit_affich . '</td>
                                        <td style="text-align:right;width:13%">' . $totalcredit_affich . '</td>
                                        <td style="text-align:right;width:13%">' . $totalsoldedebit_affich . '</td>
                                        <td style="text-align:right;width:13%">' . trim($totalsoldecredit_affich) . '</td>
                                    </tr>';

                            $totalcredit = 0;
                            $totaldebit = 0;
                            $totalsoldecredit = 0;
                            $totalsoldedebit_prece =0;
                            $totalsoldedebit = 0;
                            $solde = 0;
                            $soldedebiteur = 0;
                            $soldecrediteur = 0;
                            $total_solde = 0;
                        endif;
                        $html.='<tr style="font-size:8px">
                                    <td style="font-weight:bold;width:9%;text-align:center;font-size: 7px; ">' . $livre->getPlandossiercomptable()->getNumerocompte() . '</td>
                                    <td colspan="3" style="font-weight: bold;width:15%;font-size: 7px; ">' . $livre->getPlandossiercomptable()->getLibelle() . '</td>
                                    <td colspan="2" style="font-weight: bold;width:23%">Report</td>';
                        $html.='<td style = "font-weight: bold;font-size: 7px; text-align: rigth; background-color: #fcf8e3;width:13%">';

                        if ($totaldebit_prece != 0)
                            $html.= number_format($totaldebit_prece, 3, '.', ' ');

                        $html.='</td>';
                        $html.='<td style="font-weight: bold;font-size: 8px; text-align: rigth; background-color: #dff0d8;width:13%">';

                        if ($totalcredit_prece != 0)
                            $html.= number_format($totalcredit_prece, 3, '.', ' ');

                        $html.='</td>';
                        $html.='<td style = "font-weight: bold;font-size: 8px; text-align: rigth; background-color: #fcf8e3;width:13%">';
                        if ($totalsoldedebit_prece != 0)
                            $html.= number_format($totalsoldedebit_prece, 3, '.', ' ');

                        $html.=' </td>';
                        $html.='<td style = "font-weight: bold;font-size: 8px; text-align: rigth; background-color: #dff0d8;width:13%">';

                        if ($totalsoldecredit_prece != 0)
                            $html.= number_format($totalsoldecredit_prece, 3, '.', ' ');

                        $html.='</td>';
                        $html.='</tr>';
                    endif;
                    $montant_debit = '';
                    $montant_credit = '';

                    if ($livre->getMontantdebit() != 0) {
                        $total_solde = $total_solde + $livre->getMontantDebit();
                        if ($livre->getPiececomptable()->getJournalcomptable()->getCode() != 'RAN')
                            $montant_debit = $livre->getMontantdebit();
                    }
                    if ($livre->getMontantcredit() != 0) {
                        $total_solde = $total_solde - $livre->getMontantcredit();
                        if ($livre->getPiececomptable()->getJournalcomptable()->getCode() != 'RAN')
                            $montant_credit = $livre->getMontantcredit();
                    }
//
                    $lettrage = '';
                    if ($livre->getLettrelettrage() != null && $livre->getLettrelettrage() != 'null') {
                        $lettrage = $livre->getLettreLettrage();
                    }

                    if ($total_solde >= 0) {
                        $soldedebiteur_affich = number_format($total_solde, 3, '.', ' ');
                        $soldedebiteur = abs($total_solde);
                    } else {
                        $soldedebiteur_affich = '';
                        $soldedebiteur = 0;
                    }

                    if ($total_solde < 0) {
                        $soldecrediteur_affich = number_format(abs($total_solde), 3, '.', ' ');
                        $soldecrediteur = abs($total_solde);
                    } else {
                        $soldecrediteur_affich = '';
                        $soldecrediteur = 0;
                    }
//
                    $html.='<tr style = "font-size:10px;">
<td style = "width:9%;height:25px;font-size:10px;text-align:center;">' . date('d/m/Y', strtotime($livre->getPiececomptable()->getDate())) . '</td>
<td style = "width:6%;">' . $livre->getPiececomptable()->getJournalcomptable()->getCode() . '</td>
<td style = "width:9%;text-align:center;">' . $livre->getPiececomptable()->getNumero() . '</td>
<td style = "width:23%;">' . $livre->getPiececomptable()->getLibelle() . '</td>

<td style = "width:13%;text-align:right;">' . $montant_debit . '</td>
<td style = "width:13%;text-align:right;">' . $montant_credit . '</td>
<td style = "width:13%;text-align:right;">' . $soldedebiteur_affich . '</td>
<td style = "width:13%;text-align:right;">' . $soldecrediteur_affich . '</td>
</tr>';

                    $totalcredit += $livre->getMontantcredit();
                    $totaldebit += $livre->getMontantdebit();
                    $totalsoldedebit = $soldedebiteur;
                    $totalsoldecredit = $soldecrediteur;
                    $numero_compte = $livre->getPlandossiercomptable()->getNumerocompte();

                endforeach;

                $html.=' <tr style="font-size:8px;font-weight:bold;">
<td colspan = "3" style = "">&nbsp;
</td>
<td colspan = "1" style = " background-color: #F7F7F7;">Total Période</td>
<td style = " text-align: right; background-color: #fcf8e3;">';
                if ($totaldebit != 0)
                    $html.= number_format($totaldebit, 3, '.', ' ');
                $html.='</td>
<td style = "text-align: right; background-color: #dff0d8;">';
                if ($totalcredit != 0)
                    $html.= number_format($totalcredit, 3, '.', ' ');
                $html.=' </td>
<td style = "text-align: right; background-color: #fcf8e3;">';
                if ($totalsoldedebit != 0)
                    $html.= number_format($totalsoldedebit, 3, '.', ' ');
                $html.=' </td>
<td style = " text-align: right; background-color: #dff0d8;">';
                if ($totalsoldecredit != 0)
                    $html.= number_format($totalsoldecredit, 3, '.', ' ');
                $html.=' </td> </tr>';

                $html.=' <tr style="font-size:8px;font-weight:bold;">
<td colspan = "3" style = "">&nbsp;
</td>
<td colspan = "1" style = " background-color: #F7F7F7;">Total Période Avec Report</td>
<td style = " text-align: right; background-color: #fcf8e3;">';
                if ($totaldebit != 0 || $totaldebit_prece != 0)
                    $html.= number_format($totaldebit + $totaldebit_prece, 3, '.', ' ');
                $html.='</td>
<td style = "text-align: right; background-color: #dff0d8;">';
                if ($totalcredit != 0 || $totalcredit_prece != 0)
                    $html.= number_format($totalcredit + $totalcredit_prece, 3, '.', ' ');
                $html.=' </td>
<td style = "text-align: right; background-color: #fcf8e3;">';
                $resultat = floatval(( $totalsoldedebit + $totalsoldedebit_prece ) - ($totalsoldecredit + $totalsoldecredit_prece));
                if ($resultat >= 0)
                    $html.= number_format($resultat, 3, '.', ' ');
                $html.=' </td>
<td style = " text-align: right; background-color: #dff0d8;">';
                if ($resultat < 0)
                    $html.= number_format($resultat, 3, '.', ' ');
                $html.=' </td> </tr>';

            endif;
        endif;

        $html.= '</table>';

        return $html;
    }

}