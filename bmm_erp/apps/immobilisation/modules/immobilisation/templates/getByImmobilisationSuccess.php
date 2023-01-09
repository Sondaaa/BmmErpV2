<?php

$conn = Doctrine_Manager::getInstance()->getCurrentConnection();

$query = " SELECT lignedocumenttransfert.id, documenttransfert.type, documenttransfert.datevalidation,"
    . "   documenttransfert.etat_transfert, concat( bureausource.code,bureausource.bureau)as bureausource ,"
    . "   concat( bureaudestinatione.code,bureaudestinatione.bureau)as bureaudestinatione , "
    . "   concat( organsimedestinatione.nenregusrement,organsimedestinatione.libelle)as organsimedestinatione ,"
     . " typeaffectationimmo.libelle as typeaffectationimmobilisaion"
    . "  FROM typeaffectationimmo, documenttransfert ,lignedocumenttransfert  "
    . " left Join bureaux as bureausource on lignedocumenttransfert.id_local1=bureausource.id "
    . "  left Join bureaux as bureaudestinatione on lignedocumenttransfert.id_local2=bureaudestinatione.id "
    . " left Join organisme as organsimedestinatione on lignedocumenttransfert.id_organisme=organsimedestinatione.id "
    . "   WHERE lignedocumenttransfert.id_immo =" . $id
    . " and typeaffectationimmo.id=documenttransfert.id_typetransfert "
    . " and documenttransfert.id= lignedocumenttransfert.id_documenttransfert"
    . " and documenttransfert.datevalidation is not null"
    . " and documenttransfert.etat_transfert ='1'";

//die($query);
$immobilisations = $conn->fetchAssoc($query);
?>
<?php $type = TypeaffectationimmoTable::getInstance()->find($id);?>
<div class="row">
    <div class="col-sm-12" style="margin-top: 20px;">
        <legend>
            Liste des Transferts / Immobilisation : <span style="color: #bd4242;"><?php echo $type; ?></span>
            <?php if (sizeof($immobilisations) > 0): ?>
                <!-- <a style="float: right; margin-top: -4px;"
                href="<?php //echo url_for('immobilisation/printListeType?id=' . $id) ?>"
                 target="_blank" class="btn btn-white btn-primary">
                 <i class="ace-icon fa fa-print"></i> Imprimer
                </a> -->
            <?php endif;?>
        </legend>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <table id="table_immobilisation" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width:4%;text-align:center;">#</th>
                    <th style="width:6%;text-align:center;"><b>Type</b></th>
                    <th style="width:15%;text-align:center;"><b>Date</b></th>
                    <th style="width:15%;text-align:center;"><b>Type Affectation</b></th>
                    <th style="width:20%;height:25px;text-align:center;"><b>Source</b></th>
                    <th style="width:20%;text-align:center;"><b>Destination</b></th>
                    <th style="width:20%;text-align:center;"><b>Organisme</b></th>
                    
                    
                </tr>
            </thead>
            <tbody id="tblData">
                <?php if (sizeof($immobilisations) > 0): ?>
                    <?php for ($i = 0; $i < sizeof($immobilisations); $i++): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $i + 1; ?></td>
                            <td style="text-align: center;"><?php echo $immobilisations[$i]['type'] ?></td>
                            <td style="text-align: center;">
                                <?php if ($immobilisations[$i]['datevalidation'] != null) {echo date('d/m/Y', strtotime($immobilisations[$i]['datevalidation']));}?>
                                </td>
                                
                                <td>
                                    <?php echo  $immobilisations[$i]['typeaffectationimmobilisaion']; ?>
                                </td>
                                <td>
                                    <?php echo $immobilisations[$i]['bureausource'] ?>
                                </td>
                                <td><?php echo $immobilisations[$i]['bureaudestinatione'] ?></td>
                                <td><?php echo $immobilisations[$i]['organsimedestinatione'] ?></td>
                                
                              
                                



                        </tr>
                    <?php endfor;?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; vertical-align: middle; height: 60px;">Pas de Transfet à valider !</td>
                    </tr>
                <?php endif;?>
            </tbody>
        </table>
        <hr>
    </div>
    <?php if (sizeof($immobilisations) > 0): ?>
        <!-- <div class="col-sm-12" style="text-align: right;">
            <a href="<?php //echo url_for('immobilisation/printListeType?id=' . $id) ?>" target="_blank" class="btn btn-white btn-primary"><i class="ace-icon fa fa-print"></i> Imprimer</a>
        </div> -->
    <?php endif;?>
</div>