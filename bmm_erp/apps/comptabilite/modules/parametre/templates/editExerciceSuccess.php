<form>
    <fieldset>
        <label>Exercice Comptable * :</label>
        <input id="libelle_edit" placeholder="Libellé exercice comptable" readonly="true" type="text" value="<?php echo $exercice->getLibelle() ?>" />
    </fieldset>
    <br>
    <fieldset>
        <div class="col-xs-6">
            <label>Date Ouverture :</label>
            <input id="date_debut_edit" type="date" value="<?php echo $exercice->getDateDebut() ?>" onchange="setLibelleEdit()" />
        </div>
        <div class="col-xs-6">
            <label>Date Clôture :</label>
            <input id="date_fin_edit" type="date" value="<?php echo $exercice->getDateFin() ?>" />
        </div>
    </fieldset>

    <hr />
    <div class="row">
        <div class="col-xs-12">
            <button type="button" class="btn btn-sm btn-default pull-right" onclick="annuler()">
                Annuler
                <i class="ace-icon fa fa-undo icon-on-right bigger-110"></i>
            </button>
            <button type="button" class="btn btn-sm btn-info pull-right" style="margin-right: 10px;" onclick="modifier(<?php echo $exercice->getId() ?>)">
                Modifier
                <i class="ace-icon fa fa-edit icon-on-right bigger-110"></i>
            </button>
        </div>
    </div>
</form>

<script  type="text/javascript">

    function setLibelleEdit() {
        var input = $('#date_debut_edit').val();
        var d = new Date(input);
        if (!!d.valueOf()) { // Valid date
            var year = d.getFullYear();
            var month = d.getMonth();
            var day = d.getDate();
            $('#libelle_edit').val(year);
            var min_date = year + '-' + month + '-' + day;
            var max_date = year + '-12-31';
            $('#date_fin_edit').attr('min', min_date);
            $('#date_fin_edit').attr('max', max_date);
            $('#date_fin_edit').val(max_date);
        } else { /* Invalid date */
            $('#libelle_edit').val('');
        }
    }

</script>