<div id="homeformateur" ng-controller="CtrlFormation">
    <fieldset >
        <table>
            <tbody>

                <tr>
                    <td ><label>   Nom Formateur  </label></td>
                    <td >
                        <?php echo $form['nom']->renderError() ?>
                        <?php echo $form['nom'] ?>
                    </td>
                    <td><label> Prénom Formateur </label></td>
                    <td>
                        <?php echo $form['prenom']->renderError() ?>
                        <?php echo $form['prenom'] ?>
                    </td>
                    <td><label> CIN  </label></td>
                    <td>
                        <?php echo $form['cin']->renderError() ?>
                        <?php echo $form['cin'] ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>
</div>