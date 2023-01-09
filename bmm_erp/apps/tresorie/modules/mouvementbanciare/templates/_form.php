<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form" ng-controller="CtrlMouvement">
  <?php echo form_tag_for($form, '@mouvementbanciare') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('mouvementbanciare/form_fieldset', array('mouvementbanciare' => $mouvementbanciare, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset,'id'=>$id ,'type'=>$type )) ?>
    <?php endforeach; ?>

    <?php include_partial('mouvementbanciare/form_actions', array('mouvementbanciare' => $mouvementbanciare, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
</div>