<div id="form_show_piece" style="display: none;">

</div>

<div id="form_show_edit_piece" style="display: none;">

</div>

<div id="form_show_propriete_piece" style="display: none;">

</div>

<div class="mws-panel grid_8" id="form_liste_piece">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-table-1">Liste des Pièces Renumérotées
            <div style="float:right; cursor:pointer;">
                <a href="<?php echo url_for('@renumerotation') ?>" style="color: #c5d52b;" >
                    <img style="width: 16px;" src="/images/icon/add.png" /> Renuméroter Pièce </a>
            </div>
        </span>
    </div>
    <div class="dataTables_filter">
        <table style="width: 100%">
            <tr>
                <td style="vertical-align: middle; font-weight: bold;">Statut:</td>
                <td>
                    <select id="staut_filtre" class="mws-select2 large" style="position: relative; width: 150px">
                        <option value=""></option>
                        <option value="">Toutes</option>
                        <option value="1">Validées</option>
                        <option value="0">Non validées</option>
                    </select>
                </td>

                <td style="vertical-align: middle; font-weight: bold; text-align:right;">Numéro du :
                    <input type="text" id="num_deb"  style=" width: 50%;" onkeyup="goPage(1);"/>
                </td>
                <td style="vertical-align: middle; font-weight: bold;">Au :
                    <input type="text" id="num_fin"  style=" width: 50%;" onkeyup="goPage(1);"/>
                </td>

                <td style="vertical-align: middle; font-weight: bold; text-align:right;">Date du :
                    <input type="text" id="date_deb" name="date_deb" style=" width: 50%;" />
                </td>
                <td style="vertical-align: middle; font-weight: bold;">Au :
                    <input type="text" id="date_fin" name="date_fin" style=" width: 50%;" />
                </td>
                <td>
                    <a style="cursor: pointer; padding: 6px 10px;" title="Réinitialiser" onclick="initform()" class="btn btn-small"><i class="icon-repeat"></i></a>
                </td>
            </tr> 

        </table>
    </div>
    <div class="mws-panel-body">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
            <table id="listPiece" class="mws-datatable-fn mws-table">
                <thead>
                    <tr id="list_tri" style="border-bottom: 1px solid #000000" >
                        <th id="tri_journal" class="sorting" name="tri" onclick="tri('journal')">Journal </th>
                        <th id="tri_date" class="sorting" name="tri" onclick="tri('date')" style="width: 7%;">Date </th>  
                        <th style="width: 10%;">Nature</th>
                        <th style="width: 10%;">N° externe</th>
                        <th id="tri_numero" class="sorting" name="tri" onclick="tri('numero')" style="width: 10%;">Ancien N° </th>
                        <th id="tri_numero" class="sorting" name="tri" onclick="tri('numero')" style="width: 10%;">Nouveau N° </th>
                        <th id="tri_user" class="sorting" name="tri" onclick="tri('user')" style="width: 15%;">Utilisateur </th>
                        <th style="width: 10%;">Opérations</th>
                <input type="hidden" id="type_tri" value="">
                <input type="hidden" id="tri" value="">
                </tr>
                <tr>
                    <th ><input type="text" id="journal" onkeyup="goPage(1);" style="width: 100%;" /></th>
                    <th></th>
                    <th><input id="num" onkeyup="goPage(1);" type="text" style="width: 100%;" /></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>          
                </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td style="width: 100%;padding: 0" colspan="8">
                            <div id="list_piece_pager" style="background: none repeat scroll 0 0 #444444;width: 100%;float: left"></div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php include_partial("modification_numero/liste", array("pager" => $pager, "page" => $page)) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="bpopup ui-dialog" id="supprimer_piece" style="left: 30%; position: absolute; z-index: 9999; display: none;">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
        <span id="ui-dialog-title-mws-jui-dialog" class="ui-dialog-title">Suppression</span>
        <a class="ui-dialog-titlebar-close ui-corner-all" href="#" role="button">
        </a>
    </div>
    <div class="content">

        <div style="color: red;font-size: 18px; padding: 30px;">Voulez-vous Supprimer Cette Pièce Comptable ?</div>

        <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix" style="text-align: right">
            <input class="mws-button black mws-i-24 i-cross large" type="button" value="Annuler" onclick="annulerSuppressionPiece();" />
            <input class="mws-button red mws-i-24 i-check large" type="button" value="Supprimer" onclick="deletePiece();" />
        </div>
    </div>
</div>

<script  type="text/javascript">
    $(document).ready(function() {
        $('#staut_filtre').select2({placeholder: 'Sélectionner un Statut'});

    });
    $("#date_deb").datepicker({
        numberOfMonths: 2,
        onSelect: function(selectedDate) {
            goPage(1);
            $("#date_fin").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#date_fin").datepicker({
        numberOfMonths: 2,
        onSelect: function(selectedDate) {
            goPage(1);
            $("#date_deb").datepicker("option", "maxDate", selectedDate);
        }
    });

    $("#date_deb").mask("99/99/9999");
    $("#date_fin").mask("99/99/9999");
    $('#staut_filtre').change(function() {
        goPage(1);
    });
    function initform() {

        $("#staut_filtre").select2("val", "");
        $('#date_deb').val('');
        $('#date_fin').val('');
        $('#num_deb').val('');
        $('#num_fin').val('');
        $('#journal').val('');
        $('#num').val('');
        goPage(1);
    }

    function tri(type) {
        $('#list_tri th[name=tri]').each(function() {

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
        $('#image_loading').css('display', 'block');
        var type = $('#type_tri').val();
        type = 'ligne_' + type;
        $.ajax({
            url: '<?php echo url_for('@goPagePieceModifNum'); ?>',
            data: 'page=' + page + '&journal=' + $('#journal').val() + '&num=' + $('#num').val() +
                    '&date_debut=' + $('#date_deb').val() + '&date_fin=' + $('#date_fin').val() +
                    '&num_debut=' + $('#num_deb').val() + '&num_fin=' + $('#num_fin').val() +
                    '&type_tri=' + $('#type_tri').val() + '&tri=' + $('#tri').val() +
                    '&statut=' + $('#staut_filtre').val(),
            success: function(data) {
                $('#listPiece tbody').html(data);
                $("table.mws-table tbody tr:even").addClass("even");
                $("table.mws-table tbody tr:odd").addClass("odd");
                $('#listPiece tbody td[name=' + type + ']').each(function() {
                    $(this).attr('class', '  sorting_1');
                });
                $('#image_loading').css('display', 'none');
            }
        });
    }

    function showPiece(id) {
        $.ajax({
            url: '<?php echo url_for('@showPieceModifNum') ?>',
            data: 'id=' + id,
            success: function(data) {
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
            url: '<?php echo url_for('@showProprietePieceModifNum') ?>',
            data: 'id=' + id,
            success: function(data) {
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
            url: '<?php echo url_for('@showEditPieceDuplique') ?>',
            data: 'id=' + id,
            success: function(data) {
                $('#form_show_edit_piece').html(data);
                $('#form_show_piece').fadeOut();
                $('#form_liste_piece').fadeOut();
                $('#form_show_propriete_piece').fadeOut();
                $('#form_show_edit_piece').delay(500).fadeIn();
            }
        });
    }

    var piece_id_delete = '';
    function deletePiece() {

        $.ajax({
            url: '<?php echo url_for('@deletePieceDuplique') ?>',
            data: 'id=' + piece_id_delete,
            success: function(data) {
                $('#listPiece tbody').html(data);
                annulerSuppressionPiece();
            }
        });
    }

    function openPopupSupprimer(id) {
        piece_id_delete = id;
        $('#supprimer_piece').bPopup();
    }

    function annulerSuppressionDossier() {
        $('#supprimer_piece').bPopup().close();
    }

    function formatLigne(index) {
        $('#listPiece tbody tr').each(function() {
            $(this).css('background', '');
            $(this).css('border-bottom', '');
            $(this).css('border-top', '');
        });

        $('#ligne_' + index).css('background', 'repeat-x scroll left bottom #d8d6d6');
        $('#ligne_' + index).css('border-bottom', '1px solid #000000');
        $('#ligne_' + index).css('border-top', '1px solid #000000');

//        index_ligne = $('#ligne_' + index).attr('index_ligne');
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