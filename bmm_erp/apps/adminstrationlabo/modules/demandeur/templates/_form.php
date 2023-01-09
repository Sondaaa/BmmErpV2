<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="row">
  <div class="col-md-12">
  <?php echo form_tag_for($form, '@demandeur') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php if($form->getObject()->isNew()):?>
        <?php include_partial('demandeur/form_fieldset_new', array('demandeur' => $demandeur, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
     <?php else:?>
      <?php include_partial('demandeur/form_fieldset', array('demandeur' => $demandeur, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    
      <?php endif?>
    <?php endforeach; ?>
    <?php if(!$form->getObject()->isNew()):?>
      <?php include_partial('demandeur/form_actions', array('demandeur' => $demandeur, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  
      <?php endif?>
    
  </div>
  </form>
</div>
