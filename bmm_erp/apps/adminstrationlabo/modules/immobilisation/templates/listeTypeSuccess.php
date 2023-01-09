<div id="sf_admin_container">
    <h1 id="replacediv"> Immobilisation
        <small><i class="ace-icon fa fa-angle-double-right"></i> Liste des Immobilisations / Type Affectation</small>
    </h1>
</div>

<div id="sf_admin_bar">
    <div class="sf_admin_filter">
        <table style="margin-bottom: 0px;">
            <tr>
                <td><label>Type Affectation</label></td>
                <td>
                    <select id="id_type_affectation">
                        <option></option>
                        <?php $types = TypeaffectationimmoTable::getInstance()->getAll(); ?>
                        <?php foreach ($types as $type): ?>
                            <option value="<?php echo $type->getId() ?>"><?php echo $type; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><button style="float: right;" class="btn btn-xs btn-success" onclick="chercher()">Recherche</button></td>
            </tr>
        </table>
    </div>
</div>

<div id="zone_search">
    
</div>

<script>

    function chercher() {
        if ($("#id_type_affectation").val()) {
            $.ajax({
                url: '<?php echo url_for('immobilisation/getByTypeAffectation') ?>',
                data: 'id=' + $("#id_type_affectation").val(),
                success: function (data) {
                    $("#zone_search").html(data);
                }
            });
        } else {
            bootbox.dialog({
                message: "Veuillez choisir un type d'affectation !",
                buttons: {
                    "success": {
                        "label": "OK",
                        "className": "btn-sm btn-primary"
                    }
                }
            });
        }
    }

</script>