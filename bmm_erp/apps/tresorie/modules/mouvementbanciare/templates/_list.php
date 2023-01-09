<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Résultat de recherche
            <a target="_blanc" href="<?php echo url_for('mouvementbanciare/ImprimerSearchMouvementCaisse?date_debut=' . $date_debut . '&date_fin=' . $date_fin . '&id_banque=' . $id_banque) ?>" class="btn btn-sm btn-success" style="float: right; padding: 5px 9px;">
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
                                <th style="width: 4%;">N°</th>
                                <th style="width: 10%;">date</th>
                                <th style="width: 10%;">Réf.Ordonnancement (B.D.C)</th>
                                <th style="width: 25%;">Nom d'opération</th>
                                <th style="width: 15%;">Bénéficiaire</th>
                                <th style="width: 12%;">Débit</th>
                                <th style="width: 12%;">Crédit</th>
                                <th style="width: 12%;">Opération</th>
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                        <tbody>
                            <?php if ($pager->count() == 0): ?>
                                <tr>
                                    <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="7">Pas de mouvements</td>
                                </tr>
                            <?php endif; ?>
                            <?php foreach ($pager->getResults() as $mvt): ?>
                                <?php
                                $document_achat = $mvt->getDocumentachat();
                                if ($document_achat->getId() != null) {
                                    $ordonnance = Doctrine_Query::create()
                                                    ->select("*")
                                                    ->from('documentbudget d')
                                                    ->leftJoin('d.Piecejointbudget p')
                                                    ->where("id_type=2")
                                                    ->andwhere("p.id_docachat=" . $document_achat->getId())
                                                    ->execute()->getFirst();
                                } else {
                                    $ordonnance = null;
                                }
                                ?>
                                <tr>
                                    <td><?php echo $mvt->getNumero(); ?></td>
                                    <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($mvt->getDateoperation())); ?></td>
                                    <td>
                                        <?php if ($ordonnance): ?>
                                            <span style="float: left;">
                                                <a target="_blank" href="<?php echo url_for('mouvementbanciare/etatordonnance?id=' . $ordonnance->getId()) ?>">
                                                    <?php echo $ordonnance->getNumero(); ?>
                                                </a>
                                            </span>
                                        <?php endif; ?>
                                        <span style="float: right;">(<?php echo trim($mvt->getReford()); ?>)</span>
                                    </td>
                                    <td><?php echo $mvt->getNomoperation(); ?></td>
                                    <td><?php echo $mvt->getRefbenifi(); ?></td>
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
                                    <td style="text-align: center; vertical-align: middle;" <?php if ($mvt->getMntenoper() != null): ?>rowspan="2"<?php endif; ?>>
                                        <?php
                                        $relation_existe = 0;
                                        if ($mvt->getIdMouvement() != null):
                                            $relation_existe = 1;
                                        else:
                                            $mouvement_fils = MouvementbanciareTable::getInstance()->findOneByIdMouvement($mvt->getId());
                                            if ($mouvement_fils != null):
                                                $relation_existe = 1;
                                            endif;
                                        endif;
                                        ?>
                                        <button class="btn btn-danger" type="button" onclick="supprimerMouvement('<?php echo $mvt->getId(); ?>', <?php echo $relation_existe ?>)">
                                            <i class="ace-icon fa fa-remove bigger-110"></i>
                                            Supprimer
                                        </button>
                                    </td>
                                </tr>
                                <?php if ($mvt->getMntenoper() != null): ?>
                                    <tr>
                                        <td><?php echo $mvt->getNumero() . ".1" ?></td>
                                        <td colspan="5"><?php echo $mvt->getTypeoperation()->getLibelle(); ?></td>
                                        <td style="text-align: right;">
                                            <?php echo number_format($mvt->getMntenoper(), 3, '.', ' '); ?>
                                        </td>
                                        <td></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var footer = '';
<?php if ($pager->haveToPaginate()): ?>
        footer = '<tr>' +
                '<td style ="padding: 0px;" colspan ="9">' +
                '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                '<div class ="col-xs-12" >' +
                '<div class ="dataTables_paginate paging_simple_numbers" id ="dynamic-table_paginate">' +
                '<ul class ="pagination">' +
    <?php if ($pager->getPage() == 1): ?>
            '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                    '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPage(\'1\')"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                    '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPage(\'<?php echo $pager->getPreviousPage() ?>\')"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
    <?php endif; ?>
    <?php foreach ($pager->getLinks() as $page): ?>
        <?php if ($page == $pager->getPage()): ?>
                '<li class ="paginate_button active" aria-controls ="dynamic-table" tabindex ="0"> <a href = "#"> <?php echo $page ?> </a></li>' +
        <?php else: ?>
                '<li class ="paginate_button" aria-controls ="dynamic-table" tabindex ="0"> <a onclick="goPage(\'<?php echo $page ?>\')"> <?php echo $page ?> </a></li>' +
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if ($pager->getPage() == $pager->getLastPage()): ?>
            '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> <i class="ace-icon fa fa-angle-double-right"></i> Dernière </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPage(\'<?php echo $pager->getNextPage() ?>\')"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPage(\'<?php echo $pager->getLastPage() ?>\')"> Dernière <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
    <?php endif; ?>
        '</ul>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</td>' +
                '</tr>';
<?php else: ?>
        footer = '<tr>' +
                '<td style ="padding: 0px;" colspan ="9">' +
                '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                '<div class ="col-xs-12">' +
                '</div>' +
                '</div>' +
                '</td>' +
                '</tr>';
<?php endif; ?>
    $('#list_mouvements > tfoot').html(footer);
</script>