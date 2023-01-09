<td class="sf_admin_text sf_admin_list_td_agents">
    <?php echo $paie->getAgents() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_mois">

    <?php
    $array = array("1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre");
    ?>
    <?php
    echo $array[$paie->getMois()];
    ?>
</td>
<td class="sf_admin_text sf_admin_list_td_annee">
    <?php echo $paie->getAnnee() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_salaireimposable">
    <?php echo $paie->getSalaireimposable() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_salairenet">
    <?php echo $paie->getSalairenet() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_netapayyer">
    <?php echo $paie->getNetapayyer() ?>
</td>
