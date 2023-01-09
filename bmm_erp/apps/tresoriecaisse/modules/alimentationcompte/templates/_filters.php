<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter col-xs-6">
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form action="<?php echo url_for('alimentationcompte_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'alimentationcompte_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                    <?php
                    include_partial('alimentationcompte/filters_field', array(
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

<div class="col-xs-4 widget-container-col" id="widget-container-col-1">
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
                <a href="<?php echo url_for('alimentationcompte/new') ?>" class="btn btn-outline btn_new btn-success" style="text-align: center; width: 250px; font-size: 14px !important; ">Nouvelle Alimentation (Transfert)</a>  
                <br><br>
                <a style="width: 250px; font-size: 14px !important; font-weight: bold !important;" onclick="imprimerListe()" class=" btn btn-white btn-success">
                    Exporter PDF
                </a>
            </div>
        </div>
    </div>
</div>

<script>

    function imprimerListe() {
        var url = '';
        if ($('#alimentationcompte_filters_id_compte').val() != '')
        {
            url = '?compte_id=' + $('#alimentationcompte_filters_id_compte').val();
        }

        if ($('#alimentationcompte_filters_id_tranchebudget').val() != '')
        {
            if (url == '')
                url = '?titre_id=' + $('#alimentationcompte_filters_id_tranchebudget').val();
            else
                url = url + '&titre_id=' + $('#alimentationcompte_filters_id_tranchebudget').val();
        }

        if ($('#alimentationcompte_filters_date_from').val() != '') {
            if (url == '')
                url = '?date_debut=' + $('#alimentationcompte_filters_date_from').val();
            else
                url = url + '&date_debut=' + $('#alimentationcompte_filters_date_from').val();
        }
        if ($('#alimentationcompte_filters_date_to').val() != '') {
            if (url == '')
                url = '?date_fin=' + $('#alimentationcompte_filters_date_to').val();
            else
                url = url + '&date_fin=' + $('#alimentationcompte_filters_date_to').val();
        }

        url = '<?php echo url_for('alimentationcompte/imprimerListe') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }

</script>