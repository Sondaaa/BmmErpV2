<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="row" ng-controller="myCtrldoc">
   
  <div class="col-md-12">
  <?php echo form_tag_for($form, '@documentachat_docachat') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('docachat/form_fieldset', array('documentachat' => $documentachat, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('docachat/form_actions', array('documentachat' => $documentachat, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  
  </div>
  </form>
</div>
