<table class="table table-bordered table-hover" style="width: 100%;">
    <tr>
        <td style="vertical-align: middle; font-weight: bold; width: 35%;">Rubrique Budgétaire : 
            <select id="rubrique" onchange="getSousRubrique()">
                <option value="0"></option>
                <?php foreach ($rubriques as $rubrique): ?>
                    <option rubrique="<?php echo $rubrique->getIdRubrique() ?>" value="<?php echo $rubrique->getId() ?>"><?php echo $rubrique->getNordre() . ' : ' . $rubrique->getRubrique()->getLibelle(); ?></option>
                <?php endforeach; ?>
            </select>
        </td>
        <td style="vertical-align: middle; font-weight: bold; width: 35%;">Sous Rubrique Budgétaire : 
            <select id="sous_rubrique">

            </select>
        </td>
        <td colspan="2" style="vertical-align: middle; font-weight: bold;">Bon Commande :
            <select id="document_achat">
                <option value="0"></option>
                <?php foreach ($documents as $document): ?>
                    <option value="<?php echo $document->getId(); ?>"><?php echo $document; ?></option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="vertical-align: middle; font-weight: bold; width: 70%;">Description :
            <input id="description" type="text" value="" style="width: 100%;"/>
        </td>
        <td style="vertical-align: middle; font-weight: bold; width: 15%;">Montant<br>
            <input id="montant" class="align_right" type="text" value="" style="width: 100%;" />
        </td>
        <td style="vertical-align: middle; text-align: center; width: 15%;">
            <button onclick="ajouter()" class="btn btn-sm btn-primary">
                <span class="bigger-110 no-text-shadow">Ajouter</span>
            </button>
        </td>
    </tr>
</table>

<table id="liste_engagement" class="table table-bordered table-hover" style="width: 100%;">
    <thead>
        <tr>
            <th style="width: 8%;">Date Création</th>
            <th style="width: 21%;">Rubrique Budgétaire</th>
            <th style="width: 21%;">Sous Rubrique Budgétaire</th>
            <th style="width: 10%;">Document Achat</th>
            <th style="width: 6%;">Année</th>
            <th style="width: 20%;">Description</th>
            <th style="width: 8%;">Montant</th>
            <th style="width: 5%;"></th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        <?php if ($engagements->count() != 0): ?>
            <?php foreach ($engagements as $engagement): ?>
                <tr>
                    <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($engagement->getDate())); ?></td>
                    <?php if ($engagement->getLigprotitrub()->getRubrique()->getIdRubrique() != null): ?>
                        <?php $ligprotitrub = LigprotitrubTable::getInstance()->findOneByIdTitreAndIdRubrique($engagement->getIdTitre(), $engagement->getLigprotitrub()->getRubrique()->getIdRubrique()); ?>
                        <td><?php echo $ligprotitrub->getNordre() . ' : ' . $ligprotitrub->getRubrique(); ?></td>
                        <td><?php echo $engagement->getLigprotitrub()->getNordre() . ' : ' . $engagement->getLigprotitrub()->getRubrique()->getLibelle(); ?></td>
                    <?php else: ?>
                        <td><?php echo $engagement->getLigprotitrub()->getNordre() . ' : ' . $engagement->getLigprotitrub()->getRubrique(); ?></td>
                        <td></td>
                    <?php endif; ?>
                    <td><?php if ($engagement->getIdDocachat() != null) echo $engagement->getDocumentachat(); ?></td>
                    <td style="text-align: center;"><?php echo $engagement->getAnnee(); ?></td>
                    <td><?php echo $engagement->getDescription(); ?></td>
                    <td style="text-align: right;"><?php echo number_format($engagement->getMontant(), 3, '.', ' '); ?></td>
                    <td style="text-align: center;">
                        <button class="btn btn-xs btn-danger" onclick="deleteEngagement('<?php echo $engagement->getId(); ?>')"><i class="ace-icon fa fa-trash"></i></button>  
                    </td>
                </tr>
                <?php $total = $total + $engagement->getMontant(); ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8" style="text-align: center; font-weight: bold; height: 30px;"> Pas d'engagement(s) antécédent(s)</td>
            </tr>
        <?php endif; ?>
        <tr style="background-color: #F4F4F4;">
            <td colspan="6" style="text-align: right; font-weight: bold;">Total </td>
            <td style="text-align: right; font-weight: bold;"><?php echo number_format($total, 3, '.', ' '); ?></td>
            <td></td>
        </tr>
    </tbody>
</table>

<script  type="text/javascript">
    
    $('#form_ajout select').attr('class', "chosen-select form-control");
    $('#form_ajout select').attr('style', 'width: 100%;');

    $('#form_ajout .chosen-select').chosen({allow_single_deselect: true});

    function getSousRubrique() {
        $("#sous_rubrique").empty();
        if ($("#rubrique").val() != "0") {
            $.ajax({
                url: '<?php echo url_for('titrebudjet/getSousRubrique') ?>',
                data: 'rubrique_id=' + $('#rubrique option:selected').attr('rubrique') +
                        '&titre_id=' + $("#titre").val(),
                success: function (data) {
                    $('#sous_rubrique').html(data);
                    $("#sous_rubrique").val('').trigger("liszt:updated");
                    $("#sous_rubrique").trigger("chosen:updated");
                }
            });
        } else {
            $("#sous_rubrique").val('').trigger("liszt:updated");
            $("#sous_rubrique").trigger("chosen:updated");
        }
    }

    function ajouter() {
        if ($("#rubrique").val() != "0" && $("#description").val() != "" && $("#montant").val() != "" && $("#annee").val() != "") {
            $.ajax({
                url: '<?php echo url_for('titrebudjet/saveEngagementAntecedent') ?>',
                data: 'rubrique_id=' + $('#rubrique').val() +
                        '&id_sous_rubrique=' + $("#sous_rubrique").val() +
                        '&description=' + $("#description").val() +
                        '&montant=' + $("#montant").val() +
                        '&id_document_achat=' + $("#document_achat").val() +
                        '&titre_id=' + $("#titre").val() +
                        '&annee=' + $("#annee").val(),
                success: function (data) {
                    $("#form_ajout").html('');
                }
            });
        } else {
            bootbox.dialog({
                message: "<span class='bigger-160' style='margin:20px;color:#b31515;'>Veuillez choisir le budget et/ou Saisir la description, le montant du document et/ou l'année !</span>",
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

    function deleteEngagement(id) {
        bootbox.confirm({
            message: "Voulez-vous supprimer cet engagement ?",
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
                    goDeleteEngagement(id);
                }
            }
        });
    }

    function goDeleteEngagement(id) {
        $.ajax({
            url: '<?php echo url_for('titrebudjet/deleteEngagementAntecedent') ?>',
            data: 'id=' + id +
                    '&titre_id=' + $("#titre").val() +
                    '&annee=' + $("#annee").val(),
            success: function (data) {
                $("#liste_engagement tbody").html(data);
            }
        });
    }

</script>