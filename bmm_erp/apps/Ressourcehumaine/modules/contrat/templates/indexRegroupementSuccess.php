<?php use_helper('I18N', 'Date') ?>
<?php include_partial('contrat/assets') ?>

<div id="sf_admin_container">
    <h1>Liste des Carrières du  Personnels - <?php echo $regroupement; ?></h1>

    <div id="sf_admin_bar">
        <div class="sf_admin_filter col-xs-6">
            <form>
                <table class="table table-bordered table-hover" cellspacing="0">
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                <a href="<?php echo url_for('contrat/indexRegroupement?reg=' . $regroupement->getId()) ?>" class="btn btn-white btn-success">Effacer</a>
                                <button onclick="goPage(1)" class="btn btn-white btn-success">Filtrer</button>
                            </td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr class="sf_admin_form_row sf_admin_text ">
                            <td><label for="contrat_filters_id_agents">Agents</label></td>
                            <td>

                                <select type="text" id="contrat_filters_id_agents" name="contrat_filters[id_agents]"  class="chosen-select form-control" style="width: 100%;">
                                    <option value=""></option>
                                    <?php foreach ($agents as $agent): ?>
                                        <option value="<?php echo $agent->getId() ?>">
                                            <?php echo $agent->getIdrh() . ' ' . $agent->getNomcomplet() ?>
                                        </option>
                                    <?php endforeach; ?>

                                </select>
                            </td>
                        </tr>
                        <tr class="sf_admin_form_row sf_admin_text ">
                            <td><label for="contrat_filters_id_posterh">Poste</label></td>
                            <td>
                                <select  id="contrat_filters_id_posterh" name="contrat_filters[id_posterh]"  class="chosen-select form-control" style="width: 100%;">
                                    <option value=""></option>
                                    <?php foreach ($postes as $poste): ?>
                                        <option value="<?php echo $poste->getId() ?>">
                                            <?php echo $poste->getLibelle() ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                </td>
                        </tr>
                        <tr class="sf_admin_form_row sf_admin_text">
                            <td><label for="contrat_filters_id_unite">Unite</label></td>
                            <td>
                                <select id="contrat_filters_id_unite" name="contrat_filters[id_unite]" class="chosen-select form-control" style="width: 100%;">
                                 <option value=""></option>
                                    <?php foreach ($unites as $unite): ?>
                                        <option value="<?php echo $unite->getId() ?>">
                                            <?php echo $unite->getLibelle() ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                
                                </td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="hidden" id="contrat_filters_id_regrouppement" value="<?php echo $regroupement->getId(); ?>"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <div class="col-xs-4  widget-container-col" id="widget-container-col-1">
        <div class="widget-box" id="widget-box-1">
            <div class="widget-header">
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse" class="btn btn-white btn-success">
                        <i class="ace-icon fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main" style="padding: 5%; text-align: center;">
                    <a href="<?php echo url_for('contrat/new?reg=' . $id_regroupement) ?>" class="btn btn-outline btn_new btn-success" style="text-align: center; font-size: 14px !important;">Nouvelle fiche Carrière <?php echo  $regroupement; ?></a>  
                    <br><br>
                   
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="table-header">
            Liste des Carrières - <?php echo $regroupement; ?>
        </div>
        <div>
            <table id="listContrat">
                <thead>
                    <tr>
                        <th style="width: 25%; ">Agents</th>
                        <th style="width: 25%;">Poste</th>
                        <th style="width: 25%;">Unite</th>
                        <th style="width: 10%; text-align: center;">Regroupement</th>
                        <th style="width: 15%; text-align: center;">Opérations</th>
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    <?php include_partial("listeRegroupement", array("pager" => $pager)) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script  type="text/javascript">

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('contrat/indexRegroupement'); ?>',
            data: 'page=' + page +
                    '&id_agents=' + $('#contrat_filters_id_agents').val() +
                    '&id_posterh=' + $('#contrat_filters_id_posterh').val() +
                    '&id_unite=' + $('#contrat_filters_id_unite').val() +
                    '&reg=' + '<?php echo $regroupement->getId() ?>',
            success: function (data) {
                $('#listContrat tbody').html(data);
            }
        });
    }

    
    function setImprimeId(id) {
        $('#id_imprime').val(id);
    }

</script>