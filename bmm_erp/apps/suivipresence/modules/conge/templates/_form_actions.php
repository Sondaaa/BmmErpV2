<ul class="sf_admin_actions">
    <?php if ($form->isNew()): ?>
        <?php echo $helper->linkToDelete($form->getObject(), array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
        <li><input type="button"   id="btnvaliderConge" style="margin-left: 15px;" value="Ajouter Demande Congé " ng-click="saveDemandeConge();" class="btn btn-white btn-success"></li>
        <?php // echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>
        <?php // echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>
    <?php else: ?>
        <?php // echo $helper->linkToDelete($form->getObject(), array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
        <li><input type="button" id="btnvaliderConge" style="margin-left: 15px;" value="Ajouter Demande Congé " ng-click="saveDemandeConge();" class="btn btn-white btn-success"  ></li>
        <li>
            <button type="button" style="margin-left: 620px;" onclick="document.location.href = '<?php echo url_for('conge/suiviconge') . '?iddoc=' . $conge->getId() ?>'" class="btn btn-white btn-success">
                <i class="fa fa-long-arrow-right"></i>Suivi Consommation Congé </button>
        </li>
        <?php // echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>
        <?php // echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>
    <?php endif; ?>
</ul>
