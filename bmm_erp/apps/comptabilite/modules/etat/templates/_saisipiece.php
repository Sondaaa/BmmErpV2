<div id="sf_admin_container" ng-init="InialiserPopup()">
    <div class="modal-dialog" style="width:72%">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12  widget-container-col" id="widget-container-col-1">
                            <div class="widget-box" id="widget-box-1">
                                <div class="widget-header">
                                    <h5 class="widget-title">Saisi de pièce</h5>
                                    <div class="widget-toolbar">
                                        <a href="#" data-action="collapse">
                                            <i class="ace-icon fa fa-chevron-up"></i>
                                        </a>

                                    </div>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="hidden" id="journal_id">
                                                <table style="width: 100%; margin-bottom: 0px;"class="table table-bordered table-hover">
                                                    <tr><input type="hidden" id="id_compte" ><input type="hidden" id="solde_lignes">

                                                    <td style="width: 15%">
                                                        <div class="mws-form-inline">
                                                            <div class="mws-form-row">
                                                                <label class="mws-form-label" style="width: 100%">Journal * :</label>
                                                            </div>
                                                        </div>
                                                    </td>


                                                    <td style="width: 10%">
                                                        <div class="mws-form-inline">
                                                            <div class="mws-form-row">
                                                                <label class="mws-form-label" style="width: 100%">Date * :</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="width: 10%">
                                                        <div class="mws-form-inline">
                                                            <div class="mws-form-row">
                                                                <label class="mws-form-label" style="width: 100%">Série * :</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="width: 10%">
                                                        <div class="mws-form-inline">
                                                            <div class="mws-form-row">
                                                                <label class="mws-form-label" style="width: 100%">Numéro * :</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    </tr>

                                                    <tr>
                                                        <td style="width: 15%">
                                                            <select id="journal_popup" onchange="addFirstLigne()" class="chosen-select form-control">
                                                                <option value=""></option>
                                                                <?php $journals = JournalcomptableTable::getInstance()->findByIdDossierAndIdExercice($_SESSION['dossier_id'], $_SESSION['exercice_id']); ?>
                                                                <?php foreach ($journals as $j): ?>
                                                                    <option value="<?php echo $j->getId(); ?>"><?php echo $j->getLibelle(); ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </td>
                                                        <td style="width: 10%">
                                                            <input id="date" type="date" onchange="getSerie()">
                                                        </td>
                                                        <td>
                                                            <input type="text" id="serie" readonly="readonly">
                                                            <input id="serie_id" type="hidden" readonly="readonly" >
                                                        </td>
                                                        <td>
                                                            <input type="text"  id="numero" readonly="readonly" onchange="chargerPiece()" onkeypress="upDownNumero(event)" onblur="validerNumero()">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td >
                                                            <div class="mws-form-row">
                                                                <label class="mws-form-label">Libellé * :</label>


                                                            </div>
                                                        </td>
                                                        <td colspan="3">
                                                            <input style="width:  90%" id="libelle_piece" class="large" type="text" placeholder="Ecriture lettrage" value="Ecriture lettrage">

                                                        </td>
                                                    </tr>


                                                </table>
                                            </div>
                                            <div style="overflow-y : scroll;overflow-x : hidden; width: 100%;" >
                                                <div class="widget-box" style="min-height: 180px;max-height: 350px;">
                                                    <div class="widget-header widget-header-flat">
                                                        <h4 class="widget-title smaller">Détails Pièce comptable :</h4>
                                                    </div>

                                                    <div class="widget-body">
                                                        <div class="widget-main" style="padding-bottom: 0px;">

                                                            <div class="mws-panel-toolbar ">
                                                                <div class="btn-toolbar" style="margin-left: 0px;">
                                                                    <div class="btn-group" style="width: 100%">
                                                                        <a onclick="validerPiece('0')" class="btn  btn-success" style="float: left;padding: 5.5px 12px; padding-top: 3px;"><i class="ace-icon fa fa-save align-top bigger-110"></i> Enregistrer</a>
                                                                        <a title="Supprimer." data-rel="tooltip" onclick="supprimerLigne()" class="btn btn-danger" style="float: right; padding: 5.5px 12px; padding-top: 3px;"><i class="ace-icon fa fa-trash align-top bigger-110" style="margin-top: 4px; margin-right: 0px;"></i></a>
                                                                        <!--<a title="Ajouter avant la ligne sélectionnée." data-rel="tooltip" onclick="ajouterLigneVide()" class="btn btn-primary" style="float: right; padding: 5.5px 12px; padding-top: 3px;"><i class="ace-icon fa fa-arrow-right align-top bigger-110" style="margin-top: 4px; margin-right: 0px;"></i></a>-->
                                                                        <a title="Ajouter à la fin. (F2)" data-rel="tooltip" onclick="ajouterLigneVide()" class="btn btn-info" style="float: right; padding: 5.5px 12px; padding-top: 3px;"><i class="ace-icon fa fa-arrow-down align-top bigger-110" style="margin-top: 4px; margin-right: 0px;"></i></a>
                                                                        <a title="Solder la pièce. (F1)" data-rel="tooltip" onclick="ajouterLastLigneVide()" class="btn btn-success" style="float: right; padding: 5.5px 12px; padding-top: 3px;"><i class="ace-icon fa fa-balance-scale align-top bigger-110" style="margin-top: 4px; margin-right: 0px;"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <table id="liste_ligne" style="width: 98%; margin-bottom: 10px; margin-left: 1%;" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 3%; text-align: center;">N°</th>
                                                                <th style="width: 27%;">N° Compte</th>
                                                                <th style="width: 15%; text-align: center;">Débit</th>
                                                                <th style="width: 15%; text-align: center;">Crédit</th>

                                                                <th style="width: 20%;">Libellé</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-xs-8" style="float: right;">
                                                <div class="widget-box">
                                                    <div class="widget-body">
                                                        <div class="widget-main">
                                                            <form>
                                                                <table >
                                                                    <tr>
                                                                        <td >
                                                                            <div class="mws-form-row">
                                                                                <label class="mws-form-label"><b>Total Débit :</b></label>
                                                                                <input class="text_align_right" id="total_debit" type="text" disabled="disabled" value="0.000">
                                                                            </div>
                                                                        </td>
                                                                        <td >
                                                                            <div class="mws-form-row">
                                                                                <label class="mws-form-label"><b>Total Crédit :</b></label>
                                                                                <input class="text_align_right" id="total_credit" type="text" disabled="disabled" value="0.000">
                                                                            </div>
                                                                        </td>
                                                                        <td >
                                                                            <div class="mws-form-row">
                                                                                <label class="mws-form-label"><b>Total Solde :</b></label>
                                                                                <input class="text_align_right" id="total_solde" type="text" disabled="disabled" value="0.000">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer col-xs-12 " >

                                                <button type="button" value="Fermer" class="btn btn-sm  pull-right"  onclick="fermerPopup()" >

                                                    Fermer
                                                </button>


                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>


<script  type="text/javascript">
    function fermerPopup()
    {
        $('#my-modal_saisipiece').removeClass('in');
        $('#my-modal_saisipiece').css('display', 'none');
        $('#journal_popup').val('');
        $('journal_popup').attr('class', "chosen-select form-control");
        $('journal_popup').attr('style', 'width: 100%;');

        $('#date').val('');
        $('#serie').val('');
        $('#numero').val('');
        $('#libelle').val('');
        $('#liste_ligne tbody').html('');

        $('#total_debit').val('');
        $('#total_credit').val('');
        $('#total_solde>').val('');


    }
    function showMaquette(id) {
        $.ajax({
            url: '<?php echo url_for('saisie_pieces/showMaquette'); ?>',
            data: 'maquette_id=' + id,
            success: function (data) {
                $('#show_maquette').html(data);
                $('#form_liste_maquette').fadeOut();
                $('#show_maquette').fadeIn();
                $('#show_edit_maquette').fadeOut();
            }
        });
    }

    function supprimerPiece() {
        if ($('#detail_piece_id').val() != '') {
            bootbox.confirm({
                message: "voulez-vous vraiment supprimer cette pièce comptable ?",
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
                        goSupprimerPiece();
                    }
                }
            });
        } else {
            $('#liste_ligne tbody').html('');
            ligneNumber();
        }
    }

    function goSupprimerPiece() {
        if ($('#detail_piece_id').val() != '') {
            $.ajax({
                url: '<?php echo url_for('@supprimerPiece') ?>',
                data: 'id=' + $('#detail_piece_id').val(),
                success: function (data) {
                    $('#form_saisie_pieces').html(data);
                    //mise en forme le désign du formulaire saisie de pièce
                    miseEnFormeDesignFormulaire();
                }
            });
        }
    }

    function nouveauSaisiePieces() {
        $.ajax({
            url: '<?php echo url_for('@nouveauSaisiePieces') ?>',
            data: '',
            success: function (data) {
                $('#form_saisie_pieces').html(data);
                //mise en forme le désign du formulaire saisie de pièce
                miseEnFormeDesignFormulaire();
            }
        });
    }

    function miseEnFormeDesignFormulaire() {
        //mise en forme le désign du formulaire saisie de pièce
        $("form").attr('role', 'form');
        $("table").addClass("table table-bordered table-hover");
        $('input:text').addClass("class", "input-sm");
        $('input:text').attr('style', 'width: 100%;');
//         $('input:text[id="journal_option"]').addClass("class", "form-control");
        $('select').attr('class', "chosen-select form-control");
        $('select').attr('style', 'width: 100%;');
        $('#btn_solder').removeClass('disabledbutton');
        $('#date').removeClass('disabledbutton');
        $('#nature_piece_option').addClass('disabledbutton');
        $('#journal_option').attr('readonly', 'readonly');
        $('#journal_option').removeClass('disabledbutton');
        $('#journal_id').attr('readonly', 'readonly');
        $('#journal_id').removeClass('disabledbutton');
//           $('#journal_option').addClass('disabledbutton');
//        var btn = document.querySelector('input');
////var txt = document.querySelector('p');
//
//        btn.addEventListener('change', Choisirnaturepiece);

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
    }

    function validerPiece(re_journal) {
        if (verifierFormPiece()) {
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

            var compte_remplie = true;
            var montant_remplie = true;


            $('#liste_ligne tbody tr').each(function () {
                nb_lignes++;
                var i_ligne = $(this).attr('index_ligne');
                i_ligne++;
                numero_compte = numero_compte + $('#hidden_ligne_compte_' + i_ligne).val() + ',,';
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
                        var total_solde = $('#total_solde').val();
                        if (parseFloat(total_solde) == 0) {
                            $.ajax({
                                url: '<?php echo url_for('@validerPieceExtrait') ?>',
                                data: 'journal=' + $('#journal').val() +
                                        '&date=' + $('#date').val() +
                                        '&serie=' + $('#serie_id').val() +
                                        '&numero=' + $('#numero').val() +
                                        '&libelle_piece=' + $('#libelle_piece').val() +
                                        '&piece_id=' + $('#detail_piece_id').val() +
                                        '&total_debit=' + $('#total_debit').val() +
                                        '&total_credit=' + $('#total_credit').val() +
                                        '&numero_compte=' + numero_compte +
                                        '&ligne_contre=' + ligne_contre +
                                        '&ligne_debit=' + ligne_debit +
                                        '&ligne_credit=' + ligne_credit +
                                        '&ligne_nature_id=' + ligne_nature_id +
                                        '&ligne_numero_externe=' + ligne_numero_externe +
                                        '&ligne_reference=' + ligne_reference +
                                        '&ligne_facture_id=' + ligne_facture_id +
                                        '&ligne_libelle=' + ligne_libelle +
                                        '&re_journal=' + re_journal,
                                success: function (data) {
                                    $('#form_saisie_pieces').html(data);
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
                                    //mise en forme le désign du formulaire saisie de pièce
                                    miseEnFormeDesignFormulaire();
                                }
                            });
                        } else {
                            bootbox.dialog({
                                message: "<h3 class='panel-danger'>Pièce non soldée !</h3>",
                                buttons:
                                        {
                                            "button":
                                                    {
                                                        "label": "Ok",
                                                        "className": "btn-sm btn-danger"
                                                    }
                                        }
                            });
                        }
                    } else {
                        bootbox.dialog({
                            message: "Vérifiez les montants des débits et/ou des crédits !",
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
                    bootbox.dialog({
                        message: "Vérifiez le numéro du compte comptable !",
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
                bootbox.dialog({
                    message: "Entrez au moin une ligne !!</span>",
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
            bootbox.dialog({
                message: "Veuillez saisir les champs obligatoires !",
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
        document.location.reload();
    }

    function verifierFormPiece() {
        var valide = true;
        if ($('#journal').val() != '-1')
            $('#journal_chosen > .chosen-single').css('border', '');
        else {
            $('#journal_chosen > .chosen-single').css('border-color', '#f2a696');
            valide = false;
        }

        if ($('#date').val() != '')
            $('#date').css('border', '');
        else {
            $('#date').css('border-color', '#f2a696');
            valide = false;
        }

        if ($('#libelle_piece').val() != '')
            $('#libelle_piece').css('border', '');
        else {
            $('#libelle_piece').css('border-color', '#f2a696');
            valide = false;
        }

        if ($('#serie').val() != '')
            $('#serie').css('border', '');
        else {
            $('#serie').css('border-color', '#f2a696');
            valide = false;
        }

        if ($('#numero').val() != '')
            $('#numero').css('border', '');
        else {
            $('#numero').css('border-color', '#f2a696');
            valide = false;
        }

        return valide;
    }
//
</script>

<script  type="text/javascript">
    window.addEventListener("keydown", function (event) {
        if (event.defaultPrevented) {
            return; // Ne devrait rien faire si l'événement de la touche était déjà consommé.
        }

        switch (event.key) {
            case "ArrowDown":
                console.log('Faire quelque chose pour la touche "flèche vers le bas" pressée.');
                break;
            case "ArrowUp":
                console.log('Faire quelque chose pour la touche "up arrow" pressée.');
                break;
            case "ArrowLeft":
                console.log('Faire quelque chose pour la touche "left arrow" pressée.');
                break;
            case "ArrowRight":
                console.log('Faire quelque chose pour la touche "right arrow" pressée.');
                break;
            case "Enter":
                console.log('Faire quelque chose pour les touches "enter" ou "return" pressées.');
                break;
            case "Escape":
                console.log('Faire quelque chose pour la touche "esc" pressée.');
                break;
            default:
                return; // Quitter lorsque cela ne gère pas l'événement touche.
        }

        // Annuler l'action par défaut pour éviter qu'elle ne soit traitée deux fois.
        event.preventDefault();
    }, true);
    var table = '';
    function chargerCompte(id1, id2, id3) {

        if ($(id1).val() != '') {
            console.log($(id1).val());
            $.ajax({
                url: '<?php echo url_for('saisie_pieces/compteparnumeroMaxChiffre') ?>',
                data: 'numero=' + $(id1).val(),
                success: function (data) {
                    var data = JSON.parse(data);

                    $(".testul ul").css('width', $(id2).width());
                    htmlins = '';
                    table = data;
                    $(".testul").remove();
                    if (data.length > 0) {
                        htmlins = '<div class="testul">' +
                                '<ul id="ul_compte" onkeydown="selectLiComptable(event)" style="z-index: 9;">';
                        for (var i = 0; i < data.length; i++) {
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
                    }
                    else {
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

<script  type="text/javascript">

    $(document).keydown(function (e) {
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
                        $('#liste_ligne tbody tr').each(function () {
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
                // Up             case 38:
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
                $('#liste_ligne tbody tr').each(function () {
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

<script  type="text/javascript">
    document.title = ('BMM - G. Compta. : Saisie de pièce');
</script>

<style>

    .selected_li{
        background-color:#3875d7;background-image:-webkit-gradient(linear,50% 0,50% 100%,color-stop(20%,#3875d7),color-stop(90%,#2a62bc));background-image:-webkit-linear-gradient(#3875d7 20%,#2a62bc 90%);background-image:-moz-linear-gradient(#3875d7 20%,#2a62bc 90%);background-image:-o-linear-gradient(#3875d7 20%,#2a62bc 90%);background-image:linear-gradient(#3875d7 20%,#2a62bc 90%);color:#fff
    }

</style>


<script  type="text/javascript">

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
    function getSerie() {

        if ($('#journal_popup').val() > -1 && $('#date').val() != '') {

            var date_saisie = $('#date').val();
            var d1 = new Date(<?php echo date('Y') ?>, <?php echo date('m') ?>, <?php echo date('d') ?>);
            var date_s = date_saisie.split("-");
            var d2 = new Date(date_s[0], date_s[1], date_s[2]);
            if (d1 >= d2) {
                goGetSerie(0);
            } else if (d1 < d2) {
                $('#date').val('');
                $('#serie').val('');
                $('#numero').val('');

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
                            $('#date').val(date_saisie);
                            goGetSerie();

                        } else {
                            $('#date').focus();
                        }
                    }
                });
            }
        }
    }
    function validerNumero() {
        if ($('#numero').val() != '') {
            $('#numero').attr('readonly', 'readonly');


        } else {
            $('#numero').focus();
        }
    }
    function goGetSerie() {
        $('#numero').attr('readonly', 'readonly');
        $('#td_label_attendu').css('display', 'none');
        $('#td_attendu').css('display', 'none');
        $.ajax({
            dataType: 'json',
            url: '<?php echo url_for('@getSerieJournalPopup') ?>',
            data: 'journal=' + $('#journal_popup').val() + '&date=' + $('#date').val(),
            success: function (data) {
                if (data.bloque == '0') {
                    $('#serie').val(data.serie);
                    $('#serie_id').val(data.serie_id);
                    $('#numero').val(data.numero);
                    $('#attendu').val(data.attendu);
                    $('#numero').focus();
                }

            }
        });
    }


</script>
<style>


</style>