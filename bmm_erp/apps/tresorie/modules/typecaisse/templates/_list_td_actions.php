<td>
    <?php if ($typecaisse->getId() > 2): ?>
        <ul class="sf_admin_td_actions">
            <?php echo $helper->linkToEdit($typecaisse, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
            <?php echo $helper->linkToDelete($typecaisse, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        </ul>
    <?php endif; ?>
</td>
