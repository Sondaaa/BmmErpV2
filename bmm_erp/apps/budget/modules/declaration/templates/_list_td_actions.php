<td>
    <ul class="sf_admin_td_actions">
        <li><a href="<?php echo url_for('declaration/show?id=' . $declaration->getId()) ?>" class="btn btn-xs btn-success">Afficher</a></li>
            <?php //echo $helper->linkToEdit($declaration, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
            <?php if (!$declaration->getEtat()): ?>
                <?php echo $helper->linkToDelete($declaration, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
            <?php endif; ?>
    </ul>
</td>
