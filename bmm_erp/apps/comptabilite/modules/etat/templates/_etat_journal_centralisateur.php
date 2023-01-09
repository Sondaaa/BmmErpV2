<div class="mws-panel-header">
    <?php $ex = ExerciceTable::getInstance()->findOneById($exercice) ?>
<!--    <span class="mws-i-24 i-table-1">Journal Centralisateur de l'exercice  <?php echo $ex->getLibelle() ?>
        <div style="float:right; cursor:pointer; margin-top:-5px">
            <a target="_blank" class="btn" style="float: right; margin-right: 3%; cursor:pointer;" href="<?php // echo url_for("@imprimeJournalCentralisateur?date_debut=" . $date_periode['0']['date_debut'] . "&date_fin=" . $date_periode['0']['date_fin'] . "&mois_libelle=" . $mois_libelle['0']);        ?>"><i class="icol-printer"></i> Imprimer</a>
        </div>
    </span>-->
</div>
<?php
$date_periode = array();
for ($i = 1; $i < 13; $i++) {
    if ($i < 10)
        $mois = '0' . $i;
    else
        $mois = $i;
    $exerc = ExerciceTable::getInstance()->findOneById($exercice);
    $annee = $exerc->getLibelle();
    $date_debut_mois = $annee . '-' . $mois . '-01';
    $date_fin_mois = date('Y-m-d', strtotime(date('Y-m-d', strtotime($date_debut_mois . ' +1 month')) . ' -1 day'));
    $date_periode[$i - 1]['date_debut'] = $date_debut_mois;
    $date_periode[$i - 1]['date_fin'] = $date_fin_mois;
}
?>
<input type="hidden" id="id_exercice" value="<?php echo $exercice; ?>">
<div class="row">
    <div class="col-xs-12">
        <div class="table-header" style="margin-bottom: 0px;">
            Etat du Journal Centralisateur - Exercice <?php echo $ex->getLibelle(); ?>
            <a target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;margin-left: 3px" href="<?php echo url_for("etat/imprimeEtatCentralisateur"). '?id_exercie=' .$exercice; ?>">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer</span>
            </a>
<!--             <a target="_blank" class="btn btn-sm btn-default" style="float: right; padding: 5px 12px;" href="<?php echo url_for("etat/exporterEtatCentralisateurExcel"). '?id_exercie=' .$exercice; ?>">
                 <i class="ace-icon fa fa-file-excel-o"></i> 
                <span class="bigger-110 no-text-shadow">Exporter</span>
            </a>-->
        </div>
        <div class="col-xs-12" style="border: 1px solid #307ECC; padding-top: 10px;">
            <div id="table-scroll" class="table-scroll" style="margin-bottom: 10px;">
                <div class="mws-panel-body">
                    <div style="overflow:auto;width:100%;">
                        <div class="table-wrap">
                            <table id="listBalance" class="mws-datatable-fn mws-table main-table">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="fixed-side" scope="col">Journal Comptable</th>
                                        <?php for ($h = 0; $h < 12; $h++): ?>
                                            <th colspan="2" style="text-align: center;">Mouvement Période <br> Du <?php echo date('d/m/Y', strtotime($date_periode[$h]['date_debut'])) ?> Au <?php echo date('d/m/Y', strtotime($date_periode[$h]['date_fin'])) ?></th>
                                        <?php endfor; ?>
                                    </tr>
                                    <tr>
                                        <th style="min-width: 80px;" class="fixed-side" scope="col">Code</th>
                                        <th style="min-width: 150px;" class="fixed-side" scope="col">Libellé</th>
                                        <?php for ($h = 0; $h < 12; $h++): ?>
                                            <th style="min-width: 110px;">Débit</th>
                                            <th style="min-width: 110px;">Crédit</th>
                                        <?php endfor; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($journals_interval as $journal_interval): ?>
                                        <tr style="cursor: pointer;" id="ligne_<?php echo $i; ?>">
                                            <td style="text-align: center;" class="fixed-side" scope="col">
                                                <a target="_blank" href="<?php echo url_for("etat/imprimeJournalSeul?" . 'id=' . $journal_interval->getId() . '&date_debut=' . $date_debut . '&date_fin=' . $date_fin); ?>">
                                                    <?php echo $journal_interval->getCode(); ?>
                                                </a>
                                            </td>
                                            <td style="text-align: left;" class="fixed-side" scope="col">
                                                <a target="_blank" href="<?php echo url_for("etat/imprimeJournalSeul?" . 'id=' . $journal_interval->getId() . '&date_debut=' . $date_debut . '&date_fin=' . $date_fin); ?>">
                                                    <?php echo $journal_interval->getLibelle(); ?>
                                                </a>
                                            </td>
                                            <?php $count_td = 0; ?>
                                            <?php for ($j = 0; $j < (sizeof($all_etatJournal)); $j++): ?>
                                                <?php $etatJournal = $all_etatJournal[$j]; ?>
                                                <?php for ($i = 0; $i < sizeof($etatJournal); $i++): ?>
                                                    <?php if ($etatJournal[$i]['id'] == $journal_interval->getId()): ?>
                                                        <?php
                                                        $url = '';
                                                        $url.= 'id=' . $journal_interval->getId();
//                                                $url.= '&date_debut=' . $date_periode[$count_td][$date_debut_mois];
//                                                $url.= '&date_fin=' . $date_periode[$count_td][$date_fin_mois];
                                                        ?>
                                                        <td style="text-align: right;">
                                                            <?php if ($etatJournal[$i]['debitMois'] != 0): ?>
                                                                <a target="_blank" href="<?php echo url_for("etat/imprimeJournalSeul?" . $url); ?>">
                                                                    <?php echo number_format($etatJournal[$i]['debitMois'], 3, '.', ' '); ?>
                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td style="text-align: right;">
                                                            <?php if ($etatJournal[$i]['creditMois'] != 0) : ?>
                                                                <a target="_blank" href="<?php echo url_for("etat/imprimeJournalSeul?" . $url); ?>">
                                                                    <?php echo number_format($etatJournal[$i]['creditMois'], 3, '.', ' '); ?>
                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                        <?php $count_td++; ?>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            <?php endfor; ?>
                                            <?php for ($h = $count_td; $h < 12; $h++): ?>
                                                <td></td>
                                                <td></td>
                                            <?php endfor; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr style="background: repeat-x #F2F2F2;">
                                        <td style="text-align: center; font-weight: bold;" colspan="2" class="fixed-side" scope="col">Total</td>
                                        <?php for ($h = 0; $h < 12; $h++): ?>
                                            <td style="text-align: right; font-weight: bold;">
                                                <?php
                                                if ($total_all_etatJournal[$h]['debitMois'] != 0)
                                                    echo number_format($total_all_etatJournal[$h]['debitMois'], 3, '.', ' ');
                                                ?>
                                            </td>
                                            <td style="text-align: right; font-weight: bold;">
                                                <?php
                                                if ($total_all_etatJournal[$h]['creditMois'] != 0)
                                                    echo number_format($total_all_etatJournal[$h]['creditMois'], 3, '.', ' ');
                                                ?>
                                            </td>
                                        <?php endfor; ?>
                                    </tr>
                                </tbody>
                            </table>
                            <!--                            <div class="mws-panel-toolbar">
                                                            <div class="btn-toolbar">
                                                                <div class="btn-group" style="width: 100%;">
                                                                    <a target="_blank" class="btn" style="float: right; margin-right: 3%; cursor:pointer;" href="<?php // echo url_for("@imprimeJournalCentralisateur?date_debut=" . $date_debut . "&date_fin=" . $date_fin . "&mois_libelle=" . $mois_libelle);  ?>"><i class="icol-printer"></i> Imprimer</a>
                                                                </div>
                                                            </div>
                                                        </div>-->
                        </div>
                    </div>
                </div>
            </div>
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
        $('#ligne_' + index).css('background', 'repeat-x scroll left bottom #d8d6d6');
        $('#ligne_' + index).css('border-bottom', '1px solid #000000');
        $('#ligne_' + index).css('border-top', '1px solid #000000');
    }

</script>