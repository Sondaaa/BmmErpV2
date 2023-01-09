<div id="sf_admin_container">
    <h1 id="replacediv"> Immobilisation
        <small><i class="ace-icon fa fa-angle-double-right"></i> Liste des Transferts/ Immobilisation </small>
    </h1>
</div>

<div id="sf_admin_bar">
    <div class="sf_admin_filter">
        <table style="margin-bottom: 0px;">
            <tr>
                <td><label>Immobilisation</label></td>
                <td>
                    <select id="id_immobilisation">
                        <option></option>
                        <?php $immos = ImmobilisationTable::getInstance()->findAll(); ?>
                        <?php foreach ($immos as $immo): ?>
                            <option value="<?php echo $immo->getId() ?>"><?php echo $immo->getRefcodeabarre(). ' '. $immo->getReference().' '. $immo->getDesignation(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><button style="float: right;" class="btn btn-xs btn-success" onclick="chercherTransfert()">Recherche</button></td>
            </tr>
        </table>
    </div>
</div>

<div id="zone_search">
    
</div>

<script>

    function chercherTransfert() {
        if ($("#id_immobilisation").val()) {
            $.ajax({
                url: '<?php echo url_for('immobilisation/getByImmobilisation') ?>',
                data: 'id=' + $("#id_immobilisation").val(),
                success: function (data) {
                    $("#zone_search").html(data);
                }
            });
        } else {
            bootbox.dialog({
                message: "Veuillez choisir une Immobilisation !!!",
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