<table class="table table-bordered table-hover">
    <thead>
        <tr style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
            <th style="width: 5%; text-align: center;"><input type="checkbox" id="select_all" /></th>
            <th style="width: 10%; text-align: center;">Ordonnance</th>
            <th style="width: 10%; text-align: center;">date</th>
            <th style="width: 10%; text-align: center;">Montant</th>
            <th style="width: 25%; text-align: center;">Compte Bancaire / CCP</th>
            <th style="width: 10%; text-align: center;">Ordonnance sujet R.S</th>
            <th style="width: 10%; text-align: center;">Retenue à la Source</th>
            <th style="width: 5%; text-align: center;">Taux R.S</th>
            <th style="width: 15%; text-align: center;">Fournisseur</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($ordonnances->count() == 0): ?>
            <tr>
                <td colspan="9" style="text-align: center; font-size: 16px;">Pas d'ordonnances de paiement !</td>
            </tr>
        <?php else: ?>
            <?php foreach ($ordonnances as $ordonnance): ?>
                <?php
                $ordonnance_parent = DocumentbudgetTable::getInstance()->find($ordonnance->getIdDocumentbudget());
                $certificat = $ordonnance_parent->getCertificatretenue()->getFirst();
                $budget_id = $ordonnance->getLigprotitrub()->getId();
                $lignebanquecaisse = LignebanquecaisseTable::getInstance()->findByIdBudget($budget_id)->getFirst();
                ?>
                <tr class="row_ordonnance" id="row_<?php echo $ordonnance->getId(); ?>">
                    <td style="text-align: center;"><input type="checkbox" value="<?php echo $ordonnance->getId(); ?>" montant="<?php echo $ordonnance->getMntnet(); ?>" class="list_checbox_ordonnance" id="check_<?php echo $ordonnance->getId(); ?>" /></td>
                    <td style="text-align: center;"><?php echo $ordonnance->getNumero(); ?></td>
                    <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($ordonnance->getDatecreation())); ?></td>
                    <td style="text-align: center;"><?php echo number_format($ordonnance->getMntnet(), 3, ".", " "); ?></td>
                    <td>
                        <?php
                        if ($lignebanquecaisse != null)
                            echo $lignebanquecaisse->getCaissesbanques();
                        ?>
                    </td>
                    <td style="text-align: center;"><?php echo $ordonnance_parent->getNumero(); ?></td>
                    <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($certificat->getDatecreation())); ?></td>
                    <td style="text-align: center;"><?php echo $certificat->getRetenuesource()->getValeurretenue(); ?>%</td>
                    <td><?php echo $certificat->getFournisseur(); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<div class="row">
    <div class="col-xs-12">
        <div class="clearfix col-xs-5" style="font-size: 16px;">
            <span id="nombre_ordonnance" style="margin-left: 20px;">0 </span> Ordonnance(s) sélectionnée(s)
        </div>
        <button class="btn btn-primary" type="button" style="float: right; margin-bottom: 12px;" onclick="passerOrdonnance()">
            <i class="ace-icon fa fa-file-text bigger-110"></i>
            Passer Ordonnance
        </button>
    </div>
</div>

<script  type="text/javascript">

    function setTotalOrdonnance() {
        var total = 0;
        $('.list_checbox_ordonnance[type=checkbox]:checked').each(function () {
            total = parseFloat(parseFloat(total) + parseFloat($(this).attr('montant')));
        });
        $('#declaration_montant').val(parseFloat(total).toFixed(3));
    }

    $('.list_checbox_ordonnance').change(function () {
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
        $('#nombre_ordonnance').html($('.list_checbox_ordonnance[type=checkbox]:checked').length);
        setTotalOrdonnance();
    });

    $('#select_all').change(function () {
        if ($('#select_all').is(':checked')) {
            $('.list_checbox_ordonnance[type=checkbox]').prop('checked', true);

            $('.row_ordonnance').css('background', '#E7E7E7');
            $('.row_ordonnance').css('border-bottom', '1px solid #000000');
            $('.row_ordonnance').css('border-top', '1px solid #000000');
        } else {
            $('.list_checbox_ordonnance[type=checkbox]').prop('checked', false);

            $('.row_ordonnance').css('background', '');
            $('.row_ordonnance').css('border-bottom', '');
            $('.row_ordonnance').css('border-top', '');
        }
        $('#nombre_ordonnance').html($('.list_checbox_ordonnance[type=checkbox]:checked').length);
        setTotalOrdonnance();
    });

</script>