<td>
    <ul class="sf_admin_td_actions">
        <?php echo $helper->linkToEdit($fournisseur, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
       
        <?php //echo $helper->linkToDelete($fournisseur, array(  'params' =>   array(  ),  'confirm' => 'Êtes-vous sûr ?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
        <li class="sf_admin_action_affect <?php if ($sf_user->getAttribute('userB2m')->getAcceesDroit("achat_et_validation_frs")) echo 'disabledbutton' ?>"><a  href="<?php echo url_for('reclamationfrs/new?idfrs=') . $fournisseur->getId() ?>"><i class="ace-icon fa fa-commenting-o"></i> Réclamer au fournisseur</a></li>
        <li>
            <a target="_blanc" class="btn btn-xs btn-success " style="width: 150px" href="<?php echo url_for('fournisseur/ImprimerficheFournisseur?idfrs=' . $fournisseur->getId()) ?>"><i class="ace-icon fa fa-eye"></i> Fiche Fournisseur</a>
        </li>
    </ul>
</td>
