<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Résultat de recherche
            <a target="_blanc" href="<?php echo url_for('mouvementbanciare/ImprimerJournalMouvementCaisse?date_debut=' . $date_debut . '&date_fin=' . $date_fin . '&id_banque=' . $id_banque . '&type=' . $type) ?>" class="btn btn-sm btn-success" style="float: right; padding: 5px 9px;">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer</span>
            </a>
        </div>
        <div>
            <form>
                <div class="sf_admin_list">
                    <table id="list_mouvements" class="table table-bordered table-hover" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 2%">N°</th>
                                <th style="width: 9%">Date Paiement</th>
                                <th style="width: 9%">B. de dépenses au comptant</th>
                                <th style="width: 9%">Ordonnance de Paiement</th>
                                <th style="width: 20%">Libellé</th>
                                <th style="width: 15%">Bénéficiaire</th>
                                <th style="width: 12%">Recette<br>(Crédit)</th>
                                <th style="width: 12%">Dépense<br>(Dédit)</th>
                                <th style="width: 12%">Solde</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
                            <?php if ($mouvements->count() == 0): ?>
                                <tr>
                                    <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="9">Pas de mouvements</td>
                                </tr>
                            <?php else: ?>

                                <?php $solde_initiale = $mouvements->getFirst(); ?>
                                <tr>
                                    <td> - </td>
                                    <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($solde_initiale->getDateoperation() . ' - 1 days')); ?></td>
                                    <td></td>
                                    <td></td>
                                    <td>Solde au <span style="float: right;"><?php echo date('d/m/Y', strtotime($solde_initiale->getDateoperation() . ' - 1 days')); ?></span></td>
                                    <td colspan="3"></td>
                                    <td style="text-align: right;">
                                        <?php if ($solde_initiale->getCredit() != null): ?>
                                            <?php echo number_format($solde_initiale->getSolde() - $solde_initiale->getCredit(), 3, '.', ' '); ?>
                                        <?php else: ?>
                                            <?php echo number_format($solde_initiale->getSolde() + $solde_initiale->getDebit(), 3, '.', ' '); ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php foreach ($mouvements as $mvt): ?>
                                    <?php
                                    $document_achat = $mvt->getDocumentachat();
                                    $ordonnance = Doctrine_Query::create()
                                                    ->select("*")
                                                    ->from('documentbudget d')
                                                    ->leftJoin('d.Piecejointbudget p')
                                                    ->where("id_type=2")
                                                    ->andwhere("p.id_docachat=" . $document_achat->getId())
                                                    ->execute()->getFirst();
                                    ?>
                                    <tr>
                                        <td><?php echo $mvt->getNumero(); ?></td>
                                        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($mvt->getDateoperation())); ?></td>
                                        <td style="text-align: center;"><?php echo $mvt->getReford(); ?></td>
                                        <td style="text-align: center;">
                                            <?php if ($ordonnance): ?>
                                                <a target="_blank" href="<?php echo url_for('mouvementbanciare/etatordonnance?id=' . $ordonnance->getId()) ?>">
                                                    <?php echo $ordonnance->getNumero(); ?>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $mvt->getNomoperation(); ?></td>
                                        <td><?php echo $mvt->getRefbenifi(); ?></td>
                                        <td style="text-align: right;">
                                            <?php if ($mvt->getCredit() != null): ?>
                                                <?php echo number_format($mvt->getCredit(), 3, '.', ' '); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td style="text-align: right;">
                                            <?php if ($mvt->getDebit() != null): ?>
                                                <?php echo number_format($mvt->getDebit(), 3, '.', ' '); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td style="text-align: right;"><?php echo number_format($mvt->getSolde(), 3, '.', ' '); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>