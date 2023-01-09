<div id="sf_admin_container">
    <h1 id="replacediv">Salaires & Rapports des Travaux 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Charges Directes
        </small>
    </h1>
    <div class="panel-body">
        <legend>Charges Directes</legend>
        <div class="col-md-4">
            <table>
                <tr>
                    <td style="width: 60%;">Année <span class="required">*</span>
                        <input type="text" id="annee" value="<?php echo $_SESSION['exercice']; ?>" />
                    </td>
                    <td style="width: 40%; text-align: center; vertical-align: bottom;">
                        <button class="btn btn-primary" onclick="afficher()"><i class="ace-icon fa fa-search"></i> Afficher</button>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-8" id="liste_charges">

        </div>
    </div>
</div>

<script  type="text/javascript">

    $("#annee").mask('9999');

    function afficher() {

        if ($("#annee").val() != "") {
            $("#liste_charges").html('');
            $.ajax({
                url: '<?php echo url_for('rapporttravaux/afficherChargeDirecte') ?>',
                data: 'annee=' + $('#annee').val(),
                success: function (data) {
                    $('#liste_charges').html(data);
                }
            });
        } else {
            bootbox.dialog({
                message: "Veuiller saisir l'année des charges directes !",
                buttons:
                        {
                            "button":
                                    {
                                        "label": "Ok",
                                        "className": "btn-sm"
                                    }
                        }
            });
        }
    }

</script>