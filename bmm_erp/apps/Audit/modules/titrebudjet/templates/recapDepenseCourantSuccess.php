<div id="sf_admin_container">
    <h1 id="replacediv"> Engagements Budget 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Récapitulatif des Dépenses Courantes
        </small>
    </h1>
    <div class="panel-body">
        <div class="row">
            <table>
                <tr>
                    <td style="vertical-align: middle; font-weight: bold; width: 50%;">Budget : 
                        <?php $titre_budgets = TitrebudjetTable::getInstance()->getByExercice($_SESSION['exercice_budget']); ?>
                        <select id="titre">
                            <option value="0"></option>
                            <?php foreach ($titre_budgets as $titre_budget): ?>
                                <option value="<?php echo $titre_budget->getId(); ?>"><?php echo $titre_budget; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td style="vertical-align: middle; text-align: center; font-weight: bold; width: 30%; font-size: 16px;">Jusqu'au  : <?php echo date('d/m/Y'); ?></td>
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

<div class="row" id="etat_recap">

</div>

<script>

    function afficher() {
        if ($('#titre').val() != '0') {
            $.ajax({
                url: '<?php echo url_for('titrebudjet/afficherEtatRecapDepense') ?>',
                data: 'mois=' + "<?php echo date('m'); ?>" +
                        '&titre=' + $('#titre').val() +
                        '&annee=' + "<?php echo date('Y'); ?>",
                success: function (data) {
                    $('#etat_recap').html(data);
                }
            });
        } else {
            bootbox.dialog({
                message: "<span class='bigger-160' style='margin:20px;color:#b31515;'>Veuillez choisir le budget !</span>",
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