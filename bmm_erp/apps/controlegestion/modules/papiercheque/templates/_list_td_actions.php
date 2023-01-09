<td style="text-align: center;">
    <!--<ul class="sf_admin_td_actions">-->
    <?php //echo $helper->linkToEdit($papiercheque, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php //echo $helper->linkToDelete($papiercheque, array(  'params' =>   array(  ),  'confirm' => 'Êtes-vous sûr ?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
    <!--</ul>-->
    <?php if ($papiercheque->getEtat() == true): ?>
        <button type="button" class="btn btn-white btn-info btn-sm" onclick="showDetail('<?php echo $papiercheque->getId() ?>')">
            Détails
            <i class="ace-icon fa fa-eye icon-on-right bigger-110"></i>
        </button>
        <?php //if ($papiercheque->getAnnule() == false): ?>
<!--            <button type="button" class="btn btn-danger btn-sm" onclick="annulerCheque('<?php //echo $papiercheque->getId() ?>')">
                Détruire
                <i class="ace-icon fa fa-fire icon-on-right bigger-110"></i>
            </button>-->
        <?php //endif; ?>
    <?php endif; ?>
</td>
