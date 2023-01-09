<div id="sf_admin_content" ng-controller="CtrlScan">
    <div class="row ">
        <div class="col-md-9">
            <div class="panel panel-default">
                <!-- /.panel-heading -->

                <iframe src="http://localhost:5000?url=<?php echo sfconfig::get('sf_appdir') ?>marchee.php/pvrception/Uploaderfile&id=<?php echo $id ?>" height="600" width="100%"></iframe>
                <!--                <div class="panel-body" id="imgmodel" style="height: 600px">
                    
                </div>-->
                <!-- /.panel-body -->
            </div>
        </div>
        <!--        <div class="col-md-4">
            <div class="panel panel-default">
                 /.panel-heading 
                <div class="panel-body">
                    <fieldset style="padding: 10px">
                        <legend>Attacher fiche scannée</legend>
                        <div class="col-lg-12">
                            <div class="content">
                                <a href="http://localhost:5000" target="_blanc">Scan</a>
                                <input type="button" value="SCAN NOUVEAUX DOCUMENTS" ng-click="ScanDoc('<?php // echo url_for('Scan/Lancerscan') 
?>');" class="btn btn-info">
                                <input ng-click="ValiderAttachement('<?php // echo sfconfig::get('sf_appdir') 
?>bureauxdordre.php/courrier/Validerattachement',<?php
        //                                if (isset($id))
        //                                    echo $id;
        //                                else
        //                                    echo "0"
        ?>)" type="button" value="VALIDER ATTACHEMENT" ng-click="" class="btn btn-info">
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>-->
        <div class="col-md-3">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?php
                    $formp = new PiecejointForm();
                    $piecejoints = Doctrine_Core::getTable('piecejoint')->findByIdPvreceptionmarche($pvrception->getId());
                    include_partial('document/formparcourrier', array('form' => $formp, 'pvrception' => $pvrception, 'piecejoints' => $piecejoints));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div id="sf_admin_footer"></div>
</div>