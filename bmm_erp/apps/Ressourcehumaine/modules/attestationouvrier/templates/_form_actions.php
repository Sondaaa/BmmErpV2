<ul class="sf_admin_actions">
    <?php if ($form->isNew()): ?>
        <?php // echo $helper->linkToDelete($form->getObject(), array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
            <!--<li><input type="button"   id="btnvaliderattestationouvrier" style="margin-left: 15px;" value="Ajouter Attestation de travail" ng-click="saveAttestationouvrier()" class="btn btn-white btn-success"  ></li>-->
        <li><button style="margin-left: 15px;" ng-click="saveAttestationouvrier2()" class="btn btn-white btn-success">Ajouter Attestation de travail</button></li>

        <?php // echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>
        <?php // echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>
    <?php else: ?>
        <?php // echo $helper->linkToDelete($form->getObject(), array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
        <li><button type="button" style="margin-left: 15px;" ng-click="saveAttestationouvrier2()" class="btn btn-white btn-success">Modifier Attestation de travail</button></li>

        <?php // echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>
        <?php // echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>
    <?php endif; ?>
</ul>
