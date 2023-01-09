<div id="sf_admin_container">
    <h1 id="replacediv"> Article 
        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter Liste des Article</small>
    </h1>
</div>

<?php
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$query = "SELECT CONCAT('<tr><td>', TRIM(article.codeart), '</td><td>', TRIM(article.designation), '</td><td>', TRIM(famillearticle.code), ' : ', TRIM(famillearticle.libelle), '</td><td>', TRIM(sousfamillearticle.code), ' : ', TRIM(sousfamillearticle.libelle), '</td><td>', TRIM(unitemarche.libelle), '</td><td>', article.aht, '</td><td>', TRIM(tva.libelle), '</td><td>', article.attc, '</td><td>', article.pamp, '</td></tr>') as ligne"
        . " FROM article, famillearticle, sousfamillearticle, unitemarche, tva"
        . " WHERE article.id_famille = famillearticle.id AND article.id_sousfamille = sousfamillearticle.id "
        . " AND article.id_unite = unitemarche.id AND article.id_tva = tva.id "
        . " ORDER BY article.designation, article.codeart";
$compte = $conn->fetchAssoc($query);
?>

<div class="row">
    <div class="col-sm-12">
        <button id="gpdf" class="btn btn-xs btn-danger">
            <i class="ace-icon fa fa-file-pdf-o"></i> Exporter Liste Article vers Fichier PDF
        </button>
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('tblData', 'Liste des Articles')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter Liste Article vers Fichier Excel
        </button>
    </div>
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px;" id="table_article">
            <thead>
                <tr>
                    <th style="width: 8%; text-align: center;">Code</th>
                    <th style="width: 23%; text-align: center;">Désignation</th>
                    <th style="width: 17%; text-align: center;">Famille</th>
                    <th style="width: 15%; text-align: center;">Sous Famille</th>
                    <th style="width: 8%; text-align: center;">Unité</th>
                    <th style="width: 8%; text-align: center;">Achat HT</th>
                    <th style="width: 5%; text-align: center;">T.V.A</th>
                    <th style="width: 8%; text-align: center;">Achat TTC</th>
                    <th style="width: 8%; text-align: center;">PAMP</th>
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

<div id="ignoreContent"></div>

<script>

    $("#tblData tr td:nth-child(1)").css("text-align", "center");
    $("#tblData tr td:nth-child(5)").css("text-align", "center");
    $("#tblData tr td:nth-child(6)").css("text-align", "right");
    $("#tblData tr td:nth-child(7)").css("text-align", "center");
    $("#tblData tr td:nth-child(8)").css("text-align", "right");
    $("#tblData tr td:nth-child(9)").css("text-align", "right");

    var pdfdoc = new jsPDF('p', 'pt', 'a4');
    var specialElementHandlers = {
        '#ignoreContent': function (element, renderer) {
            return true;
        }
    };
    var fileName = "Liste des Articles";
    var margins = {
        top: 30,
        bottom: 20,
        left: 20,
        width: 100
    };

    pdfdoc.setFontSize(12);
    pdfdoc.text(200, 30, fileName);

    $(document).ready(function () {
        $("#gpdf").click(function () {
            var thead = "<tr><td>Code</td><td>Désignation</td><td>Famille</td><td>Sous Famille</td><td>Unité</td><td>Achat HT</td><td>T.V.A</td><td>Achat TTC</td><td>PAMP</td></tr>";
            var tableHTML = '<table style="font-size:7px;">' + thead + $("#tblData").html() + '</table>';
            pdfdoc.fromHTML(tableHTML, margins.left, margins.top, {
                'width': margins.width,
                'elementHandlers': specialElementHandlers
            },
            function (dispose) {
                // dispose: object with X, Y of the last line add to the PDF
                //          this allow the insertion of new lines after html
                pdfdoc.save('Liste des Articles.pdf' + '.pdf');
            },
                    margins
                    );
        });
    });

</script>

<script>

    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var thead = "<tr><td>Code</td><td>Désignation</td><td>Famille</td><td>Sous Famille</td><td>Unité</td><td>Achat HT</td><td>T.V.A</td><td>Achat TTC</td><td>PAMP</td></tr>";
        var tableHTML = "<table>" + thead + $("#" + tableID).html() + "</table>";
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