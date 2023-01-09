<td style="width:24%;">
    <?php if ($alimentationcompte->getIdTranchebudget() == null): ?>
        <ul class="sf_admin_td_actions">
            <li class="sf_admin_action_print"><a href="<?php echo url_for('alimentationcompte/imprimer?id=' . $alimentationcompte->getId()) ?>" target="_blank" class="btn btn-warning"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a></li>
            <li class="sf_admin_action_affect"><a href="<?php echo sfconfig::get('sf_appdir') . "uploads/scanner/" . $alimentationcompte->getChemin() ?>" target="_blank" class="btn btn-warning"><i class="ace-icon fa fa-print bigger-110"></i> Pièce</a></li>
            <?php //echo $helper->linkToEdit($alimentationcompte, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
            <?php echo $helper->linkToDelete($alimentationcompte, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => '<i class="ace-icon fa fa-trash bigger-110"></i> Supprimer',)) ?>
        </ul>
    <?php else: ?>
        <ul class="sf_admin_td_actions">
            <li class="sf_admin_action_print"><a href="<?php echo url_for('alimentationcompte/imprimer?id=' . $alimentationcompte->getId()) ?>" target="_blank" class="btn btn-warning"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a></li>
            <li class="sf_admin_action_affect"><a href="<?php echo sfconfig::get('sf_appdir') . "uploads/scanner/" . $alimentationcompte->getChemin() ?>" target="_blank" class="btn btn-warning"><i class="ace-icon fa fa-print bigger-110"></i> Pièce</a></li>
        </ul>
    <?php endif; ?>
</td>