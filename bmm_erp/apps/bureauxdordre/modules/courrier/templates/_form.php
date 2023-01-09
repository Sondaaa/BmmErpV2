<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<div class="sf_admin_form" ng-controller="CtrlCourrier" <?php if ($form->getObject()->isNew()) { ?>ng-init="NumeroCourrier()" <?php } ?>>
  <?php echo form_tag_for($form, '@courrier') ?>
    <?php echo $form->renderHiddenFields(false) ?>
    <input type="hidden" name="idtype" id="typecourrier" value="<?php
                if (isset($_REQUEST['idtype']))
                    echo $_REQUEST['idtype'];
                else
                if (!$form->getObject()->isNew())
                    echo $form->getObject()->getIdType();
                ?>">
      <input type="hidden" id="iduser" value="<?php echo $sf_user->getAttribute('userB2m')->getId(); ?>">
      <input type="hidden" id="objet" value="<?php
                if (!$form->getObject()->isnew())
                    echo "1";
                else
                    echo '0';
                ?>">
    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('courrier/form_fieldset', array('expdest' => $courrier, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('courrier/form_actions', array('expdest' => $courrier, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
</div>

