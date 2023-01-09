<div id="sf_admin_container">
    <h1 id="replacediv"> Base Comptable 
        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter Plan Comptable - Exercice <?php echo $_SESSION['exercice']; ?> => Excel</small>
    </h1>
</div>

<?php
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$query = "SELECT CONCAT('<tr><td>', TRIM(plandossiercomptable.numerocompte), "
        . "'</td><td>', TRIM(plandossiercomptable.libelle), '</td>"
//        . "<td>',"
//        . " CASE WHEN plancomptable.standard=1 THEN ' X' ELSE '' END, '</td>"
        . "<td>', TRIM(classecompte.libelle), '</td></tr>') as ligne"
        . " FROM plandossiercomptable, plancomptable, classecompte"
        . " WHERE plandossiercomptable.id_dossier = " . $_SESSION['dossier_id'] . " AND id_exercice = " . $_SESSION['exercice_id']
        . " AND plandossiercomptable.id_plan = plancomptable.id AND plancomptable.id_classe = classecompte.id "
        . " AND LENGTH(trim(plandossiercomptable.numerocompte)) >= 7 "
        . " ORDER BY plandossiercomptable.numerocompte";
$compte = $conn->fetchAssoc($query);
?>

<div class="row">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Plan-comptable-<?php echo $_SESSION['exercice']; ?>')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter Plan Comptable vers Fichier Excel
        </button>
    </div>
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px;margin-top: 3px" id="table_plan" border="1">
            <thead>
                <tr>
                    <th style="width:7%;">Numero</th>
                    <th style="width:75%;">Intitule du Compte Comptable </th>
                   
                    <th style="width:15%;">Classe</th>
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
        var tableHTML = encodeURIComponent($("#" + tableID).html()) ;
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