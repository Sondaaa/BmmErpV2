<td class="sf_admin_text sf_admin_list_td_agents" style="width: 10%">
    <?php echo $retenuesursalaire->getAgents()->getPrenom() . " " . $retenuesursalaire->getAgents()->getNomcomplet() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_fournisseur" style="width: 10%">
    <?php if ($retenuesursalaire->getIdFournisseur() != null): ?>
        <?php echo $retenuesursalaire->getFournisseur() ?>

    <?php endif; ?>
</td>
<td class="sf_admin_text sf_admin_list_td_mois">
    <?php $array = array("1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre"); ?> 
    <?php echo $array[$retenuesursalaire->getMois()] ?>
</td>
<td class="sf_admin_text sf_admin_list_td_annee" style="text-align: center;width: 8%">
    <?php echo $retenuesursalaire->getAnnee() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_montantpret" style="text-align: center;width: 8%">
    <?php echo $retenuesursalaire->getMontantpret() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nbrmois" style="text-align: center;width: 8%">
    <?php echo $retenuesursalaire->getNbrmois() . " " . "Mois " ?>
</td>
<td class="sf_admin_text sf_admin_list_td_retenuesursalaire" style="text-align: center;width: 8%">
    <?php echo $retenuesursalaire->getRetenuesursalaire() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_datedebut">
    <?php echo false !== strtotime($retenuesursalaire->getDatedebut()) ? format_date($retenuesursalaire->getDatedebut(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_datefin">
    <?php echo false !== strtotime($retenuesursalaire->getDatefin()) ? format_date($retenuesursalaire->getDatefin(), "f") : '&nbsp;' ?>
</td>