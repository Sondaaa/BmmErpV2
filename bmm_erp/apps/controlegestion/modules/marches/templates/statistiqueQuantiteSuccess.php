<div id="sf_admin_container" ng-controller="CtrlStatistique">
    <h1>Statistique : Progression Projet / Quantité</h1>
    <div id="sf_admin_bar">
        <table class="table table-bordered table-hover" cellspacing="0">
            <tbody>
                <tr>
                    <td style="width: 10%;"><label>Marchés</label></td>
                    <td style="width: 20%;">
                        <select id="id_marche">
                            <option value="0"></option>
                            <?php foreach ($marches as $marche): ?>
                                <option value="<?php echo $marche->getId() ?>"><?php echo $marche ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td style="width: 10%;"><label>Bénéficiaire</label></td>
                    <td style="width: 60%;">
                        <select id="id_beneficiaire">
                            <option value="0"></option>
                        </select>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right;">
                        <button onclick="afficher()" class="btn btn-sm btn-success">Afficher</button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto;"></div>

<script  type="text/javascript">

    function afficher() {
        if ($("#id_beneficiaire").val() != '0' && $("#id_marche").val()) {
            $.ajax({
                url: '<?php echo url_for('marches/afficherStatQuantite') ?>',
                data: 'id_beneficiaire=' + $("#id_beneficiaire").val() +
                        '&id_marche=' + $("#id_marche").val(),
                success: function (data) {
                    $('#container').html(data);
                }
            });
        } else {
            bootbox.dialog({
                message: 'Veuillez choisir un bénéficiaire !',
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

<script  type="text/javascript">
    document.title = ("BMM - U. Contrôle Budgétaire : Statistique : Progression Projet / Quantité");
</script>