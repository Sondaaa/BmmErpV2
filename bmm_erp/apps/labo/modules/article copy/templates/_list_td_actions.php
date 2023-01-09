<td class="tdbtn">
  <ul class="sf_admin_td_actions">
    <?php $user= $sf_user->getAttribute('userB2m');?>
    <?php     if ($article->getIdUser() == $user->getId()) { ?>
      <?php echo $helper->linkToEdit($article, array('params' =>   array(),  'class_suffix' => 'edit',  'label' => 'Modifier',)) ?>
     
      <?php echo $helper->linkToDelete($article, array('params' =>   array(),  'confirm' => 'Êtes-vous sûr ?',  'class_suffix' => 'delete',  'label' => 'Supprimer',)) ?>
    <?php } ?>
    <?php echo $helper->linkToEdit($article, array('params' =>   array(),  'class_suffix' => 'edit',  'label' => 'Afficher',)) ?>
     


  </ul>
</td>