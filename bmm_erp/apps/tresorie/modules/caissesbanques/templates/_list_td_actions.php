<td style="width:20%" >
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu" role="menu">
                <?php // echo $helper->linkToEdit($caissesbanques, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
                <?php // echo $helper->linkToDelete($caissesbanques, array('params' => array(), 'confirm' => 'Êtes-vous sûr ?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
                <li>
                    <a target="_blanc" class="btn btn-outline btn-success width-fixed" href="<?php echo url_for('caissesbanques/ImprimerCaisse?id=' . $caissesbanques->getId()) ?>"><i class="ace-icon fa fa-credit-card bigger-110"></i> Relevé Identité Caisse</a>
                </li>
                <li>
                    <a type="button" href="<?php echo url_for('caissesbanques/edit?id=' . $caissesbanques->getId()) ?>" class="btn btn-primary width-fixed">
                        <i class="ace-icon fa fa-edit bigger-110"></i> Modifier Fiche
                    </a>
                </li>
                <li>
                    <a onclick="if (confirm('Êtes-vous sûr ?')) {
                            var f = document.createElement('form');
                            f.style.display = 'none';
                            this.parentNode.appendChild(f);
                            f.method = 'post';
                            f.action = this.href;
                            var m = document.createElement('input');
                            m.setAttribute('type', 'hidden');
                            m.setAttribute('name', 'sf_method');
                            m.setAttribute('value', 'delete');
                            f.appendChild(m);
                            f.submit();
                        }
                        ;
                        return false;" type="button" class="btn btn-danger width-fixed" href="<?php echo sfconfig::get('sf_appdir') ?>tresoriecaisse_dev.php/caissesbanques/<?php echo $caissesbanques->getId() ?>" class="btn btn-xs btn-danger" style="border: none;font-size: 14px;text-align: center;"><i class="ace-icon fa fa-bitbucket bigger-110"></i> Supprimer Fiche</a>
                </li>
            </ul>
        </div>
    </div>
</td>

<style>

    .width-fixed{
        min-width: 215px;
    }

</style>