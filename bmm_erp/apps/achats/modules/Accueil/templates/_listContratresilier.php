<?php if ($contrat_resilier->count() == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 14px !important;" colspan="5">Liste des Contrats provisoire vide</td>
    </tr>
<?php endif; ?>
<?php foreach ($contrat_resilier->getResults() as $bci): ?>
    <tr>
        <td style="text-align: left;">
            <a href="<?php echo url_for('contratachat/showResilie?iddoc=') . $bci->getId() ?>" target="_blank">
                <?php echo $bci->getContratachat()->getReference() . ' N° '.$bci->getContratachat()->getNumero(); ?>
            </a>
        </td>
        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($bci->getContratachat()->getDatecreation())); ?></td>
       <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($bci->getDateresiliation())); ?></td>
        
       <td style="text-align: left;"><?php echo html_entity_decode($bci->getMotifresiliattion()); ?></td>
           <td style="text-align: right;"><?php echo number_format($bci->getMontantconsomme(), 3, '.', ' ') ?></td>
       <td style="text-align: right;"><?php echo number_format($bci->getMontantrestant(), 3, '.', ' ') ?></td>
   
    </tr>
<?php endforeach; ?>

<script>
    var footer = '';
<?php if ($contrat_resilier->haveToPaginate()): ?>
        footer = '<tr>' +
                '<td style ="padding: 0px;" colspan ="6">' +
                '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                '<div class ="col-xs-12" style="padding-left: 5px; padding-right: 5px;">' +
                '<div class ="dataTables_paginate paging_simple_numbers" id ="dynamic-table_paginate">' +
                '<ul class ="pagination">' +
    <?php if ($contrat_resilier->getPage() == 1): ?>
            '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                    '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPageContratResiliser(\'1\')"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                    '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPageContratResiliser(\'<?php echo $contrat_resilier->getPreviousPage() ?>\')"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
    <?php endif; ?>
    <?php foreach ($contrat_resilier->getLinks() as $page): ?>
        <?php if ($page == $contrat_resilier->getPage()): ?>
                '<li class ="paginate_button active" aria-controls ="dynamic-table" tabindex ="0"> <a href = "#"> <?php echo $page ?> </a></li>' +
        <?php else: ?>
                '<li class ="paginate_button" aria-controls ="dynamic-table" tabindex ="0"> <a onclick="goPageContratResiliser(\'<?php echo $page ?>\')"> <?php echo $page ?> </a></li>' +
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if ($contrat_resilier->getPage() == $contrat_resilier->getLastPage()): ?>
            '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> <i class="ace-icon fa fa-angle-double-right"></i> Dernière </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPageContratResiliser(\'<?php echo $contrat_resilier->getNextPage() ?>\')"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPageContratResiliser(\'<?php echo $contrat_resilier->getLastPage() ?>\')"> Dernière <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
    <?php endif; ?>
        '</ul>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</td>' +
                '</tr>';
<?php else: ?>
        footer = '<tr>' +
                '<td style ="padding: 0px;" colspan ="6">' +
                '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                '<div class ="col-xs-12">' +
                '</div>' +
                '</div>' +
                '</td>' +
                '</tr>';
<?php endif; ?>
    $('#contrat_resilier > tfoot').html(footer);
</script>

<style>

    #contrat_resilier tbody td{vertical-align: middle;}

</style>