<fieldset>
    <div class="col-lg-10">
        <table>
            <tr>
                <td><label>Type Avenant</label></td>
                <td><?php echo $ordres->getTypeios()->getLibelle(); ?></td>
                <td><label>Date</label></td>
                <td><?php echo $formios['dateios'] ?></td>
            </tr>
            <tr>
                <td><label>Objet</label></td>
                <td colspan="3"><?php echo $formios['object'] ?></td>
            </tr>
            <tr>
                <td><label>Description</label></td>
                <td colspan="3"><?php echo $formios['description'] ?></td>
            </tr>
        </table>
    </div>
    <div class="col-lg-2">
        <a ng-click="AjouterAvenant(<?php echo $ordres->getId() ?>)" class="btn btn-white btn-default" style="width: 100%; margin: 5px">Valider Avenant</a>
    </div>
</fieldset>