<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form" ng-controller="myCtrlTransfertbudget" >
  <?php echo form_tag_for($form, '@transfertbudget') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('transfertbudget/form_fieldset', array('transfertbudget' => $transfertbudget, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset,'configuration' => $configuration, 'helper' => $helper)) ?>
    <?php endforeach; ?>

    <?php //include_partial('transfertbudget/form_actions', array('transfertbudget' => $transfertbudget, 'form' => $form, )) ?>
  </form>
</div>
