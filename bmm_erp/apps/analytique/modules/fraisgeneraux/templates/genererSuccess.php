<div id="sf_admin_container">
    <h1 id="replacediv"> Frais Généraux 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Générer les Soldes - <?php echo $rapport->getAnnee(); ?>
        </small>
    </h1>
    <div class="panel-body" style="padding: 0px;">
        <div class="col-md-12">
            <table>
                <tr>
                    <td style="width: 10%;">Année
                        <input type="text" class="align-center" readonly="true" value="<?php echo $rapport->getAnnee(); ?>" />
                        <input type="hidden" id="rapport_id" value="<?php echo $rapport->getId(); ?>" />
                    </td>
                    <td style="width: 20%;">Date Création (Génération)
                        <input type="text" class="align-center" readonly="true" value="<?php echo date('d/m/Y', strtotime($rapport->getAnnee())); ?>" />
                    </td>
                    <td style="width: 24%;">Solde Charges
                        <input type="text" class="align_right" readonly="true" value="<?php echo number_format($rapport->getMontantcharge(), 3, '.', ' '); ?>" />
                    </td>
                    <td style="width: 24%;">Solde Produit
                        <input type="text" class="align_right" readonly="true" value="<?php echo number_format($rapport->getMontantproduit(), 3, '.', ' '); ?>" />
                    </td>
                    <td style="width: 22%;">Solde
                        <input type="text" class="align_right" readonly="true" value="<?php echo number_format($rapport->getMontant(), 3, '.', ' '); ?>" />
                    </td>
                </tr>
            </table>
            <table>
                <thead>
                    <tr>
                        <th style="text-align: center;">Compte</th>
                        <th>Libellé</th>
                        <th style="text-align: center;">
                            <button class="btn btn-xs btn-white btn-success" style="font-weight: bold;" onclick="chargerSolde('<?php echo $rapport->getId(); ?>')">
                                <i class="ace-icon fa fa-download"></i> Solde Balance (S*)
                            </button>
                        </th>
                        <th style="text-align: center;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $charge_lignes = LignefraisgenerauxTable::getInstance()->getByRapportAndType($rapport->getId(), '6'); ?>
                    <?php foreach ($charge_lignes as $ligne): ?>
                        <tr>
                            <td style="text-align: center; width: 7%;"><?php echo $ligne->getPlandossiercomptable()->getNumerocompte(); ?></td>
                            <td style="width: 63%;"><?php echo $ligne->getPlandossiercomptable()->getLibelle(); ?></td>
                            <td style="text-align: right; width: 15%;">
                                <input class="align_right" id="l_<?php echo $ligne->getId(); ?>" name="ligne_compte" ligne="<?php echo $ligne->getId(); ?>" type="text" readonly="true" value="<?php echo number_format($ligne->getMontant(), 3, '.', ' '); ?>">
                            </td>
                            <td style="width: 15%;"></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr style="background-color: #F0F0F0;">
                        <td colspan="3">TOTAL CHARGES</td>
                        <td>
                            <input class="align_right" id="charge_rapport" type="text" readonly="true" value="<?php echo number_format($rapport->getMontantcharge(), 3, '.', ' '); ?>">
                        </td>
                    </tr>
                    <?php $produit_lignes = LignefraisgenerauxTable::getInstance()->getByRapportAndType($rapport->getId(), '7'); ?>
                    <?php foreach ($produit_lignes as $ligne): ?>
                        <tr>
                            <td style="text-align: center; width: 8%;"><?php echo $ligne->getPlandossiercomptable()->getNumerocompte(); ?></td>
                            <td style="width: 62%;"><?php echo $ligne->getPlandossiercomptable()->getLibelle(); ?></td>
                            <td style="text-align: right; width: 15%;">
                                <input class="align_right" id="l_<?php echo $ligne->getId(); ?>" name="ligne_compte" ligne="<?php echo $ligne->getId(); ?>" type="text" readonly="true" value="<?php echo number_format($ligne->getMontant(), 3, '.', ' '); ?>">
                            </td>
                            <td style="width: 15%;"></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr style="background-color: #F0F0F0;">
                        <td colspan="3">TOTAL PRODUITS</td>
                        <td>
                            <input class="align_right" id="produit_rapport" type="text" readonly="true" value="<?php echo number_format($rapport->getMontantproduit(), 3, '.', ' '); ?>">
                        </td>
                    </tr>
                    <tr style="background-color: #D0D0D0;">
                        <td colspan="3">CHARGES A REPARTIR</td>
                        <td>
                            <input class="align_right" id="montant_rapport" type="text" readonly="true" value="<?php echo number_format($rapport->getMontant(), 3, '.', ' '); ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr style="margin-bottom: 5px;">
            <div class="col-md-6">
                <label style="color: #3784c8; font-weight: bold;">S* : Source : balance des comptes comptables.</label>
            </div>
            <div class="col-md-6">
                <a style="float: right;" href="<?php echo url_for('@fraisgeneraux') ?>" class="btn btn-white btn-success">Retour à la Liste</a>
                <button id="save_button" style="float: right; margin-right: 10px; display: none;" onclick="enregistrer('<?php echo $rapport->getId(); ?>')" class="btn btn-white btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<div id="zone_generation" style="display: none;"></div>

<script  type="text/javascript">

    function chargerSolde(id) {
        $.ajax({
            url: '<?php echo url_for('fraisgeneraux/generationSolde') ?>',
            data: 'id=' + id,
            success: function (data) {
                $("#zone_generation").html(data);
            }
        });
    }

    function enregistrer(id) {
        var ligne_ids = '';
        var montants = '';
        $('[name="ligne_compte"]').each(function () {
            montants = montants + $(this).val() + ';';
            ligne_ids = ligne_ids + $(this).attr("ligne") + ',';
        });

        $.ajax({
            url: '<?php echo url_for('fraisgeneraux/enregistrerGeneration') ?>',
            data: 'id=' + id +
                    '&montants=' + montants +
                    '&ligne_ids=' + ligne_ids +
                    '&charge_rapport=' + $("#charge_rapport").val() +
                    '&produit_rapport=' + $("#produit_rapport").val() +
                    '&montant_rapport=' + $("#montant_rapport").val(),
            success: function (data) {
                bootbox.dialog({
                    message: "Rapport des frais généraux enregistré avec succès !",
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
    }

</script>