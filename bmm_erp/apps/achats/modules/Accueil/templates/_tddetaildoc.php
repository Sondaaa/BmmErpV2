<a href="#my-modal_<?php echo $boncomm->getIdTypedoc() ?>_<?php echo $boncomm->getId() ?>" role="button"  data-toggle="modal">
    <?php if ($boncomm->getIdTypedoc() != 8): ?>
        <?php echo $boncomm->getNumerodocachat() ?>
    <?php else: ?>
        <?php if ($boncomm->getNumerooperation()): ?>
            <?php echo $boncomm->getNumerodocachat() . '/' . $boncomm->getNumerooperation() ?>
        <?php else: ?>
            <?php echo $boncomm->getNumerodocachat() ?>
        <?php endif; ?>
    <?php endif; ?>
</a>
<br>
<?php
$numero = strtoupper($boncomm->getTypedoc());
$numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
?>
<div id="my-modal_<?php echo $boncomm->getIdTypedoc() ?>_<?php echo $boncomm->getId() ?>" class="modal fade" tabindex="-1">
    <div class="modal-dialog" style="width: 75%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="smaller lighter blue no-margin"><?php echo $numero ?> <?php echo $boncomm ?></h3>
            </div>
            <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px;">
                <div style="margin-top: 10px; margin-bottom: 10px;">
                    <?php
                    if ($boncomm->getIdTypedoc() == 17 || $boncomm->getIdTypedoc() == 2) {
                        echo html_entity_decode($boncomm->ReadHtmlBondeponse());
                    }
                    ?>
                    <?php
                    if ($boncomm->getIdTypedoc() == 18 || $boncomm->getIdTypedoc() == 7) {
                        echo html_entity_decode($boncomm->ReadHtmlBonexterne());
                    }
                    ?>
                    <?php if ($boncomm->getIdTypedoc() == 8) { ?>
                        <?php echo html_entity_decode($boncomm->getHtmlDemandedeprix()); ?> 
                    <?php } ?>
                    <?php
                    if ($boncomm->getIdTypedoc() == 6) {
                        $aviss = Doctrine_Core::getTable('avis')
                                        ->createQuery('a')->where('id_poste=5')
                                        ->orderBy('id asc')->execute();
                        $listesdocuments = Doctrine_Core::getTable('lignedocachat')
                                        ->createQuery('a')
                                        ->where('id_doc=' . $boncomm->getId())->orderBy('id asc')->execute();
                        ?>
                        <?php echo html_entity_decode($boncomm->getBonCommandeInterneFormForAchat()); ?>
                        <?php // echo html_entity_decode($boncomm->ReadHtmlBonCommandeInterne($aviss, $listesdocuments)); ?> 
                    <?php } ?>
                    <?php if ($boncomm->getIdTypedoc() == 19) { ?>
                        <?php
                        $listesdocuments = Doctrine_Core::getTable('lignedocachat')
                                        ->createQuery('a')
                                        ->where('id_doc=' . $boncomm->getId())->orderBy('id asc')->execute();
                        echo html_entity_decode($boncomm->ReadHtmlContrat($listesdocuments));
                        ?>
                        <style>
                            table tbody tr td, table tbody tr th{font-size: 12px !important;}
                        </style>
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Fermer
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>