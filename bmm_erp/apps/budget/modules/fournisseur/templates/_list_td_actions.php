<td>
    <ul class="sf_admin_td_actions">
        <?php // echo $helper->linkToEdit($fournisseur, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
        <?php // echo $helper->linkToDelete($fournisseur, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
        <li class="sf_admin_action_affect" style="margin-right:2%"><a href="<?php echo url_for('fournisseur/certificat?id=' . $fournisseur->getId()); ?>"><i class="ace-icon fa fa-edit bigger-110"></i> Certificat R.S</a></li>
    </ul>
</td>
