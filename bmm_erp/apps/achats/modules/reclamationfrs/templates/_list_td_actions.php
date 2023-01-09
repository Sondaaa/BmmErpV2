<td>
    <ul class="sf_admin_td_actions">
        <li>
            <a href="<?php echo url_for('Documents/Imprimerreclamation?iddoc=') . $reclamationfrs->getId() ?>" class="btn btn-xs btn-primary" ng-model="BtnExporter" target="_blanc"><i class="ace-icon fa fa-print"></i> Exporter PDF</a> 
        </li>
        <?php echo $helper->linkToEdit($reclamationfrs, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
        <?php echo $helper->linkToDelete($reclamationfrs, array('params' => array(), 'confirm' => 'Êtes-vous sûr ?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
    </ul>
</td>
