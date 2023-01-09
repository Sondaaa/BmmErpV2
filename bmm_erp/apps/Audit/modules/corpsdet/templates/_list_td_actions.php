<td>
    <?php if ($corpsdet->getId() > 4): ?>
        <ul class="sf_admin_td_actions">
            <?php echo $helper->linkToEdit($corpsdet, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
            <?php echo $helper->linkToDelete($corpsdet, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        </ul>
    <?php endif; ?>
</td>
