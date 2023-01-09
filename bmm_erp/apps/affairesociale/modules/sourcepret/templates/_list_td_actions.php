<td>
     <?php if($sourcepret->getId()>3): ?>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($sourcepret, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($sourcepret, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
     <?php endif;?>
</td>
