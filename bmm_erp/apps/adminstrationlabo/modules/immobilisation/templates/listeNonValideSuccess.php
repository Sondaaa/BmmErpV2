<div id="sf_admin_container">
    <h1 id="replacediv"> Immobilisation
        <small><i class="ace-icon fa fa-angle-double-right"></i> Liste des Immobilisations à Valider</small>
    </h1>
</div>

<?php
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$query = "SELECT id, numero, designation, dateacquisition, mntttc"
        . " FROM immobilisation "
        . " WHERE (etat <> '1' or etat is null) "
        . " AND datemiseenrebut IS NULL "
        . " ORDER BY designation, numero";
$immobilisations = $conn->fetchAssoc($query);
?>

<legend>Liste des Immobilisations à Valider</legend>

<div class="row">
    <div class="col-sm-12">
        <table id="table_immobilisation">
            <thead>
                <tr>
                    <th style="width:5%;text-align:center;"><input id="check_all" type="checkbox" onclick="checkAll()"></th>
                    <th style="width:15%;text-align:center;"><b>Numéro</b></th>
                    <th style="width:50%;height:25px;text-align:center;"><b>Immobilisation</b></th>
                    <th style="width:10%;text-align:center;"><b>Date Acquisition</b></th>
                    <th style="width:10%;text-align:center;"><b>Prix Acquisition</b></th>
                    <th style="width:10%;text-align:center;"><b>Action</b></th>
                </tr>
            </thead>
            <tbody id="tblData">
                <?php if (sizeof($immobilisations) > 0): ?>
                    <?php for ($i = 0; $i < sizeof($immobilisations); $i++): ?>
                        <tr id="tr_<?php echo $immobilisations[$i]['id'] ?>">
                            <td style="text-align: center;"><input value="<?php echo $immobilisations[$i]['id'] ?>" class="sf_admin_batch_checkbox" name="check_immobilisation" id="check_<?php echo $immobilisations[$i]['id'] ?>" onclick="setTrColor('<?php echo $immobilisations[$i]['id'] ?>')" type="checkbox"></td>
                            <td style="text-align: center;"><?php echo $immobilisations[$i]['numero'] ?></td>
                            <td>
                                <a target="_blank" href="<?php echo url_for('Immob/show?id=' . $immobilisations[$i]['id']) ?>">
                                    <?php echo $immobilisations[$i]['designation'] ?>
                                </a>
                            </td>
                            <td style="text-align: center;"><?php if ($immobilisations[$i]['dateacquisition'] != null) echo date('d/m/Y', strtotime($immobilisations[$i]['dateacquisition'])); ?></td>
                            <td style="text-align: right;"><?php if ($immobilisations[$i]['mntttc'] != null) echo number_format($immobilisations[$i]['mntttc'], 3, '.', ' ') ?></td>
                            <td style="text-align: center;">
                                <button onclick="valider('<?php echo $immobilisations[$i]['id'] ?>')" class="btn btn-white btn-primary">Valider</button>
                            </td>
                        </tr>
                    <?php endfor; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; vertical-align: middle; height: 60px;">Pas d'immobilisation à valider !</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if (sizeof($immobilisations) > 0): ?>
        <div class="col-sm-12" style="text-align: right;">
            <button onclick="validerTous()" class="btn btn-white btn-primary">Valider la Selection</button>
        </div>
    <?php endif; ?>
</div>

<script>

    function checkAll(){
        var boxes = document.getElementsByTagName('input');
        for (var index = 0; index < boxes.length; index++) {
            box = boxes[index];
            if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox')
                box.checked = document.getElementById('check_all').checked
        }

        setColor();
        return true;
    }

    function valider(id) {
        $.ajax({
            url: '<?php echo url_for('immobilisation/validerImmobilisation') ?>',
            data: 'id=' + id,
            success: function (data) {
                $("#tr_" + id).remove();
                bootbox.dialog({
                    message: "Immobilisation validée !",
                    buttons: {
                        "success": {
                            "label": "OK",
                            "className": "btn-sm btn-primary"
                        }
                    }
                });
            }
        });
    }

    function validerTous() {
        var ids = '';
        $('input[name=check_immobilisation]').each(function () {
            if ($(this).is(":checked"))
                ids = ids + $(this).val() + ',';
        });

        $.ajax({
            url: '<?php echo url_for('immobilisation/validerListeImmobilisation') ?>',
            data: 'ids=' + ids,
            success: function (data) {
                $('input[name=check_immobilisation]').each(function () {
                    if ($(this).is(":checked"))
                        $("#tr_" + $(this).val()).remove();
                });
                bootbox.dialog({
                    message: "Immobilisation(s) validée(s) !",
                    buttons: {
                        "success": {
                            "label": "OK",
                            "className": "btn-sm btn-primary"
                        }
                    }
                });
            }
        });

    }

    function setColor() {
        $('input[name=check_immobilisation]').each(function () {
            if ($(this).is(":checked"))
                $("#tr_" + $(this).val()).css('background', '#F7F7F7');
            else
                $("#tr_" + $(this).val()).css('background', '');
        });
    }

    function setTrColor(id) {
        if ($("#check_" + id).is(":checked"))
            $("#tr_" + id).css('background', '#F7F7F7');
        else
            $("#tr_" + id).css('background', '');
    }

</script>