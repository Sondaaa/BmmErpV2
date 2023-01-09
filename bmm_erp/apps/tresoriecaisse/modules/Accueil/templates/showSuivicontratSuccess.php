
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
                    <form method="POST" action="<?php echo url_for('Accueil/showSuivicontrat') ?>">
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
<div class="row">
    <div class="col-sm-6">
        <div class="widget-box">
            <div class="widget-header  widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-list-alt"></i>
                    SUIVI BON DEPENSE AU COMPTANT
                </h5>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form method="POST" action="<?php echo url_for('Accueil/showSuivibdc') ?>">
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
$contratachats = ContratachatTable::getInstance()->findAll();
?>
<div class="row">
    <div class="col-xs-12">
        <div class="table-header" style="margin-bottom: 0px;">
            Suivi des Contrats

            <a target="_blank" class="btn btn-sm btn-success" style="float: right; " href="<?php echo url_for("Accueil/Imprimerlistcontrat") ?>">
               <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Exporter PDF </span>
            </a>
            <a target="_blank" class="btn btn-sm btn-default" style="float: right; padding: 5px 12px; margin-right: 3px" href="<?php echo url_for("Accueil/exportersuivicontrat") ?>">
                <i class="ace-icon fa fa-file-excel-o"></i> 
                <span class="bigger-110 no-text-shadow">Exporter Excel</span>
            </a>
        </div>

        <div class="table-wrap">
            <?php
            foreach ($contratachats as $contrat):
                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                $query = "SELECT    contratachat.id"
                        . " FROM    contratachat ,documentachat"
                        . " WHERE documentachat.id_contrat =" . $contrat->getId() . ""
                        . " order by id desc";

                $fichecontrat = $conn->fetchAssoc($query);
                if (sizeof($fichecontrat) >= 1):
                    ?>
                    <table  class="tab-content">
                        <thead>
                            <tr > <th style="widows: 100%;text-align: center;font-size: 14px" colspan="14"  >
                        <h4><b><i>Contrat <?php echo $contrat->getReference().'  N° '. $contrat->getNumero() ; ?></i></b></h4></th>
                        </tr>
                        <tr>
                            <th  style="widows: 25%;text-align: center;max-width: 25%" class="fixed-side" scope="col"  colspan="3" rowspan="3" >Articles</th> 
                            <th style="widows: 20%;text-align: center;max-width: 20%" colspan="2" >Bon Commande Interne</th>
                            <th style="widows: 20%;text-align: center;max-width: 20%" colspan="3" >Bon Commande Externe</th>
                            <th style="widows: 15%;text-align: center;max-width: 15%" colspan="4" rowspan="3">Montant Contrat</th>
                            <th style="widows: 20%;text-align: center;max-width: 20%" colspan="3" rowspan="3">Observation | Projet</th>
                        </tr>
                        <tr>
                            <th style="widows: 10%;text-align: center;max-width: 10%"  scope="col"rowspan="2">N° BCI</th>
                            <th style="widows: 10%;text-align: center;max-width: 10%"  scope="col" rowspan="2">Date Création</th>
                            <th style="widows: 10%;min-width: 110px;text-align: center"rowspan="2">BCE Provisoire</th>
                            <th style="widows: 10%;min-width: 110px;text-align: center "colspan="2">BCE Définitif</th>
                        </tr>
                        <tr>
                            <th>N°BCE D</th><th>Montant</th>
                        </tr>

                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            $montant_contrat = $contrat->getMontantcontrat();
                            $documentachats = DocumentachatTable::getInstance()->findAll();
                            foreach ($documentachats as $docachat) {
                                $doc_achat = $docachat->getContratachat();

                                if (count($doc_achat) >= 1) {
                                    $rowspan = count($doc_achat);
                                    if ($docachat->getIdContrat() == $contrat->getId()) {
                                        ?>
                                        <tr>
                                            <td style="text-align: left;max-width: 20%" colspan="3">
                                                <?php foreach ($docachat->getLignedocachat() as $ligne): ?>
                                                    <?php echo trim($ligne->getDesignationarticle()) . '**'; ?>
                                                <br>
                                                <?php endforeach; ?>
                                            </td>
                                            <td>
                                                <?php
                                                // echo trim($docachat->getNumerodocachat());
                                                include_partial('tddetaildoc', array('boncomm' => $docachat));
                                                ?>

                                            </td>
                                            <td style="text-align: center">

                                                <?php echo date('d/m/Y', strtotime($docachat->getDatecreation())); ?>

                                            </td>
                                            <td style="text-align: center">
                                                <?php $document_achat_externe_Provisoire = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($docachat->getId(), 18); ?>
                                                <?php
                                                if (sizeof($document_achat_externe_Provisoire) >= 1)
//                                                    echo $document_achat_externe_Provisoire->getFirst()->getNumerodocachat();
                                                          include_partial('tddetaildoc', array('boncomm' => $document_achat_externe_Provisoire->getFirst()));
                                                ?>
                                                <?php ?> 
                                            </td>
                                            <td style="text-align: center">
                                                <?php
                                                $document_achat_externe_difinitif = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($docachat->getId(), 7);
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
                                            <?php // if (count($doc_achat) >= 1)rowspan="<?php echo $rowspan;   ?>
                                            <td style="text-align: right" colspan="4" >
                                                <?php echo number_format($docachat->getContratachat()->getMontantcontrat(), 3, ".", " "); ?>
                                            </td>

                                            <td colspan="3">
                                                <?php foreach ($docachat->getLignedocachat() as $ligne): ?>
                                                    <?php echo trim($ligne->getObservation()) . ' | ' . trim($ligne->getProjet()); ?>
                                                <?php endforeach; ?>
                                            </td>


                                        </tr>
                                       
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr style="background-color: #fff; background: repeat-x #F2F2F2;font-size: 14px;text-align: center"><td colspan="7">Somme des Achats</td>
                                <td style="text-align: right">
                                    <?php
                                    echo number_format($total, 3, ".", " ");
                                    ;
                                    ?>
                                </td>
                                <td colspan="7"></td>
                            </tr>
                            <tr style="background-color: #fff; background: repeat-x #F2F2F2;font-size: 14px;text-align: center"><td colspan="7">Le Reste</td><td></td>
                                <td style="text-align: right">
                                    <?php
                                    $reste = $montant_contrat - $total;
                                    echo number_format($reste, 3, ".", " ");
                                    ;
                                    ?>
                                </td>  
                                <td colspan="6"></td></tr>
                        </tfoot>

                    </table></br>
            <table>  <tr></tr></table>
                <?php endif;
            endforeach; ?>
        </div>

    </div>
</div>
<div id="my-modalimpression" class="modal fade" tabindex="-1" style="width: 1200px;display: none"> 
    <?php include_partial('Accueil/form_impression', array()); ?>
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
