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
//$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//$query = "SELECT CONCAT('<tr>"
//        . "<td>', plandossiercomptable.numerocompte,'</td>"
//        . "<td>', piececomptable.date,'</td>"
//        . "<td>',Concat(journalcomptable.code ,' ' ,journalcomptable.libelle) ,'</td> "
//        . "<td>', piececomptable.numero,'</td> "
//        . "<td>', piececomptable.libelle, '</td>  "
//        . "<td>', lignepiececomptable.montantdebit, '</td>  "
//        . "<td>', lignepiececomptable.montantcredit, '</td>"
////        . "<td>', lignepiececomptable.montantdebit, '</td>,  "
////        . "<td>', lignepiececomptable.montantcredit, '</td>"
//        . "</tr>') as ligne "
//        . " FROM Plancomptable, Plandossiercomptable,journalcomptable, piececomptable"
//        . ",lignepiececomptable,classecompte"
//        . " WHERE trim(Plandossiercomptable.numerocompte) >='" . trim($compte_min) . "'"
//        . " AND trim(Plandossiercomptable.numerocompte) <='" . trim($compte_max) . "'"
//        . " AND piececomptable.id_journalcomptable = journalcomptable.id"
//        . " and lignepiececomptable.id_comptecomptable = plandossiercomptable.id"
//        . " and lignepiececomptable.id_piececomptable=piececomptable.id"
//        . " and plandossiercomptable.id_plan=plancomptable.id "
//        . " AND plancomptable.id_classe=classecompte.id"
//        . " AND lignepiececomptable.id_comptecomptable=plandossiercomptable.id"
//        . " AND  plandossiercomptable.id_dossier = " . $dossier_id
//        . " and plandossiercomptable.id_exercice = " . $exercice_id
////        . " and piececomptable.date >=" . date('Y-m-d' ,$date_debut)
//;
//if ($date_debut != '')
//    $guery = $query . " and piececomptable.date >" . $date_debut;
//if ($date_fin)
//    $guery = $query . " and piececomptable.date <=" . $date_fin;
//$guery = $query . " GROUP BY Plandossiercomptable.numerocompte,classecompte.code,"
//        . "plandossiercomptable.numerocompte,Plandossiercomptable.id,"
//        . " Plandossiercomptable.libelle, Plandossiercomptable.numerocompte,"
//        . "lignepiececomptable.montantdebit ,plandossiercomptable.numerocompte,"
//        . "lignepiececomptable.montantcredit,piececomptable.numero,piececomptable.date,"
//        . " journalcomptable.code,journalcomptable.libelle, lignepiececomptable.libelle "
//        . " ORDER BY Plandossiercomptable.numerocompte ,piececomptable.date asc ";
//$compte = $conn->fetchAssoc($query);
////die($query);
$resultat_credit = 0;
$resultat_debit = 0;
?>

<div class="row">
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px;margin-top: 2px" id="table_plan" border="1">
            <thead>
                <tr>
                    <th style="width:10%;">Numèro compte</th>
                    <th style="width:10%;">Compte comptable</th>
                    <th style="width:10%;">Date</th>
                    <th style="width:10%;">Journal Comptable </th>
                    <th style="width:10%;"> Numèro de Pièce  </th>
                    <th style="width:20%;">Libellé  </th>
                    <th style="width:10%;">Débit</th>
                    <th style="width:10%;">Crédit  </th>
                    <th style="width:10%;">Solde Débiteur  </th>
                    <th style="width:10%;">Solde Créditeur  </th>
                </tr>
            </thead>
            <tbody id="tblData">
                <tr>
                    <?php foreach ($etatLivre as $livre) : ?>
                        <td>
                            <?php echo $livre->getPlandossiercomptable()->getNumerocompte(); ?>
                        </td>
                          <td style="text-align: center;">
                            <?php echo $livre->getPlandossiercomptable()->getLibelle() ?>
                        </td>
                        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($livre->getPiececomptable()->getDate())) ?></td>
                        <td style="text-align: left;"><?php echo $livre->getPiececomptable()->getJournalcomptable()->getCode() . ' ' . $livre->getPiececomptable()->getJournalcomptable()->getLibelle() ?></td>


                        <td style="text-align: center;">
                            <?php echo $livre->getPiececomptable()->getNumero() ?>
                        </td>
                      
                        <td style="text-align: center;"><?php echo $livre->getPiececomptable()->getLibelle() ?></td>

                        <td style="text-align: right;">
                            <?php
                            if ($livre->getMontantDebit() == 0):
                                echo '';
                            else:
                                echo $livre->getMontantDebit();
                                $resultat_debit = $resultat_debit + $livre->getMontantdebit();
                            endif;
                            ?>
                        </td>
                        <td style="text-align: right;">
                            <?php
                            if ($livre->getMontantCredit() == 0):
                                echo '';
                            else:
                                echo $livre->getMontantCredit();
                                $resultat_credit = $resultat_credit + $livre->getMontantcredit();

                            endif;
                            ?>
                        </td>

                        <?php if ($livre->getMontantDebit() - $livre->getMontantCredit() > 0): ?>
                            <td style="text-align: right;"> <?php echo $livre->getMontantDebit() - $livre->getMontantCredit(); ?></td>
                            <td style="text-align: right;"> </td>
                        <?php elseif ($livre->getMontantDebit() - $livre->getMontantCredit() < 0): ?>
                            <td style="text-align: right;"></td>
                            <td style="text-align: right;">
                                <?php echo abs($livre->getMontantDebit() - $livre->getMontantCredit()); ?>
                            </td>
                        <?php else: ?><td style="text-align: right;"></td>
                            <td style="text-align: right;">

                            </td>
                        <?php endif; ?>
                        </td>
                    </tr>  <?php endforeach; ?>
            </tbody>
        </table>
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