<span class="titre_tiers_modal">Comptes Comptables</span>

<div style="margin-top: 10px;">
    <table class="table table-bordered table-hover">
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
            <td style="width: 30%">
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
</div>
<div style="height: 300px; overflow: auto;" >
    <table id="myTable01" style="width: 100%" class="table table-bordered table-hover" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>Numéro</th>
                <th style="text-align: left;">Intitulé du Compte</th>
                <th>Classe</th>
                <th>Bloquer</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php include_partial("journal/list_comptes_journal", array("comptes" => $comptes, "journal" => $journal)) ?>
        </tbody>
    </table>
</div>

<script  type="text/javascript">

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
    $('input:text').attr('style', 'width: 100%;');

</script>

<style>

    .modal-dialog {width: 820px;}
    #myTable01 thead th{text-align: center;}
    #myTable01 tbody td{vertical-align: middle; text-align: center;}
    .titre_tiers_modal{font-size: 16px; color: #146bbf !important;}

</style>