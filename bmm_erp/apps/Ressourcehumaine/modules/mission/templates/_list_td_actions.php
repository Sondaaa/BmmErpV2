
<td style="width:20%" >
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu" role="menu">
                <?php echo $helper->linkToEdit($mission, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
                <?php echo $helper->linkToDelete($mission, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>

                <li>
                    <a target="_blanc" class=" btn-danger" href="<?php echo url_for('mission/Imprimermission?iddoc=' . $mission->getId()) ?>">Fiche Mission</a>
                </li>
            </ul>
        </div>
    </div>
</td>