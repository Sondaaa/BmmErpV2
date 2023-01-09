<td>
    <ul class="sf_admin_td_actions">
        <?php  echo $helper->linkToEdit($transfertbudget, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
        <?php // echo $helper->linkToDelete($transfertbudget, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
        <?php
        $id_destination = $transfertbudget->getIdDestination();
        $ligpr_destination = LigprotitrubTable::getInstance()->find($id_destination);
        $mntengager_destination = $ligpr_destination->getMnt() - $ligpr_destination->getMntengage() + $ligpr_destination->getMntexterne() + $ligpr_destination->getMntretire() ;
        ?>
        <?php if ($mntengager_destination > 0 && $transfertbudget->getEtattransfert()!='Annulé(e)'): ?>
            <a  class="btn btn-xs btn-danger" style="margin-right: 1px; margin-left: 1px"  type="button" href="<?php echo url_for('transfertbudget/deleteTransfertBudget?id=' . $transfertbudget->getId()); ?>">Annuler</a>
        <?php endif; ?>
    </ul>
</td>
