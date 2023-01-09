<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Liste des Demandes de prix')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter  Liste des documents d'achat annulés  vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv">Liste des documents d'achat annulés

        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter Liste des documents d'achat annulés => Excel</small>
    </h1>


</div>

<?php
$year = date('Y');
$query = Doctrine_Core::getTable('documentachatannulation')
        ->createQuery('a')
        ->select('a.*')
        ->from('documentachatannulation a, documentachat doc, utilisateur')
        ->where('a.id_documentachat=doc.id')
        ->andWhere('a.id_user = utilisateur.id')
;
if ($id_type == 18)
    $query->andWhere('doc.id_typedoc=18 or id_typedoc=7');
if ($id_type == 6)
    $query->andWhere('doc.id_typedoc=6');
if ($id_type == 17)
    $query->andWhere('doc.id_typedoc=2 or id_typedoc=17');

if ($idtypedoc == 21)
    $query->andWhere('doc.id_typedoc=21 or id_typedoc=22');
if ($date_debut != "") {
    $query->Andwhere("a.dateannulation>='" . $date_debut . "'");
}
if ($date_fin != "") {
    $query->Andwhere("a.dateannulation<='" . $date_fin . "'");
}
if ($date_debut == "" && $date_fin == "") {
    $query->andWhere("a.dateannulation >= '" . $year . "-01-01'")
            ->andWhere("a.dateannulation <= '" . $year . "-12-31'");
}
$documentachats = $query->orderBy('id asc')->execute();
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
                    foreach ($documentachats as $documentachat):
                        ?>
                        <td style="text-align: center">
                            <?php echo $i; ?>
                        </td>
                        <td style="text-align: center">
                            <?php
                            echo $documentachat->getDocumentachat()->getTypedoc()->getLibelle() . " N° : " . $documentachat->getDocumentachat()->getNumero();
                            ?>
                        </td>
                        <td style="text-align: center"> 
                            <?php echo date('d/m/Y', strtotime($documentachat->getDocumentachat()->getDatecreation())) ?></td>
                        <td style="text-align: center"> <?php echo date('d/m/Y', strtotime($documentachat->getDateannulation())); ?></td>
                        <td style="text-align: center">
                            <?php
                            echo html_entity_decode($documentachat->getMotifannulation());
                            ?>
                        </td>
                        <td style="text-align: right">
                            <?php echo $documentachat->getUtilisateur()->getAgents() ?>
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