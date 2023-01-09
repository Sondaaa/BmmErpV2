<div id="sf_admin_content" ng-controller="CtrlScan">
    <div class="row ">
        <div class="col-md-6">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body" id="imgmodel" style="height: 600px">

                </div>
                <!-- /.panel-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <fieldset style="padding: 10px">
                        <legend>Attaché fiche scanner</legend>
                        <div class="col-lg-12">
                            <div class="content">
                                <input type="button" value="SCAN NOUVEAUX DOCUMENT" ng-click="ScanDoc('<?php echo url_for('Scan/Lancerscan') ?>');"  class="btn btn-info">
                                <input ng-click="ValiderAttachementOS('<?php echo sfconfig::get('sf_appdir') ?>marchee.php/ordredeservice/Validerattachement',<?php
                                if (isset($document))
                                    echo $document->getId();
                                else
                                    echo "0"
                                    ?>)" type="button" value="VALIDER ATTACHEMENT" class="btn btn-info">
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default" >
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?php
                    $formp = new PiecejointForm();
                    $piecejoints = Doctrine_Core::getTable('piecejoint')->findByIdOrdreservice($document->getId());
                    include_partial('document/formparcourrier', array('form' => $formp, 'document' => $document, 'piecejoints' => $piecejoints));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div id="sf_admin_footer">
    </div>
</div>
