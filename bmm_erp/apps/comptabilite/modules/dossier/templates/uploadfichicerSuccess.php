<fieldset>

    <table>
        <thead> Télécharger un Référentiel Comptable </thead>
        <tbody>

            <tr>
                <td>
                    <div class="widget-body">
                        <div class="widget-main">
                            <form action="<?php // echo url_for('importation/goAchatExcel')        ?>" name="form_upload" role="form" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label><b>Fichier</b></label>
                                    <input name="lib_fichier" type="file" src='uploads/scanner' >
                                    <p class="help-block">upload le fichier d'importation (extension .xlsx).</p>
                                </div>
                                <hr style="margin-top: 25px; margin-bottom: 25px;">
                                <div style="text-align: right;">
                                    <button type="button" placeholder="Enregistrer"  class="btn btn-white btn-success" onclick=""> Enregistrer</button>
                                    <button type="button" placeholder="Annuler"  class="btn btn-white btn-primary"> Annuler</button>


                                </div>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>
