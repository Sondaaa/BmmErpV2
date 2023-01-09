<div id="sf_admin_container">
    <h1 id="replacediv"> Tableau d'amortissement 
        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter Tableau Amortissements</small>
    </h1>
</div>

<?php
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$query = "SELECT CONCAT('<tr><td>', RANK () OVER ( ORDER BY tableauxammortisement.date_aquisition, immobilisation.designation, immobilisation.id ), '</td><td>', "
        . "TRIM(immobilisation.designation), '</td><td>', "
        . "to_char(tableauxammortisement.date_aquisition, 'DD/MM/YYYY'), '</td><td>', "
//        . "CASE WHEN immobilisation.datemiseenrebut IS NOT NULL THEN to_char(immobilisation.datemiseenrebut, 'DD/MM/YYYY') ELSE '' END, '</td><td>', "
        . "CASE WHEN tableauxammortisement.vorigine IS NOT NULL THEN TO_CHAR(to_number(TRIM(tableauxammortisement.vorigine), '999999999.999'), '99999990.999') ELSE '' END, '</td><td>', "
        . "CASE WHEN tableauxammortisement.taux IS NOT NULL THEN TO_CHAR(to_number(TRIM(tableauxammortisement.taux), '9999.99'), '9990.99') ELSE '' END, ' %</td><td>', "
        . "CASE WHEN tableauxammortisement.amrtinterieur IS NOT NULL THEN TO_CHAR(to_number(TRIM(tableauxammortisement.amrtinterieur), '999999999.999'), '99999990.999') ELSE '' END, '</td><td>', "
        . "CASE WHEN tableauxammortisement.dotation IS NOT NULL THEN TO_CHAR(to_number(TRIM(tableauxammortisement.dotation), '999999999.999'), '99999990.999') ELSE '' END, '</td><td>', "
        . "CASE WHEN tableauxammortisement.amrtcumile IS NOT NULL THEN TO_CHAR(to_number(TRIM(tableauxammortisement.amrtcumile), '999999999.999'), '99999990.999') ELSE '' END, '</td><td>', "
        . "CASE WHEN tableauxammortisement.vcn IS NOT NULL THEN TO_CHAR(to_number(TRIM(tableauxammortisement.vcn), '999999999.999'), '99999990.999') ELSE '' END, '</td></tr>') as ligne"
        . " FROM tableauxammortisement, immobilisation"
        . " WHERE tableauxammortisement.id_immobilisation = immobilisation.id ";
if ($date != '')
    $query.= " AND to_char(tableauxammortisement.datetableux, 'YYYY-MM-DD') = '" . $date . "' ";
$text_type = "";
switch ($type) {
    case 'taux':
        $query.= " AND tableauxammortisement.taux IS NULL ";
        $text_type = "Taux d'amortissement non affecté !";
        break;
    case 'amorti':
        $query.= " AND tableauxammortisement.taux IS NOT NULL ";
        $query.= " AND (tableauxammortisement.dotation IS NOT NULL AND to_number(TRIM(tableauxammortisement.dotation), '999999999.999') > 0) ";
        $query.= " AND (tableauxammortisement.vcn IS NULL OR to_number(TRIM(tableauxammortisement.vcn), '999999999.999') = 0) ";
        if ($date != '')
            $text_type = "Immobilisations totalement amorties année " . date('Y', strtotime($date));
        else
            $text_type = "Immobilisations totalement amorties";
        break;
    case 'rebut':
        $query.= " AND immobilisation.datemiseenrebut IS NOT NULL ";
        if ($date != '')
            $text_type = "Immobilisations mises au rebut année " . date('Y', strtotime($date)) . " !";
        else
            $text_type = "Immobilisations mises au rebut !";
        break;
    case 'normal':
        $query.= " AND tableauxammortisement.taux IS NOT NULL ";
        $query.= " AND to_number(TRIM(tableauxammortisement.vorigine), '999999999.999') > to_number(TRIM(tableauxammortisement.amrtcumile), '999999999.999') ";
        $text_type = "Immobilisations non encore amorties";
        break;
    case 'postamorti':
        $query.= " AND tableauxammortisement.taux IS NOT NULL ";
        $query.= " AND (tableauxammortisement.dotation IS NULL OR to_number(TRIM(tableauxammortisement.dotation), '999999999.999') = 0) ";
        $query.= " AND (tableauxammortisement.vcn IS NULL OR to_number(TRIM(tableauxammortisement.vcn), '999999999.999') = 0) ";
        if ($date != '')
            $text_type = "Immobilisations déjà amorties avant " . date('Y', strtotime($date)) . " !";
        else
            $text_type = "Immobilisations déjà amorties !";
        break;
    case 'concession':
        $text_type = "Immobilisations cédées !";
        break;
}

$query.= " ORDER BY tableauxammortisement.date_aquisition, immobilisation.designation";
$tableaux = $conn->fetchAssoc($query);
?>

<?php if ($date): ?>
    <legend>
        Tableau Amortissement - <?php echo date('d/m/Y', strtotime($date)); ?>
        <span style="float: right; color: #529657;"><?php echo $text_type; ?></span>
    </legend>
<?php else: ?>
    <legend>
        Tableau Amortissement
        <span style="float: right; color: #529657;"><?php echo $text_type; ?></span>
    </legend>
<?php endif; ?>

<div class="row">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('tblData', 'Tableau-Amortissement')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter Tableau Amortissement vers Fichier Excel
        </button>
        <button id="gpdf" class="btn btn-xs btn-danger">
            <i class="ace-icon fa fa-file-pdf-o"></i> Exporter Tableau Amortissement vers Fichier PDF
        </button>
    </div>
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px;" id="table_amortissement">
            <thead>
                <tr>
                    <th style="width:5%;text-align:center;">#</th>
                    <th style="width:35%;height:25px;text-align:center;"><b>Immobilisation</b></th>
                    <th style="width:8%;text-align:center;"><b>Date Acquisition</b></th>
                    <!--<th style="width:8%;text-align:center;"><b>Date Rebut</b></th>-->
                    <th style="width:9%;text-align:center;"><b>Valeur Origine</b></th>
                    <th style="width:7%;text-align:center;"><b>Taux</b></th>
                    <th style="width:9%;text-align:center;"><b>Amortissement Antérieur</b></th>
                    <th style="width:9%;text-align:center;"><b>Dotation</b></th>
                    <th style="width:9%;text-align:center;"><b>Amortissement Cumulé</b></th>
                    <th style="width:9%;text-align:center;"><b>VCN</b></th>
                </tr>
            </thead>
            <tbody id="tblData">
                <?php
                echo implode('', array_map(function ($entry) {
                            return $entry['ligne'];
                        }, $tableaux));
                ?>
            </tbody>
        </table>
    </div>
</div>

<div id="ignoreContent"></div>

<script>

    setStyle();

    function addHeader() {
        var data = '<tr class="header_tr"><td>#</td><td><b>Immobilisation</b></td><td><b>Date Acquisition</b></td><td><b>Valeur Origine</b></td><td><b>Taux</b></td><td><b>Amortissement Antérieur</b></td><td><b>Dotation</b></td><td><b>Amortissement Cumulé</b></td><td><b>VCN</b></td></tr>';
        var index = $("#tblData tr").length;
        index = parseInt(parseInt(index) / parseInt(100));
        index = parseInt(parseInt(index) * parseInt(100));

        while (parseInt(index) > 0) {
            $('#table_amortissement > tbody > tr').eq(index).before(data);
            index = parseInt(parseInt(index) - parseInt(100));
        }
    }

    function setRowStyle() {
        $('#tblData tr').each(function () {
            if ($(this).find("td:eq(4)").text().trim() == '%') {
                $(this).css('background-color', '#FCF8E3');
            } else if ($(this).find("td:eq(3)").text().trim() != '') {
                $(this).css('background-color', '#F7F7F7');
            } else if ($(this).find("td:eq(5)").text().trim() == '0.000') {
                $(this).css('background-color', '#d9edf7');
            } else if ($(this).find("td:eq(8)").text().trim() == '0.000') {
                $(this).css("background-color", "#dff0d8");
            }
        });
    }

    function setStyle() {
        $("#tblData tr td:nth-child(1)").css("text-align", "center");
        $("#tblData tr td:nth-child(3)").css("text-align", "center");
        $("#tblData tr td:nth-child(4)").css("text-align", "right");
        $("#tblData tr td:nth-child(5)").css("text-align", "center");
        $("#tblData tr td:nth-child(6)").css("text-align", "right");
        $("#tblData tr td:nth-child(7)").css("text-align", "right");
        $("#tblData tr td:nth-child(8)").css("text-align", "right");
        $("#tblData tr td:nth-child(9)").css("text-align", "right");

        setRowStyle();
        addHeader();
    }

    var pdfdoc = new jsPDF('p', 'pt', 'a4');
    var specialElementHandlers = {
        '#ignoreContent': function (element, renderer) {
            return true;
        }
    };
    var fileName = "Tableau Amortissement - <?php echo $text_type; ?>";
    var margins = {
        top: 30,
        bottom: 20,
        left: 20,
        width: 100
    };

    pdfdoc.setFontSize(12);
    pdfdoc.text(100, 30, fileName);

    $(document).ready(function () {
        $("#gpdf").click(function () {
            //Supprimer les lignes Header
            $("[class=header_tr]").remove();

            $('#tblData tr').each(function () {
                $(this).removeAttr("style");
            });

            var thead = "<tr><td>#</td><td>Immobilisation</td><td>Date Acquisition</td><td>Valeur Origine</td><td>Taux</td><td>Amorti. Antérieur</td><td>Dotation</td><td>Amorti. Cumulé</td><td>VCN</td></tr>";
            var tableHTML = '<table style="font-size:7px;">' + thead + $("#tblData").html() + '</table>';

            //Rajouter les lignes header
            setRowStyle();
            addHeader();

            pdfdoc.fromHTML(tableHTML, margins.left, margins.top, {
                'width': margins.width,
                'elementHandlers': specialElementHandlers
            },
            function (dispose) {
                // dispose: object with X, Y of the last line add to the PDF
                //          this allow the insertion of new lines after html
                pdfdoc.save('Tableau-Amortissement' + '.pdf');
            },
                    margins
                    );
        });
    });

</script>

<script>

    function exportTableToExcel(tableID, filename = ''){
        //Remove Style from rows to get Html Tbody
        $("#tblData tr td").removeAttr("style");
        $("[class=header_tr]").remove();
        $('#tblData tr').each(function () {
            $(this).removeAttr("style");
        });

        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var thead = "<tr><td>N°</td><td>Immobilisation</td><td>Date Acquisition</td><td>Valeur Origine</td><td>Taux</td><td>Dotation</td><td>Amortissement Antérieur</td><td>Amortissement Cumulé</td><td>VCN</td></tr>";
        var tableHTML = "<table>" + thead + $("#" + tableID).html() + "</table>";

        //Return the Style To all Td of Tbody after get the Html Tbody
        setStyle();

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

<style>

    .header_tr{
        text-align: center;
        color: #707070;
        font-weight: 400;
        background: repeat-x #F2F2F2;
        background-image: linear-gradient(to bottom, #F8F8F8 0,#ECECEC 100%);
    }

</style>