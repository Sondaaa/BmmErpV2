<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<h5 style="color: #843534"> B.C.I.M.P.S: Bon de Commande Interne systéme marchés publics</h5>

<div class="sf_admin_filter col-xs-6">
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form action="<?php echo url_for('documentachat_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0">
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
                 $str = "?idtype=".$idtype;
                foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
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
                        $str.="&from=" .date('Y-m-d',  strtotime($datecreation['from'])) . "&to=" . date('Y-m-d',  strtotime($datecreation['to']));
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
            <div class="widget-toolbar">
                <a href="#" data-action="collapse" class="btn btn-white btn-success">
                    <i class="ace-icon fa fa-chevron-up"></i>
                </a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main" style="padding: 5%; text-align: center;">
                <a href="<?php echo url_for('documentachat/new?idtype=9') ?>" class="btn btn-outline btn_new btn-success" style="text-align: center;height: 60px !important; width: 260px; font-size: 14px !important;">Nouveau Bon Commande Interne<br>Marchés Publics</a>  
                <br><br>
                <a style="height: 55px !important; width: 260px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" href="<?php echo url_for('Documents/Imprimerlistedocument') . '' . $str ?>" class=" btn btn-white btn-success">
                    Exporter<br>PDF
                </a>
            </div>
        </div>
    </div>
</div>