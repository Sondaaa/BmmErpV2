<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset): ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>


</fieldset>
<?php
if (!$form->getObject()->isNew() && !$lot)
    $lot = $form->getObject()->getNordre();
?>
<fieldset ng-init="AfficheLot(<?php echo $lot ?>)">
    <legend>Information <?php echo "Bénéficiaire" . $lot ?></legend>
    <table >
        <tbody>

            <tr>
                <td ><label>N°Ordre</label></td>
                <td style="width: 30%">
                    <?php echo $form['nordre']->renderError() ?>
                    <?php echo $form['nordre']->render(array('value' => $lot, 'class' => 'disabledbutton')) ?>
                </td>

                <td ><label>Marchés</label></td>
                <td >
                    <?php echo $form['id_marche']->renderError() ?>
                    <?php echo $form['id_marche'] ?>
                </td>
                <td ><label>Fournisseur</label></td>
                <td>
                    <?php echo $form['id_frs']->renderError() ?>
                    <?php echo $form['id_frs'] ?> 
                    <a href="#my-modal" role="button" class="bigger-125 bg-primary white" data-toggle="modal">
                        &nbsp; + &nbsp;
                    </a>
                </td>
            </tr>
            <tr>
                <td ><label>TVA</label></td>
                <td>
                    <?php echo $form['id_tva']->renderError() ?>
                    <?php echo $form['id_tva'] ?>
                </td>
                <td ><label>RABAIS</label></td>
                <td >
                    <?php echo $form['rrr']->renderError() ?>
                    <?php echo $form['rrr']->render(array("ng-model" => "rrr", "ng-change" => "Calculerrrr('" . $lot . "','0')")) ?>
                </td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td ><label>TOTAL GENERAL HTVA</label></td>
                <td style="width: 20%">
                    <?php echo $form['totalht']->renderError() ?>
                    <?php echo $form['totalht']->render(array("ng-model" => "htax", "ng-change" => "Calculerrrr('" . $lot . "','1')")) ?>
                </td>
                <td ><label>TOTAL GENERAL HTVA APRES RABAIS</label></td>
                <td style="width: 20%" class="disabledbutton">
                    <?php echo $form['totalapresrrr']->renderError() ?>
                    <?php echo $form['totalapresrrr']->render(array("ng-model" => "htrrr", "ng-change" => "Calculerrrr('" . $lot . "','3')")) ?>
                </td>
                <td ><label>Net à payer TTC</label></td>
                <td style="width: 20%">
                    <?php echo $form['ttcnet']->renderError() ?>
                    <?php echo $form['ttcnet']->render(array("ng-model" => "ttcbe", "ng-change" => "Calculerrrr('" . $lot . "','4')")) ?>
                </td>


            </tr>
            <tr>

                <td ><label>Objet</label></td>
                <td colspan="5">
                    <?php echo $form['objet']->renderError() ?>
                    <?php echo $form['objet'] ?>
                </td>

            </tr>


        </tbody>
    </table>

    <input type="button" value="Valider && Affecter LOT<?php echo $lot ?>" ng-click="AjouterLot(<?php echo $lot ?>)">
</fieldset>