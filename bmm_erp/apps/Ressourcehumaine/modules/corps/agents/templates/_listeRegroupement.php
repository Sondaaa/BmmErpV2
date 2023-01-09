<?php if (count($pager) == 0): ?>
    <tr>
        <td style=" vertical-align: middle; text-align:center; font-weight: bold; font-size: 18px !important; height: 150px;" colspan="6">Liste des agents Vide</td>
    </tr>
<?php endif; ?>
<?php foreach ($pager->getResults() as $agents): ?>
    <tr>
        <td class="sf_admin_text sf_admin_list_td_idrh" style="text-align: center;">
            <?php echo $agents->getIdrh() ?>
        </td>
        <td class="sf_admin_text sf_admin_list_td_nomcomplet">
            <?php echo $agents->getNomcomplet() ?>
        </td>
        <td class="sf_admin_text sf_admin_list_td_prenom">
            <?php echo $agents->getPrenom() ?>
        </td>
        <td class="sf_admin_text sf_admin_list_td_cin" style="text-align: center;">
            <?php echo $agents->getCin() ?>
        </td>
        <td class="sf_admin_text sf_admin_list_td_regroupementagents" style="text-align: center;">
            <?php echo $agents->getRegroupementagents() ?>
        </td>
        <td style="text-align: center;">
            <div class="btn-toolbar">
                <div class="btn-group" id="btnaction">
                    <button  data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                        Action
                        <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <button type="button" onclick="document.location.href = '<?php echo url_for('agents/edit') . '?id=' . $agents->getId() ?>'"  class="btn btn-primary width-fixed" >
                                <i class="ace-icon fa fa-edit bigger-110"></i>Modifier Fiche </button>
                        </li>
                        <li> 
                            <button onclick="if (confirm('Etes-vous sûr?')) {
                                        var f = document.createElement('form');
                                        f.style.display = 'none';
                                        this.parentNode.appendChild(f);
                                        f.method = 'post';
                                        f.action = 'agents/delete?id=<?php echo $agents->getId() ?>';
                                        var m = document.createElement('input');
                                        m.setAttribute('type', 'hidden');
                                        m.setAttribute('name', 'sf_method');
                                        m.setAttribute('value', 'delete');
                                        f.appendChild(m);
                                        f.submit();
                                    }
                                    ;
                                    return false;" type="button" class="btn btn-outline btn-danger width-fixed" ><i class="fa fa-bitbucket"></i>  Supprimer Fiche </button>
                        </li>
                        <li>
                            <a  target="_blanc" class="btn btn-outline btn-success width-fixed" href="<?php echo url_for('agents/imprimerFichepersonnel?iddoc=' . $agents->getId()) ?>">
                                <i class="fa fa-eye"></i>Fiche personnel</a>
                        </li>
                        <li> 
                            <a data-target="#my-modalimpression" role="button" onclick="setImprimeId('<?php echo $agents->getId(); ?>')"  data-toggle="modal" target="_blanc" class="btn btn-outline btn-warning width-fixed">
                                Impression Personnalisée
                            </a>
                        </li>
                    </ul>
                </div>
            </div>   
        </td>
    </tr>
<?php endforeach; ?>

<script  type="text/javascript">
    var footer = '';
<?php if ($pager->haveToPaginate()): ?>
        footer = '<tr>' +
                '<td style ="padding: 0px;" colspan ="6">' +
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
    $('#listAgents > tfoot').html(footer);
</script>

<style>

    #listAgents tbody td{vertical-align: middle; text-align: center;}

</style>