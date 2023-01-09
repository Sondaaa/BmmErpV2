<div class="col-xs-12">
    <div class="table-header" style="margin-bottom: 0px;">
        RECAPITULATIF DES ENGAGEMENTS BUDGETAIRES :
        <a target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;" href="<?php echo url_for("titrebudjet/imprimerRecap?mois=" . $mois . '&annee=' . $annee . '&titre=' . $titre); ?>">
            <i class="ace-icon fa fa-print bigger-110"></i>
            <span class="bigger-110 no-text-shadow">Imprimer</span>
        </a>
    </div>
    <table id="liste_recap" class="table table-bordered table-hover">
        <thead>
            <tr style="text-align: center;">
                <th style="width: 40%;">Rubriques</th>
                <th style="width: 12%;text-align: center;">C. Alloués</th>
                <th style="width: 12%;text-align: center;">Engagement</th>
                <th style="width: 12%;text-align: center;">Paiement</th>
                <th style="width: 12%;text-align: center;">R. Engagement</th>
                <th style="width: 12%;text-align: center;">R. Paiement</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $mnt_alloue = 0;
            $mnt_alloue_liste = 0;
            $mnt_engage = 0;
            $mnt_paiement = 0;
            $relica_engage = 0;
            $relica_paiement = 0;
            $mnt_engagerrubrique = 0;
            $mnt_engagerrubriquesanssousrubrique = 0;
            $mnt_paiment_rubriquesanssousrubrique = 0;
            $mnt_paiment_rubrique = 0;
            $reliquantengager_rubrique = 0;
            $reliquantpaiement_rubrique = 0;
            $i = 0;
            ?>
            <?php foreach ($listes as $liste) : ?>
                <?php $sous_listes = RecapbudgetTable::getInstance()->getSousByAnneeAndMois($annee, $mois, $titre, $liste->getIdRubrique()); ?>
                <?php foreach ($sous_listes as $sous_liste) : ?>
                    <?php
                    $mnt_alloue_liste = $mnt_alloue_liste + $sous_liste->getMntAllouer();
                    if (count($sous_listes) != 0) {
                        $mnt_engagerrubrique = $mnt_engagerrubrique + $sous_liste->getMntEncager();
                        $mnt_paiment_rubrique = $mnt_paiment_rubrique + $sous_liste->getMntMaiement();
                        $reliquantengager_rubrique = $liste->getMntAllouer() - $mnt_engagerrubrique;
                        $reliquantpaiement_rubrique = $reliquantpaiement_rubrique + $sous_liste->getRelicatPaiment();
                    }
                    ?>
                    <?php
                endforeach;
                if (count($sous_listes) == 0)
                    $mnt_engagerrubriquesanssousrubrique = $mnt_engagerrubrique + $liste->getMntEncager();
                else
                    $mnt_engagerrubriquesanssousrubrique = $mnt_engagerrubrique;

                if (count($sous_listes) == 0)
                    $mnt_paiment_rubriquesanssousrubrique = $mnt_paiment_rubrique + $liste->getMntMaiement();
                else
                    $mnt_paiment_rubriquesanssousrubrique = $mnt_paiment_rubrique;
                ?>

                <tr>
                    <td><b style="color: #0066cc;"><?php echo $liste->getLigprotitrub()->getRubrique()->getCode(); ?> : </b> <?php echo $liste->getRubrique()->getLibelle(); ?></td>
                    <td style="text-align: right;"><?php echo number_format($liste->getMntAllouer(), 3, '.', ' '); ?></td>
                    <td style="text-align: right;"><?php echo number_format($mnt_engagerrubriquesanssousrubrique, 3, '.', ' '); ?></td>
                    <td style="text-align: right;"><?php echo number_format($mnt_paiment_rubriquesanssousrubrique, 3, '.', ' '); ?></td>
                    <td style="text-align: right;"><?php echo number_format($liste->getMntAllouer() - $mnt_engagerrubriquesanssousrubrique, 3, '.', ' '); ?></td>
                    <td style="text-align: right;"><?php echo number_format($mnt_engagerrubriquesanssousrubrique - $mnt_paiment_rubriquesanssousrubrique, 3, '.', ' '); ?></td>
                </tr>

                <?php $sous_listes = RecapbudgetTable::getInstance()->getSousByAnneeAndMois($annee, $mois, $titre, $liste->getIdRubrique()); ?>
    <?php foreach ($sous_listes as $sous_liste) : ?>
                    <tr style="background-color: #deffd0;">
                        <td style="color: #0066cc;"><?php echo $sous_liste->getLigprotitrub()->getRubrique()->getCode(); ?> : <?php echo $sous_liste->getRubrique()->getLibelle(); ?></td>
                        <td style="text-align: right;"><?php echo number_format($sous_liste->getMntAllouer(), 3, '.', ' '); ?></td>
                        <td style="text-align: right;"><?php echo number_format($sous_liste->getMntEncager(), 3, '.', ' '); ?></td>
                        <td style="text-align: right;"><?php echo number_format($sous_liste->getMntMaiement(), 3, '.', ' '); ?></td>
                        <td style="text-align: right;"><?php echo number_format($sous_liste->getMntAllouer() - $sous_liste->getMntEncager(), 3, '.', ' '); ?></td>
                        <td style="text-align: right;"><?php echo number_format($sous_liste->getMntEncager() - $sous_liste->getMntMaiement(), 3, '.', ' '); ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php
                $mnt_alloue = $mnt_alloue + $liste->getMntAllouer();
                $mnt_engage = $mnt_engage + $mnt_engagerrubriquesanssousrubrique;
                $mnt_paiement = $mnt_paiement + $mnt_paiment_rubriquesanssousrubrique;
                $relica_engage = $mnt_alloue - $mnt_engage;
                $relica_paiement = $mnt_alloue - $mnt_paiement;
                $i++;
                ?>
<?php endforeach; ?>
            <tr style="font-size: 14px; background-color: #CDCDCD;">
                <td style="text-align: center;">Total</td>
                <td style="text-align: right;"><?php echo number_format($mnt_alloue, 3, '.', ' '); ?></td>
                <td style="text-align: right;"><?php echo number_format($mnt_engage, 3, '.', ' '); ?></td>
                <td style="text-align: right;"><?php echo number_format($mnt_paiement, 3, '.', ' '); ?></td>
                <td style="text-align: right;"><?php echo number_format($relica_engage, 3, '.', ' '); ?></td>
                <td style="text-align: right;"><?php echo number_format($mnt_engage - $mnt_paiement, 3, '.', ' '); ?></td>
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
                url: '<?php echo url_for('titrebudjet/afficherSousEtatRecap') ?>',
                data: 'mois=<?php echo $mois ?>' +
                        '&titre=' + $('#titre').val() +
                        '&annee=<?php echo $annee ?>' +
                        '&id_rubrique=' + id,
                success: function (data) {
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