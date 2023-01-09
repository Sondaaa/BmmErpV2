<td class="sf_admin_text sf_admin_list_td_agents">
    <?php echo $retenuesursalaire->getAgents() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_fournisseur">
    <?php if ($retenuesursalaire->getIdFournisseur() != null): ?>
        <?php echo $retenuesursalaire->getFournisseur() ?>
 
    <?php endif; ?>
</td>
<td class="sf_admin_text sf_admin_list_td_mois">
    <?php $array = array("1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre"); ?> 
    <?php echo $array[$retenuesursalaire->getMois()] ?>
</td>
<td class="sf_admin_text sf_admin_list_td_annee">
    <?php echo $retenuesursalaire->getAnnee() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_montantpret">
  <?php echo $retenuesursalaire->getMontantpret() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nbrmois">
  <?php echo $retenuesursalaire->getNbrmois()." " ."Mois " ?>
</td>
<td class="sf_admin_text sf_admin_list_td_retenuesursalaire">
  <?php echo $retenuesursalaire->getRetenuesursalaire() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_datedebut">
  <?php echo false !== strtotime($retenuesursalaire->getDatedebut()) ? format_date($retenuesursalaire->getDatedebut(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_datefin">
  <?php echo false !== strtotime($retenuesursalaire->getDatefin()) ? format_date($retenuesursalaire->getDatefin(), "f") : '&nbsp;' ?>
</td>