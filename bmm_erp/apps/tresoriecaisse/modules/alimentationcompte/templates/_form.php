<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form">
  <?php // echo form_tag_for($form, '@alimentationcompte') ?>
    <?php // echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('alimentationcompte/form_fieldset', array('alimentationcompte' => $alimentationcompte, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php // include_partial('alimentationcompte/form_actions', array('alimentationcompte' => $alimentationcompte, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  <!--</form>-->
</div>

<style>
    
    .sf_admin_action_save{display: none;}
    
</style>