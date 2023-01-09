<form>
    <fieldset>
        <label>T.V.A * :</label>
        <input id="libelle_edit" type="text" placeholder="Libellé T.V.A" value="<?php echo $tva->getLibelle() ?>" class="form-control" />
    </fieldset>
    <br>
    <fieldset>
        <div class="col-xs-6">
            <label>Valeur T.V.A ( en % ) * :</label>
            <input id="valeur_tva_edit" type="text" value="<?php echo $tva->getValeurtva() ?>" class="form-control" />
        </div>
    </fieldset>

    <hr />
    <div class="row">
        <div class="col-xs-12">
            <button type="button" class="btn btn-sm btn-default pull-right" onclick="annuler()">
                Annuler
                <i class="ace-icon fa fa-undo icon-on-right bigger-110"></i>
            </button>
            <button type="button" class="btn btn-sm btn-info pull-right" style="margin-right: 10px;" onclick="modifier(<?php echo $tva->getId() ?>)">
                Modifier
                <i class="ace-icon fa fa-edit icon-on-right bigger-110"></i>
            </button>
        </div>
    </div>
</form>

<script  type="text/javascript">

    var spinner = $("#valeur_tva_edit").spinner({
        create: function (event, ui) {
            //add custom classes and icons
            $(this)
                    .next().addClass('btn btn-success').html('<i class="ace-icon fa fa-plus"></i>')
                    .next().addClass('btn btn-danger').html('<i class="ace-icon fa fa-minus"></i>')

            //larger buttons on touch devices
            if ('touchstart' in document.documentElement)
                $(this).closest('.ui-spinner').addClass('ui-spinner-touch');
        }
    });

</script>