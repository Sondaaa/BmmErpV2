<td class="sf_admin_text sf_admin_list_td_fournisseur">
    <?php echo $historiquemouvement->getFournisseur() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_lignemouvementfacturation">
    <?php echo $historiquemouvement->getLignemouvementfacturation() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_etatfrs">
    <?php
    if ($historiquemouvement->getEtatfrs() == '1')
        echo 'En régle';
    else if ($historiquemouvement->getEtatfrs() == '0')
        echo 'En Défaut';
    ?>
</td>
<td class="sf_admin_date sf_admin_list_td_datecreation">
<?php echo false !== strtotime($historiquemouvement->getDatecreation()) ? format_date($historiquemouvement->getDatecreation(), "f") : '&nbsp;' ?>
</td>
