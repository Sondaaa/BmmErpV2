<td class="sf_admin_text sf_admin_list_td_documentachat">
  <?php
  $id_docreg = $docachatreg->getIdDocreg();
  $doc_regroppe = DocumentachatTable::getInstance()->find($id_docreg);

  //echo $doc_regroppe->getNumerodocachat();
  if ($doc_regroppe)
    echo $doc_regroppe->getTypedoc()->getPrefixetype() . ' '
      . sprintf('%05d', $doc_regroppe->getNumero());
  ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_id_bci">
  <?php //echo $docachatreg->getDocumentachat3() 
  $id_bci = $docachatreg->getIdBci();
  $doc_bci = DocumentachatTable::getInstance()->find($id_bci);

  //echo $doc_regroppe->getNumerodocachat();
  if ($doc_bci)
    echo $doc_bci->getTypedoc()->getPrefixetype() . ' '
      . sprintf('%05d', $doc_bci->getNumero());?>
</td>
<td class="sf_admin_text sf_admin_list_td_demandeur">
  <?php echo $docachatreg->getDemandeur() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_Utilisateur">
  <?php echo $docachatreg->getUtilisateur() ?>
</td>
<td></td>