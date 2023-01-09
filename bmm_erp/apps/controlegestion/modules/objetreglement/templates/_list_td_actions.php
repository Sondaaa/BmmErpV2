<td>
    <ul class="sf_admin_td_actions">
        <?php if ($objetreglement->getId() > 4): ?>
            <?php echo $helper->linkToEdit($objetreglement, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
            <?php echo $helper->linkToDelete($objetreglement, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <?php endif; ?>
    </ul>
</td>
