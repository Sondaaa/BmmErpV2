<td>
    <ul class="sf_admin_td_actions">
        <li class="divider"></li>
<!--        <li>
            <a href="<?php //echo url_for('salairedebase/edit')  ?>">Modifier</a> 
        </li>       -->
        <?php echo $helper->linkToEdit($salairedebase, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
        <?php // echo $helper->linkToDelete($salairedebase, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>


    </ul>
</td>
