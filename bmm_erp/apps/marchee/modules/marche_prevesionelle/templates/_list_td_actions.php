<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($marche_prevesionelle, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <li>
      <a target="__blank" href="<?php echo url_for('@marche_prevesionelle').'/show/?id='.$marche_prevesionelle->getId()?>" class="btn btn-sm btn-info" style="margin-left: 2px;">
         Details & Imprimer
      </a>
    </li>
    <?php echo $helper->linkToDelete($marche_prevesionelle, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
</td>
