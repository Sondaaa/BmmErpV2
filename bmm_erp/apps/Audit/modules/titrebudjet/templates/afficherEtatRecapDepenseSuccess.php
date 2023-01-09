<div class="col-xs-12">
    <div class="table-header" style="margin-bottom: 0px;">
        RECAPITULATIF DES DEPENSES : 
        <a target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;" href="<?php echo url_for("titrebudjet/imprimerRecapDepense?mois=" . $mois . '&annee=' . $annee . '&titre=' . $titre); ?>">
            <i class="ace-icon fa fa-print bigger-110"></i>
            <span class="bigger-110 no-text-shadow">Imprimer</span>
        </a>
    </div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th rowspan="2" style="width: 38%; text-align: center; vertical-align: middle;">Rubriques</th>
                <th colspan="3" style="text-align: center;">PAIEMENTS DES ENGAGEMENTS <?php echo $annee; ?></th>
                <th rowspan="2" style="width: 12%; text-align: center; vertical-align: middle;">Paiement de Engagements Antérieurs</th>
                <th rowspan="2" style="width: 13%; text-align: center; vertical-align: middle;">Total Général</th>
            </tr>
            <tr>
                <th style="width: 12%;text-align: center;">Par Caisse</th>
                <th style="width: 12%;text-align: center;">Par Banque</th>
                <th style="width: 13%;text-align: center;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $mnt_caisse = 0;
            $mnt_banque = 0;
            $mnt_total = 0;
            $mnt_ant = 0;
            $all_total = 0;
            $i = 0;
            ?>
            <?php foreach ($listes as $liste): ?>
                <tr id="tr_<?php echo $i; ?>">
                    <td id="td_<?php echo $i; ?>" style="cursor: pointer;" affiche="0" onclick="afficherSousRubrique('<?php echo $liste->getIdRubrique(); ?>', '<?php echo $i; ?>')"><b style="color: #0066cc;"><?php echo $liste->getLigprotitrub()->getNordre(); ?> : </b> <?php echo $liste->getRubrique(); ?></td>
                    <td style="text-align: right;"><?php echo number_format($liste->getMntCaisse(), 3, '.', ' '); ?></td>
                    <td style="text-align: right;"><?php echo number_format($liste->getMntBanque(), 3, '.', ' '); ?></td>
                    <td style="text-align: right; color: #3BB014;"><?php echo number_format($liste->getMntCaisse() + $liste->getMntBanque(), 3, '.', ' '); ?></td>
                    <td style="text-align: right;"><?php echo number_format($liste->getMntAnt(), 3, '.', ' '); ?></td>
                    <td style="text-align: right; color: #CC1F00;"><?php echo number_format($liste->getMntCaisse() + $liste->getMntBanque() + $liste->getMntAnt(), 3, '.', ' '); ?></td>
                </tr>
                <?php
                $mnt_caisse = $mnt_caisse + $liste->getMntCaisse();
                $mnt_banque = $mnt_banque + $liste->getMntBanque();
                $mnt_total = $mnt_total + $liste->getMntCaisse() + $liste->getMntBanque();
                $mnt_ant = $mnt_ant + $liste->getMntAnt();
                $all_total = $all_total + $liste->getMntCaisse() + $liste->getMntBanque() + $liste->getMntAnt();
                $i++;
                ?>
            <?php endforeach; ?>
            <tr style="font-size: 14px; background-color: #CDCDCD;">
                <td style="text-align: center;">Total</td>
                <td style="text-align: right;"><?php echo number_format($mnt_caisse, 3, '.', ' '); ?></td>
                <td style="text-align: right;"><?php echo number_format($mnt_banque, 3, '.', ' '); ?></td>
                <td style="text-align: right;"><?php echo number_format($mnt_total, 3, '.', ' '); ?></td>
                <td style="text-align: right;"><?php echo number_format($mnt_ant, 3, '.', ' '); ?></td>
                <td style="text-align: right;"><?php echo number_format($all_total, 3, '.', ' '); ?></td>
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
                url: '<?php echo url_for('titrebudjet/afficherSousEtatRecapDepense') ?>',
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