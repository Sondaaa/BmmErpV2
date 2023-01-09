<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<div class="sf_admin_filter" ng-controller="CtrlBudgetFilter">
    <input type="hidden" id="idtype" value="<?php
    if ($_REQUEST['idtype'])
        echo $_REQUEST['idtype'];
    else
        echo '';
    ?>">
           <?php if ($form->hasGlobalErrors()): ?>
               <?php echo $form->renderGlobalErrors() ?>
           <?php endif; ?>
    <form action="<?php echo url_for('documentbudget_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0" style="margin-bottom: 0px;" onmouseup="setMinMaxDate()">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'documentbudget_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                    <?php
                    include_partial('documentbudget/filters_field', array(
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

<script  type="text/javascript">

    function setMinMaxDate() {
        var annee_exercice = '<?php echo $_SESSION['exercice_budget']; ?>';
        var min_date = annee_exercice + '-01-01';
        var max_date = annee_exercice + '-12-31';
        $('#documentbudget_filters_datecreation_from').attr('min', min_date);
        $('#documentbudget_filters_datecreation_from').attr('max', max_date);
        $('#documentbudget_filters_datecreation_to').attr('min', min_date);
        $('#documentbudget_filters_datecreation_to').attr('max', max_date);
    }

</script>