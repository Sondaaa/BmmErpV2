<div id="sf_admin_container">
    <h1 id="replacediv"> Marché  
        <small><i class="ace-icon fa fa-angle-double-right"></i> Import</small>
    </h1>
</div>

<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-green2 ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-upload"></i>
                Import Bénéficiaires
            </h5>
            <div class="widget-toolbar">
                <a href="<?php echo sfconfig::get('sf_appdir') ?>uploads/import_format/beneficiaire.csv" target="_blank">
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
                <form action="<?php echo url_for('Accueil/import?imp=beneficiaire') ?>" name="form_upload" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label><b>Fichier</b></label>
                        <input name="lib_fichier" type="file">
                        <p class="help-block">upload le fichier d'importation (extension .csv séparateur point virgule).</p>
                    </div>
                    <hr style="margin-top: 10px; margin-bottom: 10px;">
                    <div style="text-align: right;">
                        <input type="submit" class="btn btn-white btn-success">
                        <input type="reset" class="btn btn-white btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-blue ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-upload"></i>
                Import Détails de Prix
            </h5>
            <div class="widget-toolbar">
                <a href="<?php echo sfconfig::get('sf_appdir') ?>uploads/import_format/beneficiaire.csv" target="_blank">
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
                <form action="<?php echo url_for('Accueil/import?imp=details') ?>"  name="form_upload" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label><b>Fichier</b></label>

                        <input name="lib_fichier" type="file">
                        <p class="help-block">upload le fichier d'importation (extension .csv séparateur point virgule).</p>
                    </div>
                    <hr style="margin-top: 10px; margin-bottom: 10px;">
                    <div style="text-align: right;">
                        <input type="submit" class="btn btn-white btn-success">
                        <input type="reset" class="btn btn-white btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>