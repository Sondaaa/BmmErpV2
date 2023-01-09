<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter col-xs-6">
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form action="<?php echo url_for('historiqueretenue_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'historiqueretenue_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                    <?php
                    include_partial('historiqueretenue/filters_field', array(
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
                <button style="font-size: 14px !important; font-weight: bold !important;" onclick="printListretenuemensielle()" class=" btn btn-danger">
                    Imprimer Liste des Retenues  
                </button>
            </div>
        </div>
    </div>
</div>
<script  type="text/javascript">
    function printListretenuemensielle() {
        var url = '';
        if ($('#historiqueretenue_filters_id_retenue').val() != '0')
        {
            url = '?id_demande_retenue=' + $('#historiqueretenue_filters_id_retenue').val();
        }
        if ($('#historiqueretenue_filters_nbrmoissoustre').val() != '0')
        {
            if (url == '')
                url = '?id_agents=' + $('#historiqueretenue_filters_nbrmoissoustre').val();
            else
                url = url + '&id_agents=' + $('#historiqueretenue_filters_nbrmoissoustre').val();
        }
        if ($('#historiqueretenue_filters_id_demandeavance').val() != '0')
        {
            if (url == '')
                url = '?id_demande_avance=' + $('#historiqueretenue_filters_id_demandeavance').val();
            else
                url = url + '&id_demande_avance=' + $('#historiqueretenue_filters_id_demandeavance').val();
        }

        if ($('#historiqueretenue_filters_id_demandepret').val() != '0')
        {
            if (url == '')
                url = '?id_demandepret=' + $('#historiqueretenue_filters_id_demandepret').val();
            else
                url = url + '&id_demandepret=' + $('#historiqueretenue_filters_id_demandepret').val();
        }
        if ($('#historiqueretenue_filters_mois').val() != '') {
            if (url == '')
                url = '?id_mois=' + $('#historiqueretenue_filters_mois').val();
            else
                url = url + '&id_mois=' + $('#historiqueretenue_filters_mois').val();
        }
        if ($('#historiqueretenue_filters_annee').val() != '0') {
            if (url == '')
                url = '?id_annee=' + $('#historiqueretenue_filters_annee').val();
            else
                url = url + '&id_annee=' + $('#historiqueretenue_filters_annee').val();
        }

        url = '<?php echo url_for('historiqueretenue/imprimerListeRetenuemensielle') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
</script>