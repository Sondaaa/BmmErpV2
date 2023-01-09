<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Suivi-Contrat')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter suivi des ontrats vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv"> 
        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter suivi des contrats => Excel</small>
    </h1>
</div>
<?php
$contratachats = ContratachatTable::getInstance()->findAll();
?>

<div class="row">
    <div class="col-sm-12" id="PDFcontent">
        <?php
       foreach ($contratachats as $contrat):
                        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                        $query = "SELECT    contratachat.id"
                                . " FROM    contratachat ,documentachat"
                                . " WHERE documentachat.id_contrat =" . $contrat->getId() . ""
                                . " and documentachat.datecreation >= '" .  $start_date."'"
                                . " and  documentachat.datecreation <= '" . $end_date. "'"
                                . " and documentachat.id_typedoc=6"
                                . " order by id desc";

                        $fichecontrat = $conn->fetchAssoc($query);
                        if (sizeof($fichecontrat) >= 1):
            
                ?>
                <table style="margin-bottom: 0px;margin-top: 2px;width: 100%" id="table_plan" border="1">
                    <thead>
                        <tr  > <th style="widows: 100%;text-align: center;font-size: 14px"  colspan="9">
                    <h4><b><i>Contrat <?php echo $contrat->getReference() . '   N° ' . $contrat->getNumero(); ?></i></b></h4></th>
                    </tr>
                    <tr style="background-color: #fff; background: repeat-x #F2F2F2;font-size: 14px;text-align: center">
                        <th  style="widows: 25%;text-align: center;max-width: 25%" class="fixed-side" scope="col"   >Articles</th> 
                        <th style="widows: 10%;text-align: center;max-width: 10%"  scope="col">N° BCI</th>

                        <th style="widows: 10%;text-align: center;max-width: 10%"  scope="col">N°BCE D</th>
                        <th style="widows: 10%;text-align: center;max-width: 10%"  scope="col">Date BCE D</th>
                        <th style="widows: 10%;text-align: center;max-width: 10%"  scope="col">Montant</th>
                        <th style="widows: 15%;text-align: center;max-width: 15%" colspan="2">Montant Contrat</th>
                        <th style="widows: 20%;text-align: center;max-width: 20%" colspan="2">Observation | Projet</th>
                    </tr>


                    </thead>
                    <tbody id="tblData">

                    <tbody>
                        <?php
                        $total = 0;
                        $montant_contrat = $contrat->getMontantcontrat();
//                        $documentachats = DocumentachatTable::getInstance()->findAll();
                        if (sizeof($documentachats) >= 1) {
                            foreach ($documentachats as $docachat) {
                                $doc_achat = $docachat->getContratachat();

                                if (count($doc_achat) >= 1) {
                                    $rowspan = count($doc_achat);
                                    if ($docachat->getIdContrat() == $contrat->getId()) {
                                        ?>
                                        <tr>
                                            <td style="text-align: left" >
                                                <?php foreach ($docachat->getLignedocachat() as $ligne): ?>
                                                    <?php echo trim($ligne->getDesignationarticle()) . '**'; ?>
                                                <?php endforeach; ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo trim($docachat->getNumerodocachat());
                                                ?>

                                            </td>



                                            <td style="text-align: center">
                                                <?php
                                                $document_achat_externe_difinitif = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($docachat->getId(), 15);
                                                if (sizeof($document_achat_externe_difinitif) >= 1) {
                                                    echo $document_achat_externe_difinitif->getFirst()->getNumerodocachat();
                                                    $total = $total + $document_achat_externe_difinitif->getFirst()->getMntttc();
                                                } else
                                                    echo '';
                                                ?></td>
                                            <td style="text-align: center">
                                                <?php
                                                $document_achat_externe_difinitif = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($docachat->getId(), 15);
                                                if (sizeof($document_achat_externe_difinitif) >= 1) {
                                                    echo date('d/m/Y', strtotime($document_achat_externe_difinitif->getFirst()->getDatecreation()));
                                                } else
                                                    echo '';
                                                ?></td>

                                            <td style="text-align: right">
                        <?php
                        if (sizeof($document_achat_externe_difinitif) >= 1)
                            echo number_format($document_achat_externe_difinitif->getFirst()->getMntttc(), 3, ".", " ");
                        else
                            echo '';
                        ?>
                                            </td>
                                                <?php // if (count($doc_achat) >= 1)rowspan="<?php echo $rowspan;   ?>
                                            <td style="text-align: right" colspan="2" >
                                            <?php echo number_format($docachat->getContratachat()->getMontantcontrat(), 3, ".", " "); ?>
                                            </td>

                                            <td colspan="2">
                        <?php foreach ($docachat->getLignedocachat() as $ligne): ?>
                                                    <?php echo trim($ligne->getObservation()) . ' | ' . trim($ligne->getProjet()); ?>
                                                <?php endforeach; ?>
                                            </td>


                                        </tr>

                        <?php
                    }
                }
            }
        }else {
                                        ?>
                                        <tr>
                                            <td style="text-align: center;max-width: 20%" colspan="14">
                                                Liste des BCIS des Contrats est vide
                                            </td>
                                        </tr>
                                    <?php } ?>
       
                    </tbody>
                    <tfoot>
                        <tr style="background-color: #fff; background: repeat-x #F2F2F2;font-size: 14px;text-align: center"><td colspan="4">Somme des Achats</td>
                            <td style="text-align: right">
                                <?php
                                echo number_format($total, 3, ".", " ");
                                ;
                                ?>
                            </td>
                            <td colspan="4"></td>
                        </tr>
                        <tr style="background-color: #fff; background: repeat-x #F2F2F2;font-size: 14px;text-align: center"><td colspan="4">Le Reste</td>
                            <td colspan="2"></td>
                            <td style="text-align: right">
                                <?php
                                $reste = $montant_contrat - $total;
                                echo number_format($reste, 3, ".", " ");
                                ;
                                ?>
                            </td>  
                            <td colspan="2"></td></tr>
                    </tfoot>
                </table>
            <?php
            endif;
        endforeach;
        ?>
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