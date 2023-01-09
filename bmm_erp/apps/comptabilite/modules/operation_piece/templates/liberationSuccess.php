<div id="sf_admin_container">
    <h1 id="replacediv"> Utilitaires
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Libérer des pièces comptables - Exercice <?php echo $_SESSION['exercice']; ?>
        </small>
    </h1>
</div>

<div class="row">
    <table>
        <tr>
            <td>
                Journal : 
                <select id="journal_id" onchange="goPage(1)">
                    <option value=""></option>
                    <?php foreach ($journals as $journal) : ?>
                        <option value="<?php echo $journal->getId() ?>" ><?php echo $journal->getCode() . ' - ' . $journal->getLibelle(); ?></option>
                    <?php endforeach; ?>
                </select>
            </td> 
        </tr>
    </table>

    <div class="row" id="form_liste_piece">
        <div class="col-xs-12">
            <div class="table-header">Liste des Pièces Comptables</div>
            <table>
                <tr>
                    <td style="vertical-align: middle; font-weight: bold;">Numéro du :
                        <input type="text" id="num_deb"  style=" width: 50%;" onkeyup="goPage(1);"/>
                    </td>
                    <td style="vertical-align: middle; font-weight: bold;">Au :
                        <input type="text" id="num_fin"  style=" width: 50%;" onkeyup="goPage(1);"/>
                    </td>
                    <td style="vertical-align: middle;">
                        <label style="width: 100%; font-weight: bold;">Date du : </label>
                        <input type="date" id="date_deb" name="date_deb" onchange="goPage(1);" />
                    </td>
                    <td style="vertical-align: middle;">
                        <label style="width: 100%; font-weight: bold;">Au : </label>
                        <input type="date" id="date_fin" name="date_fin" onchange="goPage(1);" />
                    </td>
                    <td style="vertical-align: bottom; text-align: center;">
                        <a title="Réinitialiser" onclick="initform()" class="btn btn-primary"><i class="ace-icon fa fa-refresh"></i></a>
                    </td>
                </tr> 
            </table>
            <div class="mws-panel-body">
                <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
                    <table id="listPiece" class="mws-datatable-fn mws-table">
                        <thead>
                            <tr id="list_tri" style="border-bottom: 1px solid #000000; text-align: center;">
                                <th id="tri_date" class="sorting" name="tri" onclick="tri('date')" style="width: 10%;">Date </th>  
                                <th id="tri_numero" class="sorting" name="tri" onclick="tri('numero')" style="width: 10%;">Numéro </th>
                                <th id="tri_serie" class="sorting" name="tri" onclick="tri('serie')" style="width: 10%;">Série </th> 
                                <th style="width: 10%;">Total débit</th>
                                <th style="width: 10%;">Total cédit</th>
                                <th id="tri_user" class="sorting" name="tri" onclick="tri('user')" style="width: 15%;">Utilisateur </th>
                                <th style="width: 10%;">Pièces Dupliquées</th>
                                <th style="width: 15%;">Opérations</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th><input id="num" class="align-center" onkeyup="goPage(1);" type="text" style="width: 95%;" /></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot id="list_piece_pager">
                        </tfoot>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="type_tri" value="">
<input type="hidden" id="tri" value="">

<script  type="text/javascript">

    function liberer(id) {
        $.ajax({
            async: true,
            url: '<?php echo url_for('operation_piece/liberer') ?>',
            data: 'id=' + id + '&page=1' + '&num=' + $('#num').val() +
                    '&date_debut=' + $('#date_deb').val() + '&date_fin=' + $('#date_fin').val() +
                    '&num_debut=' + $('#num_deb').val() + '&num_fin=' + $('#num_fin').val() +
                    '&type_tri=' + $('#type_tri').val() + '&tri=' + $('#tri').val() +
                    '&journal_id=' + $('#journal_id').val(),
            success: function (data) {
                $('#listPiece tbody').html(data);
            }
        });
    }

    function libererTout(id) {
        $.ajax({
            async: true,
            url: '<?php echo url_for('operation_piece/libererTout') ?>',
            data: 'id=' + id + '&page=1' + '&num=' + $('#num').val() +
                    '&date_debut=' + $('#date_deb').val() + '&date_fin=' + $('#date_fin').val() +
                    '&num_debut=' + $('#num_deb').val() + '&num_fin=' + $('#num_fin').val() +
                    '&type_tri=' + $('#type_tri').val() + '&tri=' + $('#tri').val() +
                    '&journal_id=' + $('#journal_id').val(),
            success: function (data) {
                $('#listPiece tbody').html(data);
            }
        });
    }

    function initform() {
        $('#date_deb').val('');
        $('#date_fin').val('');
        $('#num_deb').val('');
        $('#num_fin').val('');
        $('#journal').val('');
        $('#num').val('');
        goPage(1);
    }

    function tri(type) {
        $('#list_tri th[name=tri]').each(function () {
            if ($(this).attr('id') != 'tri_' + type) {
                $(this).attr('class', 'sorting');
            }
        });
        $('#type_tri').val(type);
        var tri = $('#tri_' + type).attr('class');
        if (tri == 'sorting') {
            $('#tri_' + type).attr('class', 'sorting_asc');
            $('#tri').val('asc');
        } else if (tri == 'sorting_asc') {
            $('#tri_' + type).attr('class', 'sorting_desc');
            $('#tri').val('desc');
        } else {
            $('#tri_' + type).attr('class', 'sorting_asc');
            $('#tri').val('asc');
        }
        goPage(1);
    }

    function goPage(page) {
        var type = $('#type_tri').val();
        type = 'ligne_' + type;
        $.ajax({
            url: '<?php echo url_for('operation_piece/goPageLiberation'); ?>',
            data: 'page=' + page + '&num=' + $('#num').val() +
                    '&date_debut=' + $('#date_deb').val() + '&date_fin=' + $('#date_fin').val() +
                    '&num_debut=' + $('#num_deb').val() + '&num_fin=' + $('#num_fin').val() +
                    '&type_tri=' + $('#type_tri').val() + '&tri=' + $('#tri').val() +
                    '&journal_id=' + $('#journal_id').val(),
            success: function (data) {
                $('#listPiece tbody').html(data);
                $("table.mws-table tbody tr:even").addClass("even");
                $("table.mws-table tbody tr:odd").addClass("odd");
                $('#listPiece tbody td[name=' + type + ']').each(function () {
                    $(this).attr('class', '  sorting_1');
                });
            }
        });
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
    document.title = ("BMM - G. Compta. : U. Libérer des pièces comptables");
</script>