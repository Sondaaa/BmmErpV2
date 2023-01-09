

<td style="width:20%" >
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu" role="menu">
                <?php echo $helper->linkToEdit($formulaire, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
                <?php echo $helper->linkToDelete($formulaire, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>

                <li class="align_right">
                    <a target="_blanc" class=" btn-primary" href="<?php echo url_for('formulaire/Imprimerformulaire?iddoc=' . $formulaire->getId()) ?>"><span style="font-size: 16px">استمارة فردية</span></a>
                </li>
            </ul>
        </div>
    </div>
</td>
<style>

    .align_right{
        text-align: right;
        margin-right: 10px;
        font-size: 16px;
    }

</style>