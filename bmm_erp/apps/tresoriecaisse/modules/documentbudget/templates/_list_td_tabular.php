<td class="sf_admin_text sf_admin_list_td_documentachat">
    <?php echo $documentbudget->getDocumentachat() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_numerodocachat">
    <?php echo $documentbudget->getNumerodocachat() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_datecreation" style="text-align: center;">
    <?php echo false !== strtotime($documentbudget->getDatecreation()) ? date('d/m/Y', strtotime($documentbudget->getDatecreation())) : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_typedocbudget">
    <?php echo $documentbudget->getTypedocbudget() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_ligprotitrub">
    <?php echo $documentbudget->getLigprotitrub() ?>
</td>
