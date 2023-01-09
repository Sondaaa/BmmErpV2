<ul class="sf_admin_actions">
    <?php if ($form->isNew()): ?>
        <?php echo $helper->linkToDelete($form->getObject(), array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
        <li><input type="button"   id="btnvaliderBesoins" style="margin-left: 15px;" value="Ajouter Besoins de Formation " ng-click="saveBesoins();" class="btn btn-white btn-success"  ></li>
    <?php else: ?>
        <?php echo $helper->linkToDelete($form->getObject(), array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
        <li><input type="button"   id="btnvaliderBesoins" style="margin-left: 15px;" value="Ajouter Besoins de Formation " ng-click="saveBesoins();" class="btn btn-white btn-success"  ></li>
    <?php endif; ?>
</ul>
