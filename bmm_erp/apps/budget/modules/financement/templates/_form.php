<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form">
    <?php echo form_tag_for($form, '@financement') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php //include_partial('financement/form_fieldset', array('financement' => $financement, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php include_partial('financement/form_fieldset', array('financement' => $financement, 'form' => $form ,'id_docachat'=>$id_docachat ,'id_marche' => $id_marche)) ?>

    <?php //include_partial('financement/form_actions', array('financement' => $financement, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</form>
</div>