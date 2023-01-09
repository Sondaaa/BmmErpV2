<?php if (count($pager) == 0) : ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="9">Liste des pièces vide</td>
    </tr>
<?php endif; ?>

<?php foreach ($pager->getResults() as $i => $piece) : ?>
    <tr id="ligne_<?php echo $i ?>" onclick="formatLigne(<?php echo $i ?>)" index_ligne="<?php echo $i ?>" ondblclick="showPiece('<?php echo $piece->getId() ?>')">
        <td>
            <div class="action-buttons">
                <a onclick="setAffichageDetail('<?php echo $i ?>', '<?php echo $piece->getId() ?>')" style="cursor: pointer;" class="green bigger-140 show-details-btn" title="Afficher Détails">
                    <i class="ace-icon fa fa-angle-double-down"></i>
                    <span class="sr-only">Détails</span>
                </a>
            </div>
        </td>
        <td name="ligne_journal" style="text-align: left; padding-left: 1%;"><?php echo $piece->getJournalcomptable()->getLibelle() ?></td>
        <td name="ligne_date" style="text-align: center;"><?php echo date('d/m/Y', strtotime($piece->getDate())) ?></td>
        <td name="ligne_numero" style="text-align: center;"><?php echo $piece->getNumero() ?></td>
        <td name="ligne_serie" style="text-align: center;"><?php echo $piece->getNumeroseriejournal()->getPrefixe() ?></td>
        <td name="ligne_numero" style="text-align: center;"><?php
                                                            if (sizeof($piece->getLignepiececomptable()) >= 1) :
                                                                echo $piece->getLignepiececomptable()->getFirst()->getNumeroexterne();
                                                            endif;
                                                            ?></td>
        <td style="text-align: center;"><?php echo $piece->getTotaldebit() ?></td>
        <td style="text-align: center;"><?php echo $piece->getTotalcredit() ?></td>
        <td name="ligne_user" style="text-align: left;">
            <span style="color: #0069A2;"><?php echo $piece->getLibelle();
                                            // echo $piece->getUtilisateur()->getAgents()->getNomcomplet(). ' ' .$piece->getUtilisateur()->getAgents()->getPrenom();    
                                            ?></span>
        </td>
        <td style="cursor: pointer; text-align: center;">
            <span class="btn-group">
                <a style="margin-right: 10px;" title="Afficher" onclick="showPiece('<?php echo $piece->getId() ?>')" class="btn btn-info btn-xs"><i class="ace-icon fa fa-eye"></i></a>
                <a style="margin-right: 10px;" target="_blank" title="Imprimer" href="<?php echo url_for('saisie_pieces/imprimePiece?id=' . $piece->getId()) ?>" class="btn btn-primary btn-xs"><i class="ace-icon fa fa-print"></i></a>
<!--                <a style="margin-right: 10px;" onclick="showEditPiece('<?php //  echo $piece->getId()
                                                                        ?>')" class="btn btn-warning btn-xs"><i class="ace-icon fa fa-pencil"></i></a>-->
                <a style="margin-right: 10px;" target="_blank" href="<?php echo url_for('saisie_pieces/showEdit') . '?id=' . $piece->getId() ?>" class="btn btn-warning btn-xs"><i class="ace-icon fa fa-pencil"></i></a>
                <a onclick="openPopupSupprimer(<?php echo $piece->getId() ?>)" class="btn btn-danger btn-xs"><i class="ace-icon fa fa-trash"></i></a>
            </span>
        </td>
    </tr>
<?php endforeach; ?>

<script type="text/javascript">
    var footer = '';
    $('#listPiece_footer').html('');
    <?php if ($pager->haveToPaginate()) : ?>
        footer = '<tr>' +
            '<td style ="padding: 0px;" colspan ="10">' +
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
                    '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Dernière <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
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

            $('#listPiece_footer').html(footer);
</script>

<?php
$url = '';
if ($journal != '')
    $url .= '&journal=' . $journal;
if ($num != '')
    $url .= '&num=' . $num;
if ($num_debut != '')
    $url .= '&num_debut=' . $num_debut;
if ($num_fin != '')
    $url .= '&num_fin=' . $num_fin;
if ($type_tri != '')
    $url .= '&type_tri=' . $type_tri;
if ($tri != '')
    $url .= '&tri=' . $tri;
if ($date_debut != '')
    $url .= '&date_debut=' . $date_debut;
if ($date_fin != '')
    $url .= '&date_fin=' . $date_fin;

if ($url != '')
    $url = substr($url, 1);
?>

<script type="text/javascript">
    var design = '<a id="print_list" target="_blank" style="cursor:pointer;" href="" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-print bigger-110"></i><span class="bigger-110 no-text-shadow">Imprimer</span></a>';
    $('#zone_pdf').html(design);
    <?php if ($url != '') : ?>
        var url = '<?php echo url_for("saisie_pieces/ImprimeListe?" . $url); ?>';
    <?php else : ?>
        var url = '<?php echo url_for("saisie_pieces/ImprimeListe"); ?>';
    <?php endif; ?>
    $('#print_list').attr("href", url);
</script>