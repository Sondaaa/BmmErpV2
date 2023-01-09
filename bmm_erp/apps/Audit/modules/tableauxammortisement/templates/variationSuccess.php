<div id="sf_admin_container">
    <h1 id="replacediv"> Tableaux
        <small><i class="ace-icon fa fa-angle-double-right"></i> Tableau de Variation des Immobilisations</small>
    </h1>
</div>

<?php
$annee = '';
$param = ParametreamortissementTable::getInstance()->findAll()->getFirst();
if ($param)
    $annee = $param->getDateamortissement();
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$query = "SELECT CONCAT('<tr><td>', RANK () OVER ( ORDER BY tableauxammortisement.date_aquisition, immobilisation.designation, immobilisation.id ), '</td><td>', "
        . "TRIM(categoerie.categorie), '</td><td>', "
        . "TRIM(plancomptable.numerocompte), '</td><td>', "
        . "TRIM(immobilisation.designation), '</td><td>', "
        . "to_char(tableauxammortisement.date_aquisition, 'DD/MM/YYYY'), '</td><td>', "
        . "CASE WHEN to_char(tableauxammortisement.date_aquisition, 'YYYY') = '" . date('Y', strtotime($annee)) . "' THEN TO_CHAR(to_number(TRIM(tableauxammortisement.vorigine), '999999999.999'), '99999990.999') ELSE '' END, '</td><td>', "
        . "CASE WHEN immobilisation.datemiseenrebut IS NOT NULL THEN TO_CHAR(to_number(TRIM(tableauxammortisement.vorigine), '999999999.999'), '99999990.999') ELSE '' END, '</td><td>', "
        . "CASE WHEN tableauxammortisement.vorigine IS NOT NULL AND immobilisation.datemiseenrebut IS NULL AND to_char(tableauxammortisement.date_aquisition, 'YYYY') <> '" . date('Y', strtotime($annee)) . "' THEN TO_CHAR(to_number(TRIM(tableauxammortisement.vorigine), '999999999.999'), '99999990.999') ELSE CASE WHEN tableauxammortisement.vorigine IS NOT NULL OR immobilisation.datemiseenrebut IS NOT NULL THEN '0.000' ELSE '' END END, '</td><td>', "
        . "CASE WHEN tableauxammortisement.taux IS NOT NULL THEN TO_CHAR(to_number(TRIM(tableauxammortisement.taux), '9999.99'), '9990.99') ELSE '' END, ' %</td><td>', "
        . "CASE WHEN tableauxammortisement.amrtinterieur IS NOT NULL THEN TO_CHAR(to_number(TRIM(tableauxammortisement.amrtinterieur), '999999999.999'), '99999990.999') ELSE '' END, '</td><td>', "
        . "CASE WHEN tableauxammortisement.dotation IS NOT NULL THEN TO_CHAR(to_number(TRIM(tableauxammortisement.dotation), '999999999.999'), '99999990.999') ELSE '' END, '</td><td>', "
        . "CASE WHEN tableauxammortisement.amrtcumile IS NOT NULL THEN TO_CHAR(to_number(TRIM(tableauxammortisement.amrtcumile), '999999999.999'), '99999990.999') ELSE '' END, '</td><td>', "
        . "CASE WHEN tableauxammortisement.vcn IS NOT NULL THEN TO_CHAR(to_number(TRIM(tableauxammortisement.vcn), '999999999.999'), '99999990.999') ELSE '' END, '</td></tr>') as ligne"
        . " FROM tableauxammortisement, immobilisation, categoerie, plancomptable "
        . " WHERE tableauxammortisement.id_immobilisation = immobilisation.id "
        . " AND immobilisation.id_categorie = categoerie.id "
        . " AND immobilisation.comptecomptabel = plancomptable.id "
        . " AND tableauxammortisement.taux IS NOT NULL";
if ($annee != '')
    $query.= " AND to_char(tableauxammortisement.datetableux, 'YYYY-MM-DD') = '" . $annee . "' ";
$query.= " ORDER BY tableauxammortisement.date_aquisition, immobilisation.designation";
$tableaux = $conn->fetchAssoc($query);
?>

<?php if ($annee): ?>
    <legend>Tableau de Variation des Immobilisations - <?php echo date('d/m/Y', strtotime($annee)); ?></legend>
<?php else: ?>
    <legend>Tableau de Variation des Immobilisations</legend>
<?php endif; ?>

<div class="row">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('tblData', 'Tableau-Amortissement')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter Tableau de Variation vers Fichier Excel
        </button>
        <button id="gpdf" class="btn btn-xs btn-danger">
            <i class="ace-icon fa fa-file-pdf-o"></i> Exporter Tableau de Variation vers Fichier PDF
        </button>
    </div>
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px; font-size: 10px;" id="table_amortissement">
            <thead>
                <tr>
                    <th style="width:4%;text-align:center;"><b>#</b></th>
                    <th style="width:13%;text-align:center;"><b>Rubrique</b></th>
                    <th style="width:6%;text-align:center;"><b>Compte Comptable</b></th>
                    <th style="width:15%;height:25px;text-align:center;"><b>Immobilisation</b></th>
                    <th style="width:7%;text-align:center;"><b>Date Acquisition</b></th>
                    <th style="width:7%;text-align:center;"><b>Acquisition <?php echo date('Y', strtotime($annee)); ?></b></th>
                    <th style="width:7%;text-align:center;"><b>Cession <?php echo date('Y', strtotime($annee)); ?></b></th>
                    <th style="width:7%;text-align:center;"><b>Valeur Origine</b></th>
                    <th style="width:6%;text-align:center;"><b>Taux</b></th>
                    <th style="width:7%;text-align:center;"><b>Amortissement Antérieur</b></th>
                    <th style="width:7%;text-align:center;"><b>Dotation</b></th>
                    <th style="width:7%;text-align:center;"><b>Amortissement Cumulé</b></th>
                    <th style="width:7%;text-align:center;"><b>VCN</b></th>
                </tr>
            </thead>
            <tbody id="tblData">
                <?php
                echo implode('', array_map(function ($entry) {
                            return $entry['ligne'];
                        }, $tableaux));
                ?>
                <tr>
                    <td>Total</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div id="ignoreContent"></div>

<script>

    calculeTotal();

    function calculeTotal() {
        var total_acquisition = 0;
        var total_cession = 0;
        var total_vorigine = 0;
        var total_anterieur = 0;
        var total_dotation = 0;
        var total_cumule = 0;
        var total_vcn = 0;
        $('#tblData tr').each(function () {
            if ($(this).find("td:eq(5)").text().trim() != '') {
                total_acquisition = parseFloat(total_acquisition) + parseFloat($(this).find("td:eq(5)").text().trim());
            }
            if ($(this).find("td:eq(6)").text().trim() != '') {
                total_cession = parseFloat(total_cession) + parseFloat($(this).find("td:eq(6)").text().trim());
            }
            if ($(this).find("td:eq(7)").text().trim() != '') {
                total_vorigine = parseFloat(total_vorigine) + parseFloat($(this).find("td:eq(7)").text().trim());
            }
            
            if ($(this).find("td:eq(9)").text().trim() != '') {
                total_anterieur = parseFloat(total_anterieur) + parseFloat($(this).find("td:eq(9)").text().trim());
            }
            
            if ($(this).find("td:eq(10)").text().trim() != '') {
                total_dotation = parseFloat(total_dotation) + parseFloat($(this).find("td:eq(10)").text().trim());
            }
            
            if ($(this).find("td:eq(11)").text().trim() != '') {
                total_cumule = parseFloat(total_cumule) + parseFloat($(this).find("td:eq(11)").text().trim());
            }
            
            if ($(this).find("td:eq(12)").text().trim() != '') {
                total_vcn = parseFloat(total_vcn) + parseFloat($(this).find("td:eq(12)").text().trim());
            }
        });
        
        $('#tblData tr:last').find("td:eq(5)").html(parseFloat(total_acquisition).toFixed(3));
        $('#tblData tr:last').find("td:eq(6)").html(parseFloat(total_cession).toFixed(3));
        $('#tblData tr:last').find("td:eq(7)").html(parseFloat(total_vorigine).toFixed(3));
        $('#tblData tr:last').find("td:eq(9)").html(parseFloat(total_anterieur).toFixed(3));
        $('#tblData tr:last').find("td:eq(10)").html(parseFloat(total_dotation).toFixed(3));
        $('#tblData tr:last').find("td:eq(11)").html(parseFloat(total_cumule).toFixed(3));
        $('#tblData tr:last').find("td:eq(12)").html(parseFloat(total_vcn).toFixed(3));
        
        addHeader();
    }

    function addHeader() {
        var data = '<tr class="header_tr"><td>#</td><td><b>Immobilisation</b></td><td><b>Rubrique</b></td><td><b>Compte Comptable</b></td><td><b>Date Acquisition</b></td><td><b>Acquisition <?php echo date('Y', strtotime($annee)); ?></b></td><td><b>Cession <?php echo date('Y', strtotime($annee)); ?></b></td><td><b>Valeur Origine</b></td><td><b>Taux</b></td><td><b>Amortissement Antérieur</b></td><td><b>Dotation</b></td><td><b>Amortissement Cumulé</b></td><td><b>VCN</b></td></tr>';
        var index = $("#tblData tr").length;
        index = parseInt(parseInt(index) / parseInt(100));
        index = parseInt(parseInt(index) * parseInt(100));

        while (parseInt(index) > 0) {
            $('#table_amortissement > tbody > tr').eq(index).before(data);
            index = parseInt(parseInt(index) - parseInt(100));
        }
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

            var thead = "<tr><td>#</td><td>Rubrique</td><td>Compte Comptable</td><td>Immobilisation</td><td>D. Acquisition</td><td>Aquisition</td><td>Cession</td><td>Valeur Origine</td><td>Taux</td><td>Amorti. Antérieur</td><td>Dotation</td><td>Amorti. Cumulé</td><td>VCN</td></tr>";
            var tableHTML = '<table style="font-size:7px;">' + thead + $("#tblData").html() + '</table>';

            //Rajouter les lignes header
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
        $("[class=header_tr]").remove();

        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var thead = "<tr><td>N°</td><td>Rubrique</td><td>Compte Comptable</td><td>Immobilisation</td><td>Date Acquisition</td><td>Aquisition</td><td>Cession</td><td>Valeur Origine</td><td>Taux</td><td>Amorti. Antérieur</td><td>Dotation</td><td>Amorti. Cumulé</td><td>VCN</td></tr>";
        var tableHTML = "<table>" + thead + $("#" + tableID).html() + "</table>";

        //Rajouter les lignes header
        addHeader();

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