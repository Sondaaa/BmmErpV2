<td>
    <ul class="sf_admin_td_actions">
        <li class="sf_admin_action_show"><a href="<?php echo url_for('annexebudget/show') . '?id=' . $annexebudget->getId() ?>">Afficher</a></li>
        <?php if (($annexebudget->getId() > 14) && $annexebudget->getAnnexebudgetrubrique()->count() == 0): ?>
            <?php echo $helper->linkToEdit($annexebudget, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
            <?php echo $helper->linkToDelete($annexebudget, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <?php endif; ?>
    </ul>
</td>
