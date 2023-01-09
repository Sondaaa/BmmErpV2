<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form" ng-controller="CtrlFormEngagement">
  <?php echo form_tag_for($form, '@documentbudget') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('documentbudget/form_fieldset', array('documentbudget' => $documentbudget, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php // include_partial('documentbudget/form_actions', array('documentbudget' => $documentbudget, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
</div>