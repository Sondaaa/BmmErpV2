<td>
    <?php if ($avis->getId() != 1 && $avis->getId() != 6): ?>
        <ul class="sf_admin_td_actions">
            <?php echo $helper->linkToEdit($avis, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
            <?php echo $helper->linkToDelete($avis, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        </ul>
    <?php endif; ?>
</td>
