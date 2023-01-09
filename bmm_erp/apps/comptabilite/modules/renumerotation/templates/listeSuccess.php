<div id="sf_admin_container">
    <h1 id="replacediv"> Utilitaires
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Liste des Pièces Rénumérotées - Exercice <?php echo $_SESSION['exercice']; ?>
        </small>
    </h1>
</div>

<div id="form_show_piece" style="display: none;">

</div>

<div id="form_show_propriete_piece" style="display: none;">

</div>

<div class="row" id="form_liste_piece">
    <div>
        <div class="col-sm-12">
            <a style="width: 200px;" href="<?php echo url_for('renumerotation/index') ?>" class="btn btn-app btn-primary radius-4">
                <i class="ace-icon fa fa-pencil-square-o bigger-190"></i>
                Renuméroter Pièce
            </a>
        </div>
    </div>

    <table style="width: 100%">
        <tr>
            <td style="vertical-align: middle; font-weight: bold;">Numéro du :
                <input type="text" id="num_deb" onkeyup="goPage(1);"/>
            </td>
            <td style="vertical-align: middle; font-weight: bold;">Au :
                <input type="text" id="num_fin" onkeyup="goPage(1);"/>
            </td>

            <td style="vertical-align: middle; font-weight: bold;">
                <label style="width: 100%;">Date du : </label>
                <input type="date" id="date_deb" name="date_deb" />
            </td>
            <td style="vertical-align: middle; font-weight: bold;">
                <label style="width: 100%;">Au : </label>
                <input type="date" id="date_fin" name="date_fin" />
            </td>
            <td style="vertical-align: bottom;">
                <button title="Réinitialiser" onclick="initform()" class="btn btn-primary"><i class="ace-icon fa fa-refresh" style="margin-right: 0px; margin-top: 0px;"></i></button>
            </td>
        </tr> 
    </table>
    <div class="mws-panel-body">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
            <table id="listPiece" class="mws-datatable-fn mws-table">
                <thead>
                    <tr id="list_tri" style="border-bottom: 1px solid #000000" >
                        <th id="tri_journal" class="sorting" name="tri" onclick="tri('journal')">Journal Comptable</th>
                        <th id="tri_date" class="sorting" name="tri" onclick="tri('date')" style="width: 7%;">Date</th>  
                        <th style="width: 10%;">Numéro</th>
                        <th style="width: 10%;">Ancien Numéro</th>
                        <th id="tri_numero" class="sorting" name="tri" onclick="tri('numero')" style="width: 10%;">Débit</th>
                        <th id="tri_numero" class="sorting" name="tri" onclick="tri('numero')" style="width: 10%;">Crédit</th>
                        <th id="tri_user" class="sorting" name="tri" onclick="tri('user')" style="width: 15%;">Utilisateur</th>
                        <th style="width: 10%;">Opérations</th>
                    </tr>
                    <tr>
                        <th><input type="text" id="journal" onkeyup="goPage(1);" style="width: 100%;" /></th>
                        <th></th>
                        <th><input id="num" onkeyup="goPage(1);" type="text" class="align_center" style="width: 100%;" /></th>
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
                    <?php include_partial("renumerotation/liste", array("pager" => $pager, "page" => $page)) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<input type="hidden" id="type_tri" value="">
<input type="hidden" id="tri" value="">

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

    $('#date_deb').change(function () {
        goPage(1);
    });

    $('#date_fin').change(function () {
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
            url: '<?php echo url_for('renumerotation/goPage'); ?>',
            data: 'page=' + page + '&journal=' + $('#journal').val() + '&num=' + $('#num').val() +
                    '&date_debut=' + $('#date_deb').val() + '&date_fin=' + $('#date_fin').val() +
                    '&num_debut=' + $('#num_deb').val() + '&num_fin=' + $('#num_fin').val() +
                    '&type_tri=' + $('#type_tri').val() + '&tri=' + $('#tri').val(),
            success: function (data) {
                $('#listPiece tbody').html(data);
                $('#listPiece tbody td[name=' + type + ']').each(function () {
                    $(this).attr('class', '  sorting_1');
                });
            }
        });
    }

    function showPiece(id) {
        $.ajax({
            url: '<?php echo url_for('renumerotation/show') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#form_show_piece').html(data);
                $('#form_liste_piece').fadeOut();
                $('#form_show_propriete_piece').fadeOut();
                $('#form_show_piece').delay(500).fadeIn();
            }
        });
    }
    function showProprietePiece(id) {
        $.ajax({
            url: '<?php echo url_for('renumerotation/showPropriete') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#form_show_propriete_piece').html(data);
                $('#form_liste_piece').fadeOut();
                $('#form_show_piece').fadeOut();
                $('#form_show_propriete_piece').delay(500).fadeIn();
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
    document.title = ("BMM - G. Compta. : U. Liste des Pièces Rénumérotées");
</script>