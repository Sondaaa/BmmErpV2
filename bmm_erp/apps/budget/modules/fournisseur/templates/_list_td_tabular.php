<td class="sf_admin_text sf_admin_list_td_nfiche" style="text-align: center;">
    <?php echo $fournisseur->getNfiche() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_reference" style="text-align: center;">
    <?php echo $fournisseur->getReference() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_rs">
    <?php echo $fournisseur->getRs() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_tel" style="text-align: center;">
    <?php echo $fournisseur->getTel() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_gsm" style="text-align: center;">
    <?php echo $fournisseur->getGsm() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_mail">
    <?php echo $fournisseur->getMail() ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_certificatrs" style="text-align: center;">
    <?php if ($fournisseur->getCertificatrs()): ?>
        <i class="ace-icon fa fa-check-square-o bigger-140"></i>
    <?php else: ?>
        <i class="ace-icon fa fa-square-o bigger-140"></i>
    <?php endif; ?>
</td>
