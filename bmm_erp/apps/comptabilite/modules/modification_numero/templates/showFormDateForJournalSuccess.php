<span class="titre_piece_modal">Piéce Compable : N° <?php echo $piece->getNumero() ?></span>

<table id="form_piece" class="table table-bordered table-hover">
    <tr>
        <td style="width: 25%;">Journal comptable :</td>
        <td style="width: 75%;"><input type="text" value="<?php echo $piece->getJournalcomptable() ?>" readonly="true" style="width: 100%;"></td>
    </tr>
    <tr>
        <td>Date :</td>
        <td><input type="date" value="<?php echo date('Y-m-d', strtotime($piece->getDate())) ?>" readonly="true"></td>
    </tr>
    <tr>
        <td>Série :</td>
        <td><input type="text" value="<?php echo $piece->getNumeroseriejournal() ?>" readonly="true" style="width: 100%;"></td>
    </tr>
    <tr>
        <td>Numéro :</td>
        <td><input type="text" value="<?php echo $piece->getNumero() ?>" readonly="true" style="width: 100%;"></td>
    </tr>
    <tr style="background-color: #EDEDED"><td colspan="2"></td></tr>
    <tr>
        <td>Nouveau Journal :</td>
        <td>
            <select id="new_journal" onchange="getSerieNewNumber()">
                <option value=""></option>
                <?php foreach ($journals as $journal): ?>
                    <?php if ($piece->getIdJournalcomptable() != $journal->getId()): ?>
                        <option value="<?php echo $journal->getId() ?>"><?php echo $journal->getCode() . ' - ' . $journal->getLibelle() ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Nouvelle Date :</td>
        <td><input type="date" id="new_date" value="<?php echo $piece->getDate(); ?>" readonly="true"></td>
    </tr>
    <tr>
        <td>Nouvelle Série :</td>
        <td>
            <input type="text" id="new_serie" readonly="true" style="width: 100%;">
            <input type="hidden" id="new_serie_id">
        </td>
    </tr>
    <tr>
        <td>Nouveau Numéro :</td>
        <td><input type="text" id="new_numero" readonly="true" style="width: 100%;"></td>
    </tr>
</table>

<script  type="text/javascript">

    function getSerieNewNumber() {
        var date_saisie = $('#new_date').val();
        var d1 = new Date(<?php echo date('Y') ?>, <?php echo date('m') ?>, <?php echo date('d') ?>);
        var date_s = date_saisie.split("-");
        var d2 = new Date(date_s[0], date_s[1], date_s[2]);
        if (d1 >= d2) {
            goGetSerie(0);
        }
        else if (d1 < d2) {
            bootbox.confirm({
                message: "La date saisie est une date postérieure, voulez-vous continuer ?",
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
                        $('#new_date').val(date_saisie);
                        goGetSerie();
                    } else {
                        $('#new_date').val('');
                        $('#new_serie').val('');
                        $('#new_numero').val('');
                        $('#new_date').focus();
                    }
                }
            });
        }
    }
    function goGetSerie() {
        var journal_id = $('#new_journal').val();
        $.ajax({
            dataType: 'json',
            url: '<?php echo url_for('@getSerieJournal') ?>',
            data: 'journal=' + journal_id + '&date=' + $('#new_date').val(),
            success: function (data) {
                if (data.bloque == '0') {
                    $('#new_serie').val(data.serie);
                    $('#new_serie_id').val(data.serie_id);
                    $('#new_numero').val(data.numero);
                    $('#new_numero').focus();
                } else {
                    $('#new_date').val('');
                    bootbox.dialog({
                        message: "<span class='bigger-110' style='margin:20px;'>La date saisie appartient à une série bloquée!</span>",
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Ok",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                    $('#new_date').focus();
                }
            }
        });
    }

</script>

<script  type="text/javascript">

    $('#new_journal').attr('class', "chosen-select form-control");
    $('#new_journal').attr('style', 'width: 100%;');

    if (!ace.vars['touch']) {
        $('.chosen-select').chosen({allow_single_deselect: true});
        //resize the chosen on window resize

        $(window)
                .off('resize.chosen')
                .on('resize.chosen', function () {
                    $('.chosen-select').each(function () {
                        var $this = $(this);
                        $this.next().css({'width': $this.parent().width()});
                    })
                }).trigger('resize.chosen');
        //resize chosen on sidebar collapse/expand
        $(document).on('settings.ace.chosen', function (e, event_name, event_val) {
            if (event_name != 'sidebar_collapsed')
                return;
            $('.chosen-select').each(function () {
                var $this = $(this);
                $this.next().css({'width': $this.parent().width()});
            })
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

    .modal-dialog {width: 890px;}
    td > label{font-size: 18px;}
    .titre_piece_modal{font-size: 16px; color: #2679b5;}
    #form_piece{width: 90%; margin: 5% 5% 0% 5%;}
    #form_piece tbody tr td{padding: 5px;}

</style>