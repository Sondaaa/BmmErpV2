<td>
    <ul class="sf_admin_td_actions">
        <?php echo $helper->linkToEdit($situationadminouvrier, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
        <?php echo $helper->linkToDelete($situationadminouvrier, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
        <a data-target="#my-modal-situationouvrier" onclick="chargerOuvrierSituation('<?php echo $situationadminouvrier->getId(); ?>')" role="button" data-toggle="modal" target="_blanc" class="btn btn-xs btn-warning" style="margin-left: 10px"><i class="ace-icon fa fa-search bigger-110"></i> Ouvriers</a>
    </ul>
</td>
