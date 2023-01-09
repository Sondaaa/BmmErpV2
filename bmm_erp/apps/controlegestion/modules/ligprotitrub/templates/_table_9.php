<?php
if ($id_saved == '')
    $annexe_rubrique = AnnexebudgetrubriqueTable::getInstance()->findByIdAnnexebudgetAndIdLigprotitrub($type, $id_ligprotitrub)->getFirst();
else
    $annexe_rubrique = AnnexebudgetrubriqueTable::getInstance()->find($id_saved);
?>
<?php $ligne_rubrique = LigprotitrubTable::getInstance()->find($id_ligprotitrub); ?>
<div class="col-md-12 annexe_type" id="div_add_annexe_<?php echo $type; ?>" style="margin-bottom: 15px;">
    <div class="col-md-12">
        <legend>
            <span style="font-size: 16px;">التعديل الآلي للجرايات بعنوان الزيادة في الأجور</span>
            <input type="hidden" name="annexe_rubrique" value="<?php echo $type ?>">
            <?php if ($ligne_rubrique->getTitrebudjet()->getEtatbudget() != 2 && trim($ligne_rubrique->getTitrebudjet()->getTypebudget()) != "Budget Prévisionnel Global"): ?>
                <input type="button" onclick="removeZoneTypeAnnexe('div_add_annexe_<?php echo $type; ?>')" style="font-size: 24px; margin-top: -10px; background-color: #0000; border: none; color: #A1A1A1; float: right;" value="×"/>
            <?php endif; ?>
        </legend>
    </div>
    <br>
    <div class="col-md-12">
        <?php if ($ligne_rubrique->getTitrebudjet()->getEtatbudget() != 2 && trim($ligne_rubrique->getTitrebudjet()->getTypebudget()) != "Budget Prévisionnel Global"): ?>
            <textarea name="annexe_description_type" id="annexe_description_type_<?php echo $type; ?>">
                <?php
                if ($annexe_rubrique):
                    echo $annexe_rubrique->getDescription();
                endif;
                ?>
            </textarea>
        <?php else: ?>
            <?php if ($annexe_rubrique->getDescription()): ?>
                <div style="direction: rtl; text-align: right;" class="well well-sm">
                    <?php
                    if ($annexe_rubrique):
                        echo html_entity_decode(str_replace('~', ' ', $annexe_rubrique->getDescription()));
                    endif;
                    ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="col-md-12" name="for_save_annexe" id="for_save_annexe_<?php echo $type; ?>">
        <?php if ($annexe_rubrique): ?>
            <?php
            $contenu = $annexe_rubrique->getContenu();
            $contenu = str_replace('~', ' ', $contenu);
            $contenu = htmlentities($contenu);
            echo html_entity_decode($contenu);
            ?>
        <?php else: ?>
            <table style="margin-bottom: 0px;">
                <thead>
                    <tr style="font-size: 12px;">
                        <th style="width: 16%; text-align: center;">المبلغ الجملي للتعديل الآلي للجراية</th>
                        <th style="width: 16%; text-align: center;">مبلغ الزيادة في الأجور</th>
                        <th style="width: 16%; text-align: center;">عدد أشهر التعديل الآلي للجراية</th>
                        <th style="width: 10%; text-align: center;">تاريخ الإحالة على التقاعد</th>
                        <th style="width: 29%; text-align: center;">الإسم و اللقب</th>
                        <th style="width: 5%; text-align: center;">العدد الرتبي</th>
                        <th style="width: 8%; text-align: center;"></th>
                    </tr>
                    <tr name="tr_for_add">
                        <th><input id="<?php echo $type; ?>_total" class="align_right" type="text" value=""></th>
                        <th><input id="<?php echo $type; ?>_montant" class="align_right" type="text" value=""></th>
                        <th><input id="<?php echo $type; ?>_mois" class="align_center" type="text" value=""></th>
                        <th><input id="<?php echo $type; ?>_date" type="date" value=""></th>
                        <th><input id="<?php echo $type; ?>_agent" type="text" value=""></th>
                        <th><input id="<?php echo $type; ?>_numero" class="align_center" type="text" value=""></th>
                        <th style="text-align: center; min-width: 80px;">
                            <span class="btn btn-primary btn-xs" onclick="addligne<?php echo $type; ?>()"><i class="ace-icon fa fa-arrow-down bigger-110 icon-only"></i></span>
                            <span class="btn btn-xs btn-success" onclick="ClearLigne<?php echo $type; ?>()"><i class="ace-icon fa fa-eraser bigger-110 icon-only"></i></span>
                            <input type="hidden" id="edit_ligne_add_<?php echo $type; ?>" value="">
                        </th>
                    </tr>
                </thead>
                <tbody id="tbody_add_annexe_<?php echo $type; ?>">

                </tbody>
            </table>
            <table style="margin-bottom: 0px;">
                <thead>
                    <tr>
                        <th style="text-align: center; width: 16%;"><input type="text" class="align_right" id="total_total_<?php echo $type; ?>" value="0.000" readonly="true"></th>
                        <th style="text-align: center; width: 16%;"><input type="text" class="align_right" id="total_montant_<?php echo $type; ?>" value="0.000" readonly="true"></th>
                        <th style="text-align: center; width: 68%;">Total - المجموع</th>
                    </tr>
                    <tr>
                        <th style="text-align: center; width: 16%;"><input name="total_type_annexe" annexe_id="<?php echo $type; ?>" type="text" class="align_right" id="total_type_annexe_<?php echo $type; ?>" value="0.000" onkeyup="setTotalAnnexeRubrique()"></th>
                        <th style="text-align:center;" colspan="2">مبلغ مصحح</th>
                    </tr>
                </thead>
            </table>
            <input type="hidden" id="compteur_type_annexe_<?php echo $type; ?>" value="1">
        <?php endif; ?>
    </div>

    <script  type="text/javascript">

        function addligne<?php echo $type; ?>() {
            if ($("#<?php echo $type; ?>_total").val() != '' && $("#<?php echo $type; ?>_montant").val() != '' && $("#<?php echo $type; ?>_mois").val() != '' && $("#<?php echo $type; ?>_date").val() != '' && $("#<?php echo $type; ?>_agent").val() != '' && $("#<?php echo $type; ?>_numero").val() != '') {
                var id = parseInt($('#compteur_type_annexe_<?php echo $type; ?>').val());
                var tr_html = '<tr id="tr_annexe_type_<?php echo $type; ?>_' + id + '">';
                tr_html = tr_html + '<td name="<?php echo $type; ?>_total" style="text-align: right;">' + $("#<?php echo $type; ?>_total").val() + '</td>';
                tr_html = tr_html + '<td name="<?php echo $type; ?>_montant" style="text-align: right;">' + $("#<?php echo $type; ?>_montant").val() + '</td>';
                tr_html = tr_html + '<td name="<?php echo $type; ?>_mois" style="text-align:center;">' + $("#<?php echo $type; ?>_mois").val() + '</td>';
                tr_html = tr_html + '<td name="<?php echo $type; ?>_date" style="text-align: center;">' + $("#<?php echo $type; ?>_date").val() + '</td>';
                tr_html = tr_html + '<td name="<?php echo $type; ?>_agent" style="text-align: right;">' + $("#<?php echo $type; ?>_agent").val() + '</td>';
                tr_html = tr_html + '<td name="<?php echo $type; ?>_numero" style="text-align:center;">' + $("#<?php echo $type; ?>_numero").val() + '</td>';
                tr_html = tr_html + '<td style="text-align:center;vertical-align:middle;"><button style="margin-right: 5px;" class="btn btn-xs btn-warning" onclick="editLigneExemple<?php echo $type; ?>(' + id + ')"><i class="ace-icon fa fa-pencil-square-o"></i></button><button class="btn btn-xs btn-danger" onclick="suprimerLigneType<?php echo $type; ?>(' + id + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
                tr_html = tr_html + '</tr>';

                if ($("#edit_ligne_add_<?php echo $type; ?>").val() != '') {
                    var id_edit_ligne = $("#edit_ligne_add_<?php echo $type; ?>").val();
                    $("#tr_annexe_type_<?php echo $type; ?>_" + id_edit_ligne).after(tr_html);
                    $("#tr_annexe_type_<?php echo $type; ?>_" + id_edit_ligne).remove();
                } else {
                    $("#tbody_add_annexe_<?php echo $type; ?>").append(tr_html);
                }

                id++;
                $("#compteur_type_annexe_<?php echo $type; ?>").val(id);

                $('#<?php echo $type; ?>_total').val('');
                $("#<?php echo $type; ?>_montant").val('');
                $("#<?php echo $type; ?>_mois").val('');
                $("#<?php echo $type; ?>_date").val('');
                $("#<?php echo $type; ?>_agent").val('');
                $("#<?php echo $type; ?>_numero").val('');
                $('#edit_ligne_add_<?php echo $type; ?>').val('');

                setTotalAnnexeType<?php echo $type; ?>();
            } else {
                bootbox.dialog({
                    message: "Veuillez remplir tout les champs !",
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

        function suprimerLigneType<?php echo $type; ?>(id) {
            $("#tr_annexe_type_<?php echo $type; ?>_" + id).remove();
            setTotalAnnexeType<?php echo $type; ?>();
        }

        function setTotalAnnexeType<?php echo $type; ?>() {
            var montant = 0;
            $('[name="<?php echo $type; ?>_montant"]').each(function () {
                montant = parseFloat(parseFloat(montant) + parseFloat($(this).html()));
            });
            $('#total_montant_<?php echo $type; ?>').val(parseFloat(montant).toFixed(3));

            var total = 0;
            $('[name="<?php echo $type; ?>_total"]').each(function () {
                total = parseFloat(parseFloat(total) + parseFloat($(this).html()));
            });
            $('#total_total_<?php echo $type; ?>').val(parseFloat(total).toFixed(3));
            $('#total_total_<?php echo $type; ?>').attr("value", parseFloat(total).toFixed(3));
            $('#total_type_annexe_<?php echo $type; ?>').val(parseFloat(total).toFixed(3));
            $('#total_type_annexe_<?php echo $type; ?>').attr("value", parseFloat(total).toFixed(3));
            setTotalAnnexeRubrique();
        }

        function editLigneExemple<?php echo $type; ?>(id) {
            $("#edit_ligne_add_<?php echo $type; ?>").val(id);

            $("#<?php echo $type; ?>_total").val($("#tr_annexe_type_<?php echo $type; ?>_" + id).find('td:eq(0)').html().trim());
            $("#<?php echo $type; ?>_montant").val($("#tr_annexe_type_<?php echo $type; ?>_" + id).find('td:eq(1)').html().trim());
            $("#<?php echo $type; ?>_mois").val($("#tr_annexe_type_<?php echo $type; ?>_" + id).find('td:eq(2)').html().trim());
            $("#<?php echo $type; ?>_date").val($("#tr_annexe_type_<?php echo $type; ?>_" + id).find('td:eq(3)').html().trim());
            $("#<?php echo $type; ?>_agent").val($("#tr_annexe_type_<?php echo $type; ?>_" + id).find('td:eq(4)').html().trim());
            $("#<?php echo $type; ?>_numero").val($("#tr_annexe_type_<?php echo $type; ?>_" + id).find('td:eq(5)').html().trim());
        }

        function ClearLigne<?php echo $type; ?>() {
            $('#edit_ligne_add_<?php echo $type; ?>').val('');

            $('#<?php echo $type; ?>_total').val('');
            $("#<?php echo $type; ?>_montant").val('');
            $("#<?php echo $type; ?>_mois").val('');
            $("#<?php echo $type; ?>_date").val('');
            $("#<?php echo $type; ?>_agent").val('');
            $("#<?php echo $type; ?>_numero").val('');
        }

        $(document).ready(function () {
            $('#annexe_description_type_<?php echo $type; ?>').ckeditor();
            $("table").addClass("table table-bordered table-hover");
            $('input:text').not('[id="total_type_annexe_rubrique"]').not('[id="<?php echo $type; ?>_taux_fardeau"]').attr('style', 'width: 100%;');
<?php if ($annexe_rubrique): ?>
                setTotalAnnexeRubrique();
<?php endif; ?>
        });

    </script>
</div>