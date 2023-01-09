<div class="mws-panel grid_8">
    <div class="mws-panel-body no-padding">
        <form class="mws-form">
            <div class="mws-form-inline" style="min-height: 250px;">
                <div class="mws-panel-header"><h3>Paramétrage des Compte Comptables</h3></div>
                <table>
                    <tr>
                        <td style="width: 65%">Compte Comptable :</td>
                        <td colspan="2">Type Compte Comptable :</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" value="" name="ligne_compte" id="compte_id" onfocus="chargerCompte('#compte_id', '#hidden_compte_id', '#compte_libelle')" onkeyup="chargerCompte('#compte_id', '#hidden_compte_id', '#compte_libelle')"/>
                            <input type="hidden" value="" name="hidden_ligne_compte" id="hidden_compte_id" />
                        </td>
                        <td style="width: 25%;">
                            <select id="type_compte_id">
                                <option value="-1"></option>
                                <?php foreach ($type_comptes as $type_compte): ?>
                                    <option value="<?php echo $type_compte->getId() ?>"> <?php echo $type_compte->getLibelle() ?> </option>
                                <?php endforeach; ?>
                            </select>
                            </div>
                        </td>
                        <td style="width: 10%; text-align: center;">
                            <a class="btn btn-xs btn-primary" onclick="saveTypeCompeBilan()"><i class="ace-icon fa fa-save"></i> Enregistrer</a>
                        </td>
                    </tr>
                </table>

                <div class="mws-panel-body no-padding">
                    <table class="mws-table" id="liste_ligne" style="font-weight: bold;">
                        <thead>
                            <tr>
                                <th style="width: 5%; text-align: center;">#</th>
                                <th style="width: 55%; text-align: center;">Compte Comptable</th>
                                <th style="width: 30%; text-align: center;">Type Compte Comptable</th>
                                <th style="width: 10%; text-align: center;">Opération</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th><input type="text" id="compte" onkeyup="goPage(1);" /></th>
                                <th><input id="type" onkeyup="goPage(1);" type="text" class="align-center" /></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot id="list_bilan_pager"></tfoot>
                        <tbody id="liste_type_bilan">
                            <?php include_partial("fiche_Bilan/liste_bilan", array("pager" => $pager, "page" => $page)) ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>

<script  type="text/javascript">

    function saveTypeCompeBilan() {
        if (verifierForm()) {
            $.ajax({
                url: '<?php echo url_for('fiche_Bilan/VerifierExistanceBilan') ?>',
                data: 'compte_id=' + $('#hidden_compte_id').val(),
                success: function (data) {
                    if (data != '0') {
                        $('#bilanexiste').bPopup();
                        return false;
                    }
                    else
                    {
                        $.ajax({
                            url: '<?php echo url_for('fiche_Bilan/saveParametreTypeCompte') ?>',
                            data: 'compte_id=' + $('#hidden_compte_id').val() +
                                    '&type_compte_id=' + $('#type_compte_id').val(),
                            success: function (data) {
                                $('#liste_type_bilan').html(data);
                                $("table.mws-table tbody tr:even").addClass("even");
                                $("table.mws-table tbody tr:odd").addClass("odd");
                            }
                        });
                    }
                }
            });
        }
    }

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('fiche_Bilan/goPageParametreTypeCompte') ?>',
            data: 'page=' + page +
                    '&compte=' + $('#compte').val() +
                    '&type=' + $('#type').val(),
            success: function (data) {
                $('#liste_type_bilan').html(data);
                $("table.mws-table tbody tr:even").addClass("even");
                $("table.mws-table tbody tr:odd").addClass("odd");
            }
        });
    }

    function verifierForm() {
        var valide = true;
        if ($('#hidden_compte_id').val() != '')
            $('#compte_id').css('border', '');
        else {
            $('#compte_id').css('border', '1px solid red');
            valide = false;
        }

        if ($('#type_compte_id').val() != '-1')
            $('#type_compte_id_chosen').css('border', '');
        else {
            $('#type_compte_id_chosen').css('border', '1px solid red');
            $('#type_compte_id_chosen').css('border-radius', '2px');
            valide = false;
        }

        return valide;
    }

    function deleteBilan(id) {
        $.ajax({
            url: '<?php echo url_for('fiche_Bilan/deleteParametreTypeCompte') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#liste_type_bilan').html(data);
                $("table.mws-table tbody tr:even").addClass("even");
                $("table.mws-table tbody tr:odd").addClass("odd");
            }
        });
    }

</script>