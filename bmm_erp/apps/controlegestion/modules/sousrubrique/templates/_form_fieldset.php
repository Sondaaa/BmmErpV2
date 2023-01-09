
<fieldset >
    <table>
        <tbody>
            <tr>
                <td><label>  Rubrique   </label></td>
                <td colspan="3">
                    <?php echo $form['id_rubrique']->renderError() ?>
                    <?php echo $form['id_rubrique'] ?>
                </td>
            </tr>
            <tr>
                <td ><label> Code   </label></td>
                <td style="width: 10%">
                    <?php echo $form['code']->renderError() ?>
                    <?php echo $form['code'] ?>
                </td>
                <td ><label>Sous Rubrique   </label></td>
                <td >
                    <?php echo $form['libelle']->renderError() ?>
                    <?php echo $form['libelle'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>
