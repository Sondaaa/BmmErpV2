<div class="row">
    <div class="col-sm-6">
        <div class="widget-box">
            <div class="widget-header  widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-list-alt"></i>
                    SUIVI DES CONTRATS
                </h5>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form method="POST" action="<?php echo url_for('Accueil/showSuivicontrattotal') ?>">
                        <table class="table table-bordred">
                            <tbody>
                                <tr>
                                    <td><b>BCI</b></td>
                                    <td>
                                        <select class="chosen-select form-control" name="id_bci" id="id_bci">
                                            <option></option>
                                            <?php foreach ($AllBCI as $bci): ?>
                                                <option value="<?php echo $bci->getId() ?>" <?php
                                                if ($id_bci && $id_bci == $bci->getId()): echo 'selected';
                                                endif;
                                                ?> >
                                                            <?php echo $bci->getNumerodocachat() ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label><b>Date début</b></label>
                                        <input type="date" id="start" name="start" value="<?php echo $start_date ?>" class="form-control">
                                    </td>
                                    <td>
                                        <label><b>Date fin</b></label>
                                        <input type="date" id="end" name="end" value="<?php echo $end_date ?>" class="form-control">
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <button class="btn btn-sm btn-success" style="text-align: right;">
                                            <i class="fa fa-search"></i> Valider
                                        </button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>
<?php
//$documentachats = DocumentachatTable::getInstance()->getByTypedocContrat(19);
$contratsachat = ContratachatTable::getInstance()->findbyIdTypedoc(19);
$contratsachats = ContratachatTable::getInstance()->findAll();
?>
<div class="row">
    <div class="col-xs-12">
        <div class="table-header" style="margin-bottom: 0px;">
            SUIVI DES CONTRATS
            <a data-target="#my-modalimpressioncontrattotal" role="button" onclick="setImprimeId()" data-toggle="modal" target="_blanc"
               class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;margin-left: 4px" >
                Impression Personnalisée
            </a>
            <button style="float: right; padding: 5px 12px;margin-left: 4px"
                    target="_blanc" 
                    onclick="setExportExcelContratId()"

                    class="btn btn-sm btn-default">
                <i class="ace-icon fa fa-file-excel-o"></i>   Exporter PDF
            </button>
<!--            <a target="_blank" class="btn btn-sm btn-default" style="float: right; padding: 5px 12px;" href="<?php // echo url_for("Accueil/exportersuivicontrattotal") ?>">
                <i class="ace-icon fa fa-file-excel-o"></i> 
                <span class="bigger-110 no-text-shadow">Exporter</span>
            </a>-->
        </div>
        <div class="col-xs-12" style="border: 1px solid #307ECC; padding-top: 10px;" ng-controller="CtrlDashboard">
            <div id="table-scroll" class="table-scroll" style="margin-bottom: 10px;" 
                 ><!--scrolly="scollingCommandeContrat()"-->
                <div class="table-wrap">
                    <table id="listCommandescontrat" class="mws-datatable-fn mws-table main-table">
                        <thead>
                            <tr style="font-size: 14px" >
                                <th style="widows: 10%;text-align: center;" class="fixed-side" scope="col" colspan="2">Bon Commande Inetrne </th>
                                <th style="widows: 10%;text-align: center">Direction</th>
                                <th style="widows: 15%;text-align: center">Etat</th>
                                <th style="widows: 10%;text-align: center" colspan="4" >Contrat</th>
                                <th style="widows: 20%;text-align: center" colspan="4">Budget</th>
                                <th style="widows: 10%;text-align: center" colspan="2">Facturation</th>
                                <th style="widows: 20%;text-align: center" colspan="2">Financiers</th>
                                <th style="widows: 20%;text-align: center" colspan="3" >Réglemet</th>
                            </tr>
                            <tr style="font-size: 14px" >
                                <th style="widows: 20%;text-align: center;min-width: 110px" class="fixed-side" scope="col"rowspan="2">N° BCI</th>
                                <th style="widows: 10%;text-align: center;min-width: 110px" class="fixed-side" scope="col" rowspan="2">Date Création</th>
                                <th style="widows: 10%;min-width: 110px;text-align: center" rowspan="2"> Demandeur</th>
                                <th style="widows: 15%;min-width: 110px;text-align: center" rowspan="2">Etat du document</th>
                                <th style="widows: 10%;min-width: 110px;text-align: center"rowspan="2">Contrat Provisoire</th>
                                <th style="widows: 10%;min-width: 110px;text-align: center "colspan="2">Contrat Définitif</th>
                                <th style="widows: 10%;min-width: 110px;text-align: center "rowspan="2">Type Contrat</th>
                                <th style="widows: 20%;min-width: 110px;text-align: center" colspan="2">Engagement Budget</th>
                                <th style="widows: 20%;min-width: 110px;text-align: center" colspan="2">Ordonnancement</th>

                                <th style="widows: 10%;min-width: 110px;text-align: center" rowspan="2">N°FAC FRS</th>
                                <th style="widows: 10%;min-width: 110px;text-align: center" rowspan="2">Montant</th>
                                <th style="widows: 20%;min-width: 110px;text-align: center" rowspan="2">Date paiement</th>
                                <th style="widows: 10%;min-width: 110px;text-align: center" rowspan="2">Montant</th>
                                <th style="widows: 20%;min-width: 110px;text-align: center" colspan="3">Banque</th>
                            </tr>
                            <tr style="font-size: 14px" >
                                <th>N°Contrat D</th><th>Montant</th>
                                <th>Date</th><th>Montant</th><th>Date</th><th>Montant</th>
                                <th style="widows: 20%;min-width: 110px;">Banque</th><th style="widows: 20%;min-width: 110px;">Instrument de paiement </th><th style="widows: 20%;min-width: 110px;">Montant</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                             if (sizeof($documentachats) >= 1):
                            foreach ($documentachats as $document_achat):
                                $id_doc_parent = $document_achat->getId();
                                $contratachatpro = ContratachatTable::getInstance()->findByIdDocAndIdTypedoc($id_doc_parent, 19);
                               
                                    $doc_parent = DocumentachatTable::getInstance()->find($id_doc_parent);
                                    $docupmenta_acha_contrat_def = DocumentachatTable::getInstance()->getByTypedocContratDef(20, $document_achat->getId());

//                                    if (sizeof($docupmenta_acha_contrat_def) >= 1) {
//                                        $id_docparent_parent = $docupmenta_acha_contrat_def->getFirst()->getId();
//                                        $facuture_comptabe = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($id_docparent_parent, 15);
//                                        if (sizeof($facuture_comptabe) >= 1) {
//                                            $row_spna = sizeof($facuture_comptabe);
//                                        }
//                                    }
//                                    if (sizeof($document_achat) >= 1)
//                                        $piece_budget_porvisoire = Doctrine_Core::getTable('piecejointbudget')->findByIdDocachat($document_achat->getId());
//                                    if (sizeof($docupmenta_acha_contrat_def) >= 1)
//                                        $piece_budget_defi = Doctrine_Core::getTable('piecejointbudget')->findByIdDocachat($docupmenta_acha_contrat_def->getFirst()->getId());
//                             
//                                   die($piece_budget_porvisoire->getFirst()->getDocumentbudget() . 'm');
                                    if (sizeof($document_achat) >= 1):
                                        ?>
                                        <tr class="ligne_compte" style="font-size: 12px" >

                                            <td style="text-align: center;min-width: 150px;"  >
                                                <b>
                                                    <a target="_blank" href="<?php echo url_for("documentachat/imprimerboncomande?iddoc=" . $doc_parent->getId()); ?>">
                                                        <?php
                                                        echo $document_achat->getNumerodocachat() . $document_achat->getId();

//                                                    echo $document_achat->getId() . '   ' . sizeof($facuture_comptabe);
//                                                    include_partial('tddetaildoc', array('boncomm' => $doc_parent));
                                                        ?>
                                                    </a>

                                                </b>
                                            </td>
                                            <td style="text-align: center" ><?php echo date('d/m/Y', strtotime($doc_parent->getDatecreation())); ?></td>   
                                            <td ><?php
                                                if (($doc_parent->getIdDemandeur() != '' && $doc_parent->getIdDemandeur() != null))
                                                    echo $doc_parent->getDemandeur();
                                                ?>
                                            </td>
                                            <td
                                                >
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
                                            <td style="text-align: center" >
                                                <?php
                                                if (sizeof($document_achat) >= 1) {
                                                    if ($document_achat->getContratachat()->getType() == 0)
                                                        echo 'Contrat Total';
                                                    else
                                                        echo 'Contrat Partiel';
                                                }
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
                                                    if (sizeof($piecejoint) >= 1){
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
                                                        }}
                                                    }
                                                }


//                                                
                                                ?>
                                            </td>
                                            <td style="text-align: right" >
                                                <?php
                                                if (sizeof($docupmenta_acha_contrat_def) >= 1) {

                                                    $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($docupmenta_acha_contrat_def->getFirst()->getId());
                                                    if (sizeof($piecejoint) >= 1){
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
                                                        }}
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
                                                    if (sizeof($piecejoint) >= 1){
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
                                                        }}
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td style="text-align: center" >
                                                <?php
                                                if (sizeof($docupmenta_acha_contrat_def) >= 1) {
                                                    $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($docupmenta_acha_contrat_def->getFirst()->getId());
                                                    if (sizeof($piecejoint) >= 1){
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
                                                    }}
                                                }
                                                ?>
                                            </td>

                                            <td style="text-align: center" >
                                                <?php
                                                if (sizeof($docupmenta_acha_contrat_def) >= 1) {
                                                    $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($docupmenta_acha_contrat_def->getFirst()->getId());
                                                    if (sizeof($piecejoint) >= 1){
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
                                                    }}
                                                }
                                                ?>
                                            </td>
                                            <!--banque -->
                                            <td style="text-align: center">
                                                <?php
                                                if (sizeof($docupmenta_acha_contrat_def) >= 1) {
                                                    $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($docupmenta_acha_contrat_def->getFirst()->getId());
                                                    if (sizeof($piecejoint) >= 1) {
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
                                                }
                                                ?>

                                            </td>
                                            <td style="text-align: center">
                                                <?php
                                                if (sizeof($docupmenta_acha_contrat_def) >= 1) {
                                                    $piecejoint = PiecejointbudgetTable::getInstance()->findbyIdDocachat($docupmenta_acha_contrat_def->getFirst()->getId());
                                                    if (sizeof($piecejoint) >= 1){
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
                                                        }}
                                                    }
                                                }
                                                ?>
                                            </td>



                                        </tr>
                                        <?php
                                    endif;
                               
                            endforeach; endif;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="my-modalimpressioncontrattotal" class="modal fade" tabindex="-1" style="width: 1200px;display: none"> 
    <?php include_partial('Accueil/form_impression_contrattotal', array()); ?>
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
    
      function setExportExcelContratId() {
        var url = '';
        if ($('input[name=start]').val() != '') {
            if (url == '')
                url = '?start=' + $('#start').val();
            else
                url = url + '&start=' + $('#start').val();
        }
        if ($('input[name=end]').val() != '') {
            if (url == '')
                url = '?end=' + $('#end').val();
            else
                url = url + '&end=' + $('#end').val();
        }
        
        if ($('input[name=id_bci]').val() != '') {
            if (url == '')
                url = '?id_bci=' + $('#id_bci').val();
            else
                url = url + '&id_bci=' + $('#id_bci').val();
        }
        url = '<?php echo url_for('Accueil/exportersuivicontrattotal') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
</script>
<style type="text/css">
    .header_table th {
        font-weight: bold;
        font-size: 13px;
    }

    .tab_filter tbody td {
        border-right-color: #ffffff !important;
        border-right-style: solid;
        border-right-width: 2px;
        padding: 5px;
    }

    tr:hover {
        color: #2679b5;
    }
</style>

<style>
    .table-scroll {
        position: relative;
        max-width: 100%;
        margin: auto;
        border: 1px solid #fff;
        overflow-y: scroll;
        overflow-x: scroll;
        height: 400px;
        width: 100%;
        display: block;
    }

    .table-scroll thead{
        border: solid 1px black;
        position: sticky;
        top: 0;

    }


    .table-wrap {
        width: 100%;
        border: 1px solid #000;
        /* overflow: auto; */
    }

    .table-scroll table {
        width: 100%;
        margin: auto;
        border: 1px solid #000;

    }



    .table-scroll th,
    .table-scroll td {
        padding: 10px 20px;
        border: 1px solid #000;
        white-space: nowrap;
        vertical-align: top;
    }

    .table-scroll td {
        padding: 30px 20px;
    }

    .clone {
        position: absolute;
        top: 0;
        left: 0;
        pointer-events: none;
        border: 1px solid #000;
    }

    .clone th,
    .clone td {
        visibility: hidden;


    }

    .clone td,
    .clone th {
        border-color: transparent
    }

    .clone tbody th {
        visibility: visible;
    }

    .clone .fixed-side {
        visibility: visible;
        background-color: #fff;
        background: repeat-x #F2F2F2;
        border: solid 1px #000;
    }

    .clone thead,
    .clone tfoot {
        background: transparent;
    }

    .table-bordered,
    th {
        border-radius: 0 !important;
        background-color: #dbdde1;
        color: black;
    }
</style>
