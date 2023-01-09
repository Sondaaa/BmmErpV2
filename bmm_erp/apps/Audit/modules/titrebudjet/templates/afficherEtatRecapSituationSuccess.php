<div class="col-xs-12">
    <div class="table-header" style="margin-bottom: 0px;">
        SITUATION CUMULEE DU PROJET : 
        <a target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;" href="<?php echo url_for("titrebudjet/imprimerRecapSituation?min_mois=" . $min_mois . '&max_mois=' . $max_mois . '&titre=' . $titre. '&min_annee=' . $min_annee. '&max_annee=' . $max_annee); ?>">
            <i class="ace-icon fa fa-print bigger-110"></i>
            <span class="bigger-110 no-text-shadow">Imprimer</span>
        </a>
    </div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr style="text-align: center;">
                <th style="width: 52%;">Rubriques</th>
                <th style="width: 16%;text-align: center;">Engagements Cumulés</th>
                <th style="width: 16%;text-align: center;">Paiements Cumulés</th>
                <th style="width: 16%;text-align: center;">Engagements à Payer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $mnt_engagement = 0;
            $mnt_paiement = 0;
            ?>
            <?php for ($i = 0; $i < sizeof($liste); $i++): ?>
                <tr>
                    <td><?php echo $liste[$i]['rubrique']; ?></td>
                    <td style="text-align: right;"><?php echo number_format($liste[$i]['engagement'], 3, '.', ' '); ?></td>
                    <td style="text-align: right;"><?php echo number_format($liste[$i]['paiement'], 3, '.', ' '); ?></td>
                    <td style="text-align: right;"><?php echo number_format($liste[$i]['total'], 3, '.', ' '); ?></td>
                </tr>
                <?php
                $mnt_engagement = $mnt_engagement + $liste[$i]['engagement'];
                $mnt_paiement = $mnt_paiement + $liste[$i]['paiement'];
                ?>
            <?php endfor; ?>
            <tr style="font-size: 14px; background-color: #CDCDCD;">
                <td style="text-align: center;">Total Général</td>
                <td style="text-align: right;"><?php echo number_format($mnt_engagement, 3, '.', ' '); ?></td>
                <td style="text-align: right;"><?php echo number_format($mnt_paiement, 3, '.', ' '); ?></td>
                <td style="text-align: right;"><?php echo number_format($mnt_engagement - $mnt_paiement, 3, '.', ' '); ?></td>
            </tr>
        </tbody>
    </table>
</div>