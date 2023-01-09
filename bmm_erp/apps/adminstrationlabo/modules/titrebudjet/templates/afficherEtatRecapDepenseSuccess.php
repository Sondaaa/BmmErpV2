<div class="col-xs-12">
    <div class="table-header" style="margin-bottom: 0px;">
        RECAPITULATIF DES DEPENSES :
        <a target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;" href="<?php echo url_for("titrebudjet/imprimerRecapDepense?mois=" . $mois . '&annee=' . $annee . '&titre=' . $titre); ?>">
            <i class="ace-icon fa fa-print bigger-110"></i>
            <span class="bigger-110 no-text-shadow">Imprimer</span>
        </a>
    </div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th rowspan="2" style="width: 38%; text-align: center; vertical-align: middle;">Rubriques</th>
                <th colspan="3" style="text-align: center;">PAIEMENTS DES ENGAGEMENTS <?php echo $annee; ?></th>
                <th rowspan="2" style="width: 12%; text-align: center; vertical-align: middle;">Paiement de Engagements Antérieurs</th>
                <th rowspan="2" style="width: 13%; text-align: center; vertical-align: middle;">Total Général</th>
            </tr>
            <tr>
                <th style="width: 12%;text-align: center;">Par Caisse</th>
                <th style="width: 12%;text-align: center;">Par Banque</th>
                <th style="width: 13%;text-align: center;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
         
            $mnt_caisse = 0;
            $mnt_banque = 0;
            $mnt_banque_rubrique = 0;
            $mnt_banque_sous_rubrique = 0;
            $mnt_ant_rubrique = 0;
            $mnt_ant_sous_rubrique = 0;
            $mnt_caisse_rubrique = 0;
            $mnt_caisse_sous_rubrique = 0;
            $mnt_total = 0;
            $mnt_ant = 0;
            $all_total = 0;
            $all_total_sous_rub = 0;
            $i = 0;
            $mnt_paiement_curant = 0;
            $mnt_paiement_curant_rubrique = 0;
            $mnt_caisse_rubri = 0;
            ?>
            <?php foreach ($listes as $liste) : ?>

                <?php $sous_listes = RecapDeponseTable::getInstance()->getSousByAnneeAndMois($annee, $mois, $titre, $liste->getIdRubrique()); ?>
                <?php foreach ($sous_listes as $sous_liste) : ?>
                    <?php
                    $mnt_paiement_curant = $mnt_paiement_curant + $sous_liste->getMntCaisseByArryMois($mois_depart) + $sous_liste->getMntBanqueByArryMois($mois_depart) + $sous_liste->getMntAntByArryMois($mois_depart);
                    $mnt_banque_sous_rubrique = $mnt_banque_sous_rubrique + $sous_liste->getMntBanqueByArryMois($mois_depart);
                    $mnt_caisse_sous_rubrique = $mnt_caisse_sous_rubrique + $sous_liste->getMntCaisseByArryMois($mois_depart);
                    $mnt_ant_sous_rubrique = $mnt_ant_sous_rubrique + $sous_liste->getMntAntByArryMois($mois_depart);
                    $all_total_sous_rub = $all_total_sous_rub + $sous_liste->getMntCaisseByArryMois($mois_depart) + $sous_liste->getMntBanqueByArryMois($mois_depart) + $sous_liste->getMntAntByArryMois($mois_depart);
                    ?>
                <?php
                endforeach;

                if (count($sous_listes) == 0) {
                    $mnt_paiement_curant_rubrique = $mnt_paiement_curant + ($liste->getMntCaisseByArryMois($mois_depart) + $liste->getMntBanqueByArryMois($mois_depart) + $liste->getMntAntByArryMois($mois_depart));
                    $mnt_banque_rubrique = $mnt_banque_sous_rubrique + $liste->getMntBanqueByArryMois($mois_depart);
                    $mnt_caisse_rubrique = $mnt_caisse_sous_rubrique + $liste->getMntCaisseByArryMois($mois_depart);

                    $mnt_ant_rubrique = $mnt_ant_sous_rubrique + $liste->getMntAntByArryMois($mois_depart);
                } else {
                    $mnt_paiement_curant_rubrique = $mnt_paiement_curant;
                    $mnt_banque_rubrique = $mnt_banque_sous_rubrique;
                    $mnt_caisse_rubrique = $mnt_caisse_sous_rubrique;
                    $mnt_ant_rubrique = $mnt_ant_sous_rubrique;
                }
                ?> <tr>
                    <td><b style="color: #0066cc;"><?php echo $liste->getRubrique()->getCode(); ?> : </b> <?php echo $liste->getRubrique()->getLibelle(); ?></td>
                    <td style="text-align: right;"><?php echo number_format($mnt_caisse_rubrique, 3, '.', ' '); ?></td>
                    <td style="text-align: right;"><?php echo number_format($mnt_banque_rubrique, 3, '.', ' '); ?></td>
                    <td style="text-align: right; color: #3BB014;"><?php echo number_format($mnt_caisse_rubrique + $mnt_banque_rubrique, 3, '.', ' '); ?></td>
                    <td style="text-align: right;"><?php echo number_format($mnt_ant_rubrique, 3, '.', ' '); ?></td>
                    <td style="text-align: right; color: #CC1F00;"><?php echo number_format($mnt_paiement_curant_rubrique, 3, '.', ' '); ?></td>
                </tr>
                <?php
                $mnt_caisse = $mnt_caisse + $mnt_caisse_rubrique;
                $mnt_banque = $mnt_banque + $mnt_banque_rubrique;
                $mnt_total = $mnt_total + $mnt_caisse_rubrique + $mnt_banque_rubrique;
                $mnt_ant = $mnt_ant + $mnt_ant_rubrique;
                if (count($sous_listes) == 0) {
                    $all_total = $all_total_sous_rub + $liste->getMntCaisseByArryMois($mois_depart) + $liste->getMntBanqueByArryMois($mois_depart) + $liste->getMntAntByArryMois($mois_depart);
                } else {
                    $all_total = $all_total_sous_rub;
                }
                $i++;
                ?>
                <?php
                $sous_listes = RecapDeponseTable::getInstance()->getSousByAnneeAndMois($annee, $mois, $titre, $liste->getIdRubrique()); ?>
                <?php foreach ($sous_listes as $sous_liste) : ?>
                    <tr style="background-color: #deffd0;">
                        <td><b style="color: #0066cc;"><?php echo $sous_liste->getLigprotitrub()->getCode(); ?> : </b> <?php echo $sous_liste->getRubrique()->getLibelle(); ?></td>
                        <td style="text-align: right;"><?php echo number_format($sous_liste->getMntCaisseByArryMois($mois_depart), 3, '.', ' '); ?></td>
                        <td style="text-align: right;"><?php echo number_format($sous_liste->getMntBanqueByArryMois($mois_depart), 3, '.', ' '); ?></td>
                        <td style="text-align: right; color: #3BB014;"><?php echo number_format($sous_liste->getMntCaisseByArryMois($mois_depart) + $sous_liste->getMntBanqueByArryMois($mois_depart), 3, '.', ' '); ?></td>
                        <td style="text-align: right;"><?php echo number_format($sous_liste->getMntAntByArryMois($mois_depart), 3, '.', ' '); ?></td>
                        <td style="text-align: right; color: #CC1F00;"><?php echo number_format($sous_liste->getMntCaisseByArryMois($mois_depart) + $sous_liste->getMntBanqueByArryMois($mois_depart) + $sous_liste->getMntAntByArryMois($mois_depart), 3, '.', ' '); ?></td>
                    </tr>
                <?php endforeach; ?>

            <?php endforeach; ?>
            <tr style="font-size: 14px; background-color: #CDCDCD;">
                <td style="text-align: center;">Total</td>
                <td style="text-align: right;"><?php echo number_format($mnt_caisse, 3, '.', ' '); ?></td>
                <td style="text-align: right;"><?php echo number_format($mnt_banque, 3, '.', ' '); ?></td>
                <td style="text-align: right;"><?php echo number_format($mnt_total, 3, '.', ' '); ?></td>
                <td style="text-align: right;"><?php echo number_format($mnt_ant, 3, '.', ' '); ?></td>
                <td style="text-align: right;"><?php echo number_format($all_total, 3, '.', ' '); ?></td>
            </tr>
        </tbody>
    </table>
</div>

<input id="count_table" type="hidden" value="<?php echo $i; ?>" />

<script type="text/javascript">
    function afficherSousRubrique(id, index) {
        if ($("#td_" + index).attr('affiche') == "0") {
            $("#td_" + index).attr('affiche', '1')
            $.ajax({
                url: '<?php echo url_for('titrebudjet/afficherSousEtatRecapDepense') ?>',
                data: 'mois=<?php echo $mois ?>' +
                    '&titre=' + $('#titre').val() +
                    '&annee=<?php echo $annee ?>' +
                    '&id_rubrique=' + id,
                success: function(data) {
                    var count_ligne = parseInt($("#count_table").val());
                    if (index < count_ligne - 1) {
                        index = parseInt(index) + 1;
                        $('#tr_' + index).before(data);
                    } else {
                        $('#liste_recap tbody').append(data);
                    }
                }
            });
        }
    }
</script>