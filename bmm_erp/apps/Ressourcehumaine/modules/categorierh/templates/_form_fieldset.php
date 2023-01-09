
<fieldset >

    <table>
        <tbody>
            <tr>
                <td><label> Libelle </label></td>
                <td>
                    <?php echo $form['libelle']->renderError() ?>
                    <?php echo $form['libelle'] ?>
                </td>
                <td><label> Sous Corps </label></td>
                <td>
                    <?php echo $form['id_souscorps']->renderError() ?>
                    <?php echo $form['id_souscorps'] ?>
                </td>
                <td><label>  Corps </label></td>
                <td>
                    <?php echo $form['id_corps']->renderError() ?>
                    <?php echo $form['id_corps'] ?>
                </td>
              
            </tr>

        </tbody>
    </table>
</fieldset>
