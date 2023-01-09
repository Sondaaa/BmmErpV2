<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Suivi-BDC')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter suivi bdc  vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv"> 
        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter suivi bdc => Excel</small>
    </h1>
</div>
<?php
$documentachats = DocumentachatTable::getInstance()->getByTypedoc(6);
?>

<div class="row">
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px;margin-top: 2px;width: 100%;font-size: 12px" id="table_plan" border="1">
            <thead>
                <tr>
                    <th style="max-width: 5%;text-align: center;" >N°BCI</th>
                    <th style="width: 5%;text-align: center;" >D.Création</th>
                    <th style="width: 7%;text-align: center" > Demandeur</th>
                    <th style="width: 10%;text-align: center" >Etat Document</th>
                    <th style="width: 5%;text-align: center">BDC Pro</th>
                    <th style="width: 5%;text-align: center ">N°BDCD</th>
                    <th style="width: 5%;text-align: center ">Montant</th>
                    <th style="width: 7%;text-align: center">Date Eng</th>
                    <th style="width: 7%;text-align: center">Mnt Eng</th>
                    <th style="width: 7%;text-align: center">Date Ord.</th>
                    <th style="width: 7%;text-align: center">Mnt Ord.</th>
                    <th style="width: 7%;text-align: center" >N°FAC S</th>
                    <th style="width: 5%;text-align: center" >N°FAC FRS</th>
                    <th style="width: 5%;text-align: center" >Montant</th>
                    <th style="width: 5%;text-align: center" >Date paiement</th>
                    <th style="width: 5%;text-align: center" >Montant</th>
                    <th style="width: 5%;">Caisse</th>
                    <th style="width: 5%;">Montant</th>
                </tr>
            </thead>
            <tbody id="tblData">
                <?php
                foreach ($documentachats as $documentachat):
                    $bon_deponse_Provisoire = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($documentachat->getId(), 21);
                    if (sizeof($bon_deponse_Provisoire) >= 1):
                        $bon_deponse_externe_difinitif = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($documentachat->getId(), 22);
                        $document_bddc_nv = Doctrine_Core::getTable('documentachat')->findByIdDocparent($documentachat->getId());


                        if (sizeof($bon_deponse_externe_difinitif) >= 1) {
                            $id_docparent = $bon_deponse_externe_difinitif->getFirst()->getId();
                            $docparent_parent = Doctrine_Core::getTable('documentachat')->findByIdDocparent($id_docparent);
                            if (sizeof($docparent_parent) >= 1) {
//                                            $id_docparent_parent = $docparent_parent->getFirst()->getId();
//                                            die(sizeof($docparent_parent).'pp');
                                $facuture_comptabe = Doctrine_Core::getTable('documentachat')->findByIdTypedocAndIdDocparent(15, $id_docparent);
//                    die(count($facuture_comptabe).'mmm'); 
                            }
                        }
                        if (sizeof($bon_deponse_externe_difinitif) >= 1) {
                            $id_docparent = $bon_deponse_externe_difinitif->getFirst()->getId();
                            $document_udget_ordanancemet = Doctrine_Core::getTable('documentbudget')->findByIdType(2);
                            $piece_budget = Doctrine_Core::getTable('Piecejointbudget')->findOneByIdDocachatAndIdDocumentbudget($id_docparent, $document_udget_ordanancemet->getFirst()->getId());
                        }
                        ?>


                        <tr class="ligne_compte" >
                            <td style="max-width: 5%;text-align: center;cursor: pointer"class="fixed-side" scope="col"><b>
                                    <!--<a target="_blank" href="<?php // echo url_for("documentachat/imprimerboncomande?iddoc=" . $documentachat->getId());             ?>">-->
                                    <?php
                                    // echo $documentachat->getNumerodocachat();
                                    include_partial('tddetaildoc', array('boncomm' => $documentachat))
                                    ?>
                                    <!--</a>-->
                                </b>
                            </td>

                            <td style="text-align: center" class="fixed-side" scope="col"><?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?></td>   
                            <td><?php
                                if (($documentachat->getIdDemandeur() != '' && $documentachat->getIdDemandeur() != null))
                                    echo $documentachat->getDemandeur();
                                ?>
                            </td>
                            <td style="max-width: 3%">
                            <?php

                            echo $documentachat->getEtatdocument()->getEtatdocachat();


                            ?>
                        </td>
                            <td>
                                <?php
                                $doc_paret = Doctrine_Core::getTable('documentachat')->findByIdDocparent($documentachat->getId());

                                if (sizeof($documentachat) >= 1 && sizeof($doc_paret) == 0)
                                    echo $documentachat->getEtatdocument()->getEtatdocachat();

                                else if (sizeof($doc_paret) >= 1 && sizeof($bon_deponse_Provisoire) == 0)
                                    echo $doc_paret->getLast()->getEtatdocument()->getEtatdocachat();
                                else if (sizeof($bon_deponse_Provisoire) >= 1 && sizeof($bon_deponse_externe_difinitif) == 0)
                                    echo $bon_deponse_Provisoire->getFirst()->getEtatdocument()->getEtatdocachat();
                                else if (sizeof($bon_deponse_externe_difinitif) >= 1 && sizeof($bon_deponse_Provisoire) >= 1)
                                    echo $bon_deponse_externe_difinitif->getFirst()->getEtatdocument()->getEtatdocachat();
                                else
                                    echo '';
                                ?>
                            </td>

                            <!--bdc -->
                            <td style="text-align: center">
                                <?php
                                foreach ($bon_deponse_Provisoire as $prevesoire) :
                                    echo '<p>' . $prevesoire->getNumerodocachat() . '</p>';
                                endforeach;
//                                if (sizeof($bon_deponse_Provisoire) >= 1)
////                                                echo $bon_deponse_Provisoire->getFirst()->getNumerodocachat();
//                                    include_partial('tddetaildoc', array('boncomm' => $bon_deponse_Provisoire->getFirst()));
//                                else
//                                    echo '';
                                ?>
                            </td>
                            <td style="text-align: center;width: 5%;" colspan="2">
                                 <?php foreach ($bon_deponse_externe_difinitif as $definitif) : ?>
                                    <a target="_blank" href="<?php echo $definitif->getLinkDocument(); ?>">
                                        <?php
                                        echo '<p>';
                                        echo $definitif->getNumerodocachat();
                                        echo ' - ' . number_format($definitif->getMntttc(), 3, ".", " ");
                                        echo '</p>';
                                        ?>
                                    </a>
                                <?php endforeach; ?>
                                <?php
//                                if (sizeof($bon_deponse_externe_difinitif) >= 1)
////                                                echo $bon_deponse_externe_difinitif->getFirst()->getNumerodocachat();
//                                    include_partial('tddetaildoc', array('boncomm' => $bon_deponse_externe_difinitif->getFirst()));
//                                else
//                                    echo '';
                                ?></td>

                           <td colspan="2" >
                                <?php
                                foreach ($bon_deponse_Provisoire as $prevesoire) :
                                    $piece_budget_porvisoire = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($prevesoire->getId());
                                    if ($piece_budget_porvisoire && $piece_budget_porvisoire->getDocumentbudget()) :
                                        ?>
                                        <?php
                                        echo '<p>' . date('d/m/Y', strtotime($piece_budget_porvisoire->getDocumentbudget()->getDatecreation()));
                                        if ($piece_budget_porvisoire->getDocumentbudget()->getMnt())
                                            echo ' - ' . $piece_budget_porvisoire->getDocumentbudget()->getMnt() . '';
                                        echo '</p>';
                                    endif;
                                    ?>

                                <?php endforeach; ?>

                            </td>
                            <!--bdc -->
                           <td colspan="2">
                            <?php
                            foreach ($bon_deponse_externe_difinitif as $definitif) {

                                $piecejoint = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($definitif->getId());
                                if ($piecejoint) {
                                    $document_udget_ordanancemet = DocumentbudgetTable::getInstance()->findOneByIdDocumentbudget($piecejoint->getIdDocumentbudget());
                                    if ($document_udget_ordanancemet) {
                                        $piece_budget = PiecejointbudgetTable::getInstance()->findOneByIdDocachatAndIdDocumentbudget($definitif->getId(), $document_udget_ordanancemet->getId());
                                        if ($piece_budget) {
                                            echo date('d/m/Y', strtotime($piece_budget->getDocumentbudget()->getDatecreation()));
                                            if ($piece_budget->getDocumentbudget()->getMnt())
                                                echo ' - ' . $piece_budget->getDocumentbudget()->getMnt();
                                        }
                                    }
                                }
                            }
                            ?>
                        </td>
                            <td style="text-align: center" colspan="3">
                            <?php
                            foreach ($bon_deponse_externe_difinitif as $definitif) {
                                $docparent_parent = DocumentachatTable::getInstance()->findOneByIdDocparent($definitif->getId());
                                if ($docparent_parent) {
                                    echo '<p>' . $docparent_parent->getNumerodocachat();
                                    if ($definitif->getLignemouvementfacturation()->getFirst() && $definitif->getLignemouvementfacturation()->getFirst()->getNumerofacture())
                                        echo ' - ' . $definitif->getLignemouvementfacturation()->getFirst()->getNumerofacture();
                                    echo ' - ' . number_format($docparent_parent->getMntttc(), 3, ".", " ");
                                    echo '</p>';
                                }
                            }
                            ?>
                        </td>
                            <td style="text-align: center" colspan="2">
                            <?php
                            foreach ($bon_deponse_externe_difinitif as $definitif) {

                                $piecejoint = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($definitif->getId());
                                if ($piecejoint) {
                                    $id_document_udget_achatt = $piecejoint->getIdDocumentbudget();
                                    $document_budget_ordanancemet = DocumentbudgetTable::getInstance()->findOneByIdDocumentbudget($id_document_udget_achatt);
                                    if ($document_budget_ordanancemet) {
                                        $id_docbudget = $document_budget_ordanancemet->getId();
                                        $mvts = MouvementbanciareTable::getInstance()->getMouvementBCE($id_docbudget);

                                        if (sizeof($mvts) >= 1 && $mvts->getFirst()->getId() != null) {

                                            echo '<p>';

                                            echo date('d/m/Y', strtotime($mvts->getFirst()->getDateoperation()));
                                            if ($mvts->getFirst()->getDebit() != null)
                                                echo ' - ' . number_format($mvts->getFirst()->getDebit(), 3, ".", " ");
                                            else if ($mvts->getFirst()->getId() != null && $mvts->getFirst()->getCredit() != null)
                                                echo ' - ' . number_format($mvts->getFirst()->getCredit(), 3, ".", " ");

                                            echo '</p>';
                                        }
                                    }
                                }
                            }
                            ?>
                        </td>
                        
                         <td style="text-align: center" colspan="2">
                            <?php
                            foreach ($bon_deponse_externe_difinitif as $definitif) {
                                $id_docparent = $definitif->getId();
                                $piecejoint = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($id_docparent);
                                if ($piecejoint)
                                    $id_document_udget_achatt = $piecejoint->getIdDocumentbudget();
                                $document_budget_ordanancemet = DocumentbudgetTable::getInstance()->findOneByIdDocumentbudget($id_document_udget_achatt);
                                if ($document_budget_ordanancemet) {

                                    $mvts = MouvementbanciareTable::getInstance()->getMouvementBCE($document_budget_ordanancemet->getId());
                                    if (sizeof($mvts) >= 1) {
                                        echo '<p>';
                                        echo $mvts->getFirst()->getCaissesbanques();
//                                        echo ' - ' . $mvts->getFirst()->getInstrumentpaiment();
                                        echo ' - ' . $mvts->getFirst()->getDebit();
                                        echo '</p>';
                                    }
                                }
                            }
                            ?>
                        </td>

                        </tr>
                        <?php
                    endif;
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
        var tableHTML = encodeURIComponent($("#" + tableID).html());
        ;
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