   public function ReadHtmlBilanActif() {

        $actif = calculParametrebilan::getBilan(0);
        $societe = SocieteTable::getInstance()->findAll()->getFirst();

        $html = '<div border="1">
                    <table cellspacing="0" cellpadding="3">
                        <tr align="center">
                            <td style="font-weight:bold;font-size:18px;width:100%;">' . $societe->getRs() . '</td>
                        </tr>
                        <tr align="center">
                            <td style="font-weight:bold;font-size:14px;width:100%;">Etat Bilan Actif<br><u>Exercice : ' . $_SESSION['exercice'] . '</u></td>
                        </tr>
                    </table>
                </div>&nbsp;<br>';

        $exercice_precedent = $_SESSION['exercice'] - 1;

        $html.= '<table cellspacing="0" cellpadding="3" border="1">
                    <tr style="font-weight:bold;text-align:center;background-color:#F3F3F3;">
                        <td style="width:50%;height:25px;">ACTIFS</td>
                        <td style="width:10%;">Notes</td>
                        <td style="width:20%;">31/12/' . $_SESSION['exercice'] . '</td>
                        <td style="width:20%;">31/12/' . $exercice_precedent . '</td>
                    </tr>';

        $html.= '<tr><td colspan="4" style="height:25px;">&nbsp;ACTIFS NON COURANTS</td></tr>
                     <tr><td colspan="4" style="height:25px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Actifs immobilisés</td></tr>';

        $html.='<tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<table><tr><td>Immobilisations incorporelles</td></tr></table></td>
                    <td style="height:25px;"></td>
                    <td style="text-align: right;">';
        if ($actif[0]['solde_courant'] >= 0):
            $html.= number_format($actif[0]['solde_courant'], 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($actif[0]['solde_courant']), 3, '.', ' ') . ')';

        endif;
        $html.='</td>
                <td style="text-align: right;">';
        if ($actif[0]['solde_prec'] != 0):
            $html.= number_format($actif[0]['solde_prec'], 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($actif[0]['solde_prec']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.='<tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<table><tr><td>Moins : amortissements</td></tr></table></td>
                    <td style="height:25px;"></td>
                    <td style="text-align: right;">';
        if ($actif[1]['solde_courant'] >= 0):
            $html.= number_format($actif[1]['solde_courant'], 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($actif[1]['solde_courant']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        if ($actif[1]['solde_prec'] >= 0):
            $html.= number_format($actif[1]['solde_prec'], 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($actif[1]['solde_prec']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.='<tr>
                    <td style="height:25px;"></td>
                    <td style="text-align: center;">3-1</td>
                    <td style="text-align: right;">';
        $total_incorporel_courant = $actif[0]['solde_courant'] - abs($actif[1]['solde_courant']);
        if ($total_incorporel_courant >= 0):
            $html.= number_format($total_incorporel_courant, 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($total_incorporel_courant), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        $total_incorporel_prec = $actif[0]['solde_prec'] - abs($actif[1]['solde_prec']);
        if ($total_incorporel_prec >= 0):
            $html.= number_format($total_incorporel_prec, 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($total_incorporel_prec), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.='<tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<table><tr><td>Immobilisations corporelles</td></tr></table></td>
                    <td style="height:25px;"></td>
                    <td style="text-align: right;">';
        if ($actif[2]['solde_courant'] >= 0):
            $html.= number_format($actif[2]['solde_courant'], 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($actif[2]['solde_courant']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        if ($actif[2]['solde_prec'] >= 0):
            $html.= number_format($actif[2]['solde_prec'], 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($actif[2]['solde_prec']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.='<tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<table><tr><td>Moins : amortissements</td></tr></table></td>
                    <td style="height:25px;"></td>
                    <td style="text-align: right;">';
        if ($actif[3]['solde_courant'] >= 0):
            $html.= number_format($actif[3]['solde_courant'], 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($actif[3]['solde_courant']), 3, '.', ' ') . ')';
        endif;

        $html.='</td>
                <td style="text-align: right;">';
        if ($actif[3]['solde_prec'] >= 0):
            $html.= number_format($actif[3]['solde_prec'], 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($actif[3]['solde_prec']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.='<tr>
                    <td style="height:25px;"></td>
                    <td style="text-align: center;">3-2</td>
                    <td style="text-align: right;">';
        $total_corporel_courant = $actif[2]['solde_courant'] - abs($actif[3]['solde_courant']);
        if ($total_corporel_courant >= 0):
            $html.= number_format($total_corporel_courant, 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($total_corporel_courant), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        $total_corporel_prec = $actif[2]['solde_prec'] - abs($actif[3]['solde_prec']);
        if ($total_corporel_prec >= 0):
            $html.= number_format($total_corporel_prec, 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($total_corporel_prec), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.='<tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<table><tr><td>Immobilisations financières</td></tr></table></td>
                    <td style="height:25px;"></td>
                    <td style="text-align: right;">';
        if ($actif[4]['solde_courant'] >= 0):
            $html.= number_format($actif[4]['solde_courant'], 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($actif[4]['solde_courant']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                    <td style="text-align: right;">';
        if ($actif[4]['solde_prec'] >= 0):
            $html.= number_format($actif[4]['solde_prec'], 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($actif[4]['solde_prec']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.='<tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<table><tr><td>Moins : provisions</td></tr></table></td>
                    <td style="height:25px;"></td>
                    <td style="text-align: right;">';
        if ($actif[5]['solde_courant'] >= 0):
            $html.= number_format($actif[5]['solde_courant'], 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($actif[5]['solde_courant']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        if ($actif[5]['solde_prec'] >= 0):
            $html.= number_format($actif[5]['solde_prec'], 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($actif[5]['solde_prec']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.= '<tr>
                    <td style="height:25px;"></td>
                    <td style="text-align: center;">3-3</td>
                    <td style="text-align: right;">';
        $total_finance_courant = $actif[4]['solde_courant'] - abs($actif[5]['solde_courant']);
        if ($total_finance_courant >= 0):
            $html.= number_format($total_finance_courant, 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($total_finance_courant), 3, '.', ' ') . ')';
        endif;
        $html.= '</td>
                <td style="text-align: right;">';
        $total_finance_prec = $actif[4]['solde_prec'] - abs($actif[5]['solde_prec']);
        if ($total_finance_prec >= 0):
            $html.= number_format($total_finance_prec, 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($total_finance_prec), 3, '.', ' ') . ')';
        endif;
        $html.= '</td>
            </tr>';

        $html.='<tr>
                    <td style="height:25px;" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<table><tr><td>Total des actifs immobilisés</td></tr></table></td>
                    <td style="text-align: right;">';
        $total_immobilise_courant = $total_incorporel_courant + $total_corporel_courant + $total_finance_courant;
        if ($total_immobilise_courant >= 0):
            $html.= number_format($total_immobilise_courant, 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($total_immobilise_courant), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        $total_immobilise_prec = $total_incorporel_prec + $total_corporel_prec + $total_finance_prec;
        if ($total_immobilise_prec >= 0):
            $html.= number_format($total_immobilise_prec, 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($total_immobilise_prec), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.='<tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<table><tr><td>Autres actifs non courants</td></tr></table></td>
                    <td style="height:25px;"></td>
                    <td style="text-align: right;">';
        if ($actif[6]['solde_courant'] >= 0):
            $html.= number_format($actif[6]['solde_courant'], 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($actif[6]['solde_courant']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        if ($actif[6]['solde_prec'] >= 0):
            $html.= number_format($actif[6]['solde_prec'], 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($actif[6]['solde_prec']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.='<tr style="background-color: #D5D5D5;">
                        <td style="height:25px;font-weight:bold;" colspan="2">&nbsp;TOTAL DES ACTIFS NON COURANTS</td>
                        <td style="text-align: right;">';
        $total_actif_non_courant_courant = $total_immobilise_courant + $actif[6]['solde_courant'];
        if ($total_actif_non_courant_courant >= 0):
            $html.= number_format($total_actif_non_courant_courant, 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($total_actif_non_courant_courant), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        $total_actif_non_courant_prec = $total_immobilise_prec + $actif[6]['solde_prec'];
        if ($total_actif_non_courant_prec >= 0):
            $html.= number_format($total_actif_non_courant_prec, 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($total_actif_non_courant_prec), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>
            <tr><td style="height:25px;" colspan="4">&nbsp;ACTIFS COURANTS</td></tr>';

        $html.='<tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<table><tr><td>Stocks</td></tr></table></td>
                    <td style="height:25px;"></td>
                    <td style="text-align: right;">';
        if ($actif[7]['solde_courant'] >= 0):
            $html.= number_format($actif[7]['solde_courant'], 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($actif[7]['solde_courant']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        if ($actif[7]['solde_prec'] >= 0):
            $html.= number_format($actif[7]['solde_prec'], 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($actif[7]['solde_prec']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.='<tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<table><tr><td>Moins : provisions</td></tr></table></td>
                    <td style="height:25px;"></td>
                    <td style="text-align: right;">';
        if ($actif[8]['solde_courant'] >= 0):
            $html.= number_format($actif[8]['solde_courant'], 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($actif[8]['solde_courant']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        if ($actif[8]['solde_prec'] >= 0):
            $html.= number_format($actif[8]['solde_prec'], 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($actif[8]['solde_prec']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.='<tr>
                    <td style="height:25px;"></td>
                    <td style="text-align: center;">3-4</td>
                    <td style="text-align: right;">';
        $total_stock_courant = $actif[7]['solde_courant'] - abs($actif[8]['solde_courant']);
        if ($total_stock_courant >= 0):
            $html.= number_format($total_stock_courant, 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($total_stock_courant), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        $total_stock_prec = $actif[7]['solde_prec'] - abs($actif[8]['solde_prec']);
        if ($total_stock_prec >= 0):
            $html.= number_format($total_stock_prec, 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($total_stock_prec), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.='<tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<table><tr><td>Clients et comptes rattachés</td></tr></table></td>
                    <td style="height:25px;"></td>
                    <td style="text-align: right;">';
        if ($actif[9]['solde_courant'] >= 0):
            $html.= number_format($actif[9]['solde_courant'], 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($actif[9]['solde_courant']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        if ($actif[9]['solde_prec'] >= 0):
            $html.= number_format($actif[9]['solde_prec'], 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($actif[9]['solde_prec']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.='<tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<table><tr><td>Moins : provisions</td></tr></table></td>
                    <td style="height:25px;"></td>
                    <td style="text-align: right;">';
        if ($actif[10]['solde_courant'] >= 0):
            $html.= number_format($actif[10]['solde_courant'], 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($actif[10]['solde_courant']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        if ($actif[10]['solde_prec'] >= 0):
            $html.= number_format($actif[10]['solde_prec'], 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($actif[10]['solde_prec']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.='<tr>
                    <td style="height:25px;"></td>
                    <td style="text-align: center;">3-5</td>
                    <td style="text-align: right;">';
        $total_client_courant = $actif[9]['solde_courant'] - abs($actif[10]['solde_courant']);
        if ($total_client_courant >= 0):
            $html.= number_format($total_client_courant, 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($total_client_courant), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        $total_client_prec = $actif[9]['solde_prec'] - abs($actif[10]['solde_prec']);
        if ($total_client_prec >= 0):
            $html.= number_format($total_client_prec, 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($total_client_prec), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.='<tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<table><tr><td>Autres actifs courants</td></tr></table></td>
                    <td style="height:25px;"></td>
                    <td style="text-align: right;">';
        if ($actif[11]['solde_courant'] >= 0):
            $html.= number_format($actif[11]['solde_courant'], 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($actif[11]['solde_courant']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        if ($actif[11]['solde_prec'] != 0)
            $html.= number_format($actif[11]['solde_prec'], 3, '.', ' ');
        $html.='</td>
            </tr>';

        $html.='<tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<table><tr><td>Moins : provisions</td></tr></table></td>
                    <td style="height:25px;"></td>
                    <td style="text-align: right;">';
        if ($actif[12]['solde_courant'] >= 0):
            $html.= number_format($actif[12]['solde_courant'], 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($actif[12]['solde_courant']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        if ($actif[12]['solde_prec'] >= 0):
            $html.= number_format($actif[12]['solde_prec'], 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($actif[12]['solde_prec']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.='<tr>
                    <td style="height:25px;"></td>
                    <td style="text-align: center;">3-6</td>
                    <td style="text-align: right;">';
        $total_autre_courant = $actif[11]['solde_courant'] - abs($actif[12]['solde_courant']);
        if ($total_autre_courant >= 0):
            $html.= number_format($total_autre_courant, 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($total_autre_courant), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        $total_autre_prec = $actif[11]['solde_prec'] - abs($actif[12]['solde_prec']);
        if ($total_autre_prec >= 0):
            $html.= number_format($total_autre_prec, 3, '.', ' ');
        else:
            $html.='(' . number_format($total_autre_prec, 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.='<tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<table><tr><td>Placements et Autres Actifs Financiers</td></tr></table></td>
                    <td style="text-align: center;height:25px;">3-7</td>
                    <td style="text-align: right;">';
        if ($actif[13]['solde_courant'] >= 0):
            $html.= number_format($actif[13]['solde_courant'], 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($actif[13]['solde_courant']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        if ($actif[13]['solde_prec'] >= 0):
            $html.= number_format($actif[13]['solde_prec'], 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($actif[13]['solde_prec']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.='<tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<table><tr><td>Liquidités et équivalents de liquidités</td></tr></table></td>
                    <td style="text-align: center;height:25px;">3-8</td>
                <td style="text-align: right;">';
        if ($actif[14]['solde_courant'] >= 0):
            $html.= number_format($actif[14]['solde_courant'], 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($actif[14]['solde_courant']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        if ($actif[14]['solde_prec'] >= 0):
            $html.= number_format($actif[14]['solde_prec'], 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($actif[14]['solde_prec']), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.='<tr style="background-color: #D5D5D5;">
                    <td style="height:25px;font-weight:bold;" colspan="2">&nbsp;TOTAL DES ACTIFS COURANTS</td>
                    <td style="text-align: right;">';
        $total_actif_courant_courant = $total_stock_courant + $total_client_courant + $total_autre_courant + $actif[13]['solde_courant'] + $actif[14]['solde_courant'];
        if ($total_actif_courant_courant >= 0):
            $html.= number_format($total_actif_courant_courant, 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($total_actif_courant_courant), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        $total_actif_courant_prec = $total_stock_prec + $total_client_prec + $total_autre_prec + $actif[13]['solde_prec'] + $actif[14]['solde_prec'];
        if ($total_actif_courant_prec >= 0):
            $html.= number_format($total_actif_courant_prec, 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($total_actif_courant_prec), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.='<tr style="background-color: #D5D5D5;">
                    <td style="height:25px;font-weight:bold;" colspan="2">&nbsp;TOTAL DES ACTIFS</td>
                    <td style="text-align: right;">';
        $total_courant = $total_actif_courant_courant + $total_actif_non_courant_courant;
        if ($total_courant >= 0):
            $html.= number_format($total_courant, 3, '.', ' ');
        else:
            $html.='(' . number_format(abs($total_courant), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
                <td style="text-align: right;">';
        $total_prec = $total_actif_courant_prec + $total_actif_non_courant_prec;
        if ($total_prec >= 0):
            $html.= number_format($total_prec, 3, '.', ' ');
        else:
            $html.= '(' . number_format(abs($total_prec), 3, '.', ' ') . ')';
        endif;
        $html.='</td>
            </tr>';

        $html.= '</table>';

        return $html;
    }

