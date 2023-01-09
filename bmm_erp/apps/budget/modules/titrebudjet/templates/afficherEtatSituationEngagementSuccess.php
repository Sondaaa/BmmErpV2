<div class="col-xs-12">
    <div class="table-header" style="margin-bottom: 0px;">
        Situation des Engagements Budgétaires - <?php echo date('Y'); ?> :
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
            $mnt_transfert_final = 0;
            $mnt_engage_anterieur = 0;
            $mnt_transfert_sous_liste = 0;
            $mnt_engage_courant = 0;
            $mnt_engage_cumule = 0;
            $relica_engage = 0;
            $mnt_paiement_anterieur = 0;
            $mnt_paiement_courant = 0;
            $mnt_paiement_courant_sous = 0;
            $mnt_paiement_cumule = 0;
            $mnt_engage_payer = 0;
            $mnt_courant_rub = 0;
            $mnt_courant_rub_sans = 0;
            $montant_paiement_anterieur_rub = 0;
            $montant_ordonnance_antecedent_rub = 0;
            $montant_ordonnance_antecedent_rub_sans_sous_liste = 0;
            $montant_paiement_courant_rubsousrubrique = 0;
            $montant_paiement_courant_rub = 0;
            $montant_paiement_courant_liste = 0;
            $montant_ordonnance_courant_rub = 0;
            
            $mnt_engage_payer_sous =0;
            $montant_ordonnance_courant_rub_sans_sous_liste = 0;
            if($mois>1)
            $mois_anterieur = $mois - 1;
            else 
            $mois_anterieur = $mois;
            if ($mois_anterieur < 10)
                $mois_anterieur = sprintf("%02d", $mois_anterieur);
            $date_antecedent = $annee . '-' . $mois_anterieur . '-31';
            $date_fin = date('Y-m-t', strtotime($annee . '-' . $mois . '-01'));
            ?>
            <?php foreach ($listes as $liste) : ?>

                <?php $sous_listes = LigprotitrubTable::getInstance()->getSousrubriqueByTitreBudget($titre, $liste->getIdRubrique()); ?>
                <?php foreach ($sous_listes as $sous_liste) : ?>
                    <?php
                    $mnt_transfert_sous_liste = $mnt_transfert_sous_liste + $sous_liste->getMntexterne() + $sous_liste->getMntretire();
                    $montant_ordonnance_courant_sous_liste = DocumentbudgetTable::getInstance()->getMontantCourantByLigprotitrub($date_antecedent, $date_fin, $sous_liste->getId());
                    $mnt_courant_rub = $mnt_courant_rub + $sous_liste->getMntEngage();
                    $montant_paiement_anterieur_sous_liste = LigprotitrubTable::getInstance()->getMontantPaiementAnterieurByLigprotitrub($date_antecedent, $sous_liste->getId());
                    $montant_paiement_anterieur_rub = $montant_paiement_anterieur_rub + $montant_paiement_anterieur_sous_liste->getMnt();
                    $montant_paiement_courant_sous_liste = LigprotitrubTable::getInstance()->getMontantPaiementCourantByLigprotitrub($date_antecedent, $date_fin, $sous_liste->getId());
                    $montant_paiement_courant_rub = $montant_paiement_courant_rub + $montant_paiement_courant_sous_liste->getMnt();
                    $montant_ordonnance_courant_rub = $montant_ordonnance_courant_rub + $montant_ordonnance_courant_sous_liste->getMnt();
                    $montant_ordonnance_antecedent_sous_liste = DocumentbudgetTable::getInstance()->getMontantAntecedantByLigprotitrub($date_antecedent, $sous_liste->getId());
                    $montant_ordonnance_antecedent_rub = $montant_ordonnance_antecedent_rub + $montant_ordonnance_antecedent_sous_liste->getMnt();
                    ?>
                    <?php
                endforeach;
                $mnt_transfert = $liste->getMntexterne() + $liste->getMntretire();
                if (count($sous_listes) == 0) {
                    $montant_ordonnance_antecedent_sous_liste_sans_sous = DocumentbudgetTable::getInstance()->getMontantAntecedantByLigprotitrub($date_antecedent, $liste->getId());
                    $montant_ordonnance_antecedent_rub_sans_sous_liste = $montant_ordonnance_antecedent_rub_sans_sous_liste + $montant_ordonnance_antecedent_sous_liste_sans_sous->getMnt();
                    $montant_ordonnance_courant_sans_sous_liste = DocumentbudgetTable::getInstance()->getMontantCourantByLigprotitrub($date_antecedent, $date_fin, $liste->getId());
                    $montant_ordonnance_courant_rub_sans_sous_liste = $montant_ordonnance_courant_rub + $montant_ordonnance_courant_sans_sous_liste->getMnt();
                    $mnt_courant_rub_sans = $mnt_courant_rub + $liste->getMntEngage();
                    $mnt_transfert_final = $mnt_transfert_sous_liste + $mnt_transfert;
                    $montant_paiement_courant_liste = LigprotitrubTable::getInstance()->getMontantPaiementCourantByLigprotitrub($date_antecedent, $date_fin, $liste->getId());
                    $montant_paiement_courant_rubsousrubrique = $montant_paiement_courant_rubsousrubrique + $montant_paiement_courant_liste->getMnt();
                } else {
                    $mnt_courant_rub_sans = $mnt_courant_rub;
                    $mnt_transfert_final = $mnt_transfert;
                    $montant_paiement_courant_rubsousrubrique = $montant_paiement_courant_rub;
                }
                ?>
                <?php
                $montant_ordonnance_antecedent = DocumentbudgetTable::getInstance()->getMontantAntecedantByLigprotitrub($date_antecedent, $liste->getId());
                $montant_ordonnance_courant = DocumentbudgetTable::getInstance()->getMontantCourantByLigprotitrub($date_antecedent, $date_fin, $liste->getId());
                $montant_ordonnance_courant_ruprique = DocumentbudgetTable::getInstance()->getMontantCourantRubriqueByLigprotitrub($date_antecedent, $date_fin, $liste->getId());
                $montant_paiement_anterieur = LigprotitrubTable::getInstance()->getMontantPaiementAnterieurByLigprotitrub($date_antecedent, $liste->getId());
                $montant_paiement_courant = LigprotitrubTable::getInstance()->getMontantPaiementCourantByLigprotitrub($date_antecedent, $date_fin, $liste->getId());
                ?>
                <?php
                if (count($sous_listes) != 0) {
                    $montant_ordonnance_antecedent = $montant_ordonnance_antecedent_rub;
                } else {
                    $montant_ordonnance_antecedent = $montant_ordonnance_antecedent->getMnt();
                }
                if (count($sous_listes) != 0) {
                    $montant_ordonnance_courant = $montant_ordonnance_courant_rub;
                } else {
                    $montant_ordonnance_courant = $montant_ordonnance_courant->getMnt();
                }
                ?>

                <tr>
                    <td><b style="color: #0066cc;"><?php echo $liste->getRubrique()->getCode(); ?> : <?php echo $liste->getRubrique()->getLibelle(); ?></b> </td>
                    <td style="text-align: right; font-size: 12px; background-color: #dff0d8;"><b><?php echo number_format($liste->getMnt() + $mnt_transfert_final, 3, '.', ' '); ?></b></td>
                    <td style="text-align: right; font-size: 12px;"><b><?php
                            echo number_format($montant_ordonnance_antecedent, 3, '.', ' ');
                            ?></b></td>
                    <td style="text-align: right; font-size: 12px;"><b><?php
                            echo number_format($montant_ordonnance_courant, 3, '.', ' ');
                            ?></b></td>
                    <td style="text-align: right; font-size: 12px; background-color: #d9edf7;"><b><?php
                            echo number_format($montant_ordonnance_antecedent + $montant_ordonnance_courant, 3, '.', ' ');
                            ?>
                        </b>
                    </td>
                    <td style="text-align: right; font-size: 12px; background-color: #fdffd5;"><b>
                            <?php
                            echo number_format(($liste->getMnt() + $mnt_transfert_final) - ($montant_ordonnance_antecedent + $montant_ordonnance_courant), 3, '.', ' ');
                            ?>
                        </b></td>
                    <td style="text-align: right; font-size: 12px;"><b><?php echo number_format($montant_paiement_anterieur_rub, 3, '.', ' '); ?></b></td>
                    <td style="text-align: right; font-size: 12px;"><b><?php echo number_format($montant_paiement_courant_rubsousrubrique, 3, '.', ' '); ?></b></td>
                    <td style="text-align: right; font-size: 12px; background-color: #fcf8e3;"><b><?php echo number_format($montant_paiement_anterieur_rub + $montant_paiement_courant_rubsousrubrique, 3, '.', ' '); ?></b></td>
                    <td style="text-align: right; font-size: 12px; background-color: #f2dede;"><b><?php echo number_format($montant_ordonnance_antecedent + $montant_ordonnance_courant - ($montant_paiement_anterieur_rub + $montant_paiement_courant_rubsousrubrique), 3, '.', ' ') ?></b></td>
                </tr>
                <?php $sous_listes = LigprotitrubTable::getInstance()->getSousrubriqueByTitreBudget($titre, $liste->getIdRubrique()); ?>
                <?php foreach ($sous_listes as $sous_liste) : ?>
                    <?php $montant_ordonnance_antecedent_sous_liste = DocumentbudgetTable::getInstance()->getMontantAntecedantByLigprotitrub($date_antecedent, $sous_liste->getId()); ?>
                    <?php $montant_ordonnance_courant_sous_liste = DocumentbudgetTable::getInstance()->getMontantCourantByLigprotitrub($date_antecedent, $date_fin, $sous_liste->getId()); ?>
                    <?php $montant_paiement_anterieur_sous_liste = LigprotitrubTable::getInstance()->getMontantPaiementAnterieurByLigprotitrub($date_antecedent, $sous_liste->getId()); ?>
                    <?php $montant_paiement_courant_sous_liste = LigprotitrubTable::getInstance()->getMontantPaiementCourantByLigprotitrub($date_antecedent, $date_fin, $sous_liste->getId()); ?>

                    <tr>
                        <td><?php echo $sous_liste->getRubrique()->getCode(); ?> : <?php echo $sous_liste->getRubrique()->getLibelle(); ?></td>
                        <td style="text-align: right; font-size: 11px; background-color: #dff0d8;"><?php echo number_format($sous_liste->getMnt() + $sous_liste->getMntexterne() + $sous_liste->getMntretire(), 3, '.', ' '); ?></td>
                        <td style="text-align: right; font-size: 11px;"><?php echo number_format($montant_ordonnance_antecedent_sous_liste->getMnt(), 3, '.', ' '); ?></td>
                        <td style="text-align: right; font-size: 11px;"><?php echo number_format($montant_ordonnance_courant_sous_liste->getMnt(), 3, '.', ' '); ?></td>
                        <td style="text-align: right; font-size: 11px; background-color: #d9edf7;"><?php echo number_format($montant_ordonnance_antecedent_sous_liste->getMnt() + $montant_ordonnance_courant_sous_liste->getMnt(), 3, '.', ' '); ?></td>
                        <td style="text-align: right; font-size: 11px; background-color: #fdffd5;"><?php echo number_format(($sous_liste->getMnt() + $sous_liste->getMntexterne() + $sous_liste->getMntretire()) - ($montant_ordonnance_antecedent_sous_liste->getMnt() + $montant_ordonnance_courant_sous_liste->getMnt()), 3, '.', ' '); ?></td>
                        <td style="text-align: right; font-size: 11px;"><?php echo number_format($montant_paiement_anterieur_sous_liste->getMnt(), 3, '.', ' ').' '.$montant_paiement_anterieur_sous_liste->getId() ; ?></td>
                        <td style="text-align: right; font-size: 11px;"><?php echo number_format($montant_paiement_courant_sous_liste->getMnt(), 3, '.', ' '); ?></td>
                        <td style="text-align: right; font-size: 11px; background-color: #fcf8e3;"><?php echo number_format($montant_paiement_anterieur_sous_liste->getMnt() + $montant_paiement_courant_sous_liste->getMnt(), 3, '.', ' '); ?></td>
                        <td style="text-align: right; font-size: 11px; background-color: #f2dede;"><?php echo number_format($sous_liste->getMntEngage() - ($montant_paiement_anterieur_sous_liste->getMnt() + $montant_paiement_courant_sous_liste->getMnt()), 3, '.', ' ') ?></td>
                    </tr>

                    <?php
//                    $mnt_engage_anterieur = $mnt_engage_anterieur + $montant_ordonnance_antecedent_sous_liste->getMnt();
                    $relica_engage_sous = $relica_engage + ($sous_liste->getMnt() + $sous_liste->getMntexterne() + $sous_liste->getMntretire()) - ($montant_ordonnance_antecedent_sous_liste->getMnt() + $sous_liste->getMntEngage());
                    $mnt_paiement_anterieur = $mnt_paiement_anterieur + $montant_paiement_anterieur_sous_liste->getMnt();
                    $mnt_paiement_courant_sous = $mnt_paiement_courant_sous + $montant_paiement_courant_sous_liste->getMnt();
                    $mnt_paiement_cumule = $mnt_paiement_cumule + $montant_paiement_anterieur_sous_liste->getMnt() + $montant_paiement_courant->getMnt();
                    $mnt_engage_payer_sous = $mnt_engage_payer + $montant_ordonnance_antecedent_sous_liste->getMnt() + $sous_liste->getMntEngage() - ($montant_paiement_anterieur_sous_liste->getMnt() + $montant_paiement_courant_sous_liste->getMnt());
                endforeach;
                $mnt_engage_anterieur = $mnt_engage_anterieur + $montant_ordonnance_antecedent;
                $mnt_engage_courant = $mnt_engage_courant + $montant_ordonnance_courant;
                $mnt_engage_cumule = $mnt_engage_anterieur + $mnt_engage_courant;
                $mnt_paiement_courant = $mnt_paiement_courant + $montant_paiement_courant_rubsousrubrique;
                $mnt_alloue = $mnt_alloue + $liste->getMnt() + $mnt_transfert_final;
                $relica_engage = $mnt_alloue - $mnt_engage_cumule;
                $mnt_engage_payer = $mnt_engage_cumule - $mnt_engage_payer_sous;
            endforeach;
            ?>
            <tr style="font-size: 14px; background-color: #CDCDCD;">
                <td style="text-align: center;">Total</td>
                <td style="text-align: right; font-size: 11px; background-color: #dff0d8;"><?php echo number_format($mnt_alloue, 3, '.', ' '); ?></td>
                <td style="text-align: right; font-size: 11px;"><?php echo number_format($mnt_engage_anterieur, 3, '.', ' '); ?></td>
                <td style="text-align: right; font-size: 11px;"><?php echo number_format($mnt_engage_courant, 3, '.', ' '); ?></td>
                <td style="text-align: right; font-size: 11px; background-color: #d9edf7;"><?php echo number_format($mnt_engage_courant + $mnt_engage_anterieur, 3, '.', ' '); ?></td>
                <td style="text-align: right; font-size: 11px; background-color: #fdffd5;"><?php echo number_format($relica_engage, 3, '.', ' '); ?></td>
                <td style="text-align: right; font-size: 11px;"><?php echo number_format($mnt_paiement_anterieur, 3, '.', ' '); ?></td>
                <td style="text-align: right; font-size: 11px;"><?php echo number_format($mnt_paiement_courant, 3, '.', ' '); ?></td>
                <td style="text-align: right; font-size: 11px; background-color: #fcf8e3;"><?php echo number_format($mnt_paiement_courant + $mnt_paiement_anterieur, 3, '.', ' '); ?></td>
                <td style="text-align: right; font-size: 11px; background-color: #f2dede;"><?php echo number_format($mnt_engage_cumule - ($mnt_paiement_anterieur + $mnt_paiement_courant), 3, '.', ' '); ?></td>
            </tr>
        </tbody>
    </table>
</div>