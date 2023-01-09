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
?>
<?php $ligne_rubrique = LigprotitrubTable::getInstance()->find($id_ligprotitrub); ?>
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
                        <?php foreach ($ligne_annexes as $ligne_annexe): ?>
                            <th <?php if ($ligne_annexe->getType() != "text"): ?>style="text-align: center;"<?php else: ?>style="text-align: <?php echo $direction ?>;"<?php endif; ?>><?php echo $ligne_annexe->getLibelle(); ?></th>
                        <?php endforeach; ?>
                        <th style="width: 8%; text-align: center;">Action</th>
                    </tr>
                    <tr id="ligne_add" name="tr_for_add">
                        <?php foreach ($ligne_annexes as $ligne_annexe): ?>
                            <th><input id="<?php echo $ligne_annexe->getRang(); ?>" name="colonne_<?php echo $ligne_annexe->getId(); ?>" <?php if ($ligne_annexe->getType() == "date"): ?>type="date"<?php else: ?>type="text"<?php endif; ?> <?php if ($ligne_annexe->getType() == "taux"): ?>onchange="setFormat('<?php echo $ligne_annexe->getRang(); ?>', '2')"<?php endif; ?> <?php if ($ligne_annexe->getType() == "montant"): ?>class="align_right" onchange="setFormat('<?php echo $ligne_annexe->getRang(); ?>', '3')"<?php elseif ($ligne_annexe->getType() == "taux" || $ligne_annexe->getType() == "quantite"): ?>class="align_center"<?php else: ?><?php if ($direction != "left"): ?>class="align_right"<?php endif; ?><?php endif; ?> <?php if ($ligne_annexe->getNature() == "calcule"): ?>readonly="true"<?php endif; ?>></th>
                        <?php endforeach; ?>
                        <th style="text-align: center; min-width: 80px;">
                            <span class="btn btn-xs btn-primary" onclick="ajouterLigne()"><i class="ace-icon fa fa-plus bigger-110 icon-only"></i></span>
                            <span class="btn btn-xs btn-success" onclick="ClearLigne()"><i class="ace-icon fa fa-eraser bigger-110 icon-only"></i></span>
                            <input type="hidden" id="edit_ligne_add" value="">
                        </th>
                    </tr>
                </thead>
                <tbody id="tbody_table_showing">

                </tbody>
                <?php if ($sommation_table != false): ?>
                    <tfoot>
                        <tr>
                            <?php foreach ($ligne_annexes as $ligne_annexe): ?>
                                <?php if ($ligne_annexe->getSommation() != false || $ligne_annexe->getTotal() != false): ?>
                                    <td><input id="total_<?php echo $ligne_annexe->getId(); ?>" <?php if ($ligne_annexe->getTotal() != false): ?>name="total_type_annexe" annexe_id="<?php echo $type; ?>" <?php endif; ?> value="0" type="text" <?php if ($ligne_annexe->getType() == "montant"): ?>class="align_right"<?php else: ?>class="align_center"<?php endif; ?> readonly="true"></td>
                                <?php else: ?>
                                    <td></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <td style="width: 8%; vertical-align: middle; text-align: center;">Total</td>
                        </tr>
                    </tfoot>
                <?php endif; ?>
            </table>

            <input type="hidden" id="compteur_ligne_<?php echo $type; ?>" value="1">
        <?php endif; ?>
    </div>
    <script  type="text/javascript">

<?php foreach ($ligne_annexes as $ligne_annexe): ?>
    <?php if ($ligne_annexe->getSommation() != false): ?>
                function  sum<?php echo $ligne_annexe->getId(); ?>() {
                    var total = 0;
                    $('td[name="colonne_<?php echo $ligne_annexe->getId(); ?>"]').each(function () {
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
            $('#ligne_add input:text').each(function () {
                if ($(this).val() == '')
                    empty++;
            });
            if (empty == 0) {
                var id = parseInt($('#compteur_ligne_<?php echo $type; ?>').val());
                var tr_html = '<tr id="tr_annexe_ligne_' + id + '">';

<?php foreach ($ligne_annexes as $ligne_annexe): ?>
                    tr_html = tr_html + '<td name="colonne_<?php echo $ligne_annexe->getId(); ?>" <?php if ($ligne_annexe->getType() == "montant"): ?>style="text-align:right;"<?php elseif ($ligne_annexe->getType() == "date" || $ligne_annexe->getType() == "taux" || $ligne_annexe->getType() == "quantite"): ?>style="text-align:center;"<?php else: ?><?php if ($direction != "left"): ?>style="text-align:right;"<?php endif; ?><?php endif; ?>>' + $("#<?php echo $ligne_annexe->getRang(); ?>").val() + '</td>';
<?php endforeach; ?>

                tr_html = tr_html + '<td style="text-align:center;vertical-align:middle;"><button style="margin-right: 5px;" class="btn btn-xs btn-warning" onclick="editLigneExemple(' + id + ')"><i class="ace-icon fa fa-pencil-square-o"></i></button><button class="btn btn-xs btn-danger" onclick="suprimerLigneExemple(' + id + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
                tr_html = tr_html + '</tr>';

                if ($("#edit_ligne_add").val() != '') {
                    var id_edit_ligne = $("#edit_ligne_add").val();
                    $("#tr_annexe_ligne_" + id_edit_ligne).after(tr_html);
                    $("#tr_annexe_ligne_" + id_edit_ligne).remove();
                } else {
                    $("#tbody_table_showing").append(tr_html);
                }

                id++;
                $("#compteur_ligne_<?php echo $type; ?>").val(id);

                $("#ligne_add").find('input').val('');

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
            setTotalAnnexeRubrique();
        }

        function setFormat(id, fixed) {
            if ($("#" + id).val() != '') {
                $("#" + id).val(parseFloat($("#" + id).val()).toFixed(fixed));
            }
        }

        function ClearLigne() {
            $("#ligne_add").find('input').val('');
            $("#edit_ligne_add").val('');
        }

        function editLigneExemple(id) {
            $("#edit_ligne_add").val(id);
            var id_data = 0;
<?php foreach ($ligne_annexes as $ligne_annexe): ?>
                $("#<?php echo $ligne_annexe->getRang(); ?>").val($("#tr_annexe_ligne_" + id).find('td:eq(' + id_data + ')').html().trim());
                id_data++;
<?php endforeach; ?>
        }

    </script>

    <script  type="text/javascript">
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