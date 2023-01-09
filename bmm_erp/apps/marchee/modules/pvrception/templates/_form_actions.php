<ul class="sf_admin_actions">
    <?php if ($form->isNew()): ?>
        <li>
            <a   target="_blank" href="<?php echo url_for('@lots') ?>" 
                 class="btn btn-white btn-success ">
                Retour à la liste</a>
        </li> 
        <li  class="sf_admin_action_list">
            <input type="button"  id="" value="Mise à jour"  ng-controller="CtrlTransfer"  ng-click="saveDocumentPvReception()"  >
        </li>
    <?php else: ?>
        <li>
            <a   target="_blank" href="<?php echo url_for('@lots') ?>" 
                 class="btn btn-white btn-success ">
                Retour à la liste</a>
        </li> 
        <li  class="sf_admin_action_list">
            <input type="button"  id="" value="Mise à jour"  ng-controller="CtrlTransfer" ng-click="saveDocumentPvReception()"   >
        </li>
        <?php //echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>
        <?php //echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>

        <li class="sf_admin_action_list">
            <a   target="_blank" href="<?php echo url_for('pvrception/ImprimerFiche') . '?id=' . $pvrception->getId() ?>" 
                 class="btn btn-white btn-primary ">
                <i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
        </li>
    <?php endif; ?>
</ul>
