<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Liste des demandeurs')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter  Liste des Demandeurs  vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv"> Liste des Demandeurs

        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter liste des demandeurs => Excel</small>
    </h1>


</div>

<?php
//$libelle = $request->getParameter('libelle', '');
//        $id_agents = $request->getParameter('id_agents', '');

$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$q = Doctrine_Core::getTable('demandeur')
        ->createQuery('d')
        ->select(',d.* ,d.libelle as libelle,a.*,a.id as agents_id, Concat(a.nomcomplet, a.prenom) as nom')
        ->from('Demandeur d')
        ->leftJoin('d.Agents a');
if ($id_agents != '')
    $q->where('d.id_agent = ' . $id_agents);
if ($libelle != '' || $libelle != null)
    $q->andWhere("d.libelle  like '%" . $libelle . "%'");
//      
$q->orderBy('libelle');

$demandeurs = $q->execute();
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
 $demandeur_contrat = DemandeurTable::getInstance()->getContrat();
for ($i = 0; $i < (sizeof($demandeur) - 1); $i++):
    ?>
    <div class="row">
        <div class="col-sm-12" id="PDFcontent">
            <table style="margin-bottom: 0px; margin-top: 2px" id="table_plan" border="1">
                <thead>
                    <tr>
                        <th style="width:15%;">Libellé </th>
                        <th style="width:15%;">Agents </th>
                        <th style="width:10%;">Reg </th>
                        <th style="width:10%;">Unité</th>
                        <th style="width:15%;">Service</th>
                        <th style="width:20%;">Sous Direction</th>
                        <th style="width:15%;">Direction</th>
                    </tr>
                </thead>
                <tbody id="tblData">
                    <tr>  
                        <?php
                        //die(sizeof($demandeur).'mm');
                        foreach ($demandeurs as $demandeur):
                            ?>
                            <td>
                                <?php echo $demandeur->getLibelle(); ?>
                            </td>
                            <td>
                                <?php
                                if ($demandeur->getIdAgent()):
                                    echo $demandeur->getAgents()->getNomcomplet() . ' ' . $demandeur->getAgents()->getPrenom();
                                else :
                                    echo '';
                                endif;
                                ?>
                            </td>

                            <td>
                                <?php
                                if ($demandeur->getIdAgent() && $demandeur->getAgents()->getIdRegrouppement()):
                                    echo $demandeur->getAgents()->getRegroupementagents()->getLibelle();
                                else:
                                    echo '';
                                endif;
                                ?>
                            </td>
                            <td>
                                <?php
                                 if (count($demandeur_contrat) >= 1):
                                    echo $demandeur->getAgents()->getContrat()->getFirst()->getUnite()->getLibelle();
                                else:
                                    echo '';
                                endif;
                                ?>
                            </td>
                            <td>
                                <?php
                                if (count($demandeur_contrat) >= 1):
                                    echo $demandeur->getAgents()->getContrat()->getFirst()->getUnite()->getServicerh()->getLibelle();
                                else:
                                    echo '';
                                endif;
                                ?>
                            </td>
                            <td>
                                <?php
                               if (count($demandeur_contrat) >= 1):
                                    echo $demandeur->getAgents()->getContrat()->getFirst()->getUnite()->getServicerh()->getSousdirection()->getLibelle();
                                else:
                                    echo '';
                                endif;
                                ?>
                            </td>
                            <td>
                                <?php
                                if (count($demandeur_contrat) >= 1):
                                    echo $demandeur->getAgents()->getContrat()->getFirst()->getUnite()->getServicerh()->getSousdirection()->getDirection()->getLibelle();
                                else:
                                    echo '';
                                endif;
                                ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
    <?php
    //  endif;
endfor;
?>
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