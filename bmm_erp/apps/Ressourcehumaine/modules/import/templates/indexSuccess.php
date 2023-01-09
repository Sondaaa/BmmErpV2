<div id="" class="panel panel-green">
    <div id="replacediv" class="panel-heading">Import Taux d'ammortissement </div>
    <div id="sf_admin_content">

        <form action="<?php echo url_for('import/index?imp=taux')?>"  name="form_upload" role="form" method="post" enctype="multipart/form-data">
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
<div id="" class="panel panel-green">
    <div id="replacediv" class="panel-heading">Import Mode d'ammortisement </div>
    <div id="sf_admin_content">

        <form action="<?php echo url_for('import/index?imp=mode')?>"  name="form_upload" role="form" method="post" enctype="multipart/form-data">
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
<div id="" class="panel panel-green">
    <div id="replacediv" class="panel-heading">Import Compte Comptable </div>
    <div id="sf_admin_content">

        <form action="<?php echo url_for('import/index?imp=codec')?>"  name="form_upload" role="form" method="post" enctype="multipart/form-data">
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