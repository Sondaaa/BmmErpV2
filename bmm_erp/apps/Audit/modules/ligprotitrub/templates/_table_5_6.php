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
            <?php if ($type == 5): ?>
                <span style="font-size: 16px;">الإنعكاس المالي لترقية أعوان الديوان بعنوان سنة <?php echo $_SESSION['exercice_budget']; ?> </span>
            <?php else: ?>
                <span style="font-size: 16px;">الإنعكاس المالي لترقية أعوان الديوان بعنوان سنة <?php echo $_SESSION['exercice_budget']; ?> قبل الإحالة على التقاعد بثلاث سنوات </span>
            <?php endif; ?>
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
                        <?php if ($type == 5): ?>
                            <th style="width: 13%; text-align: center;">الأقدمية في الرتبة</th>
                        <?php else: ?>
                            <th style="width: 13%; text-align: center;">تاريخ الإحالة على التقاعد</th>
                        <?php endif; ?>
                        <th style="width: 6%; text-align: center;">عدد الأشهر</th>
                        <th style="width: 11%; text-align: center;">الإنعكاس المالي السنوي</th>
                        <th style="width: 10%; text-align: center;">منحة الإنتاج</th>
                        <th style="width: 10%; text-align: center;">الإنعكاس المالي الشهري</th>
                        <th style="width: 14%; text-align: center;">رتبة الترقية</th>
                        <th style="width: 16%; text-align: center;">الإسم و اللقب</th>
                        <th style="width: 7%; text-align: center;">الرقم</th>
                        <th style="width: 5%; text-align: center;">العدد الرتبي</th>
                        <th style="width: 8%; text-align: center;"></th>
                    </tr>
                    <tr name="tr_for_add">
                        <th><input id="<?php echo $type; ?>_date" type="date" value=""></th>
                        <th>
                            <select id="<?php echo $type; ?>_mois" onchange="setTotalLigneAnnexeType<?php echo $type; ?>()">
                                <option value="">...</option>
                                <?php for ($i = 1; $i < 13; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </th>
                        <th><input id="<?php echo $type; ?>_salaire_annuel" class="align_right" type="text" value="" readonly="true"></th>
                        <th><input id="<?php echo $type; ?>_prime" class="align_right" type="text" value=""></th>
                        <th><input id="<?php echo $type; ?>_salaire_mensuel" class="align_right" type="text" value="" onchange="setTotalLigneAnnexeType<?php echo $type; ?>()"></th>
                        <th><input id="<?php echo $type; ?>_categorie" type="text" value=""></th>
                        <th><input id="<?php echo $type; ?>_agent" type="text" value=""></th>
                        <th><input id="<?php echo $type; ?>_code" class="align_center" type="text" value=""></th>
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
            <table style="margin-bottom: 0px; font-size: 16px;">
                <thead>
                    <tr>
                        <th style="text-align: center; width: 19%;" rowspan="4"></th>
                        <th style="text-align: center; width: 11%;"><input type="text" class="align_right" id="<?php echo $type; ?>_total_annuel_1" value="0.000" readonly="true"></th>
                        <th style="text-align: center; width: 10%;"><input type="text" class="align_right" id="<?php echo $type; ?>_prime_1" value="0.000" readonly="true"></th>
                        <th style="text-align: center; width: 10%;"><input type="text" class="align_right" id="<?php echo $type; ?>_total_mensuel_1" value="0.000" readonly="true"></th>
                        <th style="text-align: right; width: 52%;">المجموع العام دون إعتبار الأعباء على كاهل المشغل</th>
                    </tr>
                    <tr>
                        <th style="text-align: center; width: 11%;"><input type="text" class="align_right" id="<?php echo $type; ?>_total_annuel_2" value="0.000" readonly="true"></th>
                        <th style="text-align: center; width: 10%;"><input type="text" class="align_right" id="<?php echo $type; ?>_prime_2" value="0.000" readonly="true"></th>
                        <th style="text-align: center; width: 10%;"><input type="text" class="align_right" id="<?php echo $type; ?>_total_mensuel_2" value="0.000" readonly="true"></th>
                        <th style="text-align: right; width: 50%;">% <input name="<?php echo $type; ?>_fardeau" type="text" style="width: 80px;" class="align_center" id="<?php echo $type; ?>_taux_fardeau" value="0.00" onchange="setTauxFardeau<?php echo $type; ?>()" onkeyup="setTotalAnnexeType<?php echo $type; ?>()"> الأعباء على كاهل المشغل </th>
                    </tr>
                    <tr>
                        <th style="text-align: center; width: 11%;"><input type="text" class="align_right" id="<?php echo $type; ?>_total_annuel_3" value="0.000" readonly="true"></th>
                        <th style="text-align: center; width: 10%;"><input type="text" class="align_right" id="<?php echo $type; ?>_prime_3" value="0.000" readonly="true"></th>
                        <th style="text-align: center; width: 10%;"><input type="text" class="align_right" id="<?php echo $type; ?>_total_mensuel_3" value="0.000" readonly="true"></th>
                        <th style="text-align: right; width: 50%;">كلفة الترقية بإعتبار الأعباء</th>
                    </tr>
                    <tr>
                        <th style="text-align: center;" colspan="3"><input name="total_type_annexe" annexe_id="<?php echo $type; ?>" type="text" class="align_center" id="total_type_annexe_<?php echo $type; ?>" value="0.000" readonly="true"></th>
                        <th style="text-align: center; width: 50%;">Total -  المبلغ الجملي</th>
                    </tr>
                </thead>
            </table>
            <input type="hidden" id="compteur_type_annexe_<?php echo $type; ?>" value="1">
        <?php endif; ?>
    </div>

    <script  type="text/javascript">

        function addligne<?php echo $type; ?>() {
            if ($("#<?php echo $type; ?>_date").val() != '' && $("#<?php echo $type; ?>_mois").val() != '' && $("#<?php echo $type; ?>_salaire_annuel").val() != '' && $("#<?php echo $type; ?>_prime").val() != '' && $("#<?php echo $type; ?>_salaire_mensuel").val() != '' && $("#<?php echo $type; ?>_categorie").val() != '' && $("#<?php echo $type; ?>_agent").val() != '' && $("#<?php echo $type; ?>_code").val() != '' && $("#<?php echo $type; ?>_numero").val() != '') {
                var id = parseInt($('#compteur_type_annexe_<?php echo $type; ?>').val());
                var tr_html = '<tr id="tr_annexe_type_<?php echo $type; ?>_' + id + '">';
                tr_html = tr_html + '<td name="<?php echo $type; ?>_date" style="text-align: center;">' + $("#<?php echo $type; ?>_date").val() + '</td>';
                tr_html = tr_html + '<td name="<?php echo $type; ?>_mois" style="text-align: center;">' + $("#<?php echo $type; ?>_mois").val() + '</td>';
                tr_html = tr_html + '<td name="<?php echo $type; ?>_salaire_annuel" style="text-align:right;">' + $("#<?php echo $type; ?>_salaire_annuel").val() + '</td>';
                tr_html = tr_html + '<td name="<?php echo $type; ?>_prime" style="text-align:right;">' + $("#<?php echo $type; ?>_prime").val() + '</td>';
                tr_html = tr_html + '<td name="<?php echo $type; ?>_salaire_mensuel" style="text-align:right;">' + $("#<?php echo $type; ?>_salaire_mensuel").val() + '</td>';
                tr_html = tr_html + '<td name="<?php echo $type; ?>_categorie" style="text-align: right;">' + $("#<?php echo $type; ?>_categorie").val() + '</td>';
                tr_html = tr_html + '<td name="<?php echo $type; ?>_agent" style="text-align: right;">' + $("#<?php echo $type; ?>_agent").val() + '</td>';
                tr_html = tr_html + '<td name="<?php echo $type; ?>_code" style="text-align:center;">' + $("#<?php echo $type; ?>_code").val() + '</td>';
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

                $('#<?php echo $type; ?>_date').val('');
                $("#<?php echo $type; ?>_mois").val('');
                $("#<?php echo $type; ?>_salaire_annuel").val('');
                $("#<?php echo $type; ?>_prime").val('');
                $('#<?php echo $type; ?>_salaire_mensuel').val('');
                $("#<?php echo $type; ?>_categorie").val('');
                $("#<?php echo $type; ?>_agent").val('');
                $("#<?php echo $type; ?>_code").val('');
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

        function setTotalLigneAnnexeType<?php echo $type; ?>() {
            if ($("#<?php echo $type; ?>_salaire_mensuel").val() != '' && $("#<?php echo $type; ?>_mois").val() != '') {
                var salaire_mensuel = parseFloat($('#<?php echo $type; ?>_salaire_mensuel').val());
                var nbr_mois = parseInt($('#<?php echo $type; ?>_mois').val());
                var total = parseFloat(parseFloat(salaire_mensuel) * parseInt(nbr_mois));
                $('#<?php echo $type; ?>_salaire_annuel').val(parseFloat(total).toFixed(3));
            } else {
                $('#<?php echo $type; ?>_salaire_annuel').val('');
            }
        }

        function setTotalAnnexeType<?php echo $type; ?>() {
            if ($('#<?php echo $type; ?>_taux_fardeau').val() != '') {
                var taux_fardeau = parseFloat($('#<?php echo $type; ?>_taux_fardeau').val());
                var total_annuel = 0;
                $('[name="<?php echo $type; ?>_salaire_annuel"]').each(function () {
                    total_annuel = parseFloat(parseFloat(total_annuel) + parseFloat($(this).html()));
                });
                var total_annuel_2 = parseFloat(parseFloat(total_annuel) * parseFloat(taux_fardeau) / parseFloat("100"));
                var total_annuel_3 = parseFloat(parseFloat(total_annuel) + parseFloat(total_annuel_2));
                $('#<?php echo $type; ?>_total_annuel_1').val(parseFloat(total_annuel).toFixed(3));
                $('#<?php echo $type; ?>_total_annuel_2').val(parseFloat(total_annuel_2).toFixed(3));
                $('#<?php echo $type; ?>_total_annuel_3').val(parseFloat(total_annuel_3).toFixed(3));

                var total_prime = 0;
                $('[name="<?php echo $type; ?>_prime"]').each(function () {
                    total_prime = parseFloat(parseFloat(total_prime) + parseFloat($(this).html()));
                });
                var total_prime_2 = parseFloat(parseFloat(total_prime) * parseFloat(taux_fardeau) / parseFloat("100"));
                var total_prime_3 = parseFloat(parseFloat(total_prime) + parseFloat(total_prime_2));
                $('#<?php echo $type; ?>_prime_1').val(parseFloat(total_prime).toFixed(3));
                $('#<?php echo $type; ?>_prime_2').val(parseFloat(total_prime_2).toFixed(3));
                $('#<?php echo $type; ?>_prime_3').val(parseFloat(total_prime_3).toFixed(3));

                var total_mensuel = 0;
                $('[name="<?php echo $type; ?>_salaire_mensuel"]').each(function () {
                    total_mensuel = parseFloat(parseFloat(total_mensuel) + parseFloat($(this).html()));
                });
                var total_mensuel_2 = parseFloat(parseFloat(total_mensuel) * parseFloat(taux_fardeau) / parseFloat("100"));
                var total_mensuel_3 = parseFloat(parseFloat(total_mensuel) + parseFloat(total_mensuel_2));
                $('#<?php echo $type; ?>_total_mensuel_1').val(parseFloat(total_mensuel).toFixed(3));
                $('#<?php echo $type; ?>_total_mensuel_1').attr("value", parseFloat(total_mensuel).toFixed(3));
                $('#<?php echo $type; ?>_total_mensuel_2').val(parseFloat(total_mensuel_2).toFixed(3));
                $('#<?php echo $type; ?>_total_mensuel_2').attr("value", parseFloat(total_mensuel_2).toFixed(3));
                $('#<?php echo $type; ?>_total_mensuel_3').val(parseFloat(total_mensuel_3).toFixed(3));
                $('#<?php echo $type; ?>_total_mensuel_3').attr("value", parseFloat(total_mensuel_3).toFixed(3));

                var total = parseFloat(parseFloat(total_annuel_3) + parseFloat(total_prime_3) + parseFloat(total_mensuel_3));
                $('#total_type_annexe_<?php echo $type; ?>').val(parseFloat(total).toFixed(3));
                $('#total_type_annexe_<?php echo $type; ?>').attr("value", parseFloat(total).toFixed(3));
                setTotalAnnexeRubrique();
            }
        }

        function setTauxFardeau<?php echo $type; ?>() {
            if ($('#<?php echo $type; ?>_taux_fardeau').val() != '') {
                var taux_fardeau = parseFloat($('#<?php echo $type; ?>_taux_fardeau').val());
                $('#<?php echo $type; ?>_taux_fardeau').val(parseFloat(taux_fardeau).toFixed(2));
            } else {
                $('#<?php echo $type; ?>_taux_fardeau').val('0.00');
            }
        }

        function editLigneExemple<?php echo $type; ?>(id) {
            $("#edit_ligne_add_<?php echo $type; ?>").val(id);

            $("#<?php echo $type; ?>_date").val($("#tr_annexe_type_<?php echo $type; ?>_" + id).find('td:eq(0)').html().trim());
            $("#<?php echo $type; ?>_mois").val($("#tr_annexe_type_<?php echo $type; ?>_" + id).find('td:eq(1)').html().trim());
            $("#<?php echo $type; ?>_salaire_annuel").val($("#tr_annexe_type_<?php echo $type; ?>_" + id).find('td:eq(2)').html().trim());
            $("#<?php echo $type; ?>_prime").val($("#tr_annexe_type_<?php echo $type; ?>_" + id).find('td:eq(3)').html().trim());
            $("#<?php echo $type; ?>_salaire_mensuel").val($("#tr_annexe_type_<?php echo $type; ?>_" + id).find('td:eq(4)').html().trim());
            $("#<?php echo $type; ?>_categorie").val($("#tr_annexe_type_<?php echo $type; ?>_" + id).find('td:eq(5)').html().trim());
            $("#<?php echo $type; ?>_agent").val($("#tr_annexe_type_<?php echo $type; ?>_" + id).find('td:eq(6)').html().trim());
            $("#<?php echo $type; ?>_code").val($("#tr_annexe_type_<?php echo $type; ?>_" + id).find('td:eq(7)').html().trim());
            $("#<?php echo $type; ?>_numero").val($("#tr_annexe_type_<?php echo $type; ?>_" + id).find('td:eq(8)').html().trim());
        }

        function ClearLigne<?php echo $type; ?>() {
            $('#edit_ligne_add_<?php echo $type; ?>').val('');

            $('#<?php echo $type; ?>_date').val('');
            $("#<?php echo $type; ?>_mois").val('');
            $("#<?php echo $type; ?>_salaire_annuel").val('');
            $("#<?php echo $type; ?>_prime").val('');
            $('#<?php echo $type; ?>_salaire_mensuel').val('');
            $("#<?php echo $type; ?>_categorie").val('');
            $("#<?php echo $type; ?>_agent").val('');
            $("#<?php echo $type; ?>_code").val('');
            $("#<?php echo $type; ?>_numero").val('');
        }

        $(document).ready(function () {
            $('#annexe_description_type_<?php echo $type; ?>').ckeditor();
            $("table").addClass("table table-bordered table-hover");
            $('input:text').not('[id="total_type_annexe_rubrique"]').not('[id="<?php echo $type; ?>_taux_fardeau"]').attr('style', 'width: 100%;');
            $('#<?php echo $type; ?>_mois').attr("style", "width: 100%;");
<?php if ($annexe_rubrique): ?>
                setTotalAnnexeRubrique();
<?php endif; ?>
        });

    </script>
</div>