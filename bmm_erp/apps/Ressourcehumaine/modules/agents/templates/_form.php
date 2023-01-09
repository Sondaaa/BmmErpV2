<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form" id="formrh" ng-controller="CtrlRessourcehumaine">
    <?php echo form_tag_for($form, '@agents') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('agents/form_fieldset', array('agents' => $agents, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset,'id_regerouppement' => $id_regerouppement)) ?>
    <?php endforeach; ?>

<?php include_partial('agents/form_actions', array('agents' => $agents, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>


</form>
</div>
