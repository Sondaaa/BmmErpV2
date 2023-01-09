<?php if (count($pager) == 0): ?>
    <tr>
        <td style=" vertical-align: middle; text-align:center; font-weight: bold; font-size: 18px !important; height: 150px;" colspan="10">Liste des journaux Vide</td>
    </tr>
<?php endif; ?>
<?php foreach ($pager->getResults() as $journal): ?>
    <tr>
        <td><?php echo $journal->getCode() ?></td>
        <td style="text-align: left; padding-left: 1%;"><?php echo $journal->getLibelle() ?></td>
        <td>
            <?php
            $num = $journal->getNumerotation();
            if ($num == 1)
                echo 'Annuel';
            if ($num == 2)
                echo 'Mensuel';
            if ($num == 3)
                echo 'Journalier';
            ?>
        </td>
        <td><?php echo $journal->getTypejournal()->getLibelle() ?></td>
        <td><?php echo $journal->getExercice()->getLibelle() ?></td>
        <td>
            <?php if ($journal->getIsbloque() == 1): ?>
                <i class="ace-icon fa fa-check-square-o bigger-170" onclick="bloquerJournal('<?php echo $journal->getId() ?>')" style="cursor: pointer;"></i>
            <?php else: ?>
                <i class="ace-icon fa fa-square-o bigger-170" onclick="bloquerJournal('<?php echo $journal->getId() ?>')" style="cursor: pointer;"></i>
            <?php endif; ?>
            <input type="hidden" id="bloque_journal_<?php echo $journal->getId() ?>" value="<?php echo $journal->getIsbloque(); ?>" />
        </td>
        <td>
            <?php if ($journal->getIsvalide() == 1): ?>
                <i class="ace-icon fa fa-check-square-o bigger-170" onclick="validerJournal('<?php echo $journal->getId() ?>')" style="cursor: pointer;"></i>
            <?php else: ?>
                <i class="ace-icon fa fa-square-o bigger-170" onclick="validerJournal('<?php echo $journal->getId() ?>')" style="cursor: pointer"></i>
            <?php endif; ?>
            <input type="hidden" id="valide_journal_<?php echo $journal->getId() ?>" value="<?php echo $journal->getIsvalide(); ?>" />
        </td>
        <td>
            <button class="btn btn-primary btn-sm" onclick="listePlan(<?php echo $journal->getId() ?>)">
                <?php echo count($journal->getSouscomptejournal()); ?>
            </button>
        </td>
        <td>
            <button class="btn btn-success btn-sm" onclick="listeNumSerie(<?php echo $journal->getId() ?>)">
                <?php echo count($journal->getNumeroseriejournal()); ?>
            </button>
        </td>
        <td>
            <button type="button" class="btn btn-white btn-default btn-sm" onclick="showJournal('<?php echo $journal->getId() ?>')">
                <i class="ace-icon fa fa-eye bigger-110 icon-only"></i>
            </button>
            <a type="button" class="btn btn-white btn-info btn-sm" href="<?php echo url_for('@showEditJournal?id=' . $journal->getId()) ?>"><i class="ace-icon fa fa-edit bigger-110 icon-only"></i></a>
            <?php if ($journal->getIsValide() == 0 && $journal->getPiececomptable()->count() == 0): ?>
                <button type="button" class="btn btn-white btn-danger btn-sm" onclick="supprimer('<?php echo $journal->getId() ?>')">
                    <i class="ace-icon fa fa-remove bigger-110 icon-only"></i>
                </button>
            <?php endif; ?>
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
    $('#listJournal > tfoot').html(footer);
</script>

<style>

    #listJournal tbody td{vertical-align: middle; text-align: center;}

</style>