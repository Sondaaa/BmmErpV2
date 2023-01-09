<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Liste des Contrats Provisoires')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter  Liste des Contrats  vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv"> Liste des Contrats

        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter liste des Contrats => Excel</small>
    </h1>


</div>

<?php
$q = Doctrine_Core::getTable('documentachat')
        ->createQuery('d')
        ->where('d.id_typedoc=19 ');
if ($datedebut != '')
    $q->andWhere("datecreation >= '" . $datedebut . "'");
if ($datefin != '')
    $q->andWhere("datecreation <= '" . $datefin . "'");

if ($datefin == '' && $datedebut == '')
    $q->Andwhere("datecreation>='" . date('Y') . "-01-01" . "'")
            ->Andwhere("datecreation<='" . date('Y') . "-12-31" . "'");
if ($idfrs != '')
    $q->andWhere("a.reference like '%" . $idfrs . "%'");

$documentachats = $q->execute();
?>

<div class="row">
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px; margin-top: 2px" id="table_plan" border="1">
            <thead>
                <tr>
                    <td style="text-align:center;width: 10%;">N°</td>
                    <td style="text-align:center;width: 15%;">N°Contrat</td>
                    <td style="text-align:center;width: 15%;">
                        Date de Création
                    </td>
                    <td style="text-align:center;width: 15%;">N° BCI</td>
                    <td style="text-align:center;width: 30%;">Fournissuer</td>
                    <td style="text-align:center;width: 15%;">Mnt.TTC</td>

                </tr>
            </thead>
            <tbody id="tblData">
                <tr>  
                    <?php
                    $i = 1;
                    foreach ($documentachats as $documentachat):
                        $numero = strtoupper($documentachat->getTypedoc());
                        $numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
                        ?>
                        <td style="text-align: center">
                            <?php echo $i; ?>
                        </td>
                        <td style="text-align: center">
                            <?php echo $documentachat->getContratachat()->getNumerodocumentachat(); ?>
                        </td>

                        <td style="text-align: center">
                            <?php echo date('d/m/Y', strtotime($documentachat->getContratachat()->getDatecreation())); ?>
                        </td>


                        <?php
                        $documents_parent = DocumentparentTable::getInstance()->findByIdDocumentachat($documentachat->getId());
                        if ($documents_parent->count() != 0) {
                            foreach ($documents_parent as $doc) {
                                $doc_achat = DocumentachatTable::getInstance()->find($doc->getIdDocumentparent());
                                ?>
                                <td style="text-align: center"> <?php echo $doc_achat ?> </td>
                                <?php
                            }
                        } else {
                            ?>
                            <td style="text-align: center"> <?php echo $documentachat->getDocumentparent() ?> </td>
                        <?php } ?>

                        <td style="text-align: center">
                            <?php
                            echo $documentachat->getContratachat()->getFournisseur()->getRs()
                            ?>
                        </td>

                        <td style="text-align: right">
                            <?php echo number_format($documentachat->getContratachat()->getMontantcontrat(), 3, ".", " ") ?>

                        </td>
                    </tr>
                    <?php
                    $i++;
                endforeach;
                ?>
            </tbody>

        </table>
    </div>
</div>

<script  type="text/javascript">

    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
//        var thead = "<tr><td>Libelle </td>\n\
//        <td>Agent</td><td>Unite</td><td> Service</td><td> Sous direction</td>\n\
//t<d>Direction</td></tr>";
//        var tableHTML = "<table>" + thead + encodeURIComponent($("#" + tableID).html())
//                + "</table>";

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