<td class="tdbtn" >
  <ul class="sf_admin_td_actions" >
    <?php echo $helper->linkToEdit($article, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Modifier',)) ?>
    <?php echo $helper->linkToDelete($article, array(  'params' =>   array(  ),  'confirm' => 'Êtes-vous sûr ?',  'class_suffix' => 'delete',  'label' => 'Supprimer',)) ?>
  </ul>
</td>
