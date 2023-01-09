<div id="sf_admin_container">
    <h1 id="replacediv"> Dossier Comptable 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Transfert des comptes comptables : du <span style="font-style: italic; font-weight: bold;">base standard</span> vers <span style="font-style: italic; font-weight: bold;">plan comptable</span>
        </small>
    </h1>
</div>

<div class="widget-box">
    <div class="widget-header widget-header-blue widget-header-flat">
        <h4 class="widget-title lighter">Paramètres du transfert</h4>
    </div>

    <div class="widget-body" ng-controller="myCtrlCompteComptable">
        <div class="widget-main">
            <div id="fuelux-wizard-container">
                <div>
                    <ul class="steps">
                        <li data-step="1" class="active">
                            <span class="step">1</span>
                            <span class="title">Mode de transfert</span>
                        </li>

                        <li data-step="2">
                            <span class="step">2</span>
                            <span class="title">Choix des comptes</span>
                        </li>

                        <li data-step="3">
                            <span class="step">3</span>
                            <span class="title">Vérification</span>
                        </li>

                        <li data-step="4">
                            <span class="step">4</span>
                            <span class="title">Validation</span>
                        </li>
                    </ul>
                </div>

                <hr />

                <div class="step-content pos-rel">
                    <div class="step-pane active" data-step="1">
                        <h4 class="lighter block green">Déterminer le mode du transfert</h4>
                        <table style="width: 80%; margin: 3% 10%; font-size: 16px;">
                            <thead>
                                <tr style="background: repeat-x #F2F2F2;background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                                    <th colspan="4" style="text-align: center;">Mode du Transfert</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type='radio' option_data='1' name='transfert' checked="true" />  <b> Un seul compte </b>
                                    </td>
                                    <td>
                                        <input type='radio' option_data='2' name='transfert' />  <b> Plusieurs comptes </b>
                                    </td>
                                    <td>
                                        <input type='radio' option_data='3' name='transfert' />  <b> Classe comptable </b>
                                    </td>
                                    <td>
                                        <input type='radio' option_data='4' name='transfert' />  <b> Base standard </b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="step-pane" data-step="2">
                        <div id="zone_step_2">

                            <div id="zone_radio_1">
                                <h4 class="lighter block green">Mode du transfert : Un seul compte</h4>
                                <table style="width: 80%; margin: 3% 10%;">
                                    <tr>
                                        <td>
                                            <div class="mws-form-inline">
                                                <div class="mws-form-row">
                                                    <label class="mws-form-label">Compte comptable :</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="mws-form-inline">
                                                <div class="mws-form-row">
                                                    <input type="hidden" id="id_compte_select_for_plan_comptable">
                                                    <input ng-model="compte_select_for_plan.text" id="compte_select_for_plan" value="" type="text" style="width: 100%;" onfocus="this.select();" ng-change="Choisircomptecomptable('#compte_select_for_plan', '#id_compte_select_for_plan_comptable')"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div id="zone_radio_2">
                                <h4 class="lighter block green">Mode du transfert : Plusieurs comptes</h4>
                                <table style="width: 80%; margin: 3% 10%;">
                                    <tr>
                                        <td colspan="2">
                                            <div class="mws-form-inline">
                                                <div class="mws-form-row">
                                                    <label class="mws-form-label">Compte comptable :</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 90%; vertical-align: middle;">
                                            <div class="mws-form-inline">
                                                <div class="mws-form-row">
                                                    <input type="hidden" id="id_compte_select_search_for_plan_comptable">
                                                    <input ng-model="compte_select_for_plan.text" id="compte_select_search_for_plan" value="" type="text" style="width: 100%;" onfocus="this.select();" ng-change="Choisircomptecomptable('#compte_select_search_for_plan', '#id_compte_select_search_for_plan_comptable')"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-white btn-info btn-sm" type="button" onclick="ajouterLigne()">
                                                <i class="ace-icon fa fa-arrow-down icon-on-right bigger-110"></i>
                                                Ajouter
                                            </button>
                                        </td>
                                    </tr>
                                </table>

                                <div class="row">
                                    <div class="col-md-offset-1 col-md-10" style="position: unset;">
                                        <div class="clearfix">
                                            <div class="pull-right tableTools-container"></div>
                                        </div>
                                        <div class="table-header">
                                            Liste des comptes à transferer
                                        </div>
                                        <div>
                                            <table id="selected_compte" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr style="background: repeat-x #F2F2F2;background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                                                        <th style="width: 20%; display: none;">id</th>
                                                        <th style="width: 60%;">Compte comptable</th>
                                                        <th style="width: 20%; text-align: center;">Opération</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td style ="padding: 0px;" colspan ="3">
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

                            <div id="zone_radio_3">
                                <h4 class="lighter block green">Mode du transfert : Classe comptable</h4>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-8" style="position: unset;">
                                        <label class="mws-form-label">Classe comptable :</label>
                                        <div class="mws-form-item">
                                            <select id="class_comptable">
                                                <option value="0">Choisissez une classe comptable</option>
                                                <?php foreach ($classe_compte as $cc): ?>
                                                    <option value="<?php echo $cc->getId(); ?>"><?php echo $cc->getLibelle(); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="zone_radio_4">
                                <h4 class="lighter block green">Mode du transfert : Plusieurs comptes</h4>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-8" style="position: unset;">
                                        <label style="font-size: 18px; font-weight: bold;">Base standard :</label>
                                        <div class="mws-form-item">
                                            <ul>
                                                <?php foreach ($classe_compte as $cc): ?>
                                                    <li style="line-height: 30px;"><b>Classe :</b> <?php echo $cc->getLibelle(); ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="step-pane" data-step="3">
                        <div id="zone_radio_2_1">
                            <h4 class="lighter block green">Mode du transfert : Un seul compte</h4>
                            <div class="row">
                                <div class="col-md-offset-2 col-md-8" style="position: unset;">
                                    <label style="font-size: 18px; font-weight: bold;">Hiérarchie du classe comptable :</label>
                                    <div class="mws-form-item" id="hierarchie_compte">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="zone_radio_2_2">
                            <h4 class="lighter block green">Mode du transfert : Plusieurs comptes</h4>
                            <div class="row">
                                <div class="col-md-offset-1 col-md-10" style="position: unset;">
                                    <div class="clearfix">
                                        <div class="pull-right tableTools-container"></div>
                                    </div>
                                    <div class="table-header">
                                        Vérification : Liste des comptes à transferer
                                    </div>
                                    <div>
                                        <table id="final_selected_compte" class="table table-bordered table-hover">
                                            <thead>
                                                <tr style="background: repeat-x #F2F2F2;background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                                                    <th style="width: 20%; display: none;">id</th>
                                                    <th style="width: 100%;">Compte comptable</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td style ="padding: 0px;" colspan ="2">
                                                        <div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">
                                                            <div class ="col-xs-12"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>

                                        <h5 class="lighter block blue" style="line-height: 25px;">
                                            <b>Remarque :</b> Il se peut que toute la hiérarchie de chaque <b>compte comptable</b> sera transferée.
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="zone_radio_2_3">
                            <h4 class="lighter block green">Mode du transfert : Classe comptable</h4>
                            <div class="row">
                                <div class="col-md-offset-2 col-md-8" style="position: unset;">
                                    <label style="font-size: 18px; font-weight: bold;">Classe comptable :</label>
                                    <div class="mws-form-item">
                                        <ul id="ul_classe">
                                            <?php foreach ($classe_compte as $cc): ?>
                                                <li value="<?php echo $cc->getId(); ?>" style="line-height: 30px;"><b>Classe :</b> <?php echo $cc->getLibelle(); ?> => <b style="color: #0066cc;"><?php echo $cc->getPlancomptable()->count(); ?></b> (Comptes comptables)</li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="zone_radio_2_4">
                            <h4 class="lighter block green">Mode du transfert : Base standard</h4>
                            <div class="row">
                                <div class="col-md-offset-2 col-md-8" style="position: unset;">
                                    <label style="font-size: 18px; font-weight: bold;">Base standard :</label>
                                    <div class="mws-form-item">
                                        <ul>
                                            <?php foreach ($classe_compte as $cc): ?>
                                                <li style="line-height: 30px;"><b>Classe :</b> <?php echo $cc->getLibelle(); ?> => <b style="color: #0066cc;"><?php echo $cc->getPlancomptable()->count(); ?></b> (Comptes comptables)</li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="step-pane" data-step="4">
                        <div id="progressbar"></div>
                        <div class="center" id="final_success" style="display: none;">
                            <h3 class="green">Transfert Terminé !</h3>
                            Compte(s) comptable(s) transféré(s) vers <b>plan comptable</b> avec succès.
                        </div>
                    </div>
                </div>
            </div>

            <hr />
            <div class="wizard-actions">
                <button class="btn btn-prev">
                    <i class="ace-icon fa fa-arrow-left"></i>
                    Précédant
                </button>

                <button class="btn btn-success btn-next" data-last="Finish">
                    Suivant
                    <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                </button>
            </div>
        </div><!-- /.widget-main -->
    </div><!-- /.widget-body -->
</div>

<script  type="text/javascript">

    function choisirTransfert() {
        $('input[type=radio][name=transfert]').each(function () {
            if ($(this).is(':checked')) {
                if ($(this).attr('option_data') == '1') {
                    $("#zone_radio_2").fadeOut();
                    $("#zone_radio_3").fadeOut();
                    $("#zone_radio_4").fadeOut();
                    $("#zone_radio_1").fadeIn();
                }
                if ($(this).attr('option_data') == '2') {
                    $("#zone_radio_1").fadeOut();
                    $("#zone_radio_3").fadeOut();
                    $("#zone_radio_4").fadeOut();
                    $("#zone_radio_2").fadeIn();
                }
                if ($(this).attr('option_data') == '3') {
                    $("#zone_radio_1").fadeOut();
                    $("#zone_radio_2").fadeOut();
                    $("#zone_radio_4").fadeOut();
                    $("#zone_radio_3").fadeIn();

                    $('.chosen-container').attr("style", "width: 100%;");
                    $('.chosen-container').trigger("chosen:updated");
                    $('#class_comptable').trigger("chosen:updated");
                }
                if ($(this).attr('option_data') == '4') {
                    $("#zone_radio_1").fadeOut();
                    $("#zone_radio_2").fadeOut();
                    $("#zone_radio_3").fadeOut();
                    $("#zone_radio_4").fadeIn();
                }
            }
        });
    }

    function verifierTransfert() {
        $('input[type=radio][name=transfert]').each(function () {
            if ($(this).is(':checked')) {
                if ($(this).attr('option_data') == '1') {
                    if ($('#id_compte_select_for_plan_comptable').val() != '') {
                        $('#compte_select_for_plan').css('border', '1px solid #aaa');

                        //Charger l'hiérarchie du compte comptable
                        $.ajax({
                            url: '<?php echo url_for('transfert/getHierarchie') ?>',
                            data: 'id=' + $('#id_compte_select_for_plan_comptable').val(),
                            success: function (data) {
                                $('#hierarchie_compte').html(data);

                                $("#zone_radio_2_2").fadeOut();
                                $("#zone_radio_2_3").fadeOut();
                                $("#zone_radio_2_4").fadeOut();
                                $("#zone_radio_2_1").fadeIn();
                            }
                        });
                    } else {
                        $('#compte_select_for_plan').css('border', '1px solid');
                        $('#compte_select_for_plan').css('border-color', '#E17272');
                        e.preventDefault();
                    }
                }
                if ($(this).attr('option_data') == '2') {
                    if ($('#selected_compte > tbody tr').length != 0) {
                        var data = $('#selected_compte > tbody').html();
                        $('#final_selected_compte > tbody').html(data);

                        $('#final_selected_compte > tbody > tr > td[name=button]').each(function () {
                            $(this).remove();
                        });

                        $("#zone_radio_2_1").fadeOut();
                        $("#zone_radio_2_3").fadeOut();
                        $("#zone_radio_2_4").fadeOut();
                        $("#zone_radio_2_2").fadeIn();
                    } else {
                        bootbox.dialog({
                            message: "Veuillez ajouter les comptes comptables à transferer !",
                            buttons: {
                                "success": {
                                    "label": "OK",
                                    "className": "btn-sm btn-primary"
                                }
                            }
                        });
                        e.preventDefault();
                    }
                }
                if ($(this).attr('option_data') == '3') {
                    if ($("#class_comptable").val() != '0') {
                        $('#class_comptable_chosen').css('border', '1px solid #aaa');

                        var id = $("#class_comptable").val();

                        $('#ul_classe > li').each(function () {
                            if ($(this).val() == id)
                                $(this).show();
                            else
                                $(this).hide();
                        });

                        $("#zone_radio_2_1").fadeOut();
                        $("#zone_radio_2_2").fadeOut();
                        $("#zone_radio_2_4").fadeOut();
                        $("#zone_radio_2_3").fadeIn();
                    } else {
                        $('#class_comptable_chosen').css('border', '1px solid');
                        $('#class_comptable_chosen').css('border-color', '#E17272');
                        e.preventDefault();
                    }
                }
                if ($(this).attr('option_data') == '4') {
                    $("#zone_radio_2_1").fadeOut();
                    $("#zone_radio_2_2").fadeOut();
                    $("#zone_radio_2_3").fadeOut();
                    $("#zone_radio_2_4").fadeIn();
                }
            }
        });
    }

    function validerTransfert() {
        $('input[type=radio][name=transfert]').each(function () {
            if ($(this).is(':checked')) {
                if ($(this).attr('option_data') == '1') {
                    //progressbar
                    $("#progressbar").progressbar({
                        value: 10,
                        create: function (event, ui) {
                            $(this).addClass('progress progress-striped active').children(0).addClass('progress-bar progress-bar-success');
                        }
                    });

                    //Transfert d'un compte comptable et toute sa hiérarchie
                    $.ajax({
                        url: '<?php echo url_for('transfert/oneCompteComptable') ?>',
                        data: 'id=' + $("#id_compte_select_for_plan_comptable").val(),
                        success: function (data) {
                            $("#progressbar").progressbar({
                                value: 66,
                                create: function (event, ui) {
                                    $(this).addClass('progress progress-striped active').children(0).addClass('progress-bar progress-bar-success');
                                }
                            });

                            $('#progressbar').fadeOut();
                            $('#final_success').fadeIn();
                        }
                    });
                }

                if ($(this).attr('option_data') == '2') {
                    //progressbar
                    $("#progressbar").progressbar({
                        value: 10,
                        create: function (event, ui) {
                            $(this).addClass('progress progress-striped active').children(0).addClass('progress-bar progress-bar-success');
                        }
                    });

                    var ids = '';
                    $('#final_selected_compte input[data_id=true]').each(function () {
                        ids = ids + $(this).val() + ',,';
                    });
                    
                    //Transfert d'un ou plusieur comptes comptables et toute leurs hiérarchies
                    $.ajax({
                        url: '<?php echo url_for('transfert/listCompteComptable') ?>',
                        data: 'ids=' + ids,
                        success: function (data) {
                            $("#progressbar").progressbar({
                                value: 66,
                                create: function (event, ui) {
                                    $(this).addClass('progress progress-striped active').children(0).addClass('progress-bar progress-bar-success');
                                }
                            });

                            $('#progressbar').fadeOut();
                            $('#final_success').fadeIn();
                        }
                    });
                }

                if ($(this).attr('option_data') == '3') {
                    //progressbar
                    $("#progressbar").progressbar({
                        value: 10,
                        create: function (event, ui) {
                            $(this).addClass('progress progress-striped active').children(0).addClass('progress-bar progress-bar-success');
                        }
                    });

                    //Transfert de toute la classe comptable
                    $.ajax({
                        url: '<?php echo url_for('transfert/allClassComptable') ?>',
                        data: 'id=' + $("#class_comptable").val(),
                        success: function (data) {
                            $("#progressbar").progressbar({
                                value: 66,
                                create: function (event, ui) {
                                    $(this).addClass('progress progress-striped active').children(0).addClass('progress-bar progress-bar-success');
                                }
                            });

                            $('#progressbar').fadeOut();
                            $('#final_success').fadeIn();
                        }
                    });
                }

                if ($(this).attr('option_data') == '4') {
                    //progressbar
                    $("#progressbar").progressbar({
                        value: 10,
                        create: function (event, ui) {
                            $(this).addClass('progress progress-striped active').children(0).addClass('progress-bar progress-bar-success');
                        }
                    });
                   
                    //Transfert de toute la base standard
                    $.ajax({
                        url: '<?php echo url_for('transfert/allBaseStandard') ?>',
                        data: '',
                        success: function (data) {
                            $("#progressbar").progressbar({
                                value: 66,
                                create: function (event, ui) {
                                    $(this).addClass('progress progress-striped active').children(0).addClass('progress-bar progress-bar-success');
                                }
                            });
       
                            $('#progressbar').fadeOut();
                            $('#final_success').fadeIn();
                        }
                    });
                }
            }
        });
    }

</script>

<script  type="text/javascript">

    function ajouterLigne() {
        if ($('#id_compte_select_search_for_plan_comptable').val() != '') {
            $('#compte_select_search_for_plan').css('border', '');
            var ligne_compte = '<tr id="tr_' + $('#id_compte_select_search_for_plan_comptable').val() + '"><td style="display: none;"><input type="text" data_id="true" value="' + $('#id_compte_select_search_for_plan_comptable').val() + '"></td><td>' + $('#compte_select_search_for_plan').val() + '</td><td name="button" style="text-align: center;"><button class="btn btn-white btn-danger btn-sm" type="button" onclick="supprimerLigne(' + $('#id_compte_select_search_for_plan_comptable').val() + ')">Supprimer</button></td></tr>';
            $('#selected_compte tbody').append(ligne_compte);

            $('#id_compte_select_search_for_plan_comptable').val('');
            $('#compte_select_search_for_plan').val('');
        } else {
            $('#compte_select_search_for_plan').css('border-color', '#f2a696');
        }
    }

    function supprimerLigne(id) {
        $("#tr_" + id).remove();
    }

</script>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : Transfert des comptes comptables");
</script>