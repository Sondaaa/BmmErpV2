<td>
       <?php if($regroupementagents->getId()>9): ?>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($regroupementagents, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($regroupementagents, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
       <?php endif;?>
</td>
