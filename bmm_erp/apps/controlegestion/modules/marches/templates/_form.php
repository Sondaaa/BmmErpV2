<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form" ng-controller="myCtrlmarche">
  <?php echo form_tag_for($form, '@marches') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('marches/form_fieldset', array('marches' => $marches, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper,'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>


  </form>
</div>
