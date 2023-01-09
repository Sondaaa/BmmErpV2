<td>
    <ul class="sf_admin_td_actions">
        <?php //echo $helper->linkToEdit($ligneoperationcaisse, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
        <?php //echo $helper->linkToDelete($ligneoperationcaisse, array(  'params' =>   array(  ),  'confirm' => 'Êtes-vous sûr ?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
        <li>
            <a   class="btn btn-white btn-success" href="<?php echo url_for('Documents/detailpreengagement') . '?id=' . $ligneoperationcaisse->getIdDocachat().'&idoperation='.$ligneoperationcaisse->getId() ?>">Détail & Exporter Pdf</a>  
        </li>    
    </ul>
</td>
