<?php if (count($pager) == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="9">Pas de B.C.I</td>
    </tr>
<?php else: ?>
    <?php foreach ($pager->getResults() as $doc): ?>
        <?php $avis_budget = $doc->getLigavisdoc(); ?>
        <tr>
            <td><?php echo $doc; ?><br><?php echo date('d/m/Y', strtotime($doc->getDatecreation())); ?></td>
            <td><?php echo $doc->getReference(); ?></td>
            <td style="text-align: center;"><?php echo $doc->getMontantestimatif(); ?></td>

            <td style="background-color: #dff0d8;">
                <?php foreach ($avis_budget as $avis): ?>
                    <?php echo $avis->getAvis(); ?><br>
                    <?php if ($avis->getDatecreation() != ''): ?>
                        (<?php echo date('d/m/Y', strtotime($avis->getDatecreation())); ?>)<br>
                    <?php endif; ?>
                <?php endforeach; ?>
            </td>
            <td style="background-color: #dff0d8;">
                <?php foreach ($avis_budget as $avis): ?>
                    <?php if ($avis->getIdLigprotitrub() != ''): ?>
                        <?php echo $avis->getLigprotitrub(); ?><br>
                    <?php endif; ?>
                <?php endforeach; ?>
            </td>
            <td style="text-align: center; background-color: #dff0d8;">
                <?php foreach ($avis_budget as $avis): ?>
                    <?php echo $avis->getMntdisponible(); ?><br>
                <?php endforeach; ?>
            </td>

            <td><?php echo $doc->getEtatdocument(); ?></td>
            <td style="text-align: center;">
                <?php if ($avis_budget->count() == 0): ?>
                    <a target="_blanc" href="<?php echo url_for('documentachat/rempliretexporter') . '?iddoc=' . $doc->getId() ?>" class="btn btn-sm btn-success" style="padding: 3px 10px; width: 95px;">
                        <i class="ace-icon fa fa-plus bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Visa A.</span>
                    </a>
                <?php endif; ?>
                <a target="_blanc" href="<?php echo url_for('documentachat/showdocument?iddoc=') . $doc->getId() ?>" class="btn btn-sm btn-primary" style="padding: 3px 10px; width: 95px; margin-top: 3px;">
                    <i class="ace-icon fa fa-eye bigger-110"></i>
                    <span class="bigger-110 no-text-shadow">Détails</span>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>

<script  type="text/javascript">
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
    $('#list_bci > tfoot').html(footer);
</script>