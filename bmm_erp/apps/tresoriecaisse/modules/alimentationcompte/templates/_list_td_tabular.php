<td class="sf_admin_date sf_admin_list_td_date" style="text-align: center; width: 10%;">
    <?php echo false !== strtotime($alimentationcompte->getDate()) ? date('d/m/Y', strtotime($alimentationcompte->getDate())) : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_caissesbanques" style="width: 26%;">
    <?php echo $alimentationcompte->getCaissesbanques() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_montant" style="text-align: right; width: 11%;">
    <?php echo number_format($alimentationcompte->getMontant(), 3, '.', ' '); ?>
</td>
<td class="sf_admin_text sf_admin_list_td_tranchebudget" style="width: 26%;">
    <?php if ($alimentationcompte->getIdTranchebudget() != null) echo $alimentationcompte->getTranchebudget() ?>
</td>
