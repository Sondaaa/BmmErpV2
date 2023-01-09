<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Liste des Budgets Prévisionnels Globaux Par origine')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter  Liste des Budgets Prévisionnels Globaux Par origine  vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv"> Liste des Budgets Prévisionnels Globaux Par origine
        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter Liste des Budgets Prévisionnels Globaux Par origine => Excel</small>
    </h1>
</div>
<?php
$type = 'Budget Prévisionnel Global';
if ($_SESSION['exercice_budget'])
    $budgets = TitrebudjetTable::getInstance()->getByTypeAndCategorie($id_cat, $type, $_SESSION['exercice_budget']);
else
    $budgets = TitrebudjetTable::getInstance()->getByType($type);
 if ($budgets->count() != 0) :
$listes = Doctrine_Core::getTable('ligprotitrub')
        ->createQuery('a')
        ->where('id_titre=' . $budgets->getFirst()->getId())
        ->OrderBy('LENGTH(nordre),nordre asc')
        ->execute();
		endif;
?>
<div class="row">
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px; margin-top: 2px" id="table_plan" border="1">
            <thead>
                <tr>
                    <th style = "width:25%"><label>Code</label></th>
                    <th style = "width:50%"><label>Rubrique </label></th>
                    <th style = "width:25%"><label>Montant global</label></th>
                </tr>
            </thead>
            <tbody id="tblData">
                <?php
                if ($budgets->count() != 0) :
                    foreach ($listes as $l) {
                        $ligne = $l;
                        if (!$ligne->getRubrique()->getIdRubrique()) {
                            ?>
                            <tr style="font-size:10px;">
                                <td style="width:25%"> <?php echo $ligne->getCode() ?></td>
                                <td style="width:50%"><?php echo $ligne->getRubrique()->getLibelle() ?></td>
                                <td style="width:25%;text-align:right;"><b><?php echo number_format($ligne->getMnt(), 3, ".", " ") ?></b></td>
                            </tr>
                            <?php
                            $query = "SELECT a.mnt,t.libelle, source.source as origine, d.libelle as direction  "
                                    . " FROM titrebudjet t,ligprotitrub a ,sourcesbudget source , direction d"
                                    . " WHERE a.id_titre=t.id "
                                    . " AND t.typebudget='Budget Prévisionnel / Direction & Projet'"
                                    . " AND a.id_titre = t.id"
                                    . " and a.id_rubrique=" . $ligne->getIdRubrique()
                                    . " and t.id_source=source.id"
                                    . " and t.id_direction=d.id"
                            ;
                            if ($id_cat)
                                $query.= " AND t.id_cat=" . $id_cat;
                            //  die($query);
                            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                            $resul = $conn->fetchAssoc($query);
                            foreach ($resul as $ligne_ligneligpr):
                                ?>
                                <tr style="font-size:10px;">
                                    <td style="width:25%"><b><?php echo $ligne_ligneligpr['direction'] ?></b></td>
                                    <td style="width:50%"><b><?php echo $ligne_ligneligpr['origine'] ?></b></td>
                                    <td style="width:25%;text-align:right;"><b><?php echo $ligne_ligneligpr['mnt']; ?></b></td>
                                </tr>
                            <?php endforeach; ?>

                            <?php
                        }
                    } else :
                    ?>
                    <tr style = "font-size:12px;">
                        <td style = "font-size:16px;font-weight:bold;height:65px;text-align:center;"colspan="3">&nbsp;
                            <br>Pas de Budget!</td>
                    </tr>
                <?php endif; ?>
              
            </tbody>

        </table>
    </div>
</div>

<script  type="text/javascript">

    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableHTML = encodeURIComponent($("#" + tableID).html());
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