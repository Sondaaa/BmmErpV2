<div id="sf_admin_content" ng-controller="CtrlScan">
    <div class="row ">
        

        <div class="col-md-12">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?php
                    $formp = new PiecejointForm();
                    $piecejoints = Doctrine_Core::getTable('piecejoint')->findByIdDocachat($id);
                    include_partial('documentachat/formparcourrier', array('form' => $formp, 'documentachat' => $documentachat, 'piecejoints' => $piecejoints));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div id="sf_admin_footer"></div>
</div>