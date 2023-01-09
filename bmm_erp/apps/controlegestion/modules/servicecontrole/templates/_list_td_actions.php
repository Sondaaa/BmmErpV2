<td>
    <ul class="sf_admin_td_actions">
        <?php if ($servicecontrole->getId() > 4): ?>
            <?php echo $helper->linkToEdit($servicecontrole, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
            <?php echo $helper->linkToDelete($servicecontrole, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <?php endif; ?>
    </ul>
</td>
