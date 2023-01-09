

<div class="mws-panel grid_8" id="form_liste_piece">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-table-1">Liste des Pièces Comptables Invalides</span>
    </div>
    <div class="dataTables_filter">
        <table style="width: 100%">
            <tr>
<!--                <td style="vertical-align: middle; font-weight: bold;">Statut:</td>
                <td>
                    <select id="staut_filtre" class="mws-select2 large" style="position: relative; width: 150px">
                        <option value=""></option>
                        <option value="">Toutes</option>
                        <option value="1">Validées</option>
                        <option value="0">Non validées</option>
                    </select>
                </td>-->

                <td style="vertical-align: middle; font-weight: bold; text-align:right;">Numéro du :
                    <input type="text" id="num_deb"  style=" width: 50%;" onkeyup="goPage(1);"/>
                </td>
                <td style="vertical-align: middle; font-weight: bold;">Au :
                    <input type="text" id="num_fin"  style=" width: 50%;" onkeyup="goPage(1);"/>
                </td>

                <td style="vertical-align: middle; font-weight: bold; text-align:right;">Date du :
                    <input type="text" id="date_deb" name="date_deb" style=" width: 55%;" />
                </td>
                <td style="vertical-align: middle; font-weight: bold;">Au :
                    <input type="text" id="date_fin" name="date_fin" style=" width: 65%;" />
                </td>
<!--                <td style="width: 12%" >
                    <a  style="cursor: pointer ; float: right;" title="Imprimer Liste" onclick="imprimeListe()" class="btn">Imprimer Liste</a>
                </td>
                <td id="zone_pdf" style="width: 5%; padding-left: 1%">

                </td>-->
                <td style="text-align: right; width: 5%">
                    <a style="cursor: pointer; padding: 6px 10px;" title="Réinitialiser" onclick="initform()" class="btn btn-small"><i class="icon-repeat"></i></a>
                </td>

            </tr> 

        </table>
    </div>
    <div class="mws-panel-body">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
            <table id="listPiece" class="mws-datatable-fn mws-table">
                <thead>
                    <tr id="list_tri" style="border-bottom: 1px solid #000000" role="row" >
                        <th class="sorting" id="tri_journal" name="tri"  onclick="tri('journal')">Journal </th>
                        <th class="sorting" id="tri_date" name="tri" onclick="tri('date')" style="width: 10%;">Date </th>  
                        <th class="sorting" id="tri_numero" name="tri" onclick="tri('numero')" style="width: 10%;">Numéro </th>
                        <th class="sorting" id="tri_serie" name="tri" onclick="tri('serie')" style="width: 10%;">Série </th> 
                        <th style="width: 10%;">Total débit</th>
                        <th style="width: 10%;">Total cédit</th>
                        <th class="sorting" id="tri_user" name="tri" onclick="tri('user')" style="width: 20%;">Utilisateur </th>
                        
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
                </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td style="width: 100%;padding: 0" colspan="7">
                            <div id="list_piece_pager" style="background: none repeat scroll 0 0 #444444;width: 100%;float: left"></div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php include_partial("saisie_pieces/listeAlertPieceInvalide", array("pager" => $pager, "page" => $page)) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<script  type="text/javascript">
    
    $("#date_deb").datepicker({
        numberOfMonths: 1,
        onSelect: function(selectedDate) {
            goPage(1);
            $("#date_fin").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#date_fin").datepicker({
        numberOfMonths: 1,
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
            url: '<?php echo url_for('@listeAlertPieceInvalide'); ?>',
            data: 'page=' + page + '&journal=' + $('#journal').val() + '&num=' + $('#num').val() +
                    '&date_debut=' + $('#date_deb').val() + '&date_fin=' + $('#date_fin').val() +
                    '&num_debut=' + $('#num_deb').val() + '&num_fin=' + $('#num_fin').val() +
                    '&type_tri=' + $('#type_tri').val() + '&tri=' + $('#tri').val() ,
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

    

    function formatLigne(index) {
        $('#listPiece tbody tr').each(function() {
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