<td class="sf_admin_date sf_admin_list_td_datecreation" style="text-align: center;">
  <?php echo false !== strtotime($declaration->getDatecreation()) ? date('d/m/Y', strtotime($declaration->getDatecreation())) : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_libelle" style="text-align: center;">
  <?php echo $declaration->getLibelle() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_datedebut" style="text-align: center;">
  <?php echo false !== strtotime($declaration->getDatedebut()) ? date('d/m/Y', strtotime($declaration->getDatedebut())) : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_datefin" style="text-align: center;">
  <?php echo false !== strtotime($declaration->getDatefin()) ? date('d/m/Y', strtotime($declaration->getDatefin())) : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_montant" style="text-align: right;">
  <?php echo $declaration->getMontant() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_caissesbanques">
  <?php echo $declaration->getCaissesbanques() ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_etat" style="text-align: center;">
  <?php echo get_partial('declaration/list_field_boolean', array('value' => $declaration->getEtat())) ?>
</td>
