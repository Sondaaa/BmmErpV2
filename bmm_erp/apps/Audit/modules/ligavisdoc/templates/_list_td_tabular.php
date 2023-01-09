<td style="width:20%;" class="sf_admin_text sf_admin_list_td_avis">
    <?php echo $ligavisdoc->getAvis() ?>
</td>
<td style="width:10%; text-align: center;" class="sf_admin_date sf_admin_list_td_datecreation">
    <?php echo false !== strtotime($ligavisdoc->getDatecreation()) ? date('d/m/Y', strtotime($ligavisdoc->getDatecreation())) : '&nbsp;' ?>
</td>
<td style="width:10%; text-align: center;" class="sf_admin_text sf_admin_list_td_documentachat">
    <a target="_blank" href="<?php echo url_for('documentachat/showdocument?iddoc=') . $ligavisdoc->getDocumentachat()->getId() ?>"><?php echo $ligavisdoc->getDocumentachat() ?></a>
</td>
<td style="width:50%;" class="sf_admin_text sf_admin_list_td_ligprotitrub">
    <?php
    if ($ligavisdoc->getIdLigprotitrub() != null):
        echo $ligavisdoc->getLigprotitrub();
    endif;
    ?>
</td>
<td style="width:10%; text-align: center;" class="sf_admin_text sf_admin_list_td_mntdisponible">
    <?php echo $ligavisdoc->getMntdisponible() ?>
</td>