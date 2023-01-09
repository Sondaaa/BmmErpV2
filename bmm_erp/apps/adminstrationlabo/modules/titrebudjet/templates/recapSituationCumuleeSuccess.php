<?php $id_user=  $sf_user->getAttribute('userB2m')->getId();?>
<div id="sf_admin_container">
    <h1 id="replacediv"> Engagements Budget 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Récapitulatif  - SITUATION CUMULEE
        </small>
    </h1>
    <div class="panel-body">
        <div class="row">
            <table>
                <tr>
                    <td style="vertical-align: middle; font-weight: bold;">Budget :</td>
                    <td colspan="2" style="vertical-align: middle; font-weight: bold;">Du Mois :</td>
                    <td colspan="2" style="vertical-align: middle; font-weight: bold;">Jusqu'au Mois :</td>
                </tr>
                <tr>
                    <td style="vertical-align: middle; width: 42%;">
                        <?php $titre_budgets = TitrebudjetTable::getInstance()->getByExerciceAndUser($_SESSION['exercice_budget'],$id_user); ?>
                        <select id="titre">
                            <option value="0"></option>
                            <?php foreach ($titre_budgets as $titre_budget): ?>
                                <option value="<?php echo $titre_budget->getId(); ?>"><?php echo $titre_budget; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <?php $dates = SituationcumuleeTable::getInstance()->getLimiteDate(); ?>
                    <td style="vertical-align: middle; font-weight: bold; width: 13%;">
                        <select id="min_mois">
                            <option value="0"></option>
                            <option value="1">Janvier</option>
                            <option value="2">Février</option>
                            <option value="3">Mars</option>
                            <option value="4">Avril</option>
                            <option value="5">Mai</option>
                            <option value="6">Juin</option>
                            <option value="7">Juillet</option>
                            <option value="8">Août</option>
                            <option value="9">Septembre</option>
                            <option value="10">Octobre</option>
                            <option value="11">Novembre</option>
                            <option value="12">Décembre</option>
                        </select>
                    </td>
                    <td style="vertical-align: middle; font-weight: bold; width: 10%;">
                        <select id="min_annee">
                            <option value="0"></option>
                            <?php for ($i = $dates->getMinannee(); $i <= $dates->getMaxannee(); $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </td>

                    <td style="vertical-align: middle; font-weight: bold; width: 13%;">
                        <select id="max_mois">
                            <option value="0"></option>
                            <option value="1">Janvier</option>
                            <option value="2">Février</option>
                            <option value="3">Mars</option>
                            <option value="4">Avril</option>
                            <option value="5">Mai</option>
                            <option value="6">Juin</option>
                            <option value="7">Juillet</option>
                            <option value="8">Août</option>
                            <option value="9">Septembre</option>
                            <option value="10">Octobre</option>
                            <option value="11">Novembre</option>
                            <option value="12">Décembre</option>
                        </select>
                    </td>
                    <td style="vertical-align: middle; font-weight: bold; width: 10%;">
                        <select id="max_annee">
                            <option value="0"></option>
                            <?php for ($i = $dates->getMinannee(); $i <= $dates->getMaxannee(); $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </td>
                    <td style="vertical-align: middle; text-align: center; width: 12%;">
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

<div class="row" id="etat_recap">

</div>

<script  type="text/javascript">

    function afficher() {
        if ($('#min_mois').val() != '0' && $('#max_mois').val() != '0' && $('#titre').val() != '0' && $('#min_annee').val() != '0' && $('#max_annee').val() != '0') {
            $.ajax({
                url: '<?php echo url_for('titrebudjet/afficherEtatRecapSituation') ?>',
                data: 'min_mois=' + $('#min_mois').val() +
                        '&max_mois=' + $('#max_mois').val() +
                        '&titre=' + $('#titre').val() +
                        '&min_annee=' + $('#min_annee').val() +
                        '&max_annee=' + $('#max_annee').val(),
                success: function (data) {
                    $('#etat_recap').html(data);
                }
            });
        } else {
            bootbox.dialog({
                message: "<span class='bigger-160' style='margin:20px;color:#b31515;'>Veuillez choisir le budget et/ou la période !</span>",
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