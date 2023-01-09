<div id="sf_admin_container">
    <h1 id="replacediv"> Importation 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Importer Trésorerie / Excel
        </small>
    </h1>
</div>
<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-blue2 ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-upload"></i>
                Import Trésorerie
            </h5>
            <div class="widget-toolbar">
                <a href="<?php echo sfconfig::get('sf_appdir') ?>uploads/import_format/tresorerie.xlsx" target="_blank">
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
                <form action="<?php echo url_for('importation/goTresorerieExcel') ?>" name="form_upload" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label><b>Fichier</b></label>
                        <input name="lib_fichier" type="file">
                        <p class="help-block">upload le fichier d'importation (extension .xlsx).</p>
                    </div>
                    <hr style="margin-top: 10px; margin-bottom: 10px;">
                    <div style="text-align: right;">
                        <input type="submit" class="btn  btn-success" value="Importer">
                        <input type="reset" class="btn  btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-blue2 ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-info"></i> Instructions : Import Trésorerie</h5>
        </div>
        <div class="widget-body">
            <div class="widget-main">
                <div class="col-sm-12">
                    Importer les Trésorerie : Règlement
                    <hr style="margin-bottom: 10px; margin-top: 10px;">
                    <ol id="info_import">
                        <li>Télécharger le fichier <a href="<?php echo sfconfig::get('sf_appdir') ?>uploads/import_format/tresorerie.xlsx" target="_blank"><i class="ace-icon fa fa-hand-o-right"></i> tresorerie.xlsx <i class="ace-icon fa fa-file-excel-o green"></i></a></li>
                        <li>Saisir les données dans le fichier <i class="ace-icon fa fa-hand-o-right"></i> tresorerie.xlsx
                            <br>
                            <span style="color: #9d4040;">(Ne supprimer pas les 2 premiers lignes, ne changer plus le 2ème ligne)</span>
                        </li>
                        <li>Upload le fichier <i class="ace-icon fa fa-hand-o-right"></i> tresorerie.xlsx, puis envoyer</li>

                        <li>Traiter les données</li>
                        
                        <li>Préparer les pré-enregistrements (les Règlements )</li>
                        <li>Enregistrer les Règlements et finaliser l'importation du Trsorerie</li>
                    </ol>
                    <hr style="margin-bottom: 10px; margin-top: 10px;">
                     </div>
                <div class="row"></div>
            </div>
        </div>
    </div>
</div>

<style>

    #info_import li {line-height: 2;}

</style>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : Importer les Ventes par Excel");
</script>