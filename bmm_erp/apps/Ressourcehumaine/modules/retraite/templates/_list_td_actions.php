<td>
    <?php if($retraite->getId()>2): ?>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($retraite, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($retraite, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
       <?php endif; ?>
</td>
