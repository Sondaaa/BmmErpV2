<div id="sf_admin_container">
    <h1 id="replacediv"> Utilitaires
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Rénumérotation des pièces comptables - Exercice <?php echo $_SESSION['exercice']; ?>
        </small>
    </h1>
</div>

<div class="col-sm-12">
    <table>
        <tr>
            <td style="width: 10%">Journal : </td>
            <td style="width: 60%">
                <select id="journal" style="width: 100%" onchange="getSeries()">
                    <option value=""></option>
                    <?php foreach ($journals as $journal): ?>
                        <option  value="<?php echo $journal->getId() ?>"> <?php echo $journal->getCode() . ' - ' . $journal->getLibelle() ?> </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td id="zone_series" style="width: 30%">

            </td>
        </tr>
    </table>

    <div class="row" id="zone_piece" style="display:none;">
        <div class="col-xs-12">
            <div class="table-header">
                Pièces Comptable :
                <a class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;" onclick="saveRenum()">
                    <i class="ace-icon fa fa-save bigger-110"></i>
                    <span class="bigger-110 no-text-shadow">Enregistrer</span>
                </a>
            </div>
            <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
                <table id="listPiece" class="mws-datatable-fn mws-table">
                    <thead>
                        <tr id="list_tri" style="border-bottom: 1px solid #000000" >
                            <th id="tri_date" class="sorting" name="tri" onclick="tri('date')" style="width: 10%; color: #007bb6; cursor: pointer; text-align: center;">Date <i style="float: right;" class="ace-icon fa fa-angle-down bigger-110"></i></th>
                            <th id="tri_numero" class="sorting" name="tri" onclick="tri('numero')" style="width: 10%; color: #007bb6; cursor: pointer; text-align: center;">N° Pièce </th>
                            <th style="width: 50%;">Libellé</th>
                            <th style="width: 10%; text-align: center;">Nouveau Numéro Pièce</th>
                            <th style="width: 20%; text-align: center;">Déplacer</th>
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
<input type="hidden" id="first_number" value="">

<script  type="text/javascript">

    function getSeries() {
        $.ajax({
            url: '<?php echo url_for('renumerotation/getSeriesJournal') ?>',
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
            url: '<?php echo url_for('renumerotation/getPiecesJournal'); ?>',
            data: 'journal=' + $('#journal').val() + '&serie=' + $('#serie').val() +
                    '&type_tri=' + $('#type_tri').val() + '&tri=' + $('#tri').val(),
            success: function (data) {
                $('#listPiece tbody').html(data);
                $("table.mws-table tbody tr:even").addClass("even");
                $("table.mws-table tbody tr:odd").addClass("odd");
                $('#listPiece tbody td[name=' + type + ']').each(function () {
                    $(this).attr('class', ' sorting_1');
                });
                ligneNumber();
                $('#zone_piece').show();
            }
        });
    }

    function saveRenum() {
        var lignes = '';
        $('input[name=ligne]').each(function () {
            lignes += $(this).val() + ',';
        });
        var new_number = '';
        $('td[name=new_number]').each(function () {
            new_number += $(this).html() + ',';
        });

        $.ajax({
            url: '<?php echo url_for('renumerotation/saveNumerotation') ?>',
            data: 'lignes=' + lignes + '&new_number=' + new_number + '&serie_id=' + $('#serie').val(),
            success: function (data) {
                location.reload();
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

    function ligneNumber() {
        var i = 0;
        $('#listPiece tbody tr').each(function () {
            var id = 'ligne_' + i;
            $(this).attr('id', id);
            $(this).attr('index_ligne', i);
            i++;
        });
        var i = 0;
        $('[name="upfirstligne"]').each(function () {
            var format = 'upFirstLigne("' + i + '")';
            $(this).attr('onclick', format);
            i++;
        });
        var i = 0;
        $('[name="upligne"]').each(function () {
            var format = 'upLigne("' + i + '")';
            $(this).attr('onclick', format);
            i++;
        });
        var i = 0;
        $('[name="downligne"]').each(function () {
            var format = 'downLigne("' + i + '")';
            $(this).attr('onclick', format);
            i++;
        });
        var i = 0;
        $('[name="downlastligne"]').each(function () {
            var format = 'downLastLigne("' + i + '")';
            $(this).attr('onclick', format);
            i++;
        });

        var i = parseFloat($('#first_number').val());
        $('[name="new_number"]').each(function () {
            $(this).html(i);
            i++;
        });
    }

    function upLigne(index_ligne) {
        if (index_ligne >= 1) {
            var data = $('#ligne_' + index_ligne).html();
            data = '<tr id="ligne_" index_ligne="">' + data + '</tr>';
            $('#ligne_' + index_ligne).remove();
            index_ligne--;
            $('#listPiece > tbody > tr').eq(index_ligne).before(data);
            ligneNumber();
            formatLigne(index_ligne);

            $("table.mws-table tbody tr").removeClass("even");
            $("table.mws-table tbody tr").removeClass("odd");

            $("table.mws-table tbody tr:even").addClass("even");
            $("table.mws-table tbody tr:odd").addClass("odd");
        }
    }

    function downLigne(index_ligne) {
        var count_ligne = 0;
        $('#listPiece tbody tr').each(function () {
            count_ligne++;
        });
        if (count_ligne > 1) {
            if (index_ligne < count_ligne - 1) {
                var data = $('#ligne_' + index_ligne).html();
                data = '<tr id="ligne_" index_ligne="">' + data + '</tr>';
                $('#ligne_' + index_ligne).remove();
                index_ligne++;
                if (index_ligne < count_ligne - 1)
                    $('#listPiece > tbody > tr').eq(index_ligne).before(data);
                else
                    $('#listPiece tbody').append(data);
                ligneNumber();
                formatLigne(index_ligne);

                $("table.mws-table tbody tr").removeClass("even");
                $("table.mws-table tbody tr").removeClass("odd");

                $("table.mws-table tbody tr:even").addClass("even");
                $("table.mws-table tbody tr:odd").addClass("odd");
            }
        }
    }

    function upFirstLigne(index_ligne) {
        if (index_ligne >= 1) {
            var data = $('#ligne_' + index_ligne).html();
            data = '<tr id="ligne_" index_ligne="">' + data + '</tr>';
            $('#ligne_' + index_ligne).remove();
            $('#listPiece > tbody > tr').eq(0).before(data);
            ligneNumber();
            formatLigne(index_ligne);

            $("table.mws-table tbody tr").removeClass("even");
            $("table.mws-table tbody tr").removeClass("odd");

            $("table.mws-table tbody tr:even").addClass("even");
            $("table.mws-table tbody tr:odd").addClass("odd");
        }
    }

    function downLastLigne(index_ligne) {
        var count_ligne = 0;
        $('#listPiece tbody tr').each(function () {
            count_ligne++;
        });
        if (count_ligne > 1) {
            if (index_ligne < count_ligne - 1) {
                var data = $('#ligne_' + index_ligne).html();
                data = '<tr id="ligne_" index_ligne="">' + data + '</tr>';
                $('#ligne_' + index_ligne).remove();
                $('#listPiece tbody').append(data);
                ligneNumber();
                count_ligne--;
                formatLigne(count_ligne);

                $("table.mws-table tbody tr").removeClass("even");
                $("table.mws-table tbody tr").removeClass("odd");

                $("table.mws-table tbody tr:even").addClass("even");
                $("table.mws-table tbody tr:odd").addClass("odd");
            }
        }
    }

</script>

<style type="text/css">
    .header_table th{
        font-weight: bold;
        font-size: 13px;
    }
    .mws-table tbody tr.odd td.sorting_1 {
        background-color: #cccccc;
    }
    .mws-table tbody tr.even td.sorting_1 {
        background-color: #e1e1e1;
    }

</style>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : U. Rénumérotation des pièces comptables");
</script>