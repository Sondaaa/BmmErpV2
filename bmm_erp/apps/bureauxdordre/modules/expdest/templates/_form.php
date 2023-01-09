<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form" ng-controller="Ctrlexpdest" >
  <?php echo form_tag_for($form, '@expdest') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('expdest/form_fieldset', array('expdest' => $expdest, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('expdest/form_actions', array('expdest' => $expdest, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
</div>