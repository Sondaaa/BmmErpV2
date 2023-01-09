<div class="row">
    <div class="col-sm-6">
        <div class="widget-box">
            <div class="widget-header  widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-list-alt"></i>
                    SUIVI BON DE COMMANDE
                </h5>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form method="POST" action="<?php //echo url_for('Accueil/showSuivicommande') 
                                                ?>">
                        <table class="table table-bordred">
                            <tbody>
                                <tr>
                                    <td><b>BCI</b></td>
                                    <td>
                                        <select class="chosen-select form-control" name="id_bci" id="id_bci">
                                            <option></option>
                                            <?php foreach ($AllBCI as $bci) : ?>
                                                <option value="<?php echo $bci->getId() ?>" <?php if ($id_bci && $id_bci == $bci->getId()) : echo 'selected';
                                                                                            endif;
                                                                                            ?>>
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
<div class="row">
    <div class="col-xs-12">
        <div class="table-header" style="margin-bottom: 0px;">
            Suivi des bons commandes achat <?php // echo count($AllBCI) - <span>Resultat:</span>   
                                            ?>

            <a data-target="#my-modalimpression" role="button" onclick="setImprimeId()" data-toggle="modal" target="_blanc" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;margin-left: 4px">
                Impression Personnalisée
            </a>
            <button style="float: right; padding: 5px 12px;margin-left: 4px" target="_blanc" onclick="setExportExcelId()" class="btn btn-sm btn-default">
                <i class="ace-icon fa fa-file-excel-o"></i> Exporter PDF
            </button>
            <!--            <a target="_blank" class="btn btn-sm btn-default" role="button" style="float: right;
                           padding: 5px 12px;"  onclick="setExportExcelId()" >
                            <i class="ace-icon fa fa-file-excel-o"></i>
                            <span class="bigger-110 no-text-shadow">Exporter</span>
                        </a>-->
        </div>
        <div class="col-xs-12" style="border: 1px solid #307ECC; padding-top: 10px;" ng-controller="CtrlDashboardLabo">
            <div id="table-scroll" class="table-scroll" style="margin-bottom: 10px;" scrolly="scollingCommandeBCI()">
                <div class="table-wrap">
                    <table id="listCommandes" class="mws-datatable-fn mws-table main-table">
                        <thead>
                            <tr>
                                <th style="width: 15%;text-align: center;min-width: 50px" colspan="3" scope="col">
                                    Bon Commande Inetrne </th>
                                <th style="width: 10%;text-align: center">Direction</th>
                                <th style="width: 10%;text-align: center">Etat</th>
                                <th style="width: 15%;text-align: center" colspan="3">Bon Commande Externe</th>
                                <th style="width: 15%;text-align: center" colspan="4">Budget</th>
                                <th style="width: 10%;text-align: center" colspan="3">Facturation</th>
                                <th style="width: 10%;text-align: center" colspan="2">Financiers</th>
                                <th style="width: 15%;text-align: center" colspan="3">Réglemet Banque</th>
                            </tr>
                            <tr>
                                <th style="text-align: center;" rowspan="2">N° BCI</th>
                                <th style="text-align: center;" rowspan="2">N° D.Achat</th>
                                <th style="text-align: center;" rowspan="2">Date Création</th>
                                <th style="text-align: center" rowspan="2">Demandeur</th>
                                <th style="text-align: center" rowspan="2">Etat du document</th>
                                <th style="text-align: center" rowspan="2">BCE Provisoire</th>
                                <th style="text-align: center " colspan="2">BCE Définitif</th>

                                <th style="text-align: center" colspan="2">Engagement Budget</th>
                                <th style="text-align: center" colspan="2">Ordonnancement</th>
                                <th style="text-align: center" rowspan="2">N°FAC S</th>
                                <th style="text-align: center" rowspan="2">N°FAC FRS</th>
                                <th style="text-align: center" rowspan="2">Montant</th>
                                <th style="text-align: center" rowspan="2">Date paiement</th>
                                <th style="text-align: center" rowspan="2">Montant</th>
                                <th style="" rowspan="2">Banque</th>
                                <th style="" rowspan="2">Instrument de paiement </th>
                                <th style="" rowspan="2">Montant</th>
                            </tr>
                            <tr>
                                <th>N°BCE D</th>
                                <th>Montant</th>
                                <th>Date</th>
                                <th>Montant</th>
                                <th>Date</th>
                                <th>Montant</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php foreach ($documentachats as $documentachat) : ?>
                                <tr class="ligne_compte">

                                    <td style="text-align: center;">
                                        <b>
                                            <a target="_blank" href="<?php echo url_for("documentachat/Imprimerdocachat?iddoc=" . $documentachat->getId()); ?>">
                                                <?php
                                                echo 'BCI N° ' . sprintf('%05d', $documentachat->getNumero());

                                                //$documentachat->getNumerodocachat();
                                                ?>
                                            </a>
                                        </b>
                                    </td>
                                    <td style="text-align: center;">
                                        <b>
                                            <?php $doc_parent = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($documentachat->getId(), 6); ?>
                                            <?php $docregreoupp = DocachatregTable::getInstance()->findByIdBci($documentachat->getId());
                                            // echo sizeof($doc_parent) . sizeof($docregreoupp) . $documentachat->getId();
                                            if (sizeof($doc_parent) > 0) : ?>
                                                <a target="_blank" href="<?php echo url_for("documentachat/Imprimerdocachat?iddoc=" .
                                                                                $doc_parent->getFirst()->getId()); ?>">
                                                    <?php
                                                    echo $doc_parent->getFirst()->getNumerodocachat();
                                                    ?>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (sizeof($docregreoupp) > 0) :
                                                $doc_reg = DocumentachatTable::getInstance()->find($docregreoupp->getFirst()->getIdDocreg()); ?>
                                                <?php if ($doc_reg) { ?>

                                                    <a target="_blank" href="<?php echo url_for("documentachat/Imprimerdocachat?iddoc=" . $doc_reg->getId()); ?>">
                                                        <?php
                                                        echo $doc_reg->getNumerodocachat();
                                                        ?>
                                                    </a><?php } ?>
                                            <?php endif; ?>
                                        </b>
                                    </td>
                                    <td style="text-align: center"><?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?>
                                    </td>
                                    <td><?php
                                        if (($documentachat->getIdDemandeur() != '' && $documentachat->getIdDemandeur() != null))
                                            echo $documentachat->getDemandeur();
                                        ?>
                                    </td>
                                    <td>
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
                                        //                                        echo $documentachat->getEtatdocument()->getEtatdocachat();
                                        ?>
                                    </td>
                                    <td style="text-align: center">
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
                                    <td style="text-align: center" colspan="2">
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
                                    <td style="text-align: center" colspan="2">
                                        <?php
                                        foreach ($document_achat_externe_Provisoire as $prevesoire) :
                                            $piece_budget_porvisoire = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($prevesoire->getId());
                                            if ($piece_budget_porvisoire && $piece_budget_porvisoire->getDocumentbudget()) {
                                        ?>
                                            <?php
                                                echo '<p>' . date('d/m/Y', strtotime($piece_budget_porvisoire->getDocumentbudget()->getDatecreation()));
                                                if ($piece_budget_porvisoire->getDocumentbudget()->getMnt())
                                                    echo ' - ' . $piece_budget_porvisoire->getDocumentbudget()->getMnt() . '';
                                                echo '</p>';
                                            }
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
                                                        echo '<p>' . date('d/m/Y', strtotime($piece_budget->getDocumentbudget()->getDatecreation()));
                                                        if ($piece_budget->getDocumentbudget()->getMnt()) {
                                                            echo ' - ' . $piece_budget->getDocumentbudget()->getMnt();
                                                        }
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
        </div>
    </div>
</div>
<div id="my-modalimpression" class="modal fade" tabindex="-1" style="width: 1200px;display: none">
    <?php // include_partial('Accueil/form_impression', array()); 
    ?>
</div>
<script type="text/javascript">
    // requires jquery library
    jQuery(document).ready(function() {

        jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
    });

    function setImprimeId() {
        //        $('#id_imprime').val(id);
    }

    function setExportExcelId() {
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
        //        url = url + '&start_date=' + $('#start').val() + '&end_date=' + $('#end').val() + '&id_bci=' + $('#id_bci').val();
        url = '<?php echo url_for('Accueil/exportersuivibce') ?>' + url;
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

    .table-scroll thead {
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