<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('tblData', 'Journal-comptable-<?php echo $_SESSION['exercice']; ?>')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter Tous Journaux Comptable vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv"> Exporter >Tous Jouranux Comptable </h1>
    <?php
    foreach ($journals_interval as $journal) {
        $etatJournal = LignePieceComptableTable::getInstance()->loadEtatJournal($date_debut, $date_fin, $date_debut_journal, $date_fin_journal, $journal->getId());
        ?>
        <small> Journal Comptable -  <?php echo $journal->getCode() . ' ' . $journal->getLibelle(); ?> => Excel</small>
    </div>

    <?php
//    foreach ($journals_interval as $journal) {
    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
    $query = "SELECT CONCAT('<tr>"
            . "<td>', CONCAT(journalcomptable.code,journalcomptable.libelle),'</td>"
            . "<td>', piececomptable.date,'</td>"
            . "<td>', piececomptable.numero,'</td> "
            . "<td>', plandossiercomptable.numerocompte,'</td> "
            . "<td>', lignepiececomptable.libelle, '</td>,  "
            . "<td>', lignepiececomptable.montantdebit, '</td>,  "
            . "<td>', lignepiececomptable.montantcredit, '</td></tr>') as ligne "
            . " FROM journalcomptable, lignepiececomptable, piececomptable,plandossiercomptable"
            . " WHERE journalcomptable.id =" . $journal->getId()
            . " AND lignepiececomptable.id_piececomptable = piececomptable.id"
            . " AND piececomptable.id_journalcomptable = journalcomptable.id "
            . " AND lignepiececomptable.id_comptecomptable=plandossiercomptable.id "
//            . " AND journalcomptable.datedebutcloture <= ". $date_debut_journal
//            ." AND journalcomptable.datefincloture >= ". $date_fin_journal
    ;
//    }
//    if ($date_debut_journal != '')
//        $query = $query . " And journalcomptable.datedebutcloture <= " . date('Y-m-d', strtotime($date_debut_journal));
//
//    if ($date_fin_journal != '')
//        $query = $query . " and journalcomptable.datefincloture >= " . $date_fin_journal;
    $query = $query . " Group By journalcomptable.id,piececomptable.numero,"
            . "lignepiececomptable.libelle, lignepiececomptable.montantdebit"
            . ", lignepiececomptable.montantcredit ,plandossiercomptable.numerocompte, piececomptable.date "
            . " ORDER BY piececomptable.numero";
    $compte = $conn->fetchAssoc($query);
    ?>

    <div class="row">

        <div class="col-sm-12" id="PDFcontent">
            <table style="margin-bottom: 0px;
                   " id="table_plan">
                <thead>
                    <tr><th style="width:10%;">Code Journal</th>
                        <th style="width:10%;">Date</th>
                        <th style="width:10%;">Pièce Comptable </th>
                        <th style="width:10%;">Numèro Compte  </th>
                        <th style="width:30%;">Libellé  </th>
                        <th style="width:20%;">Débit</th>
                        <th style="width:20%;">Crédit  </th>
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
        var thead = "<tr><td>Date</td><td>Piece comptable</td><td>Numero</td><td>Libelle</td><td>Debit</td><td>Credit</td></tr>";
        var tableHTML = "<table>" + thead + encodeURIComponent($("#" + tableID).html()) + "</table>";
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
<?php } ?>