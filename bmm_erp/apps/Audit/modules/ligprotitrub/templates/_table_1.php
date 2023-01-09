<?php
$direction = $annexe->getDirection();
$sommation_table = $annexe->getSommation();
$titre = $annexe->getTitre();
if ($id_saved == '')
    $annexe_rubrique = AnnexebudgetrubriqueTable::getInstance()->findByIdAnnexebudgetAndIdLigprotitrub($type, $id_ligprotitrub)->getFirst();
else
    $annexe_rubrique = AnnexebudgetrubriqueTable::getInstance()->find($id_saved);
$ligne_annexes = AnnexebudgetligneTable::getInstance()->getByAnnexe($annexe->getId());
$desc_ligne_annexes = AnnexebudgetligneTable::getInstance()->getByAnnexe($annexe->getId(), 1);

$ligne_rubrique = LigprotitrubTable::getInstance()->find($id_ligprotitrub);
?>
<input type="hidden" id="count_td_data_table" value="<?php echo $ligne_annexes->count(); ?>">
<div class="col-md-12 annexe_type" id="div_add_annexe_<?php echo $type; ?>" style="margin-bottom: 15px;">
    <div class="col-md-12">
        <legend>
            <span style="font-size: 16px;"><?php echo $titre; ?></span>
            <input type="hidden" name="annexe_rubrique" value="<?php echo $type; ?>">
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
                    $description = str_replace('~', '', $annexe_rubrique->getDescription());
                    echo $description;
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
            $contenu = str_replace('§§', '#', $contenu);
            $contenu = str_replace('§', '+', $contenu);
            $contenu = htmlentities($contenu);
            echo html_entity_decode($contenu);
            ?>

            <div id="thead_add_ligne">
                <table style="margin-bottom: 0px;" id="table_thead_add_ligne">
                    <thead>
                        <tr style="font-size: 14px;">
                            <?php foreach ($ligne_annexes as $ligne_annexe): ?>
                                <th <?php if ($ligne_annexe->getType() != "text"): ?>style="text-align: center;"<?php else: ?>style="text-align: <?php echo $direction ?>;"<?php endif; ?>><?php echo $ligne_annexe->getLibelle(); ?></th>
                            <?php endforeach; ?>
                            <th style="width: 8%; text-align: center;">Action</th>
                        </tr>
                        <tr id="ligne_add" name="tr_for_add">
                            <?php foreach ($ligne_annexes as $ligne_annexe): ?>
                                <?php if ($ligne_annexe->getRang() != "Z"): ?>
                                    <th><input id="<?php echo $ligne_annexe->getRang(); ?>" name="col_<?php echo $ligne_annexe->getId(); ?>" <?php if ($ligne_annexe->getType() == "date"): ?>type="date"<?php else: ?>type="text"<?php endif; ?> <?php if ($ligne_annexe->getType() == "taux"): ?>onchange="setFormat('<?php echo $ligne_annexe->getRang(); ?>', '2')"<?php endif; ?> <?php if ($ligne_annexe->getType() == "montant"): ?>class="a_r" onchange="setFormat('<?php echo $ligne_annexe->getRang(); ?>', '3')"<?php elseif ($ligne_annexe->getType() == "taux" || $ligne_annexe->getType() == "quantite"): ?>class="align_center"<?php else: ?><?php if ($direction != "left"): ?>class="a_r"<?php endif; ?><?php endif; ?> <?php if ($ligne_annexe->getNature() == "calcule"): ?>readonly="true"<?php endif; ?>></th>
                                <?php else: ?>
                                    <?php
                                    $agents = Doctrine_Query::create()
                                            ->select('a.id as id, a.nomcomplet as nomcomplet, a.idrh as idrh')
                                            ->from('Agents a')
                                            ->where("(a.active IS NULL OR a.active = true)")
                                            ->andWhere('a.datesortie IS NULL')
                                            ->execute();
                                    ?>
                                    <th>
                                        <select onchange="setIdrh()" id="<?php echo $ligne_annexe->getRang(); ?>" name="col_<?php echo $ligne_annexe->getId(); ?>">
                                            <option idrh="" value="">selectionnez ...</option>
                                            <?php foreach ($agents as $agent): ?>
                                                <option idrh="<?php echo trim($agent->getIdrh()); ?>" value="<?php echo trim($agent->getNomcomplet()); ?>"><?php echo trim($agent->getNomcomplet()); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </th>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <th style="text-align: center; min-width: 80px;">
                                <span class="btn btn-xs btn-primary" onclick="ajouterLigne()"><i class="ace-icon fa fa-plus bigger-110 icon-only"></i></span>
                                <span class="btn btn-xs btn-success" onclick="ClearLigne1()"><i class="ace-icon fa fa-eraser bigger-110 icon-only"></i></span>
                                <input type="hidden" id="edit_ligne_add_1" value="">
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        <?php else: ?>
            <div id="zone_scroll" class="col-md-12" style="padding: 0px; overflow-x: auto; overflow-y: hidden; min-height: 360px;">
                <table style="margin-bottom: 0px;" id="table_data_salaires">
                    <thead>
                        <tr style="font-size: 14px;">
                            <?php foreach ($ligne_annexes as $ligne_annexe): ?>
                                <th <?php if ($ligne_annexe->getType() != "text"): ?>style="text-align: center;"<?php else: ?>style="text-align: <?php echo $direction ?>;"<?php endif; ?>><?php echo $ligne_annexe->getLibelle(); ?></th>
                            <?php endforeach; ?>
                            <th style="width: 8%; text-align: center;">Action</th>
                        </tr>
                        <tr id="ligne_add" name="tr_for_add">
                            <?php foreach ($ligne_annexes as $ligne_annexe): ?>
                                <?php if ($ligne_annexe->getRang() != "Z"): ?>
                                    <th><input id="<?php echo $ligne_annexe->getRang(); ?>" name="col_<?php echo $ligne_annexe->getId(); ?>" <?php if ($ligne_annexe->getType() == "date"): ?>type="date"<?php else: ?>type="text"<?php endif; ?> <?php if ($ligne_annexe->getType() == "taux"): ?>onchange="setFormat('<?php echo $ligne_annexe->getRang(); ?>', '2')"<?php endif; ?> <?php if ($ligne_annexe->getType() == "montant"): ?>class="a_r" onchange="setFormat('<?php echo $ligne_annexe->getRang(); ?>', '3')"<?php elseif ($ligne_annexe->getType() == "taux" || $ligne_annexe->getType() == "quantite"): ?>class="align_center"<?php else: ?><?php if ($direction != "left"): ?>class="a_r"<?php endif; ?><?php endif; ?> <?php if ($ligne_annexe->getNature() == "calcule"): ?>readonly="true"<?php endif; ?>></th>
                                <?php else: ?>
                                    <?php
                                    $agents = Doctrine_Query::create()
                                            ->select('a.id as id, a.nomcomplet as nomcomplet, a.idrh as idrh')
                                            ->from('Agents a')
                                            ->where("(a.active IS NULL OR a.active = true)")
                                            ->andWhere('a.datesortie IS NULL')
                                            ->execute();
                                    ?>
                                    <th>
                                        <select onchange="setIdrh()" id="<?php echo $ligne_annexe->getRang(); ?>" name="col_<?php echo $ligne_annexe->getId(); ?>">
                                            <option idrh="" value="">selectionnez ...</option>
                                            <?php foreach ($agents as $agent): ?>
                                                <option idrh="<?php echo trim($agent->getIdrh()); ?>" value="<?php echo trim($agent->getNomcomplet()); ?>"><?php echo trim($agent->getNomcomplet()); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </th>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <th style="text-align: center; min-width: 80px;">
                                <span class="btn btn-xs btn-primary" onclick="ajouterLigne()"><i class="ace-icon fa fa-plus bigger-110 icon-only"></i></span>
                                <span class="btn btn-xs btn-success" onclick="ClearLigne1()"><i class="ace-icon fa fa-eraser bigger-110 icon-only"></i></span>
                                <input type="hidden" id="edit_ligne_add_1" value="">
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tbody_table_showing">

                    </tbody>
                    <?php if ($sommation_table != false): ?>
                        <tfoot id="total_tfoot">
                            <tr>
                                <?php foreach ($ligne_annexes as $ligne_annexe): ?>
                                    <?php if ($ligne_annexe->getSommation() != false || $ligne_annexe->getTotal() != false): ?>
                                        <td><input id="total_<?php echo $ligne_annexe->getId(); ?>" value="0.000" type="text" <?php if ($ligne_annexe->getType() == "montant"): ?>class="a_r"<?php else: ?>class="align_center"<?php endif; ?> readonly="true"></td>
                                    <?php else: ?>
                                        <td></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <td style="width: 8%; vertical-align: middle; text-align: center;">Total</td>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>
            </div>

            <div class="col-md-12" id="result_for_save_annexe_<?php echo $type; ?>" style="padding: 0px;">
                <div class="col-md-7 col-lg-push-3" style="padding: 0px; margin-top: 10px;">
                    <table style="margin-bottom: 0px; text-align: right; font-size: 14px;" id="results_salaires">
                        <thead>
                            <tr>
                                <th colspan="3" style="text-align: right; font-size: 16px;">حوصلة لأجور أعوان الديوان لسنة 2020</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 35%;"><input id="<?php echo $type; ?>_total_1" type="text" class="a_r" value="" readonly="true"></td>
                                <td colspan="2">الأجر السنوي الخام لسنة 2020 <span style="float: left;">(1)</span></td>
                            </tr>
                            <tr>
                                <td><input id="<?php echo $type; ?>_total_2" type="text" class="a_r" value="" readonly="true"></td>
                                <td colspan="2">منحة الإنتاج السنوية لسنة 2020 <span style="float: left;">(2)</span></td>
                            </tr>
                            <tr style="background-color: #FFF6C2;">
                                <td><input id="<?php echo $type; ?>_total_3" type="text" class="a_r" value="" readonly="true"></td>
                                <td colspan="2">المنح العائلية و منحة الأجر الوحيد لسنة 2020 <span style="float: left;">(3)</span></td>
                            </tr>
                            <tr>
                                <td><input id="<?php echo $type; ?>_total_4" type="text" class="a_r" value="" readonly="true"></td>
                                <td colspan="2">التدرج العادي و التدرج بالجدارة لسنة 2020 <span style="float: left;">(4)</span></td>
                            </tr>
                            <tr>
                                <td><input id="<?php echo $type; ?>_total_5" type="text" class="a_r" value="" readonly="true"></td>
                                <td colspan="2">تذكير بالزيادة العامة في الأجور لسنة 2019 <span style="float: left;">(5)</span></td>
                            </tr>
                            <tr style="background-image: linear-gradient(to bottom,#F0F5FF 0,#CFD0FF 100%);">
                                <td><input id="<?php echo $type; ?>_total_6" type="text" class="a_r" value="" readonly="true"></td>
                                <td colspan="2">المجموع <span style="float: left;">(6) = (1) + (2) + (3) + (4) + (5)</span></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr style="background-image: linear-gradient(to bottom,#EBFFE5 0,#BEEAC1 100%);">
                                <td><input id="<?php echo $type; ?>_total_7" type="text" class="a_r" value="" readonly="true"></td>
                                <td style="width: 20%;"><input type="text" class="align_center" id="taux_employeur" value="0.00" onkeyup="calculerMontantEmployeur()" onchange="setFormat('taux_employeur', '2')"></td>
                                <td style="width: 45%;">(%) أعباء المشغل  <span style="float: left;">(7) = ( (6) - (3) ) * %</span></td>
                            </tr>
                            <tr style="background-image: linear-gradient(to bottom,#FFE9E9 0,#FFB9B9 100%);">
                                <td><input name="total_type_annexe" annexe_id="<?php echo $type; ?>" id="<?php echo $type; ?>_total_8" type="text" class="a_r" value="" readonly="true"></td>
                                <td colspan="2">نفقات التأجير بإعتبار الأعباء الإجتماعية <span style="float: left;">(7) + (6)</span></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <input type="hidden" id="compteur_ligne_<?php echo $type; ?>" value="1">
        <?php endif; ?>
    </div>

    <?php if ($annexe_rubrique): ?>
        <script  type="text/javascript">
            var html_thead = $("#table_thead_add_ligne > thead").html();
            $("#table_data_salaires > thead").html(html_thead);
            $("#thead_add_ligne").remove();

            var html_results = $("#saved_result_data_salaire_1").html();
            $("#result_for_save_annexe_<?php echo $type; ?>").html(html_results);
            $("#saved_result_data_salaire_1").remove();

            var data_td = $("#saved_data_salaire_1_0").val() + $("#saved_data_salaire_1_1").val() + $("#saved_data_salaire_1_2").val() + $("#saved_data_salaire_1_3").val();
            if ($("#saved_data_salaire_1_0").val()) {
                $("#saved_data_salaire_1_0").remove();
                $("#saved_data_salaire_1_1").remove();
                $("#saved_data_salaire_1_2").remove();
                $("#saved_data_salaire_1_3").remove();
                data_td = data_td.split('¤');
                var id = 1;

                var ligne_data_td = data_td[0].split(';');
                for (var i = 0; i < ligne_data_td.length - 1; i++) {
                    var tr_html = '<tr id="tr_annexe_ligne_' + id + '">';
    <?php foreach ($ligne_annexes as $ligne_annexe): ?>
                        tr_html = tr_html + '<td name="col_<?php echo $ligne_annexe->getId(); ?>" <?php if ($ligne_annexe->getType() == "montant"): ?>style="text-align:right;"<?php elseif ($ligne_annexe->getType() == "date" || $ligne_annexe->getType() == "taux" || $ligne_annexe->getType() == "quantite"): ?>style="text-align:center;"<?php else: ?><?php if ($direction != "left"): ?>style="text-align:right;"<?php endif; ?><?php endif; ?>></td>';
    <?php endforeach; ?>

                    tr_html = tr_html + '<td style="text-align:center;vertical-align:middle;"><button style="margin-right: 5px;" class="btn btn-xs btn-warning" onclick="editLigneExemple1(' + id + ')"><i class="ace-icon fa fa-pencil-square-o"></i></button><button class="btn btn-xs btn-danger" onclick="suprimerLigneExemple(' + id + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
                    tr_html = tr_html + '</tr>';

                    $("#tbody_table_showing").append(tr_html);
                    id++;
                }

                var id_td = 0;
                for (var k = 0; k < data_td.length - 1; k++) {
                    var id_ligne = 1;
                    var ligne_data_td = data_td[k].split(';');
                    for (var i = 0; i < ligne_data_td.length - 1; i++) {
                        $("#tr_annexe_ligne_" + id_ligne + " td:eq(" + id_td + ")").html(ligne_data_td[i]);
                        id_ligne++;
                    }
                    id_td++;
                }

                $("#compteur_ligne_<?php echo $type; ?>").val(id);
            }

        </script>
    <?php endif; ?>

    <script  type="text/javascript">

        //Replace les années statiques (2020 et 2019) par les années courantes et précédentes (Y, Y-1)
        $("#for_save_annexe_<?php echo $type; ?>").html($("#for_save_annexe_<?php echo $type; ?>").html().replace(/2020/g, '<?php echo date('Y', strtotime($ligne_rubrique->getTitrebudjet()->getDatecreation())); ?>'));
        $("#for_save_annexe_<?php echo $type; ?>").html($("#for_save_annexe_<?php echo $type; ?>").html().replace(/2019/g, '<?php echo date('Y', strtotime($ligne_rubrique->getTitrebudjet()->getDatecreation())) - 1; ?>'));

<?php foreach ($ligne_annexes as $ligne_annexe): ?>
    <?php if ($ligne_annexe->getSommation() != false): ?>
                function  sum<?php echo $ligne_annexe->getId(); ?>() {
                    var total = 0;
                    $('td[name="col_<?php echo $ligne_annexe->getId(); ?>"]').each(function () {
                        if ($(this).html() != '')
                            total = parseFloat(total) + parseFloat($(this).html());
                    });

        <?php if ($ligne_annexe->getType() == "montant"): ?>
                        $("#total_<?php echo $ligne_annexe->getId(); ?>").val(parseFloat(total).toFixed(3));
                        $('#total_<?php echo $type; ?>').attr("value", parseFloat(total).toFixed(3));
        <?php else: ?>
                        $("#total_<?php echo $ligne_annexe->getId(); ?>").val(parseFloat(total));
                        $('#total_<?php echo $type; ?>').attr("value", parseFloat(total));
        <?php endif; ?>
                }
    <?php endif; ?>
<?php endforeach; ?>
        $("#ligne_add input").keyup(function () {
<?php if ($direction == "left"): ?>
    <?php foreach ($ligne_annexes as $ligne_annexe): ?>
        <?php if ($ligne_annexe->getFormule() != ""): ?>
            <?php $formule_ligne = str_replace(' ', '', $ligne_annexe->getFormule()); ?>
            <?php $formule_ligne = str_replace("$", "+", $formule_ligne); ?>
            <?php if ($ligne_annexe->getType() == "montant"): ?>
                            $("#<?php echo $ligne_annexe->getRang(); ?>").val(parseFloat(adapteFormule('<?php echo $formule_ligne; ?>')).toFixed(3));
            <?php else: ?>
                            $("#<?php echo $ligne_annexe->getRang(); ?>").val(adapteFormule('<?php echo $formule_ligne; ?>'));
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
<?php else: ?>
    <?php foreach ($desc_ligne_annexes as $ligne_annexe): ?>
        <?php if ($ligne_annexe->getFormule() != ""): ?>
            <?php $formule_ligne = str_replace(' ', '', $ligne_annexe->getFormule()); ?>
            <?php $formule_ligne = str_replace("$", "+", $formule_ligne); ?>
            <?php if ($ligne_annexe->getType() == "montant"): ?>
                            $("#<?php echo $ligne_annexe->getRang(); ?>").val(parseFloat(adapteFormule('<?php echo $formule_ligne; ?>')).toFixed(3));
            <?php else: ?>
                            $("#<?php echo $ligne_annexe->getRang(); ?>").val(adapteFormule('<?php echo $formule_ligne; ?>'));
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
        });
        function adapteFormule(formule) {
            formule = formule.replace(/\$/gi, "+");
            var total = '';
            for (i = 0; i < formule.length; i++) {
                if (isLetter(formule[i])) {
                    if ($("#" + formule[i].toUpperCase()).val() != '')
                        total = total + $("#" + formule[i].toUpperCase()).val();
                    else
                        total = total + "0";
                } else {
                    total = total + formule[i];
                }
            }

            total = eval(total);
            return total;
        }

        function isLetter(str) {
            return str.match("^[a-zA-Z]+$");
        }

        function suprimerLigneExemple(id) {
            $("#tr_annexe_ligne_" + id).remove();
            calculerTotaux();
        }

        function ajouterLigne() {
            var empty = 0;
//            $('#ligne_add input').each(function () {
            //                if ($(this).val() == '')
            //                    empty++;
            //            });
            if (empty == 0) {
                var id = parseInt($('#compteur_ligne_<?php echo $type; ?>').val());
                var tr_html = '<tr id="tr_annexe_ligne_' + id + '">';

<?php foreach ($ligne_annexes as $ligne_annexe): ?>
                    tr_html = tr_html + '<td name="col_<?php echo $ligne_annexe->getId(); ?>" <?php if ($ligne_annexe->getType() == "montant"): ?>style="text-align:right;"<?php elseif ($ligne_annexe->getType() == "date" || $ligne_annexe->getType() == "taux" || $ligne_annexe->getType() == "quantite"): ?>style="text-align:center;"<?php else: ?><?php if ($direction != "left"): ?>style="text-align:right;"<?php endif; ?><?php endif; ?>>' + $("#<?php echo $ligne_annexe->getRang(); ?>").val() + '</td>';
<?php endforeach; ?>

                tr_html = tr_html + '<td style="text-align:center;vertical-align:middle;"><button style="margin-right: 5px;" class="btn btn-xs btn-warning" onclick="editLigneExemple1(' + id + ')"><i class="ace-icon fa fa-pencil-square-o"></i></button><button class="btn btn-xs btn-danger" onclick="suprimerLigneExemple(' + id + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
                tr_html = tr_html + '</tr>';

                if ($("#edit_ligne_add_1").val() != '') {
                    var id_edit_ligne = $("#edit_ligne_add_1").val();
                    $("#tr_annexe_ligne_" + id_edit_ligne).after(tr_html);
                    $("#tr_annexe_ligne_" + id_edit_ligne).remove();
                } else {
                    $("#tbody_table_showing").append(tr_html);
                }

                id++;
                $("#compteur_ligne_<?php echo $type; ?>").val(id);

                $("#ligne_add").find('input').val('');
                $("#ligne_add").find('select').val('');
                $('#Z').trigger("chosen:updated");
                $("#edit_ligne_add_1").val('');

                calculerTotaux();
            } else {
                bootbox.dialog({
                    message: "Veuillez saisir tout les champs !",
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

        function calculerTotaux() {
<?php if ($direction == "left"): ?>
    <?php foreach ($ligne_annexes as $ligne_annexe): ?>
        <?php if ($ligne_annexe->getSommation() != false): ?>
                        sum<?php echo $ligne_annexe->getId(); ?>();
        <?php endif; ?>
    <?php endforeach; ?>
<?php else: ?>
    <?php foreach ($desc_ligne_annexes as $ligne_annexe): ?>
        <?php if ($ligne_annexe->getSommation() != false): ?>
                        sum<?php echo $ligne_annexe->getId(); ?>();
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
            setTableTotaux();
            setTotalAnnexeRubrique();
        }

        function setFormat(id, fixed) {
            if ($("#" + id).val() != '') {
                $("#" + id).attr("value", parseFloat($("#" + id).val()).toFixed(fixed));
                $("#" + id).val(parseFloat($("#" + id).val()).toFixed(fixed));
            }
        }

        function setIdrh() {
            $("#AA").val($("#Z option:selected").attr("idrh"));
            $("#zone_scroll").scrollRight();
        }

        function setTableTotaux() {
            var total_1 = $("#total_tfoot > tr > td:eq(9) > input").val();
            $('#<?php echo $type; ?>_total_1').attr("value", parseFloat(total_1).toFixed(3));
            var total_2 = $("#total_tfoot > tr > td:eq(7) > input").val();
            $('#<?php echo $type; ?>_total_2').attr("value", parseFloat(total_2).toFixed(3));
            var total_3 = parseFloat(parseFloat($("#total_tfoot > tr > td:eq(8) > input").val()) * parseFloat("12"));
            $('#<?php echo $type; ?>_total_3').attr("value", parseFloat(total_3).toFixed(3));
            var total_4 = parseFloat(parseFloat($("#total_tfoot > tr > td:eq(1) > input").val()) + parseFloat($("#total_tfoot > tr > td:eq(4) > input").val()));
            $('#<?php echo $type; ?>_total_4').attr("value", parseFloat(total_4).toFixed(3));
            var total_5 = $("#total_tfoot > tr > td:eq(11) > input").val();
            $('#<?php echo $type; ?>_total_5').attr("value", parseFloat(total_5).toFixed(3));
            var total_6 = parseFloat(parseFloat(total_5) + parseFloat(total_4) + parseFloat(total_3) + parseFloat(total_2) + parseFloat(total_1)).toFixed(3);
            $('#<?php echo $type; ?>_total_6').attr("value", parseFloat(total_6).toFixed(3));
            var total_7 = parseFloat(parseFloat(parseFloat(total_6) - parseFloat(total_3)) * parseFloat($("#taux_employeur").val()) / parseFloat("100")).toFixed(3);
            $('#<?php echo $type; ?>_total_7').attr("value", parseFloat(total_7).toFixed(3));
            var total_8 = parseFloat(parseFloat(total_7) + parseFloat(total_6));
            $('#<?php echo $type; ?>_total_8').attr("value", parseFloat(total_8).toFixed(3));
        }

        function calculerMontantEmployeur() {
            var taux = 0;
            if ($("#taux_employeur").val() != '') {
                taux = $("#taux_employeur").val();
            }
            if ($('#<?php echo $type; ?>_total_6').val() != '') {
                var total_7 = parseFloat(parseFloat(parseFloat($('#<?php echo $type; ?>_total_6').val()) - parseFloat($('#<?php echo $type; ?>_total_3').val())) * parseFloat(taux) / parseFloat("100")).toFixed(3);
                $('#<?php echo $type; ?>_total_7').attr("value", parseFloat(total_7).toFixed(3));
                var total_8 = parseFloat(parseFloat(total_7) + parseFloat($('#<?php echo $type; ?>_total_6').val()));
                $('#<?php echo $type; ?>_total_8').attr("value", parseFloat(total_8).toFixed(3));
            } else {
                $('#<?php echo $type; ?>_total_7').attr("value", "0.000");
                $('#<?php echo $type; ?>_total_8').attr("value", "0.000");
            }
            setTotalAnnexeRubrique();
        }

        function editLigneExemple1(id) {
            $("#edit_ligne_add_1").val(id);
            var id_data = 0;
<?php foreach ($ligne_annexes as $ligne_annexe): ?>
                $("#<?php echo $ligne_annexe->getRang(); ?>").val($("#tr_annexe_ligne_" + id).find('td:eq(' + id_data + ')').html().trim());
    <?php if ($ligne_annexe->getRang() != "Z"): ?>
                    //Rien
    <?php else: ?>
                    //Select Agents
                    $('#Z').trigger("chosen:updated");
    <?php endif; ?>
                id_data++;
<?php endforeach; ?>
        }

        function ClearLigne1() {
            $("#ligne_add").find('input').val('');
            $("#ligne_add").find('select').val('');
            $('#Z').trigger("chosen:updated");
            $("#edit_ligne_add_1").val('');
        }

    </script>

    <script  type="text/javascript">
        $(document).ready(function () {
            $('#annexe_description_type_<?php echo $type; ?>').ckeditor();
            $("table").addClass("table table-bordered table-hover");
            $("#Z").attr('class', "chosen-select form-control");
            $('#Z').chosen({allow_single_deselect: true});
            $('.chosen-container').attr("style", "width: 100%;");
            $('.chosen-container').trigger("chosen:updated");
            $('input:text').not('[id="total_type_annexe_rubrique"]').not('[id="<?php echo $type; ?>_taux_fardeau"]').attr('style', 'width: 100%; min-width: 100px;');
<?php if ($annexe_rubrique): ?>
                calculerTotaux();
                setTotalAnnexeRubrique();
<?php endif; ?>
        });
    </script>
</div>
<style>
    #for_save_annexe_<?php echo $type; ?>{min-height: 350px;}
    .a_r {text-align: right;}
</style>