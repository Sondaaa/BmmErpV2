<td class="sf_admin_text sf_admin_list_td_agents">
  <?php echo $visitemedicale->getAgents() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_destinatonvisitemedicale">
  <?php echo $visitemedicale->getDestinatonvisitemedicale() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_datedepart">
  <?php echo false !== strtotime($visitemedicale->getDatedepart()) ? format_date($visitemedicale->getDatedepart(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_dateretour">
  <?php echo false !== strtotime($visitemedicale->getDateretour()) ? format_date($visitemedicale->getDateretour(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nbrjour">
  <?php echo $visitemedicale->getNbrjour()." " ."Jour " ?>
</td>
<td class="sf_admin_text sf_admin_list_td_motif">
  <?php echo $visitemedicale->getMotif() ?>
</td>
