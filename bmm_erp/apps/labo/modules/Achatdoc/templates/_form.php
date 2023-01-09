<?php use_stylesheets_for_form($form)?>
<?php use_javascripts_for_form($form)?>

<?php
$idtype=4;
if(!$form->getObject()->isNew())
$idtype= $form->getObject()->getIdTypedoc();
?>
<div class="sf_admin_form"  ng-controller="myCtrlLabo">
  <div class="col-md-12">
  <?php echo form_tag_for($form, '@documentachat_Achatdoc') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif;?>
<?php if (!$form->isNew()) {
    $idtype = $form->getObject()->getIdTypedoc();
}?>
    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('Achatdoc/form_fieldset', array('documentachat' => $documentachat, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset, 'idtype' => $idtype))?>
    <?php endforeach;?>

    <?php include_partial('Achatdoc/form_actions', array('documentachat' => $documentachat, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper))?>

  </div>
  </form>
</div>
