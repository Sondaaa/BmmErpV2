<td class="sf_admin_date sf_admin_list_td_daterecu">
    <?php echo false !== strtotime($carnetcheque->getDaterecu()) ? format_date($carnetcheque->getDaterecu(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_caissesbanques">
    <?php echo $carnetcheque->getCaissesbanques() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_refdepart" style="text-align: center;">
    <?php echo $carnetcheque->getRefdepart() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_reffin" style="text-align: center;">
    <?php echo $carnetcheque->getReffin() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nbrepapier" style="text-align: center;">
    <?php echo $carnetcheque->getNbrepapier() ?>
</td>
<td style="text-align: center;">
    <?php
    $papiers = PapierchequeTable::getInstance()->findByEtatAndIdCarnet(false, $carnetcheque->getId());
    $papier = $papiers->getFirst();
    ?>
    <span class="badge badge-info"><?php echo $papiers->count(); ?></span>
    <?php if ($papier != null): ?>
        <i style="margin-left: 20px;" class="ace-icon fa fa-hand-o-right"></i>
        <?php echo $papier->getRefpapier(); ?>
    <?php endif; ?>
</td>