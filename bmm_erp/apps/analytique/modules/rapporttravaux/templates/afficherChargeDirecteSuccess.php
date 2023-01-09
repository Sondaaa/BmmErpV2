<?php
$intrant = 0;
$mecanisation = 0;
$id_mecanisation = '';
foreach ($rapports as $rapport):
    if ($rapport->getIdType() != 2):
        $intrant = $intrant + $rapport->getMontant();
    else:
        $mecanisation = $mecanisation + $rapport->getMontant();
        $id_mecanisation = $rapport->getId();
    endif;
endforeach;
$main_doeuvre = 0;
if ($repartition):
    $main_doeuvre = $repartition->getMontant();
endif;
?>
<table class="table table-bordered table-hover">
    <thead>
        <tr style="font-weight: bold;">
            <td style="width: 70%;">Charges Directes </td>
            <td style="width: 30%; text-align: center;">Montants</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Main d'œuvre 
                <?php if ($repartition): ?>
                    <span style="float: right;">
                        <a class="btn btn-xs btn-white btn-success" href="<?php echo url_for('repartitionsalaireouvrier/imprimerRecap?id=' . $repartition->getId()) ?>" target="_blank">Répartition <?php echo $annee; ?></a>
                    </span>
                <?php else: ?>
                    <span style="float: right; width: 70%; border-left: 2px solid #ACACAC; padding-left: 5px;">
                        Veuillez créer la répartition des salaires (ouvriers) : <a style="cursor: pointer;" href="<?php echo url_for('repartitionsalaireouvrier/new') ?>">Répartition Mensuelle (<?php echo $annee; ?>)</a>.
                    </span>
                <?php endif; ?>
            </td>
            <td style="text-align: right;"><?php echo number_format($main_doeuvre, 3, '.', ' ') ?></td>
        </tr>
        <tr>
            <td>Intrant
                <?php if ($rapports->count() != 0): ?>
                    <span style="float: right;">
                        <?php $i = 1; ?>
                        <?php foreach ($rapports as $rapport): ?>
                            <?php if ($rapport->getIdType() != 2): ?>
                                <a class="btn btn-xs btn-white btn-success" href="<?php echo url_for('rapporttravaux/imprimer?id=' . $rapport->getId()) ?>" target="_blank">R<?php echo $i; ?> - <?php echo $annee; ?></a>
                                <?php $i++; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </span>
                <?php else: ?>
                    <span style="float: right; width: 70%; border-left: 2px solid #ACACAC; padding-left: 5px;">
                        Veuillez créer le(s) rapport(s) des travaux (Intrant) : <a style="cursor: pointer;" href="<?php echo url_for('rapporttravaux/new') ?>">Rapport des Travaux (<?php echo $annee; ?>)</a>.
                    </span>
                <?php endif; ?>
            </td>
            <td style="text-align: right;"><?php echo number_format($intrant, 3, '.', ' ') ?></td>
        </tr>
        <tr>
            <td>Mécanisation 
                <?php if ($id_mecanisation != ''): ?>
                    <span style="float: right;">
                        <a class="btn btn-xs btn-white btn-success" href="<?php echo url_for('rapporttravaux/imprimerArticle?id=' . $id_mecanisation) ?>" target="_blank">Rapport <?php echo $annee; ?></a>
                    </span>
                <?php else: ?>
                    <span style="float: right; width: 70%; border-left: 2px solid #ACACAC; padding-left: 5px;">
                        Veuillez créer le rapport des travaux (Mécanisation) : <a style="cursor: pointer;" href="<?php echo url_for('rapporttravaux/new') ?>">Rapport des Travaux (<?php echo $annee; ?>)</a>.
                    </span>
                <?php endif; ?>
            </td>
            <td style="text-align: right;"><?php echo number_format($mecanisation, 3, '.', ' ') ?></td>
        </tr>
        <tr style="background-color: #F0F0F0;">
            <td style="font-weight: bold;">Total : </td>
            <td style="text-align: right;"><?php echo number_format($main_doeuvre + $intrant + $mecanisation, 3, '.', ' ') ?></td>
        </tr>
    </tbody>
</table>

<?php
$frais = FraisgenerauxTable::getInstance()->findOneByAnnee($annee);
$Montant_frais = 0;
if ($frais)
    $Montant_frais = $frais->getMontant();
?>
<legend style="margin-bottom: 10px; font-size: 18px;">Détermination des frais généraux</legend>
<table class="table table-bordered table-hover">
    <tbody>
        <tr>
            <td colspan="2">Frais généraux = Charges directes - Charges à répartir : </td>
        </tr>
        <tr>
            <td style="background-color: #F9E8B3;">Charges directes : </td>
            <td style="text-align: right;"><?php echo number_format($main_doeuvre + $intrant + $mecanisation, 3, '.', ' ') ?></td>
        </tr>
        <tr>
            <td style="background-color: #FFFDD9;">Charges à répartir : </td>
            <td style="text-align: right;">
                <?php if ($frais): ?>
                    <?php echo number_format($Montant_frais, 3, '.', ' '); ?>
                <?php else: ?>
                    <div style="width: 100%; text-align: left;">
                        Veuillez générer le rapport des <a style="cursor: pointer;" href="<?php echo url_for('fraisgeneraux/new') ?>">Charges à répartir (Génération Comptable <?php echo $annee; ?>)</a>.
                    </div>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td style="background-color: #EAEAEA;">Frais généraux : </td>
            <td style="text-align: right;"><?php echo number_format($main_doeuvre + $intrant + $mecanisation - $Montant_frais, 3, '.', ' ') ?></td>
        </tr>
    </tbody>
</table>
<hr style="margin-bottom: 10px;">
<a href="<?php echo url_for('rapporttravaux/imprimerToutCharge?annee=' . $annee) ?>" target="_blank" class="btn btn-white btn-success">Imprimer</a>
<?php if ($frais): ?>
    <a class="btn btn-white btn-yellow" href="<?php echo url_for('fraisgeneraux/imprimer?id=' . $frais->getId()) ?>" target="_blank">Imprimer Charges à Répartir</a>
<?php endif; ?>
<a href="<?php echo url_for('rapporttravaux/imprimerChargeDirecte?annee=' . $annee) ?>" target="_blank" class="btn btn-white btn-danger">Imprimer Charges Directes</a>