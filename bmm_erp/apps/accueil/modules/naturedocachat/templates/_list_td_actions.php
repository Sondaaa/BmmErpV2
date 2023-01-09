<td style="background-color: #ffffff;">
    <ul class="sf_admin_td_actions">
        <?php echo $helper->linkToEdit($naturedocachat, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>

        <?php if ($naturedocachat->getId() > 6) : ?>
            <?php echo $helper->linkToDelete($naturedocachat, array('params' =>   array(),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
        <?php endif; ?>
    </ul>
</td>