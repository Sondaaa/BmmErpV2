<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset): ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>
    <div class="col-lg-2">
        <div>
            <legend>Rapport</legend>
            <table>
                <tr>
                    <td>Année :
                        <div class="content">
                            <input type="text" value="<?php if (!$form->isNew()): ?><?php echo $fraisgeneraux->getAnnee(); ?><?php else: ?><?php echo $_SESSION['exercice']; ?><?php endif; ?>" name="annee" id="annee">
                            <input type="hidden" id="id_rapport" value="<?php echo $fraisgeneraux->getId(); ?>">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-lg-5">
        <div>
            <legend>Charges</legend>
            <table>
                <tr>
                    <td style="width: 80%;">Ajouter les comptes comptables des charges :
                        <?php $comptes = PlandossiercomptableTable::getInstance()->getFilsByExerciceAndByCompte($_SESSION['exercice_id'], '6'); ?>
                        <select id="charge_id">
                            <option value=""></option>
                            <?php foreach ($comptes as $compte): ?>
                                <option id="c_<?php echo $compte->getId(); ?>" numero="<?php echo $compte->getNumerocompte(); ?>" libelle="<?php echo $compte->getLibelle(); ?>" value="<?php echo $compte->getId(); ?>"><?php echo $compte->getNumerocompte() . ' - ' . $compte->getLibelle(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td style="width: 20%; vertical-align: bottom; text-align: center;">
                        <button onclick="ajouterCharge()" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-arrow-down"></i> Ajouter</button>
                    </td>
                </tr>
            </table>
            <table id="liste_charge">
                <thead>
                    <tr style="font-weight: bold;">
                        <td style="width: 10%; text-align: center;">Compte</td>
                        <td style="width: 80%;">Libellé</td>
                        <td style="width: 10%; text-align: center;">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $charge_lignes = LignefraisgenerauxTable::getInstance()->getByRapportAndType($fraisgeneraux->getId(), '6'); ?>
                    <?php foreach ($charge_lignes as $ligne): ?>
                        <tr id="tr_<?php echo $ligne->getId(); ?>">
                            <td style="text-align: center; background-color: #e6ffe3;"><?php echo $ligne->getPlandossiercomptable()->getNumerocompte(); ?></td>
                            <td style="text-align: justify;"><?php echo $ligne->getPlandossiercomptable()->getLibelle(); ?></td>
                            <td style="display: none;"><input type="hidden" save="1" name="id_charge" id="hc_<?php echo $ligne->getId(); ?>" value="<?php echo $ligne->getIdPlandossiercomptable(); ?>" /></td>
                            <td style="text-align: center; vertical-align:middle;"><button class="btn btn-xs btn-danger" onclick="suprimerBaseCharge('<?php echo $fraisgeneraux->getId(); ?>', '<?php echo $ligne->getId(); ?>')"><i class="ace-icon fa fa-trash"></i></button></td>
                        </tr>
                    <script  type="text/javascript">
                        $("#c_<?php echo $ligne->getIdPlandossiercomptable(); ?>").css("display", "none");
                        $("#charge_id").val('').trigger("liszt:updated");
                        $("#charge_id").trigger("chosen:updated");
                    </script>
                <?php endforeach; ?>
                </tbody>
            </table>
            <hr style="margin-bottom: 5px;">
            <label style="color: #c83737; font-weight: bold;">* ajouter au moins un compte comptable pour les charges.</label>
        </div>
    </div>
    <div class="col-lg-5">
        <div>
            <legend>Produits</legend>
            <table>
                <tr>
                    <td style="width: 80%;">Ajouter les comptes comptables des produits :
                        <?php $comptes = PlandossiercomptableTable::getInstance()->getFilsByExerciceAndByCompte($_SESSION['exercice_id'], '7'); ?>
                        <select id="produit_id">
                            <option value=""></option>
                            <?php foreach ($comptes as $compte): ?>
                                <option id="p_<?php echo $compte->getId(); ?>" numero="<?php echo $compte->getNumerocompte(); ?>" libelle="<?php echo $compte->getLibelle(); ?>" value="<?php echo $compte->getId(); ?>"><?php echo $compte->getNumerocompte() . ' - ' . $compte->getLibelle(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td style="width: 20%; vertical-align: bottom; text-align: center;">
                        <button onclick="ajouterProduit()" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-arrow-down"></i> Ajouter</button>
                    </td>
                </tr>
            </table>
            <table id="liste_produit">
                <thead>
                    <tr style="font-weight: bold;">
                        <td style="width: 10%; text-align: center;">Compte</td>
                        <td style="width: 80%;">Libellé</td>
                        <td style="width: 10%; text-align: center;">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $produit_lignes = LignefraisgenerauxTable::getInstance()->getByRapportAndType($fraisgeneraux->getId(), '7'); ?>
                    <?php foreach ($produit_lignes as $ligne): ?>
                        <tr id="tr_<?php echo $ligne->getId(); ?>">
                            <td style="text-align: center; background-color: #e6ffe3;"><?php echo $ligne->getPlandossiercomptable()->getNumerocompte(); ?></td>
                            <td style="text-align: justify;"><?php echo $ligne->getPlandossiercomptable()->getLibelle(); ?></td>
                            <td style="display: none;"><input type="hidden" save="1" name="id_produit" id="hp_<?php echo $ligne->getId(); ?>" value="<?php echo $ligne->getIdPlandossiercomptable(); ?>" /></td>
                            <td style="text-align: center;vertical-align:middle;"><button class="btn btn-xs btn-danger" onclick="suprimerBaseProduit('<?php echo $fraisgeneraux->getId(); ?>', '<?php echo $ligne->getId(); ?>')"><i class="ace-icon fa fa-trash"></i></button></td>
                        </tr>
                    <script  type="text/javascript">
                        $("#p_<?php echo $ligne->getIdPlandossiercomptable(); ?>").css("display", "none");
                        $("#produit_id").val('').trigger("liszt:updated");
                        $("#produit_id").trigger("chosen:updated");
                    </script>
                <?php endforeach; ?>
                </tbody>
            </table>
            <hr style="margin-bottom: 5px;">
            <label style="color: #c83737; font-weight: bold;">* ajouter au moins un compte comptable pour les produits.</label>
        </div>
    </div>
</fieldset>

<input type="hidden" id="compteur_compte" value="0" />

<script  type="text/javascript">

    $("#annee").mask('9999');
<?php if (!$form->isNew()): ?>
    <?php if ($charge_lignes->count() != 0): ?>
            $("#compteur_compte").val('<?php echo $charge_lignes->getLast()->getId() + 1 ?>');
    <?php endif; ?>
    <?php if ($produit_lignes->count() != 0): ?>
            $("#compteur_compte").val('<?php echo $produit_lignes->getLast()->getId() + 1 ?>');
    <?php endif; ?>
<?php endif; ?>

    function ajouterCharge() {
        if ($("#charge_id").val() != '') {
            var id = parseInt($('#compteur_compte').val());
            var tr_html = '<tr id="tr_' + id + '">';
            tr_html = tr_html + '<td style="text-align: center;">' + $("#charge_id option:selected").attr("numero") + '</td>';
            tr_html = tr_html + '<td style="text-align: justify;">' + $("#charge_id option:selected").attr("libelle") + '</td>';
            tr_html = tr_html + '<td style="display: none;"><input type="hidden" save="0" name="id_charge" id="hc_' + id + '" value="' + $("#charge_id").val() + '" /></td>';
            tr_html = tr_html + '<td style="text-align: center;vertical-align:middle;"><button class="btn btn-xs btn-danger" onclick="suprimerCharge(' + id + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
            tr_html = tr_html + '</tr>';
            $("#liste_charge tbody").append(tr_html);

            id++;
            $('#compteur_compte').val(id);
            $("#c_" + $("#charge_id").val()).css("display", "none");
            $("#charge_id").val('').trigger("liszt:updated");
            $("#charge_id").trigger("chosen:updated");
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

    function suprimerCharge(id) {
        $("#c_" + $("#hc_" + id).val()).css("display", "block");
        $("#tr_" + id).remove();
        $("#charge_id").val('').trigger("liszt:updated");
        $("#charge_id").trigger("chosen:updated");
    }

    function ajouterProduit() {
        if ($("#produit_id").val() != '') {
            var id = parseInt($('#compteur_compte').val());
            var tr_html = '<tr id="tr_' + id + '">';
            tr_html = tr_html + '<td style="text-align: center;">' + $("#produit_id option:selected").attr("numero") + '</td>';
            tr_html = tr_html + '<td style="text-align: justify;">' + $("#produit_id option:selected").attr("libelle") + '</td>';
            tr_html = tr_html + '<td style="display: none;"><input type="hidden" save="0" name="id_produit" id="hp_' + id + '" value="' + $("#produit_id").val() + '" /></td>';
            tr_html = tr_html + '<td style="text-align: center;vertical-align:middle;"><button class="btn btn-xs btn-danger" onclick="suprimerProduit(' + id + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
            tr_html = tr_html + '</tr>';
            $("#liste_produit tbody").append(tr_html);

            id++;
            $('#compteur_compte').val(id);
            $("#p_" + $("#produit_id").val()).css("display", "none");
            $("#produit_id").val('').trigger("liszt:updated");
            $("#produit_id").trigger("chosen:updated");
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

    function suprimerProduit(id) {
        $("#p_" + $("#hp_" + id).val()).css("display", "block");
        $("#tr_" + id).remove();
        $("#produit_id").val('').trigger("liszt:updated");
        $("#produit_id").trigger("chosen:updated");
    }

    function enregistrer() {
        if ($("#annee").val() != '' && $("#liste_charge tbody tr").length != 0 && $("#liste_produit tbody tr").length != 0) {
            var charges_ids = '';
            $('[name="id_charge"]').each(function () {
                if ($(this).attr("save") == "0")
                    charges_ids = charges_ids + $(this).val() + ',';
            });
            var produit_ids = '';
            $('[name="id_produit"]').each(function () {
                if ($(this).attr("save") == "0")
                    produit_ids = produit_ids + $(this).val() + ',';
            });
            $.ajax({
                url: '<?php echo url_for('fraisgeneraux/enregistrer') ?>',
                data: 'annee=' + $("#annee").val() +
                        '&id=' + $("#id_rapport").val() +
                        '&charges_ids=' + charges_ids +
                        '&produit_ids=' + produit_ids,
                success: function (data) {
                    bootbox.dialog({
                        message: "Rapport ajoutée avec succès !",
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
        } else {
            bootbox.dialog({
                message: "Veuillez vérifier l'année, les comptes comptables des charges et/ou des produits !",
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

    function suprimerBaseCharge(id, id_ligne) {
        $.ajax({
            url: '<?php echo url_for('fraisgeneraux/deleteLigne') ?>',
            data: 'id=' + id +
                    '&id_ligne=' + id_ligne +
                    '&type=' + 'charge',
            success: function (data) {
                suprimerCharge(id_ligne);
            }
        });
    }

    function suprimerBaseProduit(id, id_ligne) {
        $.ajax({
            url: '<?php echo url_for('fraisgeneraux/deleteLigne') ?>',
            data: 'id=' + id +
                    '&id_ligne=' + id_ligne +
                    '&type=' + 'produit',
            success: function (data) {
                suprimerProduit(id_ligne);
            }
        });
    }

</script>