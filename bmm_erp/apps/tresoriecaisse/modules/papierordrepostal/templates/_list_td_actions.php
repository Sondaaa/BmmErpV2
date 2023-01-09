<td>
    <!--  <ul class="sf_admin_td_actions">
    <?php //echo $helper->linkToEdit($papierordrepostal, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php //echo $helper->linkToDelete($papierordrepostal, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
      </ul>-->
    <?php if ($papierordrepostal->getEtat() == true): ?>
        <button type="button" class="btn btn-white btn-info btn-sm" onclick="showDetail('<?php echo $papierordrepostal->getId() ?>')" style="text-align: center;">
            Détails
            <i class="ace-icon fa fa-eye icon-on-right bigger-110"></i>
        </button>
        <?php if ($papierordrepostal->getAnnule() == false): ?>
            <button type="button" class="btn btn-danger btn-sm" onclick="goAnnulerOrdre('<?php echo $papierordrepostal->getId() ?>', 1)" style="text-align: center;">
                Détruire
                <i class="ace-icon fa fa-fire icon-on-right bigger-110"></i>
            </button>
        <?php endif; ?>
        <button type="button" class="btn btn-primary btn-sm" onclick="goAnnulerOrdre('<?php echo $papierordrepostal->getId() ?>', 0)" style="text-align: center;">
            Initialiser
            <i class="ace-icon fa fa-eraser icon-on-right bigger-110"></i>
        </button>
    <?php endif; ?>
</td>