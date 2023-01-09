<div id="zone_preparation">
    <div class="row">
        <div class="col-xs-12">
            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
            <div class="table-header">
                Résultat de recherche
            </div>
            <div>
                <form>
                    <div class="sf_admin_list">
                        <table id="list_mouvements" class="table table-bordered table-hover" cellspacing="0">
                            <thead>
                                <tr>
                                    <th><input id="selecte_all" type="checkbox" /></th>
                                    <th>N°</th>
                                    <th style="width: 200px">date</th>
                                    <th style="width: 200px">Réf.Ordonnancement</th>
                                    <th style="width: 200px">Nom d'opération</th>
                                    <th style="width: 200px">Bénéficiaire</th>
                                    <th style="width: 200px">N°.Chèque</th>
                                    <th style="width: 200px">Montant</th>
                                </tr>
                            </thead>
                            <tfoot>
                            </tfoot>
                            <tbody>
                                <?php if ($mouvements->count() == 0): ?>
                                    <tr>
                                        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="8">Pas de mouvements</td>
                                    </tr>
                                    <?php $max_selected_mouvements = 0; ?>
                                    <?php
                                else:
                                    $mvt = $mouvements->getFirst();
                                    if ($mvt->getCaissesbanques()->getIdNature() == 1):
                                        $max_selected_mouvements = 13;
                                    else:
                                        $max_selected_mouvements = 4;
                                    endif;
                                    ?>
                                <?php endif; ?>
                                <?php foreach ($mouvements as $mvt): ?>
                                    <?php $montant = 0; ?>
                                    <?php if (in_array($mvt->getTypeoperation()->getCodeop(), array('CH-E', 'VR-E', 'RT'))): ?>
                                        <?php if ($mvt->getDebit() != null): ?>
                                            <?php $montant = $mvt->getDebit(); ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if ($mvt->getCredit() != null): ?>
                                            <?php $montant = $mvt->getCredit(); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <tr class="row_mouvement" id="row_<?php echo $mvt->getId(); ?>">
                                        <td><input id="check_<?php echo $mvt->getId(); ?>" value="<?php echo $mvt->getId(); ?>" montant="<?php echo $montant; ?>" type="checkbox" class="list_checbox_mouvement"/></td>
                                        <td><?php echo $mvt->getNumero(); ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($mvt->getDateoperation())); ?></td>
                                        <td><?php echo $mvt->getReford(); ?></td>
                                        <td><?php echo $mvt->getNomoperation(); ?></td>
                                        <td><?php echo $mvt->getRibbeni(); ?><br><?php echo $mvt->getRefbenifi(); ?></td>
                                        <td><?php echo $mvt->getInstrumentpaiment()->getLibelle(); ?><br><?php echo $mvt->getPapiercheque()->getRefpapier(); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($montant, 3, '.', ' '); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="clearfix" style="font-size: 16px;">
                <span id="nombre_mouvement" style="margin-left: 20px;">0 </span> mouvement(s) sélectionné(s)
                <span id="total_mouvement" style="float: right;">Total : 0.000 </span>
            </div>
            <button class="btn btn-primary" type="button" style="float: right; margin-top: 20px;" onclick="passerBordereau()">
                <i class="ace-icon fa fa-file-text bigger-110"></i>
                Passer Bordereau
            </button>
        </div>
    </div>
</div>

<div id="zone_impression" style="display: none;"></div>

<script>

    var count_mouvements = 0;
    $('.list_checbox_mouvement').change(function () {
        if ($(this).is(":checked")) {
            var id = $(this).val();
            $('#row_' + id).css('background', '#E7E7E7');
            $('#row_' + id).css('border-bottom', '1px solid #000000');
            $('#row_' + id).css('border-top', '1px solid #000000');
        } else {
            var id = $(this).val();
            $('#row_' + id).css('background', '');
            $('#row_' + id).css('border-bottom', '');
            $('#row_' + id).css('border-top', '');
        }
        $('#nombre_mouvement').html($('.list_checbox_mouvement[type=checkbox]:checked').length);
        count_mouvements = $('.list_checbox_mouvement[type=checkbox]:checked').length;
        setTotal();
    });

    $('#selecte_all').change(function () {
        if ($('#selecte_all').is(':checked')) {
            $('.list_checbox_mouvement[type=checkbox]').prop('checked', true);

            $('.row_mouvement').css('background', '#E7E7E7');
            $('.row_mouvement').css('border-bottom', '1px solid #000000');
            $('.row_mouvement').css('border-top', '1px solid #000000');
        } else {
            $('.list_checbox_mouvement[type=checkbox]').prop('checked', false);

            $('.row_mouvement').css('background', '');
            $('.row_mouvement').css('border-bottom', '');
            $('.row_mouvement').css('border-top', '');
        }
        $('#nombre_mouvement').html($('.list_checbox_mouvement[type=checkbox]:checked').length);
        count_mouvements = $('.list_checbox_mouvement[type=checkbox]:checked').length;
        setTotal();
    });

    function setTotal() {
        var total = 0;
        $('.list_checbox_mouvement[type=checkbox]:checked').each(function () {
            total = parseFloat(parseFloat(total) + parseFloat($(this).attr('montant')));
        });
        var option = {
            minimumFractionDigits: 3
        };
        var locale = 'fr-FR';
        var formatter = new Intl.NumberFormat(locale, option);
        $('#total_mouvement').html('Total : ' + formatter.format(total));
    }

    function passerBordereau() {
        var mouvements = '';
        $('.list_checbox_mouvement[type=checkbox]:checked').each(function () {
            mouvements += $(this).val() + ',';
        });
        if ((mouvements != '')) {
            if (count_mouvements <= <?php echo $max_selected_mouvements ?>) {
                $.ajax({
                    url: '<?php echo url_for('@getFinalBordereau') ?>',
                    data: 'ids=' + mouvements,
                    success: function (data) {
                        $('#zone_impression').html(data);
                        $('#sf_admin_bar').fadeOut();
                        $('#zone_preparation').fadeOut();
                        $('#zone_impression').fadeIn();
                    }
                });
            } else {
                bootbox.dialog({
                    message: "<span class='bigger-160' style='margin:20px;color:#b31531;'>Il faut choisir au plus <?php echo $max_selected_mouvements ?> mouvement !</span>",
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
        } else {
            bootbox.dialog({
                message: "<span class='bigger-160' style='margin:20px;color:#b31531;'>Il faut choisir au moins un mouvement !</span>",
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
    }

</script>