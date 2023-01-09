<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php $typecourriers = Doctrine_Core::getTable('typecourrier')->findAll(); ?>

<div class="sf_admin_filter col-xs-8" >
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form action="<?php echo url_for('parcourcourier_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'parcourcourier_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php
                $str = "?type=export";
                foreach ($configuration->getFormFilterFields($form) as $name => $field):
                    ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                    <?php
                    include_partial('parcourcourier/filters_field', array(
                        'name' => $name,
                        'attributes' => $field->getConfig('attributes', array()),
                        'label' => $field->getConfig('label'),
                        'help' => $field->getConfig('help'),
                        'form' => $form,
                        'field' => $field,
                        'class' => 'sf_admin_form_row sf_admin_' . strtolower($field->getType()) . ' sf_admin_filter_field_' . $name,
                    ));
                    if (!is_array($form[$name]->getValue()))
                        $str.="&" . $name . "=" . $form[$name]->getValue();
                    else {
                        $str.="&" . $name . "from=" . $form[$name]->getValue()['from'] . "&" . $name . "to=" . $form[$name]->getValue()['to'];
                    }
                    ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
</div>
<div class="col-xs-4  widget-container-col" id="widget-container-col-1">
    <div class="widget-box" id="widget-box-1">
        <div class="widget-header">
            <h5 class="widget-title">Type des courriers</h5>
            <div class="widget-toolbar">
                <a href="#" data-action="collapse" class="btn btn-white btn-success">
                    <i class="ace-icon fa fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="widget-body">
            <div class="widget-main">
                <table>
                    <?php foreach ($typecourriers as $type) { ?>
                        <tr>
                            <td style="<?php echo $type->getCoul(); ?>"><?php echo $type ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <a style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" href="<?php echo url_for('parcourcourier1/Imprimerlistecourrier') . $str ?>" class=" btn btn-white btn-success">
                    Exporter<br>PDF
                </a>
            </div>
        </div>
    </div>
</div>