<fieldset >
    <table>
        <tbody>
            <tr>
                <td style="width: 5%"><label> Agents </label></td>
                <td style="width: 30%">
                    <?php echo $form['id_agents']->renderError() ?>
                    <?php echo $form['id_agents'] ?>
                </td>
                <td style="width: 5%"><label> Destination </label></td>
                <td style="width: 30%">
                    <?php echo $form['id_destination']->renderError() ?>
                    <?php echo $form['id_destination'] ?>
                </td>
                <td ><label> Nbre Jour </label></td>
                <td class="disabledbutton">
                    <?php echo $form['nbrjour']->renderError() ?>
                    <?php echo $form['nbrjour'] ?>
                </td>
            <tr>
                <td ><label> Date Départ </label></td>
                <td>
                    <?php echo $form['datedepart']->renderError() ?>
                    <?php echo $form['datedepart'] ?>
                </td>
                <td ><label> Date Retour  </label></td>
                <td colspan="3">
                    <?php echo $form['dateretour']->renderError() ?>
                    <?php echo $form['dateretour'] ?>
                </td>

            </tr>
            <tr>
                <td ><label> Motif </label></td>
                <td  colspan="5">
                    <?php echo $form['motif']->renderError() ?>
                    <?php echo $form['motif'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>
