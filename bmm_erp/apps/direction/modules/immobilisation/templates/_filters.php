<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php
if (($sf_user->getAttribute('userB2m'))) {
    ?>
    <script  type="text/javascript">
        document.location.href = "<?php echo sfconfig::get('sf_appdir') . 'index.php' . url_for('/Admin/deconnect') ?>";
    </script>
    <?php
}
$user = new Utilisateur();
$user = $sf_user->getAttribute('userB2m');
?>

<div class="sf_admin_filter">
    <?php if ($form->hasGlobalErrors()): ?>
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
                <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
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

<?php  if ($user->getAcceesDroit("immobilisation.php/immobilisation/new")): ?>
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
                    <a href="<?php echo url_for('immobilisation/new') ?>" class="btn btn-outline btn_new btn-success" style="text-align: center; width: 250px; font-size: 14px !important;">Nouvelle Fiche Immobilisation</a>  
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>