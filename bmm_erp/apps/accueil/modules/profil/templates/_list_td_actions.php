<?php
$user = new Utilisateur();
$user =  $sf_user->getAttribute('userB2m');
?>
<td>
    <ul class="sf_admin_td_actions">
        <li class="sf_admin_action_print" style="margin:2%"><a target="_blank" href="<?php echo url_for('profil/imprimer?id=' . $profil->getId()) ?>"><i class="ace-icon fa fa-print"></i> Imprimer</a></li>
        <li class="sf_admin_action_show" style="margin:2%"><a href="<?php echo url_for('profil/show?id=' . $profil->getId()) ?>">Afficher</a></li>
        <?php if ($profil->getLibelle() != 'Super Admin' || !$user->getIdParent()): ?>
            <li class="sf_admin_action_affect" style="margin:2%"><a href="<?php echo url_for('profil/editModule?id=' . $profil->getId()) ?>">Affecter Module</a></li>
                <?php echo $helper->linkToEdit($profil, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
                <?php if ($profil->getUtilisateur()->count() == 0): ?>
                    <?php echo $helper->linkToDelete($profil, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
                <?php endif; ?>
            <?php endif; ?>
    </ul>
</td>
