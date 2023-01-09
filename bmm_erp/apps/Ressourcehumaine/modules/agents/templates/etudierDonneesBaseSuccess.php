<div id="sf_admin_container">
    <h1 id="replacediv"> Personnels
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Données de Base
        </small>
    </h1>
</div>
<?php $lieux = GouverneraTable::getInstance()->findAll(); ?>
<?php $sexes = SexeTable::getInstance()->findAll(); ?>
<?php $regroupements = RegroupementagentsTable::getInstance()->findAll(); ?>
<?php $situations = EtatcivilTable::getInstance()->findAll(); ?>

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->

        <div class="table-header blue" style="color: #FFF !important;">
            Liste des Personnels
            <div style="float: right;">
                <div class="btn-group">
                    <button onclick="imprimer()" style="height: 38px;" class="btn btn-primary btn-white">
                        <i class="ace-icon fa fa-print" style="margin-right: 0px;"></i>
                    </button>
                    <button data-toggle="dropdown" style="height: 38px; width: 200px;" class="btn btn-primary btn-white dropdown-toggle" aria-expanded="true">
                        <i class="ace-icon fa fa-list"></i>
                        Afficher les colonnes
                        <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                    </button>

                    <ul class="dropdown-menu">
                        <li><input type="checkbox" checked="true" value="sf_admin_list_td_idrh" id="ck_matricule" onchange="setAffichageColonne('ck_matricule')" /> Matricule</li>
                        <li><input type="checkbox" checked="true" value="sf_admin_list_td_cin" id="ck_cin" onchange="setAffichageColonne('ck_cin')" /> CIN</li>
                        <li><input type="checkbox" checked="true" value="sf_admin_list_td_nomcomplet" id="ck_nom" onchange="setAffichageColonne('ck_nom')" /> Nom</li>
                        <li><input type="checkbox" checked="true" value="sf_admin_list_td_prenom" id="ck_prenom" onchange="setAffichageColonne('ck_prenom')" /> Prénom & Père</li>
                        <li><input type="checkbox" checked="true" value="sf_admin_list_td_date_naissance" id="ck_date_naissance" onchange="setAffichageColonne('ck_date_naissance')" /> Date Naissance / Age &nbsp;</li>
                        <li><input type="checkbox" checked="true" value="sf_admin_list_td_lieu_naissance" id="ck_lieu_naissance" onchange="setAffichageColonne('ck_lieu_naissance')" /> Lieu Naissacance</li>
                        <li><input type="checkbox" checked="true" value="sf_admin_list_td_sexe" id="ck_sexe" onchange="setAffichageColonne('ck_sexe')" /> Sexe</li>
                        <li><input type="checkbox" checked="true" value="sf_admin_list_td_regroupementagents" id="ck_regroupement" onchange="setAffichageColonne('ck_regroupement')" /> Regroupement</li>
                        <li><input type="checkbox" checked="true" value="sf_admin_list_td_adresse" id="ck_adresse" onchange="setAffichageColonne('ck_adresse')" /> Adresse / Ville</li>
                        <li><input type="checkbox" checked="true" value="sf_admin_list_td_situation" id="ck_situation" onchange="setAffichageColonne('ck_situation')" /> Situation Familiale</li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="zone_table">
            <table id="listAgents" class="table table-bordered table-hover">
                <thead>
                    <tr style="border-bottom: 1px solid #000000;">
                        <th style="width: 2%; text-align: center;">
                            <a href="#" id="id-btn-dialog1" title="Ajouter agent" class="ui-pg-div ui-inline-plus">
                                <i class="ace-icon fa fa-user-plus bigger-130 blue"></i>
                            </a>
                <div id="dialog-message" class="hide">
                    <legend style="margin-bottom: 10px; font-size: 18px;">Données de Base : </legend>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 15%">Matricule</td>
                                <td style="width: 35%"><input id="new_matricule" type="text" value=""></td>
                                <td style="width: 15%">C.I.N</td>
                                <td style="width: 35%"><input id="new_cin" type="text" value=""></td>
                            </tr>
                            <tr>
                                <td style="width: 15%">Nom</td>
                                <td style="width: 35%"><input id="new_nom" type="text" value=""></td>
                                <td style="width: 15%">Prénom & Prénom Père</td>
                                <td style="width: 35%"><input id="new_prenom" type="text" value=""></td>
                            </tr>
                            <tr>
                                <td style="width: 15%">Date Naissance</td>
                                <td style="width: 35%"><input id="new_date_naissance" type="date" value=""></td>
                                <td style="width: 15%">Lieu Naissance</td>
                                <td style="width: 35%">
                                    <select id="new_lieu_naissance">
                                        <option value="0"></option>
                                        <?php foreach ($lieux as $lieu): ?>
                                            <option value="<?php echo $lieu->getId() ?>"><?php echo $lieu->getGouvernera(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 15%">Sexe</td>
                                <td style="width: 35%">
                                    <select id="new_sexe">
                                        <option value="0"></option>
                                        <?php foreach ($sexes as $sexe): ?>
                                            <option value="<?php echo $sexe->getId() ?>"><?php echo $sexe; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td style="width: 15%">Regroupement</td>
                                <td style="width: 35%">
                                    <select id="new_regroupement">
                                        <option value="0"></option>
                                        <?php foreach ($regroupements as $regroupement): ?>
                                            <option value="<?php echo $regroupement->getId() ?>"><?php echo $regroupement; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 15%">Situation Familiale</td>
                                <td style="width: 35%">
                                    <select id="new_situation">
                                        <option value="0"></option>
                                        <?php foreach ($situations as $situation): ?>
                                            <option value="<?php echo $situation->getId() ?>"><?php echo $situation; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td style="width: 15%">Ville<br>(Adresse)</td>
                                <td style="width: 35%">
                                    <select id="new_id_gouvn">
                                        <option value="0"></option>
                                        <?php foreach ($lieux as $lieu): ?>
                                            <option value="<?php echo $lieu->getId() ?>"><?php echo $lieu->getGouvernera(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 15%">Adresse</td>
                                <td colspan="3"><input id="new_adresse" type="text" value=""></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="hr hr-12 hr-double"></div>
                    <p style="color: #426baa;">
                        Remarque : Ce formulaire contient seulement les données de base, on peut ajouter les autres données de l'agent à travers le formulaire principal.
                    </p>
                </div>
                <script  type="text/javascript">

                    $("#id-btn-dialog1").on('click', function (e) {
                        e.preventDefault();
                        viderFormNew();
                        $("#new_matricule").attr('maxlength', '8');
                        $("#new_cin").attr('maxlength', '8');
                        var dialog = $("#dialog-message").removeClass('hide').dialog({
                            modal: true,
                            title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-user-plus'></i> <b>Ajouter Agent</b></h4></div>",
                            title_html: true,
                            buttons: [
                                {
                                    text: "Ajouter",
                                    "class": "btn btn-success btn-minier",
                                    click: function () {
                                        $.ajax({
                                            url: '<?php echo url_for('agents/saveDonneesBase'); ?>',
                                            data: 'matricule=' + $("#new_matricule").val() +
                                                    '&cin=' + $("#new_cin").val() +
                                                    '&nom=' + $("#new_nom").val() +
                                                    '&prenom=' + $("#new_prenom").val() +
                                                    '&date_naissance=' + $("#new_date_naissance").val() +
                                                    '&lieu_naissance=' + $("#new_lieu_naissance").val() +
                                                    '&sexe=' + $("#new_sexe").val() +
                                                    '&regroupement=' + $("#new_regroupement").val() +
                                                    '&situation=' + $("#new_situation").val() +
                                                    '&adresse=' + $("#new_adresse").val() +
                                                    '&id_gouvn=' + $("#new_id_gouvn").val(),
                                            success: function (data) {
                                                goPage(1);
                                            }
                                        });
                                        $(this).dialog("close");
                                    }
                                },
                                {
                                    text: "Annuler",
                                    "class": "btn btn-primary btn-minier",
                                    click: function () {
                                        $(this).dialog("close");
                                    }
                                }
                            ]
                        });
                        $('.chosen-container').attr('style', 'width:100%');
                        $('.chosen-container').trigger("chosen:updated");
                    });

                    function viderFormNew() {
                        $("#new_matricule").val('');
                        $("#new_cin").val('');
                        $("#new_nom").val('');
                        $("#new_prenom").val('');
                        $("#new_date_naissance").val('');
                        $("#new_adresse").val('');

                        $("#new_lieu_naissance").val('').trigger("liszt:updated");
                        $("#new_lieu_naissance").trigger("chosen:updated");

                        $("#new_sexe").val('').trigger("liszt:updated");
                        $("#new_sexe").trigger("chosen:updated");

                        $("#new_regroupement").val('').trigger("liszt:updated");
                        $("#new_regroupement").trigger("chosen:updated");

                        $("#new_situation").val('').trigger("liszt:updated");
                        $("#new_situation").trigger("chosen:updated");

                        $("#new_id_gouvn").val('').trigger("liszt:updated");
                        $("#new_id_gouvn").trigger("chosen:updated");
                    }
                </script>
                </th>
                <th class="sf_admin_list_td_idrh" style="width: 5%; text-align: center;">Matricule</th>
                <th class="sf_admin_list_td_cin" style="width: 8%; text-align: center;">CIN</th>
                <th class="sf_admin_list_td_nomcomplet" style="width: 11%; text-align: center;">Nom</th>
                <th class="sf_admin_list_td_prenom" style="width: 11%; text-align: center;">Prénom & Prénom Père</th>
                <th class="sf_admin_list_td_date_naissance" style="width: 8%; text-align: center;">D. Naissance (Age)</th>
                <th class="sf_admin_list_td_lieu_naissance" style="width: 11%; text-align: center;">Lieu Naissance</th>
                <th class="sf_admin_list_td_sexe" style="width: 8%; text-align: center;">Sexe</th>
                <th class="sf_admin_list_td_regroupementagents" style="width: 7%; text-align: center;">Regroupement</th>
                <th class="sf_admin_list_td_adresse" style="width: 10%; text-align: center;">Adresse / Ville</th>
                <th class="sf_admin_list_td_situation" style="width: 9%; text-align: center;">Situation Familiale</th>
                </tr>
                <tr style="border-bottom: 1px solid #000000">
                    <th style="text-align: center;"><i class="ace-icon fa fa-search bigger-130 blue"></i></th>
                    <th class="sf_admin_list_td_idrh"><input id="filtre_idrh" maxlength="8" type="text" value="" class="align-center" onkeyup="goPage('1')" /></th>
                    <th class="sf_admin_list_td_cin"><input id="filtre_cin" maxlength="8" type="text" value="" class="align-center" onkeyup="goPage('1')" /></th>
                    <th class="sf_admin_list_td_nomcomplet"><input id="filtre_nom" type="text" value="" onkeyup="goPage('1')" /></th>
                    <th class="sf_admin_list_td_prenom"><input id="filtre_prenom" type="text" value="" onkeyup="goPage('1')" /></th>
                    <th class="sf_admin_list_td_date_naissance"><input id="filtre_date_naissance" type="date" value="" onchange="goPage('1')" /></th>
                    <th class="sf_admin_list_td_lieu_naissance">
                        <select id="filtre_lieu_naissance" onchange="goPage('1')">
                            <option value="0"></option>
                            <?php foreach ($lieux as $lieu): ?>
                                <option value="<?php echo $lieu->getId() ?>"><?php echo $lieu->getGouvernera(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </th>
                    <th class="sf_admin_list_td_sexe">
                        <select id="filtre_sexe" onchange="goPage('1')">
                            <option value="0"></option>
                            <?php foreach ($sexes as $sexe): ?>
                                <option value="<?php echo $sexe->getId() ?>"><?php echo $sexe; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </th>
                    <th class="sf_admin_list_td_regroupementagents">
                        <select id="filtre_regroupement" onchange="goPage('1')">
                            <option value="0"></option>
                            <?php foreach ($regroupements as $regroupement): ?>
                                <option value="<?php echo $regroupement->getId() ?>"><?php echo $regroupement; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </th>
                    <th class="sf_admin_list_td_adresse"><input id="filtre_adresse" type="text" value="" onkeyup="goPage('1')" /></th>
                    <th class="sf_admin_list_td_situation">
                        <select id="filtre_situation" onchange="goPage('1')">
                            <option value="0"></option>
                            <?php foreach ($situations as $situation): ?>
                                <option value="<?php echo $situation->getId() ?>"><?php echo $situation; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </th>
                </tr>
                </thead>
                <tfoot></tfoot>
                <tbody>
                    <?php include_partial("listeDonneesBase", array("pager" => $pager, "page" => $page)); ?>
                </tbody>
            </table>

            <span id="loading_icon" style="display: none;" class="orange"><i class="ace-icon fa fa-spinner fa-spin orange bigger-190"></i> Chargement ... </span>
        </div>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div>

<script  type="text/javascript">

    function setAffichageColonne(id) {
        var class_name = $('#' + id).val();
        if ($('#' + id).is(':checked')) {
            $('th[class=' + class_name + ']').each(function () {
                $(this).css('display', 'revert');
            });
            $('td[class=' + class_name + ']').each(function () {
                $(this).css('display', 'revert');
            });
        } else {
            $('th[class=' + class_name + ']').each(function () {
                $(this).css('display', 'none');
            });
            $('td[class=' + class_name + ']').each(function () {
                $(this).css('display', 'none');
            });
        }
    }

    function setAllAffichageColonne() {
        $('input[type=checkbox]').each(function () {
            setAffichageColonne($(this).attr('id'));
        });
    }

    function imprimer() {
        var check_value = '';
        var matricule = '';
        if ($('#ck_matricule').is(':checked')) {
            matricule = $('#filtre_idrh').val();
            check_value = '1';
        } else {
            check_value = '0';
        }
        var cin = '';
        if ($('#ck_cin').is(':checked')) {
            cin = $('#filtre_cin').val();
            check_value = check_value + ',1';
        } else {
            check_value = check_value + ',0';
        }

        var nom = '';
        if ($('#ck_nom').is(':checked')) {
            nom = $('#filtre_nom').val();
            check_value = check_value + ',1';
        } else {
            check_value = check_value + ',0';
        }

        var prenom = '';
        if ($('#ck_prenom').is(':checked')) {
            prenom = $('#filtre_prenom').val();
            check_value = check_value + ',1';
        } else {
            check_value = check_value + ',0';
        }

        var date_naissance = '';
        if ($('#ck_date_naissance').is(':checked')) {
            date_naissance = $('#filtre_date_naissance').val();
            check_value = check_value + ',1';
        } else {
            check_value = check_value + ',0';
        }

        var lieu_naissance = '';
        if ($('#ck_lieu_naissance').is(':checked')) {
            lieu_naissance = $('#filtre_lieu_naissance').val();
            check_value = check_value + ',1';
        } else {
            check_value = check_value + ',0';
        }

        var sexe = '';
        if ($('#ck_sexe').is(':checked')) {
            sexe = $('#filtre_sexe').val();
            check_value = check_value + ',1';
        } else {
            check_value = check_value + ',0';
        }

        var regroupement = '';
        if ($('#ck_regroupement').is(':checked')) {
            regroupement = $('#filtre_regroupement').val();
            check_value = check_value + ',1';
        } else {
            check_value = check_value + ',0';
        }

        var adresse = '';
        if ($('#ck_adresse').is(':checked')) {
            adresse = $('#filtre_adresse').val();
            check_value = check_value + ',1';
        } else {
            check_value = check_value + ',0';
        }

        var situation = '';
        if ($('#ck_situation').is(':checked')) {
            situation = $('#filtre_situation').val();
            check_value = check_value + ',1';
        } else {
            check_value = check_value + ',0';
        }

        var url = '?matricule=' + matricule + '&cin=' + cin + '&nom=' + nom + '&prenom=' + prenom + '&date_naissance=' + date_naissance + '&lieu_naissance=' + lieu_naissance + '&sexe=' + sexe + '&regroupement=' + regroupement + '&adresse=' + adresse + '&situation=' + situation + '&check_value=' + check_value;

        url = '<?php echo url_for('agents/imprimerListePersonnelDonneesBase') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }

    function goPage(page) {
        $('#loading_icon').show();
        var matricule = '';
        if ($('#ck_matricule').is(':checked'))
            matricule = $('#filtre_idrh').val();

        var cin = '';
        if ($('#ck_cin').is(':checked'))
            cin = $('#filtre_cin').val();

        var nom = '';
        if ($('#ck_nom').is(':checked'))
            nom = $('#filtre_nom').val();

        var prenom = '';
        if ($('#ck_prenom').is(':checked'))
            prenom = $('#filtre_prenom').val();

        var date_naissance = '';
        if ($('#ck_date_naissance').is(':checked'))
            date_naissance = $('#filtre_date_naissance').val();

        var lieu_naissance = '';
        if ($('#ck_lieu_naissance').is(':checked'))
            lieu_naissance = $('#filtre_lieu_naissance').val();

        var sexe = '';
        if ($('#ck_sexe').is(':checked'))
            sexe = $('#filtre_sexe').val();

        var regroupement = '';
        if ($('#ck_regroupement').is(':checked'))
            regroupement = $('#filtre_regroupement').val();

        var adresse = '';
        if ($('#ck_adresse').is(':checked'))
            adresse = $('#filtre_adresse').val();

        var situation = '';
        if ($('#ck_situation').is(':checked'))
            situation = $('#filtre_situation').val();

        $.ajax({
            url: '<?php echo url_for('agents/etudierDonneesBase'); ?>',
            data: 'page=' + page +
                    '&matricule=' + matricule +
                    '&cin=' + cin +
                    '&nom=' + nom +
                    '&prenom=' + prenom +
                    '&date_naissance=' + date_naissance +
                    '&lieu_naissance=' + lieu_naissance +
                    '&sexe=' + sexe +
                    '&regroupement=' + regroupement +
                    '&adresse=' + adresse +
                    '&situation=' + situation,
            success: function (data) {
                setAllAffichageColonne();

                $('input:text[id!="delai"]').attr('style', 'width: 100%;');
                $('select').attr('class', "chosen-select form-control");
                $('.chosen-select').chosen({allow_single_deselect: true});

                $('#loading_icon').hide();
                if (page == 1) {
                    $('#listAgents tbody').html(data);
                    next_page = 2;
                    loadPage = true;
                } else {
                    $('#listAgents tbody').append(data);
                    next_page = next_page + 1;
                    loadPage = true;
                }
            }
        });
    }

    function resetLigne(id) {
        $("#ligne_form_" + id).remove();
        $("#tr_" + id).show();
    }

    function setAgent(id) {
        $.ajax({
            url: '<?php echo url_for('agents/etudierAgent'); ?>',
            data: 'id=' + id,
            success: function (data) {
                $("#tr_" + id).before(data);
                setAllAffichageColonne();
                $("#tr_" + id).hide();

                $('input:text').attr('style', 'width: 100%;');
                $('select').attr('class', "chosen-select form-control");
                $('.chosen-select').chosen({allow_single_deselect: true});
            }
        });
    }

    function deleteAgent(id) {
        bootbox.confirm({
            message: "Voulez-vous vraiment supprimer cet agent ?",
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
                    goDeleteAgent(id);
                }
            }
        });
    }

    function goDeleteAgent(id) {
        $.ajax({
            url: '<?php echo url_for('agents/delete'); ?>',
            data: 'id=' + id + '&page_initiale=etudier_donnee_base',
            success: function (data) {
                $("#tr_" + id).remove();
                bootbox.dialog({
                    message: "<span class='bigger-110' style='margin:20px;'>Agent supprimé !</span>",
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
        });
    }

    function saveAgent(id) {
        $.ajax({
            url: '<?php echo url_for('agents/saveDonneesBase'); ?>',
            data: 'id=' + id +
                    '&matricule=' + $("#form_idrh").val() +
                    '&cin=' + $("#form_cin").val() +
                    '&nom=' + $("#form_nom").val() +
                    '&prenom=' + $("#form_prenom").val() +
                    '&date_naissance=' + $("#form_date_naissance").val() +
                    '&lieu_naissance=' + $("#form_lieu_naissance").val() +
                    '&sexe=' + $("#form_sexe").val() +
                    '&regroupement=' + $("#form_regroupement").val() +
                    '&situation=' + $("#form_situation").val(),
            success: function (data) {
                $("#tr_" + id).html(data);
                $("#tr_" + id).attr("style", "background-color: #d6ffce;");
                resetLigne(id);
            }
        });
    }

    var next_page = 2;
    var loadPage = true;
    $(window).on('scroll', function () {
        if ($(window).scrollTop() >= $('#zone_table').offset().top + $('#zone_table').outerHeight() - window.innerHeight) {
            if (loadPage == true) {
                loadPage = false;
                goPage(next_page);
            }
        }
    });

</script>

<style>

    .dropdown-menu li {
        color: #000 !important;
        line-height: 30px;
        padding-left: 10px;
    }

    .ui-dialog{width: 700px !important;}

    #listAgents tbody td{vertical-align: middle;}

    #new_id_gouvn_chosen .chosen-results{max-height: 100px;}
    #new_lieu_naissance_chosen .chosen-results{max-height: 100px;}

</style>

<script  type="text/javascript">
    document.title = ("ONE ERP - G. Compta. : Personnels (Données de Base)");
</script>