<td>
    <ul class="sf_admin_td_actions">
        <?php // echo $helper->linkToEdit($paie, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
        <button type="button" onclick="document.location.href = '<?php echo url_for('paie/edit') . '?id=' . $paie->getId() ?>'" class="btn btn-xs btn-primary">
            <i class="ace-icon fa fa-eye bigger-110"></i> Afficher</button>   
            <?php echo $helper->linkToDelete($paie, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
    </ul>
</td>
