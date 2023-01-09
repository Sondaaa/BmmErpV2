<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php $typecourriers = Doctrine_Core::getTable('agents')->findAll(); ?>
<div class="sf_admin_filter col-xs-6">
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form action="<?php echo url_for('agents_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'agents_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                    <?php
                    include_partial('agents/filters_field', array(
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
                <button style="font-size: 14px !important; font-weight: bold !important;" onclick="printListAgents()" class="btn btn-danger">
                    Imprimer Liste des Agents
                </button>
                <br><br>
                <a data-target="#my-modalimpression-all" role="button" data-toggle="modal" target="_blanc" class="btn btn-warning"><i class="ace-icon fa fa-print bigger-110"></i> Impression Personnalisée</a>
            </div>
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

    function printListAgents() {
        var url = '';
        if ($('#agents_filters_idrh').val() != '')
        {
            url = '?idrh=' + $('#agents_filters_idrh').val();
        }

        if ($('#agents_filters_nomcomplet').val() != '')
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
        if ($('#agents_filters_id_regrouppement').val() != '0') {
            if (url == '')
                url = '?id_regroupement=' + $('#agents_filters_id_regrouppement').val();
            else
                url = url + '&id_regroupement=' + $('#agents_filters_id_regrouppement').val();
        }

        url = '<?php echo url_for('agents/imprimerListeAgents') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
    function setImprimeId(id){
        $('#id_imprime').val(id);
    }

</script>