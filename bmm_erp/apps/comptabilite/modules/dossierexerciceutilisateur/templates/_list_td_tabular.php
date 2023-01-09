<td class="sf_admin_date sf_admin_list_td_date">
  <?php echo false !== strtotime($dossierexerciceutilisateur->getDate()) ? date('d/m/Y', strtotime($dossierexerciceutilisateur->getDate())) : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_utilisateur">
  <?php echo $dossierexerciceutilisateur->getUtilisateur() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_dossierexercice">
  <?php echo $dossierexerciceutilisateur->getDossierexercice() ?>
</td>
