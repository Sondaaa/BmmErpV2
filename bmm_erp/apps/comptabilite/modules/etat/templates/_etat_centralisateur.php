<div class="mws-panel-header">
    <span class="mws-i-24 i-table-1">Journal Centralisateur du Mois <?php echo date('Y'); ?>
        <div style="float:right; cursor:pointer; margin-top:-5px">
            <a target="_blank" class="btn" style="float: right; margin-right: 3%; cursor:pointer;" href="<?php // echo url_for("@imprimeJournalCentralisateur?date_debut=" . $date_periode['0']['date_debut'] . "&date_fin=" . $date_periode['0']['date_fin'] . "&mois_libelle=" . $mois_libelle['0']); ?>"><i class="icol-printer"></i> Imprimer</a>
        </div>
    </span>
</div>
<div class="mws-panel-body">
    <div style="overflow:auto;width:100%;">
    <table id="listBalance" class="mws-datatable-fn mws-table" style="width:200%;">
        <thead>
            <tr>
                <th rowspan="2">Code</th>
                <th rowspan="2">Journal</th>
                <?php for ($h = 0; $h < 12; $h++): ?>
                    <th colspan="2">Mouvement Période <br> Du <?php echo date('d/m/Y', strtotime($date_periode[$h]['date_debut'])) ?> Au <?php echo date('d/m/Y', strtotime($date_periode['0']['date_fin'])) ?></th>
                <?php endfor; ?>
            </tr>
            <tr>
                <?php for ($h = 0; $h < 12; $h++): ?>
                    <th>Débit</th>
                    <th>Crédit</th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <tr style="cursor: pointer;" id="ligne_<?php echo $i; ?>">
                <?php $c_journal = 0; ?>
                <?php for ($j = 0; $j < (sizeof($all_etatJournal) - 1); $j++): ?>
                    <?php $etatJournal = $all_etatJournal[$j]; ?>
                    <?php for ($i = 0; $i < (sizeof($etatJournal) - 1); $i++): ?>
                        <?php $c_journal++; ?>
                        <?php if ($c_journal > $count_journal): ?>
                        </tr>
                        <tr>
                            <?php $c_journal = 0; ?>
                        <?php endif; ?>
                        <td style="text-align: center;"><?php echo $etatJournal[$i]['code']; ?></td>
                        <td style="text-align: left;"><?php echo $etatJournal[$i]['libelle']; ?></td>
                        <td style="text-align: right;">
                            <?php
                            if ($etatJournal[$i]['debitMois'] != 0)
                                echo number_format($etatJournal[$i]['debitMois'], 3, '.', ' ');
                            ?>
                        </td>
                        <td style="text-align: right;">
                            <?php
                            if ($etatJournal[$i]['creditMois'] != 0)
                                echo number_format($etatJournal[$i]['creditMois'], 3, '.', ' ');
                            ?>
                        </td>
                    <?php endfor; ?>
                <?php endfor; ?>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: bold;" colspan="2">Total</td>
                <td style="text-align: right; font-weight: bold;">
                    <?php
                    if ($etatJournal[sizeof($etatJournal) - 1]['totaldebitMois'] != 0)
                        echo number_format($etatJournal[sizeof($etatJournal) - 1]['totaldebitMois'], 3, '.', ' ');
                    ?>
                </td>
                <td style="text-align: right; font-weight: bold;">
                    <?php
                    if ($etatJournal[sizeof($etatJournal) - 1]['totalcreditMois'] != 0)
                        echo number_format($etatJournal[sizeof($etatJournal) - 1]['totalcreditMois'], 3, '.', ' ');
                    ?>
                </td>
                <td style="text-align: right; font-weight: bold;">
                    <?php
                    if ($etatJournal[sizeof($etatJournal) - 1]['totaldebiteur'] != 0)
                        echo number_format($etatJournal[sizeof($etatJournal) - 1]['totaldebiteur'], 3, '.', ' ');
                    if ($valide == 1)
                        echo '0.000';
                    ?>
                </td>
                <td style="text-align: right; font-weight: bold;">
                    <?php
                    if ($etatJournal[sizeof($etatJournal) - 1]['totalcrediteur'] != 0)
                        echo number_format($etatJournal[sizeof($etatJournal) - 1]['totalcrediteur'], 3, '.', ' ');
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="mws-panel-toolbar">
        <div class="btn-toolbar">
            <div class="btn-group" style="width: 100%;">
                <a target="_blank" class="btn" style="float: right; margin-right: 3%; cursor:pointer;" href="<?php // echo url_for("@imprimeJournalCentralisateur?date_debut=" . $date_debut . "&date_fin=" . $date_fin . "&mois_libelle=" . $mois_libelle); ?>"><i class="icol-printer"></i> Imprimer</a>
            </div>
        </div>
    </div>
</div>
</div>

<script  type="text/javascript">

    function formatLigne(index) {
        $('#listBalance tbody tr').each(function() {
            $(this).css('background', '');
            $(this).css('border-bottom', '');
            $(this).css('border-top', '');
        });
        $('#ligne_' + index).css('background', 'repeat-x scroll left bottom #d8d6d6');
        $('#ligne_' + index).css('border-bottom', '1px solid #000000');
        $('#ligne_' + index).css('border-top', '1px solid #000000');
    }

</script>