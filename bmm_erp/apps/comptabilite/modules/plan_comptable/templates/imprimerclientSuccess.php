<div id="sf_admin_container">
    <h1 id="replacediv"> Base Comptable 
        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter Plan Comptable Client - Exercice <?php echo $_SESSION['exercice']; ?> => PDF</small>
    </h1>
</div>

<?php
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$query = "SELECT CONCAT('<tr><td>', TRIM(plandossiercomptable.numerocompte),"
        . " '</td><td>', TRIM(plandossiercomptable.libelle), "
        . " '</td></tr>') as ligne"
        . " FROM plandossiercomptable, plancomptable, classecompte"
        . " WHERE plandossiercomptable.id_dossier = " . $_SESSION['dossier_id'] .
        " AND id_exercice = " . $_SESSION['exercice_id']
        . " AND plandossiercomptable.id_plan = plancomptable.id"
        . " AND plancomptable.id_classe = classecompte.id "
        . " AND classecompte.id=" . "'4'"
        . "AND SUBSTRING(plandossiercomptable.numerocompte, 1, 2) Like" . "'%41'"
        . " AND position(" . "'41'" . " in trim(plandossiercomptable.numerocompte))" . " > " . "0"
        . " and LENGTH(trim(plandossiercomptable.numerocompte)) >= 7"
//      
        . " ORDER BY plandossiercomptable.numerocompte";
$compte = $conn->fetchAssoc($query);
?>

<div class="row">
    <div class="col-sm-12">
        <button id="gpdf" style="float: right;" class="btn btn-xs btn-danger">
            <i class="ace-icon fa fa-file-pdf-o"></i> Exporter Plan.C.Client en PDF
        </button>
        <a target="_blank" href="<?php echo url_for('plan_comptable/exporterExcelPlanclient') ?>"
           class="btn btn-xs btn-success "type="button"
           style="float: right;margin-right: 2px">
            <i class="ace-icon fa fa-file-excel-o "></i>
            Exporter Plan.C.Client vers Excel (.xlsx )
        </a>
    </div>
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px;" id="table_plan">
            <thead>
                <tr>
                    <th style="width:10%;">Numéro</th>
                    <th style="width:75%;">Intitulé du Compte Comptable</th>

                    <!--<th style="width:15%;">Classe</th>-->
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

<script  type="text/javascript">

    $("#tblData tr td:nth-child(3)").css("text-align", "center");

    var pdfdoc = new jsPDF('p', 'pt', 'a4');
    var specialElementHandlers = {
        '#ignoreContent': function (element, renderer) {
            return true;
        }
    };
    var fileName = "Plan Comptable Client : <?php echo $_SESSION['exercice']; ?>";
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
            var thead = "<tr><td>Numéro</td><td>Intitulé du Compte Comptable</td></tr>";
            var tableHTML = '<table style="font-size:7px;">' + thead + $("#tblData").html() + '</table>';
            pdfdoc.fromHTML(tableHTML, margins.left, margins.top, {
                'width': margins.width,
                'elementHandlers': specialElementHandlers
            },
            function (dispose) {
                // dispose: object with X, Y of the last line add to the PDF
                //          this allow the insertion of new lines after html
                pdfdoc.save('Plan-comptable-client-<?php echo $_SESSION['exercice']; ?>.pdf' + '.pdf');
            },
                    margins
                    );
        });
    });

</script>