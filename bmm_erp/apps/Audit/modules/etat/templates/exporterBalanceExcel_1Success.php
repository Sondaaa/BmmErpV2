<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Balance-comptable-<?php echo $_SESSION['exercice']; ?>')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter  Balance vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv"> 

        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter Balance Comptable => Excel</small>
    </h1>


</div>

<?php
$exercice_antireur = ExerciceTable::getInstance()->getByLibelle($_SESSION['exercice'] - 1)->getFirst();

$conn = Doctrine_Manager::getInstance()->getCurrentConnection();

for ($i = 0; $i < (sizeof($balance) - 1); $i++):

    //if ($balance[$i]['debitMois'] != 0 || $balance[$i]['creditMois'] != 0):
//        $query = "SELECT CONCAT('<tr>"
//                . "<td>', classecompte.code,'</td>"
//                . "<td>', Plandossiercomptable.numerocompte,'</td> "
//                . "<td>', Plandossiercomptable.libelle,'</td> "
////            . "<td>', piececomptable.numero,'</td> "
//                . "<td>', coalesce(SUM(lignepiececomptable.montantdebit),0),'</td> "
//                . "<td>', coalesce(SUM(lignepiececomptable.montantcredit),0), '</td>,  "
////        . "<td>', lignepiececomptable.montantdebit, '</td>,  "
////        . "<td>', lignepiececomptable.montantcredit, '</td>"
//                . "</tr>') as ligne "
//                . " FROM Plancomptable, Plandossiercomptable,journalcomptable, piececomptable"
//                . ",lignepiececomptable,classecompte"
//                . " WHERE trim(Plandossiercomptable.numerocompte) >='" . trim($compte_min) . "'"
//                . " AND trim(Plandossiercomptable.numerocompte) <='" . trim($compte_max) . "'"
//                . " and plandossiercomptable.id=" . $balance[$i]['id']
//                . " AND piececomptable.id_journalcomptable = journalcomptable.id"
//                . " and lignepiececomptable.id_comptecomptable = plandossiercomptable.id"
//                . " and lignepiececomptable.id_piececomptable=piececomptable.id"
//                . " and plandossiercomptable.id_plan=plancomptable.id "
//                . " AND plancomptable.id_classe=classecompte.id"
//        . " and plancomptable.id_classe  in (1,2,3,4,5,6,7) "
//                . " AND lignepiececomptable.id_comptecomptable=plandossiercomptable.id"
//                . " AND  plandossiercomptable.id_dossier = " . $dossier_id
//               
//                . "and plandossiercomptable.id_exercice = " . $exercice_antireur
//
//        ;
//        $query = $query .
//                " GROUP BY Plandossiercomptable.numerocompte,classecompte.code,"
//                . "plandossiercomptable.numerocompte,Plandossiercomptable.id,"
//                . " Plandossiercomptable.libelle, Plandossiercomptable.numerocompte,"
//                . "lignepiececomptable.montantdebit ,plandossiercomptable.numerocompte,"
//                . "lignepiececomptable.montantcredit,piececomptable.numero,classecompte.code"
//                . " order by plandossiercomptable.numerocompte ";
//
//        $compte = $conn->fetchAssoc($query);
    ?>
    <div class="row">
        <div class="col-sm-12" id="PDFcontent">
            <table style="margin-bottom: 0px; margin-top: 2px" id="table_plan" border="1">
                <thead>
                    <tr>
                        <!--<th style="width:10%;">Classe </th>-->
                        <th style="width:10%;">Numero compte</th>
                        <th style="width:20%;">Compte Comptable</th>
                        <th style="width:15%;">Debit Cumulé</th>
                        <th style="width:15%;"> Credit Cumulé  </th>
                        <th style="width:20%;">Solde Debiteur</th>
                        <th style="width:20%;">Solde Crediteur  </th>
                         <!--<th style="width:20%;">Code C.C.Primitive  </th>-->
                    </tr>
                </thead>
                <tbody id="tblData">
                    <?php
                    $resultat_debit_cumul = 0;
                    $resultat_credit_cumul = 0;
                    $resultat_debit = 0;
                    $resultat_credit = 0;
//                        echo implode('', array_map(function ($entry) {
//                                    return $entry['ligne'];
//                                }, $compte));
                    ?>
                    <tr>  
                        <?php
                        for ($i = 0; $i < (sizeof($balance) - 1); $i++):
                            if ($balance[$i]['debitMois'] != 0 || $balance[$i]['creditMois'] != 0 || $balance[$i]['creditOuv'] != 0 || $balance[$i]['debitOuv'] != 0):
                                ?>
                                                                    <!--                                <td>
                                <?php // echo $balance[$i]['classe'];      ?>
                                                                                            </td>-->
                                <td>
                                    <?php echo $balance[$i]['compte']; ?>
                                </td>
                                <td>
                                    <?php echo $balance[$i]['libelle']; ?>
                                </td>

                                <td style="text-align: center">
                                    <?php
                                    if ($balance[$i]['debitCumulMois'] != 0) {
                                        echo number_format($balance[$i]['debitCumulMois'], 3, '.', ' ');
                                        $resultat_debit_cumul+=$balance[$i]['debitCumulMois'];
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center">
                                    <?php
                                    if ($balance[$i]['crediCumultMois'] != 0) {
                                        echo number_format($balance[$i]['crediCumultMois'], 3, '.', ' ');
                                        $resultat_credit_cumul+=$balance[$i]['crediCumultMois'];
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center">
                                    <?php
                                    if ($balance[$i]['debiteur'] != 0) {
                                        echo number_format($balance[$i]['debiteur'], 3, '.', ' ');
                                        $resultat_debit+=$balance[$i]['debiteur'];
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center">
                                    <?php
                                    if ($balance[$i]['crediteur'] != 0) {
                                        echo number_format($balance[$i]['crediteur'], 3, '.', ' ');
                                        $resultat_credit+=$balance[$i]['crediteur'];
                                    }
                                    ?>
                                </td>
                                <?php
//                        if ($balance[$i]['debitCumulMois'] - $balance[$i]['crediCumultMois'] > 0):
                                ?>
                                        <!--<td>-->   
                                <?php
//                                echo number_format($balance[$i]['debiteur'], 3, '.', ' ');
                                ?>
                                <!--</td>-->
                                <?php ?>
            <!--                                    <td>
                                <?php //   echo number_format($balance[$i]['crediteur'], 3, '.', ' ');  ?> 
                                </td>-->
                                <?php // elseif ($balance[$i]['debitCumulMois'] - $balance[$i]['crediCumultMois'] < 0):     ?>
            <!--                                    <td></td>
                                <td>
                                <?php // echo number_format($balance[$i]['crediCumultMois'] - $balance[$i]['debitCumulMois'], 3, '.', ' ');  ?>
                                </td>

                                <?php // elseif ($balance[$i]['debitCumulMois'] == 0 && $balance[$i]['crediCumultMois'] == 0):     ?>
                                <td></td><td></td>-->
                                <?php // endif;
                                ?>
                            </tr>

                        <?php endif; endfor; ?>
                </tbody>
                <tfoot> <tr>
                        <td>Totaux</td>
                        <td></td>
 <td style="text-align: right">
                            <?php
                            echo number_format($resultat_debit_cumul, 3, '.', ' ');
                            ?> 
                        </td>
                        <td style="text-align: right">
                            <?php
                            echo number_format($resultat_credit_cumul, 3, '.', ' ');
                            ?>
                        </td>
                        <td style="text-align: right">
                            <?php
                            echo number_format($resultat_debit, 3, '.', ' ');
                            ?> 
                        </td>
                        <td style="text-align: right">
                            <?php
                            echo number_format($resultat_credit, 3, '.', ' ');
                            ?>
                        </td>
                    </tr></tfoot>
            </table>
        </div>
    </div>
    <?php
endfor;
?>
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