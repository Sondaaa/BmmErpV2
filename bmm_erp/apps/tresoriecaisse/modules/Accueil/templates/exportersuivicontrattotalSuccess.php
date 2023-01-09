<div id="sf_admin_container">
    <div class="col-sm-12">
        <button style="float: right;" class="btn btn-xs btn-success" onclick="exportTableToExcel('PDFcontent', 'Suivi-Contrat-Livraison-Total')">
            <i class="ace-icon fa fa-file-excel-o"></i> Exporter suivi Contrat Livraison Total  vers Fichier Excel
        </button>
    </div>
    <h1 id="replacediv"> 
        <small><i class="ace-icon fa fa-angle-double-right"></i> Exporter suivi Contrat Livraison Total  => Excel</small>
    </h1>
</div>
<?php
//$documentachats = DocumentachatTable::getInstance()->getByTypedocContrat(19);
$contratsachat = ContratachatTable::getInstance()->findbyIdTypedoc(19);
$contratsachats = ContratachatTable::getInstance()->findAll();
?>

<div class="row">
    <div class="col-sm-12" id="PDFcontent">
        <table style="margin-bottom: 0px;margin-top: 2px;width: 100%;font-size: 12px" id="table_plan" border="1">
            <thead>
                <tr>
                    <th style="width: 5%;text-align: center;" >N°BCI</th>
                    <th style="width: 5%;text-align: center;" >D.Création</th>
                    <th style="width: 5%;text-align: center" > Demandeur</th>
                    <th style="width: 10%;text-align: center" >Etat Doc</th>
                    <th style="width: 5%;text-align: center">Contrat Prov.</th>
                    <th style="width: 5%;text-align: center ">N°Contrat def</th>
                    <th style="width: 5%;text-align: center ">Montant</th>                    
                    <th style="width: 5%;text-align: center">Date Eng.</th>
                    <th style="width: 5%;text-align: center">Mnt Eng.</th>
                    <th style="width: 5%;text-align: center">Date Ord.</th>
                    <th style="width: 5%;text-align: center">Mnt Ord.</th>
                    <th style="width: 5%;text-align: center" >N°FAC S</th>
                    
                    <th style="width: 5%;text-align: center" >Montant</th>
                    <th style="width: 5%;text-align: center" >Date paiement</th>
                    <th style="width: 5%;text-align: center" >Montant</th>
                    <th style="width: 5%;">Banque</th>
                    <th style="width: 5%;">Instrum° de paiem° </th>
                    <th style="width: 5%;">Montant</th>
                </tr>
            </thead>
            <tbody id="tblData">

                <?php
                foreach ($documentachats as $document_achat):
                    $id_doc_parent = $document_achat->getIdDocparent();
                    $doc_parent = DocumentachatTable::getInstance()->find($id_doc_parent);
                    $docupmenta_acha_contrat_def = DocumentachatTable::getInstance()->getByTypedocContratDef(20, $document_achat->getId());

                    if (sizeof($docupmenta_acha_contrat_def) >= 1) {
                        $id_docparent_parent = $docupmenta_acha_contrat_def->getFirst()->getId();
                        $facuture_comptabe = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($id_docparent_parent, 15);
//                                             die(sizeof($facuture_comptabe).'rpp');
                        if (sizeof($facuture_comptabe) >= 1) {
                            $row_spna = sizeof($facuture_comptabe);
                        }
                    }
                    if (sizeof($document_achat) >= 1)
                        $piece_budget_porvisoire = Doctrine_Core::getTable('piecejointbudget')->findByIdDocachat($document_achat->getId());
                    if (sizeof($docupmenta_acha_contrat_def) >= 1)
                        $piece_budget_defi = Doctrine_Core::getTable('piecejointbudget')->findByIdDocachat($docupmenta_acha_contrat_def->getFirst()->getId());
//                             
//                                   die($piece_budget_porvisoire->getFirst()->getDocumentbudget() . 'm');
                    if (sizeof($document_achat) >= 1):
                        ?>
                        <tr> 
                            <td style="text-align: center;"class="fixed-side" scope="col">
                                <b><?php echo 'BCI N° ' . sprintf('%05d', $document_achat->getNumero()) ; ?> </b>
                            </td>
                            <td style="text-align: center"  scope="col"><?php echo date('d/m/Y', strtotime($document_achat->getDatecreation())); ?></td>   
                            <td><?php
                                if ($doc_parent) {
                                    if (($doc_parent->getIdDemandeur() != '' && $doc_parent->getIdDemandeur() != null))
                                        echo $doc_parent->getDemandeur();
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                $docupmenta_acha_contrat_def = DocumentachatTable::getInstance()->getByTypedocContratDef(20, $document_achat->getId());
                                if (sizeof($docupmenta_acha_contrat_def) >= 1)
                                    echo $docupmenta_acha_contrat_def->getFirst()->getEtatdocument()->getEtatdocachat();
                                elseif (sizeof($document_achat) >= 1)
                                    echo $document_achat->getEtatdocument()->getEtatdocachat();
                                ?>
                            </td>
                            <td style="text-align: center">
                                <?php
                                if (sizeof($document_achat) >= 1)
                                    echo $document_achat->getContratachat()->getReference() . '  ' . $document_achat->getContratachat()->getNumero();
//                                                include_partial('tddetaildoc', array('boncomm' => $document_achat_externe_Provisoire->getFirst()));
                                else
                                    echo '';
                                ?>
                            </td>
                            <td style="text-align: center">
                                <?php
                                if (sizeof($docupmenta_acha_contrat_def) >= 1)
                                    echo $docupmenta_acha_contrat_def->getFirst()->getContratachat()->getNumero();
////                                                include_partial('tddetaildoc', array('boncomm' => $document_achat_externe_difinitif->getFirst()));
                                else
                                    echo '';
                                ?></td>

                            <td style="text-align: right" >
                                <?php
                                if (sizeof($docupmenta_acha_contrat_def) >= 1)
                                    echo number_format($docupmenta_acha_contrat_def->getFirst()->getContratachat()->getMnttc(), 3, ".", " ");
                                else
                                    echo '';
                                ?>
                            </td>
                           
                            <td >
                                <?php
                                if (sizeof($document_achat) >= 1 && (sizeof($piece_budget_porvisoire) >= 1)) {
                                    echo date('d/m/Y', strtotime($piece_budget_porvisoire->getFirst()->getDocumentbudget()->getDatecreation()));
                                } elseif (sizeof($document_achat) >= 1 && (sizeof($piece_budget_defi) >= 1)) {
                                    echo date('d/m/Y', strtotime($piece_budget_defi->getFirst()->getDocumentbudget()->getDatecreation()));
                                }
                                ?>
                            </td>
                            <td >
                                <?php
                                if (sizeof($document_achat) >= 1 && (sizeof($piece_budget_porvisoire) >= 1)) {
                                    echo number_format($piece_budget_porvisoire->getFirst()->getDocumentbudget()->getMnt(), 3, ".", " ");
                                } elseif (sizeof($document_achat) >= 1 && (sizeof($piece_budget_defi) >= 1)) {
                                    echo number_format($piece_budget_defi->getFirst()->getDocumentbudget()->getMnt(), 3, ".", " ");
                                }
                                ?>
                            </td>
                            <td>     <?php
                                if (sizeof($docupmenta_acha_contrat_def) >= 1) {

                                    $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($docupmenta_acha_contrat_def->getFirst()->getId());
                                    if (sizeof($piecejoint) >= 1)
                                        $id_document_udget_achatt = $piecejoint->getFirst()->getIdDocumentbudget();
                                    $document_udget_ordanancemet = Doctrine_Core::getTable('documentbudget')->findByIdDocumentbudget($id_document_udget_achatt);
                                    if (sizeof($document_udget_ordanancemet) >= 1) {
                                        $piece_budget = Doctrine_Core::getTable('Piecejointbudget')->findByIdDocachatAndIdDocumentbudget($docupmenta_acha_contrat_def->getFirst()->getId(), $document_udget_ordanancemet->getFirst()->getId());
                                        if (sizeof($piece_budget) >= 1) {
                                            foreach ($piece_budget as $budget):
                                                echo date('d/m/Y', strtotime($budget->getDocumentbudget()->getDatecreation()));
                                            endforeach;
                                            ?>
                                            </br>
                                            <?php
                                        }
                                    }
                                }


//                                                
                                ?>
                            </td>
                            <td style="text-align: right" >
                                <?php
                                if (sizeof($docupmenta_acha_contrat_def) >= 1) {

                                    $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($docupmenta_acha_contrat_def->getFirst()->getId());
                                    if (sizeof($piecejoint) >= 1)
                                        $id_document_udget_achatt = $piecejoint->getFirst()->getIdDocumentbudget();
                                    $document_udget_ordanancemet = Doctrine_Core::getTable('documentbudget')->findByIdDocumentbudget($id_document_udget_achatt);
                                    if (sizeof($document_udget_ordanancemet) >= 1) {
                                        $piece_budget = Doctrine_Core::getTable('Piecejointbudget')->findByIdDocachatAndIdDocumentbudget($docupmenta_acha_contrat_def->getFirst()->getId(), $document_udget_ordanancemet->getFirst()->getId());
                                        if (sizeof($piece_budget) >= 1) {
                                            foreach ($piece_budget as $budget):
                                                echo $budget->getDocumentbudget()->getMnt();
                                            endforeach;
                                            ?>
                                            </br>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </td>
                            <td style="text-align: center" >
                                <?php
                                if (sizeof($docupmenta_acha_contrat_def) >= 1) {
                                    $id_docparent_parent = $docupmenta_acha_contrat_def->getFirst()->getId();
                                    $facuture_comptabe = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($id_docparent_parent, 15);
                                    if (sizeof($facuture_comptabe) >= 1) {

                                        $id_docparent = $facuture_comptabe->getFirst()->getIdDocparent();
                                        $docu_fac = DocumentachatTable::getInstance()->findOneById($id_docparent);
                                        $lignemvt = LignemouvementfacturationTable::getInstance()->findByIdDocumentachat($docu_fac->getId());
                                        foreach ($lignemvt as $ligmvt):
                                            echo $ligmvt->getNumerofacture();
                                            ?>
                                            </br>
                                            <?php
                                        endforeach;
                                    }
                                }
                                ?>
                            </td>

                            <td style="text-align: right" >
                                <?php
                                if (sizeof($docupmenta_acha_contrat_def) >= 1) {
                                    $id_docparent_parent = $docupmenta_acha_contrat_def->getFirst()->getId();
                                    $facuture_comptabe = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($id_docparent_parent, 15);
                                    if (sizeof($facuture_comptabe) >= 1) {

                                        $id_docparent = $facuture_comptabe->getFirst()->getIdDocparent();
                                        $docu_fac = DocumentachatTable::getInstance()->findOneById($id_docparent);
                                        $lignemvt = LignemouvementfacturationTable::getInstance()->findByIdDocumentachat($docu_fac->getId());
                                        foreach ($lignemvt as $ligmvt):

                                            echo number_format($ligmvt->getMontant(), 3, ".", " ");
                                            ?>
                                            </br>
                                            <?php
                                        endforeach;
                                    }
                                }
                                ?>
                            </td>
                            <td style="text-align: right" >

                                <?php
                                if (sizeof($docupmenta_acha_contrat_def) >= 1) {
                                    $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($docupmenta_acha_contrat_def->getFirst()->getId());
                                    if (sizeof($piecejoint) >= 1)
                                        $id_document_udget_achatt = $piecejoint->getFirst()->getIdDocumentbudget();
                                    $document_udget_ordanancemet = Doctrine_Core::getTable('documentbudget')->findByIdDocumentbudget($id_document_udget_achatt);
                                    if (sizeof($document_udget_ordanancemet) >= 1) {
                                        $piece_budget = Doctrine_Core::getTable('Piecejointbudget')->findByIdDocachat($docupmenta_acha_contrat_def->getFirst()->getId());
                                        if (sizeof($piece_budget) >= 1) {
                                            foreach ($piece_budget as $piece):
                                                $id_docbudget = $piece->getIdDocumentbudget();
                                                $mvts = MouvementbanciareTable::getInstance()->getMouvementBCE($id_docbudget);
                                                if (sizeof($mvts) >= 1) {
                                                    if ($mvts->getFirst()->getId() != null)
                                                        echo date('d/m/Y', strtotime($mvts->getFirst()->getDateoperation()));
                                                }
                                                ?>
                                                </br>
                                                <?php
                                            endforeach;
                                        }
                                    }
                                }
                                ?>
                            </td>
                            <td style="text-align: center" >
                                <?php
                                if (sizeof($docupmenta_acha_contrat_def) >= 1) {
                                    $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($docupmenta_acha_contrat_def->getFirst()->getId());
                                    if (sizeof($piecejoint) >= 1)
                                        $id_document_udget_achatt = $piecejoint->getFirst()->getIdDocumentbudget();
                                    $document_udget_ordanancemet = Doctrine_Core::getTable('documentbudget')->findByIdDocumentbudget($id_document_udget_achatt);
                                    if (sizeof($document_udget_ordanancemet) >= 1) {
                                        $piece_budget = Doctrine_Core::getTable('Piecejointbudget')->findByIdDocachat($docupmenta_acha_contrat_def->getFirst()->getId());
                                        if (sizeof($piece_budget) >= 1) {
                                            foreach ($piece_budget as $piece):
                                                $id_docbudget = $piece->getIdDocumentbudget();
                                                $mvts = MouvementbanciareTable::getInstance()->getMouvementBCE($id_docbudget);
                                                if (sizeof($mvts) >= 1) {
                                                    if ($mvts->getFirst()->getId() != null && $mvts->getFirst()->getDebit() != null)
                                                        echo number_format($mvts->getFirst()->getDebit(), 3, ".", " ");
                                                    else if ($mvts->getFirst()->getId() != null && $mvts->getFirst()->getCredit() != null)
                                                        echo number_format($mvts->getFirst()->getCredit(), 3, ".", " ");
                                                } else
                                                    echo '';
                                                ?>
                                                </br>
                                                <?php
                                            endforeach;
                                        }
                                    }
                                }
                                ?>
                            </td>

                            <td style="text-align: center" >
                                <?php
                                if (sizeof($docupmenta_acha_contrat_def) >= 1) {
                                    $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($docupmenta_acha_contrat_def->getFirst()->getId());
                                    if (sizeof($piecejoint) >= 1)
                                        $id_document_udget_achatt = $piecejoint->getFirst()->getIdDocumentbudget();
                                    $document_udget_ordanancemet = Doctrine_Core::getTable('documentbudget')->findByIdDocumentbudget($id_document_udget_achatt);
                                    if (sizeof($document_udget_ordanancemet) >= 1) {
                                        $piece_budget = Doctrine_Core::getTable('Piecejointbudget')->findByIdDocachat($docupmenta_acha_contrat_def->getFirst()->getId());
                                        if (sizeof($piece_budget) >= 1) {
                                            foreach ($piece_budget as $piece):
                                                $id_docbudget = $piece->getIdDocumentbudget();
                                                $mvts = MouvementbanciareTable::getInstance()->getMouvementBCE($id_docbudget);
                                                if (sizeof($mvts) >= 1) {
                                                    if ($mvts->getFirst()->getId() != null && $mvts->getFirst()->getIdBanque() != null)
                                                        echo $mvts->getFirst()->getCaissesbanques();
                                                }
                                                ?>
                                                </br>
                                                <?php
                                            endforeach;
                                        }
                                    }
                                }
                                ?>
                            </td>
                            <!--banque -->
                            <td style="text-align: center">
                                <?php
                                if (sizeof($docupmenta_acha_contrat_def) >= 1) {
                                    $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($docupmenta_acha_contrat_def->getFirst()->getId());
                                    if (sizeof($piecejoint) >= 1)
                                        $id_document_udget_achatt = $piecejoint->getFirst()->getIdDocumentbudget();
                                    $document_udget_ordanancemet = Doctrine_Core::getTable('documentbudget')->findByIdDocumentbudget($id_document_udget_achatt);
                                    if (sizeof($document_udget_ordanancemet) >= 1) {
                                        $piece_budget = Doctrine_Core::getTable('Piecejointbudget')->findByIdDocachat($docupmenta_acha_contrat_def->getFirst()->getId());
                                        if (sizeof($piece_budget) >= 1) {
                                            foreach ($piece_budget as $piece):
                                                $id_docbudget = $piece->getIdDocumentbudget();
                                                $mvts = MouvementbanciareTable::getInstance()->getMouvementBCE($id_docbudget);
                                                if (sizeof($mvts) >= 1) {
                                                    if ($mvts->getFirst()->getId() != null && $mvts->getFirst()->getIdBanque() != null)
                                                        echo $mvts->getFirst()->getInstrumentpaiment();
                                                }
                                                ?>
                                                </br>
                                                <?php
                                            endforeach;
                                        }
                                    }
                                }
                                ?>

                            </td>
                            <td style="text-align: center">
                                <?php
                                if (sizeof($docupmenta_acha_contrat_def) >= 1) {
                                    $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($docupmenta_acha_contrat_def->getFirst()->getId());
                                    if (sizeof($piecejoint) >= 1)
                                        $id_document_udget_achatt = $piecejoint->getFirst()->getIdDocumentbudget();
                                    $document_udget_ordanancemet = Doctrine_Core::getTable('documentbudget')->findByIdDocumentbudget($id_document_udget_achatt);
                                    if (sizeof($document_udget_ordanancemet) >= 1) {
                                        $piece_budget = Doctrine_Core::getTable('Piecejointbudget')->findByIdDocachat($docupmenta_acha_contrat_def->getFirst()->getId());
                                        if (sizeof($piece_budget) >= 1) {
                                            foreach ($piece_budget as $piece):
                                                $id_docbudget = $piece->getIdDocumentbudget();
                                                $mvts = MouvementbanciareTable::getInstance()->getMouvementBCE($id_docbudget);
                                                if (sizeof($mvts) >= 1) {
                                                    if ($mvts->getFirst()->getId() != null && $mvts->getFirst()->getIdBanque() != null)
                                                        echo $mvts->getFirst()->getDebit();
                                                }
                                                ?>
                                                </br>
                                                <?php
                                            endforeach;
                                        }
                                    }
                                }
                                ?>
                            </td>



                        </tr>
                        <?php
                    endif;
//    endif;
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