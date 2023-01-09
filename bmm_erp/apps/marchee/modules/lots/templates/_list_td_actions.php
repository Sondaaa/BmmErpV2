<?php $listesdetailprix = Doctrine_Core::getTable('detailprix')->findOneByIdLotsAndIdTypedetailprix($lots->getId(), 2); ?>
<?php $ordredeservice = Doctrine_Core::getTable('ordredeservice')->findOneByIdBenificaireAndIdType($lots->getId(), 1); ?>

<td id="actionlots">
    <div class="btn-group">
        <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
            Action
            <span class="ace-icon fa fa-caret-down icon-on-right"></span>
        </button>
        <ul class="dropdown-menu dropdown-primary">
            <?php if ($listesdetailprix) { ?>
                <li>
                    <a href="<?php echo url_for('lots/Detailsousdetails') . '?id=' . $lots->getId() ?>">Détail Sous Détail de Prix</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="<?php echo url_for('lots/remplirios') . '?id=' . $lots->getId() ?>">Créer Ordre de Service</a>
                </li>

                <li class="divider"></li>
                <!--                <li>
                                    <a href="<?php //echo url_for('lots/rempliravanace') . '?id=' . $lots->getId()                   ?>">Détail & Remplir Décompte</a>
                                </li>-->

                <!--                <li class="divider"></li>-->
                <li>
                    <a href="<?php echo url_for('lots/misajourpiriode') . '?id=' . $lots->getId() ?>">Mise à jour Bénéficiaire</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="<?php echo url_for('lots/misajourtablevariete') . '?id=' . $lots->getId() ?>">Variation dans la Masse</a>
                </li>
            <?php } else { ?>
                <?php echo $helper->linkToEdit($lots, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Remplir  Sous Détail de prix',)) ?>
            <?php } ?>
        </ul>
    </div>
    <?php if ($listesdetailprix) { ?>
        <div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                Avenant
                <span class="ace-icon fa fa-caret-down icon-on-right"></span>
            </button>
            <ul class="dropdown-menu dropdown-primary">
                <li>
                    <a href="<?php echo url_for('lots/rempliravenant') . '?id=' . $lots->getId() ?>">Avenant Type Date </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="<?php echo url_for('lots/rempliravenanttype2') . '?id=' . $lots->getId() ?>">Avenant Type Sous Détail de Prix</a>
                </li>
            </ul>
        </div>
    <?php } ?>
    <?php if ($ordredeservice) { ?>
        <div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-white btn-primary dropdown-toggle">
                <span class="menu-text"> P.V. de Réception</span>
                <span class="ace-icon fa fa-caret-down icon-on-right"></span>
            </button>
            <ul class="dropdown-menu dropdown-primary">
                <li>
                    <a href="<?php echo url_for('pvrception/new?type=pro') . '&id=' . $lots->getId() ?>">P.V. de Réception Provisoire </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="<?php echo url_for('pvrception/new?type=def') . '&id=' . $lots->getId() ?>">P.V. de Réception Définitif</a>
                </li>
            </ul>
        </div>
    <?php } ?>

    <a target="_blank" id="lots_print" type="button" class="btn btn-sm btn-white btn-success"
       href="<?php echo url_for('lots/ImprimerFiche') . '?id=' . $lots->getId() ?>">
        <i class="ace-icon fa fa-file-pdf-o align-top bigger-120"></i> Fiche</a>
    <a target="_blank" id="lots_print" type="button" class="btn btn-sm btn-white btn-success" href="<?php echo url_for('lots/ImprimerDecomptes') . '?id=' . $lots->getId() ?>"><i class="ace-icon fa fa-file-pdf-o align-top bigger-120"></i> Décomptes</a>
</td>