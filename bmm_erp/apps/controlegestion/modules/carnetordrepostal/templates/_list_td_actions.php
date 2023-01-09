<td>
    <ul class="sf_admin_td_actions">
        <?php //echo $helper->linkToEdit($carnetordrepostal, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
        <?php //echo $helper->linkToDelete($carnetordrepostal, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <li><a href="<?php echo url_for('papierordrepostal/index?idordre=' . $carnetordrepostal->getId()) ?>">+Détail & Ordres</a></li>
    </ul>
</td>
