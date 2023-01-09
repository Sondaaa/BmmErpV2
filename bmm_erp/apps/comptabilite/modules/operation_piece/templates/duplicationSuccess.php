<div id="sf_admin_container">
    <h1 id="replacediv"> Utilitaires
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Dupliquer des pièces comptables - Exercice <?php echo $_SESSION['exercice']; ?>
        </small>
    </h1>
</div>

<div id="form_show_piece" style="display: none;">

</div>

<div id="form_show_propriete_piece" style="display: none;">

</div>

<div class="row" id="form_liste_piece">
    <table>
        <tr>
            <td>
                <label style="font-weight: bold;">Journal Comptable : </label>
                <select id="journal_id" onchange="goPage(1)">
                    <option value=""></option>
                    <?php foreach ($journals as $journal) : ?>
                        <option value="<?php echo $journal->getId() ?>"><?php echo $journal->getCode() . ' - ' . $journal->getLibelle(); ?></option>
                    <?php endforeach; ?>
                </select>
            </td> 
        </tr>
    </table>

    <div class="row">
        <div class="col-xs-12">
            <div class="table-header">Liste des Pièces Comptables</div>
            <table style="width: 100%">
                <tr>
                    <td style="vertical-align: middle; font-weight: bold;">Numéro du :
                        <input type="text" id="num_deb" onkeyup="goPage(1);"/>
                    </td>
                    <td style="vertical-align: middle; font-weight: bold;">Au :
                        <input type="text" id="num_fin" onkeyup="goPage(1);"/>
                    </td>
                    <td style="vertical-align: middle;">
                        <label style="width: 100%; font-weight: bold;">Date du : </label>
                        <input type="date" id="date_deb" name="date_deb" />
                    </td>
                    <td style="vertical-align: middle;">
                        <label style="width: 100%; font-weight: bold;">Au : </label>
                        <input type="date" id="date_fin" name="date_fin" />
                    </td>
                    <td style="vertical-align: bottom; text-align: center;">
                        <button title="Réinitialiser" onclick="initform()" class="btn btn-primary"><i class="ace-icon fa fa-refresh"></i></button>
                    </td>
                </tr> 
            </table>
            <div class="mws-panel-body">
                <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
                    <table id="listPiece" class="mws-datatable-fn mws-table">
                        <thead>
                            <tr id="list_tri" style="border-bottom: 1px solid #000000;">
                                <th id="tri_date" class="sorting" name="tri" onclick="tri('date')" style="width: 10%; text-align: center; cursor: pointer; color: #0088cc">Date <i style="float: right;" class="ace-icon fa fa-angle-down bigger-110"></i></th>  
                                <th id="tri_numero" class="sorting" name="tri" onclick="tri('numero')" style="width: 10%; text-align: center; cursor: pointer; color: #0088cc">Numéro </th>
                                <th id="tri_serie" class="sorting" name="tri" onclick="tri('serie')" style="width: 10%; text-align: center;">Série </th> 
                                <th style="width: 10%; text-align: center;">Total débit</th>
                                <th style="width: 10%; text-align: center;">Total crédit</th>
                                <th id="tri_user" class="sorting" name="tri" onclick="tri('user')" style="width: 20%; text-align: center;">Utilisateur </th>
                                <th style="width: 10%; text-align: center;">Opérations</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th style="text-align: center;"><input id="num" onkeyup="goPage(1);" type="text" style="width: 95%;" /></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot id="list_piece_pager"></tfoot>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="type_tri" value="date">
<input type="hidden" id="tri" value="asc">

<script  type="text/javascript">

    $("#date_deb").change(function () {
        goPage(1);
    });

    $("#date_fin").change(function () {
        goPage(1);
    });

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
        goPage(1);
    }

    function goPage(page) {
        var type = $('#type_tri').val();
        type = 'ligne_' + type;
        $.ajax({
            url: '<?php echo url_for('operation_piece/goPageDuplication'); ?>',
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

    function dupliquerPiece(id) {
        $.ajax({
            url: '<?php echo url_for('operation_piece/dupliquer') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#zone_duplication').html(data);
                $('#zone_duplication').fadeIn();
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
                $('#form_show_propriete_piece').fadeOut();
                $('#form_show_piece').delay(500).fadeIn();
            }
        });
    }

    function showProprietePiece(id) {
        $.ajax({
            url: '<?php echo url_for('operation_piece/showPropriete') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#form_show_propriete_piece').html(data);
                $('#form_show_edit_piece').fadeOut();
                $('#form_liste_piece').fadeOut();
                $('#form_show_piece').fadeOut();
                $('#form_show_propriete_piece').delay(500).fadeIn();
            }
        });
    }

    function showEditDossier(id) {
        $.ajax({
            url: '<?php echo url_for('saisie_pieces/showEdit') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#form_show_edit_piece').html(data);
                $('#form_show_piece').fadeOut();
                $('#form_liste_piece').fadeOut();
                $('#form_show_propriete_piece').fadeOut();
                $('#form_show_edit_piece').delay(500).fadeIn();
            }
        });
    }

    function formatLigne(index) {
        $('#listPiece tbody tr').each(function () {
            $(this).css('background', '');
            $(this).css('border-bottom', '');
            $(this).css('border-top', '');
        });

        $('#ligne_' + index).css('background', '#F0F0F0');
        $('#ligne_' + index).css('border-bottom', '1px solid #000000');
        $('#ligne_' + index).css('border-top', '1px solid #000000');
    }

    function validerDuplicationPiece() {
        $.ajax({
            url: '<?php echo url_for('operation_piece/validerDupliquerPiece') ?>',
            data: 'journal=' + $('#journal_new').val() +
                    '&date=' + $('#date_new').val() +
                    '&numero=' + $('#new_numero').val() +
                    '&libelle=' + $('#libelle_new').val() +
                    '&piece_source=' + $('#piece_source').val() +
                    '&serie_id=' + $('#new_serie_id').val(),
            success: function (data) {
                console.log(data);
                showPiece(data);
                dupliquerPiece(data);
//               document.location.href = "/BmmErpV2/web/Ressourcehumaine.php/operation_piece/duplication?id=" + data['id'];
//                fermer();
//                goPage(1);
            }
        });
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
    .mws-table tbody tr {
        cursor: pointer;
    }
</style>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : U. Dupliquer des pièces comptables");
</script>