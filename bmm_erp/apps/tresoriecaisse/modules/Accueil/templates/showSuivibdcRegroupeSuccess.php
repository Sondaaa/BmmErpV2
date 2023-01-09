<div class="row">
    <div class="col-sm-6">
        <div class="widget-box">
            <div class="widget-header  widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-list-alt"></i>
                    SUIVI BON DEPENSE AU COMPTANT REGROUPE
                </h5>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form method="POST" action="<?php echo url_for('Accueil/showSuivibdcRegroupe') ?>">
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
                                        <input type="date" name="start" id="start"  value="<?php echo $start_date ?>" class="form-control">
                                    </td>
                                    <td>
                                        <label><b>Date fin</b></label>
                                        <input type="date" name="end" id="end"  value="<?php echo $end_date ?>" class="form-control">
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
            SUIVI BON DEPENSE AU COMPTANT REGROUPE
            <a data-target="#my-modalimpression_bdcreg" role="button" onclick="setImprimeId()" data-toggle="modal" target="_blanc"
               class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;margin-left: 4px" >
                Impression Personnalisée
            </a>
            
            <button style="float: right; padding: 5px 12px;margin-left: 4px"
                    target="_blanc" 
                    onclick="setExportExcelBDCRegId()"

                    class="btn btn-sm btn-default">
                <i class="ace-icon fa fa-file-excel-o"></i>   Exporter PDF
            </button>
<!--            <a target="_blank" class="btn btn-sm btn-default" style="float: right; padding: 5px 12px;" href="<?php // echo url_for("Accueil/exportersuivibdcRegroupe") ?>">
                <i class="ace-icon fa fa-file-excel-o"></i> 
                <span class="bigger-110 no-text-shadow">Exporter</span>
            </a>-->
        </div>
        <div class="col-xs-12" style="border: 1px solid #307ECC; padding-top: 10px;" ng-controller="CtrlDashboard">
            <div id="table-scroll" class="table-scroll" style="margin-bottom: 10px;" scrolly="scollingCommandeBDCReg()">
                <div class="table-wrap">
                    <table id="listCommandesBDCReg" class="mws-datatable-fn mws-table main-table">
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
                                <th style="widows: 20%;min-width: 110px;text-align: center"colspan="2">Engagement Déf. Budget</th>
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
                                $bon_deponse_Provisoire = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($documentachat->getId(), 21);
                                if (sizeof($bon_deponse_Provisoire) >= 1):

                                    ?>
                                    <tr class="ligne_compte" >
                                        <td style="text-align: center;min-width: 150px;cursor: pointer"class="fixed-side" scope="col"><b>
                                                <!--<a target="_blank" href="<?php // echo url_for("documentachat/imprimerboncomande?iddoc=" . $documentachat->getId());                  ?>">-->
                                                <?php
                                                include_partial('tddetaildoc', array('boncomm' => $documentachat))
                                                ?>
                                            </b></td>
                                        <td style="text-align: center" class="fixed-side" scope="col"><?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?></td>   
                                        <td><?php
                                            if (($documentachat->getIdDemandeur() != '' && $documentachat->getIdDemandeur() != null))
                                                echo $documentachat->getDemandeur();
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
                                            $document_achat_externe_Provisoire = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($documentachat->getId(), 21);

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
                                            $document_achat_externe_difinitif = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($documentachat->getId(), 2);
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

                                        <td colspan="2">
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
<div id="my-modalimpression_bdcreg" class="modal fade" tabindex="-1" style="width: 1200px;display: none"> 
<?php include_partial('Accueil/form_impression_bdcreg', array()); ?>
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
      function setExportExcelBDCRegId() {
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
        url = '<?php echo url_for('Accueil/exportersuivibdcRegroupe') ?>' + url;
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