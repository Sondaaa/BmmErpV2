<div id="sf_admin_container">
    <h1 id="replacediv"> Base Comptable 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Liste des Maquettes de Saisie
        </small>
    </h1>
</div>

<div id="show_maquette" style="display: none;">

</div>
<div id="show_edit_maquette" style="display: none;">

</div>

<div class="mws-panel grid_8" id="form_liste_piece">
    <div class="col-xs-9">
        <table>
            <tr>
                <td style="vertical-align: middle; width: 18%">Journal Comptable :</td>
                <td style="width: 54%">
                    <select id="journal_id" <?php if (count($journals) == 0): ?> disabled="true" <?php endif;?>>
                        <option value=""></option>
                        <?php foreach ($journals as $journal) : ?>
                            <option value="<?php echo $journal->getId() ?>" ><?php echo $journal->getCode() . ' - ' . $journal->getLibelle(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td style="vertical-align: middle; width: 13%">Nature Pièce :</td>
                <td style="width: 15%">
                    <select id="nature_piece"  <?php if (count($journals) == 0): ?> disabled="true" <?php endif;?>>
                        <option value=""></option>
                        <?php foreach ($natures as $nature) : ?>
                            <option value="<?php echo $nature->getId() ?>" ><?php echo $nature->getLibelle(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-xs-3">
        <table>
            <tr>
                <td style="vertical-align: middle; text-align: center;">
                    <a class="btn btn-xs btn-success" style="font-size: 14px; padding-left: 10px; padding-right: 10px;" href="<?php echo url_for('maquette_saisie/new') ?>"><i class="ace-icon fa fa-plus"></i> Ajouter Maquette de Saisie</a>
                </td>
            </tr>
        </table>
    </div>
    <div class="mws-panel-body">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
            <table id="listMaquette" class="mws-datatable-fn mws-table">
                <thead>
                    <tr id="list_tri" style="border-bottom: 1px solid #000000">
                        <th id="tri_code" class="sorting" name="tri" onclick="tri('code')" style="width: 10%; text-align: center;">Code</th>
                        <th id="tri_libelle" class="sorting" name="tri" onclick="tri('libelle')" style="width: 20%;">Libellé</th>  
                        <th id="tri_journal" class="sorting" name="tri" onclick="tri('journal')">Journal Comptable</th>
                        <th id="tri_nature" class="sorting" name="tri" onclick="tri('nature')" style="width: 10%; text-align: center;">Nature Pièce</th> 
                        <th style="width: 10%; text-align: center;">Date Création</th>
                        <th id="tri_user" class="sorting" name="tri" onclick="tri('user')" style="width: 15%; text-align: center;">Utilisateur</th>
                        <th style="width: 10%; text-align: center;">Opérations</th>
                    </tr>
                    <tr>
                        <th><input type="text" id="code" onkeyup="goPage(1);" class="align_center"/></th>
                        <th><input type="text" id="libelle" onkeyup="goPage(1);"/></th>
                        <th><input id="journal" onkeyup="goPage(1);" type="text"/></th>
                        <th><input type="text" id="nature" onkeyup="goPage(1);" class="align_center"/></th>
                        <th></th>
                        <th></th>
                        <th style="text-align: center;">
                            <a class="btn btn-xs btn-primary" style="cursor: pointer; padding: 6px 10px;" title="Réinitialiser" onclick="initform()"><i class="ace-icon fa fa-refresh"></i></a>
                        </th>
                    </tr>
                </thead>
                <tfoot id="listMaquette_footer">

                </tfoot>
                <tbody>
                    <?php include_partial("maquette_saisie/liste_maquette", array("pager" => $pager, "page" => $page)) ?>
                </tbody>
            </table>
            <input type="hidden" id="type_tri" value="">
            <input type="hidden" id="tri" value="">
        </div>
    </div>
</div>

<script  type="text/javascript">

    $('#journal_id').change(function () {
        goPage(1);
    });
    $('#nature_piece').change(function () {
        goPage(1);
    });
    function formatLigne(index) {
        $('#listMaquette tbody tr').each(function () {
            $(this).css('background', '');
            $(this).css('border-bottom', '');
            $(this).css('border-top', '');
        });
        $('#ligne_' + index).css('background', 'repeat-x scroll left bottom #d8d6d6');
        $('#ligne_' + index).css('border-bottom', '1px solid #000000');
        $('#ligne_' + index).css('border-top', '1px solid #000000');
    }
    function initform() {
        $('#code_maquette').val('');
        $('#nature').val('');
        $('#libelle').val('');
        $('#journal').val('');
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
            url: '<?php echo url_for('maquette_saisie/goPage'); ?>',
            data: 'page=' + page + '&code=' + $('#code').val() + '&nature=' + $('#nature').val() +
                    '&libelle=' + $('#libelle').val() + '&journal=' + $('#journal').val() +
                    '&type_tri=' + $('#type_tri').val() + '&tri=' + $('#tri').val() +
                    '&nature_id=' + $('#nature_piece').val() + '&journal_id=' + $('#journal_id').val(),
            success: function (data) {
                $('#listMaquette tbody').html(data);
            }
        });
    }
    function openPopupSupprimer(id) {
        bootbox.confirm({
            message: "Voulez-vous supprimer cette maquette de saisie ?",
            buttons: {
                cancel: {
                    label: "Non",
                    className: "btn-sm",
                },
                confirm: {
                    label: "Oui",
                    className: "btn-primary btn-sm",
                }
            },
            callback: function (result) {
                if (result) {
                    deleteMaquette(id);
                }
            }
        });
    }
    function deleteMaquette(id) {
        $.ajax({
            url: '<?php echo url_for('maquette_saisie/delete'); ?>',
            data: 'id=' + id + '&code=' + $('#code').val() + '&nature=' + $('#nature').val() +
                    '&libelle=' + $('#libelle').val() + '&journal=' + $('#journal').val() +
                    '&type_tri=' + $('#type_tri').val() + '&tri=' + $('#tri').val() +
                    '&nature_id=' + $('#nature_piece').val() + '&journal_id=' + $('#journal_id').val(),
            success: function (data) {
                $('#listMaquette tbody').html(data);
            }
        });
    }
    function showMaquette(id) {
        $.ajax({
            url: '<?php echo url_for('maquette_saisie/show'); ?>',
            data: 'maquette_id=' + id,
            success: function (data) {
                $('#show_maquette').html(data);
                $('#form_liste_piece').fadeOut();
                $('#show_maquette').fadeIn();
                $('#show_edit_maquette').fadeOut();
            }
        });
    }
    function showEditMaquette(id) {
        $.ajax({
            url: '<?php echo url_for('maquette_saisie/showEdit'); ?>',
            data: 'maquette_id=' + id,
            success: function (data) {
                $('#show_edit_maquette').html(data);
                $('#form_liste_piece').fadeOut();
                $('#show_maquette').fadeOut();
                $('#show_edit_maquette').fadeIn();
            }
        });
    }
    function ligneNumber() {
        var i = 1;
        $('#liste_ligne tbody tr').each(function () {
            var id = 'ligne_' + i;
            $(this).attr('id', id);
            $(this).attr('index_ligne', i);
            var format = 'formatLigne("' + i + '")';
            $(this).attr('onclick', format);
            i++;
        });
        var i = 1;
        $('[name="col_number"]').each(function () {
            $(this).text(i);
            i++;
        });
        var i = 1;
        $('[name="ck_compte"]').each(function () {
            var id = 'ck_compte_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="specification_compte"]').each(function () {
            var id = 'specification_compte_' + i;
            $(this).attr('id', id);
            var format = 'showCompte("' + i + '")';
            $(this).attr('onchange', format);
            i++;
        });
        var i = 1;
        $('[name="div_ligne_compte"]').each(function () {
            var id = 'div_ligne_compte_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="ligne_compte"]').each(function () {
            var id = 'ligne_compte_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="ck_montant"]').each(function () {
            var id = 'ck_montant_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="specification_montant"]').each(function () {
            var id = 'specification_montant_' + i;
            $(this).attr('id', id);
            var format = 'showMontant("' + i + '")';
            $(this).attr('onchange', format);
            i++;
        });
        var i = 1;
        $('[name="type_montant"]').each(function () {
            var id = 'type_montant_' + i;
            $(this).attr('id', id);
            i++;
        });

        var i = 1;
        $('[name="div_montant_saisi"]').each(function () {
            var id = 'div_montant_saisi_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="div_montant"]').each(function () {
            var id = 'div_montant_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="div_numero"]').each(function () {
            var id = 'div_numero_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="div_taux"]').each(function () {
            var id = 'div_taux_' + i;
            $(this).attr('id', id);
            i++;
        });

        var i = 1;
        $('[name="montant_ligne_saisi"]').each(function () {
            var id = 'montant_ligne_saisi_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="montant_ligne"]').each(function () {
            var id = 'montant_ligne_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="numero_ligne"]').each(function () {
            var id = 'numero_ligne_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="taux"]').each(function () {
            var id = 'taux_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="ck_contre"]').each(function () {
            var id = 'ck_contre_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="specification_contre"]').each(function () {
            var id = 'specification_contre_' + i;
            $(this).attr('id', id);
            var format = 'showContre("' + i + '")';
            $(this).attr('onchange', format);
            i++;
        });
        var i = 1;
        $('[name="div_ligne_contre"]').each(function () {
            var id = 'div_ligne_contre_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="ligne_contre"]').each(function () {
            var id = 'ligne_contre_' + i;
            $(this).attr('id', id);
            i++;
        });
        calculeTotal();
    }

</script>