<td class="sf_admin_text sf_admin_list_td_libelle">
    <?php echo $typeaffectationimmo->getLibelle() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_affectation" style="text-align: center;">
    <?php if ($typeaffectationimmo->getAffectation() == 1): ?>
        <i class="ace-icon fa fa-check-square-o bigger-130"></i>
    <?php endif; ?>
</td>
