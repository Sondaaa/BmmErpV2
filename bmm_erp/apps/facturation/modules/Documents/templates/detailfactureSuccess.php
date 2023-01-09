<div id="sf_admin_container">
    <h1 id="replacediv"> 
        Détail : <?php echo $documentachat->getNumerodocachat() ?>
    </h1>
    <?php if ($documentachat->getIdTypedoc() == 7) { ?>
        <?php echo html_entity_decode($documentachat->ReadHtmlBonexterne()); ?> 
        <a class="btn btn-white btn-default" href="<?php echo url_for('Documents/Imprimerbonexterne?iddoc=') . $documentachat->getId() ?>"    target="_blanc">Exporter PDF</a>
    <?php } ?>
    <?php if ($documentachat->getIdTypedoc() == 15) { ?>
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#accuelbci" data-toggle="tab" aria-expanded="true">Détail</a>
                </li>
                <li class="">
                    <a href="#scan" data-toggle="tab" aria-expanded="false">Scan</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="accuelbci">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php echo html_entity_decode($documentachat->ReadHtmlFactureImression($id)); ?> 
                            <div class="col-lg-12">
                                <a style="margin-left: 10px;" class="btn btn-white btn-success pull-right" href="<?php echo url_for('Documents/Imprimerdocentre?iddoc=') . $documentachat->getId() ?>" target="_blanc">
                                    <i class="ace-icon fa fa-undo"></i> Retour à la Liste
                                </a>
                                <a class="btn btn-white btn-default pull-right" href="<?php echo url_for('Documents/Imprimerdocentre?iddoc=') . $documentachat->getId() ?>" target="_blanc">
                                    <i class="ace-icon fa fa-file-pdf-o"></i> Exporter en PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="scan">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="documentscan" class="col-md-12">
                                <div id="sf_admin_content" ng-controller="CtrlScan">
                                    <div class="row ">
                                        <div  class="col-md-6">
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
                                                                <input type="button" value="SCANNER NOUVEAUX DOCUMENT" ng-click="ScanDocDemandeachat();" class="btn btn-info">
                                                                <input ng-click="ValiderAttachementDoucumentachat(<?php echo $documentachat->getId() ?>)" type="button" value="VALIDER ATTACHEMENT" class="btn btn-info">
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset style="padding: 10px;">
                                                        <div class="col-lg-12" >
                                                            <div class="content">
                                                                <input type="button" value="AFFICHER LES ATTACHEMENTS" ng-click="AfficheDemandedeprix(<?php echo $documentachat->getId() ?>);" class="btn btn-info"><br>
                                                                <table>
                                                                    <tr ng-repeat="att in attachements">
                                                                        <td>
                                                                            <a target="_blanc" href="<?php echo sfconfig::get('sf_appdir') . "uploads/scanner/" ?>{{att.chemin}}">
                                                                                <img src="<?php echo sfconfig::get('sf_appdir') . "uploads/scanner/" ?>{{att.chemin}}" style="width: 50px">
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if ($documentachat->getIdTypedoc() == 8) { ?>
        <?php echo html_entity_decode($documentachat->getHtmlDemandedeprix()); ?> 
        <a class="btn btn-white btn-default" href="<?php echo url_for('Documents/Imprimerdemandedachat?iddoc=') . $documentachat->getId() ?>" target="_blanc">Exporter en PDF</a>
    <?php } ?>
    <?php if ($documentachat->getIdTypedoc() == 2) { ?>
        <?php echo html_entity_decode($documentachat->ReadHtmlBondeponse()); ?> 
        <a class="btn btn-white btn-default" href="<?php echo url_for('Documents/Imprimerbondeponse?iddoc=') . $documentachat->getId() ?>" target="_blanc">Exporter en PDF</a>
    <?php } ?>
</div>

<style>

    h3{text-align: center;}

</style>