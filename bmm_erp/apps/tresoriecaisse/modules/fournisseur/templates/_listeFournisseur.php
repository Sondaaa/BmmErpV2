<?php if (count($pager) == 0): ?>
    <tr>
        <td style=" vertical-align: middle; text-align:center; font-weight: bold; font-size: 18px !important; height: 150px;" colspan="6">Liste des Fournisseurs Vide</td>
    </tr>
<?php endif; ?>
<?php foreach ($pager->getResults() as $fournisseur): ?>
    <tr>
        <td class="sf_admin_text sf_admin_list_td_idrh" style="text-align: center;">
            <?php echo $fournisseur->getCodefrs() ?>
        </td>
        <td class="sf_admin_text sf_admin_list_td_nomcomplet">
            <?php echo $fournisseur->getNfiche() ?>
        </td>
        <td class="sf_admin_text sf_admin_list_td_nomcomplet">
            <?php echo $fournisseur->getReference() ?>
        </td>
        <td class="sf_admin_text sf_admin_list_td_nomcomplet">
            <?php echo $fournisseur->getRs() ?>
        </td>
        <td class="sf_admin_text sf_admin_list_td_nomcomplet">
            <?php echo $fournisseur->getTel() ?>
        </td>
        <td class="sf_admin_text sf_admin_list_td_nomcomplet">
            <?php echo $fournisseur->getMail() ?>
        </td>
        <td class="sf_admin_text sf_admin_list_td_prenom">
            <?php echo $fournisseur->getFamilleartfrs() ?>
        </td>
        <td class="sf_admin_text sf_admin_list_td_cin" style="text-align: center;">
            <?php echo $fournisseur->getActivitetiers() ?>
        </td>
        <td class="sf_admin_text sf_admin_list_td_cin" style="text-align: center;">
            <?php echo $fournisseur->getPlancomptable() ?>
        </td>
        <td class="sf_admin_text sf_admin_list_td_regroupementagents" style="text-align: center;display: none" >
            <?php echo $fournisseur->getEtatfrs() ?>
        </td>
        <td style="text-align: center;">
            <div class="btn-toolbar">
                <div class="btn-group" id="btnaction">
                    <button  data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                        Action
                        <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <?php // echo $helper->linkToEdit($fournisseur, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
                        <li>
                            <button type="button" onclick="document.location.href = '<?php echo url_for('fournisseur/edit') . '?id=' . $fournisseur->getId()      ?>'"  class="btn btn-primary width-fixed" >
                                <i class="ace-icon fa fa-edit bigger-110"></i>Modifier Fiche </button>
                        </li>
                        <?php //echo $helper->linkToDelete($fournisseur, array(  'params' =>   array(  ),  'confirm' => 'Êtes-vous sûr ?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
                        <li class="sf_admin_action_affect <?php if ($sf_user->getAttribute('userB2m')->getAcceesDroit("achat_et_validation_frs")) echo 'disabledbutton' ?>"><a  href="<?php echo url_for('reclamationfrs/new?idfrs=') . $fournisseur->getId() ?>"><i class="ace-icon fa fa-commenting-o"></i> Réclamer au fournisseur</a></li>
                        <li>
                            <a target="_blanc" class="btn btn-xs btn-success " style="width: 150px" href="<?php echo url_for('fournisseur/ImprimerficheFournisseur?idfrs=' . $fournisseur->getId()) ?>"><i class="ace-icon fa fa-eye"></i> Fiche Fournisseur</a>
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
    $('#listFournisserus > tfoot').html(footer);
</script>

<style>

    #listFournisserus tbody td{vertical-align: middle; text-align: center;}

</style>