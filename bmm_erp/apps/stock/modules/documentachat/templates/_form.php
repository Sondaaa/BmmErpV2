<div class="sf_admin_form" ng-controller="myCtrlbonstock">

    <?php echo $form->renderHiddenFields(false) ?>
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php if (($form->getObject()->isNew() && $_REQUEST['idtype'] == 10) || (!$form->getObject()->isNew() && $form->getObject()->getIdTypedoc())) { ?>  
            <?php if ($form->getObject()->isNew()) { ?>
                <?php include_partial('documentachat/form_fieldset', array('documentachat' => $documentachat, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset, 'idfrs' => $idfrs, 'iddocparent' => $iddocparent)) ?>
            <?php } ?>
            <?php if (!$form->getObject()->isNew() && $form->getObject()->getIdEtatdoc() == 17) { ?>
                <?php include_partial('documentachat/formfieldsetvalider', array('documentachat' => $documentachat, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
            <?php } ?>     
        <?php } ?>
        <?php if ($_REQUEST['idtype'] == 11) { ?>       
            <?php include_partial('documentachat/form_fieldsetsortie', array('documentachat' => $documentachat, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
        <?php } ?>
        <?php if ($_REQUEST['idtype'] == 13) { ?>       
            <?php include_partial('documentachat/formtransfert', array('documentachat' => $documentachat, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
        <?php } ?>
        <?php if ($_REQUEST['idtype'] == 12) { ?>       
            <?php include_partial('documentachat/form_retour', array('documentachat' => $documentachat, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
        <?php } ?>
    <?php if ($_REQUEST['idtype'] == 14) { ?>       
            <?php include_partial('documentachat/form_avoir', array('documentachat' => $documentachat, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
        <?php } ?>
    <?php endforeach; ?>

    <?php include_partial('documentachat/form_actions', array('documentachat' => $documentachat, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</form>
</div>
