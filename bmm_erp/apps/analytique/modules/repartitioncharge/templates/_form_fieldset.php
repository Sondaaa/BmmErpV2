<?php
if (!$form->isNew()):
    $annee = $repartitioncharge->getAnnee();
else:
    $annee = $_SESSION['exercice'];
endif;
?>
<div class="panel-body" style="padding-bottom: 0px;">
    <div class="row">
        <fieldset id="sf_fieldset_none">
            <div class="col-md-3">
                <legend>Répartition des Charges</legend>
                <table style="width: 250px;">
                    <tr>
                        <td>Année</td>
                        <td>
                            <input type="text" readonly="true" id="annee" value="<?php echo $annee; ?>">
                            <input type="hidden" id="id_repartition" value="<?php if (!$form->isNew()): ?><?php echo $repartitioncharge->getId(); ?><?php endif; ?>" />
                        </td>
                    </tr>
                </table>
                <div style="color: #ca2a2a; margin-top: 35px;">Remarques : </div>
                <div style="margin-top: 10px; text-align: justify; font-weight: normal;">
                    Pour chaque unité, il faut choisir au moin un choix parmis les catégories d'unité <b>[Main d'œuvre, Intrant, Mécanisation]</b>.
                </div>
                <div style="margin-top: 10px; text-align: justify; font-weight: normal;">
                    On peut selectionner une ou plusieurs options dans chaque paramètre d'unité.
                </div>
                <hr>
            </div>
            <div class="col-md-9">
                <legend>Unité Répartition</legend>
                <table>
                    <tr>
                        <td style="width: 15%;">Unité <span class="required">*</span></td>
                        <td colspan="2" style="width: 50%;">
                            <input type="text" value="" id="unite_libelle"/>
                        </td>
                    </tr>
                    <tr style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                        <td colspan="3" style="text-align: center;">Paramètres</td>
                    </tr>
                    <tr>
                        <td>Main d'œuvre</td>
                        <td colspan="2">
                            <select id="main_id" multiple="true">
                                <?php $reapartition_salaire = RepartitionsalaireouvrierTable::getInstance()->findOneByAnnee($annee); ?>
                                <?php foreach ($reapartition_salaire->getChantierrepartitionsalaireouvrier() as $chantier): ?>
                                    <option value="<?php echo $chantier->getId(); ?>"><?php echo $chantier->getLibelle(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Intrant</td>
                        <td colspan="2">
                            <select id="intrant_id" multiple="true">
                                <?php $rapport_travaux = RapporttravauxTable::getInstance()->findByAnnee($annee); ?>
                                <?php foreach ($rapport_travaux as $rapport): ?>
                                    <?php if ($rapport->getIdType() != 2): ?>
                                        <option value="<?php echo $rapport->getId(); ?>"><?php echo $rapport->getLibelle() . ' ' . $rapport->getTyperapport()->getLibelle(); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Mécanisation</td>
                        <td colspan="2">
                            <select id="mecanisation_id" multiple="true">
                                <option value="mre">MRE</option>
                                <option value="dps">DPS</option>
                                <option value="maint">DTX MAINT</option>
                                <option value="bat">DTX BAT</option>
                                <option value="dts">DTS PLANT</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td style="width: 12%; text-align: center;">
                            <button class="btn btn-xs btn-primary" onclick="ajouterUnite()"><i class="ace-icon fa fa-arrow-down"></i> Ajouter</button>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12">
                <table id="liste_unite">
                    <thead>
                        <tr>
                            <th style="width: 26%;">Unité</th>
                            <th style="width: 20%;">Main d'œuvre</th>
                            <th style="width: 39%;">Intrant</th>
                            <th style="width: 10%;">Mécanisation</th>
                            <th style="width: 5%; text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $last_id_unite = 0; ?>
                        <?php if (!$form->isNew()): ?>
                            <?php $unites = UniterepartitionchargeTable::getInstance()->getByRepartition($repartitioncharge->getId()); ?>
                            <?php foreach ($unites as $unite): ?>
                                <?php $last_id_unite = $unite->getId(); ?>
                                <tr id="tr_<?php echo $unite->getId(); ?>">
                                    <td style="background-color: #e6ffe3;">
                                        <?php echo $unite->getLibelle(); ?>
                                        <input type="hidden" save="1" name="libelle_unite" value="<?php echo $unite->getLibelle(); ?>" />
                                    </td>
                                    <td>
                                        <ul class="ul_point">
                                            <?php $main_id = ''; ?>
                                            <?php foreach ($unite->getParametreuniterepartition() as $param): ?>
                                                <?php if ($param->getIdChantierrepartition() != null): ?>
                                                    <?php if ($main_id == ''): ?>
                                                        <?php $main_id = $param->getIdChantierrepartition(); ?>
                                                    <?php else: ?>
                                                        <?php $main_id = $main_id . ',' . $param->getIdChantierrepartition(); ?>
                                                    <?php endif; ?>
                                                    <li style="min-height:22px; text-align: justify;"><?php echo $param->getChantierrepartitionsalaireouvrier()->getLibelle(); ?></li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                        <input type="hidden" name="unite_main" save="1" value="<?php echo $main_id; ?>" />
                                    </td>
                                    <td>
                                        <ul class="ul_point">
                                            <?php $intrant_id = ''; ?>
                                            <?php foreach ($unite->getParametreuniterepartition() as $param): ?>
                                                <?php if ($param->getIdRapporttravaux() != null): ?>
                                                    <?php if ($intrant_id == ''): ?>
                                                        <?php $intrant_id = $param->getIdRapporttravaux(); ?>
                                                    <?php else: ?>
                                                        <?php $intrant_id = $intrant_id . ',' . $param->getIdRapporttravaux(); ?>
                                                    <?php endif; ?>
                                                    <li style="min-height:22px; text-align: justify;"><?php echo $param->getRapporttravaux()->getLibelle() . ' ' . $param->getRapporttravaux()->getTyperapport()->getLibelle(); ?></li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                        <input type="hidden" name="unite_intrant" save="1" value="<?php echo $intrant_id; ?>" />
                                    </td>
                                    <td>
                                        <ul class="ul_point">
                                            <?php $mecanisation_id = ''; ?>
                                            <?php foreach ($unite->getParametreuniterepartition() as $param): ?>
                                                <?php if ($param->getTypemecanisation() != null): ?>
                                                    <?php if ($mecanisation_id == ''): ?>
                                                        <?php $mecanisation_id = $param->getTypemecanisation(); ?>
                                                    <?php else: ?>
                                                        <?php $mecanisation_id = $mecanisation_id . ',' . $param->getTypemecanisation(); ?>
                                                    <?php endif; ?>
                                                    <li style="min-height:22px; text-align: justify;"><?php echo $param->getTypemecanisation(); ?></li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                        <input type="hidden" name="unite_mecanisation" save="1" value="<?php echo $mecanisation_id; ?>" />
                                    </td>
                                    <td style="text-align: center;"><button class="btn btn-xs btn-danger" onclick="suprimerBaseUnite('<?php echo $unite->getId(); ?>')"><i class="ace-icon fa fa-trash"></i></button></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <hr style="margin-bottom: 0px;">
            </div>
        </fieldset>
    </div>
</div>
<input type="hidden" id="compteur_unite" value="<?php echo $last_id_unite; ?>">

<script  type="text/javascript">

    $("#annee").mask('9999');

    function ajouterUnite() {
        if ($("#unite_libelle").val() != '' && ($("#main_id").val() != null || $("#intrant_id").val() != null || $("#mecanisation_id").val() != null)) {
            var selectedText_main = '<ul>';
            $('#main_id option:selected').each(function (i, value) {
                if (selectedText_main == '')
                    selectedText_main = '<li style="min-height:22px;">' + $(value).text() + '</li>';
                else
                    selectedText_main = selectedText_main + '<li style="min-height:22px;">' + $(value).text() + '</li>';
            });
            selectedText_main = selectedText_main + '</ul>';
            var selectedText_intrant = '<ul>';
            $('#intrant_id option:selected').each(function (i, value) {
                if (selectedText_intrant == '')
                    selectedText_intrant = '<li style="min-height:22px;">' + $(value).text() + '</li>';
                else
                    selectedText_intrant = selectedText_intrant + '<li style="min-height:22px;">' + $(value).text() + '</li>';
            });
            selectedText_intrant = selectedText_intrant + '</ul>';
            var selectedText_mecanisation = '<ul>';
            $('#mecanisation_id option:selected').each(function (i, value) {
                if (selectedText_mecanisation == '')
                    selectedText_mecanisation = '<li style="min-height:22px;">' + $(value).text() + '</li>';
                else
                    selectedText_mecanisation = selectedText_mecanisation + '<li style="min-height:22px;">' + $(value).text() + '</li>';
            });
            selectedText_mecanisation = selectedText_mecanisation + '</ul>';

            var id = parseInt($('#compteur_unite').val());
            var tr_html = '<tr id="tr_' + id + '">';
            tr_html = tr_html + '<td>' + $("#unite_libelle").val() + '<input type="hidden" save="0" name="libelle_unite" value="' + $("#unite_libelle").val() + '" /></td>';
            tr_html = tr_html + '<td>' + selectedText_main + '<input type="hidden" name="unite_main" save="0" value="' + $("#main_id").val() + '" /></td>';
            tr_html = tr_html + '<td>' + selectedText_intrant + '<input type="hidden" name="unite_intrant" save="0" value="' + $("#intrant_id").val() + '" /></td>';
            tr_html = tr_html + '<td>' + selectedText_mecanisation + '<input type="hidden" name="unite_mecanisation" save="0" value="' + $("#mecanisation_id").val() + '" /></td>';
            tr_html = tr_html + '<td style="text-align: center;"><button class="btn btn-xs btn-danger" onclick="suprimerUnite(' + id + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
            tr_html = tr_html + '</tr>';
            $("#liste_unite tbody").append(tr_html);
            id++;
            $('#compteur_unite').val(id);

            resetForm();
        } else {
            bootbox.dialog({
                message: "Veuillez vérifier l'unité et/ou les paramètres unité !",
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

    function suprimerUnite(id) {
        $("#tr_" + id).remove();
    }

    function resetForm() {
        $("#unite_libelle").val('');

        $("#main_id").val('').trigger("liszt:updated");
        $("#main_id").trigger("chosen:updated");

        $("#intrant_id").val('').trigger("liszt:updated");
        $("#intrant_id").trigger("chosen:updated");

        $("#mecanisation_id").val('').trigger("liszt:updated");
        $("#mecanisation_id").trigger("chosen:updated");
    }

    function enregistrer() {
        var libelles = '';
        $('[name="libelle_unite"]').each(function () {
            if ($(this).attr("save") == "0")
                libelles = libelles + $(this).val() + ',**,';
        });
        var main_ids = '';
        $('[name="unite_main"]').each(function () {
            if ($(this).attr("save") == "0")
                main_ids = main_ids + $(this).val() + ';';
        });
        var intrant_ids = '';
        $('[name="unite_intrant"]').each(function () {
            if ($(this).attr("save") == "0")
                intrant_ids = intrant_ids + $(this).val() + ';';
        });
        var mecanisation_ids = '';
        $('[name="unite_mecanisation"]').each(function () {
            if ($(this).attr("save") == "0")
                mecanisation_ids = mecanisation_ids + $(this).val() + ';';
        });

        $.ajax({
            url: '<?php echo url_for('repartitioncharge/enregistrer') ?>',
            data: 'id=' + $("#id_repartition").val() +
                    '&annee=' + $("#annee").val() +
                    '&libelles=' + libelles +
                    '&main_ids=' + main_ids +
                    '&intrant_ids=' + intrant_ids +
                    '&mecanisation_ids=' + mecanisation_ids,
            success: function (data) {
                bootbox.dialog({
                    message: "Répartition des charges ajoutée avec succès !",
                    buttons:
                            {
                                "button":
                                        {
                                            "label": "Ok",
                                            "className": "btn-sm"
                                        }
                            }
                });
                location.reload();
            }
        });
    }

    function suprimerBaseUnite(id) {
        $.ajax({
            url: '<?php echo url_for('repartitioncharge/deleteUnite') ?>',
            data: 'id=' + id,
            success: function (data) {
                suprimerUnite(id);
            }
        });
    }

</script>

<style>

    .ul_point{list-style: disc !important;}

</style>