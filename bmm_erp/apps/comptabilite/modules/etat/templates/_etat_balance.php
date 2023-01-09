<div class="row">
    <div class="col-xs-12">
        <div class="table-header">
            Balance :
            <a target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;" href="<?php echo url_for("etat/imprimeEtatBalance?date_debut=" . $date_debut . "&date_fin=" . $date_fin . "&compte_min=" . trim($compte_min) . "&compte_max=" . trim($compte_max) . "&comptes_non_solde=" . $comptes_non_solde . "&chiffre_1=" . $chiffre_1 . "&chiffre_2=" . $chiffre_2 . "&chiffre_3=" . $chiffre_3 . "&chiffre_4=" . $chiffre_4 . "&chiffre_5=" . $chiffre_5 . "&chiffre_6=" . $chiffre_6 . "&chiffre_7=" . $chiffre_7); ?>">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer</span>
            </a>
        </div>
        <div>
            <table id="listBalance" class="table table-bordered table-hover">
                <thead>
                    <tr style="border-bottom: 1px solid #000000">
                        <th rowspan="2">Compte</th>
                        <th rowspan="2">Libellé</th>
                        <th colspan="2">Soldes Ouverture</th>
                        <th colspan="2">Mouvements Période <br> Du <?php echo date('d/m/Y', strtotime($date_debut)) ?> Au <?php echo date('d/m/Y', strtotime($date_fin)) ?></th>
                        <th colspan="2">Mouvements Cumulés</th>
                        <th colspan="2">Soldes de clôture</th>
                    </tr>
                    <tr style="border-bottom: 1px solid #000000">
                        <th>Débit</th>
                        <th>Crédit</th>
                        <th>Débit</th>
                        <th>Crédit</th>
                        <th>Débit</th>
                        <th>Crédit</th>
                        <th>Débiteur</th>
                        <th>Créditeur</th>
                    </tr>
                    <tr style="border-bottom: 1px solid #000000">
                        <th style="width: 7%;"></th>
                        <th style="width: 20%;">Report</th>
                        <th style="width: 9%;"></th>
                        <th style="width: 9%;"></th>
                        <th style="width: 9%;"></th>
                        <th style="width: 9%;"></th>
                        <th style="width: 9%;"></th>
                        <th style="width: 9%;"></th>
                        <th style="width: 10%;"></th>
                        <th style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < (sizeof($balance) - 1); $i++): ?>
                        <?php // if ($balance[$i]['compte'] != '41' && $balance[$i]['compte'] != '40'): ?>
                        <tr style="cursor: pointer;<?php echo $balance[$i]['ligne']; ?>" id="ligne_<?php echo $i; ?>" compte_id = "<?php echo $balance[$i]['id']; ?>">
                            <?php // else: ?>
                        <!--<tr style="cursor: pointer;color: #0069d6;<?php echo $balance[$i]['ligne']; ?>" id="ligne_<?php echo $i; ?>" compte_id = "<?php echo $balance[$i]['id']; ?>" onclick="ajouterLigne('<?php echo $i; ?>', '<?php echo $balance[$i]['id']; ?>')">-->
                            <?php // endif; ?>
                            <td style="<?php echo $balance[$i]['ligne']; ?>">
                                <?php // if ($balance[$i]['compte'] != '41' && $balance[$i]['compte'] != '40'): ?>
                                <?php echo $balance[$i]['compte']; ?>
                                <?php // else: ?>
    <!--                                    <span  style="font-weight: bold;">
                                <?php // echo $balance[$i]['compte']; ?>
                                    </span>-->
                                <?php // endif; ?>
                            </td>
                            <td style="text-align: left; padding-left: 1%;<?php echo $balance[$i]['ligne']; ?>"><?php echo $balance[$i]['libelle']; ?></td>
                            <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
                                <?php
                                if ($balance[$i]['debitOuv'] != 0)
                                    echo number_format($balance[$i]['debitOuv'], 3, '.', ' ');
                                ?>
                            </td>
                            <td style="text-align: right;background-color: #dff0d8;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
                                <?php
                                if ($balance[$i]['creditOuv'] != 0)
                                    echo number_format($balance[$i]['creditOuv'], 3, '.', ' ');
                                ?>
                            </td>
                            <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
                                <?php
                                if ($balance[$i]['debitMois'] != 0 && $balance[$i]['debitMois'] != null && $balance[$i]['debitMois'] != '')
                                    echo number_format($balance[$i]['debitMois'], 3, '.', ' ');
                                ?>
                            </td>
                            <td style="text-align: right;background-color: #dff0d8;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
                                <?php
                                if ($balance[$i]['creditMois'] != 0)
                                    echo number_format($balance[$i]['creditMois'], 3, '.', ' ');
                                ?>
                            </td>
                            <!--cuml  -->
                            <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
                                <?php
                                if ($balance[$i]['debitCumulMois'] != 0)
                                    echo number_format($balance[$i]['debitCumulMois'], 3, '.', ' ');
                                ?>
                            </td>
                            <td style="text-align: right;background-color: #dff0d8;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
                                <?php
                                if ($balance[$i]['crediCumultMois'] != 0)
                                    echo number_format($balance[$i]['crediCumultMois'], 3, '.', ' ');
                                ?>
                            </td>
                            <!-- fin cumul-->
                            <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
                                <?php
                                if ($balance[$i]['debitOuv'] != 0) {
                                    if ($balance[$i]['debiteur'] != 0)
                                        echo number_format($balance[$i]['debiteur'], 3, '.', ' ');
                                } else
                                    echo number_format($balance[$i]['debiteur_prec'], 3, '.', ' ');
                                ?>
                            </td>
                            <td style="text-align: right;background-color: #dff0d8;padding-right: 1%;<?php echo $balance[$i]['ligne']; ?>">
                                <?php
                                  if ($balance[$i]['debitOuv'] != 0 ){
                                if ($balance[$i]['crediteur'] != 0)
                                    echo number_format($balance[$i]['crediteur'], 3, '.', ' ');
                                  }
                                   else
                                    echo number_format($balance[$i]['crediteur_prec'], 3, '.', ' ');
                                ?>
                            </td>
                        </tr>
                    <?php endfor; ?>

                    <tr style="cursor: pointer; font-weight: bold;">
                        <td colspan="2" style="text-align: center; font-weight: bold;">Total Classes Charges</td>
                        <td colspan="6" style="text-align: right;padding-right: 1%; font-weight: bold;"></td>
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
                        <td colspan="6" style="text-align: right;padding-right: 1%; font-weight: bold;"></td>
                        <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%; font-weight: bold;">
                            <?php
                            if ($balance[sizeof($balance) - 1]['7_debit'] != 0)
                                echo number_format($balance[sizeof($balance) - 1]['7_debit'], 3, '.', ' ');
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
                        <td colspan="6" style="text-align: right;padding-right: 1%; font-weight: bold;"></td>
                        <td colspan="2" style="text-align: right;padding-right: 1%; font-weight: bold;"><?php echo number_format(($balance[sizeof($balance) - 1]['7_credit'] - $balance[sizeof($balance) - 1]['6_debit']), 3, '.', ' '); ?></td>
                    </tr>
                    <tr style="cursor: pointer; font-weight: bold;">
                        <td colspan="2" style="text-align: center; font-weight: bold;">Résultat de Bilan</td>
                        <td colspan="6" style="text-align: right;padding-right: 1%; font-weight: bold;"></td>
                        <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%; font-weight: bold;">
                            <?php
                            if ($balance[sizeof($balance) - 1]['1_5_debit'] != 0)
                                echo number_format($balance[sizeof($balance) - 1]['1_5_debit'], 3, '.', ' ');
                            ?>
                        </td>
                        <td style="text-align: right;background-color: #dff0d8;padding-right: 1%; font-weight: bold;">
                            <?php
                            if ($balance[sizeof($balance) - 1]['1_5_credit'] != 0)
                                echo number_format($balance[sizeof($balance) - 1]['1_5_credit'], 3, '.', ' ');
                            ?>
                        </td>
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
                    '&chiffre_7=' + $('#chiffre_7').is(':checked') + $('#chiffre_8').is(':checked'),
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