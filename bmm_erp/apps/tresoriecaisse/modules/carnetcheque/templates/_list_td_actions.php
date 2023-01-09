<td>
    <ul class="sf_admin_td_actions">
        <?php //echo $helper->linkToEdit($carnetcheque, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
        <?php //echo $helper->linkToDelete($carnetcheque, array(  'params' =>   array(  ),  'confirm' => 'Êtes-vous sûr ?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
        <li><a href="<?php echo url_for('papiercheque/index?idcarnet=' . $carnetcheque->getId()) ?>">+Détail & Chéquier</a></li>
    </ul>
</td>
