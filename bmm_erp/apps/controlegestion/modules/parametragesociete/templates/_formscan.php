<div id="sf_admin_content" ng-controller="CtrlScan">
    <div class="row ">
        <div class="col-md-9">
            <div class="panel panel-default">
                <!-- /.panel-heading -->

                <iframe src="http://localhost:5000?url=<?php echo sfconfig::get('sf_appdir') ?>controlegestion.php/parametragesociete/Uploaderfile&id=<?php echo $parametrage_societe->getId()  ?>" height="600" width="100%"></iframe>
                
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
                    $formp = new PiecejointForm();
                    $piecejoints = Doctrine_Core::getTable('piecejoint')->findByIdParametragesociete($id);
                    include_partial('formparsociete', array('form' => $formp, 'parametrage_societe' => $parametrage_societe, 'piecejoints' => $piecejoints));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>