<div id="sf_admin_container">
    <h1 id="replacediv"> Engagements Antécédents  
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Etat
        </small>
    </h1>
    <div class="panel-body" style="padding-bottom: 0px;">
        <div class="row">
            <table>
                <tr>
                    <td style="vertical-align: middle; font-weight: bold; width: 20%;">Exercice (Année) :
                        <input type="text" id="annee" value="<?php echo $_SESSION['exercice_budget']; ?>" onchange="getTitreBudget()" readonly="true" />
                    </td>
                    <td style="vertical-align: middle; font-weight: bold; width: 80%;">Budget : 
                        <select id="titre">

                        </select>
                    </td>
                    <td style="vertical-align: middle; text-align: center; width: 20%;">
                        <button onclick="afficher()" class="btn btn-sm btn-primary">
                            <i class="ace-icon fa fa-search bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Afficher</span>
                        </button>
                    </td>
                </tr> 
            </table>
        </div>
    </div>
</div>

<div class="row" id="etat_engagement">

</div>

<script  type="text/javascript">

    $("#annee").mask('9999');
    getTitreBudget();

    function getTitreBudget() {
        $("#titre").empty();
        $("#etat_engagement").html('');
        if ($("#annee").val() != "0") {
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

    function afficher() {
        if ($("#annee").val() != "0" && $("#titre").val() != null) {
            $("#etat_engagement").html('');
            $.ajax({
                url: '<?php echo url_for('titrebudjet/getEtatEngagement') ?>',
                data: 'id_titre=' + $('#titre').val() + '&annee=' + $('#annee').val(),
                success: function (data) {
                    $('#etat_engagement').html(data);
                }
            });
        } else {
            bootbox.dialog({
                message: "<span class='bigger-160' style='margin:20px;color:#b31515;'>Veuillez choisir le budget et/ou l'année !</span>",
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