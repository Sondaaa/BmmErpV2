<div id="sf_admin_container">
    <h1 id="replacediv"> Plan Comptable Client  
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Importer Paln Comptable à partir d'un dossier 
        </small>
    </h1>
</div>

<div id="importantion_plan" class="row" ng-controller="myCtrlPaysVille">
    <form id="frm_foire">
        <table>
            <tr>
                <td style="width: 43%;">
                    Dossier *:
                    <select id="dernier_dossier" onchange="resetForm()">
                        <?php foreach ($dossiers as $dossier): ?>
                            <?php if ($dossier->getArchive() == 0): ?>
                                <option <?php if ($dossier->getId() == $_SESSION['dossier_id']): ?>  selected="true"  <?php endif; ?> value="<?php echo $dossier->getId(); ?>" ><?php echo $dossier->getCode() . ' - ' . $dossier->getRaisonsociale(); ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td style="width: 1%; background-color: #E0E0E0;"></td>
                <td style="width: 43%" class="disabledbutton">
                    Dossier *:
                    <select id="courant_dossier" onchange="resetForm()">
                        <?php foreach ($dossiers as $dossier): ?>
                            <?php if ($dossier->getArchive() == 0): ?>
                                <option <?php if ($dossier->getId() == $_SESSION['dossier_id']): ?>  selected="true" <?php endif; ?>  value="<?php echo $dossier->getId(); ?>" ><?php echo $dossier->getCode() . ' - ' . $dossier->getRaisonsociale(); ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td style="width: 13%; text-align: center; vertical-align: bottom;">
                    <a onclick="getPlanImporte()" class="btn btn-primary"><i class="ace-icon fa fa-search bigger-110"></i> Afficher</a>
                </td>

            </tr>
            <tr style="display: none"><!--style="display: none"-->
                <td >
                    Exercice *:<input type="text" id="dernier_exercice" value="">
<!--                    <select id="dernier_exercice" onchange="resetForm()">
                        <option value=""></option>
                    <?php // foreach ($all_exercice as $exercice): ?>
                            <option value="<?php // echo $exercice->getId();  ?>"><?php // echo $exercice->getLibelle();  ?></option>
                    <?php // endforeach; ?>
                    </select>-->
                </td>
                <td style="background-color: #E0E0E0; " ></td>
                <td >
                    Exercice *:<input type="text" id="courant_exercice" value="">
<!--                    <select id="courant_exercice" onchange="resetForm()">
                        <option value=""></option>
                    <?php // foreach ($all_exercice as $exercice): ?>
                            <option value="<?php // echo $exercice->getId();  ?>"><?php // echo $exercice->getLibelle();  ?></option>
                    <?php // endforeach; ?>
                    </select>-->
                </td>
<!--                <td colspan="2"></td>-->
                <td style="text-align: center; vertical-align: bottom;">
                    <a onclick="getPlanImporte()" class="btn btn-primary"><i class="ace-icon fa fa-undo bigger-110"></i> Annuler</a>
                </td>
            </tr>
            <tr>
                <td colspan="4" id="zone_plan">

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
        $('#zone_plan').html('');
        $('#save_button').hide();

    }

    function saveImportation() {
        if (champsObligatoires()) {
            var x = document.getElementById("pickList_journal");
            var plancomptables = '';
            for (var i = 0; i < x.selectedOptions.length; i++) {
                plancomptables = plancomptables + x.selectedOptions[i].value + ',';
            }
            $.ajax({
                url: '<?php echo url_for('plan_comptable/saveImportation'); ?>',
                data: 'dernier_dossier=' + $('#dernier_dossier').val() +
                        '&courant_dossier=' + $('#courant_dossier').val() +
                        '&exercice_id=' + $('#courant_exercice').val() +
                        '&ex_exercice_id=' + $('#dernier_exercice').val() +
                        '&plancomptables=' + plancomptables,
                success: function (data) {

                    location.href = '<?php echo url_for('plan_comptable/importation')  ?>';
                }
            });
        }
    }

    function getPlanImporte() {
        if (champsObligatoires()) {
            $.ajax({
                url: '<?php echo url_for('plan_comptable/getPlanDejaImporte') ?>',
//                asynch: true,
                data: 'exercice_id=' + $('#courant_exercice').val() +
                        '&dossier_id=' + $('#courant_dossier').val() +
                        '&ex_exercice_id=' + $('#dernier_exercice').val() +
                        '&ex_dossier_id=' + $('#dernier_dossier').val(),
                success: function (data) {
                    $('#zone_plan').html(data);
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