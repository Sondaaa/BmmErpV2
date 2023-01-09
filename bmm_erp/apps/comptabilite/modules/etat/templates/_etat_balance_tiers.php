<div class="row">
    <div class="col-xs-12">
        <div class="table-header">
            <?php $compte = PlandossiercomptableTable::getInstance()->find($compte_min); ?>
            Balance : <?php echo trim($compte->getNumerocompte()) ?> - <?php echo trim($compte->getLibelle()) ?>
            <a target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;" href="<?php echo url_for("etat/imprimeEtatBalanceTiers?date_debut=" . $date_debut . "&date_fin=" . $date_fin . "&compte_min=" . $compte_min . "&comptes_non_solde=" . $comptes_non_solde); ?>">
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
                        <th colspan="2">Mouvement Ouverture</th>
                        <th colspan="2">Mouvement Période <br> Du <?php echo date('d/m/Y', strtotime($date_debut)) ?> Au <?php echo date('d/m/Y', strtotime($date_fin)) ?></th>
                        <th colspan="2">Soldes</th>
                    </tr>
                    <tr style="border-bottom: 1px solid #000000">
                        <th>Débit</th>
                        <th>Crédit</th>
                        <th>Débit</th>
                        <th>Crédit</th>
                        <th>Débiteur</th>
                        <th>Créditeur</th>
                    </tr>
                    <tr style="border-bottom: 1px solid #000000">
                        <th style="width: 7%;"></th>
                        <th style="width: 37%;">Report</th>
                        <th style="width: 9%;"></th>
                        <th style="width: 9%;"></th>
                        <th style="width: 9%;"></th>
                        <th style="width: 9%;"></th>
                        <th style="width: 10%;"></th>
                        <th style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_debit = 0;
                    $total_credit = 0;
                    ?>
                    <?php for ($i = 0; $i < (sizeof($balance) - 1); $i++): ?>
                    <tr style="cursor: pointer;" id="ligne_<?php echo $i; ?>" compte_id = "<?php echo $balance[$i]['id']; ?>" onclick="formatLigne('<?php echo $i; ?>')">
                            <td style="text-align: center;">
                                <?php echo $balance[$i]['compte']; ?>
                            </td>
                            <td style="text-align: left; padding-left: 1%;"><?php echo $balance[$i]['libelle']; ?></td>
                            <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%;">
                                <?php
                                if ($balance[$i]['debitOuv'] != 0)
                                    echo number_format($balance[$i]['debitOuv'], 3, '.', ' ');
                                ?>
                            </td>
                            <td style="text-align: right;background-color: #dff0d8;padding-right: 1%;">
                                <?php
                                if ($balance[$i]['creditOuv'] != 0)
                                    echo number_format($balance[$i]['creditOuv'], 3, '.', ' ');
                                ?>
                            </td>
                            <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%;">
                                <?php
                                if ($balance[$i]['debitMois'] != 0)
                                    echo number_format($balance[$i]['debitMois'], 3, '.', ' ');
                                ?>
                            </td>
                            <td style="text-align: right;background-color: #dff0d8;padding-right: 1%;">
                                <?php
                                if ($balance[$i]['creditMois'] != 0)
                                    echo number_format($balance[$i]['creditMois'], 3, '.', ' ');
                                ?>
                            </td>
                            <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%;">
                                <?php
                                if ($balance[$i]['debiteur'] != 0) {
                                    echo number_format($balance[$i]['debiteur'], 3, '.', ' ');
                                    $total_debit = $total_debit + $balance[$i]['debiteur'];
                                }
                                ?>
                            </td>
                            <td style="text-align: right;background-color: #dff0d8;padding-right: 1%;">
                                <?php
                                if ($balance[$i]['crediteur'] != 0) {
                                    echo number_format($balance[$i]['crediteur'], 3, '.', ' ');
                                    $total_credit = $total_credit + $balance[$i]['crediteur'];
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endfor; ?>
                    <tr style="cursor: pointer; font-weight: bold;">
                        <td colspan="2" style="text-align: center; font-weight: bold;">Total</td>
                        <td colspan="4"></td>
                        <td style="text-align: right;background-color: #fcf8e3;padding-right: 1%; font-weight: bold;">
                            <?php echo number_format($total_debit, 3, '.', ' '); ?>
                        </td>
                        <td style="text-align: right;background-color: #dff0d8;padding-right: 1%; font-weight: bold;">
                            <?php echo number_format($total_credit, 3, '.', ' '); ?>
                        </td>
                    </tr>
                    <tr style="cursor: pointer; font-weight: bold;">
                        <td style="text-align: center; font-weight: bold;">
                            <?php echo $balance[sizeof($balance) - 1]['compte_tiers']; ?>
                        </td>
                        <td style="text-align: left; padding-left: 1%;"><?php echo $balance[sizeof($balance) - 1]['libelle_tiers']; ?></td>
                        <td colspan="4"></td>
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

    function formatLigne(index) {
        $('#listBalance tbody tr').each(function () {
            $(this).css('background', '');
            $(this).css('border-bottom', '');
            $(this).css('border-top', '');
        });
        $('#ligne_' + index).css('background-color', '#F0F0F0');
        $('#ligne_' + index).css('border-bottom', '1px solid #000000');
        $('#ligne_' + index).css('border-top', '1px solid #000000');
    }

    function ligneNumber() {
        var i = 0;
        $('#listBalance tbody tr').each(function () {
            var id = 'ligne_' + i;
            $(this).attr('id', id);
            $(this).attr('index_ligne', i);
            i++;
        });
    }

</script>