<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" 
                onclick="exportTableToExcel('PDFcontent', 'Etat-Extrait-Compte-Comptable-<?php echo $_SESSION['exercice']; ?>')" 

                >
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter  Extrait Compte  Comptable vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv"> 
        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter  Extrait Compte  Comptable <?php echo $Plan_dossier_comptable->getNumerocompte() . ' ' . $Plan_dossier_comptable->getLibelle() ?>  => Excel</small>
    </h1>


</div>

<?php
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$query = "SELECT CONCAT('<tr><td>', piececomptable.date,'</td>"
        . "<td>',Concat(journalcomptable.code ,' ' ,journalcomptable.libelle) ,'</td> "
        . "<td>', piececomptable.numero,'</td> "
         . "<td>', lignepiececomptable.reference, '</td>  "
        . "<td>', piececomptable.libelle, '</td>  "
        . "<td>', lignepiececomptable.montantdebit, '</td>  "
        . "<td>', lignepiececomptable.montantcredit, '</td>"
        . "<td>',lignepiececomptable.montantdebit- lignepiececomptable.montantcredit, '</td>  "
        . "</tr>') as ligne "
        . " FROM Plancomptable, Plandossiercomptable,journalcomptable, piececomptable"
        . ",lignepiececomptable"
        . " WHERE Plandossiercomptable.id=" . $compte
        . " AND piececomptable.id_journalcomptable = journalcomptable.id"
        . " and lignepiececomptable.id_comptecomptable = plandossiercomptable.id"
        . " and lignepiececomptable.id_piececomptable=piececomptable.id"
        . " and plandossiercomptable.id_plan=plancomptable.id "
        . " AND lignepiececomptable.id_comptecomptable=plandossiercomptable.id"
        . " AND  plandossiercomptable.id_dossier = " . $dossier_id
        . "and plandossiercomptable.id_exercice = " . $exercice_id
        .' and (lignepiececomptable.montantdebit !=' . 0.000
        . ' or lignepiececomptable.montantcredit !=' . 0.000.')'
        ;
//die($query);
//        . " ORDER BY Plandossiercomptable.numerocompte"


if ($journal)
    $query = $query . " and piececomptable.id_journalcomptable=" . $journal;
if ($lettre == 'true')
    $query = $query . " and lignepiececomptable.lettrelettrage IS NOT NULL";
if ($non_lettre == 'true')
    $query = $query . " and lignepiececomptable.lettrelettrage IS NULL";
if ($credit == 'true' && $debit == '0')
    $query = $query . 'and lignepiececomptable.montantcredit != ' . 0.000;
if ($debit == '1' && $credit == 'false')
    $query = $query . 'and lignepiececomptable.montantdebit != ' . 0.000;
if ($debit == '1' && $credit == 'true')
    $query = $query . 'and lignepiececomptable.montantdebit !=' . 0.000 . ' or l.montantcredit !=' . 0.000;
$query = $query .
        " GROUP BY Plandossiercomptable.numerocompte,"
        . "plandossiercomptable.numerocompte,Plandossiercomptable.id,"
        . " Plandossiercomptable.libelle, Plandossiercomptable.numerocompte,"
        . "lignepiececomptable.montantdebit ,plandossiercomptable.numerocompte,"
        . "lignepiececomptable.montantcredit,piececomptable.numero,piececomptable.date,"
        . " journalcomptable.code,journalcomptable.libelle, piececomptable.libelle ,lignepiececomptable.reference";
$compte = $conn->fetchAssoc($query);
?>

<div class="row">

    <div class="col-sm-12" id="PDFcontent" >
        <table style="margin-bottom: 2px;margin-top: 2px" id="table_plan" border="1">
            <thead>
                <tr>
                    <th style="width:10%;">Date</th>
                    <th style="width:10%;">Journal Comptable </th>
                    <th style="width:10%;"> Numèro de Pièce  </th>
                     <th style="width:10%;"> Référence de Pièce  </th>
                    <th style="width:20%;">Libellé  </th>
                    <th style="width:10%;">Débit</th>
                    <th style="width:10%;">Crédit  </th>
                    <th style="width:10%;">Solde  </th>
                </tr>
            </thead>
            <tbody id="tblData" >
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


        var tableHTML = encodeURIComponent($("#" + tableID).html());
        console.log(tableHTML);
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