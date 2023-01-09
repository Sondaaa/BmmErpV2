<div id="sf_admin_container">
    <h1 id="replacediv"> Répartition des Charges 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Générere les Montants par Unité - <?php echo $repartition->getAnnee(); ?>
        </small>
    </h1>
    <div class="panel-body" style="padding: 0px;">
        <div class="col-md-3">
            <legend>Répartition des Charges</legend>
            <table>
                <tr>
                    <td style="width: 35%;">Année
                        <input type="text" class="align-center" readonly="true" value="<?php echo $repartition->getAnnee(); ?>" />
                        <input type="hidden" id="repartition_id" value="<?php echo $repartition->getId(); ?>" />
                    </td>
                    <td style="width: 65%;">Total Montants
                        <input type="text" id="montant_repartition" class="align_right" readonly="true" value="<?php echo number_format($repartition->getMontant(), 3, '.', ' '); ?>" />
                    </td>
                </tr>
            </table>
            <hr>
        </div>
        <div class="col-md-9">
            <legend>Par Unité 
                <button onclick="getInfo()" class="btn btn-xs btn-white btn-primary" style="float: right;">
                    <i class="ace-icon fa fa-info-circle"></i> Répartition
                </button>
            </legend>
            <table>
                <thead>
                    <tr>
                        <th style="width: 31%;">Unité</th>
                        <th style="width: 17%; text-align: center;">Main d'œuvre</th>
                        <th style="display: none;">jour</th>
                        <th style="width: 17%; text-align: center;">Intrant</th>
                        <th style="width: 17%; text-align: center;">Mécanisation</th>
                        <th style="width: 18%; text-align: center;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $jour_total = 0; ?>
                    <?php $main_total = 0; ?>
                    <?php $intrant_total = 0; ?>
                    <?php $mecanisation_total = 0; ?>
                    <?php $unites = UniterepartitionchargeTable::getInstance()->getByRepartition($repartition->getId()); ?>
                    <?php foreach ($unites as $unite): ?>
                        <?php $unite_total = 0; ?>
                        <tr id="tr_<?php echo $unite->getId(); ?>">
                            <td>
                                <?php echo $unite->getLibelle(); ?>
                                <input type="hidden" name="unite_id" value="<?php echo $unite->getId(); ?>" />
                            </td>
                            <td>
                                <?php $main_jour = 0; ?>
                                <?php $main_montant = 0; ?>
                                <?php foreach ($unite->getParametreuniterepartition() as $param): ?>
                                    <?php if ($param->getIdChantierrepartition() != null): ?>
                                        <?php
                                        $main_montant = $main_montant + $param->getChantierrepartitionsalaireouvrier()->getMontant();
                                        $main_jour = $main_jour + $param->getChantierrepartitionsalaireouvrier()->getJour();
                                        ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <input type="text" class="align_right" readonly="true" name="main" value="<?php echo number_format($main_montant, 3, '.', ' '); ?>">
                                <?php $unite_total = $unite_total + $main_montant; ?>
                                <?php $main_total = $main_total + $main_montant; ?>
                                <?php $jour_total = $jour_total + $main_jour; ?>
                            </td>
                            <td style="display: none;">
                                <input type="text" class="align_right" readonly="true" name="jour" value="<?php echo number_format($main_jour, 0, '.', ' '); ?>">
                            </td>
                            <td>
                                <?php $intrant_montant = 0; ?>
                                <?php foreach ($unite->getParametreuniterepartition() as $param): ?>
                                    <?php if ($param->getIdRapporttravaux() != null): ?>
                                        <?php $intrant_montant = $intrant_montant + $param->getRapporttravaux()->getMontant(); ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <input type="text" class="align_right" readonly="true" name="intrant" value="<?php echo number_format($intrant_montant, 3, '.', ' '); ?>">
                                <?php $unite_total = $unite_total + $intrant_montant; ?>
                                <?php $intrant_total = $intrant_total + $intrant_montant; ?>
                            </td>
                            <td>
                                <?php $mecanisation_montant = 0; ?>
                                <?php $rapport_travaux = RapporttravauxTable::getInstance()->findOneByAnneeAndIdType($repartition->getAnnee(), 2); ?>
                                <?php if ($rapport_travaux != null): ?>
                                    <?php $totaux = RapporttravauxTable::getInstance()->getTotauxByRapport($rapport_travaux->getId()); ?>
                                    <?php foreach ($unite->getParametreuniterepartition() as $param): ?>
                                        <?php if ($param->getTypemecanisation() != null): ?>
                                            <?php
                                            switch (trim($param->getTypemecanisation())) {
                                                case'mre':
                                                    $mecanisation_montant = $mecanisation_montant + $totaux->getTmre();
                                                    break;
                                                case'dps':
                                                    $mecanisation_montant = $mecanisation_montant + $totaux->getTdps();
                                                    break;
                                                case'maint':
                                                    $mecanisation_montant = $mecanisation_montant + $totaux->getTmaint();
                                                    break;
                                                case'bat':
                                                    $mecanisation_montant = $mecanisation_montant + $totaux->getTbat();
                                                    break;
                                                case'dts':
                                                    $mecanisation_montant = $mecanisation_montant + $totaux->getTplant();
                                                    break;
                                            }
                                            ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <input type="text" class="align_right" readonly="true" name="mecanisation" value="<?php echo number_format($mecanisation_montant, 3, '.', ' '); ?>">
                                <?php $unite_total = $unite_total + $mecanisation_montant; ?>
                                <?php $mecanisation_total = $mecanisation_total + $mecanisation_montant; ?>
                            </td>
                            <td style="background-color: #EAFFE0;">
                                <input type="text" class="align_right" readonly="true" name="total" value="<?php echo number_format($unite_total, 3, '.', ' '); ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr style="background-color: #F0F0F0;">
                        <td>Total : </td>
                        <td style="text-align: right;">
                            <input type="text" class="align_right" readonly="true" id="main_total" value="<?php echo number_format($main_total, 3, '.', ' '); ?>">
                        </td>
                        <td style="display: none;">
                            <input type="text" class="align_right" readonly="true" id="jour_total" value="<?php echo number_format($jour_total, 0, '.', ' '); ?>">
                        </td>
                        <td style="text-align: right;">
                            <input type="text" class="align_right" readonly="true" id="intrant_total" value="<?php echo number_format($intrant_total, 3, '.', ' '); ?>">
                        </td>
                        <td style="text-align: right;">
                            <input type="text" class="align_right" readonly="true" id="mecanisation_total" value="<?php echo number_format($mecanisation_total, 3, '.', ' '); ?>">
                        </td>
                        <td style="text-align: right;">
                            <input type="text" class="align_right" readonly="true" id="repartition_total" value="<?php echo number_format($main_total + $intrant_total + $mecanisation_total, 3, '.', ' '); ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <a class="btn btn-white btn-success" href="<?php echo url_for('@repartitioncharge') ?>">Retour à la Liste</a>
            <?php if ($repartition->getMontant() != 0): ?>
                <a href="<?php echo url_for('repartitioncharge/showTableau?id=' . $repartition->getId()) ?>" class="btn btn-white btn-yellow">Tableau de Répartition</a>
                <button class="btn btn-xs btn-primary" id="button_valide" style="height: 34px; font-size: 14px;" onclick="valider()">*Mise à Jour Tableau de Répartition</button>
            <?php else: ?>
            <button class="btn btn-xs btn-primary" id="button_valide" style="height: 34px; font-size: 14px;" onclick="valider()">Valider & Créer Tableau de Répartition</button>
            <?php endif; ?>
        </div>
    </div>
</div>

<script  type="text/javascript">

    $("#montant_repartition").val('<?php echo number_format($main_total + $intrant_total + $mecanisation_total, 3, '.', ' '); ?>');

    function getInfo() {
        $.ajax({
            url: '<?php echo url_for('repartitioncharge/info') ?>',
            data: 'id=' + $("#repartition_id").val(),
            success: function (data) {
                bootbox.dialog({
                    message: data,
                    buttons:
                            {
                                "button":
                                        {
                                            "label": "Ok",
                                            "className": "btn-sm"
                                        }
                            }
                });
            }
        });
    }

    function valider() {
        var ids = '';
        $('[name="unite_id"]').each(function () {
            ids = ids + $(this).val() + ',';
        });

        var main_montants = '';
        $('[name="main"]').each(function () {
            main_montants = main_montants + $(this).val() + ';';
        });

        var main_jours = '';
        $('[name="jour"]').each(function () {
            main_jours = main_jours + $(this).val() + ';';
        });

        var intrant_montants = '';
        $('[name="intrant"]').each(function () {
            intrant_montants = intrant_montants + $(this).val() + ';';
        });

        var mecanisation_montants = '';
        $('[name="mecanisation"]').each(function () {
            mecanisation_montants = mecanisation_montants + $(this).val() + ';';
        });

        var unite_totaux = '';
        $('[name="total"]').each(function () {
            unite_totaux = unite_totaux + $(this).val() + ';';
        });

        $.ajax({
            url: '<?php echo url_for('repartitioncharge/tableau') ?>',
            data: 'id=' + $("#repartition_id").val() +
                    '&ids=' + ids +
                    '&main_total=' + $("#main_total").val() +
                    '&intrant_total=' + $("#intrant_total").val() +
                    '&mecanisation_total=' + $("#mecanisation_total").val() +
                    '&jour_total=' + $("#jour_total").val() +
                    '&total=' + $("#repartition_total").val() +
                    '&main_montants=' + main_montants +
                    '&main_jours=' + main_jours +
                    '&intrant_montants=' + intrant_montants +
                    '&mecanisation_montants=' + mecanisation_montants +
                    '&unite_totaux=' + unite_totaux,
            success: function (data) {
                $("#button_valide").hide();
                bootbox.dialog({
                    message: 'Tableau des répartitions créé avec succès',
                    buttons:
                            {
                                "button":
                                        {
                                            "label": "Ok",
                                            "className": "btn-sm"
                                        }
                            }
                });
            }
        });
    }

</script>