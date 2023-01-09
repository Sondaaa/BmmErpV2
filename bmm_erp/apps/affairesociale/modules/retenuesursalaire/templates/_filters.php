<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter col-xs-6">
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form action="<?php echo url_for('retenuesursalaire_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'retenuesursalaire_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                    <?php
                    $disabled = '';
                    if ($name == 'mois') {
//                        $disabled = ' disabledbutton';
                    }
                    include_partial('retenuesursalaire/filters_field', array(
                        'name' => $name,
                        'attributes' => $field->getConfig('attributes', array()),
                        'label' => $field->getConfig('label'),
                        'help' => $field->getConfig('help'),
                        'form' => $form,
                        'field' => $field,
                        'class' => 'sf_admin_form_row sf_admin_' . strtolower($field->getType()) . ' sf_admin_filter_field_' . $name . $disabled,
                    ))
                    ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
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
                <a href="<?php echo url_for('retenuesursalaire/new') ?>" class="btn btn-outline btn_new btn-success" style="text-align: center; font-size: 14px !important; " >Nouvelle Fiche Retenue Sur Salaire</a>  
                <br><br>
                <button style="font-size: 14px !important; font-weight: bold !important;" onclick="printListretenuesursalaire()" class=" btn btn-primary">
                    Imprimer Liste des Demandes <br>de Retenues sur salaire
                </button>
            </div>
        </div>
    </div>
</div>
<script  type="text/javascript">

    function printListretenuesursalaire() {
        var url = '';
        if ($('#retenuesursalaire_filters_id_agents').val() != '0')
        {
            if (url == '')
                url = '?id_agents=' + $('#retenuesursalaire_filters_id_agents').val();
        }

        if ($('#retenuesursalaire_filters_id_fournisseur').val() != '')
        {
            if (url == '')
                url = '?id_fournisseur=' + $('#retenuesursalaire_filters_id_fournisseur').val();
            else
                url = url + '&id_fournisseur=' + $('#retenuesursalaire_filters_id_fournisseur').val();
        }
        if ($('#retenuesursalaire_filters_mois').val() != '') {
            if (url == '')
                url = '?id_mois=' + $('#retenuesursalaire_filters_mois').val();
            else
                url = url + '&id_mois=' + $('#retenuesursalaire_filters_mois').val();
        }
        if ($('#retenuesursalaire_filters_annee').val() != '0') {
            if (url == '')
                url = '?id_annee=' + $('#retenuesursalaire_filters_annee').val();
            else
                url = url + '&id_annee=' + $('#retenuesursalaire_filters_annee').val();
        }

        url = '<?php echo url_for('retenuesursalaire/imprimerListeRetenueSurSalaire') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }

</script>