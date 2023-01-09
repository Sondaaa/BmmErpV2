<td class="sf_admin_text sf_admin_list_td_codecb" style="text-align: center; width: 10%">
    <?php echo $caissesbanques->getCodecb() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_libelle" style="width: 50%;">
    <?php echo $caissesbanques->getLibelle() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_dateouvert" style="text-align: center; width: 12%;">
    <?php echo false !== strtotime($caissesbanques->getDateouvert()) ? date('d/m/Y', strtotime($caissesbanques->getDateouvert())) : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_mntouverture" style="text-align: right; width: 10%;">
    <?php echo number_format($caissesbanques->getMntouverture(), 3, '.', ' '); ?>
</td>
