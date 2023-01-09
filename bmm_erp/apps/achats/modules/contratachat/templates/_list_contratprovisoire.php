<?php
$boncommcontrat = new Contratachat();
?>
<?php if (sizeof($pager) == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="9">Liste des Contrats Provisoire vide</td>
    </tr>
<?php endif; ?>

<?php
foreach ($pager as $bcex):
    $boncommcontrat = $bcex;
    $id_docparent = $boncommcontrat->getIdDocparent();
    $docacha = DocumentachatTable::getInstance()->find($id_docparent);
    ?>
    <tr>
    <tr>
        <td style="text-align: center;"><?php
            include_partial('tddetaildoc', array('boncomm' => $boncommcontrat))
//                                        echo 'Contrat Provisoire N° ' . $boncommcontrat->getNumero();
            ?></td>  
        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($boncommcontrat->getDatecreation())) ?></td> 
        <td style="text-align: center;">
            <?php
//            if (sizeof($boncommcontrat->getDocumentachat()) >= 1)
//                $doc_achat_contrat_pro = DocumentachatTable::getInstance()->findOneByIdContratAndIdTypedoc($boncommcontrat->getId(), 19);
//            if (sizeof($doc_achat_contrat_pro) >= 1)
//                $doc_achat_contra = DocumentachatTable::getInstance()->findOneById($doc_achat_contrat_pro->getIdDocparent());
//            include_partial('tddetaildocbci', array('boncomm' => $doc_achat_contra));
            if (sizeof($boncommcontrat->getDocumentachat()) >= 1)
                echo $boncommcontrat->getDocumentachat()->getFirst()->getNumerodocumentachat();
            ?>
        </td> 
        <td><?php echo $boncommcontrat->getFournisseur()->getRs(); ?></td> 
        <td style="text-align: right;"><?php echo number_format($boncommcontrat->getMontantcontrat(), 3, '.', ' ') ?></td> 
        <td style="text-align: right;"><?php echo number_format($boncommcontrat->getMontantcontrat(), 3, '.', ' ') ?></td> 
        <td>
            <?php if ($boncommcontrat->ActionSignatureContratProvioire($boncommcontrat->getId()) != "") { ?>
                <span class="label label-sm label-warning" style="font-size: 12px !important; height: 100% !important; font-weight: bold; white-space: inherit;">
                    <?php echo html_entity_decode($boncommcontrat->ActionSignatureContratProvioire($boncommcontrat->getId())); ?>
                </span> 
            <?php } ?> 
        </td>
        <td><?php include_partial('tdcaisse', array('boncomm' => $boncommcontrat)) ?></td>
        <td><?php include_partial('tdactioncontrat', array('boncomm' => $boncommcontrat)) ?></td>



    </tr>
<?php endforeach; ?>
<script  type="text/javascript">
    var footer = '';
    $('#listprovisoire_footer').html('');
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
            '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPageProvi(\'1\')"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                    '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPageProvi(\'<?php echo $pager->getPreviousPage() ?>\')"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
    <?php endif; ?>
    <?php  foreach ($pager->getLinks() as $page): ?>
        <?php if ($page == $pager->getPage()): ?>
                '<li class ="paginate_button active" aria-controls ="dynamic-table" tabindex ="0"> <a href = "#"> <?php echo $page ?> </a></li>' +
        <?php else: ?>
                '<li class ="paginate_button" aria-controls ="dynamic-table" tabindex ="0"> <a onclick="goPageProvi(\'<?php echo $page ?>\')"> <?php echo $page ?> </a></li>' +
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if ($pager->getPage() == $pager->getLastPage()): ?>
            '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Dernière <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPageProvi(\'<?php echo $pager->getNextPage() ?>\')"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPageProvi(\'<?php echo $pager->getLastPage() ?>\')"> Dernière <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
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

    $('#listprovisoire_footer').html(footer);

</script>