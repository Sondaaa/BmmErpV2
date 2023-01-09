<td class="sf_admin_date sf_admin_list_td_date">
    <?php echo false !== strtotime($alimentationcompte->getDate()) ? format_date($alimentationcompte->getDate(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_caissesbanques">
    <?php echo $alimentationcompte->getCaissesbanques() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_montant">
    <?php echo $alimentationcompte->getMontant() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_tranchebudget">
    <?php if ($alimentationcompte->getIdTranchebudget() != null) echo $alimentationcompte->getTranchebudget() ?>
</td>
