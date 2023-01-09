<div id="sf_admin_container">
    <h1>Statistique : Engagement Budgétaire / Fournisseur</h1>
    <div id="sf_admin_bar">
        <table class="table table-bordered table-hover" cellspacing="0">
            <tbody>
                <tr>
                    <td style="width: 10%;"><label>Fournisseur</label></td>
                    <td style="width: 50%;">
                        <select id="id_fournisseur">
                            <option value="0"></option>
                            <?php foreach ($fournisseurs as $fournisseur): ?>
                                <option value="<?php echo $fournisseur->getId(); ?>"><?php echo $fournisseur; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td style="width: 10%;"><label>Exercice</label></td>
                    <td style="width: 20%;">
                        <select id="id_exercice">
                            <option value="0"></option>
                            <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </td>
                    <td style="width: 10%; text-align: center;">
                        <button onclick="afficher()" class="btn btn-sm btn-success">Afficher</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div id="zone_affichage" style="display: none;"></div>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto;"></div>


<script>

    function afficher() {
        if ($("#id_fournisseur").val() != '0' && $("#id_exercice").val() != '0') {
            $.ajax({
                url: '<?php echo url_for('rubrique/afficherRubriqueFournisseur') ?>',
                data: 'exercice=' + $("#id_exercice").val() +
                        '&id_fournisseur=' + $("#id_fournisseur").val(),
                success: function (data) {
                    $('#zone_affichage').html(data);
                    $('#zone_affichage').fadeIn(data);
                }
            });
        } else {
            bootbox.dialog({
                message: 'Veuillez choisir un Fournisseur et/ou un Exercice !',
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