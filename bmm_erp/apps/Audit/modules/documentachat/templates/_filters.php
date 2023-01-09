<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php if ($idtype == 6): ?>
    <h5 style="color: #843534"> B.C.I.S: Bon de Commande Interne Système</h5>
    <h5 style="color: #843534"> B.C.E.S: Bon de Commande Externe Système</h5>
    <h5 style="color: #843534"> B.D.C.S: Bon de Dépenses au Comptant Système</h5>
<?php elseif ($idtype == 9): ?>
    <h5 style="color: #843534"> B.C.I.M.P.S: Bon de Commande Interne systéme marches publique</h5>
<?php else: ?>

<?php endif; ?>
<div class="sf_admin_filter col-xs-6">
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form action="<?php echo url_for('documentachat_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0" style="margin-bottom: 0px;">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'documentachat_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php
                $str = "?idtype=" . $idtype;
                foreach ($configuration->getFormFilterFields($form) as $name => $field):
                    ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                    <?php
                    include_partial('documentachat/filters_field', array(
                        'name' => $name,
                        'attributes' => $field->getConfig('attributes', array()),
                        'label' => $field->getConfig('label'),
                        'help' => $field->getConfig('help'),
                        'form' => $form,
                        'field' => $field,
                        'class' => 'sf_admin_form_row sf_admin_' . strtolower($field->getType()) . ' sf_admin_filter_field_' . $name,
                    ));
                    if ($name != "datecreation")
                        $str.="&" . $name . "=" . $form[$name]->getValue();
                    else {
                        $datecreation = $form[$name]->getValue();
                        $str.="&De=" . date('Y-m-d', strtotime($datecreation['from'])) . "&à=" . date('Y-m-d', strtotime($datecreation['to']));
                    }
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
                <a style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" href="<?php echo url_for('Documents/Imprimerlistedocument') . '' . $str ?>" class=" btn btn-white btn-success">
                    Exporter<br>PDF
                </a>
            </div>
        </div>
    </div>
</div>