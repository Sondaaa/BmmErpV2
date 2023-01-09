<div id="sf_admin_container">
    <h1 id="replacediv"> Article  
        <small><i class="ace-icon fa fa-angle-double-right"></i> Import</small>
    </h1>
</div>

<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-green2 ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-upload"></i>
                Import Articles
            </h5>
            <div class="widget-toolbar">
                <a href="<?php echo sfconfig::get('sf_appdir') ?>uploads/import_format/articles.xlsx" target="_blank">
                    <i class="ace-icon fa fa-download white"></i>
                </a>

                <a href="#" data-action="reload"><i class="ace-icon fa fa-refresh"></i></a>
                <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                <a href="#" data-action="close"><i class="ace-icon fa fa-times"></i></a>
                <a href="#" data-action="fullscreen" class="orange2"><i class="ace-icon fa fa-expand"></i></a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <form action="<?php echo url_for('article/importArticle') ?>" name="form_upload" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label><b>Fichier</b></label>
                        <input name="lib_fichier" type="file">
                        <p class="help-block">upload le fichier d'importation (extension .xlsx).</p>
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
            <h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-info"></i> Instructions : Import Articles</h5>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="col-sm-12">
                    <hr style="margin-bottom: 10px; margin-top: 10px;">
                    <ol id="info_import">
                        <li>Télécharger le fichier <a href="<?php echo sfconfig::get('sf_appdir') ?>uploads/import_format/articles.xlsx" target="_blank"><i class="ace-icon fa fa-hand-o-right"></i> articles.xlsx <i class="ace-icon fa fa-file-excel-o green"></i></a></li>
                        <li>Saisir les données dans le fichier <i class="ace-icon fa fa-hand-o-right"></i> articles.xlsx
                            <br>
                            <span style="color: #9d4040;">(Ne supprimer pas les 2 premiers lignes, ne changer plus le 2ème ligne)</span>
                        </li>
                        <li>Upload le fichier <i class="ace-icon fa fa-hand-o-right"></i> articles.xlsx, puis envoyer</li>

                        <li>Traiter les données</li>
                        <li>Vérifier les paramètres : code / libelle / 
                            <ul class="list-unstyled">
                                <li>
                                    <i class="ace-icon fa fa-caret-right blue"></i>
                                    Vérifier l'existance des paramètres dans la base des données
                                </li>

                                <li>
                                    <i class="ace-icon fa fa-caret-right blue"></i>
                                    Enregistrer les nouveaux paramètres (s'il y en a)
                                </li>
                            </ul>
                        </li>
                        <li>Préparer les pré-enregistrements (les fiches d'article)</li>
                        <li>Enregistrer les documents d'achats et finaliser l'importation d'achat</li>
                    </ol>
                    <hr style="margin-bottom: 10px; margin-top: 10px;">
                    <span style="color: #40539d;"><i class="ace-icon fa fa-info-circle"></i> Veuillez bien vérifier les paramètres (Code / Articles / ...) pour n'avoir plus des doublons dans la base des données.</span>
                </div>
                <div class="row"></div>
            </div>
        </div>
    </div>
</div>

<style>

    #info_import li {line-height: 2;}

</style>