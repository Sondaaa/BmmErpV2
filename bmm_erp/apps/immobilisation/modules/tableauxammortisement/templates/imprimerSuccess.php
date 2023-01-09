<div id="sf_admin_container">
    <h1 id="replacediv"> Tableau d'amortissement 
        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter Tableau Amortissement</small>
    </h1>
</div>

<?php
$annee = '';
$param = ParametreamortissementTable::getInstance()->findAll()->getFirst();
if ($param)
    $annee = $param->getDateamortissement();
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
if ($annee != '')
    $query.= " AND to_char(tableauxammortisement.datetableux, 'YYYY-MM-DD') = '" . $annee . "' ";
$query.= " ORDER BY tableauxammortisement.date_aquisition, immobilisation.designation";
$tableaux = $conn->fetchAssoc($query);
?>

<?php if ($annee): ?>
    <legend>Tableau Amortissement - <?php echo date('d/m/Y', strtotime($annee)); ?></legend>
<?php else: ?>
    <legend>Tableau Amortissement</legend>
<?php endif; ?>

<div class="row">
    <div class="col-sm-11">
        <legend style="margin-bottom: 10px; font-size: 17px;">Légende</legend>
        <table>
            <tr>
                <td style="width: 5%; background-color: #FCF8E3;"></td>
                <td style="width: 28%;">
                    <a href="<?php echo url_for('tableauxammortisement/imprimerType') . "?date=" . $annee . "&type=taux" ?>" target="_blank">
                        Taux d'amortissement non affecté !
                    </a>
                </td>
                <td style="width: 5%; background-color: #dff0d8;"></td>
                <td style="width: 32%;">
                    <a href="<?php echo url_for('tableauxammortisement/imprimerType') . "?date=" . $annee . "&type=amorti" ?>" target="_blank">
                        Immobilisations totalement amorties année <?php if ($annee): ?><?php echo date('Y', strtotime($annee)); ?><?php endif; ?>
                    </a>
                </td>
<!--                <td style="width: 5%; background-color: #F0F0F0;"></td>
                <td style="width: 25%;">
                    <a href="<?php // echo url_for('tableauxammortisement/imprimerType') . "?date=" . $annee . "&type=rebut" ?>" target="_blank">
                        Immobilisations mises au rebut !
                    </a>
                </td>-->
            </tr>
            <tr>
                <td style="background-color: #FFFFFF;"></td>
                <td>
                    <a href="<?php echo url_for('tableauxammortisement/imprimerType') . "?date=" . $annee . "&type=normal" ?>" target="_blank">
                        Immobilisations non encore amorties
                    </a>
                </td>
                <td style="background-color: #d9edf7;"></td>
                <td>
                    <a href="<?php echo url_for('tableauxammortisement/imprimerType') . "?date=" . $annee . "&type=postamorti" ?>" target="_blank">
                        Immobilisations déjà amorties avant <?php if ($annee): ?><?php echo date('Y', strtotime($annee)); ?><?php endif; ?>
                    </a>
                </td>
<!--                <td></td>
                <td>
                    <a href="<?php // echo url_for('tableauxammortisement/imprimerType') . "?date=" . $annee . "&type=concession"   ?>" target="_blank">
                        Immobilisations mises en concession !
                    </a>
                </td>-->
            </tr>
        </table>
    </div>
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
    var fileName = "Tableau Amortissement";
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