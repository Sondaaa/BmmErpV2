<?php if (count($pager) == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="8">Liste des Pièces Vide</td>
    </tr>
<?php endif; ?>

<?php foreach ($pager->getResults() as $i => $piece): ?>
    <tr id="ligne_<?php echo $i ?>" onclick="formatLigne(<?php echo $i ?>)" index_ligne="<?php echo $i ?>" ondblclick="showPiece('<?php echo $piece->getId() ?>')">

        <td name="ligne_journal" class="" style="text-align: left; padding-left: 1%;"><?php echo $piece->getJournalcomptable()->getLibelle() ?></td>
        <td name="ligne_date" class="" style="text-align: center;"><?php echo date('d/m/Y', strtotime($piece->getDate())) ?></td>
        <td name="ligne_numero" class="" style="text-align: center;"><?php echo $piece->getNumero() ?></td>
        <td name="ligne_numero" class="" style="text-align: center;">
            <a class="brown" id="show-option" href="#" title="Rénuméroter Le : <?php echo date('d/m/Y', strtotime($piece->getDaterenumerotation())) ?>">
                <i class="ace-icon fa fa-refresh"></i>
                <?php echo $piece->getAnciennumero() ?>
            </a>
        </td>
        <td style="text-align: center;"><?php echo $piece->getTotalDebit() ?></td>
        <td style="text-align: center;"><?php echo $piece->getTotalCredit() ?></td>
        <td name="ligne_user" style="text-align: center;">
            <a class="blue" id="show-option" href="#" title="Saisie Le : <?php echo date('d/m/Y', strtotime($piece->getDatecreation())) ?>">
                <i class="ace-icon fa fa-hand-o-right"></i>
                <?php echo $piece->getUtilisateur() ?>
            </a>
        </td>
        <td style="text-align: center;">
            <button title="Afficher" onclick="showPiece('<?php echo $piece->getId() ?>')" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-eye"></i></button>
            <button title="Proprieté" onclick="showProprietePiece('<?php echo $piece->getId() ?>')" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-cog"></i></button>
        </td>
    </tr>
<?php endforeach; ?>

<script  type="text/javascript">
    var footer = '';
<?php if ($pager->haveToPaginate()): ?>
        footer = '<tr>' +
                '<td style ="padding: 0px;" colspan ="10">' +
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
                '<td style ="padding: 0px;" colspan ="10">' +
                '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                '<div class ="col-xs-12">' +
                '</div>' +
                '</div>' +
                '</td>' +
                '</tr>';
<?php endif; ?>
    $('#listPiece > tfoot').html(footer);
</script>

<script  type="text/javascript">
    
    $(document).ready(function () {
        //tooltips
        $(".blue").tooltip({
            show: {
                effect: "slideDown",
                delay: 250
            }
        });
        
        $(".brown").tooltip({
            show: {
                effect: "slideDown",
                delay: 250
            }
        });
    });

</script>