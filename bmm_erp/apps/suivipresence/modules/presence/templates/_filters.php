<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter col-xs-6">
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form action="<?php echo url_for('presence_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'presence_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                    <?php
                    include_partial('presence/filters_field', array(
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
                <a href="<?php echo url_for('presence/new') ?>" class="btn btn-outline btn_new btn-success" style="text-align: center; font-size: 14px !important; " >Nouvelle Fiche Présence</a>  
                <br><br>
                <button style="font-size: 14px !important; font-weight: bold !important;" onclick="printListPrescenceAgents()" class=" btn btn-danger">
                    <i class="ace-icon fa fa-print bigger-110"></i> Imprimer Liste des Présences des Agents
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    function printListPrescenceAgents() {
        var url = '';

        if ($('#presence_filters_id_agents').val() != '')
        {
            url = '?id_agents=' + $('#presence_filters_id_agents').val();
        }

        if ($('#presence_filters_mois').val() != '')
        {
            if (url == '')
                url = '?mois=' + $('#presence_filters_mois').val();
            else
                url = url + '&mois=' + $('#presence_filters_mois').val();
        }

        if ($('#presence_filters_annee').val() != '') {
            if (url == '')
                url = '?annee=' + $('#presence_filters_annee').val();
            else
                url = url + '&annee=' + $('#presence_filters_annee').val();
        }
        url = '<?php echo url_for('presence/imprimerListeAgents') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
</script>