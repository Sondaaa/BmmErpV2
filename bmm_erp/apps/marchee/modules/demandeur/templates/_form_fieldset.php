<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Fiche Demandeur</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main" style="min-height: 200px;">
                    <form>
                        <fieldset id="sf_fieldset_none">
                            <div class="col-lg-3">
                                <div>
                                    <label style="font-weight: bold; font-size: 16px;">Choisir parmis la liste des demandeurs</label>
                                    <div class="content">
                                        <select id="choix_demandeur" onchange="showZoneDemandeur()">
                                            <option value=""></option>
                                            <option value="zone_agent">Agent</option>
                                            <option value="zone_service">Service</option>
                                            <option value="zone_unite">Unité</option>
                                            <option value="zone_direction">Direction</option>
                                            <option value="zone_sous_direction">Sous Direction</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="form-group" id="zone_choix_demandeur">
                                <div class="col-sm-8" id="zone_agent" style="display: none;">
                                    <legend class="control-label no-padding-top"> Agents </legend>
                                    <?php $agents = AgentsTable::getInstance()->getAllOrderByNomComplet(); ?>
                                    <select multiple="multiple" size="10" name="demandeur[id_agent]" id="demandeur_id_agent">
                                        <?php foreach ($agents as $a): ?>
                                            <option <?php if ($a->getIdDemandeur() != null): ?>selected="true"<?php endif; ?> value="<?php echo $a->getId(); ?>"><?php echo $a->getNomcomplet(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="hr hr-16 hr-dotted"></div>
                                </div>

                                <div class="col-sm-8" id="zone_service" style="display: none;">
                                    <legend class="control-label no-padding-top"> Service </legend>
                                    <?php $services = ServicerhTable::getInstance()->getAllOrderByLibelle(); ?>
                                    <select multiple="multiple" size="10" name="demandeur[id_service]" id="demandeur_id_service">
                                        <?php foreach ($services as $s): ?>
                                            <option <?php if ($s->getIdDemandeur() != null): ?>selected="true"<?php endif; ?> value="<?php echo $s->getId(); ?>"><?php echo $s->getLibelle(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="hr hr-16 hr-dotted"></div>
                                </div>

                                <div class="col-sm-8" id="zone_unite" style="display: none;">
                                    <legend class="control-label no-padding-top"> Unité </legend>
                                    <?php $unites = UniteTable::getInstance()->getAllOrderByLibelle(); ?>
                                    <select multiple="multiple" size="10" name="demandeur[id_unite]" id="demandeur_id_unite">
                                        <?php foreach ($unites as $u): ?>
                                            <option <?php if ($u->getIdDemandeur() != null): ?>selected="true"<?php endif; ?> value="<?php echo $u->getId(); ?>"><?php echo $u->getLibelle(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="hr hr-16 hr-dotted"></div>
                                </div>

                                <div class="col-sm-8" id="zone_direction" style="display: none;">
                                    <legend class="control-label no-padding-top"> Direction </legend>
                                    <?php $directions = DirectionTable::getInstance()->getAllOrderByLibelle(); ?>
                                    <select multiple="multiple" size="10" name="demandeur[id_direction]" id="demandeur_id_direction">
                                        <?php foreach ($directions as $d): ?>
                                            <option <?php if ($d->getIdDemandeur() != null): ?>selected="true"<?php endif; ?> value="<?php echo $d->getId(); ?>"><?php echo $d->getLibelle(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="hr hr-16 hr-dotted"></div>
                                </div>

                                <div class="col-sm-8" id="zone_sous_direction" style="display: none;">
                                    <legend class="control-label no-padding-top"> Sous Direction </legend>
                                    <?php $sous_directions = SousdirectionTable::getInstance()->getAllOrderByLibelle(); ?>
                                    <select multiple="multiple" size="10" name="demandeur[id_sousdirection]" id="demandeur_id_sousdirection">
                                        <?php foreach ($sous_directions as $sd): ?>
                                            <option <?php if ($sd->getIdDemandeur() != null): ?>selected="true"<?php endif; ?> value="<?php echo $sd->getId(); ?>"><?php echo $sd->getLibelle(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="hr hr-16 hr-dotted"></div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="form-actions center" style="margin-bottom: 0px; margin-top: 0px;">
                    <a href="<?php echo url_for('@demandeur') ?>" class="btn btn-white btn-success">Retour à la liste</a>
                    <button type="button" class="btn btn-sm btn-success" onclick="AjouterDemandeur()">
                        Enregistrer
                        <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function showZoneDemandeur() {
        $('#zone_choix_demandeur div[class="col-sm-8"]').each(function () {
            if ($('#choix_demandeur').val() == $(this).attr('id'))
                $(this).fadeIn();
            else
                $(this).fadeOut();
        });
    }

    function AjouterDemandeur() {
        if ($('#choix_demandeur').val() != '') {
            $('#choix_demandeur_chosen > .chosen-single').css('border', '');
            var ids = '';

            switch ($('#choix_demandeur').val()) {
                case "zone_agent":
                    var x = document.getElementById("demandeur_id_agent");
                    break;
                case "zone_service":
                    var x = document.getElementById("demandeur_id_service");
                    break;
                case "zone_unite":
                    var x = document.getElementById("demandeur_id_unite");
                    break;
                case "zone_direction":
                    var x = document.getElementById("demandeur_id_direction");
                    break;
                case "zone_sous_direction":
                    var x = document.getElementById("demandeur_id_sousdirection");
                    break;
                default:
                    var x = document.getElementById("demandeur_id_agent");
            }
            for (var i = 0; i < x.selectedOptions.length; i++) {
                ids = ids + x.selectedOptions[i].value + ',,';
            }

            $.ajax({
                url: '<?php echo url_for('demandeur/saveDemandeur') ?>',
                data: 'choix=' + $('#choix_demandeur').val() +
                        '&ids=' + ids,
                success: function (data) {
                    location.reload();
                }
            });

        } else {
            $('#choix_demandeur_chosen > .chosen-single').css('border-color', '#f2a696');
            bootbox.dialog({
                message: "<span class='bigger-110' style='margin:20px;'>Veuillez choisir le type du demandeur !</span>",
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
    }

</script>

<style>

    .bootstrap-duallistbox-container .info {
        font-size: 14px;
    }

</style>