<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Liste des Immobilisations')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter Liste des Immobilisations vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv"> Liste des Immobilisations

        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter liste des Immobilisations => Excel</small>
    </h1>


</div>

<?php
$q = Doctrine_Core::getTable('immobilisation')
    ->createQuery('immo');

if ($designation != '') {
    $q = $q->andWhere('UPPER(immo.designation) like ?', '%' . strtoupper($designation) . '%');
}
if ($id_site != '') {
    $q->andWhere('immo.id_site = site.id')
        ->andWhere('immo.id_site = ' . $id_site);
}
if ($id_soussite != '') {
    $q->andWhere('immo._id_etage = etage.id')
        ->andWhere('immo._id_etage = ' . $id_soussite);
}
if ($id_bureau != '') {
    $q->andWhere('immo.id_bureau = bureaux.id')
        ->andWhere('immo.id_bureau = ' . $id_bureau);
}
if ($id_cat != '') {
    $q->andWhere('immo.id_categorie = categoerie.id')
        ->andWhere('immo.id_categorie = ' . $id_cat);
}
if ($id_famille != '') {
    $q->andWhere('immo.id_famille = famille.id')
        ->andWhere('immo.id_famille = ' . $id_famille);
}
if ($id_sousfamille != '') {
    $q->andWhere('immo.id_sousfamille = sousfamille.id')
        ->andWhere('immo.id_sousfamille = ' . $id_sousfamille);
}
$q->orderBy('numero');
$immobilisations = $q->execute();

?>

<div class="row">
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px; margin-top: 2px" id="table_plan" border="1">
            <thead>
                <tr style="background-color:#ECECEC;">
                    <td style="width:5%;height:25px;text-align:center;"><b>N°</b></td>
                    <td style="width:7%;text-align:center;"><b>N°Fi.</b></td>
                    <td style="width:8%;text-align:center;"><b>Désig.</b></td>
                    <td style="width:10%;text-align:center;"><b>Site</b></td>
                    <td style="width:10%;text-align:center;"><b>Sous<br>Site</b></td>
                    <td style="width:8%;text-align:center;"><b>Local</b></td>
                    <td style="width:10%;text-align:center;"><b>Catégo.</b></td>
                    <td style="width:10%;text-align:center;"><b>Famille</b></td>
                    <td style="width:8%;text-align:center;"><b>Sous Famil.</b></td>
                    <td style="width:10%;text-align:center;"><b>D.Acquisition</b></td>
                    <td style="width:7%;text-align:center;"><b>MT HTVA</b></td>
                    <td style="width:7%;text-align:center;"><b>MT TTC</b></td>
                </tr>
            </thead>
            <tbody id="tblData">
                <?php if (sizeof($immobilisations) != 0) :
                    $k = 1;
                    foreach ($immobilisations as $immob) : ?>

                        <tr style="font-size:10px;">
                            <td style="text-align:center;"> <?php echo $k; ?> </td>
                            <td style="text-align:left;"> <?php echo $immob->getNumero(); ?></td>
                            <td> <?php echo $immob->getDesignation(); ?></td>
                            <td style="text-align:left;">
                                <?php if ($immob->getIdSite()) { ?>
                                <?php echo $immob->getSite()->getCode() .' '. $immob->getSite();
                                } ?>
                            </td>
                            <td style="text-align:left;">
                                <?php if ($immob->getIdEtage())
                                    echo $immob->getEtage()->getCode().' '.$immob->getEtage(); ?>
                            </td>
                            <td style="text-align:left;">
                                <?php if ($immob->getIdBureaux())
                                    echo $immob->getBureaux()->getCode().' '.$immob->getBureaux(); ?>
                            </td>

                            <td style="text-align:left;">
                                <?php if ($immob->getIdCategorie())
                                    echo $immob->getCategoerie()->getCodecategoeie() . ' ' . $immob->getCategoerie(); ?>
                            </td>
                            <td style="text-align:left;">
                                <?php if ($immob->getIdFamille())
                                    echo $immob->getFamille(); ?>
                            </td>
                            <td style="text-align:left;">
                                <?php if ($immob->getIdSousfamille())
                                    echo $immob->getSousfamille(); ?>
                            </td>
                            <td><?php if ($immob->getDateacquisition())
                                    echo date('d/m/Y', strtotime($immob->getDateacquisition())); ?>
                            </td>

                            <td style="text-align:rigth;"><?php echo number_format($immob->getPrixhtva(), 3, '.', ' '); ?>
                            </td>
                            <td style="text-align:rigth;"><?php echo number_format($immob->getMntttc(), 3, '.', ' '); ?>
                            </td>
                        </tr>

                    <?php $k++;
                    endforeach; ?>

                <?php endif; ?>
            </tbody>

        </table>
    </div>
</div>

<script type="text/javascript">
    function exportTableToExcel(tableID, filename = '') {
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