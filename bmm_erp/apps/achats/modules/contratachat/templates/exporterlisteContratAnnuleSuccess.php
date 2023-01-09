<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Liste des Contrats Annulés')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter  Liste des Contrats d'achat Définitifs annulés  vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv">Liste des documents d'achat Définitifs annulés

        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter Liste des Contrats  d'achat Définitifs annulés => Excel</small>
    </h1>


</div>

<?php
$year = date('Y');
        $query = "select documentcontratannulation.id as id, "
                . " documentcontratannulation.dateannulation"
                . " as dateannulation, documentcontratannulation.motifannulation as motif,"
                . " concat(contratachat.reference , ' N° ',contratachat.numero) as numero,"
                . " documentachat.datecreation as datecreation, "
                . " typedoc.libelle as type, agents.nomcomplet as user"
                . " from documentcontratannulation,contratachat ,documentachat, utilisateur, agents, typedoc "
                . " where documentcontratannulation.id_docachat=documentachat.id  "
                . " and documentachat.id_contrat=contratachat.id"
                . " and documentachat.id_typedoc=typedoc.id "
                . " and documentachat.id_typedoc=20 "
                . " AND documentcontratannulation.id_user = utilisateur.id"
                . " AND utilisateur.id_parent = agents.id "
                . " AND documentcontratannulation.valide_budget = false "
                . " and documentachat.etatdocachat is not null"
        ;
        if ($datedebut != "") {
            $query.=" And documentcontratannulation.dateannulation>='" . $datedebut . "'";
        }

        if ($datefin != "") {
            $query.=" And documentcontratannulation.dateannulation<='" . $datefin . "'";
        }
        if ($datedebut == "" && $datefin == "") {
            $query.=" And documentcontratannulation.dateannulation >= '" . $year . "-01-01' and documentcontratannulation.dateannulation <= '" . $year . "-12-31'";
        }
        $query.=" order by documentcontratannulation.id desc";
        //. " and documentachat.datecreation >= " . "'01-01-" . date('Y') . "' and  documentachat.datecreation <= " . "'31-12-" . date('Y') . "'"
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
       $docs = $conn->fetchAssoc($query);
?>

<div class="row">
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px; margin-top: 2px" id="table_plan" border="1">
            <thead>
                <tr>
                <tr>
                    <th>N°</th>
                    <th>Document</th>
                    <th>Date Création</th>
                    <th>Date Annulation</th>
                    <th>Motif d'annulation</th>
                    <th>Utilisateur</th>
                </tr>
                </tr>
            </thead>
            <tbody id="tblData">
                <tr>  
                    <?php
                    $i = 1;
                      
                     for ($i = 0; $i < sizeof($docs); $i++): ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $i + 1; ?></td>
                                <td><?php echo $docs[$i]['type'] . " : " . $docs[$i]['numero'] ?></td>
                                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($docs[$i]['datecreation'])); ?></td>
                                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($docs[$i]['dateannulation'])); ?></td>
                                <td><?php echo html_entity_decode($docs[$i]['motif']) ?></td>
                                <td><?php echo $docs[$i]['user'] ?></td>
                               
                            </tr>
                        <?php endfor; ?>
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