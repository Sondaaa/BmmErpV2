<ul class="sf_admin_actions">
    <?php if ($form->isNew()): ?>
        <?php //echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
        <!--        <li>
                    <input type="submit" style="margin-left: 930px" id="btnvaliderPersonnelle" value="Mise à jour" <?php // if ($form->getObject()->isNew()) {   ?> class="btn btn-outline btn-danger  disabledbutton pull-right "  <?php // }   ?>>
                </li>-->
        <?php //echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>
        <?php //echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>
    <?php else: ?>
        <?php //echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
        <!--        <li>
                    <input type="submit" style="margin-left: 930px" id="btnvaliderPersonnelle" value="Mise à jour" <?php // if ($form->getObject()->isNew()) {   ?> class="btn btn-outline btn-danger  disabledbutton pull-right "  <?php // }   ?>>
                </li>-->
        <?php //echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>
        <?php //echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>
    <?php endif; ?>
    <li>
        <a target="_blank" href="<?php echo url_for('agents/ImprimerFiche') . '?id=' . $agents->getId() ?>" class="btn btn-white btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
    </li>
</ul>