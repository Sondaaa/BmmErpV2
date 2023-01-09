<?php if ($contratdefannule->count() == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 14px !important;" colspan="5">Liste des Contrats provisoire vide</td>
    </tr>
<?php endif; ?>
<?php foreach ($contratdefannule->getResults() as $bci): ?>
    <tr>
        <td style="text-align: center;">
            <a href="<?php echo url_for('contratachat/showAnnule?iddoc=') . $bci->getId() ?>" target="_blank">
                <?php echo $bci->getContratachat()->getReference() . ' N° '.$bci->getContratachat()->getNumero(); ?>
            </a>
        </td>
        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($bci->getContratachat()->getDatecreation())); ?></td>
       <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($bci->getDateannulation())); ?></td>
        
       <td style="text-align: left;"><?php echo html_entity_decode($bci->getMotifannulation()); ?></td>
       
    </tr>
<?php endforeach; ?>

<script>
    var footer = '';
<?php if ($contratdefannule->haveToPaginate()): ?>
        footer = '<tr>' +
                '<td style ="padding: 0px;" colspan ="5">' +
                '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                '<div class ="col-xs-12" style="padding-left: 5px; padding-right: 5px;">' +
                '<div class ="dataTables_paginate paging_simple_numbers" id ="dynamic-table_paginate">' +
                '<ul class ="pagination">' +
    <?php if ($contratdefannule->getPage() == 1): ?>
            '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                    '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPageContratDefAnnule(\'1\')"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                    '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPageContratDefAnnule(\'<?php echo $contratdefannule->getPreviousPage() ?>\')"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
    <?php endif; ?>
    <?php foreach ($contratdefannule->getLinks() as $page): ?>
        <?php if ($page == $contratdefannule->getPage()): ?>
                '<li class ="paginate_button active" aria-controls ="dynamic-table" tabindex ="0"> <a href = "#"> <?php echo $page ?> </a></li>' +
        <?php else: ?>
                '<li class ="paginate_button" aria-controls ="dynamic-table" tabindex ="0"> <a onclick="goPageContratDefAnnule(\'<?php echo $page ?>\')"> <?php echo $page ?> </a></li>' +
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if ($contratdefannule->getPage() == $contratdefannule->getLastPage()): ?>
            '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> <i class="ace-icon fa fa-angle-double-right"></i> Dernière </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPageContratDefAnnule(\'<?php echo $contratdefannule->getNextPage() ?>\')"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPageContratDefAnnule(\'<?php echo $contratdefannule->getLastPage() ?>\')"> Dernière <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
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
    $('#contrat_def_annule > tfoot').html(footer);
</script>

<style>

    #contrat_def_annule tbody td{vertical-align: middle;}

</style>