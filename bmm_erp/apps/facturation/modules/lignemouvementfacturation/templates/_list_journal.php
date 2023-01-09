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

            case 20:
                $document_label = "Contrat";
                break;

            default :
                $document_label = "B.D.C / B.C.E / Contrat";
                break;
        }
        ?>
        <div>
            <div class="sf_admin_list">
                <table id="list_mouvements" class="table table-bordered table-hover" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 4%">N°</th>
                            <th style="width: 8%">Date</th>
                            <th style="width: 8%">Facture N°</th>
                            <th style="width: 9%">Montant</th>
                            <th style="width: 8%; background-color: #dff0d8;"><?php echo $document_label; ?></th>
                            <th style="width: 8%; background-color: #dff0d8;">Date</th>
                            <th style="width: 8%; background-color: #fcf8e3;">R.R.S <span style="float: right;">P.V.R</span></th>
                            <th style="width: 8%; background-color: #fcf8e3;">Date</th>
                            <th style="width: 23%;">Fournisseur</th>
                            <th style="width: 10%;">Situation Fiscale</th>
                            <th style="width: 10%; text-align: center;">Opération</th>
                        </tr>
                    </thead>
                    <tfoot></tfoot>
                    <tbody>
                        <?php if ($mouvements->count() == 0): ?>
                            <tr>
                                <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="9">Pas de mouvements</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($mouvements as $mvt): ?>
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
                                    <td style="background-color: #fcf8e3;">
                                        <?php echo $mvt->getRrs(); ?> <span style="float: right;"><?php echo $mvt->getPvr(); ?></span><br>
                                        <?php if ($mvt->getValide() != true): ?>
                                            <button id="btn_<?php echo $mvt->getId(); ?>" onclick="validerMouvement('<?php echo $mvt->getId(); ?>')" class="btn btn-xs btn-primary" title="Valider Mouvement">
                                                <i class="ace-icon fa fa-check align-top bigger-110"></i>
                                                Valider Mvt
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                    <td style="text-align: center; background-color: #fcf8e3;"><?php echo date('d/m/Y', strtotime($mvt->getDaterrspvr())); ?></td>
                                    <td><?php echo $mvt->getFournisseur(); ?></td>
                                    <td><?php
                                        if ($mvt->getEtatfrs() == '1'): echo 'En Régle';
                                        elseif ($mvt->getEtatfrs() == '0'): echo 'En Défaut';
                                        endif;
                                        ?></td>
                                    <td style="cursor: pointer; text-align: center;">
        <!--                                        <a type="button" class="btn btn-white btn-info btn-sm" href="<?php // echo url_for('journal/showEditEtatFrs?id=' . $mvt->getId())  ?>" title="Modifier Etat Fournisseur"><i class="ace-icon fa fa-edit bigger-110 icon-only"></i></a>-->
                                        <!--                                        <button type="button" class="btn btn-white btn-info btn-sm pull-right" 
                                                                                        title="Modifier Etat Fournisseur"
                                                                                        onclick="edit('<?php // echo $mvt->getId()   ?>')" 
                                                                                        style="text-align: center;" >
                                        
                                                                                    <i class="ace-icon fa fa-edit icon-on-right bigger-110"></i>
                                                                                </button>-->
                                        <span class="btn-group">
                                            <a title="Modifier Etat Fournisseur"   class="btn btn-primary btn-xs" onclick="edit(<?php echo $mvt->getId() ?>)" ><i class="ace-icon fa fa-edit"></i></a>
                                        </span>
                                        <span class="btn-group">
                                            <a title="Supprimer Fournisseur"   class="btn btn-danger btn-xs" onclick="openPopupSupprimerForm(<?php echo $mvt->getId() ?>)" ><i class="ace-icon fa fa-trash"></i></a>
                                        </span>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    //tooltips
    $("[data-tootip=show_tooltip]").tooltip({
        show: {
            effect: "slideDown",
            delay: 250
        }
    });

</script>