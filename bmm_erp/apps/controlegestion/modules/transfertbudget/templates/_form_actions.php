<ul class="sf_admin_actions">
    <?php if ($form->isNew()): ?>
        <?php //echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Êtes-vous sûr ?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
        <?php echo $helper->linkToSave($form->getObject(), array('params' => array(), 'class_suffix' => 'save', 'label' => 'Save',)) ?>
    <?php else: ?>
        <?php //echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Êtes-vous sûr ?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
        <?php echo $helper->linkToSave($form->getObject(), array('params' => array(), 'class_suffix' => 'save', 'label' => 'Save',)) ?>
    <?php endif; ?>
</ul>