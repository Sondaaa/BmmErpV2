<td>
    <ul class="sf_admin_td_actions">
        <li><a class="btn btn-white btn-success" href="<?php echo url_for('budgetprevglobal/detailbudget') . '?id=' . $titrebudjet->getId() ?>">
                <i class="fa fa-file-pdf-o"></i> Détail & Exporter Pdf
            </a></li>
        <li><?php echo $helper->linkToEdit($titrebudjet, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?></li>
        <li><?php echo $helper->linkToDelete($titrebudjet, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?></li>
    </ul> 
</td>