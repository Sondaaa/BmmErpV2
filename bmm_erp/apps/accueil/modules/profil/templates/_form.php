<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form">
  <?php // echo form_tag_for($form, '@profil') ?>
    <?php // echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('profil/form_fieldset', array('profil' => $profil, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('profil/form_actions', array('profil' => $profil, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  <!--</form>-->
</div>
