<?php
$solde = 0;
$type_solde = '';
$solde = $piece->getTotalCredit() - $piece->getTotalDebit();

if (intval($solde) > 0) {
    $type_solde = '<span style="color: blue"> Créditeur </span>';
} else if (intval($solde) < 0) {
    $type_solde = '<span style="color: red"> Débiteur </span>';
} else {
    $type_solde = '';
}

$solde = number_format(abs($solde), 3, '.', ' ');
?>

<div class="row">
    <div class="col-xs-6">
        <div class="widget-box widget-color-purple">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Pièce Source</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <table class="table table-bordered table-hover" style="margin-bottom: 0px;">
                        <tr>
                            <td style="width: 25%">Date de Pièce :</td>
                            <td style="width: 35%">N° Pièce :</td>
                            <td style="width: 40%">Solde : <?php echo $type_solde; ?></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="date" readonly="readonly" value="<?php echo date('Y-m-d', strtotime($piece->getDate())); ?>">
                            </td>
                            <td>
                                <input type="text" class="align-center" value="<?php echo $piece->getNumero() ?>" readonly="readonly">
                                <input id="piece_source" type="hidden" value="<?php echo $piece->getId() ?>">
                            </td>
                            <td>
                                <input type="text" class="align-center" value="<?php echo $solde ?>" readonly="readonly">
                            </td>
                        </tr>
                        <tr>
                            <td>Code Journal :</td>
                            <td colspan="2">Journal Comptable * :</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="align-center" value="<?php echo trim($piece->getJournalcomptable()->getCode()) ?>" readonly="readonly">
                            </td>
                            <td colspan="2">
                                <input readonly="readonly" type="text" value="<?php echo trim($piece->getJournalcomptable()->getLibelle()) ?>">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="widget-box widget-color-blue2">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Nouvelle Pièce Compable</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <table class="table table-bordered table-hover" style="margin-bottom: 0px;">
                        <tr>
                            <td style="width: 25%">Date de Pièce :</td>
                            <td style="width: 75%">Libellé :</td>
                        </tr>
                        <tr>
                            <td>
                                <input id="date_new" type="date" value="<?php echo date('Y-m-d', strtotime($piece->getDate())); ?>">
                            </td>
                            <td>
                                <input id="libelle_new" type="text" value="<?php echo $piece->getLibelle(); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Journal Comptable * :</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <select id="journal_new" style="width: 100%">
                                    <?php foreach ($journal_piece as $j_piece): ?>
                                        <option id="journal_<?php echo $j_piece->getId(); ?>" libelle="<?php echo $j_piece->getLibelle(); ?>"  value="<?php echo $j_piece->getId(); ?>" <?php if ($piece->getIdJournalcomptable() == $j_piece->getId()) echo 'selected = "selected"' ?>><?php echo $j_piece->getCode() . ' - ' . $j_piece->getLibelle(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="
     margin-top: 10px;">
    <div class="col-xs-9">
        <table class="table table-bordered table-hover" id="table_numero" style="display: none">
            <tr>
                <td>
                    <div class="col-xs-1">Série</div>
                    <div class="col-xs-3">
                        <input id="new_serie" class="align-center" type="text" value="" readonly="true">
                        <input id="new_serie_id" type="hidden" value="">
                    </div>
                    <div class="col-xs-1">Numéro</div>
                    <div class="col-xs-4">
                        <input id="new_numero" class="align-center" type="text" value="" readonly="true">
                    </div>
                    <div class="col-xs-1"> </div>
                    <div class="col-xs-2">
                        <button class="btn btn-success" style="padding: 2px 12px;" onclick="validerDuplicationPiece()"><i class="ace-icon fa fa-save"></i> Enregistrer </button>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-xs-3">
        <table class="table table-bordered table-hover">
            <tr>
                <td style="text-align: center; padding: 6px;">
                    <button class="btn btn-primary" style="margin-right: 1%; padding: 3.5px 12px;" onclick="getSerie()"><i class="ace-icon fa fa-arrow-right"></i> Exécuter </button>
                    <button class="btn btn-default" style="padding: 3.5px 12px;" onclick="fermerDuplication()"><i class="ace-icon fa fa-reply"></i> Annuler </button>
                </td>
            </tr>
        </table>
    </div>
</div>

<script  type="text/javascript">

    function fermerDuplication() {
        $('#zone_duplication').delay(500).fadeOut();
    }

    function getSerie() {
        if ($('#journal_new').val() != '' && $('#date_new').val() != '') {
            var date_saisie = $('#date_new').val();

            var d1 = new Date(<?php echo date('Y') ?>, <?php echo date('m') - 1 ?>, <?php echo date('d') ?>);
            var date_s = date_saisie.split("-");
            var d2 = new Date(date_s[2], date_s[1], date_s[0]);
            if (d1 >= d2) {
                goGetSerie();
            } else if (d1 < d2) {
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
                            goGetSerie();
                        } else {
                            $('#date_new').focus();
                        }
                    }
                });
            }
        }
    }

    function goGetSerie() {
        $.ajax({
            dataType: 'json',
            url: '<?php echo url_for('saisie_pieces/getSerieJournal') ?>',
            data: 'journal=' + $('#journal_new').val() + '&date=' + $('#date_new').val(),
            success: function (data) {
                if (data.bloque == '0') {
                    $('#new_serie').val(data.serie);
                    $('#new_serie_id').val(data.serie_id);
                    $('#new_numero').val(data.numero);
                    $('#table_numero').show();
                }
                else {
                    $('#date').val('');
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
                    $('#date_new').focus();
                }
            }
        });
    }

</script>

<script  type="text/javascript">

    $('input:text').attr('style', 'width: 100%;');
    $('#journal_new').attr('class', "chosen-select form-control");
    $('#journal_new').attr('style', 'width: 100%;');

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