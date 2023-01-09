<div id="sf_admin_container">
    <h1 id="replacediv"> 
        <?php
        $journal = JournalcomptableTable::getInstance()->findOneById($journal_id);
        ?>
        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter Journal -  <?php echo $journal->getCode() . ' ' . $journal->getLibelle(); ?>- Exercice <?php echo $_SESSION['exercice']; ?> => Excel</small>
    </h1>
</div>

<?php
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$query = "SELECT CONCAT('<tr>"
        . "<td>', piececomptable.date,'</td>"
        . "<td>', piececomptable.numero,'</td> "
         . "<td>', lignepiececomptable.numeroexterne,'</td> "
        . "<td>', plandossiercomptable.numerocompte,'</td> "
        . "<td>', lignepiececomptable.libelle, '</td>  "
        . "<td>', lignepiececomptable.montantdebit, '</td>  "
//        REPLACE(FORMAT(number,0),',','.')
        . "<td>', lignepiececomptable.montantcredit, '</td></tr>') as ligne "
        . " FROM journalcomptable, lignepiececomptable, piececomptable,plandossiercomptable"
        . " WHERE journalcomptable.id =" . $journal_id
        . " AND lignepiececomptable.id_piececomptable = piececomptable.id"
        . " AND piececomptable.id_journalcomptable = journalcomptable.id "
        . " AND lignepiececomptable.id_comptecomptable=plandossiercomptable.id "
        . " ORDER BY piececomptable.numero";
$compte = $conn->fetchAssoc($query);
?>

<div class="row">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Journal-comptable-<?php echo $_SESSION['exercice']; ?>')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter Journal Comptable vers Fichier Excel
        </button>
    </div>
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px;margin-top: 2px" id="table_plan" border="1">
            <thead>
                <tr>
                    <th style="width:10%;">Date</th>
                    <th style="width:10%;">Pièce Comptable </th>
                    <th style="width:10%;">N° Externe </th>
                    <th style="width:10%;">Numèro Compte  </th>
                    <th style="width:30%;"> Libellé  </th>
                    <th style="width:20%;">Débit</th>
                    <th style="width:20%;"> Crédit  </th>
                </tr>
            </thead>
            <tbody id="tblData">
                <?php
                echo implode('', array_map(function ($entry) {
                            return $entry['ligne'];
                        }, $compte));
                ?>
            </tbody>
        </table>
    </div>
</div>

<script  type="text/javascript">

    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableHTML =  encodeURIComponent($("#" + tableID).html());
      
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