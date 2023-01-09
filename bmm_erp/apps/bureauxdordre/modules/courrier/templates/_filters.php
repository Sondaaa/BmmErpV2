<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter col-xs-6" ng-controller="CtrlCourrierFilter">
    <input type="hidden" id="idtype" value="<?php
    if ($_REQUEST['idtype'])
        echo $_REQUEST['idtype'];
    else
        echo '';
    ?>">
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>
    <form action="<?php echo url_for('courrier_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <a class="btn btn-white btn-success" href="<?php echo url_for('courrier/index?idtype=' . $_REQUEST['idtype']) ?>"> Effacer</a>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                    <?php
                    include_partial('courrier/filters_field', array(
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
                <?php $exps = ExpdestTable::getInstance()->getAll(); ?>
                <tr>
                    <td>
                        <label>Expéditeur</label></td>
                    <td>
                        <select id="expediteur" name="expediteur">
                            <option value=""></option>
                            <?php foreach ($exps as $exp): ?>
                                <option value="<?php echo $exp->getId(); ?>"><?php echo trim($exp); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Récepteur</label></td>
                    <td>
                        <select id="recepteur" name="recepteur">
                            <option value=""></option>
                            <?php foreach ($exps as $exp): ?>
                                <option value="<?php echo $exp->getId(); ?>"><?php echo trim($exp); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>

<?php if (isset($_REQUEST['idtype'])) { ?>
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
                    <a href="<?php echo url_for('courrier/new') ?>?idtype=<?php echo $_REQUEST['idtype'] ?>" class=" btn btn-outline btn-success" style="height: 65px !important; width: 250px; font-size: 14px; font-weight: bold;">
                        Nouvau Courrier <br>
                        <?php if ($_REQUEST['idtype'] == 2) echo "Départ Interne"; ?>
                        <?php if ($_REQUEST['idtype'] == 1) echo "Arrivé Interne"; ?>
                        <?php if ($_REQUEST['idtype'] == 3) echo "Arrivé Externe"; ?>
                        <?php if ($_REQUEST['idtype'] == 4) echo "Départ Externe"; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>