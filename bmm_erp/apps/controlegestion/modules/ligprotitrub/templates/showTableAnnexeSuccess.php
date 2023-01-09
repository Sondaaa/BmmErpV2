<?php if ($ligne_rubrique): ?>
    <div class="modal-header">
        <h4 class="modal-title titre_rubrique_modal">Rubrique Budgétaire : <?php echo $ligne_rubrique->getCode() ?> - <?php echo $ligne_rubrique->getRubrique() ?></h4>
    </div>

    <table id="form_rubrique_annexe">
        <tr>
            <td style="width: 25%; height: 35px; vertical-align: middle;"><label>Budget Prévisionnel Global :</label></td>
            <td style="width: 75%; vertical-align: middle;"><?php echo $titre_global; ?></td>
        </tr>
    </table>

    <div class="row" style="margin-top: 15px;">
        <div id="zone_detail_annexe" class="col-md-12">

        </div>
    </div>

    <div class="row" style="margin-top: 15px;">
        <div class="col-md-12">
            <span style="font-size: 18px; color: #1C9E3C;">Total Rubrique Budgétaire : </span>
            <input type="text" value="<?php echo $ligne_rubrique->getMnt() ?>" class="align_right" id="total_type_annexe_rubrique" readonly="true">
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

        $("select").attr('class', "chosen-select form-control");
        $('.chosen-select').chosen({allow_single_deselect: true});
        $('.chosen-container').attr("style", "width: 100%;");
        $('.chosen-container').trigger("chosen:updated");
        $('.bootbox-close-button').attr('style', 'font-size: 38px; margin-top: -10px;');
        $("table").addClass("table table-bordered table-hover");
        $('input:text').not('[id="total_type_annexe_rubrique"]').not('[id="<?php echo $type; ?>_taux_fardeau"]').attr('style', 'width: 100%;');
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
<?php else: ?>
    <div class="modal-header">
        <h4 class="modal-title titre_rubrique_modal">Attention</h4>
    </div>

    <div class="row" style="margin-top: 15px;">
        <div class="col-md-12" style="padding-left: 50px;">
            <span style="font-size: 14px;">Rubrique Budgétaire : <?php echo $ligne_budget_initiale->getCode() ?> - <?php echo $ligne_budget_initiale->getRubrique() ?></span>
            <br>
            <span style="font-size: 14px; color: #9E2E1C;">Veuillez vérifier le budget prévisionnel global pour l'exercice <?php echo date('Y', strtotime($ligne_budget_initiale->getTitrebudjet()->getDatecreation())) ?> !</span>
        </div>
    </div>

    <script  type="text/javascript">

        $('.bootbox-close-button').attr('style', 'font-size: 38px; margin-top: -10px;');
        $('[data-bb-handler="cancel"]').html('Fermer');
        $('[data-bb-handler="confirm"]').attr('style', 'display:none;');

    </script>

    <style>

        .titre_rubrique_modal{font-size: 16px; color: #9E2E1C; font-weight: bold;}
        .modal-dialog{width: 60%;}
        .modal-header{padding-top: 0px; padding-bottom: 10px;}

    </style>
<?php endif; ?>