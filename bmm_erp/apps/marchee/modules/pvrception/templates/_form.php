<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form" ng-controller="CtrlTransfer">
    <?php echo form_tag_for($form, '@pvrception') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('pvrception/form_fieldset', array('pvrception' => $pvrception, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset, 'type' => $type, 'id' => $id)) ?>
    <?php endforeach; ?>

    <?php include_partial('pvrception/form_actions', array('pvrception' => $pvrception, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</form>
</div>
