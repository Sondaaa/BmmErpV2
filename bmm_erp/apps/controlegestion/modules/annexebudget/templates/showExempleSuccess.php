<?php
$rang = explode(',', $rang);
$colonne = explode(';;', $colonne);
$type = explode(',', $type_colonne);
$nature = explode(',', $nature);
$formule = explode(',', $formule);
$sommation = explode(',', $sommation);
?> 
<div class="col-md-12" style="margin-top: 15px;">
    <table style="margin-bottom: 0px;">
        <thead>
            <tr>
                <th colspan="<?php echo sizeof($rang); ?>" style="text-align: center; font-size: 16px; padding: 5px;">
                    Exemple de : <?php echo $titre; ?>
                </th>
            </tr>
            <tr style="font-size: 14px;">
                <?php for ($i = 0; $i < sizeof($rang); $i++): ?>
                    <?php if ($rang[$i] != ''): ?>
                        <th <?php if ($type[$i] != "text"): ?>style="text-align: center;"<?php else: ?>style="text-align: <?php echo $direction ?>;"<?php endif; ?>><?php echo $colonne[$i]; ?></th>
                    <?php endif; ?>
                <?php endfor; ?>
                <th style="width: 8%; text-align: center;">Action</th>
            </tr>
            <tr id="ligne_add">
                <?php for ($i = 0; $i < sizeof($rang); $i++): ?>
                    <?php if ($rang[$i] != ''): ?>
                        <th><input id="<?php echo $rang[$i]; ?>" name="colonne_<?php echo $i; ?>" <?php if ($type[$i] == "date"): ?>type="date"<?php else: ?>type="text"<?php endif; ?> <?php if ($type[$i] == "taux"): ?>onchange="setFormat('<?php echo $rang[$i]; ?>', '2')"<?php endif; ?> <?php if ($type[$i] == "montant"): ?>class="align_right" onchange="setFormat('<?php echo $rang[$i]; ?>', '3')"<?php elseif ($type[$i] == "taux" || $type[$i] == "quantite"): ?>class="align_center"<?php else: ?><?php if ($direction != "left"): ?>class="align_right"<?php endif; ?><?php endif; ?> <?php if ($nature[$i] == "calcule"): ?>readonly="true"<?php endif; ?>></th>
                    <?php endif; ?>
                <?php endfor; ?>
                <th style="text-align: center;">
                    <span class="btn btn-xs btn-primary" onclick="ajouterLigne()"><i class="ace-icon fa fa-plus bigger-110 icon-only"></i> Ajouter</span>
                </th>
            </tr>
        </thead>
        <tbody id="tbody_table_showing">

        </tbody>
        <?php if ($sommation_table != "false"): ?>
            <tfoot>
                <tr>
                    <?php for ($i = 0; $i < sizeof($rang); $i++): ?>
                        <?php if ($rang[$i] != ''): ?>
                            <?php if ($sommation[$i] != "false"): ?>
                                <td><input id="total_<?php echo $i; ?>" value="0" type="text" <?php if ($type[$i] == "montant"): ?>class="align_right"<?php else: ?>class="align_center"<?php endif; ?> readonly="true"></td>
                            <?php else: ?>
                                <td></td>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <td style="width: 8%; vertical-align: middle; text-align: center;">Total</td>
                </tr>
            </tfoot>
        <?php endif; ?>
    </table>
</div>

<input type="hidden" id="compteur_ligne" value="<?php echo sizeof($rang) + 1; ?>">

<script  type="text/javascript">

<?php for ($i = 0; $i < sizeof($rang); $i++): ?>
    <?php if ($rang[$i] != ''): ?>
        <?php if ($sommation[$i] != "false"): ?>
                function  sum<?php echo $i; ?>() {
                    var total = 0;
                    $('td[name="colonne_<?php echo $i; ?>"]').each(function () {
                        if ($(this).html() != '')
                            total = parseFloat(total) + parseFloat($(this).html());
                    });
                    
            <?php if ($type[$i] == "montant"): ?>
                        $("#total_<?php echo $i; ?>").val(parseFloat(total).toFixed(3));
            <?php else: ?>
                        $("#total_<?php echo $i; ?>").val(parseFloat(total));
            <?php endif; ?>
                }
        <?php endif; ?>
    <?php endif; ?>
<?php endfor; ?>
    $("#ligne_add input").keyup(function () {
<?php if ($direction == "left"): ?>
    <?php for ($i = 0; $i < sizeof($rang); $i++): ?>
        <?php if ($rang[$i] != ''): ?>
            <?php if ($formule[$i] != ""): ?>
                <?php $formule_ligne = str_replace(' ', '', $formule[$i]); ?>
                <?php if ($type[$i] == "montant"): ?>
                            $("#<?php echo $rang[$i]; ?>").val(parseFloat(adapteFormule('<?php echo $formule_ligne; ?>')).toFixed(3));
                <?php else: ?>
                            $("#<?php echo $rang[$i]; ?>").val(adapteFormule('<?php echo $formule_ligne; ?>'));
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endfor; ?>
<?php else: ?>
    <?php for ($i = sizeof($rang) - 1; $i >= 0; $i--): ?>
        <?php if ($rang[$i] != ''): ?>
            <?php if ($formule[$i] != ""): ?>
                <?php $formule_ligne = str_replace(' ', '', $formule[$i]); ?>
                <?php if ($type[$i] == "montant"): ?>
                            $("#<?php echo $rang[$i]; ?>").val(parseFloat(adapteFormule('<?php echo $formule_ligne; ?>')).toFixed(3));
                <?php else: ?>
                            $("#<?php echo $rang[$i]; ?>").val(adapteFormule('<?php echo $formule_ligne; ?>'));
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endfor; ?>
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
        $('#ligne_add input').each(function () {
            if ($(this).val() == '')
                empty++;
        });
        if (empty == 0) {
            var id = parseInt($('#compteur_ligne').val());
            var tr_html = '<tr id="tr_annexe_ligne_' + id + '">';

<?php for ($i = 0; $i < sizeof($rang); $i++): ?>
    <?php if ($rang[$i] != ''): ?>
                    tr_html = tr_html + '<td name="colonne_<?php echo $i; ?>" <?php if ($type[$i] == "montant"): ?>style="text-align:right;"<?php elseif ($type[$i] == "date" || $type[$i] == "taux" || $type[$i] == "quantite"): ?>style="text-align:center;"<?php else: ?><?php if ($direction != "left"): ?>style="text-align:right;"<?php endif; ?><?php endif; ?>>' + $("#<?php echo $rang[$i]; ?>").val() + '</td>';
    <?php endif; ?>
<?php endfor; ?>

            tr_html = tr_html + '<td style="text-align:center;vertical-align:middle;"><button class="btn btn-xs btn-danger" onclick="suprimerLigneExemple(' + id + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
            tr_html = tr_html + '</tr>';

            $("#tbody_table_showing").append(tr_html);
            id++;
            $("#compteur_ligne").val(id);
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
    <?php for ($i = 0; $i < sizeof($rang); $i++): ?>
        <?php if ($rang[$i] != ''): ?>
            <?php if ($sommation[$i] != "false"): ?>
                        sum<?php echo $i; ?>();
            <?php endif; ?>
        <?php endif; ?>
    <?php endfor; ?>
<?php else: ?>
    <?php for ($i = sizeof($rang) - 1; $i >= 0; $i--): ?>
        <?php if ($rang[$i] != ''): ?>
            <?php if ($sommation[$i] != "false"): ?>
                        sum<?php echo $i; ?>();
            <?php endif; ?>
        <?php endif; ?>
    <?php endfor; ?>
<?php endif; ?>
    }

    function setFormat(id, fixed) {
        if ($("#" + id).val() != '') {
            $("#" + id).val(parseFloat($("#" + id).val()).toFixed(fixed));
        }
    }

    $("table").addClass("table table-bordered table-hover");
    $('input:text').attr('style', 'width: 100%;');

</script>