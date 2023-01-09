<div class="col-lg-12">
    <fieldset >
        <table>
            <tbody> 
                <tr>
                    <td><label>Libellé </label></td>
                    <td>
                        <?php echo $form['libelle']->renderError() ?>
                        <?php echo $form['libelle'] ?>
                    </td>
                    <td><label>Valeur Droit Timbre </label></td>
                    <td>
                        <?php echo $form['valeur']->renderError() ?>
                        <?php echo $form['valeur'] ?>
                    </td>
                </tr>                
            </tbody>
        </table>
    </fieldset>
</div>