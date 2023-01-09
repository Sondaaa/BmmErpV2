<div class="col-lg-12">
    <fieldset> 
        <table>
            <tbody>
                <tr>
                    <td><label>Désignation  </label></td>

                    <td class=<?php if (!$form->getObject()->isNew()) { ?>"disabledbutton"<?php } ?>>
                        <?php echo $form['designation']->renderError() ?>
                        <?php echo $form['designation'] ?>
                    </td>

                    <td><label>Montant </label></td>
                    <td>
                        <?php echo $form['montant']->renderError() ?>
                        <?php echo $form['montant'] ?>
                    </td>

                </tr>

            </tbody>
        </table>
    </fieldset>
</div>