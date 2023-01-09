<td>
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button  data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="<?php echo url_for('ouvrier/edit') . '?id=' . $ouvrier->getId() ?>" class="btn btn-primary width-fixed">Modifier</a>
                </li>
                <li> 
                    <?php echo $helper->linkToDelete($ouvrier, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>  
                </li>
                <li>
                    <a target="_blanc" class="btn btn-outline btn-success width-fixed" href="<?php echo url_for('ouvrier/imprimerFicheouvrier?iddoc=' . $ouvrier->getId()) ?>">Fiche Ouvrier</a>
                </li>
            </ul>
        </div>
    </div>
</td>

<style>

    .width-fixed{min-width: 172px;}

</style>