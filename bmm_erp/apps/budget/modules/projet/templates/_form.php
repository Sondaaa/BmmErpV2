<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="row" ng-controller="CtrlShowchilds">
  <div class="col-md-12" >
  <?php echo form_tag_for($form, '@projet') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('projet/form_fieldset', array('projet' => $projet, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('projet/form_actions', array('projet' => $projet, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  
  </div>
  </form>
</div>
