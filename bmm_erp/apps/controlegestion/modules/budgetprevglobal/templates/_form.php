<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="row">
  <div class="col-md-12">
  <?php echo form_tag_for($form, '@budgetprevglobal') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('budgetprevglobal/form_fieldset', array('titrebudjet' => $titrebudjet, 'form' => $form,'configuration' => $configuration,'helper' => $helper, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

   
  </div>
  </form>
</div>
