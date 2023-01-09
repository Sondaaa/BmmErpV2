<div id="sf_admin_content" ng-controller="CtrlScan">
    <div class="row ">
        <div class="col-md-9">
            <div class="panel panel-default">
                <!-- /.panel-heading -->

                <iframe src="http://localhost:5000?url=<?php echo sfconfig::get('sf_appdir') ?>marchee.php/marches/Uploaderfile&id=<?php echo $id ?>" height="600" width="100%"></iframe>
                <!--                <div class="panel-body" id="imgmodel" style="height: 600px">
                    
                </div>-->
                <!-- /.panel-body -->
            </div>
        </div>
      
        <div class="col-md-3">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?php
                    $formp = new PiecejointForm();
                    $piecejoints = Doctrine_Core::getTable('piecejoint')->findByIdMarche($marche->getId());
                    include_partial('document/formparcourriermarche', array('form' => $formp, 'marche' => $marche, 'piecejoints' => $piecejoints));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div id="sf_admin_footer"></div>
</div>