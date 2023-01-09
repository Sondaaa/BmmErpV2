<div id="sf_admin_container">
    <h1 id="replacediv"> Utilitaires
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Modification Numéro des pièces comptables - Exercice <?php echo $_SESSION['exercice']; ?>
        </small>
    </h1>
</div>

<div class="col-sm-12">
    <table>
        <tr>
            <td style="width: 10%">Journal : </td>
            <td style="width: 20%">
                <select id="journal" onchange="getSeries()">
                    <option value=""></option>
                    <?php foreach ($journals as $journal): ?>
                        <option value="<?php echo $journal->getId() ?>"><?php echo $journal->getCode() . ' - ' . $journal->getLibelle() ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td id="zone_series" style="width: 20%">

            </td>
        </tr> 
    </table>
    
    <div id="zone_piece" class="mws-panel grid_8" style="display:none ; margin-top: 20px;">
        <div class="table-header">Pièces Comptable :</div>
        <div class="mws-panel-body">
            <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
                <table id="listPiece" class="mws-datatable-fn mws-table">
                    <thead>
                        <tr id="list_tri">
                            <th id="tri_date" class="sorting" name="tri" onclick="tri('date')" style="width: 10%; color: #007bb6; cursor: pointer; text-align: center;">Date <i style="float: right;" class="ace-icon fa fa-angle-down bigger-110"></i></th>
                            <th id="tri_numero" class="sorting" name="tri" onclick="tri('numero')" style="width: 10%; color: #007bb6; cursor: pointer; text-align: center;">Numéro Pièce</th>
                            <th style="width: 40%;">Libellé</th>
                            <th style="width: 10%; text-align: center;">Nouvelle Date</th>
                            <th style="width: 10%; text-align: center;">Nouveau Numéro</th>
                            <th style="width: 10%; text-align: center;">Opération</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="type_tri" value="date">
<input type="hidden" id="tri" value="asc">

<script  type="text/javascript">

    function getSeries() {
        $.ajax({
            url: '<?php echo url_for('modification_numero/getSeriesJournal') ?>',
            data: 'journal=' + $('#journal').val(),
            success: function (data) {
                $('#zone_series').html(data);
                $('#zone_piece').hide();
            }
        });
    }

    function getPieces() {
        var type = $('#type_tri').val();
        type = 'ligne_' + type;
        $.ajax({
            url: '<?php echo url_for('modification_numero/getPiecesJournal'); ?>',
            data: 'journal=' + $('#journal').val() + '&serie=' + $('#serie').val() +
                    '&type_tri=' + $('#type_tri').val() + '&tri=' + $('#tri').val(),
            success: function (data) {
                $('#listPiece tbody').html(data);
                $("table.mws-table tbody tr:even").addClass("even");
                $("table.mws-table tbody tr:odd").addClass("odd");
                $('#listPiece tbody td[name=' + type + ']').each(function () {
                    $(this).attr('class', '  sorting_1');
                });
                $('#zone_piece').show();
            }
        });
    }

    function saveModifNum(id) {
        $.ajax({
            url: '<?php echo url_for('modification_numero/saveModifNum') ?>',
            data: 'piece_id=' + $('#piece_id_' + id).val() +
                    '&nouveau_numero=' + $('#nouveau_numero_' + id).val() +
                    '&nouvelle_serie=' + $('#serie_id_' + id).val() +
                    '&nouvelle_date=' + $('#date_' + id).val(),
            success: function (data) {
                getPieces();
            }
        });
    }

    function tri(type) {
        $('#list_tri th[name=tri]').each(function () {
            if ($(this).attr('id') != 'tri_' + type) {
                $(this).attr('class', 'sorting');
            }
        });
        $('#type_tri').val(type);
        if (type == "date")
            var th_text = "Date";
        else
            var th_text = "N° Pièce";

        $('#tri_date').html("Date");
        $('#tri_numero').html("N° Pièce");

        var tri = $('#tri_' + type).attr('class');
        if (tri == 'sorting') {
            $('#tri_' + type).attr('class', 'sorting_asc');
            $('#tri').val('asc');
            th_text = th_text + ' <i style="float: right;" class="ace-icon fa fa-angle-down bigger-110"></i>';
            $('#tri_' + type).html(th_text);
        } else if (tri == 'sorting_asc') {
            $('#tri_' + type).attr('class', 'sorting_desc');
            $('#tri').val('desc');
            th_text = th_text + ' <i style="float: right;" class="ace-icon fa fa-angle-up bigger-110"></i>'
            $('#tri_' + type).html(th_text);
        } else {
            $('#tri_' + type).attr('class', 'sorting_asc');
            $('#tri').val('asc');
            th_text = th_text + ' <i style="float: right;" class="ace-icon fa fa-angle-down bigger-110"></i>';
            $('#tri_' + type).html(th_text);
        }
        getPieces();
    }

    function formatLigne(index) {
        $('#listPiece tbody tr').each(function () {
            $(this).css('background', '');
            $(this).css('border-bottom', '');
            $(this).css('border-top', '');
        });
        $('#ligne_' + index).css('background', 'repeat-x scroll left bottom #d8d6d6');
        $('#ligne_' + index).css('border-bottom', '1px solid #000000');
        $('#ligne_' + index).css('border-top', '1px solid #000000');
    }

    function showDate(id) {
        $.ajax({
            url: '<?php echo url_for('modification_numero/showFormDate') ?>',
            data: 'id=' + $('#piece_id_' + id).val(),
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
                            if ($('#new_numero').val() != '')
                                setNewValues(id);
                        }
                    }
                });
            }
        });
    }

    function setNewValues(id) {
        var d = new Date($('#new_date').val());
        var day = d.getDate();
        var monthIndex = d.getMonth() + 1;
        var year = d.getFullYear();
        var new_date = padDigits(day, 2) + '/' + padDigits(monthIndex, 2) + '/' + year;

        var text_new_date = '<i class="ace-icon fa fa-calendar bigger-110"></i> ' + new_date;
        $('#text_new_date_' + id).html(text_new_date);
        $('#date_' + id).val($('#new_date').val());
        $('#serie_id_' + id).val($('#new_serie_id').val());
        $('#nouveau_numero_' + id).val($('#new_numero').val());
    }

    function padDigits(number, digits) {
        return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
    }

</script>

<style type="text/css">
    .header_table th{
        font-weight: bold;
        font-size: 13px;
    }
    .mws-table tbody tr td{
        vertical-align: middle;
    }
    .mws-table tbody tr.odd td.sorting_1 {
        background-color: #cccccc;
    }
    .mws-table tbody tr.even td.sorting_1 {
        background-color: #e1e1e1;
    }

</style>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : U. Modification Numéro des pièces comptables");
</script>