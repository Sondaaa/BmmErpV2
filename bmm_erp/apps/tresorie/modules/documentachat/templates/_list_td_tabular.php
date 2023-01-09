<td class="sf_admin_text sf_admin_list_td_datecreationachat">
  <?php echo date('d/m/Y', strtotime($documentachat->getDatecreationachat())); ?>
</td>
<td class="sf_admin_text sf_admin_list_td_numerodocachat">
  <?php echo $documentachat->getNumerodocachat() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_reference">
  <?php echo $documentachat->getReference() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_agents">
  <?php echo $documentachat->getAgents() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_etatdocument">
  <?php echo $documentachat->getEtatdocument() ?>

