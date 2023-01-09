<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Résultat de recherche
            <a target="_blanc" href="<?php echo url_for('lignemouvementfacturation/ImprimerJournalMouvement?date_debut=' . $date_debut . '&date_fin=' . $date_fin . '&fournisseur_id=' . $fournisseur_id . '&idtype=' . $idtype . '&facture=' . $facture . '&valide=' . $valide) ?>" class="btn btn-sm btn-success" style="float: right; padding: 5px 9px;">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer</span>
            </a>
        </div>
        <?php
        switch ($idtype) {
            case 2:
                $document_label = "B.D.C";
                break;

            case 7:
                $document_label = "B.C.E";
                break;

            case 19:
                $document_label = "Contrats";
                break;

            default :
                $document_label = "B.D.C / B.C.E / Contrats";
                break;
        }
        ?>
        <div>
            <form>
                <div class="sf_admin_list">
                    <table id="list_mouvements" class="table table-bordered table-hover" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 50px">N°</th>
                                <th style="width: 100px">Date</th>
                                <th style="width: 100px">Facture N°</th>
                                <th style="width: 100px">Montant</th>
                                <th style="width: 100px; background-color: #dff0d8;"><?php echo $document_label; ?></th>
                                <th style="width: 100px; background-color: #dff0d8;">Date</th>
                                <th style="width: 100px; background-color: #fcf8e3;">R.R.S <span style="float: right;">P.V.R</span></th>
                                <th style="width: 100px; background-color: #fcf8e3;">Date</th>
                                <th style="width: 200px">Fournisseur</th>
                                <th style="width: 50px">Fac°</th>
                                <th style="width: 100px">Opérations</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
                            <?php if ($mouvements->count() == 0): ?>
                                <tr>
                                    <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="10">Pas de mouvements</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($mouvements as $mvt): ?>
                                    <?php
                                    //Charger facture d'aprés BCE Système
                                    $facture = DocumentachatTable::getInstance()->findOneByIdDocparentAndIdTypedoc($mvt->getDocumentachat()->getId(), 15);
                                    if (!$facture) {
                                        //Carger facture d'aprés BCEJ
                                        $bcej = DocumentachatTable::getInstance()->findOneByIdDocparentAndIdTypedoc($mvt->getDocumentachat()->getId(), 16);
                                        if ($bcej)
                                            $facture = DocumentachatTable::getInstance()->findOneByIdDocparentAndIdTypedoc($bcej->getId(), 15);
                                        else
                                            $facture = null;
                                    }
                                    ?>
                                    <tr>
                                        <?php if ($mvt->getDocumentachat()->getMntttc() != $mvt->getMontant()): ?>
                                            <td style="background-color: #ffdcdc">
                                                <?php echo $mvt->getOrdre(); ?>
                                                <a style="float: right;" class="grey" data-tootip="show_tooltip" href="#" title="Montant <?php echo $document_label; ?> = <?php echo number_format($mvt->getDocumentachat()->getMntttc(), 3, '.', ' '); ?> , différent au montant de la facture = <?php echo number_format($mvt->getMontant(), 3, '.', ' '); ?> !">
                                                    <i class="ace-icon fa fa-hand-o-right"></i>
                                                </a>
                                            </td>
                                        <?php else: ?>
                                            <td>
                                                <?php echo $mvt->getOrdre(); ?>
                                            </td>
                                        <?php endif; ?>
                                        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($mvt->getDate())); ?></td>
                                        <td><?php echo $mvt->getNumerofacture(); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($mvt->getMontant(), 3, '.', ' '); ?></td>
                                        <td style="background-color: #dff0d8;"><?php echo $mvt->getDocumentachat()->getTypedoc()->getPrefixetype(); ?><span style="float: right;"><?php echo $mvt->getDocumentachat()->getNumero(); ?></span></td>
                                        <td style="text-align: center; background-color: #dff0d8;"><?php echo date('d/m/Y', strtotime($mvt->getDocumentachat()->getDatecreation())); ?></td>
                                        <td style="background-color: #fcf8e3;"><?php echo $mvt->getRrs(); ?> <span style="float: right;"><?php echo $mvt->getPvr(); ?></span></td>
                                        <td style="text-align: center; background-color: #fcf8e3;"><?php echo date('d/m/Y', strtotime($mvt->getDaterrspvr())); ?></td>
                                        <td><?php echo $mvt->getFournisseur(); ?></td>
                                        <td style="text-align: center;">
                                            <?php if ($facture != null): ?>
                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                            <?php endif; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a target="_blanc" href="<?php echo url_for('lignemouvementfacturation/detailsFacture?id=' . $mvt->getDocumentachat()->getId()) ?>" class="btn btn-sm btn-success" style="padding: 3px 10px;">
                                                <i class="ace-icon fa fa-eye bigger-110"></i>
                                                <span class="bigger-110 no-text-shadow">Détails</span>
                                            </a>
                                        </td>
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

<script  type="text/javascript">

    //tooltips
    $("[data-tootip=show_tooltip]").tooltip({
        show: {
            effect: "slideDown",
            delay: 250
        }
    });

</script>