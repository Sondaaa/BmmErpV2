<td class="sf_admin_text sf_admin_list_td_agents">
  <?php echo $demandeavance->getAgents() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_avance">
  <?php echo $demandeavance->getAvance() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_montanttotal">
  <?php echo $demandeavance->getMontanttotal() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_montantmensielle">
  <?php echo $demandeavance->getMontantmensielle() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_mois">
    <?php $array = array("1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre"); ?>
  <?php echo $array[$demandeavance->getMois()] ?>
</td>
<td class="sf_admin_text sf_admin_list_td_annee">
  <?php echo $demandeavance->getAnnee() ?>
</td>
