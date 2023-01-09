<?php if ($id_regerouppement == 1): ?>
    <ul class="sf_admin_actions">

        <?php if ($form->isNew()): ?>
            <?php // echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
            <?php // echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
            <li>
                <a   target="_blank" href="<?php echo url_for('contrat/indexRegroupement') . '?reg=' . $id_regerouppement ?>" 
                     class="btn btn-white btn-primary ">
                    Retour à la liste</a>
            </li>      
            <li>
                <input type="button" style="margin-left: 15px" id="btnvaliderContrat" value="Mise à jour Fiche carrière" ng-controller="CtrlRessourcehumaine" ng-click="saveDocumentContrat()" class="btn btn-outline">
            </li>
        <?php else: ?>
            <?php // echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
            <?php // echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
            <li>
                <a   target="_blank" href="<?php echo url_for('contrat/indexRegroupement') . '?reg=' . $id_regerouppement ?>" 
                     class="btn btn-white btn-primary ">
                    Retour à la liste</a>
            </li>   
            <li>
                <input type="button" style="margin-left: 15px" id="btnvaliderContrat" value="Mise à jour Fiche carrière" ng-controller="CtrlRessourcehumaine" ng-click="saveDocumentContrat()" class="btn btn-outline"> 
            </li>
            <li class="sf_admin_action_list">
                <a target="_blank" style="margin-left: 15px" href="<?php echo url_for('contrat/ImprimerFiche?iddoc=' . $contrat->getId()) ?>" 
                   class="btn btn-white btn-primary ">
                    <i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
            </li>
        <?php endif; ?>
    </ul>
<?php elseif ($id_regerouppement == 2): ?>
    <ul class="sf_admin_actions">

        <?php if ($form->isNew()): ?>
            <?php // echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
            <?php // echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
            <li>
                <a   target="_blank" href="<?php echo url_for('contrat/indexRegroupement') . '?reg=' . $id_regerouppement ?>" 
                     class="btn btn-white btn-primary ">
                    Retour à la liste</a>
            </li>   
            <li>
                <input  type="button" style="margin-left: 15px" id="btnvaliderContratmilitaire" value="Mise à jour Fiche carrière" ng-controller="CtrlContrat" ng-click="saveDocumentContratmilitaire()" class="btn btn-outline btn-white btn-success ">
            </li 
        <?php else: ?>
            <?php // echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
            <?php // echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
            <li>
                <a   target="_blank" href="<?php echo url_for('contrat/indexRegroupement') . '?reg=' . $id_regerouppement ?>" 
                     class="btn btn-white btn-primary ">
                    Retour à la liste</a>
            </li>   
            <li>
                <button type="button" style="margin-left: 15px" id="btnvaliderContratmilitaire" value="Mise à jour Fiche carrière"ng-controller="CtrlContrat" ng-click="saveDocumentContratmilitaire()" class="btn btn-outline btn-white btn-success ">Ajouter</button>
            </li>
            <li class="sf_admin_action_list">
                <a target="_blank" style="margin-left: 15px" href="<?php echo url_for('contrat/ImprimerFiche?iddoc=' . $contrat->getId()) ?>" 
                   class="btn btn-white btn-primary ">
                    <i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
            </li>
        <?php endif; ?>
    </ul>
<?php endif; ?>