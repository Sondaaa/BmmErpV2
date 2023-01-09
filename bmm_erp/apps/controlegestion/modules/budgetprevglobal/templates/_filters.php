<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter">
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form action="<?php echo url_for('budgetprevglobal_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'budgetprevglobal_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                    <?php
                    include_partial('budgetprevglobal/filters_field', array(
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
            <div class="widget-main" style="padding: 3%; text-align: center; min-height: 200px;">


                <button style="height: 35px !important; width: 250px; font-size: 12px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="printListDocBudgetPardirection()"

                        class=" btn btn-outline btn-xs btn-danger">
                    <i class="ace-icon fa fa-print bigger-110"></i>   Imprimer Liste Par Direction 
                </button>
                <br></br>
                <button style="height: 45px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="exportListDocBudgetPardirection()"   class=" btn btn-outline btn-xs btn-primary">
                    <i class="ace-icon fa fa-file-excel-o"></i>   Exporter Liste Par Direction</br> vers Excel (.xlsx )
                </button><br></br>
                <button style="height: 35px !important; width: 250px; font-size: 12px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="printListDocBudgetParOrigine()"

                        class=" btn btn-outline btn-xs btn-success">
                    <i class="ace-icon fa fa-print bigger-110"></i>   Imprimer Liste Par Origine 
                </button>
                <br></br>
                <button style="height: 45px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="exportListDocBudgetParorigine()"   class=" btn btn-outline btn-xs btn-primary1">
                    <i class="ace-icon fa fa-file-excel-o"></i>   Exporter Liste Par Origine</br> vers Excel (.xlsx )
                </button>
            </div>
        </div>
    </div>
</div>
<script>

    function printListDocBudgetPardirection() {
        var url = '';
        if ($('#titrebudjet_filters_id_cat').val() != '')
        {
            url = '?id_cat=' + $('#titrebudjet_filters_id_cat').val();
        }



        url = '<?php echo url_for('budgetprevglobal/imprimerlisteBudgetPardirection') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }

    function printListDocBudgetParOrigine() {
        var url = '';
        if ($('#titrebudjet_filters_id_cat').val() != '')
        {
            url = '?id_cat=' + $('#titrebudjet_filters_id_cat').val();
        }
        url = '<?php echo url_for('budgetprevglobal/imprimerlisteBudgetParOrigine') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
    function exportListDocBudgetPardirection() {
        var url = '';
        if ($('#titrebudjet_filters_id_cat').val() != '')
        {
            url = '?id_cat=' + $('#titrebudjet_filters_id_cat').val();
        }
        url = '<?php echo url_for('budgetprevglobal/exporterDocumentsbudgetPardirectionExcel') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }

   function exportListDocBudgetParorigine() {
        var url = '';
        if ($('#titrebudjet_filters_id_cat').val() != '')
        {
            url = '?id_cat=' + $('#titrebudjet_filters_id_cat').val();
        }
        url = '<?php echo url_for('budgetprevglobal/exporterDocumentsbudgetExcel') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
</script>