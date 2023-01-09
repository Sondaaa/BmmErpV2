<td class="sf_admin_text sf_admin_list_td_documentachat" style="text-align: center;">
    <?php if ($documentbudget->getDocumentachat() != null): ?>
        <a target="_blank" href="<?php echo url_for('documentachat/showdocument?iddoc=') . $documentbudget->getDocumentachat()->getId() ?>"><?php echo $documentbudget->getDocumentachat() ?></a>
        <?php
        if ($documentbudget->getDocumentachat()->getIdDocparent() != null):
            $documentachat_parent = DocumentachatTable::getInstance()->find($documentbudget->getDocumentachat()->getIdDocparent());
            ?>
            <br>
            <a target="_blank" href="<?php echo url_for('documentachat/showdocument?iddoc=') . $documentachat_parent->getId() ?>"><?php echo $documentachat_parent; ?></a>
        <?php endif; ?>
    <?php endif; ?>
</td>
<td class="sf_admin_text sf_admin_list_td_numerodocachat" style="text-align: center;">
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
