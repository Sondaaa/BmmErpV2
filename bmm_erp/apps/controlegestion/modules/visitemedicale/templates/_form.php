<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<div class="sf_admin_form" ng-controller="CtrlAffairesociale">
  <?php echo form_tag_for($form, '@visitemedicale') ?>
    <?php echo $form->renderHiddenFields(false) ?>
    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>
    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('visitemedicale/form_fieldset', array('visitemedicale' => $visitemedicale, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>
    <?php include_partial('visitemedicale/form_actions', array('visitemedicale' => $visitemedicale, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
</div>
