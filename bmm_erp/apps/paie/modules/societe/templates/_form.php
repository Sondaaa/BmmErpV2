<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form" ng-controller="CtrlPaie">
    <?php echo form_tag_for($form, '@societe') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('societe/form_fieldset', array('societe' => $societe, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('societe/form_actions', array('societe' => $societe, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</form>
</div>
