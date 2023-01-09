<div id="sf_admin_container">
    <h1 id="replacediv"> Engagements Budget 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Traiter la situation Cumulée - Antécédente
        </small>
    </h1>
    <div class="panel-body">
        <div class="row">
            <table>
                <tr>
                    <td style="vertical-align: middle; font-weight: bold; width: 45%;">Budget : 
                        <?php $titre_budgets = TitrebudjetTable::getInstance()->getByExercice($_SESSION['exercice_budget']); ?>
                        <select id="titre">
                            <option value="0"></option>
                            <?php foreach ($titre_budgets as $titre_budget): ?>
                                <option value="<?php echo $titre_budget->getId(); ?>"><?php echo $titre_budget; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td style="vertical-align: middle; font-weight: bold; width: 15%;">
                        Type
                        <select id="type">
                            <option value="0">Engagement</option>
                            <option value="1">Paiement</option>
                        </select>
                    </td>
                    <td style="vertical-align: middle; font-weight: bold; width: 10%;">
                        Année de
                        <input id="annee_debut" type="text" value="" maxlength="4" />
                    </td>
                    <td style="vertical-align: middle; font-weight: bold; width: 10%;">
                        Jusqu'au  :
                        <input id="annee_fin" type="text" value="" maxlength="4" />
                    </td>
                    <td style="vertical-align: middle; text-align: center; width: 20%;">
                        <button onclick="afficherTableau()" class="btn btn-sm btn-primary">
                            <i class="ace-icon fa fa-search bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Afficher Tableau</span>
                        </button>
                    </td>
                </tr> 
            </table>
        </div>
    </div>
</div>

<div class="row" id="etat_recap">

</div>

<script  type="text/javascript">

    $("#annee_debut").mask('9999');
    $("#annee_fin").mask('9999');
    function saveMontant(id, annee, type_montant) {
        $.ajax({
            url: '<?php echo url_for('titrebudjet/saveMontantSituation') ?>',
            data: 'id=' + id +
                    '&type_montant=' + type_montant +
                    '&montant=' + $('#' + id + '_' + annee).val() +
                    '&annee=' + annee,
            success: function (data) {

            }
        });
    }

    function afficherTableau() {
        if ($('#titre').val() != '0' && $('#annee_debut').val() != '' && $('#annee_fin').val() != '') {
            $('#etat_recap').html('');
            $.ajax({
                url: '<?php echo url_for('titrebudjet/afficherTableauSituation') ?>',
                data: 'annee_debut=' + $('#annee_debut').val() +
                        '&titre=' + $('#titre').val() +
                        '&type_montant=' + $('#type').val() +
                        '&annee_fin=' + $('#annee_fin').val(),
                success: function (data) {
                    $('#etat_recap').html(data);
                }
            });
        } else {
            bootbox.dialog({
                message: "<span class='bigger-160' style='margin:20px;color:#b31515;'>Veuillez choisir le budget et/ou préciser la période (année début et fin) !</span>",
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