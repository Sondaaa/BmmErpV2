<td>
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button  data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <button type="button" onclick="document.location.href = '<?php echo url_for('conge/edit') . '?id=' . $conge->getId() ?>'"  class="btn btn-primary width-fixed">
                        <i class="ace-icon fa fa-edit bigger-110"></i>Modifier</button>
                       <?php // echo $helper->linkToEdit($conge, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
                </li>
                <li> 
                        <?php echo $helper->linkToDelete($conge, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
                </li>
                <li>
                    <a style="width: 25px" target="_blanc" class="btn btn-outline btn-success  width-fixed" href="<?php echo url_for('conge/imprimerDemande?iddoc=' . $conge->getId()) ?>">
                        <i class="fa fa-eye"></i>Demande Congé</a>
                </li>
               

            </ul>
        </div>
    </div>
</td>


<style>

    .width-fixed{
        min-width: 172px;
    }

</style>




