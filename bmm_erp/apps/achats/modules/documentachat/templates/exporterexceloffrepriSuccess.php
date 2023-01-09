<div id="sf_admin_container">
    <div class="col-sm-12">
        
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Offre-prix')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter Tableau comparatif des prix vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv">
        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter Tableau comparatif des prix => Excel</small>
    </h1>
</div>


<div class="row" style="max-width: 100%">
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px;margin-top: 2px;width: 100%" id="table_plan" border="1">
            <thead>
                <tr>
                <th style="width: 2%;text-align: center;">#</th>

                    <th style="width: 5%;text-align: center;">Désignation</th>
                    <th style="width: 7%;text-align: center"> Caracteristiques <br>
                                                            Techniques demandées</th>
                    <th style="width: 3%;text-align: center">Soumissionnaires</th>
                    <th style="width: 5%;text-align: center">caractéristiques techniques,<br>
                                                            marques et références prposées </th>
                    <th style="width: 5%;text-align: center ">Unité de mesure</th>
                    <th style="width: 5%;text-align: center ">Quantité</th>
                    <th style="width: 5%;text-align: center">PUHT</th>
                    <th style="width: 5%;text-align: center">TVA</th>
                    <th style="width: 5%;text-align: center">PUTT</th>
                    <th style="width: 7%;text-align: center">PTTTC</th>
                </tr>
            </thead>
            <tbody id="tblData">
                <?php $i = 1;?>
                <?php foreach ($documentachats as $key => $docachat): ?>
            <?php $ligne_docachat = LignedocachatTable::getInstance()->findByIdDoc($docachat->getId());?>
            <?php foreach ($ligne_docachat as $key => $ligne): ?>
            <tr class="ligne_compte">
                    <td style="width: 2%;text-align: center;">
                     <?php echo $i; ?>
                    </td>
                <td style="text-align: center;width: 5%;">
                    <?php echo $ligne->getDesignationarticle(); ?>
                </td>
                <td style="text-align: center;width: 5%;">
                    <?php echo $ligne->getCaracteristiquearticle(); ?>
                </td>
                <td style="text-align: center;width: 5%;">
                    <?php echo $ligne->getDocumentachat()->getFournisseur()->getRs(); ?>
                </td>
                <td style="text-align: center;width: 5%;">
                    <?php echo $ligne->getCaracteristiquearticle(); ?>
                </td>
                <td style="text-align: center;width: 5%;">
                    <?php echo $ligne->getUnitemarche(); ?>
                </td>
                <td style="text-align: center;width: 5%;">
                    <?php echo $ligne->getQte(); ?>
                </td>
                <td style="text-align: center;width: 5%;">
                    <?php echo number_format($ligne->getPu(), 3, ".", " "); ?>
                </td>
                <td style="text-align: center;width: 5%;">
                    <?php echo $ligne->getTva(); ?>
                </td>
                <td style="text-align: center;width: 5%;">
                    <?php $tau_tva = $ligne->getTva()->getValeurtva();
$mnttva = $ligne->getPu() * $tau_tva;
echo number_format($ligne->getPu()+$mnttva, 3, ".", " ");?>
                </td>
                <td style="text-align: center;width: 5%;">
                    <?php echo number_format($ligne->getPu(), 3, ".", " "); ?>
                </td>
            </tr>
                    <?php $i++;endforeach;?>
               <?php endforeach;?>

            </tbody>
        </table>
    </div>
</div>


<script type="text/javascript">
    function exportTableToExcel(tableID, filename = '') {
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