<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form" ng-controller="CtrlParcour">
  <?php echo form_tag_for($form, '@parcourcourier') ?>
    <?php echo $form->renderHiddenFields(false) ?>
    <input  type="hidden"  id="idexpparcour" value="<?php if($form->getObject()->isNew()) echo $sf_user->getAttribute('userB2m')->getId(); else echo "";  ?>">
  
        <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('parcourcourier/form_fieldset', array('parcourcourier' => $parcourcourier,'vartypecourrier'=>$vartypecourrier, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('parcourcourier/form_actions', array('parcourcourier' => $parcourcourier, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
</div>
