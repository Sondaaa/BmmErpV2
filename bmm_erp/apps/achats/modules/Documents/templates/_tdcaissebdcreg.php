<?php
$lignes = LigneoperationcaisseTable::getInstance()->findByIdDocachatAndIdCategorie($boncomm->getId(), 2);
if (sizeof($lignes) >= 1) {
    foreach ($lignes as $ligne):
        ?>
        <a href="#my-modalcp_<?php echo $ligne->getIdType() ?>_<?php echo $ligne->getId() ?>" role="button" data-toggle="modal">
            QUITTANCE <?php echo $ligne->getCategorieoperation() ?> N°: <?php echo $ligne->getNumerodocachat() ?>
        </a>
        <div id="my-modalcp_<?php echo $ligne->getIdType() ?>_<?php echo $ligne->getId() ?>" class="modal fade" tabindex="-1">
            <div class="modal-dialog" style="width: 75%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="smaller lighter blue no-margin">FICHE QUITTANCE <?php echo $ligne->getTypeoperation() ?> </h3>
                    </div>
                    <div class="modal-body">
                        <?php echo html_entity_decode($ligne->getHtmlDocProvisoirecaisse()); ?>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                            <i class="ace-icon fa fa-times"></i>
                            Fermer
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div></br>
    <?php endforeach;
}
?>