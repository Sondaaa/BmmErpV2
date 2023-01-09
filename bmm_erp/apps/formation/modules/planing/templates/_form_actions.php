<ul class="sf_admin_actions">
    <?php if ($form->isNew()): ?>
        <?php // echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
        <li><input type="button"   id="btnvalider2" style="margin-left: 15px;" value="Ajouter Planning Prévisionnel " ng-click="saveEntete();" class="btn btn-white btn-success"></li>
    <!--        <input type="button"   id="btnvalider" style="margin-left: 15px;"  value="Transferer en Planning Finale " ng-click="transfererPlaning(<?php //echo $planing->getId()  ?>)" class="btn btn-white btn-success"  >-->
        <li>
            <button type="button" style="margin-left: 15px;" onclick="document.location.href = '<?php echo url_for('planing/showdocument') . '?iddoc=' . $planing->getId() ?>'" class="btn btn-white btn-success">
                <i class="fa fa-long-arrow-right"></i> Transferer en Planning Finale </button>
        </li>
        <?php // echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>
        <?php // echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>
    <?php else: ?>
        <?php // echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
        <li><input type="button"   id="btnvalider2" style="margin-left: 15px;" value="Ajouter Planning Prévisionnelle " ng-click="saveEntete();" class="btn btn-white btn-success"></li>
    <!--        <input type="button"   id="btnvalider" style="margin-left: 15px;"  value="Transferer en Planning Finale " ng-click="transfererPlaning(<?php //echo $planing->getId()  ?>)" class="btn btn-white btn-success"  >-->
        <li>
            <button type="button" style="margin-left: 15px;" onclick="document.location.href = '<?php echo url_for('planing/showRealisation') . '?iddoc=' . $planing->getId() ?>'" class="btn btn-white btn-success">
                <i class="fa fa-long-arrow-right"></i>Transferer en Planning Finale</button>
        </li>
        <?php // echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>
        <?php // echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>
    <?php endif; ?>
</ul>
