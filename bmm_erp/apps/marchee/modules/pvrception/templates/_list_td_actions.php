<td>
    <ul class="sf_admin_td_actions">
        <?php
//.'type=pro' 
//echo $helper->linkToEdit($pvrception, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) 
        ?>
        <li>
            <a type="button" class="btn btn-xs btn-success" href="<?php echo url_for('pvrception') . '/' . $pvrception->getId() . '/edit' ?>">Modifer </a>
        </li>
<?php echo $helper->linkToDelete($pvrception, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
    </ul>
</td>
