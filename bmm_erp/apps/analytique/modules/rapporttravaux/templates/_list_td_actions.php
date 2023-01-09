<td style="width: 40%;">
    <ul class="sf_admin_td_actions">
        <li class="sf_admin_action_affect" style="margin:2%"><a href="<?php echo url_for('rapporttravaux/saisir?id=' . $rapporttravaux->getId()) ?>">Saisir</a></li>
        <?php if ($rapporttravaux->getIdType() != 2): ?>
            <li class="sf_admin_action_show" style="margin:2%"><a href="<?php echo url_for('rapporttravaux/imprimer?id=' . $rapporttravaux->getId()) ?>" target="_blank">Imprimer</a></li>
        <?php else: ?>
            <li class="sf_admin_action_show" style="margin:2%"><a href="<?php echo url_for('rapporttravaux/imprimerArticle?id=' . $rapporttravaux->getId()) ?>" target="_blank">Imprimer</a></li>
            <?php endif; ?>
            <?php echo $helper->linkToEdit($rapporttravaux, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
            <?php echo $helper->linkToDelete($rapporttravaux, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
    </ul>
</td>
