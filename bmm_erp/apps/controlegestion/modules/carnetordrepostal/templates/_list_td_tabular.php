<td class="sf_admin_date sf_admin_list_td_daterecu">
    <?php echo false !== strtotime($carnetordrepostal->getDaterecu()) ? format_date($carnetordrepostal->getDaterecu(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_caissesbanques">
    <?php echo $carnetordrepostal->getCaissesbanques() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_refdepart">
    <?php echo $carnetordrepostal->getRefdepart() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_reffin">
    <?php echo $carnetordrepostal->getReffin() ?>
</td>
<td>
    <?php
    $papiers = PapierordrepostalTable::getInstance()->findByEtatAndIdCarnet(false, $carnetordrepostal->getId());
    $papier = $papiers->getFirst();
    ?>
    <span class="badge badge-info"><?php echo $papiers->count(); ?></span>
    <?php if ($papier != null): ?>
        <i style="margin-left: 20pxx;" class="ace-icon fa fa-hand-o-right"></i>
        <?php echo $papier->getRepapier(); ?>
    <?php endif; ?>
</td>