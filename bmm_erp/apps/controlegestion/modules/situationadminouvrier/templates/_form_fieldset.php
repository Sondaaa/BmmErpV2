<fieldset>
    <table>
        <tbody>
            <tr>
                <td><label> Libellé  (الوضع الإداري ) </label></td>
                <td>
                    <?php echo $form['libelle']->renderError() ?>
                    <?php echo $form['libelle'] ?>
                </td>
                <td><label> Montant(par jour)  (الأجر اليومي) </label></td>
                <td>
                    <?php echo $form['montant']->renderError() ?>
                    <?php echo $form['montant'] ?>
                </td>
            </tr>
    </table></tbody>
</fieldset>