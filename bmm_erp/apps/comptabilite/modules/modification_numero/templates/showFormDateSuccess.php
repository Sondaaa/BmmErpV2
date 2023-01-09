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
        <td>Nouvelle Date :</td>
        <td><input type="date" id="new_date" onchange="getSerieNewNumber()"></td>
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
            $('#new_date').val('');
            $('#new_serie').val('');
            $('#new_numero').val('');
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
                        $('#new_date').focus();
                    }
                }
            });
        }
    }
    function goGetSerie() {
        var journal_id = '<?php echo $piece->getIdJournalcomptable() ?>';
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

<style>

    .modal-dialog {width: 740px;}
    td > label{font-size: 18px;}
    .titre_piece_modal{font-size: 16px; color: #2679b5;}
    #form_piece{width: 90%; margin: 5% 5% 0% 5%;}
    #form_piece tbody tr td{padding: 5px;}

</style>