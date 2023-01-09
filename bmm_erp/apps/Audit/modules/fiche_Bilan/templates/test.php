<!--                <tr>
                    <td style="padding-left: 4%;">Autres gains ordinaires</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                <?php if ($sig[13]['param_id'] != ''): ?>
                    <?php
                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[13]['param_id']);
                    $compte_numero = '';
                    foreach ($params as $param_compte):
                        $numero = $param_compte->getPlandossiercomptable()->getNumerocompte();
                        if ($param_compte->getType() == 1)
                            $numero = '<b>' . $numero . '</b>';
                        if ($compte_numero == '') {
                            $compte_numero = $numero;
                        } else {
                            $compte_numero = $compte_numero . ' + ' . $param_compte->getPlandossiercomptable()->getNumerocompte();
                        }
                    endforeach;
                    ?>
                                <span class="btn btn-info btn-sm popover-info" data-rel="popover" data-placement="bottom" title="Comptes Comptables (Numéro) :" data-content="<?php echo $compte_numero; ?>">Comptes Comptables</span>
                <?php endif; ?>
                    </td>
                    <td style="text-align: center;">
                <?php
                if ($sig[13]['solde_courant'] != 0)
                    echo number_format($sig[13]['solde_courant'], 3, '.', ' ');
                ?>
                    </td>
                    <td style="text-align: center;">
                <?php
                if ($sig[13]['solde_prec'] != 0)
                    echo number_format($sig[13]['solde_prec'], 3, '.', ' ');
                ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Autres pertes ordinaires</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                <?php if ($sig[14]['param_id'] != ''): ?>
                    <?php
                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[14]['param_id']);
                    $compte_numero = '';
                    foreach ($params as $param_compte):
                        $numero = $param_compte->getPlandossiercomptable()->getNumerocompte();
                        if ($param_compte->getType() == 1)
                            $numero = '<b>' . $numero . '</b>';
                        if ($compte_numero == '') {
                            $compte_numero = $numero;
                        } else {
                            $compte_numero = $compte_numero . ' + ' . $param_compte->getPlandossiercomptable()->getNumerocompte();
                        }
                    endforeach;
                    ?>
                                <span class="btn btn-info btn-sm popover-info" data-rel="popover" data-placement="bottom" title="Comptes Comptables (Numéro) :" data-content="<?php echo $compte_numero; ?>">Comptes Comptables</span>
                <?php endif; ?>
                    </td>
                    <td style="text-align: center;">
                <?php
                if ($sig[14]['solde_courant'] != 0)
                    echo number_format($sig[14]['solde_courant'], 3, '.', ' ');
                ?>
                    </td>
                    <td style="text-align: center;">
                <?php
                if ($sig[14]['solde_prec'] != 0)
                    echo number_format($sig[14]['solde_prec'], 3, '.', ' ');
                ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Transfert et reprise de charges</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                <?php if ($sig[15]['param_id'] != ''): ?>
                    <?php
                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[15]['param_id']);
                    $compte_numero = '';
                    foreach ($params as $param_compte):
                        $numero = $param_compte->getPlandossiercomptable()->getNumerocompte();
                        if ($param_compte->getType() == 1)
                            $numero = '<b>' . $numero . '</b>';
                        if ($compte_numero == '') {
                            $compte_numero = $numero;
                        } else {
                            $compte_numero = $compte_numero . ' + ' . $param_compte->getPlandossiercomptable()->getNumerocompte();
                        }
                    endforeach;
                    ?>
                                <span class="btn btn-info btn-sm popover-info" data-rel="popover" data-placement="bottom" title="Comptes Comptables (Numéro) :" data-content="<?php echo $compte_numero; ?>">Comptes Comptables</span>
                <?php endif; ?>
                    </td>
                    <td style="text-align: center;">
                <?php
//                if ($sig[15]['solde_courant'] != 0)
//                    echo number_format($sig[15]['solde_courant'], 3, '.', ' ');
                ?>
                    </td>
                    <td style="text-align: center;">
                <?php
//                if ($sig[15]['solde_prec'] != 0)
//                    echo number_format($sig[15]['solde_prec'], 3, '.', ' ');
                ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Dotation aux amortissements et aux provisions</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                <?php if ($sig[16]['param_id'] != ''): ?>
                    <?php
//                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[16]['param_id']);
//                    $compte_numero = '';
//                    foreach ($params as $param_compte):
//                        $numero = $param_compte->getPlandossiercomptable()->getNumerocompte();
//                        if ($param_compte->getType() == 1)
//                            $numero = '<b>' . $numero . '</b>';
//                        if ($compte_numero == '') {
//                            $compte_numero = $numero;
//                        } else {
//                            $compte_numero = $compte_numero . ' + ' . $param_compte->getPlandossiercomptable()->getNumerocompte();
//                        }
//                    endforeach;
                    ?>
                                <span class="btn btn-info btn-sm popover-info" data-rel="popover" data-placement="bottom" title="Comptes Comptables (Numéro) :" data-content="<?php echo $compte_numero; ?>">Comptes Comptables</span>
                <?php endif; ?>
                    </td>
                    <td style="text-align: center;">
                <?php
//                if ($sig[16]['solde_courant'] != 0)
//                    echo number_format($sig[16]['solde_courant'], 3, '.', ' ');
                ?>
                    </td>
                    <td style="text-align: center;">
                <?php
//                if ($sig[16]['solde_prec'] != 0)
//                    echo number_format($sig[16]['solde_prec'], 3, '.', ' ');
                ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Impôt sur le résultat ordinaire</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                <?php if ($sig[17]['param_id'] != ''): ?>
                    <?php
                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[17]['param_id']);
                    $compte_numero = '';
                    foreach ($params as $param_compte):
                        $numero = $param_compte->getPlandossiercomptable()->getNumerocompte();
                        if ($param_compte->getType() == 1)
                            $numero = '<b>' . $numero . '</b>';
                        if ($compte_numero == '') {
                            $compte_numero = $numero;
                        } else {
                            $compte_numero = $compte_numero . ' + ' . $param_compte->getPlandossiercomptable()->getNumerocompte();
                        }
                    endforeach;
                    ?>
                                <span class="btn btn-info btn-sm popover-info" data-rel="popover" data-placement="bottom" title="Comptes Comptables (Numéro) :" data-content="<?php echo $compte_numero; ?>">Comptes Comptables</span>
                <?php endif; ?>
                    </td>
                    <td style="text-align: center;">
                <?php
//                if ($sig[17]['solde_courant'] != 0)
//                    echo number_format($sig[17]['solde_courant'], 3, '.', ' ');
                ?>
                    </td>
                    <td style="text-align: center;">
                <?php
//                if ($sig[17]['solde_prec'] != 0)
//                    echo number_format($sig[17]['solde_prec'], 3, '.', ' ');
                ?>
                    </td>
                </tr>

                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;">RESULTAT DES ACTIVITES ORDINAIRES</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                <?php
//                $total_ordinaire_courant = $total_exedent_courant + $sig[13]['solde_courant'] - $sig[11]['solde_courant'] - $sig[12]['solde_courant'] - $sig[14]['solde_courant'] - $sig[15]['solde_courant'] - $sig[16]['solde_courant'] - $sig[17]['solde_courant'];
//                if ($total_ordinaire_courant != 0)
//                    echo number_format($total_ordinaire_courant, 3, '.', ' ');
                ?>
                    </td>
                    <td style="text-align: center;">
                <?php
//                $total_ordinaire_prec = $total_exedent_prec + $sig[13]['solde_prec'] - $sig[11]['solde_prec'] - $sig[12]['solde_prec'] - $sig[14]['solde_prec'] - $sig[15]['solde_prec'] - $sig[16]['solde_prec'] - $sig[17]['solde_prec'];
//                if ($total_ordinaire_prec != 0)
//                    echo number_format($total_ordinaire_prec, 3, '.', ' ');
                ?>
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 4%;">Eléments extraordinaires net d'impôt</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                <?php if ($sig[18]['param_id'] != ''): ?>
                    <?php
//                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[18]['param_id']);
//                    $compte_numero = '';
//                    foreach ($params as $param_compte):
//                        $numero = $param_compte->getPlandossiercomptable()->getNumerocompte();
//                        if ($param_compte->getType() == 1)
//                            $numero = '<b>' . $numero . '</b>';
//                        if ($compte_numero == '') {
//                            $compte_numero = $numero;
//                        } else {
//                            $compte_numero = $compte_numero . ' + ' . $param_compte->getPlandossiercomptable()->getNumerocompte();
//                        }
//                    endforeach;
                    ?>
                                <span class="btn btn-info btn-sm popover-info" data-rel="popover" data-placement="bottom" title="Comptes Comptables (Numéro) :" data-content="<?php echo $compte_numero; ?>">Comptes Comptables</span>
                <?php endif; ?>
                    </td>
                    <td style="text-align: center;">
                <?php //
                if ($sig[18]['solde_courant'] != 0)
                    echo number_format($sig[18]['solde_courant'], 3, '.', ' ');
                ?>
                    </td>
                    <td style="text-align: center;">
                <?php
//                if ($sig[18]['solde_prec'] != 0)
//                    echo number_format($sig[18]['solde_prec'], 3, '.', ' ');
                ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 4%;">Effets des modifications comptables net d'impôt</td>
                    <td style="text-align: center;">
                        <input value="" type="hidden" name="note_4">
                <?php if ($sig[19]['param_id'] != ''): ?>
                    <?php
//                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($sig[19]['param_id']);
//                    $compte_numero = '';
//                    foreach ($params as $param_compte):
//                        $numero = $param_compte->getPlandossiercomptable()->getNumerocompte();
//                        if ($param_compte->getType() == 1)
//                            $numero = '<b>' . $numero . '</b>';
//                        if ($compte_numero == '') {
//                            $compte_numero = $numero;
//                        } else {
//                            $compte_numero = $compte_numero . ' + ' . $param_compte->getPlandossiercomptable()->getNumerocompte();
//                        }
//                    endforeach;
                    ?>
                                <span class="btn btn-info btn-sm popover-info" data-rel="popover" data-placement="bottom" title="Comptes Comptables (Numéro) :" data-content="<?php echo $compte_numero; ?>">Comptes Comptables</span>
                <?php endif; ?>
                    </td>
                    <td style="text-align: center;">
                <?php
//                if ($sig[19]['solde_courant'] != 0)
//                    echo number_format($sig[19]['solde_courant'], 3, '.', ' ');
                ?>
                    </td>
                    <td style="text-align: center;">
                <?php
//                if ($sig[19]['solde_prec'] != 0)
//                    echo number_format($sig[19]['solde_prec'], 3, '.', ' ');
                ?>
                    </td>
                </tr>

                <tr style="background-color: #D5D5D5;">
                    <td style="padding-left: 2%;" colspan="2">Résultat net après modifications comptables</td>
                    <td style="text-align: center;">
                <?php
//                $total_net_courant = $total_ordinaire_courant + $sig[18]['solde_courant'] + $sig[19]['solde_courant'];
//                if ($total_net_courant != 0)
//                    echo number_format($total_net_courant, 3, '.', ' ');
                ?>
                    </td>
                    <td style="text-align: center;">
                <?php
//                $total_net_prec = $total_ordinaire_prec + $sig[18]['solde_prec'] + $sig[19]['solde_prec'];
//                if ($total_net_prec != 0)
//                    echo number_format($total_net_prec, 3, '.', ' ');
                ?>
                    </td>
                </tr>-->

<div class="mws-panel grid_8">
    <div class="mws-panel-body no-padding">
        <form class="mws-form">
            <div class="mws-form-inline">
                <legend>Paramétrage : Notes aux Etats Financiers</legend>
                <?php $param = ParametrenoteTable::getInstance()->findByIdDossier($_SESSION['dossier_id'])->getFirst(); ?>
                <div class="wysiwyg-editor" id="editor1">
                    <?php if ($param != null): ?>
                        <?php echo $param->getContenue(); ?>
                    <?php endif; ?>

                    <h3 class="center"> \\ NOTES AU BILAN //</h3>
                    <?php
                    $annee_prec = $_SESSION['exercice'] - 1;
                    $exerice_prec = ExerciceTable::getInstance()->findOneByLibelle($annee_prec);
                    if (sizeof($exerice_prec) > 1)
                        $id_exercice_prece = $exerice_prec->getId();
                    $strat_from = 1;
                    $actif_1 = calculParametrebilan::getBilan(0);
                    $passif = calculParametrebilan::getBilan(1);
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

                        if ($actif_1[1][0]['param_id'] != ''):
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][0]['param_id']);
//                            $params_prec = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[0][0]['param_id']);

                            foreach ($params as $param_compte):
                                if ($param_compte->getType() == 1):
                                    ?>
                                    <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                                        <?php if ($param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>

                                            <tr>
                                                <td>

                                                    <?php echo trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>

                                                </td>
                                                <td style="text-align:right;height:25px;">
                                                    <?php
                                                    $solde_prece = $param_compte->getPlandossiercomptable()->getSoldeouv();

                                                    $solde_courant = $param_compte->getPlandossiercomptable()->getSolde();
                                                    ?>
                                                    <?php
                                                    if ($param_compte->getPlandossiercomptable()->getSolde() >= 0 || $param_compte->getPlandossiercomptable()->getTypesolde() == 1):
                                                        echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                                    elseif ($param_compte->getPlandossiercomptable()->getSolde() < 0 || $param_compte->getPlandossiercomptable()->getTypesolde() == 2):
                                                        echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                                    endif;
                                                    ?>
                                                </td>
                                                <td style="text-align:right;">
                                                    <?php
                                                    if ($param_compte->getPlandossiercomptable()->getSoldeouv() >= 0):
                                                        echo number_format($param_compte->getPlandossiercomptable()->getSoldeouv(), 3, '.', ' ');
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
                                    $total_incorporel_courant = $actif_1[1][0]['solde_courant'];
                                    if ($total_incorporel_courant >= 0):
                                        echo number_format($total_incorporel_courant, 3, '.', ' ');
                                    else:
                                        echo'(' . number_format($total_incorporel_courant, 3, '.', ' ') . ')';
                                    endif;
                                    ?>
                                </td>
                                <td style="text-align: center">
                                    <?php
                                    $total_incorporel_prec = $actif_1[0][0]['solde_prec'];
                                    if ($total_incorporel_prec >= 0):
                                        echo number_format($total_incorporel_prec, 3, '.', ' ');
                                    else:
                                        echo'(' . number_format($total_incorporel_prec, 3, '.', ' ') . ')';
                                    endif;
                                    ?>    
                                </td>
                            </tr>

                            <?php if ($actif_1[1][1]['param_id'] != ''): ?>
                                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][1]['param_id']); ?>
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
                                    <td style="height:25px;"><h3>Amortissement<?php echo $actif_1[1][1]['param_id'] ?></h3></td>
                                    <td style="text-align:right"></td>
                                    <td style="text-align:right"></td>
                                </tr>
                                <?php
                                foreach ($params as $param_compte):
                                    if ($param_compte->getType() == 1):
                                        ?>
                                        <?php if ((trim($param_compte->getPlandossiercomptable()->getNumerocompte() >= 1000000))): ?>
                                            <?php if ($param_compte->getPlandossiercomptable()->getSolde() != 0) : ?>


                                                <tr>
                                                    <td> <?php echo $numero . ' - ' . $libelle; ?>

                                                    </td>
                                                    <td style="text-align:right;height:25px;">
                                                        <?php
                                                        if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                            echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                                        else:
                                                            echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';

                                                        endif;
                                                        ?> 
                                                    </td>
                                                    <td style="text-align:right;">
                                                        <?php
                                                        if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                            echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                                        else:
                                                            echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';

                                                        endif;
                                                        ?> 
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
                                        $total_incorporel_courant = $actif_1[1][0]['solde_courant'] - abs($actif_1[1][1]['solde_courant']);
                                        if ($total_incorporel_courant >= 0):
                                            echo number_format($total_incorporel_courant, 3, '.', ' ');
                                        else:
                                            echo'(' . number_format(abs($total_incorporel_courant), 3, '.', ' ') . ')';
                                        endif;
                                        ?> 
                                    </td>
                                    <td style="text-align:center">


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
                            <?php endif; ?>
                        <?php endif; ?>
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
                        if ($actif_1[1][2]['param_id'] != ''):
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][2]['param_id']);
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
                                                    if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                        echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                                    else:
                                                        echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                                    endif;
//                                              
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
                                    if ($actif_1[1][2]['solde_courant'] >= 0):
                                        echo number_format($actif_1[1][2]['solde_courant'], 3, '.', ' ');
                                    elseif ($actif_1[1][2]['solde_courant'] < 0):
                                        echo '(' . number_format(abs($actif_1[1][2]['solde_courant']), 3, '.', ' ') . ')';
                                    endif;
                                    ?>
                                </td>
                                <td style="text-align:right">
                                    <?php
                                    $total_incorporel_prec = $actif_1[0][2]['solde_prec'];
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
                                    if ($actif_1[1][3]['param_id'] != ''):
                                        $total_ammortissement_courant = $actif_1[1][3]['solde_courant'];
                                        if ($total_ammortissement_courant >= 0):
                                            echo number_format($total_ammortissement_courant, 3, '.', ' ');
                                        else:
                                            echo'(' . number_format(abs($total_ammortissement_courant), 3, '.', ' ') . ')';

                                        endif;
                                        ?>  
                                    </td>
                                    <td style="text-align:right">
                                        <?php
                                        $total_ammortissement_prec = $actif_1[0][3]['solde_prec'];
                                        if ($total_ammortissement_prec >= 0):
                                            echo number_format($total_ammortissement_prec, 3, '.', ' ');
                                        else:
                                            echo'(' . number_format(abs($total_ammortissement_prec), 3, '.', ' ') . ')';

                                        endif;
                                        ?>
                                    </td>
                                </tr>


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
                            <?php endif; ?><?php endif; ?>
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
                        if ($actif_1[1][4]['param_id'] != ''):
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][4]['param_id']);
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
                                                    if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                        echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                                    else:
                                                        echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                                    endif;
//                                              
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
                                    if ($actif_1[1][4]['solde_courant'] >= 0):
                                        echo number_format($actif_1[1][4]['solde_courant'], 3, '.', ' ');
                                    elseif ($actif_1[1][4]['solde_courant'] < 0):
                                        echo '(' . number_format(abs($actif_1[1][4]['solde_courant']), 3, '.', ' ') . ')';
                                    endif;
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    $total_incorporel_prec = $actif_1[0][4]['solde_prec'];
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
                            <?php
                            if ($actif_1[1][5]['param_id'] != ''):
                                $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][5]['param_id']);
                                ?>
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
                                                        <?php
                                                        if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                            echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                                        else:
                                                            echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                                        endif;
//                                              
                                                        ?>
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
                                        $total_immobilise_prec = $total_incorporel_prec + $total_corporel_prec + $total_finance_prec;
                                        if ($total_immobilise_prec >= 0):
                                            echo number_format($total_immobilise_prec, 3, '.', ' ');
                                        else:
                                            echo'(' . number_format($total_immobilise_prec, 3, '.', ' ') . ')';

                                        endif;
                                        ?>
                                    </td>
                                </tr>
                            <?php endif; ?><?php endif ?>
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
                        if ($actif_1[1][6]['param_id'] != ''):
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][6]['param_id']);
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
                                                    if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                        echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                                    else:
                                                        echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
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
                        <?php endif; ?>
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
                        if ($actif_1[1][7]['param_id'] != ''):
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][7]['param_id']);
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
                                                    if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                        echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                                    else:
                                                        echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
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
                            if ($actif_1[1][8]['param_id'] != ''):
                                $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][8]['param_id']);
                                ?>
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
                                                        <?php
                                                        if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                            echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                                        else:
                                                            echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                                        endif;
                                                        ?>
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
                            <?php endif; ?><?php endif; ?>  </table>
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
                        if ($actif_1[1][9]['param_id'] != ''):
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][9]['param_id']);
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
                                                    if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                        echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                                    else:
                                                        echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
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
                            if ($actif_1[1][10]['param_id'] != ''):
                                $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][10]['param_id']);
                                ?>
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
                                                        <?php
                                                        if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                            echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                                        else:
                                                            echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                                        endif;
                                                        ?>
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
                            <?php endif; ?><?php endif; ?>
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
                        if ($actif_1[1][11]['param_id'] != ''):
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][11]['param_id']);
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
                                                    if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                        echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                                    else:
                                                        echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
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
                                <td style="height:25px;"><h3>Provisions</h3></td>
                                <td style="text-align:right"></td>
                                <td style="text-align:right"></td>
                            </tr>
                            <?php
                            if ($actif_1[1][12]['param_id'] != ''):
                                $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][12]['param_id']);
                                ?>
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
                                                        <?php
                                                        if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                            echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                                        else:
                                                            echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                                        endif;
                                                        ?>
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
                                        $total_autre_courant = $actif_1[1][11]['solde_courant'] - abs($actif_1[1][12]['solde_courant']);
                                        if ($total_autre_courant >= 0):
                                            echo number_format($total_autre_courant, 3, '.', ' ');
                                        else:
                                            echo'(' . number_format(abs($total_autre_courant), 3, '.', ' ') . ')';

                                        endif;
                                        ?> 
                                    </td>
                                    <td style="text-align: center;">
                                        <?php
                                        $total_autre_prec = $actif_1[0][11]['solde_prec'] - abs($actif_1[0][12]['solde_prec']);
                                        if ($total_autre_prec >= 0):
                                            echo number_format($total_autre_prec, 3, '.', ' ');
                                        else:
                                            echo'(' . number_format(abs($total_autre_prec), 3, '.', ' ') . ')';

                                        endif;
                                        ?> 
                                    </td>
                                </tr>
                            <?php endif; ?><?php endif; ?> 
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
                        if ($actif_1[1][13]['param_id'] != ''):
                            $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][13]['param_id']);
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
                                                    if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                        echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                                    else:
                                                        echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
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
                            if ($actif_1[1][14]['param_id'] != ''):
                                $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif_1[1][14]['param_id']);
                                ?>
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
                                                        <?php
                                                        if ($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                                            echo number_format($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                                        else:
                                                            echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde() + $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                                        endif;
                                                        ?>
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
                                        $total_liqu_courant = $actif_1[1][13]['solde_courant'] - abs($actif_1[1][14]['solde_courant']);
                                        if ($total_liqu_courant >= 0):
                                            echo number_format($total_liqu_courant, 3, '.', ' ');
                                        else:
                                            echo'(' . number_format(abs($total_liqu_courant), 3, '.', ' ') . ')';

                                        endif;
                                        ?> 
                                    </td>
                                    <td style="text-align: center;">
                                        <?php
                                        $total_liqu_prec = $actif_1[0][13]['solde_prec'] - abs($actif_1[0][14]['solde_prec']);
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
                                        $total_actif_courant_courant = $total_stock_courant + $total_client_courant + $total_autre_courant + $actif_1[1][13]['solde_courant'] + $actif_1[1][14]['solde_courant'];
                                        if ($total_actif_courant_courant >= 0):
                                            echo number_format($total_actif_courant_courant, 3, '.', ' ');
                                        else:
                                            echo'(' . number_format($total_actif_courant_courant, 3, '.', ' ') . ')';

                                        endif;
                                        ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php
                                        $total_actif_courant_prec = $total_stock_prec + $total_client_prec + $total_autre_prec + $actif_1[0][0][13]['solde_prec'] + $actif_1[0][0][14]['solde_prec'];
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
                                <?php
                            endif;
                        endif;
                        ?>
                    </table>
                    <table class="center">
                        <tr>
                            <td> <h1>CAPITAUX PROPRES ET PASSIFS</h1>
                                <h1><?php  $strat_from=1;
                                echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?>
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
                            <td style="height:25px;"><h3>Subventions d'investissements amortissables <?php echo $passif[1][0]['param_id']?></h3></td>
                            <td style="text-align:right"></td>
                            <td style="text-align:right"></td>
                        </tr>
                        <?php
                        $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[1][0]['param_id']);
                  
                        $params_avecregro = ParametrebilancompteTable::getInstance()->getRegroupement($passif[1][0]['param_id']);
                        foreach ($params as $param_compte ):
                             foreach ($params_avecregro as $param_compte_regr ):

                             if ($param_compte->getRegrouppement() == ''):                            ?>
                                   <tr>
                                    <td><?php echo  trim($param_compte->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($param_compte->getPlandossiercomptable()->getLibelle()); ?>  </td>
                                    <td style="text-align:right;height:25px;">
                                        <?php
                                        if ($param_compte->getPlandossiercomptable()->getSolde()  >= 0):
                                            echo number_format($param_compte->getPlandossiercomptable()->getSolde() , 3, '.', ' ');
                                        else:
                                            echo '(' . number_format(abs( $param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                        endif;                                             
                                        ?>
                                    </td>
                                    <td style="text-align:right;">
                                        <?php
                                        if ($param_compte->getPlandossiercomptable()->getSolde() >= 0):
                                            echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' ');
                                        else:
                                            echo '(' . number_format(abs($param_compte->getPlandossiercomptable()->getSolde()), 3, '.', ' ') . ')';
                                        endif;
                                        ?>
                                    </td>

                                </tr>      
                                <?php else: ?>                           
                                <tr>
                                    <td>
                                                <?php echo $param_compte_regr->getRegrouppemnt().'rrrr'; ?>
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
                            <?php endforeach; ?>
                           <?php endforeach; ?>

                    </table>
                </div>
                <table style="margin-bottom: 0px;">
                    <tr>
                        <td>
                            <button class="btn btn-primary" style="float: right;" onclick="saveNote()"><i class="ace-icon fa fa-save"></i> Enregistrer </button>
                            <a href="<?php echo url_for('fiche_Bilan/imprimerParametreNote') ?>" target="_blank" class="btn btn-success"><i class="ace-icon fa fa-print"></i> Imprimer </a>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>

<script  type="text/javascript">

    function saveNote() {
        var content = $("#editor1").html();
        content = content.replace(/&nbsp;/g, " ");
        $.ajax({
            url: '<?php echo url_for('fiche_Bilan/saveNote') ?>',
            data: 'content=' + content,
            success: function (data) {
                bootbox.dialog({
                    message: "<h4 style='color:#4844bd;'>Paramètre enregistré avec succès !</h4>",
                    buttons:
                            {
                                "button":
                                        {
                                            "label": "Fermer",
                                            "className": "btn-sm"
                                        }
                            }
                });
            }});
    }

</script>

<script  type="text/javascript">

    function showErrorAlert(reason, detail) {
        var msg = '';
        if (reason === 'unsupported-file-type') {
            msg = "Unsupported format " + detail;
        }
        else {
            //console.log("error uploading file", reason, detail);
        }
        $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
    }

    //but we want to change a few buttons colors for the third style
    $('#editor1').ace_wysiwyg({
        toolbar:
                [
                    'font',
                    null,
                    'fontSize',
                    null,
                    {name: 'bold', className: 'btn-info'},
                    {name: 'italic', className: 'btn-info'},
                    {name: 'strikethrough', className: 'btn-info'},
                    {name: 'underline', className: 'btn-info'}, null,
                    {name: 'insertunorderedlist', className: 'btn-success'},
                    {name: 'insertorderedlist', className: 'btn-success'},
                    {name: 'outdent', className: 'btn-purple'},
                    {name: 'indent', className: 'btn-purple'},
                    null,
                    {name: 'justifyleft', className: 'btn-primary'},
                    {name: 'justifycenter', className: 'btn-primary'},
                    {name: 'justifyright', className: 'btn-primary'},
                    {name: 'justifyfull', className: 'btn-inverse'},
                    null,
                    {name: 'createLink', className: 'btn-pink'},
                    {name: 'unlink', className: 'btn-pink'},
                    null,
                    {name: 'insertImage', className: 'btn-success'},
                    null,
                    'foreColor',
                    null,
                    {name: 'undo', className: 'btn-grey'},
                    {name: 'redo', className: 'btn-grey'}
                ],
        'wysiwyg': {
            fileUploadError: showErrorAlert
        }
    }).prev().addClass('wysiwyg-style2');

    function setFormat(which) {
        var toolbar = $('#editor1').prev().get(0);
        if (which >= 1 && which <= 4) {
            toolbar.className = toolbar.className.replace(/wysiwyg\-style(1|2)/g, '');
            if (which == 1)
                $(toolbar).addClass('wysiwyg-style1');
            else if (which == 2)
                $(toolbar).addClass('wysiwyg-style2');
            if (which == 4) {
                $(toolbar).find('.btn-group > .btn').addClass('btn-white btn-round');
            } else
                $(toolbar).find('.btn-group > .btn-white').removeClass('btn-white btn-round');
        }
    }

    setFormat(4);

    //RESIZE IMAGE

    //Add Image Resize Functionality to Chrome and Safari
    //webkit browsers don't have image resize functionality when content is editable
    //so let's add something using jQuery UI resizable
    //another option would be opening a dialog for user to enter dimensions.
    if (typeof jQuery.ui !== 'undefined' && ace.vars['webkit']) {

        var lastResizableImg = null;
        function destroyResizable() {
            if (lastResizableImg == null)
                return;
            lastResizableImg.resizable("destroy");
            lastResizableImg.removeData('resizable');
            lastResizableImg = null;
        }

        var enableImageResize = function () {
            $('.wysiwyg-editor')
                    .on('mousedown', function (e) {
                        var target = $(e.target);
                        if (e.target instanceof HTMLImageElement) {
                            if (!target.data('resizable')) {
                                target.resizable({
                                    aspectRatio: e.target.width / e.target.height,
                                });
                                target.data('resizable', true);

                                if (lastResizableImg != null) {
                                    //disable previous resizable image
                                    lastResizableImg.resizable("destroy");
                                    lastResizableImg.removeData('resizable');
                                }
                                lastResizableImg = target;
                            }
                        }
                    })
                    .on('click', function (e) {
                        if (lastResizableImg != null && !(e.target instanceof HTMLImageElement)) {
                            destroyResizable();
                        }
                    })
                    .on('keydown', function () {
                        destroyResizable();
                    });
        }

        enableImageResize();

        /**
         //or we can load the jQuery UI dynamically only if needed
         if (typeof jQuery.ui !== 'undefined') enableImageResize();
         else {//load jQuery UI if not loaded
         //in Ace demo ./components will be replaced by correct components path
         $.getScript("assets/js/jquery-ui.custom.min.js", function(data, textStatus, jqxhr) {
         enableImageResize()
         });
         }
         */
    }
/*
 * etat de note 
 * <!--        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $total_brut = 0; ?>
                <?php $ancien_total_brut = 0; ?>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[0]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <?php
                        $ancien_montant = 0;
                        if ($exercice_precedent) {
                            $ancien_compte = PlandossiercomptableTable::getInstance()->findOneByLibelleAndIdExercice($param_compte->getPlandossiercomptable()->getLibelle(), $exercice_precedent->getId());
                            if ($ancien_compte)
                                $ancien_montant = $ancien_compte->getSolde();
                        } else {
                            if ($journal_ouverture) {
                                $calcul_ancien_montant = LignepiececomptableTable::getInstance()->getSoldeOuvertureByCompte($param_compte->getPlandossiercomptable()->getId(), $journal_ouverture->getId())->getFirst();
                                if ($calcul_ancien_montant)
                                    $ancien_montant = $calcul_ancien_montant->getTotalDebit() + $calcul_ancien_montant->getTotalCredit();
                            }
                        }
                        ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"><?php echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' '); ?></td>
                            <td style="text-align:right;"><?php echo number_format($ancien_montant, 3, '.', ' '); ?></td>
                        </tr>
                        <?php $total_brut = $total_brut + $param_compte->getPlandossiercomptable()->getSolde(); ?>
                        <?php $ancien_total_brut = $ancien_total_brut + $ancien_montant; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr>
                    <td style="text-align:center;font-weight:bold;height:25px;">Total Brut</td>
                    <td style="text-align:right"><?php echo number_format($total_brut, 3, '.', ' '); ?></td>
                    <td style="text-align:right"><?php echo number_format($ancien_total_brut, 3, '.', ' '); ?></td>
                </tr>
                <?php $amortissement = 0; ?>
                <?php $ancien_amortissement = 0; ?>
                <?php
                $amortissement = ParametrebilancompteTable::getInstance()->calculSoldeParametreBilan($actif[1]['id'], $_SESSION['exercice_id'])->getSolde();
                if ($exercice_precedent) {
                    $ancien_amortissement = ParametrebilancompteTable::getInstance()->calculSoldeParametreBilan($actif[1]['id'], $exercice_precedent->getId())->getSolde();
                } else {
                    if ($journal_ouverture) {
                        $calcul_ancien_amortissement = LignepiececomptableTable::getInstance()->getSoldeOuverture($actif[1]['id'], $journal_ouverture->getId())->getFirst();
                        if ($calcul_ancien_amortissement)
                            $ancien_amortissement = $calcul_ancien_amortissement->getTotalDebit() + $calcul_ancien_amortissement->getTotalCredit();
                    }
                }
                ?>
                <tr>
                    <td>Amortissement</td>
                    <td style="text-align:right"><?php echo number_format($amortissement, 3, '.', ' '); ?></td>
                    <td style="text-align:right"><?php echo number_format($ancien_amortissement, 3, '.', ' '); ?></td>
                </tr>
                <?php $net = $total_brut - $amortissement; ?>
                <?php $ancien_net = $ancien_total_brut - $ancien_amortissement; ?>
                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Total Net</td>
                    <td style="text-align:right"><?php echo number_format($net, 3, '.', ' '); ?></td>
                    <td style="text-align:right"><?php echo number_format($ancien_net, 3, '.', ' '); ?></td>
                </tr>
            </tbody>
        </table>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - IMMOB CORPORELLES :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $total_brut = 0; ?>
                <?php $ancien_total_brut = 0; ?>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[2]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <?php
                        $ancien_montant = 0;
                        if ($exercice_precedent) {
                            $ancien_compte = PlandossiercomptableTable::getInstance()->findOneByLibelleAndIdExercice($param_compte->getPlandossiercomptable()->getLibelle(), $exercice_precedent->getId());
                            if ($ancien_compte)
                                $ancien_montant = $ancien_compte->getSolde();
                        } else {
                            if ($journal_ouverture) {
                                $calcul_ancien_montant = LignepiececomptableTable::getInstance()->getSoldeOuvertureByCompte($param_compte->getPlandossiercomptable()->getId(), $journal_ouverture->getId())->getFirst();
                                if ($calcul_ancien_montant)
                                    $ancien_montant = $calcul_ancien_montant->getTotalDebit() + $calcul_ancien_montant->getTotalCredit();
                            }
                        }
                        ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"><?php echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' '); ?></td>
                            <td style="text-align:right;"><?php echo number_format($ancien_montant, 3, '.', ' '); ?></td>
                        </tr>
                        <?php $total_brut = $total_brut + $param_compte->getPlandossiercomptable()->getSolde(); ?>
                        <?php $ancien_total_brut = $ancien_total_brut + $ancien_montant; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr>
                    <td style="text-align:center;font-weight:bold;height:25px;">Total Brut</td>
                    <td style="text-align:right"><?php echo number_format($total_brut, 3, '.', ' '); ?></td>
                    <td style="text-align:right"><?php echo number_format($ancien_total_brut, 3, '.', ' '); ?></td>
                </tr>
                <?php $amortissement = 0; ?>
                <?php $ancien_amortissement = 0; ?>
                <?php
                $amortissement = ParametrebilancompteTable::getInstance()->calculSoldeParametreBilan($actif[3]['id'], $_SESSION['exercice_id'])->getSolde();
                if ($exercice_precedent) {
                    $ancien_amortissement = ParametrebilancompteTable::getInstance()->calculSoldeParametreBilan($actif[3]['id'], $exercice_precedent->getId())->getSolde();
                } else {
                    if ($journal_ouverture) {
                        $calcul_ancien_amortissement = LignepiececomptableTable::getInstance()->getSoldeOuverture($actif[3]['id'], $journal_ouverture->getId())->getFirst();
                        if ($calcul_ancien_amortissement)
                            $ancien_amortissement = $calcul_ancien_amortissement->getTotalDebit() + $calcul_ancien_amortissement->getTotalCredit();
                    }
                }
                ?>
                <tr>
                    <td>Amortissement</td>
                    <td style="text-align:right"><?php echo number_format($amortissement, 3, '.', ' '); ?></td>
                    <td style="text-align:right"><?php echo number_format($ancien_amortissement, 3, '.', ' '); ?></td>
                </tr>
                <?php $net = $total_brut - $amortissement; ?>
                <?php $ancien_net = $ancien_total_brut - $ancien_amortissement; ?>
                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Total Net</td>
                    <td style="text-align:right"><?php echo number_format($net, 3, '.', ' '); ?></td>
                    <td style="text-align:right"><?php echo number_format($ancien_net, 3, '.', ' '); ?></td>
                </tr>
            </tbody>
        </table>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - IMMOB FINANCIERES :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $total_brut = 0; ?>
                <?php $ancien_total_brut = 0; ?>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[4]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <?php
                        $ancien_montant = 0;
                        if ($exercice_precedent) {
                            $ancien_compte = PlandossiercomptableTable::getInstance()->findOneByLibelleAndIdExercice($param_compte->getPlandossiercomptable()->getLibelle(), $exercice_precedent->getId());
                            if ($ancien_compte)
                                $ancien_montant = $ancien_compte->getSolde();
                        } else {
                            if ($journal_ouverture) {
                                $calcul_ancien_montant = LignepiececomptableTable::getInstance()->getSoldeOuvertureByCompte($param_compte->getPlandossiercomptable()->getId(), $journal_ouverture->getId())->getFirst();
                                if ($calcul_ancien_montant)
                                    $ancien_montant = $calcul_ancien_montant->getTotalDebit() + $calcul_ancien_montant->getTotalCredit();
                            }
                        }
                        ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"><?php echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' '); ?></td>
                            <td style="text-align:right;"><?php echo number_format($ancien_montant, 3, '.', ' '); ?></td>
                        </tr>
                        <?php $total_brut = $total_brut + $param_compte->getPlandossiercomptable()->getSolde(); ?>
                        <?php $ancien_total_brut = $ancien_total_brut + $ancien_montant; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Total</td>
                    <td style="text-align:right"><?php echo number_format($total_brut, 3, '.', ' '); ?></td>
                    <td style="text-align:right"><?php echo number_format($ancien_total_brut, 3, '.', ' '); ?></td>
                </tr>
            </tbody>
        </table>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - STOCK :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $total_brut = 0; ?>
                <?php $ancien_total_brut = 0; ?>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[8]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <?php
                        $ancien_montant = 0;
                        if ($exercice_precedent) {
                            $ancien_compte = PlandossiercomptableTable::getInstance()->findOneByLibelleAndIdExercice($param_compte->getPlandossiercomptable()->getLibelle(), $exercice_precedent->getId());
                            if ($ancien_compte)
                                $ancien_montant = $ancien_compte->getSolde();
                        } else {
                            if ($journal_ouverture) {
                                $calcul_ancien_montant = LignepiececomptableTable::getInstance()->getSoldeOuvertureByCompte($param_compte->getPlandossiercomptable()->getId(), $journal_ouverture->getId())->getFirst();
                                if ($calcul_ancien_montant)
                                    $ancien_montant = $calcul_ancien_montant->getTotalDebit() + $calcul_ancien_montant->getTotalCredit();
                            }
                        }
                        ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"><?php echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' '); ?></td>
                            <td style="text-align:right;"><?php echo number_format($ancien_montant, 3, '.', ' '); ?></td>
                        </tr>
                        <?php $total_brut = $total_brut + $param_compte->getPlandossiercomptable()->getSolde(); ?>
                        <?php $ancien_total_brut = $ancien_total_brut + $ancien_montant; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Total</td>
                    <td style="text-align:right"><?php echo number_format($total_brut, 3, '.', ' '); ?></td>
                    <td style="text-align:right"><?php echo number_format($ancien_total_brut, 3, '.', ' '); ?></td>
                </tr>
            </tbody>
        </table>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - CLIENTS ET COMPTES RATTACHÉS :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $total_brut = 0; ?>
                <?php $ancien_total_brut = 0; ?>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[9]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <?php
                        $ancien_montant = 0;
                        if ($exercice_precedent) {
                            $ancien_compte = PlandossiercomptableTable::getInstance()->findOneByLibelleAndIdExercice($param_compte->getPlandossiercomptable()->getLibelle(), $exercice_precedent->getId());
                            if ($ancien_compte)
                                $ancien_montant = $ancien_compte->getSolde();
                        } else {
                            if ($journal_ouverture) {
                                $calcul_ancien_montant = LignepiececomptableTable::getInstance()->getSoldeOuvertureByCompte($param_compte->getPlandossiercomptable()->getId(), $journal_ouverture->getId())->getFirst();
                                if ($calcul_ancien_montant)
                                    $ancien_montant = $calcul_ancien_montant->getTotalDebit() + $calcul_ancien_montant->getTotalCredit();
                            }
                        }
                        ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"><?php echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' '); ?></td>
                            <td style="text-align:right;"><?php echo number_format($ancien_montant, 3, '.', ' '); ?></td>
                        </tr>
                        <?php $total_brut = $total_brut + $param_compte->getPlandossiercomptable()->getSolde(); ?>
                        <?php $ancien_total_brut = $ancien_total_brut + $ancien_montant; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr>
                    <td style="text-align:center;font-weight:bold;height:25px;">Total Brut</td>
                    <td style="text-align:right"><?php echo number_format($total_brut, 3, '.', ' '); ?></td>
                    <td style="text-align:right"><?php echo number_format($ancien_total_brut, 3, '.', ' '); ?></td>
                </tr>
                <?php $amortissement = 0; ?>
                <?php $ancien_amortissement = 0; ?>
                <?php
                $amortissement = ParametrebilancompteTable::getInstance()->calculSoldeParametreBilan($actif[10]['id'], $_SESSION['exercice_id'])->getSolde();
                if ($exercice_precedent) {
                    $ancien_amortissement = ParametrebilancompteTable::getInstance()->calculSoldeParametreBilan($actif[10]['id'], $exercice_precedent->getId())->getSolde();
                } else {
                    if ($journal_ouverture) {
                        $calcul_ancien_amortissement = LignepiececomptableTable::getInstance()->getSoldeOuverture($actif[10]['id'], $journal_ouverture->getId())->getFirst();
                        if ($calcul_ancien_amortissement)
                            $ancien_amortissement = $calcul_ancien_amortissement->getTotalDebit() + $calcul_ancien_amortissement->getTotalCredit();
                    }
                }
                ?>
                <tr>
                    <td>Provisions</td>
                    <td style="text-align:right"><?php echo number_format($amortissement, 3, '.', ' '); ?></td>
                    <td style="text-align:right"><?php echo number_format($ancien_amortissement, 3, '.', ' '); ?></td>
                </tr>
                <?php $net = $total_brut - $amortissement; ?>
                <?php $ancien_net = $ancien_total_brut - $ancien_amortissement; ?>
                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Total Net</td>
                    <td style="text-align:right"><?php echo number_format($net, 3, '.', ' '); ?></td>
                    <td style="text-align:right"><?php echo number_format($ancien_net, 3, '.', ' '); ?></td>
                </tr>
            </tbody>
        </table>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - AUTRES ACTIFS COURANTS :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $total_brut = 0; ?>
                <?php $ancien_total_brut = 0; ?>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[12]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <?php
                        $ancien_montant = 0;
                        if ($exercice_precedent) {
                            $ancien_compte = PlandossiercomptableTable::getInstance()->findOneByLibelleAndIdExercice($param_compte->getPlandossiercomptable()->getLibelle(), $exercice_precedent->getId());
                            if ($ancien_compte)
                                $ancien_montant = $ancien_compte->getSolde();
                        } else {
                            if ($journal_ouverture) {
                                $calcul_ancien_montant = LignepiececomptableTable::getInstance()->getSoldeOuvertureByCompte($param_compte->getPlandossiercomptable()->getId(), $journal_ouverture->getId())->getFirst();
                                if ($calcul_ancien_montant)
                                    $ancien_montant = $calcul_ancien_montant->getTotalDebit() + $calcul_ancien_montant->getTotalCredit();
                            }
                        }
                        ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"><?php echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' '); ?></td>
                            <td style="text-align:right;"><?php echo number_format($ancien_montant, 3, '.', ' '); ?></td>
                        </tr>
                        <?php $total_brut = $total_brut + $param_compte->getPlandossiercomptable()->getSolde(); ?>
                        <?php $ancien_total_brut = $ancien_total_brut + $ancien_montant; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Total Brut</td>
                    <td style="text-align:right"><?php echo number_format($total_brut, 3, '.', ' '); ?></td>
                    <td style="text-align:right"><?php echo number_format($ancien_total_brut, 3, '.', ' '); ?></td>
                </tr>
            </tbody>
        </table>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - LIQUIDITÉS ET ÉQUIVALENTS DE LIQUIDITÉS :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $total_brut = 0; ?>
                <?php $ancien_total_brut = 0; ?>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($actif[14]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <?php
                        $ancien_montant = 0;
                        if ($exercice_precedent) {
                            $ancien_compte = PlandossiercomptableTable::getInstance()->findOneByLibelleAndIdExercice($param_compte->getPlandossiercomptable()->getLibelle(), $exercice_precedent->getId());
                            if ($ancien_compte)
                                $ancien_montant = $ancien_compte->getSolde();
                        } else {
                            if ($journal_ouverture) {
                                $calcul_ancien_montant = LignepiececomptableTable::getInstance()->getSoldeOuvertureByCompte($param_compte->getPlandossiercomptable()->getId(), $journal_ouverture->getId())->getFirst();
                                if ($calcul_ancien_montant)
                                    $ancien_montant = $calcul_ancien_montant->getTotalDebit() + $calcul_ancien_montant->getTotalCredit();
                            }
                        }
                        ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"><?php echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' '); ?></td>
                            <td style="text-align:right;"><?php echo number_format($ancien_montant, 3, '.', ' '); ?></td>
                        </tr>
                        <?php $total_brut = $total_brut + $param_compte->getPlandossiercomptable()->getSolde(); ?>
                        <?php $ancien_total_brut = $ancien_total_brut + $ancien_montant; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Total</td>
                    <td style="text-align:right"><?php echo number_format($total_brut, 3, '.', ' '); ?></td>
                    <td style="text-align:right"><?php echo number_format($ancien_total_brut, 3, '.', ' '); ?></td>
                </tr>
            </tbody>
        </table>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - CAPITAL SOCIAL :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $total_brut = 0; ?>
                <?php $ancien_total_brut = 0; ?>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[0]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <?php
                        $ancien_montant = 0;
                        if ($exercice_precedent) {
                            $ancien_compte = PlandossiercomptableTable::getInstance()->findOneByLibelleAndIdExercice($param_compte->getPlandossiercomptable()->getLibelle(), $exercice_precedent->getId());
                            if ($ancien_compte)
                                $ancien_montant = $ancien_compte->getSolde();
                        } else {
                            if ($journal_ouverture) {
                                $calcul_ancien_montant = LignepiececomptableTable::getInstance()->getSoldeOuvertureByCompte($param_compte->getPlandossiercomptable()->getId(), $journal_ouverture->getId())->getFirst();
                                if ($calcul_ancien_montant)
                                    $ancien_montant = $calcul_ancien_montant->getTotalDebit() + $calcul_ancien_montant->getTotalCredit();
                            }
                        }
                        ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"><?php echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' '); ?></td>
                            <td style="text-align:right;"><?php echo number_format($ancien_montant, 3, '.', ' '); ?></td>
                        </tr>
                        <?php $total_brut = $total_brut + $param_compte->getPlandossiercomptable()->getSolde(); ?>
                        <?php $ancien_total_brut = $ancien_total_brut + $ancien_montant; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Total</td>
                    <td style="text-align:right"><?php echo number_format($total_brut, 3, '.', ' '); ?></td>
                    <td style="text-align:right"><?php echo number_format($ancien_total_brut, 3, '.', ' '); ?></td>
                </tr>
            </tbody>
        </table>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - RESULTAT REPORTE :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $total_brut = 0; ?>
                <?php $ancien_total_brut = 0; ?>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[3]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <?php
                        $ancien_montant = 0;
                        if ($exercice_precedent) {
                            $ancien_compte = PlandossiercomptableTable::getInstance()->findOneByLibelleAndIdExercice($param_compte->getPlandossiercomptable()->getLibelle(), $exercice_precedent->getId());
                            if ($ancien_compte)
                                $ancien_montant = $ancien_compte->getSolde();
                        } else {
                            if ($journal_ouverture) {
                                $calcul_ancien_montant = LignepiececomptableTable::getInstance()->getSoldeOuvertureByCompte($param_compte->getPlandossiercomptable()->getId(), $journal_ouverture->getId())->getFirst();
                                if ($calcul_ancien_montant)
                                    $ancien_montant = $calcul_ancien_montant->getTotalDebit() + $calcul_ancien_montant->getTotalCredit();
                            }
                        }
                        ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"><?php echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' '); ?></td>
                            <td style="text-align:right;"><?php echo number_format($ancien_montant, 3, '.', ' '); ?></td>
                        </tr>
                        <?php $total_brut = $total_brut + $param_compte->getPlandossiercomptable()->getSolde(); ?>
                        <?php $ancien_total_brut = $ancien_total_brut + $ancien_montant; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Total</td>
                    <td style="text-align:right"><?php echo number_format($total_brut, 3, '.', ' '); ?></td>
                    <td style="text-align:right"><?php echo number_format($ancien_total_brut, 3, '.', ' '); ?></td>
                </tr>
            </tbody>
        </table>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - EMPRUNTS :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $total_brut = 0; ?>
                <?php $ancien_total_brut = 0; ?>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[5]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <?php
                        $ancien_montant = 0;
                        if ($exercice_precedent) {
                            $ancien_compte = PlandossiercomptableTable::getInstance()->findOneByLibelleAndIdExercice($param_compte->getPlandossiercomptable()->getLibelle(), $exercice_precedent->getId());
                            if ($ancien_compte)
                                $ancien_montant = $ancien_compte->getSolde();
                        } else {
                            if ($journal_ouverture) {
                                $calcul_ancien_montant = LignepiececomptableTable::getInstance()->getSoldeOuvertureByCompte($param_compte->getPlandossiercomptable()->getId(), $journal_ouverture->getId())->getFirst();
                                if ($calcul_ancien_montant)
                                    $ancien_montant = $calcul_ancien_montant->getTotalDebit() + $calcul_ancien_montant->getTotalCredit();
                            }
                        }
                        ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"><?php echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' '); ?></td>
                            <td style="text-align:right;"><?php echo number_format($ancien_montant, 3, '.', ' '); ?></td>
                        </tr>
                        <?php $total_brut = $total_brut + $param_compte->getPlandossiercomptable()->getSolde(); ?>
                        <?php $ancien_total_brut = $ancien_total_brut + $ancien_montant; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Total</td>
                    <td style="text-align:right"><?php echo number_format($total_brut, 3, '.', ' '); ?></td>
                    <td style="text-align:right"><?php echo number_format($ancien_total_brut, 3, '.', ' '); ?></td>
                </tr>
            </tbody>
        </table>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - FOURNISSEURS ET COMPTES RATTACHÉS :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $total_brut = 0; ?>
                <?php $ancien_total_brut = 0; ?>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[8]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <?php
                        $ancien_montant = 0;
                        if ($exercice_precedent) {
                            $ancien_compte = PlandossiercomptableTable::getInstance()->findOneByLibelleAndIdExercice($param_compte->getPlandossiercomptable()->getLibelle(), $exercice_precedent->getId());
                            if ($ancien_compte)
                                $ancien_montant = $ancien_compte->getSolde();
                        } else {
                            if ($journal_ouverture) {
                                $calcul_ancien_montant = LignepiececomptableTable::getInstance()->getSoldeOuvertureByCompte($param_compte->getPlandossiercomptable()->getId(), $journal_ouverture->getId())->getFirst();
                                if ($calcul_ancien_montant)
                                    $ancien_montant = $calcul_ancien_montant->getTotalDebit() + $calcul_ancien_montant->getTotalCredit();
                            }
                        }
                        ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"><?php echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' '); ?></td>
                            <td style="text-align:right;"><?php echo number_format($ancien_montant, 3, '.', ' '); ?></td>
                        </tr>
                        <?php $total_brut = $total_brut + $param_compte->getPlandossiercomptable()->getSolde(); ?>
                        <?php $ancien_total_brut = $ancien_total_brut + $ancien_montant; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Total</td>
                    <td style="text-align:right"><?php echo number_format($total_brut, 3, '.', ' '); ?></td>
                    <td style="text-align:right"><?php echo number_format($ancien_total_brut, 3, '.', ' '); ?></td>
                </tr>
            </tbody>
        </table>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - AUTRES PASSIFS COURANTS :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $total_brut = 0; ?>
                <?php $ancien_total_brut = 0; ?>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[9]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <?php
                        $ancien_montant = 0;
                        if ($exercice_precedent) {
                            $ancien_compte = PlandossiercomptableTable::getInstance()->findOneByLibelleAndIdExercice($param_compte->getPlandossiercomptable()->getLibelle(), $exercice_precedent->getId());
                            if ($ancien_compte)
                                $ancien_montant = $ancien_compte->getSolde();
                        } else {
                            if ($journal_ouverture) {
                                $calcul_ancien_montant = LignepiececomptableTable::getInstance()->getSoldeOuvertureByCompte($param_compte->getPlandossiercomptable()->getId(), $journal_ouverture->getId())->getFirst();
                                if ($calcul_ancien_montant)
                                    $ancien_montant = $calcul_ancien_montant->getTotalDebit() + $calcul_ancien_montant->getTotalCredit();
                            }
                        }
                        ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"><?php echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' '); ?></td>
                            <td style="text-align:right;"><?php echo number_format($ancien_montant, 3, '.', ' '); ?></td>
                        </tr>
                        <?php $total_brut = $total_brut + $param_compte->getPlandossiercomptable()->getSolde(); ?>
                        <?php $ancien_total_brut = $ancien_total_brut + $ancien_montant; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Total</td>
                    <td style="text-align:right"><?php echo number_format($total_brut, 3, '.', ' '); ?></td>
                    <td style="text-align:right"><?php echo number_format($ancien_total_brut, 3, '.', ' '); ?></td>
                </tr>
            </tbody>
        </table>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - CONCOURS BANCAIRES ET AUTRES PASSIFS FINANCIERS :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $total_brut = 0; ?>
                <?php $ancien_total_brut = 0; ?>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($passif[10]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <?php
                        $ancien_montant = 0;
                        if ($exercice_precedent) {
                            $ancien_compte = PlandossiercomptableTable::getInstance()->findOneByLibelleAndIdExercice($param_compte->getPlandossiercomptable()->getLibelle(), $exercice_precedent->getId());
                            if ($ancien_compte)
                                $ancien_montant = $ancien_compte->getSolde();
                        } else {
                            if ($journal_ouverture) {
                                $calcul_ancien_montant = LignepiececomptableTable::getInstance()->getSoldeOuvertureByCompte($param_compte->getPlandossiercomptable()->getId(), $journal_ouverture->getId())->getFirst();
                                if ($calcul_ancien_montant)
                                    $ancien_montant = $calcul_ancien_montant->getTotalDebit() + $calcul_ancien_montant->getTotalCredit();
                            }
                        }
                        ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"><?php echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' '); ?></td>
                            <td style="text-align:right;"><?php echo number_format($ancien_montant, 3, '.', ' '); ?></td>
                        </tr>
                        <?php $total_brut = $total_brut + $param_compte->getPlandossiercomptable()->getSolde(); ?>
                        <?php $ancien_total_brut = $ancien_total_brut + $ancien_montant; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Total</td>
                    <td style="text-align:right"><?php echo number_format($total_brut, 3, '.', ' '); ?></td>
                    <td style="text-align:right"><?php echo number_format($ancien_total_brut, 3, '.', ' '); ?></td>
                </tr>
            </tbody>
        </table>

        <div class="well well-sm" style="background-color: #EEF4F9; border: 1px solid #71BFFF; text-align: center; font-size: 18px;"> NOTES A L'ETAT DE RESULTAT </div>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - REVENUS :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $total_brut = 0; ?>
                <?php $ancien_total_brut = 0; ?>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($resultat[0]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <?php
                        $ancien_montant = 0;
                        if ($exercice_precedent) {
                            $ancien_compte = PlandossiercomptableTable::getInstance()->findOneByLibelleAndIdExercice($param_compte->getPlandossiercomptable()->getLibelle(), $exercice_precedent->getId());
                            if ($ancien_compte)
                                $ancien_montant = $ancien_compte->getSolde();
                        } else {
                            if ($journal_ouverture) {
                                $calcul_ancien_montant = LignepiececomptableTable::getInstance()->getSoldeOuvertureByCompte($param_compte->getPlandossiercomptable()->getId(), $journal_ouverture->getId())->getFirst();
                                if ($calcul_ancien_montant)
                                    $ancien_montant = $calcul_ancien_montant->getTotalDebit() + $calcul_ancien_montant->getTotalCredit();
                            }
                        }
                        ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"><?php echo number_format($param_compte->getPlandossiercomptable()->getSolde(), 3, '.', ' '); ?></td>
                            <td style="text-align:right;"><?php echo number_format($ancien_montant, 3, '.', ' '); ?></td>
                        </tr>
                        <?php $total_brut = $total_brut + $param_compte->getPlandossiercomptable()->getSolde(); ?>
                        <?php $ancien_total_brut = $ancien_total_brut + $ancien_montant; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Total</td>
                    <td style="text-align:right"><?php echo number_format($total_brut, 3, '.', ' '); ?></td>
                    <td style="text-align:right"><?php echo number_format($ancien_total_brut, 3, '.', ' '); ?></td>
                </tr>
            </tbody>
        </table>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - VARIATION DE STOCK :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($resultat[4]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"></td>
                            <td style="text-align:right;"></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Total</td>
                    <td style="text-align:right"></td>
                    <td style="text-align:right"></td>
                </tr>
            </tbody>
        </table>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - ACHATS D'APPROVISIONNEMENT CONSOMMÉS :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($resultat[5]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"></td>
                            <td style="text-align:right;"></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Total</td>
                    <td style="text-align:right"></td>
                    <td style="text-align:right"></td>
                </tr>
            </tbody>
        </table>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - AUTRES CHARGES D'ÉXPLOITATION :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($resultat[8]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"></td>
                            <td style="text-align:right;"></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Total</td>
                    <td style="text-align:right"></td>
                    <td style="text-align:right"></td>
                </tr>
            </tbody>
        </table>

        <div class="well well-sm" style="background-color: #EEF4F9; border: 1px solid #71BFFF; text-align: center; font-size: 18px;"> NOTES A L'ETAT DE FLUX DE TRESORERIE </div>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - VARIATION DE STOCK :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[3]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"></td>
                            <td style="text-align:right;"></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Variation</td>
                    <td style="text-align:right"></td>
                    <td style="text-align:right"></td>
                </tr>
            </tbody>
        </table>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - VARIATION DES CRÉANCES :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[4]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"></td>
                            <td style="text-align:right;"></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Variation</td>
                    <td style="text-align:right"></td>
                    <td style="text-align:right"></td>
                </tr>
            </tbody>
        </table>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - VARIATION AUTRES ACTIFS :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[4]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"></td>
                            <td style="text-align:right;"></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Variation</td>
                    <td style="text-align:right"></td>
                    <td style="text-align:right"></td>
                </tr>
            </tbody>
        </table>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - VARIATION DES FOURNISSEURS :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[5]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"></td>
                            <td style="text-align:right;"></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Variation</td>
                    <td style="text-align:right"></td>
                    <td style="text-align:right"></td>
                </tr>
            </tbody>
        </table>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - VARIATION DES AUTRES DETTES :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:70%;height:25px;">&nbsp;</td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:15%;text-align:center;font-weight:bold;"><?php echo $_SESSION['exercice'] - 1; ?></td>
                </tr>
            </thead>
            <tbody>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[5]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"></td>
                            <td style="text-align:right;"></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Variation</td>
                    <td style="text-align:right"></td>
                    <td style="text-align:right"></td>
                </tr>
            </tbody>
        </table>

        <legend style="font-size: 16px; margin-bottom: 10px;"><?php echo str_pad($strat_from, '2', '0', STR_PAD_LEFT); ?> - VARIATION DE TRÉSORERIE :</legend>
        <?php $strat_from++; ?>

        <table>
            <thead>
                <tr>
                    <td style="width:49%;height:25px;">&nbsp;</td>
                    <td style="width:17%;text-align:center;font-weight:bold;">Au 31/12/<?php echo $_SESSION['exercice']; ?></td>
                    <td style="width:17%;text-align:center;font-weight:bold;">Au 31/12/<?php echo $_SESSION['exercice'] - 1; ?></td>
                    <td style="width:17%;text-align:center;font-weight:bold;">Variations</td>
                </tr>
            </thead>
            <tbody>
                <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($flux[5]['id']); ?>
                <?php foreach ($params as $param_compte): ?>
                    <?php if ($param_compte->getType() == 1): ?>
                        <tr>
                            <td><?php echo trim($param_compte->getPlandossiercomptable()->getLibelle()); ?></td>
                            <td style="text-align:right;height:25px;"></td>
                            <td style="text-align:right"></td>
                            <td style="text-align:right;"></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr style="background-color:#F3F3F3;">
                    <td style="text-align:center;font-weight:bold;height:25px;">Variation</td>
                    <td style="text-align:right"></td>
                    <td style="text-align:right"></td>
                    <td style="text-align:right"></td>
                </tr>
            </tbody>
        </table>-->
 */*/
</script>

<style>

    .wysiwyg-editor {
        max-height: 400px;
        height: 400px;
    }


</style>
<style>

    .table-tr {
        background-color: #006dcc;

    }


</style>