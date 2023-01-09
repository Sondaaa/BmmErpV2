<?php if ($bci_without_visa->count() == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 14px !important;" colspan="5">Liste des B.C.I.M.P sans Visa vide</td>
    </tr>
<?php endif; ?>
<?php foreach ($bci_without_visa->getResults() as $bci): ?>
    <tr>
        <td style="text-align: center;">
            <a href="<?php echo url_for('documentachat/showdocument?iddoc=') . $bci->getId() ?>" target="_blank">
                <?php echo str_pad($bci->getNumero(), 5, '0', STR_PAD_LEFT); ?>
            </a>
        </td>
        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($bci->getDatecreation())); ?></td>
        <td style="text-align: center;">
            <a href="<?php echo url_for('documentachat/showdocument?iddoc=') . $bci->getId() ?>" target="_blank">
                <?php echo $bci->getReference(); ?>
            </a>
        </td>
        <td><?php echo $bci->getAgents(); ?></td>
        <td style="text-align: right;"><?php echo number_format($bci->getMontantestimatif(), '3', '.', ' '); ?></td>
    </tr>
<?php endforeach; ?>

<script>
    var footer = '';
<?php if ($bci_without_visa->haveToPaginate()): ?>
        footer = '<tr>' +
                '<td style ="padding: 0px;" colspan ="5">' +
                '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                '<div class ="col-xs-12" style="padding-left: 5px; padding-right: 5px;">' +
                '<div class ="dataTables_paginate paging_simple_numbers" id ="dynamic-table_paginate">' +
                '<ul class ="pagination">' +
    <?php if ($bci_without_visa->getPage() == 1): ?>
            '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                    '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPageBciWithoutVisa(\'1\')"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                    '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPageBciWithoutVisa(\'<?php echo $bci_without_visa->getPreviousPage() ?>\')"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
    <?php endif; ?>
    <?php foreach ($bci_without_visa->getLinks() as $page): ?>
        <?php if ($page == $bci_without_visa->getPage()): ?>
                '<li class ="paginate_button active" aria-controls ="dynamic-table" tabindex ="0"> <a href = "#"> <?php echo $page ?> </a></li>' +
        <?php else: ?>
                '<li class ="paginate_button" aria-controls ="dynamic-table" tabindex ="0"> <a onclick="goPageBciWithoutVisa(\'<?php echo $page ?>\')"> <?php echo $page ?> </a></li>' +
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if ($bci_without_visa->getPage() == $bci_without_visa->getLastPage()): ?>
            '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> <i class="ace-icon fa fa-angle-double-right"></i> Dernière </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPageBciWithoutVisa(\'<?php echo $bci_without_visa->getNextPage() ?>\')"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPageBciWithoutVisa(\'<?php echo $bci_without_visa->getLastPage() ?>\')"> Dernière <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
    <?php endif; ?>
        '</ul>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</td>' +
                '</tr>';
<?php else: ?>
        footer = '<tr>' +
                '<td style ="padding: 0px;" colspan ="5">' +
                '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                '<div class ="col-xs-12">' +
                '</div>' +
                '</div>' +
                '</td>' +
                '</tr>';
<?php endif; ?>
    $('#bcimp_without_visa > tfoot').html(footer);
</script>

<style>

    #bcimp_without_visa tbody td{vertical-align: middle;}

</style>