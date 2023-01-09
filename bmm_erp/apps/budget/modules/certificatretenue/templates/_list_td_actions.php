<td>
    <ul class="sf_admin_td_actions">
        <li>
            <a class="btn btn-xs btn-primary" target="_blanc" href="<?php echo url_for('certificatretenue/show?id=' . $certificatretenue->getId()); ?>">
                Afficher
            </a>
        </li>
        <?php //echo $helper->linkToEdit($certificatretenue, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
        <?php echo $helper->linkToDelete($certificatretenue, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
    </ul>
</td>
