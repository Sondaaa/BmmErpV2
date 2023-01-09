<?php
//$user=$sf_user->UserConnected();
?>
<td>
    <ul class="sf_admin_td_actions">
        <?php if ($utilisateur->getIdParent() ): ?>
            <?php if ($utilisateur->getIsActive()): ?>
                <li class="sf_admin_action_affect"><a href="<?php echo url_for('utilisateur/profil?id=' . $utilisateur->getId()) ?>">Profil</a></li>
                <?php endif; ?>
                <?php echo $helper->linkToEdit($utilisateur, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
            <?php endif; ?>
    </ul>
</td>
