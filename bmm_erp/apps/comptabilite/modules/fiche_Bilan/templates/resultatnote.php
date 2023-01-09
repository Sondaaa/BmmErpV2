<?php
$annee_prec = $_SESSION['exercice'] - 1;
$exerice_prec = ExerciceTable::getInstance()->findOneByLibelle($annee_prec);
$id_exercice_prece = $exerice_prec->getId();
$strat_from = 1;
$actif_1 = calculParametrebilan::getBilan(0);
$actif = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(0, $_SESSION['exercice_id'], $_SESSION['dossier_id']);
$ancien_exercice = $_SESSION['exercice'] - 1;
?>
<table class="center">
    <tr>
        <td> <h1>ACTIF</h1>
            <h1><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?>
                <u>IMMOB INCORPORELLES</u> :
                <?php $strat_from++; ?>
            </h1>
        </td>
    </tr>
</table>
<table style=" border: 1px; width: 100%">

    <tr style="background-color: #0075b0;" class="table-tr">
        <td style="width:70%;height:25px;">&nbsp;</td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Immobilisations incorporelles</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    $actif_prec = ParametrebilanTable::getInstance()->findByTypeAndIdExerciceAndIdDossier(0, $id_exercice_prece, $_SESSION['dossier_id']);
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[2]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>

                    <tr>
                        <td>

                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>

                        </td>
                        <td style="text-align:right;height:25px;">
                            <?php
                            $solde_prece = $param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde();
                            $solde_courant = $param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde();
                            ?>
                            <?php
                            if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';

                            endif;

                            ?>
                        </td>
                        <td style="text-align:right;">
                            <?php
                              if ( $param_compte->getPlandossiercomptable()->getSoldeouv() >= 0):
                                echo number_format( $param_compte->getPlandossiercomptable()->getSoldeouv(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSoldeouv()), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>

                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
        <td style="text-align: center;">
            <?php
            $total_incorporel_courant = $actif_1[0]['solde_courant'];
            if ($total_incorporel_courant >= 0):
                echo number_format($total_incorporel_courant, 3, '.', ' ');
            else:
                echo'(' . number_format($total_incorporel_courant, 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align:right">
            <?php
            $total_incorporel_prec = $actif_1[0]['solde_prec'];
            if ($total_incorporel_prec >= 0):
                echo number_format($total_incorporel_prec, 3, '.', ' ');
            else:
                echo'(' . number_format($total_incorporel_prec, 3, '.', ' ') . ')';
            endif;
            ?>    
        </td>
    </tr>
    <?php // if ($actif_1[1]['param_id'] != ''):      ?>
    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1]['param_id']); ?>
    <?php $compte_numero = ''; ?>
    <?php
    foreach ($params as $param_compte):
        $numero = $param_compte->getPlandossiercomptable()->getNumerocompte();
        if ($param_compte->getType() == 1)
            $numero = '<b>' . $numero . '</b>';
        $libelle = $param_compte->getPlandossiercomptable()->getLibelle();
        if ($compte_numero == '') {
            $compte_numero = $numero;
        } else {
            $compte_numero = $compte_numero . ' + ' . $param_compte->getPlandossiercomptable()->getNumerocompte();
        }
    endforeach;
    ?>                            

    <tr>
        <td style="height:25px;"><h3>Amortissement</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <tr>
        <td> <?php echo $numero . ' - ' . $libelle; ?>

        </td>
        <td style="text-align:right;height:25px;">
            <?php
            if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
            else:
                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
        <td style="text-align:right;">
            <?php if ($actif_1[1]['solde_prec'] >= 0): ?>
                <?php echo number_format($actif_1[1]['solde_prec'], 3, '.', ' '); ?>
            <?php else: ?>
                <?php echo '(' . number_format(abs($actif_1[1]['solde_prec']), 3, '.', ' ') . ')'; ?>
            <?php endif; ?>
        </td>

    </tr>



    <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
        <td style="text-align: center;">
            <?php
            $total_incorporel_courant = $actif_1[0]['solde_courant'] - abs($actif_1[1]['solde_courant']);
            if ($total_incorporel_courant >= 0):
                echo number_format($total_incorporel_courant, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_incorporel_courant), 3, '.', ' ') . ')';
            endif;
            ?> 
        </td>
        <td style="text-align:right">


            <?php
            $total_incorporel_prec = $actif_1[0]['solde_prec'] - abs($actif_1[1]['solde_prec']);

            if ($total_incorporel_prec >= 0):
                echo number_format($total_incorporel_prec, 3, '.', ' ');
            else:
                echo'(' . number_format($total_incorporel_prec, 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
    </tr>

</table>
<table class="center">
    <tr>
        <td> 
            <h1>    <b> <?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT) ?>
                    <u>IMMOB CORPORELLES</u> :</b><br></h1>
        </td>
    </tr>
</table>

<?php $strat_from++; ?>
<table style=" border: 1px; width: 100%">

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
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[2]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>
                    <tr>
                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>
                        </td>
                        <td style="text-align:right;height:25px;">

                            <?php
                            if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                            endif;
//                                              
                            ?>
                        </td>

                        <td style="text-align:right;">
                            <?php
                            if ($actif_1[2]['solde_prec'] >= 0):
                                echo number_format($actif_1[2]['solde_prec'], 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($actif_1[2]['solde_prec']), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
        <td style="text-align: center;">
            <?php
            if ($actif_1[2]['solde_courant'] >= 0):
                echo number_format($actif_1[2]['solde_courant'], 3, '.', ' ');
            elseif ($actif_1[2]['solde_courant'] < 0):
                echo '(' . number_format(abs($actif_1[2]['solde_courant']), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align:right">
            <?php
            $total_incorporel_prec = $actif_1[0]['solde_prec'];
            if ($total_incorporel_prec >= 0):
                echo number_format($total_incorporel_prec, 3, '.', ' ');
            else:
                echo'(' . number_format($total_incorporel_prec, 3, '.', ' ') . ')';
            endif;
            ?>    
        </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Amortissement</h3></td>
        <td style="text-align:right">
            <?php
            $total_ammortissement_courant = $actif_1[3]['solde_courant'];
            if ($total_ammortissement_courant >= 0):
                echo number_format($total_ammortissement_courant, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_ammortissement_courant), 3, '.', ' ') . ')';

            endif;
            ?>  
        </td>
        <td style="text-align:right">

        </td>
    </tr>


    <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
        <td style="text-align: center;">
            <?php
            $total_corporel_courant = $actif_1[2]['solde_courant'] - abs($actif_1[3]['solde_courant']);
            if ($total_corporel_courant >= 0):
                echo number_format($total_corporel_courant, 3, '.', ' ');
            else:
                echo'(' . number_format($total_corporel_courant, 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
        <td style="text-align:right">
            <?php
            $total_corporel_prec = $actif_1[2]['solde_prec'] - abs($actif_1[3]['solde_prec']);
            if ($total_corporel_prec >= 0):
                echo number_format($total_corporel_prec, 3, '.', ' ');
            else:
                echo'(' . number_format($total_corporel_prec, 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
    </tr>

</table>



<table class="center">
    <tr>
        <td> 
            <h1>     <b> <?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT) ?>
                    <u>Immobilisations financières</u> :</b><br></h1>
        </td>
    </tr>
</table>

<?php $strat_from++; ?>
<table style=" border: 1px; width: 100%">

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
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[4]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>
                    <tr>
                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>
                        </td>
                        <td style="text-align:right;height:25px;">

                            <?php
                            if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                            endif;
//                                              
                            ?>
                        </td>

                        <td style="text-align:right;">
                            <?php
                            if ($actif_1[4]['solde_prec'] >= 0):
                                echo number_format($actif_1[4]['solde_prec'], 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($actif_1[4]['solde_prec']), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
        <td style="text-align: center;">
            <?php
            if ($actif_1[4]['solde_courant'] >= 0):
                echo number_format($actif_1[4]['solde_courant'], 3, '.', ' ');
            elseif ($actif_1[4]['solde_courant'] < 0):
                echo '(' . number_format(abs($actif_1[4]['solde_courant']), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_incorporel_prec = $actif_1[4]['solde_prec'];
            if ($total_incorporel_prec >= 0):
                echo number_format($total_incorporel_prec, 3, '.', ' ');
            else:
                echo'(' . number_format($total_incorporel_prec, 3, '.', ' ') . ')';
            endif;
            ?>    
        </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Provisions</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[5]['param_id']); ?>
    <?php $compte_numero = ''; ?>
    <?php
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>
                    <tr>

                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>
                        </td>
                        <td style="text-align:right;height:25px;">

                            <?php
                            if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                            endif;
//                                              
                            ?>
                        </td>
                        <td style="text-align:right;">
                            <?php if ($actif_1[5]['solde_prec'] >= 0): ?>
                                <?php echo number_format($actif_1[5]['solde_prec'], 3, '.', ' '); ?>
                            <?php else: ?>
                                <?php echo '(' . number_format(abs($actif_1[5]['solde_prec']), 3, '.', ' ') . ')'; ?>
                            <?php endif; ?>
                        </td>

                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
        <td style="text-align: center;">
            <?php
            $total_finance_courant = $actif_1[4]['solde_courant'] - abs($actif_1[5]['solde_courant']);
            if ($total_finance_courant >= 0):
                echo number_format($total_finance_courant, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_finance_courant), 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
        <td style="text-align: center;">
            <?php
            $total_finance_prec = $actif_1[4]['solde_prec'] - abs($actif_1[5]['solde_prec']);
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

<!-- autre!-->
<table class="center">
    <tr>
        <td> 
            <h1>  <b> <?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT) ?>
                    <u>Autres actifs non courants</u> :</b><br></h1>
        </td>
    </tr>
</table>

<?php $strat_from++; ?>
<table style=" border: 1px; width: 100%">

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
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[6]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>
                    <tr>
                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>
                        </td>
                        <td style="text-align:right;height:25px;">

                            <?php
                            if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                            endif;
//                                              
                            ?>
                        </td>

                        <td style="text-align:right;">
                            <?php
                            if ($actif_1[6]['solde_prec'] >= 0):
                                echo number_format($actif_1[6]['solde_prec'], 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($actif_1[6]['solde_prec']), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>TOTAL AUTRES ACTIFS NON COURANTS</h3></td>
        <td style="text-align: center;">
            <?php
            $total_actif_non_courant_courant = $actif_1[6]['solde_courant'];
            if ($total_actif_non_courant_courant >= 0):
                echo number_format($total_actif_non_courant_courant, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_actif_non_courant_courant), 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_actif_non_courant_prec = $actif_1[6]['solde_prec'];
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
            $total_actif_non_courant_courant = $total_immobilise_courant + $actif_1[6]['solde_courant'];
            if ($total_actif_non_courant_courant >= 0):
                echo number_format($total_actif_non_courant_courant, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_actif_non_courant_courant), 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_actif_non_courant_prec = $total_immobilise_prec + $actif_1[6]['solde_prec'];
            if ($total_actif_non_courant_prec >= 0):
                echo number_format($total_actif_non_courant_prec, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_actif_non_courant_prec), 3, '.', ' ') . ')';

            endif;
            ?>    
        </td>
    </tr>

</table>





<table class="center">
    <tr>
        <td> 
            <h1> <b> <?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT) ?>
                    <u>STOCKS</u> :</b><br></h1>
        </td>
    </tr>
</table>

<?php $strat_from++; ?>
<table style=" border: 1px; width: 100%">

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
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[7]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>
                    <tr>
                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>
                        </td>
                        <td style="text-align:right;height:25px;">

                            <?php
                            if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                            endif;
//                                              
                            ?>
                        </td>

                        <td style="text-align:right;">
                            <?php
                            if ($actif_1[7]['solde_prec'] >= 0):
                                echo number_format($actif_1[7]['solde_prec'], 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($actif_1[7]['solde_prec']), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
        <td style="text-align: center;">
            <?php
            $total_stock_courant_burt = $actif_1[7]['solde_courant'];
            if ($total_stock_courant_burt >= 0):
                echo number_format($total_stock_courant_burt, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_stock_courant_burt), 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_stock_prec_burt = $actif_1[7]['solde_prec'];
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
    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[8]['param_id']); ?>
    <?php $compte_numero = ''; ?>


    <?php
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>
                    <tr>

                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>
                        </td>
                        <td style="text-align:right;height:25px;">

                            <?php
                            if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                            endif;
//                                              
                            ?>
                        </td>
                        <td style="text-align:right;">
                            <?php if ($actif_1[8]['solde_prec'] >= 0): ?>
                                <?php echo number_format($actif_1[8]['solde_prec'], 3, '.', ' '); ?>
                            <?php else: ?>
                                <?php echo '(' . number_format(abs($actif_1[8]['solde_prec']), 3, '.', ' ') . ')'; ?>
                            <?php endif; ?>
                        </td>

                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
        <td style="text-align: center;">
            <?php
            $total_stock_courant = $actif_1[7]['solde_courant'] - abs($actif_1[8]['solde_courant']);
            if ($total_stock_courant >= 0):
                echo number_format($total_stock_courant, 3, '.', ' ');
            else:
                echo'(' . number_format($total_stock_courant, 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
        <td style="text-align: center;">
            <?php
            $total_stock_prec = $actif_1[7]['solde_prec'] - abs($actif_1[8]['solde_prec']);
            if ($total_stock_prec >= 0):
                echo number_format($total_stock_prec, 3, '.', ' ');
            else:
                echo'(' . number_format($total_stock_prec, 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
    </tr>

</table>
<table class="center">
    <tr>
        <td> 
            <h1> <b> <?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT) ?>
                    <u>Clients et comptes rattachés</u> :</b><br></h1>
        </td>
    </tr>
</table>

<?php $strat_from++; ?>
<table style=" border: 1px; width: 100%">

    <tr style="background-color: #0075b0;" class="table-tr">
        <td style="width:70%;height:25px;">&nbsp;</td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Clients et comptes rattachés</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[9]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>
                    <tr>
                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>
                        </td>
                        <td style="text-align:right;height:25px;">

                            <?php
                            if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                            endif;
//                                              
                            ?>
                        </td>

                        <td style="text-align:right;">
                            <?php
                            if ($actif_1[9]['solde_prec'] >= 0):
                                echo number_format($actif_1[9]['solde_prec'], 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($actif_1[9]['solde_prec']), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
        <td style="text-align: center;">
            <?php
            $total_client_courant_burt = $actif_1[9]['solde_courant'];
            if ($total_client_courant_burt >= 0):
                echo number_format($total_client_courant_burt, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_client_courant_burt), 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_client_prec_burt = $actif_1[9]['solde_prec'];
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
    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[10]['param_id']); ?>
    <?php $compte_numero = ''; ?>


    <?php
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>
                    <tr>

                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>
                        </td>
                        <td style="text-align:right;height:25px;">

                            <?php
                            if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                            endif;
//                                              
                            ?>
                        </td>
                        <td style="text-align:right;">
                            <?php if ($actif_1[10]['solde_prec'] >= 0): ?>
                                <?php echo number_format($actif_1[10]['solde_prec'], 3, '.', ' '); ?>
                            <?php else: ?>
                                <?php echo '(' . number_format(abs($actif_1[10]['solde_prec']), 3, '.', ' ') . ')'; ?>
                            <?php endif; ?>
                        </td>

                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
        <td style="text-align: center;">
            <?php
            $total_client_courant = $actif_1[9]['solde_courant'] - abs($actif_1[10]['solde_courant']);
            if ($total_client_courant >= 0):
                echo number_format($total_client_courant, 3, '.', ' ');
            else:
                echo'(' . number_format($total_client_courant, 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
        <td style="text-align: center;">
            <?php
            $total_client_prec = $actif_1[9]['solde_prec'] - abs($actif_1[10]['solde_prec']);
            if ($total_client_prec >= 0):
                echo number_format($total_client_prec, 3, '.', ' ');
            else:
                echo'(' . number_format($total_client_prec, 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
    </tr>

</table>


<table class="center">
    <tr>
        <td> 
            <h1>   <b> <?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT) ?>
                    <u>Autres actifs courants</u> :</b><br></h1>
        </td>
    </tr>
</table>

<?php $strat_from++; ?>
<table style=" border: 1px; width: 100%">

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
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[11]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>
                    <tr>
                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>
                        </td>
                        <td style="text-align:right;height:25px;">

                            <?php
                            if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                            endif;
//                                              
                            ?>
                        </td>

                        <td style="text-align:right;">
                            <?php
                            if ($actif_1[11]['solde_prec'] >= 0):
                                echo number_format($actif_1[11]['solde_prec'], 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($actif_1[11]['solde_prec']), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
        <td style="text-align: center;">
            <?php
            $total_stock_courant_burt = $actif_1[11]['solde_courant'];
            if ($total_stock_courant_burt >= 0):
                echo number_format($total_stock_courant_burt, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_stock_courant_burt), 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_stock_prec_burt = $actif_1[11]['solde_prec'];
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
    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[12]['param_id']); ?>
    <?php $compte_numero = ''; ?>
    <?php
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>
                    <tr>

                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>
                        </td>
                        <td style="text-align:right;height:25px;">

                            <?php
                            if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                            endif;
//                                              
                            ?>
                        </td>
                        <td style="text-align:right;">
                            <?php if ($actif_1[12]['solde_prec'] >= 0): ?>
                                <?php echo number_format($actif_1[12]['solde_prec'], 3, '.', ' '); ?>
                            <?php else: ?>
                                <?php echo '(' . number_format(abs($actif_1[12]['solde_prec']), 3, '.', ' ') . ')'; ?>
                            <?php endif; ?>
                        </td>

                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
        <td style="text-align: center;">
            <?php
            $total_autre_courant = $actif_1[11]['solde_courant'] - abs($actif_1[12]['solde_courant']);
            if ($total_autre_courant >= 0):
                echo number_format($total_autre_courant, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_autre_courant), 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
        <td style="text-align: center;">
            <?php
            $total_autre_prec = $actif_1[11]['solde_prec'] - abs($actif_1[12]['solde_prec']);
            if ($total_autre_prec >= 0):
                echo number_format($total_autre_prec, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_autre_prec), 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
    </tr>

</table>
<table class="center">
    <tr>
        <td> 
            <h1>       <b> <?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT) ?>
                    <u>Placements et Autres Actifs Financiers</u> :</b><br></h1>
        </td>
    </tr>
</table>

<?php $strat_from++; ?>
<table style=" border: 1px; width: 100%">

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
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[13]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>
                    <tr>
                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>
                        </td>
                        <td style="text-align:right;height:25px;">

                            <?php
                            if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                            endif;
//                                              
                            ?>
                        </td>

                        <td style="text-align:right;">
                            <?php
                            if ($actif_1[13]['solde_prec'] >= 0):
                                echo number_format($actif_1[13]['solde_prec'], 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($actif_1[13]['solde_prec']), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
        <td style="text-align: center;">
            <?php
            $total_stock_courant_burt = $actif_1[13]['solde_courant'];
            if ($total_stock_courant_burt >= 0):
                echo number_format($total_stock_courant_burt, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_stock_courant_burt), 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_stock_prec_burt = $actif_1[13]['solde_prec'];
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
    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[14]['param_id']); ?>
    <?php $compte_numero = ''; ?>
    <?php
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>
                    <tr>

                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>
                        </td>
                        <td style="text-align:right;height:25px;">

                            <?php
                            if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                            endif;
//                                              
                            ?>
                        </td>
                        <td style="text-align:right;">
                            <?php if ($actif_1[14]['solde_prec'] >= 0): ?>
                                <?php echo number_format($actif_1[14]['solde_prec'], 3, '.', ' '); ?>
                            <?php else: ?>
                                <?php echo '(' . number_format(abs($actif_1[14]['solde_prec']), 3, '.', ' ') . ')'; ?>
                            <?php endif; ?>
                        </td>

                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Net</h3></td>
        <td style="text-align: center;">
            <?php
            $total_liqu_courant = $actif_1[13]['solde_courant'] - abs($actif_1[14]['solde_courant']);
            if ($total_liqu_courant >= 0):
                echo number_format($total_liqu_courant, 3, '.', ' ');
            else:
                echo'(' . number_format(abs($total_liqu_courant), 3, '.', ' ') . ')';

            endif;
            ?> 
        </td>
        <td style="text-align: center;">
            <?php
            $total_liqu_prec = $actif_1[13]['solde_prec'] - abs($actif_1[14]['solde_prec']);
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
            $total_actif_courant_courant = $total_stock_courant + $total_client_courant + $total_autre_courant + $actif_1[13]['solde_courant'] + $actif_1[14]['solde_courant'];
            if ($total_actif_courant_courant >= 0):
                echo number_format($total_actif_courant_courant, 3, '.', ' ');
            else:
                echo'(' . number_format($total_actif_courant_courant, 3, '.', ' ') . ')';

            endif;
            ?>
        </td>
        <td style="text-align: center;">
            <?php
            $total_actif_courant_prec = $total_stock_prec + $total_client_prec + $total_autre_prec + $actif_1[13]['solde_prec'] + $actif_1[14]['solde_prec'];
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
<!--capitaux propres -->
<table class="center">
    <tr>
        <td> <h1>CAPITAUX PROPRES ET PASSIFS</h1>
            <h1><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?>
                <u>Capitaux propres </u> :
                <?php $strat_from++; ?>
            </h1>
        </td>
    </tr>
</table>
<table style=" border: 1px; width: 100%">

    <tr style="background-color: #0075b0;" class="table-tr">
        <td style="width:70%;height:25px;">&nbsp;</td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Subventions d'investissements amortissables</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    $passif = calculParametrebilan::getBilan(1);
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[0][0]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>
                    <?php if ($param_compte->getRegrouppement() == '' || $param_compte->getRegrouppement() == null): ?>
                        <tr>
                            <td>
                                <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>

                            </td>
                            <td style="text-align:right;height:25px;">

                                <?php
                                if ((-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde()) >= 0):
                                    echo number_format(-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                else:
                                    echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';

                                endif;
//                                                endif;
                                ?>
                            </td>
                            <td style="text-align:right;">
                                <?php
                                if (-$passif[0][0]['solde_prec'] >= 0):
                                    echo number_format(-$passif[0][0]['solde_prec'], 3, '.', ' ');
                                elseif (-$passif[0][0]['solde_prec'] < 0):
                                    echo '(' . number_format(abs(-$passif[0][0]['solde_prec']), 3, '.', ' ') . ')';

                                endif;
                                ?>

                            </td>

                        </tr>
                    <?php else: ?>
                        <tr>
                            <td>
                                <?php echo trim($param_compte->getRegroupement()); ?>

                            </td>
                            <td style="text-align:right;height:25px;">

                                <?php
                                if (-$passif[1][0]['solde_courant'] >= 0):
                                    echo number_format(-$passif[1][0]['solde_courant'], 3, '.', ' ');
                                elseif (-$passif[1][0]['solde_courant'] < 0):
                                    echo '(' . number_format(abs(-$passif[1][0]['solde_courant']), 3, '.', ' ') . ')';

                                endif;
                                ?>
                            </td>
                            <td style="text-align:right;">
                                <?php
                                if (-$passif[0][0]['solde_prec'] >= 0):
                                    echo number_format(-$passif[0][0]['solde_prec'], 3, '.', ' ');
                                elseif (-$passif[0][0]['solde_prec'] < 0):
                                    echo '(' . number_format(abs(-$passif[0][0]['solde_prec']), 3, '.', ' ') . ')';

                                endif;
                                ?>

                            </td>

                        </tr>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <tr>
        <td style="height:25px;"><h3>Subventions d'investissements non amortissables</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    $passif = calculParametrebilan::getBilan(1);
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[1]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>

                    <tr>
                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>

                        </td>
                        <td style="text-align:right;height:25px;">
                            <?php
                            $solde_courant = $param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde();
                            ?>
                            <?php
                            if ((-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde()) >= 0):
                                echo number_format(-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';

                            endif;
//                                                endif;
                            ?>
                        </td>
                        <td style="text-align:right;">
                            <?php
                            if (-$passif[1]['solde_prec'] >= 0):
                                echo number_format(-$passif[0]['solde_prec'], 3, '.', ' ');
                            elseif (-$passif[1]['solde_prec'] < 0):
                                echo '(' . number_format(abs(-$passif[1]['solde_prec']), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>

                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <tr>

        <td style="height:25px;"><h3>Subvention à affecter</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    $passif = calculParametrebilan::getBilan(1);
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[2]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>

                    <tr>
                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>

                        </td>
                        <td style="text-align:right;height:25px;">
                            <?php
                            $solde_courant = $param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde();
                            ?>
                            <?php
                            if ((-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde()) >= 0):
                                echo number_format(-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';

                            endif;
//                                                endif;
                            ?>
                        </td>
                        <td style="text-align:right;">
                            <?php
                            if (-$passif[2]['solde_prec'] >= 0):
                                echo number_format(-$passif[0]['solde_prec'], 3, '.', ' ');
                            elseif (-$passif[2]['solde_prec'] < 0):
                                echo '(' . number_format(abs(-$passif[2]['solde_prec']), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>

                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>


    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
        <td style="text-align: center;">
            <?php
            $total_avant_courant = -$passif[0]['solde_courant'] - $passif[1]['solde_courant'] + abs($passif[2]['solde_courant']);
            if ($total_avant_courant >= 0):
                echo number_format($total_avant_courant, 3, '.', ' ');
            elseif ($total_avant_courant < 0):
                echo '(' . number_format(abs($total_avant_courant), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align:right">
            <?php
            $total_avant_prec = -$passif[0]['solde_prec'] - $passif[1]['solde_prec'] + abs($passif[2]['solde_prec']);
            if ($total_avant_prec >= 0):
                echo number_format($total_avant_prec, 3, '.', ' ');
            else:
                echo'(' . number_format($total_avant_prec, 3, '.', ' ') . ')';

            endif;
            ?>    
        </td>
    </tr>

    <tr>
        <td style="height:25px;"><h3>Résultat de l'exercice</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    $passif = calculParametrebilan::getBilan(1);
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[3]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>

                    <tr>
                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>

                        </td>
                        <td style="text-align:right;height:25px;">
                            <?php
                            $solde_courant = $param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde();
                            ?>
                            <?php
                            if ((-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde()) >= 0):
                                echo number_format(-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';

                            endif;
//                                                endif;
                            ?>
                        </td>
                        <td style="text-align:right;">
                            <?php
                            if (-$passif[3]['solde_prec'] >= 0):
                                echo number_format(-$passif[0]['solde_prec'], 3, '.', ' ');
                            elseif (-$passif[3]['solde_prec'] < 0):
                                echo '(' . number_format(abs(-$passif[3]['solde_prec']), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>

                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"> <h3>TOTAL CAPITAUX PROPRES</h3></td>
        <td style="text-align: center;">
            <?php
            $total_avant_courant = -$passif[0]['solde_courant'] - $passif[1]['solde_courant'] + abs($passif[2]['solde_courant']);

            $total_propre_courant = -($total_avant_courant + $passif[3]['solde_courant']);
            if ($total_propre_courant >= 0):
                echo number_format($total_propre_courant, 3, '.', ' ');
            elseif ($total_propre_courant < 0):
                echo '(' . number_format(abs($total_propre_courant), 3, '.', ' ') . ')';
            endif;
            ?> 
        </td>
        <td style="text-align:right">


            <?php
            $total_avant_prec = -$passif[0]['solde_prec'] - $passif[1]['solde_prec'] + abs($passif[2]['solde_prec']);

            $total_propre_prec = -($total_avant_prec + $passif[3]['solde_prec']);
            if ($total_propre_prec >= 0):
                echo number_format($total_propre_prec, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_propre_prec), 3, '.', ' ' . ')');
            endif;
            ?>
        </td>
    </tr>

</table>
<!--passif-->
<table class="center">
    <tr>
        <td> <h1>PASSIFS</h1>
            <h1><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?>
                <u>Passifs non courants</u> :
                <?php $strat_from++; ?>
            </h1>
        </td>
    </tr>
</table>
<table style=" border: 1px; width: 100%">

    <tr style="background-color: #0075b0;" class="table-tr">
        <td style="width:70%;height:25px;">&nbsp;</td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Provisions</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    $passif = calculParametrebilan::getBilan(1);
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[4]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>

                    <tr>
                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>

                        </td>
                        <td style="text-align:right;height:25px;">

                            <?php
                            if ((-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde()) >= 0):
                                echo number_format(-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';

                            endif;
//                                                endif;
                            ?>
                        </td>
                        <td style="text-align:right;">
                            <?php
                            if (-$passif[4]['solde_prec'] >= 0):
                                echo number_format(-$passif[0]['solde_prec'], 3, '.', ' ');
                            elseif (-$passif[4]['solde_prec'] < 0):
                                echo '(' . number_format(abs(-$passif[4]['solde_prec']), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>

                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total passifs non courants</h3></td>
        <td style="text-align: center;">
            <?php
            $total_non_courant_courant = -$passif[4]['solde_courant'];
            if ($total_non_courant_courant >= 0):
                echo number_format($total_non_courant_courant, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_non_courant_courant), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align:right">
            <?php
            $total_non_courant_prec = -$passif[4]['solde_prec'];
            if ($total_non_courant_prec >= 0):
                echo number_format($total_non_courant_prec, 3, '.', ' ');
            else:
                echo'(' . number_format($total_non_courant_prec, 3, '.', ' ') . ')';

            endif;
            ?>    
        </td>
    </tr>

    <tr>
        <td style="height:25px;"><h3>Passifs courants</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Fournisseurs et comptes rattachés</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    $passif = calculParametrebilan::getBilan(1);
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[5]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>

                    <tr>
                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>

                        </td>
                        <td style="text-align:right;height:25px;">
                            <?php
                            $solde_courant = $param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde();
                            ?>
                            <?php
                            if ((-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde()) >= 0):
                                echo number_format(-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';

                            endif;
//                                                endif;
                            ?>
                        </td>
                        <td style="text-align:right;">
                            <?php
                            if (-$passif[5]['solde_prec'] >= 0):
                                echo number_format(-$passif[0]['solde_prec'], 3, '.', ' ');
                            elseif (-$passif[5]['solde_prec'] < 0):
                                echo '(' . number_format(abs(-$passif[5]['solde_prec']), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>

                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <tr>
        <td style="height:25px;"><h3>Autres passifs Courants</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    $passif = calculParametrebilan::getBilan(1);
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[6]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>

                    <tr>
                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>

                        </td>
                        <td style="text-align:right;height:25px;">
                            <?php
                            $solde_courant = $param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde();
                            ?>
                            <?php
                            if ((-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde()) >= 0):
                                echo number_format(-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';

                            endif;
//                                                endif;
                            ?>
                        </td>
                        <td style="text-align:right;">
                            <?php
                            if (-$passif[6]['solde_prec'] >= 0):
                                echo number_format(-$passif[0]['solde_prec'], 3, '.', ' ');
                            elseif (-$passif[6]['solde_prec'] < 0):
                                echo '(' . number_format(abs(-$passif[6]['solde_prec']), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>

                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"> <h3>Total passifs courants</h3></td>
        <td style="text-align: center;">
            <?php
            $total_courant_courant = -($passif[5]['solde_courant'] + $passif[6]['solde_courant']);
            if ($total_courant_courant >= 0):
                echo number_format($total_courant_courant, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_courant_courant), 3, '.', ' ') . ')';
            endif;
            ?> 
        </td>
        <td style="text-align:right">


            <?php
            $total_courant_prec = ($passif[5]['solde_prec'] + $passif[6]['solde_prec']);
            if ($total_courant_prec >= 0):
                echo number_format($total_courant_prec, 3, '.', ' ');
            else:
                echo '(' . number_format($total_courant_prec, 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
    </tr>
<!--                        <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"> <h3>TOTAL DES PASSIFS</h3></td>
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
        <td style="text-align:right">


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
    <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"> <h3>TOTAL DES CAPITAUX PROPRES ET PASSIFS</h3></td>
        <td style="text-align: center;">
    <?php
    $total_courant = -(-$total_passif_courant + $total_propre_courant);
    if ($total_courant >= 0):
        echo number_format($total_courant, 3, '.', ' ');
    else:
        echo '(' . number_format(abs($total_courant), 3, '.', ' ') . ')';
    endif;
    ?> 
        </td>
        <td style="text-align:right">


    <?php
    $total_prec = ($total_passif_prec + $total_propre_prec);
    if ($total_prec >= 0):
        echo number_format($total_prec, 3, '.', ' ');
    else:
        echo '(' . number_format(abs($total_prec), 3, '.', ' ') . ')';
    endif;
    ?>
        </td>
    </tr>-->
</table>
<!--capitaux propres -->
<table class="center">
    <tr>
        <td> <h1>CAPITAUX PROPRES ET PASSIFS</h1>
            <h1><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?>
                <u>Capitaux propres </u> :
                <?php $strat_from++; ?>
            </h1>
        </td>
    </tr>
</table>
<table style=" border: 1px; width: 100%">

    <tr style="background-color: #0075b0;" class="table-tr">
        <td style="width:70%;height:25px;">&nbsp;</td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Subventions d'investissements amortissables</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    $passif = calculParametrebilan::getBilan(1);
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[0]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>

                    <tr>
                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>

                        </td>
                        <td style="text-align:right;height:25px;">

                            <?php
                            if ((-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde()) >= 0):
                                echo number_format(-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';

                            endif;
//                                                endif;
                            ?>
                        </td>
                        <td style="text-align:right;">
                            <?php
                            if (-$passif[0]['solde_prec'] >= 0):
                                echo number_format(-$passif[0]['solde_prec'], 3, '.', ' ');
                            elseif (-$passif[0]['solde_prec'] < 0):
                                echo '(' . number_format(abs(-$passif[0]['solde_prec']), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>

                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <tr>
        <td style="height:25px;"><h3>Subventions d'investissements non amortissables</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    $passif = calculParametrebilan::getBilan(1);
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[1]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>

                    <tr>
                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>

                        </td>
                        <td style="text-align:right;height:25px;">
                            <?php
                            $solde_courant = $param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde();
                            ?>
                            <?php
                            if ((-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde()) >= 0):
                                echo number_format(-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';

                            endif;
//                                                endif;
                            ?>
                        </td>
                        <td style="text-align:right;">
                            <?php
                            if (-$passif[1]['solde_prec'] >= 0):
                                echo number_format(-$passif[0]['solde_prec'], 3, '.', ' ');
                            elseif (-$passif[1]['solde_prec'] < 0):
                                echo '(' . number_format(abs(-$passif[1]['solde_prec']), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>

                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <tr>

        <td style="height:25px;"><h3>Subvention à affecter</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    $passif = calculParametrebilan::getBilan(1);
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[2]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>

                    <tr>
                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>

                        </td>
                        <td style="text-align:right;height:25px;">
                            <?php
                            $solde_courant = $param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde();
                            ?>
                            <?php
                            if ((-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde()) >= 0):
                                echo number_format(-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';

                            endif;
//                                                endif;
                            ?>
                        </td>
                        <td style="text-align:right;">
                            <?php
                            if (-$passif[2]['solde_prec'] >= 0):
                                echo number_format(-$passif[0]['solde_prec'], 3, '.', ' ');
                            elseif (-$passif[2]['solde_prec'] < 0):
                                echo '(' . number_format(abs(-$passif[2]['solde_prec']), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>

                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>


    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total Brut</h3></td>
        <td style="text-align: center;">
            <?php
            $total_avant_courant = -$passif[0]['solde_courant'] - $passif[1]['solde_courant'] + abs($passif[2]['solde_courant']);
            if ($total_avant_courant >= 0):
                echo number_format($total_avant_courant, 3, '.', ' ');
            elseif ($total_avant_courant < 0):
                echo '(' . number_format(abs($total_avant_courant), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align:right">
            <?php
            $total_avant_prec = -$passif[0]['solde_prec'] - $passif[1]['solde_prec'] + abs($passif[2]['solde_prec']);
            if ($total_avant_prec >= 0):
                echo number_format($total_avant_prec, 3, '.', ' ');
            else:
                echo'(' . number_format($total_avant_prec, 3, '.', ' ') . ')';

            endif;
            ?>    
        </td>
    </tr>

    <tr>
        <td style="height:25px;"><h3>Résultat de l'exercice</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    $passif = calculParametrebilan::getBilan(1);
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[3]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>

                    <tr>
                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>

                        </td>
                        <td style="text-align:right;height:25px;">
                            <?php
                            $solde_courant = $param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde();
                            ?>
                            <?php
                            if ((-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde()) >= 0):
                                echo number_format(-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';

                            endif;
//                                                endif;
                            ?>
                        </td>
                        <td style="text-align:right;">
                            <?php
                            if (-$passif[3]['solde_prec'] >= 0):
                                echo number_format(-$passif[0]['solde_prec'], 3, '.', ' ');
                            elseif (-$passif[3]['solde_prec'] < 0):
                                echo '(' . number_format(abs(-$passif[3]['solde_prec']), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>

                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"> <h3>TOTAL CAPITAUX PROPRES</h3></td>
        <td style="text-align: center;">
            <?php
            $total_avant_courant = -$passif[0]['solde_courant'] - $passif[1]['solde_courant'] + abs($passif[2]['solde_courant']);

            $total_propre_courant = -($total_avant_courant + $passif[3]['solde_courant']);
            if ($total_propre_courant >= 0):
                echo number_format($total_propre_courant, 3, '.', ' ');
            elseif ($total_propre_courant < 0):
                echo '(' . number_format(abs($total_propre_courant), 3, '.', ' ') . ')';
            endif;
            ?> 
        </td>
        <td style="text-align:right">


            <?php
            $total_avant_prec = -$passif[0]['solde_prec'] - $passif[1]['solde_prec'] + abs($passif[2]['solde_prec']);

            $total_propre_prec = -($total_avant_prec + $passif[3]['solde_prec']);
            if ($total_propre_prec >= 0):
                echo number_format($total_propre_prec, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_propre_prec), 3, '.', ' ' . ')');
            endif;
            ?>
        </td>
    </tr>

</table>
<!--passif-->
<table class="center">
    <tr>
        <td> <h1>PASSIFS</h1>
            <h1><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?>
                <u>Passifs non courants</u> :
                <?php $strat_from++; ?>
            </h1>
        </td>
    </tr>
</table>
<table style=" border: 1px; width: 100%">

    <tr style="background-color: #0075b0;" class="table-tr">
        <td style="width:70%;height:25px;">&nbsp;</td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] ?> </td>
        <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $ancien_exercice ?> </td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Provisions</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    $passif = calculParametrebilan::getBilan(1);
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[4]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>

                    <tr>
                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>

                        </td>
                        <td style="text-align:right;height:25px;">

                            <?php
                            if ((-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde()) >= 0):
                                echo number_format(-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';

                            endif;
//                                                endif;
                            ?>
                        </td>
                        <td style="text-align:right;">
                            <?php
                            if (-$passif[4]['solde_prec'] >= 0):
                                echo number_format(-$passif[0]['solde_prec'], 3, '.', ' ');
                            elseif (-$passif[4]['solde_prec'] < 0):
                                echo '(' . number_format(abs(-$passif[4]['solde_prec']), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>

                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <tr>
        <td style="text-align:center;font-weight:bold;height:25px;"><h3>Total passifs non courants</h3></td>
        <td style="text-align: center;">
            <?php
            $total_non_courant_courant = -$passif[4]['solde_courant'];
            if ($total_non_courant_courant >= 0):
                echo number_format($total_non_courant_courant, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_non_courant_courant), 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
        <td style="text-align:right">
            <?php
            $total_non_courant_prec = -$passif[4]['solde_prec'];
            if ($total_non_courant_prec >= 0):
                echo number_format($total_non_courant_prec, 3, '.', ' ');
            else:
                echo'(' . number_format($total_non_courant_prec, 3, '.', ' ') . ')';

            endif;
            ?>    
        </td>
    </tr>

    <tr>
        <td style="height:25px;"><h3>Passifs courants</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <tr>
        <td style="height:25px;"><h3>Fournisseurs et comptes rattachés</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    $passif = calculParametrebilan::getBilan(1);
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[5]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>

                    <tr>
                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>

                        </td>
                        <td style="text-align:right;height:25px;">
                            <?php
                            $solde_courant = $param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde();
                            ?>
                            <?php
                            if ((-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde()) >= 0):
                                echo number_format(-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';

                            endif;
//                                                endif;
                            ?>
                        </td>
                        <td style="text-align:right;">
                            <?php
                            if (-$passif[5]['solde_prec'] >= 0):
                                echo number_format(-$passif[0]['solde_prec'], 3, '.', ' ');
                            elseif (-$passif[5]['solde_prec'] < 0):
                                echo '(' . number_format(abs(-$passif[5]['solde_prec']), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>

                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <tr>
        <td style="height:25px;"><h3>Autres passifs Courants</h3></td>
        <td style="text-align:right"></td>
        <td style="text-align:right"></td>
    </tr>
    <?php
    $passif = calculParametrebilan::getBilan(1);
    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[6]['param_id']);
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1):
            ?>
            <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                <?php if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>

                    <tr>
                        <td>
                            <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>

                        </td>
                        <td style="text-align:right;height:25px;">
                            <?php
                            $solde_courant = $param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde();
                            ?>
                            <?php
                            if ((-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde()) >= 0):
                                echo number_format(-$param_compte->getPlandossiercomptable()->getSolde() - $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                            else:
                                echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';

                            endif;
//                                                endif;
                            ?>
                        </td>
                        <td style="text-align:right;">
                            <?php
                            if (-$passif[6]['solde_prec'] >= 0):
                                echo number_format(-$passif[0]['solde_prec'], 3, '.', ' ');
                            elseif (-$passif[6]['solde_prec'] < 0):
                                echo '(' . number_format(abs(-$passif[6]['solde_prec']), 3, '.', ' ') . ')';

                            endif;
                            ?>

                        </td>

                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"> <h3>Total passifs courants</h3></td>
        <td style="text-align: center;">
            <?php
            $total_courant_courant = -($passif[5]['solde_courant'] + $passif[6]['solde_courant']);
            if ($total_courant_courant >= 0):
                echo number_format($total_courant_courant, 3, '.', ' ');
            else:
                echo '(' . number_format(abs($total_courant_courant), 3, '.', ' ') . ')';
            endif;
            ?> 
        </td>
        <td style="text-align:right">


            <?php
            $total_courant_prec = ($passif[5]['solde_prec'] + $passif[6]['solde_prec']);
            if ($total_courant_prec >= 0):
                echo number_format($total_courant_prec, 3, '.', ' ');
            else:
                echo '(' . number_format($total_courant_prec, 3, '.', ' ') . ')';
            endif;
            ?>
        </td>
    </tr>
<!--                        <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"> <h3>TOTAL DES PASSIFS</h3></td>
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
        <td style="text-align:right">


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
    <tr style="background-color:#F3F3F3;">
        <td style="text-align:center;font-weight:bold;height:25px;"> <h3>TOTAL DES CAPITAUX PROPRES ET PASSIFS</h3></td>
        <td style="text-align: center;">
    <?php
    $total_courant = -(-$total_passif_courant + $total_propre_courant);
    if ($total_courant >= 0):
        echo number_format($total_courant, 3, '.', ' ');
    else:
        echo '(' . number_format(abs($total_courant), 3, '.', ' ') . ')';
    endif;
    ?> 
        </td>
        <td style="text-align:right">


    <?php
    $total_prec = ($total_passif_prec + $total_propre_prec);
    if ($total_prec >= 0):
        echo number_format($total_prec, 3, '.', ' ');
    else:
        echo '(' . number_format(abs($total_prec), 3, '.', ' ') . ')';
    endif;
    ?>
        </td>
    </tr>-->
</table>