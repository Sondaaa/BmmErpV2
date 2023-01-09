<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Résultat de recherche
            <a target="_blanc" href="<?php echo url_for('mouvementbanciare/ImprimerSearchMouvementBanque?date_debut=' . $date_debut . '&date_fin=' . $date_fin . '&id_banque=' . $id_banque) ?>" class="btn btn-sm btn-success" style="float: right; padding: 5px 9px;">
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
                                <th>N°</th>
                                <th style="width: 200px">date</th>
                                <th style="width: 200px">Réf.Ordonnancement</th>
                                <th style="width: 200px">Nom d'opération</th>
                                <th style="width: 200px">Bénéficiaire</th>
                                <th style="width: 200px">N°.Chèque</th>
                                <th style="width: 200px">Débit</th>
                                <th style="width: 200px">Crédit</th>
                                <th style="width: 200px">Opération</th>
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                        <tbody>
                            <?php if ($pager->count() == 0): ?>
                                <tr>
                                    <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="8">Pas de mouvements</td>
                                </tr>
                            <?php endif; ?>
                            <?php foreach ($pager->getResults() as $mvt): ?>
                                <tr>
                                    <td><?php echo $mvt->getNumero(); ?></td>
                                    <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($mvt->getDateoperation())); ?></td>
                                    <td style="text-align: center;">
                                        <?php if ($mvt->getIdDocumentbudget() != null): ?>
                                            <a target="_blank" href="<?php echo url_for('mouvementbanciare/etatordonnance?id=' . $mvt->getIdDocumentbudget()) ?>">
                                                <?php echo $mvt->getReford(); ?>
                                            </a>
                                        <?php else: ?>
                                            <?php echo $mvt->getReford(); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $mvt->getNomoperation(); ?></td>
                                    <td><?php echo $mvt->getRibbeni(); ?><br><?php echo $mvt->getRefbenifi(); ?></td>
                                    <td><?php echo $mvt->getInstrumentpaiment()->getLibelle(); ?><br><?php echo $mvt->getPapiercheque()->getRefpapier(); ?></td>
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
                                        <?php if ($mvt->getIdBordereauvirement() == null): ?>
                                            <?php
                                            if ($mvt->getIdCheque() != null):
                                                $id_cheque = $mvt->getIdCheque();
                                                $numero = $mvt->getPapiercheque()->getRefpapier();
                                            else:
                                                $id_cheque = 0;
                                                $numero = '';
                                            endif;

                                            $relation_existe = 0;
                                            if ($mvt->getIdMouvement() != null):
                                                $relation_existe = 1;
                                                if ($numero == ''):
                                                    $mouvement_parent = MouvementbanciareTable::getInstance()->find($mvt->getIdMouvement());
                                                    if ($mouvement_parent->getIdCheque() != null):
                                                        $id_cheque = $mouvement_parent->getIdCheque();
                                                        $numero = $mouvement_parent->getPapiercheque()->getRefpapier();
                                                    endif;
                                                endif;
                                            else:
                                                $mouvement_fils = MouvementbanciareTable::getInstance()->findOneByIdMouvement($mvt->getId());
                                                if ($mouvement_fils != null):
                                                    $relation_existe = 1;
                                                endif;
                                            endif;
                                            ?>
                                            <button class="btn btn-danger" type="button" onclick="supprimerMouvement('<?php echo $mvt->getId(); ?>', <?php echo $id_cheque; ?>, '<?php echo $numero; ?>', <?php echo $relation_existe ?>)">
                                                <i class="ace-icon fa fa-remove bigger-110"></i>
                                                Supprimer
                                            </button>
                                        <?php else: ?>
                                            <a style="cursor: pointer;" onclick="showBordereau('<?php echo $mvt->getBordereauvirement()->getId() ?>')">
                                                <i class="ace-icon fa fa-hand-o-right bigger-110"></i> Bordereau : <br><?php echo $mvt->getBordereauvirement()->getDate() ?>
                                            </a>
                                        <?php endif; ?>
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