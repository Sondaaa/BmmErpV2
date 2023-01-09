<td class="sf_admin_text sf_admin_list_td_libelle">
  <?php echo $caissesbanques->getLibelle() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_rib">
  <?php echo $caissesbanques->getRib() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_mntdefini" style="text-align: right;">
  <?php echo number_format($caissesbanques->getMntdefini(), 3, '.', ' '); ?>
</td>
