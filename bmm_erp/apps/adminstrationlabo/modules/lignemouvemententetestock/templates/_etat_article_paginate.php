<?php if ($pager->count() == 0) : ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="12">Liste des Fiches Vide</td>
    </tr>
<?php endif; ?>
<?php
$somme_qte = 0;
$somme_qte_sortie = 0;
$stock_final = 0;
$pu_achat = 0;
$cump = 0;
$val_en_stock = 0;
?>
<?php if ($pager->count() != 0) : ?>
    <?php foreach ($pager as $livre) :  ?>
        <tr>
            <td><?php echo  date('d/m/Y', strtotime($livre->getCreatedAt()));
                ?></td>
            <td><?php echo $livre->getArticle()->getCodeart() ?></td>
            <td><?php echo $livre->getArticle() ?></td>
            <td><?php echo $livre->getArticle()->getFamillearticle() ?></td>
            <td><?php echo $livre->getArticle()->getSousfamillearticle() ?></td>
            <td>
                <?php if ($livre->getMouvemententetestock()->getIdDocachat()) : ?>
                    <a style="cursor: pointer;" target="_blank" title="Modifier Pièce" href="<?php if ($livre->getMouvemententetestock()->getIdDocachat()) echo url_for('documentachat/showdocument?iddoc=' . $livre->getMouvemententetestock()->getIdDocachat()) ?>">
                        <?php echo $livre->getMouvemententetestock() . ' - ' . $livre->getLibelle() ?>
                    </a>
                <?php else : ?>
                    <?php echo $livre->getMouvemententetestock() . ' - ' . $livre->getLibelle() ?>

                <?php endif; ?>

            </td>
            <td style="text-align: right;"><?php echo number_format($livre->getQteEntere(), 3, '.', ' ');
                                            $somme_qte = $somme_qte + $livre->getQteEntere(); ?></td>
            <td style="text-align: right;"><?php echo number_format($livre->getQteSortie(), 3, '.', ' ');
                                            $somme_qte_sortie = $somme_qte_sortie + $livre->getQteSortie(); ?></td>
            <td style="text-align: right;"><?php echo number_format($somme_qte - $somme_qte_sortie, 3, '.', ' ');
                                            $stock_final =  ($livre->getQteEntere() - $livre->getQteSortie()); ?></td>
            <td style="text-align: right;"><?php echo number_format($livre->getPuachat(), 3, '.', ' ');
                                            $pu_achat = $pu_achat + $livre->getPuachat(); ?></td>
            <td style="text-align: right;"><?php echo number_format($livre->getCump(), 3, '.', ' ');
                                            $cump = $cump + $livre->getCump(); ?></td>
            <td style="text-align: right;"><?php echo number_format($livre->getStockValeur(), 3, '.', ' ');
                                            $val_en_stock = $val_en_stock + $livre->getStockValeur(); ?></td>

        </tr>
    <?php endforeach;
    ?>
    <tr>
        <td colspan="4" style="font-weight: bold;">&nbsp;</td>
        <td colspan="2" style="font-weight: bold; background-color: #F7F7F7;">Total Période</td>
        <td style="font-weight: bold; text-align: right; background-color: #fcf8e3;">
            <?php
            if ($somme_qte != 0)
                echo number_format($somme_qte, 3, '.', ' ');
            ?>
        </td>
        <td style="font-weight: bold; text-align: right; background-color: #dff0d8;">
            <?php
            if ($somme_qte_sortie != 0)
                echo number_format($somme_qte_sortie, 3, '.', ' ');
            ?>
        </td>
        <td style="font-weight: bold; text-align: right; background-color: #fcf8e3;">
            <?php
            if ($stock_final != 0)
                echo number_format($stock_final, 3, '.', ' ');
            ?>
        </td>
        <td style="font-weight: bold; text-align: right; background-color: #dff0d8;">
            <?php
            if ($pu_achat != 0)
                echo number_format($pu_achat, 3, '.', ' ');
            ?>
        </td>
        <td style="font-weight: bold; text-align: right; background-color: #fcf8e3;">
            <?php
            if ($cump != 0)
                echo number_format($cump, 3, '.', ' ');
            ?>
        </td>
        <td style="font-weight: bold; text-align: right; background-color: #dff0d8;">
            <?php
            if ($val_en_stock != 0)
                echo number_format($val_en_stock, 3, '.', ' ');
            ?>
        </td>
    </tr>

<?php endif; ?>

<script type="text/javascript">
    var footer = '';
    $('#listPiece_footer').html('');
    <?php if ($pager->haveToPaginate()) : ?>
        footer = '<tr>' +
            '<td style ="padding: 0px;" colspan ="13">' +
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
                    '<td style ="padding: 0px;" colspan ="13">' +
                    '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                    '<div class ="col-xs-12">' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    '</tr>';
            <?php endif; ?>

            $('#listPiece_footer').html(footer);
</script>