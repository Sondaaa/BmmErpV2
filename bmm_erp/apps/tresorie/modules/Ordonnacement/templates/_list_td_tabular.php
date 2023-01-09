<td class="sf_admin_date sf_admin_list_td_datecreation">
    <?php echo date('d-m-Y', strtotime($documentbudget->getDatecreation())) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_numerodocachat">

    <?php echo $documentbudget->getNumero(); ?>
</td>
<td class="sf_admin_text sf_admin_list_td_documentachat">
    <?php
    $piecejoint = PiecejointbudgetTable::getInstance()->findOneByIdDocumentbudget($documentbudget->getId());
    if ($piecejoint)
        if ($piecejoint->getIdDocachat())
            echo $piecejoint->getDocumentachat();
    ?>
</td>
<td class="sf_admin_text sf_admin_list_td_ligprotitrub">
    <?php echo $documentbudget->getTitrebudget() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_ligprotitrub">
    <?php
    if ($documentbudget)
        echo $documentbudget->getRubriqueparent();
    ?>
</td>
<td class="sf_admin_text sf_admin_list_td_ligprotitrub">
<?php if ($documentbudget && $documentbudget->getSousRubriqueBudgetaire()) echo $documentbudget->getSousRubriqueBudgetaire() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_mnt">
<?php if ($documentbudget) echo $documentbudget->getMntnet() ?>
</td>
