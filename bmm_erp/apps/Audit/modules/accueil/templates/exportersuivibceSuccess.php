<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Suivi-BCE-Contrat')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter suivi bce & contrat vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv"> 
        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter suivi bce & contrat => Excel</small>
    </h1>
</div>
<?php
$documentachats = DocumentachatTable::getInstance()->getByTypedoc(6);
?>

<div class="row">
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px;margin-top: 2px;width: 100%" id="table_plan" border="1">
            <thead>
                <tr>
                    <th style="width: 5%;text-align: center;" >N° BCI</th>
                    <th style="width: 5%;text-align: center;" >D.Création</th>
                    <th style="width: 7%;text-align: center" > Demandeur</th>
                    <th style="width: 3%;text-align: center" >Etat Document</th>
                    <th style="width: 5%;text-align: center">BCE Provisoire</th>
                    <th style="width: 5%;text-align: center ">N°BCED</th>
                    <th style="width: 5%;text-align: center ">Montant</th>
                    <th style="width: 5%;text-align: center " >Contrat </th>
                    <th style="width: 10%;text-align: center">Date Engagement</th>
                    <th style="width: 10%;text-align: center">Montant Engagement</th>
                    <th style="width: 10%;text-align: center">Date Ordonnancement</th>
                    <th style="width: 10%;text-align: center">Montant Ordonnancement</th>
                    <th style="width: 5%;text-align: center" >N°FAC S</th>
                    <th style="width: 5%;text-align: center" >N°FAC FRS</th>
                    <th style="width: 5%;text-align: center" >Montant</th>
                    <th style="width: 5%;text-align: center" >Date paiement</th>
                    <th style="width: 5%;text-align: center" >Montant</th>
                    <th style="width: 5%;">Banque</th>
                    <th style="width: 5%;">Instrument de paiement </th>
                    <th style="width: 5%;">Montant</th>
                </tr>
            </thead>
            <tbody id="tblData">

                <?php
                foreach ($documentachats as $documentachat):
                    $bon_deponse_Provisoire = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($documentachat->getId(), 17);
                    if (sizeof($bon_deponse_Provisoire) == 0):
                        $document_achat_nv = Doctrine_Core::getTable('documentachat')->findByIdDocparent($documentachat->getId());
                        $document_achat_externe_Provisoire = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($documentachat->getId(), 18);
                        $document_achat_contrat = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($documentachat->getId(), 19);
                        $document_achat_externe_difinitif = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($documentachat->getId(), 7);
                        if (sizeof($document_achat_externe_Provisoire) >= 1)
                            $piece_budget_porvisoire = Doctrine_Core::getTable('piecejointbudget')->findByIdDocachat($document_achat_externe_Provisoire->getFirst()->getId());
                        if (sizeof($document_achat_externe_difinitif) >= 1) {
                            $id_docparent = $document_achat_externe_difinitif->getFirst()->getId();
                            $docparent_parent = Doctrine_Core::getTable('documentachat')->findByIdDocparent($id_docparent);
                            if (sizeof($docparent_parent) >= 1) {
                                $id_docparent_parent = $docparent_parent->getFirst()->getId();
                                $facuture_comptabe = Doctrine_Core::getTable('documentachat')->findByIdDocparent($id_docparent_parent);
                            }
                        }
                        if (sizeof($document_achat_externe_difinitif) >= 1) {
                            $id_docparent = $document_achat_externe_difinitif->getFirst()->getId();
                            $document_udget_ordanancemet = Doctrine_Core::getTable('documentbudget')->findByIdType(2);
                            $piece_budget = Doctrine_Core::getTable('Piecejointbudget')->findOneByIdDocachatAndIdDocumentbudget($id_docparent, $document_udget_ordanancemet->getFirst()->getId());
                        }
                        ?>
                        <tr> 
                            <td style="text-align: center;"class="fixed-side" scope="col">
                                            <b><?php echo $documentachat->getNumerodocachat();?> </b>
                            </td>
                            <td style="text-align: center"  scope="col"><?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?></td>   
                            <td><?php
                                if (($documentachat->getIdDemandeur() != '' && $documentachat->getIdDemandeur() != null))
                                    echo $documentachat->getDemandeur();
                                ?>
                            </td>
                            <td>
                                <?php
                                if (sizeof($document_achat_externe_Provisoire) >= 1)
                                    echo $document_achat_nv->getFirst()->getEtatdocument()->getEtatdocachat();
                                else
                                    echo '';
                                ?>
                            </td>
                            <td style="text-align: center">
                                <?php
                                if (sizeof($document_achat_externe_Provisoire) >= 1)
                                                echo $document_achat_externe_Provisoire->getFirst()->getNumerodocachat();
                                else
                                    echo '';
                                ?>
                            </td>
                            <td style="text-align: center">
                                <?php
                                if (sizeof($document_achat_externe_difinitif) >= 1)
                                                echo $document_achat_externe_difinitif->getFirst()->getNumerodocachat();
                                else
                                    echo '';
                                ?></td>

                            <td style="text-align: right">
                                <?php
                                if (sizeof($document_achat_externe_difinitif) >= 1)
                                    echo number_format($document_achat_externe_difinitif->getFirst()->getMntttc(), 3, ".", " ");
                                else
                                    echo '';
                                ?>
                            </td>
                            <td>
                                <?php
                                if (sizeof($document_achat_contrat) >= 1)
                                    echo $document_achat_contrat->getFirst()->getNumerodocachat() . ' ' . number_format($document_achat_contrat->getFirst()->getMntttc(), 3, ".", " ");
                                else
                                    echo '';
                                ?>

                            </td>

                            <td style="text-align: center">
                                <?php
                                if (sizeof($document_achat_externe_Provisoire) >= 1 && (sizeof($piece_budget_porvisoire) >= 1)) {
                                    echo 
                                    date('d/m/Y', strtotime($piece_budget_porvisoire->getFirst()->getDocumentbudget()->getDatecreation()));
                                } else {
                                    echo '';
                                }
                                ?>
                            </td>
                            <td style="text-align: right">
                                <?php
                                if (sizeof($document_achat_externe_Provisoire) >= 1 && (sizeof($piece_budget_porvisoire) >= 1)) {
                                    echo 
                                   $piece_budget_porvisoire->getFirst()->getDocumentbudget()->getMnt();
                                } else {
                                    echo '';
                                }
                                ?>
                            </td>
                            <td style="text-align: center">
                                <?php
                                if (sizeof($document_achat_externe_difinitif) >= 1) {
                                    $id_docparent = $document_achat_externe_difinitif->getFirst()->getId();
                                    $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($id_docparent);
                                    $id_document_udget_achatt = $piecejoint->getFirst()->getIdDocumentbudget();
                                    $document_udget_ordanancemet = Doctrine_Core::getTable('documentbudget')->findByIdDocumentbudget($id_document_udget_achatt);
                                    if (sizeof($document_udget_ordanancemet) >= 1) {
                                        $piece_budget = Doctrine_Core::getTable('Piecejointbudget')->findByIdDocachatAndIdDocumentbudget($id_docparent, $document_udget_ordanancemet->getFirst()->getId());
                                        if (sizeof($piece_budget) >= 1) {
                                            if (($piece_budget->getFirst()->getId() != null))
                                                echo  date('d/m/Y', strtotime($piece_budget->getFirst()->getDocumentbudget()->getDatecreation()));
                                        }
                                    }
                                } else {
                                    echo '';
                                }
                                ?>
                            </td>
                            <td style="text-align: right">
                                <?php
                                if (sizeof($document_achat_externe_difinitif) >= 1) {
                                    $id_docparent = $document_achat_externe_difinitif->getFirst()->getId();
                                    $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($id_docparent);
                                    $id_document_udget_achatt = $piecejoint->getFirst()->getIdDocumentbudget();
                                    $document_udget_ordanancemet = Doctrine_Core::getTable('documentbudget')->findByIdDocumentbudget($id_document_udget_achatt);
                                    if (sizeof($document_udget_ordanancemet) >= 1) {
                                        $piece_budget = Doctrine_Core::getTable('Piecejointbudget')->findByIdDocachatAndIdDocumentbudget($id_docparent, $document_udget_ordanancemet->getFirst()->getId());
                                        if (sizeof($piece_budget) >= 1) {
                                            if (($piece_budget->getFirst()->getId() != null))
                                                echo $piece_budget->getFirst()->getDocumentbudget()->getMnt();
                                        }
                                    }
                                } else {
                                    echo '';
                                }
                                ?>
                            </td>
                            <td style="text-align: center">
                                <?php
                                if (sizeof($document_achat_externe_difinitif) >= 1) {
                                    $docparent_parent = Doctrine_Core::getTable('documentachat')->findByIdDocparent($id_docparent);
                                    if (sizeof($docparent_parent) >= 1 && sizeof($facuture_comptabe) >= 1) {
                                        echo $facuture_comptabe->getFirst()->getNumerodocachat();
                                    }
                                } else {
                                    echo '';
                                }
                                ?>
                            </td>
                            <td style="text-align: center">
                                <?php
                                if (sizeof($document_achat_externe_difinitif) >= 1) {
                                    $docparent_parent = Doctrine_Core::getTable('documentachat')->findByIdDocparent($id_docparent);
                                    if (sizeof($docparent_parent) >= 1 && sizeof($facuture_comptabe) >= 1 && $document_achat_externe_difinitif->getFirst()->getLignemouvementfacturation()->getFirst()->getNumerofacture() != null) {
                                        echo $document_achat_externe_difinitif->getFirst()->getLignemouvementfacturation()->getFirst()->getNumerofacture();
                                    }
                                } else {
                                    echo '';
                                }
                                ?>
                            </td>
                            <td style="text-align: right">
                                <?php
                                if (sizeof($document_achat_externe_difinitif) >= 1) {
                                    $docparent_parent = Doctrine_Core::getTable('documentachat')->findByIdDocparent($id_docparent);
                                    if (sizeof($docparent_parent) >= 1 && sizeof($facuture_comptabe) >= 1) {
                                        echo number_format($facuture_comptabe->getFirst()->getMntttc(), 3, ".", " ");
                                    }
                                } else {
                                    echo '';
                                }
                                ?>
                            </td>
                            <td style="text-align: center">
                                <?php
                                if (sizeof($document_achat_externe_difinitif) >= 1) {
                                    $id_docparent = $document_achat_externe_difinitif->getFirst()->getId();
                                    $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($id_docparent);

                                    $id_document_udget_achatt = $piecejoint->getFirst()->getIdDocumentbudget();
                                    $document_budget_ordanancemet = Doctrine_Core::getTable('documentbudget')->findByIdDocumentbudget($id_document_udget_achatt);
                                    if (sizeof($document_budget_ordanancemet) >= 1) {
                                        $id_docbudget = $document_budget_ordanancemet->getFirst()->getId();
                                        $mvts = MouvementbanciareTable::getInstance()->getMouvementBCE($id_docbudget);
                                    }
                                    ?>
                                    <?php
                                    if (sizeof($mvts) >= 1) {
                                        if ($mvts->getFirst()->getId() != null)
                                            echo date('d/m/Y', strtotime($mvts->getFirst()->getDateoperation()));
                                    } else
                                        echo '';
                                    ?>

                                    <?php
                                }
                                ?>
                            </td>

                            <td style="text-align: center">
                                <?php
                                if (sizeof($document_achat_externe_difinitif) >= 1) {
                                    $id_docparent = $document_achat_externe_difinitif->getFirst()->getId();
                                    $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($id_docparent);

                                    $id_document_udget_achatt = $piecejoint->getFirst()->getIdDocumentbudget();
                                    $document_budget_ordanancemet = Doctrine_Core::getTable('documentbudget')->findByIdDocumentbudget($id_document_udget_achatt);
                                    if (sizeof($document_budget_ordanancemet) >= 1) {
                                        $id_docbudget = $document_budget_ordanancemet->getFirst()->getId();
                                        $mvts = MouvementbanciareTable::getInstance()->getMouvementBCE($id_docbudget);
                                    }
                                    ?>
                                    <?php
                                    if (sizeof($mvts) >= 1) {
                                        if ($mvts->getFirst()->getId() != null && $mvts->getFirst()->getDebit() != null)
                                            echo number_format($mvts->getFirst()->getDebit(), 3, ".", " ");
                                        else if ($mvts->getFirst()->getId() != null && $mvts->getFirst()->getCredit() != null)
                                            echo number_format($mvts->getFirst()->getCredit(), 3, ".", " ");
                                    } else
                                        echo '';
                                    ?>

                                    <?php
                                }
                                ?>
                            </td>
                            <!--banque -->
                            <td style="text-align: center">
                                <?php
                                if (sizeof($document_achat_externe_difinitif) >= 1) {
                                    $id_docparent = $document_achat_externe_difinitif->getFirst()->getId();
                                    $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($id_docparent);

                                    $id_document_udget_achatt = $piecejoint->getFirst()->getIdDocumentbudget();
                                    $document_budget_ordanancemet = Doctrine_Core::getTable('documentbudget')->findByIdDocumentbudget($id_document_udget_achatt);
                                    if (sizeof($document_budget_ordanancemet) >= 1) {
                                        $id_docbudget = $document_budget_ordanancemet->getFirst()->getId();
                                        $mvts = MouvementbanciareTable::getInstance()->getMouvementBCE($id_docbudget);
                                    }
                                    ?>
                                    <?php
                                    if (sizeof($mvts) >= 1) {
                                        if ($mvts->getFirst()->getId() != null && $mvts->getFirst()->getIdBanque() != null)
                                            echo $mvts->getFirst()->getCaissesbanques();
                                    } else
                                        echo '';
                                    ?>

                                    <?php
                                }
                                ?>
                            </td>
                            <td style="text-align: center">
                                <?php
                                if (sizeof($document_achat_externe_difinitif) >= 1) {
                                    $id_docparent = $document_achat_externe_difinitif->getFirst()->getId();
                                    $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($id_docparent);

                                    $id_document_udget_achatt = $piecejoint->getFirst()->getIdDocumentbudget();
                                    $document_budget_ordanancemet = Doctrine_Core::getTable('documentbudget')->findByIdDocumentbudget($id_document_udget_achatt);
                                    if (sizeof($document_budget_ordanancemet) >= 1) {
                                        $id_docbudget = $document_budget_ordanancemet->getFirst()->getId();
                                        $mvts = MouvementbanciareTable::getInstance()->getMouvementBCE($id_docbudget);
                                    }
                                    ?>
                                    <?php
                                    if (sizeof($mvts) >= 1) {
                                        if ($mvts->getFirst()->getId() != null && $mvts->getFirst()->getIdBanque() != null)
                                            echo $mvts->getFirst()->getInstrumentpaiment();
                                    } else
                                        echo '';
                                    ?>

                                    <?php
                                }
                                ?>
                            </td>

                            <td style="text-align: center">
                                <?php
                                if (sizeof($document_achat_externe_difinitif) >= 1) {
                                    $id_docparent = $document_achat_externe_difinitif->getFirst()->getId();
                                    $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($id_docparent);

                                    $id_document_udget_achatt = $piecejoint->getFirst()->getIdDocumentbudget();
                                    $document_budget_ordanancemet = Doctrine_Core::getTable('documentbudget')->findByIdDocumentbudget($id_document_udget_achatt);
                                    if (sizeof($document_budget_ordanancemet) >= 1) {
                                        $id_docbudget = $document_budget_ordanancemet->getFirst()->getId();
                                        $mvts = MouvementbanciareTable::getInstance()->getMouvementBCE($id_docbudget);
                                    }


                                    if (sizeof($docparent_parent) >= 1 && sizeof($mvts) >= 1) {
                                        echo $mvts->getFirst()->getDebit();
                                    } else {
                                        echo '';
                                    }
                                }
                                ?>
                            </td></tr>
                    <?php endif; ?>

                <?php endforeach; ?>
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