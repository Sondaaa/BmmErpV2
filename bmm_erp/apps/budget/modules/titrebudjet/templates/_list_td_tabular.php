<td class="sf_admin_date sf_admin_list_td_datecreation" style="text-align: center;">
    <?php echo false !== strtotime($titrebudjet->getDatecreation()) ? date('d/m/Y', strtotime($titrebudjet->getDatecreation())) : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_libelle">
    <?php echo $titrebudjet->getLibelle() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_categorietitre">
    <?php echo $titrebudjet->getCategorietitre() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_typebudget">
    <?php echo $titrebudjet->getTypebudget() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_projet">
    <?php echo $titrebudjet->getProjet() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_sourcesbudget">
    <?php echo $titrebudjet->getSourcesbudget() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_mntglobal">
    <?php echo number_format($titrebudjet->getMntglobal(), 3, '.', ' '); ?>
</td>
