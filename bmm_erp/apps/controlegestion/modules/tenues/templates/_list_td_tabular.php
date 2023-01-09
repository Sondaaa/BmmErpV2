<?php if($tenues->getIdAgents()!=""): ?>
<td class="sf_admin_text sf_admin_list_td_agents">
  <?php echo $tenues->getAgents() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_typetenue">
  <?php echo $tenues->getTypetenue() ?>
</td>
<?php endif; ?>
<td class="sf_admin_date sf_admin_list_td_date">
  <?php echo false !== strtotime($tenues->getDate()) ? format_date($tenues->getDate(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_observation">
  <?php echo $tenues->getObservation() ?>
</td>
