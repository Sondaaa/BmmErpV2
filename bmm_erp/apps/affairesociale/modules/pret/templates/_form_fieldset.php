
<fieldset >
    <table>
        <tbody>
            <tr>

                <td style="width: 10%"><label> Type Prêt  </label></td>
                <td style="width: 40%">
                    <?php echo $form['libelle']->renderError() ?>
                    <?php echo $form['libelle'] ?>
                </td>

                <td style="width: 5%"><label> Source   </label></td>
                <td style="width: 45%">
                    <?php echo $form['id_source']->renderError() ?>
                    <?php echo $form['id_source'] ?>
                </td>
            </tr>
        </tbody>
    </table>

</fieldset>
