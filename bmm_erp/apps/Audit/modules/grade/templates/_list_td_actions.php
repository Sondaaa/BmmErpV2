<td>
    <?php if ($grade->getId() > 22): ?>
        <ul class="sf_admin_td_actions">
            <?php echo $helper->linkToEdit($grade, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
            <?php echo $helper->linkToDelete($grade, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        </ul>
    <?php endif; ?>
</td>
