<td style="width:42%;">
    <ul class="sf_admin_td_actions">
        <li class="sf_admin_action_edit">
            <a href="<?php echo url_for('rapportcontrole/show?id=' . $rapportcontrole->getId()); ?>" class="btn btn-success">Afficher</a>
        </li>
        <li class="sf_admin_action_edit">
            <a href="<?php echo url_for('rapportcontrole/saisir?id=' . $rapportcontrole->getId()); ?>" class="btn btn-success">Saisir</a>
        </li>
        <li class="sf_admin_action_edit">
            <a target="_blank" href="<?php echo url_for('rapportcontrole/imprimer?id=' . $rapportcontrole->getId()); ?>" class="btn btn-success">Imprimer</a>
        </li>
        <?php echo $helper->linkToEdit($rapportcontrole, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
        <?php echo $helper->linkToDelete($rapportcontrole, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
    </ul>
</td>
