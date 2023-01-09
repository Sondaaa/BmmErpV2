<div id="sf_admin_container">
    <h1 id="replacediv"> Immobilisation 
        <small><i class="ace-icon fa fa-angle-double-right"></i> Import</small>
    </h1>
</div>

<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-blue ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-upload"></i>
                Import Taux d'ammortisement
            </h5>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <form action="<?php echo url_for('import/index?imp=taux') ?>" name="form_upload" role="form" method="post" enctype="multipart/form-data">
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
                Import Mode d'ammortisement
            </h5>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <form action="<?php echo url_for('import/index?imp=mode') ?>"  name="form_upload" role="form" method="post" enctype="multipart/form-data">
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
                Import Compte Comptable
            </h5>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <form action="<?php echo url_for('import/index?imp=codec') ?>" name="form_upload" role="form" method="post" enctype="multipart/form-data">
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