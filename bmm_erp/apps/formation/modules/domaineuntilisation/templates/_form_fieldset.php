
<fieldset >
    <table>
        <tbody>
            <tr>
                <th style="width: 10%"><label> Code   </label></th>
                <td style="width: 10%">
                    <?php echo $form['code']->renderError() ?>
                    <?php echo $form['code'] ?>
                </td>
                <td><label> Domaine d'utulisation   </label></td>
                <td>
                    <?php echo $form['libelle']->renderError() ?>
                    <?php echo $form['libelle'] ?>
                </td>


            </tr>
        </tbody>
    </table>
</fieldset>
