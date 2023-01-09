
<fieldset >

    <table>
        <tbody>
            <tr>
<!--                <td style="width: 5%"><label> Type</label></td>
                <td style="width: 30%">
                    <?php // echo $form['id_type']->renderError() ?>
                    <?php // echo $form['id_type'] ?>
                </td>-->
                <td style="width: 10%"><label> Libellé </label></td>
                <td style="width: 40%">
                    <?php echo $form['libelle']->renderError() ?>
                    <?php echo $form['libelle'] ?>
                </td>
                <td style="width: 10%"><label> Remboursé sur </label></td>
                <td style="width: 40%">
                    <?php echo $form['remboursement']->renderError() ?>
                    <?php echo $form['remboursement'] ?>
                </td>


            </tr>
    </table></tbody>
</fieldset>
