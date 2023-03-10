<?php if ($bci_courant->count() == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 14px !important;" colspan="5">Liste des B.C.I.M.P en cours vide</td>
    </tr>
<?php endif; ?>
<?php foreach ($bci_courant->getResults() as $bci): ?>
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
        <td>
            <a href="<?php echo url_for('marches/ImprimerMarches') . '?id=' . $bci->getMarches()->getFirst()->getId() ?>" target="_blank">
                <?php echo $bci->getMarches()->getFirst(); ?>
            </a>
            <span class="label label-success arrowed-in arrowed-in-right pull-right">
                <?php echo $bci->getMarches()->getFirst()->getLots()->count(); ?>
            </span>
        </td>
        <td style="text-align: right;"><?php echo number_format($bci->getMontantestimatif(), '3', '.', ' '); ?></td>
    </tr>
<?php endforeach; ?>

<script>
    var footer = '';
<?php if ($bci_courant->haveToPaginate()): ?>
        footer = '<tr>' +
                '<td style ="padding: 0px;" colspan ="5">' +
                '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                '<div class ="col-xs-12" style="padding-left: 5px; padding-right: 5px;">' +
                '<div class ="dataTables_paginate paging_simple_numbers" id ="dynamic-table_paginate">' +
                '<ul class ="pagination">' +
    <?php if ($bci_courant->getPage() == 1): ?>
            '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-double-left"></i> Premi??re </a></li>' +
                    '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-left"></i> Pr??c??dente </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPageBciCourant(\'1\')"> <i class="ace-icon fa fa-angle-double-left"></i> Premi??re </a></li>' +
                    '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPageBciCourant(\'<?php echo $bci_courant->getPreviousPage() ?>\')"> <i class="ace-icon fa fa-angle-left"></i> Pr??c??dente </a></li>' +
    <?php endif; ?>
    <?php foreach ($bci_courant->getLinks() as $page): ?>
        <?php if ($page == $bci_courant->getPage()): ?>
                '<li class ="paginate_button active" aria-controls ="dynamic-table" tabindex ="0"> <a href = "#"> <?php echo $page ?> </a></li>' +
        <?php else: ?>
                '<li class ="paginate_button" aria-controls ="dynamic-table" tabindex ="0"> <a onclick="goPageBciCourant(\'<?php echo $page ?>\')"> <?php echo $page ?> </a></li>' +
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if ($bci_courant->getPage() == $bci_courant->getLastPage()): ?>
            '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> <i class="ace-icon fa fa-angle-double-right"></i> Derni??re </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPageBciCourant(\'<?php echo $bci_courant->getNextPage() ?>\')"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPageBciCourant(\'<?php echo $bci_courant->getLastPage() ?>\')"> Derni??re <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
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
    $('#bcimp_courant > tfoot').html(footer);
</script>

<style>

    #bcimp_courant tbody td{vertical-align: middle;}

</style>