<div>
    <div class="row">
        <div class="col-xs-12">
            <div class="table-header">
                Balance
                <a target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;margin-left: 3px" href="<?php echo url_for("etat/imprimeEtatBalanceTotaux?date_debut=" . $date_debut . "&date_fin=" . $date_fin . "&compte_min=" . $compte_min . "&compte_max=" . $compte_max . "&comptes_non_solde=" . $comptes_non_solde); ?>">
                    <i class="ace-icon fa fa-print bigger-110"></i>
                    <span class="bigger-110 no-text-shadow">Imprimer</span>
                </a>
                <a target="_blank" class="btn btn-sm btn-default" style="float: right; padding: 5px 12px; margin-left: 3px" href="<?php echo url_for("etat/exporterBalanceExcel_1?date_debut=" . $date_debut . "&date_fin=" . $date_fin . "&compte_min=" . $compte_min . "&compte_max=" . $compte_max . "&comptes_non_solde=" . $comptes_non_solde); ?>">
                    <i class="ace-icon fa fa-file-excel-o"></i>
                    <span class="bigger-110 no-text-shadow">Exporter</span>
                </a>
            </div>
            <table id="listBalance" class="table table-bordered table-hover">
                <thead>
                    <tr style="border-bottom: 1px solid #000000">
                        <th rowspan="2">Compte</th>
                        <th rowspan="2" >Libellé</th>
                        <th colspan="2" style="text-align: center">Soldes Ouvertures</th>
                        <th colspan="2"style="text-align: center">Mouvements Période <br> Du <?php echo date('d/m/Y', strtotime($date_debut)) ?> Au <?php echo date('d/m/Y', strtotime($date_fin)) ?></th>
                        <th  <?php if ($_SESSION['dossier_id'] == 1): ?>style="text-align: center;display: none" <?php else: ?>style="text-align: center;"colspan="2"<?php endif; ?>>Mouvements Cumulés</th>
                        <th colspan="2"style="text-align: center">Soldes de clôture</th>
                    </tr>
                    <tr style="border-bottom: 1px solid #000000">
                        <th style="text-align: center">Débit</th>
                        <th style="text-align: center">Crédit</th>
                        <th style="text-align: center">Débit</th>
                        <th style="text-align: center">Crédit</th>
                        <th <?php if ($_SESSION['dossier_id'] == 1): ?>style="text-align: center;display: none" <?php else: ?>style="text-align: center;"<?php endif; ?>>Débit</th>
                        <th <?php if ($_SESSION['dossier_id'] == 1): ?>style="text-align: center;display: none" <?php else: ?>style="text-align: center;"<?php endif; ?>>Crédit</th>
                        <th style="text-align: center">Débiteur</th>
                        <th style="text-align: center">Créditeur</th>
                    </tr>
                    <tr style="border-bottom: 1px solid #000000">
                        <th style="width: 3%;"></th>
                        <th style="width: 8;">Report</th>
                        <th style="width: 11%;"></th>
                        <th style="width: 11%;"></th>
                        <th style="width: 11%;"></th>
                        <th style="width: 11%;"></th>
                        <th <?php if ($_SESSION['dossier_id'] == 1): ?>style="width: 11%;display: none" <?php else: ?>style="width: 11%;"<?php endif; ?>></th>
                        <th <?php if ($_SESSION['dossier_id'] == 1): ?>style="width: 11%;display: none" <?php else: ?>style="width: 11%;"<?php endif; ?>></th>
                        <th style="width: 12%;"></th>
                        <th style="width: 11%;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php //die(sizeof($balance).'fs');
                    for ($i = 0; $i < (sizeof($balance) - 1); $i++):
                        
                        if ($_SESSION['dossier_id'] == 1):
                            if ($balance[$i]['debitMois'] != 0 || $balance[$i]['creditMois'] != 0 || $balance[$i]['creditOuv'] != 0 || $balance[$i]['debitOuv'] != 0 || $balance[$i]['debiteur'] != 0 || $balance[$i]['crediteur'] != 0):
                                ?>
                                <?php if ($balance[$i]['compte'] != '41' && $balance[$i]['compte'] != '40'): ?>
                                    <tr style="cursor: pointer;<?php echo $balance[$i]['ligne']; ?>" id="ligne_<?php echo $i; ?>" compte_id = "<?php echo $balance[$i]['id']; ?>">
                                    <?php else: ?>
                                    <tr style="cursor: pointer;<?php echo $balance[$i]['ligne']; ?>" id="ligne_<?php echo $i; ?>" compte_id = "<?php echo $balance[$i]['id']; ?>" onclick="ajouterLigne(<?php echo $i; ?>, <?php echo $balance[$i]['id']; ?>)">
                                    <?php endif; ?>
                                    <?php if (strlen($balance[$i]['compte']) > 2): ?>
                                        <td style="text-align: center;<?php echo $balance[$i]['ligne']; ?>"><?php echo $balance[$i]['compte']; ?></td>
                                        <td style="text-align: left; padding-left: 1%;<?php echo $balance[$i]['ligne']; ?>"><?php echo $balance[$i]['libelle']; ?></td>
                                    <?php else: ?>
                                        <td colspan="2" style="text-align: center;<?php echo $balance[$i]['ligne']; ?>"> Total : <?php echo $balance[$i]['compte']; ?></td>
                                    <?php endif; ?>
                                    <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
                                        <?php
//                                if ($balance[$i]['solde'] == 0) {
                                        if ($balance[$i]['debitOuv'] != 0)
                                            echo number_format($balance[$i]['debitOuv'], 3, '.', ' ');
//                                }
                                        ?>
                                    </td>
                                    <td style="text-align: right;background-color: #dff0d8;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
                                        <?php
//                                if ($balance[$i]['solde'] == 0) {
                                        if ($balance[$i]['creditOuv'] != 0)
                                            echo number_format($balance[$i]['creditOuv'], 3, '.', ' ');
//                                }
                                        ?>
                                    </td>
                                    <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
                                        <?php
                                        if ($balance[$i]['debitMois'] != 0)
                                            echo number_format($balance[$i]['debitMois'], 3, '.', ' ');
                                        ?>
                                    </td>
                                    <td style="text-align: right;background-color: #dff0d8;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
                                        <?php
                                        if ($balance[$i]['creditMois'] != 0)
                                            echo number_format($balance[$i]['creditMois'], 3, '.', ' ');
                                        ?>
                                    </td>

                                    <td  <?php if ($_SESSION['dossier_id'] == 1): ?> style="text-align: right;background-color: #fcf8e3;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>;display: none" <?php else: ?>style="text-align: right;background-color: #fcf8e3;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>"<?php endif; ?>>
                                     <!--<td style="text-align: right;background-color: #fcf8e3;padding-right: 1%;<?php // echo $balance[$i]['ligne'];       ?>">-->
                                        <?php
                                        if ($balance[$i]['debitCumulMois'] != 0)
                                            echo number_format($balance[$i]['debitCumulMois'], 3, '.', ' ');
                                        ?>
                                    </td>
                                    <td  <?php if ($_SESSION['dossier_id'] == 1): ?> style="text-align: right;background-color: #dff0d8;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>;display: none" <?php else: ?>style="text-align: right;background-color: #dff0d8;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>"<?php endif; ?>>
            <!--                                <td style="text-align: right;background-color: #dff0d8;padding-right: 1%;<?php // echo $balance[$i]['ligne'];       ?>">-->
                                        <?php
                                        if ($balance[$i]['crediCumultMois'] != 0)
                                            echo number_format($balance[$i]['crediCumultMois'], 3, '.', ' ');
                                        ?>
                                    </td>
                                    <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
                                        <?php
                                        if ($balance[$i]['debiteur'] != 0)
                                            echo number_format($balance[$i]['debiteur'], 3, '.', ' ');
                                        ?>
                                    </td>
                                    <td style="text-align: right;background-color: #dff0d8;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
                                        <?php
                                        if ($balance[$i]['crediteur'] != 0)
                                            echo number_format(abs($balance[$i]['crediteur']), 3, '.', ' ');
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            endif;

                        else:
                           if ($balance[$i]['debitMois'] != 0 || $balance[$i]['creditMois'] != 0 || $balance[$i]['creditOuv'] != 0 || $balance[$i]['debitOuv'] != 0 || $balance[$i]['debiteur'] != 0 || $balance[$i]['crediteur'] != 0): ?>
                            <?php if ($balance[$i]['compte'] != '41' && $balance[$i]['compte'] != '40'): ?>
                                <tr style="cursor: pointer;<?php echo $balance[$i]['ligne']; ?>" id="ligne_<?php echo $i; ?>" compte_id = "<?php echo $balance[$i]['id']; ?>">
                                <?php else: ?>
                                <tr style="cursor: pointer;<?php echo $balance[$i]['ligne']; ?>" id="ligne_<?php echo $i; ?>" compte_id = "<?php echo $balance[$i]['id']; ?>" onclick="ajouterLigne(<?php echo $i; ?>, <?php echo $balance[$i]['id']; ?>)">
                                <?php endif; ?>
                                <?php if (strlen($balance[$i]['compte']) > 2): ?>
                                    <td style="text-align: center;<?php echo $balance[$i]['ligne']; ?>"><?php echo $balance[$i]['compte']; ?></td>
                                    <td style="text-align: left; padding-left: 1%;<?php echo $balance[$i]['ligne']; ?>"><?php echo $balance[$i]['libelle']; ?></td>
                                <?php else: ?>
                                    <td colspan="2" style="text-align: center;<?php echo $balance[$i]['ligne']; ?>"> Total : <?php echo $balance[$i]['compte']; ?></td>
                                <?php endif; ?>
                                <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
                                    <?php
//                                if ($balance[$i]['solde'] == 0) {
                                    if ($balance[$i]['debitOuv'] != 0)
                                        echo number_format($balance[$i]['debitOuv'], 3, '.', ' ');
//                                }
                                    ?>
                                </td>
                                <td style="text-align: right;background-color: #dff0d8;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
                                    <?php
//                                if ($balance[$i]['solde'] == 0) {
                                    if ($balance[$i]['creditOuv'] != 0)
                                        echo number_format($balance[$i]['creditOuv'], 3, '.', ' ');
//                                }
                                    ?>
                                </td>
                                <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
                                    <?php
                                    if ($balance[$i]['debitMois'] != 0)
                                        echo number_format($balance[$i]['debitMois'], 3, '.', ' ');
                                    ?>
                                </td>
                                <td style="text-align: right;background-color: #dff0d8;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
                                    <?php
                                    if ($balance[$i]['creditMois'] != 0)
                                        echo number_format($balance[$i]['creditMois'], 3, '.', ' ');
                                    ?>
                                </td>

                                <td  <?php if ($_SESSION['dossier_id'] == 1): ?> style="text-align: right;background-color: #fcf8e3;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>;display: none" <?php else: ?>style="text-align: right;background-color: #fcf8e3;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>"<?php endif; ?>>
                                 <!--<td style="text-align: right;background-color: #fcf8e3;padding-right: 1%;<?php // echo $balance[$i]['ligne'];      ?>">-->
                                    <?php
                                    if ($balance[$i]['debitCumulMois'] != 0)
                                        echo number_format($balance[$i]['debitCumulMois'], 3, '.', ' ');
                                    ?>
                                </td>
                                <td  <?php if ($_SESSION['dossier_id'] == 1): ?> style="text-align: right;background-color: #dff0d8;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>;display: none" <?php else: ?>style="text-align: right;background-color: #dff0d8;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>"<?php endif; ?>>
        <!--                                <td style="text-align: right;background-color: #dff0d8;padding-right: 1%;<?php // echo $balance[$i]['ligne'];      ?>">-->
                                    <?php
                                    if ($balance[$i]['crediCumultMois'] != 0)
                                        echo number_format($balance[$i]['crediCumultMois'], 3, '.', ' ');
                                    ?>
                                </td>
                                <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
                                    <?php
                                    if ($balance[$i]['debiteur'] != 0)
                                        echo number_format($balance[$i]['debiteur'], 3, '.', ' ');
                                    ?>
                                </td>
                                <td style="text-align: right;background-color: #dff0d8;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
                                    <?php
                                    if ($balance[$i]['crediteur'] != 0)
                                        echo number_format(abs($balance[$i]['crediteur']), 3, '.', ' ');
                                    ?>
                                </td>
                            </tr>
                        <?php
                        endif;
                         endif;
                    endfor;
                    ?>
                    <tr style="cursor: pointer; font-weight: bold;">
                        <td colspan="2" style="text-align: center; font-weight: bold;">Totaux</td>
                        <td style="text-align: center; background-color: #fcf8e3"><?php
                            echo number_format($balance[sizeof($balance) - 1]['solde_colone_1'], 3, '.', ' ');
                            ?></td>
                        <td style="text-align: center;background-color: #dff0d8 "><?php
                            echo number_format($balance[sizeof($balance) - 1]['solde_colone_2'], 3, '.', ' ');
                            ?></td>

                        <td style="text-align: center; background-color: #fcf8e3"><?php
                            echo number_format($balance[sizeof($balance) - 1]['solde_colone_3'], 3, '.', ' ');
                            ?></td>
                        <td style="text-align: center; background-color: #dff0d8">
                            <?php
                            echo number_format($balance[sizeof($balance) - 1]['solde_colone_4'], 3, '.', ' ');
                            ?></td>


                        <td  <?php if ($_SESSION['dossier_id'] == 1): ?> style="text-align: center;background-color: #fcf8e3;display: none "<?php else: ?>style="text-align: center;background-color: #fcf8e3 " <?php endif; ?>>
                            <?php
                            echo number_format($balance[sizeof($balance) - 1]['solde_colone_5'], 3, '.', ' ');
                            ?></td>

                        <td  <?php if ($_SESSION['dossier_id'] == 1): ?> style="text-align: center;background-color: #dff0d8;display: none "<?php else: ?>style="text-align: center;background-color: #dff0d8 " <?php endif; ?>>
                            <?php
                            echo number_format($balance[sizeof($balance) - 1]['solde_colone_6'], 3, '.', ' ');
                            ?></td>

                        <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%; font-weight: bold;">
                            <?php
                            echo number_format($balance[sizeof($balance) - 1]['solde_debit'], 3, '.', ' ');
//                          
                            ?>
                        </td>


                        <td style="text-align: right;background-color: #dff0d8;padding-right: 1%; font-weight: bold;">
                            <?php
                            echo number_format(abs($balance[sizeof($balance) - 1]['solde_credit']), 3, '.', ' ');
//                           
                            ?>
                        </td> 
                    </tr>
                    <tr style="cursor: pointer; font-weight: bold;">
                        <td colspan="2" style="text-align: center; font-weight: bold;">Total Classes Charges</td>
                        <td <?php if ($_SESSION['dossier_id'] == 1): ?>colspan="4" <?php else: ?> colspan="6" <?php endif; ?> style="text-align: right;padding-right: 1%; font-weight: bold;"></td>
                        <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%; font-weight: bold;">
                            <?php
                            if ($balance[sizeof($balance) - 1]['6_debit'] != 0)
                                echo number_format($balance[sizeof($balance) - 1]['6_debit'], 3, '.', ' ');
                            ?>
                        </td>
                        <td style="text-align: right;background-color: #dff0d8;padding-right: 1%; font-weight: bold;">
                            <?php
                            if ($balance[sizeof($balance) - 1]['6_credit'] != 0)
                                echo number_format($balance[sizeof($balance) - 1]['6_credit'], 3, '.', ' ');
                            ?>
                        </td> 
                    </tr>
                    <tr style="cursor: pointer; font-weight: bold;">
                        <td colspan="2" style="text-align: center; font-weight: bold;">Total Classes Produits</td>
                        <td <?php if ($_SESSION['dossier_id'] == 1): ?>colspan="4" <?php else: ?> colspan="6" <?php endif; ?> style="text-align: right;padding-right: 1%; font-weight: bold;"></td>
                        <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%; font-weight: bold;">
                            <?php
                            if ($balance[sizeof($balance)]['7_debit'] != 0)
                                echo number_format($balance[sizeof($balance)]['7_debit'], 3, '.', ' ');
                            ?>
                        </td>
                        <td style="text-align: right;background-color: #dff0d8;padding-right: 1%; font-weight: bold;">
                            <?php
                            if ($balance[sizeof($balance) - 1]['7_credit'] != 0)
                                echo number_format($balance[sizeof($balance) - 1]['7_credit'], 3, '.', ' ');
                            ?>
                        </td> 
                    </tr>
                    <tr style="cursor: pointer; font-weight: bold;">
                        <td colspan="2" style="text-align: center; font-weight: bold;">Résultat de Gestion</td>
                        <td <?php if ($_SESSION['dossier_id'] == 1): ?>colspan="4" <?php else: ?> colspan="6" <?php endif; ?> style="text-align: right;padding-right: 1%; font-weight: bold;"></td>
                        <td colspan="2" style="text-align: right;padding-right: 1%; font-weight: bold;"><?php echo number_format(($balance[sizeof($balance) - 1]['7_credit'] - $balance[sizeof($balance) - 1]['6_debit']), 3, '.', ' '); ?></td>
                    </tr>
                    <tr style="cursor: pointer; font-weight: bold;">
                        <td colspan="2" style="text-align: center; font-weight: bold;">Résultat de Bilan</td>
                        <td <?php if ($_SESSION['dossier_id'] == 1): ?>colspan="4" <?php else: ?> colspan="6" <?php endif; ?> style="text-align: right;padding-right: 1%; font-weight: bold;"></td>
                        <?php if (-$balance[sizeof($balance) - 1]['7_credit'] - $balance[sizeof($balance) - 1]['6_debit'] >= 0): ?>
                            <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%; font-weight: bold;">
                                <?php
//                            if ($balance[sizeof($balance) - 1]['1_5_debit'] != 0)
//                                echo number_format($balance[sizeof($balance) - 1]['1_5_debit'], 3, '.', ' ');

                                echo number_format(-($balance[sizeof($balance) - 1]['7_credit'] - $balance[sizeof($balance) - 1]['6_debit']), 3, '.', ' ');
                                ?>
                            </td>
                            <td style="text-align: right;padding-right: 1%; font-weight: bold;background-color: #dff0d8"></td>
                        <?php else: ?>
                            <td style="text-align: right;padding-right: 1%; font-weight: bold;background-color: #fcf8e3"></td>
                            <td style="text-align: right;background-color: #dff0d8;padding-right: 1%; font-weight: bold;">
                                <?php
//                            if ($balance[sizeof($balance) - 1]['1_5_credit'] != 0)
//                                echo number_format($balance[sizeof($balance) - 1]['1_5_credit'], 3, '.', ' ');
//                         if (-$balance[sizeof($balance) - 1]['7_credit'] - $balance[sizeof($balance) - 1]['6_debit'] != 0)
                                echo number_format(abs(-($balance[sizeof($balance) - 1]['7_credit'] - $balance[sizeof($balance) - 1]['6_debit'])), 3, '.', ' ');
                                ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script  type="text/javascript">

    var index_ligne;
    function ajouterLigne(index, compte) {
        formatLigne(index);
        $.ajax({
            url: '<?php echo url_for('etat/addLigneClasseCompte') ?>',
            async: true,
            data: 'compte_id=' + compte + '&date_debut=' + $('#date_debut').val() + '&date_fin=' + $('#date_fin').val() +
                    '&comptes_non_solde=' + $('#comptes_non_solde').is(':checked') +
                    '&chiffre_1=' + $('#chiffre_1').is(':checked') + '&chiffre_2=' + $('#chiffre_2').is(':checked') +
                    '&chiffre_3=' + $('#chiffre_3').is(':checked') + '&chiffre_4=' + $('#chiffre_4').is(':checked') +
                    '&chiffre_5=' + $('#chiffre_5').is(':checked') + '&chiffre_6=' + $('#chiffre_6').is(':checked') +
                    '&chiffre_7=' + $('#chiffre_7').is(':checked'),
            success: function (data) {
                $('#listBalance > tbody > tr').eq(index).before(data);

                ligneNumber();
                var id = '';
                $('#listBalance tbody tr').each(function () {
                    if ($(this).attr('compte_id') == compte)
                        id = $(this).attr('id');
                });
                $('#' + id).attr('onclick', '');
            }
        });
    }

    function formatLigne(index) {
        $('#listBalance tbody tr').each(function () {
            $(this).css('background', '');
            $(this).css('border-bottom', '');
            $(this).css('border-top', '');
        });
        $('#ligne_' + index).css('background-color', '#F0F0F0');
        $('#ligne_' + index).css('border-bottom', '1px solid #000000');
        $('#ligne_' + index).css('border-top', '1px solid #000000');
        index_ligne = $('#ligne_' + index).attr('index_ligne');
    }

    function ligneNumber() {
        var i = 0;
        $('#listBalance tbody tr').each(function () {
            var id = 'ligne_' + i;
            $(this).attr('id', id);
            $(this).attr('index_ligne', i);
            if ($(this).attr('onclick') != '') {
                var compte_id = $(this).attr('compte_id');
                var on_click = 'ajouterLigne(' + i + ', ' + compte_id + ')';
                $(this).attr('onclick', on_click);
            }
            i++;
        });
    }

</script>