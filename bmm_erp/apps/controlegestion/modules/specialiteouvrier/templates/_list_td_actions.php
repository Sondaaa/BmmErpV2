<td>
    <ul class="sf_admin_td_actions">
        <?php // echo $helper->linkToEdit($specialiteouvrier, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
        <?php // echo $helper->linkToDelete($specialiteouvrier, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <a data-target="#my-modal-specialiteouvrier" onclick="chargerOuvrierSpecialite('<?php echo $specialiteouvrier->getId(); ?>')" role="button" data-toggle="modal" target="_blanc" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-search bigger-110"></i> Ouvriers</a>
    </ul>
</td>
