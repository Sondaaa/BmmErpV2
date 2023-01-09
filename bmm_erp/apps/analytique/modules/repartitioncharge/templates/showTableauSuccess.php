<div id="sf_admin_container">
    <h1 id="replacediv"> Répartition des Charges 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Répartition des Charges par Unité
        </small>
    </h1>
    <?php $charge_directe = FraisgenerauxTable::getInstance()->findOneByAnnee($repartition->getAnnee()); ?>
    <div class="panel-body" style="padding: 0px;">
        <legend>Répartition des Charges par Unité - <?php echo $repartition->getAnnee(); ?></legend>
        <div class="col-md-5">
            <table>
                <tr>
                    <td style="width: 20%;">Année
                        <input type="text" class="align-center" readonly="true" value="<?php echo $repartition->getAnnee(); ?>" />
                        <input type="hidden" id="repartition_id" value="<?php echo $repartition->getId(); ?>" />
                    </td>
                    <td style="width: 40%;">Total Montants
                        <input type="text" id="montant_repartition" class="align_right" readonly="true" value="<?php echo number_format($repartition->getMontant(), 3, '.', ' '); ?>" />
                    </td>
                    <td style="width: 40%;">Total Fraix Généraux
                        <input type="text" id="montant_repartition" class="align_right" readonly="true" value="<?php echo number_format($charge_directe->getMontant(), 3, '.', ' '); ?>" />
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-2" style="color: #ca383b; font-size: 14px;">Informations :</div>
        <div class="col-md-7">
            <ul class="ul_point">
                <li>Le coefficient choisi pour la répartition des frais généraux est le jours MOD</li>
                <li>Frais Généraux = Total Fraix Généraux X Coefficient</li>
                <li>Total = MOD + Intrants + Mécanisation - Frais Généraux</li>
            </ul>
        </div>

        <div class="col-md-12">
            <table>
                <thead>
                    <tr>
                        <th style="width: 16%;">Unité</th>
                        <th style="width: 7%; text-align: center;">Jour MOD</th>
                        <th style="width: 7%; text-align: center;">Coefficient</th>
                        <th style="width: 10%; text-align: center;">MOD</th>
                        <th style="width: 10%; text-align: center;">Intrants</th>
                        <th style="width: 10%; text-align: center;">Mécanisation</th>
                        <th style="width: 10%; text-align: center;">Frais Généraux</th>
                        <th style="width: 10%; text-align: center;">Total</th>
                        <th style="width: 15%; text-align: center;">Comptes Appropriés</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $lignes = LigneuniterepartitionTable::getInstance()->getByRepartition($repartition->getId()); ?>
                    <?php foreach ($lignes as $ligne): ?>
                        <tr>
                            <td><?php echo $ligne->getUniterepartitioncharge()->getLibelle(); ?></td>
                            <td style="text-align: right; background-color: #ffefef;"><?php echo $ligne->getJourmod(); ?></td>
                            <td style="text-align: center;"><?php echo $ligne->getCoefficient(); ?> %</td>
                            <td style="text-align: right; background-color: #e9f0ff;"><?php echo number_format($ligne->getMontantmod(), 3, '.', ' '); ?></td>
                            <td style="text-align: right; background-color: #e9fbe1;"><?php echo number_format($ligne->getIntrant(), 3, '.', ' '); ?></td>
                            <td style="text-align: right; background-color: #fffbe5;"><?php echo number_format($ligne->getMecanisation(), 3, '.', ' '); ?></td>
                            <td style="text-align: right;"><?php echo number_format($ligne->getFraisgeneraux(), 3, '.', ' '); ?></td>
                            <td style="text-align: right;"><?php echo number_format($ligne->getTotal(), 3, '.', ' '); ?></td>
                            <td>
                                <input name="compte" type="text" value="<?php echo $ligne->getCompteapproprie(); ?>">
                                <input name="ligne_id" type="hidden" value="<?php echo $ligne->getId(); ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr style="background-color: #F0F0F0;">
                        <td>TOTAL</td>
                        <td style="text-align: right; background-color: #ffefef;"><?php echo $repartition->getJour(); ?></td>
                        <td style="text-align: center;">100 %</td>
                        <td style="text-align: right; background-color: #e9f0ff;"><?php echo number_format($repartition->getMain(), 3, '.', ' '); ?></td>
                        <td style="text-align: right; background-color: #e9fbe1;"><?php echo number_format($repartition->getIntrant(), 3, '.', ' '); ?></td>
                        <td style="text-align: right; background-color: #fffbe5;"><?php echo number_format($repartition->getMecanisation(), 3, '.', ' '); ?></td>
                        <td style="text-align: right;"><?php echo number_format($repartition->getMontant() - $charge_directe->getMontant(), 3, '.', ' '); ?></td>
                        <td style="text-align: right;"><?php echo number_format($charge_directe->getMontant(), 3, '.', ' '); ?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <a class="btn btn-white btn-success" href="<?php echo url_for('@repartitioncharge') ?>">Retour à la Liste</a>
            <a href="<?php echo url_for('repartitioncharge/imprimer?id=' . $repartition->getId()) ?>" target="_blank" class="btn btn-white btn-yellow" style="float: right;">Imprimer</a>
            <button onclick="valider()" class="btn btn-white btn-primary" style="float: right; margin-right: 1%;">Modifier Comptes Appropriés</button>
        </div>
    </div>
</div>

<script  type="text/javascript">

    function valider() {
        var ids = '';
        $('[name="ligne_id"]').each(function () {
            ids = ids + $(this).val() + ',';
        });

        var libelles = '';
        $('[name="compte"]').each(function () {
            libelles = libelles + $(this).val() + ';**;';
        });

        $.ajax({
            url: '<?php echo url_for('repartitioncharge/ajouterCompte') ?>',
            data: 'ids=' + ids +
                    '&libelles=' + libelles,
            success: function (data) {
                bootbox.dialog({
                    message: 'Comptes appropriés affectés avec succès',
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

<style>
    .ul_point{list-style: disc !important;}
</style>