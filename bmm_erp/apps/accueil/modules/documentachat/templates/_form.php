<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="row">
  <div class="col-md-12" ng-controller="myCtrlLabo">
  <?php echo form_tag_for($form, '@documentachat') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('documentachat/form_fieldset', array('documentachat' => $documentachat, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset,'idtype'=>$idtype)) ?>
    <?php endforeach; ?>

    <?php include_partial('documentachat/form_actions', array('documentachat' => $documentachat, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  
  </div>
  </form>
</div>
