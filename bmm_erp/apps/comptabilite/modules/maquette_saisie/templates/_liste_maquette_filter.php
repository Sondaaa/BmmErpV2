<?php if (count($pager) == 0): ?>
    <tr>
        <td style="text-align:center; " colspan="7">Liste des Maquettes Vide</td>
    </tr>
<?php endif; ?>

<?php foreach ($pager->getResults() as $i => $maquette): ?>
    <tr id="lignemaq_<?php echo $i ?>" onclick="ChoisirMaquette(<?php echo $maquette->getId() ?>)" index_ligne="<?php echo $i ?>" ondblclick="showMaquette('<?php echo $maquette->getId() ?>')">
        <td><input type="checkbox" class="form_control"  name="maqu_chek" id="select_maq_<?php echo $maquette->getId() ?>"  onclick="ChoisirMaquette(<?php echo $maquette->getId() ?>)"></td>
        <td name="ligne_code" style="text-align: center;"><?php echo $maquette->getCode() ?></td>
        <td ><?php echo $maquette->getLibelle() ?></td>
        <td name="ligne_journal" style="text-align: left; padding-left: 1%;"><?php echo $maquette->getJournalcomptable()->getLibelle() ?></td>
        <td name="ligne_nature" style="text-align: center;"><?php echo $maquette->getNaturepiece()->getLibelle() ?></td>
        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($maquette->getDate())) ?></td>
        <td name="ligne_user" style="text-align: center;">
            <?php echo $maquette->getUtilisateur()->getAgents() ?>
        </td>
        <td style="cursor: pointer; text-align: center;">
            <span class="btn-group">
                <a title="Afficher" onclick="showMaquette('<?php echo $maquette->getId() ?>')" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-eye icon-only"></i></a>
<!--                <a title="Modifier" target="_blank" href="<?php // echo url_for('maquette_saisie/showEdit?id=' . $maquette->getId()) ?>" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-pencil-square-o icon-only"></i></a>
                <a title="Supprimer" onclick="openPopupSupprimer(<?php //echo $maquette->getId() ?>)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-trash icon-only"></i></a>-->
            </span>
        </td>
    </tr>
<?php endforeach; ?>

<script  type="text/javascript">
    var footer = '';
    $('#listMaquette_footer').html('');
<?php if ($pager->haveToPaginate()): ?>
        footer = '<tr>'+
    '<td class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">'+
    '<input type="checkbox" class="form_control"  disabled=""></td>' +
                '<td style ="padding: 0px;" colspan ="7">' +
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
                    '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Dernière <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
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
                '<td><input type="checkbox" class="form_control"  disabled=""></td>'+
    '<td style ="padding: 0px;" colspan ="7">' +
                '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                '<div class ="col-xs-12">' +
                '</div>' +
                '</div>' +
                '</td>' +
                '</tr>';
<?php endif; ?>

    $('#listMaquette_footer').html(footer);

</script>