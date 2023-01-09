
<form  method="post" enctype="multipart/form-data" action="<?php echo url_for('@updateDossier') . '?id=' . $referentiel->getId() ?>">

    <fieldset>
        <table><tr>
                <td>
                    <label>Dossier Comptable * :</label></td>
                <td colspan="2">
                    <input id="libelle_dossier_edit" name="libelle_dossier_edit" type="text" placeholder="Libellé Dossier" value="<?php echo $referentiel->getLibelle() ?>" class="form-control" />
                </td>
            </tr>
            <tr>
                <td><label>Choisir le Dossier </label></td>
                <td> <input name="lib_dossier_fichier_edit" id="lib_dossier_fichier_edit" type="file" 
                            value="<?php echo $referentiel->getUrl() ?>"><?php echo $referentiel->getUrl() ?>
                </td>
            </tr>
        </table>
    </fieldset>

    <hr />
    <div class="row">
        <div class="col-xs-12">
            <button type="button" class="btn btn-sm btn-default pull-right" onclick="annuler()">
                Annuler
                <i class="ace-icon fa fa-undo icon-on-right bigger-110"></i>
            </button>
            <input type="submit" class="btn btn-sm btn-info pull-right" style="margin-right: 10px;" value="modifier">
           
        </div>
    </div>
</form>