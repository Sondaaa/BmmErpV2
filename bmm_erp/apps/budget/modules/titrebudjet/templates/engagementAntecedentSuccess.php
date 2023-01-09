<div id="sf_admin_container">
    <h1 id="replacediv"> Engagements Antécédents 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Détails des engagements à payer
        </small>
    </h1>
</div>

<div class="panel-body">
    <div class="row">
        <legend>Ajouter Engagement Antécédent</legend>
        <table>
            <tr>
                <td style="vertical-align: middle; font-weight: bold; width: 20%;">Exercice (Année) :
                    <input type="text" id="annee" value="" onchange="getTitreBudget()" />
                </td>
                <td style="vertical-align: middle; font-weight: bold; width: 80%;">Budget : 
                    <select id="titre" onchange="getFormAjout()">

                    </select>
                </td>
            </tr> 
        </table>
    </div>

    <div class="row" id="form_ajout">

    </div>
</div>

<script  type="text/javascript">

    $("#annee").mask('9999');

    function getTitreBudget() {
        $("#titre").empty();
        $("#form_ajout").html('');
        if ($("#annee").val() != "") {
            $.ajax({
                url: '<?php echo url_for('titrebudjet/getTitreBudget') ?>',
                data: 'annee=' + $('#annee').val(),
                success: function (data) {
                    $('#titre').html(data);
                    $("#titre").val('').trigger("liszt:updated");
                    $("#titre").trigger("chosen:updated");
                }
            });
        } else {
            $("#titre").val('').trigger("liszt:updated");
            $("#titre").trigger("chosen:updated");
        }
    }

    function getFormAjout() {
        if ($("#annee").val() != "" && $("#titre").val() != "0" && $("#titre").val() != null) {
            $.ajax({
                url: '<?php echo url_for('titrebudjet/getFormAjout') ?>',
                data: 'annee=' + $('#annee').val() + '&titre_id=' + $("#titre").val(),
                success: function (data) {
                    $('#form_ajout').html(data);
                }
            });
        } else {
            $("#form_ajout").html('');
        }
    }

</script>