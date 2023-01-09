<div class="col-xs-12">
    <div class="table-header" style="margin-bottom: 0px;">
        Situation des Engagements Budgétaires - <?php echo date('Y') ?> : 
        <a target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;" href="<?php echo url_for("titrebudjet/imprimerSituationEngagement?mois=" . $mois . '&annee=' . $annee . '&titre=' . $titre); ?>">
            <i class="ace-icon fa fa-print bigger-110"></i>
            <span class="bigger-110 no-text-shadow">Imprimer</span>
        </a>
    </div>
    <table id="liste_recap" class="table table-bordered table-hover">
        <thead>
            <tr style="text-align: center;">
                <th style="width: 20%;">Rubriques</th>
                <th style="width: 8%;text-align: center;">Crédits Alloués</th>
                <th style="width: 8%;text-align: center;">Engagements Antérieurs</th>
                <th style="width: 8%;text-align: center;">Engagements du Mois</th>
                <th style="width: 8%;text-align: center;">Engagements Cumulés</th>
                <th style="width: 8%;text-align: center;">Reliquats à Engager</th>
                <th style="width: 8%;text-align: center;">Paiements Antérieurs</th>
                <th style="width: 8%;text-align: center;">Paiements du Mois</th>
                <th style="width: 8%;text-align: center;">Paiements Cumulés</th>
                <th style="width: 8%;text-align: center;">Engagements à Payer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $mnt_alloue = 0;
            $mnt_engage_anterieur = 0;
            $mnt_engage_courant = 0;
            $mnt_engage_cumule = 0;
            $relica_engage = 0;
            $mnt_paiement_anterieur = 0;
            $mnt_paiement_courant = 0;
            $mnt_paiement_cumule = 0;
            $mnt_engage_payer = 0;

            $date_antecedent = $annee . '-' . $mois . '-01';
            $date_fin = date('Y-m-t', strtotime($annee . '-' . $mois . '-01'));
            ?>
            <?php foreach ($listes as $liste): ?>
                <?php $montant_ordonnance_antecedent = DocumentbudgetTable::getInstance()->getMontantAntecedantByLigprotitrub($date_antecedent, $liste->getId()); ?>
                <?php $montant_ordonnance_courant = DocumentbudgetTable::getInstance()->getMontantCourantByLigprotitrub($date_antecedent, $date_fin, $liste->getId()); ?>
                <?php $montant_paiement_anterieur = LigprotitrubTable::getInstance()->getMontantPaiementAnterieurByLigprotitrub($date_antecedent, $liste->getId()); ?>
                <?php $montant_paiement_courant = LigprotitrubTable::getInstance()->getMontantPaiementCourantByLigprotitrub($date_antecedent, $date_fin, $liste->getId()); ?>
                <tr>
                    <td><b style="color: #0066cc;"><?php echo $liste->getNordre(); ?> : </b> <?php echo $liste->getRubrique(); ?></td>
                    <td style="text-align: right; font-size: 11px; background-color: #dff0d8;"><?php echo number_format($liste->getMnt() + $liste->getMntexterne(), 3, '.', ' '); ?></td>
                    <td style="text-align: right; font-size: 11px;"><?php echo number_format($montant_ordonnance_antecedent->getMnt(), 3, '.', ' '); ?></td>
                    <td style="text-align: right; font-size: 11px;"><?php echo number_format($montant_ordonnance_courant->getMnt(), 3, '.', ' '); ?></td>
                    <td style="text-align: right; font-size: 11px; background-color: #d9edf7;"><?php echo number_format($montant_ordonnance_antecedent->getMnt() + $montant_ordonnance_courant->getMnt(), 3, '.', ' '); ?></td>
                    <td style="text-align: right; font-size: 11px; background-color: #fdffd5;"><?php echo number_format(($liste->getMnt() + $liste->getMntexterne()) - ($montant_ordonnance_antecedent->getMnt() + $montant_ordonnance_courant->getMnt()), 3, '.', ' '); ?></td>
                    <td style="text-align: right; font-size: 11px;"><?php echo number_format($montant_paiement_anterieur->getMnt(), 3, '.', ' '); ?></td>
                    <td style="text-align: right; font-size: 11px;"><?php echo number_format($montant_paiement_courant->getMnt(), 3, '.', ' '); ?></td>
                    <td style="text-align: right; font-size: 11px; background-color: #fcf8e3;"><?php echo number_format($montant_paiement_anterieur->getMnt() + $montant_paiement_courant->getMnt(), 3, '.', ' '); ?></td>
                    <td style="text-align: right; font-size: 11px; background-color: #f2dede;"><?php echo number_format($montant_ordonnance_antecedent->getMnt() + $montant_ordonnance_courant->getMnt() - ($montant_paiement_anterieur->getMnt() + $montant_paiement_courant->getMnt()), 3, '.', ' ') ?></td>
                </tr>
                <?php
                $mnt_alloue = $mnt_alloue + $liste->getMnt() + $liste->getMntexterne();
                $mnt_engage_anterieur = $mnt_engage_anterieur + $montant_ordonnance_antecedent->getMnt();
                $mnt_engage_courant = $mnt_engage_courant + $montant_ordonnance_courant->getMnt();
                $mnt_engage_cumule = $mnt_engage_cumule + $montant_ordonnance_antecedent->getMnt() + $montant_ordonnance_courant->getMnt();
                $relica_engage = $relica_engage + ($liste->getMnt() + $liste->getMntexterne()) - ($montant_ordonnance_antecedent->getMnt() + $montant_ordonnance_courant->getMnt());
                $mnt_paiement_anterieur = $mnt_paiement_anterieur + $montant_paiement_anterieur->getMnt();
                $mnt_paiement_courant = $mnt_paiement_courant + $montant_paiement_courant->getMnt();
                $mnt_paiement_cumule = $mnt_paiement_cumule + $montant_paiement_anterieur->getMnt() + $montant_paiement_courant->getMnt();
                $mnt_engage_payer = $mnt_engage_payer + $montant_ordonnance_antecedent->getMnt() + $montant_ordonnance_courant->getMnt() - ($montant_paiement_anterieur->getMnt() + $montant_paiement_courant->getMnt());
                ?>
            <?php endforeach; ?>
            <tr style="font-size: 14px; background-color: #EEE;">
                <td style="text-align: center;">Total</td>
                <td style="text-align: right; font-size: 11px; background-color: #dff0d8;"><?php echo number_format($mnt_alloue, 3, '.', ' '); ?></td>
                <td style="text-align: right; font-size: 11px;"><?php echo number_format($mnt_engage_anterieur, 3, '.', ' '); ?></td>
                <td style="text-align: right; font-size: 11px;"><?php echo number_format($mnt_engage_courant, 3, '.', ' '); ?></td>
                <td style="text-align: right; font-size: 11px; background-color: #d9edf7;"><?php echo number_format($mnt_engage_cumule, 3, '.', ' '); ?></td>
                <td style="text-align: right; font-size: 11px; background-color: #fdffd5;"><?php echo number_format($relica_engage, 3, '.', ' '); ?></td>
                <td style="text-align: right; font-size: 11px;"><?php echo number_format($mnt_paiement_anterieur, 3, '.', ' '); ?></td>
                <td style="text-align: right; font-size: 11px;"><?php echo number_format($mnt_paiement_courant, 3, '.', ' '); ?></td>
                <td style="text-align: right; font-size: 11px; background-color: #fcf8e3;"><?php echo number_format($mnt_paiement_cumule, 3, '.', ' '); ?></td>
                <td style="text-align: right; font-size: 11px; background-color: #f2dede;"><?php echo number_format($mnt_engage_payer, 3, '.', ' '); ?></td>
            </tr>
        </tbody>
    </table>
</div>