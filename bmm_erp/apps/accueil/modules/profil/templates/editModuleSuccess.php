<div id="sf_admin_container">
    <h1 id="replacediv"> B.M.M Accès 
        <small><i class="ace-icon fa fa-angle-double-right"></i> Profil</small>
    </h1>
</div>

<div class="widget-box">
    <div class="widget-header widget-header-blue widget-header-flat">
        <h4 class="widget-title lighter">Affectation des droits d'accès</h4>
    </div>
    <?php $profil = ProfilTable::getInstance()->find($id); ?>
    <div class="widget-body">
        <div class="widget-main">
            <div id="profil-fuelux-wizard-container">
                <div>
                    <ul class="steps">
                        <li data-step="1" class="active">
                            <span class="step">1</span>
                            <span class="title">Profil</span>
                        </li>

                        <li data-step="2">
                            <span class="step">2</span>
                            <span class="title">Choix des Modules</span>
                        </li>

                        <li data-step="3">
                            <span class="step">3</span>
                            <span class="title">Chois des Sous Modules</span>
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
                        <h4 class="lighter block green">Profil : <?php echo $profil->getLibelle(); ?></h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div style="width: 100%; margin-top: 2%;">
                                    <legend style="font-size: 16px;">Modules Affectés : (Secrétariats)</legend>
                                </div>
                                <table style="width: 100%; margin-top: 1%; margin-bottom: 0px;">
                                    <thead>
                                        <tr style="color: #707070; font-weight: 400; background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom, #F8F8F8 0,#ECECEC 100%);">
                                            <td style="width: 7%; text-align: center; font-weight: bold;">#</td>
                                            <td style="width: 70%; font-weight: bold;">Modules</td>
                                            <td style="width: 23%; text-align: center; font-weight: bold;">Sous Modules</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($profil->getProfilapplication() as $application): ?>
                                            <?php if (strpos($application->getApplication()->getLibelle(), 'Secrétariat') !== false): ?>
                                                <tr>
                                                    <td style="text-align: center;"><?php echo $i; ?></td>
                                                    <td><?php echo $application->getApplication()->getLibelle() ?></td>
                                                    <td style="text-align: center;"><?php echo $application->getProfilmodule()->count(); ?> sous modules</td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <div style="width: 100%; margin-top: 2%;">
                                    <legend style="font-size: 16px;">Modules Affectés :</legend>
                                </div>
                                <table style="width: 100%; margin-top: 1%; margin-bottom: 0px;">
                                    <thead>
                                        <tr style="color: #707070; font-weight: 400; background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom, #F8F8F8 0,#ECECEC 100%);">
                                            <td style="width: 7%; text-align: center; font-weight: bold;">#</td>
                                            <td style="width: 70%; font-weight: bold;">Modules</td>
                                            <td style="width: 23%; text-align: center; font-weight: bold;">Sous Modules</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($profil->getProfilapplication() as $application): ?>
                                            <?php if (strpos($application->getApplication()->getLibelle(), 'Secrétariat') === false): ?>
                                                <tr>
                                                    <td style="text-align: center;"><?php echo $i; ?></td>
                                                    <td><?php echo $application->getApplication()->getLibelle() ?></td>
                                                    <td style="text-align: center;"><?php echo $application->getProfilmodule()->count(); ?> sous modules</td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="step-pane" data-step="2">
                        <div id="zone_step_2">
                            <h4 class="lighter block green">Profil : <?php echo $profil->getLibelle(); ?></h4>
                            <h4 class="lighter block blue">Choix des Modules à affecter :</h4>
                            <div class="row">
                                <div class="col-md-12" style="position: unset;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div style="width: 100%; margin-top: 2%;">
                                                <legend style="font-size: 16px;">Modules (Secrétariats) :</legend>
                                            </div>
                                            <table id="secretaire_application" style="width: 100%; margin-top: 1%; margin-bottom: 0px;">
                                                <thead>
                                                    <tr style="color: #707070; font-weight: 400; background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom, #F8F8F8 0,#ECECEC 100%);">
                                                        <td style="width: 5%; text-align: center; font-weight: bold;">#</td>
                                                        <td style="width: 5%; text-align: center; font-weight: bold;"><input onclick="checkAllSecretaireApp()" id="secretaire_app_all" type="checkbox"></td>
                                                        <td style="width: 68%; font-weight: bold;">Module</td>
                                                        <td style="width: 22%; text-align: center; font-weight: bold;">Sous Modules</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    <?php $applications = ApplicationTable::getInstance()->getAll(); ?>
                                                    <?php foreach ($applications as $application): ?>
                                                        <?php if (strpos($application->getLibelle(), 'Secrétariat') !== false): ?>
                                                            <tr id="tr_check_<?php echo $application->getId() ?>">
                                                                <td style="text-align: center;"><?php echo $i; ?></td>
                                                                <td style="text-align: center;"><input name="app_check" value="<?php echo $application->getId() ?>" onclick="setColor('<?php echo $application->getId() ?>')" id="app_<?php echo $application->getId() ?>" type="checkbox"></td>
                                                                <td><?php echo $application->getLibelle() ?></td>
                                                                <td style="text-align: center;"><?php echo $application->getApplicationmodule()->count(); ?> sous modules</td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <div style="width: 100%; margin-top: 2%;">
                                                <legend style="font-size: 16px;">Modules :</legend>
                                            </div>
                                            <table id="other_application" style="width: 100%; margin-top: 1%; margin-bottom: 0px;">
                                                <thead>
                                                    <tr style="color: #707070; font-weight: 400; background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom, #F8F8F8 0,#ECECEC 100%);">
                                                        <td style="width: 5%; text-align: center; font-weight: bold;">#</td>
                                                        <td style="width: 5%; text-align: center; font-weight: bold;"><input onclick="checkAllOtherApp()" id="other_app_all" type="checkbox"></td>
                                                        <td style="width: 65%; font-weight: bold;">Module</td>
                                                        <td style="width: 25%; text-align: center; font-weight: bold;">Sous Modules</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($applications as $application): ?>
                                                        <?php if (strpos($application->getLibelle(), 'Secrétariat') === false): ?>
                                                            <tr id="tr_check_<?php echo $application->getId() ?>">
                                                                <td style="text-align: center;"><?php echo $i; ?></td>
                                                                <td style="text-align: center;"><input name="app_check" value="<?php echo $application->getId() ?>" onclick="setColor('<?php echo $application->getId() ?>')" id="app_<?php echo $application->getId() ?>" type="checkbox"></td>
                                                                <td><?php echo $application->getLibelle() ?></td>
                                                                <td style="text-align: center;"><?php echo $application->getApplicationmodule()->count(); ?> sous modules</td>
                                                            </tr>
                                                            <?php $i++; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="step-pane" data-step="3">
                        <div id="zone_radio_2_1">
                            <h4 class="lighter block green">Profil : <?php echo $profil->getLibelle(); ?></h4>
                            <h4 class="lighter block blue">Choix des Sous Modules :</h4>
                            <div class="row">
                                <div class="col-md-12" style="position: unset;" id="list_sous_module">

                                </div>
                            </div>
                        </div>
                        <i id="loading_icon_module" style="display: none; font-size: 300% !important; margin-left: 49%;" class="ace-icon fa fa-spinner fa-spin orange bigger-190"></i>
                    </div>

                    <div class="step-pane" data-step="4">
                        <div class="center" id="final_success" style="display: none; font-size: 16px;">
                            <h3 class="green">Profil Paramétré !</h3>
                            Paramétrage des droits d'accès terminés avec succès !
                            <br><br>
                            <a href="<?php echo url_for('@profil') ?>" class="btn btn-white btn-primary"><i class="ace-icon fa fa-undo"></i> Retour à la liste</a>
                        </div>
                        <br>
                        <i id="loading_icon" style="display: none; font-size: 300% !important; margin-left: 49%;" class="ace-icon fa fa-spinner fa-spin orange bigger-190"></i>
                    </div>
                </div>
            </div>

            <hr style="margin-top: 10px; margin-bottom: 10px;" />
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

<?php foreach ($profil->getProfilapplication() as $profil_application): ?>
        $("#app_<?php echo $profil_application->getIdApplication() ?>").prop("checked", "true");
        $("#tr_check_<?php echo $profil_application->getIdApplication() ?>").attr("style", "background-color:#d7f9d1;");
<?php endforeach; ?>

    function choisirApplication() {

    }

    function setColor(id) {
        if ($("#app_" + id).is(':checked')) {
            $("#app_" + id).parent().parent().attr("style", "background-color:#d7f9d1;");
        } else {
            $("#app_" + id).parent().parent().attr("style", "");
        }
    }

    function checkAllSecretaireApp() {
        if ($("#secretaire_app_all").is(':checked')) {
            $('#secretaire_application input[name="app_check"]').each(function () {
                $(this).prop("checked", "true");
                $(this).parent().parent().attr("style", "background-color:#d7f9d1;");
            });
        } else {
            $('#secretaire_application input[name="app_check"]').each(function () {
                $(this).removeAttr("checked");
                $(this).parent().parent().attr("style", "");
            });
        }
    }

    function checkAllOtherApp() {
        if ($("#other_app_all").is(':checked')) {
            $('#other_application input[name="app_check"]').each(function () {
                $(this).prop("checked", "true");
                $(this).parent().parent().attr("style", "background-color:#d7f9d1;");
            });
        } else {
            $('#other_application input[name="app_check"]').each(function () {
                $(this).removeAttr("checked");
                $(this).parent().parent().attr("style", "");
            });
        }
    }

    function choisirModule() {
        var ids = '';
        $('[name="app_check"]').each(function () {
            if ($(this).is(':checked'))
                ids = ids + $(this).val() + ',';
        });
        if (ids == '') {
            bootbox.dialog({
                message: "Veuillez choisir au moins un module !",
                buttons:
                        {
                            "button":
                                    {
                                        "label": "Ok",
                                        "className": "btn-sm"
                                    }
                        }
            });
            e.preventDefault();
        } else {
            $('#list_sous_module').html('');
            $('#loading_icon_module').show();
            $.ajax({
                url: '<?php echo url_for('profil/getModule') ?>',
                data: 'id=' + '<?php echo $profil->getId(); ?>' + '&ids=' + ids,
                success: function (data) {
                    $('#loading_icon_module').hide();
                    $('#list_sous_module').html(data);
                }
            });
        }
    }

    var total_application_save = 0;
    function validerAffectation() {
        $('#loading_icon').show();
        var app_ids = '';
        $('[name="app_check"]').each(function () {
            if ($(this).is(':checked')) {
                app_ids = app_ids + $(this).val() + ',';
                total_application_save++;
            }
        });

//        var module_ids = '';
//        var action_ids = '';
//        var id_app = '';
//        $('[name="tab_application"]').each(function () {
//            id_app = $(this).attr("app_id");
//            $('#home_' + id_app + ' [name="module_application"]').each(function () {
//                if ($(this).is(':checked')) {
//                    module_ids = module_ids + $(this).val() + ',';
//                    $('[name="m_' + $(this).val() + '"]').each(function () {
//                        if ($(this).is(':checked')) {
//                            action_ids = action_ids + $(this).val() + ',';
//                        }
//                    });
//                    action_ids = action_ids + ';';
//                }
//            });
//            action_ids = action_ids + '.';
//            module_ids = module_ids + ';';
//        });

        $.ajax({
            url: '<?php echo url_for('profil/saveProfil') ?>',
            data: 'id=' + '<?php echo $profil->getId(); ?>' +
                    '&app_ids=' + app_ids,
//                    '&module_ids=' + module_ids +
//                    '&action_ids=' + action_ids,
            success: function (data) {
                $('[name="app_check"]').each(function () {
                    if ($(this).is(':checked'))
                        validerAffectationModuleAction($(this).val());
                });
//                $('#final_success').show();
//                $('#loading_icon').hide();
            }
        });
    }

    function validerAffectationModuleAction(id_app) {
        var module_ids = '';
        var action_ids = '';

        $('#home_' + id_app + ' [name="module_application"]').each(function () {
            if ($(this).is(':checked')) {
                module_ids = module_ids + $(this).val() + ',';
                $('[name="m_' + $(this).val() + '"]').each(function () {
                    if ($(this).is(':checked')) {
                        action_ids = action_ids + $(this).val() + ',';
                    }
                });
                action_ids = action_ids + ';';
            }
        });

        $.ajax({
            url: '<?php echo url_for('profil/saveProfilModuleAction') ?>',
            data: 'id=' + '<?php echo $profil->getId(); ?>' +
                    '&app_id=' + id_app +
                    '&module_ids=' + module_ids +
                    '&action_ids=' + action_ids,
            success: function (data) {
                total_application_save--;
                if (total_application_save == 0) {
                    $('#final_success').show();
                    $('#loading_icon').hide();
                }
            }
        });
    }

</script>