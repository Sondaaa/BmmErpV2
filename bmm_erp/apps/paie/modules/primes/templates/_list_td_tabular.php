<td class="sf_admin_text sf_admin_list_td_titreprimes">
  <?php echo $primes->getTitreprimes() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_categorierh">
  <?php echo $primes->getCategorierh() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_montant">
  <?php echo $primes->getMontant() ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_cotisable" style="text-align: center">
  <?php echo get_partial('primes/list_field_boolean', array('value' => $primes->getCotisable())) ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_imposable" style="text-align: center">
  <?php echo get_partial('primes/list_field_boolean', array('value' => $primes->getImposable())) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_formule">
  <?php echo $primes->getFormule() ?>
</td>
