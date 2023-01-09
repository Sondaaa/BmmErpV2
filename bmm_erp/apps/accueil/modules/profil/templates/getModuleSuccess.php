<div class="row">
    <div class="col-sm-12">
        <div class="tabbable tabs-left">
            <ul class="nav nav-tabs" id="myTab3">
                <?php $active = "active" ?>
                <?php foreach ($applications as $application): ?>
                    <li class="<?php echo $active; ?>">
                        <a data-toggle="tab" title="<?php echo $application->getLibelle(); ?>" href="#home_<?php echo $application->getId(); ?>">
                            <i class="pink ace-icon fa fa-cog bigger-110"></i> 
                            <?php
                            if (strlen($application->getLibelle()) > 23):
                                echo substr($application->getLibelle(), 0, 20) . '...';
                            else:
                                echo $application->getLibelle();
                            endif;
                            ?>
                        </a>
                    </li>
                    <?php if ($active == "active") $active = ""; ?>
                <?php endforeach; ?>
            </ul>

            <div class="tab-content">
                <?php $active = "in active" ?>
                <?php foreach ($applications as $application): ?>
                    <div name="tab_application" app_id="<?php echo $application->getId(); ?>" id="home_<?php echo $application->getId(); ?>" class="tab-pane <?php echo $active; ?>">
                        <legend style="font-size: 18px; font-weight: bold;"><?php echo $application; ?></legend>
                        <div class="mws-form-item">
                            <table class="table table-bordered table-hover" style="margin-bottom: 0px;">
                                <thead>
                                    <tr style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                                        <th rowspan="2" style="font-weight: bold; text-align: center; width: 4%; vertical-align: bottom;"><input id="application_tab_<?php echo $application->getId(); ?>" type="checkbox" onclick="checkAllModule('<?php echo $application->getId(); ?>')"></th>
                                        <th rowspan="2" style="font-weight: bold; width: 32%; vertical-align: bottom;">Sous Module</th>
                                        <th colspan="8" style="font-weight: bold; text-align: center;">Droit d'accès</th>
                                    </tr>   
                                    <tr style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                                        <th style="font-weight: bold; text-align: center; width: 8%;">Création</th>
                                        <th style="font-weight: bold; text-align: center; width: 8%;">Consultation</th>
                                        <th style="font-weight: bold; text-align: center; width: 8%;">Modification</th>
                                        <th style="font-weight: bold; text-align: center; width: 8%;">Suppression</th>
                                        <th style="font-weight: bold; text-align: center; width: 8%;">Validation</th>
                                        <th style="font-weight: bold; text-align: center; width: 8%;">Blocage</th>
                                        <th style="font-weight: bold; text-align: center; width: 8%;">Annulation</th>
                                        <th style="font-weight: bold; text-align: center; width: 8%;">Impression</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($application->getApplicationmodule() as $module): ?>
                                        <tr>
                                            <td style="text-align: center"><input name="module_application" value="<?php echo $module->getId(); ?>" id="check_<?php echo $module->getId(); ?>" type="checkbox" onclick="checkModule('<?php echo $module->getId(); ?>')"></td>
                                            <td><?php echo $module->getLibelle(); ?></td>
                                            <td id="td_Création_<?php echo $module->getId(); ?>" style="text-align: center"></td>
                                            <td id="td_Consultation_<?php echo $module->getId(); ?>" style="text-align: center"></td>
                                            <td id="td_Modification_<?php echo $module->getId(); ?>" style="text-align: center"></td>
                                            <td id="td_Suppression_<?php echo $module->getId(); ?>" style="text-align: center"></td>
                                            <td id="td_Validation_<?php echo $module->getId(); ?>" style="text-align: center"></td>
                                            <td id="td_Blocage_<?php echo $module->getId(); ?>" style="text-align: center"></td>
                                            <td id="td_Annulationn_<?php echo $module->getId(); ?>" style="text-align: center"></td>
                                            <td id="td_Impression_<?php echo $module->getId(); ?>" style="text-align: center"></td>
                                        </tr>
                                    <script  type="text/javascript">
                                        var input_html = '';
        <?php foreach ($module->getApplicationmoduleaction() as $actions): ?>
                                            input_html = '<input name="m_<?php echo $module->getId(); ?>" id="<?php echo $actions->getLibelle(); ?>_<?php echo $module->getId(); ?>" type="checkbox" class="disabledbutton" value="<?php echo $actions->getLibelle(); ?>">';
                                            $("#td_<?php echo $actions->getLibelle(); ?>_<?php echo $module->getId(); ?>").html(input_html);
        <?php endforeach; ?>
                                    </script>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php if ($active == "in active") $active = ""; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->

<script  type="text/javascript">

<?php foreach ($profil->getProfilapplication() as $profil_application): ?>
    <?php foreach ($profil_application->getProfilmodule() as $profil_module): ?>
            $("#check_<?php echo $profil_module->getIdApplicationmodule() ?>").prop("checked", "true");
            $('[name="m_' + <?php echo $profil_module->getIdApplicationmodule() ?> + '"]').each(function () {
                $(this).removeClass("disabledbutton");
            });
        <?php foreach ($profil_module->getProfilmoduleaction() as $profil_action): ?>
                $("#<?php echo $profil_action->getLibelle(); ?>_<?php echo $profil_module->getIdApplicationmodule(); ?>").prop("checked", "true");
        <?php endforeach; ?>
    <?php endforeach; ?>
<?php endforeach; ?>

</script>

<script  type="text/javascript">

    function checkAllModule(id) {
        if ($("#application_tab_" + id).is(':checked')) {
            $('#home_' + id + ' input[type="checkbox"]').each(function () {
                $(this).prop("checked", "true");
            });
        } else {
            $('#home_' + id + ' input[type="checkbox"]').each(function () {
                $(this).removeAttr("checked");
            });
        }
    }

    function checkModule(id) {
        if ($("#check_" + id).is(':checked')) {
            $('[name="m_' + id + '"]').each(function () {
                $(this).prop("checked", "true");
                $(this).removeClass("disabledbutton");
            });
        } else {
            $('[name="m_' + id + '"]').each(function () {
                $(this).removeAttr("checked");
                $(this).addClass("disabledbutton");
            });
        }
    }
    
</script>

<style>

    .tab-content{border: 1px solid #C5D0DC !important; min-height: 400px;}

</style>