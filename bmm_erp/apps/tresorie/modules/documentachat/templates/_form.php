<div class="sf_admin_form" >
   
    <?php echo $form->renderHiddenFields(false) ?>

    <input type="hidden" ng-value="<?php if (isset($_REQUEST['idtype'])) echo $_REQUEST['idtype']; else echo "6" ?>" ng-model="typedocid.text" id="idtypedoc" value="<?php if (isset($_REQUEST['idtype'])) echo $_REQUEST['idtype']; else echo "6" ?>">

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('documentachat/form_fieldset', array('documentachat' => $documentachat, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('documentachat/form_actions', array('documentachat' => $documentachat, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </form>
</div>
