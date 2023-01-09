<?php $mvt = $mouvements->getFirst(); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Bordereau - <?php echo $mvt->getCaissesbanques()->getLibelle(); ?>
            <a id="button_print" target="_blanc" href="<?php echo url_for('mouvementbanciare/ImprimerBordereau?ids=' . $ids) ?>" class="btn btn-sm btn-success" style="float: right; padding: 5px 9px; display: none;">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer</span>
            </a>
        </div>
        <div>
            <form>
                <div class="sf_admin_list">
                    <?php if ($mvt->getCaissesbanques()->getIdNature() == 1): ?>
                        <table id="list_mouvements" class="table table-bordered table-hover" cellspacing="0">
                            <thead>
                                <tr style="font-size: 16px;">
                                    <th style="width: 10%; text-align: center;">سبب التحويل<br>Motif du Virement</th>
                                    <th style="width: 10%; text-align: center;">مبلغ التحويل<br>Montant du Virement</th>
                                    <th style="width: 20%; text-align: center;">إسم المستفيد<br>Nom du Bénéficiaire</th>
                                    <th style="width: 20%; text-align: center;">رقم معرف الهوية البريدية أو البنكية للمستفيد<br>N° RIP/RIB du Bénéficiaire</th>
                                    <th style="width: 5%; text-align: center;">الرقم<br>Numéro</th>
                                </tr>
                            </thead>
                            <tfoot>
                            </tfoot>
                            <tbody>
                                <?php $total = 0; ?>
                                <?php $i = 1; ?>
                                <?php foreach ($mouvements as $mvt): ?>
                                    <tr>
                                        <td></td>
                                        <td style="text-align: right;">
                                            <?php echo number_format($mvt->getDebit(), 3, '.', ' '); ?>
                                        </td>
                                        <td><?php echo $mvt->getRefbenifi(); ?></td>
                                        <td style="text-align: center;">
                                            <table style="width: 100%;">
                                                <tr><td style="border-left: 1px solid #000; border-right: 1px solid #000; height: 5px;" colspan="<?php echo strlen(trim($mvt->getRibbeni())); ?>"></td></tr>
                                                <tr>
                                                    <?php for ($j = 0; $j < strlen(trim($mvt->getRibbeni())); $j++): ?>
                                                        <?php //if ($mvt->getRibbeni()[$j] != ''): ?>
                                                        <td class="td_rib"><?php echo $mvt->getRibbeni()[$j]; ?></td>
                                                        <?php //endif; ?>
                                                    <?php endfor; ?>
                                                </tr>
                                            </table>
                                            <?php //echo $mvt->getRibbeni(); ?>
                                        </td>
                                        <td style="text-align: center;"><?php echo $i ?></td>
                                    </tr>
                                    <?php $total = $total + $mvt->getDebit(); ?>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                                <tr style="font-size: 16px; background-color: #ECECED;">
                                    <td style="text-align: center;">Total</td>
                                    <td style="text-align: right;"><?php echo number_format($total, 3, '.', ' '); ?></td>
                                    <td style="text-align: center;">المجموع</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                        </table>
                    <?php else: ?>
                        <table id="list_mouvements" class="table table-bordered table-hover" cellspacing="0" style="margin-bottom: 0px;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">N°</th>
                                    <th style="width: 20%"><span style="float: left;">Bénéficiaire</span> <span style="float: right;">المستفيد</span></th>
                                    <th style="width: 20%"><span style="float: left;">RIB</span> <span style="float: right;">البنكي المعرف</span></th>
                                    <th style="width: 10%"><span style="float: left;">Montant</span> <span style="float: right;">المبلغ</span></th>
                                </tr>
                            </thead>
                            <tfoot>
                            </tfoot>
                            <tbody>
                                <?php $total = 0; ?>
                                <?php $i = 1; ?>
                                <?php foreach ($mouvements as $mvt): ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $mvt->getRefbenifi(); ?></td>
                                        <td style="text-align: center;">
                                            <?php echo FormatRib::Show($mvt->getRibbeni()); ?>
                                            <?php //echo $mvt->getRibbeni(); ?>
                                        </td>
                                        <td style="text-align: right;">
                                            <?php echo number_format($mvt->getDebit(), 3, '.', ' '); ?>
                                        </td>
                                    </tr>
                                    <?php $total = $total + $mvt->getDebit(); ?>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                                <tr style="font-size: 16px;">
                                    <td colspan="3" style="text-align: right;">Total <span style="margin-left: 30px;">الجملة</span></td>
                                    <td style="text-align: right;"><?php echo number_format($total, 3, '.', ' '); ?></td>
                                </tr>
                        </table>
                        <table class="table table-bordered table-hover" cellspacing="0">
                            <tr style="font-size: 14px; background-color: #ECECED;">
                                <td style="width: 25%;">Montant total en lettres</td>
                                <td style="width: 50%; text-align: center;" colspan="2"><?php echo chiffreToLettre::cvnbst($total); ?></td>
                                <td style="width: 25%; text-align: right;">المبلغ الجملي بالأحرف</td>
                            </tr>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <button id="button_liste" class="btn btn-default" type="button" style="float: right;" onclick="fermerFinalBordereau()">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                Retour à liste
            </button>

            <input type="hidden" id="total" value="<?php echo $total; ?>" />
            <button id="button_save" class="btn btn-success" type="button" style="float: right; margin-right: 1%;" onclick="saveBodereau()">
                <i class="ace-icon fa fa-save bigger-110"></i>
                Enregistrer
            </button>

            <input type="hidden" value="" id="id_bordereau" />
            <button id="button_valide" class="btn btn-primary" type="button" style="float: right; margin-right: 1%; display: none;" onclick="validerBordereau('<?php echo $mvt->getCaissesbanques()->getIdNature(); ?>')">
                <i class="ace-icon fa fa-check bigger-110"></i>
                Valider
            </button>
        </div>
    </div>
</div>

<script>

    function fermerFinalBordereau() {
        $('#zone_impression').html('');
        $('#zone_impression').fadeOut();
        $('#sf_admin_bar').fadeIn();
        $('#zone_preparation').fadeIn();

        $('.chosen-container').attr("style", "width: 100%;");
        $('.chosen-container').trigger("chosen:updated");
    }

    function saveBodereau() {
        $.ajax({
            url: '<?php echo url_for('bordereauvirement/save') ?>',
            data: 'id_banque=' + $("#mouvementbanciare_filters_id_banque").val() +
                    '&id_type=' + $('#mouvementbanciare_filters_id_type').val() +
                    '&id_nature=' + $('#mouvementbanciare_filters_id_nature').val() +
                    '&total=' + $('#total').val() +
                    '&ids=' + '<?php echo $ids; ?>',
            success: function (data) {
                $('#button_save').fadeOut();
                $('#button_liste').fadeOut();
                $('#button_print').fadeIn();
                $('#button_valide').fadeIn();
                $('#id_bordereau').val(data);
            }
        });
    }

    function validerBordereau(id_nature) {
        if (id_nature == '1') {
            $.ajax({
                url: '<?php echo url_for('bordereauvirement/getOrderVirement') ?>',
                data: 'id_banque=' + $("#mouvementbanciare_filters_id_banque").val(),
                success: function (data) {
                    bootbox.confirm({
                        message: data,
                        buttons: {
                            cancel: {
                                label: "Annuler",
                                className: "btn-sm",
                            },
                            confirm: {
                                label: "Valider",
                                className: "btn-primary btn-sm",
                            }
                        },
                        callback: function (result) {
                            if (result) {
                                goValide();
                            }
                        }
                    });
                }
            });
        } else {
            $.ajax({
                url: '<?php echo url_for('bordereauvirement/validerBordereau') ?>',
                data: 'id=' + $('#id_bordereau').val(),
                success: function (data) {
                    $('#button_valide').fadeOut();
                }
            });
        }
    }

    function goValide() {
        $.ajax({
            url: '<?php echo url_for('bordereauvirement/valider') ?>',
            data: 'id_papierordre=' + $('#id_papierordre').val() +
                    '&id=' + $('#id_bordereau').val(),
            success: function (data) {
                $('#button_valide').fadeOut();
                $('#id_bordereau').val(data);
            }
        });
    }

</script>