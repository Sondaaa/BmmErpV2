<td class="sf_admin_date sf_admin_list_td_datecreation" style="text-align: center;">
    <?php
    if ($idtype != 20) {
        echo false !== strtotime($documentachat->getDatecreation()) ? date('d/m/Y', strtotime($documentachat->getDatecreation())) : '&nbsp;';
    } else {
        echo date('d/m/Y', strtotime($documentachat->getDocumentachat()->getDatecreation()));
    }
    ?>
</td>
<td class="sf_admin_text sf_admin_list_td_numerodocachat" style="text-align: center;">
    <?php
    if ($idtype != 20) {
        echo $documentachat->getNumerodocachat();
    } else {
        echo $documentachat->getDocumentachat()->getNumerodocachat();
    }
    ?>
</td>
<td class="sf_admin_text sf_admin_list_td_fournisseur">
    <?php
    if ($idtype != 20) {
        echo $documentachat->getFournisseur();
    } else {
        echo $documentachat->getDocumentachat()->getFournisseur();
    }
    ?>
</td>
<td class="sf_admin_text sf_admin_list_td_mntttc" style="text-align: right;">
    <?php
    if ($idtype != 20) {
        echo $documentachat->getMntttc();
    } else {

        echo $documentachat->getDocumentachat()->getMntttc();
    }
    ?>
</td>
<?php if ($idtype == 20) { ?>
    <td class="sf_admin_text sf_admin_list_td_montant" style="text-align: right;">
        <?php echo $documentachat->getMontant(); ?>
    </td>    
        <?php
    }?>