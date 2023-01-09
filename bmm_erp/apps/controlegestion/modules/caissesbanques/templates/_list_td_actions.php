<td style="width:20%; text-align: center;">
    <!--    <div class="btn-toolbar">
            <div class="btn-group" id="btnaction">
                <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                    Action
                    <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                </button>
                <ul class="dropdown-menu" role="menu">
    <?php // echo $helper->linkToEdit($caissesbanques, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
    <?php // echo $helper->linkToDelete($caissesbanques, array('params' => array(), 'confirm' => 'Êtes-vous sûr ?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
                    <li>
                        <a target="_blanc" class="btn btn-outline btn-primary" href="<?php // echo url_for('caissesbanques/ImprimerCaisse?id=' . $caissesbanques->getId())  ?>">Relevé d'identité caisse</a>
                    </li>
                </ul>
            </div>
        </div>-->

    <?php if ($caissesbanques->getIdTypecb() == 1): ?>
        <a target="_blanc" class="btn btn-outline btn-sm btn-primary" href="<?php echo url_for('caissesbanques/ImprimerCaisse?id=' . $caissesbanques->getId()) ?>">Relevé d'identité caisse</a>
    <?php else: ?>
        <a target="_blanc" class="btn btn-outline btn-sm btn-primary" href="<?php echo url_for('caissesbanques/ImprimerCaisse?id=' . $caissesbanques->getId()) ?>">Relevé d'identité bancaire</a>
    <?php endif; ?>
</td>