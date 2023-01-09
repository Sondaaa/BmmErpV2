<?php
$or = new Ordredeservice();
$or = $ordres;
$dateaction = "";
if ($or->getIdType() == "1")
    $dateaction = "Commencement";
if ($or->getIdType() == "4")
    $dateaction = "d'arrêt";
if ($or->getIdType() == "5")
    $dateaction = "Reprise";
?>
<fieldset>
    <div class="col-lg-12" >
        <div class="col-lg-9">
            <table id="tab<?php echo $or->getId() ?>">
                <tr>
                    <td><label>Type OS</label></td>
                    <td><?php echo $ordres->getTypeios()->getLibelle(); ?></td>
                    <td><label>Date <?php echo $dateaction ?></label></td>
                    <td><?php echo $formios['dateios'] ?></td>
                </tr>
                <tr>
                    <td><label>Objet</label></td>
                    <td colspan="3"><?php echo $formios['object'] ?></td>
                </tr>
                <tr>
                    <td><label>Référence</label></td>
                    <td colspan="3"><?php echo $formios['reference'] ?></td>
                </tr>
                <tr>
                    <td><label>Description</label></td>
                    <td colspan="3"><?php echo $formios['description'] ?></td>
                </tr>
            </table>
        </div>
        <div class="col-lg-3">
            <div>
                <a ng-click="AjouterIos(<?php echo $ordres->getId() ?>,<?php echo $ordres->getIdType() ?>)" class="btn btn-white btn-default" style="width: 100%; margin-top: 5px">Valider Date OS</a>
                <a target="_blank" href="<?php echo url_for('ordredeservicecontratachat/ImprimerOs') . '?id=' . $ordres->getId() ?>" class="btn btn-white btn-warning" style="width: 100%; margin-top: 5px;">Imprimer & Exporter PDF</a>
                <a href="#my-modal<?php echo $ordres->getId() ?>" role="button" class="btn btn-white btn-default" style="width: 100%; margin-top: 5px" data-toggle="modal">Scan document</a>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div id="my-modal<?php echo $ordres->getId() ?>" class="modal fade" tabindex="-1">
            <div class="modal-dialog" style="width: 70%">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="smaller lighter blue no-margin">Nouveau Document</h3>
                    </div>
                    <div class="modal-body">
                        <?php // include_partial('Scan/formscan', array('ordre' => $ordres)); ?>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                            <i class="ace-icon fa fa-times"></i>
                            fermer
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    </div>
</fieldset>