<td>
    <?php if($typeconge->getId()>7): ?>
  <ul class="sf_admin_td_actions">
      
    <?php echo $helper->linkToEdit($typeconge, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($typeconge, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
    <?php endif;?>
</td>
