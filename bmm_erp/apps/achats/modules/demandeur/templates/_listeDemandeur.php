<?php if (count($pager) == 0): ?>
    <tr>
        <td style=" vertical-align: middle; text-align:center; font-weight: bold; font-size: 18px !important; height: 150px;" colspan="8">Liste des Demandeurs Vide</td>
    </tr>
<?php endif; ?>
<?php foreach ($pager->getResults() as $demandeur): ?>
    <tr>
        <td class="sf_admin_text sf_admin_list_td_id_agents"  style="text-align: left;" >
            <?php echo $demandeur->getLibelle() ?>
        </td>
        <td class="sf_admin_text sf_admin_list_td_dateemposte"  style="text-align: left;">
            <?php echo $demandeur->getAgents() ?>
        </td>
        <td class="sf_admin_text sf_admin_list_td_dateemposte"  style="text-align: left;">
            <?php echo $demandeur->getAgents()->getRegroupementagents()->getLibelle() ?>
        </td>
        <td class="sf_admin_text sf_admin_list_td_id_fonction"  style="text-align: left;">
            <?php
            $demandeur_contrat = DemandeurTable::getInstance()->getContrat($demandeur->getId());
//            die(count($demandeur_contrat));
            if ($demandeur->getIdAgent() && count($demandeur_contrat) >= 1):
                echo $demandeur->getAgents()->getContrat()->getFirst()->getPosterh()->getUnite()->getLibelle();
            else:
                echo '';
                ?>
            <?php endif; ?>
        </td>

        <td class="sf_admin_text sf_admin_list_td_regroupementagents" style="text-align: left;" >
            <?php
            if ($demandeur->getIdAgent() && count($demandeur_contrat) >= 1):
                echo $demandeur->getAgents()->getContrat()->getFirst()->getPosterh()->getUnite()->getServicerh()->getLibelle();
            else:
                echo '';
                ?>
            <?php endif; ?>

        </td>
        <td class="sf_admin_text sf_admin_list_td_regroupementagents" style="text-align: left;" >
            <?php
            if ($demandeur->getIdAgent() && count($demandeur_contrat) >= 1):
                echo $demandeur->getAgents()->getContrat()->getFirst()->getPosterh()->getUnite()->getServicerh()->getSousdirection()->getLibelle();
            else:
                echo '';
                ?>
            <?php endif; ?>

        </td>
        <td class="sf_admin_text sf_admin_list_td_regroupementagents" style="text-align: left;" >
            <?php
            if ($demandeur->getIdAgent() && count($demandeur_contrat) >= 1):
                echo $demandeur->getAgents()->getContrat()->getFirst()->getPosterh()->getUnite()->getServicerh()->getSousdirection()->getDirection()->getLibelle();
            else:
                echo '';
                ?>
            <?php endif; ?>          

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
                                                    <button type="button" onclick="document.location.href = '<?php  echo url_for('demadeur/edit') . '?id=' . $demandeur->getId()     ?>'"  class="btn btn-primary width-fixed" >
                                                        <i class="ace-icon fa fa-edit bigger-110"></i>Modifier Fiche </button>
                                                </li>
                        <li> 
                            <button onclick="if (confirm('Etes-vous s??r?')) {
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
                                        return false;" 
                                    type="button" class="btn  btn-outline btn-primary " ><i class="fa fa-bitbucket"></i>  Supprimer  </button>
                        </li>
                        <li>
                            <a target="_blanc" class="btn btn-outline btn-success " style="width: 100px" href="<?php echo url_for('demandeur/Imprimerfichedemandeur?iddemandeur=' . $demandeur->getId()) ?>">Fiche demandeur</a>
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
                '<td style ="padding: 0px;" colspan ="8">' +
                '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                '<div class ="col-xs-12" >' +
                '<div class ="dataTables_paginate paging_simple_numbers" id ="dynamic-table_paginate">' +
                '<ul class ="pagination">' +
    <?php if ($pager->getPage() == 1): ?>
            '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-double-left"></i> Premi??re </a></li>' +
                    '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-left"></i> Pr??c??dente </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPage(\'1\')"> <i class="ace-icon fa fa-angle-double-left"></i> Premi??re </a></li>' +
                    '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPage(\'<?php echo $pager->getPreviousPage() ?>\')"> <i class="ace-icon fa fa-angle-left"></i> Pr??c??dente </a></li>' +
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
                    '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> <i class="ace-icon fa fa-angle-double-right"></i> Derni??re </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPage(\'<?php echo $pager->getNextPage() ?>\')"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPage(\'<?php echo $pager->getLastPage() ?>\')"> Derni??re <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
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
    $('#listDemandeur > tfoot').html(footer);
</script>

<style>

    #listDemandeur tbody td{vertical-align: middle; text-align: center;}

</style>