<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Etat-Grand-livre-comptable-<?php echo $_SESSION['exercice']; ?>')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter Grand livre  Comptable vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv"> 
        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter  Grand Livre Comptable => Excel</small>
    </h1>
</div>
<?php
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$query = "SELECT CONCAT('<tr>"
        . "<td>', plandossiercomptable.numerocompte ,'</td>"
        . "<td>', piececomptable.date,'</td>"
        . "<td>',Concat(journalcomptable.code ,' ' ,journalcomptable.libelle) ,'</td> "
        . "<td>', piececomptable.numero,'</td> "
        . "<td>', piececomptable.libelle, '</td>  "
        . "<td>', lignepiececomptable.montantdebit, '</td>  "
        . "<td>', lignepiececomptable.montantcredit, '</td>"
//        . "<td>',  piececomptable.totaldebit , '</td>  "
//        . "<td>',  piececomptable.totalcredit , '</td>  "
//        . "<td>', COALESCE( sum(lignepiececomptable.montantcredit) ,0), '</td>"
        . "</tr>') as ligne "
        . " FROM Plancomptable, Plandossiercomptable,journalcomptable, piececomptable"
        . ",lignepiececomptable,classecompte"
        . " WHERE trim(plandossiercomptable.numerocompte) >='" . trim($compte_min) . "'"
        . " AND trim(plandossiercomptable.numerocompte) <='" . trim($compte_max) . "'"
        . " AND piececomptable.id_journalcomptable = journalcomptable.id"
        . " and plandossiercomptable.numerocompte=plancomptable.numerocompte"
        . " and lignepiececomptable.id_comptecomptable = plandossiercomptable.id"
        . " and lignepiececomptable.id_piececomptable=piececomptable.id"
        . " and plandossiercomptable.id_plan=plancomptable.id "
        . " AND plancomptable.id_classe=classecompte.id"
        . " AND lignepiececomptable.id_comptecomptable=plandossiercomptable.id"
        . " AND  plandossiercomptable.id_dossier = " . $dossier_id
        . " and plandossiercomptable.id_exercice = " . $exercice_id
        . " and (lignepiececomptable.montantdebit !=" . 0.000 . " or lignepiececomptable.montantcredit != " . 0.000 . ")"
;
if ($date_debut != '')
    $guery = $query . " and piececomptable.date >" . $date_debut;
if ($date_fin)
    $guery = $query . " and piececomptable.date <=" . $date_fin;
//$guery = $query . "ORDER BY plandossiercomptable.numerocompte  asc')";
$guery = $query . " GROUP BY plandossiercomptable.numerocompte,plandossiercomptable.numerocompte,classecompte.code,"
        . " Plandossiercomptable.id,lignepiececomptable.id,"
        . " Plandossiercomptable.libelle,piececomptable.totaldebit,lignepiececomptable.montantcredit"
        . " lignepiececomptable.montantdebit ,"
        . " lignepiececomptable.montantcredit,piececomptable.numero,piececomptable.date,"
        . " journalcomptable.code,journalcomptable.libelle, lignepiececomptable.libelle "
        . " ORDER BY trim(plandossiercomptable.numerocompte) asc  ";

$compte = $conn->fetchAssoc($query);
//die($query);
?>

<div class="row">
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px;margin-top: 2px" id="table_plan" border="1">
            <thead>
                <tr>
                    <th style="width:10%;">Numèro compte comptable</th>
                    <th style="width:10%;">Date</th>
                    <th style="width:10%;">Journal Comptable </th>
                    <th style="width:10%;"> Numèro de Pièce  </th>
                    <th style="width:20%;">Libellé  </th>
                    <th style="width:10%;">Débit</th>
                    <th style="width:10%;">Crédit  </th>
<!--                    <th style="width: 8%;">Solde Débiteur</th>
                    <th style="width: 8%;">Solde Créditeur</th>-->
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
//        var thead =
//                "<tr><td>N°Compte</td><td>Date</td>\n\
//<td>Journal.C</td><td>N°Piece</td>\n\
//<td>Libelle</td><td>Debit</td><td>Credit</td>\n\
//</tr>";
        var tableHTML = encodeURIComponent($("#" + tableID).html());
//        var tableHTML = "<table>" + thead + encodeURIComponent($("#" + tableID).html()) + "</table>";
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