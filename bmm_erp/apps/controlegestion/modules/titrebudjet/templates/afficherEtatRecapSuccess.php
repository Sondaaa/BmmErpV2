<div class="col-xs-12">
    <div class="table-header" style="margin-bottom: 0px;">
        RECAPITULATIF DES ENGAGEMENTS BUDGETAIRES : 
        <a target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;" href="<?php echo url_for("titrebudjet/imprimerRecap?mois=" . $mois . '&annee=' . $annee . '&titre=' . $titre); ?>">
            <i class="ace-icon fa fa-print bigger-110"></i>
            <span class="bigger-110 no-text-shadow">Imprimer</span>
        </a>
    </div>
    <table id="liste_recap" class="table table-bordered table-hover">
        <thead>
            <tr style="text-align: center;">
                <th style="width: 40%;">Rubriques</th>
                <th style="width: 12%;text-align: center;">C. Alloués</th>
                <th style="width: 12%;text-align: center;">Engagement</th>
                <th style="width: 12%;text-align: center;">Paiement</th>
                <th style="width: 12%;text-align: center;">R. Engagement</th>
                <th style="width: 12%;text-align: center;">R. Paiement</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $mnt_alloue = 0;
            $mnt_engage = 0;
            $mnt_paiement = 0;
            $relica_engage = 0;
            $relica_paiement = 0;
            $i = 0;
            ?>
            <?php foreach ($listes as $liste): ?>
                <tr id="tr_<?php echo $i; ?>">
                    <td id="td_<?php echo $i; ?>" style="cursor: pointer;" affiche="0" onclick="afficherSousRubrique('<?php echo $liste->getIdRubrique(); ?>', '<?php echo $i; ?>')"><b style="color: #0066cc;"><?php echo $liste->getLigprotitrub()->getNordre(); ?> : </b> <?php echo $liste->getRubrique(); ?></td>
                    <td style="text-align: right;"><?php echo number_format($liste->getMntAllouer(), 3, '.', ' '); ?></td>
                    <td style="text-align: right;"><?php echo number_format($liste->getMntEncager(), 3, '.', ' '); ?></td>
                    <td style="text-align: right;"><?php echo number_format($liste->getMntMaiement(), 3, '.', ' '); ?></td>
                    <td style="text-align: right;"><?php echo number_format($liste->getRelicatEngager(), 3, '.', ' '); ?></td>
                    <td style="text-align: right;"><?php echo number_format($liste->getRelicatPaiment(), 3, '.', ' '); ?></td>
                </tr>
                <?php
                $mnt_alloue = $mnt_alloue + $liste->getMntAllouer();
                $mnt_engage = $mnt_engage + $liste->getMntEncager();
                $mnt_paiement = $mnt_paiement + $liste->getMntMaiement();
                $relica_engage = $relica_engage + $liste->getRelicatEngager();
                $relica_paiement = $relica_paiement + $liste->getRelicatPaiment();
                $i++;
                ?>
            <?php endforeach; ?>
            <tr style="font-size: 14px; background-color: #CDCDCD;">
                <td style="text-align: center;">Total</td>
                <td style="text-align: right;"><?php echo number_format($mnt_alloue, 3, '.', ' '); ?></td>
                <td style="text-align: right;"><?php echo number_format($mnt_engage, 3, '.', ' '); ?></td>
                <td style="text-align: right;"><?php echo number_format($mnt_paiement, 3, '.', ' '); ?></td>
                <td style="text-align: right;"><?php echo number_format($relica_engage, 3, '.', ' '); ?></td>
                <td style="text-align: right;"><?php echo number_format($relica_paiement, 3, '.', ' '); ?></td>
            </tr>
        </tbody>
    </table>
</div>

<input id="count_table" type="hidden" value="<?php echo $i; ?>" />

<script>

    function afficherSousRubrique(id, index) {
        if ($("#td_" + index).attr('affiche') == "0") {
            $("#td_" + index).attr('affiche', '1')
            $.ajax({
                url: '<?php echo url_for('titrebudjet/afficherSousEtatRecap') ?>',
                data: 'mois=<?php echo $mois ?>' +
                        '&titre=' + $('#titre').val() +
                        '&annee=<?php echo $annee ?>' +
                        '&id_rubrique=' + id,
                success: function (data) {
                    var count_ligne = parseInt($("#count_table").val());
                    if (index < count_ligne - 1) {
                        index = parseInt(index) + 1;
                        $('#tr_' + index).before(data);
                    } else {
                        $('#liste_recap tbody').append(data);
                    }
                }
            });
        }
    }

</script>