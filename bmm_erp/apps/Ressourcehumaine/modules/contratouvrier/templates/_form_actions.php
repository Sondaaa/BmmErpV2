<ul class="sf_admin_actions">
    <?php if ($form->isNew()): ?>
        <?php // echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
        <li><input type="button" id="btnvaliderContratouvrier" style="margin-left: 15px;" value="Ajouter Fiche Contrat" ng-click="saveContratOuvrier();" class="btn btn-white btn-success"  ></li>
        <?php // echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>
        <?php // echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>
    <?php else: ?>
        <?php // echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
        <li><input type="button" id="btnvaliderContratouvrier" style="margin-left: 15px;" value="Ajouter Fiche Contrat" ng-click="saveContratOuvrier();" class="btn btn-white btn-success"  ></li>
        <?php //  echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>
        <?php // echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>
        <li class="sf_admin_action_edit">
            <a target="_blank" href="<?php echo url_for('contratouvrier/ImprimerFiche') . '?id=' . $contratouvrier->getId() ?>" style="margin-left: 15px;" class="btn btn-white btn-primary">Imprimer</a>
        </li>
    <?php endif; ?>
</ul>
