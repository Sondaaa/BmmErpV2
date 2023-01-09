<div id="sf_admin_container">
    <h1 id="replacediv">Détail des opérations
    </h1>
</div>

<?php
$soc = new Societe();
$societe = Doctrine_Core::getTable('societe')->findOneById(1);
$soc = $societe;
$entete = $soc->getRs();
?>

<div class="row">
    <div class="col-xs-12">
        <div class="widget-box" >
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Informations sur la Société</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="padding-bottom: 0px;">
                    <h4 style="text-align: center"><?php echo $entete ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $details_banque_ccp = $mouvements->getFirst(); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="widget-box" >
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Caisse</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="padding-bottom: 0px;">
                    <table>
                        <tr>
                            <td>Caisse :</td>
                            <td> 
                                <?php echo $details_banque_ccp->getCaissesbanques()->getLibelle(); ?>
                            </td>
                            <td>Solde Départ :</td>
                            <td style="text-align: right;">
                                <?php echo number_format($details_banque_ccp->getCaissesbanques()->getMntouverture(), 3, '.', ' '); ?>
                            </td>
                            <td>Nouveau Solde :</td>
                            <td style="text-align: right;">
                                <?php echo number_format($details_banque_ccp->getCaissesbanques()->getMntdefini(), 3, '.', ' '); ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="widget-box" >
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Mouvenements</h4>
                <a target="_blanc" style="float: right;" class="btn btn-outline btn-primary" href="<?php echo url_for('mouvementbanciare/ImprimerMouvementCaisse?ids=' . $ids) ?>"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="padding-bottom: 0px; width: 100%; overflow:  auto;min-height: 500px">
                    <table>
                        <thead>
                            <tr style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                                <th style="width: 50px">N°</th>
                                <th style="width: 100px">date</th>
                                <th style="width: 150px">B. de dépenses au comptant</th>
                                <th style="width: 200px">Nom d'opération</th>
                                <th style="width: 200px">Bénéficiaire</th>
                                <th style="width: 150px">Débit</th>
                                <th style="width: 150px">Crédit</th>
                                <th style="width: 150px">solde</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($mouvements as $mvt): ?>
                                <tr>
                                    <td><?php echo $mvt->getNumero(); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($mvt->getDateoperation())); ?></td>
                                    <td><?php echo $mvt->getReford(); ?></td>
                                    <td><?php echo $mvt->getNomoperation(); ?></td>
                                    <td><?php echo $mvt->getRibbeni(); ?><br><?php echo $mvt->getRefbenifi(); ?></td>
                                    <td style="text-align: right;">
                                        <?php if ($mvt->getDebit() != null): ?>
                                            <?php echo number_format($mvt->getDebit(), 3, '.', ' '); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td style="text-align: right;">
                                        <?php if ($mvt->getCredit() != null): ?>
                                            <?php echo number_format($mvt->getCredit(), 3, '.', ' '); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td style="text-align: right;"><?php echo number_format($mvt->getSolde(), 3, '.', ' '); ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <a target="_blanc" style="float: right;" class="btn btn-outline btn-info" href="<?php echo url_for('mouvementbanciare/ImprimerMouvementCaisse?ids=' . $ids) ?>"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
    </div>
</div>

<script>

    $("table").addClass("table table-bordered table-hover");

</script>