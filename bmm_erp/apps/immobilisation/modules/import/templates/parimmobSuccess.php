<div id="sf_admin_container">
    <h1 id="replacediv">Import les Fiche d'immobilisation</h1>
    <div id="sf_admin_content">
        <div id="" class="panel panel-green">
            <div id="sf_admin_content">
                <form action="<?php echo url_for('import/parimmob?imp=immob') ?>"  name="form_upload" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Fichier</label>

                        <input name="lib_fichier"  type="file">
                        <p class="help-block">upload le fichier d'importation (extension .csv séparateur point vergule).</p>
                    </div>
                    <input  type="submit" class="btn btn-outline btn-success">
                    <input type="reset" class="btn btn-outline btn-success">
                </form>
            </div>
        </div>
    </div>
</div>