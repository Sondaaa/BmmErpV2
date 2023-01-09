<div id="sf_admin_container">
    <h1>SUIVI BON DEPENSE AU COMPTANT</h1>
</div>
<?php $documentachats = DocumentachatTable::getInstance()->getByTypedoc(6); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="table-header" style="margin-bottom: 0px;">
            Suivi des bons commandes achat 
            <a data-target="#my-modalimpression_bdc" role="button" onclick="setImprimeId()" data-toggle="modal" target="_blanc"
               class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;margin-left: 4px" >
                        Impression Personnalisée
                    </a>
            <a target="_blank" class="btn btn-sm btn-default" style="float: right; padding: 5px 12px;" href="<?php echo url_for("Accueil/exportersuivibdc")             ?>">
                <i class="ace-icon fa fa-file-excel-o"></i> 
                <span class="bigger-110 no-text-shadow">Exporter</span>
            </a>
        </div>
        <div class="col-xs-12" style="border: 1px solid #307ECC; padding-top: 10px;">
            <div id="table-scroll" class="table-scroll" style="margin-bottom: 10px;">
                <div class="table-wrap">
                    <table id="listBalance" class="mws-datatable-fn mws-table main-table">
                        <thead>
                            <tr>
                                <th style="widows: 30%;text-align: center;min-width: 50px" class="fixed-side" scope="col" colspan="2">Bon Commande Inetrne </th>
                                <!--<th style="widows: 10%">Date Création</th>-->
                                <th style="widows: 10%;text-align: center">Direction</th>
                                <th style="widows: 15%;text-align: center">Etat</th>
                                <th style="widows: 10%;text-align: center" colspan="3" >Bon Dépense au comptant</th>
                                <th style="widows: 20%;text-align: center" colspan="4">Budget</th>
                                <th style="widows: 10%;text-align: center" colspan="3">Facturation</th>
                                <th style="widows: 20%;text-align: center" colspan="2">Financiers</th>
                                <th style="widows: 20%;text-align: center" colspan="2"  >Réglemet Caisse</th>
                            </tr>
                            <tr>
                                <th style="widows: 20%;text-align: center;min-width: 110px" class="fixed-side" scope="col"rowspan="2">N° BCI</th>
                                <th style="widows: 10%;text-align: center;min-width: 110px" class="fixed-side" scope="col" rowspan="2">Date Création</th>
                                <th style="widows: 10%;min-width: 110px;text-align: center" rowspan="2"> Demandeur</th>
                                <th style="widows: 15%;min-width: 110px;text-align: center" rowspan="2">Etat du document</th>
                                <th style="widows: 10%;min-width: 110px;text-align: center"rowspan="2">BDC Provisoire</th>
                                <th style="widows: 10%;min-width: 110px;text-align: center "colspan="2">BDC Définitif</th>
                                <th style="widows: 20%;min-width: 110px;text-align: center"colspan="2">Engagement Budget</th>
                                <th style="widows: 20%;min-width: 110px;text-align: center"colspan="2">Ordonnancement</th>
                                <th style="widows: 10%;min-width: 110px;text-align: center" rowspan="2">N°FAC S</th>
                                <th style="widows: 10%;min-width: 110px;text-align: center" rowspan="2">N°FAC FRS</th>
                                <th style="widows: 10%;min-width: 110px;text-align: center" rowspan="2">Montant</th>
                                <th style="widows: 20%;min-width: 110px;text-align: center" rowspan="2">Date paiement</th>
                                <th style="widows: 10%;min-width: 110px;text-align: center" rowspan="2">Montant</th>
                                <th style="widows: 20%;min-width: 110px;" rowspan="2">Caisse</th>
                                <!--<th style="widows: 20%;min-width: 110px;" rowspan="2">Instrument de paiement </th>-->
                                <th style="widows: 20%;min-width: 110px;" rowspan="2">Montant</th>
                            </tr>
                            <tr><th>N°BDC D</th><th>Montant</th>
                              <th>Date</th><th>Montant</th><th>Date</th><th>Montant</th></tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($documentachats as $documentachat):
                                $bon_deponse_Provisoire = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($documentachat->getId(), 17);
                                if (sizeof($bon_deponse_Provisoire) >= 1):
                                    $bon_deponse_externe_difinitif = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($documentachat->getId(), 2);
                                    $document_bddc_nv = Doctrine_Core::getTable('documentachat')->findByIdDocparent($documentachat->getId());

                                    if (sizeof($bon_deponse_Provisoire) >= 1)
                                        $piece_budget_bon_depense_porvisoire = Doctrine_Core::getTable('piecejointbudget')->findByIdDocachat($bon_deponse_Provisoire->getFirst()->getId());

                                    if (sizeof($bon_deponse_externe_difinitif) >= 1) {
                                        $id_docparent = $bon_deponse_externe_difinitif->getFirst()->getId();
                                        $docparent_parent = Doctrine_Core::getTable('documentachat')->findByIdDocparent($id_docparent);
                                        if (sizeof($docparent_parent) >= 1) {
                                            $id_docparent_parent = $docparent_parent->getFirst()->getId();
//                                            die(sizeof($docparent_parent).'pp');
                                            $facuture_comptabe = Doctrine_Core::getTable('documentachat')->findById($id_docparent_parent);
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
                                        <td style="text-align: center;min-width: 150px;cursor: pointer"class="fixed-side" scope="col"><b>
                                                <!--<a target="_blank" href="<?php // echo url_for("documentachat/imprimerboncomande?iddoc=" . $documentachat->getId()); ?>">-->
                                                    <?php // echo $documentachat->getNumerodocachat();
                                                     include_partial('tddetaildoc', array('boncomm' => $documentachat))?>
                                                <!--</a>-->
                                            </b></td>

                                        <td style="text-align: center" class="fixed-side" scope="col"><?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?></td>   
                                        <td><?php
                                            if (($documentachat->getIdDemandeur() != '' && $documentachat->getIdDemandeur() != null))
                                                echo $documentachat->getDemandeur();
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                             $doc_paret= Doctrine_Core::getTable('documentachat')->findByIdDocparent($documentachat->getId());
                                         
                                            if (sizeof($documentachat) >= 1 && sizeof($doc_paret) == 0)
                                                echo $documentachat->getEtatdocument()->getEtatdocachat();
                                        
                                            else if(sizeof($doc_paret) >= 1 && sizeof($bon_deponse_Provisoire) == 0)
                                              echo   $doc_paret->getLast()->getEtatdocument()->getEtatdocachat();
                                            else if(sizeof($bon_deponse_Provisoire) >= 1 && sizeof($bon_deponse_externe_difinitif) == 0 )
                                                echo $bon_deponse_Provisoire->getFirst()->getEtatdocument()->getEtatdocachat();
                                           else  if (sizeof($bon_deponse_externe_difinitif) >= 1 && sizeof($bon_deponse_Provisoire) >= 1)
                                                echo $bon_deponse_externe_difinitif->getFirst()->getEtatdocument()->getEtatdocachat();
                                           
                                            else echo '';
                                            ?>
                                        </td>

                                        <!--bdc -->
                                        <td style="text-align: center">
                                            <?php
                                            if (sizeof($bon_deponse_Provisoire) >= 1)
//                                                echo $bon_deponse_Provisoire->getFirst()->getNumerodocachat();
                                             include_partial('tddetaildoc', array('boncomm' => $bon_deponse_Provisoire->getFirst()));
                                            else
                                                echo '';
                                            ?>
                                        </td>
                                        <td style="text-align: center">
                                            <?php
                                            if (sizeof($bon_deponse_externe_difinitif) >= 1)
//                                                echo $bon_deponse_externe_difinitif->getFirst()->getNumerodocachat();
                                                include_partial('tddetaildoc', array('boncomm' => $bon_deponse_externe_difinitif->getFirst()));
                                            else
                                                echo '';
                                            ?></td>

                                        <td style="text-align: right">
                                            <?php
                                            if (sizeof($bon_deponse_externe_difinitif) >= 1)
                                                echo number_format($bon_deponse_externe_difinitif->getFirst()->getMntttc(), 3, ".", " ");
                                            else
                                                echo '';
                                            ?>
                                        </td>
                                        <!--bdc -->
                                        <td>
                                            <?php
                                            if (sizeof($piece_budget_bon_depense_porvisoire) >= 1) {
                                                    echo  date('d/m/Y', strtotime($piece_budget_bon_depense_porvisoire->getFirst()->getDocumentbudget()->getDatecreation()));
                                                
                                            } else {
                                                echo '';
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: right">
                                            <?php
                                            if (sizeof($piece_budget_bon_depense_porvisoire) >= 1) {
                                                echo $piece_budget_bon_depense_porvisoire->getFirst()->getDocumentbudget()->getMnt();
                                            } else {
                                                echo '';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if (sizeof($bon_deponse_externe_difinitif) >= 1) {
                                                $id_docparent = $bon_deponse_externe_difinitif->getFirst()->getId();
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
                                            }
                                            else {
                                                echo '';
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: right">
                                            <?php
                                            if (sizeof($bon_deponse_externe_difinitif) >= 1) {
                                                $id_docparent = $bon_deponse_externe_difinitif->getFirst()->getId();
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
                                            }
                                            else {
                                                echo '';
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: center">
                                             <?php
                                             if (sizeof($bon_deponse_externe_difinitif) >= 1) {
                                                $docparent_parent = Doctrine_Core::getTable('documentachat')->findByIdDocparent($id_docparent);
                                                if (sizeof($docparent_parent) >= 1 && sizeof($facuture_comptabe) >= 1) {
                                            echo include_partial('tddetaildocfacture', array('boncomm' => $facuture_comptabe->getFirst()));
      }
                                            } else {
                                                echo '';
                                            }
                                            ?>
                                           
                                        </td>
                                        <td style="text-align: center">
                                            <?php
                                            if (sizeof($bon_deponse_externe_difinitif) >= 1) {
                                                $docparent_parent = Doctrine_Core::getTable('documentachat')->findByIdDocparent($id_docparent);
//                                            die(($document_achat_externe_difinitif->getFirst()->getLignemouvementfacturation()->getFirst()->getNumerofacture())."ok");
                                                if (sizeof($docparent_parent) >= 1 && sizeof($facuture_comptabe) >= 1 && $bon_deponse_externe_difinitif->getFirst()->getLignemouvementfacturation()->getFirst()->getNumerofacture() != null) {
                                                    echo $bon_deponse_externe_difinitif->getFirst()->getLignemouvementfacturation()->getFirst()->getNumerofacture();
                                                }
                                            } else {
                                                echo '';
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: right">
                                            <?php
                                            if (sizeof($bon_deponse_externe_difinitif) >= 1) {
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
                                            if (sizeof($bon_deponse_externe_difinitif) >= 1) {
                                                $id_docparent = $bon_deponse_externe_difinitif->getFirst()->getId();
                                                $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($id_docparent);

                                                $id_document_udget_achatt = $piecejoint->getFirst()->getIdDocachat();
//                                                $document_ordanancemet = DocumentbudgetTable::getInstance()->findOneById($id_document_udget_ordanancemet);
                                                $mvts = MouvementbanciareTable::getInstance()->getMouvement($id_document_udget_achatt);
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
                                            if (sizeof($bon_deponse_externe_difinitif) >= 1) {
                                                $id_docparent = $bon_deponse_externe_difinitif->getFirst()->getId();
                                                $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($id_docparent);

                                                $id_document_udget_achatt = $piecejoint->getFirst()->getIdDocachat();
//                                                $document_ordanancemet = DocumentbudgetTable::getInstance()->findOneById($id_document_udget_ordanancemet);
                                                $mvts = MouvementbanciareTable::getInstance()->getMouvement($id_document_udget_achatt);
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

                                        <td style="text-align: center">
                                            <?php
                                            if (sizeof($bon_deponse_externe_difinitif) >= 1) {
                                                $id_docparent = $bon_deponse_externe_difinitif->getFirst()->getId();
                                                $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($id_docparent);

                                                $id_document_udget_achatt = $piecejoint->getFirst()->getIdDocachat();
//                                                $document_ordanancemet = DocumentbudgetTable::getInstance()->findOneById($id_document_udget_ordanancemet);
                                                $mvts = MouvementbanciareTable::getInstance()->getMouvement($id_document_udget_achatt);
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


                                        <td style="text-align: right">
                                            <?php
                                            if (sizeof($bon_deponse_externe_difinitif) >= 1) {
                                                $id_docparent = $bon_deponse_externe_difinitif->getFirst()->getId();
                                                $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($id_docparent);

                                                $id_document_udget_achatt = $piecejoint->getFirst()->getIdDocachat();
//                                                $document_ordanancemet = DocumentbudgetTable::getInstance()->findOneById($id_document_udget_ordanancemet);
                                                $mvts = MouvementbanciareTable::getInstance()->getMouvement($id_document_udget_achatt);
                                                if (sizeof($mvts) >= 1) {
                                                    if ($mvts->getFirst()->getId() != null && $mvts->getFirst()->getIdBanque() != null)
                                                        echo $mvts->getFirst()->getDebit();
                                                }
                                            } else {
                                                echo '';
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
        </div>
    </div>
</div>
<div id="my-modalimpression_bdc" class="modal fade" tabindex="-1" style="width: 1200px;display: none"> 
    <?php include_partial('Accueil/form_impression_bdc', array()); ?>
</div>
<script  type="text/javascript">

    // requires jquery library
    jQuery(document).ready(function () {
        console.log('add clone');
        jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
    });
 function setImprimeId()
    {
//        $('#id_imprime').val(id);
    }
</script>
<style type="text/css">
    .header_table th{
        font-weight: bold;
        font-size: 13px;
    }
    .tab_filter tbody td { 
        border-right-color: #ffffff !important;
        border-right-style: solid;
        border-right-width: 2px;
        padding: 5px ;
    }
    tr:hover{color: #2679b5;}
</style>

<style>

    .table-scroll {
        position:relative;
        max-width:100%;
        margin:auto;
        overflow:hidden;
        width: 100%;
        border:1px solid #fff;
    }
    .table-wrap {
        width:100%;
        border:1px solid #000;
        overflow:auto;
    }
    .table-scroll table {
        width:100%;
        margin:auto;
        border:1px solid #000;
        border-collapse:separate;
        border-spacing:0;
    }
    .table-scroll th, .table-scroll td {
        padding:5px 10px;
        border:1px solid #000;
        white-space:nowrap;
        vertical-align:top;
    }
    .clone {
        position:absolute;
        top:0;
        left:0;
        pointer-events:none;
        border:1px solid #000;
    }
    .clone th, .clone td {
        visibility:hidden;


    }
    .clone td, .clone th {
        border-color:transparent
    }
    .clone tbody th {
        visibility:visible;
    }
    .clone .fixed-side {
        visibility:visible;
        background-color: #fff;
        background: repeat-x #F2F2F2;
        border: solid 1px #000;
    }
    .clone thead, .clone tfoot{background:transparent;}

</style>