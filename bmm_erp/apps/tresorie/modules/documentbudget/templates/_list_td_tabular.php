<td class="sf_admin_text sf_admin_list_td_documentachat">
    <?php
    $piecejoint = PiecejointbudgetTable::getInstance()->findOneByIdDocumentbudget($documentbudget->getId());
    if ($piecejoint->getIdDocachat()) 
        echo $piecejoint->getDocumentachat();
    ?>
</td>
<td class="sf_admin_text sf_admin_list_td_numerodocachat">
<?php echo $documentbudget->getNumerodocachat() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_datecreation">
<?php echo false !== strtotime($documentbudget->getDatecreation()) ? format_date($documentbudget->getDatecreation(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_typedocbudget">
<?php echo $documentbudget->getTypedocbudget() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_ligprotitrub">
<?php echo $documentbudget->getLigprotitrub() ?>
</td>
