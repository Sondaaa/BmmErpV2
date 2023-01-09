<td>
    <ul class="sf_admin_td_actions">
        <?php echo $helper->linkToEdit($contratouvrier, array('params' => array(), 'class_suffix' => 'Afficher', 'label' => 'Afficher',)) ?>
        <li class="sf_admin_action_edit">
            <a target="_blank" href="<?php echo url_for('contratouvrier/ImprimerFiche') . '?id=' . $contratouvrier->getId() ?>" class="btn btn-primary">Imprimer</a>
        </li>
    </ul>
</td>