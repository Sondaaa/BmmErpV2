<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form" ng-controller="myCtrlbudget">
    <?php echo form_tag_for($form, '@titrebudjet_Prototype') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('Prototype/form_fieldset', array('titrebudjet' => $titrebudjet, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset, 'prototype' => 'Prototype')) ?>
    <?php endforeach; ?>
</form>
</div>