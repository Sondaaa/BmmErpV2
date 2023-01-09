<ul class="sf_admin_actions" >
    <?php if ($form->isNew()): ?>
        <?php // echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
        <li><button  id="btnvaliderdemande" style="margin-left: 15px;"  ng-click="saveDemandeDevoirFicheir();" class="btn btn-white btn-success"  >Ajouter Demande </button>
        </li>

        <?php // echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>
        <?php //echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>
    <?php else: ?>
        <?php //echo $helper->linkToDelete($form->getObject(), array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
        <li><button   id="btnvaliderdemande" style="margin-left: 15px;" ng-click="saveDemandeDevoirFicheir();" class="btn btn-white btn-success"  >Modifier Demande </button></li>

        <?php // echo $helper->linkToSave($form->getObject(), array('params' => array(), 'class_suffix' => 'save', 'label' => 'Save',)) ?>
        <?php //echo $helper->linkToSaveAndAdd($form->getObject(), array('params' => array(), 'class_suffix' => 'save_and_add', 'label' => 'Save and add',)) ?>
    <?php endif; ?>
</ul>
