<h3 style="margin-top: 0px; color: #08C;">Liste des comptes comptables</h3>

<table>
    <tr>
        <td style="width: 30%">
            <label class="mws-form-label">Numéro du Compte Comptable :</label>
            <div class="mws-form-item">
                <input class="large" type="text" id="search_numero" onkeyup="searchByNumeroAndLibelle()">
            </div>
        </td>
        <td style="width: 40%">
            <label class="mws-form-label">Intitulé du Compte Comptable :</label>
            <div class="mws-form-item">
                <input class="large" type="text" id="search_libelle" onkeyup="searchByNumeroAndLibelle()">
            </div>
        </td>
        <td style="width: 20%">
            <label class="mws-form-label">Classe comptable :</label>
            <div class="mws-form-item">
                <select id="class_comptable" onchange="searchByNumeroAndLibelle()">
                    <option value="">Tous les classes</option>
                    <?php foreach ($classe_compte as $cc): ?>
                        <option value="<?php echo $cc->getId(); ?>"><?php echo $cc->getLibelle(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </td>
    </tr>
</table>

<div style="height: 350px; overflow: auto; margin-bottom: 15px;">
    <table id="myTable01">
        <thead>
            <tr>
                <th style="width: 4%;"><input id="selecte_all" type="checkbox"></th>
                <th style="width: 10%;">Numéro</th>
                <th style="width: 64%;">Intitulé</th>
                <th style="width: 22%;">Classe</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comptes as $compte): ?>
                <tr class="ligne_compte" data_libelle="<?php echo $compte->getLibelle(); ?>" data_number="<?php echo $compte->getNumerocompte(); ?>" data_class="<?php echo $compte->getIdClasse(); ?>" check_input="check_input_<?php echo $compte->getId(); ?>">
                    <td><input id="check_input_<?php echo $compte->getId(); ?>" add="1" class="list_checbox_compte" value="<?php echo $compte->getId(); ?>" type="checkbox"/></td>
                    <td>
                        <b><?php echo $compte->getNumerocompte(); ?></b>
                        <input type="hidden" name="compte_dossier" value="<?php echo $compte->getId(); ?>"/>
                    </td>
                    <td><?php echo $compte->getLibelle(); ?></td>
                    <td><?php echo $compte->getClassecompte(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script  type="text/javascript">

    function searchByNumeroAndLibelle() {
        var libelle = '';
        var numero = '';
        var class_compte = '';
        var motiflib = $('#search_libelle').val();
        var motifnum = $('#search_numero').val();
        var motifclass = $('#class_comptable').val();
        motiflib = motiflib.toUpperCase();
        $('#myTable01 tbody tr').each(function () {
            libelle = $(this).attr('data_libelle');
            numero = $(this).attr('data_number');
            class_compte = $(this).attr('data_class');
            var indexlib = libelle.indexOf(motiflib);
            var indexnum = numero.indexOf(motifnum);
            var indexclass = class_compte.indexOf(motifclass);
            if (indexlib >= 0 && indexnum >= 0 && indexclass >= 0) {
                $(this).css('display', '');
                var inputcheck = $(this).attr('check_input');
                $('#' + inputcheck).attr('add', '1');
            }
            else {
                $(this).css('display', 'none');
                var inputcheck = $(this).attr('check_input');
                $('#' + inputcheck).attr('add', '0');
            }
        });
        getNombreCompte();
    }

    $('.list_checbox_compte').change(function () {
        $('#nombre_compte').html($('.list_checbox_compte[type=checkbox]:checked').length);
    });

    $('#selecte_all').change(function () {
        if ($('#selecte_all').is(':checked')) {
            $('.list_checbox_compte[type=checkbox][add=1]').prop('checked', true);
        } else {
            $('.list_checbox_compte[type=checkbox][add=1]').prop('checked', false);
        }
        $('#nombre_compte').html($('.list_checbox_compte[type=checkbox]:checked').length);
    });

</script>

<script  type="text/javascript">

    $('input:text').attr('style', 'width: 100%;');
    $("table").addClass("table table-bordered table-hover");

    $('#class_comptable').attr('class', "chosen-select form-control");
    $('#class_comptable').attr('style', 'width: 100%;');

    if (!ace.vars['touch']) {
        $('.chosen-select').chosen({allow_single_deselect: true});
        //resize the chosen on window resize

        $(window)
                .off('resize.chosen')
                .on('resize.chosen', function () {
                    $('.chosen-select').each(function () {
                        var $this = $(this);
                        $this.next().css({'width': $this.parent().width()});
                    });
                }).trigger('resize.chosen');
        //resize chosen on sidebar collapse/expand
        $(document).on('settings.ace.chosen', function (e, event_name, event_val) {
            if (event_name != 'sidebar_collapsed')
                return;
            $('.chosen-select').each(function () {
                var $this = $(this);
                $this.next().css({'width': $this.parent().width()});
            });
        });


        $('#chosen-multiple-style .btn').on('click', function (e) {
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if (which == 2)
                $('#form-field-select-4').addClass('tag-input-style');
            else
                $('#form-field-select-4').removeClass('tag-input-style');
        });
    }

    $('.chosen-container').attr("style", "width: 100%;");
    $('.chosen-container').trigger("chosen:updated");

</script>

<style>

    .modal-dialog {width: 800px;}

</style>