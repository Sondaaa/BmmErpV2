<?php
// $boncomm = new Contratachat();
//foreach ($boncommandeexterne as $bcex) {
?>
<?php if (sizeof($pager) == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="9">Liste des Contrats définitifs vide</td>
    </tr>
<?php endif; ?>

<?php
foreach ($pager as $bcex):
    $boncomm = $bcex;
    ?>
    <tr>
        <td style="text-align: center;"><?php
    include_partial('tddetaildoc', array('boncomm' => $boncomm));
//                        echo 'Contrat Définitif N° ' . $boncomm->getNumero();
    ?></td>  
        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($boncomm->getDatecreation())) ?></td> 
        <td style="text-align: center;">
            <?php
            if (sizeof($boncomm->getDocumentachat()) >= 1)
                echo $boncomm->getDocumentachat()->getFirst()->getNumerodocumentachat();
//                                        $documents_parent = DocumentparentTable::getInstance()->findByIdDocumentachat($boncomm->getId());
//                                            $doc_achat_contrat_defi = DocumentachatTable::getInstance()->findOneByIdContratAndIdTypedoc($boncomm->getId(), 20);
//                                        $doc_achat_contrat_pro = DocumentachatTable::getInstance()->findOneByIdContratAndIdTypedoc($boncomm->getId(), 19);
//                                        if (sizeof($doc_achat_contrat_defi) >= 1) {
//                                            $doc_fils_contra = DocumentachatTable::getInstance()->findOneById($doc_achat_contrat_defi->getIdDocparent());
//                                            $doc_achat_contra = DocumentachatTable::getInstance()->find($doc_fils_contra->getIdDocparent());
//                                        } elseif (sizeof($doc_achat_contrat_pro) >= 1)
//                                            $doc_achat_contra = DocumentachatTable::getInstance()->findOneById($doc_achat_contrat_pro->getIdDocparent());
//                                        die($boncomm->getDocumentachat()->getFirst()->getId() . ' cd' . $boncomm->getId() . 'fffffff');
//                                        if ($documents_parent->count() != 0) {
//                                            foreach ($documents_parent as $doc) {
//                                                $doc_achat = DocumentachatTable::getInstance()->find($doc->getIdDocumentparent());
//                                                die($doc_achat->getId() . 'rf');
//                                        include_partial('tddetaildocbci', array('boncomm' => $doc_achat_contra));
//                                            }
//                                        } else
//                                        include_partial('tddetaildoc', array('boncomm' => $boncomm->getDocumentparent()));
            ?>
        </td> 
        <td><?php echo $boncomm->getFournisseur()->getRs(); ?></td> 
        <td style="text-align: right;"><?php echo number_format($boncomm->getMontantcontrat(), 3, '.', ' ') ?></td> 
        <td style="text-align: right;"><?php echo number_format($boncomm->getMontantcontrat(), 3, '.', ' ') ?></td> 
        <td>
            <?php if ($boncomm->ActionSignatureContratDefinitif($boncomm->getId()) != "" && $boncomm->ActionSignatureContratDefinitif($boncomm->getId()) != null) { ?>
                <span class="label label-sm label-warning" style="font-size: 12px !important; height: 100% !important; font-weight: bold; white-space: inherit;">
                    <?php echo html_entity_decode($boncomm->ActionSignatureContratDefinitif($boncomm->getId())); ?>
                </span> 
            <?php } ?> 
        </td>
        <td><?php include_partial('tdcaisse', array('boncomm' => $boncomm)) ?></td>
        <td><?php include_partial('tdactioncontrat', array('boncomm' => $boncomm)) ?></td>



    </tr>
<?php endforeach; ?>



<script  type="text/javascript">
    var footer = '';
//    $('#listPiece_footer').html('');
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
    <?php else:  ?>
                    '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPageDef(\'1\')"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                            '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPageDef(\'<?php echo $pager->getPreviousPage() ?>\')"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
    <?php endif; ?>
    <?php foreach ($pager->getLinks() as $page): ?>
        <?php if ($page == $pager->getPage()): ?>
                            '<li class ="paginate_button active" aria-controls ="dynamic-table" tabindex ="0"> <a href = "#"> <?php echo $page ?> </a></li>' +
        <?php else: ?>
                            '<li class ="paginate_button" aria-controls ="dynamic-table" tabindex ="0"> <a onclick="goPageDef(\'<?php echo $page ?>\')"> <?php echo $page ?> </a></li>' +
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if ($pager->getPage() == $pager->getLastPage()): ?>
                    '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                            '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Dernière <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
    <?php else: ?>
                    '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPageDef(\'<?php echo $pager->getNextPage() ?>\')"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                            '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPageDef(\'<?php echo $pager->getLastPage() ?>\')"> Dernière <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
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

    $('#listPiecedef_footer').html(footer);

</script>