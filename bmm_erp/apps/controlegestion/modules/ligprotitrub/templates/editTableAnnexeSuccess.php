<div class="modal-header">
    <h4 class="modal-title titre_rubrique_modal" style="margin-top: -10px;">Rubrique Budgétaire : <?php echo $ligne_rubrique->getCode() ?> - <?php echo $ligne_rubrique->getRubrique() ?></h4>
</div>

<?php if ($ligne_rubrique->getTitrebudjet()->getEtatbudget() != 2 && trim($ligne_rubrique->getTitrebudjet()->getTypebudget()) != "Budget Prévisionnel Global"): ?>
    <?php $annexes = AnnexebudgetTable::getInstance()->getAll(); ?>
    <table id="form_rubrique_annexe">
        <tr>
            <td style="width: 85%;">
                <label>Type Annexe :</label>
                <select id="type_annexe">
                    <option value="">Selectionnez un type ...</option>
                    <?php foreach ($annexes as $annexe): ?>
                        <option value="<?php echo $annexe->getId(); ?>"><?php echo $annexe->getTitre(); ?></option>
                    <?php endforeach; ?>
                </select>
                <span style="margin-top: 10px; color: #316ac5;">* Un type d'annexe peut être ajouter que une seule fois par rubrique budgétaire.</span>
            </td>
            <td style="width: 15%; text-align: center;">
                <label style="width: 100%;">&nbsp;</label>
                <input type="button" class="btn btn-xs btn-primary" value="Ajouter Annexe" onclick="ajouterTable()" />
            </td>
        </tr>
    </table>
<?php endif; ?>

<div class="row" style="margin-top: 15px;">
    <div id="zone_detail_annexe" class="col-md-12">

    </div>
</div>

<div class="row" style="margin-top: 15px;">
    <div class="col-md-12">
        <span style="font-size: 18px; color: #1C9E3C;">Total Rubrique Budgétaire : </span>
        <input type="text" value="0.000" class="align_right" id="total_type_annexe_rubrique" readonly="true">
    </div>
</div>
<?php $rubrique_annexes = AnnexebudgetrubriqueTable::getInstance()->findByIdLigprotitrub($ligne_rubrique->getId()); ?>
<?php if ($rubrique_annexes->count() > 0): ?>
    <script  type="text/javascript">

        function ajouterTableSaved(id_type, id_ligprititrub, id_saved) {
            $.ajax({
                url: '<?php echo url_for('ligprotitrub/addTypeAnnexe') ?>',
                data: 'id=' + id_type + '&id_ligprotitrub=' + id_ligprititrub + '&id_saved=' + id_saved,
                success: function (data) {
                    $("#zone_detail_annexe").append(data);
    <?php if ($ligne_rubrique->getTitrebudjet()->getEtatbudget() != 2 && trim($ligne_rubrique->getTitrebudjet()->getTypebudget()) != "Budget Prévisionnel Global"): ?>
                        //rien
    <?php else: ?>
                        $('tr[name="tr_for_add"]').each(function () {
                            $(this).parent().parent().find('td:last-child').remove();
                            $(this).parent().parent().find('th:last-child').remove();
                            $(this).remove();
                        });
    <?php endif; ?>
                }
            });
        }

    <?php foreach ($rubrique_annexes as $rubrique_annexe): ?>
            ajouterTableSaved('<?php echo $rubrique_annexe->getIdAnnexebudget(); ?>', '<?php echo $rubrique_annexe->getIdLigprotitrub(); ?>', '<?php echo $rubrique_annexe->getId(); ?>');
    <?php endforeach; ?>

    </script>    
<?php endif; ?>

<script  type="text/javascript">

    function ajouterTable() {
        if ($("#type_annexe").val()) {
            if (!$("#div_add_annexe_" + $("#type_annexe").val()).length) {
                $.ajax({
                    url: '<?php echo url_for('ligprotitrub/addTypeAnnexe') ?>',
                    data: 'id=' + $("#type_annexe").val() +
                            '&id_ligprotitrub=' + '<?php echo $ligne_rubrique->getId(); ?>',
                    success: function (data) {
                        $("#zone_detail_annexe").append(data);
                    }
                });
            }
        }
    }

    function removeZoneTypeAnnexe(id) {
        $("#" + id).remove();
        setTotalAnnexeRubrique();
    }

    function setTotalAnnexeRubrique() {
        var total = 0;
        $('[name="total_type_annexe"]').each(function () {
            if ($(this).val())
                total = parseFloat(parseFloat(total) + parseFloat($(this).val()));
        });
        $('#total_type_annexe_rubrique').val(parseFloat(total).toFixed(3));
    }

</script>

<script  type="text/javascript">

    $("table").addClass("table table-bordered table-hover");
    $("select").attr('class', "chosen-select form-control");
    $('.chosen-select').chosen({allow_single_deselect: true});
    $('.chosen-container').attr("style", "width: 100%;");
    $('.chosen-container').trigger("chosen:updated");
    $('.bootbox-close-button').attr('style', 'font-size: 38px; margin-top: -10px;');
<?php if ($ligne_rubrique->getTitrebudjet()->getEtatbudget() != 2 && trim($ligne_rubrique->getTitrebudjet()->getTypebudget()) != "Budget Prévisionnel Global"): ?>
        //Rien à faire
<?php else: ?>
        $('[data-bb-handler="cancel"]').html('Fermer');
        $('[data-bb-handler="confirm"]').attr('style', 'display:none;');
<?php endif; ?>

</script>

<style>

    .titre_rubrique_modal{font-size: 16px; color: #2679b5; font-weight: bold;}
    .modal-dialog{width: 86%;}
    #form_rubrique_annexe{width: 90%; margin: 2% 5% 0% 5%;}
    #form_rubrique_annexe tbody tr td{padding: 5px;}
    .annexe_type{border: 1px solid #ddd; border-radius: 4px; padding: 10px 5px;}

</style>