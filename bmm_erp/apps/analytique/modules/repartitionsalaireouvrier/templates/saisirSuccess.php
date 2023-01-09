<div id="sf_admin_container">
    <h1 id="replacediv"> Répartitions Mensuelle 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Traiter les Salaires - <?php echo $repartition->getAnnee(); ?>
        </small>
    </h1>
    <div class="panel-body" style="padding: 0px;">
        <div class="col-md-7">
            <table>
                <tr>
                    <td>Année
                        <input type="text" class="align-center" readonly="true" value="<?php echo $repartition->getAnnee(); ?>" />
                        <input type="hidden" id="repartition_id" value="<?php echo $repartition->getId(); ?>" />
                    </td>
                    <td>Total Jours
                        <input type="text" class="align_right" readonly="true" value="<?php echo $repartition->getJour(); ?>" />
                    </td>
                    <td>Total Montants
                        <input type="text" class="align_right" readonly="true" value="<?php echo number_format($repartition->getMontant(), 3, '.', ' '); ?>" />
                    </td>
                </tr>
            </table>
            <hr>
        </div>
        <div class="col-md-5">
            <table style="margin-bottom: 0px;">
                <thead><tr><th>Comptes Comptables</th></tr></thead>
                <tbody>
                    <?php $repartition_comptes = $repartition->getCompterepartitionsalaireouvrier(); ?>
                    <?php foreach ($repartition_comptes as $repartition_compte): ?>
                        <tr><td><?php echo $repartition_compte->getPlancomptable(); ?></td></tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <legend>Répartition par mois</legend>
            <div class="col-md-6" style="color: #AA3319; font-weight: bold;">
                <label>J : Nombre de jours par mois.</label><br>
                <label>M : Total des salaires par mois.</label>
            </div>
            <div class="col-md-6">
                <a href="<?php echo url_for('repartitionsalaireouvrier/imprimer?id=' . $repartition->getId()) ?>" target="_blank" class="btn btn-success" style="float: right;"><i class="ace-icon fa fa-print"></i> Imprimer</a>
            </div>
            <table id="repartition_ligne">
                <thead>
                    <tr>
                        <th colspan="2" style="width: 13%;">Chantier (Projet)</th>
                        <?php for ($i = 1; $i < 13; $i++): ?>
                            <th style="text-align: center; width: 6.5%;"><?php echo $i; ?></th>
                        <?php endfor; ?>
                        <th style="text-align: center; width: 9%;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $repartition_chantiers = ChantierrepartitionsalaireouvrierTable::getInstance()->getByRepartition($repartition->getId()); ?>
                    <?php foreach ($repartition_chantiers as $repartition_chantier): ?>
                        <tr>
                            <td rowspan="2"><?php echo trim($repartition_chantier->getLibelle()); ?><br>(<?php echo trim($repartition_chantier->getProjet()); ?>)</td>
                            <td style="text-align: center;">J</td>
                            <?php for ($i = 1; $i < 13; $i++): ?>
                                <td style="text-align: right;">
                                    <input mois="j_<?php echo $i; ?>" chantier="j_<?php echo $repartition_chantier->getId(); ?>" id="jour_ligne_<?php echo $repartition_chantier->getId(); ?>_<?php echo $i; ?>" class="align-center" type="text" value="" onchange="saveJour('<?php echo $repartition_chantier->getId(); ?>', '<?php echo $i; ?>')" onkeyup="setJourTotaux('<?php echo $repartition_chantier->getId(); ?>', '<?php echo $i; ?>')" />
                                </td>
                            <?php endfor; ?>
                            <td style="text-align: right;">
                                <input id="total_jour_ligne_<?php echo $repartition_chantier->getId(); ?>" class="align-center" type="text" value="" readonly="true" />
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">M</td>
                            <?php for ($i = 1; $i < 13; $i++): ?>
                                <td>
                                    <input mois="m_t_<?php echo $i; ?>" chantier="m_t_<?php echo $repartition_chantier->getId(); ?>" id="montant_ligne_<?php echo $repartition_chantier->getId(); ?>_<?php echo $i; ?>" class="align_right" type="text" value="" onchange="saveMontant('<?php echo $repartition_chantier->getId(); ?>', '<?php echo $i; ?>')" onkeyup="setMontantTotaux('<?php echo $repartition_chantier->getId(); ?>', '<?php echo $i; ?>')" />
                                </td>
                            <?php endfor; ?>
                            <td>
                                <input id="total_montant_ligne_<?php echo $repartition_chantier->getId(); ?>" class="align_right" type="text" value="" readonly="true" />
                            </td>
                        </tr>
                    <script  type="text/javascript">
    <?php foreach ($repartition_chantier->getLignerepartitionsalaireouvrier() as $ligne): ?>
                            $("#jour_ligne_<?php echo $ligne->getIdChantierrepartition(); ?>_<?php echo $ligne->getMois(); ?>").val('<?php echo $ligne->getJour(); ?>');
                            $("#montant_ligne_<?php echo $ligne->getIdChantierrepartition(); ?>_<?php echo $ligne->getMois(); ?>").val('<?php echo $ligne->getMontant(); ?>');
    <?php endforeach; ?>
                        $("#total_jour_ligne_<?php echo $repartition_chantier->getId(); ?>").val('<?php echo $repartition_chantier->getJour(); ?>');
                        $("#total_montant_ligne_<?php echo $repartition_chantier->getId(); ?>").val('<?php echo $repartition_chantier->getMontant(); ?>');
                    </script>
                <?php endforeach; ?>
                <tr style="background-color: #F7F7F7;">
                    <td style="text-align: center;">Nbre Total de Jours</td>
                    <td style="text-align: center;">J</td>
                    <?php for ($i = 1; $i < 13; $i++): ?>
                        <td>
                            <input chantier="jour" id="total_jour_<?php echo $i; ?>" class="align-center" type="text" value="" readonly="true" />
                        </td>
                    <?php endfor; ?>
                    <td>
                        <input id="total_jour" class="align-center" type="text" value="" readonly="true" />
                    </td>
                </tr>
                <tr style="background-color: #F7F7F7;">
                    <td style="text-align: center;">Total Brut /mois</td>
                    <td style="text-align: center;">M</td>
                    <?php for ($i = 1; $i < 13; $i++): ?>
                        <td>
                            <input chantier="montant" id="total_montant_<?php echo $i; ?>" class="align_right" type="text" value="" readonly="true" />
                        </td>
                    <?php endfor; ?>
                    <td>
                        <input id="total_montant" class="align_right" type="text" value="" readonly="true" />
                    </td>
                </tr>
                <script  type="text/javascript">
<?php for ($i = 1; $i < 13; $i++): ?>
                        var jour_mois = 0;
                        $('[mois="j_<?php echo $i ?>"]').each(function () {
                            if ($(this).val() != '')
                                jour_mois = parseFloat(jour_mois) + parseFloat($(this).val());
                        });

                        var montant_mois = 0;
                        $('[mois="m_t_<?php echo $i ?>"]').each(function () {
                            if ($(this).val() != '')
                                montant_mois = parseFloat(montant_mois) + parseFloat($(this).val());
                        });

                        $("#total_jour_<?php echo $i ?>").val(jour_mois);
                        $("#total_montant_<?php echo $i ?>").val(montant_mois);
<?php endfor; ?>
                    $("#total_jour").val('<?php echo $repartition->getJour(); ?>');
                    $("#total_montant").val('<?php echo $repartition->getMontant(); ?>');
                </script>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script  type="text/javascript">

    function setJourTotaux(id_chantier, mois) {
        var jour_chantier = 0;
        $('[chantier="j_' + id_chantier + '"]').each(function () {
            if ($(this).val() != '')
                jour_chantier = parseFloat(jour_chantier) + parseFloat($(this).val());
        });

        var jour_mois = 0;
        $('[mois="j_' + mois + '"]').each(function () {
            if ($(this).val() != '')
                jour_mois = parseFloat(jour_mois) + parseFloat($(this).val());
        });

        $("#total_jour_ligne_" + id_chantier).val(jour_chantier);
        $("#total_jour_" + mois).val(jour_mois);

        var total_mois = 0;
        $('[chantier="jour"]').each(function () {
            if ($(this).val() != '')
                total_mois = parseFloat(total_mois) + parseFloat($(this).val());
        });
        $("#total_jour").val(total_mois);
    }

    function setMontantTotaux(id_chantier, mois) {
        var montant_chantier = 0;
        $('[chantier="m_t_' + id_chantier + '"]').each(function () {
            if ($(this).val() != '')
                montant_chantier = parseFloat(montant_chantier) + parseFloat($(this).val());
        });

        var montant_mois = 0;
        $('[mois="m_t_' + mois + '"]').each(function () {
            if ($(this).val() != '')
                montant_mois = parseFloat(montant_mois) + parseFloat($(this).val());
        });

        $("#total_montant_ligne_" + id_chantier).val(montant_chantier);
        $("#total_montant_" + mois).val(montant_mois);

        var total_montant_mois = 0;
        $('[chantier="montant"]').each(function () {
            if ($(this).val() != '')
                total_montant_mois = parseFloat(total_montant_mois) + parseFloat($(this).val());
        });
        $("#total_montant").val(total_montant_mois);
    }

    function saveJour(id_chantier, mois) {
        $.ajax({
            url: '<?php echo url_for('repartitionsalaireouvrier/saveJour') ?>',
            data: 'id=' + $("#repartition_id").val() +
                    '&id_chantier=' + id_chantier +
                    '&mois=' + mois +
                    '&jour=' + $("#jour_ligne_" + id_chantier + "_" + mois).val() +
                    '&total_jour_chantier=' + $("#total_jour_ligne_" + id_chantier).val() +
                    '&total_jour=' + $("#total_jour").val(),
            success: function (data) {

            }
        });
    }

    function saveMontant(id_chantier, mois) {
        $.ajax({
            url: '<?php echo url_for('repartitionsalaireouvrier/saveMontant') ?>',
            data: 'id=' + $("#repartition_id").val() +
                    '&id_chantier=' + id_chantier +
                    '&mois=' + mois +
                    '&montant=' + $("#montant_ligne_" + id_chantier + "_" + mois).val() +
                    '&total_montant_chantier=' + $("#total_montant_ligne_" + id_chantier).val() +
                    '&total_montant=' + $("#total_montant").val(),
            success: function (data) {

            }
        });
    }

</script>

<style>
    #repartition_ligne input{padding: 3px 4px 3px; font-size: 12px;}
    #repartition_ligne tbody tr td{padding: 4px;}
</style>