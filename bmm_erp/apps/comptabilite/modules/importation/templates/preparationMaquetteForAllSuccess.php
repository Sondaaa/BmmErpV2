<?php
if ($type == "achat") {
    $texte = "Achats";
    $tier = "Fournisseur";
} elseif ($type == "vente") {
    $texte = "Ventes";
    $tier = "Client";
} elseif ($type == "od") {
    $texte = "Retenue à la source";
    $tier = "Fournisseur";
} elseif ($type == "banque") {
    $texte = "Trésorerie";
} elseif ($type == "od_client") {
    $texte = "Retenue à la source Client";
    $tier = "Client";
} elseif ($type == "od_mouvement") {
    $texte = "Mouvement Piece Comptable ";
    $tier = "Tiers";
}
$url = "type=vente&saisie=0";
if ($reference != "")
    $url = $url . "&reference=" . $reference;
if ($client != "")
    $url = $url . "&client=" . $client;
?>

<div id="sf_admin_container">
    <h1 id="replacediv"> Saisie 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Liste des Factures Comptables <?php echo $texte; ?> : <?php echo $_SESSION['exercice']; ?>
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="table-header" style="margin-bottom: 0px;">
            Maquette de Saisie <?php echo $texte; ?> :
        </div>
        <div class="col-xs-12" style="border: 1px solid #307ECC; padding-top: 10px; padding-bottom: 15px;">
            Maquette de Saisie : Code - Libellé (Journal comptable : libellé)
            <select id="maquette_id" onchange="setJournal()">
                <option value="0"></option>
                <?php foreach ($maquettes as $maquette): ?>
                    <option id="option_<?php echo $maquette->getId(); ?>" journal_id="<?php echo $maquette->getIdJournal(); ?>" journal="<?php echo trim($maquette->getJournalcomptable()->getCode()) . ' - ' . trim($maquette->getJournalcomptable()->getLibelle()); ?>" value="<?php echo $maquette->getId(); ?>"><?php echo trim($maquette->getCode()) . ' - ' . trim($maquette->getLibelle()); ?> (Journal : <?php echo trim($maquette->getJournalcomptable()->getLibelle()); ?>)</option>
                <?php endforeach; ?>
            </select>
            <table style="margin-top: 15px; margin-bottom: 0px;">
                <tr>
                    <td style="width: 80%">
                        Journal Comptable
                        <input id="journal_piece" type="text" value="" readonly="true" />
                        <input id="id_journal_piece" type="hidden" value="" />
                    </td>
                    <td style="width: 20%">
                        Type Pièce
                        <input readonly="true" type="text" value="Pièce comptable" />
                    </td>
<!--                <select id="type_id" onchange="setListe()">
                    <option value=""></option>
                    <option value="1">Débit</option>
                    <option value="0">Crédit</option>

                </select>-->
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="row" id="zone_maquette" style="margin-top: 15px; display: none;">
    <div class="col-xs-12">
        <div class="table-header" style="margin-bottom: 0px;">
            Détails Maquette de Saisie :
        </div>
        <div class="col-xs-12" id="tbody_maquette_saisie" style="border: 1px solid #307ECC; padding-top: 10px; padding-bottom: 15px;">

        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-xs-12">
        <div class="table-header" style="margin-bottom: 0px;">
            Liste des Factures Comptables <?php echo $texte; ?> :
        </div>
        <div style="height: 360px; overflow: auto;" id="liste_compte">
            <?php if ($type == "achat"): ?>
                <?php include_partial("importation/liste_factures_achat", array("factures" => $factures, "reference" => $reference, "client" => $client)) ?>
            <?php elseif ($type == "vente"): ?> 
                <?php include_partial("importation/liste_factures_vente", array("factures" => $factures, "reference" => $reference, "client" => $client)) ?>

            <?php elseif ($type == "od"): ?> 
                <?php include_partial("importation/liste_factures_od", array("factures" => $factures, "reference" => $reference, "client" => $client)) ?>
            <?php elseif ($type == "od_client"): ?> 
                <?php include_partial("importation/liste_factures_od_client", array("factures" => $factures, "reference" => $reference, "client" => $client)) ?>

            <?php elseif ($type == "banque"): ?> 
                <?php include_partial("importation/liste_reglement", array("factures" => $factures, "reference" => $reference)) ?>
            <?php elseif ($type == "od_mouvement"): ?> 
                <?php include_partial("importation/liste_mouvement_piece", array("factures" => $factures, "reference" => $reference)) ?>

            <?php endif; ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-6">
        <div class="clearfix" style="font-size: 16px; margin-top: 20px;">
            <span id="nombre_facture" style="margin-left: 20px;">0 </span> Facture(s) sélectionné(s)
        </div>
    </div>
    <span id="loading_save_icon" class="orange" style="display: none;"><i class="ace-icon fa fa-spinner fa-spin orange bigger-190"></i> Traitement en cours ..............</span>
    <div class="col-xs-6">
        <button id="button_saisir" class="btn btn-primary" type="button" style="float: right; margin-top: 20px;" onclick="SaisirPiece()">
            <i class="ace-icon fa fa-file-text bigger-110"></i>
            Saisir Pièce(s) Comptable(s)
        </button>
    </div>
</div>

<script  type="text/javascript">
    function goPage(page) {
//        $('[class="detail-row open"]').each(function () {
//            $(this).remove();
//        });
//        var type = $('#type_tri').val();
//        type = 'ligne_' + type;
        $.ajax({
            url: '<?php echo url_for('importation/goPage'); ?>',
            data: 'page=' + page + '&reference=' + $('#ref').val()
                    + '&client=' + $('#client').val()
            ,
            success: function (data) {
                $('#listFacture').html(data);
            }
        });
    }




    function setJournal() {
        if ($("#maquette_id").val() != '0') {
            var id = $("#maquette_id").val();
            var journal = $("#option_" + id).attr("journal");
            var journal_id = $("#option_" + id).attr("journal_id");
            $("#journal_piece").val(journal);
            $("#id_journal_piece").val(journal_id);
            chargerMaquetteSaisie();
        } else {
            $("#journal_piece").val('');
            $("#id_journal_piece").val('');
            $("#tbody_maquette_saisie").html('');
            $("#zone_maquette").fadeOut();
        }
    }
    function  setListe() {

        if ($("#type_id").val() != '') {
            var type = $('#type_id').val();
            $.ajax({
                url: '<?php echo url_for('importation/goTypeReglement'); ?>',
                data: 'type=' + type,
                success: function (data) {
                    $('#listFacture tbody').html(data);
                }
            });
        }

    }

    function chargerMaquetteSaisie() {
        $.ajax({
            url: '<?php echo url_for('importation/showMaquetteSaisie') ?>',
            data: 'id=' + $("#maquette_id").val() +
                    '&type_facture=' + 'achat',
            success: function (data) {
                $("#tbody_maquette_saisie").html(data);

                $("table").addClass("table table-bordered table-hover");
                $('input:text').attr('style', 'width: 100%;');

                $("#zone_maquette").fadeIn();
            }
        });
    }

    function FermerDetailsMaquette() {
        $("#zone_maquette").fadeOut();
    }
    function goPage(page) {
        var numero = $('#numero').val();
        var libelle = $('#libelle').val();
        var type = $('#type').val();

        $.ajax({
            url: '<?php echo url_for('importation/goPageReglement'); ?>',
            data: 'page=' + page + '&type=' + type + '&libelle=' + libelle + '&numero=' + numero,
            success: function (data) {
                $('#listFacture tbody').html(data);
            }
        });
    }
</script>

<script  type="text/javascript">

    function deleteRow(id) {
        $('#row_' + id).remove();
        $('#nombre_facture').html($('.list_checbox_facture[type=checkbox]:checked').length);
    }

    $('.list_checbox_facture').change(function () {
        if ($(this).is(":checked")) {
            var id = $(this).val();
            $('#row_' + id).css('background', '#E7E7E7');
            $('#row_' + id).css('border-bottom', '1px solid #000000');
            $('#row_' + id).css('border-top', '1px solid #000000');
        } else {
            var id = $(this).val();
            $('#row_' + id).css('background', '');
            $('#row_' + id).css('border-bottom', '');
            $('#row_' + id).css('border-top', '');
        }
        $('#nombre_facture').html($('.list_checbox_facture[type=checkbox]:checked').length);
    });

    $('#selecte_all').change(function () {
        if ($('#selecte_all').is(':checked')) {
            $('.list_checbox_facture[type=checkbox]').prop('checked', true);

            $('.row_facture').css('background', '#E7E7E7');
            $('.row_facture').css('border-bottom', '1px solid #000000');
            $('.row_facture').css('border-top', '1px solid #000000');
        } else {
            $('.list_checbox_facture[type=checkbox]').prop('checked', false);

            $('.row_facture').css('background', '');
            $('.row_facture').css('border-bottom', '');
            $('.row_facture').css('border-top', '');
        }
        $('#nombre_facture').html($('.list_checbox_facture[type=checkbox]:checked').length);
    });
    function SendData(list_facture, max_lenght, i) {

        if (i < max_lenght) {
            var data = {
                id: $("#maquette_id").val(),
                factures: list_facture[i],
                type_facture: '<?php echo $type; ?>'
            };
            $.ajax({
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                url: '<?php echo url_for('importation/saisirAllPieceByMaquette') ?>',
                data: JSON.stringify(data),
                success: function (data) {
//                        $('#button_saisir').addClass('disabledbutton');

                    if (data.msg === 'OK')
                    {
                        $('#row_' + list_facture[i]).remove();
                        $('#row_' + list_facture[i]).attr('style', 'background-color: rgb(204, 245, 255)');
                        if (i == max_lenght - 1) {
                            $('#loading_save_icon').fadeOut();
                            var count_pièces = $('.list_checbox_facture[type=checkbox]:checked').length;
                            var id_ligne = '';
                            $('.list_checbox_facture[type=checkbox]:checked').each(function () {
                                id_ligne = $(this).val();
                                $('#row_' + id_ligne).remove();
                            });
                            $('#nombre_facture').html($('.list_checbox_facture[type=checkbox]:checked').length);

                            bootbox.dialog({
                                message: "<span class='bigger-160' style='margin:20px;'> " + " Pièce(s) comptable(s) créée(s) avec succès !</span>",
                                buttons:
                                        {
                                            "button":
                                                    {
                                                        "label": "Ok",
                                                        "className": "btn-sm"
                                                    }
                                        }
                            });
                        }
                        i++;
                        SendData(list_facture, max_lenght, i);
//                    document.location.reload();
                    } else {
                        $('#row_' + list_facture[i]).attr('style', 'background-color: #D3D3D3');
                        i++;
                        SendData(list_facture, max_lenght, i);
                    }
                }
//                ,
//                error: function (xhr, status, error) {
//                    console.log('error' + error);
//                    $('#row_' + list_facture[i]).attr('style', 'background-color: #D3D3D3');
//                    i++;
//                    SendData(list_facture, max_lenght, i);
//                }
            });
        }

    }
    function SaisirPiece() {
        $('#loading_save_icon').fadeIn();
        var factures = '';
        $('.list_checbox_facture[type=checkbox]:checked').each(function () {
            factures += $(this).val() + ',';
        });

        if (($("#maquette_id").val() != '0')) {
            if ((factures != '')) {
                var list_facture = factures.split(',');
                var i = 0;
                SendData(list_facture, list_facture.length, i)


            } else {
                $('#loading_save_icon').fadeOut();
                bootbox.dialog({
                    message: "<span class='bigger-160' style='margin:20px;color:#b31531;'>Il faut choisir au moins une facture !</span>",
                    buttons:
                            {
                                "button":
                                        {
                                            "label": "Ok",
                                            "className": "btn-sm"
                                        }
                            }
                });
            }
        } else {
            $('#loading_save_icon').fadeOut();
            bootbox.dialog({
                message: "<span class='bigger-160' style='margin:20px;color:#b31531;'>Il faut choisir une maquette de saisie !</span>",
                buttons:
                        {
                            "button":
                                    {
                                        "label": "Ok",
                                        "className": "btn-sm"
                                    }
                        }
            });
        }

    }

</script>

<style type="text/css">
    .header_table th{
        font-weight: bold;
        font-size: 13px;
    }
</style>