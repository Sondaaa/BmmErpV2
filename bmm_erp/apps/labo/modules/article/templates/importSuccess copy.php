<div id="" class="panel panel-green">
    <div id="sf_admin_container"   >
        <h1>Import les fiches articles & Stocks</h1>
    </div>
    <div id="sf_admin_content">
        <fieldset>
            <legend>Import Fiche Article</legend>
            <form action="<?php echo url_for('article/import?param=importfichierarticle') ?>"  name="form_upload" role="form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Fichier</label>

                    <input name="lib_fichier"  type="file">
                    <p class="help-block">Charger le fichier d'importation (extension .csv séparateur point virgule).</p>
                </div>
                <input  type="submit" class="btn btn-outline btn-success">

            </form>
        </fieldset>

    </div>
    <fieldset>
        <legend>Import Articles/Magasins</legend>
        <form action="<?php echo url_for('article/importmag?param=importfichierarticle') ?>"  name="form_upload" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Fichier</label>

                <input name="lib_fichier"  type="file">
                <p class="help-block">Charger le fichier d'importation (extension .csv séparateur point virgule).</p>
            </div>
            <input  type="submit" class="btn btn-outline btn-success">

        </form>
    </fieldset>

</div>
