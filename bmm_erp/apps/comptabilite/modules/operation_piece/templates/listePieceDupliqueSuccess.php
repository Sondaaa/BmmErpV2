<div id="sf_admin_container">
    <h1 id="replacediv"> Utilitaires
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Liste des pièces comptables dupliquées - Exercice <?php echo $_SESSION['exercice']; ?>
        </small>
    </h1>
</div>

<div id="form_show_piece" style="display: none;">

</div>

<div id="form_show_edit_piece" style="display: none;">

</div>

<div class="mws-panel grid_8" id="form_liste_piece">
    <table>
        <tr style="font-weight: bold;">
            <td>Numéro du :
                <input type="text" id="num_deb" onkeyup="goPage(1);"/>
            </td>
            <td>Au :
                <input type="text" id="num_fin" onkeyup="goPage(1);"/>
            </td>
            <td>
                <label style="width: 100%; font-weight: bold;">Date du :</label>
                <input type="date" id="date_deb" name="date_deb" onchange="goPage(1)"/>
            </td>
            <td>
                <label style="width: 100%; font-weight: bold;">Au :</label>
                <input type="date" id="date_fin" name="date_fin" onchange="goPage(1)"/>
            </td>
            <td style="vertical-align: bottom; text-align: center;">
                <a title="Réinitialiser" onclick="initform()" class="btn btn-primary"><i class="ace-icon fa fa-repeat"></i></a>
            </td>
        </tr> 
    </table>
    <div class="mws-panel-body">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
            <table id="listPiece" class="mws-datatable-fn mws-table">
                <thead>
                    <tr id="list_tri" style="border-bottom: 1px solid #000000" >
                        <th id="tri_journal" class="sorting" name="tri" onclick="tri('journal')" style="width: 33%;">Journal comptable</th>
                        <th id="tri_date" class="sorting" name="tri" onclick="tri('date')" style="width: 7%; text-align: center;">Date </th>  
                        <th id="tri_numero" class="sorting" name="tri" onclick="tri('numero')" style="width: 8%; text-align: center;">Numéro </th>
                        <th id="tri_serie" class="sorting" name="tri" onclick="tri('serie')" style="width: 5%; text-align: center;">Série </th> 
                        <th style="width: 8%; text-align: center;">Total débit</th>
                        <th style="width: 8%; text-align: center;">Total cédit</th>
                        <th id="tri_user" class="sorting" name="tri" onclick="tri('user')" style="width: 15%; text-align: center;">Utilisateur </th>
                        <th style="width: 7%; text-align: center;">P. Source</th>
                        <th style="width: 9%; text-align: center;">Opérations</th>
                    </tr>
                    <tr>
                        <th><input type="text" id="journal" onkeyup="goPage(1);" /></th>
                        <th></th>
                        <th><input id="num" class="align-center" onkeyup="goPage(1);" type="text" /></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot id="list_piece_pager"></tfoot>
                <tbody>
                    <?php include_partial("operation_piece/liste_piece_duplique", array("pager" => $pager, "page" => $page)) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<input type="hidden" id="type_tri" value="">
<input type="hidden" id="tri" value="">

<script  type="text/javascript">

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
            url: '<?php echo url_for('operation_piece/goPage'); ?>',
            data: 'page=' + page + '&journal=' + $('#journal').val() + '&num=' + $('#num').val() +
                    '&date_debut=' + $('#date_deb').val() + '&date_fin=' + $('#date_fin').val() +
                    '&num_debut=' + $('#num_deb').val() + '&num_fin=' + $('#num_fin').val() +
                    '&type_tri=' + $('#type_tri').val() + '&tri=' + $('#tri').val(),
            success: function (data) {
                $('#listPiece tbody').html('');
                $('#listPiece tbody').html(data);
                $("table.mws-table tbody tr:even").addClass("even");
                $("table.mws-table tbody tr:odd").addClass("odd");
                $('#listPiece tbody td[name=' + type + ']').each(function () {
                    $(this).attr('class', '  sorting_1');
                });
            }
        });
    }

    function showPiece(id) {
        $.ajax({
            url: '<?php echo url_for('operation_piece/show') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#form_show_piece').html(data);
                $('#form_show_edit_piece').fadeOut();
                $('#form_liste_piece').fadeOut();
                $('#form_show_piece').delay(500).fadeIn();
            }
        });
    }

    function showEditDossier(id) {
        $.ajax({
            url: '<?php echo url_for('operation_piece/showEditPieceDuplique') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#form_show_edit_piece').html(data);
                $('#form_show_piece').fadeOut();
                $('#form_liste_piece').fadeOut();
                $('#form_show_edit_piece').delay(500).fadeIn();
            }
        });
    }

    function deletePiece() {
        $.ajax({
            url: '<?php echo url_for('operation_piece/deletePieceDuplique') ?>',
            data: 'id=' + piece_id_delete,
            success: function (data) {
                $('#listPiece tbody').html(data);
                annulerSuppressionPiece();
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
    document.title = ("BMM - G. Compta. : U. Liste des pièces comptables dupliquées");
</script>