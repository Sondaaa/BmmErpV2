<form>
    <fieldset>
        <label>Type compte * :</label>
        <input id="libelle_edit" placeholder="Libellé type compte comptable" type="text" value="<?php echo $type_compte->getLibelle() ?>" class="form-control" />
    </fieldset>

    <hr />
    <div class="row">
        <div class="col-xs-12">
            <button type="button" class="btn btn-sm btn-default pull-right" onclick="annuler()">
                Annuler
                <i class="ace-icon fa fa-undo icon-on-right bigger-110"></i>
            </button>
            <button type="button" class="btn btn-sm btn-info pull-right" style="margin-right: 10px;" onclick="modifier(<?php echo $type_compte->getId() ?>)">
                Modifier
                <i class="ace-icon fa fa-edit icon-on-right bigger-110"></i>
            </button>
        </div>
    </div>
</form>