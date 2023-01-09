<!--<div id="right-menu" class="modal aside" data-body-scroll="false" data-offset="true" data-placement="right" data-fixed="true" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="white">&times;</span>
                    </button>
                    INFORMATIONS
                </div>
            </div>
            <div class="modal-body">
                <h6 class="lighter" style="margin-left: 5px; text-align: justify; line-height: 22px;">Les champs suivants ne sont pas modifiables dans cette fiche :</h6>
                <ul style="margin: 0 0 10px 40px;">
                    <li class="info_modal"> Journal.</li>
                    <li class="info_modal"> Date.</li>
                    <li class="info_modal"> Série.</li>
                    <li class="info_modal"> Numéro.</li>
                    <li class="info_modal"> Numéro Externe.</li>
                    <li class="info_modal"> Référence.</li>
                </ul>
                <div style="width: 100%; text-align: justify; line-height: 22px;">
                    Vous pouvez les changer dans l'espace Utilitaires <i class="ace-icon fa fa-magic bigger-110"></i>
                </div>
                <hr>
            </div>
        </div> /.modal-content 

        <button class="aside-trigger btn btn-info btn-app btn-xs ace-settings-btn" data-target="#right-menu" data-toggle="modal" type="button">
            <i data-icon1="fa-plus" data-icon2="fa-minus" class="ace-icon fa fa-plus bigger-110 icon-only"></i>
        </button>
    </div> /.modal-dialog 
</div>-->

<div id="sf_admin_container">
    <h1>
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Modifier pièce comptable
        </small>
    </h1>
</div>

<div id="form_saisie_pieces" ng-controller="myCtrlCompteComptable">
    <?php include_partial('saisie_pieces/form_edit', array('piece' => $piece)) ?>
</div>

<script type="text/javascript">
   

    function validerPiece() {
        var nb_lignes = 0;
        var numero_compte = '';
        var ligne_contre = '';
        var ligne_debit = '';
        var ligne_credit = '';
        var ligne_nature_id = '';
        var ligne_numero_externe = '';
        var ligne_reference = '';
        var ligne_facture_id = '';
        var ligne_libelle = '';
        var lettre_compte = '';
        var compte_remplie = true;
        var montant_remplie = true;

        $('#liste_ligne tbody tr').each(function() {
            nb_lignes++;
            var i_ligne = $(this).attr('index_ligne');
            i_ligne++;
            numero_compte = numero_compte + $('#hidden_ligne_compte_' + i_ligne).val() + ',,';

            lettre_compte = lettre_compte + $('#hidden_ligne_compte_lettre_' + i_ligne).val() + ',,';

            ligne_contre = ligne_contre + $('#hidden_ligne_contre_' + i_ligne).val() + ',,';
            ligne_debit = ligne_debit + $('#ligne_debit_' + i_ligne).val() + ',,';
            ligne_credit = ligne_credit + $('#ligne_credit_' + i_ligne).val() + ',,';
            ligne_nature_id = ligne_nature_id + $('#ligne_nature_id_' + i_ligne).val() + ',,';
            ligne_numero_externe = ligne_numero_externe + $('#ligne_numero_externe_' + i_ligne).val() + ',,';
            ligne_reference = ligne_reference + $('#ligne_reference_' + i_ligne).val() + ',,';
            ligne_facture_id = ligne_facture_id + $('#ligne_facture_id_' + i_ligne).val() + ',,';
            ligne_libelle = ligne_libelle + $('#ligne_libelle_' + i_ligne).val() + ',**,';

            if ($('#hidden_ligne_compte_' + i_ligne).val() == '' && ($('#ligne_debit_' + i_ligne).val() != '' || $('#ligne_credit_' + i_ligne).val() != ''))
                compte_remplie = false;

            if ($('#ligne_debit_' + i_ligne).val() == '' && $('#ligne_credit_' + i_ligne).val() == '' && $('#hidden_ligne_compte_' + i_ligne).val() != '')
                montant_remplie = false;
        });

        if (nb_lignes != 0) {
            if (compte_remplie == true) {
                if (montant_remplie == true) {
                    //                    var total_solde = $('#total_solde').val();
                    //                    if (parseFloat(total_solde) == 0) {
                    $.ajax({
                        url: '<?php echo url_for('@validerPiece') ?>',
                        data: 'journal=' + $('#journal_id').val() +
                            '&date=' + $('#date').val() +
                            '&numero=' + $('#numero').val() +
                            '&date=' + $('#date').val() +
                            '&serie=' + $('#serie_id').val() +
                            '&nature_piece=' + $('#nature_piece').val() +
                            '&libelle_piece=' + $('#libelle_piece').val() +
                            '&piece_id=' + $('#detail_piece_id').val() +
                            '&total_debit=' + $('#total_debit').val() +
                            '&total_credit=' + $('#total_credit').val() +
                            '&numero_compte=' + numero_compte +
                            '&ligne_contre=' + ligne_contre +
                            '&lettre_compte=' + lettre_compte +
                            '&ligne_debit=' + ligne_debit +
                            '&ligne_credit=' + ligne_credit +
                            '&ligne_nature_id=' + ligne_nature_id +
                            '&numero_externe=' + $('#numero_externe').val() +
                            '&ligne_numero_externe=' + ligne_numero_externe +
                            '&ligne_reference=' + ligne_reference +
                            '&ligne_facture_id=' + ligne_facture_id +
                            '&ligne_libelle=' + ligne_libelle,
                        success: function(data) {
                            bootbox.dialog({
                                message: "Pièce comptable enregistrée avec succès !",
                                buttons: {
                                    "button": {
                                        "label": "Ok",
                                        "className": "btn-sm"
                                    }
                                }
                            });
                            //                            goPage(1);
                        }
                    });
                    //                    } else {
                    //                        bootbox.dialog({
                    //                            message: "Pièce non soldée !",
                    //                            buttons:
                    //                                    {
                    //                                        "button":
                    //                                                {
                    //                                                    "label": "Ok",
                    //                                                    "className": "btn-sm"
                    //                                                }
                    //                                    }
                    //                        });
                    //                    }
                } else {
                    bootbox.dialog({
                        message: "Vérifiez les montants des débits et/ou des crédits !",
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                }
            } else {
                bootbox.dialog({
                    message: "Vérifiez le numéro du compte comptable !",
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
            }
        } else {
            bootbox.dialog({
                message: "Entrez au moin une ligne !!</span>",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }

    function fermerEditPiece() {
        $('#form_show_edit_piece').fadeOut();
        $('#form_show_edit_piece').html('');
        $('#right-menu').remove();
        $('#form_liste_piece').delay(500).fadeIn();
    }

    $('input:text').attr('style', 'width: 100%;');
    $('.modal.aside').ace_aside();
</script>

<script type="text/javascript">
    var table = '';

    function chargerCompte(id1, id2, id3) {
        if ($(id1).val() != '') {
            $.ajax({
                url: '<?php echo url_for('saisie_pieces/compteparnumeroMaxChiffre') ?>',
                data: 'numero=' + $(id1).val(),
                success: function(data) {
                    var data = JSON.parse(data);

                    $(".testul ul").css('width', $(id2).width());
                    htmlins = '';
                    table = data;
                    $(".testul").remove();
                    if (data.length > 0) {
                        htmlins = '<div class="testul">' +
                            '<ul id="ul_compte" onkeydown="selectLiComptable(event)" style="z-index: 9;">';
                        for (i = 0; i < data.length; i++) {
                            if (i == 0)
                                htmlins += '<li class="selected_li" data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" id3="' + id3 + '" onclick="clickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\',\'' + id3 + '\')">' + data[i].name + '</li>';
                            else
                                htmlins += '<li data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" id3="' + id3 + '" onclick="clickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\',\'' + id3 + '\')">' + data[i].name + '</li>';
                        }
                        htmlins += '</ul></div>';
                    }
                    $(id1).after(htmlins);
                }
            });
        } else {
            $(id2).val('');
            $(id3).html('');
            $(id3).text();
        }
    }

    function clickSelectElement(value2, id1, id2, id3) {
        var valeu1 = "";
        for (i = 0; i < table.length; i++) {
            if (value2 - table[i].id === 0) {
                valeu1 = table[i].name;
                break;
            }
        }
        if (id1)
            $(id1).val(valeu1);
        if (id2)
            $(id2).val(value2);
        $(".testul").remove();
        $(id3).html(valeu1);
        $(id3).text();
    }
    var highlighted;

    function selectLiComptable(event) {
        highlighted = $(".testul ul li[class=selected_li]");
        switch (event.keyCode) {
            case 38:
                if (highlighted && highlighted.prev().length > 0) {
                    $(".selected_li").removeClass("selected_li");
                    highlighted.prev().addClass("selected_li");
                }
                break;
            case 40:
                if (highlighted && highlighted.next().length > 0) {
                    $(".selected_li").removeClass("selected_li");
                    highlighted.next().addClass("selected_li");
                }
                break;
            case 13:
                if (highlighted) {
                    var data_li = highlighted.attr('data-li');
                    var id1 = highlighted.attr('id1');
                    var id2 = highlighted.attr('id2');
                    var id3 = highlighted.attr('id3');
                    clickSelectElement(data_li, id1, id2, id3);
                    if (id1.indexOf('compte') > 0) {
                        $("#ligne_debit_1").focus();
                    } else {
                        ajouterLastLigne();
                    }
                }
                break;
            case 27:
                $(".testul").remove();
                break;
        }
    }

    function removeUl() {
        $(".testul").remove();
    }
</script>

<script type="text/javascript">
    $(document).keydown(function(e) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }

        switch (key) {
            // F1
            case 112:
                solderPiece();
                break;
                // F2
            case 113:
                ajouterLastLigne();
                break;
            case 114:
                validerPiece('1');
                break;
            case 115:
                validerPiece('0');
                break;
        }
    });

    function moveToNext(e, motif, index) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }

        switch (key) {
            // Enter
            case 13:
                switch (motif) {
                    case 'ligne_compte':
                        $('#ligne_debit_' + index).focus();
                        break;
                    case 'ligne_debit':
                        if ($("#ligne_debit_" + index).val() != '')
                            $('#ligne_contre_' + index).focus();
                        else
                            $('#ligne_credit_' + index).focus();
                        break;
                    case 'ligne_credit':
                        $('#ligne_contre_' + index).focus();
                        break;
                    case 'ligne_contre':
                        $('#ligne_libelle_' + index).focus();
                        break;
                    case 'ligne_libelle':
                        var count_ligne = 0;
                        $('#liste_ligne tbody tr').each(function() {
                            count_ligne++;
                        });
                        if (index < count_ligne) {
                            index++;
                            $('#ligne_compte_' + index).focus();
                        } else {
                            ajouterLastLigne();
                        }
                        break;
                }
                break;
                // Left
            case 37:
                switch (motif) {
                    case 'ligne_compte':
                        //Rien à faire
                        break;
                    case 'ligne_debit':
                        $('#ligne_compte_' + index).focus();
                        break;
                    case 'ligne_credit':
                        $('#ligne_debit_' + index).focus();
                        break;
                    case 'ligne_contre':
                        $('#ligne_credit_' + index).focus();
                        break;
                    case 'ligne_libelle':
                        $('#ligne_contre_' + index).focus();
                        break;
                }
                break;
                // Up
            case 38:
                if (index > 1) {
                    index--;
                    switch (motif) {
                        case 'ligne_compte':
                            $('#ligne_compte_' + index).focus();
                            break;
                        case 'ligne_debit':
                            $('#ligne_debit_' + index).focus();
                            break;
                        case 'ligne_credit':
                            $('#ligne_credit_' + index).focus();
                            break;
                        case 'ligne_contre':
                            $('#ligne_contre_' + index).focus();
                            break;
                        case 'ligne_libelle':
                            $('#ligne_libelle_' + index).focus();
                            break;
                    }
                    index--;
                    formatLigne(index);
                }
                break;
                // Right
            case 39:
                switch (motif) {
                    case 'ligne_compte':
                        $('#ligne_debit_' + index).focus();
                        break;
                    case 'ligne_debit':
                        $('#ligne_credit_' + index).focus();
                        break;
                    case 'ligne_credit':
                        $('#ligne_contre_' + index).focus();
                        break;
                    case 'ligne_contre':
                        $('#ligne_libelle_' + index).focus();
                        break;
                    case 'ligne_libelle':
                        // Rien à faire
                        break;
                }
                break;
                // Down
            case 40:
                var count_ligne = 0;
                $('#liste_ligne tbody tr').each(function() {
                    count_ligne++;
                });
                if (index <= count_ligne) {
                    switch (motif) {
                        case 'ligne_compte':
                            if ($('#ul_compte').attr('onkeydown')) {
                                $('#ul_compte').focus();
                            } else {
                                index++;
                                $('#ligne_compte_' + index).focus();
                                index--;
                                if (index == count_ligne)
                                    index--;
                                formatLigne(index);
                            }
                            break;
                        case 'ligne_debit':
                            index++;
                            $('#ligne_debit_' + index).focus();
                            index--;
                            if (index == count_ligne)
                                index--;
                            formatLigne(index);
                            break;
                        case 'ligne_credit':
                            index++;
                            $('#ligne_credit_' + index).focus();
                            index--;
                            if (index == count_ligne)
                                index--;
                            formatLigne(index);
                            break;
                        case 'ligne_contre':
                            if ($('#ul_compte').attr('onkeydown'))
                                $('#ul_compte').focus();
                            else {
                                index++;
                                $('#ligne_contre_' + index).focus();
                                index--;
                                if (index == count_ligne)
                                    index--;
                                formatLigne(index);
                            }
                            break;
                        case 'ligne_libelle':
                            index++;
                            $('#ligne_libelle_' + index).focus();
                            index--;
                            if (index == count_ligne)
                                index--;
                            formatLigne(index);
                            break;
                    }

                    break;
                }
                break;
                // Insert
            case 45:
                switch (motif) {
                    case 'ligne_debit':
                        if (!$('#ligne_debit_' + index).attr('readonly'))
                            showCalculatrice('ligne_debit_' + index);
                        break;
                    case 'ligne_credit':
                        if (!$('#ligne_credit_' + index).attr('readonly'))
                            showCalculatrice('ligne_credit_' + index);
                        break;
                }
                break;
        }
    }
</script>

<script type="text/javascript">
    document.title = ('BMM - G. Compta. : Modifier pièce comptable');
</script>

<style>
    .selected_li {
        background-color: #3875d7;
        background-image: -webkit-gradient(linear, 50% 0, 50% 100%, color-stop(20%, #3875d7), color-stop(90%, #2a62bc));
        background-image: -webkit-linear-gradient(#3875d7 20%, #2a62bc 90%);
        background-image: -moz-linear-gradient(#3875d7 20%, #2a62bc 90%);
        background-image: -o-linear-gradient(#3875d7 20%, #2a62bc 90%);
        background-image: linear-gradient(#3875d7 20%, #2a62bc 90%);
        color: #fff
    }

    .info_modal {
        text-align: justify;
        margin-top: 10px;
        font-weight: normal;
    }

    .lighter {
        font-weight: bold;
    }

    .grand_point {
        font-size: 22px;
    }

    h6 {
        font-size: 14px;
    }
</style>