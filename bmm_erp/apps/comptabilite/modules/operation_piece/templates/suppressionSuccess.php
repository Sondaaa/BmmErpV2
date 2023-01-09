<div id="sf_admin_container">
    <h1 id="replacediv"> Utilitaires
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Suppression des Pièces Comptables - Exercice <?php echo $_SESSION['exercice']; ?>
        </small>
    </h1>
</div>

<div class="mws-panel grid_8" >
    <div class="mws-panel-body no-padding">
        <form>
            <div class="mws-form-inline">
                <table>
                    <tr>
                        <td>
                            <div class="mws-form-row">
                                <label>Journal : </label>
                                <div class="mws-form-item small">
                                    <select id="journal_id" class="mws-select2 large" style=" width: 400px" onchange="goPage(1)">
                                        <option value=""></option>
                                        <?php foreach ($journals as $journal) : ?>
                                            <option value="<?php echo $journal->getId() ?>" ><?php echo $journal->getCode() . ' - ' . $journal->getLibelle(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </td> 
                    </tr>
                </table>

                <div class="mws-panel grid_8" id="form_liste_piece">
                    <div class="mws-panel-header">
                        <span class="mws-i-24 i-table-1">Liste des Pièces Comptables

                        </span>
                    </div>
                    <div class="dataTables_filter">
                        <table style="width: 100%">
                            <tr>
                                <td style="vertical-align: middle; font-weight: bold; text-align:right;">Numéro du :
                                    <input type="text" id="num_deb" style=" width: 50%;" onkeyup="goPage(1);"/>
                                </td>
                                <td style="vertical-align: middle; font-weight: bold;">Au :
                                    <input type="text" id="num_fin" style=" width: 50%;" onkeyup="goPage(1);"/>
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
                                        <th id="tri_date" class="sorting" name="tri" onclick="tri('date')" style="width: 10%;">Date </th>  
                                        <th id="tri_numero" class="sorting" name="tri" onclick="tri('numero')" style="width: 10%;">Numéro </th>
                                        <th id="tri_serie" class="sorting" name="tri" onclick="tri('serie')" style="width: 10%;">Série </th> 
                                        <th style="width: 10%;">Total débit</th>
                                        <th style="width: 10%;">Total cédit</th>
                                        <th id="tri_user" class="sorting" name="tri" onclick="tri('user')" style="width: 20%;">Utilisateur </th>
                                        <th style="width: 10%;">Opérations</th>
                                    </tr>
                                    <tr>

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
                                        <td style="width: 100%;padding: 0" colspan="7">
                                            <div id="list_piece_pager" style="background: none repeat scroll 0 0 #444444;width: 100%;float: left"></div>
                                        </td>
                                    </tr>
                                </tfoot>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script  type="text/javascript">
    $('#staut_filtre').change(function () {
        goPage(1);
    });

    function initform() {
        $('#date_deb').val('');
        $('#date_fin').val('');
        $('#num_deb').val('');
        $('#num_fin').val('');
        $('#journal').val('');
        $('#num').val('');
        $('#listPiece tbody').html('');
    }

    function goPage(page) {
        var type = $('#type_tri').val();
        type = 'ligne_' + type;
        $.ajax({
            url: '<?php echo url_for('operation_piece/goPageSuppression'); ?>',
            data: 'page=' + page + '&num=' + $('#num').val() +
                    '&date_debut=' + $('#date_deb').val() + '&date_fin=' + $('#date_fin').val() +
                    '&num_debut=' + $('#num_deb').val() + '&num_fin=' + $('#num_fin').val() +
                    '&journal_id=' + $('#journal_id').val(),
            success: function (data) {
                $('#listPiece tbody').html(data);
            }
        });
    }

    function showPiece(id) {
        $.ajax({
            url: '<?php echo url_for('@showPiece') ?>',
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

    function deletePiece(id) {

        $.ajax({
            url: '<?php echo url_for('operation_piece/deleteSuppression') ?>',
            data: 'id=' + id,
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
