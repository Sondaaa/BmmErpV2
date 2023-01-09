<?php if (count($pager) == 0): ?>
    <tr>
        <td style=" vertical-align: middle; text-align:center; font-weight: bold; font-size: 18px !important; height: 150px;" colspan="7">Liste des Fiche de Paye Vide</td>
    </tr>
<?php endif; ?>
<?php $array = array("1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre"); ?>
<?php foreach ($pager->getResults() as $paie): ?>
    <tr>
        <td style="width: 20%" class="sf_admin_text sf_admin_list_td_agents">
            <?php echo trim($paie->getAgents()) ?>
        </td>
        <td class="sf_admin_text sf_admin_list_td_mois">
            <?php
            if ($paie->getMois() <= 12):
                echo $array[$paie->getMois()];

            elseif ($paie->getMois() > 12):
                $ligne = Doctrine_Core::getTable('lignesociete')->findOneByCodemois($paie->getMois());
                echo $ligne->getLibelle();
            endif;
            ?>
        </td>

        <td style="text-align: center;" class="sf_admin_text sf_admin_list_td_annee">
            <?php echo $paie->getAnnee() ?>
        </td>
        <td style="text-align: right;" class="sf_admin_text sf_admin_list_td_salaireimposable">
            <?php echo $paie->getSalaireimposable() ?>
        </td>
        <td style="text-align: right;" class="sf_admin_text sf_admin_list_td_salairenet">
            <?php echo $paie->getSalairenet() ?>
        </td>
        <td style="text-align: right;width: 10%" class="sf_admin_text sf_admin_list_td_netapayyer">
            <?php echo $paie->getNetapayyer() ?>
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
                            <button type="button" onclick="document.location.href = '<?php echo url_for('paie/edit') . '?id=' . $paie->getId() ?>'"  class="btn btn-primary width-fixed" >
                                <i class="ace-icon fa fa-edit bigger-110"></i>Afficher Fiche </button>
                        </li>
                        <li> 
                            <button onclick="if (confirm('Etes-vous sûr?')) {
                                        var f = document.createElement('form');
                                        f.style.display = 'none';
                                        this.parentNode.appendChild(f);
                                        f.method = 'post';
                                        f.action = 'paie/delete?id=<?php echo $paie->getId() ?>';
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
                    </ul>
                </div>
            </div>   
        </td>
    </tr>
<?php endforeach; ?>

<script>
    var footer = '';
<?php if ($pager->haveToPaginate()): ?>
        footer = '<tr>' +
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
                '<td style ="padding: 0px;" colspan ="7">' +
                '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                '<div class ="col-xs-12">' +
                '</div>' +
                '</div>' +
                '</td>' +
                '</tr>';
<?php endif; ?>
    $('#listPaie > tfoot').html(footer);
</script>

<style>

    #listFichePaie tbody td{vertical-align: middle; text-align: center;}
    .width-fixed{
        min-width: 172px;
    }
</style>