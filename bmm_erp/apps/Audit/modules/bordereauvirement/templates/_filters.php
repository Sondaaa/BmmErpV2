<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter">
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form ng-controller="CtrlMouvement" action="<?php echo url_for('bordereauvirement_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0" style="margin-bottom: 0px;">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'bordereauvirement_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                    <?php if ($name != 'id_typeoperation'): ?>
                        <?php
                        include_partial('bordereauvirement/filters_field', array(
                            'name' => $name,
                            'attributes' => $field->getConfig('attributes', array()),
                            'label' => $field->getConfig('label'),
                            'help' => $field->getConfig('help'),
                            'form' => $form,
                            'field' => $field,
                            'class' => 'sf_admin_form_row sf_admin_' . strtolower($field->getType()) . ' sf_admin_filter_field_' . $name,
                        ))
                        ?>
                    <?php else: ?>
                        <tr class="sf_admin_form_row sf_admin_foreignkey sf_admin_filter_field_id_typeoperation">
                            <td><label for="bordereauvirement_filters_id_typeoperation">Type d'opération</label></td>
                            <td>
                                <select name="bordereauvirement_filters[id_typeoperation]" id="bordereauvirement_filters_id_typeoperation" class="chosen-select form-control" style="width: 100%; display: none;">
                                    <option value="" selected="selected"></option>
                                </select>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
</div>