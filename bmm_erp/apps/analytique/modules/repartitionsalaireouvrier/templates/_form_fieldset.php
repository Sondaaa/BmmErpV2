<div class="panel-body" style="padding-bottom: 0px;">
    <div class="row">
        <fieldset id="sf_fieldset_none">
            <legend>Répartition des Salaires Ouvriers</legend>
            <table style="width: 250px;">
                <tr>
                    <td>Année</td>
                    <td>
                        <input type="text" id="annee" value="<?php if (!$form->isNew()): ?><?php echo $repartitionsalaireouvrier->getAnnee(); ?><?php endif; ?>">
                        <input type="hidden" id="id_repartition" value="<?php if (!$form->isNew()): ?><?php echo $repartitionsalaireouvrier->getId(); ?><?php endif; ?>" />
                    </td>
                </tr>
            </table>
            <div class="col-md-5">
                <legend>Comptes Comptables</legend>
                <table>
                    <tr>
                        <td style="width: 31%;">Compte Comptable</td>
                        <td style="width: 50%;">
                            <input type="text" value="" id="compte_libelle" onfocus="chargerCompte('#compte_libelle', '#compte_id')" onkeyup="chargerCompte('#compte_libelle', '#compte_id')"/>
                            <input type="hidden" value="" id="compte_id" />
                        </td>
                        <td style="width: 19%;">
                            <button class="btn btn-xs btn-primary" onclick="ajouterCompte()"><i class="ace-icon fa fa-arrow-down"></i> Ajouter</button>
                        </td>
                    </tr>
                </table>
                <table id="liste_compte">
                    <thead>
                        <tr>
                            <th style="width: 90%;">Compte Comptable</th>
                            <th style="width: 10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$form->isNew()): ?>
                            <?php $repartition_comptes = $repartitionsalaireouvrier->getCompterepartitionsalaireouvrier(); ?>
                            <?php foreach ($repartition_comptes as $repartition_compte): ?>
                                <tr id="base_tr_<?php echo $repartition_compte->getId(); ?>" style="background-color: #F7F7F7;">
                                    <td><?php echo $repartition_compte->getPlancomptable(); ?></td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-xs btn-danger" onclick="deleteCompte('<?php echo $repartition_compte->getId(); ?>')">
                                            <i class="ace-icon fa fa-trash"></i>
                                        </button>
                                        <hr style="margin-top: 3px; margin-bottom: 0px; border-top: 2px solid #b33232;">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <legend style="margin-bottom: 10px;"></legend>
                <label style="color: #c83737; font-weight: bold;">* ajouter au moins un compte comptable.</label>
            </div>
            <div class="col-md-7">
                <legend>Chantiers (par projet)</legend>
                <table>
                    <tr>
                        <td>Chantier</td>
                        <td>
                            <input id="chantier_libelle" type="text" value="" />
                        </td>
                        <td>Projet</td>
                        <td>
                            <?php $projets = ProjetTable::getInstance()->findAll(); ?>
                            <select id="projet_id">
                                <option value="0"></option>
                                <?php foreach ($projets as $projet): ?>
                                    <option value="<?php echo $projet->getId(); ?>"><?php echo trim($projet); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-xs btn-primary" onclick="ajouterChantier()"><i class="ace-icon fa fa-arrow-down"></i> Ajouter</button>
                        </td>
                    </tr>
                </table>
                <table id="liste_chantier">
                    <thead>
                        <tr>
                            <th style="width: 52%;">Chantier</th>
                            <th style="width: 40%;">Projet</th>
                            <th style="width: 8%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$form->isNew()): ?>
                            <?php $repartition_chantiers = $repartitionsalaireouvrier->getChantierrepartitionsalaireouvrier(); ?>
                            <?php foreach ($repartition_chantiers as $repartition_chantier): ?>
                                <tr id="base_chantier_tr_<?php echo $repartition_chantier->getId(); ?>" style="background-color: #F7F7F7;">
                                    <td><?php echo $repartition_chantier->getLibelle(); ?></td>
                                    <td><?php echo $repartition_chantier->getProjet(); ?></td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-xs btn-danger" onclick="deleteChantier('<?php echo $repartition_chantier->getId(); ?>')">
                                            <i class="ace-icon fa fa-trash"></i>
                                        </button>
                                        <hr style="margin-top: 3px; margin-bottom: 0px; border-top: 2px solid #b33232;">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <legend style="margin-bottom: 10px;"></legend>
                <label style="color: #c83737; font-weight: bold;">* ajouter au moins un chantier.</label>
            </div>
        </fieldset>
    </div>
</div>
<input id="compteur" type="hidden" value="0">

<script  type="text/javascript">
    
    $("#annee").mask('9999');
    
    function ajouterChantier() {
        if ($("#chantier_libelle").val() != '' && $("#projet_id").val() != '0') {
            var id = parseInt($('#compteur').val());
            var tr_html = '<tr id="tr_' + id + '">';
            tr_html = tr_html + '<td>' + $("#chantier_libelle").val() + '</td>';
            tr_html = tr_html + '<td>' + $("#projet_id option:selected").text() + '</td>';
            tr_html = tr_html + '<td style="display: none;"><input type="hidden" name="projet_chantier" value="' + $("#projet_id").val() + '" /><input type="hidden" name="libelle_chantier" value="' + $("#chantier_libelle").val() + '" /></td>';
            tr_html = tr_html + '<td style="text-align: center;"><button class="btn btn-xs btn-danger" onclick="suprimerChantier(' + id + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
            tr_html = tr_html + '</tr>';
            $("#liste_chantier tbody").append(tr_html);
            id++;
            $('#compteur').val(id);
            $("#chantier_libelle").val('');
            $("#projet_id").val('0').trigger("liszt:updated");
            $("#projet_id").trigger("chosen:updated");
        } else {
            bootbox.dialog({
                message: "Veuillez vérifier le nom du chantier et/ou le projet !",
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

    function suprimerChantier(id) {
        $("#tr_" + id).remove();
    }

    function ajouterCompte() {
        if ($("#compte_libelle").val() != '' && $("#compte_id").val() != '') {
            var id = parseInt($('#compteur').val());
            var tr_html = '<tr id="tr_' + id + '">';
            tr_html = tr_html + '<td>' + $("#compte_libelle").val() + '</td>';
            tr_html = tr_html + '<td style="display: none;"><input type="hidden" name="ligne_compte_id" value="' + $("#compte_id").val() + '" /></td>';
            tr_html = tr_html + '<td style="text-align: center;"><button class="btn btn-xs btn-danger" onclick="suprimerCompte(' + id + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
            tr_html = tr_html + '</tr>';
            $("#liste_compte tbody").append(tr_html);
            id++;
            $('#compteur').val(id);
            $("#compte_libelle").val('');
            $("#compte_id").val('');
        } else {
            bootbox.dialog({
                message: "Veuillez choisir un compte comptable !",
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

    function suprimerCompte(id) {
        $("#tr_" + id).remove();
    }
    
    function enregistrer() {
        if ($("#annee").val() != '' && $("#liste_chantier tbody tr").length != 0 && $("#liste_compte tbody tr").length != 0) {
            var compte_ids = '';
            $('[name="ligne_compte_id"]').each(function () {
                compte_ids = compte_ids + $(this).val() + ',';
            });
            var libelles = '';
            $('[name="libelle_chantier"]').each(function () {
                libelles = libelles + $(this).val() + ',**,';
            });
            var projet_ids = '';
            $('[name="projet_chantier"]').each(function () {
                projet_ids = projet_ids + $(this).val() + ',';
            });
            $.ajax({
                url: '<?php echo url_for('repartitionsalaireouvrier/enregistrer') ?>',
                data: 'annee=' + $("#annee").val() +
                        '&id=' + $("#id_repartition").val() +
                        '&compte_ids=' + compte_ids +
                        '&libelles=' + libelles +
                        '&projet_ids=' + projet_ids,
                success: function (data) {
                    $('#annee').val('');
                    $('#compteur').val('0');
                    $('#liste_compte tbody').html('');
                    $('#liste_chantier tbody').html('');
                    bootbox.dialog({
                        message: "Répartition ajoutée avec succès !",
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
            });
        } else {
            bootbox.dialog({
                message: "Veuillez vérifier l'année, les comptes comptables et/ou les chantiers !",
                buttons:
                        {
                            "button":
                                    {
                                        "label": "Ok",
                                        "className": "btn-sm"
                                    }}
            });
        }
    }

    function deleteCompte(id) {
        bootbox.confirm({
            message: "Ce compte comptable sera supprimé d'une façon permanente de la base de données, voulez-vous continuer ?",
            buttons: {
                cancel: {
                    label: "Non",
                    className: "btn-sm",
                },
                confirm: {
                    label: "Oui",
                    className: "btn-primary btn-sm",
                }
            },
            callback: function (result) {
                if (result) {
                    goDeleteCompte(id);
                }
            }
        });
    }

    function goDeleteCompte(id) {
        $.ajax({
            url: '<?php echo url_for('repartitionsalaireouvrier/deleteCompte') ?>',
            data: 'id=' + id,
            success: function (data) {
                $("#base_tr_" + id).remove();
            }
        });
    }

    function deleteChantier(id) {
        bootbox.confirm({
            message: "Ce chantier sera supprimé d'une façon permanente de la base de données, voulez-vous continuer ?",
            buttons: {
                cancel: {
                    label: "Non",
                    className: "btn-sm",
                },
                confirm: {
                    label: "Oui",
                    className: "btn-primary btn-sm",
                }
            },
            callback: function (result) {
                if (result) {
                    goDeleteChantier(id);
                }
            }
        });
    }
    
    function goDeleteChantier(id) {
        $.ajax({
            url: '<?php echo url_for('repartitionsalaireouvrier/deleteChantier') ?>',
            data: 'id=' + id,
            success: function (data) {
                $("#base_chantier_tr_" + id).remove();
            }
        });
    }

</script>

<script  type="text/javascript">
    var table = '';
    function chargerCompte(id1, id2) {
        if ($(id1).val() != '') {
            $.ajax({
                url: '<?php echo url_for('repartitionsalaireouvrier/Compteparnumero') ?>',
                data: 'numero=' + $(id1).val(), success: function (data) {
                    var data = JSON.parse(data);
                    $(".testul ul").css('width', $(id2).width());
                    htmlins = '';
                    table = data;
                    $(".testul").remove();
                    if (data.length > 0) {
                        htmlins = '<div class="testul">' +
                                '<ul id="ul_compte" style="z-index: 9;">';
                        for (i = 0; i < data.length; i++) {
                            if (i == 0)
                                htmlins += '<li class="selected_li" data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" onclick="clickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\')">' + data[i].name + '</li>';
                            else
                                htmlins += '<li data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" onclick="clickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\')">' + data[i].name + '</li>';
                        }
                        htmlins += '</ul></div>';
                    }
                    $(id1).after(htmlins);
                }
            });
        } else {
            $(id2).val('');
        }
    }

    function clickSelectElement(value2, id1, id2) {
        var valeu1 = "";
        for (i = 0; i < table.length; i++) {
            if (value2 - table[i].id === 0) {
                valeu1 = table[i].name;
                break;
            }
        }
        if (id1)
            $(id1).val(valeu1);
        if (id2)
            $(id2).val(value2);
        $(".testul").remove();
    }

</script>

<style>

    .selected_li{
        background-color:#3875d7;background-image:-webkit-gradient(linear,50% 0,50% 100%,color-stop(20%,#3875d7),color-stop(90%,#2a62bc));background-image:-webkit-linear-gradient(#3875d7 20%,#2a62bc 90%);background-image:-moz-linear-gradient(#3875d7 20%,#2a62bc 90%);background-image:-o-linear-gradient(#3875d7 20%,#2a62bc 90%);background-image:linear-gradient(#3875d7 20%,#2a62bc 90%);color:#fff
    }

</style>