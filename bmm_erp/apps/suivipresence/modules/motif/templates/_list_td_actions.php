<td>
    <ul class="sf_admin_td_actions">
        <?php if ($motif->getId() != 3): ?>
            <?php echo $helper->linkToEdit($motif, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
            <?php echo $helper->linkToDelete($motif, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <?php endif; ?>
    </ul>
</td>
