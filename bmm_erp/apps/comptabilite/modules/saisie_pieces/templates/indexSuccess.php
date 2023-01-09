<div id="sf_admin_container">
    <h1 id="replacediv"> Traitement
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Saisie des pièces
        </small>
    </h1>
</div>

<div id="form_saisie_pieces">
    <?php include_partial('saisie_pieces/form', array("maquettes" => $maquettes, "pager" => $pager, "page" => $page, 'journals' => $journals, 'nature_pieces' => $nature_pieces, 'id_journal' => '', 'id_serie' => '', 'date' => '', 'serie' => '', 'numero' => '', 'num_externe' => '', 'reference' => '', 'id_nature_pieces' => '', 'libelle' => '')) ?>
</div>

<script type="text/javascript">
    function showMaquette(id) {
        $.ajax({
            url: '<?php echo url_for('saisie_pieces/showMaquette'); ?>',
            data: 'maquette_id=' + id,
            success: function(data) {
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
                callback: function(result) {
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
                success: function(data) {
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
            success: function(data) {
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
        //           $('#journal_option').addClass('disabledbutton');
        //        var btn = document.querySelector('input');
        ////var txt = document.querySelector('p');
        //
        //        btn.addEventListener('change', Choisirnaturepiece);

        if (!ace.vars['touch']) {
            $('.chosen-select').chosen({
                allow_single_deselect: true
            });
            //resize the chosen on window resize

            $(window)
                .off('resize.chosen')
                .on('resize.chosen', function() {
                    $('.chosen-select').each(function() {
                        var $this = $(this);
                        $this.next().css({
                            'width': $this.parent().width()
                        });
                    })
                }).trigger('resize.chosen');
            //resize chosen on sidebar collapse/expand
            $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
                if (event_name != 'sidebar_collapsed')
                    return;
                $('.chosen-select').each(function() {
                    var $this = $(this);
                    $this.next().css({
                        'width': $this.parent().width()
                    });
                })
            });


            $('#chosen-multiple-style .btn').on('click', function(e) {
                var target = $(this).find('input[type=radio]');
                var which = parseInt(target.val());
                if (which == 2)
                    $('#form-field-select-4').addClass('tag-input-style');
                else
                    $('#form-field-select-4').removeClass('tag-input-style');
            });
        }
        //        document.location.reload();
    }

    function validerPiece(re_journal) {
        console.log(re_journal);
        if (verifierFormPiece()) {
            console.log(re_journal + 'true');
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
            $('#liste_ligne tbody tr').each(function() {
                nb_lignes++;
                var i_ligne = $(this).attr('index_ligne');
                console.log('index=' + i_ligne);
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
                console.log(i_ligne);
                // i_ligne++;
            });

            if (nb_lignes != 0) {
                if (compte_remplie == true) {
                    if (montant_remplie == true) {
                        var total_solde = $('#total_solde').val();
                        if (parseFloat(total_solde) == 0) {
                            $.ajax({
                                url: '<?php echo url_for('@validerPiece') ?>',
                                data: 'journal=' + $('#journal_id').val() +
                                    '&nature_piece=' + $('#nature_piece').val() +
                                    '&reference=' + $('#reference').val() +
                                    '&libelle=' + $('#libelle_piece').val() +
                                    '&numero_externe=' + $('#numero_externe').val() +
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
                                success: function(data) {
                                    $('#form_saisie_pieces').html(data);
                                    bootbox.dialog({
                                        message: "<span class='bigger-160' style='margin:20px;'> " + " Pièce(s) comptable(s) créée(s) avec succès !</span>",
                                        buttons: {
                                            "button": {
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
                                buttons: {
                                    "button": {
                                        "label": "Ok",
                                        "className": "btn-sm btn-danger"
                                    }
                                }
                            });
                        }
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
        } else {
            bootbox.dialog({
                message: "Veuillez saisir les champs obligatoires !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
        afficher();
        //        document.location.reload();
    }

    function verifierFormPiece() {
        var valide = true;

        if ($('#journal_id').val() != '')
            $('#journal_id').css('border', '');
        else {
            $('#journal_id').css('border-color', '#f2a696');
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


        //        if ($('#z_nature_piece').val() != '-1')
        //            $('#nature_piece_chosen > .chosen-single').css('border', '');
        //        else {
        //            $('#nature_piece_chosen > .chosen-single').css('border-color', '#f2a696');
        //            valide = false;
        //        }
        //        if ($('#nature_piece_option').val() != '')
        //            $('#nature_piece_option').css('border', '');
        //        else {
        //            $('#nature_piece_option').css('border-color', '#f2a696');
        //            valide = false;
        //        }
        return valide;
    }
</script>

<script type="text/javascript">
    window.addEventListener("keydown", function(event) {
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
                success: function(data) {
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
                //F3
            case 114:
                validerPiece('1');
                break;
                // F4
            case 115:
                validerPiece('0');
                break;
            case "Enter":
                ajouterLastLigne();
                break;
            case "ArrowDown":
                addFirstLigne();
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

                        //                        $('#ligne_libelle_' + index).focus();
                        var count_ligne = 0;
                        $('#liste_ligne tbody tr').each(function() {
                            count_ligne++;
                        });
                        if (index < count_ligne) {

                            $('#ligne_compte_' + index).focus();
                        } else {
                            ajouterLastLigne();
                        }
                        break;

                        //                    
                    case 'ligne_libelle':
                        var count_ligne = 0;
                        $('#liste_ligne tbody tr').each(function() {
                            count_ligne++;
                        });
                        if (index < count_ligne) {

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
                    index++;
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
                        addFirstLigne();
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
                                $('#ligne_libelle_' + index).focus();
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
    document.title = ('BMM - G. Compta. : Saisie de pièce');
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
</style>


<script type="text/javascript">
    // $('#journal').change(function() {        
    //     $('#journal_id').val($('#journal').val());
    //     console.log('Journal id=' + $('#journal_id').val());
    //     goPage(1);

    // });
    // $('#journal_id').change(function() {
    //     goPage(1);
    // });
    // $('#nature_piece').change(function() {
    //     goPage(1);
    // });   

    $('#journal_option').change(function() {
        // alert('de');
        //  goPage(1);
    });

    function initform() {
        // $('#code').val('');
        // $('#nature').val('');
        // $('#libelle').val('');
        // $('#journal').val('');
        goPage(1);
    }

    function tri(type) {
        $('#list_tri th[name=tri]').each(function() {

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
        // goPage(1);
    }

    function goPage(page) {

        var type = $('#type_tri').val();
        type = 'ligne_' + type;
        if ($('#journal_option').val() != '') {
            $.ajax({
                url: '<?php echo url_for('maquette_saisie/goSaisie'); ?>',
                data: 'page=' + page + '&code=' + $('#code').val() + '&nature=' + $('#nature').val() +
                    '&libelle=' + $('#libelle').val() + '&journal=' + $('#journal').val() +
                    '&type_tri=' + $('#type_tri').val() + '&tri=' + $('#tri').val() +
                    '&nature_id=' + $('#nature_piece').val() + '&journal_id=' + $('#journal_id').val(),
                success: function(data) {
                    $('#listMaquette tbody').html(data);
                }
            });
        }
    }



    function showMaquette(id) {
        $.ajax({
            url: '<?php echo url_for('maquette_saisie/show'); ?>',
            data: 'maquette_id=' + id,
            success: function(data) {
                $('#show_maquette').html(data);
                $('#form_liste_piece').fadeOut();
                $('#show_maquette').fadeIn();
                $('#show_edit_maquette').fadeOut();
            }
        });
    }

    function ChoisirMaquette(id_selected) {
        $('#id_maquette').val();
        $("input[name=maqu_chek]").each(function() {
            var id = $(this).attr("id");
            if ('#select_maq_' + id_selected != '#' + id)
                $('#' + id).prop("checked", false);


        });
        if ($('#select_maq_' + id_selected).prop("checked") == false) {
            $('#id_maquette').val('');
        } else
            $('#id_maquette').val(id_selected);
        addFirstLigne();
        // afficherlibelleMaquette(id_selected);
    }

    function afficherlibelleMaquette(id) {
        var data = {
            maquette_id: id
        };
        $.ajax({
            type: 'POST',
            url: '<?php echo url_for('saisie_pieces/afficherLibelleMaquette'); ?>',
            //   data: 'maquette_id=' + id,
            data: JSON.stringify(data),
            dataType: 'json',
            contentType: 'application/json',
            success: function(result) {
                //console.log(result.data[0].name );
                $('#libelle_piece').val(result.data[0].name);
                addFirstLigne();
            }
        });
        //  addFirstLigne();
    }
</script>