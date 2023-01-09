<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Etat-Mouvement-Stock-<?php echo date('Y'); ?>')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv">
        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter => Excel</small>
    </h1>
</div>
<?php
$somme_qte = 0;
$somme_qte_sortie = 0;
$stock_final = 0;
$pu_achat = 0;
$cump = 0;
$val_en_stock = 0;
?>

<div class="row">
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px;margin-top: 2px" id="table_plan" border="1">
            <thead>
                <tr>
                    <th style="width: 7%;">Date</th>
                    <th style="text-align: left;width: 7%;">REF Article</th>
                    <th style="width: 7%;">Article</th>
                    <th style="width: 7%;">Famille</th>
                    <th style="width: 7%;">Sous Famille</th>
                    <th style="width: 10%;">N Bon entre</th>
                    <th style="width: 8%;">Qte Entre</th>
                    <th style="width: 8%;">Qte Sortie</th>
                    <th style="width: 8%;">Stock Final</th>
                    <th style="width: 12%;">PU Achat</th>
                    <th style="width: 12%;">CUMP</th>
                    <th style="width: 12%;">Stock en valeur</th>
                </tr>
            </thead>
            <tbody id="tblData">
                <?php if ($listes_mouvement->count() != 0) : ?>
                    <?php foreach ($listes_mouvement as $livre) :  ?>
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
                            <td style="text-align: right;"><?php echo $livre->getQteSortie();
                                                            $somme_qte_sortie = $somme_qte_sortie + $livre->getQteSortie(); ?></td>
                            <td style="text-align: right;"><?php echo number_format(($somme_qte - $somme_qte_sortie) , 3, '.', ' ');
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
            </tbody>
        </table>
    </div>
</div>


<script type="text/javascript">
    function exportTableToExcel(tableID, filename = '') {
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableHTML = encodeURIComponent($("#" + tableID).html());;
        // Specify file name
        filename = filename ? filename + '.xls' : 'excel_data.xls';
        // Create download link element
        downloadLink = document.createElement("a");
        document.body.appendChild(downloadLink);
        if (navigator.msSaveOrOpenBlob) {
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob(blob, filename);
        } else {
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
            // Setting the file name
            downloadLink.download = filename;
            //triggering the function
            downloadLink.click();
        }
    }
</script>