<div id="sf_admin_container" ng-controller="myCtrldocvisa">
    <h1>Statistique / Rubrique Budgétaire</h1>
    <div id="sf_admin_bar">
        <table class="table table-bordered table-hover" cellspacing="0">
            <tbody>
                <tr>
                    <td style="width: 10%;"><label>Exercice</label></td>
                    <td style="width: 20%;">
                        <select id="id_exercice">
                            <option value="0"></option>
                            <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </td>
                    <td style="width: 10%;"><label>Budget</label></td>
                    <td style="width: 60%;">
                        <select id="id_budget">
                            <option value="0"></option>
                        </select>
                    </td>
                </tr>
                <tr>
<!--                    <td>
                        <label>Mois</label>
                    </td>
                    <td>
                        <select id="mois">
                            <option value="0"></option>
                            <option value="01">Janvier</option>
                            <option value="02">Février</option>
                            <option value="03">Mars</option>
                            <option value="04">Avril</option>
                            <option value="05">Mai</option>
                            <option value="06">juin</option>
                            <option value="07">Juillet</option>
                            <option value="08">Août</option>
                            <option value="09">Septembre</option>
                            <option value="10">Octobre</option>
                            <option value="11">Nouvembre</option>
                            <option value="12">Décembre</option>
                        </select>
                    </td>-->
                    <td><label>Rubrique Budgétaie</label></td>
                    <td colspan="3">
                        <select id="id_rubrique">
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


    <script>

        function afficher() {
            if ($("#id_rubrique").val() != '0' && $("#id_rubrique").val()) {
                $.ajax({
                    url: '<?php echo url_for('rubrique/afficherRubrique') ?>',
                    data: 'exercice=' + $("#id_exercice").val() +
                            //                        '&mois=' + $("#mois").val() +
                            '&id_rubrique=' + $("#id_rubrique").val(),
                    success: function (data) {
                        $('#container').html(data);
                    }
                });
            } else {
                bootbox.dialog({
                    message: 'Veuillez choisir une Rubrique Budgétaire !',
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
        document.title = ("BMM - U. Contrôle Budgétaire : Statistique / Rubrique Budgétaire");
    </script>