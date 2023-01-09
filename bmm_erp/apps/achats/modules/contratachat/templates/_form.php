<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form" ng-controller="CtrlContrat">
  <?php echo form_tag_for($form, '@contratachat') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('contratachat/form_fieldset', array('contratachat' => $contratachat, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset,'iddoc' => $iddoc)) ?>
    <?php endforeach; ?>

    <?php include_partial('contratachat/form_actions', array('contratachat' => $contratachat, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
</div>
