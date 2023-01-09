<td class="sf_admin_text sf_admin_list_td_agents">
  <?php echo $accidents->getAgents() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_motif">
  <?php echo $accidents->getMotif() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_lieutravail">
  <?php echo $accidents->getLieutravail() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_date">
  <?php echo false !== strtotime($accidents->getDate()) ? format_date($accidents->getDate(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nbrjour">
  <?php echo $accidents->getNbrjour() ." " ."Jour "?>
</td>
<td class="sf_admin_text sf_admin_list_td_observation">
  <?php echo $accidents->getObservation() ?>
</td>
