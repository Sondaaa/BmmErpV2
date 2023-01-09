<div class="row" style="font-size: 14px; margin-bottom: 10px;">
    Veuillez choisir les factures à importer entre <b style="color: #1265CC"><?php echo date('d/m/Y', strtotime($date_debut)) ?></b> et <b style="color: #1265CC"><?php echo date('d/m/Y', strtotime($date_fin)) ?></b>.
</div>
<table class="table table-bordered table-hover" style="margin-bottom: 0px;">
    <tr>
        <td style="width: 30%">
            Référence Facture :
            <input style="width: 90%;" type="text" id="search_reference" onkeyup="searchByReferenceAndDate()">
        </td>
        <td style="width: 17%">
            Date Facture :<br>
            <input type="date" id="search_date" onkeyup="searchByReferenceAndDate()">
        </td>
        <td style="width: 53%">
            Fournisseur :<br>
            <input style="width: 93%;" type="text" id="search_fournisseur" onkeyup="searchByReferenceAndDate()">
        </td>
    </tr>
</table>
<div style="max-height: 360px; overflow: auto;">
    <table class="table table-bordered table-hover" id="myTable01">
        <thead>
            <tr style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                <th style="font-weight: bold; text-align: center;">#</th>
                <th style="text-align: center; margin-top: 3px;">
                    <input id="selecte_all" type="checkbox" onchange="selectAll()"/>
                </th>
                <th style="font-weight: bold; text-align: center;">Référence (Numéro)</th>
                <th style="font-weight: bold; text-align: center;">Date</th>
                <th style="font-weight: bold; text-align: left; padding-left: 1%;">Fournisseur</th>
                <th style="font-weight: bold; text-align: center;">Montant HT</th>
                <th style="font-weight: bold; text-align: center;">Montant TVA</th>
                <th style="font-weight: bold; text-align: center;">Montant TTC</th>
            </tr>
        </thead>
        <tbody>
            <?php if (sizeof($factures) != 0 || sizeof($factures_caisses) != 0): ?>
                <?php $k = 0; ?>
                <?php for ($i = 0; $i < sizeof($factures); $i++): ?>
                    <tr style="background-color: #f2f5f6;" class="ligne_compte" data_reference="<?php echo $factures[$i]['reference'] . ' (' . $factures[$i]['numero'] . ')'; ?>" data_date="<?php echo $factures[$i]['datecreation']; ?>" data_fournisseur="<?php echo strtoupper($factures[$i]['rs']); ?>" check_input="check_input_<?php echo $factures[$i]['id']; ?>">
                        <td style="text-align: center;"><?php echo $i + 1; ?></td>
                        <td style="text-align: center;" name="td_checkbox"> <input id="check_input_<?php echo $factures[$i]['id']; ?>" class="list_checbox_compte" add="1"  value="<?php echo $factures[$i]['id']; ?>" type="checkbox" onchange="setChecked('check_input_<?php echo $factures[$i]['id']; ?>')"/> </td>
                        <td style="text-align: center;"><b><?php echo $factures[$i]['reference']; ?></b> (<?php echo $factures[$i]['numero']; ?>)</td>
                        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($factures[$i]['datecreation'])); ?></td>
                        <td><?php echo $factures[$i]['rs']; ?></td>
                        <td style="text-align: right;"><?php echo $factures[$i]['mht']; ?></td>
                        <td style="text-align: right;"><?php echo $factures[$i]['mnttva']; ?></td>
                        <td style="text-align: right;"><?php echo $factures[$i]['mntttc']; ?></td>
                    </tr>
                    <?php $k = $i + 1; ?>
                <?php endfor; ?>
                <?php $k++; ?>
                <?php for ($i = 0; $i < sizeof($factures_caisses); $i++): ?>
                    <tr style="background-color: #fef6eb" class="ligne_compte" data_reference="<?php echo $factures_caisses[$i]['reference'] . ' (' . $factures_caisses[$i]['numero'] . ')'; ?>" data_date="<?php echo $factures_caisses[$i]['datecreation']; ?>" data_fournisseur="<?php echo strtoupper($factures_caisses[$i]['rs']); ?>" check_input="check_input_<?php echo $factures_caisses[$i]['id']; ?>">
                        <td style="text-align: center;"><?php echo $k; ?></td>
                        <td style="text-align: center;" name="td_checkbox"> <input id="check_input_<?php echo $factures_caisses[$i]['id']; ?>" class="list_checbox_compte" add="1"  value="<?php echo $factures_caisses[$i]['id']; ?>" type="checkbox" onchange="setChecked('check_input_<?php echo $factures_caisses[$i]['id']; ?>')"/> </td>
                        <td style="text-align: center;"><b><?php echo $factures_caisses[$i]['reference']; ?></b> (<?php echo $factures_caisses[$i]['numero']; ?>)</td>
                        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($factures_caisses[$i]['datecreation'])); ?></td>
                        <td><?php echo $factures_caisses[$i]['rs']; ?></td>
                        <td style="text-align: right;"><?php echo $factures_caisses[$i]['mht']; ?></td>
                        <td style="text-align: right;"><?php echo $factures_caisses[$i]['mnttva']; ?></td>
                        <td style="text-align: right;"><?php echo $factures_caisses[$i]['mntttc']; ?></td>
                    </tr>
                    <?php $k++; ?>
                <?php endfor; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" style="text-align: center;">Pas de factures d'achats dans cette période.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="row" style="margin-top: 15px;">
    <div class="col-sm-6">
        <p><span class="label label-white middle">Facture payée par <b>Compte Bancaire / CCP</b></span></p>
        <p><span class="label label-warning label-white middle">Facture payée par <b>Caisse</b></span></p>
    </div>
</div>

<script  type="text/javascript">

    function setChecked(id) {
        if ($('#' + id).is(':checked'))
            $('#' + id).attr("checked", "checked");
        else
            $('#' + id).removeAttr("checked");
    }

    function selectAll() {
        if ($('#selecte_all').is(':checked')) {
            $('.list_checbox_compte[type=checkbox][add=1]').prop("checked", true);
            $('.list_checbox_compte[type=checkbox][add=1]').attr("checked", "checked");
        } else {
            $('.list_checbox_compte[type=checkbox][add=1]').prop("checked", false);

            $('#myTable01 > tbody > tr').each(function (i) {
                // Only check rows that contain a checkbox
                var $chkbox = $(this).find('input[type="checkbox"]');
                if ($chkbox.length) {
                    var id = $chkbox.attr('id');
                    $("#" + id).removeAttr("checked");
                }
            });
        }
    }

    function searchByReferenceAndDate() {
        var reference = '';
        var date = '';
        var fournisseur = '';
        var motifref = $('#search_reference').val();
        var motifdate = $('#search_date').val();
        var motiffournisseur = $('#search_fournisseur').val().toUpperCase();
        motifref = motifref.toUpperCase();
        $('#myTable01 tbody tr').each(function () {
            reference = $(this).attr('data_reference');
            date = $(this).attr('data_date');
            fournisseur = $(this).attr('data_fournisseur');
            var indexlib = reference.indexOf(motifref);
            var indexnum = date.indexOf(motifdate);
            var indexrs = fournisseur.indexOf(motiffournisseur);
            if (indexlib >= 0 && indexnum >= 0 && indexrs >= 0) {
                $(this).css('display', '');
                var inputcheck = $(this).attr('check_input');
                $('#' + inputcheck).attr('add', '1');
            }
            else {
                $(this).css('display', 'none');
                var inputcheck = $(this).attr('check_input');
                $('#' + inputcheck).removeAttr('checked');
                $('#' + inputcheck).attr('add', '0');
            }
        });
    }

</script>