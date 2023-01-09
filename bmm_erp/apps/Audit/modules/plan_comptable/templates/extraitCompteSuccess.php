<div id="sf_admin_container">
    <h1 id="replacediv"> Extrait Compte :
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            <?php echo $compte->getNumeroCompte(); ?> : <?php echo $compte->getLibelle(); ?>
        </small>
    </h1>
</div>

<div>
    <table style="width: 100%" class="tab_filter">
        <thead>
            <tr>
                <th style="text-align:left; padding-left: 1%; width: 30%; font-weight: bold;">Journal comptable</th>
                <th style="text-align:left; padding-left: 1%; width: 10%; font-weight: bold;">Ordre</th>
                <th style="text-align:left; padding-left: 1%; width: 35%; font-weight: bold;">Période</th>
                <th style="text-align:left; padding-left: 1%; width: 15%; font-weight: bold;">Affichage</th>
                <th style="text-align:left; padding-left: 1%; width: 10%; font-weight: bold;"></th>
            </tr>
        </thead>
        <tr>
            <td>
                <select id="journal" class="mws-select2 large" style="width: 80%">
                    <option value=''></option>
                    <?php foreach ($journals as $journal): ?>
                        <option value="<?php echo $journal->getId() ?>"> <?php echo $journal->getLibelle() ?> </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <input type="radio" checked="checked" name="ordre" value="date" /> Date
                <br>
                <input type="radio" name="ordre" value="lettre"/> Lettre
            </td>
            <td>
                Du <input type="date" id="date_debut"/> 
                Au <input type="date" id="date_fin"/> 
            </td>
            <td>
                <input type="radio" name="lettre" value="non_lettre"/> Non lettrées
                <br>
                <input type="radio" name="lettre" value="oui_lettre"/> Lettrées
                <br>
                <input type="checkbox" name="selection" id="simule"/> Simulé
            </td>
            <td>
                <button style="cursor:pointer;" onclick="afficher()" class="btn btn-sm btn-primary">
                    <i class="ace-icon fa fa-search bigger-110"></i>
                    <span class="bigger-110 no-text-shadow">Afficher</span>
                </button>
            </td>
        </tr>
    </table>
</div>

<div id="liste_etat_extrait_compte" style="margin-top: 20px;">

</div>

<script  type="text/javascript">

    function initform() {
        $('#date_deb').val('');
        $('#date_fin').val('');
        $('#num_deb').val('');
        $('#num_fin').val('');
        $('#journal').val('');
        $('#num').val('');
//        goPage(1);
    }

    function goPage(page) {
        var statut;
        if ($('#staut_filtre').val() == '')
            statut = '';
        else
            statut = $('#staut_filtre').val();
        $.ajax({
            url: '<?php //echo url_for('@goPagePieceSuppression');        ?>',
            data: 'page=' + page + '&num=' + $('#num').val() +
                    '&date_debut=' + $('#date_deb').val() + '&date_fin=' + $('#date_fin').val() +
                    '&num_debut=' + $('#num_deb').val() + '&num_fin=' + $('#num_fin').val() +
                    '&type_tri=' + $('#type_tri').val() + '&tri=' + $('#tri').val() +
                    '&statut=' + statut + '&journal_id=' + $('#journal_id').val(),
            success: function (data) {
                $('#listPiece tbody').html(data);
            }
        });
    }

    function afficher() {
        var order = '';
        var lettre = '';
        $('input[name=ordre]').each(function () {
            if ($(this).is(':checked'))
                order = $(this).val();
        });

        $('input[name=lettre]').each(function () {
            if ($(this).is(':checked'))
                lettre = $(this).val();
        });

        $.ajax({
            url: '<?php echo url_for('etat/afficherEtatExtraitCompte') ?>',
            data: 'compte=' + '<?php echo $compte->getId(); ?>' + '&journal=' + $('#journal').val() +
                    '&date_debut=' + $('#date_debut').val() + '&date_fin=' + $('#date_fin').val() +
                    '&order=' + order + '&lettre=' + lettre,
            success: function (data) {
                $('#liste_etat_extrait_compte').html(data);
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
    function showProprietePiece(id) {
        $.ajax({
            url: '<?php //echo url_for('@showProprietePiece')        ?>',
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



    function formatLigne(index) {
        $('#listPiece tbody tr').each(function () {
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

<style>
    .header_table th{
        font-weight: bold;
        font-size: 13px;
    }
</style>