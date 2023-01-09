<div class="mws-panel-body no-padding">
    <form class="mws-form">
        <div class="mws-form-inline" >
            <div class="mws-panel-header"><span>Liste des Factures</span></div>
            <div style="margin-left: 1%; margin-top: 10px;">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 50%">
                            <div class="mws-form-row">
                                <label class="mws-form-label" style="width: 35%;">Référence Facture :</label>
                                <div class="mws-form-item">
                                    <input class="large" type="text" id="search_reference" onkeyup="searchByReferenceAndDate()">
                                </div>
                            </div>
                        </td>
                        <td style="width: 50%">
                            <div class="mws-form-row">
                                <label class="mws-form-label" style="width: 35%;">Date Facture :</label>
                                <div class="mws-form-item">
                                    <input class="large" type="text" id="search_date" onkeyup="searchByReferenceAndDate()">
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="mws-panel-body no-padding" style="margin-bottom: 15px;">
                <div style="height: 360px; overflow: auto;">
                    <table class="fancyTable" id="myTable01">
                        <thead>
                            <tr>
                                <th style="font-weight: bold; text-align: center;">#</th>
                                <th style="text-align: center; margin-top: 3px;">
                        <input id="selecte_all" type="checkbox"/>
                        </th>
                        <th style="font-weight: bold; text-align: center;">Référence</th>
                        <th style="font-weight: bold; text-align: center;">Date</th>
                        <th style="font-weight: bold; text-align: center;">Total HT</th>
                        <th style="font-weight: bold; text-align: center;">Total TVA</th>
                        <th style="font-weight: bold; text-align: center;">Timbre</th>
                        <th style="font-weight: bold; text-align: center;">Total TTC</th>
                        </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td colspan="9" style="height: 15px;"></td>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($factures as $facture): ?>
                                <tr class="ligne_compte" data_reference="<?php echo $facture->getReference(); ?>" data_date="<?php echo $facture->getDate(); ?>" check_input="check_input_<?php echo $facture->getId(); ?>">
                                    <td style="text-align: center;"><?php echo $i++; ?></td>
                                    <td style="text-align: center;"> <input id="check_input_<?php echo $facture->getId(); ?>" class="list_checbox_compte" add="1"  value="<?php echo $facture->getId(); ?>" type="checkbox"/> </td>
                                    <td style="text-align: center;"><b><?php echo $facture->getReference(); ?></b></td>
                                    <td style="text-align: center;"><?php echo $facture->getDate(); ?></td>
                                    <td style="text-align: center;"><?php echo $facture->getTotalHt(); ?></td>
                                    <td style="text-align: center;"><?php echo $facture->getTotalTva(); ?></td>
                                    <td style="text-align: center;"><?php echo $facture->getTimbre(); ?></td>
                                    <td style="text-align: center;"><?php echo $facture->getTotalTtc(); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>

<script  type="text/javascript">
  function searchByReferenceAndDate() {
        var reference = '';
        var date = '';
        var motifref = $('#search_reference').val();
        var motifdate = $('#search_date').val();
        motifref = motifref.toUpperCase();
        $('#myTable01 tbody tr').each(function() {
            reference = $(this).attr('data_reference');
            date = $(this).attr('data_date');
            var indexlib = reference.indexOf(motifref);
            var indexnum = date.indexOf(motifdate);
            if (indexlib >= 0 && indexnum >= 0) {
                $(this).css('display', '');
                var inputcheck = $(this).attr('check_input');
                $('#'+inputcheck).attr('add','1');
            }
            else {
                $(this).css('display', 'none');
                var inputcheck = $(this).attr('check_input');
                $('#' + inputcheck).removeAttr('checked');
                $('#'+inputcheck).attr('add','0');
            }
        });

    }
</script>