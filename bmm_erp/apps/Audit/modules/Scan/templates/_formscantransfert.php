<div id="sf_admin_content" ng-controller="CtrlScan">
    <div class="row">
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
                        <legend>Attacher fiche scannée</legend>
                        <div class="col-lg-12">
                            <div class="content">
                                <input type="button" value="SCAN NOUVEAUX DOCUMENT" ng-click="ScanDoc('<?php echo url_for('Scan/Lancerscan') ?>');" class="btn btn-info">
                                <input ng-click="ValiderAttachementBudget('<?php echo sfconfig::get('sf_appdir') ?>budget.php/transfertbudget/Validerattachement',<?php
                                if (isset($id))
                                    echo $id;
                                else
                                    echo "0"
                                    ?>)" type="button" value="VALIDER ATTACHEMENT" ng-click="" class="btn btn-info">
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?php
                    $formp = new PiecejointForm();
                    $piecejoints = Doctrine_Core::getTable('piecejoint')->findByIdTransfert($id);
                    include_partial('document/formtransfert', array('form' => $formp, 'transfert' => $transfert, 'piecejoints' => $piecejoints));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div id="sf_admin_footer">
    </div>
</div>