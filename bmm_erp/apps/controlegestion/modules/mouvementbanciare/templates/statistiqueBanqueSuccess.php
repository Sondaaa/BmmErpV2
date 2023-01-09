<div id="sf_admin_container">
    <h1>Statistique : Répartition Budgétaire / Compte Bancaire</h1>
    <div id="sf_admin_bar">
        <table class="table table-bordered table-hover" cellspacing="0">
            <tr>
                <td style="width: 10%;"><label>Année</label></td>
                <td style="width: 20%;">
                    <select id="annee">
                        <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                            <option <?php if ($i == date('Y')): ?>selected="true"<?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </td>
                <td style="width: 10%;"><label>Mois</label></td>
                <td style="width: 20%;">
                    <select id="mois">
                        <option <?php if (date('m') == '1'): ?>selected="true"<?php endif; ?> value="01">Janvier</option>
                        <option <?php if (date('m') == '2'): ?>selected="true"<?php endif; ?> value="02">Février</option>
                        <option <?php if (date('m') == '3'): ?>selected="true"<?php endif; ?> value="03">Mars</option>
                        <option <?php if (date('m') == '4'): ?>selected="true"<?php endif; ?> value="04">Avril</option>
                        <option <?php if (date('m') == '5'): ?>selected="true"<?php endif; ?> value="05">Mai</option>
                        <option <?php if (date('m') == '6'): ?>selected="true"<?php endif; ?> value="06">Juin</option>
                        <option <?php if (date('m') == '7'): ?>selected="true"<?php endif; ?> value="07">Juillet</option>
                        <option <?php if (date('m') == '8'): ?>selected="true"<?php endif; ?> value="08">Août</option>
                        <option <?php if (date('m') == '9'): ?>selected="true"<?php endif; ?> value="09">Septembre</option>
                        <option <?php if (date('m') == '10'): ?>selected="true"<?php endif; ?> value="10">Octobre</option>
                        <option <?php if (date('m') == '11'): ?>selected="true"<?php endif; ?> value="11">Nouvembre</option>
                        <option <?php if (date('m') == '12'): ?>selected="true"<?php endif; ?> value="12">Décembre</option>
                    </select>
                </td>
                <td style="width: 40%; text-align: right;">
                    <button onclick="afficher()" class="btn btn-sm btn-success">Afficher</button>
                </td>
            </tr>
        </table>
    </div>
</div>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto;"></div>


<script  type="text/javascript">

    function afficher() {
        $.ajax({
            url: '<?php echo url_for('mouvementbanciare/afficherStatCompte') ?>',
            data: 'annee=' + $("#annee").val() + '&mois=' + $("#mois").val(),
            success: function (data) {
                $('#container').html(data);
            }
        });
    }

</script>

<script  type="text/javascript">
    document.title = ("BMM - U. Contrôle Budgétaire : Statistique : Répartition Budgétaire / Compte Bancaire");
</script>