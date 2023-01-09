
<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" 
                onclick="exportTableToExcel('PDFcontent', 'Journal-comptable-Centralisateur-\n\
                <?php echo $_SESSION['exercice']; ?>')">
            <i class="ace-icon fa fa-file-excel-o"></i>
            Exporter Tous Journaux Comptable vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv"> Exporter Journal Comptable   </h1>
</div>
<div id="divdata">


    <div class="row">

        <div class="col-sm-12" id="PDFcontent">
            <?php
            foreach ($journals_interval as $journal) {
                $etatJournal = LignePieceComptableTable::getInstance()->loadEtatJournalCentralisateur($date_debut, $date_fin, $journal->getId());
                if ($etatJournal->count() != 0) {
                    ?>
                    <small> Exporter Journal Journal Comptable -  <?php echo $journal->getCode() . ' ' . $journal->getLibelle(); ?> => Excel</small>

                <?php }
                ?>
                <table style="margin-bottom: 0px;  " id="table_plan" border="1">
                    <thead>
                        <tr><th style="width:10%;">Code Journal</th>
                            <th style="width:10%;">Date</th>
                            <th style="width:10%;">Piece Comptable </th>
                            <th style="width:10%;">Numero Compte  </th>
                            <th style="width:30%;">Libelle  </th>
                            <th style="width:20%;">Debit</th>
                            <th style="width:20%;">Credit  </th>
                        </tr>
                    </thead>
                    <tbody id="tblData">
                        <?php
//                    echo implode('', array_map(function ($entry) {
//                                return $entry['ligne'];
//                            }, $compte));
                        ?>
                        <tr>
                            <?php foreach ($etatJournal as $fiche) : ?>
                                <td>
                                    <?php echo $fiche->getPiececomptable()->getJournalcomptable()->getCode() . ' - ' . $fiche->getPiececomptable()->getJournalcomptable()->getLibelle(); ?>
                                </td>
                                <td>
                                    <?php echo date('d/m/Y', strtotime($journal->getPiececomptable()->getDate())); ?>
                                </td>
                                <td>
                                    <?php echo $fiche->getPiececomptable()->getNumero(); ?>
                                </td>
                                <td>   
                                    <?php echo $fiche->getPlandossiercomptable()->getNumerocompte(); ?>
                                </td>
                                <td>
                                    <?php echo $fiche->getLibelle(); ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php
                                    if ($fiche->getMontantDebit() == 0):
                                        echo '';
                                    else:
                                        echo $fiche->getMontantDebit();
                                        $resultat_debit = $resultat_debit + $fiche->getMontantdebit();
                                    endif;
                                    ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php
                                    if ($fiche->getMontantCredit() == 0):
                                        echo '';
                                    else:
                                        echo $fiche->getMontantCredit();
                                        $resultat_credit = $resultat_credit + $fiche->getMontantcredit();

                                    endif;
                                    ?>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>

</div>

<script  type="text/javascript">

    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableHTML = encodeURIComponent($("#" + tableID).html());
        ;
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
