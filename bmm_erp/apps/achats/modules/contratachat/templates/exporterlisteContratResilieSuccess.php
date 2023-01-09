<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Liste Contrats Achats Résiliés')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter  Liste des Contrats d'achat Résiliés  vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv">Liste des Contrats d'achat Résiliés

        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter Liste des Contrats d'achat Résiliés => Excel</small>
    </h1>


</div>

<?php
$year = date('Y');
$query=Doctrine_Core::getTable('documentcontratresiliation')
        ->createQuery('d')
        ->select('d.*')
        ->from('documentcontratresiliation d,contratachat ,documentachat, utilisateur, agents, typedoc')
        ->where('d.id_docachat=documentachat.id')
        ->andWhere('documentachat.id_contrat=contratachat.id')
        ->andWhere('documentachat.id_typedoc=typedoc.id')
        ->andWhere('documentachat.id_typedoc=20')
        ->andWhere(' d.id_user = utilisateur.id')
        ->andWhere('utilisateur.id_parent = agents.id')
        ->andWhere('d.valide_budget = false ')
        ->andWhere('documentachat.etatdocachat is not null')

;
if ($datedebut != "") {
    $query->Andwhere("documentcontratresiliation.dateresiliation>='" . $datedebut . "'");
}

if ($datefin != "") {
    $query->Andwhere("documentcontratresiliation.dateresiliation<='" . $datefin . "'");
}
if ($datedebut == "" && $datefin == "") {
    $query->andWhere("documentcontratresiliation.dateresiliation >= '" . $year . "-01-01'")
            ->andWhere("documentcontratresiliation.dateresiliation <= '" . $year . "-12-31'");
}
$query->orderBy(' documentcontratresiliation.id desc');
$docs = $query->execute();
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
                    <th>Date Résiliation </th>
                    <th>Motif de Résiliation </th>
                    <th>Montant Consommés </th>
                    <th>Montant Restant </th>
                    <th>Utilisateur</th>
                </tr>
                </tr>
            </thead>
            <tbody id="tblData">
                <tr>  
                    <?php $i=0; foreach ($docs as $contratresilie): ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $i + 1; ?></td>
                        <td><?php echo $contratresilie->getContratachat()->getReference() . ' N° ' . $contratresilie->getContratachat()->getNumero(); ?></td>
                        <td style="text-align: center;">
                            <?php if ($contratresilie->getContratachat()->getDatecreation() != ''): ?>
                                <?php echo date('d/m/Y', strtotime($contratresilie->getContratachat()->getDatecreation())); ?></td>
                        <?php endif; ?>
                        <td style="text-align: center;">
                            <?php if ($contratresilie->getDateresiliation() != ''): ?>
                                <?php echo date('d/m/Y', strtotime($contratresilie->getDateresiliation())); ?></td>
                        <?php endif; ?>
                        <td><?php echo html_entity_decode($contratresilie->getMotifresiliattion()) ?></td>
                        <td style="text-align: right"><?php echo number_format($contratresilie->getMontantconsomme(), 3, ".", " ") ?></td>
                        <td style="text-align: right"><?php echo number_format($contratresilie->getMontantrestant(), 3, ".", " ") ?></td>
                        <td><?php echo $contratresilie->getUtilisateur()->getAgents();    ?></td>
                       
                    </tr>
                    <?php $i++;
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