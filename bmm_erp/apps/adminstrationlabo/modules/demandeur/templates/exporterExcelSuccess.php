<div id="sf_admin_container">
    <h1 id="replacediv"> Liste des Demandeurs 
        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter Liste des demandeurs => Excel</small>
    </h1>
</div>

<?php
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$q = Doctrine_Core::getTable('demandeur')
        ->createQuery('d')
        ->select(',d.* ,d.libelle as libelle,a.*,a.id as agents_id, Concat(a.nomcomplet, a.prenom) as nom')
        ->from('Demandeur d')
        ->leftJoin('d.Agents a');
//        if ($id_agents != '' )
//            $q->where('d.id_agent = ' . $id_agents);
//        if ($libelle != '' || $libelle != null)
//            $q->andWhere("d.libelle  like '%" . $libelle . "%'");
//      
$q->orderBy('libelle');

$agents = $q->execute();
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$query = "SELECT CONCAT('<tr>"
        . "<td>', TRIM(demandeur.libelle), "
        . "'</td><td>', TRIM(agents.nomcomplet), '</td>"
        . "<td>', TRIM(unite.libelle), '</td>"
        . "<td>', TRIM(servicerh.libelle), '</td>"
        . "<td>', TRIM(sousdirection.libelle), '</td>"
        . "<td>', TRIM(direction.libelle), '</td>"
        . "</tr>') as ligne"
        . " FROM demandeur, agents, contrat,unite,servicerh,sousdirection,direction"
        . " WHERE demandeur.id_agent = agents.id "
        . " AND contrat.id_agents = agents.id"

;
foreach ($agents as $agent):
    if (sizeof($agent->getAgents()->getContrat()) > 0):
        $query.= " AND contrat.id_unite = unite.id "
                . "AND unite.id_service = servicerh.id "
                . "AND servicerh.id_sousdirection = sousdirection.id "
                . "AND sousdirection.id_direction = direction.id ";
    endif;
endforeach;
$query.=' order by demandeur.libelle';
$compte = $conn->fetchAssoc($query);
?>

<div class="row">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Liste des Demandeurs')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter Liste des Demandeurs vers Fichier Excel
        </button>
    </div>
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px;margin-top: 3px" id="table_plan" border="1">
            <thead>
                <tr>
                    <th style="width:15%;">Libellé </th>
                    <th style="width:20%;">Agents </th>
                    <th style="width:10%;">Unité</th>
                    <th style="width:20%;">Service</th>
                    <th style="width:20%;">Sous Direction</th>
                    <th style="width:15%;">Direction</th>

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

<script  type="text/javascript">

    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
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