<?php
$direction = $annexe->getDirection();
$sommation = $annexe->getSommation();
$titre = $annexe->getTitre();
?>
<div class="col-md-12">
    <table>
        <thead>
            <tr>
                <th colspan="8" style="text-align: center; font-size: 16px; padding: 5px;">
                    <span style="float: left; color: #006ea6;">
                        <?php if ($direction == "gauche"): ?>
                            Gauche <i class="ace-icon fa fa-arrow-right"></i>
                        <?php else: ?>
                            <i class="ace-icon fa fa-arrow-left"></i> Droite
                        <?php endif; ?>
                    </span>
                    <?php echo $titre; ?>
                    <span class="btn btn-xs btn-success pull-right" onclick="showTableEdit()"><i class="ace-icon fa fa-eye bigger-110 icon-only"></i> Afficher</span>
                </th>
            </tr>
            <tr style="font-size: 14px;">
                <th style="width: 7%; text-align: center;">Rang</th>
                <th style="width: 30%;">
                    Colonne
                    <span class="btn btn-xs btn-warning pull-right" onclick="addRowEdit()"><i class="ace-icon fa fa-plus bigger-110 icon-only"></i></span>
                </th>
                <th style="width: 10%; text-align: center;">Type</th>
                <th style="width: 10%; text-align: center;">Nature</th>
                <th style="width: 20%; text-align: center;">Formule</th>
                <th style="width: 9%; text-align: center; <?php if ($sommation == false): ?>display: none;<?php endif; ?>">Sommation</th>
                <th style="width: 7%; text-align: center;">Total</th>
                <th style="width: 7%; text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody id="tbody_generate">
            <?php $ligne_annexes = AnnexebudgetligneTable::getInstance()->getByAnnexe($annexe->getId()); ?>
            <?php $nbr = 0; ?>
            <?php foreach ($ligne_annexes as $ligne_annexe): ?>
                <tr id="tr_<?php echo $ligne_annexe->getId(); ?>">
                    <td><input type="text" class="align_center" name="rang" value="<?php echo $ligne_annexe->getRang(); ?>" readonly="true"></td>
                    <td><input type="text" name="colonne" value="<?php echo $ligne_annexe->getLibelle(); ?>" <?php if ($direction != "left"): ?>class="align_right"<?php endif; ?>></td>
                    <td>
                        <select name="type" id="type_<?php echo $ligne_annexe->getId(); ?>" onchange="setDisabled('<?php echo $ligne_annexe->getId(); ?>')">
                            <option <?php if ($ligne_annexe->getType() == "text"): ?>selected="true"<?php endif; ?> value="text">Texte</option>
                            <option <?php if ($ligne_annexe->getType() == "date"): ?>selected="true"<?php endif; ?> value="date">Date</option>
                            <option <?php if ($ligne_annexe->getType() == "montant"): ?>selected="true"<?php endif; ?> value="montant">Montant</option>
                            <option <?php if ($ligne_annexe->getType() == "quantite"): ?>selected="true"<?php endif; ?> value="quantite">Quantité</option>
                            <option <?php if ($ligne_annexe->getType() == "taux"): ?>selected="true"<?php endif; ?> value="taux">Taux</option>
                        </select>
                    </td>
                    <td>
                        <select name="nature" id="nature_<?php echo $ligne_annexe->getId(); ?>" onchange="setReadonly('<?php echo $ligne_annexe->getId(); ?>')">
                            <option <?php if ($ligne_annexe->getNature() == "saisie"): ?>selected="true"<?php endif; ?> value="saisie">Saisie</option>
                            <option <?php if ($ligne_annexe->getNature() == "calcule"): ?>selected="true"<?php endif; ?> value="calcule">Calcule</option>
                        </select>
                    </td>
                    <td style="text-align: center;"><input type="text" id="formule_<?php echo $ligne_annexe->getId(); ?>" name="formule" value="<?php echo str_replace("$", "+", $ligne_annexe->getFormule()); ?>" class="uppercase_input" <?php if ($ligne_annexe->getFormule() == ''): ?>readonly="true"<?php endif; ?>></td>
                    <td style="text-align: center; <?php if ($sommation == false): ?>display: none;<?php endif; ?>">
                        <input name="sommation" id="sommation_<?php echo $ligne_annexe->getId(); ?>" <?php if ($ligne_annexe->getSommation() == true): ?>checked="true"<?php endif; ?> type="checkbox">
                    </td>
                    <td style="text-align: center;">
                        <input name="c_total" id="c_total_<?php echo $ligne_annexe->getId(); ?>" <?php if ($ligne_annexe->getTotal() == true): ?>checked="true"<?php endif; ?> type="checkbox">
                    </td>
                    <td style="text-align: center;">
                        <span class="btn btn-xs btn-danger" onclick="removeRowEdit('<?php echo $ligne_annexe->getId(); ?>')"><i class="ace-icon fa fa-trash bigger-110 icon-only"></i></span>
                    </td>
                </tr>
                <?php
                if ($nbr < $ligne_annexe->getId())
                    $nbr = $ligne_annexe->getId();
                ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<input type="hidden" id="compteur_row" value="<?php echo $nbr + 1; ?>">

<script  type="text/javascript">

    $(document).ready(function () {
        $('#tbody_generate').sortable({
            start: function (e, ui) {
//                alert(ui.helper.text());
            },
            stop: function () {
                setLetters();
                r();
            },
            update: function () {

            }
        });
    });

    // and here's the trick (works everywhere)
    // set selected value on select chosen
    // 1000 (milliseconds) = 1 seconds
    function r(f) {
        /in/.test(document.readyState) ? setTimeout('r(' + f + ')', 1000) : f();
    }
    // use like
    r(function () {
<?php foreach ($ligne_annexes as $ligne_annexe): ?>
            $("#type_<?php echo $ligne_annexe->getId(); ?>").val('<?php echo $ligne_annexe->getType(); ?>');
            $("#nature_<?php echo $ligne_annexe->getId(); ?>").val('<?php echo $ligne_annexe->getNature(); ?>');
    <?php if ($ligne_annexe->getType() == "montant"): ?>
                $('#nature_<?php echo $ligne_annexe->getId(); ?>_chosen').removeClass("disabledbutton");
    <?php else: ?>
                $('#nature_<?php echo $ligne_annexe->getId(); ?>_chosen').addClass("disabledbutton");
    <?php endif; ?>
<?php endforeach; ?>
        $('.chosen-container').trigger("chosen:updated");
    });

    function setReadonly(id) {
        if ($("#nature_" + id).val() == "saisie") {
            $("#formule_" + id).attr("readonly", "true");
        } else {
            $("#formule_" + id).removeAttr("readonly");
        }
        $("#formule_" + id).val('');
    }

    function setDisabled(id) {
        if ($("#type_" + id).val() == "montant") {
            $("#nature_" + id + "_chosen").removeClass("disabledbutton");
        } else {
            $("#nature_" + id + "_chosen").addClass("disabledbutton");
        }
    }

    function removeRowEdit(id) {
        $("#tr_" + id).remove();
        setLetters();
        var nbr_colonne = parseInt($("#nbr_colonne").val());
        nbr_colonne--;
        $("#nbr_colonne").val(parseInt(nbr_colonne));
    }

    function setLetters() {
        var letters = "A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,AA,AB,AC,AD,AE,AF,AG,AH,AI,AJ,AK,AL,AM,AN,AO,AP,AQ,AR,AS,AT,AU,AV,AW,AX,AY,AZ";
        var letters = letters.split(',');
        var position = 0;
        $('input[name="rang"]').each(function () {
            $(this).val(letters[position]);
            position++;
        });
    }

    function addRowEdit() {
        var id = parseInt($("#compteur_row").val());
        $.ajax({
            url: '<?php echo url_for('annexebudget/addRowTableAnnexe') ?>',
            data: 'id=' + id +
                    '&direction=' + "<?php echo $direction ?>" +
                    '&sommation=' + "<?php echo $sommation; ?>",
            success: function (data) {
                $("#tbody_generate").append(data);
                setLetters();
                id++;
                $("#compteur_row").val(id);
                var nbr_colonne = parseInt($("#nbr_colonne").val());
                nbr_colonne++;
                $("#nbr_colonne").val(parseInt(nbr_colonne));
            }
        });
    }

    function showTableEdit() {
        if (verifColonne()) {
            if (verifTotal() == 1) {
                var valid_sommation = 1;
<?php if ($sommation != false): ?>
                    valid_sommation = checkValidSommation();
<?php endif; ?>
                if (valid_sommation > 0) {
                    var count_nature_calcule = 0;
                    var count_calcule = 0;

                    var rang = '';
                    $('input[name="rang"]').each(function () {
                        rang = rang + $(this).val() + ',';
                    });
                    var colonne = '';
                    $('input[name="colonne"]').each(function () {
                        colonne = colonne + $(this).val() + ';;';
                    });
                    var type_colonne = '';
                    $('select[name="type"]').each(function () {
                        type_colonne = type_colonne + $(this).val() + ',';
                    });
                    var nature = '';
                    $('select[name="nature"]').each(function () {
                        nature = nature + $(this).val() + ',';
                        if ($(this).val() == "calcule")
                            count_nature_calcule++;
                    });
                    var formule = '';
                    $('input[name="formule"]').each(function () {
                        formule = formule + $(this).val() + ',';
                        if ($(this).val() != "")
                            count_calcule++;
                    });
                    formule = formule.replace(/\+/gi, "$");
                    var sommation = '';
                    $('input[name="sommation"]').each(function () {
                        sommation = sommation + $(this).is(":checked") + ',';
                    });
                    var total = '';
                    $('input[name="c_total"]').each(function () {
                        total = total + $(this).is(":checked") + ',';
                    });
                    if (count_nature_calcule == count_calcule) {
                        $.ajax({
                            url: '<?php echo url_for('annexebudget/showTableEdit') ?>',
                            data: 'rang=' + rang +
                                    '&colonne=' + colonne +
                                    '&type_colonne=' + type_colonne +
                                    '&nature=' + nature +
                                    '&formule=' + formule +
                                    '&sommation=' + sommation +
                                    '&total=' + total +
                                    '&titre=' + "<?php echo $titre; ?>" +
                                    '&direction=' + "<?php echo $direction ?>" +
                                    '&sommation_table=' + "<?php echo $sommation; ?>",
                            success: function (data) {
                                $("#zone_show_table").html(data);
                            }
                        });
                    } else {
                        bootbox.dialog({
                            message: "Veuillez saisir les formules pour tout les colonnes à calculer !",
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
                } else {
                    bootbox.dialog({
                        message: "Veuillez choisir la Sommation pour, au moins, une colonne !",
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
            } else {
                bootbox.dialog({
                    message: "Veuillez choisir une seule colonne pour le total du tableau !",
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
        } else {
            bootbox.dialog({
                message: "Veuillez saisir les noms de tout les colonnes !",
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

    function checkValidSommation() {
        var nbre_sommation = 0;
        $('input[name="sommation"]').each(function () {
            if ($(this).is(":checked"))
                nbre_sommation++;
        });
        return nbre_sommation;
    }

    function verifColonne() {
        var valide = true;
        $('input[name="colonne"]').each(function () {
            if ($(this).val() == '')
                valide = false;
        });
        return valide;
    }

    function verifTotal() {
        var total = 0;
        $('input[name="c_total"]').each(function () {
            if ($(this).is(":checked"))
                total++;
        });
        return total;
    }

    function saveTableDefinition() {
        if (verifColonne()) {
            if (verifTotal() == 1) {
                var valid_sommation = 1;
<?php if ($sommation != "false"): ?>
                    valid_sommation = checkValidSommation();
<?php endif; ?>
                if (valid_sommation > 0) {
                    var count_nature_calcule = 0;
                    var count_calcule = 0;

                    var rang = '';
                    $('input[name="rang"]').each(function () {
                        rang = rang + $(this).val() + ',';
                    });
                    var colonne = '';
                    $('input[name="colonne"]').each(function () {
                        colonne = colonne + $(this).val() + ';;';
                    });
                    var type_colonne = '';
                    $('select[name="type"]').each(function () {
                        type_colonne = type_colonne + $(this).val() + ',';
                    });
                    var nature = '';
                    $('select[name="nature"]').each(function () {
                        nature = nature + $(this).val() + ',';
                        if ($(this).val() == "calcule")
                            count_nature_calcule++;
                    });
                    var formule = '';
                    $('input[name="formule"]').each(function () {
                        formule = formule + $(this).val() + ',';
                        if ($(this).val() != "")
                            count_calcule++;
                    });
                    formule = formule.replace(/\+/gi, "$");
                    var sommation = '';
                    $('input[name="sommation"]').each(function () {
                        sommation = sommation + $(this).is(":checked") + ',';
                    });
                    var total = '';
                    $('input[name="c_total"]').each(function () {
                        total = total + $(this).is(":checked") + ',';
                    });
                    if (count_nature_calcule == count_calcule) {
                        $.ajax({
                            url: '<?php echo url_for('annexebudget/saveTable') ?>',
                            data: 'rang=' + rang +
                                    '&colonne=' + colonne +
                                    '&type_colonne=' + type_colonne +
                                    '&nature=' + nature +
                                    '&formule=' + formule +
                                    '&sommation=' + sommation +
                                    '&total=' + total +
                                    '&id=' + $("#annexe_id").val() +
                                    '&titre=' + "<?php echo $titre; ?>" +
                                    '&direction=' + "<?php echo $direction ?>" +
                                    '&sommation_table=' + "<?php echo $sommation; ?>" +
                                    '&nbr=' + $("#nbr_colonne").val(),
                            success: function (data) {
                                window.location.reload();
                            }
                        });
                    } else {
                        bootbox.dialog({
                            message: "Veuillez saisir les formules pour tout les colonnes à calculer !",
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
                } else {
                    bootbox.dialog({
                        message: "Veuillez choisir la Sommation pour, au moins, une colonne !",
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
            } else {
                bootbox.dialog({
                    message: "Veuillez choisir une seule colonne pour le total du tableau !",
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
        } else {
            bootbox.dialog({
                message: "Veuillez saisir les noms de tout les colonnes !",
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

</script>

<style>

    .uppercase_input{text-transform: uppercase;}

</style>