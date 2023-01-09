<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('tblData', 'Comparaison-Fournisseur')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter Tableau comparatif des prix vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv">
        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter Tableau comparatif des prix => Excel</small>
    </h1>
</div>

        <?php
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$query =
    "select lignedocachat.designationarticle,
       lignedocachat.caracteristiquearticle,lignedocachat.observation,
        lignedocachat.pu,
        lignedocachat.qte,documentachat.id_typedoc,
        lignedocachat.id_doc,
        documentachat.id_docparent, fournisseur.rs as frs"
    . " ,unitemarche.libelle as unite,lignedocachat.qte,tva.libelle as tva
         ,tva.valeurtva ,lignedocachat.mntttc "
    . " from documentachat"
    . " left Join lignedocachat on documentachat.id=lignedocachat.id_doc"
    . " left Join fournisseur on documentachat.id_frs=fournisseur.id"
    . " left Join unitemarche on lignedocachat.id_unitemarche=unitemarche.id"
    . " left Join tva on lignedocachat.id_tva=tva.id"
    . "  where documentachat.id_docparent=" . $iddoc
    . " and documentachat.id_typedoc=24"
    . " and lignedocachat.id_doc=documentachat.id"
    . "  group by designationarticle,lignedocachat.caracteristiquearticle,
        lignedocachat.pu,fournisseur.rs,lignedocachat.observation,
        lignedocachat.qte,documentachat.id_typedoc,lignedocachat.id_doc
        ,documentachat.id_docparent,unitemarche.libelle,
         lignedocachat.qte,tva.libelle,tva.valeurtva,lignedocachat.mntttc";
//   die($query);
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$table_comp = $conn->fetchAssoc($query);
$designation = '';
$color1 = "#e6ecff";
$color2 = "#b3c6ff;";
$Str_Row_Color = '';
?>
<div class="row" style="max-width: 100%">
    <div class="col-sm-12" id="PDFcontent">

    <table style="margin-bottom: 0px;" id="table_plan">
            <thead>
                <tr>
                <th style="width: 2%;text-align: center;">#</th>
                <th style="width: 5%;text-align: center;">Désignation</th>
                <th style="width: 7%;text-align: center"> Caracteristiques <br>Techniques demandées</th>
                <th style="width: 3%;text-align: center">Soumissionnaires</th>
                <th style="width: 5%;text-align: center">caractéristiques techniques,<br> marques et références prposées </th>
                <th style="width: 5%;text-align: center ">Unité de mesure</th>
                <th style="width: 5%;text-align: center ">Quantité</th>
                <th style="width: 5%;text-align: center">PUHT</th>
                <th style="width: 5%;text-align: center">TVA</th>
                <th style="width: 5%;text-align: center">PUTT</th>
                <th style="width: 7%;text-align: center">PTTTC</th>
                </tr>
            </thead>
            <tbody id="tblData">
            <?php $j = 1;
$k = 1;
$count = 0;
for ($i = 0; $i < count($table_comp); $i++):
    if ($k < count($table_comp)):
        $dsignation = $table_comp[$i]['designationarticle'];?>
		              <tr style="background: <?php echo $Str_Row_Color ?>">
                                 <td>
		                            <?php echo $j ?>
		                        </td>
		<?php

        if ($designation != $table_comp[$k]['designationarticle'] && $designation != '') {
            $designation = $table_comp[$k]['designationarticle'];
            if ($Str_Row_Color == $color1) {
                $Str_Row_Color = $color2;
            } else {
                $Str_Row_Color = $color1;
            }

        } else {
            $designation = $table_comp[$k]['designationarticle'];
        }
        ?>
		                        <td rowspan="<?php //echo $count; ?>">

		                             <?php echo $designation; ?>
		                        </td>
		                        <td >
		                            <?php echo $table_comp[$i]['caracteristiquearticle']; ?>
		                        </td>
		                        <td >
		                            <?php echo $table_comp[$i]['frs']; ?>
		                        </td>
		                        <td >
		                            <?php echo $table_comp[$i]['observation']; ?>
		                        </td>
		                        <td >
		                            <?php echo $table_comp[$i]['unite']; ?>
		                        </td>
		                        <td style="text-align: right;" >
		                            <?php echo $table_comp[$i]['qte']; ?>
		                        </td>
		                        <td style="text-align: right;" >
		                            <?php echo number_format($table_comp[$i]['pu'], 3, '.', ' '); ?>
		                        </td>
		                        <td style="text-align: right;" >
		                            <?php echo $table_comp[$i]['tva']; ?>
		                        </td>

		                        <td style="text-align: right;" >
		                    <?php $tau_tva = $table_comp[$i]['valeurtva'];
        $mnttva = $table_comp[$i]['pu'] * $tau_tva;
        echo number_format($table_comp[$i]['pu'] + $mnttva, 3, ".", " ");
        ?>
		                        </td>
		                        <td style="text-align: right;" >
		                    <?php
        echo number_format($table_comp[$i]['mntttc'], 3, ".", " ");
        ?>
		                        </td>
		                        </tr>
		                        <?php $j++;
        $k++;endif;
endfor;?>
            </tbody>
        </table>
    </div>
</div>

<script  type="text/javascript">

    function exportTableToExcel(tableID, tablefoot, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var thead = "<tr><td>Classe </td>\n\
        <td>N°compte</td><td>Compte comptable</td><td> S.Debit</td><td> S.Credit</td></tr>";
        var tableHTML = "<table>" + thead + encodeURIComponent($("#" + tableID).html())
                + "<tfoot>" + encodeURIComponent($("#" + tablefoot).html()) + "</tfoot>" + "</table>";
        // Specify file name
        filename = filename ? filename + '.xls' : 'tabe_comparatif_prix.xls';
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