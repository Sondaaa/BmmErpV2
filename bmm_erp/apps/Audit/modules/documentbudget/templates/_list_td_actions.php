<td style="text-align: center;">
    <ul class="sf_admin_td_actions" style="width: 100%;">
        <?php echo $helper->linkToEdit($documentbudget, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Détail & Imprimer',)) ?>
        <?php //echo $helper->linkToDelete($documentbudget, array(  'params' =>   array(  ),  'confirm' => 'Êtes-vous sûr ?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>

        <?php // if ($documentbudget->getCertificatretenue()->count() > 0): ?>
<!--            <li>
                <a class="btn btn-primary" target="__blanc" href="<?php // echo url_for('certificatretenue/show?id=' . $documentbudget->getCertificatretenue()->getFirst()->getId()); ?>">
                    Certificat de R.S
                    <i class="ace-icon fa fa-eye icon-on-right"></i>
                </a>
            </li>-->
        <?php // endif; ?>
    </ul>
</td>

<style>

    .sf_admin_td_actions li{margin-left: 0px !important; margin-right: 10px;}
    ul{margin: 0px 0px 0px 0px !important;}

</style>