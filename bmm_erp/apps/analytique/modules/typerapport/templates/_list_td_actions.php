<td>
    <ul class="sf_admin_td_actions">
        <?php echo $helper->linkToEdit($typerapport, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
        <?php if ($typerapport->getId() > 6): ?>
            <?php echo $helper->linkToDelete($typerapport, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <?php endif; ?>
    </ul>
</td>
