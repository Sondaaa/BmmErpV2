<td>
    <ul class="sf_admin_td_actions">
        <li class="sf_admin_action_affect" style="margin:2%"><a href="<?php echo url_for('repartitioncharge/genererUnite?id=' . $repartitioncharge->getId()) ?>">Répartir par Unité</a></li>
        <?php if ($repartitioncharge->getMontant() != 0): ?>
            <li class="sf_admin_action_affect" style="margin:2%"><a href="<?php echo url_for('repartitioncharge/showTableau?id=' . $repartitioncharge->getId()) ?>">Tableau</a></li>
            <?php endif; ?>
            <?php echo $helper->linkToEdit($repartitioncharge, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
            <?php echo $helper->linkToDelete($repartitioncharge, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
    </ul>
</td>
