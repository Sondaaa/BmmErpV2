<?php if (count($pager) == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="10">Liste des Règlements Vide</td>
    </tr>
<?php endif; ?>
<?php foreach ($pager->getResults() as $facture): ?>
    <tr>
        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($facture->getDate())) ?></td>
        <td style="text-align: center;"><?php echo $facture->getNumero() ?></td>
        <td style="text-align: center;"><?php echo $facture->getLibelle() ?></td>
        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($facture->getDatevaleur())) ?></td>

        <td style="text-align: right;"><?php echo $facture->getTotalht() ?></td>
        <td style="text-align: right;"><?php echo $facture->getTotaltva() ?></td>

        <td style="text-align: right;"><?php echo $facture->getTotalttc() ?></td>
        <td style="text-align: center;"><?php echo $facture->getType();
    ?></td>
        <td style="text-align: center;"><?php echo $facture->getCaissesbanques(); ?></td>
        <td style="cursor: pointer; text-align: center;">
            <span class="btn-group">
                <?php
                if ($facture->getIdMouvement() != null):
//                    die('id=' . $facture->getMouvementbanciare()->getIdDocumentbudget() . 'vv' . $facture->getIdMouvement());
                    if ($facture->getMouvementbanciare()->getIdDocumentbudget() != null)
                        $document_budget = Doctrine_Core::getTable('documentbudget')->findOneById($facture->getMouvementbanciare()->getDocumentbudget()->getId());
                    if ($facture->getMouvementbanciare()->getIdDocumentachat() != null) {
                        $document_achat_re = Doctrine_Core::getTable('documentachat')->findOneById($facture->getMouvementbanciare()->getDocumentachat()->getId());
                        $document_fac = DocumentachatTable::getInstance()->findOneById($facture->getMouvementbanciare()->getIdDocumentachat());
                        $pice_joint_budget = PiecejointbudgetTable::getInstance()->findByIdDocachat($facture->getMouvementbanciare()->getIdDocumentachat());
                        $pice_joint_budgets = PiecejointbudgetTable::getInstance()->findByIdDocachat($facture->getMouvementbanciare()->getIdDocumentachat());
//                        $document_budget = PiecejointbudgetTable::getInstance()->findByIdDocument();
//                         echo ($document_fac->getId().'m');
                        $id_doc_budget = $pice_joint_budget->getLast()->getIdDocumentbudget();
                    }
                    ?>
                                                                                            <!--<a title="Afficher" onclick="showFacture('<?php // echo $facture->getIdFacture()                 ?>')" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-search"></i></a>-->
                    <?php
//                    if ($document_achat_re->getIdTypedoc() == 22) {
//                        foreach ($pice_joint_budgets as $pice_joint_budget):
                    ?>

                    <a target="_blank" class="btn btn-xs btn-success" style="margin-right:  1px; cursor:pointer;" title="Afficher" href="<?php
//                    if ($facture->getMouvementbanciare()->getIdDocumentbudget() != null) {
//                        echo url_for('importation/imprimerordonnance?id=' . $document_budget->getId());
//                    }
                    if ($facture->getMouvementbanciare()->getIdDocumentachat() != null) {
                        if ($facture->getMouvementbanciare()->getDocumentachat()->getIdTypedoc() != 22) {
                            echo url_for('importation/imprimerordonnance') . '?id=' . $id_doc_budget;
                        } else
                            echo url_for('importation/imprimerordonnanceBDCReg') . '?id=' . $id_doc_budget . '&id_docachat=' . $facture->getMouvementbanciare()->getIdDocumentachat();
                    }
                    ?>">
                        <i class="ace-icon fa fa-eye"></i> 

                        <?php
                        // endforeach;
//                    } else {
                        ?>
                        <!--                        <a target="_blank" class="btn btn-xs btn-success" title="Afficher" href="<?php
//                        if ($facture->getMouvementbanciare()->getIdDocumentbudget() != null) {
//                            echo url_for('importation/imprimerordonnance?id=' . $document_budget->getId());
//                        }
//                        if ($facture->getMouvementbanciare()->getIdDocumentachat() != null) {
//
//                            echo url_for('importation/imprimerordonnance?id=' . $id_doc_budget);
//                        }
                        ?>">
                                                    <i class="ace-icon fa fa-eye"></i> 
                                                </a>-->
                        <?php
                    // }
                    endif;
                    ?>
                    <a title="Supprimer" style="margin-left: 1px; cursor:pointer;" onclick="annulerFacture(<?php echo $facture->getId() ?>)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-trash"></i></a>
                    <?php
                    if ($facture->getMouvementbanciare()->getIdDocumentachat() != null) {
                        if ($facture->getMouvementbanciare()->getDocumentachat()->getIdTypedoc() != 22) {
                            ?>                
                            <?php if ($facture->getIdComptecomptable() == null): ?>
                                <a title="Affecter un compte comptable " onclick="editReglement('<?php echo $facture->getId() ?>')" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-smile-o"></i></a>

                            <?php elseif ($facture->getSaisie() == 0): ?>
                                <a title="Saisir Pièce" onclick="preparationSaisir('<?php echo $facture->getId() ?>')" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-keyboard-o"></i></a>
                    <!--                    <a title="Saisir Pièce par Maquette de Saisie" onclick="preparationMaquette('<?php // echo $facture->getId()                   ?>')" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-maxcdn"></i></a>-->
                            <?php endif; ?>
                            <input type="hidden" name="saisir_piece" value="<?php echo $facture->getId(); ?>" id="saisir_<?php echo $facture->getId(); ?>" />                     
                            <?php // endif;          ?>
                        <?php } else { ?>
                            <a title="Saisir Pièce Du BDC Regroupe" onclick="preparationSaisir('<?php echo $facture->getId() ?>')" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-keyboard-o"></i></a>             
                            <?php
                            }
                        }
                        ?>   
            </span>
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
    $('#listFacture > tfoot').html(footer);
</script>
<?php
$url = "type=banque&saisie=0";
?>
<script  type="text/javascript">
    $('#imprime_liste').attr("href", "<?php echo url_for("importation/imprimeListe?" . $url); ?>");
</script>