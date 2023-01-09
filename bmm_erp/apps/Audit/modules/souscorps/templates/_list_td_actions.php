
<td>
 <?php if($souscorps->getId()>10): ?>
    <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($souscorps, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($souscorps, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
    <?php endif;?>
</td>
