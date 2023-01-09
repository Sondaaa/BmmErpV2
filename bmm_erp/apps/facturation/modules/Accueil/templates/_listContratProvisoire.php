<?php if ($contrat_provisoire->count() == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 14px !important;" colspan="5">Liste des Contrats Provisoires vide</td>
    </tr>
<?php endif; ?>
<?php foreach ($contrat_provisoire->getResults() as $boncomm): ?>
    <tr>
        <td style="text-align: center;">
          <?php include_partial('tddetaildocachat', array('boncomm' => $boncomm)); ?>
        </td>
        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($boncomm->getDatecreation())) ?></td> 
        <td style="text-align: center;"><?php
                                        if (sizeof($boncomm->getDocumentachat()) >= 1)
                                            echo $boncomm->getDocumentachat()->getFirst()->getNumerodocumentachat(); ?></td>
       <td style="text-align: center;"><?php echo $boncomm->getFournisseur()->getRs(); ?></td>
        
       <td style="text-align: right;"><?php echo number_format($boncomm->getMontantcontrat(), 3, '.', ' ') ?></td>
       
    </tr>
<?php endforeach; ?>

<script>
    var footer = '';
<?php if ($contrat_provisoire->haveToPaginate()): ?>
        footer = '<tr>' +
                '<td style ="padding: 0px;" colspan ="5">' +
                '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                '<div class ="col-xs-12" style="padding-left: 5px; padding-right: 5px;">' +
                '<div class ="dataTables_paginate paging_simple_numbers" id ="dynamic-table_paginate">' +
                '<ul class ="pagination">' +
    <?php if ($contrat_provisoire->getPage() == 1): ?>
            '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                    '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPageContratProvisoir(\'1\')"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                    '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPageContratProvisoir(\'<?php echo $contrat_provisoire->getPreviousPage() ?>\')"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
    <?php endif; ?>
    <?php foreach ($contrat_provisoire->getLinks() as $page): ?>
        <?php if ($page == $contrat_provisoire->getPage()): ?>
                '<li class ="paginate_button active" aria-controls ="dynamic-table" tabindex ="0"> <a href = "#"> <?php echo $page ?> </a></li>' +
        <?php else: ?>
                '<li class ="paginate_button" aria-controls ="dynamic-table" tabindex ="0"> <a onclick="goPageContratProvisoir(\'<?php echo $page ?>\')"> <?php echo $page ?> </a></li>' +
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if ($contrat_provisoire->getPage() == $contrat_provisoire->getLastPage()): ?>
            '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> <i class="ace-icon fa fa-angle-double-right"></i> Dernière </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPageContratProvisoir(\'<?php echo $contrat_provisoire->getNextPage() ?>\')"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPageContratProvisoir(\'<?php echo $contrat_provisoire->getLastPage() ?>\')"> Dernière <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
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
    $('#contrat_provisoire > tfoot').html(footer);
</script>

<style>

    #contrat_provisoire tbody td{vertical-align: middle;}

</style>