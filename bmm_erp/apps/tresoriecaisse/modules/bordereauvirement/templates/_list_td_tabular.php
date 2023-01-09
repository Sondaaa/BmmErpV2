<td class="sf_admin_date sf_admin_list_td_date">
    <?php echo false !== strtotime($bordereauvirement->getDate()) ? format_date($bordereauvirement->getDate(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_total">
    <?php echo $bordereauvirement->getTotal() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_caissesbanques">
    <?php echo $bordereauvirement->getCaissesbanques() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_typeoperation">
    <?php echo $bordereauvirement->getTypeoperation() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_naturebanque">
    <?php echo $bordereauvirement->getNaturebanque() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_papierordrepostal">
    <?php if ($bordereauvirement->getIdNaturecompte() == 1): ?>
        <?php echo $bordereauvirement->getPapierordrepostal() ?>
        <?php if ($bordereauvirement->getValide() == true): ?>
            <button type="button" class="btn btn-danger btn-xs" onclick="annulerOrdre('<?php echo $bordereauvirement->getIdPapierordrepostal() ?>', '<?php echo $bordereauvirement->getPapierordrepostal() ?>')" style="float: right; margin-left: 10px;">
                <i class="ace-icon fa fa-fire bigger-110"></i>
            </button>
            <button type="button" class="btn btn-warning btn-xs" onclick="showDetail('<?php echo $bordereauvirement->getIdPapierordrepostal() ?>','<?php echo $bordereauvirement->getId() ?>')" style="float: right;">
                <i class="ace-icon fa fa-eye bigger-110"></i>
            </button>
        <?php endif; ?>
    <?php endif; ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_valide" style="text-align: center; vertical-align: middle;">
    <?php //echo get_partial('bordereauvirement/list_field_boolean', array('value' => $bordereauvirement->getValide())) ?>
    <?php if ($bordereauvirement->getValide() == true): ?>
        <i class="ace-icon fa fa-check bigger-150 lighter green"></i>
    <?php else: ?>
        <!--Rien à afficher-->
    <?php endif; ?>
</td>
