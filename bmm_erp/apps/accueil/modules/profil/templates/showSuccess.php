<div id="sf_admin_container">
    <h1 id="replacediv"> B.M.M Accès 
        <small><i class="ace-icon fa fa-angle-double-right"></i> Profil</small>
    </h1>
</div>

<div class="row">
    <div class="col-sm-12">
        <legend>Profil : <?php echo $profil; ?></legend>
        <div class="tabbable tabs-left">
            <ul class="nav nav-tabs" id="myTab3">
                <?php $active = "active" ?>
                <?php foreach ($applications as $application): ?>
                    <li class="<?php echo $active; ?>">
                        <a data-toggle="tab" title="<?php echo $application->getApplication()->getLibelle(); ?>" href="#home_<?php echo $application->getApplication()->getId(); ?>">
                            <i class="pink ace-icon fa fa-cog bigger-110"></i> 
                            <?php
                            if (strlen($application->getApplication()->getLibelle()) > 23):
                                echo substr($application->getApplication()->getLibelle(), 0, 20) . '...';
                            else:
                                echo $application->getApplication()->getLibelle();
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
                    <div name="tab_application" app_id="<?php echo $application->getApplication()->getId(); ?>" id="home_<?php echo $application->getApplication()->getId(); ?>" class="tab-pane <?php echo $active; ?>">
                        <legend style="font-size: 18px; font-weight: bold;"><?php echo $application->getApplication(); ?></legend>
                        <div class="mws-form-item">
                            <table class="table table-bordered table-hover" style="margin-bottom: 0px;">
                                <thead>
                                    <tr style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                                        <th rowspan="2" style="font-weight: bold; text-align: center; width: 4%; vertical-align: bottom;"><i class="ace-icon fa fa-check-square-o bigger-125"></i></th>
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
                                    <?php foreach ($application->getApplication()->getApplicationmodule() as $module): ?>
                                        <tr>
                                            <td id="check_<?php echo $module->getId(); ?>" style="text-align: center"><i class="ace-icon fa fa-square-o bigger-125"></i></td>
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
                                        var input_html = '<i class="ace-icon fa fa-square-o bigger-125"></i>';
        <?php foreach ($module->getApplicationmoduleaction() as $actions): ?>
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
<hr>
<?php
$user = new Utilisateur();
$user =  $sf_user->getAttribute('userB2m');

$modif = true;
?>

<div class="col-sm-6">
    <?php foreach ($profil->getUtilisateur() as $utilisateur): ?>
        <?php if (!$user->getIdParent() || $utilisateur->getIdParent()): ?>
            <div class="grid2 center" id="profil_user_<?php echo $utilisateur->getId(); ?>">
                <i class="ace-icon fa fa-user bigger-140 pull-left" style="margin-top: 0px; border-right: solid 2px #e7b979; padding-right: 3px;"></i>
                <span>
                    <?php
                    if ($utilisateur->getIdParent())
                        echo $utilisateur;
                    else
                        echo 'Login : ' . $utilisateur->getLogin();
                    ?>
                </span>
                <i onclick="deleteAffectation('<?php echo $utilisateur->getId(); ?>')" class="ace-icon fa fa-trash-o bigger-140 pull-right" style="margin-top: 0px; cursor: pointer; border-left: solid 1px #e7b979; padding-left: 3px;"></i>
            </div>
        <?php else: ?>
            <?php $modif = false; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<div class="col-sm-6" style="text-align: right;">
    <a target="_blank" href="<?php echo url_for('profil/imprimer?id=' . $profil->getId()) ?>" class="btn btn-white btn-purple"><i class="ace-icon fa fa-print"></i> Imprimer</a> 
    <?php if ($modif): ?>
        <a href="<?php echo url_for('profil/editModule?id=' . $profil->getId()) ?>" class="btn btn-white btn-primary"><i class="ace-icon fa fa-external-link-square"></i> Affecter Module</a>
    <?php endif; ?>
    <a href="<?php echo url_for('@profil') ?>" class="btn btn-white btn-success"><i class="ace-icon fa fa-undo"></i> Retour à la liste</a>
</div>

<script  type="text/javascript">
    var input_html = '<i class="ace-icon fa fa-check-square-o bigger-125"></i>';
<?php foreach ($profil->getProfilapplication() as $profil_application): ?>
    <?php foreach ($profil_application->getProfilmodule() as $profil_module): ?>
            $("#check_<?php echo $profil_module->getIdApplicationmodule() ?>").html(input_html);
        <?php foreach ($profil_module->getProfilmoduleaction() as $profil_action): ?>
                $("#td_<?php echo $profil_action->getLibelle(); ?>_<?php echo $profil_module->getIdApplicationmodule(); ?>").html(input_html);
        <?php endforeach; ?>
    <?php endforeach; ?>
<?php endforeach; ?>
</script>

<script  type="text/javascript">

    function deleteAffectation(id) {
        bootbox.confirm({
            message: "Voulez-vous supprimer l'affectation du profil <?php echo $profil; ?>, pour cet utilisateur ?",
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
                    goDeleteAffectation(id);
                }
            }
        });
    }

    function goDeleteAffectation(id) {
        $.ajax({
            url: '<?php echo url_for('profil/deleteAffectation') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#profil_user_' + id).remove();
            }
        });
    }

</script>

<style>

    .tab-content{border: 1px solid #C5D0DC !important; min-height: 400px;}
    .grid2{
        border: 5px solid #FFF;
        border-left: 5px solid #FFF !important;
        border-width: 1px;
        border-left-width: 1px !important;
        border-color: #e7b979;
        border-left-color: #e7b979 !important;
        color: #daa458 !important;
        min-height: 30px;
        padding: 5px;
    }

</style>