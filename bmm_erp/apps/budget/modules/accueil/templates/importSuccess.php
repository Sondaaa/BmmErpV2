<div id="sf_admin_container">
    <h1 id="replacediv"> Achat
        <small><i class="ace-icon fa fa-angle-double-right"></i> Import</small>
    </h1>
</div>

<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-green2 ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-upload"></i>
                Import Achats
            </h5>
            <div class="widget-toolbar">
                <a href="<?php echo sfconfig::get('sf_appdir') ?>uploads/import_format/achat.xlsx" target="_blank">
                    <i class="ace-icon fa fa-download white"></i>
                </a>

                <a href="#" data-action="reload"><i class="ace-icon fa fa-refresh"></i></a>
                <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                <a href="#" data-action="close"><i class="ace-icon fa fa-times"></i></a>
                <a href="#" data-action="fullscreen" class="orange2"><i class="ace-icon fa fa-expand"></i></a>
            </div>
        </div>

        <div class="widget-body" ng-controller="myCtrlimport">
            <div class="widget-main">
                <form action="<?php echo url_for('accueil/importAchat') ?>" name="form_upload" role="form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12" style="  background-color: #2e8965;padding: 5%; color: white;font-size: 18px;">
                            <div class="col-md-8">
                                <label>Titre Budget </label>
                                <select id="budget" name="budget">
                                    <option value=""></option>
                                    <?php foreach ($titres as $titre) : ?>
                                        <option value="<?php echo $titre->getId() ?>">
                                            <?php echo $titre ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                            <div class="col-md-8" id="div_tranche">
                                <label>Tranche </label>
                                <select id="tranche" name="tranche">
                                   
                                </select>
                            </div>
                            <div class="col-md-8" id="div_rubrique">
                                <label>Rubrique </label>
                                <select id="rubrique" name="rubrique">
                                   
                                </select>
                            </div>
                            <div class="col-md-8" id="div_sousrubrique">
                                <label>Sous Rubrique </label>
                                <select id="sousrubrique" name="sousrubrique">
                                   
                                </select>
                            </div>

                            </div>
                        </div>
                        <div class="col-md-12" style="background-color: #2e896526;">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Type d'operation </label>
                                        <select id="caisse_banque" name="caisse_banque">
                                            <option value="BCES">Banque (BCE)</option>
                                            <option value="BDCS">Caisse (BDC)</option>
                                        </select>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <label><b>Fichier</b></label>
                                    <input name="lib_fichier" type="file">
                                    <p class="help-block">upload le fichier d'importation (extension .xlsx).</p>
                                </div>
                            </div>


                        </div>

                    </div>

                    <hr style="margin-top: 10px; margin-bottom: 10px;">
                    <div style="text-align: right;">
                        <input type="submit" class="btn btn-xs btn-success">
                        <input type="reset" class="btn btn-white btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-green2 ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-info"></i> Instructions : Import Operation budget</h5>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="col-sm-12">
                    Importer l'achat : D.I. <i class="ace-icon fa fa-angle-double-right blue"></i> B.D.C ou B.C.E <i class="ace-icon fa fa-angle-double-right blue"></i> Facture <i class="ace-icon fa fa-angle-double-right blue"></i> Op??ration (pr??-ordonnance).
                    <hr style="margin-bottom: 10px; margin-top: 10px;">
                    <ol id="info_import">
                        <li>T??l??charger le fichier <a href="<?php echo sfconfig::get('sf_appdir') ?>uploads/import_format/ImportOperationBudget.xlsx" target="_blank"><i class="ace-icon fa fa-hand-o-right"></i> OperationBudget.xlsx <i class="ace-icon fa fa-file-excel-o green"></i></a></li>
                        <li>Saisir les donn??es dans le fichier <i class="ace-icon fa fa-hand-o-right"></i> achat.xlsx
                            <br>
                            <span style="color: #9d4040;">(Ne supprimer pas les 2 premiers lignes, ne changer plus le 2??me ligne)</span>
                        </li>
                        <li>Upload le fichier <i class="ace-icon fa fa-hand-o-right"></i> achat.xlsx, puis envoyer</li>

                        <li>Traiter les donn??es</li>
                        <li>V??rifier les param??tres : Demandeurs / Services / Articles / Fournisseurs / Unit??
                            <ul class="list-unstyled">
                                <li>
                                    <i class="ace-icon fa fa-caret-right blue"></i>
                                    V??rifier l'existance des param??tres dans la base des donn??es
                                </li>

                                <li>
                                    <i class="ace-icon fa fa-caret-right blue"></i>
                                    Enregistrer les nouveaux param??tres (s'il y en a)
                                </li>
                            </ul>
                        </li>
                        <li>Pr??parer les pr??-enregistrements (les documents d'achats)</li>
                        <li>Enregistrer les documents d'achats et finaliser l'importation d'achat</li>
                    </ol>
                    <hr style="margin-bottom: 10px; margin-top: 10px;">
                    <span style="color: #40539d;"><i class="ace-icon fa fa-info-circle"></i> Veuillez bien v??rifier les param??tres (Demandeurs / Services / ...) pour n'avoir plus des doublons dans la base des donn??es.</span>
                </div>
                <div class="row"></div>
            </div>
        </div>
    </div>
</div>

<style>
    #info_import li {
        line-height: 2;
    }
</style>