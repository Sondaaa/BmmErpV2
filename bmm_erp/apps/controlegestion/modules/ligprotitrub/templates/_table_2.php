<?php
if ($id_saved == '')
    $annexe_rubrique = AnnexebudgetrubriqueTable::getInstance()->findByIdAnnexebudgetAndIdLigprotitrub($type, $id_ligprotitrub)->getFirst();
else
    $annexe_rubrique = AnnexebudgetrubriqueTable::getInstance()->find($id_saved);
?>
<?php $ligne_rubrique = LigprotitrubTable::getInstance()->find($id_ligprotitrub); ?>
<div class="col-md-12 annexe_type" id="div_add_annexe_2" style="margin-bottom: 15px;">
    <div class="col-md-12">
        <legend>
            <span style="font-size: 16px;">Prime de Nuit ( منحة العمل الليلي )</span>
            <input type="hidden" name="annexe_rubrique" value="<?php echo $type ?>">
            <?php if ($ligne_rubrique->getTitrebudjet()->getEtatbudget() != 2 && trim($ligne_rubrique->getTitrebudjet()->getTypebudget()) != "Budget Prévisionnel Global"): ?>
                <input type="button" onclick="removeZoneTypeAnnexe('div_add_annexe_2')" style="font-size: 24px; margin-top: -10px; background-color: #0000; border: none; color: #A1A1A1; float: right;" value="×"/>
            <?php endif; ?>
        </legend>
    </div>
    <br>
    <div class="col-md-12">
        <?php if ($ligne_rubrique->getTitrebudjet()->getEtatbudget() != 2 && trim($ligne_rubrique->getTitrebudjet()->getTypebudget()) != "Budget Prévisionnel Global"): ?>
            <textarea name="annexe_description_type" id="annexe_description_type_2">
                <?php
                if ($annexe_rubrique):
                    echo str_replace('~', ' ', $annexe_rubrique->getDescription());
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
            $contenu = str_replace('~', '', $contenu);
            $contenu = htmlentities($contenu);
            echo html_entity_decode($contenu);
            ?>
        <?php else: ?>
            <table style="margin-bottom: 0px;">
                <thead>
                    <tr style="font-size: 14px;">
                        <th style="width: 15%; text-align: center;">Total<br>الكلفة</th>
                        <th style="width: 12%; text-align: center;">Nbre de Nuit<br>عدد الليالي</th>
                        <th style="width: 12%; text-align: center;">Prime de Nuit<br>مقدار المنحة / الليلة</th>
                        <th style="width: 13%; text-align: center;">Nbre de Gardiens<br>عدد الحراس ليلا</th>
                        <th style="width: 38%; text-align: center;">Emplacement<br>المكان</th>
                        <th style="width: 10%; text-align: center;"></th>
                    </tr>
                    <tr name="tr_for_add">
                        <th><input id="total_ligne" class="align_right" type="text" value="" readonly="true"></th>
                        <th><input id="nbre_nuit_ligne" class="align_center" type="text" value="" onkeyup="setTotalLigneAnnexeType2()"></th>
                        <th><input id="montant_nuit_ligne" class="align_right" type="text" value="" onkeyup="setTotalLigneAnnexeType2()"></th>
                        <th><input id="nbre_agent_ligne" class="align_center" type="text" value="" onkeyup="setTotalLigneAnnexeType2()"></th>
                        <th><input id="place_ligne" type="text" value=""></th>
                        <th style="text-align: center;">
                            <span class="btn btn-primary btn-xs" onclick="addligne2()"><i class="ace-icon fa fa-arrow-down bigger-110 icon-only"></i></span>
                            <span class="btn btn-xs btn-success" onclick="ClearLigne2()"><i class="ace-icon fa fa-eraser bigger-110 icon-only"></i></span>
                            <input type="hidden" id="edit_ligne_add_2" value="">
                        </th>
                    </tr>
                </thead>
                <tbody id="tbody_add_annexe_2">

                </tbody>
            </table>
            <table style="margin-bottom: 0px;">
                <thead>
                    <tr>
                        <th style="text-align: center; width: 15%;"><input name="total_type_annexe" annexe_id="<?php echo $type; ?>" type="text" class="align_right" id="total_type_annexe_2" value="" readonly="true"></th>
                        <th style="text-align: center; width: 85%;">Total -  الكلفة الجملية</th>
                    </tr>
                </thead>
            </table>
            <input type="hidden" id="compteur_type_annexe_2" value="1">
        <?php endif; ?>
    </div>

    <script  type="text/javascript">

        function addligne2() {
            if ($("#total_ligne").val() != '' && $("#nbre_nuit_ligne").val() != '' && $("#montant_nuit_ligne").val() != '' && $("#nbre_agent_ligne").val() != '' && $("#place_ligne").val() != '') {
                var id = parseInt($('#compteur_type_annexe_2').val());
                var tr_html = '<tr id="tr_annexe_type_2_' + id + '">';
                tr_html = tr_html + '<td name="total_ligne_2" style="text-align: right;">' + $("#total_ligne").val() + '</td>';
                tr_html = tr_html + '<td name="nbre_nuit_ligne" style="text-align: center;">' + $("#nbre_nuit_ligne").val() + '</td>';
                tr_html = tr_html + '<td name="montant_nuit_ligne" style="text-align:right;">' + $("#montant_nuit_ligne").val() + '</td>';
                tr_html = tr_html + '<td name="nbre_agent_ligne" style="text-align:center;">' + $("#nbre_agent_ligne").val() + '</td>';
                tr_html = tr_html + '<td name="place_ligne" style="text-align:right;">' + $("#place_ligne").val() + '</td>';
                tr_html = tr_html + '<td style="text-align:center;vertical-align:middle;"><button style="margin-right: 5px;" class="btn btn-xs btn-warning" onclick="editLigneExemple2(' + id + ')"><i class="ace-icon fa fa-pencil-square-o"></i></button><button class="btn btn-xs btn-danger" onclick="suprimerLigneType2(' + id + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
                tr_html = tr_html + '</tr>';

                if ($("#edit_ligne_add_2").val() != '') {
                    var id_edit_ligne = $("#edit_ligne_add_2").val();
                    $("#tr_annexe_type_2_" + id_edit_ligne).after(tr_html);
                    $("#tr_annexe_type_2_" + id_edit_ligne).remove();
                } else {
                    $("#tbody_add_annexe_2").append(tr_html);
                }

                id++;
                $("#compteur_type_annexe_2").val(id);

                $('#total_ligne').val('');
                $("#nbre_nuit_ligne").val('');
                $("#montant_nuit_ligne").val('');
                $("#nbre_agent_ligne").val('');
                $("#place_ligne").val('');
                $("#edit_ligne_add_2").val('');

                setTotalAnnexeType2();
            } else {
                bootbox.dialog({
                    message: "Veuillez saisir l'emplacement, le nombre de gardien, le prime de nuit et/ou le nombre de nuit !",
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

        function suprimerLigneType2(id) {
            $("#tr_annexe_type_2_" + id).remove();
            setTotalAnnexeType2();
        }

        function setTotalLigneAnnexeType2() {
            if ($("#nbre_nuit_ligne").val() != '' && $("#montant_nuit_ligne").val() != '' && $("#nbre_agent_ligne").val() != '') {
                var nbr_agent = parseInt($('#nbre_agent_ligne').val());
                var nbr_nuit = parseInt($('#nbre_nuit_ligne').val());
                var montant_nuit = parseFloat($('#montant_nuit_ligne').val());
                var total = parseFloat(nbr_agent * nbr_nuit * montant_nuit);
                $('#total_ligne').val(parseFloat(total).toFixed(3));
            } else {
                $('#total_ligne').val('');
            }
        }

        function setTotalAnnexeType2() {
            var total = 0;
            $('[name="total_ligne_2"]').each(function () {
                total = parseFloat(parseFloat(total) + parseFloat($(this).html()));
            });
            $('#total_type_annexe_2').val(parseFloat(total).toFixed(3));
            $('#total_type_annexe_2').attr("value", parseFloat(total).toFixed(3));
            setTotalAnnexeRubrique();
        }

        function editLigneExemple2(id) {
            $("#edit_ligne_add_2").val(id);

            $("#total_ligne").val($("#tr_annexe_type_2_" + id).find('td:eq(0)').html().trim());
            $("#nbre_nuit_ligne").val($("#tr_annexe_type_2_" + id).find('td:eq(1)').html().trim());
            $("#montant_nuit_ligne").val($("#tr_annexe_type_2_" + id).find('td:eq(2)').html().trim());
            $("#nbre_agent_ligne").val($("#tr_annexe_type_2_" + id).find('td:eq(3)').html().trim());
            $("#place_ligne").val($("#tr_annexe_type_2_" + id).find('td:eq(4)').html().trim());
        }

        function ClearLigne2() {
            $('#edit_ligne_add_2').val('');

            $('#total_ligne').val('');
            $("#nbre_nuit_ligne").val('');
            $("#montant_nuit_ligne").val('');
            $("#nbre_agent_ligne").val('');
            $("#place_ligne").val('');
        }

        $(document).ready(function () {
<?php if ($ligne_rubrique->getTitrebudjet()->getEtatbudget() != 2 && trim($ligne_rubrique->getTitrebudjet()->getTypebudget()) != "Budget Prévisionnel Global"): ?>
                $('#annexe_description_type_2').ckeditor();
<?php endif; ?>

            $("table").addClass("table table-bordered table-hover");
            $('input:text').not('[id="total_type_annexe_rubrique"]').attr('style', 'width: 100%;');
<?php if ($annexe_rubrique): ?>
                setTotalAnnexeRubrique();
<?php endif; ?>
        });

    </script>
</div>