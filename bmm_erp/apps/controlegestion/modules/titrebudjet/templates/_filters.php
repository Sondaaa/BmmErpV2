<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter col-xs-6">
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form action="<?php echo url_for('titrebudjet_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0" style="margin-bottom: 0px;">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'titrebudjet_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                    <?php
                    include_partial('titrebudjet/filters_field', array(
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
            <div class="widget-main" style="padding: 3%; text-align: center; min-height: 291px;">
                <?php if ($type_budget != "Final"): ?>
                    <a class="btn btn-outline btn_new btn-warning" href="<?php echo url_for('titrebudjet/new?type=Budget Pr??visionnel Direction & Projet') ?>" style="text-align: center;height: 65px !important; width: 250px; font-size: 14px !important; margin-top: 5px;">Nouvelle Fiche Budget<br>Pr??visionnel / Direction & Projet</a>
                    <br>
                    <a class="btn btn-outline btn_new btn-primary" href="<?php echo url_for('budgetprevglobal/new') ?>" style="text-align: center;height: 65px !important; width: 250px; font-size: 14px !important; margin-top: 5px;">Nouvelle Fiche Budget<br>Pr??visionnel Global</a>
                    <br>
                    <a target="_blank" class="btn btn-outline btn_new btn-success" href="<?php echo url_for('titrebudjet/imprimerListe?type=Budget Pr??visionnel / Direction & Projet') ?>" style="text-align: center; height: 65px !important; width: 250px; font-size: 14px !important; margin-top: 5px;">Imprimer Liste des Budgets<br>Pr??visionnels / Direction & Projet</a>
                    <br>
                    <a target="_blank" class="btn btn-outline btn_new btn-success" href="<?php echo url_for('titrebudjet/imprimerListe?type=Budget Pr??visionnel Global') ?>" style="text-align: center; height: 65px !important; width: 250px; font-size: 14px !important; margin-top: 5px;">Imprimer Liste des Budgets<br>Pr??visionnels Globaux</a>
                <?php else: ?>
                    <br>
                    <a target="_blank" class="btn btn-outline btn_new btn-success" href="<?php echo url_for('titrebudjet/imprimerListe?type=Final') ?>" style="text-align: center; height: 65px !important; width: 250px; font-size: 14px !important; margin-top: 10px;">Imprimer Liste<br>des Budgets Finaux</a>
                    <?php endif; ?>
            </div>
        </div>
    </div>
</div>