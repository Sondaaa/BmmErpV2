<td>
  <ul class="sf_admin_td_actions">
    <?php // echo $helper->linkToEdit($chantier, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php // echo $helper->linkToDelete($chantier, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
      <a data-target="#my-modal-chantierouvrier" onclick="chargerOuvrierChantier('<?php echo $chantier->getId(); ?>')" role="button" data-toggle="modal" target="_blanc" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-search bigger-110"></i> Ouvriers</a>
  </ul>
</td>
