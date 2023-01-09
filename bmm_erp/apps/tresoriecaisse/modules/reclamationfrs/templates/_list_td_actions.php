<td>
    <ul class="sf_admin_td_actions">
        <?php echo $helper->linkToEdit($reclamationfrs, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
        <?php echo $helper->linkToDelete($reclamationfrs, array('params' => array(), 'confirm' => 'Êtes-vous sûr ?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <li>
            <a  href="<?php echo url_for('Documents/Imprimerreclamation?iddoc=') . $reclamationfrs->getId() ?>" class="btn btn-primary btn-xs " style="margin-left: 2px" ng-model="BtnExporter"  target="_blanc">
                <i class="ace-icon fa fa-print"></i> Exporter PDF</a> 
        </li>
    </ul>
</td>