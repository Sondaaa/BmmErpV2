<?php if (count($pager) == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="9">Liste des Factures Vide</td>
    </tr>
<?php endif; ?>
<?php foreach ($pager->getResults() as $facture): ?>
    <tr>
        <td style="text-align: center;"><?php echo $facture->getNumero() ?></td>
        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($facture->getDate())) ?></td>
        <td style="text-align: center;"><?php echo $facture->getReference() ?></td>
        <td><?php echo $facture->getFournisseur()->getRs() ?></td>
        <!--<td style="text-align: right;"><?php // echo $facture->getTotalht()                           ?></td>-->
        <td style="text-align: right;"><?php echo $facture->getTotaltva() ?></td>
        <td style="text-align: right;"><?php echo $facture->getTotalht() ?></td>
        <!--<td style="text-align: right;"><?php // echo $facture->getTotalttc()                           ?></td>-->
        <td style="cursor: pointer; text-align: center;">
            <span class="btn-group">
                <?php
//                echo ($facture->getIdFacture() .'fes');
                $id_facture = $facture->getIdFacture();
                $doc_achat = DocumentachatTable::getInstance()->find($id_facture);

                if ($doc_achat->getIdTypedoc() != 22) {
                    if ($facture->getIdFacture() != null):
                        ?>
                        <a title="Afficher facture" 
                           href="<?php
                           if ($facture->getIdFacture() != null) {
                               echo url_for('importation/imprimerdocachat?id=' . $facture->getIdFacture());
                           }
                           ?>"
                           class="btn btn-xs btn-success"><i class="ace-icon fa fa-eye"></i></a>
                           <?php
                       endif;
                       ?>
                       <?php if ($facture->getIdCertfificat() != null): ?>
                        <a target="_blank" style="margin-right: 1px;margin-left: 1px" title="Afficher Certificat" 
                           href="<?php
                           if ($facture->getIdCertfificat() != null) {
                               echo url_for('importation/imprimerCertificat?id=' . $facture->getIdCertfificat());
                           }
                           ?>"
                           class="btn btn-xs btn-primary"><i class="ace-icon fa fa-eye"></i></a>
                           <?php
                       endif;
                   } else {
                       ?>
                    <a title="Afficher Les Factures" 
                       href="<?php
                       if ($facture->getIdFacture() != null) {
                           echo url_for('importation/imprimerdocachatBDCRegroupe?id=' . $facture->getIdFacture());
                       }
                       ?>"
                       class="btn btn-xs btn-success"><i class="ace-icon fa fa-eye"></i>
                    </a>
                    <?php
                    $piecejoint = PiecejointbudgetTable::getInstance()->findByIdDocachat($facture->getIdFacture());
                    $docbudget = DocumentbudgetTable::getInstance()->find($piecejoint->getFirst()->getIdDocumentbudget());
                    $certificas = CertificatretenueTable::getInstance()->findByIdDocumentbudget($docbudget->getId());
                    if (sizeof($certificas) >= 1):
                        foreach ($certificas as $certifica):
                            if ($certifica):
                                ?>
                                <a target="_blank" style="margin-right: 1px;margin-left: 1px" title="Afficher Les Certificats" 
                                   href="<?php
                                   echo url_for('importation/imprimerCertificat?id=' . $certifica->getId());
                                   ?>"
                                   class="btn btn-xs btn-primary"><i class="ace-icon fa fa-eye"></i></a>
                                   <?php
                               endif;
                           endforeach;
                       endif;
                       ?>
                   <?php } ?>
                <a title="Supprimer" onclick="annulerFacture(<?php echo $facture->getId() ?>)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-trash"></i></a>
                <?php if ($doc_achat->getIdTypedoc() != 22) { ?>
                    <?php if ($facture->getSaisie() == 0 && $facture->getFournisseur()->getIdPlancomptable() != null): ?>
                        <a title="Saisir Pièce" onclick="preparationSaisir('<?php echo $facture->getId() ?>')" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-keyboard-o"></i></a>
                        <!--<a title="Saisir Pièce par Maquette de Saisie" onclick="preparationMaquette('<?php // echo $facture->getId()                         ?>')" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-maxcdn"></i></a>-->
                        <input type="hidden" name="saisir_piece" value="<?php echo $facture->getId(); ?>" id="saisir_<?php echo $facture->getId(); ?>" />                     
                    <?php endif; ?>
                    <?php if ($facture->getFournisseur()->getIdPlancomptable() == null && $facture->getIdFournisseur() != null): ?>
                        <a title="Affecter Compte comptable" onclick="affecterCompte('<?php echo $facture->getFournisseur()->getId() ?>')" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-creative-commons"></i></a>
                        <input type="hidden" name="affect_compte" value="<?php echo $facture->getFournisseur()->getId(); ?>" id="affect_<?php echo $facture->getId(); ?>"/>
                        <input type="hidden" name="saisir_piece" value="<?php echo $facture->getId(); ?>" id="saisir_<?php echo $facture->getId(); ?>" />
                    <?php endif; ?>   
                    <?php if ($facture->getIdFournisseur() == null): ?>
                        <a title="Affecter Compte comptable" onclick="preparationSaisir('<?php echo $facture->getId() ?>')" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-creative-commons"></i></a>
                        <input type="hidden" name="affect_compte" value="<?php echo $facture->getId(); ?>" id="affect_<?php echo $facture->getId(); ?>"/>
                        <input type="hidden" name="saisir_piece" value="<?php echo $facture->getId(); ?>" id="saisir_<?php echo $facture->getId(); ?>" />
                    <?php endif; ?><?php }else { ?>
                      <?php if ($facture->getSaisie() == 0 ): ?>
                        <a title="Saisir Pièce" onclick="preparationSaisir('<?php echo $facture->getId() ?>')" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-keyboard-o"></i></a>
                        <!--<a title="Saisir Pièce par Maquette de Saisie" onclick="preparationMaquette('<?php // echo $facture->getId()                         ?>')" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-maxcdn"></i></a>-->
                        <input type="hidden" name="saisir_piece" value="<?php echo $facture->getId(); ?>" id="saisir_<?php echo $facture->getId(); ?>" />                     
                    <?php endif; ?>  
                <?php } ?>     
            </span>
        </td>
    </tr>
<?php endforeach; ?>

<script  type="text/javascript">
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
            '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPageOd(\'1\')"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                    '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPageOd(\'<?php echo $pager->getPreviousPage() ?>\')"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
    <?php endif; ?>
    <?php foreach ($pager->getLinks() as $page): ?>
        <?php if ($page == $pager->getPage()): ?>
                '<li class ="paginate_button active" aria-controls ="dynamic-table" tabindex ="0"> <a href = "#"> <?php echo $page ?> </a></li>' +
        <?php else: ?>
                '<li class ="paginate_button" aria-controls ="dynamic-table" tabindex ="0"> <a onclick="goPageOd(\'<?php echo $page ?>\')"> <?php echo $page ?> </a></li>' +
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if ($pager->getPage() == $pager->getLastPage()): ?>
            '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> <i class="ace-icon fa fa-angle-double-right"></i> Dernière </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPageOd(\'<?php echo $pager->getNextPage() ?>\')"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPageOd(\'<?php echo $pager->getLastPage() ?>\')"> Dernière <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
    <?php endif; ?>
        '</ul>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</td>' +
                '</tr>';
<?php else: ?>
        footer = '<tr>' +
                '<td style ="padding: 0px;" colspan ="9">' +
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
$url = "type=od&saisie=0";
if ($reference != "")
    $url = $url . "&reference=" . $reference;
?>
<script  type="text/javascript">
    $('#imprime_liste').attr("href", "<?php echo url_for("importation/imprimeListe?" . $url); ?>");
</script>