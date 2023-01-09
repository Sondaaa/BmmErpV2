<td>
    <ul class="sf_admin_td_actions">
        <li class="sf_admin_action_show">
            <a target="_blanc" href="<?php echo url_for('regimehoraire/voirFiche?id=' . $regimehoraire->getId()) ?>">Consulter</a>
        </li>
        <?php echo $helper->linkToEdit($regimehoraire, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
        <?php echo $helper->linkToDelete($regimehoraire, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
    </ul>
</td>
