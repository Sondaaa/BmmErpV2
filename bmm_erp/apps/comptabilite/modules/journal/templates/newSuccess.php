
<div id="sf_admin_container">
    <h1 id="replacediv"> Base Comptable 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Ajouter journal comptable
        </small>
    </h1>
</div>

<div class="row" ng-controller="msaveJournalyCtrlPaysVille"><!--ng-controller="myCtrlPaysVille"-->
    <div class="col-xs-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Journal comptable</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <fieldset><input id="id_comptable" type="hidden">
                            <label>Code * : (Maximum 15 Caractères)</label>
                            <input id="code_comptable" maxlength="15" type="text" value="" 
                                   obligatoire="true" placeholder="Code journal comptable" 
                                   onkeydown="chargerlistejournaux(event, false)"
                                   ondblclick="chargerlistejournaux(event, true)"/>
                        </fieldset>
                        <fieldset>
                            <label>Intitulé * :</label>
                            <input id="intitule" type="text" value="" obligatoire="true" placeholder="Intitulé journal comptable" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Paramètres</h4>
            </div>

            <div class="widget-body" style="height: 150px;">
                <div class="widget-main">
                    <form>
                        <fieldset>
                            <label>Type Journal* :</label>
                            <select id="type_journal" ><!--onchange="chargercontrepartie()"-->
                                <option value=""></option>
                                <?php foreach ($type_journals as $type_journal): ?>
                                    <option  value="<?php echo $type_journal->getId() ?>"> <?php echo $type_journal->getLibelle(); ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </fieldset>
                        <fieldset style="padding-top: 10px;">
                            <label><input id="choix_contre_partie" type="checkbox" onchange="setDisabledContrePartie()"/> Contre Partie à chaque ligne:</label>
                            <select id="contre_partie" disabled="true">
                                <option value=""></option>
                                <?php foreach ($comptes as $compte): ?>
                                    <option value="<?php echo $compte->getId() ?>"> <?php echo $compte->getNumeroCompte() . ' - ' . $compte->getLibelle() ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Journal et numérotation</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <fieldset>
                        <label style="width: 100%;">Période * :</label>
                        <input id="date_debut_cloture" value="" type="date" style="width: 40%" obligatoire="true">
                        <input id="date_fin_cloture" value="" type="date" style="width: 40%; float: right;" obligatoire="true">
                    </fieldset>
                    <fieldset>
                        <label style="width: 100%;">Type Numérotation :</label>
                        <select id="numerotation" onchange="affichageNumerotation()">
                            <option value="1">Annuel</option>
                            <option value="2" selected="true">Mensuel</option>
                            <option value="3">Journalier</option>
                        </select>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Avancés</h4>
                <span style="float: right; margin-top: 4px; margin-right: 5px;" class="btn btn-warning btn-sm tooltip-warning" data-rel="tooltip" data-placement="left" title="Gérer les comptes comptables : pour limiter le choix des comptes comptables dans les écritures (saisie de pièce) appartenant à ce journal comptable."><i class="ace-icon fa fa-info-circle bigger-110 icon-only"></i></span>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <fieldset>
                        <label>Dossier Comptable :</label>
                        <input readonly="true" type="text" value="<?php echo $dossier->getCode() . ' - ' . $dossier->getRaisonSociale(); ?>" obligatoire="true" />
                    </fieldset>
                    <fieldset style="padding-top: 22px;">
                        <label>Comptes Comptables : <span id="nombre_compte"> 0 </span></label>
                        <button style="margin-left: 15px;" onclick="gererCompte()" class="btn btn-sm btn-primary">
                            <i class="ace-icon fa fa-cogs bigger-110"></i>
                            Gérer les comptes comptables
                        </button>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="zone_table_numerotation">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat" style="padding-bottom: 4px;">
                <h4 class="widget-title smaller">Numérotation Série</h4>
                <button style="margin-left: 15px;" id="btn_generer" class="btn btn-sm btn-primary" type="button" onclick="genererNumerotation()">
                    <i class="ace-icon fa fa-cog bigger-110"></i>
                    Générer
                </button>
                <span style="float: right; margin-top: 4px; margin-right: 5px;" class="btn btn-warning btn-sm tooltip-warning" data-rel="tooltip" data-placement="left" title="Gérer les numérotatons des séries : pour déterminer le compteur des numéros des pièces comptables; appartenant à (ou bien saisis dans) ce journal comptable; suivant le type du numérotation (Annuel, mensuel et Journalier)."><i class="ace-icon fa fa-info-circle bigger-110 icon-only"></i></span>
            </div>
            <div>
                <table id="table_numerotatoin" class="table table-bordered table-hover" style="margin-bottom: 0px;">
                    <thead>
                        <tr>
                            <th>Préfix</th>
                            <th>Date Début</th>
                            <th>Date Fin</th>
                            <th>Numéro Début</th>
                            <th>Numéro Fin</th>
                            <th>Attendu</th>
                            <th>
                                <i id="bloque_image_all" class="ace-icon fa fa-square-o bigger-170" onclick="checkBloqueTous(0)" style="cursor: pointer"></i>
                                <i id="bloque_block_image_all" class="ace-icon fa fa-check-square-o bigger-170" onclick="checkBloqueTous(1)" style="cursor: pointer; display: none;"></i>
                                <input id="bloque_image_tous" type="hidden" value="0" />
                                Bloqué
                            </th>
                        </tr>
                    </thead>
                    <tbody id="liste_generer">
                        <tr>
                            <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="7">Pas de génération</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style ="padding: 0px;" colspan ="7">
                                <div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">
                                    <div class ="col-xs-12"></div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="clearfix form-actions">
    <div class="col-md-offset-5 col-md-6">
        <a id="btn_retour" type="button" style="width: 20%;margin-left: 1px;" 
           class="btn btn-primary1 " href="<?php echo url_for('@listeJournalComptable') ?>">
            <i class="ace-icon fa fa-undo bigger-110"></i>
            Retour à la liste</a>

        <button class="btn btn-info" type="button" onclick="saveJournal()">
            <i class="ace-icon fa fa-save bigger-110"></i>
            Ajouter
        </button>
        <button class="btn btn-danger" type="button" onclick="resetJournal()">
            <i class="ace-icon fa fa-undo bigger-110"></i>
            Annuler
        </button>
    </div>
</div>
<div id="my-modalListejournal" class="modal body" tabindex="1" > 
    <?php
    include_partial('journal/listejournaux', array());
    ?>
</div>
<script  type="text/javascript">

    //pour garder les ids des comptes comptales déterminées dans le popup "gérer les comptes comptables"
    var comptes = '';
    $('#date_debut_cloture').val("<?php echo $_SESSION['exercice'] . '-01-01'; ?>");
    $('#date_fin_cloture').val("<?php echo $_SESSION['exercice'] . '-12-31'; ?>");

    function setDisabledContrePartie() {
        if ($('#choix_contre_partie').is(':checked'))
            $('#contre_partie').attr('disabled', false).trigger('chosen:updated');
//        if ($('#type_journal') == '3') {
//            $('#contre_partie').html=;
//        }
        else {
            $('#contre_partie').attr('disabled', true).trigger('chosen:updated');
            $('#contre_partie').val('').trigger("chosen:updated");
        }
    }

    function chargercontrepartie() {
//        var id_type = $('#type_journal').val();
//        if (id_type != '') {
//            $.ajax({
//                url: '<?php // echo url_for('@affichecomptrepartie') ?>',
//                data: 'id_type=' + id_type,
//                success: function (data) {
//                    $('#contre_partie').html(data);
//                    $('.chosen-container').attr("style", "width: 100%;");
//                    $('#contre_partie').val('').trigger("liszt:updated");
//                    $('#contre_partie').trigger("chosen:updated");
//
//                }
//            });
//        }
//        else {
//            $('#libelle').css('border-color', '#f2a696');
//        }

    }
    function affichageNumerotation() {
        if ($('#numerotation').val() == '3') {
            $('#zone_table_numerotation').hide();
        } else {
            $('#liste_generer').html('');
            $('#liste_generer').html('<tr><td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="7">Pas de génération</td></tr>');
            $('#zone_table_numerotation').show();
        }
    }

    function checkBloqueTous(bloque) {
        if (bloque == 1) {
            $('#bloque_block_image_all').hide();
            $('#bloque_image_all').show();
            $('i[name="image_bloque_block"]').each(function () {
                $(this).hide();
                var id_input = $(this).attr('id_input');
                $("#" + id_input).val('0');
            });

            $('i[name="image_bloque"]').each(function () {
                $(this).show();
            });
        } else {
            $('#bloque_image_all').hide();
            $('#bloque_block_image_all').show();
            $('i[name="image_bloque"]').each(function () {
                $(this).hide();
                var id_input = $(this).attr('id_input');
                $("#" + id_input).val('1');
            });

            $('i[name="image_bloque_block"]').each(function () {
                $(this).show();
            });
        }
    }

    function genererNumerotation() {
        $('#liste_generer').html('');
        if (champsObligatoiresGenerer()) {
            $.ajax({
                url: '<?php echo url_for('@genererNumerotation') ?>', data: 'numerotation=' + $('#numerotation').val() + '&date_debut=' + $('#date_debut_cloture').val() +
                        '&date_fin=' + $('#date_fin_cloture').val(),
                success: function (data) {
                    $('#liste_generer').html(data);
                }
            });
        } else {
            $('#liste_generer').html('<tr> <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="7">Pas de génération</td></tr>');
        }
    }

    function getNombreCompte() {
        $('#nombre_compte').html($('.list_checbox_compte[type=checkbox]:checked').length);
        comptes = '';
        $('.list_checbox_compte[type=checkbox]:checked').each(function () {
            comptes += $(this).val() + ',';
        });
    }

    function gererCompte() {
        $.ajax({
            url: '<?php echo url_for('@gererComptesDossier') ?>',
            data: '',
            success: function (data) {
                bootbox.dialog({
                    message: data,
                    buttons:
                            {
                                "button":
                                        {
                                            "label": "Ok",
                                            "className": "btn-sm",
                                            "callback": getNombreCompte
                                        }
                            }
                });
                $(".bootbox-close-button").attr("style", " display: none;");
            }
        });
    }

    function saveJournal() {
        if (champsObligatoires()) {
            if ($("#type_journal").val() == "3" && $("#contre_partie").val() == "")
            {
                bootbox.dialog({
                    message: "<span class='bigger-160' style='margin:20px;color:#b31531;'>Attention !</span><br><span class='bigger-110' style='margin:20px;color:#b31531;'>Veuillez déterminer le contre partie  !</span>",
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
            var numserie = chargerlist_generer();
            $.ajax({
                url: '<?php echo url_for('@saveJournal') ?>',
                data: 'numerotation=' + $('#numerotation').val() +
                        '&date_debut_cloture=' + $('#date_debut_cloture').val() +
                        '&date_fin_cloture=' + $('#date_fin_cloture').val() +
                        '&code_comptable=' + $('#code_comptable').val() +
                        '&intitule=' + $('#intitule').val() +
                        '&type_journal=' + $('#type_journal').val() +
                        '&choix_contre_partie=' + $('#choix_contre_partie').is(':checked') +
                        '&contre_partie=' + $('#contre_partie').val() +
                        '&numserie=' + numserie +
                        '&comptes=' + comptes,
                success: function (data) {
                    resetJournal();
                    bootbox.dialog({
                        message: " Journal Ajouté avec succées  !",
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
    }

    function chargerlist_generer() {
        var list_generer = "";
        if ($('#liste_generer tr').size() > 0) {
            $('#liste_generer tr').each(function () {
                list_generer += $(this).children('td:eq(6)').children('input:first').val() + ',';
            });
        }
        return list_generer;
    }

    function champsObligatoiresGenerer() {
        var valide = true;
        if ($('#date_debut_cloture').val() != '' && $('#date_fin_cloture').val() != '') {
            var date1 = $('#date_debut_cloture').val().split('/');
            var date2 = $('#date_fin_cloture').val().split('/');

            if (date1[2] == date2[2] && ((date1[1] + date1[0]) <= (date2[1] + date2[0]))) {
                $('#date_debut_cloture').css('border', '');
                $('#date_fin_cloture').css('border', '');
            } else {
                $('#date_debut_cloture').css('border', '3px solid red');
                $('#date_fin_cloture').css('border', '3px solid red');
                valide = false;
            }
        } else {
            var valide = false;
        }

        if (valide == false) {
            bootbox.dialog({
                message: "<span class='bigger-160' style='margin:20px;color:#b31531;'>Attention !</span><br><span class='bigger-110' style='margin:20px;color:#b31531;'>Veuillez déterminer la période du numérotation !</span>",
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

        return valide;
    }

    function champsObligatoires() {
        var valide = true;
        $('input[type="text"][obligatoire=true]').each(function () {
            if ($(this).val() !== '')
                $(this).css('border', '');
            else {
                $(this).css('border-color', '#f2a696');
                valide = false;
            }
        });

        $('input[type="date"][obligatoire=true]').each(function () {
            if ($(this).val() !== '')
                $(this).css('border', '');
            else {
                $(this).css('border-color', '#f2a696');
                valide = false;
            }
        });

        $('#type_journal').each(function () {
            if ($(this).val() !== '')
                $('#type_journal_chosen > .chosen-single').css('border', '');
            else {
                $('#type_journal_chosen > .chosen-single').css('border-color', '#f2a696');
                valide = false;
            }
        });

        if ($('#choix_contre_partie').is(':checked')) {
            $('#contre_partie').each(function () {
                if ($(this).val() !== '')
                    $('#contre_partie_chosen > .chosen-single').css('border', '');
                else {
                    $('#contre_partie_chosen > .chosen-single').css('border-color', '#f2a696');
                    valide = false;
                }
            });
        }

        if (valide == false) {
            bootbox.dialog({
                message: "<span class='bigger-160' style='margin:20px;color:#b31531;'>Attention !</span><br><span class='bigger-110' style='margin:20px;color:#b31531;'>Veuillez remplir les champs obligatoires ( * ) !</span>",
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

        return valide;
    }

    function resetJournal() {
        $('#nombre_compte').html('0');
        $('#choix_contre_partie').prop('checked', false);
        $('#date_debut_cloture').val('<?php echo $_SESSION['exercice'] . '-01-01'; ?>');
        $('#date_fin_cloture').val('<?php echo $_SESSION['exercice'] . '-12-31'; ?>');
        $("#code_comptable").val('');
        $('#intitule').val('');
        $(".chosen-select").val('').trigger("chosen:updated");
        $('#numerotation').val('2').trigger("chosen:updated");
        ;
        $('#liste_generer').html('');
        $('#liste_generer').html('<tr><td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="7">Pas de génération</td></tr>');
        $('#zone_table_numerotation').show();

        setDisabledContrePartie();
    }
//afficher liste des journaux 

    function chargerlistejournaux(e, dbclick)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            $('#my-modalListejournal').addClass('in');
            $('#my-modalListejournal').css('display', 'block');
        }
    }


</script>

<style>

    #table_numerotatoin thead th{text-align: center;}
    #liste_generer tr td{vertical-align: middle; border: 1px solid #ddd;}
    .bootbox-close-button{display: none;}

</style>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : Ajouter journal comptable");
</script>