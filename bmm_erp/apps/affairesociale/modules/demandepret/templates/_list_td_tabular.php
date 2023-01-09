<td class="sf_admin_text sf_admin_list_td_agents">
    <?php echo $demandepret->getAgents() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_pret">
    <?php echo $demandepret->getPret() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_sourcepret">
    <?php echo $demandepret->getSourcepret() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_montantpret">
    <?php echo $demandepret->getMontantpret() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nbrmois">
    <?php echo $demandepret->getNbrmois() . " Mois " ?>
</td>
<td class="sf_admin_text sf_admin_list_td_montantmentielle">
    <?php echo $demandepret->getMontantmentielle() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_datedemande">
    <?php echo false !== strtotime($demandepret->getDatedemande()) ? format_date($demandepret->getDatedemande(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_mois">
    <?php $array = array("" => "", "1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre"); ?>
    <?php echo $array[$demandepret->getMois()] ?>
</td>
<td class="sf_admin_text sf_admin_list_td_annee">
    <?php echo $demandepret->getAnnee() ?>
</td>
