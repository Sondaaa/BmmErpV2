<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Liste des BDC Regroupe Definitifs')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter  Liste des Bon dépense au comptant Regroupe provisoire par fournisseur  vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv"> Liste des Bon dépense au comptant Regroupe Definitif par fournisseur

        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter liste des BDCP => Excel</small>
    </h1>


</div>

<?php
$year = date('Y');
$q = Doctrine_Core::getTable('documentachat')
        ->createQuery('d')
        ->where('d.id_typedoc=22');
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
                    <td style="text-align:center;width: 5%;">N°</td>
                    <td style="text-align:center;width: 15%;">N° BDCP</td>
                    <td style="text-align:center;width: 15%;">
                        Date de Création
                    </td>
                    <td style="text-align:center;width: 15%;">N° BCI</td>
                    <td style="text-align:center;width: 20%;">Fournissuer</td>
                    <td style="text-align:center;width: 15%;">Mnt.TTC</td>
                    <td style="text-align:center;width: 15%;">Imputation budgétaire</td>
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
                            <?php echo $documentachat; ?>
                        </td>

                        <td style="text-align: center">
                            <?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?>
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

                        <td >
                            <?php
                            echo $documentachat->getFournisseur()->getRs()
                            ?>
                        </td>

                        <td style="text-align: right">
                            <?php echo number_format($documentachat->getMntttc(), 3, ",", ".") ?>

                        </td>
                        <td>
                            <?php
                            $document_achat_externe_difinitif = Doctrine_Core::getTable('documentachat')->findByIdAndIdTypedoc($documentachat->getId(), 17);

                            if (sizeof($document_achat_externe_difinitif) >= 1) {

                                $id_docparent = $document_achat_externe_difinitif->getFirst()->getId();
                                $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($id_docparent);
                                if (sizeof($piecejoint) >= 1) {
                                    if ($piecejoint->getFirst())
                                        $id_document_udget_achatt = $piecejoint->getFirst()->getIdDocumentbudget();
                                    $document_udget_ordanancemet = Doctrine_Core::getTable('documentbudget')->findById($id_document_udget_achatt);
                                    if (sizeof($document_udget_ordanancemet) >= 1) {
                                        $piece_budget = Doctrine_Core::getTable('Piecejointbudget')->findByIdDocachatAndIdDocumentbudget($id_docparent, $document_udget_ordanancemet->getFirst()->getId());
                                        if (sizeof($piece_budget) >= 1) {
                                            if (($piece_budget->getFirst()->getId() != null))
                                                echo $piece_budget->getFirst()->getDocumentbudget()->getLigprotitrub()->getTitrebudjet()
                                                . ' - ' . $piece_budget->getFirst()->getDocumentbudget()->getLigprotitrub()->getRubrique();
                                        }
                                    }
                                }
                            } else {
                                echo '';
                            }
                            ?>
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