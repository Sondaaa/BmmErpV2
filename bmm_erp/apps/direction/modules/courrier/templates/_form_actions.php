<ul class="sf_admin_actions">
<?php if ($form->isNew()): ?>
  <?php echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Êtes-vous sûr ?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
 <li class="sf_admin_action_list" style="display: inline;">
     <a href="<?php  echo url_for('courrier/index').'?idtype='.$_REQUEST['idtype'] ?>" class="btn btn-outline btn-success">
         Retour à la liste
     </a>
 </li>

  <?php echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>
  <?php //echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>
<?php else: ?>
 <li class="sf_admin_action_list" style="display: inline;">
     <a href="<?php  echo url_for('courrier/index').'?idtype='.$form->getObject()->getIdType() ?>" class="btn btn-outline btn-success">
         Retour à la liste
     </a>
 </li><?php echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>
  <?php //echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>
<?php endif; ?>
</ul>
