<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" 
                onclick="exportTableToExcel('data_journal_centra', 'Journal-comptable-Centralisateur-\n\
                <?php echo $_SESSION['exercice']; ?>')">
            <i class="ace-icon fa fa-file-excel-o"></i>
            Exporter Journal Comptable Centralisateur vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv"> Exporter Journal Comptable Centralisateur  </h1>
</div>
<div id="data_journal_centra">
    <?php
    foreach ($journals_interval as $journal) {
        $etatJournal = LignePieceComptableTable::getInstance()->loadEtatJournalCentralisateur($date_debut, $date_fin, $journal->getId());
        if ($etatJournal->count() == 0) {
            ?>
            Exporter Journal Comptable -  <?php echo $journal->getCode() . ' ' . $journal->getLibelle(); ?> => Excel

        <?php }
        ?>


        <?php
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $query = "SELECT CONCAT('<tr>"
                . "<td>', journalcentralisateur.mois,'</td>"
                . "<td>', journalcentralisateur.debit, '</td>  "
                . "<td>', journalcentralisateur.credit, '</td></tr>') as ligne "
                . " FROM journalcomptable, journalcentralisateur"
                . " WHERE journalcomptable.id =" . $journal->getId()
                . " AND journalcentralisateur.id_journal = journalcomptable.id"
        ;
        $query = $query . " Group By journalcomptable.id,journalcentralisateur.mois, journalcentralisateur.debit, journalcentralisateur.credit"
                . " ORDER BY journalcomptable.id";
        $compte = $conn->fetchAssoc($query);
        ?>

        <div class="row">

            <div class="col-sm-12" id="PDFcontent">
                <table style="margin-bottom: 0px;" id="table_plan" border="1">
                    <thead>
                        <tr>
                            <th style="width:10%;">Date</th>

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
    </div>
<?php }?>
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
