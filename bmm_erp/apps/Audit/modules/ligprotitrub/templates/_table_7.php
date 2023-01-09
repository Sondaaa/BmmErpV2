<?php
if ($id_saved == '')
    $annexe_rubrique = AnnexebudgetrubriqueTable::getInstance()->findByIdAnnexebudgetAndIdLigprotitrub($type, $id_ligprotitrub)->getFirst();
else
    $annexe_rubrique = AnnexebudgetrubriqueTable::getInstance()->find($id_saved);
?>
<?php $ligne_rubrique = LigprotitrubTable::getInstance()->find($id_ligprotitrub); ?>
<div class="col-md-12 annexe_type" id="div_add_annexe_7" style="margin-bottom: 15px;">
    <div class="col-md-12">
        <legend>
            <span style="font-size: 16px;">الإنعكاس المالي لترقية أعوان الديوان بعنوان سنة <?php echo $_SESSION['exercice_budget']; ?> </span>
            <input type="hidden" name="annexe_rubrique" value="<?php echo $type ?>">
            <?php if ($ligne_rubrique->getTitrebudjet()->getEtatbudget() != 2 && trim($ligne_rubrique->getTitrebudjet()->getTypebudget()) != "Budget Prévisionnel Global"): ?>
                <input type="button" onclick="removeZoneTypeAnnexe('div_add_annexe_7')" style="font-size: 24px; margin-top: -10px; background-color: #0000; border: none; color: #A1A1A1; float: right;" value="×"/>
            <?php endif; ?>
        </legend>
    </div>
    <br>
    <div class="col-md-12">
        <?php if ($ligne_rubrique->getTitrebudjet()->getEtatbudget() != 2 && trim($ligne_rubrique->getTitrebudjet()->getTypebudget()) != "Budget Prévisionnel Global"): ?>
            <textarea name="annexe_description_type" id="annexe_description_type_7">
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
            <script  type="text/javascript">
                setTotalAnnexeType<?php echo $type; ?>();
            </script>
        <?php else: ?>
            <table style="margin-bottom: 0px;">
                <thead>
                    <tr style="font-size: 14px;">
                        <th style="width: 15%; text-align: center;">الإنعكاس المالي الجملي السنوي</th>
                        <th style="width: 15%; text-align: center;">الإنعكاس المالي السنوي</th>
                        <th style="width: 7%; text-align: center;">عدد الأشهر</th>
                        <th style="width: 14%; text-align: center;">الإنعكاس المالي الشهري</th>
                        <th style="width: 5%; text-align: center;">العدد</th>
                        <th style="width: 34%; text-align: center;">الخطة</th>
                        <th style="width: 10%; text-align: center;"></th>
                    </tr>
                    <tr name="tr_for_add">
                        <th><input id="7_salaire_total_annuel" class="align_right" type="text" value="" readonly="true"></th>
                        <th><input id="7_salaire_annuel" class="align_right" type="text" value=""></th>
                        <th>
                            <select id="7_mois" onchange="setTotalLigneAnnexeType7()">
                                <option value="">...</option>
                                <?php for ($i = 1; $i < 14; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </th>
                        <th><input id="7_salaire_mensuel" class="align_right" type="text" value="" onchange="setTotalLigneAnnexeType7()"></th>
                        <th><input id="7_numero" class="align_center" type="text" value=""></th>
                        <th><input id="7_poste" type="text" value=""></th>
                        <th style="text-align: center; min-width: 80px;">
                            <span class="btn btn-primary btn-xs" onclick="addligne7()"><i class="ace-icon fa fa-arrow-down bigger-110 icon-only"></i></span>
                            <span class="btn btn-xs btn-success" onclick="ClearLigne7()"><i class="ace-icon fa fa-eraser bigger-110 icon-only"></i></span>
                            <input type="hidden" id="edit_ligne_add_7" value="">
                        </th>
                    </tr>
                </thead>
                <tbody id="tbody_add_annexe_7">

                </tbody>
            </table>
            <table style="margin-bottom: 0px; font-size: 14px;">
                <thead>
                    <tr>
                        <th style="text-align: center; width: 15%;"><input type="text" class="align_right" id="7_total_annuel_1" value="0.000" readonly="true"></th>
                        <th style="text-align: right; width: 85%;">المجموع العام دون إعتبار الأعباء على كاهل المشغل</th>
                    </tr>
                    <tr>
                        <th style="text-align: center; width: 15%;"><input type="text" class="align_right" id="7_total_annuel_2" value="0.000" readonly="true"></th>
                        <th style="text-align: right; width: 85%;">% <input name="7_fardeau" type="text" style="width: 80px;" class="align_center" id="7_taux_fardeau" value="0.00" onchange="setTauxFardeau7()" onkeyup="setTotalAnnexeType7()"> الأعباء على كاهل المشغل </th>
                    </tr>
                    <tr>
                        <th style="text-align: center; width: 15%;"><input name="total_type_annexe" annexe_id="<?php echo $type; ?>" type="text" class="align_right" id="7_total_annuel_3" value="0.000" readonly="true"></th>
                        <th style="text-align: right; width: 85%;">كلفة الترقية بإعتبار الأعباء</th>
                    </tr>
                </thead>
            </table>
            <input type="hidden" id="compteur_type_annexe_7" value="1">
        <?php endif; ?>
    </div>

    <script  type="text/javascript">

        function addligne7() {
            if ($("#7_salaire_total_annuel").val() != '' && $("#7_salaire_annuel").val() != '' && $("#7_salaire_mensuel").val() != '' && $("#7_numero").val() != '' && $("#7_poste").val() != '') {
                var id = parseInt($('#compteur_type_annexe_7').val());
                var tr_html = '<tr id="tr_annexe_type_7_' + id + '">';
                tr_html = tr_html + '<td name="7_salaire_total_annuel" style="text-align:right;">' + $("#7_salaire_total_annuel").val() + '</td>';
                tr_html = tr_html + '<td name="7_salaire_annuel" style="text-align:right;">' + $("#7_salaire_annuel").val() + '</td>';
                tr_html = tr_html + '<td name="7_mois" style="text-align:center;">' + $("#7_mois").val() + '</td>';
                tr_html = tr_html + '<td name="7_salaire_mensuel" style="text-align:right;">' + $("#7_salaire_mensuel").val() + '</td>';
                tr_html = tr_html + '<td name="7_numero" style="text-align:center;">' + $("#7_numero").val() + '</td>';
                tr_html = tr_html + '<td name="7_poste" style="text-align: right;">' + $("#7_poste").val() + '</td>';
                tr_html = tr_html + '<td style="text-align:center;vertical-align:middle;"><button style="margin-right: 5px;" class="btn btn-xs btn-warning" onclick="editLigneExemple7(' + id + ')"><i class="ace-icon fa fa-pencil-square-o"></i></button><button class="btn btn-xs btn-danger" onclick="suprimerLigneType7(' + id + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
                tr_html = tr_html + '</tr>';

                if ($("#edit_ligne_add_7").val() != '') {
                    var id_edit_ligne = $("#edit_ligne_add_7").val();
                    $("#tr_annexe_type_7_" + id_edit_ligne).after(tr_html);
                    $("#tr_annexe_type_7_" + id_edit_ligne).remove();
                } else {
                    $("#tbody_add_annexe_7").append(tr_html);
                }

                id++;
                $("#compteur_type_annexe_7").val(id);

                $("#7_salaire_total_annuel").val('');
                $("#7_salaire_annuel").val('');
                $("#7_mois").val('');
                $('#7_salaire_mensuel').val('');
                $("#7_numero").val('');
                $("#7_poste").val('');
                $('#edit_ligne_add_7').val('');

                setTotalAnnexeType7();
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

        function suprimerLigneType7(id) {
            $("#tr_annexe_type_7_" + id).remove();
            setTotalAnnexeType7();
        }

        function setTotalLigneAnnexeType7() {
            if ($("#7_salaire_mensuel").val() != '' && $('#7_mois').val() != '') {
                var salaire_mensuel = parseFloat($('#7_salaire_mensuel').val());
                var nbr_mois = parseInt($('#7_mois').val());
                var total = parseFloat(parseFloat(salaire_mensuel) * parseInt(nbr_mois));
                $('#7_salaire_annuel').val(parseFloat(total).toFixed(3));
                var nbr = parseInt($('#7_numero').val());
                var total_annuel = parseFloat(parseFloat(total) * parseInt(nbr));
                $('#7_salaire_total_annuel').val(parseFloat(total_annuel).toFixed(3));
            } else {
                $('#7_salaire_annuel').val('');
                $('#7_salaire_total_annuel').val('');
            }
        }

        function setTotalAnnexeType7() {
            if ($('#7_taux_fardeau').val() != '') {
                var taux_fardeau = parseFloat($('#7_taux_fardeau').val());
                var total_annuel = 0;
                $('[name="7_salaire_total_annuel"]').each(function () {
                    total_annuel = parseFloat(parseFloat(total_annuel) + parseFloat($(this).html()));
                });
                var total_annuel_2 = parseFloat(parseFloat(total_annuel) * parseFloat(taux_fardeau) / parseFloat("100"));
                var total_annuel_3 = parseFloat(parseFloat(total_annuel) + parseFloat(total_annuel_2));
                $('#7_total_annuel_1').val(parseFloat(total_annuel).toFixed(3));
                $('#7_total_annuel_1').attr("value", parseFloat(total_annuel).toFixed(3));
                $('#7_total_annuel_2').val(parseFloat(total_annuel_2).toFixed(3));
                $('#7_total_annuel_2').attr("value", parseFloat(total_annuel_2).toFixed(3));
                $('#7_total_annuel_3').val(parseFloat(total_annuel_3).toFixed(3));
                $('#7_total_annuel_3').attr("value", parseFloat(total_annuel_3).toFixed(3));

                setTotalAnnexeRubrique();
            }
        }

        function setTauxFardeau7() {
            if ($('#7_taux_fardeau').val() != '') {
                var taux_fardeau = parseFloat($('#7_taux_fardeau').val());
                $('#7_taux_fardeau').val(parseFloat(taux_fardeau).toFixed(2));
            } else {
                $('#7_taux_fardeau').val('0.00');
            }
        }

        function editLigneExemple7(id) {
            $("#edit_ligne_add_7").val(id);

            $("#7_salaire_total_annuel").val($("#tr_annexe_type_7_" + id).find('td:eq(0)').html().trim());
            $("#7_salaire_annuel").val($("#tr_annexe_type_7_" + id).find('td:eq(1)').html().trim());
            $("#7_mois").val($("#tr_annexe_type_7_" + id).find('td:eq(2)').html().trim());
            $("#7_salaire_mensuel").val($("#tr_annexe_type_7_" + id).find('td:eq(3)').html().trim());
            $("#7_numero").val($("#tr_annexe_type_7_" + id).find('td:eq(4)').html().trim());
            $("#7_poste").val($("#tr_annexe_type_7_" + id).find('td:eq(5)').html().trim());
        }

        function ClearLigne7() {
            $('#edit_ligne_add_7').val('');

            $("#7_salaire_total_annuel").val('');
            $("#7_salaire_annuel").val('');
            $("#7_mois").val('');
            $('#7_salaire_mensuel').val('');
            $("#7_numero").val('');
            $("#7_poste").val('');
        }

        $(document).ready(function () {
            $('#annexe_description_type_7').ckeditor();
            $("table").addClass("table table-bordered table-hover");
            $('input:text').not('[id="total_type_annexe_rubrique"]').not('[id="7_taux_fardeau"]').attr('style', 'width: 100%;');
            $('#7_mois').attr("style", "width: 100%;");
<?php if ($annexe_rubrique): ?>
                setTotalAnnexeRubrique();
<?php endif; ?>
        });

    </script>
</div>