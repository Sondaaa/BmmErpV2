<?php use_helper('I18N', 'Date') ?>
<?php  include_partial('demandeur/assets') ?>

<div id="sf_admin_container">
    <h1>Liste des demandeurs</h1>

    <div id="sf_admin_bar">
        <div class="sf_admin_filter col-xs-6">
            <form>
                <table class="table table-bordered table-hover" cellspacing="0">
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                <a href="<?php echo url_for('@demandeur') ?>" class="btn btn-white btn-success">Effacer</a>
                                <button onclick="goPage(1)" class="btn btn-white btn-success">Filtrer</button>
                            </td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr class="sf_admin_form_row sf_admin_text ">
                            <td><label >Demandeur</label></td>
                            <td>
                                <input type="text" id="demandeur_filters_libelle" value="">
                            </td>
                        </tr>
                        <tr class="sf_admin_form_row sf_admin_text ">
                            <td><label for="demandeur_filters_id_agent">Agents</label></td>
                            <td>
                                <select  id="demandeur_filters_id_agent" name="demandeur_filters[id_agent]"  class="chosen-select form-control" style="width: 100%;">
                                    <option value=""></option>
                                    <?php foreach ($agents as $agent): ?>
                                        <option value="<?php echo $agent->getId() ?>">
                                            <?php echo $agent->getIdrh() . ' ' . $agent->getNomcomplet() . ' ' . $agent->getPrenom() ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
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
                    <a href="<?php echo url_for('demandeur/new') ?>" class="btn btn-outline btn_new btn-success" style="text-align: center; font-size: 14px !important;">
                        Nouvelle fiche Demandeur</a>  
                    <br><br>

                    <button style="font-size: 14px !important; font-weight: bold !important;" 
                            onclick="printListDemandeur()" class=" btn btn-danger">
                        <i class="ace-icon fa fa-print bigger-110"></i> Imprimer Liste des Demandeurs
                    </button>
                    <br><br>
                    <a  href="<?php echo url_for('demandeur/exporterDemandeurExcel') ?>"style="text-align: center; font-size: 14px !important;"
                       class="btn  btn-primary " style="float: right; margin-right: 3px" type="button">
                        <i class="ace-icon fa fa-file-excel-o"></i>
                        Exporter Liste des Demandeurs vers Excel (.xlsx )
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="table-header">
            Liste des demandeurs
        </div>
        <div>
            <table id="listDemandeur">
                <thead>
                    <tr>
                        <th style="width: 10%; ">Demandeur</th>
                        <th style="width: 15%; ">Agent</th>
                        <th style="width: 10%; ">Regroupement</th>
                        <th style="width: 10%;">Unité</th>
                        <th style="width: 10%;">Service</th>
                        <th style="width: 15%; ">Sous direction</th>
                        <th style="width: 20%;">Direction</th>
                        <th style="width: 10%; ">Opérations</th>
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    <?php include_partial("listeDemandeur", array("pager" => $pager)) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script  type="text/javascript">

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('@demandeur'); ?>',
            data: 'page=' + page +
                    '&id_agents=' + $('#demandeur_filters_id_agent').val() +
                    '&libelle=' + $('#demandeur_filters_libelle').val(),
            success: function (data) {
                $('#listDemandeur tbody').html(data);
            }
        });
    }

    function printListDemandeur() {
        var url = '';
        if ($('#demandeur_filters_libelle').val() != '')
        {
            url = '?libelle=' + $('#demandeur_filters_libelle').val();
        }

        if ($('#demandeur_filters_id_agent').val() != '')
        {
            if (url == '')
                url = '?id_agents=' + $('#demandeur_filters_id_agent').val();
            else
                url = url + '&id_agents=' + $('#demandeur_filters_id_agent').val();
        }


        url = '<?php echo url_for('demandeur/imprimerListeDemandeur') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
</script>