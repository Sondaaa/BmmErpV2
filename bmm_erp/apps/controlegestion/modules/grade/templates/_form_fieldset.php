
<fieldset >

    <table>
        <tbody>
            <tr>
                <td><label> Libelle Grade</label></td>
                <td>
                    <?php echo $form['libelle']->renderError() ?>
                    <?php echo $form['libelle'] ?>
                </td>
                <td><label> Corps </label></td>
                <td>
                    <?php echo $form['id_corpsdet']->renderError() ?>
                    <?php echo $form['id_corpsdet'] ?>
                </td>
            </tr>
            <tr>
                <td><label> Categorie </label></td>
                <td>
                    <?php echo $form['id_categorie']->renderError() ?>
                    <?php echo $form['id_categorie'] ?>
                </td>
                <td><label> Code CNRPS Grade </label></td>
                <td>
                    <?php echo $form['codecnrps']->renderError() ?>
                    <?php echo $form['codecnrps'] ?>
                </td>

            </tr>
    </table></tbody>
</fieldset>
