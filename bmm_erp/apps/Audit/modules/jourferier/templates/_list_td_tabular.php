<td class="sf_admin_text sf_admin_list_td_libelle">
    <?php echo $jourferier->getLibelle() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_date">
    <?php if (!$jourferier->getPeriodique()): ?>
        <?php echo false !== strtotime($jourferier->getDate()) ? format_date($jourferier->getDate(), "f") : '&nbsp;' ?>
    <?php else: ?>
        <?php echo substr(format_date($jourferier->getDate(), "f"), 0, -11); ?>
    <?php endif; ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_paye" style="text-align: center;">
    <?php echo get_partial('jourferier/list_field_boolean', array('value' => $jourferier->getPaye())) ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_periodique" style="text-align: center;">
    <?php echo get_partial('jourferier/list_field_boolean', array('value' => $jourferier->getPeriodique())) ?>
</td>
