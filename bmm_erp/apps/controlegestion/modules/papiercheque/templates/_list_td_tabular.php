<td class="sf_admin_text sf_admin_list_td_carnetcheque">
    <?php echo $papiercheque->getCarnetcheque() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_refpapier">
    <?php echo $papiercheque->getRefpapier() ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_etat" style="text-align: center;">
    <?php //echo get_partial('papiercheque/list_field_boolean', array('value' => $papiercheque->getEtat())) ?>
    <?php if ($papiercheque->getEtat() == false): ?>
        <i class="ace-icon fa fa-unlock bigger-150 lighter green"></i>
    <?php else: ?>
        <i class="ace-icon fa fa-lock bigger-150 lighter red"></i>
        <?php if (!$papiercheque->getAnnule()): ?>
            <i style="margin-left: 20px;" class="ace-icon fa fa-hand-o-right"></i>
            <?php echo $papiercheque->getMouvementbanciare()->getFirst()->getDateoperation(); ?>
        <?php endif; ?>
    <?php endif; ?>
</td>
<td class="sf_admin_date sf_admin_list_td_datesignature">
    <?php echo false !== strtotime($papiercheque->getDatesignature()) ? format_date($papiercheque->getDatesignature(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_cible">
    <?php echo $papiercheque->getCible() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_annule" style="text-align: center;">
    <?php //echo $papiercheque->getAnnule() ?>
    <?php if ($papiercheque->getAnnule()): ?>
        <i class="ace-icon fa fa-fire bigger-150 lighter red"></i>
    <?php else: ?>
        <!--Rien à faire-->
    <?php endif; ?>
</td>
