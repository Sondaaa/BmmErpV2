<div class="col-lg-12">
    <fieldset> 
        <table>
            <tbody> <tr>
                    <td><label>Montant Début  </label></td>
                    <td>
                        <?php echo $form['montantdebut']->renderError() ?>
                        <?php echo $form['montantdebut'] ?>
                    </td>
                    <td><label>Montant Fin </label></td>
                    <td>
                        <?php echo $form['montantfin']->renderError() ?>
                        <?php echo $form['montantfin'] ?>
                    </td>
                    <td><label>Pourcentage</label></td>
                    <td>
                        <?php echo $form['pourcentage']->renderError() ?>
                        <?php echo $form['pourcentage'] ?>
                    </td>
                </tr>

            </tbody>
        </table>
    </fieldset>
</div>