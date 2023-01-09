<div id="sf_admin_container">
    <div class="col-sm-12">
        
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'madel-Tyneps')">
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
                <th style="width: 2%;text-align: center;">Numero</th>

                    <th style="width: 5%;text-align: center;">Nom</th>
                    <th style="width: 7%;text-align: center"> Description</th>
                    <th style="width: 3%;text-align: center">Cautionnement</th>
                    <th style="width: 5%;text-align: center">Devise</th>
                    <th style="width: 5%;text-align: center ">Estimation</th>
                </tr>
            </thead>
            <tbody id="tblData">
                <?php $i = 1;?>
                <?php foreach ($lignesdocachats as $key => $ligne): ?>
            <tr class="ligne_compte">
                    <td style="width: 2%;text-align: center;">
                     <?php echo $i; ?>
                    </td>
                <td style="text-align: center;width: 5%;">
                    <?php echo $ligne->getDesignationarticle(); ?>
                </td>
                <td style="text-align: center;width: 5%;">
                    <?php echo $ligne->getObservation(); ?>
                </td>
                
                <td style="text-align: center;width: 5%;">
                    <?php echo $ligne->getCautionnement(); ?>
                </td>
                <td style="text-align: center;width: 5%;">
                    <?php echo $ligne->getDevise(); ?>
                </td>
                <td style="text-align: center;width: 5%;">
                    <?php echo $ligne->getEstimation(); ?>
                </td>
                
               
            </tr>
                    <?php $i++;endforeach;?>
              

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