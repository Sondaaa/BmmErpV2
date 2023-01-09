<fieldset >
    <table>
        <tbody>
            <tr>
                <td><label> Sous  Rubrique   </label></td>
                <td colspan="2">
                    <?php echo $form['id_sousrubrique']->renderError() ?>
                    <?php echo $form['id_sousrubrique'] ?>
                </td>

                <td ><label> Base Ristourne    </label></td>
                <td>
                    <?php echo $form['libelle']->renderError() ?>
                    <?php echo $form['libelle'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>
