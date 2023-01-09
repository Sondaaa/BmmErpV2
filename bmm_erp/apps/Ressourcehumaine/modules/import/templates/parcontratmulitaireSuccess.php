<div id="sf_admin_container">
    <h1 id="replacediv"> Import 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Contrat Mulitaire
        </small>
    </h1>
</div>
<div id="" class="panel panel-green">
    <div id="sf_admin_content">

        <form action="<?php echo url_for('import/parcontrat?imp=contrat')?>"  name="form_upload" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Fichier</label>

                <input name="lib_fichier"  type="file">
                <p class="help-block">upload le fichier d'importation (extension .csv séparateur point vergule).</p>
            </div>
            
            <input type="submit" class="btn btn-white btn-success">
            <input type="reset" class="btn btn-white btn-default">
        </form>
    </div>
</div>
