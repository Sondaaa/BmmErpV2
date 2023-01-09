<td style="width: 45%;">
    <ul class="sf_admin_td_actions">
        <li class="sf_admin_action_affect"><a href="<?php echo url_for('fraisgeneraux/generer?id=' . $fraisgeneraux->getId()) ?>">Générer Soldes</a></li>
        <li class="sf_admin_action_show"><a href="<?php echo url_for('fraisgeneraux/imprimer?id=' . $fraisgeneraux->getId()) ?>" target="_blank">Imprimer</a></li>
            <?php echo $helper->linkToEdit($fraisgeneraux, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
            <?php echo $helper->linkToDelete($fraisgeneraux, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
    </ul>
</td>
