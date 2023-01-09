<ul class="sf_admin_actions">
    <?php if ($form->isNew()): ?>
        <?php // echo $helper->linkToDelete($form->getObject(), array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
        <?php // echo $helper->linkToSave($form->getObject(), array('params' => array(), 'class_suffix' => 'save', 'label' => 'Save',)) ?>
        <?php // echo $helper->linkToSaveAndAdd($form->getObject(), array('params' => array(), 'class_suffix' => 'save_and_add', 'label' => 'Save and add',)) ?>
        <li class="sf_admin_action_save"><a onclick="enregistrer('')">Enregistrer</a></li>
    <?php else: ?>
        <?php // echo $helper->linkToDelete($form->getObject(), array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
        <?php // echo $helper->linkToSave($form->getObject(), array('params' => array(), 'class_suffix' => 'save', 'label' => 'Save',)) ?>
        <?php // echo $helper->linkToSaveAndAdd($form->getObject(), array('params' => array(), 'class_suffix' => 'save_and_add', 'label' => 'Save and add',)) ?>
        <li class="sf_admin_action_save"><a onclick="enregistrer('<?php echo $form->getObject()->getId() ?>')">Enregistrer</a></li>
        <li class="sf_admin_action_save"><a href="<?php echo url_for('profil/editModule?id=' . $form->getObject()->getId()) ?>">Affecter Module</a></li>
        <?php endif; ?>
</ul>
