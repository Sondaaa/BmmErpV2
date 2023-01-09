<td class="sf_admin_date sf_admin_list_td_datecreation">
  <?php echo false !== strtotime($titrebudjet->getDatecreation()) ? format_date($titrebudjet->getDatecreation(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_categorietitre">
  <?php echo $titrebudjet->getCategorietitre() ?>
</td>

<td class="sf_admin_text sf_admin_list_td_mntglobal">
  <?php echo $titrebudjet->getMntglobal() ?>
</td>
