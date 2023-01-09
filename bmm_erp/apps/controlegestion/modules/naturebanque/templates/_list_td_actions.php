<td>
    <ul class="sf_admin_td_actions">
        <?php if ($naturebanque->getId() > 2): ?>
            <?php echo $helper->linkToEdit($naturebanque, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
            <?php echo $helper->linkToDelete($naturebanque, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <?php endif; ?>
    </ul>
</td>
