<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">Résultat de recherche</div>
        <div>
            <form>
                <div class="sf_admin_list">
                    <table id="list_mouvements" class="table table-bordered table-hover" cellspacing="0" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th style="width: 50px">N°</th>
                                <th style="width: 100px">date</th>
                                <th style="width: 100px">Réf.Ord.</th>
                                <th style="width: 200px">Nom d'opération</th>
                                <th style="width: 200px">Bénéficiaire</th>
                                <th style="width: 200px">N°.Chèque</th>
                                <th style="width: 100px">Débit</th>
                                <th style="width: 100px">Crédit</th>
                                <th style="width: 150px">Solde</th>
                                <th style="width: 100px">Rapprochement</th>
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                        <tbody>
                            <?php if ($mouvements->count() == 0): ?>
                                <tr>
                                    <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="8">Pas de mouvements</td>
                                </tr>
                            <?php else: ?>
                                <?php $solde_0 = 0; ?>
                                <?php $total_debit = 0; ?>
                                <?php $total_credit = 0; ?>
                                <?php $solde_courant = 0; ?>
                                <?php $solde_initiale = $mouvements->getFirst(); ?>
                                <tr>
                                    <td> - </td>
                                    <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($solde_initiale->getDateoperation() . ' - 1 days')); ?></td>
                                    <td colspan="2"></td>
                                    <td>Solde au <span style="float: right;"><?php echo date('d/m/Y', strtotime($solde_initiale->getDateoperation() . ' - 1 days')); ?></span></td>
                                    <td colspan="3"></td>
                                    <td style="text-align: right;">
                                        <?php if ($solde_initiale->getCredit() != null): ?>
                                            <?php $solde_courant = $solde_initiale->getSolde() - $solde_initiale->getCredit(); ?>
                                            <?php echo number_format($solde_courant, 3, '.', ' '); ?>
                                        <?php else: ?>
                                            <?php $solde_courant = $solde_initiale->getSolde() + $solde_initiale->getDebit(); ?>
                                            <?php echo number_format($solde_courant, 3, '.', ' '); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td></td>
                                </tr>
                                <?php $solde_0 = $solde_courant; ?>
                                <?php foreach ($mouvements as $mvt): ?>
                                    <tr id="ligne_<?php echo $mvt->getId(); ?>">
                                        <td><?php echo $mvt->getNumero(); ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($mvt->getDateoperation())); ?></td>
                                        <td><?php echo $mvt->getReford(); ?></td>
                                        <td><?php echo $mvt->getNomoperation(); ?></td>
                                        <td><?php echo $mvt->getRibbeni(); ?><br><?php echo $mvt->getRefbenifi(); ?></td>
                                        <td><?php echo $mvt->getInstrumentpaiment()->getLibelle(); ?><br><?php echo $mvt->getPapiercheque()->getRefpapier(); ?></td>
                                        <?php $montant_debit = 0; ?>
                                        <td style="text-align: right;">
                                            <?php if ($mvt->getDebit() != null): ?>
                                                <?php if ($mvt->getAnnule() == false): ?>
                                                    <?php $solde_courant = $solde_courant - $mvt->getDebit(); ?>
                                                    <?php $total_debit = $total_debit + $mvt->getDebit(); ?>
                                                    <?php $montant_debit = $mvt->getDebit(); ?>
                                                <?php endif; ?>
                                                <?php echo number_format($mvt->getDebit(), 3, '.', ' '); ?>
                                            <?php endif; ?>
                                        </td>
                                        <?php $montant_credit = 0; ?>
                                        <td style="text-align: right;">
                                            <?php if ($mvt->getCredit() != null): ?>
                                                <?php if ($mvt->getAnnule() == false): ?>
                                                    <?php $solde_courant = $solde_courant + $mvt->getCredit(); ?>
                                                    <?php $total_credit = $total_credit + $mvt->getCredit(); ?>
                                                    <?php $montant_credit = $mvt->getCredit(); ?>
                                                <?php endif; ?>
                                                <?php echo number_format($mvt->getCredit(), 3, '.', ' '); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td style="text-align: right;"><?php echo number_format($solde_courant, 3, '.', ' '); ?></td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <?php if ($mvt->getAnnule() == false): ?>
                                                <input id="<?php echo $mvt->getId(); ?>" type="checkbox" data-mouvement="1" value="ligne_<?php echo $mvt->getId(); ?>" montant_debit="<?php echo $montant_debit; ?>" montant_credit="<?php echo $montant_credit; ?>" class="list_checbox_mouvement disabledbutton" <?php if ($mvt->getRapproche() == true): ?>checked="true"<?php endif; ?> />

                                                <?php //if ($mvt->getRapproche() == false): ?>
<!--                                                    <button class="btn btn-default btn-xs" type="button" onclick="annulerMouvement('<?php //echo $mvt->getId(); ?>')" style="margin-left: 10px;">
                                                        <i class="ace-icon fa fa-ban bigger-110 icon-only"></i>
                                                    </button>-->
                                                <?php //endif; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php if ($mvt->getMntenoper() != null): ?>
                                        <tr id="ligne_bis_<?php echo $mvt->getId(); ?>">
                                            <td><?php echo $mvt->getNumero() . ".1" ?></td>
                                            <td colspan="5"><?php echo $mvt->getTypeoperation()->getLibelle(); ?></td>
                                            <td style="text-align: right;">
                                                <?php if ($mvt->getAnnule() == false): ?>
                                                    <?php $solde_courant = $solde_courant - $mvt->getMntenoper(); ?>
                                                    <?php $total_debit = $total_debit + $mvt->getMntenoper(); ?>
                                                <?php endif; ?>
                                                <?php echo number_format($mvt->getMntenoper(), 3, '.', ' '); ?>
                                            </td>
                                            <td></td>
                                            <td style="text-align: right;"><?php echo number_format($solde_courant, 3, '.', ' '); ?></td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input id="<?php echo $mvt->getId(); ?>" type="checkbox" data-mouvement="0" value="ligne_bis_<?php echo $mvt->getId(); ?>" montant_debit="<?php echo $mvt->getMntenoper(); ?>" montant_credit="0" class="list_checbox_mouvement disabledbutton" <?php if ($mvt->getRapprochecommission() == true): ?>checked="true"<?php endif; ?> />
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr style="background-color: #a7c1db; font-size: 14px;">
                                <td> # </td>
                                <td style="text-align: right;" colspan="4">Total</td>
                                <td style="text-align: right;"><?php echo number_format($solde_0, 3, '.', ' '); ?></td>
                                <td style="text-align: right;"><?php echo number_format($total_debit, 3, '.', ' '); ?></td>
                                <td style="text-align: right;"><?php echo number_format($total_credit, 3, '.', ' '); ?></td>
                                <td style="text-align: right;"><?php echo number_format($solde_courant, 3, '.', ' '); ?></td>
                                <td style="text-align: center;" id="nombre_all_mouvement"></td>
                            </tr>
                            <tr style="background-color: #eaeaea; font-size: 14px;">
                                <td> # </td>
                                <td style="text-align: right;" colspan="4">Mouvement(s) Classifié(s)</td>
                                <td></td>
                                <td style="text-align: right;" id="total_selected_debit"></td>
                                <td style="text-align: right;" id="total_selected_credit"></td>
                                <td style="text-align: right;"></td>
                                <td style="text-align: center;" id="nombre_mouvement"></td>
                            </tr>
                            <tr style="background-color: #eaeaea; font-size: 14px;">
                                <td> # </td>
                                <td style="text-align: right;" colspan="4">Reste</td>
                                <td></td>
                                <td style="text-align: right;" id="total_reste_debit"></td>
                                <td style="text-align: right;" id="total_reste_credit"></td>
                                <td style="text-align: right;"></td>
                                <td style="text-align: center;" id="nombre_reste_mouvement"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

<script  type="text/javascript">

    $('.list_checbox_mouvement').change(function () {
        if ($(this).is(":checked")) {
            var id = $(this).val();
            $('#' + id).css('background', '#E7E7E7');
            $('#' + id).css('border-bottom', '1px solid #000000');
            $('#' + id).css('border-top', '1px solid #000000');
        } else {
            var id = $(this).val();
            $('#' + id).css('background', '');
            $('#' + id).css('border-bottom', '');
            $('#' + id).css('border-top', '');
        }

        setTotal();
        var id = $(this).attr('id');
        var type = $(this).attr('data-mouvement');
        validerRapprochement(id, type);
    });

    function setTotal() {
        $('#nombre_all_mouvement').html('# ' + $('.list_checbox_mouvement').length);
        $('#nombre_mouvement').html('# ' + $('.list_checbox_mouvement[type=checkbox]:checked').length);
        var reste = parseFloat($('.list_checbox_mouvement').length) - parseFloat($('.list_checbox_mouvement[type=checkbox]:checked').length);
        $('#nombre_reste_mouvement').html('# ' + reste);

        var total_credit = 0;
        var total_debit = 0;
        $('.list_checbox_mouvement[type=checkbox]:checked').each(function () {
            total_credit = parseFloat(parseFloat(total_credit) + parseFloat($(this).attr('montant_credit')));
            total_debit = parseFloat(parseFloat(total_debit) + parseFloat($(this).attr('montant_debit')));
        });
        var option = {
            minimumFractionDigits: 3
        };
        var locale = 'fr-FR';
        var formatter = new Intl.NumberFormat(locale, option);
        $('#total_selected_credit').html(formatter.format(total_credit));
        $('#total_selected_debit').html(formatter.format(total_debit));
        var reste_debit = parseFloat('<?php echo $total_debit; ?>') - parseFloat(total_debit);
        var reste_credit = parseFloat('<?php echo $total_credit; ?>') - parseFloat(total_credit);
        $('#total_reste_debit').html(formatter.format(reste_debit));
        $('#total_reste_credit').html(formatter.format(reste_credit));
    }

    function validerRapprochement(id, type) {
        $.ajax({
            url: '<?php echo url_for('mouvementbanciare/validerRapprochement') ?>',
            data: 'id=' + id + '&type=' + type,
            success: function (data) {

            }
        });
    }

    function initialiseFormatLigne() {
        $('#list_mouvements tbody tr').each(function () {
            var id = $(this).attr("id");
            $('#' + id).css('background', '#FFE1E1');
            $('#' + id).css('border-bottom', '1px solid #ffe1e1');
            $('#' + id).css('border-top', '1px solid #ffe1e1');
        });

        $('.list_checbox_mouvement[type=checkbox]').each(function () {
            if ($(this).is(":checked")) {
                var id = $(this).val();
                $('#' + id).css('background', '#E7E7E7');
                $('#' + id).css('border-bottom', '1px solid #000000');
                $('#' + id).css('border-top', '1px solid #000000');
            } else {
                var id = $(this).val();
                $('#' + id).css('background', '');
                $('#' + id).css('border-bottom', '');
                $('#' + id).css('border-top', '');
            }
        });
//        $('.list_checbox_mouvement[type=checkbox]:checked').each(function () {
//            var id = $(this).val();
//            $('#' + id).css('background', '#E7E7E7');
//            $('#' + id).css('border-bottom', '1px solid #000000');
//            $('#' + id).css('border-top', '1px solid #000000');
//        });
        setTotal();
    }

    function annulerMouvement(id) {
        $.ajax({
            url: '<?php echo url_for('mouvementbanciare/annulerMouvement') ?>',
            data: 'id=' + id,
            success: function (data) {
                goPage(1);
            }
        });
    }

    initialiseFormatLigne();

</script>