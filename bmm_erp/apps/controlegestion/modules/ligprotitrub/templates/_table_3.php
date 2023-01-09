<?php
if ($id_saved == '')
    $annexe_rubrique = AnnexebudgetrubriqueTable::getInstance()->findByIdAnnexebudgetAndIdLigprotitrub($type, $id_ligprotitrub)->getFirst();
else
    $annexe_rubrique = AnnexebudgetrubriqueTable::getInstance()->find($id_saved);
?>
<?php $ligne_rubrique = LigprotitrubTable::getInstance()->find($id_ligprotitrub); ?>
<div class="col-md-12 annexe_type" id="div_add_annexe_3" style="margin-bottom: 15px;">
    <div class="col-md-12">
        <legend>
            <span style="font-size: 16px;">Prime de Compensation J.F. ( منحة تعويضية للعمل في الأعياد الرسمية )</span>
            <input type="hidden" name="annexe_rubrique" value="<?php echo $type ?>">
            <?php if ($ligne_rubrique->getTitrebudjet()->getEtatbudget() != 2 && trim($ligne_rubrique->getTitrebudjet()->getTypebudget()) != "Budget Prévisionnel Global"): ?>
                <input type="button" onclick="removeZoneTypeAnnexe('div_add_annexe_3')" style="font-size: 24px; margin-top: -10px; background-color: #0000; border: none; color: #A1A1A1; float: right;" value="×"/>
            <?php endif; ?>
        </legend>
    </div>
    <br>
    <div class="col-md-12">
        <?php if ($ligne_rubrique->getTitrebudjet()->getEtatbudget() != 2 && trim($ligne_rubrique->getTitrebudjet()->getTypebudget()) != "Budget Prévisionnel Global"): ?>
            <textarea name="annexe_description_type" id="annexe_description_type_3">
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
                        <th style="width: 20%; text-align: center;">Total<br>المبلغ الجملي</th>
                        <th style="width: 20%; text-align: center;">Nbre d'agent<br>عدد الأعوان</th>
                        <th style="width: 30%; text-align: center;">Moyenne Journ. Salaire Brut Journ.<br>معدل الأجر اليومي الخام</th>
                        <th style="width: 20%; text-align: center;">Nbre Jours Fériés<br>عدد أيام الأعياد</th>
                        <th style="width: 10%; text-align: center;"></th>
                    </tr>
                    <tr name="tr_for_add">
                        <th><input id="3_total_ligne" class="align_right" type="text" value="" readonly="true"></th>
                        <th><input id="3_nbre_agent_ligne" class="align_center" type="text" value="" onchange="setTotalLigneAnnexeType3()"></th>
                        <th><input id="3_salaire" class="align_right" type="text" value="" onchange="setTotalLigneAnnexeType3()"></th>
                        <th><input id="3_nbre_jour" class="align_center" type="text" value="" onchange="setTotalLigneAnnexeType3()"></th>
                        <th style="text-align: center; min-width: 80px;">
                            <span class="btn btn-primary btn-xs" onclick="addligne3()"><i class="ace-icon fa fa-arrow-down bigger-110 icon-only"></i></span>
                            <span class="btn btn-xs btn-success" onclick="ClearLigne3()"><i class="ace-icon fa fa-eraser bigger-110 icon-only"></i></span>
                            <input type="hidden" id="edit_ligne_add_3" value="">
                        </th>
                    </tr>
                </thead>
                <tbody id="tbody_add_annexe_3">

                </tbody>
            </table>
            <table style="margin-bottom: 0px;">
                <thead>
                    <tr>
                        <th style="text-align: center; width: 20%;"><input name="total_type_annexe" annexe_id="<?php echo $type; ?>" type="text" class="align_right" id="total_type_annexe_3" value="" readonly="true"></th>
                        <th style="text-align: center; width: 80%;">Total - المجموع</th>
                    </tr>
                </thead>
            </table>
            <input type="hidden" id="compteur_type_annexe_3" value="1">
        <?php endif; ?>
    </div>

    <script  type="text/javascript">

        function addligne3() {
            if ($("#3_total_ligne").val() != '' && $("#3_nbre_agent_ligne").val() != '' && $("#3_salaire").val() != '' && $("#3_nbre_jour").val() != '') {
                var id = parseInt($('#compteur_type_annexe_3').val());
                var tr_html = '<tr id="tr_annexe_type_3_' + id + '">';
                tr_html = tr_html + '<td name="total_ligne_3" style="text-align: right;">' + $("#3_total_ligne").val() + '</td>';
                tr_html = tr_html + '<td name="nbre_nuit_ligne" style="text-align: center;">' + $("#3_nbre_agent_ligne").val() + '</td>';
                tr_html = tr_html + '<td name="montant_nuit_ligne" style="text-align:right;">' + $("#3_salaire").val() + '</td>';
                tr_html = tr_html + '<td name="nbre_agent_ligne" style="text-align:center;">' + $("#3_nbre_jour").val() + '</td>';
                tr_html = tr_html + '<td style="text-align:center;vertical-align:middle;"><button style="margin-right: 5px;" class="btn btn-xs btn-warning" onclick="editLigneExemple3(' + id + ')"><i class="ace-icon fa fa-pencil-square-o"></i></button><button class="btn btn-xs btn-danger" onclick="suprimerLigneType3(' + id + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
                tr_html = tr_html + '</tr>';
                
                if ($("#edit_ligne_add_3").val() != '') {
                    var id_edit_ligne = $("#edit_ligne_add_3").val();
                    $("#tr_annexe_type_3_" + id_edit_ligne).after(tr_html);
                    $("#tr_annexe_type_3_" + id_edit_ligne).remove();
                } else {
                    $("#tbody_add_annexe_3").append(tr_html);
                }
                
                id++;
                $("#compteur_type_annexe_3").val(id);

                $('#3_total_ligne').val('');
                $("#3_nbre_agent_ligne").val('');
                $("#3_salaire").val('');
                $("#3_nbre_jour").val('');
                $('#edit_ligne_add_3').val('');

                setTotalAnnexeType3();
            } else {
                bootbox.dialog({
                    message: "Veuillez saisir le nombre des jours fériés, la moyenne journalière du salaire brut et/ou le nombre d'agent !",
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

        function suprimerLigneType3(id) {
            $("#tr_annexe_type_3_" + id).remove();
            setTotalAnnexeType3();
        }
        
        function setTotalLigneAnnexeType3() {
            if ($("#3_nbre_agent_ligne").val() != '' && $("#3_nbre_jour").val() != '' && $("#3_salaire").val() != '') {
                var nbr_agent = parseInt($('#3_nbre_agent_ligne').val());
                var nbr_nuit = parseInt($('#3_nbre_jour').val());
                var montant_nuit = parseFloat($('#3_salaire').val());
                var total = parseFloat(nbr_agent * nbr_nuit * montant_nuit);
                $('#3_total_ligne').val(parseFloat(total).toFixed(3));
            } else {
                $('#3_total_ligne').val('');
            }
        }

        function setTotalAnnexeType3() {
            var total = 0;
            $('[name="total_ligne_3"]').each(function () {
                total = parseFloat(parseFloat(total) + parseFloat($(this).html()));
            });
            $('#total_type_annexe_3').val(parseFloat(total).toFixed(3));
            $('#total_type_annexe_3').attr("value", parseFloat(total).toFixed(3));
            setTotalAnnexeRubrique();
        }
        
        function editLigneExemple3(id) {
            $("#edit_ligne_add_3").val(id);

            $("#3_total_ligne").val($("#tr_annexe_type_3_" + id).find('td:eq(0)').html().trim());
            $("#3_nbre_agent_ligne").val($("#tr_annexe_type_3_" + id).find('td:eq(1)').html().trim());
            $("#3_salaire").val($("#tr_annexe_type_3_" + id).find('td:eq(2)').html().trim());
            $("#3_nbre_jour").val($("#tr_annexe_type_3_" + id).find('td:eq(3)').html().trim());
        }

        function ClearLigne3() {
            $('#edit_ligne_add_3').val('');

            $('#3_total_ligne').val('');
            $("#3_nbre_agent_ligne").val('');
            $("#3_salaire").val('');
            $("#3_nbre_jour").val('');
        }

        $(document).ready(function () {
            $('#annexe_description_type_3').ckeditor();
            $("table").addClass("table table-bordered table-hover");
            $('input:text').not('[id="total_type_annexe_rubrique"]').attr('style', 'width: 100%;');
<?php if ($annexe_rubrique): ?>
                setTotalAnnexeRubrique();
<?php endif; ?>
        });

    </script>
</div>