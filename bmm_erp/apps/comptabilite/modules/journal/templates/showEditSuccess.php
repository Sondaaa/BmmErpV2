<div id="sf_admin_container">
    <h1 id="replacediv"> Base Comptable 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Modifier journal comptable : <?php echo $journal->getCode() . ' - ' . $journal->getLibelle() ?>
        </small>
    </h1>
</div>

<div class="row" style="margin-top: 20px;" ng-controller="myCtrlPaysVille">
    <div class="col-xs-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Journal comptable</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <fieldset>
                            <label>Code * :</label>
                            <input type="text" id="code_comptable" placeholder="Code journal comptable"
                                   value="<?php echo $journal->getCode() ?>"  onkeydown="chargerlistejournaux(event, false)"
                                   ondblclick="chargerlistejournaux(event, true)" obligatoire="true" />
                        </fieldset>
                        <fieldset>
                            <label>Intitulé * :</label>
                            <input type="text" id="intitule" placeholder="Intitulé journal comptable" value="<?php echo $journal->getLibelle() ?>" obligatoire="true" />
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

            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <fieldset>
                            <label>Type * :</label>
                            <select id="type_journal">
                                <option value=""></option>
                                <?php foreach ($type_journals as $type_journal): ?>
                                    <option <?php if ($journal->getIdTypeJournal() == $type_journal->getId()) echo 'selected="true"'; ?> value="<?php echo $type_journal->getId() ?>"> <?php echo $type_journal->getLibelle(); ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </fieldset>
                        <fieldset style="padding-top: 9px;">
                            <label><input <?php if ($journal->getIdComptecontrepartie() != null) echo 'checked="true"'; ?> id="choix_contre_partie" type="checkbox" onchange="setDisabledContrePartie()"/> Contre Partie :</label>
                            <select id="contre_partie" disabled="true">
                                <option value=""></option>
                                <?php foreach ($comptes as $compte): ?>
                                    <option value="<?php echo $compte->getId() ?>" <?php if ($journal->getIdComptecontrepartie() == $compte->getId()) echo 'selected="true"'; ?>> <?php echo $compte->getNumeroCompte() . ' - ' . $compte->getLibelle() ?> </option>
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
                        <input id="date_debut_cloture" value="<?php echo $journal->getDatedebutcloture(); ?>" type="date" style="width: 40%" obligatoire="true">
                        <input id="date_fin_cloture" value="<?php echo $journal->getDatefincloture(); ?>" type="date" style="width: 40%; float: right;" obligatoire="true">
                    </fieldset>
                    <fieldset>
                        <label style="width: 100%;">Type Numérotation :</label>
                        <select id="numerotation" onchange="affichageNumerotation()">
                            <option <?php if ($journal->getNumerotation() == 1): ?>selected="true"<?php endif; ?> value="1">Annuel</option>
                            <option <?php if ($journal->getNumerotation() == 2): ?>selected="true"<?php endif; ?> value="2" >Mensuel</option>
                            <option <?php if ($journal->getNumerotation() == 3): ?>selected="true"<?php endif; ?> value="3">Journalier</option>
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
                        <label>Comptes Comptables : <span id="nombre_compte"> <?php echo $journal->getSouscomptejournal()->count(); ?> </span></label>
                        <button style="margin-left: 15px;" onclick="gererCompte()" class="btn btn-sm btn-primary">
                            <i class="ace-icon fa fa-cogs bigger-110"></i>
                            Gérer les comptes comptables
                            <input type="hidden" id="generation_compte_comptable" value="0" />
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
                <input type="hidden" id="generation_permission" value="0" />
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
                                <i id="bloque_image_all" class="ace-icon fa fa-square-o bigger-170" onclick="checkBloqueTous(0)" style="cursor: pointer; display: none;"></i>
                                <i id="bloque_block_image_all" class="ace-icon fa fa-check-square-o bigger-170" onclick="checkBloqueTous(1)" style="cursor: pointer; display: none;"></i>
                                <input id="bloque_image_tous" type="hidden" value="0" />
                                Bloqué
                            </th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody id="liste_generer">
                        <?php if ($journal->getNumeroseriejournal()->count() == 0): ?>
                            <tr>
                                <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="7">Pas de génération</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($journal->getNumeroseriejournal() as $numserie): ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $numserie->getPrefixe(); ?></td>
                                    <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($numserie->getdatedebut())); ?></td>
                                    <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($numserie->getdatefin())); ?></td>
                                    <td style="text-align: center;"><?php echo sprintf("%03s", $numserie->getNumerodebut()); ?></td>
                                    <td style="text-align: center;"><?php echo sprintf("%03s", $numserie->getNumerofin()); ?></td>
                                    <td style="text-align: center;">
                                        <input id="attendu_<?php echo $numserie->getId(); ?>"  value="<?php echo sprintf("%03s", $numserie->getAttendu()); ?>">
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($numserie->getIsBloque() == 1): ?>
                                            <i class="ace-icon fa fa-check-square-o bigger-170"></i>
                                        <?php else: ?>
                                            <i class="ace-icon fa fa-square-o bigger-170"></i>
                                        <?php endif; ?>
                                        <input id="bloque_a" type="hidden" value="<?php echo $numserie->getIsBloque(); ?>" />
                                        <input type="hidden" class="permission_serie" id="generation_permission_serie_<?php echo $numserie->getId(); ?>" <?php if ($numserie->getPiececomptable()->count() == 0): ?>value="1"<?php else: ?>value="0"<?php endif; ?> />
                                    </td>
                                    <td>
                                        <input type="button" id="" onclick="savenouvauAttendu('<?php echo $numserie->getId() ?>')" value="Save nouveau attendu" class="btn btn-sm success">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
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
        <button class="btn btn-info" type="button" onclick="saveEditJournal(<?php echo $journal->getId(); ?>)">
            <i class="ace-icon fa fa-edit bigger-110"></i>
            Modifier
        </button>
        <a type="button" class="btn btn-default" href="<?php echo url_for('@listeJournalComptable') ?>">Retour à la liste  <i class="ace-icon fa fa-undo bigger-110"></i></a>
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
    setDisabledContrePartie();
    setDisabledGenerationSerie();

    function setDisabledContrePartie() {
        if ($('#choix_contre_partie').is(':checked'))
            $('#contre_partie').attr('disabled', false).trigger('chosen:updated');
        else {
            $('#contre_partie').attr('disabled', true).trigger('chosen:updated');
            $('#contre_partie').val('').trigger("chosen:updated");
        }
    }

    function setDisabledGenerationSerie() {
        $('.permission_serie').each(function () {
            if ($(this).val() == 0) {
                $('#generation_permission').val(0);
                $('#btn_generer').hide();
                $('#date_debut_cloture').attr("disabled", true);
                $('#date_fin_cloture').attr("disabled", true);
               $('#numerotation').attr('disabled', true).trigger('chosen:updated');
                return;
            }
        });
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
        $('#listevide').html('');
        if (champsObligatoiresGenerer()) {
            $.ajax({
                url: '<?php echo url_for('@genererNumerotation') ?>',
                data: 'numerotation=' + $('#numerotation').val() + '&date_debut=' + $('#date_debut_cloture').val() +
                        '&date_fin=' + $('#date_fin_cloture').val(),
                success: function (data) {
                    $('#liste_generer').html(data);
                    $('#bloque_image_all').css('display', 'block');
                    $('#generation_permission').val(1);
                }
            });
        } else {
            $('#listevide').html('<tr><td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="7">Pas de génération</td></tr>');
        }
    }

    function savenouvauAttendu(id) {
    //alert(id);
        $.ajax({
            url: '<?php echo url_for('journal/saveAttendu') ?>',
            data: 'id=' + id + '&attendu=' + $('#attendu_' + id).val(),
            success: function (data) {
                bootbox.dialog({
                    message: "<span class='bigger-110' style='margin:20px;color:#b31531;'>\n\
                    Attendu est maodifie avec succées </span>",
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
                $('#generation_compte_comptable').val(1);
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
                checkAncian();
            }
        });
    }

    function checkAncian() {
<?php foreach ($journal->getSouscomptejournal() as $cj): ?>
            $("#check_input_" + "<?php echo $cj->getIdSouscompte() ?>").prop('checked', true);
<?php endforeach; ?>
    }

    function saveEditJournal(id) {
        if (champsObligatoires()) {
            var numserie = chargerlist_generer();
            $.ajax({
                url: '<?php echo url_for('@saveEditJournal') ?>',
                data: 'numerotation=' + $('#numerotation').val() +
                        '&id=' + id +
                        '&date_debut_cloture=' + $('#date_debut_cloture').val() +
                        '&date_fin_cloture=' + $('#date_fin_cloture').val() +
                        '&code_comptable=' + $('#code_comptable').val() +
                        '&intitule=' + $('#intitule').val() +
                        '&type_journal=' + $('#type_journal').val() +
                        '&choix_contre_partie=' + $('#choix_contre_partie').is(':checked') +
                        '&contre_partie=' + $('#contre_partie').val() +
                        '&dossier=' + $('#dossier').val() +
                        '&generation_permission=' + $('#generation_permission').val() +
                        '&generation_compte_comptable=' + $('#generation_compte_comptable').val() +
                        '&numserie=' + numserie +
                        '&comptes=' + comptes,
                success: function (data) {
                    location.href = '<?php echo url_for('@listeJournalComptable')         ?>';
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
                $(this).css('border', '3px solid red');
                valide = false;
            }
        });

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
    document.title = ('BMM - G. Compta. : Modifier journal comptable');
</script>