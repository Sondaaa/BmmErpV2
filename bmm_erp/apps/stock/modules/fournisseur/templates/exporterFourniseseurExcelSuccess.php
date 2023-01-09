<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Liste des Fournisseurs')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter  Liste des Fournisseurs  vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv"> Liste des Fournisseurs

        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter liste des Fournisseurs => Excel</small>
    </h1>


</div>

<?php
$q = Doctrine_Core::getTable('fournisseur')
        ->createQuery('f')
        ->where("f.etatfrs ='Actif'")
;

if ($id_activite != '')
    $q->andWhere('f.id_activite = activitetiers.id')
            ->andWhere('f.id_activite = ' . $id_activite);
if ($id_famille != '')
    $q->andWhere('f.id_famillearticle = familleartfrs.id')
            ->andWhere('f.id_famillearticle = ' . $id_famille);
 if ($codefrs != '') {
            $q = $q->andWhere('f.codefrs like ?', '%' . $codefrs . '%');
        }
        if ($rs != '') {
            $q = $q->andWhere('UPPER(f.rs) like ?', '%' . strtoupper($rs) . '%');
        }
//        die($codefrs);
$fournisseurs = $q->execute();
if ($id_activite != '')
    $affiche_activite = '';
if ($id_activite != '') {
    $activite = ActivitetiersTable::getInstance()->find($id_activite);
    $affiche_activite = $activite->getLibelle();
}

$affiche_famille = '';
if ($id_famille != '') {
    $famille = FamilleartfrsTable::getInstance()->find($id_famille);
    $affiche_famille = $famille->getLibelle();
}
?>

<div class="row">
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px; margin-top: 2px" id="table_plan" border="1">
            <thead>
                <tr>
                    <td style="width:5%;">N°</td>
                    <td style="width:10%;">Code Fournisseur</td>
                    <td style="width:25%;">Raison Sociale</td>
                    <td style="width:10%;">Tel</td>
                    <td style="width:10%;">E-Mail</td>
                    <td style="width:10%;">Activite</td>
                    <td style="width:10%;">Famille Article</td>
                     <td style="width:10%;">Matricule Fiscale</td>
                    <td style="width:20%;">Compte comptable </td>
                </tr>
            </thead>
            <tbody id="tblData">
                <tr>  
                    <?php
                    $i = 1;

                    foreach ($fournisseurs as $fournisseur):
                        ?>
                        <td>
                            <?php echo $i ?>
                        </td>
                        <td>
                            <?php echo $fournisseur->getCodefrs(); ?>
                        </td>
                        <td>
                            <?php echo $fournisseur->getRs(); ?>
                        </td>

                        <td>
                            <?php echo $fournisseur->getTel(); ?>
                        </td>
                        <td>
                            <?php
                            echo $fournisseur->getMail();
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $fournisseur->getActivitetiers()->getLibelle();
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $fournisseur->getFamilleartfrs()->getLibelle();
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $fournisseur->getMatriculefiscale();
                            ?>
                        </td>
                        <td style="text-align: center">  
                            <?php
                            echo $fournisseur->getPlancomptable()->getNumerocompte()  ;
                            ?>
                        </td>
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