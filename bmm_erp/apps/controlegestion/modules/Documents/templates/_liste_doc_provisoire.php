<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Résultat de recherche
            <?php
            $str = '';
            if ($date_debut != '')
                $str = $str . '&date_debut=' . $date_debut;
            if ($date_fin != '')
                $str = $str . '&date_fin=' . $date_fin;
            if ($id_fournisseur != '')
                $str = $str . '&id_fournisseur=' . $id_fournisseur;

            if ($str != '')
                $str = substr($str, 1);
            ?>
         
            <a target="_blanc" href="<?php echo url_for('Documents/ImprimerListeDocFournisseurProvisoire?' . $str) ?>" class="btn btn-sm btn-success" style="float: right; padding: 5px 9px;">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer</span>
            </a>
            
        </div>
        <div>
            <form>
                <div class="sf_admin_list">
                    <table id="list_doc" class="table table-bordered table-hover" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 9%">Numéro</th>
                                <th style="width: 8%">Date</th>
                                <th style="width: 9%">B.C.I.S</th>
                                <th style="width: 17%;">Fournisseur</th>
                                <th style="width: 8%;">Mnt.TTC</th>
                                <th style="width: 30%;">Imputation budgétaire</th>
                                <th style="width: 19%">Opérations</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
                            <?php if (count($pager) == 0): ?>
                                <tr>
                                    <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="9">Pas de B.C.E.S et/ou B.D.C.S Provisoire</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($pager->getResults() as $doc): ?>
                                    <tr>
                                        <td><?php include_partial('tddetaildoc', array('boncomm' => $doc)) ?></td>
                                        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($doc->getDatecreation())); ?></td>
                                        <td>
                                            <?php
                                            $documents_parent = DocumentparentTable::getInstance()->findByIdDocumentachat($doc->getId());
                                            if ($documents_parent->count() != 0) {
                                                foreach ($documents_parent as $document) {
                                                    $doc_achat = DocumentachatTable::getInstance()->find($document->getIdDocumentparent());
                                                    include_partial('tddetaildoc', array('boncomm' => $doc_achat));
                                                }
                                            } else
                                                include_partial('tddetaildoc', array('boncomm' => $doc->getDocumentparent()));
                                            ?>
                                        </td>
                                        <td><?php echo $doc->getFournisseur(); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($doc->getMntttc(), 3, '.', ' ') ?></td>
                                        <td>
                                            <?php if ($doc->ActionSignature() != "") { ?>
                                                <span class="label label-sm label-warning" style="font-size: 12px !important; height: 100% !important; font-weight: bold; white-space: normal;">
                                                    <?php echo html_entity_decode($doc->ActionSignature()); ?>
                                                </span> 
                                            <?php } ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a target="_blanc" href="<?php echo url_for('documentachat/showdocument?iddoc=') . $doc->getId() ?>" class="btn btn-xs btn-primary">
                                                <i class="ace-icon fa fa-eye bigger-110"></i>
                                                <span class="bigger-110 no-text-shadow">Détails</span>
                                            </a>
                                            <?php if ($doc->getIdTypedoc() == 17): ?>
                                                <a target="_blanc" href="<?php echo url_for('Documents/Imprimerbonexterne?iddoc=') . $doc->getId() ?>" class="btn btn-xs btn-success">
                                                    <i class="ace-icon fa fa-print bigger-110"></i>
                                                    Exporter PDF
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($doc->getIdTypedoc() == 18): ?>
                                                <a target="_blanc" href="<?php echo url_for('documentachat/imprimerBCEProvisoire') . '?iddoc=' . $doc->getId() ?>" class="btn btn-xs btn-success">
                                                    <i class="ace-icon fa fa-print bigger-110"></i>
                                                    Exporter PDF
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>


<script  type="text/javascript">
    var footer = '';
<?php if ($pager->haveToPaginate()): ?>
        footer = '<tr>' +
                '<td style ="padding: 0px;" colspan ="9">' +
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
                '<td style ="padding: 0px;" colspan ="9">' +
                '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                '<div class ="col-xs-12">' +
                '</div>' +
                '</div>' +
                '</td>' +
                '</tr>';
<?php endif; ?>
    $('#list_bci > tfoot').html(footer);
</script>

<script  type="text/javascript">

    $("table").addClass("table table-bordered table-hover");

</script>