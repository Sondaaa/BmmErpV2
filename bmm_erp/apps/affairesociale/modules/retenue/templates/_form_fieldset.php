
<fieldset >
    <table>
        <tbody>
            <tr> 
                <td style="width: 5%"><label> Libelle </label></td>
                <td style="width: 45%">
                    <?php echo $form['libelle']->renderError() ?>
                    <?php echo $form['libelle'] ?>

                <td style="width: 5%"><label> Type Retenue  </label></td>
                <td style="width: 45%">
                    <?php echo $form['typeretenue']->renderError() ?>
                    <?php echo $form['typeretenue'] ?>
                </td>


            </tr>
        </tbody>
    </table>

</fieldset>
