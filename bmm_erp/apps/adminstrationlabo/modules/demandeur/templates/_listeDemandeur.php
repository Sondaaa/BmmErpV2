<?php //die( $sf_user->getAttribute('userB2m')."e");
 if ($sf_user->isAuthenticated())
    //$user = $sf_user->UserConnected(); 
    $user=$sf_user->getAttribute('userB2m');
     ?>
<?php if (count($pager) == 0) : ?>
    <tr>
        <td style=" vertical-align: middle; text-align:center; font-weight: bold; font-size: 18px !important; height: 150px;" colspan="3">Liste des Demandeurs Vide</td>
    </tr>
<?php endif; ?>
<?php foreach ($pager->getResults() as $demandeur) : ?>
    <tr>
        <td class="sf_admin_text sf_admin_list_td_id_agents" style="text-align: left;">
            <?php echo $demandeur->getLibelle() ?>
        </td>
        <td class="sf_admin_text sf_admin_list_td_dateemposte" style="text-align: left;">
            <?php echo $demandeur->getAgents() ?>
        </td>
        <td class="sf_admin_text sf_admin_list_td_dateemposte" style="text-align: left;">
            <?php echo $demandeur->getProjet() ?>
        </td>
        <td style="cursor: pointer; text-align: center;">
            <span class="btn-group">

                <a style="margin-right: 10px;" target="_blank" title="Imprimer" type="button" onclick="Printdemandeur(<?php echo $demandeur->getId(); ?>)" class="btn btn-primary btn-xs"><i class="ace-icon fa fa-print"></i></a>
                <?php if ($demandeur->getIdUser() == $user->getId()) : ?>
                    <a style="margin-right: 10px;" title="Modifier Fiche" type="button" onclick="document.location.href = '<?php echo url_for('demandeur') . '/' . $demandeur->getId() . '/edit'; ?>'" class="btn btn-warning btn-xs">
                        <i class="ace-icon fa fa-pencil"></i></a>
                    <a onclick="if (confirm('Etes-vous sûr?')) {
                                            var f = document.createElement('form');
                                            f.style.display = 'none';
                                            this.parentNode.appendChild(f);
                                            f.method = 'post';
                                            f.action = 'demandeur/delete?id=<?php echo $demandeur->getId() ?>';
                                            var m = document.createElement('input');
                                            m.setAttribute('type', 'hidden');
                                            m.setAttribute('name', 'sf_method');
                                            m.setAttribute('value', 'delete');
                                            f.appendChild(m);
                                            f.submit();
                                        }
                                        ;
                                        return false;" type="button" style="min-width: 145x;max-width: 145px;" class="btn btn-xs btn-danger btn-xs">
                        <i class="ace-icon fa fa-trash"></i></a>





                <?php endif; ?> </span>
        </td>
    </tr>
<?php endforeach; ?>

<script type="text/javascript">
    var footer = '';
    <?php if ($pager->haveToPaginate()) : ?>
        footer = '<tr>' +
            '<td style ="padding: 0px;" colspan ="8">' +
            '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
            '<div class ="col-xs-12" >' +
            '<div class ="dataTables_paginate paging_simple_numbers" id ="dynamic-table_paginate">' +
            '<ul class ="pagination">' +
            <?php if ($pager->getPage() == 1) : ?> '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
            <?php else : ?> '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPage(\'1\')"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPage(\'<?php echo $pager->getPreviousPage() ?>\')"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
            <?php endif; ?>
        <?php foreach ($pager->getLinks() as $page) : ?>
            <?php if ($page == $pager->getPage()) : ?>
                    '<li class ="paginate_button active" aria-controls ="dynamic-table" tabindex ="0"> <a href = "#"> <?php echo $page ?> </a></li>' +
                <?php else : ?> '<li class ="paginate_button" aria-controls ="dynamic-table" tabindex ="0"> <a onclick="goPage(\'<?php echo $page ?>\')"> <?php echo $page ?> </a></li>' +
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if ($pager->getPage() == $pager->getLastPage()) : ?>
                    '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> <i class="ace-icon fa fa-angle-double-right"></i> Dernière </a></li>' +
                <?php else : ?> '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPage(\'<?php echo $pager->getNextPage() ?>\')"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPage(\'<?php echo $pager->getLastPage() ?>\')"> Dernière <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
                <?php endif; ?> '</ul>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</td>' +
                '</tr>';
            <?php else : ?>
                footer = '<tr>' +
                    '<td style ="padding: 0px;" colspan ="10">' +
                    '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                    '<div class ="col-xs-12">' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    '</tr>';
            <?php endif; ?>
            $('#listDemandeur > tfoot').html(footer);
</script>

<style>
    #listDemandeur tbody td {
        vertical-align: middle;
        text-align: center;
    }
</style>