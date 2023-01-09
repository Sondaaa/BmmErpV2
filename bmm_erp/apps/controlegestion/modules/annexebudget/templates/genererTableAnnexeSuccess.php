<div class="col-md-12">
    <table>
        <thead>
            <tr>
                <th colspan="8" style="text-align: center; font-size: 16px; padding: 5px;">
                    <span style="float: left; color: #006ea6;">
                        <?php if ($direction == "gauche"): ?>
                            <i class="ace-icon fa fa-arrow-left"></i> Gauche
                        <?php else: ?>
                            Droite <i class="ace-icon fa fa-arrow-right"></i>
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
                <th style="width: 9%; text-align: center; <?php if ($sommation == "false"): ?>display: none;<?php endif; ?>">Sommation</th>
                <th style="width: 7%; text-align: center;">Total</th>
                <th style="width: 7%; text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody id="tbody_generate">
            <?php $letters = range('A', 'Z'); ?>
            <?php for ($i = 1; $i <= $nbr; $i++): ?>
                <tr id="tr_<?php echo $i; ?>">
                    <td><input type="text" class="align_center" name="rang" value="<?php echo $letters[$i - 1]; ?>" readonly="true"></td>
                    <td><input type="text" name="colonne" value="" <?php if ($direction != "left"): ?>class="align_right"<?php endif; ?>></td>
                    <td>
                        <select name="type" id="type_<?php echo $i; ?>" onchange="setDisabled('<?php echo $i; ?>')">
                            <option value="text">Texte</option>
                            <option value="date">Date</option>
                            <option value="montant">Montant</option>
                            <option value="quantite">Quantité</option>
                            <option value="taux">Taux</option>
                        </select>
                    </td>
                    <td>
                        <select name="nature" id="nature_<?php echo $i; ?>" onchange="setReadonly('<?php echo $i; ?>')">
                            <option value="saisie">Saisie</option>
                            <option value="calcule">Calcule</option>
                        </select>
                    </td>
                    <td style="text-align: center;"><input type="text" id="formule_<?php echo $i; ?>" name="formule" value="" class="uppercase_input" readonly="true"></td>
                    <td style="text-align: center; <?php if ($sommation == "false"): ?>display: none;<?php endif; ?>">
                        <input name="sommation" id="sommation_<?php echo $i; ?>" type="checkbox">
                    </td>
                    <td style="text-align: center;">
                        <input name="c_total" id="c_total_<?php echo $i; ?>" type="checkbox">
                    </td>
                    <td style="text-align: center;">
                        <span class="btn btn-xs btn-danger" onclick="removeRowEdit('<?php echo $i; ?>')"><i class="ace-icon fa fa-trash bigger-110 icon-only"></i></span>
                    </td>
                </tr>
            <?php endfor; ?>
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
            },
            update: function () {

            }
        });
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
        var letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
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

    $("table").addClass("table table-bordered table-hover");
    $('#zone_edit_table input:text').attr('style', 'width: 100%;');
    $('#zone_edit_table select').attr('class', "chosen-select form-control");
    $('#zone_edit_table select').attr('style', 'width: 100%;');
    $('#zone_edit_table .chosen-select').chosen({allow_single_deselect: true});

<?php for ($i = 1; $i <= $nbr; $i++): ?>
        $('#nature_<?php echo $i; ?>_chosen').addClass("disabledbutton");
<?php endfor; ?>

</script>

<style>

    .uppercase_input{text-transform: uppercase;}

</style>