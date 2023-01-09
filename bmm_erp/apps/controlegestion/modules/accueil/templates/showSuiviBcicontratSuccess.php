<?php
$contratachats = ContratachatTable::getInstance()->findAll();
?>
<div class="row">
    <div class="col-sm-6">
        <div class="widget-box">
            <div class="widget-header  widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-list-alt"></i>
                    SUIVI DES BCIS DES CONTRATS
                </h5>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form method="POST" action="<?php echo url_for('accueil/showSuiviBcicontrat') ?>">
                        <table class="table table-bordred">
                            <tbody>
                                <tr>
                                    <td><b>BCI</b></td>
                                    <td>
                                        <select class="chosen-select form-control" name="id_bci" id="id_bci">
                                            <option></option>
                                            <?php foreach ($AllBCI as $bci) : ?>
                                                <option value="<?php echo $bci->getId() ?>" <?php
                                                                                            if ($id_bci && $id_bci == $bci->getId()) : echo 'selected';
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
            Suivi des BCIS des Contrats

            <button target="_blank" class="btn btn-sm btn-success" style="float: right; " onclick="printListDocAchats()">
                <!--href="<?php // echo url_for("accueil/Imprimerlistcontrat")  
                            ?>">-->
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Exporter PDF </span>
            </button>
            <button style="float: right; padding: 5px 12px;margin-left: 4px" target="_blanc" onclick="setExportExcelBciContratId()" class="btn btn-sm btn-default">
                <i class="ace-icon fa fa-file-excel-o"></i> Exporter PDF
            </button>
            <!--            <a target="_blank" class="btn btn-sm btn-default" style="float: right; padding: 5px 12px; margin-right: 3px" href="<?php // echo url_for("accueil/exportersuivicontrat") 
                                                                                                                                                ?>">
                <i class="ace-icon fa fa-file-excel-o"></i> 
                <span class="bigger-110 no-text-shadow">Exporter Excel</span>
            </a>-->
        </div>

        <div class="col-xs-12" style="border: 1px solid #307ECC; padding-top: 10px;" ng-controller="CtrlDashboard">
            <div id="table-scroll" class="table-scroll" style="margin-bottom: 10px;" scrolly="scollingCommandeBCIContrat()">
                <div class="table-wrap">
                    <?php
                    if (sizeof($contratachats) >= 1) :
                        foreach ($contratachats as $contrat) :
                            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                            $query = "SELECT    contratachat.id"
                                . " FROM    contratachat ,documentachat"
                                . " WHERE documentachat.id_contrat =" . $contrat->getId() . ""
                                . " and documentachat.datecreation >= '"  . $start_date . "'"
                                . " and  documentachat.datecreation <= '" . $end_date . "'"
                                . " and documentachat.id_typedoc=6"
                                . " order by id desc";

                            $fichecontrat = $conn->fetchAssoc($query);
                            if (sizeof($fichecontrat) >= 1) :
                    ?>
                                <table id="listCommandesBCIcontrat" class="mws-datatable-fn mws-table main-table">
                                    <thead>
                                        <tr>
                                            <th style="widows: 100%;text-align: center;font-size: 14px" colspan="14">
                                                <h4><b><i>Contrat <?php echo $contrat->getReference() . '  N° ' . $contrat->getNumero(); ?></i></b></h4>
                                            </th>
                                        </tr>
                                        <tr style="background: #D3D3D3">
                                            <th style="widows: 25%;text-align: center;max-width: 25%" class="fixed-side" scope="col" colspan="3" rowspan="3">Articles</th>
                                            <th style="widows: 20%;text-align: center;max-width: 20%" colspan="2">Bon Commande Interne</th>
                                            <th style="widows: 20%;text-align: center;max-width: 20%" colspan="2">Facture</th>

                                            <th style="widows: 15%;text-align: center;max-width: 15%" colspan="4" rowspan="1">Contrat</th>
                                            <th style="widows: 20%;text-align: center;max-width: 20%" colspan="3" rowspan="3">Observation | Projet</th>
                                        </tr>
                                        <tr style="background: #D3D3D3">
                                            <th style="widows: 10%;text-align: center;max-width: 10%" scope="col" rowspan="2">N° BCI</th>
                                            <th style="widows: 10%;text-align: center;max-width: 10%" scope="col" rowspan="2">Date Création</th>

                                            <th>N°Facture Sys</th>
                                            <th>Montant</th>
                                            <th style="widows: 15%;text-align: center;max-width: 15%" colspan="4" rowspan="2">Montant Contrat</th>
                                        </tr>


                                    </thead>
                                    <tbody>
                                        <?php
                                        $total = 0;
                                        $montant_contrat = $contrat->getMontantcontrat();
                                        //                            $documentachats = DocumentachatTable::getInstance()->findAll();
                                        if (sizeof($documentachats) >= 1) {
                                            foreach ($documentachats as $docachat) {
                                                $doc_achat = $docachat->getContratachat();

                                                if (count($doc_achat) >= 1) {
                                                    $rowspan = count($doc_achat);
                                                    if ($docachat->getIdContrat() == $contrat->getId()) {
                                        ?>
                                                        <tr>
                                                            <td style="text-align: left;max-width: 20%" colspan="3">
                                                                <?php foreach ($docachat->getLignedocachat() as $ligne) : ?>
                                                                    <?php echo trim($ligne->getDesignationarticle()) . '**'; ?>
                                                                    <br>
                                                                <?php endforeach; ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                echo trim($docachat->getNumerodocachat());
                                                                //                                                include_partial('tddetaildoc', array('boncomm' => $docachat));
                                                                ?>

                                                            </td>
                                                            <td style="text-align: center">

                                                                <?php echo date('d/m/Y', strtotime($docachat->getDatecreation())) . ' ' . $docachat->getId(); ?>

                                                            </td>
                                                            <!--<td style="text-align: center">-->
                                                            <?php // $document_achat_externe_Provisoire = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($docachat->getId(), 18); 
                                                            ?>
                                                            <?php
                                                            //                                                die(sizeof($document_achat_externe_Provisoire) . 'mp');
                                                            //                                                if (sizeof($document_achat_externe_Provisoire) >= 1)
                                                            ////                                                    echo $document_achat_externe_Provisoire->getFirst()->getNumerodocachat();
                                                            //                                                    include_partial('tddetaildoc', array('boncomm' => $document_achat_externe_Provisoire->getFirst()));
                                                            ?>
                                                            <?php ?>
                                                            <!--</td>-->
                                                            <td style="text-align: center">
                                                                <?php
                                                                $document_achat_externe_difinitif = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($docachat->getId(), 15);
                                                                if (sizeof($document_achat_externe_difinitif) >= 1) {
                                                                    //                                                echo $document_achat_externe_difinitif->getFirst()->getNumerodocachat();
                                                                    include_partial('tddetaildoc', array('boncomm' => $document_achat_externe_difinitif->getFirst()));
                                                                    $total = $total + $document_achat_externe_difinitif->getFirst()->getMntttc();
                                                                } else
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
                                                            <?php // if (count($doc_achat) >= 1)rowspan="<?php echo $rowspan;   
                                                            ?>
                                                            <td style="text-align: right" colspan="4">
                                                                <?php echo number_format($docachat->getContratachat()->getMontantcontrat(), 3, ".", " "); ?>
                                                            </td>

                                                            <td colspan="3">
                                                                <?php foreach ($docachat->getLignedocachat() as $ligne) : ?>
                                                                    <?php echo trim($ligne->getObservation()) . ' | ' . trim($ligne->getProjet()); ?>
                                                                <?php endforeach; ?>
                                                            </td>


                                                        </tr>

                                            <?php
                                                    }
                                                }
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td style="text-align: center;max-width: 20%" colspan="14">
                                                    Liste des BCIS des Contrats est vide
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr style="background-color: #fff; background: repeat-x #F2F2F2;font-size: 14px;text-align: center">
                                            <td colspan="6">Somme des Achats</td>
                                            <td style="text-align: right">
                                                <?php
                                                echo number_format($total, 3, ".", " ");;
                                                ?>
                                            </td>
                                            <td colspan="6"></td>
                                        </tr>
                                        <tr style="background-color: #fff; background: repeat-x #F2F2F2;font-size: 14px;text-align: center">
                                            <td colspan="6">Le Reste</td>
                                            <td></td>
                                            <td style="text-align: right">
                                                <?php
                                                $reste = $montant_contrat - $total;
                                                echo number_format($reste, 3, ".", " ");;
                                                ?>
                                            </td>
                                            <td colspan="6"></td>
                                        </tr>
                                    </tfoot>

                                </table></br>
                                <table>
                                    <tr></tr>
                                </table>
                            
                        <?php
                            endif;
                        endforeach;

                    else : ?><table>
                            <tr>
                                <td style="text-align: center;max-width: 20%" colspan="14">
                                    Liste des Contrats est vide
                                </td>
                            </tr>
                        </table>

                    <?php
                    endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>
<div id="my-modalimpression" class="modal fade" tabindex="-1" style="width: 1200px;display: none">
    <?php include_partial('accueil/form_impression', array()); ?>
</div>
<script type="text/javascript">
    // requires jquery library
    jQuery(document).ready(function() {
        console.log('add clone');
        jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
    });

    function setImprimeId() {
        //        $('#id_imprime').val(id);
    }

    function printListDocAchats() {
        var url = '';
        if ($('#id_bci').val() != '') {
            url = '?id_bci=' + $('#id_bci').val();
        }

        if ($('#start').val() != '') {
            if (url == '')
                url = '?start=' + $('#start').val();
            else
                url = url + '&start=' + $('#start').val();
        }

        if ($('#end').val() != '') {
            if (url == '')
                url = '?end=' + $('#end').val();
            else
                url = url + '&end=' + $('#end').val();
        }
        url = '<?php echo url_for('accueil/Imprimerlistcontrat') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }

    function setExportExcelBciContratId() {
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
        url = '<?php echo url_for('accueil/exportersuivicontrat') ?>' + url;
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
        overflow: hidden;
        width: 100%;
        border: 1px solid #fff;
    }

    .table-wrap {
        width: 100%;
        border: 1px solid #000;
        overflow: auto;
    }

    .table-scroll table {
        width: 100%;
        margin: auto;
        border: 1px solid #000;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-scroll th,
    .table-scroll td {
        padding: 5px 10px;
        border: 1px solid #000;
        white-space: nowrap;
        vertical-align: top;
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
</style>