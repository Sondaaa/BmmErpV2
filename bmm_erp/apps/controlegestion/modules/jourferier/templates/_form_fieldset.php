<fieldset class="col-lg-8">
    <table>
        <tbody>
            <tr>
                <td ><label>  Jour Férier     </label></td>
                <td>
                    <?php echo $form['libelle']->renderError() ?>
                    <?php echo $form['libelle'] ?>
                </td>
                   <td ><label>  Date du Jour Férier  </label></td>
                <td>
                    <?php echo $form['date']->renderError() ?>
                    <?php echo $form['date'] ?>
                </td>
            </tr>
            <tr>
                <td ><label>  Payé/Non.P  </label></td>
                <td>
                    <?php echo $form['paye']->renderError() ?>
                    <?php echo $form['paye'] ?>
                </td>
                 <td ><label>  Périodique  </label></td>
                <td>
                    <?php echo $form['periodique']->renderError() ?>
                    <?php echo $form['periodique'] ?>
                </td>
               
               
            </tr>
        </tbody>
    </table>
</fieldset>
