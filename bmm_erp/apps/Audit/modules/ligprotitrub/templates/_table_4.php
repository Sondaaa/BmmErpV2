<?php
if ($id_saved == '')
    $annexe_rubrique = AnnexebudgetrubriqueTable::getInstance()->findByIdAnnexebudgetAndIdLigprotitrub($type, $id_ligprotitrub)->getFirst();
else
    $annexe_rubrique = AnnexebudgetrubriqueTable::getInstance()->find($id_saved);
?>
<?php $ligne_rubrique = LigprotitrubTable::getInstance()->find($id_ligprotitrub); ?>
<div class="col-md-12 annexe_type" id="div_add_annexe_4" style="margin-bottom: 15px;">
    <div class="col-md-12">
        <legend>
            <span style="font-size: 16px;">المنحة التكميلية بعنوان المسؤولية </span>
            <input type="hidden" name="annexe_rubrique" value="<?php echo $type ?>">
            <?php if ($ligne_rubrique->getTitrebudjet()->getEtatbudget() != 2 && trim($ligne_rubrique->getTitrebudjet()->getTypebudget()) != "Budget Prévisionnel Global"): ?>
                <input type="button" onclick="removeZoneTypeAnnexe('div_add_annexe_4')" style="font-size: 24px; margin-top: -10px; background-color: #0000; border: none; color: #A1A1A1; float: right;" value="×"/>
            <?php endif; ?>
        </legend>
    </div>
    <br>
    <div class="col-md-12">
        <?php if ($ligne_rubrique->getTitrebudjet()->getEtatbudget() != 2 && trim($ligne_rubrique->getTitrebudjet()->getTypebudget()) != "Budget Prévisionnel Global"): ?>
            <textarea name="annexe_description_type" id="annexe_description_type_4">
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
                    <tr style="font-size: 14px;">
                        <th style="width: 13%; text-align: center;">Total<br>المجموع</th>
                        <th style="width: 10%; text-align: center;">fardeau %<br> % أعباء المشغل<br><input type="text" value="0.00" id="4_fardeau" class="align_center" onchange="setTauxFardeau()"></th>
                        <th style="width: 15%; text-align: center;">Salaire Brut Annuel<br>الأجر الخام السنوي</th>
                        <th style="width: 16%; text-align: center;">Salaire Brut Mensuel<br>الأجر الخام الشهري</th>
                        <th style="width: 36%; text-align: center;">Prime<br>المنحة</th>
                        <th style="width: 10%; text-align: center;"></th>
                    </tr>
                    <tr name="tr_for_add">
                        <th><input id="4_total_ligne" class="align_right" type="text" value="" readonly="true"></th>
                        <th><input id="4_montant_fardeau" class="align_center" type="text" value="" readonly="true"></th>
                        <th><input id="4_salaire_annuel" class="align_right" type="text" value="" readonly="true"></th>
                        <th><input id="4_salaire_mensuel" class="align_right" type="text" value="" onchange="setTotalLigneAnnexeType4()"></th>
                        <th><input id="4_prime" type="text" value=""></th>
                        <th style="text-align: center; min-width: 80px;">
                            <span class="btn btn-primary btn-xs" onclick="addligne4()"><i class="ace-icon fa fa-arrow-down bigger-110 icon-only"></i></span>
                            <span class="btn btn-xs btn-success" onclick="ClearLigne4()"><i class="ace-icon fa fa-eraser bigger-110 icon-only"></i></span>
                            <input type="hidden" id="edit_ligne_add_4" value="">
                        </th>
                    </tr>
                </thead>
                <tbody id="tbody_add_annexe_4">

                </tbody>
            </table>
            <table style="margin-bottom: 0px;">
                <thead>
                    <tr>
                        <th style="text-align: center; width: 13%;"><input name="total_type_annexe" annexe_id="<?php echo $type; ?>" type="text" class="align_right" id="total_type_annexe_4" value="" readonly="true"></th>
                        <th style="text-align: center; width: 87%;">Total -  المبلغ الجملي</th>
                    </tr>
                </thead>
            </table>
            <input type="hidden" id="compteur_type_annexe_4" value="1">
        <?php endif; ?>
    </div>

    <script  type="text/javascript">

        function addligne4() {
            if ($("#4_prime").val() != '' && $("#4_total_ligne").val() != '') {
                var id = parseInt($('#compteur_type_annexe_4').val());
                var tr_html = '<tr id="tr_annexe_type_4_' + id + '">';
                tr_html = tr_html + '<td name="total_ligne_4" style="text-align: right;">' + $("#4_total_ligne").val() + '</td>';
                tr_html = tr_html + '<td name="nbre_nuit_ligne" style="text-align: center;">' + $("#4_montant_fardeau").val() + '</td>';
                tr_html = tr_html + '<td name="montant_nuit_ligne" style="text-align:right;">' + $("#4_salaire_annuel").val() + '</td>';
                tr_html = tr_html + '<td name="nbre_agent_ligne" style="text-align:center;">' + $("#4_salaire_mensuel").val() + '</td>';
                tr_html = tr_html + '<td name="place_ligne" style="text-align:right;">' + $("#4_prime").val() + '</td>';
                tr_html = tr_html + '<td style="text-align:center;vertical-align:middle;"><button style="margin-right: 5px;" class="btn btn-xs btn-warning" onclick="editLigneExemple4(' + id + ')"><i class="ace-icon fa fa-pencil-square-o"></i></button><button class="btn btn-xs btn-danger" onclick="suprimerLigneType4(' + id + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
                tr_html = tr_html + '</tr>';
                if ($("#edit_ligne_add_4").val() != '') {
                    var id_edit_ligne = $("#edit_ligne_add_4").val();
                    $("#tr_annexe_type_4_" + id_edit_ligne).after(tr_html);
                    $("#tr_annexe_type_4_" + id_edit_ligne).remove();
                } else {
                    $("#tbody_add_annexe_4").append(tr_html);
                }
                
                id++;
                $("#compteur_type_annexe_4").val(id);

                $('#4_total_ligne').val('');
                $("#4_montant_fardeau").val('');
                $("#4_salaire_annuel").val('');
                $("#4_salaire_mensuel").val('');
                $("#4_prime").val('');
                $('#edit_ligne_add_4').val('');

                setTotalAnnexeType4();
            } else {
                bootbox.dialog({
                    message: "Veuillez saisir le prime et/ou le salaire brut mensuel !",
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

        function suprimerLigneType4(id) {
            $("#tr_annexe_type_4_" + id).remove();
            setTotalAnnexeType4();
        }

        function setTotalLigneAnnexeType4() {
            if ($("#4_salaire_mensuel").val() != '') {
                var salaire_mensuel = parseFloat($('#4_salaire_mensuel').val());
                var nbr_mois = 12;
                var salaire_annuel = parseFloat(parseFloat(salaire_mensuel) * parseInt(nbr_mois));
                var taux_fardeau = parseFloat($('#4_fardeau').val());
                var montant_fardeau = parseFloat(parseFloat(salaire_annuel) * parseFloat(taux_fardeau) / parseInt('100'));
                var total = parseFloat(parseFloat(salaire_annuel) + parseFloat(montant_fardeau));
                $('#4_salaire_annuel').val(parseFloat(salaire_annuel).toFixed(3));
                $('#4_montant_fardeau').val(parseFloat(montant_fardeau).toFixed(3));
                $('#4_total_ligne').val(parseFloat(total).toFixed(3));
            } else {
                $('#4_salaire_annuel').val('');
                $('#4_montant_fardeau').val('');
                $('#4_total_ligne').val('');
            }
        }

        function setTotalAnnexeType4() {
            var total = 0;
            $('[name="total_ligne_4"]').each(function () {
                total = parseFloat(parseFloat(total) + parseFloat($(this).html()));
            });
            $('#total_type_annexe_4').val(parseFloat(total).toFixed(3));
            $('#total_type_annexe_4').attr("value", parseFloat(total).toFixed(3));
            setTotalAnnexeRubrique();
        }

        function setTauxFardeau() {
            if ($('#4_fardeau').val() != '') {
                var taux_fardeau = parseFloat($('#4_fardeau').val());
                $('#4_fardeau').val(parseFloat(taux_fardeau).toFixed(2));
            } else {
                $('#4_fardeau').val('0.00');
            }
        }

        function editLigneExemple4(id) {
            $("#edit_ligne_add_4").val(id);

            $("#4_total_ligne").val($("#tr_annexe_type_4_" + id).find('td:eq(0)').html().trim());
            $("#4_montant_fardeau").val($("#tr_annexe_type_4_" + id).find('td:eq(1)').html().trim());
            $("#4_salaire_annuel").val($("#tr_annexe_type_4_" + id).find('td:eq(2)').html().trim());
            $("#4_salaire_mensuel").val($("#tr_annexe_type_4_" + id).find('td:eq(3)').html().trim());
            $("#4_prime").val($("#tr_annexe_type_4_" + id).find('td:eq(4)').html().trim());
        }

        function ClearLigne4() {
            $('#edit_ligne_add_4').val('');

            $('#4_total_ligne').val('');
            $("#4_montant_fardeau").val('');
            $("#4_salaire_annuel").val('');
            $("#4_salaire_mensuel").val('');
            $("#4_prime").val('');
        }

        $(document).ready(function () {
            $('#annexe_description_type_4').ckeditor();
            $("table").addClass("table table-bordered table-hover");
            $('input:text').not('[id="total_type_annexe_rubrique"]').attr('style', 'width: 100%;');
<?php if ($annexe_rubrique): ?>
                setTotalAnnexeRubrique();
<?php endif; ?>
        });

    </script>
</div>