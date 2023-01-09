<div id="sf_admin_container">
    <h1>Liste des fournisseurs</h1>
    <?php $actif = 'Actif'; ?>
    <div id="sf_admin_bar">
        <div class="sf_admin_filter col-xs-6">
            <form>
                <table class="table table-bordered table-hover" cellspacing="0">
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                <a href="<?php echo url_for('fournisseur/indexFrsActif?actitf=' . $actif) ?>" class="btn btn-white btn-success">Effacer</a>
                                <button onclick="goPage(1)" class="btn btn-white btn-success">Filtrer</button>
                            </td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr class="sf_admin_form_row sf_admin_text sf_admin_filter_field_idrh">
                            <td><label for="fournisseur_filters_codefrs">Code Fournisseur</label></td>
                            <td>
                                <input type="text" id="fournisseur_filters_codefrs" name="fournisseur_filters[codefrs]" value="" class="class" style="width: 100%;">
                            </td>
                        </tr>
                        <tr class="sf_admin_form_row sf_admin_text sf_admin_filter_field_nomcomplet">
                            <td><label for="fournisseur_filters_rs">Raison Sociale</label></td>
                            <td>
                                <input type="text" id="fournisseur_filters_rs" name="fournisseur_filters[rs]" value="" class="class" style="width: 100%;">
                            </td>
                        </tr>
                       
                         <tr class="sf_admin_form_row sf_admin_text ">
                            <td><label for="fournisseur_filters_id_famillearticle">Famille d'article</label></td>
                            <td>
                                <select  id="fournisseur_filters_id_famillearticle" name="fournisseur_filters"  class="chosen-select form-control" style="width: 100%;">
                                    <option value=""></option>
                                    <?php foreach ($familles as $famille): ?>
                                        <option value="<?php echo $famille->getId() ?>">
                                            <?php echo $famille->getLibelle(); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        
                          <tr class="sf_admin_form_row sf_admin_text ">
                            <td><label for="fournisseur_filters_id_activite">Activité fournisseure</label></td>
                            <td>
                                <select  id="fournisseur_filters_id_activite" name="fournisseur_filters[id_activite]"  class="chosen-select form-control" style="width: 100%;">
                                    <option value=""></option>
                                    <?php foreach ($activites as $activite): ?>
                                        <option value="<?php echo $activite->getId() ?>">
                                            <?php echo $activite->getLibelle(); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2"><input type="hidden" id="fournisseur_filters_id_etatfrs" value="<?php echo $actif; ?>"></td>
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

            
            <div class="widget-body" style="padding: 5%; text-align: center;">
            <!--<div class="widget-main" style="padding: 5%; text-align: center;">-->
                <!-- <a href="<?php //echo url_for('fournisseur/new') ?>" class="btn btn-outline btn_new btn-success" style="text-align: center; height: 60px !important; width: 250px; font-size: 14px !important;">Nouvelle Fiche Fournisseur</a>   -->
            <!--</div>-->
            <!-- <br><br> -->

            <button style="font-size: 14px !important; font-weight: bold !important;" 
                    onclick="printListFournisseur()" class=" btn btn-danger">
                <i class="ace-icon fa fa-print bigger-110"></i> Imprimer Liste des Fournisseurs
            </button>
            <br><br>
              <button style="font-size: 14px !important; font-weight: bold !important;" 
                    onclick="exportFournisseur()" class=" btn btn-primary">
                <i class="ace-icon fa fa-file_excel-o"></i> Exporter Liste des Fournisseurs vers Excel (.xlsx )
            </button>
            <br><br>
<!--            <a  href="<?php // echo url_for('fournisseur/exporterFourniseseurExcel') ?>"style="text-align: center; font-size: 14px !important;"
                class="btn  btn-primary " style="float: right; margin-right: 3px" type="button">
                <i class="ace-icon fa fa-file-excel-o"></i>
                Exporter Liste des Fournisseurs vers Excel (.xlsx )
            </a>-->
        </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="table-header">
            Liste des fournisseurs
        </div>
        <div>
            <table id="listFournisserus">
                <thead>
                    <tr>
                        <th style="width: 8%; text-align: center;">Code Fournisseur</th>
                        <th style="width: 15%;">N° Fiche</th>
                        <th style="width: 15%;">Référence Fournisseur</th>
                        <th style="width: 8%; text-align: center;">Raison Sociale</th>
                        <th style="width: 8%; text-align: center;">Tel</th>
                        <th style="width: 8%; text-align: center;">E-Mail</th>
                        <th style="width: 8%; text-align: center;">Famille d'article</th>
                        <th style="width: 8%; text-align: center;">Activité fournisseur</th>
                        <th style="width: 8%; text-align: center;">Plancomptable </th>
                        <th style=" text-align: center;">Opérations</th>
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    <?php include_partial("listeFournisseur", array("pager" => $pager)) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="my-modalimpression-all" class="modal fade" tabindex="-1" style="width: 1200px;display: none"> 
    <?php // include_partial('agents/form_impression_list', array()); ?>
</div>

<div id="my-modalimpression" class="modal fade" tabindex="-1" style="width: 1200px;display: none"> 
    <?php // include_partial('agents/form_impression', array()); ?>
</div>
<script  type="text/javascript">

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('fournisseur/indexFrsActif'); ?>',
            data: 'page=' + page +
                    '&id_activite=' + $('#fournisseur_filters_id_activite').val() +
                    '&rs=' + $('#fournisseur_filters_rs').val() +
                    '&id_famille=' + $('#fournisseur_filters_id_famillearticle').val() +
                    '&codefrs=' + $('#fournisseur_filters_codefrs').val() +
                    '&actif=' + '<?php echo 'Actif' ?>',
            success: function (data) {
                $('#listFournisserus tbody').html(data);
            }
        });
    }

    
    function setImprimeId(id) {
        $('#id_imprime').val(id);
    }

</script>
<script  type="text/javascript">
      function exportFournisseur() {
        var url = '';

        if ($('#fournisseur_filters_rs').val() != '')
        {
            if (url == '')
                url = 'rs=' + $('#fournisseur_filters_rs').val();
            else
                url = url + '&rs=' + $('#fournisseur_filters_rs').val();
        }

        if ($('#fournisseur_filters_id_famillearticle').val() != '')
        {
            if (url == '')
                url = '?id_famille=' + $('#fournisseur_filters_id_famillearticle').val();
            else
                url = url + '&id_famille=' + $('#fournisseur_filters_id_famillearticle').val();
        }
        if ($('#fournisseur_filters_id_activite').val() != '')
        {
            if (url == '')
                url = '?id_activite=' + $('#fournisseur_filters_id_activite').val();
            else
                url = url + '&id_activite=' + $('#fournisseur_filters_id_activite').val();
        }

        url = '<?php echo url_for('fournisseur/exporterFourniseseurExcel') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
    function printListFournisseur() {
        var url = '';
//        if ($('#fournisseur_filters_datecreation_from').val() != '')
//        {
//            url = '?date_from=' + $('#fournisseur_filters_datecreation_from').val();
//        }

//        if ($('#fournisseur_filters_datecreation_to').val() != '')
//        {
//            if (url == '')
//                url = '?date_to=' + $('#fournisseur_filters_datecreation_to').val();
//            else
//                url = url + '&date_to=' + $('#fournisseur_filters_datecreation_to').val();
//        }

        if ($('#fournisseur_filters_rs').val() != '')
        {
            if (url == '')
                url = 'rs=' + $('#fournisseur_filters_rs').val();
            else
                url = url + '&rs=' + $('#fournisseur_filters_rs').val();
        }

//        if ($('#fournisseur_filters_tel').val() != '')
//        {
//            if (url == '')
//                url = '?tel=' + $('#fournisseur_filters_tel').val();
//            else
//                url = url + '&tel=' + $('#fournisseur_filters_tel').val();
//        }

//        if ($('#fournisseur_filters_mail').val() != '')
//        {
//            if (url == '')
//                url = '?mail=' + $('#fournisseur_filters_mail').val();
//            else
//                url = url + '&mail=' + $('#fournisseur_filters_mail').val();
//        }

        if ($('#fournisseur_filters_id_famillearticle').val() != '')
        {
            if (url == '')
                url = '?id_famille=' + $('#fournisseur_filters_id_famillearticle').val();
            else
                url = url + '&id_famille=' + $('#fournisseur_filters_id_famillearticle').val();
        }
        if ($('#fournisseur_filters_id_activite').val() != '')
        {
            if (url == '')
                url = '?id_activite=' + $('#fournisseur_filters_id_activite').val();
            else
                url = url + '&id_activite=' + $('#fournisseur_filters_id_activite').val();
        }

        url = '<?php echo url_for('fournisseur/ImprimerListeFounisseur') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
</script>