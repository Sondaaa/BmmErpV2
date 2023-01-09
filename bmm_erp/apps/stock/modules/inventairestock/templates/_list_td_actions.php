<td>
    <!--  <ul class="sf_admin_td_actions">
    <?php //echo $helper->linkToEdit($inventairestock, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php //echo $helper->linkToDelete($inventairestock, array(  'params' =>   array(  ),  'confirm' => 'Êtes-vous sûr ?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
      </ul>-->
    <a href="<?php echo url_for('inventairestock/detail?iddoc=') . $inventairestock->getId() ?>">Détail & Impression</a>
</td>
