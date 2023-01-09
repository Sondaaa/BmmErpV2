<td>
    <?php if ($pret->getId() > 6): ?>
        <ul class="sf_admin_td_actions">
            <?php echo $helper->linkToEdit($pret, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
            <?php echo $helper->linkToDelete($pret, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        </ul>
    <?php endif; ?>
</td>
