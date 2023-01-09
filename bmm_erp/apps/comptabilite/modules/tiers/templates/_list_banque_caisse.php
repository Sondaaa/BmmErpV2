<?php if ($pager->count() == 0): ?>
    <tr>
        <td class="empty_list" colspan="5">Liste des banques et caisses vide</td>
    </tr>
<?php endif; ?>
<?php foreach ($pager->getResults() as $compte): ?>
    <tr>
        <td class="td_center"><?php echo $compte->getCodecb() ?></td>
        <td><?php echo $compte->getLibelle() ?></td>
        <td class="td_center">
            <?php
            if ($compte->getType() == 1):
                $nature = "Caisse";
            else:
                if ($compte->getNature() == 1):
                    $nature = "Compte Postal";
                else:
                    $nature = "Compte Bancaire";
                endif;
            endif;
            ?>
            <?php
            echo $nature;
            
            ?>
        </td>
        <td>
            <?php if ($compte->getPlancomptable() != null || $compte->getPlancomptable() != ''): ?>
        <?php echo $compte->getNumerocompte() . ' - ' . $compte->getLibellecompte(); ?>
                <button type="button" class="btn btn-white btn-info btn-sm pull-right" onclick="edit('<?php echo $compte->getId() ?>')" style="text-align: center;">
                    Modifier compte comptable
                    <i class="ace-icon fa fa-edit icon-on-right bigger-110"></i>
                </button> 
    <?php else: ?>
                <button type="button" class="btn btn-white btn-info btn-sm" onclick="edit('<?php echo $compte->getId() ?>')" style="text-align: center;">
                    Ajouter compte comptable
                    <i class="ace-icon fa fa-edit icon-on-right bigger-110"></i>
                </button>
    <?php endif; ?>
        </td>
        <td class="td_center">
            <button type="button" class="btn btn-white btn-default btn-sm" onclick="show('<?php echo $compte->getId() ?>')" style="text-align: center;">
                Afficher
                <i class="ace-icon fa fa-eye icon-on-right bigger-110"></i>
            </button>
        </td>
    </tr>
<?php endforeach; ?>

<script  type="text/javascript">
    var footer = '';
<?php if ($pager->haveToPaginate()): ?>
        footer = '<tr>' +
                '<td style ="padding: 0px;" colspan ="5">' +
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
                '<td style ="padding: 0px;" colspan ="5">' +
                '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                '<div class ="col-xs-12">' +
                '</div>' +
                '</div>' +
                '</td>' +
                '</tr>';
<?php endif; ?>
    $('#list_banque_caisse > tfoot').html(footer);
</script>

<style>

    .empty_list{text-align:center; font-weight: bold; font-size: 20px !important; padding: 90px !important;}
    .td_center{text-align: center;}
    #code_client{text-align: center;}
    #list_client tbody tr td{vertical-align: middle;}

</style>