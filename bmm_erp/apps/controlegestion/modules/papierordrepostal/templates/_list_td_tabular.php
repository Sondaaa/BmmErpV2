<td class="sf_admin_text sf_admin_list_td_carnetordrepostal">
    <?php echo $papierordrepostal->getCarnetordrepostal() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_repapier">
    <?php echo $papierordrepostal->getRepapier() ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_etat" style="text-align: center; vertical-align: middle;">
    <?php //echo get_partial('papierordrepostal/list_field_boolean', array('value' => $papierordrepostal->getEtat())) ?>
    <?php if ($papierordrepostal->getEtat() == false): ?>
        <i class="ace-icon fa fa-unlock bigger-150 lighter green"></i>
    <?php else: ?>
        <i class="ace-icon fa fa-lock bigger-150 lighter red"></i>
        <?php if ($papierordrepostal->getBordereauvirement()->getFirst()): ?>
            <i style="margin-left: 20px;" class="ace-icon fa fa-hand-o-right"></i>
            <?php echo $papierordrepostal->getBordereauvirement()->getFirst()->getDate(); ?>
        <?php endif; ?>
    <?php endif; ?>
</td>
<td style="text-align: right;"><?php echo number_format($papierordrepostal->getMnt(), 3, '.', ' ') ?></td>
<td class="sf_admin_date sf_admin_list_td_datesignature">
    <?php echo false !== strtotime($papierordrepostal->getDatesignature()) ? format_date($papierordrepostal->getDatesignature(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_cible">
    <?php echo $papierordrepostal->getCible() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_cible" style="text-align: center; vertical-align: middle;">
    <?php if ($papierordrepostal->getAnnule()): ?>
        <i class="ace-icon fa fa-fire bigger-150 lighter red"></i>
    <?php else: ?>
        <!--Rien à faire-->
    <?php endif; ?>
</td>