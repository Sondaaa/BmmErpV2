<td class="sf_admin_text sf_admin_list_td_login">
    <?php echo $utilisateur->getLogin() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_Agents">
    <?php echo $utilisateur->getAgents() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_Rolebymodule">
    <?php echo $utilisateur->getRolebymodule() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_Profil">
    <?php if ($utilisateur->getIdProfil()): ?>
        <a target="_blank" href="<?php echo url_for('profil/show?id=' . $utilisateur->getIdProfil()) ?>">
            <?php echo $utilisateur->getProfil() ?>
        </a>
    
    
    <?php endif; ?>
</td>
<td class="sf_admin_text sf_admin_list_td_etatconnect">
    <?php
    if ($utilisateur->getIsActive()):
        echo "Utilisateur Actif";
    else:
        echo "Utilisateur Bloqué";
    endif;
    ?>
</td>
