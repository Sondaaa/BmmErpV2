<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Suivi-BCE-Contrat')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter suivi bce  vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv">
        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter suivi bce => Excel</small>
    </h1>
</div>


<div class="row" style="max-width: 100%">
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px;margin-top: 2px;width: 100%" id="table_plan" border="1">
            <thead>
                <tr>
                    <th style="width: 5%;text-align: center;">N° BCI</th>
                    <th style="width: 5%;text-align: center;">D.Création</th>
                    <th style="width: 7%;text-align: center"> Demandeur</th>
                    <th style="width: 3%;text-align: center">Etat.Doc</th>
                    <th style="width: 5%;text-align: center">BCE Pro</th>
                    <th style="width: 5%;text-align: center ">N°BCED</th>
                    <th style="width: 5%;text-align: center ">Montant</th>
                    <th style="width: 5%;text-align: center">Date Eng</th>
                    <th style="width: 5%;text-align: center">Mnt Eng</th>
                    <th style="width: 5%;text-align: center">Date Ordo.</th>
                    <th style="width: 7%;text-align: center">Montant Ordo.</th>
                    <th style="width: 5%;text-align: center">N°FAC S</th>
                    <th style="width: 5%;text-align: center">N°FAC FRS</th>
                    <th style="width: 5%;text-align: center">Montant</th>
                    <th style="width: 6%;text-align: center">Date paiement</th>
                    <th style="width: 5%;text-align: center">Montant</th>
                    <th style="width: 5%;">Banque</th>
                    <th style="width: 7%;">Instrument de paiement </th>
                    <th style="width: 5%;">Montant</th>
                </tr>
            </thead>
            <tbody id="tblData">
                <?php foreach ($documentachats as $documentachat) : ?>


                    <tr class="ligne_compte">
                        <td style="text-align: center;width: 5%;">
                            <b>
                                <a target="_blank" href="<?php echo url_for("documentachat/Imprimerdocachat?iddoc=" . $documentachat->getId()); ?>">
                                    <?php
                                    echo $documentachat->getNumerodocachat();
                                    ?>
                                </a>

                            </b>
                        </td>

                        <td style="text-align: center;width: 7%;"><?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?></td>
                        <td ><?php
                            if (($documentachat->getIdDemandeur() != '' && $documentachat->getIdDemandeur() != null))
                                echo $documentachat->getDemandeur();
                            ?>
                        </td>
                        <td style="max-width: 3%">
                            <?php
                            $document_achat_externe_Provisoire = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($documentachat->getId(), 18);
                            $document_achat_externe_difinitif = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($documentachat->getId(), 7);

                            $doc_paret = Doctrine_Core::getTable('documentachat')->findByIdDocparent($documentachat->getId());
                            if (sizeof($documentachat) >= 1 && sizeof($doc_paret) == 0)
                                echo $documentachat->getEtatdocument()->getEtatdocachat();

                            else if (sizeof($doc_paret) >= 1 && sizeof($document_achat_externe_Provisoire) == 0)
                                echo $doc_paret->getLast()->getEtatdocument()->getEtatdocachat();
                            else if (sizeof($document_achat_externe_Provisoire) >= 1 && sizeof($document_achat_externe_difinitif) == 0)
                                echo $document_achat_externe_Provisoire->getFirst()->getEtatdocument()->getEtatdocachat();
                            else if (sizeof($document_achat_externe_difinitif) >= 1 && sizeof($document_achat_externe_Provisoire) >= 1)
                                echo $document_achat_externe_difinitif->getFirst()->getEtatdocument()->getEtatdocachat();
                            else
                                echo '';
                            ?>
                        </td>
                        <td style="text-align: center;width: 5%;">
                            <?php
                            $document_achat_externe_Provisoire = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($documentachat->getId(), 18);
                            foreach ($document_achat_externe_Provisoire as $prevesoire) :
                                ?>
                                <a target="_blank" href="<?php echo $prevesoire->getLinkDocument(); ?>">
                                    <?php
                                    echo '<p>' . $prevesoire->getNumerodocachat() . '</p>';
                                    ?>
                                </a>
                            <?php endforeach; ?>
                        </td>
                        <td style="text-align: center;width: 5%;" colspan="2">
                            <?php
                            $document_achat_externe_difinitif = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($documentachat->getId(), 7);
                            foreach ($document_achat_externe_difinitif as $definitif) :
                                ?>
                                <a target="_blank" href="<?php echo $definitif->getLinkDocument(); ?>">
                                    <?php
                                    echo '<p>';
                                    echo $definitif->getNumerodocachat();
                                    echo ' - ' . number_format($definitif->getMntttc(), 3, ".", " ");
                                    echo '</p>';
                                    ?>
                                </a>
                            <?php endforeach; ?>
                        </td>




                        <td colspan="2" >
                            <?php
                            foreach ($document_achat_externe_Provisoire as $prevesoire) :
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

                        <td colspan="2">
                            <?php
                            foreach ($document_achat_externe_difinitif as $definitif) {

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
                            foreach ($document_achat_externe_difinitif as $definitif) {
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
                            foreach ($document_achat_externe_difinitif as $definitif) {

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
                        <td style="text-align: center" colspan="3">
                            <?php
                            foreach ($document_achat_externe_difinitif as $definitif) {
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
                                        echo ' - ' . $mvts->getFirst()->getInstrumentpaiment();
                                        echo ' - ' . $mvts->getFirst()->getDebit();
                                        echo '</p>';
                                    }
                                }
                            }
                            ?>
                        </td>


                    </tr>
                    <?php
                endforeach;
                ?>

            </tbody>
        </table>
    </div>
</div>


<script type="text/javascript">
    function exportTableToExcel(tableID, filename = '') {
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