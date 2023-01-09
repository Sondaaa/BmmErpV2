<td>
    <?php if ($corps->getId() > 2): ?>
        <ul class="sf_admin_td_actions">
            <?php echo $helper->linkToEdit($corps, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
            <?php echo $helper->linkToDelete($corps, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        </ul>
    <?php endif; ?>
</td>
