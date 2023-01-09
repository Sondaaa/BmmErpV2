<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form" ng-controller="CtrlFacturatioin">
  <?php echo form_tag_for($form, '@lignemouvementfacturation') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('lignemouvementfacturation/form_fieldset', array('lignemouvementfacturation' => $lignemouvementfacturation, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset,'id'=>$id)) ?>
    <?php endforeach; ?>

    <?php include_partial('lignemouvementfacturation/form_actions', array('lignemouvementfacturation' => $lignemouvementfacturation, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
</div>