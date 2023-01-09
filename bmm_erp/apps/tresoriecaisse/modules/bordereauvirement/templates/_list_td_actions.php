<td style="text-align: center; width: 15%;">
    <!--  <ul class="sf_admin_td_actions">
    <?php //echo $helper->linkToEdit($bordereauvirement, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php //echo $helper->linkToDelete($bordereauvirement, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
      </ul>-->

    <button class="btn btn-sm btn-primary" type="button" onclick="showBordereau('<?php echo $bordereauvirement->getId() ?>')">
        <i class="ace-icon fa fa-eye bigger-110"></i>
    </button>

    <a target="_blanc" title="Pour Remplir" href="<?php echo url_for('bordereauvirement/ImprimerBordereau?id=' . $bordereauvirement->getId()) ?>" class="btn btn-sm btn-default">
        <i class="ace-icon fa fa-print bigger-110"></i>
    </a>
    
    <a target="_blanc" title="Etat de Bordereau" href="<?php echo url_for('bordereauvirement/ImprimerBordereauVide?id=' . $bordereauvirement->getId()) ?>" class="btn btn-sm btn-warning">
        <i class="ace-icon fa fa-print bigger-110"></i>
    </a>

    <?php if ($bordereauvirement->getValide() == false): ?>
        <button class="btn btn-sm btn-success" type="button" onclick="validerBordereau('<?php echo $bordereauvirement->getId() ?>', '<?php echo $bordereauvirement->getIdCompte() ?>', '<?php echo $bordereauvirement->getCaissesbanques()->getIdNature() ?>')">
            <i class="ace-icon fa fa-check bigger-110"></i>
        </button>

        <button class="btn btn-sm btn-danger" type="button" onclick="supprimerBordereau(<?php echo $bordereauvirement->getId() ?>)">
            <i class="ace-icon fa fa-trash bigger-110"></i>
        </button>
    <?php endif; ?>
</td>

<style>
    
    .btn-sm > .ace-icon{margin-right: 0px;}
    
</style>