<td>
    <ul class="sf_admin_td_actions">
        <?php echo $helper->linkToEdit($instrumentpaiment, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
        <?php if ($instrumentpaiment->getId() >= 6): ?>
            <?php echo $helper->linkToDelete($instrumentpaiment, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <?php endif; ?>
    </ul>
</td>
