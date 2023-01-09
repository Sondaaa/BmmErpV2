<?php if($historiqueretenue->getIdRetenue()!=""): ?>
<td class="sf_admin_text sf_admin_list_td_retenuesursalaire">
  <?php echo $historiqueretenue->getRetenuesursalaire() ?>
</td>
<td> Retenue sur Salaire</td>
<td><?php echo $historiqueretenue->getRetenuesursalaire()->getFournisseur()->getRs() ?></td>
<?php elseif ($historiqueretenue->getIdDemandepret()!=""): ?>
<td class="sf_admin_text sf_admin_list_td_demandepret">
  <?php echo $historiqueretenue->getDemandepret() ?>
</td>
<td> Retenue du Prêt </td>
<td><?php echo $historiqueretenue->getDemandepret()->getPret()->getLibelle(). " - ".$historiqueretenue->getDemandepret()->getPret()->getSourcepret()->getLibelle()  ?></td>
<?php else: ?>
<td class="sf_admin_text sf_admin_list_td_demandeavance">
  <?php echo $historiqueretenue->getDemandeavance() ?>
</td>
<td>Retenue d'Avance</td>
<td> <?php echo $historiqueretenue->getDemandeavance()->getAvance()->getLibelle() ?></td>
    
<?php endif; ?>
<td class="sf_admin_text sf_admin_list_td_mois">
       <?php $array = array("1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre"); ?>
  <?php echo $array[$historiqueretenue->getMois()]?>
</td>
<td class="sf_admin_text sf_admin_list_td_annee">
  <?php echo $historiqueretenue->getAnnee() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_montantsoustre">
  <?php echo $historiqueretenue->getMontantsoustre() ?>
</td>
