<div id="sf_admin_container">
    <h1 id="replacediv">Notes aux Etats Financiers</h1>
</div>
<h1><b><i><center> \\ Note Bilan // </center></i></b></h1>

<?php
$annee_prec = $_SESSION['exercice'] - 1;
$exerice_prec = ExerciceTable::getInstance()->findOneByLibelle($annee_prec);
if (sizeof($exerice_prec) > 1)
    $id_exercice_prece = $exerice_prec->getId();
$strat_from = 1;
$actif_1 = calculParametrebilan::getBilan(0);
$passif = calculParametrebilan::getBilan(1);
$resultat = calculParametrebilan::getBilan(2);
$sig = calculParametrebilan::getBilan(4);
$actif = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(0, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
$ancien_exercice = $_SESSION['exercice'] - 1;
?>
<table style=" border: 1px; width: 100%" >
    <tr style="width: 100%">
        <td> <h1>ACTIF</h1>
            <h1>
                <u>ACTIFS NON COURANTS</u> :

            </h1>
        </td>
    </tr>
    <tr style="width: 100%">
        <td><h1>  Actifs immobilisés</h1></td>
    </tr>
</table>
<table style=" border: 1px; width: 100%" border="1">
    <tr style="width: 100%">
        <td style="width:70%;height:25px;">&nbsp;</td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
    </tr>
    <?php
    if ($actif_1[1][0]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($actif_1[1][0]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($actif_1[1][0]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
        <td style="text-align: center;">
            <?php
            if ($actif_1[1][0]['solde_courant'] >= 0):
                echo number_format($actif_1[1][0]['solde_courant'], 3, '.', ' ');
            elseif ($actif_1[1][0]['solde_courant'] < 0):
                echo '(' . number_format(abs($actif_1[1][0]['solde_courant']), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align:right">
            <?php
            if ($actif_1[0][0]['solde_prec'] >= 0):
                echo number_format($actif_1[0][0]['solde_prec'], 3, '.', ' ');
            elseif ($actif_1[0][0]['solde_prec'] < 0):
                echo '(' . number_format(abs($actif_1[0][0]['solde_prec']), 3, '.', ' ') . ')';
            endif;
            ?>    
        </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Moins : amortissements</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>

    <?php
    if ($actif_1[1][1]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($actif_1[1][1]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($actif_1[1][1]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
        <td style="text-align: center;">
            <?php
            $total_incorporel_courant = $actif_1[1][0]['solde_courant'] - abs($actif_1[1][1]['solde_courant']);
            if ($total_incorporel_courant >= 0):
                echo number_format($total_incorporel_courant, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_incorporel_courant), 3, '.', ' ') . ')';
            endif;
            ?> 
        </td>
        <td style="text-align:right">
            <?php
            $total_incorporel_prec = $actif_1[0][0]['solde_prec'] - abs($actif_1[0][1]['solde_prec']);

            if ($total_incorporel_prec >= 0):
                echo number_format($total_incorporel_prec, 3, '.', ' ');
            else:
                echo'(' . number_format($total_incorporel_prec, 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
    </tr>
</table>
<table style=" border: 1px; width: 100%"  border="1">

    <tr style="background-color: #0075b0;" class="table-tr">
        <td style="width:70%;height:25px;">&nbsp;</td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Immobilisations corporelles</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    if ($actif_1[1][2]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($actif_1[1][2]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($actif_1[1][2]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>

    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
        <td style="text-align: center;">
            <?php
            if ($actif_1[1][2]['solde_courant'] >= 0):
                echo number_format($actif_1[1][2]['solde_courant'], 3, '.', ' ');
            elseif ($actif_1[1][2]['solde_courant'] < 0):
                echo '(' . number_format(abs($actif_1[1][2]['solde_courant']), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align:right">
            <?php
            if ($actif_1[0][2]['solde_prec'] >= 0):
                echo number_format($actif_1[0][2]['solde_prec'], 3, '.', ' ');
            elseif ($actif_1[0][2]['solde_prec'] < 0):
                echo '(' . number_format(abs($actif_1[0][2]['solde_prec']), 3, '.', ' ') . ')';
            endif;
            ?>    
        </td>
    </tr>

    <tr>
        <td style="height:25px;"><h3>Amortissement</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    if ($actif_1[1][3]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($actif_1[1][3]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($actif_1[1][3]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
        <td style="text-align: center;">
            <?php
            $total_corporel_courant = $actif_1[1][2]['solde_courant'] - abs($actif_1[1][3]['solde_courant']);
            if ($total_corporel_courant >= 0):
                echo number_format($total_corporel_courant, 3, '.', ' ');
            else:
                echo'(' . number_format($total_corporel_courant, 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
        <td style="text-align:right">
            <?php
            $total_corporel_prec = $actif_1[0][2]['solde_prec'] - abs($actif_1[0][3]['solde_prec']);
            if ($total_corporel_prec >= 0):
                echo number_format($total_corporel_prec, 3, '.', ' ');
            else:
                echo'(' . number_format($total_corporel_prec, 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
    </tr>
</table>
<table style=" border: 1px; width: 100%"  border="1">

    <tr style="background-color: #0075b0;" class="table-tr">
        <td style="width:70%;height:25px;">&nbsp;</td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Immobilisations financières</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    if ($actif_1[1][4]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($actif_1[1][4]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($actif_1[1][4]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
        <td style="text-align: center;">
            <?php
            if ($actif_1[1][4]['solde_courant'] >= 0):
                echo number_format($actif_1[1][4]['solde_courant'], 3, '.', ' ');
            elseif ($actif_1[1][4]['solde_courant'] < 0):
                echo '(' . number_format(abs($actif_1[1][4]['solde_courant']), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            if ($actif_1[0][4]['solde_prec'] >= 0):
                echo number_format($actif_1[0][4]['solde_prec'], 3, '.', ' ');
            elseif ($actif_1[0][4]['solde_prec'] < 0):
                echo '(' . number_format(abs($actif_1[0][4]['solde_prec']), 3, '.', ' ') . ')';
            endif;
            ?>    
        </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Provisions</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    if ($actif_1[1][5]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($actif_1[1][5]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($actif_1[1][5]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
        <td style="text-align: center;">
            <?php
            $total_finance_courant = $actif_1[1][4]['solde_courant'] - abs($actif_1[1][5]['solde_courant']);
            if ($total_finance_courant >= 0):
                echo number_format($total_finance_courant, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_finance_courant), 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
        <td style="text-align: center;">
            <?php
            $total_finance_prec = $actif_1[0][4]['solde_prec'] - abs($actif_1[0][5]['solde_prec']);
            if ($total_finance_prec >= 0):
                echo number_format($total_finance_prec, 3, '.', ' ');
            else:
                echo'(' . number_format($total_finance_prec, 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
    </tr>

    <tr  style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total des actifs immobilisés</h3></td>
        <td style="text-align: center;">
            <?php
            $total_immobilise_courant = $total_incorporel_courant + $total_corporel_courant + $total_finance_courant;
            if ($total_immobilise_courant >= 0):
                echo number_format($total_immobilise_courant, 3, '.', ' ');
            else:
                echo'(' . number_format($total_immobilise_courant, 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
//                                $total_immobilise_prec = $total_incorporel_prec + $total_corporel_prec + $total_finance_prec;
            $total_immobilise_prec = $total_incorporel_prec + $total_corporel_prec + $total_finance_prec;

            if ($total_immobilise_prec >= 0):
                echo number_format($total_immobilise_prec, 3, '.', ' ');
            else:
                echo'(' . number_format($total_immobilise_prec, 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
    </tr>
</table>
<table style=" border: 1px; width: 100%"  border="1">

    <tr style="background-color: #0075b0;" class="table-tr">
        <td style="width:70%;height:25px;">&nbsp;</td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Autres actifs non courants</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>

    <?php
    if ($actif_1[1][6]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($actif_1[1][6]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($actif_1[1][6]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>TOTAL AUTRES ACTIFS NON COURANTS</h3></td>
        <td style="text-align: center;">
            <?php
            $total_actif_non_courant_courant = $actif_1[1][6]['solde_courant'];
            if ($total_actif_non_courant_courant >= 0):
                echo number_format($total_actif_non_courant_courant, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_actif_non_courant_courant), 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_actif_non_courant_prec = $actif_1[0][6]['solde_prec'];
            if ($total_actif_non_courant_prec >= 0):
                echo number_format($total_actif_non_courant_prec, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_actif_non_courant_prec), 3, '.', ' ') . ')';

            endif;
            ?>    
        </td>
    </tr>
    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>TOTAL DES ACTIFS NON COURANTS</h3></td>
        <td style="text-align: center;">
            <?php
            $total_actif_non_courant_courant = $total_immobilise_courant + $actif_1[1][6]['solde_courant'];
            if ($total_actif_non_courant_courant >= 0):
                echo number_format($total_actif_non_courant_courant, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_actif_non_courant_courant), 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_actif_non_courant_prec = $total_immobilise_prec + $actif_1[0][6]['solde_prec'];
            if ($total_actif_non_courant_prec >= 0):
                echo number_format($total_actif_non_courant_prec, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_actif_non_courant_prec), 3, '.', ' ') . ')';

            endif;
            ?>    
        </td>
    </tr>
</table>
<table class="center"  >
    <tr>
        <td>
            <h1><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?>
                <u>ACTIFS COURANTS</u> :
                <?php $strat_from++; ?>
            </h1>
        </td>
    </tr>
</table>
<table style=" border: 1px; width: 100%"  border="1">

    <tr style="background-color: #0075b0;" class="table-tr">
        <td style="width:70%;height:25px;">&nbsp;</td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Stocks</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    if ($actif_1[1][7]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($actif_1[1][7]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($actif_1[1][7]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?> 
    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
        <td style="text-align: center;">
            <?php
            $total_stock_courant_burt = $actif_1[1][7]['solde_courant'];
            if ($total_stock_courant_burt >= 0):
                echo number_format($total_stock_courant_burt, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_stock_courant_burt), 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_stock_prec_burt = $actif_1[0][7]['solde_prec'];
            if ($total_stock_prec_burt >= 0):
                echo number_format($total_stock_prec_burt, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_stock_prec_burt), 3, '.', ' ') . ')';

            endif;
            ?>    
        </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Provisions</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    if ($actif_1[1][8]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($actif_1[1][8]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($actif_1[1][8]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?> 

    <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
        <td style="text-align: center;">
            <?php
            $total_stock_courant = $actif_1[1][7]['solde_courant'] - abs($actif_1[1][8]['solde_courant']);
            if ($total_stock_courant >= 0):
                echo number_format($total_stock_courant, 3, '.', ' ');
            else:
                echo'(' . number_format($total_stock_courant, 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
        <td style="text-align: center;">
            <?php
            $total_stock_prec = $actif_1[0][7]['solde_prec'] - abs($actif_1[0][8]['solde_prec']);
            if ($total_stock_prec >= 0):
                echo number_format($total_stock_prec, 3, '.', ' ');
            else:
                echo'(' . number_format($total_stock_prec, 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
    </tr>
</table>
<table style=" border: 1px; width: 100%"  border="1">

    <tr style="background-color: #0075b0;" class="table-tr">
        <td style="width:70%;height:25px;">&nbsp;</td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Clients et comptes rattachés</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
        <?php
        if ($actif_1[1][9]['param_id'] != '') {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($actif_1[1][9]['param_id']);
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($actif_1[1][9]['param_id']);
            foreach ($params_not_regr as $param):
                if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                    ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>

    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
        <td style="text-align: center;">
            <?php
            $total_client_courant_burt = $actif_1[1][9]['solde_courant'];
            if ($total_client_courant_burt >= 0):
                echo number_format($total_client_courant_burt, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_client_courant_burt), 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_client_prec_burt = $actif_1[0][9]['solde_prec'];
            if ($total_client_prec_burt >= 0):
                echo number_format($total_client_prec_burt, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_client_prec_burt), 3, '.', ' ') . ')';

            endif;
            ?>    
        </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Provisions</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    if ($actif_1[1][10]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($actif_1[1][10]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($actif_1[1][10]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?> 
    <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
        <td style="text-align: center;">
            <?php
            $total_client_courant = $actif_1[1][9]['solde_courant'] - abs($actif_1[1][10]['solde_courant']);
            if ($total_client_courant >= 0):
                echo number_format($total_client_courant, 3, '.', ' ');
            else:
                echo'(' . number_format($total_client_courant, 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
        <td style="text-align: center;">
            <?php
            $total_client_prec = $actif_1[0][9]['solde_prec'] - abs($actif_1[0][10]['solde_prec']);
            if ($total_client_prec >= 0):
                echo number_format($total_client_prec, 3, '.', ' ');
            else:
                echo'(' . number_format($total_client_prec, 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
    </tr>
</table>
<table style=" border: 1px; width: 100%"  border="1">

    <tr style="background-color: #0075b0;" class="table-tr">
        <td style="width:70%;height:25px;">&nbsp;</td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Autres actifs courants</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    if ($actif_1[1][11]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($actif_1[1][11]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($actif_1[1][11]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>

    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
        <td style="text-align: center;">
            <?php
            $total_stock_courant_burt = $actif_1[1][11]['solde_courant'];
            if ($total_stock_courant_burt >= 0):
                echo number_format($total_stock_courant_burt, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_stock_courant_burt), 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_stock_prec_burt = $actif_1[0][11]['solde_prec'];
            if ($total_stock_prec_burt >= 0):
                echo number_format($total_stock_prec_burt, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_stock_prec_burt), 3, '.', ' ') . ')';

            endif;
            ?>    
        </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Provisions  pour dépréciation des autres actifs courants</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    if ($actif_1[1][12]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($actif_1[1][12]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($actif_1[1][12]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
        <td style="text-align: center;">
            <?php
            $total_stock_courant_burt = $actif_1[1][11]['solde_courant'] + $actif_1[1][12]['solde_courant'];
            if ($total_stock_courant_burt >= 0):
                echo number_format($total_stock_courant_burt, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_stock_courant_burt), 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_stock_prec_burt = $actif_1[0][11]['solde_prec'] + $actif_1[0][12]['solde_prec'];
            if ($total_stock_prec_burt >= 0):
                echo number_format($total_stock_prec_burt, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_stock_prec_burt), 3, '.', ' ') . ')';

            endif;
            ?>    
        </td>
    </tr>
</table>
<table style=" border: 1px; width: 100%"  border="1">

    <tr style="background-color: #0075b0;" class="table-tr">
        <td style="width:70%;height:25px;">&nbsp;</td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Placements et Autres Actifs Financiers</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    if ($actif_1[1][13]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($actif_1[1][13]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($actif_1[1][13]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
        <td style="text-align: center;">
            <?php
            $total_stock_courant_burt = $actif_1[1][13]['solde_courant'];
            if ($total_stock_courant_burt >= 0):
                echo number_format($total_stock_courant_burt, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_stock_courant_burt), 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_stock_prec_burt = $actif_1[1][13]['solde_prec'];
            if ($total_stock_prec_burt >= 0):
                echo number_format($total_stock_prec_burt, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_stock_prec_burt), 3, '.', ' ') . ')';

            endif;
            ?>    
        </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Liquidités et équivalents de liquidités</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    if ($actif_1[1][14]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($actif_1[1][14]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($actif_1[1][14]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?> 
    <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
        <td style="text-align: center;">
            <?php
            $total_liqu_courant = -$actif_1[1][13]['solde_courant'] + abs($actif_1[1][14]['solde_courant']);
            if ($total_liqu_courant >= 0):
                echo number_format($total_liqu_courant, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_liqu_courant), 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
        <td style="text-align: center;">
            <?php
            $total_liqu_prec = -$actif_1[0][13]['solde_prec'] + abs($actif_1[0][14]['solde_prec']);
            if ($total_liqu_prec >= 0):
                echo number_format($total_liqu_prec, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_liqu_prec), 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
    </tr>
    <tr style="background-color: #D5D5D5;">
        <td   style="text-align:center;font-weight:bold;height:25px;" ><h3>TOTAL DES ACTIFS COURANTS</h3></td>
        <td style="text-align: center;">
            <?php
            $total_actif_courant_courant = $total_stock_courant + $total_client_courant + $actif_1[1][13]['solde_courant'] + $actif_1[1][14]['solde_courant'];
            if ($total_actif_courant_courant >= 0):
                echo number_format($total_actif_courant_courant, 3, '.', ' ');
            else:
                echo'(' . number_format($total_actif_courant_courant, 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_actif_courant_prec = $total_stock_prec + $total_client_prec + $actif_1[0][13]['solde_prec'] + $actif_1[0][14]['solde_prec'];
            if ($total_actif_courant_prec >= 0):
                echo number_format($total_actif_courant_prec, 3, '.', ' ');
            else:
                echo'(' . number_format($total_actif_courant_prec, 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
    </tr>
    <tr style="background-color: #D5D5D5;">
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>TOTAL DES ACTIFS</h3></td>
        <td style="text-align: center;">
            <?php
            $total_courant_1 = $total_actif_courant_courant + $total_actif_non_courant_courant;
            if ($total_courant_1 >= 0):
                echo number_format($total_courant_1, 3, '.', ' ');
            else:
                echo'(' . number_format($total_courant_1, 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_prec = $total_actif_courant_prec + $total_actif_non_courant_prec;
            if ($total_prec >= 0):
                echo number_format($total_prec, 3, '.', ' ');
            else:
                echo'(' . number_format($total_prec, 3, '.', ' ') . ')';

            endif;
            ?>
        </td>

    </tr>
</table>

<table class="center" >
    <tr>
        <td> <h1>CAPITAUX PROPRES ET PASSIFS</h1>
            <h1><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?>
                <u>Capitaux propres </u> :
                <?php $strat_from++; ?>
            </h1>
        </td>
    </tr>
</table>
<table style=" border: 1px; width: 100%"  border="1">

    <tr style="background-color: #0075b0;" class="table-tr">
        <td style="width:70%;height:25px;">&nbsp;</td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
    </tr>

    <tr>
        <td style="height:25px;"><h3>Subventions d'investissements amortissables </h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>  

    <?php
    if ($passif[1][0]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($passif[1][0]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($passif[1][0]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr>
        <td style="height:25px;"><h3>Subventions d'investissements non amortissables</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>  

    <?php
    if ($passif[1][1]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($passif[1][1]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($passif[1][1]['param_id']);
        foreach ($params_not_regr as $param):
            ?>
            <tr>
                <td><?php echo $param['comptecomptable'] ?></td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if (-$param['solde'] >= 0):
                        echo number_format(-$param['solde'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                    endif;
                    ?>
                </td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if (-$param['soldeprec'] >= 0):
                        echo number_format(-$param['soldeprec'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                    endif;
                    ?></td>
            </tr>
            <?php
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr>
        <td style="height:25px;"><h3>Subvention à affecter </h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    if ($passif[1][2]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($passif[1][2]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($passif[1][2]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr>
        <td style="padding-left: 4%;">Total capitaux propres avant résultat</td>

        <td style="text-align: center;">
            <?php
            $total_avant_courant = -$passif[1][0]['solde_courant'] - $passif[1][1]['solde_courant'] + abs($passif[1][2]['solde_courant']);
            if ($total_avant_courant >= 0):
                echo number_format($total_avant_courant, 3, '.', ' ');
            elseif ($total_avant_courant < 0):
                echo '(' . number_format(abs($total_avant_courant), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_avant_prec = -$passif[1][0]['solde_prec'] - $passif[1][1]['solde_courant'] + abs($passif[0][2]['solde_prec']);
            if ($total_avant_prec >= 0):
                echo number_format($total_avant_prec, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_avant_prec), 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 6%;">Résultat de l'exercice</td>
        <td style="text-align: center;">
            <?php
            if (-$passif[1][3]['solde_courant'] >= 0):
                echo number_format(-$passif[1][3]['solde_courant'], 3, '.', ' ');
            elseif (-$passif[1][3]['solde_courant'] < 0):
                echo '(' . number_format(abs(-$passif[1][3]['solde_courant']), 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            if (-$passif[0][3]['solde_prec'] >= 0):
                echo number_format(-$passif[0][3]['solde_prec'], 3, '.', ' ');
            elseif (-$passif[0][3]['solde_prec'] < 0):
                echo '(' . number_format(abs(-$passif[0][3]['solde_prec']), 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
    </tr>
    <tr style="background-color: #D5D5D5;">
        <td style="padding-left: 2%;">TOTAL CAPITAUX PROPRES</td>

        <td style="text-align: center;">
            <?php
            $total_propre_courant = ($total_avant_courant + $passif[1][3]['solde_courant']);
            if ($total_propre_courant >= 0):
                echo number_format($total_propre_courant, 3, '.', ' ');
            elseif ($total_propre_courant < 0):
                echo '(' . number_format(abs($total_propre_courant), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_propre_prec = ($total_avant_prec + $passif[1][3]['solde_prec']);
            if ($total_propre_prec >= 0):
                echo number_format($total_propre_prec, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_propre_prec), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
    </tr>

</table>
<table class="center">
    <tr>
        <td> <h1>PASSIFS</h1>
            <h1><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?>
                <u>Passifs non courants </u> :
                <?php $strat_from++; ?>
            </h1>
        </td>
    </tr>
</table>
<table style=" border: 1px; width: 100%"  border="1">

    <tr style="background-color: #0075b0;" class="table-tr">
        <td style="width:70%;height:25px;">&nbsp;</td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Provisions </h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>  
    <?php
    if ($passif[1][4]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($passif[1][4]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($passif[1][4]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr>
        <td style="padding-left: 4%;">Total passifs non courants</td>

        <td style="text-align: center;">
            <?php
            $total_non_courant_courant = -$passif[1][4]['solde_courant'];
            if ($total_non_courant_courant >= 0):
                echo number_format($total_non_courant_courant, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_non_courant_courant), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_non_courant_prec = -$passif[0][4]['solde_prec'];
            if ($total_non_courant_prec >= 0):
                echo number_format($total_non_courant_prec, 3, '.', ' ');
            else:
                echo'(' . number_format($total_non_courant_prec, 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
    </tr>       
    <tr>
        <td>
            <h1><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?>
                <u>Passifs  courants </u> :
            </h1>
        </td><td></td><td></td>
    </tr>
    <tr>
        <td> 
            <h1>
                <u>Fournisseurs et comptes rattachés </u> :

            </h1>
        </td><td></td><td></td>

    </tr>
    <?php
    if ($passif[1][5]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($passif[1][4]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($passif[1][4]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr>
        <td> 
            <h1>
                <u>Autres passifs Courants </u> :

            </h1>
        </td>
    </tr>    
    <?php
    if ($passif[1][6]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($passif[1][6]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($passif[1][6]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr>
        <td style="padding-left: 4%;">Total passifs courants</td>

        <td style="text-align: center;">
            <?php
            $total_courant_courant = -($passif[1][5]['solde_courant'] + $passif[1][6]['solde_courant']);
            if ($total_courant_courant >= 0):
                echo number_format($total_courant_courant, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_courant_courant), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_courant_prec = -($passif[0][5]['solde_prec'] + $passif[0][6]['solde_prec']);
            if ($total_courant_prec >= 0):
                echo number_format($total_courant_prec, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_courant_prec), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>

    </tr>

    <tr style="background-color: #D5D5D5;">
        <td style="padding-left: 2%;" >TOTAL DES PASSIFS</td>
        <td style="text-align: center;">
            <?php
            $total_passif_courant = ($total_courant_courant + $total_non_courant_courant);
            if ($total_passif_courant >= 0):
                echo number_format($total_passif_courant, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_passif_courant), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_passif_prec = ($total_courant_prec + $total_non_courant_prec);
            if ($total_passif_prec >= 0):
                echo number_format($total_passif_prec, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_passif_prec), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
    </tr>
    <tr style="background-color: #D5D5D5;">
        <td style="padding-left: 2%;" >TOTAL DES CAPITAUX PROPRES ET PASSIFS</td>
        <td style="text-align: center;">

            <?php
            $total_courant = (-$total_passif_courant + $total_propre_courant);
            if ($total_courant >= 0):
                echo number_format($total_courant, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_courant), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_prec = (-$total_passif_prec + $total_propre_prec);
            if ($total_prec >= 0):
                echo number_format($total_prec, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_prec), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
    </tr>
</table>
<table style=" border: 1px; width: 100%"  >
    <tr style="background-color: #0075b0;" class="table-tr">
        <td>
            <h1>

                <u>Etat du Résultat</u> :

            </h1>
        </td><td></td><td></td>
    </tr>

    <tr style="background-color: #0075b0;" class="table-tr">
        <td style="width:70%;height:25px;">&nbsp;</td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
    </tr>


    <tr>
        <td>
            <h1><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?>
                <u>PRODUITS D'EXPLOITATION</u> :

            </h1>
        </td><?php $strat_from++; ?><td></td><td></td>
    </tr>

    <tr>
        <td> 
            <h1>
                <u>Revenus </u> :

            </h1>
        </td><td></td><td></td>
    </tr>
    <?php
    if ($resultat[1][0]['param_id'] != '') {
        $exercice_precedent = DossierexerciceTable::getInstance()->getIdExercice($_SESSION['dossier_id'], $annee_prec);
        if (sizeof($exercice_precedent) >= 1 && $resultat[0][0]['param_id'] != '') {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegroupementResultat($resultat[1][0]['param_id'], $resultat[0][0]['param_id'], $exerice_prec->getId());
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupementResutat($resultat[1][0]['param_id'], $resultat[0][0]['param_id'], $exerice_prec->getId());
        } else {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegResultat($resultat[1][0]['param_id']);
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegResutat($resultat[1][0]['param_id']);
        }
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;

        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr>
        <td>
            <h1>
                <u>Autres produits d'exploitation</u> :

            </h1>
        </td><td></td><td></td>
    </tr>
    <?php
    if ($resultat[1][1]['param_id'] != '') {
        $exercice_precedent = DossierexerciceTable::getInstance()->getIdExercice($_SESSION['dossier_id'], $annee_prec);
        if (sizeof($exercice_precedent) >= 1 && $resultat[1][1]['param_id'] != '') {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegroupementResultat($resultat[1][1]['param_id'], $resultat[0][1]['param_id'], $exerice_prec->getId());
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupementResutat($resultat[1][1]['param_id'], $resultat[0][1]['param_id'], $exerice_prec->getId());
        } else {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegResultat($resultat[1][1]['param_id']);
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegResutat($resultat[1][1]['param_id']);
        }

        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr>
        <td>
            <h1>
                <u>Production immobilisée</u> :

            </h1>
        </td><td></td><td></td>
    </tr>
    <?php
    if ($resultat[1][2]['param_id'] != '') {
        $exercice_precedent = DossierexerciceTable::getInstance()->getIdExercice($_SESSION['dossier_id'], $annee_prec);
        if (sizeof($exercice_precedent) >= 1 && $resultat[1][2]['param_id'] != '') {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegroupementResultat($resultat[1][2]['param_id'], $resultat[0][2]['param_id'], $exerice_prec->getId());
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupementResutat($resultat[1][2]['param_id'], $resultat[0][2]['param_id'], $exerice_prec->getId());
        } else {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegResultat($resultat[1][2]['param_id']);
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegResutat($resultat[1][2]['param_id']);
        }
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr>
        <td style="padding-left: 4%;">Total des produits d'exploitation</td>

        <td style="text-align: center;">
            <?php
            $total_prod_exploi_courant = -$resultat[1][0]['solde_courant'] - $resultat[1][1]['solde_courant'] - $resultat[1][2]['solde_courant'];
            if ($total_prod_exploi_courant >= 0):
                echo number_format($total_prod_exploi_courant, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_prod_exploi_courant), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_prod_exploi_prec = -$resultat[0][0]['solde_prec'] - $resultat[0][1]['solde_prec'] - $resultat[0][2]['solde_prec'];
            if ($total_prod_exploi_prec >= 0):
                echo number_format($total_prod_exploi_prec, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_prod_exploi_prec), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
    </tr>

    <tr>
        <td>
            <h1><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?>
                <u> CHARGES D'EXPLOITATION</u> :

            </h1>
        </td><?php $strat_from++; ?><td></td><td></td>
    </tr>

    <tr>
        <td>
            <h1>
                <u>Achats d'approvisionnements consommés</u> :

            </h1>
        </td><td></td><td></td>

    </tr>
    <?php
    if ($resultat[1][3]['param_id'] != '') {
        $exercice_precedent = DossierexerciceTable::getInstance()->getIdExercice($_SESSION['dossier_id'], $annee_prec);
        if (sizeof($exercice_precedent) >= 1 && $resultat[1][3]['param_id'] != '') {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegroupementResultat($resultat[1][3]['param_id'], $resultat[0][3]['param_id'], $exerice_prec->getId());
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupementResutat($resultat[1][3]['param_id'], $resultat[0][3]['param_id'], $exerice_prec->getId());
        } else {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegResultat($resultat[1][3]['param_id']);
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegResutat($resultat[1][3]['param_id']);
        }
         foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>


    <tr>
        <td>
            <h1>
                <u>Charges de personnel</u> :

            </h1>
        </td><td></td><td></td>
    </tr>
    <?php
     if ($resultat[1][4]['param_id'] != '') {
        $exercice_precedent = DossierexerciceTable::getInstance()->getIdExercice($_SESSION['dossier_id'], $annee_prec);
        if (sizeof($exercice_precedent) >= 1 && $resultat[1][3]['param_id'] != '') {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegroupementResultat($resultat[1][4]['param_id'], $resultat[0][4]['param_id'], $exerice_prec->getId());
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupementResutat($resultat[1][4]['param_id'], $resultat[0][4]['param_id'], $exerice_prec->getId());
        } else {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegResultat($resultat[1][4]['param_id']);
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegResutat($resultat[1][4]['param_id']);
        }
     
           foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr>
        <td>
            <h1>
                <u>Dotation aux amortissements et aux provisions</u> :

            </h1>
        </td><td></td><td></td>
    </tr>
    <?php
     if ($resultat[1][5]['param_id'] != '') {
        $exercice_precedent = DossierexerciceTable::getInstance()->getIdExercice($_SESSION['dossier_id'], $annee_prec);
        if (sizeof($exercice_precedent) >= 1 && $resultat[1][5]['param_id'] != '') {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegroupementResultat($resultat[1][5]['param_id'], $resultat[0][5]['param_id'], $exerice_prec->getId());
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupementResutat($resultat[1][5]['param_id'], $resultat[0][5]['param_id'], $exerice_prec->getId());
        } else {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegResultat($resultat[1][5]['param_id']);
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegResutat($resultat[1][5]['param_id']);
        }
     
          foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>


    <tr>
        <td>
            <h1>
                <u>  Autres charges d'exploitation</u> :

            </h1>
        </td>
    </tr>
    <?php
     if ($resultat[1][6]['param_id'] != '') {
        $exercice_precedent = DossierexerciceTable::getInstance()->getIdExercice($_SESSION['dossier_id'], $annee_prec);
        if (sizeof($exercice_precedent) >= 1 && $resultat[1][6]['param_id'] != '') {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegroupementResultat($resultat[1][6]['param_id'], $resultat[0][6]['param_id'], $exerice_prec->getId());
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupementResutat($resultat[1][6]['param_id'], $resultat[0][6]['param_id'], $exerice_prec->getId());
        } else {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegResultat($resultat[1][6]['param_id']);
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegResutat($resultat[1][6]['param_id']);
        }
     
         foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr>
        <td style="padding-left: 4%;">Total des charges d'exploitation</td>

        <td style="text-align: center;">
            <?php
            $total_charge_exploi_courant = $resultat[1][3]['solde_courant'] + $resultat[1][4]['solde_courant'] + $resultat[1][5]['solde_courant'] + $resultat[1][6]['solde_courant'];
            if ($total_charge_exploi_courant >= 0):
                echo number_format($total_charge_exploi_courant, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_charge_exploi_courant), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_charge_exploi_prec = $resultat[0][3]['solde_prec'] + $resultat[0][4]['solde_prec'] + $resultat[0][5]['solde_prec'] + $resultat[0][6]['solde_prec'];
            if ($total_charge_exploi_prec >= 0):
                echo number_format($total_charge_exploi_prec, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_charge_exploi_prec), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
    </tr>
    <tr style="background-color: #D5D5D5;">
        <td style="padding-left: 2%;">Résultat d'exploitation</td>

        <td style="text-align: center;">
            <?php
            $total_exploi_courant = $total_prod_exploi_courant - $total_charge_exploi_courant;
            if ($total_exploi_courant >= 0):
                echo number_format($total_exploi_courant, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_exploi_courant), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_exploi_prec = $total_prod_exploi_prec - $total_charge_exploi_prec;
            if ($total_exploi_prec >= 0):
                echo number_format($total_exploi_prec, 3, '.', ' ');
            elseif ($total_exploi_prec < 0):
                echo '(' . number_format(abs($total_exploi_prec), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <h1>
                <u>  Charges financières nettes</u> :

            </h1>
        </td><td></td><td></td>
    </tr>
    <?php
     if ($resultat[1][7]['param_id'] != '') {
        $exercice_precedent = DossierexerciceTable::getInstance()->getIdExercice($_SESSION['dossier_id'], $annee_prec);
        if (sizeof($exercice_precedent) >= 1 && $resultat[1][3]['param_id'] != '') {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegroupementResultat($resultat[1][7]['param_id'], $resultat[0][7]['param_id'], $exerice_prec->getId());
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupementResutat($resultat[1][7]['param_id'], $resultat[0][7]['param_id'], $exerice_prec->getId());
        } else {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegResultat($resultat[1][7]['param_id']);
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegResutat($resultat[1][7]['param_id']);
        }
     
          foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>


    <tr>
        <td>
            <h1>
                <u>Produits financières </u> :

            </h1>
        </td></td><td></td><td></td>
    </tr>
    <?php
     if ($resultat[1][8]['param_id'] != '') {
        $exercice_precedent = DossierexerciceTable::getInstance()->getIdExercice($_SESSION['dossier_id'], $annee_prec);
        if (sizeof($exercice_precedent) >= 1 && $resultat[1][8]['param_id'] != '') {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegroupementResultat($resultat[1][8]['param_id'], $resultat[0][8]['param_id'], $exerice_prec->getId());
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupementResutat($resultat[1][8]['param_id'], $resultat[0][8]['param_id'], $exerice_prec->getId());
        } else {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegResultat($resultat[1][8]['param_id']);
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegResutat($resultat[1][8]['param_id']);
        }
     
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr>
        <td>
            <h1>
                <u>Autre gains ordinaires</u> :

            </h1>
        </td></td><td></td><td></td>
    </tr>
    <?php
     if ($resultat[1][9]['param_id'] != '') {
        $exercice_precedent = DossierexerciceTable::getInstance()->getIdExercice($_SESSION['dossier_id'], $annee_prec);
        if (sizeof($exercice_precedent) >= 1 && $resultat[1][3]['param_id'] != '') {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegroupementResultat($resultat[1][9]['param_id'], $resultat[0][9]['param_id'], $exerice_prec->getId());
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupementResutat($resultat[1][9]['param_id'], $resultat[0][9]['param_id'], $exerice_prec->getId());
        } else {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegResultat($resultat[1][9]['param_id']);
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegResutat($resultat[1][9]['param_id']);
        }    
         foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>

    <tr>
        <td>
            <h1>
                <u>Autre pertes ordinaires</u> :

            </h1>
        </td><td></td><td></td>
    </tr>
    <?php
     if ($resultat[1][10]['param_id'] != '') {
        $exercice_precedent = DossierexerciceTable::getInstance()->getIdExercice($_SESSION['dossier_id'], $annee_prec);
        if (sizeof($exercice_precedent) >= 1 && $resultat[1][3]['param_id'] != '') {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegroupementResultat($resultat[1][10]['param_id'], $resultat[0][10]['param_id'], $exerice_prec->getId());
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupementResutat($resultat[1][10]['param_id'], $resultat[0][10]['param_id'], $exerice_prec->getId());
        } else {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegResultat($resultat[1][10]['param_id']);
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegResutat($resultat[1][10]['param_id']);
        }   
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>

    <tr style="background-color: #D5D5D5;">
        <td style="padding-left: 2%;">Résultat des activités ordinaires avant impôt</td>

        <td style="text-align: center;">
            <?php
            $total_avant_impot_courant = $total_exploi_courant - $resultat[1][9]['solde_courant'] - $resultat[1][10]['solde_courant'] - $resultat[1][8]['solde_courant'] - $resultat[1][7]['solde_courant'];
            if ($total_avant_impot_courant >= 0):
                echo number_format($total_avant_impot_courant, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_avant_impot_courant), 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_avant_impot_prec = $total_exploi_prec - $resultat[0][9]['solde_prec'] - $resultat[0][10]['solde_prec'] - $resultat[0][8]['solde_prec'] - $resultat[0][7]['solde_prec'];
            if ($total_avant_impot_prec >= 0):
                echo number_format($total_avant_impot_prec, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_avant_impot_prec), 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 6%;">Impôt sur les bénéfices</td>
    </tr>
    <?php
     if ($resultat[1][11]['param_id'] != '') {
        $exercice_precedent = DossierexerciceTable::getInstance()->getIdExercice($_SESSION['dossier_id'], $annee_prec);
        if (sizeof($exercice_precedent) >= 1 && $resultat[1][11]['param_id'] != '') {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegroupementResultat($resultat[1][11]['param_id'], $resultat[0][11]['param_id'], $exerice_prec->getId());
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupementResutat($resultat[1][11]['param_id'], $resultat[0][11]['param_id'], $exerice_prec->getId());
        } else {
            $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNoRegResultat($resultat[1][11]['param_id']);
            $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegResutat($resultat[1][11]['param_id']);
        }
     
          foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr style="background-color: #D5D5D5;">
        <td style="padding-left: 2%;">Résultat des activités ordinaires après impôt</td>

        <td style="text-align: center;">
            <?php
            $total_apres_impot_courant = $total_avant_impot_courant + $resultat[1][11]['solde_courant'];
            if ($total_apres_impot_courant >= 0):
                echo number_format($total_apres_impot_courant, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_apres_impot_courant), 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_apres_impot_prec = $total_avant_impot_prec + $resultat[0][11]['solde_prec'];
            if ($total_apres_impot_prec >= 0):
                echo number_format($total_apres_impot_prec, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_apres_impot_prec), 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
    </tr>
    <tr style="background-color: #D5D5D5;">
        <td style="padding-left: 2%;" >Résultat net de l'exercice</td>
        <td style="text-align: center;">
            <?php
            $total_net_courant = $total_apres_impot_courant;
            if ($total_net_courant >= 0):
                echo number_format($total_net_courant, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_net_courant), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_net_prec = $total_apres_impot_prec;
            if ($total_net_prec >= 0):
                echo number_format($total_net_prec, 3, '.', ' ');
            else:
                echo '(' . number_format($total_net_prec, 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
    </tr>

</table>    
<table class="center"  >
    <tr>
        <td> <h1>Etat du Solde Intermediaire de Gestion</h1>
            <h1><?php // echo str_pad($strat_from, '2', '0', STR_PAD_LEFT);    ?>
                <u>Produits d'exploitation</u> :
                <?php // $strat_from++;      ?>
            </h1>
        </td>
    </tr>
</table>
<table style=" border: 1px; width: 100%" border="1">

    <tr style="background-color: #0075b0;" class="table-tr">
        <td style="width:70%;height:25px;">&nbsp;</td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
    </tr>


    <?php
    if ($sig[1][0]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($sig[1][0]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($sig[1][0]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr>
        <td> <h1>  Production Immobilisée</h1>

        </td><td></td><td></td>
    </tr>
    <?php
    if ($sig[1][1]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($sig[1][1]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($sig[1][1]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>

    <tr style="background-color: #D5D5D5;">
        <td style="padding-left: 2%;">Production</td>

        <td style="text-align: center;">
            <?php
            $total_production_courant = -($sig[1][0]['solde_courant'] + $sig[1][1]['solde_courant']);
            if ($total_production_courant >= 0):
                echo number_format($total_production_courant, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_production_courant), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_production_prec = -($sig[0][0]['solde_prec'] + $sig[0][1]['solde_prec']);
            if ($total_production_prec >= 0):
                echo number_format($total_production_prec, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_production_prec), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
    </tr>      

    <tr>
        <td> <h1>Coût des matières consommées</h1>

        </td><td></td><td></td>
    </tr>
    <?php
    if ($sig[1][2]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($sig[1][2]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($sig[1][2]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>

    <tr>
        <td> <h1>Déstokage de production</h1>

        </td><td></td><td></td>
    </tr>
    <?php
    if ($sig[1][3]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($sig[1][3]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($sig[1][3]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>

    <tr style="background-color: #D5D5D5;">
        <td style="padding-left: 2%;">Achats consommés</td>
        <td style="text-align: center;">
            <?php
            $total_consomme_courant = ($sig[1][2]['solde_courant'] + $sig[1][3]['solde_courant']);
            if ($total_consomme_courant >= 0):
                echo number_format($total_consomme_courant, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_consomme_courant), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_consomme_prec = ($sig[0][2]['solde_prec'] + $sig[0][3]['solde_prec']);
            if ($total_consomme_prec >= 0):
                echo number_format($total_consomme_prec, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_consomme_prec), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
    </tr>
    <tr style="background-color: #D5D5D5;">
        <td style="padding-left: 2%;">Marge sur coût matières</td>
        <td style="text-align: center;">
            <?php
            $total_marge_courant = ($total_production_courant - $total_consomme_courant);
            if ($total_marge_courant >= 0):
                echo number_format($total_marge_courant, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_marge_courant), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_marge_prec = ($total_production_prec - $total_consomme_prec);
            if ($total_marge_prec >= 0):
                echo number_format($total_marge_prec, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_marge_prec), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
    </tr>

    <tr>
        <td> <h1>Autres produits d'exploitation</h1>

        </td><td></td><td></td>
    </tr>

    <?php
    if ($sig[1][4]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($sig[1][4]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($sig[1][4]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['solde'] >= 0):
                            echo number_format(-$param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if (-$param['soldeprec'] >= 0):
                            echo number_format(-$param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>
    <tr>
        <td> <h1>Autres charges d'exploitation</h1>

        </td><td></td><td></td>
    </tr>
    <?php
    if ($sig[1][5]['param_id'] != '') {
        $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($sig[1][5]['param_id']);
        $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($sig[1][5]['param_id']);
        foreach ($params_not_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['comptecomptable'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
        foreach ($params_regr as $param):
            if ($param['solde'] != 0 || $param['soldeprec'] != 0):
                ?>
                <tr>
                    <td><?php echo $param['regrouppement'] ?></td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['solde'] >= 0):
                            echo number_format($param['solde'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                        endif;
                        ?>
                    </td>
                    <td style="text-align:right;height:25px;">
                        <?php
                        if ($param['soldeprec'] >= 0):
                            echo number_format($param['soldeprec'], 3, '.', ' ');
                        else:
                            echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                        endif;
                        ?></td>
                </tr>
                <?php
            endif;
        endforeach;
    }
    ?>


    <tr style="background-color: #D5D5D5;">
        <td style="padding-left: 2%;">VALEUR AJOUTEE BRUTE</td>

        <td style="text-align: center;">
            <?php
            $total_activite_courant = $total_marge_courant - ($sig[1][4]['solde_courant']) - $sig[1][5]['solde_courant'];
            if ($total_activite_courant >= 0):
                echo number_format($total_activite_courant, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_activite_courant), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_activite_prec = $total_marge_prec - ($sig[0][4]['solde_prec']) - $sig[0][5]['solde_prec'];
            if ($total_activite_prec >= 0):
                echo number_format($total_activite_prec, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_activite_prec), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
    </tr>


    <td> <h1>Impôts et taxes</h1>

    </td><td></td><td></td>
</tr>
<?php
if ($sig[1][6]['param_id'] != '') {
    $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($sig[1][6]['param_id']);
    $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($sig[1][6]['param_id']);
    foreach ($params_not_regr as $param):
        if ($param['solde'] != 0 || $param['soldeprec'] != 0):
            ?>
            <tr>
                <td><?php echo $param['comptecomptable'] ?></td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['solde'] >= 0):
                        echo number_format($param['solde'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                    endif;
                    ?>
                </td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['soldeprec'] >= 0):
                        echo number_format($param['soldeprec'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                    endif;
                    ?></td>
            </tr>
            <?php
        endif;
    endforeach;
    foreach ($params_regr as $param):
        if ($param['solde'] != 0 || $param['soldeprec'] != 0):
            ?>
            <tr>
                <td><?php echo $param['regrouppement'] ?></td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['solde'] >= 0):
                        echo number_format($param['solde'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                    endif;
                    ?>
                </td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['soldeprec'] >= 0):
                        echo number_format($param['soldeprec'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                    endif;
                    ?></td>
            </tr>
            <?php
        endif;
    endforeach;
}
?>

<tr><td> <h1>Charges de personnel</h1>

    </td>
</tr>
<?php
if ($sig[1][7]['param_id'] != '') {
    $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($sig[1][7]['param_id']);
    $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($sig[1][7]['param_id']);
    foreach ($params_not_regr as $param):
        if ($param['solde'] != 0 || $param['soldeprec'] != 0):
            ?>
            <tr>
                <td><?php echo $param['comptecomptable'] ?></td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['solde'] >= 0):
                        echo number_format($param['solde'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                    endif;
                    ?>
                </td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['soldeprec'] >= 0):
                        echo number_format($param['soldeprec'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                    endif;
                    ?></td>
            </tr>
            <?php
        endif;
    endforeach;
    foreach ($params_regr as $param):
        if ($param['solde'] != 0 || $param['soldeprec'] != 0):
            ?>
            <tr>
                <td><?php echo $param['regrouppement'] ?></td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['solde'] >= 0):
                        echo number_format($param['solde'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                    endif;
                    ?>
                </td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['soldeprec'] >= 0):
                        echo number_format($param['soldeprec'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                    endif;
                    ?></td>
            </tr>
            <?php
        endif;
    endforeach;
}
?>

<tr style="background-color: #D5D5D5;">
    <td style="padding-left: 2%;">EXCEDENT BRUT D'EXLOITATION</td>

    <td style="text-align: center;">
        <?php
        $total_exedent_courant = $total_activite_courant - $sig[1][7]['solde_courant'] - $sig[1][6]['solde_courant'];
        if ($total_exedent_courant >= 0):
            echo number_format($total_exedent_courant, 3, '.', ' ');
        else:
            echo '(' . number_format(abs($total_exedent_courant), 3, '.', ' ') . ')';
        endif;
        ?>
    </td>
    <td style="text-align: center;">
        <?php
        $total_exedent_prec = $total_activite_prec - $sig[0][6]['solde_prec'] - $sig[0][7]['solde_prec'];
        if ($total_exedent_prec >= 0):
            echo number_format($total_exedent_prec, 3, '.', ' ');
        else:
            echo '(' . number_format(abs($total_exedent_prec), 3, '.', ' ') . ')';
        endif;
        ?>
    </td>
</tr>

<tr>
    <td> <h1>Charges financières</h1>

    </td>
</tr>

<?php
if ($sig[1][8]['param_id'] != '') {
    $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($sig[1][8]['param_id']);
    $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($sig[1][8]['param_id']);
    foreach ($params_not_regr as $param):
        if ($param['solde'] != 0 || $param['soldeprec'] != 0):
            ?>
            <tr>
                <td><?php echo $param['comptecomptable'] ?></td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['solde'] >= 0):
                        echo number_format($param['solde'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                    endif;
                    ?>
                </td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['soldeprec'] >= 0):
                        echo number_format($param['soldeprec'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                    endif;
                    ?></td>
            </tr>
            <?php
        endif;
    endforeach;
    foreach ($params_regr as $param):
        if ($param['solde'] != 0 || $param['soldeprec'] != 0):
            ?>
            <tr>
                <td><?php echo $param['regrouppement'] ?></td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['solde'] >= 0):
                        echo number_format($param['solde'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                    endif;
                    ?>
                </td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['soldeprec'] >= 0):
                        echo number_format($param['soldeprec'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                    endif;
                    ?></td>
            </tr>
            <?php
        endif;
    endforeach;
}
?>
<tr>
    <td> <h1>Dotation aux amortissements et aux provisions </h1>

    </td>
</tr>
<?php
if ($sig[1][9]['param_id'] != '') {
    $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($sig[1][9]['param_id']);
    $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($sig[1][9]['param_id']);
    foreach ($params_not_regr as $param):
        if ($param['solde'] != 0 || $param['soldeprec'] != 0):
            ?>
            <tr>
                <td><?php echo $param['comptecomptable'] ?></td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['solde'] >= 0):
                        echo number_format($param['solde'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                    endif;
                    ?>
                </td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['soldeprec'] >= 0):
                        echo number_format($param['soldeprec'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                    endif;
                    ?></td>
            </tr>
            <?php
        endif;
    endforeach;
    foreach ($params_regr as $param):
        if ($param['solde'] != 0 || $param['soldeprec'] != 0):
            ?>
            <tr>
                <td><?php echo $param['regrouppement'] ?></td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['solde'] >= 0):
                        echo number_format($param['solde'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                    endif;
                    ?>
                </td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['soldeprec'] >= 0):
                        echo number_format($param['soldeprec'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                    endif;
                    ?></td>
            </tr>
            <?php
        endif;
    endforeach;
}
?>

<tr>  <td> <h1>Produits Financiers</h1> </td> </tr>

<?php
if ($sig[1][10]['param_id'] != '') {
    $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($sig[1][10]['param_id']);
    $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($sig[1][10]['param_id']);
    foreach ($params_not_regr as $param):
        if ($param['solde'] != 0 || $param['soldeprec'] != 0):
            ?>
            <tr>
                <td><?php echo $param['comptecomptable'] ?></td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['solde'] >= 0):
                        echo number_format($param['solde'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                    endif;
                    ?>
                </td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['soldeprec'] >= 0):
                        echo number_format($param['soldeprec'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                    endif;
                    ?></td>
            </tr>
            <?php
        endif;
    endforeach;
    foreach ($params_regr as $param):
        if ($param['solde'] != 0 || $param['soldeprec'] != 0):
            ?>
            <tr>
                <td><?php echo $param['regrouppement'] ?></td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['solde'] >= 0):
                        echo number_format($param['solde'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                    endif;
                    ?>
                </td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['soldeprec'] >= 0):
                        echo number_format($param['soldeprec'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                    endif;
                    ?></td>
            </tr>
            <?php
        endif;
    endforeach;
}
?>

<tr>
    <td> <h1>Autres gains ordinaires</h1>

    </td>
</tr>

<?php
if ($sig[1][11]['param_id'] != '') {
    $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($sig[1][11]['param_id']);
    $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($sig[1][11]['param_id']);
    foreach ($params_not_regr as $param):
        if ($param['solde'] != 0 || $param['soldeprec'] != 0):
            ?>
            <tr>
                <td><?php echo $param['comptecomptable'] ?></td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['solde'] >= 0):
                        echo number_format($param['solde'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                    endif;
                    ?>
                </td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['soldeprec'] >= 0):
                        echo number_format($param['soldeprec'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                    endif;
                    ?></td>
            </tr>
            <?php
        endif;
    endforeach;
    foreach ($params_regr as $param):
        if ($param['solde'] != 0 || $param['soldeprec'] != 0):
            ?>
            <tr>
                <td><?php echo $param['regrouppement'] ?></td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['solde'] >= 0):
                        echo number_format($param['solde'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                    endif;
                    ?>
                </td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['soldeprec'] >= 0):
                        echo number_format($param['soldeprec'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                    endif;
                    ?></td>
            </tr>
            <?php
        endif;
    endforeach;
}
?>
<tr>
    <td> <h1>Autres pertes ordinaires</h1>

    </td>
</tr>

<?php
if ($sig[1][12]['param_id'] != '') {
    $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($sig[1][12]['param_id']);
    $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($sig[1][12]['param_id']);
    foreach ($params_not_regr as $param):
        if ($param['solde'] != 0 || $param['soldeprec'] != 0):
            ?>
            <tr>
                <td><?php echo $param['comptecomptable'] ?></td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['solde'] >= 0):
                        echo number_format($param['solde'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                    endif;
                    ?>
                </td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['soldeprec'] >= 0):
                        echo number_format($param['soldeprec'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                    endif;
                    ?></td>
            </tr>
            <?php
        endif;
    endforeach;
    foreach ($params_regr as $param):
        if ($param['solde'] != 0 || $param['soldeprec'] != 0):
            ?>
            <tr>
                <td><?php echo $param['regrouppement'] ?></td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['solde'] >= 0):
                        echo number_format($param['solde'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                    endif;
                    ?>
                </td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['soldeprec'] >= 0):
                        echo number_format($param['soldeprec'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                    endif;
                    ?></td>
            </tr>
            <?php
        endif;
    endforeach;
}
?>
<tr style="background-color: #D5D5D5;">
    <td style="padding-left: 2%;">RESULTAT DES ACTIVITES AVANT IMPÔT</td>
    <td style="text-align: center;">
        <?php
        $total_avantimpot_courant = -( $total_exedent_courant - $sig[1][12]['solde_courant'] - $sig[1][11]['solde_courant'] - $sig[1][10]['solde_courant'] - $sig[1][9]['solde_courant'] - $sig[1][8]['solde_courant']);
        if ($total_avantimpot_courant >= 0):
            echo number_format($total_avantimpot_courant, 3, '.', ' ');
        else:
            echo '(' . number_format(abs($total_avantimpot_courant), 3, '.', ' ') . ')';
        endif;
        ?>
    </td>
    <td style="text-align: center;">
        <?php
        $total_avantimpot_prec = -($total_exedent_prec - $sig[0][12]['solde_prec'] - $sig[0][11]['solde_prec'] - $sig[0][10]['solde_prec'] - $sig[0][9]['solde_prec'] - $sig[0][8]['solde_prec']);
        if ($total_avantimpot_prec >= 0):
            echo number_format($total_avantimpot_prec, 3, '.', ' ');
        else:
            echo '(' . number_format(abs($total_avantimpot_prec), 3, '.', ' ') . ')';
        endif;
        ?>
    </td>
</tr>
<tr>
    <td> <h1>Impôt sur le résultat ordinaire</h1>

    </td>
</tr>
<?php
if ($sig[1][13]['param_id'] != '') {
    $params_not_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndNotRegroupement($sig[1][13]['param_id']);
    $params_regr = ParametrebilancompteTable::getInstance()->getByIdParametrebilanAndRegroupement($sig[1][13]['param_id']);
    foreach ($params_not_regr as $param):
        if ($param['solde'] != 0 || $param['soldeprec'] != 0):
            ?>
            <tr>
                <td><?php echo $param['comptecomptable'] ?></td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['solde'] >= 0):
                        echo number_format($param['solde'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                    endif;
                    ?>
                </td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['soldeprec'] >= 0):
                        echo number_format($param['soldeprec'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                    endif;
                    ?></td>
            </tr>
            <?php
        endif;
    endforeach;
    foreach ($params_regr as $param):
        if ($param['solde'] != 0 || $param['soldeprec'] != 0):
            ?>
            <tr>
                <td><?php echo $param['regrouppement'] ?></td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['solde'] >= 0):
                        echo number_format($param['solde'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['solde']), 3, '.', ' ') . ')';
                    endif;
                    ?>
                </td>
                <td style="text-align:right;height:25px;">
                    <?php
                    if ($param['soldeprec'] >= 0):
                        echo number_format($param['soldeprec'], 3, '.', ' ');
                    else:
                        echo '(' . number_format(abs($param['soldeprec']), 3, '.', ' ') . ')';
                    endif;
                    ?></td>
            </tr>
            <?php
        endif;
    endforeach;
}
?>
<tr style="background-color: #D5D5D5;">
    <td style="padding-left: 2%;">RESULTAT NET APRES IMPÔT</td>

    <td style="text-align: center;">
        <?php
        $total_apres_impot_courant = $total_avantimpot_courant - $sig[1][13]['solde_courant'];
        if ($total_apres_impot_courant >= 0):
            echo number_format($total_apres_impot_courant, 3, '.', ' ');
        else:
            echo '(' . number_format(abs($total_apres_impot_courant), 3, '.', ' ') . ')';
        endif;
        ?>
    </td>
    <td style="text-align: center;">
        <?php
        $total_apres_impot_prec = $total_avantimpot_prec - $sig[0][13]['solde_prec'];
        if ($total_apres_impot_prec >= 0):
            echo number_format($total_apres_impot_prec, 3, '.', ' ');
        else:
            echo '(' . number_format($total_apres_impot_prec, 3, '.', ' ') . ')';
        endif;
        ?>
    </td>
</tr>
<tr style="background-color: #D5D5D5;">
    <td style="padding-left: 2%;" >Résultat net de l'exercice</td>
    <td style="text-align: center;">
        <?php
        $total_net_courant = $total_apres_impot_courant;
        if ($total_net_courant >= 0):
            echo number_format($total_net_courant, 3, '.', ' ');
        else:
            echo'(' . number_format(abs($total_net_courant), 3, '.', ' ') . ')';
        endif;
        ?>
    </td>
    <td style="text-align: center;">
        <?php
        $total_net_prec = $total_apres_impot_prec;
        if ($total_net_prec >= 0):
            echo number_format($total_net_prec, 3, '.', ' ');
        else:
            echo '(' . number_format($total_net_prec, 3, '.', ' ') . ')';
        endif;
        ?>
    </td>
</tr>   
</table>


<div class="row">
    <div class="col-sm-12">
        <table style="margin-bottom: 0px;"><tr><td><a class="btn btn-primary" href="<?php echo url_for('fiche_Bilan/imprimerNote'); ?>" target="_blank" style="float: right;"><i class="ace-icon fa fa-print"></i> Imprimer </a></td></tr></table>
    </div>
</div>
<style>

    .align_center{text-align: center;}

</style>
<style>

    .grey-background{
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 40px;
        padding-right: 60px;
        margin: 0 0 15px;
        font-size: 14px;
        word-break: break-word;
        word-wrap: break-word;
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

</style>