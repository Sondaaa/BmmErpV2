<td>
    <ul class="sf_admin_td_actions">
        <li class="sf_admin_action_affect" style="margin:2%"><a href="<?php echo url_for('repartitionsalaireouvrier/saisir?id=' . $repartitionsalaireouvrier->getId()) ?>">Saisir Salaire</a></li>
        <li class="sf_admin_action_show" style="margin:2%"><a href="<?php echo url_for('repartitionsalaireouvrier/imprimer?id=' . $repartitionsalaireouvrier->getId()) ?>" target="_blank">Imprimer</a></li>
        <li class="sf_admin_action_show" style="margin:2%"><a href="<?php echo url_for('repartitionsalaireouvrier/imprimerRecap?id=' . $repartitionsalaireouvrier->getId()) ?>" target="_blank">Récapitulatif</a></li>
            <?php echo $helper->linkToEdit($repartitionsalaireouvrier, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
            <?php echo $helper->linkToDelete($repartitionsalaireouvrier, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
    </ul>
</td>
