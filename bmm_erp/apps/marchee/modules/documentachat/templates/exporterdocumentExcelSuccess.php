<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Liste des Bons de Commandes Internes')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter  Liste des Bons de Commandes Internes  vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv"> Liste des Bons de Commandes Internes Marchés
        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter Liste des Bons de Commandes Internes => Excel</small>
    </h1>
</div>
<?php
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$typedoc = Doctrine_Core::getTable('typedoc')
        ->findOneById(6);
$year = date('Y');
$documentsachat = Doctrine_Core::getTable('documentachat')
        ->createQuery('a')
        ->where('a.id_typedoc=6')
        ->andWhere('a.typedocexporter  = 4')
        ;
       // die($documentsachat);

if ($datedebut != '')
    $documentsachat->andWhere("datecreation >= '" . $datedebut . "'");
if ($datefin != '')
    $documentsachat->andWhere("datecreation <= '" . $datefin . "'");

if ($datefin == '' && $datedebut == '')
    // $documentsachat->Andwhere("datecreation>='" . date('Y') . "-01-01" . "'")
    //         ->Andwhere("datecreation<='" . date('Y') . "-12-31" . "'");
if ($reference != '' && $reference != 'undefined')
    $documentsachat->andWhere("a.reference like '%" . $reference . "%'");
?>
<div class="row">
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px; margin-top: 2px" id="table_plan" border="1">
            <thead>
                <tr>
                    <th style="width: 15%; height:25px;">Numéro</th>
                    <th style="width: 15%; height:25px;">Date</th>
                    <th style="width: 20%">Reference</th>
                    <th style="width: 30%">Etat</th>   
                    <th style="width: 20%">Mnt TTC</th>
                </tr>
            </thead>
            <tbody id="tblData">
                <?php
                $documentsachat = $documentsachat
                        ->OrderBy('id Asc')
                        ->execute();
                $doc = new Documentachat();
                foreach ($documentsachat as $docach) {
                    $doc = $docach;
                    $avisss = "";
                    $aviss = Doctrine_Core::getTable('ligavisdoc')->findOneByIdDoc($doc->getId());
                    if ($aviss)
                        $avisss = $aviss->getAvis();
                    $etat = "";
                    if ($doc->getIdEtatdoc()) {
                        $etatdoc = Doctrine_Core::getTable('etatdocument')->findOneById($doc->getIdEtatdoc());
                        if ($etatdoc)
                            $etat = $etatdoc;
                    }
                    ?>
                    <tr>
                        <td>
                            <?php
                            echo $doc->getNumerodocachat();
                            ?>
                        </td>
                        <td>
                            <?php
                            echo
                            date('d/m/Y', strtotime($doc->getDatecreation()));
                            ?>
                        </td>
                        <?php if ($doc->getReference()) { ?>
                            <td> 
                                <?php
                                echo $doc->getReference();
                                ?>
                            </td>
                        <?php } else { ?>
                            <td></td>
                        <?php } ?>
                        <td>
                            <?php echo $etat; ?>
                        </td>
                        <td style="text-align: right">
                            <?php echo number_format($doc->getMntttc(), 3, '.', ' ') ?>
                        </td>

                    </tr>

                <?php } ?>
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