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
    <div class="col-lg-12">
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
                    <td colspan="3"><?php echo $formios['referece'] ?></td>
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
                <a target="_blank" href="<?php echo url_for('ordredeservice/ImprimerOs') . '?id=' . $ordres->getId() ?>" class="btn btn-white btn-warning" style="width: 100%; margin-top: 5px;">Imprimer & Exporter PDF</a>
                <a href="#my-modal<?php echo $ordres->getId() ?>" role="button" class="btn btn-white btn-default" style="width: 100%; margin-top: 5px" data-toggle="modal">Scan document</a>
            </div>
        </div>
    </div>
    
</fieldset>