<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter">
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form action="<?php echo url_for('lignebanquecaisse_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'lignebanquecaisse_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="button" onclick="FiltrerParametrecompte()" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                    <?php
                    include_partial('lignebanquecaisse/filters_field', array(
                        'name' => $name, 'id_caissebanque' => $id_caissebanque, 'id_budget' => $id_budget,
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
<script>
    function FiltrerParametrecompte() {
        var url = '';

        if ($('#id_caissebanque').val() != '')
        {
            url = '?id_caissebanque=' + $('#id_caissebanque').val();
        }

        if ($('#id_budget').val() != '')
        {
            if (url == '')
                url = '?id_budget=' + $('#id_budget').val();
            else
                url = url + '&id_budget=' + $('#id_budget').val();
        }

        url = '<?php echo url_for('lignebanquecaisse/index') ?>' + url;
        window.location = url;
//        win.focus();
    }
</script>