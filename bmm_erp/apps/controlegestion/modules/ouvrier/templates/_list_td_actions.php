<td>
    <ul class="sf_admin_td_actions">
        <?php echo $helper->linkToEdit($ouvrier, array('params' => array(), 'class_suffix' => 'Afficher', 'label' => 'Afficher',)) ?>
        <li class="sf_admin_action_edit">
            <a target="_blank" href="<?php echo url_for('ouvrier/ImprimerFiche') . '?id=' . $ouvrier->getId() ?>" class="btn btn-primary">Imprimer</a>
        </li>
    </ul>
</td>
