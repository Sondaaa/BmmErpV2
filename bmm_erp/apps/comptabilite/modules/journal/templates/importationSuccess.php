<div id="sf_admin_container">
    <h1 id="replacediv"> Base Comptable 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Importer Journaux
        </small>
    </h1>
</div>

<div id="importantion_journal" class="row">
    <form id="frm_foire">
        <table>
            <tr>
                <td style="width: 43%;">
                    Dossier *:
                    <select id="dernier_dossier" onchange="getExerciceByDossierMenu()">
                        <?php foreach ($dossiers as $dossier): ?>
                            <?php if ($dossier->getArchive() == 0): ?>
                                <option  <?php if ($dossier->getId() == $_SESSION['dossier_id']): ?>  selected="true"  <?php endif; ?> value="<?php echo $dossier->getId(); ?>" ><?php echo $dossier->getCode() . ' - ' . $dossier->getRaisonsociale(); ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td style="width: 1%; background-color: #E0E0E0;"></td>
                <td style="width: 43%" class="disabledbutton">
                    Dossier *:
                    <select id="courant_dossier" onchange="resetForm()" >
                        <?php foreach ($dossiers as $dossier): ?>
                            <?php if ($dossier->getArchive() == 0): ?>
                                <option <?php if ($dossier->getId() == $_SESSION['dossier_id']): ?> selected="true"  <?php endif; ?>value="<?php echo $dossier->getId(); ?>" ><?php echo $dossier->getCode() . ' - ' . $dossier->getRaisonsociale(); ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td style="width: 13%; text-align: center; vertical-align: bottom;">
                    <a onclick="getJournalImporte()" class="btn btn-primary"><i class="ace-icon fa fa-search bigger-110"></i> Afficher</a>
                </td>
            </tr>
            <tr>
                <td>
                    Exercice *:
                    <select id="dernier_exercice" onchange="resetForm()">
                        <option value=""></option>
                        <?php foreach ($all_exercice as $exercice): ?>
                            <option <?php if ($exercice->getId() == $_SESSION['exercice_id']): ?>  selected="true"  <?php endif; ?> value="<?php echo $exercice->getId(); ?>"><?php echo $exercice->getLibelle(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td style="background-color: #E0E0E0;"></td>
                <td class="disabledbutton">
                    Exercice *:
                    <select id="courant_exercice" onchange="resetForm()">
                        <option value=""></option>
                        <?php $all_exercice = ExerciceTable::getInstance()->getAllByDossier($_SESSION['dossier_id']); ?>
                        <?php foreach ($all_exercice as $exercice): ?>

                            <option <?php if ($exercice->getId() == $_SESSION['exercice_id']): ?> selected="true"  <?php endif; ?> value="<?php echo $exercice->getId(); ?>"><?php echo $exercice->getLibelle(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td style="text-align: center; vertical-align: bottom;">
                    <a onclick="getJournalImporte()" class="btn btn-primary"><i class="ace-icon fa fa-undo bigger-110"></i> Annuler</a>
                </td>
            </tr>
            <tr>
                <td colspan="4" id="zone_journal">

                </td>
            </tr>
        </table>

        <table id="save_button" style="display: none;">
            <tr><td style="text-align: right;"><button class="btn btn-primary" onclick="saveImportation()"><i class="ace-icon fa fa-save bigger-110"></i> Enregistrer</button></td></tr>
        </table>
    </form>
</div>

<script  type="text/javascript">

    function resetForm() {
        $('#zone_journal').html('');
        $('#save_button').hide();
    }
     function getExerciceByDossierMenu() {
        if ($('#dernier_dossier').val() != '') {
            $.ajax({
                url: '<?php echo url_for('accueil/getExerciceByDossier'); ?>',
                data: 'dossier_id=' + $('#dernier_dossier').val(),
                success: function (data) {
                    $("#dernier_exercice").html(data);

                    $("#dernier_exercice").val('').trigger("liszt:updated");
                    $("#dernier_exercice").trigger("chosen:updated");
                }
            });
        }
    }

    function saveImportation() {
        if (champsObligatoires()) {

            var x = document.getElementById("pickList_journal");
            var journals = '';
            for (var i = 0; i < x.selectedOptions.length; i++) {
                journals = journals + x.selectedOptions[i].value + ',';
            }

            $.ajax({
                url: '<?php echo url_for('journal/saveImportation'); ?>',
                data: 'dernier_dossier=' + $('#dernier_dossier').val() +
                        '&courant_dossier=' + $('#courant_dossier').val() +
                        '&dernier_exercice=' + $('#dernier_exercice').val() +
                        '&courant_exercice=' + $('#courant_exercice').val() +
                        '&journals=' + journals,
                success: function (data) {
//                    location.href = '<?php // echo url_for('journal/importation') ?>';
                }
            });
        }
    }

    function getJournalImporte() {
        if (champsObligatoires()) {
            $.ajax({
                url: '<?php echo url_for('journal/getJournalDejaImporte') ?>',
                asynch: true,
                data: 'exercice_id=' + $('#courant_exercice').val() +
                        '&dossier_id=' + $('#courant_dossier').val() +
                        '&ex_exercice_id=' + $('#dernier_exercice').val() +
                        '&ex_dossier_id=' + $('#dernier_dossier').val(),
                success: function (data) {
                    $('#zone_journal').html(data);

                    var demo1 = $('select[id="pickList_journal"]').bootstrapDualListbox({infoTextFiltered: '<span class="label label-purple label-lg">Filtré</span>'});
                    var container1 = demo1.bootstrapDualListbox('getContainer');
                    container1.find('.btn').addClass('btn-white btn-info btn-bold');

                    $('#save_button').fadeIn();
                }
            });
        }
    }

    function champsObligatoires() {
        var valide = true;

        if ($('#dernier_exercice').val() !== '')
            $('#dernier_exercice_chosen').css('border', '');
        else {
            $('#dernier_exercice_chosen').css('border', '1px solid red');
            $('#dernier_exercice_chosen').css('border-radius', '2px');
            valide = false;
        }

        if ($('#courant_exercice').val() !== '')
            $('#courant_exercice_chosen').css('border', '');
        else {
            $('#courant_exercice_chosen').css('border', '1px solid red');
            $('#courant_exercice_chosen').css('border-radius', '2px');
            valide = false;
        }

        if ($('#dernier_exercice').val() == $('#courant_exercice').val() && $('#dernier_dossier').val() == $('#courant_dossier').val()) {
            $('#dernier_exercice_chosen').css('border', '1px solid red');
            $('#dernier_exercice_chosen').css('border-radius', '2px');
            $('#courant_exercice_chosen').css('border', '1px solid red');
            $('#courant_exercice_chosen').css('border-radius', '2px');
            valide = false;
        }

        if ($('#dernier_dossier').val() !== '')
            $('#dernier_dossier_chosen').css('border', '');
        else {
            $('#dernier_dossier_chosen').css('border', '1px solid red');
            $('#dernier_dossier_chosen').css('border-radius', '2px');
            valide = false;
        }

        if ($('#courant_dossier').val() !== '')
            $('#courant_dossier_chosen').css('border', '');
        else {
            $('#courant_dossier_chosen').css('border', '1px solid red');
            $('#courant_dossier_chosen').css('border-radius', '2px');
            valide = false;
        }

        return valide;
    }

</script>