<div class="mws-panel-body no-padding">
    <form class="mws-form">
        <div class="mws-form-inline" >
            <div class="mws-panel-header">
                <span>
                    Liste des Factures Import
                    <a class="btn" style="margin-left: 20px; cursor:pointer;" onclick="saveFacture()"><i class="icol-add"></i> Valider</a>
                </span>

            </div>
            
            <div class="mws-panel-body no-padding" style="margin-bottom: 15px;">
                <div style="height: 360px; overflow: auto;">
                    <table class="fancyTable" id="myTable02">
                        <thead>
                            <tr>
                                <th style="font-weight: bold; text-align: center;">#</th>
                                <th style="font-weight: bold; text-align: center;">Référence</th>
                                <th style="font-weight: bold; text-align: center;">Date</th>
                                <th style="font-weight: bold; text-align: left; padding-left: 1%;">Fournisseur</th>
                                <th style="font-weight: bold; text-align: center;">Montant HT</th>
                                <th style="font-weight: bold; text-align: center;">Montant TVA</th>
                                <th style="font-weight: bold; text-align: center;">Timbre</th>
                                <th style="font-weight: bold; text-align: center;">Montant TTC</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td colspan="8" style="height: 15px;"></td>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($factures as $facture): ?>
                                <tr class="ligne_compte" data_reference="<?php echo $facture->getReference(); ?>" data_date="<?php echo $facture->getDate(); ?>" check_input="check_input_<?php echo $facture->getId(); ?>">
                                    <td style="text-align: center;"><?php echo $i++; ?></td>
                                    <td style="text-align: center;"><b><?php echo $facture->getReference(); ?></b></td>
                                    <td style="text-align: center;"><?php echo $facture->getDate(); ?></td>
                                    <td><?php echo $facture->getFournisseur()->getRaisonSociale(); ?></td>
                                    <td style="text-align: center;"><?php echo $facture->getTotalHt(); ?></td>
                                    <td style="text-align: center;"><?php echo $facture->getTotalTva(); ?></td>
                                    <td style="text-align: center;"><?php echo $facture->getTimbre(); ?></td>
                                    <td style="text-align: center;"><?php echo $facture->getTotalTtc(); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>

<script  type="text/javascript">
     function saveFacture() {
        $.ajax({
            url: '<?php echo url_for('@saveFactureAchatImport') ?>',
            data: 'ids=<?php echo $ids; ?>&etranger=<?php echo $etranger; ?>&dossier='+ $('#dossier').val(),
            success: function(data) {
                afficher('wzd_zone_1');
            }
        });
    }
</script>