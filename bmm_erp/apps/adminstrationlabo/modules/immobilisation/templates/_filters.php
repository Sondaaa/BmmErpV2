<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>


<?php
$user = new Utilisateur();
$user = $sf_user->getAttribute('userB2m');
$acces_immobilisation = $user->getProfilApplication("Unité Patrimoine (Immobilisation)");
?>

<div class="sf_admin_filter col-xs-6" ng-app="myApp" ng-controller="myCtrlImmo">
    <?php if ($form->hasGlobalErrors()) : ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form action="<?php echo url_for('immobilisation_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'immobilisation_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($configuration->getFormFilterFields($form) as $name => $field) : ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                    <?php
                    include_partial('immobilisation/filters_field', array(
                        'name' => $name,
                        'attributes' => $field->getConfig('attributes', array()),
                        'label' => $field->getConfig('label'),
                        'help' => $field->getConfig('help'),
                        'form' => $form,
                        'field' => $field,
                        'class' => 'sf_admin_form_row sf_admin_' . strtolower($field->getType()) . ' sf_admin_filter_field_' . $name,
                    ))
                    ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
</div>

<?php  //if ($user->getProfilModule($acces_immobilisation->getId(), "fiche")): 
?>
<div class="col-xs-4 widget-container-col" id="widget-container-col-1">
    <div class="widget-box" id="widget-box-1">
        <div class="widget-header">
            <div class="widget-toolbar">
                <a href="#" data-action="collapse" class="btn btn-xs btn-success">
                    <i class="ace-icon fa fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="widget-body">
            <div class="widget-main" style="padding: 5%; text-align: center;">
               
                <a type="button" style="height: 55px !important; width: 270px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" onclick="printListImmobilisation()" class=" btn btn-outline btn-danger">
                    <i class="ace-icon fa fa-print bigger-110"></i> Exporter PDF
                </a>
                <br><br>

                <a data-target="#my-modalimpression" role="button" onclick="setImprimeId('<?php //echo $agents->getId(); 
                                                                                            ?>')" data-toggle="modal" style="text-align: center;height: 55px; width: 270px; font-size: 14px !important;" target="_blanc" class="btn btn-outline btn-warning width-fixed">
                    Impression Personnalisée
                </a>

                </br></br>
                <button style="height: 55px !important; width: 270px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" onclick="ExportListDocAchats()" class=" btn btn-outline btn-primary">
                    <i class="ace-icon fa fa-file-excel-o"></i> Exporter vers Excel (.xlsx )
                </button>
            </div>
        </div>
    </div>
</div>
<?php //endif; 
?>
<div id="my-modalimpression" class="modal fade" tabindex="-1" style="width: 1200px;display: none">
    <?php include_partial('immobilisation/form_impression', array()); ?>
</div>
<script type="text/javascript">
    function printListImmobilisation() {
        var url = '';

        if ($('#immobilisation_filters_designation').val() != '') {
            url = '?designation=' + $('#immobilisation_filters_designation').val();
        }
        if ($('#immobilisation_filters_id_site').val() != '') {
            if (url == '')
                url = '?id_site=' + $('#immobilisation_filters_id_site').val();
            else
                url = url + '&id_site=' + $('#immobilisation_filters_id_site').val();
        }
        if ($('#immobilisation_filters_id_etage').val() != '') {
            if (url == '')
                url = '?id_soussite=' + $('#immobilisation_filters_id_etage').val();
            else
                url = url + '&id_soussite=' + $('#immobilisation_filters_id_etage').val();
        }
        if ($('#immobilisation_filters_id_bureaux').val() != '') {
            if (url == '')
                url = '?id_bureau=' + $('#immobilisation_filters_id_bureaux').val();
            else
                url = url + '&id_bureau=' + $('#immobilisation_filters_id_bureaux').val();
        }
        if ($('#immobilisation_filters_id_categorie').val() != '') {
            if (url == '')
                url = '?id_cat=' + $('#immobilisation_filters_id_categorie').val();
            else
                url = url + '&id_cat=' + $('#immobilisation_filters_id_categorie').val();
        }


        if ($('#immobilisation_filters_id_famille').val() != '') {
            if (url == '')
                url = '?id_famille=' + $('#immobilisation_filters_id_famille').val();
            else
                url = url + '&id_famille=' + $('#immobilisation_filters_id_famille').val();
        }
        if ($('#immobilisation_filters_id_sousfamille').val() != '') {
            if (url == '')
                url = '?id_sousfamille=' + $('#immobilisation_filters_id_sousfamille').val();
            else
                url = url + '&id_sousfamille=' + $('#immobilisation_filters_id_sousfamille').val();
        }
        url = '<?php echo url_for('immobilisation/imprimerlisteImmobilisation') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }

    function ExportListDocAchats() {
        var url = '';

        if ($('#immobilisation_filters_designation').val() != '') {
            url = '?designation=' + $('#immobilisation_filters_designation').val();
        }
        if ($('#immobilisation_filters_id_site').val() != '') {
            if (url == '')
                url = '?id_site=' + $('#immobilisation_filters_id_site').val();
            else
                url = url + '&id_site=' + $('#immobilisation_filters_id_site').val();
        }
        if ($('#immobilisation_filters_id_etage').val() != '') {
            if (url == '')
                url = '?id_soussite=' + $('#immobilisation_filters_id_etage').val();
            else
                url = url + '&id_soussite=' + $('#immobilisation_filters_id_etage').val();
        }
        if ($('#immobilisation_filters_id_bureaux').val() != '') {
            if (url == '')
                url = '?id_bureau=' + $('#immobilisation_filters_id_bureaux').val();
            else
                url = url + '&id_bureau=' + $('#immobilisation_filters_id_bureaux').val();
        }
        if ($('#immobilisation_filters_id_categorie').val() != '') {
            if (url == '')
                url = '?id_cat=' + $('#immobilisation_filters_id_categorie').val();
            else
                url = url + '&id_cat=' + $('#immobilisation_filters_id_categorie').val();
        }


        if ($('#immobilisation_filters_id_famille').val() != '') {
            if (url == '')
                url = '?id_famille=' + $('#immobilisation_filters_id_famille').val();
            else
                url = url + '&id_famille=' + $('#immobilisation_filters_id_famille').val();
        }
        if ($('#immobilisation_filters_id_sousfamille').val() != '') {
            if (url == '')
                url = '?id_sousfamille=' + $('#immobilisation_filters_id_sousfamille').val();
            else
                url = url + '&id_sousfamille=' + $('#immobilisation_filters_id_sousfamille').val();
        }
        url = '<?php echo url_for('immobilisation/exporterListeImmobilisationExcel') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
</script>