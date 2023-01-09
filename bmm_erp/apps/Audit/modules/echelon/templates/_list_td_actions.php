
<td>
 <?php if($echelon->getId()>25): ?>
    <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($echelon, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($echelon, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
     <?php endif; ?>
</td>
