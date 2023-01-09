<?php use_helper('I18N', 'Date') ?>
<?php include_partial('agents/assets') ?>

<div id="sf_admin_container">
    <h1>Liste du personnel - <?php echo $regroupement; ?></h1>

    <div id="sf_admin_bar">
        <div class="sf_admin_filter col-xs-6">
            <form>
                <table class="table table-bordered table-hover" cellspacing="0">
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                <a href="<?php echo url_for('agents/indexRegroupement?reg=' . $regroupement->getId()) ?>" class="btn btn-white btn-success">Effacer</a>
                                <button onclick="goPage(1)" class="btn btn-white btn-success">Filtrer</button>
                            </td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr class="sf_admin_form_row sf_admin_text sf_admin_filter_field_idrh">
                            <td><label for="agents_filters_idrh">Matricule</label></td>
                            <td>
                                <input type="text" id="agents_filters_idrh" name="agents_filters[idrh][text]" value="" class="class" style="width: 100%;">
                            </td>
                        </tr>
                        <tr class="sf_admin_form_row sf_admin_text sf_admin_filter_field_nomcomplet">
                            <td><label for="agents_filters_nomcomplet">Nom</label></td>
                            <td>
                                <input type="text" id="agents_filters_nomcomplet" name="agents_filters[nomcomplet][text]" value="" class="class" style="width: 100%;">
                            </td>
                        </tr>
                        <tr class="sf_admin_form_row sf_admin_text sf_admin_filter_field_prenom">
                            <td><label for="agents_filters_prenom">Prénom</label></td>
                            <td>
                                <input type="text" id="agents_filters_prenom" name="agents_filters[prenom][text]" value="" class="class" style="width: 100%;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="hidden" id="agents_filters_id_regrouppement" value="<?php echo $regroupement->getId(); ?>"></td>
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
                    <a href="<?php echo url_for('agents/new?reg=' . $regroupement->getId()) ?>" class="btn btn-outline btn_new btn-success" style="text-align: center; font-size: 14px !important;">Nouvelle fiche Personnel - <?php echo $regroupement; ?></a>  
                    <br><br>
                    <button style="font-size: 14px !important; font-weight: bold !important;" onclick="printListAgents()" class=" btn btn-danger">
                        Imprimer Liste des Agents<br>< <?php echo $regroupement; ?> >
                    </button>
                    <br><br>
                    <a data-target="#my-modalimpression-all" role="button" data-toggle="modal" target="_blanc" class="btn btn-warning"><i class="ace-icon fa fa-print bigger-110"></i> Impression Personnalisée</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="table-header">
            Liste des agents - <?php echo $regroupement; ?>
        </div>
        <div>
            <table id="listAgents">
                <thead>
                    <tr>
                        <th style="width: 10%; text-align: center;">Matricule</th>
                        <th style="width: 20%;">Nom</th>
                        <th style="width: 15%;">Prénom</th>
                        <th style="width: 10%; text-align: center;">CIN</th>
                        <th style="width: 10%; text-align: center;">Date Naissance</th>
                        <th style="width: 10%; text-align: center;">Regroupement</th>
                        <th style="width: 10%; text-align: center;">Sexe</th>
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

<div id="my-modalimpression-all" class="modal fade" tabindex="-1" style="width: 1200px;display: none"> 
    <?php include_partial('agents/form_impression_list', array()); ?>
</div>

<div id="my-modalimpression" class="modal fade" tabindex="-1" style="width: 1200px;display: none"> 
    <?php include_partial('agents/form_impression', array()); ?>
</div>
<script  type="text/javascript">

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('agents/indexRegroupement'); ?>',
            data: 'page=' + page +
                    '&matricule=' + $('#agents_filters_idrh').val() +
                    '&nom=' + $('#agents_filters_nomcomplet').val() +
                    '&prenom=' + $('#agents_filters_prenom').val() +
                    '&reg=' + '<?php echo $regroupement->getId() ?>',
            success: function (data) {
                $('#listAgents tbody').html(data);
            }
        });
    }

    function printListAgents() {
        var url = '';
        if ($('#agents_filters_idrh').val() != '')
        {
            url = '?idrh=' + $('#agents_filters_idrh').val();
        }

        if ($('#agents_filters_nomcomplet').val() != '0')
        {
            if (url == '')
                url = '?nom=' + $('#agents_filters_nomcomplet').val();
            else
                url = url + '&nom=' + $('#agents_filters_nomcomplet').val();
        }

        if ($('#agents_filters_prenom').val() != '') {
            if (url == '')
                url = '?prenom=' + $('#agents_filters_prenom').val();
            else
                url = url + '&prenom=' + $('#agents_filters_prenom').val();
        }

        if (url == '')
            url = '?id_regroupement=<?php echo $regroupement->getId() ?>';
        else
            url = url + '&id_regroupement=<?php echo $regroupement->getId() ?>';


        url = '<?php echo url_for('agents/imprimerListeAgents') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
    function setImprimeId(id) {
        $('#id_imprime').val(id);
    }

</script>