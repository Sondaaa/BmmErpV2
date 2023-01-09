<td class="sf_admin_text sf_admin_list_td_numerodocachat" style="text-align: center;">
  <?php echo $documentachat->getNumerodocachat() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_datecreationachat" style="text-align: center;">
  <?php echo date('d/m/Y', strtotime($documentachat->getDatecreationachat())); ?>
</td>
<td class="sf_admin_text sf_admin_list_td_reference" style="text-align: center;">
  <?php echo $documentachat->getReference() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_agents">
  <?php echo $documentachat->getAgents() ?>
</td>