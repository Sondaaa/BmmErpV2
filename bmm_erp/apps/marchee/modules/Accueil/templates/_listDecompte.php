<?php if ($decomptes->count() == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 14px !important;" colspan="6">Liste des décomptes en cours vide</td>
    </tr>
<?php endif; ?>
<?php foreach ($decomptes->getResults() as $decompte): ?>
    <tr>
        <td style="text-align: center;">
            <?php if ($decompte->getIdTypedetailprix() == 4): ?>
                <a href="<?php echo url_for('lots/imprimerSeulDecompte') . '?id=' . $decompte->getId() ?>" target="_blank">
                    <span class="label label-primary arrowed-right">
                        <?php
                        if ($decompte->getNumero()):
                            echo $decompte->getNumero();
                        else:
                            echo '#';
                        endif;
                        ?>
                    </span>
                </a>
            <?php else: ?>
                <span class="label label-primary arrowed-right">
                    <?php
                    if ($decompte->getNumero()):
                        echo $decompte->getNumero();
                    else:
                        echo '#';
                    endif;
                    ?>
                </span>
            <?php endif; ?>
        </td>
        <td style="text-align: center;">
            <?php
            $libelle_type = '';
            switch ($decompte->getIdTypedetailprix()):
                case '1':
                    $libelle_type = 'Ouvert';
                    break;
                case '2':
                    $libelle_type = 'Fermé';
                    break;
                case '4':
                    $libelle_type = 'Décompte';
                    break;
                case '3':
                    $libelle_type = 'Avance';
                    break;
            endswitch;
            ?>
            <?php echo $libelle_type; ?>
        </td>
        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($decompte->getDatecreation())); ?></td>
        <td style="text-align: center;">
            <a href="<?php echo url_for('marches/ImprimerMarches') . '?id=' . $decompte->getLots()->getMarches()->getId() ?>" target="_blank">
                <?php echo $decompte->getLots()->getMarches(); ?>
            </a>
        </td>
        <td>
            <a href="<?php echo url_for('lots/Detailsousdetails') . '?id=' . $decompte->getLots()->getId() ?>" target="_blank">
                <?php echo $decompte->getLots()->getFournisseur()->getRs(); ?>
            </a>
        </td>
        <td style="text-align: right;"><?php echo number_format($decompte->getNetapayer(), '3', '.', ' '); ?></td>
    </tr>
<?php endforeach; ?>

<script>
    var footer = '';
<?php if ($decomptes->haveToPaginate()): ?>
        footer = '<tr>' +
                '<td style ="padding: 0px;" colspan ="6">' +
                '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                '<div class ="col-xs-12" style="padding-left: 5px; padding-right: 5px;">' +
                '<div class ="dataTables_paginate paging_simple_numbers" id ="dynamic-table_paginate">' +
                '<ul class ="pagination">' +
    <?php if ($decomptes->getPage() == 1): ?>
            '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                    '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPageDecompte(\'1\')"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                    '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPageDecompte(\'<?php echo $decomptes->getPreviousPage() ?>\')"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
    <?php endif; ?>
    <?php foreach ($decomptes->getLinks() as $page): ?>
        <?php if ($page == $decomptes->getPage()): ?>
                '<li class ="paginate_button active" aria-controls ="dynamic-table" tabindex ="0"> <a href = "#"> <?php echo $page ?> </a></li>' +
        <?php else: ?>
                '<li class ="paginate_button" aria-controls ="dynamic-table" tabindex ="0"> <a onclick="goPageDecompte(\'<?php echo $page ?>\')"> <?php echo $page ?> </a></li>' +
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if ($decomptes->getPage() == $decomptes->getLastPage()): ?>
            '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> <i class="ace-icon fa fa-angle-double-right"></i> Dernière </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPageDecompte(\'<?php echo $decomptes->getNextPage() ?>\')"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPageDecompte(\'<?php echo $decomptes->getLastPage() ?>\')"> Dernière <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
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
    $('#decompte_courant > tfoot').html(footer);
</script>

<style>

    #decompte_courant tbody td{vertical-align: middle;}

</style>