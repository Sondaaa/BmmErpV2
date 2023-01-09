<div id="sf_admin_container">
    <div id="sf_admin_content">
        <div class="col-sm-6">
            <div class="tab-content">

                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $piecejointbudget = PiecejointbudgetTable::getInstance()->findByIdDocumentbudget($documentbudget->getId())->getFirst();
                        if ($piecejointbudget->getIdDocachat()):
                            ?>                        
                            <a class="btn btn-success btn-sm" target="__blanc" href="<?php echo url_for('Ordonnancement/Imprimerordonnance?id=' . $documentbudget->getId()) ?>">
                                <i class="fa fa-file-pdf-o"></i> Impression Fiche d'ordonnancement </a>
                            <?php echo html_entity_decode($documentbudget->ReadHtmlOrdonnance($documentbudget->getId())) ?>
                        <?php else: ?>
                            <a class="btn btn-success btn-sm" target="__blanc" href="<?php echo url_for('Ordonnancement/ImprimerordonnanceHorsBCI?id=' . $documentbudget->getId()) ?>">
                                <i class="fa fa-file-pdf-o"></i> Impression Fiche d'ordonnancement </a>
                                <?php echo html_entity_decode($documentbudget->ReadHtmlOrdonnanceHorBCI($documentbudget->getId())) ?>


                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>

        <!--/.col -->
    </div>
</div>